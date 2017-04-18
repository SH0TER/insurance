<?
/*
 * Title: policies class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

require_once '../../include/collector.inc.php';

require_once 'DMSRegisterAct.class.php';
function getMysqlDate($date)
{
		if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date, $regs)
			&& checkdate ( intval($regs[2]) , intval($regs[3]) , intval($regs[1]))) {
			return "$regs[1]-$regs[2]-$regs[3]";
		}
		else return date('Y-m-d');	
}
	
class EventsDMSService {  

	

	function getEventsByNumber($values) {
		global  $db;
	 
		$values->getEventsByNumberResult =$result;
 	 	return $values;
	}
	
	function getEventsByDates($values) {
		global  $db;
	 
		
		$values->getEventsByDatesResult =$result;
		//echo $result;exit;
 	 	return $values;
	}

    function getAktByNumber($values) {
		global  $db;
		$data['number']=trim($values->number);
		$DMSRegisterAct=new DMSRegisterAct($data);
		$result=$DMSRegisterAct->getXML($data);
		$values->getAktByNumberResult =$result;
 	 	return $values;
	}

}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('eventsdms.wsdl');
$Server->setClass('EventsDMSService');
$Server->handle();

/*
$eventsGOService=new EventsDMSService();
$data=new stdClass();
$data->number='4.12.6075';
$result1=$eventsGOService->getEventsByNumber($data);
*/
/*
$eventsGOService=new EventsDMSService();
$data=new stdClass();
$data->number='3.11.2667-1';
$result1=$eventsGOService->getAktByNumber($data);
*/
//_dump($result1);
?>