<?
/*
 * Title: policy drive class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Distributors.class.php';
require_once 'Certificates.class.php';
require_once 'Policies/KASKO.class.php';
require_once 'Users/ClientContacts.class.php';

class Policies_Drive extends Policies_KASKO {

    function Policies_Drive($data) {
        Policies_KASKO::Policies_KASKO($data);

        $this->objectTitle = 'Policies_Drive';

        $this->messages['plural'] = 'Сертифікати добровільного страхування наземних ТЗ';
        $this->messages['single'] = 'Сертифікат добровільного страхування наземних ТЗ';

		$this->formDescription['fields'][ $this->getFieldPositionByName('terms_id') ]['condition'] = 'product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND id IN(49, 50, 51, 52, 53, 54)';
		unset($this->formDescription['fields'][ $this->getFieldPositionByName('commission') ]);
		unset($this->itemFormDescription['fields'][ $this->getFieldPositionByName('sign', $this->itemFormDescription) ]);

		Certificates::setPolicyStatusesSchema();

        $this->certificate = true;
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'          => true,
                    'insert'        => false,
                    'update'        => true,
                    'changeStatus'  => true,
                    'reset'			=> true,
                    'view'          => true,
                    'change'        => true,
                    'export'        => true,
                    'exportActions' => true,
                    'delete'        => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
            case ROLES_AGENT:
            case ROLES_CLIENT_CONTACT:
                $this->permissions = array(
                    'show'          => true,
                    'insert'        => true,
                    'import'        => true,
                    'update'        => true,
                    'changeStatus'  => true,
                    'view'          => true,
                    'export'        => true,
                    'change'        => false,
                    'delete'        => false);

                $this->formDescription['fields'][ $this->getFieldPositionByName('documents') ]['display']['change'] = false;

                break;
        }
    }

    function getListOfFileFields() {
        $files = array();
        foreach($this->formDescription['fields'] as $field) {
            if (($field['type'] == fldImage || $field['type'] == fldFile) && $field['name'] != 'certificate') {
                if ($field['multiLanguages']) {
                    foreach ($this->languages as $languageCode => $languageTitle) {
                        $files[] = $field['name'] . $languageCode;
                    }
                } else {
                    $files[] = $field['name'];
                }
            }
        }
        return $files;
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='showCertificates.php', $limit=true) {
        global $db, $Authorization;

		//убираем все поля, что в таблице policies_kasko
		foreach ($this->formDescription['fields'] as $i => $field) {
			if ($field['table'] == 'policies_kasko') {
				unset($this->formDescription['fields'][ $this->getFieldPositionByName( $field['name'] ) ]);
			}
		}

	if ($data['do'] == 'Policies|view') {
            $hidden['id'] = $data['id'];
            $hidden['do'] = $data['do'];
            $hidden['top'] = $data['top'];
            $hidden['product_types_id'] = PRODUCT_TYPES_DRIVE_GENERAL;
            $hidden['clients_id'] = $data['clients_id'];
        }

        if ($data['itemsDocumentNumber']) {
            $fields[] = 'itemsDocumentNumber';
            $conditions[] = 'document_number = ' . $db->quote($data['itemsDocumentNumber']);
        }

        if ($data['itemsDocumentDate']) {
            $fields[] = 'itemsDocumentDate';
            $conditions[] =  'TO_DAYS(document_date) = TO_DAYS(' . $db->quote( substr($data['itemsDocumentDate'], 6, 4) . substr($data['itemsDocumentDate'], 3, 2) . substr($data['itemsDocumentDate'], 0, 2) ) . ')';
        }

        if ($data['itemsShassi']) {
            $fields[] = 'itemsShassi';
			$conditions[] =  $this->tables[0] . '.id IN (SELECT policies_id FROM ' . PREFIX . '_policies_kasko_items WHERE shassi = ' . $db->quote($data['itemsShassi']).')';			
        }

        if (is_array($conditions)) {
            $conditions = array($this->tables[0] . '.id IN (SELECT policies_id FROM ' . PREFIX . '_policies_drive WHERE ' . implode(' AND ', $conditions) . ' AND ' . $this->tables[0] . '.id = ' . PREFIX . '_policies_drive.policies_id)');
        }

        switch ($Authorization->data['roles_id']) {
            case ROLES_CLIENT_CONTACT:

                $conditions[] = PREFIX . '_policies.clients_id = ' . intval($Authorization->data['clients_id']);

                switch ($Authorization->data['clients_id']) {
                    case CLIENTS_KGC://показ для менеджеров КГЦ в пределах персональной зоны видимости
                        $conditions[] = PREFIX . '_policies.client_contacts_id = ' . intval($Authorization->data['id']);
                        break;
                }
                break;
        }

        $data['hidden'] = $hidden;
        parent::show($data, $fields, $conditions, $sql, $template, $limit);
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        global $db;

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_client_points ' .
				'WHERE clients_id=' . intval($data['clients_id']);
		$data['client_points'] = $db->getAll($sql, 300);

        parent::showForm($data, $action, $actionType, $template);
    }

    function add($data) {
        global $Authorization;

        if (!intval($data['clients_id'])) {
            $data['clients_id'] = $Authorization->data['clients_id'];
		}

		$row = Clients::get($data['clients_id']);

		$data['owner_person_types_id'] 		= $row['person_types_id'];
		$data['owner_company']				= $row['company'];
		$data['owner_bank']					= $row['bank'];
		$data['owner_bank_account']			= $row['bank_account'];
		$data['owner_bank_mfo']				= $row['bank_mfo'];
		$data['owner_edrpou']				= $row['identification_code'];
		$data['owner_lastname']				= $row['lastname'];
		$data['owner_firstname']			= $row['firstname'];
		$data['owner_patronymicname']		= $row['patronymicname'];
		$data['owner_position']				= $row['position'];
		$data['owner_ground']				= $row['ground'];
		$data['owner_dateofbirth']			= $row['dateofbirth'];
		$data['owner_dateofbirth_year']		= substr($row['dateofbirth'], 0, 4);
		$data['owner_dateofbirth_month']	= substr($row['dateofbirth'], 5, 2);
		$data['owner_dateofbirth_day']		= substr($row['dateofbirth'], 8, 2);
		$data['owner_passport_series']		= $row['passport_series'];
		$data['owner_passport_number']		= $row['passport_number'];
		$data['owner_passport_place']		= $row['passport_place'];
		$data['owner_passport_date']		= $row['passport_date'];
		$data['owner_passport_date_year']	= substr($row['passport_date'], 0, 4);
		$data['owner_passport_date_month']	= substr($row['passport_date'], 5, 2);
		$data['owner_passport_date_day']	= substr($row['passport_date'], 8, 2);
		$data['owner_identification_code']	= $row['identification_code'];
		$data['owner_phone']				= $row['habitation_phone'];
		$data['owner_email']				= $row['email'];
		$data['owner_regions_id']			= $row['registration_regions_id'];
		$data['owner_area']					= $row['registration_area'];
		$data['owner_city']					= $row['registration_city'];
		$data['owner_street_types_id']		= $row['registration_street_types_id'];
		$data['owner_street']				= $row['registration_street'];
		$data['owner_house']				= $row['registration_house'];
		$data['owner_flat']					= $row['registration_flat'];

		$data['insurer_person_types_id'] 	= $row['person_types_id'];
		$data['insurer_company']			= $row['company'];
		$data['insurer_bank']				= $row['bank'];
		$data['insurer_bank_account']		= $row['bank_account'];
		$data['insurer_bank_mfo']			= $row['bank_mfo'];
		$data['insurer_edrpou']				= $row['identification_code'];
		$data['insurer_lastname']			= $row['lastname'];
		$data['insurer_firstname']			= $row['firstname'];
		$data['insurer_patronymicname']		= $row['patronymicname'];
		$data['insurer_position']			= $row['position'];
		$data['insurer_ground']				= $row['ground'];
		$data['insurer_dateofbirth']		= $row['dateofbirth'];
		$data['insurer_dateofbirth_year']	= substr($row['dateofbirth'], 0, 4);
		$data['insurer_dateofbirth_month']	= substr($row['dateofbirth'], 5, 2);
		$data['insurer_dateofbirth_day']	= substr($row['dateofbirth'], 8, 2);
		$data['insurer_passport_series']	= $row['passport_series'];
		$data['insurer_passport_number']	= $row['passport_number'];
		$data['insurer_passport_place']		= $row['passport_place'];
		$data['insurer_passport_date']		= $row['passport_date'];
		$data['insurer_passport_date_year']	= substr($row['passport_date'], 0, 4);
		$data['insurer_passport_date_month']= substr($row['passport_date'], 5, 2);
		$data['insurer_passport_date_day']	= substr($row['passport_date'], 8, 2);
		$data['insurer_identification_code']= $row['identification_code'];
		$data['insurer_phone']				= $row['habitation_phone'];
		$data['insurer_email']				= $row['email'];
		$data['insurer_regions_id']			= $row['registration_regions_id'];
		$data['insurer_area']				= $row['registration_area'];
		$data['insurer_city']				= $row['registration_city'];
		$data['insurer_street_types_id']	= $row['registration_street_types_id'];
		$data['insurer_street']				= $row['registration_street'];
		$data['insurer_house']				= $row['registration_house'];
		$data['insurer_flat']				= $row['registration_flat'];

        return parent::add($data);
    }

    function setConstants(&$data) {
		$data['items'][0]['shassi']	= fixShassiSimbols($data['items'][0]['shassi']);

		$data['send'] = htmlspecialchars($this->replaceTags(trim($data['send'])));
		$data['send_en'] = htmlspecialchars($this->replaceTags(trim($data['send_en'])));
		$data['destination'] = htmlspecialchars($this->replaceTags(trim($data['destination'])));
		$data['destination_en'] = htmlspecialchars($this->replaceTags(trim($data['destination_en'])));
		$data['assured_title_en'] = htmlspecialchars($this->replaceTags(trim($data['assured_title_en'])));
		$data['assured_address_en']	= htmlspecialchars($this->replaceTags(trim($data['assured_address_en'])));
		$data['document_number'] = htmlspecialchars($this->replaceTags(trim($data['document_number'])));

		$Products = Products::factory($data, 'KASKO');
        $Products->calculate($data['items'][0]['engine_size'], $data['items'][0]['car_types_id'], $data['person_types_id'], $data['driver_standings_id'], $data['drivers_id'], $data['items'][0]['car_price'], $data['driver_ages_id'], $data['registration_cities_id'], $data['terms_id'], $data['items'][0]['deductibles_id'], $data, $data['items'][0]);

        return parent::setConstants($data);
    }

    function checkFields(&$data, $action) {
        global $db, $Log;

		if (!intval($data['policies_general_id'])) {
			$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Генеральний договір', null));
		}

        parent::checkFields($data, $action);

		if ($data['assured_title'] == '') {
			$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Вигодонабувач, ПІБ (назва)', null));
		}
		if ($data['assured_identification_code'] == '') {
			$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Вигодонабувач, ІПН (ЄРДПОУ)', null));
		}
		if ($data['assured_address'] == '') {
			$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Вигодонабувач, адреса', null));
		}
		if ($data['assured_phone'] == '') {
			$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Вигодонабувач, телефон', null));
		}

		if ($data['assured_title_en'] || $data['assured_address_en'] || $data['send_en'] || $data['destination_en']) {
			if ($data['assured_title_en'] == '') {
				$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Вигодонабувач, ПІБ (назва) (англ.)', null));
			}
			if ($data['assured_address_en'] == '') {
				$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Вигодонабувач, адреса (англ.)', null));
			}
		}

		if ($data['document_number'] == '' && $this->certificate) {
			$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Документ, номер', null));
		}

		if (!checkdate($data['document_date_month'], $data['document_date_day'], $data['document_date_year']) && $this->certificate) {
			$Log->add('error', 'The date <b>%s</b>%s is not valid.', array('Документ, номер і дата', null));
		}

		if ($data['send'] == '' && $this->certificate) {
			$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Пункт відправлення', null));
		}

		if ($data['destination'] == '' && $this->certificate) {
			$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Пункт призначення', null));
		}

		if ($data['assured_title_en'] || $data['assured_address_en'] || $data['send_en'] || $data['destination_en']) {
			if ($data['send_en'] == '') {
				$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Пункт відправлення (англ.)', null));
			}

			if ($data['destination_en'] == '') {
			$Log->add('error', 'Required field <b>%s</b>%s is missing.', array('Пункт призначення (англ.)', null));
			}
		}

        $date = (checkdate(intval($data['date_month']), intval($data['date_day']), intval($data['date_year'])))
            ? mktime(0, 0, 0, intval($data['date_month']), intval($data['date_day']), intval($data['date_year']))
            : mktime(0, 0, 0, date('m')  , date('d'), date('Y'));
        $begin_datetime = (checkdate(intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year']))
            : 0;
        $end_datetime = (checkdate(intval($data['end_datetime_month']), intval($data['end_datetime_day']), intval($data['end_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['end_datetime_month']), intval($data['end_datetime_day']), intval($data['end_datetime_year']))
            : 0;

        $sql =  'SELECT UNIX_TIMESTAMP(a.begin_datetime) as begin_datetime, UNIX_TIMESTAMP(a.end_datetime) as end_datetime, b.payment_types_id ' .
                'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policies_drive_general AS b ON a.id = b.policies_id ' .
                'WHERE id = ' . intval($data['policies_general_id']);
        $row = $db->getRow($sql);

//        echo $sql;

		$data['payment_types_id'] = $row['payment_types_id'];

        //проверка даты начала действия полиса
        if ($begin_datetime < $date) {
            $Log->add('error', '<b>Дата початку дії сертифікату</b> не може бути раніше ніж <b>Дата заключення сертифікату</b>.');
        }
        if ($begin_datetime > $end_datetime) {
            $Log->add('error', '<b>Дата початку дії сертифікату</b> не може бути пізніше ніж <b>Дата закінчення дії сертифікату</b>.');
        }

        //проверяем даты в связке с генеральным договором
        if ($date < $row['begin_datetime']) {
            $Log->add('error', '<b>Дата заключення сертифікату</b> не може бути раніше ніж <b>Дата початку дії генерального договору</b>.');
        }
        if ($begin_datetime < $row['begin_datetime']) {
            $Log->add('error', '<b>Дата початку дії сертифікату</b> не може бути раніше ніж <b>Дата початку дії генерального договору</b>.');
        }

		if (!Certificates::isValidPolicyGeneral($data['policies_general_id'], $data['clients_id'], $data['date_year'] . $data['date_month'] . $data['date_day'])) {
            $Log->add('error', '<b>Генеральний договір</b> не вірний.');
		}

//не проверяем окончание действия генерального договора
//        if ($row['end_datetime'] < $end_datetime) {
//            $Log->add('error', '<b>Дата закінчення дії сертифікату</b> не може бути пізніше ніж <b>Дата закінчення дії генерального договору</b>.');
//        }
    }

	function setAdditionalFields($id, $data) {
		global $db, $Authorization;
		
		$sql = 'SELECT policies_id FROM ' . PREFIX . '_policies_drive WHERE policies_id = ' . intval($id);
		$policies_id = $db->getOne($sql);

		if (intval($policies_id) ) {
			$sql =  'UPDATE ' . PREFIX . '_policies_drive AS a ' .
					'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
					'JOIN ' . PREFIX . '_policies_drive_general AS c ON a.policies_general_id = c.policies_id ' .
					'JOIN ' . PREFIX . '_clients AS d ON b.clients_id = d.id SET ' .
					'a.policies_general_id = ' . intval($data['policies_general_id']) . ', ' .
					'a.owner_company_en = d.company_en, ' .
					'a.owner_bank_en = d.bank_en, ' .
					'a.owner_lastname_en = d.lastname_en, ' .
					'a.owner_firstname_en = d.firstname_en, ' .
					'a.owner_patronymicname_en = d.patronymicname_en, ' .
					'a.owner_position_en = d.position_en, ' .
					'a.owner_ground_en = d.ground_en, ' .
					'a.owner_area_en = d.registration_area_en, ' .
					'a.owner_city_en = d.registration_city_en, ' .
					'a.owner_street_en = d.registration_street_en, ' .
					'a.insurer_company_en = d.company_en, ' .
					'a.insurer_bank_en = d.bank_en, ' .
					'a.insurer_lastname_en = d.lastname_en, ' .
					'a.insurer_firstname_en = d.firstname_en, ' .
					'a.insurer_patronymicname_en = d.patronymicname_en, ' .
					'a.insurer_position_en = d.position_en, ' .
					'a.insurer_ground_en = d.ground_en, ' .
					'a.insurer_area_en = d.registration_area_en, ' .
					'a.insurer_city_en = d.registration_city_en, ' .
					'a.insurer_street_en = d.registration_street_en, ' .
					'a.deductible = c.deductible, ' .
					'a.deductible_en = c.deductible_en, ' .
					'a.assured_title_en = ' . $db->quote($data['assured_title_en']) . ', ' .
					'a.assured_address_en = ' . $db->quote($data['assured_address_en']) . ', ' .
					'a.send = ' . $db->quote($data['send']) . ', ' .
					'a.send_en = ' . $db->quote($data['send_en']) . ', ' .
					'a.destination = ' . $db->quote($data['destination']) . ', ' .
					'a.destination_en = ' . $db->quote($data['destination_en']) . ', ' .
					'a.document_number = ' . $db->quote($data['document_number']) . ', ' .
					'a.document_date = ' . $db->quote($data['document_date_year'] . '-' . $data['document_date_month'] . '-' . $data['document_date_day']) . ' ' .
					'WHERE a.policies_id = ' . intval($id);
			$db->query($sql);
		} else {
			$sql =  'INSERT INTO ' . PREFIX . '_policies_drive SET ' .
					'policies_id = ' . intval($id) . ', ' .
					'policies_general_id = ' . intval($data['policies_general_id']) . ', ' .
					'assured_title_en = ' . $db->quote($data['assured_title_en']) . ', ' .
					'assured_address_en = ' . $db->quote($data['assured_address_en']) . ', ' .
					'send = ' . $db->quote($data['send']) . ', ' .
					'send_en = ' . $db->quote($data['send_en']) . ', ' .
					'destination = ' . $db->quote($data['destination']) . ', ' .
					'destination_en = ' . $db->quote($data['destination_en']) . ', ' .
					'document_number = ' . $db->quote($data['document_number']) . ', ' .
					'document_date = ' . $db->quote($data['document_date_year'] . '-' . $data['document_date_month'] . '-' . $data['document_date_day']);
			$db->query($sql);

			$sql =  'UPDATE ' . PREFIX . '_policies_drive AS a ' .
					'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
					'JOIN ' . PREFIX . '_policies_drive_general AS c ON a.policies_general_id = c.policies_id ' .
					'JOIN ' . PREFIX . '_clients AS d ON b.clients_id = d.id SET ' .
					'a.owner_company_en = d.company_en, ' .
					'a.owner_bank_en = d.bank_en, ' .
					'a.owner_lastname_en = d.lastname_en, ' .
					'a.owner_firstname_en = d.firstname_en, ' .
					'a.owner_patronymicname_en = d.patronymicname_en, ' .
					'a.owner_position_en = d.position_en, ' .
					'a.owner_ground_en = d.ground_en, ' .
					'a.owner_area_en = d.registration_area_en, ' .
					'a.owner_city_en = d.registration_city_en, ' .
					'a.owner_street_en = d.registration_street_en, ' .
					'a.insurer_company_en = d.company_en, ' .
					'a.insurer_bank_en = d.bank_en, ' .
					'a.insurer_lastname_en = d.lastname_en, ' .
					'a.insurer_firstname_en = d.firstname_en, ' .
					'a.insurer_patronymicname_en = d.patronymicname_en, ' .
					'a.insurer_position_en = d.position_en, ' .
					'a.insurer_ground_en = d.ground_en, ' .
					'a.insurer_area_en = d.registration_area_en, ' .
					'a.insurer_city_en = d.registration_city_en, ' .
					'a.insurer_street_en = d.registration_street_en, ' .
					'a.deductible = c.deductible, ' .
					'a.deductible_en = c.deductible_en ' .
					'WHERE a.policies_id = ' . intval($id);
			$db->query($sql);
		}

        $sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
				'JOIN ' . PREFIX . '_policies_drive AS c ON a.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_policies_drive_general AS d ON c.policies_general_id = d.policies_id ' .
                'JOIN ' . PREFIX . '_policies AS e ON d.policies_id = e.id SET ' .
                'a.insurance_companies_id = 4, ' .
				'a.number = IF(a.number, a.number, CONCAT(e.number, \'-\', d.number)), ' .
				'a.clients_id = IF(a.clients_id, a.clients_id, ' . intval($data['clients_id']) . '), ' .
				'a.client_contacts_id = IF(a.client_contacts_id, a.client_contacts_id, ' . intval($data['client_contacts_id']) . '), ' .
				'd.number = IF(a.number, d.number, d.number + 1) ' .
                'WHERE a.id = ' . intval($id);
        $db->query($sql);

		$data['skipClients']	= true;
		$data['skipCalendar']	= (!intval($data['payment_types_id'])) ? true : false;

		parent::setAdditionalFields($id, $data);

		//приходится устанавливать повторно, иначе при обновлении КАСКО клиент не устанавливается
        $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
				'clients_id = ' . intval($data['clients_id']) . ', ' .
				'managers_id = IF(managers_id, managers_id, ' . (($Authorization->data['roles_id'] == ROLES_MANAGER) ? $Authorization->data['id'] : 0) . ') ' .
                'WHERE id = ' . intval($id);
        $db->query($sql);
	}

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization;

		$this->unsetFields();
		
        switch ( $Authorization->data['roles_id'] ) {
            case ROLES_AGENT:
                $data['agencies_id'] = $Authorization->data['agencies_id'];
                $data['agents_id']   = $Authorization->data['id'];
                break;
			case ROLES_CLIENT_CONTACT:
			    $data['agencies_id'] = AGENCIES_EXPRESS_INSURANCE;
                $data['agents_id']   = $Authorization->data['id'];
                break;
            default:
                $data['agencies_id'] = AGENCIES_EXPRESS_INSURANCE;
                $data['agents_id']   = 3172;
                break;
        }

        if (!intval($data['clients_id'])) {
            $data['clients_id']			= $Authorization->data['clients_id'];
            $data['client_contacts_id']	= $Authorization->data['id'];
        }

        $data['policies_id'] = parent::insert(&$data, false, false);

        if ($data['policies_id']) {
            if ($redirect) {
				$params['title']	= $this->messages['single'];
				$params['id']       = $data['policies_id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
        } elseif ($showForm) {
			$this->showForm($data, $GLOBALS['method'], 'insert');
        }
    }

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

		$sql =	'SELECT *, date_format(document_date, ' . $db->quote(DATE_FORMAT) . '), date_format(document_date, \'%Y\') as document_date_year, date_format(document_date, \'%m\') as document_date_month, date_format(document_date, \'%d\') as document_date_day ' .
				'FROM ' . PREFIX . '_policies_drive ' .
				'WHERE policies_id = ' . intval($data['id']);
		$data = array_merge($data, $db->getRow($sql));

        return $data;
    }

	function unsetFields() {
	
		$unsetFields=array('market_price','transmissions_id','car_engine_type_id','car_body_id');
		foreach($unsetFields as $field) {
			$data[ $field ] = '';
			unset($this->itemFormDescription['fields'][ $this->getFieldPositionByName($field,$this->itemFormDescription) ]);
		}
		
	}
    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
		global $Log;

		$this->unsetFields();
        $data['policies_id'] = parent::update(&$data, false, false);

        if ($data['policies_id']) {

            if ($redirect) {
				$params['title']	= $this->messages['single'];
				$params['id']       = $data['policies_id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
        } elseif ($showForm) {
            $this->showForm($data, $GLOBALS['method'], 'update');
        }
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log, $Authorization;

        $conditions[] = 'payment_statuses_id <> ' . PAYMENT_STATUSES_NOT;

		if ($Authorization->data['id'] != 3531 && $Authorization->data['id'] != 1) {//даем Глушак удалять сертификаты, что были внесены задними числами
			$conditions[] = '(policy_statuses_id = ' . POLICY_STATUSES_GENERATED . ' AND begin_datetime < NOW())';
		}

        $sql =	'SELECT id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE id IN(' . implode(', ', $data['id']) . ') AND (' . implode(' OR ', $conditions) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Вилучити можливо лише сертифікати за які не було отримано грошову винагороду та які не вступили в силу.');
            return false;
        }

		$sql =  'DELETE ' .
				'FROM '.PREFIX.'_policies_drive ' .
				'WHERE  policies_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

        return parent::deleteProcess($data, $i, $folder);
    }

    function get($id) {
        global $db;

        $sql =	'SELECT * ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_drive AS b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        $row = $db->getRow($sql);

        return $row;
    }

	function isPayed($id) {
		$payment_statuses_id = Certificates::getpayment_statuses_id($id);

		return $this->isPayedBypayment_statuses_id($payment_statuses_id);
	}

    function prepareValues($fields, $values) {
        global $REGIONS;

        foreach ($fields as $field) {
            switch ($field) {
                case 'insurer_address':
                    $values[ $field ] = Regions::getTitle($values['insurer_regions_id']);

                    if (!in_array($values['insurer_regions_id'], $REGIONS)) {
                        $values[ $field ] .= ', ' .$values['insurer_city'];
                    }

                    $values[ $field ] .=  ', ' . StreetTypes::getTitle($values['insurer_street_types_id']) . ' ' . $values['insurer_street'] . ', буд. ' . $values['insurer_house'];

                    if ($values['insurer_flat']) {
                        $values[ $field ] .= ', оф. ' . $values['insurer_flat'];
                    }
                    break;
				 case 'insurer_addressEn':
                    $values[ $field ] = Regions::getTitle($values['insurer_regions_id'], 'En');

                    if (!in_array($values['insurer_regions_id'], $REGIONS)) {
                        $values[ $field ] .= ', ' .$values['insurer_city_en'];
                    }

                    $values[ $field ] .=  ', ' . StreetTypes::getTitle($values['insurer_street_types_id'], 'En') . ' ' . $values['insurer_street_en'] . ', ' . $values['insurer_house'];

                    if ($values['insurer_flat']) {
                        $values[ $field ] .= ', ste ' . $values['insurer_flat'];
                    }
                    break;
                case 'deductibles0':
                    $values['deductibles0'] = (intval($values['deductibles_absolute0'])) ? $values['deductibles_value0'] . ' грн.' : $values['deductibles_value0'] . ' %';
                    break;
                case 'deductibles1':
					if (in_array(RISKS_HIJACKING1, $values['risks_id'])) {
						$values['deductibles1'] = (intval($values['deductibles_absolute1'])) ? $values['deductibles_value1'] . ' грн.' : $values['deductibles_value1'] . ' %';
					}
                    break;
				  case 'deductibles0En':
                    $values['deductibles0'] = (intval($values['deductibles_absolute0'])) ? $values['deductibles_value0'] . ' UAH' : $values['deductibles_value0'] . ' %';
                    break;
                case 'deductibles1En':
					if (in_array(RISKS_HIJACKING1, $values['risks_id'])) {
						$values['deductibles1'] = (intval($values['deductibles_absolute1'])) ? $values['deductibles_value1'] . ' UAH' : $values['deductibles_value1'] . ' %';
					}
                    break;
            }
        }

        return $values;
    }

    function getValues($file) {
        global $db;

        $sql =  'SELECT a.*, b.*, c.*, d.*, e.*, a.policies_id, ' .
                'f.number AS general_number, f.date AS generalDate ' .
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                'JOIN ' . PREFIX . '_policies_drive AS c ON a.policies_id = c.policies_id ' .
                'JOIN ' . PREFIX . '_policies_kasko AS d ON a.policies_id = d.policies_id ' .
				'JOIN ' . PREFIX . '_policies_kasko_items AS e ON a.policies_id = e.policies_id ' .
                'JOIN ' . PREFIX . '_policies AS f ON c.policies_general_id = f.id ' .
                'WHERE a.id=' . intval($file['id']);
        $row = $db->getRow($sql);

		if ($row['send_en'] || $row['destination_en']){
			$row['En'] = 1;//включить англ язык
		}

        $sql =  'SELECT id, title, title_en ' .
                'FROM ' . PREFIX . '_parameters_risks AS a ' .
                'JOIN ' . PREFIX . '_policy_risks AS b ON a.id = b.risks_id ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $res = $db->query($sql);

		while ($res->fetchInto($risk)) {
			$row['risks'][]		= $risk['title'];
			$row['risksEn'][]	= $risk['title_en'];
			$row['risks_id'][]	= $risk['id'];
		}

		$row['risks'] = '<ul><li>' . implode('</li><li>', $row['risks']) . '</li></ul>';
		$row['risksEn'] = '<ul><li>' . implode('</li><li>', $row['risksEn']) . '</li></ul>';

        $fields = array(
            'insurer_address',
			'insurer_addressEn',
            'deductibles0',
            'deductibles1',
			'deductibles0En',
            'deductibles1En');

        return $this->prepareValues($fields, $row);
    }

    function downloadFileInWindow($data) {
        global $db;

        $policy = unserialize($data['file']);

        $conditions[] = 'policies_id = ' . intval($policy['id']);
        $conditions[] = 'product_document_types_id = ' . DOCUMENT_TYPES_POLICY_DRIVE_CERTIFICATE;

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_policy_documents ' .
                'WHERE ' . implode(' AND ', $conditions);
        $row =  $db->getRow($sql);

        $file = array(
            'id'            => $row['id'],
            'position'      => 4,
            'languageCode'  => '');

        $data['file'] = serialize($file);

        $PolicyDocuments = new PolicyDocuments($data);
        $PolicyDocuments->downloadFileInWindow($data);
    }

    function getPolicyByDocument($clients_id, $document_number, $shassi='') {
        global $db;

        $conditions[] = 'clients_id = ' . intval($clients_id);
        $conditions[] = 'document_number = ' . $db->quote($document_number);

        if ($shassi) {
			$conditions[] = 'c.shassi  = ' . $db->quote($shassi);
		}

        $sql =  'SELECT a.id  ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_drive AS b ON a.id = b.policies_id ' .
        		($shassi ? 'JOIN ' . PREFIX . '_policies_kasko_items AS c ON c.policies_id = b.policies_id ': '').
                'WHERE ' . implode(' AND ', $conditions);
        return $db->getOne($sql);
    }

    function getPolicyByShassiSign($policies_general_id, $sign, $shassi) {
        global $db;

        $conditions[] = 'policies_general_id = ' . intval($policies_general_id);
        $conditions[] = '(shassi = ' . $db->quote($shassi) . ' OR sign = ' . $db->quote($sign) . ')';

        $sql =  'SELECT a.policies_id '.
                'FROM ' . PREFIX . '_policies_kasko_items AS a ' .
                'JOIN ' . PREFIX . '_policies_drive AS b ON a.policies_id = b.policies_id ' .
                'WHERE ' . implode(' AND ', $conditions);
        return $db->getOne($sql);
    }

    function downloadLogInWindow($data) {
        $result = implode("\r\n", unserialize($_SESSION['certificates']['drive']));

        header('Content-Disposition: attachment; filename="log.csv"');
        header('Content-Type: ' . $this->getContentType('log.csv'));
        header('Content-Length: ' . strlen($result));

        echo $result;
        exit;
    }

    function importCertificate($data) {
        global $db, $Log, $Authorization;

		$this->checkPermissions('importCertificate', $data);

//        $itemTypes = array_flip($this->formDescription['fields'][ $this->getFieldPositionByName('item_types_id') ]['list']);

        if ($data['process']) {

            $params = array('Файл', $languageDescription);
            if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
                $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
			} elseif (!ereg('\.xls$', $_FILES['file']['name'])) {
				$Log->add('error', 'Невірний формат файлу, підтримується формат xls.', $params);
			}

            $data['policies_general_id'] = Certificates::getPoliciesGeneralByClients(PRODUCT_TYPES_DRIVE_GENERAL, $Authorization->data['clients_id']);

            if (!$Log->isPresent()) {

				require_once 'Excel/reader.php';

				$Excel = new Spreadsheet_Excel_Reader();
				$Excel->setOutputEncoding(CHARSET);
				$Excel->read($_FILES['file']['tmp_name']);

				$j = 1;
				for ($i = 1; $i < 30; $i++) {//проход по первой строке ищем номер договора
					$colname = $Excel->sheets[0]['cells'][ $j ][ $i ];
					if (strlen($colname) > 0) {
						if (ereg ( '([0-9]{3})\\.[0-9]{2}\\.[0-9A-ZА-Я_\\-]{6,12}' , $colname, $regs  ) ) {
							$general_number = $regs[0];
						}
					}
				}	

				if (strlen($general_number) == 0) {
					$Log->add('error', 'Вказанний номер генерального договору не вірний.', $params);

					unset($_SESSION['certificates']['drive']);
					$Log->showSystem();

					include_once $this->object . '/importCertificate.php';
					return;
				}

				if (!is_array($data['policies_general_id']) && !intval($data['policies_general_id'])) {
					$Log->add('error', 'Не завели генеральний договір по кліенту.');

					header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Policies|show&product_types_id=' . $data['product_types_id']);
					exit;
				}

				$policies_general_id = Certificates::getPoliciesGeneralByClients(PRODUCT_TYPES_DRIVE_GENERAL, $Authorization->data['clients_id'], $general_number);

				if ((intval($data['policies_general_id']) && intval($data['policies_general_id'])!=$policies_general_id)
					 || (is_array($data['policies_general_id']) &&  !in_array ( $policies_general_id , $data['policies_general_id']) ) ) {

						$Log->add('error', 'Вказанний у файлi генеральний договір ' . $general_number . ' не належить кліенту.' , $params);
						unset($_SESSION['certificates']['drive']);

						$Log->showSystem();
						include_once $this->object . '/importCertificate.php';
						return;
				}

				for ($i=1; $i<30; $i++) {//проход по первой колонке ищем признак № п/п

					$colname = $Excel->sheets[0]['cells'][ $i ][ 1 ];

					if (strlen($colname) > 0) {
						if ($colname == '№ п/п') {
							break;
						}
					}
				}

				if ($i >= 29) {
					$Log->add('error', 'Не знайдена строка з перелiком необхiдних колонок' , $params);

					unset($_SESSION['certificates']['drive']);
					$Log->showSystem();

					include_once $this->object . '/importCertificate.php';
					return;
				 }

				 $headerrow = $i;

				 for ($i = 1; $i < 30; $i++) {
					$colname=$Excel->sheets[0]['cells'][ $headerrow ][$i];

					if ($colname=='№ п/п') $cols['№ п/п']=$i;
					if ($colname=='Дата') $cols['Дата']=$i;
					if ($colname=='№ наказу на перегін') $cols['№ наказу на перегін']=$i;
					if ($colname=='Дата початку дії страхового покриття') $cols['Дата початку дії страхового покриття']=$i;
					if ($colname=='Дата закінчення дії страхового покриття') $cols['Дата закінчення дії страхового покриття']=$i;
					if ($colname=='Бренд') $cols['Бренд']=$i;
					if ($colname=='Модель') $cols['Модель']=$i;
					if ($colname=='Номер кузова') $cols['Номер кузова']=$i;
					if ($colname=='Вартість ТЗ, грн з ПДВ') $cols['Вартість ТЗ, грн з ПДВ']=$i;
					if ($colname=='ДТП') $cols['ДТП']=$i;
					if ($colname=='ПДТО') $cols['ПДТО']=$i;
					if ($colname=='Стихійні явища') $cols['Стихійні явища']=$i;
					if ($colname=='Падіння предметів') $cols['Падіння предметів']=$i;
					if ($colname=='Напад тварин') $cols['Напад тварин']=$i;
					if ($colname=='Пожежа, вибух, самозаймання ТЗ') $cols['Пожежа, вибух, самозаймання ТЗ']=$i;
					if ($colname=='Незаконне заволодіння') $cols['Незаконне заволодіння']=$i;
					if ($colname=='Пункт вибуття') $cols['Пункт вибуття']=$i;
					if ($colname=='Адреса пункту вибуття') $cols['Адреса пункту вибуття']=$i;
					if ($colname=='Пункт призначення') $cols['Пункт призначення']=$i;

					if ($colname=='Адреса пункту призначення') $cols['Адреса пункту призначення']=$i;
					if ($colname=='Страховий тариф, %') $cols['Страховий тариф, %']=$i;
					if ($colname=='Страхова премія, грн.') $cols['Страхова премія, грн.']=$i;
					if ($colname=='Франшиза - все риски, кроме риска "угон"') $cols['Франшиза - все риски, кроме риска "угон"']=$i;
					if ($colname=='Франшиза - риск "угон"') $cols['Франшиза - риск "угон"']=$i;
				}

				 for ($i=$headerrow+1; $i<=$Excel->sheets[0]['numRows']; $i++) {

					if (intval($Excel->sheets[0]['cells'][ $i ][$cols['№ п/п']]) == 0) {
						break;
					}

					$sql =	'SELECT a.id AS brands_id, b.id AS models_id, c.car_types_id ' .
							'FROM ' . PREFIX . '_car_brands AS a ' .
							'JOIN ' . PREFIX . '_car_models AS b ON a.id = b.car_brands_id ' .
							'JOIN ' . PREFIX . '_car_type_car_model_assignments AS c ON b.id = c.car_models_id ' .
							'JOIN ' . PREFIX . '_car_types AS d ON c.car_types_id = d.id ' .
							'WHERE a.title = ' . $db->quote($Excel->sheets[0]['cells'][ $i ][$cols['Бренд']]) . ' AND b.title = ' . $db->quote($Excel->sheets[0]['cells'][ $i ][$cols['Модель']]) . ' AND d.product_types_id = ' . PRODUCT_TYPES_KASKO . ' ' .
							'LIMIT 1';
					$car = $db->getRow($sql);

					if (!is_array($car)) {
						$Log->add('error', 'Не знайдена марка та модель авто ' . $Excel->sheets[0]['cells'][ $i ][$cols['Бренд']] . '/' . $Excel->sheets[0]['cells'][ $i ][$cols['Модель']] . ' в рядку ' . $i , $params);
					}
				 }

				 if ($Log->isPresent()) {

					unset($_SESSION['certificates']['drive']);
					$Log->showSystem();

					include_once $this->object . '/importCertificate.php';
					return;
				 }

				$sql = 'SELECT * FROM ' . PREFIX . '_clients WHERE id = ' . intval($Authorization->data['clients_id']);
				$client = $db->getRow($sql);

				$inserted   = 0;
				$updated    = 0;
				$error      = 0;
				$total      = 0;

				$result = '
						<tr><td><b>№ п/п</b></td>
						<td><b>Дата</b></td>
						<td><b>№ наказу на перегін</b></td>
						<td><b>Бренд</b></td>
						<td><b> Модель</b></td>
						<td><b>Номер кузова</b></td>
						<td><b>Статус</b></td></tr>';

				for ($i=$headerrow+1; $i<=$Excel->sheets[0]['numRows']; $i++) {
				 	unset($data);

				 	if (intval($Excel->sheets[0]['cells'][ $i ][$cols['№ п/п']])==0) {
						break;
					}

				 	$policies_id = intval($this->getPolicyByDocument($Authorization->data['clients_id'], $Excel->sheets[0]['cells'][ $i ][$cols['№ наказу на перегін']], $Excel->sheets[0]['cells'][ $i ][$cols['Номер кузова']]));

				 	$data['types_id']					= 2;
				 	$data['product_types_id']			= 11;
				 	$data['clients_id']					= $Authorization->data['clients_id'];
				 	$data['financial_institutions_id']	= 0;
				 	$data['drivers_id']					= 7;
				 	$data['registration_cities_id']		= 1;
				 	$data['residences_id']				= 2;
				 	$data['priority_payments_id']		= 1;
				 	$data['options_deterioration_no']	= 0;
				 	$data['options_taxy']				= 0;
				 	$data['options_agregate_no']		= 0;
				 	$data['options_guilty_no']			= 0;
				 	$data['options_test_drive']			= 0;
				 	$data['options_race']				= 0;
				 	$data['payment_brakedown_id']		= 1;
				 	$data['allowed_products_id']		= '';
					$data['insurance_companies_id']     = 4;

				 	$data['owner_person_types_id']		= 2;
				 	$data['owner_company']				= $client['company'];
				 	$data['owner_bank']					= stripslashes($client['bank']);
				 	$data['owner_bank_account']			= $client['bank_account'];
				 	$data['owner_bank_mfo']				= $client['bank_mfo'];
				 	$data['owner_edrpou']				= $client['identification_code'];
				 	$data['owner_lastname']				= $client['lastname'];
				 	$data['owner_firstname']			= $client['firstname'];
				 	$data['owner_patronymicname']		= $client['patronymicname'];
				 	$data['owner_position']				= $client['position'];
				 	$data['owner_ground']				= $client['ground'];
				 	$data['owner_dateofbirth']			= $client['dateofbirth'];
				 	$data['owner_identification_code']	= $client['identification_code'];
				 	$data['owner_regions_id']			= $client['registration_regions_id'];
				 	$data['owner_area']					= $client['registration_area'];
				 	$data['owner_city']					= $client['registration_city'];
				 	$data['owner_street_types_id']		= $client['registration_street_types_id'];
				 	$data['owner_street']				= $client['registration_street'];
				 	$data['owner_house']				= $client['registration_house'];
				 	$data['owner_flat']					= $client['registration_flat'];
				 	$data['owner_phone']				= $client['habitation_phone'];

				 	$data['insurer_person_types_id']	= 2;
				 	$data['insurer_company']			= $client['company'];
				 	$data['insurer_bank']				= stripslashes($client['bank']);
				 	$data['insurer_bank_account']		= $client['bank_account'];
				 	$data['insurer_bank_mfo']			= $client['bank_mfo'];
				 	$data['insurer_edrpou']				= $client['identification_code'];
				 	$data['insurer_lastname']			= $client['lastname'];
				 	$data['insurer_firstname']			= $client['firstname'];
				 	$data['insurer_patronymicname']		= $client['patronymicname'];
				 	$data['insurer_position']			= $client['position'];
				 	$data['insurer_ground']				= $client['ground'];
				 	$data['insurer_dateofbirth']		= $client['dateofbirth'];
				 	$data['insurer_identification_code']= $client['identification_code'];
				 	$data['insurer_regions_id']			= $client['registration_regions_id'];
				 	$data['insurer_area']				= $client['registration_area'];
				 	$data['insurer_city']				= $client['registration_city'];
				 	$data['insurer_street_types_id']	= $client['registration_street_types_id'];
				 	$data['insurer_street']				= $client['registration_street'];
				 	$data['insurer_house']				= $client['registration_house'];
				 	$data['insurer_flat']				= $client['registration_flat'];
				 	$data['insurer_phone']				= $client['habitation_phone'];
				 	$data['assured_phone']				= $client['habitation_phone'];

				    $data['sign_agents_id']				= 0;
				    $data['policies_general_id']			= $policies_general_id;
				    $data['zones_id']					= 1;
				    $data['terms_id']					= 53;
				    $data['risks']						= array();

				    if ($Excel->sheets[0]['cells'][ $i ][$cols['ДТП']] == 'так') {
						$data['risks'][] = 1;
					}

				   	if ($Excel->sheets[0]['cells'][ $i ][$cols['ПДТО']] == 'так') {
						$data['risks'][] = 2;
					}

				   	if ($Excel->sheets[0]['cells'][ $i ][$cols['Стихійні явища']] == 'так') {
						$data['risks'][] = 3;
					}

				   	if ($Excel->sheets[0]['cells'][ $i ][$cols['Падіння предметів']] == 'так') {
						$data['risks'][] = 4;
					}

				   	if ($Excel->sheets[0]['cells'][ $i ][$cols['Напад тварин']] == 'так') {
						$data['risks'][] = 5;
					}

				   	if ($Excel->sheets[0]['cells'][ $i ][$cols['Пожежа, вибух, самозаймання ТЗ']] == 'так') {
						$data['risks'][] = 6;
					}

				   	if ($Excel->sheets[0]['cells'][ $i ][$cols['Незаконне заволодіння']] == 'так') {
						$data['risks'][]=7;
					}

				   	$item = array();
		   	
				   	$s =	'SELECT a.id AS brands_id, b.id AS models_id, c.car_types_id ' .
							'FROM ' . PREFIX . '_car_brands AS a ' .
							'JOIN ' . PREFIX . '_car_models AS b ON a.id = b.car_brands_id ' .
							'JOIN ' . PREFIX . '_car_type_car_model_assignments AS c ON b.id = c.car_models_id ' .
							'JOIN ' . PREFIX . '_car_types AS d ON c.car_types_id = d.id ' .
							'WHERE a.title = ' . $db->quote($Excel->sheets[0]['cells'][ $i ][$cols['Бренд']]) . ' AND b.title = ' . $db->quote($Excel->sheets[0]['cells'][ $i ][$cols['Модель']]) . ' AND d.product_types_id = ' . PRODUCT_TYPES_KASKO . ' ' .
							'LIMIT 1';
					$car = $db->getRow($s);

				   	$item['car_types_id']			= $car['car_types_id'];
				   	$item['brands_id']				= $car['brands_id'];
				   	$item['models_id']				= $car['models_id'];
				   	$item['car_price']				= doubleval($Excel->sheets[0]['cells'][ $i ][$cols['Вартість ТЗ, грн з ПДВ']]);
				   	$item['engine_size']			= 1;
				   	$item['transmissions_id']		= 1;
				   	$item['year']					= date('Y');
				   	$item['race']					= '0';
				   	$item['colors_id']				= 18;
				   	$item['number_places']			= 5;
				   	$item['shassi']					= $Excel->sheets[0]['cells'][ $i ][$cols['Номер кузова']];

				   	$item['deductibles_value0']		= 0;
				   	$item['deductibles_value1']		= 0;

				   	$item['deductibles_absolute0']	= 0;
				   	$item['deductibles_absolute1']	= 0;

					$deductibles_value0 = doubleval($Excel->sheets[0]['cells'][ $i ][$cols['Франшиза - все риски, кроме риска "угон"']]);
					$deductibles_value1 = doubleval($Excel->sheets[0]['cells'][ $i ][$cols['Франшиза - риск "угон"']]);

					if ($deductibles_value0>100) $item['deductibles_absolute0'] = 1;
					if ($deductibles_value1>100) $item['deductibles_absolute1'] = 1;

					$item['deductibles_value0']	= $deductibles_value0;
				   	$item['deductibles_value1']	= $deductibles_value1;

				   	$item['rate_kasko']		= doubleval($Excel->sheets[0]['cells'][ $i ][$cols['Страховий тариф, %']]);
				   	$item['amount_kasko']	= doubleval($Excel->sheets[0]['cells'][ $i ][$cols['Страхова премія, грн.']]);
				   	$item['amount']			= doubleval($Excel->sheets[0]['cells'][ $i ][$cols['Страхова премія, грн.']]);

					if (intval($policies_id)) {

                        $sql = 'SELECT id ' .
                               'FROM ' . PREFIX . '_policies_kasko_items ' .
                               'WHERE policies_id = ' . intval($policies_id) . ' ' .
                               'ORDER  BY id DESC';
						$items_id = intval($db->getOne($sql));

						if ($items_id) $item['id'] = $items_id;
					}

				   	$data['items'][] = $item;
				   	$data['document_number'] = $Excel->sheets[0]['cells'][ $i ][$cols['№ наказу на перегін']];

				   	$d = $this->convertDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата']]);

				   	$data['date']				= $d;
					$data['date_day']			= substr($d, 0, 2);
					$data['date_month']			= substr($d, 3, 2);
					$data['date_year']			= substr($d, 6, 4);
					
				   	$data['document_date']		= $d;
					$data['document_date_day']	= substr($d, 0, 2);
					$data['document_date_month']	= substr($d, 3, 2);
					$data['document_date_year']	= substr($d, 6, 4);

					$data['send']=$Excel->sheets[0]['cells'][ $i ][$cols['Пункт вибуття']];
				   	$data['destination']=$Excel->sheets[0]['cells'][ $i ][$cols['Пункт призначення']];

				   	$d = $this->convertDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата початку дії страхового покриття']]);
//_dump($d);exit;
				   	$data['begin_datetime']		    = $d;
					$data['begin_datetime_day']	    = substr($d, 0, 2);
					$data['begin_datetime_month']	= substr($d, 3, 2);
					$data['begin_datetime_year']	= substr($d, 6, 4);

					$d = $this->convertDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата закінчення дії страхового покриття']]);

				   	$data['end_datetime']		= $d;
					$data['end_datetime_day']	= substr($d, 0, 2);
					$data['end_datetime_month']	= substr($d, 3, 2);
					$data['end_datetime_year']	= substr($d, 6, 4);

					$data['assured'] = 1;

					$data['assured_title'] = $client['company'];
					$data['assured_identification_code'] = $client['identification_code'];
					$fields = array('insurer_address');
					$values = $this->prepareValues($fields, $data);

					$data['assured_address'] = $values['insurer_address'];
					$data['solutions_id'] = 0;
					$data['policy_statuses_id'] = POLICY_STATUSES_GENERATED;
					$data['checkPermissions'] = 1;
					$data['terms_years_id'] = 1;
					$unsetFields=array('fop','give_a_statement','civil_servant','not_civil_servant','public_figure');
					foreach($unsetFields as $field) {
						$data[ $field ] = '';
						unset($this->formDescription['fields'][ $this->getFieldPositionByName($field) ]);
					}

				  	if ($policies_id) {
						$data['id'] = $policies_id;
                        ($this->update($data, false, false)) ? $updated++ : $error++;
				  	} else {
						($this->insert($data, false, false)) ? $inserted++ : $error++;
                    }

					$status     		= array();
					$messages   		= $Log->get();
					$status['title']	= 'Оброблено';

					$result .= '
						<tr><td>' . $Excel->sheets[0]['cells'][ $i ][$cols['№ п/п']] . '</td>
						<td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Дата']] . '</td>
						<td>' . $Excel->sheets[0]['cells'][ $i ][$cols['№ наказу на перегін']] . '</td>
						<td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Бренд']] . '</td>
						<td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Модель']] . '</td>
						<td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Номер кузова']] . '</td>';

					if (is_array($messages)) {
						foreach ($messages as $message) {
							$status[ $message['type'] ][] = $message['text'];
						}

						$status['title']    = (is_array($status['error'])) ? 'Помилка' : 'Оброблено';
						$status['details']  = (is_array($status['error'])) ? implode(', ', $status[ 'error' ]) : implode(', ', $status[ 'confirm' ]);
					}

					$result.= '<td>'. $status['title'] . ';' . strip_tags($status['details']).'</td></tr>';
					$total++;
				}

				$result='<table border="1">'.$result.'</table>';
				@unlink($_SERVER['DOCUMENT_ROOT'] . '/temp/log.xls');
				file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/temp/log.xls', '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv=Content-Type content="text/html; charset=utf-8"><meta name=ProgId content=Excel.Sheet>' . $result . '</body></html>');

				$Log->add('confirm', '<b>Файл був оброблений.</b><br /><br /><table><tr><td>Створено:</td><td align="right">' . $inserted . '</td></tr><tr><td>Редаговано:</td><td align="right">' . $updated . '</td></tr><tr style="color: #ffffff; font-weight: bold;"><td>Помилки:</td><td align="right">' . $error . '</td></tr><tr style="font-weight: bold;"><td>Всього:</td><td align="right">' . $total . '</td></tr></table><br /><a href="/temp/log.xls">Скачати файл змін</a>' , $params);

				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . PRODUCT_TYPES_DRIVE_CERTIFICATE);
				exit;
            }
        }

        unset($_SESSION['certificates']['drive']);

        $Log->showSystem();

        include_once $this->object . '/importCertificate.php';
    }

    function exportInWindow($data) {
        global $db, $Authorization, $Smarty;

        require_once $Smarty->_get_plugin_filepath('shared','make_timestamp');

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        $this->show($data, null, null, null, 'exportDrive.php', false);
        exit;
    }

	function exportListInWindow($data) {
		global $db;

		$data['special_form'] = 1;
		
		if ($data['number']) {
			$sql = 'SELECT a.date as policies_date, b.*, c.title as registration_street_types_title, d.title as habitation_street_types_title ' .
				   'FROM ' . PREFIX . '_policies as a ' .
				   'JOIN ' . PREFIX . '_clients as b ON a.clients_id = b.id ' .
				   'JOIN ' . PREFIX . '_street_types as c ON b.registration_street_types_id = c.id ' .
				   'JOIN ' . PREFIX . '_street_types as d ON b.habitation_street_types_id = d.id ' .
				   'WHERE a.number = ' . $db->quote($data['number']);
			$data['insurer_info'] = $db->getRow($sql);
		}
		$this->exportInWindow($data);
    }
	
	/* Export 1C7.7. */
    function getXML($data) {
        global $db, $Smarty;

        if ($data['number']) {
            $conditions[] = 'a.number=' . $db->quote(trim($data['number']));
        } else {
            //$conditions[] = 'a.payment_number <> \'\'';
            //$conditions[] = ($data['from']) ? 'TO_DAYS(a.payment_datetime )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.payment_datetime )>=TO_DAYS(NOW())';
            //$conditions[] = ($data['to']) ? 'TO_DAYS(a.payment_datetime )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.payment_datetime ) <= TO_DAYS(NOW())';
           // $conditions[] = ($data['from']) ? 'TO_DAYS(a.modified )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.modified )>=TO_DAYS(NOW())';
           // $conditions[] = ($data['to']) ? 'TO_DAYS(a.modified )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.modified ) <= TO_DAYS(NOW())';
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.date )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.date )>=TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.date )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.date ) <= TO_DAYS(NOW())';

			$conditions[] = '(a.policy_statuses_id = ' . POLICY_STATUSES_GENERATED . ' )';
			$conditions[] = 'a.number not like \'203.10.000010-%\'';
			$conditions[] = 'a.number not like \'203.10.000011-%\'';
        }

        $sql =  'SELECT b.*, a.date,' .
                'a.begin_datetime, ' .
                'a.end_datetime ,  ' .
                'a.begin_datetime AS billDate, ' .
                'a.modified AS modifiedDate, ' .
                'a.created, ' .
                'a.begin_datetime AS payment_datetime, ' .
                'a.policy_statuses_id, \'\' AS payment_number, a.number, '.
                'a.item, a.price, a.rate, a.amount,  '.
				'w.person_types_id AS person_types_id,  '.
                'd.title AS insurerRegionsTitle,  ' .
				'd.id AS insurer_regions_id,  ' .
                'q.number AS general_number, w.company, w.identification_code AS edrpou, w.registration_street_types_id AS insurer_street_types_id, w.registration_area AS insurer_area, w.registration_city AS insurer_city, w.registration_street AS insurer_street, w.registration_house AS insurer_house,w.registration_flat AS insurer_flat, ' .
				'o.assured_title ,o.assured_identification_code '.
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_drive AS b ON b.policies_id=a.id ' .
                'JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id=c.id ' .
				'JOIN ' . PREFIX . '_policies  AS q ON q.id=b.policies_general_id  ' .
				'JOIN ' . PREFIX . '_clients  AS w ON w.id=q.clients_id   ' .				
				'JOIN ' . PREFIX . '_policies_kasko  AS o ON a.id=o.policies_id   ' .				
				'LEFT JOIN ' . PREFIX . '_regions AS d ON w.registration_regions_id=d.id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);
        foreach ($list as $i=>$row) {
            $sql =  'SELECT date AS payment_date, amount AS payment_amount ' .
                    'FROM ' . PREFIX . '_policy_payments_calendar ' .
                    'WHERE policies_id = ' . intval($row['policies_id']);
            $list[ $i ]['paymentsCalendar'] = $db->getAll($sql);

            $fields = array('insurer_address');

            $row = $this->prepareValues($fields, $row);

            $list[ $i ]['insurer_address'] = $row['insurer_address'];

            $sql =  'SELECT risks_id, b.title, a.value ' .
                    'FROM ' . PREFIX . '_policy_risks AS a ' .
                    'JOIN ' . PREFIX . '_parameters_risks AS b ON a.risks_id = b.id ' .
                    'WHERE a.policies_id = ' . intval($row['policies_id']);
            $list[ $i ]['risks'] = $db->getAll($sql);

            $sql =  'SELECT a.*, kt.title AS car_type_title, p.title AS colors_title, f.code AS engine_code ' .
					'FROM ' . PREFIX . '_policies_kasko_items AS a '.
                    'JOIN ' . PREFIX . '_car_types AS kt ON kt.id=a.car_types_id '.
                    'LEFT JOIN ' . PREFIX . '_car_colors AS p ON a.colors_id=p.id '.
                    'LEFT JOIN ' . PREFIX . '_parameters_engine_sizes AS f ON a.engine_sizes_id=f.id AND f.product_types_id =' . PRODUCT_TYPES_KASKO . ' ' .
                    'WHERE a.policies_id=' . intval($row['policies_id']);
            $list[ $i ]['items'] = $db->getAll($sql);
        }

        $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/drive.xml');
    }
}
?>