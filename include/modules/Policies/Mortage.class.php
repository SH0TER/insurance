<?
/*
 * Title: policy Mortage class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'PolicyDocuments.class.php';
require_once 'PropertyObjects.class.php';

class Policies_Mortage extends Policies {

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
                            'name'              => 'types_id',
                            'description'       => 'Тип',
                            'type'              => fldRadio,
                            'list'              => array(
                                1 => 'поліс',
                                2 => 'запит котирування'),
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
						array(
                            'name'              => 'insurer_person_types_id',
							'showId'               => true,
                            'description'       => 'Страхувальник, тип особи',
                            'type'              => fldRadio,
                            'list'              => array(
                                                    '1' => 'Фiзична',
                                                    '2' => 'Юридична'),
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
                            'table'             => 'policies_mortage'),
                       array(
                            'name'              => 'terms_years_id',
                            'description'       => 'Період співпраці за договором',
							'showId'            => true,
                            'type'              => fldRadio,
                            'list'              => array(
                                                        1 => 'до 1-го року',
                                                        2 => '2-роки',
														3 => '3-роки',
														4 => '4-роки',
														5 => '5-років',
														6 => '6-років',
														7 => '7-років',
														8 => '8-років',
														9 => '9-років',
														10 => '10-років',
														11 => '11-років',
														12 => '12-років',
														13 => '13-років',
														14 => '14-років',
														15 => '15-років'
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_mortage'),
						 array(
                            'name'              => 'insurance_companies_id',
                            'description'       => 'Страхова компанiя',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies'),
						 array(
                            'name'              => 'mortage_groups_id',
                            'description'       => 'Група застрахованого майна',
							'showId'            => true,
                            'type'              => fldRadio,
                            'list'              => array(
                                                        1 => 'Будівля',
														3 => 'Господарська будівля',
														4 => 'Об’єкт незавершеного будівництва',
														5 => 'Квартира',
														6 => 'Земельна ділянка',
														7 => 'Нежитлове примiщення',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_mortage'),	
						  array(
                            'name'              => 'insurer_company',
                            'description'       => 'Страхувальник, компанiя',
                            'type'              => fldText,
                            'maxlength'         => 150,
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
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_edrpou',
                            'description'       => 'Страхувальник, ЄДРПОУ',
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
                            'table'             => 'policies_mortage'),
						array(
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),

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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_position',
                            'description'       => 'Страхувальник, посада',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_ground',
                            'description'       => 'Страхувальник, діє на підставі',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_passport_number',
                            'description'       => 'Страхувальник, паспорт, номер',
                            'type'              => fldText,
                            'maxlength'         => 13,
                            'validationRule'    => '^([0-9]{6}|[0-9]{6}\/[0-9]{6})$',
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
						array(
                            'name'              => 'insurer_lastname1',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_firstname1',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_patronymicname1',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_position1',
                            'description'       => 'Страхувальник, посада',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_ground1',
                            'description'       => 'Страхувальник, діє на підставі',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_bank',
                            'description'       => 'Страхувальник, банк',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_bank_mfo',
                            'description'       => 'Страхувальник, банк, МФО',
                            'type'              => fldText,
                            'maxlength'         => 6,
                            'validationRule'    => '^[0-9]{6}$',
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
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'insurer_bank_account',
                            'description'       => 'Страхувальник, банкiвський рахунок',
                            'type'              => fldText,
							'maxlength'			=> 14,
							'validationRule'	=> '^([0-9]{9,14})$',
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage',
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
							'table'				=> 'policies_mortage',
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
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
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'financial_institutions_id',
                            'description'       => 'Банк',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_mortage',
                            'sourceTable'       => 'financial_institutions',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'assured_title',
                            'description'       => 'Вигодонабувач, ПІБ (назва)',
                            'type'              => fldText,
                            'maxlength'         => 200,
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
                            'table'             => 'policies_mortage'),
						array(
                            'name'              => 'assured_person_types_id',
							'showId'               => true,
                            'description'       => 'Вигодонабувач, тип особи',
                            'type'              => fldRadio,
                            'list'              => array(
                                                    '1' => 'Фiзична',
                                                    '2' => 'Юридична'),
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
                            'table'             => 'policies_mortage'),	
                        array(
                            'name'              => 'assured_identification_code',
                            'description'       => 'Вигодонабувач, ІПН (ЄРДПОУ)',
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
                            'table'             => 'policies_mortage'),
						array(
                            'name'              => 'assured_dateofbirth',
                            'description'       => 'Вигодонабувач, дата народження',
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
                            'table'             => 'policies_mortage'),	
                         array(
                            'name'              => 'assured_bank_account',
                            'description'       => 'Вигодонабувач, Рахунок банку',
                            'type'              => fldText,
                            'maxlength'         => 20,
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
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'assured_bank',
                            'description'       => 'Вигодонабувач, Банку',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'assured_bank_mfo',
                            'description'       => 'Вигодонабувач, Банк (МФО)',
                            'type'              => fldText,
                            'maxlength'         => 8,
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
                            'table'             => 'policies_mortage'),
                         array(
                            'name'              => 'mortage_agreement_number',
                            'description'       => 'Вигодонабувач, договор іпотеки , номер',
                            'type'              => fldText,
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_mortage'),
                         array(
                            'name'              => 'mortage_agreement_date',
                            'description'       => 'Вигодонабувач, договор іпотеки від, дата',
                            'type'              => fldDate,
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'assured_address',
                            'description'       => 'Вигодонабувач, адреса',
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
                            'table'             => 'policies_mortage'),
                        array(
                            'name'              => 'assured_phone',
                            'description'       => 'Вигодонабувач, телефон',
                            'type'              => fldText,
                            //'validationRule'    => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_mortage'),
						array(
							'name'              => 'values_id',
							'description'       => 'Параметри об\'єкту страхування',
							'type'              => fldMultipleSelect,
							'showId'			=> true,
							'display'           =>
								array(
									'show'      => false,
									'insert'    => true,
									'view'      => true,
									'update'    => true,
									'change'    => false
								),
							'verification'      =>
								array(
									'canBeEmpty'    => false
								),
							'table'             => 'policies_property_mortage_values_assignments',
							'sourceTable'       => 'parameters_mortage',
							'selectField'       => 'title',
							'orderField'        => 'order_position'),
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
                            'name'              => 'deductibles_value',
                            'description'       => 'Франшиза, %',
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
                            'table'             => 'policies_mortage'),	
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
                            'name'              => 'sign_agents_id',
                            'description'       => 'Пiдпис договору КАСКО',
                            'type'              => fldSelect,
                            'selectId'          =>'accounts_id',
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
                            'table'             => 'policies_mortage',
                            'sourceTable'       => 'agents',
                            'condition'         => 'LENGTH(director1)>0 AND LENGTH(director2)>0',
                            'selectField'       => 'CONCAT(lastname, \' \', firstname,\' \',patronymicname)',
                            'orderField'        => 'lastname'),
						array(
                            'name'              => 'year',
                            'description'       => 'Рік побудови застрахованого майна',
                            'type'              => fldInteger,
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
                            'table'             => 'policies_mortage'),		
						array(
                            'name'              => 'mortage_place',
                            'description'       => 'Місцезнаходження застрахованого майна',
                            'type'              => fldText,
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
                            'table'             => 'policies_mortage'),	
						array(
                            'name'              => 'fire_extinguishers_counts',
                            'description'       => 'Кількість вогнегасників',
                            'type'              => fldInteger,
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
                            'table'             => 'policies_mortage'),		
							
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

		

    function Policies_Mortage($data) {
        Policies::Policies($data);

        $this->objectTitle = 'Policies_Mortage';

        $this->messages['plural'] = 'Поліси "Майно що є предметом іпотеки"';
        $this->messages['single'] = ($data['types_id'] == POLICY_TYPES_QUOTE) ? 'Котирування "Майно що є предметом іпотеки"' : 'Поліс "Майно що є предметом іпотеки"';
		
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
                    'insert'       		=> false,
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
					'cancelPolicy'		=> false);
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
					'cancelPolicy'		=> true);

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

	function add($data) {

		if (intval($data['policy_statuses_id'])==0) {
			$data['policy_statuses_id'] = 1;
		}
		if ($_SESSION['auth']['agent_financial_institutions_id']==39)//универсал
			$data['types_id']=2;

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

                if ($field['name'] == 'risks_id') {
                    $where .= ' AND person_types_id=' . $this->insurer_person_types_id;
                }

                if (!$field['selectId'])
                    $field['selectId'] = 'id';

                $field['orderField'] = ($field['selectField'] == $field['orderField'])
                    ? $field['orderField'] . $languageCode
                    : $field['orderField'];

                $sql =	'SELECT ' . $field['selectId'] . ' AS id, ' . $field['selectField'] . $languageCode . ' AS title ' .($field['name']=='risks_id' ? ', group_title AS optgroup ':' ').($field['name']=='values_id' ? ', block_id AS block_id ':' ').
						'FROM ' . PREFIX . '_' . $field['sourceTable'] . $where . ' ' .
						'ORDER BY ' . $field['orderField'];
                $list = $db->getAll($sql, 300);

                if (is_array($list)) {
                    foreach ($list as $row) {
                        $options[ $row['id'] ] = array(
                            'title' => $row['title'],
                            'obligatory' => $row['obligatory'],
							'optgroup' => $row['optgroup'],
                            'block_id' => $row['block_id']);
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
        $this->formFields[]='insurer_person_types_id';
    }

	 
 
	
	function showForm($data, $action, $actionType=null, $template=null) {
        global $db, $Authorization, $POLICY_STATUSES_SCHEMA;

		$sql =	'SELECT a.id, a.title ' .
				'FROM ' . PREFIX . '_parameters_risks AS a ' .		
				//'JOIN ' . PREFIX . '_product_risks AS b ON a.id = b.risks_id ' .
				'WHERE a.product_types_id = ' . PRODUCT_TYPES_MORTAGE . ' ' .
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

		if (!intval($data['id'])) {
			$data['policy_statuses_id'] = POLICY_STATUSES_CREATED;
		}

        if ($data['insurer_person_types_id'] != 1) {
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('terms_id') ]);
		}

		if (!intval($data['date_day']) || !intval($data['date_month']) || !intval($data['date_year'])) {
			$data['date_day']	= date('d');
			$data['date_month']	= date('m');
			$data['date_year']	= date('Y');
		}
		$values_id = array();
		foreach($data as $key=>$val) {
			if (strpos($key, 'values_id')!== false) {
				if (is_array($val)) {
					foreach($val as $r) {
						$values_id[] = $r;
					}
				} elseif(intval($val)>0) {
					$values_id[] = $val;
				}
			}
		}


			$data['values_id'] = $values_id;
			$data['insurance_companies_id'] = INSURANCE_COMPANIES_EXPRESS;
		$data['amount']=doubleval($data['price'])*doubleval($data['rate'])/100;
        return parent::setConstants($data);

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
    }

    function checkFields(&$data, $action) {
        global $db, $Log, $Authorization;

        if (!$data['assured']) {
            $assured = array('assured_title', 'assured_identification_code', 'assured_address', 'assured_phone');

            foreach ($assured as $field) {
                $data[ $field ] = '';
                $this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['verification']['canBeEmpty'] = true;
            }
        }
		
		switch ($data['insurer_person_types_id']) {
			case 1://физ
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_company' ) ]['verification']['canBeEmpty'] = true;
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_ground' ) ]['verification']['canBeEmpty'] = true;
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_edrpou' ) ]['verification']['canBeEmpty'] = true;

				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_bank' ) ]['verification']['canBeEmpty'] = true;
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_bank_mfo' ) ]['verification']['canBeEmpty'] = true;
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_bank_account' ) ]['verification']['canBeEmpty'] = true;
				break;
			case 2://юр
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_identification_code' ) ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_dateofbirth' ) ]['verification']['canBeEmpty'] = true;

				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_passport_series' ) ]['verification']['canBeEmpty'] = true;
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_passport_number' ) ]['verification']['canBeEmpty'] = true;
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_passport_place' ) ]['verification']['canBeEmpty'] = true;
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'insurer_passport_date' ) ]['verification']['canBeEmpty'] = true;

                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_number') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_place') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_date') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_reestr') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_dateEnd') ]['verification']['canBeEmpty'] = true;

				break;
		}
		
		switch ($data['assured_person_types_id']) {
			case 1://физ
				break;
			case 2://юр
                $this->formDescription['fields'][ $this->getFieldPositionByName( 'assured_dateofbirth' ) ]['verification']['canBeEmpty'] = true;

				break;
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

		/*if (round($amount, 2) != round($data['amount'], 2)) {//round небходим для корректного сравнения, бывают приколы сравления одинаковых сумм с выдачей не равно из-за способа хранения
			$Log->add('error', 'Сума платежів сгідно графіку не збігається зі страховою премією за полісом.');
		}*/
    }

	function setClient($data) {

        $values['agencies_id']	    			= 1469;
        $values['agents_id']				    = ($data['agencies_id'] == 1469) ? $data['agents_id'] : 0;
		$values['person_types_id']				= $data['insurer_person_types_id'];

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
		$values['registration_area']				= $data['insurer_area'];
		$values['registration_city']				= $data['insurer_city'];
		$values['registration_street_types_id']	= $data['insurer_street_types_id'];
		$values['registration_street']			= $data['insurer_street'];
		$values['registration_house']			= $data['insurer_house'];
		$values['registration_flat']				= $data['insurer_flat'];
		$values['registration_phone']			= $data['insurer_phone'];

		$values['habitation_regions_id']			= $data['insurer_regions_id'];
		$values['habitation_area']				= $data['insurer_area'];
		$values['habitation_city']				= $data['insurer_city'];
		$values['habitation_street_types_id']		= $data['insurer_street_types_id'];
		$values['habitation_street']				= $data['insurer_street'];
		$values['habitation_house']				= $data['insurer_house'];
		$values['habitation_flat']				= $data['insurer_flat'];
		$values['habitation_phone']				= $data['insurer_phone'];

		$values['bank']							= $data['insurer_bank'];
		$values['bank_mfo']						= $data['insurer_bank_mfo'];
		$values['bank_account']					= $data['insurer_bank_account'];

		$values['card_car_man_woman']				= $data['card_car_man_woman'];

		$Clients = new Clients($values);
		return $Clients->fill($values);
	}

    function getCode($data) {
        return '901';
    }

    function getNumber($data) {
        global $db;

		$row['number'] = $data['number'];

		/*if (intval($data['parent_id'])) {
			$sql =	'SELECT number, sub_number + 1 AS sub_number ' .
					'FROM ' . PREFIX . '_policies ' .
					'WHERE id = ' . intval($data['parent_id']);
			$row = $db->getRow($sql);
		} else*/
		if (!$row['number']) {
            $sql =  'SELECT CONCAT(' . $db->quote($this->getCode($data)) . ', \'.\', date_format(created, \'%y\'), \'.2\', ' . $db->quote(sprintf('%06d', intval($data['id']))) . ') ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id = ' . intval($data['id']);
            $row['number'] = $db->getOne($sql);
        }

        return $row;
    }

	function updateItems($id, $items) {
		global $db;

		$sql =	'DELETE ' .
				'FROM ' . PREFIX . '_policies_mortage_items ' .
				'WHERE policies_id = ' . intval($id);
		$db->query($sql);

		$sql =	'DELETE ' .
				'FROM ' . PREFIX . '_policies_mortage_item_risks ' .
				'WHERE policies_id = ' . intval($id);
		$db->query($sql);

		if (is_array($items)) {
			foreach ($items as $i => $item) {
				$sql =	'INSERT INTO ' . PREFIX . '_policies_mortage_items SET ' .
						'policies_id = ' . intval($id) . ', ' .
						'title = ' . $db->quote($item['title']) . ', ' .
						'storage = ' . $db->quote($item['storage']) . ', ' .
						'cost = ' . $db->quote($item['cost']) . ', ' .
						'quantity = ' . $db->quote($item['quantity']) . ', ' .
						'amount = ' . $db->quote($item['amount']) . ', ' .
						'rate = ' . $db->quote($item['rate']) . ', ' .
						'price = ' . $db->quote($item['price']);
				$db->query($sql);

				$item['id'] = mysql_insert_id();

				if (is_array($item['risks'])) {
					foreach ($item['risks'] as $j => $risk) {
						foreach ($risk['risks_id'] as $risks_id) {
							$sql =	'REPLACE INTO ' . PREFIX . '_policies_mortage_item_risks SET ' .
									'policies_id = ' . intval($id) . ', ' .
									'items_id = ' . intval($item['id']) . ', ' .
									'risks_id = ' . intval($risks_id) . ', ' .
									'value = ' . $db->quote($risk['value']) . ', ' .
									'absolute = ' . intval($risk['absolute']);
							$db->query($sql);
						}
					}
				}
			}
		}
	}

     

     

	function exportInWindow($data) {
		global $db, $Smarty, $Authorization, $PAYMENT_STATUSES, $POLICY_STATUSES_SCHEMA;

		require_once $Smarty->_get_plugin_filepath('shared','make_timestamp');

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

		$this->checkPermissions('show', $data);

        $hidden['do'] = $data['do'];

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
                $fields[] = 'agencies_id';
                $data['agencies_id'] = $Authorization->data['agencies_id'];
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('agencies_id') ]);
                break;
            case ROLES_ASSISTANCE:
                $this->formDescription = $this->assistanceFormDescription;
                break;
            default:
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('agents_id') ]);
                break;
        }

		if (intval($data['top'])) {
			$fields[] = 'child_id';

			$this->formDescription['fields'][ $this->getFieldPositionByName('number') ]['display']['show'] = true;
			$this->formDescription['fields'][ $this->getFieldPositionByName('sub_number') ]['display']['show'] = true;

			$conditions[] = $this->tables[0] . '.top = '.intval($data['top']);
		} else {
			$conditions[] = $this->tables[0] . '.child_id = 0';
		}

		if (!$data['ECmode']) {
			if ($data['number']) {
				$fields[] = 'number';
				$conditions[] = $this->tables[0] . '.number LIKE ' . $db->quote($data['number'] . '%');
			}

			if ($data['insurer']) {
				$fields[] = 'insurer';
				$conditions[] = $this->tables[0] . '.insurer LIKE ' . $db->quote($data['insurer'] . '%');
			}

			if (intval($data['product_types_id'])) {
				$fields[] = 'product_types_id';

				$ProductTypes = new ProductTypes($data);
				$product_types = array($data['product_types_id']);
				$ProductTypes->getSubId(&$product_types, $data['product_types_id']);

				$conditions[] = $this->tables[0] . '.product_types_id IN(' . implode(', ', $product_types) . ')';
			}

			if ($data['year']) {
				$fields[] = 'year';
				$conditions[] = $this->tables[1] . '.year = ' . $db->quote($data['year']);
			}

			if ($data['shassi']) {
				$fields[] = 'shassi';
				$conditions[] = $this->tables[1] . '.shassi LIKE ' . $db->quote($data['shassi'] . '%');
			}

			if ($data['sign']) {
				$fields[] = 'sign';
				$conditions[] = $this->tables[1] . '.sign LIKE ' . $db->quote($data['sign'] . '%');
			}
			
			if ($data['options_test_drive']) {
				$fields[] = 'options_test_drive';
				$conditions[] = $this->tables[1] . '.options_test_drive =1';
			}
			if ($data['options_race']) {
				$fields[] = 'options_race';
				$conditions[] = $this->tables[1] . '.options_race =1';
			}
			if ($data['special']) {
				$fields[] = 'special';
				$conditions[] = $this->tables[1] . '.special =1';
			}

			if (is_array($data['policy_statuses_id'])) {
				$fields[] = 'policy_statuses_id';
				$conditions[] = 'policy_statuses_id IN(' . implode(', ', $data['policy_statuses_id']) . ')';
			}

			if (is_array($data['payment_statuses_id'])) {
				$fields[] = 'payment_statuses_id';
				$conditions[] = 'payment_statuses_id IN(' . implode(', ', $data['payment_statuses_id']) . ')';
			}

			if (intval($data['financial_institutions_id']) && ereg('KASKO|Property', $this->objectTitle)) {
				$fields[] = 'financial_institutions_id';
				$conditions[] = 'insurance_policies_mortage.financial_institutions_id = ' . intval($data['financial_institutions_id']);
			}

			if ($data['from']) {
				$fields[] = 'from';
				$conditions[] = 'TO_DAYS(' . $this->tables[0] . '.date) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
			}

			if ($data['to']) {
				$fields[] = 'to';
				$conditions[] =  'TO_DAYS(' . $this->tables[0] . '.date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
			}

			if ($data['frombegin_datetime']) {
				$fields[] = 'frombegin_datetime';
				$conditions[] = 'TO_DAYS(' . $this->tables[0] . '.begin_datetime) >= TO_DAYS(' . $db->quote( substr($data['frombegin_datetime'], 6, 4) . substr($data['frombegin_datetime'], 3, 2) . substr($data['frombegin_datetime'], 0, 2) ) . ')';
			}

			if ($data['tobegin_datetime']) {
				$fields[] = 'tobegin_datetime';
				$conditions[] =  'TO_DAYS(' . $this->tables[0] . '.begin_datetime) <= TO_DAYS(' . $db->quote( substr($data['tobegin_datetime'], 6, 4) . substr($data['tobegin_datetime'], 3, 2) . substr($data['tobegin_datetime'], 0, 2) ) . ')';
			}

			if (intval($data['agencies_id'])) {
				$fields[] = 'agencies_id';
				$conditions[] = $this->tables[0] . '.agencies_id = ' . intval($data['agencies_id']);
			}

			if ($data['clients_id']) {
				$fields[] = 'clients_id';
				$conditions[] = $this->tables[0] . '.clients_id = ' . intval($data['clients_id']);
			}
		}
        $fields[] = 'manual';

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        if ($sql) {
            $sql    .= ' ORDER BY ';
        } else {

            if (intval($data['manual'])) {

                $sql = ($this->getFieldPositionByName('payment_statuses_id'))
                    ? 'SELECT ' . $this->getShowFieldsSQLString() . ', IF(' . PREFIX . '_policy_messages.policies_id, 1, 0) as manual, ' . PREFIX . '_payment_statuses.id as payment_statuses_id FROM ' . implode(', ', $this->tables) . ', ' . PREFIX . '_policy_messages '
                    : 'SELECT ' . $this->getShowFieldsSQLString() . ', IF(' . PREFIX . '_policy_messages.policies_id, 1, 0) as manual as payment_statuses_id FROM ' . implode(', ', $this->tables) . ', ' . PREFIX . '_policy_messages ';

                switch ($Authorization->data['roles_id']) {
                    case ROLES_OPERATOR:
                    case ROLES_ADMINISTRATOR:
                        $conditions[] = $this->tables[0] . '.id = ' . PREFIX . '_policy_messages.policies_id AND ' . PREFIX . '_policy_messages.manual=1 AND ' . PREFIX . '_policy_messages.recipient_roles_id=' . ROLES_MANAGER . ' AND ' . PREFIX . '_policy_messages.id NOT IN (SELECT messages_id FROM ' . PREFIX . '_policy_message_views WHERE accounts_id IN (' . implode(', ', $Authorization->data['managers']) . ')) ';
                        break;
                    case ROLES_CLIENT_CONTACT:
                        $conditions[] =	$this->tables[0] . '.id = ' . PREFIX . '_policy_messages.policies_id AND ' . PREFIX . '_policy_messages.manual=1 AND ' . PREFIX . '_policy_messages.recipient_roles_id=' . ROLES_CLIENT_CONTACT . ' AND ' . PREFIX . '_policy_messages.id NOT IN (SELECT messages_id FROM ' . PREFIX . '_policy_message_views WHERE accounts_id IN (' . implode(', ', $Authorization->data['client_contacts']) . ')) ';
                        break;
                }
            } else {
                $sql = ($this->getFieldPositionByName('payment_statuses_id'))
                    ? 'SELECT ' . $this->getShowFieldsSQLString() . ', ' . PREFIX . '_payment_statuses.id as payment_statuses_id FROM ' . implode(', ', $this->tables) . ' '
                    : 'SELECT ' . $this->getShowFieldsSQLString() . ' FROM ' . implode(', ', $this->tables) . ' ';
            }

            if (is_array($conditions)) {
                $sql	.= 'WHERE ' . $this->getAssignmentConditions('show', '', ' AND ') . ' ' . implode(' AND ', $conditions) . ' ORDER BY ';
            } else {
                $sql	.= $this->getAssignmentConditions('show', ' WHERE ') . ' ORDER BY ';
            }
        }

        $sql = str_replace('_agents.id', '_agents.accounts_id', $sql);
        $sql = str_replace('_client_contacts.id', '_client_contacts.accounts_id', $sql);

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);
		$ids = array();
		foreach($list as $row) {
			$ids[]=$row['id'];
		}

		if (sizeof($ids)>0) {
			$payments = $db->getAll('SELECT * FROM ' . PREFIX . '_policy_payments_calendar WHERE policies_id IN ('.implode(' , ', $ids).') ORDER BY policies_id, date');
			if (is_array($payments) && sizeof($payments)>0) {
                foreach($list as $i=>$row) {
                    foreach($payments as $payment) {
                        if ($list[$i]['id'] == $payment['policies_id']) {
                            $list[$i]['payments'][] = $payment;
                        }
                    }
                }
            }
		}

		include 'Property/excel.php';
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
	
	function updateParent($data) {
		global $db, $Log, $UNDERWRITING_POLICY_STATUSES;
		 
		if (intval($data['parent_id'])) {
			//устанавливаем top для нового, и child_id and interrupt_datetime для старого
			$sql =	'UPDATE ' . PREFIX . '_policies AS a, ' . PREFIX . '_policies AS b SET ' .
					'b.interrupt_datetime = DATE_ADD(a.begin_datetime, INTERVAL -1 DAY) ' .
					'WHERE a.id = ' . intval($id) . ' AND b.id = ' . intval($data['parent_id']);
			$db->query($sql);

			if ($data['policy_statuses_id'] == POLICY_STATUSES_GENERATED) {

				//удаляем все, что не были полностью оплачены
				$sql =	'DELETE FROM ' . PREFIX . '_policy_payments_calendar ' .
						'WHERE policies_id = ' . intval($data['parent_id']) . ' AND statuses_id IN(' . PAYMENT_STATUSES_NOT . ', ' . PAYMENT_STATUSES_PARTIAL . ')';
				$db->query($sql);

				//считаем сумму по предыдущему полису на которую были предоставлены услуги
				$sql =	'SELECT DATEDIFF( interrupt_datetime, begin_datetime ) * amount / DATEDIFF( end_datetime, begin_datetime ) ' .
						'FROM ' . PREFIX . '_policies ' .
						'WHERE id = ' . intval($data['parent_id']);
				$usedAmount = doubleval($db->getOne($sql));

				//считаем то что проплатили по факту по предыдущему полису
				$sql =	'SELECT SUM(amount) ' .
						'FROM ' . PREFIX . '_policy_payments ' .
						'WHERE  policies_id = ' . intval($data['parent_id']);
				$factAmount = doubleval($db->getOne( $sql ));

				if ($factAmount < $usedAmount) {//по факту заплатили меньше чем уже оказали услуг делаем корректировку в календарь платежей

					$sql =	'SELECT interrupt_datetime ' .
							'FROM ' . PREFIX . '_policies ' .
							'WHERE id = ' . intval($data['parent_id']);
					$interrupt_datetime=$db->getOne($sql);

					$sql =	'INSERT INTO ' . PREFIX . '_policy_payments_calendar (policies_id ,date ,amount, file, statuses_id) ' .
							'SELECT ' . intval($data['parent_id']) . ', ' . $db->quote($interrupt_datetime) . ', ' . round($usedAmount - $factAmount,2) . ', 1, 1';
					$db->query($sql);

					$Log->add('confirm', 'Календар платежiв попереднього полiсу було скореговано');
				}
			}	
		}
	}
	
	function setAdditionalFields($id, $data) {
        global $db, $Log, $UNDERWRITING_POLICY_STATUSES;

		$data['clients_id'] = $this->setClient($data);

        $row = $this->getNumber($data);

        $sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_mortage AS b ON a.id = b.policies_id ' .
				'JOIN ' . PREFIX . '_product_types AS c ON a.product_types_id = c.id ' .
				'LEFT JOIN ' . PREFIX . '_financial_institutions AS d ON b.financial_institutions_id = d.id ' .
				'LEFT JOIN ' . PREFIX . '_policies AS e ON e.id = ' . intval($data['parent_id']) . ' SET ' .
				'a.parent_id = ' . intval($data['parent_id']) . ', ' .
				'a.top = IF(e.top > 0, e.top, ' . intval($id) . '), ' .
				'a.clients_id = ' . intval($data['clients_id']) . ', ' .
				'a.product_types_expense_percent = c.expense_percent, ' .
                'a.number = IF(a.number, a.number, ' . $db->quote($row['number']) . '), ' .
                'a.sub_number = IF(a.sub_number, a.sub_number, ' . $db->quote($row['sub_number']) . '), ' .
                'a.date = IF(TO_DAYS(a.date) > 0, a.date, ' . $db->quote($data['date_year'] . $data['date_month'] . $data['date_day']) . '), ' .
                'a.insurer = IF(b.insurer_person_types_id = 2, b.insurer_company, CONCAT(b.insurer_lastname ,\' \', b.insurer_firstname )), ' .
				'a.item = ' . $db->quote('Майно') . ', ' .
				'a.interrupt_datetime = a.end_datetime, ' .
                'b.assured_title = IF(b.financial_institutions_id, d.title, b.assured_title), ' .
                'b.assured_identification_code = IF(b.financial_institutions_id, d.edrpou, b.assured_identification_code), ' .
                'b.assured_address = IF(b.financial_institutions_id, d.address, b.assured_address), ' .
                'b.assured_phone = IF(b.financial_institutions_id, d.phone, b.assured_phone), ' .
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

            if ($Authorization->data['roles_id'] == ROLES_AGENT) {

                $sql =  'SELECT * ' .
                        'FROM ' . PREFIX . '_agents ' .
                        'WHERE accounts_id = ' . intval($Authorization->data['id']);
                $row = $db->getRow($sql);

                $sql =  'UPDATE ' . PREFIX . '_policies_mortage SET ' .
                        'agent_lastname = ' . $db->quote($row['lastname']) .  ', ' .
                        'agent_firstname =  ' . $db->quote($row['firstname']) . ', ' .
                        'agent_patronymicname = ' . $db->quote($row['patronymicname']) . ' ' .
                        'WHERE policies_id=' . intval($data['id']);
                $db->query($sql);
            }

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&policies_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'] . '&insurer_person_types_id=' . $data['insurer_person_types_id']);
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

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&policies_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'] . '&insurer_person_types_id=' . $data['insurer_person_types_id']);
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

		$data['product_types_id']	= PRODUCT_TYPES_MORTAGE;
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
				case 'insurerTitle':
					switch ($values['insurer_person_types_id']) {
						case 1:
							$values[ $field ] = $values['insurer_lastname'] . ' ' . $values['insurer_firstname'] . ' ' . $values['insurer_patronymicname'];
							break;
						case 2:
							$values[ $field ] = $values['insurer_company'];
							break;
					}
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
						switch ($values['insurer_person_types_id']) {
							case 1:
								$values[ $field ] .= ', кв. ' . $values['insurer_flat'];
								break;
							case 2:
								$values[ $field ] .= ', оф. ' . $values['insurer_flat'];
								break;
						}
					}
                    break;
                case 'payed':
                    $values[ $field ] = $values['sample'];
				case 'closed':
					$values[ $field ] = $this->isClosedByPolicyStatusesId($values['policy_statuses_id']);
					break;
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

        $sql =  'UPDATE ' . PREFIX . '_policies_mortage SET ' .
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

        $sql =  'SELECT a.*, b.*, c.*, DATE_SUB(begin_datetime, INTERVAL 1 DAY) AS endPaymentDate,  IF(payment_statuses_id<>' . PAYMENT_STATUSES_NOT . ' OR LENGTH(payment_number)>0, 0, 1) AS sample, ' .
				'd.title AS agencies_title, d.edrpou AS agencies_edrpou, d.ground_kasko_express as ground_kasko, d.director1, d.director2, c.insurer_person_types_id as person_types_id, ' .
				'e.title as insurerRegionsTitle, f.title AS insurer_streetTypesTitle ' .
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . $this->tables[0] . ' AS b ON a.policies_id = b.id ' .
                'JOIN ' . $this->tables[1] . ' AS c ON b.id = c.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_agencies AS d ON b.agencies_id = d.id ' .
				'LEFT JOIN ' . PREFIX . '_regions AS e ON c.insurer_regions_id = e.id ' .
				'LEFT JOIN ' . PREFIX . '_street_types AS f ON c.insurer_street_types_id = f.id ' .
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

		$row['values']	= $db->getAssoc('SELECT values_id, 1 FROM ' . PREFIX . '_policies_property_mortage_values_assignments WHERE policies_id = ' . intval($row['policies_id']));
		$row['risks']	= $db->getAssoc('SELECT risks_id, 1 FROM ' . PREFIX . '_policies_property_risks_assignments WHERE policies_id = ' . intval($row['policies_id']));
		
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

		$fields = array(
					'insurerTitle',
					'insurer_address',
					'closed');

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

		$Log->add('confirm', 'Поліс було успішно анульовано.');

		header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
		exit;
	}

    function get($id) {
        global $db;

        $sql =	'SELECT * ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_mortage AS b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        $row = $db->getRow($sql);

        return $row;
    }
	
	//Export 1C 7.7
     function getXML($data) {
        global $db, $Smarty;

      $conditions[] = 'a.product_types_id=15';
 
	  
      if ($data['number']) {
            $conditions[] = 'a.number=' . $db->quote($data['number']);
        } else {
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.date )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.date )>=TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.date )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.date ) <= TO_DAYS(NOW())';
        }



        $sql =  'SELECT a.*, b.*,1 as insurer_person_types_id,e.code,c.title AS policy_statuses_title, d.title AS insurer_regions_title,  IF(e1.id>0,e1.title,e.title) AS agencies_title ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_mortage AS b ON a.id = b.policies_id ' .
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
        return  $Smarty->fetch($this->object . '/mortage.xml');
    }
	
}

?>