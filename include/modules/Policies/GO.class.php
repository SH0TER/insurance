<?
/*
 * Title: policy GO class
 *
 * @author 
 * @email 
 * @version 3.0
 */

require_once 'PolicyBlanks.class.php';
require_once 'WebServices/MTSBU.class.php';

class Policies_GO extends Policies {

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
                            'orderPosition'     => 13,
                            'table'             => 'policies',
                            'sourceTable'       => 'agencies',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'agents_id',
                            'description'       => 'Агент',
                            'type'              => fldSelect,
                            'condition'         => 'roles_id = 8',
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
                            'orderPosition'     => 14,
                            'table'             => 'policies',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'cons_agents_id',
                            'description'       => 'Агент консультация',
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
                            'table'             => 'policies'
                         ), 
                         array(
                            'name'              => 'limit_property',
                            'description'       => 'Вiдповiдальнiсть майно',
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
                            'table'             => 'policies_go'
                         ), 
                          array(
                            'name'              => 'limit_life',
                            'description'       => 'Вiдповiдальнiсть життя',
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
                            'table'             => 'policies_go'
                         ),
                          array(
                            'name'              => 'seller_agencies_id',
                            'description'       => 'Агенція продавець',
                            'type'              => fldHidden,
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
                            'table'             => 'policies'
                        ),  
                         array(
                            'name'              => 'seller_agents_id',
                            'description'       => 'Агент продавець',
                            'type'              => fldHidden,
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
                            'table'             => 'policies'
                        ),                       
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
                            'name'              => 'solutions_id',
                            'description'       => 'solutions_id',
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
                            'maxlenght'         => 14,
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
                            'description'       => 'Дата',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false,
                                ),
                            'orderPosition'     => 3,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'item',
                            'description'       => 'Об\'єкт',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'orderPosition'     => 5,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'person_types_id',
                            'description'       => 'Тип особи',
                            'type'              => fldRadio,
                            'showId'            => true,
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'no_resident',
                            'description'       => 'Ознака, не резидент',
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
                            'table'             => 'policies'),
                        array(
                            'name'              => 'car_types_id',
                            'description'       => 'Тип ТЗ',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_go',
                            'condition'         => 'product_types_id = 4',
                            'sourceTable'       => 'car_types',
                            'selectField'       => 'CONCAT(code,\' - \',title)',
                            'orderField'        => 'order_position'),
                        
                        array(
                            'name'              => 'financial_products_id',
                            'description'       => 'Кред Продукт',
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
                            'table'                => 'policies_go'),
                            
                        array(
                            'name'              => 'brands_id',
                            'description'       => 'Марка',
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
                            'table'                => 'policies_go'),
                            
                            
                            
                        array(
                            'name'              => 'brand',
                            'description'       => 'Марка',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'models_id',
                            'description'       => 'Модель',
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'model',
                            'description'       => 'Модель',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'year',
                            'description'       => 'Рік випуску',
                            'type'              => fldInteger,
                            'maxlength'         => 4,
                            'validationRule'    => '^(19|20)[0-9]{2}$',
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'taxi',
                            'description'       => 'Таксi',
                            'type'              => fldInteger,
                            'list'                => array(
                                                        0 => 'в особистих цілях',
                                                        2 => 'з метою отримання прибутку',
                                                        1 => 'в якості таксі'),
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'stage3',
                            'description'       => 'Стаж бiльше 3-х рокiв',
                            'type'              => fldRadio,
                            'list'                => array(
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'otk',
                            'description'       => 'ОТК',
                            'type'              => fldRadio,
                            'list'                => array(
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
                            'table'             => 'policies_go'),  
                        array(
                            'name'              => 'otknumber',
                            'description'       => 'визнаний технічно справним згідно з',
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

                            'table'             => 'policies_go'),
                          array(
                            'name'              => 'otkdate',
                            'description'       => 'Дата наступного ОТК',
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'special',
                            'description'       => 'Акція',
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'deductible',
                            'description'       => 'Франшиза, грн.',
                            'type'              => fldRadio,
                            'list'              => array(
                                                    '510.00' => '510.00','0.00' => '0.00'),
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'types_id',
                            'description'       => 'Договір',
                            'type'              => fldRadio,
                            'showId'            => true,
                            'list'              => array(
                                                        1 => 'Тип 1',
                                                        2 => 'Тип 2',
                                                        3 => 'Тип 3'),
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'privileges',
                            'description'       => 'Пільги',
                            'type'              => fldSelect,
                            'showId'            => true,
                            'list'              => array(
                                                    0 => 'Без пільг',
                                                    1 => 'Учасники війни, що визначені законом',
                                                    2 => 'Інваліди II групи',
                                                    3 => 'Особи, які постраждали внаслідок Чорнобильськ.',
                                                    4 => 'Пенсіонери громадяни України'),
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'certificate_series',
                            'description'       => 'Посвідчення, серія',
                            'type'              => fldText,
                            'maxlength'         => 3,
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'outside_client',
                            'description'       => 'сторонiй клiєнт',
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'certificate_number',
                            'description'       => 'Посвідчення, номер',
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'certificate_place',
                            'description'       => 'Посвідчення, ким і де виданий',
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'certificate_date',
                            'description'       => 'Посвідчення, дата видачі',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_go'),
/*
                        array(
                            'name'              => 'drivers_id',
                            'description'       => 'Кількість осіб',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_go',
                            'sourceTable'       => 'parameters_drivers',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
*/
                        array(
                            'name'              => 'regions_id',
                            'description'       => 'Зона переважного використання автомобілю',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_go',
                            'condition'         => 'product_types_id = 4',
                            'sourceTable'       => 'parameters_regions',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'registration_cities_id',
                            'description'       => 'Місце реєстрації',
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
                            'table'             => 'policies_go'),
/*
                        array(
                            'name'              => 'registration_cities_title',
                            'description'       => 'Місце реєстрації',
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
                            'table'             => 'policies_kasko'),
*/
                        array(
                            'name'              => 'registration_cities_title',
                            'description'       => 'Місце реєстрації',
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'driver_standings_id',
                            'description'       => 'Стаж водія',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_go',
                            'sourceTable'       => 'parameters_driver_standings',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'engine_size',
                            'description'        => 'Об\'єм двигуна, см<sup>3</sup>',
                            'type'                => fldInteger,
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'car_weight',
                            'description'        => 'Вантажопiд\'ємність, кг',
                            'type'                => fldInteger,
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'passengers',
                            'description'        => 'Кiлькiсть пасажирiв',
                            'type'                => fldInteger,
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'engine_sizes_id',
                            'description'        => 'Тип автомобіля',
                            'type'                => fldSelect,
                            'showId'              => true,
                            'condition'            => 'product_types_id = 4',
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
                            'table'                => 'policies_go',
                            'sourceTable'        => 'parameters_engine_sizes',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'passengers_id',
                            'description'        => 'Кiлькість мiсць',
                            'type'                => fldSelect,
                            'showId'               => true,
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
                            'table'                => 'policies_go',
                            'sourceTable'        => 'parameters_passengers',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'car_weights_id',
                            'description'        => 'Вантажопiд\'ємність, кг',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_go',
                            'sourceTable'        => 'parameters_car_weights',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'terms_id',
                            'description'        => 'Термін страхування',
                            'type'                => fldSelect,
                            'showId'               => true,
                            'condition'            => 'product_types_id = 4',
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
                            'table'                => 'policies_go',
                            'sourceTable'        => 'parameters_terms',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'bonus_malus_id',
                            'description'        => 'Бонус-малус',
                            'type'                => fldSelect,
                            'showId'               => true,
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
                            'table'                => 'policies_go',
                            'sourceTable'        => 'parameters_bonus_malus',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'policies_general_id',
                            'description'        => 'Генеральний договір',
                            'condition'         => 'product_types_id = 14',
                            'type'                => fldSelect,
                            'showId'               => true,
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
                            'table'                => 'policies_go',
                            'sourceTable'        => 'policies',
                            'selectField'        => 'CONCAT(insurer, \' / \', number)',
                            'orderField'        => 'insurer, number'),
                        array(
                            'name'                => 'products_id',
                            'description'        => 'Продукт',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                     'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_go'),
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
                            'name'                => 'amount_parent',
                            'description'        => 'Залишок від сплаченної страхової премії, грн.',
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
                            'table'                => 'policies'),
                        array(
                            'name'                => 'amount_go',
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
                            'table'                => 'policies_go'),
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
                            'maxlength'            => 150,
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
                            'table'                => 'policies_go'),
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
                            'table'                => 'policies_go'),
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'insurer_identification_code',
                            'description'        => 'ІПН',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'validationRule'    => '^[0-9А-Я]{10}$',
                            //'validationFunction'=> 'checkIdentificationCode',
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'insurer_edrpou',
                            'description'        => 'ЄДРПОУ',
                            'type'                => fldText,
                            'maxlength'            => 10,
                            'validationRule'    => '^[0-9]{8}$',
                            'validationFunction' => 'checkEDRPOUCode',
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
                            'table'                => 'policies_go'),
                        array(
                            'name'              => 'insurer_passport_series',
                            'description'       => 'Страхувальник, паспорт, серія',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'                => 'policies_go'),
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'insurer_zip',
                            'description'        => 'Індекс',
                            'type'                => fldText,
                            'validationRule'    => '^[0-9]{5}$',
                            'maxlength'            => 5,
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
                            'table'                => 'policies_go'),
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
                            'table'                => 'policies_go',
                            'sourceTable'        => 'regions',
                            'selectField'        => 'title',
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
                            'table'             => 'policies_go'),
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
                            'table'                => 'policies_go'),
                        array(
                            'name'              => 'insurer_street_types_id',
                            'description'       => 'Тип вулицi',
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
                            'table'             => 'policies_go',
                            'sourceTable'       => 'street_types',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'insurer_house',
                            'description'        => 'Будинок',
                            'type'                => fldText,
                            'maxlength'            => 12,
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'insurer_flat',
                            'description'        => 'Квартира',
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'insurer_driver_licence_series',
                            'description'        => 'Водійські права, серія',
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'insurer_driver_licence_number',
                            'description'        => 'Водійські права, номер',
                            'type'                => fldText,
                            'maxlength'            => 9,
                            'validationRule'    => '(^[0-9]{6}$)|(^[0-9]{9}$)',
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'insurer_driver_licence_date',
                            'description'        => 'Водійські права, дата',
                            'type'                => fldDate,
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'shassi',
                            'description'        => '№ шасі (кузов, рама)',
                            'type'                => fldText,
                            'maxlength'            => 20,
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'sign',
                            'description'        => 'Державний знак (реєстраційний №)',
                            'type'                => fldText,
                            'validationFunction'        => 'isValidSign',
                            'validationFunctionType'    => 'function',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'begin_datetime',
                            'description'        => 'Початок',
                            'type'                => fldDateTime,
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
                            'name'              => 'comment_quote',
                            'description'       => 'Коментар андерайтера',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_go'
                        ),  
                        array(
                            'name'                => 'comment',
                            'description'        => 'Примітка',
                            'type'                => fldText,
                            'maxlength'            => 255,
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'blank_series',
                            'description'        => 'Серія поліса',
                            'type'                => fldText,
                            'maxlength'            => 2,
                            'validationRule'    => '^(ВА|ВВ|ВС|ВЕ|АА|АВ|АЕ|АС|АІ|АК)$',
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'blank_number',
                            'description'        => 'Номер поліса',
                            'type'                => fldText,
                            'maxlength'            => 7,
                            'validationRule'    => '^[0-9]{7}$',
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
                            'table'                => 'policies_go'),
                            
                        array(
                            'name'                => 'blank_series_parent',
                            'description'        => 'Серія поліса основания',
                            'type'                => fldText,
                            'maxlength'            => 2,
                            //'validationRule'    => '^(ВА|ВВ|ВС|ВЕ|АА)$',
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'blank_number_parent',
                            'description'        => 'Номер поліса основания',
                            'type'                => fldText,
                            'maxlength'            => 7,
                            'validationRule'    => '^[0-9]{7}$',
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'stiker_series',
                            'description'        => 'Серія стікера',
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'stiker_number',
                            'description'        => 'Номер стікера',
                            'type'                => fldText,
                            'validationRule'    => '^[0-9]{6,7}$',
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
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'certificate',
                            'description'        => 'Номер сертифікату',
                            'type'                => fldText,
//                            'validationRule'    => '^[0-9]{5}$',
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
                            'table'                => 'policies'),
                        array(
                            'name'                => 'payment_datetime',
                            'description'        => 'Дата та час сплати',
                            'type'                => fldDateTime,
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
                            'name'                => 'payment_number',
                            'description'        => 'Номер квитанції',
                            'type'                => fldText,
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
                            'table'                => 'policies'),
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
                            'name'                => 'next_policy_statuses_id',
                            'description'        => 'Кінцевий статус',
                            'type'                => fldInteger,
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
                            'table'                => 'policies'),
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
                            'orderPosition'     => 18,
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
                            'orderPosition'     => 19,
                            'table'             => 'policies'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
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
                            'table'             => 'policies_go'),
                            
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
                            'table'             => 'policies_go'),

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
                            'table'             => 'policies_go'),  
                            
                        array(
                            'name'              => 'commission_financial_institution_percent',
                            'description'       => 'Комісія, банк, %',
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
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'axapta_car',
                            'description'       => 'Нове авто мережi Укравто',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_go'),
                            
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
                            'orderPosition'        => 20,
                            'width'             => 100,
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
                            'orderPosition'        => 21,
                            'width'             => 100,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'k1',
                            'description'        => 'K1',
                            'type'                => fldHidden,
                            'maxlength'            => 5,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'k2',
                            'description'        => 'K2',
                            'type'                => fldHidden,
                            'maxlength'            => 5,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'k3',
                            'description'        => 'K3',
                            'type'                => fldHidden,
                            'maxlength'            => 5,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'k4',
                            'description'        => 'K4',
                            'type'                => fldHidden,
                            'maxlength'            => 5,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'k5',
                            'description'        => 'K5',
                            'type'                => fldHidden,
                            'maxlength'            => 5,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'k6',
                            'description'        => 'K6',
                            'type'                => fldHidden,
                            'maxlength'            => 5,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'k7',
                            'description'        => 'K7',
                            'type'                => fldHidden,
                            'maxlength'            => 5,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_go'),
                        array(
                            'name'                => 'k_car_numbers',
                            'description'        => 'К кiлькiсть',
                            'type'                => fldHidden,
                            'maxlength'            => 5,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_go'),   
                        array(
                            'name'              => 'bonus_malus',
                            'description'       => 'Бонус-малус',
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
                            'table'             => 'policies'),
                        array(
                            'name'              => 'max_bonus_malus',
                            'description'       => 'Максимальний Бонус-малус',
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
                            'table'             => 'policies'),     
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
                            'table'             => 'policies_go'),  
                            
                        array(
                            'name'              => 'card_assistance',
                            'description'       => 'Номер картки Експрес Асістанс',
                            'type'              => fldText,
                            'maxlength'         => 4,
                            'validationRule'    => '^[0-9]{4}$',
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
                            'table'             => 'policies_go'),  
                         array(
                            'name'              => 'manager_id',
                            'description'       => 'Менеджер що привiв клiєнта',
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
                            'table'             => 'policies',
                            'sourceTable'       => 'accounts'), 
                        array(
                            'name'              => 'motivation_manager_percent',
                            'description'       => '% КВ для МП',
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
                            'orderPosition'     => 22,
                            'table'             => 'policies')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    => 21,
                        'defaultOrderDirection'    => 'desc',
                        'titleField'            => 'number'
                    )
                );

    function Policies_GO($data) {
        global $db, $Authorization;

        Policies::Policies($data);
        $this->objectTitle = 'Policies_GO';

        $this->messages['plural'] = 'Поліси ОСЦПВ';
        $this->messages['single'] = 'Поліс ОСЦПВ';

        if (is_array($data['id'])) {
            $id = $data['id'][0];
        } else {
            $id = $data['id'];
        }

        if (intval($id)) {
            $row = $db->getRow('SELECT a.next_policy_statuses_id,b.bonus_malus_id FROM ' . PREFIX . '_policies a JOIN ' . PREFIX . '_policies_go b on b.policies_id=a.id WHERE id = ' . intval($id));
            $data = array_merge($data, $row);
        }
        
        if (!ereg($data['do'],'view$')) {
            if (($Authorization->data['agencies_id'] == 1492) && $Authorization->data['roles_id'] == ROLES_AGENT) {//Зіп-Авто
                $this->formDescription['fields'][ $this->getFieldPositionByName('bonus_malus_id') ]['condition'] = ' id <= 7 ';
            }
            elseif ($Authorization->data['agencies_id'] != 556 && $Authorization->data['agencies_id'] != 560 && $Authorization->data['roles_id'] == ROLES_AGENT) {
                $this->formDescription['fields'][ $this->getFieldPositionByName('bonus_malus_id') ]['condition'] = 'id IN (5,'.intval($data['bonus_malus_id']).')';
                $this->formDescription['fields'][ $this->getFieldPositionByName('policies_general_id') ]['condition'] = 'id = 0';
            } elseif (($Authorization->data['agencies_id'] == 556 || $Authorization->data['agencies_id'] == 560) && $Authorization->data['roles_id'] == ROLES_AGENT) {//раевская
                $this->formDescription['fields'][ $this->getFieldPositionByName('bonus_malus_id') ]['condition'] = ' id <= 9 ';
            }
        }
        $this->setPolicyStatusesSchema(null,&$data);
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'                  => true,
                    'insert'                => true,
                    'update'                => true,
                    'view'                  => true,
                    'change'                => false,
                    'export'                => true,
                    'exportActions'         => true,
                    'payments'              => true,
                    'delete'                => true,
                    'reset'                 => true,
                    'changeServicePerson'   => true,
                    'spoilPolicy'           => true,
                    'copyPolicy'            => false,
                    'renewPolicy'           => false,
                    'continuePolicy'        => false,
                    'transfer'              => true,
                    'cancelPolicy'          => true,
                    'importMTSBU'           => true);
                break;
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                $this->permissions['change'] = false;
                if ($Authorization->data['id'] == 3371 || 14117) {
                    $this->permissions['importMTSBU'] = true;
                }
                break;              
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'                  => true,
                    'insert'                => true,
                    'update'                => true,
                    'view'                  => true,
                    'change'                => false,
                    'delete'                => false,
                    'changeServicePerson'   => true,
                    'spoilPolicy'           => true,
                    'copyPolicy'            => true,
                    'copy'                  => false,
                    'renewPolicy'           => true,
                    'continuePolicy'        => true,
                    'cancelPolicy'          => false);

                $this->formDescription['fields'][ $this->getFieldPositionByName('documents') ]['display']['change'] = false;
                $this->formDescription['fields'][ $this->getFieldPositionByName('commission') ]['display']['change'] = false;
                break;
        }
    }

    function checkPoliciesInMTSBU($ids) {
        global $db;

        $sql =  "SELECT CONCAT(a.blank_series, '-', a.blank_number) as number ".
                "FROM insurance_policies_go a ".
                "INNER JOIN insurance_policy_blanks b on a.blank_series = b.series AND a.blank_number = b.number ".
                "WHERE b.mtsbu_date > '0000-00-00 00:00:00' AND a.policies_id IN (" . implode(",", $ids) . ")";

        $result = $db->getCol($sql);

        if(sizeof($result) > 0)
            return $result;
        else
            return false;

    }

    function delete($data) {
        $this->checkPermissionsBooleanResult("delete");

        if(intval($data['mtsbuChecked']) === 0 && $mtsbu = $this->checkPoliciesInMTSBU($data['id'])) {
            include_once $this->object . '/GO_MTSBU_ERROR.php';
            return;
        }

        parent::delete($data);

    }

    //схема смены статусов для сертификатов
    function setPolicyStatusesSchema($roles_id =null,$data=null) {
        global $Authorization, $POLICY_STATUSES_SCHEMA;

        $POLICY_STATUSES_SCHEMA = array(
            POLICY_STATUSES_CONSULTATION => 
                        array(
                            POLICY_STATUSES_CONSULTATION,
                            $Authorization->data['ankets']==1 || $Authorization->data['roles_id'] != ROLES_AGENT  || $Authorization->data['agencies_id']==1492 ? POLICY_STATUSES_CREATED : 0 ,
                            $Authorization->data['agencies_id']==1492 ? 19 : 0 
                            ),      
            POLICY_STATUSES_CREATED =>
                array(
                    POLICY_STATUSES_CREATED,
                    (intval($data['next_policy_statuses_id']) ? $data['next_policy_statuses_id']:POLICY_STATUSES_GENERATED),
                    $Authorization->data['agencies_id']==1492 ? 19 : 0 
                    ),
            POLICY_STATUSES_GENERATED =>
                array(
                    POLICY_STATUSES_GENERATED),
            POLICY_STATUSES_CANCELLED =>
                array(
                    POLICY_STATUSES_CANCELLED),
            POLICY_STATUSES_COPY =>
                array(
                    POLICY_STATUSES_COPY),
            POLICY_STATUSES_CONTINUED =>
                array(
                    POLICY_STATUSES_CONTINUED),
            POLICY_STATUSES_RENEW =>
                array(
                    POLICY_STATUSES_RENEW),
            POLICY_STATUSES_DISSOLVED =>
                array(
                    POLICY_STATUSES_DISSOLVED),
            POLICY_STATUSES_SPOILT =>
                array(
                    POLICY_STATUSES_SPOILT) ,
            19 =>
                array(
                    19) 
                    
        );
    }

    //формирование выпадающего списка
    function buildSelect($field, $value, $languageCode=null, $addition=null, $indexType=null, $data=null, $class=null) {
        global $db;

        $result = '';

        if  ($field['name'] == 'registration_cities_id') {

            $conditions[] = 'product_types_id = ' . PRODUCT_TYPES_GO;

            $sql =  'SELECT a.title, b.id as cities_id, b.title as cities_title ' .
                    'FROM ' . PREFIX . '_parameters_regions as a ' .
                    'JOIN ' . PREFIX . '_cities as b ON a.id = b.regions_go_id ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' ' .
                    'ORDER BY a.order_position, b.title';
            $list = $db->getAll($sql, 300);

            if (is_array($list)) {
                $result .= '<select id="' . ereg_replace('\[|\]', '', $field['name'] . $languageCode) . '" name="' . $field['name'] . $languageCode . '" ' . $addition . ' ' . $field['javascript'] . ' class="fldSelect ' . $class . '" onfocus="this.className=\'fldSelectOver ' . $class . '\'" onblur="this.className=\'fldSelect ' . $class . '\'">';

                foreach ($list as $i => $row) {

                    if ($row['title'] != $title) {
                        $result .= '<optgroup label="' . $row['title'] . '">';
                        $title = $row['title'];
                    }

                    $result .= '<option value="' . $row['cities_id'] . '" ' . (($row['cities_id'] == $value) ? 'selected' : '')  . '>' . $row['cities_title'] . '</option>';

                    if ($i + 1 == sizeOf($list) || $list[ $i + 1 ]['title'] != $title) {
                        $result .= '</optgroup label="' . $row['title'] . '">';
                    }
                }
                $result .= '</select>';
            }
        } else {
            $result = parent::buildSelect($field, $value, $languageCode, $addition, $indexType, $data, $class);
            if  ($field['name'] == 'sign_agents_id') {
                $result = str_replace ( '...' , 'директор підприємства' , $result );
            }
        }

        return $result;
    }

    function setConstants(&$data) {
        global $Authorization;

        parent::setConstants($data);
        $e_date = null;
        
        
        switch ($data['terms_id']) {
            case 13:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month'], $data['begin_datetime_day']+14, $data['begin_datetime_year']);
                break;
            case 14:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+1, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 15:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+2, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 16:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+3, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 17:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+4, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 18:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+5, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 19:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+6, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 20:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+7, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 21:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+8, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 22:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+9, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 23:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+10, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 24:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+11, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
            case 25:
                $e_date = mktime (0, 0, 0, $data['begin_datetime_month']+12, $data['begin_datetime_day']-1, $data['begin_datetime_year']);
                break;
        }
        
        if ($e_date) {
            $data['end_datetime_month']  = date ( 'm', $e_date);
            $data['end_datetime_day']  = date ( 'd', $e_date);
            $data['end_datetime_year']  = date ( 'Y', $e_date);
        }

        $data['shassi'] = fixShassiSimbols($data['shassi']);

        if ($data['registration_cities_id'] == 284) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('sign') ]['validationFunctionType'] = null;
            $this->formDescription['fields'][ $this->getFieldPositionByName('sign') ]['validationFunction'] = null;
            } else {
                    $data['sign']   = fixSignSimbols($data['sign']);
            }
        //$data['sign'] = fixSignSimbols($data['sign']);

        if (intval($data['types_id']) == 2) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('engine_size') ]['verification']['canBeEmpty'] = true;
        }
        
        if ($data['cons_agents_id']>0) $data['manager_id'] = $data['cons_agents_id'];
        

        if (intval($data['person_types_id']) == 1) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_edrpou') ]['verification']['canBeEmpty'] = true;
            if (intval($data['no_resident'])) {
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_identification_code') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_series') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_number') ]['verification']['canBeEmpty'] = true;
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_number') ]['validationRule']);
                
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_place') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_date') ]['verification']['canBeEmpty'] = true;

                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_number') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_place') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_date') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_reestr') ]['verification']['canBeEmpty'] = true;
                $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_dateEnd') ]['verification']['canBeEmpty'] = true;
            }
        } else {
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_identification_code') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_series') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_dateofbirth') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_place') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_date') ]['verification']['canBeEmpty'] = true;

            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_place') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_date') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_reestr') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_dateEnd') ]['verification']['canBeEmpty'] = true;

            if (intval($data['policies_general_id']) > 0) {
                //$data['bonus_malus_id'] = 5;
            }
        }

        $unsetFields = array();

        if (intval($data['types_id']) == 1 || intval($data['person_types_id']) == 2 || intval($data['no_resident'])) {
            $unsetFields = array(
                'insurer_driver_licence_series',
                'insurer_driver_licence_number',
                'insurer_driver_licence_date',
                'insurer_driver_licence_date_year',
                'insurer_driver_licence_date_month',
                'insurer_driver_licence_date_day');

            if (intval($data['person_types_id']) == 2) {
                $unsetFields[] = 'insurer_firstname';
                $unsetFields[] = 'insurer_patronymicname';
            }
        }

        switch ($data['car_types_id']) {
            case '2':
            case '5':
                $unsetFields[] = 'engine_size';
                $unsetFields[] = 'car_weight';
                $unsetFields[] = 'passengers';
                break;
            case '3':
                $unsetFields[] = 'engine_size';
                $unsetFields[] = 'car_weight';
                break;
            case '4':
                $unsetFields[] = 'engine_size';
                $unsetFields[] = 'passengers';
                break;
            default:
                $unsetFields[] = 'car_weight';
                $unsetFields[] = 'passengers';
        }

        if (is_array($unsetFields)) {
            foreach($unsetFields as $field) {
                $data[ $field ] = '';
                $this->formDescription['fields'][ $this->getFieldPositionByName($field) ]['verification']['canBeEmpty'] = true;
            }
        }
    
        if ($data['privileges']) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('certificate_series') ]['verification']['canBeEmpty'] = false;
            $this->formDescription['fields'][ $this->getFieldPositionByName('certificate_number') ]['verification']['canBeEmpty'] = false;
            $this->formDescription['fields'][ $this->getFieldPositionByName('certificate_place') ]['verification']['canBeEmpty'] = false;
            $this->formDescription['fields'][ $this->getFieldPositionByName('certificate_date') ]['verification']['canBeEmpty'] = false;
        } else {
            $data['certificate_series'] = '';
            $data['certificate_number'] = '';
        }

        $data['blank_series'] = replaceLatinToRussian($data['blank_series']);
    $data['stiker_series'] = replaceLatinToRussian($data['stiker_series']);
        $data['regions_id'] = Cities::getRegionsId($data['registration_cities_id']);

        if ($data['special']) {
            $days = (mktime(0, 0, 0, intval($data['end_datetime_month']), intval($data['end_datetime_day']), intval($data['end_datetime_year'])) - mktime(0, 0, 0, intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year'])))/86400;

            $data['begin_datetime_day']     = date('d', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));
            $data['begin_datetime_month']   = date('m', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));
            $data['begin_datetime_year']    = date('Y', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));

            $data['end_datetime_day']   = date('d', mktime(0, 0, 0, date('m'), date('d') + 1 + $days, date('Y')));
            $data['end_datetime_month'] = date('m', mktime(0, 0, 0, date('m'), date('d') + 1 + $days, date('Y')));
            $data['end_datetime_year']  = date('Y', mktime(0, 0, 0, date('m'), date('d') + 1 + $days, date('Y')));

            if ($data['policy_statuses_id'] == POLICY_STATUSES_GENERATED) {

                $data['payment_datetime_day']       = date('d');
                $data['payment_datetime_month']     = date('m');
                $data['payment_datetime_year']      = date('Y');
                $data['payment_datetime_hour']      = '00';
                $data['payment_datetime_minute']    = '00';

                $data['payment_number'] = 'Б/Н';
            }
        }

        $begin_datetime = (checkdate(intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year']))
            : time();
 
        if ($data['id']>68038) $data['round']=true;
        $Products = Products::factory($data, 'GO');
 
        if ($_POST['do']!='Policies|copyPolicy') {
            $Products->calculate($data['person_types_id'], $data['policies_general_id'], $data['deductible'], $data['car_types_id'], $data['engine_size'], $data['car_weight'], $data['passengers'], $data['registration_cities_id'], $data['scopes_id'], $data['driver_standings_id'], $data['terms_id'], $data['regres'], $data['privileges'], $data['bonus_malus_id'], $data);
        }

        if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW) {//для переукладеного полиса сумма к проплате ниже на разницу
            $data['amount']-= doubleval($data['amount_parent']);
        }
        
        if ($data['policy_statuses_id'] == POLICY_STATUSES_COPY) {//у дубликата нету комиссий
            $data['amount'] = 0;
            $this->formDescription['fields'][ $this->getFieldPositionByName('amount') ]['verification']['canBeEmpty'] = true;
            $data['commission_agent_percent'] = 0;
        }   
            
        if ($data['policy_statuses_id'] == POLICY_STATUSES_CREATED) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('payment_datetime') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('payment_number') ]['verification']['canBeEmpty'] = true;
            if ($data['agencies_id'] == 1469) {
                $emptyFields =
                    array(
                        'formDescription' =>
                            array(
                                'blank_series',
                                'blank_number',
                                'stiker_series',
                                'stiker_number',
                                'payment_datetime',
                                'payment_number'
                        )
                    );
            }
        }  
        
        if ($data['policy_statuses_id'] == POLICY_STATUSES_CONSULTATION || $data['policy_statuses_id'] ==19) {
                $emptyFields =
                    array(
                        'formDescription' =>
                            array(
                                
                                'insurer_identification_code',
                                'insurer_street_types_id',
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
                                'shassi',
                                'sign',
                                'blank_series',
                                'blank_number',
                                'stiker_series',
                                'stiker_number',
                                'payment_datetime',
                                'payment_number',

                                'insurer_newpassport_number',
                                'insurer_newpassport_place',
                                'insurer_newpassport_date',
                                'insurer_newpassport_reestr',
                                'insurer_newpassport_dateEnd',
                                
                        )
                    );
            
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

    function getIdBySeriesNumber($series, $number) {
        global $db;

        $conditions[] = 'blank_series = ' . $db->quote($series);
        $conditions[] = 'blank_number = ' . $db->quote($number);

        $sql =  'SELECT policies_id ' .
                'FROM ' . PREFIX . '_policies_go ' .
                'WHERE ' . implode(' AND ', $conditions);
        $id =   $db->getOne($sql);

        return ($id > 0) ? true : false;
    }

    function checkFields($data, $action) {
        global $db, $Log, $Authorization;

        if ($data['person_types_id'] == 2) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_series') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_place') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_date') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_dateofbirth') ]['verification']['canBeEmpty'] = true;

            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_place') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_date') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_reestr') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_dateEnd') ]['verification']['canBeEmpty'] = true;
        } elseif ( $data['insurer_dateofbirth_year'] && isOlder($data['insurer_dateofbirth_year'], $data['insurer_dateofbirth_month'], $data['insurer_dateofbirth_day']) ) {
            $Log->add('error', 'Вік страхувальника не може перевищувати 80 років.');
        }

        if($data['parent_id'] && intval($data['parent_id']) > 0 && intval($data['outside_client']) === 1 && !$this->checkPermissionsBooleanResult("outside_client")) {
            $Log->add('error', 'Клієнт раніше був застрахований в <b>ТДВ «Експрес Страхування»</b>, він не може мати статус <b>Стороннього клієнта</b>.');
        }

        if($data['manager_id'] && intval($data['manager_id']) > 0 && intval($data['outside_client']) === 1 && !$this->checkPermissionsBooleanResult("outside_client")) {
            $Log->add('error', 'Клієнт, якого привів менеджер, не може мати статус <b>Стороннього клієнта</b>.');
        }

        if ($data['types_id'] == 2) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('year') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('engine_size') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('shassi') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('sign') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('brands_id') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('models_id') ]['verification']['canBeEmpty'] = true;
        }

        if (!intval($data['otk'])) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('otknumber') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('otkdate') ]['verification']['canBeEmpty'] = true;
        }
        
            
        $showf = (intval($data['solutions_id'])==0 
                    && $Authorization->data['roles_id']==ROLES_AGENT
                    && intval($Authorization->data['ukravto'])
                    && intval($data['outside_client'])==0
                    );//новый поле обязательно
                
        if ($data['parent_id']>0) $showf = false; //пролонгация поле не обязательно
        if ($data['agencies_id'] == 1469) $showf = false; 
            
        if ($showf) //машина не из ЭК нужно заполнить менеджера 
        {   
            $this->formDescription['fields'][ $this->getFieldPositionByName('manager_id') ]['verification']['canBeEmpty'] = false;
        }

        parent::checkFields($data, $action);

        $data['agencies_id'] = ($data['agencies_id'])
            ? $data['agencies_id']
            : $db->getOne('SELECT agencies_id FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['id']));

        if (intval($data['privileges'])) {
            if ($data['person_types_id'] != 1) {
                $Log->add('error', 'Пільги діють лише для фізичних осіб.');
            } else if ($data['car_types_id'] != 1 && $data['car_types_id'] != 6 && $data['car_types_id'] != 7) {
                $Log->add('error', 'Пільги діють лише для легкових автомобілів  та мотоциклів.');
            } else if ($data['engine_size'] > 2500) {
                $Log->add('error', 'Пільги діють лише для легкових автомобілів з об\'ємом до 2500 см.');
            }
        }

        if (intval($data['otk']) == '1' && mktime(0, 0, 0, $data['end_datetime_month'], $data['end_datetime_day'], $data['end_datetime_year']) >
            mktime(0, 0, 0, $data['otkdate_month'], $data['otkdate_day'], $data['otkdate_year'])) {
                $Log->add('error', 'Договори ОСЦПВ, що підлягають обов\'язковому технічному контролю, укладаються на строк, що не перевищує строку ОТК.');
        }

        
        if ($data['card_assistance'] != '' && $data['id']>0) {
            $car_used = $db->getOne('SELECT policies_id FROM insurance_policies_go WHERE card_assistance='.$db->quote($data['card_assistance']).' and policies_id<>'.intval($data['id']));
            if ($car_used>0) {
                $Log->add('error', 'Вказаний Номер картки Експрес Асістанс вже використовується');
            }
        }
        
        
        if (doubleval($data['bonus_malus']) > 0) {//скидка бонус малус
            if ($data['terms_id'] < 19 && $data['bonus_malus_id'] != 5 /*25 && $data['bonus_malus_id'] != 5*/)
                $Log->add('error', 'Знижку Бонус малус дозволено для полiсiв строком страхування від 6 місяців до 1 рiк.');
            //if ($data['bonus_malus_id'] != 5 && intval($data['policies_general_id']) > 0)
            //  $Log->add('error', 'Знижку Бонус малус дозволено не для автопарків.');
            //if ($data['insurance_companies_id']>0 && $data['insurance_companies_id'] != 4)
            //  $Log->add('error', 'Знижку Бонус малус дозволено для Компанії - Експрес Страхування.');
        }
//_dump($data['amount']);exit;
        if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW && intval($data['amount'])!=0) {//для переукладеного полиса сумма =0 менять тариф нельзя
        //_dump($data['amount']);exit;
            //$Log->add('error', 'Для переукладених полiсiв Тариф повинен дорiвнювати Тарифу у попередньому полiсi');
        }
        
        //агенция Iндивiдуальна мотивацiя: 
        if ($Authorization->data['roles_id']==ROLES_AGENT && $Authorization->data['individual_motivation']==1) {
            //1.    Новый договор, стоит галочка «Сторонній клієнт» - поле «Менеджер що привів клієнта» НЕобязательное
            if ($data['parent_id'] ==0 && $data['outside_client']==1) {
                $this->formDescription['fields'][ $this->getFieldPositionByName('manager_id') ]['verification']['canBeEmpty'] = true;
            }
            
            //2.    Новый договор, нет  галочки «Сторонній клієнт» - поле «Менеджер що привів клієнта» ОБЯЗАТЕЛЬНОЕ, ячейка мотивація может быть 0% 
            if ($data['parent_id'] ==0 && $data['outside_client']==0) {
                $this->formDescription['fields'][ $this->getFieldPositionByName('manager_id') ]['verification']['canBeEmpty'] = false;
            }
            //3.    Пролонгация договора - поле «Менеджер що привів клієнта» ВСЕГДА НЕобязательное
            if ($data['parent_id'] >0) {
                $this->formDescription['fields'][ $this->getFieldPositionByName('manager_id') ]['verification']['canBeEmpty'] = true;
            }
        }
        
/*      if ($data['manager_id']>0 && $data['parent_id']>0 && doubleval($data['motivation_manager_percent'])==0  && $data['individual_motivation']) {
            $Log->add('error', 'Необхідно заповнити мотивацiю <b>Менеджер що привiв клiєнта</b>');
        }
*/
        if ($data['blank_series'] && $data['blank_number']) {

            $blank = PolicyBlanks::get($data['blank_series'], $data['blank_number']);
            if ($blank['insurance_companies_id'] == INSURANCE_COMPANIES_ORANTA || $blank['insurance_companies_id'] == INSURANCE_COMPANIES_KNIAZHA) {
                $Log->add('error', 'Продаж полiсiв <b>Оранти</b> та <b>Княжа</b> заборонено.');
            }
//_dump($data['top_agencies_id']);exit;
 
            if ($data['blank_series'] != $blank['series'] || $data['blank_number'] != $blank['number']) {
                $Log->add('error', 'Бланк поліса ЦВ з вказанною серією та номером не існує.');
            } elseif ($data['top_agencies_id'] != $blank['agencies_id']) {
                $Log->add('error', 'Бланк поліса ЦВ з вказаною серією та номером не закріплен за агенцією.');
            } else {
                switch ($blank['blank_statuses_id']) {
                    case POLICY_BLANK_STATUSES_USED:
                        if ($data['id'] != $blank['policies_id']) {
                            $Log->add('error', 'Бланк поліса ЦВ з вказанною серією та номером вже використовується.');
                        }
                        break;
                    case POLICY_BLANK_STATUSES_SPOILT:
                        $Log->add('error', 'Бланк поліса ЦВ з вказанною серією та номером зіпсован.');
                        break;
                    case POLICY_BLANK_STATUSES_CLEAR:
                        $newId=$this->getIdBySeriesNumber($data['blank_series'], $data['blank_number']);
                        if ($newId>0 && $data['id'] != $newId) {
                            $Log->add('error', 'Бланк поліса ЦВ з вказанною серією та номером зарезервовано.');
                        }
                        break;
                }
            }

            //проверить чтобы бланк был выдан на агенцию по акту и акт подписан
            if ($data['top_agencies_id']!=1 && $blank['insurance_companies_id'] == INSURANCE_COMPANIES_EXPRESS)
            {
                $akt_id = intval($db->getOne('SELECT a.id FROM '.PREFIX.'_policy_blank_acts a JOIN  '.PREFIX.'_policy_blank_act_items b ON b.acts_id=a.id WHERE b.policy_blanks_id='.intval($blank['id']).' AND a.types_id=1 AND a.act_statuses_id=2'));
                if ($akt_id==0)
                    $Log->add('error', 'Бланк з вказаною  серією та номером не включено до акту передачi бланкiв або акт передачi не пiдписано');
            }
            
            if ($data['blank_series_parent'] && $data['blank_number_parent']) {
                $blank_parent = PolicyBlanks::get($data['blank_series_parent'], $data['blank_number_parent']);

                if ($blank_parent['insurance_companies_id'] != $blank['insurance_companies_id']) {
                    $Log->add('error', 'Не співпадають страхові компанії поліса що оформлюється та попередньо укладеного.');
                }
            }
        }

//      if ($data['insurance_companies_id'] == INSURANCE_COMPANIES_EXPRESS) {
            if ($data['blank_series'] != $data['stiker_series']) {
                $Log->add('error', 'Серія бланку поліса ЦВ не співпадає з серією стікера.');
            }
            if ($data['blank_number'] != $data['stiker_number']) {
                $Log->add('error', 'Номер бланку поліса ЦВ не співпадає з номером стікера.');
            }
//      }

        if (is_array($data['persons'])) {
            foreach ($data['persons'] as $i => $person) {
                if ($i == 0 || $person['lastname'] || $person['firstname'] || $person['patronymicname'] || $person['driverLicenceSerie'] || $person['driver_licence_number'] || $person['driver_licence_date']) {

                    if ($person['lastname'] == '') {
                        $params = array('Прізвище', null);
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }

                    if ($person['firstname'] == '') {
                        $params = array('Ім\'я', null);
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }

                    if ($person['patronymicname'] == '') {
                        $params = array('По батькові', null);
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }

                    if ($person['driver_licence_series'] == '') {
                        $params = array('Водійські права, серія', null);
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }

                    if ($person['driver_licence_number'] == '') {
                        $params = array('Водійські права, номер', null);
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    } elseif (!ereg('(^[0-9]{6}$)|(^[0-9]{9}$)', $person['driver_licence_number'])) {
                        $params = array('Водійські права, номер', null);
                        $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                    }

                    if (!checkdate(intval($person['driver_licence_date_month']), intval($person['driver_licence_date_day']), intval($person['driver_licence_date_year']))) {
                        $params = array(translate('Водійські права, дата'), null);
                        $Log->add('error', 'The date <b>%s</b>%s is not valid.', $params);
                    }
                }
            }
        }

        $date = (checkdate(intval($data['date_month']), intval($data['date_day']), intval($data['date_year'])))
            ? mktime(0, 0, 0, intval($data['date_month']), intval($data['date_day']), intval($data['date_year']))
            : mktime(0, 0, 0, date('m')  , date('d'), date('Y'));
        $begin_datetime = (checkdate(intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year'])))
            ? mktime(intval($data['begin_datetime_hour']), intval($data['begin_datetime_minute']), 0, intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year']))
            : 0;
        $payment_datetime = (checkdate(intval($data['payment_datetime_month']), intval($data['payment_datetime_day']), intval($data['payment_datetime_year'])))
            ? mktime(intval($data['payment_datetime_hour']), intval($data['payment_datetime_minute']), 0, intval($data['payment_datetime_month']), intval($data['payment_datetime_day']), intval($data['payment_datetime_year']))
            : 0;

        if ($begin_datetime && $_POST['do']!='Policies|copyPolicy') {
            if ($date && $begin_datetime <= $date && $data['policy_statuses_id']!=POLICY_STATUSES_RENEW && $data['next_policy_statuses_id']!=POLICY_STATUSES_RENEW)
                $Log->add('error', '<b>Дата початку дії поліса</b> повинна бути пізніше або дорівнювати <b>Даті та часу видачі поліса</b>.');
            if ($payment_datetime && $begin_datetime < $payment_datetime && $data['policy_statuses_id']!=POLICY_STATUSES_RENEW && $data['next_policy_statuses_id']!=POLICY_STATUSES_RENEW)
                $Log->add('error', '<b>Дата початку дії поліса</b> повинна бути пізніше або дорівнювати <b>Даті внесення страхового платежу</b>.');
        }
        
        
        
        //запретить вводить данные с нуля если полис уже есть то только пролонгация
        $conditions = array();
        if ($data['id']>0) {
            $conditions[]='a.id<>'.intval($data['id']);
        }
        
        $conditions[]=' b.shassi= '.$db->quote($data['shassi']);
                    
        if ($data['person_types_id'] == 2) {
            $conditions[] = 'b.insurer_edrpou = ' . $db->quote($data['insurer_edrpou']);
        } else {
            $conditions[] = 'b.insurer_identification_code = ' . $db->quote($data['insurer_identification_code']);
        }
                    
        $sql =  'SELECT a.id  ' .
                'FROM ' . PREFIX . '_policies AS a   ' .
                'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                'WHERE ('.implode(' AND ', $conditions).') AND a.payment_statuses_id>=3 ' .
                'ORDER BY a.date DESC LIMIT 1';
        $policies_id = intval($db->getOne($sql));
        //есть клиент в базе,   но parent_id нету 
        if ($data['policy_statuses_id']!=POLICY_STATUSES_CONSULTATION && $data['policy_statuses_id']!=19 && $data['parent_id'] == 0 && intval($policies_id)>0 && !$Authorization->data['permissions']['Policies_KASKO']['superbonusmalus'] ) {
            $Log->add('error', 'Вказаний клієнт вже має попередній поліс необхідно використовувати режим пролонгації');
        }
            
                            

        //!!! проверка сертификатов
        if ($data['certificate'] != '' && $data['insurance_companies_id'] != INSURANCE_COMPANIES_EXPRESS) {
            $Log->add('error', 'Сертифікати видаються при оформленні полісу ЦВ від СК &quot;Експрес Страхування&quot;.');
        } elseif ($data['certificate'] != '' && !ereg('^[0-9]{5}$', $data['certificate'])) {
            $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', array('Сертифікат на 500 грн.', ''));
        } elseif ($data['certificate'] != '' && !in_array($data['policy_statuses_id'], array(POLICY_STATUSES_CREATED, POLICY_STATUSES_GENERATED))) {
            $Log->add('error', 'Сертифікати видаються при оформленні полісу ЦВ (статуси "Створено" та "Сформовано").');
        } elseif ($data['certificate'] != '') {

            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_policy_blanks ' .
                    'WHERE series = ' . $db->quote('СР') . ' AND number = ' . $db->quote($data['certificate']);
            $certificate = $db->getRow($sql);

            if ($data['top_agencies_id'] != $certificate['agencies_id']) {
                $Log->add('error', 'Сертифікат на 500 грн. не закріплен за агенцією.');
            } else {

                //получаем информацию по полисам с сертификатом
                $sql =  'SELECT id, product_types_id ' .
                        'FROM ' . PREFIX . '_policies ' .
                        'WHERE certificate = ' . $db->quote( $data['certificate'] );
                        'ORDER BY product_types_id';
                $policies = $db->getAll($sql);

                if ($policies[ 0 ]['product_types_id'] == PRODUCT_TYPES_GO && intval($data['id']) != intval($policies[ 0 ]['id'])) {
                    $Log->add('error', 'Сертифікат може бути видан тільки по одному полісу ЦВ.');
                }
            }
        }

        //if ($data['special'] && ($date < mktime(0, 0, 0, 11, 17, 2010) || $date > mktime(23, 59, 59, 12, 31, 2010))) {
        //  $Log->add('error', 'Акція починається з <b>17.11.2010</b> та діє до <b>31.12.2010</b>.');
        //}

        /*if ($data['next_policy_statuses_id']!=POLICY_STATUSES_RENEW) {
            if ($payment_datetime) {
                if (mktime(intval($data['payment_datetime_hour']), intval($data['payment_datetime_minute']), 0, intval($data['payment_datetime_month']), intval($data['payment_datetime_day']), intval($data['payment_datetime_year'])) >= mktime())
                    $Log->add('error', '<b>Дата внесення страхового платежу</b> не може бути пізніше ніж поточна дата.');
                if ($payment_datetime < $date)
                    $Log->add('error', '<b>Дата внесення страхового платежу</b> повинна бути раніше <b>Дати поліса</b>.');
            }
        }*/

        if (intval($data['policies_general_id'])) {
            $sql =  'SELECT b.identification_code ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_clients AS b ON a.clients_id = b.id ' .
                    'WHERE a.id = ' . intval($data['policies_general_id']);
            $identification_code = $db->getOne($sql);

            if ($identification_code != $data['insurer_identification_code'] && $identification_code != $data['insurer_edrpou']) {
                $Log->add('error', 'Страхувальник за полісом не співпадає зі страхувальником за Генеральним договором.');
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
    
    function getShowFieldsSQLString() {
        $result = parent::getShowFieldsSQLString();

        $result = str_replace('insurance_accounts.lastname', 'IF(insurance_policies.seller_agents_id>0,CONCAT(insurance_accounts.lastname,\'/\',getSeller(insurance_policies.seller_agents_id)),insurance_accounts.lastname) ', $result);

        return $result;
    }

    function add($data) {
        if (!$data['types_id']) {
            $data['types_id'] = 1;
        }

        return parent::add($data);
    }

    function updatePersons($policies_id, $persons) {
        global $db;

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policies_go_persons ' .
                'WHERE policies_id = ' . intval($policies_id);
        $db->query($sql);

        if (is_array($persons)) {
            foreach ($persons as $person) {
                if ($person['lastname']) {
                    $sql =  'INSERT INTO ' . PREFIX . '_policies_go_persons SET ' .
                            'policies_id = ' . intval($policies_id) . ', ' .
                            'lastname = ' . $db->quote($person['lastname']) . ', ' .
                            'firstname = ' . $db->quote($person['firstname']) . ', ' .
                            'patronymicname = ' . $db->quote($person['patronymicname']) . ', ' .
                            'driver_licence_series = ' . $db->quote($person['driver_licence_series']) . ', ' .
                            'driver_licence_number = ' . $db->quote($person['driver_licence_number']) . ', ' .
                            'driver_licence_date = ' . $db->quote( $person['driver_licence_date_year'] . '-' . $person['driver_licence_date_month'] . '-' . $person['driver_licence_date_day'] ) . ', ' .
                            'created = NOW()';
                    $db->query($sql);
                }
            }
        }
    }

    function setCommissions($id) {
        global $db;

        //вычисление итоговых сумм комиссионного вознаграждения
        $sql =  'SELECT ' .

                'SUM(' .
                '  round(a.amount * b.commission_agency_percent / 100, 2) ' .//сумма комиссионного вознаграждения агенции, считаем от страхового тарифа
                ' ) AS commission_agency_amount, ' .//сумма комиссионного вознаграждения агенции

                'SUM(  round(a.amount * b.commission_agent_percent / 100, 2) ' .//сумма комиссионного вознаграждения агенту, считаем от страхового тарифа
                ' ) AS commission_agent_amount, ' .//сумма комиссионного вознаграждения агенту
                
                'SUM(  round(a.amount * b.director1_commission_percent / 100, 2) ' .//сумма комиссионного вознаграждения директору  за 1 ТС, считаем от страхового тарифа
                ' ) as commission_director1_amount, ' .//сумма комиссионного вознаграждения директору  за 1 ТС
                
                'SUM(  round(a.amount * b.director2_commission_percent / 100, 2) ' .//сумма комиссионного вознаграждения зам директору  за 1 ТС, считаем от страхового тарифа
                ' ) as commission_director2_amount, ' .//сумма комиссионного вознаграждения зам директору  за 1 ТС

                'SUM(  ' .
                '  round(a.amount * b.commission_manager_percent / 100, 2) ' .
                ' ) as commission_manager_amount, ' . 
                'SUM(  ' .
                '  round(a.amount * b.commission_seller_agents_percent / 100, 2) ' .
                ' ) as commission_seller_agents_amount, ' . 
                

                'SUM(  round(a.amount * b.commission_financial_institution_percent / 100, 2) ' .//сумма комиссионного вознаграждения ОДО "Экспресс страхование", считаем от страхового тарифа
                ' ) AS commission_financial_institution_amount ' .//сумма комиссионного вознаграждения ОДО "Экспресс страхование"

                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id) . ' ' .
                'GROUP BY a.id';
        $row =  $db->getRow($sql);

        $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
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

        $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'commission_agent_amount = ' . $db->quote($row['commission_agent_amount']) . ', ' .
                'commission_director1_amount =  ' . doubleval($row['commission_director1_amount']).' , ' .
                'commission_director2_amount =  ' . doubleval($row['commission_director2_amount']).' , ' .
                'commission_manager_amount =  ' . doubleval($row['commission_manager_amount']).' , ' .
                'commission_seller_agents_amount =  ' . doubleval($row['commission_seller_agents_amount']).' , ' .
                
                'commission_financial_institution_amount = ' . $db->quote($row['commission_financial_institution_amount']) . ' ' .
                'WHERE policies_id = ' . intval($id).'  ';
        $db->query($sql);
        
        $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'commission_agency_amount = ' . $db->quote($row['commission_agency_amount']) . ' ' .
                'WHERE policies_id = ' . intval($id).' ';
        $db->query($sql);
    }

    function setBlankStatus(&$data) {
        global $db;

        $sql =  'UPDATE ' . PREFIX . '_policy_blanks AS a ' .
                'JOIN ' . PREFIX . '_policies AS b ON b.id=' . intval($data['id']) . ' SET ' .
                'b.insurance_companies_id=a.insurance_companies_id ' .
                'WHERE a.series = ' . $db->quote($data['blank_series']) . ' AND a.number = ' . $db->quote($data['blank_number']);
        $db->query($sql);

        switch ($data['policy_statuses_id']) {
            case POLICY_STATUSES_GENERATED:
            case POLICY_STATUSES_COPY:
            case POLICY_STATUSES_CONTINUED:
            case POLICY_STATUSES_RENEW:
                //списываем бланк
                $sql =  'UPDATE ' . PREFIX . '_policy_blanks AS a ' .
                        ' SET ' .
                        'a.blank_statuses_id = ' . POLICY_BLANK_STATUSES_USED . ' ' .
                        'WHERE a.series = ' . $db->quote($data['blank_series']) . ' AND a.number = ' . $db->quote($data['blank_number']);
                $db->query($sql);
                break;
            case POLICY_STATUSES_SPOILT:
                //маркируем бланк как испорченый и ставим полис в статус испорченый
                $sql =  'UPDATE ' . PREFIX . '_policies AS b   SET  ' .
                        'b.policy_statuses_id = ' . POLICY_STATUSES_SPOILT . ' ' .
                        'WHERE b.id=' . intval($data['id']) . ' ';
                $db->query($sql);

                break;
        }
    }

    function setClient($data) {

        $values['agencies_id']                      = 1469;
        $values['agents_id']                        = ($data['agencies_id'] == 1469) ? $data['agents_id'] : 0;
        $values['person_types_id']                  = $data['person_types_id'];

        switch ($data['person_types_id']) {
            case '1'://физ. лицо
                $values['lastname']                 = $data['insurer_lastname'];
                $values['firstname']                = $data['insurer_firstname'];
                $values['patronymicname']           = $data['insurer_patronymicname'];
                $values['identification_code']      = $data['insurer_identification_code'];

                $values['dateofbirth']              = $data['insurer_dateofbirth_year'] . '-' . $data['insurer_dateofbirth_month'] . '-' . $data['insurer_dateofbirth_day'];
                $values['dateofbirthYear']          = $data['insurer_dateofbirth_year'];
                $values['dateofbirthMonth']         = $data['insurer_dateofbirth_month'];
                $values['dateofbirthDay']           = $data['insurer_dateofbirth_day'];
                $values['passport_series']          = $data['insurer_passport_series'];
                $values['passport_number']          = $data['insurer_passport_number'];

                if ($data['insurer_driver_licence_series']) {
                    $values['driver_licence_series']        = $data['insurer_driver_licence_series'];
                }

                if ($data['insurer_driver_licence_number']) {
                    $values['driver_licence_number']        = $data['insurer_driver_licence_number'];
                }

                if ($data['insurer_driver_licence_date']) {
                    $values['driver_licence_date']      = $data['insurer_driver_licence_date'];
                    $values['driver_licence_date_year'] = $data['insurer_driver_licence_date_year'];
                    $values['driver_licence_date_month']= $data['insurer_driver_licence_date_month'];
                    $values['driver_licence_date_day']  = $data['insurer_driver_licence_date_day'];
                }

                break;
            case '2'://юр. лицо
                $values['company']              = $data['insurer_lastname'];
                $values['identification_code']  = $data['insurer_edrpou'];
                break;
        }

        $values['mobile_phone']                 = $data['insurer_phone'];
        $values['email']                        = $data['insurer_email'];

        $values['registration_regions_id']      = $data['insurer_regions_id'];
        $values['registration_area']            = $data['insurer_area'];
        $values['registration_city']            = $data['insurer_city'];
        $values['registration_street_types_id'] = $data['insurer_street_types_id'];
        $values['registration_street']          = $data['insurer_street'];
        $values['registration_house']           = $data['insurer_house'];
        $values['registration_flat']            = $data['insurer_flat'];
        $values['registration_phone']           = $data['insurer_phone'];

        $values['habitation_regions_id']        = $data['insurer_regions_id'];
        $values['habitation_area']              = $data['insurer_area'];
        $values['habitation_city']              = $data['insurer_city'];
        $values['habitation_street_types_id']   = $data['insurer_street_types_id'];
        $values['habitation_street']            = $data['insurer_street'];
        $values['habitation_house']             = $data['insurer_house'];
        $values['habitation_flat']              = $data['insurer_flat'];
        $values['habitation_phone']             = $data['insurer_phone'];

        $Clients = new Clients($values);
        $Clients->permissions[ 'update' ] = true;
        $Clients->permissions[ 'insert' ] = true;

        return $Clients->fill($values);
    }

    function setCar($data) {

        $values['clients_id']               = $data['clients_id'];
        $values['brands_id']                = $data['brands_id'];
        $values['models_id']                = $data['models_id'];
//      $values['price']                    = $data['price'];
        $values['engine_size']              = $data['engine_size'];
//      $values['transmissions_id']         = $data['transmissions_id'];
        $values['year']                     = $data['year'];
//      $values['race']                     = $data['race'];
//      $values['colors_id']                = $data['colors_id'];
        if ($data['passengers']) {
            $values['passengers']           = $data['passengers'];
        }

        if ($data['car_weight']) {
            $values['car_weight']           = $data['car_weight'];
        }

        $values['shassi']                   = $data['shassi'];

        if ($data['sign']) {
            $values['sign']                 = $data['sign'];
        }

//      $values['protection_multlock']      = $data['protection_multlock'];
//      $values['protection_immobilaser']   = $data['protection_immobilaser'];
//      $values['protection_manual']            = $data['protection_manual'];
//      $values['protection_signalling']        = $data['protection_signalling'];

//      $values['registration_number']      = $data['registration_number'];
//      $values['registration_place']       = $data['registration_place'];
//      $values['registration_date']            = $data['registration_date'];
//      $values['registration_date_year']       = $data['registration_date_year'];
//      $values['registration_date_month']  = $data['registration_date_month'];
//      $values['registration_date_day']        = $data['registration_date_day'];

//      $values['registration_cities_id']       = $data['registration_cities_id'];
//      $values['registration_cities_title']    = $data['registration_cities_title'];

        $values['regions_id']               = $data['regions_id'];

        $ClientCars = new ClientCars($values);
        $ClientCars->permissions[ 'update' ]=true;
        $ClientCars->permissions[ 'insert' ]=true;
        $ClientCars->fill($values);
    }

    function setAdditionalFields($id, $data) {
        global $db, $Log, $CLIENT_FILL_POLICY_STATUSES;

        $data['clients_id'] = 0;
        if (in_array($data['policy_statuses_id'], $CLIENT_FILL_POLICY_STATUSES) && !$data['skipClients']) {//фиксируем данные по клиенту только, если договор закрывается для редактирования, мусора меньше будет
            $data['clients_id'] = $this->setClient($data);
            $this->setCar($data);
            $Log->clear();
        }
        if ($data['old_policy_statuses_id'] <> POLICY_STATUSES_GENERATED && $data['policy_statuses_id']== POLICY_STATUSES_GENERATED) {
            $sql =  'UPDATE ' . PREFIX . '_policies SET date=NOW() WHERE id = ' . intval($id);
            $db->query($sql);
        }

        $sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_products_go AS c ON b.products_id = c.products_id ' .
                'JOIN ' . PREFIX . '_products AS d ON b.products_id = d.id ' .
                'LEFT JOIN ' . PREFIX . '_car_types AS h ON h.id=b.car_types_id '.
                'LEFT JOIN ' . PREFIX . '_car_models AS e ON b.models_id = e.id ' .
                'LEFT JOIN ' . PREFIX . '_car_brands AS f ON e.car_brands_id = f.id ' .
                'JOIN ' . PREFIX . '_product_types AS n ON a.product_types_id = n.id ' .
                'LEFT JOIN ' . PREFIX . '_policies AS i ON i.id = ' . intval($data['parent_id']) . ' ' .
                'JOIN ' . PREFIX . '_cities AS j ON b.registration_cities_id = j.id SET ' .
                'a.parent_id = ' . intval($data['parent_id']) . ', ' .
                'a.top = IF(i.top > 0, i.top, ' . intval($id) . '), ' .
                'a.clients_id = ' . intval($data['clients_id']) . ', ' .
                'a.product_types_expense_percent = n.expense_percent, ' .
                'b.products_code = d.code, ' .
                'b.products_title = d.title, ' .
                'a.number = IF(a.policy_statuses_id=18 OR a.policy_statuses_id=19 OR (a.policy_statuses_id=1 AND a.agencies_id=1469 AND LENGTH(b.blank_number)=0),a.id,CONCAT(b.blank_series, \'-\', b.blank_number)), ' .
                'a.date = IF(TO_DAYS(a.date) > 0, a.date, NOW()), ' .
                'a.insurer = IF(b.person_types_id = 2, insurer_lastname, CONCAT(insurer_lastname, \' \', insurer_firstname)), ' .
                'a.item = IF(b.types_id = 2, h.title, CONCAT(f.title, \'/\', e.title)), ' .
                'a.interrupt_datetime = a.end_datetime, ' .
                'b.brand = f.title, ' .
                'b.model = e.title, ' .
                'b.registration_cities_title = IF(b.registration_cities_id <> ' . CITIES_OTHER . ' AND b.registration_cities_id <> ' . CITIES_OUT_UKRAINE . ', j.title, b.registration_cities_title), ' .
                'i.child_id = ' . intval($id) . ' ' .
                'WHERE a.id = ' . intval($id);
        $db->query($sql);

        $statuses = array(
            POLICY_STATUSES_COPY,
            POLICY_STATUSES_CONTINUED,
            POLICY_STATUSES_RENEW);

        if (in_array($data['policy_statuses_id'], $statuses)) {//переукладення, удаляем все неоплаченые ожидаемые платежи с календаря дочернего полиса
            $sql = 'UPDATE  ' . PREFIX . '_policies SET child_id = ' . intval($id) . ' WHERE id = ' . intval($data['parent_id']);
            $db->query($sql);
        }

        if ($data['policy_statuses_id'] == POLICY_STATUSES_RENEW) {//переукладений для старого поставить анульований
            $sql = 'UPDATE  ' . PREFIX . '_policies SET policy_statuses_id = ' . POLICY_STATUSES_CANCELLED . ' WHERE id = ' . intval($data['parent_id']);
            $db->query($sql);
        }

        $this->setBlankStatus($data);

        $this->updatePersons($id, $data['persons']);

        if (!$data['skipCalendar'] && !$this->isInAct($id)) {
            $PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
            $PolicyPaymentsCalendar->updateCalendar($id);
        }   

        $this->setCommissions($id);

        if ($data['certificate']) {
            $sql =  'UPDATE ' . PREFIX . '_policy_blanks SET ' .
                    'blank_statuses_id = IF(blank_statuses_id = 1, 2, blank_statuses_id) ' .
                    'WHERE product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND number = ' . $db->quote($data['certificate']);
            $db->query($sql);
        }
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization,$db;

        $data['agencies_id']    = $Authorization->data['agencies_id'];
        $data['top_agencies_id']  = $db->getOne('SELECT IF(parent_id>0,parent_id,id) FROM '.PREFIX.'_agencies WHERE id='.intval($Authorization->data['agencies_id']));
        $data['agents_id']  = $Authorization->data['id'];
        $data['round'] = true;

        if (!$Authorization->data['ankets'] && $Authorization->data['roles_id']==ROLES_AGENT && $data['policy_statuses_id']==POLICY_STATUSES_CONSULTATION)
        $data['cons_agents_id'] = $Authorization->data['id'];

        $data['id'] = parent::insert(&$data, false, false);

        if (intval($data['id'])) {
            $this->setAdditionalFields($data['id'], $data);

            $this->generateDocuments($data['id']);

            if ($redirect) {
                $params['title']    = $this->messages['single'];
                $params['id']       = $data['id'];
                $params['storage']  = $this->tables[0];

                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'].($data['policy_statuses_id'] == 10 ? '&showhint=1' :''));
                exit;
            } else {
                return $data['id'];
            }
        } elseif ($showForm) {
            $this->showForm($data, $GLOBALS['method'], 'insert');
        }
    }

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        $sql =  'SELECT insurance_companies_id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE id = ' . intval($data['id']);
        $data['insurance_companies_id'] = $db->getOne($sql);

        $conditions[] = 'policies_id = ' . intval($data['id']);

        $sql =  'SELECT *, date_format(driver_licence_date, \'' . DATE_FORMAT . '\') AS driver_licence_date, date_format(driver_licence_date, \'%Y\') AS driver_licence_date_year, date_format(driver_licence_date, \'%m\') AS driver_licence_date_month, date_format(driver_licence_date, \'%d\') AS driver_licence_date_day ' .
                'FROM ' . PREFIX . '_policies_go_persons ' .
                'WHERE ' . implode(' AND ', $conditions);
        $data['persons'] = $db->getAll($sql);

        return $data;
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization,$db;

        $data['old_policy_statuses_id'] = $policy_statuses_id = $db->getOne('SELECT policy_statuses_id FROM insurance_policies WHERE id='.intval($data['id']));
        if ($policy_statuses_id == POLICY_STATUSES_CONSULTATION && $data['policy_statuses_id']!=POLICY_STATUSES_CONSULTATION) {
            //переход с конусльтации в другой статус поменять человека кто создал
            $this->formDescription['fields'][ $this->getFieldPositionByName('agents_id') ]['display']['update'] = true;
            $data['agents_id']  = $Authorization->data['id'];
        }
        if ($data['seller_agencies_id']>0) {
            $data['top_agencies_id']  = $db->getOne('SELECT IF(parent_id>0,parent_id,id) FROM '.PREFIX.'_agencies WHERE id='.intval($data['seller_agencies_id']));
        }
        
        if (parent::update(&$data, false, $showForm)) {

            $this->setAdditionalFields($data['id'], $data);
//$this->generateDocuments($data['id']);

            if ($redirect) {
                $params['title']    = $this->messages['single'];
                $params['id']       = $data['id'];
                $params['storage']  = $this->tables[0];

                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'].($data['policy_statuses_id'] == 10 ? '&showhint=1' :''));
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

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policies_go_persons ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        return parent::deleteProcess($data, $i, $folder);
    }

    function spoilPolicy($data) {//установка полиса как зіпсований
        global $db, $Log;

        $this->checkPermissions('spoilPolicy', $data);

        //делаем как зіпсований и выдаем пользователю новый полис с темиже данными
        $data['checkPermissions'] = 1;
        $data = $this->load($data, false);

        $data['policy_statuses_id'] = POLICY_STATUSES_SPOILT;
        $this->setBlankStatus($data);

        $Log->add('confirm', 'Поліс <b>' . $data['blank_series'] . '-' . $data['blank_number'] . '</b> було встановлено як "Зіпсований", на заміну Ви можете занести новий поліс.');

        unset($data['blank_series']);
        unset($data['blank_number']);
        unset($data['policy_statuses_id']);

        $this->add($data);
    }

    function copyPolicy($data) {//алгоритм выписки дубликата
        global $Log, $Authorization;

        $this->checkPermissions('copyPolicy', $data);

        $id=$data['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data['checkPermissions'] = 1;
            $this->formDescription['fields'][ $this->getFieldPositionByName('products_id') ]['display']['update'] = true;
            $row = $this->load($data, false);

            $row['parent_id']           = $data['id'];
            $row['product_types_id']    = PRODUCT_TYPES_GO;
            $row['policy_statuses_id']  = POLICY_STATUSES_COPY;
            $row['blank_series_parent'] = $row['blank_series'];
            $row['blank_number_parent'] = $row['blank_number'];
            $row['blank_series']        = $data['blank_series'];
            $row['blank_number']        = $data['blank_number'];

            $row['stiker_series']       = $data['blank_series'];
            $row['stiker_number']       = $data['blank_number'];
            
            //$row['amount_parent']     = $data['amount'];
            $row['skipCalendar']        = 1;
            unset($row['id']);

            $data['id'] = $this->insert($row, false, false);

            if ($data['id']) {
                $Log->add('confirm', 'Поліс <b>' . $data['blank_series'] . '-' . $data['blank_number'] . '</b> було встановлено як "Дублікат".');

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_GO);
                exit;
            }   
        }
        $data['id']=$id;
        $this->showForm($data, 'insert', null, 'goCopy.php') ;
    }

    
     function showForm($data, $action, $actionType=null, $template=null) {
        global $Authorization, $POLICY_STATUSES_SCHEMA,$db;

        $sql =  'SELECT id, code, title, level ' .
                'FROM ' . PREFIX . '_agencies ' .
                'ORDER BY CAST(code AS UNSIGNED),num_l';                
        $data['seller_agencies'] = $db->getAll($sql, 60 * 60);
        $data['seller_agents_fio'] = $db->getOne('SELECT CONCAT(lastname,\' \',firstname) FROM insurance_accounts WHERE id='.intval($data['seller_agents_id']));
        $data['cons_agents_fio'] = $db->getOne('SELECT CONCAT(lastname,\' \',firstname) FROM insurance_accounts WHERE id='.intval($data['cons_agents_id']));
        $data['manager_fio'] = $db->getOne('SELECT CONCAT(lastname,\' \',firstname) FROM insurance_accounts WHERE id='.intval($data['manager_id']));

        parent::showForm($data, $action, $actionType, $template);
    }
    
    function renewPolicy($data) {//алгоритм Переукласти поліс
        global $db, $Log,$POLICY_STATUSES_SCHEMA;

        $this->checkPermissions('renewPolicy', $data);

        $data['checkPermissions'] = 1;
        $data = $this->load($data, false);
/*
        try {
            //записать данные по удеражаным деньгам
            ini_set('soap.wsdl_cache_enabled', 0);

            $Client = new SoapClient(KNYGA_WEB_SERVICE_URL);

            $result = $Client->PayDissolution('MainDB;1', '14', $data['blank_series'], $data['blank_number'], date( 'Y-m-d') . 'T00:00:00', 0);//за ведение дела ничего не удерживаеться

            $amount_return = $amount_commission = $amount_losses = 0;
            
            $xml = @simplexml_load_string($result);

            if ($xml) {
                $amount_return      = doubleval($xml->item->ReturnAmount);
                $amount_commission  = doubleval($xml->item->CommisionAmount);
                $amount_losses      = doubleval($xml->item->LossesAmount);
            }
        } catch(Exception $e) {
            $Log->add('error', translate('Помилка запиту до СК "Княжа".'));

            $redirect = ($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show';
            header('Location: ' . $redirect);
            exit;
        }

        $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                'amount_return = ' . doubleval($amount_return) . ', ' .
                'amount_commission = ' . doubleval($amount_commission) . ', ' .
                'amount_losses = ' . doubleval($amount_losses) . ' ' .
                'WHERE id = ' . intval($data['id']);
        $db->query($sql);
*/

        $data['amount_parent'] = $data['amount_go'];//$amount_return; //остаточная сумма, меньше платит клиент на эту сумму

        $data['parent_id'] = $data['id'];
        unset($data['id']);

        $data['blank_series_parent']    = $data['blank_series'];
        $data['blank_number_parent']    = $data['blank_number'];

        unset($data['blank_series']);
        unset($data['blank_number']);

        unset($data['stiker_series']);
        unset($data['stiker_number']);

        /*$data['begin_datetime']       = '';
        $data['begin_datetime_day'] = '';
        $data['begin_datetime_month']   ='';
        $data['begin_datetime_year']    = '';
        unset($data['begin_datetimeTimePicker']);
        unset($data['begin_datetimeHour']);
        unset($data['begin_datetimeMinute']);

        unset($data['end_datetime']);
        unset($data['end_datetime_day']);
        unset($data['end_datetime_month']);
        unset($data['end_datetime_year']);*/

        unset($data['payment_datetime']);
        unset($data['payment_datetime_day']);
        unset($data['payment_datetime_month']);
        unset($data['payment_datetime_year']);
        unset($data['payment_datetimePicker']);
        unset($data['payment_datetime_hour']);
        unset($data['payment_datetime_minute']);
        unset($data['payment_number']);

        unset($data['policy_statuses_id']);
        $data['next_policy_statuses_id'] = POLICY_STATUSES_RENEW;
        $POLICY_STATUSES_SCHEMA [POLICY_STATUSES_CREATED] =
                array(
                    POLICY_STATUSES_CREATED,
                    (intval($data['next_policy_statuses_id']) ? $data['next_policy_statuses_id']:POLICY_STATUSES_GENERATED));

        $this->add($data);
    }

    function continuePolicy($data) {//алгоритм Пролонгація полісу
        global $Log;

        $this->checkPermissions('continuePolicy', $data);

        $data['checkPermissions'] = 1;
        $data = $this->load($data, false);

        $data['blank_series_parent']        = $data['blank_series'];
        $data['blank_number_parent']        = $data['blank_number'];

        $data['parent_id'] = $data['id'];
        unset($data['id']);

        unset($data['blank_series']);
        unset($data['blank_number']);
        unset($data['stiker_series']);
        unset($data['stiker_number']);
        unset($data['begin_datetime']);
        unset($data['begin_datetime_day']);
        unset($data['begin_datetime_month']);
        unset($data['begin_datetime_year']);
        unset($data['end_datetime']);
        unset($data['end_datetime_day']);
        unset($data['end_datetime_month']);
        unset($data['end_datetime_year']);
        unset($data['begin_datetimeTimePicker']);
        unset($data['begin_datetimeHour']);
        unset($data['begin_datetimeMinute']);
        
        unset($data['payment_datetime']);
        unset($data['payment_datetime_day']);
        unset($data['payment_datetime_month']);
        unset($data['payment_datetime_year']);
        unset($data['payment_datetimePicker']);
        unset($data['payment_datetime_hour']);
        unset($data['payment_datetime_minute']);
        unset($data['payment_number']);

        unset($data['policy_statuses_id']);

        $data['amount_parent']          = $data['amount'];
        $data['next_policy_statuses_id']    = POLICY_STATUSES_CONTINUED;

        $this->add($data);
    }

    function getPayDissolutionInWindow($data)
    {
       $amount_return= $this->calculateamount_parent($data['id'],$data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day']);
       echo '{' .
               '"amount_return":"' . doubleval($amount_return) . '"}';
       exit;

    }


    function cancelPolicy($data) {//алгоритм прекращения действия полиса с выплатой остатка денег
        global $db, $Log;

        $this->checkPermissions('cancelPolicy', $data);


        $id=$data['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $interrupt_datetime = (checkdate($data['interrupt_datetime_month'], $data['interrupt_datetime_day'], $data['interrupt_datetime_year']))
                ? mktime(0, 0, 0, $data['interrupt_datetime_month'], $data['interrupt_datetime_day'], $data['interrupt_datetime_year'])
                : 0;
            if ($data['amount_return']=='')
                $Log->add('error', 'Не ввели сумму');
            if ($interrupt_datetime==0)
                $Log->add('error', 'Не ввели Дату');
                
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$Log->isPresent()) {

            $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                'policy_statuses_id = ' . POLICY_STATUSES_DISSOLVED . ',interrupt_datetime='.$db->quote($data['interrupt_datetime_year'].'-'.$data['interrupt_datetime_month'].'-'.$data['interrupt_datetime_day']).',modified=NOW() ' .
                'WHERE id = ' . intval($data['id']);
            $db->query($sql);

            //записать данные по удержанным деньгам
            $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                    'amount_return = ' . doubleval($data['amount_return']) . ' ' .
                    'WHERE id = ' . intval($data['id']);
            $db->query($sql);

            $Log->add('confirm', 'Дiю полiсу було успішно припинено.');

            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
            exit;
        }
        $data['id']=$id;
        $this->showForm($data, 'insert', null, 'goCancel.php') ;


    }


    function prepareValues($fields, $values) {
        global $REGIONS;


        foreach ($fields as $field) {
            switch ($field) {
                case 'insurer_address':
                    $values[ $field ] = Regions::getTitle($values['insurer_regions_id']);

                    if ($values['insurer_area']) {
                        $values[ $field ] .= ', ' . $values['insurer_area'] . ' р-н';
                    }

                    if (!in_array($values['insurer_regions_id'], $REGIONS)) {
                        $values[ $field ] .= ', ' . $values['insurer_city'];
                    }

                    $values[ $field ] .= ', ' . StreetTypes::getTitle($values['insurer_street_types_id']) . ' ' . $values['insurer_street'] . ', буд. ' . $values['insurer_house'];

                    if ($values['insurer_flat']) {
                        switch ($values['person_types_id']) {
                            case 1:
                                $values[ $field ] .= ', кв. ' . $values['insurer_flat'];
                                break;
                            case 2:
                                $values[ $field ] .= ', оф. ' . $values['insurer_flat'];
                                break;
                        }
                    }
                    break;
                case 'amount_number':
                    $values[ $field ] = substr($values['amount_go'], 0, strlen($values['amount_go']) - 3);
                    break;
                case 'amount_decimal':
                    $values[ $field ] = substr($values['amount_go'], strlen($values['amount_go']) - 2);
                    break;
                case 'payed':
                    $values[ $field ] = ($this->isPayedBypayment_statuses_id($values['payment_statuses_id']) || $values['special']) ? true : false;
                    break;
                case 'closed':
                    $values[ $field ] = $this->isClosedByPolicyStatusesId($values['policy_statuses_id']);
                    break;
                case 'cartypes':
                    $values['cartypes'] = array('A'=>'', 'B'=>'', 'C'=>'', 'D'=>'', 'E'=>'', 'F'=>'');

                    if ($values['types_id'] == 2) {//для 2 типа
                        switch( $values['car_types_id'] ) {
                            case '1':
                                $values['cartypes'] = array('A'=>'A', 'B'=>'B', 'C'=>'', 'D'=>'', 'E'=>'E', 'F'=>'F');
                                break;
                            case '3':
                                $values['cartypes'] = array('A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D', 'E'=>'E', 'F'=>'F');
                                break;
                            case '4':
                                $values['cartypes'] = array('A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'', 'E'=>'E', 'F'=>'F');
                                break;
                            default:
                                $values['cartypes'] = array('A'=>'', 'B'=>'', 'C'=>'', 'D'=>'', 'E'=>'', 'F'=>'');
                                break;
                        }
                    }
                    break;
            }
        }

        return $values;
    }

    function getValues($file) {
        global $db,$Authorization;

        $sql =  'SELECT a.*, b.*, c.*, d.title AS termsTitle, e.code AS engineSizesCode,d1.generali_branches_id,If(ag1.id>0,ag1.lastname,ag.lastname) as agents_lastname,If(ag1.id>0,ag1.firstname,ag.firstname) agents_firstname, f.code AS passengers_code, j.code AS car_weight_code, k.order_position AS regionsOrderPosition,CONCAT(ct.code,\' - \',ct.title) as car_types_title,date_format(b.date, \'' . DATE_FORMAT . '\') AS date '.
                ',date_format(otkdate, \'%Y\') AS otkdateYear, date_format(otkdate, \'%m\') AS otkdateMonth, date_format(otkdate, \'%d\') AS otkdateDay '.
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . $this->tables[0] . ' AS b ON a.policies_id = b.id ' .
                'JOIN ' . $this->tables[1] . ' AS c ON b.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_parameters_terms AS d ON c.terms_id = d.id ' .
                'JOIN ' . PREFIX . '_agencies AS d1 ON b.agencies_id = d1.id ' .
                'JOIN ' . PREFIX . '_accounts  AS ag ON ag.id = b.agents_id ' .
                'LEFT JOIN ' . PREFIX . '_accounts  AS ag1 ON ag1.id = b.seller_agents_id ' .
                'LEFT JOIN ' . PREFIX . '_car_types  AS ct ON ct.id = c.car_types_id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_engine_sizes AS e ON c.engine_sizes_id = e.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_passengers AS f ON c.passengers_id = f.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_car_weights AS j ON c.car_weights_id = j.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_regions AS k ON c.regions_id = k.id ' .
                'WHERE a.id=' . intval($file['id']);
        $row = $db->getRow($sql);

        
        $row['generali'] = $db->getRow('SELECT * FROM ' . PREFIX . '_generali_branches WHERE id = ' . intval($row['generali_branches_id']));
        if ($row['generali']['director1']) {
            $row['generali']['director1']=str_ireplace ( 'Директор' , '' , $row['generali']['director1'] );
        }

        if ($row['policy_statuses_id']==17 || $row['policy_statuses_id']==15) //пеерукладений||дубликат прочитать дату с исходного полиса
        {
            $row['date'] = $db->getOne('SELECT date FROM insurance_policies WHERE id='.intval($row['parent_id']));
        }

        if (strtotime($row["date"]) >= strtotime("2016-02-19")) {
            $row["limit_property"] = 100000;    
            $row["limit_life"] = 200000;
        }
        
        $sql =  'SELECT *, date_format(driver_licence_date, \'%Y\') AS driver_licence_date_year ' .
                'FROM ' . PREFIX . '_policies_go_persons ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $row['persons'] = $db->getAll($sql);

        switch ($row['product_document_types_id']) {
            case DOCUMENT_TYPES_POLICY_GO_POLICY1://полис ГО
                $fields = array(
                    'insurer_address',
                    'insurer_phone',
                    'insurerLicenceSeries',
                    'insurerLicenceNumber',
                    'insurerStandingYear',
                    'amount_number',
                    'amount_decimal',
                    'persons',
                    'cartypes',
                    'closed');
                break;
            case DOCUMENT_TYPES_POLICY_GO_POLICY2://полис ГО
                $fields = array(
                    'insurer_address',
                    'insurer_phone',
                    'insurerLicenceSeries',
                    'insurerLicenceNumber',
                    'insurerStandingYear',
                    'amount_number',
                    'amount_decimal',
                    'persons',
                    'cartypes',
                    'closed');
                break;
            case DOCUMENT_TYPES_POLICY_GO_BILL://счет ГО
                $fields = array(
                    'amount_number',
                    'amount_decimal',
                    'payed');
                break;
            default:
                $fields = array(
                    'insurer_address',
                    'insurer_phone',
                    'insurerLicenceSeries',
                    'insurerLicenceNumber',
                    'insurerStandingYear',
                    'amount_number',
                    'amount_decimal',
                    'persons',
                    'cartypes',
                    'closed');  
                break;                  
        }

        if (strtotime($row['date']) >= strtotime('2013-07-04')) {
            $row['new_director'] = 1;
        }
        $row['correction_go'] = 80+intval($Authorization->data['correction_go']);

        return $this->prepareValues($fields, $row);
    }

    function updatePayments($data) {
        global $db, $Log;

        if (is_uploaded_file($_FILES['file']['tmp_name']) &&
            $_FILES['file']['size'] &&
            ereg('\.xls$', $_FILES['file']['name'])) {

            require_once 'Excel/reader.php';

            $Excel = new Spreadsheet_Excel_Reader();
            $Excel->setOutputEncoding('utf-8');
            $Excel->read($_FILES['file']['tmp_name']);

            $PolicyPayments = new PolicyPayments($data);

            $updated        = 0;
            $alreadyPayed   = 0;
            $notValidated   = 0;
            $notPresent     = 0;
            $errorPayment   = 0;

            //проверяем полноту и последовательность колонок файла импорта
            if ($Excel->sheets[0]['cells'][1][1] == 'Серія' &&
                $Excel->sheets[0]['cells'][1][2] == 'Номер' &&
                $Excel->sheets[0]['cells'][1][3] == 'Фактично сплачено, грн.' &&
                $Excel->sheets[0]['cells'][1][4] == 'Дата сплати' &&
                $Excel->sheets[0]['cells'][1][5] == 'Документи') {

                $result =   '<table cellspacing="0" cellpadding="0" border="1">' .
                    '<tr>' .
                        '<td>' . $Excel->sheets[0]['cells'][1][1] . '</td>' .
                        '<td>' . $Excel->sheets[0]['cells'][1][2] . '</td>' .
                        '<td>' . $Excel->sheets[0]['cells'][1][3] . '</td>' .
                        '<td>' . $Excel->sheets[0]['cells'][1][4] . '</td>' .
                        '<td>' . $Excel->sheets[0]['cells'][1][5] . '</td>' .
                        '<td>Статус</td>' .
                        '<td>Коментар</td>' .
                    '</tr>';

                $blank_seriesOrderPosition = $this->getFieldPositionByName('blank_series');
                $blank_numberOrderPosition = $this->getFieldPositionByName('blank_number');

                for ($i=2; $i <= sizeOf($Excel->sheets[0]['cells']); $i++) {
                    //пишем лог по колонкам
                    $result .=  '<tr>' .
                                    '<td>' . $Excel->sheets[0]['cells'][ $i ][1] . '</td>' .
                                    '<td>' . $Excel->sheets[0]['cells'][ $i ][2] . '</td>' .
                                    '<td>' . $Excel->sheets[0]['cells'][ $i ][3] . '</td>' .
                                    '<td>' . $Excel->sheets[0]['cells'][ $i ][4] . '</td>' .
                                    '<td>' . $Excel->sheets[0]['cells'][ $i ][5] . '</td>';

                    //проверяем серию полиса на соотвествие формата
                    $params = array($Excel->sheets[0]['cells'][1][1], $languageDescription);
                    if ($Excel->sheets[0]['cells'][ $i ][1] == '') {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    } elseif (!ereg($this->formDescription['fields'][ $blank_seriesOrderPosition ]['validationRule'], $Excel->sheets[0]['cells'][ $i ][1])) {
                        $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                    }

                    //проверяем номер полиса на соотвествие формата
                    $params = array($Excel->sheets[0]['cells'][1][2], $languageDescription);
                    $blankNumber = $Excel->sheets[0]['cells'][ $i ][2];
                    if (strlen($blankNumber)==6) $blankNumber='0'.$blankNumber;
                    if ($blankNumber == '') {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    } elseif (!ereg($this->formDescription['fields'][ $blank_numberOrderPosition ]['validationRule'], $blankNumber)) {
                        $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                    }
                    

                    //проверяем стоимость полиса на соответствие формата
                    $params = array($Excel->sheets[0]['cells'][1][3], $languageDescription);
                    //_dump($Excel->sheets[0]['cells'][ $i ][3]);exit;
                    if (!$this->isValidMoney($Excel->sheets[0]['cells'][ $i ][3])) {
                        $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);//exit;
                    }

                    $data['datetime_day']    = intval(substr($Excel->sheets[0]['cells'][ $i ][4], 0, 2));
                    $data['datetime_month']  = intval(substr($Excel->sheets[0]['cells'][ $i ][4], 3, 2));
                    $data['datetime_year']   = intval(substr($Excel->sheets[0]['cells'][ $i ][4], 6, 4));
                    $data['datetime_hour']   = 0;
                    $data['datetime_minute'] = 0;

                    $params = array($Excel->sheets[0]['cells'][1][3], $languageDescription);
                    if (!checkdate($data['datetime_month'], $data['datetime_day'], $data['datetime_year'])) {
                        $Log->add('error', 'The date <b>%s</b>%s is not valid.', $params);
                    }
//_dump($data['datetimeMonth'].'-'.$data['datetimeDay'].'-'. $data['datetimeYear']);exit;
                    //проверка, если все ок c форматом данных
                    if (!$Log->isPresent()) {

                        //ищем полис
                        $conditions = array(
                            'b.blank_series = ' . $db->quote($Excel->sheets[0]['cells'][ $i ][1]),
                            'b.blank_number = ' . $db->quote($blankNumber));

                        $sql =  'SELECT a.id, a.amount, a.payment_statuses_id, b.insurer_identification_code ' .
                                'FROM ' . PREFIX . '_policies AS a ' .
                                'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                                'WHERE ' . implode(' AND ', $conditions);
                        $row =  $db->getRow($sql);

                        if (is_array($row)) {

                            //проверяем нашу стоимость полиса с тем, что нам подает Княжа
                            //if ($Excel->sheets[0]['cells'][ $i ][3] != $row['amount']) {
                            //    $Log->add('error', 'Вартість полісу не співпадає з вказанною вартістю!');
                            //}

                            //проверяем не был ли проплачен полис ранее
                            switch ($row['payment_statuses_id']) {
                                case PAYMENT_STATUSES_PARTIAL:
                                    $Log->add('payment', 'Поліс раніше був частково оплачен!');
                                    break;
                                case PAYMENT_STATUSES_PAYED:
                                    $Log->add('payment', 'Поліс раніше був оплачен!');
                                    break;
                                case PAYMENT_STATUSES_OVER:
                                    $Log->add('payment', 'Поліс раніше був переплачен!');
                                    break;
                            }

                            $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                                    'documents = ' . (($Excel->sheets[0]['cells'][ $i ][5] != '') ? 1 : 0) . ' ' .
                                    'WHERE id = ' . intval($row['id']);
                            //$db->query($sql);

                            //если все ок, можно инициировать внесение данных
                            if (!$Log->isPresent()) {

                                $data['policies_id'] = $row['id'];
                                $data['clients_id']  = $row['clients_id'];
                                $data['amount']     = $Excel->sheets[0]['cells'][ $i ][3];
                                
                                if (doubleval($data['amount'])>0)
                                $PolicyPayments->insert($data, false);

                                $Log->add('confirm', 'Дані були успішно збережені.');
                            }
                        } else {
                            $Log->add('empty', 'Поліс з вказанною серією та номером відсутній в базі!');
                        }
                    }

                    if ($_SESSION['log'][0]['text'] == 'Поліс раніше був оплачен!') {
                        $alreadyPayed++;
                        $result .= '<td>Помилка</td><td>' . $Log->getText() . '</td></tr>';
                    } elseif ($_SESSION['log'][0]['type'] == 'error') {
                        $notValidated++;
                        $result .= '<td>Помилка</td><td>' . $Log->getText() . '</td></tr>';
                    } elseif ($_SESSION['log'][0]['type'] == 'confirm') {
                        $updated++;
                        $result .= '<td>Збережено</td><td>' . $Log->getText() . '</td></tr>';
                    } elseif ($_SESSION['log'][0]['type'] == 'empty') {
                        $notPresent++;
                        $result .= '<td>Відсутній</td><td>' . $Log->getText() . '</td></tr>';
                    } elseif ($_SESSION['log'][0]['type'] == 'payment') {
                        $errorPayment++;
                        $result .= '<td>Помилка</td><td>' . $Log->getText() . '</td></tr>';
                    }

                    $Log->clear();
                }

                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/temp/log.xls', '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv=Content-Type content="text/html; charset=utf-8"><meta name=ProgId content=Excel.Sheet>' . $result . '</body></html>');

                $params = array($notValidated, $alreadyPayed, $notPresent, $errorPayment, $updated, $notValidate + $alreadyPayed + $notPresent + $errorPayment + $updated);

                $Log->add('confirm', 'Кількість полісів, що мають не вірний формат данних %s.<br />Кількість полісів, що були оплачені раніше %s.<br />Кількість полісів номера для яких відсутні %s.<br />Кількість полісів сплата за якими була неповна або переплата %s.<br />Кількість анкет для яких було вставновлно стан "Сплачено" %s.<br /><b>Всього оброблено %s. <a href="/temp/log.xls">Скачати файл змін</a>', $params);
            } else {
                $Log->add('error', 'The file\'s <b>%s</b>%s format is not valid.', array('Файл', $languageDescription));
            }

            header('Location: ' . $data['redirect']);
            exit;
        }

        include_once $this->object . '/payments.php';
    }

    function get($id) {
        global $db;

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies as a ' .
                'JOIN ' . PREFIX . '_policies_go as b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        return $db->getRow($sql);
    }

    //поиск договора страхования при заполении данных из заявления на страхование
    function getSearchInWindow($data) {
        global $db;

        $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
        $conditions[] = 'a.policy_statuses_id <> ' . POLICY_STATUSES_CREATED;
        $conditions[] = 'a.policy_statuses_id <> ' . POLICY_STATUSES_SPOILT;

        if (intval($data['policies_id'])) {
//            $conditions[] = 'a.id = ' . intval($data['policies_id']);
        }

        if ($data['number']) {
            $conditions[] = 'a.number = ' . $db->quote($data['number']);
        }

        if ($data['insurer_lastname']) {
            $conditions[] = 'insurer_lastname LIKE ' . $db->quote(str_replace('"', '%', $data['insurer_lastname']));
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

            $sql =  'SELECT a.number, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format, ' .
                    'date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS begin_datetime_format, date_format(a.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS interrupt_datetime_format, ' .
                    'b.policies_id, IF(b.person_types_id = 1, CONCAT(b.insurer_lastname, \' \', b.insurer_firstname, \' \', b.insurer_patronymicname), b.insurer_lastname) AS insurer, b.shassi, b.sign, ' .
                    'b.insurer_driver_licence_series, b.insurer_driver_licence_number, ' .
                    'CONCAT(c.title, \'/\', d.title) AS item, b.insurer_driver_licence_date ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                    'JOIN ' . PREFIX . '_car_brands as c ON b.brands_id = c.id ' .
                    'JOIN ' . PREFIX . '_car_models as d ON b.models_id = d.id ' .
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
                                        '<td align="center"><input id="policies_id" type="radio" name="policies_id" ' . (($data['policies_id'] == $row['policies_id']) ? 'checked' : '') . ' value="' . $row['policies_id'] . '" onclick="choosePolicy(' . $row['policies_id'] . ')" ' . $this->getReadonly(true) . ' /></td>' .
                                        '<td>' . $row['insurer'] . '</td>' .
                                        '<td><a href="/?do=Policies|view&id=' . $row['policies_id'] . '&product_types_id=' . PRODUCT_TYPES_GO . '" target="_blank">' . (($data['important_person'] == 0) ? $row['number'] : $row['number'] . ' <b style="color: red;">VIP</b>') . '</a></td>' .
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
                                                '<input type="hidden" name="policies_interrupt_datetime_format[' . $row['policies_id'] . ']" value="' . $row['interrupt_datetime_format'] . '" />' .
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
    
    function getApplicantValuesInWindow($data) {
        global $db;

//      $this->checkPermissions('view', $data);

        $conditions = array(PREFIX . '_policies_go.policies_id = ' . intval($data['id']));

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies_go ' .
                'WHERE ' . implode(' AND ', $conditions);

        $row = $db->getRow($sql);

        switch ($data['person']) {
            case 'insurer':

                $result = '{"person_types_id":"' . $row['person_types_id'] . '", ' .
                            '"car_types_id":"' . $row['car_types_id'] . '", ' .
                            '"brand":"' . $row['brand'] . '", ' .
                            '"brands_id":"' . $row['brands_id'] . '", ' .
                            '"model":"' . $row['model'] .  '", ' .
                            '"models_id":"' . $row['models_id'] .  '", ' .
                            '"shassi":"' . $row['shassi'] . '", '.
                            '"sign":"' . $row['sign'] . '", ' .
                            '"lastname":"' . $row[ $data['person'] . '_lastname'] . '",' .
                            '"firstname":"' . $row[ $data['person'] . '_firstname'] . '",' .
                            '"patronymicname":"' . $row[ $data['person'] . '_patronymicname'] . '",' .
                            '"identification_code":"' . $row[ $data['person'] . '_identification_code'] . '", ' .
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

    function exportToGeneraliInWindow($data) {
        global $db, $Smarty;

//      $conditions[] = 'a.policy_statuses_id IN(' . POLICY_STATUSES_GENERATED . ',' . POLICY_STATUSES_SPOILT . ',' . POLICY_STATUSES_CANCELLED . ',' . POLICY_STATUSES_COPY . ',' . POLICY_STATUSES_CONTINUED . ',' . POLICY_STATUSES_RENEW . ')';
//      $conditions[] = 'a.id IN (SELECT policies_id FROM ' . PREFIX . '_policy_status_changes WHERE policy_statuses_id <> ' . POLICY_STATUSES_CREATED . ' AND created >= ' . ($data['from'] ? $db->quote($data['from']) : $db->quote(date('Y-m-d'))).')';
//      $conditions[] = 'TO_DAYS(a.modified) = TO_DAYS(NOW()) - 1';
        $conditions[] = 'f.insurance_companies_id = ' . INSURANCE_COMPANIES_GENERALI;
        $conditions[] = 'a.date >= DATE_SUB(NOW(),INTERVAL 2 MONTH)';

        $sql =  'SELECT a.*, b.*, e.code,c.title AS policy_statuses_title, d.title AS insurer_regions_title,  IF(e1.id>0,e1.title,e.title) AS agencies_title, CONCAT(h.code, \'-\', h.title) AS car_types_title, k.title AS regions_title, k.order_position AS regions_number ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id = c.id ' .
                'JOIN ' . PREFIX . '_regions AS d ON b.insurer_regions_id = d.id ' .
                'JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id = e.id ' .
                'LEFT JOIN ' . PREFIX . '_agencies AS e1 ON e1.id = e.parent_id ' .
                'JOIN ' . PREFIX . '_policy_blanks AS f ON b.blank_series = f.series AND b.blank_number = f.number ' .
                'JOIN ' . PREFIX . '_car_types AS h ON b.car_types_id = h.id ' .
                'JOIN ' . PREFIX . '_parameters_regions AS k ON b.regions_id = k.id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $res = $db->query($sql);

        $i = 0;
        $list = array();
        while ($res->fetchInto($row)) {
            $list[ $i ] = $row;
            if ($list[ $i ]['types_id'] == 3 || ($list[ $i ]['person_types_id'] == 2 && $list[ $i ]['types_id'] == 2)) {
                $sql =  'SELECT * ' .
                        'FROM ' . PREFIX . '_policies_go_persons ' .
                        'WHERE policies_id=' . intval($list[ $i ]['policies_id']);
                $list[ $i ]['persons'] = $db->getAll($sql);
            }
            $i++;
        }

        $Smarty->assign('list', $list);
        $result['data'] = $Smarty->fetch($this->object . '/goGenerali.xml');
        $result['name'] = 'export.xml';

        header('Content-Disposition: attachment; filename="' . $result['name'] . '"');
        header('Content-Type: ' . $this->getContentType($result['name']));
        header('Content-Length: ' . strlen($result['data']));

        echo $result['data'];
        exit;
    }

    function exportToFTPInWindow($data) {
        global $Templates;

        $url = 'https://' . $_SERVER['HTTP_HOST'] . '/index.php?do=Policies|exportToGeneraliInWindow&product_types_id=4';

        if ($data['from']) {
            $url .= '&from=' . $data['from'];
        }

        if ($data['to']) {
            $url .= '&to=' . $data['to'];
        }

        $result = file_get_contents($url);

        $file = date('Ymd', mktime(0, 0, 0, date('m'), date('d')-1, date('Y'))).'go.xml';

        $handle = fopen('/var/www/exchange/' . $file, 'wb');

        if (!$handle) {
            $result = 'Can\'t create file';
        } elseif (!fwrite($handle, $result)) {
            $result = 'Can\'t write to file';
        } else {
            $result = 'Policies go have been exported to Generali';
            fclose($handle);
        }

        $Templates->send('', $data, null, $result, null, '', '');

        echo $result;
    }

    function changeServicePersonInWindow($data) {
        global $db, $Log;

        if (true || $this->canChangeServicePerson($data['id'])) {


            $sql =  'SELECT products_id, date, agencies_id,a.manager_id,a.seller_agents_id,b.discount,a.agencies_id,a1.individual_motivation ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
                    'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                    'WHERE a.id = ' . intval($data['id']);
            $row =  $db->getRow($sql);

            $Products = Products::factory($data, 'GO');
            $commissions = $Products->getCommissions($row['products_id'], $row['date'], $row['agencies_id'],$row['discount']);
            //тут доп преобразования комиссии
            if ($row['manager_id'] && intval($row['manager_id']) > 0) //выбрали менеджера що привiв клиента но не для отдела продаж
            {

                $sqlTemper = 'SELECT allcomission as allfullcomission 
                FROM insurance_agents WHERE allcomission = 1 
                and accounts_id = ' . intval($row['manager_id']);

                $rowTemper = $db->getRow($sqlTemper);

                if ($row['agencies_id']!=1469 && $row['individual_motivation'] == 0 && !$rowTemper['allfullcomission'])
                {
                    $commissions['commission_agent_percent'] = $commissions['commission_agent_percent']/2;
                }
            }
            else {
                $commissions['commission_manager_percent'] = 0;
            }
            
            if (!$row['seller_agents_id']) //не выбрали продающего в агенции
            {
                $commissions['commission_seller_agents_percent'] = 0;
            }
            if ($row['seller_agents_id'] && $row['manager_id']>0) {
                $commissions['commission_seller_agents_percent'] = $commissions['commission_seller_agents_percent']/8*5;
            }
             
            

            $sql =  'UPDATE ' . PREFIX . '_policies_go SET ' .
                    'commission_agency_percent = ' . $db->quote($commissions['commission_agency_percent']) . ', ' .
                    'commission_agent_percent = ' . $db->quote($commissions['commission_agent_percent']) . ', ' .
                    'commission_financial_institution_percent = ' . $db->quote($commissions['commission_financial_institution_percent']) . ', ' .
                    'commission_manager_percent = ' . $db->quote($commissions['commission_manager_percent']) . ', ' .
                    'commission_seller_agents_percent = ' . $db->quote($commissions['commission_seller_agents_percent']) . ',  ' .
                    
                    'director1_commission_percent = ' . $db->quote($commissions['director1_commission_percent']) . ', ' .
                    'director2_commission_percent = ' . $db->quote($commissions['director2_commission_percent']) . ' ' .
                    
                    'WHERE policies_id = ' . intval($data['id']);
            $db->query($sql);

            $this->setCommissions($data['id']);

            $Log->add('confirm', 'Предстаника СТО було успішно змінено. Комісійна винагорода перерахована.');
        }

        echo $Log->getText(' ');
        $Log->clear();
        //exit;
    }

    function canChangePolicy($policies_id) {
        global $db;

        $sql =  'SELECT UNIX_TIMESTAMP( mtsbu_date ) + UNIX_TIMESTAMP( buh_date ) ' .
                'FROM ' . PREFIX . '_policies_go AS a ' .
                'JOIN ' . PREFIX . '_policy_blanks AS b ON a.blank_series = b.series AND a.blank_number = b.number ' .
                'WHERE a.policies_id = ' . intval($policies_id);
        return ( intval($db->getOne($sql)) > 0) ? false : true;
    }

    function changeSignInWindow($data) {
        global $db, $Log;

        //if ($this->canChangePolicy($data['id'])) {
          if ($data['sign']) {
            $data['sign'] = htmlspecialchars($this->replaceTags(trim($data[ 'sign' ])));
            $data['sign'] = fixSignSimbols($data['sign'] );

            if (isValidSign($data['sign'])) {
                $sql =  'UPDATE ' . PREFIX . '_policies_go SET ' .
                        'sign = ' . $db->quote($data['sign']) . ' ' .
                        'WHERE policies_id = ' . intval($data['id']);
                $db->query($sql);

                $Log->add('confirm', 'Державний знак було змiнено');
            }
            else
                $Log->add('error', 'Формат державного знаку невiрний');
          }
          else
            $Log->add('error', 'Не введено державний знак');
        /*}
        else
            $Log->add('error', 'Редагування полiсу заборонено');*/

        echo $Log->getText(' ');
        $Log->clear();
        //exit;
    }

    
    function getLink($text,$fieldName,$fieldType)
    {
        global $Authorization;
        
        $reset = false;
        
        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $reset = true;
                break;
            case ROLES_MANAGER:
                    $reset =($Authorization->data['permissions']['Policies_GO']['update']) ? true : false;

                break;
        }
        if ($this->mode == 'update') $reset = false;
        if (!$reset) return $text;
        return '<a itemid="'.$fieldName.'" fieldtype="'.$fieldType.'" class="changeval" href="#inlinecontent">'.$text.'</a>';
    }
    
     function changePolicyInWindow($data) {
        global $db,$Authorization;

        $row = $db->getRow('SELECT * FROM '.PREFIX.'_policies WHERE id='.intval($data['policies_id']));
        $err_msg = '';
        if (!$this->canChangePolicy($data['policies_id']))
        {
            $err_msg .= ' Редагування полiсу заборонено.';
        }
        if (($data['policy_statuses_id']==POLICY_STATUSES_RENEW || $data['policy_statuses_id']==POLICY_STATUSES_COPY )
            && (   strlen($data['blank_series_parent'])<2
                || strlen($data['blank_number_parent'])<7
                || !PolicyBlanks::get($data['blank_series_parent'], $data['blank_number_parent'],$row['insurance_companies_id'])
                || !$db->getRow('SELECT * FROM '.PREFIX.'_policies WHERE number='.$db->quote($data['blank_series_parent'].'-'.$data['blank_number_parent']))
                )
            ) //переукладений
        {
            $err_msg .= ' Для статусу Переукладений необхiдно вказати Серiю та Номер оригiналу iснуючого полiсу.';
        }
        if ($data['policy_statuses_id']==POLICY_STATUSES_RENEW &&
            !in_array ( $row['policy_statuses_id'] , array(POLICY_STATUSES_GENERATED,POLICY_STATUSES_RENEW)))
        {
            $err_msg.= ' Переукласти можна полiс у статусах Сформований або Переукладений';
        }

        if (($Authorization->data['roles_id']==ROLES_ADMINISTRATOR || $Authorization->data['permissions']['Policies_GO']['update']) && !$err_msg)
        {
            //обновить выборочные поля в полисе и регенерировать шаблоны
            $data['id'] = $data['policies_id'];
            
            if (isset($data['end_datetime'])) $data['interrupt_datetime'] = $data['end_datetime'];
            foreach ($data as $key=>$val)
            {
                if ($key == 'product_types_id') continue;
                
                if (!is_array($val) &&  $this->getFieldPositionByName($key)>0 )
                {
                    $field = $this->formDescription['fields'][ $this->getFieldPositionByName($key) ];
                    
                    if ($field['table']=='policies_go') $identity_field='policies_id';
                    else $identity_field='id'; 
                    
                    if ($field['type']==fldDate)
                    {
                      $val  = substr($val, 6, 4) .'-'. substr($val, 3, 2) .'-'. substr($val, 0, 2);
                    }
                    elseif ($field['type']==fldDateTime)
                    {
                      $val  = substr($val, 6, 4) .'-'. substr($val, 3, 2) .'-'. substr($val, 0, 2).' '.substr($val, 11, 2).':'.substr($val, 14, 2);
                    }
                    
                    $sql='UPDATE  '.PREFIX.'_'. $field['table'].' SET '.$field['name'].'='.$db->quote($val).' WHERE '.$identity_field.'='.intval($data['id']);
                    
                    $db->query($sql);
                }
                
            }
            
            if (strlen($data['blank_series_parent'])>=2
                || strlen($data['blank_number_parent'])>=7)
            {
                $sql='UPDATE '.PREFIX.'_policies_go a JOIN '.PREFIX.'_policies b ON b.id=a.policies_id SET b.child_id='.intval($data['id']).' WHERE a.blank_series='.$db->quote($data['blank_series_parent']).' AND blank_number='.$db->quote($data['blank_number_parent']).' ';
                $db->query($sql);
                $policies_id=$db->getOne('SELECT policies_id FROM '.PREFIX.'_policies_go a WHERE a.blank_series='.$db->quote($data['blank_series_parent']).' AND blank_number='.$db->quote($data['blank_number_parent']).' ');
                $sql='UPDATE '.PREFIX.'_policies SET parent_id='.intval($policies_id).',top='.intval($policies_id).' WHERE id='.intval($data['id']);
                $db->query($sql);
            }

            if (!$this->isInAct($data['id']))
            {
                $PolicyPaymentsCalendar=new PolicyPaymentsCalendar($data);
                $PolicyPaymentsCalendar->updateCalendar($data['policies_id']);
                $PolicyPaymentsCalendar->setPaymentStatuses($data['policies_id']);
                $this->setCommissions($data['policies_id']);
            }
            PolicyDocuments::generateTemplates($data['policies_id'], null, true);
            echo 'Готово'; exit;
        }
        echo 'Помилка '.$err_msg;
        exit;
    }
    
    function fillAktNumbersAgencies($data) {
    
    }

    //Export 1C 7.7
     function getXML($data) {
        global $db, $Smarty;

      if ($data['number']) {
            $conditions[] = 'a.number=' . $db->quote($data['number']);
        } else {
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.date )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.date )>=TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.date )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.date ) <= TO_DAYS(NOW())';

            //$conditions[] = ($data['from']) ? 'TO_DAYS(a.begin_datetime )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.begin_datetime )>=TO_DAYS(NOW())';
            //$conditions[] = ($data['to']) ? 'TO_DAYS(a.begin_datetime )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.begin_datetime ) <= TO_DAYS(NOW())';


            $conditions[] = 'a.policy_statuses_id NOT IN (14,18,1,19)';
        }
        $conditions[] = 'f.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;

        $sql =  'SELECT a.*, b.*, e.code,c.title AS policy_statuses_title, d.title AS insurer_regions_title,  IF(e1.id>0,e1.title,e.title) AS agencies_title,IF(e1.id>0,e1.edrpou,e.edrpou) AS agencyedrpou, CONCAT(h.code, \'-\', h.title) AS car_types_title, k.title AS regions_title, k.order_position AS regions_number ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id = c.id ' .
                'JOIN ' . PREFIX . '_regions AS d ON b.insurer_regions_id = d.id ' .
                'JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id = e.id ' .
                'LEFT JOIN ' . PREFIX . '_agencies AS e1 ON e1.id = e.parent_id ' .
                'JOIN ' . PREFIX . '_policy_blanks AS f ON b.blank_series = f.series AND b.blank_number = f.number ' .
                'JOIN ' . PREFIX . '_car_types AS h ON b.car_types_id = h.id ' .
                'JOIN ' . PREFIX . '_parameters_regions AS k ON b.regions_id = k.id ' .
                'WHERE ' . implode(' AND ', $conditions).' ORDER BY a.date';
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
        return  $Smarty->fetch($this->object . '/go.xml');
    }

     function change($data, $redirect = true) {
        global $db, $Log;
        if (!isset($data['redirect']))
        {
            $data['redirect']='index.php?do=Policies|show&product_types_id='.$data['product_types_id'];
            if ($data['number']) $data['redirect'].='&number='.$data['number'];
            if ($data['insurer']) $data['redirect'].='&insurer='.$data['insurer'];
            if ($data['from']) $data['redirect'].='&from='.$data['from'];
            if ($data['to']) $data['redirect'].='&to='.$data['to'];

            if ($data['insurance_companies_id']) $data['redirect'].='&insurance_companies_id='.$data['insurance_companies_id'];
            if ($data['special']) $data['redirect'].='&special='.$data['special'];
            if ($data['options_test_drive']) $data['redirect'].='&options_test_drive='.$data['options_test_drive'];
            if ($data['options_race']) $data['redirect'].='&options_race='.$data['options_race'];
            if ($data['agencies_id']) $data['redirect'].='&agencies_id='.$data['agencies_id'];
            if ($data['financial_institutions_id']) $data['redirect'].='&financial_institutions_id='.$data['financial_institutions_id'];
        }
         
        $this->checkPermissions('change', $data);

        $this->setChangeFields();

        $ids = array();

        if (is_array($this->changeFields) && sizeOf($this->changeFields) > 0 &&
            is_array($data[$this->changeFields[0]['name'] . 'Hidden']) && sizeOf($data[$this->changeFields[0]['name'] . 'Hidden']) > 0) {

            $modified = $this->formDescription['fields'][ $this->getFieldPositionByName('modified') ];

            foreach($data[$this->changeFields[0]['name'] . 'Hidden'] as $id => $value) {
                /*if (intval($data['documents'][$id])>0) //проверить чтобы был в акте
                {
                    if (!intval($db->getOne('SELECT a.policies_id FROM insurance_policies_go a
                     JOIN insurance_policy_blanks b ON b.series=a.blank_series AND  b.number=a.blank_number
                     JOIN insurance_policy_return_blanks_akts_contents c ON c.policy_blanks_id = b.id
                     JOIN insurance_policy_return_blanks_akts d on d.id=c.akts_id
                     WHERE a.policies_id='.intval($id).' AND d.statuses_id=2'))) continue;

                }*/
                $sql = $this->buildChangeSQL($data, $id);
                $db->query($sql);

                if ($db->affectedRows()) {
                    $ids[] = $id;

                    if ($modified) {
                        $sql = 'UPDATE ' . PREFIX . '_' . $modified['table'] . ' SET modified = NOW() WHERE id = ' . intval($id);
                        $db->query($sql);
                    }
                }
            }

            if ($redirect) {
                $params['title'] = $this->messages['plural'];
                $params['storage'] = $this->tables[0];
                $Log->add('confirm', $this->messages['change']['confirm'], $params, '', true);
            }
        }

        if ($redirect) {
            ($data['redirect'])
                ? header('Location: ' . $data['redirect'])
                : header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        return $ids;
    }
    
    function getBonusMalusInWindow($data)
    {
        global $db;
        $shassi = $data['shassi'];
        $insurer_identification_code = $data['insurer_identification_code'];
        $insurer_edrpou = $data['insurer_edrpou'];
        

        if ($data['renewPolicy']==1) {
            $data['bonus_malus_id'] = $db->getOne('SELECT b.bonus_malus_id FROM ' . PREFIX . '_policies a JOIN ' . PREFIX . '_policies_go b on b.policies_id=a.id WHERE id = ' . intval($data['parent_id']));
        }
        else {
            $data['bonus_malus_id'] = 5;
            $data['bonus_malus_value'] = 3;
            if (strlen($shassi)>5 && (strlen($insurer_identification_code)>=8 || strlen($insurer_edrpou)>=5)) {
                $s = 'c.insurer_identification_code = ' . $db->quote($insurer_identification_code) . ' ';
                if (strlen($insurer_edrpou)>=5)
                    $s = 'c.insurer_edrpou = ' . $db->quote($insurer_edrpou) . ' ';
                $sql =  'SELECT a.id, DATEDIFF(NOW(),a.date)+30 AS days ' .
                        'FROM ' . PREFIX . '_accidents AS a ' .
                        'JOIN ' . PREFIX . '_accidents_go AS b ON b.accidents_id=a.id ' .
                        'JOIN ' . PREFIX . '_policies_go AS c ON a.policies_id = c.policies_id ' .
                        'WHERE '.$s.' AND c.shassi = ' . $db->quote($shassi) . ' ' .
                        'ORDER BY days ASC ' .
                        'LIMIT 1';
                $accidents = $db->getRow($sql);

                $years = 0;
                if (!$accidents) {// не было событий ищем самый ранний полис
                    $sql =  'SELECT a.id,DATEDIFF(NOW(), a.begin_datetime)+180 AS days ' .
                            'FROM ' . PREFIX . '_policies AS a ' .
                            'JOIN ' . PREFIX . '_policies_go AS c ON a.id = c.policies_id ' .
                            'WHERE a.insurance_companies_id=4 AND a.payment_statuses_id > 1 AND c.shassi=' . $db->quote($shassi) . ' AND '. $s.' ' .
                            'ORDER BY a.begin_datetime ' .
                            'LIMIT 1';
                    $policies = $db->getRow($sql);

                    if ($policies)
                        $years=(int)($policies['days']/365);
                } else {
                    $years = (int)($accidents['days']/365);
                }

                if ($years>=1) {$data['bonus_malus_id'] = 6;$data['bonus_malus_value'] = 4;}
                if ($years>=2) {$data['bonus_malus_id'] = 7;$data['bonus_malus_value'] = 5;}
            }
            if (intval($data['id'])>0) { //полис уже есть прочитатть текущий бонус малус
                $bonus_malus_id = intval($db->getOne('SELECT bonus_malus_id FROM ' . PREFIX . '_policies_go WHERE policies_id='.intval($data['id'])));
                if ($bonus_malus_id>0 && $bonus_malus_id>$data['bonus_malus_id']) {
                    $data['bonus_malus_id'] = $bonus_malus_id;
                    $data['bonus_malus_value'] = $db->getOne('SELECT title FROM insurance_parameters_bonus_malus WHERE id='.$data['bonus_malus_id']);
                }
            }
        }
        echo '{"bonus_malus_id":"' . intval($data['bonus_malus_id']) . '", "bonus_malus_value":"' . intval($data['bonus_malus_value']) . '"}';
        exit;       
    }
    
    function importMTSBU($data) {
        global $db, $Log;
        
        $spoilt_policies = array();
        $no_report_policies = array();
        $import_policies = array();
        
        foreach ($data['id'] as $id) {
            if ($this->getPolicyStatusesId($id) == POLICY_STATUSES_SPOILT) {
                //$spoilt_policies[] = $id;
            } elseif (PolicyBlanks::getMtsbuDateByPoliciesId($id) == '0000-00-00') {
                $no_report_policies[] = $id;
            } else {
                $import_policies[] = $id;
            }
        }
        
        if (is_array($spoilt_policies) && sizeof($spoilt_policies)) {
            $Log->add('error', 'Зіпсовані бланки імпортувати заборонено');
        }
        
        if (is_array($no_report_policies) && sizeof($no_report_policies)) {
            $sql = 'SELECT CONCAT(policy_blanks.series, \'-\', policy_blanks.number) as policies_number ' . 
                   'FROM ' . PREFIX . '_policy_blanks as policy_blanks ' .
                   'JOIN ' . PREFIX . '_policies_go as policies_go ON policy_blanks.series = policies_go.blank_series AND policy_blanks.number = policies_go.blank_number ' .
                   'WHERE policies_go.policies_id IN (' . implode(', ', $no_report_policies) . ')';
            $temp = $db->getCol($sql);
            $Log->add('error', 'Невідзвітовані поліси імпортувати заборонено - ' . implode(', ', $temp));
        }       
        
        if (is_array($import_policies) && sizeof($import_policies)) {
            $sql = 'SELECT policy_blanks.id ' . 
                   'FROM ' . PREFIX . '_policy_blanks as policy_blanks ' .
                   'JOIN ' . PREFIX . '_policies_go as policies_go ON policy_blanks.series = policies_go.blank_series AND policy_blanks.number = policies_go.blank_number ' .
                   'WHERE policies_go.policies_id IN (' . implode(', ', $import_policies) . ')';
            $temp = $db->getCol($sql);
            
            $sql = 'UPDATE ' . PREFIX . '_policy_blanks SET mtsbu_import_sign = 1 WHERE id IN (' . implode(', ', $temp) . ')';
            $db->query($sql);
            
            $sql = 'SELECT CONCAT(policy_blanks.series, \'-\', policy_blanks.number) as policies_number ' . 
                   'FROM ' . PREFIX . '_policy_blanks as policy_blanks ' .
                   'JOIN ' . PREFIX . '_policies_go as policies_go ON policy_blanks.series = policies_go.blank_series AND policy_blanks.number = policies_go.blank_number ' .
                   'WHERE policies_go.policies_id IN (' . implode(', ', $import_policies) . ')';
            $temp = $db->getCol($sql);
            $Log->add('confirm', 'Поліси ' . implode(', ', $temp) . ' додані до списку імпорту в МТСБУ.');
        }
        
        header('Location: ' . $data['redirect']);
    }
    
    function setOldRateInWindow($data) {
        global $db,$Authorization;
        if ($Authorization->data['permissions']['Policies_KASKO']['superupdate'] || $Authorization->data['roles_id']==ROLES_ADMINISTRATOR) {
            $number = $db->getOne('select number from insurance_policies where id='.intval($data['id']));
            if ($number) {
                $sql='
                        update insurance_policies a
                        join  insurance_policies_go b on b.policies_id=a.id
                        set 
                        b.products_id=1
                        where  a.id='.intval($data['id']);
                        $db->query($sql);
                        echo '{"text":"Готово"}';   
                        exit;
            }
            
        }
        echo '{"text":"Ошибка"}';   
        exit;
    }
    
}

?>
