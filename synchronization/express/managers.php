<?
/*
 *
 */
ini_set('soap.wsdl_cache_enabled', '0');
require_once '../../include/collector.inc.php';


class ManagerService {  

	function synhronize($values) {
		global $db;
		
		$accountsId = intval($values->accountsId);
		$login = (string)$values->login;
		$password = (string)$values->password;
		$email = (string)$values->email;
		$screen_resolutionsId = intval($values->screen_resolutionsId);
		$recordsPerPage = intval($values->recordsPerPage);
		$IP = (string)$values->IP;
		$active = intval($values->active);
		$akt = intval($values->akt);
		$typesId = intval($values->typesId);
		$autoshowCode = (string)$values->autoshowCode;
		$firstname = (string)$values->firstname;
		$lastname = (string)$values->lastname;
		$patronymicname = (string)$values->patronymicname;
		$passport_series = (string)$values->passport_series;
		$passport_number = (string)$values->passport_number;
		$passport_date = (string)$values->passport_date;
		$passport_place = (string)$values->passport_place;
		$identificationCode = (string)$values->identificationCode;
		$address = (string)$values->address;
		$phone = (string)$values->phone;
		$fax = (string)$values->fax;
		$mobile = (string)$values->mobile;
		$recipient = (string)$values->recipient;
		$mfo = (string)$values->mfo;
		$zkpo = (string)$values->zkpo;
		$bankAccount = (string)$values->bankAccount;
		$bankReference = (string)$values->bankReference;
		$values->result='Fail';
		$agreementNumber = (string)$values->agreementNumber;
		$agreementDate = (string)$values->agreementDate;
		$seller = intval($values->seller);
		$ankets = intval($values->ankets);
		

		$agencyId=intval($db->getOne('SELECT id FROM '.PREFIX.'_agencies WHERE code='.$db->quote($autoshowCode)));
		if ($agencyId==0) return $values;

		$id=intval($db->getOne('SELECT id FROM '.PREFIX.'_accounts WHERE ek_id='.$accountsId));

		if (!$id)
		{
			$exists_id=intval($db->getOne('SELECT id FROM '.PREFIX.'_accounts WHERE login='.$db->quote($login)));
			if ($exists_id) $login.=$accountsId;

			$sql='INSERT INTO '.PREFIX.'_accounts SET '.
				 'login='.$db->quote($login).','.
				 'password='.$db->quote($password).','.
				 'email='.$db->quote($email).','.
				 'screen_resolutions_id='.$screen_resolutionsId.','.
				 'records_per_page='.$recordsPerPage.','.
				 'ip='.$db->quote($IP).','.
				 'roles_id='.ROLES_AGENT.','.
				 'akt='.$akt.','.
				  'firstname='.$db->quote($firstname).','.
				 'lastname='.$db->quote($lastname).','.
				 'patronymicname='.$db->quote($patronymicname).','.
				 'phone='.$db->quote($phone).','.
				 'fax='.$db->quote($fax).','.
				 'active='.$active.','.
				 'created=NOW(),'.
				 'expired=NOW( ) + INTERVAL 2 WEEK, '.
				 'mobile='.$db->quote($mobile).','.
				 'ek_id='.$accountsId.' ';

			$db->query($sql);
	
		    $id = mysql_insert_id();
			$sql='INSERT INTO '.PREFIX.'_agents SET '.
				 'accounts_id='.$id.','.
				 'agencies_id='.$agencyId.','.
				 
				 'seller='.$seller.','.
				 'ankets='.$ankets.','.
				 
				 'passport_series='.$db->quote($passport_series).','.
				 'passport_number='.$db->quote($passport_number).','.
				 'passport_date='.$db->quote($passport_date).','.
				 'passport_place='.$db->quote($passport_place).','.
				 'identification_code='.$db->quote($identificationCode).','.
				 'address='.$db->quote($address).','.
				 'recipient='.$db->quote($recipient).','.
				 'mfo='.$db->quote($mfo).','.
				 'zkpo='.$db->quote($zkpo).','.
				 'bank_account='.$db->quote($bankAccount).','.
				 'bank_reference='.$db->quote($bankReference).','.
				 //'agreement_number='.$db->quote($agreementNumber).','.
				 //'agreement_date='.$db->quote($agreementDate).','.
				 'ek_id='.$accountsId.' ';
			$db->query($sql); 
		}
		else
		{
			$sql='UPDATE '.PREFIX.'_accounts SET '.
				 'login='.$db->quote($login).','.
				 'password='.$db->quote($password).','.
				 'email='.$db->quote($email).','.
				 'screen_resolutions_id='.$screen_resolutionsId.','.
				 'records_per_page='.$recordsPerPage.','.
				 'ip='.$db->quote($IP).','.
				 'roles_id='.ROLES_AGENT.','.
				 'akt='.$akt.','.
				 'firstname='.$db->quote($firstname).','.
				 'lastname='.$db->quote($lastname).','.
				 'patronymicname='.$db->quote($patronymicname).','.
				 'phone='.$db->quote($phone).','.
				 'fax='.$db->quote($fax).','.
				  'mobile='.$db->quote($mobile).','.
				 'active='.$active.', '.
				 'expired=NOW( ) + INTERVAL 2 WEEK '.
				 'WHERE id='.$id.' ';
			$db->query($sql);

			$sql='UPDATE '.PREFIX.'_agents SET '.
				 'agencies_id='.$agencyId.','.
				 'passport_series='.$db->quote($passport_series).','.
				 'passport_number='.$db->quote($passport_number).','.
				 'passport_date='.$db->quote($passport_date).','.
				 'passport_place='.$db->quote($passport_place).','.
				 'identification_code='.$db->quote($identificationCode).','.
				 'address='.$db->quote($address).','.
				 'recipient='.$db->quote($recipient).','.
				 'mfo='.$db->quote($mfo).','.
				 'zkpo='.$db->quote($zkpo).','.
				 'seller='.$seller.','.
				 //'ankets='.$ankets.','.
				 'bank_account='.$db->quote($bankAccount).','.
				 'bank_reference='.$db->quote($bankReference).' '.
				 
				 //'agreement_number='.$db->quote($agreementNumber).','.
				 //'agreement_date='.$db->quote($agreementDate).','.
				 'WHERE accounts_id='.$id.' ';
			$db->query($sql); 
			//_dump($sql);
		}
		
	 	$values->result='Ok';
		return $values;
	}
	
}
ini_set('soap.wsdl_cache_enabled', 0);
$Server = new SoapServer('managers.wsdl');
$Server->setClass('ManagerService');
$Server->handle();
?>