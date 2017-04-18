<?

ini_set('soap.wsdl_cache_enabled', '0');
require_once '../../include/collector.inc.php';
require_once 'XML2Array.php';
function _dump_file($val) {
	$res = var_export($val, true);
	$handle = fopen('dump.dat', 'a');
	fwrite($handle, $res) ;
	fclose($handle);
}
/*
<request>
<product_type>КАСКО</product_type>
<agreement_number>202.13.2196135</agreement_number>
<insured_company></insured_company>
<insured_lastname></insured_lastname>
<insured_firstname></insured_firstname>
<insured_patronymic></insured_patronymic>
<vehicle_number></vehicle_number>
<vehicle_vin></vehicle_vin>
</request>
*/	
function getAgreements($values) { 
  global $db;
	$request=(string)$values->request;

	$login=(string)$values->login;
	$password=(string)$values->password;
	if ($login!='assistance' || $password!='E4f5tge5Ds1')
	{
		throw new Exception("Validation Failed"); 
	}

	$data = XML2Array::createArray($request);
	if (!isset($data['request']))
		throw new Exception("Invalid XML request");
	$data = $data['request'];
//	_dump_file($data);
	if (!isset($data['product_type']) || strlen($data['product_type'])<3)
		throw new Exception("Product type not specified");
	$allowed_product_types = array('ОСЦПВ','КАСКО')	;
	if (!in_array($data['product_type'],$allowed_product_types))
		throw new Exception("Product type is not allowed");
	$conditions = array();
	if ($data['agreement_number'] && strlen($data['agreement_number'])>3)
		$conditions[]='a.number like '.$db->quote('%'.$data['agreement_number'].'%');
	if ($data['insured_company'] && strlen($data['insured_company'])>3)		
	{
		if ($data['product_type'] =='ОСЦПВ')
			$conditions[]='b.insurer_lastname like '.$db->quote('%'.$data['insured_company'].'%');
		else
			$conditions[]='b.insurer_company like '.$db->quote('%'.$data['insured_company'].'%');
	}	
	
	if ($data['insured_lastname'] && strlen($data['insured_lastname'])>3)		
	{
		$conditions[]='b.insurer_lastname like '.$db->quote('%'.$data['insured_lastname'].'%');
	}
	
	if ($data['insured_firstname'] && strlen($data['insured_firstname'])>3)		
	{
		$conditions[]='b.insurer_firstname like '.$db->quote('%'.$data['insured_firstname'].'%');
	}
	
	if ($data['insured_patronymic'] && strlen($data['insured_patronymic'])>3)		
	{
		$conditions[]='b.insurer_patronymicname like '.$db->quote('%'.$data['insured_patronymic'].'%');
	}
	
	if ($data['vehicle_vin'] && strlen($data['vehicle_vin'])>3)		
	{
		if ($data['product_type'] =='ОСЦПВ')
			$conditions[]='b.shassi like '.$db->quote('%'.$data['vehicle_vin'].'%');
		if ($data['product_type'] =='КАСКО')
			$conditions[]='c.shassi like '.$db->quote('%'.$data['vehicle_vin'].'%');
	}
	if ($data['vehicle_number'] && strlen($data['vehicle_number'])>3)		
	{
		if ($data['product_type'] =='ОСЦПВ')
			$conditions[]='b.sign like '.$db->quote('%'.$data['vehicle_number'].'%');
		if ($data['product_type'] =='КАСКО')
			$conditions[]='c.sign like '.$db->quote('%'.$data['vehicle_number'].'%');
	}
	 
	if (sizeof($conditions)==0)
		throw new Exception("Search conditions not specified");
	$sql = 'SELECT '.($data['product_type'] =='КАСКО' ? 'c.*,' : '').'b.*,a.*,d.title as product_type_title,e.title as region_title FROM insurance_policies a ';
	
	if ($data['product_type'] =='ОСЦПВ')
	{
		$sql .= ' JOIN insurance_policies_go b on b.policies_id=a.id ';
	}
	if ($data['product_type'] =='КАСКО')
	{
		$sql .= ' JOIN insurance_policies_kasko b on b.policies_id=a.id ';
		$sql .= ' JOIN insurance_policies_kasko_items c on c.policies_id=a.id ';
	}
	
	$sql .= ' JOIN insurance_product_types d on a.product_types_id=d.id ';
	$sql .= ' LEFT JOIN insurance_regions e on b.insurer_regions_id=e.id ';
	
	
	$sql.= ' WHERE ' . implode(' AND ', $conditions).' ORDER BY a.id DESC LIMIT 30';
	
	$list = $db->getAll($sql);
	
	$result='<agreements>';
	if ($list && sizeof($list))
	{
		foreach($list as $row)
		{
			$result.='<agreement>';
			$result.='
			<insurer>ТДВ &quot;Експрес Страхування&quot;</insurer>
			<product_types>'.$row['product_type_title'].'</product_types>
			<agreement_number>'.$row['number'].'</agreement_number>
			<agreement_date>'.$row['date'].'</agreement_date>
			<agreement_begin_date>'.$row['begin_datetime'].'</agreement_begin_date>
			<agreement_end_date>'.$row['end_datetime'].'</agreement_end_date>
			<vehicle_brand>'.$row['brand'].'</vehicle_brand>
			<vehicle_model>'.$row['model'].'</vehicle_model>
			<vehicle_year>'.$row['year'].'</vehicle_year>
			<vehicle_vin>'.$row['shassi'].'</vehicle_vin>
			<vehicle_number>'.$row['sign'].'</vehicle_number>
			<insured_person_type>'.($row['insurer_person_types_id']==1 ? 'Фізична':'Юридична').'</insured_person_type>
			<insured_company>'.($row['insurer_person_types_id']==2 ? ($data['product_type'] =='ОСЦПВ' ? $row['insurer_lastname'] : $row['insurer_company']):'').'</insured_company>
			<insured_lastname>'.($row['insurer_person_types_id']!=2 ? $row['insurer_lastname'] : '' ).'</insured_lastname>
			<insured_firstname>'.($row['insurer_person_types_id']!=2 ? $row['insurer_firstname'] : '' ).'</insured_firstname>
			<insured_patronymic>'.($row['insurer_person_types_id']!=2 ? $row['insurer_patronymicname'] : '' ).'</insured_patronymic>
			<insured_identification_code>'.($row['insurer_person_types_id']!=2 ? $row['insurer_identification_code'] : $row['insurer_edrpou'] ).'</insured_identification_code>
			<insured_region>'.$row['region_title'].'</insured_region>
			<insured_area>'.$row['insurer_area'].'</insured_area>
			<insured_settlement>'.$row['insurer_city'].'</insured_settlement>
			<insured_street>'.$row['insurer_street'].'</insured_street>
			<insured_building>'.$row['insurer_house'].'</insured_building>
			<insured_housing_unit>'.$row['insurer_flat'].'</insured_housing_unit>
			<insured_phone>'.$row['insurer_phone'].'</insured_phone>
			';
			$result.='</agreement>';
		}
	}
	$result.='</agreements>';
	
	$values->getAgreementsResult=$result;
  return $values; 
} 



	if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST') {
    _dump_file($HTTP_RAW_POST_DATA);
//		$server = new SoapServer("policies.wsdl"); 
  //      		$server->addFunction("getAgreements"); 
	//	        $server->handle(); 
	//	        exit; 

		require('soap-server-wsse.php'); 

		$soap = new DOMDocument(); 
		$soap->load('php://input'); 
		$server = new SoapServer("policies.wsdl"); 

		$s = new WSSESoapServer($soap); 
		try { 
//		    if ($s->process()) { 
        		$server->addFunction("getAgreements"); 
		        $server->handle($s->saveXML()); 
		        exit; 
//		    } 
		} catch (Exception $e) { 
			$server->fault(8, $e->getMessage()); 
		} 
		$server->fault(8, "Invalid request"); 
        

	} else {
	     $SoapServer = new SoapServer("policies.wsdl"); 
		 $SoapServer->handle();
	}



?>
