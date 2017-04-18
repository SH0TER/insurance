<?
/*
 * Title: parameters price range class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersPriceRanges extends Form {

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
							'table'				=> 'parameters_price_ranges'),
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
									'canBeEmpty'	=> false
								),
							'table'				=> 'parameters_price_ranges'),
						array(
							'name'				=> 'products_id',
							'description'		=> 'Cтраховий продукт',
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
							'table'				=> 'parameters_price_ranges'),
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
							'table'				=> 'parameters_price_ranges'),
						array(
							'name'				=> 'limitation',
							'description'		=> 'Верхній ліміт',
					        'type'				=> fldMoney,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'width'				=> 150,
							'orderPosition'		=> 2,
							'table'				=> 'parameters_price_ranges'),
						array(
							'name'				=> 'currencies_id',
							'description'		=> 'Валюта',
					        'type'				=> fldSelect,
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
							'orderPosition'		=> 3,
							'table'				=> 'parameters_price_ranges',
							'sourceTable'		=> 'currencies',
							'selectField'		=> 'code',
							'orderField'		=> 'order_position'),
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
							'orderPosition'		=> 4,
							'table'				=> 'parameters_price_ranges'),
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
							'table'				=> 'parameters_price_ranges'),
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
							'table'				=> 'parameters_price_ranges')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 2,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersPriceRanges($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Діапазони вартості об\'єктів страхування';
		$this->messages['single'] = 'Діапазон вартості об\'єкту страхування';
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

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit = true) {

		$fields[] = 'products_id';
		$conditions[] = 'products_id = ' . intval($data['products_id']);

		$this->formDescription['fields'][ $this->getFieldPositionByName('currencies_id') ]['type'] = fldHidden;
		parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

		$sql =	'DELETE FROM ' . PREFIX . '_product_price_ranges ' .
				'WHERE price_rangesId IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function getList($data, $product_types_id) {
		global $db;

		$conditions[] = 'a.product_types_id = ' . intval($product_types_id);
		$conditions[] = 'a.products_id = ' . intval($data['id']);

		$sql =	'SELECT a.id, a.title, b.value ' . 
				'FROM ' . PREFIX . '_parameters_price_ranges as a ' .
				'LEFT JOIN ' . PREFIX . '_product_price_ranges as b ON a.id = b.price_rangesId AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(price_rangesId)) ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		if (!$res->numRows()) {
			array_pop($conditions);
			$conditions[] = 'a.products_id = 0';

			$sql =	'SELECT a.id, a.title, b.value ' . 
					'FROM ' . PREFIX . '_parameters_price_ranges as a ' .
					'LEFT JOIN ' . PREFIX . '_product_price_ranges as b ON a.id = b.price_rangesId AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(price_rangesId)) ' .
					'WHERE ' . implode(' AND ', $conditions) . ' ' .
					'ORDER BY a.order_position';
			$res =	$db->query($sql);
		}

		$result = '<tr><td>&nbsp;</td><td><b>ВАРТІСТЬ ОБ\'ЄКТУ СТРАХУВАННЯ:</b></td></tr>';

		while($res->fetchInto($row)) {
			$value = (is_array($data['price_ranges'])) ? $data['price_ranges'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label">*' . $row['title'] . ':</td>
					<td>
						<input type="text" name="price_ranges[' . $row['id'] . ']" value="' . $value . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />
						<input type="hidden" name="price_rangesTitle[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['price_ranges'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_price_ranges ' . 
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);
			
			$first = true;
			$sql='';
			foreach ($data['price_ranges'] as $id => $value) {
			  if (intval($data['products_id'])) {
				
				if ($first)
					$sql =	'INSERT INTO ' . PREFIX . '_product_price_ranges(products_id,price_rangesId,value,modified) VALUES ';

					$sql .=	(!$first ? ',':'').'( ' . intval($data['products_id']) . ', ' . intval($id) . ', ' . $db->quote($value) . ', NOW())';
					$first = false;
			  }	
			}
			if ($sql) $db->query($sql);
		}
	}

}

?>