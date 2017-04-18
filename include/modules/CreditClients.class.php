<?
/*
 * Title: credit_client class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';
require_once 'PolicyPayments.class.php';
require_once 'CreditClientCars.class.php';

class CreditClients extends Form {

	var $formDescription =
			array(
				'fields' 	=>
					array(
						array(
							'name'				=> 'id',
					        'type'				=> fldIdentity,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'person_types_id',
							'description'		=> 'Тип особи',
					        'type'				=> fldRadio,
					        'list'				=> array(
					        	'1' => 'Фiзична',
					        	'2' => 'Юридична'),
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'company',
							'description'		=> 'Компанія',
					        'type'				=> fldText,
					        'maxlength'			=> 150,
							'display'			=>
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 1,
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'position',
							'description'		=> 'Посада',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'lastname',
							'description'		=> 'Прізвище',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 2,
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'firstname',
							'description'		=> 'Ім\'я',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 3,
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'patronymicname',
							'description'		=> 'По батькові',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 4,
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'cars_title',
							'description'		=> 'Авто',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 5,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'price',
							'description'		=> 'Вартість',
					        'type'				=> fldMoney,
							'display'			=>
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 6,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'credit_period',
							'description'		=> 'Термін кредитування',
					        'type'				=> fldInteger,
							'display'			=>
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 7,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'sexes_id',
							'description'		=> 'Стать',
					        'type'				=> fldSelect,
					        'list'				=> array(
						        					1 => 'чоловіча',
						        					2 => 'жіноча'),
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'dateofbirth',
							'description'		=> 'Дата народження',
					        'type'				=> fldDate,
					        'input'				=> true,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'passport_series',
							'description'		=> 'Паспорт, серія',
					        'type'				=> fldText,
					        'maxlength'			=> 2,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'passport_number',
							'description'		=> 'Паспорт, номер',
					        'type'				=> fldText,
					        'maxlength'			=> 13,
							'validationRule'	=> '^([0-9]{6}|[0-9]{6}\/[0-9]{6})$',
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'passport_place',
							'description'		=> 'Паспорт, ким і де виданий',
					        'type'				=> fldText,
					        'maxlength'			=> 100,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'passport_date',
							'description'		=> 'Паспорт, дата видачі',
					        'type'				=> fldDate,
					        'input'				=> true,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'identification_code',
							'description'		=> 'ІПН',
					        'type'				=> fldText,
					        'maxlength'			=> 10,
							'validationRule'	=> '^[0-9]{10}$',
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'mobile_phone',
							'description'		=> 'Мобільний телефон',
					        'type'				=> fldText,
					        'validationRule'	=> '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
							'maxlength'			=> 15,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 7,
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'email',
							'description'		=> 'E-mail',
					        'type'				=> fldEmail,
							'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'driver_licence_series',
							'description'		=> 'Водійські права, серія',
					        'type'				=> fldText,
					        'maxlength'			=> 3,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'driver_licence_number',
							'description'		=> 'Водійські права, номер',
					        'type'				=> fldText,
					        'maxlength'			=> 6,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'driver_licence_place',
							'description'		=> 'Водійські права, місце видачі',
					        'type'				=> fldText,
					        'maxlength'			=> 100,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'driver_licence_date',
							'description'		=> 'Водійські права, дата видачі',
					        'type'				=> fldDate,
					        'input'				=> true,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'registration_regions_id',
							'description'		=> 'Адреса реєстрації, область',
					        'type'				=> fldSelect,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients',
							'sourceTable'		=> 'regions',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'registration_area',
							'description'		=> 'Адреса реєстрації, район',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'registration_city',
							'description'		=> 'Адреса реєстрації, місто',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'registration_street_types_id',
							'description'		=> 'Адреса реєстрації, тип вулиці',
					        'type'				=> fldSelect,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients',
							'sourceTable'		=> 'street_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'registration_street',
							'description'		=> 'Адреса реєстрації, вулиця',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'registration_house',
							'description'		=> 'Адреса реєстрації, будинок',
					        'type'				=> fldText,
							'maxlength'			=> 10,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'registration_flat',
							'description'		=> 'Адреса реєстрації, квартира',
					        'type'				=> fldText,
							'maxlength'			=> 10,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'registration_phone',
							'description'		=> 'Реєстрація, телефон',
					        'type'				=> fldText,
					        'validationRule'	=> '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
							'maxlength'			=> 15,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 8,
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'habitation_regions_id',
							'description'		=> 'Адреса фактичного проживання, область',
					        'type'				=> fldSelect,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients',
							'sourceTable'		=> 'regions',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'habitation_area',
							'description'		=> 'Адреса фактичного проживання, район',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'habitation_city',
							'description'		=> 'Адреса фактичного проживання, місто',
					        'type'				=> fldText,
							'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'habitation_street_types_id',
							'description'		=> 'Адреса фактичного проживання, тип вулиці',
					        'type'				=> fldSelect,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients',
							'sourceTable'		=> 'street_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'habitation_street',
							'description'		=> 'Адреса фактичного проживання, вулиця',
					        'type'				=> fldText,
							'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'habitation_house',
							'description'		=> 'Адреса фактичного проживання, будинок',
					        'type'				=> fldText,
							'maxlength'			=> 10,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'habitation_flat',
							'description'		=> 'Адреса фактичного проживання, квартира',
					        'type'				=> fldText,
							'maxlength'			=> 10,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'habitation_phone',
							'description'		=> 'Проживання, телефон',
					        'type'				=> fldText,
					        'validationRule'	=> '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
							'maxlength'			=> 15,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 9,
							'table'				=> 'credit_clients'),
/*
						array(
							'name'				=> 'bank_account',
							'description'		=> 'Розрахунковий рахунок',
					        'type'				=> fldText,
							'maxlength'			=> 50,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'mfo',
							'description'		=> 'МФО',
					        'type'				=> fldText,
					        'validationRule'	=> '^[0-9]{6}$',
							'maxlength'			=> 6,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'credit_clients'),
 */
						array(
							'name'				=> 'agencies_id',
							'description'		=> 'Автосалон',
					        'type'				=> fldSelect,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 10,
							'table'				=> 'credit_client_cars',
							'sourceTable'		=> 'agencies',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
						array(
							'name'				=> 'financial_institutions_title',
							'description'		=> 'Банк',
					        'type'				=> fldText,
							'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 11,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'begin_datetime',
							'description'		=> 'Початок',
					        'type'				=> fldDate,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 12,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'end_datetime',
							'description'		=> 'Кінець',
					        'type'				=> fldDate,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 13,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'credit_agreement_date',
							'description'		=> 'Дата кредитного договору',
					        'type'				=> fldDate,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 14,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'credit_set_datetime',
							'description'		=> 'Призначена дата кредитної угоди',
					        'type'				=> fldDate,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 15,
							'table'				=> 'credit_client_cars'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'credit_clients'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
                            'width'             => 100,
							'table'				=> 'credit_clients')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'CONCAT(lastname, \' \', firstname)')
			);

    function CreditClients($data) {
        global $Authorization;

        Form::Form($data);

        $this->messages['plural'] = 'Клієнти';
        $this->messages['single'] = 'Клієнт';

        switch ($data['person_types_id']) {
            case 2://юридические лица
                $this->formDescription['fields'][ $this->getFieldPositionByName('identification_code') ]['description'] = 'ЄРДПОУ';
                $this->formDescription['fields'][ $this->getFieldPositionByName('identification_code') ]['validationRule'] = '^[0-9]{8}$';

                $unsetFields = array(
                    'passport_series',
                    'passport_number',
                    'passport_place',
                    'passport_date',
                    'mobile_phone',
                    'driver_licence_series',
                    'driver_licence_number',
                    'driver_licence_place',
                    'driver_licence_date',
                    'registration_phone');

                foreach ($this->formDescription['fields'] as $i => $field) {
                    if (in_array($field['name'], $unsetFields) || $field['table'] != 'credit_clients') {
                        unset($this->formDescription['fields'][ $i ]);
                    }
                }

                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_regions_id' ) ]['description'] = 'Юридична адреса, область';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_area' ) ]['description'] = 'Юридична адреса, район';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_city' ) ]['description'] = 'Юридична адреса, місто';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_street_types_id' ) ]['description'] = 'Юридична адреса, тип вулиці';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_street' ) ]['description'] = 'Юридична адреса, вулиця';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_house' ) ]['description'] = 'Юридична адреса, будинок';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_flat' ) ]['description'] = 'Юридична адреса, офіс';

                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_regions_id' ) ]['description'] = 'Фактична адреса, область';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_area' ) ]['description'] = 'Фактична адреса, район';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_city' ) ]['description'] = 'Фактична адреса, місто';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_street_types_id' ) ]['description'] = 'Фактична адреса, тип вулиці';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_street' ) ]['description'] = 'Фактична адреса, вулиця';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_house' ) ]['description'] = 'Фактична адреса, будинок';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_flat' ) ]['description'] = 'Фактична адреса, офіс';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_phone' ) ]['description'] = 'Фактична адреса, телефон';

                $this->formDescription['common'] =
                    array(
                    'defaultOrderPosition'	=> 1,
                    'defaultOrderDirection'	=> 'asc',
                    'titleField'			=> 'company');

                break;
            default://физические лица
                unset($this->formDescription['fields'][ $this->getFieldPositionByName( 'company' ) ]);

                $this->formDescription['common'] =
                    array(
                    'defaultOrderPosition'	=> 2,
                    'defaultOrderDirection'	=> 'asc',
                    'titleField'			=> 'CONCAT(lastname, \' \', firstname)');

                break;
        }

        $this->setMode($data);

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
                $this->showActions = true;
                break;
        }
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'		=> true,
                    'insert'	=> true,
                    'update'	=> true,
                    'view'		=> true,
                    'change'	=> false,
                    'delete'	=> true,
                    'export'	=> true);
                break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'		=> true,
                    'insert'	=> false,
                    'update'	=> false,
                    'view'		=> true,
                    'change'	=> false,
                    'delete'	=> false);

                if ($Authorization->data['agencies_id'] != 1) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('agencies_id') ]['display']['show'] = false;
                }

                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true, $returnSQL=false) {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
                if ($Authorization->data['agencies_id'] != 1) {
                    $data['agencies_id'] = $Authorization->data['agencies_id'];
                }
                break;
        }

        if (!intval($data['person_types_id'])) {
            $data['person_types_id'] = 1;
        }

        $fields[] = 'person_types_id';
        $conditions[] = 'person_types_id = ' . intval($data['person_types_id']);

        switch ($data['person_types_id']) {
            case 2://юридические лица
                if ($data['company']) {
                    $fields[] = 'company';
                    $conditions[] = 'company LIKE ' . $db->quote($data['company'] . '%');
                }

                if ($data['edrpou']) {
                    $fields[] = 'edrpou';
                    $conditions[] = 'identification_code LIKE ' . $db->quote($data['edrpou'] . '%');
                }
                break;
            default://физические лица
                if ($data['lastname']) {
                    $fields[] = 'lastname';
                    $conditions[] = 'lastname LIKE ' . $db->quote($data['lastname'] . '%');
                }

                if ($data['identification_code']) {
                    $fields[] = 'identification_code';
                    $conditions[] = 'identification_code LIKE ' . $db->quote($data['identification_code'] . '%');
                }
                if ($data['from']) {
                    $from = $db->quote(substr($data['from'], 6, 4) .'-'. substr($data['from'], 3, 2) .'-'. substr($data['from'], 0, 2) . ' 00:00:00');
                    $conditions[] = 'credit_agreement_date > '.$from;

                }

                if ($data['to']) {
                    $to = $db->quote(substr($data['to'], 6, 4) .'-'. substr($data['to'], 3, 2) .'-'. substr($data['to'], 0, 2) . ' 23:59:59');
                    $conditions[] = 'credit_agreement_date < '.$to;
                }

                break;
        }

        if (intval($data['financial_institutions_id'])) {
            $fields[] = 'financial_institutions_id';
            $conditions[] = 'financial_institutions_id = ' . intval($data['financial_institutions_id']);
        }

        if (intval($data['agencies_id'])) {
            $fields[] = 'agencies_id';
            $conditions[] = 'agencies_id = ' . intval($data['agencies_id']);
        }

        $hidden['do'] = $data['do'];

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        if ($sql) {
            $sql .= ' ORDER BY ';
        } elseif (is_array($conditions)) {
            $sql = 'SELECT ' . $this->getShowFieldsSQLString() . ' FROM ' . implode(', ', $this->tables) . ' WHERE ' . $this->getAssignmentConditions('show', '', ' AND ') . ' ' . implode(' AND ', $conditions) . ' ORDER BY ';
        } else {
            $sql = 'SELECT ' . $this->getShowFieldsSQLString() . ' FROM ' . implode(', ', $this->tables) . ' ' . $this->getAssignmentConditions('show', ' WHERE ') . ' ORDER BY ';
        }

        $total = $db->getOne(transformToGetCount($sql));

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        if ($returnSQL) {
            return $sql;
        }

        $list = $db->getAll($sql);

        $this->changePermissions($total);

        $sql =  'SELECT id, title ' .
                'FROM ' . PREFIX . '_financial_institutions ' .
                'ORDER BY title';
        $data['financial_institutions'] = $db->getAll($sql, 30 * 60);

        $sql =	'SELECT id, title ' .
                'FROM ' . PREFIX . '_agencies ' .
                'ORDER BY title';
        $data['agencies'] = $db->getAll($sql, 30 * 60);

        include $this->object . '/show.php';
    }

    function setMode($data) {
        if (ereg('^(' . $this->object . '|Policies)\|view', $data['do'])) {
            $this->mode = 'view';
        } else {
            $this->mode = 'update';
        }
    }

    function getReadonly($select=false) {
        return ($this->mode == 'update')
            ? ''
            : ' style="color: #666666; background-color: #f5f5f5;" ' . (($select) ? 'disabled' : 'readonly');
    }

    function changePersonTypeInWindow($data) {

        $this->setListValues($data, 'insert');

        switch ($data['person_types_id']) {
            case '1':
                include_once $this->object . '/private.php';
                break;
            case '2':
                include_once $this->object . '/company.php';
                break;
        }
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        return parent::showForm($data, $action, $actionType, 'form.php');
    }

    function view($data) {
        if ($data['credit_clients_id'])
            $data['id'] = $data['credit_clients_id'];

        $row = parent::view($data);

        $data['credit_clients_id']	= $row['id'];

        $fields[]			= 'credit_clients_id';
        $conditions[]		= 'credit_clients_id=' . intval($data['credit_clients_id']);

        switch ($data['person_types_id']) {
            case 1://частные лица
                $CreditClientCars = new CreditClientCars($data);
                $CreditClientCars->show($data, $fields, $conditions);
/*
    $Policies = Policies::factory($data, 'KASKO');
$Policies->show($data, $fields, $conditions);

$Policies = Policies::factory($data, 'GO');
$Policies->show($data, $fields, $conditions);

    $PolicyPayments = new PolicyPayments($data);
$PolicyPayments->show($data, $fields, $conditions);
*/
                break;
            case 2://юридические лица
                break;
        }

    //    	$Events = Events::factory($data, 'KASKO');
    //		$Events->show($data, $fields, $conditions);
    }

    function exportInWindow($data) {
        global $db, $Smarty;

        $sql = $this->show($data, $fields, $conditions, null, null, false, true);
        $list = $db->getAll($sql);

        $Smarty->assign('list', $list);

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));
        echo $Smarty->fetch($this->object . '/export.tpl');
        exit;
    }

    function getRowValues($data, $row, $hidden, $total, $object=null) {
        global $Authorization;

        $result = parent::getRowValues($data, $row, $hidden, $total, $object);

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
                $result .= '<td align="center">';
                $result .= '<a href="?do=' . $this->object . '|createKasko&amp;carsId=' . $row['id'] . '">КАСКО</a> | ';
                $result .= '<a href="?do=' . $this->object . '|createGO&amp;carsId=' . $row['id'] . '">ЦВ</a>';
                $result .= '</td>';
                break;
        }

        return $result;
    }

    function createKasko($data) {
        global $db;

        if (!$data['carsId']) {
            exit;
        }

        $sql =	'SELECT a.*, b.*, ' .
                'a.price as car_price, ' .
                'b.lastname as owner_lastname, ' .
                'b.firstname as owner_firstname, ' .
                'b.patronymicname as owner_patronymicname, ' .
                'b.dateofbirth as owner_dateofbirth, ' .
                'b.passport_series as owner_passport_series, ' .
                'b.passport_number as owner_passport_number, ' .
                'b.passport_place as owner_passport_place, ' .
                'b.passport_date as owner_passport_date, ' .
                'b.driver_licence_series as ownerDriverLicenceSeries, ' .
                'b.driver_licence_number as ownerDriverLicenceNumber, ' .
                'b.identification_code as owner_identification_code, ' .
                'b.mobile_phone as owner_phone, ' .
                'b.registration_regions_id as owner_regions_id, ' .
                'b.registration_city as owner_city, ' .
                'b.registration_street as owner_street, ' .
                'b.registration_house as owner_house, ' .
                'b.registration_flat as owner_flat, ' .
                'b.lastname as insurer_lastname, ' .
                'b.firstname as insurer_firstname, ' .
                'b.patronymicname as insurer_patronymicname, ' .
                'b.dateofbirth as insurer_dateofbirth, ' .
                'b.passport_series as insurer_passport_series, ' .
                'b.passport_number as insurer_passport_number, ' .
                'b.passport_place as insurer_passport_place, ' .
                'b.passport_date as insurer_passport_date, ' .
                'b.driver_licence_series as insurer_driver_licence_series, ' .
                'b.driver_licence_number as insurer_driver_licence_number, ' .
                'b.identification_code as insurer_identification_code, ' .
                'b.mobile_phone as insurer_phone, ' .
                'b.registration_regions_id as insurer_regions_id, ' .
                'b.registration_city as insurer_city, ' .
                'b.registration_street as insurer_street, ' .
                'b.registration_house as insurer_house, ' .
                'b.registration_flat as insurer_flat ' .
                'FROM ' . PREFIX . '_credit_client_cars a ' .
                'JOIN ' . PREFIX . '_credit_clients b on a.credit_clients_id=b.id ' .
                'WHERE a.id=' . intval($data['carsId']);
        $data = $db->getRow($sql);

        $data['car_types_id'] = 8;
        $data['brand_old'] = $data['brand'];
        $data['model_old'] = $data['model'];

        $data['owner_dateofbirth']	= setDateTime($data, 'owner_dateofbirth', $data['owner_dateofbirth']);
        $data['owner_passport_date']	= setDateTime($data, 'owner_passport_date', $data['owner_passport_date']);
        $data['insurer_dateofbirth']     = setDateTime($data, 'insurer_dateofbirth', $data['insurer_dateofbirth']);
        $data['insurer_passport_date'] 	= setDateTime($data, 'insurer_passport_date', $data['insurer_passport_date']);

        $data['product_types_id'] = PRODUCT_TYPES_KASKO;
        $Policies = Policies::factory($data, 'KASKO');
        $Policies->add($data);
    }

    function createGO($data) {
        global $db;

        if (!$data['carsId']) {
            exit;
        }

        $sql =  'SELECT a.*, b.*, ' .
                'b.lastname as insurer_lastname, ' .
                'b.firstname as insurer_firstname, ' .
                'b.patronymicname as insurer_patronymicname, ' .
                'b.dateofbirth as insurer_dateofbirth, ' .
                'b.driver_licence_series as insurer_driver_licence_series, ' .
                'b.driver_licence_number as insurer_driver_licence_number, ' .
                'b.identification_code as insurer_identification_code, ' .
                'b.mobile_phone as insurer_phone, ' .
                'b.registration_regions_id as insurer_regions_id, ' .
                'b.registration_city as insurer_city, ' .
                'b.registration_street as insurer_street, ' .
                'b.registration_house as insurer_house, ' .
                'b.registration_flat as insurer_flat ' .
                'FROM ' . PREFIX . '_credit_client_cars a ' .
                'JOIN '.PREFIX.'_credit_clients b ON a.credit_clients_id=b.id ' .
                'WHERE a.id = ' . intval($data['carsId']);
        $data = $db->getRow($sql);

        $data['car_types_id'] = 1;
        $data['brand_old'] = $data['brand'];
        $data['model_old'] = $data['model'];

        $data['product_types_id'] = PRODUCT_TYPES_GO;

        $Policies = Policies::factory($data, 'GO');
        $Policies->add($data);
    }
}

?>
