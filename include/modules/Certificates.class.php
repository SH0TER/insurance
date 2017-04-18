<?
/*
 * Title: certificate class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Clients.class.php';
require_once 'Policies.class.php';
require_once 'PolicyMessages.class.php';

class Certificates {
 
    function Certificates($data) {
        $this->messages['plural'] = 'Сертифікати';
        $this->messages['single'] = 'Сертифікат';
    }

	//схема смены статусов для сертификатов
	function setPolicyStatusesSchema($roles_id=null) {
		global $Authorization, $POLICY_STATUSES_SCHEMA;

		if (is_null($roles_id)) {
			$roles_id = $Authorization->data['roles_id'];
		}

		switch ($roles_id) {
			case ROLES_ADMINISTRATOR:
				$POLICY_STATUSES_SCHEMA = array(
					POLICY_STATUSES_CREATED =>
						array(
							POLICY_STATUSES_CREATED,
							POLICY_STATUSES_SENT),
					POLICY_STATUSES_SENT =>
						array(
							POLICY_STATUSES_SENT,
							POLICY_STATUSES_ERROR,
							POLICY_STATUSES_GENERATED),
					POLICY_STATUSES_ERROR =>
						array(
							POLICY_STATUSES_ERROR,
							POLICY_STATUSES_RESENT),
					POLICY_STATUSES_RESENT =>
						array(
							POLICY_STATUSES_RESENT,
							POLICY_STATUSES_ERROR,
							POLICY_STATUSES_GENERATED),
					POLICY_STATUSES_GENERATED =>
						array(
							POLICY_STATUSES_GENERATED,
							POLICY_STATUSES_CANCELLED),
					POLICY_STATUSES_CANCELLED =>
						array(
							POLICY_STATUSES_CANCELLED));
				break;
			case ROLES_MANAGER:
				$POLICY_STATUSES_SCHEMA = array(
					POLICY_STATUSES_CREATED =>
						array(
							POLICY_STATUSES_CREATED,
							POLICY_STATUSES_SENT),
					POLICY_STATUSES_SENT =>
						array(
							POLICY_STATUSES_SENT,
							POLICY_STATUSES_ERROR,
							POLICY_STATUSES_GENERATED),
					POLICY_STATUSES_ERROR =>
						array(
							POLICY_STATUSES_ERROR),
					POLICY_STATUSES_RESENT =>
						array(
							POLICY_STATUSES_RESENT,
							POLICY_STATUSES_ERROR,
							POLICY_STATUSES_GENERATED),
					POLICY_STATUSES_GENERATED =>
						array(
							POLICY_STATUSES_GENERATED,
							POLICY_STATUSES_CANCELLED),
					POLICY_STATUSES_CANCELLED =>
						array(
							POLICY_STATUSES_CANCELLED));
				break;
			case ROLES_AGENT:
			case ROLES_CLIENT_CONTACT:
				$POLICY_STATUSES_SCHEMA = array(
					POLICY_STATUSES_CREATED =>
						array(
							POLICY_STATUSES_CREATED,
							POLICY_STATUSES_SENT),
					POLICY_STATUSES_SENT =>
						array(
							POLICY_STATUSES_SENT),
					POLICY_STATUSES_ERROR =>
						array(
							POLICY_STATUSES_ERROR,
							POLICY_STATUSES_RESENT),
					POLICY_STATUSES_RESENT =>
						array(
							POLICY_STATUSES_RESENT),
					POLICY_STATUSES_GENERATED =>
						array(
							POLICY_STATUSES_GENERATED),
					POLICY_STATUSES_CANCELLED =>
						array(
							POLICY_STATUSES_CANCELLED));
				break;
		}
	}

    function show($data) {
        global $Authorization;

        $data['do'] = 'Policies|show';

        $data['product_types_id'] = PRODUCT_TYPES_CARGO_CERTIFICATE;
        $Policies = Policies::factory($data, 'Cargo');

        $Policies->objectTitle = 'Policies_Cargo';
        $Policies->show($data, $fields, $conditions, $sql);

        $data['product_types_id'] = PRODUCT_TYPES_DRIVE_CERTIFICATE;
        $Policies = Policies::factory($data, 'Drive');

        $Policies->objectTitle = 'Policies_Drive';
        $Policies->show($data, $fields, $conditions, $sql);

        if ($Authorization->data['roles_id'] != ROLES_CLIENT_CONTACT && (($Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['Clients']['show']) || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR)) {
            $data['do'] = 'Clients|show';

            $Clients = new Clients($data);
            $Clients->show($data, $fields, $conditions, $sql);
        }
    }

	function getPoliciesGeneralInWindow($data) {
		global $db, $Authorization;

		if ($Authorization->data['roles_id'] == ROLES_CLIENT_CONTACT) {
			$data['clients_id'] = $Authorization->data['clients_id'];
		}

		$conditions[] = 'clients_id = ' . intval($data['clients_id']);
		$conditions[] = 'product_types_id = ' . intval($data['product_types_id']);
		$conditions[] =	'id<>7185';

		$conditions[] = ($data['date'])
			? 'begin_datetime <= ' . $db->quote($data['date']) . ' AND ' . $db->quote($data['date']) . ' <= end_datetime'
			: 'begin_datetime <= NOW()';

		$sql =	'SELECT id, number ' .
				'FROM ' . PREFIX . '_policies ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY number';
		$res =	$db->query($sql);
//_dump($sql);
		$result = 'var policies = new Array();';

		$i = 0;
		while($res->fetchInto($row)) {
			$result .= 'policies[' . $i . '] = new Array(\'' . $row['id'] . '\', \'' . $row['number'] .'\');';
			$i++;
		}

		echo $result;
		exit;
	}

	function getPoliciesGeneralByClients($product_types_id, $clients_id,$number=null,$last=false) {
		global $db, $Authorization;

		if ($Authorization->data['roles_id'] == ROLES_CLIENT_CONTACT) {
			$data['clients_id'] = $Authorization->data['clients_id'];
		}

		$conditions[] = 'clients_id = ' . intval($clients_id);
		$conditions[] = 'product_types_id = ' . intval($product_types_id);
		//$conditions[] = 'TO_DAYS(begin_datetime) <= TO_DAYS(NOW()) AND TO_DAYS(NOW()) <= TO_DAYS(end_datetime)';
		
		if ($number)
			$conditions[] = 'number = ' . $db->quote($number);
			
		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_policies ' .
				'WHERE ' . implode(' AND ', $conditions);
		if ($last) {
		$sql.=' ORDER BY id DESC LIMIT 1';
		}
		$list =	$db->getCol($sql);

		if (is_array($list) && sizeOf($list) == 1) 
			return $list[ 0 ];
		elseif (is_array($list)) 
			return $list;
		
		return null;
	}

	function isValidPolicyGeneral($id, $clients_id, $date) {
		global $db;

		$conditions[] = 'id = ' . intval($id);
		$conditions[] = 'clients_id = ' . intval($clients_id);
		$conditions[] = 'begin_datetime <= ' . $db->quote($date) . '  ';

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_policies ' .
				'WHERE ' . implode(' AND ', $conditions);
		return ($db->getOne($sql)) ? true : false;
	}

    function getpayment_statuses_id($id) {
        global $db;

        $sql =	'SELECT payment_statuses_id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE id = ' . intval($id);
        return $db->getOne($sql);
    }

	function getDeliveryWaysId($id) {
		global $db;

		$sql =	'SELECT delivery_ways_id ' .
				'FROM ' . PREFIX . '_policies_cargo_general ' .
				'WHERE policies_id = ' . intval($id);
		return $db->getOne($sql);
	}
}

?>