<?
/*
 * Title: calculator class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

require_once '../../include/collector.inc.php';

// Выводим дамп переменной в файл. 
 function dumper2($obj) { 
	ob_start();
	var_dump($obj);
	$data = ob_get_clean();
	$fp = fopen("textfile.txt", "w+");
	fwrite($fp, $data);
	fclose($fp);
 }
 
class InsurancePoliciesService {  

	function getPolicies($values) {
		global $db;
		dumper2($values->conditions->string);
		if ($values->conditions->string)
		{
			if (is_array($values->conditions->string))
				$conditions=$values->conditions->string;
			else
				$conditions[]=$values->conditions->string;
 			$sql =  'SELECT b.policies_id, c.id as items_id, IF(b.insurer_person_types_id = 1, CONCAT(b.insurer_lastname, \' \', b.insurer_firstname, \' \', b.insurer_patronymicname), b.insurer_company) AS insurer, a.number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format, CONCAT(c.brand, \'/\', c.model) AS item, c.shassi, c.sign, date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetime_format, date_format(a.end_datetime, ' . $db->quote(DATE_FORMAT) . ') as end_datetime_format ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items AS c ON a.id = c.policies_id ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' ' .
                    'ORDER BY begin_datetime DESC';
            $list = $db->getAll($sql);
            $output='<?xml version="1.0" encoding="UTF-8"?>
			<resultset>
            ';

            if (is_array($list) && sizeof($list)>0)
            foreach ($list as $row)
            {
            	$output.='<kasko>';
            	$output.='<policies_id>'.$row['policies_id'].'</policies_id>';
            	$output.='<items_id>'.$row['items_id'].'</items_id>';
            	$output.='<insurer>'.$row['insurer'].'</insurer>';
            	$output.='<number>'.$row['number'].'</number>';
            	$output.='<item>'.$row['item'].'</item>';
            	$output.='<shassi>'.$row['shassi'].'</shassi>';
            	$output.='<sign>'.$row['sign'].'</sign>';
			  	$output.='<date_format>'.$row['date_format'].'</date_format>';
            	$output.='<begin_datetime_format>'.$row['begin_datetime_format'].'</begin_datetime_format>';
            	$output.='<end_datetime_format>'.$row['end_datetime_format'].'</end_datetime_format>';
            	$output.='</kasko>';
            }
            
            
            $output.='
            </resultset>';
		}
		$values->getPoliciesResult=$output;
	 	return $values;
	}
	
	function getPoliciesRisks($values) {
		global $db;
		//dumper2($values);
		$conditions[] = 'policies_id = ' . intval($values->policiesId);
		$sql =	'SELECT a.risks_id ' .
				'FROM ' . PREFIX . '_policy_risks AS a ' .
				'JOIN ' . PREFIX . '_risks AS b ON a.risks_id = b.id ' .
				'WHERE ' . implode(' AND ', $conditions);

		$res = $db->getCol($sql);
		$result='';
			foreach($res as $num) {
				$result.='<int>'.$num.'</int>'."\n";
			}			
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <getPoliciesRisksResponse xmlns="http://e-insurance.in.ua/">
      <getPoliciesRisksResult>
        '.$result.'
      </getPoliciesRisksResult>
    </getPoliciesRisksResponse>
  </soap:Body>
</soap:Envelope>';
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
function getPolicy($values) {
		global $db;
		
		$conditions[] = 'a.id = ' . intval($values->itemId);
		
		$sql =	'SELECT a.*,b.*,c.*, date_format(insurer_driver_licence_date, ' . $db->quote(DATE_FORMAT) . ') AS insurer_driver_licence_date_format, date_format(insurer_driver_licence_date, \'%Y\') AS insurer_driver_licence_date_year, date_format(insurer_driver_licence_date, \'%m\') AS insurer_driver_licence_date_month, date_format(insurer_driver_licence_date, \'%d\') AS insurer_driver_licence_date_day ' .
				'FROM ' . PREFIX . '_policies_kasko_items a JOIN ' . PREFIX . '_policies_kasko b on b.policies_id=a.policies_id JOIN ' . PREFIX . '_policies c on c.id=b.policies_id ' .
				'WHERE ' . implode(' AND ', $conditions);
		$row = $db->getRow($sql);
		
		
		$row['payments_amount']=doubleval($db->getOne('SELECT sum(amount) FROM '.PREFIX.'_policy_payments WHERE policies_id='.intval($row['policies_id'])));

		$output='<?xml version="1.0" encoding="UTF-8"?>
			<resultset>
            ';
            	$output.='<kasko>';
            	$output.='<policies_id>'.$row['policies_id'].'</policies_id>';
            	$output.='<insurerLastname>'.$row['insurer_lastname'].'</insurerLastname>';
				$output.='<insurerFirstname>'.$row['insurer_firstname'].'</insurerFirstname>';
				$output.='<insurerPatronymicname>'.$row['insurer_patronymicname'].'</insurerPatronymicname>';
				$output.='<insurerRegionsId>'.$row['insurer_regions_id'].'</insurerRegionsId>';
				$output.='<insurerArea>'.$row['insurer_area'].'</insurerArea>';
				$output.='<insurerCity>'.$row['insurer_city'].'</insurerCity>';
				$output.='<insurerStreetTypesId>'.$row['insurer_street_types_id'].'</insurerStreetTypesId>';
				$output.='<insurerStreet>'.$row['insurer_street'].'</insurerStreet>';
				$output.='<insurerHouse>'.$row['insurer_house'].'</insurerHouse>';
				$output.='<insurerFlat>'.$row['insurer_flat'].'</insurerFlat>';
				$output.='<insurerPhone>'.$row['insurer_phone'].'</insurerPhone>';
				$output.='<insurerDriverLicenceSeries>'.$row['insurer_driver_licence_series'].'</insurerDriverLicenceSeries>';
				$output.='<insurerDriverLicenceNumber>'.$row['insurer_driver_licence_number'].'</insurerDriverLicenceNumber>';
				$output.='<insurerDriverLicenceDate>'.$row['insurer_driver_licence_date_format'].'</insurerDriverLicenceDate>';
				$output.='<insurerDriverLicenceDateYear>'.$row['insurer_driver_licence_date_year'].'</insurerDriverLicenceDateYear>';
				$output.='<insurerDriverLicenceDateMonth>'.$row['insurer_driver_licence_date_month'].'</insurerDriverLicenceDateMonth>';
				$output.='<insurerDriverLicenceDateDay>'.$row['insurer_driver_licence_date_day'].'</insurerDriverLicenceDateDay>';
				
				$output.='<ownerLastname>'.$row['owner_lastname'].'</ownerLastname>';
				$output.='<ownerFirstname>'.$row['owner_firstname'].'</ownerFirstname>';
				$output.='<ownerPatronymicname>'.$row['owner_patronymicname'].'</ownerPatronymicname>';
				$output.='<ownerRegionsId>'.$row['owner_regions_id'].'</ownerRegionsId>';
				$output.='<ownerArea>'.$row['owner_area'].'</ownerArea>';
				$output.='<ownerCity>'.$row['owner_city'].'</ownerCity>';
				$output.='<ownerStreetTypesId>'.$row['owner_street_types_id'].'</ownerStreetTypesId>';
				$output.='<ownerStreet>'.$row['owner_street'].'</ownerStreet>';
				$output.='<ownerHouse>'.$row['owner_house'].'</ownerHouse>';
				$output.='<ownerFlat>'.$row['owner_flat'].'</ownerFlat>';
				$output.='<ownerPhone>'.$row['owner_phone'].'</ownerPhone>';
				
				
				
				
				$output.='<agencies_id>'.$row['agencies_id'].'</agencies_id>';
				$output.='<product_types_id>'.$row['product_types_id'].'</product_types_id>';
				$output.='<insurance_companies_id>'.$row['insurance_companies_id'].'</insurance_companies_id>';
				$output.='<owner_person_types_id>'.$row['owner_person_types_id'].'</owner_person_types_id>';
				$output.='<insurer_person_types_id>'.$row['insurer_person_types_id'].'</insurer_person_types_id>';
				$output.='<item>'.$row['item'].'</item>';
				$output.='<financial_institutions_id>'.$row['financial_institutions_id'].'</financial_institutions_id>';
				$output.='<registration_cities_id>'.$row['registration_cities_id'].'</registration_cities_id>';
				$output.='<registration_cities_title>'.$row['registration_cities_title'].'</registration_cities_title>';
				$output.='<options_deterioration_no>'.$row['options_deterioration_no'].'</options_deterioration_no>';
				$output.='<options_deductible_glass_no>'.$row['options_deductible_glass_no'].'</options_deductible_glass_no>';
				$output.='<options_first_accident>'.$row['options_first_accident'].'</options_first_accident>';
				$output.='<options_season>'.$row['options_season'].'</options_season>';
				$output.='<options_guilty_no>'.$row['options_guilty_no'].'</options_guilty_no>';
				$output.='<options_holiday>'.$row['options_holiday'].'</options_holiday>';
				$output.='<options_work>'.$row['options_work'].'</options_work>';
				$output.='<options_taxy>'.$row['options_taxy'].'</options_taxy>';
				$output.='<options_testdrive>'.$row['options_test_drive'].'</options_testdrive>';
				$output.='<options_race>'.$row['options_race'].'</options_race>';
				$output.='<options_agregate_no>'.$row['options_agregate_no'].'</options_agregate_no>';
				$output.='<options_years>'.$row['options_years'].'</options_years>';
				$output.='<owner_company>'.$row['owner_company'].'</owner_company>';
				$output.='<owner_edrpou>'.$row['owner_edrpou'].'</owner_edrpou>';
				$output.='<owner_lastname>'.$row['owner_lastname'].'</owner_lastname>';
				$output.='<owner_firstname>'.$row['owner_firstname'].'</owner_firstname>';
				$output.='<owner_patronymicname>'.$row['owner_patronymicname'].'</owner_patronymicname>';
				$output.='<owner_position>'.$row['owner_position'].'</owner_position>';
				$output.='<owner_ground>'.$row['owner_ground'].'</owner_ground>';
				$output.='<owner_dateofbirth>'.$row['owner_dateofbirth'].'</owner_dateofbirth>';
				$output.='<owner_passport_series>'.$row['owner_passport_series'].'</owner_passport_series>';
				$output.='<owner_passport_number>'.$row['owner_passport_number'].'</owner_passport_number>';
				$output.='<owner_passport_place>'.$row['owner_passport_place'].'</owner_passport_place>';
				$output.='<owner_passport_date>'.$row['owner_passport_date'].'</owner_passport_date>';
				$output.='<owner_identification_code>'.$row['owner_identification_code'].'</owner_identification_code>';
				$output.='<owner_phone>'.$row['owner_phone'].'</owner_phone>';
				$output.='<owner_email>'.$row['owner_email'].'</owner_email>';
				$output.='<owner_regions_id>'.$row['owner_regions_id'].'</owner_regions_id>';
				$output.='<owner_area>'.$row['owner_area'].'</owner_area>';
				$output.='<owner_city>'.$row['owner_city'].'</owner_city>';
				$output.='<owner_street_types_id>'.$row['owner_street_types_id'].'</owner_street_types_id>';
				$output.='<owner_street>'.$row['owner_street'].'</owner_street>';
				$output.='<owner_house>'.$row['owner_house'].'</owner_house>';
				$output.='<owner_flat>'.$row['owner_flat'].'</owner_flat>';
				$output.='<owner_bank>'.$row['owner_bank'].'</owner_bank>';
				$output.='<owner_bank_mfo>'.$row['owner_bank_mfo'].'</owner_bank_mfo>';
				$output.='<owner_bank_account>'.$row['owner_bank_account'].'</owner_bank_account>';
				$output.='<insurer>'.$row['insurer'].'</insurer>';
				$output.='<insurer_company>'.$row['insurer_company'].'</insurer_company>';
				$output.='<insurer_edrpou>'.$row['insurer_edrpou'].'</insurer_edrpou>';
				$output.='<insurer_lastname>'.$row['insurer_lastname'].'</insurer_lastname>';
				$output.='<insurer_firstname>'.$row['insurer_firstname'].'</insurer_firstname>';
				$output.='<insurer_patronymicname>'.$row['insurer_patronymicname'].'</insurer_patronymicname>';
				$output.='<insurer_position>'.$row['insurer_position'].'</insurer_position>';
				$output.='<insurer_ground>'.$row['insurer_ground'].'</insurer_ground>';
				$output.='<insurer_dateofbirth>'.$row['insurer_dateofbirth'].'</insurer_dateofbirth>';
				$output.='<insurer_passport_series>'.$row['insurer_passport_series'].'</insurer_passport_series>';
				$output.='<insurer_passport_number>'.$row['insurer_passport_number'].'</insurer_passport_number>';
				$output.='<insurer_passport_place>'.$row['insurer_passport_place'].'</insurer_passport_place>';
				$output.='<insurer_passport_date>'.$row['insurer_passport_date'].'</insurer_passport_date>';
				$output.='<insurer_driver_licence_series>'.$row['insurer_driver_licence_series'].'</insurer_driver_licence_series>';
				$output.='<insurer_driver_licence_number>'.$row['insurer_driver_licence_number'].'</insurer_driver_licence_number>';
				$output.='<insurer_driver_licence_date>'.$row['insurer_driver_licence_date'].'</insurer_driver_licence_date>';
				$output.='<insurer_identification_code>'.$row['insurer_identification_code'].'</insurer_identification_code>';
				$output.='<insurer_phone>'.$row['insurer_phone'].'</insurer_phone>';
				$output.='<insurer_email>'.$row['insurer_email'].'</insurer_email>';
				$output.='<insurer_regions_id>'.$row['insurer_regions_id'].'</insurer_regions_id>';
				$output.='<insurer_area>'.$row['insurer_area'].'</insurer_area>';
				$output.='<insurer_city>'.$row['insurer_city'].'</insurer_city>';
				$output.='<insurer_street_types_id>'.$row['insurer_street_types_id'].'</insurer_street_types_id>';
				$output.='<insurer_street>'.$row['insurer_street'].'</insurer_street>';
				$output.='<insurer_house>'.$row['insurer_house'].'</insurer_house>';
				$output.='<insurer_flat>'.$row['insurer_flat'].'</insurer_flat>';
				$output.='<insurer_bank>'.$row['insurer_bank'].'</insurer_bank>';
				$output.='<insurer_bank_mfo>'.$row['insurer_bank_mfo'].'</insurer_bank_mfo>';
				$output.='<insurer_bank_account>'.$row['insurer_bank_account'].'</insurer_bank_account>';
				$output.='<number>'.$row['number'].'</number>';
				$output.='<date>'.$row['date'].'</date>';
				$output.='<begin_datetime>'.$row['begin_datetime'].'</begin_datetime>';
				$output.='<end_datetime>'.$row['end_datetime'].'</end_datetime>';
				$output.='<interrupt_datetime>'.$row['interrupt_datetime'].'</interrupt_datetime>';
				$output.='<comment>'.$row['comment'].'</comment>';
				$output.='<assured_title>'.$row['assured_title'].'</assured_title>';
				$output.='<assured_identification_code>'.$row['assured_identification_code'].'</assured_identification_code>';
				$output.='<assured_address>'.$row['assured_address'].'</assured_address>';
				$output.='<assured_phone>'.$row['assured_phone'].'</assured_phone>';
				$output.='<price>'.(doubleval($row['car_price'])+doubleval($row['price_equipment'])).'</price>';
				$output.='<amount>'.$row['amount'].'</amount>';
				$output.='<payment_statuses_id>'.$row['payment_statuses_id'].'</payment_statuses_id>';
				$output.='<car_types_id>'.$row['car_types_id'].'</car_types_id>';
				$output.='<brands_id>'.$row['brands_id'].'</brands_id>';
				$output.='<brand>'.$row['brand'].'</brand>';
				$output.='<models_id>'.$row['models_id'].'</models_id>';
				$output.='<model>'.$row['model'].'</model>';
				$output.='<shassi>'.$row['shassi'].'</shassi>';
				$output.='<sign>'.$row['sign'].'</sign>';
				$output.='<year>'.$row['year'].'</year>';
				$output.='<deductibles_value0>'.$row['deductibles_value0'].'</deductibles_value0>';
				$output.='<deductibles_absolute0>'.$row['deductibles_absolute0'].'</deductibles_absolute0>';
				$output.='<deductibles_value1>'.$row['deductibles_value1'].'</deductibles_value1>';
				$output.='<deductibles_absolute1>'.$row['deductibles_absolute1'].'</deductibles_absolute1>';
				$output.='<payments_amount>'.$row['payments_amount'].'</payments_amount>';
            	$output.='</kasko>';
            $output.='
            </resultset>';
		$values->getPolicyResult=$output;
	 	return $values;
	}
	
	
	function getPolicyPaymentAmount($values) {
		global $db;
		$data['policies_id'] =  intval($values->policiesId);
		$row['payments_amount']=doubleval($db->getOne('SELECT sum(amount) FROM '.PREFIX.'_policy_payments WHERE policies_id='.intval($data['policies_id'])));
		$values->getPolicyPaymentAmountResult=doubleval($row['payments_amount']);
	 	return $values;
	}
}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('insurancepolicies.wsdl');
$Server->setClass('InsurancePoliciesService');
$Server->handle();

?>