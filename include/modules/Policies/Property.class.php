<?
/*
 * Title: policy PROPERTY class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'PolicyDocuments.class.php';
require_once 'PropertyObjects.class.php';

class Policies_Property extends Policies {

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
                            'table'             => 'policies_property'),
                        array(
                            'name'              => 'terms_id',
                            'description'       => 'Термін страхування',
                            'type'              => fldSelect,
                            'showId'            => true,
							'condition'         => 'product_types_id = 0 ',
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
                            'table'             => 'policies_property',
                            'sourceTable'       => 'parameters_terms',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
						array(
                            'name'              => 'organization_types_id',
                            'showId'            => true,
                            'description'       => 'Вид діяльності організації',
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
                            'table'             => 'policies_property',
                            'sourceTable'       => 'policies_property_objects_company_activities',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
						array(
                            'name'              => 'organization_types_title',
                            'showId'            => true,
                            'description'       => 'Вид діяльності організації, інше',
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
							
							
							
						 array(
                            'name'              => 'insurer_lastname_rod',
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
                            'table'             => 'policies_property'),
                        array(
                            'name'              => 'insurer_firstname_rod',
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
                            'table'             => 'policies_property'),
                        array(
                            'name'              => 'insurer_patronymicname_rod',
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
                            'table'             => 'policies_property'),

							
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
                            'table'             => 'policies_property'),
						 array(
                            'name'              => 'insurer_position_rod',
                            'description'       => 'Страхувальник, посада родовий',
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
                            'table'             => 'policies_property'),	
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_property'),
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_property'),
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property',
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
							'table'				=> 'policies_property',
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property',
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
                         array(
                            'name'              => 'credit_agreement_number',
                            'description'       => 'Вигодонабувач, Кредитний договір, номер',
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
                            'table'             => 'policies_property'),
                         array(
                            'name'              => 'credit_agreement_date',
                            'description'       => 'Вигодонабувач, Кредитний договір від, дата',
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
                            'table'             => 'policies_property'),
                        array(
                            'name'              => 'pawn_agreement_number',
                            'description'       => 'Вигодонабувач, Договір застави, номер',
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
                            'table'             => 'policies_property'),
                         array(
                            'name'              => 'pawn_agreement_date',
                            'description'       => 'Вигодонабувач, Договір застави від, дата',
                            'type'              => fldDate,
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
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
                            'table'             => 'policies_property'),
						array(
                            'name'              => 'zones_title',
                            'description'       => 'Територія дії Договору',
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
                            'table'             => 'policies_property'),
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
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
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
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
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
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
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
                                    'update'    => false
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
                            'name'              => 'multi_year',
                            'description'       => 'Багатолiтнiй',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_property'),	
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
                            'table'             => 'policies_property',
                            'sourceTable'       => 'agents',
                            'condition'         => 'LENGTH(director1)>0 AND LENGTH(director2)>0',
                            'selectField'       => 'CONCAT(lastname, \' \', firstname,\' \',patronymicname)',
                            'orderField'        => 'lastname'),
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

		var $payment_formDescription =
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
                            'name'              => 'number',
                            'description'       => 'Номер',
                            'type'              => fldText,
                            'maxlenght'         => 20,
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
                            'name'              => 'options_first_payment',
                            'description'       => 'Перший платiж до початку дiї страхового покриття',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_property'),
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
                            'name'              => 'assured_title',
                            'description'       => 'Вигодонабувач, ПІБ (назва)',
                            'type'              => fldText,
                            'maxlength'         => 200,
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
                            'table'             => 'policies_property'),
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
                            'orderPosition'     => 14,
                            'width'             => 100,
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
                            'table'             => 'policies')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 15,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'number'
                    )
                );

    function Policies_Property($data) {
        Policies::Policies($data);

        $this->objectTitle = 'Policies_Property';

        $this->messages['plural'] = 'Поліси "Майно"';
        $this->messages['single'] = ($data['types_id'] == POLICY_TYPES_QUOTE) ? 'Котирування "Майно"' : 'Поліс "Майно"';

		$this->setPolicyStatusesSchema(null, &$data);
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
							POLICY_STATUSES_REQUEST_QUOTE ),
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

		return parent::add($data);
	}

    function buildSelect($field, $value, $languageCode=null, $addition=null, $indexType=null, $data=null, $class=null) {
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
            case 2:
                header('Location: /?do=' . $this->object . '|' . $this->mode . 'Objects&policies_id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
                break;
            case 3:
                header('Location: /?do=' . $this->object . '|' . $this->mode . 'Payments&policies_id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
                break;
            default:
                header('Location: /?do=' . $this->object . '|show');
                exit;
                break;
        }
    }

	function updateObjects($data) {

        $data['step'] = 2;

        $this->updateStep($data['policies_id'], $data['step'] + 1);

        $data['policies'] =& $this;

        $PropertyObjects = new PropertyObjects($data);
        $PropertyObjects->show($data, $fields, $conditions, null, $PropertyObjects->object . '/show.php');
    }

    function viewObjects($data) {

        $data['step'] = 2;

        $data['policies'] =& $this;

        $PropertyObjects = new PropertyObjects($data);
        $PropertyObjects->show($data, $fields, $conditions, null, $PropertyObjects->object . '/show.php');
    }

    function getFormFields($action) {
        parent::getFormFields($action);
        $this->formFields[]='insurer_person_types_id';
		$this->formFields[]='insurer_identification_code';
    }

	function updatePayments($data,$redirect = true) {
		global $Log,$db;

        $data['id'] = $data['policies_id'];
        $data['insurer_person_types_id'] = $db->getOne('SELECT insurer_person_types_id FROM '.PREFIX.'_policies_property WHERE policies_id='.intval($data['policies_id']));
		
		$this->formDescription = $this->payment_formDescription;


		$this->checkPermissions('update', $data);

		$data['step'] = 3;

        if ($_POST['do'] == 'Policies|updatePayments') {
            if ($data['insurer_person_types_id'] == 1) {//физик

                $unsetFields = array(
                    'date',
                    'begin_datetime',
                    'end_datetime',
                    'options_first_payment',
                    'interrupt_datetime');

                foreach($unsetFields as $field) {
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName($field) ]);
                }
            }
			if (parent::update(&$data, false, false)) {
			
				$this->updateCalendar($data['id'], $data);

				$this->updateParent($data);

				$this->generateDocuments($data['id']);

				if ($redirect) {

					$params['title']	= $this->messages['single'];
					$params['id']		= $data['id'];
					$params['storage']	= $this->tables[0];

                    $_SESSION['Policies'][ $data['id'] ]['mode'] = 'view';

					$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

					header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewPayments&id=' . $data['id'] . '&policies_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
					exit;
				} else {
					return $data['id'];
				}
			}
		} else {
			$data = $this->load($data, false);
	        $data['multi_year'] = $db->getOne('SELECT multi_year FROM '.PREFIX.'_policies_property WHERE policies_id='.intval($data['id']));

		}

        $data['policies'] =& $this;

        $this->showForm($data, 'updatePayments','update', 'paymentsCalendar.php');
    }

    function viewPayments($data) {
		$this->formDescription = $this->payment_formDescription;

		$data['id']= $data['policies_id'];

		$this->checkPermissions('view', $data);

		$data['checkPermissions'] = 1;

		$data = $this->load($data, false);

		$data['step'] = 3;

        $data['policies'] =& $this;

		$this->prepareFields('view', $data);

        $this->showForm($data, 'viewPayments','view', 'paymentsCalendar.php');
    }

	function addObject($data ) {
        global $db, $Log;

         if (is_array($data['id']) && sizeof($data['id'])>0) {
			$data['id'] = $data['id'][0];
        }

		$data['step'] = 2;

        //$this->updateStep($data['policies_id'], $data['step'] + 1);

        $data['policies'] =& $this;

        $PropertyObjects = new PropertyObjects($data);
		
		if (!$_POST['InWindow'] && $data['mode'] != 'simple') {
            $this->header($data);
        }

		if ($data['do']!='PropertyObjects|update' && $data['do']!='PropertyObjects|insert') {
			$PropertyObjects->add($data);
		} else {
			$PropertyObjects->showForm($data, 'insert');
		}

        if (!$_POST['InWindow'] && $data['mode'] != 'simple') {
            $this->footer($data);
        }
    }
	
	function updateObject($data ) {
        global $db, $Log;

        if (is_array($data['id']) && sizeof($data['id'])>0) {
			$data['id']=$data['id'][0];
        } 

		$data['step'] = 2;

        //$this->updateStep($data['policies_id'], $data['step'] + 1);

        $data['policies'] =& $this;

        $PropertyObjects = new PropertyObjects($data);
		
		if (!$_POST['InWindow'] && $data['mode'] != 'simple') {
            $this->header($data);
        }

		if ($data['do']!='PropertyObjects|update' && $data['do']!='PropertyObjects|insert') {
			$PropertyObjects->load($data);
		} else {
			$PropertyObjects->showForm($data, 'update', 'update', null);
		}

        if (!$_POST['InWindow'] && $data['mode'] != 'simple') {
            $this->footer($data);
        }
    }

	function showForm($data, $action, $actionType=null, $template=null) {
        global $db, $Authorization, $POLICY_STATUSES_SCHEMA;

		$sql =	'SELECT a.id, a.title ' .
				'FROM ' . PREFIX . '_parameters_risks AS a ' .		
				'JOIN ' . PREFIX . '_product_risks AS b ON a.id = b.risks_id ' .
				'WHERE a.product_types_id = ' . PRODUCT_TYPES_PROPERTY . ' ' .
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
			case 'viewPayments':
            case 'updatePayments':
                $data['step'] = 3;
                break;
            case 'loadObject':
            case 'updateObject':
                $data['step'] = 3;
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

        return parent::setConstants($data);
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
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'zones_title' ) ]['verification']['canBeEmpty'] = true;
				$this->formDescription['fields'][ $this->getFieldPositionByName( 'organization_types_id' ) ]['verification']['canBeEmpty'] = true;

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

		if (intval($data['parent_id'])) {
			//проверяем целостность периода страхования
			$sql =	'SELECT IF(begin_datetime < ' . $db->quote($data['begin_datetime_year'] . '-' . $data['begin_datetime_month'] . '-' . $data['begin_datetime_day']) . ', 0, 1) AS low, ' .
					'IF(' . $db->quote($data['begin_datetime_year'] . '-' . $data['begin_datetime_month'] . '-' . $data['begin_datetime_day']) . ' < end_datetime, 0, 1) as high ' .
					'FROM ' . PREFIX . '_policies ' .
					'WHERE id = ' . intval($data['parent_id']);
			$row =	$db->getRow($sql);

			if ($row['low'] == 1) {
				$Log->add('error', 'Період страхування повинен бути цілістним. Початок дії полісу не може бути раніше початку полісу, що переоформлюється.');
			}

			/*if ($row['high'] == 1) {
				$Log->add('error', 'Період страхування повинен бути цілістним. Початок дії полісу не може бути пізніше пізніще дати закінчення.');
			}*/
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

		if (round($amount, 2) != round($data['amount'], 2)) {//round небходим для корректного сравнения, бывают приколы сравления одинаковых сумм с выдачей не равно из-за способа хранения
			$Log->add('error', 'Сума платежів сгідно графіку не збігається зі страховою премією за полісом.');
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

		$values['bank']							= $data['insurer_bank'];
		$values['bank_mfo']						= $data['insurer_bank_mfo'];
		$values['bank_account']					= $data['insurer_bank_account'];

		$values['card_car_man_woman']			= $data['card_car_man_woman'];

		$Clients = new Clients($values);
		return $Clients->fill($values);
	}

    function getCode($data) {
        return '102';
    }

    function getNumber($data) {
        global $db;

		$row['number'] = $data['number'];

		if (intval($data['parent_id'])) {
			$sql =	'SELECT number, sub_number + 1 AS sub_number ' .
					'FROM ' . PREFIX . '_policies ' .
					'WHERE id = ' . intval($data['parent_id']);
			$row = $db->getRow($sql);
		} else if (!$row['number']) {
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
				'FROM ' . PREFIX . '_policies_property_items ' .
				'WHERE policies_id = ' . intval($id);
		$db->query($sql);

		$sql =	'DELETE ' .
				'FROM ' . PREFIX . '_policies_property_item_risks ' .
				'WHERE policies_id = ' . intval($id);
		$db->query($sql);

		if (is_array($items)) {
			foreach ($items as $i => $item) {
				$sql =	'INSERT INTO ' . PREFIX . '_policies_property_items SET ' .
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
							$sql =	'REPLACE INTO ' . PREFIX . '_policies_property_item_risks SET ' .
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

    //поиск договора страхования при заполении данных из заявления на страхование
    function getSearchInWindow($data) {
        global $db;

        if (intval($data['policies_id'])) {
//            $conditions[] = 'a.id = ' . intval($data['policies_id']);
        }

        if ($data['number']) {
            $conditions[] = 'a.number = ' . $db->quote($data['number']);
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

            /*$sql =  'SELECT b.policies_id, d.id as items_id, IF(b.insurer_person_types_id = 1, ' .
                    'CONCAT(b.insurer_lastname, \' \', b.insurer_firstname, \' \', b.insurer_patronymicname), b.insurer_company) AS insurer, ' .
                    'a.number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format, ' .
                    'date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS begin_datetime_format, ' .
                    'date_format(a.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS interrupt_datetime_format, ' .
                    'd.title as item ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_property AS b ON a.id = b.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_property_objects AS c ON a.id = c.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_property_objects_items AS d ON c.id = d.objects_id ' .
                    'JOIN (SELECT MAX(created) as created, number FROM ' . PREFIX . '_policies GROUP BY number) as created_date ON created_date.number = a.number ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' AND a.created = created_date.created ' .
                    'ORDER BY begin_datetime DESC';*/
            $sql =  'SELECT b.policies_id, IF(b.insurer_person_types_id = 1, ' .
                    'CONCAT(b.insurer_lastname, \' \', b.insurer_firstname, \' \', b.insurer_patronymicname), b.insurer_company) AS insurer, ' .
                    'a.number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format, ' .
                    'date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS begin_datetime_format, ' .
                    'date_format(a.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS interrupt_datetime_format ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_property AS b ON a.id = b.policies_id ' .
                    'JOIN (SELECT MAX(created) as created, number FROM ' . PREFIX . '_policies GROUP BY number) as created_date ON created_date.number = a.number ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' AND a.created = created_date.created ' .
                    'ORDER BY begin_datetime DESC';
            $list = $db->getAll($sql);

			$result =   '<table width="100%" cellpadding="0" cellspacing="0">' .
							'<tr class="columns">' .
							'<td class="id">&nbsp;</td>' .
							'<td>Страхувальник</td>' .
							'<td>Номер</td>' .
							'<td>Дата</td>' .
							'<td>Початок</td>' .
							'<td>Закінчення</td>' .
						'</tr>';

			switch (sizeOf($list)) {
				case 0:
					$result .= '<tr><td colspan="9" align="center" style="color: red;">Згідно заданних критеріїв пошуку поліс не знайдено.</td></tr>';
					$result .= '</table>';
					break;
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
				case 6:
				case 7:
				case 8:
				case 9:
				case 10:

					$this->mode = Accidents::getMode($data['accidents_id']);

					foreach ($list as $row) {
						$result .=  '<tr class="row' . (($i % 2 == 0) ? '1' : '0') .'">' .
										'<td align="center"><input type="radio" name="policies_id" value="' . $row['policies_id'] . '" ' . ( ($row['policies_id'] == $data['policies_id']) ? 'checked' : '') . ' onClick="choosePolicy(' . $row['policies_id'] . ')" ' . $this->getReadonly(true) . ' /></td>' .
										'<td>' . $row['insurer'] . '</td>' .
										'<td><a href="/?do=Policies|view&id=' . $row['policies_id'] . '&product_types_id=' . PRODUCT_TYPES_PROPERTY . '" target="_blank">' . (($data['important_person'] == 0) ? $row['number'] : $row['number'] . ' <b style="color: red;">VIP</b>') . '</a></td>' .
										'<td>' . $row['date_format'] . '</td>' .
										'<td>' .
                                                $row['begin_datetime_format'] .
                                                '<input type="hidden" name="policies_begin_datetime_format[' . $row['policies_id'] . ']" value="' . $row['begin_datetime_format'] . '" />' .
                                        '</td>'.
										'<td>' .
                                                $row['interrupt_datetime_format'] .
                                                '<input type="hidden" name="_policies_interrupt_datetime_format[' . $row['policies_id'] . ']" value="' . $row['interrupt_datetime_format'] . '" />' .
                                        '</td>'.
									'</tr>';
					}

					$result .= '</table>';

					if ($row['policies_id'] == $data['policies_id']) $data['policies_id'] = $row['policies_id'];

					$result .= '<input type="hidden" id="policies_id" name="policies_id" value="' . $data['policies_id'] . '" />';
					break;
				default:
					$result .= '<tr><td colspan="9" align="center" style="color: red;">Згідно заданних критеріїв знайдено багато полісів. Змініть критерії пошуку.</td></tr>';
					$result .= '</table>';
			}
        }

        echo $result;
    }

    function getApplicantValuesInWindow($data) {
		global $db;

//		$this->checkPermissions('view', $data);

		$conditions = array(PREFIX . '_policies_property_items.id = ' . intval($data['id']));

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_policies_property_items ' .
				'JOIN ' . PREFIX . '_policies_property ON ' . PREFIX . '_policies_property_items.policies_id = ' . PREFIX . '_policies_property.policies_id ' .
				'WHERE ' . implode(' AND ', $conditions);
		$row = $db->getRow($sql);

		$row = $db->getRow($sql);

		switch ($data['person']) {
			case 'owner':
			case 'insurer':
				$result = '{"lastname":"' . $row[ $data['person'] . '_lastname'] . '",' .
							'"firstname":"' . $row[ $data['person'] . '_firstname'] . '",' .
							'"patronymicname":"' . $row[ $data['person'] . '_patronymicname'] . '",' .
							'"regions_id":"' . $row[ $data['person'] . '_regions_id'] . '",' .
							'"area":"' . $row[ $data['person'] . '_area'] . '",' .
							'"city":"' . $row[ $data['person'] . '_city'] . '",' .
							'"street_types_id":"' . $row[ $data['person'] . '_street_types_id'] . '",' .
							'"street":"' . $row[ $data['person'] . '_street'] . '",' .
							'"house":"' . $row[ $data['person'] . '_house'] . '",' .
							'"flat":"' . $row[ $data['person'] . '_flat'] . '",' .
							'"phone":"' . $row[ $data['person'] . '_phone'] . '"}';
				break;
		}

		echo $result;
		exit;
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
				$conditions[] = 'insurance_policies_property.financial_institutions_id = ' . intval($data['financial_institutions_id']);
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
 		    $agents = $db->getAll('SELECT a.id as policies_id,b.lastname,b.firstname,b.patronymicname FROM ' . PREFIX . '_policies a JOIN insurance_accounts b on b.id=a.agents_id WHERE a.id IN ('.implode(' , ', $ids).') ');
			if (is_array($payments) && sizeof($payments)>0) {
                foreach($list as $i=>$row) {
                    foreach($payments as $payment) {
                        if ($list[$i]['id'] == $payment['policies_id']) {
                            $list[$i]['payments'][] = $payment;
                        }
                    }
                }
            }
			if (is_array($agents) && sizeof($agents)>0) {
                foreach($list as $i=>$row) {
                    foreach($agents as $agent) {
                        if ($list[$i]['id'] == $agent['policies_id']) {
                            $list[$i]['agent'] = $agent['lastname'].' '.$agent['firstname'];
							break;
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
		
		if ($data['policy_statuses_id'] == POLICY_STATUSES_GENERATED) {
			//!!! надо будет перенести в календарь платежей
			//удаляем из календаря те что были
			$sql =	'DELETE ' .
					'FROM ' . PREFIX . '_policy_payments_calendar ' . 
					'WHERE policies_id = ' . intval($data['parent_id']) . ' AND statuses_id = ' . PAYMENT_STATUSES_NOT;
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
                'JOIN ' . PREFIX . '_policies_property AS b ON a.id = b.policies_id ' .
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

                $sql =  'UPDATE ' . PREFIX . '_policies_property SET ' .
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
				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateObjects&id=' . $data['id'] . '&policies_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'] . '&insurer_person_types_id=' . $data['insurer_person_types_id']);
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

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies_property_items  ' .
                'WHERE ' . implode(' AND ', $conditions);
        $data['items'] = $db->getAll($sql);

        if (is_array($data['items'])) {
            foreach ($data['items'] as $i=>$row) {
                $sql =  'SELECT * ' .
                        'FROM ' . PREFIX . '_policies_property_item_risks ' .
                        'WHERE items_id = ' . intval($row['id']) . ' ' .
						'ORDER BY value, absolute';
                $risks = $db->getAll($sql);

				if (is_array($risks)) {
					$dudectible = '';
					foreach ($risks as $risk) {
						if ($dudectible == $risk['value'] . $risk['absolute']) {
							$data['items'][ $i ]['risks'][ sizeOf($data['items'][ $i ]['risks']) - 1 ]['risks_id'][] = $risk['risks_id'];
						} else {
							$data['items'][ $i ]['risks'][] = array(
								'risks_id'	=> array($risk['risks_id']),
								'value'		=> $risk['value'],
								'absolute'	=> $risk['absolute']);
							$dudectible = $risk['value'] . $risk['absolute'];
						}
					}
				}
            }
        }

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

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateObjects&id=' . $data['id'] . '&policies_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'] . '&insurer_person_types_id=' . $data['insurer_person_types_id']);
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

		$data['product_types_id']	= PRODUCT_TYPES_PROPERTY;
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

        return parent::deleteProcess($data, $i, $folder);
    }

    function prepareValues($fields, $values) {
        global $REGIONS;

        foreach ($fields as $field) {
            switch ($field) {
				case 'insurer_title':
                    $values[ $field ] = $values['insurer_company'] ;
                    break;
                case 'insurer_address':
                    $values[ $field ] = $values['insurerRegionsTitle'];

                    if (!in_array($values['insurer_regions_id'], $REGIONS)) {
                        $values[ $field ] .= ', ' .$values['insurer_city'];
                    }

                    $values[ $field ] .=  ', ' . $values['insurer_streetTypesTitle'] . ' ' . $values['insurer_street'] . ', буд.' . $values['insurer_house'];

                    if ($values['insurer_flat']) {
                        $values[ $field ] .= ', кв.' . $values['insurer_flat'];
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

        $sql =  'UPDATE ' . PREFIX . '_policies_property SET ' .
                'sign_agents_id = ' . intval($data['sign_agents_id']) . ' ' .
                'WHERE policies_id = ' . intval($data['policies_id']);
        $db->query($sql);

        if ($this->getPolicyStatusesId($data['policies_id']) == POLICY_STATUSES_GENERATED) {
            PolicyDocuments::generateTemplates($data['policies_id'], null, true);
        }

        echo 'Ok';
        exit;
    }

    //!!!использую только в заявлении при событии
	function getRisksInWindow($data) {
		global $db;

		$conditions[] = 'items.id = ' . intval($data['items_id']);

		$sql =	'SELECT risks.id as risks_id, risks.title ' .
				'FROM ' . PREFIX . '_policies_property_objects_risks_assignments as objects_risk ' .
                'JOIN ' . PREFIX . '_parameters_risks as risks ON objects_risk.risks_id = risks.id ' .
                'JOIN ' . PREFIX . '_policies_property_objects as objects ON objects.id = objects_risk.policies_property_objects_id ' .
                'JOIN ' . PREFIX . '_policies_property_objects_items as items ON objects.id = items.objects_id ' .
				'WHERE ' . implode(' AND ', $conditions);
		$list = $db->getAll($sql);

		$this->mode = Accidents::getMode($data['accidents_id']);

		include_once $this->object . '/risksInWindow.php';
		exit;
	}

    function getObjectsInWindow($data){
        global $db;

        $conditions[] = 'policies_id = ' . $data['policies_id'];

        $sql = 'SELECT id as objects_id, title ' .
               'FROM ' . PREFIX . '_policies_property_objects ' .
               'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        $this->mode = Accidents::getMode($data['accidents_id']);

        $result = '';
        $result .= '<table cellspacing="0" cellpadding="0">';

        if(is_array($list)){
            $result .= '<th colspan="2" align="left">Об\'єкти</th>';
            $result .= '<tr class="columns"><td></td><td>Об\'єкт</td></tr>';
            foreach($list as $row){
                $result .= '<tr>';
                $result .= '<td><input type="radio" name="objects_id" value="' . $row['objects_id'] . '"' . (($row['objects_id'] == $data['objects_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true) . ' onClick="setItems('.$row['objects_id'].')" /></td><td> ' . $row['title'] . ' </td>';
                $result .= '</tr>';
            }
        }else{
            $result .= '<tr><td>Об\'єктів не знайдено</td></tr>';
        }

        $result .= '</table>';

        echo $result;
        exit;
    }

    function getObjectsItemsInWindow($data){
        global $db;

        $conditions[] = 'policies_id = ' . $data['policies_id'];

        $sql = 'SELECT items.id as items_id, objects.title as objects_title, items.title as items_title ' .
               'FROM ' . PREFIX . '_policies_property_objects as objects ' .
               'JOIN ' . PREFIX . '_policies_property_objects_items as items ON objects.id = items.objects_id ' .
               'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        $this->mode = Accidents::getMode($data['accidents_id']);

        $result = '';
        $result .= '<table cellspacing="0" cellpadding="5">';

        if(is_array($list)){
            $result .= '<th colspan="2" align="left">Об\'єкти</th>';
            $result .= '<tr class="columns"><td></td><td>Об\'єкт</td><td>Застраховане майно</td></tr>';
            foreach($list as $row){
                $result .= '<tr>';
                $result .= '<td><input type="radio" name="items_id" value="' . $row['items_id'] . '"' . (($row['items_id'] == $data['items_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true) . ' onClick="setRisk('.$row['items_id'].')" /></td><td> ' . $row['objects_title'] . ' </td><td> ' . $row['items_title'] . ' </td>';
                $result .= '</tr>';
            }
        }else{
            $result .= '<tr><td>Об\'єктів не знайдено</td></tr>';
        }

        $result .= '</table>';

        echo $result;
        exit;
    }

    function getItemsInWindow($data){
        global $db;

        $conditions[] = 'objects_id = ' . $data['objects_id'];

        $sql = 'SELECT id as items_id, title ' .
               'FROM ' . PREFIX . '_policies_property_objects_items ' .
               'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        $this->mode = Accidents::getMode($data['accidents_id']);

        $result = '';
        $result .= '<table cellspacing="0" cellpadding="0">';

        if(is_array($list)){
            $result .= '<th colspan="2" align="left">Перелік застрахованого майна</th>';
            $result .= '<tr class="columns"><td></td><td>Застраховане майно</td></tr>';
            foreach($list as $row){
                $result .= '<tr>';
                $result .= '<td><input type="radio" name="items_id" value="' . $row['items_id'] . '"' . (($row['items_id'] == $data['items_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true) . ' /></td><td> ' . $row['title'] . ' </td>';
                $result .= '</tr>';
            }
        }else{
            $result .= '<tr><td>Перелік застрахованого майна не знайдено</td></tr>';
        }

        $result .= '</table>';

        echo $result;
        exit;
    }

    function getValues($file) {
        global $db, $Smarty;

        $sql =  'SELECT a.*, b.*, c.*, DATE_SUB(begin_datetime, INTERVAL 1 DAY) AS endPaymentDate,  IF(payment_statuses_id<>' . PAYMENT_STATUSES_NOT . ' OR LENGTH(payment_number)>0, 0, 1) AS sample, ' .
				'd.title AS agencies_title, d.edrpou AS agencies_edrpou, d.ground_kasko_express as ground_kasko, d.director1, d.director2, c.insurer_person_types_id as person_types_id, ' .
				'e.title as insurerRegionsTitle, f.title AS insurer_streetTypesTitle,IF (LENGTH(organization_types_title)>1, c.organization_types_title,f1.title) as organization_types_title ' .
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . $this->tables[0] . ' AS b ON a.policies_id = b.id ' .
                'JOIN ' . $this->tables[1] . ' AS c ON b.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS d ON b.agencies_id = d.id ' .
				'JOIN ' . PREFIX . '_regions AS e ON c.insurer_regions_id = e.id ' .
				'JOIN ' . PREFIX . '_street_types AS f ON c.insurer_street_types_id = f.id ' .
				'LEFT JOIN ' . PREFIX . '_policies_property_objects_company_activities AS f1 ON c.organization_types_id = f1.id ' .
                'WHERE a.id=' . intval($file['id']);
        $row = $db->getRow($sql);

        $sql =	'SELECT a.*, b.begin_datetime, b.interrupt_datetime, DATEDIFF(b.interrupt_datetime, b.begin_datetime) + 1 AS days, 1 AS curitem ' .
                'FROM ' . PREFIX . '_policies_property_items a ' .
				'JOIN ' . PREFIX . '_policies b on b.id=a.policies_id ' .
                'WHERE a.policies_id = ' . intval($row['policies_id']);
        $row['items'] = $db->getAll($sql);
		
		//получаем объекты
		$sql =	'SELECT a.* ' .
                'FROM ' . PREFIX . '_policies_property_objects AS a ' .
				'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                'WHERE a.policies_id = ' . intval($row['policies_id']);
        $row['objects'] = $db->getAll($sql);

        $PropertyObjects = new PropertyObjects(array());
        $house_years = $PropertyObjects->formDescription['fields'][ $PropertyObjects->getFieldPositionByName('house_years') ];

		foreach ($row['objects'] as $i => $object) {
			$row['objects'][$i]['items']	= $db->getAll('SELECT * FROM ' .PREFIX. '_policies_property_objects_items WHERE objects_id='.intval($object['id']));
			$row['objects'][$i]['loses']	= $db->getAll('SELECT * FROM '.PREFIX.'_policies_property_objects_loses WHERE objects_id='.intval($object['id']));
			$row['objects'][ $i ]['risks']	= $db->getAssoc('SELECT risks_id, 1 FROM ' . PREFIX . '_policies_property_objects_risks_assignments WHERE policies_property_objects_id = ' . intval($object['id']));
			$row['objects'][ $i ]['values']	= $db->getAssoc('SELECT values_id, 1 FROM ' . PREFIX . '_policies_property_objects_values_assignments WHERE policies_property_objects_id = ' . intval($object['id']));
            $row['objects'][ $i ]['house_years'] = $house_years['list'][ $object['house_years'] ];
			//_dump($row['objects'][ 0]['values'][41]);exit;
		}

		$row['objectsCount'] = sizeOf($row['objects']);

		//если нада получаем объекты по предыдущему полису если було переукладання
		$prevcount = 0;
		$parent_id = $row['parent_id'];
		while (intval($row['parent_id'])>0 && $prevcount<10) {
			$coef = doubleval($db->getOne('SELECT (DATEDIFF( interrupt_datetime, begin_datetime ) +1)/(DATEDIFF( end_datetime, begin_datetime ) +1) FROM '.PREFIX.'_policies WHERE id ='.intval($row['parent_id'])));

	        $sql =	'SELECT SUM(amount) ' .
					'FROM ' . PREFIX . '_policy_payments_calendar ' .
					'WHERE policies_id='.intval($row['parent_id']);
			$parentAmount = $db->getOne($sql);

			$sql =	'SELECT amount ' .
					'FROM ' . PREFIX . '_policies ' .
					'WHERE id = ' . intval($row['parent_id']);
			$amount=$db->getOne($sql);

			$coef = $parentAmount / $amount;

		    $sql =	'SELECT a.*,b.begin_datetime,b.interrupt_datetime, DATEDIFF( b.interrupt_datetime, b.begin_datetime ) +1 as days ' .
					'FROM ' . PREFIX . '_policies_property_items a ' .
					'JOIN ' . PREFIX . '_policies b on b.id=a.policies_id ' .
					'WHERE a.policies_id = ' . intval($row['parent_id']).' ORDER BY a.id DESC';
			$row['itemsprev'] = $db->getAll($sql);

			if (is_array($row['itemsprev']) && sizeof($row['itemsprev'])>0) {
				$idx = 0;
				$t = 0;
				foreach ($row['itemsprev'] as $i => $item) {
					$idx++;
					$item['amount']=round($item['amount'] * $coef,2);

					if ($idx == sizeof($row['itemsprev'])) {
						$item['amount'] = $parentAmount-$t;
					} else {
						$t += $item['amount'];
					}

					//$item['rate']=round($item['rate'] * $coef,3);
					$item['rate']=round($item['amount']/($item['price']/100),6);
					array_unshift ( $row['items'], $item );
				}
			}

			$row['parent_id'] = $db->getOne('SELECT parent_id FROM ' . PREFIX . '_policies WHERE id = ' . intval($row['parent_id']));
			$prevcount++;
		}

		if ($prevcount>0) {
			$row['parent_id'] = $parent_id;
		}
		
		$row['totalAmount'] = 0;
        if (is_array($row['items']) && sizeof($row['items'])>0) {
			
			foreach ($row['items'] as $i => $item) {
				$row['totalAmount'] += $item['amount'];

				$row['items'][ $i ]['rate'] = number_format ( $item['rate'] , 6 , '.' , '');

				$sql =	'SELECT b.title, a.value, a.absolute ' . 
						'FROM ' . PREFIX . '_policies_property_item_risks AS a ' .
						'JOIN ' . PREFIX . '_parameters_risks AS b ON a.risks_id = b.id ' .
						'WHERE a.items_id = ' . intval($item['id']);
				$risks = $db->getAll($sql);//получаем риски по имуществу

				if (is_array($risks)) {
					foreach ($risks as $risk) {//лепим все риски в одно значение
						$row['items'][ $i ]['risks'][] = $risk['title'];
						$row['items'][ $i ]['deductibleValue'] = $risk['value'];
						$row['items'][ $i ]['deductibleAbsolute'] = $risk['absolute'];
					}
				}

				$row['items'][ $i ]['risks'] = implode('; ', $row['items'][ $i ]['risks']);
			}
        }

        if (intval($row['sign_agents_id'])) {

            $sql =  'SELECT *,ground_kasko_express as ground_kasko ' .
                    'FROM ' . PREFIX . '_agents ' .
                    'WHERE accounts_id = ' . intval($row['sign_agents_id']);
            $agent = $db->getRow($sql);

            if ($agent['ground_kasko'] && $agent['director1'] && $agent['director2']) {
                $row['ground_kasko'] = $agent['ground_kasko_express'];
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

		$fields = array(
					'insurer_title',
					'insurer_address',
					'closed');
					
		if (strtotime($row['date']) >= strtotime('2013-07-04')) {
            $row['new_director'] = 1;
        }
 $row['new_director'] = 1;
        return $this->prepareValues($fields, $row);
    }

	function regenerateDocuments($data) {
		global $db;

		$sql =	'SELECT id ' .
				'FROM ' . PREFIX . '_policies ' .
				'WHERE product_types_id=12 AND number LIKE ' . $db->quote('%уч%');
		$ids =	$db->getCol($sql);

		foreach ($ids as $id) {
			$sql = 'UPDATE '  . PREFIX . '_policies SET policy_statuses_id = 10 WHERE id = ' . intval($id);
			$db->query($sql);
			$this->generateDocuments($id);
		}
	}

	/* Export 1C7.7. */
    function getXML($data) {
        global $db, $Smarty;

        $conditions[] = 'a.product_types_id=12';
        //return $data['number'];
        if ($data['number']) {
            $conditions[] = 'a.number=' . $db->quote(trim($data['number']));
        } else {
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.date )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.date )>=TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.date )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.date ) <= TO_DAYS(NOW())';
			//$conditions[] = '(a.policy_statuses_id = ' . POLICY_STATUSES_GENERATED . ' OR b.financial_institutions_id = 35)';
        }

        $sql =  'SELECT b.*, a.date,' .
                'a.begin_datetime, ' .
                'a.end_datetime ,  ' .
                'a.begin_datetime as billDate, ' .
                'a.modified as modifiedDate, ' .
                'a.created, ' .
                'a.begin_datetime as payment_datetime, ' .
                'a.policy_statuses_id, \'\' as payment_number, a.number, '.
                'a.item, a.price, a.rate, a.amount,  '.
				'b.insurer_person_types_id as person_types_id,  '.
                'd.title AS insurerRegionsTitle,  ' .
                'o.title AS financial_institutions_title, o.mfo AS financial_institutionsMFO, o.edrpou AS financial_institutionsEDRPOU '.
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_property AS b ON b.policies_id=a.id ' .
                'JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id=c.id ' .
                'LEFT JOIN ' . PREFIX . '_regions AS d ON b.insurer_regions_id=d.id ' .
                'JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id=e.id ' .
                'LEFT JOIN ' . PREFIX . '_financial_institutions AS o ON b.financial_institutions_id=o.id   ' .
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


            $sql =  'SELECT b.*,1 as insurance_type ' .
					'FROM insurance_policies_property_objects AS a JOIN insurance_policies_property_objects_items b on b.objects_id=a.id '.
                    'WHERE a.policies_id=' . intval($row['policies_id']);
            $list[$i]['items'] = $db->getAll($sql);
        }


        $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/property.xml');
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
                'JOIN ' . PREFIX . '_policies_property AS b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        $row = $db->getRow($sql);

        return $row;
    }

}

?>