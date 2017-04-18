<?
/*
 * Title: tasks class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Reports.class.php';
require_once 'BankDay.php';

define('TASK_TYPES_ACCIDENT_PAYMENT_NOTIFICATION', 1);
define('TASK_TYPES_ACCIDENT_REPAIR', 2);
define('TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT', 3);
define('TASK_TYPES_POLICIES_PROLONGATION', 4);
define('TASK_TYPES_POLICIES_RENEW_AMOUNT', 5);
define('TASK_TYPES_APPLICATION_ACCIDENTS', 6);
define('TASK_TYPES_AXAPTA', 7);
define('TASK_TYPES_POLICIES_GO_BANK', 8);
define('TASK_TYPES_POLICIES_GO', 9);
 
class Tasks extends Form {
    public static $vip = array(13155);
    public static $kiev = array(13212, 13534, 13155, 12494);
    public static $region = array(13212, 13534, 13155, 12494);

    public static $brands = array(7, 9, 11, 13, 14);
    public static $agencies = array(55,56,52,848,63);

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
                            'table'             => 'tasks'),
                        array(
                            'name'              =>  'date',
                            'description'       =>  'Дата виконання задачі',
                            'type'              =>  fldDate,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  true,
                                    'view'      =>  true,
                                    'update'    =>  false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  false
                                ),
                            'orderPosition'     =>  1,
                            'width'             =>  100,
                            'table'             =>  'tasks'),
                        array(
                            'name'              =>  'task_types_id',
                            'description'       =>  'Тип',
                            'type'              =>  fldSelect,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  true,
                                    'view'      =>  false,
                                    'update'    =>  true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  false
                                ),
                            'orderPosition'     =>  2,
                            'width'             =>  80,
                            'sourceTable'       =>  'task_types',
                            'table'             =>  'tasks',
                            'selectField'       =>  'title',
                            'orderField'        =>  'id'),
                        array(
                            'name'              =>  'CONCAT(insurance_policies.insurer) as policies_insurer',
                            'description'       =>  'Страхувальник',
                            'type'              =>  fldText,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  false,
                                    'view'      =>  false,
                                    'update'    =>  false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  true
                                ),
                            'orderPosition'     =>  3,
                            'orderName'         =>  'policies_insurer',
                            'withoutTable'      =>  false,
                            'width'             =>  60,
                            'table'             =>  'accidents'),
                        array(
                            'name'              =>  'CONCAT(insurance_policies.number) as policies_number',
                            'description'       =>  'Договір',
                            'type'              =>  fldText,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  false,
                                    'view'      =>  false,
                                    'update'    =>  false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  true
                                ),
                            'orderPosition'     =>  4,
                            'orderName'         =>  'policies_number',
                            'withoutTable'      =>  false,
                            'width'             =>  60,
                            'table'             =>  'accidents'),
                        array(
                            'name'              =>  'begin_datetime_format',
                            'description'       =>  'Початок',
                            'type'              =>  fldDate,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  false,
                                    'view'      =>  false,
                                    'update'    =>  false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  true
                                ),
                            'orderPosition'     =>  5,
                            'orderName'         =>  'begin_datetime',
                            'withoutTable'      =>  false,
                            'width'             =>  60,
                            'table'             =>  'accidents'),
                        array(
                            'name'              =>  'interrupt_datetime_format',
                            'description'       =>  'Закінчення',
                            'type'              =>  fldDate,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  false,
                                    'view'      =>  false,
                                    'update'    =>  false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  true
                                ),
                            'orderPosition'     =>  6,
                            'orderName'         =>  'interrupt_datetime',
                            'withoutTable'      =>  false,
                            'width'             =>  60,
                            'table'             =>  'accidents'),
                        array(
                            'name'              =>  'CONCAT(insurance_accidents.number) as accidents_number',
                            'description'       =>  'Справа',
                            'type'              =>  fldText,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  false,
                                    'view'      =>  false,
                                    'update'    =>  false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  true
                                ),
                            'orderPosition'     =>  7,
                            'orderName'         =>  'accidents_number',
                            'withoutTable'      =>  false,
                            'width'             =>  60,
                            'table'             =>  'accidents'),
                        array(
                            'name'              =>  'CONCAT(insurance_accidents_acts.number) as acts_number',
                            'description'       =>  'Акт',
                            'type'              =>  fldText,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  false,
                                    'view'      =>  false,
                                    'update'    =>  false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  true
                                ),
                            'orderPosition'     =>  8,
                            'orderName'         =>  'acts_number',
                            'withoutTable'      =>  false,
                            'width'             =>  60,
                            'table'             =>  'accidents_acts'),
                        array(
                            'name'              =>  'payment_date',
                            'description'       =>  'Дата сплати',
                            'type'              =>  fldDate,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  false,
                                    'view'      =>  false,
                                    'update'    =>  false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  true
                                ),
                            'orderPosition'     =>  9,
                            'width'             =>  60,
                            'table'             =>  'accident_payments_calendar'),
                        array(
                            'name'              =>  'task_statuses_call_id',
                            'description'       =>  'Дзвінок',
                            'type'              =>  fldSelect,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  true,
                                    'view'      =>  false,
                                    'update'    =>  true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  false
                                ),
                            'orderPosition'     =>  10,
                            'width'             =>  50,
                            'table'             =>  'tasks'),
                        array(
                            'name'              =>  'sto_call',
                            'description'       =>  'Дзвінок СТО',
                            'type'              =>  fldText,
                            'display'           =>
                                array(
                                    'show'      =>  false,
                                    'insert'    =>  true,
                                    'view'      =>  false,
                                    'update'    =>  true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  true
                                ),
                            'orderPosition'     =>  11,
                            'width'             =>  50,
                            'table'             =>  'tasks'),
                        array(
                            'name'              =>  'task_statuses_id',
                            'description'       =>  'Статус',
                            'type'              =>  fldSelect,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  true,
                                    'view'      =>  false,
                                    'update'    =>  true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  false
                                ),
                            'structure'         => 'tree',
                            'orderPosition'     =>  12,
                            'width'             =>  50,
                            'sourceTable'       =>  'task_statuses',
                            'table'             =>  'tasks',
                            'selectField'       =>  'full_title',
                            'orderField'        =>  'num_l'),
                        array(
                            'name'              =>  'performers_id',
                            'description'       =>  'Виконавець',
                            'type'              =>  fldText,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  true,
                                    'view'      =>  false,
                                    'update'    =>  false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  false
                                ),
                            'orderPosition'     =>  13,
                            'width'             =>  100,
                            'table'             =>  'tasks'),
                        array(
                            'name'              =>  'created',
                            'description'       =>  'Створено',
                            'type'              =>  fldDate,
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  true,
                                    'view'      =>  false,
                                    'update'    =>  false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  false
                                ),
                            'orderPosition'     =>  17,
                            'width'             =>  50,
                            'table'             =>  'tasks'),
                        array(
                            'name'              =>  'modified',
                            'description'       =>  'Редаговано',
                            'type'              =>  fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      =>  true,
                                    'insert'    =>  true,
                                    'view'      =>  false,
                                    'update'    =>  true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=>  true
                                ),
                            'orderPosition'     =>  18,
                            'width'             =>  50,
                            'table'             =>  'tasks'),
                        array(
                            'name'              =>  'question',
                            'description'       =>  'Питання',
                            'type'              =>  fldText,
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
                        'orderPosition'     =>  14,
                        'width'             =>  50,
                        'table'             => 'tasks'),
                        array(
                            'name'              =>  'answer',
                            'description'       =>  'Відповідь',
                            'type'              =>  fldHidden,
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
                        'table'             => 'tasks'),
                        array(
                            'name'              =>  'comment',
                            'description'       =>  'Коментар',
                            'type'              =>  fldText,
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
                            'orderPosition'     =>  14,
                            'width'             =>  150,
                            'table'             => 'tasks'),
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 1,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'date'
                    )
            );

    var $no_begin_repair_reason = array(
        0   =>  '',
        1   =>  'По бажанню клієнта',
        7   =>  'Зауважень немає',
        2   =>  'Відсутність запасних частин',
        5   =>  'Відсутність працівника',
        4   =>  'Завантаженність/черга на СТО',
        3   =>  'Не виклик клієнта на СТО',
        6   =>  'Інше'
    );
    var $no_end_repair_reason = array(
        0   =>  '',
        1   =>  'По бажанню клієнта',
        7   =>  'Зауважень немає',
        2   =>  'Відсутність запасних частин',
        5   =>  'Відсутність працівника',
        4   =>  'Завантаженність/черга на СТО',
        3   =>  'Не виклик клієнта на СТО',
        6   =>  'Інше'
    );

    var $task_statuses_call_title = array(
        TASK_STATUSES_CALL_NO           =>  'Не додзвонились',
        TASK_STATUSES_CALL_YES          =>  'Додзвонились'
    );
    
    var $task_types_title = array(
        TASK_TYPES_COMPENSATION_MESSAGE =>  'Повідомлення про страхове відшкодування',
        TASK_TYPES_REPAIR               =>  'Відновлювальний ремонт'
    );

    function Tasks($data, $objectTitle=null) {

        Form::Form($data);

        $this->messages['plural'] = 'Задачі';
        $this->messages['single'] = 'Задача';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => true,
                    'view'      => true,
                    'delete'    => true,
                    'export'    => true,
                    'report'    => true,
                    'transfer'  => true,
                    'axapta'    => true);
                break;
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_MASTER:
                $this->permissions = array(
                    'show'      => false,
                    'insert'    => false,
                    'update'    => false,
                    'view'      => false,
                    'delete'    => false);
                break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => true,
                    'view'      => true,
                    'delete'    => false,
                    'export'    => ($Authorization->data['agencies_id'] == 1469) ? true : false);
                break;
        }
    }

    function getTemplate($task_types_id) {
        switch ($task_types_id){
            case TASK_TYPES_REPAIR:
            case TASK_TYPES_COMPENSATION_MESSAGE:
                return 'compensation_message.php';
                break;
            case TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT:
            case TASK_TYPES_POLICIES_PROLONGATION:
            case TASK_TYPES_POLICIES_RENEW_AMOUNT:
                return 'sale_tasks.php';
                break;
        }
    }

    function getQuestionFields(&$data){
        $data['date_begin_repair'] = $data['task_question']['date_begin_repair'];
        $data['no_begin_repair_reason'] = $data['task_question']['no_begin_repair_reason'];
        $data['date_end_repair'] = $data['task_question']['date_end_repair'];
        $data['no_end_repair_reason'] = $data['task_question']['no_end_repair_reason'];
        $data['generate_repair'] = $data['task_question']['generate_repair'];
        $data['no_repair'] = $data['task_question']['no_repair'];
        $data['no_repair_reason'] = $data['task_question']['no_repair_reason'];
        
        if ($data['task_types_id'] == TASK_TYPES_APPLICATION_ACCIDENTS) {
            $data['app'] = $data['task_question']['app'];
            $data['sto'] = $data['task_question']['sto'];
            $data['app_date'] = $data['task_question']['app_date'];
            
            $data['app_date_day'] = substr($data['app_date'], 0, 2);
            $data['app_date_month'] = substr($data['app_date'], 3, 2);
            $data['app_date_year'] = substr($data['app_date'], 6, 4);
        }
    }

    function getAccidentsId($id) {
        global $db;

        $sql = 'SELECT accidents_id ' .
               'FROM ' . PREFIX . '_accident_payments_calendar ' .
               'JOIN ' . PREFIX . '_tasks ON ' . PREFIX . '_accident_payments_calendar.tasks_id = ' . PREFIX . '_tasks.top ' .
               'WHERE tasks.id = ' . intval($id);
        return $db->getOne($sql);
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template = null) {
        global $db, $Log, $Authorization;

        //проверяем полномочия
        $this->checkPermissions('update', $data);

        //определяем id записи к изменению
        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        //устанавливаем таблицы и поля для загрузки данных
        $this->setTables('load');
        $this->getFormFields('update');

        $is_accidents = $data['is_accidents'];
        $hiddens = $data;
        
        switch ($this->getProductTypesId($data['id'])) {
            case PRODUCT_TYPES_KASKO:
                $fields[] = 'kasko_items.brands_id';
                $fields[] = 'CONCAT(kasko_items.brand, \'/\', kasko_items.model) as item';
                $fields[] = 'kasko_items.sign';
                $fields[] = 'IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company) as insurer_name';
                $fields[] = 'policies_kasko.insurer_phone as insurer_phone';
                $fields[] = 'policies.clients_id';
                $fields[] = 'accidents.damage as damage';

                $joins[] = 'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id';
                $joins[] = 'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id';
                $joins[] = 'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id';
                break;
            case PRODUCT_TYPES_GO:
                $fields[] = 'CONCAT(accidents_go.owner_brand, \'/\', accidents_go.owner_model) as item';
                $fields[] = 'accidents_go.owner_sign as sign';
                $fields[] = 'accidents_go.victim_damage_note as damage';
                $fields[] = 'IF(policies_go.person_types_id = 1, CONCAT_WS(\' \', policies_go.insurer_lastname, policies_go.insurer_firstname, policies_go.insurer_patronymicname), policies_go.insurer_lastname) as insurer_name';
                $fields[] = 'policies_go.insurer_phone as insurer_phone';
                $fields[] = 'policies.clients_id';

                $joins[] = 'JOIN ' . PREFIX . '_policies_go as policies_go ON tasks.policies_id = policies_go.policies_id';
                $joins[] = 'JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id';

                $conditions[] = 'accidents_go.owner_types_id = 2';
                break;
        }

        $conditions[] = 'tasks.id = ' . intval($data['id']);

        $sql = 'SELECT tasks.id, tasks.date as tasks_date, tasks.task_types_id, tasks.task_statuses_id, tasks.task_statuses_call_id, tasks.sto_call, tasks.top, ' .
                       'acts.repair_classifications_id, repair_classifications.term, car_services.ukravto as ukravto, ' .
                       'calendar.id as calendar_id, calendar.recipient_types_id, calendar.amount as payment_amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date_format, calendar.payment_recipient, ' .
                       'acts.id as acts_id, acts.number as acts_number, accidents.id as accidents_id, accidents.number as accidents_number, policies.id as policies_id, policies.number as policies_number, ' .
                       'tasks.answer, tasks.question, tasks.comment, policies.product_types_id, ' .
                       'CONCAT(accidents.applicant_lastname, \' \', accidents.applicant_firstname, \' \', accidents.applicant_patronymicname) as applicant, accidents.applicant_phones, accidents.description' .
                       ((sizeof($fields) != 0) ? ', ' .implode(',', $fields) . ' ' : ' ') .
               'FROM ' . PREFIX . '_tasks as tasks ' .
               'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON tasks.top = calendar.tasks_id ' .
               'LEFT JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
               'LEFT JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as policies ON policies.id = tasks.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_accounts as accounts ON accounts.id = tasks.performers_id ' .
               'LEFT JOIN ' . PREFIX . '_repair_classifications as repair_classifications ON acts.repair_classifications_id = repair_classifications.id ' .
               'LEFT JOIN ' . PREFIX . '_car_services as car_services ON car_services.id = calendar.recipients_id AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' ' .
               ((sizeof($joins) != 0) ? implode(' ', $joins) : '') .
               ((sizeof($conditions) != 0) ? (' WHERE ' . implode(' AND ', $conditions)) . ' ' : '') .
               'GROUP BY tasks.id';
        $data = $db->getRow($sql);

        if (in_array($data['task_types_id'], array(TASK_TYPES_REPAIR, TASK_TYPES_COMPENSATION_MESSAGE))
            && $data['product_types_id'] == PRODUCT_TYPES_KASKO) {
                $sql = 'SELECT COUNT(tasks.id) ' .
                       'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
                       'JOIN ' . PREFIX . '_tasks as tasks ON calendar.tasks_id = tasks.top ' .
                       'WHERE calendar.accidents_id = ' . intval($data['accidents_id']) . ' AND tasks.task_types_id = ' . TASK_TYPES_REPAIR;
                $data['count_tasks_repair'] = $db->getOne($sql);
        }

        $data['is_accidents'] = $is_accidents;
        $data['hiddens'] = $hiddens;

        $data['task_answer'] = unserialize($data['answer']);
        $data['task_question'] = unserialize($data['question']);

        $this->getQuestionFields($data);

        return $this->showForm($data, $action, $actionType);
    }

    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Authorization;

        $result = parent::checkPermissions($action, $data);

        return $result;
    }

    function getRowClass($row, $i) {
        global $db;

        $result = parent::getRowClass($row, $i);

        if(in_array($row['task_statuses_id'], array(2, 5))){
            $result .= ' green';
        } else {
            switch ($row['task_types_id']) {
                case TASK_TYPES_ACCIDENT_PAYMENT_NOTIFICATION:
                case TASK_TYPES_ACCIDENT_REPAIR:
                    if($row['days'] < 0){
                        $result .= ' red';
                    } elseif($row['days'] == 0) {
                        $result .= ' yellow';
                    }
                    break;
                case TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT:
                case TASK_TYPES_POLICIES_PROLONGATION:
                case TASK_TYPES_POLICIES_RENEW_AMOUNT:
                    switch ($row['task_statuses_id']) {
                        case 3:
                            $result .= ' red';
                            break;
                    }
                    break;
            }
        }

        return $result;
    }

    function generateTask($task_types_id, $payments_calendar_id, $date, $tasks_id=null){
        global $db;

        $insert_tasks_id = 0;
        $generate = true;

        if(!$tasks_id && !in_array($task_types_id, array(TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT, TASK_TYPES_POLICIES_PROLONGATION, TASK_TYPES_POLICIES_RENEW_AMOUNT))){
            $calendar_tasks_id = Tasks::getTasksIdByCalendarId($payments_calendar_id);

            if($calendar_tasks_id > 0 || in_array(Tasks::getCalendarPaymentStatuses($payments_calendar_id), array(PAYMENT_STATUSES_PAYED, PAYMENT_STATUSES_OVER))){
                $generate = false;
            }
        }

        if(!Tasks::isHasChildID($tasks_id) && $task_types_id && $generate){
            $task['date'] = $date;
            $task['task_types_id'] = $task_types_id;
            $task['task_statuses_call_id'] = TASK_STATUSES_CALL_NO;
            $task['question'] = Tasks::getQuestionTasks($tasks_id);

            switch ($task['task_types_id']) {
                case TASK_TYPES_ACCIDENT_PAYMENT_NOTIFICATION:
                    $task['task_statuses_id'] = 1;
                    break;
                case TASK_TYPES_ACCIDENT_REPAIR:
                    $task['task_statuses_id'] = 4;
                    break;
                case TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT:
                    $task['task_statuses_id'] = 37;
                    break;
                case TASK_TYPES_POLICIES_PROLONGATION:
                    $task['task_statuses_id'] = 38;
                    break;
                case TASK_TYPES_POLICIES_RENEW_AMOUNT:
                    $task['task_statuses_id'] = 39;
                    $task['question'] = 'Відновлення страхової суми за договором';
                    break;
            }

            if (in_array($task['task_types_id'], array(TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT, TASK_TYPES_POLICIES_PROLONGATION, TASK_TYPES_POLICIES_RENEW_AMOUNT))) {
                $persons = array_merge(self::$vip, self::$kiev, self::$region);
                shuffle($persons);
                $task['performers_id'] = $persons[0];

                $sql =  'SELECT policies_id ' .
                        'FROM ' . PREFIX . '_accident_payments_calendar ' .
                        'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_payments_calendar.accidents_id = ' . PREFIX . '_accidents.id ' .
                        'WHERE ' . PREFIX . '_accident_payments_calendar.id = ' . intval($payments_calendar_id);
                $task['policies_id'] = $db->getOne($sql);

                $payments_calendar_id = null;
            }

            $insert_tasks_id = Tasks::insertTask($task);
            if ($insert_tasks_id && $payments_calendar_id) {
                Tasks::setAddValues($insert_tasks_id, $payments_calendar_id, $tasks_id);
            }
        }

        return $insert_tasks_id;
    }

    function getQuestionTasks($tasks_id){
        global $db;

        return $db->getOne('SELECT question FROM ' . PREFIX . '_tasks WHERE id = ' . intval($tasks_id));
    }

    function isHasChildID($tasks_id){
        global $db;

        $child_id = intval($db->getOne('SELECT child_id FROM ' . PREFIX . '_tasks WHERE id = ' . intval($tasks_id)));

        if($child_id){
            return true;
        }else{
            return false;
        }
    }

    function getTasksIdByCalendarId($payments_calendar_id){
        global $db;

        return intval($db->getOne('SELECT tasks_id FROM ' . PREFIX . '_accident_payments_calendar WHERE id = ' . intval($payments_calendar_id)));
    }

    function getCalendarPaymentStatuses($payments_calendar_id){
        global $db;

        return intval($db->getOne('SELECT payment_statuses_id FROM ' . PREFIX . '_accident_payments_calendar WHERE id = ' . intval($payments_calendar_id)));
    }

    function setNumber($id){
        global $db;

        $count = $db->getOne('SELECT COUNT(*) FROM ' . PREFIX . '_tasks WHERE top = (SELECT top FROM ' . PREFIX . '_tasks WHERE id = ' . intval($id) . ')');

        $number = $this->getPaymentsCalendarNumber($id) . '-' . $count;

        $db->query('UPDATE ' . PREFIX . '_tasks SET number = ' . $db->quote($number) . ' WHERE id = ' . intval($id));
    }

    function setAddValues($tasks_id, $payment_calendar_id, $parent_id){
        global $db;

        if($tasks_id > 0){
            if ($parent_id > 0) {
                $db->query('UPDATE ' . PREFIX . '_tasks SET child_id = ' . intval($tasks_id) . ' WHERE id = ' . intval($parent_id));
                $db->query('UPDATE ' . PREFIX . '_tasks SET top = ' . $db->getOne('SELECT top FROM ' . PREFIX . '_tasks WHERE id = ' . intval($parent_id)) . ', policies_id = ' . $db->getOne('SELECT policies_id FROM ' . PREFIX . '_tasks WHERE id = ' . intval($parent_id)) . ' WHERE id = ' . intval($tasks_id));
            } else {
                $parent_id = $tasks_id;

                $sql =  'SELECT policies_id ' .
                        'FROM ' . PREFIX . '_accident_payments_calendar ' .
                        'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_payments_calendar.accidents_id = ' . PREFIX . '_accidents.id ' .
                        'WHERE ' . PREFIX . '_accident_payments_calendar.id = ' . intval($payment_calendar_id);
                $policies_id = $db->getOne($sql);

                $db->query('UPDATE ' . PREFIX . '_tasks SET top = ' . intval($tasks_id) . ', policies_id = ' . intval($policies_id) . ' WHERE id = ' . intval($tasks_id));
                $db->query('UPDATE ' . PREFIX . '_accidents_acts as acts, ' . PREFIX . '_accidents as accidents, ' . PREFIX . '_accident_payments_calendar as calendar ' .
                           'SET acts.repair_classifications_id = accidents.repair_classifications_id ' .
                           'WHERE accidents.id = acts.accidents_id AND acts.id = calendar.acts_id AND calendar.id = ' . intval($payment_calendar_id));
                $db->query('UPDATE ' . PREFIX . '_accident_payments_calendar SET tasks_id = ' . intval($tasks_id) . ' WHERE id = ' . intval($payment_calendar_id));
            }
        }
    }

    function insertTask($data){
        global $db, $Log;

        $sql =  'INSERT INTO ' . PREFIX . '_tasks SET ' .
                'policies_id = ' . intval($data['policies_id']) . ', ' .
                'policy_payments_calendar_id = ' . intval($data['policy_payments_calendar_id']) . ', ' .
                'date = ' . $db->quote($data['date']) . ', ' .
                'task_types_id = ' . intval($data['task_types_id']) . ', ' .
                'task_statuses_call_id   = ' . intval($data['task_statuses_call_id']) . ', ' .
                'sto_call   = ' . intval($data['sto_call']) . ', ' .
                'task_statuses_id   = ' . intval($data['task_statuses_id']) . ', ' .
                'performers_id = ' . intval($data['performers_id']) . ', ' .
                'question = ' . $db->quote($data['question']) . ', ' .
                'created = NOW(), ' .
                'modified = NOW()';
        $db->query($sql);

        return mysql_insert_id();
    }

    function getSubId(&$id, $parent_id) {
        global $db;

        $sql =  'SELECT id, title, parent_id ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE parent_id = ' . intval($parent_id);
        $res = $db->query($sql);

        while ($res->fetchInto($row)) {
            $id[] = $row['id'];
            $this->getSubId($id, $row['id']);
        }
    }

    function show($data, $action = 'show', $template='show.php', $limit=true){
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

        $hidden['do'] = $data['do'];//'Tasks|show';

        $conditions = array();

        switch ($Authorization->data['roles_id'] && $Authorization->data['agencies_id'] == 1469) {
            case ROLES_AGENT:
                $conditions[] = 'performers_id = ' . intval($Authorization->data['id']);
                $conditions[] = ' ' . PREFIX . '_tasks.created > 0 ';
                break;
        }

        if (eregi('Accidents', $data['do']) || eregi('AccidentActs', $data['do'])) {
            if ($data['do'] == 'Accidents|view') {
                $data['is_accidents'] = intval($data['id']);
                $hidden['id'] = intval($data['id']);
                $conditions[] = PREFIX . '_accidents.id = ' . intval($data['is_accidents']);
            } else {
                $data['is_accidents'] = intval($data['accidents_id']);
                $hidden['accidents_id'] = intval($data['accidents_id']);
                $conditions[] = PREFIX . '_accidents.id = ' . intval($data['is_accidents']);
            }
        }

        if ($Authorization->data['roles_id'] == ROLES_MANAGER && in_array(56, $Authorization->data['account_groups_id']) && $Authorization->data['id'] != 11449) {
            $conditions[] = PREFIX . '_tasks.agencies_id NOT IN(1, 1469)';
        }

        $hidden['product_types_id'] = $data['product_types_id'];

        switch ($Authorization->data['roles_id']) {
            case ROLES_MASTER:
                $conditions[] = PREFIX . '_accident_payments_calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE;
                break;
            case ROLES_AGENT:
                $conditions[] = PREFIX . '_tasks.agencies_id = ' . $Authorization->data['agencies_id'];
                break;
        }

        if ($data['history'] == 1) {
            $this->messages['plural'] = 'Задачі по акту';
            $conditions[] = PREFIX . '_tasks.top = ' . intval($data['top']);
        }

        if ($data['history'] == 2) {
            $this->messages['plural'] = 'Задачі по договору';
            $conditions[] = PREFIX . '_policies.id = ' . intval($data['policies_id']);
        }

        if ($data['task_types_id'] && !intval($data['history'])) {
            $conditions[] = PREFIX . '_tasks.task_types_id = ' . intval($data['task_types_id']);
            $hidden['task_types_id'] = $data['task_types_id'];
        }

        if ($data['task_statuses_call_show_id']) {
            $conditions[] = PREFIX . '_tasks.task_statuses_call_id = ' . intval($data['task_statuses_call_show_id']);
            $hidden['task_statuses_call_show_id'] = $data['task_statuses_call_show_id'];
        }

        if ($data['task_statuses_id'] && !intval($data['history'])) {
            if($data['task_statuses_id'] != -1){
                $hidden['task_statuses_id'] = $data['task_statuses_id'];
                $conditions[] = PREFIX . '_tasks.task_statuses_id =' . intval($data['task_statuses_id']);
            }
/*
        } elseif (!$data['history'] && !eregi('Accidents', $data['do']) && !eregi('AccidentActs', $data['do'])) {
            $data['task_statuses_id'] = TASK_STATUSES_IN_WORK;
            $hidden['task_statuses_id'] = $data['task_statuses_id'];
            $conditions[] = PREFIX . '_tasks.task_statuses_id =' . intval($data['task_statuses_id']);
*/
        }

        if ($data['from']) {
            $hidden['from'] = $data['from'];
            $conditions[] = 'TO_DAYS(' . PREFIX . '_tasks.date) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
        }

        if ($data['to']) {
            $hidden['to'] = $data['to'];
            $conditions[] =  'TO_DAYS(' . PREFIX . '_tasks.date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }

        if ($data['performers_name']) {
            $hidden['performers_name'] = $data['performers_name'];
            $conditions[] = 'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) LIKE ' . $db->quote($data['performers_name'] . '%');
        }

        if ($data['accidents_number']) {
            $hidden['accidents_number'] = $data['accidents_number'];
            $conditions[] = PREFIX . '_accidents.number LIKE ' . $db->quote($data['accidents_number'] . '%');
        }

        if ($data['policies_number']) {
            $hidden['policies_number'] = $data['policies_number'];
            $conditions[] = PREFIX . '_policies.number LIKE ' . $db->quote($data['policies_number'] . '%');
        }

        if ($data['insurer']) {
            $hidden['insurer'] = $data['insurer'];
            $conditions[] = PREFIX . '_policies.insurer LIKE ' . $db->quote($data['insurer'] . '%');
        }
        
        if (intval($data['financial_institutions_id'])) {
            $hidden['financial_institutions_id'] = $data['insurer'];
            $conditions[] = PREFIX . '_policies_kasko.financial_institutions_id ='.intval($data['financial_institutions_id']);
        }

        $this->setTables('show');
        $this->setShowFields();

        $sql =  'SELECT ' . PREFIX . '_tasks.id, ' . PREFIX . '_tasks.top, ' . PREFIX . '_tasks.child_id, date_format( ' . PREFIX . '_tasks.date, \'%d.%m.%Y\' ) AS date_format, ' . PREFIX . '_tasks.task_types_id, ' . PREFIX . '_tasks.task_statuses_id, ' . PREFIX . '_tasks.comment as comment, ' .
                PREFIX . '_policies.number as policies_number, date_format(' . PREFIX . '_policies.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetime_format, date_format(' . PREFIX . '_policies.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') as interrupt_datetime_format, ' . PREFIX . '_task_types.title AS task_types_title, ' . PREFIX . '_task_statuses.full_title AS task_statuses_title, ' . PREFIX . '_tasks.policies_id, ' . PREFIX . '_policies.product_types_id, ' . PREFIX . '_policies.clients_id, ' .
                'CASE ' . PREFIX . '_tasks.task_statuses_call_id WHEN 1 THEN \'Не додзвонились\' WHEN 2 THEN \'Додзвонились\' END as task_statuses_call_title, ' .
                PREFIX . '_accidents_acts.id as acts_id, ' . PREFIX . '_accidents_acts.number as acts_number, ' . PREFIX . '_accidents.id as accidents_id, ' . PREFIX . '_accidents.number as accidents_number, date_format(' . PREFIX . '_tasks.created, \'%d.%m.%Y\') as created_format, date_format(' . PREFIX . '_tasks.modified, \'%d.%m.%Y\') as modified_format, ' .
                'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) as performers_id, ' . PREFIX . '_tasks.question, TO_DAYS(' . PREFIX . '_tasks.date) - TO_DAYS(NOW()) as days, ' .
                'date_format(' . PREFIX . '_accident_payments_calendar.payment_date, ' . $db->quote(DATE_FORMAT) . ') as payment_date, ' . PREFIX . '_policies.insurer as policies_insurer, ' .
                PREFIX . '_accidents.product_types_id as accident_product_types_id, important_person,client_groups_id as  important_person_groups_id, ' . PREFIX . '_financial_institutions.title as financial_institutions_title ' .
                'FROM ' . PREFIX . '_tasks ' .
                'JOIN ' . PREFIX . '_task_types ON ' . PREFIX . '_tasks.task_types_id = ' . PREFIX . '_task_types.id ' .
                'JOIN ' . PREFIX . '_task_statuses ON ' . PREFIX . '_tasks.task_statuses_id = ' . PREFIX . '_task_statuses.id ' .
                'LEFT JOIN ' . PREFIX . '_accident_payments_calendar ON ' . PREFIX . '_tasks.top = ' . PREFIX . '_accident_payments_calendar.tasks_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_payments_calendar.accidents_id = ' . PREFIX . '_accidents.id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_acts ON ' . PREFIX . '_accidents_acts.id = ' . PREFIX . '_accident_payments_calendar.acts_id ' .
                'LEFT JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_accounts.id = ' . PREFIX . '_tasks.performers_id ' .
                'LEFT JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_tasks.policies_id = ' . PREFIX . '_policies.id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_tasks.policies_id = ' . PREFIX . '_policies_kasko.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_clients.id = ' . PREFIX . '_policies.clients_id ' .
                'LEFT JOIN ' . PREFIX . '_financial_institutions ON ' . PREFIX . '_policies_kasko.financial_institutions_id = ' . PREFIX . '_financial_institutions.id ' .
                ((sizeof($conditions) != 0) ? (' WHERE ' . implode(' AND ', $conditions)) . ' ' : '') .
                'ORDER BY ';
        $total = $db->getOne(transformToGetCount($sql));

        echo '<!--' . $sql . '-->';

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);
//_dump($sql);

        $sql =  'SELECT id, title ' .
                'FROM ' . PREFIX . '_task_types ' .
                'ORDER BY title';
        $task_types = $db->getAll($sql, 60*60);

        $sql =  'SELECT a.id, IF(a.parent_id = 0, a.title, CONCAT(\' --- \', a.title)) AS title, a.parent_id, a.task_types_id ' .
                'FROM ' . PREFIX . '_task_statuses AS a ' .
                'JOIN ' . PREFIX . '_task_types AS b ON a.task_types_id = b.id ' .
                'ORDER BY b.title, num_l';
        $task_statuses = $db->getAll($sql, 60*60);

        
        $sql =  'SELECT id, title ' .
                'FROM ' . PREFIX . '_financial_institutions  ' .
                'ORDER BY title';
        $financial_institutions = $db->getAll($sql, 60 * 60);
        
        include 'Tasks/' . $template;
    }

    function exportInWindow($data) {

        $this->checkPermissions('export', $data);

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        $this->show($data, 'show', 'excel.php', false);
        exit;
    }

    function view($data, $action = 'view', $actionType = 'view'){
        global $db, $Log, $Authorization;

        if(is_array($data['id'])) $data['id'] = $data['id'][0];

        switch ($this->getProductTypesId($data['id'])) {
            case PRODUCT_TYPES_KASKO:
                $fields[] = 'kasko_items.brands_id';
                $fields[] = 'CONCAT(kasko_items.brand, \'/\', kasko_items.model) as item';
                $fields[] = 'kasko_items.sign';
                $fields[] = 'IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company) as insurer_name';
                $fields[] = 'policies_kasko.insurer_phone as insurer_phone';
                $fields[] = 'policies.clients_id';
                $fields[] = 'accidents.damage as damage';

                $joins[] = 'LEFT JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id';
                $joins[] = 'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id';
                $joins[] = 'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id';
                break;
            case PRODUCT_TYPES_GO:
                $fields[] = 'CONCAT(accidents_go.owner_brand, \'/\', accidents_go.owner_model) as item';
                $fields[] = 'accidents_go.owner_sign as sign';
                $fields[] = 'accidents_go.victim_damage_note as damage';
                $fields[] = 'IF(policies_go.person_types_id = 1, CONCAT_WS(\' \', policies_go.insurer_lastname, policies_go.insurer_firstname, policies_go.insurer_patronymicname), policies_go.insurer_lastname) as insurer_name';
                $fields[] = 'policies_go.insurer_phone as insurer_phone';
                $fields[] = 'policies.clients_id';

                $joins[] = 'JOIN ' . PREFIX . '_policies_go as policies_go ON tasks.policies_id = policies_go.policies_id';
                $joins[] = 'JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id';

                $conditions[] = 'accidents_go.owner_types_id = 2';
                break;
        }

        $conditions[] = 'tasks.id = ' . intval($data['id']);

        $sql = 'SELECT tasks.id, tasks.date as tasks_date, tasks.task_types_id, tasks.task_statuses_id, tasks.task_statuses_call_id, tasks.sto_call, tasks.top, ' .
                       'acts.repair_classifications_id, repair_classifications.term, car_services.ukravto as ukravto, ' .
                       'calendar.id as calendar_id, calendar.recipient_types_id, calendar.amount as payment_amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date_format, calendar.payment_recipient, ' .
                       'acts.id as acts_id, acts.number as acts_number, accidents.id as accidents_id, accidents.number as accidents_number, policies.id as policies_id, policies.number as policies_number, ' .
                       'tasks.answer, tasks.question, tasks.comment, policies.product_types_id, ' .
                       'CONCAT(accidents.applicant_lastname, \' \', accidents.applicant_firstname, \' \', accidents.applicant_patronymicname) as applicant, accidents.applicant_phones, accidents.description' .
                       ((sizeof($fields) != 0) ? ', ' .implode(',', $fields) . ' ' : ' ') .
               'FROM ' . PREFIX . '_tasks as tasks ' .
               'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON tasks.top = calendar.tasks_id ' .
               'LEFT JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
               'LEFT JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
               'LEFT JOIN ' . PREFIX . '_policies as policies ON policies.id = tasks.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_accounts as accounts ON accounts.id = tasks.performers_id ' .
               'LEFT JOIN ' . PREFIX . '_repair_classifications as repair_classifications ON acts.repair_classifications_id = repair_classifications.id ' .
               'LEFT JOIN ' . PREFIX . '_car_services as car_services ON car_services.id = calendar.recipients_id AND calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE . ' ' .
               ((sizeof($joins) != 0) ? implode(' ', $joins) : '') .
               ((sizeof($conditions) != 0) ? (' WHERE ' . implode(' AND ', $conditions)) . ' ' : '') .
               'GROUP BY tasks.id';
        $data = $db->getRow($sql);

        $data['task_answer'] = unserialize($data['answer']);
        $data['task_question'] = unserialize($data['question']);

        $this->getQuestionFields($data);

        $master_name = $db->getOne('SELECT CONCAT(lastname, \' \', firstname) FROM ' . PREFIX . '_accounts WHERE id = ' . intval($data['task_answer']['accounts_id']));

        $this->showForm($data, $action, $actionType);
    }

    function setTables($action=null) {

        $this->tables = array();

        if (is_array($this->formDescription['fields'])) {
            foreach($this->formDescription['fields'] as $field) {
                switch ($action) {
                    case 'show':
                        if ($field['table'] && $field['type'] != fldMultipleSelect && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }

                        if ($field['display'][ $action ] && $field['sourceTable'] && !in_array(PREFIX . '_' . $field['sourceTable'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['sourceTable'];
                        }
                        break;
                    case 'view':
                        if ($field['table'] && $field['type'] != fldMultipleSelect && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }
                        if ($field['display'][ $action ] && $field['sourceTable'] && !in_array(PREFIX . '_' . $field['sourceTable'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['sourceTable'];
                        }
                        break;
                    case 'insert':
                        if ($field['display']['insert'] && $field['table'] && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }
                        break;
                    case 'update':
                        if ($field['display']['update'] && $field['table'] && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }
                        break;
                    case 'delete':
                        if ($field['table'] && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }
                        break;
                    default:
                        if ($field['table'] && $field['type'] != fldMultipleSelect && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }
                }
            }
        }
    }

    function update($data, $redirect = true){
        global $db, $Log, $Authorization;

        parent::update(&$data, false, false, true);

        if (!$Log->isPresent()) {
            $data['id'] = $data['update_id'] = parent::update($data, false);

            if ($data['update_id'] && in_array($data['task_types_id'], array(TASK_TYPES_ACCIDENT_PAYMENT_NOTIFICATION, TASK_TYPES_ACCIDENT_REPAIR))) {

                //добавляем комментарий в мониторинг
                $sql = 'INSERT INTO ' . PREFIX . '_accident_comments SET ' .
                       'accidents_id = ' . intval($data['accidents_id']) . ', ' .
                       'authors_id = ' . intval($Authorization->data['id']) . ', ' .
                       'authors_title = ' . $db->quote($Authorization->data['lastname'] . ' ' . $Authorization->data['firstname']) . ', ' .
                       'text = ' . $db->quote('<b>' . $this->task_types_title[$data['task_types_id']] . '/' . $this->task_statuses_call_title[$data['task_statuses_call_id']] . '.</b> ' . (($data['comment']) ? '<i>' . 'Коментарій: ' . '</i>' . $data['comment'] : '')) . ', ' .
                       'monitoring_managers_yes = 0, ' .
                       'created = ' . $db->quote(date('Y-m-d H:i:s'));
                $db->query($sql);

                if(checkdate($data['date_month'], $data['date_day'], $data['date_year'])){
                    if($data['task_types_id'] == TASK_TYPES_ACCIDENT_PAYMENT_NOTIFICATION && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES && $data['recipient_types_id'] == RECIPIENT_TYPES_CAR_SERVICE){
                        $data['task_types_id'] = TASK_TYPES_REPAIR;
                    } elseif($data['task_types_id'] == TASK_TYPES_ACCIDENT_PAYMENT_NOTIFICATION && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES){
                        $data['task_types_id'] = TASK_TYPES_ACCIDENT_PAYMENT_NOTIFICATION;
                    } elseif($data['task_types_id'] == TASK_TYPES_ACCIDENT_REPAIR && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES && $data['no_end_repair_reason'] > 0){
                        $data['task_types_id'] = null;
                    } elseif($data['generate_repair']){
                        $data['task_types_id'] = TASK_TYPES_ACCIDENT_REPAIR;
                    }

                    $this->generateTask($data['task_types_id'], $data['calendar_id'], date('Y-m-d', strtotime($data['date'])), $data['update_id']);
                }
            }

            if ($redirect) {
                $Log->add('confirm', '<b>Задачу</b> було успішно змінено', null);
                if (intval($data['is_accidents'])) {
                    header('Location: /?do=Accidents|view&id='.intval($data['is_accidents']).'&product_types_id='.$data['product_types_id']);
                } else {
                    header('Location: /?do=Tasks|show&' . http_build_query($data['hiddens']));
                }
                exit;
            } else{
                return $data['id'];
            }
        } else {
            $this->showForm($data, 'update', 'update');
        }
    }

    function setConstants(&$data){
        global $db, $Authorization;

        if (!intval($data['task_statuses_id'])) {
            $data['task_statuses_id'] = TASK_STATUSES_CLOSED;
        }

        $data['performers_id'] = $Authorization->data['id'];
        
        if ($data['task_types_id'] == TASK_TYPES_COMPENSATION_MESSAGE && $data['ukravto'] == 1 && $data['brands_id'] != 13 && !intval($data['count_tasks_repair']) && $data['product_types_id'] == PRODUCT_TYPES_KASKO) {
            $sql = 'SELECT answer ' .
                   'FROM ' . PREFIX . '_accident_messages ' .
                   'WHERE accidents_id = ' . intval($data['accidents_id']) . ' AND message_types_id = ' . ACCIDENT_MESSAGE_TYPES_CALCULATION . ' AND statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_ANSWER . ' ' .
                   'ORDER BY decision DESC LIMIT 1';
            $answer = unserialize($db->getOne($sql));
            
            $sql = 'SELECT MAX(payment_date) ' .
                   'FROM ' . PREFIX . '_accident_payments_calendar ' .
                   'WHERE acts_id = ' . intval($data['acts_id']);
            $payment_date = $db->getOne($sql);
            
            $data['date'] = BankDay::getEndDate((intval($answer['repair_parts_delivery_days']) ? $payment_date : date('Y-m-d')), (intval($answer['repair_parts_delivery_days']) ? $answer['repair_parts_delivery_days'] : 3), 'd.m.Y');//date('d.m.Y', strtotime($payment_date . '+' . $answer['repair_parts_delivery_days'] . ' days'));
            $data['date_day'] = date('d', strtotime($data['date']));
            $data['date_month'] = date('m', strtotime($data['date']));
            $data['date_year'] = date('Y', strtotime($data['date']));
        }

        if(($data['task_types_id'] == TASK_TYPES_REPAIR || ($data['task_types_id'] == TASK_TYPES_COMPENSATION_MESSAGE && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES)) && empty($data['no_repair'])){
            $question = array();
            $question['date_begin_repair'] = $data['date_begin_repair'];
            $question['no_begin_repair_reason'] = $data['no_begin_repair_reason'];
            $question['date_end_repair'] = $data['date_end_repair'];
            $question['no_end_repair_reason'] = $data['no_end_repair_reason'];
            $data['question'] = serialize($question);
        }elseif(($data['task_types_id'] == TASK_TYPES_REPAIR || ($data['task_types_id'] == TASK_TYPES_COMPENSATION_MESSAGE && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES)) && !empty($data['no_repair'])){
            $question = array();
            $question['no_repair'] = $data['no_repair'];
            $question['no_repair_reason'] = $data['no_repair_reason'];
            $data['question'] = serialize($question);
        }elseif($data['task_types_id'] == TASK_TYPES_COMPENSATION_MESSAGE && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_NO){
            $question = array();
            $question['generate_repair'] = $data['generate_repair'];
            $data['question'] = serialize($question);
        }

        if ($data['task_types_id'] == TASK_TYPES_APPLICATION_ACCIDENTS) {
            switch($data['task_statuses_id']) {
                case 54:
                case 56:
                    $data['task_statuses_call_id'] = 2;
                    break;
                default:
                    $data['task_statuses_call_id'] = 1;
                    break;
            }
            
            $question = array();
            $question['app'] = $data['app'];
            $question['sto'] = $data['sto'];
            $question['app_date'] = $data['app_date'];
            $data['question'] = serialize($question);
        }
        
        if ($data['task_types_id'] == TASK_TYPES_AXAPTA) {
            switch($data['task_statuses_id']) {
                case 60:
                case 62:
                    $data['task_statuses_call_id'] = 2;
                    break;
                default:
                    $data['task_statuses_call_id'] = 1;
                    break;
            }
        }
    }

    function getApplicantInfo($data){
        global $db;

        $fields = array();
        $joins = array();
        $conditions = array();

        $conditions[] = 'tasks.id = ' . intval($data['id']);

        if(in_array($this->getTaskTypesId($data['id']), array(TASK_TYPES_REPAIR, TASK_TYPES_COMPENSATION_MESSAGE))){
            if($this->getProductTypesId($data['id']) == PRODUCT_TYPES_KASKO){
                $fields[] = 'CONCAT(kasko_items.brand, \'/\', kasko_items.model) as item';
                $fields[] = 'kasko_items.sign';
                $fields[] = 'accidents.damage as damage';
                $fields[] = 'IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company) as insurer_name';
                $fields[] = 'policies_kasko.insurer_phone as insurer_phone';
                $joins[] = 'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id';
                $joins[] = 'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id';
                $joins[] = 'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id';
            } elseif($this->getProductTypesId($data['id']) == PRODUCT_TYPES_GO) {
                $fields[] = 'CONCAT(accidents_go.owner_brand, \'/\', accidents_go.owner_model) as item';
                $fields[] = 'accidents_go.owner_sign as sign';
                $fields[] = 'accidents.victim_damage_note as damage';
                //$joins[] = 'JOIN ' . PREFIX . '_policies_go as policies_go ON accidents.policies_id = policies_go.policies_id';
                $joins[] = 'JOIN ' . PREFIX . '_accidents_go as accidents_go ON accidents.id = accidents_go.accidents_id';
                $conditions[] = 'accidents_go.owner_types_id = 2';
            }
        }

        $sql = 'SELECT acts.repair_classifications_id, repair_classifications.term, ' .
                       'calendar.id as calendar_id, calendar.amount as payment_amount, date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date_format, calendar.payment_recipient, ' .
                       'CONCAT(accidents.applicant_lastname, \' \', accidents.applicant_firstname, \' \', accidents.applicant_patronymicname) as applicant, accidents.applicant_phones, accidents.description, ' .
                       'policies.insurer, policies_kasko.insurer_phone' .
                       ((sizeof($fields) != 0) ? ', ' .implode(',', $fields) . ' ' : ' ') .
               'FROM ' . PREFIX . '_tasks as tasks ' .
               'JOIN ' . PREFIX . '_tasks as tasks2 ON tasks.top = tasks2.top ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON tasks2.id = calendar.tasks_id ' .
               'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
               'JOIN ' . PREFIX . '_accidents as accidents ON acts.accidents_id = accidents.id ' .
               'JOIN ' . PREFIX . '_policies as policies ON policies.id = accidents.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_repair_classifications as repair_classifications ON acts.repair_classifications_id = repair_classifications.id ' .
               ((sizeof($joins) != 0) ? implode(' ', $joins) : '') .
               ((sizeof($conditions) != 0) ? (' WHERE ' . implode(' AND ', $conditions)) . ' ' : '') .
               'GROUP BY tasks.id';
        return $db->getRow($sql);
    }

    function showForm($data, $action, $actionType=null){
        global $db, $Authorization;

//        $data = array_merge($data, $this->getApplicantInfo($data));

        switch ($data['task_types_id']){
            case TASK_TYPES_REPAIR:
            case TASK_TYPES_COMPENSATION_MESSAGE:
                $template = 'compensation_message.php';
                break;
            case TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT:
            case TASK_TYPES_POLICIES_PROLONGATION:
            case TASK_TYPES_POLICIES_RENEW_AMOUNT:          
                $template = 'sale_tasks.php';
                break;
            case TASK_TYPES_APPLICATION_ACCIDENTS:
                $template = 'application_accidents.php';
                break;
            case TASK_TYPES_AXAPTA:
                $template = 'axapta_task.php';
                break;
        }

        return parent::showForm($data, $action, $actionType, $template);
    }

    function checkFields($data, $action) {
        global $Log;

        parent::checkFields($data, $action);

        if($data['task_statuses_call_id'] < 1){
            $Log->add('error', 'Поле <b>Результат дзвінка</b> обов\'язкове для вибору');
        }

        if(($data['task_types_id'] == TASK_TYPES_REPAIR || ($data['task_types_id'] == TASK_TYPES_COMPENSATION_MESSAGE && $data['recipient_types_id'] == RECIPIENT_TYPES_CAR_SERVICE && $data['ukravto'] == 1)) && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES && !($data['no_begin_repair_reason'] < 1)^!(strlen($data['date_begin_repair']) <= 1)){
            $Log->add('error', 'Поля <b>Дату заїзду</b> та <b>Причина (заїзду)</b> заповнюються одночасно');
        }

        if(($data['task_types_id'] == TASK_TYPES_REPAIR || ($data['task_types_id'] == TASK_TYPES_COMPENSATION_MESSAGE && $data['recipient_types_id'] == RECIPIENT_TYPES_CAR_SERVICE && $data['ukravto'] == 1)) && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES && $data['no_begin_repair_reason'] >= 1 && strlen($data['date_begin_repair']) > 1 && !($data['no_end_repair_reason'] < 1)^!(strlen($data['date_end_repair']) <= 1)){
            $Log->add('error', 'Поля <b>Дату виїзду</b> та <b>Причина (виїзду)</b> заповнюються одночасно');
        }

        if(($data['task_types_id'] == TASK_TYPES_REPAIR || ($data['task_types_id'] == TASK_TYPES_COMPENSATION_MESSAGE && $data['recipient_types_id'] == RECIPIENT_TYPES_CAR_SERVICE && $data['ukravto'] == 1)) && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES && $data['no_end_repair_reason'] >= 1 && strlen($data['date_end_repair']) > 1 && strlen($data['date_begin_repair']) <= 1){
            $Log->add('error', 'Поле <b>Дату заїзду</b> обов\'язкове для заповнення');
        }

        if(($data['task_types_id'] == TASK_TYPES_REPAIR || ($data['task_types_id'] == TASK_TYPES_COMPENSATION_MESSAGE && $data['recipient_types_id'] == RECIPIENT_TYPES_CAR_SERVICE && $data['ukravto'] == 1)) && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES && strlen($data['date']) <= 1 && strlen($data['date_end_repair']) <= 1 && empty($data['no_repair'])){
            //$Log->add('error', 'Потрібно ввести або <b>Дату закінчення ремонту</b>, або <b>Дату виконання наступної задачі</b>');
        }

        if(checkdate($data['date_month'], $data['date_day'], $data['date_year']) && (mktime(0, 0, 0, $data['date_month'], $data['date_day'], $data['date_year']) <= mktime(0, 0, 0, date('m'), date('d'), date('Y')))){
            $Log->add('error', '<b>Дата виконання наступної задачі</b> повинна бути більшою за сьогоднішню');
        }

        if(($data['task_types_id'] == TASK_TYPES_REPAIR || ($data['task_types_id'] == TASK_TYPES_COMPENSATION_MESSAGE && $data['recipient_types_id'] == RECIPIENT_TYPES_CAR_SERVICE && $data['ukravto'] == 1)) && $data['task_statuses_call_id'] == TASK_STATUSES_CALL_YES && !empty($data['no_repair']) && $data['no_repair_reason'] < 1){
            $Log->add('error', 'Поля <b>ТЗ не поставлений в ремонт</b> та <b>Причина</b> заповнюються одночасно');
        }
    }

    function mastersAnswer($data){
        global $db, $Log;

        $answer = array();
        $answer['accounts_id'] = intval($data['accounts_id']);
        $answer['date'] = date('d.m.Y');
        $answer['text_answer'] = $data['text_answer'];
        $data['answer'] = serialize($answer);
        $this->permissions['update'] = true;

        $data['master_answer'] = 1;

        $data['update_id'] = parent::update($data, false);
        $data['master_answer'] = 0;
        if($data['update_id']){
            $Log->add('confirm', '<b>Відповідь</b> успішно додано', null);
            header('Location: /?do=Tasks|show');
            exit;
        }
    }

    function delete($data){
        global $db;

        $db->query('DELETE FROM ' . PREFIX . '_tasks WHERE id IN (' . implode(',',$data['id']) . ')');

        $db->query('UPDATE ' . PREFIX . '_accident_payments_calendar SET tasks_id = NULL WHERE tasks_id IN (' . implode(',',$data['id']) . ')');

        header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show');
        exit;
    }

    function reportInWindow($data){
        if ($data['type'] == 1) $this->reportNew($data, true);
        else $this->report($data, true);
    }
    
    function reportNew($data, $excel=false){
        global $db;
        
        $conditions = array();
        
        $conditions[] = 'tasks.task_types_id = ' . TASK_TYPES_REPAIR;
        $conditions[] = 'tasks.task_statuses_id IN (2, 5)';
        $conditions[] = 'policies_kasko.insurer_person_types_id = 1';
        $conditions[] = 'calendar.payment_types_id = ' . PAYMENT_TYPES_COMPENSATION;
        $conditions[] = 'calendar.recipient_types_id = ' . RECIPIENT_TYPES_CAR_SERVICE;
        $conditions[] = 'car_services_payment.ukravto = 1';
        
        if ($data['fromDateTask']) {
            $fromDateTask = substr($data['fromDateTask'], 6, 4) . '-' . substr($data['fromDateTask'], 3, 2) . '-' . substr($data['fromDateTask'], 0, 2);
            $conditions[] = 'tasks.date > ' . $db->quote($fromDateTask);
        }
        
        if ($data['toDateTask']) {
            $toDateTask = substr($data['toDateTask'], 6, 4) . '-' . substr($data['toDateTask'], 3, 2) . '-' . substr($data['toDateTask'], 0, 2);
            $conditions[] = 'tasks.date < ' . $db->quote($toDateTask);
        }
        
        if ($data['fromDatePayment']) {
            $fromDatePayment = substr($data['fromDatePayment'], 6, 4) . '-' . substr($data['fromDatePayment'], 3, 2) . '-' . substr($data['fromDatePayment'], 0, 2);
            $conditions[] = 'calendar.payment_date > ' . $db->quote($fromDatePayment);
        }
        
        if ($data['toDatePayment']) {
            $toDatePayment = substr($data['toDatePayment'], 6, 4) . '-' . substr($data['toDatePayment'], 3, 2) . '-' . substr($data['toDatePayment'], 0, 2);
            $conditions[] = 'calendar.payment_date < ' . $db->quote($toDatePayment);
        }
        
        switch ($data['type_region']) {
            case '1':
                $conditions[] = 'car_services_payment.regions_id IN (10, 26)';
                break;
            case '2':
                $conditions[] = 'car_services_payment.regions_id NOT IN (10, 26)';
                break;
        }
        
        if (intval($data['repair_classifications_id'])) {
            $conditions[] = 'accidents_acts.repair_classifications_id = ' . intval($data['repair_classifications_id']);
        }
        
        if (intval($data['task_statuses_call_id'])) {
            $conditions[] = 'tasks.task_statuses_call_id = ' . intval($data['task_statuses_call_id']);
        }
        
        if (intval($data['car_services_accidents_id'])) {
            $conditions[] = 'accidents.car_services_id = ' . intval($data['car_services_accidents_id']);
        }
        
        if (intval($data['car_services_payment_id'])) {
            $conditions[] = 'calendar.recipients_id = ' . intval($data['car_services_payment_id']);
        }

        $sql = 'SELECT accidents.id as accidents_id, accidents.number as accidents_number, car_services_accidents.title as car_services_accidents_title, date_format(accidents.datetime, \'%d.%m.%Y\') as accidents_datetime, ' .
                    'date_format(accidents.date, \'%d.%m.%Y\') as accidents_date, ' .
                    
                    'policies.number as policies_number, ' .
                    
                    'CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname) as insurer, ' .
                    
                    'CONCAT_WS(\'/\', kasko_items.brand, kasko_items.model) as item, IF(LENGTH(kasko_items.sign) > 0, kasko_items.sign, kasko_items.shassi) as sign_or_shassi, ' .
                    
                    'date_format(calendar.payment_date, \'%d.%m.%Y\') as payment_date, calendar.amount as calendar_amount, calendar.recipient as calendar_recipient, IF(car_services_payment.regions_id IN (10, 26), \'Київ 1\', \'Регіони\') as region, ' .
                    
                    'payments.number_payment_order as number_payment_order, ' .
                    
                    'accidents_acts.repair_classifications_id, repair_classifications.term as repair_classifications_term, ' .
                    
                    'date_format(tasks.date, \'%d.%m.%Y\') as tasks_date, ' .
                    'CASE tasks.task_statuses_call_id WHEN 1 THEN \'Недозвон\' WHEN 2 THEN \'Дозвон\' ELSE \'Невідомо\' END as task_statuses_call_title, ' .
                    'IF (tasks.sto_call = 1, \'так\', \'ні\') as sto_call, tasks.comment, tasks.question ' .
                    
               'FROM ' . PREFIX . '_accidents as accidents ' .
               'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
               'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
               'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
               'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id ' .
               'JOIN ' . PREFIX . '_accidents_acts as accidents_acts ON accidents.id = accidents_acts.accidents_id ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON accidents_acts.id = calendar.acts_id ' .
               'JOIN ' . PREFIX . '_accident_payments as payments ON calendar.id = payments.payments_calendar_id ' .
               'JOIN ' . PREFIX . '_tasks as tasks ON calendar.tasks_id = tasks.top ' .
               'JOIN ' . PREFIX . '_car_services as car_services_accidents ON accidents.car_services_id = car_services_accidents.id ' .
               'JOIN ' . PREFIX . '_car_services as car_services_payment ON calendar.recipients_id = car_services_payment.id ' .
               'JOIN ' . PREFIX . '_repair_classifications as repair_classifications ON accidents_acts.repair_classifications_id = repair_classifications.id ' .
               
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
               
               'ORDER BY accidents.id';
        $values = $db->getAll($sql);
    
        $task_fields = array(
            'tasks_date',
            'task_statuses_call_title',
            'sto_call',
            'comment',
            'question'
        );
        
        $list = array();
        $accident = array();
        $tasks = array();
        $previous_accidents_id = 0;
        foreach ($values as $row) {
            if ($row['accidents_id'] != $previous_accidents_id) {
                if ($previous_accidents_id != 0) {
                    $accident['tasks'] = $tasks;
                    $list[] = $accident;
                    $accident = array();
                    $tasks = array();
                }
                foreach ($row as $field => $value) {
                    if (!in_array($field, $task_fields)) {
                        if ($value == '') $value = '&nbsp;';
                        $accident[$field] = $value;
                    }
                }               
            }
            
            $task = array();
            foreach ($row as $field => $value) {
                if (in_array($field, $task_fields)) {
                    if ($field == 'question') {
                        $question = unserialize($value);
                        
                        if (isset($question['date_begin_repair']) && strlen($question['date_begin_repair']) > 0) $task['date_begin_repair'] = date('d.m.Y', strtotime($question['date_begin_repair']));
                        else $task['date_begin_repair'] = '&nbsp;';
                        
                        if (isset($question['no_begin_repair_reason']) && intval($question['no_begin_repair_reason'])) $task['no_begin_repair_reason'] = $this->no_begin_repair_reason[ $question['no_begin_repair_reason'] ];
                        else $task['no_begin_repair_reason'] = '&nbsp;';
                        
                        if (isset($question['no_repair'])) $task['no_repair_reason'] = $this->no_begin_repair_reason[ $question['no_repair_reason'] ];
                        else $task['no_repair_reason'] = '&nbsp;';
                        
                        $begin = strtotime($question['date_begin_repair']);
                        $end = strtotime($question['date_end_repair']);
                        $now = time();
                        $calculate = strtotime($question['date_begin_repair'] . ' +' . $accident['repair_classifications_term'] . 'days');
                        
                        if (intval($begin) && intval($end)) {
                            if ($begin <= $now && $now < $end && $now > $calculate) $task['repair_state'] = 'Автомобіль в ремонті більше ' . $accident['repair_classifications_term'] . ' днів';
                            elseif ($begin <= $now && $now < $end && $now <= $calculate) $task['repair_state'] = 'Автомобіль в ремонті з дотриманням план-класу';
                            elseif ($now >= $end && $end > $calculate) $task['repair_state'] = 'Відремонтовано з порушенням план-класу. Більше ' . $accident['repair_classifications_term'] . ' днів';
                            elseif ($now >= $end && $end <= $calculate) $task['repair_state'] = 'Відремонтовано з дотриманням план-класу.';
                            else $task['repair_state'] = 'else 1';
                        } elseif (intval($begin)) {
                            if ($begin < $calculate && $calculate < $now) $task['repair_state'] = 'Автомобіль в ремонті з порушенням план-класу. Більше ' . $accident['repair_classifications_term'] . ' днів';
                            elseif ($begin <= $now && $now <= $calculate) $task['repair_state'] = 'Автомобіль в ремонті з дотриманням план-класу';
                            else $task['repair_state'] = 'else 2';
                        } else {
                            $task['repair_state'] = '&nbsp;';
                        }
                        
                    } else {
                        if ($value == '') $value = '&nbsp;';
                        $task[$field] = $value;
                    }
                }
            }
            $tasks[] = $task;
            
            $previous_accidents_id = $row['accidents_id'];
        }
        
        $accident['tasks'] = $tasks;
        $list[] = $accident;
        
        header('Content-Disposition: attachment; filename="report.xls"');
        header('Content-Type: ' . Form::getContentType('report.xls'));
        include 'Tasks/reportNewExcel.php';
    }

    function report($data, $excel=false){
        global $db, $Log;

        if(!checkdate(substr($data['from'], 3, 2), substr($data['from'], 0, 2), substr($data['from'], 6, 4)) ||
           !checkdate(substr($data['to'], 3, 2), substr($data['to'], 0, 2), substr($data['to'], 6, 4))) {
            if ($data['report'] == 1) {
                $Log->add('error', 'Введіть дати <b>з</b> та <b>по</b>.');
                $excel = false;
            }
            //exit;
        } else {
            $from = substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2);
            $to = substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2);
        }

        $list = array();

        switch(intval($data['report_type'])){
            case 1:
                $list['week'] = $this->getReportByFirstAnyTaskWeek($from, $to);
                $list['month'] = $this->getReportByFirstAnyTaskMonth(substr($data['to'], 3, 2), substr($data['to'], 6, 4));
                $list['year'] = $this->getReportByFirstAnyTaskYear(substr($data['to'], 6, 4));
                break;
            case 2:
                $list['week'] = $this->getReportByPlannedEndRepair($from, $to);
                $list['month'] = $this->getReportByPlannedEndRepair(date('Y-m-d', mktime(0, 0, 0, intval(substr($data['to'], 3, 2)), 1, intval(substr($data['to'], 6, 4)))), date('Y-m-d', mktime(0, 0, 0, intval(substr($data['to'], 3, 2)) + 1, 0, intval(substr($data['to'], 6, 4)))));
                $list['year'] = $this->getReportByPlannedEndRepair(date('Y-m-d', mktime(0, 0, 0, 1, 1, intval(substr($data['to'], 6, 4)))), date('Y-m-d', mktime(0, 0, 0, 12, 31, intval(substr($data['to'], 6, 4)))));
                break;
            case 3:
                break;
        }

        if ($excel) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));
            include 'Tasks/reportExcel.php';
            exit;
        } elseif($Log->isPresent()) {
            header('Location: index.php?do=Tasks|report&report_type=' . intval($data['report_type']) . '&from=' . $data['from'] . '&to=' . $data['to']);
        } else {
            include 'Tasks/report.php';
            exit;
        }
    }

    function calcValuesForReport($rows){
        $list = array();

        $count_no_begin_repair_reason = array();
        $count_no_begin_repair_reason[0] = 0;
        $count_no_begin_repair_reason[1] = 0;
        $count_no_begin_repair_reason[2] = 0;
        $count_no_begin_repair_reason[3] = 0;
        $count_no_begin_repair_reason[4] = 0;
        $count_no_begin_repair_reason[5] = 0;
        $count_no_begin_repair_reason[6] = 0;
        $count_no_begin_repair_reason['total'] = 0;

        $count_end_repair = array();
        $count_end_repair['positive'] = 0;
        $count_end_repair['negative'] = 0;
        $count_end_repair['total'] = 0;

        $count_repair = array();
        $count_repair['positive'] = 0;
        $count_repair['negative'] = 0;
        $count_repair['total'] = 0;

        $no_call_count = 0;

        $total_count = 0;

        foreach($rows as $row){
            $total_count++;

            $row['question_array']['days_done'] = ceil((strtotime($row['question_array']['date_end_repair']) - strtotime($row['question_array']['date_begin_repair'])) / 86400);
            $row['question_array']['days_continue'] = ceil((strtotime(date('Y-m-d')) - strtotime($row['question_array']['date_begin_repair'])) / 86400);

                if($row['question_array']['days_done'] > 0) {
                    if($row['question_array']['days_done'] <= $row['term']){
                        $count_end_repair['positive']++;
                    }else{
                        $count_end_repair['negative']++;
                    }
                    $count_end_repair['total']++;
                }elseif($row['question_array']['days_continue'] >= 0){
                    if($row['question_array']['days_continue'] <= $row['term']){
                        $count_repair['positive']++;
                    }else{
                        $count_repair['negative']++;
                    }
                    $count_repair['total']++;
                }else{
                    $count_no_begin_repair_reason[intval($row['question_array']['no_begin_repair_reason'])]++;
                }
        }

        $list['begin'] = $count_no_begin_repair_reason;
        $list['repair'] = $count_repair;
        $list['end'] = $count_end_repair;
        $list['no_call_count'] = $no_call_count;
        $list['total'] = $total_count;

        return $list;
    }

    function getReportByFirstAnyTaskWeek($from, $to){
        global $db;

        $conditions = array();

        $conditions[] = 'tasks.date BETWEEN ' . $db->quote($from) . ' AND ' . $db->quote($to);
        $conditions[] = 'LENGTH(tasks2.question) <> 0';

        $sql = 'SELECT tasks.* , repair_classifications.term ' .
               'FROM ' . PREFIX . '_tasks as tasks ' .
               'JOIN ' . PREFIX . '_tasks as tasks2 ON tasks.top = tasks2.top ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON tasks2.top = calendar.tasks_id ' .
               'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
               'JOIN ' . PREFIX . '_repair_classifications as repair_classifications ON acts.repair_classifications_id = repair_classifications.id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
               'GROUP BY tasks2.id ' .
               'HAVING MIN(tasks2.id) = tasks.id';
        $res = $db->getAll($sql);

        $rows = array();

        foreach($res as $row){
            $row['question_array'] = unserialize($row['question']);
            $rows[] = $row;
        }

        return $this->calcValuesForReport($rows);
    }

    function getReportByFirstAnyTaskMonth($month, $year){
        global $db;

        $conditions = array();

        $conditions[] = 'date_format(tasks.date, \'%m\') = ' . $db->quote($month);
        $conditions[] = 'date_format(tasks.date, \'%Y\') = ' . $db->quote($year);
        $conditions[] = 'LENGTH(tasks2.question) <> 0';

        $sql = 'SELECT tasks.* , repair_classifications.term ' .
               'FROM ' . PREFIX . '_tasks as tasks ' .
               'JOIN ' . PREFIX . '_tasks as tasks2 ON tasks.top = tasks2.top ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON tasks2.top = calendar.tasks_id ' .
               'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
               'JOIN ' . PREFIX . '_repair_classifications as repair_classifications ON acts.repair_classifications_id = repair_classifications.id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
               'GROUP BY tasks2.id ' .
               'HAVING MIN(tasks2.id) = tasks.id';
        $res = $db->getAll($sql);

        $rows = array();

        foreach($res as $row){
            $row['question_array'] = unserialize($row['question']);
            $rows[] = $row;
        }

        return $this->calcValuesForReport($rows);
    }

    function getReportByFirstAnyTaskYear($year){
        global $db;

        $conditions = array();

        $conditions[] = 'date_format(tasks.date, \'%Y\') = ' . $db->quote($year);
        $conditions[] = 'LENGTH(tasks2.question) <> 0';


        $sql = 'SELECT tasks.* , repair_classifications.term ' .
               'FROM ' . PREFIX . '_tasks as tasks ' .
               'JOIN ' . PREFIX . '_tasks as tasks2 ON tasks.top = tasks2.top ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON tasks2.top = calendar.tasks_id ' .
               'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
               'JOIN ' . PREFIX . '_repair_classifications as repair_classifications ON acts.repair_classifications_id = repair_classifications.id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
               'GROUP BY tasks2.id ' .
               'HAVING MIN(tasks2.id) = tasks.id';
        $res = $db->getAll($sql);

        $rows = array();

        foreach($res as $row){
            $row['question_array'] = unserialize($row['question']);
            $rows[] = $row;
        }

        return $this->calcValuesForReport($rows);
    }

    function getReportByPlannedEndRepair($from, $to){
        global $db;

        $conditions[] = 'tasks.question IS NOT NULL';

        $sql = 'SELECT tasks.*, repair_classifications.term ' .
               'FROM ' . PREFIX . '_tasks as tasks ' .
               'JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON tasks.top = calendar.tasks_id ' .
               'JOIN ' . PREFIX . '_accidents_acts as acts ON calendar.acts_id = acts.id ' .
               'JOIN ' . PREFIX . '_repair_classifications as repair_classifications ON acts.repair_classifications_id = repair_classifications.id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
               'ORDER BY tasks.id';
        $res = $db->getAll($sql);

        $rows = array();
        $calculate = array();

        $from_time = strtotime($from);
        $to_time = strtotime($to);
        foreach($res as $row){
            $row['question_array'] = unserialize($row['question']);
            if($row['question_array']['date_begin_repair']){
                $time_planned_end_repair = strtotime($row['question_array']['date_begin_repair'] . '+' . $row['term'] . ' days');
                if($time_planned_end_repair >= $from_time && $time_planned_end_repair <= $to_time && !in_array($row['top'], $calculate)){
                    $row['date_planned_end_repair'] = date('d.m.Y', strtotime($row['question_array']['date_begin_repair'] . '+' . $row['term'] . ' days'));
                    $calculate[] = intval($row['top']);
                    $rows[] = array('question_array' => $row['question_array'], 'term' => $row['term']);
                }
            }
        }

        return $this->calcValuesForReport($rows);
    }

    function getCalendarIdByCodEA($codEA, $acts_id=null){
        global $db;

        if($acts_id){
            return $db->getOne('SELECT id FROM ' . PREFIX . '_accident_payments_calendar WHERE acts_id = ' . intval($acts_id) . ' AND number = ' . $db->quote($codEA));
        }else{
            return $db->getOne('SELECT id FROM ' . PREFIX . '_accident_payments_calendar WHERE number = ' . $db->quote($codEA));
        }
    }

    function getPaymentsCalendarNumber($id){
        global $db;

        $sql =  'SELECT number ' .
                'FROM ' . PREFIX . '_accident_payments_calendar ' .
                'WHERE tasks_id = ' . intval($id);
        return $db->getOne($sql);
    }

    function getProductTypesId($id){
        global $db;

        $sql =  'SELECT product_types_id ' .
                'FROM ' . PREFIX . '_tasks ' .
                'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_tasks.policies_id = ' . PREFIX . '_policies.id ' .
                'WHERE ' . PREFIX . '_tasks.id = ' . intval($id);
        return $db->getOne($sql);
    }

    function getTaskTypesId($tasks_id){
        global $db;

        $sql = 'SELECT task_types_id FROM ' . PREFIX . '_tasks WHERE id = ' . intval($tasks_id);
        return $db->getOne($sql);
    }

    //загружаем исполнителей
    function loadPerformersInWindow($data) {
        global $db; 

        $sql =  'SELECT a.id,CONCAT(lastname, \' \', firstname) AS name ' .
                'FROM '.PREFIX.'_accounts AS a ' .
                'JOIN '.PREFIX.'_agents AS b ON a.id = b.accounts_id ' .
                'WHERE a.active = 1 AND b.agencies_id = ' . SELLER_AGENCIES_ID . ' ' .
                'ORDER BY lastname, firstname';
        $list = $db->getAll($sql);

        $result = '<select name="performers_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">';
        foreach($list as $row) {
            $result.='<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
        $result.='</select>';

        echo $result;
        exit;       
    }

    function getOptions($field, $languageCode, &$options, $parent_id='', $path='', $level = 0) {
        global $db;

        if ($field['condition']) {
            $where = ' AND ' . $field['condition'];
        }

        if (!$field['selectId'])
            $field['selectId'] = 'id';

        $sql =  'SELECT ' . $field['selectId'] . ' AS id, ' . $field['selectField'] . $languageCode . ' AS title, parent_id ' .
                'FROM ' . PREFIX . '_' . $field['sourceTable'] . ' ' .
                'WHERE parent_id = ' . intval($parent_id) . $where . ' ' .
                'ORDER BY ' . $field['orderField'];
        $res = $db->query($sql);

        while ($res->fetchInto($row)) {

            $options[ $row['id'] ] = array(
                'title' => $row['title'],
                'parent_id' => $row['parent_id'],
                'obligatory' => $row['obligatory'],
                'child' => false);

            if (intval($row['parent_id'])) {
                $options[ $row['parent_id'] ]['child'] = true;
            }

            $this->getOptions($field, $languageCode, $options, $row['id'], $path . $row['title'] . ' > ', $level + 1);
        }
    }

    function getListValue($field, $data) {
        global $db, $Authorization;

        reset($this->languages);

        $languageCode = ($field['multiLanguages'])
            ? $this->languageCode
            : '';

        $options = (($field['verification']['canBeEmpty']) && $field['type'] == fldSelect) ? array('0' => '...') : array();

        if ($field['name'] == 'task_statuses_id') {
            $field['condition'] = 'task_types_id = ' . intval($data['task_types_id']);
        }

        switch ($field['structure']) {
            case 'tree':
                $this->getOptions($field, $languageCode, $options);
                break;
            default:
                if ($field['condition']) {
                    $where = ' WHERE ' . $field['condition'];
                }

                if (!$field['selectId'])
                    $field['selectId'] = 'id';

                $field['orderField'] = ($field['selectField'] == $field['orderField'])
                    ? $field['orderField'] . $languageCode
                    : $field['orderField'];

                $sql =  'SELECT ' . $field['selectId'] . ' AS id, ' . $field['selectField'] . $languageCode . ' AS title ' .
                    'FROM ' . PREFIX . '_' . $field['sourceTable'] . $where . ' ' .
                    'ORDER BY ' . $field['orderField'];
                $list = $db->getAll($sql, 300);

                if (is_array($list)) {
                    foreach ($list as $row) {
                        $options[ $row['id'] ] = array(
                            'title' => $row['title'],
                            'obligatory' => $row['obligatory']);
                    }
                }
        }
        return $options;
    }

    function buildSelect($field, $value, $languageCode=null, $addition=null, $indexType=null, $data=null, $class=null) {

        $result = '';

        if ($field['name'] == 'task_statuses_id') {

            if (is_array($field['list']) && sizeOf($field['list']) > 0) {
                $id = $field['showId'] ? 'id="' . ereg_replace('\[|\]', '', $field['name'] . $languageCode) . '"' : '';
                $result = (eregi('multiple', $addition))
                    ? '<select '.$id.' name="' . $field['name'] . $languageCode . '[]" ' . $addition . ' ' . $field['javascript'] . ' class="fldSelect ' . $class . '" onfocus="this.className=\'fldSelectOver ' . $class . '\'" onblur="this.className=\'fldSelect ' . $class . '\'">'
                    : '<select '.$id.' name="' . $field['name'] . $languageCode . '" ' . $addition . ' ' . $field['javascript'] . ' class="fldSelect' . $class . '" onfocus="this.className=\'fldSelectOver ' . $class . '\'" onblur="this.className=\'fldSelect ' . $class . '\'">';

                if (current($field['list']) != '...' && !eregi('multiple', $addition)) {
                    $result .= '<option value="">...</option>';
                }

                if (is_array($field['list']) && sizeOf($field['list']) > 0) {

                    $optgroup = false;
                    $parent_id = null;
                    foreach($field['list'] as $id => $row) {

                        if (!$row['child']) {

                            $result .= ((!is_array($value) && $value == $id || (!is_array($value) && intval($value) & intval($id) && eregi('double', $indexType))) || (is_array($value) && in_array($id, $value)))
                                ? '<option value="' . $id . '" selected ' . (($row['obligatory']) ? '' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>'
                                : '<option value="' . $id . '" ' . (($row['obligatory']) ? '' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
                        } else {

                            if ($optgroup && $row['parent_id'] != $parent_id) {
                                $result .= '</optgroup>';
                                $optgroup = false;
                            }

                            $result .= '<optgroup label="' . $row['title'] . '">';

                            $optgroup = true;
                            $parent_id = $row['parent_id'];
                        }
                    }

                    if ($optgroup) {
                        $result .= '</optgroup>';
                    }
                }

                $result .= '</select>';
            } else {
                $result = '<div class="error">' . translate('No items present') . '</div>';
            }

        } else {
            $result = parent::buildSelect($field, $value, $languageCode, $addition, $indexType, $data, $class);
        }

        return $result;
    }

    //смена менеджера / салона
    function loadTransfer($data) {
        $this->updateTransfer($data);
    }

    function updateTransfer($data) {
        global $db, $Log, $Templates;

        if (is_array($data['id'])) {
            $sql =  'SELECT id ' .
                    'FROM ' . PREFIX . '_tasks ' .
                    'WHERE id IN(' . implode(', ', $data['id']) . ')';
            $data['id'] = $db->getCol($sql);

            if ($_POST['do'] == 'Tasks|updateTransfer' && sizeOf($data['id'])) {
                $sql =  'UPDATE ' . PREFIX . '_tasks SET ' .
                        'performers_id = ' . intval($data['performers_id']) . ', '  .
                        'created = NOW() '  .
                        'WHERE id IN(' . implode(', ', $data['id']) . ')';
                $db->query($sql);

                $Log->add('confirm', 'Виконавця було змiнено');

                header('Location: ' . $data['redirect']);
                exit;
            }
        }

        $Log->showSystem();
        include_once $this->object . '/transfer.php';
    }

    function getNextPeriod($policies_id, $calendar_id) {
        global $db;

        $sql =  'SELECT ' . PREFIX . '_policy_payments_calendar.id as policy_payments_calendar_id, date_format(' . PREFIX . '_policy_payments_calendar.date, \'%d-%m-%Y\') AS date, ' . PREFIX . '_policy_payments_calendar.amount AS amount, ' . PREFIX . '_clients.agencies_id, ' .
                PREFIX . '_clients.agents_id, ' . PREFIX . '_clients.important_person, ' . PREFIX . '_policy_payments_calendar.statuses_id, ' . PREFIX . '_policies_kasko.insurer_regions_id ' .
                'FROM ' . PREFIX . '_policy_payments_calendar ' .
                'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_policy_payments_calendar.policies_id = ' . PREFIX . '_policies.id ' .
                'JOIN ' . PREFIX . '_policies_kasko ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policies_kasko.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_clients ON ' . PREFIX . '_policies.clients_id = ' . PREFIX . '_clients.id ' .
                'WHERE ' . PREFIX . '_policy_payments_calendar.policies_id = ' . intval($policies_id) . '  AND ' . PREFIX . '_policy_payments_calendar.id > ' . intval($calendar_id) . ' and second_fifty_fifty=0 ' .
                'ORDER BY ' . PREFIX . '_policy_payments_calendar.id ASC ' .
                'LIMIT 1';
        return $db->getRow($sql);
    }

    function isTaskExists($policies_id, $policy_payments_calendar_id, $task_types_id) {
        global $db;

        $conditions[] = 'policies_id = ' . intval($policies_id);
        $conditions[] = 'task_types_id = ' . intval($task_types_id);
        $conditions[] = 'policy_payments_calendar_id = ' . intval($policy_payments_calendar_id);

        //статусы не завершенных задач
        $conditions[] = 'task_statuses_id IN(39,28,43,44,45,29,37,7,41,42,8,38,13,16,18,19,40,21,20,49,50,51,62,66)';

        $sql =  'SELECT count(*) ' .
                'FROM ' . PREFIX . '_tasks ' .
                'WHERE ' . implode(' AND ', $conditions);
        $count = $db->getOne($sql);

        return ($count > 0) ? true : false;
    }

    //показываем для агентов задачи за 14 дней
    function showNextPayment() {
        global $db;

        $sql = 'UPDATE ' . PREFIX . '_tasks SET created=NOW() WHERE task_types_id='.TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT.' AND created is null AND date <DATE_ADD(NOW(),INTERVAL 14 DAY)';
        $db->query($sql);

        echo 'done';
    }

    function findTopPoliciesId($policies_id,$top) {
        global $db;
        $r = $db->getRow('SELECT * FROM insurance_policies WHERE id='.intval($policies_id));
        
        $top = $r['id'];
        if (!$r) return;
        if ($r['parent_id']>0) {
            $this->findTopPoliciesId($r['parent_id'],&$top);
        }
        
    }
    
    //находим регион где был выпущен самый первый полис
    function getPolicyRegionId($policies_id) {
        global $db;
        $top = 0;
        $this->findTopPoliciesId($policies_id,&$top);
        return $db->getOne('SELECT IF(b1.id>0,b1.regions_id,b.regions_id) as regions_id FROM insurance_policies a JOIN  insurance_agencies b on b.id=a.agencies_id LEFT JOIN insurance_agencies b1 on b.parent_id=b.id WHERE a.id='.intval($top));
    }

    //генерируем задачи на очередные платежи
    function generateNextPayment() {
        global $db;
        //получаем календари
        $periods = Reports::getInsurancePeriods(
            array(
                'calendar' => 1,
                'product_types_id' => 3,
                'types_id' => 0,
                'date_types_id' => 3,
                'from' => date('d.m.Y', mktime(0, 0, 0, date('m')+1, 1, date('Y'))),
                'to' => date('d.m.Y', mktime(0, 0, 0, date('m')+2, 0, date('Y')))
        ));
        foreach ($periods as $i => $period) {

            //проверяем последний ли это платеж
            if ($period['last_years_period'] == 0 && $period['is_agr'] == 0 && $period['second_fifty_fifty'] == 0 && intval($period['skip_prolongation'])!=1) {

                //выбрасываем Крым и Севастополь
                if (in_array($period['top_regions_id'], array(1, 27))) {
                    continue;
                }

                //не формируем задачи для договоров ритейловых для отдельных точек продаж
                if (intval($period['financial_institutions_id']) === 0 && !in_array($period['agencies_id'], array(1, 1469))) {
                    continue;
                }

                //В задачи на пролонгацию не должны попадать договора Тест-Драйв, Перегоны Автопарк
                $sql =  'SELECT a.item, options_test_drive, options_race, insurer_identification_code ' .
                        'FROM ' . PREFIX . '_policies AS a ' .
                        'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                        'WHERE policies_id = ' . intval($period['policies_id']);
                $options = $db->getRow($sql);

                if ($options['item'] == 'Автопарк' || $options['options_test_drive'] > 0 || $options['options_race']) {
                    continue;
                }

                //получаем следующий платеж по календарю платежей
                $next_period = $this->getNextPeriod($period['policies_id'], $period['policy_payments_calendar_id']);

                if (is_null($next_period)) {
                    $next_period = $period;
                    $next_period['date'] = str_replace('.', '-', $period['policies_end_datetime_format']);
                    $next_period['statuses_id'] = 1;
                }

                list($day, $month, $year) = explode('-', $next_period['date']);
                $date = date('Y.m.d', mktime(0, 0, 0, $month, $day, $year));

                if (//проверяем оплату периода
                    $next_period['statuses_id'] < 3 &&
                    //проверяем, чтобы задача не была ранее создана
                    !$this->isTaskExists($period['policies_id'], $next_period['policy_payments_calendar_id'], TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT)) {

                    if (false && in_array($period['clients_agents_id'], array_merge(self::$vip, self::$kiev, self::$region))) {
                        $performers_id = $period['clients_agents_id'];
                    } else if ($period['important_person'] && $period['important_person_groups_id'] == 1) {
                        $performers_id = array_shift(self::$vip);
                    } else if ($period['top_regions_id'] == 10 || $period['top_regions_id'] == 26) {
                        $performers_id = array_shift(self::$kiev);
                    } else {
                        $performers_id = array_shift(self::$region);
                    }

                    $sql =  'INSERT INTO ' . PREFIX . '_tasks SET ' .
                            'child_id = 0, ' .
                            'date = ' . $db->quote( $date ) . ', ' .
                            'task_types_id = ' . TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT . ', ' .
                            'policies_id = ' . $period['policies_id'] . ', ' .
                            'policy_payments_calendar_id = ' . $next_period['policy_payments_calendar_id'] . ', ' .
                            'task_statuses_call_id = 0, ' .
                            'sto_call = 0, ' .
                            'task_statuses_id = 37, ' .
                            'performers_id = ' . $performers_id . ', ' .
                            'agencies_id = 1469, ' .
                            'comment = ' . $db->quote('Наступний платіж за договором ' . $period['policies_number'] . '. Сума ' . $next_period['amount'] . '. Термін сплати ' . $next_period['date']) . ', ' .
                            'created = NULL, ' .
                            'modified = NOW()';
                    $db->query($sql);

                    $id =  mysql_insert_id();

                    echo 'generate task - ' . $id . ' ' . $sql . '<br /><br /><br />';

                    $sql = 'UPDATE ' . PREFIX . '_tasks SET top = ' . $id . ' WHERE id = ' . $id;
                    $db->query($sql);

                    $sql = 'UPDATE ' . PREFIX . '_clients SET agents_id = ' . $performers_id . ' WHERE id = ' . intval($period['clients_id']);

                    echo $sql . '<br /><br />';
                    $db->query($sql);

                    if (false && in_array($period['clients_agents_id'], array_merge(self::$vip, self::$kiev, self::$region))) {

                    } else if ($period['important_person'] && $period['important_person_groups_id'] == 1) {
                        self::$vip[] = $performers_id;
                    } else if ($period['top_regions_id'] == 10 || $period['top_regions_id'] == 26) {
                        self::$kiev[] = $performers_id;
                    } else {
                        self::$region[] = $performers_id;
                    }
                }
            }
        }

        echo 'generateNextPayment - Done';
    }

    //генерируем задачи на очередные платежи
    function generateProlongationBank() {
        global $db;

        //получаем календари
        $periods = Reports::getInsurancePeriods(
            array(
                'calendar' => 1,
                'product_types_id' => 3,
                'types_id' => 0,
                'date_types_id' => 3,
                'from' => date('d.m.Y', mktime(0, 0, 0, date('m')+1, 1, date('Y'))),
                'to' => date('d.m.Y', mktime(0, 0, 0, date('m')+2, 0, date('Y')))
        ));

        foreach ($periods as $i => $period) {

            //проверяем последний ли это платеж
            if ($period['last_years_period'] == 1 && $period['is_agr'] == 0 && $period['second_fifty_fifty'] == 0 && intval($period['skip_prolongation'])!=1) {

                //выбрасываем банки
                if (!in_array(intval($period['financial_institutions_id']), array(0, 28))) {

                    //выбрасываем Крым и Севастополь
                    if (in_array($period['top_regions_id'], array(1, 27))) {
                        continue;
                    }

                    //получаем следующий платеж по календарю платежей
                    $next_period = $this->getNextPeriod($period['policies_id'], $period['policy_payments_calendar_id']);
                    if (is_null($next_period)) {
                        $next_period = $period;
                        $next_period['date'] = str_replace('.', '-', $period['policies_end_datetime_format']);
                        $next_period['statuses_id'] = 1;
                    }
                    list($day, $month, $year) = explode('-', $next_period['date']);
                    $date = date('Y.m.d', mktime(0, 0, 0, $month, $day, $year));
                    if (//проверяем оплату периода
                        $next_period['statuses_id'] < 3 &&
                        //проверяем, чтобы задача не была ранее создана
                        !$this->isTaskExists($period['policies_id'], $period['policy_payments_calendar_id'], TASK_TYPES_POLICIES_PROLONGATION)) {

                        if (false && in_array($period['clients_agents_id'], array_merge(self::$vip, self::$kiev, self::$region))) {
                            $performers_id = $period['clients_agents_id'];
                        } else if ($period['important_person'] && $period['important_person_groups_id'] == 1) {
                            $performers_id = array_shift(self::$vip);
                        } else if ($period['top_regions_id'] == 10 || $period['top_regions_id'] == 26) {
                            $performers_id = array_shift(self::$kiev);
                        } else {
                            $performers_id = array_shift(self::$region);
                        }
                        $sql =  'INSERT INTO ' . PREFIX . '_tasks SET ' .
                                'child_id = 0, ' .
                                'date = ' . $db->quote( $date ) . ', ' .
                                'task_types_id = ' . TASK_TYPES_POLICIES_PROLONGATION . ', ' .
                                'policies_id = ' . $period['policies_id'] . ', ' .
                                'policy_payments_calendar_id = ' . $period['policy_payments_calendar_id'] . ', ' .
                                'task_statuses_call_id = 0, ' .
                                'sto_call = 0, ' .
                                'task_statuses_id = 38, ' .
                                'performers_id = ' . $performers_id . ', ' .
                                'agencies_id = 1469, ' .
                                'comment = ' . $db->quote('Пролонгація договору ' . $period['policies_number'] . '.') . ', ' .
                                'created = NULL, ' .
                                'modified = NOW()';
                        $db->query($sql);

                        $id =  mysql_insert_id();

                        echo 'generate task - ' . $id . ' ' . $sql . '<br>';

                        $sql = 'UPDATE ' . PREFIX . '_tasks SET top = ' . $id . ' WHERE id = ' . $id;
                        $db->query($sql);

                        $sql = 'UPDATE ' . PREFIX . '_clients SET agents_id = ' . $performers_id . ' WHERE id = ' . intval($period['clients_id']);
                        echo $sql . '<br /><br />';
                        $db->query($sql);

                        if (false && in_array($period['clients_agents_id'], array_merge(self::$vip, self::$kiev, self::$region))) {

                        } else if ($period['important_person'] && $period['important_person_groups_id'] == 1) {
                            self::$vip[] = $performers_id;
                        } else if ($period['top_regions_id'] == 10 || $period['top_regions_id'] == 26) {
                            self::$kiev[] = $performers_id;
                        } else {
                            self::$region[] = $performers_id;
                        }
                    }
                }
            }
        }

        echo 'generateProlongation - Done';
    }

    //генерируем задачи на очередные платежи
    function generateProlongationRetail() {
        global $db;

        //получаем календари
        $periods = Reports::getInsurancePeriods(
            array(
                'calendar' => 1,
                'product_types_id' => 3,
                'types_id' => 0,
                'date_types_id' => 3,
                'from' => date('d.m.Y', mktime(0, 0, 0, date('m')+1, 1, date('Y'))),
                'to' => date('d.m.Y', mktime(0, 0, 0, date('m')+2, 0, date('Y')))
        ));

        foreach ($periods as $i => $period) {
 
            //проверяем последний ли это платеж
            if ($period['last_years_period'] == 1 && $period['is_agr'] == 0 && $period['second_fifty_fifty'] == 0 && intval($period['skip_prolongation'])!=1) {

                //выбрасываем банки
                if (intval($period['financial_institutions_id']) == 0) {

                    //выбрасываем Крым и Севастополь
                    if (in_array($period['top_regions_id'], array(1, 27))) {
                        continue;
                    }

                    //не формируем задачи для договоров ритейловых для отдельных точек продаж
                    if (in_array($period['agencies_id'], array(206, 52, 55, 56, 848, 560, 15))) {
                        continue;
                    }

                    //В задачи на пролонгацию не должны попадать договора Тест-Драйв, Перегоны Автопарк, или страхователь = агенция
                    $sql =  'SELECT a.item, options_test_drive, options_race, insurer_identification_code, b.insurer_edrpou, c.edrpou ' .
                            'FROM ' . PREFIX . '_policies AS a ' .
                            'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                            'JOIN ' . PREFIX . '_agencies AS c ON a.agencies_id = c.id ' .
                            'WHERE policies_id = ' . intval($period['policies_id']);
                    $options = $db->getRow($sql);

                    if ($options['item'] == 'Автопарк' || $options['options_test_drive'] > 0 || $options['options_race']) {
                        continue;
                    } else if ($options['insurer_edrpou'] == $options['edrpou']) {
                        echo $period['policies_number'] . '!!!';
                        continue;
                    }

                    //получаем следующий платеж по календарю платежей
                    $next_period = $this->getNextPeriod($period['policies_id'], $period['policy_payments_calendar_id']);

                    if (is_null($next_period)) {
                        $next_period = $period;
                        $next_period['date'] = str_replace('.', '-', $period['policies_end_datetime_format']);
                        $next_period['statuses_id'] = 1;
                    }

                    list($day, $month, $year) = explode('-', $next_period['date']);
                    $date = date('Y.m.d', mktime(0, 0, 0, $month, $day, $year));

                    if (//проверяем оплату периода
                        $next_period['statuses_id'] < 3 &&
                        //проверяем, чтобы задача не была ранее создана
                        !$this->isTaskExists($period['policies_id'], $period['policy_payments_calendar_id'], TASK_TYPES_POLICIES_PROLONGATION)) {

                        if (false && in_array($period['clients_agents_id'], array_merge(self::$vip, self::$kiev, self::$region))) {
                            $performers_id = $period['clients_agents_id'];
                        } else if ($period['important_person'] && $period['important_person_groups_id'] == 1) {
                            $performers_id = array_shift(self::$vip);
                        } else if ($period['top_regions_id'] == 10 || $period['top_regions_id'] == 26) {
                            $performers_id = array_shift(self::$kiev);
                        } else {
                            $performers_id = array_shift(self::$region);
                        }

                        $sql =  'INSERT INTO ' . PREFIX . '_tasks SET ' .
                                'child_id = 0, ' .
                                'date = ' . $db->quote( $date ) . ', ' .
                                'task_types_id = ' . TASK_TYPES_POLICIES_PROLONGATION . ', ' .
                                'policies_id = ' . $period['policies_id'] . ', ' .
                                'policy_payments_calendar_id = ' . $period['policy_payments_calendar_id'] . ', ' .
                                'task_statuses_call_id = 0, ' .
                                'sto_call = 0, ' .
                                'task_statuses_id = 38, ' .
                                'performers_id = ' . $performers_id . ', ' .
                                'agencies_id = 1469, ' .
                                'comment = ' . $db->quote('Пролонгація договору ' . $period['policies_number'] . '.') . ', ' .
                                'created = NULL, ' .
                                'modified = NOW()';
                        $db->query($sql);

                        $id =  mysql_insert_id();

                        echo 'generate task - ' . $id . ' ' . $sql . '<br>';

                        $sql = 'UPDATE ' . PREFIX . '_tasks SET top = ' . $id . ' WHERE id = ' . $id;
                        $db->query($sql);

                        $sql = 'UPDATE ' . PREFIX . '_clients SET agents_id = ' . $performers_id . ' WHERE id = ' . intval($period['clients_id']);
                        $db->query($sql);

                        if (false && in_array($period['clients_agents_id'], array_merge(self::$vip, self::$kiev, self::$region))) {

                        } else if ($period['important_person'] && $period['important_person_groups_id'] == 1) {
                            self::$vip[] = $performers_id;
                        } else if ($period['top_regions_id'] == 10 || $period['top_regions_id'] == 26) {
                            self::$kiev[] = $performers_id;
                        } else {
                            self::$region[] = $performers_id;
                        }
                    }
                }
            }
        }

        echo 'generateProlongation - Done';
    }

    public function isTaskKASKOBankExists($clients_id, $shassi) {
        global $db;

        $conditions[] = 'task_types_id IN (' . TASK_TYPES_POLICY_PAYMENTS_CALENDAR_NEXT . ',' . TASK_TYPES_POLICIES_PROLONGATION . ')';
        $conditions[] = 'task_statuses_id IN (37, 38)';
        $conditions[] = 'policies_id IN('.
                            'SELECT a.id ' .
                            'FROM insurance_policies AS a ' . 
                            'JOIN insurance_policies_kasko AS b ON a.id = b.policies_id ' .
                            'JOIN insurance_policies_kasko_items AS c ON a.id = c.policies_id ' .
                            'WHERE a.clients_id = ' . intval($clients_id) . ' AND c.shassi = ' . $db->quote($shassi) . ' AND b.financial_institutions_id > 0 ' .
                        ')';

        $sql =  'SELECT id ' .
                'FROM insurance_tasks ' .
                'WHERE ' . implode(' AND ', $conditions);
        $id = $db->getOne($sql);

        return ($id > 0) ? true : false;
    }

    //генерируем задачи на очередные платежи
    function generateProlongationGO() {
        global $db;

        //получаем календари
        $periods = Reports::getInsurancePeriods(
            array(
                'calendar' => 1,
                'product_types_id' => 4,
                'types_id' => 0,
                'date_types_id' => 3,
                'from' => date('d.m.Y', mktime(0, 0, 0, date('m')+1, 1, date('Y'))),
                'to' => date('d.m.Y', mktime(0, 0, 0, date('m')+2, 0, date('Y')))
        ));

        foreach ($periods as $i => $period) {

            //выбрасываем Крым и Севастополь
            if (in_array($period['top_regions_id'], array(1, 27))) {
                continue;
            }

            //не формируем задачи для договоров ритейловых для отдельных точек продаж
            if (in_array($period['agencies_id'], array(206, 52, 55, 56, 848, 560, 15))) {
                continue;
            }

            $next_period = $period;
            $next_period['date'] = str_replace('.', '-', $period['policies_end_datetime_format']);
            $next_period['statuses_id'] = 1;

            list($day, $month, $year) = explode('-', $next_period['date']);
            $date = date('Y.m.d', mktime(0, 0, 0, $month, $day, $year));

            //В задачи на пролонгацию не должны попадать договора Тест-Драйв, Перегоны Автопарк, или страхователь = агенция
            $sql =  'SELECT insurer_identification_code, b.insurer_edrpou, c.edrpou ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                    'JOIN ' . PREFIX . '_agencies AS c ON a.agencies_id = c.id ' .
                    'WHERE policies_id = ' . intval($period['policies_id']);
            $options = $db->getRow($sql);

            if ($options['insurer_edrpou'] == $options['edrpou']) {
                echo $period['policies_number'] . '!!!';
                continue;
            }

            if ($this->isTaskKASKOBankExists($period['clients_id'], $period['shassi'])) {
                $task_types_id = TASK_TYPES_POLICIES_GO_BANK;
                $task_statuses_id = 62;
            } else {
                $task_types_id = TASK_TYPES_POLICIES_GO;
                $task_statuses_id = 66;
            }

            if (//проверяем оплату периода
                $next_period['statuses_id'] < 3 &&
                //проверяем, чтобы задача не была ранее создана
                !$this->isTaskExists($period['policies_id'], $period['policy_payments_calendar_id'], $task_types_id)) {

                if (false && in_array($period['clients_agents_id'], array_merge(self::$vip, self::$kiev, self::$region))) {
                    $performers_id = $period['clients_agents_id'];
                } else if ($period['important_person'] && $period['important_person_groups_id'] == 1) {
                    $performers_id = array_shift(self::$vip);
                } else if ($period['top_regions_id'] == 10 || $period['top_regions_id'] == 26) {
                    $performers_id = array_shift(self::$kiev);
                } else {
                    $performers_id = array_shift(self::$region);
                }

                $sql =  'INSERT INTO ' . PREFIX . '_tasks SET ' .
                        'child_id = 0, ' .
                        'date = ' . $db->quote( $date ) . ', ' .
                        'task_types_id = ' . $task_types_id . ', ' .
                        'policies_id = ' . $period['policies_id'] . ', ' .
                        'policy_payments_calendar_id = ' . $period['policy_payments_calendar_id'] . ', ' .
                        'task_statuses_call_id = 0, ' .
                        'sto_call = 0, ' .
                        'task_statuses_id = ' . $task_statuses_id . ', ' .
                        'performers_id = ' . $performers_id . ', ' .
                        'agencies_id = 1469, ' .
                        'comment = ' . $db->quote('Пролонгація договору ' . $period['policies_number'] . '.') . ', ' .
                        'created = NULL, ' .
                        'modified = NOW()';
                $db->query($sql);

                $id =  mysql_insert_id();

                echo 'generate task - ' . $id . ' ' . $sql . '<br>';

                $sql = 'UPDATE ' . PREFIX . '_tasks SET top = ' . $id . ' WHERE id = ' . $id;
                $db->query($sql);

                $sql = 'UPDATE ' . PREFIX . '_clients SET agents_id = ' . $performers_id . ' WHERE id = ' . intval($period['clients_id']);
                $db->query($sql);

                if (false && in_array($period['clients_agents_id'], array_merge(self::$vip, self::$kiev, self::$region))) {

                } else if ($period['important_person'] && $period['important_person_groups_id'] == 1) {
                    self::$vip[] = $performers_id;
                } else if ($period['top_regions_id'] == 10 || $period['top_regions_id'] == 26) {
                    self::$kiev[] = $performers_id;
                } else {
                    self::$region[] = $performers_id;
                }
            }
        }

        echo 'generateProlongation - Done';
    }

    function generateLetterInWindow() {
        global $db;

        $sql =  'UPDATE insurance_tasks SET ' .
                'task_statuses_id = 47 ' .
                'WHERE task_types_id = 5 and task_statuses_id NOT IN(39, 33, 46,47, 48, 31) AND created IS NOT NULL AND TO_DAYS(date) + 14 < TO_DAYS(NOW())';
        $db->query($sql);
    }

    function generateInWindow() {
        global $db;

        //генерируем задачи на очередные платежи
        $this->generateNextPayment();

        //генерируем задачи на пролонгации Ритейл
        $this->generateProlongationBank();
        //генерируем задачи на пролонгации Ритейл
        
        $this->generateProlongationRetail();

        ////генерируем задачи на пролонгации ГО
        $this->generateProlongationGO();

        //генерируем задачи на отправку писем
        $this->generateLetterInWindow();


        //устанавливаем статус VIP и группу клиентов
        $sql =  'SELECT insurance_policies.clients_id ' .
                'FROM insurance_policies ' .
                'LEFT JOIN insurance_policies_kasko_items ON insurance_policies.id = insurance_policies_kasko_items.policies_id ' .
                'LEFT JOIN insurance_clients ON insurance_policies.clients_id = insurance_clients.id ' .
                'WHERE products_id IN ( 673 )  AND clients_id >0 AND important_person = 0';
        $res = $db->query($sql);

        while($res->fetchInto($row)) {
            $sql = 'UPDATE insurance_clients SET important_person = 1, client_groups_id = 3 WHERE id = ' . intval($row['clients_id']) . ' LIMIT 1';
            $db->query($sql);
        }

        $to = '';
        $subject = 'the subject';
        $message = 'Client group and VIP status set';
        $headers = 'From: info@e-insurance.in.ua' . "\r\n" .
                   'Reply-To: info@e-insurance.in.ua' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        echo mail($to, $subject, $message, $headers);

    }
    
    function getListInWindow($data) {
        global $db;
        
        $sql = 'SELECT id, title ' . 
               'FROM ' . PREFIX . '_task_types ' .
               'WHERE id IN (3,4,5,8,9)';
        $list = $db->getAll($sql);
        
        echo json_encode($list);
    }
    
    function getListStatusesInWindow($data) {
        global $db;
        
        $sql = 'SELECT id, title, parent_id, num_l ' . 
               'FROM ' . PREFIX . '_task_statuses ' .
               'WHERE parent_id = 0 AND task_types_id = ' . intval($data['types_id']) . ' ' . 
               'ORDER BY num_l';
        $list = $db->getAll($sql);

        $result = array();
        foreach ($list as $row) {
            $sql = 'SELECT id, title, parent_id, num_l ' . 
                   'FROM ' . PREFIX . '_task_statuses ' .
                   'WHERE parent_id = ' . intval($row['id']) . ' ' .
                   'ORDER BY num_l';
            $res = $db->getAll($sql);
            $result[] = $row;
            foreach ($res as $line) {
                $result[] = $line;
            }
        }
        
        echo json_encode($result);
    }
    
    function createTaskInWindow($data) {
        global $db;
        
        $sql =  'INSERT INTO ' . PREFIX . '_tasks SET ' .
                'policies_id = ' . intval($data['policies_id']) . ', ' .
                'policy_payments_calendar_id = ' . intval($data['calendar_id']) . ', ' .
                'date = ' . $db->quote(date('Y-m-d', strtotime($data['date']))) . ', ' .
                'task_types_id = ' . intval($data['task_types_id']) . ', ' .
                'task_statuses_id   = ' . intval($data['task_statuses_id']) . ', ' .
                'performers_id = ' . intval($data['performers_id']) . ', ' .
                'created = NOW(), ' .
                'modified = NOW()';
        $db->query($sql);

        $id = mysql_insert_id();
        
        $sql = 'UPDATE ' . PREFIX . '_tasks SET top = ' . intval($id) . ' WHERE id = ' . intval($id);
        $db->query($sql);
        
    }
    
    function getInfo($data) {
        global $db;
        switch ($data['task_types_id']) {
            case TASK_TYPES_APPLICATION_ACCIDENTS:
                $fields[] = 'CONCAT(kasko_items.brand, \'/\', kasko_items.model) as item';
                $fields[] = 'kasko_items.sign';
                $fields[] = 'IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company) as insurer_name';
                $fields[] = 'policies_kasko.insurer_phone as insurer_phone';
                $fields[] = 'policies.clients_id';
                $fields[] = 'policies.number as policies_number';
                $fields[] = 'policies.id as policies_id';
                $fields[] = 'policies.product_types_id as product_types_id';
                $fields[] = 'calls.number as calls_number';
                $fields[] = 'calls.id as calls_id';
                $fields[] = 'CONCAT_WS(\' \', calls.applicant_lastname, calls.applicant_firstname, calls.applicant_patronymicname) as applicant_name';
                $fields[] = 'calls.applicant_phone as applicant_phone';
                $fields[] = 'calls.datetime as datetime';
                
                $joins[] = 'LEFT JOIN ' . PREFIX . '_application_calls as calls ON tasks.id = calls.tasks_id';
                $joins[] = 'LEFT JOIN ' . PREFIX . '_policies as policies ON tasks.policies_id = policies.id';
                $joins[] = 'LEFT JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id';
                $joins[] = 'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON calls.policies_kasko_items_id = kasko_items.id';
                
                break;
        }
        
        $sql = 'SELECT ' . implode(', ' , $fields) . ' ' .
               'FROM ' . PREFIX . '_tasks as tasks ' .
               ((sizeof($joins) != 0) ? implode(' ', $joins) : '') .
               ' WHERE tasks.id = ' . intval($data['id']);
        $info = $db->getRow($sql);
        
        include_once 'Tasks/application_accidents_info.php';
    }
    
    function importAxapta($data) {
        global $db, $Log;
        
        if (intval($data['process'])) {
            
            $params = array('Файл', $languageDescription);
            if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
                $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
            } elseif (!ereg('\.xls$', $_FILES['file']['name'])) {
                $Log->add('error', 'Невірний формат файлу, підтримується формат xls.', $params);
            }
            
            if (!intval($data['agencies_id'])) {
                $Log->add('error', 'Виберіть агенцію.', $params);
            }

            if (!intval($data['task_types_id'])) {
                $Log->add('error', 'Виберіть тип задачі.', $params);
            }

            if (!intval($data['task_statuses_id'])) {
                $Log->add('error', 'Виберіть статус задачі.', $params);
            }

            if (!$Log->isPresent()) {
                require_once 'Excel/reader.php';
            
                $Excel = new Spreadsheet_Excel_Reader();
                $Excel->setOutputEncoding(CHARSET);
                $Excel->read($_FILES['file']['tmp_name']);
                
                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+1, date('Y')));
                
                $counter = 0;
                for ($i=1; $i<=$Excel->sheets[0]['numRows']; $i++) {
                    $sql =  'INSERT INTO ' . PREFIX . '_tasks SET ' .
                                'child_id = 0, ' .
                                'date = ' . $db->quote( $date ) . ', ' .
                                'task_types_id = ' . intval($data['task_types_id']) . ', ' .
                                'policies_id = 0, ' .
                                'policy_payments_calendar_id = 0, ' .
                                'task_statuses_call_id = 0, ' .
                                'sto_call = 0, ' .
                                'task_statuses_id = ' . intval($data['task_statuses_id']) . ', ' .
                                'performers_id = 0, ' .
                                'question = ' . $db->quote(serialize(array('text' => $Excel->sheets[0]['cells'][ $i ][ 1 ]))) . ', ' .
                                'agencies_id = ' . intval($data['agencies_id']) . ', ' .
                                'comment = ' . $db->quote($Excel->sheets[0]['cells'][ $i ][ 1 ]) . ', ' .
                                'created = NOW(), ' .
                                'modified = NOW()';
                    $db->query($sql);
                    
                    $counter++;
                }

                $Log->add('confirm', '<b>Файл був оброблений.</b><br /><br /><table><tr><td>Створено:</td><td align="right">' . $counter . '</td></tr></table>' , $params);
            
                header('Location: ' . $data['redirect']);
                exit;
            }            
        }
        
        $sql =  'SELECT id, code, title, level ' .
                'FROM ' . PREFIX . '_agencies ' .
                'ORDER BY CAST(code AS UNSIGNED),num_l';                
        $agencies = $db->getAll($sql, 60 * 60);

        $sql =  'SELECT id, title ' .
                'FROM ' . PREFIX . '_task_types ' .
                'ORDER BY title';
        $task_types = $db->getAll($sql, 60*60);

        $sql =  'SELECT a.id, IF(a.parent_id = 0, a.title, CONCAT(\' --- \', a.title)) AS title, a.parent_id, a.task_types_id ' .
                'FROM ' . PREFIX . '_task_statuses AS a ' .
                'JOIN ' . PREFIX . '_task_types AS b ON a.task_types_id = b.id ' .
                'ORDER BY b.title, num_l';
        $task_statuses = $db->getAll($sql, 60*60);

        include_once 'Tasks/importAxapta.php';
    }
    
}

?>