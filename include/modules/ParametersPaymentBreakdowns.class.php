<?
/*
 * Title: parameters payment  breakdowns class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersPaymentBreakdowns extends Form {

	var $formDescription =
			array(
				'fields' 	=>
					array(
						array(
							'name'				=> 'id',
					        'type'				=> fldIdentity,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'parameters_engine_sizes'),
						array(
							'name'				=> 'product_types_id',
							'description'		=> 'Тип страхового продукту',
					        'type'				=> fldHidden,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'parameters_payment_breakdown'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 1,
							'table'				=> 'parameters_payment_breakdown'),
						array(
							'name'				=> 'insurance_amount',
							'description'		=> 'Страхова премiя, грн',
					        'type'				=> fldMoney,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'width'				=> 150,
							'orderPosition'		=> 2,
							'table'				=> 'parameters_payment_breakdown'),
						array(
							'name'				=> 'order_position',
							'description'		=> 'Порядок виводу',
					        'type'				=> fldOrderPosition,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 150,
							'orderPosition'		=> 3,
							'table'				=> 'parameters_payment_breakdown'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'parameters_payment_breakdown'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 4,
                            'width'             => 100,
							'table'				=> 'parameters_payment_breakdown')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 3,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersPaymentBreakdowns($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Розбивка платежу';
		$this->messages['single'] = 'Розбивка платежу';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> true);
				break;
/*
			case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_parent_class($this) ];
				break;
*/
		}
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

		$sql =	'DELETE FROM ' . PREFIX . '_product_payment_breakdowns  ' .
				'WHERE payment_breakdown_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function getList($data, $product_types_id) {
		global $db;

		$conditions[] = 'a.product_types_id = ' . intval($product_types_id);

		$sql =	'SELECT a.id, a.title, b.value,a.insurance_amount ' . 
				'FROM ' . PREFIX . '_parameters_payment_breakdown  as a ' .
				'LEFT JOIN ' . PREFIX . '_product_payment_breakdowns  as b ON a.id = b.payment_breakdown_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(payment_breakdown_id)) ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>РОЗБИВКА ПЛАТЕЖУ:</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['payment_breakdowns'])) ? $data['payment_breakdowns'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ' (премiя >= '.$row['insurance_amount'].' грн.):</td>
					<td>
						<input type="text" name="payment_breakdowns[' . $row['id'] . ']" value="' . $value . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />
						<input type="hidden" name="payment_breakdownsTitle[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['payment_breakdowns'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_payment_breakdowns  ' . 
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			foreach ($data['payment_breakdowns'] as $id => $value) {
			  if (intval($data['products_id'])) {
				$sql =	'INSERT INTO ' . PREFIX . '_product_payment_breakdowns	 SET ' .
						'products_id = ' . intval($data['products_id']) . ', ' .
						'payment_breakdown_id = ' . intval($id) . ', ' .
						'value = ' . $db->quote($value) . ', ' .
						'modified = NOW()';
				$db->query($sql);
			  }	
			}
		}
	}
}

?>