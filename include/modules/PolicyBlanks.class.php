<?
/*
 * Title: PolicyBlanks class
 *
 * @author 
 * @email 
 * @version 3.0
 */

require_once 'Agencies.class.php';
require_once 'PolicyBlankActs.class.php';

class PolicyBlanks extends Form {

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
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'insurance_companies_id',
                            'description'       => 'Компанія',
                            'type'              => fldSelect,
                            'condition'         => 'id IN(3,4)',
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
                            'table'             => 'policy_blanks',
                            'sourceTable'       => 'companies',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'product_types_id',
                            'description'       => 'Тип',
                            'type'              => fldSelect,
                            'condition'         => 'num_l = num_r AND id IN(3,4)',
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
                            'orderPosition'     => 2,
                            'table'             => 'policy_blanks',
                            'withoutTable'      => true,
                            'sourceTable'       => 'product_types',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'code',
                            'description'       => 'Агенція, код',
                            'type'              => fldSelect,
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
                            'orderPosition'     => 3,
                            'table'             => 'policy_blanks',
                            'withoutTable'      => true,
                            'sourceTable'       => 'agencies',
                            'selectField'       => 'code',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'agencies_id',
                            'description'       => 'Агенція',
                            'type'              => fldSelect,
                            'condition'         => 'parent_id = 0',
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
                            'orderPosition'     => 4,
                            'table'             => 'policy_blanks',
                            'sourceTable'       => 'agencies',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'series',
                            'description'       => 'Серія',
                            'type'              => fldText,
                            'maxlength'         => 2,
                            'validationRule'    => '^(ВА|ВВ|ВС|ВЕ|АА|АВ|АЕ|АС|АІ|АК)$',
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
                            'orderPosition'     => 5,
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'number',
                            'description'       => 'Номер',
                            'type'              => fldText,
                            'maxlength'         => 7,
                            'validationRule'    => '^[0-9]{7}$',
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
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'blank_statuses_id',
                            'description'       => 'Статус бланку',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true,
                                    'change'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 7,
                            'table'             => 'policy_blanks',
                            'sourceTable'       => 'policy_blank_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'begin_datetime',
                            'description'       => 'Початок',
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
                                    'canBeEmpty'=> true
                                ),
                            'orderPosition'     => 8,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'interrupt_datetime',
                            'description'       => 'Кінець',
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
                                    'canBeEmpty'=> true
                                ),
                            'orderPosition'     => 9,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'policy_statuses_id',
                            'description'       => 'Статус полісу',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=> false
                                ),
                            'orderPosition'     => 10,
                            'table'             => 'policies',
                            'sourceTable'       => 'policy_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'sign',
                            'description'       => 'Державний номер',
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
                            'orderPosition'     => 11,
                            'width'             => 100,
                            'table'             => 'policies_go'),
                        array(
                            'name'              => 'amount',
                            'description'       => 'Премія, грн.',
                            'type'              => fldMoney,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=> false
                                ),
                            'orderPosition'     => 12,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'paid_amount',
                            'description'       => 'Сплачено, грн.',
                            'type'              => fldMoney,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=> false
                                ),
                            'orderPosition'     => 13,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'documents',
                            'description'       => 'Документи',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'=> false
                                ),
                            'orderPosition'     => 14,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'acts_output_number',
                            'description'       => 'Акт, видача',
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
                            'orderPosition'     => 15,
                            'width'             => 100,
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'acts_output_date',
                            'description'       => 'Дата акту, видача',
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
                            'orderPosition'     => 16,
                            'width'             => 100,
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'acts_output_statuses_title',
                            'description'       => 'Статус акту, видача',
                            'type'              => fldText,
                            'list'              => array(
                                                    1   => 'Створено',
                                                    2   => 'Передано'),
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
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'acts_input_number',
                            'description'       => 'Акт, звіт',
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
                            'orderPosition'     => 18,
                            'width'             => 100,
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'acts_input_date',
                            'description'       => 'Дата акту, звіт',
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
                            'orderPosition'     => 19,
                            'width'             => 100,
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'acts_input_statuses_title',
                            'description'       => 'Статус акту, звіт',
                            'type'              => fldText,
                            'list'              => array(
                                                    1   => 'Створено',
                                                    2   => 'Передано'),
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
                            'orderPosition'     => 20,
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'buh_date',
                            'description'       => 'Бухгалтерія',
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
                            'orderPosition'     => 21,
                            'width'             => 100,
                            'table'             => 'policies_go'),
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
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
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
                            'orderPosition'     => 23,
                            'width'             => 100,
                            'table'             => 'policy_blanks'),
                        array(
                            'name'              => 'comment',
                            'description'       => 'Коментарій',
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
                            'orderPosition'     => 24,
                            'width'             => 100,
                            'table'             => 'policy_blanks')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 23,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'id'
                    )
            );

    function PolicyBlanks($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Бланки';
        $this->messages['single'] = 'Бланк';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'          => true,
                    'insert'        => true,
                    'update'        => true,
                    'view'          => true,
                    'change'        => false,
                    'export'        => true,
                    'exportMTSBU'   => true,
                    'importMTSBU'   => true,
                    'delete'        => true,
                    'importPolicyBlanksList'    =>  true);
                break;
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];

                if ($Authorization->data['id'] == 3531 || $Authorization->data['id'] == 6952) {
                    $this->permissions['insert'] = true;
                }
                else 
                {
                    $this->permissions['insert'] = false;
                }

                break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => false,
                    'view'      => false,
                    'change'    => false,
                    'export'    => true,
                    'delete'    => false);

                $this->formDescription['fields'][ $this->getFieldPositionByName('code') ]['display']['show'] = false;
                $this->formDescription['fields'][ $this->getFieldPositionByName('agencies_id') ]['display']['show'] = false;
                $this->formDescription['fields'][ $this->getFieldPositionByName('buh_date') ]['display']['show'] = false;
                $this->formDescription['fields'][ $this->getFieldPositionByName('mtsbu_date') ]['display']['show'] = false;
                break;
        }
    }

    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Log, $Authorization, $POLICY_STATUSES_SCHEMA;

        $result = parent::checkPermissions($action, $data, $redirect);

        switch ($action) {
            case 'update':

                $this->formDescription['fields'][ $this->getFieldPositionByName('blank_statuses_id') ]['type'] = fldSelect;
                //$this->formDescription['fields'][ $this->getFieldPositionByName('blank_statuses_id') ]['condition'] = 'id IN(' . POLICY_BLANK_STATUSES_CLEAR . ',' . POLICY_BLANK_STATUSES_LOST . ')';

                $conditions[] = (is_array($data['id']))
                    ? 'id = ' . intval($data['id'][0])
                    : 'id = ' . intval($data['id']);

                $sql =  'SELECT insurance_companies_id, product_types_id, blank_statuses_id ' .
                        'FROM ' . $this->tables[0] . ' ' .
                        'WHERE ' . implode(' AND ', $conditions);
                $row = $db->getRow($sql);

    
                break;
        }

        return $result;
    }

    function getFieldNameByOrderPosition($orderPosition) {
        switch ($orderPosition) {
            case '13':
                return 'acts_output_number';
                break;
            case '14':
                return 'acts_output_date';
                break;
            case '16':
                return 'acts_input_number';
                break;
            case '17':
                return 'acts_input_date';
                break;
            default:
                return parent::getFieldNameByOrderPosition($orderPosition);
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

        $this->formDescription['fields'][ $this->getFieldPositionByName('blank_statuses_id') ]['type'] = fldSelect;

        $hidden['do'] = $data['do'];

        $data['redirect'] = $_SERVER['HTTP_ORIGIN'] . '/index.php?do=' . $data['do'];

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
                $fields[] = 'agencies_id';
                $data['agencies_id'] = $Authorization->data['agencies_id'];
                break;
        }

        if (!intval($data['insurance_companies_id'])) {
            $data['insurance_companies_id'] = INSURANCE_COMPANIES_EXPRESS;
        } else {
            $data['redirect'] .= '&insurance_companies_id=' . urlencode($data['insurance_companies_id']);
        }

        $fields[] = 'insurance_companies_id';
        $conditions[] = $this->tables[0] . '.insurance_companies_id = ' . intval($data['insurance_companies_id']);

        if (!intval($data['product_types_id'])) {
            $data['product_types_id'] = PRODUCT_TYPES_GO;
        } else {
            $data['redirect'] .= '&product_types_id=' . urlencode($data['product_types_id']);
        }

        $fields[] = 'product_types_id';
        $conditions[] = PREFIX . '_policy_blanks.product_types_id = ' . intval($data['product_types_id']);

        if ($data['series']) {
            $fields[] = 'series';
            $conditions[] = $this->tables[0] . '.series LIKE ' . $db->quote($data['series'] . '%');
            $data['redirect'] .= '&series=' . urlencode($data['series']);
        }

        if ($data['number']) {
            $fields[] = 'number';
            $conditions[] = $this->tables[0] . '.number LIKE ' . $db->quote($data['number'] . '%');
            $data['redirect'] .= '&number=' . urlencode($data['number']);
        }

        if (intval($data['blank_statuses_id'])) {
            $fields[] = 'blank_statuses_id';
            $conditions[] = 'blank_statuses_id = ' . intval($data['blank_statuses_id']);
            $data['redirect'] .= '&blank_statuses_id=' . urlencode($data['blank_statuses_id']);
        }

        if (intval($data['acts_input_statuses_id'])) {
            $fields[] = 'acts_input_statuses_id';
            $conditions[] = 'acts_input.act_statuses_id = ' . intval($data['acts_input_statuses_id']);
            $data['redirect'] .= '&acts_input_statuses_id=' . urlencode($data['acts_input_statuses_id']);
        }

        if ($data['reported'] === '0') {
            $fields[] = 'reported';
            $conditions[] = 'mtsbu_date = ' . $db->quote('0000-00-00');
            $data['redirect'] .= '&reported=' . urlencode($data['reported']);
        }

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(' . PREFIX . '_policies.begin_datetime) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
            $data['redirect'] .= '&from=' . urlencode($data['from']);
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] =  'TO_DAYS(' . PREFIX . '_policies.begin_datetime) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
            $data['redirect'] .= '&to=' . urlencode($data['to']);
        }

        if (intval($data['agencies_id'])) {
            $Agencies = new Agencies($data);
            $agencies_id = array($data['agencies_id']);
            $Agencies->getSubId(&$agencies_id, $data['agencies_id']);

            $fields[] = 'agencies_id';
            $conditions[] = $this->tables[0] . '.agencies_id IN(' . implode(', ', $agencies_id) . ')';
            $data['redirect'] .= '&agencies_id=' . urlencode($data['agencies_id']);
        }

//$conditions[] = ' mtsbu_date >0 ';
//$conditions[] = ' mtsbu_date<\'2014-10-01\' ';
//$conditions[] = ' acts_input_id   =0 ';




        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        $sql =  'SELECT COUNT(DISTINCT ' . PREFIX . '_policy_blanks.id) ' .
                'FROM ' . PREFIX . '_policy_blanks ' .
                'LEFT JOIN ' . PREFIX . '_companies ON ' . PREFIX . '_policy_blanks.insurance_companies_id = ' . PREFIX . '_companies.id ' .
                'LEFT JOIN ' . PREFIX . '_product_types ON ' . PREFIX . '_policy_blanks.product_types_id = ' . PREFIX . '_product_types.id ' .
                'LEFT JOIN ' . PREFIX . '_policy_blank_statuses ON ' . PREFIX . '_policy_blanks.blank_statuses_id = ' . PREFIX . '_policy_blank_statuses.id ' .
                'LEFT JOIN ' . PREFIX . '_agencies ON ' . PREFIX . '_policy_blanks.agencies_id = ' . PREFIX . '_agencies.id ' .
                'LEFT JOIN ' . PREFIX . '_policies_go ON ' . PREFIX . '_policy_blanks.series = ' . PREFIX . '_policies_go.blank_series AND ' . PREFIX . '_policy_blanks.number = ' . PREFIX . '_policies_go.blank_number ' .
                'LEFT JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_policies_go.policies_id = ' . PREFIX . '_policies.id ' .
                'LEFT JOIN ' . PREFIX . '_policy_statuses ON ' . PREFIX . '_policies.policy_statuses_id = ' . PREFIX . '_policy_statuses.id ' .
                'LEFT JOIN ' . PREFIX . '_policy_payments ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policy_payments.policies_id ' .
                'LEFT JOIN ' . PREFIX . '_policy_blank_acts AS acts_output ON ' . PREFIX . '_policy_blanks.acts_output_id = acts_output.id ' .
                'LEFT JOIN ' . PREFIX . '_policy_blank_acts AS acts_input ON ' . PREFIX . '_policy_blanks.acts_input_id = acts_input.id ';

        if (is_array($conditions)) {
            $sql .= 'WHERE ' . implode(' AND ', $conditions);
        }

        $sql .= ' GROUP BY ' . PREFIX . '_policy_blanks.id';

        $total = sizeOf( $db->getCol($sql) );

        $list = array();

        if ($total > 0) {
            $sql =  'SELECT ' . PREFIX . '_policy_blanks.id, ' . PREFIX . '_policy_blanks.series, ' . PREFIX . '_policy_blanks.number, ' .
                    PREFIX . '_companies.title AS insurance_companies_id, ' .
                    PREFIX . '_agencies.code AS code, ' . PREFIX . '_agencies.title AS agencies_id, ' .
                    PREFIX . '_product_types.title AS product_types_id, ' .
                    PREFIX . '_policy_blank_statuses.title AS blank_statuses_id, ' .
                    PREFIX . '_policies_go.sign AS sign, ' .
                    'date_format(begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS begin_datetime_format, date_format(interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS interrupt_datetime_format, ' . PREFIX . '_policies.amount, ' . PREFIX . '_policies.documents, ' .
                    PREFIX . '_policy_statuses.title AS policy_statuses_id,' . PREFIX . '_policies.insurer,' . PREFIX . '_policies.date as policy_date, ' .
                    'SUM(' . PREFIX . '_policy_payments.amount) AS paid_amount, ' .
                    'date_format(' . PREFIX . '_policies_go.buh_date, ' . $db->quote(DATE_FORMAT) . ') AS buh_date_format, date_format(' . PREFIX . '_policy_blanks.mtsbu_date, ' . $db->quote(DATE_FORMAT) . ') AS mtsbu_date_format, ' .
                    'date_format(' . PREFIX . '_policy_blanks.created, ' . $db->quote(DATE_FORMAT) . ') AS created_format, ' .
                    'acts_output.id AS acts_output_id, acts_output.number AS acts_output_number, date_format(acts_output.date, ' . $db->quote(DATE_FORMAT) . ') AS acts_output_date, acts_output.act_statuses_id AS acts_output_statuses_id, CASE acts_output.act_statuses_id WHEN \'1\' THEN \'створено\' WHEN \'2\' THEN \'передано\' END AS acts_output_statuses_title, ' .
                    'acts_input.id AS acts_input_id, acts_input.number AS acts_input_number, date_format(acts_input.date, ' . $db->quote(DATE_FORMAT) . ') AS acts_input_date, acts_input.act_statuses_id AS acts_input_statuses_id, CASE acts_input.act_statuses_id WHEN \'1\' THEN \'створено\' WHEN \'2\' THEN \'передано\' END AS acts_input_statuses_title, ' .
            PREFIX . '_policy_blanks.comment ' .
                    'FROM ' . PREFIX . '_policy_blanks ' .
                    'LEFT JOIN ' . PREFIX . '_companies ON ' . PREFIX . '_policy_blanks.insurance_companies_id = ' . PREFIX . '_companies.id ' .
                    'LEFT JOIN ' . PREFIX . '_product_types ON ' . PREFIX . '_policy_blanks.product_types_id = ' . PREFIX . '_product_types.id ' .
                    'LEFT JOIN ' . PREFIX . '_policy_blank_statuses ON ' . PREFIX . '_policy_blanks.blank_statuses_id = ' . PREFIX . '_policy_blank_statuses.id ' .
                    'LEFT JOIN ' . PREFIX . '_agencies ON ' . PREFIX . '_policy_blanks.agencies_id = ' . PREFIX . '_agencies.id ' .
                    'LEFT JOIN ' . PREFIX . '_policies_go ON ' . PREFIX . '_policy_blanks.series = ' . PREFIX . '_policies_go.blank_series AND ' . PREFIX . '_policy_blanks.number = ' . PREFIX . '_policies_go.blank_number ' .
                    'LEFT JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_policies_go.policies_id = ' . PREFIX . '_policies.id ' .
                    'LEFT JOIN ' . PREFIX . '_policy_statuses ON ' . PREFIX . '_policies.policy_statuses_id = ' . PREFIX . '_policy_statuses.id ' .
                    'LEFT JOIN ' . PREFIX . '_policy_payments ON ' . PREFIX . '_policies.id = ' . PREFIX . '_policy_payments.policies_id ' .
                    'LEFT JOIN ' . PREFIX . '_policy_blank_acts AS acts_output ON ' . PREFIX . '_policy_blanks.acts_output_id = acts_output.id ' .
                    'LEFT JOIN ' . PREFIX . '_policy_blank_acts AS acts_input ON ' . PREFIX . '_policy_blanks.acts_input_id = acts_input.id ';

            if (is_array($conditions)) {
                $sql .= 'WHERE ' . implode(' AND ', $conditions);
            }

            $sql .= ' GROUP BY ' . PREFIX . '_policy_blanks.id';

            $sql .= ' ORDER BY ';

            $sql .= $this->getShowOrderCondition();

            if ($limit) {
                $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
            }

            $sql = str_replace( PREFIX . '_policies.paid_amount' , 'paid_amount' , $sql );
//_dump($sql);
            $list = $db->getAll($sql);
        }

        $fields['product_types_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('product_types_id') ];
        $fields['product_types_id']['list'] = $this->getListValue($fields['product_types_id'], $data);
        $fields['product_types_id']['object'] = $this->buildSelect($fields['product_types_id'], $data['product_types_id'], null, null, $data);

        $fields['blank_statuses_id'] = $this->formDescription['fields'][ $this->getFieldPositionByName('blank_statuses_id') ];
        $fields['blank_statuses_id']['list'] = $this->getListValue($fields['blank_statuses_id'], $data);
        $fields['blank_statuses_id']['object'] = $this->buildSelect($fields['blank_statuses_id'], $data['blank_statuses_id'], null, null, $data);

        $sql =  'SELECT id, code, title, level ' .
                'FROM ' . PREFIX . '_agencies ' .
                'ORDER BY top, num_l';
        $data['agencies'] = $db->getAll($sql, 60 * 60);

        include $this->object . '/' . $template;

        $PolicyBlankActs = new PolicyBlankActs($data);
        $PolicyBlankActs->show($data);
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        global $Log;

        if (is_null($actionType)) {
            $actionType = $action;
        }

        $this->setListValues($data, $actionType);

        $Log->showSystem();

        if (!is_null($template)) {
            include_once $this->object . '/' . $template;
            return;
        }

        switch ($actionType) {
            case 'view':
                (is_file($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->object . '/view.php'))
                    ? include_once $this->object . '/view.php'
                    : include_once 'view.php';
                break;
            case 'previewInWindow':
                (is_file($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->object . '/previewInWindow.php'))
                    ? include_once $this->object . '/previewInWindow.php'
                    : include_once 'previewInWindow.php';
                break;
            case 'insert':
                include_once $this->object . '/form.php';
                break;
            case 'update':
                include_once 'form.php';
                break;

        }
    }

    function setConstants(&$data) {

        switch ($data['insurance_companies_id']) {

            case INSURANCE_COMPANIES_EXPRESS:
                switch ($data['product_types_id']) {
                    case PRODUCT_TYPES_GO:
                        $data['agencies_id'] = 0;
                        $this->formDescription['fields'][ $this->getFieldPositionByName('agencies_id') ]['verification']['canBeEmpty'] = true;
                        break;
                }
                break;
        }

        if ($data['product_types_id'] == PRODUCT_TYPES_KASKO) {
            $this->formDescription['fields'][ $this->getFieldPositionByName('series') ]['validationRule'] = '^СР$';
            $this->formDescription['fields'][ $this->getFieldPositionByName('number') ]['validationRule'] = '^[0-9]{5}$';
        }

        if ( intval($data['id']) == 0) {
            $data['blank_statuses_id'] = 1;
        }
    }

    function checkFields($data, $action) {
        global $db, $Log;

        parent::checkFields($data, $action);

        switch ($action) {
            case 'insert':

                $field = $this->formDescription['fields'][ $this->getFieldPositionByName('number') ];

                $params = array('Номер бланку з', '');

                if (!ereg($field['validationRule'], $data['from'])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }

                $params = array('Номер бланку по', '');

                if (!ereg($field['validationRule'], $data['to'])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }

                if (!$Log->isPresent()) {

                    $conditions[] = 'series = ' . $db->quote($data['series']);
                    $conditions[] = 'CAST(number AS UNSIGNED) BETWEEN ' . intval($data['from']) . ' AND ' . intval($data['to']);

                    $sql =  'SELECT count(*) ' .
                            'FROM ' . PREFIX . '_policy_blanks ' .
                            'WHERE ' . implode(' AND ', $conditions);
                    if ($db->getOne($sql)) {
                        $Log->add('error', 'Бланки вже існують у вказанному діапазоні.', $params);
                    }
                }
                break;
        }
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log;

        $this->checkPermissions('insert', $data);

        $data = $this->replaceSpecialChars($data, 'insert');

        $this->setConstants($data);

        $this->checkFields($data, 'insert');

        if ($checkFieldsAndReturn) {
            return;
        }

        if ($Log->isPresent()) {
            if ($showForm)
                $this->showForm($data, $GLOBALS['method'], 'insert');
        } else {

            for ($i = $data['from']; $i <= $data['to']; $i++) {

                $number = ($data['product_types_id'] == PRODUCT_TYPES_KASKO) ? sprintf('%05s', $i) : sprintf('%07s', $i);

                $sql =  'INSERT INTO ' . PREFIX . '_policy_blanks SET ' .
                        'insurance_companies_id = ' . intval($data['insurance_companies_id']) . ', ' .
                        'product_types_id = ' . intval($data['product_types_id']) . ', ' .
                        'agencies_id = ' . intval($data['agencies_id']) . ', ' .
                        'series = ' . $db->quote($data['series']) . ', ' .
                        'number = ' . $db->quote( $number ) . ', ' .
                        'blank_statuses_id = ' . intval($data['blank_statuses_id']) . ', ' .
                        'created = NOW(), ' .
                        'modified = NOW()';
                $db->query($sql);
            }

            if ($redirect) {

                $params['title']        = $this->messages['single'];
                $params['id']           = $data['id'];
                $params['storage']      = $this->tables[0];

                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return true;
            }
        }
    }

    function isBlankExists($series, $number, $blank_statuses_id=null, $agencies_id=null) {
        global $db;

        $conditions[] = 'product_types_id = ' . intval(PRODUCT_TYPES_GO);
        $conditions[] = 'series = ' . $db->quote($series);
        $conditions[] = 'number = ' . $db->quote($number);

        if (intval($blank_statuses_id)) {
            $conditions[] = 'blank_statuses_id = ' . intval($blank_statuses_id);
        }

        if (intval($agencies_id)) {
            $conditions[] = 'agencies_id = ' . intval($agencies_id);
        }

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_policy_blanks ' .
                'WHERE ' . implode(' AND ', $conditions);
        $id =   $db->getOne($sql);

        return ($id) ? true : false;
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template=null, $redirect=false) {
        global $db;

        $this->checkPermissions($action, $data);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        if(!$redirect) {
            $pattern = "/^(https:\/\/e-insurance.in.ua\/index.php\?do=PolicyBlanks\|show)".
                "|(http:\/\/e-insurance.in.ua\/index.php\?do=PolicyBlanks\|show)".
                "|(\/index.php\?do=PolicyBlanks\|show)".
                "|(index.php\?do=PolicyBlanks\|show)/";

            if($data['redirect'] && preg_match($pattern, $data['redirect']))
                $redirect = $data['redirect'];
        }

        $identityField = $this->getIdentityField();

        $sql =  'SELECT ' . implode(', ', $this->formFields) . ' ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);

        if($redirect != false)
            $data['redirect'] = $redirect;
        
        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function view($data, $conditions=null, $sql=null, $template=null, $showForm=true) {
        global $db;

        $this->checkPermissions('view', $data);

        $action     = 'view';
        $actionType = ($data['do'] == $this->object . '|previewInWindow') ? 'previewInWindow' : 'view';

        if (!$sql) {
            if (is_array($data['id'])) $data['id'] = $data['id'][0];

            $this->setTables('view');
            $this->getFormFields('view');

            $identityField = $this->getIdentityField();

            $prefix = ($conditions) ? implode(' AND ', $conditions) : '';

            $sql =  'SELECT * ' .
                    'FROM ' . $this->tables[0] . ' ' .
                    'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        }

        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        }

        $data['policy_blanks_id'] = $data['id'];

        unset($data['number']);

        $PolicyBlankActs = new PolicyBlankActs($data);
        $PolicyBlankActs->show($data);
    }

    function get($series, $number, $insurance_companies_id=null) {
        global $db;

        $conditions[] = 'a.product_types_id = ' . PRODUCT_TYPES_GO;
        $conditions[] = 'a.series = ' . $db->quote($series);
        $conditions[] = 'a.number = ' . $db->quote($number);

        if ($insurance_companies_id) {
            $conditions[] = 'a.insurance_companies_id = ' . intval($insurance_companies_id);
        }

        $sql =  'SELECT a.*,b.policies_id ' .
                'FROM ' . PREFIX . '_policy_blanks a ' .
                'LEFT JOIN ' . PREFIX . '_policies_go b ON b.blank_series=a.series AND a.number=b.blank_number ' .
                'WHERE ' . implode(' AND ', $conditions);
        return $db->getRow($sql);
    }

    function exportInWindow($data) {

        $this->checkPermissions('export', $data);

        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        $this->show($data, null, null, null, 'excel.php', false);
        exit;
    }

    function delete($data, $redirect=true, $generateMessage=true, $folder=null) {

        $unsetFields = array(
            'person_types_id',
            'insurer',
            'begin_datetime',
            'policy_statuses_id',
            'amount',
            'paid_amount',
            'documents',
            'buh_date',
            'mtsbu_date');

        foreach($unsetFields as $field) {
            unset($this->formDescription['fields'][ $this->getFieldPositionByName($field) ]);
        }

        return parent::delete($data, $redirect , $generateMessage , $folder );
    }

    function prepareValuesMTSBU($fields, $values) {
        global $REGIONS;

        foreach ($fields as $name) {
            switch ($name) {
                case 'policy_statuses_title':
                    switch ($values['policy_statuses_id']) {
                        case '10'://сформовано
                        case '13'://анульваний
                        case '16'://пролонгований
                            $result[ $name ] = 1;//1 - Укладений
                            break;
                        case '11'://достроково припинений
                            $result[ $name ] = 2;//2 - Достроково припинений
                            break;
                        case '15'://дублікат
                            $result[ $name ] = 3;//3 - Дублікат
                            break;
                        case '17'://переукладений
                            $result[ $name ] = 4;//4 - Переоформлений
                            break;
                    }
                    break;
                case 'terms_title':
                    for ($i=1; $i<13; $i++) {
                        $result['terms_id' . $i] = 'False';
                    }

                    $result['terms_id' . ($values['terms_id'] - 13) ] = 'True';
                    $result[ $name ] = $values['terms_id'] - 12;
                    break;
                case 'terms_id1':
                case 'terms_id2':
                case 'terms_id3':
                case 'terms_id4':
                case 'terms_id5':
                case 'terms_id6':
                case 'terms_id7':
                case 'terms_id8':
                case 'terms_id9':
                case 'terms_id10':
                case 'terms_id11':
                case 'terms_id12':
                    break;
                case 'discount':
                        if ($values['k_car_numbers']>=1) {
                            $result[ $name ] = 0;
                        }
                        elseif ($values['k_car_numbers']>=0.95) {
                            $result[ $name ] = 1;
                        }
                        elseif ($values['k_car_numbers']>=0.9) {
                            $result[ $name ] = 2;
                        }
                        elseif ($values['k_car_numbers']>=0.85) {
                            $result[ $name ] = 3;
                        }
                        elseif ($values['k_car_numbers']>=0.8) {
                            $result[ $name ] = 4;
                        }
                        elseif ($values['k_car_numbers']>=0.75) {
                            $result[ $name ] = 5;
                        }
                        elseif ($values['k_car_numbers']>=0.7) {
                            $result[ $name ] = 6;
                        }
                        else $result[ $name ] = 0;
                    break;
                case 'registration_regions_id':
                    switch ($values['registration_regions_id']) {
                        case '1':
                        case '2':
                        case '3':
                        case '4':
                        case '5':
                            $result[ $name ] = $values['registration_regions_id'];
                            break;
                        case '11':
                            $result[ $name ] = 6;
                            break;
                    }
                    break;
                case 'bonus_malus':
                     $result[ $name ] = $values['bonus_malus'];
                    break;
                case 'k5':
                //     $result[ $name ] = '1,000';
                //    break;
                case 'k1':
                case 'k2':
                case 'k3':
                case 'k4':
                case 'k6':
                case 'k7':
                case 'deductible':
                case 'payed_amount':
                case 'amount_go':
                case 'amount_return':
                    $result[ $name ] = str_replace('.', ',', $values[ $name ]);
                    break;
                case 'dissolved_date':
                    if ($values['policy_statuses_id'] == POLICY_STATUSES_DISSOLVED) {
                        $result[ $name ] = $values['interrupt_date'];
                    }
                    break;
                case 'comment':
                    $result[ $name ] = 'Виданий спеціальний знак серії ' . $values['stiker_series'] . ' № ' . $values['stiker_number'];
                    break;
                case 'limit_life':
                    $result[ $name ] = $values['limit_life'];
                    break;
                case 'limit_property':
                    $result[ $name ] = $values['limit_property'];
                    break;
                case 'resident':
                    $result[ $name ] = 'True';
                    break;
                case 'insurer_passport':
                    $result[ $name ] = ($values['insurer_passport_series'] != '' || $values['insurer_passport_number'] != '') ? 'Паспорт' : '';
                    break;
                case 'insurer_dateofbirth':
                    $result[ $name ] = ($values[ $name ] == '0000-00-00' || $values['person_types_id'] == 2) ? '' : $values[ $name ];
                    break;
                case 'insurer_phone':
                    $result[ $name ] = str_replace(array(' ', '-', '(', ')'), array('', '', '', ''), $values[ $name ]);
                    break;
                case 'insurer_person_types_title':
                    switch ($values['person_types_id']) {
                        case '1':
                            $result[ $name ] = 'Ф';
                            break;
                        case '2':
                            $result[ $name ] = 'Ю';
                            break;
                    }
                    break;
                case 'insurer_identification_code':
                    switch ($values['person_types_id']) {
                        case '1':
                            $result[ $name ] = $values['insurer_identification_code'];
                            break;
                        case '2':
                            $result[ $name ] = $values['insurer_edrpou'];
                            break;
                    }
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
                case 'car_types_title':
                    switch ($values['car_types_id']) {
                        case '1'://Легкові автомобілі
                            if ($values['engine_size'] <= 1600) {//1    A1  легковий автомобіль до 1600 кубічних сантиметрів;
                                $result['car_types_title'] = 1;
                            } elseif ($values['engine_size'] <= 2000) {//2  A2  легковий автомобіль від 1601 до 2000 куб. см.
                                $result['car_types_title'] = 2;
                            } elseif ($values['engine_size'] <= 3000) {//3  A3  легковий автомобіль від 2001 до 3000 куб. см.
                                $result['car_types_title'] = 3;
                            } else {//4 A4  легковий автомобіль більше 3000 куб. см.
                                $result['car_types_title'] = 4;
                            }
                            break;
                        case '2'://Причепи до легкових автомобілів
                            $result['car_types_title'] = 11;
                            break;
                        case '3'://Автобуси
                            if ($values['passengers'] <= 20) {//9   E1  автобуси з кількістю місць до 20 чол. (включно)
                                $result['car_types_title'] = 9;
                            } else {//10    E2  автобуси з кількістю місць більше 20 чол.
                                $result['car_types_title'] = 10;
                            }
                            break;
                        case '4'://Вантажні автомобілі
                            if ($values['car_weight'] <= 2000) {//7 C1  вант. автомобілі вантажопідйомністю до 2т (включ)
                                $result['car_types_title'] = 7;
                            } else {//8 C2  вантажні автомобілі вантажопідйомністю понад 2 т.
                                $result['car_types_title'] = 8;
                            }
                            break;
                        case '5'://Причепи до вантажних автомобілів
                            $result['car_types_title'] = 12;
                            break;
                        case '6':
                        case '7':
                            if ($values['engine_size'] <= 300) {//5 B1  мотоцикли та моторолери до 300 куб. см.
                                $result['car_types_title'] = 5;
                            } else {//6 B2  мотоцикли та моторолери більше 300 куб. см.
                                $result['car_types_title'] = 6;
                            }
                            break;
                    }
                    break;
                case 'sign':
                case 'shassi':
                    $result[ $name ] = str_replace(' ', '', $values[ $name ]);
                    if ($result[ $name ] == '') {
                        $result[ $name ] = 'бн';
                    }
                    break;
                case 'taxi':
                    switch ($values[ $name ]) {
                        case '0':
                        case '2':
                            $result[ $name ] = '1';
                            break;
                        case '1':
                            $result[ $name ] = '2';
                            break;
                    }
                    break;
                case 'otk':
                    $result[ $name ] = ($values['otk'] == '1') ? 'True' : 'False';
                    break;
                case 'otkdate':
                    $result[ $name ] = ($values['otk'] == '1') ? $values['otkdate'] : '';
                    break;
                case 'stage3':
                    if ($values['person_types_id'] == '1') {
                        switch ($values[ $name ]) {
                            case '0':
                                $result[ $name ] = '2';
                                break;
                            case '1':
                                $result[ $name ] = '1';
                                break;
                        }
                    } else {
                        $result[ $name ] = '';
                    }
                    break;
                case 'old':
                    $result[ $name ] = 'false';
                    break;
                case 'auto':
                case 'marka':
                    $result[ $name ] = $values['brand'] . ' ' . $values['model'];
                    break;
                case 'city_name':
                    $result[ $name ] = $values['registration_cities_title'];
                    break;
                default:
                    $result[ $name ] = $values[ $name ];
                    break;
            }
        }

        return $result;
    }

    function exportMTSBU($data) {
        global $db;

        //$this->checkPermissions('exportMTSBU', $data);
    if (!(intval($data['import']) == 1)) {
        $this->checkPermissions('exportMTSBU', $data);
    }

        $fields = array(
            'blank_series',
            'blank_number',
            'policy_statuses_title',
            'begin_datetime',
            'end_datetime',
            'terms_title',
            'policies_date',
            'terms_id1',
            'terms_id2',
            'terms_id3',
            'terms_id4',
            'terms_id5',
            'terms_id6',
            'terms_id7',
            'terms_id8',
            'terms_id9',
            'terms_id10',
            'terms_id11',
            'terms_id12',
            'privileges',
            'discount',
            'registration_regions_id',
            'registration_regions_title',
            'bonus_malus',
            'k1',
            'k2',
            'k3',
            'k4',
            'k5',
            'k6',
            'k7',
            'limit_life',
            'limit_property',
            'deductible',
            'amount_go',
            'payed_amount',
            'comment',
            'dissolved_date',
            'amount_return',
            'blank_series_parent',
            'blank_number_parent',
            'resident',
            'insurer_person_types_title',
            'insurer_identification_code',
            'insurer_lastname',
            'insurer_firstname',
            'insurer_patronymicname',
            'insurer_dateofbirth',
            'insurer_phone',
            'insurer_passport',
            'insurer_passport_series',
            'insurer_passport_number',
            'insurer_zip',
            'insurer_address',
            'registration_cities_title',
            'item',
            'sign',
            'shassi',
            'car_types_title',
            'brands_id',
            'brand',
            'models_id',
            'model',
            'year',
            'taxi',
            'otk',
            'otkdate',
            'stage3',
            'old',
            'auto',
            'marka',
            'city_name','registration_cities_id_mtsbu');

        //выгружаем все договора страхования ГО от Экспресс Страхование по которым бланки не испорчены
        $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
        //$conditions[] = 'a.policy_statuses_id NOT IN(' . POLICY_STATUSES_SPOILT . ')';
//        $conditions[] = 'b.buh_date <> ' . $db->quote('0000-00-00');
      
        //$conditions[] = '(a.modified > d.mtsbu_date OR d.mtsbu_date = \'0000-00-00\')';
//        $conditions[] = '(TO_DAYS(d.mtsbu_date) = TO_DAYS(\'2013.02.01\'))';
        /*if (sizeof($data['id']) && is_array($data['id'])) {
            $conditions[] = 'e.id IN(' . implode(', ', $data['id']) . ')';
        } else {
            $sql = 'SELECT blanks_id FROM import_policy_blanks_list';
            $list = $db->getCol($sql);
            if (sizeof($list) && is_array($list)) {
                $conditions[] = 'e.id IN(' . implode(', ', $list) . ')';
                if ($data['blank_statuses_id'] == POLICY_BLANK_STATUSES_SPOILT) {
                    $conditions[] = 'a.policy_statuses_id IN(' . POLICY_STATUSES_SPOILT . ')';
                } else {
                    $conditions[] = 'a.policy_statuses_id NOT IN(' . POLICY_STATUSES_SPOILT . ')';
                }
            } else {
                $conditions[] = '(a.modified > e.mtsbu_date OR e.mtsbu_date = \'0000-00-00\')';
                $conditions[] = 'a.policy_statuses_id NOT IN(' . POLICY_STATUSES_SPOILT . ')';
                $conditions[] = 'TO_DAYS(a.begin_datetime) <= TO_DAYS(' . $db->quote( date('Y-m-d', mktime(0, 0, 0, date('m'), 0, date('Y'))) ) . ')';
            }
        }*/

        if (intval($data['import']) == 1) {
            foreach($data['conditions'] as $condition) {
                $conditions[] = $condition;
            }
        } else {
            if (sizeof($data['id']) && is_array($data['id'])) {
                $conditions[] = 'e.id IN(' . implode(', ', $data['id']) . ')';
            } else {
                $sql = 'SELECT blanks_id FROM import_policy_blanks_list';
                $list = $db->getCol($sql);
                if (sizeof($list) && is_array($list)) {
                    $conditions[] = 'e.id IN(' . implode(', ', $list) . ')';
                    if ($data['blank_statuses_id'] == POLICY_BLANK_STATUSES_SPOILT) {
                        $conditions[] = 'a.policy_statuses_id IN(' . POLICY_STATUSES_SPOILT . ')';
                    } else {
                        $conditions[] = 'a.policy_statuses_id NOT IN(' . POLICY_STATUSES_SPOILT . ')';
                    }
                } else {
                    $conditions[] = '(a.modified > e.mtsbu_date OR e.mtsbu_date = \'0000-00-00\')';
                    $conditions[] = 'a.policy_statuses_id NOT IN(' . POLICY_STATUSES_SPOILT . ')';
                    $conditions[] = 'TO_DAYS(a.begin_datetime) <= TO_DAYS(' . $db->quote( date('Y-m-d', mktime(0, 0, 0, date('m'), 0, date('Y'))) ) . ')';
                }
            }
        }

        $sql =  'SELECT 
        e.id as policy_blanks_id,
                blank_series,
                blank_number,
                policy_statuses_id,
                date_format(a.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') as begin_datetime,
                date_format(a.end_datetime, ' . $db->quote(DATE_FORMAT) . ') as end_datetime,
                date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as policies_date,
                terms_id,
                privileges,
                b.regions_id AS registration_regions_id,
                j.title as registration_regions_title,
                k1,
                k2,
                k3,
                k4,
                k5,
                k6,
                k7,
                k_car_numbers,
                deductible,
                b.amount_go,
                IF(ISNULL(payed_amount), 0, payed_amount) AS payed_amount,
                a.comment,
                date_format(a.interrupt_datetime, ' . $db->quote(DATE_FORMAT) . ') AS interrupt_date,
                amount_return,
                blank_series_parent,
                blank_number_parent,
                person_types_id,
                insurer_identification_code,
                insurer_edrpou,
                insurer_lastname,
                insurer_firstname,
                insurer_patronymicname,
                date_format(insurer_dateofbirth, ' . $db->quote(DATE_FORMAT) . ') AS insurer_dateofbirth,
                insurer_phone,
                insurer_passport_series,
                insurer_passport_number,
                insurer_zip,
                insurer_regions_id,
                insurer_area,
                insurer_city,
                insurer_street,
                insurer_house,
                insurer_flat,
                item,
                sign,
                shassi,
                car_types_id,
                brands_id,
                brand,
                models_id,
                model,
                year,
                car_weight,
                passengers,
                engine_size,
                stiker_series,
                stiker_number,
                taxi,
                otk,
                date_format(otkdate, ' . $db->quote(DATE_FORMAT) . ') as otkdate,
                stage3,
                f.title as registration_cities_title,bm.title as bonus_malus,
        f.mtsbu_cities_id as registration_cities_id_mtsbu,limit_property,limit_life,

        \'False\' as green_card

                FROM ' . PREFIX . '_policies AS a
                JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id
                JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id = c.id
                LEFT OUTER JOIN (
                    SELECT policies_id, MIN(datetime) AS payment_date, SUM(amount) AS payed_amount
                    FROM ' . PREFIX . '_policy_payments
                    GROUP BY policies_id) AS d ON a.id = d.policies_id
                LEFT JOIN ' . PREFIX . '_policy_blanks AS e ON b.blank_series = e.series AND b.blank_number = e.number
                JOIN ' . PREFIX .'_cities AS f ON b.registration_cities_id = f.id
                JOIN ' . PREFIX .'_parameters_regions AS j ON f.regions_go_id = j.id
                JOIN ' . PREFIX .'_parameters_bonus_malus bm on bm.id=b.bonus_malus_id
                WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY a.id';//_dump($sql);exit;
/*
                 LEFT OUTER JOIN (
                    SELECT policies_id, MIN(created) AS cancel_date
                    FROM ' . PREFIX . '_policy_status_changes
                    WHERE policy_statuses_id = ' . POLICY_STATUSES_DISSOLVED . '
                    GROUP BY policies_id) AS e ON a.id = e.policies_id OR ISNULL(e.policies_id)
 */                                //_dump($sql);exit;           
        $list = $db->getAll($sql);
    
    if (intval($data['import']) == 1) {
        return $list;
    }

        foreach ($list as $i => $row) {
            $list[ $i ] = $this->prepareValuesMTSBU($fields, $row);
        }

        header('Content-Disposition: attachment; filename="policies_mtsbu.xls"');
        header('Content-Type: ' . Form::getContentType('export_policies_mtsbu.xls'));

        include_once $this->object . '/exportMTSBU.php';
    }

    function exportMTSBUInWindow($data) {
        $this->exportMTSBU($data, true);
    }

    function importMTSBU($data){
        global $db, $Log;

        $this->checkPermissions('importMTSBU', $data);

        $method = 'importMTSBU';

        if (is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] && ereg('\.xls$', $_FILES['file']['name'])) {

            require_once 'Excel/reader.php';

            $Excel = new Spreadsheet_Excel_Reader();
            $Excel->setOutputEncoding('utf-8');
            $Excel->read($_FILES['file']['tmp_name']);

            //формируем текст файла Excel для продолжения обработки в случае ошибок
            $result = '<table border="1">';

            for ($i = 1; $i<=count($Excel->sheets[0]['cells']); $i++) {
                $result .= '<tr>';
                $series = '';
                $number = '';

                if ($Excel->sheets[0]['cells'][$i][3] == 'Помилка' || $Excel->sheets[0]['cells'][$i][3] == '') {
                    if(strlen($Excel->sheets[0]['cells'][$i][1]) == 4){

                        $series = $Excel->sheets[0]['cells'][$i][ 1 ];
                        $number = $Excel->sheets[0]['cells'][$i][ 2 ];

                    } elseif(strlen($Excel->sheets[0]['cells'][$i][2] == 4)) {

                        $series = $Excel->sheets[0]['cells'][$i][ 2 ];
                        $number = $Excel->sheets[0]['cells'][$i][ 1 ];
                    } else {
                        $number = 'error';
                    }
                }

                $sql =  'UPDATE ' . PREFIX . '_policy_blanks AS a, ' . PREFIX . '_policies_go AS b, ' . PREFIX . '_policies AS c SET ' .
                        'a.mtsbu_date = NOW() ' .
                        'WHERE a.series = b.blank_series AND a.number = b.blank_number AND b.policies_id = c.id AND a.series = ' . $db->quote( $series ) . ' AND a.number = ' . $db->quote( $number ) . ' AND (c.modified > a.mtsbu_date OR a.mtsbu_date = \'0000-00-00\') ';
                $db->query($sql);

                if ($db->affectedRows() == 1) {
                    $status = 'Оброблено';
                    $updated++;
                    $sql = 'DELETE FROM import_policy_blanks_list WHERE series = ' . $db->quote($series) . ' AND number = ' . $db->quote($number);
                    $db->query($sql);
                } else {
                    $status = 'Помилка';
                    $error++;
                }

                $result .='<td>' . $Excel->sheets[0]['cells'][$i][1] . '</td>';
                $result .='<td>' . $Excel->sheets[0]['cells'][$i][2] . '</td>';
                $result .='<td>' . $status . '</td>';
                $total++;

                $result .='</tr>';
            }

            $result .= '</table>';

            //формируем файл для лога, чтоб в случае ошибок перезалить
            @unlink($_SERVER['DOCUMENT_ROOT'] . '/temp/log.xls');
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/temp/log.xls', '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv=Content-Type content="text/html; charset=utf-8"><meta name=ProgId content=Excel.Sheet>' . $result . '</body></html>');

            $Log->add('confirm', '<b>Файл був оброблений.</b><br /><br /><table><tr></tr><tr><td>Редаговано:</td><td align="right">' . $updated . '</td></tr><tr style="color: #ffffff; font-weight: bold;"><td>Помилки:</td><td align="right">' . $error . '</td></tr><tr style="font-weight: bold;"><td>Всього:</td><td align="right">' . $total . '</td></tr></table><br /><a href="/temp/log.xls">Скачати файл змін</a>' , $params);

            header('Location: ' . $data['redirect']);
            exit;
        }

        include_once $this->object . '/importMTSBU.php';
    }

    function importPolicyBlanksList($data) {
        global $db, $Log;

        $this->checkPermissions('importPolicyBlanksList', $data);

        $method = 'importPolicyBlanksList';

        if (is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] && ereg('\.xls$', $_FILES['file']['name'])) {

            require_once 'Excel/reader.php';

            $Excel = new Spreadsheet_Excel_Reader();
            $Excel->setOutputEncoding('utf-8');
            $Excel->read($_FILES['file']['tmp_name']);

            for ($i = 2; $i<=count($Excel->sheets[0]['cells']); $i++) {

                //if (sizeof($Excel->sheets[0]['cells'][$i][22])) {
                    $series = $Excel->sheets[0]['cells'][$i][1];
                    $number = $Excel->sheets[0]['cells'][$i][2];

                    $sql =  'INSERT INTO import_policy_blanks_list ' .
                            'SET series = ' . $db->quote($series) . ', ' .
                                'number = ' . $db->quote($number);
                    $db->query($sql);

                    $sql = 'UPDATE import_policy_blanks_list as a ' .
                           'JOIN ' . PREFIX . '_policy_blanks as b ON a.series = b.series AND a.number = b.number ' .
                           'SET a.blanks_id = b.id ' .
                           'WHERE a.series = ' . $db->quote($series) . ' AND a.number = ' . $db->quote($number);
                    $db->query($sql);
                //}
            }

            $Log->add('confirm', '<b>Файл був оброблений.</b>' , $params);

            header('Location: ' . $data['redirect']);
            exit;
        }

        include_once $this->object . '/importMTSBU.php';
    }
    
    function getMtsbuDateByPoliciesId($id) {
        global $db;
        
        $sql = 'SELECT date_format(policy_blanks.mtsbu_date, \'%Y-%m-%d\') ' . 
               'FROM ' . PREFIX . '_policy_blanks as policy_blanks ' .
               'JOIN ' . PREFIX . '_policies_go as policies_go ON policy_blanks.series = policies_go.blank_series AND policy_blanks.number = policies_go.blank_number ' .
               'WHERE policies_go.policies_id = ' . intval($id);
        return $db->getOne($sql);
    }
}

?>