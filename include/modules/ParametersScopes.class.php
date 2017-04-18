<?
/*
 * Title: parameters scope class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersScopes extends Form {

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
							'table'				=> 'parameters_scopes'),
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
							'table'				=> 'parameters_scopes'),
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
							'table'				=> 'parameters_scopes'),
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
							'table'				=> 'parameters_scopes'),
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
							'table'				=> 'parameters_scopes'),
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
							'table'				=> 'parameters_scopes')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 3,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersScopes($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Сфери використання транспортного засобу';
		$this->messages['single'] = 'Сфера використання транспортного засобу';
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
			case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_parent_class($this) ];
                break;
		}
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db;

		$sql =	'DELETE FROM ' . PREFIX . '_product_zones ' .
				'WHERE zones_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function getList($data) {
		global $db;

		$sql =	'SELECT a.id, a.title, b.value ' .
				'FROM ' . PREFIX . '_parameters_scopes AS a ' .
				'LEFT JOIN ' . PREFIX . '_product_scopes AS b ON a.id = b.scopes_id AND (b.products_id = ' . intval($data['id']) . ' OR ISNULL(scopes_id)) ' .
				'ORDER BY a.order_position';
		$res =	$db->query($sql);

		$result = '<tr><td>&nbsp;</td><td><b>СФЕРИ ВИКОРИСТАННЯ ТРАНСПОРТНОГО ЗАСОБУ:</b></td></tr>';

		while($res->fetchInto($row)) {

			$value = (is_array($data['scopes'])) ? $data['scopes'][ $row['id'] ] : $row['value'];

			$result .=
				'<tr>
					<td class="label" style="word-wrap: break-word;">*' . $row['title'] . ':</td>
					<td>
						<input type="text" name="scopes[' . $row['id'] . ']" value="' . $value . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />
						<input type="hidden" name="scopes_title[' . $row['id'] . ']" value="' . htmlspecialchars($row['title']) . '" />
					</td>
				</tr>';
		}

		return $result;
	}

	function setValues($data) {
		global $db;

		if (is_array($data['scopes'])) {

			$sql =	'DELETE FROM ' . PREFIX . '_product_scopes ' .
					'WHERE products_id = ' . intval($data['products_id']);
			$db->query($sql);

			foreach ($data['scopes'] as $id => $value) {
			  if (intval($data['products_id'])) {
				$sql =	'INSERT INTO ' . PREFIX . '_product_scopes SET ' .
						'products_id = ' . intval($data['products_id']) . ', ' .
						'scopes_id = ' . intval($id) . ', ' .
						'value = ' . $db->quote($value) . ', ' .
						'modified = NOW()';
				$db->query($sql);
			  }	
			}
		}
	}

	
}

?>