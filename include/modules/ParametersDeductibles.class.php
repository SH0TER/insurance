<?
/*
 * Title: parameters deductible class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersDeductibles extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'id',
                            'type'              => fldIdentity,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'parameters_deductibles'),
                        array(
                            'name'              => 'product_types_id',
                            'description'       => 'Тип страхового продукту',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'parameters_deductibles'),
                        array(
                            'name'              => 'title',
                            'description'       => 'Назва',
                            'type'              => fldUnique,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 1,
                            'table'             => 'parameters_deductibles'),
                        array(
                            'name'              => 'order_position',
                            'description'       => 'Порядок виводу',
                            'type'              => fldOrderPosition,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false,
                                    'change'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'width'             => 150,
                            'orderPosition'     => 3,
                            'table'             => 'parameters_deductibles'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDate,
                            'value'                => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'parameters_deductibles'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'                => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 4,
                            'width'             => 100,
                            'table'             => 'parameters_deductibles')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 3,
                        'defaultOrderDirection' => 'asc',
                        'titleField'            => 'title'
                    )
            );

    function ParametersDeductibles($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Франшизи';
        $this->messages['single'] = 'Франшиза';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => true,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => false);
                break;
/*
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_parent_class($this) ];
                break;
*/
        }
    }

    function isExists($table, $field, $value, $id = 0, $data = null) {
        global $db;

        $conditions[] = $field . '=' . $db->quote($value) . ' AND id <> ' . intval($id);
        $conditions[] = 'product_types_id = ' . intval($data['product_types_id']);

        $sql =  'SELECT count(*) ' .
                'FROM ' . $table . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        $count = $db->getOne($sql);

        return ($count != 0);
    }

    function view($data) {
        if ($data['deductibles_id'])
            $data['id'] = $data['deductibles_id'];

        $row = parent::view($data);

        $data['deductibles_id'] = $row['id'];

        $fields[]       = 'deductibles_id';
        $conditions[]   = 'deductibles_id=' . intval($data['deductibles_id']);

        $ParametersDeductibleValues = new ParametersDeductibleValues($data);
        $ParametersDeductibleValues->show($data, $fields, $conditions);
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db;

        $sql =  'DELETE FROM ' . PREFIX . '_product_deductible_values ' .
                'WHERE deductibles_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        return parent::deleteProcess($data, $i, $folder);
    }

    function getSign($absolute) {
        return ($absolute)? ' грн.' : '%';
    }

    function getList($data, $product_types_id) {
        global $db;

        $conditions[] = 'product_types_id = ' . intval($product_types_id);

        $sql =  'SELECT *  ' .
                'FROM ' . PREFIX . '_parameters_deductibles ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY order_position';
        $list = $db->getAll($sql);
		
		$sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_car_types ' .
				'WHERE product_types_id = ' . intval($product_types_id);
		$car_types = $db->getAssoc($sql);

        $result = '<tr><td>&nbsp;</td><td><b>ФРАНШИЗИ:</b></td></tr>';

        if (is_array($list)) {
            $result .= '<tr><td>&nbsp;</td><td><table id="deductibles" cellspacing="0" cellpadding="5" style="border: solid 1px #000000;">';
			$result .= '<tr class="columns"><td rowspan="2">Тип ТЗ</td><td colspan="' . sizeOf($list) . '">Франшизи</td><td colspan="' . sizeOf($list) . '">Коефіцієнти</td><td rowspan="2" style="padding-left: 8px;"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" onclick="addDeductible(this)" /></td></tr>';

            $result .= '<tr class="columns">';

            foreach ($list as $i=> $row) {
                $result .= '<td>' . $row['title'] . ' <input type="hidden" name="deductibles_id' . $i . '" value="' . $row['id'] . '" /></td>';
            }

            foreach ($list as $i=> $row) {
                $result .= '<td>' . $row['title'] . '</td>';
            }

            $result .= '</tr>';

            if (!is_array($data['deductibles'])) {
                $sql =  'SELECT * ' .
                        'FROM ' . PREFIX . '_product_deductibles AS a ' .
                        'WHERE a.products_id = ' . intval($data['products_id']) . ' ' .
                        'ORDER BY car_types_id, value1, value0 DESC';
                $data['deductibles'] = $db->getAll($sql);
            }

            if (is_array($data['deductibles']) && sizeOf($data['deductibles'])) {
                foreach ($data['deductibles'] as $i => $row) {
                    $row['id'] = ($_REQUEST['do'] == 'Products|copy') ? '-' . $row['id'] : $row['id'];

                    if ($row['id'] == NULL) $row['id'] = $i;

                    $result .=
                        '<tr class="row' . (($i % 2) ? '1' : '0') . '">' .
							'<td><select name="deductibles[' . $row['id'] . '][car_types_id]" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';

					foreach ($car_types as $j=>$car_type) {
							$result .='<option value="' . $j . '" ' . ($row['car_types_id'] == $j ? 'selected' : '') . '>' . $car_type . '</option>';
					}

					$result .='</select></td>'.
                            '<td><input type="text" name="deductibles[' . $row['id'] . '][value0]" value="' . $row['value0'] . '" maxlength="5" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> <input type="radio" name="deductibles[' . $row['id'] . '][absolute0]" value="0" ' . (($row['absolute0'] == 0) ? 'checked' : '') . ' />% <input type="radio" name="deductibles[' . $row['id'] . '][absolute0]" value="1" ' . (($row['absolute0'] == 1) ? 'checked' : '') . ' /> грн.</td>' .
                            '<td><input type="text" name="deductibles[' . $row['id'] . '][value1]" value="' . $row['value1'] . '" maxlength="5" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> <input type="radio" name="deductibles[' . $row['id'] . '][absolute1]" value="0" ' . (($row['absolute1'] == 0) ? 'checked' : '') . ' />% <input type="radio" name="deductibles[' . $row['id'] . '][absolute1]" value="1" ' . (($row['absolute1'] == 1) ? 'checked' : '') . ' /> грн.</td>' .
                            '<td><input type="text" name="deductibles[' . $row['id'] . '][value_other]" value="' . $row['value_other'] . '" maxlength="7" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
							'<td><input type="text" name="deductibles[' . $row['id'] . '][value_hijacking]" value="' . $row['value_hijacking'] . '" maxlength="7" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
                            '<td><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteDeductible(this)" /></td>' .
                        '</tr>';
                }
            } else {
                $i = 0;
	                 $result .=
	                        '<tr>' .
								'<td><select name="deductibles[' . $i . '][car_types_id]" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';"> ';
						foreach ($car_types as $j=>$car_type) {
								$result .= '<option value="' . $j . '" '  .($row['car_types_id'] == $j ? 'selected' : '') . '>' . $car_type . '</option>';
						}					
						$result .='</select></td>'.
                        '<td><input type="text" name="deductibles[' . $i . '][value0]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> <input type="radio" name="deductibles[' . $i . '][absolute0]" value="0" />% <input type="radio" name="deductibles[' . $i . '][absolute0]" value="1" /> грн.</td>' .
                        '<td><input type="text" name="deductibles[' . $i . '][value1]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> <input type="radio" name="deductibles[' . $i . '][absolute1]" value="0" />% <input type="radio" name="deductibles[' . $i . '][absolute1]" value="1" /> грн.</td>' .
                        '<td><input type="text" name="deductibles[' . $i . '][value_other]" value="" maxlength="7" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
						'<td><input type="text" name="deductibles[' . $i . '][value_hijacking]" value="" maxlength="7" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
                        '<td><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteDeductible(this)" /></td>' .
                    '</tr>';
            }

            $result .= '</table>';
        }

        return $result;
    }

    function setValues($data) {
        global $db;

        if (is_array($data['deductibles'])) {

            foreach ($data['deductibles'] as $id => $row) {
                if ($id > 0) {
                    $ids[] = $id;
                }
            }

            if (is_array($ids)) {
                $sql =	'DELETE FROM ' . PREFIX . '_product_deductibles ' .
                    	'WHERE products_id = ' . intval($data['products_id']) . ' AND id NOT IN(' . implode(', ', $ids) . ')';
                $db->query($sql);
            }

            foreach ($data['deductibles'] as $id => $row) {
                if ($id <= 0) {
                    $sql =  'INSERT INTO ' . PREFIX . '_product_deductibles SET ' .
                            'products_id = ' . intval($data['products_id']) . ', ' .
                            'deductibles_id0 = ' . intval($data['deductibles_id0']) . ', ' .
                            'value0 = ' . $db->quote($row['value0']) . ', ' .
                            'absolute0 = ' . intval($row['absolute0']) . ', ' .
                            'deductibles_id1 = ' . intval($data['deductibles_id1']) . ', ' .
                            'value1 = ' . $db->quote($row['value1']) . ', ' .
                            'absolute1= ' . intval($row['absolute1']) . ', ' .
							'car_types_id = ' . $db->quote($row['car_types_id']) . ', ' .
                            'value_other = ' . $db->quote($row['value_other']) . ', ' .
							'value_hijacking = ' . $db->quote($row['value_hijacking']) . ', ' .
                            'created = NOW(), ' .
                            'modified = NOW()';
                } else {
                    $sql =  'UPDATE ' . PREFIX . '_product_deductibles SET ' .
                            'deductibles_id0 = ' . intval($data['deductibles_id0']) . ', ' .
                            'value0 = ' . $db->quote($row['value0']) . ', ' .
                            'absolute0 = ' . intval($row['absolute0']) . ', ' .
                            'deductibles_id1 = ' . intval($data['deductibles_id1']) . ', ' .
                            'value1 = ' . $db->quote($row['value1']) . ', ' .
                            'absolute1= ' . intval($row['absolute1']) . ', ' .
							'car_types_id = ' . $db->quote($row['car_types_id']) . ', ' .
                            'value_other = ' . $db->quote($row['value_other']) . ', ' .
							'value_hijacking = ' . $db->quote($row['value_hijacking']) . ', ' .
                            'modified = NOW() ' .
                            'WHERE id = ' . intval($id) . ' AND products_id=' . intval($data['products_id']);
                }

                $db->query($sql);
            }
        }
    }
}

?>