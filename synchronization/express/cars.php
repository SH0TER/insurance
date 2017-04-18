<?
/*
 * Title: calculator class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

require_once '../../include/collector.inc.php';

class CarsService {  

	function get($values) {
		global $db;



		$sql =	'SELECT a.id as brand_id, b.id as model_id, a.title as brand,b.title as model,b.titleZAZ as modelZAZ,b.short_title as modelShort ' .
				'FROM ' . PREFIX . '_car_brands  as a ' .
				'JOIN ' . PREFIX . '_car_models  as b ON a.id = b.car_brands_id ' .
				'WHERE a.synchronize=1 AND b.synchronize=1 '.
				'ORDER BY a.title,b.title';
		$res = $db->query($sql);

		while ($res->fetchInto($row)) {
				$row['brandId'] = $row['brand_id'];
				$row['modelId'] = $row['model_id'];
				unset($row['brand_id']);
				unset($row['model_id']);
				$list[] = $row;
		}

		return $list;
	}

	
}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('cars.wsdl');
$Server->setClass('CarsService');
$Server->handle();

?>