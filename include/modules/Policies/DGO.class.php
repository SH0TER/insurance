<?
/*
 * Title: policy GO class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */


class Policies_DGO extends Policies {

    var $formDescription =
            array(
                'fields'    =>
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
                            'orderPosition'     => 15,
                            'table'             => 'policies',
                            'sourceTable'       => 'agencies',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'agents_id',
                            'description'       => 'Агент',
                            'type'              => fldSelect,
                            'conditon'          => 'roles_id = 8',
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
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'id'),
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
                            'name'              => 'products_id',
                            'description'       => 'Продукт',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'person_types_id',
                            'description'       => 'Тип особи',
                            'showId'               => true,
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              =>  'go_insurance_company_id',
                            'description'       =>  'Страхова компанія',
                            'type'              =>  fldSelect,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  true,
                                    'view'      =>  true,
                                    'update'    =>  true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  false
                                ),
                            'table'             =>  'policies_dgo',
                            'condition'         =>  'dgo = 1',
                            'sourceTable'       =>  'companies_mtsbu',
                            'selectField'       =>  'title',
                            'orderField'        =>  'title'),
                        array(
                            'name'              => 'go_begin_datetime',
                            'description'       => 'Початок дії полісу ОСЦПВ',
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
                            'orderPosition'     => 8,
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'go_end_datetime',
                            'description'       => 'Закінчення дії полісу ОСЦПВ',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'car_types_id',
                            'description'       => 'Тип ТЗ',
                            'type'              => fldSelect,
                            'showId'               => true,
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
                            'table'             => 'policies_dgo',
                            'condition'         => 'product_types_id = 7',
                            'sourceTable'       => 'car_types',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'brand',
                            'description'       => 'Марка, текст',
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'model',
                            'description'       => 'Модель, текст',
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'go_series',
                            'description'       => 'Серія поліса',
                            'type'              => fldText,
                            'maxlength'         => 2,
                            'validationRule'    => '^(АА|ВА|ВВ|ВС|ВЕ|АВ|АЕ|АС|АІ|АК)$',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'go_number',
                            'description'       => 'Номер поліса',
                            'type'              => fldText,
                            'maxlength'         => 7,
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              =>  'insurance_price_id',
                            'description'       =>  'Страхова сума, грн.',
                            'type'              =>  fldSelect,
                            'display'           =>
                                array(
                                    'show'      =>  false,
                                    'insert'    =>  true,
                                    'view'      =>  true,
                                    'update'    =>  true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  false
                                ),
                            'table'             => 'policies_dgo',
                            'condition'         => 'product_types_id = 7',
                            'sourceTable'       => 'parameters_insurance_price',
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
                            'orderPosition'     => 7,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'rate',
                            'description'       => 'Тариф, %',
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
                            'table'             => 'policies'),
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_edrpou',
                            'description'       => 'ІПН (ЄДРПОУ)',
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_lastname',
                            'description'       => 'Прізвище',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_firstname',
                            'description'       => 'Ім\'я',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_patronymicname',
                            'description'       => 'По батькові',
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_dateofbirth',
                            'description'       => 'Дата народження',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_passport_series',
                            'description'       => 'Паспорт, серія',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_passport_number',
                            'description'       => 'Паспорт, номер',
                            'type'              => fldText,
                            'maxlength'         => 13,
                            //'validationRule'  => '^([0-9]{6}|[0-9]{6}\/[0-9]{6})$',
                            'display'           => 
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_passport_place',
                            'description'       => 'Паспорт. Ким і де виданий',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_passport_date',
                            'description'       => 'Паспорт. Дата видачі',
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
                        /*array(
                            'name'              => 'insurer_driver_licence_series',
                            'description'       => 'Водійські права, серія',
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
                            'table'             => 'policies_dgo'),*/
                        /*array(
                            'name'              => 'insurer_driver_licence_number',
                            'description'       => 'Водійські права, номер',
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
                            'table'             => 'policies_dgo'),*/
                        /*array(
                            'name'              => 'insurer_driver_licence_date',
                            'description'       => 'Водійські права, дата',
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
                            'table'             => 'policies_dgo'),*/
                        array(
                            'name'              => 'insurer_identification_code',
                            'description'       => 'ІПН',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_phone',
                            'description'       => 'Телефон',
                            'type'              => fldText,
                            //'validationRule'  => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_email',
                            'description'       => 'E-mail',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_zip',
                            'description'       => 'Індекс',
                            'type'              => fldText,
                            'validationRule'    => '^[0-9]{5}$',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_regions_id',
                            'description'       => 'Область',
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
                            'table'             => 'policies_dgo',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_city',
                            'description'       => 'Місто',
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo',
                            'sourceTable'       => 'street_types',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'insurer_street',
                            'description'       => 'Вулиця',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_house',
                            'description'       => 'Будинок',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'insurer_flat',
                            'description'       => 'Квартира',
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
                            'table'             => 'policies_dgo'),
                        array(
                            'name'              => 'shassi',
                            'description'       => '№ шасі (кузов, рама)',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
                       
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
                            'orderPosition'     => 8,
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
                            'orderPosition'     => 9,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'policy_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldSelect,
                            'showId'               => true,
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
                            'orderPosition'     => 10,
                            'table'             => 'policies',
                            'sourceTable'       => 'policy_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'payment_statuses_id',
                            'description'       => 'Оплата',
                            'type'              => fldSelect,
                            'showId'               => true,
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
                            'orderPosition'     => 11,
                            'table'             => 'policies',
                            'sourceTable'       => 'payment_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
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
                            'table'             => 'policies_dgo'),
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
                            'table'             => 'policies_dgo'),
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dgo'),
                            
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dgo'),
                            
                            
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dgo'),
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_dgo'), 
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
                            'table'             => 'policies_dgo'),     
                            
                        array(
                            'name'              => 'sign_agents_id',
                            'description'       => 'Пiдпис договору КАСКО',
                            'type'              => fldSelect,
                            'showId'            => true,
                            'selectId'          =>'id',
                            'condition'         => 'roles_id = 8',
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
                            'table'             => 'policies_dgo',
                            'sourceTable'       => 'accounts',
                            'condition'         => 'LENGTH(director1)>0 AND LENGTH(director2)>0',
                            'selectField'       => 'CONCAT(lastname, \' \', firstname, \' \', patronymicname)',
                            'orderField'        => 'lastname'),
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
                            'orderPosition'     => 12,
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
                            'orderPosition'     => 13,
                            'table'             => 'policies'),
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
                            'orderPosition'     => 14,
                            'width'             => 100,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'comment',
                            'description'       => 'Особливі умови',
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
                        'defaultOrderPosition'  => 14,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'number'
                    )
                );

    function Policies_DGO($data) {
        Policies::Policies($data);

        $this->objectTitle = 'Policies_DGO';

        $this->messages['plural'] = 'Поліси "ДСЦВ"';
        $this->messages['single'] = 'Поліс "ДСЦВ"';

        $this->setPolicyStatusesSchema();
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'                  => true,
                    'insert'                => false,
                    'update'                => true,
                    'view'                  => true,
                    'change'                => true,
                    'reset'                 => true,
                    'export'                => true,
                    'exportActions'         => true,
                    'payments'              => true,
                    'delete'                => true,
                    'changeServicePerson'   => true,
                    'renewPolicy'           => false,
                    'transfer'              => true,
                    'continuePolicy'        => false,
                    'cancelPolicy'          => false);
                break;
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
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
                    'renewPolicy'           => true,
                    'continuePolicy'        => true,
                    'cancelPolicy'          => true);

                $this->formDescription['fields'][ $this->getFieldPositionByName('documents') ]['display']['change'] = false;
                $this->formDescription['fields'][ $this->getFieldPositionByName('commission') ]['display']['change'] = false;

                break;
        }
    }

    //схема смены статусов для сертификатов
    function setPolicyStatusesSchema($roles_id =null) {
        global $POLICY_STATUSES_SCHEMA;

        $POLICY_STATUSES_SCHEMA = array(
            POLICY_STATUSES_CONSULTATION =>
                array(
                    POLICY_STATUSES_CONSULTATION,
                    POLICY_STATUSES_CREATED,
                    POLICY_STATUSES_GENERATED),
            POLICY_STATUSES_CREATED =>
                array(
                    POLICY_STATUSES_CREATED,
                    POLICY_STATUSES_GENERATED),
            POLICY_STATUSES_GENERATED =>
                array(
                    POLICY_STATUSES_GENERATED));
    }

    function buildSelect($field, $value, $languageCode=null, $addition=null, $indexType=null, $data=null) {
        global $db;

       $result = '';

       if  ($field['name'] == 'registration_cities_id') {

           $conditions[] = 'product_types_id = ' . PRODUCT_TYPES_AUTO;

            $sql =  'SELECT a.title, b.id as cities_id, b.title as citiesTitle ' .
                    'FROM ' . PREFIX . '_parameters_regions as a ' .
                    'JOIN ' . PREFIX . '_cities as b ON a.id = b.regions_id ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' ' .
                    'ORDER BY a.order_position, b.title';
            $list = $db->getAll($sql, 300);

            if (is_array($list)) {
                $result .= '<select id="' . ereg_replace('\[|\]', '', $field['name'] . $languageCode) . '" name="' . $field['name'] . $languageCode . '" ' . $addition . ' ' . $field['javascript'] . ' class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';

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
           $result = parent::buildSelect($field, $value, $languageCode, $addition, $indexType, $data);
            if  ($field['name'] == 'sign_agents_id') {
                $result = str_replace ( '...' , 'директор підприємства' , $result );
            }
       }

       return $result;
    }

    function setConstants(&$data) {
        parent::setConstants($data);

        $data['shassi'] = fixShassiSimbols($data['shassi']);
        $data['sign']   = fixSignSimbols($data['sign']);

        $unsetFields = array();

        switch (intval($data['person_types_id'])) {
            case 1://физ. лицо
                $unsetFields = array(
                    'insurer_company',
                    'insurer_edrpou',
                    'insurer_bank',
                    'insurer_bank_mfo',
                    'insurer_bank_account',
                    'insurer_position',
                    'insurer_ground',
                    'insurer_driver_licence_series',//
                    'insurer_driver_licence_number',//
                    'insurer_driver_licence_date');//
                break;
            case 2://юр. лицо
                $unsetFields = array(
                    'insurer_identification_code',
                    'insurer_dateofbirth',
                    'insurer_passport_series',
                    'insurer_passport_number',
                    'insurer_passport_place',
                    'insurer_passport_date',
                    'insurer_driver_licence_series',
                    'insurer_driver_licence_number',
                    'insurer_driver_licence_date',

                    'insurer_newpassport_number',
                    'insurer_newpassport_place',
                    'insurer_newpassport_date',
                    'insurer_newpassport_reestr',
                    'insurer_newpassport_dateEnd');
                break;
        }

        foreach($unsetFields as $field) {
            $data[ $field ] = '';
            $this->formDescription['fields'][ $this->getFieldPositionByName($field) ]['verification']['canBeEmpty'] = true;
        }

        $data['go_series'] = replaceLatinToRussian($data['go_series']);

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
        
        $Products = Products::factory($data, 'DGO');
        $Products->calculate($data['insurance_price_id'], $data);
    }
    
    
    //добавление нового полиса
    function add($data) {
        global $db;

         
        if ($data['load_id']) {
            $l = $db->getRow('SELECT * FROM insurance_policies WHERE id = '.intval($data['load_id']));
            if ($l) {
                $data['go_insurance_company_id'] = 505;
                $policy = Policies::factory($l);
                $policy->checkPermissions('view', $l );
                $row = $policy->view($l, false);
                $data['go_series'] = $row['blank_series'];
                $data['go_number'] = $row['blank_number'];
            }
        }
        parent::add($data);
    }

    function checkFields($data, $action) {
        global $db, $Log;

        parent::checkFields($data, $action);

        if ($data['commission_agency_percent'] > 0) {
            if (!$this->isValidPercent($data['commission_agency_percent'])) {
                $params = array('Комісія. Агенція. Розмір комісії, %', '');
                $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
            }
        }  

        if ($data['commission_agent_percent'] > 0) {
            if (!$this->isValidPercent($data['commission_agent_percent'])) {
                $params = array('Комісія. Агент. Розмір комісії, %', '');
                $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
            }
             
        }  

        if($data['parent_id'] && intval($data['parent_id']) > 0 && intval($data['outside_client']) === 1 && !$this->checkPermissionsBooleanResult("outside_client")) {
            $Log->add('error', 'Клієнт раніше був застрахований в <b>ТДВ «Експрес Страхування»</b>, він не може мати статус <b>Стороннього клієнта</b>.');
        }

        if($data['manager_id'] && intval($data['manager_id']) > 0 && intval($data['outside_client']) === 1 && !$this->checkPermissionsBooleanResult("outside_client")) {
            $Log->add('error', 'Клієнт, якого привів менеджер, не може мати статус <b>Стороннього клієнта</b>.');
        }
        
        $date = (checkdate(intval($data['date_month']), intval($data['date_day']), intval($data['date_year'])))
            ? mktime(0, 0, 0, intval($data['date_month']), intval($data['date_day']), intval($data['date_year']))
            : mktime(0, 0, 0, date('m')  , date('d'), date('Y'));
        $begin_datetime = (checkdate(intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year']))
            : 0;
        $end_datetime = (checkdate(intval($data['end_datetime_month']), intval($data['end_datetime_day']), intval($data['end_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['end_datetime_month']), intval($data['end_datetime_day']), intval($data['end_datetime_year']))
            : 0;
        $go_begin_datetime = (checkdate(intval($data['go_begin_datetime_month']), intval($data['go_begin_datetime_day']), intval($data['go_begin_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['go_begin_datetime_month']), intval($data['go_begin_datetime_day']), intval($data['go_begin_datetime_year']))
            : 0;
        $go_end_datetime = (checkdate(intval($data['go_end_datetime_month']), intval($data['go_end_datetime_day']), intval($data['go_end_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['go_end_datetime_month']), intval($data['go_end_datetime_day']), intval($data['go_end_datetime_year']))
            : 0;
        $go_begin_datetime_plus_1_year = (checkdate(intval($data['go_begin_datetime_month']), intval($data['go_begin_datetime_day']), intval($data['go_begin_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['go_begin_datetime_month']), intval($data['go_begin_datetime_day']) - 1, intval($data['go_begin_datetime_year']) + 1)
            : 0;

        //проверка даты начала действия полиса
        if ($begin_datetime < $date) {
            $Log->add('error', '<b>Дата початку дії полісу</b> не може бути раніше ніж <b>Дата поліса</b>.');
        }
        if ($begin_datetime == $date) {
            //$Log->add('error', '<b>Дата початку дії полісу</b> не може бути рівною <b>Даті полісу</b>.');
        }
        if ($begin_datetime > $end_datetime) {
            $Log->add('error', '<b>Дата закінчення дії полісу</b> не може бути раніше ніж <b>Дата початку дії полісу</b>.');
        }
        if ($go_begin_datetime > $go_end_datetime) {
            $Log->add('error', '<b>Дата закінчення дії полісу ОСЦПВВНТЗ</b> не може бути раніше ніж <b>Дата початку дії полісу ОСЦПВВНТЗ</b>.');
        }
        if ($go_begin_datetime > $begin_datetime) {
            $Log->add('error', '<b>Дата початку дії полісу</b> не може бути раніше ніж <b>Дата початку дії полісу ОСЦПВВНТЗ</b>.');
        }
        if ($go_end_datetime > $go_begin_datetime_plus_1_year) {
            $Log->add('error', 'Строк дії полісу ОСЦПВВНТЗ не повинен перевищувати 1 рік.');
        }
        
        
        if ($data['card_assistance'] != '' && $data['id']>0) {
            $car_used = $db->getOne('SELECT policies_id FROM insurance_policies_dgo WHERE card_assistance='.$db->quote($data['card_assistance']).' and policies_id<>'.intval($data['id']));
            if ($car_used>0) {
                $Log->add('error', 'Вказаний Номер картки Експрес Асістанс вже використовується');
            }
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
        if ($data['manager_id']>0 && $data['parent_id']>0 && doubleval($data['motivation_manager_percent'])==0  && $data['individual_motivation']) {
            $Log->add('error', 'Необхідно заповнити мотивацiю <b>Менеджер що привiв клiєнта</b>');
        }

        if ($data['go_insurance_company_id'] == 505){
            $sql =  'SELECT policies_id as id ' .
                    'FROM ' . PREFIX . '_policies_go ' .
                    'WHERE blank_series = ' . $db->quote($data['go_series']) . ' AND blank_number = ' . $db->quote($data['go_number']);
            $row =  $db->getRow($sql);

            if (!$row && $data['policy_statuses_id']!=10) {
                $sql =  'SELECT id   ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE product_types_id=4 AND number = ' . $db->quote($data['go_number']);
                $row =  $db->getRow($sql);
            }   

            if (!$row){
                $Log->add('error', 'Вказаний поліс ОСЦПВ не знайдено.');
            }

            $row['checkPermissions'] = 1;
            $Policies = Policies::factory($row, 'GO');
            $Policies->permissions['update'] = true;
            $row = $Policies->load($row, false);

            if ($row['shassi'] != $data['shassi']) {
                $Log->add('error', '№ шасі (кузов, рама) не спiвпадає з даними поліса ОСЦПВ.');
            }
            if ($row['sign'] != $data['sign']) {
                $Log->add('error', 'Державний номер не спiвпадає з даними поліса ОСЦПВ.');
            }
            switch($row['car_types_id']) {
                case 1://Легкові автомобілі
                        if ($data['car_types_id'] != 18) $Log->add('error', 'Тип ТЗ не спiвпадає з даними поліса ОСЦПВ.');
                        break;
                case 2://Причіп F
                        if ($data['car_types_id'] != 23) $Log->add('error', 'Тип ТЗ не спiвпадає з даними поліса ОСЦПВ.');
                        break;
                case 3://Автобуси
                        if ($data['car_types_id'] != 21 && $data['car_types_id'] != 22) $Log->add('error', 'Тип ТЗ не спiвпадає з даними поліса ОСЦПВ.');
                        break;
                case 4://Вантажні автомобілі
                        if ($data['car_types_id'] != 19 && $data['car_types_id'] != 20) $Log->add('error', 'Тип ТЗ не спiвпадає з даними поліса ОСЦПВ.');
                        break;
                case 5://Причіп E
                        if ($data['car_types_id'] != 24) $Log->add('error', 'Тип ТЗ не спiвпадає з даними поліса ОСЦПВ.');
                        break;
                case 6://Мотоцикл
                        if ($data['car_types_id'] != 26) $Log->add('error', 'Тип ТЗ не спiвпадає з даними поліса ОСЦПВ.');
                        break;
                case 7://Моторолер
                        if ($data['car_types_id'] != 25) $Log->add('error', 'Тип ТЗ не спiвпадає з даними поліса ОСЦПВ.');
                        break;
            }
            if ($row['brands_id'] != $data['brands_id']) {
                $Log->add('error', 'Марка ТЗ не спiвпадає з даними поліса ОСЦПВ.');
            }
            if ($row['models_id'] != $data['models_id']) {
                $Log->add('error', 'Модель ТЗ не спiвпадає з даними поліса ОСЦПВ.');
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

    function updatePersons($policies_id, $persons) {
        global $db;

        $sql =  'DELETE ' . 
                'FROM ' . PREFIX . '_policies_dgo_persons ' . 
                'WHERE policies_id = ' . intval($policies_id);
        $db->query($sql);

        if (is_array($persons)) {
            foreach ($persons as $person) {
                if ($person['lastname']) {
                    $sql =  'INSERT INTO ' . PREFIX . '_policies_dgo_persons SET ' .
                            'policies_id = ' . intval($policies_id) . ', ' .
                            'lastname = ' . $db->quote($person['lastname']) . ', ' .
                            'firstname = ' . $db->quote($person['firstname']) . ', ' .
                            'patronymicname = ' . $db->quote($person['patronymicname']) . ', ' .
                            'driver_licence_series = ' . $db->quote($person['driver_licence_series']) . ', ' .
                            'driver_licence_number = ' . $db->quote($person['driver_licence_number']) . ', ' .
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
                ' round(a.amount * b.commission_agency_percent / 100, 2) ' .//сумма комиссионного вознаграждения агенции, считаем от страхового тарифа
                ' ) as commission_agency_amount, ' .//сумма комиссионного вознаграждения агенции

                'SUM(  round(a.amount * b.commission_agent_percent / 100, 2) ' .//сумма комиссионного вознаграждения агенту, считаем от страхового тарифа
                ' ) as commission_agent_amount, ' .//сумма комиссионного вознаграждения агенту

                'SUM(  ' .
                '  round(a.amount * b.commission_manager_percent / 100, 2) ' .
                ' ) as commission_manager_amount, ' . 
                'SUM(  ' .
                '  round(a.amount * b.commission_seller_agents_percent / 100, 2) ' .
                ' ) as commission_seller_agents_amount, ' . 
                
                
                'SUM(  round(a.amount * b.director1_commission_percent / 100, 2) ' .//сумма комиссионного вознаграждения директору  за 1 ТС, считаем от страхового тарифа
                ' ) as commission_director1_amount, ' .//сумма комиссионного вознаграждения директору  за 1 ТС
                
                'SUM(  round(a.amount * b.director2_commission_percent / 100, 2) ' .//сумма комиссионного вознаграждения зам директору  за 1 ТС, считаем от страхового тарифа
                ' ) as commission_director2_amount  ' .//сумма комиссионного вознаграждения зам директору  за 1 ТС
                
                
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_dgo AS b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        $row =  $db->getRow($sql);

        $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                'commission_agency_percent = round(' . $db->quote($row['commission_agency_amount']) . ' / amount * 100, 2), ' .
                'commission_agent_percent = round(' . $db->quote($row['commission_agent_amount']) . ' / amount * 100, 2), ' .
                'commission_director1_percent = round(' . $db->quote($row['commission_director1_amount']) . ' / amount * 100, 2), ' .
                'commission_director2_percent = round(' . $db->quote($row['commission_director2_amount']) . ' / amount * 100, 2), ' .
                'commission_manager_amount = ' . $db->quote($row['commission_manager_amount']) . ', ' .
                'commission_manager_percent = round(' . $db->quote($row['commission_manager_amount']) . ' / amount * 100, 2), ' .
                'commission_seller_agents_amount = ' . $db->quote($row['commission_seller_agents_amount']) . ', ' .
                'commission_seller_agents_percent = round(' . $db->quote($row['commission_seller_agents_amount']) . ' / amount * 100, 2), ' .

                'commission_financial_institution_percent = 0 ' .
                'WHERE id = ' . intval($id);
        $db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'commission_agency_amount = ' . $db->quote($row['commission_agency_amount']) . ', ' .
                'commission_agent_amount = ' . $db->quote($row['commission_agent_amount']) . ', ' .
                'commission_director1_amount =  ' . doubleval($row['commission_director1_amount']).' , ' .
                'commission_director2_amount =  ' . doubleval($row['commission_director2_amount']).' , ' .
                'commission_manager_amount =  ' . doubleval($row['commission_manager_amount']).' , ' .
                'commission_seller_agents_amount =  ' . doubleval($row['commission_seller_agents_amount']).' , ' .
                
                'commission_financial_institution_amount = 0 ' .
                'WHERE policies_id = ' . intval($id);
        $db->query($sql);
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

                $values['identification_code']      = $data['insurer_identification_code'];

                //$values['driver_licence_series']      = $data['insurer_driver_licence_series'];
                //$values['driver_licence_number']      = $data['insurer_driver_licence_number'];
                break;
            case '2'://юр. лицо
                $values['company']                  = $data['insurer_company'];
                $values['identification_code']      = $data['insurer_edrpou'];
                break;
        }

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

        $values['card_car_man_woman']               = $data['card_car_man_woman'];

        $Clients = new Clients($values);
        return $Clients->fill($values);
    }

    function setCar($data) {

        $values['clients_id']               = $data['clients_id'];
        $values['brands_id']                    = $data['brands_id'];
        $values['models_id']                    = $data['models_id'];
//      $values['price']                    = $data['price'];
        $values['engine_size']              = $data['engine_size'];
//      $values['transmissions_id']         = $data['transmissions_id'];
        $values['year']                     = $data['year'];
//      $values['race']                     = $data['race'];
//      $values['colors_id']                    = $data['colors_id'];
//      $values['passengers']               = $data['passengers'];
//      $values['car_weight']               = $data['car_weight'];
        $values['shassi']                   = $data['shassi'];
        $values['sign']                     = $data['sign'];
//      $values['protection_multlock']      = $data['protection_multlock'];
//      $values['protection_immobilaser']   = $data['protection_immobilaser'];
//      $values['protection_manual']            = $data['protection_manual'];
//      $values['protection_signalling']        = $data['protection_signalling'];

        $values['registration_number']      = $data['registration_number'];
//      $values['registration_place']       = $data['registration_place'];
        $values['registration_date']            = $data['registration_date'];
        $values['registration_date_year']       = $data['registration_date_year'];
        $values['registration_date_month']  = $data['registration_date_month'];
        $values['registration_date_day']        = $data['registration_date_day'];

        $values['registration_cities_id']       = $data['registration_cities_id'];
        $values['registration_cities_title']    = $data['registration_cities_title'];
//      $values['regions_id']               = $data['regions_id'];

        $ClientCars = new ClientCars($values);
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

        $sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_dgo AS b ON b.policies_id = ' . intval($id) . ' ' .
                'JOIN ' . PREFIX . '_products_dgo AS c ON b.products_id = c.products_id ' .
                'JOIN ' . PREFIX . '_products AS d ON b.products_id = d.id ' .
                'JOIN ' . PREFIX . '_car_models AS e ON b.models_id = e.id ' .
                'JOIN ' . PREFIX . '_car_brands AS f ON e.car_brands_id = f.id ' .
                'JOIN ' . PREFIX . '_cities AS g ON b.registration_cities_id=g.id ' .
                'JOIN ' . PREFIX . '_product_types AS h ON a.product_types_id = h.id ' .
                'LEFT JOIN ' . PREFIX . '_policies AS k ON k.id = ' . intval($data['parent_id']) . ' SET ' .
                'a.parent_id = ' . intval($data['parent_id']) . ', ' .
                'a.top = IF(h.top > 0, h.top, ' . intval($id) . '), ' .
                'a.clients_id = ' . intval($data['clients_id']) . ', ' .
                'a.product_types_expense_percent = h.expense_percent, ' .
                'b.products_code = d.code, ' .
                'b.products_title = d.title, ' .
                'a.number = IF(a.number, a.number, CONCAT(d.code, \'.\', date_format(a.created, \'%y\'), \'.2\', ' . $db->quote(sprintf('%06d', $id)) . ')), ' .
                'a.date = IF(TO_DAYS(a.date) > 0, a.date, ' . $db->quote($data['date_year'] . $data['date_month'] . $data['date_day']) . '), ' .
                'a.insurer = IF(b.person_types_id = 2, insurer_company, CONCAT(insurer_lastname, \' \', insurer_firstname)), ' .
                'a.item = CONCAT(f.title, \' \', e.title), ' .
                'a.interrupt_datetime = a.end_datetime, ' .
                'b.registration_cities_title = IF(b.registration_cities_id <> ' . CITIES_OTHER . ', g.title, b.registration_cities_title), ' .
                //'b.regions_value = ' . $db->quote($data['regions_value']) . ', ' .
                //'b.terms_value = ' . $db->quote($data['terms_value']) . ', ' .
                //'b.go_value = ' . $db->quote($data['go_value']) . ', ' .
                'b.commission_agency_percent = ' . $db->quote($data['commission_agency_percent']) . ', ' .
                'b.commission_agent_percent = ' . $db->quote($data['commission_agent_percent']) . ', ' .
                'k.child_id = ' . intval($id) . ' ' .
                'WHERE a.id = ' . intval($id);
        $db->query($sql);

        $this->updatePersons($id, $data['persons']);

        $PolicyPaymentsCalendar=new PolicyPaymentsCalendar($data);
        $PolicyPaymentsCalendar->updateCalendar($id);

        $this->setCommissions($id);
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
    
    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization;

        $data['agencies_id']    = $Authorization->data['agencies_id'];
        $data['agents_id']  = $Authorization->data['id'];
        
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

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
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

        $conditions[] = 'policies_id = ' . $data['id'];

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies_dgo_persons ' .
                'WHERE ' . implode(' AND ', $conditions);
        $data['persons'] = $db->getAll($sql);

        return $data;
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization,$db;

        $policy_statuses_id = $db->getOne('SELECT policy_statuses_id FROM insurance_policies WHERE id='.intval($data['id']));
        if ($policy_statuses_id == POLICY_STATUSES_CONSULTATION && $data['policy_statuses_id']!=POLICY_STATUSES_CONSULTATION) {
            //переход с конусльтации в другой статус поменять человека кто создал
            $this->formDescription['fields'][ $this->getFieldPositionByName('agents_id') ]['display']['update'] = true;
            $data['agents_id']  = $Authorization->data['id'];
        }
        if ($data['seller_agencies_id']>0) {
            $data['top_agencies_id']  = $db->getOne('SELECT IF(parent_id>0,parent_id,id) FROM '.PREFIX.'_agencies WHERE id='.intval($data['seller_agencies_id']));
        }
        
        
        if ($data['dontRecalcRate']) //не обновлять поля отвечающие за тариф
        {
            $unsetFields = array();
            $unsetFields[] = 'price';
            $unsetFields[] = 'rate';
            $unsetFields[] = 'amount';
            $unsetFields[] = 'insurance_price_id';
            
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
        }

        
        if (parent::update(&$data, false, $showForm)) {
//_dump($Log->isPresent());exit;
            $this->setAdditionalFields($data['id'], $data);

            $this->generateDocuments($data['id']);

            if ($redirect) {
                $params['title']    = $this->messages['single'];
                $params['id']       = $data['id'];
                $params['storage']  = $this->tables[0];

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

        $sql =  'DELETE ' . 
                'FROM ' . PREFIX . '_policies_dgo_persons ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        return parent::deleteProcess($data, $i, $folder);
    }

    function prepareValues($fields, $values) {
        global $db, $REGIONS;

//зачем фигня ниже не знаю, 23.07.2010 комментирую, если все ок, удаляю
//      $values['date'] = date(PHP_DATE_FORMAT);

        foreach ($fields as $field) {
            switch ($field) {
                case 'insurerTitle':
                    switch ($values['person_types_id']) {
                        case 1:
                            $values[ $field ] = $values['insurer_lastname'] . ' ' . $values['insurer_firstname'] . ' ' . $values['insurer_patronymicname'];
                            break;
                        case 2:
                            $values[ $field ] = $values['insurer_company'] ;
                            break;
                    }
                    break;
                case 'insurer_address':
                    $values[ $field ] = Regions::getTitle($values['insurer_regions_id']);

                    if ($values['insurer_area']) {
                        $values[ $field ] .= ', ' .$values['insurer_area'].' р-н';
                    }

                    if (!in_array($values['insurer_regions_id'], $REGIONS)) {
                        $values[ $field ] .= ', ' .$values['insurer_city'];
                    }

                    $values[ $field ] .=  ', ' . StreetTypes::getTitle($values['insurer_street_types_id']) . ' ' . $values['insurer_street'] . ', буд. ' . $values['insurer_house'];

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
                    $values[ $field ] = substr($values['amount'], 0, strlen($values['amount']) - 3);
                    break;
                case 'amount_decimal':
                    $values[ $field ] = substr($values['amount'], strlen($values['amount']) - 2);
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

        $sql =  'SELECT a.*, c.*, b.*, e.title as go_insurance_company, SUBDATE(b.begin_datetime, INTERVAL 1 DAY) as payed_datetime, f.title as car_type, c.types_id AS types_id, d1.ukravto as ukravto, '.
        'r1.id AS agencies_id, r1.title AS agencies_title, r1.edrpou AS agencies_edrpou, r1.ground_ns_express AS ground_kasko, r1.director1 as director1, r1.director2, r1.findirector1 as findirector1, r1.findirector2 as findirector2, ' .
                'r1.id as rid, r1.title as rtitle, r1.edrpou as redrpou, r1.address as raddress, r1.bank as rbank, r1.bank_mfo as rbankmfo, r1.bank_account as rbankaccount ' .
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . $this->tables[0] . ' AS b ON a.policies_id = b.id ' .
                'JOIN ' . $this->tables[1] . ' AS c ON b.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS d1 ON b.agencies_id = d1.id ' .
                'LEFT JOIN ' . PREFIX . '_companies_mtsbu as e ON c.go_insurance_company_id = e.id ' .
                'JOIN ' . PREFIX . '_car_types as f ON c.car_types_id = f.id ' .
                'JOIN (SELECT a.id as idpd, b.id as idpol, IF( b.seller_agencies_id>0, IF           (ds.ground_kasko_express IS NOT NULL AND LENGTH(ds.ground_kasko_express)>0, ds.id,IF(ds1.id>0,ds1.id,ds.id) ) ,IF (d.ground_kasko_express IS NOT NULL AND LENGTH(d.ground_kasko_express)>0, d.id, IF(d1.id>0,d1.id,d.id) ) ) as idag 
                    from ' . PREFIX . '_policy_documents AS a
                    join ' . $this->tables[0] . ' AS b ON a.policies_id = b.id
                    join ' . PREFIX . '_agencies AS d ON b.agencies_id = d.id
                    LEFT JOIN ' . PREFIX . '_agencies AS d1 ON d1.id = d.parent_id
                    LEFT JOIN ' . PREFIX . '_agencies AS ds ON b.seller_agencies_id = ds.id
                    LEFT JOIN ' . PREFIX . '_agencies AS ds1 ON ds1.id = ds.parent_id) as rek ON rek.idpd = a.id ' .
                'JOIN ' . PREFIX . '_agencies AS r1 ON r1.id = rek.idag ' . 
                'WHERE a.id=' . intval($file['id']);
        $row = $db->getRow($sql);

        $sql =  'SELECT * ' . 
                'FROM ' . PREFIX . '_policies_dgo_persons ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $row['persons'] = $db->getAll($sql);

        if ($row) {
            if ($row['seller_agencies_id']>0 ) {
                $r = $db->getRow('SELECT title as agencies_title,ground_kasko_express as ground_kasko, director1,director2  FROM  insurance_agencies WHERE   id='.$row['seller_agencies_id']);
                if ($r) {
                    $row = array_merge ( $row, $r );
                }   
                else {
                    $row['agent_lastname'] = 'Поліщук';
                    $row['agent_firstname'] = 'Михайло';
                    $row['agent_patronymicname'] ='Олександрович';
                }
                
            }
            $row['agencies_title'] = str_replace('_NISSAN_RENUALT', '',  $row['agencies_title']);
            $row['agencies_title'] = str_replace('Відділ продажу', '',  $row['agencies_title']);
        }
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

        $fields = array(
                    'insurerTitle',
                    'insurer_address',
                    'insurer_phone',
                    'insurerLicenceSeries',
                    'insurerLicenceNumber',
                    'amount_number',
                    'amount_decimal',
                    'payed',
                    'closed');

        if (strtotime($row['date']) >= strtotime('2013-07-04')) {
                $row['new_director'] = 1;
            }

        return $this->prepareValues($fields, $row);
    }

    function get($id) {
        global $db;

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies as a ' .
                'JOIN ' . PREFIX . '_policies_dgo as b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        return $db->getRow($sql);
    }

    function loadGoInWindow($data) {
        global $db;

        $result ='';

        //ищем полис ГО
        $sql =  'SELECT policies_id as id ' .
                'FROM ' . PREFIX . '_policies_go ' .
                'WHERE blank_series = ' . $db->quote($data['go_series']) . ' AND blank_number = ' . $db->quote($data['go_number']);
        $row =  $db->getRow($sql);
        if (!$row) {
            $sql =  'SELECT id   ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE product_types_id=4 AND number = ' . $db->quote($data['go_number']);
            $row =  $db->getRow($sql);
        }

        if ($row) {
            $fields = array('begin_datetime',
                            'begin_datetime_day',
                            'begin_datetime_month',
                            'begin_datetime_year',
                            'end_datetime',
                            'end_datetime_day',
                            'end_datetime_month',
                            'end_datetime_year',
                            'car_types_id',
                            'brands_id',
                            'models_id',
                            'shassi',
                            'sign',
                            'year',
                            'registration_cities_id',
                            'registration_cities_title',
                            'person_types_id',
                            'insurer_lastname',
                            'insurer_firstname',
                            'insurer_patronymicname',
                            'insurer_dateofbirth',
                            'insurer_dateofbirth_day',
                            'insurer_dateofbirth_month',
                            'insurer_dateofbirth_year',
                            'insurer_passport_series',
                            'insurer_passport_number',
                            'insurer_passport_place',
                            'insurer_passport_date',
                            'insurer_passport_date_day',
                            'insurer_passport_date_month',
                            'insurer_passport_date_year',

                            'insurer_newpassport_number',
                            'insurer_newpassport_place',
                            'insurer_newpassport_date',
                            'insurer_newpassport_date_day',
                            'insurer_newpassport_date_month',
                            'insurer_newpassport_date_year',
                            'insurer_newpassport_reestr',
                            'insurer_newpassport_dateEnd',
                            'insurer_newpassport_dateEnd_day',
                            'insurer_newpassport_dateEnd_month',
                            'insurer_newpassport_dateEnd_year',
                            //'insurer_driver_licence_series',
                            //'insurer_driver_licence_number',
                            //'insurer_driver_licence_date',
                            //'insurer_driver_licence_day',
                            //'insurer_driver_licence_month',
                            //'insurer_driver_licence_year',
                            'insurer_identification_code',
                            'insurer_company',
                            'insurer_edrpou',
                            'insurer_phone',
                            'insurer_email',
                            'insurer_zip',
                            'insurer_regions_id',
                            'insurer_area',
                            'insurer_city',
                            'insurer_street_types_id',
                            'insurer_street',
                            'insurer_house',
                            'insurer_flat',
                            'success');

            $sql = 'SELECT policies.id as policies_id, date_format(policies.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetime, date_format(policies.begin_datetime, \'%d\') as begin_datetime_day, date_format(policies.begin_datetime, \'%m\') as begin_datetime_month, date_format(policies.begin_datetime, \'%Y\') as begin_datetime_year, date_format(policies.end_datetime, ' . $db->quote(DATE_FORMAT) . ') as end_datetime, date_format(policies.end_datetime, \'%d\') as end_datetime_day, date_format(policies.end_datetime, \'%m\') as end_datetime_month, date_format(policies.end_datetime, \'%Y\') as end_datetime_year, policies_go.car_types_id, policies_go.brands_id, policies_go.models_id, policies_go.shassi, policies_go.sign, policies_go.year, policies_go.registration_cities_id, policies_go.registration_cities_title, policies_go.person_types_id, ' .
                           'policies_go.insurer_lastname, policies_go.insurer_firstname, policies_go.insurer_patronymicname, date_format(policies_go.insurer_dateofbirth, ' . $db->quote(DATE_FORMAT) . ') as insurer_dateofbirth, date_format(policies_go.insurer_dateofbirth, \'%d\') as insurer_dateofbirth_day, date_format(policies_go.insurer_dateofbirth, \'%m\') as insurer_dateofbirth_month, date_format(policies_go.insurer_dateofbirth, \'%Y\') as insurer_dateofbirth_year, policies_go.insurer_passport_series, policies_go.insurer_passport_number, policies_go.insurer_passport_place, date_format(policies_go.insurer_passport_date, ' . $db->quote(DATE_FORMAT) . ') as insurer_passport_date, date_format(policies_go.insurer_passport_date, \'%d\') as insurer_passport_date_day, date_format(policies_go.insurer_passport_date, \'%m\') as insurer_passport_date_month, date_format(policies_go.insurer_passport_date, \'%Y\') as insurer_passport_date_year, policies_go.insurer_driver_licence_series, policies_go.insurer_driver_licence_number, date_format(policies_go.insurer_driver_licence_date, ' . $db->quote(DATE_FORMAT) . ') as insurer_driver_licence_date, date_format(policies_go.insurer_driver_licence_date, \'%d\') as insurer_driver_licence_date_day, date_format(policies_go.insurer_driver_licence_date, \'%m\') as insurer_driver_licence_date_month, date_format(policies_go.insurer_driver_licence_date, \'%Y\') as insurer_driver_licence_date_year, policies_go.insurer_identification_code, ' .
                           'policies_go.insurer_newpassport_number, policies_go.insurer_newpassport_place, date_format(policies_go.insurer_newpassport_date, ' . $db->quote(DATE_FORMAT) . ') as insurer_newpassport_date, date_format(policies_go.insurer_newpassport_date, \'%d\') as insurer_newpassport_date_day, date_format(policies_go.insurer_newpassport_date, \'%m\') as insurer_newpassport_date_month, date_format(policies_go.insurer_bewpassport_date, \'%Y\') as insurer_newpassport_date_year, policies_go.insurer_newpassport_reestr, date_format(policies_go.insurer_newpassport_dateEnd, ' . $db->quote(DATE_FORMAT) . ') as insurer_newpassport_dateEnd, date_format(policies_go.insurer_newpassport_dateEnd, \'%d\') as insurer_newpassport_dateEnd_day, date_format(policies_go.insurer_newpassport_dateEnd, \'%m\') as insurer_newpassport_dateEnd_month, date_format(policies_go.insurer_newpassport_dateEnd, \'%Y\') as insurer_newpassport_dateEnd_year, ' .
                           'policies_go.insurer_edrpou, ' .
                           'policies_go.insurer_phone, policies_go.insurer_email, policies_go.insurer_zip, policies_go.insurer_regions_id, policies_go.insurer_area, policies_go.insurer_city, policies_go.insurer_street_types_id, policies_go.insurer_street, policies_go.insurer_house, policies_go.insurer_flat, ' .
                           '1 as success ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_policies_go as policies_go ON policies.id = policies_go.policies_id ' .
                   'WHERE policies.id = ' . intval($row['id']);
            $row = $db->getRow($sql);
            $params = array();
            foreach ($fields as $field) {
                switch($row['car_types_id']) {
                    case 1:
                            $row['car_types_id'] = 18;
                            break;
                    case 2:
                            $row['car_types_id'] = 23;
                            break;
                    case 3:
                            $row['car_types_id'] = 22;
                            break;
                    case 4:
                            $row['car_types_id'] = 20;
                            break;
                    case 5:
                            $row['car_types_id'] = 24;
                            break;
                    case 6:
                            $row['car_types_id'] = 26;
                            break;
                    case 7:
                            $row['car_types_id'] = 25;
                            break;
                }
                $params[] = '"' . $field . '":"' . str_replace('&quot;', '\"', $row[$field]) . '"';
            }
            $result = '{' . implode(',', $params) . '}';
        } else {
            $result = '{"success" : "0"}';
        }

        echo $result;
        exit;
    }

     /* Export 1C7.7. */
    function getXML($data) {
        global $db, $Smarty;

        if ($data['number']) {
            $conditions[] = 'a.number=' . $db->quote(trim($data['number']));
        } else {
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.date )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.date )>=TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.date )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.date ) <= TO_DAYS(NOW())';

            $conditions[] = 'a.policy_statuses_id = ' . POLICY_STATUSES_GENERATED;
        }

        $sql =  'SELECT b.*, a.date,' .
                'a.begin_datetime, ' .
                'a.end_datetime ,  ' .
                'a.modified as modifiedDate, ' .
                'a.created, ' .
                'a.begin_datetime as payment_datetime, ' .
                'a.policy_statuses_id,  a.number, b.insurer_lastname as company, '.
                'a.item, a.price, a.rate, a.amount,  '.
                'd.title as insurerRegionsTitle ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_dgo AS b ON b.policies_id=a.id ' .
                'LEFT JOIN ' . PREFIX . '_regions AS d ON b.insurer_regions_id=d.id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        foreach ($list as $i=>$row) {
            $sql =  'SELECT date as payment_date, amount as payment_amount ' .
                    'FROM ' . PREFIX . '_policy_payments_calendar ' .
                    'WHERE policies_id = ' . intval($row['policies_id']);
            $list[ $i ]['paymentsCalendar'] = $db->getAll($sql);

            $fields = array('insurer_address');

            $row = $this->prepareValues($fields, $row);

            $list[$i]['insurer_address'] = $row['insurer_address'];
        }

        $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/dgo.xml');
    }
    
    function setListValues($data, $actionType='show') {
        global $db, $Authorization;

        if (!intval($data['agencies_id'])) {
            $data['agencies_id']    = $Authorization->data['agencies_id'];
        }

        $this->formDescription['fields'][ $this->getFieldPositionByName('sign_agents_id') ]['condition'] .= ' AND agencies_id='.intval($data['agencies_id']);

        parent::setListValues($data, $actionType);
    }

    function getReadonlySign(&$data) {
        return (intval($data['documents'])==0)
            ? ''
            : ' style="color: #666666; background-color: #f5f5f5;" disabled';
    }
    
    function changeSignInWindow($data) {
        global $db;

        $this->checkPermissions('update', $data);

        $sql =  'UPDATE ' . PREFIX . '_policies_dgo  SET ' .
                'sign_agents_id = ' . intval($data['sign_agents_id']) . ' ' .
                'WHERE policies_id = ' . intval($data['policies_id']);
        $db->query($sql);

        if ($this->getStatusesIdyId($data['policies_id']) == POLICY_STATUSES_GENERATED) {
            PolicyDocuments::generateTemplates($data['policies_id'], null, true);
        }

        echo 'Ok';
        exit;
    }

    function changeServicePersonInWindow($data) {
        global $db, $Log;

        if (true || $this->canChangeServicePerson($data['id'])) {


            $sql =  'SELECT products_id, date, agencies_id,a.manager_id,a.seller_agents_id,a1.individual_motivation  ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
                    'JOIN ' . PREFIX . '_policies_dgo AS b ON a.id = b.policies_id ' .
                    'WHERE a.id = ' . intval($data['id']);
            $row =  $db->getRow($sql);

            $Products = Products::factory($data, 'DGO');
            $commissions = $Products->getCommissions($row['products_id'], $row['date'], $row['agencies_id']);

            //тут доп преобразования комиссии
            if ($row['manager_id']) //выбрали менеджера що привiв клиента
            {
                if ($row['agencies_id']!=1469 && $row['individual_motivation']==0)
                    $commissions['commission_agent_percent'] = $commissions['commission_agent_percent']/2;
            }
            else {
                $commissions['commission_manager_percent'] = 0;
            }
            
            if (!$row['seller_agents_id']) //не выбрали продающего в агенции
            {
                $commissions['commission_seller_agents_percent'] = 0;
            }
             
            
            $sql =  'UPDATE ' . PREFIX . '_policies_dgo SET ' .
                    'commission_agency_percent = ' . $db->quote($commissions['commission_agency_percent']) . ', ' .
                    'commission_agent_percent = ' . $db->quote($commissions['commission_agent_percent']) . ', ' .
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

}

?>
