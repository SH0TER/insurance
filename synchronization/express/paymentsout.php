<?
/*
 *
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
	

class PaymentsOut {  

	function getPayment($values) {
		global $db;
		$number=trim($values->number);
		
		$sql='SELECT * FROM '.PREFIX.'_payments_calendar WHERE number='.$db->quote($number).' ORDER BY id DESC';
		$row=$db->getRow($sql);
		ereg ("([0-9]{11,18})", $row['comment'], $regs);
		$row['agencyEDRPOU']=$regs[1];

		$output='<row>
		<number>'.$row['number'].'</number>
		<contragent>'.$row['contragent'].'</contragent>
		<policy_number>'.$row['policy_number'].'</policy_number>
		<personTypeId>'.$row['person_types_id'].'</personTypeId>
		<paymentTypeId>'.$row['payment_types_id'].'</paymentTypeId>
		<account_number>'.$row['account_number'].'</account_number>
		<mfo>'.$row['mfo'].'</mfo>
		<bank>'.$row['bank'].'</bank>
		<code>'.$row['code'].'</code>	
		<amount>'.$row['amount'].'</amount>
		<comment>'.$row['comment'].'</comment>
		<aktAmount>'.$row['akt_amount'].'</aktAmount>
		<agentLastName>'.$row['agents_lastname'].'</agentLastName>
		<agentFirstName>'.$row['agents_firstname'].'</agentFirstName>
		<agentPatronymicName>'.$row['agents_patronymicname'].'</agentPatronymicName>
		<agentIdentificationCode>'.$row['agents_identification_code'].'</agentIdentificationCode>
		<agreementNumber>'.$row['agreement_number'].'</agreementNumber>
		<agreementDate>'.$row['agreement_date'].'</agreementDate>
		<agencyName>'.$row['agencies_name'].'</agencyName>
		<agencyEDRPOU>'.$row['agencies_edrpou'].'</agencyEDRPOU>
		<aktDate>'.$row['akt_date'].'</aktDate>
		'.PaymentsOut::getAmountsByProdTypes($row['id']).'
		</row>';
		
		
		
		
		
		$values->getPaymentResult=$output;
	 	return $values;
	}
	
	function getPaymentByDates($values)
	{
		global $db;
		$data['from']=$db->quote(getMysqlDate($values->begin). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($values->end). ' 23:59:59');
		
		$sql='SELECT * FROM '.PREFIX.'_payments_calendar WHERE akt_date between '.$data['from'].' AND '.$data['to'].' AND payment_types_id IN (1,2,3,5,6)';
		$list=$db->getAll($sql);
		$output='<resultset>';
		foreach ($list as $i=>$row) {
			$output.='<row>
			<number>'.$row['number'].'</number>
			<contragent>'.$row['contragent'].'</contragent>
			<policy_number>'.$row['policy_number'].'</policy_number>
			<personTypeId>'.$row['person_types_id'].'</personTypeId>
			<paymentTypeId>'.$row['payment_types_id'].'</paymentTypeId>
			<account_number>'.$row['account_number'].'</account_number>
			<mfo>'.$row['mfo'].'</mfo>
			<bank>'.$row['bank'].'</bank>
			<code>'.$row['code'].'</code>	
			<amount>'.$row['amount'].'</amount>
			<comment>'.$row['comment'].'</comment>
			<aktAmount>'.$row['akt_amount'].'</aktAmount>
			<agentLastName>'.$row['agents_lastname'].'</agentLastName>
			<agentFirstName>'.$row['agents_firstname'].'</agentFirstName>
			<agentPatronymicName>'.$row['agents_patronymicname'].'</agentPatronymicName>
			<agentIdentificationCode>'.$row['agents_identification_code'].'</agentIdentificationCode>
			<agreementNumber>'.$row['agreement_number'].'</agreementNumber>
			<agreementDate>'.$row['agreement_date'].'</agreementDate>
			<agencyName>'.$row['agencies_name'].'</agencyName>
			<agencyEDRPOU>'.$row['agencies_edrpou'].'</agencyEDRPOU>
			<aktDate>'.$row['akt_date'].'</aktDate>
			'.PaymentsOut::getAmountsByProdTypes($row['id']).'
			</row>';
		}
		$output.='</resultset>';
		
		$values->getPaymentByDatesResult=$output;
	 	return $values;
	}
	
	function getAmountsByProdTypes($id)
	{
		global $db;
		$sql='SELECT product_types_id,value FROM '.PREFIX.'_payments_amounts WHERE payments_id='.intval($id);
		$amounts=$db->getAssoc($sql);
		$result='
		<kaskoAmount>'.doubleval($amounts[PRODUCT_TYPES_KASKO]).'</kaskoAmount>
		<goAmount>'.doubleval($amounts[PRODUCT_TYPES_GO]).'</goAmount>
		<dgoAmount>'.doubleval($amounts[PRODUCT_TYPES_DGO]).'</dgoAmount>
		<nsAmount>'.doubleval($amounts[PRODUCT_TYPES_NS]).'</nsAmount>
		<consultationAmount>'.doubleval($amounts[1]).'</consultationAmount>
		';
		
		return $result;
	}
	
}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('paymentsout.wsdl');
$Server->setClass('PaymentsOut');
$Server->handle();

?>