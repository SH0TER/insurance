<?
/*
 * Title: ParametersBaseRates class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ParametersBaseRates extends Form {

   

    function ParametersBaseRates($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Базові тарифи';
        $this->messages['single'] = 'Базовий тариф';
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
/*
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_parent_class($this) ];
                break;
*/
        }
    }

    function getList($data, $product_types_id) {
        global $db;

		$sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_car_types ' .
				'WHERE product_types_id = ' . intval($product_types_id);
		$car_types = $db->getAssoc($sql);

        $result = '<tr><td>&nbsp;</td><td><b>БАЗОВІ ТАРИФИ:</b></td></tr>';
		$result .= '<tr><td>&nbsp;</td><td><table cellspacing="0" cellpadding="5" style="border: solid 1px #000000;">';
		$result .= '<tr class="columns" align=center><td>Тип ТЗ</td><td>ДТП</td><td>Нез. завол.</td><td>ПДТО</td><td>Пожежа</td><td>Стихія</td><td>Пад. пред.</td><td>Нап. тварин</td></tr>';

        $sql =  'SELECT car_types_id, base_rate_dtp, base_rate_hijacking, base_rate_pdto, base_rate_fire, base_rate_actofgod, base_rate_downfall, base_rate_animal ' .
                'FROM ' . PREFIX . '_product_base_rates as a ' .
                'WHERE a.products_id = ' . intval($data['products_id']);
        $list  = $db->getAll($sql);

		if (is_array($list)) {
			foreach ($list as $i=>$row) {
				$rates[$row['car_types_id']]=$row;
			}
		}

		foreach ($car_types as $i => $row) {
			$result .=
				'<tr class="row' . (($i % 2) ? '1' : '0') . '">' .
					'<td align="right"><b>' . $row . ':</b></td>' .
					'<td align=center><input type="text" name="base_rates[' . $i . '][base_rate_dtp]" value="' . $rates[$i]['base_rate_dtp'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
					'<td align=center><input type="text" name="base_rates[' . $i . '][base_rate_hijacking]" value="' . $rates[$i]['base_rate_hijacking'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
					'<td align=center><input type="text" name="base_rates[' . $i . '][base_rate_pdto]" value="' . $rates[$i]['base_rate_pdto'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
					'<td align=center><input type="text" name="base_rates[' . $i . '][base_rate_fire]" value="' . $rates[$i]['base_rate_fire'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
					'<td align=center><input type="text" name="base_rates[' . $i . '][base_rate_actofgod]" value="' . $rates[$i]['base_rate_actofgod'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
					'<td align=center><input type="text" name="base_rates[' . $i . '][base_rate_downfall]" value="' . $rates[$i]['base_rate_downfall'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
					'<td align=center><input type="text" name="base_rates[' . $i . '][base_rate_animal]" value="' . $rates[$i]['base_rate_animal'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /></td>' .
				'</tr>';
		}

		$result .= '</table>';

        return $result;
    }

    function setValues($data) {
        global $db;

        if (is_array($data['base_rates'])) {

            $sql =	'DELETE FROM ' . PREFIX . '_product_base_rates ' .
                    'WHERE products_id = ' . intval($data['products_id']);
            $db->query($sql);

			$first = true;
			$sql='';
            foreach ($data['base_rates'] as $id => $row) {
				if ($first)
					$sql =  'INSERT INTO ' . PREFIX . '_product_base_rates (products_id,car_types_id,base_rate_dtp,base_rate_hijacking,base_rate_pdto,base_rate_fire,base_rate_actofgod,base_rate_downfall,base_rate_animal,created,modified) VALUES ' ;
				
				$sql.= (!$first ? ',':'').'('. intval($data['products_id']) . ', ' . intval($id) . ', ' . $db->quote($row['base_rate_dtp']) . ', ' . $db->quote($row['base_rate_hijacking']) . ', ' . $db->quote($row['base_rate_pdto']) . ', ' . $db->quote($row['base_rate_fire']) . ', ' . $db->quote($row['base_rate_actofgod']) . ', ' . $db->quote($row['base_rate_downfall']) . ', ' . $db->quote($row['base_rate_animal']) . ', ' .' NOW(), NOW())';
				$first = false;
            }
			if ($sql) $db->query($sql);
        }
    }
}

?>