<?
/*
 *
 */

require_once '../../include/collector.inc.php';
require_once 'PolicyBlankActs.class.php';


function getMysqlDate($date)
	{
		if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date, $regs)
			&& checkdate ( intval($regs[2]) , intval($regs[3]) , intval($regs[1]))) {
			return "$regs[1]-$regs[2]-$regs[3]";
		}
		else return date('Y-m-d');	
	}
	

class ImportGOBlanksService {

	function getGOBlanksAktByNumber($values) {
		global $db;
		$number = trim($values->number);
        $data['number'] =$number;
        $data['types_id'] = 1;
		
        $PolicyBlankActs=new PolicyBlankActs($data);
		$output = $PolicyBlankActs->getXML($data);

		$values->getGOBlanksAktByNumberResult=$output;
	 	return $values;
	}
	
	function getGOBlanksAktByDates($values)
	{
		global $db;
		$data['from']=$db->quote(getMysqlDate($values->from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($values->to). ' 23:59:59');
        $data['types_id'] = 1;

        $PolicyBlankActs=new PolicyBlankActs($data);
		$output = $PolicyBlankActs->getXML($data);

		$values->getGOBlanksAktByDatesResult=$output;
	 	return $values;
	}

    function getGOReturnBlanksAktByNumber($values) {
		global $db;
		$number = trim($values->number);
        $data['number'] =$number;
        $data['types_id'] = 2;

        $PolicyBlankActs=new PolicyBlankActs($data);
		$output = $PolicyBlankActs->getXML($data);

		$values->getGOReturnBlanksAktByNumberResult=$output;
	 	return $values;
	}
	
	function getGOReturnBlanksAktByDates($values)
	{
		global $db;
		$data['from']=$db->quote(getMysqlDate($values->from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($values->to). ' 23:59:59');
        $data['types_id'] = 2;

        $PolicyBlankActs=new PolicyBlankActs($data);
		$output = $PolicyBlankActs->getXML($data);

		$values->getGOReturnBlanksAktByDatesResult=$output;
	 	return $values;
	}
	
}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('importgoblanks.wsdl');
$Server->setClass('ImportGOBlanksService');
$Server->handle();

?>