<?
/*
 * Title: Profiles class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */
 
require_once 'CarServices.class.php';

class RecoveryRepairs extends Form {

    var $yesno = array('ні', 'так');

    var $statuses = array(
        1 => array('id' => 1, 'title' => 'Оплата СВ'),
        2 => array('id' => 2, 'title' => 'Очікування ЗЧ'),
        3 => array('id' => 3, 'title' => 'Очікування авто'),
        4 => array('id' => 4, 'title' => 'В роботі ВР'),
        5 => array('id' => 5, 'title' => 'Частковий ВР'),
        6 => array('id' => 6, 'title' => 'ВР проведено')
    );

    var $orderFields = array(
        1   =>  'accidents_number',
        2   =>  'car_services_id',
        3   =>  'statuses_id',
        4   =>  'accidents_date',
        5   =>  'item',
        6   =>  'sign',
        7   =>  'sections_id',
        8   =>  'accidents_number',
        9   =>  'accidents_number',
        10  =>  'accidents_number',
        11  =>  'accidents_number',
        12  =>  'amount',
        13  =>  'created_date',
        14  =>  'payment_date',
        15  =>  'accidents_number'
    );
    
    var $sectionsTerms = array(
        1   =>  7,
        2   =>  13,
        3   =>  30,
        4   =>  55
    );
    
    var $repairTerms = array(
        0   =>  0,
        1   =>  2,
        2   =>  6,
        3   =>  12,
        4   =>  28
    );
    
    var $partTerms = array(
        0   =>  0,
        1   =>  1,
        2   =>  3,
        3   =>  14,
        4   =>  14
    );
    
    var $checkUpdateFieldsArray = array(
        'order_date'            =>  'Дата замовлення ЗЧ',
        'get_oriented_date'     =>  'Орієнтовна дата отримання ЗЧ',
        'get_fact_date'         =>  'Фактична дата отримання ЗЧ',
        'call_date'             =>  'Дата запрошення',
        'check_oriented_date'   =>  'Планова дата заїзду',
        'sto'                   =>  'ТЗ на території СТО'
    );

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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'accident_payments_calendar_id',
                            'description'       => 'Календар',
                            'type'              => fldIdentity,
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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'order_date',
                            'description'       => 'Дата замовлення ЗЧ',
                            'type'              => fldDate,
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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'get_oriented_date',
                            'description'       => 'Орієнтовна дата отримання ЗЧ',
                            'type'              => fldDate,
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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'get_fact_date',
                            'description'       => 'Фактична дата отримання ЗЧ',
                            'type'              => fldDate,
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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'call_date',
                            'description'       => 'Дата запрошення',
                            'type'              => fldDate,
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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'check_oriented_date',
                            'description'       => 'Планова дата заїзду',
                            'type'              => fldDate,
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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'sto',
                            'description'       => 'ТЗ на території СТО',
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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'order_equipment_open_date',
                            'description'       => 'Дата відкриття няряд-замовлення',
                            'type'              => fldDate,
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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'repair_begin_date',
                            'description'       => 'Ремонт, початок',
                            'type'              => fldDate,
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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'repair_end_date',
                            'description'       => 'Ремонт, закінчення',
                            'type'              => fldDate,
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
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldInteger,
                            'display'           => 
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'closed_date',
                            'description'       => 'Дата закриття',
                            'type'              => fldDate,
                            'display'           => 
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           => 
                                array(
                                    'show'      => true,
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'table'             => 'recovery_repairs'),
                        array(
                            'name'              =>  'accidents_number',
                            'description'       =>  'Номер справи',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  1
                        ),
                        array(
                            'name'              =>  'car_services_id',
                            'description'       =>  'СТО',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  2
                        ),
                        array(
                            'name'              =>  'statuses_id',
                            'description'       =>  'Статус',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  3
                        ),
                        array(
                            'name'              =>  'accidents_date',
                            'description'       =>  'Дата заяви',
                            'type'              =>  fldDate,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  4
                        ),
                        array(
                            'name'              =>  'item',
                            'description'       =>  'Об\'єкт',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  5
                        ),
                        array(
                            'name'              =>  'sign',
                            'description'       =>  'Державний номер',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  6
                        ),
                        array(
                            'name'              =>  'section_title',
                            'description'       =>  'Категорія справи',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  7
                        ),
                        array(
                            'name'              =>  'repair_classifications_id',
                            'description'       =>  'Клас ВР',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  8
                        ),
                        array(
                            'name'              =>  'parts_classifications_id',
                            'description'       =>  'Клас ЗЧ',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  9
                        ),
                        array(
                            'name'              =>  'calc_amount',
                            'description'       =>  'Сума ВР',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  10
                        ),
                        array(
                            'name'              =>  'repair_parts',
                            'description'       =>  'ЗЧ',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  11
                        ),
                        array(
                            'name'              =>  'amount',
                            'description'       =>  'Сума СВ',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  12
                        ),
                        array(
                            'name'              =>  'created_date',
                            'description'       =>  'Дата початку ВР',
                            'type'              =>  fldDate,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  13
                        ),
                        array(
                            'name'              =>  'payment_date',
                            'description'       =>  'Дата сплати',
                            'type'              =>  fldDate,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  14
                        ),
                        array(
                            'name'              =>  'persons',
                            'description'       =>  'Виконавці',
                            'type'              =>  fldText,
                            'display'           =>  array('show' => true),
                            'orderPosition'     =>  15
                        ),
                        
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 1,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'id'
                    )
            );

    function RecoveryRepairs($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Відновлювальний ремонт';
        $this->messages['single'] = 'Відновлювальний ремонт';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'update'    => true,
                    'delete'    => true,
                    'view'      => true,
                    'export'    => true);
                break;
            case ROLES_MASTER:
                $this->permissions = array(
                    'show'      => true,
                    'update'    => true,
                    'view'      => true,
                    'export'    => true);
                break;
        }
    }
    
    function getProductTypesId($id) {
        global $db;
        
        $sql = 'SELECT a.product_types_id ' .
               'FROM ' . PREFIX . '_accidents as a ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar as b ON a.id = b.accidents_id ' .
               'JOIN ' . PREFIX . '_recovery_repairs as c ON b.id = c.accident_payments_calendar_id ' . 
               'WHERE c.id = ' . intval($id);
        return $db->getOne($sql);
    }
    
    function show($data, $fields=null, $conditions=null, $sql=null, $template='RecoveryRepairs/show.php', $limit=true) {
        global $db, $Authorization;
        
        $fields[] = 'do';
        $data['do'] = 'Accidents|show&show=recovery';
        
        $this->setTables('show');
        $this->setShowFields();
        
        $conditions_kasko[] = 'accidents.product_types_id = ' . PRODUCT_TYPES_KASKO;
        $conditions_go[] = 'accidents.product_types_id = ' . PRODUCT_TYPES_GO;
        
        if(!$data['archive'])
            $data['archive'] = 1;

        $fields[] = 'archive';
        switch ($data['archive']) {
            case 1:
                $conditions_kasko[] = 'recovery.statuses_id NOT IN(6)';
                $conditions_go[] = 'recovery.statuses_id NOT IN(6)';
                break;
            case 2:
                $conditions_kasko[] = 'recovery.statuses_id IN(6)';
                $conditions_go[] = 'recovery.statuses_id IN(6)';
                break;
            default:
                break;
        }
        
        if (intval($data['statuses_id'])) {
            $fields[] = 'statuses_id';
            $conditions_kasko[] = 'recovery.statuses_id = ' . intval($data['statuses_id']);
            $conditions_go[] = 'recovery.statuses_id = ' . intval($data['statuses_id']);
        }
        
        if (intval($data['car_services_id'])) {
            $fields[] = 'car_services_id';
            $conditions_kasko[] = 'calendar.recipients_id = ' . intval($data['car_services_id']);
            $conditions_go[] = 'calendar.recipients_id = ' . intval($data['car_services_id']);
        }
        
        if ($data['sign']) {
            $fields[] = 'sign';
            $conditions_kasko[] = 'kasko_items.sign LIKE ' . $db->quote('%' . $data['sign'] . '%');
            $conditions_go[] = 'accidents_go.owner_sign LIKE ' . $db->quote('%' . $data['sign'] . '%');
        }
        
        if ($data['shassi']) {
            $fields[] = 'shassi';
            $conditions_kasko[] = 'kasko_items.shassi LIKE ' . $db->quote('%' . $data['shassi'] . '%');
            $conditions_go[] = 'accidents_go.owner_shassi LIKE ' . $db->quote('%' . $data['shassi'] . '%');
        }

        if ($data['FIO']) {
            $fields = 'owner';
            $conditions_kasko[] = 'IF(owner_person_types_id = 1, CONCAT_WS(\' \', owner_lastname, owner_firstname, owner_patronymicname), owner_lastname) LIKE ' . $db->quote('%' . $data['FIO'] . '%');
            $conditions_go[] = 'IF(owner_person_types_id = 1, CONCAT_WS(\' \', owner_lastname, owner_firstname, owner_patronymicname), owner_lastname) LIKE ' . $db->quote('%' . $data['FIO'] . '%');
        }
        
        if ($data['accidents_number']) {
            $fields[] = 'accidents_number';
            $conditions_kasko[] = 'accidents.number LIKE ' . $db->quote('%' . $data['accidents_number'] . '%');
            $conditions_go[] = 'accidents.number LIKE ' . $db->quote('%' . $data['accidents_number'] . '%');
        }
        
        if ($Authorization->data['roles_id'] == ROLES_MASTER) {
            $conditions_kasko[] = 'calendar.recipients_id = ' . intval($Authorization->data['car_services_id']);
            $conditions_go[] = 'calendar.recipients_id = ' . intval($Authorization->data['car_services_id']);
        }
        
        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }
        
        $sql_kasko = 'SELECT recovery.id as id, accidents.number as accidents_number, recovery.statuses_id as statuses_id, date_format(accidents.date, \'%d.%m.%Y\') as accidents_date_format, CONCAT_WS(\' \', kasko_items.brand, kasko_items.model) as item, ' . 
                     'kasko_items.sign as sign, sections.title as section_title, calendar.amount as amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date_format, acts.accident_messages_id as accident_messages_id, ' .
                     'IF(owner_person_types_id = 1, CONCAT_WS(\' \', owner_lastname, owner_firstname, owner_patronymicname), owner_lastname) as owner,' .
                     'master.lastname as master_name, average.lastname as average_name, estimate.lastname as estimate_name, car_services.title as car_services_id, ' .
                     'accidents.date as accidents_date, sections.id as sections_id, calendar.payment_date as payment_date, ' .
                     'recovery.sto, recovery.order_equipment_open_date, ' .
                     'recovery.order_date, recovery.get_oriented_date, recovery.get_fact_date, recovery.call_date, recovery.check_oriented_date, recovery.created as created_date, date_format(recovery.created, \'%d.%m.%Y\') as created_date_format ' .

                    'FROM ' . PREFIX . '_recovery_repairs as recovery ' .
                    'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON recovery.accident_payments_calendar_id = calendar.id ' .
                    'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
                    'JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
                    'JOIN ' . PREFIX . '_accidents_kasko as accidnets_kasko ON accidents.id = accidnets_kasko.accidents_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidnets_kasko.items_id = kasko_items.id ' .
                    'JOIN ' . PREFIX . '_accident_sections as sections ON accidents.accident_sections_id = sections.id ' .
                    'JOIN ' . PREFIX . '_accounts as master ON accidents.masters_id = master.id ' .
                    'JOIN ' . PREFIX . '_accounts as average ON accidents.average_managers_id = average.id ' .
                    'JOIN ' . PREFIX . '_accounts as estimate ON accidents.estimate_managers_id = estimate.id ' .
                    'JOIN ' . PREFIX . '_car_services as car_services ON calendar.recipients_id = car_services.id ' .
                    'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
                    'WHERE ' . implode(' AND ', $conditions_kasko);
                    
        $sql_go = 'SELECT recovery.id, accidents.number, recovery.statuses_id, date_format(accidents.date, \'%d.%m.%Y\'), CONCAT_WS(\' \', accidents_go.owner_brand, accidents_go.owner_model), ' . 
                    'accidents_go.owner_sign, sections.title, calendar.amount, date_format(calendar.payment_date, \'%d.%m.%Y\'), acts.accident_messages_id, ' .
                    'master.lastname, average.lastname, estimate.lastname, car_services.title, ' .
                    'accidents.date, sections.id, calendar.payment_date, ' .
                    'IF(owner_person_types_id = 1, CONCAT_WS(\' \', owner_lastname, owner_firstname, owner_patronymicname), owner_lastname) as owner, ' .
                    'recovery.sto, recovery.order_equipment_open_date, ' .
                    'order_date, get_oriented_date, get_fact_date, call_date, check_oriented_date, recovery.created as created_date, date_format(recovery.created, \'%d.%m.%Y\') as created_date_format ' .
                            
                    'FROM ' . PREFIX . '_recovery_repairs as recovery ' .
                    'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON recovery.accident_payments_calendar_id = calendar.id ' .
                    'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
                    'JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
                    'JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
                    'JOIN ' . PREFIX . '_accident_sections as sections ON accidents.accident_sections_id = sections.id ' .
                    'JOIN ' . PREFIX . '_accounts as master ON accidents.masters_id = master.id ' .
                    'JOIN ' . PREFIX . '_accounts as average ON accidents.average_managers_id = average.id ' .
                    'JOIN ' . PREFIX . '_accounts as estimate ON accidents.estimate_managers_id = estimate.id ' .
                    'JOIN ' . PREFIX . '_car_services as car_services ON calendar.recipients_id = car_services.id ' .
                    'WHERE ' . implode(' AND ', $conditions_go);
                    
        $sql = 'SELECT u.id as id, u.accidents_number as accidents_number, u.statuses_id as statuses_id, u.accidents_date_format as accidents_date_format, u.item as item, u.sign as sign, u.section_title as section_title, u.amount as amount, ' .
                        'u.payment_date_format as payment_date_format, u.accident_messages_id as accident_messages_id, u.master_name as master_name, u.average_name as average_name, u.estimate_name as estimate_name, u.car_services_id as car_services_id, ' . 
                        'u.accidents_date as accidents_date, u.sections_id as sections_id, u.payment_date, u.created_date, ' .
                        
                        'u.order_date, u.get_oriented_date, u.get_fact_date, u.call_date, u.check_oriented_date, u.created_date_format, ' .
                        'u.sto, u.order_equipment_open_date ' .
                        
               'FROM (' . $sql_kasko . ' UNION ' . $sql_go . ') as u ' .
               'ORDER BY u.';

        $total = $db->getOne(transformToGetCount($sql));
        
        $sql .= $this->getShowOrderCondition();
        
        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }
        
        $list = $db->getAll($sql);

        $car_services = CarServices::getActiveCarServices();

        include $template;
    }

    function getRowClass($row, $i){
        global $db;
    
        $result = parent::getRowClass($row, $i);
        
        if (in_array($row['status'], array(5, 6))) return $result;

        if (intval($row['is_repair_parts'])) {
            if (!$row['order_date'] || $row['order_date'] == '0000-00-00' ||
                !$row['get_oriented_date'] || $row['get_oriented_date'] == '0000-00-00' ||
                !$row['get_fact_date'] || $row['get_fact_date'] == '0000-00-00') {
                $sql = 'SELECT IF(date_format(NOW(), \'%Y-%m-%d\') > DATE_ADD(' . $db->quote(date('Y-m-d', strtotime($row['created_date']))) . ', INTERVAL ' . $this->partTerms[ intval($row['parts_classifications_id']) ] . ' DAY), 1, 0)';
                if (intval($db->getOne($sql))) {
                    $result .= ' repairs_red';
                    return $result;
                }
            }
        } else {
            if ($row['payment_date'] != '0000-00-00' && 
                (!$row['call_date'] || $row['call_date'] == '0000-00-00' ||
                !$row['check_oriented_date'] || $row['check_oriented_date'] == '0000-00-00')) {
                $sql = 'SELECT IF(date_format(NOW(), \'%Y-%m-%d\') > DATE_ADD(' . $db->quote(date('Y-m-d', strtotime($row['payment_date']))) . ', INTERVAL 2 DAY), 1, 0)';
                if (intval($db->getOne($sql))) {
                    $result .= ' repairs_orange';
                    return $result;
                }
            }
        }

        if (intval($row['sto']) && $row['order_equipment_open_date'] != '0000-00-00' && $row['order_equipment_open_date']) {
            $sql = 'SELECT IF(date_format(NOW(), \'%Y-%m-%d\') > DATE_ADD(' . $db->quote(date('Y-m-d', strtotime($row['order_equipment_open_date']))) . ', INTERVAL ' . $this->repairTerms[ intval($row['repair_classifications_id']) ] . ' DAY), 1, 0)';
            if (intval($db->getOne($sql))) $result .= ' repairs_magents';
            return $result;
        }

        return $result;
    }

    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Authorization;

        $id = is_array($data["id"]) ? intval($data["id"][0]) : intval($data["id"]);

        $result = parent::checkPermissions($action, $data, $redirect);

        switch ($action) {
            case 'update':
                if ($Authorization->data["roles_id"] == ROLES_MASTER && $this->getStatusesId($id) == 6) {
                    //parent::checkPermissions($action, $data, true);
                }
                break;
        }

        return $result;
    }
    
    function load($data, $action='update', $actionType='update') {
        global $db, $Authorization;
        
        $data = parent::load($data, false);
        
        switch ($this->getProductTypesId($data['id'])) {
            case PRODUCT_TYPES_KASKO:
                $sql = 'SELECT accidents.number as accidents_number, date_format(accidents.date, \'%d.%m.%Y\') as accidents_date, CONCAT_WS(\' \', kasko_items.brand, kasko_items.model) as item, acts.accident_messages_id as accident_messages_id, ' .
                            'IF(owner_person_types_id = 1, CONCAT_WS(\' \', owner_lastname, owner_firstname, owner_patronymicname), owner_company) as owner, ' .
                            'kasko_acts.deductibles_amount, kasko_acts.proportionality_value, kasko_acts.deterioration_value, kasko_acts.calc_info, ' .
                            'calendar.amount as payment_amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, accidents.id as accidents_id ' .
                    'FROM ' . PREFIX . '_recovery_repairs as recovery ' .
                    'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON recovery.accident_payments_calendar_id = calendar.id ' .
                    'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
                    'JOIN ' . PREFIX . '_accidents_kasko_acts as kasko_acts ON acts.id = kasko_acts.accidents_acts_id ' .
                    'JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
                    'JOIN ' . PREFIX . '_accidents_kasko as accidnets_kasko ON accidents.id = accidnets_kasko.accidents_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidnets_kasko.items_id = kasko_items.id ' .
                    'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
                    'WHERE recovery.id = ' . intval($data['id']);
                break;
            case PRODUCT_TYPES_GO:
                $sql = 'SELECT accidents.number as accidents_number, date_format(accidents.date, \'%d.%m.%Y\') as accidents_date, CONCAT_WS(\' \', accidnets_go.owner_brand, accidnets_go.owner_model) as item, acts.accident_messages_id as accident_messages_id, ' .
                            'IF(owner_person_types_id = 1, CONCAT_WS(\' \', owner_lastname, owner_firstname, owner_patronymicname), owner_lastname) as owner, ' .
                            'go_acts.deductibles_amount, 1 as proportionality_value, go_acts.deterioration_value, go_acts.calc_info, ' .
                            'calendar.amount as payment_amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, accidents.id as accidents_id ' .
                    'FROM ' . PREFIX . '_recovery_repairs as recovery ' .
                    'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON recovery.accident_payments_calendar_id = calendar.id ' .
                    'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
                    'JOIN ' . PREFIX . '_accidents_go_acts as go_acts ON acts.id = go_acts.accidents_acts_id ' .
                    'JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
                    'JOIN ' . PREFIX . '_accidents_go as accidnets_go ON accidents.id = accidnets_go.accidents_id ' .
                    'WHERE recovery.id = ' . intval($data['id']);
                break;
            default:
                break;
        }
        if ($sql) {
            $info = $db->getRow($sql);
            $info['plan_days'] = $this->getPlanDays($data['id']);
            $info['fact_days'] = $this->getFactDays($data['id']);

            $sql = 'SELECT answer FROM ' . PREFIX . '_accident_messages WHERE id = ' . intval($info['accident_messages_id']);
            $info["answer"] = unserialize($db->getOne($sql));

            $sql = 'SELECT decision FROM ' . PREFIX . '_accident_messages WHERE id = ' . intval($info['accident_messages_id']);
            $info["decision"] = $db->getOne($sql);
        }

        include_once $this->object . '/form.php';
    }
    
    function update($data, $redirect=true){
        global $db, $Log, $Authorization;       

        $data['id'] = parent::update(&$data, false, true);

        if (intval($data['id'])) {
            $sql = 'DELETE FROM ' . PREFIX . '_executed_work_acts WHERE recovery_repairs_id = ' . intval($data['id']);
            $db->query($sql);
            
            foreach ($data['avr'] as $avr) {
                $sql = 'INSERT INTO ' . PREFIX . '_executed_work_acts ' .
                       'SET recovery_repairs_id = ' . intval($data['id']) . ', ' .
                            'begin_date = ' . $db->quote($avr['begin_date']) . ', ' .
                            'end_date = ' . $db->quote($avr['end_date']) . ', ' .
                            'number = ' . $db->quote($avr['number']) . ', ' .
                            'amount = ' . $db->quote($avr['amount']) . ', ' .
                            'checked = ' . intval($avr['checked']) . ', ' .
                            'avr_comment = ' . $db->quote($avr['avr_comment']);
                $db->query($sql);
            }
            
            if (strlen($data['updates'])) {
                $this->insertToMonitoring($data['id'], 
                                          $Authorization->data['id'], 
                                          $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 
                                          $data['updates']);
            }
            
            if (strlen($data['monitoring_comment'])) {
                $this->insertToMonitoring($data['id'], 
                                          $Authorization->data['id'], 
                                          $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 
                                          $data['monitoring_comment']);             
            }

            if ($data['old_statuses_id'] != $data['statuses_id']) {
                $this->insertToMonitoring($data['id'], 
                                          $Authorization->data['id'], 
                                          $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 
                                          'Змінив статус на <b>"' . $this->statuses[ $data['statuses_id'] ]['title'] . '"</b>');                
            }

            $data['order_equipment_open_date'] = $data['order_equipment_open_date_year'] . '-' . $data['order_equipment_open_date_month'] . '-' . $data['order_equipment_open_date_day'];
            if ($data['order_equipment_open_date'] != '--' &&  $data['old_order_equipment_open_date'] != $data['order_equipment_open_date']) {
                $this->insertToMonitoring($data['id'], 
                                          $Authorization->data['id'], 
                                          $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 
                                          'Змінив дата відкриття наряд-замовлення на <b>"' . $data['order_equipment_open_date'] . '"</b>');             
            }

            $data['repair_begin_date'] = $data['repair_begin_date_year'] . '-' . $data['repair_begin_date_month'] . '-' . $data['repair_begin_date_day'];
            if ($data['repair_begin_date'] != '--' && $data['old_repair_begin_date'] != $data['repair_begin_date']) {
                $this->insertToMonitoring($data['id'], 
                                          $Authorization->data['id'], 
                                          $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 
                                          'Змінив дату початку ремонту на <b>"' . $data['repair_begin_date'] . '"</b>');                
            }

            $data['repair_end_date'] = $data['repair_end_date_year'] . '-' . $data['repair_end_date_month'] . '-' . $data['repair_end_date_day'];
            if ($data['repair_end_date'] != '--' && $data['old_repair_end_date'] != $data['repair_end_date']) {
                $this->insertToMonitoring($data['id'], 
                                          $Authorization->data['id'], 
                                          $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 
                                          'Змінив дату закінчення ремонту на <b>"' . $data['repair_end_date'] . '"</b>');               
            }
        }

        $params['title']    = $this->messages['single'];
        $params['id']       = $data['id'];
        $params['storage']  = $this->tables[0];
        if ($redirect) {
            if($data['id'] > 0) {
               $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
               header('Location: ' . $_SERVER['PHP_SELF'] . '?do=RecoveryRepairs|view&id=' . intval($data['id']));
               exit;
            }
        } else {
            return $data['id'];
        }
    }
    
    function isPartsExist($id) {
        global $db;

        $sql = 'SELECT a.answer ' .
               'FROM ' . PREFIX . '_accident_messages AS a ' .
               'JOIN ' . PREFIX . '_accidents_acts AS b ON a.id = b.accident_messages_id ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar AS c ON b.id = c.acts_id ' .
               'JOIN ' . PREFIX . '_recovery_repairs AS d ON c.id = d.accident_payments_calendar_id ' .
               'WHERE d.id = ' . intval($id);
        $answer = $db->getOne($sql);
        
        if ($answer) {
            $answer = unserialize($answer);
            return ($answer['repair_parts'] == 'on') ? true : false;
        }
    }

    function setConstants(&$data) {
        global $db;

        $data['order_date'] = $this->convertDateToDBFormat('order_date', $data);
        $data['get_oriented_date'] = $this->convertDateToDBFormat('get_oriented_date', $data);
        $data['get_fact_date'] = $this->convertDateToDBFormat('get_fact_date', $data);
        $data['call_date'] = $this->convertDateToDBFormat('call_date', $data);
        $data['check_oriented_date'] = $this->convertDateToDBFormat('check_oriented_date', $data);
        
        $repairAmount = 0;
        //$isAvr = false;
        foreach ($data['avr'] as $key => $avr) {
            $data['avr'][ $key ]['begin_date'] = $this->convertDateToDBFormat('begin_date', $data['avr'][ $key ], 2);
            $data['avr'][ $key ]['end_date'] = $this->convertDateToDBFormat('end_date', $data['avr'][ $key ], 2);
            $repairAmount += $data['avr'][ $key ]['amount'];
            //if ($data['avr'][ $key ]['begin_date'] && $data['avr'][ $key ]['begin_date'] != '0000-00-00') $isAvr = true;
        }

        if (intval($data['id'])) {
            $sql =  'SELECT order_equipment_open_date as old_order_equipment_open_date, repair_begin_date as old_repair_begin_date, repair_end_date as old_repair_end_date, statuses_id as old_statuses_id ' .
                    'FROM ' . PREFIX . '_recovery_repairs ' .
                    'WHERE id = ' . intval($data['id']);
            $data = array_merge($db->getRow($sql), $data);
        }

        if ($data['get_fact_date'] == '0000-00-00' && $data['id'] && $this->isPartsExist($data['id'])) {
            echo '???';
            $data['statuses_id'] = 2;
        } else if ($repairAmount > $this->getRepairAmount($data['id']) || (abs($repairAmount - $this->getRepairAmount($data['id'])) <= 50)) {
            $data['statuses_id'] = 6;
        } elseif ($repairAmount > 0) {
            $data['statuses_id'] = 5;
        } elseif (intval($data['sto']) && checkdate($data['order_equipment_open_date_month'], $data['order_equipment_open_date_day'], intval($data['order_equipment_open_date_year']))) { //checkdate($data['check_oriented_date_month'], $data['check_oriented_date_day'], intval($data['check_oriented_date_year']))) {
            $data['statuses_id'] = 4;
        } elseif (checkdate($data['get_fact_date_month'], $data['get_fact_date_day'], intval($data['get_fact_date_year'])) || checkdate($data['call_date_month'], $data['call_date_day'], intval($data['call_date_year']))) {
            $data['statuses_id'] = 3;
        } elseif (checkdate($data['order_date_month'], $data['order_date_day'], intval($data['order_date_year'])) || checkdate($data['get_oriented_date_month'], $data['get_oriented_date_day'], intval($data['get_oriented_date_year']))) {
            echo '!!!';
            $data['statuses_id'] = 2;
        } else {
            $data['statuses_id'] = 1;
        }

        if ($data['statuses_id'] < $data['old_statuses_id']) {
            //$data['statuses_id'] = $data['old_statuses_id'];
        }

        $data['updates'] = $this->checkUpdateFields($data);
    }
    
    function convertDateToDBFormat($field, $data, $type=1) {
        switch ($type) {
            case 1:
                if ($data[ $field . '_year' ] && $data[ $field . '_month' ] && $data[ $field . '_day' ]) return $data[ $field . '_year' ] . '-' . $data[ $field . '_month' ] . '-' . $data[ $field . '_day' ];
                else return '0000-00-00';
            case 2:
                if (strlen($data[ $field ])) return date('Y-m-d', strtotime($data[ $field ]));
                else return '0000-00-00';
            default:
                return '0000-00-00';
        }
    }
    
    function convertDBFormatFormatToDate($field, $data) {
        if ($data[ $field ] && $data[ $field ] != '0000-00-00') return date('d.m.Y', strtotime($data[ $field ]));
        else return '';
    }
    
    function getShowOrderCondition() {
        $direction = (ereg('^(asc|desc)$', $_COOKIE[ get_class($this) ]['orderDirection']))
            ? $_COOKIE[ get_class($this) ]['orderDirection']
            : $this->formDescription['common']['defaultOrderDirection'];

        return (intval($_COOKIE[ get_class($this) ]['orderPosition']) && $this->getFieldNameByOrderPosition($_COOKIE[ get_class($this) ]['orderPosition']))
            ? $this->orderFields[$_COOKIE[ get_class($this) ]['orderPosition']] . ' ' . $direction
            : $this->orderFields[$this->formDescription['common']['defaultOrderPosition']] . ' ' . $direction;
    }
    
    function view($data) {
        global $db;
    
        $this->checkPermissions('view', $data);
        $action = 'view';
        $actionType = ($data['do'] == $this->object . '|previewInWindow') ? 'previewInWindow' : 'view';

        if (is_array($data['id'])) $data['id'] = $data['id'][0];
        
        $this->permissions['update'] = true;
        $data = parent::load($data, false);

        switch ($this->getProductTypesId($data['id'])) {
            case PRODUCT_TYPES_KASKO:
                $sql = 'SELECT accidents.number as accidents_number, date_format(accidents.date, \'%d.%m.%Y\') as accidents_date, CONCAT_WS(\' \', kasko_items.brand, kasko_items.model) as item, acts.accident_messages_id as accident_messages_id, ' .
                            'IF(owner_person_types_id = 1, CONCAT_WS(\' \', owner_lastname, owner_firstname, owner_patronymicname), owner_company) as owner, ' .
                            'kasko_acts.deductibles_amount, kasko_acts.proportionality_value, kasko_acts.deterioration_value, kasko_acts.calc_info, ' .
                            'calendar.amount as payment_amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, accidents.id as accidents_id ' .
                    'FROM ' . PREFIX . '_recovery_repairs as recovery ' .
                    'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON recovery.accident_payments_calendar_id = calendar.id ' .
                    'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
                    'JOIN ' . PREFIX . '_accidents_kasko_acts as kasko_acts ON acts.id = kasko_acts.accidents_acts_id ' .
                    'JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
                    'JOIN ' . PREFIX . '_accidents_kasko as accidnets_kasko ON accidents.id = accidnets_kasko.accidents_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidnets_kasko.items_id = kasko_items.id ' .
                    'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
                    'WHERE recovery.id = ' . intval($data['id']);
                break;
            case PRODUCT_TYPES_GO:
                $sql = 'SELECT accidents.number as accidents_number, date_format(accidents.date, \'%d.%m.%Y\') as accidents_date, CONCAT_WS(\' \', accidnets_go.owner_brand, accidnets_go.owner_model) as item, acts.accident_messages_id as accident_messages_id, ' .
                            'IF(owner_person_types_id = 1, CONCAT_WS(\' \', owner_lastname, owner_firstname, owner_patronymicname), owner_lastname) as owner, ' .
                            'go_acts.deductibles_amount, 1 as proportionality_value, go_acts.deterioration_value, go_acts.calc_info, ' .
                            'calendar.amount as payment_amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, accidents.id as accidents_id ' .
                    'FROM ' . PREFIX . '_recovery_repairs as recovery ' .
                    'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON recovery.accident_payments_calendar_id = calendar.id ' .
                    'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
                    'JOIN ' . PREFIX . '_accidents_go_acts as go_acts ON acts.id = go_acts.accidents_acts_id ' .
                    'JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
                    'JOIN ' . PREFIX . '_accidents_go as accidnets_go ON accidents.id = accidnets_go.accidents_id ' .
                    'WHERE recovery.id = ' . intval($data['id']);
                break;
            default:
                break;
        }
        
        if ($sql) {
            $info = $db->getRow($sql);
            $info['plan_days'] = $this->getPlanDays($data['id']);
            $info['fact_days'] = $this->getFactDays($data['id']);

            $sql = 'SELECT answer FROM ' . PREFIX . '_accident_messages WHERE id = ' . intval($info['accident_messages_id']);
            $info['answer'] = unserialize($db->getOne($sql));
            
            $sql = 'SELECT decision FROM ' . PREFIX . '_accident_messages WHERE id = ' . intval($info['accident_messages_id']);
            $info["decision"] = $db->getOne($sql);
        }
        
        include_once $this->object . '/form.php';
    }
    
    function prepareFields($action, $data) {
        global $db;
        
        $sql = 'SELECT * FROM ' . PREFIX . '_executed_work_acts WHERE recovery_repairs_id = ' . intval($data['id']);
        $data['avr'] = $db->getAll($sql);
        
        foreach ($data['avr'] as $key => $avr) {
            $data['avr'][ $key ]['begin_date'] = $this->convertDBFormatFormatToDate('begin_date', $avr);
            $data['avr'][ $key ]['end_date'] = $this->convertDBFormatFormatToDate('end_date', $avr);            
        }
        
        return $data;
    }
    
    function checkFields($data, $action) {
    }

    function exportInWindow($data) {
        global $db, $Authorization;

        $conditions_kasko[] = 'accidents.product_types_id = ' . PRODUCT_TYPES_KASKO;
        $conditions_go[] = 'accidents.product_types_id = ' . PRODUCT_TYPES_GO;
        
        if (intval($data['statuses_id'])) {
            $conditions_kasko[] = 'recovery.statuses_id = ' . intval($data['statuses_id']);
            $conditions_go[] = 'recovery.statuses_id = ' . intval($data['statuses_id']);
        }
        
        if (intval($data['car_services_id'])) {
            $conditions_kasko[] = 'calendar.recipients_id = ' . intval($data['car_services_id']);
            $conditions_go[] = 'calendar.recipients_id = ' . intval($data['car_services_id']);
        }
        
        if ($data['sign']) {
            $conditions_kasko[] = 'kasko_items.sign LIKE ' . $db->quote('%' . $data['sign'] . '%');
            $conditions_go[] = 'accidents_go.owner_sign LIKE ' . $db->quote('%' . $data['sign'] . '%');
        }
        
        if ($data['shassi']) {
            $conditions_kasko[] = 'kasko_items.shassi LIKE ' . $db->quote('%' . $data['shassi'] . '%');
            $conditions_go[] = 'accidents_go.owner_shassi LIKE ' . $db->quote('%' . $data['shassi'] . '%');
        }
        
        if ($data['accidents_number']) {
            $conditions_kasko[] = 'accidents.number LIKE ' . $db->quote('%' . $data['accidents_number'] . '%');
            $conditions_go[] = 'accidents.number LIKE ' . $db->quote('%' . $data['accidents_number'] . '%');
        }
        
        if ($Authorization->data['roles_id'] == ROLES_MASTER) {
            $conditions_kasko[] = 'calendar.recipients_id = ' . intval($Authorization->data['car_services_id']);
            $conditions_go[] = 'calendar.recipients_id = ' . intval($Authorization->data['car_services_id']);
        }
        
        $sql_kasko = 'SELECT recovery.id as id,accidents.id as accidents_id, accidents.number as accidents_number, car_services.title as car_services_id, kasko_items.brand as brand, kasko_items.model as model, kasko_items.sign as sign, ' .
                            'date_format(accidents.date, \'%d.%m.%Y\') as accidents_date, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, ' .
                            'calendar.amount as amount, date_format(recovery.order_date, \'%d.%m.%Y\') as order_date, date_format(recovery.get_oriented_date, \'%d.%m.%Y\') as get_oriented_date, ' .
                            'date_format(recovery.get_fact_date, \'%d.%m.%Y\') as get_fact_date, date_format(recovery.call_date, \'%d.%m.%Y\') as call_date, ' .
                            'date_format(recovery.check_oriented_date, \'%d.%m.%Y\') as check_oriented_date, recovery.sto as sto, ' .
                            'date_format(recovery.order_equipment_open_date, \'%d.%m.%Y\') as order_equipment_open_date, ' .
                            'recovery.statuses_id as statuses_id, acts.accident_messages_id as accident_messages_id, sections.title as section_title, ' .
                            'recovery.created as created_date, date_format(recovery.created, \'%d.%m.%Y\') as created_date_format, ' .
                            'recovery.repair_begin_date as repair_begin_date, date_format(recovery.repair_begin_date, \'%d.%m.%Y\') as repair_begin_date_format, ' .
                            'recovery.repair_end_date as repair_end_date, date_format(recovery.repair_end_date, \'%d.%m.%Y\') as repair_end_date_format ' .
                    'FROM ' . PREFIX . '_recovery_repairs as recovery ' .
                    'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON recovery.accident_payments_calendar_id = calendar.id ' .
                    'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
                    'JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
                    'JOIN ' . PREFIX . '_accidents_kasko as accidnets_kasko ON accidents.id = accidnets_kasko.accidents_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidnets_kasko.items_id = kasko_items.id ' .
                    'JOIN ' . PREFIX . '_car_services as car_services ON calendar.recipients_id = car_services.id ' .
                    'JOIN ' . PREFIX . '_accident_sections as sections ON accidents.accident_sections_id = sections.id ' .
                    'WHERE ' . implode(' AND ', $conditions_kasko);
                    
        $sql_go = 'SELECT recovery.id as id,accidents.id as accidents_id, accidents.number, car_services.title, accidents_go.owner_brand, accidents_go.owner_model, accidents_go.owner_sign, ' .
                            'date_format(accidents.date, \'%d.%m.%Y\'), date_format(calendar.payment_date, \'%d.%m.%Y\'), ' .
                            'calendar.amount, date_format(recovery.order_date, \'%d.%m.%Y\'), date_format(recovery.get_oriented_date, \'%d.%m.%Y\'), ' .
                            'date_format(recovery.get_fact_date, \'%d.%m.%Y\'), date_format(recovery.call_date, \'%d.%m.%Y\'), ' .
                            'date_format(recovery.check_oriented_date, \'%d.%m.%Y\'), recovery.sto, ' .
                            'date_format(order_equipment_open_date, \'%d.%m.%Y\') as order_equipment_open_date, ' .
                            'recovery.statuses_id, acts.accident_messages_id, sections.title, recovery.created as created_date, date_format(recovery.created, \'%d.%m.%Y\') as created_date_format, ' .
                            'recovery.repair_begin_date as repair_begin_date, date_format(recovery.repair_begin_date, \'%d.%m.%Y\') as repair_begin_date_format, ' .
                            'recovery.repair_end_date as repair_end_date, date_format(recovery.repair_end_date, \'%d.%m.%Y\') as repair_end_date_format ' .
                    'FROM ' . PREFIX . '_recovery_repairs as recovery ' .
                    'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON recovery.accident_payments_calendar_id = calendar.id ' .
                    'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
                    'JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
                    'JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id ' .
                    'JOIN ' . PREFIX . '_car_services as car_services ON calendar.recipients_id = car_services.id ' .
                    'JOIN ' . PREFIX . '_accident_sections as sections ON accidents.accident_sections_id = sections.id ' .
                    'WHERE ' . implode(' AND ', $conditions_go);

        $sql = 'SELECT u.id as id,accidents_id, u.accidents_number as accidents_number, u.car_services_id as car_services_id, u.brand as brand, u.model as model, u.sign as sign, ' .
                        'u.accidents_date as accidents_date, u.payment_date as payment_date, ' .
                        'u.amount as amount, u.order_date as order_date, u.get_oriented_date as get_oriented_date, ' .
                        'u.get_fact_date as get_fact_date, u.call_date as call_date, ' .
                        'u.check_oriented_date as check_oriented_date, u.sto as sto, u.order_equipment_open_date, ' .
                        'u.statuses_id as statuses_id, u.accident_messages_id as accident_messages_id, u.section_title as section_title, u.created_date, ' .
                        'u.repair_begin_date, u.repair_begin_date_format, u.repair_end_date, u.repair_end_date_format ' .
               'FROM (' . $sql_kasko . ' UNION ' . $sql_go . ') as u ' .
               'ORDER BY u.';

        $sql .= $this->getShowOrderCondition();
        
        $list = $db->getAll($sql);
        
        header('Content-Disposition: attachment; filename="report.xls"');
        header('Content-Type: ' . Form::getContentType('report.xls'));

        include_once $this->object . '/excel.php';
        exit;
    }
    
    function checkAndGenerateCustom($data) {
        global $db, $Authorization;

        if($Authorization->data['id'] != 1 || intval($data['payments_calendar_id']) === 0 || intval($data['car_services_id']) === 0)
            exit;

        $payments_calendar_id = $data['payments_calendar_id'];
        $car_services_id = $data['car_services_id'];

        $sql = 'SELECT id ' .
               'FROM ' . PREFIX . '_recovery_repairs ' .
               'WHERE accident_payments_calendar_id = ' . intval($payments_calendar_id);
        if (intval($db->getOne($sql))) return;
        
        if (!intval(CarServices::isUkravto($car_services_id))) return;

        $sql = 'SELECT product_types_id ' .
               'FROM insurance_accidents AS a ' .
               'JOIN insurance_accident_payments_calendar AS b ON b.accidents_id = a.id ' .
               'WHERE b.id = ' . intval($payments_calendar_id);
        $product_types_id = $db->getOne($sql);

        if ($product_types_id == PRODUCT_TYPES_KASKO) {
            $sql = 'INSERT INTO ' . PREFIX . '_recovery_repairs SET statuses_id = 1, accident_payments_calendar_id = ' . intval($payments_calendar_id) . ', modified = NOW(), created = NOW()';
            $db->query($sql);
        }
    }

    function checkAndGenerate($payments_calendar_id, $car_services_id) {
        global $db;

        $sql = 'SELECT id ' .
               'FROM ' . PREFIX . '_recovery_repairs ' .
               'WHERE accident_payments_calendar_id = ' . intval($payments_calendar_id);
        if (intval($db->getOne($sql))) return;
        
        if (!intval(CarServices::isUkravto($car_services_id))) return;

        $sql = 'SELECT product_types_id ' .
               'FROM insurance_accidents AS a ' .
               'JOIN insurance_accident_payments_calendar AS b ON b.accidents_id = a.id ' .
               'WHERE b.id = ' . intval($payments_calendar_id);
        $product_types_id = $db->getOne($sql);

        if ($product_types_id == PRODUCT_TYPES_KASKO) {
            $sql = 'INSERT INTO ' . PREFIX . '_recovery_repairs SET statuses_id = 1, accident_payments_calendar_id = ' . intval($payments_calendar_id) . ', modified = NOW(), created = NOW()';
            $db->query($sql);
        }
    }
    
    function getStatusesId($id) {
        global $db;
        
        $sql = 'SELECT statuses_id FROM ' . PREFIX . '_recovery_repairs WHERE id = ' . intval($id);
        return $db->getOne($sql);
    }
    
    function getPlanDays($id) {
        global $db;
        
        $answer = $this->getAnswerMessage($id);
        $sectionsId = $this->getSectionsId($id);
        
        return $this->sectionsTerms[ $sectionsId ] + $this->repairTerms[ $answer['repair_classifications_id'] ] + $this->partTerms[ $answer['parts_classifications_id'] ];
    }
    
    function getFactDays($id) {
        global $db;
        
        $sql = 'SELECT MAX(end_date) FROM ' . PREFIX . '_executed_work_acts WHERE recovery_repairs_id = ' . intval($id);
        $closedDate = $db->getOne($sql);
        
        $accidentsDate = $this->getAccidentsDate($id);
        
        if ($closedDate && $closedDate != '0000-00-00') {
            $sql = 'SELECT DATEDIFF(' . $db->quote($closedDate) . ', ' . $db->quote($accidentsDate) . ')';
            return $db->getOne($sql);
        } else {
            $sql = 'SELECT DATEDIFF(NOW(), ' . $db->quote($accidentsDate) . ')';
            return $db->getOne($sql);
        }
        
        $sql = 'SELECT IF(c.statuses_id IN (5, 6), DATEDIFF(c.closed_date, a.date), DATEDIFF(NOW(), a.date)) ' .
               'FROM ' . PREFIX . '_accidents a ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar b ON a.id = b.accidents_id ' .
               'JOIN ' . PREFIX . '_recovery_repairs c ON b.id = c.accident_payments_calendar_id ' .
               'WHERE c.id = ' . intval($id);
        return $db->getOne($sql);
    }
    
    function getAnswerMessage($id) {
        global $db;
        
        $sql = 'SELECT a.answer ' .
               'FROM ' . PREFIX . '_accident_messages a ' .
               'JOIN ' . PREFIX . '_accidents_acts b ON a.id = b.accident_messages_id ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar c ON b.id = c.acts_id ' .
               'JOIN ' . PREFIX . '_recovery_repairs d ON c.id = d.accident_payments_calendar_id ' .
               'WHERE d.id = ' . intval($id);
        return unserialize($db->getOne($sql));
    }
    
    function getSectionsId($id) {
        global $db;
        
        $sql = 'SELECT a.accident_sections_id ' .
               'FROM ' . PREFIX . '_accidents a ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar b ON a.id = b.accidents_id ' .
               'JOIN ' . PREFIX . '_recovery_repairs c ON b.id = c.accident_payments_calendar_id ' .
               'WHERE c.id = ' . intval($id);
        return $db->getOne($sql);
    }
    
    function getRepairAmount($id) {
        global $db;
        
        $sql = 'SELECT a.amount ' .
               'FROM ' . PREFIX . '_accident_payments_calendar a ' .
               'JOIN ' . PREFIX . '_recovery_repairs b ON a.id = b.accident_payments_calendar_id ' .
               'WHERE b.id = ' . intval($id);
        return floatval($db->getOne($sql));
    }
    
    function getClosedDate($id) {
        global $db;
        
        $sql = 'SELECT closed_date ' .
               'FROM ' . PREFIX . '_recovery_repairs ' .
               'WHERE id = ' . intval($id);
    }
    
    function getAccidentsDate($id) {
        global $db;
        
        $sql = 'SELECT a.date ' .
               'FROM ' . PREFIX . '_accidents a ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar b ON a.id = b.accidents_id ' .
               'JOIN ' . PREFIX . '_recovery_repairs c ON b.id = c.accident_payments_calendar_id ' .
               'WHERE c.id = ' . intval($id);
        return $db->getOne($sql);
    }
    
    function getMonitoringInWindow($data) {
        global $db;
        
        $sql = 'SELECT id, date_format(created, \'%d.%m.%Y %H:%i\') as created_format, account, text ' .
               'FROM ' . PREFIX . '_recovery_repairs_monitoring ' . 
               'WHERE recovery_repairs_id = ' . intval($data['id']) . ' ' .
               'ORDER BY created';
        $comments = $db->getAll($sql);
        
        $result = '<table cellspacing="5" cellpading="5">';
        
        foreach($comments as $comment) {
            $result .= '<tr>';
            $result .= '<td>' . $comment['created_format'] . '</td>';
            $result .= '<td>' . $comment['account'] . '</td>';
            $result .= '<td>' . $comment['text'] . '</td>';
            $result .= '</tr>';
        }
        
        $result .= '</table>';
        
        echo $result;
        exit;
    }
    
    function insertToMonitoring($id, $accounts_id, $account, $text) {
        global $db;
        
        $sql = 'INSERT INTO ' . PREFIX . '_recovery_repairs_monitoring ' .
               'SET recovery_repairs_id = ' . intval($id) . ', ' .
                    'created = NOW(), ' .
                    'text = ' . $db->quote($text) . ', ' .
                    'accounts_id = ' . intval($accounts_id) . ', ' .
                    'account = ' . $db->quote($account);
        $db->query($sql);
    }
    
    function checkUpdateFields($data) {
        global $db;
        
        $sql = 'SELECT * ' .
               'FROM ' . PREFIX . '_recovery_repairs ' .
               'WHERE id = ' . intval($data['id']);
        $oldData = $db->getRow($sql);
        
        $add = array();
        $remove = array();
        $edit = array();
        
        foreach ($this->checkUpdateFieldsArray as $alias => $title) {
            switch ($alias) {
                //int
                case 'sto':
                    if (intval($oldData[ $alias ]) == intval($data[ $alias ])) {
                        continue;
                    } else {
                        $edit[] = $title;
                    }
                    break;
                //date
                default:
                    if ($oldData[ $alias ] == $data[ $alias ]) {
                        continue;
                    } elseif (($oldData[ $alias ] == null || $oldData[ $alias ] == '0000-00-00') && $data[ $alias ] != '--') {
                        $add[] = $title;
                    } elseif ($oldData[ $alias ] != null && $oldData[ $alias ] != '0000-00-00' && $data[ $alias ] == '--') {
                        $remove[] = $title;
                    } elseif ($oldData[ $alias ] != null && $oldData[ $alias ] != '0000-00-00' && $data[ $alias ] != '--') {
                        $edit[] = $title;
                    } else {
                        continue;
                    }
                    break;
            }           
        }
        
        $message = '';
        
        if (sizeOf($add)) {
            $message .= 'додав поля: ' . implode(', ', $add) . '<br/>';
        }
        if (sizeOf($edit)) {
            $message .= 'змінив поля: ' . implode(', ', $edit) . '<br/>';
        }
        if (sizeOf($remove)) {
            $message .= 'видалив поля: ' . implode(', ', $remove) . '<br/>';
        }

        return $message;
    }

}

?>