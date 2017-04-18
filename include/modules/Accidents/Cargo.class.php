<?
/*
 * Title: accident Cargo class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';
require_once 'AccidentMessages.class.php';
require_once 'AccidentStatusChanges.class.php';

class Accidents_Cargo extends Accidents {

	var $product_types_id = PRODUCT_TYPES_CARGO_CERTIFICATE;
	
	var $previousStatusesSchema = array(
		ACCIDENT_STATUSES_COORDINATION => array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE)		
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
                            'table'             => 'accidents'),
						array(
                            'name'              => 'application_accidents_id',
                            'type'              => fldIdentity,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'                  => 'product_types_id',
                            'description'           => 'Тип продукту',
                            'type'                  => fldHidden,
                            'display'               =>
                                array(
                                        'show'      => false,
                                        'insert'    => true,
                                        'view'      => true,
                                        'update'    => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'accidents'),
                        array(
                            'name'              => 'companies_id',
                            'description'       => 'Компанія',
                            'type'              => fldSelect,
							'condition'			=> 'id = 4',//оставляем только Экспресс Страхование
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
                            'table'             => 'accidents',
                            'sourceTable'       => 'companies',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'policies_id',
                            'description'       => 'Поліс',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents',
                            'sourceTable'       => 'policies',
                            'selectField'       => 'id',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'CONCAT(insurance_policies.number) AS policies_number',
                            'description'       => 'Поліс',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'withoutTable'		=> true,
							'orderName'			=> 'policies_number', 
                            'orderPosition'     => 3,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'insurer_company',//'CONCAT(insurance_policies_cargo_general.lastname, \' \', insurance_policies_cargo_general.firstname) AS insurer',
                            'description'       => 'Страхувальник',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => true
                                ),
							//'withoutTable'		=> true,
							//'orderName'			=> 'insurer',  
							'orderPosition'		=> 4,
                            'table'				=> 'policies_cargo'),
                        /*array(
                            'name'              => 'CONCAT(insurance_policies_cargo_items.brand, \' \',insurance_policies_cargo_items.model) AS item',
                            'description'       => 'Об\'єкт',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'withoutTable'		=> true,
                            'orderName'     	=> 'item',
                            'orderPosition'     => 5,
                            'table'             => 'policies_cargo_items'),*/
                        /*array(
                            'name'              => 'repair_classifications_id',
                            'description'       => 'Класифікація відновлюваного ремонту',
                            'type'              => fldRadio,
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
                            'table'             => 'accidents'),*/
                        array(
                            'name'              => 'items_id',
                            'description'       => 'Об\'єкт',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents_cargo'),
                        array(
                            'name'              => 'number',
                            'description'       => 'Номер',
                            'type'              => fldText,
                            'maxlenght'         => 20,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'orderPosition'     => 1,
                            'table'             => 'accidents'),
						/*array(
                            'name'              => 'in_express',
                            'description'       => 'Наявність в СК',
                            'type'              => fldInteger,
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
                            'table'             => 'accidents'),*/
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
                            'table'				=> 'accidents'),
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
                            'table'            => 'accidents'),
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
                            'table'            => 'accidents'),
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
                            'table'             => 'accidents',
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
                            'table'             => 'accidents'),
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
                            'table'             => 'accidents'),
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
							'table'				=> 'accidents',
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
                            'table'             => 'accidents'),
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
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'applicant_flat',
                            'description'       => 'Заявник, квартира',
                            'type'              => fldText,
                            'maxlength'         => 4,
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
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'applicant_phones',
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
                            'table'            => 'accidents'),
                        array(
                            'name'              => 'datetime',
                            'description'       => 'Подія',
                            'type'              => fldDateTime,
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
							'table'             => 'accidents'),
                        array(
                            'name'              => 'address',
                            'description'       => 'Адреса',
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
                            'table'            => 'accidents_cargo'),
                        array(
                            'name'             => 'description',
                            'description'      => 'Обставини',
                            'type'             => fldNote,
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
                            'table'            => 'accidents'),
                        array(
                            'name'             => 'damage',
                            'description'      => 'Пошкодження',
                            'type'             => fldNote,
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
                            'table'            => 'accidents'),
                        array(
                            'name'             => 'location',
                            'description'      => 'Місцезнаходження вантажу',
                            'type'             => fldText,
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
                            'table'            => 'accidents'),
                        array(
                            'name'             => 'application_risks_id',
                            'description'      => 'Ризик',
                            'type'             => fldConst,
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
							'value'			   => 11,
                            'table'            => 'accidents'),
                        array(
                            'name'              => 'mvs',
                            'description'       => 'Орган куди звернувся',
                            'type'              => fldRadio,
                            'list'              => array(
													'0' => 'Нiкуди',
													'1' => 'Органи ДАІ',
													'2' => 'Органи МВС',
													'3' => 'МНС'),
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
                            'table'             => 'accidents_cargo'),
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
                            'table'             => 'accidents_cargo',
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
                            'table'             => 'accidents_cargo'),
                        array(
                            'name'              => 'inspecting_account_id',
                            'description'       => 'Огляд ТЗ провів',
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
                            'table'             => 'accidents_cargo',
                            'selectField'       => 'CONCAT(lastname,\' \', firstname)',
                            'orderField'        => 'id',
                            'sourceTable'       => 'accounts'),
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
                            'table'             => 'accidents_cargo'),
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
                            'table'             => 'accidents'),
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
                            'table'             => 'accidents'),
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
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'assistance_reason',
                            'description'       => 'Причина',
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
                            'table'             => 'accidents'),
						array(
							'name'              => 'documents',
							'description'       => 'Документи',
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
									'canBeEmpty'    => true
								),
							'table'             => 'accidents'),
                        array(
                            'name'              => 'date',
                            'description'       => 'Дата заяви',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 2,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'car_services_id',
                            'description'       => 'СТО',
                            'type'              => fldSelect,
                            'structure'         => 'tree',
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
                            'table'             => 'accidents',
                            'sourceTable'       => 'car_services',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'masters_id',
                            'description'       => 'Виконавець(і)',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 18,
                            'table'             => 'accidents',
                            'sourceTable'       => 'accounts',
							'selectId'			=> 'id',
                            'selectField'       => 'lastname',
                            'orderField'        => 'lastname'),
                        array(
                            'name'              => 'comment',
                            'description'       => 'Комментар',
                            'type'              => fldNote,
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
                            'table'            	=> 'accidents'),
                        array(
                            'name'              => 'amount_rough',
                            'description'       => 'Орієнтовний збиток, грн.',
                            'type'              => fldMoney,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'orderPosition'     => 7,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'accident_sections_id',
                            'description'       => 'Категорія',
                            'type'              => fldMultipleSelect,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'orderPosition'     => 8,
                            'table'             => 'accidents',
                            'sourceTable'       => 'accident_sections',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'insurance',
                            'description'       => 'Випадок',
                            'type'              => fldInteger,
							'list'				=> array(
													1 => 'Страховий, з виплатою',
													2 => 'Страховий, без виплати',
													3 => 'Не страховий'),
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'orderPosition'     => 9,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'regres',
                            'description'       => 'Регрес',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'orderPosition'     => 10,
                            'table'             => 'accidents'),
                        /*array(
                            'name'              => 'repair_classifications_id',
                            'description'       => 'Клас ремонту',
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
                            'orderPosition'     => 11,
                            'table'             => 'accidents'),*/
                        array(
                            'name'              => 'payment_statuses_id',
                            'description'       => 'Оплата',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'orderPosition'     => 12,
                            'table'             => 'accidents',
                            'sourceTable'       => 'payment_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'            	=> 'compensation',
                            'description'       => 'Відшкодування, грн',
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
                                    'canBeEmpty'	=> false
                                ),
							'withoutTable'		=> true,
							'orderName'			=> 'compensation',
                            'orderPosition'     => 13,
                            'table'             => 'accidents_payment_calendar'),
                        array(
                            'name'              => 'accident_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldSelect,
							'condition'			=> 'id > 0',
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
                            'orderPosition'     => 14,
                            'table'             => 'accidents',
                            'sourceTable'       => 'accident_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'master_documents',
                            'description'       => 'Документи',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false,
                                    'change'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 15,
                            'table'             => 'accidents'),
						array(
                            'name'              => 'avr_sign',
                            'description'       => 'АВР',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false,
                                    'change'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 16,
                            'table'             => 'accidents'),
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
                            'orderPosition'     => 17,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'            	=> 'days',
                            'description'       => 'Тривалість в статусі, дні',
                            'type'              => fldInteger,
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
							'withoutTable'		=> true,
							'orderName'			=> 'days',
                            'orderPosition'     => 19,
                            'table'             => 'accidents')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 19,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'number'
                    )
                );

    var $classificationFormDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'id',
                            'type'              => fldIdentity,
                            'display'           =>
                                array(
                                    'show'		=> true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'average_managers_id',
                            'description'       => 'Аварійний комісар',
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
                                    'canBeEmpty'	=> false
                                ),
                            'table'            	=> 'accidents',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'accounts_id'),
                        array(
                            'name'              => 'estimate_managers_id',
                            'description'       => 'Експерт',
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
                                    'canBeEmpty'	=> false
                                ),
                            'table'            	=> 'accidents',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'amount_rough',
                            'description'       => 'Орієнтовний збиток, грн.',
                            'type'              => fldMoney,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'accident_sections_id',
                            'description'       => 'Категорія',
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
                            'table'             => 'accidents',
                            'sourceTable'       => 'accident_sections',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
						array(
                            'name'             => 'application_risks_id',
                            'description'      => 'Ризик',
                            'type'             => fldConst,
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
							'value'			   => 11,
                            'table'            => 'accidents'),
                        array(
                            'name'              => 'accident_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents')
                    )
            );

	var $riskFormDescription =
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
                            'table'				=> 'accidents'),
                        array(
                            'name'              => 'risks_id',
                            'description'       => 'Ризик',
                            'type'              => fldConst,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'value'				=> 11,
                            'table'				=> 'accidents'),
                        array(
                            'name'              => 'compromise',
                            'description'       => 'Компроміс',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents'),
						array(
                            'name'              => 'compromise_violation',
                            'description'       => 'Умови договри, що порушені',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents'),
						array(
                            'name'              => 'reason_not_payment',
                            'description'       => 'Критерії відмови в виплаті',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents'),
						array(
                            'name'              => 'compromise_date',
                            'description'       => 'Дата прийняття компромісного рішення',
                            'type'              => fldDate,
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
                            'table'             => 'accidents'),
						array(
                            'name'              => 'compromise_comment',
                            'description'       => 'Коментар, компроміс',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'description_average',
                            'description'       => 'Обставини',
                            'type'              => fldNote,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents'),
						array(
							'name'              => 'datetime_average',
							'description'       => 'Подія',
							'type'              => fldDateTime,
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
							'table'             => 'accidents'),
						array(
							'name'              => 'address_average',
							'description'       => 'Адреса',
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
							'table'            	=> 'accidents_cargo'),
						array(
							'name'             	=> 'description_average',
							'description'      	=> 'Обставини',
							'type'             	=> fldNote,
							'display'          	=>
								array(
									'show'     	=> false,
									'insert'   	=> true,
									'view'     	=> true,
									'update'   	=> true
								),
							'verification'     	=>
								array(
									'canBeEmpty'    => false
								),
							'table'            	=> 'accidents'),
						array(
							'name'              => 'mvs_average',
							'description'       => 'Орган куди звернувся',
							'type'              => fldRadio,
							'list'              => array(
													'0' => 'Нiкуди',
													'1' => 'Органи ДАІ',
													'2' => 'Органи МВС',
													'3' => 'МНС'),
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
							'table'             => 'accidents_cargo'),
						array(
							'name'              => 'mvs_id_average',
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
							'table'             => 'accidents_cargo',
							'sourceTable'       => 'mvs',
							'selectField'       => 'title',
							'orderField'        => 'title'),
						array(
							'name'              => 'mvs_title_average',
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
									'canBeEmpty'	=> true
								),
							'table'             => 'accidents_cargo'),
						array(
							'name'              => 'mvs_date_average',
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
							'table'             => 'accidents_cargo'),
                        array(
                            'name'              => 'insurance',
                            'description'       => 'Страховий випадок',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'reason',
                            'description'       => 'Згідно',
                            'type'              => fldNote,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'payments_id',
                            'description'       => 'Виплата',
                            'type'              => fldRadio,
							'list'				=> array(
													1 => 'СТО',
													2 => 'Банк',
													3 => 'Вигодонабувач'),
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents'),
						array(
							'name'              => 'criminal',
							'description'       => 'Кримінальна справа',
							'type'              => fldRadio,
							'list'				=> array(
														0 => 'не порушена',
														1 => 'порушена',
														2 => 'призупинена'),
							'display'           =>
								array(
									'show'      => false,
									'insert'    => false,
									'view'      => true,
									'update'    => true
								),
							'verification'      =>
								array(
									'canBeEmpty'	=> false
								),
							'table'             => 'accidents'),
						array(
							'name'              => 'regres',
							'description'       => 'Регрес',
							'type'              => fldBoolean,
							'display'           =>
								array(
									'show'      => false,
									'insert'    => false,
									'view'      => true,
									'update'    => true
								),
							'verification'      =>
								array(
									'canBeEmpty'	=> false
								),
							'table'             => 'accidents'),
                        array(
                            'name'              => 'accident_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents'),
						array(
							'name'              => 'carrier_brand',
							'description'       => 'Марка, модель перевізника',
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
									'canBeEmpty'	=> true
								),
							'table'             => 'accidents_cargo'),
						array(
							'name'              => 'carrier_sign',
							'description'       => 'Державний знак перевізника',
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
									'canBeEmpty'	=> true
								),
							'table'             => 'accidents_cargo'),
						array(
							'name'              => 'carrier',
							'description'       => 'Перевізник',
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
									'canBeEmpty'	=> true
								),
							'table'             => 'accidents_cargo'),
						array(
							'name'              => 'carrier_driver_lastname',
							'description'       => 'Прізвище водія',
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
									'canBeEmpty'	=> true
								),
							'table'             => 'accidents_cargo'),
						array(
							'name'              => 'carrier_driver_firstname',
							'description'       => 'Ім\'я водія',
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
									'canBeEmpty'	=> true
								),
							'table'             => 'accidents_cargo'),
						array(
							'name'              => 'carrier_driver_patronymicname',
							'description'       => 'По батькові водія',
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
									'canBeEmpty'	=> true
								),
							'table'             => 'accidents_cargo'),
						array(
							'name'              => 'carrier_owner',
							'description'       => 'Вдасник ТЗ',
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
									'canBeEmpty'	=> true
								),
							'table'             => 'accidents_cargo'),
						array(
							'name'              => 'carrier_owner_address',
							'description'       => 'Адреса власника ТЗ',
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
									'canBeEmpty'	=> true
								),
							'table'             => 'accidents_cargo'),
						array(
							'name'              => 'carrier_owner_phone',
							'description'       => 'Телефон власника ТЗ',
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
									'canBeEmpty'	=> true
								),
							'table'             => 'accidents_cargo'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents')
                    )
            );

    function Accidents_Cargo(&$data) {
        Accidents::Accidents($data);

        $this->messages['plural'] = 'Страхові справи';
        $this->messages['single'] = 'Страхова справа';

		$this->product_types_id = $data['product_types_id'] = PRODUCT_TYPES_CARGO_CERTIFICATE;
        $this->objectTitle = 'Accidents_Cargo';
		$this->formDescription['fields'][ $this->getFieldPositionByName('days') ]['name'] = 'getDays(' . PREFIX . '_accidents.id) as days';
        $this->formDescription['fields'][ $this->getFieldPositionByName('compensation') ]['name'] = 'getCompensation(' . PREFIX . '_accidents.id, ' . PREFIX . '_accidents.product_types_id) as compensation';
		
		$this->setPreviousStatusesSchema();
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='showCargo.php', $limit=true) {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

		$this->mode = 'update';

		$fields[] = 'do';
		$data['do'] = $this->object . '|show&show=cargo';

        $this->setTables('show');
        $this->setShowFields();

        $query =    'SELECT a.id, CONCAT(a.lastname, \' \', a.firstname) AS title ' .
                    'FROM ' . PREFIX . '_accounts as a ' .
                    'JOIN ' . PREFIX . '_account_groups_managers_assignments as b ON a.id = b.accounts_id AND account_groups_id = ' . ACCOUNT_GROUPS_AVERAGE . ' ' .
                    'ORDER BY title';
		$fields['average_managers'] = $db->getAssoc($query);
				
		$query =	'SELECT id, code, title, level ' .
					'FROM ' . PREFIX . '_car_services ' .
					'ORDER BY top, num_l';
		$fields['car_services'] = $db->getAssoc($query);

        if (intval($data['accidents_id'])) {
            $conditions[] = PREFIX . '_accidents.id <> ' . intval($data['accidents_id']);
        }

        switch ($Authorization->data['roles_id']) {
            case ROLES_MASTER:
                $fields[] = 'car_services_id';
                $data['car_services_id'] = $Authorization->data['car_services_id'];
                break;
            case ROLES_MANAGER:
                if (sizeof($Authorization->data['account_groups_id']) == 1 && in_array(ACCOUNT_GROUPS_SERVICE_DEPARTMENT, $Authorization->data['account_groups_id'])) {
                    $sql_get_accidents = 'SELECT id FROM ' . PREFIX . '_accidents HAVING isVisibleAccidentsServiceDepartment(' . PREFIX. '_accidents.id, ' . $Authorization->data['id'] . ') = 1';
                    $accidents = $db->getCol($sql_get_accidents);
                    if (is_array($accidents) && sizeof($accidents)) {
                        $conditions[] = PREFIX . '_accidents.id IN(' . implode(', ', $accidents) . ')';
                    } else {
                        $conditions[] = '0';
                    }
                }
                break;
        }

        if (is_array($data['average_managers_id'])) {
			$fields[] = 'average_managers_id';
			$conditions[] = 'average_managers_id IN(' . implode(', ', $data['average_managers_id']) . ')';
		}

		if (!is_array($data['archive_statuses_id'])) {
			$data['archive_statuses_id'] = array(0);
		}

		$fields[] = 'archive_statuses_id';
		$conditions[] = 'archive_statuses_id IN(' . implode(', ', $data['archive_statuses_id']) . ')';

		if (is_array($data['in_express']) && sizeof($data['in_express'])) {
			$fields[] = 'in_express';
			$conditions[] = 'in_express IN(' . implode(', ', $data['in_express']) . ')';
		}

        if ($data['number']) {
            $fields[] = 'number';
            $conditions[] = PREFIX . '_accidents.number LIKE ' . $db->quote($data['number'] . '%');
        }

		if ($data['sign']) {
            $fields[] = 'sign';
            $conditions[] =  'sign LIKE ' . $db->quote($data['sign'] . '%');
        }

        if($data['repair_classifications_id']){
            $fields[] = 'repair_classifications_id';
            $conditions[] = 'repair_classifications_id IN (' . implode(', ', $data['repair_classifications_id']) . ')';
        }

        if($data['shassi']){
            $fields[] = 'shassi';
            $conditions[] = 'shassi LIKE ' . $db->quote($data['shassi'] . '%');
        }

        if ($data['policies_number']) {
            $fields[] = 'policies_number';
            $conditions[] = PREFIX . '_policies.number LIKE ' . $db->quote($data['policies_number'] . '%');
        }

        if ($data['insurer']) {
            $fields[] = 'insurer';
            $conditions[] = PREFIX . '_policies.insurer LIKE ' . $db->quote($data['insurer'] . '%');
        }                                                                          

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(' . $this->tables[0] . '.created) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] =  'TO_DAYS(' . $this->tables[0] . '.created) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }

        if (intval($data['car_services_id'])) {
            $sql_get_accidents = 'SELECT id FROM ' . PREFIX . '_accidents WHERE product_types_id = ' . PRODUCT_TYPES_CARGO_CERTIFICATE . ' HAVING isVisibleAccidentsMaster(' . PREFIX. '_accidents.id, ' . $Authorization->data['id'] . ') > 0';
            $accidents = $db->getCol($sql_get_accidents);
            if (is_array($accidents) && sizeof($accidents)) {
                //$conditions[] = PREFIX . '_accidents.id IN(' . implode(', ', $accidents) . ')';
				$conditions[] = '(' . PREFIX . '_accidents.id IN(' . implode(', ', $accidents) . ') OR ' . PREFIX . '_accidents.calculation_car_services_id = ' . intval($data['car_services_id']) . ')';
            } else {
                //$conditions[] = PREFIX . '_accidents.car_services_id = ' . intval($data['car_services_id']);
				$conditions[] = '(' . PREFIX . '_accidents.car_services_id = ' . intval($data['car_services_id']) . ' OR ' . PREFIX . '_accidents.calculation_car_services_id = ' . intval($data['car_services_id']) . ')';
            }
        }

        if ($data['clients_id']) {
            $fields[] = 'clients_id';
            $conditions[] = PREFIX . '_accidents.policies_id IN(SELECT id FROM ' . PREFIX . '_policies WHERE clients_id = ' . intval($data['clients_id']) . ')';
        }

		if (intval($Authorization->data['companies_id'])) {
			$data['companies_id'] = array($Authorization->data['companies_id']);
		}

		if (!is_array($data['companies_id'])) {
			$data['companies_id'] = array(INSURANCE_COMPANIES_EXPRESS);
		}

		$fields[] = 'companies_id';
		$conditions[] = PREFIX . '_accidents.companies_id IN(' . implode(', ', $data['companies_id']) . ')';

        $conditions_or = array();//спец масив для определения доступа к делам для аваркомов и експертов
        if ($Authorization->data['roles_id'] == ROLES_MANAGER && $this->permissions['updateRisk'] && !$this->permissions['updateRiskAll'] && $this->permissions['updateActs'] && !$this->permissions['updateActsAll'] && !in_array($Authorization->data['id'], array(6560, 9725))) {
            //if(!$data['accidents_id']) {
				if ($this->permissions['updateClassification']) {
					$conditions_or[] = '(((average_managers_id IN(' . implode(', ', $Authorization->data['managers']) . ') OR average_managers_id = 0) AND ' . PREFIX . '_accidents.archive_statuses_id = 0) OR ' . PREFIX . '_accidents.archive_statuses_id = 1)';
				} else {
					$conditions_or[] = '(average_managers_id IN(' . implode(', ', $Authorization->data['managers']) . ') OR ' . PREFIX . '_accidents.archive_statuses_id = 1)';
				}
            //}
		}

		if ($Authorization->data['roles_id'] == ROLES_MANAGER && $this->permissions['updateEstimates'] && !intval($this->permissions['updateEstimatesAll'])) {
			$conditions_or[] = 'estimate_managers_id > 0';
		}

        if(sizeof($conditions_or) > 0) {
            $conditions[] = '('. implode(' OR ', $conditions_or) . ')';
        }

		if (is_array($data['accident_statuses_id'])) {
			$fields[] = 'accident_statuses_id';
			$conditions[] = 'accident_statuses_id IN(' . implode(', ', $data['accident_statuses_id']) . ')';
		}

		if (is_array($data['accident_sections_id'])) {
			$fields[] = 'accident_sections_id';
			$conditions[] = 'accident_sections_id IN(' . implode(', ', $data['accident_sections_id']) . ')';
		}

		$fields[] = 'product_types_id';
		$data['product_types_id'] = $this->product_types_id;

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

		$sql1 = 'SELECT insurance_accidents.id as id, insurance_accidents.number as number, date_format(insurance_accidents.date, \'%d.%m.%Y\') AS date_format, insurance_policies.number AS policies_number, ' .
					'insurance_policies_one_shipping.insurer_company as insurer_company, ' .
					'insurance_accidents.amount_rough, insurance_accidents.accident_sections_id as accident_sections_id,  insurance_accident_sections.title AS accident_sections_id_title, insurance_accidents.insurance as insurance, ' .
					'insurance_accidents.regres as regres, insurance_accidents.payment_statuses_id as payment_statuses_id, insurance_payment_statuses.title AS payment_statuses_id_title, ' .
					'getCompensation(insurance_accidents.id, insurance_accidents.product_types_id) as compensation, insurance_accidents.accident_statuses_id as accident_statuses_id, insurance_accident_statuses.title AS accident_statuses_id_title, ' .
					'insurance_accidents.master_documents as master_documents, insurance_accidents.avr_sign as avr_sign, ' .
					'date_format(insurance_accidents.modified, \'%d.%m.%Y\') AS modified_format, insurance_accidents.masters_id as masters_id, insurance_accounts.lastname AS masters_id_name, getDays(insurance_accidents.id) as days, ' .
					
					'insurance_accidents.policies_id as policies_id, insurance_policies.product_types_id as product_types_id, ' .
					'a.lastname AS average_manager, b.lastname AS estimate_manager, insurance_accident_sections.id AS sectionsId, ' .
					'getSummCarService(insurance_accidents.id, insurance_accidents.car_services_id) as summ_amount, insurance_accident_sections.title AS accident_sections_title, ' .
					'insurance_accidents.car_services_id as car_services_id, getStateInRepair(insurance_accidents.id) as in_repair, '.
					'IF(getMaxSetAccidentsStatusesDate(insurance_accidents.id, ' . ACCIDENT_STATUSES_CLOSED . ') IS NULL OR insurance_accidents.accident_statuses_id <> ' . ACCIDENT_STATUSES_CLOSED . ', TO_DAYS(NOW()) - TO_DAYS(insurance_accidents.date), TO_DAYS(getMaxSetAccidentsStatusesDate(insurance_accidents.id, ' . ACCIDENT_STATUSES_CLOSED . ')) - TO_DAYS(insurance_accidents.date)) AS accidents_days, ' .
					(($Authorization->data['roles_id'] == ROLES_MASTER) ? 'isVisibleAccidentsMaster(insurance_accidents.id, ' . intval($Authorization->data['id']) . ') as visible_like, ' : '') .
					'getDaysForExpress(insurance_accidents.id) as days_cl, insurance_clients.important_person as important_person, ' .
					
					'insurance_accidents.modified as modified, insurance_accidents.date as date ' .
					
				'FROM insurance_accidents ' .
				'JOIN insurance_accidents_cargo ON insurance_accidents.id = insurance_accidents_cargo.accidents_id ' .
				'JOIN insurance_policies ON insurance_accidents.policies_id = insurance_policies.id ' .
				'JOIN insurance_policies_one_shipping ON insurance_policies.id = insurance_policies_one_shipping.policies_id ' .
				'JOIN insurance_accident_statuses ON insurance_accidents.accident_statuses_id = insurance_accident_statuses.id ' .
				'JOIN insurance_accounts ON insurance_accidents.masters_id = insurance_accounts.id ' .
				'JOIN insurance_payment_statuses ON insurance_accidents.payment_statuses_id = insurance_payment_statuses.id ' .
                'LEFT JOIN insurance_clients ON insurance_policies.clients_id = insurance_clients.id ' .
				'LEFT JOIN insurance_accounts AS a ON insurance_accidents.average_managers_id = a.id ' .
				'LEFT JOIN insurance_accounts AS b ON insurance_accidents.estimate_managers_id = b.id ' .
				'LEFT JOIN insurance_accident_sections ON insurance_accidents.accident_sections_id = insurance_accident_sections.id ' .
				'WHERE (' . implode(' AND ', $conditions) . ' ' . ') ' ;
				//'ORDER BY ';

        $sql2 = 'SELECT ' . $this->getShowFieldsSQLString() . ',  ' . PREFIX . '_accidents.policies_id,  ' . PREFIX . '_policies.product_types_id, ' .
					'a.lastname AS average_manager, b.lastname AS estimate_manager, ' .  PREFIX . '_accident_sections.id AS sectionsId, ' .
                    'getSummCarService(' . PREFIX . '_accidents.id, ' . PREFIX . '_accidents.car_services_id) as summ_amount, ' .
					PREFIX . '_accident_sections.title AS accident_sections_title, ' .
                    PREFIX . '_accidents.car_services_id, getStateInRepair(' . PREFIX . '_accidents.id) as in_repair, ' .
                    'IF(getMaxSetAccidentsStatusesDate(' . PREFIX . '_accidents.id, ' . ACCIDENT_STATUSES_CLOSED . ') IS NULL OR ' . PREFIX . '_accidents.accident_statuses_id <> ' . ACCIDENT_STATUSES_CLOSED . ', TO_DAYS(NOW()) - TO_DAYS(' . PREFIX . '_accidents.date), TO_DAYS(getMaxSetAccidentsStatusesDate(' . PREFIX . '_accidents.id, ' . ACCIDENT_STATUSES_CLOSED . ')) - TO_DAYS(' . PREFIX . '_accidents.date)) AS accidents_days, ' .
                    (($Authorization->data['roles_id'] == ROLES_MASTER) ? 'isVisibleAccidentsMaster(' . PREFIX . '_accidents.id, ' . intval($Authorization->data['id']) . ') as visible_like, ' : '') .
                    'getDaysForExpress(' . PREFIX . '_accidents.id) as days_cl, ' . PREFIX . '_clients.important_person, ' .
					
					'insurance_accidents.modified as modified, insurance_accidents.date as date  ' .
					
				'FROM ' . PREFIX . '_accidents ' .
				'JOIN ' . PREFIX . '_accidents_cargo ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_cargo.accidents_id ' .
				'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
				'JOIN ' . PREFIX . '_policies_cargo ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_cargo.policies_id ' .
                'JOIN ' . PREFIX . '_policies_cargo_general ON ' . PREFIX . '_policies_cargo.policies_general_id = ' . PREFIX . '_policies_cargo_general.policies_id ' .
				'JOIN ' . PREFIX . '_policies_cargo_items ON ' . PREFIX . '_accidents_cargo.items_id = ' . PREFIX . '_policies_cargo_items.id ' .
				'JOIN ' . PREFIX . '_accident_statuses ON ' . PREFIX . '_accidents.accident_statuses_id = ' . PREFIX . '_accident_statuses.id ' .
				'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accidents.masters_id = ' . PREFIX . '_accounts.id ' .
				'JOIN ' . PREFIX . '_payment_statuses ON ' . PREFIX . '_accidents.payment_statuses_id = ' . PREFIX . '_payment_statuses.id ' .
                'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_policies.clients_id = ' . PREFIX . '_clients.id ' .
				'LEFT JOIN ' . PREFIX . '_accounts AS a ON ' . PREFIX . '_accidents.average_managers_id = a.id ' .
				'LEFT JOIN ' . PREFIX . '_accounts AS b ON ' . PREFIX . '_accidents.estimate_managers_id = b.id ' .
				'LEFT JOIN ' . PREFIX . '_accident_sections ON ' . PREFIX . '_accidents.accident_sections_id = ' . PREFIX . '_accident_sections.id ' .
                'WHERE (' . implode(' AND ', $conditions) . ' ' . ') ' ;
				//'ORDER BY ';
				
		$sql = 'SELECT u.id, u.number, u.date_format, u.policies_number, u.insurer_company, u.amount_rough, u.accident_sections_id_title as accident_sections_id, u.insurance, u.regres, u.payment_statuses_id_title as payment_statuses_id, ' .
					'u.compensation, u.accident_statuses_id_title as accident_statuses_id, u.master_documents, u.avr_sign, u.modified_format, u.masters_id_name as masters_id, u.days, u.policies_id, u.product_types_id, u.average_manager, u.estimate_manager, ' .
					'u.sectionsId, u.summ_amount, u.accident_sections_title, u.car_services_id, u.in_repair, u.accidents_days, u.days_cl, u.important_person ' .
					(($Authorization->data['roles_id'] == ROLES_MASTER) ? ', u.visible_like, ' : ',') .
					
					'u.modified, u.date ' .
					
				'FROM (' .
					$sql1 . ' UNION ' . $sql2 .
				') as u ' .
				'ORDER BY ';
//_dump($sql);
        $total = $db->getOne(transformToGetCount($sql));

		$order = str_replace('insurance_accidents', 'u', $this->getShowOrderCondition());
        //$sql .= $this->getShowOrderCondition();
		$sql .= $order;

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);

        //добавляем зеленые кружечки, если контрагент совпадает с местом заведения заявления
        foreach($list as $key=>$accident) {
            if($Authorization->data['roles_id'] != ROLES_MASTER && $accident['summ_amount'] > 0 && $accident['in_repair'] == 1) {
                $list[$key]['circle_label'] = 1;
            } elseif($Authorization->data['roles_id'] == ROLES_MASTER && $accident['visible_like'] == 2 && $accident['in_repair'] == 1) {
                $list[$key]['circle_label'] = 1;
            }
        }

		$sql =  'SELECT id, title, level - 1 AS level ' .
				'FROM ' . PREFIX . '_product_types ' .
				'ORDER BY num_l';
		$product_types = $db->getAll($sql, 24 * 60 * 60);

        $fields['accident_statuses_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('accident_statuses_id') ];
        $fields['accident_statuses_id']['list'] = $this->getListValue($fields['accident_statuses_id'], $data);
        $fields['accident_statuses_id']['object'] = $this->buildSelect($fields['accident_statuses_id'], $data['accident_statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data);

		$fields['companies_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('companies_id') ];
		$fields['companies_id']['list'] = $this->getListValue($fields['companies_id'], $data);
		$fields['companies_id']['object'] = $this->buildSelect($fields['companies_id'], $data['companies_id'], $data['languageCode'], 'multiple size="2"', null, $data);

        $fields['accident_sections_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('accident_sections_id') ];
        $fields['accident_sections_id']['list'] = $this->getListValue($fields['accident_sections_id'], $data);
        $fields['accident_sections_id']['object'] = $this->buildSelect($fields['accident_sections_id'], $data['accident_sections_id'], $data['languageCode'], 'multiple size="3"', null, $data);

		if ($Authorization->data['roles_id'] != ROLES_MASTER) {
			$sql =	'SELECT id, title, level - 1 AS level ' .
					'FROM ' . PREFIX . '_car_services ' .
					'ORDER BY num_l, title';
			$car_services = $db->getAll($sql, 60 * 60);
		}

        include 'Accidents/showCargo.php';
    }

    function getListValue($field, $data) {
        global $db, $Authorization;

		switch ($field['name']) {
            case 'mvs_id_average':
			case 'mvs_id':
				$sql =	'SELECT a.id, a.title, b.title AS regions_title ' .
						'FROM ' . PREFIX . '_mvs AS a ' .
						'JOIN  ' . PREFIX . '_regions AS b ON a.regions_id = b.id ' .
						'ORDER BY b.title, a.title';
				$list =	$db->getAll($sql, 30*60);

				if (is_array($list)) {
					foreach ($list as $row) {
						$options[ $row['id'] ] = array(
							'title'			=> $row['title'],
							'optgroup'		=> $row['regions_title'],
							'obligatory'	=> $row['obligatory']);
					}
				}
				break;
			case 'car_services_id':
				$sql = 'SELECT a.id, a.title, b.title AS regions_title ' .
						'FROM ' . PREFIX . '_car_services AS a ' .
						'JOIN  ' . PREFIX . '_regions AS b ON a.regions_id = b.id ' .
						'ORDER BY b.title, a.title';
				$list =	$db->getAll($sql, 30*60);
				if (is_array($list)) {
					foreach ($list as $row) {
						$options[ $row['id'] ] = array(
							'title'			=> $row['title'],
							'optgroup'		=> $row['regions_title'],
							'obligatory'	=> $row['obligatory']);
					}
				}
				break;
            case 'accident_statuses_id':
                 $field['condition'] =  'id IN (SELECT accident_statuses_id FROM ' . PREFIX . '_accident_statuses_descriptions WHERE product_types_id IN (1,' . $data['product_types_id']. ')) AND order_position <> 0';
                 $options = parent::getListValue($field, $data);

                break;
            case 'inspecting_account_id':
                    switch ($Authorization->data['roles_id']) {
                        case ROLES_MASTER:
						case ROLES_MANAGER:
                            $field['condition'] =  'id IN (SELECT accounts_id FROM ' . PREFIX . '_masters WHERE car_services_id =' .  intval($Authorization->data['car_services_id']) . ' )';
                            $options = parent::getListValue($field, $data);
                            break;
                    }
                break;
			default:
				$options = parent::getListValue($field, $data);
        }

        return $options;
    }

    function setConstants(&$data) {
    	global $Authorization;
		
        parent::setConstants($data);		

		//$data['managers_id'] = $this->getManagersId();

        if(empty($data['driver_licence_date_month'])) {
            $data['driver_licence_date_month']  = substr($data['driver_licence_date'],3,2);
        }

		switch ($Authorization->data['roles_id']) {
			case ROLES_MASTER:
				$data['car_services_id']     = $Authorization->data['car_services_id'];
				$data['masters_id']          = $Authorization->data['id'];
			break;
		}

        switch ($data['do']) {
            case $this->object . '|insert':
                switch ($Authorization->data['roles_id']) {
                    case ROLES_MASTER:
						$data['date_month']	= date('m');
						$data['date_day']	= date('d');
						$data['date_year']	= date('Y');
						break;
                }
            $data['avr_sign'] = 1; //по умолчанию платим мастеру за прием заявлений
            case $this->object . '|update':

		        $data['sign'] = fixSignSimbols($data['sign']);

                switch ($data['companies_id']){
                   case INSURANCE_COMPANIES_GENERALI:
                        $data['owner_regions_id']	= 1;
                        $data['accidents_cargo_id']	= 1;
                        $data['number']				= $data['policies_number'];
                        $data['date']				= $data['policies_date'];
                }

				switch ($data['application_risks_id']) {
					case RISKS_DTP:
						$data['consequences'] = array_sum($data['consequences']);
						break;
					default:
						$data['types_id'] = 0;
						$this->formDescription['fields'][ $this->getFieldPositionByName('types_id') ]['verification']['canBeEmpty'] = true;

						$data['consequences'] = 0;
						$this->formDescription['fields'][ $this->getFieldPositionByName('consequences') ]['verification']['canBeEmpty'] = true;
						break;
				}

				switch (intval($data['mvs'])) {
					case 0://Нiкуди					
						unset($data['mvs_id']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
						unset($data['mvs_title']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;

						unset($data['mvs_date_day']);
						unset($data['mvs_date_month']);
						unset($data['mvs_date_year']);

						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date') ]['verification']['canBeEmpty'] = true;
						break;
					case 1://Органи ДАІ
						unset($data['mvs_title']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
						
						break;
					default://Органи МВС или МНС
						unset($data['mvs_id']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
						break;						
				}

                if (intval($data['assistance'])) {

                    unset($data['assistance_reason']);
                    $this->formDescription['fields'][ $this->getFieldPositionByName('assistance_reason') ]['verification']['canBeEmpty'] = true;

					if (intval($data['assistance_place'])) {
						$data['assistance_date_day']	= $data['datetime_day'];
						$data['assistance_date_month']	= $data['datetime_month'];
						$data['assistance_date_year']	= $data['datetime_year'];
						$data['assistance_date']		= $data['datetime'];
					}
                } else {

                    unset($data['assistance_date_day']);
                    unset($data['assistance_date_month']);
                    unset($data['assistance_date_year']);

                    $this->formDescription['fields'][ $this->getFieldPositionByName('assistance_date') ]['verification']['canBeEmpty'] = true;
                }

                break;
			case $this->object . '|updateClassification':
				$this->formDescription['fields'][ $this->getFieldPositionByName('application_risks_id') ]['display']['update'] = false;
				break;
			case $this->object . '|updateRisk':

				$fields = array();
				
				if (!in_array($this->getAccidentStatusesId($data['id']), array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE))) {
					$this->formDescription['fields'][ $this->getFieldPositionByName('compromise') ]['display']['update'] = false;
					$this->formDescription['fields'][ $this->getFieldPositionByName('compromise_violation') ]['display']['update'] = false;
				}
				
				if ($data['compromise'] && empty($data['compromise_date'])) {
					$fields[] = 'payments_id';
					$fields[] = 'reason';
				}

				switch (intval($data['insurance'])) {
					case 1://страхова, з виплатою
						$fields[] = 'reason';
						break;
					case 2://страхова, без виплати
					case 3://не страхова
						$fields[] = 'payments_id';
						break;
				}

				switch (intval($data['mvs_average'])) {
					case 0://Нiкуди
						unset($data['mvs_id_average']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ]['verification']['canBeEmpty'] = true;
						unset($data['mvs_title_average']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title_average') ]['verification']['canBeEmpty'] = true;

						unset($data['mvs_date_average_day']);
						unset($data['mvs_date_average_month']);
						unset($data['mvs_date_average_year']);

						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date_average') ]['verification']['canBeEmpty'] = true;
						break;
					case 1://Органи ДАІ
						unset($data['mvs_title_average']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title_average') ]['verification']['canBeEmpty'] = true;
						
						break;
					default://Органи МВС или МНС
						unset($data['mvs_id_average']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ]['verification']['canBeEmpty'] = true;
						break;						
				}

				if (is_array($fields)) {
					foreach ($fields as $field) {
						unset( $data[ $field ] );
						$this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['verification']['canBeEmpty'] = true;
					}
				}
				break;
        }
    }

    function checkFields($data, $action) {
        global $Log;

		//проверяем заполнены ли поля Гарант Авто
        if($data['companies_id'] == INSURANCE_COMPANIES_GENERALI){
			$Policies = Policies::factory($data, 'Cargo');
            $Policies->setApplicationRequiredFields();
            $Policies->checkFields($data, $action);
        }

        parent::checkFields($data, $action);
		
        switch ($data['do']) {
            case $this->object . '|insert':
            case $this->object . '|update':

                /*if ((strtotime($data['datetime']) < strtotime($data['policies_begin_datetime_format'][$data['policies_id']]) || strtotime($data['datetime']) > strtotime($data['policies_interrupt_datetime_format'][$data['policies_id']])) && $data['count_items_id'] > 1) {
                    $Log->add('error', 'Дата настання страхового випадку не підпадає під строк дії договору.');
                }*/

                if (checkdate($data['datetime_month'], $data['datetime_day'], intval($data['datetime_year'])) &&
                    mktime() - mktime(0, 0, 0, $data['datetime_month'], $data['datetime_day'], $data['datetime_year']) < 0) {
                        $Log->add('error', 'Не вірно вказали дату настання страхового випадку.');
                } 

				//проверяем дату уведомления МВД, не меньше ли она даты события
				if (checkdate($data['mvs_date_month'], $data['mvs_date_day'], $data['mvs_date_year'])) {
					if (mktime(0, 0, 0, $data['datetime_month'], $data['datetime_day'], $data['datetime_year']) > mktime(0, 0, 0, $data['mvs_date_month'], $data['mvs_date_day'], $data['mvs_date_year'])) {
						$Log->add('error', '<b>Дата повідомлення</b> не може бути раніше <b>Дати події</b>.');
					}
				}

				//проверяем дату уведомления Ассистанса
                if (checkdate($data['assistance_date_month'], $data['assistance_date_day'], intval($data['assistance_date_year'])) &&
                    mktime() - mktime(0, 0, 0, $data['assistance_date_month'], $data['assistance_date_day'], $data['assistance_date_year']) < 0) {
                        $Log->add('error', 'Не вірно вказали дату повідомлення диспетчерського центра страховика.');
                }

				//проверяем дату заявления, не меньше ли она даты события
				if (checkdate($data['date_month'], $data['date_day'], $data['date_year'])) {
					if (mktime(0, 0, 0, $data['datetime_month'], $data['datetime_day'], $data['datetime_year']) > mktime(0, 0, 0, $data['date_month'], $data['date_day'], $data['date_year'])) {
						$Log->add('error', '<b>Дата заяви</b> не може бути раніше <b>Дати події</b>.');
					}
				}
                //проверка на вводимую дату наступления страхового события
                $this->dates_validate($data['datetime_year'],'<b>Дата настання пригоди</b> невірна');

                //проверка на вводимую дату выдачи прав
                if ($this->formDescription['fields'][ $this->getFieldPositionByName('driver_licence_date') ]['display']['update']) {
                    $this->dates_validate($data['driver_licence_date_year'],'<b>Дата водійських прав</b> невірна');
                }

                //проверка на вводимую дату сообщеня в диспетчерский центр
                if($data['assistance_date']){
                    //$this->dates_validate($data['assistance_date'],'<b>Дата повідомлення в диспетчерський центр</b> невірна');
                }

                break;
			case $this->object . '|updateClassification':
				if ($data['amount_rough'] != '' && intval($data['amount_rough']) <= 0) {
					$params = array($this->formDescription['fields'][ $this->getFieldPositionByName('amount_rough') ]['description'], null);
					$Log->add('error', 'The <b>%s</b>%s format is not valid.', $params);
				}
				if ($data['amount_rough'] > $this->getInsurancePrice($data)) {
					$Log->add('error', '<b>Орієнтовний збиток не може перевищувати страхову суму</b>. Страхова сума становить - <b>' . $this->getInsurancePrice($data) . ' грн.</b>', '%');
                }
				break;
			case $this->object . '|updateRisk':
				if (is_array($data['documents'])) {
					foreach ($data['documents'] as $document) {
						if (!intval($document['product_document_types_id'])) {
							$params = array('Тип документу', null);
							$Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
						}

						if (!intval($document['statuses_id'])) {
							$params = array('Статус', null);
							$Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
						} elseif (intval($document['statuses_id']) < intval($document['statuses_idOld'])) {
							$params = array('Статус', null);
							$Log->add('error', '<b>%s</b>%s не може бути зміненний на пепередній.', $params);
						}
					}
				}
				break;
        }
    }

	function getPoliciesValues($accidents_id) {
		global $db;
		
		//перевірка виду страхування
		$sql = 'SELECT b.product_types_id FROM '. PREFIX . '_accidents a JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id WHERE a.id = ' . intval($data['id']);
		$product_types_id = $db->getOne($sql);

		if ($product_types_id == PRODUCT_TYPES_CARGO_CERTIFICATE) {
		
			$sql =	'SELECT a.companies_id, a.policies_id, a.comment, a.monitoring_managers_id, '.
					'a.id, IF (c.product_types_id = ' . PRODUCT_TYPES_CARGO_CERTIFICATE . ', c.number, LEFT(c.number, LOCATE(\'-\', c.number) - 1)) AS policies_number, ' .
					'IF (c.product_types_id = ' . PRODUCT_TYPES_CARGO_CERTIFICATE . ', \'\', f.shassi) AS shassi, ' .
					'date_format(IF(c.product_types_id = ' . PRODUCT_TYPES_CARGO_CERTIFICATE . ', getPolicyDate(c.number, 2), c.begin_datetime), ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(IF(c.product_types_id = ' . PRODUCT_TYPES_CARGO_CERTIFICATE . ', getPolicyDate(c.number, 3), c.interrupt_datetime), ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, ' .
					'c.amount AS policies_amount, SUM(e.amount) AS policy_payments_amount ' .
					'FROM ' . PREFIX . '_accidents AS a ' .
					'JOIN ' . PREFIX . '_accidents_cargo AS b ON a.id = b.accidents_id ' .
					'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
					'JOIN ' . PREFIX . '_policies_cargo AS d ON a.policies_id = d.policies_id ' .
					'LEFT JOIN ' . PREFIX . '_policy_payments AS e ON a.policies_id = e.policies_id ' .
					'JOIN ' . PREFIX . '_policies_cargo_items as f ON b.items_id = f.id ' .
					'WHERE a.id = ' . intval($accidents_id);
		} else {
			
			$sql = 'SELECT a.companies_id, a.policies_id, a.comment, a.monitoring_managers_id, a.id, b.number as policies_number, date_format(b.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as policies_begin_datetime_format, date_format(b.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as policies_interrupt_datetime_format, ' .
						'b.amount as policies_amount, SUM(c.amount) AS policy_payments_amount ' .
					'FROM insurance_accidents a ' .
					'JOIN insurance_policies b ON a.policies_id = b.id ' .
					'LEFT JOIN insurance_policy_payments c ON b.id = c.policies_id ' .
					'WHERE a.id = ' . intval($accidents_id);
			
		}
		return $db->getRow($sql);
	}

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        switch ($_REQUEST['do']) {
            case $this->object . '|load':
            case $this->object . '|view':
                $sql =  'SELECT a.monitoring_managers_id, g.insurer as insurer_lastname, ' .
						    'e.number AS policies_number, e.date AS policies_date, date_format(e.date, ' . $db->quote('%Y') . ') AS policies_date_year, date_format(e.date, ' . $db->quote('%m') . ') AS policies_date_month, date_format(e.date, ' . $db->quote('%d') . ') AS policies_date_day ' .
						'FROM ' . PREFIX . '_accidents AS a ' .
                        'LEFT JOIN ' . PREFIX . '_accidents_cargo AS b ON a.id = b.accidents_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_cargo_items AS c ON a.policies_id = c.policies_id AND b.items_id = c.id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_cargo AS d ON a.policies_id = d.policies_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies AS e ON a.policies_id = e.id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_cargo_general AS f ON d.policies_general_id = f.policies_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies AS g ON f.policies_id = g.id ' .
                        'WHERE a.id = ' . intval($data['id']);
                $row =  $db->getRow($sql);

                $data = array_merge($data, $row);

                break;
			case $this->object . '|viewClassification':
			case $this->object . '|updateClassification':
                $data = array_merge($data, $this->getPoliciesValues($data['id']));
				break;
			case $this->object . '|viewRisk':
			case $this->object . '|updateRisk':
				$row = $this->getPoliciesValues($data['id']);

                $data = array_merge($data, $row);
				break;
        }

		$data['accidents_id'] = $data['id'];

        return $data;
    }

	function setAdditionalFields($id, $data, $init=false) {
		global $db;

		parent::setAdditionalFields($id, $data);

        //if($data['product_types_id'] == PRODUCT_TYPES_CARGO_CERTIFICATE)  $data['product_types_id'] = PRODUCT_TYPES_KASKO;

        $sql =	'SELECT date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, ' .
                'date_format(c.end_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_end_datetime_format ' .
                'FROM ' . PREFIX . '_accidents AS a ' .
                'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
                'WHERE a.id = ' . intval($data['id']);
        $row =  $db->getRow($sql);

        $data = array_merge($data, $row);

		if ($init) {
			$sql =	'UPDATE ' . PREFIX . '_accidents SET ' .
					'datetime_average = datetime, ' .
					'description_average = description ' .
					'WHERE id = ' . intval($id);
			$db->query($sql);

			$sql =	'UPDATE ' . PREFIX . '_accidents_cargo, ' . PREFIX . '_accidents SET ' .
					'address_average = address, ' .
					'mvs_average = mvs, ' .
					'mvs_id_average = mvs_id, ' .
					'mvs_title_average = mvs_title, ' .
					'mvs_date_average = mvs_date ' .
					'WHERE accidents_id = ' . intval($id) . ' AND id = ' . intval($id);
			$db->query($sql);

			//фиксируем данные по органам ГАИ
			if (intval($data['mvs_id']) && intval($data['mvs']) == 1) {
				$sql =	'UPDATE ' . PREFIX . '_accidents_cargo, ' . PREFIX . '_mvs SET ' .
						'mvs_title = title, ' .
						'mvs_title_average = title ' .
						'WHERE ' . PREFIX . '_accidents_cargo.mvs_id = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['id']);
				$db->query($sql);
			} else {
				$sql =	'UPDATE ' . PREFIX . '_accidents_cargo SET ' .
						'mvs_title_average = mvs_title ' .
						'WHERE accidents_id = ' . intval($data['id']);
				$db->query($sql);
			}
		} elseif (intval($data['mvs_id']) && intval($data['mvs']) == 1) {
			$sql =	'UPDATE ' . PREFIX . '_accidents_cargo, ' . PREFIX . '_mvs SET ' .
					'mvs_title = title ' .
					'WHERE ' . PREFIX . '_accidents_cargo.mvs_id = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['id']);
			$db->query($sql);
		}
	}

 	function getProductType() {
		return PRODUCT_TYPES_CARGO_CERTIFICATE;
	}

    function setNumber($data) {
        global $db;

        $sql = 'SELECT product_types_id ' .
               'FROM ' . PREFIX . '_policies ' .
               'WHERE id = ' . intval($data['policies_id']) ;
        $first_symbol = $db->getOne($sql);//находим тип продукта по полису для формирования номера дела, связано с пересечение "перегонов" с "КАСКО"

        $last_number = $this->getLastNumber($data['product_types_id']);//находим последний номер дела по типу продукта

        $sql = 'UPDATE ' . PREFIX . '_accidents AS a ' .
               'SET a.number = CONCAT(\'' . $first_symbol . '\', \'.\', date_format(a.created, \'%y\'), \'.\', ' . intval(intval($last_number+1)) . ') ' .
               'WHERE a.id = ' . intval($data['accidents_id']);
        $db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_accidents_last_numbers ' .
                'SET accidents_last_number = '. intval(intval($last_number+1)) . ' ' .
                'WHERE product_types_id = ' . intval($data['product_types_id']);
        $db->query($sql);
    }

    function insert($data) {
        global $Log, $Authorization;
        $data['step'] = 1;		

        $data['accidents_id'] = parent::insert(&$data, false, true);

        if ($data['accidents_id']) {

	       	$this->setNumber($data);

			$this->setAdditionalFields($data['accidents_id'], $data, true);

			$this->generateDocuments($data['accidents_id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_DECLARATION_CARGO, DOCUMENT_TYPES_ACCIDENT_FRONT_PAGE_CARGO), $data);

            $this->updateStep($data['accidents_id'], $data['step'] + 1);

			$AccidentStatusChanges = new AccidentStatusChanges($data);
			$AccidentStatusChanges->set($data['accidents_id']);

            $this->insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;">Справу створено:</label> <b>' . date("d.m.Y") . '</b>'));

            if (strtotime($data['datetime']) < strtotime($data['policies_begin_datetime_format'][$data['policies_id']]) || strtotime($data['datetime']) > strtotime($data['policies_interrupt_datetime_format'][$data['policies_id']])) {
                $this->insertAccidentsComment(array('ei' => true, 'accidents_id' => $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;"><b>Дата настання страхового випадку не підпадає під строк дії полісу</b></label>'));
            }

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

			$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
			
			if (!intval($data['application_accidents_id'])) {
				switch ($data['accident_statuses_id']) {
					case ACCIDENT_STATUSES_APPLICATION:
						header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|load&id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
						break;
					case ACCIDENT_STATUSES_CLASSIFICATION:
						header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
				}
				exit;
			}			
        }		
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template='cargoApplication.php') {
        global $db;

      	$this->checkPermissions('update', $data);

       	if ($data['accidents_id']) {
			$data['id'] = $data['accidents_id'];
       	} elseif (is_array($data['id'])) {
       		$data['id'] = $data['id'][0];
       	}
		
		$application = $data['application'];
		
		//перевірка виду страхування
		$sql = 'SELECT b.product_types_id FROM '. PREFIX . '_accidents a JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id WHERE a.id = ' . intval($data['id']);
		$product_types_id = $db->getOne($sql);

        $this->setTables('load');
        $this->getFormFields('update');

		/*if ($product_types_id == PRODUCT_TYPES_CARGO_CERTIFICATE) {*/
		
			$sql =  'SELECT ' . implode(', ', $this->formFields) . ', ' . PREFIX . '_accidents_cargo.accidents_id, accident_statuses_id, car_services_id, ' . PREFIX . '_accidents_cargo.items_id, description, mvs_id, ' . PREFIX . '_policies.price AS policies_price, ' .
							  PREFIX . '_policies.product_types_id, ' . PREFIX . '_clients.important_person '.
					'FROM ' . PREFIX . '_accidents ' .
					'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
					
					($product_types_id == PRODUCT_TYPES_CARGO_CERTIFICATE ?
						'JOIN ' . PREFIX . '_policies_cargo ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_cargo.policies_id ' :
						'JOIN ' . PREFIX . '_policies_one_shipping ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_one_shipping.policies_id '
					) .
					
					
					'LEFT JOIN ' . PREFIX . '_accidents_cargo ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_cargo.accidents_id ' .
					
					'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_clients.id = ' . PREFIX . '_policies.clients_id ' .
					'WHERE ' . PREFIX . '_accidents.id = ' . intval($data['id']);
		
		/*} else {
		
			$sql = 'SELECT insurance_accidents.id, insurance_accidents.product_types_id, insurance_accidents.companies_id, insurance_policies.number AS policies_number, insurance_accidents.number, insurance_accidents_cargo.items_id, ' .
						'insurance_accidents.applicant_lastname, insurance_accidents.applicant_firstname, insurance_accidents.applicant_patronymicname, insurance_accidents.applicant_regions_id, insurance_accidents.applicant_area, ' .
						'insurance_accidents.applicant_city, insurance_accidents.applicant_street_types_id, insurance_accidents.applicant_street, insurance_accidents.applicant_house, insurance_accidents.applicant_flat, insurance_accidents.applicant_phones, ' .
						'date_format(insurance_accidents.datetime, \'%d.%m.%Y %H:%i\') AS datetime_format, date_format(insurance_accidents.datetime, \'%Y\') AS datetime_year, date_format(insurance_accidents.datetime, \'%m\') AS datetime_month, ' .
						'date_format(insurance_accidents.datetime, \'%d\') AS datetime_day, date_format(insurance_accidents.datetime, \'%k\') AS datetime_hour, date_format(insurance_accidents.datetime, \'%i\') AS datetime_minute, ' .
						'insurance_accidents_cargo.address, insurance_accidents.description, insurance_accidents.damage, insurance_accidents.location, insurance_accidents.application_risks_id, insurance_accidents_cargo.mvs, insurance_accidents_cargo.mvs_id, ' .
						'insurance_accidents_cargo.mvs_title, insurance_accidents_cargo.inspecting_account_id, date_format(insurance_accidents_cargo.mvs_date, \'%d.%m.%Y\') AS mvs_date_format, ' .
						'date_format(insurance_accidents_cargo.mvs_date, \'%Y\') AS mvs_date_year, date_format(insurance_accidents_cargo.mvs_date, \'%m\') AS mvs_date_month, date_format(insurance_accidents_cargo.mvs_date, \'%d\') AS mvs_date_day, ' .
						'insurance_accidents.assistance, date_format(insurance_accidents.assistance_date, \'%d.%m.%Y\') AS assistance_date_format, date_format(insurance_accidents.assistance_date, \'%Y\') AS assistance_date_year, ' .
						'date_format(insurance_accidents.assistance_date, \'%m\') AS assistance_date_month, date_format(insurance_accidents.assistance_date, \'%d\') AS assistance_date_day, insurance_accidents.assistance_place, ' .
						'insurance_accidents.assistance_reason, insurance_accidents.documents, date_format(insurance_accidents.date, \'%d.%m.%Y\') AS date_format, date_format(insurance_accidents.date, \'%Y\') AS date_year, ' .
						'date_format(insurance_accidents.date, \'%m\') AS date_month, date_format(insurance_accidents.date, \'%d\') AS date_day, insurance_accidents.car_services_id, insurance_accidents.masters_id, insurance_accidents.comment, ' .
						'insurance_accidents.amount_rough, insurance_accidents.accident_sections_id, insurance_accidents.insurance, insurance_accidents.regres, insurance_accidents.payment_statuses_id, insurance_accidents.accident_statuses_id, ' .
						'insurance_accidents.master_documents, insurance_accidents.avr_sign, insurance_policies.product_types_id as policies_product_types_id, insurance_clients.important_person ' .
					'FROM insurance_accidents ' .
					'JOIN insurance_accidents_cargo ON insurance_accidents.id = insurance_accidents_cargo.accidents_id ' .
					'JOIN insurance_policies ON insurance_accidents.policies_id = insurance_policies.id ' .
					'LEFT JOIN insurance_clients ON insurance_clients.id = insurance_policies.clients_id ' .
					'WHERE insurance_accidents.id=' . intval($data['id']);
		
		}*/
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);

        if ($_REQUEST['do'] == $this->object . '|load') {
			switch ($data['accident_statuses_id']) {
				case ACCIDENT_STATUSES_APPLICATION:
					break;
				case ACCIDENT_STATUSES_CLASSIFICATION:
					if ($application == 1 || !$this->permissions['updateClassification']) break;
					if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Classification') {
						header('Location: /?do=' . $this->object . '|' . $this->mode . 'Classification&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_CARGO_CERTIFICATE);
						exit;
					}
					break;
				case ACCIDENT_STATUSES_INVESTIGATION:
				case ACCIDENT_STATUSES_REINVESTIGATION:
                case ACCIDENT_STATUSES_COMPROMISE_AGREEMENT:
				case ACCIDENT_STATUSES_DEFECTS:
					if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Risk') {
						header('Location: /?do=' . $this->object . '|' . $this->mode . 'Risk&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_CARGO_CERTIFICATE);
						exit;
					}
					break;
				case ACCIDENT_STATUSES_COORDINATION:
					if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Acts') {
						header('Location: /?do=' . $this->object . '|' . $this->mode . 'Acts&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_CARGO_CERTIFICATE);
						exit;
					}
					break;
			}
        }

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function showForm($data, $action, $actionType=null, $template='cargoApplication.php') {
        global $db, $Authorization, $ACCIDENT_STATUSES_SCHEMA;

        parent::showForm($data, $action, $actionType, $template);
    }

    function view($data, $conditions=null, $sql=null, $template='cargoApplication.php', $showForm=true) {
		global $db;
		
        if(is_array($data['id'])){
            $data['id'] = $data['id'][0];
        }

        if (intval($data['accidents_id'])) {
            $data['id'] = $data['accidents_id'];
        }
		
		//перевірка виду страхування
		$sql = 'SELECT b.product_types_id FROM '. PREFIX . '_accidents a JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id WHERE a.id = ' . intval($data['id']);
		$product_types_id = $db->getOne($sql);

		$this->setTables('view');
		$this->getFormFields('view');

		$identityField = $this->getIdentityField();

		/*if ($product_types_id == PRODUCT_TYPES_CARGO_CERTIFICATE) {*/

			$sql =	'SELECT ' . implode(', ', $this->formFields) . ', companies_id, ' . PREFIX . '_policies.product_types_id as policies_product_types_id, ' . PREFIX . '_clients.important_person, ' . PREFIX . '_accidents.product_types_id as product_types_id ' . 
					'FROM ' . PREFIX . '_accidents ' .
					'JOIN ' . PREFIX . '_accidents_cargo ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_cargo.accidents_id ' .
					'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
					
					($product_types_id == PRODUCT_TYPES_CARGO_CERTIFICATE ?
						'JOIN ' . PREFIX . '_policies_cargo ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_cargo.policies_id ' :
						'JOIN ' . PREFIX . '_policies_one_shipping ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_one_shipping.policies_id '
					) .
					
					($product_types_id == PRODUCT_TYPES_CARGO_CERTIFICATE ? 'JOIN ' . PREFIX . '_policies_cargo_items ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policies_cargo_items.policies_id AND ' . PREFIX . '_accidents_cargo.items_id = ' . PREFIX . '_policies_cargo_items.id ' : '') .
					
					'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_clients.id = ' . PREFIX . '_policies.clients_id ' .
					'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
		/*} else {
		
			$sql = 'SELECT insurance_accidents.id, insurance_accidents.product_types_id, insurance_accidents.companies_id, insurance_policies.number AS policies_number, insurance_accidents.number, insurance_accidents_cargo.items_id, ' .
						'insurance_accidents.applicant_lastname, insurance_accidents.applicant_firstname, insurance_accidents.applicant_patronymicname, insurance_accidents.applicant_regions_id, insurance_accidents.applicant_area, ' .
						'insurance_accidents.applicant_city, insurance_accidents.applicant_street_types_id, insurance_accidents.applicant_street, insurance_accidents.applicant_house, insurance_accidents.applicant_flat, insurance_accidents.applicant_phones, ' .
						'date_format(insurance_accidents.datetime, \'%d.%m.%Y %H:%i\') AS datetime_format, date_format(insurance_accidents.datetime, \'%Y\') AS datetime_year, date_format(insurance_accidents.datetime, \'%m\') AS datetime_month, ' .
						'date_format(insurance_accidents.datetime, \'%d\') AS datetime_day, date_format(insurance_accidents.datetime, \'%k\') AS datetime_hour, date_format(insurance_accidents.datetime, \'%i\') AS datetime_minute, ' .
						'insurance_accidents_cargo.address, insurance_accidents.description, insurance_accidents.damage, insurance_accidents.location, insurance_accidents.application_risks_id, insurance_accidents_cargo.mvs, insurance_accidents_cargo.mvs_id, ' .
						'insurance_accidents_cargo.mvs_title, insurance_accidents_cargo.inspecting_account_id, date_format(insurance_accidents_cargo.mvs_date, \'%d.%m.%Y\') AS mvs_date_format, ' .
						'date_format(insurance_accidents_cargo.mvs_date, \'%Y\') AS mvs_date_year, date_format(insurance_accidents_cargo.mvs_date, \'%m\') AS mvs_date_month, date_format(insurance_accidents_cargo.mvs_date, \'%d\') AS mvs_date_day, ' .
						'insurance_accidents.assistance, date_format(insurance_accidents.assistance_date, \'%d.%m.%Y\') AS assistance_date_format, date_format(insurance_accidents.assistance_date, \'%Y\') AS assistance_date_year, ' .
						'date_format(insurance_accidents.assistance_date, \'%m\') AS assistance_date_month, date_format(insurance_accidents.assistance_date, \'%d\') AS assistance_date_day, insurance_accidents.assistance_place, ' .
						'insurance_accidents.assistance_reason, insurance_accidents.documents, date_format(insurance_accidents.date, \'%d.%m.%Y\') AS date_format, date_format(insurance_accidents.date, \'%Y\') AS date_year, ' .
						'date_format(insurance_accidents.date, \'%m\') AS date_month, date_format(insurance_accidents.date, \'%d\') AS date_day, insurance_accidents.car_services_id, insurance_accidents.masters_id, insurance_accidents.comment, ' .
						'insurance_accidents.amount_rough, insurance_accidents.accident_sections_id, insurance_accidents.insurance, insurance_accidents.regres, insurance_accidents.payment_statuses_id, insurance_accidents.accident_statuses_id, ' .
						'insurance_accidents.master_documents, insurance_accidents.avr_sign, insurance_policies.product_types_id as policies_product_types_id, insurance_clients.important_person ' .
					'FROM insurance_accidents ' .
					'JOIN insurance_accidents_cargo ON insurance_accidents.id = insurance_accidents_cargo.accidents_id ' .
					'JOIN insurance_policies ON insurance_accidents.policies_id = insurance_policies.id ' .
					'LEFT JOIN insurance_clients ON insurance_clients.id = insurance_policies.clients_id ' .
					'WHERE insurance_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
		
		}*/

		return parent::view($data, null, $sql, $template, $showForm);
    }

    function update($data) {
        global $db, $Log;

        $data['step'] = 1;

        $data['accidents_id'] = parent::update(&$data, false, true);

        if ($data['accidents_id']) {

			if($this->getAccidentStatusesId($data['accidents_id']) == ACCIDENT_STATUSES_APPLICATION) {
				$this->setAdditionalFields($data['accidents_id'], $data, true);
			} else {
				$this->setAdditionalFields($data['accidents_id'], $data);
				
				/*$sql = 'SELECT IF(date_format(\'%Y-%m\', created) = date_format(\'%Y-%m\', date), 1, 0) as sign, created, date ' .
					   'FROM ' . PREFIX . '_accidents ' .
					   'WHERE id = ' . intval($data['accidetns_id']);
				$dates = $db->getRow($sql);
				
				if (!intval($dates['sign'])) {
					$Accidents = new Accidents($data);
					$Accidents->send($data['accidetns_id'], 'Accident. changeDateAnotherMonth', array('olddate' => $dates['created'], 'newdate' => $dates['date']));
				}*/
			}

			$this->generateDocuments($data['accidents_id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_DECLARATION_CARGO, DOCUMENT_TYPES_ACCIDENT_FRONT_PAGE_CARGO), $data);

            $this->updateStep($data['accidents_id'], $data['step'] + 1);

			$AccidentStatusChanges = new AccidentStatusChanges($data);
			$AccidentStatusChanges->set($data['accidents_id']);
         
            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

			if (!intval($data['application_accidents_id'])) {
				switch ($data['accident_statuses_id']) {
					case ACCIDENT_STATUSES_APPLICATION:

						header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|load&id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
						break;
					case ACCIDENT_STATUSES_CLASSIFICATION:
						$AccidentMessages = new AccidentMessages($data);
						$AccidentMessages->permissions['insert'] = true;
						$row = $this->getPoliciesValues($data['id']);
						$row['statuses_id']                 = ACCIDENT_MESSAGE_STATUSES_QUESTION;
						$row['message_types_id']            = ACCIDENT_MESSAGE_TYPES_ACCIDENT_NUMBER_CALL;
						$row['recipient_organizations_id']  = ACCOUNT_GROUPS_CONTACT_CENTER;
						$row['accidents_id'] = $data['id'];
						$AccidentMessages->insert($row,false);

						//Добавление записи в мониторинг при просрочке 3 дней на написание заявы
						$date_incident = date($data['datetime_year'].'-'.$data['datetime_month'].'-'.$data['datetime_day']);
						$date_statement = date($data['date_year'].'-'.$data['date_month'].'-'.$data['date_day']);
						$date_limit = date('Y-m-d', strtotime($date_incident.'+3 days'));
						if ($date_limit < $date_statement){
							$this->insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;"><b>Порушено 3-денний строк написання Заяви про подію</b></label>'));
						}
						//Подтверждаем все прикрепленные документы к делу
						$AccidentDocument = new AccidentDocuments($data);
						$documents_id = $AccidentDocument->getListId($data['accidents_id']);
						$AccidentDocument->setAdditionalFields($documents_id,$data);

						header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
						break;
					default:
						($this->permissions['updateClassification'])
							? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateClassification&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id'])
							: header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
						break;
				}

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				exit;
			}			
        }
    }

    function updateClassification($data) {
		global $Log, $db;
        
		$this->checkPermissions('updateClassification', $data);

        $this->formDescription = $this->classificationFormDescription;

        if ($_POST['do'] == $this->object . '|updateClassification') {
			$prev_accident_statuses_id = $this->getAccidentStatusesId($data['id']);
			$prev_amount_rough = $this->getAmountRough($data['id']);
			
			$data['accident_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;

			$this->permissions['update'] = $this->permissions['updateClassification'];

            if (Form::update($data, false, false)) {
				
				//если поменялся ориентировочный убыток - шлем письмо
				if($prev_accident_statuses_id != ACCIDENT_STATUSES_CLASSIFICATION && $prev_amount_rough != $data['amount_rough']) {
					$Accidents = new Accidents($data);
					$Accidents->send($data['id'], 'Accident. changeAmountRough', array('previous_amount_rough' => $prev_amount_rough, 'current_amount_rough' => $data['amount_rough']));
				}

				//формируем лист согласования
				$this->generateDocuments($data['id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_NOTE_AGREEMENT_CARGO), $data);
                
                //пишем коментарий в мониторинг
                $this->insertAccidentsComment(array('accidents_id'              => $data['id'],
                                                    'monitoring_managers_id'    => $data['average_managers_id'],
                                                    'setAccidentsMonitor'        => true));

                //отправляем письмо
                if($items_price['flag'] == 1 && (floatval($items_price['items_price']) >= ACCIDENT_ITEMS_PRICE_HIGH || (floatval($data['amount_rough']) >= ACCIDENT_AMOUNT_ROUGH && floatval($items_price['items_price']) >= ACCIDENT_ITEMS_PRICE_MIDDLE))) { //если страховая сумма больше 1 млн. грн. включительно или если ориентировочный убыток больше 100 тыс. грн. включительно и страховая сумма больше 150 тыс. грн, то шлем сообщение
                    $this->send($data['id'],'Accident. updateClassification');
                }
				
				AccidentMessages::setRecipientsIdAfterClassification($data);
              
                $this->updateStep($data['id'], 2);

				$AccidentStatusChanges = new AccidentStatusChanges($data);
				$AccidentStatusChanges->set($data['id']);

    			$params['title']    = $this->messages['single'];
				$params['id']       = $data['id'];
				$params['storage']  = $this->tables[0];

				$Log->add('confirm', 'Справу класифіковано.' , $params);

				($this->permissions['updateRisk'])
					? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateRisk&accidents_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'])
					: header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
				exit;
            }

            $data = $this->replaceSpecialChars($data, 'update');
        } else {
			$data = $this->load($data, false, 'updateClassification');
        }

        $data['policy_payments_calendar'] = $this->getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['product_types_id']);
        $data['accidents_date_values'] = $this->getAccidentsDateValues($data['accidents_id']);

		if ($data['application_risks_id'] == RISKS_HIJACKING1 && $this->getStatusesId($data['id']) == ACCIDENT_STATUSES_CLASSIFICATION) {
			$data['amount_rough'] = $this->getInsurancePrice($data) - $this->getDeductible($data, 1);
		}
		
        return $this->showForm($data, 'updateClassification', 'update', 'cargoClassification.php');
    }

    function viewClassification($data) {

		$this->checkPermissions('view', $data);

        if ($_POST['do'] == $this->object . '|viewClassification') {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewRisk&accidents_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
            exit;
        }

        $this->formDescription = $this->classificationFormDescription;

		$data['id'] = $data['accidents_id'];
        $data = $this->view($data, null, null, null, false);

        $data['important_person'] = $this->getImportantPerson($data['policies_id']);
        $data['policy_payments_calendar'] = $this->getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['product_types_id']);
        $data['accidents_date_values'] = $this->getAccidentsDateValues($data['accidents_id']);

		return $this->showForm($data, 'viewClassification', 'view', 'cargoClassification.php');
    }

    function updateRisk($data) {
		global $db, $Log;

        //устанавливаем ограничения для для редактирования актов при расмотрении
        $conditions_payment_statuses = array(
			PAYMENT_STATUSES_PARTIAL,
			PAYMENT_STATUSES_PAYED,
			PAYMENT_STATUSES_OVER);

        $conditions_statuses_acts = array(
			ACCIDENT_STATUSES_PAYMENT,
			ACCIDENT_STATUSES_RESOLVED,
			ACCIDENT_STATUSES_SUSPENDED);

		$this->checkPermissions('updateRisk', $data);

        $this->formDescription = $this->riskFormDescription;

        if ($_POST['do'] == $this->object . '|updateRisk') {           

            $accident_statuses_id = $this->getAccidentStatusesId($data['id']);
			$compromise = $this->checkCompromise($data['id'], 1);

            $data['accident_statuses_id'] = ($accident_statuses_id == ACCIDENT_STATUSES_REINVESTIGATION || $accident_statuses_id == ACCIDENT_STATUSES_COORDINATION || $accident_statuses_id == ACCIDENT_STATUSES_COMPROMISE_AGREEMENT || ACCIDENT_STATUSES_COMPROMISE_CONTINUE) ? $accident_statuses_id : ACCIDENT_STATUSES_INVESTIGATION;
			if (!isset($data['compromise_violation'])) {
				$data['compromise_violation'] = $data['compromise_violation_hidden'];
			}

			$this->permissions['update'] = $this->permissions['updateRisk'];

            if (Form::update($data, false, false)) {
			
				$data['accidents_id'] = $data['id'];

				if (intval($data['mvs_average']) == 1 && intval($data['mvs_id_average'])) {
					$sql =	'UPDATE ' . PREFIX . '_accidents_cargo, ' . PREFIX . '_mvs SET ' .
							'mvs_title_average = title ' .
							'WHERE ' . PREFIX . '_accidents_cargo.mvs_id_average = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['accidents_id']);
					$db->query($sql);
				}

                if (intval($data['policies_id']) != intval($data['policies_id_risk_list']) && intval($data['policies_id_risk_list'])) {
                    $this->changeAccidentsPolicy($data['accidents_id'], $data['policies_id_risk_list']);
                }
				
				//если компромис - генерируем письмо
				if (intval($data['compromise'])) {					
					$product_documents['generateDocuments'][] = DOCUMENT_TYPES_ACCIDENT_COMPROMISE_AGREEMENT_LETTER_CARGO;
				} else {
					$product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_COMPROMISE_AGREEMENT_LETTER_CARGO;
				}

				if (intval($data['insurance']) == 1) {

					//если уже имеются аткы не в оплате или в "врегульовано", то устанавливаем "випадок"
                    $sql =	'SELECT id ' .
                            'FROM ' . PREFIX . '_accidents_acts ' .
							'WHERE act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents_id = ' . intval($data['accidents_id']);
                    $data['id'] = $db->getCol($sql);

                    if (sizeOf($data['id'])) {
                        $sql =	'UPDATE ' . PREFIX . '_accidents_acts SET ' .
								'insurance = ' . intval($data['insurance']) . ' '.
								'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND payment_statuses_id NOT IN(' . implode(', ', $conditions_payment_statuses) . ')'. 'AND act_statuses_id NOT IN (' . implode(', ', $conditions_statuses_acts) . ')';
                        $db->query($sql);
                    }

					if (intval($data['mvs_id_average'])) {
						$product_documents['generateDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_GAI;
					} else {
						$product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_GAI;
					}

				} elseif (intval($data['insurance']) == 2 || intval($data['insurance']) == 3) {//если событие не страховое, добавляем акт минуя экспертную оценку

                    //если уже существуют акты по делу, то акт на отказ должен быть с буквой "О", для єтого нужно установить переменную "act_type"
                    $sql =	'SELECT id ' .
                        'FROM ' . PREFIX . '_accidents_acts ' .
                        'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND act_statuses_id IN (' . implode(', ', $conditions_statuses_acts) . ')';
                    $data['act_col'] = $db->getCol($sql);
                    if (sizeOf($data['act_col'])) {
                        $data['act_type'] = ACCIDENT_INSURANCE_ACT_TYPE_RETURN_AND_FAILURE;
                    }

                    //страховые акты которые будут изменены
					$sql =	'SELECT id ' .
							'FROM ' . PREFIX . '_accidents_acts ' .
							'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND payment_statuses_id NOT IN(' . implode(', ', $conditions_payment_statuses) . ')'. ' AND act_statuses_id NOT IN (' . implode(', ', $conditions_statuses_acts) . ')';
					$data['id'] = $db->getCol($sql);

					$AccidentActs = AccidentActs::factory($data, 'Cargo');

                    if ($data['accident_statuses_id'] != ACCIDENT_STATUSES_COORDINATION) {
					    $data['act_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;
                    } else {
                        $data['act_statuses_id'] = ACCIDENT_STATUSES_COORDINATION;
                    }

					$product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_GAI;
					$product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_BANK;
					
					if (is_array($data['id']) && sizeOf($data['id'])) {
                        foreach ($data['id'] as $id) {
							$data['id'] = $id;
							$data['updateRisk'] = 1;
							$AccidentActs->update($data, false);
                        }
					} else {
						//$AccidentActs->insert($data, false);
					}
					
					
				}

				foreach ($product_documents as $method => $product_document_types) {
					$this->$method($data['accidents_id'], 0, 0, 0, $product_document_types, $data);
				}

				//перегоняем акты дальше по статусу, если статус был по делу ошибка в класификации
				$sql =	'UPDATE ' . PREFIX . '_accidents_acts SET ' .
						'act_statuses_id = ' . ACCIDENT_STATUSES_INVESTIGATION . ' ' .
						'WHERE accidents_id = ' . $data['accidents_id'] . ' AND act_statuses_id = ' . ACCIDENT_STATUSES_REINVESTIGATION;
				$db->query($sql);

				$this->updateStep($data['id'], 3);

				if ($data['compromise'] && in_array($accident_statuses_id, array(ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_INVESTIGATION))) {
					if($data['compromise_violation'][1 - sizeof($data['compromise_violation'])] <> 2){
						if (empty($data['compromise_date'])) {
							$data['accident_statuses_id'] = ACCIDENT_STATUSES_COMPROMISE_AGREEMENT;
						} else {
							$data['accident_statuses_id'] = ACCIDENT_STATUSES_COMPROMISE_CONTINUE;
						}
					}
				} elseif ($data['compromise'] && $accident_statuses_id == ACCIDENT_STATUSES_COMPROMISE_AGREEMENT) {
					if (!empty($data['compromise_date']) && intval($data['compromise_failed'])) {
                        unset($_SERVER['HTTP_REFERER']);
                        $this->closeAccident(array('id' => $data['accidents_id'], 'permission' => true));
					} elseif(!empty($data['compromise_date'])) {
                        $data['accident_statuses_id'] = ACCIDENT_STATUSES_COMPROMISE_CONTINUE;
                    } else {
						$data['accident_statuses_id'] = ACCIDENT_STATUSES_COMPROMISE_AGREEMENT;
					}
				} elseif ($data['compromise'] && $accident_statuses_id == ACCIDENT_STATUSES_COMPROMISE_CONTINUE) {
					$data['accident_statuses_id'] = ACCIDENT_STATUSES_COMPROMISE_CONTINUE;                                                                              
				}
				if($data['compromise'] && in_array($accident_statuses_id, array(ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE)) && sizeof($data['compromise_violation']) == 1 && in_array(2, $data['compromise_violation'])){
					$data['accident_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;
				}

				if ($data['compromise'] != intval($compromise)) {                                                                        
					if (in_array($accident_statuses_id, array(ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE))) {
						$data['accident_statuses_id'] = ACCIDENT_STATUSES_REINVESTIGATION;
					}
				}

				$this->changeAccidentStatus($data['accidents_id'], $data['accident_statuses_id']);
				$AccidentStatusChanges = new AccidentStatusChanges($data);
				$AccidentStatusChanges->set($data['accidents_id']);

				$params['title']    = $this->messages['single'];
				$params['id']       = $data['accidents_id'];
				$params['storage']  = $this->tables[0];

				$Log->add('confirm', 'Ризик по справі було встановлено.', $params);

				if ($data['insurance']) {
					($this->permissions['updateActs'])
						? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateActs&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id'])
						: header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewActs&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
					exit;
				} else {
					($this->permissions['updateRisk'])
						? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateRisk&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id'])
						: header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewRisk&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
					exit;
				}
            }

            $data = $this->replaceSpecialChars($data, 'update');
        } else {
			$data = $this->load($data, false, 'updateRisk');

            if (!$data['description_average']) {
            	$data['description_average'] = $data['description'];
            }
        }

        $data['policy_payments_calendar'] = $this->getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['product_types_id']);
        $data['accidents_date_values'] = $this->getAccidentsDateValues($data['accidents_id']);
        $data['important_person'] = $this->getImportantPerson($data['policies_id']);
		$data['compromise_violation_list'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_compromise_violation WHERE product_types_id IN (0, 1, ' . PRODUCT_TYPES_CARGO_CERTIFICATE . ')');
		$data['reason_not_payment_insurance_2'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 1 AND product_types_id IN (1, 3)');
		$data['reason_not_payment_insurance_3'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 2 AND product_types_id IN (1, 3)');

        return $this->showForm($data, 'updateRisk', 'update', 'cargoRisk.php');
    }

    function viewRisk($data) {
		global $db;

		$this->checkPermissions('view', $data);

        if ($_POST['do'] == $this->object . '|viewRisk') {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewActs&accidents_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
            exit;
        }

        $this->formDescription = $this->riskFormDescription;

		$data['id'] = $data['accidents_id'];
        $data = $this->view($data, null, null, null, false);
		$data['risks'] = $this->getRisks($data['id']);

        $data['policy_payments_calendar'] = $this->getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['product_types_id']);
        $data['accidents_date_values'] = $this->getAccidentsDateValues($data['accidents_id']);

        $data['important_person'] = $this->getImportantPerson($data['policies_id']);
		$data['compromise_violation_list'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_compromise_violation WHERE product_types_id IN (0, 1, ' . PRODUCT_TYPES_CARGO_CERTIFICATE . ')');
		$data['reason_not_payment_insurance_2'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 1 AND product_types_id IN (1, 3)');
		$data['reason_not_payment_insurance_3'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 2 AND product_types_id IN (1, 3)');

        return $this->showForm($data, 'viewRisk', 'view', 'cargoRisk.php');
    }

    function updateActs($data) {

        $this->checkPermissions('updateActs', $data);

		$data['step'] = 5;

        $fields[]        = 'accidents_id';
        $conditions[]    = PREFIX . '_accidents_acts.accidents_id = ' . intval($data['accidents_id']);

        $data['accidents'] =& $this;

        $AccidentActs = AccidentActs::factory($data, 'Cargo');

        $this->objectTitle = $AccidentActs->objectTitle;

        $AccidentActs->show($data, $fields, $conditions, null, $AccidentActs->object . '/show.php');

        $this->updateStep($data['accidents_id'], 5);
    }

    function viewActs($data) {
		$data['step'] = 5;

        $fields[]        = 'accidents_id';
        $conditions[]    = PREFIX . '_accidents_acts.accidents_id = ' . intval($data['accidents_id']);

        $fields[]        = 'product_types_id';

        $data['accidents'] =& $this;

        $AccidentActs = AccidentActs::factory($data, 'Cargo');

        $this->objectTitle = $AccidentActs->objectTitle;

		$AccidentActs->permissions['insert']	= false;
		$AccidentActs->permissions['update']	= false;

        $AccidentActs->show($data, $fields, $conditions, null, $AccidentActs->object . '/show.php');
    }

    function deleteProcess(&$data, $i = 0, $folder=null) {
        global $db;

		echo '---';

		//удаляем страховые акты не доведенные до оплаты
        //$AccidentActs = AccidentActs::factory($data, 'Cargo');

		//получаем дела, которые нельзя удалять
        /*$sql =  'SELECT DISTINCT accidents_id ' .
				'FROM ' . $AccidentActs->tables[0] . ' ' .
				'WHERE accidents_id IN(' . implode(', ', $data['id']) . ') AND (payment_statuses_id <> ' . PAYMENT_STATUSES_NOT . ' OR act_statuses_id >= ' . ACCIDENT_STATUSES_COORDINATION . ')';
        $accidents = $db->getCol($sql);*/

		//$data['id'] = array_diff($data['id'], $accidents);

		if (is_array($data['id']) && sizeOf($data['id'])) {

			//удаляем документы
			$AccidentDocuments = new AccidentDocuments($data);

			$sql =	'SELECT id ' .
					'FROM ' . $AccidentDocuments->tables[0] . ' ' .
					'WHERE accidents_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentDocuments->delete($toDelete, false, false);

			//удаляем дополнительные расходы
			$AccidentPaymentsCalendar = new AccidentPaymentsCalendar($data);

			$sql =	'SELECT id ' .
					'FROM ' . $AccidentPaymentsCalendar->tables[0] . ' ' .
					'WHERE accidents_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentPaymentsCalendar->delete($toDelete, false, false);

			//удаляем акты
			/*$sql =	'SELECT id ' .
					'FROM ' . $AccidentActs->tables[0] . ' ' .
					'WHERE accidents_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentActs->delete($toDelete, false, false);*/

			$sql =  'DELETE ' .
					'FROM ' . PREFIX . '_accidents ' .
					'WHERE id IN(' . implode(', ', $data['id']) . ')';
			$db->query($sql);

			$this->tables = array(PREFIX . '_accidents');

            $AccidentPaymentsCalendar = new AccidentPaymentsCalendar($data);

			$sql =	'SELECT id ' .
					'FROM ' . $AccidentPaymentsCalendar->tables[0] . ' ' .
					'WHERE acts_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentPaymentsCalendar->delete($toDelete, false, false);

			return parent::deleteProcess($data, $i, $folder);
		}
    }

    function getSearchInWindow($data) {
        global $db, $Authorization;
		
		$sql = 'SELECT accidents_id FROM ' . PREFIX . '_accident_documents WHERE id = ' . intval($file['id']);		
		$policies_product_types_id = $this->getPoliciesProductTypesId($db->getOne($sql));

		if ($Authorization->data['roles_id'] == ROLES_MASTER) {
			$conditions[] = 'a.car_services_id IN(' . implode(', ', $Authorization->data['car_services']) . ')';
		}

        if (intval($data['accidents_id'])) {
//            $conditions[] = 'a.id = ' . intval($data['accidents_id']);
        }

        if ($data['policies_number']) {
            $conditions[] = 'c.number = ' . $db->quote($data['policies_number']);
        }

		if ($policies_product_types_id == PRODUCT_TYPES_CARGO_CERTIFICATE) {
			if ($data['insurer_lastname']) {
				$conditions[] = 'insurer_lastname = ' . $db->quote($data['insurer_lastname']);
			}

			if ($data['insurer_passport_series']) {
				$conditions[] = 'insurer_passport_series = ' . $db->quote($data['insurer_passport_series']);
			}

			if ($data['insurer_passport_number']) {
				$conditions[] = 'insurer_passport_number = ' . $db->quote($data['insurer_passport_number']);
			}

			if ($data['insurer_identification_code']) {
				$conditions[] = 'insurer_identification_code = ' . $db->quote($data['insurer_identification_code']);
			}

			if ($data['shassi']) {
				$conditions[] = 'shassi = ' . $db->quote($data['shassi']);
			}

			if ($data['sign']) {
				$conditions[] = 'sign = ' . $db->quote($data['sign']);
			}
		}

        if (!$conditions) {
            $result = 'Не задали жодного критерію пошуку.';
        } else {

			if ($policies_product_types_id == PRODUCT_TYPES_CARGO_CERTIFICATE) {
				$sql =	'SELECT a.id, a.number, c.number AS policies_number, ' .
						'date_format(c.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date_format, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, ' .
						'd.insurer_lastname, d.insurer_firstname, d.insurer_patronymicname, ' .
						'CONCAT(e.brand, \'/\', e.model) as item, e.shassi, e.sign ' .
						'FROM ' . PREFIX . '_accidents AS a  ' .
						'JOIN ' . PREFIX . '_accidents_cargo AS b ON a.id = b.accidents_id  ' .
						'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
						'JOIN ' . PREFIX . '_policies_cargo AS d ON a.policies_id = d.policies_id ' .
						'JOIN ' . PREFIX . '_policies_cargo_items AS e ON a.policies_id = e.policies_id AND b.items_id = e.id ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY c.begin_datetime DESC';
				$list = $db->getAll($sql);
			} else {
				$sql =	'SELECT a.id, a.number, c.number AS policies_number, ' .
						'date_format(c.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date_format, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, ' .
						'd.insurer_lastname, d.insurer_firstname, d.insurer_patronymicname ' .
						'FROM ' . PREFIX . '_accidents AS a  ' .
						'JOIN ' . PREFIX . '_accidents_cargo AS b ON a.id = b.accidents_id  ' .
						'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
						'JOIN ' . PREFIX . '_policies_one_shipping AS d ON a.policies_id = d.policies_id ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY c.begin_datetime DESC';
				$list = $db->getAll($sql);
			}

            $result =   '<table width="100%" cellpadding="0" cellspacing="0">' .
                            '<tr class="columns">' .
							'<td class="id">&nbsp;</td>' .
                            '<td>Страхувальник</td>' .
                            '<td>Номер</td>' .
                            '<td>Дата</td>' .
                            '<td>Автомобіль</td>' .
                            '<td>№ шасі (кузов, рама)</td>' .
                            '<td>Номер</td>' .
                            '<td>Початок</td>' .
                            '<td>Закінчення</td>' .
                            '<td>Справа</td>' .
                        '</tr>';

            switch (sizeOf($list)) {
                case 0:
                    $result .= '<tr><td colspan="9" align="center" style="color: red;">Згідно заданних критеріїв пошуку поліс не знайдено.</td></tr>';
                    $result .= '</table>';
                    break;
                default:

                    $i = 0;
                    while ($i < sizeOf($list)) {

                        $policies_number = $list[ $i ]['policies_number'];

                        $result .=  '<tr class="row' . (($i % 2 == 0) ? '1' : '0') .'">' .
										'<td align="center"><input type="radio" name="policies_number" value="' . $list[ $i ]['policies_number'] . '" ' . ( ($list[ $i ]['policies_number'] == $data['policies_number']) ? 'checked' : '') . ' /></td>' .
                                        '<td>' . $list[ $i ]['insurer_lastname'] . ' ' . $list[ $i ]['insurer_firstname'] . ' ' . $list[ $i ]['insurer_patronymicname'] . '</td>' .
                                        '<td>' . $list[ $i ]['policies_number'] . '</td>' .
                                        '<td>' . $list[ $i ]['policies_date_format'] . '</td>' .
                                        '<td>' . $list[ $i ]['item'] . '</td>' .
                                        '<td>' . $list[ $i ]['shassi'] . '</td>' .
                                        '<td>' . $list[ $i ]['sign'] . '</td>' .
                                        '<td>' . $list[ $i ]['policies_begin_datetime_format'] . '</td>' .
                                        '<td>' . $list[ $i ]['policies_interrupt_datetime_format'] . '</td>' .
                                        '<td><select id="accidents_id' . $list[ $i ]['policies_number'] . '" name="accidents_id[' . $list[ $i ]['policies_number'] . ']" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';

                        while($i < sizeOf($list) && $list[ $i ]['policies_number'] == $policies_number) {
							$result .= '<option value="' . $list[ $i ]['id'] . '" ' . (($list[ $i ]['id'] == $data['accidents_id'] ) ? 'selected' : '') . '>' . $list[ $i ]['number'] . '</option>';
                            $i++;
                        }

                        $result .=      '</select></td>'.
                                    '</tr>';
                        $i++;
                    }

                    $result .= '</table>';

                    break;
            }
        }

        echo $result;
    }

    function prepareValues($fields, $values) {
        global $REGIONS;

        foreach ($fields as $field) {
			switch ($field) {
				case 'policies_insurer_address':
                    $region = Regions::getTitle($values['policies_insurer_regions_id']);
					$street = $values['policies_insurer_street_types'] . ' ' . $values['policies_insurer_street'];
					$values[ $field ] = $region . (strlen($values['policies_insurer_area']) ? ', ' . $values['policies_insurer_area'] . ' р-он' : '') . (strlen($values['policies_insurer_city']) ? ', ' . $values['policies_insurer_city'] : '') .
						', ' . $street . (strlen($values['policies_insurer_house']) ? ', буд. ' . $values['policies_insurer_house'] : '') . (strlen($values['policies_insurer_flat']) ? ', кв. ' . $values['policies_insurer_flat'] : '') . (strlen($values['policies_insurer_phone']) ? ', тел. ' . $values['policies_insurer_phone'] : '');
                    break;
				case 'applicant_address':
                    $region = Regions::getTitle($values['applicant_regions_id']);
					$street = StreetTypes::getTitle($values['applicant_street_types_id']) . ' ' . $values['applicant_street'];
					$values[ $field ] = $region . (strlen($values['applicant_area']) ? ', ' . $values['applicant_area'] . ' р-он' : '') . (strlen($values['applicant_city']) ? ', ' . $values['applicant_city'] : '') .
						', ' . $street . (strlen($values['applicant_house']) ? ', буд. ' . $values['applicant_house'] : '') . (strlen($values['applicant_flat']) ? ', кв. ' . $values['applicant_flat'] : '') . (strlen($values['applicant_phones']) ? ', тел. ' . $values['applicant_phones'] : '');
                    break;
                case 'applicant_regions_title':
                    $values[ $field ] = Regions::getTitle($values['applicant_regions_id']);
                    break;
                case 'applicant_city':
					if (!in_array($values['applicant_regions_id'], $REGIONS)) {
                        $values[ $field ] = $values['applicant_city'];
                    }
                    break;
                case 'applicant_street':
                    $values[ 'applicant_street' ] =  StreetTypes::getTitle($values['applicant_street_types_id']) . ' ' . $values['applicant_street'];
                    break;
                case 'mvs':
                	switch ($values['mvs']) {
						case '0':
							$values[ $field ] = 'Нi';
							break;
						case '1':
						case '2':
						case '3':
							$values[ $field ] = 'Так, ' . $values['mvs_title'];
							break;
                	}
                	break;
                case 'mvs_average':
                	switch ($values['mvs_average']) {
						case '0':
							$values[ $field ] = 'Нi';
							break;
						case '1':
						case '2':
						case '3':
							$values[ $field ] = 'Так, ' . $values['mvs_title_average'];
							break;
                	}
                	break;
			}
        }

        return $values;
    }

    //выплаты по предыдущим событиям по договору, с учетом возможных допов
    function getAmountPrevious($id, $mode=0) {
        global $db, $Authorization;
		
		$sql = 'SELECT datetime ' . 
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE id = ' . intval($id);
		$accidents_datetime = $db->getOne($sql);
		
	    $sql = 'SELECT b.number ' .
               'FROM ' . PREFIX . '_accidents AS a ' .
               'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
               'WHERE a.id = ' . intval($id);
        $number = $db->getOne($sql);

        $sql = 'SELECT shassi ' .
               'FROM ' . PREFIX . '_policies_cargo_items as cargo_items ' .
               'JOIN ' . PREFIX . '_accidents_cargo as accidents_cargo ON cargo_items.id = accidents_cargo.items_id ' .
               'WHERE accidents_cargo.accidents_id = ' . intval($id);
        $shassi = $db->getOne($sql);

        $sql = 'SELECT id ' .
               'FROM ' . PREFIX . '_policies_cargo_items ' .
               'WHERE shassi = ' . $db->quote($shassi);
        $items_id = $db->getCol($sql);

        //$conditions[] = 'a.top = ' . $db->quote($top);
        $conditions[] = 'a.number = ' . $db->quote($number);
        $conditions[] = 'b.id < ' . intval($id);
        $conditions[] = 'c.act_statuses_id IN(' . ACCIDENT_STATUSES_PAYMENT . ', ' . ACCIDENT_STATUSES_RESOLVED . ')';
	    $conditions[] = (sizeof($items_id) > 0 ? 'e.items_id IN (' . implode(', ', $items_id) . ')' : 'e.items_id IN (0)');
        $conditions[] = 'd.not_proportionality <> 1';

        //$conditions[] = 'b1.id = ' . intval($id);
        $conditions[] = 'h.payment_date < ' . $db->quote($accidents_datetime);

		if ($mode == 0) {
			$sql = 'SELECT SUM(h.amount) ' .
				   'FROM ' . PREFIX . '_policies AS a ' .
				   'JOIN ' . PREFIX . '_accidents AS b ON a.id = b.policies_id ' .
				   'JOIN ' . PREFIX . '_accidents_acts AS c ON b.id = c.accidents_id ' .
				   'JOIN ' . PREFIX . '_accidents_cargo_acts AS d ON d.accidents_acts_id = c.id ' .
				   'JOIN ' . PREFIX . '_accidents_cargo as e ON b.id = e.accidents_id ' .
				   //'LEFT JOIN ' . PREFIX . '_accidents as b1 ON a.id = b1.policies_id ' .
				   'JOIN ' . PREFIX . '_policies_cargo as g ON a.id = g.policies_id ' .
				   'JOIN ' . PREFIX . '_accident_payments_calendar as h ON c.id = h.acts_id ' .
				   'WHERE IF(f.items_id IS NULL, \'1\', b.datetime BETWEEN f.date AND ADDDATE(f.date, INTERVAL 1 YEAR)) AND ' . implode(' AND ', $conditions);
		} elseif ($mode == 1) {
			$conditions[] = 'b1.id = ' . intval($id);
			$sql = 'SELECT SUM(h.amount) ' .
				   'FROM ' . PREFIX . '_policies AS a ' .
				   'JOIN ' . PREFIX . '_accidents AS b ON a.id = b.policies_id ' .
				   'JOIN ' . PREFIX . '_accidents_acts AS c ON b.id = c.accidents_id ' .
				   'JOIN ' . PREFIX . '_accidents_cargo_acts AS d ON d.accidents_acts_id = c.id ' .
				   'JOIN ' . PREFIX . '_accidents_cargo as e ON b.id = e.accidents_id ' .
				   'LEFT JOIN ' . PREFIX . '_accidents as b1 ON a.id = b1.policies_id ' .
				   'JOIN ' . PREFIX . '_policies_cargo as g ON a.id = g.policies_id ' .
				   'JOIN ' . PREFIX . '_accident_payments_calendar as h ON c.id = h.acts_id AND h.payment_date <> \'0000-00-00\' ' .
				   'WHERE IF(f.items_id IS NULL, \'1\', b.datetime BETWEEN f.date AND ADDDATE(f.date, INTERVAL 1 YEAR)) AND ' . implode(' AND ', $conditions);
		}
        return $db->getOne($sql);		
    }

    function getValues($file) {
        global $db, $Authorization;

		$sql = 'SELECT accidents_id FROM ' . PREFIX . '_accident_documents WHERE id = ' . intval($file['id']);		
		$policies_product_types_id = $this->getPoliciesProductTypesId($db->getOne($sql));

		if ($policies_product_types_id == PRODUCT_TYPES_CARGO_CERTIFICATE) {

			$sql =  'SELECT a.*, a.number AS accident_documents_number, a.created AS accident_documents_created, ' .
					'b.*, b.number AS accidents_number, b.date AS accidents_date, b.datetime AS accidents_datetime, b.datetime_average AS accidents_datetime_average, b.assistance as accidents_assistance, b.assistance_date AS accidents_assistance_date, b.risks_id, b.documents AS accidents_documents, b.comment as comment, b.insurance as accidents_insurance, ' .
					'c.*, c.mvs as accidents_cargo_mvs, b.amount_rough, ' .
					'd.*,d1.*, d1.amount as acts_amount, d1.created as acts_created, d.amount_details + d.amount_material + d.amount_work AS amount_vr, d1.documents AS acts_documents, ' .
					'u.number AS policies_number, u.date AS policies_date, u.begin_datetime AS begin_datetime, u.interrupt_datetime AS interrupt_datetime, f1.price AS policies_price, e.amount AS policy_amount, e.product_types_id as policies_product_types_id, e.product_types_id as product_types_id, ' .
					'u.clients_id as clients_id, ' .
					'e.id as certificates_id, e.number AS certificates_number, e.amount as certificates_amount, e.date as certificates_date, ' .
					'e.begin_datetime AS certificates_begin_datetime, ' .
					'e.interrupt_datetime AS certificates_interrupt_datetime, ' .
					'clients.lastname AS policies_insurer_lastname, clients.firstname AS policies_insurer_firstname, clients.patronymicname AS policies_insurer_patronymicname, clients.company AS policies_insurer_company, ' .
					'f.insurer_regions_id as policies_insurer_regions_id, f.insurer_city AS policies_insurer_city, f.insurer_area as policies_insurer_area, x.title as policies_insurer_street_types, f.insurer_street AS policies_insurer_street, f.insurer_house AS policies_insurer_house, f.insurer_flat AS policies_insurer_flat, f.insurer_phone AS policies_insurer_phone, ' .
					'f.owner_lastname AS policies_owner_lastname, f.owner_firstname AS policies_owner_firstname, f.owner_patronymicname AS policies_owner_patronymicname, f.owner_company AS policies_owner_company, ' .
					'f.assured AS policies_assured_title, f.deductibles_absolute as policies_deductibles_absolute, f.deductibles_value as policies_deductibles_value, ' .
					'f1.brand AS policies_brand, f1.model AS policies_model, f1.shassi AS policies_shassi, f1.brands_id as policies_brands_id, f.item_types_id, f.item_types_text, ' .
					'h.title AS risks_title, ' .
					'j.lastname AS masters_lastname, j.firstname AS masters_firstname, j.patronymicname AS masters_patronymicname, ' .
					'k.address AS mvs_address,' .
					'l.amount AS payments_calendar_amount,l.payment_types_id as payments_calendar_payment_types_id, l.basis AS payments_calendar_basis, l.number as payments_calendar_number, l.recipient AS payments_calendar_recipient, l.recipient_identification_code AS payments_calendar_recipient_identification_code, l.payment_bank_account AS payments_calendar_payment_bank_account, l.payment_bank AS payments_calendar_payment_bank, l.payment_bank_mfo AS payments_calendar_payment_bank_mfo, l.payment_bank_card_number AS payments_calendar_payment_bank_card_number, l.created as payments_calendar_created, ' .
					'm.title AS car_services_title, ' .
					'IF(a.acts_id <> 0, w.lastname, n.lastname) AS average_managers_lastname, IF(a.acts_id <> 0, w.firstname, n.firstname) AS average_managers_firstname, IF(a.acts_id <> 0, w.patronymicname, n.patronymicname) AS average_managers_patronymicname, ' .
					'w.lastname as authors_lastname, w.firstname as authors_firstname, w.email as authors_email, ' .
					'o.lastname AS expert_managers_lastname, o.firstname AS expert_managers_firstname, o.patronymicname AS expert_managers_patronymicname, ' .
					'p.title as sections_title, ' .
					'r.accounts_title AS accident_status_changes_accounts_title, MIN(r.created) as accident_status_changes_application_created, ' .
					'a.accidents_id, SUM(s.amount) AS policy_payments_amount, e.top as policies_top, ' .
					'd1.insurance AS acts_insurance ,d1.number AS acts_number, IF(a.acts_id = 0, a.modified, d1.date) as date, c.items_id as accidents_items_id, d1.created, ' .
					
					't.assured, d.amount_start ' .
					
					'FROM ' . PREFIX . '_accident_documents AS a ' .
					'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
					'JOIN ' . PREFIX . '_accidents_cargo AS c ON b.id = c.accidents_id ' .
					'LEFT JOIN ' . PREFIX . '_accidents_acts AS d1 ON a.acts_id = d1.id ' .
					'LEFT JOIN ' . PREFIX . '_accidents_cargo_acts AS d ON a.acts_id = d.accidents_acts_id ' .
					'JOIN ' . PREFIX . '_policies AS e ON b.policies_id = e.id ' .
					'JOIN ' . PREFIX . '_policies_cargo AS f ON b.policies_id = f.policies_id ' .
					'JOIN ' . PREFIX . '_policies_cargo_items AS f1 ON c.items_id = f1.id ' .
					'LEFT JOIN ' . PREFIX . '_parameters_risks AS h ON b.risks_id = h.id ' .
					'JOIN ' . PREFIX . '_accounts AS j ON b.masters_id = j.id ' .
					'LEFT JOIN ' . PREFIX . '_mvs AS k ON c.mvs_id = k.id ' .
					'LEFT JOIN ' . PREFIX . '_accident_payments_calendar AS l ON a.payments_calendar_id = l.id ' .
					'JOIN ' . PREFIX . '_car_services AS m ON b.car_services_id = m.id ' .
					'LEFT JOIN ' . PREFIX . '_accounts AS n ON b.average_managers_id = n.id ' .
					'LEFT JOIN ' . PREFIX . '_accounts AS o ON b.estimate_managers_id = o.id ' .
					'LEFT JOIN ' . PREFIX . '_accident_sections as p ON p.id = b.accident_sections_id ' .
					'LEFT JOIN ' . PREFIX . '_accident_status_changes as r ON b.id = r.accidents_id ' .
					'LEFT JOIN (SELECT SUM(amount) as amount,policies_id FROM ' . PREFIX . '_policy_payments GROUP BY policies_id) AS s ON e.id = s.policies_id ' .
					'LEFT JOIN ' . PREFIX . '_policies_cargo_general as t ON f.policies_general_id = t.policies_id ' .
					'LEFT JOIN ' . PREFIX . '_policies as u ON t.policies_id = u.id ' .
					'LEFT JOIN ' . PREFIX . '_accounts as w ON a.authors_id = w.id ' .
					'LEFT JOIN ' . PREFIX . '_street_types as x ON f.insurer_street_types_id = x.id ' .
					'LEFT JOIN (SELECT number, MIN(begin_datetime) as begin_datetime, MIN(date) as date  FROM ' . PREFIX . '_policies GROUP BY number) as y ON e.number = y.number ' .
					'LEFT JOIN ' . PREFIX . '_clients as clients ON e.clients_id = clients.id ' .
					'WHERE a.id = ' . intval($file['id']) . ' ' .
					'GROUP BY s.policies_id';
		} else {
			$sql =  'SELECT a.*, a.number AS accident_documents_number, a.created AS accident_documents_created, ' .
				'b.*, b.number AS accidents_number, b.date AS accidents_date, b.datetime AS accidents_datetime, b.datetime_average AS accidents_datetime_average, b.assistance as accidents_assistance, b.assistance_date AS accidents_assistance_date, b.risks_id, b.documents AS accidents_documents, b.comment as comment, b.insurance as accidents_insurance, ' .
				'c.*, c.mvs as accidents_cargo_mvs, b.amount_rough, ' .
				'd.*,d1.*, d1.amount as acts_amount, d1.created as acts_created, d.amount_details + d.amount_material + d.amount_work AS amount_vr, d1.documents AS acts_documents, ' .
				'e.number AS policies_number, e.date AS policies_date, e.begin_datetime AS begin_datetime, e.interrupt_datetime AS interrupt_datetime, e.price AS policies_price, e.amount AS policy_amount, e.product_types_id as policies_product_types_id, e.product_types_id as product_types_id, ' .
				'e.clients_id as clients_id, ' .
				'clients.lastname AS policies_insurer_lastname, clients.firstname AS policies_insurer_firstname, clients.patronymicname AS policies_insurer_patronymicname, clients.company AS policies_insurer_company, ' .
				'f.insurer_regions_id as policies_insurer_regions_id, f.insurer_city AS policies_insurer_city, f.insurer_area as policies_insurer_area, x.title as policies_insurer_street_types, f.insurer_street AS policies_insurer_street, f.insurer_house AS policies_insurer_house, f.insurer_flat AS policies_insurer_flat, f.insurer_phone AS policies_insurer_phone, ' .
				'f.insurer_lastname AS policies_insurer_lastname, f.insurer_firstname AS insurer_owner_firstname, f.insurer_patronymicname AS policies_insurer_patronymicname, f.insurer_company AS policies_insurer_company, ' .
				'f.assured_title AS policies_assured_title, f.deductible as policies_deductibles_value, ' .
				'f.cargo_name as policies_brand, f.insurer_person_types_id as policies_insurer_person_types_id, ' .
				'h.title AS risks_title, ' .
				'j.lastname AS masters_lastname, j.firstname AS masters_firstname, j.patronymicname AS masters_patronymicname, ' .
				'k.address AS mvs_address,' .
				'l.amount AS payments_calendar_amount,l.payment_types_id as payments_calendar_payment_types_id, l.basis AS payments_calendar_basis, l.number as payments_calendar_number, l.recipient AS payments_calendar_recipient, l.recipient_identification_code AS payments_calendar_recipient_identification_code, l.payment_bank_account AS payments_calendar_payment_bank_account, l.payment_bank AS payments_calendar_payment_bank, l.payment_bank_mfo AS payments_calendar_payment_bank_mfo, l.payment_bank_card_number AS payments_calendar_payment_bank_card_number, l.created as payments_calendar_created, ' .
        		'm.title AS car_services_title, ' .
				'IF(a.acts_id <> 0, w.lastname, n.lastname) AS average_managers_lastname, IF(a.acts_id <> 0, w.firstname, n.firstname) AS average_managers_firstname, IF(a.acts_id <> 0, w.patronymicname, n.patronymicname) AS average_managers_patronymicname, ' .
				'w.lastname as authors_lastname, w.firstname as authors_firstname, w.email as authors_email, ' .
				'o.lastname AS expert_managers_lastname, o.firstname AS expert_managers_firstname, o.patronymicname AS expert_managers_patronymicname, ' .
                'p.title as sections_title, ' .
                'r.accounts_title AS accident_status_changes_accounts_title, MIN(r.created) as accident_status_changes_application_created, ' .
                'a.accidents_id, SUM(s.amount) AS policy_payments_amount, e.top as policies_top, ' .
                'd1.insurance AS acts_insurance ,d1.number AS acts_number, IF(a.acts_id = 0, a.modified, d1.date) as date, c.items_id as accidents_items_id, d1.created, ' .
				
				'f.assured_title as assured, 100 as item_types_id, ' . 
				
				'b.product_types_id as product_types_id ' .
				
                'FROM ' . PREFIX . '_accident_documents AS a ' .
                'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
                'JOIN ' . PREFIX . '_accidents_cargo AS c ON b.id = c.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_acts AS d1 ON a.acts_id = d1.id ' .
				'LEFT JOIN ' . PREFIX . '_accidents_cargo_acts AS d ON a.acts_id = d.accidents_acts_id ' .
                'JOIN ' . PREFIX . '_policies AS e ON b.policies_id = e.id ' .
                'JOIN ' . PREFIX . '_policies_one_shipping AS f ON b.policies_id = f.policies_id ' .

                'LEFT JOIN ' . PREFIX . '_parameters_risks AS h ON b.risks_id = h.id ' .
                'JOIN ' . PREFIX . '_accounts AS j ON b.masters_id = j.id ' .
                'LEFT JOIN ' . PREFIX . '_mvs AS k ON c.mvs_id = k.id ' .
				'LEFT JOIN ' . PREFIX . '_accident_payments_calendar AS l ON a.payments_calendar_id = l.id ' .
                'JOIN ' . PREFIX . '_car_services AS m ON b.car_services_id = m.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS n ON b.average_managers_id = n.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS o ON b.estimate_managers_id = o.id ' .
                'LEFT JOIN ' . PREFIX . '_accident_sections as p ON p.id = b.accident_sections_id ' .
                'LEFT JOIN ' . PREFIX . '_accident_status_changes as r ON b.id = r.accidents_id ' .
                'LEFT JOIN (SELECT SUM(amount) as amount,policies_id FROM ' . PREFIX . '_policy_payments GROUP BY policies_id) AS s ON e.id = s.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_accounts as w ON a.authors_id = w.id ' .
                'LEFT JOIN ' . PREFIX . '_street_types as x ON f.insurer_street_types_id = x.id ' .
                'LEFT JOIN (SELECT number, MIN(begin_datetime) as begin_datetime, MIN(date) as date  FROM ' . PREFIX . '_policies GROUP BY number) as y ON e.number = y.number ' .
				'LEFT JOIN ' . PREFIX . '_clients as clients ON e.clients_id = clients.id ' .
                'WHERE a.id = ' . intval($file['id']) . ' ' .
				'GROUP BY s.policies_id';
		}
        $row = $db->getRow($sql);

        $params = unserialize($row['params']);
        foreach ($params as $key => $val) {
            $row[$key] = $val;
        }
		
		$sql = 'SELECT SUM(getCompensation(id, 9)) ' .
			   'FROM ' . PREFIX . '_accidents ' .
			   'WHERE policies_id = ' . intval($row['certificates_id']) . ' AND date < ' . $db->quote($row['accidents_date']);
		$row['amount_previous_accidents'] = floatval($db->getOne($sql));
		
		$sql = 'SELECT getCompensation(' . intval($row['accidents_id']) . ', 9)';
		$row['amount_previous_acts'] = floatval($db->getOne($sql)) - floatval($row['acts_amount']);

		if ($row['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_COMPROMISE_AGREEMENT_LETTER_CARGO) {
			
			$sql = 'SELECT GROUP_CONCAT(DISTINCT accidents.number SEPARATOR \', \') as accidents_list, SUM(getCompensation(accidents.id, 3)) as payments_amount ' .
				   'FROM ' . PREFIX . '_accidents as accidents ' .
				   'WHERE accidents.policies_id = ' . intval($row['certificates_id']) . ' AND accidents.number <> ' . $db->quote($row['accidents_number']);
			$row['certificates_previous_accidents'] = $db->getRow($sql);
			
			$sql = 'SELECT GROUP_CONCAT(DISTINCT CONCAT(policies.number, \' (\', date_format(policies.date, \'%d.%m.%Y\'), \')\') SEPARATOR \', \')' .
				   'FROM ' . PREFIX . '_policies as policies ' .
				   'WHERE policies.clients_id = ' . intval($row['clients_id']) . ' AND policies.product_types_id = 8 AND policies.number <> ' . $db->quote($row['policies_number']);
			$row['all_policies_insurer']['policies_list'] = $db->getOne($sql);
			
			$sql = 'SELECT SUM(payments.amount) ' .
				   'FROM ' . PREFIX . '_policies as policies ' .
				   'JOIN ' . PREFIX . '_policy_payments as payments ON policies.id = payments.policies_id ' .
				   'WHERE policies.clients_id = ' . intval($row['clients_id']) . ' AND policies.product_types_id = 8 AND policies.number <> ' . $db->quote($row['policies_number']);
			$other_policy_payments = floatval($db->getOne($sql));
			
			$sql = 'SELECT DISTINCT cargo.payments_id ' .
				   'FROM ' . PREFIX . '_policies_cargo as cargo ' .
				   'JOIN ' . PREFIX . '_policies as policies ON cargo.policies_id = policies.id ' .
				   'WHERE policies.clients_id = ' . intval($row['clients_id']) . ' AND policies.product_types_id = 9 AND policies.number <> ' . $db->quote($row['certificates_number']);
			$payments_idx = $db->getCol($sql);
			
			if (sizeOf($payments_idx) && is_array($payments_idx)) {
				$sql = 'SELECT SUM(amount) ' .
					   'FROM ' . PREFIX . '_policy_payments_calendar ' .
					   'WHERE id IN (' . implode(', ', $payments_idx) . ') AND statuses_id IN (3, 4)';
				$other_certificate_payments = floatval($db->getOne($sql));
			} else {
				$other_certificate_payments = 0.00;
			}			
			$row['other_policy_payments'] = $other_policy_payments + $other_certificate_payments;
			
			$sql = 'SELECT getCompensation(accidents.id, 9) ' .
				   'FROM ' . PREFIX . '_accidents as accidents ' .
				   'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
				   'WHERE policies.clients_id = ' . intval($row['clients_id']) . ' AND policies.product_types_id = 9 AND policies.number <> ' . $db->quote($row['certificates_number']);
			$row['payments_accidents_amount'] = floatval($db->getOne($sql));
			
			$sql = 'SELECT accidents.compromise_date, GROUP_CONCAT(compromise_violation.title SEPARATOR \', \') as compromise_violation_list ' .
				   'FROM ' . PREFIX . '_accidents as accidents ' .
				   'JOIN ' . PREFIX . '_accidents_compromise_violation as compromise_violation ON compromise_violation.value&accidents.compromise_violation <> 0 ' .
				   'WHERE accidents.id = ' . intval($row['accidents_id']);
			$row['compromise_info'] = $db->getRow($sql);
			
			if ($row['policies_deductibles_absolute'] == 1) {
				$row['compromise_deductibles'] = $row['policies_deductibles_value'];				
			} else {
				$row['compromise_deductibles'] = roundNumber($row['policies_deductibles_value'] * $row['policies_price'] / 100, 2);
			}
			
		}

        if (intval($row['acts_id'])) {

			if ($row['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_INSURANCE_ACT) {

                if($row['deductibles_change'] == 1) {
                    $row['deductibles_value'] = round(floatval($row['deductibles_amount'])/floatval($row['insurance_price'])*100, 2) . '%';
                }
                else {
                    $row['deductibles_value'] = ($row['policies_deductibles_absolute' . $deductible] == '0')
                        ? $row['policies_deductibles_value' . $deductible] . '%'
                        : getMoneyFormat($row['policies_deductibles_value' . $deductible]);
                }
                if($row['insurance'] != 1) {
                    $row['deductibles_value'] = ($row['policies_deductibles_absolute' . $deductible] == '0')
					? $row['deductibles_percent'] . '%'
					: getMoneyFormat($row['deductibles_percent']);
                }
			}

     		//грузим календарь платежей
			$sql =	'SELECT * ' .
					'FROM ' . PREFIX . '_accident_payments_calendar ' .
					'WHERE acts_id = ' . intval($row['acts_id']);
			$row['payments_calendar'] = $db->getAll($sql);

			$sql =  'SELECT b.title ' .
					'FROM ' . PREFIX . '_accident_act_document_type_assignments AS a ' .
					'JOIN ' . PREFIX . '_product_document_types AS b ON a.product_document_types_id = b.id ' .
					'WHERE a.acts_id = ' . intval($row['acts_id']) . ' ' .
					'ORDER BY b.title';
			$row['product_document_types'] = $db->getCol($sql);

			$row['documents'] = ($row['acts_documents']) ? array_merge($row['product_document_types'], explode($this->documentsDelimiter, $row['acts_documents'])) : $row['product_document_types'];

			if ($row['item_types_id'] == 2 || $row['item_types_id'] == 100) {
				$row['amount_start'] = $row['amount_vr'];
			}
        } else {

            $row['rough_part'] = round(($row['amount_rough']/$row['items_price']) * 100, 2); //для запиту в Банк

			//предыдушие дела по машине, без привязки к договору
	        $sql =  'SELECT b.number ' .
	                'FROM ' . PREFIX . '_policies_kasko_items AS a ' .
					'JOIN ' . PREFIX . '_accidents AS b ON a.policies_id = b.policies_id ' .
					'JOIN ' . PREFIX . '_accidents_kasko AS c ON b.id = c.accidents_id AND a.id = c.items_id ' .
	                'WHERE a.shassi = ' . $db->quote($row['policies_shassi']) . ' AND b.id < ' . intval($row['accidents_id']);
	        $row['accidents'] = $db->getAll($sql);

			$sql =  'SELECT b.id, b.title ' .
					'FROM ' . PREFIX . '_accident_document_type_assignments AS a ' .
					'JOIN ' . PREFIX . '_product_document_types AS b ON a.product_document_types_id = b.id ' .
					'WHERE a.accidents_id = ' . intval($row['accidents_id']) . ' ' .
					'ORDER BY b.title';
			$row['product_document_types'] = $db->getAssoc($sql, 30*60);

			//для отдельного вывода Дополнительных документов в шаблон Титулки
            $row['additional_documents'] = explode($this->documentsDelimiter, $row['accidents_documents']);
            //_dump($row['documents']);exit;
            //merge масива основных док. и дополнительных для вывода в "заяву"
            foreach($row['product_document_types'] as $product_document){
                $row['documents'][] = $product_document;
            }
            $row['documents'] = ($row['accidents_documents']) ? array_merge($row['documents'], explode($this->documentsDelimiter, $row['accidents_documents'])) : $row['documents'];
        }

        $row['payment_document_number'] = htmlspecialchars_decode($row['payment_document_number']);

		$fields = array(
        	'applicant_regions_title',
			'policies_insurer_address',
			'applicant_address',
            'applicant_city',
            'applicant_street',
			'mvs',
			'mvs_average');
		
		$row['item_types_id_title'] = array(
			1 => 'Автомобільні запчастини, масла, аксесуари',
			2 => 'Автомобілі',
			3 => 'Запчастини для автомобілів T-150',
			4 => 'Автомобільні запчастини',
			5 => 'Машинокомплекти',
			100 => $row['policies_brand']
		);

		if (strtotime(date('Y-m-d')) >= strtotime('2015-08-17') && strtotime(date('Y-m-d')) <= strtotime('2015-08-23')) {
			$row['director'] = 1;
		}
		
		
        return $this->prepareValues($fields, $row);
    }

	//реквизиты владельца, используется при создании/редактировании страхового акта
	function getEssentialOwnerInWindow($data) {
		global $db;

		$sql =	'SELECT b.* ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_policies_kasko AS b ON a.policies_id = b.policies_id ' .
				'WHERE a.id = ' . intval($data['id']);
		$row =	$db->getRow($sql, 60 * 60);

		switch ($row['owner_person_types_id']) {
			case 1://физ. лицо
				echo '{"recipient_types_id":"' . RECIPIENT_TYPES_OWNER . '","recipient":"' . addslashes(html_entity_decode($row['owner_lastname']  . ' ' . $row['owner_firstname'] . ' ' . $row['owner_patronymicname'])) . '","recipient_identification_code":"' . $row['owner_identification_code'] . '","bank":"","bank_edrpou":"","bank_mfo":"","bank_account":""}';
				break;
			case 2://юр. лицо
				echo '{"recipient_types_id":"' . RECIPIENT_TYPES_OWNER . '","recipient":"' . addslashes(html_entity_decode($row['owner_company'])) . '","recipient_identification_code":"' . $row['owner_edrpou'] . '","bank":"' . addslashes(html_entity_decode($row['owner_bank'])) . '","bank_edrpou":"","bank_mfo":"' . $row['owner_bank_mfo'] . '","bank_account":"' . $row['owner_bank_account'] . '"}';
				break;
		}
		exit;
	}

	//реквизиты выгодоприобритателя, используется при создании/редактировании страхового акта
	function getEssentialAssuredInWindow($data) {
		global $db;

		$sql =	'SELECT b.*, 2 as insurer_person_types_id ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_policies_cargo AS b ON a.policies_id = b.policies_id ' .
				//'LEFT JOIN ' . PREFIX . '_financial_institutions AS c ON b.financial_institutions_id = c.id ' .
				'WHERE a.id = ' . intval($data['id']);
		$row =	$db->getRow($sql, 60 * 60);

		switch (intval($row['insurer_person_types_id'])) {
			case 1://физ. лицо
				echo '{"recipient_types_id":"' . RECIPIENT_TYPES_ASSURED . '","recipients_id":"' . intval($row['financial_institutions_id']) . '","recipient":"' . addslashes(html_entity_decode($row['insurer_lastname'] . ' ' . $row['insurer_firstname'] . ' ' . $row['insurer_patronymicname'])) . '","recipient_identification_code":"' . $row['insurer_identification_code'] . '","bank":"' . addslashes(html_entity_decode($row['bank_title'])) . '","bank_edrpou":"' . $row['bank_edrpou'] . '","bank_mfo":"' . $row['bank_mfo'] . '","bank_account":""}';
				break;
			case 2://юр. лицо
				echo '{"recipient_types_id":"' . RECIPIENT_TYPES_ASSURED . '","recipients_id":"' . intval($row['financial_institutions_id']) . '","recipient":"' . addslashes(html_entity_decode($row['insurer_company'])) . '","recipient_identification_code":"' . $row['insurer_edrpou'] . '","bank":"' . addslashes(html_entity_decode($row['bank_title'])) . '","bank_edrpou":"' . $row['bank_edrpou'] . '","bank_mfo":"' . $row['bank_mfo'] . '","bank_account":""}';
				break;
		}

		exit;
	}

	//выгружаем информацию по договору в бухгалтерию
	function getXML($data) {
		global $db, $Smarty;

		if ($data['number']) {
            $conditions[] = 'b.number=' . $db->quote($data['number']);
        } else {
            $conditions[] = ($data['from']) ? 'TO_DAYS(b.modified ) >= TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(b.modified ) >= TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(b.modified ) <= TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(b.modified ) <= TO_DAYS(NOW())';
            $conditions[] = 'b.accident_statuses_id = ' . ACCIDENT_STATUSES_PAYMENT;
        }

        $sql =  'SELECT b.*, b.documents AS accidents_documents, c.*, b.number AS number, e.product_types_id, ' .
				'c.*, b.number AS number, e.product_types_id, ' .
				'IF(pd1.product_types_id=10 AND pd1.sub_number>0,CONCAT(pd1.number,\'_\',pd1.sub_number), e.number) AS policies_number, e.date AS policies_date, e.begin_datetime AS begin_datetime, e.end_datetime AS end_datetime,e.amount AS policy_amount, e.price AS policy_price,e.rate AS policy_rate,' .
				'f.insurer_person_types_id AS policies_insurer_person_types_id, f.insurer_lastname AS policies_insurer_lastname, f.insurer_firstname AS policies_insurer_firstname, f.insurer_patronymicname AS policies_insurer_patronymicname, f.insurer_identification_code AS policies_insurer_identification_code, f.insurer_company AS policies_insurer_company, f.insurer_edrpou AS policies_insurer_edrpou, ' .
				'f.insurer_city AS policies_insurer_city, f.insurer_street AS policies_insurer_street, f.insurer_house AS policies_insurer_house, f.insurer_flat AS policies_insurer_flat, f.insurer_phone AS policies_insurer_phone, ' .
				'f.owner_person_types_id AS policies_owner_person_types_id, f.owner_lastname AS policies_owner_lastname, f.owner_firstname AS policies_owner_firstname, f.owner_patronymicname AS policies_owner_patronymicname, f.owner_identification_code AS policies_owner_identification_code, f.owner_company AS policies_owner_company, f.owner_edrpou AS policies_owner_edrpou, ' .
				'f.assured_title AS policies_assured_title, f.assured_address AS policies_assured_address, f.assured_identification_code AS policies_assured_identification_code, ' .
				'f1.brand AS policies_brand, f1.model AS policies_model,f1.year as policies_year, f1.sign AS policies_sign, f1.shassi AS policies_shassi, f1.car_price AS items_price, ' .
				'f1.deductibles_value0, f1.deductibles_absolute0, f1.deductibles_value1, f1.deductibles_absolute1, ' .
				'h.title AS risks_title, ' .
				'j.lastname AS masters_lastname, j.firstname AS masters_firstname, j.patronymicname AS masters_patronymicname, ' .
				'k.address AS mvs_address, ' .
        		'm.title AS car_services_title, ' .
				'n.lastname AS average_managers_lastname, n.firstname AS average_managers_firstname, n.patronymicname AS average_managers_patronymicname, ' .
				'o.lastname AS expert_managers_lastname, o.firstname AS expert_managers_firstname, o.patronymicname AS expert_managers_patronymicname, ' .
				'b.date AS accidents_date, b.created AS accidents_date, b.datetime as accidents_datetime,b.datetime as application_date ' .
                'FROM  ' . PREFIX . '_accidents AS b   ' .
                'JOIN ' . PREFIX . '_accidents_kasko AS c ON b.id = c.accidents_id ' .
                'JOIN ' . PREFIX . '_policies AS e ON b.policies_id = e.id ' .
                'JOIN ' . PREFIX . '_policies_kasko AS f ON f.policies_id = e.id ' .
				'JOIN ' . PREFIX . '_policies_kasko_items AS f1 ON c.items_id = f1.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_risks AS h ON b.risks_id = h.id ' .
                'JOIN ' . PREFIX . '_accounts AS j ON b.masters_id = j.id ' .
                'LEFT JOIN ' . PREFIX . '_mvs AS k ON c.mvs_id = k.id ' .
                'JOIN ' . PREFIX . '_car_services AS m ON b.car_services_id = m.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS n ON b.average_managers_id = n.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS o ON b.estimate_managers_id = o.id ' .
				'LEFT JOIN ' . PREFIX . '_policies_drive pd ON pd.policies_id=b.policies_id '.
				'LEFT JOIN ' . PREFIX . '_policies pd1 ON pd.policies_general_id=pd1.id '.
                'WHERE ' . implode(' AND ', $conditions) . ' ' ;
		$list = $db->getAll($sql);

	    $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/kasko.xml');
	}
	
	function getInsurancePrice($data) {
		global $db;
		
		if ($this->getPoliciesProductTypesId($data['id']) == PRODUCT_TYPES_CARGO_CERTIFICATE) {
		
			$sql =  'SELECT cargo_items.price AS policies_price ' .
					'FROM ' . PREFIX . '_accidents AS accidents ' .
					'JOIN ' . PREFIX . '_accidents_cargo AS accidents_cargo ON accidents.id = accidents_cargo.accidents_id ' .
					'JOIN ' . PREFIX . '_policies_cargo_items AS cargo_items ON accidents_cargo.items_id = cargo_items.id ' .
					'WHERE accidents.id = ' . intval($data['id']);
		} else {
			
			$sql = 'SELECT a.price ' .
				   'FROM ' . PREFIX . '_policies a ' .
				   'JOIN ' . PREFIX . '_accidents b ON a.id = b.policies_id ' .
				   'WHERE b.id = ' . intval($data['id']);
			
		}
        return $db->getOne($sql);
	}
	
	function backPreviousStatusesInWindow($data) {
		global $db, $Authorization;
		
		$current_accident_statuses_id = $this->getAccidentStatusesId($data['accidents_id']);
		$current_accident_statuses_title = $this->getAccidentStatusesTitle($current_accident_statuses_id);
		$new_accident_statuses_id = $data['accident_statuses_id'];
		$new_accident_statuses_title = $this->getAccidentStatusesTitle($data['accident_statuses_id']);
		
		$sql = 'UPDATE ' . PREFIX . '_accidents ' .
		       'SET accident_statuses_id = ' . intval($data['accident_statuses_id']) . ' ' .
			   'WHERE id = ' . intval($data['accidents_id']);
		$db->query($sql);
		
		//switch ($current_accident_statuses_id) {
			//case ACCIDENT_STATUSES_COORDINATION:
				$sql = 'UPDATE ' . PREFIX . '_accidents_acts ' .
					   'SET act_statuses_id = ' . (in_array($new_accident_statuses_id, array(ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE)) ? ACCIDENT_STATUSES_INVESTIGATION : intval($new_accident_statuses_id)) . ' ' .
							(in_array($new_accident_statuses_id, array(ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE, ACCIDENT_STATUSES_APPROVAL, ACCIDENT_STATUSES_COORDINATION)) ? ', date = \'0000-00-00\' ' : '') .
					   'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND act_statuses_id = ' . intval($current_accident_statuses_id);
				$db->query($sql);
				//break;
		//}
		
		$sql = 'DELETE FROM ' . PREFIX . '_accident_status_changes ' .
			   'WHERE accidents_id = ' . intval($data['accidents_id']) . ' ' .
			   'ORDER BY created DESC ' .
			   'LIMIT 3';
		$db->query($sql);
		
		$sql =	'INSERT INTO ' . PREFIX . '_accident_status_changes SET ' .
					'accidents_id = ' . intval($data['accidents_id']) . ', ' .
					'accident_statuses_id = ' . intval($data['accident_statuses_id']) . ', ' .
					'accounts_id = ' . intval($data['accounts_id']) . ', ' .
					'accounts_title = ' . $db->quote($data['accounts_title']) . ', ' .
					'duration = ' . intval($data['duration']) . ', ' .
					'created = ' . $db->quote($data['created']);
		$db->query($sql);
		
		$authors_title = $Authorization->data['lastname'] .' '. $Authorization->data['firstname'];
		$authors_id = intval($Authorization->data['id']);
        $monitoring_managers_yes = 0;
        $text = 'перевів справу зі статусу <b>"' . $current_accident_statuses_title . '"</b> в статус <b>"' . $new_accident_statuses_title . '"</b>';

        $sql = 'INSERT INTO ' . PREFIX . '_accident_comments SET ' .
					'accidents_id               = ' . intval($data['accidents_id']) . ', ' .
					'authors_id                 = ' . $db->quote($authors_id) . ', ' .
				'authors_title              = ' . $db->quote($authors_title) . ', ' .
				'text                       = ' . $db->quote($text) . ', ' .
				'monitoring_managers_yes    = ' . intval($monitoring_managers_yes) . ', ' .
				'created                    = NOW()';
         $db->query($sql);
	}
	
	function getItemsId($id) {
		global $db;
		
		$sql = 'SELECT items_id ' .
			   'FROM ' . PREFIX . '_accidents_cargo ' .
			   'WHERE accidents_id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function setPreviousStatusesSchema() {
		global $Authorization;
		
		if ($Authorization->data['id'] == 1 || in_array(25, $Authorization->data['account_groups_id'])) {
			$this->previousStatusesSchema[ACCIDENT_STATUSES_APPROVAL] = array(ACCIDENT_STATUSES_COORDINATION, ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE);
			$this->previousStatusesSchema[ACCIDENT_STATUSES_PAYMENT] = array(ACCIDENT_STATUSES_APPROVAL);
			$this->previousStatusesSchema[ACCIDENT_STATUSES_RESOLVED] = array(ACCIDENT_STATUSES_APPROVAL);
		}
	}
	
	function getDocumentTypes($data) {
		global $db;

        $conditions[] = 'product_types_id in ( ' . PRODUCT_TYPES_CARGO_CERTIFICATE . ', 1)';
        $conditions[] = 'id <> ' . DOCUMENT_TYPES_ACCIDENT_INSURANCE_ACT;

		if ($data['step'] == 1) {
			$conditions[] = 'declaration & 1';
		}

        $sql =  'SELECT id, title ' .
				'FROM ' . PREFIX . '_product_document_types ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY title';
        $list =  $db->getAll($sql);

        $result = '';
        if (is_array($list)) {
			$result = '<table>';
            foreach ($list as $i => $row) {
                $result .=  '<tr><td><input type="checkbox" name="product_document_types[]" value="' . $row['id'] . '" ' . (in_array($row['id'], $data['product_document_types']) ? 'checked' : '') . ' ' . $this->getReadonly(true) . ' /></td><td>' . $row['title'] . '</tr>';
            }
			$result .= '</table>';
        }

		return $result;
	}
	
	function getPoliciesProductTypesId($id) {
		global $db;

		$sql = 'SELECT b.product_types_id FROM '. PREFIX . '_accidents a JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id WHERE a.id = ' . intval($id);
		return $db->getOne($sql);
	}
	
}

?>