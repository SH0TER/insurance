<?
/*
 * Title: client class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';
require_once 'ClientCars.class.php';
require_once 'ClientPoints.class.php';
require_once 'PolicyPayments.class.php';
require_once 'ClientBeneficiaries.class.php';
require_once 'PolicyPaymentsCalendar.class.php';

class Clients extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'                  => 'id',
                            'type'                  => fldIdentity,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'agents_id',
                            'description'           => 'Агент',
                            'type'                  => fldHidden,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'person_types_id',
                            'description'           => 'Тип особи',
                            'type'                  => fldRadio,
                            'list'                  => array(
                                '1' => 'Фiзична',
                                '2' => 'Юридична'),
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'company',
                            'description'           => 'Компанія',
                            'type'                  => fldText,
                            'maxlength'             => 150,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 1,
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'lastname',
                            'description'           => 'Прізвище',
                            'type'                  => fldText,
                            'maxlength'             => 50,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 2,
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'firstname',
                            'description'           => 'Ім\'я',
                            'type'                  => fldText,
                            'maxlength'             => 50,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'orderPosition'         => 3,	
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'patronymicname',
                            'description'           => 'По батькові',
                            'type'                  => fldText,
                            'maxlength'             => 50,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'position',
                            'description'           => 'Посада',
                            'type'                  => fldText,
                            'maxlength'             => 150,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'ground',
                            'description'           => 'Діє на підставі',
                            'type'                  => fldText,
                            'maxlength'             => 50,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'sexes_id',
                            'description'           => 'Стать',
                            'type'                  => fldSelect,
                            'list'                  => array(
                                                        1 => 'чоловіча',
                                                        2 => 'жіноча'),
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'dateofbirth',
                            'description'           => 'Дата народження',
                            'type'                  => fldDate,
                            'input'                 => true,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),

                        array(
                            'name'                  => 'company_en',
                            'description'           => 'Компанія (англійська)',
                            'type'                  => fldText,
                            'maxlength'             => 150,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'lastname_en',
                            'description'           => 'Прізвище (англійська)',
                            'type'                  => fldText,
                            'maxlength'             => 50,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'firstname_en',
                            'description'           => 'Ім\'я (англійська)',
                            'type'                  => fldText,
                            'maxlength'             => 50,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'patronymicname_en',
                            'description'           => 'По батькові (англійська)',
                            'type'                  => fldText,
                            'maxlength'             => 50,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'position_en',
                            'description'           => 'Посада (англійська)',
                            'type'                  => fldText,
                            'maxlength'             => 150,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'ground_en',
                            'description'           => 'Діє на підставі (англійська)',
                            'type'                  => fldText,
                            'maxlength'             => 50,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'passport_series',
                            'description'           => 'Паспорт, серія',
                            'type'                  => fldText,
                            'maxlength'             => 2,
                                'display'           =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'passport_number',
                            'description'           => 'Паспорт, номер',
                            'type'                  => fldText,
                            'maxlength'             => 13,
                            'validationRule'        => '^([0-9]{6}|[0-9]{6}\/[0-9]{6})$',
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'passport_place',
                            'description'           => 'Паспорт, ким і де виданий',
                            'type'                  => fldText,
                            'maxlength'             => 100,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'passport_date',
                            'description'           => 'Паспорт, дата видачі',
                            'type'                  => fldDate,
                            'input'                 => true,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'identification_code',
                            'description'           => 'ІПН (ЄДРПОУ)',
                            'type'                  => fldText,
                            'maxlength'             => 10,
                            'validationRule'        => '^[0-9]{8,10}$',
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'mobile_phone',
                            'description'           => 'Мобільний телефон',
                            'type'                  => fldPhone,
                            'validationRule'        => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
                            'maxlength'             => 15,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 4,
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'email',
                            'description'           => 'E-mail',
                            'type'                  => fldEmail,
                            'maxlength'             => 50,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'driver_licence_series',
                            'description'           => 'Водійські права, серія',
                            'type'                  => fldText,
                            'maxlength'             => 3,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'driver_licence_number',
                            'description'           => 'Водійські права, номер',
                            'type'                  => fldText,
                            'maxlength'             => 9,
                            'validationRule'    	=> '(^[0-9]{6}$)|(^[0-9]{9}$)',
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'driver_licence_place',
                            'description'           => 'Водійські права, місце видачі',
                            'type'                  => fldText,
                            'maxlength'             => 100,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'driver_licence_date',
                            'description'           => 'Водійські права, дата видачі',
                            'type'                  => fldDate,
                            'input'                 => true,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'clients'),
                        array(
                            'name'                  => 'registration_regions_id',
                            'description'           => 'Адреса реєстрації, область',
                            'type'                  => fldSelect,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients',
                            'sourceTable'        => 'regions',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'registration_area',
                            'description'        => 'Адреса реєстрації, район',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'registration_city',
                            'description'        => 'Адреса реєстрації, місто',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients'),
						array(
							'name'				=> 'registration_street_types_id',
							'description'		=> 'Адреса реєстрації, тип вулицi',
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
							'table'				=> 'clients',
							'sourceTable'		=> 'street_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
                        array(
                            'name'                => 'registration_street',
                            'description'        => 'Адреса реєстрації, вулиця',
                            'type'                => fldText,
                            'maxlength'            => 200,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'registration_house',
                            'description'        => 'Адреса реєстрації, будинок',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'registration_flat',
                            'description'        => 'Адреса реєстрації, квартира',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'registration_phone',
                            'description'        => 'Реєстрація, телефон',
                            'type'                => fldPhone,
                            'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
                            'maxlength'            => 15,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 5,
                            'table'                => 'clients'),
                        array(
                            'name'                => 'registration_area_en',
                            'description'        => 'Адреса реєстрації, район (англійська)',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'registration_city_en',
                            'description'        => 'Адреса реєстрації, місто (англійська)',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'registration_street_en',
                            'description'        => 'Адреса реєстрації, вулиця (англійська)',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'habitation_regions_id',
                            'description'        => 'Фактична адреса, область',
                            'type'                => fldSelect,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients',
                            'sourceTable'        => 'regions',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'habitation_area',
                            'description'        => 'Фактична адреса, район',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'habitation_city',
                            'description'        => 'Фактична адреса, місто',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients'),
						array(
							'name'				=> 'habitation_street_types_id',
							'description'		=> 'Фактична адреса, тип вулицi',
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
							'table'				=> 'clients',
							'sourceTable'		=> 'street_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
                        array(
                            'name'                => 'habitation_street',
                            'description'        => 'Фактична адреса, вулиця',
                            'type'                => fldText,
                            'maxlength'            => 200,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'habitation_house',
                            'description'        => 'Фактична адреса, будинок',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'habitation_flat',
                            'description'        => 'Фактична адреса, квартира',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'habitation_phone',
                            'description'        => 'Фактична адреса, телефон',
                            'type'                => fldPhone,
                            'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
                            'maxlength'            => 15,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 6,
                            'table'                => 'clients'),
                        array(
                            'name'                => 'habitation_area_en',
                            'description'        => 'Фактична адреса, район (англійська)',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'habitation_city_en',
                            'description'        => 'Фактична адреса, місто (англійська)',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'habitation_street_en',
                            'description'        => 'Фактична адреса, вулиця (англійська)',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'bank',
                            'description'        => 'Банк',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'bank_en',
                            'description'        => 'Банк (англійська)',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'bank_mfo',
                            'description'        => 'МФО',
                            'type'                => fldText,
                            'maxlength'            => 6,
                            'validationRule'    => '^[0-9]{6}$',
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'bank_account',
                            'description'        => 'Розрахунковий рахунок',
                            'type'                => fldText,
							'maxlength'			=> 14,
							'validationRule'	=> '^([0-9]{9,14})$',
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients'),
						array(
                            'name'              => 'card_car_man_woman',
                            'description'       => 'Картка CarMan@CarWoman',
                            'type'              => fldText,
							'maxlength'         => 13,
                            'validationRule'    => '^([0-9]{13}|[0-9]{13}\/[0-9]{13})$',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'clients'),
						array(
                            'name'              => 'card_assistance',
                            'description'       => 'Картка Експрес Асістанс',
                            'type'              => fldText,
							'maxlength'         => 7,
                            'validationRule'    => '^[0-9]{7}$',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'clients'),
                        array(
                            'name'                => 'client_groups_id',
                            'description'        => 'Група',
                            'type'                => fldSelect,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients',
                            'sourceTable'        => 'client_groups',
                            'selectField'        => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'                => 'created',
                            'description'        => 'Створено',
                            'type'                => fldDate,
                            'value'                => 'NOW()',
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'clients'),
                        array(
                            'name'                => 'modified',
                            'description'        => 'Редаговано',
                            'type'                => fldDate,
                            'value'                => 'NOW()',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'width'             => 100,
                            'orderPosition'        => 7,
                            'table'                => 'clients'),
                        array(
                            'name'                => 'important_person',
                            'description'        => 'VIP статус',
                            'type'                => fldBoolean,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true,
                                    'change'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 8,
                            'table'                => 'clients')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    => 1,
                        'defaultOrderDirection'    => 'asc',
                        'titleField'            => 'CONCAT(lastname, \' \', firstname)'
                    )
            );

    function Clients(&$data) {
        global $Authorization;

        Form::Form($data);

        $this->messages['plural'] = 'Клієнти';
        $this->messages['single'] = 'Клієнт';

        if (!intval($data['person_types_id'])) {
            $data['person_types_id'] = 2;
        }

        switch ($data['person_types_id']) {
            case '1'://физ. лицо
                $unsetFields = array(
                    'position',
					'ground',
                    'bank',
                    'bank_account',
                    'bank_mfo');

                foreach ($unsetFields as $field) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['verification']['canBeEmpty'] = true;
                }

				$this->formDescription['fields'][ $this->getFieldPositionByName( 'company' ) ]['display']['show'] = false;
                break;
            case '2':
                $this->formDescription['fields'][ $this->getFieldPositionByName('identification_code') ]['description']      = 'ЄРДПОУ';
                $this->formDescription['fields'][ $this->getFieldPositionByName('identification_code') ]['validationRule']   = '^[0-9]{8,10}$';

                $unsetFields = array(
                    'passport_series',
                    'passport_number',
                    'passport_place',
                    'passport_date',
                    'driver_licence_series',
                    'driver_licence_number',
                    'driver_licence_place',
                    'driver_licence_date',
                    'mobile_phone',
                    'registration_phone');

                foreach ($unsetFields as $field) {
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]);
                }

                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_regions_id' ) ]['description'] = 'Юридична адреса, область';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_area' ) ]['description'] = 'Юридична адреса, район';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_city' ) ]['description'] = 'Юридична адреса, місто';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_street' ) ]['description'] = 'Юридична адреса, вулиця';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_house' ) ]['description'] = 'Юридична адреса, будинок';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'registration_flat' ) ]['description'] = 'Юридична адреса, офіс';

                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_regions_id' ) ]['description'] = 'Фактична адреса, область';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_area' ) ]['description'] = 'Фактична адреса, район';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_city' ) ]['description'] = 'Фактична адреса, місто';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_street' ) ]['description'] = 'Фактична адреса, вулиця';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_house' ) ]['description'] = 'Фактична адреса, будинок';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_flat' ) ]['description'] = 'Фактична адреса, офіс';
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'habitation_phone' ) ]['description'] = 'Фактична адреса, телефон';

                $this->formDescription['common']['titleField'] = 'company';
                break;
        }

		if ($data['driver_licence_series'] && $data['driver_licence_number']) {
			$this->formDescription['fields'][ $this->getFieldPositionByName( 'identification_code' ) ]['verification']['canBeEmpty'] = true;
		}
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      	=> true,
                    'insert'       	=> true,
                    'update'      	=> true,
                    'view'      	=> true,
                    'change'    	=> false,
                    'delete'    	=> true,
                    'export'    	=> true,
					'generateBills'	=> true);
                break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'      	=> ($_SESSION['auth']['top_agencies_id'] == 1469),
                    'insert'      	=> true,
                    'update'      	=> true,
                    'view'      	=> true,
                    'change'    	=> false,
                    'delete'    	=> false);
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
                $data['agencies_id']    = $Authorization->data['agencies_id'];
                $data['agents_id']      = $Authorization->data['id'];
                break;
        }

        $fields[] = 'person_types_id';
        $conditions[] = 'person_types_id = ' . intval($data['person_types_id']);

        switch ($data['person_types_id']) {
            case 1:
                if ($data['lastname']) {
                    $fields[] = 'lastname';
                    $conditions[] = 'lastname LIKE ' . $db->quote($data['lastname'] . '%');
                }
                break;
            case 2:
                if ($data['company']) {
                    $fields[] = 'company';
                    $conditions[] = 'company LIKE ' . $db->quote($data['company'] . '%');
                }
                break;
        }

		if ($data['identification_code']) {
			$fields[] = 'identification_code';
			$conditions[] = 'identification_code LIKE ' . $db->quote($data['identification_code'] . '%');
		}

        if (intval($data['financial_institutions_id'])) {
            $fields[] = 'financial_institutions_id';
            $conditions[] = 'financial_institutions_id = ' . intval($data['financial_institutions_id']);
        }

        if (intval($data['agencies_id'])) {
            $fields[] = 'agencies_id';
            $conditions[] = 'agencies_id = ' . intval($data['agencies_id']);
        }

        if (intval($data['agents_id'])) {
            $fields[] = 'agents_id';
            $conditions[] = 'agents_id = ' . intval($data['agents_id']);
        }

		if (intval($data['client_groups_id'])) {
			$fields[] = 'client_groups_id';
			$conditions[] = 'client_groups_id = ' . intval($data['client_groups_id']);
		}

		if ($data['policy_number']) {
			$fields[] = 'policy_number';
			$conditions[] = 'id IN(SELECT clients_id FROM insurance_policies WHERE number LIKE ' . $db->quote( $data['policy_number'] . '%' ) . ')';
		}

		if ($data['accident_number']) {
			$fields[] = 'accident_number';
			$conditions[] = 'id IN(SELECT insurance_policies.clients_id FROM insurance_accidents JOIN insurance_policies ON insurance_accidents.policies_id = insurance_policies.id WHERE insurance_accidents.number LIKE ' . $db->quote( $data['accident_number'] . '%' ) . ')';
		}

		if ($data['sign']) {
			$fields[] = 'sign';
			$conditions[] = 'id IN(
				SELECT insurance_policies.clients_id
				FROM insurance_policies
				JOIN insurance_policies_kasko_items ON insurance_policies.id = insurance_policies_kasko_items.policies_id
				WHERE sign LIKE ' . $db->quote( $data['sign'] . '%' ) . '
				UNION
				SELECT insurance_policies.clients_id
				FROM insurance_policies
				JOIN insurance_policies_go ON insurance_policies.id = insurance_policies_go.policies_id
				WHERE sign LIKE ' . $db->quote( $data['sign'] . '%' ) .
			')';
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
            $sql    .= ' ORDER BY ';
        } elseif (is_array($conditions)) {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ', ' . $this->tables[0] . '.id AS clients_id FROM ' . implode(', ', $this->tables) . ' WHERE ' . $this->getAssignmentConditions('show', '', ' AND ') . ' ' . implode(' AND ', $conditions) . ' ORDER BY ';
        } else {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ', ' . $this->tables[0] . '.id AS clients_id FROM ' . implode(', ', $this->tables) . ' ' . $this->getAssignmentConditions('show', ' WHERE ') . ' ORDER BY ';
        }

        $total    = $db->getOne(transformToGetCount($sql));

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
                'FROM ' . PREFIX . '_client_groups ' .
                'ORDER BY title';
        $data['client_groups'] = $db->getAll($sql, 1800);

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

	function isExistsByIdentificationCode($identification_code, $id=0) {
		global $db;

		$conditions[] = 'id <> ' . intval($id);
		$conditions[] = 'identification_code = ' . $db->quote($identification_code);

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_clients ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getOne($sql);
	}

	function isExistsByPassport($passport_series, $passport_number, $id=0) {
		global $db;

		$conditions[] = 'id <> ' . intval($id);
		$conditions[] = 'passport_series = ' . $db->quote($passport_series);
		$conditions[] = 'passport_number = ' . $db->quote($passport_number);

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_clients ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getOne($sql);
	}

	function isExistsByDriverLicence($driver_licence_series, $driver_licence_number, $id=0) {
		global $db;

		$conditions[] = 'id <> ' . intval($id);
		$conditions[] = 'driver_licence_series = ' . $db->quote($driver_licence_series);
		$conditions[] = 'driver_licence_number = ' . $db->quote($driver_licence_number);

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_clients ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getOne($sql);
	}

	function getByIdentificationCode($identification_code) {
		global $db;

		$conditions[] = 'identification_code = ' . $db->quote($identification_code);

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_clients ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getRow($sql);
	}

	function getByPassport($passport_series, $passport_number) {
		global $db;

		$conditions[] = 'passport_series = ' . $db->quote($passport_series);
		$conditions[] = 'passport_number = ' . $db->quote($passport_number);

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_clients ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getRow($sql);
	}

	function getByDriverLicence($driver_licence_series, $driver_licence_number) {
		global $db;

		$conditions[] = 'driver_licence_series = ' . $db->quote($driver_licence_series);
		$conditions[] = 'driver_licence_number = ' . $db->quote($driver_licence_number);

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_clients ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getRow($sql);
	}

	function checkFields($data, $action) {
		global $Log;

		if ($data['identification_code']) {
			if ($this->isExistsByIdentificationCode($data['identification_code'], $data['id'])) {
				$Log->add('error', 'Клієнт з <b>' . $data['identification_code'] . ' ІПН (ЄДРПОУ)</b> вжє існує.');
			}
		} elseif ($data['passport_series'] && $data['passport_number']) {//ищем по паспорту
			if ($this->isExistsByPassport($data['passport_series'], $data['passport_number'], $data['id'])) {
				$Log->add('error', 'Клієнт з <b>' . $data['passport_series'] . ' ' .  $data['passport_number'] . ' паспортом</b> вжє існує.');
			}
		} elseif ($data['driver_licence_series'] && $data['driver_licence_number']) {//ищем по правам
			if ($this->isExistsByDriverLicence($data['driver_licence_series'], $data['driver_licence_number'], $data['id'])) {
				$Log->add('error', 'Клієнт з <b>' . $data['driver_licence_series'] . ' ' .  $data['driver_licence_number'] . ' правами</b> вжє існує.');
			}
		}
	}

	function setAdditionalFields($id, $data) {
		global $db, $Authorization;

		//прописываем телефоны
		$sql = 'DELETE FROM ' . PREFIX . '_client_phones WHERE clients_id = ' . intval($id);
		$db->query($sql);

		$phones = array(
			'mobile_phone',
			'habitation_phone',
			'registration_phone');

		foreach ($phones as $phone) {
			if ($data[ $phone ]) {
				$sql =	'INSERT INTO ' . PREFIX . '_client_phones SET ' .
						'clients_id = ' . intval($id) . ', ' .
						'phone = ' . $db->quote( preg_replace('/\D*/', '', $data[ $phone ]) ) . ', ' .
						'created = NOW()';
				$db->query($sql);
			}
		}

		//прописываем карточку Экспресс Асистанс
		if ($data['card_assistance']) {
			if ($data['policies_id'])
			{
				$agents_id =$db->getOne('SELECT * FROM '.PREFIX.'_policies WHERE id='.intval($data['policies_id']));
			}
			$sql =	'UPDATE ' . PREFIX . '_cards SET ' .
					'card_statuses_id = ' . EXPRESS_ASSISTANCE_STATUSES_USE . ', ' .
					'clients_id = ' . intval($id) . ', ' .
					'agents_id = IF(agents_id = 0, ' . ($agents_id ? intval($agents_id) : intval($Authorization->data['id'])) . ', agents_id), ' .
					'realisation_date = NOW(), ' .
					'modified = NOW() ' .
					'WHERE number = ' . $db->quote( $data[ 'card_assistance' ] );
			$db->query($sql);
		}
	}

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log;

		$data['id'] = parent::insert(&$data, false, $showForm);

        if (intval($data['id'])) {

            $this->setAdditionalFields($data['id'], $data);

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $data['id'];
            }
		}
    }

    function view($data) {
		global $Authorization;
        if ($data['clients_id']) {
            $data['id'] = $data['clients_id'];
        } elseif (is_array($data['id'])) {
            $data['id'] = $data['id'][0];
        }

        $sql =  'SELECT *, ' .
				'date_format(dateofbirth, \'' . DATE_FORMAT . '\') AS dateofbirthFormat, date_format(dateofbirth, \'%Y\') AS dateofbirthYear, date_format(dateofbirth, \'%m\') AS dateofbirthMonth, date_format(dateofbirth, \'%d\') AS dateofbirthDay, ' .
				'date_format(passport_date, \'' . DATE_FORMAT . '\') AS passport_date_format, date_format(passport_date, \'%Y\') AS passport_date_year, date_format(passport_date, \'%m\') AS passport_date_month, date_format(passport_date, \'%d\') AS passport_date_day, ' .
				'date_format(driver_licence_date, \'' . DATE_FORMAT . '\') AS driver_licence_date_format, date_format(driver_licence_date, \'%Y\') AS driver_licence_date_year, date_format(driver_licence_date, \'%m\') AS driver_licence_date_month, date_format(driver_licence_date, \'%d\') AS driver_licence_date_day ' .
                'FROM ' . PREFIX . '_clients ' .
                'WHERE id = ' . intval($data['id']);
        $row = parent::view($data, null, $sql);

        $data['clients_id'] = $row['id'];

		switch ($row['client_groups_id']) {
			case CLIENT_GROUPS_UKRAUTO || $Authorization->data['roles_id']==ROLES_ADMINISTRATOR || $Authorization->data['roles_id']==ROLES_MANAGER:
                $data['product_types_id'] = PRODUCT_TYPES_GO_GENERAL;
                $Policies = Policies::factory($data, 'GOGeneral');
                $Policies->show($data);

				$data['product_types_id'] = PRODUCT_TYPES_CARGO_GENERAL;
				$Policies = Policies::factory($data, 'CargoGeneral');
				$Policies->show($data);

				$data['product_types_id'] = PRODUCT_TYPES_DRIVE_GENERAL;
				$Policies = Policies::factory($data, 'DriveGeneral');
				$Policies->show($data);

				$ClientContacts = Users::factory($data, 'ClientContacts');
				$ClientContacts->show($data);

				$ClientBeneficiaries = new ClientBeneficiaries($data);
				$ClientBeneficiaries->show($data);

				$ClientPoints = new ClientPoints($data);
				$ClientPoints->show($data);
				break;
			case CLIENT_GROUPS_OTHER:
				$Policies = new Policies($data);
				$Policies->show($data);
				break;
		}

        $PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
        $PolicyPaymentsCalendar->show($data);

        $PolicyPayments = new PolicyPayments($data);
        $PolicyPayments->show($data);

        $Accidents = new Accidents($data);
        $Accidents->show($data);
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log;

		$data['id'] = parent::update(&$data, false, $showForm);

        if (intval($data['id'])) {

            $this->setAdditionalFields($data['id'], $data);

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $data['id'];
            }
		}
    }

	function setFormDescription($data) {

		$fields = array_keys($data);

		foreach ($this->formDescription['fields'] as $i => $field) {
			if (!ereg('^(id|created|modified)$', $field['name']) && !in_array($field['name'], $fields)) {
				unset($this->formDescription['fields'][ $i ]);
			}
		}
	}

	function fill($data) {
		$clients_id = 0;

		if ($data['identification_code'] == '' OR ($data['identification_code'] != '' && !ereg($this->formDescription['fields'][ $this->getFieldPositionByName('identification_code') ]['validationRule'], $data['identification_code']))) {
			unset($data['identification_code']);
		}

		if ($data['passport_series'] == '' OR $data['passport_number'] OR ($data['passport_number'] != '' && !ereg($this->formDescription['fields'][ $this->getFieldPositionByName('passport_number') ]['validationRule'], $data['passport_number']))) {
			unset($data['passport_series']);
			unset($data['passport_number']);
		}

		if ($data['driver_licence_series'] == '' OR $data['driver_licence_number'] == '' OR ($data['driver_licence_number'] != '' && !ereg($this->formDescription['fields'][ $this->getFieldPositionByName('driver_licence_number') ]['validationRule'], $data['driver_licence_number']))) {
			unset($data['driver_licence_series']);
			unset($data['driver_licence_number']);
			unset($data['driver_licence_date']);
		}

		if ($data['identification_code']) {
			$row = $this->getByIdentificationCode($data['identification_code']);
		} elseif ($data['passport_series'] && $data['passport_number']) {//ищем по паспорту
			$row = $this->getByPassport($data['passport_series'], $data['passport_number']);
		} elseif ($data['driver_licence_series'] && $data['driver_licence_number']) {//ищем по правам
			$row = $this->getByDriverLicence($data['driver_licence_series'], $data['driver_licence_number']);
		} else {
			return;
		}
		if (intval($row['id'])) {
			switch ($row['client_groups_id']) {
				case CLIENT_GROUPS_UKRAUTO:
					$clients_id = $row['id'];
					break;
				default:
					$data['id'] = $row['id'];
					$this->setFormDescription($data);
					$clients_id = $this->update($data, false, false);
			}
		} else {
			$data['client_groups_id'] = CLIENT_GROUPS_OTHER;
			$this->setFormDescription($data);
			$clients_id = $this->insert($data, false, false);
		}

		return $clients_id;
	}

    function exportInWindow($data) {
        global $db, $Smarty;

        $this->checkPermissions('export', $data);

        $sql	= $this->show($data, $fields, $conditions, null, null, false, true);
        $list	= $db->getAll($sql);

        $Smarty->assign('list', $list);

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        echo $Smarty->fetch($this->object . '/export.tpl');
        exit;
    }

	function generateBills($data) {
		global $db, $Log;

        $this->checkPermissions('generateBills', $data);

		if ($_POST['process']) {

			$PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);

			$conditions[] = 'b.payments_id = 0';
			$conditions[] = 'a.payment_statuses_id = ' . PAYMENT_STATUSES_NOT;
			$conditions[] = 'TO_DAYS(a.date) <= TO_DAYS(' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']) . ')';
			$conditions[] = 'a.policy_statuses_id = ' . POLICY_STATUSES_GENERATED;

			$sql =	'SELECT c.id, c.product_types_id ' .
					'FROM ' . PREFIX . '_policies AS a ' .
					'JOIN ' . PREFIX . '_policies_cargo AS b ON a.id = b.policies_id ' .
					'JOIN ' . PREFIX . '_policies AS c ON b.policies_general_id = c.id ' .
					'WHERE ' . implode(' AND ', $conditions) . ' AND a.clients_id IN(' . implode(', ', $data['clients_id']) . ') ' .
					'GROUP BY policies_general_id ' .
					'HAVING SUM(a.amount) > 0 ' .
					'UNION ' .
					'SELECT c.id, c.product_types_id ' .
					'FROM ' . PREFIX . '_policies AS a ' .
					'JOIN ' . PREFIX . '_policies_drive AS b ON a.id = b.policies_id ' .
					'JOIN ' . PREFIX . '_policies AS c ON b.policies_general_id = c.id ' .
					'WHERE ' . implode(' AND ', $conditions) . ' AND a.clients_id IN(' . implode(', ', $data['clients_id']) . ') ' .
					'GROUP BY policies_general_id ' .
					'HAVING SUM(a.amount) > 0';
			$res =	$db->query($sql);

			while($res->fetchInto($row)) {

				$data['policies_id'] = $row['id'];
				$data['product_types_id'] = $row['product_types_id'];

				$PolicyPaymentsCalendar->insert($data, false);
			}

			$Log->add('confirm', 'Рахунки на оплату сертифікатів для обраних клієнтів було сформовано.');

			header('Location: /index.php?do=Certificates|show');
			exit;
		} else {

			if (is_array($data['id'])) {
				$data['clients_id'] = $data['id'];
			}

			$PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
			$PolicyPaymentsCalendar->add($data);
		}
	}

	function get($id) {
		global $db;

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_clients ' .
				'WHERE id = ' . intval($id);
		return $db->getRow($sql);
	}

	function getIdByPhoneNumber($phone) {
		global $db;

		$sql =	'SELECT clients_id ' .
				'FROM ' . PREFIX . '_client_phones ' .
				'WHERE phone = ' . $db->quote($phone);
		$list = $db->getCol($sql);

		return (sizeOf($list) > 1) ? 0 : $list[ 0 ];
	}

	function getSearchForm($data) {
		global $db;

		include_once $this->object . '/' . ($data['template'] ? $data['template'] : 'searchForm.php');
	}

	function getClient($data) {
		
		$data = $this->get(intval($data['clients_id']));
		if (!is_array($data)) return array();
		
		$values['insurer_person_types_id'] = $data['person_types_id'];

		switch ($values['insurer_person_types_id']) {
			case '1'://физ. лицо
				if ($data['identification_code']) $values['insurer_identification_code']= $data['identification_code'];
				if ($data['dateofbirth'] && $data['dateofbirth']!='0000-00-00') $values['insurer_dateofbirth']		= $data['dateofbirth'];
				if ($data['dateofbirth'] && $data['dateofbirth']!='0000-00-00') $values['insurer_dateofbirth_year']	= substr($data['dateofbirth'], 0, 4);
				if ($data['dateofbirth'] && $data['dateofbirth']!='0000-00-00') $values['insurer_dateofbirth_month']	= substr($data['dateofbirth'], 5, 2);
				if ($data['dateofbirth'] && $data['dateofbirth']!='0000-00-00') $values['insurer_dateofbirth_day']	= substr($data['dateofbirth'], 8, 2);
				if ($data['passport_series']) $values['insurer_passport_series']	= $data['passport_series'];
				if ($data['passport_number']) $values['insurer_passport_number']	= $data['passport_number'];
				if ($data['passport_place']) $values['insurer_passport_place']		= $data['passport_place'];
				if ($data['passport_date'] && $data['passport_date']!='0000-00-00') $values['insurer_passport_date']		= $data['passport_date'];
				if ($data['passport_date'] && $data['passport_date']!='0000-00-00') $values['insurer_passport_date_year']	= substr($data['passport_date'], 0, 4);
				if ($data['passport_date'] && $data['passport_date']!='0000-00-00') $values['insurer_passport_date_month']	= substr($data['passport_date'], 5, 2);
				if ($data['passport_date'] && $data['passport_date']!='0000-00-00') $values['insurer_passport_date_day']	= substr($data['passport_date'], 8, 2);
				if ($data['driver_licence_series']) $values['insurer_driver_licence_series']= $data['driver_licence_series'];
				if ($data['driver_licence_number']) $values['insurer_driver_licence_number']= $data['driver_licence_number'];
				if ($data['driver_licence_date'] && $data['driver_licence_date']!='0000-00-00') $values['insurer_driver_licence_date']	 = $data['driver_licence_date'];
				if ($data['driver_licence_date'] && $data['driver_licence_date']!='0000-00-00') $values['insurer_driver_licence_date_year']	= substr($data['driver_licence_date'], 0, 4);
				if ($data['driver_licence_date'] && $data['driver_licence_date']!='0000-00-00') $values['insurer_driver_licence_date_month']= substr($data['driver_licence_date'], 5, 2);
				if ($data['driver_licence_date'] && $data['driver_licence_date']!='0000-00-00') $values['insurer_driver_licence_date_day']	= substr($data['driver_licence_date'], 8, 2);
				break;
			case '2'://юр. лицо
				if ($data['company']) $values['insurer_company']		= $data['company'];
				if ($data['identification_code']) $values['insurer_edrpou']		= $data['identification_code'];
				if ($data['position']) $values['insurer_position']		= $data['position'];
				if ($data['ground']) $values['insurer_ground']		= $data['ground'];
				break;
		}

		if ($data['lastname']) $values['insurer_lastname']						= $data['lastname'];
		if ($data['firstname']) $values['insurer_firstname']					= $data['firstname']; 
		if ($data['patronymicname']) $values['insurer_patronymicname']			= $data['patronymicname'];
		if ($data['mobile_phone']) $values['insurer_phone']						= $data['mobile_phone'];
		if ($data['email']) $values['insurer_email']							= $data['email'];

		if ($data['registration_regions_id']) $values['insurer_regions_id']		= $data['registration_regions_id'];
		if ($data['registration_area']) $values['insurer_area']					= $data['registration_area'];
		if ($data['registration_city']) $values['insurer_city']					= $data['registration_city'];
		if ($data['registration_street_types_id']) $values['insurer_street_types_id']	= $data['registration_street_types_id'];
		if ($data['registration_street']) $values['insurer_street']				= $data['registration_street'];
		if ($data['registration_house']) $values['insurer_house']				= $data['registration_house'];
		if ($data['registration_flat']) $values['insurer_flat']					= $data['registration_flat'];
		if ($data['registration_phone']) $values['insurer_phone']				= $data['registration_phone'];

		if ($data['bank']) $values['insurer_bank']								= $data['bank'];
		if ($data['bank_mfo']) $values['insurer_bank_mfo']						= $data['bank_mfo'];
		if ($data['bank_account']) $values['insurer_bank_account']				= $data['bank_account'];

		if ($data['card_car_man_woman']) $values['card_car_man_woman']			= $data['card_car_man_woman'];
		if ($data['card_assistance']) $values['card_assistance']				= $data['card_assistance'];

		return  $values;
	}

	function searchClientInWindow($data) {
		global $db, $Authorization;

		if ($Authorization->data['agencies_id'] == 228) {
			$this->searchAstraClientInWindow($data);
			exit;
		}

		$conditions[]='1';
		$row = array();
		if ($data['product_types_id']!=4) {
			$working_banks = array(1,34,25,39,19,46,40);//банки которые работают со своей базой 
			//УкрсоцБанк Правекс Банк Идея Банк Универсал Укргазбанк Креди Агриколь

			if ($data['product_types_id']==3 && $Authorization->data['roles_id']==ROLES_AGENT) {//доп ограничения на пролонгацию каско
				$agencies_id = intval($_SESSION['auth']['agencies_id']);
				
				if ($agencies_id==1 || $agencies_id==SELLER_AGENCIES_ID ) {
					//Экспресс страхование или Отдел продаж ограничений на видимость КАСКО нету
				}
				elseif($_SESSION['auth']['agent_financial_institutions_id']>0 )  
				{
					if (in_array($_SESSION['auth']['agent_financial_institutions_id'],$working_banks))//банки которые работают со своей базой)
						$conditions[]='financial_institutions_id='. $_SESSION['auth']['agent_financial_institutions_id'];
					else
						$conditions[]=' FALSE ';
				} else {//рядовой агент сети Укравто
				/*
					•	доступен поиск клиента по номеру договора по следующим Банкам и дальнейшая работа с договором
				*/
					if ($agencies_id==283 || $agencies_id==560)
						$conditions[] = 'agencies_id IN (283,560)';
					else	
						$conditions[] = '
							IF( financial_institutions_id =0,1,0)
						';//рядовой агент пролонгирует только ритейл

					
				}
			}
		}

		
		/*if ($_SESSION['auth']['ukravto']==1 && !in_array ( $_SESSION['auth']['agencies_id'], array(55,56,206,52,848) )
			&& ($data['product_types_id']==3 || $data['product_types_id']==4)
			) {
				 
				$conditions[] = ' brands_id IN(0) ';//13,14,11,9,7
		}*/
					
		if ($data['policies_number']) {//поиск по номеру полиса
			switch ($data['product_types_id']) {
				case 3:
				case 11:
					$sql =	'SELECT a.*,b.*, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
							'FROM ' . PREFIX . '_policies a ' .
							'JOIN ' . PREFIX . '_policies_kasko b ON a.id = b.policies_id ' .
							' JOIN  insurance_policies_kasko_items c ON a.id=c.policies_id ' .
							'WHERE    a.child_id=0   AND a.number = ' . $db->quote($data['policies_number']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND a.id <> ' . intval($data['id']) . ' AND payment_statuses_id>=3 AND ' .implode(' AND ', $conditions) .' '.
							'ORDER BY a.date DESC LIMIT 1';
///_dump($sql);
					$row = $db->getRow($sql, 30 * 60);
					break;
				case 4:
					$sql =	'SELECT *, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
							'FROM ' . PREFIX . '_policies ' .
							'JOIN ' . PREFIX . '_policies_go ON id = policies_id ' .
							'WHERE number = ' . $db->quote($data['policies_number']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND id <> ' . intval($data['id']) . '  AND ' .implode(' AND ', $conditions).' '.
							'ORDER BY date DESC LIMIT 1';
//_dump($sql);
					$row = $db->getRow($sql, 30 * 60);
				     break;
				case 15:
					$sql =	'SELECT *, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
							'FROM ' . PREFIX . '_policies ' .
							'JOIN ' . PREFIX . '_policies_mortage ON id = policies_id ' .
							'WHERE child_id=0 AND number = ' . $db->quote($data['policies_number']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND id <> ' . intval($data['id']) . ' AND payment_statuses_id>=3 AND ' .implode(' AND ', $conditions) .' '.
							'ORDER BY date DESC LIMIT 1';
					$row = $db->getRow($sql, 30 * 60);
					break;
				case 12:
					$sql =	'SELECT *, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
							'FROM ' . PREFIX . '_policies ' .
							'JOIN ' . PREFIX . '_policies_property ON id = policies_id ' .
							'WHERE child_id=0 AND number = ' . $db->quote($data['policies_number']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND id <> ' . intval($data['id']) . ' AND payment_statuses_id>=3 AND ' .implode(' AND ', $conditions) .' '.
							'ORDER BY date DESC LIMIT 1';
					$row = $db->getRow($sql, 30 * 60);
					break;
				case 13:
					$sql =	'SELECT *, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
							'FROM ' . PREFIX . '_policies ' .
							'JOIN ' . PREFIX . '_policies_ns ON id = policies_id ' .
							'WHERE child_id=0 AND number = ' . $db->quote($data['policies_number']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND id <> ' . intval($data['id']) . ' AND payment_statuses_id>=3 AND ' .implode(' AND ', $conditions) .' '.
							'ORDER BY date DESC LIMIT 1';
					$row = $db->getRow($sql, 30 * 60);
					break;


			}
		}
		if (empty($row) && $data['shassi']) {//поиск по номеру кузова

			if ($data['product_types_id']!=4) {
					$sql =	'SELECT a.*,b.*, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
							'FROM ' . PREFIX . '_policies as a ' .
							'JOIN ' . PREFIX . '_policies_kasko as b ON a.id = b.policies_id ' .
							'JOIN ' . PREFIX . '_policies_kasko_items as c ON a.id = c.policies_id ' .
							//'WHERE options_test_drive = 0 AND options_race = 0 AND clients_id = ' . intval($clients_id) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND id <> ' . intval($data['id']) . ' ' .
							'WHERE options_test_drive = 0 AND options_race = 0 AND shassi = ' . $db->quote($data['shassi']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND payment_statuses_id>=3 AND a.id <> ' . intval($data['id']) . '  AND ' .implode(' AND ', $conditions) .' '.
							'ORDER BY date DESC LIMIT 1';
					$row = $db->getRow($sql, 30 * 60);

			}	
			else { //ГО
				$sql =	'SELECT *, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
						'FROM ' . PREFIX . '_policies ' .
						'JOIN ' . PREFIX . '_policies_go ON id = policies_id ' .
						'WHERE     shassi = ' . $db->quote($data['shassi']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND id <> ' . intval($data['id']) . ' AND ' .implode(' AND ', $conditions).' '.
						'ORDER BY date DESC LIMIT 1';
				$row = $db->getRow($sql, 30 * 60);
			}			
		}

		if (empty($row) && $data['identification_code']) {//поиск по ИНН

			if ($data['product_types_id']!=4) {
				$client = $this->getByIdentificationCode($data['identification_code']);

				if ($client && $client['id']) {
					$sql =	'SELECT a.*,b.*, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
							'FROM ' . PREFIX . '_policies a ' .
							'JOIN ' . PREFIX . '_policies_kasko b ON a.id = b.policies_id ' .
							'JOIN ' . PREFIX . '_policies_kasko_items as c ON a.id = c.policies_id ' .
							'WHERE options_test_drive = 0 AND options_race = 0 AND insurer_identification_code = ' . $db->quote($data['identification_code']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND payment_statuses_id>=3 AND a.id <> ' . intval($data['id']) . '  AND ' .implode(' AND ', $conditions) .' '.
							'ORDER BY date DESC LIMIT 1';
					$row = $db->getRow($sql, 30 * 60);
				}
			}
			else { //ГО
				$sql =	'SELECT *, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
						'FROM ' . PREFIX . '_policies ' .
						'JOIN ' . PREFIX . '_policies_go ON id = policies_id ' .
						'WHERE     insurer_identification_code = ' . $db->quote($data['identification_code']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND id <> ' . intval($data['id']) . ' AND ' .implode(' AND ', $conditions).' '.
						'ORDER BY date DESC LIMIT 1';
				$row = $db->getRow($sql, 30 * 60);
			}
			
		}

		if (empty($row) && $data['passport_series'] && $data['passport_number']) {//поиск по серия номер паспорта

			if ($data['product_types_id']!=4) {
				$client = $this->getByPassport($data['passport_series'], $data['passport_number']);

				if ($client && $client['id']) {
					$sql =	'SELECT a.*,b.*, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
							'FROM ' . PREFIX . '_policies a ' .
							'JOIN ' . PREFIX . '_policies_kasko b ON a.id = b.policies_id ' .
							'JOIN ' . PREFIX . '_policies_kasko_items as c ON a.id = c.policies_id ' .
							'WHERE options_test_drive = 0 AND options_race = 0 AND clients_id = ' . intval($client['id']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND payment_statuses_id>=3 AND a.id <> ' . intval($data['id']) . '   AND ' .implode(' AND ', $conditions) .' '.
							'ORDER BY date DESC LIMIT 1';
					$row = $db->getRow($sql, 30 * 60);
				}
			}
			else { //ГО
				$sql =	'SELECT *, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
						'FROM ' . PREFIX . '_policies ' .
						'JOIN ' . PREFIX . '_policies_go ON id = policies_id ' .
						'WHERE     insurer_passport_series = ' . $db->quote($data['passport_series']) . '  AND insurer_passport_number = ' . $db->quote($data['passport_number']) . ' AND product_types_id = ' . intval($data['product_types_id']) . ' AND id <> ' . intval($data['id']) . ' AND ' .implode(' AND ', $conditions).' '.
						'ORDER BY date DESC LIMIT 1';
				$row = $db->getRow($sql, 30 * 60);
			}			
		}
		if (!empty($row)) {//нашли предыдущий полис
			echo 'Знайдено попереднiй полiс: ' . $row['number'] . '; Період: ' . $row['begin_datetimeFormat'] . '-' . $row['interrupt_datetimeFormat'] . ';<br />Страхувальник: <b>' . $row['insurer'] . '</b>; Объект страхування: <b>' . $row['item'] . '<br />';
			echo '<input type="hidden" name="parent_id" value="' . $row['id'] . '" />';
		} else {
			echo '<span class="red">За вашим запитом нiчого не знайдено</div>';
			echo '<input type="hidden" name="parent_id" value="0" />';
		}
		exit;
	}

	function searchAstraClientInWindow($data) {
		global $db, $Authorization;

		if ($data['policies_number']) {//поиск по номеру полиса
			$sql =	'SELECT a.*, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
					'FROM ' . PREFIX . '_policies AS a ' .
					'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id AND b.financial_institutions_id = 33 ' .
					'WHERE b.options_test_drive = 0 AND b.options_race = 0 AND a.number = ' . $db->quote($data['policies_number']) . ' AND a.product_types_id = ' . intval($data['product_types_id']) . ' AND a.id<>'.intval($data['id']) . ' ' .
					'ORDER BY a.date DESC';
			$row = $db->getRow($sql, 30 * 60);
		}

		if (empty($row) && $data['shassi']) { //поиск по номеру кузова

			$ClientCars = new ClientCars($data);
			$clients_id = $ClientCars->getClientsIdByShassi($data['shassi']);

			if ($clients_id) {
				$sql =	'SELECT *, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id AND b.financial_institutions_id = 33 ' .
						'WHERE b.options_test_drive = 0 AND b.options_race = 0 AND a.clients_id = ' . intval($clients_id) . ' AND a.product_types_id = ' . intval($data['product_types_id']) . ' AND a.id <> ' . intval($data['id']) . ' ' .
						'ORDER BY a.date DESC';
				$row = $db->getRow($sql, 30 * 60);
			}
		}

		if (empty($row) && $data['identification_code']) {//поиск по ИНН

			$client = $this->getByIdentificationCode($data['identification_code']);

			if ($client && $client['id']) {
				$sql =	'SELECT *, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id AND b.financial_institutions_id = 33 ' .
						'WHERE b.options_test_drive = 0 AND b.options_race = 0 AND a.clients_id = ' . intval($client['id']) . ' AND a.product_types_id = ' . intval($data['product_types_id']) . ' AND a.id <> ' . intval($data['id']) . ' ' .
						'ORDER BY a.date DESC';
				$row = $db->getRow($sql, 30 * 60);
			}
		}

		if (empty($row) && $data['passport_series'] && $data['passport_number']) {//поиск по серия номер паспорта

			$client = $this->getByPassport($data['passport_series'], $data['passport_number']);

			if ($client && $client['id']) {
				$sql =	'SELECT *, date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetimeFormat, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetimeFormat ' .
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id AND b.financial_institutions_id = 33 ' .
						'WHERE b.options_test_drive = 0 AND b.options_race = 0 AND a.clients_id = ' . intval($client['id']) . ' AND a.product_types_id = ' . intval($data['product_types_id']) . ' AND a.id <> ' . intval($data['id']) . ' ' .
						'ORDER BY a.date DESC';
				$row = $db->getRow($sql, 30 * 60);
			}
		}

		if (!empty($row)) {//нашли предыдущий полис
			echo 'Знайдено попереднiй полiс: ' . $row['number'] . '; Період: ' . $row['begin_datetimeFormat'] . '-' . $row['interrupt_datetimeFormat'] . ';<br />Страхувальник: ' . $row['insurer'] . '; Объект страхування: ' . $row['item'] . '<br />';
			echo '<input type="hidden" name="parent_id" value="' . $row['id'] . '" />';
		} else {
			echo '<span style="color: #C02C01;">За вашим запитом нiчого не знайдено</div>';
			echo '<input type="hidden" name="parent_id" value="0" />';
		}
		exit;
	}

    function setCheckedInWindow($data){
        global $db;

        $this->checkPermissions('update', $data);

        $sql = 'UPDATE ' .PREFIX . '_clients SET important_person = ' . $data['value'] . ' WHERE id =' . $data['id'];
        $db->query($sql);
        echo '{"type": "' . $data['id'] . '", "text": "Cтатус змінено на ' . ($data['value'] == 1 ? "VIP" : "звичайний") . '"}';
    }
	
	function changePhoneInWindow($data) {
		global $db;
		
		$sql = 'SELECT registration_phone ' .
			   'FROM ' . PREFIX . '_clients ' .
			   'WHERE id = ' . intval($data['id']);
		$phone_old = $db->getOne($sql);
		
		$sql = 'UPDATE ' . PREFIX . '_clients ' .
			   'SET registration_phone = ' . $db->quote($data['phone']) . ' ' . 
			   'WHERE id = ' . intval($data['id']);
		$db->query($sql);
		
		$sql = 'INSERT INTO ' . PREFIX . '_client_phones_history ' . 
			   'SET phone = ' . $db->quote($phone_old) . ', clients_id = ' . intval($data['id']) . ', date = NOW()';
		$db->query($sql);
	}
	
	function getHistoryPhoneInWindow($data) {
		global $db;
		
		$sql = 'SELECT * FROM ' . PREFIX . '_client_phones_history WHERE clients_id = ' . intval($data['id']);
		$history = $db->getAll($sql);
		
		if (!sizeOf($history)) {
			$result = 'Історія відсутня';
			echo $result;
			exit;
		}
		
		$result = array();
		foreach ($history as $row) {
			$result[] = '<b>Дата заміни</b>: ' . date('d.m.Y', strtotime($row['date'])) . ', <b>телефон:</b> ' . $row['phone'];
		}
		
		echo implode('<br/>', $result);
		exit;
	}
}

?>