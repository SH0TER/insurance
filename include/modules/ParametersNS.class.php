<?
/*
 * Title: ParametersProperty class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersNS extends Form {

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
							'table'				=> 'parameters_ns'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldText,
					        'maxlength'			=> 250,
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
							'table'				=> 'parameters_ns'),
						array(
                            'name'              => 'types_id',
                            'description'       => 'Тип',
                            'type'              => fldRadio,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
							'orderPosition'         => 3,
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'sourceTable'		=> '_parameters_ns_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position',
                            'table'             => 'parameters_ns'),
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
							'table'				=> 'parameters_ns'),
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
							'table'				=> 'parameters_ns')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ParametersNS($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Параметри договору НС';
		$this->messages['single'] = 'Параметри договору НС';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'add'		=> true,
					'edit'		=> true,
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

	function getList($data, $types_id) {
        global $db;

       $conditions[] = 'a.types_id = ' . $types_id ;

       switch($types_id) {
           case PRODUCT_CORRECTION_FACTORS_TYPES_AGES:
               $fields = 'a.id as values_id, a.age_begin, a.age_end,a.title as factor_title, a.order_position, ' .
                         'b.title as factors_types_title, ' .
                         'c.value';
               break;
           case PRODUCT_CORRECTION_FACTORS_TYPES_SPORTS:
           case PRODUCT_CORRECTION_FACTORS_TYPES_PROFESSIONS:
           case PRODUCT_CORRECTION_FACTORS_TYPES_TERMS_HOURS:
           case PRODUCT_CORRECTION_FACTORS_TYPES_LOCATION:
               $fields = 'a.id as values_id, a.title as factor_title, a.order_position, a.description, ' .
                         'b.title as factors_types_title, ' .
                         'c.value';
               break;
       }
		$sql =	'SELECT ' . $fields . ' ' .
				'FROM ' . PREFIX . '_parameters_ns  AS a ' .
                'JOIN ' . PREFIX . '_parameters_ns_types as b ON a.types_id = b.id ' .
				'LEFT JOIN ' . PREFIX . '_product_ns_values AS c ON a.id = c.values_id AND c.products_id = ' . intval($data['products_id']) . ' ' .
				'WHERE '. implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$list =	$db->getAll($sql);

		$result = '<tr><td>&nbsp;</td><td><b>' . mb_strtoupper($list[0]['factors_types_title'], 'utf-8') . '</b></td></tr>';

		foreach($list as $row){
			$result .=
				'<tr>
					<td class="label">*' . $row['factor_title'] . ':</td>
					<td>
						<input type="text" name="factors_values[' . $row['values_id'] . ']" value="' . $row['value'] . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" />
					</td>
				</tr>
				<tr>
				    <td>&nbsp;</td>
				    <td>' . $row['description'] . '</td>
				</tr>';
		}

		return $result;
    }
	
	 function setValues($data) {
		global $db;

        if(is_array($data['factors_values'])){

            $sql =	'DELETE FROM ' . PREFIX . '_product_ns_values ' .
				    'WHERE products_id = ' . intval($data['products_id']);
		    $db->query($sql);

            foreach($data['factors_values'] as $factor_id=>$factor_value){
				if(!empty($factor_value)) {

					$sql =	'INSERT INTO ' . PREFIX . '_product_ns_values  SET ' .
							'products_id = ' . intval($data['products_id']) . ', ' .
							'values_id = ' . intval($factor_id) . ', ' .
							'value = ' . $db->quote($factor_value) . ', ' .
							'modified = NOW()';
					$db->query($sql);
				}
            }
        }
	}

    function getParametersTypes() {
        global $db;

        $sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_parameters_ns_types ' .
				'ORDER BY order_position';
        return $db->getAll($sql);
    }
}

?>