<?
/*
 * Title: application accident class
 *
 * @author Eugene Cherkassky
 * @email eugene.cherkassy@gmail.com
 * @version 3.0
 */
 
require_once 'Accidents/KASKO.class.php';
require_once 'Accidents/GO.class.php';
require_once 'MVS.class.php';
require_once 'CarTypes.class.php';
require_once 'CarBrands.class.php';
require_once 'CarModels.class.php';

class ApplicationAccidents extends Form {

	var $documentsDelimiter = '	';
	
	var $life_damage_id = array(
		1 => "Тимчасова втрата працездатності(травма)",
		2 => "Стійка втрата працездатності(інвалідність 1 групи)",
		3 => "Стійка втрата працездатності(інвалідність 2 групи)",
		4 => "Стійка втрата працездатності(інвалідність 3 групи/інвалід-дитина)",
		5 => "Смерть",
		6 => "Моральна шкода"
	);

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'id',
                            'type'              => fldIdentity,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'statuses_id',
							'description'       => 'Статус',
                            'type'              => fldInteger,
							'list'              => array(
													'1' => 'Прийом повідомлення',
													'2' => 'Сформовано',
													'3' => 'Прийнято',
                                                    '4' => 'Страхувальник ЦВ'
												),
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'     => 2,
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'owner_types_id',
							'description'       => 'Тип заявника',
                            'type'              => fldInteger,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'policies_kasko_id',
                            'description'       => 'Договір КАСКО',
                            'type'              => fldHidden,
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
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'policies_kasko_items_id',
                            'description'       => 'Договір КАСКО, ТЗ',
                            'type'              => fldHidden,
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
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'policies_go_id',
                            'description'       => 'Договір ОСЦПВ',
                            'type'              => fldHidden,
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
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'number',
                            'description'       => 'Номер',
                            'type'              => fldText,
                            'maxlenght'         => 20,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'orderPosition'     => 1,
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'applicant_types_id',
                            'description'       => 'Тип заявника',
                            'type'              => fldInteger,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'				=> 'application_accidents'),
						array(
                            'name'              => 'CONCAT_WS(\' \', insurance_application_accidents.applicant_lastname, insurance_application_accidents.applicant_firstname, insurance_application_accidents.applicant_patronymicname) as applicant',
                            'description'       => 'Заявник',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'withoutTable'		=> true,
							'orderPosition'		=> 3,
                            'orderName'         => 'applicant',
                            'table'				=> 'application_accidents'),
                        array(
                            'name'              => 'applicant_lastname',
                            'description'       => 'Заявник, прізвище',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'				=> 'application_accidents'),
                        array(
                            'name'              => 'applicant_firstname',
                            'description'       => 'Заявник, ім\'я',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'              => 'applicant_patronymicname',
                            'description'       => 'Заявник, ім\'я',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'              => 'applicant_regions_id',
                            'description'       => 'Заявник, область',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'application_accidents',
                            'sourceTable'       => 'regions',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
						array(
                            'name'              => 'applicant_area',
                            'description'       => 'Заявник, район',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'applicant_city',
                            'description'       => 'Заявник, місто',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'application_accidents'),
						array(
							'name'				=> 'applicant_street_types_id',
							'description'		=> 'Заявник, тип вулицi',
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
							'table'				=> 'application_accidents',
							'sourceTable'		=> 'street_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),	
                        array(
                            'name'              => 'applicant_street',
                            'description'       => 'Заявник, вулиця',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'applicant_house',
                            'description'       => 'Заявник, будинок',
                            'type'              => fldText,
                            'maxlength'         => 10,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'applicant_flat',
                            'description'       => 'Заявник, квартира',
                            'type'              => fldText,
                            'maxlength'         => 5,
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
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'applicant_phone',
                            'description'       => 'Заявник, телефон(и)',
                            'type'              => fldText,
                            'maxlength'         => 100,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'              => 'datetime',
                            'description'       => 'Дата події та час події',
                            'type'              => fldDateTime,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'     => 4,
							'table'             => 'application_accidents'),
                        array(
                            'name'              => 'address',
                            'description'       => 'Адреса події',
                            'type'              => fldText,
                            'maxlength'         => 100,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'orderPosition'		=> 5,
                            'table'            => 'application_accidents'),
						array(
                            'name'              => 'damage',
                            'description'       => 'Пошкодження',
                            'type'              => fldText,
                            'maxlength'         => 500,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'orderPosition'		=> 5,
                            'table'            => 'application_accidents'),
						array(
                            'name'             => 'inspecting_car',
                            'description'      => 'Огляд ТЗ',
                            'type'             => fldBoolean,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'             => 'inspecting_car_place',
                            'description'      => 'Місцезнаходження ТЗ',
                            'type'             => fldText,
							'maxlength'         => 100,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'application_accidents'),
						array(
                            'name'             => 'inspecting_property',
                            'description'      => 'Огляд майна',
                            'type'             => fldBoolean,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'             => 'inspecting_property_place',
                            'description'      => 'Місцезнаходження майна',
                            'type'             => fldText,
							'maxlength'         => 100,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'             => 'application_risks_id',
                            'description'      => 'Ризик',
                            'type'             => fldInteger,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'             => 'types_id',
                            'description'      => 'Тип події',
                            'type'             => fldInteger,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'application_accidents'),
						array(
                            'name'             => 'competent_authorities',
                            'description'      => 'Повідомлення в компетентні органи',
                            'type'             => fldBoolean,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'              => 'competent_authorities_id',
                            'description'       => 'Орган куди звернувся',
                            'type'              => fldRadio,
                            'list'              => array(
													'0' => 'Нiкуди',
													'1' => 'Органи ДАІ',
													'2' => 'Органи МВС',
													'3' => 'МНС',
                                                    '4' => 'Поліція'),
                            'display'           =>
                                array(
                                   'show'       => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'mvs_id',
                            'description'       => 'Органи',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents',
                            'sourceTable'       => 'mvs',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'mvs_title',
                            'description'       => 'Органи',
                            'type'              => fldText,
							'maxlength'			=> 100,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
                         array(
                            'name'              => 'mvs_date',
                            'description'       => 'Органи, дата повідомлення',
                            'type'              => fldDate,
                            'input'             => true,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'assistance',
                            'description'       => 'Диспетчерський центр страховика',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'assistance_date',
                            'description'       => 'Дата повідомлення диспетчерського центру страховика',
                            'type'              => fldDate,
                            'input'             => true,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'assistance_place',
                            'description'       => 'З місця пригоди',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'             => 'driver_types_id',
                            'description'      => 'Водій. Тип',
                            'type'             => fldInteger,
                            'maxlength'        => 50,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'             => 'driver_lastname',
                            'description'      => 'Водій. Призвище',
                            'type'             => fldText,
                            'maxlength'        => 50,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'             => 'driver_firstname',
                            'description'      => 'Водій. Ім\'я',
                            'type'             => fldText,
                            'maxlength'        => 50,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            	=> 'application_accidents'),
                        array(
                            'name'             	=> 'driver_patronymicname',
                            'description'      	=> 'Водій. По батькові',
                            'type'             	=> fldText,
                            'maxlength'        	=> 50,
                            'display'          	=>
                                array(
                                    'show'     	=> false,
                                    'insert'   	=> true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'europrotocol',
                            'description'       => 'Європротокол',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'unifiedstateregister',
                            'description'       => 'Єдиний державний реєстр досудових розслідувань',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'criminal',
                            'description'       => 'Кримінал',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'criminal_name',
                            'description'       => 'Кримінал, назва',
                            'type'              => fldText,
							'maxlength'         => 100,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'accident_schemes_id',
                            'description'       => 'Схема ДТП',
                            'type'              => fldInteger,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'applicant_insurer_company',
                            'description'       => 'Страхова компанія заявника',
                            'type'              => fldText,
							'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'applicant_policies_series',
                            'description'       => 'Страхова компанія заявника',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'applicant_policies_number',
                            'description'       => 'Страхова компанія заявника',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'administrativeprotocol',
                            'description'       => 'Адміністративний протокол',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'administrative_protocol_series',
                            'description'       => 'Серія АП',
							'maxlength'         => 2,
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'administrative_protocol_number',
                            'description'       => 'Номер АП',
							'maxlength'         => 7,
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'              => 'creator_id',
                            'description'       => 'Виконавець',
                            'type'              => fldInteger,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'application_accidents',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'accounts.lastname'),
						array(
                            'name'              => 'CONCAT_WS(\' \', insurance_accounts.lastname, insurance_accounts.firstname) as creator',
                            'description'       => 'Виконавець',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
							'withoutTable'		=> true,
							'orderPosition'		=> 7,
                            'orderName'         => 'insurance_accounts.lastname',
                            'table'             => 'accounts'),
                        array(
                            'name'              => 'creator_roles_id',
                            'description'       => 'Роль виконавця',
                            'type'              => fldInteger,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'application_accidents'),
						array(
                            'name'                => 'victim_car_type_id',
                            'description'         => 'Потерпілий, Тип ТЗ',
                            'type'                => fldSelect,
                            'showId'              => true,
                            'display'             =>
                                array(
                                    'show'        => false,
                                    'insert'      => true,
                                    'view'        => true,
                                    'update'      => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'              => 'application_accidents',
                            'condition'          => 'product_types_id = 4',
                            'sourceTable'        => 'car_types',
                            'selectField'        => 'CONCAT(code,\' - \',title)',
                            'orderField'         => 'order_position'),
						array(
                            'name'             => 'victim',
                            'description'      => 'Опис пошкоджень потерпілої сторони',
                            'type'             => fldHidden,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'            => 'application_accidents'),
						array(
                            'name'             => 'participants',
                            'description'      => 'Інші учасники',
                            'type'             => fldHidden,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'            => 'application_accidents'),
						array(
                            'name'             => 'documents',
                            'description'      => 'Документи',
                            'type'             => fldHidden,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'            => 'application_accidents'),
						array(
                            'name'             => 'car_services_id',
                            'description'      => 'СТО',
                            'type'             => fldHidden,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => false,
                                    'update'   => false
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'            => 'application_accidents'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Дата повідомлення',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'     => 6,
                            'table'             => 'application_accidents'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'		=> 8,
                            'width'             => 100,
                            'table'             => 'application_accidents')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 1,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'number'
                    )
                );

    function ApplicationAccidents($data) {
        $this->object = 'ApplicationAccidents';
        $this->objectTitle = 'ApplicationAccidents';

        Form::Form($data);

        $this->messages['plural'] = 'Повідомлення про події';
        $this->messages['single'] = 'Повідомлення про подію';
    }

    function getRowClass($row, $i){
        $result = parent::getRowClass($row, $i);
		
		switch ($row['status']) {
			case 1:
				$now = date_create("now");
				$created = date_create(date('Y-m-d', strtotime($row['created_format'])));
				$diff = date_diff($now, $created);
				if (intval($diff->days) > 1) {
					$result .= ' darkred';
				} else {
					$result .= ' lightpink';
				}
				break;
			case 2:
				$result .= ' yellow';
				break;
			case 3:
				$result .= ' green';
				break;
			default:
				break;
		}

        return $result;
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_MASTER:
                $this->permissions = array(
					'show'      	            => true,
                    'insert'		            => true,
                    'update'		            => true,
                    'view'			            => true,
                    'change'		            => false,
                    'delete'		            => false);
                break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'						=> true,
                    'insert'					=> true,
                    'update'					=> true,
                    'view'						=> true,
                    'change'					=> true,
                    'delete'					=> true,
                    'changeInspectingAccount'   => true,
					'export'					=> true
                    );
                break;
        }
    }

    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Authorization;

		if (is_array($data['id'])) $data['id'] = $data['id'][ 0 ];
		
		$row = $db->getRow('SELECT * FROM ' . PREFIX . '_application_accidents WHERE id = ' . intval($data['id']));

		switch ($action) {
			case 'update':
				if ($Authorization->data['roles_id'] != ROLES_ADMINISTRATOR && $row['statuses_id'] == 3 || $Authorization->data['roles_id'] == ROLES_MASTER && $row['statuses_id'] > 1) {
					parent::checkPermissions($action, $data, true);
				}
				break;
		}

       	$result = parent::checkPermissions($action, $data, $redirect);
        return $result;
    }
	
	function setMode($data) {

        if (is_array($data['id'])) {
            $data['application_accidents_id'] = $data['id'][0];
        } elseIf (!intval($data['application_accidents_id']) && $data['id']) {
            $data['application_accidents_id'] = $data['id'];
        }

		if (ereg('^' . $this->object . '\|view', $data['do'])) {
            $this->mode = 'view';
			$_SESSION[ 'ApplicationAccidents' ][ $data['application_accidents_id'] ]['mode'] = 'view';
		} elseif (ereg('^' . $this->object . '\|(add|insert|load|update)', $data['do'])) {
            $this->mode = 'update';
			$_SESSION[ 'ApplicationAccidents' ][ $data['application_accidents_id'] ]['mode'] = 'update';
        } elseif ($_SESSION[ 'ApplicationAccidents' ][ $data['application_accidents_id'] ]['mode']) {
            $this->mode = $_SESSION[ 'ApplicationAccidents' ][ $data['application_accidents_id'] ]['mode'];
		}
    }
	
	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		global $db, $Authorization;
		
		//$this->checkPermissions('show', $data);
		
		$fields[] = 'do';
		$data['do'] = 'Accidents|show&show=applications';
		
		
		$this->setTables('show');
		$this->setShowFields();

        $conditions[] = '1';

        if (intval($data['statuses_id'])) {
			$fields[] = 'statuses_id';
            $conditions[] = PREFIX . '_application_accidents.statuses_id = ' . intval($data['statuses_id']);
        }

        if (intval($data['product_types_id'])) {
			$fields[] = 'product_types_id';
            switch ($data['product_types_id']) {
                case PRODUCT_TYPES_KASKO:
                    $conditions[] = PREFIX . '_application_accidents.policies_kasko_id > 0';
                    break;
                case PRODUCT_TYPES_GO:
                    $conditions[] = PREFIX . '_application_accidents.policies_go_id > 0';
                    break;
            }
        }

        if ($data['sign']) {
			$fields[] = 'sign';
            $conditions[] = 'IF(' . PREFIX .'_application_accidents.policies_kasko_items_id > 0, ' . PREFIX . '_policies_kasko_items.sign LIKE ' . $db->quote('%' . $data['sign'] . '%') . ' , 1)';
            $conditions[] = 'IF(' . PREFIX .'_application_accidents.policies_go_id > 0, ' . PREFIX . '_policies_go.sign LIKE ' . $db->quote('%' . $data['sign'] . '%') . ' , 1)';
        }

        if ($data['insurer']) {
			$fields[] = 'insurer';
            $conditions[] = '(kasko.insurer LIKE ' . $db->quote('%' . $data['insurer'] . '%') . ' OR go.insurer LIKE ' . $db->quote('%' . $data['insurer'] . '%') . ')';
        }

        if ($data['policies_number']) {
			$fields[] = 'policies_number';
            switch ($data['product_types_id']) {
                case PRODUCT_TYPES_KASKO:
                    $conditions[] = 'kasko.number LIKE ' . $db->quote('%' . $data['policies_number'] . '%');
                    break;
                case PRODUCT_TYPES_GO:
                    $conditions[] = 'go.number LIKE ' . $db->quote('%' . $data['policies_number'] . '%');
                    break;
                default:
                    $conditions[] = '(kasko.number LIKE ' . $db->quote('%' . $data['policies_number'] . '%') . ' OR go.number LIKE ' . $db->quote('%' . $data['policies_number'] . '%') . ')';
                    break;
            }
        }

        if ($data['number']) {
			$fields[] = 'number';
            $conditions[] = PREFIX . '_application_accidents.number LIKE ' . $db->quote('%' . $data['number'] . '%');
        }

        if ($Authorization->data['roles_id'] == ROLES_MASTER) {
            $conditions[] = PREFIX . '_application_accidents.car_services_id = ' . intval($Authorization->data['car_services_id']);
        }

        $conditions[] = PREFIX . '_application_accidents.statuses_id <> 10';
		
		if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

		if ($Authorization->data['roles_id'] == ROLES_MASTER) {
			$conditions[] = PREFIX . '_application_accidents.car_services_id = ' . intval($Authorization->data['car_services_id']);
		}
		
		$sql = 'SELECT ' . $this->getShowFieldsSQLString() . ',owner_types_id,policies_kasko_id,policies_kasko_items_id,policies_go_id,victim_brand,victim_model,victim_sign,victim, ' .
					'CASE ' . PREFIX . '_application_accidents.statuses_id ' .
						'WHEN 1 THEN \'Прийом повідомлення\'' .
						'WHEN 2 THEN \'Сформовано\'' .
						'WHEN 3 THEN \'Прийнято\'' .
                        'WHEN 4 THEN \'Страхувальник ЦВ\'' .
					'END as statuses_id, insurance_car_services.title as car_services_title,' .
                    'IF(clients_kasko.important_person = 1 OR clients_go.important_person = 1, 1, 0) as important_person, ' .
					PREFIX . '_application_accidents.statuses_id as status, ' .
					PREFIX . '_application_accidents.documents, ' . PREFIX . '_application_accidents.inspecting_car ' .
					
			   'FROM ' . PREFIX . '_application_accidents ' .
			   'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_application_accidents.creator_id = ' . PREFIX . '_accounts.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as kasko ON ' . PREFIX . '_application_accidents.policies_kasko_id = kasko.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as go ON ' . PREFIX . '_application_accidents.policies_go_id = go.id ' .
               'LEFT JOIN ' . PREFIX . '_clients as clients_kasko ON kasko.clients_id = clients_kasko.id ' .
               'LEFT JOIN ' . PREFIX . '_clients as clients_go ON go.clients_id = clients_go.id ' .
			   'LEFT JOIN ' . PREFIX . '_policies_kasko_items ON ' . PREFIX . '_application_accidents.policies_kasko_items_id = ' . PREFIX . '_policies_kasko_items.id ' .
			   'LEFT JOIN ' . PREFIX . '_policies_go ON ' . PREFIX . '_application_accidents.policies_go_id = ' . PREFIX . '_policies_go.policies_id ' .
			   'LEFT JOIN insurance_car_services ON insurance_car_services.id = ' . PREFIX . '_application_accidents.car_services_id ' .
			   'WHERE ' . implode(' AND ', $conditions) . ' ' .
			   'ORDER BY ';
			   
		$total = $db->getOne(transformToGetCount($sql));
		
		$sql .= $this->getShowOrderCondition();
		
		if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }
		//_dump($sql);
		$list = $db->getAll($sql);

		include $this->objectTitle . '/'.$template;
    }
	
	function view($data, $showForm=true, $action='view', $actionType='view', $template='form.php') {
		global $db;

        $this->mode = 'view';

		$in_accidents = $data['in_accidents'];
        $accidents_id = $data['accidents_id'];
        $product_types_id = $data['product_types_id'];
		$download = $data['download'];
		
		if(is_array($data['id'])){
            $data['id'] = $data['id'][0];
        }

		$this->setTables('view');
		$this->getFormFields('view');

		$identityField = $this->getIdentityField();

		$sql =	'SELECT ' . implode(', ', $this->formFields) . ' ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
		$data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);
		
		$data['in_accidents'] = $in_accidents;
        $data['accidents_id'] = $accidents_id;
        $data['product_types_id'] = $product_types_id;
		$data['download'] = $download;

        if (intval($accidents_id)/* && $data['owner_types_id'] == 2*/) {
            $sql = 'SELECT insurer_application_accidents_id ' .
                   'FROM ' . PREFIX . '_application_accidents_go_victim_to_insurer ' .
                   'WHERE victim_application_accidents_id = ' . intval($data['id']);
            $data['insurer_application_accidents_id'] = $db->getOne($sql);
        }

        $sql = 'SELECT id, number, product_types_id ' .
               'FROM ' . PREFIX . '_accidents ' .
               'WHERE application_accidents_id = ' . intval($data['id']);
        $data['accidents'] = $db->getAll($sql);

		if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
	}
	
	function setAdditionalFields($id, $data, $action=false) {
		global $db;

        switch ($action) {
			case 'insert':
				$sql = 'UPDATE ' . PREFIX . '_application_calls SET application_accidents_id = ' . intval($id) . ' WHERE policies_kasko_items_id = ' . intval($data['policies_kasko_items_id']) . ' AND datetime = ' . $db->quote(date('Y-m-d H:s', strtotime($data['datetime'] . ' ' . $data['datetimeTimePicker'])));
				$db->query($sql);
			
				break;
			default:
				break;
		}
	}

 	function add($data) {
		//$this->checkPermissions('insert', $data);
		
		unset($data['id']);
		parent::showForm($data, 'insert');
	}
	
	function insert($data) {
        global $Log, $Authorization;

		$data['statuses_id'] = 1;

        $data['application_accidents_id'] = parent::insert(&$data, false);

        if ($data['application_accidents_id']) {

	       	$this->setNumber($data);
			
			if ($data['policies_go_id']) {
				$this->setRelation($data);
			}
			
			$this->setAdditionalFields($data['application_accidents_id'], $data, 'insert');

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

			$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
			header('Location: ' . $_SERVER['PHP_SELF'] . '?do=ApplicationAccidents|view&id=' . intval($data['application_accidents_id']) . '&download=' . intval($data['download']));
			exit;
        }		
    }
	
	function setRelation($data) {
		global $db;
		
		switch ($data['owner_types_id']) {
			case '1':
				$owner_types_id = 2;
				$currnet_owner_title = 'insurer_application_accidents_id';
				$other_owner_title = 'victim_application_accidents_id';
				break;
			case '2':
				$owner_types_id = 1;
				$currnet_owner_title = 'victim_application_accidents_id';
				$other_owner_title = 'insurer_application_accidents_id';
				break;
			default:
				exit;
		}
		
		$conditions[] = 'owner_types_id = ' . intval($owner_types_id);
		$conditions[] = 'policies_go_id = ' . intval($data['policies_go_id']);
		$conditions[] = 'date_format(datetime, \'%Y-%m-%d\') = ' . $db->quote($data['datetime_year'].'-'.$data['datetime_month'].'-'.$data['datetime_day']);
		
		$sql = 'SELECT id ' .
			   'FROM ' . PREFIX . '_application_accidents ' .
			   'WHERE ' . implode(' AND ', $conditions);
		$idx = $db->getCol($sql);
		
		$sql = 'DELETE FROM ' . PREFIX . '_application_accidents_go_victim_to_insurer ' .
			   'WHERE insurer_application_accidents_id = ' . intval($data['application_accidents_id']) . ' OR victim_application_accidents_id = ' . intval($data['application_accidents_id']);
		$db->query($sql);
		
		foreach($idx as $id) {
			$sql = 'INSERT INTO ' . PREFIX . '_application_accidents_go_victim_to_insurer ' .
				   'SET ' . $currnet_owner_title . ' = ' . intval($data['application_accidents_id']) . ', ' . $other_owner_title . ' = ' . intval($id);
			$db->query($sql);
		}
	}
	
	function update($data) {
        global $Log;

        $this->checkPermissions('update', $data);

		$previous_statuses_id = $this->getStatusesId($data['id']);

        $data['application_accidents_id'] = parent::update(&$data, false, true);

        if ($data['application_accidents_id']) {
		
			$this->setNumber($data);
			
			if (intval($data['accident_statuses_id'][$data['policies_kasko_id']]) || intval($data['accident_statuses_id'][$data['policies_go_id']])) {
				$this->generateAccidents($data, 'insert');
				$this->setStatusesId($data['application_accidents_id'], 3);
			}

            if (intval($data['accident_statuses_insurer_id'][$data['policies_go_id']])) {
                $this->setStatusesId($data['application_accidents_id'], 4);
            }

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

            $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
			header('Location: ' . $_SERVER['PHP_SELF'] . '?do=ApplicationAccidents|view&id=' . intval($data['application_accidents_id']) . '&download=' . intval($data['download']));
			exit;
        }
    }

    function deleteProcess($data) {
        global $db;

        $sql = 'SELECT DISTINCT application_accidents_id ' .
               'FROM ' . PREFIX . '_accidents ' .
               'WHERE application_accidents_id IN (' . implode(', ', $data['id']) . ')';
        $accidents = $db->getCol($sql);

        $data['id'] = array_diff($data['id'], $accidents);

        if (is_array($data['id']) && sizeOf($data['id'])) {
            //удаляем документы
            $AccidentDocuments = new AccidentDocuments($data);

            $sql =	'SELECT id ' .
                    'FROM ' . $AccidentDocuments->tables[0] . ' ' .
                    'WHERE accidents_id = 0 AND application_accidents_id IN(' . implode(', ', $data['id']) . ')';
            $toDelete['id'] = $db->getCol($sql);

            $AccidentDocuments->delete($toDelete, false, false);

            $sql = 'DELETE ' .
                   'FROM ' . $this->tables[0] . ' ' .
                   'WHERE id IN(' . implode(', ', $data['id']) . ')';
            $db->query($sql);
        }

        return true;
    }
	
	function setNumber($data) {
		global $db;
		
		$sql = 'UPDATE ' . PREFIX . '_application_accidents ' .
			   'SET number = CONCAT(date_format(created, \'%y\'), \'.\', id) ' .
			   'WHERE id = ' . intval($data['id']);
		$db->query($sql);
	}
	
	function generateAccidents($data, $mode) {
		global $Log;

		$data['payment_statuses_id'] = PAYMENT_STATUSES_NOT;
	
		if (intval($data['policies_kasko_id']) /*&& $data['accident_statuses_id'][$data['policies_kasko_id']] != 17*/) {
			$data['accident_statuses_id'] = $data['accident_statuses_id'][$data['policies_kasko_id']];
			if (intval($data['accident_statuses_id'])) {
				$Log->showSystem();
				$values = $this->prepareFieldsAccidents($data, array('mode' => $mode, 'type' => 'kasko'));			
				$Accidents_KASKO = new Accidents_KASKO($values);
				$Accidents_KASKO->permissions[$mode] = true;
				$accident = $this->getAccidentsId($data['id'], PRODUCT_TYPES_KASKO);
				$values['id'] = $values['accidents_id'] = $accident[0]['id'];
				$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('description') ]['verification']['canBeEmpty'] = true;
				$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('damage') ]['verification']['canBeEmpty'] = true;
				$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('location') ]['verification']['canBeEmpty'] = true;
				$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('consequences') ]['verification']['canBeEmpty'] = true;
				$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('inspecting_account_id') ]['verification']['canBeEmpty'] = true;
				$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('driver_document') ]['verification']['canBeEmpty'] = true;
				$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('date') ]['display']['update'] = false;
				$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('masters_id') ]['display']['update'] = false;
				$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('car_services_id') ]['display']['update'] = false;
                $Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('driver_licence_series') ]['verification']['canBeEmpty'] = true;
                $Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('driver_licence_number') ]['verification']['canBeEmpty'] = true;
                $Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('driver_licence_date') ]['verification']['canBeEmpty'] = true;
                $Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('driver_licence_date') ]['display']['update'] = false;
				if ($data['competent_authorities'] == -1) {
					$values['mvs'] = 0;
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('mvs') ]['verification']['canBeEmpty'] = true;
				}
				if ($data['assistance'] == -1) {
					$values['assistance'] = 0;
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('assistance') ]['verification']['canBeEmpty'] = true;
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('assistance_reason') ]['verification']['canBeEmpty'] = true;
				}
				if ($data['driver_types_id'] == 4) {
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('driver_lastname') ]['verification']['canBeEmpty'] = true;
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('driver_firstname') ]['verification']['canBeEmpty'] = true;
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('driver_patronymicname') ]['verification']['canBeEmpty'] = true;
				}
				if ($data['europrotocol'] != 1) {
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('accident_schemes_id') ]['verification']['canBeEmpty'] = true;
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('insurance_company_other') ]['verification']['canBeEmpty'] = true;
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('policies_series_other') ]['verification']['canBeEmpty'] = true;
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('policies_number_other') ]['verification']['canBeEmpty'] = true;
                } elseif ($data['europrotocol'] == 1) {
                    $Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('mvs') ]['verification']['canBeEmpty'] = true;
                }
				
				if ($data['accident_statuses_id'] == 17) {
					$values['archive_statuses_id'] = 1; 
					$Accidents_KASKO->formDescription['fields'][ $Accidents_KASKO->getFieldPositionByName('archive_statuses_id') ]['display']['insert'] = true;
				}
                $Accidents_KASKO->$mode($values, false);
			}
		}
		
		if (intval($data['policies_go_id']) /*&& $data['accident_statuses_id'][$data['policies_go_id']] != 17*/) {
			$data['accident_statuses_id'] = $data['accident_statuses_id'][$data['policies_go_id']];
			if (intval($data['accident_statuses_id'])) {
				$Log->showSystem();				
				$data['victim'] = unserialize($data['victim']);
				foreach($data['victim'] as $risk => $risk_data) {
					if ($risk_data['flag'] == 1) {
						$values = $this->prepareFieldsAccidents($data, array('mode' => $mode, 'type' => 'go', 'risk' => $risk));
						$Accidents_GO = new Accidents_GO($values);
						$Accidents_GO->permissions[$mode] = true;
						$accident = $this->getAccidentsId($data['id'], PRODUCT_TYPES_GO);
						$values['id'] = $values['accidents_id'] = $accident[0]['id'];
						$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('victim_damage_note') ]['verification']['canBeEmpty'] = true;
						$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('description') ]['verification']['canBeEmpty'] = true;
						$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('damage') ]['verification']['canBeEmpty'] = true;
						$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('location') ]['verification']['canBeEmpty'] = true;
						$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('inspecting_account_id') ]['verification']['canBeEmpty'] = true;
						if ($data['owner_types_id'] == 2) {
							unset($values['assistance_date']);
						}
						$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('date') ]['display']['update'] = false;
						$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('masters_id') ]['display']['update'] = false;
						$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('car_services_id') ]['display']['update'] = false;
						if ($data['competent_authorities'] == -1) {
							$values['mvs'] = 0;
							$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('mvs') ]['verification']['canBeEmpty'] = true;
						}
						if ($data['europrotocol'] != 1) {
							$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('accident_schemes_id') ]['verification']['canBeEmpty'] = true;
							$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('owner_insurer_company') ]['verification']['canBeEmpty'] = true;
							$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('owner_policies_series') ]['verification']['canBeEmpty'] = true;
							$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('owner_policies_number') ]['verification']['canBeEmpty'] = true;
						}

                        if ($data['accident_statuses_id'] == 17) {
                            $values['archive_statuses_id'] = 1;
                            $Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('archive_statuses_id') ]['display']['insert'] = true;
                        }
						if ($data['types_id'] == 3) {
							$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('driver_lastname') ]['verification']['canBeEmpty'] = true;
							$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('driver_firstname') ]['verification']['canBeEmpty'] = true;
							$Accidents_GO->formDescription['fields'][ $Accidents_GO->getFieldPositionByName('driver_patronymicname') ]['verification']['canBeEmpty'] = true;
						}
						$Accidents_GO->$mode($values, false);
					}
				}
			}
		}
	}
	
	function prepareFieldsAccidents($data, $params) {
		global $db, $Authorization;

		$creator = $db->getRow('SELECT creator_id, creator_roles_id, car_services_id FROM ' . PREFIX . '_application_accidents WHERE id = ' . $data['id']);
		
		unset($data['id']);
		$data['do'] = 'Accidents|' . $params['mode'];
		$data['companies_id'] = INSURANCE_COMPANIES_EXPRESS;

		
		if ($params['type'] == 'kasko') {			
			$data['policies_id'] = $data['policies_kasko_id'];
			$data['items_id'] = $data['policies_kasko_items_id'];
			
			$data['consequences'] = 0;
		}
		
		if ($params['type'] == 'go') {
			$data['policies_id'] = $data['policies_go_id'];
			if ($data['owner_types_id'] == 2) {
				if ($params['risk'] == 'car') {
					$data['application_risks_id'] = 1;
					$data['property_types_id'] = 1;
					$data['owner_car_type_id'] = $data['victim']['car']['data']['victim_car_type_id'];
					$data['owner_brand_id'] = $data['victim']['car']['data']['brand_id'];
					$data['owner_brand'] = $data['victim']['car']['data']['brand'];
					$data['owner_model_id'] = $data['victim']['car']['data']['model_id'];
					$data['owner_model'] = $data['victim']['car']['data']['model'];
					$data['owner_sign'] = fixSignSimbols($data['victim']['car']['data']['sign']);					
				}
				
				if ($params['risk'] == 'property') {
					$data['application_risks_id'] = 1;
					$data['property_types_id'] = 2;
					$data['property'] = $data['victim']['property']['data']['name'];
				}
				
				if ($params['risk'] == 'life') {
					$data['application_risks_id'] = 2;
					$data['damage_extent_id'] = $data['victim']['life']['data']['damage_id'];
				}
			}
		}		

		$data['applicant_phones'] = $data['applicant_phone'];
		//$data['mvs'] = $data['competent_authorities_id'];
		if ($data['europrotocol'] == 1) {
			if ($params['type'] == 'go') {
				$data['owner_insurer_company'] = $data['applicant_insurer_company'];
				$data['owner_policies_series'] = $data['applicant_policies_series'];
				$data['owner_policies_number'] = $data['applicant_policies_number'];
			}
			if ($params['type'] == 'kasko') {
				$data['insurance_company_other'] = $data['applicant_insurer_company'];
				$data['policies_series_other'] = $data['applicant_policies_series'];
				$data['policies_number_other'] = $data['applicant_policies_number'];
			}
			$data['mvs'] = 4;
		} elseif (intval($data['competent_authorities_id'])) {
			$data['mvs'] = $data['competent_authorities_id'];
		} else {
			$data['mvs'] = 0;
		}
		$data['documents'] = $data['document'];
		
		if ($params['mode'] == 'insert') {
            $created = $this->getCreated($data['application_accidents_id']);

			$data['date'] = date('Y-m-d', strtotime($created));
			$data['date_day'] = date('d', strtotime($created));
			$data['date_month'] = date('m', strtotime($created));
			$data['date_year'] = date('Y', strtotime($created));

			if ($creator['creator_roles_id'] == ROLES_MASTER) {
				$data['masters_id'] = $creator['creator_id'];
				$data['car_services_id'] = $creator['car_services_id'];
			} else {
				$data['masters_id'] = 5000;
				$data['car_services_id'] = 1;
			}
		}
		
		return $data;
	}
	
	function setConstants(&$data) {
		global $Authorization;
		
		$this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['display']['update'] = false;

		$data['creator_id'] = $Authorization->data['id'];
		$data['creator_roles_id'] = $Authorization->data['roles_id'];
		
		if ($Authorization->data['roles_id'] == ROLES_MASTER) {
			$data['car_services_id'] = $Authorization->data['car_services_id'];
		} else {
			$data['car_services_id'] = 1;
		}
		
		if ($this->mode == 'update') {
			$this->formDescription['fields'][ $this->getFieldPositionByName('creator_id') ]['display']['update'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('creator_roles_id') ]['display']['update'] = false;
			$this->formDescription['fields'][ $this->getFieldPositionByName('car_services_id') ]['display']['update'] = false;
		}

        if (!intval($data['policies_kasko_id'])) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('policies_kasko_items_id') ]['display']['insert'] = false;
            $this->formDescription['fields'][ $this->getFieldPositionByName('policies_kasko_items_id') ]['display']['update'] = false;
        }

		if ($data['inspecting_car'] != -1) { //огляд ТЗ
			$this->formDescription['fields'][ $this->getFieldPositionByName('inspecting_car_place') ]['verification']['canBeEmpty'] = true;
			$data['inspecting_car_place'] = '';
			if (!intval($data['inspecting_car'])) {
				$data['inspecting_car'] = 0;
			}
		}
		
		if ($data['inspecting_property'] != 1) { //огляд майна
			$this->formDescription['fields'][ $this->getFieldPositionByName('inspecting_property_place') ]['verification']['canBeEmpty'] = true;
			$data['inspecting_property_place'] = '';
			if (!intval($data['inspecting_property'])) {
				$data['inspecting_property'] = 0;
			}
		}

        if ($data['europrotocol'] == 1) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('competent_authorities_id') ]['verification']['canBeEmpty'] = true;
            $data['competent_authorities_id'] = 0;
            $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
            $data['mvs_id'] = 0;
            $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
            $data['mvs_title'] = '';
            $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date') ]['verification']['canBeEmpty'] = true;
            $data['mvs_date'] = '0000-00-00';
            $data['mvs_date_day'] = '00';
            $data['mvs_date_month'] = '00';
            $data['mvs_date_year'] = '0000';
            $this->formDescription['fields'][ $this->getFieldPositionByName('administrativeprotocol') ]['verification']['canBeEmpty'] = true;
            $data['administrativeprotocol'] = 0;
            $this->formDescription['fields'][ $this->getFieldPositionByName('administrative_protocol_series') ]['verification']['canBeEmpty'] = true;
            $data['administrative_protocol_series'] = '';
            $this->formDescription['fields'][ $this->getFieldPositionByName('administrative_protocol_number') ]['verification']['canBeEmpty'] = true;
            $data['administrative_protocol_number'] = '';
            $this->formDescription['fields'][ $this->getFieldPositionByName('unifiedstateregister') ]['verification']['canBeEmpty'] = true;
            $data['unifiedstateregister'] = 0;
            $this->formDescription['fields'][ $this->getFieldPositionByName('criminal') ]['verification']['canBeEmpty'] = true;
            $data['criminal'] = 0;
            $this->formDescription['fields'][ $this->getFieldPositionByName('criminal_name') ]['verification']['canBeEmpty'] = true;
            $data['criminal_name'] = '';
        }
		
		if ($data['criminal'] != 1) { //кримінал
			
		}
		
		if ($data['competent_authorities'] == -1) { //компетентні органи - не звернення
			$this->formDescription['fields'][ $this->getFieldPositionByName('competent_authorities_id') ]['verification']['canBeEmpty'] = true;
			$data['competent_authorities_id'] = 0;
			$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
			$data['mvs_id'] = 0;
			$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
			$data['mvs_title'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date') ]['verification']['canBeEmpty'] = true;
			$data['mvs_date'] = '0000-00-00';
			$data['mvs_date_day'] = '00';
			$data['mvs_date_month'] = '00';
			$data['mvs_date_year'] = '0000';
			$this->formDescription['fields'][ $this->getFieldPositionByName('administrativeprotocol') ]['verification']['canBeEmpty'] = true;
			$data['administrativeprotocol'] = 0;
			$this->formDescription['fields'][ $this->getFieldPositionByName('administrative_protocol_series') ]['verification']['canBeEmpty'] = true;
			$data['administrative_protocol_series'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('administrative_protocol_number') ]['verification']['canBeEmpty'] = true;
			$data['administrative_protocol_number'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('unifiedstateregister') ]['verification']['canBeEmpty'] = true;
			$data['unifiedstateregister'] = 0;
			$this->formDescription['fields'][ $this->getFieldPositionByName('criminal') ]['verification']['canBeEmpty'] = true;
			$data['criminal'] = 0;
			$this->formDescription['fields'][ $this->getFieldPositionByName('criminal_name') ]['verification']['canBeEmpty'] = true;
			$data['criminal_name'] = '';
		} elseif ($data['competent_authorities'] == 1) { //компетентні органи - звернення
			$this->formDescription['fields'][ $this->getFieldPositionByName('europrotocol') ]['verification']['canBeEmpty'] = true;
			$data['europrotocol'] = 0;
			
			switch ($data['competent_authorities_id']) {
				case 1: //ДАІ
					$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
					$data['mvs_title'] = '';
					$this->formDescription['fields'][ $this->getFieldPositionByName('unifiedstateregister') ]['verification']['canBeEmpty'] = true;
					$data['unifiedstateregister'] = 0;
					break;
				case 2: //органи МВС
					$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
					$data['mvs_id'] = 0;
					$this->formDescription['fields'][ $this->getFieldPositionByName('administrativeprotocol') ]['verification']['canBeEmpty'] = true;
					$data['administrativeprotocol'] = 0;
					$this->formDescription['fields'][ $this->getFieldPositionByName('administrative_protocol_series') ]['verification']['canBeEmpty'] = true;
					$data['administrative_protocol_series'] = '';
					$this->formDescription['fields'][ $this->getFieldPositionByName('administrative_protocol_number') ]['verification']['canBeEmpty'] = true;
					$data['administrative_protocol_number'] = '';					
					break;
				case 3: //МНС
					$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
					$data['mvs_id'] = 0;
					$this->formDescription['fields'][ $this->getFieldPositionByName('administrativeprotocol') ]['verification']['canBeEmpty'] = true;
					$data['administrativeprotocol'] = 0;
					$this->formDescription['fields'][ $this->getFieldPositionByName('unifiedstateregister') ]['verification']['canBeEmpty'] = true;
					$data['unifiedstateregister'] = 0;
					$this->formDescription['fields'][ $this->getFieldPositionByName('criminal') ]['verification']['canBeEmpty'] = true;
					$data['criminal'] = 0;
					$this->formDescription['fields'][ $this->getFieldPositionByName('criminal_name') ]['verification']['canBeEmpty'] = true;
					$data['criminal_name'] = '';
					break;
                case 4: //Поліція
                    $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
                    $data['mvs_id'] = 0;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('unifiedstateregister') ]['verification']['canBeEmpty'] = true;
                    $data['unifiedstateregister'] = 0;
                    break;
			}
		}

		if ($data['administrativeprotocol'] == -1 || $data['europrotocol'] == 1) { //адміністративний протокол не складено
			$this->formDescription['fields'][ $this->getFieldPositionByName('administrative_protocol_series') ]['verification']['canBeEmpty'] = true;
			$data['administrative_protocol_series'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('administrative_protocol_number') ]['verification']['canBeEmpty'] = true;
			$data['administrative_protocol_number'] = '';
		}
		
		if ($data['europrotocol'] == -1 || $data['competent_authorities'] == 1 || $data['types_id'] != 2) { //європротокол не складено
			$this->formDescription['fields'][ $this->getFieldPositionByName('accident_schemes_id') ]['verification']['canBeEmpty'] = true;
			$data['accident_schemes_id'] = 0;
			$this->formDescription['fields'][ $this->getFieldPositionByName('applicant_insurer_company') ]['verification']['canBeEmpty'] = true;
			$data['applicant_insurer_company'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('applicant_policies_series') ]['verification']['canBeEmpty'] = true;
			$data['applicant_policies_series'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('applicant_policies_number') ]['verification']['canBeEmpty'] = true;
			$data['applicant_policies_number'] = '';
		}
		
		if ($data['criminal'] == -1 || !intval($data['criminal'])) {
			$this->formDescription['fields'][ $this->getFieldPositionByName('criminal_name') ]['verification']['canBeEmpty'] = true;
			$data['criminal_name'] = '';
		}
		
		if ($data['assistance'] == -1) { //не звернення в ДЦ
			$this->formDescription['fields'][ $this->getFieldPositionByName('assistance_place') ]['verification']['canBeEmpty'] = true;
			$data['assistance_place'] = 0;
			$this->formDescription['fields'][ $this->getFieldPositionByName('assistance_date') ]['verification']['canBeEmpty'] = true;
			$data['assistance_date'] = '0000-00-00';
			$data['assistance_date_day'] = '00';
			$data['assistance_date_month'] = '00';
			$data['assistance_date_year'] = '0000';
		} elseif ($data['assistance_place'] == 1) { //звернення в ДЦ з місця пригоди
			$this->formDescription['fields'][ $this->getFieldPositionByName('assistance_date') ]['verification']['canBeEmpty'] = true;
			$data['assistance_date'] = '0000-00-00';
			$data['assistance_date_day'] = '00';
			$data['assistance_date_month'] = '00';
			$data['assistance_date_year'] = '0000';
		}
		
		if ($data['owner_types_id'] == 1) { //від страхувальника
			$this->formDescription['fields'][ $this->getFieldPositionByName('victim') ]['verification']['canBeEmpty'] = true;
			$data['victim'] = '';
		}
		
		if ($data['owner_types_id'] == 2) { //від потерпілого 
			$this->formDescription['fields'][ $this->getFieldPositionByName('administrative_protocol_series') ]['verification']['canBeEmpty'] = true;
			$data['administrative_protocol_series'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('administrative_protocol_number') ]['verification']['canBeEmpty'] = true;
			$data['administrative_protocol_number'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('assistance') ]['verification']['canBeEmpty'] = true;
			$data['assistance'] = 0;
			$this->formDescription['fields'][ $this->getFieldPositionByName('assistance_place') ]['verification']['canBeEmpty'] = true;
			$data['assistance_place'] = 0;
			$this->formDescription['fields'][ $this->getFieldPositionByName('assistance_date') ]['verification']['canBeEmpty'] = true;
			$data['assistance_date'] = '0000-00-00';
			$data['assistance_date_day'] = '00';
			$data['assistance_date_month'] = '00';
			$data['assistance_date_year'] = '0000';
			$this->formDescription['fields'][ $this->getFieldPositionByName('damage') ]['verification']['canBeEmpty'] = true;
			$data['damage'] = '';
		}
		
		if ($data['driver_types_id'] == 4 || ($data['types_id'] == 3 || !isset($data['victim']['car']['flag'])) && $data['owner_types_id'] == 2) { //без водія
			$this->formDescription['fields'][ $this->getFieldPositionByName('driver_lastname') ]['verification']['canBeEmpty'] = true;
			$data['driver_lastname'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('driver_firstname') ]['verification']['canBeEmpty'] = true;
			$data['driver_firstname'] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName('driver_patronymicname') ]['verification']['canBeEmpty'] = true;
			$data['driver_patronymicname'] = '';
		}

		$this->formDescription['fields'][ $this->getFieldPositionByName('victim_car_type_id') ]['display']['insert'] = false;
		$this->formDescription['fields'][ $this->getFieldPositionByName('victim_car_type_id') ]['display']['update'] = false;
		
		if ($data['owner_types_id'] == 1 || !intval($data['victim']['car']['flag'])) {
			$data['victim']['car'] = '';
		} elseif (intval($data['victim']['car']['flag']) || $data['owner_types_id'] == 2) {
			$data['victim']['car']['data']['victim_car_type_id'] = $data['victim_car_type_id'];
		}
		
		if ($data['owner_types_id'] == 1 || !intval($data['victim']['property']['flag'])) {
			$data['victim']['property'] = '';
		}
		
		if ($data['owner_types_id'] == 1 || !intval($data['victim']['life']['flag'])) {
			$data['victim']['life'] = '';
		}
		
		$data['victim'] = serialize($data['victim']);
		
		if (!is_array($data['participants']) && !sizeOf($data['participants'])) { //інші учасники		
			$this->formDescription['fields'][ $this->getFieldPositionByName('participants') ]['verification']['canBeEmpty'] = true;
			$data['participants'] = '';
		} else {
			$participants = array();
			foreach($data['participants'] as $participant) {
				$participants[] = $participant;
			}
			$data['participants'] = $participants;
			$data['participants'] = serialize($data['participants']);
		}
		
		if (!is_array($data['document']) && !sizeOf($data['document']) && !sizeOf($data['product_document_types'])) { //документи
			$this->formDescription['fields'][ $this->getFieldPositionByName('documents') ]['verification']['canBeEmpty'] = true;
			$data['documents'] = '';
		} else {
			$i=0;
			foreach($data['document'] as $document) {
				$temp_data_document[$i] = $document;
				$i++;
			}
			$data['documents']['others'] = $temp_data_document;
			$data['documents']['product_document_types'] = $data['product_document_types'];		
			$data['documents'] = serialize($data['documents']);
		}
	}
	
	function prepareFields($action, $data) {
        $data = parent::prepareFields($action, $data);

		$data['participants'] = unserialize($data['participants']);
		
		$data['documents'] = unserialize($data['documents']);
		$data['product_document_types'] = $data['documents']['product_document_types'];
		$data['document'] = $data['documents']['others'];
		
		$data['victim'] = unserialize($data['victim']);
		$data['victim_car_type_id'] = $data['victim']['car']['victim_car_type_id'];
		
		if (!intval($data['victim']['car']['flag'])) $data['victim']['car']['data'] = '';
		if (!intval($data['victim']['property']['flag'])) $data['victim']['property']['data'] = '';
		if (!intval($data['victim']['life']['flag'])) $data['victim']['life']['data'] = '';
		
		return $data;
	}
	
	function getStatusesId($id) {
		global $db;
		
		$sql = 'SELECT statuses_id ' .
			   'FROM ' . PREFIX . '_application_accidents ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function setStatusesId($id, $statuses_id) {
		global $db;
		
		$sql = 'UPDATE ' . PREFIX . '_application_accidents ' .
			   'SET statuses_id = ' . intval($statuses_id) . ' ' .
			   'WHERE id = ' . intval($id);
		$db->query($sql);
	}
	
	function getAccidentsId($id, $product_types_id=null) {
		global $db;
		
		$conditions[] = 'application_accidents_id = ' . intval($id);
		if (intval($product_types_id)) {
			$conditions[] = 'product_types_id = ' . intval($product_types_id);
		}
		
		$sql = 'SELECT id, product_types_id ' .
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE ' . implode(' AND ', $conditions);
		return $db->getAll($sql);
	}
	
	function getCreated($id) {
		global $db;
		
		$sql = 'SELECT created ' .
			   'FROM ' . PREFIX . '_application_accidents ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function generateDocuments($id,	$messages_id, $payments_calendar_id, $acts_id, $product_document_types, $data) {

        if (is_array($product_document_types)) {

            $AccidentDocuments = new AccidentDocuments($data);

            foreach ($product_document_types as $product_document_types_id) {
                $AccidentDocuments->generate(0, $id, $messages_id, $payments_calendar_id, $acts_id, $product_document_types_id, $data);
            }
        }
    }
	
	function getValues($data) {
		global $db;		
		
		$sql = 'SELECT application_accidents.created, application_accidents.number as application_accidents_number, application_accidents.owner_types_id, application_accidents.datetime, application_accidents.address, application_accidents.policies_kasko_id, application_accidents.policies_go_id, ' .
					'parameters_risks.title as application_risks_title, parameters_risks.id as application_risks_id, ' .
					'application_accidents.applicant_lastname, application_accidents.applicant_firstname, application_accidents.applicant_patronymicname, ' .
					'application_accidents.applicant_regions_id, application_accidents.applicant_street_types_id, application_accidents.applicant_street, application_accidents.applicant_area, application_accidents.applicant_city, ' .
					'application_accidents.applicant_house, application_accidents.applicant_flat, application_accidents.applicant_phone, ' .
					'application_accidents.damage, ' .
					'car_types_kasko.title as car_types_kasko_title, car_types_go.title as car_types_go_title, ' .
					'kasko_items.brand as kasko_brand, kasko_items.model as kasko_model, policies_go.brand as go_brand, policies_go.model as go_model, kasko_items.sign as kasko_sign, policies_go.sign as go_sign, ' .
					'kasko_policies.number as policies_kasko_number, kasko_policies.date as policies_kasko_date, go_policies.number as policies_go_number, go_policies.date as policies_go_date, ' .
					'application_accidents.competent_authorities, application_accidents.competent_authorities_id, ' .
					'IF(application_accidents.competent_authorities_id = 1, mvs.title, IF(application_accidents.competent_authorities_id = 0, \'Не повідомлено\', application_accidents.mvs_title)) as mvs_title, application_accidents.mvs_date as mvs_date, ' .
					'application_accidents.europrotocol, application_accidents.accident_schemes_id, application_accidents.applicant_insurer_company, application_accidents.applicant_policies_series, application_accidents.applicant_policies_number, ' .
					'application_accidents.administrativeprotocol, application_accidents.administrative_protocol_series, application_accidents.administrative_protocol_number, ' .
					'application_accidents.unifiedstateregister, application_accidents.criminal, application_accidents.criminal_name, ' .
					'application_accidents.driver_types_id, application_accidents.driver_lastname, application_accidents.driver_firstname, application_accidents.driver_patronymicname, ' .
					'application_accidents.participants, ' .
					'application_accidents.inspecting_car, application_accidents.inspecting_car_place, application_accidents.inspecting_property, application_accidents.inspecting_property_place, ' .
					'application_accidents.assistance_place, application_accidents.assistance, application_accidents.assistance_date, ' .
					'application_accidents.documents, ' .
					
					'application_accidents.victim, ' .
					
					'accounts_creator.lastname as creator_lastname, accounts_creator.firstname as creator_firstname, accounts_creator.patronymicname as creator_patronymicname ' .
					
			   'FROM ' . PREFIX . '_application_accidents as application_accidents ' .
			   'LEFT JOIN ' . PREFIX . '_policies as kasko_policies ON application_accidents.policies_kasko_id = kasko_policies.id ' .
			   'LEFT JOIN ' . PREFIX . '_policies as go_policies ON application_accidents.policies_go_id = go_policies.id ' .
			   'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON application_accidents.policies_kasko_id = kasko_items.policies_id AND application_accidents.policies_kasko_items_id = kasko_items.id ' .
			   'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON application_accidents.policies_go_id = policies_go.policies_id ' .
			   'LEFT JOIN ' . PREFIX . '_parameters_risks as parameters_risks ON application_accidents.application_risks_id = parameters_risks.id ' .
			   'LEFT JOIN ' . PREFIX . '_mvs as mvs ON application_accidents.mvs_id = mvs.id ' .
			   'LEFT JOIN ' . PREFIX . '_car_types as car_types_kasko ON kasko_items.car_types_id = car_types_kasko.id ' .
			   'LEFT JOIN ' . PREFIX . '_car_types as car_types_go ON policies_go.car_types_id = car_types_go.id ' .
			   'LEFT JOIN ' . PREFIX . '_accounts as accounts_creator ON application_accidents.creator_id = accounts_creator.id ' .
			   'WHERE application_accidents.id = ' . intval($data['application_accidents_id']);
		$row = $db->getRow($sql);		
		
		$row['companies_id'] = 4;
		
		$fields = array(
			'created_format',
			'applicant',
			'applicant_address',
			'owner_types_title',
			'datetime_format',
			'brand',
			'sign',
			'driver',
			'participants',
			'documents',
			'victim'
		);

		return $this->prepareValues($fields, $row);
	}
	
	function prepareValues($fields, $row) {
		global $MONTHES_DATE;

		foreach ($fields as $field) {
			switch ($field) {
				case 'created_format':
					$row[$field] = '«' . substr($row['created'], 8, 2) . '» ' . $MONTHES_DATE[ intval(substr($row['created'], 5, 2)) - 1 ] . ' ' . substr($row['created'], 0, 4) . 'р.';
					break;
				case 'applicant':
					$row[$field] = $row['applicant_lastname'] . ' ' . $row['applicant_firstname'] . ' ' . $row['applicant_patronymicname'];
					break;				
				case 'applicant_address':
                    $region = Regions::getTitle($row['applicant_regions_id']);
					$street = StreetTypes::getTitle($row['applicant_street_types_id']) . ' ' . $row['applicant_street'];
					$row[$field] = $region . (strlen($row['applicant_area']) ? ', ' . $row['applicant_area'] . ' р-он' : '') . (strlen($row['applicant_city'] && !in_array($row['applicant_regions_id'], array(26, 27))) ? ', ' . $row['applicant_city'] : '') .
						', ' . $street . (strlen($row['applicant_house']) ? ', буд. ' . $row['applicant_house'] : '') . (strlen($row['applicant_flat']) ? ', кв. ' . $row['applicant_flat'] : '');// . (strlen($row['applicant_phone']) ? ', <br/>тел. ' . $row['applicant_phone'] : '');
                    break;
				case 'owner_types_title':
					$row[$field] = ($row['owner_types_id'] == 1 ? 'Страхувальника' : 'Потерпілого');
					break;
				case 'datetime_format':
					$row[$field] = '«' . substr($row['datetime'], 8, 2) . '» ' . $MONTHES_DATE[ intval(substr($row['datetime'], 5, 2)) - 1 ] . ' ' . substr($row['datetime'], 0, 4) . 'р. о ' . substr($row['datetime'], 11, 2) . ' год. ' . substr($row['datetime'], 14, 2) . ' хв.';
					break;
				case 'brand':
					$row[$field] = (intval($row['policies_kasko_id']) ? $row['kasko_brand'] : $row['go_brand']);
					break;
				case 'sign':
					$row[$field] = (intval($row['policies_kasko_id']) ? $row['kasko_sign'] : $row['go_sign']);
					break;
				case 'driver':
					if ($row['driver_types_id'] != 4)
						$row[$field] = $row['driver_lastname'] . ' ' . $row['driver_firstname'] . ' ' . $row['driver_patronymicname'];
					else
						$row[$field] = 'Без водія';
					break;
				case 'participants':
					$row[$field] = unserialize($row[$field]);
					foreach ($row[$field] as $i => $participant) {
						if (intval($participant['car']['flag'])) {
							$row[$field][$i]['car']['data']['car_type_title'] = CarTypes::getTitle($row[$field][$i]['car']['data']['car_type_id']);
						}
						if (intval($participant['life']['flag'])) {
							$row[$field][$i]['life']['data']['damage_title'] = $this->life_damage_id[ $row[$field][$i]['life']['data']['damage_id'] ];
						}
					}
					if (is_array($row[$field]) && sizeof($row[$field])) {
							$temp = array(); //reindex for Smarty
							foreach ($row[$field] as $i => $participant) {
								$temp[] = $participant;
							}
							$row[$field]= $temp;
							
					}
					break;
				case 'documents':
					$documents = unserialize($row[$field]);
					if (sizeOf($documents['product_document_types']) && sizeOf($documents['others'])) {
						$row[$field] = array_merge(ProductDocumentTypes::getListByIdx($documents['product_document_types']), $documents['others']);
					} elseif (sizeOf($documents['product_document_types'])) {
						$row[$field] = ProductDocumentTypes::getListByIdx($documents['product_document_types']);
					} elseif (sizeOf($documents['others'])) {
						$row[$field] = $documents['others'];
					}

					$row['additional_documents'] = $documents['others'];
					$row['product_document_types_ids'] = $documents['product_document_types'];
					break;
				case 'victim':
					$row[$field] = unserialize($row[$field]);
					if (intval($row[$field]['car']['flag'])) {
						$row[$field]['car']['data']['car_type_title'] = CarTypes::getTitle($row[$field]['car']['data']['victim_car_type_id']);
					}
					if (intval($row[$field]['life']['flag'])) {
						$row[$field]['life']['data']['damage_title'] = $this->life_damage_id[ $row[$field]['life']['data']['damage_id'] ];
					}
					break;
			}
		}
//_dump($row);exit;
		return $row;
	}

    function getTitleRiskGO($accidents_id) {
        global $db;

        $sql = 'SELECT property_types_id ' .
               'FROM ' . PREFIX . '_accidents_go ' .
               'WHERE accidents_id = ' . intval($accidents_id);
        $property_types_id = intval($db->getOne($sql));

        switch ($property_types_id) {
            case 0:
                return 'Шкода заподіяна життю, здоров\'ю 3-х осіб';
                break;
            case 1:
                return 'Шкода заподіяна майну 3-х осіб';
                break;
            case 2:
                return 'Шкода заподіяна майну 3-х осіб, крім транспортного засобу';
                break;
            default:
                return 'Не визначено';
                break;
        }
    }

    function changeInspectingAccountCustom () {
        global $db;

        $numbers[] = "16.3351";
        $numbers[] = "16.3465";
        $numbers[] = "16.3927";
        $numbers[] = "16.3928";
        $numbers[] = "16.3987";
        $numbers[] = "16.4097";
        $numbers[] = "16.4129";
        $numbers[] = "16.4160";
        $numbers[] = "16.4161";
        $numbers[] = "16.3943";
        $numbers[] = "16.3908";
        $numbers[] = "16.4109";
        $numbers[] = "16.3839";

        $idMaster = 7153;

        $sql = 'UPDATE ' . PREFIX . '_application_accidents ' .
               'SET inspecting_accounts_id = ' . intval($idMaster) . ' ' .
               'WHERE number IN(' . implode(', ', $numbers) . ')';
        $db->query($sql);


    }

    function changeInspectingAccount($data) {
        global $db;

        if (intval($data['change'])) {
            $sql = 'UPDATE ' . PREFIX . '_application_accidents ' .
                'SET inspecting_accounts_id = ' . intval($data['masters_id_message']) . ' ' .
                'WHERE id IN(' . implode(', ', $data['id']) . ')';
            $db->query($sql);

            header('Location: /index.php?do=Accidents|show');
        } else {
            include_once $this->object . '/changeInspectingAccount.php';
        }
    }
	
	function setDocumentsByRisk($data) {
		global $db;
		
		if (!isset($data['risks_id'])) {
			$sql = 'SELECT id, title ' .
				   'FROM ' . PREFIX . '_parameters_risks ' .
				   'WHERE product_types_id = ' . PRODUCT_TYPES_KASKO;
			$list = $db->getAll($sql);
			
			include_once $this->objectTitle . '/showDocumentsByRisk.php';
			exit;
		}
		
		if (!isset($data['save'])) {
			$sql = 'SELECT a.id, a.title, b.title as pt_title ' .
				   'FROM ' . PREFIX . '_product_document_types as a ' . 
				   'JOIN ' . PREFIX . '_product_types as b ON a.product_types_id = b.id ' .
				   'WHERE a.sections_id = 2 AND a.product_types_id IN(1,3,4) ' . //AND a.id IN (51,152,73,19,55,153,1,154,155,156,157,158,13,61,159,62,63,12,15,36)' . ' ' .
				   'ORDER BY a.title';
			$product_document_types = $db->getAll($sql);
			
			$sql = 'SELECT product_document_types_id ' .
				   'FROM ' . PREFIX . '_documents_by_risk ' .
				   'WHERE risks_id = ' . intval($data['risks_id']);
			$product_document_types_sel = $db->getCol($sql);
			
			include_once $this->objectTitle . '/formDocumentsByRisk.php';
			exit;
		}
		
		$sql = 'DELETE FROM ' . PREFIX . '_documents_by_risk WHERE risks_id = ' . intval($data['risks_id']);
		$db->query($sql);
		
		foreach ($data['product_document_types_id'] as $product_document_types_id) {
			$sql = 'INSERT INTO ' . PREFIX . '_documents_by_risk ' .
				   'SET risks_id = ' . intval($data['risks_id']) . ', product_document_types_id = ' . intval($product_document_types_id);
			$db->query($sql);
		}
		
		header('Location: index.php?do=ApplicationAccidents|setDocumentsByRisk');
		exit;
	}
	
	function exportInWindow($data) {

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        $this->show($data, null, null, null, 'excel.php', false);
        exit;
    }
}

?>