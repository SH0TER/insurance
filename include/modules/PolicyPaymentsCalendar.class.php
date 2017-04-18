<?
/*
 * Title: PolicyPaymentsCalendar class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';
require_once 'ProductTypes.class.php';
require_once 'PolicyPayments.class.php';

class PolicyPaymentsCalendar extends Form {

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
                            'table'                 => 'policy_payments_calendar'),
                        array(
                            'name'                  => 'policies_id',
                            'description'           => 'Поліс',
                            'type'                  => fldHidden,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'policy_payments_calendar'),
                        array(
                            'name'                  => 'item_years_payments_id',
                            'description'           => 'Параметри',
                            'type'                  => fldHidden,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'policy_payments_calendar'), 
                        array(
                            'name'                  => 'date',
                            'description'           => 'Дата cплати',
                            'description'           => 'Дата cплати',
                            'type'                  => fldDate,
                            'input'                 => true,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 1,
                            'table'                 => 'policy_payments_calendar'),
                        array(
                            'name'                  => 'amount',
                            'description'           => 'Сума, грн.',
                            'type'                  => fldMoney,
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
                            'table'                 => 'policy_payments_calendar'),
                        array(
                            'name'                  => 'file',
                            'description'           => 'Рахунок',
                            'type'                  => fldFile,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => false,
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 3,
                            'table'                 => 'policy_payments_calendar'),
                        array(
                            'name'                  => 'statuses_id',
                            'description'           => 'Статус',
                            'type'                  => fldSelect,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 5,
                            'table'                 => 'policy_payments_calendar',
                            'sourceTable'           => 'payment_statuses',
                            'selectField'           => 'title',
                            'orderField'            => 'order_position'),
                        array(
                            'name'                  => 'payment_date',
                            'description'           => 'Дата отримання коштів',
                            'type'                  => fldDateTime,
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
                            'orderPosition'         => 6,
                            'table'                 => 'policy_payments_calendar'),
                        array(
                            'name'                  => 'created',
                            'description'           => 'Створено',
                            'type'                  => fldDate,
                            'value'                 => 'NOW()',
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => false,
                                    'view'          => false,
                                    'update'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 7,
                            'width'                 => 100,
                            'table'                 => 'policy_payments_calendar'),

                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'      => 1,
                        'defaultOrderDirection'     => 'asc',
                        'titleField'                => 'id'
                    )
            );

    function PolicyPaymentsCalendar($data) {
        global $PAYMENT_STATUSES;

        Form::Form($data);

        $this->messages['plural'] = 'Календар сплат';
        $this->messages['single'] = 'Календар сплат';

        $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ]['list'] = $PAYMENT_STATUSES;
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
            case ROLES_CLIENT_CONTACT:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => false,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => false);

                    
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => true,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => false,
                    'export'    => true,
                    'createTask'=> true);
                    
                if ($data['product_types_id'] == PRODUCT_TYPES_TRANSPORTER || PRODUCT_TYPES_GO ||
                    $data['product_types_id'] == PRODUCT_TYPES_THIRD_PARTY_LIABILITY || 
                    $data['product_types_id'] == PRODUCT_TYPES_THIRD_PARTY_LIABILITY_PROF_RESP || $data['product_types_id'] ==8 || 
                    $data['product_types_id'] == PRODUCT_TYPES_TRANSPORT_ACCIDENTS ||
                    $data['product_types_id'] == PRODUCT_TYPES_DANGER_OBJECTS ||
                    $data['product_types_id'] == PRODUCT_TYPES_ONE_SHIPPING) {
                    $this->permissions['update'] = true;
                }

                if (($data['policies_id'] && ($data['product_types_id'] == PRODUCT_TYPES_CARGO_GENERAL || $data['product_types_id'] == PRODUCT_TYPES_DRIVE_GENERAL)) ||
                    is_array($data['clients_id'])) {
                        $this->permissions['insert']   = true;
                        $this->permissions['update']  = true;
                }
                break;
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                $this->permissions['update'] = false;
                
                if (
                ($data['product_types_id'] == PRODUCT_TYPES_TRANSPORTER || $data['product_types_id'] == PRODUCT_TYPES_GO ||
                    $data['product_types_id'] == PRODUCT_TYPES_THIRD_PARTY_LIABILITY || 
                    $data['product_types_id'] == PRODUCT_TYPES_THIRD_PARTY_LIABILITY_PROF_RESP || $data['product_types_id'] ==8 || 
                    $data['product_types_id'] == PRODUCT_TYPES_TRANSPORT_ACCIDENTS ||
                    $data['product_types_id'] == PRODUCT_TYPES_DANGER_OBJECTS ||
                    $data['product_types_id'] == PRODUCT_TYPES_ONE_SHIPPING
                ) && $Authorization->data['permissions']['PolicyPaymentsCalendar']['update']
                ) {
                    $this->permissions['update'] = true;
                }
                break;
        }
    }

    function getShowHiddenFields($data) {
        $result = parent::getShowHiddenFields($data);
        return $result .= '<input type="hidden" name="product_types_id" value="' . $data['product_types_id'] . '" />';
    }

    function getRowClass($row, $i) {

        $result = 'row' . $i;

        switch ($row['statuses_id']) {
            case PAYMENT_STATUSES_NOT:
                break;
            case PAYMENT_STATUSES_PARTIAL:
                $result .= ' partial';
                break;
            case PAYMENT_STATUSES_PAYED:
                $result .= ' payed';
                break;
            case PAYMENT_STATUSES_OVER:
                break;
                $result .= ' over';
                break;
        }

        return $result;
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db, $Smarty, $Authorization, $POLICY_STATUSES_SCHEMA, $PAYMENT_STATUSES;

        if ($data['policies_id']) {
            $fields[] = 'product_types_id';
            $template = $this->object . '/showInPolicy.php';
            return parent::show($data, $fields, $conditions, $sql, $template, $limit);
        }

        if (intval($data['clients_id'])) {
            $conditions[] = 'a.id IN(SELECT id FROM ' . PREFIX . '_policies WHERE clients_id = ' . intval($data['clients_id']) . ')';
        } else if (!isset($data['product_types_id'])) {
            $data['product_types_id'] = PRODUCT_TYPES_KASKO;
        }

        if ($data['product_types_id']) {
            $fields[] = 'product_types_id';

            $ProductTypes = new ProductTypes($data);
            $product_types_id = array($data['product_types_id']);
            $ProductTypes->getSubId(&$product_types_id, $data['product_types_id']);

            $conditions[] = 'a.product_types_id IN(' . implode(', ', $product_types_id) . ')';
        }

        if ($Authorization->data['roles_id'] == ROLES_AGENT) {
            $data['agencies_id'] = $Authorization->data['agencies_id'];
        }

        if (intval($data['agencies_id']) && !is_array($data['agencies_id'])) {
            $fields[] = 'agencies_id';

            $Agencies = new Agencies($data);
            $agencies_id = array($data['agencies_id']);
            $Agencies->getSubId(&$agencies_id, $data['agencies_id']);

            $conditions[] = 'a.agencies_id  IN(' . implode(', ', $agencies_id) . ')';
        }

        if (intval($data['insurance_companies_id'])) {
            $conditions[] = 'a.insurance_companies_id = ' . intval($data['insurance_companies_id']);
        }

        if ($data['number']) {
            $conditions[] = 'a.number LIKE ' . $db->quote($data['number'] . '%');
        }

        if ($data['insurer']) {
            $conditions[] = 'a.insurer LIKE ' . $db->quote($data['insurer'] . '%');
        }

        if (is_array($data['policy_statuses_id'])) {
            $fields[] = 'policy_statuses_id';
            $conditions[] = 'a.policy_statuses_id IN (' . implode(', ', $data['policy_statuses_id']) . ')';
        }

        if (!isset($data['statuses_id']) && !$data['clients_id']) {
            $data['statuses_id'] = array(PAYMENT_STATUSES_NOT, PAYMENT_STATUSES_PARTIAL);
        }

        if (is_array($data['statuses_id'])) {
            $fields[] = 'statuses_id';
            $conditions[] = 'b.statuses_id IN (' . implode(', ', $data['statuses_id']) . ')';
        }

        if (!$data['fromWaitingPaymentDate'] && !$data['clients_id']) {
            $data['fromWaitingPaymentDate'] = date('d.m.Y', mktime(0, 0, 0, date('m') , date('d')-5, date('Y')));
        }

        if ($data['fromWaitingPaymentDate']) {
            $conditions[] = $db->quote(substr($data['fromWaitingPaymentDate'], 6, 4) .'-'. substr($data['fromWaitingPaymentDate'], 3, 2) .'-'. substr($data['fromWaitingPaymentDate'], 0, 2)) . ' <= b.date';
        }

        if (!$data['toWaitingPaymentDate'] && !$data['clients_id']) {
            $data['toWaitingPaymentDate'] = date('d.m.Y', mktime(0, 0, 0, date('m') , date('d')+5, date('Y')));
        }

        if ($data['toWaitingPaymentDate']) {
            $conditions[] = 'b.date <= ' . $db->quote(substr($data['toWaitingPaymentDate'], 6, 4) .'-'. substr($data['toWaitingPaymentDate'], 3, 2) .'-'. substr($data['toWaitingPaymentDate'], 0, 2));
        }

        if ($data['fromPaymentDate']) {
            $conditions[] = $db->quote(substr($data['fromPaymentDate'], 6, 4) .'-'. substr($data['fromPaymentDate'], 3, 2) .'-'. substr($data['fromPaymentDate'], 0, 2)) . ' <= b.payment_date';
        }

        if ($data['toPaymentDate']) {
            $conditions[] = 'b.payment_date <= ' . $db->quote(substr($data['toPaymentDate'], 6, 4) .'-'. substr($data['toPaymentDate'], 3, 2) .'-'. substr($data['toPaymentDate'], 0, 2));
        }
        
        if ($data['product_types_id'] == PRODUCT_TYPES_KASKO && intval($data['financial_institutions_id'])) {
            $conditions[] = 'f.financial_institutions_id = ' . intval($data['financial_institutions_id']);
        }

        $sql =  'SELECT getPreviousPaymentStatusFromCalendar(b.policies_id, b.date) as prev_status, a.product_types_id, IF(a.sub_number>0,CONCAT(a.number,\'-\',sub_number),a.number) as number, a.insurer, ' .
                ($data['excel'] ? 'getInsurerAddressByPoliciesId(a.id) as address, getInsurerPatronymicnameByPoliciesId(a.id, a.product_types_id) as insurer_patronymicname, ' : '') .
                'date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as policies_date, date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as policies_begin_datetime, date_format(a.end_datetime, ' . $db->quote(DATE_FORMAT) . ') as policies_end_datetime, DATEDIFF(a.end_datetime, a.begin_datetime) AS days, ' .
                'b.id, payedamount,b.policies_id, b.amount, b.statuses_id, e.title as payment_statuses_title, date_format(b.date, ' . $db->quote(DATE_FORMAT) . ') AS date, date_format(b.payment_date, ' . $db->quote(DATE_FORMAT) . ') AS payment_date, c.title AS agencies_title, d.title as policy_statuses_title,a.states_id, a.states_id2 ' .
                ($data['product_types_id']==PRODUCT_TYPES_KASKO ? ' ,f.options_month500,f.options_fifty_fifty,f.payment_brakedown_id,fin.title as fin_institutionTitle ':' ').
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policy_payments_calendar AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS c ON a.agencies_id = c.id ' .
                'JOIN ' . PREFIX . '_policy_statuses AS d ON a.policy_statuses_id = d.id ' .
                'left JOIN (SELECT policies_id, sum(amount) AS payedamount FROM insurance_policy_payments GROUP BY policies_id) AS pc ON a.id = pc.policies_id '.
                'JOIN ' . PREFIX . '_payment_statuses AS e ON b.statuses_id = e.id ' .
                ($data['product_types_id']==PRODUCT_TYPES_KASKO ? 'JOIN ' . PREFIX . '_policies_kasko AS f ON f.policies_id = a.id LEFT JOIN insurance_financial_institutions fin on fin.id = f.financial_institutions_id ' :' ') .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY b.date ';
        $list = $db->getAll($sql);

        if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {
            $conditions[] = 'getPreviousPaymentStatusFromCalendar(b.policies_id, b.date) <> ' . PAYMENT_STATUSES_NOT;
        }

        if ($data['excel']) {
            header('Content-Disposition: attachment; filename="export.xls"');
            header('Content-Type: ' . Form::getContentType('export.xls'));
            include_once $this->object . '/excel.php';
            exit;
        } else {
            $sql =  'SELECT COUNT(*) as number, SUM(b.amount) as amount ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policy_payments_calendar AS b ON a.id = b.policies_id ' .
                    ($data['product_types_id']==PRODUCT_TYPES_KASKO ? 'JOIN ' . PREFIX . '_policies_kasko AS f ON f.policies_id = a.id ' :' ') .
                    'WHERE ' . implode(' AND ', $conditions);
            $total = $db->getRow($sql);

            $sql =  'SELECT id, title, level - 1 as level ' .
                    'FROM ' . PREFIX . '_product_types ' .
                    'ORDER BY num_l';
            $product_types = $db->getAll($sql, 24 * 60 * 60);

            $sql =  'SELECT id, code, title, level ' .
                        'FROM ' . PREFIX . '_agencies ' .
                        'ORDER BY CAST(code AS UNSIGNED),num_l';                
            $agencies = $db->getAll($sql, 60 * 60);
            
            $sql =  'SELECT id, title ' .
                    'FROM ' . PREFIX . '_financial_institutions ' .
                    'ORDER BY title';
            $financial_institutions = $db->getAll($sql, 30 * 60);

            if (intval($data['product_types_id'])) {
                $Policies = Policies::factory($data);

                $fields['policy_statuses_id']               = $Policies->formDescription['fields'][ $Policies->getFieldPositionByName('policy_statuses_id') ];
                $fields['policy_statuses_id']['condition']  = 'id IN(' . implode(', ', array_keys($POLICY_STATUSES_SCHEMA)) . ')';
                $fields['policy_statuses_id']['list']       = $Policies->getListValue($fields['policy_statuses_id'], $data);
                $fields['policy_statuses_id']['object']     = $Policies->buildSelect($fields['policy_statuses_id'], $data['policy_statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data);
            }

            $fields['statuses_id']              = $this->formDescription['fields'][ $this->getFieldPositionByName('statuses_id') ];
            $fields['statuses_id']['type']      = fldMultipleSelect;
            $fields['statuses_id']['list']      = $PAYMENT_STATUSES;
            $fields['statuses_id']['object']    = $this->buildSelect($fields['statuses_id'], $data['statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data);

            include_once $this->object . '/show.php';
        }
    }

    function exportInWindow($data) {
        $this->checkPermissions('export', $data);

        $data['excel'] = true;
        $this->show($data);
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        if ($data['do'] != 'Clients|generateBills') {
            $data['do'] = $this->object.'|'.$action;
        }
        parent::showForm($data, $action, $actionType, $template);
    }

    function setCertificateAdditionalFields($id) {
        global $db;

        $sql =  'SELECT b.product_types_id, a.policies_id, a.date, b.number ' .
                'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                'WHERE a.id = ' . intval($id);
        $row =  $db->getRow($sql);

        $conditions[] = 'b.payment_statuses_id = ' . PAYMENT_STATUSES_NOT;
//eugene!!! оставил для Раевской, глюки будут в корпоративе        
        $conditions[] = 'TO_DAYS(b.begin_datetime) <= TO_DAYS(' . $db->quote($row['date']) . ')';
        $conditions[] = 'a.policies_general_id = ' . intval($row['policies_id']);
        $conditions[] = 'b.policy_statuses_id = ' . POLICY_STATUSES_GENERATED;
        $conditions[] = 'payments_id = 0';

        switch ($row['product_types_id']) {
            case PRODUCT_TYPES_CARGO_GENERAL:
                $table = PREFIX . '_policies_cargo';
                break;
            case PRODUCT_TYPES_DRIVE_GENERAL:
                $table = PREFIX . '_policies_drive';
                break;
            case PRODUCT_TYPES_TRANSPORTER:
            case PRODUCT_TYPES_THIRD_PARTY_LIABILITY:
            case PRODUCT_TYPES_THIRD_PARTY_LIABILITY_PROF_RESP:
            case PRODUCT_TYPES_TRANSPORT_ACCIDENTS:
            case PRODUCT_TYPES_DANGER_OBJECTS:
            case PRODUCT_TYPES_ONE_SHIPPING:
            case PRODUCT_TYPES_GO:
                return;
                break;
        }

        $sql =  'UPDATE ' . $table . ' AS a ' .
                'JOIN ' . PREFIX . '_policies AS b ON a.policies_id=b.id SET ' .
                'a.payments_id = ' . $id . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        $db->query($sql);

        $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                'number = CONCAT(' . $db->quote($row['number']) . ', date_format(date, ' . $db->quote('.%m.%y') . ')), ' .
                'amount = ' .
                    '(SELECT SUM(amount) ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . $table . ' AS b ON a.id = b.policies_id ' .
                    'WHERE payments_id = ' . intval($id) . '), ' .
                'file = ' . $db->quote(1) . ' ' .
                'WHERE id = ' . intval($id);
        $db->query($sql);
    }

    function isPresent($id, $policies_id, $day, $month, $year) {
        global $db;

        $conditions[] = 'id <> ' . intval($id);
        $conditions[] = 'policies_id = ' . intval($policies_id);
        $conditions[] = 'TO_DAYS(' . $db->quote($year . '-' . $month . '-' . $day) . ') <= TO_DAYS(date)';

        $sql =  'SELECT count(*) ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        return ($db->getOne($sql)) ? true : false;
    }

    function checkFields($data, $action) {
        global $db, $Log;

        parent::checkFields($data, $action);

        /*switch ($data['product_types_id']) {
            case PRODUCT_TYPES_CARGO_GENERAL:
            case PRODUCT_TYPES_DRIVE_GENERAL:
                if (mktime(0, 0, 0, $data['date_month'], $data['date_day'] + 1, $data['date_year']) != mktime(0, 0, 0, $data['date_month'] + 1, 1, $data['date_year'])) {
                    $Log->add('error', 'Рахунок може бути датований лише останнім днем місяця.');
                } elseif ($this->isPresent($data['id'], $data['policies_id'], $data['date_day'], $data['date_month'], $data['date_year'])) {
                    $Log->add('error', 'Дата рахунку не може бути раніше (дорівнювати) вже існуючого.');
                }
                break;
        }*/
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization;

        $data['statuses_id'] = PAYMENT_STATUSES_NOT;
        $data['amount']     = 0;

        $data['id'] = parent::insert($data, false, true);

        if ($data['id']) {
            $this->setCertificateAdditionalFields($data['id']);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

            if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $data['id'];
            }
        }
    }

    function prepareFields($action, $data) {
        global $db;

        $sql =  'SELECT product_types_id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE id = ' . intval($data['policies_id']);
        $data['product_types_id'] = $db->getOne($sql);

        return $data;
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log;

        $data['id'] = parent::update($data, false, true);

        if ($data['id']) {
            $this->setCertificateAdditionalFields($data['id']);

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['id'];
            $params['storage']  = $this->tables[0];

            if ($redirect) {
                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $data['id'];
            }
        }
    }

    //очистка календаря платежей указанного договора
    function clear($policies_id) {
        global $db;

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policy_payments_calendar ' .
                'WHERE policies_id = ' . intval($policies_id);
        $db->query($sql);
    }

    //устанавливаем (обновляем) календарь по договору
    function updateCalendar($policies_id, $skipCheck = false)    {
        global $db, $data, $Log;

        if ($data['skipFields']) return;

        if (PolicyPayments::getNumberByPoliciesId($policies_id) > 0 && !$data['skipCheck'] && !$skipCheck) {
            $Log->add('error', 'Календар платежів не було змінено, гроші вже почали надходити від клієнта.');
            return;
        }

        $this->clear($policies_id);

        $Policies = new Policies(array());

        $row = $Policies->get($policies_id);

        $this->permissions['insert'] = true;

        $this->formDescription['fields'][ $this->getFieldPositionByName('file') ]['type'] = fldText;

        $row['policies_id']  = $policies_id;
        $row['statuses_id']  = PAYMENT_STATUSES_NOT;
        $row['file']        = 1;
        //костыль для акции ГО за 1грн
        /*if ($row['financial_products_id']>0 && 
            ($row['financial_products_id']==7940 || $row['financial_products_id']==7945 || $row['financial_products_id']==7946 || $row['financial_products_id']==7317 || $row['financial_products_id']==7939))
            {
                $row['amount'] = 1;
            }
        */
        $payments = array();
        
        
        
        
        $begin_year = substr($row['begin_datetime'], 0, 4);
        $end_year = substr($row['end_datetime'], 0, 4);
        
        $diff_year = $end_year-$begin_year;
        
        if($diff_year > 1) {
            $tempDiff = date_diff(date_create($row['end_datetime']), date_create($row['begin_datetime']));
            if($tempDiff->format("%y") == 1 && $tempDiff->format("%m") == 0)
                $diff_year = 1;
        }
        
        $date = mktime(0, 0, 0, substr($row['begin_datetime'], 5, 2), substr($row['begin_datetime'], 8, 2), $begin_year);
        //для каско дата окончания не более одного года, разбивка только в пределах первого года идет
        $enddate = mktime(0, 0, 0, substr($row['end_datetime'], 5, 2), substr($row['end_datetime'], 8, 2), $data['product_types_id'] == PRODUCT_TYPES_KASKO && $diff_year>1 ? $begin_year+1 : $end_year );
        $datediff = intval(($enddate-$date)/(86400*30));
        
        if ($row['next_policy_statuses_id'] == POLICY_STATUSES_RENEW) {//переукладення вычесть с оплати неотработаные деньги прошлого полиса
            $row['amount'] = $row['amount'] - $row['parentAmount'];
            if ($row['amount'] < 0) $row['amount'] = 0;
        }

        if (($row['payment_brakedown_id'] > 1 || $row['options_month500']) && !in_array($data['agreement_types_id'], array(1,3))){

            switch($row['payment_brakedown_id']) {
                case 2:
                    $breakcount = 2;
                    $addmonth   = intval($datediff/$breakcount);
                    if ($addmonth==0) $addmonth=1;
                    break;
                case 3:
                    $breakcount = 4;
                    $addmonth   = intval($datediff/$breakcount);
                    break;
            }           
            if ($data['admin_payments_count']>0) {
                    $breakcount = intval($data['admin_payments_count']);
                    $addmonth   = 1;
            }
            
            if ($row['options_month500']) //акция месяц страхования – 500 грн.
            {
                $payments[] = array('date'=>$date,'amount'=>500); //первый платеж 500 по акции
                //сдвинуть дату на 1 месяц
                $date = mktime(0, 0, 0, substr($row['begin_datetime'], 5, 2), substr($row['begin_datetime'], 8, 2) + 30, substr($row['begin_datetime'], 0, 4));
                $row['amount']-=500; //уменьшить сумму к оплате
                $breakcount = $row['express_products_id']== PRODUCT_KASKO1 ? 1 : 1; //для легкий остаеться еще 1 платеж для остальных 2
                $addmonth = 5; //до второго платежа 5 месяцев и потом до последнего останется 6
            }
            $bank_part = 0;
            if (!$data['equalPayments'] && doubleval($row['items'][0]['bank_commission_value'])>0 && $row['items'][0]['products_id']!=675) {//костыль если банковкая комссия от СС
                    $bank_part = round($row['items'][0]['car_price']*doubleval($row['items'][0]['bank_commission_value'])/100,2);//это часть которую отдать банку сразу
                    $row['amount']-=$bank_part; //уменьшить сумму к оплате
            }

            $amount = intval($row['amount']);
            $payments[] = array('date'=>$date,'amount'=>$amount / $breakcount + $row['amount'] - $amount + $bank_part); //первый платеж

            for ($i=1; $i<$breakcount; $i++) {
                $date = mktime(0, 0, 0, date('m', $date) + $addmonth, date('d', $date), date('Y', $date));
                $payments[] = array('date'=>$date,'amount'=>round($amount / $breakcount, 2));
            }
        } else {
            $payments[] = array('date'=>$date,'amount'=>$row['amount']); //первый платеж он один
        }
        
        if ($row['product_types_id'] == PRODUCT_TYPES_MORTAGE) //ипоетка дублируем платежи на каждый год
        {
            //добавить 1 год 
            $date = mktime(0, 0, 0, date('m', $date) + 12, date('d', $date), date('Y', $date));
            while ($date < $enddate)
            {
                $payments[] = array('date'=>$date,'amount'=>$row['amount']); //очередной платеж
                //добавить 1 год 
                $date = mktime(0, 0, 0, date('m', $date) + 12, date('d', $date), date('Y', $date));
            }
        }
        
        if ($data['product_types_id'] == PRODUCT_TYPES_TRANSPORTER || 
            $data['product_types_id'] == PRODUCT_TYPES_THIRD_PARTY_LIABILITY || 
            $data['product_types_id'] == PRODUCT_TYPES_THIRD_PARTY_LIABILITY_PROF_RESP ||
            $data['product_types_id'] == PRODUCT_TYPES_TRANSPORT_ACCIDENTS ||
            $data['product_types_id'] == PRODUCT_TYPES_DANGER_OBJECTS ||
            $data['product_types_id'] == PRODUCT_TYPES_ONE_SHIPPING) {
            
            $payments = array();
            $date = mktime(0, 0, 0, substr($row['begin_datetime'], 5, 2), substr($row['begin_datetime'], 8, 2), substr($row['begin_datetime'], 0, 4));
            $enddate = mktime(0, 0, 0, substr($row['end_datetime'], 5, 2), substr($row['end_datetime'], 8, 2), substr($row['end_datetime'], 0, 4));
            $datediff = intval(($enddate-$date)/(86400));
            
            $breakcount = $data['payment_brakedown_id'];
            $addday   = intval($datediff/$breakcount);
            
            $amount = intval($row['amount']);
            $payments[] = array('date'=>$date,'amount'=>$amount / $breakcount + $row['amount'] - $amount); //первый платеж

            for ($i=1; $i<$breakcount; $i++) {
                $date = mktime(0, 0, 0, date('m', $date), date('d', $date) + $addday, date('Y', $date));
                $payments[] = array('date'=>$date,'amount'=>round($amount / $breakcount, 2));
            }
        }

        //вносим информацию по рассрочке в систему
        $item_years_payments_id = $db->getOne('SELECT id FROM ' . PREFIX . '_policies_kasko_item_years_payments WHERE policies_id = ' . intval($policies_id).' ORDER BY date LIMIT 1' );
        foreach ($payments as $i => $payment) {

            $amount = $payment['amount'];
            $date = $payment['date'];
        
            $row['date_day']     = date('d', $date);
            $row['date_month']   = date('m', $date);
            $row['date_year']    = date('Y', $date);
            $row['amount']      = $amount;
            $row['item_years_payments_id']      = $item_years_payments_id;

            Form::insert($row, false, true);

            $row['file']++;
        }

        //многолетний
        $sql =  'INSERT INTO ' . PREFIX . '_policy_payments_calendar (policies_id, date, amount, file, statuses_id, created, next_year,item_years_payments_id) ' .
                'SELECT policies_id, date, SUM(amount_kasko), 1, 1, NOW(), 1,id ' .
                'FROM ' . PREFIX . '_policies_kasko_item_years_payments ' .
                'WHERE policies_id = ' . intval($policies_id) . ' AND date > ' . $db->quote(date('Y-m-d',$date)) . ' ' .
                'GROUP BY policies_id, date';
        //_dump($sql);exit;
        $db->query($sql);
    }

    function setPaymentStatuses($policies_id) {
        global $db;

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE id = ' . intval($policies_id);
        $policy = $db->getRow($sql);

        $sql =  'SELECT datetime, SUM(amount) as amount ' .
                'FROM ' . PREFIX . '_policy_payments ' .
                'WHERE  policies_id = ' . intval($policies_id) . ' ' .
                'GROUP BY datetime ' .
                'ORDER BY datetime ASC';
        $payments = $db->getAll($sql);
        
        if (sizeof($payments)) {
            for($i = 0; $i < sizeof($payments); $i++) {
                $payment = $payments[$i];
                if ($payment['amount']<0 && isset($payments[$i-1])) {
                    $payments[$i-1]['amount']+=$payment['amount'];
                    unset($payments[$i]);
                    if ($payments[$i-1]['amount']==0) unset($payments[$i-1]);
                }
            }
        }

        $sql =  'SELECT   SUM(amount) as amount ' .
                'FROM ' . PREFIX . '_policy_payments ' .
                'WHERE amount < 0 AND policies_id = ' . intval($policies_id) ;

        
        $sql =  'SELECT id, date, amount, ' . PAYMENT_STATUSES_NOT . ' AS statuses_id, \'0000-00-00\' AS payment_date, 0 as payed ' .
                'FROM ' . PREFIX . '_policy_payments_calendar ' .
                'WHERE policies_id = ' . intval($policies_id) . ' ' .
                'ORDER BY date ASC';
        $breakdowns = $db->getAll($sql);

        if (sizeOf($breakdowns) /*&& sizeof($payments)*/) {
            
            for($j = 0; $j < sizeof($breakdowns); $j++) {
                $count_remove = 0;
                $calendar_amount = $breakdowns[$j]['amount'];
                for($i = 0; $i < sizeof($payments); $i++) {
                    $payment = $payments[$i];
                    if (((string)$calendar_amount > (string)$payment['amount']))  {
                        $count_remove++;
                        $breakdowns[$j]['statuses_id'] =  $payment['amount']<=0 ? PAYMENT_STATUSES_NOT : PAYMENT_STATUSES_PARTIAL;
                        $breakdowns[$j]['payment_date'] = '0000-00-00';
                        $calendar_amount = roundNumber($calendar_amount - $payment['amount'], 2);
                    } elseif ((string)$calendar_amount == (string)$payment['amount']) {
                        $count_remove++;
                        $breakdowns[$j]['statuses_id'] = PAYMENT_STATUSES_PAYED;
                        $breakdowns[$j]['payment_date'] = $payment['datetime'];
                        break;
                    } else {
                        $payments[$i]['amount'] -= $calendar_amount;
                        if (intval($payments[$i]['amount'] * 100) == 0) $count_remove++;
                        $breakdowns[$j]['statuses_id'] = PAYMENT_STATUSES_PAYED;
                        $breakdowns[$j]['payment_date'] = $payment['datetime'];

                        break;
                    }
                }

                while ($count_remove > 0) {
                    array_shift($payments);
                    $count_remove--;
                }
                
            }
            //exit;
            //_dump($payments);exit;

            if (sizeof($payments)) {
                $breakdowns[$j-1]['statuses_id'] = PAYMENT_STATUSES_OVER;
            } 

            
            unset($payments_info);

            foreach ($breakdowns AS $breakdown) {
                $sql =  'UPDATE ' . PREFIX . '_policy_payments_calendar SET ' .
                        'statuses_id = ' . intval($breakdown['statuses_id']) . ', ' .
                        'payment_date = ' . $db->quote($breakdown['payment_date']) . ' ' .
                        'WHERE id = ' . intval($breakdown['id']);
                $db->query($sql);

                $statuses_id = $breakdown['statuses_id'];
                //устанавливаем статус "Сплачено" для сертификатов, что были оплачены в рамках счета за период
                switch ($policy['product_types_id']) {
                    case PRODUCT_TYPES_CARGO_GENERAL:
                        $table = PREFIX . '_policies_cargo';
                    case PRODUCT_TYPES_DRIVE_GENERAL:

                        if (!$table) {
                            $table = PREFIX . '_policies_drive';
                        }

                        switch ($statuses_id) {
                            case PAYMENT_STATUSES_PAYED:
                            case PAYMENT_STATUSES_OVER:
                                $statuses_id = PAYMENT_STATUSES_PAYED;
                                break;
                            default:
                                $statuses_id = PAYMENT_STATUSES_NOT;
                                break;
                        }

                        $sql =  'UPDATE ' . PREFIX . '_policies AS a ' .
                                    'JOIN ' . $table . ' AS b ON a.id = b.policies_id SET ' .
                                    'payment_statuses_id = ' . $statuses_id . ' ' .
                                    'WHERE b.payments_id = ' . intval($breakdown['id']);
                        $db->query($sql);

                        break;
                }
            }
        }
    }

    //формирование счета на оплату
    function downloadFileInWindow($data) {
        global $db, $MONTHES, $Authorization, $Smarty;

        $file = unserialize($data['file']);

        $this->checkPermissions('view', $file);

        //получаем вид страхования
        $sql =  'SELECT b.product_types_id ' .
                'FROM ' . $this->tables[0] . ' AS a ' .
                'JOIN ' . PREFIX . '_policies AS b ON a.policies_id=b.id ' .
                'WHERE a.id = ' . intval($file['id']);
        $row = $db->getRow($sql);
//_dump($row['product_types_id'])       ;exit;
        switch ($row['product_types_id']) {
            case PRODUCT_TYPES_KASKO:
            
                $sql =  'SELECT b.*, c.*,ag.top as top_agency, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount AS bill_amount, a.date AS policy_payments_calendar_date, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_kasko AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);
                
                //получаем банковские реквизиты
                $sql =  'SELECT a.products_id, brand, model, sign, b.bill_bank_account, b.bill_bank_mfo, a.car_price ' .
                        'FROM ' . PREFIX . '_policies_kasko_items AS a ' .
                        'LEFT JOIN ' . PREFIX . '_products_kasko AS b ON a.products_id = b.products_id ' .
                        'WHERE a.policies_id = ' . intval($values['policies_id']);
                $values['items'] = $db->getAll($sql);

                if (is_array($values['items']) && sizeof($values['items'])>0) {
                    $values = array_merge ($values, $values['items'][0] );
                }

                switch ($data['type']) {
                    case 'letter':
                        $template = 'letter';

                        //получаем дату следующего платежа
                        $sql = 'SELECT DATE_SUB(date,INTERVAL 1 DAY) FROM ' . PREFIX . '_policy_payments_calendar WHERE date > ' . $db->quote($values['policy_payments_calendar_date']) . ' AND policies_id = ' . intval($values['policies_id']) . ' ORDER BY date ASC LIMIT 1';
                        $values['policy_payments_calendar_end_date'] = $db->getOne($sql);

                        if ($values['policy_payments_calendar_end_date'] === NULL) {
                            $values['policy_payments_calendar_end_date'] = $values['end_datetime'];
                        }
                        break;
                    default:
                        if ($Authorization->data['roles_id'] == ROLES_AGENT && intval($values['policy_statuses_id']) === 1 && $values['items'][0]['car_price'] >= 3000000) {
							$template = 'bill0';
						} else {
							$template = 'bill';
						}
                        break;
                }
                
                //$this->privatBankConnection($file['id'], $values);

                $template =  $template . 'KASKO.tpl';
                break;
            case PRODUCT_TYPES_DGO:

                $sql =  'SELECT b.*, c.*, ag.top as top_agency,CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.date AS policy_payments_calendar_date, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_dgo AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billDGO.tpl';
                break;
            case PRODUCT_TYPES_GO:
            
                $sql =  'SELECT b.*, c.*, ag.top as top_agency,CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.date AS policy_payments_calendar_date, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_go AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);
                
                //$this->privatBankConnection($file['id'], $values);

                $template = 'billGO.tpl';
                break;
            case PRODUCT_TYPES_DSKV:

                $sql =  'SELECT b.*, c.*, ag.top as top_agency,CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.date AS policy_payments_calendar_date, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_dskv AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billDSKV.tpl';
                break;
            case PRODUCT_TYPES_CARGO_GENERAL:
                $sql =  'SELECT a.policies_id,ag.top as top_agency, b.*, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, date_format(a.date, \'%m\') as month, date_format(a.date, \'%Y\') as year, SUM(e.amount) as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_cargo AS d ON d.payments_id = a.id ' .
                        'JOIN ' . PREFIX . '_policies AS e ON d.policies_id = e.id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']) . ' ' .
                        'GROUP BY a.id';
                $values = $db->getRow($sql);

                $sql =  'SELECT b.number, b.date, b.amount ' .
                        'FROM ' . PREFIX . '_policies_cargo AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_client_contacts AS c ON b.client_contacts_id = c.accounts_id ' .
                        'WHERE payments_id = ' . intval($file['id']) . ' ' .
                        'ORDER BY b.date, b.id';
                $values['certificates'] = $db->getAll($sql);

                $values['period'] = $MONTHES[ $values['month'] - 1 ] . ' ' . $values['year'];

                $Smarty->assign('monthes', $MONTHES);

                $template = 'billCertificateGeneral.tpl';
                break;
            case PRODUCT_TYPES_CARGO_CERTIFICATE:
                $sql =  'SELECT a.policies_id,  a.file, b.*, b.number as bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, d.number as general_number, d.date as general_date, d.insurer, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_cargo AS c ON a.policies_id = c.policies_id ' .
                        'JOIN ' . PREFIX . '_policies AS d ON c.policies_general_id = d.id ' .
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billCertificate.tpl';
                break;
            case PRODUCT_TYPES_DRIVE_GENERAL:
                $sql =  'SELECT a.policies_id, a.file, a.number as bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, date_format(a.date, \'%m\') as month, date_format(a.date, \'%Y\') as year, DATE_ADD(a.date, INTERVAL 13 day) AS bill_payment_date, b.*, SUM(e.amount) as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_drive AS d ON d.payments_id = a.id ' .
                        'JOIN ' . PREFIX . '_policies AS e ON d.policies_id = e.id ' .
                        'WHERE a.id = ' . intval($file['id']) . ' ' .
                        'GROUP BY a.id';
                $values = $db->getRow($sql);
                $data['client_contacts_id']=1;//!!!!!
                if (intval($data['client_contacts_id'])) {
                    $sql =  'SELECT b.number, b.date, b.amount ' .
                            'FROM ' . PREFIX . '_policies_drive AS a ' .
                            'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                            'LEFT JOIN ' . PREFIX . '_client_contacts AS c ON b.client_contacts_id = c.accounts_id ' .
                            'WHERE payments_id = ' . intval($file['id']) . ' ' .
                            'ORDER BY b.date, b.id';
//_dump($sql);exit;
                    $values['certificates'] = $db->getAll($sql);
                } else {
                    $sql =  'SELECT CONCAT(kasko_items.brand, \' \', kasko_items.model) as item, kasko_items.year as year, kasko_items.sign as sign, kasko_items.shassi as shassi, ' .
                            'kasko_items.engine_size as engine_size, kasko_items.car_price as car_price, police_general.begin_datetime as begin_datetime_general_police, ' .
                            'police_general.end_datetime as end_datetime_general_police, police_certificate.begin_datetime as begin_datetime_certificate_police, ' .
                            'police_certificate.end_datetime as end_datetime_certificate_police, TO_DAYS(police_certificate.end_datetime) - TO_DAYS(police_certificate.begin_datetime) + 1 as days, ' .
                            'kasko_items.car_price as price, police_certificate.rate, police_certificate.amount, ' .
                            'kasko.insurer_lastname, kasko.insurer_firstname, kasko.insurer_patronymicname ' .
                            'FROM ' . PREFIX . '_policies_drive as drive ' .
                            'JOIN ' . PREFIX . '_policies as police_general ON drive.policies_general_id = police_general.id ' .
                            'JOIN ' . PREFIX . '_policies as police_certificate ON drive.policies_id = police_certificate.id ' .
                            'JOIN ' . PREFIX . '_policies_kasko as kasko ON drive.policies_id = kasko.policies_id ' .
                            'JOIN ' . PREFIX . '_policies_kasko_items as kasko_items ON drive.policies_id = kasko_items.policies_id ' .
                            'WHERE drive.payments_id = ' . intval($file['id']) . ' ' .
                            'ORDER BY police_certificate.id';
                    $values['items'] = $db->getAll($sql);
                }

                $values['period'] = $MONTHES[ $values['month'] - 1 ] . ' ' . $values['year'];

                $Smarty->assign('monthes', $MONTHES);

                $template = 'billCertificateGeneral.tpl';
                break;
            case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                $sql =  'SELECT a.policies_id, a.file, b.*, b.number as bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, d.number as general_number, d.date as general_date, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_drive AS c ON a.policies_id = c.policies_id ' .
                        'JOIN ' . PREFIX . '_policies AS d ON c.policies_general_id = d.id ' .
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billCertificate.tpl';
                break;
            case PRODUCT_TYPES_PROPERTY:

                $sql =  'SELECT b.*, c.*,ag.top as top_agency, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_property AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billProperty.tpl';
                break;
            case PRODUCT_TYPES_MORTAGE:

                $sql =  'SELECT b.*, c.*,ag.top as top_agency, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_mortage AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billMortage.tpl';
                break;  
            case PRODUCT_TYPES_NS:

                $sql =  'SELECT b.*, c.*,ag.top as top_agency, a.statuses_id, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_ns AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billNS.tpl';
                break;
            case PRODUCT_TYPES_NS_TRANSPORT:

                $sql =  'SELECT b.*, c.*,ag.top as top_agency, a.statuses_id, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_ns_transport AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billNS.tpl';
                break;  
            case PRODUCT_TYPES_TRANSPORTER:

                $sql =  'SELECT b.*, c.*,ag.top as top_agency, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id, a.file ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_transporter AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billTransporter.tpl';
                break;
            case PRODUCT_TYPES_THIRD_PARTY_LIABILITY:

                $sql =  'SELECT b.*, c.*,ag.top as top_agency, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id, a.file ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_third_party_liability AS c ON b.id = c.policies_id ' .
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billThirdPartyLiability.tpl';
                break;
            case PRODUCT_TYPES_THIRD_PARTY_LIABILITY_PROF_RESP:

                $sql =  'SELECT b.*, c.*,ag.top as top_agency, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id, a.file ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_third_party_liability_prof_resp AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billThirdPartyLiabilityProfResp.tpl';
                break;
            case PRODUCT_TYPES_TRANSPORT_ACCIDENTS:

                $sql =  'SELECT b.*, c.*,ag.top as top_agency, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id, a.file ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_transport_accidents AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billTransportAccidents.tpl';
                break;
            case PRODUCT_TYPES_DANGER_OBJECTS:

                $sql =  'SELECT b.*, c.*,ag.top as top_agency, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id, a.file ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_danger_objects AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billDangerObjects.tpl';
                break;
            case PRODUCT_TYPES_ONE_SHIPPING:

                $sql =  'SELECT b.*, c.*,ag.top as top_agency, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id, a.file ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_one_shipping AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billOneShipping.tpl';
                break;
            case PRODUCT_TYPES_DMS:
                $sql =  'SELECT b.*, c.*,ag.top as top_agency, b.number as policies_number, CONCAT(b.number, \'/\', a.file) AS bill_number, IF(a.date > NOW(), NOW(), a.date) AS bill_date, a.amount as bill_amount, a.statuses_id AS policy_payments_calendar_statuses_id, a.file ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar AS a ' .
                        'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                        'JOIN ' . PREFIX . '_policies_dms AS c ON b.id = c.policies_id ' .
                        ' JOIN insurance_agencies ag on ag.id=b.agencies_id '.
                        'WHERE a.id = ' . intval($file['id']);
                $values = $db->getRow($sql);

                $template = 'billDMS.tpl';
                break;
        }

        if ($values) {
            if ($values['statuses_id'] > PAYMENT_STATUSES_PARTIAL || ($values['product_types_id'] == PRODUCT_TYPES_GO && $values['special'])) {
                $values['payed'] = 1;
            }

            $Smarty->assign('values', $values);

            $file['name'] = $values['policies_id'] . '_' . $values['file'];
            $file['content'] = $Smarty->fetch($this->object . '/' . $template);
            //echo $file['content'];exit;
            html2pdf($file);
        }
    }
    
    function privatBankConnection($id, $values) {
        global $db, $Log;
        
        $fd = fsockopen("217.117.65.83", 8080); 

        if ($values['insurer_person_types_id'] == 1 && $values['product_types_id'] == PRODUCT_TYPES_KASKO || $values['person_types_id'] == 1 && $values['product_types_id'] == PRODUCT_TYPES_GO) {
            $add_param = array();
        
            $fio = $values['insurer_lastname'] . ' ' . $values['insurer_firstname'] . ' ' . $values['insurer_patronymicname'];
            
            preg_match_all('/\d+/', $values['insurer_phone'], $phone);
            
            $pkgid = $id;
            
            switch ($values['product_types_id']) {
                case PRODUCT_TYPES_GO:
                    $paybacnum = '26507620526463';
                    $paymfo_payokpo[0][0] = '300012';
                    $paymfo_payokpo[0][1] = '36086124';
                    $payperjname = 'ПАТ "Промінвестбанк"';
                    break;
                case PRODUCT_TYPES_KASKO:
                    preg_match_all('/\d+/', $values['bill_bank_account'], $paybacnum);
                    $paybacnum = implode(null, $paybacnum[0]);
                    
                    preg_match_all('/\d+/', $values['bill_bank_mfo'], $paymfo_payokpo);
                    
                    $payperjname_array = explode(' ', $values['bill_bank_account']);
                    $payperjname = null;
                    $do = false;
                    foreach($payperjname_array as $el) {
                        if ($do) $payperjname .= $el . ' ';
                        if ($el === "в") $do = true;
                    }
                    break;
            }           
            
            $paydate = date('Y-m-d') . 'T' . date('H:i:s') . '+03:00';
            
            $paydest = $values['number'] . ', ' . $values['insurer_lastname'] . ' ' . substr($values['insurer_firstname'], 0, 2) . '.' . substr($values['insurer_patronymicname'], 0, 2) . '., ' . $values['insurer_identification_code'] . ', ' . date('d.m.Y') . ', ' . 'Страховий платіж згідно договору(полісу) без ПДВ';
            
            $paysumn = $values['bill_amount'];
            
            $sql = 'SELECT privatbank_id FROM ' . PREFIX . '_policy_payments_calendar_privatbank WHERE payments_calednar_id = ' . intval($id);
            $privatbank_id = intval($db->getOne($sql));
            if ($privatbank_id) {
                $add_param[] = "<param>
                                    <name>ModifyAction</name>
                                    <value>UPDATE</value>
                                </param>";
            }
            
        } else {
            return;
        }
        
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>
                <PayerPays>
                    <providerid>263594</providerid>
                    <payer>
                        <fio>" . $fio . "</fio>
                        <phone>" . implode(null, $phone[0]) . "</phone>
                        <extparams>
                            <param>
                                <name>PKGID</name>
                                <value>" . $pkgid . "</value>
                            </param>" .
                            implode('\r\n', $add_param) .
                        "</extparams>
                    </payer>
                    <pays>
                        <pay>
                            <paybacnum>" . $paybacnum . "</paybacnum>
                            <paydate>" . $paydate . "</paydate>
                            <paydest>" . $paydest . "</paydest>
                            <paymfo>" . $paymfo_payokpo[0][0] . "</paymfo>
                            <payokpo>" . $paymfo_payokpo[0][1] . "</payokpo>
                            <payperjname>" . trim($payperjname) . "</payperjname>
                            <paysumn>" . $paysumn . "</paysumn>
                        </pay>
                    </pays>
                </PayerPays>";

        fputs($fd, "POST /biplanws/pay/postpay.dao HTTP/1.0\r\nHost: 217.117.65.83\r\nContent-Type: text/xml;charset=UTF-8\r\nContent-length: ".strlen($xml)."\r\n\r\n".$xml."\r\n\r\n");
        
        $haystack = '';
        $answer = '';
        while ($buffer = fgets($fd, 4096)) {
            $answer .= $buffer;
            if (substr(trim($buffer), 0, 1) === "<") {
                $haystack .= $buffer;
            }
        }       
        
        $xml_parser = xml_parser_create();
        xml_parse_into_struct($xml_parser, $haystack, $attrs, $index);
        xml_parser_free($xml_parser);

        $result['sign'] = -1;
        foreach($attrs as $attr) {
            if ($attr['tag'] == 'INNER_REF' && $attr['type'] == 'complete') {
                $result['sign'] = 1;
                $result['ref'] = $attr['value'];
            }
            if ($attr['tag'] == 'ERRORRESPONSE' && $attr['type'] == 'open') {
                $result['sign'] = 0;
            }
            if ($attr['tag'] == 'CODE' && $attr['type'] == 'complete' && $result['sign'] == 0) {
                $result['code'] = $attr['value'];
            }
            if ($attr['tag'] == 'MESSAGE' && $attr['type'] == 'complete' && $result['sign'] == 0) {
                $result['message'] = $attr['value'];
            }
        }
        
        if ($result['sign'] == 1 && !$privatbank_id) {
            $sql = 'INSERT INTO ' . PREFIX . '_policy_payments_calendar_privatbank SET payments_calednar_id = ' . intval($id) . ', privatbank_id = ' . intval($result['ref']);
            $db->query($sql);
        }
    }
    
     
    
}

?>