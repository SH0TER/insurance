<?
/*
 * Title: ParametersSpecialCars class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersSpecialCars extends Form {

    

    function ParametersSpecialCars($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Спеціальні авто';
        $this->messages['single'] = 'Спеціальні авто';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'       => false,
                    'update'      => true,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => false);
                break;
            case ROLES_MANAGER:
                $this->permissions = array(
                    'show'      => ($Authorization->data['metodology']) ? true : false,
                    'insert'       => false,
                    'update'      => ($Authorization->data['metodology']) ? false : false,
                    'view'      => ($Authorization->data['metodology']) ? true : false,
                    'change'    => false,
                    'delete'    => false);
                break;
        }
    }

   
    function getList($data, $product_types_id) {
        global $db;

        $conditions[] = 'products_id = ' . intval($data['products_id']);

		$sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_car_brands ' .
				'ORDER BY title';
		$car_brands = $db->getAssoc($sql);

        $result = '<tr><td>&nbsp;</td><td><b>СПЕЦІАЛЬНІ АВТО:</b></td></tr>';

		$result .= '<tr><td>&nbsp;</td><td><table id="specialcars" cellspacing="0" cellpadding="5" style="border: solid 1px #000000;;">';
		$result .= '<tr class="columns"><td>Марка</td><td>Коефіцієнт</td><td style="padding-left: 8px;"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" onclick="addSpecialCar(this)" /></td></tr>';

		if (!is_array($data['special_cars'])) {
			$sql =  'SELECT * ' .
					'FROM ' . PREFIX . '_parameters_special_cars ' .
					'WHERE ' . implode(' AND ', $conditions);
			$data['special_cars'] = $db->getAll($sql);
		}

		$i = 0;
		if (is_array($data['special_cars'])) {
			foreach ($data['special_cars'] as $i=>$row) {
				$row['id'] = ($_REQUEST['do'] == 'Products|copy') ? '-' . $row['id'] : $row['id'];

				if ($row['id'] == NULL) $row['id'] = $i;

				$result .=
					'<tr>' .
						'<td><select name="special_cars[' . $row['id'] . '][brands_id]" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';
				foreach ($car_brands as $j=>$car_brand) {
						$result .='<option value="'.$j.'" '.($row['brands_id']==$j ? 'SELECTED': '').'>'.$car_brand.'</option>';
				}					
				$result .='</select></td>'.
						'<td><input type="text" name="special_cars[' . $row['id'] . '][value]" value="' . $row['value'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
						'<td><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteSpecialCar(this)" /></td>' .
					 '</tr>';
			}		 
		} 

		$result .= '</table>';

        return $result;
    }

    function setValues($data) {
        global $db;


            $sql =  'DELETE FROM ' . PREFIX . '_parameters_special_cars ' .
                    'WHERE products_id = ' . intval($data['products_id']) . '  ';
            $db->query($sql);

			if (is_array($data['special_cars']))
            foreach ($data['special_cars'] as $id => $row) {

                $sql =  'INSERT INTO ' . PREFIX . '_parameters_special_cars SET ' .
                            'products_id = ' . intval($data['products_id']) . ', ' .
                            'brands_id = ' . intval($row['brands_id']) . ', ' .
                            'value = ' . $db->quote($row['value']) . ', ' .
                            'created = NOW(), ' .
                            'modified = NOW()';
                $db->query($sql);
            }
    }
}

?>