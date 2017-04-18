<?
/*
 * Title: policy cargo class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'DeliveryWays.class.php';
require_once 'Certificates.class.php';
require_once 'Users/ClientContacts.class.php';
require_once 'PolicyPaymentsCalendar.class.php';
require_once 'TransportationCompanies.class.php';

class Policies_Cargo extends Policies {
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
                                    'view'       => true,
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
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
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
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
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
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies'),
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
                            'name'              => 'client_contacts_id',
                            'description'       => 'Клієнт',
                            'type'              => fldSelect,
							'condition'			=> 'roles_id = 32',
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
                            'name'              => 'policies_general_id',
                            'description'       => 'Генеральний договір',
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
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 1,
                            'table'             => 'policies_cargo'),
						array(
                            'name'              => 'price_percent',
                            'description'       => '% надбавки',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_cargo'),
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
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 2,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'date',
                            'description'       => 'Дата сертифікату',
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
                            'orderPosition'     => 3,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'document',
                            'description'       => 'ТТН, номер',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 4,
                            'table'             => 'policies_cargo'),
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
                            'orderPosition'     => 7,
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
                            'orderPosition'     => 8,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'item_types_id',
                            'description'       => 'Найменування',
                            'showId'            => true,
                            'type'              => fldRadio,
                            'list'              => array(
                                                    1 => 'Автомобільні запчастини, масла, аксесуари',
                                                    2 => 'Автомобіль',
													3 => 'Автомобільні запчастини',
													4 => 'Машинокомплекти'),
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_cargo'),
						array(
                            'name'              => 'item_types_text',
                            'description'       => 'Додатково',
                            'type'              => fldText,
                            'maxlength'         => 250,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_cargo'),
                        array(
                            'name'              => 'assured',
                            'description'       => 'Вигодонабувач',
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
                            'table'             => 'policies_cargo'),
						array(
                            'name'              => 'assured_en',
                            'description'       => 'Вигодонабувач Англ',
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
                            'table'             => 'policies_cargo'),
                        array(
                            'name'              => 'shipping',
                            'description'       => 'Умови поставки',
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
							'orderPosition'        => 99,		
                            'table'             => 'policies_cargo'),
						array(
                            'name'              => 'shipping_en',
                            'description'       => 'Умови поставки Англ',
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
                            'table'             => 'policies_cargo'),
                        array(
                            'name'              => 'temporary_storage',
                            'description'       => 'Місце тимчасового складування',
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
                            'table'             => 'policies_cargo'),
						array(
                            'name'              => 'temporary_storage_en',
                            'description'       => 'Місце тимчасового складування Англ',
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
                            'table'             => 'policies_cargo'),
                        array(
                            'name'              => 'transportation_company',
                            'description'       => 'Експедитор, перевізник',
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
							'orderPosition'        => 98,	
                            'table'             => 'policies_cargo'),
						array(
                            'name'              => 'transportation_company_en',
                            'description'       => 'Експедитор, перевізник Англ',
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
                            'table'             => 'policies_cargo'),
                        array(
                            'name'              => 'delivery_ways_id',
                            'description'       => 'Вид транспортування',
                            'showId'            => true,
                            'type'              => fldMultipleSelect,
							'indexType'			=> 'double',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_cargo',
                            'sourceTable'       => 'delivery_ways',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
						array(
                            'name'              => 'delivery_title',
                            'description'       => 'Назва транспортного засобу',
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
                            'table'             => 'policies_cargo'),	
                        array(
                            'name'              => 'sign_car',
                            'description'       => 'Номер авто',
                            'type'              => fldText,
                            'maxlength'         => 10,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'orderPosition'    	=> 9,
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_cargo'),
                        array(
                            'name'              => 'sign_trailer',
                            'description'       => 'Номер прицепа',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_cargo'),
                        array(
                            'name'              => 'comment',
                            'description'       => 'Коментар',
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
                            'table'             => 'policies_cargo'),
                        array(
                            'name'              => 'comment_en',
                            'description'       => 'Коментар (англ.)',
                            'type'              => fldText,
                            'display'           =>
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
                            'table'                => 'policies_cargo'),
                        array(
                            'name'                => 'deductibles_value',
                            'description'        => 'Франшиза',
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
                            'table'                => 'policies_cargo'),
                        array(
                            'name'                => 'deductibles_absolute',
                            'description'        => 'Франшиза',
                            'type'                => fldBoolean,
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
                            'table'                => 'policies_cargo'),
                        array(
                            'name'                => 'price',
                            'description'        => 'Сума, грн.',
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
                            'orderPosition'        => 5,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'price_usd',
                            'description'        => 'Сума, $',
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
                            'table'                => 'policies_cargo'),
                        array(
                            'name'                => 'rate',
                            'description'        => 'Тариф, %',
                            'type'                => fldPercent,
							'maxlenght'			 => 6,
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
                            'name'                => 'amount_usd',
                            'description'        => 'Премія, $',
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
                            'table'                => 'policies_cargo'),
						 array(
                            'name'                => 'policy',
                            'description'        => 'Страховий полiс',
                            'type'                => fldBoolean,
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
                            'table'                => 'policies_cargo'),	
                        array(
                            'name'                => 'policy_statuses_id',
                            'description'        => 'Статус',
                            'type'                => fldSelect,
                            'display'            =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'changeStatus'    => true,
                                    'view'          => true,
                                    'update'        => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 10,
                            'table'                => 'policies',
                            'sourceTable'        => 'policy_statuses',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'payment_statuses_id',
                            'description'        => 'Оплата',
                            'type'                => fldSelect,
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
                            'orderPosition'        => 11,
                            'table'                 => 'policies',
                            'sourceTable'           => 'payment_statuses',
                            'selectField'           => 'title',
                            'orderField'            => 'order_position'),
                        array(
                            'name'                => 'certificate',
                            'description'        => 'Сертифікат',
                            'type'                => fldFile,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => false,
                                    'change'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 12,
                            'table'                => 'policies_cargo'),
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
                            'orderPosition'        => 13,
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
                            'orderPosition'        => 14,
                            'width'             => 100,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'is_bank',
                            'description'        => 'Банк',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 15,
                            'table'                => 'policies')
                     ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    => 14,
                        'defaultOrderDirection'    => 'desc',
                        'titleField'            => 'number')
            );

    function Policies_Cargo($data) {
        global $Authorization;

        Policies::Policies($data);

        $this->objectTitle = 'Policies_Cargo';

        $this->messages['plural'] = 'Сертифікати добровільного страхування вантажів та багажу (вантажобагажу)';
        $this->messages['single'] = 'Сертифікат добровільного страхування вантажів та багажу (вантажобагажу)';

		Certificates::setPolicyStatusesSchema();
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'          => true,
                    'insert'        => false,
                    'update'        => true,
                    'changeStatus'  => true,
                    'reset'			=> true,
                    'view'          => true,
                    'export'        => true,
                    'exportActions' => true,
                    'change'        => false,
                    'delete'        => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
            case ROLES_CLIENT_CONTACT:
                $this->permissions = array(
                    'show'          => true,
                    'insert'        => true,
                    'import'        => true,
                    'update'        => true,
                    'changeStatus'  => true,
                    'view'          => true,
                    'export'        => true,
                    'change'        => false,
                    'delete'        => true);

                $this->formDescription['fields'][ $this->getFieldPositionByName('documents') ]['display']['change'] = false;
                $this->formDescription['fields'][ $this->getFieldPositionByName('commission') ]['display']['change'] = false;

                break;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='showCertificates.php', $limit=true) {
        global $db, $Authorization;

        if ($data['itemsDocumentNumber']) {
            $fields[] = 'itemsDocumentNumber';
            $conditions[] = 'document_number = ' . $db->quote($data['itemsDocumentNumber']);
        }

        if ($data['itemsDocumentDate']) {
            $fields[] = 'itemsDocumentDate';
            $conditions[] =  'TO_DAYS(document_date) = TO_DAYS(' . $db->quote( substr($data['itemsDocumentDate'], 6, 4) . substr($data['itemsDocumentDate'], 3, 2) . substr($data['itemsDocumentDate'], 0, 2) ) . ')';
        }

        if ($data['itemsShassi']) {
            $fields[] = 'itemsShassi';
            $conditions[] =  'shassi = ' . $db->quote($data['itemsShassi']);
        }

        if (is_array($conditions)) {
            $policies_id = $db->getCol('SELECT policies_id FROM ' . PREFIX . '_policies_cargo_items WHERE ' . implode(' AND ', $conditions));
            if (!is_array($policies_id) || sizeof($policies_id)==0) $policies_id=array(0);
            $conditions = array($this->tables[0] . '.id IN ('. implode(' , ', $policies_id).')');
        }

        switch ($Authorization->data['roles_id']) {
            case ROLES_CLIENT_CONTACT:

                $conditions[] = PREFIX . '_policies.clients_id = ' . intval($Authorization->data['clients_id']);

                switch ($Authorization->data['clients_id']) {
                    case CLIENTS_KGC://показ для менеджеров КГЦ в пределах персональной зоны видимости
                        if ($Authorization->data['id'] != 3708 && $Authorization->data['id'] != 3724) {//!!!костыль, показываем руководству все
                            $conditions[] = PREFIX . '_policies.client_contacts_id = ' . intval($Authorization->data['id']);
                        }
                        break;
                }
                break;
        }

        parent::show($data, $fields, $conditions, $sql, $template, $limit);
    }

    function getListOfFileFields() {
        $files = array();

        foreach($this->formDescription['fields'] as $field) {
            if (($field['type'] == fldImage || $field['type'] == fldFile) && $field['name'] != 'certificate') {
                if ($field['multiLanguages']) {
                    foreach ($this->languages as $languageCode => $languageTitle) {
                        $files[] = $field['name'] . $languageCode;
                    }
                } else {
                    $files[] = $field['name'];
                }
            }
        }

        return $files;
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        global $db;

        //$conditions[] = 'product_types_id = ' . PRODUCT_TYPES_DRIVE_CERTIFICATE;
		$conditions[] = 'product_types_id = 3';

        $sql =  'SELECT id, title ' .
                'FROM ' . PREFIX . '_car_types ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY order_position';
        $data['car_types']['list'] = $db->getAll($sql, 300);

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_client_points ' .
				'WHERE clients_id = ' . intval($data['clients_id']);
		$data['client_points'] = $db->getAll($sql, 300);

        parent::showForm($data, $action, $actionType, $template);
    }

    function add($data) {
        global $Authorization;

        if (!intval($data['clients_id'])) {
            $data['clients_id'] = $Authorization->data['clients_id'];
		}

        return parent::add($data);
    }

    function calculate($policies_general_id, $item_types_id, $price, $begin_datetime, $end_datetime, &$data) {
        global $db;

        $conditions[] = 'a.id = ' . intval($policies_general_id);
        $conditions[] = 'c.item_types_id = ' . intval($item_types_id);
        $conditions[] = 'd.item_types_id = ' . intval($item_types_id);
        $conditions[] = 'd.days >= TO_DAYS(' . $db->quote($end_datetime) . ') - TO_DAYS(' . $db->quote($begin_datetime) . ')';

        $sql =  'SELECT b.price_percent, c.value, c.absolute, d.rate ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_cargo_general AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policies_cargo_general_deductibles AS c ON a.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_policies_cargo_general_rates AS d ON a.id = d.policies_id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY d.days ASC ' .
                'LIMIT 1';
        $row = $db->getRow($sql);

        $data['price']					= round($price, 2);
        $data['deductibles_value']		= $row['value'];
        $data['deductibles_absolute']	= $row['absolute'];
        $data['rate']       			= round($row['rate'], 4);
        $data['amount']     			= round($price * $row['rate'] * $row['price_percent'] / 100 / 100, 2);
    }

    function getRateInWindow($data) {
        $this->calculate($data['policies_general_id'], $data['item_types_id'], $data['price'], $data['begin_datetime'], $data['end_datetime'], $data);

        echo '{"price":"' . $data['price'] . '","deductibles_value":"' . $data['deductibles_value'] . '","deductibles_absolute":"' . $data['deductibles_absolute'] . '","rate":"' . $data['rate'] . '","amount":"' . $data['amount'] . '"}';
        exit;
    }

    function setConstants(&$data) {

        $data['insurance_companies_id'] = INSURANCE_COMPANIES_EXPRESS;

		if ($data['clients_id'] == CLIENTS_AUTOZAZ || (is_array($data['delivery_ways_id']) && !in_array(DELIVERY_WAYS_AUTO, $data['delivery_ways_id']))) {
			$this->formDescription['fields'][ $this->getFieldPositionByName('sign_car') ]['verification']['canBeEmpty'] = true;
			$this->formDescription['fields'][ $this->getFieldPositionByName('sign_trailer') ]['verification']['canBeEmpty'] = true;
		}

        $data['price']		= 0;
		$data['price_usd']	= 0;

        if (is_array($data['items'])) {
            foreach ($data['items'] as $i => $row) {

                if (!$data['document']) {
                    $data['document'] = $row['document_number'];
                }

                $data['items'][ $i ]['price'] = $row['price'] = str_replace(',', '.', $row['price']);
				$data['items'][ $i ]['price_usd'] = $row['price_usd'] = str_replace(',', '.', $row['price_usd']);

                if ($row['title'] || $row['price'] || $row['price_usd'] || $row['quantity'] || $row['packing'] || $row['weight'] || $row['document_number'] || $row['send'] || $row['destination'] || $row['sender'] || $row['recipient']) {
					$data['items'][ $i ]['title'] = htmlspecialchars( $this->replaceTags(trim($row['title'])) );
					$data['items'][ $i ]['quantity'] = htmlspecialchars( $this->replaceTags(trim($row['quantity'])) );
					$data['items'][ $i ]['packing'] = htmlspecialchars( $this->replaceTags(trim($row['packing'])) );
					$data['items'][ $i ]['document_number'] = htmlspecialchars( $this->replaceTags(trim($row['document_number'])) );
					$data['items'][ $i ]['send'] = htmlspecialchars( $this->replaceTags(trim($row['send'])) );
					$data['items'][ $i ]['send_en'] = htmlspecialchars( $this->replaceTags(trim($row['send_en'])) );
					$data['items'][ $i ]['destination'] = htmlspecialchars( $this->replaceTags(trim($row['destination'])) );
					$data['items'][ $i ]['destination_en'] = htmlspecialchars( $this->replaceTags(trim($row['destination_en'])) );
					$data['items'][ $i ]['sender'] = htmlspecialchars( $this->replaceTags(trim($row['sender'])) );
					$data['items'][ $i ]['sender_en'] = htmlspecialchars( $this->replaceTags(trim($row['sender_en'])) );
					$data['items'][ $i ]['recipient'] = htmlspecialchars( $this->replaceTags(trim($row['recipient'])) );
					$data['items'][ $i ]['recipient_en'] = htmlspecialchars( $this->replaceTags(trim($row['recipient_en'])) );
                    $data['price'] += $row['price'];
					$data['price_usd'] += $row['price_usd'];
                }
            }
        }

        $this->calculate($data['policies_general_id'], $data['item_types_id'], $data['price'], $data['begin_datetime_year'] . $data['begin_datetime_month'] . $data['begin_datetime_day'], $data['end_datetime_year'] . $data['end_datetime_month'] . $data['end_datetime_day'], &$data);

		$data['amount_usd'] = round($data['price_usd'] * $data['rate'] / 100, 2);

        if (!$data['policy_statuses_id']) {
            $data['policy_statuses_id'] = POLICY_STATUSES_CREATED;
        }

        return parent::setConstants($data);
    }

    function checkFields(&$data, $action) {
        global $db, $Log;

        if (is_array($data['items'])) {
            foreach ($data['items'] as $i => $row) {
                switch ($data['item_types_id']) {

                    case 1://грузы

                        $params = array('Кількість місць, шт.', null);
                        if ($row['quantity'] == '') {
                            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        }

                        $params = array('Вага, кг.', null);
                        if ($row['weight'] == '') {
							$Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        }

                        break;
                   case 2://автомобиль

                        $params = array('Тип ТЗ', null);
                        if (!intval($row['car_types_id'])) {
                            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        }

                        $params = array('Марка', null);
                        if (!intval($row['brands_id'])) {
                            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        }

                        $params = array('Модель', null);
                        if (!intval($row['models_id'])) {
                            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        }

                        $params = array('№ шасі (кузов, рама)', null);
                        if ($row['shassi'] == '') {
                            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        }
                 }

                $params = array('Вартість, грн.', null);
                if (floatval($row['price']) <= 0) {
                       $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidMoney($row['price'])) {
                       $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }

                $params = array('Вартість, $', null);
                if ($row['price_usd'] != '' && !$this->isValidMoney($row['price_usd'])) {
					$Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }

				$price_usd += $row['price_usd'];

                $params = array('Номер ТТН', null);
                if ($row['document_number'] == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                }

                $params = array('Дата ТТН', null);
                if (!checkdate(substr($row['document_date'], 3, 2), substr($row['document_date'], 0, 2), substr($row['document_date'], 6, 4))) {
                    $Log->add('error', 'The date <b>%s</b>%s is not valid.', $params);
                }

                if ($data['clients_id'] != CLIENTS_AUTOCAPITAL || ($data['clients_id'] == CLIENTS_AUTOCAPITAL && $data['item_types_id'] == '1')) {
                    $params = array('Пункт відправлення', null);
                    if ($row['send'] == '') {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }

                    $params = array('Відправник', null);
                    if ($row['sender'] == '') {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }

                    $params = array('Пункт призначення', null);
                    if ($row['send'] == '') {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }

                    $params = array('Отримувач', null);
                    if ($row['sender'] == '') {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }
                }
            }

			if ($price_usd > 0) {//проверяем корректность заполнения полей со стоимостью груза в USD
				$params = array('Вартість, $', null);
				foreach ($data['items'] as $i => $row) {
					if (floatval($row['price_usd']) <= 0) {
						   $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
					} elseif (!$this->isValidMoney($row['price_usd'])) {
						   $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
					}
				}
			}
        }

        parent::checkFields($data, $action);

        $date = (checkdate(intval($data['date_month']), intval($data['date_day']), intval($data['date_year'])))
            ? mktime(0, 0, 0, intval($data['date_month']), intval($data['date_day']), intval($data['date_year']))
            : mktime(0, 0, 0, date('m')  , date('d'), date('Y'));
        $begin_datetime = (checkdate(intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year']))
            : 0;
        $end_datetime = (checkdate(intval($data['end_datetime_month']), intval($data['end_datetime_day']), intval($data['end_datetime_year'])))
            ? mktime(0, 0, 0, intval($data['end_datetime_month']), intval($data['end_datetime_day']), intval($data['end_datetime_year']))
            : 0;

        $sql =  'SELECT UNIX_TIMESTAMP(a.begin_datetime) as begin_datetime, UNIX_TIMESTAMP(a.end_datetime) as end_datetime, b.payment_types_id ' .
                'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policies_cargo_general AS b ON a.id = b.policies_id ' .
                'WHERE id = ' . intval($data['policies_general_id']);
        $row = $db->getRow($sql);

		$data['payment_types_id'] = $row['payment_types_id'];

        //проверка даты начала действия полиса
        if ($begin_datetime < $date) {
            $Log->add('error', '<b>Дата початку дії сертифікату</b> не може бути раніше ніж <b>Дата заключення сертифікату</b>.');
        }
        if ($begin_datetime > $end_datetime) {
            $Log->add('error', '<b>Дата початку дії сертифікату</b> не може бути пізніше ніж <b>Дата закінчення дії сертифікату</b>.');
        }

        //проверяем даты в связке с генеральным договором
        if ($date < $row['begin_datetime']) {
            $Log->add('error', '<b>Дата заключення сертифікату</b> не може бути раніше ніж <b>Дата початку дії генерального договору</b>.');
        }
        if ($begin_datetime < $row['begin_datetime']) {
            $Log->add('error', '<b>Дата початку дії сертифікату</b> не може бути раніше ніж <b>Дата початку дії генерального договору</b>.');
        }

		if (!Certificates::isValidPolicyGeneral($data['policies_general_id'], $data['clients_id'], $data['date_year'] . $data['date_month'] . $data['date_day'])) {
            $Log->add('error', '<b>Генеральний договір</b> не вірний.');
		} elseif (is_array($data['delivery_ways_id']) && !(array_sum($data['delivery_ways_id']) & Certificates::getDeliveryWaysId($data['policies_general_id']))) {
			$Log->add('error', '<b>Вид транспортування</b> не співпадає з вказаним в Генеральному договорі.');
		}

/*не проверяем окончание действия генерального договора
        if ($row['end_datetime'] < $end_datetime) {
            $Log->add('error', '<b>Дата закінчення дії сертифікату</b> не може бути пізніше ніж <b>Дата закінчення дії генерального договору</b>.');
        }
 */
    }

    function updateItems($policies_id, $items) {
        global $db;

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policies_cargo_items ' .
                'WHERE policies_id = ' . intval($policies_id);
        $db->query($sql);

        if (is_array($items)) {
            foreach ($items as $row) {
                $sql =  'INSERT INTO ' . PREFIX . '_policies_cargo_items SET ' .
                        'policies_id = ' . intval($policies_id) . ', ' .
                        'brands_id = ' . intval($row['brands_id']) . ', ' .
                        'models_id = ' . intval($row['models_id']) . ', ' .
                        'shassi = ' . $db->quote($row['shassi']) . ', ' .
                        'price = ' . $db->quote($row['price']) . ', ' .
						'price_usd = ' . $db->quote($row['price_usd']) . ', ' .
                        'quantity = ' . $db->quote($row['quantity']) . ', ' .
                        'packing = ' . $db->quote($row['packing']) . ', ' .
                        'weight = ' . $db->quote($row['weight']) . ', ' .
                        'send = ' . $db->quote($row['send']) . ', ' .
						'send_en = ' . $db->quote($row['send_en']) . ', ' .
                        'destination = ' . $db->quote($row['destination']) . ', ' .
						'destination_en = ' . $db->quote($row['destination_en']) . ', ' .
                        'sender = ' . $db->quote($row['sender']) . ', ' .
						'sender_en = ' . $db->quote($row['sender_en']) . ', ' .
                        'recipient = ' . $db->quote($row['recipient']) . ', ' .
						'recipient_en = ' . $db->quote($row['recipient_en']) . ', ' .
                        'document_number = ' . $db->quote($row['document_number']) . ', ' .
                        'document_date = ' . $db->quote(substr($row['document_date'], 6, 4) . '.' . substr($row['document_date'], 3, 2) . substr($row['document_date'], 0, 2)) . ', ' .
                        'created = NOW()';
                $db->query($sql);
            }

            $sql =  'UPDATE ' . PREFIX . '_policies_cargo_items AS a ' .
                    'JOIN ' . PREFIX . '_car_brands AS b ON a.brands_id = b.id ' .
                    'JOIN ' . PREFIX . '_car_models AS c ON a.models_id = c.id SET ' .
                    'brand = b.title, ' .
                    'model = c.title ' .
                    'WHERE a.policies_id = ' . intval($policies_id);
            $db->query($sql);
        }
    }

    function setAdditionalFields($id, $data) {
        global $db, $Authorization;

        if ($_REQUEST['do'] == $this->object . '|import') {
            $fields[] = 'a.client_contacts_id = IF(a.policy_statuses_id = ' . POLICY_STATUSES_CREATED . ', ' . $Authorization->data['id'] . ', a.client_contacts_id)';
        }

        $fields[] = 'a.product_types_expense_percent = e.expense_percent';
        $fields[] = 'a.number = IF(a.number, a.number, CONCAT(d.number, \'-\', c.number))';
        $fields[] = 'a.interrupt_datetime = a.end_datetime';
        
		$fields[] = 'b.owner_company = f.company';
        $fields[] = 'b.owner_company_en = f.company_en';
        $fields[] = 'b.owner_bank = f.bank';
        $fields[] = 'b.owner_bank_en = f.bank_en';
        $fields[] = 'b.owner_bank_account = f.bank_account';
        $fields[] = 'b.owner_bank_mfo = f.bank_mfo';
        $fields[] = 'b.owner_edrpou = f.identification_code';
        $fields[] = 'b.owner_lastname = c.lastname';
        $fields[] = 'b.owner_lastname_en = c.lastname_en';
        $fields[] = 'b.owner_firstname = c.firstname';
        $fields[] = 'b.owner_firstname_en = c.firstname_en';
        $fields[] = 'b.owner_patronymicname = c.patronymicname';
        $fields[] = 'b.owner_patronymicname_en = c.patronymicname_en';
        $fields[] = 'b.owner_position = c.position';
        $fields[] = 'b.owner_position_en = c.position_en';
        $fields[] = 'b.owner_ground = c.ground';
        $fields[] = 'b.owner_ground_en = c.ground_en';
        $fields[] = 'b.owner_regions_id = f.registration_regions_id';
		
        $fields[] = 'b.owner_area = f.registration_area';
        $fields[] = 'b.owner_area_en = f.registration_area_en';
        $fields[] = 'b.owner_city = f.registration_city';
        $fields[] = 'b.owner_city_en = f.registration_city_en';
        $fields[] = 'b.owner_street_types_id = f.registration_street_types_id';
        $fields[] = 'b.owner_street = f.registration_street';
        $fields[] = 'b.owner_street_en = f.registration_street_en';
        $fields[] = 'b.owner_house = f.registration_house';
        $fields[] = 'b.owner_flat = f.registration_flat';
        $fields[] = 'b.owner_phone = f.registration_phone';
        $fields[] = 'b.insurer_company = f.company';
        $fields[] = 'b.insurer_company_en = f.company_en';
        $fields[] = 'b.insurer_bank = f.bank';
        $fields[] = 'b.insurer_bank_en = f.bank_en';
        $fields[] = 'b.insurer_bank_account = f.bank_account';
        $fields[] = 'b.insurer_bank_mfo = f.bank_mfo';
        $fields[] = 'b.insurer_edrpou = f.identification_code';
        $fields[] = 'b.insurer_lastname = c.lastname';
        $fields[] = 'b.insurer_lastname_en = c.lastname_en';
        $fields[] = 'b.insurer_firstname = c.firstname';
        $fields[] = 'b.insurer_firstname_en = c.firstname_en';
        $fields[] = 'b.insurer_patronymicname = c.patronymicname';
        $fields[] = 'b.insurer_patronymicname_en = c.patronymicname_en';
        $fields[] = 'b.insurer_position = c.position';
        $fields[] = 'b.insurer_position_en = c.position_en';
        $fields[] = 'b.insurer_ground = c.ground';
        $fields[] = 'b.insurer_ground_en = c.ground_en';
        $fields[] = 'b.insurer_regions_id = f.registration_regions_id';
        $fields[] = 'b.insurer_area = f.registration_area';
        $fields[] = 'b.insurer_area_en = f.registration_area_en';
        $fields[] = 'b.insurer_city = f.registration_city';
        $fields[] = 'b.insurer_city_en = f.registration_city_en';
        $fields[] = 'b.insurer_street_types_id = f.registration_street_types_id';
        $fields[] = 'b.insurer_street = f.registration_street';
        $fields[] = 'b.insurer_street_en = f.registration_street_en';
        $fields[] = 'b.insurer_house = f.registration_house';
        $fields[] = 'b.insurer_flat = f.registration_flat';
        $fields[] = 'b.insurer_phone = f.registration_phone';
		
		$fields[] = 'b.delivery_ways_title = ' . $db->quote( DeliveryWays::getTitles(array_sum($data['delivery_ways_id'])) );
		$fields[] = 'b.delivery_ways_title_en = ' . $db->quote( DeliveryWays::getTitles(array_sum($data['delivery_ways_id']),'En') );
		$fields[] = 'b.shipping = IF(b.shipping = \'\', c.shipping, b.shipping)';
		//$fields[] = 'b.shipping_en = IF(b.shipping_en = \'\', c.shipping_en, b.shipping_en)';
		$fields[] = 'b.method = c.method';
		$fields[] = 'b.method_en = c.method_en';
		$fields[] = 'b.price_percent = c.price_percent';
		$fields[] = 'b.assured = IF(b.assured = \'\', c.assured, b.assured)';
		//$fields[] = 'b.assured_en = IF(b.assured_en = \'\', c.assured_en, b.assured_en)';
        $fields[] = 'c.number = IF(a.number, c.number, c.number + 1)';

        $sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_cargo AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policies_cargo_general AS c ON b.policies_general_id = c.policies_id ' .
                'JOIN ' . PREFIX . '_policies AS d ON c.policies_id = d.id ' .
				'JOIN ' . PREFIX . '_product_types AS e ON a.product_types_id = e.id ' .
				'JOIN ' . PREFIX . '_clients AS f ON a.clients_id = f.id SET ' .
                implode(', ', $fields) . ' ' .
                'WHERE a.id = ' . intval($id);
        $db->query($sql);

        $this->updateItems($id, $data['items']);

		if ($data['payment_types_id'] == '1') {
	        $PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);
    	    $PolicyPaymentsCalendar->updateCalendar($id);
		}
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization;

        $data['step'] = 1;

        $data['agencies_id']	= AGENCIES_EXPRESS_INSURANCE;
        $data['agents_id']      = 3172;

        $data['clients_id']			= $Authorization->data['clients_id'];
        $data['client_contacts_id']	= $Authorization->data['id'];

        $data['policies_id'] = parent::insert(&$data, false, false);

        if ($data['policies_id']) {

            $this->setAdditionalFields($data['policies_id'], $data);
			$this->generateDocuments($data['id']);

            $params['title']	= $this->messages['single'];
            $params['id']       = $data['policies_id'];
            $params['storage']	= $this->tables[0];

            $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

            if ($redirect) {
                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|' . $this->mode . 'Documents&policies_id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['policies_id'];
            }
        } elseif ($showForm)  {
            $this->showForm($data, $GLOBALS['method'], 'insert');
        }
    }

    function prepareFields($action, &$data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        $conditions[] = 'a.policies_id = ' . intval($data['id']);

        switch ($data['item_types_id']) {
            case 1:
            case 3:
            case 4:
		    case 5:
                $sql =  'SELECT a.*, date_format(a.document_date, ' . $db->quote(DATE_FORMAT) . ') as document_date ' .
                        'FROM ' . PREFIX . '_policies_cargo_items AS a ' .
                        'WHERE ' . implode(' AND ', $conditions);
                break;
            case 2:
                $conditions[] = 'c.product_types_id = 3';
                $sql =  'SELECT a.*, date_format(a.document_date, ' . $db->quote(DATE_FORMAT) . ') as document_date, b.car_types_id ' .
                        'FROM ' . PREFIX . '_policies_cargo_items AS a ' .
                        'LEFT JOIN ' . PREFIX . '_car_type_car_model_assignments AS b ON a.models_id = b.car_models_id ' .
                        'LEFT JOIN ' . PREFIX . '_car_types AS c ON b.car_types_id = c.id ' .
                        'WHERE ' . implode(' AND ', $conditions);
                break;
        }
        $data['items'] = $db->getAll($sql);

        return $data;
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log;

        $data['step'] = 1;

        $data['policies_id'] = parent::update(&$data, false, false);

        if ($data['policies_id']) {

            $this->setAdditionalFields($data['policies_id'], $data);

            $this->updateStep($data['policies_id'], $data['step'] + 1);
			
			$this->generateDocuments($data['id']);

            $params['title']	= $this->messages['single'];
            $params['id']       = $data['policies_id'];
            $params['storage']	= $this->tables[0];

            $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

            if ($redirect) {
                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|' . $this->mode . 'Documents&policies_id=' . $data['policies_id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
        } elseif ($showForm) {
            $this->showForm($data, $GLOBALS['method'], 'update');
        }
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log, $Authorization;

        $conditions[] = 'payment_statuses_id <> ' . PAYMENT_STATUSES_NOT;

		if ($Authorization->data['id'] != 3531) {//даем Глушак удалять сертификаты, что были внесены задними числами
			$conditions[] = '(policy_statuses_id = ' . POLICY_STATUSES_GENERATED . ' AND begin_datetime < NOW())';
		}

        $sql =	'SELECT id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE id IN(' . implode(', ', $data['id']) . ') AND (' . implode(' OR ', $conditions) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Вилучити можливо лише сертифікати за які не було отримано грошову винагороду та які не вступили в силу.');
            return false;
        }

        $sql =  'DELETE FROM ' . PREFIX . '_policies_cargo_items ' .
                'WHERE policies_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        return parent::deleteProcess($data, $i, $folder);
    }

    function get($id) {
        global $db;

        $sql =	'SELECT * ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_cargo AS b ON a.id = b.policies_id ' .
                'WHERE a.id = ' . intval($id);
        $row = $db->getRow($sql);

        return $row;
    }

	function isPayed($id) {
		$payment_statuses_id = Certificates::getpayment_statuses_id($id);

		return $this->isPayedBypayment_statuses_id($payment_statuses_id);
	}

    function prepareValues($fields, $values) {
        global $REGIONS;

        foreach ($fields as $field) {
            switch ($field) {
                case 'insurer_address':
                    $values[ $field ] = Regions::getTitle($values['insurer_regions_id']);

                    if (!in_array($values['insurer_regions_id'], $REGIONS)) {
                        $values[ $field ] .= ', ' .$values['owner_city'];
                    }

                    $values[ $field ] .=  ', ' . StreetTypes::getTitle($values['insurer_street_types_id']) . ' ' . $values['insurer_street'] . ', буд. ' . $values['insurer_house'];

                    if ($values['insurer_flat']) {
                        $values[ $field ] .= ', оф. ' . $values['insurer_flat'];
                    }
                    break;
				case 'insurer_addressEn':
                    //$values[ $field ] = Regions::getTitle($values['insurer_regions_id'], 'En');

                    //if (!in_array($values['insurer_regions_id'], $REGIONS)) {
                        $values[ $field ] .= ' ' .$values['insurer_city_en'];
                    //}

                    //$values[ $field ] .=  ', ' . StreetTypes::getTitle($values['insurer_street_types_id'], 'En') . ' ' . $values['insurer_street_en'] . ', ' . $values['insurer_house'];
                    $values[ $field ] .=  ', ' . $values['insurer_street_en'] . ', ' . $values['insurer_house'];
                    
					if ($values['clientsRegistrationStreetEn'])
						$values[ $field ] .=  ', ' . $values['clientsRegistrationStreetEn'] ;
					if ($values['clientsRegistrationHouse'])
						$values[ $field ] .=', ' . $values['clientsRegistrationHouse'];

                    if ($values['insurer_flat']) {
                        $values[ $field ] .= ', ste ' . $values['insurer_flat'];
                    }
                    break;
            }
        }

        return $values;
    }

    function getValues($file) {
        global $db;

        $sql =  'SELECT a.*, b.*, c.*, ' .
				'c.price_percent, ROUND((b.price * c.price_percent) / 100, 2) AS priceAmount, ROUND((c.price_usd * c.price_percent) / 100, 2) AS priceAmountUSD, ' .
                'd.number as general_number, d.date as generalDate, ' .
                'd.number as general_number, d.date as generalDate, ' .
                'e.lastname as generalLastname, e.firstname as generalFirstname, e.patronymicname as generalPatronymicname, e.lastname_en as generalLastnameEn, e.firstname_en as generalFirstnameEn, e.patronymicname_en as generalPatronymicnameEn,e.position as generalPosition, e.position_en as generalPositionEn, e.ground as generalGround, e.ground_en as generalGroundEn, ' .
				'c.owner_company  as clientsCompany,c.owner_company_en  as clientsCompanyEn ' .
                'FROM ' . PREFIX . '_policy_documents AS a ' .
                'JOIN ' . $this->tables[0] . ' AS b ON a.policies_id = b.id ' .
                'JOIN ' . $this->tables[1] . ' AS c ON b.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_policies AS d ON c.policies_general_id = d.id ' .
                'JOIN ' . PREFIX . '_policies_cargo_general AS e ON d.id = e.policies_id ' .
                'WHERE a.id=' . intval($file['id']);
        $row = $db->getRow($sql);

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies_cargo_items ' .
                'WHERE policies_id = ' . intval($row['policies_id']);
        $row['items'] = $db->getAll($sql);

		foreach ($row['items'] as $i => $item) {
			if ($item['send_en'] || $item['sender_en'] || $item['destination_en'] || $item['recipient_en']) {
				$row['En'] = 1;//включить англ язык
			}
		}
		$row['amount_usd']= round($row['amount_usd'] * $row['price_percent'] / 100, 2);
		//$row['priceAmountUSD'] = round($row['priceAmountUSD'] * $row['price_percent'] / 100, 2);

        $sql =  'SELECT title, title_en ' .
                'FROM ' . PREFIX . '_parameters_risks AS a ' .
                'JOIN ' . PREFIX . '_policy_risks AS b ON a.id = b.risks_id ' .
                'WHERE policies_id = ' . intval($row['policies_general_id']);
        $res = $db->query($sql);

		while ($res->fetchInto($risk)) {
			$row['risks'][]		= $risk['title'];
			$row['risksEn'][]	= $risk['title_en'];
		}

		$row['risks'] = '<ul><li>' . implode('</li><li>', $row['risks']) . '</li>'.($row['policies_general_id']==36077 ? '<li>З вiдповiдальнiстю за всi ризики</li>' : '').'</ul>';
		$row['risksEn'] = '<ul><li>' . implode('</li><li>', $row['risksEn']) . '</li>'.($row['policies_general_id']==36077 ? '<li>Institute cargo all risks S.R. and C.C. and N.D.</li>' : '').'</ul>';

        $fields = array(
            'insurer_address',
			'insurer_addressEn');

        return $this->prepareValues($fields, $row);
    }

    function downloadFileInWindow($data) {
        global $db;

        $policy = unserialize($data['file']);

        $conditions[] = 'policies_id = ' . intval($policy['id']);
        $conditions[] = 'product_document_types_id = ' . DOCUMENT_TYPES_POLICY_CARGO_CERTIFICATEE;

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_policy_documents ' .
                'WHERE ' . implode(' AND ', $conditions);
        $row =  $db->getRow($sql);

        $file = array(
            'id'            => $row['id'],
            'position'      => 4,
            'languageCode'  => '');

        $data['file'] = serialize($file);

        $PolicyDocuments = new PolicyDocuments($data);
        $PolicyDocuments->downloadFileInWindow($data);
    }

    function getPolicyByDocument($clients_id, $document_number,$document_date) {
        global $db;

        $conditions[] = 'clients_id = ' . intval($clients_id);
        $conditions[] = 'document_number = ' . $db->quote($document_number);
		$conditions[] = 'document_date = ' . $db->quote($document_date);

        $sql =  'SELECT a.id, a.policy_statuses_id ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_cargo_items AS b ON a.id = b.policies_id ' .
                'WHERE ' . implode(' AND ', $conditions);
        return $db->getRow($sql);
    }

    function downloadLogInWindow($data) {
        $result = implode("\r\n", unserialize($_SESSION['certificates']['cargo']));

        header('Content-Disposition: attachment; filename="log.csv"');
        header('Content-Type: ' . $this->getContentType('log.csv'));
        header('Content-Length: ' . strlen($result));

        echo $result;
        exit;
    }

	function getExcelDate($exceldate) {
		$data['date_day']	= substr($exceldate, 0, 2);
        $data['date_month']	= substr($exceldate, 3, 2);
        $data['date_year']	= substr($exceldate, 6, 4);

		return date('d/m/Y',mktime (0, 0, 0,  $data['date_month'], $data['date_day'],$data['date_year'] )-86400);
	}
	
	function importExcel($data) {
		global $Log, $Authorization,$db;

		require_once 'Excel/reader.php';

		$Excel = new Spreadsheet_Excel_Reader();
		$Excel->setOutputEncoding(CHARSET);
		$Excel->read($_FILES['file']['tmp_name']);

		$i1 = 1;
		$temp1 = mktime(0, 0, 0, 11, 1, 2010);

		//while (mktime(0, 0, 0, 11, $i1, 2010) < mktime(0, 0, 0, 4, 1, 2011) ) {

			$j=1;
			for ($i = 1; $i < 30; $i++) {

				$colname = $Excel->sheets[0]['cells'][ $j ][$i];

				if ($colname=='Найменування') $cols['Найменування']=$i;
				if ($colname=='ТТН, дата') $cols['ТТН, дата']=$i;
				if ($colname=='ТТН, номер') $cols['ТТН, номер']=$i;
				if ($colname=='Пункт відправлення') $cols['Пункт відправлення']=$i;
				if ($colname=='Пункт призначення') $cols['Пункт призначення']=$i;
				if ($colname=='Відправник') $cols['Відправник']=$i;
				if ($colname=='Експедитор, перевізник') $cols['Експедитор, перевізник']=$i;
				if ($colname=='Отримувач') $cols['Отримувач']=$i;
				if ($colname=='Вартість, грн.') $cols['Вартість, грн.']=$i;
				if ($colname=='Дата заключення') $cols['Дата заключення']=$i;
				if ($colname=='Дата початку дії') $cols['Дата початку дії']=$i;
				if ($colname=='Дата закінчення дії') $cols['Дата закінчення дії']=$i;
				if ($colname=='марка') $cols['марка']=$i;
				if ($colname=='модель') $cols['модель']=$i;
				if ($colname=='вин-код авто') $cols['вин-код авто']=$i;
				if ($colname=='Вигодонабувач') $cols['Вигодонабувач']=$i;
				if ($colname=='Умови поставки') $cols['Умови поставки']=$i;
				if ($colname=='Місце тимчасового складування') $cols['Місце тимчасового складування']=$i;
				if ($colname=='Вид транспортування') $cols['Вид транспортування']=$i;
			}

			$data['policies_general_id'] = Certificates::getPoliciesGeneralByClients(PRODUCT_TYPES_CARGO_GENERAL, $Authorization->data['clients_id'],null,true);

			if (!intval($data['policies_general_id'])) {
				$Log->add('error', 'Не завели генеральний договір.');

				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Policies|show&product_types_id=' . $data['product_types_id']);
				exit;
			}

			$idx = 0;
			for ($i=2; $i<=$Excel->sheets[0]['numRows']; $i++) {

				/*if ($Excel->sheets[0]['cells'][ $i ][ $cols['Дата заключення'] ] != date('d/m/Y', mktime(0, 0, 0, 11, $i1, 2010))   ) {
					continue;
				}*/

				$sql =	'SELECT a.id AS brands_id, b.id AS models_id, c.car_types_id ' .
						'FROM ' . PREFIX . '_car_brands AS a ' .
						'JOIN ' . PREFIX . '_car_models AS b ON a.id = b.car_brands_id ' .
						'JOIN ' . PREFIX . '_car_type_car_model_assignments AS c ON b.id = c.car_models_id ' .
						'WHERE a.title = ' . $db->quote($Excel->sheets[0]['cells'][ $i ][$cols['марка']]) . ' AND b.title = ' . $db->quote($Excel->sheets[0]['cells'][ $i ][$cols['модель']]) . ' ' .
						'LIMIT 1';
				$car = $db->getRow($sql);

				if (strlen($Excel->sheets[0]['cells'][ $i ][$cols['ТТН, номер']]) == 0) {
					continue;
				}

				$data['clients_id']							= $Authorization->data['clients_id'];
				$data['item_types_id']						= 2;

				$data['items'][ $idx ]['quantity']			= 0;
				$data['items'][ $idx ]['price']				= $Excel->sheets[0]['cells'][ $i ][$cols['Вартість, грн.']];
				$data['items'][ $idx ]['shassi']          	= $Excel->sheets[0]['cells'][ $i ][$cols['вин-код авто']];
				
				$data['items'][ $idx ]['document_number'] 	= $Excel->sheets[0]['cells'][ $i ][$cols['ТТН, номер']];
				$data['items'][ $idx ]['document_date']   	= $this->getExcelDate($Excel->sheets[0]['cells'][ $i ][$cols['ТТН, дата']]);
				$data['items'][ $idx ]['send']           	= $Excel->sheets[0]['cells'][ $i ][$cols['Пункт відправлення']];
				$data['items'][ $idx ]['sender']         	= $Excel->sheets[0]['cells'][ $i ][$cols['Відправник']];
				$data['items'][ $idx ]['destination']    	= $Excel->sheets[0]['cells'][ $i ][$cols['Пункт призначення']];
				$data['items'][ $idx ]['recipient']      	= $Excel->sheets[0]['cells'][ $i ][$cols['Отримувач']];

				if ($car['brands_id']) {
					$data['items'][ $idx ]['brands_id']      = $car['brands_id'];
				}

				if ($car['brands_id']) {
					$data['items'][ $idx ]['models_id']      = $car['models_id'];
				}

				if ($car['car_types_id']) {
					$data['items'][ $idx ]['car_types_id']	= $car['car_types_id'];
				}

				$data['transportation_company'] = $Excel->sheets[0]['cells'][ $i ][$cols['Експедитор, перевізник']];

				if ($cols['Номер авто']) {
					$data['sign_car'] = $Excel->sheets[0]['cells'][ $i ][$cols['Номер авто']];
				}

				if ($cols['Номер прицепа']) {
					$data['sign_trailer'] = $Excel->sheets[0]['cells'][ $i ][$cols['Номер прицепа']];
				}

				$data['recipient']				= $Excel->sheets[0]['cells'][ $i ][$cols['Отримувач']];

				$data['date_day']               = substr($this->getExcelDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата заключення']]), 0, 2);
				$data['date_month']             = substr($this->getExcelDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата заключення']]), 3, 2);
				$data['date_year']              = substr($this->getExcelDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата заключення']]), 6, 4);

				$data['begin_datetime_day']     = substr($this->getExcelDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата початку дії']]), 0, 2);
				$data['begin_datetime_month']   = substr($this->getExcelDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата початку дії']]), 3, 2);
				$data['begin_datetime_year']    = substr($this->getExcelDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата початку дії']]), 6, 4);
				$data['document_date']  		= substr($data['items'][$idx]['document_date'], 6, 4).'-'.substr($data['items'][$idx]['document_date'], 3, 2).'-'.substr($data['items'][$idx]['document_date'], 0, 2);

				$data['end_datetime_day']       = substr($this->getExcelDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата закінчення дії']]), 0, 2);
				$data['end_datetime_month']     = substr($this->getExcelDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата закінчення дії']]), 3, 2);
				$data['end_datetime_year']      = substr($this->getExcelDate($Excel->sheets[0]['cells'][ $i ][$cols['Дата закінчення дії']]), 6, 4);
				
				$data['assured']				= $Excel->sheets[0]['cells'][ $i ][$cols['Вигодонабувач']];
				$data['shipping']				= $Excel->sheets[0]['cells'][ $i ][$cols['Умови поставки']];
				$data['temporary_storage']		= $Excel->sheets[0]['cells'][ $i ][$cols['Місце тимчасового складування']];

				$policy = $this->getPolicyByDocument($Authorization->data['clients_id'], $data['items'][$i]['document_number'], $data['document_date']);

				$data['id'] = $policy['id'];
				$data['delivery_ways_id'] = array(4);
				$idx++;
			}

			switch ($policy['policy_statuses_id']) {
				case POLICY_STATUSES_CREATED:
					($this->update($data, false, false)) ? $updated++ : $error++;
					break;
				default:
					if ($policy['policy_statuses_id']) {
						$Log->add('error', 'ТТН з номером <b>' . $data['items'][0]['document_number'] . '</b> вже обробляється.');
						$error++;
					} else {
						($this->insert($data, false, false)) ? $inserted++ : $error++;
					}
			}

			$status     = array();
			$messages   = $Log->get();

			if (is_array($messages)) {
				foreach ($messages as $message) {
					$status[ $message['type'] ][] = $message['text'];
				}

				$status['title']    = (is_array($status['error'])) ? 'Помилка' : 'Оброблено';
				$status['details']  = (is_array($status['error'])) ? implode(', ', $status[ 'error' ]) : implode(', ', $status[ 'confirm' ]);
			}

			$result[] =  $status['title'] . ';' . strip_tags($status['details']);
			$total++;
//_dump($result);exit;
			$_SESSION['certificates']['cargo'] = serialize($result);

			$i1++;

			$data = array('process' => 1, 'product_types_id' => 9);
		//}

		$Log->add('confirm', '<b>Файл був оброблений.</b><br /><br /><table><tr><td>Створено:</td><td align="right">' . $inserted . '</td></tr><tr><td>Редаговано:</td><td align="right">' . $updated . '</td></tr><tr style="color: #ffffff; font-weight: bold;"><td>Помилки:</td><td align="right">' . $error . '</td></tr><tr style="font-weight: bold;"><td>Всього:</td><td align="right">' . $total . '</td></tr></table><br /><a href="?do=' . $this->object . '|downloadLogInWindow&product_types_id=' . $data['product_types_id'] . '">Скачати</a> лог файл.' , $params);

		header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
		exit;
	}
	
    function import($data) {
        global $Log, $Authorization;

		//$this->checkPermissions('import', $data, $Authorization->data['clients_id'] != CLIENTS_KGC);

        $titles = array(
            'Найменування',
            'Кількість місць, шт.',
            'Упаковка',
            'Вага, кг.',
            'Вартість, грн.',
            'ТТН, номер',
            'ТТН, дата',
            'Пункт відправлення',
            'Відправник',
            'Пункт призначення',
            'Отримувач',
            'Експедитор, перевізник',
            'Номер авто',
            'Номер прицепа',
            'Дата заключення',
            'Дата початку дії',
            'Дата закінчення дії');

        $itemTypes = array_flip($this->formDescription['fields'][ $this->getFieldPositionByName('item_types_id') ]['list']);

        if ($data['process']) {
            $params = array('Файл', $languageDescription);
            if (!is_uploaded_file($_FILES['file']['tmp_name']) || ereg('\.xls$', $_FILES['file']['name'])) {

				if (ereg('\.xls$', $_FILES['file']['name'])) {
					$this->importExcel($data);
					return;
				}

                $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
            }

            $data['policies_general_id'] = Certificates::getPoliciesGeneralByClients(PRODUCT_TYPES_CARGO_GENERAL, $Authorization->data['clients_id'],null,true);
            if (!intval($data['policies_general_id'])) {
                $Log->add('error', 'Не завели генеральний договір.');

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Policies|show&product_types_id=' . $data['product_types_id']);
                exit;
            }

            if (!$Log->isPresent()) {

                $file = fopen($_FILES['file']['tmp_name'], 'r');

                //$columns = fgetcsv($file, 1000, ';');
				$columns = trim(fgets ($file, 1000 ));
				$columns = explode ( ';' , $columns);

                //убираем символ, признак кодировки
                $columns[0] = substr($columns[0], 3);

                if (sizeOf(array_diff($titles, $columns))) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                    fclose($file);
                } else {
                    $result= array(implode($columns, ';') . ';Статус;Деталі');

                    $columns = array_flip($columns);

                    $inserted   = 0;
                    $updated    = 0;
                    $error      = 0;
                    $total      = 0;

                    while (($row = fgets($file, 1000)) !== FALSE) {
						$row = trim($row);
						$row = explode ( ';' , $row);
						$data['clients_id']					= $Authorization->data['clients_id'];

                        $data['item_types_id']                = $itemTypes[ $row[ $columns['Найменування'] ] ];

                        $data['items'][0]['quantity']       = $row[ $columns['Кількість місць, шт.'] ];
                        $data['items'][0]['packing']        = $row[ $columns['Упаковка'] ];
                        $data['items'][0]['weight']         = $row[ $columns['Вага, кг.'] ];
                        $data['items'][0]['price']          = $row[ $columns['Вартість, грн.'] ];
                        $data['items'][0]['document_number'] = $row[ $columns['ТТН, номер'] ];
                        $data['items'][0]['document_date']   = $row[ $columns['ТТН, дата'] ];
                        $data['items'][0]['send']           = $row[ $columns['Пункт відправлення'] ];
                        $data['items'][0]['sender']         = $row[ $columns['Відправник'] ];
                        $data['items'][0]['destination']    = $row[ $columns['Пункт призначення'] ];
                        $data['items'][0]['recipient']      = $row[ $columns['Отримувач'] ];

                        $data['transportation_company']      = $row[ $columns['Експедитор, перевізник'] ];
                        $data['sign_car']                    = $row[ $columns['Номер авто'] ];
                        $data['sign_trailer']                = $row[ $columns['Номер прицепа'] ];
                        $data['recipient']                  = $row[ $columns['Отримувач'] ];

                        $data['date_day']                    = substr($row[ $columns['Дата заключення'] ], 0, 2);
                        $data['date_month']                  = substr($row[ $columns['Дата заключення'] ], 3, 2);
                        $data['date_year']                   = substr($row[ $columns['Дата заключення'] ], 6, 4);

                        $data['begin_datetime_day']           = substr($row[ $columns['Дата початку дії'] ], 0, 2);
                        $data['begin_datetime_month']         = substr($row[ $columns['Дата початку дії'] ], 3, 2);
                        $data['begin_datetime_year']          = substr($row[ $columns['Дата початку дії'] ], 6, 4);
						$data['document_date']  				= substr($data['items'][0]['document_date'], 6, 4).'-'.substr($data['items'][0]['document_date'], 3, 2).'-'.substr($data['items'][0]['document_date'], 0, 2);

                        $data['end_datetime_day']             = substr($row[ $columns['Дата закінчення дії'] ], 0, 2);
                        $data['end_datetime_month']           = substr($row[ $columns['Дата закінчення дії'] ], 3, 2);
                        $data['end_datetime_year']            = substr($row[ $columns['Дата закінчення дії'] ], 6, 4);

                        $policy = $this->getPolicyByDocument($Authorization->data['clients_id'], $data['items'][0]['document_number'],$data['document_date']);

                        $data['id'] = $policy['id'];

						$data['delivery_ways_id'] = array(DELIVERY_WAYS_AUTO);

                        switch ($policy['policy_statuses_id']) {
                            case POLICY_STATUSES_CREATED:
                                ($this->update($data, false, false)) ? $updated++ : $error++;
                                break;
                            default:
                                if ($policy['policy_statuses_id']) {
                                    $Log->add('error', 'ТТН з номером <b>' . $data['items'][0]['document_number'] . '</b> вже обробляється.');
                                    $error++;
                                } else {
                                    ($this->insert($data, false, false)) ? $inserted++ : $error++;
                                }
                        }

                        $status     = array();
                        $messages   = $Log->get();

                        if (is_array($messages)) {
                            foreach ($messages as $message) {
                                $status[ $message['type'] ][] = $message['text'];
                            }

                            $status['title']    = (is_array($status['error'])) ? 'Помилка' : 'Оброблено';
                            $status['details']  = (is_array($status['error'])) ? implode(', ', $status[ 'error' ]) : implode(', ', $status[ 'confirm' ]);
                        }

                        $result[] = implode($row, ';') . ';' . $status['title'] . ';' . strip_tags($status['details']);
                        $total++;
                    }

                    fclose($file);
                    $_SESSION['certificates']['cargo'] = serialize($result);

                    $Log->add('confirm', '<b>Файл був оброблений.</b><br /><br /><table><tr><td>Створено:</td><td align="right">' . $inserted . '</td></tr><tr><td>Редаговано:</td><td align="right">' . $updated . '</td></tr><tr style="color: #ffffff; font-weight: bold;"><td>Помилки:</td><td align="right">' . $error . '</td></tr><tr style="font-weight: bold;"><td>Всього:</td><td align="right">' . $total . '</td></tr></table><br /><a href="?do=' . $this->object . '|downloadLogInWindow&product_types_id=' . $data['product_types_id'] . '">Скачати</a> лог файл.' , $params);

                    header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show&product_types_id=' . $data['product_types_id']);
                    exit;
                }
            }
        }

        unset($_SESSION['certificates']['cargo']);

        $Log->showSystem();

        include_once $this->object . '/importCertificate.php';
    }

	function exportInWindow($data) {
		global $db, $Authorization, $Smarty;

		require_once $Smarty->_get_plugin_filepath('shared','make_timestamp');

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        $this->show($data, null, null, null, 'exportCargo.php', false);
		exit;
    }
	
	function exportListInWindow($data) {
		global $db;

		$data['special_form'] = 1;
		
		if ($data['number']) {
			$sql = 'SELECT a.date as policies_date, b.*, c.title as registration_street_types_title, d.title as habitation_street_types_title ' .
				   'FROM ' . PREFIX . '_policies as a ' .
				   'JOIN ' . PREFIX . '_clients as b ON a.clients_id = b.id ' .
				   'JOIN ' . PREFIX . '_street_types as c ON b.registration_street_types_id = c.id ' .
				   'JOIN ' . PREFIX . '_street_types as d ON b.habitation_street_types_id = d.id ' .
				   'WHERE a.number = ' . $db->quote($data['number']);
			$data['insurer_info'] = $db->getRow($sql);
		}
		$this->exportInWindow($data);
    }
	
	/* Export 1C7.7. */
    function getXML($data) {
        global $db, $Smarty;

        if ($data['number']) {
            $conditions[] = 'a.number=' . $db->quote(trim($data['number']));
        } else {
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.date )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.date )>=TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.date )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.date ) <= TO_DAYS(NOW())';

			$conditions[] = '(a.policy_statuses_id = ' . POLICY_STATUSES_GENERATED . ' )';
			$conditions[] = '(q1.payment_types_id>0)'; //брать только с индивидуальной оплатой
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
				'w.person_types_id  as person_types_id,  '.
                'd.title AS insurerRegionsTitle,  ' .
				'd.id AS insurer_regions_id,  ' .
                'q.number AS general_number, w.company, w.identification_code as edrpou, w.registration_street_types_id as insurer_street_types_id, w.registration_area as insurer_area, w.registration_city as insurer_city, w.registration_street as insurer_street, w.registration_house as insurer_house, w.registration_flat as insurer_flat, '.
				'w.company as assured_title ,w.identification_code as assured_identification_code '.
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_cargo AS b ON b.policies_id=a.id ' .
                'JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id=c.id ' .
				'JOIN ' . PREFIX . '_policies  AS q ON q.id=b.policies_general_id  ' .
				'JOIN ' . PREFIX . '_policies_cargo_general  AS q1 ON q1.policies_id =b.policies_general_id  ' .
				'JOIN ' . PREFIX . '_clients  AS w ON w.id=q.clients_id   ' .				
				'LEFT JOIN ' . PREFIX . '_regions AS d ON w.registration_regions_id=d.id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        foreach ($list as $i => $row) {
            $sql =  'SELECT date AS payment_date, amount AS payment_amount ' .
                    'FROM ' . PREFIX . '_policy_payments_calendar ' .
                    'WHERE policies_id = ' . intval($row['policies_id']);
            $list[ $i ]['paymentsCalendar'] = $db->getAll($sql);

            $fields = array('insurer_address');

            $row = $this->prepareValues($fields, $row);

            $list[$i]['insurer_address'] = $row['insurer_address'];

            $sql =  'SELECT a.* ' .
					'FROM ' . PREFIX . '_policies_cargo_items AS a '.
                    'WHERE a.policies_id=' . intval($row['policies_id']);
            $list[$i]['items'] = $db->getAll($sql);
        }

        $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/cargo.xml');
    }

    function getShowFieldsSQLString() {
        $result = parent::getShowFieldsSQLString();

        $result .= ', '.PREFIX.'_policies_cargo.comment,delivery_ways_title,rate ';

        return $result;
    }

    function getSearchInWindow($data) {
        global $db;

        if ($data['number']) {
            //$conditions[] = 'policies.number LIKE \'%' . $data['number'] . '%\'';
            $conditions[] = 'policies.number = ' . $db->quote($data['number']);
        } else {
            $conditions[] = '\'' .  date('Y-m-d', strtotime($data['datetime'])) . '\' BETWEEN getPolicyDate(policies.number, 2) AND getPolicyDate(policies.number, 3)';
        }

        if ($data['insurer_lastname']) {
            $conditions[] = 'policies.insurer LIKE ' . $db->quote('%' . $data['insurer_lastname'] . '%');
        }

        if($data['items_id'] && !intval($data['one_shipping'])){
            $conditions[] = 'policies_cargo_items.id = ' . intval($data['items_id']);
        }

        $result = '<table width="100%" cellpadding="0" cellspacing="0">' .
                    '<tr class="columns">' .
                        '<td class="id">&nbsp;</td>' .
                        '<td>Страхувальник</td>' .
                        '<td>Номер</td>' .
                        '<td>Найменування</td>' .
                        '<td>Дата</td>' .
                        '<td>Початок</td>' .
                        '<td>Закінчення</td>' .
                    '</tr>';

        if(!$data['datetime'] || !checkdate(substr($data['datetime'], 3, 2), substr($data['datetime'], 0, 2), substr($data['datetime'], 6, 4))) {
            $result .= '<tr><td colspan="7" align="center" style="color: red;">Дата події обов\'язкова для заповнення.</td></tr>';
            $result .= '</table>';
            echo $result;
            return;
        }

        if (!$conditions) {
            $result .= '<tr><td colspan="7" align="center" style="color: red;">Не задали жодного критерію пошуку.</td></tr>';
            $result .= '</table>';
            echo $result;
            exit;
        }

		if (intval($data['one_shipping'])) {
			$sql = 'SELECT policies.product_types_id, policies.id as policies_id, policies.id as items_id, IF(one_shipping.insurer_person_types_id = 1, CONCAT_WS(\' \', one_shipping.insurer_lastname, one_shipping.insurer_firstname, one_shipping.insurer_patronymicname), one_shipping.insurer_company) as insurer, ' .
						'policies.number, one_shipping.cargo_name, date_format(getPolicyDate(policies.number, 1), \'%d.%m.%Y\') as date_format, ' .
						'date_format(getPolicyDate(policies.number, 2), \'%d.%m.%Y\') as begin_datetime_format,  date_format(policies.interrupt_datetime, \'%d.%m.%Y\') as interrupt_datetime_format ' .
					'FROM ' . PREFIX . '_policies as policies ' .
					'JOIN ' . PREFIX . '_policies_one_shipping as one_shipping ON policies.id = one_shipping.policies_id ' .
					'WHERE ' . implode(' AND ', $conditions) . ' ' .
					'ORDER BY policies.begin_datetime DESC';
		} else {
			$sql = 'SELECT policies.product_types_id, policies.id as policies_id, policies_cargo_items.id as items_id, policies.product_types_id, policies_general.insurer, policies.number, date_format(getPolicyDate(policies.number, 1), \'%d.%m.%Y\') as date_format, ' .
						'date_format(getPolicyDate(policies.number, 2), \'%d.%m.%Y\') as begin_datetime_format,  date_format(getPolicyDate(policies.number, 3), \'%d.%m.%Y\') as interrupt_datetime_format, ' .
						'policies_cargo.item_types_id, CONCAT(policies_cargo_items.brand, \'/\', policies_cargo_items.model) AS item, policies_cargo_items.shassi, ' .
						'policies_cargo_items.document_number ' .
				   'FROM ' . PREFIX . '_policies as policies ' .
				   'JOIN ' . PREFIX . '_policies_cargo as policies_cargo ON policies.id = policies_cargo.policies_id ' .
				   'JOIN ' . PREFIX . '_policies_cargo_items as policies_cargo_items ON policies.id = policies_cargo_items.policies_id ' .
				   'JOIN ' . PREFIX . '_policies_cargo_general as policies_cargo_general ON policies_cargo.policies_general_id = policies_cargo_general.policies_id ' .
				   'JOIN ' . PREFIX . '_policies as policies_general ON policies_cargo_general.policies_id = policies_general.id ' .
				   'WHERE ' . implode(' AND ', $conditions) . ' ' .
				   'ORDER BY policies.begin_datetime DESC';			
		}
		$list = $db->getAll($sql);
//_dump($sql);
        switch (sizeOf($list)) {
            case 0:
                $result .= '<tr><td colspan="7" align="center" style="color: red;">Згідно заданних критеріїв пошуку поліс не знайдено.</td></tr>';
                $result .= '</table>';
                break;
			default:
                $this->mode = Accidents::getMode($data['accidents_id']);

                $result = '<table width="100%" cellpadding="0" cellspacing="0">' .
                            '<tr class="columns">' .
                                '<td class="id">&nbsp;</td>' .
                                '<td>Страхувальник</td>' .
                                '<td>Номер</td>' .
                                '<td>Найменування</td>' .
                                ($list[0]['item_types_id'] == 2 ?
                                '<td>ТЗ</td>' .
                                '<td>Шасі</td>'
                                : '') .
                                (!intval($data['one_shipping']) ? '<td>ТТН</td>' : '') .
                                '<td>Дата</td>' .
                                '<td>Початок</td>' .
                                '<td>Закінчення</td>' .
                            '</tr>';

                foreach ($list as $row) {
                    $result .=  '<tr>' .
                                    '<td align="center"><input type="radio" name="items_id" value="' . $row['items_id'] . '" ' . ( ($row['items_id'] == $data['items_id']) ? 'checked' : '') . ' onclick="choosePolicy(' . $row['policies_id'] . ')" ' . $this->getReadonly(true) . ' /></td>' .
                                    '<td>' . $row['insurer'] . '</td>' .
                                    '<td><a href="/?do=Policies|view&id=' . $row['policies_id'] . '&product_types_id=' . $row['product_types_id'] . '" target="_blank">' . (($data['important_person'] == 0) ? $row['number'] : $row['number'] . ' <b style="color: red;">VIP</b>') . '</a></td>' .
                                    '<td>' . (intval($data['one_shipping']) ? $row['cargo_name'] : $this->getItemTypesTitle($row['item_types_id'])) . '</td>' .
                                    ($list[0]['item_types_id'] == 2 ?
                                        '<td>' . $row['item'] . '</td>' .
                                        '<td>' . $row['shassi'] . '</td>'
                                    : '') .
                                    (!intval($data['one_shipping']) ? '<td>' . $row['document_number'] . '</td>' : '') .
                                    '<td>' . $row['date_format'] . '</td>' .
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
				$result .= '<input type="hidden" id="policies_product_types_id" name="policies_product_types_id" value="' . $list[0]['product_types_id'] . '" />';
                break;
        }

        echo $result;
    }

    function getItemTypesTitle ($item_types_id) {
        $item_types_titles = array(
            1 => 'Автомобільні запчастини, масла, аксесуари',
            2 => 'Автомобіль',
            3 => 'Автомобільні запчастини',
            4 => 'Машинокомплекти');

        return $item_types_titles[$item_types_id];
    }

    function getRisksInWindow($data) {
        global $db;

        $conditions[] = 'c.policies_id = ' . intval($data['id']);

		if (intval($data['one_shipping'])) {
			
			$sql = 'SELECT a.id, a.title ' .
				   'FROM ' . PREFIX . '_parameters_property a '  .				   
				   'WHERE a.types_id = 10';
			$list = $db->getAll($sql);
			$sql = 'SELECT values_id FROM ' . PREFIX . '_policies_values_assignments WHERE policies_id = ' . intval($data['id']);
			$in_policies = $db->getCol($sql);
			
			$select = '<select multiple size="3" disabled>';
			foreach ($list as $row) {
				$select .= '<option ' . (in_array($row['id'], $in_policies) ? 'selected' : '') . '>' . $row['title'] . '</option>';
			}
			$select .= '</select>';
			
			$result = '<table><tr><td>Умови страхування:</td><td>'.$select.'</td></tr></table>';
			echo $result;
			exit;
		
		} else {
			$sql =	'SELECT a.risks_id, b.title ' .
					'FROM ' . PREFIX . '_policy_risks AS a ' .
					'JOIN ' . PREFIX . '_parameters_risks AS b ON a.risks_id = b.id ' .
					'JOIN ' . PREFIX . '_policies_cargo AS c ON a.policies_id = c.policies_general_id ' .
					'WHERE ' . implode(' AND ', $conditions);
		}
        $list = $db->getAll($sql);

        $this->mode = Accidents::getMode($data['accidents_id']);

        include_once $this->object . '/risksInWindow.php';
        exit;
    }

}
?>