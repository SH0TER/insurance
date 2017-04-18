<?
/*
 * Title: policies class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

require_once '../../include/collector.inc.php';

 
function getMysqlDate($date)
{
		if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date, $regs)
			&& checkdate ( intval($regs[2]) , intval($regs[3]) , intval($regs[1]))) {
			return "$regs[1]-$regs[2]-$regs[3]";
		}
		else return date('Y-m-d');	
}
	
class GOLoadService {  

	

	function policies($values) {
		global $db;
		$str = (string)$values->xmldata;
		$xml = @simplexml_load_string($str);
		
		if ($xml) {
			$ids = array();
			foreach ($xml->row as $row) {
				$policyNumber = trim((string)($row->policyNumber));
				$id=$db->getOne('SELECT id FROM  insurance_policies WHERE product_types_id=4 AND number='.$db->quote($policyNumber));
				if (intval($id)>0)
				{
					$ids[]=$id;
					
				}
			}
			if (sizeOf($ids)>0)
			{
				$sql = 'UPDATE insurance_policies_go SET buh_date=NOW() WHERE policies_id IN ('.implode(' , ', $ids).')';
				$db->query($sql);
			}
		}
		
		$values->policiesResult ='Ok';
 	 	return $values;
	}
	
	
}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('goload.wsdl');
$Server->setClass('GOLoadService');
$Server->handle();

?>