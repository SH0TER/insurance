<?
/*
 * Title: policy DSKV class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Products/DSKV.class.php';
require_once 'PolicyDocuments.class.php';
require_once 'FinancialInstitutions.class.php';

class Policies_DSKV extends Policies {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'                => 'id',
                            'type'                => fldIdentity,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies'),
                        array(
                            'name'                => 'agencies_id',
                            'description'        => 'Агенція',
                            'type'                => fldSelect,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 14,
                            'table'                => 'policies',
                            'sourceTable'        => 'agencies',
                            'selectField'        => 'title',
                            'orderField'        => 'id'),
                        array(
                            'name'                => 'agents_id',
                            'description'        => 'Агент',
                            'type'                => fldSelect,
							'condition'			=> 'roles_id = 8',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 17,
                            'table'                => 'policies',
                            'sourceTable'        => 'accounts',
                            'selectField'        => 'lastname',
                            'orderField'        => 'id'),
						array(
                            'name'              => 'insurance_companies_id',
                            'description'       => 'Страхова компанiя',
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
                            'table'             => 'policies'),
                        array(
                            'name'                => 'clients_id',
                            'description'        => 'clients_id',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies'),
                        array(
                            'name'                => 'product_types_id',
                            'description'        => 'Тип',
                            'type'                => fldHidden,
                            'structure'            => 'tree',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 1,
                            'table'                => 'policies',
                            'sourceTable'        => 'product_types',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'products_id',
                            'showId'            => true,
                            'description'        => 'Продукт',
                            'type'                => fldHidden,
                            'condition'         => 'product_types_id = 6',
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
                            'table'                => 'policies_dskv',
                            'sourceTable'        => 'products',
                            'selectField'        => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'                => 'number',
                            'description'        => 'Номер',
                            'type'                => fldText,
                            'maxlenght'            => 14,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 2,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'date',
                            'description'        => 'Дата',
                            'type'                => fldDate,
                            'input'                => true,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 3,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'item',
                            'description'        => 'Об\'єкт',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies'),
                        array(
                            'name'                => 'price_other',
                            'description'        => 'Ліміти відшкодування (страхова сума), грн.',
                            'type'                => fldSelect,
							'showId'               => true,
                            'list'              => array(
                                                        '10000.00' => '10 000,00',
                                                        '20000.00' => '20 000,00',
                                                        '30000.00' => '30 000,00',
														'60000.00' => '60 000,00'
														
														),
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'regions_id',
                            'description'        => 'Область',
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
                            'table'                => 'policies_dskv',
                            'sourceTable'        => 'regions',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
						array(
                            'name'              => 'area',
                            'description'       => 'Район',
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
                            'table'             => 'policies_dskv'),
                        array(
                            'name'                => 'city',
                            'description'        => 'Місто',
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
                            'table'                => 'policies_dskv'),
						array(
							'name'				=> 'street_types_id',
							'description'		=> 'Тип вулицi',
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
							'table'				=> 'policies_dskv',
							'sourceTable'		=> 'street_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
                        array(
                            'name'                => 'street',
                            'description'        => 'Вулиця',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'house',
                            'description'        => 'Будинок',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'flat',
                            'description'        => 'Квартира',
                            'type'                => fldText,
                            'maxlength'            => 4,
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
                            'table'                => 'policies_dskv'),

                        array(
                            'name'                => 'insurer',
                            'description'        => 'Страхувальник',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 4,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'insurer_lastname',
                            'description'        => 'Прізвище',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_firstname',
                            'description'        => 'Ім\'я',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_patronymicname',
                            'description'        => 'По батькові',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_dateofbirth',
                            'description'        => 'Дата народження',
                            'type'                => fldDate,
                            'input'                => true,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_passport_series',
                            'description'        => 'Паспорт, серія',
                            'type'                => fldText,
                            'maxlength'            => 2,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_passport_number',
                            'description'        => 'Паспорт, номер',
                            'type'                => fldText,
                            'maxlength'            => 13,
                            'validationRule'    => '^([0-9]{6}|[0-9]{6}\/[0-9]{6})$',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_passport_place',
                            'description'        => 'Паспорт. Ким і де виданий',
                            'type'                => fldText,
                            'maxlength'            => 100,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_passport_date',
                            'description'        => 'Паспорт. Дата видачі',
                            'type'                => fldDate,
                            'input'                => true,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'              => 'insurer_id_card',
                            'description'       => 'ID-карта',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dskv'),
                        array(
                            'name'              => 'insurer_newpassport_number',
                            'description'       => 'Страхувальник, паспорт, номер:',
                            'type'              => fldText,
                            'maxlength'         => 9,
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
                            'table'             => 'policies_dskv'),
                        array(
                            'name'              => 'insurer_newpassport_place',
                            'description'       => 'Страхувальник, паспорт, ким і де виданий:',
                            'type'              => fldInteger,
                            'maxlength'         => 15,
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
                            'table'             => 'policies_dskv'),
                        array(
                            'name'              => 'insurer_newpassport_date',
                            'description'       => 'Страхувальник, паспорт, дата видачі:',
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
                            'table'             => 'policies_dskv'),
                        array(
                            'name'              => 'insurer_newpassport_reestr',
                            'description'       => 'Страхувальник, паспорт, унікальний номер запису в реєстрі:',
                            'type'              => fldText,
                            'maxlength'         => 14,
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
                            'table'             => 'policies_dskv'),
                        array(
                            'name'              => 'insurer_newpassport_dateEnd',
                            'description'       => 'Страхувальник, паспорт, дійсний до:',
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
                            'table'             => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_identification_code',
                            'description'        => 'ІПН',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'validationRule'    => '^[0-9]{10}$',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_phone',
                            'description'        => 'Телефон',
                            'type'                => fldText,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_email',
                            'description'        => 'E-mail',
                            'type'                => fldEmail,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_regions_id',
                            'description'        => 'Область',
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
                            'table'                => 'policies_dskv',
                            'sourceTable'        => 'regions',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
						array(
                            'name'              => 'insurer_area',
                            'description'       => 'Район',
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
                            'table'             => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_city',
                            'description'        => 'Місто',
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
                            'table'                => 'policies_dskv'),
						array(
							'name'				=> 'insurer_street_types_id',
							'description'		=> 'Тип вулицi',
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
							'table'				=> 'policies_dskv',
							'sourceTable'		=> 'street_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
                        array(
                            'name'                => 'insurer_street',
                            'description'        => 'Вулиця',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_house',
                            'description'        => 'Будинок',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'insurer_flat',
                            'description'        => 'Квартира',
                            'type'                => fldText,
                            'maxlength'            => 4,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'begin_datetime',
                            'description'        => 'Початок',
                            'type'                => fldDate,
                            'input'                => true,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 7,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'end_datetime',
                            'description'        => 'Закінчення',
                            'type'                => fldDate,
                            'input'                => true,
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
                            'table'                => 'policies'),
                        array(
                            'name'              => 'interrupt_datetime',
                            'description'       => 'Закінчення',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 8,
                            'table'             => 'policies'),
                        array(
                            'name'                => 'assured_title',
                            'description'        => 'Вигодонабувач, ПІБ (назва)',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'assured_identification_code',
                            'description'        => 'Вигодонабувач, ІПН (ЄРДПОУ)',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'assured_address',
                            'description'        => 'Вигодонабувач, адреса',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'assured_phone',
                            'description'        => 'Вигодонабувач, телефон',
                            'type'                => fldText,
//                            'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'price',
                            'description'        => 'Сума, грн.',
                            'type'                => fldMoney,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 5,
                            'table'                => 'policies'),
                        array(
                            'name'              => 'discount',
                            'description'       => 'Знижка дилера, %',
                            'type'              => fldPercent,
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
                            'table'             => 'policies_dskv'),
						array(
                            'name'              => 'cart_discount',
                            'description'       => 'Знижка за карткою, %',
                            'type'              => fldPercent,
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
                            'table'             => 'policies_dskv'),
						array(
                            'name'              => 'card_car_man_woman',
                            'description'       => 'Номер картки CarMan@CarWoman',
                            'type'              => fldText,
							'maxlength'         => 13,
                            'validationRule'    => '^([0-9]{13}|[0-9]{13}\/[0-9]{13})|(ЕС[0-9]{4})$',
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
                            'table'             => 'policies_dskv'),
                        array(
                            'name'                => 'rate',
                            'description'        => 'Тариф, %',
                            'type'                => fldPercent,
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
                            'table'                => 'policies'),
                        array(
                            'name'                => 'amount',
                            'description'        => 'Премія, грн.',
                            'type'                => fldMoney,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 6,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'rate_dskv',
                            'description'        => 'Тариф, %',
                            'type'                => fldPercent,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'amount_dskv',
                            'description'        => 'Премія, грн.',
                            'type'                => fldMoney,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'rate_other',
                            'description'        => 'Тариф cтрахування відповідальності, %',
                            'type'                => fldPercent,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'amount_other',
                            'description'        => 'Премія cтрахування відповідальності, грн.',
                            'type'                => fldMoney,
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
                            'table'                => 'policies_dskv'),
                        array(
                            'name'                => 'policy_statuses_id',
                            'description'        => 'Статус',
                            'type'                => fldSelect,
							'showId'               => true,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 9,
                            'table'                => 'policies',
                            'sourceTable'        => 'policy_statuses',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'payment_statuses_id',
                            'description'        => 'Оплата',
                            'type'                => fldSelect,
							'showId'               => true,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 10,
                            'table'                => 'policies',
                            'sourceTable'        => 'payment_statuses',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'documents',
                            'description'        => 'Документи',
                            'type'                => fldBoolean,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => false,
                                    'change'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 11,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'commission',
                            'description'        => 'Комісія',
                            'type'                => fldBoolean,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => false,
                                    'change'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 12,
                            'table'                => 'policies'),
						array(
							'name'              => 'commission_agency_percent',
							'description'       => 'Комісія, агенція, %',
							'type'              => fldPercent,
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
							'table'             => 'policies_dskv'),
						array(
							'name'              => 'commission_agent_percent',
							'description'       => 'Комісія, агент, %',
							'type'              => fldPercent,
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
							'table'             => 'policies_dskv'),
                        array(
                            'name'                => 'created',
                            'description'        => 'Створено',
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
                            'table'                => 'policies'),
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
                            'orderPosition'        => 13,
                            'width'             => 100,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'is_bank',
                            'description'        => 'Банк',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 15,
                            'table'                => 'policies')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    => 13,
                        'defaultOrderDirection'    => 'desc',
                        'titleField'            => 'number'
                    )
                );

    function Policies_DSKV($data) {
        global $db;

        Policies::Policies($data);

        $this->objectTitle = 'Policies_DSKV';

        $this->messages['plural'] = 'Поліси "Добровільне страхування квартири та відповідальності"';
        $this->messages['single'] = 'Поліс "Добровільне страхування квартири та відповідальності"';

		$this->setPolicyStatusesSchema();
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      		=> true,
                    'insert'       		=> false,
                    'update'      		=> true,
                    'view'      		=> true,
                    'change'    		=> true,
                    'export'    		=> true,
                    'delete'    		=> true,
					'renewPolicy'		=> false,
					'continuePolicy'	=> false,
					'cancelPolicy'		=> false);
                break;
            case ROLES_ASSISTANCE:
                $this->permissions = array(
                    'show'      		=> true,
                    'insert'       		=> false,
                    'update'      		=> false,
                    'view'      		=> false,
                    'change'    		=> false,
                    'delete'    		=> false,
					'renewPolicy'		=> false,
					'continuePolicy'	=> false,
					'cancelPolicy'		=> false);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'      		=> true,
                    'insert'       		=> true,
                    'update'      		=> true,
                    'view'      		=> true,
                    'change'    		=> false,
                    'delete'    		=> false,
					'renewPolicy'		=> true,
					'continuePolicy'	=> true,
					'cancelPolicy'		=> true);

                $this->formDescription['fields'][ $this->getFieldPositionByName('documents') ]['display']['change'] = false;
                $this->formDescription['fields'][ $this->getFieldPositionByName('commission') ]['display']['change'] = false;

                break;
        }
    }

	//схема смены статусов для сертификатов
	function setPolicyStatusesSchema($roles_id =null) {
		global $POLICY_STATUSES_SCHEMA;

		$POLICY_STATUSES_SCHEMA = array(
			POLICY_STATUSES_CREATED =>
				array(
					POLICY_STATUSES_CREATED,
					POLICY_STATUSES_GENERATED),
			POLICY_STATUSES_GENERATED =>
				array(
					POLICY_STATUSES_GENERATED));
	}

    function setListValues($data, $actionType='show') {
        parent::setListValues($data, $actionType);

        $orderPosition = $this->getFieldPositionByName('products_id');

        if (!is_array($this->formDescription['fields'][ $orderPosition ]['list'])) {
            $this->formDescription['fields'][ $orderPosition ]['list'] = $this->getListValue($this->formDescription['fields'][ $orderPosition ], $data);
        }
    }

    function add($data) {
        global $db;

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_parameters_risks ' .
                'WHERE product_types_id = ' . intval($data['product_types_id']) . ' AND id IN(' . RISKS_FIRE2 . ',' . RISKS_HIJACKING2 . ')';
        $risks = $db->getAll($sql, 30 * 60);

        foreach ($risks as $risk) {
            $data['risks'][] =  $risk['id'];
        }

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_parameters_property_sections ' .
                'ORDER BY order_position ' .
                'LIMIT 1';
        $property_sections = $db->getAll($sql, 30 *60);

        foreach ($property_sections as $property_section) {
            $data['property_sections']['id'][] =  $property_section['id'];
        }

        parent::add($data);
    }

    function setConstants(&$data) {
		parent::setConstants($data);

        $data['insurance_companies_id'] = INSURANCE_COMPANIES_EXPRESS;

		if (!intval($data['cart_discount'])) {
       		$data[ 'card_car_man_woman' ] = '';
           	$this->formDescription['fields'][ $this->getFieldPositionByName('card_car_man_woman') ]['verification']['canBeEmpty'] = true;
		}

        if (!intval($data['notInsurerAddress'])) {
            $data['insurer_regions_id']   	= $data['regions_id'];
			$data['insurer_area']        	= $data['area'];
            $data['insurer_city']        	= $data['city'];
			$data['insurer_street_types_id']	= $data['street_types_id'];
            $data['insurer_street']      	= $data['street'];
            $data['insurer_house']       	= $data['house'];
            $data['insurer_flat']        	= $data['flat'];
        }

        //Новый пасспорт

        if(intval($data['insurer_id_card'])) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_series') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_place') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_date') ]['verification']['canBeEmpty'] = true;
        } else {
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_place') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_date') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_reestr') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_dateEnd') ]['verification']['canBeEmpty'] = true;
        }


        $Products = Products::factory($data, 'DSKV');
        $Products->calculate($data);
    }

    function checkFields(&$data, $action) {
        global $Log,$db;

        if (!$data['assured']) {
            $assured = array('assured_title', 'assured_identification_code', 'assured_address', 'assured_phone');

            foreach ($assured as $field) {
                $data[ $field ] = '';
                $this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['verification']['canBeEmpty'] = true;
            }
        }

        parent::checkFields($data, $action);

        $date = (checkdate(intval($data['date_month']), intval($data['date_day']), intval($data['date_year'])))
            ? mktime(0, 0, 0, intval($data['date_month']), intval($data['date_day']), intval($data['date_year']))
            : mktime(0, 0, 0, date('m')  , date('d'), date('Y'));
        $begin_datetime = (checkdate(intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year']))
            : 0;

        //проверка даты начала действия полиса
        if ($begin_datetime < $date) {
            $Log->add('error', '<b>Дата початку дії полісу</b> не може бути раніше ніж <b>Дата поліса</b>.');
		}

        $risks = $data['risks'];
        if (!is_array($risks)) $risks=array(0);

        $conditions[]='a.products_id='.intval($data['products_id']);
        $conditions[]='a.obligatory=1';
        $conditions[]='a.risks_id NOT IN ('.implode(' , ', $risks).')';



        $sql =  'SELECT b.title ' .
                    'FROM ' . PREFIX . '_product_risks a JOIN insurance_parameters_risks b ON b.id=a.risks_id ' .
                    'WHERE ' . implode(' AND ', $conditions);

        $obligatory_risks = $db->getCol($sql, 30 * 60);
        if (is_array($obligatory_risks) && sizeof($obligatory_risks)>0)
        {
            $Log->add('error', 'Ризики обов\'язкорвi до вибору: '.implode('; ', $obligatory_risks));
        }

        //Проверка даты окончания нового паспорта
        if(intval($data['insurer_id_card'])) {
            if(intval($data['insurer_newpassport_dateEnd_day']) !== intval($data['insurer_newpassport_date_day']) 
                || intval($data['insurer_newpassport_dateEnd_month']) !== intval($data['insurer_newpassport_date_month']) 
                || intval($data['insurer_newpassport_dateEnd_year']) !== (intval($data['insurer_newpassport_date_year']) + 10)) {
                $Log->add('error', 'Дата закінчення строку дії нового паспорту Страхувальника не відповідає нормам. Має бути Дата початку дії плюс 10 років.');
            }

        }

        //Проверка Кода органа що видав пасорту
        if(intval($data['insurer_id_card'])) {
            if(!intval($data['insurer_newpassport_place'])) {
                $Log->add('error', 'Поле "Паспорт. Ким і де виданий" Страхувальника має приймати тільки числові значення.');
            }

             if(!preg_match('/^\d{9}$/', $data['insurer_newpassport_number'])) {
                $Log->add('error', 'Поле "Паспорт. Номер" Страхувальника заповнено невірно.');
            }

            if(strlen($data['insurer_newpassport_reestr']) !== 14) {
                $Log->add('error', 'Поле "Унікальний номер запису в реєстрі" Страхувальника заповнено невірно.');
            }
        }
        
    }

    function setCommissions($id) {
        global $db;

		//вычисление итоговых сумм комиссионного вознаграждения
		$sql =	'SELECT ' .

				'SUM(' .
                '  round(a.amount * b.commission_agency_percent / 100, 2) ' .//сумма комиссионного вознаграждения агенции, считаем от страхового тарифа
				' ) as commission_agency_amount, ' .//сумма комиссионного вознаграждения агенции

                'SUM(  round(a.amount * b.commission_agent_percent / 100, 2) ' .//сумма комиссионного вознаграждения агенту, считаем от страхового тарифа
				' ) as commission_agent_amount ' .//сумма комиссионного вознаграждения агенту
  
				
				'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policies_dskv AS b ON a.id = b.policies_id ' .
				'WHERE a.id = ' . intval($id);
		$row =	$db->getRow($sql);

        $sql =	'UPDATE ' . PREFIX . '_policies SET ' .
                'commission_agency_percent = round(' . $db->quote($row['commission_agency_amount']) . ' / amount * 100, 2), ' .
                'commission_agent_percent = round(' . $db->quote($row['commission_agent_amount']) . ' / amount * 100, 2), ' .
                'commission_financial_institution_percent = 0 ' .
                'WHERE id = ' . intval($id);
        $db->query($sql);

        $sql =	'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'commission_agency_amount = ' . $db->quote($row['commission_agency_amount']) . ', ' .
                'commission_agent_amount = ' . $db->quote($row['commission_agent_amount']) . ', ' .
                'commission_financial_institution_amount = 0 ' .
                'WHERE policies_id = ' . intval($id);
        $db->query($sql);
    }

    function updatePropertySections($id, $property_sections) {
        global $db;

        $sql =  'DELETE FROM ' . PREFIX . '_policies_dskv_property_sections ' .
                'WHERE policies_id = ' . intval($id);
        $db->query($sql);

        $sql =  'INSERT INTO ' . PREFIX . '_policies_dskv_property_sections (policies_id, property_sections_id, value) ' .
                'SELECT ' . intval($id) . ', b.property_sections_id, b.value  ' .
                'FROM ' . PREFIX . '_policies as a ' .
                'JOIN ' . PREFIX . '_policies_dskv as p ON a.id=p.policies_id ' .
                'JOIN ' . PREFIX . '_product_property_sections as b ON p.products_id = b.products_id ' .
                'WHERE a.id = ' . $id . ' AND b.property_sections_id IN(' . implode(', ', $property_sections) . ')';
        $db->query($sql);
    }

	function setClient($data) {

        $values['agencies_id']	    			= 1469;
        $values['agents_id']				    = ($data['agencies_id'] == 1469) ? $data['agents_id'] : 0;
		$values['person_types_id']				= 1;

		$values['lastname']						= $data['insurer_lastname'];
		$values['firstname']					= $data['insurer_firstname']; 
		$values['patronymicname']				= $data['insurer_patronymicname'];
		$values['dateofbirth']					= $data['insurer_dateofbirth_year'] . '-' . $data['insurer_dateofbirth_month'] . '-' . $data['insurer_dateofbirth_day'];
		$values['dateofbirthYear']				= $data['insurer_dateofbirth_year'];
		$values['dateofbirthMonth']				= $data['insurer_dateofbirth_month'];
		$values['dateofbirthDay']				= $data['insurer_dateofbirth_day'];
		$values['passport_series']				= $data['insurer_passport_series'];
		$values['passport_number']				= $data['insurer_passport_number'];
		$values['passport_place']				= $data['insurer_passport_place'];
		$values['passport_date']				= $data['insurer_passport_date_year'] . '-' . $data['insurer_passport_date_month'] . '-' . $data['insurer_passport_date_day'];
		$values['passport_date_year']			= $data['insurer_passport_date_year'];
		$values['passport_date_month']			= $data['insurer_passport_date_month'];
		$values['passport_date_day']			= $data['insurer_passport_date_day'];
		$values['identification_code']			= $data['insurer_identification_code'];
		$values['mobile_phone']					= $data['insurer_phone'];
		$values['email']						= $data['insurer_email'];

		$values['registration_regions_id']		= $data['insurer_regions_id'];
		$values['registration_area']			= $data['insurer_area'];
		$values['registration_city']			= $data['insurer_city'];
		$values['registration_street_types_id']	= $data['insurer_street_types_id'];
		$values['registration_street']			= $data['insurer_street'];
		$values['registration_house']			= $data['insurer_house'];
		$values['registration_flat']			= $data['insurer_flat'];
		$values['registration_phone']			= $data['insurer_phone'];

		$values['habitation_regions_id']		= $data['insurer_regions_id'];
		$values['habitation_area']				= $data['insurer_area'];
		$values['habitation_city']				= $data['insurer_city'];
		$values['habitation_street_types_id']	= $data['insurer_street_types_id'];
		$values['habitation_street']			= $data['insurer_street'];
		$values['habitation_house']				= $data['insurer_house'];
		$values['habitation_flat']				= $data['insurer_flat'];
		$values['habitation_phone']				= $data['insurer_phone'];

		$values['card_car_man_woman']			= $data['card_car_man_woman'];

		$Clients = new Clients($values);
		return $Clients->fill($values);
	}

    function setAdditionalFields($id, $data) {
        global $db, $Log, $CLIENT_FILL_POLICY_STATUSES;

		$data['clients_id'] = 0;

		if (in_array($data['policy_statuses_id'], $CLIENT_FILL_POLICY_STATUSES) && !$data['skipClients']) {//фиксируем данные по клиенту только, если договор закрывается для редактирования, мусора меньше будет
			$data['clients_id'] = $this->setClient($data);
			$Log->clear();
		}

        $conditions[] = 'a.id = ' . intval($id);

        $sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_dskv AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_products_dskv AS c ON b.products_id = c.products_id ' .
                'JOIN ' . PREFIX . '_products AS d ON c.products_id = d.id ' .
                'JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id = e.id ' .
				'JOIN ' . PREFIX . '_product_types AS f ON a.product_types_id = f.id ' .
				'LEFT JOIN ' . PREFIX . '_policies AS h ON h.id = ' . intval($data['parent_id']) . ' SET ' .
				'a.parent_id = ' . intval($data['parent_id']) . ', ' .
				'a.top = IF(h.top > 0, h.top, ' . intval($id) . '), ' .
				'a.clients_id = ' . intval($data['clients_id']) . ', ' .
				'a.product_types_expense_percent = f.expense_percent, ' .
                'b.products_code = d.code, ' .
                'b.products_title = d.title, ' .
                'a.number = IF(a.number, a.number, ' . (($data['number']) ? $db->quote($data['number']) : 'CONCAT(d.code, \'.\', date_format(a.created, \'%y\'), \'.2\', ' . $db->quote(sprintf('%06d', $id)) . ')') . '), ' .
                'a.date = IF(TO_DAYS(a.date) > 0, a.date, NOW()), ' .
                'a.insurer = CONCAT(b.insurer_lastname, \' \', b.insurer_firstname), ' .
                'a.item = \'квартира\', ' .
				'a.interrupt_datetime = a.end_datetime, ' .
				'h.child_id = ' . intval($id) . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        $db->query($sql);

        $this->updatePropertySections($id, $data['property_sections']['id']);
        $this->updateRisks($id, $data['product_types_id'], $data['risks'],0);

        $PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
        $PolicyPaymentsCalendar->updateCalendar($id, $data);

        $this->setCommissions($id);
    }

    function updateRisks($id, $product_types_id, $risks, $products_id) {
        global $db;

        $sql =  'DELETE FROM ' . PREFIX . '_policy_risks ' .
                'WHERE policies_id = ' . intval($id);

        $db->query($sql);

        $sql =  'INSERT INTO ' . PREFIX . '_policy_risks (policies_id, risks_id) ' .
                'SELECT ' . intval($id) . ', id  ' .
                'FROM ' . PREFIX . '_parameters_risks AS a ' .
                'WHERE   id IN(' . implode(', ', $risks) . ') ';

        $db->query($sql);
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;

        $data['agencies_id']	= $Authorization->data['agencies_id'];
        $data['agents_id']	= $Authorization->data['id'];

        $data['id'] = parent::insert(&$data, false, false);

        if (intval($data['id'])) {

            $this->setAdditionalFields($data['id'], $data);

            $sql =  'UPDATE ' . PREFIX . '_policies_dskv SET ' .
                    'agent_lastname = ' . $db->quote($Authorization->data['lastname']) .  ', ' .
                    'agent_firstname =  ' . $db->quote($Authorization->data['firstname']) . ', ' .
                    'agent_patronymicname = ' . $db->quote($Authorization->data['patronymicname']) . ' ' .
                    'WHERE policies_id=' . intval($data['id']);
            $db->query($sql);

            $this->generateDocuments($data['id']);

            if ($redirect) {
				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
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

    function getDescriptionFilesNumber($policies_id) {
        global $db;

        $conditions[] = 'policies_id = ' . intval($policies_id);
        $conditions[] = 'product_document_types_id = ' . DOCUMENT_TYPES_POLICY_DSKV_DESCRIPTION;

        $sql =  'SELECT count(*) ' .
                'FROM ' . PREFIX . '_policy_documents ' .
                'WHERE ' . implode(' AND ', $conditions);
        return $db->getOne($sql);
    }

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        $sql =  'SELECT property_sections_id, value ' .
                'FROM ' . PREFIX . '_policies_dskv_property_sections ' .
                'WHERE policies_id = ' . intval($data['id']);
        $res =  $db->query($sql);

        while($res->fetchInto($row)) {
            $data['property_sections']['id'][ $row['property_sections_id'] ]     = $row['property_sections_id'];
            $data['property_sections']['value'][ $row['property_sections_id'] ]  = $row['value'];
        }

        $data['description'] = $this->getDescriptionFilesNumber($data['id']);

        return $data;
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log;

        if (parent::update(&$data, false, $showForm)) {

            $this->setAdditionalFields($data['id'], $data);

            $this->generateDocuments($data['id']);

            if ($redirect) {
				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
        }
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log;

        $PolicyPayments = new PolicyPayments($data);

        $sql =  'SELECT id ' .
                'FROM ' . $PolicyPayments->tables[0] . ' ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $PolicyPayments->messages['plural'] . '</b>.');
            return false;
        }

        return parent::deleteProcess($data, $i, $folder);
    }

    function get($id) {
        global $db;

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies as a ' .
                'JOIN ' . PREFIX . '_policies_dskv as b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        return $db->getRow($sql);
    }

    function prepareValues($fields, $values) {
        global $REGIONS;

        foreach ($fields as $field) {
            switch ($field) {
                case 'insurerTitle':
                    $values[ $field ] = $values['insurer_lastname'] . ' ' . $values['insurer_firstname'] . ' ' . $values['insurer_patronymicname'];
                    break;
                case 'insurer_address':
					$values[ $field ] = Regions::getTitle($values['insurer_regions_id']);

					if ($values['insurer_area']) {
                        $values[ $field ] .= ', ' . $values['insurer_area'] . ' р-н';
                    }

					if (!in_array($values['insurer_regions_id'], $REGIONS)) {
						$values[ $field ] .= ', ' . $values['insurer_city'];
					}

					$values[ $field ] .=  ', ' . StreetTypes::getTitle($values['insurer_street_types_id']) . ' ' . $values['insurer_street'] . ', буд. ' . $values['insurer_house'];

					if ($values['insurer_flat']) {
						$values[ $field ] .= ', кв. ' . $values['insurer_flat'];
					}
                    break;
                case 'flatAddress':
					$values[ $field ] = Regions::getTitle($values['regions_id']);

					if ($values['area']) {
                        $values[ $field ] .= ', ' . $values['area'] . ' р-н';
                    }

                    if (!in_array($values['regions_id'], $REGIONS)) {
                        $values[ $field ] .= ', ' . $values['city'];
                    }

                    $values[ $field ] .= ', ' . StreetTypes::getTitle($values['street_types_id']) . ' '  . $values['street'] . ', буд. ' . $values['house'] . ', кв. ' . $values['flat'];
                    break;
				case 'payed':
					$values[ $field ] = $this->isPayedBypayment_statuses_id($values['payment_statuses_id']);
					break;
				case 'closed':
					$values[ $field ] = $this->isClosedByPolicyStatusesId($values['policy_statuses_id']);
					break;
            }
        }

        return $values;
    }

    function getValues($file) {
        global $db;

        $sql =  'SELECT a.*, b.*, c.*, e.title as agencies_title, e.edrpou as agencies_edrpou, e.director1, e.director2, e.ground_kasko_express as ground_kasko, DATE_SUB(begin_datetime, INTERVAL 1 DAY) as endPaymentDate ' .
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . $this->tables[0] . ' AS b ON a.policies_id = b.id ' .
                'JOIN ' . $this->tables[1] . ' AS c ON b.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS e ON b.agencies_id = e.id ' .
                'WHERE a.id=' . intval($file['id']);
        $row = $db->getRow($sql);

        $row['risks'] = ParametersRisks::getArrayByPoliciesId($row['policies_id']);
        $row['property_sections'] = ParametersPropertySections::getArrayByPoliciesId($row['policies_id']);

        switch ($row['product_document_types_id']) {
            case DOCUMENT_TYPES_POLICY_DSKV_APPLICATION://заявление
            case DOCUMENT_TYPES_POLICY_DSKV_AGREEMENT://полис ДСКВ
                if (in_array(RISKS_PDTO, $row['risks']) || in_array(RISKS_HIJACKING2, $row['risks'])) {
                    if ($this->getDescriptionFilesNumber($row['policies_id']) == 0) {//если не приложено описание имущества, то печатать не даем
                        $row['policy_statuses_id'] = POLICY_STATUSES_CREATED;
                    }
                }

                $fields = array(
                    'insurerTitle',
                    'insurer_address',
                    'flatAddress',
					'closed',
					'payed');
                break;
            case POLICY_DOCUMENT_TYPES_POLICY_DSKV_BILL://счет
                $fields = array('payed');
                break;
        }

        return $this->prepareValues($fields, $row);
    }

	/* Export 1C7.7. */
    function getXML($data) {
        global $db, $Smarty;

        if ($data['number']) {
            $conditions[] = 'a.number = ' . $db->quote($data['number']);
        } else {
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.modified ) >= TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.modified ) >= TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.modified ) <= TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.modified ) <= TO_DAYS(NOW())';
			$conditions[] = 'a.policy_statuses_id = ' . POLICY_STATUSES_GENERATED;
        }

        $sql =  'SELECT b.*, a.date,' .
                'a.begin_datetime, ' .
                'a.end_datetime ,  ' .
                'a.modified as modifiedDate, ' .
                'a.created, ' .
                'a.begin_datetime as payment_datetime, ' .
                'a.policy_statuses_id, \'\' as payment_number, a.number, '.
                'a.item, a.price, a.rate, a.amount,  '.
				'1 as person_types_id,  '.
                'd.title as insurerRegionsTitle ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_dskv AS b ON b.policies_id=a.id ' .
                'JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id=c.id ' .
                'LEFT JOIN ' . PREFIX . '_regions AS d ON b.insurer_regions_id=d.id ' .
                'JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id=e.id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        foreach ($list as $i=>$row) {
            $sql =  'SELECT date as payment_date, amount as payment_amount ' .
                    'FROM ' . PREFIX . '_policy_payments_calendar ' .
                    'WHERE policies_id = ' . intval($row['policies_id']);
            $list[$i]['paymentsCalendar'] = $db->getAll($sql);

            $fields = array('insurer_address');

            $row = $this->prepareValues($fields, $row);

            $list[$i]['insurer_address'] = $row['insurer_address'];

			$list[$i]['risks'] = ParametersRisks::getArrayByPoliciesId($row['policies_id']);
			$list[$i]['property_sections'] = ParametersPropertySections::getArrayByPoliciesId($row['policies_id']);
        }

        $Smarty->assign('list', $list);
		return $Smarty->fetch($this->object . '/dskv.xml');
    }
}

?>