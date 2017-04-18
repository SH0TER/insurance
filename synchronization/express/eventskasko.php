<?
/*
 * Title: policies class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

require_once '../../include/collector.inc.php';

require_once 'Events.class.php';
require_once 'Events/KASKO.class.php';
function getMysqlDate($date)
{
		if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date, $regs)
			&& checkdate ( intval($regs[2]) , intval($regs[3]) , intval($regs[1]))) {
			return "$regs[1]-$regs[2]-$regs[3]";
		}
		else return date('Y-m-d');	
}
	
class EventsKaskoService {  

	

	function getEventsByNumber($values) {
		global $Kasko,$db;
		$data['number']=trim($values->number);
		$Kasko=new Events_KASKO($data);
		$result=$Kasko->getXML($data);
		//_dump($result);exit;
		$values->getEventsByNumberResult =$result;
 	 	return $values;
	}
	
	function getEventsByDates($values) {
		global $Kasko,$db;
		$data['from']=$db->quote(getMysqlDate($values->beginDate). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($values->endDate). ' 23:59:59');
		
		$Kasko=new Events_KASKO($data);
		$result=$Kasko->getXML($data);
		
		$values->getEventsByDatesResult =$result;
		//echo $result;exit;
 	 	return $values;
	}

	
}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('eventskasko.wsdl');
$Server->setClass('EventsKaskoService');
$Server->handle();

//$data['number']='3.11.2768';
//$eventsKaskoService=new EventsKaskoService();
//$result1=$eventsKaskoService->getEventsByNumber($data);
//_dump($result1);

?>