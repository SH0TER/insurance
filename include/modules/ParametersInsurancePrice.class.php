<?php
/**
 * Created by JetBrains PhpStorm.
 * User: m.marchuk
 * Date: 04.02.13
 * Time: 17:23
 * To change this template use File | Settings | File Templates.
 */
 
class ParametersInsurancePrice extends Form {

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
							'table'				=> 'parameters_insurance_price'),
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
							'table'				=> 'parameters_insurance_price'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldText,
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
							'table'				=> 'parameters_insurance_price'),
                        array(
							'name'				=> 'value',
							'description'		=> 'Сума',
					        'type'				=> fldInteger,
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
							'orderPosition'		=> 2,
							'table'				=> 'parameters_insurance_price'),
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
							'table'				=> 'parameters_insurance_price'),
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
                            'orderPosition'		=> 4,
                            'width'             => 100,
							'table'				=> 'parameters_insurance_price'),
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
							'orderPosition'		=> 5,
                            'width'             => 100,
							'table'				=> 'parameters_insurance_price')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 3,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersInsurancePrice($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Страхові суми';
		$this->messages['single'] = 'Страхова сума';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'view'		=> true,
					'change'	=> false,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_parent_class($this) ];
				break;

		}
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

		$sql =	'DELETE FROM ' . PREFIX . '_product_insurance_price ' .
				'WHERE insurance_price_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function getList($data, $product_types_id) {
		global $db;

        $conditions[] = 'a.product_types_id = ' . intval($product_types_id);

		$sql =	'SELECT a.id, a.title, b.value ' .
				'FROM ' . PREFIX . '_parameters_insurance_price as a ' .
				'LEFT JOIN ' . PREFIX . '_product_insurance_price as b ON a.id = b.insurance_price_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(insurance_price_id)) ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>СТРАХОВІ СУМИ:</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['insurance_price'])) ? $data['insurance_price'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ':</td>
					<td>
						<input type="text" name="insurance_price[' . $row['id'] . ']" value="' . $value . '" maxlength="15" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />
						<input type="hidden" name="insurance_price_title[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['insurance_price'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_insurance_price ' .
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			$first = true;
			$sql='';


			foreach ($data['insurance_price'] as $id => $value) {
			  if (intval($data['products_id'])) {
					if ($first) $sql =	'INSERT INTO ' . PREFIX . '_product_insurance_price (products_id,insurance_price_id,value,modified) VALUES ' ;
					$sql .=	(!$first ? ',':'').	' ( ' . intval($data['products_id']) . ', '  . intval($id) . ', ' . $db->quote($value) . ',  NOW())';
					$first = false;
				}
			}
			if ($sql) $db->query($sql);
		}
	}

}
