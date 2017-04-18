<?php

require_once 'Policies/KASKO.class.php';

class Axapta extends Form {



    function Axapta($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Аксапта';
        $this->messages['single'] = 'Аксапта';
    }

    function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'					=> false,
					'insert'				=> false,
					'update'				=> false,
					'view'					=> false,
					'delete'				=> false);
				break;
            case ROLES_AGENT:
                $this->permissions = array(
					'show'					=> ($Authorization->data['agencies_id'] == 1469) ? false : false,
					'insert'				=> false,
					'update'				=> false,
					'view'					=> false,
					'delete'				=> false);
				break;
		}
	}

    function show($data, $fields=null, $conditions=null, $sql=null, $template = 'show.php', $limit = true){
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

        $axapta_list = $this->getAxapataId();

        $fields[] = 'do';
		$data['do'] = $this->object . '|show';

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        if(sizeof($axapta_list) > 0){
            if ($data['owner_lastname']) {
                $conditions[] = 'axapta.lastname LIKE ' . $db->quote('%' . $data['owner_lastname'] . '%') . ' ';
            }

            $conditions[] = 'axapta.id IN (' . implode($axapta_list, ', ') . ')';

            $sql = 'SELECT  axapta.id, axaptaDealer, brand, dateofbirth, date_format(sa_date, \'%d.%m.%Y\') as sa_date, date_format(modified, \'%d.%m.%Y\') as modified, mobilePhone, model, priceWithNDS, registrationAddress, lastname ' .
                    'FROM ' . PREFIX . '_axapta as axapta ' .
                    'WHERE (' . implode(' AND ', $conditions) . ' ' . ') ' .
                    'ORDER BY axapta.sa_date desc';

            $total = $db->getOne(transformToGetCount($sql));

            $sql .= $this->getShowOrderCondition();
            $for_totla = $db->getAll($sql);
            $total = sizeof($for_totla);
            if ($limit) {
                $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
            }

            $list = $db->getAll($sql);
        }

        include $this->objectTitle . '/' . $template;
    }

    function getAxapataId(){
        global $db;

        $sql = 'SELECT id ' .
                'FROM ' . PREFIX . '_axapta as a ' .
                'LEFT JOIN ' . PREFIX . '_axapta_policies as b ON a.id = b.axapta_id ' .
                'WHERE b.axapta_id is NULL';
        return $db->getCol($sql);
    }

    function sendAdaptedFieldsToAdd($data){
        global $db;

        $sql = 'SELECT id as axapta_id, engine_size, lastname COLLATE utf8_unicode_ci as lastname, year, shassi, date_format(dateofbirth, \'%d.%m.%Y\') as owner_dateofbirth, brand, model, passportNumber as owner_passport_number, ' .
                    'mobilePhone, date_format(passportDate, \'%d.%m.%Y\') as owner_passport_date, identificationCode as owner_identification_code, ' .
                    'passportPlace COLLATE utf8_unicode_ci as owner_passport_place, passportSeries COLLATE utf8_unicode_ci as owner_passport_series, axaptaDealer COLLATE utf8_unicode_ci as dealer, priceWithNDS as price '.
                    'FROM ' . PREFIX . '_axapta WHERE id = ' . intval($data['id']);
        $list = $db->getRow($sql);


        $list['items'][0]['engine_size'] = $list['engine_size'];
        $list['items'][0]['year'] = $list['year'];
        $list['items'][0]['shassi'] = $list['shassi'];
        $list['items'][0]['car_price'] = getRateFormat($list['price'], 0);
        $list['items'][0]['car_types_id'] = $this->getType($this->getModel($list['model'], $this->getBrand($list['brand'])));
        $list['items'][0]['brands_id'] = $this->getBrand($list['brand']);
        $list['items'][0]['models_id'] = $this->getModel($list['model'], $this->getBrand($list['brand']));

        $list['insurance_companies_id'] = INSURANCE_COMPANIES_EXPRESS;
        $list['mobilePhone'] = preg_replace('/[^0-9]/', '', $list['mobilePhone']);
        if(strlen($list['mobilePhone']) > 10){
            if($list['mobilePhone'][0] == 8){
                $list['mobilePhone'] = substr($list['mobilePhone'], 1);
            }
            $list['mobilePhone'] = str_replace('380', '0', $list['mobilePhone']);
            $list['owner_phone'] = '(' . substr($list['mobilePhone'], 0, 3) . ') ' . substr($list['mobilePhone'], 3, 3) . '-' . substr($list['mobilePhone'], 6, 2) . '-' . substr($list['mobilePhone'], 8, 2);
        }
        elseif(strlen($list['mobilePhone']) == 10){
            $list['owner_phone'] = '(' . substr($list['mobilePhone'], 0, 3) . ') ' . substr($list['mobilePhone'], 3, 3) . '-' . substr($list['mobilePhone'], 6, 2) . '-' . substr($list['mobilePhone'], 8, 2);
        }


        if($list['owner_dateofbirth'] == '01.01.1900'){
            $list['owner_person_types_id'] = 2;
            $list['owner_edrpou'] = $list['owner_identification_code'];
            $list['owner_company'] = htmlspecialchars($list['lastname']);
        }
        else{
            $list['owner_passport_date_day'] = substr($list['owner_passport_date'], 0, 2);
            $list['owner_passport_date_month'] = substr($list['owner_passport_date'], 3, 2);
            $list['owner_passport_date_year'] = substr($list['owner_passport_date'], 6, 4);

            $list['owner_dateofbirth_day'] = substr($list['owner_dateofbirth'], 0, 2);
            $list['owner_dateofbirth_month'] = substr($list['owner_dateofbirth'], 3, 2);
            $list['owner_dateofbirth_year'] = substr($list['owner_dateofbirth'], 6, 4);

            $list['owner_person_types_id'] = 1;
            $list['owner_lastname'] = substr($list['lastname'], 0, strpos($list['lastname'], ' '));
            $firstname_patronymicname = substr($list['lastname'], strpos($list['lastname'], ' ') + 1);
            $list['owner_firstname'] = substr($firstname_patronymicname, 0, strpos($firstname_patronymicname, ' '));
            $list['owner_patronymicname'] = substr($firstname_patronymicname, strpos($firstname_patronymicname, ' ') + 1);
        }

        $agents_info = $this->getAgentID($list['dealer']);
        $list['agents_id'] = $agents_info['accounts_id'];
        $list['agencies_id'] = $agents_info['agencies_id'];

        $list['product_types_id'] = PRODUCT_TYPES_KASKO;
        $list['do'] = 'Policies|add';
        $list['id'] = 0;

        $Policies_KASKO = new Policies_KASKO($list);
        $Policies_KASKO->add($list);

    }

    function getColor($color){
        global $db;

        return $db->getOne('SELECT id FROM ' . PREFIX . '_car_colors WHERE title = ' . $db->quote($color));
    }

    function getBrand($brand){
        global $db;

        return $db->getOne('SELECT id FROM ' . PREFIX . '_car_brands WHERE title = ' . $db->quote($brand));
    }

    function getModel($model, $brand){
        global $db;

        return $db->getOne('SELECT a.id ' .
                           'FROM ' . PREFIX . '_car_models as a ' .
                           'JOIN ' . PREFIX . '_car_type_car_model_assignments as b ON  a.id = b.car_models_id ' .
                           'JOIN ' . PREFIX . '_car_types as c ON  b.car_types_id = c.id ' .
                           'WHERE a.car_brands_id =  ' . intval($brand) . ' and a.title = ' . $db->quote($model));
    }

    function getType($models_id){
        global $db;

        return $db->getOne('SELECT car_types_id ' .
                           'FROM ' . PREFIX . '_car_type_car_model_assignments as b ' .
                           'JOIN ' . PREFIX . '_car_types as c ON  b.car_types_id = c.id ' .
                           'WHERE  product_types_id = 3 and car_models_id = ' . intval($models_id));
    }

    function getAgentID($agent){
        global $db;

        return $db->getRow('SELECT accounts.id as accounts_id, agents.agencies_id '.
                           'FROM ' . PREFIX . '_accounts as accounts '.
                           'JOIN ' . PREFIX . '_agents as agents ON accounts.id = agents.accounts_id '.
                           'WHERE accounts.lastname = ' . $db->quote($agent));
    }

    function insertAxaptaPolicies($policies_id, $axapta_id){
        global $db;

        $sql =  'INSERT INTO ' . PREFIX . '_axapta_policies SET ' .
                        'policies_id = ' . intval($policies_id) . ', ' .
                        'axapta_id = ' . intval($axapta_id);
        $db->query($sql);
    }
}