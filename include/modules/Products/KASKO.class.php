<?
/*
 * Title: KASKO class
 *
 * @author 
 * @email 
 * @version 3.0
 */

require_once 'Currencies.class.php';
require_once 'ParametersBaseRates.class.php';
require_once 'ParametersSpecialCars.class.php';

class Products_KASKO extends Products {

    var $object = 'Products';

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'                  => 'id',
                            'type'                  => fldIdentity,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'product_types_id',
                            'description'           => 'Тип',
                            'type'                  => fldHidden,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'code',
                            'description'           => 'Код',
                            'type'                  => fldText,
                            'maxlength'             => 20,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 1,
                            'width'                 => 100,
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'title',
                            'description'           => 'Назва',
                            'type'                  => fldText,
                            'maxlength'             => 300,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 2,
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'insurance_companies_id',
                            'description'           => 'Страхова компанiя',
                            'type'                  => fldRadio,
                            'withoutTable'          => true,
                            'list'                  => array(
                                                        INSURANCE_COMPANIES_EXPRESS => 'ТДВ "Eкспрес Страхування"',
                                                        INSURANCE_COMPANIES_GENERALI => 'ВАТ «УСК «Гарант-Авто»'),
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'priority_payments_car_service_value',
                            'description'           => 'Пріоритет виплати, СТО',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'priority_payments_examination_value',
                            'description'           => 'Пріоритет виплати, Експертиза',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'residences_garage_value',
                            'description'           => 'Місце зберігання ТЗ, стоянка що охороняється',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'residences_any_place_value',
                            'description'           => 'Місце зберігання ТЗ, будь-яке місце',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        
                        array(
                            'name'                  => 'options_deductible_glass_no_value',
                            'description'           => 'без франшизи на вітрові стекла',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'options_alarm_yes_value',
                            'description'           => 'є протиугінний пристрій',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'options_alarm_no_value',
                            'description'           => 'не встановлено протиугінний пристрій',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        
                        array(
                            'name'                  => 'options_taxy_value',
                            'description'           => 'страхування таксі',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'options_fifty_fifty_value',
                            'description'           => 'опція "50/50"',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'options_agregate_no_value',
                            'description'           => 'неагрегатна страхова сума',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'rate_equipment',
                            'description'           => 'Додаткове обладнання, тариф, %',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'price_accident',
                            'description'           => 'НС, страхова сума, грн.',
                            'type'                  => fldMoney,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'rate_accident',
                            'description'           => 'НС, тариф, %',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'maxlength'              =>'7',
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'min_rate',
                            'description'           => 'Мiнiмальний тариф, %',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'maxlength'              =>'7',
                            'table'                 => 'products_kasko'),   
                        array(
                            'name'                  => 'option_accident',
                            'description'           => 'Обов\'язкове стахування НС',
                            'type'                  => fldBoolean,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'options_agregate_no',
                            'description'           => 'Обов\'язкова неагрегатна страхова сумма',
                            'type'                  => fldBoolean,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'bill_bank_account',
                            'description'           => 'Р/р банку для рахунку',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'bill_bank_mfo',
                            'description'           => 'МФО банку для рахунку',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'special',
                            'description'           => 'Спеціальні умови',
                            'type'                  => fldRadio,
                            'list'                  => array(
                                                        1 => 'вiдсутнi',
                                                        2 => 'страхування тест драйву',
                                                        3 => 'страхування перегону'),
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'max_discount',
                            'description'           => 'Розмір максимальної знижки, %',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                            array(
                                'canBeEmpty'        => false
                            ),
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'cart_discount',
                            'description'           => 'Знижка за карткою CarMan@CarWoman, %',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'bank_discount_value',
                            'description'           => 'Знижка для банкiв',
                            'type'                  => fldPercent,
                            'maxlength'             => 7,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'bank_commission_value',
                            'description'           => 'Компенсацiя банка',
                            'type'                  => fldPercent,
                            'maxlength'             => 7,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'bank_discount1_value',
                            'description'           => 'Знижка для банкiв 2',
                            'type'                  => fldPercent,
                            'maxlength'             => 7,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'bank_commission1_value',
                            'description'           => 'Компенсацiя банка 2',
                            'type'                  => fldPercent,
                            'maxlength'             => 7,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                            
                        array(
                            'name'                  => 'agent_commission_value',
                            'description'           => 'Комiсiя агента ≤ 800 000 ',
                            'type'                  => fldPercent,
                            'maxlength'             => 7,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),   
                        array(
                            'name'                  => 'agent_commission_value2',
                            'description'           => 'Комiсiя агента ≥ 800 001 ',
                            'type'                  => fldPercent,
                            'maxlength'             => 7,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),   
                        array(
                            'name'                  => 'bank_discount_value1',
                            'description'           => 'Знижка для банкiв (3 рiк)',
                            'type'                  => fldPercent,
                            'maxlength'             => 7,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'bank_commission_value1',
                            'description'           => 'Компенсацiя банка (3 рiк)',
                            'type'                  => fldPercent,
                            'maxlength'             => 7,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'bank_discount_value2',
                            'description'           => 'Знижка для банкiв (4 рiк)',
                            'type'                  => fldPercent,
                            'maxlength'             => 7,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'bank_commission_value2',
                            'description'           => 'Компенсацiя банка (4 рiк)',
                            'type'                  => fldPercent,
                            'maxlength'             => 7,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'bank_rko_insurance_amount',
                            'description'           => 'РКО (% от страховой премии)',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),   
                        array(
                            'name'                  => 'bank_rko_credit_amount',
                            'description'           => 'РКО (% от суммы кредита )',
                            'type'                  => fldPercent,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_kasko'),   
                        array(
                            'name'                  => 'description',
                            'description'           => 'Опис',
                            'type'                  => fldNote,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true,
                                    'change'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'financial_institutions_id',
                            'description'           => 'Банки',
                            'type'                  => fldMultipleSelect,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true,
                                    'change'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'product_financial_institution_assignments',
                            'sourceTable'           => 'financial_institutions',
                            'selectField'           => 'title',
                            'orderField'            => 'title'),
                        array(
                            'name'                  => 'agencies_id',
                            'description'           => 'Агенції',
                            'type'                  => fldMultipleSelect,
                            'structure'             => 'tree',
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true,
                                    'change'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'product_agency_assignments',
                            'sourceTable'           => 'agencies',
                            'selectField'           => 'CONCAT(code, \'-\', title)',
                            'orderField'            => 'CAST(code AS UNSIGNED), title'),
                        array(
                            'name'                  => 'car_brands_id',
                            'description'           => 'Марки',
                            'type'                  => fldMultipleSelect,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true,
                                    'change'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'product_car_brand_assignments',
                            'sourceTable'           => 'car_brands',
                            'selectField'           => 'title',
                            'orderField'            => 'title'),
                        array(
                            'name'                  => 'related_products_id',
                            'description'           => 'Продукти наступного періоду',
                            'type'                  => fldMultipleSelect,
                            'condition'             => 'product_types_id = 3',//ограничиваем продуктовым рядом каско
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true,
                                    'change'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products_related',
                            'sourceTable'           => 'products',
                            'selectField'           => 'title',
                            'orderField'            => 'title'),
                        array(
                            'name'                  => 'synhronize',
                            'description'           => 'Синхронiзувати',
                            'type'                  => fldBoolean,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'change'        => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 7,
                            'width'                 => 70,
                            'table'                 => 'products'),
                         array(
                            'name'                  => 'retail',
                            'description'           => 'Ритейл',
                            'type'                  => fldBoolean,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'change'        => false,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 8,
                            'width'                 => 70,
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'second_year',
                            'description'           => 'Стороннiй клієнт',
                            'type'                  => fldBoolean,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'change'        => false,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 9,
                            'width'                 => 70,
                            'table'                 => 'products_kasko'),
                        array(
                            'name'                  => 'publish',
                            'description'           => 'Показувати',
                            'type'                  => fldBoolean,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'change'        => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 10,
                            'width'                 => 100,
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'created',
                            'description'           => 'Створено',
                            'type'                  => fldDate,
                            'value'                 => 'NOW()',
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => true,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 11,
                            'width'                 => 100,
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'modified',
                            'description'           => 'Редаговано',
                            'type'                  => fldDate,
                            'value'                 => 'NOW()',
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => true,
                                        'update'    => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 12,
                            'width'                 => 100,
                            'table'                 => 'products')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'      => 1,
                        'defaultOrderDirection'     => 'asc',
                        'titleField'                => 'title'
                    )
            );

    function Products_KASKO($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Страхові продукти';
        $this->messages['single'] = 'Страховий продукт';
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        global $db;

        $data['car_types'] = $db->getAssoc('SELECT id, title FROM ' . PREFIX . '_car_types WHERE product_types_id = ' . intval($data['product_types_id']));
        $data['car_brands'] = $db->getAssoc('SELECT id, title FROM ' . PREFIX . '_car_brands ORDER BY title');

        return parent::showForm($data, $action, $actionType, 'kasko.php');
    }

    function replaceSpecialChars($data, $action) {

        switch ($action) {
            case 'insert':
            case 'update':
                if (is_array($data['deductibles'])) {
                    foreach ($data['deductibles'] as $i => $value) {
                        $data['deductibles'][ $i ]['value0']    = str_replace(',', '.', $data['deductibles'][ $i ]['value0']);
                        $data['deductibles'][ $i ]['value1']    = str_replace(',', '.', $data['deductibles'][ $i ]['value1']);
                        $data['deductibles'][ $i ]['value']     = str_replace(',', '.', $data['deductibles'][ $i ]['value']);
                    }
                }

                if (is_array($data['price_ranges'])) {
                    foreach ($data['price_ranges'] as $id => $value) {
                        $data['price_ranges'][ $id ] = str_replace(',', '.', $data['price_ranges'][ $id ]);
                    }
                }

                if (is_array($data['driver_standings'])) {
                    foreach ($data['driver_standings'] as $id => $value) {
                        $data['driver_standings'][ $id ] = str_replace(',', '.', $data['driver_standings'][ $id ]);
                    }
                }

                if (is_array($data['driver_ages'])) {
                    foreach ($data['driver_ages'] as $id => $value) {
                        $data['driver_ages'][ $id ] = str_replace(',', '.', $data['driver_ages'][ $id ]);
                    }
                }

                if (is_array($data['drivers'])) {
                    foreach ($data['drivers'] as $id => $value) {
                        $data['drivers'][ $id ] = str_replace(',', '.', $data['drivers'][ $id ]);
                    }
                }

                if (is_array($data['engine_sizes'])) {
                    foreach ($data['engine_sizes'] as $id => $value) {
                        $data['engine_sizes'][ $id ] = str_replace(',', '.', $data['engine_sizes'][ $id ]);
                    }
                }

                break;
        }

        return $data;
    }

    function checkFields($data, $action) {
        global $Log;

        if (!$data['option_accident']) {
            $this->formDescription['fields'] [ $this->getFieldPositionByName('price_accident') ]['verification']['canBeEmpty'] = true;
            $this->formDescription['fields'] [ $this->getFieldPositionByName('rate_accident') ]['verification']['canBeEmpty'] = true;
        }

        parent::checkFields($data, $action);

        if ($data['price_accident'] > 0 || $data['rate_accident'] > 0) {
            /*if (floatval($data['price_accident']) == 0) {
                $Log->add('error', 'НС, страхова сумма не може дорівнювати 0.');
            }*/
            if (floatval($data['rate_accident']) == 0) {
                $Log->add('error', 'НС, страховий тариф не може дорівнювати 0.');
            }
        }

        if (is_array($data['car_types'])) {
            foreach ($data['car_types'] as $id => $value) {

                $params = array(translate($data['car_typesTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['deductibles'])) {
            foreach ($data['deductibles'] as $i => $value) {
                $params = array(translate($data['deductiblesTitle'][ $i ]), $languageDescription);
                if ($data['deductibles'][ $i ]['value0'] == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif ($data['deductibles'][ $i ]['absolute0'] == 0 && !$this->isValidPercent($data['deductibles'][ $i ]['value0']) ||
                          $data['deductibles'][ $i ]['absolute0'] == 1 && !$this->isValidMoney($data['deductibles'][ $i ]['value0'])) {
                                $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }

                if ($data['deductibles'][ $i ]['value1'] == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif ($data['deductibles'][ $i ]['absolute1'] == 0 && !$this->isValidPercent($data['deductibles'][ $i ]['value1']) ||
                          $data['deductibles'][ $i ]['absolute1'] == 1 && !$this->isValidMoney($data['deductibles'][ $i ]['value1'])) {
                                $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }

                if ($data['deductibles'][ $i ]['value_other'] == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidMoney($data['deductibles'][ $i ]['value_other'])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
                if ($data['deductibles'][ $i ]['value_hijacking'] == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidMoney($data['deductibles'][ $i ]['value_hijacking'])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

       

        if (is_array($data['driver_standings'])) {
            foreach ($data['driver_standings'] as $id => $value) {

                $params = array(translate($data['driver_standingsTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['driver_ages'])) {
            foreach ($data['driver_ages'] as $id => $value) {

                $params = array(translate($data['driver_ages_title'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['drivers'])) {
            foreach ($data['drivers'] as $id => $value) {

                $params = array(translate($data['driversTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        

        if (is_array($data['regions'])) {
            foreach ($data['regions'] as $id => $value) {

                $params = array(translate($data['regionsTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }
    }

    function synhronize(&$data) {
        global $db, $Log;

        if (E_IX_SYNHRONIZATION != 1) return;

        $Client = new SoapClient(E_IX_URL . 'synchronization/express/index.php?wsdl');
        $type = 'products';
        //перезагрузить франшизы

        $data['deductibles'] = array();
        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_product_deductibles ' .
                'WHERE products_id = ' . intval($data['products_id']);
        $res = $db->query($sql);

        if ($res->numRows()) {
            while ($res->fetchInto($row)) {
                $data['deductibles'][ $row['id'] ] = array(
                                                'car_types_id'      => $row['car_types_id'],
                                                'value0'            => $row['value0'],
                                                'absolute0'         => $row['absolute0'],
                                                'value1'            => $row['value1'],
                                                'absolute1'         => $row['absolute1'],
                                                'value_other'       => $row['value_other'],
                                                'value_hijacking'   => $row['value_hijacking'],
                                                'value'             => $row['value']);
            }
        }

        $result = $Client->synhronize(
                    array(
                        'type'  => $type,
                        'data'      => serialize($data)));
    }
    
    function insert($data, $redirect=true) {
        global $Log;

        $data = $this->replaceSpecialChars($data, 'insert');

        $data['products_id'] = parent::insert($data, false);

        if (!$Log->isPresent() && intval($data['products_id'])) {

            $params['title']        = $this->messages['single'];
            $params['id']           = $data['products_id'];
            $params['storage']      = $this->tables[0];

            ParametersBaseRates::setValues($data);
            ParametersSpecialCars::setValues($data);
            ParametersDeductibles::setValues($data);
            ParametersDriverStandings::setValues($data);
            ParametersDriverAges::setValues($data);
            ParametersCarPrices::setValues($data);
            ParametersDrivers::setValues($data);
            ParametersEngineSizes::setValues($data);
            ParametersRegions::setValues($data);
            ParametersPaymentBreakdowns::setValues($data);
            ParametersCarNumbers::setValues($data);
            ParametersCarYears::setValues($data);
            ParametersTerms::setValues($data);
            ParametersZones::setValues($data);
            //ParametersMileageCar::setValues($data);

            if ($data['synhronize'])
                $this->synhronize($data);
                
            if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                //header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Products|updateCommissions&product_types_id=' . $data['product_types_id'] . '&copyprod='.$data['copyprod'].'&products_id=' . $data['products_id']);
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $params['id'];
            }
        }
    }

    function view($data) {
        if ($data['products_id'])
            $data['id'] = $data['products_id'];

            
        $row = parent::view($data);

    }

    function update($data, $redirect=true) {
        global $Log;

        $data = $this->replaceSpecialChars($data, 'update');

        $data['products_id'] = parent::update($data, false);

        if (!$Log->isPresent() && $data['products_id']) {

            $params['title']        = $this->messages['single'];
            $params['id']            = $data['products_id'];
            $params['storage']        = $this->tables[0];

            ParametersBaseRates::setValues($data);
            ParametersSpecialCars::setValues($data);
            ParametersDeductibles::setValues($data);
            ParametersPriceRanges::setValues($data);
            ParametersDriverStandings::setValues($data);
            ParametersDriverAges::setValues($data);
            ParametersCarPrices::setValues($data);
            ParametersDrivers::setValues($data);
            ParametersRegions::setValues($data);
            ParametersPaymentBreakdowns::setValues($data);
            ParametersCarNumbers::setValues($data);
            ParametersCarYears::setValues($data);
            ParametersTerms::setValues($data);
            ParametersZones::setValues($data);
            //ParametersMileageCar::setValues($data);
            
            if ($data['synhronize'])
                $this->synhronize($data);
                
            if ($redirect) {
                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                //header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Products|updateCommissions&product_types_id=' . $data['product_types_id'] . '&products_id=' . $data['products_id']);
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $params['id'];
            }
        }
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log;

        if( intval($data['product_types_id']) === 3 )
        {
            $sql =  'SELECT policies_id ' .
                    'FROM ' . PREFIX . '_policies_kasko ' .
                    'WHERE express_products_id IN(' . implode(' , ', $data['id']) . ')';
            $toDelete['id'] = $db->getCol($sql);
        }
        elseif( intval($data['products_types_id']) === 4 )
        {
            $sql =  'SELECT policies_id ' .
                    'FROM ' . PREFIX . '_policies_go ' .
                    'WHERE products_id IN(' . implode(' , ', $data['id']) . ')';
            $toDelete['id'] = $db->getCol($sql);
        }
        elseif( intval($data['products_types_id']) === 7 )
        {
            $sql =  'SELECT policies_id ' .
                    'FROM ' . PREFIX . '_policies_dgo ' .
                    'WHERE products_id IN(' . implode(' , ', $data['id']) . ')';
            $toDelete['id'] = $db->getCol($sql);
        }
        else
        {
            $Log->add('error', 'Для видалення цього продукту - зверніться до It-відділу.');
            return false;
        }

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>Поліси</b>.');
            return false;
        }

        $sql =  'DELETE FROM ' . PREFIX . '_product_deductibles ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_driver_standings ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_drivers ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_driver_ages ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_engine_sizes ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_regions  ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_agency_commissions ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_financial_institution_assignments ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_products_kasko ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_products_related ' .
                'WHERE products_id IN(' . implode(' , ', $data['id']) . ') OR related_products_id IN(' . implode(' , ', $data['id']) . ')';
        $db->query($sql);
    }

    function getPriceRanges($products_id, $price, $field='id') {
        global $db;

        $conditions[] = 'product_types_id = ' . PRODUCT_TYPES_KASKO;
        $conditions[] = 'b.products_id = ' . intval($products_id);

        $sql =  'SELECT currencies_id ' .
                'FROM ' . PREFIX . '_parameters_price_ranges as b ' .
                'WHERE ' . implode(' AND ', $conditions). ' ' .
                'LIMIT 1';
        $currencies_id = $db->getOne($sql, 3600);

        if (!$currencies_id) {

            array_pop($conditions);
            $conditions[] = 'a.products_id = 0';

            $sql =  'SELECT currencies_id ' .
                    'FROM ' . PREFIX . '_parameters_price_ranges as a ' .
                    'WHERE ' . implode(' AND ', $conditions). ' ' .
                    'LIMIT 1';
            $currencies_id = $db->getOne($sql, 3600);
        }

        $price = Currencies::exchage($price, $currencies_id);
        $conditions[] = 'b.products_id = ' . intval($products_id);

        $sql =  'SELECT a.id, b.value ' .
                'FROM ' . PREFIX . '_parameters_price_ranges as a ' .
                'JOIN ' . PREFIX . '_product_price_ranges as b ON a.id = b.price_rangesId AND ((a.products_id = b.products_id) OR (a.products_id = 0 AND b.products_id=' . intval($products_id) . ')) ' .
                'WHERE (a.limitation >= ' . doubleval($price) . ' OR a.limitation = 0) AND ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY a.limitation ASC ' .
                'LIMIT 1';
        $row = $db->getRow($sql);

        return $row[ $field ];
    }


    function getDeductiblesId($deductibleOther, $deductibleHijacking, $financial_institutions_id) {
        global $db;

        $conditions[] = 'value0 = ' . $db->quote($deductibleOther);
        $conditions[] = 'value1 = ' . $db->quote($deductibleHijacking);

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_product_deductibles ' .
                'WHERE ' . implode(' AND ', $conditions) . ' AND products_id IN(
                    SELECT a.id
                    FROM ' . PREFIX . '_products as a
                    LEFT JOIN ' . PREFIX . '_product_financial_institution_assignments as b ON a.id = b.products_id OR ISNULL(financial_institutions_id)
                    WHERE product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND financial_institutions_id' . (($financial_institutions_id) ? ' = ' . intval($financial_institutions_id) : ' IS NULL ') . ')';
        return $db->getOne($sql);
    }

    function getPaymentBrakedowns($products_id, $amount) {
        global $db;

        $result[] = '1|1.00';

        $conditions[] = 'a.value > 0';
        $conditions[] = 'a.products_id = ' . intval($products_id);
        $conditions[] = 'b.insurance_amount < ' . doubleval($amount);

        $sql =  'SELECT a.value, a.payment_breakdown_id ' .
                'FROM ' . PREFIX . '_product_payment_breakdowns AS a '.
                'JOIN ' . PREFIX . '_parameters_payment_breakdown AS b ON a.payment_breakdown_id = b.id '.
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY a.payment_breakdown_id';
        $list = $db->getAll($sql, 30 * 60);

        if (is_array($list)) {
            foreach ($list as $row) {
                $result[] = $row['payment_breakdown_id'] . '|' . $row['value'];
            }
        }

        return implode(';', $result);
    }

    function getPaymentBrakedown($products_id, $payment_breakdown_id) {
        global $db;

        $sql =  'SELECT value ' .
                'FROM ' . PREFIX . '_product_payment_breakdowns ' .
                'WHERE products_id = ' . intval($products_id) . ' AND payment_breakdown_id = ' . ($payment_breakdown_id);
        return $db->getOne($sql);
    }

 
    
    function findTopPolicyYearRecursive($policies_id,$year) {
        global $db;
        $r = $db->getRow('SELECT a.*,year(a.begin_datetime) as byear FROM insurance_policies a WHERE a.id='.intval($policies_id));
        if (!$r) return;
        $year = $r['byear'];
        if ($r['parent_id']>0) {
            $this->findTopPolicyYearRecursive($r['parent_id'],&$year);
        }
    }

    function findTopPolicyEK($policies_id) {
        global $db;

        $r = $db->getRow('SELECT parent_id, solutions_id FROM insurance_policies WHERE id = ' . intval($policies_id));

        if($r['parent_id'] < 1) {
            return ((intval($r['solutions_id']) > 0) ? true : false);
        } else {
            $this->findTopPolicyEK($r['parent_id']);
        }
    }

    function getShowBlockInWindow($data) {
        global $db, $Authorization;
 
        $malus = 0;
        if ($data['agreement_types_id']!=3) {
            $malus = $this->calculateMalus($data);
        }
        $data['itemsNumberId']  = ParametersCarNumbers::getIdByNumber(PRODUCT_TYPES_KASKO, intval($data['cars_count']));
        $y = intval($data['year']);
        if ($data['parent_id']>0) {
            //франшиза по дтп
            if ($data['unprofitable']) { //если 100% убыточный клиент
                $deductibles_value0 = doubleval($db->getOne('SELECT deductibles_value0 FROM insurance_policies_kasko_items WHERE policies_id    ='.intval($data['parent_id'])));
                if ($deductibles_value0>0) {//если у предыдущего была не нулевая франшиза то у пролонгируемого тоже нельзя нулевую при убытках
                    $conditions[] = 'l.value0>0';
                }
            }   
        }

        //берем первый год авто как год самого первого полиса
        //если текущий договор Каско Банк или
        //если первый полис был из ЭК
        if($data['parent_id'] > 0) {
            if($this->findTopPolicyEK($data['parent_id']) === true && $data['id']) {
                $sql = "SELECT financial_institutions_id FROM insurance_policies_kasko WHERE policies_id = " . intval($data['id']);

                if(intval($db->getOne($sql)) > 0)
                    $this->findTopPolicyYearRecursive($data['parent_id'], &$y);
            }
        }
        
        $data['car_years_id']    = ParametersCarYears::getIdByYear(PRODUCT_TYPES_KASKO, $y);
        $data['car_price_id'] = ParametersCarPrices::getIdByPrice( intval($data['brands_id'])==11 || intval($data['brands_id'])==9 ? 800001 : $data['price']);
        
        $conditions[] = 'a.publish = 1';
        $conditions[] = 'a.product_types_id = ' . intval($data['product_types_id']);

        if (intval($data['express_products_id'])) {
            if ( intval($data['flayer']) ) {//замена по акции НС за 1грн
                if ($data['express_products_id'] ==PRODUCT_KASKO2 ) $data['express_products_id'] = 201; //оптимальный
                if ($data['express_products_id'] ==PRODUCT_KASKO3 ) $data['express_products_id'] = 200; //премиум
            }
            if ($data['express_products_id']==140 && $data['parent_id']>0) 
                $conditions[] = 'a.id = 413';
            else
                $conditions[] = 'a.id = ' . intval($data['express_products_id']);
        } else {
            $conditions[] = 'a.id NOT IN ( ' . PRODUCT_KASKO1 .','. PRODUCT_KASKO2 .',413,'. PRODUCT_KASKO3.','. PRODUCT_KASKO_TESTDRIVE1.','. PRODUCT_KASKO_TESTDRIVE2.','. PRODUCT_KASKO_TESTDRIVE3 .',200,201,137,288,599,684,671,673)';
        }
        
        if ($data['options_deterioration_no']) $conditions[] = 'a.id<>265';
        
        if (intval($data['financial_institutions_id']) ==39 && !$data['options_deterioration_no']) //костыль универсал банк без врахування зносу
        { 
            $conditions[] = 'a.id not in (474,473,403,431,291,196)';
        
        }

        if (intval($data['flayer'])) {
           $conditions[] = 'a.id IN (200,201)';
        }

        if (intval($data['options_test_drive'])) {
            $conditions[] = 'b.special = 2';
        } elseif (intval($data['options_race'])) {
            $conditions[] = 'b.special = 3';
        } else {
            $conditions[] = 'b.special NOT IN(2, 3)';
        }
        

        //для доп угоды если первый год берем тот же продукт что в оригинале если второй год то из allowed_products_id
        if ($data['agreement_types_id'] >0 && $data['agreement_types_id']!=2 && $data['agreement_types_id']!=4) {//доп угода
            $data['policies_id'] = $data['parent_id'];
            if ($this->isFirstYear($data)) //загрузить  в allowed_products_id продукт с полиса оригинала
            {
                $allowed_products = $db->getCol('SELECT products_id FROM insurance_policies_kasko_items WHERE policies_id='.intval($data['parent_id']));
                if (is_array($allowed_products) && sizeof($allowed_products))
                    $data['allowed_products_id'] = implode(' , ', $allowed_products);
                
            }
            
        }
//       _dump($data['allowed_products_id']);
        if ($data['allowed_products_id']) {
            $conditions[] = 'a.id IN (' . $data['allowed_products_id'] . ')';
        }
        else
        {
            if (intval($data['express_products_id'])==0) {
                if ($data['options_second_year'])
                    $conditions[] = 'b.second_year=1';
                else
                    $conditions[] = 'b.second_year=0';
            }
        }

        if ($data['related_products_id']) {
            $conditions[] = 'a.id IN (' . $data['related_products_id'] . ')';
        }

        $conditions[] = (intval($data['financial_institutions_id']))
            ? 'm.financial_institutions_id = ' . intval($data['financial_institutions_id'])
            : 'ISNULL(m.financial_institutions_id)';
        
        if ($data['drivers_id'] == 7) { // будь яка особа
            if (!intval($data['driver_ages_id'])) $data['driver_ages_id'] = 2;
            if (!intval($data['driver_standings_id'])) $data['driver_standings_id'] = 3;
        }

        if (intval($data['policies_general_id'])) {
            $conditions[] = 'a.id IN (SELECT products_id FROM ' . PREFIX . '_policies_drive_general WHERE policies_id = ' . intval($data['policies_general_id']) . ')';
        }
        
        $conditions[] = 'a.insurance_companies_id = '.intval($data['insurance_companies_id']);

        if(intval($data['car_price_id']) > 0) {
            $conditions[] = 'zp.value > 0';
        }

        if (is_array($data['risks']) && !in_array(RISKS_HIJACKING1, $data['risks']))    {
        //каско без риска Незаконне заволодіння: франшиза только 5
            $conditions[] = ' l.value1=5 ';
        }

        $sql =  'SELECT DISTINCT a.*, b.*, c1.*, ' ."\n".
                'f.value AS driver_standings_value, ' ."\n".
                'e.value AS zones_value, ' ."\n".
                'g.value AS drivers_value, ' ."\n".
                'h.value AS driver_ages_value, ' ."\n".
                'i.value AS regions_value, ' ."\n".
                'IF(a.insurance_companies_id<>3,k.value,k.value_generali) AS terms_value, ' ."\n".
                'l.id AS deductibles_id, l.value0 AS deductiblesOther, l.absolute0 AS deductiblesOtherAbsolute, l.value1 AS deductiblesHijacking, l.absolute1 AS deductiblesHijackingAbsolute, l.value_other AS deductibles_value_other, l.value_hijacking AS deductibles_value_hijacking, ' ."\n".
                'n.discountPercent, p.value AS car_numbers_value, IF (z1.sng > 0, z.value_sng, z.value_foreign) AS car_years_value, s.value AS special_car_value,zp.value as car_price_value,b.min_rate,inf.info, ' ."\n".
                'IF('.doubleval($data['price']).'>800000,b.agent_commission_value2,b.agent_commission_value) as  agent_commission_value ' ."\n".
                'FROM ' . PREFIX . '_products AS a ' ."\n".
                'JOIN ' . PREFIX . '_products_kasko AS b ON a.id = b.products_id ' ."\n".
                'JOIN ' . PREFIX . '_product_base_rates AS c1 ON a.id = c1.products_id AND c1.car_types_id=' . intval($data['car_types_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_product_car_numbers AS p ON a.id = p.products_id AND p.car_numbers_id = ' . intval($data['itemsNumberId']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_product_car_years AS z ON a.id = z.products_id AND z.car_years_id = ' . intval($data['car_years_id']) . ' AND z.car_types_id='.intval($data['car_types_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_car_brands AS z1 ON z1.id = ' . intval($data['brands_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_product_terms AS y ON a.id = y.products_id AND y.terms_id = ' . intval($data['terms_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_product_zones  AS e ON a.id = e.products_id AND e.zones_id = ' . intval($data['zones_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_product_car_brand_assignments AS d ON a.id = d.products_id AND d.car_brands_id = ' . intval($data['brands_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_product_driver_standings AS f ON a.id = f.products_id AND f.driver_standings_id = ' . intval($data['driver_standings_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_product_drivers as g ON a.id = g.products_id AND g.drivers_id = ' . intval($data['drivers_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_product_driver_ages as h ON a.id = h.products_id AND h.driver_ages_id = ' . intval($data['driver_ages_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_product_car_prices AS zp ON b.products_id = zp.products_id AND zp.car_price_id = ' . intval($data['car_price_id']) . ' ' .
                'JOIN ' . PREFIX . '_product_regions as i ON a.id = i.products_id ' ."\n".
                'JOIN ' . PREFIX . '_cities as j ON i.regions_id = IF (b.retail>0,j.regions_kasko_retail_id,j.regions_id) AND j.id = ' . intval($data['registration_cities_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_parameters_terms as k ON a.product_types_id = k.product_types_id AND k.id = ' . intval($data['terms_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_product_deductibles as l ON a.id = l.products_id AND l.car_types_id = ' . intval($data['car_types_id']) . ' ' ."\n".
                'JOIN (' ."\n".
                '   SELECT DISTINCT c1.products_id,a1.agent_commission + a1.agency_commission as discountPercent,b1.agencies_id ' ."\n".
                        'FROM ' . PREFIX . '_commissions  AS a1 '."\n".
                        'JOIN ' . PREFIX . '_commissions_agency_assignments b1 on b1.commissions_id =a1.id ' ."\n".
                        'JOIN ' . PREFIX . '_commissions_product_assignments c1 on c1.commissions_id =a1.id ' ."\n".
                        'LEFT JOIN ' . PREFIX . '_policies as b2 ON b2.id = ' . intval($data['policies_id']) . ' ' ."\n".
                        'WHERE b1.agencies_id = ' . (intval($Authorization->data['agencies_id'] && $Authorization->data['roles_id']!=ROLES_ADMINISTRATOR && intval($data['agencies_id'])!=SELLER_AGENCIES_ID) ? intval($Authorization->data['agencies_id']) : (intval($data['agencies_id']) ? intval($data['agencies_id']) : 1))  . ' OR b1.agencies_id = b2.agencies_id ' ."\n".
                ') as n ON a.id = n.products_id ' ."\n". 
                'JOIN ' . PREFIX . '_product_agency_assignments AS o ON a.id = o.products_id AND n.agencies_id = o.agencies_id AND o.agencies_id='.( intval($Authorization->data['agencies_id'])>0 && $Authorization->data['roles_id']!=ROLES_ADMINISTRATOR && intval($data['agencies_id'])!=SELLER_AGENCIES_ID ? intval($Authorization->data['agencies_id']) : (intval($data['agencies_id'])==0 ? 1 : intval($data['agencies_id'])) ).' ' ."\n".
                'LEFT JOIN ' . PREFIX . '_product_financial_institution_assignments AS m ON a.id = m.products_id ' ."\n".
                'LEFT JOIN ' . PREFIX . '_parameters_special_cars AS s ON a.id = s.products_id AND s.brands_id= ' . intval($data['brands_id']) . ' ' ."\n".
                'LEFT JOIN (
                    SELECT 
                     b.info  as info,
                    a.products_id FROM insurance_product_document_assignments a
                    JOIN insurance_product_documents b ON b.product_types_id=3 AND a.product_documents_id=b.id
                    GROUP BY a.products_id
                ) inf ON inf.products_id=a.id '.
                'WHERE ' . implode(' AND ', $conditions) . ' ' ."\n".
                'ORDER BY l.value1 DESC, l.value0 DESC';
        $db->query('set session optimizer_search_depth=0');

        $res = $db->query($sql);

        if ($res->numRows()) {

            $risks = (!is_array($data['risks']) 
                            || (in_array(RISKS_HIJACKING1, $data['risks']) && !in_array(RISKS_DTP, $data['risks']) && !in_array(RISKS_PDTO, $data['risks']))
                            || (in_array(RISKS_HIJACKING1, $data['risks']) && !in_array(RISKS_DTP, $data['risks']))
                            || ($data['insurance_companies_id']==3 && in_array(RISKS_HIJACKING1, $data['risks']) && sizeof($data['risks'])<7)
                    )
                ? 0
                : 1;

            $i = 0;
            $options_agregate_no=$data['options_agregate_no'];
            $cp = 0;
            while ($res->fetchInto($row)) {
                if ($cp==0) {
                    if ($this->getCarPriceValueSeller($data, intval($data['brands_id'])==11 || intval($data['brands_id'])==9 ? 800001 : $data['price'] ))
                        $cp = 0.88136;
                    else    
                        $cp =$row['car_price_value'];
                }       
                    
                $row['car_price_value'] = $cp;
                if ($row['products_id']==110 || $row['products_id']==192) //В страховых продуктах КАСКО. Не кредит. 1.04.11 и КАСКО. Не кредит. 1.04.11 (2-й год) необходимо чтобы ОБЯЗАТЕЛЬНЫМИ были все риски кроме Незаконне заволодіння
                {
                    if (!in_array(RISKS_DTP, $data['risks']) ||
                        !in_array(RISKS_PDTO, $data['risks']) ||
                        !in_array(RISKS_FIRE1, $data['risks']) ||
                        !in_array(RISKS_ACTOFGOD, $data['risks'])  ||
                        !in_array(RISKS_DOWNFALL, $data['risks'])  ||
                        !in_array(RISKS_ANIMAL, $data['risks'])
                     ) $risks = 0;
                }

                $i = 1 - $i;
                if ($data['car_types_id']!=8 && $data['car_types_id'] != 28 && $row['products_id'] != 686) $row['car_price_value'] = 1;//не для легковых цену авто игнорим + не для Мотоциклов Ducati
                $row['base_rate_dtp']           = in_array(RISKS_DTP, $data['risks']) ? $row['base_rate_dtp'] : 0;
                $row['base_rate_hijacking'] = in_array(RISKS_HIJACKING1, $data['risks']) ? $row['base_rate_hijacking'] : 0;
                $row['base_rate_pdto']      = in_array(RISKS_PDTO, $data['risks']) ? $row['base_rate_pdto'] : 0;
                $row['base_rate_fire']      = in_array(RISKS_FIRE1, $data['risks']) ? $row['base_rate_fire'] : 0;
                $row['base_rate_actofgod']  = in_array(RISKS_ACTOFGOD, $data['risks']) ? $row['base_rate_actofgod'] : 0;
                $row['base_rate_downfall']  = in_array(RISKS_DOWNFALL, $data['risks']) ? $row['base_rate_downfall'] : 0;
                $row['base_rate_animal']        = in_array(RISKS_ANIMAL, $data['risks']) ? $row['base_rate_animal'] : 0;
 
                $description = $row['description'];

                //Проверка на вторую ячейку скидок и компенсаций
                if(abs($row['bank_discount_value'] - 1) < 0.00001)
                    $row['bank_discount_value'] = $row['bank_discount1_value'];

                if(abs($row['bank_commission_value']) < 0.00001)
                    $row['bank_commission_value'] = $row['bank_commission1_value'];

                //К5. Пріоритет виплати
                switch ($data['priority_payments_id']) {
                    case 1://СТО
                        $row['priority_payments_value'] = $row['priority_payments_car_service_value'];
                        break;
                    case 2://экспертиза
                        $row['priority_payments_value'] = $row['priority_payments_examination_value'];
                        break;
                }

                //К14. Наявність сигналізації
                $row['alarm_value'] = intval($data['optionsAlarm'])>0 ? $row['options_alarm_yes_value'] : $row['options_alarm_no_value'];

                //К6. Місце зберігання ТЗ
                switch (intval($data['residences_id'])) {
                    case 1://стоянка що охороняється
                        $row['residences_value'] = $row['residences_garage_value'];
                        break;
                    case 2://будь-яке місце
                        $row['residences_value'] = $row['residences_any_place_value'];
                        break;
                }
                //K10 дополнительные опции
                $options = 1;

                //без франшизи на вітрові стекла
                if ($data['options_deductible_glass_no']) {
                    $options *= $row['options_deductible_glass_no_value'];
                }


                //50 на 50
                if (intval($data['options_fifty_fifty'])) {
                    $options *= $row['options_fifty_fifty_value'];
                }

                /*if (in_array($data['mileage_car_id'], array(1,2,3,4))) {
                    $options *= $row['mileage_car_value'];
                }*/


                //страхування таксі
                if ($data['options_taxy']) {
                    $options *= $row['options_taxy_value'];
                }

                //неагрегатна страхова сума
                if (intval($data['financial_institutions_id']) == 41  || $row['options_agregate_no']) {//41 Костыль фольксбанк
                    $data['options_agregate_no'] = 1; 
                }

                if (intval($data['financial_institutions_id']) != 41  && !$row['options_agregate_no']) {//41 Костыль фольксбанк
                    $data['options_agregate_no'] = $options_agregate_no; 
                }
                

                if ($data['options_agregate_no']) { 
                    $options *= $row['options_agregate_no_value']; 
                }


                if ($data['drivers_id'] == 7) {//будь який водій на законних підставах отменяем возраст и стаж
                    $row['driver_ages_value'] = 1;
                    $row['driver_standings_value'] = 1;
                }

                if (doubleval($row['special_car_value']) == 0) {
                    $row['special_car_value'] = 1.1;
                }
                if ($data['priority_payments_id']==2) $row['special_car_value'] = 1.0; //экспертиза
                
                if ($this->isUkravtoBrand(intval($data['brands_id'])))
                    $row['special_car_value'] = 1.0;
                    
                $data['special_car_value'] = $row['special_car_value'];

                if (!intval($data['options_deterioration_no'])) {
                    $row['car_years_value'] = 1;
                }
                
                $term = 1;
                if ($data['agreement_types_id'] >0) {//доп угода
                        $term = $this->getCorrectionTerm($data);
                }

                if ($malus>0) {
                            $data['bonus_malus'] = $malus;
                            $data['max_bonus_malus'] = $malus;
                }
                //_dump($row);exit;
                if ($row['retail']) //расчет по новой формуле !!!
                {
                    if ($row['products_id'] == PRODUCT_KASKO3 || $row['products_id'] == 413) //премиум
                    {
                        $r = $this->calculatePremiumRitale(array_merge($data,array('deductibles_id'=>$row['deductibles_id'],'commission_agent_percent'=>30)));
                    }
                    elseif($row['products_id'] == 673) //vip
                    {
                        $r = $this->calculateVIPRitale(array_merge($data,array('car_years_value'=>$row['car_years_value'],'deductibles_id'=>$row['deductibles_id'])));
                    }
                    elseif($row['products_id'] == 599) //сто
                    {
                        $r = $this->calculateSTORitale(array_merge($data,array('car_years_value'=>$row['car_years_value'],'deductibles_id'=>$row['deductibles_id'])));
                    }
                    elseif ($row['products_id'] == 684) //СТО Mini_09.06.15
                    {
                        $r = $this->calculateMiniRitale(array_merge($data,array('car_years_value'=>$row['car_years_value'],'deductibles_id'=>$row['deductibles_id'],'deductiblesOther'=>$row['deductiblesOther'],'price'=>$data['price'])));                    
                    }
                    elseif ($row['products_id'] == 138) //Сезон+
                    {
                        $r = $this->calculateSeasonRitale(array_merge($data,array('deductibles_id'=>$row['deductibles_id'],'commission_agent_percent'=>30)));
                    }
                    elseif ($row['products_id'] == 686)
                    {
                        $r = $this->calculateDucatiKaskoRitale(array_merge($row, array('price'=>$data['price'])), $data);
                    }
                    else
                    {
                        $r = $this->calculateRitale(array_merge($data,array('deductibles_id'=>$row['deductibles_id'],'commission_agent_percent'=>30)));
                        $row['rate_kasko'] = $r['result'];
                        $row['formula'] = $r['formula'];
                        
                    }   
                    $row['rate_kasko'] = $row['rate_equipment'] = $r['result'];
                    $row['formula'] = $r['formula'];
                    //_dump($row['formula']);
                }
                else //по старой
                {
                    $row['DTP']         = $row['base_rate_dtp'] * $row['car_price_value'] * $row['deductibles_value_other'] * $row['driver_standings_value'] * $row['driver_ages_value'] * $row['priority_payments_value'] * $row['residences_value'] * $row['drivers_value'] * $row['zones_value'] * $row['regions_value'] * $row['special_car_value'];
                    $row['Hijacking']   = $row['base_rate_hijacking'] * $row['car_price_value']  * $row['deductibles_value_hijacking'] * $row['residences_value'] * $row['alarm_value'] * $row['special_car_value'];
                    $row['PDTO']        = $row['base_rate_pdto'] * $row['car_price_value']  * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['residences_value'] * $row['zones_value'] * $row['alarm_value'] * $row['special_car_value'] ;
                    $row['Fire']        = $row['base_rate_fire'] * $row['car_price_value']  * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
                    $row['Actofgod']    = $row['base_rate_actofgod'] * $row['car_price_value']  * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
                    $row['Downfall']    = $row['base_rate_downfall'] * $row['car_price_value']  * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
                    $row['Animal']      = $row['base_rate_animal']  * $row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];

                    if ((in_array(RISKS_DTP, $data['risks']) && $row['DTP'] == 0) ||
                        (in_array(RISKS_HIJACKING1, $data['risks']) && $row['Hijacking'] == 0) ||
                        (in_array(RISKS_PDTO, $data['risks']) && $row['PDTO'] == 0) ||
                        (in_array(RISKS_FIRE1, $data['risks']) && $row['Fire'] == 0) ||
                        (in_array(RISKS_ACTOFGOD, $data['risks']) && $row['Actofgod'] == 0) ||
                        (in_array(RISKS_DOWNFALL, $data['risks']) && $row['Downfall'] == 0) ||
                        (in_array(RISKS_ANIMAL, $data['risks']) && $row['Animal'] == 0)) {
                            $row['rate_kasko'] = 0;
                    } else {

                        $base = ($row['DTP'] + $row['Hijacking'] + $row['PDTO'] + $row['Fire'] + $row['Actofgod'] + $row['Downfall'] + $row['Animal']) * $row['car_numbers_value'] * $options * $row['terms_value'] * $row['car_years_value'] * $risks  ;
                        if(intval($data['options_fifty_fifty'])){
                            $row['rate_kasko'] =    $base>0 ? ((($base  * $term * $data['bonus_malus']* (100 - $data['discount'] -$data['cart_discount']) / 100 ) * $row['bank_discount_value'] + $row['agent_commission_value']* $row['bank_discount_value'])/2  + $row['bank_commission_value']) : 0;
                        }else{
                            $row['rate_kasko'] =    $base>0 ? ($base  * $term * $data['bonus_malus'] * (100 - $data['discount'] - $data['cart_discount']) / 100 + $row['agent_commission_value']) * $row['bank_discount_value'] + $row['bank_commission_value'] : 0;
                        }
                        if ($row['rate_kasko']<doubleval($row['min_rate']) && $row['rate_kasko']>0) {
                            $row['rate_kasko']= $item['rate_kasko'] = doubleval($row['min_rate']);
                        }   
                        
    
                     
                    }

                    $row['rate_equipment'] = $row['rate_kasko'];
                    
                }   
//_dump($row['priority_payments_value']);
//_dump($row['rate_kasko']);
//          _dump('(('.$row['base_rate_dtp'] .' * '.$row['car_price_value'] * $row['deductibles_value_other'] * $row['driver_standings_value'] * $row['driver_ages_value'] * $row['priority_payments_value'] * $row['residences_value'] * $row['drivers_value'] * $row['zones_value'] * $row['regions_value'] * $row['special_car_value'] .'+'. $row['base_rate_hijacking'].' * '.$row['car_price_value'] * $row['deductibles_value_hijacking'] * $row['residences_value'] * $row['alarm_value'] * $row['special_car_value'] .'+'. $row['base_rate_pdto'].' * '.$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['residences_value'] * $row['zones_value'] * $row['alarm_value'] * $row['special_car_value'] .'+'. $row['base_rate_fire'].' * '.$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_actofgod'].' * '.$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_downfall'].' * '.$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_animal'].' * '.$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'].')'. '*'. $row['car_numbers_value'] * $options * $row['terms_value'] * $row['car_years_value'] * $risks .')'. '*'. $term * '('.'100 - '.$data['discount'].')/100' * $row['bank_discount_value'] .'+'. $row['bank_commission_value'].' = '.$row['rate_kasko']);
/*
_dump(
'id='.$row['id'].' '.
'rate_kasko='.$row['rate_kasko'].' '.
'deductiblesOther='.$row['deductiblesOther'].' '.
'deductiblesHijacking='.$row['deductiblesHijacking'].' '.
'base_rate_dtp='.$row['base_rate_dtp'].' '.
 'deductibles_value_other='.$row['deductibles_value_other'].' '.
 'driver_standings_value='. $row['driver_standings_value'].' '.
 'driver_ages_value='.$row['driver_ages_value'].' '.
 'priority_payments_value='. $row['priority_payments_value'].' '.
 'residences_value='. $row['residences_value'].' '.
 'drivers_value='.$row['drivers_value'].' '.
 'zones_value='.$row['zones_value'].' '.
 'regions_value='.$row['regions_value'].' '.
 'special_car_value='.$row['special_car_value'].' '.
 'base_rate_hijacking='.$row['base_rate_hijacking'].' '.
 'deductibles_value_hijacking='.$row['deductibles_value_hijacking'].' '.
 'residences_value='.$row['residences_value'].' '.
 'alarm_value='.$row['alarm_value'].' '.
 'base_rate_pdto='.$row['base_rate_pdto'].' '.
 'deductibles_value_other='.$row['deductibles_value_other'].' '.
 'priority_payments_value='.$row['priority_payments_value'].' '.
 'residences_value='.$row['residences_value'].' '.
 'zones_value='.$row['zones_value'].' '.
 'base_rate_fire='.$row['base_rate_fire'].' '.
 'deductibles_value_other='.$row['deductibles_value_other'].' '.
 'priority_payments_value='.$row['priority_payments_value'].' '.
 'base_rate_actofgod='.$row['base_rate_actofgod'].' '.
 'deductibles_value_other='.$row['deductibles_value_other'].' '.
 'priority_payments_value='.$row['priority_payments_value'].' '.
 'zones_value='.$row['zones_value'].' '.
 'base_rate_downfall='.$row['base_rate_downfall'].' '.
 'deductibles_value_other='.$row['deductibles_value_other'].' '.
 'base_rate_animal='.$row['base_rate_animal'].' '.
 'car_numbers_value='.$row['car_numbers_value'].' '.
 'options='.$options.' '.
 'terms_value='.$row['terms_value'].' '.
 'car_years_value='.$row['car_years_value'] .' '.
 'risks='.$risks);
*/
                $row['amount_kasko']  = number_format($data['price'] * number_format($row['rate_kasko'], 3, '.', '') / 100, 2, '.', '');


                if ($row['rate_kasko'] > 0 &&//выбрасываем продукты с 0 стоимостью + показываем с минимальной стоимостью для франшизы
                    (!isset($list[ $row['deductiblesOther'] . $row['deductiblesOtherAbsolute'] . $row['deductiblesHijacking'] . $row['deductiblesHijackingAbsolute'] ]['amount_kasko']) ||
                    $list[ $row['deductiblesOther'] . $row['deductiblesOtherAbsolute'] . $row['deductiblesHijacking'] . $row['deductiblesHijackingAbsolute'] ]['amount_kasko'] > $row['amount_kasko'])) {
                        $list[ $row['deductiblesOther'] . $row['deductiblesOtherAbsolute'] . $row['deductiblesHijacking'] . $row['deductiblesHijackingAbsolute'] ] = $row;
                }
//_dump($row['rate_kasko']);
            }

            if (is_array($list)) {
                if ($data['express_products_id']!=684)
                    $list = $this->filterSearchResult($list);

                $result =   '<table width="100%" cellpadding="0" cellspacing="0">
                            <tr class="columns">
                                <td class="id">&nbsp;</td>
                                <td>Інші ризики</td>
                                <td>Незаконне заволодіння</td>
                                <td>Страховий тариф, %</td>
                                <td>Страхова премія, грн.</td>
                                <!--<td>Страхування НС, %,грн.</td>-->
                            </tr>';

                foreach ($list as $row) {
                    $result .= '<tr class="row' . $i . ' ' . $class . '">' .
                                    '<td align="center">' .
                                        '<input type="radio" id="items' . $data['items_id'] . 'deductibles_id" name="items['.$data['items_id'].'][deductibles_id]" value="' . $row['deductibles_id'] . '" ' . ($data['deductibles_id'] == $row['deductibles_id'] ? 'checked' : '') . ' onclick="setRate('.$data['items_id'].', true)" title="deductibles_id" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'products_id' . $row['deductibles_id'] . '" value="' . $row['products_id']. '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'deductiblesOther' . $row['deductibles_id'] . '" value="' . $row['deductiblesOther']. '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'deductiblesOtherAbsolute' . $row['deductibles_id'] . '" value="' . $row['deductiblesOtherAbsolute']. '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'deductiblesHijacking' . $row['deductibles_id'] . '" value="' . $row['deductiblesHijacking']. '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'deductiblesHijackingAbsolute' . $row['deductibles_id'] . '" value="' . $row['deductiblesHijackingAbsolute']. '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'rate_kasko' . $row['deductibles_id'] . '" value="' . $row['rate_kasko']. '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'amount_kasko' . $row['deductibles_id'] . '" value="' . $row['amount_kasko'] . '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'rate_equipment' . $row['deductibles_id'] . '" value="' . $row['rate_equipment']. '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'price_accident' . $row['deductibles_id'] . '" value="' . $row['price_accident'] . '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'rate_accident' . $row['deductibles_id'] . '" value="' . $row['rate_accident'] . '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'discountPercent' . $row['deductibles_id'] . '" value="' . $row['discountPercent'] . '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'paymentBrakedown' . $row['deductibles_id'] . '" value="' . $this->getPaymentBrakedowns($row['products_id'], $row['amount_kasko']) . '" />' .
                                        '<input type="hidden" id="items' . $data['items_id'] . 'info' . $row['deductibles_id'] . '" value="' . $row['info'] . '" />' .
                                    '</td>' .
                                    '<td>' . $row['deductiblesOther'] . ' ' . ParametersDeductibles::getSign($row['deductiblesOtherAbsolute']) . '</td>' .
                                    '<td>' . $row['deductiblesHijacking'] . ' ' . ParametersDeductibles::getSign($row['deductiblesHijackingAbsolute']) . '</td>' .
                                    '<td class="apply">' . number_format($row['rate_kasko'], 3, '.', '')  . '</td>' .
                                    '<td>' . getMoneyFormat($row['amount_kasko']) . '</td>' .
                                    //'<td>' .($row['price_accident']>0 || $row['option_accident'] ? '<input ' . ($data['price_accident']>0 || $row['option_accident']>0 ? 'checked':'').' type="checkbox" id="items' . $data['items_id'] . 'option_accident' . $row['deductibles_id'] . '" value="' . $row['amount_accident'] . '" onclick="' . ($row['option_accident']>0 ? 'return false' : 'setRate(' . $data['items_id'] . ', true)').'"  /> '.($row['price_accident']>0 ?  getMoneyFormat($row['price_accident'] * $row['rate_accident'] / 100) : $row['rate_accident'].'%') : '<input type="hidden" id="items' . $data['items_id'] . 'option_accident' . $row['deductibles_id'] . '" value="0" />') . '&nbsp;</td>' .
                                '</tr>';
                }

                $result .=    '</table>';
                $result .=    ($description && $Authorization->data['roles_id']!=ROLES_AGENT) ? '<div class="actions"><b>Опис:</b> ' . $description . '</div>' : '';
            }
        }

        if (!is_array($list)) {
            $result .=  '<div id="log">' .
                            '<div class="caption">' . translate('Message') . ':</div>' .
                            '<div class="empty">Згідно поставлених критеріїв нема жодної пропозиції. Змініть критерії.</div>' .
                        '</div>';
        }

        echo $result;
        exit;
    }


    function getCorrectionTerm($data) //коэф пропорциональности по кол-ву уже использованых дней страхового покрытия
    {
        global $db;
            $term = 1;
            if (!$data['begin_date']) $data['begin_date'] = $data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day'];
            $sql='SELECT count(*) FROM '.PREFIX.'_policies_kasko_item_years_payments WHERE policies_id=' . intval($data['parent_id']);
            if (intval($db->getOne($sql))>0) //многолетний
            {
                $end_date = $db->getOne('SELECT date FROM '.PREFIX.'_policies_kasko_item_years_payments WHERE date>'.($data['begin_date'] ? $db->quote($data['begin_date']) : 'NOW()').' AND policies_id=' . intval($data['parent_id']) .' ORDER BY date LIMIT 1');
                $begin_date = $db->getOne('SELECT date FROM '.PREFIX.'_policies_kasko_item_years_payments WHERE date<='.($data['begin_date'] ? $db->quote($data['begin_date']) : 'NOW()').' AND policies_id=' . intval($data['parent_id']) .' ORDER BY date DESC LIMIT 1');
            }
            else
            {
                $end_date = $db->getOne('SELECT end_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['parent_id']));
                $begin_date = $db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['parent_id']));
            }
        
            $sql = 'SELECT DATEDIFF(' . $db->quote($end_date) . ', ' . $db->quote($data['begin_date']) . ') as useddays  , DATEDIFF('.$db->quote($end_date).', '.$db->quote($begin_date).') as alldays FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['parent_id']);
            $r = $db->getRow($sql);
            if ($r) $term = $r['useddays']/$r['alldays'];
            if ($term==0) $term=1;
        return $term;           
    }
    
    /*
    *для доп угод возвращаем в каком годе страхования находится дата начала действия доп угоды
    */
    function isFirstYear($data) 
    {
        global $db;
        if (!$data['begin_date'] || $data['begin_date']=='--') $data['begin_date'] = 'NOW()';
        else  $data['begin_date'] = $db->quote($data['begin_date']);
    
        $days = $db->getOne('SELECT DATEDIFF('.$data['begin_date'].',begin_datetime) FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['parent_id']));
        return $days >= 365 ? false : true;
    }
    
    function getCarPriceValueSeller($data,$car_price) {
        global  $Authorization,$db;
        
        //if ($Authorization->data['id']!=1) return false;
        if ($data['financial_institutions_id']==19) return false;
        //корректируем car_price_value если это отдел продаж пролонгация, машина 117тыс до 150тыс и не превышины убытки
        if ($data['agencies_id'] == SELLER_AGENCIES_ID && $data['parent_id']>0 && $car_price>=117000 && $car_price<=150000) {
        
            $p = $db->getRow('SELECT a.*,insurer_identification_code,insurer_edrpou FROM  insurance_policies a JOIN insurance_policies_kasko b on b.policies_id=a.id WHERE a.id='.intval($data['parent_id']));
            
            $p['second_year'] = $db->getRow('SELECT a.*,DATE_SUB(a.date, INTERVAL 1 DAY) AS lastdate FROM insurance_policies_kasko_item_years_payments a WHERE policies_id='.intval($data['parent_id']).' AND a.date<DATE_SUB(NOW(), INTERVAL 45 DAY) ORDER BY date DESC LIMIT 1');
            
            //выплаты по урегулированию дела
            $begin_date = $db->quote($p['begin_datetime']);
            if (isset($p['second_year']['date'])) $begin_date = $db->quote($p['second_year']['date']);
            $p['payedAmount'] = $db->getOne('SELECT SUM(c.amount) as payedAmount  FROM insurance_accidents b JOIN insurance_accident_payments_calendar c ON b.id = c.accidents_id WHERE c.payment_statuses_id>1 AND b.policies_id = ' . intval($data['parent_id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND NOW() AND c.payment_types_id IN (5,6)  ');

            $payed_amount =doubleval($p['payedAmount']);
             
            if ($payed_amount>0) //были убытки
            {
                //считаем сколько нам заплатил клиент по всем своим договорам
                if ($p['insurer_identification_code']) {
                    $psql=' SELECT policies_id FROM  insurance_policies_kasko WHERE insurer_identification_code='.$db->quote($p['insurer_identification_code']) .' ';
                }
                elseif($p['insurer_edrpou']) {
                    $psql=' SELECT policies_id FROM  insurance_policies_kasko WHERE insurer_edrpou='.$db->quote($p['insurer_edrpou']) .' ';             
                }
                else return false;
                
                $sql = 'SELECT sum(amount) FROM  insurance_policy_payments_calendar WHERE statuses_id>=3 AND policies_id IN ('.$psql.') AND date BETWEEN ' . $begin_date . ' AND NOW() ';
                $amount = doubleval($db->getOne($sql,3600));
                if (0.5*$amount>=$payed_amount) return 0.5*$amount>=$payed_amount;
                else return false;
            }
            else {
                return true; //небыло убытков делаем более дешовый тариф
            }
            
        }
        return false;
    }   
    
    /*расчет понижающего коэф малуса*/
    
    function calculateMalus(&$data,$check = false)
    {
        global $db,$Authorization;
        //return 0;
        $insurer_identification_code = $data['insurer_identification_code'];
        $insurer_edrpou = $data['insurer_edrpou'];
        if ($data['shassi']) $shassi  =$data['shassi'];
        elseif ($data['items'][0]['shassi']) $shassi  = $data['items'][0]['shassi'];
        
        if ($Authorization->data['permissions']['Policies_KASKO']['superbonusmalus']) {
            //return 0;
        }
        

        if (strlen($insurer_identification_code)>=7 || strlen($insurer_edrpou)>=6 || $shassi) {
            $client = $db->getRow('SELECT * FROM insurance_clients WHERE identification_code =' .(strlen($insurer_edrpou)>=6 ? $db->quote($insurer_edrpou) :  $db->quote($insurer_identification_code) ) );
            if ($client && $client['important_person'] && $check==false) return 0;
            $cond = array();
            $cond[]='1';
            if (strlen($insurer_edrpou)>=6)
                $cond[] = ' c.insurer_edrpou= '.$db->quote($insurer_edrpou).' ';
            elseif(strlen($insurer_identification_code)>=7 )    
                $cond[] = ' (c.insurer_identification_code = ' . $db->quote($insurer_identification_code).' OR c.owner_identification_code =' . $db->quote($insurer_identification_code).' ) ' ;
            elseif($shassi) 
                $cond[] = ' d.shassi = ' . $db->quote($shassi).' ' ;
            //расход
            $sql =  'SELECT   SUM(p.amount) ' .
                    'FROM ' . PREFIX . '_accidents AS a ' .
                    'JOIN ' . PREFIX . '_accidents_kasko AS b ON a.id = b.accidents_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko AS c ON a.policies_id = c.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items AS d ON a.policies_id = d.policies_id ' .
                    'JOIN  insurance_accident_payments_calendar AS cal ON cal.accidents_id = a.id ' .
                    'JOIN insurance_accident_payments AS p ON p.payments_calendar_id=cal.id ' .
                    'WHERE cal.payment_types_id IN(5,6) AND p.is_return=0 AND '. implode(' AND ', $cond);
            $a = doubleval($db->getOne($sql));
//_dump($sql);
            $sql =  'SELECT   SUM(p.amount) ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_kasko AS c ON a.id = c.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items AS d ON a.id = d.policies_id ' .
                    'JOIN insurance_policy_payments AS p ON p.policies_id=a.id ' .
                    'WHERE  '.(strlen($insurer_edrpou)>=6 ? ' c.insurer_edrpou= '.$db->quote($insurer_edrpou).' ' : ' c.insurer_identification_code = ' . $db->quote($insurer_identification_code) ) . ' ';
            $b = doubleval($db->getOne($sql));
//_dump($a .'  '. $b);
            if ($a >= $b && $a >1) //расход больше приход
            {
                $data['unprofitable'] = true;
                $sql =  'SELECT a.id, DATEDIFF(NOW(),a.date) AS days ' .
                        'FROM ' . PREFIX . '_accidents AS a ' .
                        'JOIN ' . PREFIX . '_accidents_kasko AS b ON a.id = b.accidents_id ' .
                        'JOIN ' . PREFIX . '_policies_kasko AS c ON a.policies_id = c.policies_id ' .
                        'JOIN ' . PREFIX . '_policies_kasko_items AS d ON a.policies_id = d.policies_id ' .
                        'WHERE '.(strlen($insurer_edrpou)>=6 ? ' c.insurer_edrpou= '.$db->quote($insurer_edrpou).' ' : ' (c.insurer_identification_code = ' . $db->quote($insurer_identification_code).' OR c.owner_identification_code =' . $db->quote($insurer_identification_code).' ) ') .' ORDER BY a.id DESC';
                $ac = $db->getAll($sql);
//_dump($ac);
                if ($ac) {
                    $accidents=$ac[0];
                    $years=(int)($accidents['days']/365);
//_dump($years);
                    if ($years>=2)   return 0;//2 года безаварийной езду – учитывать только бонус
                    if ($years>=1)   return 1; //год безаварийной езды – не учитывать ни малус, ни бонус
                }
                $coef = round($a/$b*100,0);

                if ($coef>=136) 
                    return 2;
                elseif($coef>=121)  
                    return 1.35;
                else    
                    return 1.1;
            }
        }
        
        return 0;//если инн не задан рассчитать неможем
        
    }
        
    
    function calculate($engine_size, $car_types_id, $person_types_id, $driver_standings_id, $drivers_id, $price, $driver_ages_id, $cities_id, $terms_id, $deductibles_id, &$data, &$item) {
        global $db,$Log;
        
        //сертификат 8 марта
        $certificate8 = false;
        
       
        
//_dump($data['payment_brakedown_id']);exit;
        $sql =  'SELECT b.products_id, b.rate_equipment, b.price_accident, b.rate_accident, b.option_accident ' .
                'FROM ' . PREFIX . '_product_deductibles AS a ' .
                'JOIN ' . PREFIX . '_products_kasko AS b ON a.products_id = b.products_id ' .
                'WHERE a.id = ' . intval($deductibles_id);
        $product = $db->getRow($sql);
        if ($data['financial_institutions_id']==19 || $data['financial_institutions_id']==16 || $data['financial_institutions_id']==45 || $data['financial_institutions_id']==52 || $data['financial_institutions_id']==3) //костыль украгазбанк +ерсте
        {
            $product['price_accident']=$item['price_accident'];
            $product['rate_accident']=$item['rate_accident'];
            $product['option_accident']=1;
        }


        if (is_array($data['items']) && sizeof($data['items'])>0) {
            $data['itemsNumberId'] = ParametersCarNumbers::getIdByNumber(PRODUCT_TYPES_KASKO, sizeof($data['items']));
        }
//_dump(sizeof($data['items']));
        $y = intval($data['solutions_id']>0 ? date('Y') : $item['year']);
        
        //Если полис из ЭК и Каско банк + пролонгация, то год авто берём как год первого полиса
        if($data['parent_id'] > 0) {
            if($this->findTopPolicyEK($data['parent_id']) === true && $data['id']) {
                $sql = "SELECT financial_institutions_id FROM insurance_policies_kasko WHERE policies_id = " . intval($data['id']);

                if(intval($db->getOne($sql)) > 0)
                    $this->findTopPolicyYearRecursive($data['parent_id'], &$y);
                
            }
        }
            
        $item['car_years_id'] = ParametersCarYears::getIdByYear(PRODUCT_TYPES_KASKO, $y);
        
        $item['car_price_id'] = ParametersCarPrices::getIdByPrice( intval($item['brands_id'])==11 || intval($item['brands_id'])==9 ? 800001 : $item['car_price']);

        $conditions[] = '1';

        if ($data['financial_institutions_id']) {
            $conditions[] = 'n.financial_institutions_id = ' . intval($data['financial_institutions_id']);
        }
        
        if ($data['options_deterioration_no']) $conditions[] = 'a.products_id<>265';

        if ($data['drivers_id'] == 7) { // будь яка особа
            if (!intval($data['driver_ages_id'])) $data['driver_ages_id'] = 2;
            if (!intval($data['driver_standings_id'])) $data['driver_standings_id'] = 3;
        }

        if(!$data['express_incoming']) {
            $sql =  'SELECT a.*, c1.*, ' .
                    'e.value as driver_standings_value, ' .
                    'd.value as zones_value, ' .
                    'f.value as drivers_value, ' .
                    'h.value as driver_ages_value, ' .
                    'i.value as regions_value, ' .
                    'IF(prod.insurance_companies_id<>3,k.value,k.value_generali) AS terms_value, ' .
                    'l.id as deductibles_id, l.value0 as deductiblesOther, l.absolute0 as deductiblesOtherAbsolute, l.value1 as deductiblesHijacking, l.absolute1 as deductiblesHijackingAbsolute, l.value_other as deductibles_value_other,l.value_hijacking as deductibles_value_hijacking, ' .
                    'IF(ISNULL(m.payment_breakdown_id), 1, m.value) AS payment_brakedown_value, ' .
                    'o.value as car_numbers_value, '.
                    'IF (z1.sng>0,z.value_sng,z.value_foreign) as  car_years_value,z3.value as special_car_value,zp.value as car_price_value,a.min_rate, ' .
                    'IF('.doubleval($item['car_price']).'>800000,a.agent_commission_value2,a.agent_commission_value) as  agent_commission_value ' ."\n".
                    'FROM ' . PREFIX . '_products_kasko AS a ' .
                    'JOIN ' . PREFIX . '_products AS prod ON prod.id=a.products_id '.
                    'JOIN ' . PREFIX . '_product_deductibles AS l ON a.products_id = l.products_id AND l.id = ' . intval($deductibles_id) . ' AND l.car_types_id = ' . intval($car_types_id) . ' ' .//перенес для оптимизации выполнения запроса
                    'JOIN ' . PREFIX . '_product_base_rates AS c1 ON a.products_id = c1.products_id AND c1.car_types_id=' . intval($car_types_id) . ' ' .
                    'JOIN ' . PREFIX . '_product_car_brand_assignments AS c ON a.products_id = c.products_id AND c.car_brands_id = ' . intval($item['brands_id']) . ' ' .
                    'JOIN ' . PREFIX . '_product_zones  AS d ON a.products_id = d.products_id AND d.zones_id = ' . intval($data['zones_id']) . ' ' .
                    'JOIN ' . PREFIX . '_product_driver_standings AS e ON a.products_id = e.products_id AND e.driver_standings_id = ' . intval($driver_standings_id) . ' ' .
                    'JOIN ' . PREFIX . '_product_drivers AS f ON a.products_id = f.products_id AND f.drivers_id = ' . intval($drivers_id) . ' ' .
                    'JOIN ' . PREFIX . '_product_driver_ages AS h ON a.products_id = h.products_id AND h.driver_ages_id = ' . intval($driver_ages_id) . ' ' .
                    'JOIN ' . PREFIX . '_product_car_numbers AS o ON a.products_id = o.products_id AND o.car_numbers_id = ' . intval($data['itemsNumberId']) . ' ' .
                    'JOIN ' . PREFIX . '_product_car_years AS z ON a.products_id = z.products_id AND z.car_years_id = ' . intval($item['car_years_id']) . ' AND z.car_types_id='.intval($car_types_id) . ' ' .
                    'JOIN ' . PREFIX . '_product_car_prices AS zp ON a.products_id = zp.products_id AND zp.car_price_id = ' . intval($item['car_price_id']) . ' ' .
                    'JOIN ' . PREFIX . '_car_brands AS z1 ON z1.id = ' . intval($item['brands_id']) . ' ' .
                    'JOIN ' . PREFIX . '_product_regions AS i ON a.products_id = i.products_id ' .
                    'JOIN ' . PREFIX . '_cities as j ON i.regions_id = IF (a.retail>0,j.regions_kasko_retail_id,j.regions_id) AND j.id = ' . intval($cities_id) . ' ' ."\n".
                    'JOIN ' . PREFIX . '_parameters_terms AS k ON k.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND k.id = ' . intval($terms_id) . ' ' .
                    'LEFT JOIN ' . PREFIX . '_product_payment_breakdowns AS m ON (a.products_id = m.products_id AND m.payment_breakdown_id = ' . intval($data['payment_brakedown_id']) . ') OR ISNULL(m.payment_breakdown_id) ' .
                    'LEFT JOIN ' . PREFIX . '_product_financial_institution_assignments AS n ON a.products_id = n.products_id OR ISNULL(n.financial_institutions_id) ' .
                    'LEFT JOIN ' . PREFIX . '_parameters_special_cars AS z3 ON a.products_id = z3.products_id AND z3.brands_id= ' . intval($item['brands_id']) . ' ' .
                    'WHERE ' . implode(' AND ', $conditions);
        } else {
            $sql =  'SELECT a.*, c1.*, ' .
                    'e.value as driver_standings_value, ' .
                    'MIN(NULLIF(d.value, 0)) as zones_value, ' .
                    'f.value as drivers_value, ' .
                    'h.value as driver_ages_value, ' .
                    'i.value as regions_value, ' .
                    'IF(prod.insurance_companies_id<>3,k.value,k.value_generali) AS terms_value, ' .
                    'l.id as deductibles_id, l.value0 as deductiblesOther, l.absolute0 as deductiblesOtherAbsolute, l.value1 as deductiblesHijacking, l.absolute1 as deductiblesHijackingAbsolute, l.value_other as deductibles_value_other,l.value_hijacking as deductibles_value_hijacking, ' .
                    'IF(ISNULL(m.payment_breakdown_id), 1, m.value) AS payment_brakedown_value, ' .
                    'o.value as car_numbers_value, '.
                    'IF (z1.sng>0,z.value_sng,z.value_foreign) as  car_years_value,z3.value as special_car_value,zp.value as car_price_value,a.min_rate, ' .
                    'IF('.doubleval($item['car_price']).'>800000,a.agent_commission_value2,a.agent_commission_value) as  agent_commission_value ' ."\n".
                    'FROM ' . PREFIX . '_products_kasko AS a ' .
                    'JOIN ' . PREFIX . '_products AS prod ON prod.id=a.products_id '.
                    'JOIN ' . PREFIX . '_product_deductibles AS l ON a.products_id = l.products_id AND l.id = ' . intval($deductibles_id) . ' AND l.car_types_id = ' . intval($car_types_id) . ' ' .//перенес для оптимизации выполнения запроса
                    'JOIN ' . PREFIX . '_product_base_rates AS c1 ON a.products_id = c1.products_id AND c1.car_types_id=' . intval($car_types_id) . ' ' .
                    'JOIN ' . PREFIX . '_product_car_brand_assignments AS c ON a.products_id = c.products_id AND c.car_brands_id = ' . intval($item['brands_id']) . ' ' .
                    'JOIN ' . PREFIX . '_product_zones  AS d ON a.products_id = d.products_id AND d.zones_id IN (1,2,3,4) ' .
                    'JOIN ' . PREFIX . '_product_driver_standings AS e ON a.products_id = e.products_id AND e.driver_standings_id = ' . intval($driver_standings_id) . ' ' .
                    'JOIN ' . PREFIX . '_product_drivers AS f ON a.products_id = f.products_id AND f.drivers_id = ' . intval($drivers_id) . ' ' .
                    'JOIN ' . PREFIX . '_product_driver_ages AS h ON a.products_id = h.products_id AND h.driver_ages_id = ' . intval($driver_ages_id) . ' ' .
                    'JOIN ' . PREFIX . '_product_car_numbers AS o ON a.products_id = o.products_id AND o.car_numbers_id = ' . intval($data['itemsNumberId']) . ' ' .
                    'JOIN ' . PREFIX . '_product_car_years AS z ON a.products_id = z.products_id AND z.car_years_id = ' . intval($item['car_years_id']) . ' AND z.car_types_id='.intval($car_types_id) . ' ' .
                    'JOIN ' . PREFIX . '_product_car_prices AS zp ON a.products_id = zp.products_id AND zp.car_price_id = ' . intval($item['car_price_id']) . ' ' .
                    'JOIN ' . PREFIX . '_car_brands AS z1 ON z1.id = ' . intval($item['brands_id']) . ' ' .
                    'JOIN ' . PREFIX . '_product_regions AS i ON a.products_id = i.products_id ' .
                    'JOIN ' . PREFIX . '_cities as j ON i.regions_id = IF (a.retail>0,j.regions_kasko_retail_id,j.regions_id) AND j.id = ' . intval($cities_id) . ' ' ."\n".
                    'JOIN ' . PREFIX . '_parameters_terms AS k ON k.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND k.id = ' . intval($terms_id) . ' ' .
                    'LEFT JOIN ' . PREFIX . '_product_payment_breakdowns AS m ON (a.products_id = m.products_id AND m.payment_breakdown_id = ' . intval($data['payment_brakedown_id']) . ') OR ISNULL(m.payment_breakdown_id) ' .
                    'LEFT JOIN ' . PREFIX . '_product_financial_institution_assignments AS n ON a.products_id = n.products_id OR ISNULL(n.financial_institutions_id) ' .
                    'LEFT JOIN ' . PREFIX . '_parameters_special_cars AS z3 ON a.products_id = z3.products_id AND z3.brands_id= ' . intval($item['brands_id']) . ' ' .
                    'WHERE ' . implode(' AND ', $conditions);
        }

        $row = $db->getRow($sql);
        
        
        
//_dump($sql);exit;
        $commissions = $this->getCommissions($row['products_id'], $data['date'], $data['agencies_id'], $data['discount'], $data['financial_institutions_id']);


        if (is_array($row)) {
        
            //корректировка от стоимости авто для нового отдела продаж
            if ($this->getCarPriceValueSeller($data,intval($item['brands_id'])==11 || intval($item['brands_id'])==9 ? 800001 : $item['car_price']))
                $row['car_price_value'] = 0.88136;
        
            if ($data['financial_institutions_id']==19  || $data['financial_institutions_id']==16 || $data['financial_institutions_id']==45 || $data['financial_institutions_id']==52 || $data['financial_institutions_id']==3) //костыль украгазбанк
            {
                unset($row['price_accident']);
                unset($row['option_accident']);
            }
        
            //К5. Пріоритет виплати
            switch ($data['priority_payments_id']) {
                case 1://СТО
                    $row['priority_payments_value'] = $row['priority_payments_car_service_value'];
                    break;
                case 2://экспертиза
                    $row['priority_payments_value'] = $row['priority_payments_examination_value'];
                    break;
            }

            //К14. Наявність сигналізації
            if ($item['protection_multlock'] || $item['protection_immobilaser'] || $item['protection_manual'] || $item['protection_signalling'] || intval($item['no_immobiliser'])==0) {
                $data['optionsAlarm'] = 1;
            } else {
                $data['optionsAlarm'] = 0;
            }

            $row['alarm_value'] = intval($data['optionsAlarm'])>0 ? $row['options_alarm_yes_value'] : $row['options_alarm_no_value'];
            
            if ($car_types_id!=8 && $data['car_types_id'] != 28 && $row['products_id'] != 686) $row['car_price_value'] = 1;//не для легковых цену авто игнорим
            
            //К6. Місце зберігання ТЗ
            switch ($data['residences_id']) {
                case 1://стоянка що охороняється
                        $row['residences_value'] = $row['residences_garage_value'];
                        break;
                case 2://будь-яке місце
                        $row['residences_value'] = $row['residences_any_place_value'];
                        break;
            }

            //риски
            $risks = (!is_array($data['risks']) || in_array(RISKS_HIJACKING1, $data['risks']) && !in_array(RISKS_DTP, $data['risks']) && !in_array(RISKS_PDTO, $data['risks']))
                ? 0
                : 1;
            //базовые коэфициенты
            $row['base_rate_dtp']           = (in_array(RISKS_DTP, $data['risks'])) ? $row['base_rate_dtp'] : 0;
            $row['base_rate_hijacking'] = (in_array(RISKS_HIJACKING1, $data['risks'])) ? $row['base_rate_hijacking'] : 0;
            $row['base_rate_pdto']      = (in_array(RISKS_PDTO, $data['risks'])) ? $row['base_rate_pdto'] : 0;
            $row['base_rate_fire']      = (in_array(RISKS_FIRE1, $data['risks'])) ? $row['base_rate_fire'] : 0;
            $row['base_rate_actofgod']  = (in_array(RISKS_ACTOFGOD, $data['risks'])) ? $row['base_rate_actofgod'] : 0;
            $row['base_rate_downfall']  = (in_array(RISKS_DOWNFALL, $data['risks'])) ? $row['base_rate_downfall'] : 0;
            $row['base_rate_animal']        = (in_array(RISKS_ANIMAL, $data['risks'])) ? $row['base_rate_animal'] : 0;

            //дополнительные опции
            $options = 1;

            if ($data['options_deductible_glass_no']) {
                $options *= $row['options_deductible_glass_no_value'];
            }


            if ($data['options_fifty_fifty']) {
                $options *= $row['options_fifty_fifty_value'];
            }

            /*if (in_array($data['mileage_car_id'], array(1,2,3,4))) {
                $options *= $row['mileage_car_value'];
            }*/


            if ($data['options_taxy']) {
                $options *= $row['options_taxy_value'];
            }
            
            if (intval($data['financial_institutions_id'])==41 || $row['options_agregate_no']) {//41 Костыль фольксбанк
                $data['options_agregate_no'] = 1;
            }

            if ($data['options_agregate_no']) {
                $options *= $row['options_agregate_no_value'];
            }


            if ($data['payment_brakedown_id'] && intval($data['options_month500'])==0) {
                $data['payment_brakedown_value'] = $this->getPaymentBrakedown($products_id, $data['payment_brakedown_id']);
            } else {
            
                $data['payment_brakedown_id']     = 1;
                $data['payment_brakedown_value']  = 1;
            }

            if (intval($data['options_month500'])==1)
                $row['payment_brakedown_value'] = 1;

            if ($data['drivers_id'] == 7) {//будь який водій на законних підставах отменяем возраст и стаж
                $row['driver_ages_value'] = 1;
                $row['driver_standings_value'] = 1;
            }

            //K15 спец авто
            if (doubleval($row['special_car_value'])==0) {
               $row['special_car_value'] = 1.1;
            }
            if ($data['priority_payments_id']==2) $row['special_car_value'] = 1.0; //экспертиза
            
            if ($this->isUkravtoBrand(intval($item['brands_id'])))
                $row['special_car_value'] = 1.0;

            //Проверка на вторую ячейку скидок и компенсаций
            if(abs($row['bank_discount_value'] - 1) < 0.00001)
                $row['bank_discount_value'] = $row['bank_discount1_value'];

            if(abs($row['bank_commission_value']) < 0.00001)
                $row['bank_commission_value'] = $row['bank_commission1_value'];
            
            $data['special_car_value'] = $row['special_car_value'];
            
            if (!intval($data['options_deterioration_no'])) {
                $row['car_years_value'] = 1;
            }

            
            $term = 1;
            if ($data['agreement_types_id'] >0) {//доп угода
                    $term=$this->getCorrectionTerm($data);
            }
            
            $malus = 0;
            if ($data['agreement_types_id']!=3) {
                $malus = $this->calculateMalus($data);
            }


            if ($malus>0) {
                    $data['bonus_malus'] = $malus;
                    $data['max_bonus_malus'] = $malus;
            }

            if ($row['retail']) { //расчет по новой формуле !!!
                    $data['deductibles_id'] = $deductibles_id;
                    $data['price'] = doubleval($item['car_price']);
                    
                    
                    if ($row['products_id'] == PRODUCT_KASKO3 || $row['products_id'] ==413) //премиум
                    {
                        $r = $this->calculatePremiumRitale(array_merge($data,$data['items'][0],array('deductibles_id'=>$row['deductibles_id'],'commission_agent_percent'=>30)));
                    }
                    elseif($row['products_id'] == 673) //vip
                    {
                        $r = $this->calculateVIPRitale(array_merge($data,array('car_years_value'=>$row['car_years_value'],'deductibles_id'=>$row['deductibles_id'])));

                        if ($data["certificateTenPercent"] != '') {
                            $r["result"] = $r["result"] * 0.9;
                            $r["formula"] = $r["formula"] . " * 0.9 ";
                        }
                    }
                    elseif($row['products_id'] == 599) //СТо
                    {
                        $r = $this->calculateSTORitale(array_merge($data,array('car_years_value'=>$row['car_years_value'],'deductibles_id'=>$row['deductibles_id'])));
                    }                   
                    elseif($row['products_id'] == 684) //СТо mini
                    {
                        $r = $this->calculateMiniRitale(array_merge($data,array('car_years_value'=>$row['car_years_value'],'deductibles_id'=>$row['deductibles_id'])));
                    }                   
                    elseif($row['products_id'] == 138) {//сезон +
                        $r = $this->calculateSeasonRitale(array_merge ( $data,$data['items'][0] ,array('commission_agent_percent'=>30)));
                    }
                    elseif ($row['products_id'] == 686) //Ducati 3 в 1
                    {
                        $r = $this->calculateDucatiKaskoRitale(array_merge($row, array('price'=>$data['price'])), $data);
                    }
                    else {
                        $r = $this->calculateRitale(array_merge ( $data,$data['items'][0] ,array('commission_agent_percent'=>30)));
                    }
                    $row['rate_kasko'] = $item['rate_kasko'] =$item['rate_agent'] = $item['rate_equipment'] = $product['rate_equipment'] = round($r['result'],3);
                    $row['formula'] = $item['formula'] = $r['formula'];
                    
//                  _dump($row['formula']);exit;

            }
            else {
                //по старой
                $row['DTP']         = $row['base_rate_dtp'] * $row['car_price_value'] * $row['deductibles_value_other'] * $row['driver_standings_value'] * $row['driver_ages_value'] * $row['priority_payments_value'] * $row['residences_value'] * $row['drivers_value'] * $row['zones_value'] * $row['regions_value'] * $row['special_car_value'];
                $row['Hijacking']   = $row['base_rate_hijacking'] * $row['car_price_value'] * $row['deductibles_value_hijacking'] * $row['residences_value'] * $row['alarm_value'] * $row['special_car_value'];
                $row['PDTO']        = $row['base_rate_pdto'] * $row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['residences_value'] * $row['zones_value'] * $row['alarm_value'] * $row['special_car_value'];
                $row['Fire']        = $row['base_rate_fire'] * $row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
                $row['Actofgod']    = $row['base_rate_actofgod'] * $row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
                $row['Downfall']    = $row['base_rate_downfall'] * $row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
                $row['Animal']      = $row['base_rate_animal']* $row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
                if ((in_array(RISKS_DTP, $data['risks']) && $row['DTP'] == 0) ||
                    (in_array(RISKS_HIJACKING1, $data['risks']) && $row['Hijacking'] == 0) ||
                    (in_array(RISKS_PDTO, $data['risks']) && $row['PDTO'] == 0) ||
                    (in_array(RISKS_FIRE1, $data['risks']) && $row['Fire'] == 0) ||
                    (in_array(RISKS_ACTOFGOD, $data['risks']) && $row['Actofgod'] == 0) ||
                    (in_array(RISKS_DOWNFALL, $data['risks']) && $row['Downfall'] == 0) ||
                    (in_array(RISKS_ANIMAL, $data['risks']) && $row['Animal'] == 0)) {
                        $row['rate_kasko'] = $item['rate_kasko'] = 0;
                } else {

                    $base = ($row['DTP'] + $row['Hijacking'] + $row['PDTO'] + $row['Fire'] + $row['Actofgod'] + $row['Downfall'] + $row['Animal']) * $row['car_numbers_value'] * $options * $row['terms_value'] * $row['car_years_value'] * $row['payment_brakedown_value'] * $risks ;
                    if($data['options_fifty_fifty']){
                        $row['rate_kasko']= $item['rate_kasko'] = ($base > 0) ? round((($base  * $term * doubleval($data['bonus_malus']) * (100 - doubleval($data['discount']) - doubleval($data['cart_discount'])) ) * $row['bank_discount_value'] )/200 + $row['agent_commission_value']* $row['bank_discount_value'] + $row['bank_commission_value'] , 3) : 0;
                        $row['rate_agent']= $item['rate_agent'] = ($base > 0) ? round($base * $term * doubleval($data['bonus_malus']) * (100 - doubleval($data['discount']) - doubleval($data['cart_discount'])) / 200, 3) : 0;
//_dump($row['rate_kasko']);exit;
                    }else{
                        $row['rate_kasko']= $item['rate_kasko'] = ($base > 0) ? round(($base  * $term * doubleval($data['bonus_malus']) * (100 - doubleval($data['discount']) - doubleval($data['cart_discount'])) / 100 + $row['agent_commission_value']) * $row['bank_discount_value'] + $row['bank_commission_value'], 3) : 0;
                        $row['rate_agent']= $item['rate_agent'] = ($base > 0) ? round($base * $term * doubleval($data['bonus_malus']) * (100 - doubleval($data['discount']) - doubleval($data['cart_discount'])) / 100, 3) : 0;
                    }
                    
                    if ($row['rate_kasko']<doubleval($row['min_rate']) && $row['rate_kasko']>0) {
                        $row['rate_kasko']= $item['rate_kasko'] = doubleval($row['min_rate']);
                    }
                }
                $item['formula'] = '((('.$row['base_rate_dtp'].'*'.$row['car_price_value'] .'*'. $row['deductibles_value_other'] .'*'. $row['driver_standings_value'] .'*'. $row['driver_ages_value'] .'*'. $row['priority_payments_value'] .'*'. $row['residences_value'] .'*'. $row['drivers_value'] .'*'. $row['zones_value'] .'*'. $row['regions_value'] .'*'. $row['special_car_value'] .'+'. $row['base_rate_hijacking'].'*'.$row['car_price_value'] .'*'. $row['deductibles_value_hijacking'] .'*'. $row['residences_value'] .'*'. $row['alarm_value'] .'*'. $row['special_car_value'] .'+'. $row['base_rate_pdto'].'*'.$row['car_price_value'] .'*'. $row['deductibles_value_other'] .'*'. $row['priority_payments_value'] .'*'. $row['residences_value'] .'*'. $row['zones_value'] .'*'. $row['alarm_value'] .'*'. $row['special_car_value'] .'+'. $row['base_rate_fire'].'*'.$row['car_price_value'] .'*'. $row['deductibles_value_other'] .'*'. $row['priority_payments_value'] .'*'. $row['zones_value'] .'*'. $row['special_car_value'] .'+'. $row['base_rate_actofgod'].'*'.$row['car_price_value'] .'*'. $row['deductibles_value_other'] .'*'. $row['priority_payments_value'] .'*'. $row['zones_value'] .'*'. $row['special_car_value'] .'+'. $row['base_rate_downfall'].'*'.$row['car_price_value'] .'*'. $row['deductibles_value_other'] .'*'. $row['priority_payments_value'] .'*'. $row['zones_value'] .'*'. $row['special_car_value'] .'+'. $row['base_rate_animal'].'*'.$row['car_price_value'] .'*'. $row['deductibles_value_other'] .'*'. $row['priority_payments_value'] .'*'. $row['zones_value'] .'*'. $row['special_car_value'].')'. '*'. $row['car_numbers_value'] .'*'. $options * $row['terms_value'] .'*'. $row['car_years_value']  * $row['payment_brakedown_value'] * $risks .')'. '*'. $term *doubleval($data['bonus_malus']). '*('.'100 - '.doubleval($data['discount']).'-'.doubleval($data['cart_discount']).')/100 + '.$row['agent_commission_value'].') * '. $row['bank_discount_value'] .'+'. $row['bank_commission_value'].' = '.$row['rate_kasko'];  
                $item['rate_equipment']     = round($product['rate_equipment'] * (100 - doubleval($data['discount']) - doubleval($data['cart_discount'])) / 100, 3);
            }

            if ($row['products_id']==263 && $row['rate_kasko']<6.5) {  //костыль ВТБ банк
                $row['rate_kasko']= $item['rate_kasko'] = 6.5;
                $row['rate_agent'] =$item['rate_agent']= 6.5;
            }
            $item['rate_equipment'] =$row['rate_equipment'] =$row['rate_kasko'];//Доп оборудование тот же тариф что и каско

            //_dump($row['rate_kasko']);exit;
            
 
            
            //для доп угоды скоректировать сумму на размер убытков
            
            if ($data['agreement_types_id'] == 1) {
                $data['begin_date'] =$data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day'];
                if ($this->isFirstYear($data)) {
                    $end_date=$data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day'];
                    $begin_date = $db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['parent_id']));
                    //выплаты

                    $options_agregate_no = intval($db->getOne('SELECT options_agregate_no FROM insurance_policies_kasko WHERE policies_id= '.intval($data['parent_id'])));
                    if ($options_agregate_no) {
                        $payedAmount = 0;
                    } else {
                        $sql = 'SELECT SUM(a.amount) FROM insurance_accident_payments a JOIN  insurance_accidents b on b.id=a.accidents_id  WHERE b.policies_id = ' . intval($data['parent_id']).' AND a.date BETWEEN ' . $db->quote($begin_date) . ' AND ' . $db->quote($end_date);
                        $payedAmount = doubleval($db->getOne($sql));
                        if ($data['parent_id'] == 237864) $payedAmount += 5534.11;
                    }

                    $amount_rest = doubleval(Policies_KASKO::calculateAmountUsed($data['parent_id'], $end_date, true));
                    $delta = round(($price+$payedAmount) * $item['rate_kasko'] / 100 - doubleval($amount_rest), 2);
                    if ($delta<0) $delta = 0;
                    //скоректировать тариф
                    
                    $item['rate_kasko'] = $item['rate_agent'] = $row['rate_kasko'] = round($delta / $price*100 ,3);

                    $item['amount_kasko'] =$item['amount_agent']= $delta;
                }   
            }
            else
            {
                $item['amount_kasko']       = round($price * $item['rate_kasko'] / 100, 2);
                $item['amount_agent']       = round($price * $item['rate_agent'] / 100, 2);
                
                if ($certificate8) {
                    $item['amount_kasko'] -=500;//скидка 500 грн
                    $item['amount_agent'] -=500;
                    //обратный перещет тарифа
                    $item['rate_kasko'] = $row['rate_kasko'] = round(100*$item['amount_kasko']/$price,3);
                    $item['rate_agent'] = round(100*$item['amount_agent']/$price,3);
                    //и еще раз суммы по новому тарифу
                    $item['amount_kasko']       = round($price * $item['rate_kasko'] / 100, 2);
                    $item['amount_agent']       = round($price * $item['rate_agent'] / 100, 2);
                }
            }   

            //!!! акция сертификат
            /*if ($data['certificate'] != '' && (in_array($data['express_products_id'], array(138, 139, 140)) || (intval($data['terms_id']) == 29 && intval($data['financial_institutions_id']) == 0 && intval($item['car_types_id']) == 8))) {
                $item['amount_kasko'] -= 500;
                $item['amount_agent'] -= 500;
                
                $item['rate_kasko'] = round($item['amount_kasko']*100/$price,3);
                $item['rate_agent'] = round($item['amount_agent']*100/$price,3);
                
            }*/

            unset($product['rate_equipment']);
            unset($row['rate_equipment']);

            $item['amount_equipment']   = round($item['price_equipment'] * $item['rate_equipment'] / 100, 2);

            $item['rate_accident']      = $product['rate_accident'] ;
            unset($product['rate_accident']);
            unset($row['rate_accident']);

            $item['amount_accident']    = round($item['price_accident'] * $item['rate_accident'] / 100, 2);
            unset($product['amount_accident']);
            unset($row['amount_accident']);
            $amount_season = 0;
            if ($data['express_products_id']==138 || $data['express_products_id'] == 686) { //сезон +
                $amount_season = $price * 0.1/100;
            }
            //_dump($amount_season);exit;
            //Ducati 3 в 1, считает НС
            $amount_ducati_ns = 0;
            if ($data['express_products_id'] == 686) {
                $amount_ducati_ns = 230.75;
            }
            $item['amount'] = $item['amount_kasko'] + $item['amount_equipment'] + $item['amount_accident']+$amount_season + $amount_ducati_ns;
            $item['amount_agent']   = $item['amount_agent'] + $item['amount_equipment'] + $item['amount_accident']+$amount_season;
            //_dump($item['amount']);exit;
            //пересчет и округления тарифа для доп угоды!!!
            if ($data['agreement_types_id'] == 1) {
                $amount_parent = doubleval($db->getOne('SELECT SUM(amount) FROM '.PREFIX.'_policies_kasko_items WHERE policies_id='.intval($data['parent_id'])))-doubleval($data['amount_parent']);

                $diff = abs($amount_parent - $item['amount']);
                if ($diff<20) //расброс меньше 20грн берем старый тариф
                  $item['amount'] = $amount_parent;

                $diff = abs($amount_parent - $item['amount_kasko']);
                $amount_parent = doubleval($db->getOne('SELECT SUM(amount_kasko) FROM '.PREFIX.'_policies_kasko_items WHERE policies_id='.intval($data['parent_id'])))-doubleval($data['amount_parent']);
                if ($diff<20) //расброс меньше 20грн берем старый тариф
                  $item['amount_kasko'] = $amount_parent;
                //корректируем тариф на сумму убытков  
            }

            $item['bank_commission_value'] = $row['bank_commission_value'];
            $item['bank_discount_value'] = $row['bank_discount_value'];
            $item['agent_commission_value'] = $row['agent_commission_value'];
            

            //криво массивы объединяются, приходится делать unset некоторым полям!!!
            $item = array_merge($item, $product, $row, $commissions);
            //тут идет модификация комиссий
            if ($data['manager_id']) //выбрали менеджера що привiв клиента
            {
                $sqlTemper = 'SELECT allcomission as allfullcomission 
                FROM insurance_agents WHERE allcomission = 1 
                and accounts_id = ' . intval($data['manager_id']);

                $rowTemper = $db->getRow($sqlTemper);
                //echo 'id:' . $data[id] . '|agencie:'.$data['agencies_id'].'|im:'.$data['individual_motivation'];
                if($data['agencies_id']!=1469 && $data['individual_motivation'] == 0 && !$rowTemper['allfullcomission'])
                    $item['commission_agent_percent'] = $item['commission_agent_percent']/2;
            }
            else {
                $item['commission_manager_percent'] = 0;
            }
            
            if (!$data['seller_agents_id']) //не выбрали продающего в агенции
            {
                $item['commission_seller_agents_percent'] = 0;
            }
             

        
            //расчет тарифа многолетних договоров
            if (intval($data['terms_years_id'])>1 || $data['financial_institutions_id']>0) 
            {
                //записать данные на первый год
                $data['next_year'] = 0;
                $item['years'][$data['next_year']]['car_price']             =$price; 
                $item['years'][$data['next_year']]['rate_kasko']            = $item['rate_kasko'];
                $item['years'][$data['next_year']]['rate_agent']            = $item['rate_agent'];
                
                $item['years'][$data['next_year']]['amount_kasko']      = $item['amount_kasko'];
                $item['years'][$data['next_year']]['amount_agent']      = $item['amount_agent'];

                $item['years'][$data['next_year']]['rate_equipment']        = $item['rate_equipment'];

                $item['years'][$data['next_year']]['amount_equipment']  = $item['amount_equipment'];
                $item['years'][$data['next_year']]['amount']            = $item['amount'];
                $item['years'][$data['next_year']]['amount_agent']          = $item['amount_agent'];
                $item['years'][$data['next_year']]['formula']       = $item['formula'];
                
                $item['years'][$data['next_year']]['bank_commission_value']     = $item['bank_commission_value'];
                $item['years'][$data['next_year']]['bank_discount_value']       = $item['bank_discount_value'];
                $item['years'][$data['next_year']]['agent_commission_value']    = $item['agent_commission_value'];
                
                $item['years'][$data['next_year']]['products_id']       = $item['products_id'];
                $item['years'][$data['next_year']]['products_title']        = $item['products_title'];
                
                $item['years'][$data['next_year']]['commission_agent_amount']   = round($item['amount_agent'] * $commissions['commission_agent_percent']/100,2);
                if ($data['agreement_types_id'] == 3) {
                    $item['years'][$data['next_year']]['f'] = 1;
                }


                $beginDateFormat=$data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day'];
                /*if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW) {//доп угода
                    //взять дату начала с прошлого полиса
                    $beginDateFormat = $db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['parent_id']));
                }*/
                $item['years'][$data['next_year']]['date']  = $beginDateFormat ;

//_dump($item['years'][$data['next_year']]['date']);exit;
                //провести расчет на остальные года
                $next_year_deductibles_id = $deductibles_id;
                for ($i=1;$i<$data['terms_years_id'];$i++)
                {
                    if ($data['drivers_id'] != 7) //не будь який водитель корректируем стаж и возраст
                    {
                        $beginDate=$beginDateFormat;
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
                        $curBeginDate = add_date($beginDate,0,0,$i);
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
                    if ($product['products_id']==296 || $product['products_id']==298 || $product['products_id']==396 || $product['products_id']==487) //костыль укргаз мерседес
                    {
                        $price = doubleval($price);
                    }
                    elseif ($i==1 && intval($data['parent_id'])==0) $price = doubleval($price)-doubleval($price)*($data['financial_institutions_id']==44 || $data['financial_institutions_id']==39 ? 0.1 : 0.15);//2-й год -15%
                    elseif (($i==5 || $i==6) && $data['financial_institutions_id']==39) {$price = doubleval($price)-doubleval($price)*0.05; }//универсалбанк 5-6 год
                    else $price = doubleval($price)-doubleval($price)*0.1; //остальные годы цена падает на 10%
                    $data['next_year']=$i;
                    $next_year_deductibles_id = $this->calculateNextYear($car_types_id, $person_types_id, $driver_standings_id, $drivers_id, $price, $driver_ages_id, $cities_id, $terms_id, $next_year_deductibles_id, $data, &$item);
                }   
                //_dump($item['years']); 
                //exit;
            }   
        }
        return $item['amount'];
    }
    
    
    function calculateNextYear($car_types_id, $person_types_id, $driver_standings_id, $drivers_id, $price, $driver_ages_id, $cities_id, $terms_id, $deductibles_id, $data, &$item) {
        global $db,$Log, $Authorization;


        $data['payment_brakedown_id'] = 1;
        if (intval($data['express_products_id'])) {
            if ( intval($data['flayer']) ) {//замена по акции НС за 1грн
                if ($data['express_products_id'] ==PRODUCT_KASKO2 ) $data['express_products_id'] = 201; //оптимальный
                if ($data['express_products_id'] ==PRODUCT_KASKO3 || $data['express_products_id'] ==413) $data['express_products_id'] = 200; //премиум
            }
            $conditions1[] = 'c.related_products_id = ' . intval($data['express_products_id']);
        } else {
            $conditions1[] = 'c.related_products_id NOT IN ( ' . PRODUCT_KASKO1 .','. PRODUCT_KASKO2 .','. PRODUCT_KASKO3.',413,'. PRODUCT_KASKO_TESTDRIVE1.','. PRODUCT_KASKO_TESTDRIVE2.','. PRODUCT_KASKO_TESTDRIVE3 .',200,201,599)';
            if (intval($data['financial_institutions_id']))
            $conditions1[] = 'c.related_products_id IN (SELECT products_id FROM insurance_product_financial_institution_assignments WHERE financial_institutions_id='.intval($data['financial_institutions_id']).') ';

        }
        
        
        $car_price_id = ParametersCarPrices::getIdByPrice( intval($item['brands_id'])==11 || intval($item['brands_id'])==9 ? 800001 : $price);
        
        if(intval($car_price_id) > 0) {
            $conditions1[] = 'cp.car_price_id = ' . intval($car_price_id);
            $conditions1[] = 'cp.value > 0';
        }

        if (intval($data['agencies_id'])) {
            $conditions1[] = 'c.related_products_id IN (SELECT products_id FROM insurance_product_agency_assignments WHERE agencies_id='.intval($data['agencies_id']).') ';
        }

        $sql =  'SELECT e.id as deductibles_id,c.related_products_id  as products_id, d.rate_equipment, d.price_accident, d.rate_accident, d.option_accident ' .
                'FROM ' . PREFIX . '_product_deductibles AS a ' .
                'JOIN ' . PREFIX . '_products_kasko AS b ON a.products_id = b.products_id ' .
                'JOIN ' . PREFIX . '_products_related c on c.products_id  = b.products_id ' .
                'JOIN ' . PREFIX . '_products_kasko AS d ON d.products_id = c.related_products_id ' .
                'JOIN ' . PREFIX . '_product_deductibles AS e ON e.products_id=c.related_products_id AND a.car_types_id=e.car_types_id AND a.value0 =e.value0  AND a.absolute0 =e.absolute0  AND a.value1=e.value1 AND a.absolute1 =e.absolute1  ' .
                'JOIN ' . PREFIX . '_product_car_prices cp on cp.products_id = d.products_id ' .
                'WHERE a.id = ' . intval($deductibles_id).' AND a.car_types_id='.intval($car_types_id).' AND ' . implode(' AND ', $conditions1) . ' LIMIT 1';

        $product = $db->getRow($sql);

        if (!$product) {
            $Log->add('error', 'Не знайдено продукт наступного перiоду для багатолiтнiх договорiв');
            return $deductibles_id;     
        }   

        if (is_array($data['items']) && sizeof($data['items'])>0) {
            $data['itemsNumberId'] = ParametersCarNumbers::getIdByNumber(PRODUCT_TYPES_KASKO, sizeof($data['items']));
        }
        
        
        $y = intval($data['solutions_id']>0 ? date('Y') : $item['year']);
        if ($data['parent_id']>0) //для допа или пролонгации берем первый год авто как год самого первого полиса
            $this->findTopPolicyYearRecursive($data['parent_id'],&$y);

        $item['car_years_id'] = ParametersCarYears::getIdByYear(PRODUCT_TYPES_KASKO,  $y-$data['next_year']);
//_dump(intval($item['year'])-$data['next_year']);
        $conditions[] = '1';

        if ($data['financial_institutions_id']) {
            $conditions[] = 'n.financial_institutions_id = ' . intval($data['financial_institutions_id']);
        }

        
        $deductibles_id=$product['deductibles_id'];

        $sql =  'SELECT a.*, c1.*, ' .
                'e.value as driver_standings_value, ' .
                'd.value as zones_value, ' .
                'f.value as drivers_value, ' .
                'h.value as driver_ages_value, ' .
                'i.value as regions_value, ' .
                'IF(prod.insurance_companies_id<>3,k.value,k.value_generali) AS terms_value,zp.value as car_price_value, ' .
                'l.id as deductibles_id, l.value0 as deductiblesOther, l.absolute0 as deductiblesOtherAbsolute, l.value1 as deductiblesHijacking, l.absolute1 as deductiblesHijackingAbsolute, l.value_other as deductibles_value_other,l.value_hijacking as deductibles_value_hijacking, ' .
                'IF(ISNULL(m.payment_breakdown_id), 1, m.value) AS payment_brakedown_value, ' .
                'o.value as car_numbers_value, '.
                'IF (z1.sng>0,z.value_sng,z.value_foreign) as  car_years_value,z3.value as special_car_value,z1.sng,a.min_rate ' .
                'FROM ' . PREFIX . '_products_kasko AS a ' .
                'JOIN ' . PREFIX . '_products AS prod ON prod.id=a.products_id '.
                'JOIN ' . PREFIX . '_product_deductibles AS l ON a.products_id = l.products_id AND l.id = ' . intval($deductibles_id) . ' AND l.car_types_id = ' . intval($car_types_id) . ' ' .//перенес для оптимизации выполнения запроса
                'JOIN ' . PREFIX . '_product_base_rates AS c1 ON a.products_id = c1.products_id AND c1.car_types_id=' . intval($car_types_id) . ' ' .
                'JOIN ' . PREFIX . '_product_car_brand_assignments AS c ON a.products_id = c.products_id AND c.car_brands_id = ' . intval($item['brands_id']) . ' ' .
                'JOIN ' . PREFIX . '_product_zones  AS d ON a.products_id = d.products_id AND d.zones_id = ' . intval($data['zones_id']) . ' ' .
                'JOIN ' . PREFIX . '_product_driver_standings AS e ON a.products_id = e.products_id AND e.driver_standings_id = ' . intval($driver_standings_id) . ' ' .
                'JOIN ' . PREFIX . '_product_drivers AS f ON a.products_id = f.products_id AND f.drivers_id = ' . intval($drivers_id) . ' ' .
                'JOIN ' . PREFIX . '_product_driver_ages AS h ON a.products_id = h.products_id AND h.driver_ages_id = ' . intval($driver_ages_id) . ' ' .
                'JOIN ' . PREFIX . '_product_car_numbers AS o ON a.products_id = o.products_id AND o.car_numbers_id = ' . intval($data['itemsNumberId']) . ' ' .
                'JOIN ' . PREFIX . '_product_car_years AS z ON a.products_id = z.products_id AND z.car_years_id = ' . intval($item['car_years_id']) . ' AND z.car_types_id='.intval($car_types_id) . ' ' .
                'JOIN ' . PREFIX . '_product_car_prices AS zp ON a.products_id = zp.products_id AND zp.car_price_id = ' . intval($car_price_id) . ' ' .
                'JOIN ' . PREFIX . '_car_brands AS z1 ON z1.id = ' . intval($item['brands_id']) . ' ' .
                'JOIN ' . PREFIX . '_product_regions AS i ON a.products_id = i.products_id ' .
                'JOIN ' . PREFIX . '_cities AS j ON j.id = ' . intval($cities_id) . ' AND j.regions_id = i.regions_id ' .
                'JOIN ' . PREFIX . '_parameters_terms AS k ON k.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND k.id = ' . intval($terms_id) . ' ' .
                'LEFT JOIN ' . PREFIX . '_product_payment_breakdowns AS m ON (a.products_id = m.products_id AND m.payment_breakdown_id = ' . intval($data['payment_brakedown_id']) . ') OR ISNULL(m.payment_breakdown_id) ' .
                'LEFT JOIN ' . PREFIX . '_product_financial_institution_assignments AS n ON a.products_id = n.products_id OR ISNULL(n.financial_institutions_id) ' .
                'LEFT JOIN ' . PREFIX . '_parameters_special_cars AS z3 ON a.products_id = z3.products_id AND z3.brands_id= ' . intval($item['brands_id']) . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        $row = $db->getRow($sql);
// _dump($sql); 
        if (!$row) {
            $Log->add('error', 'Не можливо розрахувати тариф для наступного перiоду  багатолiтнiх договорiв');
            //_dump($sql);exit;
            return $deductibles_id;     
        }   
 
        $commissions = $this->getCommissions($row['products_id'], $data['date'], $data['agencies_id'], $data['discount'], $data['financial_institutions_id']);

        if (is_array($row)) {
            if ($data['financial_institutions_id']==19  || $data['financial_institutions_id']==16 || $data['financial_institutions_id']==45  || $data['financial_institutions_id']==52  || $data['financial_institutions_id']==3) {//костыль украгазбанк
                unset($row['price_accident']);
                unset($row['option_accident']);
            }

            //К5. Пріоритет виплати
            switch ($data['priority_payments_id']) {
                case 1://СТО
                    $row['priority_payments_value'] = $row['priority_payments_car_service_value'];
                    break;
                case 2://экспертиза
                    $row['priority_payments_value'] = $row['priority_payments_examination_value'];
                    break;
            }

            
            //К14. Наявність сигналізації
            if ($item['protection_multlock'] || $item['protection_immobilaser'] || $item['protection_manual'] || $item['protection_signalling'] || intval($item['no_immobiliser'])==0) {
                $data['optionsAlarm'] = 1;
            } else {
                $data['optionsAlarm'] = 0;
            }

            $row['alarm_value'] = intval($data['optionsAlarm'])>0 ? $row['options_alarm_yes_value'] : $row['options_alarm_no_value'];
            
            //К6. Місце зберігання ТЗ
            switch ($data['residences_id']) {
                case 1://стоянка що охороняється
                        $row['residences_value'] = $row['residences_garage_value'];
                        break;
                case 2://будь-яке місце
                        $row['residences_value'] = $row['residences_any_place_value'];
                        break;
            }

            //риски
            $risks = (!is_array($data['risks']) || in_array(RISKS_HIJACKING1, $data['risks']) && !in_array(RISKS_DTP, $data['risks']) && !in_array(RISKS_PDTO, $data['risks']))
                ? 0
                : 1;

            //базовые коэфициенты
            $row['base_rate_dtp']       = (in_array(RISKS_DTP, $data['risks'])) ? $row['base_rate_dtp'] : 0;
            $row['base_rate_hijacking'] = (in_array(RISKS_HIJACKING1, $data['risks'])) ? $row['base_rate_hijacking'] : 0;
            $row['base_rate_pdto']      = (in_array(RISKS_PDTO, $data['risks'])) ? $row['base_rate_pdto'] : 0;
            $row['base_rate_fire']      = (in_array(RISKS_FIRE1, $data['risks'])) ? $row['base_rate_fire'] : 0;
            $row['base_rate_actofgod']  = (in_array(RISKS_ACTOFGOD, $data['risks'])) ? $row['base_rate_actofgod'] : 0;
            $row['base_rate_downfall']  = (in_array(RISKS_DOWNFALL, $data['risks'])) ? $row['base_rate_downfall'] : 0;
            $row['base_rate_animal']    = (in_array(RISKS_ANIMAL, $data['risks'])) ? $row['base_rate_animal'] : 0;

            //Проверка на вторую ячейку скидок и компенсаций
            if(abs($row['bank_discount_value'] - 1) < 0.00001)
                $row['bank_discount_value'] = $row['bank_discount1_value'];

            if(abs($row['bank_commission_value']) < 0.00001)
                $row['bank_commission_value'] = $row['bank_commission1_value'];
            
            //дополнительные опции
            $options = 1;

            if ($data['options_deductible_glass_no']) {
                $options *= $row['options_deductible_glass_no_value'];
            }

            if ($data['options_taxy']) {
                $options *= $row['options_taxy_value'];
            }
            
            if (intval($data['financial_institutions_id'])==41 || $row['options_agregate_no']) {//41 Костыль фольксбанк
                $data['options_agregate_no'] = 1;
            }

            if ($data['options_agregate_no']) {
                $options *= $row['options_agregate_no_value'];
            }
            if ($data['options_fifty_fifty']) {
                $options *= $row['options_fifty_fifty_value'];
            }

            if ($data['payment_brakedown_id']) {
                $data['payment_brakedown_value'] = $this->getPaymentBrakedown($products_id, $data['payment_brakedown_id']);
            } else {
                $data['payment_brakedown_id']     = 1;
                $data['payment_brakedown_value']  = 1;
            }

            if ($data['drivers_id'] == 7) {//будь який водій на законних підставах отменяем возраст и стаж
                $row['driver_ages_value'] = 1;
                $row['driver_standings_value'] = 1;
            }

            //K15 спец авто
            if (doubleval($row['special_car_value'])==0) {
                $row['special_car_value'] = 1;
            }
        
            if ($data['priority_payments_id']==2) $row['special_car_value'] = 1.0; //экспертиза
        
            if ($this->isUkravtoBrand(intval($item['brands_id'])))
                $row['special_car_value'] = 1.0;

                
            $data['special_car_value'] = $row['special_car_value'];
            
            if (!intval($data['options_deterioration_no']) || ($data['next_year']>=5 && $row['sng']>0)) {//для снг 6-й и след года износ не учитываем
                $row['car_years_value'] = 1;
            }

            if ($row['sng']>0 && $row['car_years_value'] == 0) {
                $row['car_years_value'] = 1;
            }
            
            

            $term = 1;

            $row['DTP']         = $row['base_rate_dtp'] *$row['car_price_value'] * $row['deductibles_value_other'] * $row['driver_standings_value'] * $row['driver_ages_value'] * $row['priority_payments_value'] * $row['residences_value'] * $row['drivers_value'] * $row['zones_value'] * $row['regions_value'] * $row['special_car_value'];
            $row['Hijacking']   = $row['base_rate_hijacking']*$row['car_price_value'] * $row['deductibles_value_hijacking'] * $row['residences_value'] * $row['alarm_value'] * $row['special_car_value'];
            $row['PDTO']        = $row['base_rate_pdto']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['residences_value'] * $row['zones_value'] * $row['alarm_value'] * $row['special_car_value'];
            $row['Fire']        = $row['base_rate_fire']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
            $row['Actofgod']    = $row['base_rate_actofgod']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
            $row['Downfall']    = $row['base_rate_downfall']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
            $row['Animal']      = $row['base_rate_animal']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'];
//    _dump(  '(('.$row['base_rate_dtp'] * $row['deductibles_value_other'] * $row['driver_standings_value'] * $row['driver_ages_value'] * $row['priority_payments_value'] * $row['residences_value'] * $row['drivers_value'] * $row['zones_value'] * $row['regions_value'] * $row['special_car_value'] .'+'. $row['base_rate_hijacking'] * $row['deductibles_value_hijacking'] * $row['residences_value'] * $row['alarm_value'] * $row['special_car_value'] .'+'. $row['base_rate_pdto'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['residences_value'] * $row['zones_value'] * $row['alarm_value'] .'+'. $row['base_rate_fire'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_actofgod'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_downfall'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_animal'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'].')'* $row['car_numbers_value'] * $options * $row['terms_value'] * $row['car_years_value'] * $row['payment_brakedown_value'] * $risks * $row['bank_discount_value'] .'+'. $row['bank_commission_value'].')' * $term * '('.'100 -'. doubleval($data['discount']).' -'. doubleval($data['cart_discount']).')'. '/ 100'  );exit;

            if ((in_array(RISKS_DTP, $data['risks']) && $row['DTP'] == 0) ||
                (in_array(RISKS_HIJACKING1, $data['risks']) && $row['Hijacking'] == 0) ||
                (in_array(RISKS_PDTO, $data['risks']) && $row['PDTO'] == 0) ||
                (in_array(RISKS_FIRE1, $data['risks']) && $row['Fire'] == 0) ||
                (in_array(RISKS_ACTOFGOD, $data['risks']) && $row['Actofgod'] == 0) ||
                (in_array(RISKS_DOWNFALL, $data['risks']) && $row['Downfall'] == 0) ||
                (in_array(RISKS_ANIMAL, $data['risks']) && $row['Animal'] == 0)) {
                    $row['rate_kasko'] = $item['years'][$data['next_year']]['rate_kasko'] = 0;
//exit;
            } else {
//                          _dump(  '(('.$row['base_rate_dtp'] * $row['deductibles_value_other'] * $row['driver_standings_value'] * $row['driver_ages_value'] * $row['priority_payments_value'] * $row['residences_value'] * $row['drivers_value'] * $row['zones_value'] * $row['regions_value'] * $row['special_car_value'] .'+'. $row['base_rate_hijacking'] * $row['deductibles_value_hijacking'] * $row['residences_value'] * $row['alarm_value'] * $row['special_car_value'] .'+'. $row['base_rate_pdto'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['residences_value'] * $row['zones_value'] * $row['alarm_value'] .'+'. $row['base_rate_fire'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_actofgod'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_downfall'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_animal'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'].')'* $row['car_numbers_value'] * $options * $row['terms_value'] * $row['car_years_value'] * $row['payment_brakedown_value'] * $risks * $row['bank_discount_value'] .'+'. $row['bank_commission_value'].')' * $term * '('.'100 -'. doubleval($data['discount']).' -'. doubleval($data['cart_discount']).')'. '/ 100'  );exit;

                if ($data['next_year']>1) //корректировка банковский комиссий на третий и четветртый год для  многолетних
                {
                    if ($row['bank_discount_value1']>0 || $row['bank_commission_value1']>0) //3й год
                    {
                            $row['bank_discount_value'] = $row['bank_discount_value1'];
                            $row['bank_commission_value'] = $row['bank_commission_value1'];
                    }
                    if ($data['next_year']>2)  //4й год если нули берем третий
                    {
                        if ($row['bank_discount_value2']>0 || $row['bank_commission_value2']>0)
                        {
                            $row['bank_discount_value'] = $row['bank_discount_value2'];
                            $row['bank_commission_value'] = $row['bank_commission_value2'];
                        }
                    }
                }
                
                $base = ($row['DTP'] + $row['Hijacking'] + $row['PDTO'] + $row['Fire'] + $row['Actofgod'] + $row['Downfall'] + $row['Animal']) * $row['car_numbers_value'] * $options * $row['terms_value'] * $row['car_years_value']  * $risks ;
            
                if(intval($data['options_fifty_fifty'])){
                    $row['rate_kasko']= $item['years'][$data['next_year']]['rate_kasko']  = $base >0 ? round($base  * $term * (100 - doubleval($data['discount']) - doubleval($data['cart_discount'])) / 200 * $row['bank_discount_value']+ $row['bank_commission_value'], 3) : 0;
                    $row['rate_agent']= $item['years'][$data['next_year']]['rate_agent']  = $base >0 ? round($base  * $term * (100 - doubleval($data['discount']) - doubleval($data['cart_discount'])) / 200, 3) : 0;
                }
                else {
                    $row['rate_kasko']= $item['years'][$data['next_year']]['rate_kasko']  = $base >0 ? round($base  * $term * (100 - doubleval($data['discount']) - doubleval($data['cart_discount'])) / 100 * $row['bank_discount_value']+ $row['bank_commission_value'], 3) : 0;
                    $row['rate_agent']= $item['years'][$data['next_year']]['rate_agent']  = $base >0 ? round($base  * $term * (100 - doubleval($data['discount']) - doubleval($data['cart_discount'])) / 100, 3) : 0;
                }
                
                if ($row['rate_kasko']<doubleval($row['min_rate']) && $row['rate_kasko']>0) {
                    $row['rate_kasko']= $item['years'][$data['next_year']]['rate_kasko'] = doubleval($row['min_rate']);
                }
                
                $item['years'][$data['next_year']]['products_id']   = $row['products_id'];
                
                $item['years'][$data['next_year']]['formula'] = '(('.$row['base_rate_dtp']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['driver_standings_value'] * $row['driver_ages_value'] * $row['priority_payments_value'] * $row['residences_value'] * $row['drivers_value'] * $row['zones_value'] * $row['regions_value'] * $row['special_car_value'] .'+'. $row['base_rate_hijacking']*$row['car_price_value'] * $row['deductibles_value_hijacking'] * $row['residences_value'] * $row['alarm_value'] * $row['special_car_value'] .'+'. $row['base_rate_pdto']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['residences_value'] * $row['zones_value'] * $row['alarm_value'] * $row['special_car_value'] .'+'. $row['base_rate_fire']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_actofgod']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_downfall']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'] .'+'. $row['base_rate_animal']*$row['car_price_value'] * $row['deductibles_value_other'] * $row['priority_payments_value'] * $row['zones_value'] * $row['special_car_value'].')'. '*'. $row['car_numbers_value'] * $options * $row['terms_value'] * $row['car_years_value'] * $risks .')'. '*'. $term *doubleval($data['bonus_malus']). '*('.'100 - '.doubleval($data['discount']).'-'.doubleval($data['cart_discount']).')/100 *'. $row['bank_discount_value'] .'+'. $row['bank_commission_value'].' = '.$row['rate_kasko'];  
                
                $item['years'][$data['next_year']]['bank_commission_value']     = $row['bank_commission_value'];
                $item['years'][$data['next_year']]['bank_discount_value']       = $row['bank_discount_value'];
                $item['years'][$data['next_year']]['agent_commission_value']    = $row['agent_commission_value'];


            }

            $item['years'][$data['next_year']]['car_price']             =$price;    
            $item['years'][$data['next_year']]['amount_kasko']      = round($price * $item['years'][$data['next_year']]['rate_kasko'] / 100, 2);
            $item['years'][$data['next_year']]['amount_agent']      = round($price * $item['years'][$data['next_year']]['rate_agent'] / 100, 2);

            $item['years'][$data['next_year']]['rate_equipment']        = round($product['rate_equipment'] * (100 - doubleval($data['discount']) - doubleval($data['cart_discount'])) / 100, 3);
            unset($product['rate_equipment']);
            unset($row['rate_equipment']);

            $item['years'][$data['next_year']]['amount_equipment']  = round($item['years'][$data['next_year']]['price_equipment'] * $item['years'][$data['next_year']]['rate_equipment'] / 100, 2);

            unset($product['rate_accident']);
            unset($row['rate_accident']);

            $item['years'][$data['next_year']]['amount'] = $item['years'][$data['next_year']]['amount_kasko'] + $item['years'][$data['next_year']]['amount_equipment'];
            $item['years'][$data['next_year']]['amount_agent']      = $item['years'][$data['next_year']]['amount_agent'] + $item['years'][$data['next_year']]['amount_equipment'];

            $item['years'][$data['next_year']]['commission_agent_amount']   = round($item['years'][$data['next_year']]['amount_agent'] * $commissions['commission_agent_percent']/100,2); 

            if ($data['agreement_types_id'] >0) {//доп угода 
                $sql='SELECT count(*) FROM '.PREFIX.'_policies_kasko_item_years_payments WHERE policies_id=' . intval($data['parent_id']);
                if (intval($db->getOne($sql))>0) //многолетний
                {
                    $beginDate = $db->getOne('SELECT date FROM insurance_policies_kasko_item_years_payments WHERE date<='.$db->quote($data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day']).' AND policies_id=' . intval($data['parent_id']).' ORDER BY date DESC LIMIT 1');
                }
                else
                //$beginDate = $db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['parent_id']));
                $beginDate=$data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day'];
                
            } else {
                $beginDate=$data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day'];
            }
            //$beginDate=$data['begin_datetime_year'].'-'.$data['begin_datetime_month'].'-'.$data['begin_datetime_day'];

            $item['years'][$data['next_year']]['date'] = add_date($beginDate,0,0,$data['next_year']);
        }

        return $deductibles_id;
    }

    

    function getChinaCar($brands_id) {
        //BYD, CHERY, GEELY, GREAT WALL, SSANG YONG,
        if ($brands_id==47 || $brands_id==5 || $brands_id==57 || $brands_id==60 || $brands_id==98)
        return 0;
    }
    
    function isUkravtoBrand($brands_id) {
        //  Cadillac, Chery, Chevrolet , Chrysler, Daewoo, Jeep, KIA, Maserati, Mercedes-Benz, Nissan, Opel, Renault, Smart, Toyota, ЗАЗ, Lada/ВАЗ
        //Грузовые - I-VAN, JAC, TATA, ЗАЗ автобусы

        if ($brands_id==20 || $brands_id==5  || $brands_id==6 || $brands_id==15   || $brands_id==14 
        || $brands_id==28 || $brands_id==82 || $brands_id==13 || $brands_id==9 || $brands_id==8 || $brands_id==7   || $brands_id==11 
        || $brands_id==16 || $brands_id==300 || $brands_id==260 || $brands_id==150 || $brands_id==185 || $brands_id==302 || $brands_id==3
        || $brands_id==109 || $brands_id==34  || $brands_id==110 || $brands_id==24)
            return true;
        else
            return false;
        
    }
    
    //функции расчета для Ducati
    function getDucatiK4(&$data, &$data1) {
        if($data1['options_agregate_no'] != 0)
        {
            return $data['options_agregate_no_value'];
        }
        return 1.0;
    }

    function getDucatiK5(&$data, &$data1) {
        switch(intval($data1['priority_payments_id']))
        {
            case 1:
                return $data['priority_payments_car_service_value'];
                break;
            case 2:
                return $data['priority_payments_examination_value'];
                break;
            default:
                return 0.0;
                break;
        }
    }

    function getDucatiK6(&$data, &$data1) {
        switch(intval($data1['residences_id']))
        {
            case 1:
                return $data['residences_garage_value'];
                break;
            case 2:
                return $data['residences_any_place_value'];
                break;
            default:
                return 0.0;
                break;
        }
    }

    function getDucatiK7(&$data, &$data1) {
        return $data['drivers_value'];
    }

    function getDucatiK9(&$data, &$data1) {
        return $data['car_price_value'];
    }

    function getDucatiK10(&$data, &$data1) {
        return $data['options_taxy_value'];
    }

    function getDucatiK11(&$data, &$data1) {
        return $data['terms_value'];
    }

    function getDucatiK12(&$data, &$data1) {
        return floatval($data['zones_value']);
    }

    function getDucatiK13(&$data, &$data1) {
        return $data['regions_value'];
    }

    function getDucatiK14(&$data, &$data1) {
        return $data['alarm_value'];
    }

    function getDucatiK16(&$data, &$data1) {
        global $db;
        
        if(intval($data1['year']) === 0)
        {
            foreach ($data1['items'] as $r)
            {
                if(intval($r['year']) != 0)
                {
                    $data1['year'] = $r['year'];
                    break;
                }
            }
        }

        $year = intval(date('Y')) - intval($data1['year']) + 1;

        $sql =  'SELECT IF (z1.sng > 0, z.value_sng, z.value_foreign) AS car_years_value '.
        'FROM insurance_car_brands AS z1,'.
        'insurance_product_car_years AS z '.
        'WHERE z1.id = 240 AND z.products_id = 686 AND z.car_years_id = ' . $year . ' AND z.car_types_id='.intval($data['car_types_id']) .' LIMIT 1';

        return floatval($db->getOne($sql));
    }

    ///функции расчета для новых тарифов КАСКО
    function getK1(&$data) {
    
        $price = $data['price'];
        if ($data['car_types_id']!=8) return 1;
        
        if(intval($data['brands_id'])==11 || intval($data['brands_id'])==9) $price = 800001;
        
        //корректировка от стоимости авто для нового отдела продаж
        if ($this->getCarPriceValueSeller($data,$price))
                return 0.85965;

        if ($price<=150000) return 1;
        if ($price<=800000) return 0.85965;
        return 0.75438;
    }
    
    function getK1Premium(&$data) {
        $price =$data['price'] ;
        if(intval($data['brands_id'])==11 || intval($data['brands_id'])==9) $price = 800001;
        if ($price<=150000) return 0;
        if ($price<=800000) return 5.7;
        return 5.0;
    }
    function getK1STO(&$data) {
 
        return 2.2;
    }
    
    function getK1VIP(&$data) {
        if ($data['price']<800000) return 0;
        if ($data['person_types_id']==2) return 0;
        return 3.9;
    }
    
    function getK2(&$data) {
        global $db;
        $deductibles_id = $data['deductibles_id'];
        if (!$deductibles_id) return 0;
        $deductibles = $db->getRow('SELECT * FROM insurance_product_deductibles WHERE id='.intval($deductibles_id), 10600);
        $value0 = doubleval($deductibles['value0']);
        if ($value0>=2) return 0.8888;
        if ($value0>=1.5) return 0.9233;
        if ($value0>=1) return 0.9573;
        if ($value0>=0.5) return 1;
        if ($value0>=0.25) return 1.05;
        if ($value0>=0) return 1.2139;
        return 0;
    }
    
    function getK3(&$data) {
        global $db;
        $deductibles_id = $data['deductibles_id'];
        if (!$deductibles_id) return 0;
        $deductibles = $db->getRow('SELECT * FROM insurance_product_deductibles WHERE id='.intval($deductibles_id), 10600);
        $value0 = $deductibles['value1'];
        if ($value0==NULL) return 0;
        if ($value0>=10) return 0.9537;
        if ($value0>=7) return 1;
        if ($value0>=5) return 1.1537;
        if ($value0>=2) return 1.9229;
        //if ($value0>=0) return 1.6;
        return 0;
    }
    
    
    //13    3   Зона 1 - Киев, Днепропетровск, Донецк, Одесса, Хар...
    //14    3   Зона 2 - Винница, Луцк, Житомир, Ужгород, Запорожь...
    //15    3   Зона 3 - Другие населенные пункты
    function getK4(&$data) {
        global $db;
        $registration_cities_id = $data['registration_cities_id'];
        if (!$registration_cities_id) return 0;
        $regions_kasko_retail_id =  $db->getOne('SELECT regions_kasko_retail_id FROM insurance_cities WHERE id='.intval($registration_cities_id), 10600);
        if ($regions_kasko_retail_id==13) return 1;
        if ($regions_kasko_retail_id==14) return 0.95;
        if ($regions_kasko_retail_id==15) return 0.9;
        return 0;
    }   
    
    
    function getK5(&$data) {
        global $db;
        if (isset($data['person_types_id'])) $insurer_person_types_id = $data['person_types_id'];
        else $insurer_person_types_id = $data['insurer_person_types_id'];
        if (!$insurer_person_types_id) return 0;
        
        if ($insurer_person_types_id==1) return 1;
        if ($insurer_person_types_id==2) return 0.96;       
        return 0;
    
    }
    
    function getK6(&$data) {
        global $db;
        if ($data['options_taxy']) return 2;
        if (isset($data['person_types_id'])) $insurer_person_types_id = $data['person_types_id'];
        else $insurer_person_types_id = $data['insurer_person_types_id'];
        if ($insurer_person_types_id==1) return 1;
        if ($insurer_person_types_id==2 && $data['drivers_id']==6) return 0;
        if ($insurer_person_types_id==2 && $data['use_as_car_private']>0) return 0;
        if ($data['use_as_car_work']>0) return 0.95;
        return 1;
    }
    
    function getK7(&$data) {
        if ($data['residences_id']==1)  return 1;//стоянка що охороняється
        return 1;
    }
    
    function getK8(&$data) {
        if ($data['drivers_id']==7) return 1;
        if ($data['driver_ages_id'] ==1) return 1.1;//до 25 років
        if ($data['driver_ages_id'] ==2) return 1;//25-65 років
        if ($data['driver_ages_id'] ==3) return 1.05;//більше 65 років
        
    }
    
    function getK9(&$data) {


        if ($data['protection_multlock'] || $data['protection_immobilaser'] || $data['protection_manual'] || $data['protection_signalling'] || intval($data['no_immobiliser'])==0) {
            return  1;
        } else {
            return 1.06;
        }
    }
    
    function getK9Season(&$data) {


        if ($data['protection_multlock'] || $data['protection_immobilaser'] || $data['protection_manual'] || $data['protection_signalling'] || intval($data['no_immobiliser'])==0) {
            return  1;
        } else {
            return 1.15;
        }
    }
    
    function getK10(&$data) {
        
        if (isset($data['person_types_id'])) $insurer_person_types_id = $data['person_types_id'];
        if ($insurer_person_types_id==2 && $data['options_workers_list']>0) return 0.97;//Водії підприємства (для Юр.осіб) ??
        if ($data['drivers_id']==7) return 1;
        else $insurer_person_types_id = $data['insurer_person_types_id'];
        
        return 0.9;
        
    }
    
    function getK11(&$data) {
        if ($data['zones_id'] == 1) return 1; //Україна
        if ($data['zones_id'] == 3 || $data['zones_id'] == 4) return 1.1;//Україна+Європа   Україна+СНД+Європа
        if ($data['zones_id'] == 2) return 1.05;//Україна+СНД
        return 0;
    }
    function getK12(&$data) {
        if ($data['drivers_id']==7) return 1;
        if ($data['driver_standings_id']==1) return 1.05;//меньше 1 року
        if ($data['driver_standings_id']==2) return 1.05;//від 1 до 3 років
        if ($data['driver_standings_id']==3) return 1;//від 3 до 10 років
        if ($data['driver_standings_id']==4) return 1;//більше 10 років
    
    }
    
    function getK13(&$data) {
        
        if ($data['options_deterioration_no']==1) {
            $data['car_years_id']    = ParametersCarYears::getIdByYear(PRODUCT_TYPES_KASKO, intval($data['year']));
            if ($data['car_years_id']==1) return 1;
            if ($data['car_years_id']==2) return 1;
            if ($data['car_years_id']==3) return 1;
            if ($data['car_years_id']==4) return 1.1;
            if ($data['car_years_id']==5) return 1.15;
            if ($data['car_years_id']==6) return 1.4;
            if ($data['car_years_id']==7) return 1.4;
            if ($data['car_years_id']==8) return 1.4;
            if (intval($data['car_years_id'])==0) return 0;
        }
        return 1;
        
    }
    
    function getK14(&$data) {
        return 1;
        if ($data['payment_brakedown_id']==1) return 1;
        if ($data['payment_brakedown_id']==2) return 1.05;
        if ($data['payment_brakedown_id']==3) return 1.1;
    }
    
    
    function getK15(&$data) {
        return 1;
        /*$data['car_years_id']    = ParametersCarYears::getIdByYear(PRODUCT_TYPES_KASKO, intval($data['year']));
        if ($data['car_years_id']==1) return 1;
        if ($data['car_years_id']==2) return 1;
        if ($data['car_years_id']==3) return 1.05;
        if ($data['car_years_id']==4) return 1.05;
        if ($data['car_years_id']==5) return 1.05;
        if ($data['car_years_id']==6) return 1.1;
        if ($data['car_years_id']==7) return 1.1;
        if ($data['car_years_id']==8) return 1.1;
        return 0;*/
    }
    
    function getK16(&$data) {
        if ($data['options_agregate_no']==1) return 1.15;
        return 1;
    }
    
    function getK17(&$data) {
        return 1;
    }
    
    function getK18(&$data) {
        if ($data['terms_id'] ==41) return 0.29; //1 місяць
        if ($data['terms_id'] ==42) return 0.41; //2 місяці
        if ($data['terms_id'] ==26) return 0.5; //3 місяці
        if ($data['terms_id'] ==43) return 0.58; //4 місяці
        if ($data['terms_id'] ==44) return 0.65; //5 місяців
        if ($data['terms_id'] ==27) return 0.71; //6 місяців
        if ($data['terms_id'] ==45) return 0.76; //7 місяців
        if ($data['terms_id'] ==46) return 0.82; //8 місяців
        if ($data['terms_id'] ==28) return 0.87; //9 місяців
        if ($data['terms_id'] ==47) return 0.91; //10 місяців
        if ($data['terms_id'] ==48) return 0.96; //11 місяців
        if ($data['terms_id'] ==29) return 1; //1 рік
        return 0; 
    
    }
    
    function getK19(&$data) {
        if (!is_array($data['risks'])) return 1;
        $s = 0;
        if (in_array(RISKS_DTP, $data['risks']))   $s += 0.815;
        if (in_array(RISKS_PDTO, $data['risks']))   $s += 0.05;
        if (in_array(RISKS_ACTOFGOD, $data['risks']))   $s += 0.02;
        if (in_array(RISKS_HIJACKING1, $data['risks']))   $s += 0.065;      
        if (in_array(RISKS_FIRE1, $data['risks']))   $s += 0.03;
        if (in_array(RISKS_ANIMAL, $data['risks']))   $s += 0.01;
        if (in_array(RISKS_DOWNFALL, $data['risks']))   $s += 0.01;
        return $s;
    }
    
    function getP1(&$data) {
        if (!is_array($data['risks'])) return 0;
        if (in_array(RISKS_HIJACKING1, $data['risks']))   return 0.065;
        return 0;
    }
    
    function getP2(&$data) {
        return 0.815;
    }
    
    function getP3(&$data) {
        if (!is_array($data['risks'])) return 0;
        if (in_array(RISKS_PDTO, $data['risks']))   return 0.05;
        return 0;
    }
    
    function getP4(&$data) {
        if (!is_array($data['risks'])) return 0;
        if (in_array(RISKS_ACTOFGOD, $data['risks']))   return 0.02;
        return 0;
    }
    
    function getP5(&$data) {
        if (!is_array($data['risks'])) return 0;
        if (in_array(RISKS_FIRE1, $data['risks']))   return 0.03;
        return 0;
    }
    
    function getP6(&$data) {
        if (!is_array($data['risks'])) return 0;
        if (in_array(RISKS_ANIMAL, $data['risks']))   return 0.01;
        return 0;
    }
    
    function getP7(&$data) {
        if (!is_array($data['risks'])) return 0;
        if (in_array(RISKS_DOWNFALL, $data['risks']))   return 0.01;
        return 0;
    }
    
    function getK20(&$data) {
        if ($data['options_deductible_glass_no']) return 1.1;
        return 1;
    }
    
    function getK21(&$data) { 
//_dump($data['bonus_malus']);
        if ($data['bonus_malus']>1)
            $bonus_malus =0;
        else    
            $bonus_malus = (1-doubleval($data['bonus_malus']))*100;
        $cart_discount = doubleval($data['cart_discount']);
        $discount= doubleval($data['discount']);
        $discount =  $bonus_malus+$cart_discount;

        if ($discount>15) {
            $discount = 15; 
            return (100-$discount-doubleval($data['discount']))/100*($data['bonus_malus']>1 ? $data['bonus_malus'] : 1);//учитываем бонус малус карточку и скидку за счет менеджера
        }   
        else 
        return (100-$cart_discount-doubleval($data['discount']))/100*doubleval($data['bonus_malus']);//учитываем бонус малус карточку и скидку за счет менеджера
    }   
    
    function getK22(&$data) {
        if ($data['options_fifty_fifty']) return 0.55;
        return 1;
    }
    
    function getK23(&$data) {
        $commission_agent_percent = 30;
        $k =1/(100-$commission_agent_percent)*100;
        return $k;
    }
    
    function getK24(&$data) {
        //return 1;
        if (!$data['special_car_value']) $data['special_car_value'] = 1.1;
        return $data['special_car_value'];
    }
    function getK24Vip(&$data) {
        if ($data['priority_payments_id']==2) return 0;
        if (!$data['special_car_value']) $data['special_car_value'] = 1.1;
        return $data['special_car_value'];
    }
    
    
    function getBt(&$data)
    {
        if ($data['car_types_id']==8) return 3.99; //Легкові автомобілі та мінівени (B)
        if ($data['car_types_id']==9) return 1.9; //Вантажні автомобілі (C)
        if ($data['car_types_id']==11) return 3.99; //Мікроавтобуси та вантажопасажирські автомобілі (V)
        if ($data['car_types_id']==12) return 2.5; //Автобуси (D)
        if ($data['car_types_id']==14) return 1.25; //Причепи та напівпричепи для вантажних авто (F)
        if ($data['car_types_id']==15) return 1.25; //Технологічний транспорт та транспорт для с/г виробництва (T)
        if ($data['car_types_id']==27) return 1.25; //Причепи та напівпричепи для легкових авто (E)
        if ($data['car_types_id']==28) return  0; //Мотоцикли, моторолери, мопеди (A)
        return 0;
        
        
    }
    
    function getLimits($rate)
    {
        if ($data['car_types_id']==8 && $rate<1.92) return 1.92; //Легкові автомобілі та мінівени (B)
        if ($data['car_types_id']==9 && $rate<1.38) return 1.38; //Вантажні автомобілі (C)
        if ($data['car_types_id']==11 && $rate<1.92) return 1.92; //Мікроавтобуси та вантажопасажирські автомобілі (V)
        if ($data['car_types_id']==12 && $rate<1.1) return 1.1; //Автобуси (D)
        if ($data['car_types_id']==14 && $rate<0.9) return 0.9; //Причепи та напівпричепи для вантажних авто (F)
        if ($data['car_types_id']==15 && $rate<0.9) return 0.9; //Технологічний транспорт та транспорт для с/г виробництва (T)
        if ($data['car_types_id']==27 && $rate<0.9) return 0.9; //Причепи та напівпричепи для легкових авто (E)
        return $rate;
        
        
    }
    
    /*
    *Расчет по новым тарифам
    */

    function calculateDucatiKaskoRitale($data, $data1)
    {
        $formula = 
        '('.$data['base_rate_dtp'].'+'.$data['base_rate_hijacking'].'+'.$data['base_rate_pdto'].'+'.$data['base_rate_fire'].'+'.$data['base_rate_actofgod'].'+'.$data['base_rate_downfall'].'+'.$data['base_rate_animal'].')'.
        '*'.$data['deductibles_value_other'].'*'.$data['deductibles_value_hijacking'].'*'.$data['driver_standings_value'].'*'.$data['driver_ages_value'].'*'. $this->getDucatiK4($data, $data1) .'*'.$this->getDucatiK5($data, $data1).
        '*'.$this->getDucatiK6($data, $data1).'*'.$this->getDucatiK7($data, $data1).'*'.$this->getDucatiK9($data, $data1).'*'.$this->getDucatiK11($data, $data1).'*'.$this->getDucatiK12($data, $data1).'*'.$this->getDucatiK13($data, $data1).'*'.$this->getDucatiK14($data, $data1).
        '-((0,4615*50000)/'.$data['price'].')';

        $bt = 
        ($data['base_rate_dtp']+$data['base_rate_hijacking']+$data['base_rate_pdto']+$data['base_rate_fire']+$data['base_rate_actofgod']+$data['base_rate_downfall']+$data['base_rate_animal'])
        *$data['deductibles_value_other'] * $data['deductibles_value_hijacking']*$data['driver_standings_value']*$data['driver_ages_value']*floatval($this->getDucatiK4($data, $data1))
        *floatval($this->getDucatiK5($data, $data1))*floatval($this->getDucatiK6($data, $data1))*floatval($this->getDucatiK7($data, $data1))*floatval($this->getDucatiK9($data, $data1))*floatval($this->getDucatiK11($data, $data1))*floatval($this->getDucatiK12($data, $data1))*floatval($this->getDucatiK13($data, $data1))*floatval($this->getDucatiK14($data, $data1))*floatval($this->getDucatiK16($data, $data1))-
        ((0.4615*50000)/$data['price']);

        return array('result' => floatval($bt), 'formula' => $formula);
    }

    function calculateRitale($data) {
        $formula =    
            '( (('.$this->getBt($data).' * '.$this->getK1($data).' * ('.$this->getP2($data).' + '.$this->getP3($data).' + '.$this->getP4($data).' + '.$this->getP5($data).' + '.$this->getP6($data).' + '.$this->getP7($data).')) * '.$this->getK2($data).' ) + (('.$this->getBt($data).' * '.$this->getK1($data).' * '.$this->getP1($data).') * '.$this->getK3($data).')) * '.$this->getK4($data).' * '.$this->getK5($data).' * '.$this->getK6($data).' * '.$this->getK7($data).' * '.$this->getK8($data).' * '.$this->getK9($data).' * '.$this->getK10($data).' * '.$this->getK11($data).' * '.$this->getK12($data).' * '.$this->getK13($data).' * '.$this->getK14($data).' * '.$this->getK15($data).' * '.$this->getK16($data).' * '.$this->getK17($data).' * '.$this->getK18($data).'  * '.$this->getK20($data).' * '.$this->getK21($data).' * '.$this->getK22($data) .' * '.$this->getK23($data).' * '.$this->getK24($data)
            ;
//_dump($this->getK21($data));
//_dump($this->getK13($data));

        $bt = ( (($this->getBt($data) * $this->getK1($data) * ($this->getP2($data) + $this->getP3($data) + $this->getP4($data) + $this->getP5($data) + $this->getP6($data) + $this->getP7($data))) * $this->getK2($data) ) + (($this->getBt($data) * $this->getK1($data) * $this->getP1($data)) * $this->getK3($data))) * $this->getK4($data) * $this->getK5($data) * $this->getK6($data) * $this->getK7($data) * $this->getK8($data) * $this->getK9($data) * $this->getK10($data) * $this->getK11($data) * $this->getK12($data) * $this->getK13($data) * $this->getK14($data) * $this->getK15($data) * $this->getK16($data) * $this->getK17($data) * $this->getK18($data)  * $this->getK20($data) * $this->getK21($data) * $this->getK22($data) * $this->getK24($data) ;
        return array('result'=>$this->getLimits($bt) *$this->getK23($data), 'formula'=>$formula);
    }
    
    function calculateSeasonRitale($data) {
        $formula =    
            '(('.$this->getBt($data).' * '.$this->getK1($data).' * 0.8  * '.$this->getK2($data).') + ('.$this->getBt($data).' * '.$this->getK1($data).' * 0.2 * '.$this->getK3($data).')) *0.82 * '.$this->getK14($data).' * '.$this->getK4($data).' * '.$this->getK13($data).' * '.$this->getK9Season($data).' * '.$this->getK23($data).' * '.$this->getK24($data)
            ;
            
        $bt = (($this->getBt($data) * $this->getK1($data) * 0.8 * $this->getK2($data)) + ($this->getBt($data) * $this->getK1($data) * 0.2 * $this->getK3($data))) *0.82 * $this->getK14($data) * $this->getK4($data) * $this->getK13($data) * $this->getK9Season($data) * $this->getK24($data);
        return array('result'=>$this->getLimits($bt) *$this->getK23($data), 'formula'=>$formula);
    }
    
    function calculatePremiumRitale($data) {
        global $db;
        $k21 = $this->getK21($data);
        
        if ($data['parent_id']>0) {
            $express_products_id = $db->getOne('SELECT express_products_id FROM  insurance_policies_kasko WHERE policies_id='.$data['parent_id']);
            if ($express_products_id==140) $k21 = 1; //если пред полис был тоже премиум то бонус малуса нет
        }
        if ($k21<1) $k21 = 1;
        
        
        $data['car_years_id']    = ParametersCarYears::getIdByYear(PRODUCT_TYPES_KASKO, intval($data['year']));
        if ($data['car_years_id']>3) $k15=0; else $k15=1;
        
        $formula =    
            ' '.$this->getK1Premium($data).' * '.$this->getK4($data).'* '.$k15.' *  '.$this->getK24($data). ' * '.$k21  ;
//_dump($formula)           ;exit;
        $bt = $this->getK1Premium($data) * $this->getK4($data) *  $k15 * $this->getK24($data) * $k21;
        return array('result'=>$bt , 'formula'=>$formula);

    }
    
    
    
    function calculateSTORitale($data) {

        $formula =    
            ' '.$this->getK1STO($data).' * '.$this->getK11($data).'* '.$this->getK24($data) ;
            
        $bt = $this->getK1STO($data) * $this->getK11($data)*$data['car_years_value']*$this->getK24($data);
        return array('result'=>$bt , 'formula'=>$formula);

    }
    
    function calculateMiniRitale($data) {
        if ($data['price'] && $data['deductiblesOther']) {
            if (intval($data['price']!=50000) && intval($data['price']!=20000) && intval($data['price']!=10000)) {
                return array('result'=>0 , 'formula'=>0);
            }
            if (intval($data['price']==50000) && intval($data['deductiblesOther'])!=8000)
                return array('result'=>0 , 'formula'=>0);
            if (intval($data['price']==20000) && intval($data['deductiblesOther'])!=4000)
                return array('result'=>0 , 'formula'=>0);
            if (intval($data['price']==10000) && intval($data['deductiblesOther'])!=2500)
                return array('result'=>0 , 'formula'=>0);
        }
        
    
        $formula =    
            ' 2.2 ' ;
            
        $bt = 2.2 * $data['car_years_value'];
        return array('result'=>$bt , 'formula'=>$formula);

    }
    
    function calculateVIPRitale($data) {

        $formula =    
            ' '.$this->getK1VIP($data).'* '.$this->getK24Vip($data) ;
            
        $bt = $this->getK1VIP($data)*$data['car_years_value']*$this->getK24Vip($data);
        return array('result'=>$bt , 'formula'=>$formula);

    }
    function exportInWindow($data) {
        global $db, $Smarty;

        $this->checkPermissions('export', $data);

        $sql    = 'select * from insurance_products a join insurance_products_kasko b on b.products_id=a.id ';
        $list   = $db->getAll($sql);


        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        include($this->object . '/export.tpl');
        exit;
    }
    
     function filterSearchResult($list) {

      foreach ($list as $i1 => $values1) {
       foreach ($list as $i2 => $values2) {
        if ($values1['rate_kasko'] == $values2['rate_kasko'] && $i1 <> $i2) {
         if ($values1['deductiblesOther'] < $values2['deductiblesOther']) {
          unset($list[ $i2 ]);
         } else if ($values1['deductiblesOther'] > $values2['deductiblesOther']) {
          unset($list[ $i1 ]);
         } else if ($values1['deductiblesHijacking'] < $values2['deductiblesHijacking']) {
          unset($list[ $i2 ]);
         } else if ($values1['deductiblesHijacking'] > $values2['deductiblesHijacking']) {
          unset($list[ $i1 ]);
         }
        }
       }
      }
      return $list;
    }

    /*
     *  расчет обновленной страховой премии при изменении страховой суммы
     *  $data['id'] - договор с которого хотим пролонгироваться
     *  $data['car_price'] - новая стоимость авто
    */
    function calculateRenewInsuranceAmountInWindow($data) {
        global $db;
        //проверяем на многолетний
        $r = $db->getRow('SELECT a.*,b.parent_id,b.agreement_types_id,IF(YEAR(a.date)>YEAR(b.begin_datetime),1,0) as next_year FROM insurance_policies_kasko_item_years_payments a JOIN  insurance_policies b on b.id=a.policies_id WHERE a.policies_id='. intval($data['id']).' AND a.date<NOW() ORDER BY a.date DESC LIMIT 1'); 
        $fifty_fifty = intval($db->getOne('SELECT options_fifty_fifty FROM insurance_policies_kasko WHERE policies_id= '.intval($data['id'])));
        $options_agregate_no = intval($db->getOne('SELECT options_agregate_no FROM insurance_policies_kasko WHERE policies_id= '.intval($data['id'])));

        //start period
        if ($r['date'])
            $start_period = $r['date'];
        else    
            $start_period = $db->getOne('SELECT begin_datetime FROM  insurance_policies WHERE  id   ='. intval($data['id']).' ');
        $start_period = $db->quote($start_period);

        //end period
        $end_period = $db->getOne('SELECT date FROM  insurance_policies_kasko_item_years_payments WHERE date>NOW() AND date>'.$start_period.' AND policies_id   ='. intval($data['id']).' ORDER BY date LIMIT 1 ');
        if (!$end_period) $end_period = $db->getOne('SELECT end_datetime FROM  insurance_policies WHERE  id ='. intval($data['id']).' ');
        $end_period = $db->quote($end_period);

        $period_days =  $db->getOne('SELECT DATEDIFF('.$end_period.' , '.$start_period.') '); //кол дней в периоде страхования

        if (intval($r['next_year'])==0)  {//однолетний договор в insurance_policies_kasko_item_years_payments нет записей или только 1-й год идет
            $sql =  'SELECT DATEDIFF(NOW(), begin_datetime)  AS useddays FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['id']);
            $useddays = intval($db->getOne($sql));
            if ($useddays<0) $useddays = 0;
            //_dump($useddays);_dump(   $period_days );
            $restdays = $period_days - $useddays;
            //выплаты по урегулированию дела
            $begin_date = $db->quote($db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['id'])));
            $end_date = 'NOW()';
     
           if ($options_agregate_no) {
                $payedAmount = 0;
            } else {
                $sql = 'SELECT SUM(c.amount) FROM insurance_accidents b   JOIN insurance_accident_payments_calendar c ON b.id = c.accidents_id WHERE c.payment_statuses_id>1 AND b.policies_id = ' . intval($data['id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND ' . $end_date . ' AND c.payment_types_id IN (5,6)   ';
                $payedAmount = doubleval($db->getOne($sql));
                if ($data['id'] == 237864) $payedAmount += 5534.11;
//$payedAmount += 5642.98;
            }
//_dump($sql);
            if (!$r) $r = $db->getRow('SELECT *,id as policies_id FROM insurance_policies WHERE id='. intval($data['id']));
            if ($r['agreement_types_id']==3) //делаем доп угоду на востановление из другой доп угоды значит тариф взять из парента
            {
                $new_rate_kasko = doubleval($db->getOne('SELECT rate_kasko FROM  insurance_policies_kasko_items WHERE policies_id='.intval($r['parent_id'])));
            }
            else { //взять текущий рабочий тариф из того договора из которого делаем допку
                $new_rate_kasko = doubleval($db->getOne('SELECT rate_kasko FROM  insurance_policies_kasko_items WHERE policies_id='.intval($r['policies_id'])));
            }   

            $old_car_price = doubleval($db->getOne('SELECT car_price FROM  insurance_policies_kasko_items WHERE policies_id='.intval($r['policies_id'])));
            if ($fifty_fifty && $payedAmount>0) $new_rate_kasko *=2; //если были выплаты и 50/50 то тариф увеличиваем
            $restoreAmount1 = round($new_rate_kasko *doubleval($payedAmount)/100*($period_days - $useddays)/365,2);//сумма к востановлению за выплаты по ДТП
            $restoreAmount2 = 0;//сумма если  увеличили стоимость авто от начальной
            if ((doubleval($data['car_price']) - $old_car_price)>2) //цена выросла
            {
                $payedAmount = doubleval($data['car_price']) - $old_car_price; //на сколько выросла цена

                $restoreAmount2 = round($new_rate_kasko *doubleval($payedAmount)/100*($period_days- $useddays)/365,2);//сумма к востановлению за увеличение стоимости авто
            }
        }
        else { //начался следущий год по договору
            $new_rate_kasko = $r['rate_kasko'];
            $old_car_price = $r['item_price'];
            
            $sql =  'SELECT DATEDIFF(NOW(), '.$db->quote($r['date']).')  AS useddays FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['id']);
            
            $useddays = intval($db->getOne($sql));
            $restdays = $period_days - $useddays;
            //выплаты по урегулированию дела
            $begin_date = $db->quote($r['date']);
            $end_date = 'NOW()';

            if ($options_agregate_no) {
                $payedAmount = 0;
            } else {
                $sql = 'SELECT SUM(c.amount) FROM  insurance_accidents b JOIN insurance_accident_payments_calendar c ON b.id = c.accidents_id WHERE c.payment_statuses_id>1 AND b.policies_id = ' . intval($data['id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND ' . $end_date . ' AND c.payment_types_id IN (5,6)  ';
                $payedAmount = doubleval($db->getOne($sql));
                if ($data['id'] == 237864) $payedAmount += 5534.11;
//$payedAmount += 5642.98;
            }

            if ($fifty_fifty && $payedAmount>0) $new_rate_kasko*=2;
            
            $restoreAmount1 = round($new_rate_kasko*doubleval($payedAmount)/100*($period_days - $useddays)/365,2);
            
            $restoreAmount2 = 0;//сумма если  увеличили стоимость авто от начальной
            if ((doubleval($data['car_price']) - $old_car_price)>2) //цена выросла
            {
                $payedAmount = doubleval($data['car_price']) - $old_car_price; //на сколько выросла цена
                $restoreAmount2 = round($new_rate_kasko *doubleval($payedAmount)/100*($period_days - $useddays)/365,2);//сумма к востановлению за увеличение стоимости авто
            }
        }
        $new_rate_kasko  = round(($restoreAmount1+$restoreAmount2)/$data['car_price']*100,3);
        $new_amount_kasko = round($new_rate_kasko * $data['car_price']/100,2);
        echo '{"rate_kasko":"' . $new_rate_kasko. '","amount_kasko":'.$new_amount_kasko.'}';
        exit;
    }
}

?>