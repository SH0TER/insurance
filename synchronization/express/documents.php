<?
/*
 *
 */

require_once '../../include/collector.inc.php';

//express credit
	define('DOCUMENTS_TYPE_INSURANCE_AGREEMENT_APPLICATION',			1);
	define('DOCUMENTS_TYPE_INSURANCE_AGREEMENT_APPLICATION_NOT_CREDIT',	14);
	define('DOCUMENTS_TYPE_INSURANCE_AGREEMENT_APPLICATION_LEASING',	15);
	define('DOCUMENTS_TYPE_INSURANCE_QUESTIONNAIRE_KASKO',				36);

    define('DOCUMENTS_TYPE_INSURANCE_AGREEMENT_KASKO',					2);
	define('DOCUMENTS_TYPE_INSURANCE_AGREEMENT_KASKO_NOT_CREDIT',		13);
    define('DOCUMENTS_TYPE_INSURANCE_POLICY_KASKO',						3);

    define('DOCUMENTS_TYPE_INSURANCE_BILL_KASKO',						4);
    define('DOCUMENTS_TYPE_INSURANCE_BILL_KASKO_LEASING',				16);
    define('DOCUMENTS_TYPE_INSURANCE_POLICY_GO1',						5);
    define('DOCUMENTS_TYPE_INSURANCE_POLICY_GO2',						10);
    define('DOCUMENTS_TYPE_INSURANCE_POLICY_GO3',						35);
    define('DOCUMENTS_TYPE_INSURANCE_BILL_GO',							6);
    define('DOCUMENTS_TYPE_PACKAGE_AUTO_SHOW',							7);

//e-insurance
	define('INSURANCE_AGREEMENT_APPLICATION',			1);
	define('INSURANCE_AGREEMENT_KASKO',					2);
	define('INSURANCE_BILL_KASKO',						3);
	define('INSURANCE_POLICY_GO1',						4);
	define('INSURANCE_POLICY_GO2',						5);
	define('INSURANCE_POLICY_GO3',						68);
    define('INSURANCE_BILL_GO',							6);
	define('INSURANCE_PACKAGE_AUTO_SHOW',				25);
	define('POLICY_DOCUMENT_TYPES_KASKO_QUESTIONNAIRE', 69);
	
class DocumentsService {  

	function getDocumentUrl($values) {
		global $db;
		$policiesId=$values->policiesId;
		$typesId=$values->typesId;
		
		$insurance_documents=array(
		DOCUMENTS_TYPE_INSURANCE_AGREEMENT_APPLICATION =>INSURANCE_AGREEMENT_APPLICATION,
		DOCUMENTS_TYPE_INSURANCE_AGREEMENT_APPLICATION_NOT_CREDIT =>INSURANCE_AGREEMENT_APPLICATION,
		DOCUMENTS_TYPE_INSURANCE_AGREEMENT_APPLICATION_LEASING =>INSURANCE_AGREEMENT_APPLICATION,
	    DOCUMENTS_TYPE_INSURANCE_AGREEMENT_KASKO =>INSURANCE_AGREEMENT_KASKO,
	 	DOCUMENTS_TYPE_INSURANCE_AGREEMENT_KASKO_NOT_CREDIT =>INSURANCE_AGREEMENT_KASKO,
		DOCUMENTS_TYPE_INSURANCE_BILL_KASKO =>INSURANCE_BILL_KASKO,
    	DOCUMENTS_TYPE_INSURANCE_BILL_KASKO_LEASING =>INSURANCE_BILL_KASKO,
    	DOCUMENTS_TYPE_INSURANCE_POLICY_GO1 =>INSURANCE_POLICY_GO1,
    	DOCUMENTS_TYPE_INSURANCE_POLICY_GO2 =>INSURANCE_POLICY_GO2,
    	DOCUMENTS_TYPE_INSURANCE_POLICY_GO3 =>INSURANCE_POLICY_GO3,
    	DOCUMENTS_TYPE_INSURANCE_QUESTIONNAIRE_KASKO =>POLICY_DOCUMENT_TYPES_KASKO_QUESTIONNAIRE,
    	DOCUMENTS_TYPE_INSURANCE_BILL_GO =>INSURANCE_BILL_GO,
    	DOCUMENTS_TYPE_PACKAGE_AUTO_SHOW =>INSURANCE_PACKAGE_AUTO_SHOW);

		if ($insurance_documents[$typesId]==INSURANCE_BILL_KASKO || $insurance_documents[$typesId]==INSURANCE_BILL_GO)
		{
			$conditions[] = 'policies_id = ' . intval($policiesId);
			$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_policy_payments_calendar  ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ORDER BY date ASC' ;

			$id = $db->getOne($sql);
			$file = array(
							'id'			=> $id,
							'position' 		=> 0,
							'languageCode=' => '');
			$url = 'https://'.$_SERVER['SERVER_NAME'].'/index.php?do=PolicyPaymentsCalendar|downloadFileInWindow&file=' . urlencode(serialize($file));
			$values->result=$url;
		    return $values;
		}
		
		$conditions[] = 'policies_id = ' . intval($policiesId);
		$conditions[] = 'product_document_types_id = ' . intval($insurance_documents[$typesId]);

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_policy_documents ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' ;

		$id = $db->getOne($sql);
		$file = array(
							'id'			=> $id,
							'position' 		=> 0,
							'languageCode=' => '');
							
		$url = 'https://'.$_SERVER['SERVER_NAME'].'/index.php?do=PolicyDocuments|downloadFileInWindow&file=' . urlencode(serialize($file));
		$values->result=$url;
	 return $values;
	}
	
}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('documents.wsdl');
$Server->setClass('DocumentsService');
$Server->handle();

?>