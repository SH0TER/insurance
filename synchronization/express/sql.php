<? 
require_once '../../include/collector.inc.php';

ini_set('soap.wsdl_cache_enabled', 0);
class SQL { 

	function getAll($values) {
		global $db;
		if ($_SERVER['REMOTE_ADDR']!='62.149.7.189') exit;
		$sql=trim($values->sql);
		$list = $db->getAll($sql);
		$res='<rows>'."\n";
		if (is_array($list)) {
			
			foreach($list as $row) {
				$res.='<row>'."\n";
				foreach($row as $k=>$v) {
					$res.='<'.$k.'>'.$v.'</'.$k.'>'."\n";
				}
				$res.='</row>'."\n";
			}
			
		}
		
		$res.='</rows>'."\n";
		$values->getAllResult = $res;
	 	return $values;
	}
	
	function execUpdate($values) {
		global $db;
		if ($_SERVER['REMOTE_ADDR']!='62.149.7.189') exit;
		$sql=trim($values->sql);
		$db->query($sql);
		$values->execUpdateResult = 'Ok';
	 	return $values;
	}

}


$Server = new SoapServer('sql.wsdl');
$Server->setClass('SQL');
$Server->handle();
?>