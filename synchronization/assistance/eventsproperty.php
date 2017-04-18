<?
/*
 * Title: policies class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

require_once '../../include/collector.inc.php';

require_once 'Accidents.class.php';
require_once 'Accidents/Property.class.php';
require_once 'AccidentActs/Property.class.php';
function getMysqlDate($date)
{
		if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date, $regs)
			&& checkdate ( intval($regs[2]) , intval($regs[3]) , intval($regs[1]))) {
			return "$regs[1]-$regs[2]-$regs[3]";
		}
		else return date('Y-m-d');	
}
	
class EventsPropertyService {  

	

	function getEventsByNumber($values) {
		global $Property,$db;
		$data['number']=trim($values->number);
		$Property=new Accidents_Property($data);
		$result=$Property->getXML($data);
		//_dump($result);exit;
		$values->getEventsByNumberResult =$result;
 	 	return $values;
	}
	
	function getEventsByDates($values) {
		global $Property,$db;
		$data['from']=$db->quote(getMysqlDate($values->from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($values->to). ' 23:59:59');

		$Property=new Accidents_GO($data);
		$result=$Property->getXML($data);
		
		$values->getEventsByDatesResult =$result;
		//echo $result;exit;
 	 	return $values;
	}

    function getAktByNumber($values) {
		global $Property,$db;
		$data['number']=trim($values->number);
		$Property=new AccidentActs_GO($data);
		$result=$Property->getXML($data);
		//_dump($result);exit;
		$values->getAktByNumberResult =$result;
 	 	return $values;
	}

}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('eventsproperty.wsdl');
$Server->setClass('EventsPropertyService');
$Server->handle();

/*
$eventsGOService=new EventsGOService();
$data=new stdClass();
$data->number='4.12.6075';
$result1=$eventsGOService->getEventsByNumber($data);
*/
/*
$eventsGOService=new EventsGOService();
$data=new stdClass();
$data->number='3.11.2667-1';
$result1=$eventsGOService->getAktByNumber($data);
*/
//_dump($result1);
?>