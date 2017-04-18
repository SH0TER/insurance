<?	

	ini_set('soap.wsdl_cache_enabled', '0');
	require_once '../../include/collector.inc.php';
	require_once 'Products.class.php';
	require_once 'Policies.class.php';
	require_once 'Products/KASKO.class.php';
	require_once 'Policies/KASKO.class.php';
	require_once 'Policies/GO.class.php';
	require_once 'PaymentsCalendar.class.php';
	require_once $Smarty->_get_plugin_filepath('shared','make_timestamp');
	
	$SoapServer = new SoapServer(null, array('uri' => "http://e-insurance.in.ua/"));
	$Kasko=new Policies_KASKO($data);
	$Go=new Policies_GO($data);


	
	function getMysqlDate($date)
	{
		if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date, $regs)
			&& checkdate ( intval($regs[2]) , intval($regs[3]) , intval($regs[1]))) {
			return "$regs[1]-$regs[2]-$regs[3]";
		}
		else return date('Y-m-d');	
	}
	
	function addPayments($inputstr)
    {
		global $Kasko,$db,$Log,$Templates,$Go;

	$handle = fopen('payments_dump.txt', 'a+');
	fwrite($handle, $inputstr) ;
    fclose($handle);
//exit;

$fp = fopen("textfile.txt", "a+");
	fwrite($fp, $inputstr);
	fclose($fp);


	$xml = @simplexml_load_string($inputstr);

/*$fp = fopen("textfile2.txt", "a+");
	fwrite($fp, $inputstr);
	fclose($fp);*/

	if ($xml) {
	
		//delete process
		foreach ($xml->row as $row) {
			$bdat=smarty_make_timestamp((string)$row->docDate);
			if ($bdat<mktime (0, 0, 0, 9, 1,2009 )) continue;
				$y=date ('Y', $bdat );
				
				if (intval($row->paymentType)==2)
				{//расход денег
					/*$codeIE=(string)$row->codEI;
					if (strlen($codeIE)>0)
					{
						$paymentCalendarId=intval($db->getOne('SELECT id FROM '.PREFIX.'_payments_calendar WHERE number ='.$db->quote($codeIE).' '));
						if ($paymentCalendarId)
						{
							$sql='DELETE FROM '.PREFIX.'_payments  WHERE payments_id ='.intval($paymentCalendarId).' AND number ='.$db->quote($row->docNumber).' AND YEAR(date)='.intval($y);
							$db->query($sql);
							
						}
					}*/
				}
				elseif (intval($row->paymentType)==3)
				{
				}
				else
				{
					$sql='DELETE FROM '.PREFIX.'_policy_payments WHERE doc_number='.$db->quote($row->docNumber).' AND YEAR(datetime)='.intval($y);
					//$db->query($sql);
				}	
		}
		
		
		//insert process
		foreach ($xml->row as $row) {

/*$sql='insert into insurance_payments_temp '.
	 'SET docNumber='.$db->quote($row->docNumber).', '.
	 'docDate='.$db->quote($row->docDate).', '.
	 'personTypesId='.intval($row->personTypesId).', '.	 
	 'insurer='.$db->quote($row->insurer).', '.	 
	 'insurerLastname='.$db->quote($row->insurerLastname).', '.	 	 
	 'insurerFirstname='.$db->quote($row->insurerFirstname).', '.	 	 	 
	 'insurerPatronymicname='.$db->quote($row->insurerPatronymicname).', '.	 	 	 	 
	 'insurerIdentificationCode='.$db->quote($row->insurerIdentificationCode).', '.	 	 	 	 
	 'edrpou='.$db->quote($row->edrpou).', '.	 	 	 	 
	 	 'agreementNumber='.$db->quote($row->agreementNumber).', '.	 	
	'amount='.doubleval($row->amount).', '.	  	 	 
'paymentDate='.$db->quote($row->paymentDate).', '.	 	 	 	 
'paymentNumber='.$db->quote($row->paymentNumber).' ';
$db->query($sql);
continue;*/
			$bdat=smarty_make_timestamp((string)$row->docDate);
			if ($bdat<mktime (0, 0, 0, 9, 1,2009 )) continue;

			if (intval($row->paymentType)==2)
			{//расход денег
				$codeIE=(string)$row->codEI;
				if (strlen($codeIE)>0)
				{
				    $paymentCalendarId=intval($db->getOne('SELECT id FROM '.PREFIX.'_payments_calendar WHERE number ='.$db->quote($codeIE).' '));
   				    $pc=intval($db->getOne('SELECT count(*) FROM '.PREFIX.'_payments WHERE number ='.$db->quote($row->docNumber).' AND payments_id='.intval($paymentCalendarId)));
					if ($pc>0)  continue;
					if ($paymentCalendarId)
					{
						$amount=doubleval($row->amount);
						$sql='INSERT INTO '.PREFIX.'_payments  SET payments_id ='.intval($paymentCalendarId).' , number ='.$db->quote($row->docNumber).',date='.$db->quote($row->docDate).',amount='.$amount.',created =NOW(),modified =NOW() ';
						$db->query($sql);
						PaymentsCalendar::setPaymentStatus($paymentCalendarId);
					}
				}
				continue;
			}
			
			if (intval($row->paymentType)==3) //оплата по агенским актам
			{
				$docNumber = (string)$row->docNumber;
				$docNumber = trim($docNumber);
				$sql = 'SELECT * FROM insurance_akts WHERE number='.$db->quote($docNumber).' AND person_types_id in (1,2,3,4,5) ';
	/*$fp = fopen("textfile.txt", "a+");
	fwrite($fp, $sql."\n");
	fclose($fp);*/

				$r=$db->getRow($sql);
				if ($r && $r['payment_statuses_id']<3) {
					$db->query('UPDATE insurance_akts SET payment_statuses_id=3 WHERE id = '.$r['id']);
					
									
				}
					//проставить оплату еще в Ё 
					$client = new SoapClient('https://express-credit.in.ua/synchronization/express/sql.php?WSDL',array('trace' => 0));
					$sql =	'UPDATE ukrauto_questionnaire_solutions SET ' .
									'managerAktPaymentDate = NOW()  ' .
									//'periodIdManager = ' . intval($data['id']) . ' ' .
									'WHERE managerAktNumber = ' . $db->quote($docNumber);
									
					$result=$client->execUpdate(array("sql" => $sql));
					
					$sql =	'UPDATE ukrauto_questionnaire_solutions SET ' .
							'creditspecialistAktPaymentDate  = NOW()  ' .
							//'periodIdCreditspecialist  = ' . intval($data['id']) . ' ' .
							'WHERE creditspecialistAktNumber  = ' . $db->quote($docNumber);
					$result=$client->execUpdate(array("sql" => $sql));		
				continue;
			}

			
			$conditions=array();
			$conditions[] = '(a.number = ' . $db->quote($row->agreementNumber).') OR (CONCAT(a.number,\'_\',a.sub_number) = ' . $db->quote($row->agreementNumber).' AND a.product_types_id=10)';
			$personTypesId = intval($row->insurerIdentificationCode);
			$amount=doubleval($row->amount);
			
			//$sql='SELECT a.id,product_types_id FROM '.PREFIX.'_policies a  WHERE ' . implode(' AND ', $conditions) . ' ORDER BY a.id DESC ' ;
			$sql='SELECT getPoliciesIdFor1CPayments('. $db->quote($row->agreementNumber).', '.$amount.')';

//_dump($sql);exit;
			$policyId=$db->getOne($sql);
			$r=$db->getRow('SELECT product_types_id FROM '.PREFIX.'_policies WHERE id='.intval($policyId));
			//$policyId=intval($r['id']);
			$product_types_id=intval($r['product_types_id']);
			
			if ($policyId)
			{
				
				if ($amount>0)
				{
					//если уже были платежи с 1— по этой платежке то пропускаем
					$sql='SELECT count(*) FROM '.PREFIX.'_policy_payments a JOIN '.PREFIX.'_policies b on b.id=a.policies_id WHERE a.doc_number='.$db->quote($row->docNumber).' AND YEAR(a.datetime)=YEAR('.$db->quote($row->docDate).')  AND ((b.number = ' . $db->quote($row->agreementNumber).') OR (CONCAT(b.number,\'_\',b.sub_number) = ' . $db->quote($row->agreementNumber).' AND b.product_types_id=10))';
/*$fp = fopen("textfile.txt", "a+");
	fwrite($fp, $sql."\n");
	fclose($fp);*/

					$payment_count = intval($db->getOne($sql));
					if ($payment_count>0) continue;
					
					$sql='INSERT INTO '.PREFIX.'_policy_payments SET datetime='.$db->quote($row->docDate).',policies_id='.$policyId.',amount='.$amount.',doc_number='.$db->quote($row->docNumber).',payment_date='.(ereg('1899',$row->paymentDate) ? 'NULL' : $db->quote($row->paymentDate)).',payment_number='.$db->quote($row->paymentNumber).', created=NOW(),modified=NOW()  ';
					$db->query($sql);
					$db->query('UPDATE  ' . PREFIX . '_policies SET modified=NOW() WHERE id='.intval($policyId));
					Policies::setPaymentStatus($policyId);
					if ($product_types_id==4) //го списать бланк
					{
						$d=$db->getRow('SELECT a.id,b.blank_series,b.blank_number,a.policy_statuses_id FROM insurance_policies a JOIN insurance_policies_go b on b.policies_id=a.id WHERE  a.id='.intval($policyId));
						$Go->setBlankStatus($d);
					}
				}
			}
			else
			{
				if ($personTypesId == 2)//jur
					$Log->add('error', 'Policy not found Number: ' . $row->agreementNumber . ' EDRPOU : ' . $row->edrpou);
				else
					$Log->add('error', 'Policy not found Number: ' . $row->agreementNumber . ' INN : ' . $row->insurerIdentificationCode.' insurer: '.$row->insurer );
			}
			
		}
		if ($Log->isPresent()) {
			$result .= '	error	';

			foreach ($_SESSION['log'] as $row) {
				$result .= strip_tags($row['text']) . ';'."<br>\r\n";
			}
			unset($_SESSION['log']);

			$result .= "\r\n";

			$status = 'error';
			$subject = 'KASKO 1C77 payments export process:' . date('Ymd');

			//$Templates->send('vinogradov_s@voliacable.com', $data, null, $subject, $result, 'support@express-credit.in.ua', 'support@express-credit.in.ua');
		}


	}
	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <addPaymentsResponse xmlns="http://e-insurance.in.ua/" />
  </soap12:Body>
</soap12:Envelope>';
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }
	
	
	$SoapServer->addFunction('addPayments');
	
	if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST') {
	     $SoapServer->handle();
	} else {
	     $SoapServer = new SoapServer("payments.wsdl");
		 $SoapServer->handle();
	}
	exit;
?>
