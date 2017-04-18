<?
/*
 * Title: reinsurance agreement risks class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ReinsuranceAgreementRisks extends Form {

    function ReinsuranceAgreementRisks($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Розподiл ризикiв';
        $this->messages['single'] = 'Розподiл ризикiв';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'add'       => false,
                    'edit'      => true,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => false);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ 'ReinsuranceAgreements' ];
				break;
        }
    }

   
    function getList($data, $product_types_id) {
        global $db;

		$conditions = array('id IN(' . RISKS_DTP . ', ' . RISKS_PDTO . ', ' . RISKS_ACTOFGOD . ', ' . RISKS_DOWNFALL . ', ' . RISKS_ANIMAL . ', ' . RISKS_FIRE1 . ', ' . RISKS_HIJACKING1 . ')');

		$sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_parameters_risks ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY id';
		$risks = $db->getAssoc($sql);

        $result = '<tr><td>&nbsp;</td><td><br /><b>РОЗПОДIЛ РИЗИКIВ:</b></td></tr>';

		$result .= '<tr><td>&nbsp;</td><td><table id="risks" cellspacing="0" cellpadding="5" style="border: solid 1px #000000;;">';
		$result .= '<tr class="columns"><td>Ризик</td><td>%</td><td style="padding-left: 8px;"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" onclick="addRisk(this)" /></td></tr>';

		if (!is_array($data['risks'])) {
			$conditions = array('agreements_id = ' . intval($data['agreements_id']));

			$sql =  'SELECT * ' .
					'FROM ' . PREFIX . '_reinsurance_agreement_risks ' .
					'WHERE ' . implode(' AND ', $conditions);
			$data['risks'] = $db->getAll($sql);
		}

		$i = 0;
		if (is_array($data['risks'])) {
			foreach ($data['risks'] as $i => $row) {

				if ($row['id'] == NULL) $row['id'] = $i;

				$result .=
					'<tr>' .
						'<td><select name="risks[' . $row['id'] . '][risks_id]" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';

				foreach ($risks as $j => $risk) {
					$result .= '<option value="' . $j . '" ' . ($row['risks_id']==$j ? 'selected': '') . '>' . $risk . '</option>';
				}

				$result .= '</select></td>' .
						'<td><input type="text" name="risks[' . $row['id'] . '][value]" value="' . $row['value'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
						'<td style="padding-left: 8px;"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteRisk(this)" /></td>' .
					 '</tr>';
			}
		}

		$result .= '</table>';

		$risk = '';
		foreach ($risks as $risks_id => $risksTitle) {
			$risk .= '<option value="' . $risks_id . '">' . $risksTitle . '</option>';
		}

		$result .= '
<script type="text/javascript">
	numRisk = -1;
    function addRisk(obj) {
        var row			= document.getElementById(\'risks\').insertRow(-1);

		var cell		= row.insertCell(0);
        cell.innerHTML	= \'<select name="risks[\' + numRisk + \'][risks_id]" value="" class="fldSelect" onfocus="this.className=\\\'fldSelectOver\\\';" onblur="this.className=\\\'fldSelect\\\';" />' . $risk . '</select>\';

		cell		= row.insertCell(-1);
        cell.innerHTML	= \'<input type="text" name="risks[\' + numRisk + \'][value]" value="" maxlength="10" class="fldMoney" onfocus="this.className=\\\'fldMoneyOver\\\';" onblur="this.className=\\\'fldMoney\\\';" />\';

        cell			= row.insertCell(-1);
        cell.innerHTML	= \'<img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteRisk(this)" />\';

        numRisk--;
    }
	
	function deleteRisk(obj) {
        if (confirm(\'Ви дійсно бажаєте вилучити вибранний ризик?\')) {
            document.getElementById(\'risks\').tBodies[0].deleteRow( obj.parentNode.parentNode.sectionRowIndex );
        }
    }
</script>';

        return $result;
    }

    function setValues($data) {
        global $db;

		$sql =  'DELETE FROM ' . PREFIX . '_reinsurance_agreement_risks ' .
				'WHERE agreements_id = ' . intval($data['agreements_id']) . '  ';
		$db->query($sql);

		if (is_array($data['risks'])) {
            foreach ($data['risks'] as $id => $row) {
                $sql =  'INSERT INTO ' . PREFIX . '_reinsurance_agreement_risks SET ' .
                        'agreements_id = ' . intval($data['agreements_id']) . ', ' .
                        'risks_id = ' . intval($row['risks_id']) . ', ' .
						'value = ' . $db->quote($row['value']) . ', ' .
						'created = NOW(), ' .
						'modified = NOW()';
				$db->query($sql);
			}
    	}
    }
}

?>