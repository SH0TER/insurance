<?
/*
 * Title: accident GO class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';
require_once 'AccidentMessages.class.php';
require_once 'AccidentStatusChanges.class.php';

class Accidents_GO extends Accidents {

	var $product_types_id = PRODUCT_TYPES_GO;
	
	var $previousStatusesSchema = array(
		ACCIDENT_STATUSES_COORDINATION => array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE),
		ACCIDENT_STATUSES_APPROVAL => array(ACCIDENT_STATUSES_COORDINATION, ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE)
	);

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
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
					array(
                            'name'              => 'application_accidents_id',
                            'type'              => fldIdentity,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'accidents'),
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
                                'canBeEmpty'	=> true
                            ),
                        'orderPosition'     => 1,
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'companies_id',
                        'description'       => 'Компанія',
                        'type'              => fldSelect,
                        'condition'			=> 'id = 4',//оставляем только Экспресс Страхование
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'             => 'accidents',
                        'sourceTable'       => 'companies',
                        'selectField'       => 'title',
                        'orderField'        => 'title'),
                    array(
                        'name'                  => 'product_types_id',
                        'description'           => 'Тип продукту',
                        'type'                  =>  fldHidden,
                        'display'               =>
                            array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false
                            ),
                        'verification'          =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'                 => 'accidents'),
                    array(
                        'name'                  => 'archive_statuses_id',
                        'description'           => 'Архів',
                        'type'                  => fldHidden,
                        'display'               =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'          =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'table'                 => 'accidents'),
                    array(
                        'name'              => 'date',
                        'description'       => 'Дата заяви',
                        'type'              => fldDate,
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
                        'orderPosition'     => 2,
                        'width'             => 100,
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'owner_types_id',
                        'description'       => 'Тип власника',
                        'type'              => fldRadio,
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
                        'table'             => 'accidents_go'),
                    array(
                        'name'              => 'CONCAT(insurance_policies.number) AS policies_number',
                        'description'       => 'Поліс',
                        'type'              => fldText,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'withoutTable'		=> true,
                        'orderName'			=> 'policies_number',
                        'orderPosition'     => 3,
                        'table'             => 'policies'),
                    array(
                        'name'              => 'CONCAT(applicant_lastname, \' \', applicant_firstname) AS applicant',
                        'description'       => 'Заявник',
                        'type'              => fldText,
                        'display'           =>
                        array(
                            'show'      => true,
                            'insert'    => false,
                            'view'      => false,
                            'update'    => false
                        ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => true
                        ),
                        'withoutTable'		=> true,
                        'orderPosition'		=> 4,
                        'orderName'		    => 'applicant',
                        'table'				=> 'accidents'),
                    array(
                        'name'              => 'CONCAT(owner_lastname, \' \', owner_firstname) AS owner',
                        'description'       => 'Потерпілий',
                        'type'              => fldText,
                        'display'           =>
                        array(
                            'show'      => true,
                            'insert'    => false,
                            'view'      => false,
                            'update'    => false
                        ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => true
                        ),
                        'withoutTable'		=> true,
                        'orderName'			=> 'owner',
                        'orderPosition'		=> 5,
                        'table'				=> 'accidents_go'),
                    array(
                        'name'              => 'CONCAT(insurer_lastname, \' \', insurer_firstname) AS insurer',
                        'description'       => 'Страхувальник',
                        'type'              => fldText,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'		=>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'withoutTable'		=> true,
                        'orderName'			=> 'insurer',
                        'orderPosition'		=> 6,
                        'table'				=> 'policies_go'),
                    array(
                        'name'              => 'CONCAT(brand, \' \', model) AS item',
                        'description'       => 'Об\'єкт',
                        'type'              => fldText,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'withoutTable'		=> true,
                        'orderName'     	=> 'item',
                        'orderPosition'     => 7,
                        'table'             => 'policies_go'),
                    array(
                        'name'              => 'sign',
                        'description'       => 'Державний номер',
                        'type'              => fldText,
                        'validationFunction'        => 'isValidSign',
                        'validationFunctionType'    => 'function',
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
                        'width'             => 100,
                        'table'             => 'policies_go'),
                    array(
                        'name'              => 'amount_rough',
                        'description'       => 'Орієнтовний збиток, грн.',
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
                                'canBeEmpty'	=> false
                            ),
                        'orderPosition'     => 9,
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'policies_id',
                        'description'       => 'Поліс',
                        'type'              => fldHidden,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'             => 'accidents',
                        'sourceTable'       => 'policies',
                        'selectField'       => 'id',
                        'orderField'        => 'id'),
                    array(
                        'name'              => 'accident_sections_id',
                        'description'       => 'Категорія',
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
                                'canBeEmpty'	=> false
                            ),
                        'orderPosition'     => 10,
                        'table'             => 'accidents',
                        'sourceTable'       => 'accident_sections',
                        'selectField'       => 'title',
                        'orderField'        => 'order_position'),
                    array(
                        'name'              => 'insurance',
                        'description'       => 'Випадок',
                        'type'              => fldInteger,
                        'list'				=> array(
                                                1 => 'Страховий, з виплатою',
                                                2 => 'Страховий, без виплати',
                                                3 => 'Не страховий'),
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'orderPosition'     => 11,
                        'table'             => 'accidents'),
                    /*array(
                        'name'              => 'managers_id',
                        'description'       => 'Менеджер',
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
                        'table'             => 'accidents',
                        'sourceTable'       => 'accounts',
                        'selectField'       => 'lastname',
                        'orderField'        => 'id'),*/
                    array(
                        'name'              => 'regres',
                        'description'       => 'Регрес',
                        'type'              => fldBoolean,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> true
                            ),
                        'orderPosition'     => 12,
                        'table'             => 'accidents'),					
                    array(
                        'name'              => 'repair_classifications_id',
                        'description'       => 'Клас ремонту',
                        'type'              => fldText,
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
                        'withoutTable'		=> true,
                        'orderPosition'     => 13,
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'payment_statuses_id',
                        'description'       => 'Оплата',
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
                                'canBeEmpty'	=> false
                            ),
                        'orderPosition'     => 14,
                        'table'             => 'accidents',
                        'sourceTable'       => 'payment_statuses',
                        'selectField'       => 'title',
                        'orderField'        => 'order_position'),
                    array(
                        'name'            	=> 'compensation',
                        'description'       => 'Відшкодування, грн',
                        'type'              => fldText,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'withoutTable'		=> true,
                        'orderName'			=> 'compensation',
                        'orderPosition'     => 15,
                        'table'             => 'accidents_payment_calendar'),
                    array(
                        'name'              => 'accident_statuses_id',
                        'description'       => 'Статус',
                        'type'              => fldSelect,
                        'condition'			=> 'id > 0',
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'orderPosition'     => 16,
                        'table'             => 'accidents',
                        'sourceTable'       => 'accident_statuses',
                        'selectField'       => 'title',
                        'orderField'        => 'order_position'),
                    array(
                        'name'              => 'master_documents',
                        'description'       => 'Документи',
                        'type'              => fldBoolean,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => false,
                                'change'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'orderPosition'     => 17,
                        'table'             => 'accidents'),
					array(
                        'name'              => 'avr_sign',
                        'description'       => 'АВР',
                        'type'              => fldBoolean,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => false,
                                'change'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'orderPosition'     => 18,
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'victim_damage_note',
                        'description'       => 'Опис пошкоджень майна постраждалого:',
                        'type'              => fldText,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'		=>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'            => 'accidents_go'),
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
                                'canBeEmpty'	=> false
                            ),
                        'orderPosition'     => 19,
                        'width'             => 100,
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'masters_id',
                        'description'       => 'Виконавець(і)',
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
                        'orderPosition'     => 20,
                        'table'             => 'accidents',
                        'sourceTable'       => 'accounts',
                        'selectId'			=> 'id',
                        'selectField'       => 'lastname',
                        'orderField'        => 'lastname'),
                    array(
                        'name'              => 'applicant_firstname',
                        'description'       => 'Заявник, ім\'я',
                        'type'              => fldText,
                        'maxlength'         => 50,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'		=>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'            => 'accidents'),

                    array(
                        'name'              => 'applicant_lastname',
                        'description'       => 'Заявник, прізвище',
                        'type'              => fldText,
                        'maxlength'         => 50,
                        'display'           =>
                        array(
                            'show'      => false,
                            'insert'    => true,
                            'view'      => true,
                            'update'    => true
                        ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'				=> 'accidents'),
                    array(
                        'name'              => 'applicant_patronymicname',
                        'description'       => 'Заявник, По батькові',
                        'type'              => fldText,
                        'maxlength'         => 50,
                        'display'           =>
                        array(
                            'show'      => false,
                            'insert'    => true,
                            'view'      => true,
                            'update'    => true
                        ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'            => 'accidents'),
                    array(
                        'name'              => 'applicant_regions_id',
                        'description'       => 'Заявник, область',
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
                        'table'             => 'accidents',
                        'sourceTable'       => 'regions',
                        'selectField'       => 'title',
                        'orderField'        => 'order_position'),
                    array(
                        'name'              => 'applicant_area',
                        'description'       => 'Заявник, район',
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
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'applicant_city',
                        'description'       => 'Заявник, місто',
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
                        'table'             => 'accidents'),
                    array(
                        'name'				=> 'applicant_street_types_id',
                        'description'		=> 'Заявник, тип вулицi',
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
                        'table'				=> 'accidents',
                        'sourceTable'		=> 'street_types',
                        'selectField'		=> 'title',
                        'orderField'		=> 'order_position'),
                    array(
                        'name'              => 'applicant_street',
                        'description'       => 'Заявник, вулиця',
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
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'applicant_house',
                        'description'       => 'Заявник, будинок',
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
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'applicant_flat',
                        'description'       => 'Заявник, квартира',
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
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'applicant_phones',
                        'description'       => 'Заявник, телефон(и)',
                        'type'              => fldText,
                        'maxlength'         => 100,
                        'display'           =>
                        array(
                            'show'      => false,
                            'insert'    => true,
                            'view'      => true,
                            'update'    => true
                        ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'            => 'accidents'),
                    array(
                        'name'            	=> 'days',
                        'description'       => 'Тривалість в статусі, дні',
                        'type'              => fldInteger,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'withoutTable'		=> true,
                        'orderName'			=> 'days',
                        'orderPosition'     => 21,
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'mtsbu_date',
                        'description'       => 'МТСБУ',
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
                        'orderPosition'     => 22,
                        'width'             => 100,
                        'table'             => 'accidents_go'),
                        array(
                                'name'                => 'owner_car_type_id',
                                'description'         => 'Власник, Тип ТЗ',
                                'type'                => fldSelect,
                                'showId'              => true,
                                'display'             =>
                                    array(
                                        'show'        => false,
                                        'insert'      => true,
                                        'view'        => true,
                                        'update'      => true
                                    ),
                                'verification'        =>
                                    array(
                                        'canBeEmpty'    => false
                                    ),
                                'table'              => 'accidents_go',
                                'condition'          => 'product_types_id = 4',
                                'sourceTable'        => 'car_types',
                                'selectField'        => 'CONCAT(code,\' - \',title)',
                                'orderField'         => 'order_position'),
                        array(
                                'name'              => 'owner_brand_id',
                                'description'       => 'Власник, Марка ТЗ (ід)',
                                'type'              => fldText,
                                'maxlength'         => 50,
                                'display'           =>
                                    array(
                                        'show'      => false,
                                        'insert'    => true,
                                        'view'      => true,
                                        'update'    => true
                                    ),
                                'verification'		=>
                                    array(
                                        'canBeEmpty'    => false
                                    ),
                                'table'            => 'accidents_go'),
                        array(
                            'name'              => 'owner_brand',
                            'description'       => 'Власник, Марка ТЗ ',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents_go'),
                        array(
                                'name'              => 'owner_model_id',
                                'description'       => 'Власник, Модель ТЗ (ід)',
                                'type'              => fldText,
                                'maxlength'         => 50,
                                'display'           =>
                                    array(
                                        'show'      => false,
                                        'insert'    => true,
                                        'view'      => true,
                                        'update'    => true
                                    ),
                                'verification'		=>
                                    array(
                                        'canBeEmpty'    => false
                                    ),
                                'table'            => 'accidents_go'),
                        array(
                            'name'              => 'owner_sign',
                            'description'       => 'Власник, Номер ТЗ',
                            'type'              => fldText,
                            'validationFunction'        => 'isValidSign',
                            'validationFunctionType'    => 'function',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents_go'),
                        array(
                            'name'              => 'owner_model',
                            'description'       => 'Власник, Модель ТЗ',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents_go'),
                    /*array(
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
                        'table'             => 'accidents_go',
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
                        'table'             => 'accidents_go'),
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
                        'table'             => 'accidents_go'),
                    array(
                        'name'				=> 'owner_street_types_id',
                        'description'		=> 'Власник, тип вулицi',
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
                        'table'				=> 'accidents_go',
                        'sourceTable'		=> 'street_types',
                        'selectField'		=> 'title',
                        'orderField'		=> 'order_position'),
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
                        'table'             => 'accidents_go'),
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
                        'table'             => 'accidents_go'),
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
                        'table'             => 'accidents_go'),
                    array(
                        'name'              => 'owner_phones',
                        'description'       => 'Власник, телефон(и)',
                        'type'              => fldText,
                        'maxlength'         => 100,
                        'display'           =>
                        array(
                            'show'      => false,
                            'insert'    => true,
                            'view'      => true,
                            'update'    => true
                        ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'            => 'accidents_go'),*/
                        array(
                            'name'              => 'datetime',
                            'description'       => 'Подія',
                            'type'              => fldDateTime,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'table'             => 'accidents'),
                        array(
                            'name'              => 'address',
                            'description'       => 'Адреса',
                            'type'              => fldText,
                            'maxlength'         => 100,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents_go'),
                        array(
                            'name'             => 'description',
                            'description'      => 'Обставини',
                            'type'             => fldNote,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents'),
                        array(
                            'name'             => 'damage',
                            'description'      => 'Пошкодження',
                            'type'             => fldNote,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents'),
                        array(
                            'name'             => 'location',
                            'description'      => 'Місцезнаходження ТЗ',
                            'type'             => fldText,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents'),
                        array(
                            'name'              => 'mvs',
                            'description'       => 'Оформлення ДТП',
                            'type'              => fldRadio,
                            'list'              => array (
														  '0' => 'Нікуди',
                                                          '1' => 'ДАІ',
														  '2' => 'Органи МВС',
														  '3' => 'МНС',
                                                          '4' => 'Європротокол'),
                            'display'           =>
                                array(
                                   'show'       => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents_go'),
                        array(
                            'name'              => 'inspecting_account_id',
                            'description'       => 'Огляд ТЗ провів',
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
                            'table'             => 'accidents_go',
                            'selectField'       => 'CONCAT(lastname,\' \', firstname)',
                            'orderField'        => 'id',
                            'sourceTable'       => 'accounts'),
                        //Довідники
                        array(
                            'name'              => 'damage_extent_id',
                            'description'       => 'Ступінь ушкоджень',
                            'type'              => fldRadio,
                            'list'              => array (
                                                      '1' => 'Тимчасова втрата працездатності(травма)',
                                                      '2' => 'Стійка втрата працездатності(інвалідність 1 групи)',
                                                      '3' => 'Стійка втрата працездатності(інвалідність 2 групи)',
                                                      '4' => 'Стійка втрата працездатності(інвалідність 3 групи/інвалід-дитина)',
                                                      '5' => 'Смерть',
                                                      '6' => 'Моральна шкода'),
                            'display'           =>
                                array(
                                   'show'       => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents_go'),
                    array(
                        'name'              => 'application_risks_id',
                        'description'       => 'Ризик',
                        'type'              => fldRadio,
                        'list'              => array(
                            '1' => 'Майно',
                            '2' => 'Здоров\'я'),
                        'display'           =>
                        array(
                            'show'      => false,
                            'insert'    => true,
                            'view'      => true,
                            'update'    => true
                        ),
                        'verification'      =>
                        array(
                            'canBeEmpty'	=> false
                        ),
                        'table'             => 'accidents'),
                    array(
                        'name'             => 'property_types_id',
                        'description'      => 'Тип пошкодженого майна',
                        'type'             => fldNote,
                        'list'             => array(
                                                '1' => 'Транспортний засіб',
                                                '2' => 'Майно, крім ТЗ'),
                        'display'          =>
                            array(
                                'show'     => false,
                                'insert'   => true,
                                'view'     => true,
                                'update'   => true
                            ),
                        'verification'     =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'            => 'accidents_go'),
                    array(
                        'name'             => 'property',
                        'description'      => 'Майно, яке не відноситься до ТЗ',
                        'type'             => fldNote,
                        'display'          =>
                            array(
                                'show'     => false,
                                'insert'   => true,
                                'view'     => true,
                                'update'   => true
                            ),
                        'verification'     =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'            => 'accidents_go'),

                        array(
                            'name'              => 'accident_schemes_id',
                            'description'       => 'Схема ДТП',
                            'type'              => fldRadio,
                            'list'              => array (
                                                          '1' => 'Схема1',
                                                          '2' => 'Схема2',
                                                          '3' => 'Схема3',
                                                          '4' => 'Схема4',
                                                          '5' => 'Схема5',
                                                          '6' => 'Схема6',
                                                          '7' => 'Схема7'
                                                   ),
                            'display'           =>
                                array(
                                   'show'       => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents_go'),
                        ////////////////////////////////////////////////////////////////////////////////////////////
                        array(
                            'name'             => 'owner_insurer_company',
                            'description'      => 'Страховик заявника',
                            'type'             => fldText,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents_go'),
                        array(
                            'name'             => 'owner_policies_series',
                            'description'      => 'Серія полісу',
                            'type'             => fldText,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents_go'),
                         array(
                            'name'             => 'owner_policies_number',
                            'description'      => 'Номер полісу',
                            'type'             => fldInteger,
                            'display'          =>
                                array(
                                    'show'     => false,
                                    'insert'   => true,
                                    'view'     => true,
                                    'update'   => true
                                ),
                            'verification'     =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents_go'),
                        array(
                            'name'              => 'mvs_id',
                            'description'       => 'Органи',
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
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents_go',
                            'sourceTable'       => 'mvs',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),

                        array(
                            'name'              => 'mvs_title',
                            'description'       => 'Органи',
                            'type'              => fldText,
							'maxlength'			=> 100,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents_go'),
                        array(
                            'name'              => 'mvs_date',
                            'description'       => 'Органи, дата повідомлення',
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
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents_go'),
                        array(
                            'name'              => 'assistance',
                            'description'       => 'Диспетчерський центр страховика',
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
                                    'canBeEmpty'	=> true
                                ),
                            'table'             => 'accidents'),
						array(
							'name'              => 'documents',
							'description'       => 'Документи',
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
							'table'             => 'accidents'),
                        array(
                            'name'              => 'car_services_id',
                            'description'       => 'СТО',
                            'type'              => fldSelect,
                            'structure'         => 'tree',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents',
                            'sourceTable'       => 'car_services',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'comment',
                            'description'       => 'Комментар',
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
                                    'canBeEmpty'	=> true
                                ),
                            'table'            	=> 'accidents'),
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
                            'verification'		=>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents')
                        ),
                    'common'    =>
                        array(
                            'defaultOrderPosition'  => 16,
                            'defaultOrderDirection' => 'desc',
                            'titleField'            => 'number')
            );

    var $classificationFormDescription =
        array(
            'fields'     =>
                array(
                    array(
                        'name'              => 'id',
                        'type'              => fldIdentity,
                        'display'           =>
                            array(
                                'show'		=> true,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    /*array(
                        'name'              => 'managers_id',
                        'description'       => 'Менеджер',
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
                                'canBeEmpty'	=> false
                            ),
                        'table'            	=> 'accidents'),*/
                    array(
                        'name'              => 'average_managers_id',
                        'description'       => 'Аварійний комісар',
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
                                'canBeEmpty'	=> false
                            ),
                        'table'            	=> 'accidents',
                        'sourceTable'       => 'accounts',
                        'selectField'       => 'lastname',
                        'orderField'        => 'accounts_id'),
                    array(
                        'name'              => 'estimate_managers_id',
                        'description'       => 'Експерт',
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
                                'canBeEmpty'	=> false
                            ),
                        'table'            	=> 'accidents',
                        'sourceTable'       => 'accounts',
                        'selectField'       => 'lastname',
                        'orderField'        => 'id'),
                    array(
                        'name'              => 'expert_organizations_id',
                        'description'       => 'Експертна організація',
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
                                'canBeEmpty'	=> true
                            ),
                        'table'            	=> 'accidents_go',
                        'sourceTable'       => 'expert_organizations',
                        'selectField'       => 'title',
                        'orderField'        => 'id'),
                    array(
                        'name'              => 'amount_rough',
                        'description'       => 'Орієнтовний збиток, грн.',
                        'type'              => fldMoney,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'accident_sections_id',
                        'description'       => 'Категорія',
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
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents',
                        'sourceTable'       => 'accident_sections',
                        'selectField'       => 'title',
                        'orderField'        => 'order_position'),
                    array(
                        'name'              => 'accident_statuses_id',
                        'description'       => 'Статус',
                        'type'              => fldHidden,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'modified',
                        'description'       => 'Редаговано',
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
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents')
                )
            );

	var $riskFormDescription =
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
                                'canBeEmpty'	=> false
                            ),
                        'table'				=> 'accidents'),
                    array(
                        'name'              => 'risks_id',
                        'description'       => 'Ризик',
                        'type'              => fldRadio,
                        'list'              => array (
                                                      '1' => 'Майно',
                                                      '2' => 'Здоров\'я'),
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
					array(
                            'name'              => 'reason_not_payment',
                            'description'       => 'Критерії відмови в виплаті',
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
                            'table'             => 'accidents'),
                    array(
                        'name'              => 'description_average',
                        'description'       => 'Обставини',
                        'type'              => fldNote,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'datetime_average',
                        'description'       => 'Подія',
                        'type'              => fldDateTime,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'address_average',
                        'description'       => 'Адреса',
                        'type'              => fldText,
                        'maxlength'         => 100,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'		=>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'            	=> 'accidents_go'),
                    array(
                        'name'              => 'mvs_average',
                        'description'       => 'Орган куди звернувся',
                        'type'              => fldRadio,
                        'list'              => array (
														  '0' => 'Нікуди',
                                                          '1' => 'ДАІ',
														  '2' => 'Органи МВС',
														  '3' => 'МНС',
                                                          '4' => 'Європротокол'),
                        'display'           =>
                            array(
                               'show'       => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> true
                            ),
                        'table'             => 'accidents_go'),
                    array(
                        'name'              => 'mvs_id_average',
                        'description'       => 'Органи',
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
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents_go',
                        'sourceTable'       => 'mvs',
                        'selectField'       => 'title',
                        'orderField'        => 'title'),
                    array(
                        'name'              => 'mvs_title_average',
                        'description'       => 'Органи',
                        'type'              => fldText,
                        'maxlength'			=> 100,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> true
                            ),
                        'table'             => 'accidents_go'),
                    array(
                        'name'              => 'mvs_date_average',
                        'description'       => 'Органи, дата повідомлення',
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
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents_go'),
                    array(
                        'name'              => 'insurance',
                        'description'       => 'Страховий випадок',
                        'type'              => fldBoolean,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> true
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'reason',
                        'description'       => 'Згідно',
                        'type'              => fldNote,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'payments_id',
                        'description'       => 'Виплата',
                        'type'              => fldRadio,
                        'list'				=> array(
                                                1 => 'СТО',
                                                2 => 'Банк',
                                                3 => 'Вигодонабувач'),
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'criminal',
                        'description'       => 'Кримінальна справа',
                        'type'              => fldRadio,
                        'list'				=> array(
                                                    0 => 'не порушена',
                                                    1 => 'порушена',
                                                    2 => 'призупинена'),
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'regres',
                        'description'       => 'Регрес',
                        'type'              => fldBoolean,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
					array(
                        'name'              => 'regres_info',
                        'description'       => 'Регрес, інформація',
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
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
					array(
                        'name'              => 'insurer_driver_lastname',
                        'description'       => 'Водій забезпеченого ТЗ, прізвище',
                        'type'              => fldText,
                        'maxlength'         => 50,
                        'display'           =>
							array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'				=> 'accidents_go'),
                    array(
                        'name'              => 'insurer_driver_firstname',
                        'description'       => 'Водій забезпеченого ТЗ, прізвище',
                        'type'              => fldText,
                        'maxlength'         => 50,
                        'display'           =>
							array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'				=> 'accidents_go'),
                    array(
                        'name'              => 'insurer_driver_patronymicname',
                        'description'       => 'Водій забезпеченого ТЗ, прізвище',
                        'type'              => fldText,
                        'maxlength'         => 50,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'		=>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'				=> 'accidents_go'),
                    array(
                        'name'              => 'accident_statuses_id',
                        'description'       => 'Статус',
                        'type'              => fldHidden,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'modified',
                        'description'       => 'Редаговано',
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
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
                    array(
                        'name'              => 'fraud',
                        'description'       => 'Спроба шахрайства',
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
                        'table'             => 'accidents_go'
                    )
                )
            );

    var $MTSBUFormDescription =
        array(
            'fields'     =>
                array(
                    array(
                        'name'              => 'id',
                        'type'              => fldIdentity,
                        'display'           =>
                            array(
                                'show'		=> true,
                                'insert'    => false,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
					array(
						'name'              => 'mvs',
						'type'              => fldInteger,
						'display'           =>
							array(
							   'show'       => false,
								'insert'    => false,
								'view'      => true,
								'update'    => false
							),
						'verification'      =>
							array(
								'canBeEmpty'	=> false
							),
						'table'             => 'accidents_go'),
                     array(
                        'name'              => 'accident_statuses_id',
                        'description'       => 'Статус',
                        'type'              => fldHidden,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => false,
                                'view'      => false,
                                'update'    => true
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'table'             => 'accidents'),
					array(
                        'name'              => 'owner_resident',
                        'description'       => 'Резидент',
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
                                'canBeEmpty'    => false
                            ),
                        'table'             => 'accidents_go'),
                     array(
                            'name'              => 'owner_person_types_id',
                            'description'       => 'Власник Тип особи',
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
                            'table'             => 'accidents_go'),
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
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'				=> 'accidents_go'),
                    array(
                        'name'              => 'owner_firstname',
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
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'				=> 'accidents_go'),
                    array(
                        'name'              => 'owner_patronymicname',
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
                        'verification'		=>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'				=> 'accidents_go'),
                    array(
                        'name'              => 'owner_identification_code',
                        'description'       => 'ІПН постраждалого',
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
                        'table'             => 'accidents_go'),
                    array(
                        'name'              => 'owner_insurer_company',
                        'description'       => 'Страхова компанія потерпілого',
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
                        'table'             => 'accidents_go',
                        'sourceTable'       => 'companies_mtsbu',
                        'condition'         => 'selected = 1',
                        'selectField'       => 'title',
                        'orderField'        => 'title'),
                    array(
                        'name'              => 'owner_sign',
                        'description'       => 'Власник, Номер ТЗ',
                        'type'              => fldText,
                        'validationFunction'        => 'isValidSign',
                        'validationFunctionType'    => 'function',
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
                        'table'             => 'accidents_go'),
                     array(
                                'name'                => 'owner_car_type_id',
                                'description'         => 'Власник, Тип ТЗ',
                                'type'                => fldSelect,
                                'showId'              => true,
                                'display'             =>
                                    array(
                                        'show'        => false,
                                        'insert'      => true,
                                        'view'        => true,
                                        'update'      => true
                                    ),
                                'verification'        =>
                                    array(
                                        'canBeEmpty'    => false
                                    ),
                                'table'              => 'accidents_go',
                                'condition'          => 'product_types_id = 4',
                                'sourceTable'        => 'car_types',
                                'selectField'        => 'CONCAT(code,\' - \',title)',
                                'orderField'         => 'order_position'),
                        array(
                                'name'              => 'owner_brand_id',
                                'description'       => 'Власник, Марка ТЗ (ід)',
                                'type'              => fldText,
                                'maxlength'         => 50,
                                'display'           =>
                                    array(
                                        'show'      => false,
                                        'insert'    => true,
                                        'view'      => true,
                                        'update'    => true
                                    ),
                                'verification'		=>
                                    array(
                                        'canBeEmpty'    => false
                                    ),
                                'table'            => 'accidents_go'),
                        array(
                            'name'              => 'owner_brand',
                            'description'       => 'Власник, Марка ТЗ ',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents_go'),
                        array(
                                'name'              => 'owner_model_id',
                                'description'       => 'Власник, Модель ТЗ (ід)',
                                'type'              => fldText,
                                'maxlength'         => 50,
                                'display'           =>
                                    array(
                                        'show'      => false,
                                        'insert'    => true,
                                        'view'      => true,
                                        'update'    => true
                                    ),
                                'verification'		=>
                                    array(
                                        'canBeEmpty'    => false
                                    ),
                                'table'            => 'accidents_go'),
                        array(
                            'name'              => 'owner_model',
                            'description'       => 'Власник, Модель ТЗ',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents_go'),
					array(
                        'name'              => 'owner_zip_code',
                        'description'       => 'Власник, індекс',
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
                        'table'             => 'accidents_go'),
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
                        'table'             => 'accidents_go',
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
                        'table'             => 'accidents_go'),
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
                        'table'             => 'accidents_go'),
                    array(
                        'name'				=> 'owner_street_types_id',
                        'description'		=> 'Власник, тип вулицi',
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
                        'table'				=> 'accidents_go',
                        'sourceTable'		=> 'street_types',
                        'selectField'		=> 'title',
                        'orderField'		=> 'order_position'),
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
                        'table'             => 'accidents_go'),
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
                        'table'             => 'accidents_go'),
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
                        'table'             => 'accidents_go'),
                    array(
                        'name'              => 'owner_phones',
                        'description'       => 'Власник, телефон(и)',
                        'type'              => fldText,
                        'maxlength'         => 100,
                        'display'           =>
                        array(
                            'show'      => false,
                            'insert'    => true,
                            'view'      => true,
                            'update'    => true
                        ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'            => 'accidents_go'),
                    array(
                            'name'              => 'damage_extent_id',
                            'description'       => 'Ступінь ушкоджень',
                            'type'              => fldRadio,
                            'list'              => array (
                                                      '1' => 'Тимчасова втрата працездатності(травма)',
                                                      '2' => 'Стійка втрата працездатності(інвалідність 1 групи)',
                                                      '3' => 'Стійка втрата працездатності(інвалідність 2 групи)',
                                                      '4' => 'Стійка втрата працездатності(інвалідність 3 групи/інвалід-дитина)',
                                                      '5' => 'Смерть',
                                                      '6' => 'Моральна шкода'),
                            'display'           =>
                                array(
                                   'show'       => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accidents_go'),
                    array(
                        'name'              => 'application_risks_id',
                        'description'       => 'Ризик',
                        'type'              => fldRadio,
                        'list'              => array(
                            '1' => 'Майно',
                            '2' => 'Здоров\'я'),
                        'display'           =>
                        array(
                            'show'      => false,
                            'insert'    => true,
                            'view'      => true,
                            'update'    => true
                        ),
                        'verification'      =>
                        array(
                            'canBeEmpty'	=> false
                        ),
                        'table'             => 'accidents'),
                    array(
                        'name'             => 'property_types_id',
                        'description'      => 'Тип пошкодженого майна',
                        'type'             => fldNote,
                        'list'             => array(
                                                '1' => 'Транспортний засіб',
                                                '2' => 'Майно, крім ТЗ'),
                        'display'          =>
                            array(
                                'show'     => false,
                                'insert'   => true,
                                'view'     => true,
                                'update'   => true
                            ),
                        'verification'     =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'            => 'accidents_go'),
                    array(
                        'name'             => 'property',
                        'description'      => 'Майно, яке не відноситься до ТЗ',
                        'type'             => fldNote,
                        'display'          =>
                            array(
                                'show'     => false,
                                'insert'   => true,
                                'view'     => true,
                                'update'   => true
                            ),
                        'verification'     =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'            => 'accidents_go'),
                    array(
                        'name'              => 'insurer_driver_lastname',
                        'description'       => 'Водій забезпеченого ТЗ, прізвище',
                        'type'              => fldText,
                        'maxlength'         => 50,
                        'display'           =>
                        array(
                            'show'      => false,
                            'insert'    => true,
                            'view'      => true,
                            'update'    => true
                        ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'				=> 'accidents_go'),
                    array(
                        'name'              => 'insurer_driver_firstname',
                        'description'       => 'Водій забезпеченого ТЗ, прізвище',
                        'type'              => fldText,
                        'maxlength'         => 50,
                        'display'           =>
                        array(
                            'show'      => false,
                            'insert'    => true,
                            'view'      => true,
                            'update'    => true
                        ),
                        'verification'		=>
                        array(
                            'canBeEmpty'    => false
                        ),
                        'table'				=> 'accidents_go'),
                    array(
                        'name'              => 'insurer_driver_patronymicname',
                        'description'       => 'Водій забезпеченого ТЗ, прізвище',
                        'type'              => fldText,
                        'maxlength'         => 50,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                        'verification'		=>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'				=> 'accidents_go'),
                    array(
                        'name'              => 'insurer_driver_identification_code',
                        'description'       => 'ІПН водія забезпеченого ТЗ',
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
                        'table'             => 'accidents_go'),
                   /*
                    array(
                        'name'              => 'owner_shassi',
                        'description'       => '№ шасі (кузов, рама) заявника',
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
                        'table'             => 'accidents_go'),
                    array(
                        'name'              => 'driver_age',
                        'description'       => 'Вік водія',
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
                        'table'             => 'accidents_go'),
                    array(
                        'name'              => 'driver_sex',
                        'description'       => 'Стать водія',
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
                                'canBeEmpty'    => false
                            ),
                        'table'             => 'accidents_go'),
                    array(
                        'name'              => 'driver_address',
                        'description'       => 'Адреса водія',
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
                                'canBeEmpty'    => false
                            ),
                        'table'             => 'accidents_go'),*/
                    array(
                        'name'              => 'note',
                        'description'       => 'Примітка',
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
                        'table'             => 'accidents_go'),
                )
            );

    function Accidents_GO(&$data) {

        Accidents::Accidents($data);

        $this->messages['plural'] = 'Страхові справи';
        $this->messages['single'] = 'Страхова справа';

		$this->product_types_id = $data['product_types_id'] = PRODUCT_TYPES_GO;
        $this->product_title = $data['product_title'] = 'GO';

        $this->objectTitle = 'Accidents_GO';

		$this->formDescription['fields'][ $this->getFieldPositionByName('days') ]['name'] = 'getDays(' . PREFIX . '_accidents.id) as days';
        $this->formDescription['fields'][ $this->getFieldPositionByName('compensation') ]['name'] = 'getCompensation(' . PREFIX . '_accidents.id, ' . PREFIX . '_accidents.product_types_id) as compensation';
		
		$this->setPreviousStatusesSchema();
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='showGO.php', $limit=true) {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

		$this->mode = 'update';

		$fields[] = 'do';
		$data['do'] = $this->object . '|show&show=go';

        $this->setTables('show');
        $this->setShowFields();

        $query ='SELECT a.id, CONCAT(a.lastname, \' \', a.firstname) AS title ' .
				'FROM ' . PREFIX . '_accounts as a ' .
				'JOIN ' . PREFIX . '_account_groups_managers_assignments AS b ON a.id = b.accounts_id AND account_groups_id = ' . ACCOUNT_GROUPS_AVERAGE . ' ' .
				'ORDER BY title';
		$fields['average_managers'] = $db->getAssoc($query);
		
		$query =	'SELECT id, code, title, level ' .
					'FROM ' . PREFIX . '_car_services ' .
					'ORDER BY top, num_l';
		$fields['car_services'] = $db->getAssoc($query);

		$owner_types_id_sum = array_sum($data['owner_types_id']);
		switch ($owner_types_id_sum) {
			case 1:
				$conditions[] = PREFIX . '_accidents_go.owner_types_id = 1';
				break;
			case 2:
				$conditions[] = PREFIX . '_accidents_go.owner_types_id = 2';
				break;
			default:
				$conditions[] = '((' . PREFIX . '_accidents_go.owner_types_id = 2) OR (' . PREFIX . '_accidents_go.owner_types_id = 1 AND ' . PREFIX . '_accidents_go.relation = 0))';
				break;
		}

        if (intval($data['accidents_id'])) {
            $conditions[] = PREFIX . '_accidents.id <> ' . intval($data['accidents_id']);
        }

        switch ($Authorization->data['roles_id']) {
            case ROLES_MASTER:
                $fields[] = 'car_services_id';
                $data['car_services_id'] = array($Authorization->data['car_services_id']);
                break;
            /*case ROLES_MANAGER:
                if (sizeof($Authorization->data['account_groups_id']) == 1 && in_array(ACCOUNT_GROUPS_SERVICE_DEPARTMENT, $Authorization->data['account_groups_id'])) {
                    $sql_get_accidents = 'SELECT id FROM ' . PREFIX . '_accidents WHERE product_types_id = ' . PRODUCT_TYPES_GO . ' HAVING isVisibleAccidentsServiceDepartment(' . PREFIX. '_accidents.id, ' . $Authorization->data['id'] . ') = 1';
                    $accidents = $db->getCol($sql_get_accidents);
                    if (is_array($accidents) && sizeof($accidents)) {
                        $conditions[] = PREFIX . '_accidents.id IN(' . implode(', ', $accidents) . ')';
                    } else {
                        $conditions[] = '0';
                    }
                }
                break;*/
        }

        if (is_array($data['average_managers_id'])) {
			$fields[] = 'average_managers_id';
			$conditions[] = 'average_managers_id IN(' . implode(', ', $data['average_managers_id']) . ')';
		}

		if (!is_array($data['archive_statuses_id'])) {
			$data['archive_statuses_id'] = array(0);
		}
		
		if (is_array($data['owner_types_id'])) {
			$fields[] = 'owner_types_id';
			$conditions[] = 'owner_types_id IN (' . implode(', ', $data['owner_types_id']) . ')';
		}

		$fields[] = 'archive_statuses_id';
		$conditions[] = 'archive_statuses_id IN (' . implode(', ', $data['archive_statuses_id']) . ')';		

        if ($data['number']) {
            $fields[] = 'number';
            $conditions[] = PREFIX . '_accidents.number LIKE ' . $db->quote($data['number'] . '%');
        }

		if ($data['sign']) {
            $fields[] = 'sign';
            $conditions[] =  'sign LIKE ' . $db->quote($data['sign'] . '%');
        }
		
		if ($data['owner_sign']) {
            $fields[] = 'owner_sign';
            $conditions[] =  'owner_sign LIKE ' . $db->quote('%' . $data['owner_sign'] . '%');
        }

        if($data['repair_classifications_id']){
            $fields[] = 'repair_classifications_id';
            $conditions[] = 'repair_classifications_id IN (' . implode(', ', $data['repair_classifications_id']) . ')';
        }

        if($data['shassi']){
            $fields[] = 'shassi';
            $conditions[] = 'shassi LIKE ' . $db->quote($data['shassi'] . '%');
        }
        
        if ($data['policies_number']) {
            $fields[] = 'policies_number';
            $conditions[] = PREFIX . '_policies.number LIKE ' . $db->quote($data['policies_number'] . '%');
        }

        if ($data['insurer']) {
            $fields[] = 'insurer';
            $conditions[] = '(' . PREFIX . '_policies_go.insurer_lastname LIKE ' . $db->quote('%' . $data['insurer'] . '%') . ')';
        }

        if ($data['applicant']) {
            $fields[] = 'applicant';
            $conditions[] = '(' . PREFIX . '_accidents.applicant_lastname LIKE ' . $db->quote('%' . $data['applicant'] . '%') . ')';
        }

         if ($data['owner']) {
            $fields[] = 'owner';
            $conditions[] = '(' . PREFIX . '_accidents_go.owner_lastname LIKE ' . $db->quote('%' . $data['owner'] . '%') . ')';
        }

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(' . $this->tables[0] . '.date) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] =  'TO_DAYS(' . $this->tables[0] . '.date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }

        if (intval($data['car_services_id'])) {
            switch ($Authorization->data['roles_id']) {
                case ROLES_MASTER:
                    $sql_get_accidents = 'SELECT id FROM ' . PREFIX . '_accidents WHERE product_types_id = ' . PRODUCT_TYPES_GO . ' HAVING isVisibleAccidentsMaster(' . PREFIX. '_accidents.id, ' . $Authorization->data['id'] . ') > 0';
                    $accidents = $db->getCol($sql_get_accidents);
                    if (is_array($accidents) && sizeof($accidents)) {
                        $conditions[] = '(' . PREFIX . '_accidents.id IN(' . implode(', ', $accidents) . ') OR ' . PREFIX . '_accidents.calculation_car_services_id = ' . intval($Authorization->data['car_services_id']) . ')';
                    } else {
						$conditions[] = '(' . PREFIX . '_accidents.car_services_id = ' . intval($data['car_services_id']) . ' OR ' . PREFIX . '_accidents.calculation_car_services_id = ' . intval($Authorization->data['car_services_id']) . ')';
                    }
					break;				
            }
        }
		
		if ($Authorization->data['roles_id'] != ROLES_MASTER && intval($data['car_services_id'])) {
			$conditions[] = PREFIX . '_accidents.car_services_id = ' . intval($data['car_services_id']);
		}

        if ($data['clients_id']) {
            $fields[] = 'clients_id';
            $conditions[] = PREFIX . '_accidents.policies_id IN(SELECT id FROM ' . PREFIX . '_policies WHERE clients_id = ' . intval($data['clients_id']) . ')';
        }

		if (intval($Authorization->data['companies_id'])) {
			$data['companies_id'] = array($Authorization->data['companies_id']);
		}

		if (!is_array($data['companies_id'])) {
			$data['companies_id'] = array(INSURANCE_COMPANIES_EXPRESS);
        }

        if (is_array($data['owner_types_id'])) {
			$fields[] = 'owner_types_id';
			$conditions[] = 'owner_types_id IN (' . implode(', ', $data['owner_types_id']) . ')';
		}


        $conditions_or = array();//спец масив для определения доступа к делам для аваркомов и експертов
        if ($Authorization->data['roles_id'] == ROLES_MANAGER && $this->permissions['updateRisk'] && !$this->permissions['updateRiskAll'] && $this->permissions['updateActs'] && !$this->permissions['updateActsAll'] && !in_array($Authorization->data['id'], array(6560))) {
            if(!$data['accidents_id']) {
			    $conditions_or[] = 'average_managers_id IN(' . implode(', ', $Authorization->data['managers']) . ')';
            }
		}

		if ($Authorization->data['roles_id'] == ROLES_MANAGER && $this->permissions['updateEstimates'] && !intval($this->permissions['updateEstimatesAll'])) {
			$conditions_or[] = 'estimate_managers_id > 0';
		}

        if(sizeof($conditions_or) > 0) {
            $conditions[] = '('. implode(' OR ', $conditions_or) . ')';
        }

		if (is_array($data['accident_statuses_id'])) {
			$fields[] = 'accident_statuses_id';
			$conditions[] = 'accident_statuses_id IN(' . implode(', ', $data['accident_statuses_id']) . ')';
		}

		if (is_array($data['accident_sections_id'])) {
			$fields[] = 'accident_sections_id';
			$conditions[] = 'accident_sections_id IN(' . implode(', ', $data['accident_sections_id']) . ')';
		}

		$fields[] = 'product_types_id';
		$data['product_types_id'] = $this->product_types_id;

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        if ($sql) {
            $sql    .= ' ORDER BY ';
        } elseif (is_array($conditions)) {
            $sql	=	'SELECT ' . $this->getShowFieldsSQLString() . ', insurance, in_express, ' . PREFIX . '_policies.number AS policies_number, ' . PREFIX . '_accidents.policies_id, ' . PREFIX . '_accidents_go.accidents_id, ' . PREFIX . '_accidents.product_types_id, ' .
						'accident_statuses_id AS statuses_id, a.lastname AS average_manager, b.lastname AS estimate_manager,  ' .
						PREFIX . '_accident_sections.title AS accident_sections_title, IF(' . PREFIX . '_accidents_go.owner_types_id = 1,"Страхувальник","Потерпілий") as owner_types_id, ' .
                        'TO_DAYS(NOW()) - TO_DAYS(' . PREFIX . '_accidents.date) AS accidents_days, ' .
						(($Authorization->data['roles_id'] == ROLES_MASTER) ? 'isVisibleAccidentsMaster(' . PREFIX . '_accidents.id, ' . intval($Authorization->data['id']) . ') as visible_like, ' : '') .
                        'getMTSBUDays(' . PREFIX . '_accidents.id) as mtsbu_days, ' . PREFIX . '_clients.important_person, getStateInRepair(' . PREFIX . '_accidents.id) as in_repair, getSummCarService(' . PREFIX . '_accidents.id, ' . PREFIX . '_accidents.car_services_id) as summ_amount ' .
						'FROM ' . PREFIX . '_accidents ' .
						'JOIN ' . PREFIX . '_accidents_go ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_go.accidents_id ' .
						'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
						'JOIN ' . PREFIX . '_policies_go ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_go.policies_id ' .
						'JOIN ' . PREFIX . '_accident_statuses ON ' . PREFIX . '_accidents.accident_statuses_id = ' . PREFIX . '_accident_statuses.id ' .
						'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accidents.masters_id = ' . PREFIX . '_accounts.id ' .
						'JOIN ' . PREFIX . '_payment_statuses ON ' . PREFIX . '_accidents.payment_statuses_id = ' . PREFIX . '_payment_statuses.id ' .
                        'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_policies.clients_id = ' . PREFIX . '_clients.id ' .
						'LEFT JOIN ' . PREFIX . '_accounts AS a ON ' . PREFIX . '_accidents.average_managers_id = a.id ' .
						'LEFT JOIN ' . PREFIX . '_accounts AS b ON ' . PREFIX . '_accidents.estimate_managers_id = b.id ' .
						'LEFT JOIN ' . PREFIX . '_accident_sections ON ' . PREFIX . '_accidents.accident_sections_id = ' . PREFIX . '_accident_sections.id ' .
                    	'WHERE (' . implode(' AND ', $conditions) . ' ' . ') ' .
						'ORDER BY ';
        } else {
            $sql    =	'SELECT ' . $this->getShowFieldsSQLString() . ', insurance, ' . PREFIX . '_policies.number AS policies_number, ' . PREFIX . '_accidents_go.accidents_id, ' . PREFIX . '_accidents.product_types_id, ' .
						'accident_statuses_id AS statuses_id, a.lastname AS average_manager, b.lastname AS estimate_manager, ' .
						PREFIX . '_accident_sections.title AS accident_sections_title ' .
						'FROM ' . PREFIX . '_accidents ' .
						'JOIN ' . PREFIX . '_accidents_go ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_go.accidents_id ' .
						'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_policies.accidents_id ' .
						'JOIN ' . PREFIX . '_policies_go ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_policies_go.accidents_id ' .
						'JOIN ' . PREFIX . '_accident_statuses ON ' . PREFIX . '_accidents.accident_statuses_id = ' . PREFIX . '_accident_statuses.id ' .
						'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accidents.masters_id = ' . PREFIX . '_accounts.id ' .
						'JOIN ' . PREFIX . '_payment_statuses ON ' . PREFIX . '_accidents.payment_statuses_id = ' . PREFIX . '_payment_statuses.id ' .
						'LEFT JOIN ' . PREFIX . '_accounts AS a ON ' . PREFIX . '_accidents.average_managers_id = a.id ' .
						'LEFT JOIN ' . PREFIX . '_accounts AS b ON ' . PREFIX . '_accidents.estimate_managers_id = b.id ' .
						'LEFT JOIN ' . PREFIX . '_accident_sections ON ' . PREFIX . '_accidents.accident_sections_id = ' . PREFIX . '_accident_sections.id ' .
						'ORDER BY ';
        }
        $total = $db->getOne(transformToGetCount($sql));

        $sql .= $this->getShowOrderCondition();
		
        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);

		//добавляем зеленые кружечки, если контрагент совпадает с местом заведения заявления
        foreach($list as $key=>$accident) {
            if($Authorization->data['roles_id'] != ROLES_MASTER && $accident['summ_amount'] > 0 && $accident['in_repair'] == 1) {
                $list[$key]['circle_label'] = 1;
            } elseif($Authorization->data['roles_id'] == ROLES_MASTER && $accident['visible_like'] == 2 && $accident['in_repair'] == 1) {
                $list[$key]['circle_label'] = 1;
            }
        }

		$sql =  'SELECT id, title, level - 1 AS level ' .
				'FROM ' . PREFIX . '_product_types ' .
				'ORDER BY num_l';
		$product_types = $db->getAll($sql, 24 * 60 * 60);

        $fields['accident_statuses_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('accident_statuses_id') ];
        $fields['accident_statuses_id']['list'] = $this->getListValue($fields['accident_statuses_id'], $data);
        $fields['accident_statuses_id']['object'] = $this->buildSelect($fields['accident_statuses_id'], $data['accident_statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data, 'filter');

		$fields['companies_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('companies_id') ];
		$fields['companies_id']['list'] = $this->getListValue($fields['companies_id'], $data);
		$fields['companies_id']['object'] = $this->buildSelect($fields['companies_id'], $data['companies_id'], $data['languageCode'], 'multiple size="2"', null, $data, 'filter');

        $fields['accident_sections_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('accident_sections_id') ];
        $fields['accident_sections_id']['list'] = $this->getListValue($fields['accident_sections_id'], $data);
        $fields['accident_sections_id']['object'] = $this->buildSelect($fields['accident_sections_id'], $data['accident_sections_id'], $data['languageCode'], 'multiple size="3"', null, $data, 'filter');

		if ($Authorization->data['roles_id'] != ROLES_MASTER) {
			$sql =	'SELECT id, title, level - 1 AS level ' .
					'FROM ' . PREFIX . '_car_services ' .
					'ORDER BY num_l, title';
			$car_services = $db->getAll($sql, 60 * 60);
		}

        include 'Accidents/showGO.php';
    }

    function getListValue($field, $data) {
        global $db,$Authorization;

		switch ($field['name']) {
			case 'mvs_id':
				$sql =	'SELECT a.id, a.title, b.title AS regions_title ' .
						'FROM ' . PREFIX . '_mvs AS a ' .
						'JOIN  ' . PREFIX . '_regions AS b ON a.regions_id = b.id ' .
						'ORDER BY b.title, a.title';
				$list =	$db->getAll($sql, 30*60);

				if (is_array($list)) {
					foreach ($list as $row) {
						$options[ $row['id'] ] = array(
							'title'			=> $row['title'],
							'optgroup'		=> $row['regions_title'],
							'obligatory'	=> $row['obligatory']);
					}
				}
				break;
			case 'car_services_id':
				$sql = 'SELECT a.id, a.title, b.title AS regions_title ' .
						'FROM ' . PREFIX . '_car_services AS a ' .
						'JOIN  ' . PREFIX . '_regions AS b ON a.regions_id = b.id ' .
						'ORDER BY b.title, a.title';
				$list =	$db->getAll($sql, 30*60);
				if (is_array($list)) {
					foreach ($list as $row) {
						$options[ $row['id'] ] = array(
							'title'			=> $row['title'],
							'optgroup'		=> $row['regions_title'],
							'obligatory'	=> $row['obligatory']);
					}
				}
				break;
             case 'accident_statuses_id':
                 $field['condition'] =  'id IN (SELECT accident_statuses_id FROM ' . PREFIX . '_accident_statuses_descriptions WHERE product_types_id IN (1,' . $data['product_types_id']. ')) AND order_position <> 0';
                 $options = parent::getListValue($field, $data);

                break;
             case 'inspecting_account_id':
                    switch ($Authorization->data['roles_id']) {
                        case ROLES_MASTER:
                            $field['condition'] =  'id IN (SELECT accounts_id FROM ' . PREFIX . '_masters WHERE car_services_id =' .  $Authorization->data['car_services_id'] . ' )';
                            $options = parent::getListValue($field, $data);
                            break;
                    }
                break;
			default:
				$options = parent::getListValue($field, $data);
        }

        return $options;
    }

    function setConstants(&$data) {
    	global $Authorization;

        parent::setConstants($data);

		//$data['managers_id'] = $this->getManagersId();

        if(!$data['owner_resident']) {
            $data['owner_resident'] = 0;
            $this->formDescription['fields'][ $this->getFieldPositionByName('owner_resident') ]['verification']['canBeEmpty'] = true;
        }
		switch ($Authorization->data['roles_id']) {
			case ROLES_MASTER:
				$data['car_services_id']     = $Authorization->data['car_services_id'];
				$data['masters_id']          = $Authorization->data['id'];
			break;
		}

        switch ($data['do']) {
            case $this->object . '|insert':
                switch ($Authorization->data['roles_id']) {
                    case ROLES_MASTER:
						$data['date_month']	= date('m');
						$data['date_day']	= date('d');
						$data['date_year']	= date('Y');
						break;
                }
            $data['avr_sign'] = 1; //по умолчанию платим мастеру за прием заявлений
            case $this->object . '|update':
		        $data['sign'] = fixSignSimbols($data['sign']);

				switch (intval($data['mvs'])) {
					case 0:
						unset($data['mvs_title']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
						unset($data['mvs_id']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
						unset($data['mvs_title']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
						
						unset($data['owner_insurer_company']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('owner_insurer_company') ]['verification']['canBeEmpty'] = true;
						unset($data['owner_policies_series']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('owner_policies_series') ]['verification']['canBeEmpty'] = true;
						unset($data['owner_policies_number']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('owner_policies_number') ]['verification']['canBeEmpty'] = true;
						unset($data['accident_schemes_id']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('accident_schemes_id') ]['verification']['canBeEmpty'] = true;
						
						unset($data['mvs_date_day']);
						unset($data['mvs_date_month']);
						unset($data['mvs_date_year']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date') ]['verification']['canBeEmpty'] = true;
						break;
					case 1://Органи ДАІ
						unset($data['mvs_title']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
						unset($data['owner_insurer_company']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('owner_insurer_company') ]['verification']['canBeEmpty'] = true;
						unset($data['owner_policies_series']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('owner_policies_series') ]['verification']['canBeEmpty'] = true;
						unset($data['owner_policies_number']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('owner_policies_number') ]['verification']['canBeEmpty'] = true;
						unset($data['accident_schemes_id']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('accident_schemes_id') ]['verification']['canBeEmpty'] = true;
						break;
					case 2:
					case 3:
						unset($data['mvs_id']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
						
						unset($data['insurance_company_other']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('insurance_company_other') ]['verification']['canBeEmpty'] = true;
						unset($data['policies_series_other']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('policies_series_other') ]['verification']['canBeEmpty'] = true;
						unset($data['policies_number_other']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('policies_number_other') ]['verification']['canBeEmpty'] = true;
						unset($data['accident_schemes_id']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('accident_schemes_id') ]['verification']['canBeEmpty'] = true;
						
						break;
						
					case 4://Європротокол
						unset($data['mvs_id']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
						unset($data['mvs_title']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
						unset($data['mvs_date_day']);
						unset($data['mvs_date_month']);
						unset($data['mvs_date_year']);

						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date') ]['verification']['canBeEmpty'] = true;
						break;
						
				}

                if($data['application_risks_id'] == 1) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('damage_extent_id') ]['verification']['canBeEmpty'] = true;
                }

                if (intval($data['assistance'])) {

                    unset($data['assistance_reason']);
                    $this->formDescription['fields'][ $this->getFieldPositionByName('assistance_reason') ]['verification']['canBeEmpty'] = true;

					if (intval($data['assistance_place'])) {
						$data['assistance_date_day']	= $data['datetime_day'];
						$data['assistance_date_month']	= $data['datetime_month'];
						$data['assistance_date_year']	= $data['datetime_year'];
						$data['assistance_date']		= $data['datetime'];
					}
                } else {

                    unset($data['assistance_date_day']);
                    unset($data['assistance_date_month']);
                    unset($data['assistance_date_year']);

                    $this->formDescription['fields'][ $this->getFieldPositionByName('assistance_date') ]['verification']['canBeEmpty'] = true;
                }
                break;
			case $this->object . '|updateRisk':

				$this->formDescription['fields'][ $this->getFieldPositionByName('insurer_driver_lastname') ]['display']['update'] = false;
				$this->formDescription['fields'][ $this->getFieldPositionByName('insurer_driver_firstname') ]['display']['update'] = false;
				$this->formDescription['fields'][ $this->getFieldPositionByName('insurer_driver_patronymicname') ]['display']['update'] = false;
				
				if ($data['regres'] == 1) {
					$regres_info = array();
					$regres_info['regres_reason'] = $data['regres_reason'];
					$regres_info['regres_person'] = $data['regres_person'];
				
					$data['regres_info'] = serialize($regres_info);
				} else {
					$this->formDescription['fields'][ $this->getFieldPositionByName('regres_info') ]['display']['update'] = false;
				}
			
				$fields = array();

				switch (intval($data['insurance'])) {
					case 1://страхова, з виплатою
						$fields[] = 'reason';
						break;
					case 2://страхова, без виплати
					case 3://не страхова
						$fields[] = 'payments_id';
						break;
				}

				switch (intval($data['mvs_average'])) {
					case 0://Нiкуди
						unset($data['mvs_id_average']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ]['verification']['canBeEmpty'] = true;
						unset($data['mvs_title_average']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title_average') ]['verification']['canBeEmpty'] = true;

						unset($data['mvs_date_average_day']);
						unset($data['mvs_date_average_month']);
						unset($data['mvs_date_average_year']);

						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date_average') ]['verification']['canBeEmpty'] = true;
						break;
					case 1://Органи ДАІ
						unset($data['mvs_title_average']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title_average') ]['verification']['canBeEmpty'] = true;

						break;
					case 2:
					case 3://Органи МВС или МНС
						unset($data['mvs_id_average']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ]['verification']['canBeEmpty'] = true;
						break;
					case 4://Нiкуди
						unset($data['mvs_id_average']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ]['verification']['canBeEmpty'] = true;
						unset($data['mvs_title_average']);
						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title_average') ]['verification']['canBeEmpty'] = true;

						unset($data['mvs_date_average_day']);
						unset($data['mvs_date_average_month']);
						unset($data['mvs_date_average_year']);

						$this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date_average') ]['verification']['canBeEmpty'] = true;
						break;
				}

				if (is_array($fields)) {
					foreach ($fields as $field) {
						unset( $data[ $field ] );
						$this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['verification']['canBeEmpty'] = true;
					}
				}
				break;
            case $this->object . '|updateMTSBU':
                //заменяем английские символы на укр.                                              f
                $data['owner_sign'] = fixSignSimbols($data['owner_sign']);
                $data['owner_shassi'] = fixShassiSimbols($data['owner_shassi']);
                if ($data['owner_person_types_id'] == 2) {
                    $data['owner_lastname'] = $data['owner_company'];
				    $this->formDescription['fields'][ $this->getFieldPositionByName( 'owner_firstname' ) ]['verification']['canBeEmpty'] = true;
                    $this->formDescription['fields'][ $this->getFieldPositionByName( 'owner_patronymicname' ) ]['verification']['canBeEmpty'] = true;
                }
                break;
        }

        switch($data['owner_types_id']) {
            case '1':// Власник - страхувальник
                $data['application_risks_id'] = 1;
                //массив необязательных полей, если Власник - страхователь
                $fields = array(
                                'owner_lastname',
                                'owner_firstname',
                                'owner_patronymicname',
                                'owner_car_type_id',
                                'owner_brand_id',
                                'owner_brand',
                                'owner_model_id',
                                'owner_model',
                                'owner_sign',
                                'owner_regions_id',
                                'owner_area',
                                'owner_city',
                                'owner_street_types_id',
                                'owner_street',
                                'owner_house',
                                'owner_flat',
                                'owner_phones',
                                'driver_lastname',
				                'driver_firstname',
				                'driver_patronymicname',
                                'driver_licence_series',
                                'driver_licence_number',
                                'driver_licence_date',
                                'driver_document',
                                'damage_extent_id',
                                'property_types_id',
                                'property'
                );

                foreach ($fields as $field) {
                    unset( $data[ $field ] );
                    $this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['verification']['canBeEmpty'] = true;
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['validationFunction']);

                }
                break;
            case '2':// Власник - потерпілий
                /*//Если не поставили галочку, что Власник совпадает с заявителем
                if(intval($data['applicant_is_owner']) != 1) {
                    $data['applicant_lastname']         = $data['owner_lastname'];
                    $data['applicant_firstname']        = $data['owner_firstname'];
                    $data['applicant_patronymicname']   = $data['owner_patronymicname'];
                    $data['applicant_regions_id']       = $data['owner_regions_id' ];
                    $data['applicant_area']             = $data['owner_area'];
                    $data['applicant_city']             = $data['owner_city'];
                    $data['applicant_street_types_id']  = $data['owner_street_types_id'];
                    $data['applicant_street']           = $data['owner_street'];
                    $data['applicant_house']            = $data['owner_house'];
                    $data['applicant_flat']             = $data['owner_flat'];
                    $data['applicant_phones']           = $data['owner_phones'];
                }*/

                switch($data['application_risks_id']){
                    case '1':
                        $fields = array('damage_extent_id');
                             if($data['property_types_id'] == 2) {
                                $fields =  array_merge($fields,  array(
                                                                        'owner_car_type_id',
                                                                        'owner_brand_id',
                                                                        'owner_brand',
                                                                        'owner_model_id',
                                                                        'owner_model',
                                                                        'owner_sign'));
                             }
                             elseif($data['property_types_id'] == 1) {
                                     $fields[] = 'property';
                             }
                        break;
                    case '2':
                         $fields =  array( 'property',
                                            'property_types_id',
                                           'owner_car_type_id',
                                           'owner_brand_id',
                                           'owner_brand',
                                           'owner_model_id',
                                           'owner_model',
                                           'owner_sign');
                        break;
                }
                foreach ($fields as $field) {
                            unset( $data[ $field ] );
                            $this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['verification']['canBeEmpty'] = true;
                            unset($this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['validationFunction']);

                }

                break;
            }
    }

    function checkFields($data, $action) {
        global $Log,$db;

        parent::checkFields($data, $action);

        if($data['do'] == $this->object . '|update') {

            $sql = 'SELECT date_format(datetime, \'' . DATE_FORMAT . '\') as datetime, policies_id ' .
                   'FROM ' . PREFIX. '_accidents ' .
                   'WHERE id = ' . intval($data['accidents_id']);
            $row = $db->getRow($sql);

            if(($data['policies_id'] != $row['policies_id'] || $data['datetime'] != $row['datetime'])){
                $this->insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;">Спробував змінити дату події або поліс страхування</b>'));
                $Log->add('error', '<b>Дані зміни по справі можуть привести до серйозніх проблем в роботі системи. Потрібно повідомити у Головний офіс.</b>');
            }
        }

        switch ($data['do']) {
            case $this->object . '|insert':
            case $this->object . '|update':

            $data['step'] = 1;
            $temp_formDescription = $this->formDescription;
            $this->formDescription = $this->MTSBUFormDescription;
            $this->getFormFields('view');//выбираем все поля
            $identityField = $this->getIdentityField();
            $this->formDescription = $temp_formDescription;

            $sql = 'SELECT ' . implode(', ', $this->formFields) . ' ' .
                   'FROM ' . PREFIX . '_accidents ' .
                   'JOIN ' . PREFIX . '_accidents_go ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_go.accidents_id ' .
                   'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
            $list = $db->getRow($sql);

            foreach($this->MTSBUFormDescription['fields'] as $field) {
                if(($data['accident_statuses_id'] == 2 && (intval($list[$field['name']]) == 0 || empty($list[$field['name']]))) && $data['accident_statuses_id'] == ACCIDENT_STATUSES_INVESTIGATION){
                    $Log->add('error', 'Не всі поля у вкладці МТСБУ булі заповнені');
                    break;
                }
            }

                if ((strtotime($data['datetime']) < strtotime($data['policies_begin_datetime_format'][$data['policies_id']]) || strtotime($data['datetime']) > strtotime($data['policies_interrupt_datetime_format'][$data['policies_id']])) && $data['count_items_id'] > 1) {
                    $Log->add('error', 'Дата настання страхового випадку не підпадає під строк дії полісу.');
                }

                if (checkdate($data['datetime_month'], $data['datetime_day'], intval($data['datetime_year'])) &&
                    mktime() - mktime(0, 0, 0, $data['datetime_month'], $data['datetime_day'], $data['datetime_year']) < 0) {
                        $Log->add('error', 'Не вірно вказали дату настання страхового випадку.');
                }

				//проверяем дату уведомления МВД, не меньше ли она даты события
				if (checkdate($data['mvs_date_month'], $data['mvs_date_day'], $data['mvs_date_year'])) {
					if (mktime(0, 0, 0, $data['datetime_month'], $data['datetime_day'], $data['datetime_year']) > mktime(0, 0, 0, $data['mvs_date_month'], $data['mvs_date_day'], $data['mvs_date_year'])) {
						$Log->add('error', '<b>Дата повідомлення</b> не може бути раніше <b>Дати події</b>.');
					}
				}

				//проверяем дату уведомления Ассистанса
                if (checkdate($data['assistance_date_month'], $data['assistance_date_day'], intval($data['assistance_date_year'])) &&
                    mktime() - mktime(0, 0, 0, $data['assistance_date_month'], $data['assistance_date_day'], $data['assistance_date_year']) < 0) {
                        $Log->add('error', 'Не вірно вказали дату повідомлення диспетчерського центра страховика.');
                }

				//проверяем дату заявления, не меньше ли она даты события
				if (checkdate($data['date_month'], $data['date_day'], $data['date_year'])) {
					if (mktime(0, 0, 0, $data['datetime_month'], $data['datetime_day'], $data['datetime_year']) > mktime(0, 0, 0, $data['date_month'], $data['date_day'], $data['date_year'])) {
						$Log->add('error', '<b>Дата заяви</b> не може бути раніше <b>Дати події</b>.');
					}
				}
                //проверка на вводимую дату наступления страхового события
                $this->dates_validate($data['datetime_year'],'<b>Дата настання пригоди</b> невірна');
               /* if($data['owner_types_id'] != 1) {
                    //проверка на вводимую дату выдачи прав
                    $this->dates_validate($data['driver_licence_date_year'],'<b>Дата водійських прав</b> невірна');
                }*/
                //проверка на вводимую дату сообщеня в диспетчерский центр
                if($data['assistance_date']){
                    $this->dates_validate($data['assistance_date'],'<b>Дата повідомлення в диспетчерський центр</b> невірна');
                }

                break;
			case $this->object . '|updateClassification':
				if ($data['amount_rough'] != '' && intval($data['amount_rough']) <= 0) {
					$params = array($this->formDescription['fields'][ $this->getFieldPositionByName('amount_rough') ]['description'], null);
					$Log->add('error', 'The <b>%s</b>%s format is not valid.', $params);
				} elseif ($this->getMVSType($data['id']) == 2 && $data['amount_rough'] > 20000) {
					$Log->add('error', 'Орієнтовний збиток не може переаищувати ліміт в 20 000 грн.');
				} elseif ($this->getMVSType($data['id']) == 1 && $this->getApplicationRisksId($data['id']) == 1 && $data['amount_rough'] > 50000) {
					$Log->add('error', 'Орієнтовний збиток не може переаищувати ліміт в 50 000 грн.');
				} elseif ($this->getMVSType($data['id']) == 1 && $this->getApplicationRisksId($data['id']) == 2 && $data['amount_rough'] > 100000) {
					$Log->add('error', 'Орієнтовний збиток не може переаищувати ліміт в 100 000 грн.');
				}
				break;
			case $this->object . '|updateRisk':
				if (is_array($data['documents'])) {
					foreach ($data['documents'] as $document) {
						if (!intval($document['product_document_types_id'])) {
							$params = array('Тип документу', null);
							$Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
						}

						if (!intval($document['statuses_id'])) {
							$params = array('Статус', null);
							$Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
						} elseif (intval($document['statuses_id']) < intval($document['statuses_idOld'])) {
							$params = array('Статус', null);
							$Log->add('error', '<b>%s</b>%s не може бути зміненний на пепередній.', $params);
						}
					}
				}
				
				if ($data['regres'] == 1) {
					if (strlen($data['regres_reason']) == 0) {
						$Log->add('error', '<b>Підстава для регресного позову</b> обов\'язкова для заповнення.', $params);
					}
					if (strlen($data['regres_person']) == 0) {
						$Log->add('error', '<b>Винуватець</b> обов\'язковий для заповнення.', $params);
					}
				}
				break;
        }
    }

	function getPoliciesValues($accidents_id) {
		global $db;

		$sql =	'SELECT a.companies_id, a.policies_id, a.comment, a.monitoring_managers_id, a.car_services_id, '.
                'b.accidents_id, c.number AS policies_number, b.expert_organizations_id,  ' .
				'date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, ' .
				'c.amount AS policies_amount, c.product_types_id, ' .
				'SUM(e.amount) AS policy_payments_amount ' .
				'FROM ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_accidents_go AS b ON a.id = b.accidents_id ' .
				'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
				'JOIN ' . PREFIX . '_policies_go AS d ON a.policies_id = d.policies_id ' .
				'LEFT JOIN ' . PREFIX . '_policy_payments AS e ON a.policies_id = e.policies_id ' .
				'WHERE a.id = ' . intval($accidents_id);

		return $db->getRow($sql, 30 * 60);
	}

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        switch ($_REQUEST['do']) {
            case $this->object . '|load':
            case $this->object . '|view':
                $sql =  'SELECT a.monitoring_managers_id, d.shassi, d.sign, d.brand, d.model, ' .
						'd.insurer_lastname, d.insurer_passport_series, d.insurer_passport_number, d.insurer_identification_code, d.insurer_driver_licence_series, d.insurer_driver_licence_number, ' .
						'e.number AS policies_number, e.date AS policies_date, date_format(e.date, ' . $db->quote('%Y') . ') AS policies_date_year, date_format(e.date, ' . $db->quote('%m') . ') AS policies_date_month, date_format(e.date, ' . $db->quote('%d') . ') AS policies_date_day ' .
						'FROM ' . PREFIX . '_accidents AS a ' .
                        'LEFT JOIN ' . PREFIX . '_accidents_go AS b ON a.id = b.accidents_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_go AS d ON a.policies_id = d.policies_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies AS e ON a.policies_id = e.id ' .
                        'WHERE a.id = ' . intval($data['id']);
                $row =  $db->getRow($sql);

                $data = array_merge($data, $row);

                break;
			case $this->object . '|viewClassification':
			case $this->object . '|updateClassification':
                $data = array_merge($data, $this->getPoliciesValues($data['id']));
				break;
			case $this->object . '|viewRisk':
			case $this->object . '|updateRisk':
				$row = $this->getPoliciesValues($data['id']);
				if ($data['regres'] == 1) {
					if($data['regres_info'] != ''){
						$data = array_merge($data, unserialize($data['regres_info']));
					}
				}

                $data = array_merge($data, $row);
				break;
        }

		$data['accidents_id'] = $data['id'];

        return $data;
    }

	function setAdditionalFields($id, $data, $init=false) {
		global $db;

		parent::setAdditionalFields($id, $data);

        $sql =	'SELECT date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, ' .
                                       'date_format(c.end_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_end_datetime_format ' .
                                       'FROM ' . PREFIX . '_accidents AS a ' .
                                       'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
                                       'WHERE a.id = ' . intval($data['id']);
                       $row =  $db->getRow($sql);
                       $data = array_merge($data, $row);

		if ($init) {
			$sql =	'UPDATE ' . PREFIX . '_accidents SET ' .
					'datetime_average = datetime, ' .
					'description_average = description ' .
					'WHERE id = ' . intval($id);
			$db->query($sql);

			$sql =	'UPDATE ' . PREFIX . '_accidents_go, ' . PREFIX . '_accidents SET ' .
					'address_average = address, ' .
					'mvs_average = mvs, ' .
					'mvs_id_average = mvs_id, ' .
					'mvs_title_average = mvs_title, ' .
					'mvs_date_average = mvs_date ' .
					'WHERE accidents_id = ' . intval($id) . ' AND id = ' . intval($id);
			$db->query($sql);

			//фиксируем данные по органам ГАИ
			if (intval($data['mvs_id']) && intval($data['mvs']) == 1) {
				$sql =	'UPDATE ' . PREFIX . '_accidents_go, ' . PREFIX . '_mvs SET ' .
						'mvs_title = title, ' .
						'mvs_title_average = title ' .
						'WHERE ' . PREFIX . '_accidents_go.mvs_id = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['id']);
				$db->query($sql);
			} else {
				$sql =	'UPDATE ' . PREFIX . '_accidents_go SET ' .
						'mvs_title_average = mvs_title ' .
						'WHERE accidents_id = ' . intval($data['id']);
				$db->query($sql);
			}
		} elseif (intval($data['mvs_id']) && intval($data['mvs']) == 1) {
			$sql =	'UPDATE ' . PREFIX . '_accidents_go, ' . PREFIX . '_mvs SET ' .
					'mvs_title = title ' .
					'WHERE ' . PREFIX . '_accidents_go.mvs_id = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['id']);
			$db->query($sql);
		}


	}

 	function getProductType() {
		return PRODUCT_TYPES_GO;
	}

    function insert($data) {
        global $Log;

        $data['step'] = 1;

        $data['accidents_id'] = parent::insert(&$data, false, true);
//exit;
        if ($data['accidents_id']) {

            $this->setNumber($data);

			$this->setAdditionalFields($data['accidents_id'], $data, true);

			$this->generateDocuments($data['accidents_id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_FRONT_PAGE_GO, /*DOCUMENT_TYPES_ACCIDENT_GO_DECLARATION*/), $data);

            $this->updateStep($data['accidents_id'], $data['step'] + 1);

			$AccidentStatusChanges = new AccidentStatusChanges($data);
			$AccidentStatusChanges->set($data['accidents_id']);

            $this->insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;">Справу створено:</label> <b>' . date("d.m.Y") . '</b>'));

            if (strtotime($data['datetime']) < strtotime($data['policies_begin_datetime_format'][$data['policies_id']]) || strtotime($data['datetime']) > strtotime($data['policies_interrupt_datetime_format'][$data['policies_id']])) {
                $this->insertAccidentsComment(array('ei' => true, 'accidents_id' => $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;"><b>Дата настання страхового випадку не підпадає під строк дії полісу</b></label>'));
            }

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];
			
			if (!intval($data['application_accidents_id'])) {
				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
			
				switch ($data['accident_statuses_id']) {
					case ACCIDENT_STATUSES_APPLICATION:
						header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|load&id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
						break;
					case ACCIDENT_STATUSES_CLASSIFICATION:
						header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
				}

				exit;
			}
        }
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template='goApplication.php') {
        global $db;

      	$this->checkPermissions('update', $data);

       	if ($data['accidents_id']) {
			$data['id'] = $data['accidents_id'];
       	} elseif (is_array($data['id'])) {
       		$data['id'] = $data['id'][0];
       	}

        $this->setTables('load');
        $this->getFormFields('update');

		$_POST['applications']['victim_accidents_id'] = $data['victim_accidents_id'];
		$_POST['applications']['insurer_accidents_id'] = $data['insurer_accidents_id'];
		
        $sql =  'SELECT ' . implode(', ', $this->formFields) . ', ' . PREFIX . '_accidents_go.accidents_id, accident_statuses_id, car_services_id, description, mvs_id, mvs, ' . PREFIX . '_policies.price AS policies_price, owner_types_id, ' .
                            PREFIX . '_policies.product_types_id, '. PREFIX . '_policies.id as policies_id '.
                'FROM ' . PREFIX . '_accidents ' .
        		'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
        		'JOIN ' . PREFIX . '_policies_go ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_go.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_go ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_go.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_clients.id = ' . PREFIX . '_policies.clients_id ' .
                'WHERE ' . PREFIX . '_accidents.id = ' . intval($data['id']);
        $data = $db->getRow($sql);

        $data['important_person'] = Accidents::getImportantPerson($data['policies_id']);

        $companies_mtsbu = $db->getCol('SELECT title FROM ' . PREFIX . '_companies_mtsbu WHERE selected = 1 ORDER BY title');

        $data = $this->prepareFields($action, $data);

        if ($_REQUEST['do'] == $this->object . '|load') {
			switch ($data['accident_statuses_id']) {
				case ACCIDENT_STATUSES_APPLICATION:
					break;
				case ACCIDENT_STATUSES_CLASSIFICATION:
					if ($application == 1 || !$this->permissions['updateClassification']) break;
					if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Classification') {
						header('Location: /?do=' . $this->object . '|' . $this->mode . 'Classification&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_GO);
						exit;
					}
					break;
                case ACCIDENT_STATUSES_MTSBU:
                    if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'MTSBU') {
						header('Location: /?do=' . $this->object . '|' . $this->mode . 'MTSBU&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_GO);
						exit;
					}
                    break;
				case ACCIDENT_STATUSES_INVESTIGATION:
				case ACCIDENT_STATUSES_REINVESTIGATION:
				case ACCIDENT_STATUSES_DEFECTS:
					if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Risk') {
						header('Location: /?do=' . $this->object . '|' . $this->mode . 'Risk&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_GO);
						exit;
					}
					break;
				case ACCIDENT_STATUSES_COORDINATION:
					if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Acts') {
						header('Location: /?do=' . $this->object . '|' . $this->mode . 'Acts&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_GO);
						exit;
					}
					break;
			}
        }

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function showForm($data, $action, $actionType=null, $template='goApplication.php') {
        global $db, $Authorization, $ACCIDENT_STATUSES_SCHEMA;

        parent::showForm($data, $action, $actionType, $template);
    }

    function view($data, $conditions=null, $sql=null, $template='goApplication.php', $showForm=true) {
        global $Log, $db;

        if(is_array($data['id'])){
            $data['id'] = $data['id'][0];
        }

        if (intval($data['accidents_id'])) {
            $data['id'] = $data['accidents_id'];
        }

		$this->setTables('view');
		$this->getFormFields('view');

        if($data['loadPaymentApplication']) {
            $conditions[] = 'accidents_id = ' .intval($data['id']);
            $conditions[] = 'product_document_types_id 	= ' . DOCUMENT_TYPES_ACCIDENT_GO_PAYMENT_DECLARATION;

            $sql = 'SELECT id, 6 as position ' .
                   'FROM ' . PREFIX . '_accident_documents ' .
                   'WHERE ' . implode(' AND ', $conditions);
            $row = $db->getRow($sql);
            $row['position'] = intval($row['position']);

            $data['file'] = $row;
            $msg = '<b>Заяву на виплату було створено, скачати можна <a href="' . $_SERVER['SCRIPT_URI'] . '?do=AccidentDocuments|downloadFileInWindow&file='.urlencode(serialize($data['file'])).'">тут</a></b>';
            $Log->add('confirm', $msg);

        }
		
		$_POST['applications']['victim_accidents_id'] = $data['victim_accidents_id'];
		$_POST['applications']['insurer_accidents_id'] = $data['insurer_accidents_id'];
        $_POST['owner_types_id'] = intval($data['owner_types_id']);

		$identityField = $this->getIdentityField();

		$sql =	'SELECT ' . implode(', ', $this->formFields) . ', companies_id, ' . PREFIX . '_policies.product_types_id, ' . PREFIX . '_clients.important_person ' .
				'FROM ' . PREFIX . '_accidents ' .
				'JOIN ' . PREFIX . '_accidents_go ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_go.accidents_id ' .
				'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
				'JOIN ' . PREFIX . '_policies_go ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_go.policies_id ' .
                 'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_clients.id = ' . PREFIX . '_policies.clients_id ' .
				'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
		return parent::view($data, null, $sql, $template, $showForm);
    }

    function update($data) {
        global $Log;

        $data['accidents_id'] = parent::update(&$data, false, true);

        if ($data['accidents_id']) {

			$this->setAdditionalFields($data['accidents_id'], $data);

			$this->generateDocuments($data['accidents_id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_FRONT_PAGE_GO, /*DOCUMENT_TYPES_ACCIDENT_GO_DECLARATION*/), $data);

            $this->updateStep($data['accidents_id'], $data['step'] + 1);

			$AccidentStatusChanges = new AccidentStatusChanges($data);
			$AccidentStatusChanges->set($data['accidents_id']);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

			$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

			if (!intval($data['application_accidents_id'])) {
				switch ($data['accident_statuses_id']) {
					case ACCIDENT_STATUSES_APPLICATION:

						header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|load&id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
						break;
					case ACCIDENT_STATUSES_CLASSIFICATION:
						//Подтверждаем все прикрепленные документы к делу
						$AccidentDocument = new AccidentDocuments($data);
						$documents_id = $AccidentDocument->getListId($data['accidents_id']);
						$AccidentDocument->setAdditionalFields($documents_id,$data);

						header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
						break;
					default:
						($this->permissions['updateClassification'])
							? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateClassification&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id'])
							: header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
						break;
				}
				exit;
			}
        }
    }

    function updateClassification($data) {
		global $Log;

		$this->checkPermissions('updateClassification', $data);
		
		$_POST['applications']['victim_accidents_id'] = $data['victim_accidents_id'];
		$_POST['applications']['insurer_accidents_id'] = $data['insurer_accidents_id'];

        $this->formDescription = $this->classificationFormDescription;

        if ($_POST['do'] == $this->object . '|updateClassification') {



			$data['accident_statuses_id'] = ACCIDENT_STATUSES_MTSBU;

			$this->permissions['update'] = $this->permissions['updateClassification'];

            if (Form::update($data, false, false)) {
				//формируем лист согласования
				$this->generateDocuments($data['id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_NOTE_AGREEMENT), $data);

                //пишем коментарий в мониторинг
                $this->insertAccidentsComment(array('accidents_id'              => $data['id'],
                                                    'monitoring_managers_id'    => $data['average_managers_id'],
                                                    'setAccidentsMonitor'       => true));

                $this->updateStep($data['id'], 2);

				$AccidentStatusChanges = new AccidentStatusChanges($data);
				$AccidentStatusChanges->set($data['id']);
//_dump($data['owner_types_id']);exit;
                if($data['owner_types_id'] == 2) {
                    $this->setInsurerAccidentsResponsible($data['id']);
                }

                //создаем задачу, если была выбрана експертная организация при класификации
                if($data['expert_organizations_id']) {

                    $AccidentMessages = new AccidentMessages($data);
                    $AccidentMessages->permissions['insert'] = true;

                    $row = $this->getPoliciesValues($data['id']);

                    $row['recipient_roles_id']          = ROLES_EXPERT;
                    $row['expert_organizations_id']     = $data['expert_organizations_id'];
                    $row['statuses_id']                 = ACCIDENT_MESSAGE_STATUSES_QUESTION;

                    $AccidentMessages->insert($row,false);
                }

				$params['title']    = $this->messages['single'];
				$params['id']       = $data['id'];
				$params['storage']  = $this->tables[0];

				$Log->add('confirm', 'Справу класифіковано.' , $params);

				($this->permissions['updateMTSBU'])
					? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateMTSBU&accidents_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'])
					: header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
				exit;
            }

            $data = $this->replaceSpecialChars($data, 'update');

        } else {
			$data = $this->load($data, false, 'updateClassification');
        }
        $data['important_person'] = $this->getImportantPerson($data['policies_id']);

        return $this->showForm($data, 'updateClassification', 'update', 'goClassification.php');
    }

    function loadPaymentApplication($data) {
        global $db, $Authorization, $ACCIDENT_STATUSES_SCHEMA;

        $data = array_merge($data, $this->get($data));

        $this->generateDocuments($data['accidents_id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_GO_PAYMENT_DECLARATION), $data);

        header('Location: ' . $_SERVER['SCRIPT_URI'] .'?do=Accidents|view&id=' . $data['accidents_id'] .
                            '&offsetAccidentsBlock=&totalAccidentsBlock=7&product_types_id=' .
                             $data['product_types_id'].'&loadPaymentApplication=1');
    }

    function viewClassification($data) {

		$this->checkPermissions('view', $data);
		
		$_POST['applications']['victim_accidents_id'] = $data['victim_accidents_id'];
		$_POST['applications']['insurer_accidents_id'] = $data['insurer_accidents_id'];

        if ($_POST['do'] == $this->object . '|viewClassification') {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewRisk&accidents_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
            exit;
        }

        $this->formDescription = $this->classificationFormDescription;

		$data['id'] = $data['accidents_id'];
        $data = $this->view($data, null, null, null, false);
        $data['important_person'] = $this->getImportantPerson($data['policies_id']);

		return $this->showForm($data, 'viewClassification', 'view', 'goClassification.php');
    }

    function viewMTSBU($data) {

		$this->checkPermissions('view', $data);
		
		$_POST['applications']['victim_accidents_id'] = $data['victim_accidents_id'];
		$_POST['applications']['insurer_accidents_id'] = $data['insurer_accidents_id'];

        $this->formDescription = $this->MTSBUFormDescription;

        $data = $this->view($data, null, null, null, false);

		return $this->showForm($data, 'viewMTSBU', 'view', 'goMTSBU.php');
    }

    function updateMTSBU($data) {
        global $Log;

		$this->checkPermissions('updateMTSBU', $data);
		
		$_POST['applications']['victim_accidents_id'] = $data['victim_accidents_id'];
		$_POST['applications']['insurer_accidents_id'] = $data['insurer_accidents_id'];

        $this->formDescription = $this->MTSBUFormDescription;

        if ($_POST['do'] == $this->object . '|updateMTSBU') {

            $data['accident_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;
            $data['owner_types_id'] = 2;

	        $this->permissions['update'] = $this->permissions['updateMTSBU'];

            if (Form::update($data, false, false)) {

                $this->updateStep($data['id'], 3);

                $AccidentStatusChanges = new AccidentStatusChanges($data);
				$AccidentStatusChanges->set($data['id']);

                $params['title']    = $this->messages['single'];
				$params['id']       = $data['id'];
				$params['storage']  = $this->tables[0];

				$Log->add('confirm', 'Параметри для МТСБУ прийняті.' , $params);

			    ($this->permissions['updateRisk'])
						? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateRisk&accidents_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'])
						: header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
            }
        } else {
            $data = $this->load($data, false, 'updateMTSBU');
        }

		return $this->showForm($data, 'updateMTSBU', 'update', 'goMTSBU.php');
    }

    function updateRisk($data) {
		global $db, $Log;

        //устанавливаем ограничения для для редактирования актов при расмотрении
        $conditions_payment_statuses = array(
			PAYMENT_STATUSES_PARTIAL,
			PAYMENT_STATUSES_PAYED,
			PAYMENT_STATUSES_OVER);

        $conditions_statuses_acts = array(
			ACCIDENT_STATUSES_PAYMENT,
			ACCIDENT_STATUSES_RESOLVED);

		$this->checkPermissions('updateRisk', $data);

        $this->formDescription = $this->riskFormDescription;
		
		$_POST['applications']['victim_accidents_id'] = $data['victim_accidents_id'];
		$_POST['applications']['insurer_accidents_id'] = $data['insurer_accidents_id'];

        if ($_POST['do'] == $this->object . '|updateRisk') {

			$accident_statuses_id = $this->getAccidentStatusesId($data['id']);

            $data['accident_statuses_id'] = ($accident_statuses_id == ACCIDENT_STATUSES_REINVESTIGATION || $accident_statuses_id == ACCIDENT_STATUSES_COORDINATION) ? $accident_statuses_id : ACCIDENT_STATUSES_INVESTIGATION;

			$this->permissions['update'] = $this->permissions['updateRisk'];

            if (Form::update($data, false, false)) {

				$data['accidents_id'] = $data['id'];

				if (intval($data['mvs_average']) == 1 && intval($data['mvs_id_average'])) {
					$sql =	'UPDATE ' . PREFIX . '_accidents_go, ' . PREFIX . '_mvs SET ' .
							'mvs_title_average = title ' .
							'WHERE ' . PREFIX . '_accidents_go.mvs_id_average = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['accidents_id']);
					$db->query($sql);
				}

				if (intval($data['insurance']) == 1) {

                     //если уже имеются аткы не в оплате или в "врегульовано", то устанавливаем "випадок"
                    $sql =	'SELECT id ' .
							'FROM ' . PREFIX . '_accidents_acts ' .
							'WHERE act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents_id = ' . intval($data['accidents_id']);
                    $data['id'] = $db->getCol($sql);

                    if (sizeOf($data['id'])) {
                        $sql =	'UPDATE ' . PREFIX . '_accidents_acts SET ' .
								'insurance = ' . intval($data['insurance']) . ' '.
								'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND payment_statuses_id NOT IN(' . implode(', ', $conditions_payment_statuses) . ')'. 'AND act_statuses_id NOT IN (' . implode(', ', $conditions_statuses_acts) . ')';
                        $db->query($sql);
                    }


				} else {//если событие не страховое, добавляем акт минуя экспертную оценку

                    //если уже существуют акты по делу, то акт на отказ должен быть с буквой "О", для єтого нужно установить переменную "act_type"
                    $sql =	'SELECT id ' .
                        'FROM ' . PREFIX . '_accidents_acts ' .
                        'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND act_statuses_id IN (' . implode(', ', $conditions_statuses_acts) . ')';
                    $data['act_col'] = $db->getCol($sql);
                    if (sizeOf($data['act_col'])) {
                        $data['act_type'] = ACCIDENT_INSURANCE_ACT_TYPE_RETURN_AND_FAILURE;
                    }

                    //страховые акты которые будут изменены
					$sql =	'SELECT id ' .
							'FROM ' . PREFIX . '_accidents_acts ' .
							'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND payment_statuses_id NOT IN(' . implode(', ', $conditions_payment_statuses) . ')'. 'AND act_statuses_id 	NOT IN (' . implode(', ', $conditions_statuses_acts) . ')';
					$data['id'] = $db->getCol($sql);

					$AccidentActs = AccidentActs::factory($data, 'GO');

					$data['act_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;

					if (is_array($data['id']) && sizeOf($data['id'])) {
                        foreach ($data['id'] as $id) {
							$data['id'] = $id;
							$AccidentActs->update($data, false);					
                        }
					} else {
						//$AccidentActs->insert($data, false);
					}
				}

				foreach ($product_documents as $method => $product_document_types) {
					$this->$method($data['accidents_id'], 0, 0, 0, $product_document_types, $data);
				}

				//перегоняем акты дальше по статусу, если статус был по делу ошибка в квалификации
				$sql =	'UPDATE ' . PREFIX . '_accidents_acts SET ' .
						'act_statuses_id = ' . ACCIDENT_STATUSES_INVESTIGATION . ' ' .
						'WHERE accidents_id = ' . $data['accidents_id'] . ' AND act_statuses_id = ' . ACCIDENT_STATUSES_REINVESTIGATION;
				$db->query($sql);

				$this->updateStep($data['id'], 4);

				$AccidentStatusChanges = new AccidentStatusChanges($data);
				$AccidentStatusChanges->set($data['id']);

				$params['title']    = $this->messages['single'];
				$params['id']       = $data['accidents_id'];
				$params['storage']  = $this->tables[0];

				$Log->add('confirm', 'Ризик по справі було встановлено.', $params);

				($this->permissions['updateActs'])
					? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateActs&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id'])
					: header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewActs&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
				exit;
            }

            $data = $this->replaceSpecialChars($data, 'update');
        } else {
			$data = $this->load($data, false, 'updateRisk');

            if (!$data['description_average']) {
            	$data['description_average'] = $data['description'];
            }
        }

        $data['important_person'] = $this->getImportantPerson($data['policies_id']);
		$data['reason_not_payment_insurance_2'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 1 AND product_types_id IN (1, 4)');
		$data['reason_not_payment_insurance_3'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 2 AND product_types_id IN (1, 4)');

        return $this->showForm($data, 'updateRisk', 'update', 'goRisk.php');
    }

    function viewRisk($data) {
		global $db;


		$this->checkPermissions('view', $data);

        if ($_POST['do'] == $this->object . '|viewRisk') {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewActs&accidents_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
            exit;
        }
		
		$_POST['applications']['victim_accidents_id'] = $data['victim_accidents_id'];
		$_POST['applications']['insurer_accidents_id'] = $data['insurer_accidents_id'];

        $this->formDescription = $this->riskFormDescription;

		$data['id'] = $data['accidents_id'];
        $data = $this->view($data, null, null, null, false);
		$data['risks'] = $this->getRisks($data['id']);

        $data['important_person'] = $this->getImportantPerson($data['policies_id']);
		$data['reason_not_payment_insurance_2'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 1 AND product_types_id IN (1, 4)');
		$data['reason_not_payment_insurance_3'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 2 AND product_types_id IN (1, 4)');

        return $this->showForm($data, 'viewRisk', 'view', 'goRisk.php');
    }

    function updateActs($data) {
		$data['step'] = 5;
		
		$_POST['applications']['victim_accidents_id'] = $data['victim_accidents_id'];
		$_POST['applications']['insurer_accidents_id'] = $data['insurer_accidents_id'];

        $fields[]        = 'accidents_id';
        $conditions[]    = PREFIX . '_accidents_acts.accidents_id = ' . intval($data['accidents_id']);

        $data['accidents'] =& $this;

        $AccidentActs = AccidentActs::factory($data, 'GO');

        $this->objectTitle = $AccidentActs->objectTitle;

        $AccidentActs->show($data, $fields, $conditions, null, $AccidentActs->object . '/show.php');

        $this->updateStep($data['accidents_id'], 5);
    }

    function viewActs($data) {
		$data['step'] = 5;
		
		$_POST['applications']['victim_accidents_id'] = $data['victim_accidents_id'];
		$_POST['applications']['insurer_accidents_id'] = $data['insurer_accidents_id'];

        $fields[]        = 'accidents_id';
        $conditions[]    = PREFIX . '_accidents_acts.accidents_id = ' . intval($data['accidents_id']);

        $fields[]        = 'product_types_id';

        $data['accidents'] =& $this;

        $AccidentActs = AccidentActs::factory($data, 'GO');

        $this->objectTitle = $AccidentActs->objectTitle;

		$AccidentActs->permissions['insert']	= false;
		$AccidentActs->permissions['update']	= false;

        $AccidentActs->show($data, $fields, $conditions, null, $AccidentActs->object . '/show.php');
    }
    function getRowClass($row, $i){

        $result = parent::getRowClass($row, $i);

        //красим, если просрочены сроки по внесению данных по МТСБУ
        if($row['statuses_id'] == ACCIDENT_STATUSES_MTSBU && $row['mtsbu_days'] >= 5) {
                $result .= ' red';
        }

        return $result;
    }


    function deleteProcess(&$data, $i = 0, $folder=null) {
        global $db;

		//удаляем страховые акты не доведенные до оплаты
        $AccidentActs = AccidentActs::factory($data, 'GO');

		//получаем дела, которые нельзя удалять
        $sql =  'SELECT DISTINCT accidents_id ' .
				'FROM ' . $AccidentActs->tables[0] . ' ' .
				'WHERE accidents_id IN(' . implode(', ', $data['id']) . ') AND (payment_statuses_id <> ' . PAYMENT_STATUSES_NOT . ' OR act_statuses_id >= ' . ACCIDENT_STATUSES_COORDINATION . ')';
        $accidents = $db->getCol($sql);

		$data['id'] = array_diff($data['id'], $accidents);

		if (is_array($data['id']) && sizeOf($data['id'])) {

			//удаляем документы
			$AccidentDocuments = new AccidentDocuments($data);

			$sql =	'SELECT id ' .
					'FROM ' . $AccidentDocuments->tables[0] . ' ' .
					'WHERE accidents_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentDocuments->delete($toDelete, false, false);

			//удаляем дополнительные расходы
			$AccidentPaymentsCalendar = new AccidentPaymentsCalendar($data);

			$sql =	'SELECT id ' .
					'FROM ' . $AccidentPaymentsCalendar->tables[0] . ' ' .
					'WHERE accidents_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentPaymentsCalendar->delete($toDelete, false, false);

			//удаляем акты
			$sql =	'SELECT id ' .
					'FROM ' . $AccidentActs->tables[0] . ' ' .
					'WHERE accidents_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentActs->delete($toDelete, false, false);

			$sql =  'DELETE ' .
					'FROM ' . PREFIX . '_accidents ' .
					'WHERE id IN(' . implode(', ', $data['id']) . ')';
			$db->query($sql);

			$this->tables = array(PREFIX . '_accidents');

            $AccidentPaymentsCalendar = new AccidentPaymentsCalendar($data);

			$sql =	'SELECT id ' .
					'FROM ' . $AccidentPaymentsCalendar->tables[0] . ' ' .
					'WHERE acts_id IN(' . implode(', ', $data['id']) . ')';
			$toDelete['id'] = $db->getCol($sql);

			$AccidentPaymentsCalendar->delete($toDelete, false, false);

			return parent::deleteProcess($data, $i, $folder);
		}
    }

    function getSearchInWindow($data) {
        global $db, $Authorization;

        $conditions[] = 'c.insurance_companies_id =' . INSURANCE_COMPANIES_EXPRESS;

		if ($Authorization->data['roles_id'] == ROLES_MASTER) {
			$conditions[] = 'a.car_services_id = ' . intval($Authorization->data['car_services_id']);
		}

        if (intval($data['accidents_id'])) {
//            $conditions[] = 'a.id = ' . intval($data['accidents_id']);
        }

        if ($data['policies_number']) {
            $conditions[] = 'c.number = ' . $db->quote($data['policies_number']);
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

			$sql =	'SELECT a.id, a.number, c.number AS policies_number, ' .
					'date_format(c.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date_format, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, ' .
					'd.insurer_lastname, d.insurer_firstname, d.insurer_patronymicname, ' .
					'CONCAT(d.brand, \'/\', d.model) as item, d.shassi, d.sign ' .
                    'FROM ' . PREFIX . '_accidents AS a  ' .
                    'JOIN ' . PREFIX . '_accidents_go AS b ON a.id = b.accidents_id  ' .
                    'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
                    'JOIN ' . PREFIX . '_policies_go AS d ON a.policies_id = d.policies_id ' .
                    'WHERE c.number = ' . $db->quote($data['policies_number']) . ' '.
                    'ORDER BY c.begin_datetime DESC';

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
                            '<td>Справа</td>' .
                        '</tr>';

            switch (sizeOf($list)) {
                case 0:
                    $result .= '<tr><td colspan="9" align="center" style="color: red;">Згідно заданних критеріїв пошуку поліс не знайдено.</td></tr>';
                    $result .= '</table>';
                    break;
                default:

                    $i = 0;
                    while ($i < sizeOf($list)) {

                        $policies_number = $list[ $i ]['policies_number'];

                        $result .=  '<tr class="row' . (($i % 2 == 0) ? '1' : '0') .'">' .
										'<td align="center"><input type="radio" name="policies_number" value="' . $list[ $i ]['policies_number'] . '" ' . ( ($list[ $i ]['policies_number'] == $data['policies_number']) ? 'checked' : '') . ' /></td>' .
                                        '<td>' . $list[ $i ]['insurer_lastname'] . ' ' . $list[ $i ]['insurer_firstname'] . ' ' . $list[ $i ]['insurer_patronymicname'] . '</td>' .
                                        '<td>' . $list[ $i ]['policies_number'] . '</td>' .
                                        '<td>' . $list[ $i ]['policies_date_format'] . '</td>' .
                                        '<td>' . $list[ $i ]['item'] . '</td>' .
                                        '<td>' . $list[ $i ]['shassi'] . '</td>' .
                                        '<td>' . $list[ $i ]['sign'] . '</td>' .
                                        '<td>' . $list[ $i ]['policies_begin_datetime_format'] . '</td>' .
                                        '<td>' . $list[ $i ]['policies_interrupt_datetime_format'] . '</td>' .
                                        '<td><select id="accidents_id' . $list[ $i ]['policies_number'] . '" name="accidents_id[' . $list[ $i ]['policies_number'] . ']" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';

                        while($i < sizeOf($list) && $list[ $i ]['policies_number'] == $policies_number) {
							$result .= '<option value="' . $list[ $i ]['id'] . '" ' . (($list[ $i ]['id'] == $data['accidents_id'] ) ? 'selected' : '') . '>' . $list[ $i ]['number'] . '</option>';
                            $i++;
                        }

                        $result .=      '</select></td>'.
                                    '</tr>';
                        $i++;
                    }

                    $result .= '</table>';

                    break;
            }
        }

        echo $result;
    }

    function get($data) {
        global $db;

        if(is_array($data['id'])) {
            $conditions[] = 'a.id IN  ('.implode(', ', $data['id']) . ')';
        } else {
            $conditions[] = 'a.id = ' . $data['id'];
        }

       $sql =   'SELECT a.*,b.*, a.number as accident_number, c.number as policies_number ' .
                'FROM ' . PREFIX . '_accidents AS a  ' .
                'JOIN ' . PREFIX . '_accidents_go AS b ON a.id = b.accidents_id  ' .
                'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
                'JOIN ' . PREFIX . '_policies_go AS d ON a.policies_id = d.policies_id ' .
                'WHERE (' . implode(' AND ', $conditions) . ')';
       return $db->getRow($sql);
    }

    function prepareValues($fields, $values) {
        global $REGIONS, $Authorization;

        foreach ($fields as $field) {
			switch ($field) {
                case 'applicant_regions_title':
                    $values[ $field ] = (!in_array($values['applicant_regions_id'], array(28)) ? Regions::getTitle($values['applicant_regions_id']) : '');
					break;
                case 'owner_regions_title':
                    $values[ $field ] = (!in_array($values['owner_regions_id'], array(28)) ? Regions::getTitle($values['owner_regions_id']) : '');//Regions::getTitle($values['owner_regions_id']);
                    break;
                case 'applicant_city':
					if (!in_array($values['applicant_regions_id'], array(26,27,28))) {
                        $values[ $field ] = $values['applicant_city'];
                    }
					break;
                case 'owner_city':					
                    if (!in_array($values['owner_regions_id'], array(26,27,28))) {
                        $values[ $field ] = $values['owner_city'];
                    }
                    break;
                case 'applicant_street':
                case 'owner_street':
                    $values[ 'applicant_street' ] =  StreetTypes::getTitle($values['applicant_street_types_id']) . ' ' . $values['applicant_street'];
                    $values[ 'owner_street' ] =  StreetTypes::getTitle($values['owner_street_types_id']) . ' ' . $values['owner_street'];
                    break;
                case 'mvs':
                	switch ($values['mvs']) {
						case '0':
							$values[ $field ] = 'Нi';
							break;
						case '1':
						case '2':
						case '3':
							$values[ $field ] = 'Так, ' . $values['mvs_title'];
							break;
                	}
                	break;
				case 'owner_address':
                    $region = Regions::getTitle($values['owner_regions_id']);
					$street = $values['owner_street_types'] . ' ' . $values['owner_street'];
					$values[ $field ] = $region . (strlen($values['owner_area']) ? ', ' . $values['owner_area'] . ' р-он' : '') . (strlen($values['owner_city']) && $values['owner_regions_id'] != 26 ? ', ' . $values['owner_city'] : '') .
						', ' . $street . (strlen($values['owner_house']) ? ', буд. ' . $values['owner_house'] : '') . (strlen($values['owner_flat']) ? ', кв. ' . $values['owner_flat'] : '') . (strlen($values['owner_phone']) ? ', тел. ' . $values['owner_phone'] : '');
                    break;
                case 'mvs_average':
                	switch ($values['mvs_average']) {
						case '0':
							$values[ $field ] = 'Нi, Складання вропротоколу: ' . ($values['mvs'] == 2) ? 'Так' : 'Ні' ;
							break;
						case '1':
						case '2':
						case '3':
							$values[ $field ] = 'Так, ' . $values['mvs_title_average'];
							break;
                	}
                	break;
			}
        }

        return $values;
    }

    //выплаты по предыдущим событиям по договору
    function getAmountPrevious($id) {
        global $db;

        $sql = 'SELECT b.number ' .
            'FROM ' . PREFIX . '_accidents AS a ' .
            'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
            'WHERE a.id = ' . intval($id);
        $number = $db->getOne($sql);

        //выбираем суммы по актам "Первой сираховой выплаты" и "Доплат", если нет актов с отказом или возвратом

        $conditions[] = 'a.number = ' . $db->quote($number);
        $conditions[] = 'b.id < ' . intval($id);
        $conditions[] = 'c.act_statuses_id IN(' . ACCIDENT_STATUSES_PAYMENT . ', ' . ACCIDENT_STATUSES_RESOLVED . ')';


        $sql = 'SELECT SUM(c.amount) ' .
            'FROM ' . PREFIX . '_policies AS a ' .
            'JOIN ' . PREFIX . '_accidents AS b ON a.id = b.policies_id ' .
            'JOIN ' . PREFIX . '_accidents_acts AS c ON b.id = c.accidents_id ' .
            'JOIN ' . PREFIX . '_accidents_go_acts AS d ON d.accidents_acts_id = c.id ' .
            'JOIN ' . PREFIX . '_accidents_go as e ON b.id = e.accidents_id ' .
            'WHERE ' . implode(' AND ', $conditions);
        return $db->getOne($sql);
    }

	//получаем стоимость ремонта общую
	function getVRZPrevious($accidents_id, $id) {
		global $db;

		$sql =	'SELECT ROUND(b.amount_details * (1 - b.deterioration_value) + b.amount_material + b.amount_work, 2) AS amount_vrz ' .
				'FROM ' . PREFIX . '_accidents_acts as a ' .
				'JOIN ' . PREFIX . '_accidents_go_acts as b ON a.id = b.accidents_acts_id ' .
				'WHERE a.accidents_id = ' . intval($accidents_id) . ' AND a.id < ' . $db->quote($id) . ' ' .
				'ORDER BY a.id DESC ' .
				'LIMIT 1';
		return $db->getOne($sql);
	}

    function getCountApplicantion($data) {
        global $db;

        $conditions[] = 'a.policies_id=' . intval($data['policies_id']);
        $conditions[] = 'date_format(a.datetime, \'%Y-%m-%d\') = ' . $db->quote($data['datetime_year'].'-'.$data['datetime_month'].'-'.$data['datetime_day']);
        $conditions[] = 'b.owner_types_id = 2';

        $sql = 'SELECT count(a.policies_id) as count ' .
               'FROM ' . PREFIX . '_accidents as a ' .
               'JOIN ' . PREFIX . '_accidents_go as b ON a.id=b.accidents_id ' .
               'WHERE '. implode(' AND ', $conditions) . ' ' .
               'GROUP by a.policies_id';

        return $db->getOne($sql);
    }

    function getParentAccident($data) {
        global $db;

        //выбираем номер уже существующего заявления страхователя
        $conditions[] = 'a.policies_id=' . intval($data['policies_id']);
        $conditions[] = 'date_format(a.datetime, \'%Y-%m-%d\') = ' . $db->quote($data['datetime_year'].'-'.$data['datetime_month'].'-'.$data['datetime_day']);
        if($data['owner_types_id'] == 1){
            $conditions[] = 'b.owner_types_id = 2';
        }
        else{
            $conditions[] = 'b.owner_types_id = 1';
			$conditions[] = 'a.id <> ' . intval($data['accidents_id']);
        }

        $sql = 'SELECT a.id as accidents_id, a.number, a.average_managers_id, a.estimate_managers_id, a.archive_statuses_id ' .
			   'FROM ' . PREFIX . '_accidents as a ' .
			   'JOIN ' . PREFIX . '_accidents_go as b ON a.id=b.accidents_id ' .
			   'WHERE ' . implode(' AND ', $conditions);
        return $db->getAll($sql);
    }

    function setNumber($data) {
        global $db, $Log;

		$last_number = $this->getLastNumber($data['product_types_id']);//получаем последний номер страхового дела
		$parent_accident = $this->getParentAccident($data);

		$data_temp = $data;
		$data_temp['owner_types_id'] = 2;
		
		$other_insurer_application = $this->getParentAccident($data_temp);

		if (is_array($parent_accident) && sizeof($parent_accident) && ($data['owner_types_id'] == 1 && !sizeof($other_insurer_application) || $data['owner_types_id'] == 2)) {
			$relation = 1;
			foreach ($parent_accident as $accident) {
				$sql = 'UPDATE ' . PREFIX . '_accidents_go ' .
					   'SET relation = 1 ' .
					   'WHERE accidents_id = ' . intval($accident['accidents_id']);
				$db->query($sql);
				
				if ($data['owner_types_id'] == 1) {
					$insurer_accidents_id = $data['accidents_id'];
					$victim_accidents_id = $accident['accidents_id'];
				} else {
					$insurer_accidents_id = $accident['accidents_id'];
					$victim_accidents_id = $data['accidents_id'];
				}
				$sql = 'INSERT INTO ' . PREFIX . '_accidents_go_victim_to_insurer VALUES(' . intval($insurer_accidents_id) . ', ' . intval($victim_accidents_id) . ')';
				$db->query($sql);
			}
		} else {
			$relation = 0;
		}
		
		$sql =  'UPDATE ' . PREFIX . '_accidents AS a ' .
				'JOIN ' . PREFIX . '_accidents_go as b ON a.id = b.accidents_id ' .
				'SET ' .
					'a.number = CONCAT(\''.$this->getProductType().'\', \'.\', date_format(a.created, \'%y\'), \'.\', ' . intval(intval($last_number+1)) . '), ' .
					'b.relation = ' . intval($relation) . ' ' .
				'WHERE a.id = ' . intval($data['accidents_id']);
		$db->query($sql);                
		
		$sql =  'UPDATE ' . PREFIX . '_accidents_last_numbers ' .
				'SET accidents_last_number = '. intval(intval($last_number+1)) . ' ' .
				'WHERE product_types_id = ' . intval($data['product_types_id']);
		$db->query($sql);

            /*if(intval($this->getCountApplicantion($data)) == 1 && $data['owner_types_id'] == 2) {//если нет заявлений потерпевших и пишет потерпевший, то:

                if(!$parent_accident['number']) {//если нет заявления от страхователя, то используем стандартный механизм присвоения номера

                    $sql =  'UPDATE ' . PREFIX . '_accidents AS a ' .
                            'SET a.number = CONCAT(\''.$this->getProductType().'\', \'.\', date_format(a.created, \'%y\'), \'.\', ' . intval(intval($last_number+1)) . ') ' .
                            'WHERE a.id = ' . intval($data['accidents_id']);
                    $db->query($sql);

                    $sql =  'UPDATE ' . PREFIX . '_accidents_last_numbers ' .
                            'SET accidents_last_number = '. intval(intval($last_number+1)) . ' ' .
                            'WHERE product_types_id = ' . intval($data['product_types_id']);
                    $db->query($sql);
                }
                else {//если есть заявление от страхователя, то присваиваем его номер
                    $sql =  'UPDATE ' . PREFIX . '_accidents AS a ' .
                            'JOIN ' . PREFIX . '_accidents_go as b ON a.id = b.accidents_id ' .
                            'SET ' .
                            'a.number = ' . $db->quote($parent_accident['number']) . ', ' .
                            'b.parent_application_id = ' . $parent_accident['accidents_id'] . ' ' .//создаем 1-ю нить связи
                            'WHERE a.id = ' . intval($data['accidents_id']);
                    $db->query($sql);
					
					if ($parent_accident['archive_statuses_id'] == 1) {
						$sql = 'UPDATE ' . PREFIX . '_accidents ' .
							   'SET archive_statuses_id = 0 ' .
							   'WHERE id = ' . intval($parent_accident['accidents_id']);
						$db->query($sql);
						$this->send($data['accidents_id'], 'AccidentsGO.CreateVictim');
					}					
					
                    ////создаем 2-ю нить связи
                    $sql =  'UPDATE ' . PREFIX . '_accidents_go ' .
                            'SET ' .
                            'parent_application_id = ' . $data['accidents_id'] . ' ' .
                            'WHERE accidents_id = ' . intval($parent_accident['accidents_id']);
                    $db->query($sql);
                }
            }
            elseif(intval($this->getCountApplicantion($data)) == 1 && $data['owner_types_id'] == 1) {//если заявление пишет страхователь и есть заявление(я) от потерпевших

                $sql =  'UPDATE ' . PREFIX . '_accidents AS a ' .
                        'JOIN ' . PREFIX . '_accidents_go as b ON a.id = b.accidents_id ' .
                        'SET ' .
                        'a.number = ' . $db->quote($parent_accident['number']) . ', ' .
                        'a.average_managers_id = ' . intval($parent_accident['average_managers_id']) . ', ' .
                        'a.estimate_managers_id = ' . intval($parent_accident['estimate_managers_id']) . ', ' .
                        'b.parent_application_id = ' . $db->quote($parent_accident['accidents_id']) . ' ' .//создаем 1-ю нить связи
                        'WHERE a.id = ' . intval($data['accidents_id']);
                $db->query($sql);
                ////создаем 2-ю нить связи
                $sql =  'UPDATE ' . PREFIX . '_accidents_go ' .
                    'SET ' .
                    'parent_application_id = ' . $data['accidents_id'] . ' ' .
                    'WHERE accidents_id = ' . intval($parent_accident['accidents_id']);
                $db->query($sql);
            }
            else {//если пишет страхователь или заявитель, но нет заявления по данному поллису и дате события или их больше чем 2

                $sql =  'UPDATE ' . PREFIX . '_accidents AS a ' .
                        'JOIN ' . PREFIX . '_accidents_go as b ON a.id = b.accidents_id ' .
                        'SET ' .
                        'a.number = CONCAT(\''.$this->getProductType().'\', \'.\', date_format(a.created, \'%y\'), \'.\', ' . intval(intval($last_number+1)) . '), ' .
                        'b.parent_application_id = ' . $db->quote($parent_accident['accidents_id']) . ' ' .
                        'WHERE a.id = ' . intval($data['accidents_id']);
                $db->query($sql);

                $sql =  'UPDATE ' . PREFIX . '_accidents_last_numbers ' .
                        'SET accidents_last_number = '. intval(intval($last_number+1)) . ' ' .
                        'WHERE product_types_id = ' . intval($data['product_types_id']);
                $db->query($sql);
            }*/
    }

    function getValues($file) {
        global $db;

        $sql =  'SELECT a.*, a.number AS accident_documents_number, a.created AS accident_documents_created, ' .
				'b.*, b.number AS accidents_number, b.date AS accidents_date, b.datetime AS accidents_datetime, b.datetime_average AS accidents_datetime_average, b.assistance as accidents_assistance, b.assistance_date AS accidents_assistance_date, b.risks_id, b.documents AS accidents_documents, b.comment as comment, ' .
				'c.*, c.mvs_average as accidents_go_mvs, CONCAT(c.owner_lastname,\' \',c.owner_firstname, \' \',c.owner_patronymicname) as accidents_owner,' .
				'd1.*, d.*, d1.created as acts_created, d1.payment_document_number as payment_document_number, d1.payment_document_date as payment_document_date, d.amount_details, d.amount_material, d.amount_work, d.market_price, d.amount_residual, d1.documents AS acts_documents, ' .
				'e.product_types_id, e.number AS policies_number, e.date AS policies_date, e.begin_datetime AS begin_datetime, e.interrupt_datetime AS interrupt_datetime, e.price AS policies_price, e.amount AS policy_amount, ' .
				'f.person_types_id AS policies_person_types_id, f.insurer_lastname AS policies_insurer_lastname, f.insurer_firstname AS policies_insurer_firstname, f.insurer_patronymicname AS policies_insurer_patronymicname, f.insurer_identification_code AS policies_insurer_identification_code, f.insurer_edrpou AS policies_insurer_edrpou, ' .
                'f.brand as insurer_brand, f.model as insurer_model, f.sign as insurer_sign, f.shassi as insurer_shassi, ' .
				'f.insurer_city AS policies_insurer_city, f.insurer_street AS policies_insurer_street, f.insurer_house AS policies_insurer_house, f.insurer_flat AS policies_insurer_flat, f.insurer_phone AS policies_insurer_phone, ' .
                'f.deductible as deductible, ' .
				'h.title AS risks_title, ' .
				'j.lastname AS masters_lastname, j.firstname AS masters_firstname, j.patronymicname AS masters_patronymicname, ' .
				'k.address AS mvs_address, k.title as mvs_title, ' .
				'l.amount AS payments_calendar_amount,l.payment_types_id as payments_calendar_payment_types_id, l.basis AS payments_calendar_basis, l.number as payments_calendar_number, l.recipient AS payments_calendar_recipient, l.recipient_identification_code AS payments_calendar_recipient_identification_code, l.payment_bank_account AS payments_calendar_payment_bank_account, l.payment_bank AS payments_calendar_payment_bank, l.payment_bank_mfo AS payments_calendar_payment_bank_mfo, l.payment_bank_card_number AS payments_calendar_payment_bank_card_number, l.created as payments_calendar_created, ' .
        		'm.title AS car_services_title, ' .
				'n.lastname AS average_managers_lastname, n.firstname AS average_managers_firstname, n.patronymicname AS average_managers_patronymicname, ' .
				'w.lastname as authors_lastname, w.firstname as authors_firstname, w.email as authors_email, ' .
				'o.lastname AS expert_managers_lastname, o.firstname AS expert_managers_firstname, o.patronymicname AS expert_managers_patronymicname, ' .
				'w.lastname as authors_lastname, w.firstname as authors_firstname, w.email as authors_email, ' .
                'p.title as sections_title, ' .
                'r.accounts_title AS accident_status_changes_accounts_title, MIN(r.created) as accident_status_changes_application_created, ' .
                'a.accidents_id, SUM(s.amount) AS policy_payments_amount, ' .
                'd1.insurance AS acts_insurance ,d1.number AS acts_number, d1.created ' .
                'FROM ' . PREFIX . '_accident_documents AS a ' .
                'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
                'JOIN ' . PREFIX . '_accidents_go AS c ON b.id = c.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_acts AS d1 ON a.acts_id = d1.id ' .
				'LEFT JOIN ' . PREFIX . '_accidents_go_acts AS d ON a.acts_id = d.accidents_acts_id ' .
                'JOIN ' . PREFIX . '_policies AS e ON b.policies_id = e.id ' .
                'JOIN ' . PREFIX . '_policies_go AS f ON b.policies_id = f.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_risks AS h ON b.risks_id = h.id ' .
                'JOIN ' . PREFIX . '_accounts AS j ON b.masters_id = j.id ' .
                'LEFT JOIN ' . PREFIX . '_mvs AS k ON c.mvs_id = k.id ' .
				'LEFT JOIN ' . PREFIX . '_accident_payments_calendar AS l ON a.payments_calendar_id = l.id ' .
                'JOIN ' . PREFIX . '_car_services AS m ON b.car_services_id = m.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS n ON b.average_managers_id = n.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS o ON b.estimate_managers_id = o.id ' .
                'LEFT JOIN ' . PREFIX . '_accident_sections as p ON p.id = b.accident_sections_id ' .
                'LEFT JOIN ' . PREFIX . '_accident_status_changes as r ON b.id = r.accidents_id ' .
                'LEFT JOIN (SELECT SUM(amount) as amount,policies_id FROM ' . PREFIX . '_policy_payments GROUP BY policies_id) AS s ON e.id = s.policies_id ' .
		'LEFT JOIN ' . PREFIX . '_accounts as w ON a.authors_id = w.id ' .
                'WHERE a.id = ' . intval($file['id']) . ' ' .
				'GROUP BY s.policies_id';
        $row = $db->getRow($sql);

        if (intval($row['acts_id'])) {

            // расчет страхового возмещения
			$row['amount_sz'] = round($row['amount_details'] * (1 - $row['deterioration_value']), 2);
            $row['amount_vr'] = round($row['amount_details'] + $row['amount_material'] + $row['amount_work'], 2);
            $row['amount_vrz'] = round($row['amount_sz'] + $row['amount_material'] + $row['amount_work'], 2);
			//$row['amount_vrz_previous'] = $this->getVRZPrevious($row['accidents_id'], $row['acts_id']);

			if ($row['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_INSURANCE_GO_ACT) {

				//сумма выплаченных возмещений по договору
				//$row['amount_previous_accidents'] = $this->getAmountPrevious($row['accidents_id']);

				//сумма выплаченных возмещений по акту
				$AccidentActs = AccidentActs::factory($data, 'GO');
				$row['amount_previous_acts'] = $AccidentActs->getAmountPrevious($row['accidents_id'], $row['acts_id']);

				$price = ($row['insurance_price'] < $row['market_price']) ? $row['insurance_price'] : $row['market_price'];
			}

			//грузим календарь платежей
			$sql =	'SELECT * ' .
					'FROM ' . PREFIX . '_accident_payments_calendar ' .
					'WHERE acts_id = ' . intval($row['acts_id']);
			$row['payments_calendar'] = $db->getAll($sql);

			$sql =  'SELECT b.title ' .
					'FROM ' . PREFIX . '_accident_act_document_type_assignments AS a ' .
					'JOIN ' . PREFIX . '_product_document_types AS b ON a.product_document_types_id = b.id ' .
					'WHERE a.acts_id = ' . intval($row['acts_id']) . ' ' .
					'ORDER BY b.title';
			$row['product_document_types'] = $db->getCol($sql);

			$row['documents'] = ($row['acts_documents']) ? array_merge($row['product_document_types'], explode($this->documentsDelimiter, $row['acts_documents'])) : $row['product_document_types'];

			$row['total_amount'] = ($row['amount_vr'] >=  $row['market_price']) ? $row['market_price'] : $row['amount_vr'];
        } else {

            $row['rough_part'] = round(($row['amount_rough']/$row['items_price']) * 100, 2); //для запиту в Банк

			$sql =  'SELECT b.id, b.title ' .
					'FROM ' . PREFIX . '_accident_document_type_assignments AS a ' .
					'JOIN ' . PREFIX . '_product_document_types AS b ON a.product_document_types_id = b.id ' .
					'WHERE a.accidents_id = ' . intval($row['accidents_id']) . ' ' .
					'ORDER BY b.title';
			$row['product_document_types'] = $db->getAssoc($sql, 30*60);

			 //для отдельного вывода Дополнительных документов в шаблон Титулки
            $row['additional_documents'] = explode($this->documentsDelimiter, $row['accidents_documents']);

             //merge масива основных док. и дополнительных для вывода в "заяву"
            foreach($row['product_document_types'] as $product_document){
                $row['documents'][] = $product_document;
            }

            $row['documents'] = ($row['accidents_documents']) ? array_merge($row['documents'], explode($this->documentsDelimiter, $row['accidents_documents'])) : $row['documents'];

        }

		$fields = array(
            'owner_regions_title',
            'owner_city',
            'owner_street',
			'owner_address',
        	'applicant_regions_title',
            'applicant_city',
            'applicant_street',
			'mvs',
			'mvs_average');
			
		if (strtotime($row['accident_documents_created']) >= strtotime('2014-02-01')) {
            //$row['change01022014'] = 1;
        }
			
		//if (strtotime($row['created']) >= strtotime('2013-11-01')) {
            //$row['euassist'] = 1;
        //}
		
		if (strtotime(date('Y-m-d')) >= strtotime('2015-08-17') && strtotime(date('Y-m-d')) <= strtotime('2015-08-23')) {
			$row['director'] = 1;
		}

        return $this->prepareValues($fields, $row);
    }

	//выгружаем информацию по договору в бухгалтерию
	function getXML($data) {
		global $db, $Smarty;

		if ($data['number']) {
            $conditions[] = 'b.number=' . $db->quote($data['number']);
        } else {
            //$conditions[] = ($data['from']) ? 'TO_DAYS(b.modified ) >= TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(b.modified ) >= TO_DAYS(NOW())';
            //$conditions[] = ($data['to']) ? 'TO_DAYS(b.modified ) <= TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(b.modified ) <= TO_DAYS(NOW())';
              $conditions[] = ' b.date>='.$data['from'].' AND b.date<='.$data['to'].'  ';
            //$conditions[] = 'b.accident_statuses_id = ' . ACCIDENT_STATUSES_PAYMENT;
        }
        $conditions[] = 'c.owner_types_id = 2';//поетрпілий

        $sql =  'SELECT b.*, b.documents AS accidents_documents,   ' .
				'c.*, b.number AS number, e.product_types_id, ' .
				'e.number AS policies_number, e.date AS policies_date, e.begin_datetime AS begin_datetime, e.end_datetime AS end_datetime,e.amount AS policy_amount, ' .
				'f.insurer_lastname AS policies_insurer_lastname, f.insurer_firstname AS policies_insurer_firstname, f.insurer_patronymicname AS policies_insurer_patronymicname, f.insurer_identification_code AS policies_insurer_identification_code, ' .
				'f.insurer_city AS policies_insurer_city, f.insurer_street AS policies_insurer_street, f.insurer_house AS policies_insurer_house, f.insurer_flat AS policies_insurer_flat, f.insurer_phone AS policies_insurer_phone, ' .
				'h.title AS risks_title, ' .
				'j.lastname AS masters_lastname, j.firstname AS masters_firstname, j.patronymicname AS masters_patronymicname, ' .
				'k.address AS mvs_address, ' .
        		'm.title AS car_services_title, ' .
				'n.lastname AS average_managers_lastname, n.firstname AS average_managers_firstname, n.patronymicname AS average_managers_patronymicname, ' .
				'o.lastname AS expert_managers_lastname, o.firstname AS expert_managers_firstname, o.patronymicname AS expert_managers_patronymicname, ' .
				'b.date AS accidents_date, b.created AS accidents_date, b.datetime as accidents_datetime,b.datetime as application_date ' .
                'FROM  ' . PREFIX . '_accidents AS b   ' .
                'JOIN ' . PREFIX . '_accidents_go AS c ON b.id = c.accidents_id ' .
                'JOIN ' . PREFIX . '_policies AS e ON b.policies_id = e.id ' .
                'JOIN ' . PREFIX . '_policies_go AS f ON f.policies_id = e.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_risks AS h ON b.risks_id = h.id ' .
                'JOIN ' . PREFIX . '_accounts AS j ON b.masters_id = j.id ' .
                'LEFT JOIN ' . PREFIX . '_mvs AS k ON c.mvs_id = k.id ' .
                'JOIN ' . PREFIX . '_car_services AS m ON b.car_services_id = m.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS n ON b.average_managers_id = n.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS o ON b.estimate_managers_id = o.id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' ;
		$list = $db->getAll($sql);

	    $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/go.xml');
	}

    function prepareValuesMTSBU($fields, $values, $closed=false) {
        global $REGIONS;

        foreach ($fields as $name) {
            switch ($name) {
                case 'insurer_identification_code':
                    switch ($values['insurer_person_types_id']) {
                        case '1':
                            $result[ $name ] = $values['insurer_identification_code'];
                            break;
                        case '2':
                            $result[ $name ] = $values['insurer_edrpou'];
                            break;
                    }
                    break;
                case 'driver':
                    $result[ $name ] = $values['insurer_driver_lastname'] . ' ' . $values['insurer_driver_firstname'] . ' ' . $values['insurer_driver_patronymicname'];
                    break;
                case 'insurer':
                    switch ($values['insurer_person_types_id']) {
                        case '1':
                            $result[ $name ] = $values['insurer_lastname'] . ' ' . $values['insurer_firstname'] . ' ' . $values['insurer_patronymicname'];
                            break;
                        case '2':
                            $result[ $name ] = $values['insurer_lastname'];
                            break;
                    }
                    break;
                case 'amount_rough':
                         if($closed && $values['insurance'] == 1)//�������, ���������� �������� ��� � ������� ���� ���������
                            $result[ $name ] =  str_replace('.', ',', $values['acts_amount']);
                         else
                            $result[ $name ] =  str_replace('.', ',', $values['amount_rough']);

                    break;
				case 'acts_amount':
                    $result[ $name ] =  str_replace('.', ',', $values['acts_amount']);
                    break;				
                case 'insurer_address':
                    $result[ $name ] = Regions::getTitle($values['insurer_regions_id']);

                    if ($values['insurer_area']) {
                        $result[ $name ] .= ', ' . $values['insurer_area'].' р-н';
                    }

                    if (!in_array($values['insurer_regions_id'], $REGIONS)) {
                        $result[ $name ] .= ', ' . $values['insurer_city'];
                    }

                    $result[ $name ] .=  ', ' . StreetTypes::getTitle($values['insurer_street_types_id']) . ' ' . $values['insurer_street'] . ', буд. ' . $values['insurer_house'];

                    if ($values['insurer_flat']) {
                        switch ($values['person_types_id']) {
                            case 1:
                                $result[ $name ] .= ', кв. ' . $values['insurer_flat'];
                                break;
                            case 2:
                                $result[ $name ] .= ', оф. ' . $values['insurer_flat'];
                                break;
                        }
                    }
                    break;
                case 'insurer_years_old':
                case 'driver_years_old':
                    $result[ $name ] = intval( $values['insurer_years_old'] );
                    break;
                case 'driver':
                    $result[ $name ] = $values['insurer_driver_lastname'] . ' ' . $values['insurer_driver_firstname'] . ' ' . $values['insurer_driver_patronymicname'];
                    break;
                case 'auto':
                    $result[ $name ] = $values['insurer_brand'] . ' ' . $values['insurer_model'];
                    break;
                case 'insurance':
					if ($closed) {
						switch ( $values[ $name ] ) {
						   case '1':
								$result[ $name ] = 'false';
								break;
						   default:
								$result[ $name ] = 'true';
								break;
						}
					} else {
						$result[ $name ] = 'false';
					}
                    break;
                case 'regres':
                case 'fraud':
                    $result[ $name ] = ($values[ $name ] == 1) ? 'true' : 'false';
                    break;
                case 'owner_person_types_id':
                    switch ($values['owner_person_types_id']) {
                        default://поставить более жесткие условия
                            $result[ $name ] = 'Ф';
                            break;
                        case '2':
                            $result[ $name ] = 'Ю';
                            break;
                    }
                    break;
                case 'owner':
                    switch ($values['owner_person_types_id']) {
                        default://поставить более жесткие условия
                            $result[ $name ] = $values['owner_lastname'] . ' ' . $values['owner_firstname'] . ' ' . $values['owner_patronymicname'];
                            break;
                        case '2':
                            $result[ $name ] = $values['owner_lastname'];
                            break;
                    }
                    break;
                case 'owner_resident':
                    $result[ $name ] = ($values[ $name ] == 1) ? 'true' : 'false';
                    break;
                case 'owner_address':
                    $result[ $name ] = Regions::getTitle($values['owner_regions_id']);

                    if ($values['owner_area']) {
                        $result[ $name ] .= ', ' . $values['owner_area'].' р-н';
                    }

                    if (!in_array($values['owner_regions_id'], $REGIONS)) {
                        $result[ $name ] .= ', ' . $values['owner_city'];
                    }

                    $result[ $name ] .=  ', ' . StreetTypes::getTitle($values['owner_street_types_id']) . ' ' . $values['owner_street'] . ', буд. ' . $values['owner_house'];

                    if ($values['owner_flat']) {
                        switch ($values['owner_person_types_id']) {
                            case 1:
                                $result[ $name ] .= ', кв. ' . $values['owner_flat'];
                                break;
                            case 2:
                                $result[ $name ] .= ', оф. ' . $values['owner_flat'];
                                break;
                        }
                    }
                    break;
                case 'owner_person_types_id':
                case 'assured_person_types_id':
                    switch ($values[ $name ]) {
                        case '1':
                            $result[ $name ] = 'Ф';
                            break;
                        case '2':
                            $result[ $name ] = 'Ю';
                            break;
                    }
                    break;
                case 'marka':
                    $result[ $name ] = $result[ 'owner_brand' ] . ' ' . $result[ 'owner_model' ];
                    break;
                case 'risks_id':
                     $result[ $name ] =  $values[ $name ];//переделать риски, из общего справочника
                    break;
                case 'mvs':
                    $result[ $name ] = ($values[ 'mvs_average' ] == '4') ? 'true' : 'false';//Ознака врегулювання за європротоколом (если 2 – европротокол , озна)', /*по новому європротокол 4 треба підбирати вручну, бо є старі справи*/
                    break;
                case 'old_data':
                case 'deleted':
                    $result[ $name ] = 'false';
                    break;
                default:
                    $result[ $name ] = $values[ $name ];
                    break;
            }
        }

        return $result;
    }

    function exportAll($data, $excel = false) {
        global $db;

        if (!(intval($data['import']) == 1)) {
			$this->checkPermissions('exportMTSBU', $data);
		}

        $fields = array(
            'blank_number',
            'blank_series',
            'accidents_number',
            'accidents_date',
            'accidents_id',
            'insurer_identification_code',
            'insurer',
            'insurer_years_old',
            'insurer_sex',
            'insurer_address',
            'insurer_driver_licence_series',
            'insurer_driver_licence_number',
            'auto',
            'insurer_sign',
            'insurer_shassi',
            'insurer_driver_identification_code',
            'insurer_driver',
            'driver_years_old',
            'driver',
            'driver_sex',
            'driver_address',
            'driver_licence_series',
            'driver_licence_number',

            'resolve_date',
            'insurance',
            'amount_rough',
            'acts_amount',
            'payments_date',
            'regres',
            'fraud',

            'owner_identification_code',
            'owner',
            'owner_status',
            'owner_resident',
            'owner_address',
            'owner_years_old',
            'owner_sex',
            'owner_person_types_id',
            'registration_accident_number',
            'accidents_datetime',
            'accidents_address',

            'assured_identification_code',
            'assured_person_types_id',
            'assured',
            'assured_resident',
            'assured_address',
            'owner_brand',
            'owner_model',
            'marka',
            'owner_sign',
            'owner_shassi',

            'risks_id',
            'victim_damage_note',
            'step_damage',
            'property_types_id',
            'mvs', //Ознака врегулювання за європротоколом (если 2 – европротокол , озна)',/*по новому європротокол 4 треба підбирати вручну, бо є старі справи*/
            'accident_schemes_id',
            'owner_insurance_company',
            'owner_blank_number',
            'owner_blank_series',
            'step_guilt',
            'old_data',
            'deleted');

			if(intval($data['import']) == 1){
				foreach($data['conditions'] as $condition) {
					$conditions[] = $condition;
				}
			} else {			
				$conditions[] = 'b.owner_types_id = 2';
				$conditions[] = 'a.date < ' . $db->quote(date('Y-m').'-01');
				$conditions[] = 'b.mtsbu_date = ' . $db->quote('0000-00-00');
				 
			}
//_dump($conditions);exit;
        $sql =  'SELECT ' .
                    //общие данные
                   'f.blank_number AS blank_number,
                    b.owner_person_types_id as owner_person_types_id,
                    f.blank_series AS blank_series,
                    a.number AS accidents_number,
                    date_format(a.date,\''. DATE_FORMAT .'\') AS accidents_date ,
                    a.id as accidents_id, ' .
                    //Страхователь
                   'f.insurer_edrpou, f.insurer_identification_code, f.person_types_id AS insurer_person_types_id,
                    f.insurer_lastname, f.insurer_firstname, f.insurer_patronymicname,
                    (TO_DAYS(a.datetime) - TO_DAYS(f.insurer_dateofbirth)) / 365 AS insurer_years_old,
                    f.insurer_zip, f.insurer_regions_id, f.insurer_area, f.insurer_city, f.insurer_street_types_id, f.insurer_street, f.insurer_house, f.insurer_flat,
                    f.insurer_driver_licence_series,
                    f.insurer_driver_licence_number,
                    insurer_driver_identification_code,
                    insurer_driver_lastname, insurer_driver_firstname, insurer_driver_patronymicname,
                    driver_licence_series, driver_licence_number,
                    f.brand as insurer_brand,
                    f.model as insurer_model,
                    f.sign AS insurer_sign,
                    f.shassi AS insurer_shassi, ' .

                    //Потерпевший
                   'b.owner_identification_code,
                    b.owner_lastname, b.owner_firstname, b.owner_patronymicname,
                    b.owner_resident,
                    b.owner_regions_id, b.owner_area, b.owner_city, b.owner_street_types_id, b.owner_street, b.owner_house, b.owner_flat,'.
                   'b.owner_brand,
                    b.owner_model,
                    b.owner_sign,
                    b.owner_shassi,
                    owner_insurer_company as owner_insurance_company,
                    IF(mvs = 2, 100, \'\') as step_guilt,
                    owner_policies_number AS owner_blank_number,
                    owner_policies_series AS owner_blank_series, ' .

                    //Данные по делу
                   'a.insurance,
                    amount_rough,
                    regres,
                    fraud,
                    b.property_types_id,
                    date_format(a.datetime,\''. DATETIMEFULL_FORMAT .'\') AS accidents_datetime,
                    b.address AS accidents_address,
                    IF(a.risks_id > 0, a.risks_id, application_risks_id) AS risks_id,
                    b.victim_damage_note,
                    b.damage_extent_id as step_damage,
                    mvs,mvs_average,
                    accident_schemes_id '.


            'FROM ' . PREFIX . '_accidents AS a ' .
            'JOIN ' . PREFIX . '_accidents_go AS b ON a.id = b.accidents_id ' .
            'JOIN ' . PREFIX . '_policies AS e ON a.policies_id = e.id ' .
            'JOIN ' . PREFIX . '_policies_go AS f ON a.policies_id = f.policies_id ' .
            'JOIN ' . PREFIX . '_street_types AS h ON b.owner_street_types_id = h.id ' .
            'JOIN ' . PREFIX . '_regions AS i ON b.owner_regions_id = i.id ' .
            'WHERE ' . implode(' AND ', $conditions) . ' ' .
            'GROUP BY a.id';

        $list = $db->getAll($sql);

		if (intval($data['import']) == 1) {
			return $list;
		}
        foreach ($list as $i => $row) {
            $list[ $i ] = $this->prepareValuesMTSBU($fields, $row);
        }

        if ($excel) {
            header('Content-Disposition: attachment; filename="accidents.xls"');
            header('Content-Type: ' . Form::getContentType('mtsbu_accidents.xls'));

            include_once 'Accidents/exportMTSBU.php';
        }
    }

    function exportAllInWindow($data) {
        $this->exportAll($data, true);
    }

    function exportClosed($data, $excel = false) {
        global $db;

        if (!(intval($data['import']) == 1)) {
			$this->checkPermissions('exportMTSBU', $data);
		}

        $fields = array(
            'blank_number',
            'blank_series',
            'accidents_number',
            'accidents_date',
            'acts_id',
            'insurer_identification_code',
            'insurer',
            'insurer_years_old',
            'insurer_sex',
            'insurer_address',
            'insurer_driver_licence_series',
            'insurer_driver_licence_number',
            'auto',
            'insurer_sign',
            'insurer_shassi',
            'insurer_driver_identification_code',
            'insurer_driver',
            'driver_years_old',
            'driver',
            'driver_sex',
            'driver_address',
            'driver_licence_series',
            'driver_licence_number',

            'insurance',
            'amount_rough',
            'acts_amount',
            'resolve_date',
            'regres',
            'fraud',

            'owner_identification_code',
            'owner',
            'owner_status',
            'owner_resident',
            'owner_address',
            'owner_years_old',
            'owner_sex',
            'owner_person_types_id',
            'registration_accident_number',
            'accidents_datetime',
            'accidents_address',

            'assured_identification_code',
            'assured_person_types_id',
            'assured',
            'assured_resident',
            'assured_address',
            'owner_brand',
            'owner_model',
            'marka',
            'owner_sign',
            'owner_shassi',

            'risks_id',
            'victim_damage_note',
            'step_damage',
            'step_guilt',

            'mvs', //Ознака врегулювання за європротоколом (если 2 – европротокол , озна)',/*по новому європротокол 4 треба підбирати вручну, бо є старі справи*/
            'accident_schemes_id',
            'property_types_id',
            'owner_insurance_company',
            'owner_blank_number',
            'owner_blank_series',

            'old_data',
            'deleted');

        //$conditions[] = 'a.accident_statuses_id = ' . ACCIDENT_STATUSES_RESOLVED;
		if(intval($data['import']) == 1){
			foreach($data['conditions'] as $condition) {
				$conditions[] = $condition;
			}
			foreach($data['conditions2'] as $condition2) {
				$conditions2[] = $condition2;
			}
		} else {			
			$conditions[] = 'b.owner_types_id = 2';
			
		 
			
			
			$conditions2[] = '(c.payment_types_id IN (' . PAYMENT_TYPES_COMPENSATION. ', ' . PAYMENT_TYPES_PART_PREMIUM . ') OR c.id IS NULL)';
			$conditions2[] = 'b.mtsbu_date = ' . $db->quote('0000-00-00');
			$conditions2[] = 'a.date <> ' . $db->quote('0000-00-00');
			$conditions2[] = 'a.date < '. $db->quote(date('Y-m').'-01');
			//$conditions2[] = 'a.id=11612';
		}        

        $sql =  'SELECT ' .

                    //Общие данные
                   'f.blank_number AS blank_number,
                    f.blank_series AS blank_series,
                    a.number AS accidents_number,
                    date_format(a.date,\''. DATE_FORMAT .'\') AS accidents_date , ' .
                    'c.acts_id as acts_id,' .

                    //Страхователь
                   'f.insurer_edrpou, f.insurer_identification_code, f.person_types_id AS insurer_person_types_id,
                    f.insurer_lastname, f.insurer_firstname, f.insurer_patronymicname,
                    (TO_DAYS(a.datetime) - TO_DAYS(f.insurer_dateofbirth)) / 365 AS insurer_years_old,
                    f.insurer_zip, f.insurer_regions_id, f.insurer_area, f.insurer_city, f.insurer_street_types_id, f.insurer_street, f.insurer_house, f.insurer_flat,
                    f.insurer_driver_licence_series,
                    f.insurer_driver_licence_number,
                    insurer_driver_identification_code,
                    insurer_driver_lastname, insurer_driver_firstname, insurer_driver_patronymicname,
                    driver_licence_series, driver_licence_number,
                    f.brand as insurer_brand,
                    f.model as insurer_model,
                    f.sign AS insurer_sign,
                    f.shassi AS insurer_shassi, ' .

                     //Потерпевший
                   'b.owner_person_types_id as owner_person_types_id,
                    b.owner_identification_code,
                    b.owner_lastname, b.owner_firstname, b.owner_patronymicname,
                    b.owner_resident,
                    b.owner_regions_id, b.owner_area, b.owner_city, b.owner_street_types_id, b.owner_street, b.owner_house, b.owner_flat,'.
                    'b.owner_brand,
                    b.owner_model,
                    b.owner_sign,
                    b.owner_shassi,
                    owner_insurer_company as owner_insurance_company,
                    IF(mvs_average = 4, 100, \'\') as step_guilt,
                    owner_policies_number AS owner_blank_number,
                    owner_policies_series AS owner_blank_series, ' .

                    //Данные по делу
                   'a.insurance,
                    a.amount_rough,
                    c.acts_amount as acts_amount_old,
					date_format(c.resolve_date, ' . $db->quote(DATE_FORMAT) . ') as resolve_date,
					getCompensationMTSBU(c.max_id) as acts_amount,
					date_format(a.resolved_date, \'%d.%m.%Y\') as resolve_date_old,
                    regres,
                    fraud,
                    date_format(a.datetime,\''. DATETIMEFULL_FORMAT .'\') AS accidents_datetime,
                    b.address AS accidents_address,
                    b.property_types_id,
                    IF(a.risks_id > 0, a.risks_id, application_risks_id) AS risks_id,
                    b.victim_damage_note,
                    b.damage_extent_id as step_damage,
                    mvs,
                    accident_schemes_id,

					c.acts_id as acts_id '.

            'FROM ' . PREFIX . '_accidents AS a ' .
            'JOIN ' . PREFIX . '_accidents_go AS b ON a.id = b.accidents_id ' .

             //Выбираем страховое возмещение и дату урегулирования, в зависимости от класификации случая ("страховой-нестраховой") за предыдущий месяц с учетом возможных доплат и перевыплат
            'JOIN ( SELECT MAX(a.id) as max_id, CONVERT(GROUP_CONCAT(a.id) USING utf8) as acts_id ,a.accidents_id, MIN(a.date) AS resolve_date, SUM(c.amount) AS acts_amount
                    FROM ' . PREFIX . '_accidents_acts as a
                    JOIN ' . PREFIX . '_accidents_go_acts as b ON a.id = b.accidents_acts_id
                    LEFT JOIN ' . PREFIX . '_accident_payments_calendar as c ON c.acts_id = a.id ' .
                    'WHERE ' . implode(' AND ', $conditions2) . ' ' .
                    'GROUP BY a.accidents_id ) AS c ON a.id = c.accidents_id ' .
            'JOIN ' . PREFIX . '_policies AS e ON a.policies_id = e.id ' .
            'JOIN ' . PREFIX . '_policies_go AS f ON a.policies_id = f.policies_id ' .
            'JOIN ' . PREFIX . '_street_types AS h ON b.owner_street_types_id = h.id ' .
            'JOIN ' . PREFIX . '_regions AS i ON b.owner_regions_id = i.id ' .
            'WHERE ' . implode(' AND ', $conditions) . '  ' .
            'GROUP BY a.id';// HAVING getLastResolvedDate(a.id) < ' . $db->quote(date('Y-m').'-01');
//_dump($sql);exit;
        $list = $db->getAll($sql);

		if (intval($data['import']) == 1) {
			return $list;
		}
        foreach ($list as $i => $row) {
//_dump($row);
            $list[ $i ] = $this->prepareValuesMTSBU($fields, $row, true);
//_dump($list[ $i ]);
        }
//exit;
        if ($excel) {
            header('Content-Disposition: attachment; filename="accidents.xls"');
            header('Content-Type: ' . Form::getContentType('mtsbu_accidents.xls'));

            include_once 'Accidents/exportMTSBU.php';
        }
    }


    function exportClosedInWindow($data) {
        $this->exportClosed($data, true);
    }

    function exportPayments($data, $excel = false) {
        global $db;

        if (!(intval($data['import']) == 1)) {
			$this->checkPermissions('exportMTSBU', $data);
		}

        $fields = array(
            'blank_number',
            'blank_series',
            'accidents_number',
            'payment_date',
            'payments_id',
            'acts_amount',
            'old_data',
            'deleted',
            'acts_id',);
			
		if(intval($data['import']) == 1){
			foreach($data['conditions'] as $condition) {
				$conditions[] = $condition;
			}
			foreach($data['conditions2'] as $condition2) {
				$conditions2[] = $condition2;
			}
		} else {			
			$conditions[] = 'b.owner_types_id = 2';
		
			
			$conditions2[] = 'c.payment_types_id IN (' . PAYMENT_TYPES_COMPENSATION. ', ' . PAYMENT_TYPES_PART_PREMIUM . ')';
			$conditions2[] = 'd.mtsbu_date = \'0000-00-00\'';
			$conditions2[] = 'd.date < ' . $db->quote(date('Y-m').'-01');

			
			
		}


        $sql =  'SELECT ' .

                    //Общие данные
                   'f.blank_number AS blank_number,
                    f.blank_series AS blank_series,
                    a.number AS accidents_number,
                    c.payments_id,
                    c.acts_id,
                    date_format(a.date,\''. DATE_FORMAT .'\') AS accidents_date , ' .

                    //Данные по делу
                   'c.acts_amount,
		date_format(c.payment_date, ' . $db->quote(DATE_FORMAT) . ') as payment_date,
		c.payments_id as payments_id ' .
            'FROM ' . PREFIX . '_accidents AS a ' .
            'JOIN ' . PREFIX . '_accidents_go AS b ON a.id = b.accidents_id ' .

             //Выбираем страховое возмещение и дату урегулирования, в зависимости от класификации случая ("страховой-нестраховой") за предыдущий месяц с учетом возможных доплат и перевыплат
            'JOIN ( SELECT d.id as payments_id, c.acts_id, a.accidents_id, If(d.is_return=1,d.return_date,d.date) AS payment_date, If(d.is_return=1,-d.amount,d.amount) AS acts_amount
                    FROM ' . PREFIX . '_accidents_acts as a
                    JOIN ' . PREFIX . '_accidents_go_acts as b ON a.id = b.accidents_acts_id
                    JOIN ' . PREFIX . '_accident_payments_calendar as c ON c.acts_id = a.id
                    JOIN ' . PREFIX . '_accident_payments as d ON d.payments_calendar_id =  c.id ' .
                    //'WHERE c.payment_types_id IN (' . PAYMENT_TYPES_COMPENSATION. ', ' . PAYMENT_TYPES_PART_PREMIUM . ') AND d.mtsbu_date = \'0000-00-00\' AND d.date < '. $db->quote(date('Y-m').'-01') . ' ) AS c ON a.id = c.accidents_id ' .
					'WHERE ' . implode(' AND ', $conditions2) . ') AS c ON a.id = c.accidents_id ' .
            'JOIN ' . PREFIX . '_policies AS e ON a.policies_id = e.id ' .
            'JOIN ' . PREFIX . '_policies_go AS f ON a.policies_id = f.policies_id ' .
            'JOIN ' . PREFIX . '_street_types AS h ON b.owner_street_types_id = h.id ' .
            'JOIN ' . PREFIX . '_regions AS i ON b.owner_regions_id = i.id ' .
            'WHERE ' . implode(' AND ', $conditions) . ' ' .
            'GROUP BY a.id,c.payments_id';
//_dump($sql);exit;
        $list = $db->getAll($sql);

		if (intval($data['import']) == 1) {
			return $list;
		}
        foreach ($list as $i => $row) {
            $list[ $i ] = $this->prepareValuesMTSBU($fields, $row);
        }

        if ($excel) {
            header('Content-Disposition: attachment; filename="accidents_payments.xls"');
            header('Content-Type: ' . Form::getContentType('mtsbu_accidents.xls'));

            include_once 'Accidents/exportMTSBU.php';
        }


    }

    function exportPaymentsInWindow($data) {
        $this->exportPayments($data, true);
    }

    function importProcess($table, $identifying_field, $date='NOW()') {
        global $db, $Log;
        require_once 'Excel/reader.php';

            $Excel = new Spreadsheet_Excel_Reader();
            $Excel->setOutputEncoding('utf-8');
            $Excel->read($_FILES['file']['tmp_name']);

            //формируем текст файла Excel для продолжения обработки в случае ошибок
            $result = '<table border="1">';
            $date = date('Y-m-d',strtotime($date));

            for ($i = 2; $i<=count($Excel->sheets[0]['cells']); $i++) {
                $result .= '<tr>';

                $sql =  'UPDATE ' . PREFIX . $table . ' ' .
                        'SET ' .
                        'mtsbu_date = ' . $db->quote($date) . ' ' .
                        'WHERE ' . $identifying_field . ' IN (' . $db->quote( $Excel->sheets[0]['cells'][ $i ][5] ).')'; //условие по массиву связано с тем, что возможно обновление даты_моторки для несольких актов, так как в отчет по вымогам нужна конечная сумма по неопределенному к-ву актов

                $db->query($sql);

                if ($db->affectedRows() == 1) {
                    $status = 'Оброблено';
                    $updated++;
                } else {
                    $status = 'Помилка';
                    $error++;
                }

                $result .='<td>' . $Excel->sheets[0]['cells'][$i][5] . '</td>';
                $result .='<td>' . $status .'</td>';

                $total++;

                $result .='</tr>';
            }

            $result .= '</table>';

            //формируем файл для лога, чтоб в случае ошибок перезалить
		    @unlink($_SERVER['DOCUMENT_ROOT'] . '/temp/log.xls');
			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/temp/log.xls', '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv=Content-Type content="text/html; charset=utf-8"><meta name=ProgId content=Excel.Sheet>' . $result . '</body></html>');

			$Log->add('confirm', '<b>Файл був оброблений.</b><br /><br /><table><tr></tr><tr><td>Редаговано:</td><td align="right">' . $updated . '</td></tr><tr style="color: #ffffff; font-weight: bold;"><td>Помилки:</td><td align="right">' . $error . '</td></tr><tr style="font-weight: bold;"><td>Всього:</td><td align="right">' . $total . '</td></tr></table><br /><a href="/temp/log.xls">Скачати файл змін</a>' , $params);

            header('Location: ' . $_SERVER['PHP_SELF'] .'?do=Accidents|show&menu=main&subMenu=Accidents');
            exit;

    }

    function importAll($data) {
        global $Log;
        if (is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] && ereg('\.xls$', $_FILES['file']['name'])) {
             $this->checkPermissions('import', $data);
             $this->importProcess('_accidents_go', 'accidents_id', $data['date_import']);
        }

        include_once 'Accidents/importMTSBU.php';
    }
    function importClosed($data) {
        global $Log;
        if (is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] && ereg('\.xls$', $_FILES['file']['name'])) {
             $this->checkPermissions('import', $data);
             $this->importProcess('_accidents_go_acts', 'accidents_acts_id', $data['date_import']);
        }

        include_once 'Accidents/importMTSBU.php';
    }
    function importPayments($data) {
        global $Log;
        if (is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] && ereg('\.xls$', $_FILES['file']['name'])) {
             $this->checkPermissions('import', $data);
             $this->importProcess('_accident_payments', 'id', $data['date_import']);
        }
        include_once 'Accidents/importMTSBU.php';
    }

    function import($data){
        global $db, $Log;

        $this->checkPermissions('import', $data);

        if (is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] && ereg('\.xls$', $_FILES['file']['name'])) {
            switch($data['do']) {
                case 'Accidents|importAll':
                    $this->importProcess('_accidents_go', 'accidents_id', $data['import_date']);
                    break;
                case 'Accidents|importClosed':
                    $this->importProcess('_accidents_go_acts', 'accidents_acts_id', $data['import_date']);
                    break;
                case 'Accidents|importPayments':
                    $this->importProcess('_accident_payments', 'id', $data['import_date']);
                    break;

            }


        }

        include_once 'Accidents/importMTSBU.php';
    }

    function showApplicantTabs($data, $action) {
        global $Authorization;

        if (!$data['accidents_id']) {
            $data['accidents_id'] = $data['id'];
        }

        include_once $this->object . '/goApplicantTabs.php';
    }

    function findApplication() {
		global $db;
	
		if ($_POST['applications']['owner_types_id'] == 1) {
			if (!$_POST['applications']['insurer_accidents_id']) {
				$sql = 'SELECT victim_accidents_id ' .
					   'FROM ' . PREFIX . '_accidents_go_victim_to_insurer ' .
					   'WHERE insurer_accidents_id = ' . intval($_POST['applications']['accidents_id']);
				$_POST['applications']['insurer_accidents_id'] = $_POST['applications']['accidents_id'];
				$_POST['applications']['victim_accidents_id'] = $db->getOne($sql);
			}
		} elseif ($_POST['applications']['owner_types_id'] == 2) {
			if (!$_POST['applications']['victim_accidents_id']) {
				$sql = 'SELECT insurer_accidents_id ' .
					   'FROM ' . PREFIX . '_accidents_go_victim_to_insurer ' .
					   'WHERE victim_accidents_id = ' . intval($_POST['applications']['accidents_id']);
				$_POST['applications']['victim_accidents_id'] = $_POST['applications']['accidents_id'];
				$_POST['applications']['insurer_accidents_id'] = $db->getOne($sql);
			}
		}
    }

    function setInsurerAccidentsResponsible($id){
        global $db;

        $sql = 'SELECT average_managers_id, estimate_managers_id, parent_application_id ' .
               'FROM ' . PREFIX . '_accidents ' .
               'JOIN ' . PREFIX . '_accidents_go ON id = accidents_id ' .
               'WHERE id = ' . intval($id);

        $parent_accident = $db->getRow($sql);

        $sql = 'UPDATE ' . PREFIX . '_accidents ' .
               'SET ' .
                    'average_managers_id = ' . intval($parent_accident['average_managers_id']) . ', ' .
                    'estimate_managers_id = ' . intval($parent_accident['estimate_managers_id']) . ' ' .
               'WHERE id = ' . intval($parent_accident['parent_application_id']);
        $db->query($sql);
    }
	
	function backPreviousStatusesInWindow($data) {
		global $db, $Authorization;
		
		$current_accident_statuses_id = $this->getAccidentStatusesId($data['accidents_id']);
		$current_accident_statuses_title = $this->getAccidentStatusesTitle($current_accident_statuses_id);
		$new_accident_statuses_id = $data['accident_statuses_id'];
		$new_accident_statuses_title = $this->getAccidentStatusesTitle($data['accident_statuses_id']);
		
		$sql = 'UPDATE ' . PREFIX . '_accidents ' .
		       'SET accident_statuses_id = ' . intval($data['accident_statuses_id']) . ' ' .
			   'WHERE id = ' . intval($data['accidents_id']);
		$db->query($sql);
		
		//switch ($current_accident_statuses_id) {
			//case ACCIDENT_STATUSES_COORDINATION:
				$sql = 'UPDATE ' . PREFIX . '_accidents_acts ' .
					   'SET act_statuses_id = ' . ($new_accident_statuses_id == ACCIDENT_STATUSES_REINVESTIGATION ? ACCIDENT_STATUSES_INVESTIGATION : intval($new_accident_statuses_id)) . ' ' .
							(in_array($new_accident_statuses_id, array(ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE, ACCIDENT_STATUSES_APPROVAL, ACCIDENT_STATUSES_COORDINATION)) ? ', date = \'0000-00-00\' ' : '') .
					   'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND act_statuses_id = ' . intval($current_accident_statuses_id);
				$db->query($sql);
				//break;
		//}
		
		$sql = 'DELETE FROM ' . PREFIX . '_accident_status_changes ' .
			   'WHERE accidents_id = ' . intval($data['accidents_id']) . ' ' .
			   'ORDER BY created DESC ' .
			   'LIMIT 3';
		$db->query($sql);
		
		$sql =	'INSERT INTO ' . PREFIX . '_accident_status_changes SET ' .
					'accidents_id = ' . intval($data['accidents_id']) . ', ' .
					'accident_statuses_id = ' . intval($data['accident_statuses_id']) . ', ' .
					'accounts_id = ' . intval($data['accounts_id']) . ', ' .
					'accounts_title = ' . $db->quote($data['accounts_title']) . ', ' .
					'duration = ' . intval($data['duration']) . ', ' .
					'created = ' . $db->quote($data['created']);
		$db->query($sql);
		
		$authors_title = $Authorization->data['lastname'] .' '. $Authorization->data['firstname'];
		$authors_id = intval($Authorization->data['id']);
        $monitoring_managers_yes = 0;
        $text = 'перевів справу зі статусу <b>"' . $current_accident_statuses_title . '"</b> в статус <b>"' . $new_accident_statuses_title . '"</b>';

        $sql = 'INSERT INTO ' . PREFIX . '_accident_comments SET ' .
					'accidents_id               = ' . intval($data['accidents_id']) . ', ' .
					'authors_id                 = ' . $db->quote($authors_id) . ', ' .
				'authors_title              = ' . $db->quote($authors_title) . ', ' .
				'text                       = ' . $db->quote($text) . ', ' .
				'monitoring_managers_yes    = ' . intval($monitoring_managers_yes) . ', ' .
				'created                    = NOW()';
         $db->query($sql);
	}
	
	function getOwnerTypesId($id) {
		global $db;
		
		return $db->getOne('SELECT owner_types_id FROM ' . PREFIX . '_accidents_go WHERE accidents_id = ' . intval($id));
	}
	
	function checkInsurerApplicationInWindow($data) {
		global $db;
		
		$sql = 'SELECT CONCAT_WS(\' \', accidents.applicant_lastname, accidents.applicant_firstname) as applicant, date_format(accidents.date, \'%d.%m.%Y\') as date ' .
			   'FROM ' . PREFIX . '_accidents as accidents ' .
			   'JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
			   'WHERE accidents_go.owner_types_id = 1 AND accidents.policies_id = ' . intval($data['policies_id']) . ' AND date_format(datetime, \'%Y-%m-%d\') = ' . $db->quote(date('Y-m-d', strtotime($data['accidents_date'])));
		$list = $db->getAll($sql);
		
		$result = array();
		
		if (is_array($list) && sizeof($list)) {
			$result['state'] = 1;
			$html = '<div class="confirm">';
			$html .= '<a name="message"></a>По страхувальнику уже є повідомлення про подію.';
			foreach ($list as $row) {
				$html .= '<br />Заявник: ' . $row['applicant'] . ', дата: ' . $row['date'];
			}
			$html .= '</div>';
		} else {
			$result['state'] = 0;
		}
		$result['message'] = $html;
		
		echo json_encode($result);
	}
	
	function getMVSType($accidents_id) {
		global $db;
		
		$sql = 'SELECT mvs ' .
			   'FROM ' . PREFIX . '_accidents_go ' .
			   'WHERE accidents_id = ' . intval($accidents_id);
		return $db->getRow($sql);
	}
	
	function setPreviousStatusesSchema() {
		global $Authorization;
		
		if ($Authorization->data['id'] == 1 || in_array(25, $Authorization->data['account_groups_id'])) {
			$this->previousStatusesSchema[ACCIDENT_STATUSES_APPROVAL] = array(ACCIDENT_STATUSES_COORDINATION, ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE);
			$this->previousStatusesSchema[ACCIDENT_STATUSES_PAYMENT] = array(ACCIDENT_STATUSES_APPROVAL);
			$this->previousStatusesSchema[ACCIDENT_STATUSES_RESOLVED] = array(ACCIDENT_STATUSES_APPROVAL);
		}
	}

}

?>