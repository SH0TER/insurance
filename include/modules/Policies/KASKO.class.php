<?
/*
 * Title: policy KASKO class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Products.class.php';
require_once 'Products/KASKO.class.php';
require_once 'PolicyDocuments.class.php';
require_once 'FinancialInstitutions.class.php';
require_once 'Axapta.class.php';
    
class Policies_KASKO extends Policies {

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
                            'showId'            => true,
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
                            'orderPosition'     => 17,
                            'table'             => 'policies',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'id'),
                            
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
                            'table'             => 'policies_kasko'),
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
                                    'view'      => false,
                                    'update'    => true
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
                                                    INSURANCE_COMPANIES_GENERALI => 'ВАТ «УСК «Гарант-Авто»'),
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
                            'name'              => 'express_products_id',
                            'description'       => 'Экспрес продукт',
                            'type'              => fldSelect,
                            'showId'            => true,
                            'list'              => array(
                                                    110 => '«КОМФОРТ»',
                                                    PRODUCT_KASKO3 => '«ПРЕМІУМ»',
                                                    138 => '«СЕЗОН+»',
                                                    599 => '«КАСКО. ОПТИМАЛЬНЕ»',
                                                    684 => '«КАСКО Mini»',
                                                    673 => '«КАСКО. VIP»',
                                                    PRODUCT_KASKO_TESTDRIVE1 => 'Тест Драйв.Тип1',
                                                    PRODUCT_KASKO_TESTDRIVE2 => 'Тест Драйв.Тип2',
                                                    PRODUCT_KASKO_TESTDRIVE3 => 'Тест Драйв.Тип3',
                                                    PRODUCT_KASKO_TESTDRIVE4 => 'Тест Драйв.Тип4',
                                                    753 => 'Тест Драйв.Ducati',
                                                    /*137 => 'Оптимальний. Ідея Банк',
                                                    288 => 'Легкий. Ідея Банк',*/
                                                    686 => 'Ducati 3 в 1',
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
                            'table'             => 'policies_kasko'),   
                            
                        array(
                            'name'              => 'owner_person_types_id',
                            'description'       => 'Власник Тип особи',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'insurer_person_types_id',
                            'description'       => 'Страхувальник, тип особи',
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
                            'table'             => 'policies_kasko'),
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
                            'name'              => 'item',
                            'description'       => 'Об\'єкт',
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
                            'orderPosition'     => 5,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'driver_standings_id',
                            'description'       => 'Мінімальний водійський стаж з усіх, хто буде керувати автомобілем',
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
                            'table'             => 'policies_kasko',
                            'condition'         => 'product_types_id = 3',
                            'sourceTable'       => 'parameters_driver_standings',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'drivers_id',
                            'description'       => 'Кількість осіб',
                            'type'              => fldSelect,
                            'condition'         => 'product_types_id = 3',
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
                            'table'             => 'policies_kasko',
                            'sourceTable'       => 'parameters_drivers',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'driver_ages_id',
                            'description'       => 'Мінімальний вік водія з усіх, хто буде керувати автомобілем',
                            'type'              => fldSelect,
                            'showId'             => true,
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
                            'table'             => 'policies_kasko',
                            'sourceTable'       => 'parameters_driver_ages',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'payment_brakedown_id',
                            'description'       => 'Кiлькiсть платежiв',
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko',
                            'sourceTable'       => 'financial_institutions',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'zones_id',
                            'description'       => 'Зона дії полісу',
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
                            'table'             => 'policies_kasko',
                            'sourceTable'       => 'parameters_zones',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
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
                            'table'             => 'policies_kasko'),
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
                        array(
                            'name'              => 'certificateTenPercent',
                            'description'       => 'Номер сертифiкату знижка КАСКО 10% (4 знаки)',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'priority_payments_id',
                            'description'       => 'Пріоритет виплати', 
                            'type'              => fldRadio,
                            'showId'            => true,
                            'list'              => array(
                                                        1 => 'СТО',
                                                        2 => 'експертиза'),
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'residences_id',
                            'description'       => 'Місце зберігання ТЗ',
                            'type'              => fldRadio,
                            'showId'            => true,
                            'list'                => array(
                                                        1 => 'стоянка що охороняється',
                                                        2 => 'будь-яке місце'),
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'terms_id',
                            'description'       => 'Термін страхування',
                            'type'              => fldSelect,
                            'showId'            => true,
                            'condition'         => 'product_types_id = 3 AND id IN(26,27,28,29,40,41,42,43,44,45,46,47,48,49,54)',
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
                            'table'             => 'policies_kasko',
                            'sourceTable'       => 'parameters_terms',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
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
                                                        8 => '8-років'
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
                            'table'             => 'policies_kasko'),
                         array(
                            'name'              => 'flayer',
                            'description'       => 'Акция НС',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'cons_agents_id',
                            'description'       => 'Агент консультация',
                            'type'              => fldSelect,
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
                            'table'             => 'policies',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'id'),   
                        array(
                            'name'              => 'options_deterioration_no',
                            'description'       => 'без врахування зносу',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'options_deductible_glass_no',
                            'description'       => 'без франшизи на вітрові стекла',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'options_first_accident',
                            'description'       => 'перший страховий випадок',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'options_season',
                            'description'       => 'сезон',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'options_workers_list',
                            'description'       => 'водії підприємства згідно наказу',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'options_fifty_fifty',
                            'description'       => '50 на 50',
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
                            'table'             => 'policies_kasko'),
                        /*array(
                            'name'              => 'mileage_car_id',
                            'description'       => 'Пробіг автомобіля',
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
                            'table'             => 'policies_kasko',
                            'sourceTable'       => 'parameters_mileage_car',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),*/
                        array(
                            'name'              => 'options_holiday',
                            'description'       => 'вихідний день',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'options_work',
                            'description'       => 'робочий день',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'options_taxy',
                            'description'       => 'страхування таксі',
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
                            'table'             => 'policies_kasko'),
                         array(
                            'name'              => 'options_test_drive',
                            'description'       => 'страхування тест драйву',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'options_race',
                            'description'       => 'страхування тест драйву',
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
                            'table'             => 'policies_kasko'),
                        
                        array(
                            'name'              => 'options_agregate_no',
                            'description'       => 'неагрегатна страхова сума',
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),   
                        array(
                            'name'              => 'options_years',
                            'description'       => 'страхування ТЗ віком більше 8 років',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'options_month500',
                            'description'       => 'місяць страхування за 500 грн',
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
                            'table'             => 'policies_kasko'),   
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'description'       => 'Максимальный Бонус-малус',
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_company',
                            'description'       => 'Власник, компанiя',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_edrpou',
                            'description'       => 'Власник, ЄДРПОУ',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_lastname',
                            'description'       => 'Власник, прізвище',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_firstname',
                            'description'       => 'Власник, ім\'я',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_patronymicname',
                            'description'       => 'Власник, по батькові',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_position',
                            'description'       => 'Власник, посада',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_ground',
                            'description'       => 'Власник, діє на підставі',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_dateofbirth',
                            'description'       => 'Власник, дата народження',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_passport_series',
                            'description'       => 'Власник, паспорт, серія',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_passport_number',
                            'description'       => 'Власник, паспорт, номер',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_passport_place',
                            'description'       => 'Власник, паспорт, ким і де виданий',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_passport_date',
                            'description'       => 'Власник, паспорт, дата видачі',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_identification_code',
                            'description'       => 'Власник, ІПН',
                            'type'              => fldText,
                            'maxlength'         => 10,
                            'validationRule'    => '^[0-9А-Я]{10}$',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_phone',
                            'description'       => 'Власник, телефон',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_email',
                            'description'       => 'Власник, e-mail',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_regions_id',
                            'description'       => 'Власник, область',
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
                            'table'             => 'policies_kasko',
                            'sourceTable'       => 'regions',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'owner_area',
                            'description'       => 'Власник, район',
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
                        array(
                            'name'              => 'owner_city',
                            'description'       => 'Власник, місто',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_street_types_id',
                            'description'       => 'Власник, тип вулицi',
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
                            'table'             => 'policies_kasko',
                            'sourceTable'       => 'street_types',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),   
                        array(
                            'name'              => 'owner_street',
                            'description'       => 'Власник, вулиця',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_house',
                            'description'       => 'Власник, будинок',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_flat',
                            'description'       => 'Власник, квартира',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_bank',
                            'description'       => 'Власник, банк',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_bank_mfo',
                            'description'       => 'Власник, МФО',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_bank_account',
                            'description'       => 'Власник, банкiвський рахунок',
                            'type'              => fldText,
                            'maxlength'         => 14,
                            'validationRule'    => '^([0-9]{9,14})$',
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'insurer_edrpou',
                            'description'       => 'Страхувальник, ЄДРПОУ',
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
                        
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'propertyplace',
                            'description'       => 'Адреса місцязнаходження майна',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko'),   
                        array(
                            'name'              => 'startplace',
                            'description'       => 'Пункт відправки',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko'),   
                        array(
                            'name'              => 'endplace',
                            'description'       => 'Пункт прибуття',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko'),   
                        array(
                            'name'              => 'testdriveroad',
                            'description'       => 'Автомобільна траса',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko'),   
                        array(
                            'name'              => 'testdrivecities',
                            'description'       => 'Міста, розташовані за маршрутом руху',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko'),   
                        array(
                            'name'              => 'insurer_position1',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'insurer_driver_licence_series',
                            'description'       => 'Страхувальник, водійські права, серія',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'insurer_driver_licence_number',
                            'description'       => 'Страхувальник, водійські права, номер',
                            'type'              => fldText,
                            'maxlength'         => 9,
                            'validationRule'    => '(^[0-9]{6}$)|(^[0-9]{9}$)',
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
                        array(
                            'name'              => 'insurer_driver_licence_date',
                            'description'       => 'Страхувальник, водійські права, дата',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'insurer_identification_code',
                            'description'       => 'Страхувальник, ІПН',
                            'type'              => fldText,
                            'maxlength'         => 10,
                            'validationRule'    => '^[0-9А-Я]{10}$',
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko',
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko',
                            'sourceTable'       => 'street_types',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
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
                            'table'             => 'policies_kasko'),
                    
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'insurer_bank_account',
                            'description'       => 'Страхувальник, банкiвський рахунок',
                            'type'              => fldText,
                            'maxlength'         => 14,
                            'validationRule'    => '^([0-9]{9,14})$',
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
                            'table'             => 'policies_kasko'),
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
                            'showId'            => true,
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
                            'table'             => 'policies_kasko'),   
                        array(
                            'name'              => 'give_a_statement',
                            'description'       => 'Подаю виписку або витяг з Єдиного державного реєстру юридичних осіб та фізичних осіб - підприємців',
                            'type'              => fldRadio,
                            'showId'            => true,
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
                            'table'             => 'policies_kasko'),   
                        array(
                            'name'              => 'civil_servant',
                            'description'       => 'Я є особою, яка обіймає посаду державного службовця...',
                            'type'              => fldRadio,
                            'showId'            => true,
                            'list'                => array(
                                                        1 => 'додаю',
                                                        2 => 'заповнюю',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'not_civil_servant',
                            'description'       => 'Я не відношусь до таких осіб та вважаю цю інформацію про фінансовий стан відкритою та додаю податкову декларацію встановленого зразка...',
                            'type'              => fldRadio,
                            'showId'            => true,
                            'list'                => array(
                                                        1 => 'додаю',
                                                        2 => 'заповнюю',
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
                            'table'             => 'policies_kasko'),   
                        array(
                            'name'              => 'public_figure',
                            'description'       => 'Я не відношусь до таких осіб та вважаю цю інформацію про фінансовий стан відкритою та додаю податкову декларацію встановленого зразка...',
                            'type'              => fldRadio,
                            'showId'            => true,
                            'list'                => array(
                                                        1 => 'додаю',
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
                            'table'             => 'policies_kasko'),   
                            
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'
                        ),
                        array(
                            'name'              => 'document_info',
                            'description'       => 'Додатковi умови по договору',
                            'type'              => fldNote,
                            'replaceTags'       => false,
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
                            'table'             => 'policies_kasko'
                        ),
                        
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'credit_agreement_number',
                            'description'       => 'Кредитний договір, номер',
                            'type'              => fldText,
                            'maxlength'         => 25,
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
                        array(
                            'name'              => 'credit_agreement_date',
                            'description'       => 'Кредитний договір, дата',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'pawn_agreement_number',
                            'description'       => 'Договір застави, номер',
                            'type'              => fldText,
                            'maxlength'         => 25,
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
                        array(
                            'name'              => 'pawn_agreement_date',
                            'description'       => 'Договір застави, дата',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'bank_account_number',
                            'description'       => 'Рахунок (для договірного списання коштів)',
                            'type'              => fldText,
                            'maxlength'         => 14,
                            'validationRule'    => '^([0-9]{9,14})$',
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
                        array(
                            'name'              => 'bank_account_title',
                            'description'       => 'Рахунок (для договірного списання коштів), банк',
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
                        array(
                            'name'              => 'bank_account_mfo',
                            'description'       => 'Рахунок (для договірного списання коштів), МФО',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'bank_account_edrpou',
                            'description'       => 'Рахунок (для договірного списання коштів), ЄДРПОУ',
                            'type'              => fldText,
                            'maxlength'         => 8,
                            'validationRule'    => '^([0-9]{8})$',
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
                            'name'                => 'amount_parent',
                            'description'        => 'Використано покриття за попереднiм полiсом, грн.',
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
                            'name'              => 'policy_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldSelect,
                            'showId'            => true,
                            'display'           =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'changeStatus'  => true,
                                    'view'          => true,
                                    'update'        => true
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
                            'name'              => 'agreement_types_id',
                            'description'       => 'Дадаткова угода',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies'), 
                        
                        array(
                            'name'              => 'next_policy_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldSelect,
                            'showId'            => true,
                            'display'           =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
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
                            'name'              => 'states_id',
                            'description'       => 'Состояние',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
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
                            'name'              => 'states_id2',
                            'description'       => 'Состояние2',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
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
                            'name'              => 'certificate',
                            'description'       => 'Сертифікат',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true,
                                    'change'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies'),
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'expert_period',
                            'description'       => 'expert_period',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'sign_agents_id',
                            'description'       => 'Пiдпис договору КАСКО',
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
                            'table'             => 'policies_kasko',
                            'sourceTable'       => 'accounts'),
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
                            'table'             => 'policies'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_id_card',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_newpassport_number',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_newpassport_place',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_newpassport_date',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_newpassport_reestr',
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
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'owner_newpassport_dateEnd',
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
                            'table'             => 'policies_kasko'),
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 15,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'number'
                    )
                );

        var $itemFormDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'policies_id',
                            'description'       => 'Поліс',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'car_types_id',
                            'description'       => 'Тип ТЗ',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'brands_id',
                            'description'       => 'Марка',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'brand',
                            'description'       => 'Марка',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'models_id',
                            'description'       => 'Модель',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'model',
                            'description'       => 'Модель',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'car_price',
                            'description'       => 'Страхова вартість, грн',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'market_price',
                            'description'       => 'Ринкова вартість, грн',
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
                            'table'             => 'policies_kasko_items'), 
                        array(
                            'name'              => 'engine_size',
                            'description'       => 'Об\'єм двигуна, sm<sup>3</sup>',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'transmissions_id',
                            'description'       => 'КПП',
                            'type'              => fldRadio,
                            'showId'            => true,
                            'list'                => array(
                                                        1 => 'Автомат',
                                                        2 => 'Ручна / Механіка',
                                                        3 => 'Адаптивна',
                                                        4 => 'Варіатор',
                                                        5 => 'Типтронік'),
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'car_engine_type_id',
                            'description'       => 'Топливо',
                            'type'              => fldRadio,
                            'showId'            => true,
                            'list'                => array(
                                                        1 => 'Бензин',
                                                        2 => 'Дизель',
                                                        3 => 'Газ',
                                                        4 => 'Газ/бензин',
                                                        5 => 'Гібрид' ,
                                                        6 => 'Електро'),
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
                            'table'             => 'policies_kasko_items'), 
                            
                        array(
                            'name'              => 'car_body_id',
                            'description'       => 'Тип кузова ТЗ',
                            'type'              => fldRadio,
                            'showId'            => true,
                            'list'                => array(
                                                        1 => 'Седан',
                                                        2 => 'Універсал',
                                                        3 => 'Позашляхових / Кроссовер',
                                                        4 => 'Хетчбек',
                                                        5 => 'Кабріолет',
                                                        6 => 'Купе',
                                                        7 => 'Лімузин',
                                                        8 => 'Мікроавтобус',
                                                        9 => 'Мінівен',
                                                        10 => 'Пікап',
                                                        11 => 'Фургон'),
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'modification',
                            'description'       => 'Модфифікація',
                            'type'              => fldText,
                            'maxlength'         => 40,
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
                            'table'             => 'policies_kasko_items'), 
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'race',
                            'description'       => 'Пробіг, тис. км.',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'colors_id',
                            'description'       => 'Колір',
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
                            'table'             => 'policies_kasko_items',
                            'sourceTable'       => 'car_colors',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'number_places',
                            'description'       => 'Кількість місць',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'shassi',
                            'description'       => '№ шасі (кузов, рама)',
                            'type'              => fldText,
                            'maxlength'         => 40,
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'sign',
                            'description'       => 'Державний знак (реєстраційний №)',
                            'type'              => fldText,
                            'validationFunction'        => 'isValidSign',
                            'validationFunctionType'    => 'function',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'other_policies',
                            'description'       => 'Інші договори',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => '',
                            'description'       => 'Розпорядження (користування) ТЗ на підставі',
                            'type'              => fldRadio,
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'use_as_car',
                            'description'       => 'Використання ТЗ в якості',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'route',
                            'description'       => 'Маршрут',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'protection_multlock',
                            'description'       => 'Mul-T-Lock',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'protection_immobilaser',
                            'description'       => 'Immobilaser',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'protection_manual',
                            'description'       => 'Механічна',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'protection_signalling',
                            'description'       => 'Сигналізація',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'no_immobiliser',
                            'description'       => 'Страхування без протиугінного пристрою',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'products_id',
                            'description'       => 'Продукт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'products_code',
                            'description'       => 'Продукт, код',
                            'description'       => 'Код',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'products_title',
                            'description'       => 'Продукт, назва',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'products_base_rate',
                            'description'       => 'Продукт, базовий тариф',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'deductibles_id',
                            'description'       => 'Набір франшиз',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'deductibles_value0',
                            'description'       => 'Інші ризики, значення',
                            'type'              => fldPercent,
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'deductibles_absolute0',
                            'description'       => 'Інші ризики, % чи грн.',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'deductibles_value1',
                            'description'       => 'Викрадення, значення',
                            'type'              => fldPercent,
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'deductibles_absolute1',
                            'description'       => 'Викрадення, % чи грн.',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'deductibles_value',
                            'description'       => 'Набір франшиз, корегуючий коефіцієнт',
                            'type'              => fldPercent,
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'car_years_value',
                            'description'       => 'Рік випуску, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'special_car_value',
                            'description'       => 'Спеціальне авто корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'), 
                        array(
                            'name'              => 'driver_standings_value',
                            'description'       => 'Стаж водія, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'car_numbers_value',
                            'description'       => 'Кількість авто, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'driver_ages_value',
                            'description'       => 'Вік водія, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'regions_value',
                            'description'       => 'Територія переважного використання ТЗ, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'priority_payments_value',
                            'description'       => 'Пріоритет виплати, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'residences_value',
                            'description'       => 'Місце зберігання ТЗ, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'terms_value',
                            'description'       => 'Терміни, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'zones_value',
                            'description'       => 'Зона дії, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'alarm_value',
                            'description'       => 'Наявність сигналізації, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'payment_brakedown_value',
                            'description'       => 'Розбивка платежу, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_deductible_glass_no_value',
                            'description'       => 'Без франшизи на вітрові стекла, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_first_accident_value',
                            'description'       => 'Перший страховий випадок, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_season_value',
                            'description'       => 'Сезон, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_workers_list_value',
                            'description'       => 'Водії підприємства згідно наказу, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_fifty_fifty_value',
                            'description'       => 'Опція 50/50, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_holiday_value',
                            'description'       => 'Вихідний день, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_work_value',
                            'description'       => 'Робочий день, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_taxy_value',
                            'description'       => 'Страхування таксі, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_test_drive_value',
                            'description'       => 'Страхування тест драйву, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_agregate_no_value',
                            'description'       => 'Неагрегатна страхова сума, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'options_years_value',
                            'description'       => 'Страхування ТЗ віком більше 8 років, корегуючий коефіцієнт',
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
                            'table'             => 'policies_kasko_items'),
                    array(
                            'name'              => 'bank_discount_value',
                            'description'       => 'Знижка для банкiв',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'bank_commission_value',
                            'description'       => 'Винагорода банка',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'agent_commission_value',
                            'description'       => 'Винагорода агента',
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
                            'table'             => 'policies_kasko_items'), 
                        array(
                            'name'              => 'rate_kasko',
                            'description'       => 'КАСКО, тариф, %',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'amount_kasko',
                            'description'       => 'КАСКО, премія, грн.',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'price_equipment',
                            'description'       => 'ДО, вартість, грн',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'rate_equipment',
                            'description'       => 'ДО, тариф, %',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'amount_equipment',
                            'description'       => 'ДО, премiя, грн',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'price_accident',
                            'description'       => 'НВ, страхова сума, грн',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'rate_accident',
                            'description'       => 'НВ, тариф, %',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'amount_accident',
                            'description'       => 'НВ, премія, грн.',
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
                            'table'             => 'policies_kasko_items'),
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'amount_agent',
                            'description'       => 'Премія агент, грн.',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'formula',
                            'description'       => 'Формула',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_kasko_items'), 
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
                            'table'             => 'policies_kasko_items'),
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
                            'table'             => 'policies_kasko_items'),
                         
                            
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
                            'table'             => 'policies_kasko_items'),
                         
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
                            'table'             => 'policies_kasko_items'),
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
                            'table'             => 'policies_kasko_items'),
                            
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
                            'table'             => 'policies_kasko_items'),
                        //*********************************************
                        array(
                            'name'              => 'commission_agency_discount_percent',
                            'description'       => 'Комісія знижка, агенція, %',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'commission_agent_discount_percent',
                            'description'       => 'Комісія знижка, агент, %',
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
                            'table'             => 'policies_kasko_items'),
                         
                            
                        array(
                            'name'              => 'director1_commission_discount_percent',
                            'description'       => 'Комісія знижка, директор, %',
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
                            'table'             => 'policies_kasko_items'),
                         
                        array(
                            'name'              => 'director2_commission_discount_percent',
                            'description'       => 'Комісія знижка, зам директора, %',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'commission_manager_discount_percent',
                            'description'       => 'Комісія знижка Менеджер що привiв клiєнта, %',
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
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'commission_seller_agents_discount_percent',
                            'description'       => 'Комісія знижка Менеджер продавець, %',
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
                            'table'             => 'policies_kasko_items')
                         
                    )
                );

        var $equipmentFormDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'title',
                            'description'       => 'Найменування',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'policies_kasko_item_equipment'),
                        array(
                            'name'              => 'brand',
                            'description'       => 'Марка',
                            'type'              => fldText,
                            'maxlength'         => 20,
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
                            'table'             => 'policies_kasko_item_equipment'),
                        array(
                            'name'              => 'model',
                            'description'       => 'Модель',
                            'type'              => fldText,
                            'maxlength'         => 20,
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
                            'table'             => 'policies_kasko_item_equipment'),
                        array(
                            'name'              => 'price',
                            'description'       => 'Вартість, грн.',
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
                            'table'             => 'policies_kasko_item_equipment'),                        
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
                            'table'             => 'policies_kasko_item_equipment')
                )
            );

    var $options = array (
        'options_month500' => true,
        'options_test_drive' => true,
        'options_race' => true,
        'options_fifty_fifty' => true,
        'all_risks' => false,
    );

    function Policies_KASKO($data) {
        global $db, $POLICY_STATUSES_SCHEMA;

        Policies::Policies($data);

        $this->objectTitle = 'Policies_KASKO';

        $this->messages['plural'] = 'Поліси "КАСКО"';
        $this->messages['single'] = ($data['types_id'] == POLICY_TYPES_QUOTE) ? 'Котирування "КАСКО"' : 'Поліс "КАСКО"';

        $id = (is_array($data['id'])) ? $data['id'][0] : $data['id'];

        $this->setSubMode($data);

        $this->setPolicyStatusesSchema(null, &$data);
        
        if ($_SESSION['auth']['agencies_id']==SELLER_AGENCIES_ID || $_SESSION['auth']['roles_id']==ROLES_ADMINISTRATOR || $_SESSION['auth']['roles_id']== ROLES_MANAGER)
            $this->formDescription['fields'][ $this->getFieldPositionByName('express_products_id') ]['list'][671] = 'Правекс Доход';
                                                    
                                                    
                                                    
        if ($_SESSION['auth']['agent_financial_institutions_id'] >0)
        {
            if ($_SESSION['auth']['agent_financial_institutions_id']==25) {//идея банк
                $this->formDescription['fields'][ $this->getFieldPositionByName('express_products_id') ]['list'] =array(
                                                    137 => 'Оптимальний. Ідея Банк',
                                                    288 => 'Легкий. Ідея Банк');
                $this->options['options_fifty_fifty'] = true;
            } else {
                $this->formDescription['fields'][ $this->getFieldPositionByName('express_products_id') ]['list'] = array(
                    PRODUCT_KASKO1 => '«ЛЕГКИЙ»',
                    PRODUCT_KASKO2 => '«ОПТИМАЛЬНИЙ»',
                    PRODUCT_KASKO3 => '«ПРЕМІУМ»'
                );

                $this->options['options_fifty_fifty'] = false;
            }   
                                                    
            $this->formDescription['fields'][ $this->getFieldPositionByName('insurance_companies_id') ]['list'] = array(
                INSURANCE_COMPANIES_EXPRESS => 'ТДВ "Eкспрес Страхування"',
            );

            $this->options['options_month500'] = false;
            $this->options['options_test_drive'] = false;
            $this->options['options_race'] = false;
            
            $this->options['all_risks'] = true;
        }
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'                  => true,
                    'insert'                => true,
                    'quote'                 => true,
                    'update'                => true,
                    'view'                  => true,
                    'change'                => true,
                    'export'                => true,
                    'exportActions'         => true,
                    'documents'             => true,
                    'reset'                 => true,
                    'delete'                => true,
                    'changeServicePerson'   => true,
                    'renewPolicy'           => true,
                    'continuePolicy'        => false,
                    'transfer'              => true,
                    'cancelPolicy'          => true);
                break;
            case ROLES_MASTER:
                $this->permissions = array(
                    'view'                  => true);
                break;
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'                  => true,
                    'insert'                => true,
                    'copy'                  => false,
                    'quote'                 => true,
                    'update'                => true,
                    'view'                  => true,
                    'change'                => false,
                    'delete'                => false,
                    'changeServicePerson'   => true,
                    'renewPolicy'           => $_SESSION['auth']['agencies_id']==SELLER_AGENCIES_ID || $_SESSION['auth']['agencies_id']==236? true : false,
                    'continuePolicy'        => true,
                    'cancelPolicy'          => true);

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
                    POLICY_STATUSES_CONSULTATION => 
                        array(
                            POLICY_STATUSES_CONSULTATION,
                            $Authorization->data['ankets']==1 || $Authorization->data['roles_id'] != ROLES_AGENT ? POLICY_STATUSES_CREATED : 0 
                            ),  
                    POLICY_STATUSES_CREATED =>
                        array(
                            POLICY_STATUSES_CREATED,
                            ($this->subMode == 'set' ? POLICY_STATUSES_REQUEST_QUOTE : (intval($data['next_policy_statuses_id']) ? $data['next_policy_statuses_id'] : POLICY_STATUSES_GENERATED))),
                    POLICY_STATUSES_REQUEST_QUOTE   =>//запрос котировки к андеррайтеру
                        array(
                            POLICY_STATUSES_REQUEST_QUOTE,
                            POLICY_STATUSES_REQUEST_QUOTE_ERROR,
                            POLICY_STATUSES_QUOTE,POLICY_STATUSES_GENERATED),
                    POLICY_STATUSES_REQUEST_QUOTE_ERROR =>//ошибка в запросе к андеррайтеру
                        array(
                            POLICY_STATUSES_REQUEST_QUOTE_ERROR,
                            POLICY_STATUSES_REQUEST_QUOTE_AGAIN),
                    POLICY_STATUSES_REQUEST_QUOTE_AGAIN =>//повторный запрос котировки к андеррайтеру
                        array(
                            POLICY_STATUSES_REQUEST_QUOTE_AGAIN,
                            POLICY_STATUSES_REQUEST_QUOTE_ERROR,
                            POLICY_STATUSES_QUOTE),
                    POLICY_STATUSES_QUOTE   =>//котировка от андеррайтера
                        array(
                            POLICY_STATUSES_QUOTE,
                            POLICY_STATUSES_REQUEST_AGREEMENT),
                    POLICY_STATUSES_REQUEST_AGREEMENT   =>//запрос договора страхования
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
                    POLICY_STATUSES_DISSOLVED =>
                        array(
                            POLICY_STATUSES_DISSOLVED),     
                    POLICY_STATUSES_CONTINUED =>
                        array(
                            POLICY_STATUSES_CONTINUED),
                    POLICY_STATUSES_RENEW =>
                        array(
                            POLICY_STATUSES_RENEW)
                        );
                break;
            case ROLES_MANAGER:
                $POLICY_STATUSES_SCHEMA = array(
                POLICY_STATUSES_CONSULTATION => 
                        array(
                            POLICY_STATUSES_CONSULTATION,
                            $Authorization->data['ankets']==1 || $Authorization->data['roles_id'] != ROLES_AGENT ? POLICY_STATUSES_CREATED : 0 
                            ),  
                    POLICY_STATUSES_CREATED =>
                        array(
                            POLICY_STATUSES_CREATED,
                            ($this->subMode == 'set' ? POLICY_STATUSES_REQUEST_QUOTE : (intval($data['next_policy_statuses_id']) ? $data['next_policy_statuses_id'] : POLICY_STATUSES_GENERATED))),
                    POLICY_STATUSES_REQUEST_QUOTE   =>//запрос котировки к андеррайтеру
                        array(
                            POLICY_STATUSES_REQUEST_QUOTE,
                            POLICY_STATUSES_REQUEST_QUOTE_ERROR,
                            POLICY_STATUSES_QUOTE,POLICY_STATUSES_GENERATED),
                    POLICY_STATUSES_REQUEST_QUOTE_ERROR =>//ошибка в запросе к андеррайтеру
                        array(
                            POLICY_STATUSES_REQUEST_QUOTE_ERROR,
                            POLICY_STATUSES_REQUEST_QUOTE_AGAIN),
                    POLICY_STATUSES_REQUEST_QUOTE_AGAIN =>//повторный запрос котировки к андеррайтеру
                        array(
                            POLICY_STATUSES_REQUEST_QUOTE_AGAIN,
                            POLICY_STATUSES_REQUEST_QUOTE_ERROR,
                            POLICY_STATUSES_QUOTE),
                    POLICY_STATUSES_QUOTE   =>//котировка от андеррайтера
                        array(
                            POLICY_STATUSES_QUOTE,
                            POLICY_STATUSES_REQUEST_AGREEMENT),
                    POLICY_STATUSES_REQUEST_AGREEMENT   =>//запрос договора страхования
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
                    POLICY_STATUSES_DISSOLVED =>
                        array(
                            POLICY_STATUSES_DISSOLVED),     
                            
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
                    POLICY_STATUSES_CONSULTATION => 
                        array(
                            POLICY_STATUSES_CONSULTATION,
                            $Authorization->data['ankets']==1 || $Authorization->data['roles_id'] != ROLES_AGENT ? POLICY_STATUSES_CREATED : 0 
                            ),  
                    POLICY_STATUSES_CREATED =>
                        array(
                            POLICY_STATUSES_CREATED,
                            ($this->subMode=='set' ? POLICY_STATUSES_REQUEST_QUOTE :  POLICY_STATUSES_GENERATED)),
                    POLICY_STATUSES_REQUEST_QUOTE   =>//запрос котировки к андеррайтеру
                        array(
                            POLICY_STATUSES_REQUEST_QUOTE),
                    POLICY_STATUSES_REQUEST_QUOTE_ERROR =>//ошибка в запросе к андеррайтеру
                        array(
                            POLICY_STATUSES_REQUEST_QUOTE_ERROR,
                            POLICY_STATUSES_REQUEST_QUOTE_AGAIN),
                    POLICY_STATUSES_REQUEST_QUOTE_AGAIN =>//повторный запрос котировки к андеррайтеру
                        array(
                            POLICY_STATUSES_REQUEST_QUOTE_AGAIN),
                    POLICY_STATUSES_QUOTE   =>//котировка от андеррайтера
                        array(
                            POLICY_STATUSES_QUOTE,
                            POLICY_STATUSES_REQUEST_AGREEMENT),
                    POLICY_STATUSES_REQUEST_AGREEMENT   =>//запрос договора страхования
                        array(
                            POLICY_STATUSES_REQUEST_AGREEMENT),
                    POLICY_STATUSES_GENERATED =>
                        array(
                            POLICY_STATUSES_GENERATED),

                    POLICY_STATUSES_CANCELLED =>
                        array(
                            POLICY_STATUSES_CANCELLED),
                    POLICY_STATUSES_DISSOLVED =>
                        array(
                            POLICY_STATUSES_DISSOLVED),     
                            
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

    //установка режима расчета страхового тарифа
    //calculate - расчитать страховой тариф
    //set - установка страховых параметров на основании переданных
    function setSubMode($data) {
        global $db, $UNDERWRITING_POLICY_STATUSES;
        switch ($data['do']) {
            case $this->object . '|add':
            case $this->object . '|insert':
            case $this->object . '|copy':
            case $this->object . '|renewPolicy':
                $this->subMode = ($data['types_id'] == POLICY_TYPES_QUOTE) ? 'set' : 'calculate';
                break;
            case $this->object . '|load':

                if (is_array($data['id'])) {
                    $data['id'] = $data['id'][0];
                }

                $sql =  'SELECT types_id, policy_statuses_id ' .
                        'FROM ' . PREFIX . '_policies ' .
                        'WHERE id = ' . intval($data['id']);
                $row =  $db->getRow($sql);

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
    }


    function getShowFieldsSQLString() {
        $result = parent::getShowFieldsSQLString();

        $result = str_replace('insurance_policies.number', 'IF(insurance_policies.sub_number>0,CONCAT(insurance_policies.number,\'-\',sub_number),insurance_policies.number) as number ', $result);
        $result = str_replace('insurance_accounts.lastname', 'IF(insurance_policies.seller_agents_id>0,CONCAT(insurance_accounts.lastname,\'/\',getSeller(insurance_policies.seller_agents_id)),insurance_accounts.lastname) ', $result);

        return $result;
    }

    //установка стилей на форме
    function getReadonlySign(&$data) {
        return (intval($data['documents'])==0)
            ? ''
            : ' style="color: #666666; background-color: #f5f5f5;" disabled';
    }

    //формирование справочников
    function setListValues($data, $actionType='show') {
        global $db, $TRANSMISSIONS, $Authorization;

        $sql =  'SELECT id, title, 0 AS obligatory ' .
                'FROM ' . PREFIX . '_car_types ' .
                'WHERE product_types_id = ' . PRODUCT_TYPES_KASKO . ' ' .
                'ORDER BY order_position';
        $res = $db->query($sql);

        while ($res->fetchInto($row)) {
            $this->car_types_id[$row['id']] = $row;
        }

        $sql =  'SELECT id, title, 0 AS obligatory ' .
                'FROM ' . PREFIX . '_car_colors ' .
                'ORDER BY order_position';
        $res = $db->query($sql);

        while ($res->fetchInto($row)) {
            $this->colors_id[$row['id']] = $row;
        }

        $this->transmissions = $this->itemFormDescription['fields'][ $this->getFieldPositionByName('transmissions_id', $this->itemFormDescription) ]['list'];
        $this->car_body = $this->itemFormDescription['fields'][ $this->getFieldPositionByName('car_body_id', $this->itemFormDescription) ]['list'];
        $this->car_engine_type = $this->itemFormDescription['fields'][ $this->getFieldPositionByName('car_engine_type_id', $this->itemFormDescription) ]['list'];
        
        
        

        if (!intval($data['agencies_id'])) {
            $data['agencies_id']    = $Authorization->data['agencies_id'];
        }
        //правекс 
        if ($_SESSION['auth']['agent_financial_institutions_id'] >0)
        {
            $this->formDescription['fields'][ $this->getFieldPositionByName('financial_institutions_id') ]['condition'] = ' id='.intval($_SESSION['auth']['agent_financial_institutions_id']);
        }
//        $this->formDescription['fields'][ $this->getFieldPositionByName('sign_agents_id') ]['condition'] .= ' AND (agencies_id='.intval($data['agencies_id']).' OR agencies_id IN (SELECT parent_id FROM '.PREFIX.'_agencies WHERE id ='.intval($data['agencies_id']).' ))';

        parent::setListValues($data, $actionType);
    }

    //формирование выпадающего списка
    function buildSelect($field, $value, $languageCode=null, $addition=null, $indexType=null, $data=null, $class=null) {
        global $db;

        $result = '';

        if  ($field['name'] == 'registration_cities_id') {

            $conditions[] = 'product_types_id = ' . PRODUCT_TYPES_AUTO;
            $conditions[] = 'regions_kasko_retail_id >0 ';
            

            $sql =  'SELECT a.title, b.id as cities_id, b.title as citiesTitle ' .
                    'FROM ' . PREFIX . '_parameters_regions as a ' .
                    'JOIN ' . PREFIX . '_cities as b ON a.id = b.regions_id ' .
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

                    $result .= '<option value="' . $row['cities_id'] . '" ' . (($row['cities_id'] == $value) ? 'selected' : '')  . '>' . $row['citiesTitle'] . '</option>';

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

    //добавление нового полиса
    function add($data) {
        global $db;

        if (!intval($data['parent_id'])) {
            $sql =  'SELECT id ' .
                    'FROM ' . PREFIX . '_parameters_risks ' .
                    'WHERE product_types_id = ' . intval($data['product_types_id']);
            $risks = $db->getAll($sql, 30 * 60);

            foreach ($risks as $risk) {
                $data['risks'][] =  $risk['id'];
            }

            $data['options_deterioration_no'] = 1;
        }
        if ($data['load_id']) {
            $copy_fields = array(
            'car_types_id','person_types_id','insurer_lastname','insurer_firstname','insurer_patronymicname','insurer_identification_code','insurer_edrpou','insurer_passport_series','insurer_passport_number','insurer_passport_place','insurer_passport_date_format','insurer_passport_date_year','insurer_passport_date_month','insurer_passport_date_day','insurer_dateofbirth_format','insurer_dateofbirth_year','insurer_dateofbirth_month','insurer_dateofbirth_day','insurer_phone','insurer_email','insurer_zip','insurer_regions_id','insurer_area','insurer_city','insurer_street_types_id','insurer_street','insurer_house','insurer_flat','insurer_driver_licence_series','insurer_driver_licence_number','insurer_driver_licence_date_format','insurer_driver_licence_date_year','insurer_driver_licence_date_month','insurer_driver_licence_date_day','shassi','sign','brands_id','models_id','year','engine_size','insurer_id_card','insurer_newpassport_number','insurer_newpassport_place','insurer_newpassport_date','insurer_newpassport_reestr','insurer_newpassport_dateEnd','insurer_newpassport_date_day','insurer_newpassport_date_month','insurer_newpassport_date_year','insurer_newpassport_dateEnd_day','insurer_newpassport_dateEnd_month','insurer_newpassport_dateEnd_year',
            );
            $l = $db->getRow('SELECT * FROM insurance_policies WHERE id = '.intval($data['load_id']));
            if ($l) {
                $policy = Policies::factory($l);
                $policy->checkPermissions('view', $l );
                $row = $policy->view($l, false);
                if (isset($row['models_id'])) {
                    $row['car_types_id'] = $db->getOne('SELECT car_types_id FROM insurance_car_type_car_model_assignments a JOIN insurance_car_types b ON b.product_types_id =3 AND b.id = car_types_id WHERE car_models_id ='.$row['models_id']);
                }

                foreach($copy_fields as $f) {
                    if (isset($row[$f])) {
                        $data[$f] = $row[$f];
                        if ($row['product_types_id']==4) //создаем с ГО
                        {
                            if (strpos($f, 'insurer_')!==false)
                                $data[str_replace ( 'insurer_' , 'owner_' , $f )] = $row[$f];
                            
                            if ($f == 'person_types_id') {
                                $data['insurer_person_types_id'] = $row[$f];
                                $data['owner_person_types_id'] = $row[$f];
                            }
                            if ( in_array($f ,  array('year','engine_size' ,'brands_id','models_id','car_types_id','shassi','sign'))) {
                                $data['items'][0][$f] = $row[$f];
                            }
                            
                        }
                    }
                }
            }
        }
        parent::add($data);
    }

    function getItem($items) {
        global $db;

        $result = '';

        if (sizeOf($items) > 1) {
            $result = 'Автопарк';
        } else {

            $item = array_shift($items);

            $sql =  'SELECT CONCAT(a.title, \'/\', b.title) ' .
                    'FROM ' . PREFIX . '_car_brands AS a ' .
                    'JOIN ' . PREFIX . '_car_models AS b ON a.id = b.car_brands_id ' .
                    'WHERE b.id = ' . intval($item['models_id']);
            $result = $db->getOne($sql);
        }

        return $result;
    }

    function setFields($data) {
        global $Authorization;

         //корректируем перечень полей в зависимости от типа контрагента
        $unsetFields = array();

        if (!intval($data['cart_discount'])) {
            $unsetFields[] = 'card_car_man_woman';
        }

        /*if (intval($data['express_products_id'])>0 && $data['express_products_id']!=PRODUCT_KASKO_TESTDRIVE1 && $data['express_products_id']!=PRODUCT_KASKO_TESTDRIVE2 && $data['express_products_id']!=PRODUCT_KASKO_TESTDRIVE3)
        {//экспресс продукт Власник=Страхователь
            $data['owner_person_types_id']=$data['insurer_person_types_id'];
            $data['owner_company']=$data['insurer_company'];
            $data['owner_edrpou']=$data['insurer_edrpou'];
            $data['owner_bank']=$data['insurer_bank'];
            $data['owner_bank_mfo']=$data['insurer_bank_mfo'];
            $data['owner_bank_account']=$data['insurer_bank_account'];
            $data['owner_lastname']=$data['insurer_lastname'];
            $data['owner_firstname']=$data['insurer_firstname'];
            $data['owner_patronymicname']=$data['insurer_patronymicname'];
            $data['owner_dateofbirth']=$data['insurer_dateofbirth'];
            $data['owner_dateofbirth_day']=$data['insurer_dateofbirth_day'];
            $data['owner_dateofbirth_month']=$data['insurer_dateofbirth_month'];
            $data['owner_dateofbirth_year']=$data['insurer_dateofbirth_year'];
            $data['owner_passport_series']=$data['insurer_passport_series'];
            $data['owner_passport_number']=$data['insurer_passport_number'];
            $data['owner_passport_place']=$data['insurer_passport_place'];
            $data['owner_passport_date']=$data['insurer_passport_date'];
            $data['owner_passport_date_day']=$data['insurer_passport_date_day'];
            $data['owner_passport_date_month']=$data['insurer_passport_date_month'];
            $data['owner_passport_date_year']=$data['insurer_passport_date_year'];
            $data['owner_identification_code']=$data['insurer_identification_code'];
            $data['owner_position']=$data['insurer_position'];
            $data['owner_ground']=$data['insurer_ground'];
            $data['owner_phone']=$data['insurer_phone'];
            $data['owner_email']=$data['insurer_email'];
            $data['owner_regions_id']=$data['insurer_regions_id'];
            $data['owner_area']=$data['insurer_area'];
            $data['owner_city']=$data['insurer_city'];
            $data['owner_street_types_id']=$data['insurer_street_types_id'];
            $data['owner_street']=$data['insurer_street'];
            $data['owner_house']=$data['insurer_house'];
            $data['owner_flat']=$data['insurer_flat'];


        }*/

        switch ($data['owner_person_types_id']) {
            case '1'://физ лицо
                $unsetFields[] = 'owner_edrpou';
                $unsetFields[] = 'owner_company';
                $unsetFields[] = 'owner_position';
                $unsetFields[] = 'owner_ground';
                $unsetFields[] = 'owner_bank';
                $unsetFields[] = 'owner_bank_mfo';
                $unsetFields[] = 'owner_bank_account';
                break;
            case '2'://юр лицо
                $unsetFields[] = 'owner_dateofbirth';
                $unsetFields[] = 'owner_passport_series';
                $unsetFields[] = 'owner_passport_number';
                $unsetFields[] = 'owner_passport_place';
                $unsetFields[] = 'owner_passport_date';
                $unsetFields[] = 'owner_identification_code';

                $unsetFields[] = 'owner_newpassport_number';
                $unsetFields[] = 'owner_newpassport_place';
                $unsetFields[] = 'owner_newpassport_date';
                $unsetFields[] = 'owner_newpassport_reestr';
                $unsetFields[] = 'owner_newpassport_dateEnd';
                break;
        }

        switch ($data['insurer_person_types_id']) {
            case '1'://физ лицо
                $unsetFields[] = 'insurer_edrpou';
                $unsetFields[] = 'insurer_company';
                $unsetFields[] = 'insurer_bank_account';
                $unsetFields[] = 'insurer_bank_mfo';
                $unsetFields[] = 'insurer_bank';
                $unsetFields[] = 'insurer_position';
                $unsetFields[] = 'insurer_ground';
                $unsetFields[] = 'insurer_position';
                $unsetFields[] = 'insurer_ground';
                if (intval($data['no_resident'])) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_series') ]['verification']['canBeEmpty'] = true;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_number') ]['verification']['canBeEmpty'] = true;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_place') ]['verification']['canBeEmpty'] = true;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_date') ]['verification']['canBeEmpty'] = true;

                    $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_number') ]['verification']['canBeEmpty'] = true;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_place') ]['verification']['canBeEmpty'] = true;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_date') ]['verification']['canBeEmpty'] = true;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_reestr') ]['verification']['canBeEmpty'] = true;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_dateEnd') ]['verification']['canBeEmpty'] = true;
                    /*$unsetFields[] = 'insurer_passport_series';
                    $unsetFields[] = 'insurer_passport_number'; 
                    $unsetFields[] = 'insurer_passport_place';
                    $unsetFields[] = 'insurer_passport_date';
                    $unsetFields[] = 'insurer_identification_code';*/
                }
                break;
            case '2'://юр лицо
                $unsetFields[] = 'insurer_dateofbirth';
                $unsetFields[] = 'insurer_passport_series';
                $unsetFields[] = 'insurer_passport_number';
                $unsetFields[] = 'insurer_passport_place';
                $unsetFields[] = 'insurer_passport_date';
                //$unsetFields[] = 'insurer_driver_licence_series';
                //$unsetFields[] = 'insurer_driver_licence_number';
                //$unsetFields[] = 'insurer_driver_licence_date';
                $unsetFields[] = 'insurer_identification_code';

                $unsetFields[] = 'insurer_newpassport_number';
                $unsetFields[] = 'insurer_newpassport_place';
                $unsetFields[] = 'insurer_newpassport_date';
                $unsetFields[] = 'insurer_newpassport_reestr';
                $unsetFields[] = 'insurer_newpassport_dateEnd';
                break;
        }

        if (!$data['assured']) {
            $unsetFields[] = 'assured_title';
            $unsetFields[] = 'assured_identification_code';
            $unsetFields[] = 'assured_address';
            $unsetFields[] = 'assured_phone';
        }

        foreach($unsetFields as $field) {
            $data[ $field ] = '';
            $this->formDescription['fields'][ $this->getFieldPositionByName($field) ]['verification']['canBeEmpty'] = true;
        }
        if ($data['dontRecalcRate']) //не обновлять поля отвечающие за тариф
        {
            $unsetFields = array();
            $unsetFields[] = 'price';
            $unsetFields[] = 'rate';
            $unsetFields[] = 'amount';
            $unsetFields[] = 'amount_return';
            foreach($unsetFields as $field) {
                unset($this->formDescription['fields'][ $this->getFieldPositionByName($field) ]);
            }

        }
        if (is_array($this->formDescription['fields']) && $data['dontCheckFormat']) { //отменить правила проверки полей
            foreach($this->formDescription['fields'] as $field) {
                $this->formDescription['fields'][ $this->getFieldPositionByName($field['name']) ]['verification']['canBeEmpty'] = true;
                unset($this->formDescription['fields'][ $this->getFieldPositionByName($field['name']) ]['maxlength']);
                unset($this->formDescription['fields'][ $this->getFieldPositionByName($field['name']) ]['validationRule']);

            }
            foreach($this->itemFormDescription['fields'] as $field) {
                $this->itemFormDescription['fields'][ $this->getFieldPositionByName($field['name'], $this->itemFormDescription) ]['verification']['canBeEmpty'] = true;
                unset($this->itemFormDescription['fields'][ $this->getFieldPositionByName($field['name'], $this->itemFormDescription) ]['maxlength']);
                unset($this->itemFormDescription['fields'][ $this->getFieldPositionByName($field['name'], $this->itemFormDescription) ]['validationRule']);
                unset($this->itemFormDescription['fields'][ $this->getFieldPositionByName($field['name'], $this->itemFormDescription) ]['validationFunction']);
                unset($this->itemFormDescription['fields'][ $this->getFieldPositionByName($field['name'], $this->itemFormDescription) ]['validationFunctionType']);
                

            }
        }

        $shuldBeFill = array();
        if (sizeof($data['items'])>1 && $data['drivers_id']!=7) $data['drivers_id'] = 7;
        if ($data['insurer_driver_licence_series'] || $data['insurer_driver_licence_number'] || ($data['drivers_id']!=7 /*&& intval($data['express_products_id'])==0*/ && $data['agreement_types_id']==0)) {
            //$shuldBeFill[] = 'insurer_driver_licence_series';
            $shuldBeFill[] = 'insurer_driver_licence_number';
            $shuldBeFill[] = 'insurer_driver_licence_date';
        }
        
        
        if (is_array($shuldBeFill)) {
            foreach ($shuldBeFill as $field) {
                $this->formDescription['fields'][ $this->getFieldPositionByName($field) ]['verification']['canBeEmpty'] = false;
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
            case POLICY_STATUSES_CONSULTATION:
                $emptyFields =
                    array(
                        'formDescription' =>
                            array(
                                'driver_ages_id',

                                'owner_bank',
                                'owner_bank_mfo',
                                'owner_bank_account',
                                'owner_dateofbirth',
                                'owner_passport_series',
                                'owner_passport_number',
                                'owner_passport_place',
                                'owner_passport_date',
                                'owner_position',
                                'owner_ground',
                                'owner_phone',
                                'owner_regions_id',
                                'owner_city',
                                'owner_street',
                                'owner_house',
                                'owner_identification_code',
                                'owner_street_types_id',

                                'owner_newpassport_number',
                                'owner_newpassport_place',
                                'owner_newpassport_date',
                                'owner_newpassport_reestr',
                                'owner_newpassport_dateEnd',

                                'insurer_bank',
                                'insurer_bank_mfo',
                                'insurer_bank_account',
                                'insurer_dateofbirth',
                                'insurer_identification_code',
                                'insurer_passport_series',
                                'insurer_passport_number',
                                'insurer_passport_place',
                                'insurer_passport_date',
                                'insurer_phone',
                                'insurer_regions_id',
                                'insurer_city',
                                'insurer_street',
                                'insurer_house',
                                'terms_id',
                                'residences_id',
                                'insurer_street_types_id',
                                'rate',

                                'insurer_newpassport_number',
                                'insurer_newpassport_place',
                                'insurer_newpassport_date',
                                'insurer_newpassport_reestr',
                                'insurer_newpassport_dateEnd',
                        ),
                        'itemFormDescription'   =>
                            array(
                                'colors_id',
                                'engine_size',
                                'engine_sizes_id',
                                //'transmissions_id',
                                'number_places',
                                'shassi',
                                'other_policies',
                                'order_basis_car_id',
                                'use_as_car',
                                'products_id',
                                'deductibles_id',
                                'engine_sizes_value',
                                'car_years_value',
                                'special_car_value',
                                'price_ranges_value',
                                'drivers_value',
                                'driver_standings_value',
                                'car_numbers_value',
                                'driver_ages_value',
                                'regions_value',
                                'priority_payments_value',
                                'residences_value',
                                'terms_value',
                                'payment_brakedown_value',
                                'options_deterioration_no_value',
                                'options_deductible_glass_no_value',
                                'options_first_accident_value',
                                'options_season_value',
                                'options_workers_list_value',
                                'options_fifty_fifty_value',
                                'options_holiday_value',
                                'options_work_value',
                                'options_taxy_value',
                                'options_test_drive_value',
                                'rate_kasko',
                                'commission_agency_percent',
                                'commission_agent_percent',
                                'options_agregate_no_value',
                                'options_years_value','bank_discount_value','bank_commission_value','agent_commission_value'));
                break;
            case POLICY_STATUSES_REQUEST_AGREEMENT:
            case POLICY_STATUSES_GENERATED:
                if ($data['types_id'] == POLICY_TYPES_QUOTE) {
                    $emptyFields =
                        array(
                            'itemFormDescription'   =>
                                array(
                                    'engine_sizes_id',
                                    'products_id',
                                    'deductibles_id',
                                    'engine_sizes_value',
                                    //'transmissions_value',
                                    'car_years_value',
                                    'price_ranges_value',
                                    'drivers_value',
                                    'driver_standings_value',
                                    'car_numbers_value',
                                    'driver_ages_value',
                                    'special_car_value',
                                    'regions_value',
                                    'priority_payments_value',
                                    'residences_value',
                                    'terms_value',
                                    'payment_brakedown_value',
                                    'options_deterioration_no_value',
                                    'options_deductible_glass_no_value',
                                    'options_first_accident_value',
                                    'options_season_value',
                                    'options_workers_list_value',
                                    'options_fifty_fifty_value',
                                    'options_holiday_value',
                                    'options_work_value',
                                    'options_taxy_value',
                                    'options_test_drive_value',
                                    'options_agregate_no_value',
                                    'options_years_value','bank_discount_value','bank_commission_value','agent_commission_value'));
                }
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

            $this->itemFormDescription['fields'][ $this->getFieldPositionByName('commission_agency_percent', $this->itemFormDescription) ]['verification']['canBeEmpty'] = true;
            $this->itemFormDescription['fields'][ $this->getFieldPositionByName('commission_agent_percent', $this->itemFormDescription) ]['verification']['canBeEmpty'] = true;
        }
    }

    function setDriverStandingsId($data) {
        $time = mktime(0, 0, 0, $data['insurer_driver_licence_date_month'], $data['insurer_driver_licence_date_day'], $data['insurer_driver_licence_date_year']);

        if (is_array($data['persons'])) {
            foreach ($data['persons'] as $row) {
                if ($time < mktime(0, 0, 0, $row['driver_licence_date_month'], $row['driver_licence_date_day'], $row['driver_licence_date_year'])) {
                    $time = mktime(0, 0, 0, $row['driver_licence_date_month'], $row['driver_licence_date_day'], $row['driver_licence_date_year']);
                }
            }
        }

        $cur_date=getdate();
        $driver_date=getdate($time);

        $driverStandingYears = $cur_date['year'] - $driver_date['year'];//   intval((mktime() - $time) / 60 / 60 / 24 / 365);
        if ($cur_date['mon']>=$driver_date['mon'])  $driverStandingYears++;

        if ($driverStandingYears > 10) {
            $data['driver_standings_id'] = 4;
        } else if ($driverStandingYears > 3) {
            $data['driver_standings_id'] = 3;
        } else if ($driverStandingYears > 1) {
            $data['driver_standings_id'] = 2;
        } else {
            $data['driver_standings_id'] = 1;
        }

        return $data['driver_standings_id'];
    }

    function getmarketPriceInWindow($data) {
        global $Authorization,$db;
        $item = $data;
        $conditions[] =' (engine_size <= '.(intval($item['engine_size'])+50).' AND engine_size >= '.(intval($item['engine_size'])-50).' )';
        $conditions[] =' year = '.intval($item['year']);
        $conditions[] =' transmissions_id = '.intval($item['transmissions_id']);
        if ($item['car_types_id']==8)
            $conditions[] =' car_body_id = '.intval($item['car_body_id']);
        $conditions[] =' car_engine_type_id = '.intval($item['car_engine_type_id']);                
        $conditions[] =' brands_id = '.intval($item['brands_id']);              
        $conditions[] =' models_id = '.intval($item['models_id']);              
        $conditions[] =' market_price_expert > 0 ';
        $conditions[] =' expert_date>DATE_SUB(NOW(), INTERVAL 60 DAY) ';
        
        $sql =  'SELECT market_price_expert ' .
            'FROM insurance_policies_kasko_items ' .
            'WHERE ' . implode(' AND ', $conditions) . ' ORDER BY expert_date DESC LIMIT 1';
        $market_price = doubleval($db->getOne($sql));
        
        echo '{"marketPrice":"'.$market_price.'"}';
        exit;
                
    }
    
    function setConstants(&$data) {
        global $Authorization,$db;

        $data['item'] = $this->getItem($data['items']);

        $data['person_types_id'] = (intval($data['owner_person_types_id'])>1 || intval($data['insurer_person_types_id'])>1) ? 2 : 1;

        $this->setFields(&$data);
        if ($data['options_month500']) $data['payment_brakedown_id']  = 1;
        
        if ($data['financial_institutions_id']) {
            $data['risks'] = ParametersRisks::setAll($data['product_types_id']);
        }
        if ($data['express_products_id']==599 || $data['express_products_id']==684 ) {
            $data['risks'] = array(1);
        }
        
        if ($data['cons_agents_id']>0) $data['manager_id'] = $data['cons_agents_id'];
        
        $d = getdate ();
        if ($data['dontRecalcRate']==0 && ($data['solutions_id']>0 && $data['items'][0]) || $data['express_products_id']==684 ) {//рыночная цена равна продажной
            $data['items'][0]['market_price'] = $data['items'][0]['car_price'];
            $data['actual_market_price'] = 1;
        }
 /*       elseif($data['dontRecalcRate']==0 &&  intval($data['financial_institutions_id'])==0 && $data['items'][0]['year']>=2013 && ($d['wday']==0 || $d['wday']==6) && !in_array($data['express_products_id'],array(142,143,144,574)))
        {//ритейл выходной день и машина 2013 2014гг
            $data['items'][0]['market_price'] = $data['items'][0]['car_price'];
            $data['actual_market_price'] = 1;
        }*/
        elseif($data['dontRecalcRate']==0 && intval($data['financial_institutions_id'])==0 && $data['items'][0]['year']>=intval(date('Y', strtotime('-1 year')))  && intval($data['items'][0]['race'])==0  && !in_array($data['express_products_id'],array(142,143,144,574)))
        {//ритейл  2014-15гг машина без пробега и ранее не сраховалась по кузову
            if (intval($db->getOne('SELECT id FROM insurance_policies_kasko_items WHERE policies_id<>'.intval($data['id']).' AND shassi='.$db->quote($data['items'][0]['shassi'])))==0) {
                $data['items'][0]['market_price'] = $data['items'][0]['car_price'];
                $data['actual_market_price'] = 1;
                
            }
        }
        

        //якщо Рітейл  або Банк, то обов"язкове заповнення Розпорядження (користування) ТЗ на підставі
        //if($data['express_products_id'] == 0){
            $this->itemFormDescription['fields'][ $this->getFieldPositionByName('order_basis_car_id', $this->itemFormDescription) ]['verification']['canBeEmpty'] = false;
        //}

        $Products = Products::factory($data, 'KASKO');

        if ($data['agreement_types_id']>0) {//доп угода корреткировка термина спивпраци
            //$data['terms_years_id'] = 1;
            $sql =  'SELECT  CEIL(ROUND(DATEDIFF(' . $db->quote($data['end_datetime_year'].'-'.$data['end_datetime_month'].'-'.$data['end_datetime_day']) . ', '.$db->quote($data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day']) .')/365,2 )) AS years ';
            
            $data['terms_years_id'] = intval($db->getOne($sql)) ;
            if ($data['terms_years_id']<=0) $data['terms_years_id']=1;
            //if ($data['agreement_types_id']==2) $data['terms_years_id'] = 1;
        }       
        

        if ($data['drivers_id'] != 7 && intval($data['agreement_types_id'])==0) {//устанавливаем минимальный стаж вождения, привязавшись к дате выдачи прав
            $data['driver_standings_id'] = $this->setDriverStandingsId($data);
        }


        if (is_array($data['items']) && !$data['dontRecalcRate']) {

            //расчет тарифа
            foreach ($data['items'] as $i => &$item) {

                $data['items'][ $i ]['shassi']  = fixShassiSimbols($data['items'][ $i ]['shassi']);
                $data['items'][ $i ]['sign']    = fixSignSimbols($data['items'][ $i ]['sign']);
                if (!intval($data['items'][ $i ]['products_id']) && intval($data['express_products_id']))
                    $data['items'][ $i ]['products_id'] = $data['express_products_id'];

                //$item = &$data['items'][ $i ];
                //расчет общей стоимости дополнительного оборудования для 1 машины
                $data['items'][ $i ]['price_equipment'] = 0;

                if (is_array($item['equipment'])) {
                    foreach ($item['equipment'] as  $equipment) {
                        $data['items'][ $i ]['price_equipment'] += doubleval($equipment['price']);
                    }
                }

                switch ($this->subMode) {
                    case 'calculate'://расчет на основании параметров страхового продукта
                        $Products->calculate($item['engine_size'], $item['car_types_id'], $data['person_types_id'], $data['driver_standings_id'], $data['drivers_id'], $item['car_price'], $data['driver_ages_id'], $data['registration_cities_id'], $data['terms_id'], $item['deductibles_id'], $data, $data['items'][$i]);
                        break;
                    case 'set'://параметры устанавливаются андеррайтером

                        if ($Authorization->data['roles_id'] == ROLES_AGENT || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) {
                            if ($item['id']) {

                            } else {
                                $data['items'][ $i ]['commission_financial_institution_percent']    = 0;
                            }
                        }

                        $data['items'][ $i ]['amount_kasko'] = round(doubleval($item['car_price']) * doubleval($item['rate_kasko']) / 100, 2);
                        

                        if ($data['items'][ $i ]['price_equipment'] == 0) {
                            $data['items'][ $i ]['rate_equipment'] = 0;
                        }

                        $data['items'][ $i ]['amount_equipment'] = round(doubleval($data['items'][ $i ]['price_equipment']) * doubleval($data['items'][ $i ]['rate_equipment']) / 100, 2);

                        if ($data['items'][ $i ]['price_accident'] == 0) {
                            $data['items'][ $i ]['rate_accident'] = 0;
                        }
                        $data['items'][ $i ]['amount_accident'] = round(doubleval($data['items'][ $i ]['price_accident']) * doubleval($data['items'][ $i ]['rate_accident']) / 100, 2);
                        $data['items'][ $i ]['amount_agent'] = doubleval($data['items'][ $i ]['amount_kasko']) + doubleval($data['items'][ $i ]['amount_equipment']) + doubleval($data['items'][ $i ]['amount_accident']);
                        if ($data['items'][ $i ]['products_id']>0) { //корректирую чтобы не потерять сумму от которой начислять КВ агенту, вычитаем банковскую комиссию
                            $a = $data['items'][ $i ]['amount_kasko']+ doubleval($data['items'][ $i ]['amount_equipment']);
                            if ($a>0) {
                                $t= $db->getRow('SELECT IF(c.bank_discount_value>1,'.$a .'/c.bank_discount_value,  '.$a .'-('.$item['car_price'].'*c.bank_commission_value/100)    ) as val,c.bank_discount_value,c.bank_commission_value,c.agent_commission_value FROM insurance_products_kasko c WHERE c.products_id='.intval($data['items'][ $i ]['products_id']));
                                if ($t) {
                                    $data['items'][ $i ]['amount_agent'] = $t['val'];
                                    
                                    $data['items'][ $i ]['bank_commission_value'] = $t['bank_commission_value'];
                                    $data['items'][ $i ]['agent_commission_value']= $t['agent_commission_value'];
                                    $data['items'][ $i ]['bank_discount_value'] = $t['bank_discount_value'];
                                }
                                
                                if ($data['items'][ $i ]['amount_agent']<0) $data['items'][ $i ]['amount_agent'] = 0;
                                $data['items'][ $i ]['rate_agent'] = $data['items'][ $i ]['amount_agent']*100/doubleval($item['car_price']);
                                $item['amount_agent'] = $data['items'][ $i ]['amount_agent'];
                                $item['rate_agent'] = $data['items'][ $i ]['rate_agent'];
                            }
                            else $data['items'][ $i ]['amount_agent'] = 0;
                        }

                        //расчет тарифа многолетних договоров
                            if (intval($data['terms_years_id'])>1 || $data['financial_institutions_id']>0)
                            {
                                //записать данные на первый год
                                $data['next_year'] = 0;
                                $price = $item['car_price'];
                                $item['years'][$data['next_year']]['car_price']             =$item['car_price'];
                                $item['years'][$data['next_year']]['rate_kasko']            = $item['rate_kasko'];
                                $item['years'][$data['next_year']]['rate_agent']            = $item['rate_agent'];

                                $item['years'][$data['next_year']]['amount_kasko']      = $item['amount_kasko'];
                                $item['years'][$data['next_year']]['amount_agent']      = $item['amount_agent'];

                                $item['years'][$data['next_year']]['rate_equipment']        = $item['rate_equipment'];

                                $item['years'][$data['next_year']]['amount_equipment']  = $item['amount_equipment'];
                                $item['years'][$data['next_year']]['amount']            = $item['amount'];
                                $item['years'][$data['next_year']]['amount_agent']          = $item['amount_agent'];
                                
                                
                                $item['years'][$data['next_year']]['bank_commission_value'] = $item['bank_commission_value'];
                                $item['years'][$data['next_year']]['agent_commission_value'] = $item['agent_commission_value'];
                                $item['years'][$data['next_year']]['bank_discount_value']   = $item['bank_discount_value'];
                                $item['years'][$data['next_year']]['products_id']   = $item['products_id'];
                                if ($data['agreement_types_id'] == 3) {
                                    $item['years'][$data['next_year']]['f'] = 1;
                                }
                                
                                                 

                

                                $item['years'][$data['next_year']]['commission_agent_amount']   = round($item['amount_agent'] * $item['commission_agent_percent']/100,2);
                                $beginDate=$data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day'];
                                $item['years'][$data['next_year']]['date']  = $beginDate ;
                                if ($data['agreement_types_id']>0 && $data['agreement_types_id']!=2) //спец тип доп угоды копируем с предыдущего полиса остальные года
                                {
                                    $beginDate=$data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day'];
                                    $copy = $db->getAll('SELECT * FROM insurance_policies_kasko_item_years_payments WHERE date>'.$db->quote($beginDate).' AND policies_id='.intval($data['parent_id']));
                                    $first_year_prev = $db->getRow('SELECT * FROM insurance_policies_kasko_item_years_payments WHERE date<='.$db->quote($beginDate).' AND policies_id='.intval($data['parent_id']).' ORDER BY date DESC');
                                    
                                    if ($copy)
                                    {
                                        foreach($copy as $r)
                                        {
                                            $data['next_year']++;
                                            /*if ($data['options_fifty_fifty'])
                                            {
                                                $r['rate_kasko']/=2;
                                                $r['amount_kasko']/=2;
                                                $r['amount_agent']/=2;
                                            }*/
                                            
                                            $item['years'][$data['next_year']]['car_price'] =$r['item_price'];
                                            $item['years'][$data['next_year']]['rate_kasko'] = $r['rate_kasko'];
                                            $item['years'][$data['next_year']]['rate_agent'] = $r['rate_kasko'];

                                            $item['years'][$data['next_year']]['amount_kasko'] = $r['amount_kasko'];
                                            $item['years'][$data['next_year']]['amount_agent'] = $r['amount_agent'];
                                            $item['years'][$data['next_year']]['amount'] = $r['amount_kasko'];
                                            $item['years'][$data['next_year']]['products_id'] = $r['products_id'];

                                            $item['years'][$data['next_year']]['date'] = $r['date'];
                                            if ($data['agreement_types_id']==4 || $data['agreement_types_id']==3) //доп угода где может меняться страх сумма все остальное остаеться
                                            {
                                            
                                                $k_price = doubleval($item['car_price'])/doubleval($first_year_prev['item_price']);//коэф изменения цены авто
                                                if ($k_price>1.00001) {
                                                    $item['years'][$data['next_year']]['car_price'] =$r['item_price']*$k_price;
                                                    //меняем премию каско пропорционально коэф. тариф оставляем от старого договора
                                                    $item['years'][$data['next_year']]['amount_kasko'] = $r['rate_kasko']*$r['item_price']*$k_price/100;
                                                    $item['years'][$data['next_year']]['amount_agent'] = $r['rate_kasko']*$r['item_price']*$k_price/100;
                                                    $item['years'][$data['next_year']]['amount'] =$r['rate_kasko']*$r['item_price']*$k_price/100;

                                                }
                                            }
                                        }
                                    }
                                }
                                else {
                                  $driver_standings_id=$data['driver_standings_id'];
                                  $driver_ages_id=2;
                                  //провести расчет на остальные года
                                  for ($k=1;$k<$data['terms_years_id'];$k++)
                                  {
                                    if ($data['drivers_id'] != 7) //не будь який водитель корректируем стаж и возраст
                                    {
                                        $beginDate=$data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day'];
                                        //максимальная дата выдачи прав из всех
                                        $maxLicenseDate=$data['insurer_driver_licence_date_year'].'-'.$data['insurer_driver_licence_date_month'].'-'.$data['insurer_driver_licence_date_day'];
                                        if (is_array($data['persons'])) {
                                            foreach ($data['persons'] as $j => $person) {
                                                $maxLicensePersonDate=$person['driver_licence_date_year'].'-'.$person['driver_licence_date_month'].'-'.$person['driver_licence_date_day'];
                                                if (dateDifference( $maxLicensePersonDate,$maxLicenseDate)==false)
                                                {
                                                     $maxLicenseDate = $maxLicensePersonDate;
                                                }
                                            }
                                        }
                                        $curBeginDate = add_date($beginDate,0,0,$k);
                                        $licenseYears = dateDifference( $maxLicenseDate,$curBeginDate);
                                        if (intval($licenseYears[0])==0)
                                        {
                                            $driver_standings_id=1;
                                        }
                                        elseif (intval($licenseYears[0])>=1 && intval($licenseYears[0])<=3)
                                        {
                                            $driver_standings_id=2;
                                        }
                                        elseif (intval($licenseYears[0])>3 && intval($licenseYears[0])<=10)
                                        {
                                            $driver_standings_id=3;
                                        }
                                        elseif (intval($licenseYears[0])>10)
                                        {
                                            $driver_standings_id=4;
                                        }

                                        $insurer_dateofbirth =$data['insurer_dateofbirth_year'].'-'.$data['insurer_dateofbirth_month'].'-'.$data['insurer_dateofbirth_day'].' 12:00:00';
                                        $insurer_dateofbirth_years = dateDifference( $insurer_dateofbirth,$curBeginDate);

                                        if (intval($insurer_dateofbirth_years[0])<25)
                                        {
                                            $driver_ages_id=1;
                                        }
                                        elseif (intval($insurer_dateofbirth_years[0])>=25 && intval($insurer_dateofbirth_years[0])<=65)
                                        {
                                            $driver_ages_id=2;
                                        }
                                        else $driver_ages_id=3;
                                        if (is_array($data['persons'])) {
                                            foreach ($data['persons'] as $j => $person) {
                                                if ($person['driver_ages_id']>0 && $person['driver_ages_id']<$driver_ages_id)
                                                    $driver_ages_id = $person['driver_ages_id'];
                                            }
                                        }

                                    }

                                    if ($item['products_id']==296 || $item['products_id']==298 || $item['products_id']==396) //костыль укргаз мерседес
                                    {
                                        $price = doubleval($price);
                                    }
                                    elseif ($k==1) $price = doubleval($price)-doubleval($price)*($data['financial_institutions_id']==44 ? 0.1 : 0.1);//2-й год -15%
                                    else $price = doubleval($price)-doubleval($price)*0.1; //остальные годы цена падает на 10%
                                    
                                    $data['next_year']=$k;
                                    $deductibles_id=$db->getOne('SELECT id FROM insurance_product_deductibles WHERE car_types_id='.intval($item['car_types_id']).' AND products_id='.intval($item['products_id']).' AND value0='.doubleval($item['deductibles_value0']).' AND value1='.doubleval($item['deductibles_value1']));

                                    $Products->calculateNextYear($item['car_types_id'], $data['person_types_id'], $driver_standings_id, $data['drivers_id'], $price, $driver_ages_id, $data['registration_cities_id'], $data['terms_id'], $deductibles_id, $data, &$item);
                                    
                                  }
                                } 
                                //_dump($item['years']);
                                //exit;
                            }


                        break;
                }
                //продукт Сезон + И Ducati 3 в 1
                $amount_season = 0;
                if ($data['express_products_id']==138 || $data['express_products_id']==686) { //сезон +
                    $amount_season = $data['items'][ $i ]['car_price'] * 0.1/100;
                }

                //Ducati 3 в 1 НС
                $amount_ducati_ns = 0;
                if ($data['express_products_id']==686) {
                    $amount_ducati_ns = 230.75;
                }

                $data['items'][ $i ]['amount'] = $data['items'][ $i ]['amount_kasko'] + $data['items'][ $i ]['amount_equipment'] + $data['items'][ $i ]['amount_accident'] + $amount_season + $amount_ducati_ns;

                //Використання ТЗ в якості - підрахунок значення
                $data['items'][ $i ]['use_as_car'] = 0;
                $data['items'][ $i ]['use_as_car'] = $data['items'][ $i ]['use_as_car'] + $data['items'][ $i ]['use_as_car_private'] + $data['items'][ $i ]['use_as_car_work'] + $data['items'][ $i ]['use_as_car_leasing'];
                
                //ТестДрайв3. Розпорядження (користування) ТЗ на підставі - завжди приватна власність
                if ($data['express_products_id'] == PRODUCT_KASKO_TESTDRIVE3) {
                    $data['items'][ $i ]['order_basis_car_id'] = 1;
                }
            }
             

            //расчет итогового тарифа
            $data['amount_kasko'] = $data['price'] = $data['rate'] = $data['amount'] = 0;

            foreach ($data['items'] as $i => $item1) {
                $data['price']          += $item1['car_price'] + $item1['price_equipment'];
                $data['amount']         += $item1['amount'];
                $data['amount_kasko']   += $item1['amount_kasko'];
                $data['amount_agent']   += $item1['amount_agent'];
            }

            //!!! акция сертификат
            if ($data['certificate'] != '' && !in_array($data['express_products_id'], array(140)) 
                && intval($data['terms_id']) == 29 
                && intval($data['items'][ 0 ]['car_types_id']) == 8) {
                //$data['amount'] = $data['amount'] - 500;
            }
            
            if ($data["certificateTenPercent"] != '' && in_array($data['express_products_id'], array(673))) {
                //$data['amount'] = $data['amount'] * 0.9;
            }

            $data['rate'] = round($data['amount'] / $data['price'] * 100, 3);
        }

        if (!intval($data['date_day']) || !intval($data['date_month']) || !intval($data['date_year'])) {
            $data['date_day']   = date('d');
            $data['date_month'] = date('m');
            $data['date_year']  = date('Y');
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

        if(intval($data['owner_id_card'])) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('owner_passport_series') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('owner_passport_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('owner_passport_place') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('owner_passport_date') ]['verification']['canBeEmpty'] = true;
        } else {
            $this->formDescription['fields'][ $this->getFieldPositionByName('owner_newpassport_number') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('owner_newpassport_place') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('owner_newpassport_date') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('owner_newpassport_reestr') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('owner_newpassport_dateEnd') ]['verification']['canBeEmpty'] = true;   
        }

        //Конец нового паспорта

        return parent::setConstants($data);
    }

    function getNumberToContinue($data) {
        global $db;

        $result = false;

        if (intval($data['financial_institutions_id'])) {
            switch ($data['owner_person_types_id']) {
                case '1'://физ. лицо
                    $conditions[] = 'owner_identification_code = ' . $db->quote($data['owner_identification_code']);
                    break;
                case '2'://юр. лицо
                    $conditions[] = 'owner_edrpou = ' . $db->quote($data['owner_edrpou']);
                    break;
            }

            foreach ($data['items'] as $i => $item) {
                $shassi[] = $db->quote($item['shassi']);
            }

            $conditions[] = 'shassi IN(' . implode(',', $shassi) . ')';
        }

        if (is_array($conditions)) {
            $sql =  'SELECT DISTINCT a.number ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items AS c ON a.id = c.policies_id ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' ' .
                    'ORDER BY a.id DESC';
            $result = $db->getOne($sql, 30 * 60);
        }

        return $result;
    }

    function checkFields(&$data, $action) {
        global $Log, $Authorization,$db;
        
        if ($data['dontRecalcRate']==0 && $data['policy_statuses_id']!=POLICY_STATUSES_CONSULTATION && sizeof($data['items'])==1 && intval($data['id']) && !$data['actual_market_price'] && $data['types_id'] !=POLICY_TYPES_QUOTE) //перевірка на актуальність ринкової вартості
        {
            $p = $this->getMarketPrice($data['id']);
            if (!$p  || $p['market_price_expert']==0) {
                $data['is_old_market_price'] = 1;
                $data['policy_statuses_id']=1;
            }
        }

        if (!$data['payment_brakedown_id']) {
            $data['payment_brakedown_id'] = 1;
        }
        if (is_array($data['items'])) {
            foreach($data['items'] as $i=>$item) {
                //if ($item['car_types_id'] == 8) 
                //$this->itemFormDescription['fields'][ $this->getFieldPositionByName('car_body_id', $this->itemFormDescription) ]['verification']['canBeEmpty'] = false;
            
                if ( $data['dontRecalcRate']==0 && ($data['policy_statuses_id']!=POLICY_STATUSES_CONSULTATION  && (doubleval($item['market_price'])==0 || (doubleval($item['car_price'])>=3000000 &&  $Authorization->data['roles_id']==ROLES_AGENT)) && $data['policy_statuses_id']!=1 && $data['product_types_id'] == PRODUCT_TYPES_KASKO)) {
                    $data['policy_statuses_id']=1;
                }   
                if ($data['dontRecalcRate']==0 && $data['policy_statuses_id']!=POLICY_STATUSES_CONSULTATION  && doubleval($item['market_price'])>0 && $data['product_types_id'] == PRODUCT_TYPES_KASKO 
                        && (  ($data['express_products_id']==673 ? 1 : 0.5) * doubleval($item['market_price']))>doubleval($item['car_price']) ) {
                        if(!$Authorization->data['permissions']['Policies_KASKO']['superupdate'])
                            $data['policy_statuses_id']=1;
                }
                if ($data['express_products_id']==684 ) {
                    if (intval($item['car_price']) !=10000 && intval($item['car_price']) !=20000 && intval($item['car_price']) !=50000)
                        $Log->add('error','Страхова вартість, грн повинна бути  10000 або 20000 або 50000');
                }
            }
        }
        
        
        if (!intval($data['id']) && $data['types_id'] == POLICY_TYPES_AGREEMENT && !intval($data['parent_id'])) {
            $number = $this->getNumberToContinue($data);
            if ($number && false) {
                $Log->add('error', 'Поліс <b>' . $number . '</b> потребує пролонгації.');
                return;
            }
        }
        
        if($data['parent_id'] && intval($data['parent_id']) > 0 && intval($data['outside_client']) === 1 && !$this->checkPermissionsBooleanResult("outside_client")) {
            $Log->add('error', 'Клієнт раніше був застрахований в <b>ТДВ «Експрес Страхування»</b>, він не може мати статус <b>Стороннього клієнта</b>.');
        }

        if($data['manager_id'] && intval($data['manager_id']) > 0 && intval($data['outside_client']) === 1 && !$this->checkPermissionsBooleanResult("outside_client")) {
            $Log->add('error', 'Клієнт, якого привів менеджер, не може мати статус <b>Стороннього клієнта</b>.');
        }
                
        if ($Authorization->data['roles_id']==ROLES_AGENT && intval($data['solutions_id'])==0 && intval($data['financial_institutions_id'])==0 &&   intval($data['parent_id'])==0 && intval($data['outside_client'])==0 && intval($Authorization->data['ukravto'])==1 ) //машина не из ЭК нужно заполнить менеджера 
        {
            $this->formDescription['fields'][ $this->getFieldPositionByName('manager_id') ]['verification']['canBeEmpty'] = false;
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
         
        /*if ($data['manager_id']>0 && $data['parent_id']>0 && doubleval($data['motivation_manager_percent'])==0  && $data['individual_motivation']) {
            $Log->add('error', 'Необхідно заповнити мотивацiю <b>Менеджер що привiв клiєнта</b>');
        }*/

        if ($data['items'][ 0 ]['products_id'] ==267 || $data['items'][ 0 ]['products_id'] ==265 ) { //костыль для КАСКО. Кредит. Ідея Банк (1-й г) сделать необяз. поля по власнику
            $empty_fields = array ('owner_dateofbirth',
                                    'owner_passport_series',
                                    'owner_passport_number',
                                    'owner_passport_place',
                                    'owner_passport_date',
                                    'owner_identification_code',
                                    'owner_regions_id',
                                    'owner_area',
                                    'owner_city',
                                    'owner_street_types_id',
                                    'owner_street',
                                    'owner_phone',

                                    'owner_newpassport_number',
                                    'owner_newpassport_place',
                                    'owner_newpassport_date',
                                    'owner_newpassport_reestr',
                                    'owner_newpassport_dateEnd',

                                    'insurer_position',
                                    'insurer_bank_account',
                                    'insurer_driver_licence_series',
                                    'insurer_driver_licence_number',
                                    'insurer_driver_licence_date',
                                    'owner_house',
                                    'owner_flat');
            foreach ($empty_fields as $f)
            {
                $this->formDescription['fields'][ $this->getFieldPositionByName($f) ]['verification']['canBeEmpty'] = true;
            }           
        }
        //_dump($data['payment_brakedown_id']);exit;
        if (intval($data['options_month500'])) //місяць страхування за 500 грн:
        {
                if (/*$data['insurer_person_types_id']!=1 || $data['items'][0]['car_types_id']!='8' || $data['items'][0]['race']>0
                    || $data['priority_payments_id']!=1 ||*/ $data['payment_brakedown_id']!=1 || $data['terms_id']!=29 || $data['financial_institutions_id']>0)
                {
                    $Log->add('error','Використання опцiї "місяць страхування за 500 грн" можливо за наступних умов: <br> Оплата: 1 платiж');
                }
                if (sizeof($data['items'])>1) 
                    $Log->add('error','Використання опцiї "місяць страхування за 500 грн" заборонено для автопарку');
                //if ($data['certificate'])
                //  $Log->add('error','Використання опцiї "місяць страхування за 500 грн" не можливо одночасно зi знижкою 500 грн. на КАСКО:');
        }
        
        if (sizeof($data['items'])>1 && $data['drivers_id']!=7) $data['drivers_id'] = 7;

        if (intval($data['options_month500']) && intval($data['options_fifty_fifty'])) {
            $Log->add('error','Використання опцiй "місяць страхування за 500 грн" та "50 на 50" одночасно <b>неможливе</b>');
        }
        if (intval($data['options_fifty_fifty']) && sizeof($data['items'])>1)
            $Log->add('error','Використання опцiї "50 на 50" неможливе для автопарку');

        if (intval($data['options_fifty_fifty']) && intval($data['terms_id']) != 29 && !$Authorization->data['permissions']['Policies_KASKO']['superupdate']) {
            
            $Log->add('error','При використанні опції "50 на 50" можливе страхування тiльки на 1 рiк');
        }
        
        if (intval($data['options_fifty_fifty']) && intval($data['payment_brakedown_id']) != 1) {
            $Log->add('error','При використанні опції "50 на 50" розбивка платежу <b>неможлива</b>');
        }
        
        if (intval($data['options_fifty_fifty']) && sizeof($data['risks']) != 7) {
            $Log->add('error','При використанні опції "50 на 50" необхiдне страхування повного КАСКО');
        }
        

        

        //проверить чтобы полис небыл включен в агенские акты
        if (!$data['skipCalendar'] && !$data['dontRecalcRate'] && intval($data['id'])>0) {
            if ($this->isInAct($data['id'])) {
                $Log->add('error', 'Поліс вже включено до агенських актiв. Використовуйте режим змiни без перерахунку тарифу.');
            }
        }

        if ($data['drivers_id'] == 7) {// будь яка особа
            $this->formDescription['fields'][ $this->getFieldPositionByName('driver_ages_id') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'][ $this->getFieldPositionByName('driver_standings_id') ]['verification']['canBeEmpty'] = true;
        }

        parent::checkFields($data, $action);

        if ($data['number'] && $data['next_policy_statuses_id'] != POLICY_STATUSES_RENEW) {
            if ($this->isExists($this->tables[0], 'number', $data['number'], $data['id'], $data)) {
                $Log->add('error', 'Поліс з номером <b>' . $data['number'] . '</b> вже існує.');
            }
        }

        if ($data['types_id'] != 2 && intval($data['options_race'])) {
            $Log->add('error', 'Використання опцiї Перегон можливо лише у режимі котирування.');
        }

        if (intval($data['options_race'])) {
            //$this->itemFormDescription['fields'][ $this->getFieldPositionByName( 'route' ,$this->itemFormDescription) ]['verification']['canBeEmpty'] = false;
        }

        if (is_array($data['items'])) {
            foreach ($data['items'] as $i => $item) {
                //проверяем данные из описания формы автомобиля

                if (($data['financial_institutions_id']==19 || $data['financial_institutions_id']==52 || $data['financial_institutions_id']==16 || $data['products_id']==164) && $data['types_id']!=2) { //костыль укргаз банк проверить чтобы был НЕ заполнен
                    if (doubleval($item['price_accident'])>0)
                        $Log->add('error', 'Для Укргазбанку,ПУМБ,КредитДнепр,Эрсте  НВ заповнюється окремим договором');
                    if (doubleval($item['rate_accident'])>0)
                        $Log->add('error', 'Для Укргазбанку,ПУМБ,КредитДнепр,Эрсте  НВ заповнюється окремим договором');
                }


                switch (intval($item['deductibles_absolute0'])) {
                    case 0://устанавливаем тип франщизы %
                        $this->itemFormDescription['fields'][ $this->getFieldPositionByName('deductibles_value0', $this->itemFormDescription) ]['type'] = fldPercent;
                        break;
                    case 1://устанавливаем тип франщизы грн.
                        $this->itemFormDescription['fields'][ $this->getFieldPositionByName('deductibles_value0', $this->itemFormDescription) ]['type'] = fldMoney;
                        break;
                }

                switch (intval($item['deductibles_absolute1'])) {
                    case 0://устанавливаем тип франщизы %
                        $this->itemFormDescription['fields'][ $this->getFieldPositionByName('deductibles_value1', $this->itemFormDescription) ]['type'] = fldPercent;
                        break;
                    case 1://устанавливаем тип франщизы грн.
                        $this->itemFormDescription['fields'][ $this->getFieldPositionByName('deductibles_value1', $this->itemFormDescription) ]['type'] = fldMoney;
                        break;
                }

                foreach($this->itemFormDescription['fields'] as $field) {
                    if ($field['display'][ $action ] && !$field['readonly']) {
                        if ($field['multiLanguages'] && $field['sourceTable'] == '') {
                            foreach($this->languages as $languageCode=>$languageDescription) {
                                $languageDescription = (sizeOf($this->languages) < 2) ? '' :  '(' . $languageDescription . ')';
                                $this->checkField($item, $field, $languageCode, $languageDescription);
                            }
                        } else {
                            $this->checkField($item, $field);
                        }
                    }
                }

                //проверяем полноту заполнения данных по ДО
                foreach($item['equipment'] as $equipment) {
                    foreach($this->equipmentFormDescription['fields'] as $field) {
                        if ($field['display'][ $action ] && !$field['readonly']) {
                            if ($field['multiLanguages'] && $field['sourceTable'] == '') {
                                foreach($this->languages as $languageCode=>$languageDescription) {
                                    $languageDescription = (sizeOf($this->languages) < 2) ? '' :  '(' . $languageDescription . ')';
                                    $this->checkField($$equipment, $field, $languageCode, $languageDescription);
                                }
                            } else {
                                $this->checkField($equipment, $field);
                            }
                        }
                    }
                }
                if (!$data['dontRecalcRate']) {
                //проверяем размеры комиссионных вознаграждений

                    if ($item['commission_agency_percent'] > 0) {
                        if (!$this->isValidPercent($item['commission_agency_percent'])) {
                            $params = array('Комісія. Агенція. Розмір комісії, %', '');
                            $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                        }
                    } 

                    if ($item['commission_agent_percent'] > 0) {
                        if (!$this->isValidPercent($item['commission_agent_percent'])) {
                            $params = array('Комісія. Агент. Розмір комісії, %', '');
                            $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                        }
                    } 


                }
            }
        }

        if ($data['card_assistance'] != '' && $data['id']>0) {
            $car_used = $db->getOne('SELECT policies_id FROM insurance_policies_kasko WHERE card_assistance='.$db->quote($data['card_assistance']).' and policies_id<>'.intval($data['id']));
            if ($car_used>0) {
                $Log->add('error', 'Вказаний Номер картки Експрес Асістанс вже використовується');
            }
        }

        //проверяем полноту данных по другим застрахованным
        if (is_array($data['persons']) && $data['dontCheckFormat'] == 0) {

            foreach ($data['persons'] as $i => $row) {
                if ($row['lastname'] == '') {
                    $params = array('Прізвище', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                }

                if ($row['firstname'] == '') {
                    $params = array('Ім\'я', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                }

                if ($row['patronymicname'] == '') {
                    $params = array('По батькові', null);
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                }
                if (intval($data['express_products_id'])==0 || $data['express_products_id']==110) {
                    if (!intval($row['driver_ages_id'])) {
                        $params = array('Вік', null);
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }

                    if ($row['driver_licence_series'] == '') {
                        $params = array('Водійські права, серія', null);
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }

                    if ($row['driver_licence_number'] == '') {
                        $params = array('Водійські права, номер', null);
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    } elseif (!ereg('(^[0-9]{6}$)|(^[0-9]{9}$)', $row['driver_licence_number'])) {
                        $params = array('Водійські права, номер', null);
                        $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                    }

                    if (!intval($row['driver_licence_date_month']) || !intval($row['driver_licence_date_day']) || !intval($row['driver_licence_date_year'])) {
                        $params = array('Водійські права, дата', null);
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    } else if (!checkdate($row['driver_licence_date_month'], $row['driver_licence_date_day'], $row['driver_licence_date_year'])) {
                        $params = array('Водійські права, дата', null);
                        $Log->add('error', 'The date <b>%s</b>%s is not valid.', $params);
                    }
                }
            }
        }

        if ($Authorization->data['roles_id'] != ROLES_ADMINISTRATOR) {
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
            if ($data['product_types_id'] != PRODUCT_TYPES_DRIVE_CERTIFICATE && $begin_datetime != 0 && $begin_datetime < $date) {
                $Log->add('error', '<b>Дата початку дії полісу</b> не може бути раніше ніж <b>Дата поліса</b>.');
            }
        }

        if ($data['product_types_id'] == PRODUCT_TYPES_KASKO /*&& $action=='insert'*/) {

            //ищем клиента и полис по машине
            $Clients = new Clients($data);
            $client = ($data['insurer_person_types_id'] == 2)
                ? $Clients->getByIdentificationCode($data['insurer_edrpou'])//юрлицо
                : $Clients->getByIdentificationCode($data['insurer_identification_code']);//физик

            if ((is_array($client) && $client['id'] > 0) || intval($data['parent_id']) > 0) {
            //if(intval($data['parent_id']) > 0) {
                if (is_array($data['items'])) {

                    $conditions = array();
                    if ($data['id']>0) {
                        $conditions[]='a.policies_id<>'.intval($data['id']);
                    }
                    foreach ($data['items'] as $i => $item) {
                        if ($item['shassi']) {
                            $conditions[]=' a.shassi= '.$db->quote($item['shassi']);
                        }
                    }
                    
                    if ($data['insurer_person_types_id'] == 2) {
                        $conditions[] = 'c.insurer_edrpou = ' . $db->quote($data['insurer_edrpou']);
                    } else {
                        $conditions[] = 'c.insurer_identification_code = ' . $db->quote($data['insurer_identification_code']);
                    }

                    if (sizeof($conditions)) {//клиент + чтобы одна из машин была в предыдущих полисах КАСКО
                        $sql =  'SELECT a.policies_id, c.financial_institutions_id ' .
                                'FROM ' . PREFIX . '_policies_kasko_items AS a '.
                                'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                                'JOIN ' . PREFIX . '_policies_kasko AS c ON a.policies_id = c.policies_id ' .
                                'WHERE ('.implode(' AND ', $conditions).')  AND b.payment_statuses_id>=3  ' .
                                'ORDER BY b.date DESC LIMIT 1';
                        $row = $db->getRow($sql);
//_dump($sql);  exit;
                        $policies_id = (is_array($row)) ? $row['policies_id'] : 0;

                        $financial_institutions_id = (is_array($row)) ? $row['financial_institutions_id'] : 0;
//_dump($data['parent_id']) ;_dump(intval($policies_id));exit;
                        if (intval($data['parent_id']) > 0 && intval($policies_id) && intval($data['parent_id']) != intval($policies_id) /*&& intval($data['agreement_types_id'])==0*/) {//предыдущий полис несовпадает с загруженым могли изменить данные
                            $Log->add('error', 'Вказані данні по клієнту або авто не співпадають с попереднім полісом, режим пролонгації скасовано');
                            $data['parent_id'] = 0;
                        }

                        //есть клиент в базе, у него есть банк в предыдущем полисе, и он равен банку в текущем полисе но parent_id нету из за несовпадения данных
                        if ($data['parent_id'] == 0 && intval($policies_id)>0 && !$Authorization->data['permissions']['Policies_KASKO']['superbonusmalus']  /*&& $data['financial_institutions_id'] > 0 && $financial_institutions_id > 0 && $data['financial_institutions_id'] == $financial_institutions_id*/) {
                            $Log->add('error', 'Вказаний клієнт вже має попередній поліс необхідно використовувати режим пролонгації');
                        } elseif($data['parent_id'] == 0) {//установить parent_id для небанковских договоров
                            //$data['parent_id']=intval($policies_id);
                        }
                    }
                }
            } elseif(intval($data['parent_id']) > 0) {
                $Log->add('error', 'Клієнт з вказаним ІПН/ЄДРОПУ не знайдений, поліс не може бути пролонгований');
            }
        }

        if (intval($data['parent_id']) > 0) {
            $sql =  'SELECT IF(DATEDIFF(' . $db->quote($data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day']) . ', interrupt_datetime) < 0, 1, 0) AS renew, ' .
                    'IF(DATE_ADD(interrupt_datetime, INTERVAL ' . POLICY_CONTINUE_PERIOD . ') > ' . $db->quote($data['date_year'].'-'.$data['date_month'].'-'.$data['date_day']) . ', 1, 0) AS prolongation, ' .
                    'IF(DATE_ADD(interrupt_datetime, INTERVAL ' . POLICY_CONTINUE_PERIOD2 . ') > ' . $db->quote($data['date_year'].'-'.$data['date_month'].'-'.$data['date_day']) . ', 1, 0) AS prolongation2 ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id = ' . intval($data['parent_id']);
            $row = $db->getRow($sql);

            if (intval($row['renew']) == 1) {
                $data['states_id'] = POLICY_STATES_RENEW;//переукладений
            } elseif ($row['prolongation']) {//меньше 3 месяцев
                $data['states_id'] = POLICY_STATES_CONTINUED;//пролонгованый
            } else {
                $data['states_id'] = 0;//неизвестно
            }
            
            if ($row['prolongation2']) {
                $data['states_id2'] = POLICY_STATES_CONTINUED;//пролонгованый
            } else {
                $data['states_id2'] = 0;
            }
//_dump($data['states_id']);exit;           
            //закрыть возможность пролонгировать многолетние
            if ($data['next_policy_statuses_id']!=POLICY_STATUSES_RENEW && intval($row['renew']) == 1 && $Authorization->data['roles_id'] == ROLES_AGENT && intval($_SESSION['auth']['agent_financial_institutions_id'])==0) //не доп угода и прошлый полис еще действует
            {
                if ($_SESSION['auth']['agencies_id']!=SELLER_AGENCIES_ID)
                $Log->add('error', 'Поліс неможе бути пролонгований тому що попередний поліс ще не закінчив свою дію');
            }
        }

        //!!!акция Сертификаты
        if ($data['certificate'] != '' && $data['insurance_companies_id'] != INSURANCE_COMPANIES_EXPRESS) {
            $Log->add('error', 'Сертифікати діють при оформленні полісу КАСКО від СК &quot;Експрес Страхування&quot;.');
        } elseif ($data['certificate'] != '' && !ereg('^[0-9]{8}$', $data['certificate'])) {
            $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', array('Сертифікат на 500 грн.', ''));
        } elseif ($data['certificate'] != '' && !in_array($data['policy_statuses_id'], array(POLICY_STATUSES_CREATED, POLICY_STATUSES_GENERATED))) {
            $Log->add('error', 'Сертифікати діють при оформленні полісу КАСКО (статуси "Створено" та "Сформовано").');
        } elseif ($data['certificate'] != '') {
            $sql =  'SELECT id ' .
                        'FROM ' . PREFIX . '_policies ' .
                        'WHERE product_types_id=3 AND certificate = ' . $db->quote( $data['certificate'] ).' AND id<>'.intval($data['id']).' '.
                        'ORDER BY product_types_id';
            $policiesId = $db->getOne($sql);
            if ($policiesId>0)  {
                $Log->add('error', 'Вказаний Сертифікат може бути видан тільки по одному полісу КАСКО.');
            }
        }

        if ($data["certificateTenPercent"] != '' && !ereg('^[0-9]{4}$', $data['certificateTenPercent'])) {
            $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', array('Номер сертифiкату знижка КАСКО 10%', ''));
        } elseif ($data["certificateTenPercent"] != '') {
            $sql =  'SELECT policies_id ' .
                        'FROM ' . PREFIX . '_policies_kasko ' .
                        'WHERE certificateTenPercent = ' . $db->quote( $data['certificateTenPercent'] ).' AND policies_id <>'.intval($data['id']);
            $policiesId = $db->getOne($sql);
            if ($policiesId>0)  {
                $Log->add('error', 'Номер сертифiкату знижка КАСКО 10% може бути видан тільки по одному полісу КАСКО.');
            }
        }

        //проверка оформления банковского договора как ритейл
        if (!in_array($data['agencies_id'], array(1, 37,65, 1469)) && !intval($data['financial_institutions_id'])) {
            foreach ($data['items'] as $item) {
                if (strlen($item['sign']) && strlen($item['shassi'])) {
                    $sql =  'SELECT count(*) ' .
                            'FROM insurance_policies_kasko_items ' .
                            'JOIN insurance_policies_kasko ON insurance_policies_kasko_items.policies_id = insurance_policies_kasko.policies_id ' .
                            'WHERE (sign = ' . $db->quote($item['sign']) . ' OR shassi = ' . $db->quote($item['shassi']) . ') AND insurance_policies_kasko.financial_institutions_id <> 0';
                    $count = $db->getOne($sql);

                    if ($count > 0) {
                        //проверить может уже были ритейлы у салонов тогда можно страховать
                        $sql =  'SELECT count(*) ' .
                            'FROM insurance_policies_kasko_items ' .
                            'JOIN insurance_policies_kasko ON insurance_policies_kasko_items.policies_id = insurance_policies_kasko.policies_id ' .
                            'JOIN insurance_policies ON insurance_policies.id=insurance_policies_kasko.policies_id '.
                            'WHERE insurance_policies.agencies_id NOT IN (1, 65, 1469) AND (sign = ' . $db->quote($item['sign']) . ' OR shassi = ' . $db->quote($item['shassi']) . ') AND insurance_policies_kasko.financial_institutions_id = 0';
                        $count = intval($db->getOne($sql));
                        if ($count == 0)
                            $Log->add('error', 'Випуск договорів КАСКО клієнтів, що кредитувалися в мережі УкрАВТО заборонено.');
                    }
                }
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

        if(intval($data['owner_id_card'])) {
            if(intval($data['owner_newpassport_dateEnd_day']) !== intval($data['owner_newpassport_date_day']) 
                || intval($data['owner_newpassport_dateEnd_month']) !== intval($data['owner_newpassport_date_month'])
                || intval($data['owner_newpassport_dateEnd_year']) !== (intval($data['owner_newpassport_date_year']) + 10)) {
                $Log->add('error', 'Дата закінчення строку дії нового паспорту Власника не відповідає нормам. Має бути Дата початку дії плюс 10 років.');
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

        if(intval($data['owner_id_card'])) {
            if(!intval($data['owner_newpassport_place'])) {
                $Log->add('error', 'Поле "Паспорт. Ким і де виданий" Власника має приймати тільки числові значення.');
            }

            if(!preg_match('/^\d{9}$/', $data['owner_newpassport_number'])) {
                $Log->add('error', 'Поле "Паспорт. Номер" Власника заповнено невірно.');
            }

            if(strlen($data['owner_newpassport_reestr']) !== 14) {
                $Log->add('error', 'Поле "Унікальний номер запису в реєстрі" Власника заповнено невірно.');
            }
        }
    }

    //обновляем информцию по ДО в рамках полиса
    function updateEquipment($policies_id, $items_id, $equipment) {
        global $db;

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policies_kasko_item_equipment ' .
                'WHERE items_id = ' . intval($items_id);
        $db->query($sql);

        if (is_array($equipment)) {
            foreach ($equipment as $row) {
                $sql =  'INSERT INTO ' . PREFIX . '_policies_kasko_item_equipment SET ' .
                        'policies_id = ' . intval($policies_id) . ', ' .
                        'items_id = ' . intval($items_id) . ', ' .
                        'title = ' . $db->quote($row['title']) . ', ' .
                        'brand = ' . $db->quote($row['brand']) . ', ' .
                        'model = ' . $db->quote($row['model']) . ', ' .
                        'price = ' . $db->quote($row['price']) . ', ' .
                        'created = NOW()';
                $db->query($sql);
            }
        }
    }

    //устанавливаем дополнительные значения
    function setItemAdditionalValues($data, $item) {
        global $db;

        $conditions[] = 'a.id = ' . intval($item['brands_id']);
        $conditions[] = 'b.id = ' . intval($item['models_id']);

        $sql =  'SELECT a.title AS brand, b.title AS model ' .
                'FROM ' . PREFIX . '_car_brands AS a, ' .
                PREFIX . '_car_models AS b ' .
                'WHERE a.id = ' . intval($item['brands_id']) . ' AND b.id = ' . intval($item['models_id']);
        $car = $db->getRow($sql);

        $item = array_merge($item, $car);
        if (intval($item['products_id']>0)) {
            $sql =  'SELECT b.code AS products_code, b.title AS products_title ' .
                    'FROM ' . PREFIX . '_products AS b   ' .
                    'WHERE b.id = ' . intval($item['products_id']);
            $product = $db->getRow($sql);

            $item = array_merge($item, $product);
        }
        elseif (intval($item['deductibles_id'])) {
            $sql =  'SELECT b.code AS products_code, b.title AS products_title ' .
                    'FROM ' . PREFIX . '_product_deductibles AS a ' .
                    'JOIN ' . PREFIX . '_products AS b ON a.products_id = b.id ' .
                    'WHERE a.id = ' . intval($item['deductibles_id']);
            $product = $db->getRow($sql);

            $item = array_merge($item, $product);
        }
        elseif($item['id']>0)
        {
            $sql =  'SELECT b.code AS products_code, b.title AS products_title ' .
                    'FROM ' . PREFIX . '_policies_kasko_items AS a ' .
                    'JOIN ' . PREFIX . '_products AS b ON a.products_id = b.id ' .
                    'WHERE a.id = ' . intval($item['id']);
            $product = $db->getRow($sql);
            if ($product)
                $item = array_merge($item, $product);
        }

        $item['use_as_car'] = 0;
        $item['use_as_car'] = $item['use_as_car'] + $item['use_as_car_private'] + $item['use_as_car_work'] + $item['use_as_car_leasing'];

        return $item;
    }

    function updateItems($policies_id, &$items,$dontRecalcRate = 0,$data = null) {
        global $db,$Templates;

        if (is_array($items)) {
            $ids = array();
            foreach ($items as $itemId=>$item) {
                if (intval($item['id'])>0) {
                    $ids[] = $item['id'];
                }
            }

            if (sizeof($ids)>0) {//удаляем все объекты, что больше не используются
                $sql =  'DELETE ' .
                        'FROM ' . PREFIX . '_policies_kasko_items ' .
                        'WHERE policies_id = ' . intval($policies_id) . ' AND id NOT IN (' . implode(', ', $ids) . ')';
                $db->query($sql);
            }
        }

        if (is_array($items)) {
            foreach ($items as $itemId=>$item) {
                $years = $item['years'];
                $equipment = $item['equipment'];
                foreach ($item as $k=>$v)
                {
                    $item[$k]=htmlspecialchars($this->replaceTags(trim($v)));
                }
                $item['years'] = $years;
                $item['equipment'] = $equipment;
                
                if ($data['express_products_id']>0 && $data['express_products_id']!=$item['products_id']) {
                    $item['products_id'] = $data['express_products_id'];
                }   
                
                
                $item = $this->setItemAdditionalValues($data, $item);

                $action = (intval($item['id'])) ? 'UPDATE' : 'INSERT INTO';


                $sql =  $action . ' ' . PREFIX . '_policies_kasko_items SET ' .
                        'policies_id = ' . intval($policies_id) . ', ' .
                        'car_types_id = ' . intval($item['car_types_id']) . ', ' .
                        'brands_id = ' . intval($item['brands_id']) . ', ' .
                        'brand = ' . $db->quote($item['brand']) . ', ' .
                        'models_id = ' . intval($item['models_id']) . ', ' .
                        'model = ' . $db->quote($item['model']) . ', ' .
                        'car_price = ' . $db->quote($item['car_price']) . ', ' .
                        'market_price = ' . $db->quote($item['market_price']) . ', ' .
                        'engine_size = ' . intval($item['engine_size']) . ', ' .
                        'transmissions_id = ' . intval($item['transmissions_id']) . ', ' .
                        'car_engine_type_id = ' . intval($item['car_engine_type_id']) . ', ' .
                        'car_body_id = ' . intval($item['car_body_id']) . ', ' .
                        'modification = ' . $db->quote($item['modification']) . ', ' .
                        
                        'year = ' . intval($item['year']) . ', ' .
                        'race = ' . intval($item['race']) . ', ' .
                        'colors_id = ' . intval($item['colors_id']) . ', ' .
                        'number_places = ' . intval($item['number_places']) . ', ' .
                        'shassi = ' . $db->quote($item['shassi']) . ', ' .
                        'other_policies =' . $db->quote($item['other_policies']) . ', ' .
                        'order_basis_car_id =' . $db->quote($item['order_basis_car_id']) . ', ' .
                        'use_as_car =' . $db->quote($item['use_as_car']) . ', ' .
                        'sign = ' . $db->quote($item['sign']) . ', ' .
                        'route = ' . $db->quote($item['route']) . ', ' .
                        'protection_multlock = ' . intval($item['protection_multlock']) . ', ' .
                        'no_immobiliser = ' . intval($item['no_immobiliser']) . ', ' .
                        'protection_immobilaser = ' . intval($item['protection_immobilaser']) . ', ' .
                        'protection_manual = ' . intval($item['protection_manual']) . ', ' .
                        'protection_signalling = ' . intval($item['protection_signalling']) . ', ' .
                        'engine_sizes_id = ' . intval($item['engine_sizes_id']) . ' '.
                        (!$dontRecalcRate ?
                        ', ' .'price_ranges_value = ' . $db->quote($item['price_ranges_value']) . ', ' .
                        'engine_sizes_value = ' . $db->quote($item['engine_sizes_value']) . ', ' .
                        //'transmissions_value = ' . $db->quote($item['transmissions_value']) . ', ' .
                        'car_years_value = ' . $db->quote($item['car_years_value']) . ', ' .
                        'special_car_value = ' . $db->quote($item['special_car_value']) . ', ' .
                        'drivers_value = ' . $db->quote($item['drivers_value']) . ', ' .
                        'driver_standings_value = ' . $db->quote($item['driver_standings_value']) . ', ' .
                        'car_numbers_value = ' . $db->quote($item['car_numbers_value']) . ', ' .
                        'driver_ages_value = ' . $db->quote($item['driver_ages_value']) . ', ' .
                        'regions_value = ' . $db->quote($item['regions_value']) . ', ' .
                        'priority_payments_value = ' . $db->quote($item['priority_payments_value']) . ', ' .
                        'residences_value = ' . $db->quote($item['residences_value']) . ', ' .
                        'terms_value = ' . $db->quote($item['terms_value']) . ', ' .
                        'payment_brakedown_value = ' . $db->quote($item['payment_brakedown_value']) . ', ' .
                        'zones_value = ' . $db->quote($item['zones_value']) . ', ' .
                        'alarm_value = ' . $db->quote($item['alarm_value']) . ', ' .

                        'products_id = ' . intval($item['products_id']) . ', ' .
                        'products_code = ' . $db->quote($item['products_code']) . ', ' .
                        'products_title = ' . $db->quote($item['products_title']) . ', ' .
                        'products_base_rate = ' . $db->quote($item['products_base_rate']) . ', ' .
                        'deductibles_id = ' . intval($item['deductibles_id']) . ', ' .
                        'deductibles_value0 = ' . $db->quote($item['deductibles_value0']) . ', ' .
                        'deductibles_absolute0 = ' . intval($item['deductibles_absolute0']) . ', ' .
                        'deductibles_value1 = ' . $db->quote($item['deductibles_value1']) . ', ' .
                        'deductibles_absolute1 = ' . intval($item['deductibles_absolute1']) . ', ' .
                        'deductibles_value_other = ' . $db->quote($item['deductibles_value_other']) . ', ' .
                        'deductibles_value_hijacking = ' . $db->quote($item['deductibles_value_hijacking']) . ', ' .


                        'base_rate_dtp = ' . $db->quote($item['base_rate_dtp']) . ', ' .
                        'base_rate_hijacking = ' . $db->quote($item['base_rate_hijacking']) . ', ' .
                        'base_rate_pdto = ' . $db->quote($item['base_rate_pdto']) . ', ' .
                        'base_rate_fire = ' . $db->quote($item['base_rate_fire']) . ', ' .
                        'base_rate_actofgod = ' . $db->quote($item['base_rate_actofgod']) . ', ' .
                        'base_rate_downfall = ' . $db->quote($item['base_rate_downfall']) . ', ' .
                        'base_rate_animal = ' . $db->quote($item['base_rate_animal']) . ', ' .

                        'options_deterioration_no_value = ' . $db->quote($item['options_deterioration_no_value']) . ', ' .
                        'options_deductible_glass_no_value = ' . $db->quote($item['options_deductible_glass_no_value']) . ', ' .
                        'options_first_accident_value = ' . $db->quote($item['options_first_accident_value']) . ', ' .
                        'options_season_value = ' . $db->quote($item['options_season_value']) . ', ' .
                        'options_workers_list_value = ' . $db->quote($item['options_workers_list_value']) . ', ' .
                        'options_fifty_fifty_value = ' . $db->quote($item['options_fifty_fifty_value']) . ', ' .
                        'options_holiday_value = ' . $db->quote($item['options_holiday_value']) . ', ' .
                        'options_work_value = ' . $db->quote($item['options_work_value']) . ', ' .
                        'options_taxy_value = ' . $db->quote($item['options_taxy_value']) . ', ' .
                        'options_test_drive_value = ' . $db->quote($item['options_test_drive_value']) . ', ' .
                        'options_agregate_no_value = ' . $db->quote($item['options_agregate_no_value']) . ', ' .
                        'options_years_value = ' . $db->quote($item['options_years_value']) . ', ' .

                        'bank_discount_value = ' . $db->quote($item['bank_discount_value']) . ', ' .
                        'bank_commission_value = ' . $db->quote($item['bank_commission_value']) . ', '.
                        'agent_commission_value = ' . $db->quote($item['agent_commission_value']) . ', '.

                        'rate_kasko = ' . $db->quote($item['rate_kasko']) . ', ' .
                        'amount_kasko = ' . $db->quote($item['amount_kasko']) . ', ' .
                        'price_accident = ' . $db->quote($item['price_accident']) . ', ' .
                        'rate_accident = ' . $db->quote($item['rate_accident']) . ', ' .
                        'amount_accident = ' . $db->quote($item['amount_accident']) . ', ' .
                        'price_equipment = ' . $db->quote($item['price_equipment']) . ', ' .
                        'rate_equipment = ' . $db->quote($item['rate_equipment']) . ', ' .
                        'amount_equipment = ' . $db->quote($item['amount_equipment']) . ', ' .
                        'amount = ' . $db->quote($item['amount']) . ', ' .
                        'amount_agent = ' . $db->quote($item['amount_agent']) . ', ' .
                        'commission_agency_percent = ' . $db->quote($item['commission_agency_percent']) . ', ' .
                        'commission_agent_percent = ' . $db->quote($item['commission_agent_percent']) . ', ' .

                        'director1_commission_percent = ' . $db->quote($item['director1_commission_percent']) . ', ' .

                        'director2_commission_percent = ' . $db->quote($item['director2_commission_percent']) . ', ' .
                        'commission_manager_percent = ' . $db->quote($item['commission_manager_percent']) . ', ' .
                        'commission_seller_agents_percent = ' . $db->quote($item['commission_seller_agents_percent']) . ', ' .
                        
                        
                        'commission_agency_discount_percent = ' . $db->quote($item['commission_agency_discount_percent']) . ', ' .
                        'commission_agent_discount_percent = ' . $db->quote($item['commission_agent_discount_percent']) . ', ' .
                        'director1_commission_discount_percent = ' . $db->quote($item['director1_commission_discount_percent']) . ', ' .
                        'director2_commission_discount_percent = ' . $db->quote($item['director2_commission_discount_percent']) . ', ' .
                        'commission_manager_discount_percent = ' . $db->quote($item['commission_manager_discount_percent']) . ', ' .
                        'commission_seller_agents_discount_percent = ' . $db->quote($item['commission_seller_agents_discount_percent']) . ', ' .
                        
                        
                        
                        'formula = ' . $db->quote($item['formula']) . ' '
                        : '')   ;

                if (intval($item['id'])) {
                    $sql .= 'WHERE id=' . $item['id'];
                }

                $db->query($sql);
                
                if (doubleval($item['car_price'])>=500000) //отправить письмо
                {
                    $subject = $data['number'].' цена авто: '.$item['car_price'];
                    $Templates->send('y.belik@express-group.com.ua', null, null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, null);
                }


                if (!intval($item['id'])) {
                    $item['id'] = mysql_insert_id();
                }

                $this->updateEquipment($policies_id, $item['id'], $item['equipment']);
                $items[$itemId]=$item;

            }
        }
    }

    function updatePersons($policies_id, $persons) {
        global $db;

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policies_kasko_persons ' .
                'WHERE policies_id = ' . intval($policies_id);
        $db->query($sql);

        if (is_array($persons)) {
            foreach ($persons as $row) {
                if ($row['lastname']) {
                    $sql =  'INSERT INTO ' . PREFIX . '_policies_kasko_persons SET ' .
                            'policies_id = ' . intval($policies_id) . ', ' .
                            'lastname = ' . $db->quote($row['lastname']) . ', ' .
                            'firstname = ' . $db->quote($row['firstname']) . ', ' .
                            'patronymicname = ' . $db->quote($row['patronymicname']) . ', ' .
                            'driver_ages_id = ' . intval($row['driver_ages_id']) . ', ' .
                            'driver_licence_series = ' . $db->quote($row['driver_licence_series']) . ', ' .
                            'driver_licence_number = ' . $db->quote($row['driver_licence_number']) . ', ' .
                            'driver_licence_date = ' . $db->quote($row['driver_licence_date_year'] . '-' . $row['driver_licence_date_month'] . '-' . $row['driver_licence_date_day']) . ', ' .
                            'created = NOW()';
                    $db->query($sql);
                }
            }

            $sql =  'UPDATE ' . PREFIX . '_policies_kasko_persons AS a ' .
                    'JOIN ' . PREFIX . '_parameters_driver_ages AS b ON a.driver_ages_id = b.id SET ' .
                    'driver_ages_title = b.title ' .
                    'WHERE a.driver_ages_title = \'\'';
            $db->query($sql);
        }
    }

    function updateNextYearPayments($policies_id, $items) {
        global $db;
 
        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policies_kasko_item_years_payments ' .
                'WHERE policies_id = ' . intval($policies_id);
        $db->query($sql);

        if (is_array($items)) {
            foreach ($items as $row) {
                if (is_array($row['years'])) {
                    foreach ($row['years'] as $payment) {
                        $sql =  'INSERT INTO ' . PREFIX . '_policies_kasko_item_years_payments SET ' .
                                'policies_id = ' . intval($policies_id) . ', ' .
                                'items_id = ' . intval($row['id']) . ', ' .
                                'date = ' . $db->quote($payment['date']) . ', ' .
                                'rate_kasko = ' . $db->quote($payment['rate_kasko']) . ', ' .
                                'rate_agent = ' . $db->quote($payment['rate_agent']) . ', ' .
                                'item_price = ' . $db->quote($payment['car_price']) . ', ' .
                                'amount_kasko = ' . $db->quote($payment['amount_kasko']) . ', ' .
                                'amount_agent = ' . $db->quote($payment['amount_agent']) . ', ' .
                                'bank_commission_value = ' . $db->quote($payment['bank_commission_value']) . ', ' .
                                'agent_commission_value = ' . $db->quote($payment['agent_commission_value']) . ', ' .
                                'bank_discount_value = ' . $db->quote($payment['bank_discount_value']) . ', ' .
                                'products_id     = ' . $db->quote($payment['products_id']) . ', ' .
                                'products_title = ' . $db->quote($payment['products_title']) . ', ' .
                                'formula = ' . $db->quote($payment['formula']) . ', ' .
                                'f = ' . intval($payment['f']) . ', ' .
                                'commission_agent_amount = ' . $db->quote($payment['commission_agent_amount']) . ' ';
                        $db->query($sql);

                        if ($payment['amount_kasko'] >= 25000) {
                            $sql = 'UPDATE ' . PREFIX . '_clients AS a ' .
                                   'JOIN ' . PREFIX . '_policies AS b ON a.id = b.clients_id ' .
                                   'SET a.important_person = 1 ' .
                                   'WHERE b.id = ' . intval($policies_id);
                            $db->query($sql);
                        }
                    }
                }
            }
            $sql =  'UPDATE ' . PREFIX . '_policies_kasko_item_years_payments a ' .
                'JOIN ' . PREFIX . '_products b on b.id=a.products_id ' .
                ' SET products_title=b.title '.
                'WHERE a.policies_id = ' . intval($policies_id);
            $db->query($sql);
        }

    }

    function setCommissions($id) {
        global $db;

        //вычисление итоговых сумм комиссионного вознаграждения
        $sql =  'SELECT b.payment_brakedown_id, SUM(c.amount) as amount, ' .

                'SUM(' .
                ' round(c.amount_agent * c.commission_agency_percent / 100, 2) ' .//сумма комиссионного вознаграждения агенции за 1 ТС, считаем от страхового тарифа
                ') as commission_agency_amount, ' .//сумма комиссионного вознаграждения агенции за 1 ТС

                'SUM(  ' .
                '  round(c.amount_agent * c.commission_agent_percent / 100, 2) ' .//сумма комиссионного вознаграждения агенту за 1 ТС, считаем от страхового тарифа
                ' ) as commission_agent_amount, ' .//сумма комиссионного вознаграждения агенту за 1 ТС

                'SUM(  ' .
                '  round(c.amount_agent * c.commission_manager_percent / 100, 2) ' .
                ' ) as commission_manager_amount, ' . 
                'SUM(  ' .
                '  round(c.amount_agent * c.commission_seller_agents_percent / 100, 2) ' .
                ' ) as commission_seller_agents_amount, ' . 

                
                
                'SUM(  ' .
                '  round(c.amount_agent * c.director1_commission_percent / 100, 2) ' .//сумма комиссионного вознаграждения директору  за 1 ТС, считаем от страхового тарифа
                ' ) as commission_director1_amount, ' .//сумма комиссионного вознаграждения директору  за 1 ТС

                'SUM(' .
                '  round(c.amount_agent * c.director2_commission_percent / 100, 2) ' .//сумма комиссионного вознаграждения директору  за 1 ТС, считаем от страхового тарифа
                ' ) as commission_director2_amount ' .//сумма комиссионного вознаграждения директору  за 1 ТС

                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policies_kasko_items AS c ON a.id = c.policies_id ' .

                'WHERE a.id = ' . intval($id) . ' ' .
                'GROUP BY c.policies_id';
        $row =  $db->getRow($sql);
//_dump($sql);exit;
        $row['commission_agency_amount']                    = round($row['commission_agency_amount'], 2);
        $row['commission_agent_amount']                 = round($row['commission_agent_amount'], 2);
        $row['commission_financial_institution_amount'] = round($row['commission_financial_institution_amount'], 2);

        $row['commission_director1_amount']             = round($row['commission_director1_amount'], 2);
        $row['commission_director2_amount']             = round($row['commission_director2_amount'], 2);
        
        $row['commission_manager_amount']               = round($row['commission_manager_amount'], 2);
        $row['commission_seller_agents_amount']             = round($row['commission_seller_agents_amount'], 2);

        $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                'commission_agency_amount = ' . $db->quote($row['commission_agency_amount']) . ', ' .
                'commission_agency_percent = round(' . $db->quote($row['commission_agency_amount']) . ' / amount * 100, 2), ' .
                'commission_agent_amount = ' . $db->quote($row['commission_agent_amount']) . ', ' .
                'commission_agent_percent = round(' . $db->quote($row['commission_agent_amount']) . ' / amount * 100, 2), ' .

                'commission_director1_amount = ' . $db->quote($row['commission_director1_amount']) . ', ' .
                'commission_director1_percent = round(' . $db->quote($row['commission_director1_amount']) . ' / amount * 100, 2), ' .

                'commission_director2_amount = ' . $db->quote($row['commission_director2_amount']) . ', ' .
                'commission_director2_percent = round(' . $db->quote($row['commission_director2_amount']) . ' / amount * 100, 2), ' .

                'commission_manager_amount = ' . $db->quote($row['commission_manager_amount']) . ', ' .
                'commission_manager_percent = round(' . $db->quote($row['commission_manager_amount']) . ' / amount * 100, 2), ' .
                'commission_seller_agents_amount = ' . $db->quote($row['commission_seller_agents_amount']) . ', ' .
                'commission_seller_agents_percent = round(' . $db->quote($row['commission_seller_agents_amount']) . ' / amount * 100, 2), ' .


                'commission_financial_institution_amount = ' . $db->quote($row['commission_financial_institution_amount']) . ', ' .
                'commission_financial_institution_percent = round(' . $db->quote($row['commission_financial_institution_amount']) . ' / amount * 100, 2) ' .
                'WHERE id = ' . intval($id);
        $db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'commission_agent_amount = amount*' . doubleval($row['commission_agent_amount']) .'/'.doubleval($row['amount']) . ', ' .
                'commission_financial_institution_amount = amount*'. doubleval($row['commission_financial_institution_amount']) .'/'.doubleval($row['amount']) . ' ' .
                'WHERE policies_id = ' . intval($id).'  ';
        $db->query($sql);
        $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'commission_agency_amount = amount*' . doubleval($row['commission_agency_amount']).'/'.doubleval($row['amount']) . ' ' .
                'WHERE policies_id = ' . intval($id).'  ';
        $db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'commission_director1_amount = amount*' . doubleval($row['commission_director1_amount']).'/'.doubleval($row['amount']) . ' ' .
                'WHERE policies_id = ' . intval($id).'  AND next_year =0';
        $db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'commission_director2_amount = amount*' . doubleval($row['commission_director2_amount']).'/'.doubleval($row['amount']) . ' ' .
                'WHERE policies_id = ' . intval($id).'  AND next_year =0';
        $db->query($sql);

        
        $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'commission_seller_agents_amount = amount*' . doubleval($row['commission_seller_agents_amount']).'/'.doubleval($row['amount']) . ' ' .
                'WHERE policies_id = ' . intval($id).'  ';
        $db->query($sql);


        $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'commission_manager_amount = amount*' . doubleval($row['commission_manager_amount']).'/'.doubleval($row['amount']) . ' ' .
                'WHERE policies_id = ' . intval($id).'  ';
        $db->query($sql);
        

    }

    function getCode($data) {
        global $db;
        $result = '';
        if ($data['insurance_companies_id']==INSURANCE_COMPANIES_GENERALI) {
            $result = '701';
            return $result;
        }
        if ($data['options_test_drive'] || $data['options_race']) {
            $result = '203';
            return $result;
        }
        if (isset($data['items']) && is_array($data['items']) && sizeof($data['items'])>1) {
            $result = '207';
            return $result;
        }
        
        //экспресс продукты
        switch (intval($data['express_products_id'])) {
            case 110:
            case 192:
                return '208';
                break;
            case 599:
            case 684:
                return '220';
                break;  
            case PRODUCT_KASKO1:
                return '804';
                break;
            case PRODUCT_KASKO2:
                return '205';
                break;
            case PRODUCT_KASKO3:
                return '209';
                break;  
        }


        switch (intval($data['financial_institutions_id'])) {
            case 0://авторитейл, не банк
                $result = '208';
                break;
            case FINANCIAL_INSTITUTIONS_UKRAUTOLEASING:
                $result = '802';
                break;
            default://автобанк, кредитное авто
                $result = '202';
                break;
        }
        
        $item = $data['items'][0];
        if (intval($item['deductibles_id'])) {
            $sql =  'SELECT b.code AS products_code, b.title AS products_title ' .
                    'FROM ' . PREFIX . '_product_deductibles AS a ' .
                    'JOIN ' . PREFIX . '_products AS b ON a.products_id = b.id ' .
                    'WHERE a.id = ' . intval($item['deductibles_id']);
            $product = $db->getRow($sql);

        }
        elseif($item['id']>0)
        {
            $sql =  'SELECT b.code AS products_code, b.title AS products_title ' .
                    'FROM ' . PREFIX . '_policies_kasko_items AS a ' .
                    'JOIN ' . PREFIX . '_products AS b ON a.products_id = b.id ' .
                    'WHERE a.id = ' . intval($item['id']);
            $product = $db->getRow($sql);
        }

        if ($product)
            $result = $product['products_code'];


        return trim($result);
    }

    function setClient($data) {

        $values['agencies_id']                      = 1469;
        $values['agents_id']                        = ($data['agencies_id'] == 1469) ? $data['agents_id'] : 0;
        $values['person_types_id']                  = $data['insurer_person_types_id'];

        switch ($values['person_types_id']) {
            case '1'://физ. лицо
                $values['identification_code']      = $data['insurer_identification_code'];
                $values['dateofbirth']              = $data['insurer_dateofbirth_year'] . '-' . $data['insurer_dateofbirth_month'] . '-' . $data['insurer_dateofbirth_day'];
                $values['dateofbirthYear']          = $data['insurer_dateofbirth_year'];
                $values['dateofbirthMonth']         = $data['insurer_dateofbirth_month'];
                $values['dateofbirthDay']           = $data['insurer_dateofbirth_day'];
                $values['passport_series']          = $data['insurer_passport_series'];
                $values['passport_number']          = $data['insurer_passport_number'];
                $values['passport_place']           = $data['insurer_passport_place'];
                $values['passport_date']            = $data['insurer_passport_date_year'] . '-' . $data['insurer_passport_date_month'] . '-' . $data['insurer_passport_date_day'];
                $values['passport_date_year']       = $data['insurer_passport_date_year'];
                $values['passport_date_month']      = $data['insurer_passport_date_month'];
                $values['passport_date_day']        = $data['insurer_passport_date_day'];
                $values['driver_licence_series']    = $data['insurer_driver_licence_series'];
                $values['driver_licence_number']    = $data['insurer_driver_licence_number'];
                $values['driver_licence_date']      = $data['insurer_driver_licence_date_year'] . '-' . $data['insurer_driver_licence_date_month'] . '-' . $data['insurer_driver_licence_date_day'];
                $values['driver_licence_date_year'] = $data['insurer_driver_licence_date_year'];
                $values['driver_licence_date_month']= $data['insurer_driver_licence_date_month'];
                $values['driver_licence_date_day']  = $data['insurer_driver_licence_date_day'];
                break;
            case '2'://юр. лицо
                $values['company']                  = $data['insurer_company'];
                $values['identification_code']      = $data['insurer_edrpou'];
                $values['position']                 = $data['insurer_position'];
                $values['ground']                   = $data['insurer_ground'];
                break;
        }

        $values['lastname']                         = $data['insurer_lastname'];
        $values['firstname']                        = $data['insurer_firstname'];
        $values['patronymicname']                   = $data['insurer_patronymicname'];
        $values['mobile_phone']                     = $data['insurer_phone'];
        $values['email']                            = $data['insurer_email'];

        $values['registration_regions_id']          = $data['insurer_regions_id'];
        $values['registration_area']                = $data['insurer_area'];
        $values['registration_city']                = $data['insurer_city'];
        $values['registration_street_types_id']     = $data['insurer_street_types_id'];
        $values['registration_street']              = $data['insurer_street'];
        $values['registration_house']               = $data['insurer_house'];
        $values['registration_flat']                = $data['insurer_flat'];
        $values['registration_phone']               = $data['insurer_phone'];

        $values['habitation_regions_id']            = $data['insurer_regions_id'];
        $values['habitation_area']                  = $data['insurer_area'];
        $values['habitation_city']                  = $data['insurer_city'];
        $values['habitation_street_types_id']       = $data['insurer_street_types_id'];
        $values['habitation_street']                = $data['insurer_street'];
        $values['habitation_house']                 = $data['insurer_house'];
        $values['habitation_flat']                  = $data['insurer_flat'];
        $values['habitation_phone']                 = $data['insurer_phone'];

        $values['bank']                             = $data['insurer_bank'];
        $values['bank_mfo']                         = $data['insurer_bank_mfo'];
        $values['bank_account']                     = $data['insurer_bank_account'];

        $values['card_car_man_woman']               = $data['card_car_man_woman'];
        $values['card_assistance']                  = $data['card_assistance'];

        $Clients = new Clients($values);
        $Clients->permissions['insert'] = true;
        $Clients->permissions['update'] = true;
        return $Clients->fill($values);
    }

    function setCars($data) {
        if (is_array($data['items'])) {
            foreach ($data['items'] as $row) {

                $values = array();

                $values['clients_id']               = $data['clients_id'];
                $values['brands_id']                    = $row['brands_id'];
                $values['models_id']                    = $row['models_id'];
                $values['price']                    = $row['car_price'];
                $values['engine_size']              = $row['engine_size'];
                //$values['transmissions_id']           = $row['transmissions_id'];
                $values['year']                     = $row['year'];
                $values['race']                     = $row['race'];
                $values['colors_id']                    = $row['colors_id'];
                $values['passengers']               = $row['number_places'];
//              $values['car_weight']               = $row['car_weight'];
                $values['shassi']                   = $row['shassi'];
                $values['sign']                     = $row['sign'];
                $values['other_policies']           = $row['other_policies'];
                $values['order_basis_car_id']           = $row['order_basis_car_id'];
                $values['use_as_car']           = $row['use_as_car'];
                $values['protection_multlock']      = $row['protection_multlock'];
                $values['no_immobiliser']           = $row['no_immobiliser'];
                $values['protection_immobilaser']   = $row['protection_immobilaser'];
                $values['protection_manual']            = $row['protection_manual'];
                $values['protection_signalling']        = $row['protection_signalling'];
//              $values['registration_number']      = $row['registration_number'];
//              $values['registration_place']       = $row['registration_place'];
//              $values['registration_date']            = $row['registration_date'];
//              $values['registration_date_year']       = $row['registration_date_year'];
//              $values['registration_date_month']  = $row['registration_date_month'];
//              $values['registration_date_day']        = $row['registration_date_day'];
                $values['registration_cities_id']       = $data['registration_cities_id'];
                $values['registration_cities_title']    = $data['registration_cities_title'];
//              $values['regions_id']               = $row['regions_id'];

                $ClientCars = new ClientCars($values);
                $ClientCars->permissions['insert'] = true;
                $ClientCars->permissions['update'] = true;
                $ClientCars->fill($values);
            }
        }
    }

    function getNumber($data) {
        global $db;

        $result = $data['number'];

        if (!$result) {
            $sql =  'SELECT CONCAT(' . $db->quote($this->getCode($data)) . ', \'.\', date_format(created, \'%y\'), \'.2\', ' . $db->quote(sprintf('%06d', intval($data['id']))) . ') ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id = ' . intval($data['id']);
            $result = $db->getOne($sql);
        }

        return $result;
    }

    function setAdditionalFields($id, $data) {
        global $db, $Log, $REGIONS, $UNDERWRITING_POLICY_STATUSES, $CLIENT_FILL_POLICY_STATUSES,$Authorization;

        if(intval($data['policy_statuses_id']) == 10 && intval($data['agreement_types_id']) == 3){
            $AccidentMessages = new AccidentMessages($data);
            $AccidentMessages->isTaskExist($data['parent_id']);
        }

        $data['clients_id'] = 0;
        if (in_array($data['policy_statuses_id'], $CLIENT_FILL_POLICY_STATUSES) && !$data['skipClients']) {//фиксируем данные по клиенту только, если договор закрывается для редактирования, мусора меньше будет
            $data['clients_id'] = $this->setClient($data);
            $this->setCars($data);
            $Log->clear();
        }

        $data['number'] = $this->getNumber($data);

        if (!intval($data['financial_institutions_id'])  && !$data['assured_title'] && !$data['assured_identification_code'] && !$data['assured_address'] && !$data['assured_phone']) {

            switch ($data['owner_person_types_id']) {
                case '1'://физ. лицо
                    $data['assured_title'] = $data['owner_lastname'] . ' ' . $data['owner_firstname'] . ' ' . $data['owner_patronymicname'];
                    $data['assured_identification_code'] = $data['owner_identification_code'];
                    break;
                case '2'://юр. лицо
                    $data['assured_title'] = $data['owner_company'];
                    $data['assured_identification_code'] = $data['owner_edrpou'];
                    break;
            }

            $data['assured_address'] = Regions::getTitle($data['owner_regions_id']);

            if ($data['owner_area']) {
                $data['assured_address'] .= ', ' . $data['owner_area'] . ' р-н';
            }

            if (!in_array($data['owner_regions_id'], $REGIONS)) {
                $data['assured_address'] .= ', ' . $data['owner_city'];
            }

            $data['assured_address'] .=  ', ' . StreetTypes::getTitle($data['owner_street_types_id']) . ' ' . $data['owner_street'] . ', ' . $data['owner_house'];

            if ($data['owner_flat']) {
                $data['assured_address'] .= ', кв. ' . $data['owner_flat'];
            }

            $data['assured_phone'] = $data['owner_phone'];
        }

            //устанавливаем top для нового, и child_id and interrupt_datetime для старого
            $sql =  'UPDATE ' . PREFIX . '_policies AS a, ' . PREFIX . '_policies AS b SET ' .
                    'a.top = IF(b.top > 0, b.top, ' . intval($data['parent_id']) . '), ' .
                    ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW && $data['policy_statuses_id']==10 ? 'b.interrupt_datetime = DATE_ADD(a.begin_datetime, INTERVAL -1 DAY) ,':' ') . //доп угода
                    'b.child_id = ' . intval($id) . ' ' .
                    'WHERE a.id = ' . intval($id) . ' AND b.id = ' . intval($data['parent_id']);
            $db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS c ON a.agencies_id = c.id ' .
                'LEFT JOIN ' . PREFIX . '_financial_institutions AS d ON b.financial_institutions_id = d.id ' .
                'JOIN ' . PREFIX . '_cities AS e ON b.registration_cities_id = e.id ' .
                'JOIN ' . PREFIX . '_product_types AS f ON a.product_types_id = f.id ' .
                'LEFT JOIN ' . PREFIX . '_policies AS h ON h.id = ' . intval($data['parent_id']) . ' SET ' .
                'a.parent_id = ' . intval($data['parent_id']) . ', ' .
                'a.top = IF(h.top > 0, h.top, ' . intval($id) . '), ' .
                'a.clients_id = ' . intval($data['clients_id']) . ', ' .
                'a.product_types_expense_percent = f.expense_percent, ' .
                'a.number = IF(a.number, a.number, ' . $db->quote($data['number']) . '), ' .
                'a.date = IF(TO_DAYS(a.date) > 0, a.date, ' . $db->quote($data['date_year'] . $data['date_month'] . $data['date_day']) . '), ' .
                'a.insurer = IF(b.insurer_person_types_id = 2, b.insurer_company, CONCAT(b.insurer_lastname, \' \', b.insurer_firstname)), ' .
                'a.interrupt_datetime = a.end_datetime, ' .
                'b.registration_cities_title = IF(b.registration_cities_id <> ' . CITIES_OTHER . ', e.title, b.registration_cities_title), ' .
                'b.assured_title = IF(b.financial_institutions_id , d.title, IF(b.assured_title, b.assured_title, ' . $db->quote($data['assured_title']) . ')), ' .
                'b.assured_identification_code = IF(b.financial_institutions_id , d.edrpou, IF(b.assured_identification_code, b.assured_identification_code, ' . $db->quote($data['assured_identification_code']) . ')), ' .
                'b.assured_address = IF(b.financial_institutions_id, d.address, IF(b.assured_address, b.assured_address, ' . $db->quote($data['assured_address']) . ')), ' .
                'b.assured_phone = IF(b.financial_institutions_id , d.phone, IF(b.assured_phone, b.assured_phone, ' . $db->quote($data['assured_phone']) . ')), ' .
                'b.bank_account_title = IF(b.financial_institutions_id, d.title, \'\'), ' .
                'b.bank_account_mfo = IF(b.financial_institutions_id, d.mfo, \'\'), ' .
                'b.bank_account_edrpou = IF(b.financial_institutions_id, d.edrpou, \'\'), ' .
                ($data['policy_statuses_id']==10 ? 'h.interrupt_datetime = IF(h.interrupt_datetime >= a.begin_datetime, SUBDATE(a.begin_datetime, INTERVAL 1 DAY), h.interrupt_datetime), ' : '') .             
                'h.child_id = ' . intval($id) . ' ' .
                
                'WHERE a.id = ' . intval($id);
        $db->query($sql);
        if ($data['seller_agents_id']>0) { //меняем для заявы подписанта при перебросе в другую точку
                $sql =  'SELECT * ' .
                        'FROM ' . PREFIX . '_accounts ' .
                        'WHERE id = ' . intval($data['seller_agents_id']);
                $row = $db->getRow($sql);

                $sql =  'UPDATE ' . PREFIX . '_policies_kasko SET ' .
                        'agent_lastname = ' . $db->quote($row['lastname']) .  ', ' .
                        'agent_firstname =  ' . $db->quote($row['firstname']) . ', ' .
                        'agent_patronymicname = ' . $db->quote($row['patronymicname']) . ' ' .
                        'WHERE policies_id=' . intval($id);
                $db->query($sql);
        }   
        else {
            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_accounts ' .
                    'WHERE id = (SELECT agents_id FROM ' . PREFIX . '_policies WHERE id= ' . intval($data['id']).')';
            $row = $db->getRow($sql);

            $sql =  'UPDATE ' . PREFIX . '_policies_kasko SET ' .
                    'agent_lastname = ' . $db->quote($row['lastname']) .  ', ' .
                    'agent_firstname =  ' . $db->quote($row['firstname']) . ', ' .
                    'agent_patronymicname = ' . $db->quote($row['patronymicname']) . ' ' .
                    'WHERE policies_id=' . intval($data['id']);
            $db->query($sql);


        }
                    

        if ($data['financial_institutions_id']==33 ) //astra
        {
            $sql = 'UPDATE ' . PREFIX . '_policies_kasko a '.
                    ' JOIN  insurance_financial_institutions b on b.id=59 '.
                    ' SET a.assured_title=b.title,a.assured_address=b.address,a.assured_identification_code=b.edrpou,a.assured_phone=b.phone,a.bank_account_title=b.title,a.bank_account_mfo=b.mfo,a.bank_account_edrpou=b.edrpou WHERE a.policies_id=' . intval($id);
            $db->query($sql);   
        }
        if ($data['agreement_types_id'] >0) { //sub_number для доп угоды
            $sub_number = intval($db->getOne('SELECT max(sub_number)+1 FROM '.PREFIX.'_policies WHERE number='.$db->quote($data['number'])));
            $db->query('UPDATE '.PREFIX.'_policies SET sub_number=IF(sub_number>0,sub_number,'.$sub_number.') WHERE id = ' . intval($id));
        }

        /*if ($data['policy_statuses_id'] == POLICY_STATUSES_RENEW) {//переукладення, удаляем все неоплаченые ожидаемые платежи с календаря дочернего полиса
            $sql = 'DELETE FROM ' . PREFIX . '_policy_payments_calendar WHERE policies_id=' . intval($data['parent_id']) . ' AND statuses_id = ' . PAYMENT_STATUSES_NOT;
            $db->query($sql);
        }*/

        if (intval($data['parent_id'])) {
            $sql = 'UPDATE  ' . PREFIX . '_policies SET child_id = ' . intval($id) . ' WHERE id = ' . intval($data['parent_id']);
            $db->query($sql);
        }
        
        $this->updateRisks($id, PRODUCT_TYPES_KASKO, $data['risks']);

        $this->updateItems($id, $data['items'],$data['dontRecalcRate'],$data);
        $this->updatePersons($id, $data['persons']);


        if (!$data['skipCalendar'] && !$data['dontRecalcRate']) {
            $this->updateNextYearPayments($id, $data['items']);
            $PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
            $PolicyPaymentsCalendar->updateCalendar($id,true);
            $this->setPaymentStatus($id);
        }
        if (!$data['dontRecalcRate'])
            $this->setCommissions($id);

        if (!$data['dontRecalcRate']) {
            if ($data['policy_statuses_id_old'] != $data['policy_statuses_id'] && in_array($data['policy_statuses_id'], $UNDERWRITING_POLICY_STATUSES)) {
                if (!$data['skipQuotes']) {
                    $PolicyQuotes = new PolicyQuotes($data);
                    $PolicyQuotes->permissions['insert'] = true;
                    $PolicyQuotes->insert($this->get($id));
                }
            }
        }
        

        if($data['do'] == 'Policies|insert' && $data['agreement_types_id'] == 3){
            AccidentMessages::addPoliciesId($id);
        }

        if(intval($data['policy_statuses_id']) == 10 && intval($data['agreement_types_id']) == 3){
            $AccidentMessages = new AccidentMessages($data);
            $AccidentMessages->isTaskExist($data['id']);
        }

        if ($data['certificate']) {
            /*$sql =  'UPDATE ' . PREFIX . '_policy_blanks SET ' .
                    'blank_statuses_id = IF(blank_statuses_id = 2, 3, blank_statuses_id) ' .
                    'WHERE product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND number = ' . $db->quote($data['certificate']);
            $db->query($sql);*/
        }
    }

    function synhronize(&$data) {
        global $db, $Log;

        if (E_IX_SYNHRONIZATION!=1) return;

        $Client = new SoapClient(E_IX_URL . 'synchronization/express/index.php?wsdl');
        $type='Policies_KASKO';

        $result = $Client->synhronize(
                    array(
                        'type'  => $type,
                        'data'      => serialize($data)));
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;

        if (intval($data['changeMode'])) {
            $this->showForm($data, $GLOBALS['method'], 'insert');
            return;
        }
        $p = null;
        if ($data['product_types_id'] != PRODUCT_TYPES_DRIVE_CERTIFICATE /*&& $data['next_policy_statuses_id']!=POLICY_STATUSES_RENEW*/) {
            $data['agencies_id']    = $Authorization->data['agencies_id'];
            $data['agents_id']  = $Authorization->data['id'];
            if ($data['parent_id'] && sizeof($data['items'])==1 && doubleval($data['items'][0]['market_price'])==0) //переносим рыночную стоимость эксперта с предыдущего договора
            {
                    $p = $this->getMarketPrice($data['parent_id']);
                    if ($p['market_price_expert']>0 && $p['expert_id']>0) {
                        $data['items'][0]['market_price'] = $p['market_price_expert'];
                    }
            }

                    
        }
        
        if (!$Authorization->data['ankets'] && $Authorization->data['roles_id']==ROLES_AGENT && $data['policy_statuses_id']==POLICY_STATUSES_CONSULTATION)
            $data['cons_agents_id'] = $Authorization->data['id'];
    
        if ($data['next_policy_statuses_id']==POLICY_STATUSES_RENEW)
        {
           $this->permissions['insert']= true;
        }

        $data['id'] = $data['policies_id'] = parent::insert(&$data, false, $showForm);

        if (intval($data['messages_id']) > 0) {
            $AccidentMessages = new AccidentMessages($data);
            $AccidentMessages->changeParentId(intval($data['id']), intval($data['parent_id']));
        }

        if (intval($data['id'])) {

            $this->setAdditionalFields($data['id'], $data);

            $this->generateDocuments($data['id']);
            if ($data['parent_id'] && sizeof($data['items'])==1 && $p['market_price_expert']>0 && $p['expert_id']>0) //переносим рыночную стоимость эксперта с предыдущего договора
            {
                $sql = 'UPDATE insurance_policies_kasko_items SET market_price_expert='.$p['market_price_expert'].',expert_id='. $p['expert_id'].',expert_date='.$db->quote($p['expert_date']).' WHERE policies_id='.intval($data['id']);
                $db->query($sql);
            }

            if ($data['types_id'] == POLICY_TYPES_QUOTE) {
                $data['text'] = $data['comment'];

                $PolicyMessages = new PolicyMessages($data);
                $PolicyMessages->insert($data, false);
            }

            if(intval($data['axapta_id']) > 0){
                $Axapta = new Axapta($data);
                $Axapta->insertAxaptaPolicies($data['id'], $data['axapta_id']);
            }

            

            if ($redirect) {

                $params['title']    = $this->messages['single'];
                $params['id']       = $data['id'];
                $params['storage']  = $this->tables[0];

                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                $this->addSpecialMessage($data);
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

        $conditions[] = 'policies_id = ' . intval($data['id']);

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies_kasko_items  ' .
                'WHERE ' . implode(' AND ', $conditions);
        $data['items'] = $db->getAll($sql);
        $data['risks'] = $db->getCol('SELECT risks_id FROM insurance_policy_risks WHERE policies_id='.intval($data['id']));

        if (is_array($data['items'])) {
            foreach ($data['items'] as $i => $row) {

                if ($_REQUEST['do'] == 'Policies|continuePolicy') {

                    $sql =  'SELECT related_products_id ' .
                            'FROM ' . PREFIX . '_products_related ' .
                            'WHERE products_id = ' . intval($data['items'][ $i ]['products_id']);
                    $data['items'][ $i ]['related_products_id'] = implode(', ', $db->getCol($sql));
                }

                $sql =  'SELECT * ' .
                        'FROM ' . PREFIX . '_policies_kasko_item_equipment ' .
                        'WHERE items_id = ' . intval($row['id']);
                $data['items'][ $i ]['equipment'] = $db->getAll($sql);
                $use_as_car = intval($row['use_as_car']);
                if($use_as_car&1) $data['items'][ $i ]['use_as_car_private'] = 1;
                if($use_as_car&2) $data['items'][ $i ]['use_as_car_work'] = 1;
                if($use_as_car&4) $data['items'][ $i ]['use_as_car_leasing'] = 1;
            }
        }

        $data['cars_count'] = sizeOf($data['items']);

        if ($data['drivers_id'] == 7) { //любой водитель на законных основаниях
            $data['number_drivers'] = 0;
        } else {
            $sql =  'SELECT *, date_format(driver_licence_date, \'' . DATE_FORMAT . '\') AS driver_licence_date, date_format(driver_licence_date, \'%Y\') AS driver_licence_date_year, date_format(driver_licence_date, \'%m\') AS driver_licence_date_month, date_format(driver_licence_date, \'%d\') AS driver_licence_date_day ' .
                    'FROM ' . PREFIX . '_policies_kasko_persons ' .
                    'WHERE ' . implode(' AND ', $conditions);
            $data['persons'] = $db->getAll($sql);

            $data['number_drivers'] = sizeOf($data['persons']) + 1;
        }

        return $data;
    }


    function addSpecialMessage(&$data)
    {
        global $Log,$Authorization;
        if (intval($data['express_products_id'])>0)
        {
            switch ($data['express_products_id']) {
                case PRODUCT_KASKO1:
                    $Log->add('confirm','Обов’язковими додатками до договору страхування є копії паспорту страхувальника, техпаспорту та посвідчення водія');
                    break;
                case PRODUCT_KASKO2:
                    $Log->add('confirm','Обов’язковими додатками до договору страхування є копії паспорту страхувальника, техпаспорту та посвідчення водіїв, допущених до керування ТЗ');
                    break;
                case PRODUCT_KASKO3:
                    $Log->add('confirm','Обов’язковими додатками до договору страхування є копії паспорту страхувальника та техпаспорту');
                    break;
            }

        }
        if ($data['is_old_market_price'] && $data['dontRecalcRate']==0) {
                $Log->add('confirm','Ринкова вартiсть застарiла, необхiдно провести повторну оцiнку, полiс може бути збережено тiльки в статусi Створено');
        }

        if (is_array($data['items'])) {
            foreach($data['items'] as $i=>$item) {
                if (doubleval($item['market_price'])==0 && $data['dontRecalcRate']==0) {
                    $Log->add('confirm','Не знайдено ринкову вартiсть ТЗ полiс може бути збережено тiльки в статусi Створено');
                } 
                if (doubleval($item['car_price'])>=3000000 && $Authorization->data['roles_id']==ROLES_AGENT) {
                    $Log->add('confirm','Потребує окремого узгодження з головним офісом СК. Полiс може бути збережено тiльки в статусi Створено');
                }                   
                if ($data['express_products_id']==673) {
                    if (doubleval($item['market_price'])>0 && $data['product_types_id'] == PRODUCT_TYPES_KASKO 
                        && (1*doubleval($item['market_price']))>doubleval($item['car_price']) ) {
                            $Log->add('confirm','Страхова сума має бути не менше  від Ринкової вартості. Полiс може бути збережено тiльки в статусi Створено');             
                    }
                }
                else if ($data['dontRecalcRate']==0 && doubleval($item['market_price'])>0 && $data['product_types_id'] == PRODUCT_TYPES_KASKO 
                        && (0.5*doubleval($item['market_price']))>doubleval($item['car_price']) && !$Authorization->data['permissions']['Policies_KASKO']['superupdate']) {
                    $Log->add('confirm','Страхова сума має бути не менше 50 відсотків від Ринкової вартості. Полiс може бути збережено тiльки в статусi Створено');
                    //exit;
                }
                
                if ($item['amount_kasko']>=150000) {
                    $Log->add('confirm','
                        Клієнт підлягає обов’язковій ідентифікації та  верифікації.<br>
                        1). Заповніть анкету (фіз./юр).<br>
                        2). Візьміть пакет необхідних документів (фіз./юр) (перелік документів прописаний в анкеті). <br>
                        3). Надішліть сканкопії на e:mail куратору дилерської мережі. <br>
                        4). Оригінали передайте разом з договором у Головний офіс СК<br>

                    ');
                }
                
            }
        }


    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization,$db;

        $policy_statuses_id = $db->getOne('SELECT policy_statuses_id FROM insurance_policies WHERE id='.intval($data['id']));
        if ($policy_statuses_id == POLICY_STATUSES_CONSULTATION && $data['policy_statuses_id']!=POLICY_STATUSES_CONSULTATION) {
            //переход с конусльтации в другой статус поменять человека кто создал
            $this->formDescription['fields'][ $this->getFieldPositionByName('agents_id') ]['display']['update'] = true;
            $data['agents_id']  = $Authorization->data['id'];
        }
        if (intval($data['changeMode']) && $data['types_id']==2) {

            
            $this->showForm($data, $GLOBALS['method'], 'update');
            return;
        }
        if ($Authorization->data['permissions']['Policies_KASKO']['superupdate'])
        {//прочитать старый тариф для лога сообщений
            $oldrate = $db->getRow('SELECT rate,amount FROM '.PREFIX.'_policies WHERE id='.intval($data['id']));
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
            
            if ($Authorization->data['permissions']['Policies_KASKO']['superupdate'])
            {//прочитать новый тариф для лога сообщений и создать сообщения
                $newrate = $db->getRow('SELECT rate,amount FROM '.PREFIX.'_policies WHERE id='.intval($data['id']));
                $data['policies_id'] = $data['id'];
                if ($data['dontRecalcRate'])
                    $data['subject'] = 'Полiс був модифiкований без перерахунку тарифу';
                else
                    $data['subject'] = 'Полiс був модифiкований Старий тариф: ' . $oldrate['rate'].'%/'.$oldrate['amount'].' грн. новий: ' . $newrate['rate'].'%/'.$newrate['amount'].' грн.';

                $PolicyMessages = new PolicyMessages($data);
                $PolicyMessages->insert($data, false);
            }

            $data['number'] = $db->getOne('SELECT number FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['id']));

            if (ereg('\.3[0-9]{6}$',$data['number'])) {
                $this->synhronize($data);
            }

            if ($redirect) {

                $params['title']    = $this->messages['single'];
                $params['id']       = $data['id'];
                $params['storage']  = $this->tables[0];

                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                $this->addSpecialMessage($data);
                
                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
        }
        
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log, $Authorization;

        $PolicyPayments = new PolicyPayments($data);

        $sql =  'SELECT id ' .
                'FROM ' . $PolicyPayments->tables[0] . ' ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $PolicyPayments->messages['plural'] . '</b>.');
            return false;
        }
        
        $sql = 'SELECT child_id ' .
               'FROM ' . PREFIX . '_policies ' .
               'WHERE child_id > 0 AND id IN(' . implode(', ', $data['id']) . ')';
        $child_idx = $db->getCol($sql);
        
        if (sizeOf($child_idx)) {
            $Log->add('error', 'Не можна вилучити, так як є наступні договори / додаткові угоди.');
            return false;
        }
        
        $count_policies_to_delete = 0;
        foreach($data['id'] as $id){
           $is_exist = $db->getRow('SELECT id, agreement_types_id FROM ' . PREFIX . '_policies WHERE DATEDIFF(NOW(), begin_datetime) > 15 and id = ' . intval($id));
            if(!empty($is_exist) || !intval($is_exist['agreement_types_id'])) {
                $count_policies_to_delete += 1;
            }
        }
        if($count_policies_to_delete!= sizeof($data['id']) && ($Authorization->data['permissions']['Policies_KASKO']['deleteAdditionalPolicies'] || $Authorization->data['permissions']['Policies_KASKO']['delete'])){
                $Log->add('error', 'Виберіть лише додаткові угоди, які почали свою дію більше як 15 календарних днів тому.');
                return false;
        }

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policies_kasko_items  ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policies_kasko_item_equipment ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policies_kasko_persons ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

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

                    if ($values['insurer_regions_id']==27 && mb_eregi('евастополь', $values['insurer_city']))
                        $values[ $field ] = $values['insurer_city'];

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
                case 'ownerTitle':
                    switch ($values['owner_person_types_id']) {
                        case 1:
                            $values[ $field ] = $values['owner_lastname'] . ' ' . $values['owner_firstname'] . ' ' . $values['owner_patronymicname'];
                            break;
                        case 2:
                            $values[ $field ] = $values['owner_company'];
                            break;
                    }
                    break;
                case 'ownerAddress':
                    $values[ $field ] = Regions::getTitle($values['owner_regions_id']);

                    if ($values['owner_area']) {
                        $values[ $field ] .= ', ' .$values['owner_area'].' р-н';
                    }
                    
                    if (!in_array($values['owner_regions_id'], $REGIONS)) {
                        $values[ $field ] .= ', ' .$values['owner_city'];
                    }

                    if ($values['owner_regions_id']==27 && mb_eregi('евастополь', $values['owner_city']))
                        $values[ $field ] = $values['owner_city'];
                        
                    $values[ $field ] .=  ', ' . StreetTypes::getTitle($values['owner_street_types_id']) . ' ' . $values['owner_street'] . ', буд. ' . $values['owner_house'];

                    if ($values['owner_flat']) {
                        switch ($values['owner_person_types_id']) {
                            case 1:
                                $values[ $field ] .= ', кв. ' . $values['owner_flat'];
                                break;
                            case 2:
                                $values[ $field ] .= ', оф. ' . $values['owner_flat'];
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

    //письмо для столичного атвошоу
    function fillAutoshowLetter($row)
    {
        global $db;
            $row['original'] = $db->getRow('SELECT * FROM  insurance_policies WHERE id='.intval($row['policies_id']));
         
            $row['original']['second_year'] = $db->getRow('SELECT a.*,DATE_SUB(a.date, INTERVAL 1 DAY) AS lastdate FROM insurance_policies_kasko_item_years_payments a WHERE policies_id='.intval($row['policies_id']).' AND year(date)=2013 ORDER BY date LIMIT 1');
            if (!$row['original']['second_year'])
                $row['original']['second_year'] =$db->getRow('SELECT  a.end_datetime AS lastdate FROM insurance_policies a WHERE id='.intval($row['policies_id']));
            $row['original']['terms_years_id'] = $db->getOne('SELECT terms_years_id FROM insurance_policies_kasko WHERE policies_id='.intval($row['policies_id']));
            $sql = 'SELECT SUM(a.amount) as payedAmount,max(a.date) as payeddate FROM insurance_accident_payments a JOIN insurance_accidents b on b.id=a.accidents_id JOIN insurance_accident_payments_calendar c ON a.payments_calendar_id = c.id WHERE b.policies_id = ' . intval($row['policies_id']).'  AND c.payment_types_id IN (5,6) AND a.is_return=0';
            $p = $db->getRow($sql);
            $row['original']['payed_amount'] =doubleval($p['payedAmount']);
            $row['original']['payed_date'] =$p['payeddate'];
            if ($row['original']['payed_amount']>0) //были выплаты на улегулирование
            {
                $row['original']['second_year']['discount'] = 15;
            }
            else $row['original']['second_year']['discount'] = 20;
            if (isset($row['original']['second_year']['rate_kasko']) && isset($row['original']['second_year']['item_price']))
            {//многолетний договор просто делаем скидку от того что есть
                $row['original']['second_year']['rate_kasko'] = round($row['original']['second_year']['rate_kasko']*(100-$row['original']['second_year']['discount'])/100,3);
                $row['original']['second_year']['amount_kasko'] = round($row['original']['second_year']['rate_kasko']*$row['original']['second_year']['item_price']/100,2);
            }
            else
            {//перевычисляем 
                $products_id = $db->getOne('SELECT products_id FROM insurance_policies_kasko_items WHERE policies_id='.intval($row['policies_id']));
                if (!$products_id) exit;
                $related = $db->getCol('SELECT a.related_products_id FROM insurance_products_related a  JOIN  insurance_products b on b.id=a.related_products_id WHERE b.publish=1 AND a.products_id ='.intval($products_id));
                $calc_product = $products_id;
                if (is_array($related) && sizeof($related))
                {
                    if (!in_array($calc_product,$related)) //тот что сейчас есть не в массиве тех что на второй год, значит берем первый что туда попал
                        $calc_product=$related[0];
                }
                $product = $db->getRow('SELECT * FROM  insurance_products WHERE publish=1 AND id='.intval($calc_product));
                if (!$product) exit;
//              _dump($product);exit;
                //ищем франшизу
                $conditions1[]='value0='.doubleval($row['deductibles_value0']);
                $conditions1[]='value1='.doubleval($row['deductibles_value1']);
                $sql =  'SELECT a.id as deductibles_id ' .
                    'FROM ' . PREFIX . '_product_deductibles AS a ' .
                    'WHERE a.products_id='.$product['id'].' AND a.car_types_id='.intval($row['car_types_id']).' AND ' . implode(' AND ', $conditions1) . ' LIMIT 1';
                $deductibles_id = $db->getOne($sql);
//_dump($deductibles_id);exit;
                $Products = Products::factory($data, 'KASKO');
                $data = $row;
                $row['payment_breakdown_id']=1;
                //$data['items'][]=$row;
                $data['agencies_id'] = 1;
                $data['agreement_types_id'] = 0;
                $data['terms_years_id'] = 1;
                $data['risks'] = $db->getCol('SELECT risks_id FROM insurance_policy_risks WHERE policies_id='.intval($row['policies_id']));
                $data['payment_brakedown_id']=1;
//_dump($data['risks']);exit;
                $Products->calculate($row['engine_size'], $row['car_types_id'], $row['person_types_id'], $row['driver_standings_id'], $row['drivers_id'], round($row['car_price']*0.9, 2), $row['driver_ages_id'], $row['registration_cities_id'], $row['terms_id'], $deductibles_id, $data, $data['items'][0]);
//_dump($data['items'][0]['rate_kasko']);exit;
                $row['original']['second_year']['item_price'] = round($row['car_price']*0.9,2);
                $rate_kasko = $data['items'][0]['rate_kasko'];
                $row['original']['second_year']['rate_kasko'] = round($rate_kasko*(100-$row['original']['second_year']['discount'])/100,3);
                $row['original']['second_year']['amount_kasko'] = round($row['original']['second_year']['rate_kasko']*$row['original']['second_year']['item_price']/100,2);

            }
            
            
            
    }
    
    //загрузка для допов рекурсивно платежей многолетних договоров
    function loadYearPaymentsRecursive($policies_id,$yearsPayments) {
        global $db;
        $r = $db->getRow('SELECT * FROM insurance_policies WHERE id='.intval($policies_id));
        if (!$r || $r['agreement_types_id']==0) return;
        if ($r['parent_id']>0) {
            $sql =  'SELECT  
                    a.id,a.policies_id,a.items_id,IF(b.id>0,b.date,a.date) as date,
                    IF(DATEDIFF('.$db->quote($r['begin_datetime']).',IF(b.id>0,b.date,a.date))<0,'.$r['price'].',a.item_price) as item_price,
                    IF(DATEDIFF('.$db->quote($r['begin_datetime']).',IF(b.id>0,b.date,a.date))<0,1,0) as doplata2,
                    a.rate_kasko,IF(b.id>0,b.amount,a.amount_kasko) as  amount_kasko,a.products_id, a.products_title,
                    DATE_SUB(IF(b.id>0,b.date,a.date), INTERVAL 1 DAY) AS lastdate,UNIX_TIMESTAMP(IF(b.id>0,b.date,a.date)) as orderpos,1 as old_agr  ' .
                'FROM ' . PREFIX . '_policies_kasko_item_years_payments a '.
                'LEFT JOIN insurance_policy_payments_calendar b on b.item_years_payments_id=a.id '.
                'WHERE a.policies_id=' . intval($r['parent_id']).' AND a.date<'.$db->quote($r['begin_datetime']).' ORDER BY IF(b.id>0,b.date,a.date)';
            $p = $db->getAll($sql);
            if ($p && is_array($p) && sizeof($p)>0) {
                $yearsPayments = array_merge ($p,$yearsPayments);
            }
            $this->loadYearPaymentsRecursive($r['parent_id'],&$yearsPayments);
        }
        
    }
    
    //загрузка для допов рекурсивно календаря платежей 
    function loadPaymentsRecursive($policies_id,$payments) {
        global $db;
        $r = $db->getRow('SELECT a.*,b.financial_institutions_id FROM insurance_policies a JOIN insurance_policies_kasko b on b.policies_id=a.id WHERE id='.intval($policies_id));
        if (!$r || $r['agreement_types_id']==0) return;
        if ($r['parent_id']>0) {
            $sql =  'SELECT a.date, a.amount, DATE_SUB(a.date, INTERVAL 1 DAY) AS lastdate,UNIX_TIMESTAMP(a.date) as orderpos ' .
                'FROM ' . PREFIX . '_policy_payments_calendar as a ' .
                'JOIN ' . PREFIX . '_policies as b ON a.policies_id = b.id ' .
                'WHERE a.second_fifty_fifty = 0  '.($r['agreement_types_id'] == 3 && $r['financial_institutions_id']==0 ? '' : ' AND a.date<'.$db->quote($r['begin_datetime']) ).' AND a.policies_id = ' . intval($r['parent_id']);
            $p = $db->getAll($sql);
            if ($p && is_array($p) && sizeof($p)>0) {
                $payments = array_merge ($p,$payments);
            }
            $this->loadPaymentsRecursive($r['parent_id'],&$payments);
        }
        
    }
    
 
    //загрузка для допов рекурсивно даты начала действия
    function loadBeginDateTimeRecursive($policies_id,$begin_date_time) {
        global $db;
        $r = $db->getRow('SELECT * FROM insurance_policies WHERE id='.intval($policies_id));
        
        $begin_date_time = $r['begin_datetime'];
        if (!$r || $r['agreement_types_id']==0) return;
        if ($r['parent_id']>0) {
            $this->loadBeginDateTimeRecursive($r['parent_id'],&$begin_date_time);
        }
        
    }
    
    
    /*
    * ищем главный полис для доп соглашения
    */
    function getPoliciesOriginal($number) {
        global $db;
        $sql = 'SELECT id FROM insurance_policies WHERE number='.$db->quote($number).' AND agreement_types_id=0';
        return $db->getOne($sql);
        
    }
     
 
    //получаем данные по договору для подстановки в шаблон
    function getValues($file) {
        global $db, $Smarty;

           $sql =  'SELECT a.*, b.*, c.*, DATE_SUB(begin_datetime, INTERVAL 1 DAY) AS endPaymentDate, DATE_ADD(DATE_SUB(begin_datetime, INTERVAL 1 DAY), INTERVAL 1 YEAR) AS endDateYear,  IF(payment_statuses_id<>' . PAYMENT_STATUSES_NOT . ' OR LENGTH(payment_number)>0, 0, 1) AS sample, ' .
                                               'IF(b.seller_agencies_id>0, IF (ds.title IS NOT NULL AND LENGTH(ds.title)>0,ds.title, IF(ds1.id>0,ds1.title,ds.title)) , IF(d.title IS NOT NULL AND LENGTH(d.title)>0,d.title, IF (d1.id>0,d1.title,d.title))) AS agencies_title, d.edrpou AS agencies_edrpou,d.generali_branches_id, IF( b.seller_agencies_id>0, IF (ds.ground_kasko_express IS NOT NULL AND LENGTH(ds.ground_kasko_express)>0,ds.ground_kasko_express, IF(ds1.id>0,ds1.ground_kasko_express,ds.ground_kasko_express)) , IF(d.ground_kasko_express IS NOT NULL AND LENGTH(d.ground_kasko_express)>0,d.ground_kasko_express, IF (d1.id>0,d1.ground_kasko_express,d.ground_kasko_express))   ) as ground_kasko, IF( b.seller_agencies_id>0, IF (ds.ground_kasko_express IS NOT NULL AND LENGTH(ds.ground_kasko_express)>0, ds.director1,IF(ds1.id>0,ds1.director1,ds.director1) ) ,IF (d.ground_kasko_express IS NOT NULL AND LENGTH(d.ground_kasko_express)>0, d.director1, IF(d1.id>0,d1.director1,d.director1))    ) as director1, IF( b.seller_agencies_id>0, IF (ds.ground_kasko_express IS NOT NULL AND LENGTH(ds.ground_kasko_express)>0, ds.director2,IF(ds1.id>0,ds1.director2,ds.director2) ) ,IF (d.ground_kasko_express IS NOT NULL AND LENGTH(d.ground_kasko_express)>0, d.director2, IF(d1.id>0,d1.director2,d.director2) )  ) as director2, c.insurer_person_types_id as person_types_id, IF( b.seller_agencies_id>0, IF (ds.ground_kasko_express IS NOT NULL AND LENGTH(ds.ground_kasko_express)>0, ds.findirector1,IF(ds1.id>0,ds1.findirector1,ds.findirector1) ) ,IF (d.ground_kasko_express IS NOT NULL AND LENGTH(d.ground_kasko_express)>0, d.findirector1, IF(d1.id>0,d1.findirector1,d.findirector1))    ) as findirector1, IF( b.seller_agencies_id>0, IF (ds.ground_kasko_express IS NOT NULL AND LENGTH(ds.ground_kasko_express)>0, ds.findirector2,IF(ds1.id>0,ds1.findirector2,ds.findirector2) ) ,IF (d.ground_kasko_express IS NOT NULL AND LENGTH(d.ground_kasko_express)>0, d.findirector2, IF(d1.id>0,d1.findirector2,d.findirector2) )  ) as findirector2, ' .
                                               'e.agreement_title AS zones_title, h.title AS registration_regions_title, j.title AS driver_ages_title, k.title AS driver_standingsTitle,DATE_ADD(interrupt_datetime, INTERVAL 1 DAY) as interrupt_datetime1,  IF( b.seller_agencies_id>0, IF (ds.ground_kasko_express IS NOT NULL AND LENGTH(ds.ground_kasko_express)>0, ds.ukravto,IF(ds1.id>0,ds1.ukravto,ds.ukravto) ) ,IF (d.ground_kasko_express IS NOT NULL AND LENGTH(d.ground_kasko_express)>0, d.ukravto, IF(d1.id>0,d1.ukravto,d.ukravto) )  ) as ukravto, ' .
                                               'IF(d1.id>0,d1.id,d.id) as top_agency_id,acc.mobile as agentphone,acc.lastname,acc.firstname,acc.patronymicname,  ' .
                                               'r1.title as rtitle, r1.edrpou as redrpou, r1.address as raddress, r1.bank as rbank, r1.bank_mfo as rbankmfo, r1.bank_account as rbankaccount ' .
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . $this->tables[0] . ' AS b ON a.policies_id = b.id ' .
                'JOIN ' . $this->tables[1] . ' AS c ON b.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS d ON b.agencies_id = d.id ' .
                                               'LEFT JOIN ' . PREFIX . '_agencies AS d1 ON d1.id = d.parent_id ' .
                                               'JOIN ' . PREFIX . '_parameters_zones AS e ON c.zones_id = e.id ' .
                                               'LEFT JOIN ' . PREFIX . '_accounts acc on acc.id=b.agents_id '.
                                               'LEFT JOIN ' . PREFIX . '_cities AS f ON c.registration_cities_id = f.id ' .
                                               'LEFT JOIN ' . PREFIX . '_parameters_regions AS h ON f.regions_id = h.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_driver_ages AS j ON c.driver_ages_id = j.id  ' .
                'LEFT JOIN ' . PREFIX . '_parameters_driver_standings AS k ON c.driver_standings_id = k.id ' .//используется только в договоре на перегоны
                'LEFT JOIN ' . PREFIX . '_agencies AS ds ON b.seller_agencies_id = ds.id ' .
                'LEFT JOIN ' . PREFIX . '_agencies AS ds1 ON ds1.id = ds.parent_id ' .
                'JOIN (SELECT a.id as idpd, b.id as idpol, IF( b.seller_agencies_id>0, IF           (ds.ground_kasko_express IS NOT NULL AND LENGTH(ds.ground_kasko_express)>0, ds.id,IF(ds1.id>0,ds1.id,ds.id) ) ,IF (d.ground_kasko_express IS NOT NULL AND LENGTH(d.ground_kasko_express)>0, d.id, IF(d1.id>0,d1.id,d.id) ) ) as idag 
                    from ' . PREFIX . '_policy_documents AS a
                    join ' . $this->tables[0] . ' AS b ON a.policies_id = b.id
                    join ' . PREFIX . '_agencies AS d ON b.agencies_id = d.id
                    LEFT JOIN ' . PREFIX . '_agencies AS d1 ON d1.id = d.parent_id
                    LEFT JOIN ' . PREFIX . '_agencies AS ds ON b.seller_agencies_id = ds.id
                    LEFT JOIN ' . PREFIX . '_agencies AS ds1 ON ds1.id = ds.parent_id) as rek ON rek.idpd = a.id ' .
                'JOIN ' . PREFIX . '_agencies AS r1 ON r1.id = rek.idag ' . 

        
        /*$sql =  'SELECT a.*, b.*, c.*, DATE_SUB(begin_datetime, INTERVAL 1 DAY) AS endPaymentDate, DATE_ADD(DATE_SUB(begin_datetime, INTERVAL 1 DAY), INTERVAL 1 YEAR) AS endDateYear,  IF(payment_statuses_id<>' . PAYMENT_STATUSES_NOT . ' OR LENGTH(payment_number)>0, 0, 1) AS sample, ' .
                'd.title AS agencies_title, d.edrpou AS agencies_edrpou,d.generali_branches_id, IF (b.insurance_companies_id <> ' . INSURANCE_COMPANIES_GENERALI . ', d.ground_kasko_express,  d.ground_kasko_generali) as ground_kasko, d.director1, d.director2,c.insurer_person_types_id as person_types_id, ' .
                'e.agreement_title AS zones_title, h.title AS registration_regions_title, j.title AS driver_ages_title, k.title AS driver_standingsTitle,DATE_ADD(interrupt_datetime, INTERVAL 1 DAY) as interrupt_datetime1, ' .
                'IF(d1.id>0,d1.id,d.id) as top_agency_id,acc.mobile as agentphone,acc.lastname,acc.firstname,acc.patronymicname '.
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . $this->tables[0] . ' AS b ON a.policies_id = b.id ' .
                'JOIN ' . $this->tables[1] . ' AS c ON b.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS d ON b.agencies_id = d.id ' .
                'LEFT JOIN ' . PREFIX . '_agencies AS d1 ON d1.id = d.parent_id ' .
                'JOIN ' . PREFIX . '_parameters_zones AS e ON c.zones_id = e.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts acc on acc.id=b.agents_id '.
                'LEFT JOIN ' . PREFIX . '_cities AS f ON c.registration_cities_id = f.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_regions AS h ON f.regions_id = h.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_driver_ages AS j ON c.driver_ages_id = j.id  ' .
                'LEFT JOIN ' . PREFIX . '_parameters_driver_standings AS k ON c.driver_standings_id = k.id ' .//используется только в договоре на перегоны
                */
                'WHERE a.id=' . intval($file['id']);
        $row = $db->getRow($sql);
//_dump($sql);exit;
        //_dump($row['director2']);exit;
        if ($row) {
            if ($row['seller_agencies_id']>0 ) {
            //_dump($row['agencies_title']);exit;
                //$r = $db->getRow('SELECT title as agencies_title,ground_kasko_express as ground_kasko, director1,director2  FROM  insurance_agencies WHERE (regions_id<>26 or ukravto=0) and id='.$row['seller_agencies_id']);
                /*$r = $db->getRow('SELECT title as agencies_title,ground_kasko_express as ground_kasko, director1,director2  FROM  insurance_agencies WHERE   id='.$row['seller_agencies_id']);
                if ($r) {
                    $row = array_merge ( $row, $r );
                }   
                else {
                    $row['agent_lastname'] = 'Поліщук';
                    $row['agent_firstname'] = 'Михайло';
                    $row['agent_patronymicname'] ='Олександрович';
                }*/
                
            }
            $row['agencies_title'] = str_replace('_NISSAN_RENUALT', '',  $row['agencies_title']);
            $row['agencies_title'] = str_replace('Відділ продажу', '',  $row['agencies_title']);
        }

        $sql =  'SELECT a.*, b.title as engine_sizesTitle, c.title as colors_title,d.bill_bank_account,d.bill_bank_mfo,d.retail,getCarParameters(1,a.car_body_id) as car_body_title, getCarParameters(3,a.car_engine_type_id) as car_engine_type_title, getCarParameters(2,a.transmissions_id) as transmissions_title ' .
                'FROM ' . PREFIX . '_policies_kasko_items AS a ' .
                'LEFT JOIN ' . PREFIX . '_parameters_engine_sizes AS b ON a.engine_sizes_id = b.id ' .
                'LEFT JOIN ' . PREFIX . '_car_colors as c ON a.colors_id = c.id ' .
                'LEFT JOIN ' . PREFIX . '_products_kasko AS d ON d.products_id = a.products_id ' .
                'WHERE a.policies_id = ' . intval($row['policies_id']);
        $row['items'] = $db->getAll($sql);

        if (is_array($row['items'])) {
            $transmissions = $this->itemFormDescription['fields'][ $this->getFieldPositionByName('transmissions_id', $this->itemFormDescription) ];
            $car_engine_type = $this->itemFormDescription['fields'][ $this->getFieldPositionByName('car_engine_type_id', $this->itemFormDescription) ];
            $car_body = $this->itemFormDescription['fields'][ $this->getFieldPositionByName('car_body_id', $this->itemFormDescription) ];

            $row['bill_bank_account']   = $row['items'][0]['bill_bank_account'];
            $row['bill_bank_mfo']       = $row['items'][0]['bill_bank_mfo'];

            foreach ($row['items'] as $i => $item) {

                $row['items'][ $i ]['transmissions_title'] = $transmissions['list'][ $row['items'][ $i ]['transmissions_id'] ];
                $row['items'][ $i ]['car_engine_type_title'] = $car_engine_type['list'][ $row['items'][ $i ]['car_engine_type_id'] ];
                $row['items'][ $i ]['car_body_title'] = $car_body['list'][ $row['items'][ $i ]['car_body_id'] ];

                $use_as_car = intval($item['use_as_car']);
                if($use_as_car&1) $row['items'][ $i ]['use_as_car_private'] = 1;
                if($use_as_car&2) $row['items'][ $i ]['use_as_car_work'] = 1;
                if($use_as_car&4) $row['items'][ $i ]['use_as_car_leasing'] = 1;

                if (doubleval($item['amount_accident'])>0) {
                    $row['items'][ $i ]['price_accidentDriver']     = ($row['items'][ $i ]['number_places'] > 0) ? round($row['items'][ $i ]['price_accident'] / $row['items'][ $i ]['number_places'], 2) : 0;
                    $row['items'][ $i ]['price_accidentPassengers'] = ($row['items'][ $i ]['number_places'] > 0) ? $row['items'][ $i ]['price_accident'] - $row['items'][ $i ]['price_accidentDriver'] : 0;
                }
            }
        }

        if (is_array($row['items']) && sizeof($row['items'])>0) {
            $row = array_merge($row['items'][0], $row);
        }

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies_kasko_item_equipment ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $row['equipment'] = $db->getAll($sql);

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies_kasko_persons ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $row['persons'] = $db->getAll($sql);
        
        $row['top'] = $this->getPoliciesOriginal($row['number']);
        $row['original'] = $db->getRow('SELECT * FROM  insurance_policies WHERE id='.intval($row['top']));
        $row['parent'] = $db->getRow('SELECT * FROM  insurance_policies WHERE id='.intval($row['parent_id']));

            
        if ($row['sub_number']>0 || $row['agreement_types_id']>0) //доп угода загрузить полис оригинал
        {
            $end_date = $db->quote($db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($row['id'])));
            $row['original']['second_year'] = $db->getRow('SELECT a.*,DATE_SUB(a.date, INTERVAL 1 DAY) AS lastdate FROM insurance_policies_kasko_item_years_payments a WHERE policies_id='.intval($row['parent_id']).' AND a.date<'.$end_date.' ORDER BY date DESC LIMIT 1');

            $row['original']['terms_years_id'] = $db->getOne('SELECT terms_years_id FROM insurance_policies_kasko WHERE policies_id='.intval($row['top']));
            if ($row['agreement_types_id']==3) //доп угода востановление СС
            {
                //выплаты по урегулированию дела
                $begin_date = $db->quote($db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($row['parent_id'])));
                if (isset($row['original']['second_year']['date'])) $begin_date = $db->quote($row['original']['second_year']['date']);

                if (intval($row['options_agregate_no'])) {
                    $p = null;
                } else {
                    $sql = 'SELECT SUM(c.amount) as payedAmount,max(c.payment_date) as payeddate FROM insurance_accidents b JOIN insurance_accident_payments_calendar c ON b.id = c.accidents_id WHERE c.payment_statuses_id>1 AND b.policies_id = ' . intval($row['parent_id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND ' . $end_date . ' AND c.payment_types_id IN (5,6)  ';
                    $p = $db->getRow($sql);
                }
                //!!!!$p['payedAmount'] = 17943.84;
                $row['original']['payed_amount'] =doubleval($p['payedAmount']);
                $row['original']['payed_date'] =$p['payeddate'];
                $row['original']['item_price'] = doubleval($db->getOne('SELECT item_price FROM insurance_policies_kasko_item_years_payments WHERE  policies_id='.intval($row['parent_id']).' AND date<'.$db->quote($row['begin_datetime']).' ORDER BY date desc')); 
                if ($row['original']['item_price']==0) $row['original']['item_price'] = $row['original']['price'];
                $row['original']['current_item_price'] = $row['original']['item_price'] - $row['original']['payed_amount'];
                if ($row['original']['current_item_price']<0) $row['original']['current_item_price'] = 0;
                $row['current_begin_datetime'] = $row['begin_datetime'];
                $row['market_price_date'] = $db->getOne('SELECT IF(b.expert_date>0,b.expert_date,a.date) FROM insurance_policies a JOIN insurance_policies_kasko_items b on b.policies_id=a.id WHERE a.id='.intval($row['policies_id']));
        
            
            }
        }

        if (intval($row['sign_agents_id'])) {

            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_agents ' .
                    'WHERE accounts_id = ' . intval($row['sign_agents_id']);
            $agent = $db->getRow($sql);

            $agent['ground_kasko'] = ($row['insurance_companies_id'] == INSURANCE_COMPANIES_GENERALI) ? $agent['ground_kasko_generali'] : $agent['ground_kasko_express'];

            if ($agent['ground_kasko'] && $agent['director1'] && $agent['director2']) {
                $row['ground_kasko'] = $agent['ground_kasko'];
                $row['director1']   = $agent['director1'];
                $row['director2']   = $agent['director2'];
            }
            
        }
        if (intval($row['insurance_companies_id'])==INSURANCE_COMPANIES_GENERALI && intval($row['generali_branches_id'])>0) {
                $row['generali'] = $db->getRow('SELECT * FROM ' . PREFIX . '_generali_branches WHERE id = ' . intval($row['generali_branches_id']));
        }

        if ($row['financial_institutions_id']==33 || $row['financial_institutions_id']==1 /*&& ($row['products_id']==30 || $row['products_id']==49 || $row['products_id']==52 || $row['products_id']==57 || $row['products_id']==58 || $row['products_id']==74)*/) { //Костыль Астрабанка акционные продукты

            //load period
            $url = 'https://express-credit.in.ua/synchronization/express/kreditperiod.php?policiesId=' . $row['policies_id'].'&owner_identification_code='.$row['owner_identification_code'];
            $xml = @simplexml_load_file($url);
            if ($xml) {
                $row['expert_period'] = intval($xml->expert_period);
            }

            $row['paymentsCalendar'] = array();

            if ($row['expert_period'] > 12) {

                require_once $Smarty->_get_plugin_filepath('shared','make_timestamp');

                $expert_period = $row['expert_period']-12;

                $begin_date = smarty_make_timestamp($row['begin_datetime']);
                $end_date   = smarty_make_timestamp($row['end_datetime']);

                while($expert_period > 0) {

                    $begin_date = mktime(0, 0, 0, date('m', $begin_date), date('d', $begin_date), date('Y', $begin_date) + 1);//+1 year

                    if ($expert_period >= 12) {
                        $end_date   = mktime(0, 0, 0, date('m', $end_date), date('d',$end_date), date('Y', $end_date) + 1);//1 year
                    } else {
                        $end_date   = mktime(0, 0, 0, date('m', $end_date) + $expert_period, date('d', $end_date), date('Y', $end_date));//+$expert_period month
                    }

                    $end_payment_date = mktime(0, 0, 0, date('m', $begin_date), date('d', $begin_date) - 20, date('Y', $begin_date));//-20 days

                    $expert_period -= 12;

                    $row['paymentsCalendar'][] = array(
                        'begin_date'        => date('Y-m-d', $begin_date),
                        'end_date'          => date('Y-m-d', $end_date),
                        'end_payment_date'  => date('Y-m-d', $end_payment_date));
                }
            }
        }

        $sql =  'SELECT a.date, a.amount, DATE_SUB(a.date, INTERVAL 1 DAY) AS lastdate,UNIX_TIMESTAMP(a.date) as orderpos ' .
                'FROM ' . PREFIX . '_policy_payments_calendar as a ' .
                'JOIN ' . PREFIX . '_policies as b ON a.policies_id = b.id ' .
                'WHERE a.second_fifty_fifty = 0 AND a.date BETWEEN b.begin_datetime AND b.end_datetime AND a.policies_id = ' . intval($row['policies_id']);
        $row['payments'] = $db->getAll($sql);
        $max_amount = 0; //для финмониторинга
        if (is_array($row['payments'])) {
            foreach($row['payments'] as $p) {
                if ($p['amount']>$max_amount)
                    $max_amount = $p['amount'];
            }
        }
        $row['max_amount'] = $max_amount;
        
        if ($row['agreement_types_id']==3 && $row['payments'][0]) {
            $row['payments'][0]['doplata'] = 1;//маркер для звездочек в печатной форме
            $row['payments'][0]['orderpos'] = '9999999999';
        }
        if ($row['payment_brakedown_id']==1) {  
            $row['payment6month'] = 0;
            $row['payment6month2']  = 0;
            $row['payment12month'] = $row['payments'][0]['amount'];
            $row['payment6monthdate']  = $row['payments'][0]['lastdate'];
        }
        elseif ($row['payment_brakedown_id']==2) {
            $row['payment6month'] = $row['payments'][0]['amount'];
            $row['payment6month2'] = $row['payments'][1]['amount'];
            $row['payment12month'] = $row['payments'][0]['amount'] + $row['payments'][1]['amount'];
            $row['payment6monthdate']  = $row['payments'][0]['lastdate'];
            $row['payment6monthdate2']  = $row['payments'][1]['lastdate'];
        }
        
        if($row['agreement_types_id']>0 && is_array($row['payments'])) {
            //для допа загружать рекурсивно  пердыдущий календарь
            $this->loadPaymentsRecursive($row['policies_id'],&$row['payments']);
        }
        //сортировать по orderpos
        /*if (is_array($row['payments'])) {
            $temp = $row['payments'];
            uasort($temp , 'cmp');
            $row['payments'] = array(); //нужно перезаполнять иначе в шаблоне непонимает что оно отсортировано
            foreach($temp as $r) {$row['payments'][] = $r;}
        }*/
        //_dump($row['payments']);exit;
        $row['paymentsCount'] = (is_array($row['payments'])) ? sizeof($row['payments']) : 1;

        $sql =  'SELECT a.* ,DATE_SUB(a.date, INTERVAL 1 DAY) AS lastdate,UNIX_TIMESTAMP(a.date) as orderpos  ' .
                'FROM ' . PREFIX . '_policies_kasko_item_years_payments a '.
                'WHERE a.policies_id=' . intval($row['policies_id']).' ORDER BY date';
                
        $row['yearsPayments'] = $db->getAll($sql);
        //чтобы могли распечатываться многолетние формы на 1 год
        if (!is_array($row['yearsPayments']) || sizeof($row['yearsPayments'])==0)
        {
            $row['yearsPayments'] = $db->getAll('SELECT policies_id,'.intval($row['items'][0]['id']).' as items_id,date,DATE_SUB(date, INTERVAL 1 DAY) AS lastdate, UNIX_TIMESTAMP(date) as orderpos, '.
                                    //doubleval($row['rate_kasko']).' as rate_kasko,'. doubleval($row['car_price']).' as item_price,'.doubleval($row['amount_kasko']).' as amount_kasko '.
                                    doubleval($row['rate_kasko']).' as rate_kasko,'. doubleval($row['car_price']) .' as item_price,amount as amount_kasko '.
                                    'FROM '.PREFIX.'_policy_payments_calendar WHERE second_fifty_fifty = 0 AND policies_id='. intval($row['policies_id']));
        }
        
        $payment_brakedown = 0; //ставить в true если нужно сделать банковский договор первый год с разбивкой
        
        if ($row['financial_institutions_id']>0 && $row['payment_brakedown_id']>1) $payment_brakedown = 1; 
        
        if(($row['agreement_types_id']>0 || $payment_brakedown) && is_array($row['yearsPayments'])) {
            if ($row['agreement_types_id']==1)  $row['yearsPayments'][0]['rate_kasko']='-';
            if ($row['payment_brakedown_id']>1) //есть разбивка платежа
            {
                array_shift($row['yearsPayments']);//выбрасываем первый многолетний платеж и загружаем его из календаря платежей
                    $p = $db->getAll('SELECT policies_id,'.intval($row['items'][0]['id']).' as items_id,date,DATE_SUB(date, INTERVAL 1 DAY) AS lastdate, UNIX_TIMESTAMP(date) as orderpos,'.
                                    doubleval($row['rate_kasko']).' as rate_kasko,'. doubleval($row['car_price']) .' as item_price,amount as amount_kasko '.
                                    'FROM '.PREFIX.'_policy_payments_calendar WHERE second_fifty_fifty = 0 AND policies_id='. intval($row['policies_id']).' '.(sizeof($row['yearsPayments']) ? ' AND date<'.$db->quote($row['yearsPayments'][0]['date']) : '').' ORDER BY date');
                    if (is_array($p) && sizeof($p)) {
                        foreach($p as $i=>$v) {
                            $p[$i]['rowspan'] = sizeof($p);
                        }
                        $row['yearsPayments'] = array_merge( $p, $row['yearsPayments'] );
                    }

                
            }
            if ($row['agreement_types_id']==3)
            $row['yearsPayments'][0]['doplata'] = 1;//маркер для звездочек в печатной форме
            //для допа загружать рекурсивно предыдущий многолетний календарь
            if ($row['agreement_types_id']>0)
                $this->loadYearPaymentsRecursive($row['policies_id'],&$row['yearsPayments']);
        }
        

        //сортировать по orderpos
        if (is_array($row['yearsPayments'])) {
            $temp = $row['yearsPayments'];
            uasort($temp , 'cmp');
            $row['yearsPayments'] = array(); //нужно перезаполнять иначе в шаблоне непонимает что оно отсортировано
            foreach($temp as $r) {$row['yearsPayments'][] = $r;}
        }
        
        if($row['agreement_types_id']>0)
        {//для допа загружать рекурсивно дату начала самого первого договора
            $row['begin_datetime_add_agreement']= $row['begin_datetime'];
            $this->loadBeginDateTimeRecursive($row['policies_id'],&$row['begin_datetime']);
        }
        //_dump($row['begin_datetime']);exit;
        
        $row['yearsPaymentsCount'] = (is_array($row['yearsPayments'])) ? sizeof($row['yearsPayments']) : 0;

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policy_risks AS a ' .
                'JOIN ' . PREFIX . '_parameters_risks AS b ON a.risks_id = b.id ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $risks = $db->getAll($sql);

        foreach ($risks as $risk) {
            $row[$risk['alias']] = 1;
        }

        switch ($row['product_document_types_id']) {
            case DOCUMENT_TYPES_POLICY_KASKO_APPLICATION://заявление КАСКО
            case DOCUMENT_TYPES_POLICY_KASKO_AGREEMENT://полис КАСКО
            case DOCUMENT_TYPES_POLICY_KASKO_QUESTIONNAIRE://опросник
            case 101://разрыв
                $fields = array(
                    'insurerTitle',
                    'insurer_address',
                    'ownerTitle',
                    'ownerAddress',
                    'closed');
                break;
            case DOCUMENT_TYPES_POLICY_KASKO_BILL://счет КАСКО
                $fields = array('payed', 'closed');
                break;
        }
        
        
        //анулирован данные для печати доп угоды
        if ($row['policy_statuses_id'] == POLICY_STATUSES_CANCELLED || $row['policy_statuses_id'] == POLICY_STATUSES_DISSOLVED) 
        {
            //выплаты по урегулированию дела
            $begin_date = $db->quote($db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($row['policies_id'])));
            $end_date = $db->quote($db->getOne('SELECT interrupt_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($row['policies_id'])));
            $sql = 'SELECT SUM(a.amount) FROM insurance_accident_payments a JOIN insurance_accidents b on b.id=a.accidents_id JOIN insurance_accident_payments_calendar c ON a.payments_calendar_id = c.id WHERE b.policies_id = ' . intval($row['policies_id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND ' . $end_date . ' AND c.payment_types_id IN (5,6) AND a.is_return=0';
            $row['payed_accident_amount'] = doubleval($db->getOne($sql));

            //вычисляем сумму оплаченную
            $row['fact_policy_amount'] = Payments::getAmount($row['policies_id']);
            
            $d = $this->calculateInterruptData($row['policies_id'],$end_date);
            $row['useddays'] = $d['useddays'];
            $row['alldays'] = $d['alldays'];
            $row['policy_used_amount'] = $d['amount']*$d['useddays']/$d['alldays'];
            $row['policy_rest_amount'] = $d['amount']*($d['alldays']-$d['useddays'])/$d['alldays'];
            $over = $row['fact_policy_amount'] - $d['amount'];
            if ($over<0) $over = 0;
            $row['policy_over_amount'] =$over;


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
                'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        $row = $db->getRow($sql);

        $sql =  'SELECT a.*, b.title as engine_sizesTitle, c.title as colors_title ' .
                'FROM ' . PREFIX . '_policies_kasko_items a '.
                'LEFT JOIN ' . PREFIX . '_parameters_engine_sizes as b ON a.engine_sizes_id=b.id ' .
                'LEFT JOIN ' . PREFIX . '_car_colors as c ON a.colors_id=c.id ' .
                'WHERE a.policies_id=' . intval($id);
        $row['items'] = $db->getAll($sql);

        $sql =  'SELECT a.*  ' .
                'FROM ' . PREFIX . '_policies_kasko_item_years_payments a '.
                'WHERE a.policies_id=' . intval($id);
        $row['yearsPayments'] = $db->getAll($sql);

        return $row;
    }

    //поиск договора страхования при заполении данных из заявления на страхование
    function getSearchInWindow($data) {
        global $db;

        if ($data['number']) {
            $conditions[] = 'policies.number LIKE \'%' . $data['number'] . '%\'';
        } else {
           $conditions[] = '\'' .  date('Y-m-d', strtotime($data['datetime'])) . '\' BETWEEN getPolicyDate(policies.number, 2) AND getPolicyDate(policies.number, 3)';
        }

        if ($data['insurer_lastname']) {
            $conditions[] = 'policies_kasko.insurer_lastname LIKE ' . $db->quote('%' . $data['insurer_lastname'] . '%');
        }

        if ($data['insurer_passport_series']) {
            $conditions[] = 'policies_kasko.insurer_passport_series = ' . $db->quote($data['insurer_passport_series']);
        }

        if ($data['insurer_passport_number']) {
            $conditions[] = 'policies_kasko.insurer_passport_number = ' . $db->quote($data['insurer_passport_number']);
        }

        if ($data['insurer_identification_code']) {
            $conditions[] = 'policies_kasko.insurer_identification_code = ' . $db->quote($data['insurer_identification_code']);
        }

        if ($data['shassi']) {
            $conditions[] = 'kasko_items.shassi LIKE \'%' . $data['shassi'] . '%\'';
        }

        if ($data['sign']) {
            $conditions[] = 'kasko_items.sign LIKE \'%' . $data['sign'] . '%\'';//$db->quote($data['sign']);
        }

        if($data['items_id']){
            $conditions[] = 'kasko_items.id = ' . intval($data['items_id']);
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
                            '</tr>';

        if(!$data['datetime'] || !checkdate(substr($data['datetime'], 3, 2), substr($data['datetime'], 0, 2), substr($data['datetime'], 6, 4))) {
            $result .= '<tr><td colspan="9" align="center" style="color: red;">Дата події обов\'язкова для заповнення.</td></tr>';
            $result .= '</table>';
            echo $result;
            return;
        }

        if (!$conditions) {
            $result .= '<tr><td colspan="9" align="center" style="color: red;">Не задали жодного критерію пошуку.</td></tr>';
            $result .= '</table>';
            echo $result;
            exit;
        }

        $sql =  'SELECT ' . ((!$data['items_id']) ? 'getValidPoliciesIdByNumber(policies.number, \'' . date('Y-m-d', strtotime($data['datetime'])) . '\')' : 'policies.id') . ' as policies_id, kasko_items.id as items_id, policies.product_types_id, IF(policies_kasko.insurer_person_types_id = 1, CONCAT(policies_kasko.insurer_lastname, \' \', policies_kasko.insurer_firstname, \' \', policies_kasko.insurer_patronymicname), policies_kasko.insurer_company) AS insurer, policies.number, date_format(getPolicyDate(policies.number, 1), \'%d.%m.%Y\') as date_format, ' .
                        'CONCAT(kasko_items.brand, \'/\', kasko_items.model) AS item, kasko_items.shassi, kasko_items.sign, date_format(getPolicyDate(policies.number, 2), \'%d.%m.%Y\') as begin_datetime_format,  date_format(getPolicyDate(policies.number, 3), \'%d.%m.%Y\') as interrupt_datetime_format ' .
                'FROM ' . PREFIX . '_policies AS policies ' .
                'JOIN ' . PREFIX . '_policies_kasko AS policies_kasko ON policies.id = policies_kasko.policies_id ' . ((!$data['items_id']) ? 'AND policies.id = getValidPoliciesIdByNumber(policies.number, \'' . date('Y-m-d', strtotime($data['datetime'])) . '\') ' : '') .
                'JOIN ' . PREFIX . '_policies_kasko_items AS kasko_items ON policies.id = kasko_items.policies_id ' . ((!$data['items_id']) ? 'AND policies.id = getValidPoliciesIdByNumber(policies.number, \'' . date('Y-m-d', strtotime($data['datetime'])) . '\') ' : '') .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'GROUP BY policies.number, kasko_items.shassi ' .
                'ORDER BY begin_datetime DESC';
        $list = $db->getAll($sql);
//_dump($sql);
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
                                    '<td><a href="/?do=Policies|view&id=' . $row['policies_id'] . '&product_types_id=' . $row['product_types_id'] . '" target="_blank">' . (($data['important_person'] == 0) ? $row['number'] : $row['number'] . ' <b style="color: red;">VIP</b>') . '</a></td>' .
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

        echo $result;
    }

    //Export 1C 7.7
    function getXML($data) {
        global $db, $Smarty;

        //return $data['number'];
        if ($data['number']) {
            $conditions[] = 'a.number=' . $db->quote($data['number']);
        } else {
            //$conditions[] = 'a.payment_number <> \'\'';
            //$conditions[] = ($data['from']) ? 'TO_DAYS(a.payment_datetime )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.payment_datetime )>=TO_DAYS(NOW())';
            //$conditions[] = ($data['to']) ? 'TO_DAYS(a.payment_datetime )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.payment_datetime ) <= TO_DAYS(NOW())';
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.date )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.date )>=TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.date )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.date ) <= TO_DAYS(NOW())';
            $conditions[] = '(a.policy_statuses_id IN( ' . POLICY_STATUSES_GENERATED . ', ' . POLICY_STATUSES_CONTINUED . ', ' . POLICY_STATUSES_RENEW . ') OR b.financial_institutions_id = ' . FINANCIAL_INSTITUTIONS_UKRAUTOLEASING . ')';
        }

        $conditions[] =' a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
        
        if ($data['agreement_types_id']>0)
        {
            $conditions[] =' a.agreement_types_id > 0';
            $conditions[] = '(a.policy_statuses_id IN( ' . POLICY_STATUSES_GENERATED . ', ' . POLICY_STATUSES_CONTINUED . ', ' . POLICY_STATUSES_RENEW . ') OR b.financial_institutions_id = ' . FINANCIAL_INSTITUTIONS_UKRAUTOLEASING . ')';
            if (!$data['number']) {
                $conditions[] =' a.amount > 0';
                $conditions[] =' a.payment_statuses_id > 1';
            }
        }   
        else
        {
            $conditions[] =' a.next_policy_statuses_id = 0';
            $conditions[] =' a.agreement_types_id = 0';
        }   

        $sql =  'SELECT b.*, a.date,a.certificate,a.agreement_types_id,a.sub_number,a.parent_id,' .
                'a.begin_datetime, ' .
                'a.end_datetime ,  ' .
                'a.begin_datetime as billDate, ' .
                'a.modified as modifiedDate, ' .
                'a.created, ' .
                'a.documents,'.
                'a.begin_datetime as payment_datetime, ' .
                'a.policy_statuses_id, \'\' as payment_number, a.number, '.
                'a.item, a.price, a.rate, a.amount,a.product_types_id,  '.
                'b.insurer_person_types_id as person_types_id,  '.
                'd.title AS insurerRegionsTitle, r.title as ownerRegionsTitle, j.title AS  driver_standingsTitle, k.title AS driversTitle, l.title AS driver_ages_title, m.title AS termsTitle, ' .
                'o.title AS financial_institutions_title, o.mfo AS financial_institutionsMFO, o.edrpou AS financial_institutionsEDRPOU, '.
                'IF(e1.id>0,e1.title,e.title) as agency_title,IF(e1.id>0,e1.edrpou,e.edrpou) as agencyedrpou '.
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_kasko AS b ON b.policies_id=a.id ' .
                'JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id=c.id ' .
                'LEFT JOIN ' . PREFIX . '_regions AS d ON b.insurer_regions_id=d.id ' .
                'LEFT JOIN ' . PREFIX . '_regions AS r ON b.owner_regions_id=r.id ' .
                'JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id=e.id ' .
                'LEFT JOIN ' . PREFIX . '_agencies AS e1 ON e.parent_id=e1.id ' .
                'JOIN ' . PREFIX . '_parameters_driver_standings AS j ON b.driver_standings_id=j.id AND j.product_types_id =' . PRODUCT_TYPES_KASKO . ' ' .
                'JOIN ' . PREFIX . '_parameters_drivers AS k ON b.drivers_id=k.id AND k.product_types_id =' . PRODUCT_TYPES_KASKO . ' ' .
                'LEFT JOIN ' . PREFIX . '_parameters_driver_ages AS l ON b.driver_ages_id=l.id AND l.product_types_id =' . PRODUCT_TYPES_KASKO . ' ' .
                'JOIN ' . PREFIX . '_parameters_terms AS m ON b.terms_id=m.id ' .
                'LEFT JOIN ' . PREFIX . '_financial_institutions AS o ON b.financial_institutions_id=o.id   ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);
//return $sql;
       foreach ($list as $i=>$row) {
            $sql =  'SELECT date as payment_date, amount as payment_amount,YEAR(date) as ydate ' .
                    'FROM ' . PREFIX . '_policy_payments_calendar ' .
                    'WHERE policies_id = ' . intval($row['policies_id']);
            $list[$i]['paymentsCalendar'] = $db->getAll($sql);

            if ($row['agreement_types_id']>0) //доп угода
            {
                $sql =  'SELECT a.date as payment_date, a.amount as payment_amount,YEAR(a.date) as ydate ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar as a ' .
                        'JOIN ' . PREFIX . '_policies as b ON a.policies_id = b.id ' .
                        'WHERE b.number = ' . $db->quote($row['number']).' AND a.date<b.interrupt_datetime AND b.policy_statuses_id<>1 ORDER BY a.date';
                //$l = $db->getAll($sql);
                $list[$i]['paymentsCalendar'] = $db->getAll($sql);

                /*if ($l && sizeof($l))
                {
                    foreach($l as $r)
                    {
                        array_unshift ( $list[$i]['paymentsCalendar'],$r);
                    }
                }*/
            }

            $fields = array('insurer_address');

            $row = $this->prepareValues($fields, $row);

            $list[$i]['insurer_address'] = $row['insurer_address'];

            $sql =  'SELECT risks_id, b.title, a.value ' .
                    'FROM ' . PREFIX . '_policy_risks AS a ' .
                    'JOIN ' . PREFIX . '_parameters_risks AS b ON a.risks_id = b.id ' .
                    'WHERE a.policies_id = ' . intval($row['policies_id']);
            $list[$i]['risks'] = $db->getAll($sql);

            $sql =  'SELECT a.*, kt.title AS car_type_title, p.title AS colors_title, f.code AS engine_code ' .
                    'FROM ' . PREFIX . '_policies_kasko_items AS a '.
                    'JOIN ' . PREFIX . '_car_types AS kt ON kt.id=a.car_types_id '.
                    'LEFT JOIN ' . PREFIX . '_car_colors AS p ON a.colors_id=p.id '.
                    'LEFT JOIN ' . PREFIX . '_parameters_engine_sizes AS f ON a.engine_sizes_id=f.id AND f.product_types_id =' . PRODUCT_TYPES_KASKO . ' ' .
                    'WHERE a.policies_id=' . intval($row['policies_id']);
            $list[$i]['items'] = $db->getAll($sql);
            
            if (is_array($list[$i]['items']))
            {
                foreach ($list[$i]['items'] as $j=>$row1) {
                    $sql='SELECT a.*,YEAR(a.date) as ydate FROM ' . PREFIX . '_policies_kasko_item_years_payments a WHERE a.items_id='.$row1['id'].' AND a.policies_id=' . intval($row['policies_id']);
                    $list[$i]['items'][$j]['yearpayments'] = $db->getAll($sql);
                    if ($row['agreement_types_id']>0) //доп угода
                    {
                        $sql='SELECT a.*,YEAR(a.date) as ydate FROM ' . PREFIX . '_policies_kasko_item_years_payments a JOIN insurance_policies_kasko_items b ON b.id=a.items_id JOIN insurance_policies c ON b.policies_id = c.id WHERE b.shassi='.$db->quote($row1['shassi']).' AND c.number=' . $db->quote($row['number']). ' AND a.date<c.interrupt_datetime AND c.policy_statuses_id<>1 ORDER BY a.date';
                        $list[$i]['items'][$j]['yearpayments'] = $db->getAll($sql);
                        /*if ($l && sizeof($l))
                        {
                            foreach($l as $r)
                            {
                                $find = false;
                                foreach($list[$i]['items'][$j]['yearpayments'] as $k=>$rr)
                                {
                                    if (intval($rr['ydate'])==intval($r['ydate'])) //вклиниваем в этот год
                                    {
                                        $list[$i]['items'][$j]['yearpayments'][$k]['date']  = $r['date'];
                                        $list[$i]['items'][$j]['yearpayments'][$k]['amount_kasko']  +=$r['amount_kasko'];
                                        $list[$i]['items'][$j]['yearpayments'][$k]['rate_kasko']  = $list[$i]['items'][$j]['yearpayments'][$k]['amount_kasko']/$list[$i]['items'][$j]['yearpayments'][$k]['item_price']*100;
                                        $find = true;
                                        break;
                                    }
                                }
                                if (!$find)
                                    array_unshift ( $list[$i]['items'][$j]['yearpayments'],$r);
                            }
                        }*/
                    }
                }
            }   
        }
        $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/kasko.xml');
    }

    //изменение подписанта в договоре страхования
    function changeSignInWindow($data) {
        global $db;

        //$this->checkPermissions('view', $data);

        $sql =  'UPDATE ' . PREFIX . '_policies_kasko SET ' .
                'sign_agents_id = ' . intval($data['sign_agents_id']) . ' ' .
                'WHERE policies_id = ' . intval($data['policies_id']);
        $db->query($sql);

        if ($this->getPolicyStatusesId($data['policies_id']) == POLICY_STATUSES_GENERATED) {
            PolicyDocuments::generateTemplates($data['policies_id'], null, true);
        }

        echo 'Ok';
        exit;
    }
    
    //изменение пробега в договоре страхования без доступа к договору
    function changeRaceInWindow($data) {
        global $db;

        //$this->checkPermissions('view', $data);
        $sql = 'SELECT payment_statuses_id FROM insurance_policies WHERE id=' .intval($data['policies_id']);
        $payment_statuses_id = $db->getOne($sql);

        $sql =  'UPDATE insurance_policies_kasko_items SET ' .
                'race = ' . intval($data['race']) . ' ' .
                'WHERE policies_id = ' . intval($data['policies_id']);
        $db->query($sql);

        if ($this->getPolicyStatusesId($data['policies_id']) == POLICY_STATUSES_GENERATED) {
            PolicyDocuments::generateTemplates($data['policies_id'], null, true);
        }

        echo 'Пробiг було змiнено';
        exit;
    }
    

    function getLink($text, $fieldName, $fieldType) {
        global $Authorization;
        
        $reset = false;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $reset = true;
                break;
            case ROLES_MANAGER:
                $reset =($Authorization->data['permissions']['Policies_KASKO']['update']) ? true : false;
                break;
        }

        if ($this->mode == 'update') $reset = false;

        if (!$reset) return $text;

        return '<a itemid="' . $fieldName . '" fieldtype="' . $fieldType . '" class="changeval" href="#inlinecontent">' . $text . '</a>';
    }

    //обновляем выборочно поля по договору страхования
    function changePolicyInWindow($data) {
        global $db, $Authorization;

        if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR || $Authorization->data['permissions']['Policies_KASKO']['update']) {

            //обновить выборочные поля в полисе и регенерировать шаблоны
            $data['id'] = $data['policies_id'];
            foreach ($data as $key => $val) {
                if ($key == 'product_types_id') continue;

                if (!is_array($val) &&  $this->getFieldPositionByName($key)>0 ) {

                    $field = $this->formDescription['fields'][ $this->getFieldPositionByName($key) ];

                    $identity_field = ($field['table']=='policies_kasko') ? 'policies_id' : 'id';

                    if ($field['type'] == fldDate) {
                        $val = substr($val, 6, 4) . substr($val, 3, 2) . substr($val, 0, 2);
                    }

                    $sql = 'UPDATE ' . PREFIX . '_' . $field['table'] . ' SET ' . $field['name'] . ' = ' . $db->quote($val) . ' WHERE ' . $identity_field . '=' . intval($data['id']);
                    $db->query($sql);
                } else if (is_array($val)) {

                    foreach ($val as $itemId => $item) {

                        $id = $db->getOne('SELECT id FROM ' . PREFIX . '_policies_kasko_items WHERE policies_id = ' . intval($data['id']) . ' LIMIT ' . $itemId . ', 1');

                        foreach ($item as $key1 => $val1) {
                            
                            if ($this->getFieldPositionByName($key1, $this->itemFormDescription)) {

                                $field = $this->itemFormDescription['fields'][ $this->getFieldPositionByName($key1,$this->itemFormDescription) ];

                                if ($field['type'] == fldDate) {
                                    $val1 = substr($val1, 6, 4) . substr($val1, 3, 2) . substr($val1, 0, 2);
                                }

                                $identity_field = 'id';

                                $sql='UPDATE  '.PREFIX.'_'. $field['table'].' SET '.$field['name'].'='.$db->quote($val1).' WHERE '.$identity_field.'='.intval($id);
                                $db->query($sql);
                            }
                        }
                    }
                }
            }

            PolicyDocuments::generateTemplates($data['policies_id'], null, true);
        }

        echo 'Ok';
        exit;
    }

    //измененяем представителя СТО
    function changeServicePersonInWindow($data) {
        global $db, $Log;

        if (true || $this->canChangeServicePerson($data['id'])) {


            $sql =  'SELECT c.id, c.products_id, a.date, a.agencies_id, b.discount, b.financial_institutions_id,a.manager_id,a.seller_agents_id,a1.individual_motivation ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
                    'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items AS c ON a.id = c.policies_id ' .
                    'WHERE a.id = ' . intval($data['id']);
            $items = $db->getAll($sql);

            if (is_array($items)) {

                //расчет тарифа
                foreach ($items as $i => $item) {

                    $Products = Products::factory($data, 'KASKO');
                    $commissions = $Products->getCommissions($item['products_id'], $item['date'], $item['agencies_id'], $item['discount'], $item['financial_institutions_id']);
                    //тут доп преобразования комиссии
                    if ($item['manager_id']) //выбрали менеджера що привiв клиента но кроме отдела продаж
                    {
                        if ($item['agencies_id']!=1469 && $item['individual_motivation']==0)
                            $commissions['commission_agent_percent'] = $commissions['commission_agent_percent']/2;
                    }
                    else {
                        $commissions['commission_manager_percent'] = 0;
                    }
                    
                    if (!$item['seller_agents_id']) //не выбрали продающего в агенции
                    {
                        $commissions['commission_seller_agents_percent'] = 0;
                    }
                    

                    $sql =  'UPDATE ' . PREFIX . '_policies_kasko_items SET ' .
                            'commission_agency_percent = ' . $db->quote($commissions['commission_agency_percent']) . ', ' .
                            'commission_agent_percent = ' . $db->quote($commissions['commission_agent_percent']) . ', ' .
                            'director1_commission_percent = ' . $db->quote($commissions['director1_commission_percent']) . ', ' .
                            'director2_commission_percent = ' . $db->quote($commissions['director2_commission_percent']) . ', ' .

                            'commission_manager_percent = ' . $db->quote($commissions['commission_manager_percent']) . ', ' .
                            'commission_seller_agents_percent = ' . $db->quote($commissions['commission_seller_agents_percent']) . '  ' .
        
        
                            'WHERE id = ' . intval($item['id']);
                    $db->query($sql);
                }
            }

            $this->setCommissions($data['id']);

            $Log->add('confirm', 'Предстаника СТО було успішно змінено. Комісійна винагорода перерахована.');
        }

        echo $Log->getText(' ');
        $Log->clear();
        //exit;
    }

    //расчитываем стоимость оказанного страхового покрытия
    function calculateAmountUsed($id, $date = null, $rest = false) {
        global $db;

        $sql='SELECT count(*) FROM '.PREFIX.'_policies_kasko_item_years_payments WHERE policies_id=' . intval($id);
        if (intval($db->getOne($sql))>0) //многолетний
        {
            $begin_date = $db->getOne('SELECT date FROM '.PREFIX.'_policies_kasko_item_years_payments WHERE date<='.($date ? $db->quote($date) : 'NOW()').' AND policies_id=' . intval($id) .' ORDER BY date DESC LIMIT 1');
            $end_date = $db->getOne('SELECT date FROM '.PREFIX.'_policies_kasko_item_years_payments WHERE date>'.($date ? $db->quote($date) : 'NOW()').' AND policies_id=' . intval($id) .' ORDER BY date LIMIT 1');
            $amount_kasko = $db->getOne('SELECT SUM(amount_kasko) FROM '.PREFIX.'_policies_kasko_item_years_payments WHERE date>='. $db->quote($begin_date) .' AND date<'. $db->quote($end_date) .' AND policies_id=' . intval($id) .' ');
            $sql =  'SELECT '.doubleval($amount_kasko).' as amount, DATEDIFF(' . ($date ? $db->quote($date) : 'NOW()') . ', '.$db->quote($begin_date).') AS useddays, DATEDIFF('.$db->quote($end_date).', '.$db->quote($begin_date).')  AS alldays ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id =' . intval($id);
                    $row = $db->getRow($sql);
        }
        else
        {
            $sql =  'SELECT amount, DATEDIFF(' . ($date ? $db->quote($date) : 'NOW()') . ', begin_datetime) AS useddays, DATEDIFF(end_datetime, begin_datetime) + 1 AS alldays ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id =' . intval($id);
            $row = $db->getRow($sql);
        }
        //_dump($row['useddays'] .' '. $row['alldays']);
        if ($rest) //обратная операция сколько осталось денег свободных
            $amountUsed = round($row['amount'] - $row['useddays'] / $row['alldays'] * $row['amount'], 2);
        else
            $amountUsed = round($row['useddays'] / $row['alldays'] * $row['amount'], 2);

        if ($amountUsed < 0) {
            $amountUsed = 0;
        }

        return $amountUsed;
    }
    
    
    //расчитываем инфу по разрыву
    function calculateInterruptData($id, $date = null) {
        global $db;

            //ищем дату с которой покрытие уже не действует т.е. неоплачена запись в календаре
            $end_date = $db->getOne('SELECT min(date) FROM insurance_policy_payments_calendar WHERE statuses_id<3 AND policies_id=' . intval($id) .' ');
            if (!$end_date)//все оплачено
                $end_date = $db->getOne('SELECT DATE_ADD(end_datetime,INTERVAL 1 DAY) FROM ' . PREFIX . '_policies  WHERE id =' . intval($id));
            $sql =  'SELECT DATEDIFF(' . ($date ? $db->quote($date) : 'NOW()') . ', begin_datetime)+1 AS useddays, DATEDIFF('.$db->quote($end_date).', begin_datetime)  AS alldays ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE id =' . intval($id);
            //сумма закрытая по календарю   Пдог
            $amount = $db->getOne('SELECT sum(amount) FROM insurance_policy_payments_calendar WHERE statuses_id=3 AND policies_id=' . intval($id) .' ');        
            $row = $db->getRow($sql);
            $row['amount'] = $amount;

        return $row;
    }

    //возвращаем стоимость оказанного страхового покрытия
    function getAmountUsedInWindow($data) {
        global $db;
        //найти ближайшую дату окончания
        $sql='SELECT count(*) FROM '.PREFIX.'_policies_kasko_item_years_payments WHERE policies_id=' . intval($data['id']);
        /*if (intval($db->getOne($sql))>0) //многолетний
        {
            $end_date = $db->getRow('SELECT date_format(date-1, ' . $db->quote(DATE_FORMAT) . ') AS date, date_format(date-1, \'%Y\') AS date_year, date_format(date-1, \'%m\') AS date_month, date_format(date-1, \'%d\') AS date_day  FROM '.PREFIX.'_policies_kasko_item_years_payments WHERE date>'.($data['date'] ? $db->quote($data['date']) : 'NOW()').' AND policies_id=' . intval($data['id']) .' ORDER BY date LIMIT 1');
        }*/
        
        if (!$end_date) //дату конца берем как дата конца полиса оригинала
        {
            $end_date = $db->getRow('SELECT date_format(end_datetime, ' . $db->quote(DATE_FORMAT) . ') AS date, date_format(end_datetime, \'%Y\') AS date_year, date_format(end_datetime, \'%m\') AS date_month, date_format(end_datetime, \'%d\') AS date_day  FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['id']));
        }
        if ($data['agreement_types_id']==1) //обычная доп угода первый тип
            echo '{"amountUsed":"' . $this->calculateAmountUsed($data['id'], $data['date']) . '","end_datetime":"'.$end_date['date'].'","end_datetime_day":"'.$end_date['date_day'].'","end_datetime_month":"'.$end_date['date_month'].'","end_datetime_year":"'.$end_date['date_year'].'"}';
        else
            echo '{"amountUsed":"0"}';
        exit;
    }
    
    
    //проверка возможности востановления страх суммы
    function checkRestoreSumInWindow($data) {
        global $db;
        
        $options_agregate_no = intval($db->getOne('SELECT options_agregate_no FROM insurance_policies_kasko WHERE policies_id=' . intval($data['id'])));
        if ($options_agregate_no)
        {
            echo '{"responce":"За договором встановлена опцiя - неагрегатна страхова сума, вiдновлення страх. сумми не потрiбне"}';
            exit;
        }
        $id = $data['id'];
        //выплаты по урегулированию дела
        $begin_date = $db->quote($db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($id)));
        $end_date = 'NOW()';
        $sql = 'SELECT SUM(a.amount) FROM insurance_accident_payments a JOIN insurance_accidents b on b.id=a.accidents_id JOIN insurance_accident_payments_calendar c ON a.payments_calendar_id = c.id WHERE b.policies_id = ' . intval($data['id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND ' . $end_date . ' AND c.payment_types_id IN (5,6) AND a.is_return=0';
        $payedAmount = doubleval($db->getOne($sql));
        if ($payedAmount>0)
        {
            echo '{"responce":"ok"}'; 
        }
        else
            echo '{"responce":"За договором не було жодних виплат, вiдновлення страх. сумми не потрiбне"}';
        
        exit;
    }
    

    //расчитываем сумму к возврату
    function calculateamount_return($id,$date = null) {
        global $db;

        $sql =  'SELECT product_types_expense_percent, amount_losses ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE id =' . intval($id);
        $row = $db->getRow($sql);

        $amountRest = $this->calculateAmountUsed($id,null,true);

        $row['product_types_expense_percent']=30;
        
        //выплаты по урегулированию дела
        $begin_date = $db->quote($db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($id)));
        $end_date = $date ? $db->quote($date) : 'NOW()';
        $sql = 'SELECT SUM(a.amount) FROM insurance_accident_payments a JOIN insurance_accidents b on b.id=a.accidents_id JOIN insurance_accident_payments_calendar c ON a.payments_calendar_id = c.id WHERE b.policies_id = ' . intval($data['id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND ' . $end_date . ' AND c.payment_types_id IN (5,6) AND a.is_return=0';
        $payedAmount = doubleval($db->getOne($sql));

        //вычисляем сумму оплаченную
        $payed = Payments::getAmount($id);
        
        $data = $this->calculateInterruptData($id,$data);
        
        $over = $payed - $data['amount'];
        if ($over<0) $over = 0;

        $amount_return = $payed - $data['amount']*$data['useddays']/$data['alldays']- $data['amount']*($data['alldays']-$data['useddays'])/$data['alldays']*0.3 - $payedAmount + $over;
        $amount_return =round($amount_return ,2);

        if ($amount_return < 0) {
            $amount_return = 0;
        }

        return $amount_return;
    }

    //возвращаем сумму к возврату
    function getamount_returnInWindow($data) {
        echo '{"amount_return":"' . $this->calculateamount_return($data['id']) . '"}';
        exit;
    }

    function calculateamount_parent($id) {
        return $this->calculateAmountUsed($id);
    }
    
    function calculateBonusMalus($data)
    {
        global $db;
        
        $shassi = $data['shassi'];
        $insurer_identification_code = $data['insurer_identification_code'];
        $insurer_edrpou = $data['insurer_edrpou'];

        if (strlen($shassi)>1 && (strlen($insurer_identification_code)>=1 || strlen($insurer_edrpou)>=1)) {
            $sql =  'SELECT a.id, DATEDIFF(NOW(),a.date)+60 AS days ' .
                    'FROM ' . PREFIX . '_accidents AS a ' .
                    'JOIN ' . PREFIX . '_accidents_kasko AS b ON a.id = b.accidents_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko AS c ON a.policies_id = c.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items AS d ON b.items_id = d.id ' .
                    'WHERE '.(strlen($insurer_edrpou)>=1 ? ' c.insurer_edrpou= '.$db->quote($insurer_edrpou).' ' : ' c.insurer_identification_code = ' . $db->quote($insurer_identification_code) ) . '  ORDER BY a.id DESC';
            $a = $db->getAll($sql);
            if ($a) 
                $accidents=$a[0];
            else
                $accidents = null;

            $years = 0;
            if (!$accidents) {// не было событий ищем самый ранний полис
                $sql =  'SELECT a.id, DATEDIFF(NOW(),a.begin_datetime)+60 AS days,a.begin_datetime,a.interrupt_datetime ' .
                        'FROM ' . PREFIX . '_policies AS a ' .
                        'JOIN ' . PREFIX . '_policies_kasko AS c ON a.id = c.policies_id ' .
                        'JOIN ' . PREFIX . '_policies_kasko_items AS d ON a.id = d.policies_id ' .
                        'WHERE a.payment_statuses_id > 1 AND c.insurer_identification_code = ' . $db->quote($insurer_identification_code) . ' AND d.shassi = ' . $db->quote($shassi) . ' ' .
                        'ORDER BY a.begin_datetime ';
                $p = $db->getAll($sql); 
                $policies = null;               
                if ($p && is_array($p))
                {
                    foreach($p as $i=>$val) {
                        if (isset($p[$i+1])) //есть следущий от текущего
                        {
                            $diff = strtotime($p[$i+1]['begin_datetime'])-strtotime($val['interrupt_datetime']);
                            if ($diff<0) {if (!$policies) $policies = $val; } //небыло разрыва
                            if ($diff>=0 && $diff<(180*24*60*60)) //разрыв меньше 180 дней
                            {
                                if (!$policies) $policies = $val; 
                            }
                            else {
                                $policies = null;
                            }

                            
                        } 
                        else //нет следущего берем текущую дату
                        {
                            $diff = time()-strtotime($val['interrupt_datetime']);
                            if ($diff<0) {if (!$policies) $policies = $val; break;} //небыло разрыва
                            if ($diff>=0 && $diff<(180*24*60*60)) //разрыв меньше 180 дней
                            {
                                if (!$policies) $policies = $val; 
                            }
                            else {
                                $policies = null;
                            }
                        }
                    }
                }
        
                if ($policies) {
                    $years = (int)($policies['days']/365);
                }
            } else {
                $years=(int)($accidents['days']/365);
            }
        }
        
        $data['max_bonus_malus'] = 1;

        if ($years>=1) $data['max_bonus_malus'] = 0.95;
        if ($years>=2) $data['max_bonus_malus'] = 0.9;
        if ($years>=3) $data['max_bonus_malus'] = 0.85;
        
        if ($data['max_bonus_malus']<0.85) $data['max_bonus_malus'] = 0.85;
        
        //для неагрегатной суммы посчитать сколько убытков было за послдений год
        if ($data['options_agregate_no'] && is_array($a)) {
            $accidents_count = 0;
            foreach($a as $accident) {
                if (($accident['days']-30)<365)
                    $accidents_count++;
            }
            if ($accidents_count>=2) $data['max_bonus_malus'] = 1.25;
            if ($accidents_count==1) $data['max_bonus_malus'] = 1;
        }
        return $data['max_bonus_malus'];            
    }

    function getMarketPrice($id) {
        global $db;
        
        $r = $db->getRow('select market_price_expert,expert_id,expert_date from insurance_policies_kasko_items where policies_id='.intval($id).' AND expert_id>0 AND expert_date>DATE_SUB(NOW(), INTERVAL 60 DAY) ');
        return array('market_price_expert'=>doubleval($r['market_price_expert']),'expert_id'=>$r['expert_id'],'expert_date'=>$r['expert_date']);
    }
    
    //Додаткова угода
    function renewPolicy($data) {
        global $db;

        $this->checkPermissions('renewPolicy', $data);

        $data['checkPermissions'] = 1;
        $this->formDescription['fields'][ $this->getFieldPositionByName('agents_id') ]['display']['update'] = true;
        $this->formDescription['fields'][ $this->getFieldPositionByName('agencies_id') ]['display']['update'] = true;

        $data = $this->load($data, false);
        $data['agreement_types_id'] = intval($_GET['agreement_types_id']) ?  intval($_GET['agreement_types_id']) : 1;
        if ($_SESSION['auth']['roles_id']==ROLES_AGENT && $_SESSION['auth']['agencies_id']==SELLER_AGENCIES_ID &&  $data['agreement_types_id']==2)
            $data['agencies_id']=SELLER_AGENCIES_ID;

        if ($data['financial_institutions_id']==44 &&  $data['agreement_types_id']==2) //меняем профин на альфу
        {
            $data['financial_institutions_id']=2;
        }
        if (is_array($data['items'])) {

            foreach($data['items'] as $i => $item) {

                unset($data['items'][$i]['rate']);
                unset($data['items'][$i]['amount']);

                if (intval($item['products_id'])) {
                    $products[] = $item['products_id'];
                }
            }

            if (is_array($products) && sizeOf($products)) {
                $sql =  'SELECT related_products_id ' .
                        'FROM ' . PREFIX . '_products_related ' .
                        'WHERE products_id IN (' . implode(', ', $products) . ')';
                $allowed_products_id = $db->getCol($sql);
            }

            if (is_array($allowed_products_id) && sizeOf($allowed_products_id)) {
                $data['allowed_products_id'] = implode(',', $allowed_products_id);
            } else {
                $sql =  'SELECT id ' .
                        'FROM ' . PREFIX . '_products ' .
                        'WHERE product_types_id = ' . intval($data['product_types_id']) . ' AND publish=1 AND id NOT IN (SELECT related_products_id FROM '.PREFIX.'_products_related )';
                $allowed_products_id = $db->getCol($sql);

                if (is_array($allowed_products_id) && sizeOf($allowed_products_id)) {
                    $data['allowed_products_id'] = implode(', ', $allowed_products_id);
                }
            }

            $data['bonus_malus'] = 0;

            if (sizeof($data['items']) == 1) {
                $d['shassi'] = $data['items'][0]['shassi'];
                $d['insurer_identification_code'] = $data['insurer_identification_code'];
                $d['insurer_edrpou'] = $data['insurer_edrpou'];
                $d['options_agregate_no'] = $data['items'][0]['options_agregate_no'];
                
                if (strlen($d['shassi'])>1 && (strlen($d['insurer_identification_code'])>=1 || strlen($d['insurer_edrpou'])>=1)) {
                    
                    $p = $this->getMarketPrice($data['id']);
                    $data['items'][0]['market_price'] = $p['market_price_expert'];
                    $data['max_bonus_malus'] = $this->calculateBonusMalus($d);
                    $Products = Products::factory($data, 'KASKO');
                    $malus = $Products->calculateMalus($d);
                    if ($malus >0) $data['max_bonus_malus'] = $malus;
                    if ($data['agreement_types_id']==2 || $data['agreement_types_id']==4) //доп соглашение многолетние
                    {
                        
                        $data['bonus_malus'] = $data['max_bonus_malus'];
                
                        $second_year = $db->getRow('SELECT * FROM insurance_policies_kasko_item_years_payments WHERE policies_id='.intval($data['id']).' ANd date>NOW() ORDER BY date LIMIT 1');
                        if ($second_year)
                        {
                                $data['items'][0]['rate_kasko'] = $second_year['rate_kasko'];
                                $data['items'][0]['car_price']=$second_year['item_price'];
                        }
                        
                        $data['items'][0]['rate_kasko'] = round($data['items'][0]['rate_kasko']*$data['bonus_malus'],3);
                        $data['items'][0]['amount'] =$data['items'][0]['amount_kasko'] = round($data['items'][0]['rate_kasko'] * $data['items'][0]['car_price']/100,2);
                        $data['items'][0]['commission_agent_percent'] = 0;
                        $data['items'][0]['director1_commission_percent'] = 0;
                        $data['items'][0]['director2_commission_percent'] = 0;
                        $data['items'][0]['commission_manager_percent'] = 0;
                        $data['items'][0]['commission_seller_agents_percent'] = 0;
                        $data['items'][0]['commission_agency_percent'] = 0;
                    }
                    if ($data['agreement_types_id']==3) //восстановление СС
                    {
                        $data['express_products_id']=0;
                        $data['max_bonus_malus'] = $data['bonus_malus'] =1;
                        $data['items'][0]['commission_agent_percent'] = 0;
                        $data['items'][0]['director1_commission_percent'] = 0;
                        $data['items'][0]['director2_commission_percent'] = 0;
                        $data['items'][0]['commission_manager_percent'] = 0;
                        $data['items'][0]['commission_seller_agents_percent'] = 0;
                        $data['items'][0]['commission_agency_percent'] = 0;
                        //проверяем на многолетний
                        $r = $db->getRow('SELECT a.*,b.agreement_types_id,IF(YEAR(a.date)>YEAR(b.begin_datetime),1,0) as next_year FROM insurance_policies_kasko_item_years_payments a JOIN  insurance_policies b on b.id=a.policies_id WHERE a.policies_id='. intval($data['id']).' AND a.date<NOW() ORDER BY a.date DESC LIMIT 1'); 
                        $fifty_fifty = intval($db->getOne('SELECT options_fifty_fifty FROM insurance_policies_kasko WHERE policies_id= '.intval($data['id'])));
                        $options_agregate_no = intval($db->getOne('SELECT options_agregate_no FROM insurance_policies_kasko WHERE policies_id= '.intval($data['id'])));
                        if (intval($r['next_year'])==0)  {//однолетний договор в insurance_policies_kasko_item_years_payments нет записей
                            $sql =  'SELECT DATEDIFF(NOW(), begin_datetime)  AS useddays FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['id']);
                            $useddays = intval($db->getOne($sql));
                            $restdays = 365 - $useddays;
                            //выплаты по урегулированию дела
                            $begin_date = $db->quote($db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['id'])));
                            $end_date = 'NOW()';

                            if ($options_agregate_no) {
                                $payedAmount = 0;
                            } else {
                                $sql = 'SELECT SUM(c.amount) FROM insurance_accidents b   JOIN insurance_accident_payments_calendar c ON b.id = c.accidents_id WHERE c.payment_statuses_id>1 AND b.policies_id = ' . intval($data['id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND ' . $end_date . ' AND c.payment_types_id IN (5,6)   ';
                                $payedAmount = doubleval($db->getOne($sql));
                            }

                            if ($r['agreement_types_id']==3) //делаем доп угоду на востановление из другой доп угоды значит тариф взять из парента
                            {
                                $data['items'][0]['rate_kasko'] = doubleval($db->getOne('SELECT rate_kasko FROM  insurance_policies_kasko_items WHERE policies_id='.intval($data['parent_id'])));
                            }
                            if ($fifty_fifty && $payedAmount>0) $data['items'][0]['rate_kasko']*=2;
                            $restoreAmount = round($data['items'][0]['rate_kasko']*doubleval($payedAmount)/100*(365 - $useddays)/365,2);
                            $data['items'][0]['rate_kasko'] = round($restoreAmount/$data['items'][0]['car_price']*100,3);
                            $data['items'][0]['amount'] = $data['items'][0]['amount_kasko'] = round($data['items'][0]['rate_kasko'] * $data['items'][0]['car_price']/100,2);
                        }
                        else { //начался следущий год по договору
                            $data['items'][0]['rate_kasko'] = $r['rate_kasko'];
                            $data['items'][0]['car_price'] = $r['item_price'];
                            if ($fifty_fifty) $data['items'][0]['rate_kasko']*=2;
                            $sql =  'SELECT DATEDIFF(NOW(), '.$db->quote($r['date']).')  AS useddays FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['id']);
                            $useddays = intval($db->getOne($sql));
                            $restdays = 365 - $useddays;
                            //выплаты по урегулированию дела
                            $begin_date = $r['date'];
                            $end_date = 'NOW()';

                            if ($options_agregate_no) {
                                $payedAmount = 0;
                            } else {
                                $sql = 'SELECT SUM(c.amount) FROM  insurance_accidents b JOIN insurance_accident_payments_calendar c ON b.id = c.accidents_id WHERE c.payment_statuses_id>1 AND b.policies_id = ' . intval($data['id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND ' . $end_date . ' AND c.payment_types_id IN (5,6)  ';
                                $payedAmount = doubleval($db->getOne($sql));
                            }
                            $restoreAmount = round($data['items'][0]['rate_kasko']*doubleval($payedAmount)/100*(365 - $useddays)/365,2);
                            $data['items'][0]['rate_kasko'] = round($restoreAmount/$data['items'][0]['car_price']*100,3);
                            $data['items'][0]['amount'] = $data['items'][0]['amount_kasko'] = round($data['items'][0]['rate_kasko'] * $data['items'][0]['car_price']/100,2);
                        
                        }
                        
                    }
                }
            }
        }

        //необходимо удалить ID, иначе тянет к новому полису
        if (is_array($data['items'])) {
            foreach ($data['items'] as $i => $item) {
                unset($data['items'][ $i ]['id']);
            }
        }

        $data['parent_id']          = $data['id'];
        $data['amount_parent']      = $this->calculateAmountUsed($data['id']);
        unset($data['id']);
        unset($data['documents']);
        unset($data['items'][0]['market_price_expert']);
        $data['expert_period']=0;
        $data['solutions_id']=0;
        
        if ($data['agreement_types_id'] == 2 || $data['agreement_types_id'] == 3 ||  $data['agreement_types_id'] == 4) $data['types_id'] = 2;
        
        $data['certificate']='';
        $data['terms_years_id']=1;
        
        $data['begin_datetime_parent_day']  = $data['begin_datetime_day'];
        $data['begin_datetime_parent_month']    = $data['begin_datetime_month'];
        $data['begin_datetime_parent_year'] = $data['begin_datetime_year'];

        $data['begin_datetime'] = $data['date']     = date('d.m.Y');
        $data['begin_datetime_day'] = $data['date_day']  = date('d');
        $data['begin_datetime_month'] = $data['date_month'] = date('m');
        $data['begin_datetime_year']= $data['date_year'] = date('Y');
        
        if (($data['agreement_types_id'] == 2 || $data['agreement_types_id'] == 4) && $second_year) {
            $t = strtotime ( $second_year['date'] );
            $data['begin_datetime']     = date('d.m.Y',$t);
            $data['begin_datetime_day']   = date('d',$t);
            $data['begin_datetime_month']   = date('m',$t);
            $data['begin_datetime_year']  = date('Y',$t);
        }
        
        
        $data['policy_statuses_id']     =POLICY_STATUSES_CREATED;
        $data['next_policy_statuses_id'] = POLICY_STATUSES_RENEW;
        $this->permissions['insert'] = true;
        if ($data['financial_institutions_id']==19 && $data['agreement_types_id']==2) { //укргаз допка
                $sql='SELECT 
                     date_format(DATE_ADD(insurance_policies.begin_datetime,INTERVAL 1 YEAR), \'%d.%m.%Y\') AS begin_datetime_format, 
                     date_format(DATE_ADD(insurance_policies.begin_datetime,INTERVAL 1 YEAR), \'%Y\') AS begin_datetime_year, 
                     date_format(DATE_ADD(insurance_policies.begin_datetime,INTERVAL 1 YEAR), \'%m\') AS begin_datetime_month, 
                     date_format(DATE_ADD(insurance_policies.begin_datetime,INTERVAL 1 YEAR), \'%d\') AS begin_datetime_day, 
                             
                     date_format(DATE_ADD(insurance_policies.end_datetime,INTERVAL 1 YEAR), \'%d.%m.%Y\') AS end_datetime_format, 
                     date_format(DATE_ADD(insurance_policies.end_datetime,INTERVAL 1 YEAR), \'%Y\') AS end_datetime_year, 
                     date_format(DATE_ADD(insurance_policies.end_datetime,INTERVAL 1 YEAR), \'%m\') AS end_datetime_month,
                     date_format(DATE_ADD(insurance_policies.end_datetime,INTERVAL 1 YEAR), \'%d\') AS end_datetime_day 
                             
                     FROM insurance_policies WHERE insurance_policies.id='.intval($data['parent_id']);
                    $r = $db->getRow($sql) ;
                    $data = array_merge($data, $r);
        }
        $data['certificate'] ='';
        $data['card_assistance'] ='';
       $this->add($data);
    }

    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Log, $Authorization, $POLICY_STATUSES_SCHEMA;

        if($Authorization->data['permissions']['Policies_KASKO']['deleteAdditionalPolicies'])
        {
            $this->permissions['delete'] = true;
            $Authorization->data['permissions']['PolicyMessages']['delete'] = true;
            $Authorization->data['permissions']['PolicyDocuments']['delete'] = true;
        }

        if ($Authorization->data['permissions']['Policies_KASKO']['superupdate']) {
            $data['checkPermissions'] = 1;
        }

        return parent::checkPermissions($action, $data, $redirect);
    }   
    
    //пролонгация полиса
    function continuePolicy($data) {

        $this->checkPermissions('continuePolicy', $data);

        $data['checkPermissions'] = 1;
        $data = $this->load($data, false);

        $data['types_id'] = POLICY_TYPES_AGREEMENT;
        $data['parent_id'] = $data['id'];
        unset($data['allowed_products_id']);
        unset($data['id']);

        //необходимо удалить ID, иначе тянет к новому полису
        if (is_array($data['items'])) {
            foreach ($data['items'] as $i => $item) {
                unset($data['items'][ $i ]['id']);
            }
        }

        //переопределить даты, чтобы срок был такой же
        unset($data['number']);
        unset($data['date_format']);
        unset($data['date_day']);
        unset($data['date_month']);
        unset($data['date_year']);

        $timestamp = (mktime(0, 0, 0, $data['end_datetime_month'], $data['end_datetime_day'] + 1, $data['end_datetime_year']) > mktime())
            ? mktime(0, 0, 0, $data['end_datetime_month'], $data['end_datetime_day'] + 1, $data['end_datetime_year'])
            : mktime();

        $data['begin_datetime']     = date('d.m.Y', $timestamp);
        $data['begin_datetime_day'] = date('d', $timestamp);
        $data['begin_datetime_month']   = date('m', $timestamp);
        $data['begin_datetime_year']    = date('Y', $timestamp);

        unset($data['end_datetime_day']);
        unset($data['end_datetime_month']);
        unset($data['end_datetime_year']);
        unset($data['end_datetimeFormat']);

        $data['policy_statuses_id']     = POLICY_STATUSES_CREATED;
        $data['next_policy_statuses_id']    = POLICY_STATUSES_CONTINUED;

        $this->setPolicyStatusesSchema(null, &$data);
        $this->add($data);
    }

    //анулирование полиса
    function cancelPolicy1($data) {
        global $db, $Log;

        $this->checkPermissions('cancelPolicy', $data);
        if($data['cancelDate']) {
            $d = strtotime ( $data['cancelDate'] );
            $d = $db->quote(date('Y-m-d',$d ));
        }   
        else
            $d =' NOW() ';
        //фиксируем сумму возврата
        $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                'amount_return = ' . $db->quote($this->calculateamount_return($data['id'])) . ', ' .
                'interrupt_datetime = '.$d.', ' .
                'policy_statuses_id = ' . POLICY_STATUSES_DISSOLVED . ', ' .
                'modified = NOW() ' .
                'WHERE id = ' . intval($data['id']);
        $db->query($sql);

        $data['policies_id']            = $data['id'];
        $data['policy_statuses_id'] = POLICY_STATUSES_DISSOLVED;
        
        $PolicyDocuments = new PolicyDocuments($data);
        $PolicyDocuments->generate($data['id'], 101);

        $PolicyMessages = new PolicyMessages($data);
        $PolicyMessages->insert($data, false);

        $Log->add('confirm', 'Поліс було успішно анульовано.');

        header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
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
            
            $PolicyDocuments = new PolicyDocuments($data);
            $PolicyDocuments->generate($data['id'], 101);

            $Log->add('confirm', 'Дiю полiсу було успішно припинено.');

            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
            exit;
        }
        $data['id']=$id;
        $this->showForm($data, 'insert', null, 'goCancel.php') ;


    }

    function getApplicantValuesInWindow($data) {
        global $db;

//      $this->checkPermissions('view', $data);

        $conditions = array(PREFIX . '_policies_kasko_items.id = ' . intval($data['id']));

        $sql =  'SELECT *, date_format(insurer_driver_licence_date, ' . $db->quote(DATE_FORMAT) . ') AS insurer_driver_licence_date, date_format(insurer_driver_licence_date, \'%Y\') AS insurer_driver_licence_date_year, date_format(insurer_driver_licence_date, \'%m\') AS insurer_driver_licence_date_month, date_format(insurer_driver_licence_date, \'%d\') AS insurer_driver_licence_date_day ' .
                'FROM ' . PREFIX . '_policies_kasko_items ' .
                'JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_policies_kasko_items.policies_id = ' . PREFIX . '_policies_kasko.policies_id ' .
                'WHERE ' . implode(' AND ', $conditions);
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
                            //'"phone":"' . $row[ $data['person'] . '_phone'] . '",' .
                            '"driver_licence_series":"' . $row[ $data['person'] . '_driver_licence_series'] . '",' .
                            '"driver_licence_number":"' . $row[ $data['person'] . '_driver_licence_number'] . '",' .
                            '"driver_licence_date":"' . $row[ $data['person'] . '_driver_licence_date'] . '",' .
                            '"driver_licence_date_year":"' . $row[ $data['person'] . '_driver_licence_date_year'] . '",' .
                            '"driver_licence_date_month":"' . $row[ $data['person'] . '_driverLicence_date_month'] . '",' .
                            '"driver_licence_date_day":"' . $row[ $data['person'] . '_driver_licence_date_day'] . '"}';
                break;
        }

        echo $result;
        exit;
    }


    //установка наличия оригиналов документов по штрих коду
    function updateDocuments($data) {
        global $db, $Log;

       if ($_SERVER['REQUEST_METHOD'] == 'POST' && $data['barcode']) {

            $params = array();
            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_policy_documents ' .
                    'WHERE file = 1 AND template = ' . $db->quote($data['barcode'] . '.html');
            $row = $db->getRow($sql);

            if (!$row) {
                $Log->add('error', 'Вказаний документ не знайдено.', $params);
            } else {
                $sql =  'UPDATE ' . PREFIX . '_policy_documents SET ' .
                        'documents = 1 ' .
                        'WHERE id = ' . intval($row['id']);
                $db->query($sql);

                $Log->add('confirm', 'Документ ' . $data['barcode'] . ' зареєстровано.', $params);

                $sql =  'SELECT count(id) ' .
                        'FROM ' . PREFIX . '_policy_documents ' .
                        'WHERE policies_id = ' . intval($row['policies_id']) . ' AND file = 1 AND documents = 0';
                if (intval($db->getOne($sql))==0) {

                    $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                            'documents = 1 ' .
                            'WHERE id = ' . intval($row['policies_id']);
                    $db->query($sql);
                }
            }

            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateDocuments&product_types_id=' .$data['product_types_id']);
        }

        include_once $this->object . '/documents.php';
    }

     
    
    function isRenew($data)
    {
        return false;
        if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW && $this->mode == 'update') return true;
        else return false;
    }
    
    function getRenew($data)
    {
        if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW && $this->mode == 'update') return 'readonly';
        else return '';
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
    
    function setCarParamsInWindow($data) {
        global $db;
        
               
        if (intval($data['transmissions_id'])==0 || intval($data['car_engine_type_id'])==0 || intval($data['car_body_id'])==0 || doubleval($data['market_price'])==0)
        {
            echo    'Помилка. Необхiдно заповнити всi поля по авто';
            exit;
        }

        $car_price = doubleval($db->getOne('select car_price from insurance_policies_kasko_items WHERE id = '.$data['item_id']));
        $policies_id= intval($db->getOne('select policies_id from insurance_policies_kasko_items WHERE id = '.$data['item_id']));
        $parent_id= intval($db->getOne('select parent_id from insurance_policies WHERE id = '.intval($policies_id)));
        $policy_statuses_id = intval($db->getOne('select policy_statuses_id from insurance_policies WHERE id = '.intval($policies_id)));
         
        
        $sql = 'UPDATE insurance_policies_kasko_items ' .
               'SET transmissions_id = '.intval($data['transmissions_id']) .',car_engine_type_id='.intval($data['car_engine_type_id']) .',car_body_id='.intval($data['car_body_id']).',market_price_expert='.doubleval($data['market_price']).',expert_date=NOW(),expert_id= '.$_SESSION['auth']['id'].' '.
               'WHERE id = '.$data['item_id'];
        $db->query($sql);
        if ($policy_statuses_id<10) //створений
        {
            $sql = 'UPDATE insurance_policies_kasko_items ' .
                   'SET market_price='.doubleval($data['market_price']).',expert_date=NOW(),expert_id= '.$_SESSION['auth']['id'].' '.
                   'WHERE id = '.$data['item_id'];
            $db->query($sql);
        }
        
        if ($policies_id) {
            $financial_institutions_id= intval($db->getOne('select financial_institutions_id from insurance_policies_kasko  WHERE policies_id = '.intval($policies_id)));
            if ($financial_institutions_id==59 || $financial_institutions_id==55 || $financial_institutions_id==33 || $financial_institutions_id == 62) {//дельта формируем, кредо*2, астра -  статус --- Лист повiдомлення Сформовано
                $sql= 'UPDATE insurance_tasks SET task_statuses_id=50 WHERE policies_id IN ('.$policies_id.','.$parent_id.') AND task_types_id = 4 AND task_statuses_id=38 ';
                $db->query($sql);
            }
        }
        echo    'Данi збережено';
    }
    
    
    
    
    function makeritaleInWindow($data) {
        global $db,$Authorization;
        if ($Authorization->data['permissions']['Policies_KASKO']['superupdate'] || $Authorization->data['roles_id']==ROLES_ADMINISTRATOR) {
            $number = $db->getOne('select number from insurance_policies where id='.intval($data['id']));
            if ($number) {

                $allowed_products_id='\'110\'';
                if ($data['ptype']==1) {
                    $allowed_products_id='\'110\'';
                    $number = '208' . substr($number, 3);
                }

                if ($data['ptype']==2) {
                    $allowed_products_id='\'140\'';
                    $number = '209' . substr($number, 3);
                }

                if ($data['ptype']==3) {
                    $allowed_products_id='\'684\'';
                    $number = '220' . substr($number, 3);
                }

                $sql='
                        update insurance_policies a
                        join  insurance_policies_kasko b on b.policies_id=a.id
                        set 
                        a.number=\''.$number.'\',
                        financial_institutions_id = 0,
                        allowed_products_id='.$allowed_products_id.'
                        where a.policy_statuses_id=1 AND a.id='.intval($data['id']);
                        $db->query($sql);
                        echo '{"text":"Готово"}';   
                        exit;
            }
            
        }
        echo '{"text":"Ошибка"}';   
        exit;
    }
    
    
    function loadBankProductsInWindow($data) {
        global $db;

        if (!$data['agent_field'])  $data['agent_field'] = 'agents_id';
        
        $sql = '
        SELECT a.id,a.title FROM  insurance_products a JOIN  insurance_products_kasko b on b.products_id=a.id JOIN insurance_product_financial_institution_assignments c ON c.products_id=a.id AND financial_institutions_id='.intval($data['financial_institutions_id']).' WHERE a.publish=1 ';
        
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
        $sql = 'update insurance_policies_kasko set allowed_products_id='.$db->quote($data['allowed_product_id']).' where  policies_id = '.$data['id'];
        $db->query($sql);       
        echo 'Готово';
        exit;       
    }

    function checkCertificateTenPercentInWindow($data) {
        global $db;

        $response = array();
        $sqlQuery = "SELECT * FROM insurance_policies_kasko WHERE policies_id <> " . intval($data["policies_id"]) . " AND certificateTenPercent = " . $db->quote($data['certificateTenPercent']);
        $checkPolicies = $db->getAll($sqlQuery);
        if (is_array($checkPolicies) && count($checkPolicies)) {
            $response["check"] = false;
        } else {
            $response["check"] = true;
        }
        echo json_encode($response);
        exit;
    }
    
}

?>