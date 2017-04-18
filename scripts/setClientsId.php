<?

require_once '../include/collector.inc.php';
require_once '../include/modules/Clients.class.php';

function getClientsId($data) {

	$Clients = new Clients($data);

	if ($data['identification_code']) {
		$row = $Clients->getByIdentificationCode($data['identification_code']);
	} elseif ($data['passport_series'] && $data['passport_number']) {//ищем по паспорту
		$row = $Clients->getByPassport($data['passport_series'], $data['passport_number']);
	} elseif ($data['driver_licence_series'] && $data['driver_licence_number']) {//ищем по правам
		$row = $Clients->getByDriverLicence($data['driver_licence_series'], $data['driver_licence_number']);
	}

	if (intval($row['id'])) {
		return $row['id'];
	}
}

//КАСКО
$sql = 'SELECT a1.id, IF(d1.id IS NULL, c1.id, d1.id) AS top_agencies_id, IF(d1.regions_id IS NULL, c1.regions_id, d1.regions_id) AS top_regions_id, ' .
       'b1.insurer_person_types_id AS person_types_id, b1.insurer_company AS company, b1.insurer_lastname AS lastname, b1.insurer_firstname AS firstname, b1.insurer_patronymicname as patronymicname, b1.insurer_position AS position, b1.insurer_ground AS ground, ' .
	   'b1.insurer_dateofbirth AS dateofbirth, ' .
	   'b1.insurer_passport_series AS passport_series, b1.insurer_passport_number AS passport_number, b1.insurer_passport_place AS passport_place, b1.insurer_passport_date AS passport_date, ' .
	   'IF(b1.insurer_person_types_id = 2, insurer_edrpou, insurer_identification_code) AS identification_code, ' .
	   'b1.insurer_phone AS mobile_phone, b1.insurer_email AS email, ' .
       'b1.insurer_driver_licence_series AS driver_licence_series, b1.insurer_driver_licence_number AS driver_licence_number, b1.insurer_driver_licence_date AS driver_licence_date, ' .
       'b1.insurer_regions_id AS regions_id, b1.insurer_area AS area, b1.insurer_city AS city, b1.insurer_street_types_id AS street_types_id, b1.insurer_street AS street, b1.insurer_house AS house, b1.insurer_flat AS flat, ' .
	   'b1.card_assistance, b1.card_car_man_woman ' .
       'FROM insurance_policies AS a1 ' .
	   'JOIN insurance_policies_kasko AS b1 ON a1.id = b1.policies_id ' .
	   'JOIN insurance_agencies as c1 ON a1.agencies_id = c1.id ' .
	   'LEFT JOIN insurance_agencies as d1 ON c1.parent_id = d1.id ' .
       'WHERE a1.clients_id = 0 AND a1.policy_statuses_id IN(10, 11, 13, 16, 17) LIMIT 1500 ' .

	   'UNION ' .

//ГО
       'SELECT a2.id, IF(d2.id IS NULL, c2.id, d2.id) AS top_agencies_id, IF(d2.regions_id IS NULL, c2.regions_id, d2.regions_id) AS top_regions_id, ' .
       'b2.person_types_id, IF(person_types_id = 2, b2.insurer_lastname, NULL) AS company, IF(b2.person_types_id = 1, b2.insurer_lastname, NULL) AS lastname, IF(b2.person_types_id = 1, b2.insurer_firstname, NULL) AS firstname, IF(b2.person_types_id = 1, insurer_patronymicname, NULL) AS patronymicname, NULL AS position, NULL AS ground, ' .
       'b2.insurer_dateofbirth AS dateofbirth, ' .
	   'b2.insurer_passport_series AS passport_series, b2.insurer_passport_number AS passport_number, b2.insurer_passport_place AS passport_place, b2.insurer_passport_date AS passport_date, ' .
	   'IF(b2.person_types_id = 2, b2.insurer_edrpou, b2.insurer_identification_code) AS identification_code, ' .
	   'b2.insurer_phone AS mobile_phone, b2.insurer_email AS email, ' .
       'b2.insurer_driver_licence_series AS driver_licence_series, b2.insurer_driver_licence_number AS driver_licence_number, b2.insurer_driver_licence_date AS driver_licence_date, ' .
       'b2.insurer_regions_id AS regions_id, b2.insurer_area AS area, b2.insurer_city AS city, b2.insurer_street_types_id AS street_types_id, b2.insurer_street AS street, b2.insurer_house AS house, b2.insurer_flat AS flat, ' .
	   'NULL AS card_assistance, NULL AS card_car_man_woman ' .
       'FROM insurance_policies AS a2 ' .
	   'JOIN insurance_policies_go AS b2 ON a2.id = b2.policies_id ' .
	   'JOIN insurance_agencies as c2 ON a2.agencies_id = c2.id ' .
	   'LEFT JOIN insurance_agencies as d2 ON c2.parent_id = d2.id ' .
       'WHERE a2.clients_id = 0 AND a2.policy_statuses_id IN(10, 11, 13, 16, 17) LIMIT 1500 ';
$res = $db->query($sql);

while($res->fetchInto($row)) {

	$clients_id = getClientsId($row);

	if ( !intval($clients_id) ) {
		$sql = 'INSERT INTO insurance_clients SET ' .
			   'top_agencies_id = ' . intval($row['top_agencies_id']) . ', ' .
			   'top_regions_id = ' . intval($row['top_regions_id']) . ', ' .
			   'agencies_id = NULL, ' .
			   'agents_id = NULL, ' . 
			   'person_types_id	= ' . intval($row['person_types_id']) . ', ' .
			   'company = ' . $db->quote($row['company']) . ', ' .
			   'lastname = ' . $db->quote($row['lastname']) . ', ' .
			   'firstname = ' . $db->quote($row['firstname']) . ', ' .
			   'patronymicname = ' . $db->quote($row['patronymicname']) . ', ' .
			   'position = ' . $db->quote($row['position']) . ', ' .
			   'ground = ' . $db->quote($row['ground']) . ', ' .
			   'dateofbirth = ' . $db->quote($row['dateofbirth']) . ', ' .
//			   'sexes_id = NULL, ' .
			   'passport_series = ' . $db->quote($row['passport_series']) . ', ' .
			   'passport_number = ' . $db->quote($row['passport_number']) . ', ' .
			   'passport_place = ' . $db->quote($row['passport_place']) . ', ' .
			   'passport_date = ' . $db->quote($row['passport_date']) . ', ' .
			   'identification_code = ' . $db->quote($row['identification_code']) . ', ' .
			   'mobile_phone = ' . $db->quote($row['mobile_phone']) . ', ' .
			   'email = ' . $db->quote($row['email']) . ', ' .

			   'driver_licence_series = ' . $db->quote($row['driver_licence_series']) . ', ' .
			   'driver_licence_number = ' . $db->quote($row['driver_licence_number']) . ', ' .
			   'driver_licence_place = ' . $db->quote($row['driver_licence_place']) . ', ' .
			   'driver_licence_date = ' . $db->quote($row['driver_licence_date']) . ', ' .

			   'registration_regions_id = ' . intval($row['regions_id']) . ', ' .
			   'registration_area = ' . $db->quote($row['area']) . ', ' .
			   'registration_city = ' . $db->quote($row['city']) . ', ' .
			   'registration_street_types_id = ' . intval($row['street_types_id']) . ', ' .
			   'registration_street = ' . $db->quote($row['street']) . ', ' .
			   'registration_house = ' . $db->quote($row['house']) . ', ' .
			   'registration_flat = ' . $db->quote($row['flat']) . ', ' .
			   'registration_phone = ' . $db->quote('') . ', ' .
			   'habitation_regions_id = ' . intval($row['regions_id']) . ', ' .
			   'habitation_area = ' . $db->quote($row['area']) . ', ' .
			   'habitation_city = ' . $db->quote($row['city']) . ', ' .
			   'habitation_street_types_id = ' . intval($row['street_types_id']) . ', ' .
			   'habitation_street = ' . $db->quote($row['street']) . ', ' .
			   'habitation_house = ' . $db->quote($row['house']) . ', ' .
			   'habitation_flat = ' . $db->quote($row['flat']) . ', ' .
			   'habitation_phone = ' . $db->quote('') . ', ' .

			   'bank = NULL, ' .
			   'bank_account = NULL, ' .
			   'bank_mfo = NULL, ' .
			   'card_car_man_woman = ' . $db->quote($row['card_car_man_woman']) . ', ' .
			   'card_assistance = ' . $db->quote($row['card_assistance']) . ', ' .
			   'client_groups_id = 2, ' .
			   'important_person = 0, ' .
			   'created = NOW(), ' .
			   'modified = NOW()';
		$db->query($sql);

		echo $sql . '<br />';

		$clients_id = mysql_insert_id();
	}

	$sql = 'UPDATE insurance_policies SET clients_id = ' . $clients_id . ' WHERE id = ' . intval($row['id']);
	$db->query($sql);

	echo $sql . '<br ><br >';
}

?>