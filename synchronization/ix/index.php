<?
/*
 * Title:  class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

require_once '../../include/collector.inc.php';
require_once 'Products.class.php';
require_once 'Agencies.class.php';
require_once 'Users/Agents.class.php';
require_once 'Products.class.php';
require_once 'Products/KASKO.class.php';
require_once 'Policies.class.php';
require_once 'Policies/KASKO.class.php';
require_once 'PolicyDocuments.class.php';
require_once 'FinancialInstitutions.class.php';
require_once 'InsurancePeriods.class.php';

class SynchronizationService {  

	function synhronize($values) {
		global $db,$Authorization,$Log;
		
		switch ($values->type)
		{
			case 'Policies_KASKO': //синхронизация полисов КАСКО
				
				$data = unserialize((string)$values->data);
				$_SESSION['auth']=$data['auth'];
				$Authorization=new Authorization($data);
				$Log->clear();
				if (!$data['number']) return $values;
				$data['id'] =  $data['policiesId'] = $db->getOne('SELECT id FROM '.PREFIX.'_policies WHERE number='.$db->quote($data['number']));

				$Policies = Policies::factory($data, 'KASKO'); 
					
				$Policies->permissions['add'] = true;
				$Policies->permissions['edit'] = true;
				
				$available_itemsId=$db->getCol('SELECT id FROM '.PREFIX.'_policies_kasko_items WHERE policiesId='.intval($data['id']));
				
				
				//обнулить id машин и заполнить текущими если есть
				if (is_array( $data['items']) && sizeof($data['items'])>0)
				{

					foreach($data['items'] as $i=>$item)
					{
						$data['items'][$i]['id']=0;
						if (is_array($available_itemsId) && isset($available_itemsId[$i]))
							$data['items'][$i]['id']=$available_itemsId[$i];
					}
				}
				
				
				//$Policies->dumpdata=serialize($Authorization->data);	
				if (intval($data['id']))
					$Policies->update($data,false,false);
				else
					$Policies->insert($data,false,false);
				$values->synhronizeResult=$Policies->dumpdata;
				
				break;
			
		}
		return $values;
	}

	
}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('synhronize.wsdl');
$Server->setClass('SynchronizationService');
$Server->handle();

?>