<?
/*
 * Title: reinsurance class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'ReinsuranceBorderoEvents.class.php';
require_once 'ReinsuranceBorderoPremiums.class.php';

class Reinsurance {

	function Reinsurance($data) {
        $this->messages['plural'] = 'Перестрахування';
        $this->messages['single'] = 'Перестрахування';
	}

    function show($data) {
		$ReinsuranceBorderoPremiums = new ReinsuranceBorderoPremiums($data);
		$ReinsuranceBorderoPremiums->show($data);

		$ReinsuranceBorderoEvents = new ReinsuranceBorderoEvents($data);
		$ReinsuranceBorderoEvents->show($data);

		$ReinsuranceAgreements = new ReinsuranceAgreements($data);
		$ReinsuranceAgreements->show($data);
    }
}

?>