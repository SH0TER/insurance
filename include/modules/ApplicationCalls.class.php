<?
/*
 * Title: application call class
 *
 */

require_once 'CarTypes.class.php';
require_once 'CarBrands.class.php';
require_once 'CarModels.class.php';
require_once 'CarServices.class.php';

class ApplicationCalls extends Form {

    var $life_damage_id = array(
        1 => "Тимчасова втрата працездатності(травма)",
        2 => "Стійка втрата працездатності(інвалідність 1 групи)",
        3 => "Стійка втрата працездатності(інвалідність 2 групи)",
        4 => "Стійка втрата працездатності(інвалідність 3 групи/інвалід-дитина)",
        5 => "Смерть",
        6 => "Моральна шкода"
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
                        'table'             => 'application_calls'),
                    array(
                        'name'              => 'statuses_id',
                        'description'       => 'Статус',
                        'type'              => fldInteger,
                        'list'              => array(
                            '1' => 'Прийнято',
                            '2' => 'Опрацьовано'
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
                        'table'             => 'application_calls'),
                    array(
                        'name'              => 'owner_types_id',
                        'description'       => 'Тип заявника',
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
                        'table'             => 'application_calls'),
                    array(
                        'name'              => 'policies_kasko_id',
                        'description'       => 'Договір КАСКО, ід',
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
                        'table'             => 'application_calls'),
                    array(
                        'name'              => 'policies_kasko_number',
                        'description'       => 'Договір КАСКО',
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
                        'orderPosition'     => 2,
                        'table'             => 'application_calls',
                        'orderName'         => 'kasko.number'),
                    array(
                        'name'              => 'policies_kasko_items_id',
                        'description'       => 'Договір КАСКО, ТЗ',
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
                        'table'             => 'application_calls'),
                    array(
                        'name'              => 'policies_go_id',
                        'description'       => 'Договір ОСЦПВ, ід',
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
                        'table'             => 'application_calls'),
                    array(
                        'name'              => 'policies_go_number',
                        'description'       => 'Поліс ОСЦПВ',
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
                        'orderPosition'     => 3,
                        'table'             => 'application_calls',
                        'orderName'         => 'go.number'),
                    array(
                        'name'              => 'number',
                        'description'       => 'Номер',
                        'type'              => fldText,
                        'maxlenght'         => 20,
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
                        'orderPosition'     => 1,
                        'table'             => 'application_calls'),
                    array(
                        'name'              => 'CONCAT_WS(\' \', insurance_application_calls.applicant_lastname, insurance_application_calls.applicant_firstname, insurance_application_calls.applicant_patronymicname) as applicant',
                        'description'       => 'Заявник',
                        'type'              => fldText,
                        'maxlength'         => 50,
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
                        'orderPosition'     => 4,
                        'orderName'         => 'insurance_application_calls.applicant_lastname',
                        'table'             => 'application_calls'),
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
                        'table'             => 'application_calls'),
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
                        'table'            => 'application_calls'),
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
                        'table'            => 'application_calls'),
                    array(
                        'name'              => 'applicant_phone',
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
                        'table'            => 'application_calls'),
                    array(
                        'name'              => 'datetime',
                        'description'       => 'Дата події та час події',
                        'type'              => fldDateTime,
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
                        'table'             => 'application_calls'),
                    array(
                        'name'              => 'address',
                        'description'       => 'Адреса події',
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
                        'orderPosition'     => 8,
                        'table'            => 'application_calls'),
                    array(
                        'name'              => 'damage',
                        'description'       => 'Пошкодження',
                        'type'              => fldText,
                        'maxlength'         => 500,
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
                        'table'            => 'application_calls'),
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
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'car_services_workers',
                        'description'      => 'Працівник',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'car_types_id',
                        'description'      => 'Тип ТЗ',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'car_brands_id',
                        'description'      => 'Марка ТЗ, ід',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'              => 'car_brands_id',
                        'description'       => 'Марка',
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
                        'orderPosition'     => 5,
                        'table'             => 'application_calls',
                        'sourceTable'       => 'car_brands',
                        'selectField'       => 'title'),
                    array(
                        'name'             => 'car_models_id',
                        'description'      => 'Модель ТЗ, ід',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'              => 'car_models_id',
                        'description'       => 'Модель',
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
                        'orderPosition'     => 6,
                        'table'             => 'application_calls',
                        'sourceTable'       => 'car_models',
                        'selectField'       => 'title',
                        'orderField'        => 'id'),
                    array(
                        'name'             => 'description',
                        'description'      => 'Опис події',
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
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'making',
                        'description'      => 'Оформлення',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'europrotocol',
                        'description'      => 'Європротокол',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'mvs_reason',
                        'description'      => 'МВС, причина',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'dai_reason',
                        'description'      => 'ДАІ, причина',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'other_reason',
                        'description'      => 'Про подію було повідомлено в (інше)',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'              => 'ambulance',
                        'description'       => 'Виклик шкидкої допомоги',
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
                        'table'             => 'application_calls'),
                    array(
                        'name'              => 'place',
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
                        'table'             => 'application_calls'),
                    array(
                        'name'             => 'place_address',
                        'description'      => 'Повідомлено з адреси',
                        'type'             => fldText,
                        'maxlength'        => 100,
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
                        'table'            => 'application_calls'),
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
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
                                'canBeEmpty'    => true
                            ),
                        'table'             => 'application_calls'),
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
                                'canBeEmpty'    => true
                            ),
                        'table'             => 'application_calls'),
                    array(
                        'name'              => 'driver_phone',
                        'description'       => 'Водій, телефон(и)',
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
                        'table'            => 'application_calls'),
                    array(
                        'name'              => 'managers_id',
                        'description'       => 'Виконавець',
                        'type'              => fldInteger,
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
                        'table'             => 'application_calls',
                        'sourceTable'       => 'accounts',
                        'selectField'       => 'lastname',
                        'orderField'        => 'accounts.lastname'),
                    array(
                        'name'              => 'CONCAT_WS(\' \', insurance_accounts.lastname, insurance_accounts.firstname) as manager',
                        'description'       => 'Виконавець',
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
                        'table'             => 'accounts',
                        'orderName'         => 'insurance_accounts.lastname'),
                    array(
                        'name'             => 'participants',
                        'description'      => 'Інші учасники',
                        'type'             => fldHidden,
                        'display'          =>
                            array(
                                'show'     => false,
                                'insert'   => true,
                                'view'     => true,
                                'update'   => true
                            ),
                        'verification'     =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'car_services_id',
                        'description'      => 'СТО',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'comment',
                        'description'      => 'Коментар',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'             => 'calls_id',
                        'description'      => 'ІД дзвінка',
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
                                'canBeEmpty'    => true
                            ),
                        'table'            => 'application_calls'),
                    array(
                        'name'              => 'created',
                        'description'       => 'Дата заяви',
                        'type'              => fldDateTime,
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
                        'orderPosition'     => 10,
                        'table'             => 'application_calls'),
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
                        'orderPosition'     => 12,
                        'width'             => 100,
                        'table'             => 'application_calls')
                ),
            'common'    =>
                array(
                    'defaultOrderPosition'  => 1,
                    'defaultOrderDirection' => 'desc',
                    'titleField'            => 'number'
                )
        );

    function ApplicationCalls($data) {
        $this->object = 'ApplicationCalls';
        $this->objectTitle = 'ApplicationCalls';

        Form::Form($data);

        $this->messages['plural'] = 'Дзвінки про події';
        $this->messages['single'] = 'Дзвінок про подію';
    }

    function getRowClass($row, $i){
        $result = parent::getRowClass($row, $i);

        return $result;
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'                      => true,
                    'insert'                    => true,
                    'update'                    => true,
                    'view'                      => true,
                    'change'                    => true,
                    'export'                    => true
                );
                break;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db, $Authorization;

        $fields[] = 'do';
        $data['do'] = 'Accidents|show&show=calls';

        $this->setTables('show');
        $this->setShowFields();

        $conditions = array('1');
        
        if ($Authorization->data['roles_id'] == ROLES_MASTER) {
            $conditions[] = PREFIX . '_application_calls.car_services_id = ' . intval($Authorization->data['car_services_id']);
            $conditions[] = PREFIX . '_application_calls.application_accidents_id = 0';
            $conditions[] = PREFIX . '_application_calls.policies_kasko_id > 0';
            $conditions[] = PREFIX . '_application_calls.created >= \'2015-06-01 00:00:00\'';
        }

        if ($data['policies_kasko_number']) {
            $conditions[] = 'kasko.number LIKE ' . $db->quote('%' . $data['policies_kasko_number'] . '%');
        }

        if ($data['policies_go_number']) {
            $conditions[] = 'go.number LIKE ' . $db->quote('%' . $data['policies_go_number'] . '%');
        }

        if ($data['sign']) {
            $conditions[] = 'IF(' . PREFIX .'_application_calls.policies_kasko_items_id > 0, ' . PREFIX . '_policies_kasko_items.sign LIKE ' . $db->quote('%' . $data['sign'] . '%') . ' , 1)';
            $conditions[] = 'IF(' . PREFIX .'_application_calls.policies_go_id > 0, ' . PREFIX . '_policies_go.sign LIKE ' . $db->quote('%' . $data['sign'] . '%') . ' , 1)';
        }
        
        if ($data['from_accidents_date']) {
            $conditions[] = PREFIX . '_application_calls.datetime >= ' . $db->quote( substr($data['from_accidents_date'], 6, 4) . '-' . substr($data['from_accidents_date'], 3, 2) . '-' . substr($data['from_accidents_date'], 0, 2) . ' 00:00:00');
        }
        
        if ($data['to_accidents_date']) {
            $conditions[] = PREFIX . '_application_calls.datetime <= ' . $db->quote( substr($data['to_accidents_date'], 6, 4) . '-' . substr($data['to_accidents_date'], 3, 2) . '-' . substr($data['to_accidents_date'], 0, 2) . ' 23:59:59');
        }
        
        if ($data['from_call_date']) {
            $conditions[] = PREFIX . '_application_calls.created >= ' . $db->quote( substr($data['from_call_date'], 6, 4) . '-' . substr($data['from_call_date'], 3, 2) . '-' . substr($data['from_call_date'], 0, 2) . ' 00:00:00');
        }
        
        if ($data['to_call_date']) {
            $conditions[] = PREFIX . '_application_calls.created <= ' . $db->quote( substr($data['to_call_date'], 6, 4) . '-' . substr($data['to_call_date'], 3, 2) . '-' . substr($data['to_call_date'], 0, 2) . ' 23:59:59');
        }

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $sql = 'SELECT ' . $this->getShowFieldsSQLString() . ', ' .
                    'IF(kasko.id > 0, kasko.number, ' . PREFIX . '_application_calls.policies_kasko_number) as policies_kasko_number, ' .
                    'IF(go.id > 0, go.number, ' . PREFIX . '_application_calls.policies_go_number) as policies_go_number, ' .
                    'car_brands.title as car_brands_id, car_models.title as car_models_id ' .
               'FROM ' . PREFIX . '_application_calls ' .
               'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_application_calls.managers_id = ' . PREFIX . '_accounts.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as kasko ON ' . PREFIX . '_application_calls.policies_kasko_id = kasko.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as go ON ' . PREFIX . '_application_calls.policies_go_id = go.id ' .
               'LEFT JOIN ' . PREFIX . '_car_brands as car_brands ON ' . PREFIX . '_application_calls.car_brands_id = car_brands.id ' .
               'LEFT JOIN ' . PREFIX . '_car_models as car_models ON ' . PREFIX . '_application_calls.car_models_id = car_models.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko_items ON ' . PREFIX .'_application_calls.policies_kasko_items_id = ' . PREFIX . '_policies_kasko_items.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_go ON ' . PREFIX .'_application_calls.policies_go_id = ' . PREFIX . '_policies_go.policies_id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
               'ORDER BY ';

        $total = $db->getOne(transformToGetCount($sql));

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }
//_dump($sql);
        $list = $db->getAll($sql);

        include $this->objectTitle . '/' . $template;
    }

    function view($data, $showForm=true, $action='view', $actionType='view', $template='form.php') {
        global $db;

        $this->mode = 'view';

        if(is_array($data['id'])){
            $data['id'] = $data['id'][0];
        }

        $this->setTables('view');
        $this->getFormFields('view');

        $identityField = $this->getIdentityField();

        $sql =  'SELECT ' . implode(', ', $this->formFields) . ' ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function add($data) {
        unset($data['id']);
        parent::showForm($data, 'insert');
    }

    function insert($data) {
        global $Log, $Authorization;

        $data['statuses_id'] = 1;

        $data['application_calls_id'] = parent::insert(&$data, false, true);

        if ($data['application_calls_id']) {

            $this->setNumber($data);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

            $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=ApplicationCalls|view&id=' . intval($data['application_calls_id']));
            exit;
        }
    }

    function update($data) {
        global $Log;

        $this->checkPermissions('update', $data);

        $previous_statuses_id = $this->getStatusesId($data['id']);

        $data['application_calls_id'] = parent::update(&$data, false, true);

        if ($data['application_calls_id']) {
            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

            $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?do=ApplicationCalls|view&id=' . intval($data['application_calls_id']));
            exit;
        }
    }

    function deleteProcess($data) {
        global $db;

        return true;
    }

    function setNumber($data) {
        global $db;

        $sql = 'UPDATE ' . PREFIX . '_application_calls ' .
               'SET number = CONCAT(date_format(created, \'%y.%m\'), \'.\', id) ' .
               'WHERE id = ' . intval($data['id']);
        $db->query($sql);
    }

    function setConstants(&$data) {
        global $Authorization;

        $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['display']['update'] = false;

        $data['managers_id'] = $Authorization->data['id'];

        if ($this->mode == 'update') {
            $this->formDescription['fields'][ $this->getFieldPositionByName('managers_id') ]['display']['update'] = false;
        }

        switch ($data['owner_types_id']) {
            case 1:
                break;
            case 2:
                $data['policies_kasko_id'] = 0;
                $data['policies_kasko_items_id'] = 0;
                $data['policies_kasko_number'] = '';
                $data['policies_kasko_item_sign'] = '';
                break;
        }

        switch ($data['making']) {
            case 1:
                $data['europrotocol'] = serialize(
                    array(
                        'insurer_company'   => $data['insurer_company'],
                        'policies_series'   => $data['policies_series'],
                        'policies_number'   => $data['policies_number']
                    )
                );
                $data['dai_reason'] = '';
                $data['mvs_reason'] = '';
                break;
            case 2:
                $data['europrotocol'] = '';
                $data['mvs_reason'] = '';
                break;
            case 3:
                $data['europrotocol'] = '';
                $data['dai_reason'] = '';
                break;
            default:
        }
        
        if ($data['place'] == 1) {
            $data['place_address'] = '';
            $this->formDescription['fields'][ $this->getFieldPositionByName('place_address') ]['verification']['canBeEmpty'] = true;
        }
        
        if ($data['driver_types_id'] == 4) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('driver_lastname') ]['verification']['canBeEmpty'] = true;
            $data['driver_lastname'] = '';
            $this->formDescription['fields'][ $this->getFieldPositionByName('driver_firstname') ]['verification']['canBeEmpty'] = true;
            $data['driver_firstname'] = '';
            $this->formDescription['fields'][ $this->getFieldPositionByName('driver_patronymicname') ]['verification']['canBeEmpty'] = true;
            $data['driver_patronymicname'] = '';
            $this->formDescription['fields'][ $this->getFieldPositionByName('driver_phone') ]['verification']['canBeEmpty'] = true;
            $data['driver_phone'] = '';
        }

        $data['participants'] = serialize($data['participants']);

        $data['policies_kasko_id'] = intval($data['policies_kasko_id']);
        $data['policies_kasko_items_id'] = intval($data['policies_kasko_items_id']);
        $data['policies_go_id'] = intval($data['policies_go_id']);
        
        if (!intval($data['policies_kasko_id'])) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('policies_kasko_items_id') ]['display']['insert'] = false;
            $this->formDescription['fields'][ $this->getFieldPositionByName('policies_kasko_items_id') ]['display']['update'] = false;
        }
    }

    function prepareFields($action, $data) {
        $data = parent::prepareFields($action, $data);
    
        $data['participants'] = unserialize($data['participants']);

        $data['euprotocol'] = unserialize($data['europrotocol']);
        $data['insurer_company'] = $data['euprotocol']['insurer_company'];
        $data['policies_series'] = $data['euprotocol']['policies_series'];
        $data['policies_number'] = $data['euprotocol']['policies_number'];

        return $data;
    }

    function getStatusesId($id) {
        global $db;

        $sql = 'SELECT statuses_id ' .
               'FROM ' . PREFIX . '_application_calls ' .
               'WHERE id = ' . intval($id);
        return $db->getOne($sql);
    }

    function setStatusesId($id, $statuses_id) {
        global $db;

        $sql = 'UPDATE ' . PREFIX . '_application_calls ' .
               'SET statuses_id = ' . intval($statuses_id) . ' ' .
               'WHERE id = ' . intval($id);
        $db->query($sql);
    }

    function getCreated($id) {
        global $db;

        $sql = 'SELECT created ' .
               'FROM ' . PREFIX . '_application_calls ' .
               'WHERE id = ' . intval($id);
        return $db->getOne($sql);
    }


    function getSearchPolicyInWindow($data) {
        global $db;

        $conditions[] = '1';
        $conditions_go = array();
        $conditions_kasko = array();

        if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {
            if (intval($data['value'])) {
                $conditions_kasko[] = 'kasko_items.id = ' . intval($data['value']);
            }
            $conditions_kasko[] = '1';
        }

        if ($data['product_types_id'] == PRODUCT_TYPES_GO) {
            if (intval($data['value'])) {
                $conditions_go[] = 'policies.id = ' . intval($data['value']);
            }
            $conditions_go[] = '1';
        }

        if ($data['number']) {
            $conditions[] = 'policies.number LIKE \'%' . $data['number'] . '%\'';
        } elseif($data['datetime']) {
            $conditions[] = '\'' .  date('Y-m-d', strtotime($data['datetime'])) . '\' BETWEEN getPolicyDate(policies.number, 2) AND getPolicyDate(policies.number, 3)';
        }

        if ($data['sign']) {
            if (sizeof($conditions_kasko))$conditions_kasko[] = 'kasko_items.sign LIKE \'%' . $data['sign'] . '%\'';
            if (sizeof($conditions_go)) $conditions_go[] = 'policies_go.sign LIKE \'%' . $data['sign'] . '%\'';
        }

        if ($data['insurer']) {
            if (sizeof($conditions_kasko)) $conditions_kasko[] = 'policies.insurer LIKE \'' . $data['insurer'] . '%\'';
            if (sizeof($conditions_go)) $conditions_go[] = 'policies.insurer LIKE \'' . $data['insurer'] . '%\'';
        }

        if ($data['owner_types_id'] == 2) {
            if (sizeof($conditions_kasko)) $conditions_kasko[] = 'policies.id = 0';
        }

        $result = '<style>' .
            '.columns TD {
                height: 25px;
                color: #FFFFFF;
                padding-left: 4px;
                font-weight: bold !important;
                border-right: 1px solid #4F5D75;
                border-top: 1px solid #4F5D75;
                border-bottom: 1px solid #4F5D75;
                background: #008575 url(../images/administration/tabBorder.gif);
            }' .
            '</style>';

        $result .=   '<table border="1" width="100%" cellpadding="2" cellspacing="0">' .
                        '<tr class="columns">' .
                            '<td></td>' .
                            '<td>Страхувальник</td>' .
                            '<td>Вид страхування</td>' .
                            '<td>Номер</td>' .
                            '<td>Дата</td>' .
                            '<td>Автомобіль</td>' .
                            '<td>Шасі</td>' .
                            '<td>Номер</td>' .
                            '<td>Початок</td>' .
                            '<td>Закінчення</td>' .
                            '<td>Підписант</td>' .
                        '</tr>';

        if (!intval($data['value'])) {
            if((!$data['datetime'] || !checkdate(substr($data['datetime'], 3, 2), substr($data['datetime'], 0, 2), substr($data['datetime'], 6, 4))) && !intval($data['type'])) {
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
        }

        $sql =  'SELECT u.policies_id, u.items_id, u.product_types_id, u.product_types_title, u.insurer, u.number, u.date_format, u.item, u.shassi, u.sign, u.begin_datetime_format, u.interrupt_datetime_format, sign_agency_title
                 FROM (
                    '.(sizeof($conditions_kasko) ? '
                    SELECT ' . (intval($data['value']) ? 'policies.id' : 'getValidPoliciesIdByNumber(policies.number, \'' . date('Y-m-d', strtotime($data['datetime'])) . '\')') . ' as policies_id, kasko_items.id as items_id, policies.product_types_id, \'КАСКО\' as product_types_title,
                        IF(policies_kasko.insurer_person_types_id = 1, CONCAT(policies_kasko.insurer_lastname, \' \', policies_kasko.insurer_firstname, \' \', policies_kasko.insurer_patronymicname), policies_kasko.insurer_company) AS insurer,
                        policies.number, date_format(getPolicyDate(policies.number, 1), \'%d.%m.%Y\') as date_format, CONCAT(kasko_items.brand, \'/\', kasko_items.model) AS item, kasko_items.shassi, kasko_items.sign,
                        date_format(getPolicyDate(policies.number, 2), \'%d.%m.%Y\') as begin_datetime_format,  date_format(getPolicyDate(policies.number, 3), \'%d.%m.%Y\') as interrupt_datetime_format, agencies.title as sign_agency_title
                    FROM ' . PREFIX . '_policies AS policies
                    JOIN ' . PREFIX . '_policies_kasko AS policies_kasko ON policies.id = policies_kasko.policies_id ' . (intval($data['value']) ? '' : 'AND policies.id = getValidPoliciesIdByNumber(policies.number, \'' . date('Y-m-d', strtotime($data['datetime'])) . '\')') . '
                    JOIN ' . PREFIX . '_policies_kasko_items AS kasko_items ON policies.id = kasko_items.policies_id ' . (intval($data['value']) ? '' : 'AND policies.id = getValidPoliciesIdByNumber(policies.number, \'' . date('Y-m-d', strtotime($data['datetime'])) . '\')') . '
                    JOIN insurance_agencies AS agencies ON agencies.id =  IF( policies.seller_agencies_id >0, policies.seller_agencies_id , policies.agencies_id ) 
                    WHERE ' . implode(' AND ', $conditions) . ' AND ' . implode(' AND ', $conditions_kasko) . '
                    GROUP BY policies.number, kasko_items.shassi' : ''
                    ).'
                    '.(sizeof($conditions_go) ? '
                    SELECT policies_go.policies_id, 0 as items_id, policies.product_types_id, \'ОСЦПВ\' as product_types_title,
                        IF(policies_go.person_types_id = 1, CONCAT(policies_go.insurer_lastname, \' \', policies_go.insurer_firstname, \' \', policies_go.insurer_patronymicname), policies_go.insurer_lastname) AS insurer,
                        policies.number, date_format(policies.date, ' . $db->quote(DATE_FORMAT) . ') as date_format, CONCAT(policies_go.brand, \'/\', policies_go.model) AS item, policies_go.shassi, policies_go.sign,
                        date_format(policies.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS begin_datetime_format, date_format(policies.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS interrupt_datetime_format, agencies.title as sign_agency_title
                    FROM ' . PREFIX . '_policies AS policies
                    JOIN ' . PREFIX . '_policies_go AS policies_go ON policies.id = policies_go.policies_id
                    JOIN insurance_agencies AS agencies ON agencies.id =  IF( policies.seller_agencies_id >0, policies.seller_agencies_id , policies.agencies_id ) 
                    WHERE ' . implode(' AND ', $conditions) . ' AND ' . implode(' AND ', $conditions_go)  : '').'
                ) as u
                ORDER BY u.begin_datetime_format DESC';
        
        $list = $db->getAll($sql);

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
                foreach ($list as $row) {

                    switch ($data['product_types_id']) {
                        case PRODUCT_TYPES_KASKO:
                            $choose = '<td align="center">
                                        <input type="radio" name="policies_kasko_items_id" value="' . $row['items_id'] . '" ' . ($row['items_id'] == $data['value'] ? 'checked' : '') . ' onclick="choosePolicy(' . $row['policies_id'] . ', 3)" ' . $this->getReadonly(true, $data['action'] == 'view') . ' />' .
                                        ($row['items_id'] == $data['value'] ? '<input type="hidden" name="policies_kasko_id" value="' . $row['policies_id'] . '" />' : '') .
                                       '</td>';
                            break;
                        case PRODUCT_TYPES_GO:
                            $choose = '<td align="center">
                                        <input type="radio" name="policies_go_id" value="' . $row['policies_id'] . '" ' . ($row['policies_id'] == $data['value'] ? 'checked' : '') . ' onclick="choosePolicy(' . $row['policies_id'] . ', 4)" ' . $this->getReadonly(true, $data['action'] == 'view') . ' />
                                      </td>';
                            break;
                        default:
                            $choose = '<td></td>';
                            break;
                    }

                    $result .=  '<tr>' .
                                    $choose .
                                    '<td>' . $row['insurer'] . '</td>' .
                                    '<td>' . $row['product_types_title'] . '</td>' .
                                    '<td>' . $row['number'] . '</a></td>' .
                                    '<td>' . $row['date_format'] . '</td>' .
                                    '<td>' . $row['item'] . '</td>' .
                                    '<td>' . $row['shassi'] . '</td>' .
                                    '<td>' . $row['sign'] . '</td>' .
                                    '<td>' . $row['begin_datetime_format'] . '</td>'.
                                    '<td>' . $row['interrupt_datetime_format'] . '</td>'.
                                    '<td>' . $row['sign_agency_title'] . '</td>'.
                                '</tr>';
                }

                $result .= '</table>';
                break;
            default:
                $result .= '<tr><td colspan="9" align="center" style="color: red;">Згідно заданних критеріїв знайдено багато полісів. Змініть критерії пошуку.</td></tr>';
                $result .= '</table>';
        }

        if ($data['product_types_id'] == PRODUCT_TYPES_KASKO && !intval($data['value'])) {
            $result .= '<input type="hidden" name="policies_kasko_id" value="' . $row['policies_id'] . '" />';
        }

        echo $result;
    }

    function getCarTypesJsonInWindow($data) {
        global $db;

        $conditions = array();

        if (intval($data['policies_kasko_id']) || !intval($data['is_insurer'])) {
            $conditions[] = 'product_types_id = ' . PRODUCT_TYPES_KASKO;
        } elseif (intval($data['policies_go_id'])) {
            $conditions[] = 'product_types_id = ' . PRODUCT_TYPES_GO;
        } else {
            $conditions[] = 'product_types_id = ' . 0;
        }

        $sql = 'SELECT id, title ' .
               'FROM ' . PREFIX . '_car_types ' .
               'WHERE ' . implode(' AND ', $conditions);
        echo json_encode($db->getAll($sql));
    }

    function getCarBrandsJsonInWindow($data) {
        global $db;

        $conditions = array('1');

        if (intval($data['car_types_id'])) {
            $conditions[] = 'types_models.car_types_id = ' . intval($data['car_types_id']);
        }

        $sql = 'SELECT brands.id, brands.title ' .
               'FROM ' . PREFIX . '_car_brands as brands ' .
               'JOIN ' . PREFIX . '_car_models as models ON brands.id = models.car_brands_id ' .
               'JOIN ' . PREFIX . '_car_type_car_model_assignments as types_models ON models.id = types_models.car_models_id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
               'GROUP BY brands.id ORDER BY title';
        echo json_encode($db->getAll($sql));
    }

    function getCarModelsJsonInWindow($data) {
        global $db;

        $conditions = array('1');

        if (intval($data['brands_id'])) {
            $conditions[] = 'car_brands_id = ' . intval($data['brands_id']);
        }

        $sql = 'SELECT id, title ' .
               'FROM ' . PREFIX . '_car_models ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
               'ORDER BY title';
        echo json_encode($db->getAll($sql));
    }

    function getCarJsonInWindow($data) {
        global $db;

        if (intval($data['policies_kasko_items_id'])) {
            $sql = 'SELECT car_types_id, brands_id, brand, models_id, model ' .
                   'FROM ' . PREFIX . '_policies_kasko_items ' .
                   'WHERE id = ' . intval($data['policies_kasko_items_id']);
            $car = $db->getRow($sql);
        } elseif (intval($data['policies_go_id'])) {
            $sql = 'SELECT car_types_id, brands_id, brand, models_id, model ' .
                   'FROM ' . PREFIX . '_policies_go ' .
                   'WHERE policies_id = ' . intval($data['policies_go_id']);
            $car = $db->getRow($sql);
        } else {
            $car = array('car_types_id' => -1, 'brands_id' => -1, 'models_id' => -1);
        }

        echo json_encode($car);
    }
    
    function getGeneralAgencieInWindow($data) {
        global $db;

        if (intval($data['policies_id'])) {            
            $sql = 'SELECT IF(a.parent_id = 0, a.title, d.title) as title
                    FROM ' . PREFIX . '_agencies as a join ' . PREFIX . '_policies as b on b.agencies_id = a.id 
                    left join ' . PREFIX . '_agencies as d on d.id = a.parent_id
                    WHERE b.id = ' . intval($data['policies_id']);
            $agencie = $db->getRow($sql);
        } else {
            $agencie = array('agencie_id' => -1);
        }
        echo json_encode($agencie);
    }
    
    function getSTOWorkersInWindow($data) {
        global $db;

        if (intval($data['car_services_id'])) {            
            $sql = 'SELECT b.accounts_id, a.lastname, a.firstname, a.patronymicname, a.mobile
                    FROM insurance_accounts as a
                    join insurance_masters as b on a.id = b.accounts_id
                    WHERE b.showWorker = 1 AND 
                    b.car_services_id = ' . intval($data['car_services_id']);
            $list = $db->getAll($sql);
            
            $workers = array();
            
            foreach ($list as $row) {
                $workers[] = array('id' => $row['accounts_id'],'FIO' => $row['lastname'].' '.$row['firstname'].' '.$row['patronymicname'], 'phone' => $row['mobile']);
            }
        } else {
            $workers = array('car_services_id' => -1);
        }
        echo json_encode($workers);
    }

    function getSTOAddressInWindow($data) {
        global $db;

        if (intval($data['car_services_id'])) {            
            $sql = 'SELECT address
                    FROM insurance_car_services
                    WHERE id = ' . intval($data['car_services_id']);
            $address = $db->getRow($sql);
            } else {
            $address = array('car_services_id' => -1);
        }
        echo json_encode($address);
    }
    
    function getCarServicesJsonInWindow($data) {

        global $db;

        $car_brands = array(5, 354, 3, 16, 4, 6, 8, 13, 15, 14, 12, 7, 9, 11, 28);

        $result = array();

        if (!in_array(intval($data['car_brands_id']), $car_brands)) {
            $data['car_brands_id'] = 1;
        }

        if(intval($data['owner_types_id']) == 1) {
            $sql = 'SELECT a.id as id, a.title as title, b.priority as priority ' .
                   'FROM ' . PREFIX . '_car_services as a ' .
                   'JOIN ' . PREFIX . '_car_services_priority as b ON a.id = b.car_services_id ' .
                   'WHERE a.active = 1 AND a.regions_id = ' . intval($data['regions_id']) . ' AND b.brands_id = ' . intval($data['car_brands_id']) . ' AND b.priority <> 0 ' .
                   'ORDER BY b.priority ASC';
        } else {
            $sql = 'SELECT a.id as id, a.title as title, b.priority2 as priority ' .
                   'FROM ' . PREFIX . '_car_services as a ' .
                   'JOIN ' . PREFIX . '_car_services_priority as b ON a.id = b.car_services_id ' .
                   'WHERE a.active = 1 AND a.regions_id = ' . intval($data['regions_id']) . ' AND b.brands_id = ' . intval($data['car_brands_id']) . ' AND b.priority2 <> 0 ' .
                   'ORDER BY b.priority ASC';
        }
        
        $list = $db->getAll($sql);

        foreach ($list as $row) {
            $result[] = array('id' => $row['id'], 'title' => htmlspecialchars_decode($row['title'], ENT_QUOTES), 'priority' => $row['priority']);
        }

        echo json_encode($result);
    }

    function downloadInWindow($data) {
        global $db, $Smarty;
        
        $sql = 'SELECT application_calls.number as application_calls_number,  application_calls.created, application_calls.datetime, application_calls.address, parameters_risks.title as application_risks_title, application_calls.damage, ' .
                    'application_calls.description, application_calls.making, ' .
        
                    'accounts.lastname as creator_lastname, accounts.firstname as creator_firstname, accounts.patronymicname as creator_patronymicname, ' .
                    
                    'application_calls.applicant_lastname, application_calls.applicant_firstname, application_calls.applicant_patronymicname, application_calls.applicant_phone, ' .
                    
                    'application_calls.policies_kasko_id, kasko.number as policies_kasko_number, getPolicyDate(policies_kasko_number, 1) as  policies_kasko_date, ' .
                    
                    'application_calls.policies_go_id, go.number as policies_go_number, go.date as policies_go_date, ' .
                    
                    'car_types_kasko.title as car_types_kasko_title, car_types_go.title as car_types_go_title, ' .
                    'kasko_items.brand as kasko_brand, kasko_items.model as kasko_model, policies_go.brand as go_brand, policies_go.model as go_model, kasko_items.sign as kasko_sign, policies_go.sign as go_sign, ' .
                    
                    'application_calls.europrotocol, application_calls.dai_reason, application_calls.mvs_reason, application_calls.other_reason, application_calls.ambulance, application_calls.place, application_calls.place_address, ' .
                    
                    'application_calls.driver_lastname, application_calls.driver_firstname, application_calls.driver_patronymicname, application_calls.driver_phone, ' .
                    
                    'application_calls.participants, ' .
                    
                    'car_services.title as car_services_title, application_calls.comment, application_calls.calls_id ' .
                    
               'FROM ' . PREFIX . '_application_calls as application_calls ' .
               'JOIN ' . PREFIX . '_accounts as accounts ON application_calls.managers_id = accounts.id ' .
               'LEFT JOIN ' . PREFIX . '_parameters_risks as parameters_risks ON application_calls.application_risks_id = parameters_risks.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON application_calls.policies_kasko_id = kasko_items.policies_id AND application_calls.policies_kasko_items_id = kasko_items.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_go as policies_go ON application_calls.policies_go_id = policies_go.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_car_types as car_types_kasko ON kasko_items.car_types_id = car_types_kasko.id ' .
               'LEFT JOIN ' . PREFIX . '_car_types as car_types_go ON policies_go.car_types_id = car_types_go.id ' .
               'LEFT JOIN ' . PREFIX . '_car_services as car_services ON application_calls.car_services_id = car_services.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as kasko ON application_calls.policies_kasko_id = kasko.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as go ON application_calls.policies_go_id = go.id ' .

               'WHERE application_calls.id = ' . intval($data['id']);
        $values = $db->getRow($sql);
        
        $fields = array(
            'owner_types_title',
            'created_format',
            'applicant',
            'applicant_address',
            'datetime_format',
            'europrotocol',
            'driver',
            'participants'
        );
        
        $values = $this->prepareValues($fields, $values);

        $Smarty->assign('values', $values);

        $file['name']       = 'application_call_' . $values['application_calls_number'];
        $file['content']    = $Smarty->fetch('../files/ProductDocuments/application_calls.tpl');
        
        html2pdf($file);
    }
    
    function prepareValues($fields, $row) {
        global $MONTHES_DATE;

        foreach ($fields as $field) {
            switch ($field) {
                case 'owner_types_title':
                    $row[$field] = ($row['owner_types_id'] == 1 ? 'Страхувальника' : 'Потерпілого');
                    break;
                case 'created_format':
                    $row[$field] = '«' . substr($row['created'], 8, 2) . '» ' . $MONTHES_DATE[ intval(substr($row['created'], 5, 2)) - 1 ] . ' ' . substr($row['created'], 0, 4) . 'р. ' . 
                                   substr($row['created'], 11, 2) . ':' . substr($row['created'], 14, 2) . ':' . substr($row['created'], 17, 2);
                    break;
                case 'applicant':
                    $row[$field] = $row['applicant_lastname'] . ' ' . $row['applicant_firstname'] . ' ' . $row['applicant_patronymicname'];
                    break;              
                case 'applicant_address':
                    $region = Regions::getTitle($row['applicant_regions_id']);
                    $street = StreetTypes::getTitle($row['applicant_street_types_id']) . ' ' . $row['applicant_street'];
                    $row[$field] = $region . (strlen($row['applicant_area']) ? ', ' . $row['applicant_area'] . ' р-он' : '') . (strlen($row['applicant_city'] && !in_array($row['applicant_regions_id'], array(26, 27))) ? ', ' . $row['applicant_city'] : '') .
                        ', ' . $street . (strlen($row['applicant_house']) ? ', буд. ' . $row['applicant_house'] : '') . (strlen($row['applicant_flat']) ? ', кв. ' . $row['applicant_flat'] : '');// . (strlen($row['applicant_phone']) ? ', <br/>тел. ' . $row['applicant_phone'] : '');
                    break;
                case 'datetime_format':
                    $row[$field] = '«' . substr($row['datetime'], 8, 2) . '» ' . $MONTHES_DATE[ intval(substr($row['datetime'], 5, 2)) - 1 ] . ' ' . substr($row['datetime'], 0, 4) . 'р. о ' . substr($row['datetime'], 11, 2) . ' год. ' . substr($row['datetime'], 14, 2) . ' хв.';
                    break;
                case 'europrotocol':
                    $values['europrotocol'] = unserialize($values['europrotocol']);
                    break;
                case 'driver':
                    if ($row['driver_types_id'] != 4)
                        $row[$field] = $row['driver_lastname'] . ' ' . $row['driver_firstname'] . ' ' . $row['driver_patronymicname'];
                    else
                        $row[$field] = 'Без водія';
                    break;
                case 'participants':
                    $temp = unserialize($row[$field]);
                    $row[$field] = array();
                    foreach ($temp as $i => $participant) {
                        if (intval($participant['car']['flag'])) {
                            $participant['car']['data']['car_type_title'] = CarTypes::getTitle($temp[$i]['car']['data']['car_type_id']);
                            $participant['car']['data']['brand'] = CarBrands::getTitle($temp[$i]['car']['data']['brand_id']);
                            $participant['car']['data']['model'] = CarModels::getTitle($temp[$i]['car']['data']['model_id']);
                        }
                        if (intval($participant['life']['flag'])) {
                            $participant['life']['data']['damage_title'] = $this->life_damage_id[ $temp[$i]['life']['data']['damage_id'] ];
                        }
                        $row[$field][] = $participant;
                    }
                    break;
            }
        }

        return $row;
    }
    
    function exportInWindow($data) {
        global $db;
        
        $this->setTables('show');
        $this->setShowFields();
        
        $conditions = array('1');

        if ($data['policies_kasko_number']) {
            $conditions[] = 'kasko.number LIKE ' . $db->quote('%' . $data['policies_kasko_number'] . '%');
        }

        if ($data['policies_go_number']) {
            $conditions[] = 'go.number LIKE ' . $db->quote('%' . $data['policies_go_number'] . '%');
        }

        if ($data['sign']) {
            $conditions[] = 'IF(' . PREFIX .'_application_calls.policies_kasko_items_id > 0, ' . PREFIX . '_policies_kasko_items.sign LIKE ' . $db->quote('%' . $data['sign'] . '%') . ' , 1)';
            $conditions[] = 'IF(' . PREFIX .'_application_calls.policies_go_id > 0, ' . PREFIX . '_policies_go.sign LIKE ' . $db->quote('%' . $data['sign'] . '%') . ' , 1)';
        }
        
        if ($data['from_accidents_date']) {
            $conditions[] = PREFIX . '_application_calls.datetime >= ' . $db->quote( substr($data['from_accidents_date'], 6, 4) . '-' . substr($data['from_accidents_date'], 3, 2) . '-' . substr($data['from_accidents_date'], 0, 2) . ' 00:00:00');
        }
        
        if ($data['to_accidents_date']) {
            $conditions[] = PREFIX . '_application_calls.datetime <= ' . $db->quote( substr($data['to_accidents_date'], 6, 4) . '-' . substr($data['to_accidents_date'], 3, 2) . '-' . substr($data['to_accidents_date'], 0, 2) . ' 23:59:59');
        }
        
        if ($data['from_call_date']) {
            $conditions[] = PREFIX . '_application_calls.created >= ' . $db->quote( substr($data['from_call_date'], 6, 4) . '-' . substr($data['from_call_date'], 3, 2) . '-' . substr($data['from_call_date'], 0, 2) . ' 00:00:00');
        }
        
        if ($data['to_call_date']) {
            $conditions[] = PREFIX . '_application_calls.created <= ' . $db->quote( substr($data['to_call_date'], 6, 4) . '-' . substr($data['to_call_date'], 3, 2) . '-' . substr($data['to_call_date'], 0, 2) . ' 23:59:59');
        }
    
        $sql = 'SELECT ' . $this->getShowFieldsSQLString() . ', ' .
                    'IF(kasko.id > 0, kasko.number, ' . PREFIX . '_application_calls.policies_kasko_number) as policies_kasko_number, ' .
                    'IF(go.id > 0, go.number, ' . PREFIX . '_application_calls.policies_go_number) as policies_go_number, ' .
                    'car_brands.title as car_brands_id, car_models.title as car_models_id, ' .
                    'kasko.id as kasko_id, go.id as go_id, ' .
                    PREFIX . '_policies_kasko_items.sign as kasko_sign, p.sign as go_sign, ' .
                    PREFIX . '_car_services.title as car_services_title, ' . PREFIX . '_application_calls.comment, ' .
                    'applicant_phone, ' . PREFIX . '_application_calls.place, ' .
                    'CONCAT_WS(\' \', driver_lastname, driver_firstname, driver_patronymicname) as driver, driver_phone, ' .
                    'IF(o.insurer_person_types_id = 1, CONCAT_WS(\' \', o.insurer_lastname, o.insurer_firstname, o.insurer_patronymicname), o.insurer_company) as  insurer_kasko, ' .
                    'o.insurer_phone as insurer_phone_kasko, p.insurer_phone as insurer_phone_go, ' . 
                    'CONCAT_WS(\' \', p.insurer_lastname, p.insurer_firstname, p.insurer_patronymicname) as  insurer_go, ' .
                    'date_format(' . PREFIX . '_application_calls.created, \'%d.%m.%Y %H:%i:%s\') as created, ' .
                    'IF(agKASKO.id > 0, IF(agKASKO.parent_id = 0, agKASKO.title, agKASKO2.title), IF(agGO.parent_id = 0, agGO.title, agGO2.title)) as generalAgencie_title ' .
               'FROM ' . PREFIX . '_application_calls ' .
               'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_application_calls.managers_id = ' . PREFIX . '_accounts.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as kasko ON ' . PREFIX . '_application_calls.policies_kasko_id = kasko.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko as o ON kasko.id = o.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_policies as go ON ' . PREFIX . '_application_calls.policies_go_id = go.id ' .
               'LEFT JOIN ' . PREFIX . '_car_brands as car_brands ON ' . PREFIX . '_application_calls.car_brands_id = car_brands.id ' .
               'LEFT JOIN ' . PREFIX . '_car_models as car_models ON ' . PREFIX . '_application_calls.car_models_id = car_models.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko_items ON ' . PREFIX .'_application_calls.policies_kasko_items_id = ' . PREFIX . '_policies_kasko_items.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_go as p ON ' . PREFIX .'_application_calls.policies_go_id = p.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_car_services ON ' . PREFIX . '_application_calls.car_services_id = ' . PREFIX . '_car_services.id ' .
               'LEFT JOIN insurance_agencies AS agKASKO ON kasko.agencies_id = agKASKO.id ' .
               'LEFT JOIN insurance_agencies AS agGO on go.agencies_id = agGO.id ' .
               'LEFT JOIN insurance_agencies AS agKASKO2 ON agKASKO.parent_id = agKASKO2.id ' .
               'LEFT JOIN insurance_agencies AS agGO2 on agGO.parent_id = agGO2.id ' .
               'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        header('Content-Disposition: attachment; filename="report.xls"');
        header('Content-Type: ' . Form::getContentType('report.xls'));

        include_once $this->object . '/excel.php';
        exit;
    }

    function getRegionsListJsonInWindow($data) {
        global $db;

        $sql = 'SELECT regions_id ' .
               'FROM ' . PREFIX . '_car_services ' .
               'WHERE id = ' . intval($data['car_services_id']);
        $regions_id = $db->getOne($sql);

        $result = array();

        $sql = 'SELECT id, title, IF(id = ' . intval($regions_id) . ', 1, 0) as sel ' .
               'FROM ' . PREFIX . '_regions ' .
               'WHERE id <> 28 ' .
               'ORDER BY id ASC';
        $list = $db->getAll($sql);

        foreach ($list as $row) {
            $result[] = array('id' => $row['id'], 'title' => htmlspecialchars_decode($row['title'], ENT_QUOTES), 'is_select' => $row['sel']);
        }

        echo json_encode($result);
        exit;
    }
    
    function getJSONListInWindow($data) {
        global $db;
        
        $sql = 'SELECT policies.number ' .
               'FROM ' . PREFIX . '_policies as policies ' .
               'JOIN ' . PREFIX . '_policies_kasko_items as items ON policies.id = items.policies_id ' .
               'WHERE items.id = ' . intval($data['policies_kasko_items_id']);
        $policies_number = $db->getOne($sql);

        $sql = 'SELECT id ' .
               'FROM ' . PREFIX . '_policies ' .
               'WHERE number = ' . $db->quote($policies_number);
        $policies_idx = $db->getCol($sql);
        
        $this->setTables('show');
        $this->setShowFields();
        
        $sql = 'SELECT ' . $this->getShowFieldsSQLString() . ', ' .
                    'IF(kasko.id > 0, kasko.number, ' . PREFIX . '_application_calls.policies_kasko_number) as policies_kasko_number, ' .
                    'IF(go.id > 0, go.number, ' . PREFIX . '_application_calls.policies_go_number) as policies_go_number, ' .
                    'car_brands.title as car_brands_id, car_models.title as car_models_id, ' .
                    'IF(clients_kasko.important_person = 1 OR clients_go.important_person = 1, 1, 0) as important_person, ' .
                    PREFIX . '_application_calls.application_accidents_id ' .
               'FROM ' . PREFIX . '_application_calls ' .
               'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_application_calls.managers_id = ' . PREFIX . '_accounts.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as kasko ON ' . PREFIX . '_application_calls.policies_kasko_id = kasko.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as go ON ' . PREFIX . '_application_calls.policies_go_id = go.id ' .
               'LEFT JOIN ' . PREFIX . '_car_brands as car_brands ON ' . PREFIX . '_application_calls.car_brands_id = car_brands.id ' .
               'LEFT JOIN ' . PREFIX . '_car_models as car_models ON ' . PREFIX . '_application_calls.car_models_id = car_models.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_kasko_items ON ' . PREFIX .'_application_calls.policies_kasko_items_id = ' . PREFIX . '_policies_kasko_items.id ' .
               'LEFT JOIN ' . PREFIX . '_policies_go ON ' . PREFIX .'_application_calls.policies_go_id = ' . PREFIX . '_policies_go.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_clients as clients_kasko ON kasko.clients_id = clients_kasko.id ' .
               'LEFT JOIN ' . PREFIX . '_clients as clients_go ON go.clients_id = clients_go.id ' .
               'WHERE ' . PREFIX . '_application_calls.policies_kasko_id IN (' . implode(', ', $policies_idx) . ') AND ' . PREFIX . '_application_calls.application_accidents_id IN(0, ' . intval($data['application_accidents_id']) . ')';
        $list = $db->getAll($sql);
        
        echo json_encode($list);
        exit;
    }
    
    function setRelationInWindow($data) {
        global $db;
        
        $sql = 'UPDATE ' . PREFIX . '_application_calls ' .
               'SET application_accidents_id = 0 ' .
               'WHERE application_accidents_id = ' . intval($data['application_accidents_id']);
        $db->query($sql);
        
        $sql = 'UPDATE ' . PREFIX . '_application_calls ' .
               'SET application_accidents_id = ' . intval($data['application_accidents_id']) . ' ' .
               'WHERE id = ' . intval($data['application_calls_id']);
        $db->query($sql);
        
        $result['result'] = 1;
        
        echo json_encode($result);
        exit;
    }
    
    function generateTasks() {
        global $db;
        
        $sql = 'SELECT calls.id as calls_id, calls.policies_kasko_id, calls.datetime as call_date ' .
               'FROM ' . PREFIX . '_application_calls calls ' .
               'WHERE (calls.tasks_id = 0 OR ISNULL(calls.tasks_id)) AND calls.created >= \'2015-06-01 00:00:00\' AND calls.policies_kasko_id > 0 AND (calls.application_accidents_id = 0 OR ISNULL(calls.application_accidents_id)) AND DATEDIFF(NOW(), calls.datetime) >= 1';
        $calls = $db->getAll($sql);
        
        foreach($calls as $call) {
            
            $day = date("d" , strtotime($call['call_date']));
            $month = date("m" , strtotime($call['call_date']));
            $year = date("Y" , strtotime($call['call_date']));

            $j = 0;
            $i = 0;

            $date;

            do {
                $date = date('Y-m-d', mktime(0, 0, 0, $month, $day+$j, $year));

                if(date('w', strtotime($date)) != 6 && date('w', strtotime($date)) != 0) {
                    $i++;
                }

                $j++;
            } while ($i < 3);
            
            $sql =  'INSERT INTO ' . PREFIX . '_tasks SET ' .
                                'child_id = 0, ' .
                                'date = ' . $db->quote( $date ) . ', ' .
                                'task_types_id = 6, ' .
                                'policies_id = ' . $call['policies_kasko_id'] . ', ' .
                                'policy_payments_calendar_id = 0, ' .
                                'task_statuses_call_id = 0, ' .
                                'sto_call = 0, ' .
                                'task_statuses_id = 52, ' .
                                'performers_id = 0, ' .
                                'comment = NULL, ' .
                                'created = NOW(), ' .
                                'modified = NOW()';
            $db->query($sql);
            
            $id =  mysql_insert_id();
            
            $sql = 'UPDATE ' . PREFIX . '_application_calls SET tasks_id = ' . $id . ' WHERE id = ' . intval($call['calls_id']);
            $db->query($sql);
            
        }
    }
}

?>