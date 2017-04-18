<?
/*
 * Title: policy PROPERTY class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'PolicyDocuments.class.php';
require_once 'Policies/Property.class.php';

class PropertyObjects extends Form {

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
                            'table'             => 'policies_property_objects'),
                        array(
                            'name'              => 'policies_id',
                            'description'       => 'Поліс',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_property_objects'),
						array(
							'name'				=> 'title',
							'description'		=> ' Назва об\'єкта страхування',
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
							'table'				=> 'policies_property_objects'),
						array(
							'name'				=> 'object_purpose',
							'description'		=> 'Призначення об\'єкта страхування',
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
									'canBeEmpty'	=> true
								),
							'table'				=> 'policies_property_objects'),
                        array(
                            'name'              => 'object_type',
                            'description'       => 'Тип об\'єкту страхування ',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Будинки, споруди, приміщення',
													2 => 'Обладнання',
													3 => 'Товарно-матеріальні цінності',
													4 => 'Вміст'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'construction_types_id',
                            'description'       => 'тип контрукції',
                            'type'              => fldSelect,
							'showId'			=> true,
                            'list'              => array(
													1 => 'тільки контрукція',
													2 => 'конструкції з невід\'ємними комунікаціями',
													3 => 'конструкції з невід\'ємними комунікаціями + оздоблення'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'houses_types_id',
                            'description'       => 'Будинки, споруди, приміщення',
                            'type'              => fldSelect,
							'showId'			=> true,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true,
                                    'change'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_property_objects',
                            'sourceTable'       => 'policies_property_objects_houses_types',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
						array(
                            'name'              => 'tmc_types_id',
                            'description'       => 'ТМЦ',
                            'type'              => fldSelect,
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_property_objects',
                            'sourceTable'       => 'policies_property_objects_tmc_types',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
						array(
                            'name'              => 'equipments_types_id',
                            'description'       => 'Обладнання',
                            'type'              => fldSelect,
							'showId'			=> true,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true,
                                    'change'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_property_objects',
                            'sourceTable'       => 'policies_property_objects_equipments_types',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
						array(
                            'name'              => 'contents_types_id',
                            'description'       => 'ВМІСТ',
                            'type'              => fldSelect,
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_property_objects',
                            'sourceTable'       => 'policies_property_objects_contents_types',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
						array(
                            'name'              => 'organization_types_other',
                            'description'       => 'Інше (Вид діяльності організації)',
                            'type'              => fldText,
							'showId'			=> true,
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

                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'object_houses_types_id',
                            'description'       => 'Тип будівлі/споруди, де знаходиться об\'єкт страхування',
                            'type'              => fldSelect,
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_property_objects',
                            'sourceTable'       => 'policies_property_objects_houses_types',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),	
						 array(
                            'name'              => 'stock_type_id',
                            'description'       => 'Тип складу',
							'showId'			=> true,
                            'type'              => fldRadio,
                            'list'              => array(
													1 => 'А. спеціальне виділене та обладнане приміщення',
													2 => 'В.відкритий майданчик'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'stock_area',
                            'description'       => 'Загальна площа території',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'barrier_type',
                            'description'       => 'Вид огорожі',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'total_stock_area',
                            'description'       => 'Загальна площа складу',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'other_person_goods',
                            'description'       => 'Чи зберігаються на триторії складу товари, які належать іншим особам',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'other_person_goods_access',
                            'description'       => 'Чи обмежено доступ власників таких товарів до товарів, що належать заявнику і яким чином',
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'stock_load_unload',
                            'description'       => 'Чи здійснюється на теритоії складу завантаження/розвантаження',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'stock_load_unload_type',
                            'description'       => 'Яким чином здійснюються такі операції',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'doors_count',
                            'description'       => 'Кількість зовнішніх входів до складських приміщень',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'personal_count',
                            'description'       => 'Кількість персоналу, що працює на території складу',
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'fire_substances',
                            'description'       => 'Наявніть на складі вогненебезпечних речовин',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'substance_name',
                            'description'       => 'назва речовини',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'substance_type',
                            'description'       => 'тип (рідина, газ, тверда)',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'substance_amount',
                            'description'       => 'кількість речовини',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'substance_storing_type',
                            'description'       => 'спосіб зберігання',
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'safety_futures',
                            'description'       => 'особливі засоби безпеки',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'racking_height',
                            'description'       => 'Висота стелажів',
                            'type'              => fldText,
                            'maxlength'         => 80,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'passess_width',
                            'description'       => 'Ширина проходів',
                            'type'              => fldText,
                            'maxlength'         => 80,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'total_stock_area1',
                            'description'       => 'Загальна площа складу',
                            'type'              => fldText,
                            'maxlength'         => 80,
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'defense_type',
                            'description'       => 'Ступінь захисту',
                            'type'              => fldText,
                            'maxlength'         => 80,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'person_on_stock',
                            'description'       => 'Чи дозволяється особам, які не працюють на складі, перебувати на території складу',
                            'type'              => fldText,
                            'maxlength'         => 80,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'total_house_area',
                            'description'       => 'Загальна площа будівлі',
                            'type'              => fldText,
                            'maxlength'         => 80,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'object_area',
                            'description'       => 'Площа об\'єкта',
                            'type'              => fldText,
                            'maxlength'         => 80,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'object_equipment_area',
                            'description'       => 'Площа приміщення, де знаходиться обладнання',
                            'type'              => fldText,
                            'maxlength'         => 80,
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'floor_count',
                            'description'       => 'Скільки поверхів у будівлі',
                            'type'              => fldText,
                            'maxlength'         => 80,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'object_floor',
                            'description'       => 'На якому поверсі розташований об\'єкт',
                            'type'              => fldText,
                            'maxlength'         => 80,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'house_years',
                            'description'       => 'Вік будівлі/складу',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'до 1 року',
													2 => 'від 1 до  5 років',
													3 => 'від 5 до 20 років',
													4 => 'від 20 до 50 років',
													5 => 'від 50 років'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'equipment_years',
                            'description'       => 'Вік будівлі/складу',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'до 1 року',
													2 => 'від 1 до  5 років',
													3 => 'від 5 до 20 років',
													4 => 'від 20 '),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'staff_experience',
                            'description'       => 'Досвід персоналу, що має доступ до обладнання',
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

                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'object_location',
                            'description'       => 'Місцезнаходженния об\'єкта страхування',
                            'type'              => fldText,
                            'maxlength'         => 255,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'additional_info',
                            'description'       => 'Додаткова інформація про об\'єкт страхування',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'distance_object_lt20',
                            'description'       => 'відстань до об\'єкта страхування менше 20 м',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
                                                        1 => 'Так',
                                                        0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'distance_object_gt20',
                            'description'       => 'відстань до об\'єкта страхування більше 20 м',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'wallmaterial',
                            'description'       => 'Стін',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'roofmaterial',
                            'description'       => 'Крівлі',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'footingmaterial',
                            'description'       => 'Фундаменту',
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'overlapmaterial',
                            'description'       => 'Перекриттів',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'decorationmaterial',
                            'description'       => 'Оздоблення',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'objtype1',
                            'description'       => 'тип об\'єкта',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'objtype2',
                            'description'       => 'тип об\'єкта',
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

                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'water_system',
                            'description'       => 'Водопровідна',
                            'type'              => fldRadio,
							'list'              => array(
													1 => 'центральна',
													2 => 'місцева',
													3 => 'власна'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'electric_sytem',
                            'description'       => 'Електрична',
                            'type'              => fldRadio,
                            'list'              => array(
													1 => 'центральна',
													2 => 'місцева',
													3 => 'власна'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'sewage_system',
                            'description'       => 'Каналізаційна',
                            'type'              => fldRadio,
                            'list'              => array(
													1 => 'центральна',
													2 => 'місцева',
													3 => 'власна'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'heating_system',
                            'description'       => 'Опалювальна',
                            'type'              => fldRadio,
                            'list'              => array(
													1 => 'центральна',
													2 => 'місцева',
													3 => 'власна'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'fire_objects',
                            'description'       => 'Негорючі',
                            'type'              => fldRadio,
                            'list'              => array(
													1 => 'Негорючі',
													2 => 'Важкозаймисті',
													3 => 'Легкозаймисті'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'extinguisher',
                            'description'       => 'Вогнегасник',
                            'type'              => fldRadio,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),							
						array(
                            'name'              => 'extinguisher_count',
                            'description'       => 'Вогнегасник кількість',
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
                            'table'             => 'policies_property_objects'),	
							array(
                            'name'              => 'extinguisher_type',
                            'description'       => 'Вогнегасник марка',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'sprinklers',
                            'description'       => 'Спринклери',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),							
						array(
                            'name'              => 'sprinklers_source',
                            'description'       => 'Джерело води для спринклерів',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'fire_alarm',
                            'description'       => 'Протипожежна сигналізація',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'sensor_heat',
                            'description'       => 'тип датчиків тепло',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'sensor_smoke',
                            'description'       => 'тип датчиків дим',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'sensor_fire',
                            'description'       => 'тип датчиків вогонь',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'signal_remote_state',
                            'description'       => 'Передача сигналу тривоги на пульт державної пожежної частини',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'signal_enterprise',
                            'description'       => 'Передача сигналу тривоги на контрольний пункт на підприємстві',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'distance_fire',
                            'description'       => 'Відстань до державної пожежної частини',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'time_fire',
                            'description'       => 'Час до державної пожежної частини',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'no_alarm',
                            'description'       => 'Відсутня сигналізація',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'other_alarm',
                            'description'       => 'Інша сигналізація',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'has_lightning',
                            'description'       => ' Наявність блискавковідводів',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'has_pdto_alarm',
                            'description'       => ' Наявність сигналізації',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'manual_pdto',
                            'description'       => ' Наявність сигналізації ручна',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'automatic_pdto',
                            'description'       => ' Наявність сигналізації автоматична',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'has_protection',
                            'description'       => ' Наявність охорони',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'mvs_protection',
                            'description'       => 'Охорона державна (МВС)',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'ooxp_protection',
                            'description'       => 'озброєна охорона (ООХР)',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'nonmilitary_protection',
                            'description'       => 'Охорона відомча невоєнізована',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),		
						array(
                            'name'              => 'private_protection',
                            'description'       => 'Охорона приватна',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'armored_doors',
                            'description'       => 'броньовані вхідні двері',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'fense',
                            'description'       => 'огорожа, паркан',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'no_protection',
                            'description'       => 'Охорона відсутня',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'no_protection_reason',
                            'description'       => 'вкажіть причину Охорона відсутня',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'mvs_guards',
                            'description'       => 'державна (МВС) кількість охоронців на зміні',
                            'type'              => fldText,
                            'maxlength'         => 8,
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'mvs_detours',
                            'description'       => 'державна (МВС) кількість обходів',
                            'type'              => fldText,
                            'maxlength'         => 8,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'ooxp_guards',
                            'description'       => 'озброєна охорона (ООХР) кількість охоронців на зміні',
                            'type'              => fldText,
                            'maxlength'         => 8,
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'ooxp_detours',
                            'description'       => 'озброєна охорона (ООХР) кількість обходів',
                            'type'              => fldText,
                            'maxlength'         => 8,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'nonmilitary_guards',
                            'description'       => 'відомча невоєнізована кількість охоронців на зміні',
                            'type'              => fldText,
                            'maxlength'         => 8,
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'nonmilitary_detours',
                            'description'       => 'відомча невоєнізована кількість обходів',
                            'type'              => fldText,
                            'maxlength'         => 8,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'private_guards',
                            'description'       => ' приватна кількість охоронців на зміні',
                            'type'              => fldText,
                            'maxlength'         => 8,
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'private_detours',
                            'description'       => 'приватна  кількість обходів',
                            'type'              => fldText,
                            'maxlength'         => 8,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'cctvsystem',
                            'description'       => 'Система відеоспостереження',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'cctv_territory',
                            'description'       => 'Система відеоспостереження на території',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'cctvindoors',
                            'description'       => 'Система відеоспостереження в приміщенні',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'               => 'risks_id',
                            'description'        => 'Страхові ризики',
                            'type'               => fldMultipleSelect,
							'showId'			 => true,
                            'display'            =>
                                array(
                                    'show'       => false,
                                    'insert'     => true,
                                    'view'       => true,
                                    'update'     => true,
                                    'change'     => false
                                ),
                            'verification'       =>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'table'             => 'policies_property_objects_risks_assignments',
                            'sourceTable'       => 'parameters_risks',
                            'selectField'       => 'title',
							'condition'         => 'product_types_id = 12',
                            'orderField'        => 'order_position'),
						array(
                            'name'              => 'method_property_cost',
                            'description'       => 'Метод визначення вартості майна',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Дійсна вартість',
													2 => 'Відновлювальна вартість',
													3 => 'Балансова вартість',
													4 => 'Оціночна вартість',
													5 => 'Заявлена вартість'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'property_accepted_type',
                            'description'       => 'Майно приймається на страхування',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'В повному обсязі',
													2 => 'Вибірково',
													3 => 'Перший ризик',
													4 => 'Страхова сума відповідає'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'property_ownership',
                            'description'       => 'Форма власності об\'єкту страхування',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Власний',
													2 => 'Орендований',
													3 => 'В лізингу',
													4 => 'Інше'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'property_ownership_other',
                            'description'       => 'Інше  Форма власності об\'єкту страхування',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'prev_insurer',
                            'description'       => 'Попередній/поточний страховик',
                            'type'              => fldText,
                            'maxlength'         => 200,
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
                            'table'             => 'policies_property_objects'),	
						array(
							'name'              => 'insured_responsible_sum',
							'description'       => 'Страхова сума відповідає (% від вартості майна)',
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
							'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'additional',
                            'description'       => 'Додаткова інформація',
                            'type'              => fldNote,
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'last5_loses',
                            'description'       => 'Дані про збитки за останні 5 (п\'ять) років',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'fire_expenses',
                            'description'       => 'Витрати, що пов\'язані з гасінням пожежі та іншими заходами по ліквідації страхового випадку, спрямовані на зменшення наслідків страхового випадку',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'fire_expenses_limit',
                            'description'       => 'Ліміт витрат',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'cleaning_expenses',
                            'description'       => 'Витрати по розчищенню території, зламу і розбору руїн, вивезенню сміття, утилізації залишків майна та ін.',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'cleaning_expenses_limit',
                            'description'       => 'Ліміт витрат',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'glasses_expenses',
                            'description'       => 'Бій скла , вітрин, вітражів, скляних стін, віконних та дверних рам',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'glasses_expenses_limit',
                            'description'       => 'Ліміт витрат',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'glasses_expenses_deductible',
                            'description'       => 'Варианты франшизы:',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													2 => '2%',
													5 => '5%',
													10 => '10%'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'damage_expenses',
                            'description'       => 'Пошкодження або знищення предметів, закріплених на зовнішній стороні застрахованої будівлі',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'damage_expenses_limit',
                            'description'       => 'Ліміт витрат',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'damage_expenses_deductible',
                            'description'       => 'Варианты франшизы:',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													2 => '2%',
													5 => '5%',
													10 => '10%'),
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
                            'table'             => 'policies_property_objects'),	
						array(
                            'name'              => 'interruption_expenses',
                            'description'       => 'Збитки від перерви у виробництві',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													1 => 'Так',
													0 => 'Нi'),
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'interruption_expenses_limit',
                            'description'       => 'Ліміт витрат',
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
                            'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'interruption_expenses_deductible',
                            'description'       => 'Варианты франшизы:',
                            'type'              => fldRadio,
							'showId'			=> true,
                            'list'              => array(
													2 => '2%',
													5 => '5%',
													10 => '10%'),
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
                            'table'             => 'policies_property_objects'),
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
                            'table'             => 'policies_property_objects'),
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
                            'table'             => 'policies_property_objects')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 1,
                        'defaultOrderDirection' => 'asc',
                        'titleField'            => 'title'
                    )
                );

    var $fiz_person_formDescription =
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
                        'table'             => 'policies_property_objects'),
                   array(
                        'name'              => 'policies_id',
                        'description'       => 'Поліс',
                        'type'              => fldHidden,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => false,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'             => 'policies_property_objects'),
                   array(
                        'name'				=> 'title',
                        'description'		=> ' Назва об\'єкта страхування',
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
                                'canBeEmpty'	=> true
                            ),
                        'orderPosition'		=> 1,
                        'table'				=> 'policies_property_objects'),
                   array(
                        'name'              => 'risks_id',
                        'description'       => 'Страхові ризики',
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
                        'table'             => 'policies_property_objects_risks_assignments',
                        'sourceTable'       => 'parameters_risks',
                        'selectField'       => 'title',
                        'condition'         => 'product_types_id = 12',
                        'orderField'        => 'order_position'),
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
                        'table'             => 'policies_property_objects_values_assignments',
                        'sourceTable'       => 'parameters_property',
                        'selectField'       => 'title',
                        'orderField'        => 'order_position'),
                   array(
                        'name'              => 'object_location',
                        'description'       => 'Місцезнаходженния об\'єкта страхування',
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
                        'table'             => 'policies_property_objects'),
						
					array(
                        'name'              => 'ground_appointment',
                        'description'       => 'Цільове призначення земельної ділянки',
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
                        'table'             => 'policies_property_objects'),
						
                   array(
                        'name'              => 'house_years',
                        'description'       => 'Вік будівлі/складу',
                        'type'              => fldRadio,
                        'showId'			=> true,
                        'list'              => array(
                                                1 => 'до 1 року',
                                                2 => 'від 1 до  5 років',
                                                3 => 'від 5 до 20 років',
                                                4 => 'від 20 до 50 років',
                                                5 => 'від 50 років'),
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
                        'table'             => 'policies_property_objects'),
						array(
                            'name'              => 'additional',
                            'description'       => 'Додаткова інформація',
                            'type'              => fldNote,
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
                            'table'             => 'policies_property_objects'),

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
                        'table'             => 'policies_property_objects'),
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
                        'table'             => 'policies_property_objects')
                ),
            'common'    =>
                array(
                    'defaultOrderPosition'  => 1,
                    'defaultOrderDirection' => 'asc',
                    'titleField'            => 'title'
                )
            );

    var $insurer_person_types_id = 2;

    function PropertyObjects($data) {
        global $db;

        Form::Form($data);

        if (intval($data['policies_id'])>0) {
            $this->insurer_person_types_id = $db->getOne('SELECT insurer_person_types_id FROM '.PREFIX.'_policies_property WHERE policies_id='.intval($data['policies_id']));
        }

        if ($this->insurer_person_types_id==1) {
            $this->formDescription=$this->fiz_person_formDescription;
        }

        $this->objectTitle = 'PropertyObjects';

        $this->mode = Policies::getMode($data['policies_id']);
        $this->subMode = Policies::getSubMode($data['policies_id']);

        $this->messages['plural'] = 'Поліс "Майно", об\'єкти';
        $this->messages['single'] = 'Поліс "Майно", об\'єкти';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      		=> true,
                    'insert'       		=> true,
                    'update'      		=> true,
                    'view'      		=> true,
                    'change'    		=> true,
					'reset'     		=> true,
                    'delete'    		=> true
				);
                break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class(new Policies_Property($data)) ];
                break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'				=> true,
                    'insert'			=> true,
                    'update'     		=> true,
                    'view'      		=> true,
                    'change'    		=> false,
                    'delete'    		=> false);

                break;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {

        $fields[]        = 'policies_id';
        $conditions[]    = 'policies_id = ' . intval($data['policies_id']);

		//передаем тип документа для пермишинов
        $fields[]        = 'product_types_id';
        return parent::show($data, $fields, $conditions, $sql, $this->object . '/show.php', $limit);
    }

	function isEqual($field) {
		if (!sizeOf($this->values)) {
			return;
		}

		$field = explode('|', $field);

		$value	= $this->values;

		foreach ($field as $key) {
			$value = $value[ $key ];
		}

		return ($value) ? '' : ' notEqual';
	}

    function getReadonlySign(&$data) {
        return (intval($data['documents'])==0)
            ? ''
            : ' style="color: #666666; background-color: #f5f5f5;" disabled';
    }

    function buildCheckboxes($field, $value, $languageCode=null, $addition=null, $data=null, $postfix='<br />') {

        if (is_array($field['list']) && sizeOf($field['list']) > 0) {
            foreach ($field['list'] as $id => $row) {
                $result .= (in_array($id, $value))
                    ? '<input type="checkbox" name="' . $field['name'] . $languageCode . '[' . $id . ']" value="' . $id . '" ' . $addition . ' ' . $this->getReadonly(true) . ' checked /> ' . ((is_array($row)) ? $row['title'] : $row) . $postfix
                    : '<input type="checkbox" name="' . $field['name'] . $languageCode . '[' . $id . ']" value="' . $id . '" ' . $addition . ' ' . $this->getReadonly(true) . ' /> ' . ((is_array($row)) ? $row['title'] : $row) . $postfix;
            }
        } else {
            $result = '<div class="error">' . translate('No items present') . '</div>';
        }

        return $result;
    }

    function showForm($data, $action, $actionType=null, $template=null) {
		global $db;

        $template = ($this->insurer_person_types_id == 1) ? 'form_fiz.php' : 'form_jur.php';

        $r = $db->getRow('SELECT financial_institutions_id,terms_id FROM '.PREFIX.'_policies_property WHERE policies_id='.$data['policies_id']);

        $data['financial_institutions_id'] = $r['financial_institutions_id'];
        $data['terms_id'] =  $r['terms_id'];

		parent::showForm($data, $action, $actionType, $template);
	}

     function setConstants(&$data) {
		global $db;

		if ($data['insurer_person_types_id'] == 1) {//майно физ лица
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

			$sql = 'SELECT terms_id FROM ' . PREFIX . '_policies_property WHERE policies_id = ' . intval($data['policies_id']);
			$data['terms_id'] = $db->getOne($sql);

			$data['values_id'] = $values_id;

			$data['title']='Об\'єкт страхування';

			$Products = Products::factory($data, 'Property');

			if (is_array($data['items'])) {
				foreach($data['items'] as $i=>$item) {
					$item['property_group'] = $item['title'];
					$item['deductible'] = $item['value'];
					$item['risks'] = $data['risks_id'];
					$item['params'] = $values_id;
					$item['terms_id'] = $data['terms_id'];

                    switch ($this->subMode) {
                        case 'calculate':
                            $result = $Products->calculate($item);
                            $data['items'][$i]['rate'] = $result['rate'];
                            $data['items'][$i]['amount'] = $result['amount'];
                            break;
                    }
				}
			}
		}

        return parent::setConstants($data);
    }

    function checkFields(&$data, $action) {
        global $db, $Log, $Authorization;

        parent::checkFields($data, $action);

        //проверяем застрахован ли риск пожар у физика
        if ($data['insurer_person_types_id'] == 1 && !in_array(44, $data['risks_id'])) {
            $Log->add('error', 'Ризик "Пожежа" обов\'язковий для страхування.');
        }
		
		if ($data['financial_institutions_id']==19 && $data['insurer_person_types_id'] == 1)
		{
			if (!in_array(44, $data['risks_id']) || !in_array(45, $data['risks_id']) || !in_array(46, $data['risks_id']) || !in_array(47, $data['risks_id']) || !in_array(48, $data['risks_id']))
				$Log->add('error', 'Усi ризики обов\'язковi для страхування.');
		}

		if (is_array($data['items'])) {
			foreach ($data['items'] as $item) {
                if ($item['title'] == '') {
                    $params = array('Майно, назва', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                }
                if ($item['storage'] == '' && $data['insurer_person_types_id']!=1) {
                    $params = array('Майно, місце зберігання/адреса', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                }
                if ($item['cost'] == '' && $data['insurer_person_types_id']!=1) {
                    $params = array('Майно, вартість, грн.', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidMoney($item['cost']) && $data['insurer_person_types_id']!=1) {
					$params = array('Майно, вартість, грн.', null);
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
				}
                if ($item['quantity'] == '' && $data['insurer_person_types_id']!=1) {
                    $params = array('Майно, кількість, шт./площа, м<sup>2</sup>', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidInteger($item['quantity']) && $data['insurer_person_types_id']!=1) {
					$params = array('Майно, кількість, шт./площа, м<sup>2</sup>', null);
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
				}
                if ($item['price'] == '') {
                    $params = array('Майно, cтрахова вартість, грн.', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidMoney($item['price'])) {
					$params = array('Майно, cтрахова вартість, грн.', null);
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
				}

				if ($item['value'] == '') {
					$params = array('Майно, франшиза', null);
					$Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
				} elseif ((!$this->isValidPercent($item['value']) && !$item['absolute']) || (!$this->isValidMoney($item['value']) && $item['absolute'])) {
					$params = array('Майно, франшиза', null);
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
				}
				
                if ($item['rate'] == '') {
                    $params = array('Майно, тариф, %', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($item['rate'])) {
					$params = array('Майно, тариф, %', null);
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
				}
                if ($item['amount'] == '') {
                    $params = array('Майно, премія, грн.', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidMoney($item['amount'])) {
					$params = array('Майно, премія, грн.', null);
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
				}
			}
		}

		//проверка потерь за последние 5 лет
		if (is_array($data['loses'])) {
			foreach ($data['loses'] as $loses) {
				if (!checkdate(substr($loses['date'], 3, 2), substr($loses['date'], 0, 2), substr($loses['date'], 6, 4))) {
                    $params = array('Дані про збитки за останні 5 (п\'ять) років, дата', null);
					$Log->add('error', 'The date <b>%s</b>%s is not valid.', $params);
				} 

                if ($loses['amount'] == '') {
                    $params = array('Дані про збитки за останні 5 (п\'ять) років, сума, грн.', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidMoney($loses['amount'])) {
                    $params = array('Дані про збитки за останні 5 (п\'ять) років, сума, грн.', null);
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
				}
			}
		}
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;
		
		$sql = 'SELECT id FROM ' . PREFIX . '_policies_property_objects WHERE policies_id = ' . intval($data['policies_id']);
		if ($db->getOne($sql) > 0) {
			$Log->add('error', 'Додавання нових об\'єктів заборонено.');
			header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Policies|' . $this->mode . 'Objects&id=' . $data['policies_id'] . '&policies_id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
			exit;
		}

		$data['id'] = parent::insert(&$data, false, false);

		$Policies_Property = new Policies_Property($data);

		if (intval($data['id'])) {

			$this->setAdditionalFields($data['id'], $data);

			$Policies_Property->generateDocuments($data['policies_id']);

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Policies|' . $this->mode . 'Objects&id=' . $data['policies_id'] . '&policies_id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
		} else {
			$Policies_Property->addObject($data);
		}
    }

	function view($data, $conditions=null, $sql=null, $template=null, $showForm=true) {
		$data['step'] = 2;

		$Policies_Property = new Policies_Property($data);

		if (!$_POST['InWindow'] && $data['mode'] != 'simple') {
            $Policies_Property->header($data);
        }

        if (is_array($data['id'])) {
			$data['id'] = $data['id'][0];
		}

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_policies_property_objects ' .
				'WHERE id = ' . intval($data['id']);

        parent::view($data,$conditions , $sql , $template , $showForm );

        if (!$_POST['InWindow'] && $data['mode'] != 'simple') {
            $Policies_Property->footer($data);
        }
	}


    function prepareFields($action, &$data) {
        global $db;

		if (is_array($data['id'])) {
            $data['id']=$data['id'][0];
		}

		$data['items'] = $db->getAll('SELECT * FROM '.PREFIX.'_policies_property_objects_items WHERE objects_id='.intval($data['id']));
		$data['loses'] = $db->getAll('SELECT *,date_format(date, ' . $db->quote(DATE_FORMAT) . ') AS date FROM '.PREFIX.'_policies_property_objects_loses WHERE objects_id='.intval($data['id']));

		$data = parent::prepareFields($action, $data);

		if (is_array($data['items'])) {
            foreach ($data['items'] as $i => $item) {
				$data['items'][ $i ]['amount'] = round($item['price'] * $item['rate'] / 100, 2);

				$data['price']	+= $data['items'][ $i ]['price'];
                $data['amount']	+= $data['items'][ $i ]['amount'];
            }
        }

		$data['rate'] = round($data['amount'] / $data['price'] * 100, 3);

        return $data;
    }
	
	function setAdditionalFields($id, $data) {
		global $db;

		$this->updateItems($id, $data['items']);

		//пересчитать показатели по полису в целом
		$policies = $db->getRow('SELECT parent_id,begin_datetime FROM '.PREFIX.'_policies WHERE id='.intval($data['policies_id']));
		$data['items'] = $db->getAll('SELECT a.* FROM '.PREFIX.'_policies_property_objects_items a JOIN '.PREFIX.'_policies_property_objects b ON a.objects_id=b.id WHERE b.policies_id='.intval($data['policies_id']));

		if (is_array($data['items'])) {
            foreach ($data['items'] as $i => $item) {
				$data['items'][ $i ]['amount'] = round($item['price'] * $item['rate'] / 100, 2);

				$data['price']	+= $data['items'][ $i ]['price'];
                $data['amount']	+= $data['items'][ $i ]['amount'];
            }
        }

		$data['rate'] = round($data['amount'] / $data['price'] * 100, 3);

		$data['amount_parent'] = 0;
		if (intval($policies['parent_id'])) {
			$Policies_Property = new Policies_Property($data);
			$data['amount_parent'] = $Policies_Property->calculateamount_parent($policies['parent_id'], $policies['begin_datetime']);
		}

		$data['amount'] = $data['amount'] - $data['amount_parent'];

		if($data['amount'] < 0) $data['amount'] = 0;

		$sql =	'UPDATE ' . PREFIX . '_policies SET ' .
				'price = ' . doubleval($data['price']) . ', ' .
				'rate = ' . doubleval($data['rate']) . ', ' .
				'amount = ' . doubleval($data['amount']) . ' ' .
				'WHERE id='.intval($data['policies_id']);
		$db->query($sql);

		$sql =	'DELETE ' .
				'FROM ' . PREFIX . '_policies_property_objects_loses ' .
				'WHERE objects_id = ' . intval($id);
		$db->query($sql);

		if (is_array($data['loses']) && intval($data['last5_loses'])>0) {
			foreach ($data['loses'] as $i => $item) {
				$sql =	'INSERT INTO ' . PREFIX . '_policies_property_objects_loses SET ' .
						'objects_id = ' . intval($id) . ', ' .
						'date = ' . $db->quote(substr($item['date'], 6, 4) . '-' . substr($item['date'], 3, 2) . '-' . substr($item['date'], 0, 2)) . ', ' .
						'text = ' . $db->quote($item['text']) . ', ' .
						'amount = ' . $db->quote($item['amount']) . ' ' ;
				$db->query($sql);
			}
		}

        if ($data['insurer_person_types_id']==1) { //генерим авто календарь для физ лиц
            if (!$data['skipCalendar'] && !$data['dontRecalcRate']) {

                $PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
                $PolicyPaymentsCalendar->updateCalendar($data['policies_id'],true);

                Policies::setPaymentStatus($id);
            }
        }
	}
    
	function updateItems($id, $items) {
		global $db;

		$sql =	'DELETE ' .
				'FROM ' . PREFIX . '_policies_property_objects_items ' .
				'WHERE objects_id = ' . intval($id);
		$db->query($sql);

		if (is_array($items)) {
			foreach ($items as $i => $item) {
				$sql =	'INSERT INTO ' . PREFIX . '_policies_property_objects_items SET ' .
						'objects_id = ' . intval($id) . ', ' .
						'title = ' . $db->quote($item['title']) . ', ' .
						'storage = ' . $db->quote($item['storage']) . ', ' .
						'cost = ' . $db->quote($item['cost']) . ', ' .
						'quantity = ' . $db->quote($item['quantity']) . ', ' .
						'amount = ' . $db->quote($item['amount']) . ', ' .
						'rate = ' . $db->quote($item['rate']) . ', ' .
						'value = ' . $db->quote($item['value']) . ', ' .
						'absolute = ' . intval($item['absolute']). ', ' .
						'price = ' . $db->quote($item['price']);
				$db->query($sql);
			}
		}
	}

	function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization;

		$Policies_Property = new Policies_Property($data);

		if (parent::update(&$data, false, false)) {

			$this->setAdditionalFields($data['id'], $data);

			$Policies_Property->generateDocuments($data['policies_id']);

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Policies|' . $this->mode . 'Objects&id=' . $data['policies_id'] . '&policies_id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
		} else {
			$Policies_Property->updateObject($data);
		}
    }

	function getListValue($field, $data) {
        global $db;

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

    function buildSelect($field, $value, $languageCode=null, $addition=null, $indexType=null, $data=null, $class=null) {
        if ($data['types_id']) {

            $list = $field['list']; 
            $field['list'] = array();

            foreach($list as $i=>$row) {
                if ($row['types_id']==$data['types_id']) {
                    $field['list'][$i] = $row;
				}
            }

            $field['name'] .= $data['types_id'];
        }

        return parent::buildSelect($field, $value, $languageCode, $addition, $indexType, $data, $class);
    }

	function getFieldPart($data, $action, $position, $languageCode=null, $languageDescription=null) {
        global $Authorization;

        $field = $this->formDescription['fields'][ $position ];

        $mark = (!$field['verification']['canBeEmpty']) ? '*' : '';

		if ($field['type']==fldMultipleSelect) {
			$additional='';
			switch ($action) {
				case 'print':
					$result .= '<div class="label grey">' . translate($field['description']).$languageDescription . ':</div>' . (is_array($field['list'][$data[$field['name'].$languageCode]])) ? $field['list'][$data[$field['name'].$languageCode]]['title'] : $field['list'][$data[$field['name'].$languageCode]];
					break;
				case 'view':
					  $additional='style="color: #666666; background-color: #f5f5f5;" disabled';
				default:
					$size = (sizeOf($field['list']) < intval($field['size'])) ? sizeOf($field['list']) + 1 : (($field['size']) ? $field['size'] : 10);
					$result .= '<tr><td class="label grey">' . $mark.translate($field['description']).$languageDescription . ':</td><td>' . $this->buildSelect($field, $data[$field['name'].$languageCode], $languageCode, $additional.' multiple size="' . $size . '"', $field['indexType'], $data) . '</td></tr>';
					break;
			}

			return $result;
		} else {
			return parent::getFieldPart($data, $action, $position, $languageCode, $languageDescription);
		}
    }
}

?>