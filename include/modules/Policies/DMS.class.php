<?
/*
 * Title: policy Transporter class
 *
 * @author 
 * @email 
 * @version 3.0
 */
 
require_once 'DMSCalculation.class.php';
require_once 'DMSServices.class.php';
require_once 'DMSRegisterAct.class.php';

class Policies_DMS extends Policies {

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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies'),
                        array(
                            'name'              => 'agencies_id',
                            'description'       => 'Агенція',
                            'type'              => fldSelect,
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
                            'orderPosition'     => 16,
                            'table'             => 'policies',
                            'sourceTable'       => 'agencies',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'agents_id',
                            'description'       => 'Агент',
                            'type'              => fldSelect,
							'condition'			=> 'roles_id = 8',
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
                            'orderPosition'     => 17,
                            'table'             => 'policies',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'clients_id',
                            'description'       => 'clients_id',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies'),
                        array(
                            'name'              => 'product_types_id',
                            'description'       => 'Тип',
                            'type'              => fldHidden,
                            'structure'         => 'tree',
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
                            'orderPosition'     => 1,
                            'table'             => 'policies',
                            'sourceTable'       => 'product_types',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'insurer',
                            'description'       => 'Страхувальник',
                            'type'              => fldText,
                            'maxlength'         => 100,
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
                            'orderPosition'     => 4,
                            'table'             => 'policies'),						 
						/*array(
                            'name'              => 'insurer_identification_code',
                            'description'       => 'Страхувальник, IПН',
                            'type'              => fldText,
							'validationRule'	=> '^[0-9]{8,10}$',
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
                            'table'             => 'policies_dms'),*/
                        array(
                            'name'              => 'insurer_dateofbirth',
                            'description'       => 'Страхувальник, дата народження',
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
                            'table'             => 'policies_dms'),

                        array(
                            'name'              => 'insurer_lastname',
                            'description'       => 'Страхувальник, прізвище',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_firstname',
                            'description'       => 'Страхувальник, ім\'я',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_patronymicname',
                            'description'       => 'Страхувальник, по батькові',
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
                            'table'             => 'policies_dms'),
						array(
                            'name'              => 'insurer_passport_series',
                            'description'       => 'Страхувальник, паспорт, серія',
                            'type'              => fldText,
                            'maxlength'         => 2,
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_passport_number',
                            'description'       => 'Страхувальник, паспорт, номер',
                            'type'              => fldText,
                            'maxlength'         => 13,
                            'validationRule'	=> '[0-9]{6}',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_passport_place',
                            'description'       => 'Страхувальник, паспорт, ким і де виданий',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_passport_date',
                            'description'       => 'Страхувальник, паспорт, дата видачі',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_id_card',
                            'description'       => 'ID карта',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_newpassport_number',
                            'description'       => 'Номер нового паспорту',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_newpassport_place',
                            'description'       => 'Ким і де виданий новий паспорт',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_newpassport_date',
                            'description'       => 'Дата видачі нового паспорту',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_newpassport_reestr',
                            'description'       => 'Унікальний номер запису в реєстрі',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_newpassport_dateEnd',
                            'description'       => 'Дата закінчення строку дії паспорту',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_id_card',
                            'description'       => 'ID карта',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_newpassport_number',
                            'description'       => 'Номер нового паспорту',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_newpassport_place',
                            'description'       => 'Ким і де виданий новий паспорт',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_newpassport_date',
                            'description'       => 'Дата видачі нового паспорту',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_newpassport_reestr',
                            'description'       => 'Унікальний номер запису в реєстрі',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_newpassport_dateEnd',
                            'description'       => 'Дата закінчення строку дії паспорту',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_phone',
                            'description'       => 'Страхувальник, телефон',
                            'type'              => fldText,
                            'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_email',
                            'description'       => 'Страхувальник, e-mail',
                            'type'              => fldEmail,
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_regions_id',
                            'description'       => 'Страхувальник, область',
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
                            'table'             => 'policies_dms',
                            'sourceTable'       => 'regions',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'insurer_area',
                            'description'       => 'Страхувальник, район',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_city',
                            'description'       => 'Страхувальник, місто',
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
                            'table'             => 'policies_dms'),
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
							'table'				=> 'policies_dms',
							'sourceTable'		=> 'street_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
                        array(
                            'name'              => 'insurer_street',
                            'description'       => 'Страхувальник, вулиця',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_house',
                            'description'       => 'Страхувальник, будинок',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insurer_flat',
                            'description'       => 'Страхувальник, квартира',
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
                            'table'             => 'policies_dms'),                            
                        /*array(
                            'name'              => 'insured_identification_code',
                            'description'       => 'Застрахована особа, IПН',
                            'type'              => fldText,
							'validationRule'	=> '^[0-9]{8,10}$',
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
                            'table'             => 'policies_dms'),*/
                        array(
                            'name'              => 'insured_dateofbirth',
                            'description'       => 'Застрахована особа, дата народження',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_lastname',
                            'description'       => 'Застрахована особа, прізвище',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_firstname',
                            'description'       => 'Застрахована особа, ім\'я',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_patronymicname',
                            'description'       => 'Застрахована особа, по батькові',
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
                            'table'             => 'policies_dms'),
						array(
                            'name'              => 'insured_passport_series',
                            'description'       => 'Застрахована особа, паспорт, серія',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_passport_number',
                            'description'       => 'Застрахована особа, паспорт, номер',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_passport_place',
                            'description'       => 'Застрахована особа, паспорт, ким і де виданий',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_passport_date',
                            'description'       => 'Застрахована особа, паспорт, дата видачі',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_phone',
                            'description'       => 'Застрахована особа, телефон',
                            'type'              => fldText,
                            'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_email',
                            'description'       => 'Застрахована особа, e-mail',
                            'type'              => fldEmail,
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_regions_id',
                            'description'       => 'Застрахована особа, область',
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
                            'table'             => 'policies_dms',
                            'sourceTable'       => 'regions',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'insured_area',
                            'description'       => 'Застрахована особа, район',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_city',
                            'description'       => 'Застрахована особа, місто',
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
                            'table'             => 'policies_dms'),
						array(
							'name'				=> 'insured_street_types_id',
							'description'		=> 'Застрахована особа, Тип вулицi',
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
							'table'				=> 'policies_dms',
							'sourceTable'		=> 'street_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
                        array(
                            'name'              => 'insured_street',
                            'description'       => 'Застрахована особа, вулиця',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_house',
                            'description'       => 'Застрахована особа, будинок',
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
                            'table'             => 'policies_dms'),
                        array(
                            'name'              => 'insured_flat',
                            'description'       => 'Застрахована особа, квартира',
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
                            'table'             => 'policies_dms'),
						array(
							'name'				=> 'deductible',
							'description'		=> 'Франшиза, %',
							'type'				=> fldPercent,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'policies_dms'),	
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
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 2,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'date',
                            'description'       => 'Дата полісу',
                            'type'              => fldDate,
                            'input'             => true,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 3,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'begin_datetime',
                            'description'       => 'Початок',
                            'type'              => fldDate,
                            'input'             => true,
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
                            'orderPosition'     => 9,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'end_datetime',
                            'description'       => 'Закінчення',
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
                            'table'             => 'policies'),
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
                            'orderPosition'     => 10,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'price',
                            'description'       => 'Сума, грн.',
                            'type'              => fldMoney,
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
                            'orderPosition'     => 6,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'rate',
                            'description'       => 'Тариф, %',
                            'type'              => fldPercent,
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
                            'orderPosition'     => 7,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'amount',
                            'description'       => 'Премія, грн.',
                            'type'              => fldMoney,
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
                            'orderPosition'     => 8,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'amount_parent',
                            'description'       => 'Премія, грн.',
                            'type'              => fldMoney,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies'),
                        array(
                            'name'              => 'policy_statuses_id',
                            'description'       => 'Статус',
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
                            'orderPosition'     => 11,
                            'table'             => 'policies',
                            'sourceTable'       => 'policy_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
						array(
                            'name'              => 'states_id',
                            'description'       => 'Состояние',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      	=> false,
                                    'insert'    	=> true,
                                    'view'      	=> true,
                                    'update'		=> true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies',
                            'sourceTable'       => 'policy_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'payment_statuses_id',
                            'description'       => 'Оплата',
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
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 12,
                            'table'             => 'policies',
                            'sourceTable'       => 'payment_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'documents',
                            'description'       => 'Документи',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false,
                                    'change'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 13,
                            'table'             => 'policies'), 
                        array(
                            'name'              => 'insurance_companies_id',
                            'description'       => 'Страхова компанiя',
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
                            'table'             => 'policies',
                            'sourceTable'       => 'companies',
                            'selectField'       => 'title',
                            'condition'         => 'id IN (4,9)',
                            'orderField'        => 'id'),
						array(
                            'name'              => 'types_id',
                            'description'       => 'Тип договору',
                            'type'              => fldSelect,
							'list'				=> array(
								1 =>	'ОПЕРАТИВНЕ ХІРУРГІЧНЕ ЛІКУВАННЯ',
								2 =>	'КОНСЕРВАТИВНЕ  ЛІКУВАННЯ',
								3 =>	'Підпрограма 1',
								4 =>	'Підпрограма 2'
							),
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
                            'table'             => 'policies_dms'),
						array(
                            'name'              => 'diagnosis',
                            'description'       => 'Діагноз',
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
                            'table'             => 'policies_dms'),
						array(
                            'name'              => 'commission',
                            'description'       => 'Комісія',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false,
                                    'change'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 14,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies'),
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
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 15,
                            'width'             => 100,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'is_bank',
                            'description'       => 'Банк',
                            'type'              => fldHidden,
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
                            'orderPosition'     => 18,
                            'table'             => 'policies')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 15,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'number'
                    )
                );

		

    function Policies_DMS($data) {
        Policies::Policies($data);

        $this->objectTitle = 'Policies_DMS';

        $this->messages['plural'] = 'Договори "ДМС"';
        $this->messages['single'] = 'Договір "ДМС"';
		
		$this->setSubMode($data);

		$this->setPolicyStatusesSchema(null, &$data);
    }
	
	 function setSubMode($data) {
        global $db, $UNDERWRITING_POLICY_STATUSES;

        if ($data['policies_id']) {
            $data['id'] = $data['policies_id'];
        } elseif (is_array($data['id'])) {
            $data['id'] = $data['id'][0];
        }

        switch ($data['do']) {
            case $this->object . '|add':
            case $this->object . '|insert':
            case $this->object . '|copy':
                $this->subMode = ($data['types_id'] == POLICY_TYPES_QUOTE) ? 'set' : 'calculate';
                break;
            case $this->object . '|load':

                $sql =	'SELECT types_id, policy_statuses_id ' .
                        'FROM ' . PREFIX . '_policies ' .
                        'WHERE id = ' . intval($data['id']);
                $row =	$db->getRow($sql);

                $this->subMode = ( ($row['policy_statuses_id'] == POLICY_STATUSES_CREATED && $row['types_id'] == POLICY_TYPES_QUOTE) || in_array($row['policy_statuses_id'], $UNDERWRITING_POLICY_STATUSES) || $data['types_id'] == POLICY_TYPES_QUOTE) ? 'set' : 'calculate';
                break;
            case $this->object . '|update':
                $this->subMode = ($data['types_id'] == POLICY_TYPES_QUOTE) ? 'set' : 'calculate';
                break;
            case $this->object . '|renewPolicy':
            case $this->object . '|continuePolicy':
            case $this->object . '|cancelPolicy':
            case $this->object . '|loadPolicy':
                $this->subMode = 'calculate';
                break;
        }
        if ($this->subMode) {
            $_SESSION[ 'Policies' ][ $data['id'] ]['subMode'] = $this->subMode;
        }
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      		=> true,
                    'insert'       		=> true,
                    'quote'             => true,
                    'update'      		=> true,
                    'view'      		=> true,
                    'change'    		=> true,
					'reset'     		=> true,
                    'delete'    		=> true,
					'export'    		=> true,
                    'exportActions'     => true,
					'renewPolicy'		=> false,
					'continuePolicy'	=> false,
					'cancelPolicy'		=> true);
                break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'				=> true,
                    'insert'			=> true,
                    'copy'			    => true,
                    'quote'			    => true,
                    'update'     		=> true,
                    'view'      		=> true,
                    'change'    		=> false,
                    'delete'    		=> false,
					'renewPolicy'		=> true,
					'continuePolicy'	=> true,
					'cancelPolicy'		=> true,
					'export'    		=> true);

				$this->formDescription['fields'][ $this->getFieldPositionByName('documents') ]['display']['change'] = false;
                $this->formDescription['fields'][ $this->getFieldPositionByName('commission') ]['display']['change'] = false;
                break;
        }
    }

	//схема смены статусов для сертификатов
	function setPolicyStatusesSchema($roles_id=null, $data=null) {
		global $Authorization, $POLICY_STATUSES_SCHEMA;
		if (is_null($roles_id)) {
			$roles_id = $Authorization->data['roles_id'];
		}

		switch ($roles_id) {
			case ROLES_ADMINISTRATOR:
			case ROLES_MANAGER:
				$POLICY_STATUSES_SCHEMA = array(
						POLICY_STATUSES_CREATED =>
							array(
								POLICY_STATUSES_CREATED,
								POLICY_STATUSES_REQUEST_QUOTE , 
								POLICY_STATUSES_REQUEST_QUOTE_ERROR,
								POLICY_STATUSES_QUOTE,
								POLICY_STATUSES_GENERATED),
						POLICY_STATUSES_REQUEST_QUOTE	=>//запрос котировки к андеррайтеру
							array(
								POLICY_STATUSES_REQUEST_QUOTE,
								POLICY_STATUSES_REQUEST_QUOTE_ERROR,
								POLICY_STATUSES_QUOTE,
								POLICY_STATUSES_GENERATED),
						POLICY_STATUSES_REQUEST_QUOTE_ERROR	=>//ошибка в запросе к андеррайтеру
							array(
								POLICY_STATUSES_REQUEST_QUOTE_ERROR,
								POLICY_STATUSES_REQUEST_QUOTE_AGAIN,
								POLICY_STATUSES_GENERATED
								),
						POLICY_STATUSES_REQUEST_QUOTE_AGAIN	=>//повторный запрос котировки к андеррайтеру
							array(
								POLICY_STATUSES_REQUEST_QUOTE_AGAIN,
								POLICY_STATUSES_REQUEST_QUOTE_ERROR,
								POLICY_STATUSES_QUOTE,POLICY_STATUSES_GENERATED),
						POLICY_STATUSES_QUOTE	=>//котировка от андеррайтера
							array(
								POLICY_STATUSES_QUOTE,
								POLICY_STATUSES_REQUEST_AGREEMENT,POLICY_STATUSES_GENERATED),
						POLICY_STATUSES_REQUEST_AGREEMENT	=>//запрос договора страхования
							array(
								POLICY_STATUSES_REQUEST_AGREEMENT,
								POLICY_STATUSES_REQUEST_QUOTE_ERROR,
								 POLICY_STATUSES_GENERATED),
						POLICY_STATUSES_GENERATED =>
							array(
								POLICY_STATUSES_GENERATED),
						POLICY_STATUSES_CANCELLED =>
							array(
								POLICY_STATUSES_CANCELLED),
						POLICY_STATUSES_CONTINUED =>
							array(
								POLICY_STATUSES_CONTINUED),
						POLICY_STATUSES_RENEW =>
							array(
								POLICY_STATUSES_RENEW)
							);
				break;
			case ROLES_AGENT:
				$POLICY_STATUSES_SCHEMA = array(
					POLICY_STATUSES_CREATED =>
						array(
							POLICY_STATUSES_CREATED,
							($this->subMode == 'set' ? POLICY_STATUSES_REQUEST_QUOTE : (intval($data['next_policy_statuses_id']) ? $data['next_policy_statuses_id'] : POLICY_STATUSES_GENERATED))
						),
					POLICY_STATUSES_REQUEST_QUOTE	=>//запрос котировки к андеррайтеру
						array(
							POLICY_STATUSES_REQUEST_QUOTE),
					POLICY_STATUSES_REQUEST_QUOTE_ERROR	=>//ошибка в запросе к андеррайтеру
						array(
							POLICY_STATUSES_REQUEST_QUOTE_ERROR,
							POLICY_STATUSES_REQUEST_QUOTE_AGAIN),
					POLICY_STATUSES_REQUEST_QUOTE_AGAIN	=>//повторный запрос котировки к андеррайтеру
						array(
							POLICY_STATUSES_REQUEST_QUOTE_AGAIN),
					POLICY_STATUSES_QUOTE	=>//котировка от андеррайтера
						array(
							POLICY_STATUSES_QUOTE,
							POLICY_STATUSES_REQUEST_AGREEMENT),
					POLICY_STATUSES_REQUEST_AGREEMENT	=>//запрос договора страхования
						array(
							POLICY_STATUSES_REQUEST_AGREEMENT),
					POLICY_STATUSES_GENERATED =>
						array(
							POLICY_STATUSES_GENERATED),
					POLICY_STATUSES_CANCELLED =>
						array(
							POLICY_STATUSES_CANCELLED),
					POLICY_STATUSES_RENEW =>
						array(
							POLICY_STATUSES_RENEW),
					POLICY_STATUSES_CONTINUED =>
						array(
							POLICY_STATUSES_CONTINUED)
						);
				break;
		}
	}
	
	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {	
		parent::show($data, $fields, $conditions, $sql, $template, $limit);
		
		$DMSRegisterAct = new DMSRegisterAct($data);
		$DMSRegisterAct->show($data);
		
		$DMSServices = new DMSServices($data);
		$DMSServices->show($data);
	}

	function add($data) {

		if (intval($data['policy_statuses_id'])==0) {
			$data['policy_statuses_id'] = 1;
		}
		/*if ($_SESSION['auth']['agent_financial_institutions_id']==39)//универсал
			$data['types_id']=2;*/

		$this->setSubMode($data);
		$this->setPolicyStatusesSchema(null, &$data);
		return parent::add($data);
	}
	
	function getListValue($field, $data) {
        global $db;
		if ($field['name']!='values_id')
			return parent::getListValue($field, $data);
        reset($this->languages);

        $languageCode = ($field['multiLanguages'])
            ? $this->languageCode
            : '';

        $options = (($field['verification']['canBeEmpty']) && $field['type'] == fldSelect) ? array('0' => '...') : array();

        switch ($field['structure']) {
            case 'tree':
                $this->getOptions($field, $languageCode, $options);
                break;
            default:
                if ($field['condition']) {
                    $where = ' WHERE ' . $field['condition'];
                }

                if (!$field['selectId'])
                    $field['selectId'] = 'id';

                $field['orderField'] = ($field['selectField'] == $field['orderField'])
                    ? $field['orderField'] . $languageCode
                    : $field['orderField'];

                $sql =	'SELECT ' . $field['selectId'] . ' AS id, ' . $field['selectField'] . $languageCode . ' AS title ' .($field['name']=='risks_id' ? ', group_title AS optgroup ':' ').($field['name']=='values_id' ? ', types_id AS types_id ':' ').
						'FROM ' . PREFIX . '_' . $field['sourceTable'] . $where . ' ' .
						'ORDER BY ' . $field['orderField'];
                $list = $db->getAll($sql, 300);

                if (is_array($list)) {
                    foreach ($list as $row) {
                        $options[ $row['id'] ] = array(
                            'title' => $row['title'],
                            'obligatory' => $row['obligatory'],
							'optgroup' => $row['optgroup'],
                            'types_id' => $row['types_id']);
                    }
                }
				break;
        }

        return $options;
    }
	
    function buildSelect($field, $value, $languageCode=null, $addition=null, $indexType=null, $data=null, $class=null) {
 
		if ($data['block_id'] && $field['name']=='values_id') {

            $list = $field['list']; 
            $field['list'] = array();
			if ($data['block_id'] == 4 || $data['block_id'] == 5) {
				 $field['list'][0] = array('title' => '...');
			}
            foreach($list as $i=>$row) {
                if ($row['block_id']==$data['block_id']) {
                    $field['list'][$i] = $row;
				}
            }

            $field['name'] .= $data['block_id'];
        }
		
		 if ($data['types_id'] && $field['name']=='values_id') {

            $list = $field['list']; 
            $field['list'] = array();

            foreach($list as $i=>$row) {
                if ($row['types_id']==$data['types_id']) {
                    $field['list'][$i] = $row;
				}
            }

            $field['name'] .= $data['types_id'];
        }
		
		$result = parent::buildSelect($field, $value, $languageCode, $addition, $indexType, $data, $class);

		if  ($field['name'] == 'sign_agents_id') {
			$result = str_replace ( '...' , 'директор підприємства' , $result );
		}

        return $result;
    }

	function changeStep($data) {
        switch ($data['step']) {
            case 1:
                $action = ($this->mode == 'update') ? 'load' : 'view';
                header('Location: /?do=' . $this->object . '|' . $action . '&id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
                break;

            default:
                header('Location: /?do=' . $this->object . '|show');
                exit;
                break;
        }
    }
    
    function getFormFields($action) {
        parent::getFormFields($action);
    }

	function showForm($data, $action, $actionType=null, $template=null) {
        global $db, $Authorization, $POLICY_STATUSES_SCHEMA;

		$sql =	'SELECT a.id, a.title ' .
				'FROM ' . PREFIX . '_parameters_risks AS a ' .		
				//'JOIN ' . PREFIX . '_product_risks AS b ON a.id = b.risks_id ' .
				'WHERE a.product_types_id = ' . PRODUCT_TYPES_DMS . ' ' .
				'ORDER BY a.title';
		$data['risks'] = $db->getAll($sql);

        if (!intval($data['policies_id'])) {
            $data['policies_id'] = $data['id'];
        }

        if ($this->getFieldPositionByName('policy_statuses_id')) {

            if (!intval($data['policy_statuses_id'])) {
                $data['policy_statuses_id'] = ($data['id']) ? $this->getPolicyStatusesId($data['policies_id']) : POLICY_STATUSES_CREATED;
            }

            $this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ]['condition'] = 'id IN(' . implode(', ', $POLICY_STATUSES_SCHEMA[ $data['policy_statuses_id'] ]) . ')';
		}

        switch ($action) {
            case 'view':
                $action = $this->mode . 'Objects';
            case 'insert':
            case 'update':
                $data['step'] = 1;
                break;
		 
                break;
        }

        if (!$_POST['InWindow'] && $data['mode'] != 'simple') {
            $this->header($data);
        }

        Form::showForm($data, $action, $actionType, ($template) ? $template : strtolower(ProductTypes::get($data['product_types_id'])) . '.php');

        if (!$_POST['InWindow'] && $data['mode'] != 'simple') {
            $this->footer($data);
        }
    }

    function setConstants(&$data) {

		if (!intval($data['policy_statuses_id'])) {
			$data['policy_statuses_id'] = POLICY_STATUSES_CREATED;
		}

		if (!intval($data['date_day']) || !intval($data['date_month']) || !intval($data['date_year'])) {
			$data['date_day']	= date('d');
			$data['date_month']	= date('m');
			$data['date_year']	= date('Y');
		}
		
		if (!intval($data['begin_datetime_day']) || !intval($data['begin_datetime_month']) || !intval($data['begin_datetime_year'])) {
			$data['begin_datetime_day']	= date('d');
			$data['begin_datetime_month']	= date('m');
			$data['begin_datetime_year']	= date('Y');
		}
		
		if (!intval($data['end_datetime_day']) || !intval($data['end_datetime_month']) || !intval($data['end_datetime_year'])) {
			$data['end_datetime_day']	= date('d', mktime(0, 0, 0, $data['begin_datetime_month'], $data['begin_datetime_day'] - 1, $data['begin_datetime_year'] + 1));
			$data['end_datetime_month']	= date('m', mktime(0, 0, 0, $data['begin_datetime_month'], $data['begin_datetime_day'] - 1, $data['begin_datetime_year'] + 1));
			$data['end_datetime_year']	= date('Y', mktime(0, 0, 0, $data['begin_datetime_month'], $data['begin_datetime_day'] - 1, $data['begin_datetime_year'] + 1));
		}
        
		switch ($data['types_id']) {
			case 1:
				$data['price'] = 8500;
				$data['rate'] = 0.2;
				$data['amount'] = 1700;
				break;
			case 2:
				$data['price'] = 8500;
				$data['rate'] = 0.2;
				$data['amount'] = 1700;
				break;
			case 3:
				$data['price'] = 1350;
				$data['rate'] = 0.2;
				$data['amount'] = 270;
				break;
			case 4:
				$data['price'] = 3600;
				$data['rate'] = 0.2;
				$data['amount'] = 720;
				break;
			default:
				$data['price'] = 0;
				$data['rate'] = 0;
				$data['amount'] = 0;
				break;
		}        
        $data['insurer'] = $data['insurer_lastname'] . ' ' . $data['insured_firstname'];
        
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

        if(intval($data['insured_id_card'])) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('insured_passport_series') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insured_passport_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insured_passport_place') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insured_passport_date') ]['verification']['canBeEmpty'] = true;
        } else {
            $this->formDescription['fields'][ $this->getFieldPositionByName('insured_newpassport_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insured_newpassport_place') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insured_newpassport_date') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insured_newpassport_reestr') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insured_newpassport_dateEnd') ]['verification']['canBeEmpty'] = true;
        }
  
        return parent::setConstants($data);
    }

    function checkFields(&$data, $action) {
        global $db, $Log, $Authorization;
		if ($data['types_id'] == 3 || $data['types_id'] == 4) {
			$empty_fields = array(
				'insured_passport_series',
				'insured_passport_number',
				'insured_passport_place',
				'insured_passport_date',
				'insured_phone',
				
				'insurer_passport_series',
				'insurer_passport_number',
				'insurer_passport_place',
				'insurer_passport_date',
				'insurer_phone',

                'insurer_newpassport_number',
                'insurer_newpassport_place',
                'insurer_newpassport_date',
                'insurer_newpassport_reestr',
                'insurer_newpassport_dateEnd',

                'insured_newpassport_number',
                'insured_newpassport_place',
                'insured_newpassport_date',
                'insured_newpassport_reestr',
                'insured_newpassport_dateEnd',
			);
			foreach($empty_fields as $f) 
			{
				$this->formDescription['fields'][ $this->getFieldPositionByName($f) ]['verification']['canBeEmpty'] = true;
			}
	
		}
		
		if ($data['insurance_companies_id'] == 9 || $data['types_id'] == 3 || $data['types_id'] == 4) {
			$this->formDescription['fields'][ $this->getFieldPositionByName('number') ]['display']['insert'] = true;
			$this->formDescription['fields'][ $this->getFieldPositionByName('number') ]['display']['update'] = true;
			if ($data['insurance_companies_id'] == 9) {
				if (!preg_match('/^([0-9]{2}-[0-9]{6})$/', $data['number'], $matches)) {
					$Log->add('error', 'Формат номера <b>' . $data['number'] . '</b> не вірний.');
				}
			}
		}

		parent::checkFields($data, $action);

		if ($data['number'] && !$data['parent_id']) {
			if ($this->isExists($this->tables[0], 'number', $data['number'], $data['id'], $data)) {
				$Log->add('error', 'Поліс з номером <b>' . $data['number'] . '</b> вже існує.');
			}
		}

		$date = (checkdate($data['date_month'], $data['date_day'], $data['date_year']))
			? mktime(0, 0, 0, $data['date_month'], $data['date_day'], $data['date_year'])
			: 0;

		$begin_datetime = (checkdate($data['begin_datetime_month'], $data['begin_datetime_day'], $data['begin_datetime_year']))
			? mktime(0, 0, 0, $data['begin_datetime_month'], $data['begin_datetime_day'], $data['begin_datetime_year'])
			: 0;

		$end_datetime = (checkdate($data['end_datetime_month'], $data['end_datetime_day'], $data['end_datetime_year']))
			? mktime(0, 0, 0, $data['end_datetime_month'], $data['end_datetime_day'], $data['end_datetime_year'])
			: 0;

		if ($begin_datetime>0 && $end_datetime>0) {
			if ($end_datetime <= $begin_datetime) {//Дата начала действия меньше чем дата окончания
				$Log->add('error', '<b>Дата початку дії полісу</b> не може бути більше ніж <b>Дата закінчення</b>.');
			}
		}

		//проверка даты начала действия полиса
		if ($begin_datetime != 0 && $begin_datetime < $date) {
			$Log->add('error', '<b>Дата початку дії полісу</b> не може бути раніше ніж <b>Дата поліса</b>.');
		}

		 
		if ($data['amount_parent'] < 0) {//!!! надо будет перенести в глобальную проверку
			$Log->add('error', '<b>Залишок від сплаченної страхової премії</b> не може бути відємним');
		}

		//проверка графика платежей
		$amount = 0;
		if (is_array($data['payments'])) {
			foreach ($data['payments'] as $payment) {
				if (!checkdate(substr($payment['date'], 3, 2), substr($payment['date'], 0, 2), substr($payment['date'], 6, 4))) {
                    $params = array('Строки сплати страхового платежу, дата', null);
					$Log->add('error', 'The date <b>%s</b>%s is not valid.', $params);
				} else if ($date > mktime(0, 0, 0, substr($payment['date'], 3, 2), substr($payment['date'], 0, 2), substr($payment['date'], 6, 4))) {
					$Log->add('error', 'Сплата страхової премії згідно графіка раніше дати укладання полісу.');
				} else {
					$date = mktime(0, 0, 0, substr($payment['date'], 3, 2), substr($payment['date'], 0, 2), substr($payment['date'], 6, 4));

					if ($date > $end_datetime) {
						$Log->add('error', 'Дата сплати страхової премії пізніше ніж дата закінчення дії договору страхування.');
					}
				}

                if ($payment['amount'] == '') {
                    $params = array('Строки сплати страхового платежу, сума, грн.', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidMoney($payment['amount'])) {
                    $params = array('Строки сплати страхового платежу, сума, грн.', null);
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
				}
				$amount += $payment['amount'];
			}
		}

		/*if (round($amount, 2) != round($data['amount'], 2)) {//round небходим для корректного сравнения, бывают приколы сравления одинаковых сумм с выдачей не равно из-за способа хранения
			$Log->add('error', 'Сума платежів сгідно графіку не збігається зі страховою премією за полісом.');
		}*/

        //Проверка даты окончания нового паспорта
        if(intval($data['insurer_id_card'])) {
            if(intval($data['insurer_newpassport_dateEnd_day']) !== intval($data['insurer_newpassport_date_day']) 
                || intval($data['insurer_newpassport_dateEnd_month']) !== intval($data['insurer_newpassport_date_month']) 
                || intval($data['insurer_newpassport_dateEnd_year']) !== (intval($data['insurer_newpassport_date_year']) + 10)) {
                $Log->add('error', 'Дата закінчення строку дії нового паспорту Страхувальника не відповідає нормам. Має бути Дата початку дії плюс 10 років.');
            }
        }

        if(intval($data['insured_id_card'])) {
            if(intval($data['insured_newpassport_dateEnd_day']) !== intval($data['insured_newpassport_date_day']) 
                || intval($data['insured_newpassport_dateEnd_month']) !== intval($data['insured_newpassport_date_month']) 
                || intval($data['insured_newpassport_dateEnd_year']) !== (intval($data['insured_newpassport_date_year']) + 10)) {
                $Log->add('error', 'Дата закінчення строку дії нового паспорту Застрахованої особи не відповідає нормам. Має бути Дата початку дії плюс 10 років.');
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

        if(intval($data['insured_id_card'])) {
            if(!intval($data['insured_newpassport_place'])) {
                $Log->add('error', 'Поле "Ким і де виданий" Застрахованої особи має приймати тільки числові значення.');
            }
            
             if(!preg_match('/^\d{9}$/', $data['insured_newpassport_number'])) {
                $Log->add('error', 'Поле "Паспорт. Номер" Застрахованої особи заповнено невірно.');
            }

            if(strlen($data['insured_newpassport_reestr']) !== 14) {
                $Log->add('error', 'Поле "Унікальний номер запису в реєстрі" Застрахованої особи заповнено невірно.');
            }
        }
    }

	function setClient($data) {

        $values['agencies_id']	    			= 1469;
        $values['agents_id']				    = ($data['agencies_id'] == 1469) ? $data['agents_id'] : 0;
		$values['person_types_id']				= 1;

		$values['company']						= $data['insurer_company'];
		$values['identification_code']			= $data['insurer_identification_code'];
		$values['position']						= $data['insurer_position'];
		$values['ground']						= $data['insurer_ground'];

		$values['lastname']						= $data['insurer_lastname'];
		$values['firstname']					= $data['insurer_firstname']; 
		$values['patronymicname']				= $data['insurer_patronymicname'];
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

		$Clients = new Clients($values);
		return $Clients->fill($values);
	}
	
	function exportInWindow($data) {
		global $db, $Smarty, $Authorization, $PAYMENT_STATUSES, $POLICY_STATUSES_SCHEMA;

		require_once $Smarty->_get_plugin_filepath('shared','make_timestamp');
		
		$conditions[] = 1;
		
		if ($data['number']) {
			$conditions[] = 'a.number LIKE ' . $db->quote(trim($data['number']) . '%');
		}
		
		if ($data['insurer']) {
			$conditions[] = 'a.insurer LIKE ' . $db->quote($data['insurer'] . '%');
		}

		if (is_array($data['policy_statuses_id'])) {
			$conditions[] = 'policy_statuses_id IN(' . implode(', ', $data['policy_statuses_id']) . ')';
		}

		if (is_array($data['payment_statuses_id'])) {
			$conditions[] = 'payment_statuses_id IN(' . implode(', ', $data['payment_statuses_id']) . ')';
		}

		if ($data['from']) {
			$conditions[] = 'TO_DAYS(a.date) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
		}

		if ($data['to']) {
			$conditions[] =  'TO_DAYS(a.date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
		}

		if ($data['frombegin_datetime']) {
			$conditions[] = 'TO_DAYS(a.begin_datetime) >= TO_DAYS(' . $db->quote( substr($data['frombegin_datetime'], 6, 4) . substr($data['frombegin_datetime'], 3, 2) . substr($data['frombegin_datetime'], 0, 2) ) . ')';
		}

		if ($data['tobegin_datetime']) {
			$conditions[] =  'TO_DAYS(a.begin_datetime) <= TO_DAYS(' . $db->quote( substr($data['tobegin_datetime'], 6, 4) . substr($data['tobegin_datetime'], 3, 2) . substr($data['tobegin_datetime'], 0, 2) ) . ')';
		}

		if (intval($data['agencies_id']) && !is_array($data['agencies_id'])) {
		
			if(ereg('KASKO', $this->objectTitle) && $_SESSION['auth']['agent_financial_institutions_id']>0 && in_array($_SESSION['auth']['agent_financial_institutions_id'], $working_banks)) {//банки которые работают со своей базой
				//нету ограничения по агенции для КАСКО но есть ограничение по банку выше
			} else {
				$fields[] = 'agencies_id';
				
				$Agencies = new Agencies($data);
				$agencies_id = array($data['agencies_id']);
				$Agencies->getSubId(&$agencies_id, $data['agencies_id']);
				
				if ($Authorization->data['id'] == 11409 && $data['product_types_id'] == 22) {
					$agencies_id[] = AGENCY_SATIS;
				}
				if (($Authorization->data['id'] == 13723 || $Authorization->data['id'] == 13740) && $data['product_types_id'] == 22) {
					$agencies_id[] = 556;
					$agencies_id[] = AGENCY_SATIS;
					$agencies_id[] = 1;
				}

				$conditions[] = 
					'('.
						'a.agencies_id IN(' . implode(', ', $agencies_id) . ') OR '.
						'a.seller_agencies_id IN(' . implode(', ', $agencies_id) . ') '.
					')';
			}
		}
					
		if (is_array($data['agencies_id']) && sizeof($data['agencies_id'])>0) {
			
			if(ereg('KASKO', $this->objectTitle) && $_SESSION['auth']['agent_financial_institutions_id']>0 && in_array($_SESSION['auth']['agent_financial_institutions_id'], $working_banks)) {//банки которые работают со своей базой
				$conditions[] = 'IF(policy_statuses_id=1 ,a.agencies_id IN (' . implode(', ', $data['agencies_id']).'), 1)';
			} else {
				$fields[] = 'agencies_id';
				if ($data['specialAgent']) {
					$conditions[] = '(a.agencies_id='.intval($_SESSION['auth']['agencies_id']).' OR a.seller_agencies_id='.intval($_SESSION['auth']['agencies_id']).' OR (a.agencies_id IN (' . implode(', ', $data['agencies_id']).') AND a.end_datetime BETWEEN  DATE_SUB(NOW(),INTERVAL 2 MONTH) AND DATE_ADD(NOW(),INTERVAL 2 MONTH)))';
				} else {
					$conditions[] =
						'('.
							'a.agencies_id IN (' . implode(', ', $data['agencies_id']).') OR '.
							'a.seller_agencies_id IN (' . implode(', ', $data['agencies_id']).') '.
						')';
				}
			}
		}

		if (intval($data['insurance_companies_id'])) {
			$fields[] = 'insurance_companies_id';
			$conditions[] = 'a.insurance_companies_id = ' . intval($data['insurance_companies_id']);
		}
		
        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));
		
		$types_id = array('', 'ОПЕРАТИВНЕ ХІРУРГІЧНЕ ЛІКУВАННЯ', 'КОНСЕРВАТИВНЕ  ЛІКУВАННЯ', 'Підпрограма 1', 'Підпрограма 2');
		$insurance_companies_id = array(4 => 'ТДВ "Експрес Страхування"', 9 => 'ПрАТ "СК "САТІС"');

		$sql = 'SELECT date_format(a.date, \'%d.%m.%Y\') as policies_date, CONCAT_WS(\' \', b.insured_lastname, b.insured_firstname, b.insured_patronymicname) as insured, a.number as policies_number, b.types_id, a.insurance_companies_id, a.amount, ' .
					'date_format(c.payment_date, \'%d.%m.%Y\') as payment_date, SUM(d.amount) as payed_amount, e.title as statuses_title, b.diagnosis, ' .
					'CONCAT_WS(\' \', b.insurer_lastname, b.insurer_firstname, b.insurer_patronymicname) as insurer ' .
			   'FROM ' . PREFIX . '_policies as a ' .
			   'JOIN ' . PREFIX . '_policies_dms as b on a.id = b.policies_id ' .
			   'LEFT JOIN ' . PREFIX . '_policy_payments_calendar as c on a.id = c.policies_id ' .
			   'LEFT JOIN ' . PREFIX . '_policy_payments as d on a.id = d.policies_id ' .
			   'JOIN ' . PREFIX . '_policy_statuses as e on a.policy_statuses_id = e.id ' .
			   'WHERE ' . implode(' AND ', $conditions) . ' ' .
			   'GROUP BY a.id ' .
			   'ORDER BY a.date';
		$list = $db->getAll($sql);

		include 'Policies/exportDMS.php';
        exit;
    }
	
	function updateCalendar($id, $data) {
		global $db;

		//обновляем календарь
		if (is_array($data['payments'])) {
			foreach ($data['payments'] as $payments_id => $payment) {
				if (intval($payments_id) > 0) {
					$sql =	'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
							'date = ' . $db->quote(substr($payment['date'], 6, 4) . '-' . substr($payment['date'], 3, 2) . '-' . substr($payment['date'], 0, 2)) . ', ' .
							'amount = ' . $db->quote($payment['amount']) . ' ' .
							'WHERE id = ' . intval($payments_id) . ' AND policies_id = ' . $id . ' AND statuses_id = ' . PAYMENT_STATUSES_NOT;
					$db->query($sql);
				} else {
					$sql =	'REPLACE INTO ' . PREFIX . '_policy_payments_calendar SET ' .
							'policies_id = ' . intval($id) . ', ' .
							'date = ' . $db->quote(substr($payment['date'], 6, 4) . '-' . substr($payment['date'], 3, 2) . '-' . substr($payment['date'], 0, 2)) . ', ' .
							'amount = ' . $db->quote($payment['amount']) . ', ' .
							'file = 1, ' .
							'statuses_id = ' . PAYMENT_STATUSES_NOT;
					$db->query($sql);
				}

				$date[] = substr($payment['date'], 6, 4) . '-' . substr($payment['date'], 3, 2) . '-' . substr($payment['date'], 0, 2);
			}

			$sql =	'DELETE ' .
					'FROM ' . PREFIX . '_policy_payments_calendar ' . 
					'WHERE policies_id = ' . intval($id) . ' AND date NOT IN(\'' . implode('\', \'', $date) . '\')';
			$db->query($sql);
		} else {
			$sql =	'DELETE ' .
					'FROM ' . PREFIX . '_policy_payments_calendar ' . 
					'WHERE policies_id = ' . intval($id);
			$db->query($sql); 
		}
		
		
	}
	
	function setAdditionalFields($id, $data) {
        global $db, $Log, $UNDERWRITING_POLICY_STATUSES;

		$data['clients_id'] = $this->setClient($data);

        //$row = $this->getNumber($data);
        
		if ($data['insurance_companies_id'] == 9 || $data['types_id'] == 3 || $data['types_id'] == 4) {
			$sql = 'UPDATE ' . PREFIX . '_policies ' .
				   'SET number = ' . $db->quote($data['number']) . ' ' .
				   'WHERE id = ' . intval($id);
			$db->query($sql);
			if ($data['insurance_companies_id'] == 9) {
				$sql = 'UPDATE ' . PREFIX . '_policies_dms ' .
				   'SET series = \'54–33–Т\', number = ' . $db->quote($data['number']) . ' ' .
				   'WHERE policies_id = ' . intval($id);
				$db->query($sql);
			}
		} else {
			$sql = 'UPDATE ' . PREFIX . '_policies ' .
				   'SET number = CONCAT(\'302\', \'.\', date_format(created, \'%y\'), \'.2\', ' . $db->quote(sprintf('%06d', intval($data['id']))) . ') ' .
				   'WHERE id = ' . intval($id);
			$db->query($sql);
		}

        $sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_dms AS b ON a.id = b.policies_id ' .
				'JOIN ' . PREFIX . '_product_types AS c ON a.product_types_id = c.id ' .
				//'LEFT JOIN ' . PREFIX . '_financial_institutions AS d ON b.financial_institutions_id = d.id ' .
				'LEFT JOIN ' . PREFIX . '_policies AS e ON e.id = ' . intval($data['parent_id']) . ' SET ' .
				'a.parent_id = ' . intval($data['parent_id']) . ', ' .
				'a.top = IF(e.top > 0, e.top, ' . intval($id) . '), ' .
				'a.clients_id = ' . intval($data['clients_id']) . ', ' .
                'a.number = IF(a.number, a.number, ' . $db->quote($row['number']) . '), ' .
                'a.sub_number = IF(a.sub_number, a.sub_number, ' . $db->quote($row['sub_number']) . '), ' .
                'a.date = IF(TO_DAYS(a.date) > 0, a.date, ' . $db->quote($data['date_year'] . $data['date_month'] . $data['date_day']) . '), ' .
                'a.insurer = CONCAT(b.insurer_lastname ,\' \', b.insurer_firstname ), ' .
				'a.interrupt_datetime = a.end_datetime, ' .
                /*'b.assured_title = IF(b.financial_institutions_id, d.title, b.assured_title), ' .
                'b.assured_identification_code = IF(b.financial_institutions_id, d.edrpou, b.assured_identification_code), ' .
                'b.assured_address = IF(b.financial_institutions_id, d.address, b.assured_address), ' .
                'b.assured_phone = IF(b.financial_institutions_id, d.phone, b.assured_phone), ' .*/
				'e.child_id = ' . intval($id) . ' ' .
                'WHERE a.id = ' . intval($id);
        $db->query($sql);

        $PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
        $PolicyPaymentsCalendar->updateCalendar($id,true);
        $this->setPaymentStatus($id);
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;

        if (intval($data['changeMode'])) {
			$data = $this->replaceSpecialChars($data, 'insert');
            $this->showForm($data, $GLOBALS['method'], 'update');
            return;
        }

        $data['agencies_id']	= $Authorization->data['agencies_id'];
        $data['agents_id']		= $Authorization->data['id'];

		$data['id'] = $data['policies_id'] = parent::insert(&$data, false, $showForm);

        if (intval($data['id'])) {

            $this->setAdditionalFields($data['id'], $data);
			$this->generateDocuments($data['id']);

			$this->setMode($data);
			$this->setSubMode($data);

            /*if ($Authorization->data['roles_id'] == ROLES_AGENT) {

                $sql =  'SELECT * ' .
                        'FROM ' . PREFIX . '_agents ' .
                        'WHERE accounts_id = ' . intval($Authorization->data['id']);
                $row = $db->getRow($sql);

                $sql =  'UPDATE ' . PREFIX . '_policies_one_shipping SET ' .
                        'agent_lastname = ' . $db->quote($row['lastname']) .  ', ' .
                        'agent_firstname =  ' . $db->quote($row['firstname']) . ', ' .
                        'agent_patronymicname = ' . $db->quote($row['patronymicname']) . ' ' .
                        'WHERE policies_id=' . intval($data['id']);
                $db->query($sql);
            }*/

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&policies_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
		}
    }

    function prepareFields($action, &$data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        $conditions[] = 'policies_id = ' . intval($data['id']);
 

        
        $sql =  'SELECT id, amount, date_format(date, ' . $db->quote(DATE_FORMAT) . ') AS date, statuses_id ' .
                'FROM ' . PREFIX . '_policy_payments_calendar  ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY ' . PREFIX . '_policy_payments_calendar.date';
        $res = $db->query($sql);

		while ($res->fetchInto($row)) {
			$data['payments'][ $row['id'] ] = array(
				'amount'		=> $row['amount'],
				'date'			=> $row['date'],
				'statuses_id'	=> $row['statuses_id']);
		}

        return $data;
    }
	
	

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization;

        if (intval($data['changeMode'])) {
            $this->showForm($data, $GLOBALS['method'], 'update');
            return;
        }

		if (parent::update(&$data, false, $showForm)) {
        
			$this->setAdditionalFields($data['id'], $data);
			$this->generateDocuments($data['id']);

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&policies_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
		}
    }

	function renewPolicy($data) {//алгоритм Переукласти поліс

		$this->mode = 'update';
		$data['checkPermissions'] = 1;
		$data = $this->load($data, false);

		$data['product_types_id']	= PRODUCT_TYPES_DMS;
		$data['policy_statuses_id']	= POLICY_STATUSES_CREATED;
		$data['parent_id']			= $data['id'];
		$data['states_id']			=  POLICY_STATUSES_RENEW;

		$data['next_policy_statuses_id']	= POLICY_STATUSES_RENEW;

		$data['amount_parent'] = $this->calculateamount_parent($data['parent_id'], date('Y-m-d'));

		$begin_datetime		= $data['begin_datetime'];
		$begin_datetime_day	= $data['begin_datetime_day'];
		$begin_datetime_month	= $data['begin_datetime_month'];
		$begin_datetime_year	= $data['begin_datetime_year'];

		if (mktime(0, 0, 0, $data['begin_datetime_month'], $data['begin_datetime_day'], $data['begin_datetime_year']) < mktime(0, 0, 0, date('m'), date('d'), date('Y'))) {
			$data['begin_datetime']		= date('d.m.Y');
			$data['begin_datetime_day']	= date('d');
			$data['begin_datetime_month']	= date('m');
			$data['begin_datetime_year']	= date('Y');
		}

		$proportionality = ((mktime(0, 0, 0, $data['end_datetime_month'], $data['end_datetime_day'], $data['end_datetime_year']) - mktime(0, 0, 0, $data['begin_datetime_month'], $data['begin_datetime_day'], $data['begin_datetime_year'])) / 60 / 60 / 24 + 2) / ((mktime(0, 0, 0, $data['end_datetime_month'], $data['end_datetime_day'], $data['end_datetime_year']) - mktime(0, 0, 0, $begin_datetime_month, $begin_datetime_day, $begin_datetime_year)) / 60 / 60 / 24 + 1);

		unset($data['date']);
		unset($data['date_day']);
		unset($data['date_month']);
		unset($data['date_year']);

		$data['amount'] = 0;
		foreach ($data['items'] as $i => $row) {
			$data['items'][ $i ]['rate']	= round($data['items'][ $i ]['rate'] * $proportionality, 3);
			$data['items'][ $i ]['amount']	= round($data['items'][ $i ]['price'] * $data['items'][ $i ]['rate'] / 100, 2);
			$data['amount'] += $data['items'][ $i ]['amount'];
		}

		$data['rate'] = round($data['amount'] / $data['price'] * 100, 3);
		$data['amount'] = $data['amount'] - $data['amount_parent'];

		//убираем все платежи, что были оплачены ранее, корректировать даем только не закрытые платежи
		$statuses = array(PAYMENT_STATUSES_PAYED, PAYMENT_STATUSES_OVER);
		foreach ($data['payments'] as $i => $row) {
			//if (in_array($data['payments'][ $i ]['statuses_id'], $statuses)) {
				unset($data['payments'][ $i ]);
			//}
		}

		$Policies = Policies::factory($data, 'Property');
		$Policies->mode = 'update';
        $Policies->add($data);
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
		$this->tables=array($this->tables[0]);

        return parent::deleteProcess($data, $i, $folder);
    }

    function prepareValues($fields, $values) {
        global $REGIONS;

        foreach ($fields as $field) {
            switch ($field) {
				case 'insurer':
					$values[ $field ] = $values['insurer_lastname'] . ' ' . $values['insurer_firstname'] . ' ' . $values['insurer_patronymicname'];
                    break;
                case 'insurer_address':
                    $values[ $field ] = Regions::getTitle($values['insurer_regions_id']);

					if ($values['insurer_area']) {
                        $values[ $field ] .= ', ' .$values['insurer_area'] . ' р-н';
                    }

                    if (!in_array($values['insurer_regions_id'], $REGIONS)) {
                        $values[ $field ] .= ', ' . $values['insurer_city'];
                    }

                    $values[ $field ] .=  ', ' . StreetTypes::getTitle($values['insurer_street_types_id']) . ' ' . $values['insurer_street'] . ', буд. ' . $values['insurer_house'];

					if ($values['insurer_flat']) {
						$values[ $field ] .= ', кв. ' . $values['insurer_flat'];
					}
                    break;
                case 'insured':
					$values[ $field ] = $values['insured_lastname'] . ' ' . $values['insured_firstname'] . ' ' . $values['insured_patronymicname'];
                    break;
                case 'insured_address':
                    $values[ $field ] = Regions::getTitle($values['insured_regions_id']);

					if ($values['insured_area']) {
                        $values[ $field ] .= ', ' .$values['insured_area'] . ' р-н';
                    }

                    if (!in_array($values['insured_regions_id'], $REGIONS)) {
                        $values[ $field ] .= ', ' . $values['insured_city'];
                    }

                    $values[ $field ] .=  ', ' . StreetTypes::getTitle($values['insured_street_types_id']) . ' ' . $values['insured_street'] . ', буд. ' . $values['insured_house'];

					if ($values['insured_flat']) {
						$values[ $field ] .= ', кв. ' . $values['insured_flat'];
					}
                    break;
                case 'payed':
                    $values[ $field ] = $values['sample'];
				case 'closed':
					$values[ $field ] = $this->isClosedByPolicyStatusesId($values['policy_statuses_id']);
					break;
				case 'insurance_companies_title':
					switch ($values['insurance_companies_id']) {
						case 4:
							$values[ $field ] = 'ТДВ "Експрес Страхування"';
							break;
						case 9:
							$values[ $field ] = 'ПрАТ "Cтрахова компанія "Cатіс"';
							break;
						default:
							$values[ $field ] = '';
							break;
					}
            }
        }

        return $values;
    }

    function getReadonlySign(&$data) {
        return (intval($data['documents'])==0)
            ? ''
            : ' style="color: #666666; background-color: #f5f5f5;" disabled';
    }

    function setListValues($data, $actionType='show') {
        global $db, $Authorization;

        if (!intval($data['agencies_id'])) {
            $data['agencies_id']    = $Authorization->data['agencies_id'];
        }

        $this->formDescription['fields'][ $this->getFieldPositionByName('sign_agents_id') ]['condition'] .= ' AND agencies_id='.intval($data['agencies_id']);

        parent::setListValues($data, $actionType);
    }

    function changeSignInWindow($data) {
        global $db;

        $this->checkPermissions('update', $data);

        $sql =  'UPDATE ' . PREFIX . '_policies_one_shipping SET ' .
                'sign_agents_id = ' . intval($data['sign_agents_id']) . ' ' .
                'WHERE policies_id = ' . intval($data['policies_id']);
        $db->query($sql);

        if ($this->getPolicyStatusesId($data['policies_id']) == POLICY_STATUSES_GENERATED) {
            PolicyDocuments::generateTemplates($data['policies_id'], null, true);
        }

        echo 'Ok';
        exit;
    }

  

    function getValues($file) {
        global $db, $Smarty;
		
		require_once 'NCLNameCase/NCL.NameCase.ua.php';
		$nc = new NCLNameCaseUa();

        $sql =  'SELECT a.*, b.*, c.*, DATE_SUB(begin_datetime, INTERVAL 1 DAY) AS endPaymentDate,  IF(payment_statuses_id<>' . PAYMENT_STATUSES_NOT . ' OR LENGTH(payment_number)>0, 0, 1) AS sample, ' .
				'd.title AS agencies_title, d.edrpou AS agencies_edrpou, d.ground_kasko_express as ground_kasko, d.director1, d.director2, ' .
				'e.title as insurerRegionsTitle, f.title AS insurer_streetTypesTitle, g.title as insuredRegionsTitle, h.title AS insured_streetTypesTitle, b.number as policies_number, ' .
				'acc.lastname as agents_lastname, acc.firstname as agents_firstname, acc.patronymicname as agents_patronymicname ' .
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . $this->tables[0] . ' AS b ON a.policies_id = b.id ' .
                'JOIN ' . $this->tables[1] . ' AS c ON b.id = c.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_agencies AS d ON b.agencies_id = d.id ' .
				'LEFT JOIN ' . PREFIX . '_regions AS e ON c.insurer_regions_id = e.id ' .
				'LEFT JOIN ' . PREFIX . '_street_types AS f ON c.insurer_street_types_id = f.id ' .
                'LEFT JOIN ' . PREFIX . '_regions AS g ON c.insured_regions_id = g.id ' .
				'LEFT JOIN ' . PREFIX . '_street_types AS h ON c.insured_street_types_id = h.id ' .
				'LEFT JOIN ' . PREFIX . '_accounts as acc ON b.agents_id = acc.id ' .
                'WHERE a.id=' . intval($file['id']);
        $row = $db->getRow($sql);
        
        if (intval($row['sign_agents_id'])) {

            $sql =  'SELECT *,ground_kasko_express as ground_kasko ' .
                    'FROM ' . PREFIX . '_agents ' .
                    'WHERE accounts_id = ' . intval($row['sign_agents_id']);
            $agent = $db->getRow($sql);

            if ($agent['ground_kasko'] && $agent['director1'] && $agent['director2']) {
                $row['ground_kasko'] = $agent['ground_kasko'];
                $row['director1']   = $agent['director1'];
                $row['director2']   = $agent['director2'];
            }
        }
		
        $sql =	'SELECT date, amount, DATE_SUB(date, INTERVAL 1 DAY) AS lastdate, DATE_ADD(date, INTERVAL 1 DAY) AS date1 ' .
                'FROM ' . PREFIX . '_policy_payments_calendar ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $row['payments'] = $db->getAll($sql);

		$row['paymentsCount'] = sizeof($row['payments']);

		$bdat = substr($row['begin_datetime'], 0, 4).'-'.  substr($row['begin_datetime'], 5, 2).'-'. substr($row['begin_datetime'], 8, 2);
		$row['paymentsCalendar'][] = array('date'=>date('Y-m-d',mktime (0, 0, 0, substr($row['begin_datetime'], 5, 2),substr($row['begin_datetime'], 8, 2)+1 , substr($row['begin_datetime'], 0, 4) )));
		$i=1;

		foreach ($row['payments'] as $i=>$item) {
			$row['payments'][$i]['payment_date'] = date('Y-m-d',mktime (0, 0, 0, substr($row['begin_datetime'], 5, 2)+$i,substr($row['begin_datetime'], 8, 2)+1 , substr($row['begin_datetime'], 0, 4) ));
		}
		
		$row['insurer2'] = $nc->qFullName($row['insurer_lastname'], $row['insurer_firstname'], $row['insurer_patronymicname'], null, NCL::$TVORITELN);
		$row['insured2'] = $nc->qFullName($row['insured_lastname'], $row['insured_firstname'], $row['insured_patronymicname'], null, NCL::$TVORITELN);
		$row['insurer3'] = $nc->qFullName($row['insurer_lastname'], $row['insurer_firstname'], $row['insurer_patronymicname'], null, NCL::$UaZnahidnyi);
		$row['insured3'] = $nc->qFullName($row['insured_lastname'], $row['insured_firstname'], $row['insured_patronymicname'], null, NCL::$UaZnahidnyi);
		$row['insurer4'] = $nc->qFullName($row['insurer_lastname'], $row['insurer_firstname'], $row['insurer_patronymicname'], null, NCL::$UaOrudnyi);
		$row['insured4'] = $nc->qFullName($row['insured_lastname'], $row['insured_firstname'], $row['insured_patronymicname'], null, NCL::$UaOrudnyi);		
		$row['insurer5'] = $nc->qFullName($row['insurer_lastname'], $row['insurer_firstname'], $row['insurer_patronymicname'], null, NCL::$UaRodovyi);
		$row['insured5'] = $nc->qFullName($row['insured_lastname'], $row['insured_firstname'], $row['insured_patronymicname'], null, NCL::$UaRodovyi);

		$fields = array(
					'insurer',
					'insurer_address',
                    'insured',
					'insured_address',
					'closed',
					'insurance_companies_title');

        return $this->prepareValues($fields, $row);
    }

	 
 

	function getPayDissolutionInWindow($data) {
		echo '{"returnAmount":"0"}';
		exit;
	}

	function cancelPolicy($data) {//анулирование полиса
		global $db, $Log;

		$this->checkPermissions('cancelPolicy', $data);

		//фиксируем сумму возврата
		$sql =	'UPDATE ' . PREFIX . '_policies SET ' .
				'amount_return = 0, ' .
				'interrupt_datetime = NOW(), ' .
				'policy_statuses_id = ' . POLICY_STATUSES_CANCELLED . ', ' .
				'modified = NOW() ' .
				'WHERE id = ' . intval($data['id']);
		$db->query($sql);

		$data['policies_id']			= $data['id'];
		$data['policy_statuses_id']	= POLICY_STATUSES_CANCELLED;

		$PolicyMessages = new PolicyMessages($data);
		$PolicyMessages->insert($data, false);
		
		$PolicyDocuments = new PolicyDocuments($data);

		$product_document_types = array(173, 174);
		foreach ($product_document_types as $product_document_types_id) {
			$PolicyDocuments->generate($data['id'], $product_document_types_id);
		}

		$Log->add('confirm', 'Поліс було успішно анульовано.');

		header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
		exit;
	}

    function get($id) {
        global $db;

        $sql =	'SELECT * ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_dms AS b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        $row = $db->getRow($sql);

        return $row;
    }
	
		//Export 1C 7.7
     function getXML($data) {
        global $db, $Smarty;

      $conditions[] = 'a.product_types_id=22';
      $conditions[] = 'a.insurance_companies_id=4';

 
	  
      if ($data['number']) {
            $conditions[] = 'a.number=' . trim($db->quote($data['number']));
        } else {
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.date )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.date )>=TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.date )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.date ) <= TO_DAYS(NOW())';
  	        $conditions[] = 'a.policy_statuses_id=10';
        }



        $sql =  'SELECT b.*,a.*,1 as insurer_person_types_id,e.code,c.title AS policy_statuses_title, d.title AS insurer_regions_title,  IF(e1.id>0,e1.title,e.title) AS agencies_title ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_dms AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id = c.id ' .
                'JOIN ' . PREFIX . '_regions AS d ON b.insurer_regions_id = d.id ' .
                'JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id = e.id ' .
                'LEFT JOIN ' . PREFIX . '_agencies AS e1 ON e1.id = e.parent_id ' .
                'WHERE ' . implode(' AND ', $conditions);
		$res = $db->query($sql);

		$i = 0;
		$list = array();
        while ($res->fetchInto($row)) {
			$list[ $i ] = $row;
            $sql =  'SELECT date as payment_date, amount as payment_amount ' .
                    'FROM ' . PREFIX . '_policy_payments_calendar ' .
                    'WHERE policies_id = ' . intval($row['policies_id']);
            $list[ $i ]['paymentsCalendar'] = $db->getAll($sql);

			$i++;
        }


        $Smarty->assign('list', $list);
        return  $Smarty->fetch($this->object . '/dms.xml');
    }

	
}

?>