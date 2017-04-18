<?
/*
 * Title: policy NS class
 *
 * @author 
 * @email 
 * @version 3.0
 */

require_once 'Products.class.php';
require_once 'Products/NS.class.php';
require_once 'PolicyDocuments.class.php';
require_once 'FinancialInstitutions.class.php';

class Policies_NS extends Policies {

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
							'showId'			=> true,
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
                            'name'              => 'products_id',
                            'description'       => 'Продукт',
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
                                    'canBeEmpty'    => true,
                                ),
                            'table'				=> 'policies_ns'),
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
							'table'             => 'policies_ns_parameters_assignments',
							'sourceTable'       => 'parameters_ns',
							'selectField'       => 'title',
							'orderField'        => 'order_position'),
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
                            'name'              => 'insurance_companies_id',
                            'description'       => 'Страхова компанiя',
                            'type'              => fldSelect,
                            'showId'            => true,
                            'list'              => array(
                                                    INSURANCE_COMPANIES_EXPRESS => 'ТДВ "Eкспрес Страхування"',
                                                    8 => 'УСК «Гарант-Лайф»'),
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
                            'name'              => 'financial_institutions_id',
                            'description'       => 'Банк',
                            'type'              => fldSelect,
                            'showId'            => true,
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
                            'table'             => 'policies_ns',
                            'sourceTable'       => 'financial_institutions',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                         array(
                            'name'              => 'terms_id',
                            'description'       => 'Термін страхування',
                            'type'              => fldSelect,
                            'showId'            => true,
							'condition'         => 'product_types_id = 13 AND id IN(55,56,57,58,59,60,61,62,63,64,65,66,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91)',
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
                            'table'             => 'policies_ns',
                            'sourceTable'       => 'parameters_terms',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
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
                            'name'              => 'discount',
                            'description'       => 'Знижка агента, %',
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'name'              => 'options_second_year',
                            'description'       => 'страхування 2-й рiк',
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
                            'table'             => 'policies_ns'),
				
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
                        array(
                            'name'              => 'insurer_passport_number',
                            'description'       => 'Страхувальник, паспорт, номер',
                            'type'              => fldText,
                            'maxlength'         => 13,
                            //'validationRule'    => '^([0-9]{6}|[0-9]{6}\/[0-9]{6})$',
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
                        array(
                            'name'              => 'insurer_identification_code',
                            'description'       => 'Страхувальник, ІПН',
                            'type'              => fldText,
                            'maxlength'         => 10,
                            'validationRule'    => '^[0-9]{10}$',
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
                        array(
                            'name'              => 'insurer_position',
                            'description'       => 'Страхувальник, посада',
                            'type'              => fldText,
                            'maxlength'         => 150,
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
                            'table'             => 'policies_ns'),
                        array(
                            'name'              => 'insurer_activity',
                            'description'       => 'Страхувальник, вид діяльності',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_ns'),
                        array(
                            'name'              => 'insurer_sport',
                            'description'       => 'Страхувальник, заняття активними видами спорту',
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns',
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
							'table'				=> 'policies_ns',
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
                        array(
                            'name'              => 'insurer_phone',
                            'description'       => 'Страхувальник, телефон',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
                        array(
                            'name'              => 'assured_identification_code',
                            'description'       => 'Вигодонабувач, ІПН (ЄРДПОУ)',
                            'type'              => fldText,
                            'maxlength'         => 10,
                            'validationRule'    => '^[0-9]{8,10}$',
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
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
                            'table'             => 'policies_ns'),
                        array(
                            'name'              => 'number',
                            'description'       => 'Номер',
                            'type'              => fldUnique,
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
                                    'update'    => false
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
                            'name'              => 'fop',
                            'description'       => 'Я є фізичною особою-підприємцем',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'так',
													0 => 'нi'),
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
                            'table'             => 'policies_ns'),	
						array(
                            'name'              => 'give_a_statement',
                            'description'       => 'Подаю виписку або витяг з Єдиного державного реєстру юридичних осіб та фізичних осіб - підприємців',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'так',
													0 => 'нi'),
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
                            'table'             => 'policies_ns'),	
						array(
                            'name'              => 'civil_servant',
                            'description'       => 'Я є особою, яка обіймає посаду державного службовця...',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'додаю',
													2 => 'заповнюю',
													0 => 'нi'),
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
                            'table'             => 'policies_ns'),
						array(
                            'name'              => 'not_civil_servant',
                            'description'       => 'Я не відношусь до таких осіб та вважаю цю інформацію про фінансовий стан відкритою та додаю податкову декларацію встановленого зразка...',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'додаю',
													2 => 'заповнюю',
													0 => 'нi'),
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
                            'table'             => 'policies_ns'),	
						array(
                            'name'              => 'public_figure',
                            'description'       => 'Я не відношусь до таких осіб та вважаю цю інформацію про фінансовий стан відкритою та додаю податкову декларацію встановленого зразка...',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'додаю',
													0 => 'нi'),
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
                            'table'             => 'policies_ns'),
                        array(
                            'name'              => 'comment',
                            'description'       => 'Додаткова інформація',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_ns'),
                    array(
							'name'              => 'bank_discount_value',
							'description'       => 'Комісія банку',
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
									'canBeEmpty'    => false
								),
							'table'             => 'policies_ns'),
                        array(
							'name'              => 'bank_commission_value',
							'description'       => 'Винагорода банку',
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
									'canBeEmpty'    => false
								),
							'table'             => 'policies_ns'),
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
                            'name'              => 'amount_return',
                            'description'       => 'Повернута премія при анулюванні, грн.',
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
                            'name'              => 'credit_amount',
                            'description'       => 'Сумма кредиту, грн.',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_ns'),
						array(
                            'name'              => 'credit_percent',
                            'description'       => 'Річна відсоткова ставка',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_ns'),
							
                        array(
                            'name'              => 'policy_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldSelect,
                            'showId'            => true,
                            'display'           =>
                                array(
                                    'show'      	=> true,
                                    'insert'    	=> true,
									'changeStatus'	=> true,
                                    'view'      	=> true,
                                    'update'		=> true
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
                                    'show'    	=> false,
                                    'insert'    => true,
                                    'view'     	=> true,
                                    'update'	=> true
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
                            'description'       => 'Пiдпис договору',
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
                            'table'             => 'policies_ns',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'CONCAT (lastname ,\' \', firstname)',
                            'orderField'        => 'lastname'),
						array(
                            'name'              => 'allowed_products_id',
                            'description'       => 'allowed_products_id',
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
                            'table'             => 'policies_ns'),
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
									'canBeEmpty'    => false
								),
							'table'             => 'policies_ns'),
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
									'canBeEmpty'    => false
								),
							'table'             => 'policies_ns'),
						array(
							'name'              => 'director1_commission_percent',
							'description'       => 'Комісія, директор, %',
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
							'table'             => 'policies_ns'),
						 
						array(
							'name'              => 'director2_commission_percent',
							'description'       => 'Комісія, зам директора, %',
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
							'table'             => 'policies_ns'),
						 
						 
						array(
							'name'              => 'commission_manager_percent',
							'description'       => 'Комісія Менеджер що привiв клiєнта, %',
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
							'table'             => 'policies_ns'),

						array(
							'name'              => 'commission_seller_agents_percent',
							'description'       => 'Комісія Менеджер продавець, %',
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
							'table'             => 'policies_ns'),
							
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

    function Policies_NS($data) {
		global $db, $POLICY_STATUSES_SCHEMA;

        Policies::Policies($data);

        $this->objectTitle = 'Policies_NS';

        $this->messages['plural'] = 'Поліси "Нещасний випадок"';
        $this->messages['single'] = ($data['types_id'] == POLICY_TYPES_QUOTE) ? 'Котирування "Нещасний випадок"' : 'Поліс "Нещасний випадок"';

		if ($_SESSION['auth']['top_agencies_id'] == 245 || $_SESSION['auth']['top_agencies_id'] == 417 || $_SESSION['auth']['top_agencies_id'] == 1254  || $_SESSION['auth']['top_agencies_id'] == 846  || $_SESSION['auth']['top_agencies_id'] == 561) //втб лайф + правекс
		{
			$this->messages['plural'] = 'Поліси "Страхування життя"';
			$this->messages['single'] = ($data['types_id'] == POLICY_TYPES_QUOTE) ? 'Котирування "Страхування життя"' : 'Поліс "Страхування життя"';
		}
		
		$id = (is_array($data['id'])) ? $data['id'][0] : $data['id'];

		$this->setSubMode($data);

		$this->setPolicyStatusesSchema(null, &$data);
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'					=> true,
                    'insert'				=> false,
					'quote'					=> true,
                    'update'				=> true,
                    'view'					=> true,
                    'change'				=> true,
                    'export'				=> true,
                    'exportActions'         => true,
					'documents'				=> true,
					'reset'					=> true,
                    'delete'    			=> true,
					'changeServicePerson'	=> true,
					'renewPolicy'			=> false,
					'continuePolicy'		=> false,
					'transfer'				=> true,
					'cancelPolicy'			=> false);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'					=> true,
                    'insert'				=> true,
					'quote'					=> true,
                    'update'				=> true,
                    'view'					=> true,
                    'change'				=> false,
                    'delete'				=> false,
					'changeServicePerson'	=> true,
					'renewPolicy'			=> true,
					'continuePolicy'		=> true,
					'cancelPolicy'			=> true);

				$this->formDescription['fields'][ $this->getFieldPositionByName('documents') ]['display']['change'] = false;
                $this->formDescription['fields'][ $this->getFieldPositionByName('commission') ]['display']['change'] = false;
                break;
        }
    }

	//схема смены статусов с привязкой к роли
	function setPolicyStatusesSchema($roles_id =null, $data=null) {
		global $Authorization, $POLICY_STATUSES_SCHEMA;

		if (is_null($roles_id)) {
			$roles_id = $Authorization->data['roles_id'];
		}

		switch ($roles_id) {
			case ROLES_ADMINISTRATOR:
				$POLICY_STATUSES_SCHEMA = array(
					POLICY_STATUSES_CREATED =>
						array(
							POLICY_STATUSES_CREATED,
							($this->subMode == 'set' ? POLICY_STATUSES_REQUEST_QUOTE : (intval($data['next_policy_statuses_id']) ? $data['next_policy_statuses_id'] : POLICY_STATUSES_GENERATED))),
					POLICY_STATUSES_REQUEST_QUOTE	=>//запрос котировки к андеррайтеру
						array(
							POLICY_STATUSES_REQUEST_QUOTE,
							POLICY_STATUSES_REQUEST_QUOTE_ERROR,
							POLICY_STATUSES_QUOTE),
					POLICY_STATUSES_REQUEST_QUOTE_ERROR	=>//ошибка в запросе к андеррайтеру
						array(
							POLICY_STATUSES_REQUEST_QUOTE_ERROR,
							POLICY_STATUSES_REQUEST_QUOTE_AGAIN),
					POLICY_STATUSES_REQUEST_QUOTE_AGAIN	=>//повторный запрос котировки к андеррайтеру
						array(
							POLICY_STATUSES_REQUEST_QUOTE_AGAIN,
							POLICY_STATUSES_REQUEST_QUOTE_ERROR,
							POLICY_STATUSES_QUOTE),
					POLICY_STATUSES_QUOTE	=>//котировка от андеррайтера
						array(
							POLICY_STATUSES_QUOTE,
							POLICY_STATUSES_REQUEST_AGREEMENT),
					POLICY_STATUSES_REQUEST_AGREEMENT	=>//запрос договора страхования
						array(
							POLICY_STATUSES_REQUEST_AGREEMENT,
							POLICY_STATUSES_REQUEST_QUOTE_ERROR,
							(intval($data['next_policy_statuses_id']) ? $data['next_policy_statuses_id'] : POLICY_STATUSES_GENERATED)),
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
			case ROLES_MANAGER:
			case ROLES_GENERALI_MANAGER:
				$POLICY_STATUSES_SCHEMA = array(
					POLICY_STATUSES_CREATED =>
						array(
							POLICY_STATUSES_CREATED),
					POLICY_STATUSES_REQUEST_QUOTE	=>//запрос котировки к андеррайтеру
						array(
							POLICY_STATUSES_REQUEST_QUOTE,
							POLICY_STATUSES_REQUEST_QUOTE_ERROR,
							POLICY_STATUSES_QUOTE),
					POLICY_STATUSES_REQUEST_QUOTE_ERROR	=>//ошибка в запросе к андеррайтеру
						array(
							POLICY_STATUSES_REQUEST_QUOTE_ERROR,
							POLICY_STATUSES_REQUEST_QUOTE_AGAIN),
					POLICY_STATUSES_REQUEST_QUOTE_AGAIN	=>//повторный запрос котировки к андеррайтеру
						array(
							POLICY_STATUSES_REQUEST_QUOTE_AGAIN,
							POLICY_STATUSES_REQUEST_QUOTE_ERROR,
							POLICY_STATUSES_QUOTE),
					POLICY_STATUSES_QUOTE	=>//котировка от андеррайтера
						array(
							POLICY_STATUSES_QUOTE),
					POLICY_STATUSES_REQUEST_AGREEMENT	=>//запрос договора страхования
						array(
							POLICY_STATUSES_REQUEST_AGREEMENT,
							POLICY_STATUSES_REQUEST_QUOTE_ERROR,
							(intval($data['next_policy_statuses_id']) ? $data['next_policy_statuses_id'] : POLICY_STATUSES_GENERATED)),
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
			case ROLES_CLIENT_CONTACT:
				$POLICY_STATUSES_SCHEMA = array(
					POLICY_STATUSES_CREATED =>
						array(
							POLICY_STATUSES_CREATED,
							($this->subMode=='set' ? POLICY_STATUSES_REQUEST_QUOTE : (intval($data['next_policy_statuses_id']) ? $data['next_policy_statuses_id'] : POLICY_STATUSES_GENERATED))),
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

	//установка стилей на форме
    function getReadonlySign(&$data) {
        return (intval($data['documents'])==0)
            ? ''
            : ' style="color: #666666; background-color: #f5f5f5;" disabled';
    }

	//формирование справочников
    function setListValues($data, $actionType='show') {
        global $Authorization;

        if (!intval($data['agencies_id'])) {
            $data['agencies_id']    = $Authorization->data['agencies_id'];
        }

//        $this->formDescription['fields'][ $this->getFieldPositionByName('sign_agents_id') ]['condition'] .= ' AND (agencies_id='.intval($data['agencies_id']).' OR agencies_id IN (SELECT parent_id FROM '.PREFIX.'_agencies WHERE id ='.intval($data['agencies_id']).' ))';

		//правекс 
		/*if ($_SESSION['auth']['top_agencies_id'] == 417)
		{
			$this->formDescription['fields'][ $this->getFieldPositionByName('financial_institutions_id') ]['condition'] = ' id=34';
		}*/
		if ($_SESSION['auth']['agent_financial_institutions_id'] >0)
		{
			$this->formDescription['fields'][ $this->getFieldPositionByName('financial_institutions_id') ]['condition'] = ' id='.intval($_SESSION['auth']['agent_financial_institutions_id']);
		}

		
        parent::setListValues($data, $actionType);
    }

    function getListValue($field, $data) {
        global $db;

		if ($field['name'] == 'sign_agents_id') {
			$options = array();

			$conditions[] = 'roles_id = ' . ROLES_AGENT;
			$conditions[] = 'LENGTH(director1) > 0 AND LENGTH(director2) > 0 AND LENGTH(ground_ns_express)>1 ';
			$conditions[] = '(agencies_id = ' . intval($data['agencies_id']) . ' OR agencies_id IN (SELECT parent_id FROM ' . PREFIX . '_agencies WHERE id =' . intval($data['agencies_id']) . '))';

			$sql =	'SELECT id, CONCAT(lastname, \' \', firstname,\' \', patronymicname) AS title ' .
					'FROM ' . PREFIX . '_accounts AS a ' .
					'JOIN ' . PREFIX . '_agents AS b ON a.id = b.accounts_id ' .
					'WHERE ' . implode(' AND ', $conditions) . ' ' .
					'ORDER BY lastname, firstname';
			$list = $db->getAll($sql, 300);
			$options = array('0' => '...');
			if (is_array($list)) {
				foreach ($list as $row) {
					$options[ $row['id'] ] = array(
						'title' => $row['title'],
						'obligatory' => $row['obligatory']);
				}
			}

			return $options;
		}
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
	//формирование выпадающего списка
    function buildSelect($field, $value, $languageCode=null, $addition=null, $indexType=null, $data=null, $class=null) {

        if ($data['factor_types_id']) {

            $list = $field['list'];

            $field['list'] = array();

            foreach($list as $i=>$row) {
                if ($row['types_id']==$data['factor_types_id']) {
                    $field['list'][$i] = $row;
				}
            }
            $field['name'] .= $data['factor_types_id'];

            return parent::buildSelect($field, $value, $languageCode, $addition, $indexType, $data, $class);
        }

        $result = parent::buildSelect($field, $value, $languageCode, $addition, $indexType, $data, $class);
		
        if  ($field['name'] == 'sign_agents_id') {
			$result = str_replace ( '...' , 'директор підприємства' , $result );
		}
        
        return $result;

    }
	//добавление нового полиса
    function add($data) {
        global $db;

		if ($data['load_id']) {
			$copy_fields = array(
            'person_types_id','insurer_lastname','insurer_firstname','insurer_patronymicname','insurer_identification_code','insurer_edrpou','insurer_passport_series','insurer_passport_number','insurer_passport_place','insurer_passport_date_format','insurer_passport_date_year','insurer_passport_date_month','insurer_passport_date_day','insurer_dateofbirth_format','insurer_dateofbirth_year','insurer_dateofbirth_month','insurer_dateofbirth_day','insurer_phone','insurer_email','insurer_zip','insurer_regions_id','insurer_area','insurer_city','insurer_street_types_id','insurer_street','insurer_house','insurer_flat','insurer_id_card','insurer_newpassport_number','insurer_newpassport_place','insurer_newpassport_date','insurer_newpassport_reestr','insurer_newpassport_dateEnd'
			);
			$l = $db->getRow('SELECT * FROM insurance_policies WHERE id = '.intval($data['load_id']));
			if ($l) {
				$data['insurance_companies_id'] = 4;
				$policy = Policies::factory($l);
				$policy->checkPermissions('view', $l );
				$row = $policy->view($l, false);

				foreach($copy_fields as $f) {
					if (isset($row[$f])) {
						$data[$f] = $row[$f];
						if ($row['product_types_id']==4) //создаем с ГО
						{
							if (strpos($f, 'insurer_')!==false)
								$data[str_replace ( 'insurer_' , 'owner_' , $f )] = $row[$f];
							
							if ($f == 'person_types_id') {
								$data['insurer_person_types_id'] = $row[$f];
							}
						
						}
					}
				}
			}
		}
		
		if (!intval($data['parent_id'])) {

			$sql =  'SELECT id ' .
					'FROM ' . PREFIX . '_parameters_risks as a ' .
                    'JOIN ' . PREFIX . '_product_risks as b ' .
                    'ON a.id = b.risks_id ' .
					'WHERE product_types_id = ' . intval($data['product_types_id']) . ' ' .
                    'AND b.obligatory = 1 ' .
					'ORDER BY order_position';
			$risks = $db->getAll($sql, 30 * 60);

			foreach ($risks as $risk) {
				$data['risks'][] =  $risk['id'];
			}
		}

        parent::add($data);
    }

    function setFields($data) {
		global $Authorization;

	     //корректируем перечень полей в зависимости от типа контрагента
        $unsetFields = array();

		if (!intval($data['cart_discount'])) {
			$unsetFields[] = 'card_car_man_woman';
		}

        if (!$data['assured']) {
            $unsetFields[] = 'assured_title';
			$unsetFields[] = 'assured_identification_code';
			$unsetFields[] = 'assured_address';
			$unsetFields[] = 'assured_phone';
        }
		
		if ($data['financial_institutions_id']==28) { //ВТБ
            $unsetFields[] = 'insurer_company';
			$unsetFields[] = 'insurer_position';
			$unsetFields[] = 'insurer_activity';
			$unsetFields[] = 'insurer_sport';
        }

		foreach($unsetFields as $field) {
			$data[ $field ] = '';
			$this->formDescription['fields'][ $this->getFieldPositionByName($field) ]['verification']['canBeEmpty'] = true;
		}

		if ($data['dontRecalcRate']) {//не обновлять поля отвечающие за тариф

			$unsetFields = array();
			$unsetFields[] = 'price';
			$unsetFields[] = 'rate';
			$unsetFields[] = 'amount';
			$unsetFields[] = 'amount_return';

			foreach($unsetFields as $field) {
				unset($this->formDescription['fields'][ $this->getFieldPositionByName($field) ]);
			}
		}

		if (is_array($this->formDescription['fields']) && $data['dontCheckFormat']) {//отменить правила проверки полей
            foreach($this->formDescription['fields'] as $field) {
				$this->formDescription['fields'][ $this->getFieldPositionByName($field['name']) ]['verification']['canBeEmpty'] = true;
				unset($this->formDescription['fields'][ $this->getFieldPositionByName($field['name']) ]['maxlength']);
				unset($this->formDescription['fields'][ $this->getFieldPositionByName($field['name']) ]['validationRule']);
			}
		}

        //устанавливаем перечень не обязательных полей в зависимости от статуса И типа
        switch ($data['policy_statuses_id']) {
			case POLICY_STATUSES_CREATED:
				if ($data['types_id'] == POLICY_TYPES_AGREEMENT) {
					break;
				}
			case POLICY_STATUSES_REQUEST_QUOTE:
			case POLICY_STATUSES_REQUEST_QUOTE_ERROR:
			case POLICY_STATUSES_REQUEST_QUOTE_AGAIN:
			case POLICY_STATUSES_QUOTE:
                $emptyFields =
                    array(
                        'formDescription' =>
                            array(
								'insurer_bank',
                                'insurer_bank_mfo',
								'insurer_bank_account',
                                'insurer_dateofbirth',
                                'insurer_passport_series',
                                'insurer_passport_number',
                                'insurer_passport_place',
                                'insurer_passport_date',
                                'insurer_phone',
                                'insurer_regions_id',
                                'insurer_city',
                                'insurer_street',
                                'insurer_house',
								'rate',

                                'insurer_id_card',
                                'insurer_newpassport_number',
                                'insurer_newpassport_place',
                                'insurer_newpassport_date',
                                'insurer_newpassport_reestr',
                                'insurer_newpassport_dateEnd'));
                break;
			case POLICY_STATUSES_REQUEST_AGREEMENT:
			case POLICY_STATUSES_GENERATED:
				break;
        }

		if (is_array($emptyFields)) {
			foreach ($emptyFields as $description => $fields) {

				if ($description != 'formDescription') {
					$temp = $this->formDescription;
				}

				$this->formDescription = $this->$description;

				if (is_array($fields)) {
					foreach ($fields as $field) {
						$this->formDescription['fields'][ $this->getFieldPositionByName($field) ]['verification']['canBeEmpty'] = true;
					}
				}

				$this->$description = $this->formDescription;

				if ($description != 'formDescription') {
					$this->formDescription = $temp;
				}
			}
        }
   
		if ($Authorization->data['roles_id'] == ROLES_AGENT) {//банковскую комисию агент не может корректировать

			$this->formDescription['fields'][ $this->getFieldPositionByName('commission_agency_percent', $this->formDescription) ]['verification']['canBeEmpty'] = true;
			$this->formDescription['fields'][ $this->getFieldPositionByName('commission_agent_percent', $this->formDescription) ]['verification']['canBeEmpty'] = true;
		}
    }

    //выводим списки поправочных коеф. в форму договора (НС)
    function getListFactors($data, $product_types_id, $table) {
       global $db;

       $conditions[] = 'product_types_id = ' . $product_types_id ;
       $conditions[] = 'b.value > 0';
       switch($table['name']) {
           case 'ages':
               $table['fields'] = 'a.id, a.age_begin, a.age_end,a.title, a.group_title, a.order_position, b.value';
               break;
           case 'terms_hours':
           case 'sports':
           case 'professions':
               $table['fields'] = 'a.id, a.title,a.group_title, a.order_position, a.description, b.value';
               break;
       }
		$sql =	'SELECT ' . $table['fields'] . ' ' .
				'FROM ' . PREFIX . '_parameters_'. $table['name'] .' AS a ' .
				'LEFT JOIN ' . PREFIX . '_product_' . $table['name'] . ' AS b ON a.id = b.' . $table['name'] . '_id ' .
				'WHERE '. implode(' AND ', $conditions) . ' ' .
				'ORDER BY a.order_position';
		$list =	$db->getAll($sql);

        $result =  $list[0]['group_title'] .
                   '<select name="' . $table['name'] . '_id" onChange="calculate();">
                        <option>...</option>';
        foreach($list as $row) {
            $result .= '<option value=' . $row['value'] . ' '.($data[$table['name'] . '_id'] == $row['value'])? 'selected' : '' .'>' . $row['title'] . '</option>';
        }
        $result .= '</select>';

        return $result;
    }

	function prepareForm(&$data) {
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
        $this->setFields(&$data);
	}
	
    function setConstants(&$data) {
        global $Authorization,$db;


        $Products = Products::factory($data, 'NS'); 

        if (!$data['dontRecalcRate']) {
            //расчет тарифа
			switch ($this->subMode) {
				case 'calculate'://расчет на основании параметров страхового продукта
					$data = $Products->calculate($data['risks'], $data['financial_institutions_id'], $data['price'], $data['discount'], $data['cart_discount'], $data['agencies_id'], $data['terms_id'], $data);
					break;
				case 'set'://!!!параметры устанавливаются андеррайтером
					break;
			}
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
        global $Log, $Authorization,$db;

        if($data['amount'] == 0){
            $Log->add('error', 'Нульовий тариф не може бути прийнятий', $params);
        }

        /*if ($data['financial_institutions_id']) {
            $data['risks'] = ParametersRisks::setAll($data['product_types_id']);
        }*/

        if($data['amount'] == 0) {
              $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
        }
        //проверить чтобы полис небыл включен в агенские акты
        if (!$data['skipCalendar'] && !$data['dontRecalcRate'] && intval($data['id'])>0) {
            if ($this->isInAct($data['id'])) {
                $Log->add('error', 'Поліс вже включено до агенських актiв. Використовуйте режим змiни без перерахунку тарифу.');
            }
        }

        parent::checkFields($data, $action);

		//проверяем полноту данных по другим застрахованным
        if (is_array($data['agreements'])) {
			foreach ($data['agreements'] as $i => $row) {
                if ($row['company'] == '') {
                    $params = array('Назва страхової компанії', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                }

                if ($row['kind'] == '') {
                    $params = array('Вид страхування', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                }

                if ($row['price'] == '') {
                    $params = array('Страхова сума, грн.', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
				} else if (!$this->isValidMoney($row['price'])) {
					$params = array('Страхова сума, грн.', null);
					$Log->add('error', 'The date <b>%s</b>%s is not valid.', $params);
				}

				if (!intval($row['date_month']) || !intval($row['date_day']) || !intval($row['date_year'])) {
					$params = array('Дата заключення', null);
					$Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
				} else if (!checkdate($row['date_month'], $row['date_day'], $row['date_year'])) {
					$params = array('Дата заключення', null);
					$Log->add('error', 'The date <b>%s</b>%s is not valid.', $params);
				}
            }
        }

		if ($data['number'] && $data['next_policy_statuses_id'] != POLICY_STATUSES_RENEW) {
			if ($this->isExists($this->tables[0], 'number', $data['number'], $data['id'], $data)) {
				$Log->add('error', 'Поліс з номером <b>' . $data['number'] . '</b> вже існує.');
			}
		}

		if ($data['card_assistance'] != '' && !Cards::isValid($data['card_assistance'], $data['clients_id'])) {
			$params = array('Номер картки Експрес Асістанс', null);
			//$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
		}

		if ($Authorization->data['id'] != 1) {
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
				if ($end_datetime<$begin_datetime) {//Дата Начло меньше чем Дата конец
					$Log->add('error', '<b>Дата початку дії полісу</b> не може бути більше ніж <b>Дата закінчення</b>.');
				}
			}			

	        //проверка даты начала действия полиса
	        if ($begin_datetime != 0 && $begin_datetime < $date) {
				$Log->add('error', '<b>Дата початку дії полісу</b> не може бути раніше ніж <b>Дата поліса</b>.');
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
    }

    function setCommissions($id) {
        global $db;

		//вычисление итоговых сумм комиссионного вознаграждения
		$sql =	'SELECT ' .

				'SUM(' .
                ' round(a.amount * b.commission_agency_percent / 100, 2) ' .//сумма комиссионного вознаграждения агенции, считаем от страхового тарифа
				' ) AS commission_agency_amount, ' .//сумма комиссионного вознаграждения агенции

                'SUM( round(a.amount * b.commission_agent_percent / 100, 2) ' .//сумма комиссионного вознаграждения агенту, считаем от страхового тарифа
				' ) AS commission_agent_amount, ' .//сумма комиссионного вознаграждения агенту
				
				'SUM(  ' .
				'  round(a.amount * b.commission_manager_percent / 100, 2) ' .
				' ) as commission_manager_amount, ' . 
				'SUM(  ' .
				'  round(a.amount * b.commission_seller_agents_percent / 100, 2) ' .
				' ) as commission_seller_agents_amount, ' . 
				
				
				'SUM(  round(a.amount * b.director1_commission_percent / 100, 2) ' .//сумма комиссионного вознаграждения директору  за 1 ТС, считаем от страхового тарифа
				' ) as commission_director1_amount, ' .//сумма комиссионного вознаграждения директору  за 1 ТС
				
				'SUM( round(a.amount * b.director2_commission_percent / 100, 2) ' .//сумма комиссионного вознаграждения зам директору  за 1 ТС, считаем от страхового тарифа
				' ) as commission_director2_amount, ' .//сумма комиссионного вознаграждения зам директору  за 1 ТС


				'SUM( round(a.amount * b.commission_financial_institution_percent / 100, 2) ' .//сумма комиссионного вознаграждения ОДО "Экспресс страхование", считаем от страхового тарифа
				' ) AS commission_financial_institution_amount ' .//сумма комиссионного вознаграждения ОДО "Экспресс страхование"

				'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policies_ns AS b ON a.id = b.policies_id ' .
				'WHERE a.id = ' . intval($id) . ' ' .
				'GROUP BY a.id';
		$row =	$db->getRow($sql);

        $sql =	'UPDATE ' . PREFIX . '_policies SET ' .
                'commission_agency_percent = round(' . $db->quote($row['commission_agency_amount']) . ' / amount * 100, 1), ' .
                'commission_agent_percent = round(' . $db->quote($row['commission_agent_amount']) . ' / amount * 100, 1), ' .
                'commission_director1_percent = round(' . $db->quote($row['commission_director1_amount']) . ' / amount * 100, 2), ' .
                'commission_director2_percent = round(' . $db->quote($row['commission_director2_amount']) . ' / amount * 100, 2), ' .
				'commission_manager_amount = ' . $db->quote($row['commission_manager_amount']) . ', ' .
                'commission_manager_percent = round(' . $db->quote($row['commission_manager_amount']) . ' / amount * 100, 2), ' .
				'commission_seller_agents_amount = ' . $db->quote($row['commission_seller_agents_amount']) . ', ' .
                'commission_seller_agents_percent = round(' . $db->quote($row['commission_seller_agents_amount']) . ' / amount * 100, 2), ' .

                'commission_financial_institution_percent = round(' . $db->quote($row['commission_financial_institution_amount']) . ' / amount * 100, 1) ' .
                'WHERE id = ' . intval($id);
        $db->query($sql);

        $sql =	'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
				'commission_agency_amount = ' . $db->quote($row['commission_agency_amount']) . ', ' .
                'commission_agent_amount = ' . $db->quote($row['commission_agent_amount']) . ', ' .
				'commission_director1_amount =  ' . doubleval($row['commission_director1_amount']).' , ' .
				'commission_director2_amount =  ' . doubleval($row['commission_director2_amount']).' , ' .
				'commission_manager_amount =  ' . doubleval($row['commission_manager_amount']).' , ' .
				'commission_seller_agents_amount =  ' . doubleval($row['commission_seller_agents_amount']).' , ' .
				
                'commission_financial_institution_amount = ' . $db->quote($row['commission_financial_institution_amount']) . ' ' .
                'WHERE policies_id = ' . intval($id).'  ';
        $db->query($sql);
		
    }

    function getCode($data) {
        return '301';
    }

	function setClient($data) {

        $values['agencies_id']	    			= 1469;
        $values['agents_id']				    = ($data['agencies_id'] == 1469) ? $data['agents_id'] : 0;
		$values['person_types_id']				= $data['insurer_person_types_id'];

		$values['identification_code']			= $data['insurer_identification_code'];
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

		$values['card_car_man_woman']			= $data['card_car_man_woman'];
		$values['card_assistance']				= $data['card_assistance'];

		$Clients = new Clients($values);

		$Clients->permissions['insert'] = true;
		$Clients->permissions['update'] = true;

		return $Clients->fill($values);
	}

    function getNumber($data) {
        global $db;

		$result = $data['number'];

        if (!$result) {
            if ($data['financial_institutions_id']==28) //номер для ВТБ гарант лайф
                $sql =  'SELECT CONCAT(\'32\', ' . $db->quote(sprintf('%06d', intval($data['id']))) . ') ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id = ' . intval($data['id']);
			elseif ($data['financial_institutions_id']==34 && $data['insurance_companies_id']==8) //номер для Лайф правекс
                $sql =  'SELECT CONCAT(\'33\', ' . $db->quote(sprintf('%06d', intval($data['id']))) . ') ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id = ' . intval($data['id']);


			elseif ($data['financial_institutions_id']==25) //номер для Лайф идея
                $sql =  'SELECT CONCAT(\'35\', ' . $db->quote(sprintf('%06d', intval($data['id']))) . ') ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id = ' . intval($data['id']);	
			elseif ($data['financial_institutions_id']==52 && $data['products_id']==261) //номер для Лайф КредитДнепр
                $sql =  'SELECT CONCAT(\'36\', ' . $db->quote(sprintf('%06d', intval($data['id']))) . ') ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id = ' . intval($data['id']);					
            else
                $sql =  'SELECT CONCAT(' . $db->quote($this->getCode($data)) . ', \'.\', date_format(created, \'%y\'), \'.2\', ' . $db->quote(sprintf('%06d', intval($data['id']))) . ') ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id = ' . intval($data['id']);
            $result = $db->getOne($sql);
        }

        return $result;
    }

    function updateAgreements($policies_id, $agreements) {
        global $db;

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policies_ns_agreements ' .
                'WHERE policies_id = ' . intval($policies_id);
        $db->query($sql);

        if (is_array($agreements)) {
            foreach ($agreements as $row) {
				$sql =  'INSERT INTO ' . PREFIX . '_policies_ns_agreements SET ' .
						'policies_id = ' . intval($policies_id) . ', ' .
						'company = ' . $db->quote($row['company']) . ', ' .
						'kind = ' . $db->quote($row['kind']) . ', ' .
						'price = ' . $db->quote($row['price']) . ', ' .
						'date = ' . $db->quote($row['date_year'] . '-' . $row['date_month'] . '-' . $row['date_day']) . ', ' .
						'created = NOW()';
				$db->query($sql);
            }
        }
    }

    function setAdditionalFields($id, $data) {
        global $db, $Log, $REGIONS, $UNDERWRITING_POLICY_STATUSES, $CLIENT_FILL_POLICY_STATUSES;

		$data['clients_id'] = 0;
		if (in_array($data['policy_statuses_id'], $CLIENT_FILL_POLICY_STATUSES) && !$data['skipClients']) {//фиксируем данные по клиенту только, если договор закрывается для редактирования, мусора меньше будет
			$data['clients_id'] = $this->setClient($data);
			$Log->clear();
		}

        
        $data['number']	= $this->getNumber($data);

		if (!intval($data['financial_institutions_id'])) {
			$data['assured_title'] = $data['insurer_lastname'] . ' ' . $data['insurer_firstname'] . ' ' . $data['insurer_patronymicname'];
			$data['assured_identification_code'] = $data['insurer_identification_code'];
			$data['assured_address'] = Regions::getTitle($data['insurer_regions_id']) . ', ' .
                                       $data['insurer_area'] . ', ' .
                                       $data['insurer_city'] . ', ' .
                                       StreetTypes::getTitle($data['insurer_street_types_id']) . ' ' .
                                       $data['insurer_street'] . ', ' .
                                       $data['insurer_house']  . ', ' .
                                       $data['insurer_flat'];
			$data['assured_phone'] = $data['insurer_phone'];
		}
        
		//устанавливаем top для нового, и child_id and interrupt_datetime для старого
		$sql =	'UPDATE ' . PREFIX . '_policies AS a, ' . PREFIX . '_policies AS b SET ' .
				'a.top = IF(b.top > 0, b.top, ' . intval($data['parent_id']) . '), ' .
				'b.child_id = ' . intval($id) . ', ' .
				'b.interrupt_datetime = DATE_ADD(a.begin_datetime, INTERVAL -1 DAY) ' .
				'WHERE a.id = ' . intval($id) . ' AND b.id = ' . intval($data['parent_id']);
		$db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_ns AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS c ON a.agencies_id = c.id ' .
                'LEFT JOIN ' . PREFIX . '_financial_institutions AS d ON b.financial_institutions_id = d.id ' .
				'JOIN ' . PREFIX . '_product_types AS f ON a.product_types_id = f.id ' .
				'LEFT JOIN ' . PREFIX . '_policies AS h ON h.id = ' . intval($data['parent_id']) . ' SET ' .
				'a.parent_id = ' . intval($data['parent_id']) . ', ' .
				'a.top = IF(h.top > 0, h.top, ' . intval($id) . '), ' .
				'a.clients_id = ' . intval($data['clients_id']) . ', ' .
				'a.product_types_expense_percent = f.expense_percent, ' .
                'a.number = IF(a.number, a.number, ' . $db->quote($data['number']) . '), ' .
                'a.date = IF(TO_DAYS(a.date) > 0, a.date, ' . $db->quote($data['date_year'] . $data['date_month'] . $data['date_day']) . '), ' .
                'a.insurer = CONCAT(b.insurer_lastname, \' \', b.insurer_firstname), ' .
				'a.interrupt_datetime = a.end_datetime, ' .
                'b.assured_title = IF(b.financial_institutions_id , d.title, IF(b.assured_title, b.assured_title, ' . $db->quote($data['assured_title']) . ')), ' .
                'b.assured_identification_code = IF(b.financial_institutions_id , d.edrpou, IF(b.assured_identification_code, b.assured_identification_code, ' . $db->quote($data['assured_identification_code']) . ')), ' .
                'b.assured_address = IF(b.financial_institutions_id, d.address, IF(b.assured_address, b.assured_address, ' . $db->quote($data['assured_address']) . ')), ' .
                'b.assured_phone = IF(b.financial_institutions_id , d.phone, IF(b.assured_phone, b.assured_phone, ' . $db->quote($data['assured_phone']) . ')), ' .
				'h.child_id = ' . intval($id) . ' ' .
                'WHERE a.id = ' . intval($id);
        $db->query($sql);

		if ($data['financial_institutions_id']==33 ) //astra
		{
			$sql = 'UPDATE ' . PREFIX . '_policies_ns a '.
					' JOIN  insurance_financial_institutions b on b.id=59 '.
					' SET a.assured_title=b.title,a.assured_address=b.address,a.assured_identification_code=b.edrpou,a.assured_phone=b.phone WHERE a.policies_id=' . intval($id);
			$db->query($sql);	
		}
		
		if ($data['policy_statuses_id'] == POLICY_STATUSES_RENEW) {//переукладення, удаляем все неоплаченые ожидаемые платежи с календаря дочернего полиса
			$sql = 'DELETE FROM ' . PREFIX . '_policy_payments_calendar WHERE policies_id=' . intval($data['parent_id']) . ' AND statuses_id = ' . PAYMENT_STATUSES_NOT;
			$db->query($sql);
		}

		if (intval($data['parent_id'])) {
			$sql = 'UPDATE  ' . PREFIX . '_policies SET child_id = ' . intval($id) . ' WHERE id = ' . intval($data['parent_id']);
			$db->query($sql);
		}

        $this->updateRisks($id, PRODUCT_TYPES_NS, $data['risks'],  $data['products_id']);
		$this->updateAgreements($id, $data['agreements']);

		if (!$data['skipCalendar'] && !$data['dontRecalcRate']) {
	        $PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
    	    $PolicyPaymentsCalendar->updateCalendar($id, true);
			$this->setPaymentStatus($id);
		}

		if (!$data['dontRecalcRate']) {
			$this->setCommissions($id);
		}

		if (!$data['dontRecalcRate']) {
			if ($data['policy_statuses_id_old'] != $data['policy_statuses_id'] && in_array($data['policy_statuses_id'], $UNDERWRITING_POLICY_STATUSES)) {
				if (!$data['skipQuotes']) {
					$PolicyQuotes = new PolicyQuotes($data);
					$PolicyQuotes->permissions['insert'] = true;
					$PolicyQuotes->insert($this->get($id));
				}
			}
		}	
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;
		$this->prepareForm($data);

		if (intval($data['change_mode'])) {
			$this->showForm($data, $GLOBALS['method'], 'insert');
			return;
		}

		$data['agencies_id']	= $Authorization->data['agencies_id'];
		$data['agents_id']		= $Authorization->data['id'];

		$data['id'] = $data['policies_id'] = parent::insert(&$data, false, $showForm);

        if (intval($data['id'])) {

            $this->setAdditionalFields($data['id'], $data);

			$this->generateDocuments($data['id']);

			if ($data['types_id'] == POLICY_TYPES_QUOTE) {
				$data['text'] = $data['comment'];

				$PolicyMessages = new PolicyMessages($data);
				$PolicyMessages->insert($data, false);
			}

			switch ($Authorization->data['roles_id']) {
				case ROLES_AGENT:
					$sql =  'SELECT * ' .
							'FROM ' . PREFIX . '_accounts ' .
							'WHERE id = ' . intval($data['agents_id']);
					$row = $db->getRow($sql);

					$sql =  'UPDATE ' . PREFIX . '_policies_ns SET ' .
							'agent_lastname = ' . $db->quote($row['lastname']) .  ', ' .
							'agent_firstname =  ' . $db->quote($row['firstname']) . ', ' .
							'agent_patronymicname = ' . $db->quote($row['patronymicname']) . ' ' .
							'WHERE policies_id=' . intval($data['id']);
					$db->query($sql);
					break;
            }

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
		}
    }

    function prepareFields($action, &$data) {
        global $db;

        $data = parent::prepareFields($action, $data);

		$sql =  'SELECT *, date_format(date, \'' . DATE_FORMAT . '\') AS date, date_format(date, \'%Y\') AS date_year, date_format(date, \'%m\') AS date_month, date_format(date, \'%d\') AS date_day ' .
				'FROM ' . PREFIX . '_policies_ns_agreements ' .
				'WHERE policies_id = ' . intval($data['id']);
		$data['agreements'] = $db->getAll($sql);

        return $data;
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization,$db;
		$this->prepareForm($data);
		
		if (intval($data['change_mode'])) {
			$this->showForm($data, $GLOBALS['method'], 'update');
			return;
		}

		if ($Authorization->data['permissions']['Policies_NS']['superupdate']) {//прочитать старый тариф для лога сообщений
			$oldrate = $db->getRow('SELECT rate, amount FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['id']));
		}

		if ($data['id'] = parent::update(&$data, false, $showForm)) {

			$this->setAdditionalFields($data['id'], $data);
			$this->generateDocuments($data['id']);

			if ($data['types_id'] == POLICY_TYPES_QUOTE) {
				$data['policies_id'] = $data['id'];
				$data['text'] = $data['comment'];

				$PolicyMessages = new PolicyMessages($data);
				$PolicyMessages->insert($data, false);
			}
			
			if ($Authorization->data['permissions']['Policies_NS']['superupdate']) {//прочитать новый тариф для лога сообщений и создать сообщения
				$newrate = $db->getRow('SELECT rate, amount FROM ' . PREFIX . '_policies WHERE id='.intval($data['id']));
				$data['policies_id'] = $data['id'];

				if ($data['dontRecalcRate']) {
					$data['subject'] = 'Полiс був модифiкований без перерахунку тарифу';
				} else {
					$data['subject'] = 'Полiс був модифiкований Старий тариф: ' . $oldrate['rate'].'%/'.$oldrate['amount'].' грн. новий: ' . $newrate['rate'].'%/'.$newrate['amount'].' грн.';
				}

				$PolicyMessages = new PolicyMessages($data);
				$PolicyMessages->insert($data, false);
			}

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id='.$data['id'].'&product_types_id='.$data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
		}
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log;
        unset($this->tables[2]);
        unset($this->tables[1]);
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
					
					if ($values['insurer_regions_id']==27 && mb_eregi('евастополь', $values['insurer_city']))
						$values[ $field ] = $values['insurer_city'];

                    $values[ $field ] .=  ', ' . StreetTypes::getTitle($values['insurer_street_types_id']) . ' ' . $values['insurer_street'] . ', буд. ' . $values['insurer_house'];

					if ($values['insurer_flat']) {
						//switch ($values['insurer_person_types_id']) {
							//case 1:
								$values[ $field ] .= ', кв. ' . $values['insurer_flat'];
								//break;
							/*case 2:
								$values[ $field ] .= ', оф. ' . $values['insurer_flat'];
								break;
						}*/
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

	//получаем данные по догору для подстановки в шаблон
    function getValues($file) {
        global $db, $Smarty;

        $sql =  'SELECT a.*, b.*, c.*, e.mfo as assured_mfo, DATE_SUB(begin_datetime, INTERVAL 1 DAY) AS endPaymentDate, DATE_ADD(DATE_SUB(begin_datetime, INTERVAL 1 DAY), INTERVAL 1 YEAR) AS endDateYear,  IF(payment_statuses_id<>' . PAYMENT_STATUSES_NOT . ' OR LENGTH(payment_number)>0, 0, 1) AS sample, ' .
				'r1.title AS agencies_title, r1.edrpou AS agencies_edrpou, r1.ground_ns_express AS ground_kasko, r1.director1 as director1, r1.director2, r1.findirector1 as findirector1, r1.findirector2 as findirector2, c.insurer_person_types_id as person_types_id,p.bill_bank_account,p.bill_bank_mfo, ' .
				'r1.id as rid, r1.title as rtitle, r1.edrpou as redrpou, r1.address as raddress, r1.bank as rbank, r1.bank_mfo as rbankmfo, r1.bank_account as rbankaccount ' .
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . $this->tables[0] . ' AS b ON a.policies_id = b.id ' .
                'JOIN ' . $this->tables[1] . ' AS c ON b.id = c.policies_id ' .
				'LEFT JOIN insurance_products_ns p ON p.products_id = c.products_id '.
                'JOIN ' . PREFIX . '_agencies AS d ON b.agencies_id = d.id ' .
                'LEFT JOIN ' . PREFIX . '_financial_institutions AS e ON e.id = c.financial_institutions_id ' .
				'JOIN (SELECT a.id as idpd, b.id as idpol, IF( b.seller_agencies_id>0, IF 			(ds.ground_kasko_express IS NOT NULL AND LENGTH(ds.ground_kasko_express)>0, ds.id,IF(ds1.id>0,ds1.id,ds.id) ) ,IF (d.ground_kasko_express IS NOT NULL AND LENGTH(d.ground_kasko_express)>0, d.id, IF(d1.id>0,d1.id,d.id) ) ) as idag 
					from ' . PREFIX . '_policy_documents AS a
					join ' . $this->tables[0] . ' AS b ON a.policies_id = b.id
					join ' . PREFIX . '_agencies AS d ON b.agencies_id = d.id
					LEFT JOIN ' . PREFIX . '_agencies AS d1 ON d1.id = d.parent_id
					LEFT JOIN ' . PREFIX . '_agencies AS ds ON b.seller_agencies_id = ds.id
					LEFT JOIN ' . PREFIX . '_agencies AS ds1 ON ds1.id = ds.parent_id) as rek ON rek.idpd = a.id ' .
				'JOIN ' . PREFIX . '_agencies AS r1 ON r1.id = rek.idag ' .	
                'WHERE a.id=' . intval($file['id']);
        $row = $db->getRow($sql);
 //_dump($sql);exit;
        $sql ='SELECT b.types_id, b.title ' .
              'FROM ' . PREFIX . '_policies_ns_parameters_assignments as a ' .
              'JOIN ' . PREFIX . '_parameters_ns as b ON b.id = a.values_id ' .
              'JOIN ' . PREFIX . '_policies_ns as c ON c.policies_id = a.policies_id ' .
              'WHERE a.policies_id = ' . $row['policies_id'];
        $row['correct_factors'] = $db->getAssoc($sql);
       
        $sql =	'SELECT * ' .
                'FROM ' . PREFIX . '_policies_ns_agreements ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $row['agreements'] = $db->getAll($sql);

        /*if (intval($row['sign_agents_id'])) {

            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_agents ' .
                    'WHERE accounts_id = ' . intval($row['sign_agents_id']);
            $agent = $db->getRow($sql);

			$agent['ground_kasko'] = $agent['ground_kasko_express'];

            if ($agent['ground_kasko'] && $agent['director1'] && $agent['director2']) {
                $row['ground_kasko']	= $agent['ground_kasko'];
                $row['director1']		= $agent['director1'];
                $row['director2']		= $agent['director2'];
            }
			 if ($agent['ground_ns_express'] && $agent['director1'] && $agent['director2']) {
				$row['ground_ns']	= $agent['ground_ns_express'];
                $row['director1']		= $agent['director1'];
                $row['director2']		= $agent['director2'];
            }
			if ($agent['ground_ns_gl'] && $agent['director1'] && $agent['director2']) {
				$row['ground_ns_gl']	= $agent['ground_ns_gl'];
                $row['director1']		= $agent['director1'];
                $row['director2']		= $agent['director2'];
            }
			
			
        }*/
		
		$r = $db->getRow('SELECT title,order_position FROM '.PREFIX.'_parameters_terms WHERE id='.intval($row['terms_id']));
		$row['month_count'] = $r['order_position'];
		$row['terms_title'] = $r['title'];
		
		$row['years_count'] = ($row['month_count'] % 12)==0 ? $row['month_count']/12 : (int)($row['month_count']/12) + 1 ;
        $sql =	'SELECT date, amount, DATE_SUB(date, INTERVAL 1 DAY) AS lastdate ' .
                'FROM ' . PREFIX . '_policy_payments_calendar  ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $row['payments'] = $db->getAll($sql);

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policy_risks AS a ' .
                'JOIN ' . PREFIX . '_parameters_risks AS b ON a.risks_id = b.id ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $risks = $db->getAll($sql);

        foreach ($risks as $risk) {
            $row[$risk['alias']] = true;
        }

        switch ($row['product_document_types_id']) {
            case DOCUMENT_TYPES_POLICY_NS_APPLICATION://заявление
            case DOCUMENT_TYPES_POLICY_NS_AGREEMENT://полис
            case DOCUMENT_TYPES_POLICY_NS_QUESTIONNAIRE://опросник
                $fields = array(
                    'insurer_title',
                    'insurer_address',
					'closed');
                break;
            case DOCUMENT_TYPES_POLICY_NS_BILL://счет
                $fields = array('payed', 'closed');
                break;
        }

	if (strtotime($row['date']) >= strtotime('2013-07-04')) {
            $row['new_director'] = 1;
        }

        return $this->prepareValues($fields, $row);
    }

    function get($id) {
        global $db;

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_ns AS b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        return $db->getRow($sql);
    }

	//изменение подписанта в договоре страхования
    function changeSignInWindow($data) {
        global $db;

        //$this->checkPermissions('update', $data);

        $sql =  'UPDATE ' . PREFIX . '_policies_ns SET ' .
                'sign_agents_id = ' . intval($data['sign_agents_id']) . ' ' .
                'WHERE policies_id = ' . intval($data['policies_id']);
        $db->query($sql);

        if ($this->getPolicyStatusesId($data['policies_id']) == POLICY_STATUSES_GENERATED) {
            PolicyDocuments::generateTemplates($data['policies_id'], null, true);
        }

        echo 'Ok';
        exit;
    }

    function updateRisks($id, $product_types_id, $risks, $products_id) {
        global $db;

        $sql =  'DELETE FROM ' . PREFIX . '_policy_risks ' .
                'WHERE policies_id = ' . intval($id);

        $db->query($sql);

        $sql =  'INSERT INTO ' . PREFIX . '_policy_risks (policies_id, risks_id) ' .
                'SELECT ' . intval($id) . ', risks_id ' .
                'FROM ' . PREFIX . '_product_risks AS a ' .
				'JOIN ' . PREFIX . '_parameters_risks AS b ON a.risks_id = b.id ' .
                'WHERE product_types_id = ' . intval($product_types_id) . ' AND risks_id IN(' . implode(', ', $risks) . ') AND products_id = ' . intval($products_id);

        $db->query($sql);
    }

	function getLink($text, $fieldName, $fieldType) {
		global $Authorization;
		
		$reset = false;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
				$reset = true;
                break;
            case ROLES_MANAGER:
				$reset =($Authorization->data['permissions']['Policies_NS']['update']) ? true : false;
                break;
        }

		if ($this->mode == 'update') $reset = false;

		if (!$reset) return $text;

		return '<a itemid="' . $fieldName . '" fieldtype="' . $fieldType . '" class="changeval" href="#inlinecontent">' . $text . '</a>';
	}

	//измененяем представителя СТО
	function changeServicePersonInWindow($data) {
		global $db, $Log;

		if (true || $this->canChangeServicePerson($data['id'])) {

		
			$sql =	'SELECT products_id, date, agencies_id,a.manager_id,a.seller_agents_id ' .
					'FROM ' . PREFIX . '_policies AS a ' .
					'JOIN ' . PREFIX . '_policies_ns AS b ON a.id = b.policies_id ' .
					'WHERE a.id = ' . intval($data['id']);
			$row =	$db->getRow($sql);

			$Products = Products::factory($data, 'NS');
			$commissions = $Products->getCommissions($row['products_id'], $row['date'], $row['agencies_id']);

			//тут доп преобразования комиссии
			if ($row['manager_id']) //выбрали менеджера що привiв клиента
			{
				$commissions['commission_agent_percent'] = $commissions['commission_agent_percent']/2;
			}
			else {
				$commissions['commission_manager_percent'] = 0;
			}
			
			if (!$row['seller_agents_id']) //не выбрали продающего в агенции
			{
				$commissions['commission_seller_agents_percent'] = 0;
			}
			 
			
			
			$sql =	'UPDATE ' . PREFIX . '_policies_ns SET ' .
					'commission_agency_percent = ' . $db->quote($commissions['commission_agency_percent']) . ', ' .
					'commission_agent_percent = ' . $db->quote($commissions['commission_agent_percent']) . ', ' .
					'commission_financial_institution_percent = ' . $db->quote($commissions['commission_financial_institution_percent']) . ', ' .
					'commission_manager_percent = ' . $db->quote($commissions['commission_manager_percent']) . ', ' .
					'commission_seller_agents_percent = ' . $db->quote($commissions['commission_seller_agents_percent']) . ',  ' .
					
					'director1_commission_percent = ' . $db->quote($commissions['director1_commission_percent']) . ', ' .
					'director2_commission_percent = ' . $db->quote($commissions['director2_commission_percent']) . '  ' .
							
					'WHERE policies_id = ' . intval($data['id']);
			$db->query($sql);

			//обратить внимание на расчет комиссии
			$this->setCommissions($data['id']);

			$Log->add('confirm', '  Комісійна винагорода перерахована.');
		}

		echo $Log->getText(' ');
		$Log->clear();
	}
	
	//Export 1C 7.7
     function getXML($data) {
        global $db, $Smarty;

	  $conditions[] = 'b.financial_institutions_id<>25';
//	  $conditions[] = 'b.financial_institutions_id<>52';
	  $conditions[] = 'a.number  like \'301.%\'';
	  $conditions[] = 'a.policy_statuses_id=10';
	  
      if ($data['number']) {
            $conditions[] = 'a.number=' . $db->quote($data['number']);
        } else {
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.date )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.date )>=TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.date )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.date ) <= TO_DAYS(NOW())';
        }

        $conditions[] = 'b.financial_institutions_id<>28';

        $sql =  'SELECT a.*, b.*,1 as insurer_person_types_id,e.code,c.title AS policy_statuses_title, d.title AS insurer_regions_title,  IF(e1.id>0,e1.title,e.title) AS agencies_title ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_ns AS b ON a.id = b.policies_id ' .
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
        return  $Smarty->fetch($this->object . '/ns.xml');
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

        if ($data['shassi']) {
            $conditions[] = 'shassi = ' . $db->quote($data['shassi']);
        }

        if ($data['sign']) {
            $conditions[] = 'sign = ' . $db->quote($data['sign']);
        }

        if (!$conditions) {
            $result = 'Не задали жодного критерію пошуку.';
        } else {

            $sql =  'SELECT b.policies_id, CONCAT(b.insurer_lastname, \' \', b.insurer_firstname, \' \', b.insurer_patronymicname) AS insurer, a.number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format, date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS begin_datetime_format, date_format(a.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS interrupt_datetime_format ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_ns AS b ON a.id = b.policies_id ' .
                    //'JOIN ' . PREFIX . '_policies_ns_items AS c ON a.id = c.policies_id ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' ' .
                    'ORDER BY begin_datetime DESC';
            $list = $db->getAll($sql);

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
										'<td align="center"><input type="radio" name="items_id" value="' . $row['items_id'] . '" ' . ( ($row['items_id'] == $data['items_id']) ? 'checked' : '') . ' onclick="choosePolicy(' . $row['policies_id'] . ')" ' . $this->getReadonly(true) . ' /></td>' .
										'<td>' . $row['insurer'] . '</td>' .
										'<td><a href="/?do=Policies|view&id=' . $row['policies_id'] . '&product_types_id=' . PRODUCT_TYPES_KASKO . '" target="_blank">' . $row['number'] . '</a></td>' .
										'<td>' . $row['date_format'] . '</td>' .
										'<td>' . $row['item'] . '</td>' .
										'<td>' . $row['shassi'] . '</td>' .
										'<td>' . $row['sign'] . '</td>' .
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

					if ($row['items_id'] == $data['items_id']) $data['policies_id'] = $row['policies_id'];

					$result .= '<input type="hidden" id="policies_id" name="policies_id" value="' . $data['policies_id'] . '" />';
					break;
				default:
					$result .= '<tr><td colspan="9" align="center" style="color: red;">Згідно заданних критеріїв знайдено багато полісів. Змініть критерії пошуку.</td></tr>';
					$result .= '</table>';
			}
        }

        echo $result;
    }
	
	function getShowFieldsSQLString() {
        $result = parent::getShowFieldsSQLString();

        $result .= ', insurance_policies_ns.financial_institutions_id ';

        return $result;
    }
	
	function exportInWindow($data) {

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        $this->show($data, null, null, null, 'excel_ns.php', false);
        exit;
    }
	
	
	
	function loadBankProductsInWindow($data) {
		global $db;

		
		$sql = '
		SELECT a.id,a.title FROM  insurance_products a JOIN  insurance_products_ns b on b.products_id=a.id JOIN insurance_product_financial_institution_assignments c ON c.products_id=a.id AND financial_institutions_id='.intval($data['financial_institutions_id']).' WHERE a.publish=1 ';
		
		$list = $db->getAll($sql);

		$result = '<select id="allowed_ins_product_id"  name="allowed_ins_product_id"   class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
		$result.='<option  value="0">...</option>';
		foreach($list as $row) {
			$result.='<option  value="'.$row['id'].'">'.$row['title'].'</option>';
		}
		$result.='</select><a href="JavaScript:setupProd()">Встановити</a>';

		echo $result;
		exit;		
	}
	
	
	function setupAllowedFinProdInWindow($data) {
		global $db;

		$allowed_product_id = $data['allowed_product_id'];
		$sql = 'update insurance_policies_ns set allowed_products_id='.$db->quote($data['allowed_product_id']).' where  policies_id = '.$data['id'];
		$db->query($sql);		
		echo 'Готово';
		exit;		
	}
}

?>