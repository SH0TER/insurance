<?
/*
 * Title: accident KASKO class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';
require_once 'AccidentMessages.class.php';
require_once 'AccidentStatusChanges.class.php';

class Accidents_KASKO extends Accidents {

    var $product_types_id = PRODUCT_TYPES_KASKO;
    
    var $previousStatusesSchema = array(
        ACCIDENT_STATUSES_COORDINATION => array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE),
        ACCIDENT_STATUSES_APPROVAL => array(ACCIDENT_STATUSES_COORDINATION)             
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
                                    'canBeEmpty'    => false
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'                  => 'product_types_id',
                            'description'           => 'Тип продукту',
                            'type'                  => fldHidden,
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
                            'name'              => 'companies_id',
                            'description'       => 'Компанія',
                            'type'              => fldSelect,
                            'condition'         => 'id = 4',//оставляем только Экспресс Страхование
                            'display'           =>
                                array(
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
                            'name'              => 'policies_id',
                            'description'       => 'Поліс',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents',
                            'sourceTable'       => 'policies',
                            'selectField'       => 'id',
                            'orderField'        => 'id'),
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
                                    'canBeEmpty'    => false
                                ),
                            'withoutTable'      => true,
                            'orderName'         => 'policies_number', 
                            'orderPosition'     => 3,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'IF(insurer_person_types_id = 2, insurer_company, CONCAT(insurer_lastname, \' \', insurer_firstname)) AS insurer',
                            'description'       => 'Страхувальник',
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
                            'withoutTable'      => true,
                            'orderName'         => 'insurer',  
                            'orderPosition'     => 4,
                            'table'             => 'policies_kasko'),
                        array(
                            'name'              => 'CONCAT(insurance_policies_kasko_items.brand, \' \',insurance_policies_kasko_items.model) AS item',
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
                                    'canBeEmpty'    => false
                                ),
                            'withoutTable'      => true,
                            'orderName'         => 'item',
                            'orderPosition'     => 5,
                            'table'             => 'policies_kasko_items'),
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
                            'orderPosition'     => 6,
                            'width'             => 100,
                            'table'             => 'policies_kasko_items'),
                        array(
                            'name'              => 'repair_classifications_id',
                            'description'       => 'Класифікація відновлюваного ремонту',
                            'type'              => fldRadio,
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
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'items_id',
                            'description'       => 'ТС',
                            'type'              => fldHidden,
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
                            'table'             => 'accidents_kasko'),
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
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 1,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'in_express',
                            'description'       => 'Наявність в СК',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents'),
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
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents'),
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
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents'),
                        array(
                            'name'              => 'applicant_patronymicname',
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
                            'verification'      =>
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
                            'name'              => 'applicant_street_types_id',
                            'description'       => 'Заявник, тип вулицi',
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
                            'sourceTable'       => 'street_types',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),   
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
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents'),
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
                                    'canBeEmpty'    => false
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
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'            => 'accidents_kasko'),
                        /*array(
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
                            'table'            => 'accidents'),*/
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
                            'name'             => 'application_risks_id',
                            'description'      => 'Ризик',
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
                            'table'            => 'accidents'),
                        array(
                            'name'             => 'types_id',
                            'description'      => 'Тип події',
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
                            'table'            => 'accidents'),
                        array(
                            'name'             => 'consequences',
                            'description'      => 'Ступінь тяжкості наслідків',
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
                            'table'            => 'accidents'),
                        array(
                            'name'              => 'mvs',
                            'description'       => 'Орган куди звернувся',
                            'type'              => fldRadio,
                            'list'              => array(
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents_kasko'),
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents_kasko',
                            'sourceTable'       => 'mvs',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'mvs_title',
                            'description'       => 'Органи',
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
                            'table'             => 'accidents_kasko'),
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
                            'table'             => 'accidents_kasko',
                            'selectField'       => 'CONCAT(lastname,\' \', firstname)',
                            'orderField'        => 'id',
                            'sourceTable'       => 'accounts'),
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents_kasko'),
                        ////////////////////////////////////////////////////////////////////////////////////////////
                        array(
                            'name'             => 'insurance_company_other',
                            'description'      => 'Страховик іншої сторони',
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
                            'table'            => 'accidents_kasko'),
                        array(
                            'name'             => 'policies_series_other',
                            'description'      => 'Серія полісу іншої сторони',
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
                            'table'            => 'accidents_kasko'),
                         array(
                            'name'             => 'policies_number_other',
                            'description'      => 'Номер полісу іншої сторони',
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
                            'table'            => 'accidents_kasko'),
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents_kasko'),
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'assistance_date',
                            'description'       => 'Дата повідомлення диспетчерського центру страховика',
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
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'assistance_place',
                            'description'       => 'З місця пригоди',
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
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'assistance_reason',
                            'description'       => 'Причина',
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
                            'table'             => 'accidents'),
                        array(
                            'name'             => 'driver_lastname',
                            'description'      => 'Водій. Призвище',
                            'type'             => fldText,
                            'maxlength'        => 50,
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
                            'table'            => 'accidents_kasko'),
                        array(
                            'name'             => 'driver_firstname',
                            'description'      => 'Водій. Ім\'я',
                            'type'             => fldText,
                            'maxlength'        => 50,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'driver_patronymicname',
                            'description'       => 'Водій. По батькові',
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'driver_licence_series',
                            'description'       => 'Посвідчення водія, серія',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'driver_licence_number',
                            'description'       => 'Посвідчення водія, номер',
                            'type'              => fldText,
                            'maxlength'         => 6,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'driver_licence_date',
                            'description'       => 'Посвідчення водія, дата',
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'driver_document',
                            'description'       => 'Керував на підставі',
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
                            'table'             => 'accidents_kasko'),
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
                            'orderPosition'     => 18,
                            'table'             => 'accidents',
                            'sourceTable'       => 'accounts',
                            'selectId'          => 'id',
                            'selectField'       => 'lastname',
                            'orderField'        => 'lastname'),
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents'),
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
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 7,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'financial_institutions_amount_rough',
                            'description'       => 'Орієнтовний збиток для банка, грн.',
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'accident_sections_id',
                            'description'       => 'Категорія',
                            'type'              => fldMultipleSelect,
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
                            'table'             => 'accidents',
                            'sourceTable'       => 'accident_sections',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'insurance',
                            'description'       => 'Випадок',
                            'type'              => fldInteger,
                            'list'              => array(
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
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 9,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'amount_rough_type',
                            'description'       => 'Тип орієнтовного збитку',
                            'type'              => fldInteger,
                            'list'              => array(
                                                    1 => 'Орієнтовний',
                                                    2 => 'Фактичний'),
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
                            'table'             => 'accidents_kasko'),
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
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 10,
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
                            'withoutTable'      => true,
                            'orderPosition'     => 11,
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
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 12,
                            'table'             => 'accidents',
                            'sourceTable'       => 'payment_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'compensation',
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
                                    'canBeEmpty'    => false
                                ),
                            'withoutTable'      => true,
                            'orderName'         => 'compensation',
                            'orderPosition'     => 13,
                            'table'             => 'accidents_payment_calendar'),
                        array(
                            'name'              => 'accident_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldSelect,
                            'condition'         => 'id > 0',
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
                            'orderPosition'     => 14,
                            'table'             => 'accidents',
                            'sourceTable'       => 'accident_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
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
                            'table'             => 'accidents'),
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
                            'orderPosition'     => 15,
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
                            'orderPosition'     => 16,
                            'table'             => 'accidents'),
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
                            'orderPosition'     => 17,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'days',
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
                                    'canBeEmpty'    => false
                                ),
                            'withoutTable'      => true,
                            'orderName'         => 'days',
                            'orderPosition'     => 19,
                            'table'             => 'accidents')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 19,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'number'
                    )
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
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents'),*/
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
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
                                    'canBeEmpty'    => false
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents',
                            'sourceTable'       => 'accident_sections',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'             => 'application_risks_id',
                            'description'      => 'Ризик',
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
                            'table'            => 'accidents'),
                        /*array(
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents'),*/
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
                                    'canBeEmpty'    => false
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
                                    'canBeEmpty'    => false
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'risks_id',
                            'description'       => 'Ризик',
                            'type'              => fldRadio,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents'),
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
                            'table'             => 'accidents_kasko'),
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
                            'table'             => 'accidents_kasko'),
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
                            'table'             => 'accidents_kasko'),
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
                            'table'             => 'accidents_kasko'),
                        /*array(
                            'name'              => 'options_guilty_no',
                            'description'       => 'без вини',
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
                            'table'             => 'accidents_kasko'),*/
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
                            'table'             => 'accidents_kasko'),
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
                            'table'             => 'accidents_kasko'),
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
                            'table'             => 'accidents_kasko'),
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
                            'table'             => 'accidents_kasko'),
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'compromise',
                            'description'       => 'Компроміс',
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
                            'name'              => 'compromise_violation',
                            'description'       => 'Умови договри, що порушені',
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
                            'name'              => 'compromise_date',
                            'description'       => 'Дата прийняття компромісного рішення',
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
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'compromise_comment',
                            'description'       => 'Коментар, компроміс',
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
                            'name'              => 'compromise_delta_premium',
                            'description'       => 'Дельта страхового платежу',
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
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'compromise_delta_compensation',
                            'description'       => 'Дельта страхового відшкодування',
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
                                    'canBeEmpty'    => false
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
                                    'canBeEmpty'    => false
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
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents_kasko'),
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'accidents_kasko'),
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents_kasko',
                            'sourceTable'       => 'mvs',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'mvs_title_average',
                            'description'       => 'Органи',
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
                            'table'             => 'accidents_kasko'),
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents_kasko'),
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
                                    'canBeEmpty'    => true
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'financial_institutions_amount_rough',
                            'description'       => 'Орієнтовний збиток для банка, грн.',
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'amount_rough_type',
                            'description'       => 'Тип орієнтовного збитку',
                            'type'              => fldInteger,
                            'list'              => array(
                                                    1 => 'Орієнтовний',
                                                    2 => 'Фактичний'),
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'payments_id',
                            'description'       => 'Виплата',
                            'type'              => fldRadio,
                            'list'              => array(
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'criminal',
                            'description'       => 'Кримінальна справа',
                            'type'              => fldRadio,
                            'list'              => array(
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
                                    'canBeEmpty'    => false
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'participant_brand',
                            'description'       => 'Другий учасник, марка, модель',
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_sign',
                            'description'       => 'Другий учасник, державний знак',
                            'type'              => fldText,
                            //'validationFunction'        => 'isValidSign',
                            'validationFunctionType'    => 'function',
                            'maxlength'         => 8,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_insurance_company',
                            'description'       => 'Другий учасник, cтрахова компанія',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_insurance_number',
                            'description'       => 'Другий учасник, № полісу',
                            'type'              => fldText,
                            'maxlength'         => 20,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_driver_lastname',
                            'description'       => 'Другий учасник, водій, прізвище',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_driver_firstname',
                            'description'       => 'Другий учасник, водій, ім\'я',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_driver_patronymicname',
                            'description'       => 'Другий учасник, водій, по батькові',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_driver_address',
                            'description'       => 'Другий учасник, водій, адреса',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_driver_phone',
                            'description'       => 'Другий учасник, водій, телефон',
                            'type'              => fldText,
                            'maxlength'         => 15,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_owner_lastname',
                            'description'       => 'Другий учасник, власник, прізвище',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_owner_firstname',
                            'description'       => 'Другий учасник, власник, ім\'я',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_owner_patronymicname',
                            'description'       => 'Другий учасник, власник, по батькові',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_owner_address',
                            'description'       => 'Другий учасник, власник, адреса',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'accidents_kasko'),
                        array(
                            'name'              => 'participant_owner_phone',
                            'description'       => 'Другий учасник, власник, телефон',
                            'type'              => fldText,
                            'maxlength'         => 15,
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
                            'table'             => 'accidents_kasko'),
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
                                    'canBeEmpty'    => false
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
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'accidents')
                    )
            );

    function Accidents_KASKO(&$data) {
        Accidents::Accidents($data);

        $this->messages['plural'] = 'Страхові справи';
        $this->messages['single'] = 'Страхова справа';

        $this->product_types_id = $data['product_types_id'] = PRODUCT_TYPES_KASKO;
        $this->objectTitle = 'Accidents_KASKO';
        $this->formDescription['fields'][ $this->getFieldPositionByName('days') ]['name'] = 'getDays(' . PREFIX . '_accidents.id) as days';
        $this->formDescription['fields'][ $this->getFieldPositionByName('compensation') ]['name'] = 'getCompensation(' . PREFIX . '_accidents.id, ' . PREFIX . '_accidents.product_types_id) as compensation';
        
        $this->setPreviousStatusesSchema();
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='showKASKO.php', $limit=true) {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

        $this->mode = 'update';

        $fields[] = 'do';
        $data['do'] = $this->object . '|show&show=kasko';

        $this->setTables('show');
        $this->setShowFields();

        $query =    'SELECT a.id, CONCAT(a.lastname, \' \', a.firstname) AS title ' .
                    'FROM ' . PREFIX . '_accounts as a ' .
                    'JOIN ' . PREFIX . '_account_groups_managers_assignments as b ON a.id = b.accounts_id AND account_groups_id = ' . ACCOUNT_GROUPS_AVERAGE . ' ' .
                    'ORDER BY title';
        $fields['average_managers'] = $db->getAssoc($query);
                
        $query =    'SELECT id, code, title, level ' .
                    'FROM ' . PREFIX . '_car_services ' .
                    'ORDER BY top, num_l';
        $fields['car_services'] = $db->getAssoc($query);

        if (intval($data['accidents_id'])) {
            $conditions[] = PREFIX . '_accidents.id <> ' . intval($data['accidents_id']);
        }

        switch ($Authorization->data['roles_id']) {
            case ROLES_MASTER:
                $fields[] = 'car_services_id';
                $data['car_services_id'] = $Authorization->data['car_services_id'];
                break;
            /*case ROLES_MANAGER:
                if (sizeof($Authorization->data['account_groups_id']) == 1 && in_array(ACCOUNT_GROUPS_SERVICE_DEPARTMENT, $Authorization->data['account_groups_id'])) {
                    $sql_get_accidents = 'SELECT id FROM ' . PREFIX . '_accidents HAVING isVisibleAccidentsServiceDepartment(' . PREFIX. '_accidents.id, ' . $Authorization->data['id'] . ') = 1';
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

        $fields[] = 'archive_statuses_id';
        $conditions[] = 'archive_statuses_id IN(' . implode(', ', $data['archive_statuses_id']) . ')';

        if (is_array($data['in_express']) && sizeof($data['in_express'])) {
            $fields[] = 'in_express';
            $conditions[] = 'in_express IN(' . implode(', ', $data['in_express']) . ')';
        }

        if ($data['number']) {
            $fields[] = 'number';
            $conditions[] = PREFIX . '_accidents.number LIKE ' . $db->quote($data['number'] . '%');
        }

        if ($data['sign']) {
            $fields[] = 'sign';
            $conditions[] =  'sign LIKE ' . $db->quote($data['sign'] . '%');
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
            $conditions[] = PREFIX . '_policies.insurer LIKE ' . $db->quote($data['insurer'] . '%');
        }                                                                          

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(' . $this->tables[0] . '.created) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] =  'TO_DAYS(' . $this->tables[0] . '.created) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }

        if (intval($data['car_services_id'])) {
            $sql_get_accidents = 'SELECT id FROM ' . PREFIX . '_accidents WHERE product_types_id = ' . PRODUCT_TYPES_KASKO . ' HAVING isVisibleAccidentsMaster(' . PREFIX. '_accidents.id, ' . $Authorization->data['id'] . ') > 0';
            $accidents = $db->getCol($sql_get_accidents);
            if (is_array($accidents) && sizeof($accidents)) {
                $conditions[] = '(' . PREFIX . '_accidents.id IN(' . implode(', ', $accidents) . ') OR ' . PREFIX . '_accidents.calculation_car_services_id = ' . intval($data['car_services_id']) . ')';
            } else {
                $conditions[] = '(' . PREFIX . '_accidents.car_services_id = ' . intval($data['car_services_id']) . ' OR ' . PREFIX . '_accidents.calculation_car_services_id = ' . intval($data['car_services_id']) . ')';
            }
        }

        if ($data['clients_id']) {
            $fields[] = 'clients_id';
            $conditions[] = PREFIX . '_accidents.policies_id IN(SELECT id FROM ' . PREFIX . '_policies WHERE clients_id = ' . intval($data['clients_id']) . ')';
        }

        if (intval($Authorization->data['companies_id'])) {
            $data['companies_id'] = array($Authorization->data['companies_id']);
        }

        $data['companies_id'] = array(INSURANCE_COMPANIES_EXPRESS);

        $fields[] = 'companies_id';
        $conditions[] = PREFIX . '_accidents.companies_id IN(' . implode(', ', $data['companies_id']) . ')';

        $conditions_or = array();//спец масив для определения доступа к делам для аваркомов и експертов
        if ($Authorization->data['roles_id'] == ROLES_MANAGER && $this->permissions['updateRisk'] && !$this->permissions['updateRiskAll'] && $this->permissions['updateActs'] && !$this->permissions['updateActsAll'] && !in_array($Authorization->data['id'], array(6560, 9725))) {
            //if(!$data['accidents_id']) {
                if ($this->permissions['updateClassification']) {
                    $conditions_or[] = '(((average_managers_id IN(' . implode(', ', $Authorization->data['managers']) . ') OR average_managers_id = 0) AND ' . PREFIX . '_accidents.archive_statuses_id = 0) OR ' . PREFIX . '_accidents.archive_statuses_id = 1)';
                } else {
                    $conditions_or[] = '(average_managers_id IN(' . implode(', ', $Authorization->data['managers']) . ') OR ' . PREFIX . '_accidents.archive_statuses_id = 1)';
                }
            //}
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
            $sql    =  'SELECT ' . $this->getShowFieldsSQLString() . ', insurance, in_express, ' . PREFIX . '_policies.number AS policies_number, ' . PREFIX . '_accidents.policies_id, ' . PREFIX . '_accidents_kasko.accidents_id, ' . PREFIX . '_policies.product_types_id, ' .
                        'accident_statuses_id AS statuses_id, a.lastname AS average_manager, b.lastname AS estimate_manager, ' .  PREFIX . '_accident_sections.id AS sectionsId, ' .
                        'getSummCarService(' . PREFIX . '_accidents.id, ' . PREFIX . '_accidents.car_services_id) as summ_amount, ' .
                        PREFIX . '_accident_sections.title AS accident_sections_title, ' .
                        PREFIX . '_accidents.car_services_id, getStateInRepair(' . PREFIX . '_accidents.id) as in_repair, ' .
                        'IF(getMaxSetAccidentsStatusesDate(' . PREFIX . '_accidents.id, ' . ACCIDENT_STATUSES_CLOSED . ') IS NULL OR ' . PREFIX . '_accidents.accident_statuses_id <> ' . ACCIDENT_STATUSES_CLOSED . ', TO_DAYS(NOW()) - TO_DAYS(' . PREFIX . '_accidents.date), TO_DAYS(getMaxSetAccidentsStatusesDate(' . PREFIX . '_accidents.id, ' . ACCIDENT_STATUSES_CLOSED . ')) - TO_DAYS(' . PREFIX . '_accidents.date)) AS accidents_days, ' .
                        (($Authorization->data['roles_id'] == ROLES_MASTER) ? 'isVisibleAccidentsMaster(' . PREFIX . '_accidents.id, ' . intval($Authorization->data['id']) . ') as visible_like, ' : '') .
                        'getDaysForExpress(' . PREFIX . '_accidents.id) as days_cl, ' . PREFIX . '_clients.important_person ' .
                        'FROM ' . PREFIX . '_accidents ' .
                        'JOIN ' . PREFIX . '_accidents_kasko ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_kasko.accidents_id ' .
                        'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
                        'JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_kasko.policies_id ' .
                        'JOIN ' . PREFIX . '_policies_kasko_items ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_kasko_items.policies_id AND ' . PREFIX . '_accidents_kasko.items_id = ' . PREFIX . '_policies_kasko_items.id ' .
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
            $sql    =   'SELECT ' . $this->getShowFieldsSQLString() . ', insurance, ' . PREFIX . '_policies.number AS policies_number, ' . PREFIX . '_accidents_kasko.accidents_id, ' . PREFIX . '_accidents.product_types_id, ' .
                        'accident_statuses_id AS statuses_id, a.lastname AS average_manager, b.lastname AS estimate_manager, ' .
                        PREFIX . '_accident_sections.title AS accident_sections_title ' .
                        'FROM ' . PREFIX . '_accidents ' .
                        'JOIN ' . PREFIX . '_accidents_kasko ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_kasko.accidents_id ' .
                        'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_policies.accidents_id ' .
                        'JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_policies_kasko.accidents_id ' .
                        'JOIN ' . PREFIX . '_policies_kasko_items ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_kasko_items.policies_id AND ' . PREFIX . '_accidents_kasko.items_id = ' . PREFIX . '_policies_kasko_items.id ' .
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
//      _dump($sql);
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
            $sql =  'SELECT id, title, level - 1 AS level ' .
                    'FROM ' . PREFIX . '_car_services ' .
                    'ORDER BY num_l, title';
            $car_services = $db->getAll($sql, 60 * 60);
        }

        include 'Accidents/showKASKO.php';
    }

    function getListValue($field, $data) {
        global $db, $Authorization;

        switch ($field['name']) {
            case 'mvs_id_average':
            case 'mvs_id':
                $sql =  'SELECT a.id, a.title, b.title AS regions_title ' .
                        'FROM ' . PREFIX . '_mvs AS a ' .
                        'JOIN  ' . PREFIX . '_regions AS b ON a.regions_id = b.id ' .
                        'ORDER BY b.title, a.title';
                $list = $db->getAll($sql, 30*60);

                if (is_array($list)) {
                    foreach ($list as $row) {
                        $options[ $row['id'] ] = array(
                            'title'         => $row['title'],
                            'optgroup'      => $row['regions_title'],
                            'obligatory'    => $row['obligatory']);
                    }
                }
                break;
            case 'car_services_id':
                $sql = 'SELECT a.id, a.title, b.title AS regions_title ' .
                        'FROM ' . PREFIX . '_car_services AS a ' .
                        'JOIN  ' . PREFIX . '_regions AS b ON a.regions_id = b.id ' .
                        'ORDER BY b.title, a.title';
                $list = $db->getAll($sql, 30*60);
                if (is_array($list)) {
                    foreach ($list as $row) {
                        $options[ $row['id'] ] = array(
                            'title'         => $row['title'],
                            'optgroup'      => $row['regions_title'],
                            'obligatory'    => $row['obligatory']);
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
                        case ROLES_MANAGER:
                            $field['condition'] =  'id IN (SELECT accounts_id FROM ' . PREFIX . '_masters WHERE car_services_id =' .  intval($Authorization->data['car_services_id']) . ' )';
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
        global $Authorization, $Log;
        
        parent::setConstants($data);        

        //$data['managers_id'] = $this->getManagersId();

        if(empty($data['driver_licence_date_month'])) {
            $data['driver_licence_date_month']  = substr($data['driver_licence_date'],3,2);
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
                        $data['date_month'] = date('m');
                        $data['date_day']   = date('d');
                        $data['date_year']  = date('Y');
                        break;
                }
            $data['avr_sign'] = 1; //по умолчанию платим мастеру за прием заявлений
            case $this->object . '|update':

                $data['sign'] = fixSignSimbols($data['sign']);

                switch ($data['companies_id']){
                   case INSURANCE_COMPANIES_GENERALI:
                        $data['owner_regions_id']   = 1;
                        $data['accidents_kasko_id'] = 1;
                        $data['number']             = $data['policies_number'];
                        $data['date']               = $data['policies_date'];
                }

                switch ($data['application_risks_id']) {
                    case RISKS_DTP:
                        $data['consequences'] = array_sum($data['consequences']);
                        break;
                    default:
                        $data['types_id'] = 0;
                        $this->formDescription['fields'][ $this->getFieldPositionByName('types_id') ]['verification']['canBeEmpty'] = true;

                        $data['consequences'] = 0;
                        $this->formDescription['fields'][ $this->getFieldPositionByName('consequences') ]['verification']['canBeEmpty'] = true;
                        break;
                }

                switch (intval($data['mvs'])) {
                    case 0://Нiкуди                 
                        unset($data['mvs_id']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id') ]['verification']['canBeEmpty'] = true;
                        unset($data['mvs_title']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title') ]['verification']['canBeEmpty'] = true;
                        
                        unset($data['insurance_company_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('insurance_company_other') ]['verification']['canBeEmpty'] = true;
                        unset($data['policies_series_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('policies_series_other') ]['verification']['canBeEmpty'] = true;
                        unset($data['policies_number_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('policies_number_other') ]['verification']['canBeEmpty'] = true;
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
                        
                        unset($data['insurance_company_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('insurance_company_other') ]['verification']['canBeEmpty'] = true;
                        unset($data['policies_series_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('policies_series_other') ]['verification']['canBeEmpty'] = true;
                        unset($data['policies_number_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('policies_number_other') ]['verification']['canBeEmpty'] = true;
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

                if (intval($data['assistance'])) {

                    unset($data['assistance_reason']);
                    $this->formDescription['fields'][ $this->getFieldPositionByName('assistance_reason') ]['verification']['canBeEmpty'] = true;

                    if (intval($data['assistance_place'])) {
                        $data['assistance_date_day']    = $data['datetime_day'];
                        $data['assistance_date_month']  = $data['datetime_month'];
                        $data['assistance_date_year']   = $data['datetime_year'];
                        $data['assistance_date']        = $data['datetime'];
                    }
                } else {

                    unset($data['assistance_date_day']);
                    unset($data['assistance_date_month']);
                    unset($data['assistance_date_year']);

                    $this->formDescription['fields'][ $this->getFieldPositionByName('assistance_date') ]['verification']['canBeEmpty'] = true;
                }

                if (is_array($data['participants'])) {
                    foreach ($data['participants'] as $i => $participant) {
                        $data['participants'][ $i ]['sign'] = fixSignSimbols( $data['participants'][ $i ]['sign'] );
                    }
                }
                break;
            case $this->object . '|updateClassification':
                $this->formDescription['fields'][ $this->getFieldPositionByName('application_risks_id') ]['display']['update'] = false;
                break;
            case $this->object . '|updateRisk':
                $data['participant_sign'] = fixSignSimbols($data['participant_sign']);              

                if ($data['options_taxy'] == '1' && $data['policies_options_taxy'] == '0' ||
                    //$data['options_guilty_no']== '' && $data['policies_options_guilty_no'] == '1' ||
                    $data['options_holiday'] == '' && $data['policies_options_holiday'] == '1' ||
                    $data['options_work'] == '' && $data['policies_options_work'] == '1' ||
                    $data['options_season'] == '' && $data['policies_options_season'] == '1') {
                        $data['insurance'] = 3;//не страховое
                }

                $fields = array();
                
                if (!in_array($this->getAccidentStatusesId($data['id']), array(ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE))) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('compromise') ]['display']['update'] = false;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('compromise_violation') ]['display']['update'] = false;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('compromise_delta_premium') ]['display']['update'] = false;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('compromise_delta_compensation') ]['display']['update'] = false;
                }
                
                if ($data['compromise'] && empty($data['compromise_date'])) {
                    $fields[] = 'payments_id';
                    $fields[] = 'reason';
                    $fields[] = 'financial_institutions_amount_rough';
                    $fields[] = 'amount_rough_type';
                } else {
                    if ($data['amount_rough_type'] == 1) {
                        $fields[] = 'financial_institutions_amount_rough';
                    }

                    if($data['insurance'] != 1){
                        $fields[] = 'financial_institutions_amount_rough';
                        $fields[] = 'amount_rough_type';
                    }
                }

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
                        unset($data['mvs_id']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ]['verification']['canBeEmpty'] = true;
                        unset($data['mvs_title']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title_average') ]['verification']['canBeEmpty'] = true;
                        
                        unset($data['insurance_company_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('insurance_company_other') ]['verification']['canBeEmpty'] = true;
                        unset($data['policies_series_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('policies_series_other') ]['verification']['canBeEmpty'] = true;
                        unset($data['policies_number_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('policies_number_other') ]['verification']['canBeEmpty'] = true;
                        unset($data['accident_schemes_id']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('accident_schemes_id') ]['verification']['canBeEmpty'] = true;
                        
                        unset($data['mvs_date_day']);
                        unset($data['mvs_date_month']);
                        unset($data['mvs_date_year']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date_average') ]['verification']['canBeEmpty'] = true;
                        break;
                    case 1://Органи ДАІ
                        unset($data['mvs_title']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title_average') ]['verification']['canBeEmpty'] = true;
                        
                        unset($data['insurance_company_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('insurance_company_other') ]['verification']['canBeEmpty'] = true;
                        unset($data['policies_series_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('policies_series_other') ]['verification']['canBeEmpty'] = true;
                        unset($data['policies_number_other']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('policies_number_other') ]['verification']['canBeEmpty'] = true;
                        unset($data['accident_schemes_id']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('accident_schemes_id') ]['verification']['canBeEmpty'] = true;
                        
                        break;
                    case 2:
                    case 3:
                        unset($data['mvs_id']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ]['verification']['canBeEmpty'] = true;
                        
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
                        $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_id_average') ]['verification']['canBeEmpty'] = true;
                        unset($data['mvs_title']);
                        $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_title_average') ]['verification']['canBeEmpty'] = true;
                        unset($data['mvs_date_day']);
                        unset($data['mvs_date_month']);
                        unset($data['mvs_date_year']);

                        $this->formDescription['fields'][ $this->getFieldPositionByName('mvs_date_average') ]['verification']['canBeEmpty'] = true;
                        break;                      
                }

                if (!intval($data['regres'])) {
                    //$fields[] = 'participant_car_types_id';
                    //$fields[] = 'participant_brands_id';
                    $fields[] = 'participant_brand';
                    //$fields[] = 'participant_models_id';
                    //$fields[] = 'participant_model';
                    $fields[] = 'participant_sign';
                    $fields[] = 'participant_insurance_company';
                    $fields[] = 'participant_insurance_number';
                    $fields[] = 'participant_driver_lastname';
                    $fields[] = 'participant_driver_firstname';
                    $fields[] = 'participant_driver_patronymicname';
                    $fields[] = 'participant_driver_address';
                    $fields[] = 'participant_driver_phone';
                    $fields[] = 'participant_owner_lastname';
                    $fields[] = 'participant_owner_firstname';
                    $fields[] = 'participant_owner_patronymicname';
                    $fields[] = 'participant_owner_address';
                    $fields[] = 'participant_owner_phone';
                }

                if (is_array($fields)) {
                    foreach ($fields as $field) {
                        unset( $data[ $field ] );
                        $this->formDescription['fields'][ $this->getFieldPositionByName( $field ) ]['verification']['canBeEmpty'] = true;
                    }
                }
                
                if ($Authorization->data['id'] == 1 && (intval($data['policies_id']) != intval($data['policies_id_risk_list']) && intval($data['policies_id_risk_list']))) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('risks_id') ]['display']['update'] = false;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('payments_id') ]['display']['update'] = false;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('reason') ]['display']['update'] = false;
                }
                break;
        }

        if (is_array($data['participants'])) {
            $fields = array(
                //'car_types_id',
                //'brands_id',
                'brand',
                //'models_id',
                //'model',
                'sign',
                'insurance_company',
                'insurance_number',
                'driver_lastname',
                'driver_firstname',
                'driver_patronymicname',
                'driver_address',
                'driver_phone',
                'owner_lastname',
                'owner_firstname',
                'owner_patronymicname',
                'owner_address',
                'owner_phone');

            foreach ($data['participants'] as $i => $participant) {
                foreach ($fields as $field) {
                    $data['participants'][ $i ][ $field ] = htmlspecialchars($this->replaceTags(trim( $data['participants'][ $i ][ $field ] )));
                }
            }
        }
    }

    function checkFields($data, $action) {
        global $Log;

        //проверяем заполнены ли поля Гарант Авто
        if($data['companies_id'] == INSURANCE_COMPANIES_GENERALI){
            $Policies = Policies::factory($data, 'KASKO');
            $Policies->setApplicationRequiredFields();
            $Policies->checkFields($data, $action);
        }

        parent::checkFields($data, $action);

        if (!isset($data['application_risks_id']) && $data['step'] == 1) {
            $Log->add('error', '<b>Ризик</b> обов\'язковий для вибору.');
        }
        
        switch ($data['do']) {
            case $this->object . '|insert':
            case $this->object . '|update':

                switch ($data['types_id']) {
                    case '1'://Зіткнення: 2-х учасників
                    case '5'://Наїзд на пішохода
                    case '6'://Наїзд на велосипедиста
                    case '8'://Наїзд на гужовий транспорт
                    case '9'://Наїзд на транспортний засіб, що стоїть
                        if (sizeOf($data['participants']) < 1 && !(intval($data['application_accidents_id']))) {
                            $Log->add('error', 'Не вказали всіх учасників події.');
                        }
                        break;
                    case '2'://Зіткнення: 3-х учасників
                        if (sizeOf($data['participants']) < 2 && !(intval($data['application_accidents_id']))) {
                            $Log->add('error', 'Не вказали всіх учасників події.');
                        }
                        break;
                }

                /*if ((strtotime($data['datetime']) < strtotime($data['policies_begin_datetime_format'][$data['policies_id']]) || strtotime($data['datetime']) > strtotime($data['policies_interrupt_datetime_format'][$data['policies_id']])) && $data['count_items_id'] > 1) {
                    $Log->add('error', 'Дата настання страхового випадку не підпадає під строк дії договору.');
                }*/

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

                //проверка на вводимую дату выдачи прав
                if ($this->formDescription['fields'][ $this->getFieldPositionByName('driver_licence_date') ]['display']['update']) {
                    $this->dates_validate($data['driver_licence_date_year'],'<b>Дата водійських прав</b> невірна');
                }

                //проверка на вводимую дату сообщеня в диспетчерский центр
                if($data['assistance_date']){
                    //$this->dates_validate($data['assistance_date'],'<b>Дата повідомлення в диспетчерський центр</b> невірна');
                }

                if (is_array($data['participants'])) {
                    foreach ($data['participants'] as $participant) {
                        if ($participant['sign'] != '' && !isValidSign( $participant['sign'] )) {
                            $params = array('Інший учасник, державний номер', null);
                            $Log->add('error', 'The <b>%s</b>%s format is not valid.', $params);
                        }
                    }
                }
                break;
            case $this->object . '|updateClassification':
                if ($data['amount_rough'] != '' && intval($data['amount_rough']) <= 0) {
                    $params = array($this->formDescription['fields'][ $this->getFieldPositionByName('amount_rough') ]['description'], null);
                    $Log->add('error', 'The <b>%s</b>%s format is not valid.', $params);
                }
                if ($data['amount_rough'] > $this->getInsurancePrice($data) * 0.7 && $this->getApplicationRisksId($data['id']) != RISKS_HIJACKING1) {
                    $Log->add('error', '<b>Орієнтовний збиток не може перевищувати 70 відсотків страхової суми</b>. Страхова сума становить - <b>' . $this->getInsurancePrice($data) . ' грн.</b>');
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
                break;
        }
    }

    function getPoliciesValues($accidents_id) {
        global $db;

        $sql =  'SELECT a.companies_id, a.policies_id, a.comment, a.monitoring_managers_id, '.
                'b.accidents_id, IF (c.product_types_id = ' . PRODUCT_TYPES_KASKO . ', c.number, LEFT(c.number, LOCATE(\'-\', c.number) - 1)) AS policies_number, ' .
                'IF (c.product_types_id = ' . PRODUCT_TYPES_KASKO . ', \'\', f.shassi) AS shassi, ' .
                'date_format(IF(c.product_types_id = ' . PRODUCT_TYPES_KASKO . ', getPolicyDate(c.number, 2), c.begin_datetime), ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(IF(c.product_types_id = ' . PRODUCT_TYPES_KASKO . ', getPolicyDate(c.number, 3), c.interrupt_datetime), ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, ' .
                'c.amount AS policies_amount, d.financial_institutions_id AS policies_financial_institutions_id, ' .
                'd.options_deterioration_no AS policies_options_deterioration_no, d.options_deductible_glass_no AS policies_options_deductible_glass_no, d.options_first_accident AS policies_options_first_accident, d.options_season AS policies_options_season, d.options_holiday AS policies_options_holiday, d.options_work AS policies_options_work, d.options_taxy AS policies_options_taxy, d.options_agregate_no AS policies_options_agregate_no, d.options_years AS policies_options_years, ' .
                'SUM(e.amount) AS policy_payments_amount ' .
                'FROM ' . PREFIX . '_accidents AS a ' .
                'JOIN ' . PREFIX . '_accidents_kasko AS b ON a.id = b.accidents_id ' .
                'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
                'JOIN ' . PREFIX . '_policies_kasko AS d ON a.policies_id = d.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_policy_payments AS e ON a.policies_id = e.policies_id ' .
                'JOIN ' . PREFIX . '_policies_kasko_items as f ON b.items_id = f.id ' .
                'WHERE a.id = ' . intval($accidents_id);
        return $db->getRow($sql);
    }

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        switch ($_REQUEST['do']) {
            case $this->object . '|load':
            case $this->object . '|view':
                $sql =  'SELECT a.monitoring_managers_id, c.shassi, c.sign, c.brand, c.model, ' .
                        'd.insurer_lastname, d.insurer_passport_series, d.insurer_passport_number, d.insurer_identification_code, d.insurer_driver_licence_series, d.insurer_driver_licence_number, ' .
                        'e.number AS policies_number, e.date AS policies_date, date_format(e.date, ' . $db->quote('%Y') . ') AS policies_date_year, date_format(e.date, ' . $db->quote('%m') . ') AS policies_date_month, date_format(e.date, ' . $db->quote('%d') . ') AS policies_date_day ' .
                        'FROM ' . PREFIX . '_accidents AS a ' .
                        'LEFT JOIN ' . PREFIX . '_accidents_kasko AS b ON a.id = b.accidents_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_kasko_items AS c ON a.policies_id = c.policies_id AND b.items_id = c.id ' .
                        'LEFT JOIN ' . PREFIX . '_policies_kasko AS d ON a.policies_id = d.policies_id ' .
                        'LEFT JOIN ' . PREFIX . '_policies AS e ON a.policies_id = e.id ' .
                        'WHERE a.id = ' . intval($data['id']);
                $row =  $db->getRow($sql);

                $data = array_merge($data, $row);

                $sql =  'SELECT * ' .
                        'FROM ' . PREFIX . '_accidents_kasko_participants ' .
                        'WHERE accidents_id = ' . intval($data['id']);
                $data['participants'] = $db->getAll($sql);
                break;
            case $this->object . '|viewClassification':
            case $this->object . '|updateClassification':
                $data = array_merge($data, $this->getPoliciesValues($data['id']));
                break;
            case $this->object . '|viewRisk':
            case $this->object . '|updateRisk':
                $row = $this->getPoliciesValues($data['id']);

                $data = array_merge($data, $row);
                break;
        }

        $data['accidents_id'] = $data['id'];

        return $data;
    }

    function setAdditionalFields($id, $data, $init=false) {
        global $db;

        parent::setAdditionalFields($id, $data);

        if($data['product_types_id'] == PRODUCT_TYPES_CARGO_CERTIFICATE)  $data['product_types_id'] = PRODUCT_TYPES_KASKO;

        $sql =  'SELECT date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, ' .
                'date_format(c.end_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_end_datetime_format ' .
                'FROM ' . PREFIX . '_accidents AS a ' .
                'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
                'WHERE a.id = ' . intval($data['id']);
        $row =  $db->getRow($sql);

        $data = array_merge($data, $row);

        if ($init) {
            $sql =  'UPDATE ' . PREFIX . '_accidents SET ' .
                    'datetime_average = datetime, ' .
                    'description_average = description ' .
                    'WHERE id = ' . intval($id);
            $db->query($sql);

            $sql =  'UPDATE ' . PREFIX . '_accidents_kasko, ' . PREFIX . '_accidents SET ' .
                    'address_average = address, ' .
                    'mvs_average = mvs, ' .
                    'mvs_id_average = mvs_id, ' .
                    'mvs_title_average = mvs_title, ' .
                    'mvs_date_average = mvs_date ' .
                    'WHERE accidents_id = ' . intval($id) . ' AND id = ' . intval($id);
            $db->query($sql);

            //фиксируем данные по органам ГАИ
            if (intval($data['mvs_id']) && intval($data['mvs']) == 1) {
                $sql =  'UPDATE ' . PREFIX . '_accidents_kasko, ' . PREFIX . '_mvs SET ' .
                        'mvs_title = title, ' .
                        'mvs_title_average = title ' .
                        'WHERE ' . PREFIX . '_accidents_kasko.mvs_id = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['id']);
                $db->query($sql);
            } else {
                $sql =  'UPDATE ' . PREFIX . '_accidents_kasko SET ' .
                        'mvs_title_average = mvs_title ' .
                        'WHERE accidents_id = ' . intval($data['id']);
                $db->query($sql);
            }
        } elseif (intval($data['mvs_id']) && intval($data['mvs']) == 1) {
            $sql =  'UPDATE ' . PREFIX . '_accidents_kasko, ' . PREFIX . '_mvs SET ' .
                    'mvs_title = title ' .
                    'WHERE ' . PREFIX . '_accidents_kasko.mvs_id = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['id']);
            $db->query($sql);
        }

        //фиксируем данные по вторым участникам
        $this->updateParticipants($data);
    }

    function getProductType() {
        return PRODUCT_TYPES_KASKO;
    }

    function setNumber($data) {
        global $db;

        $sql = 'SELECT product_types_id ' .
               'FROM ' . PREFIX . '_policies ' .
               'WHERE id = ' . intval($data['policies_id']) ;
        $first_symbol = $db->getOne($sql);//находим тип продукта по полису для формирования номера дела, связано с пересечение "перегонов" с "КАСКО"

        $last_number = $this->getLastNumber($data['product_types_id']);//находим последний номер дела по типу продукта

        $sql = 'UPDATE ' . PREFIX . '_accidents AS a ' .
               'SET a.number = CONCAT(\'' . $first_symbol . '\', \'.\', date_format(a.created, \'%y\'), \'.\', ' . intval(intval($last_number+1)) . ') ' .
               'WHERE a.id = ' . intval($data['accidents_id']);
        $db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_accidents_last_numbers ' .
                'SET accidents_last_number = '. intval(intval($last_number+1)) . ' ' .
                'WHERE product_types_id = ' . intval($data['product_types_id']);
        $db->query($sql);
    }

    function insert($data) {
        global $Log, $Authorization;
        $data['step'] = 1;      

        $data['accidents_id'] = parent::insert(&$data, false, true);

        if ($data['accidents_id']) {

            $this->setNumber($data);

            $this->setAdditionalFields($data['accidents_id'], $data, true);

            $this->generateDocuments($data['accidents_id'], 0, 0, 0, array(/*DOCUMENT_TYPES_ACCIDENT_DECLARATION,*/ DOCUMENT_TYPES_ACCIDENT_FRONT_PAGE), $data);

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

            $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
            
            $this->checkOptionFiftyFifty($data);

            if (!intval($data['application_accidents_id'])) {
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

    function load($data, $showForm=true, $action='update', $actionType='update', $template='kaskoApplication.php') {
        global $db;

        $this->checkPermissions('update', $data);

        if ($data['accidents_id']) {
            $data['id'] = $data['accidents_id'];
        } elseif (is_array($data['id'])) {
            $data['id'] = $data['id'][0];
        }
        
        $application = $data['application'];

        $this->setTables('load');
        $this->getFormFields('update');

        $sql =  'SELECT ' . implode(', ', $this->formFields) . ', ' . PREFIX . '_accidents_kasko.accidents_id, accident_statuses_id, car_services_id, ' . PREFIX . '_accidents_kasko.items_id, description, financial_institutions_id, mvs_id, ' . PREFIX . '_policies.price AS policies_price, ' .
                          PREFIX . '_policies.product_types_id, ' . PREFIX . '_clients.important_person '.
                'FROM ' . PREFIX . '_accidents ' .
                'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
                'JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_kasko.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_kasko ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_kasko.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_clients.id = ' . PREFIX . '_policies.clients_id ' .
                'WHERE ' . PREFIX . '_accidents.id = ' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);

        if ($_REQUEST['do'] == $this->object . '|load') {
            switch ($data['accident_statuses_id']) {
                case ACCIDENT_STATUSES_APPLICATION:
                    break;
                case ACCIDENT_STATUSES_CLASSIFICATION:
                    if ($application == 1 || !$this->permissions['updateClassification']) break;
                    if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Classification') {
                        header('Location: /?do=' . $this->object . '|' . $this->mode . 'Classification&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_KASKO);
                        exit;
                    }
                    break;
                case ACCIDENT_STATUSES_INVESTIGATION:
                case ACCIDENT_STATUSES_REINVESTIGATION:
                case ACCIDENT_STATUSES_COMPROMISE_AGREEMENT:
                case ACCIDENT_STATUSES_DEFECTS:
                    if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Risk') {
                        header('Location: /?do=' . $this->object . '|' . $this->mode . 'Risk&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_KASKO);
                        exit;
                    }
                    break;
                case ACCIDENT_STATUSES_COORDINATION:
                    if ($_REQUEST['do'] != $this->object . '|' . $this->mode . 'Acts') {
                        header('Location: /?do=' . $this->object . '|' . $this->mode . 'Acts&accidents_id=' . $data['id'] . '&product_types_id=' . PRODUCT_TYPES_KASKO);
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

    function view($data, $conditions=null, $sql=null, $template='kaskoApplication.php', $showForm=true) {
        if(is_array($data['id'])){
            $data['id'] = $data['id'][0];
        }

        if (intval($data['accidents_id'])) {
            $data['id'] = $data['accidents_id'];
        }

        $this->setTables('view');
        $this->getFormFields('view');

        $identityField = $this->getIdentityField();

        $sql =  'SELECT ' . implode(', ', $this->formFields) . ', companies_id, ' . PREFIX . '_policies.product_types_id, ' . PREFIX . '_clients.important_person ' .
                'FROM ' . PREFIX . '_accidents ' .
                'JOIN ' . PREFIX . '_accidents_kasko ON ' . PREFIX . '_accidents.id = ' . PREFIX . '_accidents_kasko.accidents_id ' .
                'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
                'JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_kasko.policies_id ' .
                'JOIN ' . PREFIX . '_policies_kasko_items ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policies_kasko_items.policies_id AND ' . PREFIX . '_accidents_kasko.items_id = ' . PREFIX . '_policies_kasko_items.id ' .
                'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_clients.id = ' . PREFIX . '_policies.clients_id ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);

        return parent::view($data, null, $sql, $template, $showForm);
    }

    function update($data) {
        global $db, $Log;

        $data['step'] = 1;

        $data['accidents_id'] = parent::update(&$data, false, true);

        if ($data['accidents_id']) {

            if($this->getAccidentStatusesId($data['accidents_id']) == ACCIDENT_STATUSES_APPLICATION) {
                $this->setAdditionalFields($data['accidents_id'], $data, true);
            } else {
                $this->setAdditionalFields($data['accidents_id'], $data);
                
                /*$sql = 'SELECT IF(date_format(\'%Y-%m\', created) = date_format(\'%Y-%m\', date), 1, 0) as sign, created, date ' .
                       'FROM ' . PREFIX . '_accidents ' .
                       'WHERE id = ' . intval($data['accidetns_id']);
                $dates = $db->getRow($sql);
                
                if (!intval($dates['sign'])) {
                    $Accidents = new Accidents($data);
                    $Accidents->send($data['accidetns_id'], 'Accident. changeDateAnotherMonth', array('olddate' => $dates['created'], 'newdate' => $dates['date']));
                }*/
            }

            $this->generateDocuments($data['accidents_id'], 0, 0, 0, array(/*DOCUMENT_TYPES_ACCIDENT_DECLARATION,*/ DOCUMENT_TYPES_ACCIDENT_FRONT_PAGE), $data);

            $this->updateStep($data['accidents_id'], $data['step'] + 1);

            $AccidentStatusChanges = new AccidentStatusChanges($data);
            $AccidentStatusChanges->set($data['accidents_id']);
         
            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

            if (!intval($data['application_accidents_id'])) {
                switch ($data['accident_statuses_id']) {
                    case ACCIDENT_STATUSES_APPLICATION:

                        header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|load&id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
                        break;
                    case ACCIDENT_STATUSES_CLASSIFICATION:
                        $AccidentMessages = new AccidentMessages($data);
                        $AccidentMessages->permissions['insert'] = true;
                        $row = $this->getPoliciesValues($data['id']);
                        $row['statuses_id']                 = ACCIDENT_MESSAGE_STATUSES_QUESTION;
                        $row['message_types_id']            = ACCIDENT_MESSAGE_TYPES_ACCIDENT_NUMBER_CALL;
                        $row['recipient_organizations_id']  = ACCOUNT_GROUPS_CONTACT_CENTER;
                        $AccidentMessages->insert($row,false);

                        //Добавление записи в мониторинг при просрочке 3 дней на написание заявы
                        $date_incident = date($data['datetime_year'].'-'.$data['datetime_month'].'-'.$data['datetime_day']);
                        $date_statement = date($data['date_year'].'-'.$data['date_month'].'-'.$data['date_day']);
                        $date_limit = date('Y-m-d', strtotime($date_incident.'+3 days'));
                        if ($date_limit < $date_statement){
                            $this->insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label style="color:red;"><b>Порушено 3-денний строк написання Заяви про подію</b></label>'));
                        }
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

                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                exit;
            }           
        }
    }

    function updateClassification($data) {
        global $Log, $db;
        
        $this->checkPermissions('updateClassification', $data);

        $this->formDescription = $this->classificationFormDescription;

        if ($_POST['do'] == $this->object . '|updateClassification') {
            $prev_accident_statuses_id = $this->getAccidentStatusesId($data['id']);
            $prev_amount_rough = $this->getAmountRough($data['id']);
            
            $data['accident_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;

            $this->permissions['update'] = $this->permissions['updateClassification'];

            if (Form::update($data, false, false)) {
                
                //если поменялся ориентировочный убыток - шлем письмо
                if($prev_accident_statuses_id != ACCIDENT_STATUSES_CLASSIFICATION && $prev_amount_rough != $data['amount_rough']) {
                    $Accidents = new Accidents($data);
                    $Accidents->send($data['id'], 'Accident. changeAmountRough', array('previous_amount_rough' => $prev_amount_rough, 'current_amount_rough' => $data['amount_rough']));
                }

                //формируем лист согласования
                $this->generateDocuments($data['id'], 0, 0, 0, array(DOCUMENT_TYPES_ACCIDENT_NOTE_AGREEMENT), $data);
                
                //пишем коментарий в мониторинг
                $this->insertAccidentsComment(array('accidents_id'              => $data['id'],
                                                    'monitoring_managers_id'    => $data['average_managers_id'],
                                                    'setAccidentsMonitor'        => true));
                //вычисляем страховую сумму
                $sql = 'SELECT IF(b.date > \'2013-10-31\', 0, 1) as flag, a.car_price + a.price_equipment AS items_price ' .
                       'FROM ' . PREFIX . '_policies_kasko_items AS a ' .
                       'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                       'WHERE a.id = ' . $this->getItemsId($data['id']);
                $items_price = $db->getRow($sql);

                //отправляем письмо
                if($items_price['flag'] == 1 && (floatval($items_price['items_price']) >= ACCIDENT_ITEMS_PRICE_HIGH || (floatval($data['amount_rough']) >= ACCIDENT_AMOUNT_ROUGH && floatval($items_price['items_price']) >= ACCIDENT_ITEMS_PRICE_MIDDLE))) { //если страховая сумма больше 1 млн. грн. включительно или если ориентировочный убыток больше 100 тыс. грн. включительно и страховая сумма больше 150 тыс. грн, то шлем сообщение
                    $this->send($data['id'],'Accident. updateClassification');
                }
                
                AccidentMessages::setRecipientsIdAfterClassification($data);
              
                $this->updateStep($data['id'], 2);

                $AccidentStatusChanges = new AccidentStatusChanges($data);
                $AccidentStatusChanges->set($data['id']);

                $params['title']    = $this->messages['single'];
                $params['id']       = $data['id'];
                $params['storage']  = $this->tables[0];

                $Log->add('confirm', 'Справу класифіковано.' , $params);

                ($this->permissions['updateRisk'])
                    ? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateRisk&accidents_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id'])
                    : header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
                exit;
            }

            $data = $this->replaceSpecialChars($data, 'update');
        } else {
            $data = $this->load($data, false, 'updateClassification');
        }

        $data['policy_payments_calendar'] = $this->getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['product_types_id']);
        $data['accidents_date_values'] = $this->getAccidentsDateValues($data['accidents_id']);

        if ($data['application_risks_id'] == RISKS_HIJACKING1 && $this->getStatusesId($data['id']) == ACCIDENT_STATUSES_CLASSIFICATION) {
            $data['amount_rough'] = $this->getInsurancePrice($data) - $this->getDeductible($data, 1);
        }
        
        return $this->showForm($data, 'updateClassification', 'update', 'kaskoClassification.php');
    }

    function viewClassification($data) {

        $this->checkPermissions('view', $data);

        if ($_POST['do'] == $this->object . '|viewClassification') {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewRisk&accidents_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
            exit;
        }

        $this->formDescription = $this->classificationFormDescription;

        $data['id'] = $data['accidents_id'];
        $data = $this->view($data, null, null, null, false);

        $data['important_person'] = $this->getImportantPerson($data['policies_id']);
        $data['policy_payments_calendar'] = $this->getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['product_types_id']);
        $data['accidents_date_values'] = $this->getAccidentsDateValues($data['accidents_id']);

        return $this->showForm($data, 'viewClassification', 'view', 'kaskoClassification.php');
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
            ACCIDENT_STATUSES_RESOLVED,
            ACCIDENT_STATUSES_SUSPENDED);

        $this->checkPermissions('updateRisk', $data);

        $this->formDescription = $this->riskFormDescription;

        if ($_POST['do'] == $this->object . '|updateRisk') {           

            $accident_statuses_id = $this->getAccidentStatusesId($data['id']);
            $compromise = $this->checkCompromise($data['id'], 1);

            $data['accident_statuses_id'] = ($accident_statuses_id == ACCIDENT_STATUSES_REINVESTIGATION || $accident_statuses_id == ACCIDENT_STATUSES_COORDINATION || $accident_statuses_id == ACCIDENT_STATUSES_COMPROMISE_AGREEMENT || ACCIDENT_STATUSES_COMPROMISE_CONTINUE) ? $accident_statuses_id : ACCIDENT_STATUSES_INVESTIGATION;
            if (!isset($data['compromise_violation'])) {
                $data['compromise_violation'] = $data['compromise_violation_hidden'];
            }

            $this->permissions['update'] = $this->permissions['updateRisk'];

            if (Form::update($data, false, false)) {
            
                $data['accidents_id'] = $data['id'];

                if (intval($data['mvs_average']) == 1 && intval($data['mvs_id_average'])) {
                    $sql =  'UPDATE ' . PREFIX . '_accidents_kasko, ' . PREFIX . '_mvs SET ' .
                            'mvs_title_average = title ' .
                            'WHERE ' . PREFIX . '_accidents_kasko.mvs_id_average = ' . PREFIX . '_mvs.id AND accidents_id = ' . intval($data['accidents_id']);
                    $db->query($sql);
                }

                if (intval($data['policies_id']) != intval($data['policies_id_risk_list']) && intval($data['policies_id_risk_list'])) {
                    $this->changeAccidentsPolicy($data['accidents_id'], $data['policies_id_risk_list']);
                }
                
                //если компромис - генерируем письмо
                if (intval($data['compromise'])) {                  
                    $product_documents['generateDocuments'][] = DOCUMENT_TYPES_ACCIDENT_COMPROMISE_AGREEMENT_LETTER_KASKO;
                } else {
                    $product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_COMPROMISE_AGREEMENT_LETTER_KASKO;
                }

                if (intval($data['insurance']) == 1) {

                    //если уже имеются аткы не в оплате или в "врегульовано", то устанавливаем "випадок"
                    $sql =  'SELECT id ' .
                            'FROM ' . PREFIX . '_accidents_acts ' .
                            'WHERE act_statuses_id <> ' . ACCIDENT_STATUSES_RESOLVED . ' AND accidents_id = ' . intval($data['accidents_id']);
                    $data['id'] = $db->getCol($sql);

                    if (sizeOf($data['id'])) {
                        $sql =  'UPDATE ' . PREFIX . '_accidents_acts SET ' .
                                'insurance = ' . intval($data['insurance']) . ' '.
                                'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND payment_statuses_id NOT IN(' . implode(', ', $conditions_payment_statuses) . ')'. 'AND act_statuses_id NOT IN (' . implode(', ', $conditions_statuses_acts) . ')';
                        $db->query($sql);
                    }

                    if (intval($data['mvs_id_average'])) {
                        $product_documents['generateDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_GAI;
                    } else {
                        $product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_GAI;
                    }

                    if (intval($data['financial_institutions_id'])) {
                        $product_documents['generateDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_BANK;
                    } else {
                        $product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_BANK;
                    }                   

                } elseif (intval($data['insurance']) == 2 || intval($data['insurance']) == 3) {//если событие не страховое, добавляем акт минуя экспертную оценку

                    //если уже существуют акты по делу, то акт на отказ должен быть с буквой "О", для єтого нужно установить переменную "act_type"
                    $sql =  'SELECT id ' .
                        'FROM ' . PREFIX . '_accidents_acts ' .
                        'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND act_statuses_id IN (' . implode(', ', $conditions_statuses_acts) . ')';
                    $data['act_col'] = $db->getCol($sql);
                    if (sizeOf($data['act_col'])) {
                        $data['act_type'] = ACCIDENT_INSURANCE_ACT_TYPE_RETURN_AND_FAILURE;
                    }

                    //страховые акты которые будут изменены
                    $sql =  'SELECT id ' .
                            'FROM ' . PREFIX . '_accidents_acts ' .
                            'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND payment_statuses_id NOT IN(' . implode(', ', $conditions_payment_statuses) . ')'. ' AND act_statuses_id NOT IN (' . implode(', ', $conditions_statuses_acts) . ')';
                    $data['id'] = $db->getCol($sql);

                    $AccidentActs = AccidentActs::factory($data, 'KASKO');

                    if ($data['accident_statuses_id'] != ACCIDENT_STATUSES_COORDINATION) {
                        $data['act_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;
                    } else {
                        $data['act_statuses_id'] = ACCIDENT_STATUSES_COORDINATION;
                    }

                    $product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_GAI;
                    $product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_BANK;
                    
                    if (intval($data['financial_institutions_id'])) {
                        $product_documents['generateDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_BANK;
                    } else {
                        $product_documents['removeDocuments'][] = DOCUMENT_TYPES_ACCIDENT_REQUEST_BANK;
                    }
                    
                    if (is_array($data['id']) && sizeOf($data['id'])) {
                        foreach ($data['id'] as $id) {
                            $data['id'] = $id;
                            $data['updateRisk'] = 1;
                            $AccidentActs->update($data, false);
                        }
                    } else {
                        //$AccidentActs->insert($data, false);
                    }
                    
                    
                }

                foreach ($product_documents as $method => $product_document_types) {
                    $this->$method($data['accidents_id'], 0, 0, 0, $product_document_types, $data);
                }

                //перегоняем акты дальше по статусу, если статус был по делу ошибка в класификации
                $sql =  'UPDATE ' . PREFIX . '_accidents_acts SET ' .
                        'act_statuses_id = ' . ACCIDENT_STATUSES_INVESTIGATION . ' ' .
                        'WHERE accidents_id = ' . $data['accidents_id'] . ' AND act_statuses_id = ' . ACCIDENT_STATUSES_REINVESTIGATION;
                $db->query($sql);

                $this->updateStep($data['id'], 3);

                if ($data['compromise'] && in_array($accident_statuses_id, array(ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_INVESTIGATION))) {
                    if($data['compromise_violation'][1 - sizeof($data['compromise_violation'])]  <> 2){
                        if (empty($data['compromise_date'])) {
                            $data['accident_statuses_id'] = ACCIDENT_STATUSES_COMPROMISE_AGREEMENT;
                        } else {
                            $data['accident_statuses_id'] = ACCIDENT_STATUSES_COMPROMISE_CONTINUE;
                        }
                    }
                } elseif ($data['compromise'] && $accident_statuses_id == ACCIDENT_STATUSES_COMPROMISE_AGREEMENT) {
                    if (!empty($data['compromise_date']) && intval($data['compromise_failed'])) {
            unset($_SERVER['HTTP_REFERER']);
                        $this->closeAccident(array('id' => $data['accidents_id'], 'permission' => true));
                    } elseif(!empty($data['compromise_date'])) {
                        $data['accident_statuses_id'] = ACCIDENT_STATUSES_COMPROMISE_CONTINUE;
                    } else {
                        $data['accident_statuses_id'] = ACCIDENT_STATUSES_COMPROMISE_AGREEMENT;
                    }
                } elseif ($data['compromise'] && $accident_statuses_id == ACCIDENT_STATUSES_COMPROMISE_CONTINUE) {
                    $data['accident_statuses_id'] = ACCIDENT_STATUSES_COMPROMISE_CONTINUE;                                                                              
                }
                if($data['compromise'] && in_array($accident_statuses_id, array(ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE)) && sizeof($data['compromise_violation']) == 1 && in_array(2, $data['compromise_violation'])){
                    $data['accident_statuses_id'] = ACCIDENT_STATUSES_INVESTIGATION;
                }

                if ($data['compromise'] != intval($compromise)) {                                                                        
                    if (in_array($accident_statuses_id, array(ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE))) {
                        $data['accident_statuses_id'] = ACCIDENT_STATUSES_REINVESTIGATION;
                    }
                }

                $this->changeAccidentStatus($data['accidents_id'], $data['accident_statuses_id']);
                $AccidentStatusChanges = new AccidentStatusChanges($data);
                $AccidentStatusChanges->set($data['accidents_id']);

                $params['title']    = $this->messages['single'];
                $params['id']       = $data['accidents_id'];
                $params['storage']  = $this->tables[0];

                $Log->add('confirm', 'Ризик по справі було встановлено.', $params);

                if ($data['insurance']) {
                    ($this->permissions['updateActs'])
                        ? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateActs&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id'])
                        : header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewActs&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
                    exit;
                } else {
                    ($this->permissions['updateRisk'])
                        ? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|updateRisk&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id'])
                        : header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewRisk&accidents_id=' . $data['accidents_id'] . '&product_types_id=' . $data['product_types_id']);
                    exit;
                }
            }

            $data = $this->replaceSpecialChars($data, 'update');
        } else {
            $data = $this->load($data, false, 'updateRisk');

            if (!$data['description_average']) {
                $data['description_average'] = $data['description'];
            }
        }

        $data['policy_payments_calendar'] = $this->getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['product_types_id']);
        $data['accidents_date_values'] = $this->getAccidentsDateValues($data['accidents_id']);
        $data['important_person'] = $this->getImportantPerson($data['policies_id']);
        $data['compromise_violation_list'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_compromise_violation WHERE product_types_id IN (0, 1, ' . PRODUCT_TYPES_KASKO . ')');
        $data['reason_not_payment_insurance_2'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 1 AND product_types_id IN (1, 3)');
        $data['reason_not_payment_insurance_3'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 2 AND product_types_id IN (1, 3)');

        return $this->showForm($data, 'updateRisk', 'update', 'kaskoRisk.php');
    }

    function viewRisk($data) {
        global $db;

        $this->checkPermissions('view', $data);

        if ($_POST['do'] == $this->object . '|viewRisk') {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|viewActs&accidents_id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
            exit;
        }

        $this->formDescription = $this->riskFormDescription;

        $data['id'] = $data['accidents_id'];
        $data = $this->view($data, null, null, null, false);
        $data['risks'] = $this->getRisks($data['id']);

        $data['policy_payments_calendar'] = $this->getPolicyPaymentsCalendar($data['policies_number'], $data['policies_id'], $data['product_types_id']);
        $data['accidents_date_values'] = $this->getAccidentsDateValues($data['accidents_id']);

        $data['important_person'] = $this->getImportantPerson($data['policies_id']);
        $data['compromise_violation_list'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_compromise_violation WHERE product_types_id IN (0, 1, ' . PRODUCT_TYPES_KASKO . ')');
        $data['reason_not_payment_insurance_2'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 1 AND product_types_id IN (1, 3)');
        $data['reason_not_payment_insurance_3'] = $db->getAll('SELECT value, title FROM ' . PREFIX . '_accidents_not_payment_reason WHERE types_id = 2 AND product_types_id IN (1, 3)');

        return $this->showForm($data, 'viewRisk', 'view', 'kaskoRisk.php');
    }

    function updateActs($data) {

        $this->checkPermissions('updateActs', $data);

        $data['step'] = 5;

        $fields[]        = 'accidents_id';
        $conditions[]    = PREFIX . '_accidents_acts.accidents_id = ' . intval($data['accidents_id']);

        $data['accidents'] =& $this;

        $AccidentActs = AccidentActs::factory($data, 'KASKO');

        $this->objectTitle = $AccidentActs->objectTitle;

        $AccidentActs->show($data, $fields, $conditions, null, $AccidentActs->object . '/show.php');

        $this->updateStep($data['accidents_id'], 5);
    }

    function viewActs($data) {
        $data['step'] = 5;

        $fields[]        = 'accidents_id';
        $conditions[]    = PREFIX . '_accidents_acts.accidents_id = ' . intval($data['accidents_id']);

        $fields[]        = 'product_types_id';

        $data['accidents'] =& $this;

        $AccidentActs = AccidentActs::factory($data, 'KASKO');

        $this->objectTitle = $AccidentActs->objectTitle;

        $AccidentActs->permissions['insert']    = false;
        $AccidentActs->permissions['update']    = false;

        $AccidentActs->show($data, $fields, $conditions, null, $AccidentActs->object . '/show.php');
    }

    function deleteProcess(&$data, $i = 0, $folder=null) {
        global $db;

        echo '---';

        //удаляем страховые акты не доведенные до оплаты
        $AccidentActs = AccidentActs::factory($data, 'KASKO');

        //получаем дела, которые нельзя удалять
        $sql =  'SELECT DISTINCT accidents_id ' .
                'FROM ' . $AccidentActs->tables[0] . ' ' .
                'WHERE accidents_id IN(' . implode(', ', $data['id']) . ') AND (payment_statuses_id <> ' . PAYMENT_STATUSES_NOT . ' OR act_statuses_id >= ' . ACCIDENT_STATUSES_COORDINATION . ')';
        $accidents = $db->getCol($sql);

        $data['id'] = array_diff($data['id'], $accidents);

        if (is_array($data['id']) && sizeOf($data['id'])) {

            //удаляем документы
            $AccidentDocuments = new AccidentDocuments($data);

            $sql =  'SELECT id ' .
                    'FROM ' . $AccidentDocuments->tables[0] . ' ' .
                    'WHERE accidents_id IN(' . implode(', ', $data['id']) . ')';
            $toDelete['id'] = $db->getCol($sql);

            $AccidentDocuments->delete($toDelete, false, false);

            //удаляем дополнительные расходы
            $AccidentPaymentsCalendar = new AccidentPaymentsCalendar($data);

            $sql =  'SELECT id ' .
                    'FROM ' . $AccidentPaymentsCalendar->tables[0] . ' ' .
                    'WHERE accidents_id IN(' . implode(', ', $data['id']) . ')';
            $toDelete['id'] = $db->getCol($sql);

            $AccidentPaymentsCalendar->delete($toDelete, false, false);

            //удаляем акты
            $sql =  'SELECT id ' .
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

            $sql =  'SELECT id ' .
                    'FROM ' . $AccidentPaymentsCalendar->tables[0] . ' ' .
                    'WHERE acts_id IN(' . implode(', ', $data['id']) . ')';
            $toDelete['id'] = $db->getCol($sql);

            $AccidentPaymentsCalendar->delete($toDelete, false, false);

            return parent::deleteProcess($data, $i, $folder);
        }
    }

    //обновляем данные по участникам
    function updateParticipants($data) {
        global $db;

        $sql = 'DELETE FROM ' . PREFIX . '_accidents_kasko_participants ' .
               'WHERE accidents_id = ' . intval($data['id']);
        $db->query($sql);

        if (is_array($data['participants'])) {
            foreach ($data['participants'] AS $row) {
                $sql =  'INSERT INTO ' . PREFIX . '_accidents_kasko_participants SET ' .
                    'accidents_id = ' . intval($data['id']) . ', ' .
                    'driver_lastname = ' . $db->quote($row['driver_lastname']) . ', ' .
                    'driver_firstname = ' . $db->quote($row['driver_firstname']) . ', ' .
                    'driver_patronymicname = ' . $db->quote($row['driver_patronymicname']) . ', ' .
                    'driver_address = ' . $db->quote($row['driver_address']) . ', ' .
                    'driver_phone = ' . $db->quote($row['driver_phone']) . ', ' .
                    'owner_lastname = ' . $db->quote($row['owner_lastname']) . ', ' .
                    'owner_firstname = ' . $db->quote($row['owner_firstname']) . ', ' .
                    'owner_patronymicname = ' . $db->quote($row['owner_patronymicname']) . ', ' .
                    'owner_address = ' . $db->quote($row['owner_address']) . ', ' .
                    'owner_phone = ' . $db->quote($row['owner_phone']) . ', ' .
                    'car_types_id = ' . $db->quote($row['car_types_id']) . ', ' .
                    'brands_id = ' . $db->quote($row['brands_id']) . ', ' .
                    'brand = ' . $db->quote($row['brand']) . ', ' .
                    'models_id = ' . $db->quote($row['models_id']) . ', ' .
                    'model = ' . $db->quote($row['model']) . ', ' .
                    'sign = ' . $db->quote($row['sign']) . ', ' .
                    'insurance_company = ' . $db->quote($row['insurance_company']) . ', ' .
                    'insurance_number = ' . $db->quote($row['insurance_number']) . ', ' .
                    'created = NOW()';
                $db->query($sql);
            }
        }
    }

    function getSearchInWindow($data) {
        global $db, $Authorization;

        if ($Authorization->data['roles_id'] == ROLES_MASTER) {
            $conditions[] = '(a.car_services_id IN(' . implode(', ', $Authorization->data['car_services']) . ') OR a.calculation_car_services_id = ' . intval($Authorization->data['car_services_id']) . ')';
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

            $sql =  'SELECT a.id, a.number, c.number AS policies_number, ' .
                    'date_format(c.date, ' . $db->quote(DATE_FORMAT) . ') AS policies_date_format, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_begin_datetime_format, date_format(c.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS policies_interrupt_datetime_format, ' .
                    'd.insurer_lastname, d.insurer_firstname, d.insurer_patronymicname, ' .
                    'CONCAT(e.brand, \'/\', e.model) as item, e.shassi, e.sign ' .
                    'FROM ' . PREFIX . '_accidents AS a  ' .
                    'JOIN ' . PREFIX . '_accidents_kasko AS b ON a.id = b.accidents_id  ' .
                    'JOIN ' . PREFIX . '_policies AS c ON a.policies_id = c.id ' .
                    'JOIN ' . PREFIX . '_policies_kasko AS d ON a.policies_id = d.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items AS e ON a.policies_id = e.policies_id AND b.items_id = e.id ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' ' .
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

    function prepareValues($fields, $values) {
        global $REGIONS;

        foreach ($fields as $field) {
            switch ($field) {
                case 'product_document_types_ids':
                    $values['product_document_types_ids'] = array_keys($values['product_document_types']);
                    break;
                case 'policies_insurer_address':
                    $region = Regions::getTitle($values['policies_insurer_regions_id']);
                    $street = $values['policies_insurer_street_types'] . ' ' . $values['policies_insurer_street'];
                    $values[ $field ] = $region . (strlen($values['policies_insurer_area']) ? ', ' . $values['policies_insurer_area'] . ' р-он' : '') . (strlen($values['policies_insurer_city']) ? ', ' . $values['policies_insurer_city'] : '') .
                        ', ' . $street . (strlen($values['policies_insurer_house']) ? ', буд. ' . $values['policies_insurer_house'] : '') . (strlen($values['policies_insurer_flat']) ? ', кв. ' . $values['policies_insurer_flat'] : '') . (strlen($values['policies_insurer_phone']) ? ', тел. ' . $values['policies_insurer_phone'] : '');
                    break;
                case 'applicant_address':
                    $region = Regions::getTitle($values['applicant_regions_id']);
                    $street = StreetTypes::getTitle($values['applicant_street_types_id']) . ' ' . $values['applicant_street'];
                    $values[ $field ] = $region . (strlen($values['applicant_area']) ? ', ' . $values['applicant_area'] . ' р-он' : '') . (strlen($values['applicant_city']) ? ', ' . $values['applicant_city'] : '') .
                        ', ' . $street . (strlen($values['applicant_house']) ? ', буд. ' . $values['applicant_house'] : '') . (strlen($values['applicant_flat']) ? ', кв. ' . $values['applicant_flat'] : '') . (strlen($values['applicant_phones']) ? ', тел. ' . $values['applicant_phones'] : '');
                    break;
                case 'applicant_regions_title':
                    $values[ $field ] = Regions::getTitle($values['applicant_regions_id']);
                    break;
                case 'applicant_city':
                    if (!in_array($values['applicant_regions_id'], $REGIONS)) {
                        $values[ $field ] = $values['applicant_city'];
                    }
                    break;
                case 'applicant_street':
                    $values[ 'applicant_street' ] =  StreetTypes::getTitle($values['applicant_street_types_id']) . ' ' . $values['applicant_street'];
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
                case 'mvs_average':
                    switch ($values['mvs_average']) {
                        case '0':
                            $values[ $field ] = 'Нi';
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

    //выплаты по предыдущим событиям по договору, с учетом возможных допов
    function getAmountPrevious($id, $mode=0) {
        global $db, $Authorization;
        
        $sql = 'SELECT datetime ' . 
               'FROM ' . PREFIX . '_accidents ' .
               'WHERE id = ' . intval($id);
        $accidents_datetime = $db->getOne($sql);
        
        $sql = 'SELECT b.number ' .
               'FROM ' . PREFIX . '_accidents AS a ' .
               'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
               'WHERE a.id = ' . intval($id);
        $number = $db->getOne($sql);

        $sql = 'SELECT shassi ' .
               'FROM ' . PREFIX . '_policies_kasko_items as kasko_items ' .
               'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON kasko_items.id = accidents_kasko.items_id ' .
               'WHERE accidents_kasko.accidents_id = ' . intval($id);
        $shassi = $db->getOne($sql);

        $sql = 'SELECT id ' .
               'FROM ' . PREFIX . '_policies_kasko_items ' .
               'WHERE shassi = ' . $db->quote($shassi);
        $items_id = $db->getCol($sql);

        //$conditions[] = 'a.top = ' . $db->quote($top);
        $conditions[] = 'a.number = ' . $db->quote($number);
        $conditions[] = 'b.id < ' . intval($id);
        $conditions[] = 'c.act_statuses_id IN(' . ACCIDENT_STATUSES_PAYMENT . ', ' . ACCIDENT_STATUSES_RESOLVED . ')';
        $conditions[] = (sizeof($items_id) > 0 ? 'e.items_id IN (' . implode(', ', $items_id) . ')' : 'e.items_id IN (0)');
        $conditions[] = 'd.not_proportionality <> 1';

        //$conditions[] = 'b1.id = ' . intval($id);
        $conditions[] = 'h.payment_date < ' . $db->quote($accidents_datetime);

        if ($mode == 0) {
            $sql = 'SELECT SUM(h.amount) ' .
                   'FROM ' . PREFIX . '_policies AS a ' .
                   'JOIN ' . PREFIX . '_accidents AS b ON a.id = b.policies_id ' .
                   'JOIN ' . PREFIX . '_accidents_acts AS c ON b.id = c.accidents_id ' .
                   'JOIN ' . PREFIX . '_accidents_kasko_acts AS d ON d.accidents_acts_id = c.id ' .
                   'JOIN ' . PREFIX . '_accidents_kasko as e ON b.id = e.accidents_id ' .
                   //'LEFT JOIN ' . PREFIX . '_accidents as b1 ON a.id = b1.policies_id ' .
                   'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as f ON e.items_id = f.items_id AND ' . $db->quote($accidents_datetime) . ' BETWEEN f.date AND ADDDATE(f.date, INTERVAL 1 YEAR) ' .
                   'JOIN ' . PREFIX . '_policies_kasko as g ON a.id = g.policies_id ' .
                   'JOIN ' . PREFIX . '_accident_payments_calendar as h ON c.id = h.acts_id ' .
                   'WHERE IF(f.items_id IS NULL, \'1\', b.datetime BETWEEN f.date AND ADDDATE(f.date, INTERVAL 1 YEAR)) AND ' . implode(' AND ', $conditions);
        } elseif ($mode == 1) {
            $conditions[] = 'b1.id = ' . intval($id);
            $sql = 'SELECT SUM(h.amount) ' .
                   'FROM ' . PREFIX . '_policies AS a ' .
                   'JOIN ' . PREFIX . '_accidents AS b ON a.id = b.policies_id ' .
                   'JOIN ' . PREFIX . '_accidents_acts AS c ON b.id = c.accidents_id ' .
                   'JOIN ' . PREFIX . '_accidents_kasko_acts AS d ON d.accidents_acts_id = c.id ' .
                   'JOIN ' . PREFIX . '_accidents_kasko as e ON b.id = e.accidents_id ' .
                   'LEFT JOIN ' . PREFIX . '_accidents as b1 ON a.id = b1.policies_id ' .
                   'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as f ON e.items_id = f.items_id AND b1.datetime BETWEEN f.date AND ADDDATE(f.date, INTERVAL 1 YEAR) ' .
                   'JOIN ' . PREFIX . '_policies_kasko as g ON a.id = g.policies_id ' .
                   'JOIN ' . PREFIX . '_accident_payments_calendar as h ON c.id = h.acts_id AND h.payment_date <> \'0000-00-00\' ' .
                   'WHERE IF(f.items_id IS NULL, \'1\', b.datetime BETWEEN f.date AND ADDDATE(f.date, INTERVAL 1 YEAR)) AND ' . implode(' AND ', $conditions);
        }

//      if($Authorization->data['id']==1){_dump($sql);exit;}
        return $db->getOne($sql);       
    }

    //получаем стоимость ремонта общую
    function getVRZPrevious($accidents_id, $id) {
        global $db;

        $sql =  'SELECT ROUND(b.amount_details * (1 - b.deterioration_value) + b.amount_material + b.amount_work, 2) AS amount_vrz ' .
                'FROM ' . PREFIX . '_accidents_acts as a ' .
                'JOIN ' . PREFIX . '_accidents_kasko_acts as b ON a.id = b.accidents_acts_id ' .
                'WHERE a.accidents_id = ' . intval($accidents_id) . ' AND a.id < ' . $db->quote($id) . ' ' .
                'ORDER BY a.id DESC ' .
                'LIMIT 1';
        return $db->getOne($sql);
    }


    function getValues($file) {
        global $db, $Authorization;

        $sql =  'SELECT a.*, a.number AS accident_documents_number, a.created AS accident_documents_created, ' .
                'b.*, b.number AS accidents_number, b.date AS accidents_date, b.datetime AS accidents_datetime, b.datetime_average AS accidents_datetime_average, b.assistance as accidents_assistance, b.assistance_date AS accidents_assistance_date, b.risks_id, b.documents AS accidents_documents, b.comment as comment, b.insurance as accidents_insurance, ' .
                'c.*, c.mvs as accidents_kasko_mvs, IF(c.amount_rough_type IN (0, 1), b.amount_rough, c.financial_institutions_amount_rough) as amount_rough, ' .
                'd.*,d1.*, d1.created as acts_created, d.amount_details + d.amount_material + d.amount_work AS amount_vr, ROUND(d.amount_details * (1 - d.deterioration_value) + d.amount_material + d.amount_work, 2) AS amount_vrz, d1.documents AS acts_documents, ' .
                'e.product_types_id, IF(e.product_types_id = ' . PRODUCT_TYPES_DRIVE_CERTIFICATE . ', v.number, e.number) AS policies_number, v.number as drive_general_policies_number, IF(e.product_types_id = ' . PRODUCT_TYPES_DRIVE_CERTIFICATE . ' > 0, v.date, y.date) AS policies_date, IF(e.product_types_id = ' . PRODUCT_TYPES_DRIVE_CERTIFICATE . ', v.begin_datetime, y.begin_datetime) AS begin_datetime, IF(e.product_types_id = ' . PRODUCT_TYPES_DRIVE_CERTIFICATE . ', v.interrupt_datetime, IF(e1.agreement_types_id <> 0, e.end_datetime, e.interrupt_datetime)) AS interrupt_datetime, IF(f.terms_years_id = 1, f1.car_price + f1.price_equipment, f2.item_price) AS policies_price, e.amount AS policy_amount, e.product_types_id as policies_product_types_id, ' .
                'IF(e.product_types_id = ' . PRODUCT_TYPES_DRIVE_CERTIFICATE . ', SUBSTRING(e.number, LOCATE(\'-\', e.number) + 1), NULL) AS certificates_number, ' .
                'IF(e.product_types_id = ' . PRODUCT_TYPES_DRIVE_CERTIFICATE . ', e.begin_datetime, NULL) AS certificates_begin_datetime, ' .
                'IF(e.product_types_id = ' . PRODUCT_TYPES_DRIVE_CERTIFICATE . ', e.interrupt_datetime, NULL) AS certificates_interrupt_datetime, ' .
                'f.insurer_person_types_id AS policies_insurer_person_types_id, f.insurer_lastname AS policies_insurer_lastname, f.insurer_firstname AS policies_insurer_firstname, f.insurer_patronymicname AS policies_insurer_patronymicname, f.insurer_identification_code AS policies_insurer_identification_code, f.insurer_company AS policies_insurer_company, f.insurer_edrpou AS policies_insurer_edrpou, ' .
                'f.insurer_regions_id as policies_insurer_regions_id, f.insurer_city AS policies_insurer_city, f.insurer_area as policies_insurer_area, x.title as policies_insurer_street_types, f.insurer_street AS policies_insurer_street, f.insurer_house AS policies_insurer_house, f.insurer_flat AS policies_insurer_flat, f.insurer_phone AS policies_insurer_phone, ' .
                'f.owner_person_types_id AS policies_owner_person_types_id, f.owner_lastname AS policies_owner_lastname, f.owner_firstname AS policies_owner_firstname, f.owner_patronymicname AS policies_owner_patronymicname, f.owner_identification_code AS policies_owner_identification_code, f.owner_company AS policies_owner_company, f.owner_edrpou AS policies_owner_edrpou, ' .
                'f.financial_institutions_id as financial_institutions_id, f.assured_title AS policies_assured_title, f.assured_address AS policies_assured_address, f.assured_identification_code AS policies_assured_identification_code, ' .
                'f1.brand AS policies_brand, f1.model AS policies_model, f1.sign AS policies_sign, f1.shassi AS policies_shassi, f1.year AS policies_year, f1.car_price + f1.price_equipment AS items_price, ' .
                'f.options_deterioration_no AS policies_options_deterioration_no, f.options_agregate_no AS policies_options_agregate_no, f.options_deductible_glass_no as policies_options_deductible_glass_no, ' .
                'f1.deductibles_value0 AS policies_deductibles_value0, f1.deductibles_absolute0 AS policies_deductibles_absolute0, f1.deductibles_value1 AS policies_deductibles_value1, f1.deductibles_absolute1 AS policies_deductibles_absolute1, ' .
                'h.title AS risks_title, h2.title as application_risks_title, ' .
                'j.lastname AS masters_lastname, j.firstname AS masters_firstname, j.patronymicname AS masters_patronymicname, ' .
                'k.address AS mvs_address,' .
                'l.amount AS payments_calendar_amount,l.payment_types_id as payments_calendar_payment_types_id, l.basis AS payments_calendar_basis, l.number as payments_calendar_number, l.recipient AS payments_calendar_recipient, l.recipient_identification_code AS payments_calendar_recipient_identification_code, l.payment_bank_account AS payments_calendar_payment_bank_account, l.payment_bank AS payments_calendar_payment_bank, l.payment_bank_mfo AS payments_calendar_payment_bank_mfo, l.payment_bank_card_number AS payments_calendar_payment_bank_card_number, l.created as payments_calendar_created, ' .
                'm.title AS car_services_title, ' .
                'IF(a.acts_id <> 0, w.lastname, n.lastname) AS average_managers_lastname, IF(a.acts_id <> 0, w.firstname, n.firstname) AS average_managers_firstname, IF(a.acts_id <> 0, w.patronymicname, n.patronymicname) AS average_managers_patronymicname, ' .
                'w.lastname as authors_lastname, w.firstname as authors_firstname, w.email as authors_email, ' .
                'o.lastname AS expert_managers_lastname, o.firstname AS expert_managers_firstname, o.patronymicname AS expert_managers_patronymicname, ' .
                'p.title as sections_title, ' .
                'r.accounts_title AS accident_status_changes_accounts_title, MIN(r.created) as accident_status_changes_application_created, ' .
                'a.accidents_id, SUM(s.amount) AS policy_payments_amount, e.top as policies_top, ' .
                'd1.insurance AS acts_insurance ,d1.number AS acts_number, IF(a.acts_id = 0, a.modified, d1.date) as date, c.items_id as accidents_items_id, d1.created ' .
                'FROM ' . PREFIX . '_accident_documents AS a ' .
                'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
                'JOIN ' . PREFIX . '_accidents_kasko AS c ON b.id = c.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_acts AS d1 ON a.acts_id = d1.id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_kasko_acts AS d ON a.acts_id = d.accidents_acts_id ' .
                'JOIN ' . PREFIX . '_policies AS e ON b.policies_id = e.id ' .
                'LEFT JOIN ' . PREFIX . '_policies AS e1 ON e.child_id = e1.id ' .
                'JOIN ' . PREFIX . '_policies_kasko AS f ON b.policies_id = f.policies_id ' .
                'JOIN ' . PREFIX . '_policies_kasko_items AS f1 ON c.items_id = f1.id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments AS f2 ON c.items_id = f2.items_id AND b.datetime BETWEEN f2.date AND ADDDATE(f2.date, INTERVAL 1 YEAR) ' .
                'LEFT JOIN ' . PREFIX . '_parameters_risks AS h ON b.risks_id = h.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_risks AS h2 ON b.application_risks_id = h2.id ' .
                'JOIN ' . PREFIX . '_accounts AS j ON b.masters_id = j.id ' .
                'LEFT JOIN ' . PREFIX . '_mvs AS k ON c.mvs_id_average = k.id ' .
                'LEFT JOIN ' . PREFIX . '_accident_payments_calendar AS l ON a.payments_calendar_id = l.id ' .
                'JOIN ' . PREFIX . '_car_services AS m ON b.car_services_id = m.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS n ON b.average_managers_id = n.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS o ON b.estimate_managers_id = o.id ' .
                'LEFT JOIN ' . PREFIX . '_accident_sections as p ON p.id = b.accident_sections_id ' .
                'LEFT JOIN ' . PREFIX . '_accident_status_changes as r ON b.id = r.accidents_id ' .
                'LEFT JOIN (SELECT SUM(amount) as amount,policies_id FROM ' . PREFIX . '_policy_payments GROUP BY policies_id) AS s ON e.id = s.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_policies_drive as t ON b.policies_id = t.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_policies as u ON t.policies_general_id = u.id ' .
                'LEFT JOIN ' . PREFIX . '_policies as v ON u.top = v.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts as w ON a.authors_id = w.id ' .
                'LEFT JOIN ' . PREFIX . '_street_types as x ON f.insurer_street_types_id = x.id ' .
                'LEFT JOIN (SELECT number, MIN(begin_datetime) as begin_datetime, MIN(date) as date  FROM ' . PREFIX . '_policies GROUP BY number) as y ON e.number = y.number ' .
                'WHERE a.id = ' . intval($file['id']) . ' ' .
                'GROUP BY s.policies_id';    
//_dump($sql);exit;
        $row = $db->getRow($sql);

        $params = unserialize($row['params']);
        foreach ($params as $key => $val) {
            $row[$key] = $val;
        }

        $row['deductibles_percent'] = ($row['risks_id'] == RISKS_HIJACKING1) ? $row['policies_deductibles_value1'] : $row['policies_deductibles_value0'];

        if ($row['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_COMPROMISE_AGREEMENT_LETTER_KASKO) {
            /*$sql = 'SELECT calendar.id as calendars_id, policies.id as policies_id, calendar.date as begin, getEndInsurancePeriod(policies.id, calendar.date, 1) as end, SUM(calendar.amount) as calendars_amount ' .
                   'FROM insurance_policies as policies ' . 
                   'JOIN insurance_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' . 
                   'WHERE calendar.date <= policies.interrupt_datetime AND policies.number = ' . $db->quote($row['policies_number']) . ' AND policies.payment_statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' AND calendar.statuses_id > ' . PAYMENT_STATUSES_PARTIAL . ' ' .
                   'GROUP BY getEndInsurancePeriod(policies.id, calendar.date, 1)';
            $calendars = $db->getAll($sql);         
            
            $sql = 'SELECT policies.id as policies_id, SUM(payments.amount) as payments_amount ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_policy_payments as payments ON policies.id = payments.policies_id ' .
                   'WHERE policies.number = ' . $db->quote($row['policies_number']);
            $payments = $db->getAll($sql);*/
            
            $sql = 'SELECT item_years_payments.policies_id, item_years_payments.date as begin ' .
                         'FROM ' . PREFIX . '_policies_kasko_item_years_payments as item_years_payments ' .
                         'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON item_years_payments.items_id = kasko_items.id ' .
                         'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items2 ON kasko_items.shassi = kasko_items2.shassi ' .
                         'JOIN ' . PREFIX . '_policies as policies ON kasko_items2.policies_id = policies.id ' .
                         'WHERE policies.number = ' . $db->quote($row['policies_number']) . ' AND item_years_payments.items_id = ' . intval($row['accidents_items_id']) . ' AND item_years_payments.date < policies.interrupt_datetime';
            $calendars = $db->getAll($sql);
            
            if (is_array($calendars) && sizeof($calendars)) {           
                for ($i=0; $i<sizeof($calendars); $i++) {
                    if ($i == sizeof($calendars) - 1) {
                        $calendars[$i]['end'] = $row['interrupt_datetime'];
                    } else {
                        $calendars[$i]['end'] = date('Y-m-d', strtotime('-1 day', strtotime($calendars[$i+1]['begin'])));
                    }
                }
                
                foreach ($calendars as $calendar) {
                    if (strtotime($row['accidents_date']) >= strtotime($calendar['begin']) && strtotime($row['accidents_date']) <= strtotime($calendar['end'])) {
                        $sql = 'SELECT MIN(calendar.date) as min, MAX(calendar.date) as max, SUM(calendar.amount) as amount ' .
                               'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
                               'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
                               'WHERE policies.number = ' . $db->quote($row['policies_number']) . ' AND calendar.date < policies.interrupt_datetime AND calendar.date BETWEEN ' . $db->quote($calendar['begin']) . ' AND ' . $db->quote($calendar['end']);
                        $temp_info = $db->getRow($sql);

                        $sql = 'SELECT SUM(payments.amount) ' .
                               'FROM ' . PREFIX . '_policies as policies ' .
                               'JOIN ' . PREFIX . '_policy_payments as payments ON policies.id = payments.policies_id ' .
                               'WHERE policies.number = ' . $db->quote($row['policies_number']);
                        $total_payed = $db->getOne($sql);
                        
                        $sql = 'SELECT SUM(calendar.amount) as amount ' .
                               'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
                               'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
                               'WHERE policies.number = ' . $db->quote($row['policies_number']) . ' AND calendar.date < policies.interrupt_datetime AND calendar.date < ' . $db->quote($temp_info['min']);
                        $prev_amount = $db->getOne($sql);
                        
                        $sql = 'SELECT COUNT(calendar.id) as count ' .
                               'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
                               'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
                               'WHERE policies.number = ' . $db->quote($row['policies_number']) . ' AND calendar.date < policies.interrupt_datetime AND calendar.date > ' . $db->quote($temp_info['max']);
                        $next_count = $db->getOne($sql);
                        
                        if (intval($next_count) && $total_payed > $temp_info['amount']) {
                            $row['policies_payments_amount'] = $temp_info['amount'];
                        } else {
                            $row['policies_payments_amount'] = $total_payed - $prev_amount;
                        }

                        //$row['policies_payments_amount'] = $db->getOne($sql);
                        $current_period_begin = $calendar['begin'];
                    }
                }
                
                $sql = 'SELECT begin_insurance_period_date ' .
                       'FROM ' . PREFIX . '_report_payments_details ' .
                       'WHERE date_format(' . $db->quote($row['accidents_datetime']) . ', \'%Y-%m-%d\') BETWEEN begin_insurance_period_date AND end_insurance_period_date AND policies_number = ' . $db->quote($row['policies_number']);
                $current_period_begin = $db->getOne($sql);
            
                $sql = 'SELECT end_insurance_period_date ' .
                       'FROM ' . PREFIX . '_report_payments_details ' .
                       'WHERE date_format(' . $db->quote($row['accidents_datetime']) . ', \'%Y-%m-%d\') BETWEEN begin_insurance_period_date AND end_insurance_period_date AND policies_number = ' . $db->quote($row['policies_number']);
                $current_period_end = $db->getOne($sql);
                
                /*$row['policies_payments_amount_previous_years'] = 0;
                $current_period_begin = 'NULL';
                foreach ($calendars as $calendar) {
                    if (strtotime($row['accidents_date']) >= strtotime($calendar['begin']) && strtotime($row['accidents_date']) <= strtotime($calendar['end'])) {
                        $row['policies_payments_amount'] = $calendar['calendars_amount'];
                        $current_period_begin = $calendar['begin'];                 
                        break;
                    } else {
                        $row['policies_payments_amount_previous_years'] += $calendar['calendars_amount'];                   
                    }
                }*/
            } else {            
                $sql = 'SELECT SUM(payments.amount) ' .
                       'FROM ' . PREFIX . '_policies as policies ' .
                       'JOIN ' . PREFIX . '_policy_payments as payments ON policies.id = payments.policies_id ' .
                       'WHERE policies.number = ' . $db->quote($row['policies_number']) . ' AND date_format(' . $db->quote($row['accidents_datetime']) . ', \'%Y-%m-%d\') BETWEEN policies.begin_datetime AND policies.end_datetime';
                $row['policies_payments_amount'] = $db->getOne($sql);
                
                $sql = 'SELECT begin_datetime ' .
                       'FROM ' . PREFIX . '_policies ' .
                       'WHERE number = ' . $db->quote($row['policies_number']) . ' AND date_format(' . $db->quote($row['accidents_datetime']) . ', \'%Y-%m-%d\') BETWEEN begin_datetime AND end_datetime ' .
                       'ORDER BY date ASC ' . 
                       'LIMIT 1';
                $current_period_begin = $db->getOne($sql);
                
                $sql = 'SELECT end_datetime ' .
                       'FROM ' . PREFIX . '_policies ' .
                       'WHERE number = ' . $db->quote($row['policies_number']) . ' AND date_format(' . $db->quote($row['accidents_datetime']) . ', \'%Y-%m-%d\') BETWEEN begin_datetime AND end_datetime ' .
                       'ORDER BY date ASC ' . 
                       'LIMIT 1';
                $current_period_end = $db->getOne($sql);
            }       
            
            
            /*$sql = 'SELECT SUM(calendar.amount) ' .
                   'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
                   'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
                   'WHERE calendar.date BETWEEN ' . $db->quote($current_period_begin) . ' AND ' . $db->quote($current_period_end) . ' AND policies.number = ' . $db->quote($row['policies_number']);
            $row['policies_payments_amount'] = $db->getOne($sql);*/
            
            $sql = 'SELECT GROUP_CONCAT(DISTINCT accidents.number SEPARATOR \', \') as accidents_list, SUM(getCompensation(accidents.id, 3)) as payments_amount ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_accidents as accidents ON policies.id = accidents.policies_id ' .
                   'WHERE policies.number = ' . $db->quote($row['policies_number']) . ' AND accidents.datetime > ' . $db->quote($current_period_begin) . ' AND accidents.number <> ' . $db->quote($row['accidents_number']);// . ' AND kasko_acts.not_proportionality = 0';
            $row['policies_previous_accidents'] = $db->getRow($sql);
            
            $sql = 'SELECT GROUP_CONCAT(DISTINCT CONCAT(policies.number, \' (\', date_format(policies.date, \'%d.%m.%Y\'),\')\') SEPARATOR \', \') as policies_list, SUM(payments.policy_payments_amount) as payments_amount ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON policies.id = kasko_items.policies_id ' .
                   'JOIN ' . PREFIX . '_report_payments_details as payments ON policies.number = payments.policies_number ' .
                   'WHERE kasko_items.shassi = ' . $db->quote($row['policies_shassi']) . ' AND payments.begin_insurance_period_date < ' . $db->quote($current_period_begin);
            $row['previous_policies_item'] = $db->getRow($sql);
            
            $sql = 'SELECT GROUP_CONCAT(DISTINCT accidents.number SEPARATOR \', \') as accidents_list, SUM(getCompensation(accidents.id, 3)) as payments_amount ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON policies.id = kasko_items.policies_id ' .
                   'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON kasko_items.id = accidents_kasko.items_id ' .
                   'JOIN ' . PREFIX . '_accidents as accidents ON accidents_kasko.accidents_id = accidents.id ' .
                   'WHERE kasko_items.shassi = ' . $db->quote($row['policies_shassi']) . ' AND accidents.datetime < ' . $db->quote($current_period_begin);
            $row['previous_policies_item_accidents'] = $db->getRow($sql);
            
            $sql = 'SELECT GROUP_CONCAT(DISTINCT CONCAT(policies.number, \' (\', date_format(policies.date, \'%d.%m.%Y\'), \')\') SEPARATOR \', \') as policies_list, SUM(payments.policy_payments_amount) as payments_amount ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
                   'JOIN ' . PREFIX . '_report_payments_details as payments ON policies.number = payments.policies_number AND policies.date = payments.policies_date ' .
                   'WHERE ' . (($row['policies_insurer_person_types_id'] == 1) ? 'policies_kasko.insurer_identification_code = ' . $db->quote($row['policies_insurer_identification_code']) : '') . (($row['policies_insurer_person_types_id'] == 2) ? 'policies_kasko.insurer_edrpou = ' . $row['policies_insurer_edrpou'] : '') . ' AND payments.begin_insurance_period_date < ' . $db->quote($current_period_begin);
            $row['all_policies_insurer'] = $db->getRow($sql);
            //_dump($sql);exit;
            $sql = 'SELECT GROUP_CONCAT(DISTINCT accidents.number SEPARATOR \', \') as accidents_list, SUM(getCompensation(accidents.id, 3)) as payments_amount ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
                   'JOIN ' . PREFIX . '_accidents as accidents ON policies.id = accidents.policies_id ' .
                   //'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id ' .
                   //'LEFT JOIN ' . PREFIX . '_accidents_kasko_acts as kasko_acts ON accidents_acts.id = kasko_acts.accidents_acts_id ' .
                   //'WHERE ' . (($row['policies_insurer_person_types_id'] == 1) ? 'policies_kasko.insurer_identification_code = ' . $row['policies_insurer_identification_code'] : '') . (($row['policies_insurer_person_types_id'] == 2) ? 'policies_kasko.insurer_edrpou = ' . $row['policies_insurer_edrpou'] : '') . ' AND policies.number <> ' . $db->quote($row['policies_number']) . ' AND kasko_acts.not_proportionality = 0 ' .
                   'WHERE ' . (($row['policies_insurer_person_types_id'] == 1) ? 'policies_kasko.insurer_identification_code = ' . $db->quote($row['policies_insurer_identification_code']) : '') . (($row['policies_insurer_person_types_id'] == 2) ? 'policies_kasko.insurer_edrpou = ' . $row['policies_insurer_edrpou'] : '') . ' AND accidents.datetime < ' . $db->quote($current_period_begin);// . ' AND kasko_acts.not_proportionality = 0';
            $row['all_policies_insurer_accidents'] = $db->getRow($sql);
            
            $sql = 'SELECT accidents.compromise_date, GROUP_CONCAT(compromise_violation.title SEPARATOR \', \') as compromise_violation_list ' .
                   'FROM ' . PREFIX . '_accidents as accidents ' .
                   'JOIN ' . PREFIX . '_accidents_compromise_violation as compromise_violation ON compromise_violation.value&accidents.compromise_violation <> 0 ' .
                   'WHERE accidents.id = ' . intval($row['accidents_id']);
            $row['compromise_info'] = $db->getRow($sql);
            
            if ($row['policies_deductibles_absolute0'] == 1) {
                $row['compromise_deductibles'] = $row['policies_deductibles_absolute0'];                
            } else {
                $row['compromise_deductibles'] = roundNumber($row['policies_deductibles_value0'] * $row['policies_price'] / 100, 2);
            }
            
            $row['amount_previous_accidents'] = $this->getAmountPrevious($row['accidents_id']);
        }

        if (intval($row['acts_id'])) {

            $row['amount_sz'] = round($row['amount_details'] * (1 - $row['deterioration_value']), 2);
            $row['amount_vrz_previous'] = $this->getVRZPrevious($row['accidents_id'], $row['acts_id']);

            if ($row['product_document_types_id'] == DOCUMENT_TYPES_ACCIDENT_INSURANCE_ACT) {

                //сумма выплаченных возмещений по договору
                $row['amount_previous_accidents'] = $this->getAmountPrevious($row['accidents_id']);

                //сумма выплаченных возмещений по акту
                $AccidentActs = AccidentActs::factory($row, 'KASKO');
                $row['amount_previous_acts'] = $AccidentActs->getAmountPrevious($row['accidents_id'], $row['acts_id']);

                $price = ($row['insurance_price'] < $row['market_price']) ? $row['insurance_price'] : $row['market_price'];
//$price = $row['market_price'];

                //if ($row['extent_damage_percent'] <= $row['amount_vrz'] / $price * 100) {//тотал
                if ($row['extent_damage_percent'] <= ($row['amount_vrz'] * $row['proportionality_value'] - $row['amount_previous_accidents']) / $price * 100) {//тотал
                    $deductible = '1';
                } else {//не тотал
                    $deductible = ($row['risks_id'] == RISKS_HIJACKING1) ? '1' : '0';
                }

                if($row['deductibles_change'] == 1) {
                    $row['deductibles_value'] = round(floatval($row['deductibles_amount'])/floatval($row['insurance_price'])*100, 2) . '%';
                }
                else {
                    $row['deductibles_value'] = ($row['policies_deductibles_absolute' . $deductible] == '0')
                        ? $row['policies_deductibles_value' . $deductible] . '%'
                        : getMoneyFormat($row['policies_deductibles_value' . $deductible]);
                }
                if($row['insurance'] != 1) {
                    $row['deductibles_value'] = ($row['policies_deductibles_absolute' . $deductible] == '0')
                    ? $row['deductibles_percent'] . '%'
                    : getMoneyFormat($row['deductibles_percent']);
                }

                if($row['options_deductible_glass_no'] == 1 && $row['policies_options_deductible_glass_no'] == 1){
                    $row['deductibles_value'] = '0.00%';
                }
            }

            //грузим календарь платежей
            $sql =  'SELECT * ' .
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
        } else {

            $row['rough_part'] = round(($row['amount_rough']/$row['items_price']) * 100, 2); //для запиту в Банк

            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_accidents_kasko_participants ' .
                    'WHERE accidents_id = ' . intval($row['accidents_id']);
            $row['participants'] = $db->getAll($sql);

            //предыдушие дела по машине, без привязки к договору
            $sql =  'SELECT b.number ' .
                    'FROM ' . PREFIX . '_policies_kasko_items AS a ' .
                    'JOIN ' . PREFIX . '_accidents AS b ON a.policies_id = b.policies_id ' .
                    'JOIN ' . PREFIX . '_accidents_kasko AS c ON b.id = c.accidents_id AND a.id = c.items_id ' .
                    'WHERE a.shassi = ' . $db->quote($row['policies_shassi']) . ' AND b.id < ' . intval($row['accidents_id']);
            $row['accidents'] = $db->getAll($sql);

            $sql =  'SELECT b.id, b.title ' .
                    'FROM ' . PREFIX . '_accident_document_type_assignments AS a ' .
                    'JOIN ' . PREFIX . '_product_document_types AS b ON a.product_document_types_id = b.id ' .
                    'WHERE a.accidents_id = ' . intval($row['accidents_id']) . ' ' .
                    'ORDER BY b.title';
            $row['product_document_types'] = $db->getAssoc($sql);

            //для отдельного вывода Дополнительных документов в шаблон Титулки
            $row['additional_documents'] = explode($this->documentsDelimiter, $row['accidents_documents']);
            //_dump($row['documents']);exit;
            //merge масива основных док. и дополнительных для вывода в "заяву"
            foreach($row['product_document_types'] as $product_document){
                $row['documents'][] = $product_document;
            }
            $row['documents'] = ($row['accidents_documents']) ? array_merge($row['documents'], explode($this->documentsDelimiter, $row['accidents_documents'])) : $row['documents'];
        }

        $row['payment_document_number'] = htmlspecialchars_decode($row['payment_document_number']);

        $fields = array(
            'applicant_regions_title',
            'policies_insurer_address',
            'applicant_address',
            'applicant_city',
            'applicant_street',
            'mvs',
            'mvs_average',
            'product_document_types_ids');
            
        if (strtotime($row['date']) >= strtotime('2013-07-04')) {
            $row['new_director'] = 1;
        }
        
        if (strtotime(date('Y-m-d')) >= strtotime('2015-08-17') && strtotime(date('Y-m-d')) <= strtotime('2015-08-23')) {
            $row['director'] = 1;
        }

        return $this->prepareValues($fields, $row);
    }

    //реквизиты владельца, используется при создании/редактировании страхового акта
    function getEssentialOwnerInWindow($data) {
        global $db;

        $sql =  'SELECT b.* ' .
                'FROM ' . PREFIX . '_accidents AS a ' .
                'JOIN ' . PREFIX . '_policies_kasko AS b ON a.policies_id = b.policies_id ' .
                'WHERE a.id = ' . intval($data['id']);
        $row =  $db->getRow($sql, 60 * 60);

        switch ($row['owner_person_types_id']) {
            case 1://физ. лицо
                echo '{"recipient_types_id":"' . RECIPIENT_TYPES_OWNER . '","recipient":"' . addslashes(html_entity_decode($row['owner_lastname']  . ' ' . $row['owner_firstname'] . ' ' . $row['owner_patronymicname'])) . '","recipient_identification_code":"' . $row['owner_identification_code'] . '","bank":"","bank_edrpou":"","bank_mfo":"","bank_account":""}';
                break;
            case 2://юр. лицо
                echo '{"recipient_types_id":"' . RECIPIENT_TYPES_OWNER . '","recipient":"' . addslashes(html_entity_decode($row['owner_company'])) . '","recipient_identification_code":"' . $row['owner_edrpou'] . '","bank":"' . addslashes(html_entity_decode($row['owner_bank'])) . '","bank_edrpou":"","bank_mfo":"' . $row['owner_bank_mfo'] . '","bank_account":"' . $row['owner_bank_account'] . '"}';
                break;
        }
        exit;
    }

    //реквизиты выгодоприобритателя, используется при создании/редактировании страхового акта
    function getEssentialAssuredInWindow($data) {
        global $db;

        $sql =  'SELECT b.*, c.mfo AS bank_mfo, c.edrpou AS bank_edrpou, c.title AS bank_title ' .
                'FROM ' . PREFIX . '_accidents AS a ' .
                'JOIN ' . PREFIX . '_policies_kasko AS b ON a.policies_id = b.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_financial_institutions AS c ON b.financial_institutions_id = c.id ' .
                'WHERE a.id = ' . intval($data['id']);
        $row =  $db->getRow($sql, 60 * 60);

        switch (intval($row['insurer_person_types_id'])) {
            case 1://физ. лицо
                echo '{"recipient_types_id":"' . RECIPIENT_TYPES_ASSURED . '","recipients_id":"' . intval($row['financial_institutions_id']) . '","recipient":"' . addslashes(html_entity_decode($row['insurer_lastname'] . ' ' . $row['insurer_firstname'] . ' ' . $row['insurer_patronymicname'])) . '","recipient_identification_code":"' . $row['insurer_identification_code'] . '","bank":"' . addslashes(html_entity_decode($row['bank_title'])) . '","bank_edrpou":"' . $row['bank_edrpou'] . '","bank_mfo":"' . $row['bank_mfo'] . '","bank_account":""}';
                break;
            case 2://юр. лицо
                echo '{"recipient_types_id":"' . RECIPIENT_TYPES_ASSURED . '","recipients_id":"' . intval($row['financial_institutions_id']) . '","recipient":"' . addslashes(html_entity_decode($row['insurer_company'])) . '","recipient_identification_code":"' . $row['insurer_edrpou'] . '","bank":"' . addslashes(html_entity_decode($row['bank_title'])) . '","bank_edrpou":"' . $row['bank_edrpou'] . '","bank_mfo":"' . $row['bank_mfo'] . '","bank_account":""}';
                break;
        }

        exit;
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

        $sql =  'SELECT b.*, b.documents AS accidents_documents, c.*, b.number AS number, e.product_types_id, ' .
                'c.*, b.number AS number, e.product_types_id, ' .
                'IF(pd1.product_types_id=10 AND pd1.sub_number>0,CONCAT(pd1.number,\'_\',pd1.sub_number), e.number) AS policies_number, e.date AS policies_date, e.begin_datetime AS begin_datetime, e.end_datetime AS end_datetime,e.amount AS policy_amount, e.price AS policy_price,e.rate AS policy_rate,' .
                'f.insurer_person_types_id AS policies_insurer_person_types_id, f.insurer_lastname AS policies_insurer_lastname, f.insurer_firstname AS policies_insurer_firstname, f.insurer_patronymicname AS policies_insurer_patronymicname, f.insurer_identification_code AS policies_insurer_identification_code, f.insurer_company AS policies_insurer_company, f.insurer_edrpou AS policies_insurer_edrpou, ' .
                'f.insurer_city AS policies_insurer_city, f.insurer_street AS policies_insurer_street, f.insurer_house AS policies_insurer_house, f.insurer_flat AS policies_insurer_flat, f.insurer_phone AS policies_insurer_phone, ' .
                'f.owner_person_types_id AS policies_owner_person_types_id, f.owner_lastname AS policies_owner_lastname, f.owner_firstname AS policies_owner_firstname, f.owner_patronymicname AS policies_owner_patronymicname, f.owner_identification_code AS policies_owner_identification_code, f.owner_company AS policies_owner_company, f.owner_edrpou AS policies_owner_edrpou, ' .
                'f.assured_title AS policies_assured_title, f.assured_address AS policies_assured_address, f.assured_identification_code AS policies_assured_identification_code, ' .
                'f1.brand AS policies_brand, f1.model AS policies_model,f1.year as policies_year, f1.sign AS policies_sign, f1.shassi AS policies_shassi, f1.car_price AS items_price, ' .
                'f1.deductibles_value0, f1.deductibles_absolute0, f1.deductibles_value1, f1.deductibles_absolute1, ' .
                'h.title AS risks_title, ' .
                'j.lastname AS masters_lastname, j.firstname AS masters_firstname, j.patronymicname AS masters_patronymicname, ' .
                'k.address AS mvs_address, ' .
                'm.title AS car_services_title, ' .
                'n.lastname AS average_managers_lastname, n.firstname AS average_managers_firstname, n.patronymicname AS average_managers_patronymicname, ' .
                'o.lastname AS expert_managers_lastname, o.firstname AS expert_managers_firstname, o.patronymicname AS expert_managers_patronymicname, ' .
                'b.date AS accidents_date, b.created AS accidents_date, b.datetime as accidents_datetime,b.datetime as application_date ' .
                'FROM  ' . PREFIX . '_accidents AS b   ' .
                'JOIN ' . PREFIX . '_accidents_kasko AS c ON b.id = c.accidents_id ' .
                'JOIN ' . PREFIX . '_policies AS e ON b.policies_id = e.id ' .
                'JOIN ' . PREFIX . '_policies_kasko AS f ON f.policies_id = e.id ' .
                'JOIN ' . PREFIX . '_policies_kasko_items AS f1 ON c.items_id = f1.id ' .
                'LEFT JOIN ' . PREFIX . '_parameters_risks AS h ON b.risks_id = h.id ' .
                'JOIN ' . PREFIX . '_accounts AS j ON b.masters_id = j.id ' .
                'LEFT JOIN ' . PREFIX . '_mvs AS k ON c.mvs_id = k.id ' .
                'JOIN ' . PREFIX . '_car_services AS m ON b.car_services_id = m.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS n ON b.average_managers_id = n.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS o ON b.estimate_managers_id = o.id ' .
                'LEFT JOIN ' . PREFIX . '_policies_drive pd ON pd.policies_id=b.policies_id '.
                'LEFT JOIN ' . PREFIX . '_policies pd1 ON pd.policies_general_id=pd1.id '.
                'WHERE ' . implode(' AND ', $conditions) . ' ' ;
//_dump($sql);exit;
        $list = $db->getAll($sql);

        $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/kasko.xml');
    }

    function getRisksInWindow($data){
        global $db;

        $conditions[] = 'policies_id = ' . intval($data['policies_id']);

        $sql =  'SELECT b.id, b.title, a.risks_id ' .
                'FROM ' . PREFIX . '_policy_risks AS a ' .
                'RIGHT JOIN ' . PREFIX . '_parameters_risks AS b ON a.risks_id = b.id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        $result = "";

        if (is_array($list) && sizeof($list)) {
            $result .= '<table cellpadding="0" cellspacing="3">';
            foreach ($list as $row) {
                $result .= '<tr><td align="right">' . $row['title'] . '</td><td><input type="radio" name="risks_id" value="' . $row['id'] . '" ' . (($data['risks_id'] == $row['id']) ? 'checked' : '') . ' onclick="setInsurance()" ' . $this->getReadonly(false) . ' /> ' . (($row['id'] == $row['risks_id']) ? 'так' : 'ні') . '<input type="hidden" id="risks_id' . $row['id'] . '" value="' . (($row['id'] == $row['risks_id']) ? 1 : 0) . '" /></td></tr>';
            }
            $result .= '</tr></table>';
        } else {
            $result .= '<div id="log"><div class="error">Жодного ризику не застраховано!</div></div>';
        }

        echo $result;
    }

    function getOptionsInWindow($data){
        global $db;

        $conditions[] = 'policies_id = ' . intval($data['policies_id']);

        $sql = 'SELECT options_deductible_glass_no, options_deterioration_no, options_agregate_no, options_fifty_fifty ' .
               'FROM ' . PREFIX . '_policies_kasko ' .
               'WHERE ' . implode(' AND ', $conditions);
        $row = $db->getRow($sql);

        $result = '';

        $result .= '<table width="100%" cellpadding="0" cellspacing="3">';
        $result .= '<tr>';
        $result .= '<td class="label grey">без франшизи на вітрові стекла:</td>';
        $result .= '<td style="width: 20px;"><input type="checkbox" name="options_deductible_glass_no" value="1" ' . ($row['options_deductible_glass_no']) ? 'checked' : '' . ' ' . $this->getReadonly(true, ($row['policies_options_deductible_glass_no']) ? false : true) . ' onclick="setInsurance()" /></td>';
        $result .= '<td style="width: 20px;">';
        $result .= ($row['policies_options_deductible_glass_no']) ? 'так' : 'ні';
        $result .= '<input type="hidden" name="policies_options_deductible_glass_no" value="' . $row['options_deductible_glass_no'] . '" />';
        $result .= '</td>';
        $result .= '</tr>';
        $result .= '<tr>';
        $result .= '<td class="label grey">без врахування зносу:</td>';
        $result .= '<td style="width: 20px;"><input type="checkbox" name="options_deterioration_no" value="1" ' . ($row['options_deterioration_no']) ? 'checked' : '' . ' ' . $this->getReadonly(true, ($row['policies_options_deterioration_no']) ? false : true) . ' onclick="setInsurance()" /></td>';
        $result .= '<td style="width: 20px;">';
        $result .= ($row['policies_options_deterioration_no']) ? 'так' : 'ні';
        $result .= '<input type="hidden" name="policies_options_deterioration_no" value="' . $row['options_deductible_glass_no'] . '" />';
        $result .= '</td>';
        $result .= '</tr>';
        $result .= '<tr>';
        $result .= '<td class="label grey">неагрегатна страхова сума:</td>';
        $result .= '<td style="width: 20px;"><input type="checkbox" name="options_agregate_no" value="1" ' . ($row['options_agregate_no']) ? 'checked' : '' . ' ' . $this->getReadonly(true, ($row['policies_options_agregate_no']) ? false : true) . ' onclick="setInsurance()" /></td>';
        $result .= '<td style="width: 20px;">';
        $result .= ($row['policies_options_agregate_no']) ? 'так' : 'ні';
        $result .= '<input type="hidden" name="policies_options_agregate_no" value="' . $row['options_deductible_glass_no'] . '" />';
        $result .= '</td>';
        $result .= '</tr>';
        $result .= '<tr>';
        $result .= '<td class="label grey">50 на 50:</td>';
        $result .= '<td style="width: 20px;"><input type="checkbox" name="options_fifty_fifty" value="1" ' . ($row['options_fifty_fifty']) ? 'checked' : '' . ' ' . $this->getReadonly(true, ($row['options_fifty_fifty']) ? false : true) . ' onclick="setInsurance()" /></td>';
        $result .= '<td style="width: 20px;">';
        $result .= ($row['policies_options_fifty_fifty']) ? 'так' : 'ні';
        $result .= '<input type="hidden" name="policies_options_fifty_fifty" value="' . $row['options_deductible_glass_no'] . '" />';
        $result .= '</td>';
        $result .= '</tr>';
        $result .= '</table>';

        echo $result;
    }

    function changeAccidentsPolicy($accidents_id, $policies_id) {
        global $db;

        $sql = 'SELECT shassi ' .
               'FROM ' . PREFIX . '_policies_kasko_items ' .
               'JOIN ' . PREFIX . '_accidents_kasko ON id = items_id ' .
               'WHERE accidents_id = ' . intval($accidents_id);
        $shassi = $db->getOne($sql);

        $sql = 'SELECT id ' .
               'FROM ' . PREFIX . '_policies_kasko_items ' .
               'WHERE policies_id = ' . intval($policies_id) . ' AND shassi = ' . $db->quote($shassi);
        $items_id = $db->getOne($sql);

        $sql = 'SELECT application_accidents_id ' .
            'FROM ' . PREFIX . '_accidents ' .
            'WHERE id = ' . intval($accidents_id);
        $application_accidents_id = $db->getOne($sql);

        $sql = 'UPDATE ' . PREFIX . '_accidents ' .
            'SET policies_id = ' . intval($policies_id) . ' ' .
            'WHERE id = ' . intval($accidents_id);
        $db->query($sql);

        $sql = 'UPDATE ' . PREFIX . '_accidents_kasko ' .
               'SET items_id = ' . intval($items_id) . ' ' .
               'WHERE accidents_id = ' . intval($accidents_id);
        $db->query($sql);

        if (intval($application_accidents_id)) {
            $sql = 'UPDATE ' . PREFIX . '_application_accidents ' .
                'SET policies_kasko_id = ' . intval($policies_id) . ' ' .
                'WHERE id = ' . intval($application_accidents_id);
            $db->query($sql);

            $sql = 'UPDATE ' . PREFIX . '_application_accidents ' .
                'SET policies_kasko_items_id = ' . intval($items_id) . ' ' .
                'WHERE id = ' . intval($application_accidents_id);
            $db->query($sql);
        }
    }
    
    function getAmountRoughType($accidents_id) {
        global $db;
        
        return $db->getOne('SELECT amount_rough_type ' .
                           'FROM ' . PREFIX . '_accidents_kasko ' .
                           'WHERE accidents_id = ' . intval($accidents_id));
    }
    
    function getAmountRoughFinancialInstitutions($accidents_id) {
        global $db;
        
        return $db->getOne('SELECT financial_institutions_amount_rough ' .
                           'FROM ' . PREFIX . '_accidents_kasko ' .
                           'WHERE accidents_id = ' . intval($accidents_id));
    }
    
    function checkOptionFiftyFifty($data) {
        global $db; 

        $sql = 'SELECT policies_id ' .
               'FROM ' . PREFIX . '_policies_kasko_items ' .
               'WHERE id = ' . intval($data['items_id']);
        $policies_id = $db->getOne($sql);
        
        $sql = 'SELECT options_fifty_fifty ' .
               'FROM ' . PREFIX . '_policies_kasko ' .
               'WHERE policies_id = ' . intval($policies_id);
        
        if ($db->getOne($sql) == 1) {
            $sql = 'SELECT number ' .
                   'FROM ' . PREFIX . '_policies ' .
                   'WHERE id = ' . intval($policies_id);
            $number = $db->getOne($sql);
            
            $sql = 'SELECT IF(years_payments.id > 0, years_payments.date, policies.begin_datetime) ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_policies_kasko_items as items ON policies.id = items.policies_id ' .
                   'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as years_payments ON items.id = years_payments.items_id AND years_payments.date <= policies.interrupt_datetime AND years_payments.f = 0 AND ' . 
                                                                                                    $db->quote($data['datetime']) . ' > years_payments.date AND ' .
                                                                                                    'years_payments.items_id = ' . intval($data['items_id']) . ' ' .
                   'WHERE policies.number = ' . $db->quote($number);
            $begin = $db->getOne($sql);
            
            $sql = 'SELECT SUBDATE(years_payments.date, INTERVAL 1 DAY) as end_year ' .
                   'FROM ' . PREFIX . '_policies as policies ' .
                   'JOIN ' . PREFIX . '_policies_kasko_items as items ON policies.id = items.policies_id ' .
                   'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as years_payments ON items.id = years_payments.items_id AND years_payments.f = 0 ' .
                   'WHERE policies.number = ' . $db->quote($number) . ' AND years_payments.date <= policies.interrupt_datetime AND years_payments.date > ' . $db->quote($begin) . ' ' .
                   'ORDER BY years_payments.date ' . 
                   'LIMIT 1';
            $end = $db->getOne($sql);
            
            if (!strlen($end)) {
                $sql = 'SELECT interrupt_datetime ' .
                       'FROM ' . PREFIX . '_policies ' .
                       'WHERE number = ' . $db->quote($number) . ' ' .
                       'ORDER BY date DESC ' .
                       'LIMIT 1';
                $end = $db->getOne($sql);
            }
            
            $sql = 'SELECT COUNT(calendar.id) ' .
                   'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
                   'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
                   'WHERE calendar.date BETWEEN ' . $db->quote($begin) . ' AND ' . $db->quote($end) . ' AND policies.number = ' . $db->quote($number) . ' AND calendar.second_fifty_fifty = 1';
            $count = $db->getOne($sql);     
        
            /*$sql = 'SELECT MAX(date) ' . 
                   'FROM ' . PREFIX . '_policy_payments_calendar ' .
                   'WHERE date <= ' . $db->quote(date('Y-m-d', strtotime($data['datetime']))) . ' AND policies_id = ' . intval($policies_id);
            $begin = $db->getOne($sql);*/
            
            /*$sql = 'SELECT COUNT(id) ' .
                   'FROM ' . PREFIX . '_policy_payments_calendar ' .
                   'WHERE date BETWEEN ' . $db->quote($begin) . ' AND SUBDATE(ADDDATE(' . $db->quote($begin) . ', INTERVAL 1 YEAR), INTERVAL 1 DAY) AND policies_id = ' . intval($policies_id);
            $count = $db->getOne($sql);

            $sql = 'SELECT amount ' .
                   'FROM ' . PREFIX . '_policy_payments_calendar ' .
                   'WHERE date = ' . $db->quote($begin) . ' AND policies_id = ' . intval($policies_id);
            $amount = $db->getOne($sql);*/

            if ($count == 0) {

                $sql =  'SELECT b.product_types_id, ' .
                'd.amount_agent as agent_amount, ' .
                'c.financial_institutions_id as finId ' .
                'FROM ' . PREFIX . '_policies AS b ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko AS c on c.policies_id = b.id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko_items AS d on d.policies_id = b.id ' .
                'WHERE c.policies_id = ' . intval($policies_id);
                $rows =  $db->getRow($sql);

                if($rows['product_types_id'] == 3 && ($rows['finId'] == 25 || $rows['finId'] == 59)) {
                    $sql = 'INSERT INTO ' . PREFIX . '_policy_payments_calendar ' .
                            'SET ' .
                                'policies_id = ' . intval($policies_id) . ', ' .
                                'amount = ' . doubleval($rows['agent_amount']) . ', ' .
                                'date = ' . $db->quote($end) . ', ' .
                                'file = 1, statuses_id = ' . PAYMENT_STATUSES_NOT . ', ' .
                                'second_fifty_fifty = 1, created = NOW(), modified = NOW()';
                    $db->query($sql);
                } else {
                    $sql = 'SELECT calendar.amount ' .
                           'FROM ' . PREFIX . '_policies as policies ' .
                           'JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
                           'WHERE policies.number = ' . $db->quote($number) . ' AND calendar.date = ' . $db->quote($begin) . ' AND calendar.valid = 1';
                    $amount = doubleval($db->getOne($sql));
                    
                    $sql = 'INSERT INTO ' . PREFIX . '_policy_payments_calendar ' .
                           'SET ' .
                                'policies_id = ' . intval($policies_id) . ', ' .
                                'amount = ' . $amount . ', ' .
                                'date = ' . $db->quote($end) . ', ' .
                                'file = 1, statuses_id = ' . PAYMENT_STATUSES_NOT . ', ' .
                                'second_fifty_fifty = 1, created = NOW(), modified = NOW()';
                    $db->query($sql);
                }       
            }
            
            $this->insertAccidentsComment(array('accidents_id'=> $data['accidents_id'], 'monitoring_comment' => '<label>Договір укладено з опцією "50/50"</label>'));
        }
    }
    
    function getInsurancePrice($data) {
        global $db;
        
        $sql =  'SELECT IF(policies_kasko.terms_years_id = 1, kasko_items.car_price + kasko_items.price_equipment, years_payments.item_price) AS policies_price ' .
                'FROM ' . PREFIX . '_accidents AS accidents ' .
                'JOIN ' . PREFIX . '_accidents_kasko AS accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
                'JOIN ' . PREFIX . '_policies_kasko AS policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
                'JOIN ' . PREFIX . '_policies_kasko_items AS kasko_items ON accidents_kasko.items_id = kasko_items.id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments AS years_payments ON accidents_kasko.items_id = years_payments.items_id AND accidents.datetime BETWEEN years_payments.date AND ADDDATE(years_payments.date, INTERVAL 1 YEAR) ' .
                'WHERE accidents.id = ' . intval($data['id']);    
        return $db->getOne($sql);
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
                       'SET act_statuses_id = ' . (in_array($new_accident_statuses_id, array(ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_AGREEMENT, ACCIDENT_STATUSES_COMPROMISE_CONTINUE)) ? ACCIDENT_STATUSES_INVESTIGATION : intval($new_accident_statuses_id)) . ' ' .
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
        
        $sql =  'INSERT INTO ' . PREFIX . '_accident_status_changes SET ' .
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
    
    function getDeductible($data, $type=0) {
        global $db;
        
        $sql = 'SELECT deductibles_value' . $type . ' as value, deductibles_absolute' . $type . ' as absolute ' .
               'FROM ' . PREFIX . '_policies_kasko_items ' .
               'WHERE id = ' . intval($data['items_id']);
        $deductible = $db->getRow($sql);
        
        if ($deductible['absolute'] == 1) return $deductible['value'];
        else return $this->getInsurancePrice($data) * $deductible['value'] / 100;
    }
    
    function getItemsId($id) {
        global $db;
        
        $sql = 'SELECT items_id ' .
               'FROM ' . PREFIX . '_accidents_kasko ' .
               'WHERE accidents_id = ' . intval($id);
        return $db->getOne($sql);
    }
    
    function setPreviousStatusesSchema() {
        global $Authorization;
        
        if ($Authorization->data['id'] == 1 || in_array(25, $Authorization->data['account_groups_id'])) {
            $this->previousStatusesSchema[ACCIDENT_STATUSES_APPROVAL] = array(ACCIDENT_STATUSES_COORDINATION, ACCIDENT_STATUSES_INVESTIGATION, ACCIDENT_STATUSES_REINVESTIGATION, ACCIDENT_STATUSES_COMPROMISE_CONTINUE);
            $this->previousStatusesSchema[ACCIDENT_STATUSES_PAYMENT] = array(ACCIDENT_STATUSES_APPROVAL);
            $this->previousStatusesSchema[ACCIDENT_STATUSES_RESOLVED] = array(ACCIDENT_STATUSES_APPROVAL);
        }
    }

    function showInfo($data) {
        global $db;

        $data['step'] = 0;
        $this->header($data);

        $accident_sections_titles = array('Не визначено', 'A', 'B', 'C', 'D');
        $zones_id_titles = array('...', 'Україна', 'Україна+Європа', 'Україна+СНД', 'Україна+СНД+Європа');
        $insurer_status_titles = array('-', 'VIP', 'VIP УкрАвто');
        $insurance_price_type = array('агрегатна', 'неагрегатна');
        $assistance = array('не повідомлено', 'не з місця події', 'з місця події');
        $written_sign = array('не своєчасно', 'своєчасно');
        $mvs_sign = array('не повідомлено', 'повідомлено');
        $insurance = array('...', 'страховий з виплатою', 'страховий без виплати', 'не страховий');

        $sql = 'SELECT accidents.number as accidents_number, accidents.accident_sections_id, policies.number as policies_number, policies.date as policies_date, ' .
                    'getPolicyDate(policies.number, 2) as policies_begin_date, getPolicyDate(policies.number, 3) as policies_end_date, ' .
                    'CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname) as insurer, ' .
                    'policies_kasko.assured_title, CONCAT_WS(\' \', items.brand, items.model) as item, items.sign, items.shassi, policies_kasko.zones_id, ' .

                    'items.products_title, IF(clients.important_person = 1, IF(clients.client_groups_id = 1, 2, 1), 0) as insurer_status_id, ' .
                    'IF(years_payments.id > 0, years_payments.item_price, items.car_price) as insurance_price, items.market_price, items.amount_equipment, ' .
                    'policies_kasko.options_agregate_no, ' .

                    'accidents_kasko.options_deductible_glass_no as options_deductible_glass_no, accidents_kasko.options_deterioration_no as options_deterioration_no, ' .
                    'accidents_kasko.options_agregate_no as options_agregate_no, policies_kasko.options_fifty_fifty as options_fifty_fifty, ' .

                    'accidents.datetime as accidents_datetime, accidents_kasko.address as accidents_address, accidents.description_average, accidents.damage, ' .

                    'accidents.application_risks_id, parameters_risks.title as application_risks_title, ' .

                    'IF(accidents.application_risks_id = 7, items.deductibles_value1, items.deductibles_value0) as deductible_percent, accidents.amount_rough, ' .

                    'IF(accidents.assistance_place = 1, 2, IF(accidents.assistance = 1, 1, 0)) as assistance, ' .

                    'IF(ADDDATE(accidents.datetime, INTERVAL 3 DAY) > accidents.date, 1, 0) as written_sign, IF(accidents_kasko.mvs > 0, 1, 0) as mvs_sign, ' .

                    'car_services.title as car_services_title, ' .

                    'CONCAT(average_manager.lastname, \' \', average_manager.firstname) as average_manager_name, CONCAT(estimate_manager.lastname, \' \', estimate_manager.firstname) as estimate_manager_name, ' .

                    'policies.top as policies_top ' .

               'FROM ' . PREFIX . '_accidents as accidents ' .
               'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
               'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
               'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
               'JOIN ' . PREFIX . '_policies_kasko_items as items ON accidents_kasko.items_id = items.id ' .
               'LEFT JOIN ' . PREFIX . '_clients as clients ON policies.clients_id = clients.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as years_payments ON items.id = years_payments.items_id AND accidents.datetime BETWEEN years_payments.date AND SUBDATE(ADDDATE(years_payments.date, INTERVAL 1 YEAR), INTERVAL 1 DAY) ' .
               'LEFT JOIN ' . PREFIX . '_parameters_risks as parameters_risks ON accidents.application_risks_id = parameters_risks.id ' .
               'JOIN ' . PREFIX . '_car_services as car_services ON accidents.car_services_id = car_services.id ' .
               'LEFT JOIN ' . PREFIX . '_accounts as average_manager ON accidents.average_managers_id = average_manager.id ' .
               'LEFT JOIN ' . PREFIX . '_accounts as estimate_manager ON accidents.estimate_managers_id = estimate_manager.id ' .
               'WHERE accidents.id = ' . intval($data['accidents_id']);
        $values = $db->getRow($sql);

        $sql = 'SELECT policies.id as policies_id, policies.number as policies_number, policies.date as policies_date, calendar.date as calendar_date, calendar.amount as calendar_amount, SUM(payments_calendar.amount) as payed_amount ' .
               'FROM ' . PREFIX . '_policies as policies ' .
               'LEFT JOIN ' . PREFIX . '_policy_payments_calendar as calendar ON policies.id = calendar.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_policy_payments_policy_payments_calendar as payments_calendar ON calendar.id = payments_calendar.policy_payments_calendar_id ' .
               'WHERE calendar.valid = 1 AND policies.top = ' . $values['policies_top'] . ' ' .
               'GROUP BY calendar.id ' .
               'ORDER BY calendar.date ASC';
        $values['policies'] = $db->getAll($sql);

        $sql = 'SELECT accidents.id as accidents_id, accidents.number as accidents_number, policies.number as policies_number, accidents.datetime as accidents_datetime, accidents.damage, ' .
                    'accident_statuses.title as accident_statuses_title, GROUP_CONCAT(accidents_compromise_violation.title SEPARATOR \', \') as compromise_violation ' .
               'FROM ' . PREFIX . '_accidents as accidents ' .
               'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
               'JOIN ' . PREFIX . '_policies_kasko_items as items ON accidents_kasko.items_id = items.id ' .
               'JOIN ' . PREFIX . '_policies as policies ON items.policies_id = policies.id ' .
               'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents.accident_statuses_id = accident_statuses.id ' .
               'LEFT JOIN ' . PREFIX . '_accidents_compromise_violation as accidents_compromise_violation ON accidents_compromise_violation.value & accidents.compromise_violation <> 0 ' .
               'WHERE items.shassi = ' . $db->quote($values['shassi']) . ' AND accidents.datetime < ' . $db->quote($values['accidents_datetime']) . ' ' .
               'GROUP BY accidents.id';
    $accidents = $db->getAll($sql);

    $values['accidents'] = array();
        foreach($accidents as $accident) {
            $values['accidents'][$accident['accidents_id']] = $accident;

            $sql = 'SELECT acts.id, acts.number, acts.insurance, acts.amount, GROUP_CONCAT(reasons.title SEPARATOR \', \') as reason_not_payment ' .
                   'FROM ' . PREFIX . '_accidents_acts as acts ' .
                   'LEFT JOIN ' . PREFIX . '_accidents_not_payment_reason as reasons ON acts.reason_not_payment & reasons.value <> 0 ' .
                   'WHERE acts.accidents_id = ' . intval($accident['accidents_id']) . ' ' .
                   'GROUP BY acts.id ORDER BY acts.number';
            $acts = $db->getAll($sql);

            $values['accidents'][$accident['accidents_id']]['calendar_length'] = 0;
            foreach($acts as $act) {
                $values['accidents'][$accident['accidents_id']]['acts'][$act['id']] = $act;

                $sql = 'SElECT id, amount, recipient, payment_date ' .
                       'FROM ' . PREFIX . '_accident_payments_calendar ' .
                       'WHERE acts_id = ' . $act['id'] . ' ' .
                       'ORDER BY  payment_statuses_id DESC, payment_date ASC';
                $calendar = $db->getAll($sql);

                $values['accidents'][$accident['accidents_id']]['acts'][$act['id']]['calendar'] = $calendar;
                $values['accidents'][$accident['accidents_id']]['calendar_length'] += sizeof($calendar);

            }
        }

        $sql = 'SELECT changes.accident_statuses_id, changes.created, descriptions.description ' .
               'FROM ' . PREFIX . '_accident_status_changes as changes ' .
               'JOIN ' . PREFIX . '_accident_statuses_descriptions as descriptions ON changes.accident_statuses_id = descriptions.accident_statuses_id ' .
               'WHERE changes.accidents_id = ' . intval($data['accidents_id']) . ' AND descriptions.product_types_id IN (1, 3) ' .
               'ORDER BY changes.created ASC';
        $values['history'] = $db->getAll($sql);

        $sql = 'SELECT (calendar.amount) ' .
               'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
               'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON calendar.accidents_id = accidents_kasko.accidents_id ' .
               'JOIN ' . PREFIX . '_policies_kasko_items as items ON accidents_kasko.items_id = items.id ' .
               'JOIN ' . PREFIX . '_policies as policies ON items.policies_id = policies.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as years_payments ON items.id = years_payments.items_id AND ' . $db->quote($values['accidents_datetime']) . ' BETWEEN years_payments.date AND SUBDATE(ADDDATE(years_payments.date, INTERVAL 1 YEAR), INTERVAL 1 DAY) ' .
               'WHERE policies.number = ' . $db->quote($values['policies_number']) . ' AND calendar.payment_date < ' . $db->quote($values['accidents_datetime']) . ' AND calendar.payment_types_id IN (5, 6) AND items.shassi = ' . $db->quote($values['shassi']);
        $values['previous_accidents_amount'] = $db->getOne($sql);

        $sql = 'SELECT messages.message_types_id, messages.question, messages.answer ' .
               'FROM ' . PREFIX . '_accident_messages as messages ' .
               'WHERE messages.message_types_id IN(5, 9) AND messages.statuses_id = 2 AND messages.accidents_id = ' . intval($data['accidents_id']) . ' ' .
               'ORDER BY decision DESC';
        $messages = $db->getAll($sql);

        $values['messages'][0]['type'] = 0;
        $values['messages'][1]['title'] = 'Рахунок СТО';
        $values['messages'][2]['title'] = 'Audatex';
        $values['messages'][3]['title'] = 'Незалежний експерт';

        $check_messages = array();
        foreach($messages as $message) {
            $question = unserialize($message['question']);

            if ($message['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH) {
                if (in_array(3, $check_messages)) continue;
                array_push($check_messages, 3);
                $message['answer'] = unserialize($message['answer']);
                $values['messages'][3]['data'] = $message;

                if (in_array($values['messages'][0]['type'], array(0))) {
                    $values['messages'][0]['market_price'] = $message['answer']['market_price'];
                    $values['messages'][0]['deterioration_value'] = $message['answer']['deterioration_value'];
                }
            } elseif ($message['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $question['perform_audatex']) {
                if (in_array(2, $check_messages)) continue;
                array_push($check_messages, 2);
                $message['answer'] = unserialize($message['answer']);
                $values['messages'][2]['data'] = $message;

                if (in_array($values['messages'][0]['type'], array(0, 3))) {
                    $values['messages'][0]['market_price'] = $message['answer']['market_price'];
                    $values['messages'][0]['deterioration_value'] = $message['answer']['deterioration_value'];
                }
            } else {
                if (in_array(1, $check_messages)) continue;
                array_push($check_messages, 1);
                $message['answer'] = unserialize($message['answer']);
                $values['messages'][1]['data'] = $message;

                $result_calculation_car_services_title = $message['answer']['result_calculation_car_services_title'];

                if (in_array($values['messages'][0]['type'], array(0, 2, 3))) {
                    $values['messages'][0]['market_price'] = $message['answer']['market_price'];
                    $values['messages'][0]['deterioration_value'] = $message['answer']['deterioration_value'];
                }
            }
        }
//_dump($values['accidents']);
        include_once 'Accidents/showInfoKasko.php';
    }

    function showAccidentsInfoInPolicy($data) {
        global $db;

        $insurance = array('...', 'страховий з виплатою', 'страховий без виплати', 'не страховий');
        
        $sql = 'SELECT insurer_person_types_id, insurer_identification_code, insurer_edrpou ' .
               'FROM ' . PREFIX . '_policies_kasko ' .
               'WHERE policies_id = ' . intval($data['policies_id']);
        $info = $db->getRow($sql);
        
        switch ($info['insurer_person_types_id']) {
            case 1:
                if ($info['insurer_identification_code']) {
                    $condition = 'policies_kasko.insurer_identification_code = ' . $db->quote($info['insurer_identification_code']);
                } else {
                    $condition = 'accidents.policies_id = ' . intval($data['policies_id']);
                }
                break;
            case 2:
                if ($info['insurer_edrpou']) {
                    $condition = 'policies_kasko.insurer_edrpou = ' . $db->quote($info['insurer_edrpou']);
                } else {
                    $condition = 'accidents.policies_id = ' . intval($data['policies_id']);
                }
                break;
            default:
                $condition = 'accidents.policies_id = ' . intval($data['policies_id']);
                break;
        }

        $sql = 'SELECT accidents.id as accidents_id, accidents.number as accidents_number, policies.number as policies_number, accidents.datetime as accidents_datetime, accidents.damage, ' .
            'accident_statuses.title as accident_statuses_title, GROUP_CONCAT(accidents_compromise_violation.title SEPARATOR \', \') as compromise_violation ' .
            'FROM ' . PREFIX . '_accidents as accidents ' .
            'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
            'JOIN ' . PREFIX . '_policies_kasko_items as items ON accidents_kasko.items_id = items.id ' .
            'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON items.policies_id = policies_kasko.policies_id ' .
            'JOIN ' . PREFIX . '_policies as policies ON policies_kasko.policies_id = policies.id ' .
            'JOIN ' . PREFIX . '_accident_statuses as accident_statuses ON accidents.accident_statuses_id = accident_statuses.id ' .
            'LEFT JOIN ' . PREFIX . '_accidents_compromise_violation as accidents_compromise_violation ON accidents_compromise_violation.value & accidents.compromise_violation <> 0 ' .
            'WHERE ' . $condition . ' ' .
            'GROUP BY accidents.id ORDER BY accidents.date';
        $accidents = $db->getAll($sql);

        $values['accidents'] = array();
        foreach($accidents as $accident) {
            $values['accidents'][$accident['accidents_id']] = $accident;

            $sql = 'SELECT acts.id, acts.number, acts.insurance, acts.amount, GROUP_CONCAT(reasons.title SEPARATOR \', \') as reason_not_payment ' .
                'FROM ' . PREFIX . '_accidents_acts as acts ' .
                'LEFT JOIN ' . PREFIX . '_accidents_not_payment_reason as reasons ON acts.reason_not_payment & reasons.value <> 0 ' .
                'WHERE acts.accidents_id = ' . intval($accident['accidents_id']) . ' ' .
                'GROUP BY acts.id ORDER BY acts.number';
            $acts = $db->getAll($sql);

            $values['accidents'][$accident['accidents_id']]['calendar_length'] = 0;
            foreach($acts as $act) {
                $values['accidents'][$accident['accidents_id']]['acts'][$act['id']] = $act;

                $sql = 'SElECT id, amount, recipient, payment_date, payment_statuses_id ' .
                    'FROM ' . PREFIX . '_accident_payments_calendar ' .
                    'WHERE acts_id = ' . $act['id'] . ' ' .
                    'ORDER BY  payment_statuses_id DESC, payment_date ASC';
                $calendar = $db->getAll($sql);

                $values['accidents'][$accident['accidents_id']]['acts'][$act['id']]['calendar'] = $calendar;
                $values['accidents'][$accident['accidents_id']]['calendar_length'] += (sizeof($calendar) ? sizeof($calendar) : 1);

            }
        $values['accidents'][$accident['accidents_id']]['calendar_length'] = ($values['accidents'][$accident['accidents_id']]['calendar_length'] == 0 ? 1 : $values['accidents'][$accident['accidents_id']]['calendar_length']);
        }

        include_once 'Accidents/showAccidentsInfoInPolicy.php';
    }
    
    function viewCall($data) {
        $data['action'] = 'viewCall';
        
        $this->showForm($data);
    }
    
}

?>