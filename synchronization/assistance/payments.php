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

require_once $Smarty->_get_plugin_filepath('shared','make_timestamp');


function getMysqlDate($date)
{
		if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date, $regs)
			&& checkdate ( intval($regs[2]) , intval($regs[3]) , intval($regs[1]))) {
			return "$regs[1]-$regs[2]-$regs[3]";
		}
		else return date('Y-m-d');	
}
	
class AssistancePaymentsService {  

	

	function getPaymentsByNumber($values) {
		global $Kasko,$db;
		$data['number']=trim($values->number);
		$list = $db->getAll('SELECT * FROM '.PREFIX.'_accident_payments_calendar WHERE payment_types_id<>5 AND number'.(strpos ( $data['number'] , '%' )>0 ? ' LIKE ' : '=').$db->quote($data['number']));
		$result = '<payments>'."\n";
		
		if (is_array($list))
		foreach($list as $row)
		{
			$result .= '<payment>'."\n";

			$result .= '<number>'.$row['number'].'</number>'."\n";
			$result .= '<recipient_types_id>'.$row['recipient_types_id'].'</recipient_types_id>'."\n";
			$result .= '<recipients_id>'.$row['recipients_id'].'</recipients_id>'."\n";
			$result .= '<recipient>'.$row['payment_recipient'].'</recipient>'."\n";
			$result .= '<recipient_identification_code>'.$row['payment_identification_code'].'</recipient_identification_code>'."\n";
			$result .= '<recipient_bank_account>'.$row['payment_bank_account'].'</recipient_bank_account>'."\n";
			$result .= '<recipient_bank>'.$row['payment_bank'].'</recipient_bank>'."\n";
			$result .= '<recipient_bank_mfo>'.$row['payment_bank_mfo'].'</recipient_bank_mfo>'."\n";
			$result .= '<recipient_bank_edrpou>'.$row['bank_edrpou'].'</recipient_bank_edrpou>'."\n";
			$result .= '<recipient_card_number>'.$row['payment_bank_card_number'].'</recipient_card_number>'."\n";
			$result .= '<payment_description>'.$row['payment_basis'].'</payment_description>'."\n";
			$result .= '<amount>'.$row['amount'].'</amount>'."\n";
			$result .= '<payment_statuses_id>'.$row['payment_statuses_id'].'</payment_statuses_id>'."\n";
			$result .= '<basis>'.$row['basis'].'</basis>'."\n";
			$result .= '<created>'.$row['created'].'</created>'."\n";
			$result .= '<modified>'.$row['modified'].'</modified>'."\n";
			
			$result .= '</payment>'."\n";
		}
		$result .= '</payments>'."\n";
		$values->getPaymentsByNumberResult =$result;
 	 	return $values;
	}
	
	function addAssistancePayments($values) {
		global $Kasko,$db,$Templates;
		$payments_str=$values->payments;
$handle = fopen('./payments_dump1.txt', 'a');
	fwrite($handle, $payments_str) ;
    fclose($handle);		

//exit;
		$xml = @simplexml_load_string($payments_str);
		if ($xml) {
			//удаление
			foreach ($xml->row as $row) {
					$codEA=trim((string)$row->codEA);
					$bdat=smarty_make_timestamp((string)$row->docDate);
					$y=date ('Y', $bdat );
					$paymentType=(int)$row->paymentType;
					
					if (strlen($codEA)>0 && $paymentType!=2 && $paymentType!=6)
					{
						$paymentCalendarId=intval($db->getOne('SELECT id FROM '.PREFIX.'_accident_payments_calendar WHERE number ='.$db->quote($codEA).' '));
						if ($paymentCalendarId)
						{
							$sql='DELETE FROM '.PREFIX.'_accident_payments  WHERE payments_calendar_id ='.intval($paymentCalendarId).' AND number ='.$db->quote($row->docNumber).' AND YEAR(date)='.intval($y);
							$db->query($sql);
							
						}
					}
					if ($paymentType == 2)
					{
						$acts_id=intval($db->getOne('SELECT id FROM '.PREFIX.'_accidents_acts WHERE number='.$db->quote($codEA).' '));
						if ($acts_id)
						{
							$sql='DELETE FROM '.PREFIX.'_accident_payments  WHERE payments_calendar_id IN (SELECT id FROM '.PREFIX.'_accident_payments_calendar WHERE payment_types_id = 5 AND acts_id='.intval($acts_id).')';
							$db->query($sql);
						}
					}
					
			}
			
			//добавление
			
			foreach ($xml->row as $row) {
					$codEA=trim((string)$row->codEA);
					$paymentType=(int)$row->paymentType;
					if ($paymentType==6 && strlen($codEA)>0)
					{//платеж по страховому акту из банковской выписки
						//найти страховой акт с искомым номером
						$acts_id = intval($db->getOne('SELECT id FROM '.PREFIX.'_accidents_acts WHERE number='.$db->quote($codEA).' '));


						if ($acts_id>0)
						{
							$calendar = $db->getAll('SELECT * FROM insurance_accident_payments_calendar WHERE acts_id = '.intval($acts_id).' AND payment_types_id=6');
							if (is_array($calendar) && sizeof($calendar)>0)
							{
								if (sizeof($calendar)==1)
								{//однозначное совпадение
									$calendar = $calendar[0];
									if ($calendar['payment_statuses_id']!=15/*3*/) { //!!!только не оплаченые чтобы платежи после возврата не попадали
										$pid = $db->getOne('SELECT id FROM insurance_accident_payments WHERE payments_calendar_id='.intval($calendar['id']).' AND number='.$db->quote($row->docNumber).' ');


										if (intval($pid )>0)
										{

											$sql='UPDATE insurance_accident_payments SET amount='.$db->quote($row->amount).',date ='.$db->quote($row->docDate).',created=NOW(),modified=NOW() WHERE id='.intval($pid);
											$db->query($sql);
											
										}
										else
										{
											$sql='INSERT INTO '.PREFIX.'_accident_payments SET accidents_id='.intval($calendar['accidents_id']).',payments_calendar_id ='.intval($calendar['id']).',number ='.$db->quote($row->docNumber).',amount ='.$db->quote($row->amount).',date ='.$db->quote($row->docDate).',created=NOW(),modified=NOW()';
											$db->query($sql);
										}
										Accidents::setPaymentStatus(intval($calendar['accidents_id']));	
									}	
								}
								else //неоднозначно сверка по суммам
								{
									$calendarList = $calendar;
									foreach($calendarList as $calendar)
									{
										$diff =intval($row->amount)-intval($calendar['amount']);
										if ($diff==0 )  //нашли
										{
											if ($calendar['payment_statuses_id']!=3) { //!!!только не оплаченые чтобы платежи после возврата не попадали										
												$pid = $db->getOne('SELECT id FROM insurance_accident_payments WHERE payments_calendar_id='.intval($calendar['id']).' AND number='.$db->quote($row->docNumber).' ');
												if (intval($pid )>0)
												{
													$db->query('UPDATE insurance_accident_payments SET amount='.$db->quote($row->amount).',date ='.$db->quote($row->docDate).',created=NOW(),modified=NOW() WHERE id='.intval($pid));
												}
												else
												{
													$sql='INSERT INTO '.PREFIX.'_accident_payments SET accidents_id='.intval($calendar['accidents_id']).',payments_calendar_id ='.intval($calendar['id']).',number ='.$db->quote($row->docNumber).',amount ='.$db->quote($row->amount).',date ='.$db->quote($row->docDate).',created=NOW(),modified=NOW()';
													$db->query($sql);
												}
												Accidents::setPaymentStatus(intval($calendar['accidents_id']));	
											}	
										}
									}
								}
							}
						}
						continue;
					}
					
					if (strlen($codEA)>0 && $paymentType!=2  && $paymentType!=6)
					{
						//платим по платежному поручению все кроме 6-го типа Страх видшкодування его нужно платить из банковской выписки
						$payment = $db->getRow('SELECT id,accidents_id,payment_types_id FROM '.PREFIX.'_accident_payments_calendar WHERE payment_types_id<>6 AND number ='.$db->quote($codEA).' ');
						$paymentCalendarId = intval($payment['id']);
						if ($paymentCalendarId)
						{
							$sql='INSERT INTO '.PREFIX.'_accident_payments SET accidents_id='.intval($payment['accidents_id']).',payments_calendar_id ='.intval($paymentCalendarId).',number ='.$db->quote($row->docNumber).',amount ='.$db->quote($row->amount).',date ='.$db->quote($row->docDate).',created=NOW(),modified=NOW()';
							$db->query($sql);
							Accidents::setPaymentStatus(intval($payment['accidents_id']));	
						}
						
					}
					if ($paymentType == 2) //Взаимозачеты 5-тип = Частина страх премии
					{
						$acts_id = intval($db->getOne('SELECT id FROM '.PREFIX.'_accidents_acts WHERE number='.$db->quote($codEA).' '));
						//_dump('SELECT id FROM '.PREFIX.'_accidents_kasko_acts WHERE number='.$db->quote($codEA));exit;
						if ($acts_id)
						{
							$payment = $db->getRow('SELECT id,accidents_id FROM '.PREFIX.'_accident_payments_calendar WHERE payment_types_id = 5 AND acts_id='.intval($acts_id));
							$paymentCalendarId = intval($payment['id']);
							if ($paymentCalendarId) {
								$sql='INSERT INTO '.PREFIX.'_accident_payments SET accidents_id='.intval($payment['accidents_id']).',payments_calendar_id ='.intval($paymentCalendarId).',number ='.$db->quote($row->docNumber).',amount ='.$db->quote($row->amount).',date ='.$db->quote($row->docDate).',created=NOW(),modified=NOW()';
								$db->query($sql);
								Accidents::setPaymentStatus(intval($payment['accidents_id']));
							}
						}
					}
					
			}
			
			
		}
		$values->addPaymentsResult ='OK';
 	 	return $values;
	}

}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('payments.wsdl');
$Server->setClass('AssistancePaymentsService');
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