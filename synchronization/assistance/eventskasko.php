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
require_once 'Accidents/KASKO.class.php';
require_once 'AccidentActs/KASKO.class.php';
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
//_dump($data['number']);
		$Kasko=new Accidents_KASKO($data);
		$result=$Kasko->getXML($data);
$handle = fopen('./payments_dump.txt', 'w+');
fwrite($handle, $result) ;
fclose($handle);
		//_dump($result);exit;
		$values->getEventsByNumberResult =$result;
 	 	return $values;
	}
	
	function getEventsByDates($values) {
		global $Kasko,$db;
		$data['from']=$db->quote(getMysqlDate($values->beginDate). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($values->endDate). ' 23:59:59');
		
		$Kasko=new Accidents_KASKO($data);
		$result=$Kasko->getXML($data);


//$handle = fopen('./payments_dump.txt', 'w+');
//fwrite($handle, $result) ;
//fclose($handle);		



    	$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getEventsByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getEventsByDatesResult>'.$result.'</getEventsByDatesResult>
    </getEventsByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';

	  header("Content-Type: application/soap+xml; charset=utf-8");
//	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;


$result='<![CDATA['.$result.']]>';
		$values->getEventsByDatesResult =$result;
		//echo $result;exit;
 	 	return $values;
	}

    function getAktByNumber($values) {
		global $Kasko,$db;
		$data['number']=trim($values->number);
		$Kasko=new AccidentActs_KASKO($data);
		$result=$Kasko->getXML($data);
		//_dump($result);exit;
		$values->getAktByNumberResult =$result;
 	 	return $values;
	}

}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('eventskasko.wsdl');
$Server->setClass('EventsKaskoService');
$Server->handle();

/*$eventsKaskoService=new EventsKaskoService();
$data=new stdClass();
$data->number='3.12.3596';
$result1=$eventsKaskoService->getEventsByNumber($data);
*/
/*
$eventsKaskoService=new EventsKaskoService();
$data=new stdClass();
$data->number='3.11.2667-1';
$result1=$eventsKaskoService->getAktByNumber($data);
_dump($result1);*/
?>