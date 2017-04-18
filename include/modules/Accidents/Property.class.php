<?
/*
 * Title: accident Property class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';
require_once 'AccidentStatusChanges.class.php';
require_once 'AccidentMessages.class.php';

class Accidents_Property extends Accidents {

	var $product_types_id = PRODUCT_TYPES_PROPERTY;

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
						'name'                  => 'product_types_id',
						'description'           => 'Тип продукту',
						'type'                  =>  fldHidden,
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
                            'name'              => 'policies_id',
                            'description'       => 'Поліс, id',
                            'type'              => fldInteger,
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
							//'withoutTable'		=> true,
                            'table'             => 'accidents'),
                        array(
                            //'name'              => 'CONCAT(insurer_lastname, \' \', insurer_firstname) AS insurer',
							'name'              => 'IF(insurer_person_types_id = 2, insurer_company, CONCAT(insurer_lastname, \' \', insurer_firstname)) AS insurer',
                            'description'       => 'Страхувальник, ПІБ',
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
							'withoutTable'		=> true,
							'orderName'			=> 'insurer',
							'orderPosition'		=> 4,
                            'table'				=> 'accidents'),
                        array(
                            'name'              => 'objects_id',
                            'description'       => 'Об\'єкт страхування',
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
                            'table'             => 'accidents_property'),
                        array(
                            'name'              => 'items_id',
                            'description'       => 'Майно',
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
                            'table'             => 'accidents_property'),
                        array(
                            'name'              => 'title as item',
                            'description'       => 'Застраховане майно',
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
                            'orderPosition'     => 6,
                            'table'             => 'policies_property_objects_items'),
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
                            'orderPosition'     => 9,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'policies_id',
                            'description'       => 'Поліс',
                            'type'              => fldHidden,
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
                            'table'             => 'accidents',
                            'sourceTable'       => 'policies',
                            'selectField'       => 'id',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'accident_sections_id',
                            'description'       => 'Категорія',
                            'type'              => fldSelect,
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
                            'orderPosition'     => 10,
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
                            'orderPosition'     => 11,
                            'table'             => 'accidents'),
                        /*array(
                            'name'              => 'managers_id',
                            'description'       => 'Менеджер',
                            'type'              => fldHidden,
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
                            'table'             => 'accidents',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'id'),*/
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
                            'orderPosition'     => 12,
                            'table'             => 'accidents'),
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
                            'orderPosition'     => 14,
                            'table'             => 'accidents',
                            'sourceTable'       => 'payment_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
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
                            'orderPosition'     => 15,
                            'table'             => 'accidents',
                            'sourceTable'       => 'accident_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        /*array(
                            'name'              => 'victim_damage',
                            'description'       => 'Опис пошкоджень майна постраждалого:',
                            'type'              => fldText,
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
                            'table'            => 'accidents_property'),*/
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
                            'orderPosition'     => 17,
                            'table'             => 'accidents',
                            'sourceTable'       => 'accounts',
							'selectId'			=> 'id',
                            'selectField'       => 'lastname',
                            'orderField'        => 'lastname'),
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
                            'orderPosition'     => 16,
                            'width'             => 100,
                            'table'             => 'accidents'),
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
                            'orderPosition'     => 18,
                            'table'             => 'accidents'),
                       /* array(
                            'name'              => 'applicant_brand',
                            'description'       => 'Заявник, Марка ТЗ ',
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
                            'table'            => 'accidents_property'),
                         array(
                            'name'              => 'applicant_model',
                            'description'       => 'Заявник, Модель ТЗ',
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
                            'table'            => 'accidents_property'),
                        array(
                            'name'              => 'applicant_shassi',
                            'description'       => 'Заявник, № шасі(кузов, рама)',
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
                            'table'            => 'accidents_property'),*/
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
                            'table'            => 'accidents_property'),
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
                            'description'      => 'Місцезнаходження ТЗ',
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
                            'table'            => 'accidents'),
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
                            'table'            => 'accidents'),
                        array(
                            'name'             => 'consequences',
                            'description'      => 'Ступінь тяжкості наслідків',
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
                            'table'            => 'accidents'),
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
                            'table'             => 'accidents')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 16,
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
                        /*array(
                            'name'              => 'managers_id',
                            'description'       => 'Менеджер',
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
                                    'canBeEmpty'	=> false
                                ),
                            'table'            	=> 'accidents'),*/
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
                         /*array(
                            'name'             => 'property_types_id',
                            'description'      => 'Тип пошкодженого майна',
                            'type'             => fldNote,
                            'list'              => array(
													'1' => 'Транспортний засіб',
													'2' => 'Майно, крім ТЗ'),
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
                            'table'            => 'accidents_property'),*/
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
                        /*array(
                            'name'              => 'expert_organizations_id',
                            'description'       => 'Експертна організація',
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
                                    'canBeEmpty'	=> true
                                ),
                            'table'            	=> 'accidents_property',
                            'sourceTable'       => 'expert_organizations',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),*/
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
                        /*array(
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
                            'table'            	=> 'accidents'),*/
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
                            'type'              => fldRadio,
                            'value'             => RISKS_DTP,
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
							'table'            	=> 'accidents_property'),
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

    function Accidents_Property(&$data) {

        Accidents::Accidents($data);

        $this->messages['plural'] = 'Страхові справи, Майно';
        $this->messages['single'] = 'Страхова справа, Майно';

		$this->product_types_id = $data['product_types_id'] = PRODUCT_TYPES_PROPERTY;
        $this->product_title = $data['product_title'] = 'Property';
        $this->objectTitle = 'Accidents_Property';
		//$this->formDescription['fields'][ $this->getFieldPositionByName('days') ]['name'] = 'TO_DAYS(IF(' . PREFIX . '_accidents.accident_statuses_id IN (' . ACCIDENT_STATUSES_INVESTIGATION . ', ' . ACCIDENT_STATUSES_REINVESTIGATION . '), NOW(), "")) - TO_DAYS(IF(g.count_all = k.count_status2, k.max_decision, IF(count_all IS NULL, n.max_created_status4, ""))) as days';
		$this->formDescription['fields'][ $this->getFieldPositionByName('days') ]['name'] = 'getDays(' . PREFIX . '_accidents.id) as days';
		$this->formDescription['fields'][ $this->getFieldPositionByName('compensation') ]['name'] = 'getCompensation(' . PREFIX . '_accidents.id, ' . PREFIX . '_accidents.product_types_id) as compensation';
    }

     function getRowClass($row, $i) {
        global $db;

        $result = parent::getRowClass($row, $i);

		if ($row['days'] >= 2 && $row['days'] < 4) {
            $result .= ' green';
        } elseif($row['days'] >= 4  && $row['days'] < 6 ) {
            $result .= ' yellow';
		} elseif($row['days'] >= 6){
            $result .= ' red';
        }

        return $result;
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='showProperty.php', $limit=true) {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

		$this->mode = 'update';

		$fields[] = 'do';
		$data['do'] = $this->object . '|show&show=property';

        $this->setTables('show');
        $this->setShowFields();

        $query ='SELECT a.id, CONCAT(a.lastname, \' \', a.firstname) AS title ' .
				'FROM ' . PREFIX . '_accounts as a ' .
				'JOIN ' . PREFIX . '_account_groups_managers_assignments as b ON a.id = b.accounts_id AND account_groups_id = ' . ACCOUNT_GROUPS_AVERAGE . ' ' .
				'ORDER BY title';
		$fields['average_managers'] = $db->getAll($query);

        if (intval($data['accidents_id'])) {
            $conditions[] = PREFIX . '_accidents.id <> ' . intval($data['accidents_id']);
        }

        switch ($Authorization->data['roles_id']) {
            case ROLES_MASTER:
                $fields[] = 'car_services_id';
                $data['car_services_id'] = $Authorization->data['car_services_id'];
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
		$conditions[] = 'archive_statuses_id IN (' . implode(', ', $data['archive_statuses_id']) . ')';

        if ($data['number']) {
            $fields[] = 'number';
            $conditions[] = PREFIX . '_accidents.number LIKE ' . $db->quote($data['number'] . '%');
        }

		if ($data['sign']) {
            $fields[] = 'sign';
            $conditions[] =  'sign LIKE ' . $db->quote($data['sign'] . '%');
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
            $conditions[] = '(' . PREFIX . '_policies_.insurer_lastname LIKE ' . $db->quote('%' . $data['insurer'] . '%') . ')';
        }

        if ($data['applicant']) {
            $fields[] = 'applicant';
            $conditions[] = '(' . PREFIX . '_accidents.applicant_lastname LIKE ' . $db->quote('%' . $data['applicant'] . '%') . ')';
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
            $CarServices = new CarServices($data);
            $car_services_id = array($data['car_services_id']);
            $CarServices->getSubId(&$car_services_id, $data['car_services_id']);

            $conditions[] = '(' . $this->tables[0] . '.car_services_id IN(' . implode(', ', $car_services_id) . ') OR ' . PREFIX . '_accidents.calculation_car_services_id = ' . intval($data['car_services_id']) . ')';
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

        if (is_array($data['applicant_types_id'])) {
			$fields[] = 'applicant_types_id';
			$conditions[] = 'applicant_types_id IN (' . implode(', ', $data['applicant_types_id']) . ')';
		}

        if ($Authorization->data['roles_id'] == ROLES_MANAGER && $this->permissions['updateRisk'] && !$this->permissions['updateRiskAll'] && $this->permissions['updateActs'] && !$this->permissions['updateActsAll']) {
            if(!$data['accidents_id']) {
			    $conditions[] = 'average_managers_id IN(' . implode(', ', $Authorization->data['managers']) . ')';
            }
		}

		if ($Authorization->data['roles_id'] == ROLES_MANAGER && $this->permissions['updateEstimates'] && !intval($this->permissions['updateEstimatesAll'])) {
			$conditions[] = 'estimate_managers_id IN(' . implode(', ', $Authorization->data['managers']) . ')';
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

        if ($sql) {
            $sql    .= ' ORDER BY ';
        } elseif (is_array($conditions)) {
            $sql	=	'SELECT ' . $this->getShowFieldsSQLString() . ', insurance, ' . PREFIX . '_policies.number AS policies_number, ' . PREFIX . '_accidents.policies_id, ' . PREFIX . '_accidents.product_types_id, ' .
						'accident_statuses_id AS statuses_id, a.lastname AS average_manager, b.lastname AS estimate_manager,  ' .
						PREFIX . '_accident_sections.title AS accident_sections_title, ' .
                        'TO_DAYS(NOW()) - TO_DAYS(' . PREFIX . '_accidents.date) AS accidents_days, ' . PREFIX . '_clients.important_person ' .
						'FROM ' . PREFIX . '_accidents ' .
						'JOIN ' . PREFIX . '_accidents_property ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_property.accidents_id ' .
						'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
						'JOIN ' . PREFIX . '_policies_property ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_property.policies_id ' .
						'JOIN ' . PREFIX . '_accident_statuses ON ' . PREFIX . '_accidents.accident_statuses_id = ' . PREFIX . '_accident_statuses.id ' .
						'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accidents.masters_id = ' . PREFIX . '_accounts.id ' .
						'JOIN ' . PREFIX . '_payment_statuses ON ' . PREFIX . '_accidents.payment_statuses_id = ' . PREFIX . '_payment_statuses.id ' .
                        'JOIN ' . PREFIX . '_policies_property_objects_items ON ' . PREFIX . '_accidents_property.items_id = ' . PREFIX . '_policies_property_objects_items.id ' .
                        'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_policies.clients_id = ' . PREFIX . '_clients.id ' .
						'LEFT JOIN ' . PREFIX . '_accounts AS a ON ' . PREFIX . '_accidents.average_managers_id = a.id ' .
						'LEFT JOIN ' . PREFIX . '_accounts AS b ON ' . PREFIX . '_accidents.estimate_managers_id = b.id ' .
						'LEFT JOIN ' . PREFIX . '_accident_sections ON ' . PREFIX . '_accidents.accident_sections_id = ' . PREFIX . '_accident_sections.id ' .
                    	'WHERE (' . implode(' AND ', $conditions) . ' ' . ') ' .
						'ORDER BY ';
        } else {
            $sql    =	'SELECT ' . $this->getShowFieldsSQLString() . ', insurance, ' . PREFIX . '_policies.number AS policies_number, ' . PREFIX . '_accidents_property.accidents_id, ' . PREFIX . '_accidents.product_types_id, ' .
						'accident_statuses_id AS statuses_id, a.lastname AS average_manager, b.lastname AS estimate_manager, ' .
						PREFIX . '_accident_sections.title AS accident_sections_title ' .
						'FROM ' . PREFIX . '_accidents ' .
						'JOIN ' . PREFIX . '_accidents_property ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_property.accidents_id ' .
						'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_policies.accidents_id ' .
						'JOIN ' . PREFIX . '_policies_property ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_policies_property.accidents_id ' .
						'JOIN ' . PREFIX . '_policies_property_objects ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_property_objects.policies_id ' .
                        'JOIN ' . PREFIX . '_policies_property_objects_items ON ' . PREFIX . '_accidents_property.items_id = ' . PREFIX . '_policies_property_objects_items.id ' .
						'JOIN ' . PREFIX . '_accident_statuses ON ' . PREFIX . '_accidents.accident_statuses_id = ' . PREFIX . '_accident_statuses.id ' .
						'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accidents.masters_id = ' . PREFIX . '_accounts.id ' .
						'JOIN ' . PREFIX . '_payment_statuses ON ' . PREFIX . '_accidents.payment_statuses_id = ' . PREFIX . '_payment_statuses.id ' .
						'LEFT JOIN ' . PREFIX . '_accounts AS a ON ' . PREFIX . '_accidents.average_managers_id = a.id ' .
						'LEFT JOIN ' . PREFIX . '_accounts AS b ON ' . PREFIX . '_accidents.estimate_managers_id = b.id ' .
						'LEFT JOIN ' . PREFIX . '_accident_sections ON ' . PREFIX . '_accidents.accident_sections_id = ' . PREFIX . '_accident_sections.id ' .
						'ORDER BY ';
        }

        $total = $db->getOne(transformToGetCount($sql));

        $sql .= $this->getShowOrderCondition();
		
		if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);

		$sql =  'SELECT id, title, level - 1 AS level ' .
				'FROM ' . PREFIX . '_product_types ' .
				'ORDER BY num_l';
		$product_types = $db->getAll($sql, 24 * 60 * 60);

        $fields['accident_statuses_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('accident_statuses_id') ];
        $fields['accident_statuses_id']['list'] = $this->getListValue($fields['accident_statuses_id'], $data);
        $fields['accident_statuses_id']['object'] = $this->buildSelect($fields['accident_statuses_id'], $data['accident_statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data, 'filter');

		$fields['companies_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('companies_id') ];
		$fields['companies_id']['list'] = $this->getListValue($fields['companies_id'], $data);
		$fields['companies_id']['object'] = $this->buildSelect($fields['companies_id'], $data['companies_id'], $data['languageCode'], 'multiple size="2"', null, $data, 'filter');

        $fields['accident_sections_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('accident_sections_id') ];
        $fields['accident_sections_id']['list'] = $this->getListValue($fields['accident_sections_id'], $data);
        $fields['accident_sections_id']['object'] = $this->buildSelect($fields['accident_sections_id'], $data['accident_sections_id'], $data['languageCode'], 'multiple size="3"', null, $data, 'filter');

		if ($Authorization->data['roles_id'] != ROLES_MASTER) {
			$sql =	'SELECT id, title, level - 1 AS level ' .
					'FROM ' . PREFIX . '_car_services ' .
					'ORDER BY num_l, title';
			$car_services = $db->getAll($sql, 60 * 60);
		}

        include 'Accidents/showProperty.php';
    }

    function getListValue($field, $data) {
        global $db;

		switch ($field['name']) {
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
			default:
				$options = parent::getListValue($field, $data);
        }

        return $options;
    }

    function setConstants(&$data) {
    	global $Authorization;

        parent::setConstants($data);

		//$data['managers_id'] = $this->getManagersId();

        if(!$data['applicant_resident']) {
            $data['applicant_resident'] = 0;
            $this->formDescription['fields'][ $this->getFieldPositionByName('applicant_resident') ]['verification']['canBeEmpty'] = true;
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
            case $this->object . '|update':

                switch ($data['companies_id']){
                   case INSURANCE_COMPANIES_GENERALI:
                        $data['owner_regions_id']	= 1;
                        $data['accidents_kasko_id']	= 1;
                        $data['number']				= $data['policies_number'];
                        $data['date']				= $data['policies_date'];
                }

				switch ($data['application_risks_id']) {
					case RISKS_DTP:
                        $data['types_id'] = 0;
						$this->formDescription['fields'][ $this->getFieldPositionByName('types_id') ]['verification']['canBeEmpty'] = true;

						$data['consequences'] = 0;
						$this->formDescription['fields'][ $this->getFieldPositionByName('consequences') ]['verification']['canBeEmpty'] = true;
						break;
					default:
						$data['types_id'] = 0;
						$this->formDescription['fields'][ $this->getFieldPositionByName('types_id') ]['verification']['canBeEmpty'] = true;

						$data['consequences'] = 0;
						$this->formDescription['fields'][ $this->getFieldPositionByName('consequences') ]['verification']['canBeEmpty'] = true;
						break;
				}

				switch (intval($data['mvs'])) {

                    case 1://Органи ДАІ
						unset($data['mvs_title']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
                        unset($data['applicant_insurer_company']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('applicant_insurer_company') ]['verification']['canBeEmpty'] = true;
                        unset($data['applicant_policies_series']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('applicant_policies_series') ]['verification']['canBeEmpty'] = true;
                        unset($data['applicant_policies_number']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('applicant_policies_number') ]['verification']['canBeEmpty'] = true;
                        unset($data['accident_schemes_id']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('accident_schemes_id') ]['verification']['canBeEmpty'] = true;
						break;

					case 2://Європротокол
						unset($data['mvs_id']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
						unset($data['mvs_title']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
						unset($data['mvs_date_day']);
						unset($data['mvs_date_month']);
						unset($data['mvs_date_year']);

						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date') ]['verification']['canBeEmpty'] = true;
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
			case $this->object . '|updateRisk':

				if ($data['options_taxy'] == '1' && $data['policies_options_taxy'] == '0' ||
					$data['options_guilty_no']== '' && $data['policies_options_guilty_no'] == '1' ||
					$data['options_holiday'] == '' && $data['policies_options_holiday'] == '1' ||
					$data['options_work'] == '' && $data['policies_options_work'] == '1' ||
					$data['options_season'] == '' && $data['policies_options_season'] == '1') {
						$data['insurance'] = 3;//не страховое
				}

				$fields = array();
				
				if (!in_array($this->getAccidentStatusesId($data['id']), array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE))) {
					$this->formDescription['fields'][ $this->getFieldPositionByName('compromise') ]['display']['update'] = false;
					$this->formDescription['fields'][ $this->getFieldPositionByName('compromise_violation') ]['display']['update'] = false;
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
			$Policies = Policies::factory($data, 'Property');
            $Policies->setApplicationRequiredFields();
            $Policies->checkFields($data, $action);
        }

        parent::checkFields($data, $action);

        switch ($data['do']) {
            case $this->object . '|insert':
            case $this->object . '|update':

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

                break;
			case $this->object . '|updateClassification':
				if ($data['amount_rough'] != '' && intval($data['amount_rough']) <= 0) {
					$params = array($this->formDescription['fields'][ $this->getFieldPositionByName('amount_rough') ]['description'], null);
					$Log->add('error', 'The <b>%s</b>%s format is not valid.', $params);
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

		$sql =	'SELECT a.companies_id, a.policies_id, a.comment, a.monitoring_managers_id, a.car_services_id, '.
                'b.accidents_id, c.number AS policies_number, b.expert_organizations_id,  ' .
				'date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, ' .
				'c.amount AS policies_amount, c.product_types_id, ' .
				'SUM(e.amount) AS policy_payments_amount ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_accidents_property AS b ON a.id = b.accidents_id ' .
				'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
				'JOIN ' . PREFIX . '_policies_property AS d ON a.policies_id = d.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policy_payments AS e ON a.policies_id = e.policies_id ' .
				'WHERE a.id = ' . intval($accidents_id);

		return $db->getRow($sql, 30 * 60);
	}

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        switch ($_REQUEST['do']) {
            case $this->object . '|load':
            case $this->object . '|view':
                $sql =  'SELECT a.monitoring_managers_id, ' .
						'd.insurer_lastname, d.insurer_passport_series, d.insurer_passport_number, d.insurer_identification_code, ' .
						'e.number AS policies_number, e.date AS policies_date, date_format(e.date, ' . $db->quote('%Y') . ') AS policies_date_year, date_format(e.date, ' . $db->quote('%m') . ') AS policies_date_month, date_format(e.date, ' . $db->quote('%d') . ') AS policies_date_day ' .
						'FROM ' . PREFIX . '_accidents AS a ' .
                        'LEFT JOIN ' . PREFIX . '_accidents_property AS b ON a.id = b.accidents_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_property AS d ON a.policies_id = d.policies_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies AS e ON a.policies_id = e.id ' .
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

    function setDateField($fieldname, &$data) {
    	$data[$fieldname.'_year']		= substr($data[$fieldname], 0, 4);
    	$data[$fieldname.'_month']		= substr($data[$fieldname], 5, 2);
    	$data[$fieldname.'_day']		= substr($data[$fieldname], 8, 2);
    }

 	function setDateTimeField($fieldname,&$data) {
    	$data[$fieldname.'_year']		= substr($data[$fieldname], 0, 4);
    	$data[$fieldname.'_month']		= substr($data[$fieldname], 5, 2);
    	$data[$fieldname.'_day']		= substr($data[$fieldname], 8, 2);
		$data[$fieldname . '_hour']		= substr($data[$fieldname], 11, 2);
		$data[$fieldname . '_minute']	= substr($data[$fieldname], 14, 2);
    }

    //запись полиса в базу
	function updatePolicy($id,$data) {
		global $db;

		if (intval($data['items_id'])) {
			try {
	        	$url = E_INSURANCE . '/synchronization/express/insurancepolicies.php?WSDL';
				$client = new SoapClient($url,array("trace" => 0, "exception" => 1));

			    $result=$client->getPolicy(array("itemId" => intval($data['items_id'])));
			    //echo "REQUEST:\n" . $client->__getLastRequest() . "\n";
				//echo "Response:\n" . $client->__getLastResponse() . "\n";
				$result=(string)$result->getPolicyResult;
			} catch (Exception $e) {

			}

			$row = array();
			$xml =@ simplexml_load_string($result);
			$list = array();
			if ($xml && $xml->kasko && $xml->kasko->count()>0) 	{
				$row = (array)$xml->kasko[0];
				$row['accidents_id'] = $row['id'] = $id;
				$dateFields = array('owner_dateofbirth', 'owner_passport_date', 'insurer_dateofbirth', 'insurer_passport_date', 'insurer_driver_licence_date', 'date');
				foreach ($dateFields as $field) {
					$this->setDateField($field, $row);
				}

				$dateTimeFields = array('begin_datetime','end_datetime','interrupt_datetime','insurer_driver_licence_date');
				foreach ($dateTimeFields as $field) {
					$this->setDateTimeField($field, $row);
				}

				$Policies_Property = Policies::factory($data, 'Property');

				foreach ($Policies_Property->formDescription['fields'] as $i=>$field) {
					$Policies_Property->formDescription['fields'][$i]['verification']['canBeEmpty'] = true;
				}

                $Policies_Property->permissions = array(
					'insert'	=> true,
					'update'	=> true);

                $Policies_Property->update($row,false,false);

				try {
					$url = E_INSURANCE . '/synchronization/express/insurancepolicies.php?WSDL';

					$client = new SoapClient($url, array('trace' => 1));
					$result = $client->getPoliciesRisks(array('policiesId' => intval($row['policies_id'])));

//					echo "REQUEST:\n" . $client->__getLastRequest() . "\n";
//					echo "Response:\n" . $client->__getLastResponse() . "\n";

					$result = $result->getPoliciesRisksResult->int;

					foreach($result as $risk) {
						$sql =	'REPLACE ' . PREFIX . '_policy_risks SET ' .
								'accidents_id = ' . intval($row['accidents_id']) . ', ' .
								'risks_id = ' . intval($risk);
						$db->query($sql);
					}
				} catch (Exception $e) {
//					echo "REQUEST:\n" . $client->__getLastRequest() . "\n";
//					echo "Response:\n" . $client->__getLastResponse() . "\n";
//					exit;
				}
			}
		}
	}

	function setAdditionalFields($id, $data, $init=false) {
		global $db;

		parent::setAdditionalFields($id, $data);

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

			$sql =	'UPDATE ' . PREFIX . '_accidents_property, ' . PREFIX . '_accidents SET ' .
					'address_average = address, ' .
					'mvs_average = mvs, ' .
					'mvs_id_average = mvs_id, ' .
					'mvs_title_average = mvs_title, ' .
					'mvs_date_average = mvs_date ' .
					'WHERE accidents_id = ' . intval($id) . ' AND id = ' . intval($id);
			$db->query($sql);

			//фиксируем данные по органам ГАИ
			if (intval($data['mvs_id']) && intval($data['mvs']) == 1) {
				$sql =	'UPDATE ' . PREFIX . '_accidents_property, ' . PREFIX . '_mvs SET ' .
						'mvs_title = title, ' .
						'mvs_title_average = title ' .
						'WHERE ' . PREFIX . '_accidents_property.mvs_id = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['id']);
				$db->query($sql);
			} else {
				$sql =	'UPDATE ' . PREFIX . '_accidents_property SET ' .
						'mvs_title_average = mvs_title ' .
						'WHERE accidents_id = ' . intval($data['id']);
				$db->query($sql);
			}
		} elseif (intval($data['mvs_id']) && intval($data['mvs']) == 1) {
			$sql =	'UPDATE ' . PREFIX . '_accidents_property, ' . PREFIX . '_mvs SET ' .
					'mvs_title = title ' .
					'WHERE ' . PREFIX . '_accidents_property.mvs_id = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['id']);
			$db->query($sql);
		}

		switch ($data['companies_id']) {
			case INSURANCE_COMPANIES_GENERALI:
				$Policies = Policies::factory($data, 'Property');
				$Policies->setApplicationRequiredFields();
				$data['insurer'] = $data['insurer_lastname'];
				$Policies->update($data, false);
				break;
			case INSURANCE_COMPANIES_EXPRESS:
				$this->updatePolicy($id, $data);
				break;
        }
	}

 	function getProductType() {
		return PRODUCT_TYPES_PROPERTY;
	}

	function setNumber($data) {
        global $db;

        $sql = 'SELECT product_types_id ' .
               'FROM ' . PREFIX . '_policies ' .
               'WHERE id = ' . intval($data['policies_id']) ;
        $first_symbol = $db->getOne($sql);//������� ��� �������� �� ������ ��� ������������ ������ ����, ������� � ����������� "���������" � "�����"

        $last_number = $this->getLastNumber($data['product_types_id']);//������� ��������� ����� ���� �� ���� ��������

        $sql = 'UPDATE ' . PREFIX . '_accidents AS a ' .
               'SET a.number = CONCAT(\'' . $first_symbol . '\', \'.\', date_format(a.created, \'%y\'), \'.\', ' . intval(intval($last_number+1)) . ') ' .
               'WHERE a.id = ' . intval($data['accidents_id']);
        $db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_accidents_last_numbers ' .
                'SET accidents_last_number = '. intval(intval($last_number+1)) . ' ' .
                'WHERE product_types_id = ' . intval($data['product_types_id']);
        $db->query($sql);
    }

    function insert($data) {//_dump($data);exit;
        global $Log;

        $data['step'] = 1;

        $data['accidents_id'] = parent::insert(&$data, false, true);

        if ($data['accidents_id']) {

	       	$this->setNumber($data);

			$this->setAdditionalFields($data['accidents_id'], $data, true);

            $this->generateDocuments($data['accidents_id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_FRONT_PAGE_PROPERTY, DOCUMENT_TYPES_ACCIDENT_PROPERTY_APPLICATION), $data);

            $this->updateStep($data['accidents_id'], $data['step'] + 1);

			$AccidentStatusChanges = new AccidentStatusChanges($data);
			$AccidentStatusChanges->set($data['accidents_id']);

            $this->insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;">Справу створено:</label> <b>' . date("d.m.Y") . '</b>'));

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

			$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

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

    function load($data, $showForm=true, $action='update', $actionType='update', $template='propertyApplication.php') {
        global $db;

      	$this->checkPermissions('update', $data);

       	if ($data['accidents_id']) {
			$data['id'] = $data['accidents_id'];
       	} elseif (is_array($data['id'])) {
       		$data['id'] = $data['id'][0];
       	}

        $this->setTables('load');
        $this->getFormFields('update');

        $sql =  'SELECT ' . implode(', ', $this->formFields) . ', ' . PREFIX . '_accidents_property.accidents_id, accident_statuses_id, car_services_id, description, mvs_id, ' . PREFIX . '_policies.price AS policies_price, ' .
                            PREFIX . '_policies.product_types_id '.
                'FROM ' . PREFIX . '_accidents ' .
        		'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
        		'JOIN ' . PREFIX . '_policies_property ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_property.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_property ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_property.accidents_id ' .
                'WHERE ' . PREFIX . '_accidents.id = ' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);
        $data['important_person'] = $this->getImportantPerson($data['policies_id']);
        $data['risks'] = $this->getRisks($data['id']);
        if ($_REQUEST['do'] == $this->object . '|load') {
			switch ($data['accident_statuses_id']) {
				case ACCIDENT_STATUSES_APPLICATION:
					break;
				case ACCIDENT_STATUSES_CLASSIFICATION:
					if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Classification') {
						header('Location: /?do=' . $this->object . '|' . $this->mode . 'Classification&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_PROPERTY);
						exit;
					}
					break;
				case ACCIDENT_STATUSES_INVESTIGATION:
				case ACCIDENT_STATUSES_REINVESTIGATION:
				case ACCIDENT_STATUSES_COMPROMISE_AGREEMENT:
				case ACCIDENT_STATUSES_DEFECTS:
					if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Risk') {
						header('Location: /?do=' . $this->object . '|' . $this->mode . 'Risk&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_PROPERTY);
						exit;
					}
					break;
				case ACCIDENT_STATUSES_COORDINATION:
					if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Acts') {
						header('Location: /?do=' . $this->object . '|' . $this->mode . 'Acts&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_PROPERTY);
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

    function showForm($data, $action, $actionType=null, $template='propertyApplication.php') {
        global $db, $Authorization, $ACCIDENT_STATUSES_SCHEMA;
        $data['important_person'] = $this->getImportantPerson($data['policies_id']);

        parent::showForm($data, $action, $actionType, $template);
    }

    function view($data, $conditions=null, $sql=null, $template='propertyApplication.php', $showForm=true) {

        if(is_array($data['id'])){
            $data['id'] = $data['id'][0];
        }

        if (intval($data['accidents_id'])) {
            $data['id'] = $data['accidents_id'];
        }

		$this->setTables('view');
		$this->getFormFields('view');

		$identityField = $this->getIdentityField();

		$sql =	'SELECT ' . implode(', ', $this->formFields) . ', companies_id, ' . PREFIX . '_policies.product_types_id ' .
				'FROM ' . PREFIX . '_accidents ' .
				'JOIN ' . PREFIX . '_accidents_property ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_property.accidents_id ' .
				'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
				'JOIN ' . PREFIX . '_policies_property ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_property.policies_id ' .
				'JOIN ' . PREFIX . '_policies_property_objects ON ' . PREFIX . '_policies_property_objects.policies_id = ' . PREFIX . '_accidents.policies_id ' .
                'JOIN ' . PREFIX . '_policies_property_objects_items ON ' . PREFIX . '_policies_property_objects_items.objects_id = ' . PREFIX . '_policies_property_objects.id ' .
				'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
		return parent::view($data, null, $sql, $template, $showForm);
    }

    function update($data) {
        global $Log;

        $data['step'] = 1;

        $data['accidents_id'] = parent::update(&$data, false, true);

        if ($data['accidents_id']) {

			$this->setAdditionalFields($data['accidents_id'], $data);

            $this->generateDocuments($data['accidents_id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_FRONT_PAGE_PROPERTY, DOCUMENT_TYPES_ACCIDENT_PROPERTY_APPLICATION), $data);

            $this->updateStep($data['accidents_id'], $data['step'] + 1);

			$AccidentStatusChanges = new AccidentStatusChanges($data);
			$AccidentStatusChanges->set($data['accidents_id']);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

			$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

			switch ($data['accident_statuses_id']) {
				case ACCIDENT_STATUSES_APPLICATION:

					header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|load&id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
					break;
				case ACCIDENT_STATUSES_CLASSIFICATION:

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
			exit;
        }
    }

    function updateClassification($data) {
		global $Log, $db;

		$this->checkPermissions('updateClassification', $data);

        $this->formDescription = $this->classificationFormDescription;

        if ($_POST['do'] == $this->object . '|updateClassification') {

			$data['accident_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;

			$this->permissions['update'] = $this->permissions['updateClassification'];

            if (Form::update($data, false, false)) {

				//формируем лист согласования
				$this->generateDocuments($data['id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_NOTE_AGREEMENT_PROPERTY), $data);

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
        return $this->showForm($data, 'updateClassification', 'update', 'propertyClassification.php');
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

		return $this->showForm($data, 'viewClassification', 'view', 'propertyClassification.php');
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
			ACCIDENT_STATUSES_RESOLVED);

		$this->checkPermissions('updateRisk', $data);

        $this->formDescription = $this->riskFormDescription;

        if ($_POST['do'] == $this->object . '|updateRisk') {
		
			$accident_statuses_id = $this->getAccidentStatusesId($data['id']);
			$compromise = $this->checkCompromise($data['id'], 1);

			//$data['accident_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;
			$data['accident_statuses_id'] = ($accident_statuses_id == ACCIDENT_STATUSES_REINVESTIGATION || $accident_statuses_id == ACCIDENT_STATUSES_COORDINATION || $accident_statuses_id == ACCIDENT_STATUSES_COMPROMISE_AGREEMENT || ACCIDENT_STATUSES_COMPROMISE_CONTINUE) ? $accident_statuses_id : ACCIDENT_STATUSES_INVESTIGATION;
			if (!isset($data['compromise_violation'])) {
				$data['compromise_violation'] = $data['compromise_violation_hidden'];
			}

			$this->permissions['update'] = $this->permissions['updateRisk'];

            if (Form::update($data, false, false)) {

				$data['accidents_id'] = $data['id'];

				if (intval($data['mvs_average']) == 1 && intval($data['mvs_id_average'])) {
					$sql =	'UPDATE ' . PREFIX . '_accidents_property, ' . PREFIX . '_mvs SET ' .
							'mvs_title_average = title ' .
							'WHERE ' . PREFIX . '_accidents_property.mvs_id_average = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['accidents_id']);
					$db->query($sql);
				}

                //если компромис - генерируем письмо
                if (intval($data['compromise'])) {
                    $product_documents['generateDocuments'][] = DOCUMENT_TYPES_ACCIDENT_COMPROMISE_AGREEMENT_LETTER_PROPERTY;
                } else {
                    $product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_COMPROMISE_AGREEMENT_LETTER_PROPERTY;
                }

				if (intval($data['insurance']) == 1) {

                    //если уже имеются аткы не в оплате или в "врегульовано", то устанавливаем "випадок"
                    $sql =	'SELECT id ' .
							'FROM ' . PREFIX . '_accidents_acts ' .
							'WHERE accidents_id = ' . intval($data['accidents_id']);
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

					if (intval($data['financial_institutions_id'])) {
						$product_documents['generateDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_BANK;
					} else {

						$product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_BANK;
					}

				} else {//если событие не страховое, добавляем акт минуя экспертную оценку

					$sql =	'SELECT id ' .
							'FROM ' . PREFIX . '_accidents_acts ' .
							'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND payment_statuses_id NOT IN(' . implode(', ', $conditions_payment_statuses) . ')'. 'AND act_statuses_id 	NOT IN (' . implode(', ', $conditions_statuses_acts) . ')';
					$data['id'] = $db->getCol($sql);

					$AccidentActs = AccidentActs::factory($data, 'Property');

					$data['act_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;

					$product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_GAI;
					$product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_BANK;

					if (is_array($data['id']) && sizeOf($data['id'])) {
                        foreach ($data['id'] as $id) {
							$data['id'] = $id;
							$AccidentActs->update($data, false);
                        }
					} else {
						//$AccidentActs->insert($data, false);
					}
				}

				foreach ($product_documents as $method => $product_document_types) {
					$this->$method($data['accidents_id'], 0, 0, 0, $product_document_types, $data);
				}

				//перегоняем акты дальше по статусу, если статус был по делу ошибка в квалификации
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
				$AccidentStatusChanges->set($data['id']);

				$params['title']    = $this->messages['single'];
				$params['id']       = $data['accidents_id'];
				$params['storage']  = $this->tables[0];

				$Log->add('confirm', 'Ризик по справі було встановлено.', $params);

				($this->permissions['updateActs'])
					? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateActs&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id'])
					: header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewActs&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
				exit;
            }

            $data = $this->replaceSpecialChars($data, 'update');
        } else {
			$data = $this->load($data, false, 'updateRisk');

            if (!$data['description_average']) {
            	$data['description_average'] = $data['description'];
            }
        }
		
		$data['compromise_violation_list'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_compromise_violation WHERE product_types_id IN (0, ' . PRODUCT_TYPES_PROPERTY . ')');

        return $this->showForm($data, 'updateRisk', 'update', 'propertyRisk.php');
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
        $data['important_person'] = $this->getImportantPerson($data['policies_id']);
		
		$data['compromise_violation_list'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_compromise_violation WHERE product_types_id IN (0, ' . PRODUCT_TYPES_PROPERTY . ')');

        return $this->showForm($data, 'viewRisk', 'view', 'propertyRisk.php');
    }

    function updateActs($data) {
		$data['step'] = 4;

        $fields[]        = 'accidents_id';
        $conditions[]    = PREFIX . '_accidents_acts.accidents_id = ' . intval($data['accidents_id']);

        $data['accidents'] =& $this;

        $AccidentActs = AccidentActs::factory($data, 'Property');

        $this->objectTitle = $AccidentActs->objectTitle;

        $AccidentActs->show($data, $fields, $conditions, null, $AccidentActs->object . '/show.php');

        $this->updateStep($data['accidents_id'], 5);
    }

    function viewActs($data) {
		$data['step'] = 4;

        $fields[]        = 'accidents_id';
        $conditions[]    = PREFIX . '_accidents_acts.accidents_id = ' . intval($data['accidents_id']);

        $fields[]        = 'product_types_id';

        $data['accidents'] =& $this;

        $AccidentActs = AccidentActs::factory($data, 'Property');

        $this->objectTitle = $AccidentActs->objectTitle;

		$AccidentActs->permissions['insert']	= false;
		$AccidentActs->permissions['update']	= false;

        $AccidentActs->show($data, $fields, $conditions, null, $AccidentActs->object . '/show.php');
    }

    function deleteProcess(&$data, $i = 0, $folder=null) {
        global $db;

		echo '---';

		//удаляем страховые акты не доведенные до оплаты
        $AccidentActs = AccidentActs::factory($data, 'Property');

		//получаем дела, которые нельзя удалять
        $sql =  'SELECT DISTINCT accidents_id ' .
				'FROM ' . $AccidentActs->tables[0] . ' ' .
				'WHERE accidents_id IN(' . implode(', ', $data['id']) . ') AND (payment_statuses_id <> ' . PAYMENT_STATUSES_NOT . ' OR act_statuses_id >= ' . ACCIDENT_STATUSES_COORDINATION . ')';
        $accidents = $db->getCol($sql);

		$data['id'] = array_diff($data['id'], $accidents);

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
			$sql =	'SELECT id ' .
					'FROM ' . $AccidentActs->tables[0] . ' ' .
					'WHERE accidents_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentActs->delete($toDelete, false, false);

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
//echo 1111;
        $conditions[] = 'c.insurance_companies_id =' . INSURANCE_COMPANIES_EXPRESS;

		if ($Authorization->data['roles_id'] == ROLES_MASTER) {
			$conditions[] = 'a.car_services_id = ' . intval($Authorization->data['car_services_id']);
		}

        if (intval($data['accidents_id'])) {
//            $conditions[] = 'a.id = ' . intval($data['accidents_id']);
        }

        if ($data['policies_number']) {
            $conditions[] = 'c.number = ' . $db->quote($data['policies_number']);
        }

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

        if (!$conditions) {

            $result = 'Не задали жодного критерію пошуку.';
        } else {

			$sql =	'SELECT a.id, a.number, c.number AS policies_number, ' .
					'date_format(c.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date_format, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, ' .
					'd.insurer_lastname, d.insurer_firstname, d.insurer_patronymicname ' .
                    'FROM ' . PREFIX . '_accidents AS a  ' .
                    'JOIN ' . PREFIX . '_accidents_property AS b ON a.id = b.accidents_id  ' .
                    'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
                    'JOIN ' . PREFIX . '_policies_property AS d ON a.policies_id = d.policies_id ' .
                    'WHERE c.number = ' . $db->quote($data['policies_number']) . ' '.
                    'ORDER BY c.begin_datetime DESC';

            $list = $db->getAll($sql);
//_dump($sql);

            $result =   '<table width="100%" cellpadding="0" cellspacing="0">' .
                            '<tr class="columns">' .
							'<td class="id">&nbsp;</td>' .
                            '<td>Страхувальник</td>' .
                            '<td>Номер</td>' .
                            '<td>Дата</td>' .
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

    function get($data) {
        global $db;

       if(is_array($data['id'])) {
           $conditions[] = 'a.id IN  ('.implode(', ', $data['id']) . ')';
       }
       else {
           $conditions[] = 'a.id = ' . $data['id'];
       }
       $sql ='SELECT a.*,b.*, ' .
                    'a.number as accident_number, ' .
                    'c.number as policies_number ' .
                    'FROM ' . PREFIX . '_accidents AS a  ' .
                    'JOIN ' . PREFIX . '_accidents_property AS b ON a.id = b.accidents_id  ' .
                    'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
                    'JOIN ' . PREFIX . '_policies_property AS d ON a.policies_id = d.policies_id ' .
                    'WHERE (' . implode(' AND ', $conditions) . ')';
       return $db->getRow($sql);
    }

    function prepareValues($fields, $values) {
        global $REGIONS;

        foreach ($fields as $field) {
			switch ($field) {
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
							$values[ $field ] = 'Нi, Складання вропротоколу: ' . ($values['mvs'] == 2) ? 'Так' : 'Ні' ;
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

	//получаем стоимость ремонта общую
	function getVRZPrevious($accidents_id, $id) {
		global $db;

		$sql =	'SELECT ROUND(b.amount_details * (1 - b.deterioration_value) + b.amount_material + b.amount_work, 2) AS amount_vrz ' .
				'FROM ' . PREFIX . '_accidents_acts as a ' .
				'JOIN ' . PREFIX . '_accidents_property_acts as b ' .
				'WHERE a.accidents_id = ' . intval($accidents_id) . ' AND a.id < ' . $db->quote($id) . ' ' .
				'ORDER BY a.id DESC ' .
				'LIMIT 1';
		return $db->getOne($sql);
	}

	//выплаты по предыдущим событиям по договору, с учетом возможных допов
	function getAmountPrevious($id) {
		global $db;

		$sql =	'SELECT b.id ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
				'WHERE a.id = ' . intval($id);
		$top = $db->getOne($sql);

		//$conditions[] = 'a.top = ' . $db->quote($top);
        $conditions[] = 'a.id = ' . $db->quote($top);
		$conditions[] = 'b.id < ' . intval($id);
		$conditions[] = 'c.act_statuses_id IN(' . ACCIDENT_STATUSES_PAYMENT . ', ' . ACCIDENT_STATUSES_RESOLVED . ')';

		$sql =	'SELECT SUM(c.amount) ' .
				'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_accidents AS b ON a.id = b.policies_id ' .
				'JOIN ' . PREFIX . '_accidents_acts AS c ON b.id = c.accidents_id ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getOne($sql);
	}

    function getValues($file) {
        global $db;

        $object_types = array(
            1   =>  'Будинки, споруди, приміщення',
            2   =>  'Обладнання',
            3   =>  'Товарно-матеріальні цінності',
            4   =>  'Вміст'
        );
//dasdasdas
        $sql =  'SELECT b.policies_id as acc_policies_id, a.*, a.number AS accident_documents_number, a.created AS accident_documents_created, ' .
				'b.*, b.number AS accidents_number, b.date AS accidents_date, b.datetime AS accidents_datetime, b.datetime_average AS accidents_datetime_average, b.assistance as accidents_assistance, b.assistance_date AS accidents_assistance_date, b.risks_id, b.documents AS accidents_documents, b.comment as comment, ' .
				'c.*, c.mvs as accidents_property_mvs, ' .
				'd.*,d1.*, d1.created as acts_created, d.discount, d.amount_start, d.amount_others, d.amount_start + d.amount_others as amount_all, d.amount_details + d.amount_material + d.amount_work AS amount_vr, ROUND(d.amount_details * (1 - d.deterioration_value) + d.amount_material + d.amount_work, 2) AS amount_vrz, d1.documents AS acts_documents, ' .
				'e.product_types_id, e.number AS policies_number, e.date AS policies_date, e.begin_datetime AS begin_datetime, e.interrupt_datetime AS interrupt_datetime, e.price AS policies_price, e.amount AS policy_amount, ' .
				'f.insurer_person_types_id AS policies_insurer_person_types_id, f.insurer_lastname AS policies_insurer_lastname, f.insurer_firstname AS policies_insurer_firstname, f.insurer_patronymicname AS policies_insurer_patronymicname, f.insurer_identification_code AS policies_insurer_identification_code, f.insurer_company AS policies_insurer_company, f.insurer_edrpou AS policies_insurer_edrpou, ' .
				'f.insurer_city AS policies_insurer_city, f.insurer_street AS policies_insurer_street, f.insurer_house AS policies_insurer_house, f.insurer_flat AS policies_insurer_flat, f.insurer_phone AS policies_insurer_phone, ' .
				'f.owner_person_types_id AS policies_owner_person_types_id, f.owner_lastname AS policies_owner_lastname, f.owner_firstname AS policies_owner_firstname, f.owner_patronymicname AS policies_owner_patronymicname, f.owner_identification_code AS policies_owner_identification_code, f.owner_company AS policies_owner_company, f.owner_edrpou AS policies_owner_edrpou, ' .
				'f.assured_title AS policies_assured_title, f.assured_address AS policies_assured_address, f.assured_identification_code AS policies_assured_identification_code, ' .
				'h.title AS risks_title, ' .
				'j.lastname AS masters_lastname, j.firstname AS masters_firstname, j.patronymicname AS masters_patronymicname, ' .
				'k.address AS mvs_address,' .
				'l.amount AS payments_calendar_amount,l.payment_types_id as payments_calendar_payment_types_id, l.basis AS payments_calendar_basis, l.number as payments_calendar_number, l.recipient AS payments_calendar_recipient, l.recipient_identification_code AS payments_calendar_recipient_identification_code, l.payment_bank_account AS payments_calendar_payment_bank_account, l.payment_bank AS payments_calendar_payment_bank, l.payment_bank_mfo AS payments_calendar_payment_bank_mfo, l.payment_bank_card_number AS payments_calendar_payment_bank_card_number, l.created as payments_calendar_created, ' .
        		'm.title AS car_services_title, ' .
				'n.lastname AS average_managers_lastname, n.firstname AS average_managers_firstname, n.patronymicname AS average_managers_patronymicname, ' .
				'o.lastname AS expert_managers_lastname, o.firstname AS expert_managers_firstname, o.patronymicname AS expert_managers_patronymicname, ' .
                'p.title as sections_title, ' .
                'r.accounts_title AS accident_status_changes_accounts_title, MIN(r.created) as accident_status_changes_application_created, ' .
                'a.accidents_id, s.amount AS policy_payments_amount, ' .
                'property_objects.id as object_id, property_objects.object_type, property_objects.title as property_objects_title, property_objects.object_location, ' .
                'd1.insurance AS acts_insurance ,d1.number AS acts_number, property_objects_items.title as insurance_object, ' .
                'property_objects_items.storage as object, property_objects_items.price as object_insurance_price, property_objects_items.value as policies_deductibles_value, property_objects_items.absolute as policies_deductibles_absolute ' .
                'FROM ' . PREFIX . '_accident_documents AS a ' .
                'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
                'JOIN ' . PREFIX . '_accidents_property AS c ON b.id = c.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_acts AS d1 ON a.acts_id = d1.id ' .
				'LEFT JOIN ' . PREFIX . '_accidents_property_acts AS d ON a.acts_id = d.accidents_acts_id ' .
                'JOIN ' . PREFIX . '_policies AS e ON b.policies_id = e.id ' .
                'JOIN ' . PREFIX . '_policies_property AS f ON b.policies_id = f.policies_id ' .
                'JOIN ' . PREFIX . '_policies_property_objects AS property_objects ON e.id = property_objects.policies_id ' .
                'JOIN ' . PREFIX . '_policies_property_objects_items AS property_objects_items ON property_objects.id = property_objects_items.objects_id AND c.items_id = property_objects_items.id ' .
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
                'WHERE a.id = ' . intval($file['id']) . ' ' .
				'GROUP BY s.policies_id';
        $row = $db->getRow($sql);

        if ($row['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_COMPROMISE_AGREEMENT_LETTER_PROPERTY) {
            $row['object_types_title'] = $object_types[$row['object_type']];
            $row['values_id_title'] = $db->getOne(
                'SELECT b.title ' .
                'FROM ' . PREFIX . '_policies_property_objects_values_assignments a ' .
                'JOIN ' . PREFIX . '_parameters_property b ON a.values_id = b.id ' .
                'WHERE a.policies_property_objects_id = ' . intval($row['object_id'])
            );

            $sql = 'SELECT GROUP_CONCAT(DISTINCT accidents.number SEPARATOR \', \') as accidents_list, SUM(getCompensation(accidents.id, 12)) as payments_amount ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_accidents as accidents ON policies.id = accidents.policies_id ' .
                   'WHERE policies.number = ' . $db->quote($row['policies_number']) . ' AND accidents.datetime < ' . $db->quote($row['datetime']) . ' AND accidents.number <> ' . $db->quote($row['accidents_number']);
            $row['policies_previous_accidents'] = $db->getRow($sql);

            $sql = 'SELECT GROUP_CONCAT(DISTINCT CONCAT(policies.number, \' (\', date_format(policies.date, \'%d.%m.%Y\'), \')\') SEPARATOR \', \') as policies_list, SUM(payments.policy_payments_amount) as payments_amount ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_policies_property as policies_property ON policies.id = policies_property.policies_id ' .
                   'JOIN ' . PREFIX . '_report_payments_details as payments ON policies.number = payments.policies_number ' .
                   'WHERE policies.id <> ' . intval($row['acc_policies_id']) . ' AND ' . (($row['policies_insurer_person_types_id'] == 1) ? 'policies_property.insurer_identification_code = ' . $db->quote($row['policies_insurer_identification_code']) : '') . (($row['policies_insurer_person_types_id'] == 2) ? 'policies_property.insurer_edrpou = ' . $row['policies_insurer_edrpou'] : '');
            $row['all_policies_insurer'] = $db->getRow($sql);

            $sql = 'SELECT GROUP_CONCAT(DISTINCT accidents.number SEPARATOR \', \') as accidents_list, SUM(getCompensation(accidents.id, 12)) as payments_amount ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_policies_property as policies_property ON policies.id = policies_property.policies_id ' .
                   'JOIN ' . PREFIX . '_accidents as accidents ON policies.id = accidents.policies_id ' .
                   'WHERE policies.id <> ' . intval($row['acc_policies_id']) . ' AND ' . (($row['policies_insurer_person_types_id'] == 1) ? 'policies_property.insurer_identification_code = ' . $db->quote($row['policies_insurer_identification_code']) : '') . (($row['policies_insurer_person_types_id'] == 2) ? 'policies_property.insurer_edrpou = ' . $row['policies_insurer_edrpou'] : '');
            $row['all_policies_insurer_accidents'] = $db->getRow($sql);

            $sql = 'SELECT accidents.compromise_date, GROUP_CONCAT(compromise_violation.title SEPARATOR \', \') as compromise_violation_list ' .
                   'FROM ' . PREFIX . '_accidents as accidents ' .
                   'JOIN ' . PREFIX . '_accidents_compromise_violation as compromise_violation ON compromise_violation.value&accidents.compromise_violation <> 0 ' .
                   'WHERE accidents.id = ' . intval($row['accidents_id']);
            $row['compromise_info'] = $db->getRow($sql);
        }

		//$row['deductibles_percent'] = ($row['risks_id'] == RISKS_HIJACKING1) ? $row['policies_deductibles_value1'] : $row['policies_deductibles_value0'];

        if (intval($row['acts_id'])) {

			$row['amount_sz'] = round($row['amount_details'] * (1 - $row['deterioration_value']), 2);
			$row['amount_vrz_previous'] = $this->getVRZPrevious($row['accidents_id'], $row['acts_id']);

			if ($row['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_INSURANCE_PROPERTY_ACT) {

				//сумма выплаченных возмещений по договору
				$row['amount_previous_accidents'] = $this->getAmountPrevious($row['accidents_id']);

				//сумма выплаченных возмещений по акту
				$AccidentActs = AccidentActs::factory($data, 'Property');
				$row['amount_previous_acts'] = $AccidentActs->getAmountPrevious($row['accidents_id'], $row['acts_id']);

				$price = ($row['insurance_price'] < $row['market_price']) ? $row['insurance_price'] : $row['market_price'];
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
        } else {

			 $row['rough_part'] = round(($row['amount_rough']/$row['items_price']) * 100, 2); //для запиту в Банк

			 $sql =  'SELECT b.id, b.title ' .
					'FROM ' . PREFIX . '_accident_document_type_assignments AS a ' .
					'JOIN ' . PREFIX . '_product_document_types AS b ON a.product_document_types_id = b.id ' .
					'WHERE a.accidents_id = ' . intval($row['accidents_id']) . ' ' .
					'ORDER BY b.title';
			 $row['product_document_types'] = $db->getAssoc($sql, 30*60);

			 //для отдельного вывода Дополнительных документов в шаблон Титулки
             $row['additional_documents'] = explode($this->documentsDelimiter, $row['accidents_documents']);

             //merge масива основных док. и дополнительных для вывода в "заяву"
             foreach($row['product_document_types'] as $product_document){
                $row['documents'][] = $product_document;
             }

             $row['documents'] = ($row['accidents_documents']) ? array_merge($row['documents'], explode($this->documentsDelimiter, $row['accidents_documents'])) : $row['documents'];
        }

		$fields = array(
        	'applicant_regions_title',
            'applicant_city',
            'applicant_street',
			'mvs',
			'mvs_average');
		
		if (strtotime(date('Y-m-d')) >= strtotime('2015-08-17') && strtotime(date('Y-m-d')) <= strtotime('2015-08-23')) {
			$row['director'] = 1;
		}

        return $this->prepareValues($fields, $row);
    }

	//реквизиты страхователя, используется при создании/редактировании страхового акта
	function getEssentialInsurerInWindow($data) {
		global $db;

		$sql =	'SELECT b.* ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_policies_property AS b ON a.policies_id = b.policies_id ' .
				'WHERE a.id = ' . intval($data['id']);
		$row =	$db->getRow($sql, 60 * 60);

		switch ($row['insurer_person_types_id']) {
			case 1://физ. лицо
				echo '{"recipient_types_id":"' . RECIPIENT_TYPES_INSURER . '","recipient":"' . addslashes(html_entity_decode($row['insurer_lastname']  . ' ' . $row['insurer_firstname'] . ' ' . $row['insurer_patronymicname'])) . '","recipient_identification_code":"' . $row['insurer_identification_code'] . '","bank":"","bank_edrpou":"","bank_mfo":"","bank_account":""}';
				break;
			case 2://юр. лицо
				echo '{"recipient_types_id":"' . RECIPIENT_TYPES_INSURER . '","recipient":"' . addslashes(html_entity_decode($row['insurer_company'])) . '","recipient_identification_code":"' . $row['insurer_edrpou'] . '","bank":"' . addslashes(html_entity_decode($row['insurer_bank'])) . '","bank_edrpou":"","bank_mfo":"' . $row['insurer_bank_mfo'] . '","bank_account":"' . $row['insurer_bank_account'] . '"}';
				break;
		}
		exit;
	}

	//реквизиты владельца, используется при создании/редактировании страхового акта
	function getEssentialOwnerInWindow($data) {
		global $db;

		$sql =	'SELECT b.* ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_policies_property AS b ON a.policies_id = b.policies_id ' .
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

		$sql =	'SELECT b.*, c.mfo AS bank_mfo, c.edrpou AS bank_edrpou, c.title AS bank_title ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_policies_property AS b ON a.policies_id = b.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_financial_institutions AS c ON b.financial_institutions_id = c.id ' .
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

    //получаем перечень рисков, используется класификации дела
	function getRisks($id) {
		global $db;

        $conditions[] = 'a.id = ' . intval($id);

		$sql =	'SELECT d.id as risks_id, d.title ' .
                'FROM ' . PREFIX . '_accidents AS a ' .
                'JOIN ' . PREFIX . '_policies_property_objects AS b ON a.policies_id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policies_property_objects_risks_assignments AS c ON b.id = c.policies_property_objects_id ' .
				'JOIN ' . PREFIX . '_parameters_risks AS d ON d.id = c.risks_id ' .
				'WHERE ' . implode(' AND ', $conditions);
		return $db->getAll($sql, 30 * 60);

	}

	//выгружаем информацию по договору в бухгалтерию
	function getXML($data) {
		global $db, $Smarty;

		if ($data['number']) {
            $conditions[] = 'b.number=' . $db->quote($data['number']);
        } else {
			$conditions[] = ' b.date>='.$data['from'].' AND b.date<='.$data['to'].'  ';
            $conditions[] = 'b.accident_statuses_id >= ' . ACCIDENT_STATUSES_INVESTIGATION;
        }

        $sql =  'SELECT b.*, b.documents AS accidents_documents, c.*, b.number AS number, e.product_types_id, ' .
				'c.*, b.number AS number, e.product_types_id, ' .
				'e.number AS policies_number, e.date AS policies_date, e.begin_datetime AS begin_datetime, e.end_datetime AS end_datetime,e.amount AS policy_amount, ' .
				'f.insurer_person_types_id AS policies_insurer_person_types_id, f.insurer_lastname AS policies_insurer_lastname, f.insurer_firstname AS policies_insurer_firstname, f.insurer_patronymicname AS policies_insurer_patronymicname, f.insurer_identification_code AS policies_insurer_identification_code, f.insurer_company AS policies_insurer_company, f.insurer_edrpou AS policies_insurer_edrpou, ' .
				'f.insurer_city AS policies_insurer_city, f.insurer_street AS policies_insurer_street, f.insurer_house AS policies_insurer_house, f.insurer_flat AS policies_insurer_flat, f.insurer_phone AS policies_insurer_phone, ' .
				'f.owner_person_types_id AS policies_owner_person_types_id, f.owner_lastname AS policies_owner_lastname, f.owner_firstname AS policies_owner_firstname, f.owner_patronymicname AS policies_owner_patronymicname, f.owner_identification_code AS policies_owner_identification_code, f.owner_company AS policies_owner_company, f.owner_edrpou AS policies_owner_edrpou, ' .
				'f.assured_title AS policies_assured_title, f.assured_address AS policies_assured_address, f.assured_identification_code AS policies_assured_identification_code, ' .
				'h.title AS risks_title, ' .
				'j.lastname AS masters_lastname, j.firstname AS masters_firstname, j.patronymicname AS masters_patronymicname, ' .
				'k.address AS mvs_address, ' .
        		'm.title AS car_services_title, ' .
				'n.lastname AS average_managers_lastname, n.firstname AS average_managers_firstname, n.patronymicname AS average_managers_patronymicname, ' .
				'o.lastname AS expert_managers_lastname, o.firstname AS expert_managers_firstname, o.patronymicname AS expert_managers_patronymicname, ' .
				'b.date AS accidents_date, b.created AS accidents_date, b.datetime as accidents_datetime,b.datetime as application_date ' .
                'FROM  ' . PREFIX . '_accidents AS b   ' .
                'JOIN ' . PREFIX . '_accidents_property AS c ON b.id = c.accidents_id ' .
                'JOIN ' . PREFIX . '_policies AS e ON b.policies_id = e.id ' .
                'JOIN ' . PREFIX . '_policies_property AS f ON f.policies_id = e.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_risks AS h ON b.risks_id = h.id ' .
                'JOIN ' . PREFIX . '_accounts AS j ON b.masters_id = j.id ' .
                'LEFT JOIN ' . PREFIX . '_mvs AS k ON c.mvs_id = k.id ' .
                'JOIN ' . PREFIX . '_car_services AS m ON b.car_services_id = m.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS n ON b.average_managers_id = n.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS o ON b.estimate_managers_id = o.id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' ;
		$list = $db->getAll($sql);

	    $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/property.xml');
	}

}

?>