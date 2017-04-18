<?
/*
 * Title: accident messages class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Accidents.class.php';
require_once 'AccountGroups.class.php';
require_once 'AccidentDocuments.class.php';
require_once 'CarServices.class.php';
require_once 'Users/Experts.class.php';
require_once 'Users/Managers.class.php';
require_once 'Courts.class.php';

class AccidentMessages extends Form {

    var $statuses = array(
        1 => 'задача',
        2 => 'рішення',
        5 => 'погодження',
        6 => 'затвердження',
        3 => 'помилки',
        4 => 'перервано'
    );

    var $fields = array('question', 'answer');

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
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'accidents_id',
                            'description'       => 'Справа',
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
                            'width'             => 60,
                            'orderPosition'     => 1,
                            'table'             => 'accident_messages',
                            'sourceTable'       => 'accidents',
                            'selectField'       => 'number',
                            'orderField'        => 'number'),
                        /*array(
                            'name'              => 'accident_statuses_id',
                            'description'       => 'Статус справи',
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
                            'width'             => 60,
                            'orderPosition'     => 2,
                            'table'             => 'accidents'),*/
                        array(
                            'name'              => 'archive_statuses_id',
                            'description'       => 'Архів, справа',
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
                            'width'             => 60,
                            'withoutTable'      => true,
                            'orderName'         => 'insurance_accidents.archive_statuses_id',
                            'orderPosition'     => 3,
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'car_services_id',
                            'description'       => 'СТО',
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
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'author_roles_id',
                            'description'       => 'Автор, роль',
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
                            'table'             => 'accident_messages',
                            'sourceTable'       => 'roles',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'author_organization',
                            'description'       => 'Автор, організація',
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
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'authors_id',
                            'description'       => 'Автор',
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
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'author',
                            'description'       => 'Автор',
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
                            'orderPosition'     => 5,
                            'table'             => 'accident_messages'),
                         array(
                            'name'              => 'message_types_id',
                            'description'       => 'Тип',
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
                            'orderPosition'     => 4,
                            'condition'         => 'term <> 0',
                            'table'             => 'accident_messages',
                            'sourceTable'       => 'accident_message_types',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'recipient_roles_id',
                            'description'       => 'Виконавець, роль',
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
                            'table'             => 'accident_messages',
                            'sourceTable'       => 'roles',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'recipient_organizations_id',
                            'description'       => 'Виконавець, організація',
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
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'recipient_organization',
                            'description'       => 'Виконавець, організація',
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
                            'orderPosition'     => 6,
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'recipients_id',
                            'description'       => 'Отримувач',
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
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'curators_id',
                            'description'       => 'Куратор',
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
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'recipient',
                            'description'       => 'Виконавець',
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
                            'orderPosition'     => 7,
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'subject',
                            'description'       => 'Тема',
                            'type'              => fldHidden,
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
                            'orderPosition'     => 8,
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'question',
                            'description'       => 'Питання',
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
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'answer',
                            'description'       => 'Відповідь',
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
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldSelect,
                            'list'              => array(
                                                    1 => 'задача',
                                                    2 => 'рішення',
                                                    3 => 'помилки',
                                                    4 => 'перервано',
                                                    5 => 'погодження',
                                                    6 => 'затвердження'
                                                   ),

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
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
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
                            'width'             => 100,
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDateTime,
                            //'value'             => 'NOW()',
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
                            'orderPosition'     => 11,
                            'width'             => 100,
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'decision',
                            'description'       => 'Рішення',
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
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 12,
                            'width'             => 100,
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'days',
                            'description'       => 'В роботі, дні',
                            'type'              => fldText,
                            'orderName'         => 'days',
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
                            'orderPosition'     => 13,
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'phone_date',
                            'description'       => 'Дата наступного дзвінка',
                            'type'              => fldDateTime,
                            'orderName'         => 'phone_date',
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
                            'orderPosition'     => 14,
                            'table'             => 'accident_messages'),
                        array(
                            'name'              => 'phone_count',
                            'description'       => 'Кількість дзвінків',
                            'type'              => fldInteger,
                            'orderName'         => 'phone_date',
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
                            'orderPosition'     => 15,
                            'table'             => 'accident_messages')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 13,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'subject'
                    )
            );

    function AccidentMessages($data, $objectTitle=null) {

        Form::Form($data);

        $this->messages['plural'] = 'Задачі/повідомлення';
        $this->messages['single'] = 'Задача/повідомлення';
    }

    function getSuffix($data) {
        global $db;
    
        switch($data['product_types_id']) {
            case PRODUCT_TYPES_KASKO:
            case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                return $this->suffix = array('kasko', 'kasko');

            case PRODUCT_TYPES_GO:
                return $this->suffix = array('go', 'go');

            case PRODUCT_TYPES_NS:
                return $this->suffix = array('ns', 'ns');
            case PRODUCT_TYPES_PROPERTY:
                return $this->suffix = array('property', 'property');
            case PRODUCT_TYPES_CARGO_CERTIFICATE:           
                $sql = 'SELECT b.product_types_id FROM insurance_accidents a JOIN insurance_policies b ON a.policies_id = b.id WHERE a.id = ' . intval($data['accidents_id']);
                if ($db->getOne($sql) == PRODUCT_TYPES_CARGO_CERTIFICATE) return $this->suffix = array('cargo', 'cargo');
                else return $this->suffix = array('cargo', 'one_shipping');
            case PRODUCT_TYPES_ONE_SHIPPING:
                return $this->suffix = array('cargo', 'one_shipping');
        }
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template = null) {
        global $db;

        $this->checkPermissions('update', $data);

        $is_accidents = $data['is_accidents'];


        if($data['product_types_id'] == PRODUCT_TYPES_DRIVE_CERTIFICATE) $data['product_types_id'] = PRODUCT_TYPES_KASKO;

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        //если запрос на load идет с главной страницы
        if(!$data['accidents_id']) {
            $sql =  'SELECT accidents_id ' .
                    'FROM ' . PREFIX . '_accident_messages ' .
                    'WHERE id = ' . intval($data['id']) ;
        $data['accidents_id'] = $db->getOne($sql);
        }

        //находим продукт, для выборки данных о задаче
        $sql =  'SELECT a.product_types_id ' .
                'FROM ' . PREFIX . '_policies as a ' .
                'JOIN ' . PREFIX . '_accidents as b ON b.policies_id = a.id ' .
                'WHERE b.id = ' . intval($data['accidents_id']) ;
        $data['product_types_id'] = $db->getOne($sql);

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        //поределяем оконания названий таблицы
        $suffix = $this->getSuffix($data);      

        //определяем поля в запросе в зависимости от продукта
        switch($data['product_types_id']) {
            case PRODUCT_TYPES_KASKO:
                break;
            case PRODUCT_TYPES_GO:
                $additional_fields[] = PREFIX . '_accidents_' . $suffix[0] . '.expert_organizations_id';
                break;
        }

        $sql =  'SELECT ' . implode(', ', $this->formFields) . ', ' . PREFIX . '_policies.product_types_id, ' .
                 (is_array($additional_fields) ? implode(', ', $additional_fields). ', ': '' ) .
                 $this->tables[0] . '.recipient_roles_id,  ' .
                 PREFIX . '_accidents.repair_classifications_id, ' .
                'e.lastname AS average_lastname, e.firstname AS average_firstname, f.lastname AS estimate_lastname, f.firstname AS estimate_firstname, ' .
                PREFIX . '_accidents.masters_id as masters_id, ' .
                PREFIX . '_accidents.car_services_id as accidents_car_services_id ' .
                'FROM ' . $this->tables[0] . ' ' .
                'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accidents.id = ' . $this->tables[0].'.accidents_id ' .
                'JOIN ' . PREFIX . '_accidents_' . $suffix[0] . ' ON ' . PREFIX . '_accidents_' . $suffix[0] . '.accidents_id = ' . $this->tables[0].'.accidents_id ' .
                'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies.id ' .
                'JOIN ' . PREFIX . '_policies_' . $suffix[1] . ' ON ' . PREFIX . '_accidents.policies_id = ' . PREFIX . '_policies_' . $suffix[1] . '.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS e ON e.id = ' . PREFIX . '_accidents.average_managers_id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS f ON f.id =' . PREFIX . '_accidents.estimate_managers_id ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        if(intval($data['product_types_id']) == PRODUCT_TYPES_GO){
            $data['assistance_managers'] = $this->getAssistanceManagers();
        }

        $data = $this->prepareFields($action, $data);

        $data['is_accidents'] = $is_accidents;
        switch($data['product_types_id']) {
            case PRODUCT_TYPES_KASKO:
            case PRODUCT_TYPES_DRIVE_CERTIFICATE:
            $data['redirect'] = '/index.php?do=Accidents|show&product_types_id=' . PRODUCT_TYPES_KASKO;


                break;
            case PRODUCT_TYPES_GO:
                $data['redirect'] = '/index.php?do=Accidents|show&product_types_id=' . PRODUCT_TYPES_GO;
                break;
        }

        //коэффициэнты по предыдущему акту
        $accident_acts_coeffs = $this->getAccidentActsCoeffs($data['accidents_id'], $suffix);
        if($accident_acts_coeffs)
            $data = array_merge($data, $accident_acts_coeffs);

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => true,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => true,
                    'export'    => true,
                    'request'   => true,
                    'approval'  => true);
                break;
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                if (in_array($Authorization->data['id'], array(12027, 12028))) {
                    $this->permissions['approval'] = true;
                }
                break;
            case ROLES_MASTER:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => true,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => false);
                if ($Authorization->data['id'] == $data['authors_id'])
                    $this->permissions['update'] = true;
                break;
        }

        $this->permissions['insert'] = (intval($data['accidents_id'])) ? $this->permissions['insert'] : false;
    }

    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Authorization;

        $result = parent::checkPermissions($action, $data);

        switch ($action) {
            case 'update':
                if (is_array($data['id'])) {
                    $data['id'] = $data['id'][ 0 ];
                }

                $sql =  'SELECT * ' .
                        'FROM ' . PREFIX . '_accident_messages ' .
                        'WHERE id = ' . intval($data['id']);
                $row = $db->getRow($sql);
                
                if ($Authorization->data['roles_id'] == ROLES_MASTER && in_array($row['message_types_id'], array(ACCIDENT_MESSAGE_TYPES_CALCULATION, ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST)) && in_array($row['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_QUESTION, ACCIDENT_MESSAGE_STATUSES_ERROR)) && $Authorization->data['car_services_id'] == $row['car_services_id']) {
                    return true;
                }
                if (($Authorization->data['id'] == $row['curators_id'] || in_array($row['curators_id'], $Authorization->data['managers'])) && $row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && in_array($row['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_COORDINATION, ACCIDENT_MESSAGE_STATUSES_APPROVAL))) {
                    return true;
                }

                if ($row['authors_id'] ==  $Authorization->data['id'] || in_array($row['authors_id'], $Authorization->data['managers']) || ($Authorization->data['permissions']['AccidentMessages']['updateAll'] && $row['message_types_id'] != ACCIDENT_MESSAGE_TYPES_COPY_AGREEMENT) || $Authorization->data['roles_id'] == ROLES_ADMINISTRATOR){
                    parent::checkPermissions($action, $data, false);
                } else{
                    if((in_array($row['recipients_id'],$Authorization->data['managers']) || in_array($row['authors_id'],$Authorization->data['managers'])) && !in_array($row['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_ANSWER))){// если получатель есть в списке доверенных менеджеров текущего юзера и статус дела не "Решено"
                          parent::checkPermissions($action, $data, false);
                    } else {

                         if(!in_array($Authorization->data['roles_id'], array($row['recipient_roles_id'], ROLES_ADMINISTRATOR)) ||//если роль получателя не совпадает с ролью пользователя+роль администратора
                                    (intval($row['recipients_id']) && $Authorization->data['id'] != $row['recipients_id'] && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR) ||//если получатель задан, но не совпадает с текущим пользователем
                                    (intval($row['recipients_id']) && $Authorization->data['id'] == $row['recipients_id'] && in_array($row['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_ANSWER)) && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR) ||//если получатель задан, но не совпадает с текущим пользователем
                                    (!intval($row['recipients_id']) && !in_array($row['recipient_organizations_id'], $Authorization->data['account_groups_id']) && $Authorization->data['roles_id'] != ROLES_ADMINISTRATOR)){//если получатель не задан, пользователь не попадает в группу и пользователей не администратор
                                        parent::checkPermissions($action, $data, true);
                         }
                    }
                }
                break;
            case 'delete':
                switch ($Authorization->data['roles_id']) {
                    case ROLES_MANAGER:

                        //запрещаем удалять задачи не закрытые
                        $conditions[] = 'statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_QUESTION;
                        $conditions[] = 'authors_id IN(' . implode(', ', $Authorization->data['managers']) . ')';
                        $conditions[] = 'id IN(' . implode(', ', $data['id']) . ')';

                        $sql =  'SELECT id ' .
                                'FROM ' . $this->tables[ 0 ] . ' ' .
                                'WHERE ' . implode(' AND ', $conditions);
                        $id = $db->getCol($sql);

                        if (sizeOf($data['id']) != sizeOf($id)) {
                            parent::checkPermissions($action, $data, true);
                        }
                }
                break;
        }

        return $result;
    }

    function getRepairList() {
        global $db;

        $sql = 'SELECT id, title, term ' .
               'FROM ' . PREFIX . '_repair_classifications ' .
               'ORDER BY id';

        return $db->getAll($sql);
    }

    function getRowClass($row, $i) {
        global $db;

        $result = parent::getRowClass($row, $i);

        if (!$row['viewed']) {
            $result .= ' bold';
        }
        if ($row['message_types_id'] == 'Повідомлення'){
            $result .= ' violete';
            return $result;
        }
        if ($row['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_ANSWER){
            $result .= ' mess_answer';
            return $result;
        }
        if ($row['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_INTERRUPTED){
            $result .= ' mess_interrupted';
            return $result;
        }

        if ($row['days'] <= $row['term']) {

        } elseif ($row['days'] <= 2 * $row['term']) {
            $result .= ' green';
        } elseif ($row['days'] <= 3 * $row['term']) {
            $result .= ' yellow';
        } else {
            $result .= ' red';
        }

        return $result;
    }

    function setShowFields() {
        $this->formDescription['fields'][ $this->getFieldPositionByName('author') ]['type']                 = fldText;
        $this->formDescription['fields'][ $this->getFieldPositionByName('author_organization') ]['type']    = fldText;

        $this->formDescription['fields'][ $this->getFieldPositionByName('recipient') ]['type']              = fldText;
        $this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organization') ]['type'] = fldText;

        return parent::setShowFields();
    }

    function show($data, $fields=null, $conditions=null, $returnSQL=false, $template='show.php', $limit=true) {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

        if (!intval($data['accidents_id']) && !intval($data['product_types_id'])) $data['product_types_id'] = PRODUCT_TYPES_KASKO;
        
        if($data['product_types_id'] == PRODUCT_TYPES_DRIVE_CERTIFICATE) $data['product_types_id'] = PRODUCT_TYPES_KASKO;

        $hidden['do'] = $data['do'];
        $fields[] = 'do';
        $data['do'] = 'Accidents|show&show=messages';

        $this->formDescription['fields'][ $this->getFieldPositionByName('accidents_id') ]['type'] = fldSelect;
        $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['type'] = fldRadio;

        $sql =  'SELECT id, recipient_organization AS title ' .
                'FROM ' . PREFIX . '_account_groups ' .
                'WHERE recipient_organization <> \'\' ' .
                'ORDER BY recipient_organization';
        $fields['recipient_organizations'] = $db->getAll($sql, 30*60);

        $sql =  'SELECT id, CONCAT(lastname, \' \', firstname) AS title ' .
                'FROM ' . PREFIX . '_accounts ' .
                'WHERE roles_id = ' . ROLES_MANAGER . ' AND active = 1 ' .
                'ORDER BY title';
        $fields['recipients'] = $db->getAll($sql, 30*60);

        $fields['message_types'] = $this->formDescription['fields'][ $this->getFieldPositionByName('message_types_id') ];
        $fields['message_types']['list'] = $this->getListValue($fields['message_types'], $data);
        $fields['message_types']['object'] = $this->buildSelect($fields['message_types'], $data['message_types_id'], $data['languageCode'], 'multiple size="3"', null, $data, 'filter');

        $fields['statuses'] = $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ];
        $fields['statuses']['object'] = $this->buildSelect($fields['statuses'], $data['statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data, 'filter');

        $this->setTables('show');
        $this->setShowFields();
        //проверяем на принадлежность к делу
        if (intval($data['accidents_id'])) {
            $conditions[] = $this->tables[0] . '.accidents_id = ' . intval($data['accidents_id']);
            
            if ($data['product_types_id'] == 21) $data['product_types_id'] = 9;
        } else {

            $this->formDescription['fields'][ $this->getFieldPositionByName('accidents_id') ]['type'] = fldText;
            //не показываем задачи по делам в архиве, кроме сообщений
            //$conditions[] = '(archive_statuses_id = 0 OR (archive_statuses_id = 1 AND message_types_id = ' . ACCIDENT_MESSAGE_TYPES_MESSAGE .'))';
            //показываем задачи в статусе "Задача" или "Помилки"
            if(in_array(15, $data['message_types_id']) && sizeof($data['message_types_id']) == 1 && in_array(2, $data['statuses_id'])){
                $conditions[] = 'statuses_id IN(' . implode(', ', $data['statuses_id']) . ')';
                $conditions[] = 'message_types_id IN(' . implode(', ', $data['message_types_id']) . ')';
            }
            else {
                if ($Authorization->data['roles_id'] == ROLES_MASTER) {
                    $conditions[] = 'statuses_id IN(' . ACCIDENT_MESSAGE_STATUSES_QUESTION . ', ' . ACCIDENT_MESSAGE_STATUSES_ERROR . ')';
                    $field = ', isAccidentMessagesViewed(' . PREFIX . '_accident_messages.id, ' . intval($Authorization->data['id']) . ') AS viewed';
                } else {
                    $conditions[] = 'statuses_id IN(' . ACCIDENT_MESSAGE_STATUSES_QUESTION . ', ' . ACCIDENT_MESSAGE_STATUSES_ERROR . ', ' . ACCIDENT_MESSAGE_STATUSES_COORDINATION . ', ' . ACCIDENT_MESSAGE_STATUSES_APPROVAL . ')';
                    $field = ', isAccidentMessagesViewed(' . PREFIX . '_accident_messages.id, ' . intval($Authorization->data['id']) . ') AS viewed';
                }
            }
        }

        if (isset($data['from']) && $data['from'] != '') {
            $fields[] = 'from';
            $conditions[] =  $this->tables[0] . '.phone_date >= \'' . date('Y-m-d', strtotime($data['from'])) . '\'';
        }
        if (isset($data['to']) && $data['to'] != '') {
            $fields[] = 'to';
            $conditions[] =  $this->tables[0] . '.phone_date <= \'' . date('Y-m-d', strtotime($data['to'])) . '\'';
        }

        switch ($Authorization->data['roles_id']) {
            case ROLES_MASTER:
                $conditions[] = 'recipient_roles_id IN(' . ROLES_MASTER . ')';
                $conditions[] = '(recipients_id = ' . intval($Authorization->data['id']) . ' OR ' . PREFIX . '_accident_messages.car_services_id = ' . intval($Authorization->data['car_services_id']) . ')';
                break;
            case ROLES_MANAGER:
                if (!intval($data['accidents_id']) && !in_array(25, $Authorization->data['account_groups_id']) && !$Authorization->data['permissions']['AccidentMessages']['showAll'] && !in_array(ACCOUNT_GROUPS_AVERAGE, $Authorization->data['account_groups_id'])) {
                    $conditions[] = '((recipient_roles_id IN(' . ROLES_MANAGER . ') AND recipient_organizations_id IN(' . implode(', ', $Authorization->data['account_groups_id']) . ')) OR authors_id IN (' . implode(', ', $Authorization->data['managers']) . ') OR curators_id = ' . intval($Authorization->data['id']) . ')';
                }
                if (!intval($data['accidents_id']) && in_array(ACCOUNT_GROUPS_AVERAGE, $Authorization->data['account_groups_id']) && !in_array(25, $Authorization->data['account_groups_id'])) {
                    $conditions[] = '(recipients_id IN (' . implode(', ', $Authorization->data['managers']) . ') OR recipients_id = ' . intval($Authorization->data['id']) . ' OR authors_id = ' . intval($Authorization->data['id']) . ' OR authors_id IN (' . implode(', ', $Authorization->data['managers']) . '))';
                }
                break;
        }

        if (is_array($data['recipient_organizations_id'])) {
            $fields[] = 'recipient_organizations_id';
            $conditions[] = 'recipient_organizations_id IN(' . implode(', ', $data['recipient_organizations_id']) . ')';
        }

        if (is_array($data['recipients_id'])) {
            $fields[] = 'recipients_id';
            $conditions[] = 'recipients_id IN(' . implode(', ', $data['recipients_id']) . ')';
        }

        if (is_array($data['authors_id'])) {
            $fields[] = 'authors_id';
            $conditions[] = 'authors_id IN(' . implode(', ', $data['authors_id']) . ')';
        }
        
        if (is_array($data['curators_id'])) {
            $fields[] = 'curators_id';
            $conditions[] = 'curators_id IN(' . implode(', ', $data['curators_id']) . ')';
        }


        if ($data['number']) {
            $fields[] = 'number';
            $conditions[] = PREFIX . '_accidents.number LIKE ' . $db->quote($data['number'] . '%');
        }

        if (is_array($data['message_types_id'])) {
            $fields[] = 'message_types_id';
            $conditions[] = 'message_types_id IN(' . implode(', ', $data['message_types_id']) . ')';
        }

        if (is_array($data['statuses_id'])) {
            $fields[] = 'statuses_id';
            $conditions[] = 'statuses_id IN(' . implode(', ', $data['statuses_id']) . ')';
        }

        if($data['product_types_id']) {
            $conditions[] =  PREFIX . '_accidents.product_types_id = ' . $data['product_types_id'];
        }

        if ($data['messages_archive_statuses_id']) {
            $fields[] = 'messages_archive_statuses_id';
            $conditions[] =  PREFIX . '_accidents.archive_statuses_id IN(' . implode(', ', $data['messages_archive_statuses_id']) . ')';
        }

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $sql =  'SELECT ' . PREFIX . '_accidents.product_types_id, IF(' . PREFIX . '_accidents.repair_classifications_id = 0, "Не визначено", repair_classifications_id) as repair_classifications_id, ' .
                $this->tables[0] . '.*, ' . PREFIX . '_accidents.number AS accidents_id , ' .
                'IF(repair_classifications_id = 0,\'Не визначено\', repair_classifications_id) as repair_classification, ' .
                PREFIX . '_accident_message_types.title AS message_types_id, ' .
                'IF(' . PREFIX . '_accidents.archive_statuses_id = 0, \'в роботі\', \'архів\') as archive_statuses_id, ' .
                'date_format(' . $this->tables[0] . '.created, ' . $db->quote(DATETIME_FORMAT) . ') AS created_format, ' .
                'date_format(' . $this->tables[0] . '.modified, ' . $db->quote(DATETIME_FORMAT) . ') AS modified_format, ' .
                'date_format(' . $this->tables[0] . '.decision, ' . $db->quote(DATETIME_FORMAT) . ') AS decision_format, ' .
                'date_format(' . $this->tables[0] . '.phone_date, ' . $db->quote(DATE_FORMAT) . ') AS phone_date_format, ' .
                'TO_DAYS(IF(decision = \'0000-00-00 00:00:00\', NOW(), decision)) - TO_DAYS(' . PREFIX . '_accident_messages.created) AS days, ' .
                'getDateOrDaysWithoutWeekEnds(' . PREFIX . '_accident_messages.created, IF(decision = \'0000-00-00 00:00:00\', NOW(), decision), NULL) - 1 AS days, ' .
                'term ' . $field . ' ' .
                'FROM ' . $this->tables[0] . ' ' .
                'JOIN ' . PREFIX . '_accident_message_types ON ' . $this->tables[0] . '.message_types_id = ' . PREFIX . '_accident_message_types.id ' .
                'JOIN ' . PREFIX . '_accidents ON ' . $this->tables[0] . '.accidents_id = ' . PREFIX . '_accidents.id ';// .

        $totalSQL = $sql;

        if ($conditions) {
            $sql        .= 'WHERE ' . implode(' AND ', $conditions) . ' ';
            $totalSQL   .= 'WHERE ' . implode(' AND ', $conditions) . ' ';
        }

        if ($returnSQL) {
            return $sql;
        }

        $total = $db->getOne(transformToGetCount($totalSQL));

        $sql .= 'ORDER BY ' . $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);

        }

        $list = $db->getAll($sql);

        $this->changePermissions($total);

        include $this->object . '/' . $template;
    }

    function getValues($data) {
        global $db;

        $joins = array();

        switch($data['product_types_id']) {
            case PRODUCT_TYPES_GO:
                $table['product_type'] = 'go';
                $suffix_field = 'd.insurer_';
                $joins[] = 'JOIN ' . PREFIX . '_policies_go as d ON a.policies_id = d.policies_id';
                break;
            case PRODUCT_TYPES_KASKO:
                $table['product_type'] = 'kasko';
                $suffix_field = 'd.insurer_';
                $joins[] = 'JOIN ' . PREFIX . '_policies_kasko as d ON a.policies_id = d.policies_id';
                break;
            case PRODUCT_TYPES_NS:
                $table['product_type'] = 'ns';
                $joins[] = 'JOIN ' . PREFIX . '_policies_ns as d ON a.policies_id = d.policies_id';
                $suffix_field = 'd.insurer_';
                break;
            case PRODUCT_TYPES_PROPERTY:
                $table['product_type'] = 'property';
                $joins[] = 'JOIN ' . PREFIX . '_policies_property as d ON a.policies_id = d.policies_id';
                $suffix_field = 'd.insurer_';
                break;
            case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                $table['product_type'] = 'drive_general';
                $suffix_field = 'c.';
                $joins[] = 'JOIN ' . PREFIX . '_policies_drive as d ON a.policies_id = d.policies_id';
                $joins[] = 'JOIN ' . PREFIX . '_policies_drive_general as c ON c.policies_id = d.policies_general_id';
                break;
            case PRODUCT_TYPES_CARGO_CERTIFICATE:
                $sql = 'SELECT b.product_types_id FROM insurance_accidents a JOIN insurance_policies b ON a.policies_id = b.id WHERE a.id = ' . intval($data['accidents_id']);
                if ($db->getOne($sql) == PRODUCT_TYPES_CARGO_CERTIFICATE) {
                    $table['product_type'] = 'cargo_general';
                    $suffix_field = 'c.';
                    $joins[] = 'JOIN ' . PREFIX . '_policies_cargo as d ON a.policies_id = d.policies_id';
                    $joins[] = 'JOIN ' . PREFIX . '_policies_cargo_general as c ON c.policies_id = d.policies_general_id';
                } else {
                    $suffix_field = 'c.';
                    $joins[] = 'JOIN ' . PREFIX . '_policies_one_shipping as d ON a.policies_id = d.policies_id';
                    $suffix_field = 'd.insurer_';
                }
                break;
            case PRODUCT_TYPES_ONE_SHIPPING:
                $suffix_field = 'c.';
                $joins[] = 'JOIN ' . PREFIX . '_policies_one_shipping as d ON a.policies_id = d.policies_id';
                $suffix_field = 'd.insurer_';
                break;

        }

        $sql =  'SELECT a.number AS accidents_number, b.number AS policies_number, a.policies_id, ' . $suffix_field . 'lastname as insurer_lastname, ' . $suffix_field . 'firstname as insurer_firstname, ' . $suffix_field . 'patronymicname as insurer_patronymicname ' .
                'FROM ' . PREFIX . '_accidents AS a ' .
                'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
//                'JOIN ' . PREFIX . '_policies_' . $table['product_type'] . ' AS c ON a.policies_id = c.policies_id ' .
                implode(' ', $joins) .
                ' WHERE a.id = ' . intval($data['accidents_id']);//_dump($sql);

        return $db->getRow($sql, 30 * 60);
    }

    function add($data) {
        global $db, $Authorization;

        $is_accidents = $data['is_accidents'];

        $data['statuses_id'] = 0;

        switch ($data['product_types_id']){
            case PRODUCT_TYPES_GO:
                $suffix = 'go';
                break;
            case PRODUCT_TYPES_KASKO:
                $suffix = 'kasko';
                break;
            case PRODUCT_TYPES_PROPERTY:
                $suffix = 'property';
                break;
            case PRODUCT_TYPES_CARGO_CERTIFICATE:
                $sql = 'SELECT b.product_types_id FROM insurance_accidents a JOIN insurance_policies b ON a.policies_id = b.id WHERE a.id = ' . intval($data['accidents_id']);
                if ($db->getOne($sql) == PRODUCT_TYPES_CARGO_CERTIFICATE) $suffix = 'cargo';
                else $suffix = 'one_shipping';
                break;
        }

        $sql = 'SELECT a.number as accidents_number, b.id as policies_id, b.number as policies_number, c.insurer_lastname as insurer_lastname, c.insurer_firstname as insurer_firstname, c.insurer_patronymicname as insurer_patronymicname, d.lastname as average_lastname, d.firstname as average_firstname, e.lastname as estimate_lastname, e.firstname AS estimate_firstname, ' .
                    'c.insurer_phone as insurer_phone, a.applicant_lastname, a.applicant_firstname, a.applicant_patronymicname, a.applicant_phones ' .
               'FROM ' . PREFIX . '_accidents as a ' .
               'JOIN ' . PREFIX . '_policies as b ON a.policies_id = b.id ' .
               'JOIN ' . PREFIX . '_policies_' . $suffix . ' as c ON b.id = c.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_accounts as d ON d.id = a.average_managers_id ' .
               'LEFT JOIN ' . PREFIX . '_accounts as e ON e.id = a.estimate_managers_id ' .
               'WHERE a.id = ' . $data['accidents_id'];

        $data = array_merge($data, $db->getRow($sql));

        //if(intval($data['product_types_id']) == PRODUCT_TYPES_GO){
            $data['assistance_managers'] = $this->getAssistanceManagers();
        //}
        
        $data['is_accidents'] = $is_accidents;
        
        parent::add($data);
    }

    function getAssistanceManagers(){
        global $db;

        $sql = 'SELECT CONCAT(a.lastname, \' \', a.firstname) as expert, a.id ' .
                   'FROM ' . PREFIX . '_accounts as a ' .
                   'LEFT JOIN ' . PREFIX . '_account_groups_managers_assignments as b ON a.id = b.accounts_id ' .
               'WHERE account_groups_id = ' . ACCOUNT_GROUPS_ESTIMATE .
               ' ORDER BY a.lastname';
        return $experts_list = $db->getAll($sql);

    }

    function includeValuesTemplateInWindow($data) {
        global $db, $Authorization;

        if (intval($data['message_types_id'])) {
            $sql =  'SELECT template ' .
                    'FROM ' . PREFIX . '_accident_message_types ' .
                    'WHERE id = ' . intval($data['message_types_id']);
            include_once $this->object . '/' . $db->getOne($sql);
        }
    }

    function showForm($data, $action, $actionType=null) {
        global $db, $Authorization;

        $this->formDescription['fields'][ $this->getFieldPositionByName('message_types_id') ]['condition'] .= ' AND id <> 15';
        
        if($data['message_types_id'] == 15){
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('message_types_id') ]['condition']);
        }
        
        if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CONDUCTING_CARSCOMMODITY_RESEARCH) {
            $sql = 'SELECT a.id,a.title ' .
                   'FROM ' . PREFIX . '_expert_organizations as a ORDER BY id';
            $data['free_expert_organizations'] = $db->getAll($sql, 5 * 60);
        }

        $data = $this->prepareFields($action, $data);

        switch ($Authorization->data['roles_id']) {
            case ROLES_MANAGER:
            case ROLES_ADMINISTRATOR:
                $this->formDescription['fields'][ $this->getFieldPositionByName('recipient_roles_id') ]['condition'] = 'id IN(' . ROLES_MASTER . ', ' . ROLES_MANAGER . ')';
                break;
        }

        switch ($action) {
            case 'insert':
                $data = array_merge($data, Accidents::getRecipients($data['accidents_id']));
                break;
        }

        $data['statuses_id_old'] = $this->getStausesId($data['id']);
        
        switch ($data['statuses_id_old']) {
            case ACCIDENT_MESSAGE_STATUSES_QUESTION:
                if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $data['recipient_roles_id'] == ROLES_MASTER) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = array(1 => 'задача', 5 => 'погодження');
                } elseif ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $data['recipient_roles_id'] == ROLES_MANAGER) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = array(1 => 'задача', 6 => 'затвердження');
                } else {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = array(1 => 'задача', 2 => 'рішення');
                }
                if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['id'] == $data['authors_id'] || in_array($data['authors_id'], $Authorization->data['managers'])) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'][4] = 'перервано';
                }
                break;
            case ACCIDENT_MESSAGE_STATUSES_ANSWER:
                $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = array(2 => 'рішення', 3 => 'помилки');
                break;
            case ACCIDENT_MESSAGE_STATUSES_ERROR:
                if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $data['recipient_roles_id'] == ROLES_MASTER) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = array(3 => 'помилки', 5 => 'погодження');
                } else {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = array(2 => 'рішення', 3 => 'помилки');
                }
                break;
            case ACCIDENT_MESSAGE_STATUSES_COORDINATION:
				if ($Authorization->data["roles_id"] != ROLES_MASTER){
					$this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = array(5 => 'погодження', 6 => 'затвердження', 3 => 'помилки');
				}
				else {
					$this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = array(5 => 'погодження');
				}
				break;
            case ACCIDENT_MESSAGE_STATUSES_APPROVAL:
                $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = array(6 => 'затвердження', 2 => 'рішення');
                break;
            default:
                $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = array(1 => 'задача');
                break;
        }

        return parent::showForm($data, $action, $actionType, 'form.php');
    }

    function getSubjectByMessageTypesId($message_types_id) {
        global $db;

        $sql =  'SELECT title ' .
                'FROM ' . PREFIX . '_accident_message_types ' .
                'WHERE id = ' . intval($message_types_id);

        return $db->getOne($sql, 30 * 60);
    }

    function getMessageTypesIdById($id) {
        global $db, $Authorization;

        $sql = 'SELECT message_types_id ' .
               'FROM ' . PREFIX . '_accident_messages ' .
               'WHERE id = ' . intval($id);

        return $db->getOne($sql, 30 * 60);
    }

    function getRecipientOrganizationId($data) {
        switch ($data['message_types_id']) {
            case '1'://Повідомлення
                return false;
            case '2'://Запит документів у страхувальника
            case '3'://Запит документів у власника
            case '12'://Повідомити номер справи
            case '18'://Запит документів у потерпілого
            case '15'://відновлення страхової суми
                return ACCOUNT_GROUPS_CONTACT_CENTER;
                break;
            case '4'://Запит документів у вигодонабувача
            case '6'://Запит документів в ДАІ
            case '7'://Запит документів в банку
            case '10'://Отримання адміністративних матеріалів
            case '13'://Отримати завірену копію оригіналу договору КАСКО            
                return ACCOUNT_GROUPS_RECEPTIONIST;
                break;          
            case '8'://Спеціалізована експертиза
            case '9'://Виконати експертне дослідження
            case '16'://Проведення автотоварознавчого дослідження
            case '17'://Визначення вартості пошкодженого ТЗ через інтернет-аукціон Autoonline           
                return ACCOUNT_GROUPS_ESTIMATE;
                break;
            case '14'://Повернення частини страхового відшкодування
                return ACCOUNT_GROUPS_WORK_WITH_NETWORK_CORPORATION;
            case '19'://Запит до суду
            case '20'://Лист-запит документів у потерпілого
            case '21'://Лист-запит документів у страхувальника
                return ACCOUNT_GROUPS_AVERAGE;
            case '11'://Виконати експертне дослідження
                return 0;
            case '5'://Розрахунок суми відновлювального ремонту
                if (CarServices::isUkravto($data['calculation_car_services_id'])) {
                    return ACCOUNT_GROUPS_CAR_SERVICE;
                } else {
                    return ACCOUNT_GROUPS_ESTIMATE;
                }
            case ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST:
                return ACCOUNT_GROUPS_CAR_SERVICE;
                break;
        }
    }
    
    function setConstants(&$data) {
        global $db, $Authorization;  
        
        $data['answer'] = array();
        $data['question'] = array();

        parent::setConstants($data);        

        //получаем данные по полису
        $row = $this->getAdditionalData($data);

        //определяем данные получателя
        if ($data['message_types_id'] != ACCIDENT_MESSAGE_TYPES_MESSAGE) {
            $data['subject'] = $this->getSubjectByMessageTypesId($data['message_types_id']);
            $data['recipient_organizations_id'] = $this->getRecipientOrganizationId($data);
        }

        if($data['recipient_master']){
            $data['recipient_organizations_id'] = ACCOUNT_GROUPS_CAR_SERVICE;
            $data['recipient_roles_id']         = ROLES_MASTER;
        }

        //если задача ставиться независимой експертной организации, то параметры задачи устанавливаются отдельно
        switch($data['recipient_roles_id']) {
            case ROLES_EXPERT:
                $data['accidents_id']               = $row['id'];
                $data['car_services_id']            = $row['car_services_id'];
                $data['message_types_id']           = ACCIDENT_MESSAGE_TYPES_INSPECTION;
                $data['subject']                    = $this->getSubjectByMessageTypesId($data['message_types_id']);
                //if (!intval($data['expert_organizations_id'])) {
                    $data['recipient_organizations_id'] = ACCOUNT_GROUPS_ESTIMATE;
                    $data['recipient_organization']     = AccountGroups::getRecipientOrganization($data['recipient_organizations_id']);

                    //$data['recipients_id'] = 0;
                    //$data['recipient']    = '';
                    $data['recipient']                 = Users::getTitle($data['recipients_id']);
                    $this->formDescription['fields'][ $this->getFieldPositionByName('recipients_id') ]['verification']['canBeEmpty'] = true;
                    $this->formDescription['fields'][ $this->getFieldPositionByName('recipient') ]['verification']['canBeEmpty'] = true;
                /*} else {
                    $data['recipient_organizations_id'] = $data['expert_organizations_id'];
                    $data['recipient_organization']     = ExpertOrganizations::getTitle($data['expert_organizations_id']);

                    if(!$data['recipients_id']) {
                        $data['recipients_id']              = 1;
                        $data['recipient']                  = 'Не призначено';
                    }
                    else {
                         $data['recipient']                 = Users::getTitle($data['recipients_id']);
                    }
                }*/
                break;
            default:
                switch ($data['recipient_organizations_id']) {
                    case ACCOUNT_GROUPS_CAR_SERVICE://СТО
                        $data['accidents_id'] = $row['id'];
                        if (in_array($data['message_types_id'], array(ACCIDENT_MESSAGE_TYPES_CALCULATION, ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST))) {
                            $data['car_services_id']            = $data['calculation_car_services_id'];
                            $data['recipient_roles_id']         = ROLES_MASTER;
                            $data['recipient_organization']     = CarServices::getTitle($data['calculation_car_services_id']);
                            $data['curators_id'] = $row['estimate_managers_id'];
                            
                            $this->formDescription['fields'][ $this->getFieldPositionByName('recipients_id') ]['verification']['canBeEmpty'] = true;
                            $this->formDescription['fields'][ $this->getFieldPositionByName('recipient') ]['verification']['canBeEmpty'] = true;
                        } elseif (intval($data['masters_id_message'])) {
                            $data['car_services_id']            = $data['car_services_id_message'];
                            $data['recipient_roles_id']         = ROLES_MASTER;
                            $data['recipients_id']              = $data['masters_id_message'];
                            $data['recipient']                  = $data['masters_name_message'];
                            $data['recipient_organization']     = $data['car_services_title_message'];
                        } else {
                            $data['car_services_id']            = $row['car_services_id'];
                            $data['recipient_roles_id']         = ROLES_MASTER;
                            $data['recipients_id']              = $row['masters_id'];
                            $data['recipient']                  = $row['masters_lastname'] . ' ' . $row['masters_firstname'];
                            $data['recipient_organization']     = $row['car_services_title'];
                        }
                        break;
                    case ACCOUNT_GROUPS_AVERAGE://Відділ аварійних комісарів
                        $data['accidents_id']               = $row['id'];
                        $data['car_services_id']            = $row['car_services_id'];
                        $data['recipient_roles_id']         = ROLES_MANAGER;
                        $data['recipients_id']              = $row['average_managers_id'];
                        $data['recipient']                  = $row['average_managers_lastname'] . ' ' . $row['average_managers_firstname'];
                        $data['recipient_organization']     = AccountGroups::getRecipientOrganization($data['recipient_organizations_id']);
                        break;
                    case ACCOUNT_GROUPS_ESTIMATE://Відділ розрахунку вартості відновлювального ремонту
                        $data['accidents_id']               = $row['id'];
                        $data['car_services_id']            = $row['car_services_id'];
                        $data['recipient_roles_id']         = ROLES_MANAGER;

                        if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CONDUCTING_CARSCOMMODITY_RESEARCH) {
                            $data['recipient'] = Managers::getName(array('id' => $data['recipients_id']));
                        } elseif ($data['message_types_id'] != ACCIDENT_MESSAGE_TYPES_AUTOONLINE) {
                            $data['recipients_id']              = $row['estimate_managers_id'];
                            $data['recipient']                  = $row['estimate_managers_lastname'] . ' ' . $row['estimate_managers_firstname'];
                        } else {
                            $data['recipients_id'] = 0;
                            $data['recipient']  = '';
                            $this->formDescription['fields'][ $this->getFieldPositionByName('recipients_id') ]['verification']['canBeEmpty'] = true;
                            $this->formDescription['fields'][ $this->getFieldPositionByName('recipient') ]['verification']['canBeEmpty'] = true;
                        }//_dump($data);exit;
                        $data['recipient_organization']     = AccountGroups::getRecipientOrganization($data['recipient_organizations_id']);
                        break;
                    default:
                        $data['accidents_id']               = $row['id'];
                        $data['car_services_id']            = $row['car_services_id'];
                        $data['recipient_roles_id']         = ROLES_MANAGER;
                        $data['recipient_organization']     = AccountGroups::getRecipientOrganization($data['recipient_organizations_id']);
                        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_COPY_AGREEMENT){
                            $data['recipients_id'] = 7168;//Мироненко Лариса
                            $data['recipient'] = 'Мироненко Лариса';
                        }else{
                            $data['recipients_id'] = 0;
                            $data['recipient']  = '';
                        }

                        $this->formDescription['fields'][ $this->getFieldPositionByName('recipients_id') ]['verification']['canBeEmpty'] = true;
                        $this->formDescription['fields'][ $this->getFieldPositionByName('recipient') ]['verification']['canBeEmpty'] = true;
                        break;
                }
        }

        if ($data['deterioration_value'] == 0) {
            $data['fields']['answer']['deterioration_basis']['obligatory'] = false;
        }

        $this->fields = array('question');

        if ($data['do'] == $this->object . '|update') {

            if( $data['statuses_id'] != ACCIDENT_MESSAGE_STATUSES_QUESTION && in_array($data['message_types_id'], array(ACCIDENT_MESSAGE_TYPES_INSURER,ACCIDENT_MESSAGE_TYPES_BANK,ACCIDENT_MESSAGE_TYPES_DAI))) {
                if (sizeOf(unserialize($data[ 'question' ])) && is_array(unserialize($data[ 'question' ]))) {
                    $data = array_merge($data, unserialize($data[ 'question' ]));
                }
            }
            
            if (strlen($data['comment_answer'])) {
                //добавляем комментарий в мониторинг
                $sql = 'INSERT INTO ' . PREFIX . '_accident_comments ' .
                       'SET accidents_id = ' . intval($data['accidents_id']) . ', ' .
                            'authors_id = ' . intval($Authorization->data['id']) . ', ' .
                            'authors_title = ' . $db->quote($Authorization->data['lastname'] . ' ' . $Authorization->data['firstname']) . ', ' .
                            'text = ' . $db->quote('<b>' . $this->getSubjectByMessageTypesId($data['message_types_id']) . '.</b> <i>Коментарій: </i>' . $data['comment_answer']) . ', ' .
                            'monitoring_managers_yes = 0, ' .
                            'created = ' . $db->quote(date('Y-m-d H:i:s'));
                $db->query($sql);
            }

            unset($this->formDescription['fields'][ $this->getFieldPositionByName('author_roles_id') ]);
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('authors_id') ]);
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('author') ]);
            unset($this->formDescription['fields'][ $this->getFieldPositionByName('author_organization') ]);
        //проверка типа сообщений для независим. экспертных организаций (ГО)
        }elseif($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_INSPECTION) {
            $data['author_roles_id']            = $Authorization->data['roles_id'];//ROLES_MANAGER;
            $data['authors_id']                 = $Authorization->data['id'];//$row['estimate_managers_id'];
            $Users = new Users($data);
            $data['author_organization']        = $Users->getOrganization($data['authors_id']);
            $data['author']                     = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];//$row['estimate_managers_lastname'] . ' ' . $row['estimate_managers_firstname'];
        }
        else {
            //устанавливаем данные автора
            $data['author_roles_id']    = $Authorization->data['roles_id'];
            $data['authors_id']         = $Authorization->data['id'];
            $data['author']             = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];

            $Users = new Users($data);
            $data['author_organization'] = $Users->getOrganization($data['authors_id']);
        }
        
        $data['old_statuses_id'] = $this->getStausesId($data['id']);
        
        if($data['old_statuses_id'] == $data['statuses_id']) {
            $data['answer'] = $this->getAnswerValues($data['id']);
        }
        
        switch ($data['statuses_id']) {
            case ACCIDENT_MESSAGE_STATUSES_QUESTION:                                
                $this->formDescription['fields'][ $this->getFieldPositionByName('answer') ]['verification']['canBeEmpty'] = true;
                //$this->formDescription['fields'][ $this->getFieldPositionByName('answer') ]['display']['update'] = false;
                if ($data['authors_id'] != $Authorization->data['id'] && intval($data['message_types_id']) != ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT) {
                    $this->formDescription['fields'][ $this->getFieldPositionByName('question') ]['display']['update'] = false;
                }
                
                if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $data['recipient_roles_id'] == ROLES_MASTER && $Authorization->data['roles_id'] == ROLES_MASTER) {
                    $data['answer'] = $this->getAnswerValues($data['id']);
                    $data['answer']['repair_days'] = $data['repair_days'];
                    $data['answer']['repair_classifications_id'] = $data['repair_classifications_id'];
                    $data['answer']['parts_days'] = $data['parts_days'];
                    $data['answer']['parts_classifications_id'] = $data['parts_classifications_id'];
                    if (strlen($data['monitoring_comment'])) {
                        $data['answer']['monitoring'][] = array('datetime' => date('d.m.Y H:i:s'), 'author' => $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 'text' => $data['monitoring_comment']);
                    }
                    
                    $problem_parts = array();
                    foreach ($data['problem_parts'] as $problem_part) {
                        $problem_parts[] = $problem_part;
                    }
                    $data['answer']['problem_parts'] = $problem_parts;
                    $data['answer'] = serialize($data['answer']);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organization') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipients_id') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_roles_id') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organizations_id') ]);
                    $this->fields = array();
                } elseif ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $data['recipient_roles_id'] == ROLES_MANAGER && $Authorization->data['roles_id'] == ROLES_MASTER) {
                    $data['answer']['repair_classifications_id'] = $data['repair_classifications_id'];
                    if (strlen($data['monitoring_comment'])) {
                        $data['answer']['monitoring'][] = array('datetime' => date('d.m.Y H:i:s'), 'author' => $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 'text' => $data['monitoring_comment']);
                    }
                    $this->fields = array('answer');
                } elseif ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST && $data['recipient_roles_id'] == ROLES_MASTER && $Authorization->data['roles_id'] == ROLES_MASTER) {
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organization') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipients_id') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_roles_id') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organizations_id') ]);
                    $this->fields = array('answer');
                }
                
                break;
            case ACCIDENT_MESSAGE_STATUSES_ANSWER:
                if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST) {
                    if (!intval($data['confirm']) && $Authorization->data['roles_id'] == ROLES_MASTER) {
                        $data['statuses_id'] = ACCIDENT_MESSAGE_STATUSES_ERROR;
                    }
                    
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organization') ]);
                }
            
                if (!intval($data['recipients_id'])) {
                    $data['recipients_id']  = $Authorization->data['id'];
                    $data['recipient']      = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];
                }
                if (in_array($data['message_types_id'], array(ACCIDENT_MESSAGE_TYPES_INSPECTION, ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH))) {
                    $data['recipients_id']  = $Authorization->data['id'];
                    $data['recipient']      = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];
                    $data['recipient_organization']     = AccountGroups::getRecipientOrganization($data['recipient_organizations_id']);
                }
                
                if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST) {
                    $data['answer']['confirm'] = $data['confirm'];
                    
                    $problem_parts = array();
                    foreach ($data['problem_parts'] as $problem_part) {
                        $problem_parts[] = $problem_part;
                    }
                    $data['answer']['problem_parts'] = $problem_parts;
                    //$data['answer']   = serialize($data['answer']);
                }
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('question') ]);
                $this->fields = array('answer');
                break;
            case ACCIDENT_MESSAGE_STATUSES_ERROR:
                if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $data['recipient_roles_id'] == ROLES_MASTER && $data['old_statuses_id'] == ACCIDENT_MESSAGE_STATUSES_COORDINATION) {
                    $data['answer'] = $this->getAnswerValues($data['id']);
                    
                    if ($data['old_statuses_id'] != $data['statuses_id']) {
                        $author = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];
                        $change = 'Змінив статус на ' . $this->statuses[$data['statuses_id']];
                        $data['answer']['monitoring'][] = array('datetime' => date('d.m.Y H:i:s'), 'author' => $author, 'change' => $change);
                    }
                    
                    if (strlen($data['monitoring_comment'])) {
                        $data['answer']['monitoring'][] = array('datetime' => date('d.m.Y H:i:s'), 'author' => $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 'text' => $data['monitoring_comment']);
                    }
                    $data['answer'] = serialize($data['answer']);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('question') ]);
                } elseif ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $data['recipient_roles_id'] == ROLES_MASTER && $data['old_statuses_id'] == ACCIDENT_MESSAGE_STATUSES_ANSWER) {
                    $data['statuses_id'] = ACCIDENT_MESSAGE_STATUSES_COORDINATION;
                    $this->fields = array();
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('question') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('answer') ]);
                } else {            
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('question') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('answer') ]);
                    //$this->fields = array('answer', 'question');
                    $this->fields = array();
                }
                break;
            case ACCIDENT_MESSAGE_STATUSES_INTERRUPTED:
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('question') ]);
                //unset($this->formDescription['fields'][ $this->getFieldPositionByName('answer') ]);
                if ($data['old_statuses_id'] != $data['statuses_id']) {
                    $author = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];
                    $change = 'Змінив статус на ' . $this->statuses[$data['statuses_id']];
                    $data['answer']['monitoring'][] = array('datetime' => date('d.m.Y H:i:s'), 'author' => $author, 'change' => $change);
                }
                
                if (strlen($data['monitoring_comment'])) {
                    $data['answer']['monitoring'][] = array('datetime' => date('d.m.Y H:i:s'), 'author' => $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 'text' => $data['monitoring_comment']);
                }
                
                if (strlen($data['comment_answer'])) {
                    $data['answer']['comment_answer'] = $data['comment_answer'];
                }
                //$data['answer']   = serialize($data['answer']);
                $this->fields = array('answer');
                //$this->fields = array();
                break;
            case ACCIDENT_MESSAGE_STATUSES_COORDINATION:
                if (in_array($data['old_statuses_id'],  array(ACCIDENT_MESSAGE_STATUSES_QUESTION, ACCIDENT_MESSAGE_STATUSES_ERROR))) {
                    $data['answer'] = $this->getAnswerValues($data['id']);
                    $data['answer']['repair_days'] = $data['repair_days'];
                    $data['answer']['repair_classifications_id'] = $data['repair_classifications_id'];
                    $data['answer']['parts_days'] = $data['parts_days'];
                    $data['answer']['parts_classifications_id'] = $data['parts_classifications_id'];
                    if ($data['old_statuses_id'] != $data['statuses_id']) {
                        $author = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];
                        $change = 'Змінив статус на ' . $this->statuses[$data['statuses_id']];
                        $data['answer']['monitoring'][] = array('datetime' => date('d.m.Y H:i:s'), 'author' => $author, 'change' => $change);
                    }
                    
                    if (strlen($data['monitoring_comment'])) {
                        $data['answer']['monitoring'][] = array('datetime' => date('d.m.Y H:i:s'), 'author' => $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 'text' => $data['monitoring_comment']);
                    }
                    
                    $problem_parts = array();
                    foreach ($data['problem_parts'] as $problem_part) {
                        $problem_parts[] = $problem_part;
                    }
                    $data['answer']['problem_parts'] = $problem_parts;
                    $data['answer'] = serialize($data['answer']);
                    $this->fields = array();
                    $data['recipients_id']  = $Authorization->data['id'];
                    $data['recipient']      = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('question') ]);
                } else {
                    $data['answer'] = $this->getAnswerValues($data['id']);
                    $this->fields = array('answer');                    
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipients_id') ]);
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient') ]);              
                    unset($this->formDescription['fields'][ $this->getFieldPositionByName('question') ]);
                }               
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organization') ]);             
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_roles_id') ]);
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organizations_id') ]);
                break;
            case ACCIDENT_MESSAGE_STATUSES_APPROVAL:
                $data['answer'] = $this->getAnswerValues($data['id']);
                
                if ($data['old_statuses_id'] != $data['statuses_id']) {
                    $author = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];
                    $change = 'Змінив статус на ' . $this->statuses[$data['statuses_id']];
                    $data['answer']['monitoring'][] = array('datetime' => date('d.m.Y H:i:s'), 'author' => $author, 'change' => $change);
                }
                
                if (strlen($data['monitoring_comment'])) {
                    $data['answer']['monitoring'][] = array('datetime' => date('d.m.Y H:i:s'), 'author' => $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'], 'text' => $data['monitoring_comment']);
                }
                
                $this->fields = array('answer');                    
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipients_id') ]);
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient') ]);              
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('question') ]);
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organization') ]);             
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_roles_id') ]);
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organizations_id') ]);
                break;
                
        }           

        unset( $this->formDescription['fields'][ $this->getFieldPositionByName('decision') ] );

        foreach ($this->fields as $field) {

            //$data[ $field ] = array();

            if (is_array($data['fields'][ $field ]) && sizeof($data['fields'][ $field ]) > 0) {
                foreach($data['fields'][ $field ] as $name => $properties) {
                    switch ($properties['type']) {
                        case 'fldDate':
                            $data[ $field ][ $name ] = $data[ $name . '_year' ] . '-' . $data[ $name . '_month' ] . '-' . $data[ $name . '_day' ];
                            break;
                        case fldMoney:
                        case fldPercent:
                            $data[ $field ][ $name ] = str_replace(',', '.', trim($data[ $field ][ $name ]));
                            break;
                        case 'fldRadio':
                        case 'fldSelect':
                        case 'fldCheckboxes':
                        case 'fldMultipleSelect':
                            $data[ $field ][ $name ] = $data[ $name ];
                            break;
                        default:
                            if (intval($properties['number'])) {
                                $data[ $field ][$properties['alias']][$properties['number']] = htmlspecialchars($this->replaceTags(trim( $data[$properties['alias']][$properties['number']] )));
                            } else {
                                $data[ $field ][ $name ] = htmlspecialchars($this->replaceTags(trim( $data[ $name ] )));
                            }

                            break;
                    }
                }
            }

            $data[ $field ] = serialize($data[ $field ]);
        }

        $temp = unserialize($data['answer']);

        if($temp['account_request_date'] && $data['id'])
        {
            $sql = "SELECT created FROM insurance_accident_messages WHERE id = " . intval($data['id']);
            $resp = $db->getOne($sql);
            $temp['account_request_date'] = date_format(date_create($resp), "Y-m-d");
            $data['answer'] = serialize($temp);
        }
    }

    function checkFields($data, $action) {
        global $Log, $Authorization;

        parent::checkFields($data, $action);

        if ($data['statuses_id'] != ACCIDENT_MESSAGE_STATUSES_INTERRUPTED && $data['statuses_id'] != ACCIDENT_MESSAGE_STATUSES_COORDINATION && $data['statuses_id'] != ACCIDENT_MESSAGE_STATUSES_ERROR) {
        
            foreach($this->fields as $field){
                foreach ($data['fields'][ $field ] as $name => $properties) {
                    switch($properties['type']) {
                        case 'fldText':
                            if($properties['obligatory'] == 'true' && strlen($data[ $name ]) == 0){// (strlen($data[ $name ]) == 0 && (is_array($data[ $properties['alias'] ]) && strlen($data[ $properties['alias'] ][$properties['number']]) == 0))) {

                                if($name == 'audatex_code' && $data['result_calculation_car_services_tis'] == 0){
                                    break;
                                }
                                if ($properties['alias'] && strlen($data[ $properties['alias'] ][ $properties['number'] ])) {
                                    break;
                                }
                                
                                $Log->add('error', 'Required field <b>%s</b>%s is missing.', array($properties['label'] . ((intval($properties['number']) ? ' ' . $properties['number'] : '')),''));

                            }
                            break;
                        case 'fldMoney':
                        case 'fldPercent':
                            if(($properties['obligatory'] == 'true' || strlen($data[ $name ]) > 0) && !parent::isValidMoney($data[ $name ])){
                                $Log->add('error', 'Required field <b>%s</b>%s is missing.', array($properties['label'],''));
                            }
                            break;
                        case 'fldCheckboxes':
                            if($properties['obligatory'] == 'true' && (!is_array($data[ $name ]) || (sizeof($data[ $name ]) <= 0))){
                                $Log->add('error', 'Required field <b>%s</b>%s is missing.', array($properties['label'],''));
                            }
                            break;
                        case 'fldDate':
                            if ($properties['obligatory'] == 'true' && !checkdate($data[$name.'_month'], $data[$name.'_day'], $data[$name.'_year'])) {
                                $Log->add('error', 'Required field <b>%s</b>%s is missing.', array($properties['label'],''));
                            }
                            break;
                        case 'fldBoolean':
                            if ($properties['obligatory'] == 'true' && $data[$name] == NULL) {
                                $Log->add('error', 'Required field <b>%s</b>%s is missing.', array($properties['label'],''));
                            }
                            break;
                        case 'fldInteger':
                            if ($properties['obligatory'] == 'true' && !intval($data[$name])) {
                                $Log->add('error', 'Required field <b>%s</b>%s is missing.', array($properties['label'],''));
                            }
                            break;
                    }
                }
            }
        }
        
        /*if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST && in_array($data['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_ANSWER, ACCIDENT_MESSAGE_STATUSES_ERROR))) {
            //_dump($data);exit;
            if (mktime(0, 0, 0, $data['request_date_month'], $data['request_date_day'], $data['request_date_year']) > mktime(0, 0, 0, $data['answer_date_month'], $data['answer_date_day'], $data['answer_date_year'])) {
                $Log->add('error', '<b>Дата отримання ЗЧ</b> не може бути раніше <b>Дати запиту ЗЧ</b>.');
            }
        }*/
        
        //проверка на класс ремонта в калькуляции
        if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_COORDINATION && $Authorization->data['roles_id'] == ROLES_MASTER) {
            if (!intval($data['repair_days'])) {
                $Log->add('error', '<b>Встановіть кількість днів ремонту</b>');
            }
            if (!intval($data['parts_days'])) {
                $Log->add('error', '<b>Встановіть кількість днів поставки ЗЧ</b>');
            }
        }

        if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_APPROVAL && $Authorization->data['roles_id'] == ROLES_MANAGER) {
            if (!intval($data['repair_classifications_id'])) {
                $Log->add('error', '<b>Встановіть класифікацію ремонту</b>');
            }
        }

        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_COPY_AGREEMENT && $data['product_types_id'] != PRODUCT_TYPES_KASKO){
            $Log->add('error', 'Задачу <b>Отримати завірену копію оригіналу договору КАСКО</b> можна створити лише для страхових справ КАСКО');
        }
        
        if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CONDUCTING_CARSCOMMODITY_RESEARCH && in_array($data['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_QUESTION, ACCIDENT_MESSAGE_STATUSES_ANSWER)) && !sizeof($data['participant']) && $data['product_types_id'] == PRODUCT_TYPES_KASKO) {
            $Log->add('error', 'Потрібно ввести дані хоча б про одного учасника');
        }

        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_INSPECTION && $data['product_types_id'] == PRODUCT_TYPES_GO && $data['car_address'] == ''){
            $Log->add('error', 'Поле <b>Адреса</b> повинно бути заповнене.');
        }

        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_INSPECTION && $data['product_types_id'] == PRODUCT_TYPES_GO && $data['car_contact'] == ''){
            $Log->add('error', 'Поле <b>Контакт</b> повинно бути заповнене.');
        }

        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_INSPECTION && $data['product_types_id'] == PRODUCT_TYPES_GO && $data['car_phone'] == ''){
            $Log->add('error', 'Поле <b>Телефон</b> повинно бути заповнене.');
        }

        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_INSPECTION && $data['product_types_id'] == PRODUCT_TYPES_GO && intval($data['recipients_id']) == 0){
            $Log->add('error', 'Виберіть експерта в полі <b>Виконавець</b>.');
        }

        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_INSPECTION && $data['product_types_id'] == PRODUCT_TYPES_GO && intval($data['owner_types_id']) == 0){
            $Log->add('error', 'Виберіть тип особи.');
        }
        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT && $data['question'] == ''){
            $Log->add('error', 'Поле <b>Коментар</b> повинно бути заповнене.');
        }

    }

    function getAdditionalData($data) {
        global $db;

        $conditions[] = 'a.id = ' . intval($data['accidents_id']);

        $sql =  'SELECT a.id, a.car_services_id, a.accident_statuses_id, b.title AS car_services_title, ' .
                'a.masters_id, c.lastname AS masters_lastname, c.firstname AS masters_firstname, ' .
//a.managers_id,                 'd.lastname AS managers_lastname, d.firstname AS managers_firstname, ' .
                'a.average_managers_id, e.lastname AS average_managers_lastname, e.firstname AS average_managers_firstname, ' .
                'a.estimate_managers_id, f.lastname AS estimate_managers_lastname, f.firstname AS estimate_managers_firstname ' .
                'FROM ' . PREFIX . '_accidents AS a ' .
                'JOIN ' . PREFIX . '_car_services AS b ON a.car_services_id = b.id ' .
                'JOIN ' . PREFIX . '_accounts AS c ON a.masters_id = c.id ' .
                //'LEFT JOIN ' . PREFIX . '_accounts AS d ON a.managers_id = d.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS e ON a.average_managers_id = e.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS f ON a.estimate_managers_id = f.id ' .
                'WHERE ' . implode(' AND ', $conditions);
        return $db->getRow($sql);
    }

    function setView($id, $accidents_id) {
        global $db, $Authorization;

        //пишем в лог
        $sql =  'REPLACE INTO ' . PREFIX . '_accident_message_views SET ' .
                'accounts_id = ' . intval($Authorization->data['id']) . ', ' .
                'messages_id = ' . intval($id) . ', ' .
                'accidents_id = '. intval($accidents_id) . ', ' .
                'created = NOW()';
        $db->query($sql);
    }
    
    function getStausesId($id) {
        global $db;
        
        $sql = 'SELECT statuses_id ' .
               'FROM ' . PREFIX . '_accident_messages ' .
               'WHERE id = ' . intval($id);
        return intval($db->getOne($sql));
    }

    function prepareFields($action, $data) {
        global $db;

        //пишем в лог, что смотрели
        if ($action != 'insert') {
            $this->setView($data['id'], $data['accidents_id']);
        }

        $data = parent::prepareFields($action, $data);

        $data = array_merge($data, $this->getValues($data));

        $data['statuses_id'] = $this->getStausesId($data['id']);

        if ($data['question'] && !is_array($data['question'])) {            
            $question = unserialize($data['question']);
            if (sizeOf($question) && is_array($question)) $data = array_merge($data, $question);
        }
//_dump($data);exit;
        if ($data['answer'] && !is_array($data['answer'])) {
            $answer = unserialize($data['answer']);
            //_dump($answer);
            if (sizeOf($answer) && is_array($answer)) $data = array_merge($data, $answer);
        }
//_dump($data);exit;        
        if(isset($data['entry_date'])) {
            $data['entry_date_day'] = substr($data['entry_date'], 8, 2);
            $data['entry_date_month'] = substr($data['entry_date'], 5, 2);
            $data['entry_date_year'] = substr($data['entry_date'], 0, 4);
        }
        
        if(isset($data['request_date'])) {
            $data['request_date_day'] = substr($data['request_date'], 8, 2);
            $data['request_date_month'] = substr($data['request_date'], 5, 2);
            $data['request_date_year'] = substr($data['request_date'], 0, 4);
        }
        
        if(isset($data['answer_date'])) {
            $data['answer_date_day'] = substr($data['answer_date'], 8, 2);
            $data['answer_date_month'] = substr($data['answer_date'], 5, 2);
            $data['answer_date_year'] = substr($data['answer_date'], 0, 4);
        }
        
        if ($data['recipient_roles_id'] == ROLES_MASTER) {
            $sql = 'SELECT tis FROM ' . PREFIX . '_car_services WHERE id = ' . intval($data['calculation_car_services_id']);
            $data['result_calculation_car_services_tis'] = $db->getOne($sql);
        }

        return $data;
    }

    function send($id, $leader, $template = 'AccidentMessages. Insert') {
        global $db, $Templates, $Authorization;

        $sql =  'SELECT a.id, a.accidents_id, a.recipient_organizations_id, a.recipients_id, a.subject, a.message_types_id, a.curators_id, a.car_services_id, ' .
                'b.number, b.applicant_lastname, b.applicant_firstname, b.applicant_patronymicname, a.recipient_roles_id, ' .
                'c.product_types_id, d.title AS car_services_title, f.title AS accident_statuses_title, c.id as policies_id, c.number as policies_number, date_format(c.date, \'%d.%m.%Y\') as policies_date, ' .
                'masters.email AS masters_email, average_managers.email AS average_managers_email, estimate_managers.email AS estimate_managers_email, a.statuses_id, author.email as author_email, ' .
                'IF(kasko_items.shassi IS NULL, accidents_go.owner_shassi, kasko_items.shassi) as shassi, ' .
                'IF(kasko_items.sign IS NULL, accidents_go.owner_sign, kasko_items.sign) AS sign, ' .
                'IF(policies_kasko.owner_lastname IS NULL, IF(accidents_go.owner_person_types_id = 1, CONCAT_WS(\' \', accidents_go.owner_lastname, accidents_go.owner_firstname, accidents_go.owner_patronymicname), accidents_go.owner_lastname), IF(policies_kasko.owner_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.owner_lastname, policies_kasko.owner_firstname, policies_kasko.owner_patronymicname), policies_kasko.owner_lastname)) as owner ' .
                'FROM ' . $this->tables[0] . ' AS a ' .
                'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
                'JOIN ' . PREFIX . '_policies AS c ON b.policies_id = c.id ' .
                'JOIN ' . PREFIX . '_car_services AS d ON a.car_services_id = d.id ' .
                'JOIN ' . PREFIX . '_accident_statuses AS f ON b.accident_statuses_id = f.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS masters ON a.recipients_id = masters.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS average_managers ON b.average_managers_id = average_managers.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS estimate_managers ON b.estimate_managers_id = estimate_managers.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS author ON a.authors_id = author.id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON b.policies_id = policies_kasko.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_accidents_go as accidents_go ON b.id = accidents_go.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON b.policies_id = kasko_items.policies_id ' .
                'WHERE a.id = ' . intval($id);
        $row = $db->getRow($sql);

        if (intval($leader)) {//відправляємо на керівників підрозділів
            $leader_groups_id = array(ACCOUNT_GROUPS_COMPENSATION_HEAD, ACCOUNT_GROUPS_RECEPTIONIST_HEAD, ACCOUNT_GROUPS_AVERAGE_HEAD, ACCOUNT_GROUPS_ESTIMATE_HEAD);

            $sql = 'SELECT a.email ' .
                'FROM ' . PREFIX . '_accounts as a ' .
                'JOIN ' . PREFIX . '_account_groups_managers_assignments AS b ON a.id = b.accounts_id AND b.account_groups_id=' . intval($leader_groups_id[ $row['recipient_organizations_id']-1 ]) . ' ' .
                'WHERE a.active = 1';
            $recipients = $db->getAll($sql);
        }
        else {
            if (!intval($row['recipients_id'])) {//отправляем всему подразделению
                if ($row['recipient_organizations_id'] == '2' && $row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_MESSAGE){
                    $recipients[] = array('email' => 'o.gorobets@express-group.com.ua');
                    $recipients[] = array('email' => 'l.mironenko@euassist.com.ua');
                    $recipients[] = array('email' => 'n.kravec@euassist.com.ua');
                    $recipients[] = array('email' => 'y.bazichev@euassist.com.ua');
                }
                else {
                    $sql =  'SELECT email ' .
                            'FROM ' . PREFIX . '_accounts AS a '.
                            'JOIN ' . PREFIX . '_account_groups_managers_assignments AS b ON a.id = b.accounts_id ' .
                            'WHERE a.active = 1 AND b.account_groups_id = ' . intval($row['recipient_organizations_id']);
                    $recipients = $db->getAll($sql);

                    if ($row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_RETURN_PART_COMPENSATION) {
                        $template = 'AccidentMessages. ReturnPartCompensation';
                    }
                }
            } else {
                if($row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_MESSAGE && $row['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_ANSWER){
                    //$recipients[] = array('email' => 'n.suhomlinova@express-group.com.ua');
                    $recipients[] = array('email' => $row['author_email']);
                    //$recipients[] = array('email' => 'm.marchuk@express-group.com.ua');
                    $row['message_recipient'] = $Authorization->data['lastname'] .  ' ' . $Authorization->data['firstname'];
                    $template = 'AccidentMessages. Update';
                }
                else{
                    switch ($row['recipient_organizations_id']) {
                        case '-1'://СТО
                            $recipients[] = array('email' => $row['masters_email']);
                            break;
                        case '1':
                        case '2':
                            if($row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_COPY_AGREEMENT){
                                $recipients[] = array('email' => 'l.mironenko@express-group.com.ua');
                                $recipients[] = array('email' => 'y.maschenko@express-group.com.ua');
                                $recipients[] = array('email' => 'd.pivtorak@express-group.com.ua');
                                //$recipients[] = array('email' => 'm.marchuk@express-group.com.ua');
                                $template = 'AccidentMessages. CopyAgreement';
                                break;
                            }
                        case '3'://Відділ аварійних комісарів, аварійний комісар
                            $recipients[] = array('email' => $row['average_managers_email']);
                            break;
                        case '4'://Відділ експертів
                            if ($row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CONDUCTING_CARSCOMMODITY_RESEARCH) {
                                $sql =  'SELECT email ' .
                                        'FROM ' . PREFIX . '_accounts '.
                                        'WHERE id = ' . intval($row['recipients_id']);
                                $recipients = $db->getAll($sql);
                            } else {
                                $recipients[] = array('email' => $row['estimate_managers_email']);
                            }
                            break;
                    }
                }
            }
        }
        
        if ($row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST && $row['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_QUESTION) {
            $recipients = array();
            if ($row['recipient_roles_id'] == ROLES_MASTER) {
                $sql = 'SELECT email ' .
                       'FROM ' . PREFIX . '_accounts AS a '.
                       'JOIN ' . PREFIX . '_masters AS b ON a.id = b.accounts_id ' .
                       'WHERE a.active = 1 AND a.spam = 1 AND b.car_services_id = ' . intval($row['car_services_id']);
                $recipients = $db->getAll($sql);
            }
            //$recipients[] = array('email' => 'm.marchuk@express-group.com.ua');
        }
        
        if ($row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $row['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_QUESTION) {
            $recipients = array();
            if ($row['recipient_roles_id'] == ROLES_MASTER) {
                $sql = 'SELECT email ' .
                       'FROM ' . PREFIX . '_accounts AS a '.
                       'JOIN ' . PREFIX . '_masters AS b ON a.id = b.accounts_id ' .
                       'WHERE a.active = 1 AND a.spam = 1 AND b.car_services_id = ' . intval($row['car_services_id']);
                $recipients = $db->getAll($sql);
            }
            $recipients[] = array('email' => $row['estimate_managers_email']);
            //$recipients[] = array('email' => 'm.marchuk@express-group.com.ua');
        }
        
        if ($row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $row['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_COORDINATION) {
            $recipients = array();
            $recipients[] = array('email' => $row['estimate_managers_email']);
            //$recipients[] = array('email' => 'm.marchuk@express-group.com.ua');
        }
        
        if ($row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && $row['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_ERROR) {
            $recipients = array();
            if ($row['recipient_roles_id'] == ROLES_MASTER) {
                $sql = 'SELECT email ' .
                       'FROM ' . PREFIX . '_accounts AS a '.
                       'JOIN ' . PREFIX . '_masters AS b ON a.id = b.accounts_id ' .
                       'WHERE a.active = 1 AND a.spam = 1 AND b.car_services_id = ' . intval($row['car_services_id']);
                $recipients = $db->getAll($sql);
            }
            //$recipients[] = array('email' => 'm.marchuk@express-group.com.ua');
        }
        
        //Департамент сервиса (Мастера)

        $sql = "SELECT ukravto FROM insurance_car_services WHERE id = " . intval($row['car_services_id']);

        $ukravto = $db->getOne($sql);
        $ukravto = $ukravto['ukravto'];

        if (($row['message_types_id'] == 5 || $row['message_types_id'] == 22) && ($row['statuses_id'] == 1) && $ukravto == 1) {
            $sql = "SELECT email, 1 as MP " .
                   "FROM insurance_accounts as a " .
                   "JOIN insurance_account_groups_managers_assignments as b on a.id = b.accounts_id " .
                   "WHERE a.active = 1 AND a.spam = 1 AND b.account_groups_id = 27";

            if(is_array($recipients) && sizeOf($recipients))
            {
                $temp = $db->getAll($sql);
                foreach ($temp as $key => $t) {
                    $recipients[] = array('email' => $t['email'], 'MP' => 1);
                }
            } else {
                $recipients = array();
                $recipients = $db->getAll($sql);
            }
        }
        
        if (is_array($recipients) && sizeOf($recipients)) {
            foreach($recipients as $recipient) {
                if($recipient['MP'] == 1)
                    $Templates->send($recipient['email'], $row, 'AccidentMessages. MP Insert 18.11.2016', $row['subject']);
                else
                    $Templates->send($recipient['email'], $row, $template, $row['subject']);
            }
        }
    }

    function generateDocuments($accidents_id, $messages_id, $payments_calendar_id, $acts_id, $product_document_types, $data, $template=true) {
        $AccidentDocuments = new AccidentDocuments($data);
        $AccidentDocuments->generate($accidents_id, 0, $messages_id, $payments_calendar_id, $acts_id, $product_document_types, $data, $template);
    }
    
    function setStatusForCalculation($data) {
        global $db;

        $confirm = unserialize($data['answer']);
        $confirm = intval($confirm['confirm']);
        
        if($confirm === 0) {

            $conditions[] = "a.accidents_id = " . intval($data['accidents_id']);
            $conditions[] = "a.message_types_id = " . ACCIDENT_MESSAGE_TYPES_CALCULATION;
            $conditions[] = "b.id = " . intval($data['id']);
            $conditions[] = "a.created < b.created";

            $sql = "SELECT a.id FROM insurance_accident_messages a, insurance_accident_messages b WHERE " . implode(" AND ", $conditions)
                . " ORDER BY a.created DESC LIMIT 1";
            $calculation_id = intval($db->getOne($sql));

            if($calculation_id > 0) {
                $sql = "UPDATE insurance_accident_messages SET statuses_id = 1 WHERE id = " . $calculation_id;
                $db->query($sql);
            }
        }
    }

    function update($data, $redirect=true){
        global $db, $Log, $Authorization;

        if(intval($data['product_types_id']) == PRODUCT_TYPES_GO){
            $data['assistance_managers'] = $this->getAssistanceManagers();
        }

        $data['id'] = parent::update(&$data, false, true);

        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && ($data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_COORDINATION && $data['recipient_roles_id'] == ROLES_MASTER || $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_APPROVAL && $data['recipient_roles_id'] == ROLES_MANAGER)) {
            Accidents::updateRepairClassification($data);
        }       
        
        if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST && $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_ANSWER) {
            $sql = 'UPDATE ' . PREFIX . '_accidents_acts SET act_statuses_id = ' . ACCIDENT_STATUSES_APPROVAL . ' WHERE request_id = ' . intval($data['id']);
            $db->query($sql);
        
            $Accidents = new Accidents($data);
            $Accidents->changeAccidentStatus($data['accidents_id'], ACCIDENT_STATUSES_APPROVAL);

            //Исправление статуса задачи "Восстановительного ремонта", если Поставка ЗЧ не подтвердилась
            if(!$Log->isPresent())  //если нету ошибок из функции "changeAccidentStatus"
                $this->setStatusForCalculation($data);
        }

        $sql = 'SELECT id ' .
                'FROM ' . PREFIX . '_accounts as a ' .
                'JOIN ' . PREFIX . '_account_groups_managers_assignments AS b ON a.id = b.accounts_id AND b.account_groups_id=' . ACCOUNT_GROUPS_CONTACT_CENTER . ' ' .
                'WHERE a.id = ' . $data['authors_id'];
        $is_role_contact_center = $db->getOne($sql);

        if(!empty($is_role_contact_center) && $data['statuses_id'] == ACCIDENT_MESSAGE_STATUSES_ANSWER && $data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_MESSAGE){
            $this->send($data['id'], $data['leader']);
        }
        
        if (in_array($data['message_types_id'], array(ACCIDENT_MESSAGE_TYPES_CALCULATION)) && in_array($data['statuses_id'], array(ACCIDENT_MESSAGE_STATUSES_COORDINATION, ACCIDENT_MESSAGE_STATUSES_ERROR))) {
            $this->send($data['id'], $data['leader']);
        }

        $params['title']    = $this->messages['single'];
        $params['id']       = $data['id'];
        $params['storage']  = $this->tables[0];
        if ($redirect) {
            if($data['id'] > 0) {
               $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

               header('Location: ' . $data['redirect']);
               exit;
            }
        } else {
            return $data['id'];
        }
    }

    function insert($data, $redirect=true) {
        global $Log, $db;

        if(intval($data['product_types_id']) == PRODUCT_TYPES_GO){
            $data['assistance_managers'] = $this->getAssistanceManagers();
        }
        $data['id'] = parent::insert(&$data, false, true);

        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION && intval($data['id'])){
            switch($data['product_types_id']){
                case PRODUCT_TYPES_KASKO:
                    $request_types_id = DOCUMENT_TYPES_ACCIDENT_REQUEST_CALCULATION;
                    break;
                case PRODUCT_TYPES_GO:
                    $request_types_id = DOCUMENT_TYPES_ACCIDENT_REQUEST_CALCULATION_GO;
                    break;
                case PRODUCT_TYPES_PROPERTY:
                    $request_types_id = DOCUMENT_TYPES_ACCIDENT_REQUEST_CALCULATION_PROPERTY;
                    break;
                case PRODUCT_TYPES_CARGO_CERTIFICATE:
                    $request_types_id = DOCUMENT_TYPES_ACCIDENT_REQUEST_CALCULATION_CARGO;
                    break;
            }
            $this->generateDocuments($data['accidents_id'], $data['id'], null, null, $request_types_id, $data);
        }
        
        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CONDUCTING_CARSCOMMODITY_RESEARCH && intval($data['id'])){
            switch($data['product_types_id']){
                case PRODUCT_TYPES_KASKO:
                    $request_types_id = DOCUMENT_TYPES_ACCIDENT_CONDUCTING_CARSCOMMODITY_RESEARCH_KASKO;
                    break;
                case PRODUCT_TYPES_GO:
                    $request_types_id = DOCUMENT_TYPES_ACCIDENT_CONDUCTING_CARSCOMMODITY_RESEARCH_GO;
                    break;
            }
            $this->generateDocuments($data['accidents_id'], $data['id'], null, null, $request_types_id, $data);
        }

        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH && intval($data['id'])){
            switch($data['product_types_id']){
                case PRODUCT_TYPES_KASKO:
                    $request_types_id = DOCUMENT_TYPES_ACCIDENT_REQUEST_CHECK_RESEARCH_KASKO;
                    break;
                case PRODUCT_TYPES_GO:
                    $request_types_id = DOCUMENT_TYPES_ACCIDENT_REQUEST_CHECK_RESEARCH_GO;
                    break;
            }
            $this->generateDocuments($data['accidents_id'], $data['id'], null, null, $request_types_id, $data);
        }
        
        if($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_INSPECTION && intval($data['id'])){
            switch($data['product_types_id']){
                case PRODUCT_TYPES_KASKO:
                    $request_types_id = DOCUMENT_TYPES_ACCIDENT_INSPECTION_CAR_KASKO;
                    break;
                case PRODUCT_TYPES_GO:
                    $request_types_id = DOCUMENT_TYPES_ACCIDENT_INSPECTION_CAR_GO;
                    break;
            }
            $this->generateDocuments($data['accidents_id'], $data['id'], null, null, $request_types_id, $data);
        }
        
        if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_REQUEST_VICTIM && intval($data['id']) && $data['product_types_id'] == PRODUCT_TYPES_GO) {
            $this->generateDocuments($data['accidents_id'], $data['id'], null, null, DOCUMENT_TYPES_ACCIDENT_REQUEST_VICTIM, $data, false);
        }
        
        if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_REQUEST_LETTER_INSURER_KASKO && intval($data['id']) && $data['product_types_id'] == PRODUCT_TYPES_KASKO) {
            $this->generateDocuments($data['accidents_id'], $data['id'], null, null, DOCUMENT_TYPES_ACCIDENT_REQUEST_LETTER_INSURER_KASKO, $data, false);
        }
        
        if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_AUTOONLINE && intval($data['id'])) {
            $this->generateDocuments($data['accidents_id'], $data['id'], null, null, DOCUMENT_TYPES_ACCIDENT_AUTOONLINE, $data);
        }
        
        if ($data['message_types_id'] == ACCIDENT_MESSAGE_TYPES_REQUEST_COURT && intval($data['id'])) {
            $this->generateDocuments($data['accidents_id'], $data['id'], null, null, DOCUMENT_TYPES_ACCIDENT_REQUEST_COURT, $data);
        }

        //отправляем мылом задачу, только по персональному назначению, или если задача - "повідомлення"
        if($data['recipients_id'] || !empty($data['recipients_id']) || in_array($data['message_types_id'], array(ACCIDENT_MESSAGE_TYPES_MESSAGE, ACCIDENT_MESSAGE_TYPES_OWNER, ACCIDENT_MESSAGE_TYPES_INSURER, ACCIDENT_MESSAGE_TYPES_RETURN_PART_COMPENSATION, ACCIDENT_MESSAGE_TYPES_CALCULATION, ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST))){
            $this->send($data['id'], $data['leader']);
        }

        //обновляем время модификации
        Accidents::updateModified($data['accidents_id']);

        $params['title']    = $this->messages['single'];
        $params['id']       = $data['id'];
        $params['storage']  = $this->tables[0];

        if ($redirect) {
            if($data['id'] > 0) {
               $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

               header('Location: ' . $data['redirect']);
               exit;
            }
        } else {            
            return $data['id'];
        }

    }

    function view($data) {
        global $db, $Authorization;

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->formDescription['fields'][ $this->getFieldPositionByName('author')]['type']      = fldText;
        $this->formDescription['fields'][ $this->getFieldPositionByName('recipient')]['type']   = fldText;

        //таблицы в запросе по продукту
        $suffix = $this->getSuffix($data);

        //определяем поля в запросе
        switch($data['product_types_id']) {
            case PRODUCT_TYPES_KASKO:
                break;
            case PRODUCT_TYPES_GO:
                $additional_fields[] = 'c.expert_organizations_id,';
                break;
        }

        $sql =  'SELECT a.*, b.repair_classifications_id, b.masters_id, ' .
                'date_format(a.phone_date, '. $db->quote(DATE_FORMAT) . ') AS phone_date_format, date_format(a.phone_date, \'%Y\') AS phone_date_year, date_format(a.phone_date, \'%m\') AS phone_date_month, date_format(a.phone_date, \'%d\') AS phone_date_day, ' .
                implode(', ', $additional_fields) .
                'd.product_types_id, e.lastname as average_lastname, e.firstname as average_firstname, f.lastname as estimate_lastname, f.firstname as estimate_firstname ' .
                'FROM ' . PREFIX . '_accident_messages as a ' .
                'JOIN ' . PREFIX . '_accidents AS b ON a.accidents_id = b.id ' .
                'JOIN ' . PREFIX . '_accidents_' . $suffix[0] . ' AS c ON a.accidents_id = c.accidents_id ' .
                'JOIN ' . PREFIX . '_policies AS d ON b.policies_id = d.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS e ON e.id = b.average_managers_id ' .
                'LEFT JOIN ' . PREFIX . '_accounts AS f ON f.id = b.estimate_managers_id ' .
                'WHERE a.id=' . intval($data['id']);

        return parent::view($data, null, $sql, null, true);
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db;

        $AccidentDocuments = new AccidentDocuments($data);
        $AccidentDocuments->permissions['delete'] = true;

        $sql =  'SELECT id ' .
                'FROM ' . $AccidentDocuments->tables[0] . ' ' .
                'WHERE messages_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        $AccidentDocuments->delete($toDelete, false, false);

        return parent::deleteProcess($data, $i, $folder);
    }

    function getAnswerValues($id) {
        global $db;

        $sql =  'SELECT answer ' .
                'FROM ' . PREFIX . '_accident_messages ' .
                'WHERE id = ' .  intval($id);
        $answer = $db->getOne($sql);

        return unserialize($answer);
    }

    function setStatusByAccidentStatusesId($accidents_id, $accident_statuses_id){
        global $db;

        $message_types_id = array(
            ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT,
            ACCIDENT_MESSAGE_TYPES_DAI,
            ACCIDENT_MESSAGE_TYPES_OWNER,
            ACCIDENT_MESSAGE_TYPES_INSURER,
            ACCIDENT_MESSAGE_GET_ADMINISTRATION_MATERIALS,
            ACCIDENT_MESSAGE_TYPES_COPY_AGREEMENT,
            ACCIDENT_MESSAGE_TYPES_CHECK_RESEARCH,
            ACCIDENT_MESSAGE_TYPES_RETURN_PART_COMPENSATION,
            ACCIDENT_MESSAGE_TYPES_MESSAGE,
            ACCIDENT_MESSAGE_TYPES_CONDUCTING_CARSCOMMODITY_RESEARCH
        );
        
        switch($accident_statuses_id){
            case ACCIDENT_STATUSES_APPROVAL:
            case ACCIDENT_STATUSES_CLOSED:
            case ACCIDENT_STATUSES_SUSPENDED:
                $sql = 'UPDATE ' . PREFIX . '_accident_messages SET ' .
                       'statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_INTERRUPTED . ' ' .
                       //'WHERE accidents_id = ' . $accidents_id . ' AND statuses_id <> ' . ACCIDENT_MESSAGE_STATUSES_ANSWER . ' AND message_types_id NOT IN(' . ACCIDENT_MESSAGE_TYPES_MESSAGE . ', ' . ACCIDENT_MESSAGE_TYPES_INSURER . ', ' . ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT . ')';
                       'WHERE accidents_id = ' . $accidents_id . ' AND statuses_id <> ' . ACCIDENT_MESSAGE_STATUSES_ANSWER . ' AND message_types_id NOT IN(' . implode(', ', $message_types_id) . ')';
                $db->query($sql);
            break;
        }
    }

    function getAccidentActsCoeffs($accidents_id, $suffix){
        global $db;

        if ($suffix == 'go' || $suffix == 'kasko') {

            $sql = 'SELECT a.market_price as previous_acts_market_price, a.deterioration_value as previous_acts_deterioration_value, a.accidents_acts_id as previous_acts_id ' .
                   'FROM ' . PREFIX . '_accidents_' . $suffix . '_acts AS a ' .
                   'JOIN ' . PREFIX . '_accidents_acts AS b ON a.accidents_acts_id = b.id ' .
                   'WHERE b.accidents_id = ' . intval($accidents_id) . ' ' .
                   'HAVING a.accidents_acts_id = MAX(b.id)';
            return $db->getRow($sql);
        } else {
            return null;
        }

        
    }

    function getAccidentsEstimatesMessagesInWork($estimate_managers_id){
        global $db;

        $accidents = $db->getCol('SELECT accidents.id ' .
                                 'FROM ' . PREFIX . '_accidents as accidents ' .
                                 'JOIN ' . PREFIX . '_accident_messages as messages ON accidents.id = messages.accidents_id ' .
                                 'WHERE accidents.estimate_managers_id = ' . intval($estimate_managers_id) . ' AND messages.statuses_id NOT IN(2) AND messages.message_types_id = ' . ACCIDENT_MESSAGE_TYPES_CALCULATION . ' ' .
                                 'GROUP BY accidents.id');

        if (is_array($accidents) && sizeof($accidents)) {
            return $accidents;
        } else {
            return null;
        }
    }

    function requestInWindow($data){
        global $db, $Log;

        $terms = array(1 => 3, 2 => 5, 3 => 8, 4 => 15);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $data['redirect'] = (intval($data['is_accidents']) ? $_SERVER['HTTP_REFERER'] : 'index.php?do=Accidents|show&product_types_id=' . $data['product_types_id']);

        if (!in_array($this->getMessageTypesIdById($data['id']), array(ACCIDENT_MESSAGE_TYPES_CALCULATION, ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST))) {
            $Log->add('error', 'Сформувати запит можна для задач <strong>Розрахунок суми відновлювального ремонту, Підтвердження термінів поставки ЗЧ</strong>');
            header('Location: ' . $data['redirect']);
            exit;
        }

        $conditions[] = 'accident_messages.id = ' . intval($data['id']);

        $sql = 'SELECT accident_messages.curators_id, IF(policies_kasko.insurer_person_types_id = 1, CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname), policies_kasko.insurer_company) as insurer, ' .
                       'CONCAT_WS(\' \', kasko_items.brand, kasko_items.model) as item, kasko_items.sign, kasko_items.shassi, kasko_items.year, date_format(ADDDATE(NOW(), INTERVAL repair_classifications.term + 2 DAY), \'%d.%m.%Y\') as date, date_format(NOW(), \'%d.%m.%Y %H:%i\') as date_now, ' .
                       'accident_messages.answer, accident_messages.question, accident_messages.statuses_id, accidents.estimate_managers_id, accidents.average_managers_id, accident_messages.recipients_id, accidents.repair_classifications_id, accidents.car_services_id, accidents.number, ' .
                       'accident_messages.message_types_id, accident_messages.id as accident_messages_id ' .
               'FROM ' . PREFIX . '_accident_messages as accident_messages ' .
               'JOIN ' . PREFIX . '_accidents as accidents ON accident_messages.accidents_id = accidents.id ' .
               'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
               'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
               'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents_kasko.items_id = kasko_items.id ' .
               'LEFT JOIN ' . PREFIX . '_repair_classifications as repair_classifications ON accidents.repair_classifications_id = repair_classifications.id ' .
               'WHERE ' . implode(' AND ', $conditions);
        $row = $db->getRow($sql);

        if (!$this->checkRequestPermissions($row)) {
            $Log->add('error', 'У вас недостатньо повноважень для формування запиту');
            header('Location: ' . $data['redirect']);
            exit;
        }

        $row['answer'] = unserialize($row['answer']);
        $row['question'] = unserialize($row['question']);

        $row['car_services_title'] = intval($row['question']['calculation_car_services_id']) ?
                CarServices::getTitle($row['question']['calculation_car_services_id']) :
                CarServices::getTitle($row['car_services_id']);

        if (!sizeof($row) || !intval($row['repair_classifications_id']) && $row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CALCULATION) {
            $Log->add('error', 'Для формування запиту недостатньо даних');
            header('Location: ' . $data['redirect']);
            exit;
        }
        
        if ($row['message_types_id'] == ACCIDENT_MESSAGE_TYPES_CAR_SERVICES_REQUEST) {
            $sql = 'SELECT accident_messages.question, accident_messages.answer ' .
                   'FROM ' . PREFIX . '_accident_messages as accident_messages ' .
                   'JOIN ' . PREFIX . '_accidents_acts as acts ON accident_messages.id = acts.accident_messages_id ' .
                   'WHERE acts.request_id = ' . intval($row['accident_messages_id']);
            $mess_calc = $db->getRow($sql);
            $question_calc = unserialize($mess_calc['question']);
            $answer_calc = unserialize($mess_calc['answer']);
            //_dump($mess_calc);exit;
            $row['car_services_title'] = intval($answer_calc['result_calculation_car_services_id']) ?
                CarServices::getTitle($answer_calc['result_calculation_car_services_id']) :
                CarServices::getTitle($question_calc['calculation_car_services_id']);
        }

        $row['days'] = $terms[$row['repair_classifications_id']] + 2;

        header('Content-Disposition: attachment; filename="document.xls"');
        header('Content-Type: ' . Form::getContentType('document.xls'));
        include_once $this->object . '/requestExcel.php';
    }

    function checkRequestPermissions($data) {
        global $Authorization;

        if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR) {
            return true;
        }

        if ($Authorization->data['roles_id'] == ROLES_MANAGER && ($Authorization->data['id'] == $data['curators_id'] || $Authorization->data['id'] == $data['recipients_id'] || in_array($data['recipients_id'], $Authorization->data['managers']) || in_array($data['curators_id'], $Authorization->data['managers']))) {
            return true;
        }

        if ($Authorization->data['roles_id'] == ROLES_MANAGER && (in_array(ACCOUNT_GROUPS_AVERAGE, $Authorization->data['account_groups_id']) || in_array(ACCOUNT_GROUPS_AVERAGE_HEAD, $Authorization->data['account_groups_id'])) && $Authorization->data['id'] == $data['recipients_id']) {
            return true;
        }
        
        if ($Authorization->data['roles_id'] == ROLES_MASTER && $Authorization->data['id'] == $data['recipients_id']) {
            return true;
        }

        return false;
    }

    function getLastBeginDatePayedRecoveryInsuredSum($accidents_id){
        global $db;

        return $db->getOne('SELECT MAX(begin_datetime) '.
                'FROM ' . PREFIX . '_policies ' .
               'WHERE top = ' . intval(AccidentMessages::getTopPolicy($accidents_id)) . ' ' .
                      'and payment_statuses_id <> ' . PAYMENT_STATUSES_NOT . ' and agreement_types_id = 3');
    }
    function getTopPolicy($accidents_id){
        global $db;

        return $db->getOne('SELECT policies.top '.
                'FROM ' . PREFIX . '_accidents as accidents ' .
                'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
                'WHERE accidents.id = ' . intval($accidents_id));
    }

    function getSumActs($accidents_id, $date, $end_period){
        global $db;

         return $db->getOne('SELECT sum(accident_payments.amount) ' .
                'FROM ' . PREFIX . '_policies as policies ' .
                'LEFT JOIN ' . PREFIX . '_accidents as accidents ON policies.id = accidents.policies_id  ' .
                'LEFT JOIN ' . PREFIX . '_accident_payments_calendar as calendar ON accidents.id = calendar.accidents_id ' .
                'LEFT JOIN ' . PREFIX . '_accident_payments as accident_payments ON accidents.id = accident_payments.accidents_id and calendar.id = accident_payments.payments_calendar_id ' .
                'WHERE calendar.payment_types_id IN (' . PAYMENT_TYPES_COMPENSATION . ', ' . PAYMENT_TYPES_PART_PREMIUM . ') and accident_payments.is_return <> 1 ' .
                           'and accident_payments.date between date_format(' . $db->quote($date) . ', \'%Y.%m.%d\') and  date_format(' . $db->quote($end_period) . ', \'%Y.%m.%d\') ' .
                           'and policies.top = ' . intval(AccidentMessages::getTopPolicy($accidents_id)));_dump($sql);exit;
    }
    
    function generateAdditionalAgreement($accidents_id){
        global $db, $Log;

        $sql = 'SELECT id FROM ' .PREFIX . '_accident_messages WHERE accidents_id = ' . $accidents_id . ' AND message_types_id = ' . ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT . ' AND statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_QUESTION;
        $is_tasks = $db->getOne($sql);

        if(empty($is_tasks)){
            $sql = 'SELECT  policies.id as policies_id, policies_kasko.terms_years_id, accidents.id as accidents_id,  policies_kasko.options_agregate_no AS policies_options_agregate_no, date_format(accidents.datetime, \'%d.%m.%Y\') as datetime, ' .
                    'IF(policies_kasko.terms_years_id = 1, kasko_items.car_price + kasko_items.price_equipment, years_payments.item_price) AS policies_price,  ' .
                    'IF(policies_kasko.terms_years_id = 1, date_format(policies.interrupt_datetime, \'%d.%m.%Y\'),  date_format(MAX(years_payments.date) + INTERVAL 1 YEAR - INTERVAL 1 DAY, \'%d.%m.%Y\')) as interrupt_datetime, ' .
                    'date_format(years_payments.date, \'%d.%m.%Y\') as payment_date, isAccidentsTotal(' . $accidents_id . ') as is_total, SUM(accidents_acts.amount) as accidents_amount ' .
                    'FROM ' . PREFIX . '_accidents as accidents ' .
                    'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.id ' .
                    'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON accidents.policies_id = kasko_items.policies_id ' .
                    'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accidents.id = accidents_kasko.accidents_id ' .
                    'JOIN ' . PREFIX . '_accidents_acts AS accidents_acts ON accidents.id = accidents_acts.accidents_id ' .
                    'LEFT JOIN ' . PREFIX . '_policies_kasko_item_years_payments as years_payments ON policies.id = years_payments.policies_id AND accidents_kasko.items_id = years_payments.items_id AND accidents.datetime between years_payments.date AND (years_payments.date + INTERVAL 1 YEAR) ' .
                    'WHERE accidents.id = ' . intval($accidents_id) .
                    ' GROUP BY policies.id ' .
                    'ORDER BY  years_payments.date desc';
            $list = $db->getRow($sql);
            $previous_begin_date = AccidentMessages::getLastBeginDatePayedRecoveryInsuredSum($accidents_id);
            $end_data = $list['interrupt_datetime'];

            if(strtotime($list['payment_date']) < strtotime($previous_begin_date)){
                $amount_previous_acts = AccidentMessages::getSumActs($accidents_id, $previous_begin_date, $end_data);
            }else{
                $Accidents = Accidents::factory($data, 'KASKO');
                $amount_previous_acts = $Accidents->getAmountPrevious($accidents_id, 1) + $list['accidents_amount'];
            }

            switch(intval($list['terms_years_id'])){
                case '1':
                    $in_period = true;
                    break;
                default:
                    $in_period = strtotime($list['datetime']) >= strtotime($list['payment_date']) &&
                                 strtotime($end_data) >= strtotime(date('d.m.Y'))  && strtotime(date('d.m.Y')) <= strtotime($end_data);
                    break;
            }
            $losing = ($list['policies_options_agregate_no'] == 1) ? $list['policies_price']/$list['policies_price'] : ($list['policies_price'] - $amount_previous_acts)/$list['policies_price'];
        }
/*            _dump(strtotime(date('d.m.Y')) <= strtotime($end_data)-(45*(24*60*60)));
            _dump($end_data);
            _dump($in_period);
            _dump($list['is_total'] == 0);

            exit;*/
        if(is_array($list) && $losing <= 0.95 && strtotime(date('d.m.Y')) <= strtotime($end_data)-(45*(24*60*60)) && $in_period && $list['is_total'] == 0){
            $sql = 'INSERT INTO ' . PREFIX . '_accident_messages ' .
                   'SET accidents_id = ' . intval($accidents_id) . ', ' .
                        'recipient_roles_id = 2, ' .
                        'recipient_organizations_id   = 17, ' .
                        'recipient_organization   = \'Контакт-центр\', ' .
                        'message_types_id = ' . ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT. ', ' .
                        'subject = \'Відновлення страхової суми\', ' .
                        'statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_QUESTION . ', ' .
                        'created = NOW(), modified = NOW()';
            $db->query($sql);
        }
    }

    function closeAdditionalAgreement($messages_id){
        global $db, $Authorization;

        $sql = 'UPDATE ' . PREFIX . '_accident_messages ' .
           'SET authors_id = ' . $Authorization->data['id'] . ', author = \'' . $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'] . '\', ' .
               'statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_ANSWER . ', modified = NOW(), decision = NOW() ' .
           'WHERE id =' . intval($messages_id) . ' ';
        $db->query($sql);   
    }

    function isTaskExist($policies_id){
        global $db;

        $sql = 'SELECT id ' .
                'FROM ' . PREFIX . '_accident_messages ' .
                'WHERE answer = ' . intval($policies_id) . ' AND message_types_id = ' . ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT . ' AND statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_QUESTION;
        $message_id = $db->getOne($sql);

        if(!empty($message_id)){
            $this->closeAdditionalAgreement($message_id);
        }
        else
            return 0;
    }

    function isAnotherRecoveryInWindow($data){
        global $db;

        $sql = 'SELECT policies.id as policies_id ' .
        'FROM ' . PREFIX . '_policies as policies ' .
        'JOIN ' . PREFIX . '_accidents as accidents ON policies.parent_id = accidents.policies_id ' .
        'LEFT JOIN ' . PREFIX . '_accident_messages as accident_messages ON accidents.id = accident_messages.accidents_id ' .
        'WHERE accident_messages.id = ' . intval($data['id']) . ' AND policies.agreement_types_id = 3';

        $is_policies_id = $db->getOne($sql);

        if (empty($is_policies_id))
        {
            echo '{"exist":"1"}';
        }
        else
            echo '{"exist":"По цій задачі вже була створена додаткова угода на відновлення страхової суми"}';

        exit;
    }

    function changeParentId($polices_id, $parent_id){
        global $db;

        $sql = 'SELECT child_id FROM ' . PREFIX . '_policies WHERE id =' . $parent_id;
        $child_id = $db->getOne($sql);

        if(!empty($child_id)){
            $sql = 'SELECT date_format(begin_datetime, \'%Y-%m-%d\') as begin_datetime FROM ' . PREFIX . '_policies WHERE id =' . intval($child_id);
            $child_begin_datetime = $db->getOne($sql);

            //допка, що формується
            $sql = 'UPDATE ' . PREFIX . '_policies ' .
               'SET child_id = ' . intval($child_id) . ', parent_id = ' . intval($parent_id) . ', interrupt_datetime =  ' . date('Y-m-d', strtotime('- 1 day', strtotime($child_begin_datetime))) . ' ' .
               ' WHERE id =' . intval($polices_id) . ' ';
            $db->query($sql);
            //наступна доп
            $sql = 'UPDATE ' . PREFIX . '_policies ' .
               'SET parent_id = ' . intval($polices_id) . ' ' .
               'WHERE id =' . intval($child_id) . ' ';
            $db->query($sql);
            //попередня доп
            $sql = 'UPDATE ' . PREFIX . '_policies ' .
               'SET child_id = ' . intval($polices_id) . ', interrupt_datetime = NOW() ' .
               'WHERE id =' . intval($parent_id) . ' ';
            $db->query($sql);

        }
    }

    function exportRecoveryRisk($data, $excel=false){
        global $db, $Log;

        if(isset($data['recovery_risk']) && !checkdate(substr($data['from'],3 ,2), substr($data['from'], 0, 2), substr($data['from'], 6,4))){
            $Log->add('error', 'Дата <b>\'З\'</b> введена не правильно');
        }

        if(isset($data['recovery_risk']) && !checkdate(substr($data['to'],3 ,2), substr($data['to'], 0, 2), substr($data['to'], 6,4))){
            $Log->add('error', 'Дата <b>\'По\'</b> введена не правильно');
        }

        if(!$Log->isPresent()){
            $conditions = array();
            $conditions[] = 'accident_messages.decision between \'' . date('Y.m.d 00:00:00', strtotime($data['from'])) . '\' AND \'' . date('Y.m.d 23:59:59', strtotime($data['to'])) . '\'';
            $conditions[] = 'accident_messages.statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_ANSWER;
            $conditions[] = 'accident_messages.message_types_id = ' . ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT;

            $sql = 'SELECT policies.parent_id, policies.number, ' .
                        'IF(insurer_person_types_id = 1, CONCAT(insurer_lastname, \' \', insurer_firstname, \' \', insurer_patronymicname), insurer_company) as owner, ' .
                        'CONCAT(regions.title, IF(insurer_area, CONCAT(insurer_area, \', \'), \'\, \'), insurer_city, \', \', street_types.title, \' \', insurer_street, \', буд. \', insurer_house, \', кв. \', insurer_flat) as address ' .
                    'FROM ' . PREFIX . '_accident_messages as accident_messages ' .
                    'JOIN ' . PREFIX . '_accidents as accidents ON accident_messages.accidents_id = accidents.id ' .
                    'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.parent_id ' .
                    'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
                    'JOIN ' . PREFIX . '_regions AS regions ON policies_kasko.insurer_regions_id=regions.id ' .
                    'JOIN ' . PREFIX . '_street_types AS street_types ON policies_kasko.insurer_street_types_id=street_types.id ' .
                    'WHERE ' . implode(' AND ', $conditions);
            $information = $db->getAll($sql);
        }

        if ($excel) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/exportRecoveryRiskExcel.php';
            exit;
        } else {
            include_once $this->object . '/exportRecoveryRisk.php';
            exit;
        }
    }

    function exportRecoveryRiskInWindow($data){
        $this->exportRecoveryRisk($data, true);
    }
    
    function setRecipientsIdAfterClassification($data) {
        global $db;
        
        $sql = 'UPDATE ' . PREFIX . '_accident_messages ' .
               'SET recipients_id = ' . intval($data['average_managers_id']) . ', recipient = ' . $db->quote(Users::getTitle($data['average_managers_id'])) . ' ' .
               'WHERE recipients_id = 0 AND message_types_id = ' . ACCIDENT_MESSAGE_TYPES_MESSAGE . ' AND accidents_id = ' . intval($data['id']) . ' AND recipient_organizations_id = ' . ACCOUNT_GROUPS_AVERAGE;
        $db->query($sql);
        
        $sql = 'UPDATE ' . PREFIX . '_accident_messages ' .
               'SET recipients_id = ' . intval($data['estimate_managers_id']) . ', recipient = ' . $db->quote(Users::getTitle($data['estimate_managers_id'])) . ' ' .
               'WHERE recipients_id = 0 AND message_types_id = ' . ACCIDENT_MESSAGE_TYPES_MESSAGE . ' AND accidents_id = ' . intval($data['id']) . ' AND recipient_organizations_id = ' . ACCOUNT_GROUPS_ESTIMATE;
        $db->query($sql);
    }
    
    function getMessagesDuration($data) {
        global $db;
        
        $sql = 'SELECT UNIX_TIMESTAMP(created) as begin, UNIX_TIMESTAMP(decision) as end ' .
               'FROM ' . PREFIX . '_accident_messages ' .
               'WHERE id IN (' . $data['list'] . ') ' .
               'ORDER BY created ASC';          
        $periods = $db->getAll($sql);
        
        $true_lines = array();

        foreach ($periods as $period) {
            if (sizeof($true_lines) == 0) {
                $true_lines[] = $period;
                continue;
            }
    
            $begin = $true_lines[sizeof($true_lines)-1]['begin'];
            $end = $true_lines[sizeof($true_lines)-1]['end'];
        
            if ($period['begin'] <= $end && $period['end'] > $end) {
                $true_lines[sizeof($true_lines)-1]['end'] = $period['end'];
            } elseif ($period['begin'] > $end) {
                $true_lines[] = $period;
            }
    
        }
        $total = 0;
        foreach ($true_lines as $true_line) {
            $total += ($true_line['end'] - $true_line['begin']);
        }
        
        return $total;
    }

    function getAutoInformationInWindow($data){
        global $db;

        $sql = 'SELECT i.owner_brand, i.owner_model, i.owner_sign, c.brand as insurer_brand, c.model as insurer_model, c.sign as insurer_sign ' .
                   'FROM ' . PREFIX . '_accidents as a ' .
                   'JOIN ' . PREFIX . '_policies as b ON a.policies_id = b.id ' .
                   'JOIN ' . PREFIX . '_policies_go as c ON b.id = c.policies_id ' .
                   'JOIN ' . PREFIX . '_accidents_go as i ON a.id = i.accidents_id ' .
                   'WHERE a.id = ' . intval($data['accidents_id']);
        $list = $db->getRow($sql);

        $result = '{"owner_brand":"' . $list['owner_brand'] . '",' .
                        '"owner_model":"' . $list['owner_model'] . '",' .
                        '"owner_sign":"' . $list['owner_sign'] . '",' .
                        '"insurer_brand":"' . $list['insurer_brand'] . '",' .
                        '"insurer_model":"' . $list['insurer_model'] . '",' .
                        '"insurer_sign":"' . $list['insurer_sign'] . '"}';
        echo $result;
        exit;
    }

    function addPoliciesId($id){
        global $db;

        $messages_id = $db->getOne('SELECT messages.id ' .
                'FROM ' . PREFIX . '_accident_messages as messages ' .
                'JOIN ' . PREFIX . '_accidents as accidents ON messages.accidents_id = accidents.id ' .
                'JOIN ' . PREFIX . '_policies as policies ON accidents.policies_id = policies.parent_id ' .
                'WHERE policies.id = ' . intval($id) . ' and messages.message_types_id = ' . ACCIDENT_MESSAGE_TYPES_CREATE_ADDITIONAL_AGREEMENT . ' and messages.statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_QUESTION);

        if(!empty($messages_id)){
            $sql = 'UPDATE ' . PREFIX . '_accident_messages ' .
            'SET answer = \'' . $id . '\', modified = NOW() ' .
            'WHERE id =' . intval($messages_id) . ' ';
            $db->query($sql);
        }
    }
    
    function approvalTaskIdInWindow($data) {
        global $db;
        
        if (is_array($data['id']) && sizeOf($data['id'])) {
            $sql = 'UPDATE ' . PREFIX . '_accident_messages SET statuses_id = 2 WHERE statuses_id = ' . ACCIDENT_MESSAGE_STATUSES_APPROVAL .  ' AND message_types_id = ' . ACCIDENT_MESSAGE_TYPES_CALCULATION . ' AND id IN (' . implode(', ', $data['id']) . ')';
            $db->query($sql);
        }
    }
    
    function getMonitoringInWindow($data) {
        global $db;
        
        $sql = 'SELECT answer FROM ' . PREFIX . '_accident_messages WHERE id = ' . intval($data['id']);
        $answer = unserialize($db->getOne($sql));
        
        //_dump($answer);
        $result = '<table>';
        
        foreach($answer['monitoring'] as $line) {
            $result .= '<tr>';
            $result .= '<td>' . $line['datetime'] . '</td>';
            $result .= '<td>' . $line['author'] . '</td>';
            if (isset($line['change'])) $result .= '<td>' . $line['change'] . '</td>';
            if (isset($line['text'])) $result .= '<td>' . $line['text'] . '</td>';
            $result .= '</tr>';
        }
        
        $result .= '</table>';
        
        echo $result;
        exit;
    }

}

?>