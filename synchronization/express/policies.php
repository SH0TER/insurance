<?
/*
 * Title: policies class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

require_once '../../include/collector.inc.php';
require_once 'Policies.class.php';

class PoliciesService {  

	function update($data, $type) {
	    global $Log,$Authorization;
		$Policies = Policies::factory($data, $type);

		$Policies->permissions['update'] = true;
		$data['checkPermissions'] = 1;

		$row = $Policies->load($data, false);

		$data = array_merge($row, $data);
		$data['skipClients'] = 1;
		$data['skipCalendar'] = 1;

		if ($data['sign'])
			$data['items'][0]['sign']=$data['sign'];
		if ($type == 'GO')
		{
			if ($data['payment_number'] && $data['payment_datetime_day'] && $data['payment_datetime_month'] && $data['payment_datetime_year'])
				$data['policy_statuses_id'] = POLICY_STATUSES_GENERATED;
			else
				$data['policy_statuses_id'] = POLICY_STATUSES_CREATED;
		}
//$Policies->update($data, false,false);
//return $Authorization;			
		return $Policies->update($data, false,false);
	}

	function setAgreement($values) {
		
		$data['skipQuotes'] = 1;
		
		$data['car_price']		= (string)$values->carPrice;
		$data['brand']			= (string)$values->brand;
		$data['model']			= (string)$values->model;
		$data['year']			= intval($values->year);
		$data['shassi']			= (string)$values->shassi;
		$data['engine_size']	= intval($values->engine_size);

		$result = false;

		if (intval($values->insurance_kasko_policiesId)) {
			$data['id']	= intval($values->insurance_kasko_policiesId);
			$result = $this->update($data, 'KASKO');
		}

		if (intval($values->insurance_go_policiesId)) {
			$data['id']	= intval($values->insurance_go_policiesId);
			$result = $this->update($data, 'GO');
		}

		return array('result' => ($result) ? 'ok' : '');
	}

	function setSign($values) {
        global $db;
		$result = false;

		$data['sign']	= (string)($values->sign);
		$data['skipCalendar'] = 1;
		$data['skipQuotes'] = 1;
		/*if (intval($values->insurance_kasko_policiesId)) {
			$data['id']		= intval($values->insurance_kasko_policiesId);
			$result = $this->update($data, 'KASKO');
		}*/
		//return array('result' =>  serialize ($result) );
		if (intval($values->insurance_go_policiesId)) {
			$data['id']		= intval($values->insurance_go_policiesId);
            $sql='UPDATE '.PREFIX.'_policies_go SET sign = '.$db->quote($data['sign']).' WHERE policies_id='.intval($data['id']);
            $db->query($sql);
			//$result = $this->update($data, 'GO');
		}
		return array('result' =>  'ok' );
	}

	function setBeginEnd($values) {
		global $db;

		$result = false;

		$data['begin_datetime']	= (string)($values->beginDateTime);
		$data['end_datetime']	= (string)($values->endDateTime);
		$data['skipQuotes'] = 1;
		$data['skipClients'] = 1;

		if (checkdate(substr($data['begin_datetime'], 5, 2), substr($data['begin_datetime'], 8, 2), substr($data['begin_datetime'], 0, 4)) &&
			checkdate(substr($data['end_datetime'], 5, 2), substr($data['end_datetime'], 8, 2), substr($data['end_datetime'], 0, 4))) {

			if (intval($values->insurance_kasko_policiesId)) {

				$sql='SELECT id FROM ' . PREFIX . '_policies  ' .
					 'WHERE documents = 0 AND id = ' . intval($values->insurance_kasko_policiesId);
				if (intval($db->getOne($sql))>0) {
					$result = true;
				}
				
				$sql =	'UPDATE ' . PREFIX . '_policies SET ' .
						'begin_datetime = ' . $db->quote($data['begin_datetime'])	. ', ' .
						'end_datetime = ' . $db->quote($data['end_datetime'])	. ', ' .
						'interrupt_datetime = ' . $db->quote($data['end_datetime'])	. ' ' .
						'WHERE documents = 0 AND id = ' . intval($values->insurance_kasko_policiesId);
				$db->query($sql);

				if ($db->affectedRows()) {
					$result = true;
				}

			}

			if (intval($values->insurance_go_policiesId)) {
				$data['id']		= intval($values->insurance_go_policiesId);
				$data['begin_datetime_day'] = substr($data['begin_datetime'], 8, 2);
				$data['begin_datetime_month'] = substr($data['begin_datetime'], 5, 2);
				$data['begin_datetime_year'] = substr($data['begin_datetime'], 0, 4);

				$data['end_datetime_day'] = substr($data['end_datetime'], 8, 2);
				$data['end_datetime_month'] = substr($data['end_datetime'], 5, 2);
				$data['end_datetime_year'] = substr($data['end_datetime'], 0, 4);
				
				$Policies = Policies::factory($data, 'GO');

				$Policies->permissions['update'] = true;
				
				$data['checkPermissions'] = 1;

				$row = $Policies->load($data, false);
				$data = array_merge($row, $data);
				if ($data['payment_number'] && $data['payment_datetime_day'] && $data['payment_datetime_month'] && $data['payment_datetime_year'])
					$data['policy_statuses_id'] = POLICY_STATUSES_GENERATED;
				else
					$data['policy_statuses_id'] = POLICY_STATUSES_CREATED;
				
	
				$result = $Policies->update($data, false,false);
			}
		}
		
		return array('result' => ($result) ? 'ok' : '');
	}
}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('policies.wsdl');
$Server->setClass('PoliciesService');
$Server->handle();

?>