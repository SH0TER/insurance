<?
/*
 * Title: paymnets class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */
require_once 'AktsContents.class.php';
require_once 'AktsExpressCreditContents.class.php';
require_once 'AktsScoringContents.class.php';
require_once 'AktsPlanContents.class.php';
require_once 'Agencies.class.php';
require_once 'include/lib/WebServices/XML2Array.php';

define('PRODUCT_TYPES_EK', 999);//консультации ЭК
define('AKT_PERIOD', '.03.17');
class Akts extends Form {

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
                        'table'             => 'akts'),
                    array(
                        'name'              => 'number',
                        'description'       => 'Номер',
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
                                'canBeEmpty'    => false
                            ),
                        'orderPosition'     => 1,
                        'table'             => 'akts'),
                    array(
                        'name'              => 'agreement_number',
                        'description'       => 'Аг. договор',
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
                                'canBeEmpty'    => false
                            ),
                        'orderPosition'     => 2,
                        'table'             => 'akts'),
                    array(
                        'name'              => 'agency',
                        'description'       => 'Агенцiя',
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
                        'orderPosition'     => 2,
                        'table'             => 'akts'),
                    array(
                        'name'              => 'person_types_id',
                        'description'       => 'Тип контрагента',
                        'type'              => fldRadio,
                        'list'              => array(
                            1 => 'фiз особа агент',
                            2 => 'фiз особа директор',
                            3 => 'фiз особа заст. директора',
                            //4 => 'фiз особа керiвник вiдд продажу',
                            6 => 'фiз особа майстер СТО',
                            5 => 'юр особа',
                            8 => 'фiз особа агент сервiс',
                            7 => 'фiз особа заст. директора сервiс'
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
                                'canBeEmpty'    => true
                            ),
                        'table'             => 'akts'),

                    array(
                        'name'              => 'date',
                        'description'       => 'Дата акту',
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
                        'orderPosition'     => 5,
                        'table'             => 'akts'),


                    array(
                        'name'              => 'agent_name',
                        'description'       => 'Агент',
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
                                'canBeEmpty'    => false
                            ),
                        'orderPosition'     => 8,
                        'table'             => 'akts'),
                    array(
                        'name'              => 'amount',
                        'description'       => 'До сплати',
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
                                'canBeEmpty'    => false
                            ),
                        'orderPosition'     => 9,
                        'orderName'         => 'amount',
                        'table'             => 'akts'),
                    array(
                        'name'              => 'sellers_department',
                        'description'       => 'Вiддiл продажу',
                        'type'              => fldBoolean,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true,
                                'change'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'width'             => 100,
                        'table'             => 'akts'),
                    array(
                        'name'              => 'es_department',
                        'description'       => 'Штатний спiвробiтник',
                        'type'              => fldBoolean,
                        'display'           =>
                            array(
                                'show'      => false,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true,
                                'change'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'width'             => 100,
                        'table'             => 'akts'),

                    array(
                        'name'              => 'payment_statuses_id',
                        'description'       => 'Оплата',
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
                                'canBeEmpty'    => true
                            ),
                        'orderPosition'     => 10,
                        'table'             => 'akts',
                        'sourceTable'       => 'payment_statuses',
                        'selectField'       => 'title',
                        'orderField'        => 'order_position'),
                    array(
                        'name'                  => 'file',
                        'description'           => 'Акт',
                        'type'                  => fldFile,
                        'display'               =>
                            array(
                                'show'          => true,
                                'insert'        => false,
                                'view'          => false,
                                'update'        => false
                            ),
                        'verification'          =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'orderPosition'         => 11,
                        'table'                 => 'akts'),
                    array(
                        'name'                  => 'credit_cars',
                        'description'           => 'Кредитнi авто',
                        'type'                  => fldInteger,
                        'display'               =>
                            array(
                                'show'          => true,
                                'insert'        => true,
                                'view'          => true,
                                'update'        => true
                            ),
                        'verification'          =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'table'                 => 'akts'),
                    array(
                        'name'                  => 'not_credit_cars',
                        'description'           => 'Не кредитнi авто',
                        'type'                  => fldInteger,
                        'display'               =>
                            array(
                                'show'          => true,
                                'insert'        => true,
                                'view'          => true,
                                'update'        => true
                            ),
                        'verification'          =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'table'                 => 'akts'),
                    array(
                        'name'                  => 'continued_cars',
                        'description'           => 'Пролонгованi авто',
                        'type'                  => fldInteger,
                        'display'               =>
                            array(
                                'show'          => true,
                                'insert'        => true,
                                'view'          => true,
                                'update'        => true
                            ),
                        'verification'          =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'table'                 => 'akts'),
                    array(
                        'name'                  => 'go_cars',
                        'description'           => 'ЦВ авто',
                        'type'                  => fldInteger,
                        'display'               =>
                            array(
                                'show'          => true,
                                'insert'        => true,
                                'view'          => true,
                                'update'        => true
                            ),
                        'verification'          =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'table'                 => 'akts'),
                    array(
                        'name'                  => 'k',
                        'description'           => 'Коеф. премiя',
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
                                'canBeEmpty'    => true
                            ),
                        'table'                 => 'akts'),
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
                        'orderPosition'     => 12,
                        'table'             => 'akts'),
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
                        'orderPosition'     => 13,
                        'width'             => 100,
                        'table'             => 'akts')
                ),
            'common'    =>
                array(
                    'defaultOrderPosition'  => 5,
                    'defaultOrderDirection' => 'desc',
                    'titleField'            => 'agent_name'
                )
        );

    function Akts($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Акты';
        $this->messages['single'] = 'Акт';
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
                    'change'    => true,
                    'export'    => true,
                    'exportbank'    => true,
                    'delete'    => true);
                break;
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                $this->permissions['export'] = $Authorization->data['permissions'][ get_class($this) ]['exportbank'];
                break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'                  => true,
                    'view'                  => true
                );
                break;
            case ROLES_MASTER:
                $this->permissions = array(
                    'show'                  => true,
                    'view'                  => true
                );
                break;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db, $PAYMENT_STATUSES, $Authorization;
        if ($_SESSION['auth']['agencies_id']==1469 || $_SESSION['auth']['id']==13497) exit;
        $this->checkPermissions('show', $data);

        $hidden['do'] = $data['do'];

        $fields['payment_statuses_id']              = $this->formDescription['fields'][ $this->getFieldPositionByName('payment_statuses_id') ];
        $fields['payment_statuses_id']['type']      = fldMultipleSelect;
        $fields['payment_statuses_id']['list']      = $PAYMENT_STATUSES;
        $fields['payment_statuses_id']['object']    = $this->buildSelect($fields['payment_statuses_id'], $data['payment_statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data);

        $personTypes = array(
            1 => 'фiз особа агент',
            2 => 'фiз особа директор',
            3 => 'фiз особа заст. директора',
            4 => 'фiз особа керiвник вiдд продажу',
            6 => 'фiз особа майстер СТО',
            5 => 'юр особа',
            8 => 'фiз особа агент сервiс',
            7 => 'фiз особа заст. директора сервiс'
        );

        $fields['person_types_id']              = $this->formDescription['fields'][ $this->getFieldPositionByName('person_types_id') ];
        $fields['person_types_id']['type']      = fldMultipleSelect;
        $fields['person_types_id']['list']      = $personTypes;
        $fields['person_types_id']['object']    = $this->buildSelect($fields['person_types_id'], $data['person_types_id'], $data['languageCode'], 'multiple size="3"', null, $data);

        $conditions[] = 'hide = 0';
        if (strlen($data['agent_name'])>0) {
            $search_str=trim($data['agent_name']);
            $search_str.='%';
            $conditions[] = $this->tables[0] . '.agent_name like ' . $db->quote($search_str);
        }

        if (strlen($data['agreement_number'])>0) {
            $search_str=trim($data['agreement_number']);
            $conditions[] = $this->tables[0] . '.agreement_number like ' . $db->quote($search_str);
        }

        if (strlen($data['number'])>0) {
            $search_str=trim($data['number']);
            $conditions[] = $this->tables[0] . '.number like ' . $db->quote($search_str);
        }

        if (is_array($data['payment_statuses_id'])) {
            $fields[] = 'payment_statuses_id';
            $conditions[] = 'payment_statuses_id IN(' . implode(', ', $data['payment_statuses_id']) . ')';
        }

        if (is_array($data['person_types_id'])) {
            $fields[] = 'person_types_id';
            $conditions[] = 'person_types_id IN(' . implode(', ', $data['person_types_id']) . ')';
        }

        if (strlen($data['policy_number'])>0) {
            $search_str=trim($data['policy_number']);
            $conditions[] = PREFIX . '_akts.id IN (SELECT a.akts_id FROM ' . PREFIX . '_akts_contents a JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id WHERE b.number =' . $db->quote($search_str).' '.($data['payed'] ? ' AND a.statuses_id=3  AND a.documents=1 ' : ' ').' )';
        }

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(' . $this->tables[0] . '.date) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] =  'TO_DAYS(' . $this->tables[0] . '.date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }

        if ($Authorization->data['roles_id'] == ROLES_AGENT) {
            $data['agencies_id'] = intval($Authorization->data['agencies_id']);
            $Agencies = new Agencies($data);
            $agencies_id = array($data['agencies_id']);
            $Agencies->getSubId(&$agencies_id, $data['agencies_id']);

            $sql =  'SELECT agreement_number ' .
                'FROM ' . PREFIX . '_agents ' .
                'WHERE LENGTH(agreement_number)>2 AND agencies_id IN(' . implode(', ', $agencies_id) . ')'.
                'UNION ALL '.
                'SELECT agreement_number ' .
                'FROM ' . PREFIX . '_agencies ' .
                'WHERE LENGTH(agreement_number)>2 AND id IN(' . implode(', ', $agencies_id) . ')';

            $agreement_numbers = array();
            $agreement_numbers1 = $db->getCol($sql);

            if (is_array($agreement_numbers1)) {
                foreach($agreement_numbers1 as $r) {
                    $agreement_numbers[] = $db->quote($r);
                }
                $conditions[] = PREFIX . '_akts.agreement_number IN(' . implode(', ', $agreement_numbers) . ')';
            } else {
                $conditions[] = PREFIX . '_akts.agreement_number IN(\'0\')';
            }
        }

        if ($Authorization->data['roles_id'] == ROLES_MASTER) {
            /*$sql =    'SELECT agreement_number ' .
                    'FROM ' . PREFIX . '_masters ' .
                    'WHERE LENGTH(agreement_number)>2 AND car_services_id ='.intval($Authorization->data['car_services_id']);*/
            $sql =  'SELECT agreement_number ' .
                'FROM ' . PREFIX . '_masters ' .
                'WHERE LENGTH(agreement_number)>2 AND accounts_id ='.intval($Authorization->data['id']);
            $agreement_numbers = array();
            $agreement_numbers1 = $db->getCol($sql);

            if (is_array($agreement_numbers1)) {
                foreach($agreement_numbers1 as $r) {
                    $agreement_numbers[] = $db->quote($r);
                }
                $conditions[] = PREFIX . '_akts.agreement_number IN(' . implode(', ', $agreement_numbers) . ')';
            } else {
                $conditions[] = PREFIX . '_akts.agreement_number IN(\'0\')';
            }
        }

        if ($Authorization->data['roles_id'] == ROLES_MANAGER && in_array(33, $Authorization->data['account_groups_id'])) {
            $conditions[] = 'person_types_id = 6';
            $conditions[] = PREFIX . '_akts.id > 24682';
        }

        if ($Authorization->data['roles_id'] == ROLES_MANAGER) {
            if (!$this->permissions['showop']) {//скрыть отдел продаж
                $sql =  'SELECT agreement_number ' .
                    'FROM ' . PREFIX . '_agents ' .
                    'WHERE LENGTH(agreement_number)>2 AND agencies_id =1469 ';

                $agreement_numbers = array();
                $agreement_numbers1 = $db->getCol($sql);

                if (is_array($agreement_numbers1)) {
                    foreach($agreement_numbers1 as $r) {
                        $agreement_numbers[] = $db->quote($r);
                    }
                    $conditions[] = PREFIX . '_akts.agreement_number NOT IN(' . implode(', ', $agreement_numbers) . ')';
                }
            }
        }

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        $sql =  'SELECT 1 as fff,' . PREFIX . '_akts.id, ' . PREFIX . '_akts.number, ' . PREFIX . '_akts.agreement_number, date_format(' . PREFIX . '_akts.date, \'%d.%m.%Y\') AS date_format, ' .
            PREFIX . '_akts.agent_name '.
            ',getAktAmount(' . PREFIX . '_akts.id) as amount ' .
            ' ,'.PREFIX . '_akts.payment_statuses_id, ' . PREFIX . '_payment_statuses.title AS payment_statuses_id, ' .
            PREFIX . '_akts.file, date_format(' . PREFIX . '_akts.created, \'%d.%m.%Y\') AS created_format, ' .
            'date_format(' . PREFIX . '_akts.modified, \'%d.%m.%Y\') AS modified_format ' .
            'FROM ' . PREFIX . '_akts ' .
            'JOIN ' . PREFIX . '_payment_statuses ON ' . PREFIX . '_akts.payment_statuses_id = ' . PREFIX . '_payment_statuses.id ' ;

        $totalsql = $sql .'WHERE ' . implode(' AND ', $conditions);

        $sql .= 'WHERE ' . implode(' AND ', $conditions);

        $sql.= ' ORDER BY ';

        $total  = $db->getOne(transformToGetCount($totalsql));

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }
        $list = $db->getAll($sql);
        $this->changePermissions($total);
        $template = $this->object . '/show.php';
        include $template;

    }

    function setValues($data) {
        global $db;

        $sql =  'DELETE FROM ' . PREFIX . '_payments_amounts ' .
            'WHERE payments_id = ' . intval($data['payments_id']) . '  ';
        $db->query($sql);

        if (is_array($data['prod_types'])) {
            foreach ($data['prod_types'] as $id => $row) {
                $sql =  'INSERT INTO ' . PREFIX . '_payments_amounts SET ' .
                    'payments_id = ' . intval($data['payments_id']) . ', ' .
                    'product_types_id = ' . intval($row['product_types_id']) . ', ' .
                    'value = ' . $db->quote($row['value']);
                $db->query($sql);
            }
        }
    }

    function insert($data, $redirect=true) {
        global $Log,$db;

        $data = $this->replaceSpecialChars($data, 'insert');

        $id = parent::insert($data, false);

        if (!$Log->isPresent() && $id) {

            $params['title']        = $this->messages['single'];
            $params['id']           = $id;
            $params['storage']      = $this->tables[0];

            $sql='UPDATE '.PREFIX.'_akts a SET a.file=\'1\' WHERE a.id='.intval($id);
            $db->query($sql);

            if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $params['id'];
            }
        }
    }

    function view($data) {

        $row = parent::view($data);

        $data['akts_id'] = $row['id'];

        $fields[]       = 'akts_id';
        $conditions[]   = 'akts_id=' . intval($data['id']);

        $AktsContents = new AktsContents($data);
        $AktsContents->show($data, $fields, $conditions);

        $AktsPlanContents = new AktsPlanContents($data);
        $AktsPlanContents->show($data, $fields, $conditions);

        $AktsExpressCreditContents = new AktsExpressCreditContents($data);
        $AktsExpressCreditContents->show($data, $fields, $conditions);


        /*$AktsScoringContents = new AktsScoringContents($data);
        $AktsScoringContents->show($data, $fields, $conditions);*/
    }

    function update($data, $redirect=true) {
        global $Log;

        $data = $this->replaceSpecialChars($data, 'update');

        $id = parent::update($data, false);

        if (!$Log->isPresent() && $id) {

            $params['title']        = $this->messages['single'];
            $params['id']            = $id;
            $params['storage']        = $this->tables[0];


            if ($redirect) {
                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            }

            return $params['id'];
        }
    }

    function createPaymentInWindow() {
        global $data;

        $this->checkPermissions('change', $data);
        $this->createPayment($data['number'], $data['id']);

        echo 'Done';
    }

    private $predel_NDFL1 = 23426;
    private $predel_NDFL2 = 13780;
    private $stavka_NDFL = 0.15;
    private $stavka_NDFL2 = 0.2;

    private $comission_master = 62.11;
    private $comission_investigation = 62.12;

    private function calculateESV($amount) {
        return 0;
        $esv = $amount>$this->predel_NDFL1 ?  $this->predel_NDFL1*0.026 : $amount*0.026;
        $esv = round($esv, 2);
        return $esv;
    }

    private function calculateNDFL($amount) {

        return $amount*0.18;
        $amount1 = $amount-$this->calculateESV($amount);
        $ndfl = $amount1 > $this->predel_NDFL2 ? ($amount1-$this->predel_NDFL2)*$this->stavka_NDFL2 + $this->predel_NDFL2*$this->stavka_NDFL : $amount1*$this->stavka_NDFL;
        $ndfl= round($ndfl, 2);
        return $ndfl;
        /*$base1=$amount-$this->calculateESV($amount);
        $nalog = 0;
        if ($base1<0) $base1=0;
        if ($amount>$this->predel_NDFL2)
        {
            $base = $amount>$this->predel_NDFL1 ? $this->predel_NDFL1 : $amount;
            $nalogNDFO1 = $this->predel_NDFL2*$this->calculateESV($amount)/$base;
            $nalogNDFO2 = $this->calculateESV($amount)-$nalogNDFO1;

            $nalog1 = ($this->predel_NDFL2- $nalogNDFO1)*$this->stavka_NDFL;
            $nalog2 = ($amount- $this->predel_NDFL2-$nalogNDFO2)*$this->stavka_NDFL2;
            $nalog = $nalog1 + $nalog2;
            
        }
        else $nalog = $base1*$this->stavka_NDFL;

        if ($nalog<0) $nalog = 0;
        return round($nalog,2);*/
    }

    private function calculateMilitary($amount) {
        return round($amount*0.015, 2);
    }

    protected function createPayment($number, $id, $payment_types_id) {
        global $db, $MONTHES;

        $sql =  'SELECT id, payment_statuses_id ' .
            'FROM ' . PREFIX . '_payments_calendar ' .
            'WHERE number = ' . $db->quote($number).' AND payment_types_id='.intval($payment_types_id);
        $row = $db->getRow($sql);

        if (is_array($row) && $row['payment_statuses_id'] > PAYMENT_STATUSES_NOT) {
            return; //есть платеж и уже были движения денег
        }

        if ($payment_types_id==6)
            $data = $this->getMaster(array('id'=>$id));
        else
            $data = $this->get(array('id'=>$id));

        if (!$data) return;

        //КАСКО + ГО + ДГО физ лица выплата по АКТу
        $sql = 'SELECT SUM(commission_amount_white) as amount FROM insurance_akts_contents WHERE statuses_id>=3 and akts_id='.intval($id);
        $amount = doubleval($db->getOne($sql));
        //прескоринг
        //$sql = 'SELECT SUM(commission_amount_white) as amount FROM insurance_akts_scoring_contents WHERE akts_id='.intval($id);
        $amount_scoring = 0;
        //выплаты по Экспресс кредиту
        $sql = 'SELECT SUM(commission_amount_white) as amount FROM insurance_akts_express_credit_contents WHERE akts_id='.intval($id);
        $amount_ek = doubleval($db->getOne($sql));

        $amount = $amount + $amount_scoring + $amount_ek;

        if ($amount<1) return;

        $fop_id = 0;
        if ($data['person_types_id']==5) //юр лицо
        { //загружаем данные юр лица
            $sql =  'SELECT * ' .
                'FROM insurance_agencies ' .
                'WHERE agreement_number = ' . $db->quote($data['agreement_number']);
            $agency = $db->getRow($sql);

            if ($agency['director_fop_id']>0)
                $fop_id = $agency['director_fop_id'];
        }

        //загружаем данные физ лица
        $sql =  'SELECT a.*, date_format(a.agreement_date, ' . $db->quote('%d.%m.%y') . ') AS agreement_date_date_format,b.lastname,b.firstname,b.patronymicname ' .
            'FROM ' . PREFIX . ($data['person_types_id']==6 ? '_masters' : '_agents').' a JOIN ' . PREFIX . '_accounts b ON b.id=a.accounts_id ' .
            'WHERE '.($data['person_types_id']==5 ? 'a.accounts_id='.intval($fop_id) : 'a.agreement_number='.$db->quote($data['agreement_number'])).' ORDER BY b.active DESC ';
        $agent = $db->getRow($sql);
        if (!$agent && !$agency) return;

        if ($amount>0) {

            $sql = 'SELECT b.product_types_id, SUM(commission_amount_white) as amount FROM insurance_akts_contents a JOIN insurance_policies b on b.id=a.policies_id WHERE a.statuses_id>=3 AND a.documents=1 AND akts_id='.intval($id).' GROUP BY b.product_types_id';

            $amount = 0;

            $amounts = $db->getAssoc($sql);

            foreach ($amounts as $a) $amount += $a;

            $amount = $amount +  $amount_scoring + $amount_ek;
            if ($amount_scoring>0 ||  $amount_ek>0) //скоринг и ЭК включаем в сумму ГО Как вид страхования Транспорт =1
            {
                //if (!isset($amounts[PRODUCT_TYPES_GO])) $amounts[PRODUCT_TYPES_GO] = $amount_scoring + $amount_ek;
                //else $amounts[PRODUCT_TYPES_GO] = $amounts[PRODUCT_TYPES_GO] + $amount_scoring + $amount_ek;
                $amounts[1] = $amount_scoring + $amount_ek;
            }
        }

        $aktamount = $amount;

        $amount = $amount-$this->calculateESV($amount)-$this->calculateNDFL($amount)-$this->calculateMilitary($amount);

        ereg('(.+)\.([0-9]{1,2})\.([0-9]{1,2})$', $number, $regs);

        $date['month']    =    intval($regs[2]);
        $date['year']    =    '20' . $regs[3];

        $row['aktdate']     = $MONTHES[ $date['month'] - 1 ] . ' ' . $date['year'];
        $row['aktnumber']   = $data['aktnumber'];
        $row['lastday']     = date('d.m.y', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));
        $akt_date = date('Y-m-d', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));

        $agent['bank_reference'] = str_replace ( '(поповнення рахунку)' , '' , $agent['bank_reference'] );
        $agent['bank_reference'] = str_replace ( 'Перерахування' , 'Перерах' , $agent['bank_reference'] );
        $agent['bank_reference'] = str_replace ( 'подальшим' , 'подал.' , $agent['bank_reference'] );
        $agent['bank_reference'] = str_replace ( 'зарахуванням' , 'зарах.' , $agent['bank_reference'] );
        $agent['bank_reference'] = str_replace ( 'рахунку' , 'рах.' , $agent['bank_reference'] );
        $agent['bank_reference'] = str_replace ( 'поповнення' , 'попов.' , $agent['bank_reference'] );
//$agent['agreement_date_date_format'] = '01.01.2013';
        $comment='Ком.винаг. за '.$row['aktdate'].' р. з-но дог.№'.$agent['agreement_number'].' від '.$agent['agreement_date_date_format'].'р. '.$agent['bank_reference'].',ІПН '.$agent['identification_code'].' Без ПДВ';
        if ($data['person_types_id']==6) //мастера
            $comment='Винаг. за '.$row['aktdate'].' р. по дог. ЦПХ №'.$agent['agreement_number'].' від '.$agent['agreement_date_date_format'].'р. '.$agent['bank_reference'].',ІПН '.$agent['identification_code'].' Без ПДВ';

        $agent['bank'] = $agent['recipient'];

        if ($agency)
        {
            $agent['recipient'] = $agency['title'];
            $agent['zkpo'] =  $agency['edrpou'];

            $agent['bank_account'] = $agency['bank_account'];
            $agent['mfo'] = $agency['bank_mfo'];
            $agent['bank'] = $agency['bank'];
            $agent['agreement_number'] = $agency['agreement_number'];
            $agent['agreement_date'] = $agency['agreement_date'];
            $amount = $aktamount ;
        }

        $sql= ($row['id'] ? ' UPDATE ' : ' INSERT INTO ').PREFIX.'_payments_calendar SET '.
            'number =' . $db->quote($number) . ', ' .
            'contragent = ' . $db->quote($agent['recipient']) . ', ' .
            'person_types_id = 2, ' .
            'account_number = ' . $db->quote($agent['bank_account']) . ', ' .
            'mfo = ' . $db->quote($agent['mfo']) . ', ' .
            'bank = ' . $db->quote($agent['bank']) . ', ' .
            'code = ' . $db->quote($agent['zkpo']) . ', ' .
            'agents_lastname = ' . $db->quote($agent['lastname']) . ', ' .
            'agents_firstname = ' . $db->quote($agent['firstname']) . ', ' .
            'agents_patronymicname = ' . $db->quote($agent['patronymicname']) . ', ' .
            'agents_identification_code = ' . $db->quote($agent['identification_code']) . ', ' .
            'agreement_number = ' . $db->quote($agent['agreement_number']) . ', ' .
            'agreement_date = ' . $db->quote($agent['agreement_date']) . ', ' .
            'akt_date = ' . $db->quote($akt_date) . ', ' .
            'akt_amount = ' . $db->quote($aktamount) . ', ' .
            'agencies_name = ' . $db->quote($agency['title']) . ', ' .
            'agencies_edrpou = ' . $db->quote($agency['edrpou']) . ', ' .
            'payment_statuses_id = 1, ' .
            'payment_types_id = '.($data['person_types_id']==6 ? '6' : '5').', ' .
            'modified = NOW(), '.
            ($row['id'] ? ' ' : ' created=NOW(), ') .
            'comment = ' . $db->quote($comment) . ', ' .
            'amount = ' . $db->quote($amount) . ' ' .
            ($row['id'] ? ' WHERE id = ' . intval($row['id']) : '');
        $db->query($sql);

        if (!intval($row['id'])) $row['id'] = mysql_insert_id();

        $sql =  'DELETE FROM ' . PREFIX . '_payments_amounts ' .
            'WHERE payments_id = ' . intval($row['id']);
        $db->query($sql);

        if (is_array($amounts)) {
            foreach ($amounts as $prodid => $amount) {
                $sql =  'INSERT INTO ' . PREFIX . '_payments_amounts SET ' .
                    'payments_id = ' . intval($row['id']) . ', ' .
                    'product_types_id = ' . intval($prodid) . ', ' .
                    'value = ' . $db->quote($amount);
                $db->query($sql);
            }
        }
    }

    function getList($data) {
        global $db;

        $product_types = array(
            PRODUCT_TYPES_KASKO,
            PRODUCT_TYPES_GO,
            PRODUCT_TYPES_DGO);

        $sql =  'SELECT id, title ' .
            'FROM ' . PREFIX . '_product_types ' .
            'WHERE id IN (' . implode(', ', $product_types) . ') ' .
            'ORDER BY id';
        $prod_types = $db->getAssoc($sql);

        $result = '<tr><td>&nbsp;</td><td><b>ПО ВИДАМ СТРАХУВАННЯ:</b></td></tr>';

        $result .= '<tr><td>&nbsp;</td><td><table id="producttypes" cellspacing="0" cellpadding="5" style="border: solid 1px #000000;;">';
        $result .= '<tr class="columns"><td>Вид</td><td>Сума</td><td style="padding-left: 8px;"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" onclick="addProdTypes(this)" /></td></tr>';

        if (!is_array($data['prod_types'])) {
            $conditions[] = 'payments_id = ' . intval($data['id']);
            $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_payments_amounts  ' .
                'WHERE ' . implode(' AND ', $conditions);
            $data['prod_types'] = $db->getAll($sql);
        }

        $i = 0;
        if (is_array($data['prod_types'])) {
            foreach ($data['prod_types'] as $i=>$row) {

                if ($row['id'] == NULL) $row['id'] = $i;

                $result .=
                    '<tr>' .
                    '<td><select name="prod_types[' . $row['id'] . '][product_types_id]" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';">';
                foreach ($prod_types as $j=>$prod_type) {
                    $result .='<option value="'.$j.'" '.($row['product_types_id']==$j ? 'SELECTED': '').'>'.$prod_type.'</option>';
                }

                $result .='</select></td>'.
                    '<td><input type="text" name="prod_types[' . $row['id'] . '][value]" value="' . $row['value'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
                    '<td><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deleteProdTypes(this)" /></td>' .
                    '</tr>';
            }
        }

        $result .= '</table>';

        return $result;
    }

    private function get($data) {
        global $db;

        $conditions[] = 'person_types_id <> 6';

        if ($data['id'])
            $conditions[] = 'id='.intval($data['id']);
        elseif($data['number'])
            $conditions[] = 'number='.$db->quote($data['number']);

        return $db->getRow('SELECT id,number,number as aktnumber,k,agreement_number,person_types_id,date as beginDate,MONTH(date) as aktmonth,YEAR(date) as aktyear,DATE_SUB(DATE_ADD(date, INTERVAL 1 MONTH),INTERVAL 1 SECOND) as endDate,credit_cars,not_credit_cars,continued_cars,go_cars,payment_statuses_id,sellers_department FROM insurance_akts WHERE ' . implode(' AND ', $conditions));
    }

    private function getMaster($data) {
        global $db;

        $conditions[] = 'person_types_id = 6';

        if ($data['id'])
            $conditions[] = 'id='.intval($data['id']);
        elseif($data['number'])
            $conditions[] = 'number='.$db->quote($data['number']);

        return $db->getRow('SELECT id, number, number as aktnumber, k, agreement_number, person_types_id, date as beginDate, MONTH(date) as aktmonth, YEAR(date) as aktyear, DATE_SUB(DATE_ADD(date, INTERVAL 1 MONTH),INTERVAL 1 SECOND) as endDate, credit_cars, not_credit_cars, continued_cars, go_cars, payment_statuses_id FROM insurance_akts WHERE ' . implode(' AND ', $conditions));
    }

    function change($data, $redirect = true) {
        global $db, $Log;

        $this->checkPermissions('change', $data);

        $this->setChangeFields();

        $ids = array();

        if (is_array($data['id']) && sizeOf($data['id']) > 0) {

            $modified = $this->formDescription['fields'][ $this->getFieldPositionByName('modified') ];

            foreach($data['id'] as $id ) {
                $ids[] = $id;
                $modified_akt = $this->generateAkt(array('id'=>$id));
                if ($modified && $modified_akt) {
                    $sql = 'UPDATE ' . PREFIX . '_' . $modified['table'] . ' SET modified = NOW() WHERE id = ' . intval($id);
                    $db->query($sql);
                }
            }

            if ($redirect) {
                $params['title'] = $this->messages['plural'];
                $params['storage'] = $this->tables[0];
                $Log->add('confirm', $this->messages['change']['confirm'], $params, '', true);
            }
        }

        if ($redirect) {
            ($data['redirect'])
                ? header('Location: ' . $data['redirect'])
                : header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        return $ids;
    }

    function generateCalendarInWindow($data) {
        global $db;

        $this->checkPermissions('change', $data);

        $sql = 'SELECT id, number, person_types_id FROM insurance_akts  WHERE number like \'%'.AKT_PERIOD.'\'';
        $akts = $db->getAll($sql);

        foreach($akts as $akt) {
            $this->createPayment($akt['number'], $akt['id'], $akt['person_types_id']==6 ? 6 : 5);
        }

        echo 'done';
    }

    function generateAktsInWindow($data) {
        global $db;

        $this->checkPermissions('change', $data);

        //$this->generateAkt(array('agreement_number'=>'11442'));exit;
        $sql='SELECT DISTINCT a.agreement_number FROM '.PREFIX.'_agents a JOIN '.PREFIX.'_accounts b ON b.id=a.accounts_id JOIN '.PREFIX.'_agencies c on c.id=a.agencies_id WHERE c.id<>1469 and b.active=1 AND LENGTH(a.agreement_number)>1 GROUP BY a.agreement_number';

        /*$sql='SELECT DISTINCT a.agreement_number FROM '.PREFIX.'_agents a JOIN '.PREFIX.'_accounts b ON b.id=a.accounts_id JOIN '.PREFIX.'_agencies c on c.id=a.agencies_id WHERE c.id<>1469 and b.active=1 AND LENGTH(a.agreement_number)>1 
        and a.agreement_number not in (select agreement_number from  insurance_akts where number like \'%'.AKT_PERIOD.'\')
        GROUP BY a.agreement_number';*/
        //_dump($sql);exit;
        $akts=$db->getAll($sql);
        foreach($akts as $akt) {
            $this->generateAkt(array('agreement_number'=>$akt['agreement_number']));
        }

        $builttime = time();
        $dat = getdate($builttime);
        $dat['mon']--;


        if ($dat['mon'] == 0) {
            $dat['mon'] = 12;
            $dat['year']--;
        }

        $sql = "update insurance_akts_contents a
        join insurance_akts b on b.id=a.akts_id
        join insurance_policies c on c.id=a.policies_id
        join insurance_policies_kasko c1 on c1.policies_id=a.policies_id
        join insurance_agencies d on d.id=c.agencies_id
        set a.commission_amount=a.payment_amount*1/100,a.commission_percent=1

        where b.number like '%.".sprintf('%02d', $dat['mon']).".".substr($dat['year'], 2)."' and a.types_id = 1 and b.person_types_id=2   and d.individual_motivation=1 and  outside_client=1;";
        $db->query($sql);

        //-- КАСКО  Зам 1%
        $sql = "update insurance_akts_contents a
        join    insurance_akts b on b.id=a.akts_id
        join insurance_policies c on c.id=a.policies_id
        join insurance_policies_kasko c1 on c1.policies_id=a.policies_id
        join insurance_agencies d on d.id=c.agencies_id
        set a.commission_amount=a.payment_amount*1/100,a.commission_percent=1

        where b.number like '%.".sprintf('%02d', $dat['mon']).".".substr($dat['year'], 2)."' and a.types_id = 1 and b.person_types_id=3   and d.individual_motivation=1 and  outside_client=1";
        $db->query($sql);

        //-- КАСКО Агент 20%

        $sql = "update insurance_akts_contents a
        join    insurance_akts b on b.id=a.akts_id
        join insurance_policies c on c.id=a.policies_id
        join insurance_policies_kasko c1 on c1.policies_id=a.policies_id
        join insurance_agencies d on d.id=c.agencies_id
        set a.commission_amount=a.payment_amount*20/100,a.commission_percent=20

        where b.number like '%.".sprintf('%02d', $dat['mon']).".".substr($dat['year'], 2)."' and a.types_id = 1 and b.person_types_id=1   and d.individual_motivation=1 and  outside_client=1";
        $db->query($sql);



        //--директор ГО Директор 1%

        $sql = "update insurance_akts_contents a
        join    insurance_akts b on b.id=a.akts_id
        join insurance_policies c on c.id=a.policies_id
        join insurance_policies_go c1 on c1.policies_id=a.policies_id
        join insurance_agencies d on d.id=c.agencies_id
        set a.commission_amount=a.payment_amount*1/100,a.commission_percent=1

        where b.number like '%.".sprintf('%02d', $dat['mon']).".".substr($dat['year'], 2)."' and a.types_id = 1 and b.person_types_id=2   and d.individual_motivation=1 and  outside_client=1";
        $db->query($sql);

        //-- ГО  Зам 1%

        $sql = "update insurance_akts_contents a
        join    insurance_akts b on b.id=a.akts_id
        join insurance_policies c on c.id=a.policies_id
        join insurance_policies_go c1 on c1.policies_id=a.policies_id
        join insurance_agencies d on d.id=c.agencies_id
        set a.commission_amount=a.payment_amount*1/100,a.commission_percent=1

        where b.number like '%.".sprintf('%02d', $dat['mon']).".".substr($dat['year'], 2)."' and a.types_id = 1 and b.person_types_id=3   and d.individual_motivation=1 and  outside_client=1";
        $db->query($sql);

        //-- ГО Агент 16%

        $sql = "update insurance_akts_contents a
        join    insurance_akts b on b.id=a.akts_id
        join insurance_policies c on c.id=a.policies_id
        join insurance_policies_go c1 on c1.policies_id=a.policies_id
        join insurance_agencies d on d.id=c.agencies_id
        set a.commission_amount=a.payment_amount*16/100,a.commission_percent=16

        where b.number like '%.".sprintf('%02d', $dat['mon']).".".substr($dat['year'], 2)."' and a.types_id = 1 and b.person_types_id=1   and d.individual_motivation=1 and  outside_client=1";
        $db->query($sql);
    }

    function generateSellersAktsInWindow($data) {
        global $db;

        $this->checkPermissions('change', $data);

        $sql='SELECT DISTINCT a.agreement_number FROM '.PREFIX.'_agents a JOIN '.PREFIX.'_accounts b ON b.id=a.accounts_id JOIN '.PREFIX.'_agencies c on c.id=a.agencies_id WHERE   c.id=1469 and b.active=1 AND LENGTH(a.agreement_number)>1 GROUP BY a.agreement_number';

        $akts=$db->getAll($sql);
        foreach($akts as $akt) {
            $this->generateSellersAkt(array('agreement_number'=>$akt['agreement_number']));
        }
    }

    function generateMastersAktsInWindowCustom($data) {
        global $db;

        $this->checkPermissions('change', $data);

        //Акты, которые обрабатываем
        $akts[] = array('agreement_number' => '063-МП');


        //Полиса которые должны попасть в акт (через "Повідомлення")

        //doc - 1, принято только заявление (сумма 62,11 на 07.12.2016)
        //doc - 2, выполнен только осмотр (сумма 62,12 на 07.12.2016)
        //doc - 3, выполнены оба пункта (сумма 124,23 на 07.12.2016)

        //number - номер уведомления (даёт Арзяева)
        $policies['063-МП'][] = array(
            'number'    =>  '16.4548',
            'doc'       =>  1,
        );
        $policies['063-МП'][] = array(
            'number'    =>  '16.4519',
            'doc'       =>  3,
        );
        $policies['063-МП'][] = array(
            'number'    =>  '16.4509',
            'doc'       =>  1,
        );

        foreach($akts as $akt) {

            $list = array();

            foreach ($policies[$akt['agreement_number']] as $policy) {

                $sql = "SELECT a.id as id, IF(a.policies_kasko_id = 0, a.policies_go_id, a.policies_kasko_id) as policies_id, ".
                "b.number as number, ".$policy['doc']." as doc_type, 1 as manual ".
                "FROM insurance_application_accidents a ".
                "JOIN insurance_policies b ON a.policies_kasko_id = b.id OR a.policies_go_id = b.id ".
                "WHERE a.number = '".$policy['number']."'";

                $list[] = $db->getRow($sql);
            }

            $this->generateMasterAkt(array('agreement_number'=>$akt['agreement_number']), $list);

            unset($list);
        }
    }

    function generateMastersAktsInWindow($data) {
        global $db;

        $this->checkPermissions('change', $data);

        $sql = 'SELECT DISTINCT a.agreement_number FROM '.PREFIX.'_masters a JOIN '.PREFIX.'_accounts b ON b.id=a.accounts_id  WHERE b.active=1 AND LENGTH(a.agreement_number)>1 GROUP BY a.agreement_number';
        $akts = $db->getAll($sql);

        foreach($akts as $akt) {
            $this->generateMasterAkt(array('agreement_number'=>$akt['agreement_number']));
        }
    }

    function generateMasterAkt($data, $policies = null) {
        global $db;
        $this->checkPermissions('change', $data);

        if ($data['id']) {
            $row = $this->getMaster($data);
        } elseif ($data['agreement_number']) {
            $buildtime = time();
            $date = getdate($buildtime);
            $date['mon']--;

            if ($date['mon'] == 0) {
                $date['mon'] = 12;
                $date['year']--;
            }

            $aktnumber = $data['agreement_number'] . '.' . (sprintf('%02d', $date['mon'])) . '.' . substr($date['year'], 2);
            $data['number'] = $aktnumber;
            $row = $this->getMaster($data);

            if (!$row) {//нет акта создаем новый

                $sql =  'SELECT accounts_id, CONCAT(lastname, \' \', firstname) AS fio ' .
                    'FROM ' . PREFIX  . '_accounts AS a ' .
                    'JOIN ' . PREFIX . '_masters AS b ON a.id = b.accounts_id ' .
                    'WHERE agreement_number = ' . $db->quote($data['agreement_number']);
                $agents = $db->getAll($sql);

                if (!$agents) return;
                $accounts_id = array();

                foreach($agents as $agent) {
                    $agent_name = $agent['fio'];
                    $accounts_id[]=$agent['accounts_id'];
                }


                $row['agreement_number'] = $data['agreement_number'];
                $row['number'] = $aktnumber;
                $row['date'] = '20'.substr($date['year'], 2).'-' . sprintf('%02d', $date['mon']) . '-01';
                $row['date_year'] = '20'.substr($date['year'], 2);
                $row['date_month'] =  sprintf('%02d', $date['mon']);
                $row['date_day'] =  '01';
                $row['person_types_id'] = 6;
                $row['payment_statuses_id'] = 1;
                $row['agent_name'] = $agent_name;
                $row['file'] = 1;
                $row['k']=1;
                $row['id'] = $this->insert($row,false);
                $row = $this->getMaster($row);
            }
        }

        if (!$row) return;

        //чистим содержимое акта
        $db->query('DELETE FROM insurance_akts_contents WHERE manual=0 and akts_id='.intval($row['id']));

        $sdate = '\'2017-04-01\'';




        $sql = '
                SELECT id,policies_id,number,SUM(doc_type) as doc_type FROM (
                    SELECT a.id,IF(a.policies_kasko_id>0,a.policies_kasko_id,a.policies_go_id) as policies_id,c.number,1 as doc_type
                    FROM insurance_application_accidents a
                    JOIN insurance_policies c ON c.id=IF(a.policies_kasko_id>0,a.policies_kasko_id,a.policies_go_id)
                    LEFT JOIN (SELECT application_accidents_id,b1.id FROM insurance_akts a1 JOIN insurance_akts_contents b1 ON b1.akts_id=a1.id AND a1.payment_statuses_id=3 AND person_types_id=6 AND application_accidents_id>0 AND a1.agreement_number='.$db->quote($row['agreement_number']).')  b ON a.id=b.application_accidents_id
                    WHERE a.statuses_id>1 AND a.created>=\'2015-06-20\' AND a.created<'.$sdate.' AND b.id IS NULL AND creator_id IN (SELECT accounts_id FROM insurance_masters WHERE agreement_number ='.$db->quote($row['agreement_number']).')
                    UNION
                    SELECT a.id,IF(a.policies_kasko_id>0,a.policies_kasko_id,a.policies_go_id) as policies_id,c.number,2 as doc_type
                    FROM insurance_application_accidents a
                    JOIN insurance_policies c ON c.id=IF(a.policies_kasko_id>0,a.policies_kasko_id,a.policies_go_id)
                    LEFT JOIN (SELECT application_accidents_id,b1.id FROM insurance_akts a1 JOIN insurance_akts_contents b1 ON b1.akts_id=a1.id AND a1.payment_statuses_id=3 AND person_types_id=6 AND application_accidents_id>0 AND a1.agreement_number='.$db->quote($row['agreement_number']).' )  b ON a.id=b.application_accidents_id
                    WHERE a.statuses_id>1 AND a.created>=\'2015-06-20\' AND a.created<'.$sdate.' AND b.id IS NULL AND inspecting_accounts_id IN (SELECT accounts_id FROM insurance_masters WHERE agreement_number ='.$db->quote($row['agreement_number']).')
                ) T
                GROUP BY id, policies_id, number';

        //application_accidents_id

        $factData = $db->getAll($sql);

        if($policies && count($policies) >= 1) {
            foreach ($policies as $policy) {
                $check = false;
                foreach ($factData as $key => $fact) {
                    if($fact['id'] == $policy['id']) {
                        $factData[$key] = $policy;
                        $check = true;
                        break;
                    }
                }

                if(!$check)
                    $factData[] = $policy;
            }
        }

        unset($sql);

        $e = array();
        foreach($factData as $r) {
            //заполняем часть к оплате

            $AktsContents = new AktsContents($data);
            unset($AktsContents->formDescription['fields'][ $AktsContents->getFieldPositionByName('payments_calendar_id') ]);
            $AktsContents->formDescription['fields'][ $AktsContents->getFieldPositionByName('statuses_id') ]['display']['insert'] = true;
            $AktsContents->formDescription['fields'][ $AktsContents->getFieldPositionByName('documents') ]['display']['insert'] = true;
            $AktsContents->formDescription['fields'][ $AktsContents->getFieldPositionByName('policies_id') ]['display']['insert'] = true;

            $d['akts_id'] = $row['id'];
            $d['number'] = $r['number'];
            $d['payments_calendar_id'] = 0;
            //$d['accidents_id'] = $r['id'];
            $d['application_accidents_id'] = $r['id'];
            $d['policies_id'] = $r['policies_id'];
            $d['comission_master']=0;
            $d['comission_investigation']=0;
            $sum = 0;
            switch ($r['doc_type']) {
                case 1:
                    $sum = $this->comission_master;
                    $d['comission_master']=1;
                    break;
                case 2:
                    $d['comission_investigation']=1;
                    $sum = $this->comission_investigation;
                    break;
                case 3:
                    $d['comission_master']=1;
                    $d['comission_investigation']=1;
                    $sum = $this->comission_master + $this->comission_investigation;
                    break;
            }

            if(abs($sum - 62.11) < 0.000001 && $r['manual'] != 1)
            {
                $sql = "SELECT SUM(a.id) as summ FROM insurance_accident_documents a JOIN insurance_application_accidents b on a.application_accidents_id = b.id WHERE a.product_document_types_id = 63 AND b.inspecting_car = 1 AND a.application_accidents_id = " . $d['application_accidents_id'];
                $res1 = $db->getOne($sql);

                $sql = "SELECT SUM(a.id) as summ FROM insurance_accident_documents a JOIN insurance_application_accidents b on a.application_accidents_id = b.id WHERE a.product_document_types_id = 36 AND b.inspecting_car = 1 AND a.application_accidents_id = " . $d['application_accidents_id'];
                $res2 = $db->getOne($sql);

                if(($res1['summ'] && intval($res1['summ']) > 0) || ($res2['summ'] && intval($res2['summ']) > 0))
                {
                    $sum += 62.12;
                    $d['comission_master']=1;
                    $d['comission_investigation']=1;
                }
            }

            $d['payment_amount'] = $sum;
            $d['documents'] = 1;
            $d['statuses_id']=3;
            $d['types_id']=1;
            $d['base_commission_amount'] = $sum;
            $d['base_commission_percent'] = 100;
            $d['commission_amount'] =  $sum;
            $d['commission_percent'] = 100;
            $AktsContents->insert($d, false);
            $e[] = $row['agreement_number'] . ' | ' . $d['akts_id'] . ' | ' . $d['number'] . ' | ' . $sum . ' | ' . $r['doc_type'] . '<br />';
        }

        $this->createPayment($row['number'],  $row['id'],6);
        foreach ($e as $key) {
            echo $key;
        }
    }

    function generateJurPersonAktInWindow($data) {
        global $db;

        $this->checkPermissions('change', $data);

        //ФОП Самокиш, ФОП Стабинскас, ТОВ Альтернатива, ФОП Сирык
        $sql='SELECT DISTINCT agreement_number FROM '.PREFIX.'_agencies WHERE active=1 AND LENGTH(agreement_number)>1 AND id in (233,232,50,224,555)  ';
        //$sql='SELECT DISTINCT agreement_number FROM '.PREFIX.'_agencies WHERE active=1 AND LENGTH(agreement_number)>1 AND id in (555)  ';
        $akts=$db->getAll($sql);

        foreach($akts as $akt) {
            $this->generateJurPersonAkt(array('agreement_number' => $akt['agreement_number']));
        }
    }

    function generateJurPersonAkt($data) {
        global $db,$Log;

        $this->checkPermissions('change', $data);

        if ($data['id']) {
            $row = $this->get($data);

            if ($row['payment_statuses_id'] != 1) {
                $Log->add('error', 'Акт в статусi сплачено оновлення атку не можливе');
                return false;
            }
            if ($row['person_types_id'] != 5) return false;
        } elseif ($data['agreement_number']) {
            $buildtime = time();
            $date = getdate($buildtime);
            $date['mon']--;

            if ($date['mon'] == 0) {
                $date['mon'] = 12;
                $date['year']--;
            }

            $aktnumber = $data['agreement_number'] . '.' . (sprintf('%02d', $date['mon'])) . '.' . substr($date['year'], 2);
            $data['number'] = $aktnumber;
            $row = $this->get($data);

            if (!$row) {//нет акта создаем новый

                $sql =  'SELECT * ' .
                    'FROM insurance_agencies  ' .
                    'WHERE agreement_number = ' . $db->quote($data['agreement_number']);
                $agency = $db->getRow($sql);
                if (!$agency) return;

                $row['agreement_number'] = $data['agreement_number'];
                $row['number'] = $aktnumber;
                $row['date'] = '20'.substr($date['year'], 2).'-' . sprintf('%02d', $date['mon']) . '-01';
                $row['date_year'] = '20'.substr($date['year'], 2);
                $row['date_month'] =  sprintf('%02d', $date['mon']);
                $row['date_day'] =  '01';
                $row['person_types_id'] = 5;
                $row['payment_statuses_id'] = 1;
                $row['agent_name'] = $agency['title'];
                $row['file'] = 1;
                $row['k']=1;
                $row['id'] = $this->insert($row,false);

                $row = $this->get($row);
            }
        }
        if (!$row) return;
        $factData = $this->getFactPolicies($row);

        //чистим содержимое акта
        $db->query('DELETE FROM insurance_akts_contents WHERE manual=0 AND akts_id='.intval($row['id']));
        //чистим содержимое плановых полисов акта
        $db->query('DELETE FROM insurance_akts_plan_contents WHERE akts_id='.intval($row['id']));


        //заполянем планы
        if ($factData) {

            foreach($factData as $r) {

                $db->query('INSERT INTO insurance_akts_plan_contents(akts_id,policies_id,number,types_id,created,modified) values('.
                    $row['id'].','.$r['id'].','.$db->quote($r['number']).','.intval($r['type']).',NOW(),NOW()) ');

                //заполняем часть к оплате
                $AktsContents = new AktsContents($data);
                $calendar = $db->getAll('SELECT a.id, a.amount, a.commission_agency_amount as commission_agent_amount, b.commission_agency_percent as commission_agent_percent, b.commission as documents, b.manager_id FROM insurance_policy_payments_calendar a JOIN insurance_policies b on b.id=a.policies_id WHERE a.policies_id='.intval($r['id']));

                foreach($calendar as $c) {
                    $d['akts_id'] = $row['id'];
                    $d['number'] = $r['number'];
                    $d['payments_calendar_id'] = $c['id'];
                    $d['payment_amount'] = $c['amount'];
                    $d['documents'] = $c['documents'];
                    $d['statuses_id']=1;


                    $planPercent = $r['type']==4 ? $go_carsPercent : $kaskoCarsPercent;
                    $d['base_commission_amount'] = doubleval($c['commission_agent_amount']);
                    $d['base_commission_percent'] = doubleval($c['commission_agent_percent']);
                    $k = 1;
                    $d['commission_amount'] =  $c['commission_agent_amount']*$k;
                    $d['commission_percent'] = $c['commission_agent_percent']*$k;
                    if ($d['base_commission_amount']>0)
                        $AktsContents->insert($d,false);
                }

            }
        }

        $this->fillExpressCreditAkt(intval($row['id']),$row['agreement_number'],$row['person_types_id']);

        //занести с предыдущего акта
        $prew_akt=$db->getRow('SELECT * FROM insurance_akts WHERE agreement_number='.$db->quote($row['agreement_number']).' AND date<'.$db->quote($row['beginDate']).' AND person_types_id=5 ORDER BY date DESC LIMIT 1');
        if ($prew_akt) {

            $prew_contents=$db->getAll('SELECT * FROM insurance_akts_contents WHERE commission_amount_white>0 AND akts_id='.intval($prew_akt['id']));
            $AktsContents=new AktsContents($data);

            foreach($prew_contents as $r) {

                //если предыдущий акт не оплачен то все полиса переносим,
                //а если оплачен то только полиса по которым не было денег или документов на тот период
                if ($prew_akt['payment_statuses_id']==1 || $r['statuses_id']==1 || $r['documents']==0) {
                    $d['akts_id'] = $row['id'];
                    $d['number'] = $r['number'];
                    $d['payments_calendar_id'] = $r['payments_calendar_id'];
                    $d['payment_amount'] = $r['payment_amount'];
                    $d['base_commission_amount'] = $r['base_commission_amount'];
                    $d['base_commission_percent'] = $r['base_commission_percent'];
                    $d['commission_amount'] = $r['commission_amount'];
                    $d['commission_percent'] = $r['commission_percent'];
                    $d['types_id'] = 2; // помечаем что из предыдущего акта
                    $d['statuses_id']=1;
                    $AktsContents->insert($d,false);
                }
            }
        }

        $this->createPayment($row['number'],  $row['id'],5);

        echo 'done';
        return true;
    }

    function generateAkt($data) {
        global $db,$Log;

        $this->checkPermissions('change', $data);

        if ($data['id']) {
            $row = $this->get($data);
            if (!$row) $row = $this->getMaster($data);

            if ($row['payment_statuses_id'] != 1) {
                $Log->add('error', 'Акт в статусi сплачено оновлення атку не можливе');
                return false;
            }
            if ($row['person_types_id'] ==6) return $this->generateMasterAkt($data); //акт на мастера
            if ($row['person_types_id'] ==5) return $this->generateJurPersonAkt($data); //акт на юр лицо
            if ($row['sellers_department'] ==1) return $this->generateSellersAkt($data); //акт на юр лицо

        } elseif ($data['agreement_number']) {
            $buildtime = time();
            $date = getdate($buildtime);
            $date['mon']--;


            if ($date['mon'] == 0) {
                $date['mon'] = 12;
                $date['year']--;
            }

            $aktnumber = $data['agreement_number'] . '.' . (sprintf('%02d', $date['mon'])) . '.' . substr($date['year'], 2);
            $data['number'] = $aktnumber;
            $row = $this->get($data);

            if (!$row) {//нет акта создаем новый

                $sql =  'SELECT accounts_id, CONCAT(lastname, \' \', firstname) AS fio,b.service,a.es_department ' .
                    'FROM ' . PREFIX  . '_accounts AS a ' .
                    'JOIN ' . PREFIX . '_agents AS b ON a.id = b.accounts_id ' .
                    'WHERE agreement_number = ' . $db->quote($data['agreement_number']);
                $agents = $db->getAll($sql);

                if (!$agents) return;
                $accounts_id = array();
                $person_types_id = 0;

                foreach($agents as $agent) {

                    $agent_name = $agent['fio'];
                    $es_department= $agent['es_department'];
                    $accounts_id[]=$agent['accounts_id'];
                }

                $agcount = $db->getOne('SELECT count(*) as c FROM insurance_agencies WHERE director1_id IN ('.implode(' , ', $accounts_id).')');



                if ($agcount>0) {
                    $person_types_id = 2;//фiз особа директор
                } else {

                    $agcount = $db->getOne('SELECT count(*) as c FROM insurance_agencies WHERE director2_id IN ('.implode(' , ', $accounts_id).')');
                    if ($agcount>0) $person_types_id = 3; //фiз особа заст. директора
                    else { //заступник о сервису
                        $agcount2 = $db->getOne('SELECT count(*) as c FROM insurance_agencies WHERE director3_id IN ('.implode(' , ', $accounts_id).')');
                        if ($agcount2>0) $person_types_id = 7; //фiз особа заст. директора по сервису
                    }
                }

                if (!$person_types_id) {
                    if($agents[0] && $agents[0]['service'] ==1)
                        $person_types_id = 8;//фiз особа сервис
                    else
                        $person_types_id = 1;//фiз особа агент
                }
                $row['agreement_number'] = $data['agreement_number'];
                $row['number'] = $aktnumber;
                $row['date'] = '20'.substr($date['year'], 2).'-' . sprintf('%02d', $date['mon']) . '-01';
                $row['date_year'] = '20'.substr($date['year'], 2);
                $row['date_month'] =  sprintf('%02d', $date['mon']);
                $row['date_day'] =  '01';
                $row['person_types_id'] = $person_types_id;
                $row['payment_statuses_id'] = 1;
                $row['agent_name'] = $agent_name;
                $row['file'] = 1;
                $row['es_department'] = $es_department;
                $row['k']=1;
                $row['sellers_department']=0;
                $row['id'] = $this->insert($row,false);
                $row = $this->get($row);
            }
        }

        if (!$row) return;

        //$this->fillExpressCreditAkt(intval($row['id']),$row['agreement_number'],$row['person_types_id']);
        //return;


        $factData = $this->getFactPolicies($row);

        //чистим содержимое акта
        $db->query('DELETE FROM insurance_akts_contents WHERE manual=0 AND akts_id='.intval($row['id']));
        //чистим содержимое плановых полисов акта
        $db->query('DELETE FROM insurance_akts_plan_contents WHERE akts_id='.intval($row['id']));

        //находим план
        if ($row['person_types_id']==1) {//агент
            $plan = $db->getRow('SELECT b.* FROM insurance_policy_plans a JOIN insurance_policy_plans_agents b on a.id=b.plans_id WHERE a.date='.$db->quote($row['beginDate']).' AND b.agreement_number='.$db->quote($row['agreement_number']));
        } else {//директор
            $plan = $db->getRow('SELECT b.* FROM insurance_policy_plans a
                                 JOIN insurance_policy_plans_agencies b on a.id=b.plans_id
                                 JOIN insurance_agencies c on c.id=b.agencies_id
                                 JOIN insurance_agents d on d.accounts_id=c.'.($row['person_types_id']==2 ? 'director1_id' : 'director2_id').'
                                 WHERE a.date='.$db->quote($row['beginDate']).' AND d.agreement_number='.$db->quote($row['agreement_number']));
        }

        if ($plan) {
            $db->query('UPDATE insurance_akts SET credit_cars='.doubleval($plan['credit_cars']).',
                                                  not_credit_cars='.doubleval($plan['not_credit_cars']).',
                                                  continued_cars='.doubleval($plan['continued_cars']).',
                                                  go_cars='.doubleval($plan['go_cars']).' WHERE id='.intval($row['id']));

        }
        else $plan = array();


        $k = 1;

        //заполянем планы
        if ($factData) {
            $credit_carsFact = 0;
            $notcredit_carsFact = 0;
            $notcredit_carsFactAll = 0;
            $continued_carsFact = 0;
            $go_carsFact = 0;
            $ns_carsFact = 0;
            foreach($factData as $r) {

                switch($r['type']) {
                    case 1:
                        $credit_carsFact++;
                        break;
                    case 2:
                        $notcredit_carsFact++;
                        break;
                    case 3:
                        $continued_carsFact++;
                        break;
                    case 4:
                        if ($r['terms_id']!=25) {//берем только 1 летние
                            if ($row['person_types_id']==1) {//агенту в факт выполнения плана идет токо ГО 1-й год
                                if (intval($r['number_prolongation']) == 0) $go_carsFact++;
                            }
                            else {
                                $go_carsFact++;
                            }
                        }
                        break;
                    case 5:
                        $ns_carsFact++;
                        break;
                    case 8:
                        $notcredit_carsFactAll++; //ритейл по всему предприятию
                        break;
                }
            }

            $credit_carsPercent = $plan['credit_cars']>0 ? $credit_carsFact*100/$plan['credit_cars'] : ($credit_carsFact>0 ? 101 : 100);
            $notcredit_carsPercent = $plan['not_credit_cars']>0 ? $notcredit_carsFact*100/$plan['not_credit_cars'] : ($notcredit_carsFact>0 ? 101 :100);

            $notcredit_carsPercentAll = $plan['not_credit_cars']>0 ? $notcredit_carsFactAll*100/$plan['not_credit_cars'] : ($notcredit_carsFactAll>0 ? 101 :100);

            $continued_carsPercent = $plan['continued_cars']>0 ? $continued_carsFact*100/$plan['continued_cars'] : 100;
            $go_carsPercent = $plan['go_cars']>0 ? $go_carsFact*100/$plan['go_cars'] : ($go_carsFact>0 ? 101 :100);
            //весь % выполнения по каско без пролонгации
            $kaskoCarsPercent=(intval($plan['credit_cars'])+intval($plan['not_credit_cars'])) >0 ?
                ($credit_carsFact+$notcredit_carsFact)*100/(intval($plan['credit_cars'])+intval($plan['not_credit_cars'])) :
                100;

            foreach($factData as $r) {
                $skip_insert = false;
                if ($row['person_types_id']!=1 && $r['type']==8) continue;//ритейл по всему предприятию нужен только для фiз особа агент
                if ($row['person_types_id']==1 && intval($r['number_prolongation']) > 0) $skip_insert = true;//агенту в факт выполнения плана идет токо ГО 1-й год
                if (!$skip_insert) {
                    $db->query('INSERT INTO insurance_akts_plan_contents(akts_id,policies_id,number,types_id,created,modified) values('.
                        $row['id'].','.$r['id'].','.$db->quote($r['number']).','.intval($r['type']).',NOW(),NOW()) ');
                }
                if ($r['type']==8) continue;//ритейл по всему предприятию занесли только в таблицу Факт виконання плану: для фiз особа

                //заполняем часть к оплате
                $AktsContents=new AktsContents($data);
                $calendar=$db->getAll('SELECT a.id,a.amount,
                a.commission_agent_amount,a.commission_agency_amount,
                a.commission_director1_amount,a.commission_director2_amount,
                b.commission_agent_percent,b.commission_agency_percent,
                b.commission_director1_percent,b.commission_director2_percent,
                a.commission_seller_agents_amount,b.commission_seller_agents_percent,
                a.commission_manager_amount,b.commission_manager_percent,
                b.commission,b.motivation_manager_percent,
                b.manager_id ,b.product_types_id
                FROM insurance_policy_payments_calendar a 
                JOIN insurance_policies b on b.id=a.policies_id 
                WHERE a.policies_id='.intval($r['id']).' AND second_fifty_fifty=0 AND next_year=0');
                foreach($calendar as $c) {


                    $discounts = array();
                    if ($c['product_types_id']==3) {
                        $discounts = $db->getRow('select commission_agency_discount_percent,commission_agent_discount_percent,director1_commission_discount_percent,director2_commission_discount_percent,commission_manager_discount_percent,commission_seller_agents_discount_percent,amount,amount_agent FROM insurance_policies_kasko_items WHERE policies_id='.intval($r['id']).' ');

                        $superBaseComissions = $db->getRow('SELECT commission_agent_percent, director2_commission_percent, director1_commission_percent FROM insurance_policies_kasko_items WHERE policies_id='.intval($r['id']).' ');

                        $whichProduct = $db->getRow('SELECT products_id as id FROM insurance_policies_kasko_items WHERE policies_id='.intval($r['id']).' ');
                    }

                    $d['akts_id'] = $row['id'];
                    $d['number'] = $r['number'];
                    $d['payments_calendar_id'] = $c['id'];
                    $d['payment_amount'] = $c['amount'];
                    $d['documents'] = $c['commission'];
                    $d['statuses_id']=1;
                    $d['manager_id'] =0;

                    $planPercent = 0;
                    $discount = 0;

                    $infoAboutPolicy = 
                        $db->getAll('SELECT IF(a.outside_client IS NOT NULL, a.outside_client, IF(b.outside_client IS NOT NULL, b.outside_client, IF(d.outside_client IS NOT NULL, d.outside_client, 0))) as outside,
                                        IF(a.outside_client IS NOT NULL, 1, IF(b.outside_client IS NOT NULL, 2, IF(d.outside_client IS NOT NULL, 3, 0))) as policyType,
                                        a.financial_institutions_id as finId
                                        FROM insurance_policies c 
                                        LEFT JOIN insurance_policies_go b on b.policies_id = c.id
                                        LEFT JOIN insurance_policies_kasko a on a.policies_id = c.id
                                        LEFT JOIN insurance_policies_dgo d on d.policies_id = c.id
                                        WHERE c.id=' . intval($r['id']));

                    switch ($row['person_types_id']) {
                        case 1: //агент сюда входит кто выписывал полис и кто выбран как Менеджер що привiв клiєнта
                        case 8:
                            //если получатель денег сам сделал полиса
                            $d['base_commission_amount'] = doubleval($c['commission_agent_amount']);
                            $d['base_commission_percent'] = doubleval($c['commission_agent_percent']);
                            $d['commission_amount'] =  $c['commission_agent_amount'];
                            $d['commission_percent'] = $c['commission_agent_percent'];
                            $discount = doubleval($discounts['commission_agent_discount_percent']);//скидка из доп ячеек

                            //рассчет по индивидуальной мотивации по ячейке % КВ для МП 
                            if ($r['individual_motivation']==1) {
                                if ($r['agencies_id'] ==14 || $r['agencies_id'] == 56 || $r['agencies_id'] == 88) {// "Автоцентр на Московському" ПАТ "Українська автомобільна корпорація"
                                    if($r['manager_id']>0) //выбран менеджер привел клиента
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                                $k=5/15;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 6: //полиса ДГО
                                                $k=4/12;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    }

                                } else if($r['agencies_id'] == 1459)    // Гранд Автомотів
                                {
                                    if($r['manager_id']>0) //выбран менеджер привел клиента
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                                $k=6/15;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 6: //полиса ДГО
                                                $k=5/14;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    }
                                } else if($r['agencies_id'] == 55)        // АДУ
                                {
                                    if($r['manager_id']>0) //выбран менеджер привел клиента
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто - БАНК 1 Год
                                                $k=8/13;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 2: //Не кредитнi авто - Ритейл 1 Год
                                                $k=5/13;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто - Осаго
                                            case 6: //полиса ДГО
                                                $k=5/15;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    }
                                } else if($r['agencies_id'] == 51)      // Сфера Авто
                                {
                                    if($r['manager_id']>0) //выбран менеджер привел клиента
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                                $k=14.2/18;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                                $k=15/19;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 6: //полиса ДГО
                                                $k=9/18;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    }
                                } else if($r['agencies_id'] == 1495)      // Автосаміт БЦ
                                {
                                    if($r['manager_id']>0) //выбран менеджер привел клиента
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                                $k=14.2/18;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                                $k=15/19;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 6: //полиса ДГО
                                                $k=9/18;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    }
                                } else if($r['agencies_id'] == 17)      // Чернігів Авто
                                {
                                    if($r['manager_id']>0) //выбран менеджер привел клиента
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                                $k=7/10;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                                $k=5/10;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 6: //полиса ДГО
                                                $k=4/8;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    }
                                } else if($r['agencies_id'] == 21)      // Закарпаття
                                {
                                    if($r['manager_id']>0) //выбран менеджер привел клиента
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                                $k=7.5/15;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                                $k=7.5/15;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 6: //полиса ДГО
                                                $k=6/12;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    }
                                } else if($r['agencies_id'] == 28)      // Одеса-Авто
                                {
                                    if($r['manager_id']>0) //выбран менеджер привел клиента
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                                $k=7.5/15;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                                $k=7.5/15;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 6: //полиса ДГО
                                                $k=6/12;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    }
                                }
                                else {
                                    $d['commission_amount'] = $d['commission_amount']* (100-$c['motivation_manager_percent'])/100;
                                    $d['commission_percent'] = $d['commission_percent']* (100-$c['motivation_manager_percent'])/100;
                                }
                            }


                            if ($r['type']==9 || $r['type']==11 || $r['type']==12) {//получателя денег указали в отделе продаж
                                $d['base_commission_amount'] = doubleval($c['commission_seller_agents_amount']);
                                $d['base_commission_percent'] = doubleval($c['commission_seller_agents_percent']);

                                $d['commission_amount'] =  doubleval($c['commission_seller_agents_amount']);
                                $d['commission_percent'] = doubleval($c['commission_seller_agents_percent']);
                                $discount = doubleval($discounts['commission_seller_agents_discount_percent']);

                                /*if ($r['seller_agencies_id'] =55 && intval($r['financial_institutions_id'])>0) {// ац мерседес
                                    $k = 3/5;
                                }*/
                            }

                            if ($r['type']==13 || $r['type']==14 || $r['type']==15) {//получателя денег указали как менеджер що привел клиента


                                if ($r['individual_motivation']==1) {
                                    //переиницализировать в начальные установки как для агента что продал полис
                                    $d['base_commission_amount'] = doubleval($c['commission_agent_amount']);
                                    $d['base_commission_percent'] = doubleval($c['commission_agent_percent']);
                                    $d['commission_amount'] =  $c['commission_agent_amount'];
                                    $d['commission_percent'] = $c['commission_agent_percent'];
                                    //
                                    $discount = doubleval($discounts['commission_manager_discount_percent']);
                                    if ($r['agencies_id'] ==14 || $r['agencies_id'] == 56 || $r['agencies_id'] == 88) {// "Автоцентр на Московському" ПАТ "Українська автомобільна корпорація"
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                            case 13:
                                                $k=10/15;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 14:
                                            case 6: //полиса ДГО
                                            case 15:
                                                $k=8/12;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    } else if ($r['agencies_id'] == 1459)    // Гранд Автомотів
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                            case 13:
                                                $k=9/15;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 14:
                                            case 6: //полиса ДГО
                                            case 15:
                                                $k=9/14;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    } else if ($r['agencies_id'] == 55)        // АДУ
                                    {
                                        switch($r['type'])
                                        {
                                            case 13:
                                                if(intval($infoAboutPolicy['finId']) > 0)
                                                    $k=5/13;
                                                else
                                                    $k=8/13;

                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 14:
                                            case 6: //полиса ДГО
                                            case 15:
                                                $k=10/15;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    } else if ($r['agencies_id'] == 51)      // Сфера Авто
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                                $k=3.8/18;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                            case 13:
                                                $k=4/19;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 14:
                                            case 6: //полиса ДГО
                                            case 15:
                                                $k=9/18;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    } else if ($r['agencies_id'] == 1495)      // Автосаміт БЦ
                                    {
                                        switch($r['type'])
                                        {
                                            case 1: //Кредитнi авто
                                                $k=3.8/18;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 2: //Не кредитнi авто
                                            case 3: //Пролонгованi авто
                                            case 13:
                                                $k=4/18;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                            case 4: //ЦВ авто
                                            case 14:
                                            case 6: //полиса ДГО
                                            case 15:
                                                $k=9/18;
                                                $d['commission_amount'] = $d['commission_amount']* $k;
                                                $d['commission_percent'] = $d['commission_percent']* $k;
                                                break;
                                        }
                                    }
                                    else {
                                        //оставить только то что указал агент что продал полис
                                        $d['commission_amount'] = $d['commission_amount']* ($c['motivation_manager_percent'])/100;
                                        $d['commission_percent'] = $d['commission_percent']* ($c['motivation_manager_percent'])/100;
                                    }
                                }
                                else {
                                    $d['base_commission_amount'] = doubleval($c['commission_manager_amount']);
                                    $d['base_commission_percent'] = doubleval($c['commission_manager_percent']);

                                    $d['commission_amount'] = doubleval($c['commission_manager_amount']);
                                    $d['commission_percent'] = doubleval($c['commission_manager_percent']);
                                    $discount = doubleval($discounts['commission_manager_discount_percent']);
                                }
                            }

                            $k = 1;

                            /*if (($r['type']==1 || $r['type']==2) && $r['agencies_id'] ==55 && intval($r['financial_institutions_id'])==0 && $r['parent_id']==0 && $r['manager_id']==0) {// ац мерседес
                                $k = 1.9;
                            }*/

                            if ($r['individual_motivation']==1 && $infoAboutPolicy['policyType'] == 2 && $r['agencies_id'] ==55 && $r['number_prolongation']>0 && $r['manager_id']==0) {// АДУ + ОСАГО
                                $k = 16/15;

                                $d['commission_amount'] = $d['commission_amount']* $k;
                                $d['commission_percent'] = $d['commission_percent']* $k;
                            }

                            if($r['individual_motivation'] == 1 && $infoAboutPolicy['policyType'] == 2 && $r['agencies_id'] == 51 && $r['number_prolongation'] > 0 && $r['manager_id'] == 0) {  //Сфера + ГО + пролонгация + нету менеджера
                                $k = 16/18;

                                $d['commission_amount'] = $d['commission_amount']* $k;
                                $d['commission_percent'] = $d['commission_percent']* $k;
                            } elseif($r['individual_motivation'] == 1 && $infoAboutPolicy['policyType'] == 2 && $r['agencies_id'] == 51 && $r['number_prolongation'] > 0 && $r['manager_id'] != 0) {
                                $k = 8/18;

                                $d['commission_amount'] = $d['commission_amount']* $k;
                                $d['commission_percent'] = $d['commission_percent']* $k;
                            }

                            if($r['individual_motivation']==1 && $infoAboutPolicy['policyType'] ==2 && $r['agencies_id'] == 17 && $r['number_prolongation'] > 0 && $r['manager_id'] == 0) { //Чернігів + ГО + пролонгація + нема менеджера
                                $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 12.0;
                                $d['commission_percent'] = 12.0;
                            }


                            if ($r['type']==1) { //Тип 1 АвтоБАНК пришел с экспрес кредита база 14%
                                $planPercent = $credit_carsPercent;
                                if($planPercent<50) //уменьшаем по КАСКО с 14 до 8%  депремирование согласно выполнения плана
                                    $k = 8/14;
                                elseif($planPercent<100)    //уменьшаем по КАСКО с 14 до 12% депремирование согласно выполнения плана
                                    $k = 12/14;
                                else
                                    $k = 1; //оставляем 14%

                                if ($r['brands_id']==13 || $r['brands_id']==14)
                                    $k = 5/14;

                                if ($r['agencies_id'] ==55) {// автодом мерседес
                                    $k = 1;
                                }

                                if ($r['agencies_id'] ==21) {// закарпаття
                                    if($planPercent<50) // 
                                        $k = 8/13;
                                    elseif($planPercent<100)    // 
                                        $k = 11/13;
                                    else
                                        $k = 1; //оставляем 14%

                                    if ($r['brands_id']==13 || $r['brands_id']==14)
                                        $k = 5/13;
                                }


                            }

                            if ($r['individual_motivation']==1) {
                                $k = 1;
                            }

                            //применить коэф депримирования
                            $d['commission_amount'] =  $d['commission_amount']*$k;
                            $d['commission_percent'] =  $d['commission_percent']*$k;

                            //скидки из доп ячеек
                            if ($discount>0) {
                                $d['commission_percent']-= ($discount*($discounts['amount_agent']/$discounts['amount']));
                                $d['commission_amount'] = $d['payment_amount']*$d['commission_percent']/100;
                            }

                            //Индивидуальная мотив. + Сторонний Клиент
                            if ($r['individual_motivation'] == 1 && $infoAboutPolicy['outside'] == 1) {
                                switch (intval($infoAboutPolicy['policyType'])) {
                                    case 1: //Каско-Агент 20%
                                        $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 20.0;
                                        $d['commission_percent'] = 20.0;

                                        if($r['type'] == 1) {
                                            $d['commission_percent'] = ($d['base_commission_percent']/$superBaseComissions['commission_agent_percent']) * 20.0;
                                            $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * $d['commission_percent'] / 100;
                                        }

                                        break;
                                    
                                    case 2: //Осаго-Агент 16% База
                                        $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 16.0;
                                        $d['commission_percent'] = 16.0;

                                        //ТДВ "Буковина-АВТО"
                                        if ($r['agencies_id'] == 43) {
                                            $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 17.0;
                                            $d['commission_percent'] = 17.0;
                                        } elseif ($r['agencies_id'] == 23) {    //ПАТ "Житомир-Авто"
                                            $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 16.0;
                                            $d['commission_percent'] = 16.0;
                                        }
                                        break;
                                    case 3: //ДГО-Агент 16%
                                        $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 16.0;
                                        $d['commission_percent'] = 16.0;

                                        break;
                                }
                            }

                            break;
                        case 2: //директор
                            $k = 0;
                            switch($r['type'])
                            {
                                case 1: //Кредитнi авто база 2%
                                    $planPercent = $credit_carsPercent;
                                    if($planPercent<100 && $r['brands_id']!=13 && $r['brands_id']!=14 && $r['individual_motivation']==0) $k = 0;
                                    else $k = 1;
 
                                    if ($r['agencies_id'] ==21) {// закарпаття
                                        if($planPercent<50) // 
                                            $k = 0;
                                        elseif($planPercent<100)    // 
                                            $k = 1/3;
                                        else
                                            $k = 1; // 

                                        if ($r['brands_id']==13 || $r['brands_id']==14)
                                            $k = 2.5/3;
                                    }


                                    break;
                                case 2: //Не кредитнi авто база 1,5%

                                    $k = 1; //новый дог ритейл
                                    if (($r['brands_id']==13 || $r['brands_id']==14) && intval($r['parent_id'])==0  && $r['individual_motivation']==0 && intval($whichProduct['id']) != 673) $k=$k*2;

                                    if ($r['agencies_id'] ==55) {// автодом мерседес
                                        if (intval($r['parent_id'])==0) {
                                            if ($r['manager_id'])
                                                $k = 1;
                                            else
                                                $k = 1/3;
                                        }
                                        else $k = 1;
                                    }

                                    if ($r['agencies_id'] ==21) {// закарпаття
                                        $k=1;
                                        if (($r['brands_id']==13 || $r['brands_id']==14) && intval($r['parent_id'])==0) $k=3/4;
                                    }



                                    break;
                                case 3: //Пролонгованi авто
                                case 5: //НС
                                    $k = 0; //пролонгацию не платим
                                    $planPercent = 0;
                                    break;
                                case 4: //ЦВ авто
                                    $k = 1;
                                    break;
                                case 9: //полиса отдела продаж КАСКО
                                    $k = 1;
                                    if (intval($r['financial_institutions_id'])==0 || $r['individual_motivation']==0) {
                                        $k = 1;
                                    }
                                    /*if ($r['seller_agencies_id'] ==15 && intval($r['financial_institutions_id'])>0) {// ац столичный
                                        $c['commission_director1_amount'] = doubleval($c['commission_director2_amount']);
                                        $c['commission_director1_percent'] = doubleval($c['commission_director2_percent']);
                                        $k = 0.5;
                                    }

                                    if ($r['seller_agencies_id'] ==55 && intval($r['financial_institutions_id'])>0) {// ац мерседес
                                        $c['commission_director1_amount'] = doubleval($c['commission_director2_amount']);
                                        $c['commission_director1_percent'] = doubleval($c['commission_director2_percent']);
                                    }*/





                                    break;
                                case 11: //полиса отдела продаж ГО  
                                case 12: //полиса отдела продаж ДГО
                                    $k = 1;
                                    break;
                                case 6: //полиса ДГО
                                    $k = 1;
                                    break;
                            }
                            if($r['service']==1) $k=1;
                            $d['base_commission_amount'] = doubleval($c['commission_director1_amount']);
                            $d['base_commission_percent'] = doubleval($c['commission_director1_percent']);
                            $d['commission_amount'] = $c['commission_director1_amount']*$k;
                            $d['commission_percent'] = $c['commission_director1_percent']*$k;

                            //скидки из доп ячеек
                            $discount = doubleval($discounts['director1_commission_discount_percent']);

                            //скидки из доп ячеек
                            if ($discount>0) {
                                $d['commission_percent']-= ($discount*($discounts['amount_agent']/$discounts['amount']));
                                $d['commission_amount'] = $d['payment_amount']*$d['commission_percent']/100;
                            }

                            //СФЕРА + БЦ + ОСАГО = 1%
                            if ($r['individual_motivation'] == 1 && intval($infoAboutPolicy['policyType']) === 2) {
                                if($r['agencies_id'] == 51 || $r['agencies_id'] == 1495) {
                                    $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 1.0;
                                    $d['commission_percent'] = 1.0;
                                }
                            }

                            //Индивидуальная мотив. + Сторонний Клиент
                            if ($r['individual_motivation'] == 1 && $infoAboutPolicy['outside'] == 1) {
                                switch (intval($infoAboutPolicy['policyType'])) {
                                    case 1: //Каско-Директор 1%
                                        $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 1.0;
                                        $d['commission_percent'] = 1.0;

                                        if($r['type'] == 1) {
                                            $d['commission_percent'] = ($d['base_commission_percent']/$superBaseComissions['director1_commission_percent']) * 1.0;
                                            $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * $d['commission_percent'] / 100;
                                        }

                                        break;
                                    
                                    case 2: //Осаго-Директор 1% База
                                        $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 1.0;
                                        $d['commission_percent'] = 1.0;

                                        //ТДВ "Буковина-АВТО"
                                        if ($r['agencies_id'] == 43) {
                                            $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 1.0;
                                            $d['commission_percent'] = 1.0;
                                        } elseif ($r['agencies_id'] == 23) {    //ПАТ "Житомир-Авто"
                                            $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 2.0;
                                            $d['commission_percent'] = 2.0;
                                        }
                                        break;
                                    case 3: //Дго-Директор 1%
                                        $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 1.0;
                                        $d['commission_percent'] = 1.0;

                                        break;
                                }
                            }

                            break;
                        case 3: //зам
                            $k = 0;
                            switch($r['type']) {
                                case 1: //Кредитнi авто
                                    $planPercent = $credit_carsPercent;
                                    if($planPercent<50 && $r['brands_id']!=13 && $r['brands_id']!=14) $k = 0;
                                    elseif($planPercent<100 && $r['brands_id']!=13 && $r['brands_id']!=14) $k = 1/3;
                                    else $k = 1;

                                    if ($r['individual_motivation']==1) $k = 1;

                                    /*if ($r['agencies_id'] ==55) {// ац столичный
                                        if($planPercent<50) // 
                                            $k = 1/4;
                                        elseif($planPercent<100)    // 
                                            $k = 3/4;
                                        else
                                            $k = 1; // 
                                    }
                                    if ($r['agencies_id'] ==21) {// закарпаття
                                        if($planPercent<50) // 
                                            $k = 0;
                                        elseif($planPercent<100)    // 
                                            $k = 1/3;
                                        else
                                            $k = 1; // 

                                        if ($r['brands_id']==13 || $r['brands_id']==14)
                                            $k = 2.5/3;
                                    }*/



                                    break;
                                case 2: //Не кредитнi авто база 4,5%
                                    $k = 1;//новый дог ритейл
                                    if(($r['brands_id']==13 || $r['brands_id']==14) && intval($r['parent_id'])==0 && intval($whichProduct['id']) != 673) $k =3/4.5;
                                    if ($r['agencies_id'] ==55) {// автодом мерседес
                                        if (intval($r['parent_id'])==0) {
                                            if ($r['manager_id'])
                                                $k = 1;
                                            else
                                                $k = 1/3;
                                        }
                                        else $k = 1;
                                    }
                                    if ($r['individual_motivation']==1) $k = 1;

                                    /*if ($r['agencies_id'] ==55) {// ац столичный
                                        $k = 1; //
                                    }
                                    if ($r['agencies_id'] ==21) {// закарпаття
                                        $k = 1;
                                        if(($r['brands_id']==13 || $r['brands_id']==14) && intval($r['parent_id'])==0) $k =3/4;
                                    }*/
                                    break;
                                case 3: //Пролонгованi авто
                                    $k = 1;
                                    break;
                                case 5: //НС
                                    $k = 0; //пролонгацию не платим
                                    $planPercent = 0;
                                    break;
                                case 4: //ЦВ авто
                                    $k = 1;
                                    break;
                                case 9: //полиса отдела продаж
                                    $k = 1;
                                    /*if (($r['seller_agencies_id'] ==15 ) && intval($r['financial_institutions_id'])>0) {// ац столичный
                                        $k = 0.5;
                                    }*/

                                    break;
                                case 11: //полиса отдела продаж ГО  
                                case 12: //полиса отдела продаж ДГО
                                    $k = 1;
                                    break;
                                case 6: //полиса ДГО
                                    $k = 1;
                                    break;
                            }

                            if($r['service']==1) {
                                $k=0;
                            }

                            $d['base_commission_amount'] = doubleval($c['commission_director2_amount']);
                            $d['base_commission_percent'] = doubleval($c['commission_director2_percent']);
                            $d['commission_amount'] = $c['commission_director2_amount'] * $k * doubleval($row['k']);
                            $d['commission_percent'] = $c['commission_director2_percent'] * $k * doubleval($row['k']);


                            //скидки из доп ячеек
                            $discount = doubleval($discounts['director2_commission_discount_percent']);
                            if ($discount>0) {
                                $d['commission_percent']-= ($discount*($discounts['amount_agent']/$discounts['amount']));
                                $d['commission_amount'] = $d['payment_amount']*$d['commission_percent']/100;
                            }

                            //Индивидуальная мотив. + Сторонний Клиент
                            if ($r['individual_motivation'] == 1 && $infoAboutPolicy['outside'] == 1) {
                                switch (intval($infoAboutPolicy['policyType'])) {
                                    case 1: //Каско-Зам 1%
                                        $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 1.0;
                                        $d['commission_percent'] = 1.0;

                                        if($r['type'] == 1) {
                                            $d['commission_percent'] = ($d['base_commission_percent']/$superBaseComissions['director2_commission_percent']) * 1.0;
                                            $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * $d['commission_percent'] / 100;
                                        }

                                        break;
                                    
                                    case 2: //Осаго-Зам 1% База
                                        $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 1.0;
                                        $d['commission_percent'] = 1.0;

                                        //ТДВ "Буковина-АВТО"
                                        if ($r['agencies_id'] == 43) {
                                            $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 0;
                                            $d['commission_percent'] = 0;
                                        } elseif ($r['agencies_id'] == 23) {    //ПАТ "Житомир-Авто"
                                            $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 0;
                                            $d['commission_percent'] = 0;
                                        }
                                        break;

                                    case 3: //Дго-Зам 1%
                                        $d['commission_amount'] = ($d['base_commission_amount']/$d['base_commission_percent']) * 1.0;
                                        $d['commission_percent'] = 1.0;

                                        break;
                                }
                            }

                            break;
                    }

                    if ($d['base_commission_amount']>0)
                        $AktsContents->insert($d,false);
                }

            }
        }

        //***************************************************

        $this->fillExpressCreditAkt(intval($row['id']),$row['agreement_number'],$row['person_types_id']);

        //занести с предыдущего акта
        $prew_akt=$db->getRow('SELECT * FROM insurance_akts WHERE agreement_number='.$db->quote($row['agreement_number']).' AND date<'.$db->quote($row['beginDate']).' AND person_types_id<>5   AND person_types_id<>6 ORDER BY date DESC LIMIT 1');
//_dump($prew_akt);

        if ($prew_akt) {

            $prew_contents=$db->getAll('SELECT a.* FROM insurance_akts_contents a JOIN insurance_policies b on b.id=a.policies_id WHERE b.product_types_id<>13 AND a.commission_amount>0 AND a.akts_id='.intval($prew_akt['id']));
            //_dump('SELECT * FROM insurance_akts_contents WHERE commission_amount>0 AND akts_id='.intval($prew_akt['id']));exit;
            $AktsContents=new AktsContents($data);

            foreach($prew_contents as $r) {
                //если предыдущий акт не оплачен то все полиса переносим,
                //а если оплачен то только полиса по которым не было денег или документов на тот период
                if ($prew_akt['payment_statuses_id']==1 || $r['statuses_id']==1 || $r['documents']==0 || $r['statuses_id']==2) {
                    $d['akts_id'] = $row['id'];
                    $d['number'] = $r['number'];
                    $d['payments_calendar_id'] = $r['payments_calendar_id'];
                    $d['payment_amount'] = $r['payment_amount'];
                    $d['base_commission_amount'] = $r['base_commission_amount'];
                    $d['base_commission_percent'] = $r['base_commission_percent'];
                    $d['commission_amount'] = $r['commission_amount'];
                    $d['commission_percent'] = $r['commission_percent'];
                    $d['types_id'] = 2; // помечаем что из предыдущего акта
                    $d['statuses_id']=1;
                    $d['manager_id'] =0;
                    $AktsContents->insert($d,false);
                }
            }
        }

        $this->createPayment($row['number'], $row['id'], 5);
        echo 'done';

        return true;
    }

    //формирование акта системы экспресс кредит
    private function fillExpressCreditAkt($akts_id, $agreement_number, $person_types_id) {
        global $db;

        //чистим содержимое акта из Экспресс кредит
        $db->query('DELETE FROM insurance_akts_express_credit_contents WHERE akts_id='.intval($akts_id));
        $date = getdate();
        $date['mon']--;

        if ($date['mon'] == 0) {
            $date['mon'] = 12;
            $date['year']--;
        }

        $aktNumber =  $agreement_number.'.' . (sprintf('%02d', $date['mon'])) . '.' . substr($date['year'], 2);

        if ($person_types_id == 5) {//юр лицо
            $sql = 'INSERT INTO insurance_akts_express_credit_contents(akts_id, number, cars_title, client, credit_amount, commission_percent, commission_amount, credit_money_transfer_date,created, modified)
                    SELECT '.$akts_id.',a.number,a.carsTitle,CONCAT(a.borrowerLastname,\' \',a.borrowerFirstname,\' \',a.borrowerPatronymicname),
                    bankCreditAgreementAmount+IF(creditAgreement_amountGBO>0,creditAgreement_amountGBO,0)+ IF(insurance_kasko_amount>0,insurance_kasko_amount,0),
                    b.autoshowCommissionPercent,b.autoshowCommissionAmount,creditMoney_transfer_date,NOW(),NOW()
                    FROM
                    insurance_questionnaires_inno as a
                    JOIN insurance_questionnaire_solutions_inno as b ON a.id = b.questionnairesId
                    WHERE b.autoshowAktNumber = '.$db->quote($aktNumber).' ';
            $db->query($sql);
        } else {
            //выбираем анкеты
            $sql = 'INSERT INTO insurance_akts_express_credit_contents(akts_id, number, cars_title, client, credit_amount, commission_percent, commission_amount, credit_money_transfer_date,created, modified)
                    SELECT '.$akts_id.',a.number,a.carsTitle,CONCAT(a.borrowerLastname,\' \',a.borrowerFirstname,\' \',a.borrowerPatronymicname),
                    bankCreditAgreementAmount+IF(creditAgreement_amountGBO>0,creditAgreement_amountGBO,0)+ IF(insurance_kasko_amount>0,insurance_kasko_amount,0),
                    b.managerCommissionPercent,b.managerCommissionAmount,creditMoney_transfer_date,NOW(),NOW()
                    FROM
                    insurance_questionnaires_inno as a
                    JOIN insurance_questionnaire_solutions_inno as b ON a.id = b.questionnairesId
                    WHERE b.managerAktNumber = '.$db->quote($aktNumber).' ';
            $db->query($sql);

            //выбираем анкеты потребы
            $sql = 'INSERT INTO insurance_akts_express_credit_contents(akts_id, number, cars_title, client, credit_amount, commission_percent, commission_amount,credit_money_transfer_date, created, modified)
                    SELECT '.$akts_id.',a.number,a.carsTitle,CONCAT(a.borrowerLastname,\' \',a.borrowerFirstname,\' \',a.borrowerPatronymicname),
                    bankCreditAgreementAmount+IF(creditAgreement_amountGBO>0,creditAgreement_amountGBO,0)+ IF(insurance_kasko_amount>0,insurance_kasko_amount,0),
                    creditspecialistCommissionPercent,creditspecialistCommissionAmount,creditMoney_transfer_date,NOW(),NOW()
                    FROM
                    insurance_questionnaires_inno as a
                    JOIN insurance_questionnaire_solutions_inno as b ON a.id = b.questionnairesId
                    WHERE b.creditspecialistAktNumber='.$db->quote($aktNumber).' ';
            $db->query($sql);
        }
    }

    private function getFactPolicies($row, $p500 = false) {
        global $db;

        $from = $db->quote($row['beginDate']);
        $to = $db->quote($row['endDate']);

        $conditions[] = 'c.datetime BETWEEN ' . $from . ' AND ' . $to.' ';
        $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
        $agencies_id = 0;
        $accounts_id=array(0);

        $sql = '
            SELECT a.agencies_id,c.id as id1,d.id as id2 FROM insurance_agents a 
            JOIN insurance_agencies b on b.id=a.agencies_id
            left JOIN insurance_agencies c on c.id=b.parent_id
            left join insurance_agencies d on d.parent_id=IF(c.id,c.id,b.id)
            where a.agreement_number= '.$db->quote($row['agreement_number']);
        $result = $db->getAll($sql );

        $all_agencies = array(0);

        if ($result) {
            foreach($result as $r) {
                if ($r['agencies_id'])
                    $all_agencies[] = $r['agencies_id'];
                if ($r['id1'])
                    $all_agencies[] = $r['id1'];
                if ($r['id2'])
                    $all_agencies[] = $r['id2'];
            }
        }

        if ($row['person_types_id']==2 || $row['person_types_id']==3) {// директор или зам
            $agencies_id = $db->getOne('SELECT a.agencies_id FROM insurance_agents a JOIN insurance_agencies b on b.director'.($row['person_types_id']==2 ? '1':'2').'_id=a.accounts_id WHERE a.agreement_number='.$db->quote($row['agreement_number']));
            $conditions[] = '(IF(a2.id>0,a2.id,a1.id) = ' . intval($agencies_id).' OR a1.id='.intval($agencies_id).')';
        } elseif ($row['person_types_id']==5) {//юрик
            $agencies_id = $db->getOne('SELECT id FROM insurance_agencies WHERE agreement_number='.$db->quote($row['agreement_number']));
            $conditions[] = 'IF(a2.id>0,a2.id,a1.id) = ' . intval($agencies_id);
        } else {
            $accounts_id = $db->getCol('SELECT accounts_id FROM insurance_agents WHERE agreement_number='.$db->quote($row['agreement_number']));
            $conditions[] ='a.agents_id IN ('.implode(' , ', $accounts_id).')';
        }

        $speriod = ' ';
        if ($row['sellers_department']) {
            $speriod = ' AND payment_date BETWEEN ' . $from . ' AND ' . $to.'  ';
        }

        //КАСКО, банк
        $sql =  'SELECT DISTINCT a.id,a.number,1 as type,c1.brands_id,a.parent_id,ag.service,payedamount,a.seller_agents_id,a.manager_id,a.types_id as quote_type,a.agencies_id,a.seller_agencies_id,a1.individual_motivation ' .
            'FROM ' . PREFIX . '_policies AS a ' .
            'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
            'JOIN ' . PREFIX . '_policies_kasko_items AS c1 ON a.id = c1.policies_id ' .
            'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0 AND second_fifty_fifty=0 AND  '.($p500 ? ' amount=500 ' : ' amount<>500 ').$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'WHERE ' . implode(' AND ', $conditions) . ' AND a.solutions_id>0 AND a.agreement_types_id<>3 AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND b.financial_institutions_id >0 AND a.states_id=0';
        $result = $db->getAll($sql);

        $list = array();
        if ($result) {
            foreach($result as $r)
                $list[] = $r;
        }

        //дострахование
        $sql =  'SELECT  DISTINCT a.id,a.number,10 as type,c1.brands_id,a.parent_id,ag.service,a.parent_id,payedamount,a.seller_agents_id,a.manager_id,a.agencies_id,a.seller_agencies_id ,a1.individual_motivation ' .
            'FROM ' . PREFIX . '_policies AS a ' .
            'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
            'JOIN ' . PREFIX . '_policies_kasko_items AS c1 ON a.id = c1.policies_id ' .
            'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0 AND second_fifty_fifty=0 AND  '.($p500 ? ' amount=500 ' : ' amount<>500 ').$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'WHERE ' . implode(' AND ', $conditions) . ' AND a.agencies_id=1469 AND a.agreement_types_id=3 AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . '    ';
        $result = $db->getAll($sql);

        if ($result) {
            foreach($result as $r)
                $list[] = $r;
        }


        //$conditions = array('((c.datetime BETWEEN ' . $from . ' AND ' . $to.') OR a.id in(70234,71317,71519,71861))');
        $conditions = array('c.datetime BETWEEN ' . $from . ' AND ' . $to.' ');
        $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
        $conditions[] ='(b.insurer_edrpou<>a1.edrpou OR b.insurer_person_types_id=1)';

        if ($row['person_types_id']==2 || $row['person_types_id']==3) {// директор или зам
            $conditions[] = '(IF(a2.id>0,a2.id,a1.id) = ' . intval($agencies_id).' OR a1.id='.intval($agencies_id).')';
        } elseif ($row['person_types_id']==5) {//юрик
            $agencies_id = $db->getOne('SELECT id FROM insurance_agencies WHERE agreement_number='.$db->quote($row['agreement_number']));
            $conditions[] = 'IF(a2.id>0,a2.id,a1.id) = ' . intval($agencies_id);
        } else {
            $conditions[] ='a.agents_id IN ('.implode(' , ', $accounts_id).')';
        }

        //КАСКО, ритейл
        if ($p500) $list=array();

        $sql =  'SELECT  DISTINCT a.id,a.number,2 as type,c1.brands_id,a.parent_id,ag.service,a.parent_id,payedamount,a.seller_agents_id,a.manager_id,a.types_id as quote_type,a.agencies_id,a.seller_agencies_id,a1.individual_motivation  ' .
            'FROM ' . PREFIX . '_policies AS a ' .
            'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
            'JOIN ' . PREFIX . '_policies_kasko_items AS c1 ON a.id = c1.policies_id ' .
            'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0 AND second_fifty_fifty=0  AND  '.($p500 ? ' amount=500 ' : ' amount<>500 ').$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'WHERE ' . implode(' AND ', $conditions) . ' AND a.agreement_types_id<>3 AND  b.options_race=0 AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND b.financial_institutions_id = 0  ';
        $result = $db->getAll($sql);

        if ($result) {
            foreach($result as $r)
                $list[] = $r;
        }

        if ($p500) return $list;


        //КАСКО, отдел продаж
        $conditions9 = array('c.datetime BETWEEN ' . $from . ' AND ' . $to.' ');
        $conditions9[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;


        if ($row['person_types_id']==2 || $row['person_types_id']==3) {// директор или зам
            $conditions9[] = '(IF(a2.id>0,a2.id,a1.id) = ' . intval($agencies_id).' OR a1.id='.intval($agencies_id).')';
        } elseif ($row['person_types_id']==5) {//юрик
            $agencies_id = $db->getOne('SELECT id FROM insurance_agencies WHERE agreement_number='.$db->quote($row['agreement_number']));
            $conditions9[] = 'IF(a2.id>0,a2.id,a1.id) = ' . intval($agencies_id);
        } else {
            $conditions9[] ='a.seller_agents_id IN ('.implode(' , ', $accounts_id).')';//тут отличие
        }

        $conditions9[] ='(b.insurer_edrpou<>a1.edrpou OR b.insurer_person_types_id=1)';

        //КАСКО
        $sql =  'SELECT  DISTINCT a.id,a.number,9 as type,c1.brands_id,b.financial_institutions_id,ag.service,payedamount,a.seller_agents_id,a.manager_id,a.types_id as quote_type,a.agencies_id,a.seller_agencies_id,a1.individual_motivation  ' .
            'FROM ' . PREFIX . '_policies AS a ' .
            'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
            'JOIN ' . PREFIX . '_policies_kasko_items AS c1 ON a.id = c1.policies_id ' .
            'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.seller_agencies_id  ' . //тут отличие
            'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0 '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'WHERE ' . implode(' AND ', $conditions9) . '  AND b.options_race=0 AND a.product_types_id = ' . PRODUCT_TYPES_KASKO;
        $result = $db->getAll($sql);

        if ($result) {
            foreach($result as $r)
                $list[] = $r;
        }
        array_pop($conditions9);
        //ЦВ
        $sql =  'SELECT  DISTINCT a.id,a.number,11 as type,ag.service,payedamount,a.seller_agents_id,a.manager_id,a.agencies_id,a.seller_agencies_id ,a1.individual_motivation  ' .
            'FROM ' . PREFIX . '_policies AS a ' .
            'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
            'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.seller_agencies_id  ' . //тут отличие
            'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0 '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'WHERE ' . implode(' AND ', $conditions9) . ' AND a.product_types_id = ' . PRODUCT_TYPES_GO;
        $result = $db->getAll($sql);
        if ($result) {
            foreach($result as $r)
                $list[] = $r;
        }
        //ДГО
        $sql =  'SELECT  DISTINCT a.id,a.number,12 as type,ag.service,payedamount,a.seller_agents_id,a.manager_id,a.agencies_id,a.seller_agencies_id ,a1.individual_motivation ' .
            'FROM ' . PREFIX . '_policies AS a ' .
            'JOIN ' . PREFIX . '_policies_dgo AS b ON a.id = b.policies_id ' .
            'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.seller_agencies_id  ' . //тут отличие
            'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0 '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'WHERE ' . implode(' AND ', $conditions9) . ' AND a.product_types_id = ' . PRODUCT_TYPES_DGO;
        $result = $db->getAll($sql);

        if ($result) {
            foreach($result as $r)
                $list[] = $r;
        }



        $conditions = array('c.datetime BETWEEN ' . $from . ' AND ' . $to);

        if ($row['person_types_id']==2 || $row['person_types_id']==3) {// директор или зам
            $conditions[] = '(IF(a2.id>0,a2.id,a1.id) = ' . intval($agencies_id).' OR a1.id='.intval($agencies_id).')';
        } elseif ($row['person_types_id']==5) {//юрик
            $agencies_id = $db->getOne('SELECT id FROM insurance_agencies WHERE agreement_number='.$db->quote($row['agreement_number']));
            $conditions[] = 'IF(a2.id>0,a2.id,a1.id) = ' . intval($agencies_id);
        } else {
            $conditions[] ='a.agents_id IN ('.implode(' , ', $accounts_id).')';
        }



        //ГО, по факту оплаты
        $sql =  'SELECT a.id,a.number,4 as type,b.brands_id,cc.number_prolongation,b.terms_id,ag.service,a.manager_id,payedamount,a.seller_agents_id,a.agencies_id,a.seller_agencies_id ,a1.individual_motivation ' .
            'FROM ' . PREFIX . '_policies AS a  ' .
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0  '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
            'JOIN insurance_policy_payments_calendar cc on cc.policies_id=a.id '.
            'JOIN ' . PREFIX . '_agencies AS a1 ON a1.id = a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies AS a2 ON a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'WHERE ' . implode(' AND ', $conditions) . '  AND a.product_types_id = ' . PRODUCT_TYPES_GO;
        $result = $db->getAll($sql );

        if ($result) {
            foreach($result as $r)
                $list[] = $r;
        }

        $conditions = array('c.datetime BETWEEN ' . $from . ' AND ' . $to);
        if ($row['person_types_id']==2 || $row['person_types_id']==3) {// директор или зам
            $conditions[] = '(IF(a2.id>0,a2.id,a1.id) = ' . intval($agencies_id).' OR a1.id='.intval($agencies_id).')';
        } elseif ($row['person_types_id']==5) {//юрик
            $agencies_id = $db->getOne('SELECT id FROM insurance_agencies WHERE agreement_number='.$db->quote($row['agreement_number']));
            $conditions[] = 'IF(a2.id>0,a2.id,a1.id) = ' . intval($agencies_id);
        } else {
            $conditions[] ='a.agents_id IN ('.implode(' , ', $accounts_id).')';
        }

        //НС, по факту оплаты
        $sql =  'SELECT a.id,a.number,5 as type,0 as brands_id,ag.service,payedamount,a.seller_agents_id,a.manager_id,a.agencies_id,a.seller_agencies_id,a1.individual_motivation  ' .
            'FROM ' . PREFIX . '_policies AS a  ' .
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0  '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'JOIN ' . PREFIX . '_agencies AS a1 ON a1.id = a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies AS a2 ON a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'WHERE ' . implode(' AND ', $conditions) . ' AND a.product_types_id = ' . PRODUCT_TYPES_NS;
        $result = $db->getAll($sql );

        if ($result) {
            foreach($result as $r)
                $list[] = $r;
        }

        //дго, по факту оплаты
        $sql =  'SELECT a.id,a.number,6 as type,0 as brands_id,ag.service,payedamount,a.seller_agents_id,a.agencies_id,a.manager_id,a.seller_agencies_id ,a1.individual_motivation ' .
            'FROM ' . PREFIX . '_policies AS a  ' .
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0   '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'JOIN ' . PREFIX . '_agencies AS a1 ON a1.id = a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies AS a2 ON a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'WHERE ' . implode(' AND ', $conditions) . ' AND a.product_types_id = ' . PRODUCT_TYPES_DGO;
        $result = $db->getAll($sql);

        if ($result) {
            foreach($result as $r)
                $list[] = $r;
        }




        //полиса по менеджеру що привел клиента
        if ($row['person_types_id']==1 || $row['person_types_id']==8) {

            $conditions = array('c.datetime BETWEEN ' . $from . ' AND ' . $to);
            $conditions[] ='a.manager_id IN ('.implode(' , ', $accounts_id).')';
            //КАСКО
            $sql =  'SELECT  DISTINCT a.id,a.number,13 as type,c1.brands_id,a.parent_id,ag.service,a.parent_id,payedamount,a.seller_agents_id,a.manager_id,a.types_id as quote_type,a.agencies_id,a.seller_agencies_id,a1.individual_motivation ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policies_kasko_items AS c1 ON a.id = c1.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS a1 ON a1.id = a.agencies_id  ' .
                'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
                'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0 AND second_fifty_fifty=0  AND  '.($p500 ? ' amount=500 ' : ' amount<>500 ').$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' AND a.agreement_types_id<>3 AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . '   ';
            $result = $db->getAll($sql);

            if ($result) {
                foreach($result as $r)
                    $list[] = $r;
            }


            //ГО, по факту оплаты
            $sql =  'SELECT a.id,a.number,14 as type,b.brands_id,cc.number_prolongation,b.terms_id,ag.service,payedamount,a.seller_agents_id,a.types_id as quote_type,a.agencies_id,a.seller_agencies_id,a1.individual_motivation ' .
                'FROM ' . PREFIX . '_policies AS a  ' .
                'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0  '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
                'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_agencies AS a1 ON a1.id = a.agencies_id  ' .
                'JOIN insurance_policy_payments_calendar cc on cc.policies_id=a.id '.
                'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
                'WHERE ' . implode(' AND ', $conditions) . '  AND a.product_types_id = ' . PRODUCT_TYPES_GO;
            $result = $db->getAll($sql );

            if ($result) {
                foreach($result as $r)
                    $list[] = $r;
            }

            //дго, по факту оплаты
            $sql =  'SELECT a.id,a.number,15 as type,0 as brands_id,ag.service,payedamount,a.seller_agents_id,a.types_id as quote_type,a.agencies_id,a.seller_agencies_id,a1.individual_motivation ' .
                'FROM ' . PREFIX . '_policies AS a  ' .
                'JOIN ' . PREFIX . '_agencies AS a1 ON a1.id = a.agencies_id  ' .
                'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0   '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
                'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
                'WHERE ' . implode(' AND ', $conditions) . ' AND a.product_types_id = ' . PRODUCT_TYPES_DGO;
            $result = $db->getAll($sql);

            if ($result) {
                foreach($result as $r)
                    $list[] = $r;
            }



        }


        return $list;
    }



    private function getFactPoliciesSellers($row) {
        global $db;

        $from = $db->quote($row['beginDate']);
        $to = $db->quote($row['endDate']);

        $conditions[] = 'c.datetime BETWEEN ' . $from . ' AND ' . $to.' ';
        $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
        $agencies_id = 0;

        $accounts_id = $db->getCol('SELECT accounts_id FROM insurance_agents WHERE agreement_number='.$db->quote($row['agreement_number']));



        $sql = '
            SELECT a.agencies_id,c.id as id1,d.id as id2 FROM insurance_agents a 
            JOIN insurance_agencies b on b.id=a.agencies_id
            left JOIN insurance_agencies c on c.id=b.parent_id
            left join insurance_agencies d on d.parent_id=IF(c.id,c.id,b.id)
            where a.agreement_number= '.$db->quote($row['agreement_number']);
        $result = $db->getAll($sql );

        $all_agencies = array(0);

        if ($result) {
            foreach($result as $r) {
                if ($r['agencies_id'])
                    $all_agencies[] = $r['agencies_id'];
                if ($r['id1'])
                    $all_agencies[] = $r['id1'];
                if ($r['id2'])
                    $all_agencies[] = $r['id2'];
            }
        }

        $conditions[]='a.agencies_id=1469';
        $speriod = ' ';
        if ($row['sellers_department']) {
            $speriod = ' AND payment_date BETWEEN ' . $from . ' AND ' . $to.'  ';
        }

        $list = array();

        if ($row['own']) $conditions[] ='a.agents_id IN ('.implode(' , ', $accounts_id).')';
        //дострахование
        $sql =  'SELECT  DISTINCT a.id,a.number,10 as type,c1.brands_id,a.parent_id,ag.service,a.parent_id,payedamount,a.seller_agents_id,a.manager_id ' .
            'FROM ' . PREFIX . '_policies AS a ' .
            'LEFT JOIN ' . PREFIX . '_clients as clients ON a.clients_id = clients.id ' .
            'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
            'JOIN ' . PREFIX . '_policies_kasko_items AS c1 ON a.id = c1.policies_id ' .
            'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0    ' .$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'WHERE ' . implode(' AND ', $conditions) . ' AND CASE WHEN clients.client_groups_id = 1 THEN clients.important_person <> 1 ELSE TRUE END AND a.agencies_id=1469 AND a.agreement_types_id=3 AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . '    ';
        $result = $db->getAll($sql);

        if ($result) {
            foreach($result as $r) {
                $list[] = $r;
            }
        }

        unset($result);

        $conditions = array('c.payment_date BETWEEN ' . $from . ' AND ' . $to.' ');
        $conditions[] =  'c.statuses_id>=3';
        $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
        $conditions[] ='(b.insurer_edrpou<>a1.edrpou OR b.insurer_person_types_id=1)';
        $conditions[] ='a.agents_id IN ('.implode(' , ', $accounts_id).')';
        $conditions[]='a.agencies_id=1469';

        //КАСКО, не кредит


        $sql =  'SELECT  DISTINCT a.id,a.number,2 as type,c1.brands_id,a.parent_id,ag.service,a.parent_id,c.amount as payedamount,a.seller_agents_id,a.manager_id ' .
            'FROM ' . PREFIX . '_policies AS a ' .
            'LEFT JOIN ' . PREFIX . '_clients as clients ON a.clients_id = clients.id ' .
            'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
            'JOIN ' . PREFIX . '_policies_kasko_items AS c1 ON a.id = c1.policies_id ' .
            'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.

            'JOIN  ' . PREFIX . '_policy_payments_calendar AS c ON a.id = c.policies_id ' .
            'WHERE ' . implode(' AND ', $conditions) . ' AND CASE WHEN clients.client_groups_id = 1 THEN clients.important_person <> 1 ELSE TRUE END AND a.agreement_types_id<>3 AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND b.financial_institutions_id = 0  ';
        $result = $db->getAll($sql);

        if ($result) {
            foreach($result as $r) {
                $list[] = $r;
            }
        }

        unset($result);


        //тут для отдела продаж индивидуальный план
        $conditions[] ='a.agents_id IN ('.implode(' , ', $accounts_id).')';



        //КАСКО, пролонгация
        $sql =  'SELECT DISTINCT a.id,a.number,3 as type,c1.brands_id,a.parent_id,ag.service,a.parent_id,c.amount as payedamount,a.seller_agents_id,a.manager_id ' .
            'FROM ' . PREFIX . '_policies AS a ' .
            'LEFT JOIN ' . PREFIX . '_clients as clients ON a.clients_id = clients.id ' .
            'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
            'JOIN ' . PREFIX . '_policies_kasko_items AS c1 ON a.id = c1.policies_id ' .
            'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'JOIN  ' . PREFIX . '_policy_payments_calendar AS c ON a.id = c.policies_id ' .
            'WHERE ' . implode(' AND ', $conditions) . ' AND CASE WHEN clients.client_groups_id = 1 THEN clients.important_person <> 1 ELSE TRUE END AND a.agreement_types_id<>3 AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND b.financial_institutions_id >0 ';
        $result = $db->getAll($sql );


        if ($result) {
            foreach($result as $r) {
                $list[] = $r;
            }
        }

        unset($result);

        $conditions = array('c.datetime BETWEEN ' . $from . ' AND ' . $to);
        //тут для отдела продаж общий план
        //$conditions[]='a.agencies_id=1469';
        //тут для отдела продаж поменялся на индивидуальный план
        $conditions[] ='a.agents_id IN ('.implode(' , ', $accounts_id).')';

        //ГО, по факту оплаты
        $sql =  'SELECT a.id,a.number,4 as type,b.brands_id,cc.number_prolongation,b.terms_id,ag.service,payedamount,a.seller_agents_id,a.manager_id ' .
            'FROM ' . PREFIX . '_policies AS a  ' .
            'LEFT JOIN ' . PREFIX . '_clients as clients ON a.clients_id = clients.id ' .
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0  '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id ' .
            'JOIN insurance_policy_payments_calendar cc on cc.policies_id=a.id '.
            'JOIN ' . PREFIX . '_agencies AS a1 ON a1.id = a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies AS a2 ON a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'WHERE ' . implode(' AND ', $conditions) . ' AND CASE WHEN clients.client_groups_id = 1 THEN clients.important_person <> 1 ELSE TRUE END AND a.product_types_id = ' . PRODUCT_TYPES_GO;
        $result = $db->getAll($sql );

        if ($result) {
            foreach($result as $r) {
                $list[] = $r;
            }
        }

        unset($result);


        $conditions = array('c.datetime BETWEEN ' . $from . ' AND ' . $to);
        $conditions[]='a.agencies_id=1469';
        if ($row['own']) $conditions[] ='a.agents_id IN ('.implode(' , ', $accounts_id).')';

        //НС, по факту оплаты
        $sql =  'SELECT a.id,a.number,5 as type,0 as brands_id,ag.service,payedamount,a.seller_agents_id ' .
            'FROM ' . PREFIX . '_policies AS a  ' .
            'LEFT JOIN ' . PREFIX . '_clients as clients ON a.clients_id = clients.id ' .
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0  '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'JOIN ' . PREFIX . '_agencies AS a1 ON a1.id = a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies AS a2 ON a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'JOIN insurance_policies_ns b ON a.id = b.policies_id '.
            'WHERE ' . implode(' AND ', $conditions) . ' AND CASE WHEN clients.client_groups_id = 1 THEN clients.important_person <> 1 ELSE TRUE END AND a.product_types_id = ' . PRODUCT_TYPES_NS;
        $result = $db->getAll($sql);

        if ($result) {
            foreach($result as $r) {
                $list[] = $r;
            }
        }

        unset($result);

        //дго, по факту оплаты
        $sql =  'SELECT a.id,a.number,6 as type,0 as brands_id,ag.service,payedamount,a.seller_agents_id ' .
            'FROM ' . PREFIX . '_policies AS a  ' .
            'LEFT JOIN ' . PREFIX . '_clients as clients ON a.clients_id = clients.id ' .
            'JOIN (SELECT policies_id, MIN(payment_date) AS datetime,sum(amount) as payedamount FROM ' . PREFIX . '_policy_payments_calendar WHERE payment_date >0   '.$speriod.' GROUP BY policies_id) AS c ON a.id = c.policies_id ' .
            'JOIN ' . PREFIX . '_agencies AS a1 ON a1.id = a.agencies_id  ' .
            'LEFT JOIN ' . PREFIX . '_agencies AS a2 ON a2.id=a1.parent_id  ' .
            'LEFT JOIN insurance_agents ag ON ag.accounts_id = a.manager_id '.
            'JOIN insurance_policies_dgo b ON a.id = b.policies_id '.
            'WHERE ' . implode(' AND ', $conditions) . ' AND CASE WHEN clients.client_groups_id = 1 THEN clients.important_person <> 1 ELSE TRUE END AND a.product_types_id = ' . PRODUCT_TYPES_DGO;
        $result = $db->getAll($sql);

        if ($result) {
            foreach($result as $r) {
                $list[] = $r;
            }
        }

        unset($result);
        unset($list_vip);

        return $list;
    }

    function downloadFileInWindow($data) {
        global $db, $MONTHES, $Smarty, $Authorization;

        $data = unserialize($data['file']);
        $id = $data['id'];
        $html = $data['html'];

        if (!intval($data['id'])) {
            exit;
        }

        $data = $this->get(array('id'=>$id));

        if (!$data) $data = $this->getMaster(array('id'=>$id));

//_dump($data);exit;
        $date['month']  = $data['aktmonth'];
        $date['year']   = $data['aktyear'];

        if ($id==25868 && !$html)
        {
            $prev_id = 25868;//$db->getOne('SELECT id FROM insurance_akts WHERE id<>'.intval($data['id']).' AND agreement_number='.$db->quote($data['agreement_number']).' ORDER BY id DESC LIMIT 1');
            //$s['id'] = $prev_id;
            $s['id'] =$id;
            $s['html']=1;
            $url = 'http://e-insurance.in.ua/index.php?do=Akts|downloadFileInWindow&file='.serialize($s);
            $values['prevakt'] = file_get_contents($url);
        }

        $file['name']   = $data['id'] . '_' . $date['month'] . '_' . $date['year'];

        if ($data['person_types_id'] == 5) {//юр особа
            $row = $db->getRow('SELECT *  FROM '.PREFIX.'_agencies WHERE agreement_number = ' . $db->quote($data['agreement_number']));
        } else {
            $sql =  'SELECT * ' .
                'FROM ' . PREFIX . ($data['person_types_id']!=6 ? '_agents' : '_masters').' AS a ' .
                'JOIN ' . PREFIX . '_accounts AS b ON a.accounts_id = b.id '.
                'WHERE a.agreement_number = ' . $db->quote($data['agreement_number']) . ' ORDER BY b.active DESC';
            $row = $db->getRow($sql);

            $row['fop'] = $db->getRow('SELECT * FROM '.PREFIX.'_agencies WHERE director_fop_id='.intval($row['accounts_id']));

            $row['city'] =$db->getOne('SELECT reg.city FROM  insurance_agents a 
                JOIN insurance_agencies ag on ag.id=a.agencies_id
                JOIN insurance_agencies main_ag on main_ag.id=IF(ag.parent_id>0,ag.parent_id,ag.id)
                JOIN insurance_regions reg ON reg.id=main_ag.regions_id
                WHERE a.accounts_id='.intval($row['accounts_id']));

        }

        $row['aktdate']     = $MONTHES[ $date['month'] - 1 ] . ' ' . $date['year'];
        $row['aktnumber']   = $data['aktnumber'];
        $row['firstday']    = date('d.m.Y', mktime(0, 0, 0, $date['month'], 1, intval($date['year'])));
        $row['lastday']     = date('d.m.Y', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));

        $row['firstday_db'] = date('Y-m-d', mktime(0, 0, 0, $date['month'], 1, intval($date['year'])));
        $row['lastday_db']  = date('Y-m-d 23:59:59', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));

        $row['firstday1']   = date('Y-m-d', mktime(0, 0, 0, $date['month']+1, 1, intval($date['year'])));

        if ($data['person_types_id'] != 6) {

            //выбираем полиса
            $sql = 'SELECT
                    a.product_types_id,
                    a.date,a1.number,
                    a.insurance_companies_id,a.begin_datetime,a.end_datetime ,
                    a.item, a.amount,a1.commission_percent_white,   a1.commission_amount_white,a1.payment_amount,a1.statuses_id,
                    h.shassi, fin.title AS financial_institutions_title,
                    IF(e1.id>0,e1.title,e.title) as agencies_title, IF(e1.id>0,e1.id,e.id) as agencies_id, IF(sellerA2.id>0, sellerA2.id, sellerA1.id) as seller_agencies_id,
                    CONCAT(f1.lastname, \' \', f1.firstname) as mangersFIO,e2.title as generaliTitle,e2.director1 as director1Generali, e2.director2 as director2Generali, e2.address as addressGenerali, e2.phones as phonesGenerali, e2.banking_details as banking_detailsGenerali, e2.ground_akt as ground_akt_generali,
                    a.solutions_id,k.payment_date,
                    CASE a.product_types_id
                    WHEN ' . PRODUCT_TYPES_KASKO . ' THEN CONCAT(b.insurer_lastname, \' \', b.insurer_firstname, \' \', b.insurer_patronymicname)
                    WHEN ' . PRODUCT_TYPES_GO . ' THEN CONCAT(h.insurer_lastname, \' \', h.insurer_firstname, \' \', h.insurer_patronymicname)
                    WHEN ' . PRODUCT_TYPES_DGO . ' THEN CONCAT(h1.insurer_lastname, \' \', h1.insurer_firstname, \' \', h1.insurer_patronymicname)
                    WHEN ' . PRODUCT_TYPES_NS . ' THEN CONCAT(h2.insurer_lastname, \' \', h2.insurer_firstname, \' \', h2.insurer_patronymicname)
                    ELSE \'\'
                    END as fio

                    FROM insurance_akts_contents a1 JOIN insurance_policies a on a.id=a1.policies_id
                    JOIN  insurance_policy_payments_calendar k on k.id=a1.payments_calendar_id
                    LEFT JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id
                    LEFT JOIN ' . PREFIX . '_policies_go AS h ON a.id = h.policies_id
                    LEFT JOIN ' . PREFIX . '_policies_dgo AS h1 ON a.id = h1.policies_id
                    LEFT JOIN ' . PREFIX . '_policies_ns AS h2 ON a.id = h2.policies_id
                    LEFT JOIN ' . PREFIX . '_financial_institutions AS fin ON b.financial_institutions_id = fin.id
                    JOIN ' . PREFIX . '_agencies AS e ON a.agencies_id = e.id
                    LEFT JOIN ' . PREFIX . '_agencies AS e1 ON e1.id = e.parent_id
                    JOIN ' . PREFIX . '_agencies AS sellerA1 ON a.seller_agencies_id = sellerA1.id
                    LEFT JOIN ' . PREFIX . '_agencies AS sellerA2 ON sellerA2.id = sellerA1.parent_id
                    JOIN ' . PREFIX . '_agents AS f ON a.agents_id = f.accounts_id
                    JOIN ' . PREFIX . '_accounts AS f1 ON a.agents_id = f1.id
                    LEFT JOIN ' . PREFIX . '_generali_branches AS e2 ON e2.id = e.generali_branches_id
                    WHERE a1.documents=1 AND a1.statuses_id>=3 AND a1.akts_id='.intval($data['id']).' order by IF(e1.id>0,e1.id,e.id)';




            $row['policies'] = $db->getAll($sql);

            $sql = 'SELECT
                    min(b1.date)
                    FROM insurance_akts_contents a1 JOIN insurance_policies a on a.id=a1.policies_id
                    JOIN insurance_policies AS b1 ON b1.id = a1.policies_id
                    WHERE commission_amount_white>0 and a1.documents=1 AND a1.statuses_id>=3 AND a1.akts_id='.intval($data['id']);
            $row['min_date'] = $db->getOne($sql);

            $sum = 0;
            $gocount = 0;
            if ((is_array($row['policies']) && sizeof($row['policies'])>0) || $row['agencies_id']>0) {

            	if($row['policies'][0]['agencies_id'] && intval($row['policies'][0]['agencies_id']) != 1469)
            		$agencies_id = $row['policies'][ 0 ]['agencies_id'];
            	elseif($row['policies'][0]['agencies_id'] && $row['policies'][0]['seller_agencies_id'] && intval($row['policies'][0]['agencies_id']) === 1469)
            		$agencies_id = intval($row['policies'][0]['seller_agencies_id']);
            	else
            		$agencies_id = $row['agencies_id'];

                $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_agencies ' .
                    'WHERE id = ' . intval($agencies_id);
                $row['agency'] = $db->getRow($sql);

                $row['agency']['aktnumber'] = $row['agency']['agreement_number'] . $date['month'] . '.' . $date['year'];



            }

            $ek = $db->getAll('SELECT * FROM '.PREFIX.'_akts_express_credit_contents WHERE  akts_id='.$data['id']);
            if (is_array($ek) && sizeof($ek)>0) {//заполнения актов ЭК полисами ГО
                $rest = 0;
                foreach($ek as $e) {
                    $row['policies'][] = array(
                        'fio'                   => $e['client'],
                        'item'                  => $e['cars_title'],
                        'shassi'                => '',
                        'commission_amount_white' => $e['commission_amount_white']>50 ? 50 : $e['commission_amount_white'],
                        'statuses_id'        =>3,
                        'product_types_id'      => PRODUCT_TYPES_EK,
                        'additional'            => 0);
                    $rest+= $e['commission_amount_white']>50 ? $e['commission_amount_white'] - 50 : 0; //остаток свыше 50 грн заполнить рандомными полисами ГО
                }

                //заполнение остатка
                if ($rest>0) {
                    $policiescount = intval($rest/50)+1;
                    $sql =  'SELECT CONCAT(insurer_lastname , \' \', insurer_firstname , \' \', insurer_patronymicname )as fio, CONCAT(brand,\' \',model) as cars_title, shassi
                             FROM insurance_policies AS a
                             JOIN insurance_policies_go AS b ON a.id = b.policies_id
                             WHERE LENGTH(insurer_lastname) > 4 AND LENGTH(shassi)>17 AND a.payment_statuses_id>1 ' .
                        'ORDER BY RAND() ' .
                        'LIMIT ' . $policiescount;
                    $res = $db->query($sql);

                    while ($res->fetchInto($policy)) {
                        $row['policies'][] = array(
                            'fio'                   => $policy['fio'],
                            'item'                  => $policy['cars_title'],
                            'shassi'                => $policy['shassi'],
                            'commission_amount_white' => $rest>=50 ? 50 : $rest,
                            'statuses_id'        =>3,
                            'product_types_id'      => PRODUCT_TYPES_EK,
                            'additional'            => 0);

                        $rest-=50;
                        if ($rest<0) $rest = 0;
                    }
                }
            }

            $scoring = $db->getAll('SELECT * FROM '.PREFIX.'_akts_scoring_contents WHERE  akts_id='.$data['id']);
            if (is_array($scoring) && sizeof($scoring)>0) {
                foreach($scoring as $s) {
                    $sum+=$s['commission_amount'];
                    $gocount++;
                    $row['policies'][] = array(
                        'fio'                   => $s['client'],
                        'item'                  => $s['cars_title'],
                        'shassi'                => '',
                        'commission_amount'     => $s['commission_amount'],
                        'statuses_id'           =>3,
                        'product_types_id'      => PRODUCT_TYPES_EK,
                        'additional'            => 0);
                }
            }

            //дополнительно для форимановария акта как из лизинга
            if (is_array($row['policies'])) {

                foreach ($row['policies'] as $r) {
                    $totalAkt += $r['commission_amount_white'];
                }

                $sql = 'SELECT IF(b1.id>0,b1.code ,b.code) as code
                    FROM  insurance_agents a
                    JOIN insurance_agencies b on b.id=a.agencies_id
                    LEFT JOIN insurance_agencies b1 on b.parent_id=b1.id
                    WHERE  a.agreement_number  = '.$db->quote($data['agreement_number']).' LIMIT 1';
                $agency_code     = $db->getOne($sql);
                $client = new SoapClient('https://express-credit.in.ua/synchronization/express/sql.php?WSDL',array('trace' => 1));
                $result=$client->getAll(array("sql" => 'SELECT  code  FROM ukrauto_auto_shows WHERE codeEI = '.$db->quote($agency_code).''));
                $result=(string)$result->getAllResult;
                $list = XML2Array::createArray($result);

                if ($list['rows']['row']) {
                    $ek_ag_code = $list['rows']['row']['code'];
                    $ek_ag_code.='-%';
                }  else {
                    $ek_ag_code = '%';
                }

                $result=$client->getAll(array("sql" => 'SELECT  a.number,a.borrowerIdentificationCode,CONCAT(borrowerLastname,\' \',borrowerFirstname,\' \',borrowerPatronymicname) as fio,bankCreditAgreementAmount+IF(creditAgreement_amountGBO>0,creditAgreement_amountGBO,0)+ IF(insurance_kasko_amount>0,insurance_kasko_amount,0)   as creditAgreement_amount,0 as commission   FROM ukrauto_questionnaires a JOIN ukrauto_questionnaire_solutions b on b.questionnairesId=a.id WHERE a.number like   '.$db->quote($ek_ag_code).' AND year(a.created)=2013 AND solution_statesId>=23 ORDER BY RAND() LIMIT 1000 '));
                $result=(string)$result->getAllResult;
                $list = XML2Array::createArray($result);

                if (!is_array($list['rows']['row']) || sizeof($list['rows']['row'])<100) {
                    $result=$client->getAll(array("sql" => 'SELECT  a.number,a.borrowerIdentificationCode,CONCAT(borrowerLastname,\' \',borrowerFirstname,\' \',borrowerPatronymicname) as fio,bankCreditAgreementAmount+IF(creditAgreement_amountGBO>0,creditAgreement_amountGBO,0)+ IF(insurance_kasko_amount>0,insurance_kasko_amount,0)   as creditAgreement_amount,0 as commission   FROM ukrauto_questionnaires a JOIN ukrauto_questionnaire_solutions b on b.questionnairesId=a.id WHERE a.number like   '.$db->quote('%').' AND year(a.created)=2013 AND solution_statesId>=23 ORDER BY RAND() LIMIT 1000 '));
                    $result=(string)$result->getAllResult;
                    $list1 = XML2Array::createArray($result);
                    if(is_array($list1['rows']['row']) ) {
                        foreach($list1['rows']['row'] as $r) {
                            $list['rows']['row'][]=$r;
                        }
                    }
                }

                if (is_array($list['rows']['row']) ) {
                    $t = $totalAkt;
                    $b = false;

                    foreach($list['rows']['row'] as $r) {
                        $r['commission'] = round($r['creditAgreement_amount']*0.4/100 ,2);
                        $r['percent'] = 0.4;
                        if ($t<=$r['commission']) {
                            $r['commission'] = round($t,2);
                            $r['creditAgreement_amount'] =   round($r['commission']*100/$r['percent'],2);
                            $b = true;
                        }

                        $row['solutions'][]=$r;
                        $row['totalCreditAmount']+=$r['creditAgreement_amount'];
                        $t-=$r['commission'];
                        if ($b) break;
                    }
                    $row['creditCount']=sizeof($row['solutions']);
                }
            }

            $template = 'akt.tpl';
            //$template = 'akt_skripnik.tpl';
            if ($html) {$template = 'akt_lising.tpl';}
        } else {//выбираем по мастерам

            $data['agreement_number'] = str_replace("ea/", "", $data['agreement_number']);
            $row['aktnumber'] = str_replace("ea/", "", $row['aktnumber']);

            if ($data['id'] > 24682 && $data['id']!=25608 && $data['id111']) {
                $row['lastday'] = date('d.m.Y', mktime(0, 0, 0, $date['month'] + 1, 0, intval($date['year'])));
                $template = 'akt_master_euassist.tpl';
                //$template = 'akt_master.tpl';
            } else {
                $template = 'akt_master.tpl';
            }
            //выбираем полиса
            $sql =  'SELECT
                a.product_types_id,
                a.date,a1.number,a3.number as accident_number,
                a.insurance_companies_id,a.begin_datetime,a.end_datetime ,
                a.item, a.amount,a1.commission_percent,     a1.commission_amount,a1.commission_percent_white,   
                a1.commission_amount_white,
                CONCAT(a3.applicant_lastname,\' \',a3.applicant_firstname, \' \',a3.applicant_patronymicname) as applicant_fio,

                CASE a.product_types_id
                WHEN ' . PRODUCT_TYPES_KASKO . ' THEN CONCAT(b.insurer_lastname, \' \', b.insurer_firstname, \' \', b.insurer_patronymicname)
                WHEN ' . PRODUCT_TYPES_GO . ' THEN CONCAT(h.insurer_lastname, \' \', h.insurer_firstname, \' \', h.insurer_patronymicname)
                ELSE \'\'
                END as fio,a1.comission_master,a1.comission_investigation

                FROM insurance_akts_contents a1 JOIN insurance_policies a on a.id=a1.policies_id '.
                //JOIN insurance_accidents a3 ON a3.id=a1.accidents_id
                '
                JOIN insurance_application_accidents a3 ON a3.id=a1.application_accidents_id
                LEFT JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id
                LEFT JOIN ' . PREFIX . '_policies_go AS h ON a.id = h.policies_id

                WHERE  a1.akts_id=' . intval($data['id']) . ' ORDER BY a.product_types_id';
            $row['policies'] = $db->getAll($sql);
            $row['aktnumber'] = str_replace ( 'ДМ/' , '' , $row['aktnumber'] );
        }


        $list = $row['policies'];

        $totals=array();
        $plan = $db->getAll('
                    SELECT IF(k2.id>0, k2.title, k1.title) AS agencyTitle, a.number, item, a.price, a.amount AS amount, a.insurer, CONCAT(ag1.lastname , \' \', ag1.firstname) AS fiomanager,
                    b.financial_institutions_id, f.title AS financial_institutionstitle, c.datetime, a.solutions_id, a.bank_akt_payment_date, a.register_car_date,a1.types_id
                    FROM insurance_akts_plan_contents a1 JOIN ' . PREFIX . '_policies AS a ON a1.policies_id=a.id
                    LEFT JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id
                    JOIN ' . PREFIX . '_agencies AS k1 ON a.agencies_id = k1.id
                    LEFT JOIN ' . PREFIX . '_agencies AS k2 ON k1.parent_id = k2.id
                    JOIN ' . PREFIX . '_agents AS ag ON a.agents_id = ag.accounts_id
                    JOIN ' . PREFIX . '_accounts AS ag1 ON a.agents_id = ag1.id
                    LEFT JOIN (SELECT policies_id, MIN(datetime) AS datetime FROM ' . PREFIX . '_policy_payments GROUP BY policies_id) AS c ON a.id = c.policies_id
                    LEFT JOIN ' . PREFIX . '_financial_institutions AS f ON b.financial_institutions_id = f.id
                    WHERE a1.akts_id='.$data['id']);

        if ($data['person_types_id']==3) {//зам выбираем доп инфо из ЭК
            $sql = 'SELECT b.code
                    FROM insurance_agents a
                    JOIN insurance_agencies b on director2_id=a.accounts_id
                    WHERE  a.agreement_number  = '.$db->quote($data['agreement_number']).' limit 1 ';
            $agency_code = $db->getOne($sql);

            if ($agency_code) {
                $client = new SoapClient('https://express-credit.in.ua/synchronization/express/sql.php?WSDL',array('trace' => 1));
                $result=$client->getAll(array("sql" => 'SELECT id,codeAxapta FROM ukrauto_auto_shows WHERE codeEI = '.$db->quote($agency_code).''));
                $result=(string)$result->getAllResult;
                $list = XML2Array::createArray($result);
                //_dump($list['rows']['row']);exit;
                $ag_id = $list['rows']['row']['id'];
                $codeAxapta= $list['rows']['row']['codeAxapta'];
                $sql = 'SELECT a.car_brandsId, b.title
                        FROM ukrauto_auto_show_car_brand_assignments a
                        JOIN ukrauto_car_brands b on b.id=a.car_brandsId
                        WHERE a.auto_showsId = ' .  intval($ag_id);
                $result = $client->getAll(array("sql" => $sql));

                $result = (string)$result->getAllResult;
                $list = XML2Array::createArray($result);
                $sales = $list['rows']['row'];

                foreach ($sales as $i=>$s) {
                    if (!isset($sales[$i]['ek'])) {$sales[$i]['ek'] = 0;$sales[$i]['ekdetails'] = array();}
                }

                $from = $db->quote($data['beginDate']);
                $to = $db->quote($data['endDate']);

                $sql = 'SELECT b.brands_id, sum(b.fact) as fact
                        FROM  ukrauto_sold_cars  a
                        JOIN ukrauto_sold_cars_details b on b.id_sold_cars=a.id
                        WHERE a.codeAxapta ='.$codeAxapta.' AND download_date between '. $from .' and '. $to . '
                        GROUP BY b.brands_id';
                $result = $client->getAll(array("sql" => $sql));

                $result = (string)$result->getAllResult;
                $list = XML2Array::createArray($result);
                if (isset($list['rows']['row'])) {
                    $factsales = $list['rows']['row'];
                    if (!isset($factsales[0]) && isset($factsales['car_brandsId'])) {
                        $factsales1 = $factsales;
                        $factsales = array();
                        $factsales[0] = $factsales1;
                    }
                    if (isset($factsales[0])) {
                        foreach($factsales as $fs) {
                            foreach($sales as $i=>$s) {
                                if ($s['car_brandsId'] == $fs['brands_id'])
                                {
                                    $sales[$i]['fact'] = $fs['fact'];
                                }
                            }
                        }
                    }
                }
                $sql = 'SELECT IF(d1.id>0,d1.id,d.id) as salonId, c.brand, c.number, c.carsTitle, concat(borrowerLastname,\' \',borrowerFirstname,\' \',borrowerPatronymicname) as fio from ukrauto_questionnaires c
                        JOIN ukrauto_auto_shows d ON d.id=c.auto_showsId
                        LEFT OUTER JOIN ukrauto_auto_shows d1 ON d1.id = d.parentId
                        JOIN (
                            SELECT distinct a1.questionnairesId as id
                            FROM ukrauto_questionnaire_solution_state_changes a
                            JOIN ukrauto_questionnaire_solutions a1 on a1.id=a.solutionsId
                            JOIN (
                                SELECT min(created) as created, solutionsId
                                FROM ukrauto_questionnaire_solution_state_changes
                                WHERE solution_statesId IN (15,17,19,20,22,23,24,25,26)  and scoring<>1 and created>=\'2009-01-01\'
                                GROUP BY solutionsId)  b ON a.created=b.created and a.solutionsId=b.solutionsId
                            WHERE a.solution_statesId IN (15,17,19,20,22,23,24,25,26) and a1.solution_statesId>=15  and a.created BETWEEN '.$from.' and '.$to.'
                        ) c11 ON c11.id=c.id
                        WHERE c.modified>=DATE_SUB( '.$from.', INTERVAL 1 MONTH )  and c.typesId=1 and IF(d1.id>0,d1.id,d.id)='.$ag_id;
                $result = $client->getAll(array("sql" => $sql));

                $result = (string)$result->getAllResult;
                $list = XML2Array::createArray($result);
                if (isset($list['rows']['row'])) {
                    $factEKsales = $list['rows']['row'];

                    if (!isset($factEKsales[0]) && isset($factEKsales['salonId'])) {
                        $factsales1 = $factEKsales;
                        $factEKsales = array();
                        $factEKsales[0] = $factsales1;
                    }
                    if (isset($factEKsales[0])) {
                        foreach($factEKsales as $fEKs) {
                            foreach($sales as $i=>$s) {
                                if ($s['title'] == $fEKs['brand']) {

                                    $sales[$i]['ek']++;
                                    $sales[$i]['ekdetails'][] = $fEKs;
                                }
                            }
                        }
                    }
                }
                $Smarty->assign('zamsales', $sales);
            }
        }

        //$sql= 'SELECT * FROM insurance_fin_monitoring where date>='.$db->quote($row['min_date']).' OR date>=\'2015-12-01\' order by date';
        $sql= 'SELECT * FROM insurance_fin_monitoring where  date>=\'2016-03-01\' order by date';
        $finmonitoring = $db->getAll($sql);
        $Smarty->assign('finmonitoring', $finmonitoring);
        $Smarty->assign('data', $data);
        $Smarty->assign('plan', $plan);
        $Smarty->assign('scoring', $scoring);
        $Smarty->assign('ek', $ek);

        $Smarty->assign('values', $values);
        $Smarty->assign('row', $row);
        $Smarty->assign('list', $list);
        $Smarty->assign('totals', $totals);
        $file['content'] = $Smarty->fetch($this->object . '/' . $template);

        if ($html) {
            echo $file['content'];exit;
        }

        html2pdf($file);
        exit;
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;

        if (!$this->permissions['delete']) {
            $hide_fields = array(
                'number',
                'agreement_number',
                'person_types_id',
                'agent_name',
                'credit_cars',
                'not_credit_cars',
                'continued_cars',
                'continued_cars',
                'go_cars',
                'k');

            foreach ($hide_fields as $f) {
                $this->formDescription['fields'][ $this->getFieldPositionByName($f) ]['type'] = fldHidden;
            }
        }

        $redirect = $data['redirect'];
        $this->checkPermissions('update', $data);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =  'SELECT ' . implode(', ', $this->formFields) . ' ' .
            'FROM ' . $this->tables[0] . ' ' .
            'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);
        $data['redirect'] = $redirect;

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    //перенос полисов из актов в акт людям которые привели клиента manual ставим =1
    function moveManagersAktInWindow($data) {
        global $db;

        $sql = 'SELECT DISTINCT manager_id
                FROM insurance_akts_contents a
                JOIN insurance_akts b ON b.id=a.akts_id
                WHERE b.number like \'%'.AKT_PERIOD.'\' AND a.manager_id>0 AND a.types_id=1';
        $list = $db->getCol($sql);

        foreach ($list as $manager_id) {

            $sql = 'SELECT * FROM insurance_agents a  WHERE accounts_id='.intval($manager_id);
            $agent = $db->getRow($sql);

            if ($agent && $agent['agreement_number']) {//находим акт по агенту на которого перебрасывать
                $sql= 'SELECT id FROM insurance_akts WHERE agreement_number='.$db->quote($agent['agreement_number']).' AND number like  \'%'.AKT_PERIOD.'\'';
                $akts_id = $db->getOne($sql);
                if ($akts_id >0) {
                    $sql = 'INSERT INTO insurance_akts_contents(akts_id,payments_calendar_id,accidents_id,policies_id,manager_id,
                                number,payment_amount,base_commission_percent,base_commission_amount,commission_percent,
                                commission_amount,types_id,statuses_id,documents,manual,created,modified)
                                SELECT '.$akts_id.', payments_calendar_id, accidents_id, a.policies_id, 0, a.number, a.payment_amount, 
                                base_commission_percent, base_commission_amount, 
                                commission_percent, commission_amount, 
                                a.types_id, a.statuses_id, a.documents, 1, NOW(), NOW()
                                FROM insurance_akts_contents a
                                JOIN insurance_akts b on b.id=a.akts_id
                                JOIN insurance_policies p ON p.id=a.policies_id
                                LEFT JOIN insurance_akts_plan_contents c on c.akts_id=a.akts_id and c.policies_id=a.policies_id and c.types_id in (1,2,3,4)
                                WHERE b.number like \'%'.AKT_PERIOD.'\' and a.manager_id='.$manager_id.' and a.types_id=1 ';
                    $db->query($sql);
                }

            }
        }

        echo 'done';
    }




    //создание актов по замам по сервису
    function createServiceAktsInWindow($data) {
        global $db;



        $sql = 'select a.id as servicenumber,e.id as zamnumber
                from insurance_akts a
                join insurance_agents b on b.agreement_number=a.agreement_number
                join insurance_agencies c on c.id=b.agencies_id
                left join insurance_agents d on d.accounts_id=c.director2_id
                left join insurance_akts e on e.agreement_number=d.agreement_number
                where a.person_types_id=7 and a.number like \'%'.AKT_PERIOD.'\' and  e.number like \'%'.AKT_PERIOD.'\' ';

        //_dump($sql);exit;

        $list = $db->getAll($sql);

        foreach ($list as $r) {

            $sql = 'INSERT INTO insurance_akts_contents(akts_id,payments_calendar_id,accidents_id,policies_id,manager_id,
                        number,payment_amount,base_commission_percent,base_commission_amount,commission_percent,
                        commission_amount,types_id,statuses_id,documents,manual,created,modified)
                        SELECT '.$r['servicenumber'].', payments_calendar_id, accidents_id, a.policies_id, 0, a.number, a.payment_amount, 
                        base_commission_percent, base_commission_amount, 
                        base_commission_percent, base_commission_amount, 
                        a.types_id, a.statuses_id, a.documents, 1, NOW(), NOW()
                        FROM insurance_akts_contents a
                        JOIN insurance_akts b on b.id=a.akts_id
                        JOIN insurance_policies p ON p.id=a.policies_id
                        JOIN  insurance_agents p1 on p1.accounts_id=p.manager_id
                        WHERE a.types_id=1 and b.id ='.$r['zamnumber'].'   and p1.service=1 ';
            $db->query($sql);


        }

        echo 'done';
    }


    function exportInWindow($data) {
        global $db, $Smarty,$Authorization;

        $this->checkPermissions('exportbank', $data);


        $conditions[] = 'hide = 0';
        if (strlen($data['agent_name'])>0) {
            $search_str=trim($data['agent_name']);
            $search_str.='%';
            $conditions[] = $this->tables[0] . '.agent_name like ' . $db->quote($search_str);
        }

        if (strlen($data['agreement_number'])>0) {
            $search_str=trim($data['agreement_number']);
            $conditions[] = $this->tables[0] . '.agreement_number like ' . $db->quote($search_str);
        }

        if (strlen($data['number'])>0) {
            $search_str=trim($data['number']);
            $conditions[] = $this->tables[0] . '.number like ' . $db->quote($search_str);
        }

        if (is_array($data['payment_statuses_id'])) {
            $fields[] = 'payment_statuses_id';
            $conditions[] = 'payment_statuses_id IN(' . implode(', ', $data['payment_statuses_id']) . ')';
        }

        if (is_array($data['person_types_id'])) {
            $fields[] = 'person_types_id';
            $conditions[] = 'person_types_id IN(' . implode(', ', $data['person_types_id']) . ')';
        }

        if (strlen($data['policy_number'])>0) {
            $search_str=trim($data['policy_number']);
            $conditions[] = PREFIX . '_akts.id IN (SELECT a.akts_id FROM ' . PREFIX . '_akts_contents a JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id WHERE b.number =' . $db->quote($search_str).' '.($data['payed'] ? ' AND a.statuses_id=3  AND a.documents=1 ' : ' ').' )';
        }

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(' . $this->tables[0] . '.date) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] =  'TO_DAYS(' . $this->tables[0] . '.date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }





        if ($Authorization->data['roles_id'] == ROLES_MANAGER && in_array(33, $Authorization->data['account_groups_id'])) {
            $conditions[] = 'person_types_id = 6';
            $conditions[] = PREFIX . '_akts.id > 24682';
        }

        if ($Authorization->data['roles_id'] == ROLES_MANAGER) {
            if (!$this->permissions['showop']) {//скрыть отдел продаж
                $sql =  'SELECT agreement_number ' .
                    'FROM ' . PREFIX . '_agents ' .
                    'WHERE LENGTH(agreement_number)>2 AND agencies_id =1469 ';

                $agreement_numbers = array();
                $agreement_numbers1 = $db->getCol($sql);

                if (is_array($agreement_numbers1)) {
                    foreach($agreement_numbers1 as $r) {
                        $agreement_numbers[] = $db->quote($r);
                    }
                    $conditions[] = PREFIX . '_akts.agreement_number NOT IN(' . implode(', ', $agreement_numbers) . ')';
                }
            }
        }

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        $sql =  'SELECT  ' . PREFIX . '_akts.id,agreement_number,getAktAmountBlack(' . PREFIX . '_akts.id) as payment_amount ' .
            'FROM ' . PREFIX . '_akts ' .
            'JOIN ' . PREFIX . '_payment_statuses ON ' . PREFIX . '_akts.payment_statuses_id = ' . PREFIX . '_payment_statuses.id ' ;



        $sql .= 'WHERE ' . implode(' AND ', $conditions);

        $sql.= ' ORDER BY ';



        $sql .= $this->getShowOrderCondition();


        $list = $db->getAll($sql);
        $result= array();
        foreach($list as $r)
        {
            $a = $db->getRow('select a.*,b.*,reg.title as region from 
            insurance_agents a 
            join insurance_accounts b on b.id=a.accounts_id 
            join insurance_agencies ag on ag.id=a.agencies_id
            join insurance_regions reg on reg.id=ag.regions_id
            where a.agreement_number = '.$db->quote($r['agreement_number']).' 
            order by b.active desc');
            $row = array();
            $row['lastname'] = $a['lastname'];
            $row['firstname'] = $a['firstname'];
            $row['patronymicname'] = $a['patronymicname'];
            $row['skr'] = $a['skr'];
            $row['bank_name'] = $a['bank_name'];
            $row['cart_date'] = $a['cart_date'];

            $row['passport_series'] = $a['passport_series'];
            $row['passport_number'] = $a['passport_number'];
            $row['passport_date'] = $a['passport_date'];
            $row['current_date'] = date('Y-m-d');
            $row['passport_place'] = $a['passport_place'];
            $row['phone'] = $a['phone'];
            $row['region'] = $a['region'];

            $row['payment_amount'] = round(doubleval($r['payment_amount']),2);


            $result[] = $row;
        }
        /*_dump($result);exit;
 
         header('Content-Disposition: attachment; filename="export.pdf"');
        header('Content-Type: ' . Form::getContentType('export.pdf'));

         header('Accept-Ranges: bytes');
         header('Expires: 0');
         header('Cache-Control: private');
        $sql    = $this->show($data, $fields, $conditions, null, $this->object . '/export.tpl', false);*/

        $Smarty->assign('values', $result);

        $file['name'] = 'export.pdf';
        $file['content'] = $Smarty->fetch($this->object . '/payments.tpl' );
        //echo $file['content'];exit;
        html2pdf($file);
        exit;
    }


    function exportInWindowCustomArzyaeva($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true)
    {
        global $db, $PAYMENT_STATUSES, $Authorization;
        if ($_SESSION['auth']['agencies_id']==1469 || $_SESSION['auth']['id']==13497) exit;
        $this->checkPermissions('show', $data);

        $hidden['do'] = $data['do'];

        $fields['payment_statuses_id']              = $this->formDescription['fields'][ $this->getFieldPositionByName('payment_statuses_id') ];
        $fields['payment_statuses_id']['type']      = fldMultipleSelect;
        $fields['payment_statuses_id']['list']      = $PAYMENT_STATUSES;
        $fields['payment_statuses_id']['object']    = $this->buildSelect($fields['payment_statuses_id'], $data['payment_statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data);

        $personTypes = array(
            1 => 'фiз особа агент',
            2 => 'фiз особа директор',
            3 => 'фiз особа заст. директора',
            4 => 'фiз особа керiвник вiдд продажу',
            6 => 'фiз особа майстер СТО',
            5 => 'юр особа',
            8 => 'фiз особа агент сервiс',
            7 => 'фiз особа заст. директора сервiс'
        );

        $fields['person_types_id']              = $this->formDescription['fields'][ $this->getFieldPositionByName('person_types_id') ];
        $fields['person_types_id']['type']      = fldMultipleSelect;
        $fields['person_types_id']['list']      = $personTypes;
        $fields['person_types_id']['object']    = $this->buildSelect($fields['person_types_id'], $data['person_types_id'], $data['languageCode'], 'multiple size="3"', null, $data);

        $conditions[] = 'hide = 0';

        if ($Authorization->data['roles_id'] == ROLES_AGENT) {
            $data['agencies_id'] = intval($Authorization->data['agencies_id']);
            $Agencies = new Agencies($data);
            $agencies_id = array($data['agencies_id']);
            $Agencies->getSubId(&$agencies_id, $data['agencies_id']);

            $sql =  'SELECT agreement_number ' .
                'FROM ' . PREFIX . '_agents ' .
                'WHERE LENGTH(agreement_number)>2 AND agencies_id IN(' . implode(', ', $agencies_id) . ')'.
                'UNION ALL '.
                'SELECT agreement_number ' .
                'FROM ' . PREFIX . '_agencies ' .
                'WHERE LENGTH(agreement_number)>2 AND id IN(' . implode(', ', $agencies_id) . ')';

            $agreement_numbers = array();
            $agreement_numbers1 = $db->getCol($sql);

            if (is_array($agreement_numbers1)) {
                foreach($agreement_numbers1 as $r) {
                    $agreement_numbers[] = $db->quote($r);
                }
                $conditions[] = 'akts.agreement_number IN(' . implode(', ', $agreement_numbers) . ')';
            } else {
                $conditions[] = 'akts.agreement_number IN(\'0\')';
            }
        }

        if ($Authorization->data['roles_id'] == ROLES_MASTER) {
            /*$sql =    'SELECT agreement_number ' .
                    'FROM ' . PREFIX . '_masters ' .
                    'WHERE LENGTH(agreement_number)>2 AND car_services_id ='.intval($Authorization->data['car_services_id']);*/
            $sql =  'SELECT agreement_number ' .
                'FROM ' . PREFIX . '_masters ' .
                'WHERE LENGTH(agreement_number)>2 AND accounts_id ='.intval($Authorization->data['id']);
            $agreement_numbers = array();
            $agreement_numbers1 = $db->getCol($sql);

            if (is_array($agreement_numbers1)) {
                foreach($agreement_numbers1 as $r) {
                    $agreement_numbers[] = $db->quote($r);
                }
                $conditions[] = 'akts.agreement_number IN(' . implode(', ', $agreement_numbers) . ')';
            } else {
                $conditions[] = 'akts.agreement_number IN(\'0\')';
            }
        }

        if ($Authorization->data['roles_id'] == ROLES_MANAGER && in_array(33, $Authorization->data['account_groups_id'])) {
            $conditions[] = 'person_types_id = 6';
            $conditions[] = 'akts.id > 24682';
        }

        if ($Authorization->data['roles_id'] == ROLES_MANAGER) {
            if (!$this->permissions['showop']) {//скрыть отдел продаж
                $sql =  'SELECT agreement_number ' .
                    'FROM ' . PREFIX . '_agents ' .
                    'WHERE LENGTH(agreement_number)>2 AND agencies_id =1469 ';

                $agreement_numbers = array();
                $agreement_numbers1 = $db->getCol($sql);

                if (is_array($agreement_numbers1)) {
                    foreach($agreement_numbers1 as $r) {
                        $agreement_numbers[] = $db->quote($r);
                    }
                    $conditions[] = 'akts.agreement_number NOT IN(' . implode(', ', $agreement_numbers) . ')';
                }
            }
        }

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        if($data['from'])
        {
            $conditions[] = "akts.date >= DATE '" . date('Y-m-d', strtotime($data['from'])) . "'";
        } else {
            $conditions[] = "akts.date >= DATE '2015-01-01'";
        }

        if($data['to'])
        {
            $conditions[] = "akts.date <= DATE '" . date('Y-m-d', strtotime($data['to'])) . "'";
        }

        if($data['number'])
        {
            $conditions[] = "akts.number LIKE '" . htmlspecialchars($data['number']) . "'";
        }

        $sql = "SELECT akts.number as akt_number, akts.date akt_date, akts.agent_name as akt_agent_name ,statuses1.title akt_status, acc.number as acc_number, aktsCon.number, policies.insurer, aktsCon.comission_master, aktsCon.comission_investigation, aktsCon.commission_amount_white
                FROM insurance_akts akts
                LEFT JOIN insurance_akts_contents aktsCon on akts.id = aktsCon.akts_id
                LEFT JOIN insurance_payment_statuses statuses1 on statuses1.id = akts.payment_statuses_id
                LEFT JOIN insurance_policies policies on aktsCon.policies_id = policies.id
                LEFT JOIN insurance_application_accidents acc on aktsCon.application_accidents_id = acc.id";
        $sql = $sql . ' WHERE ' .implode(' AND ', $conditions);

        $list = $db->getall($sql);
        header('Content-Disposition: attachment; filename="report.xls"');
        header('Content-Type: ' . Form::getContentType('report.xls'));
        include_once $this->object . '/excelArzyaeva.php';
    }

    /*генерация акта на человека с отдела продаж*/
    function generateSellersAkt($data) {
        global $db,$Log;

        $this->checkPermissions('change', $data);

        if ($data['id']) {
            $row = $this->get($data);

            if ($row['payment_statuses_id'] != 1) {
                $Log->add('error', 'Акт в статусi сплачено оновлення атку не можливе');
                return false;
            }
        } elseif ($data['agreement_number']) {
            $buildtime = time();
            $date = getdate($buildtime);
            $date['mon']--;

            if ($date['mon'] == 0) {
                $date['mon'] = 12;
                $date['year']--;
            }

            $aktnumber = $data['agreement_number'] . '.' . (sprintf('%02d', $date['mon'])) . '.' . substr($date['year'], 2);
            $data['number'] = $aktnumber;
            $row = $this->get($data);

            if (!$row) {//нет акта создаем новый

                $sql =  'SELECT accounts_id, CONCAT(lastname, \' \', firstname) AS fio ' .
                    'FROM ' . PREFIX  . '_accounts AS a ' .
                    'JOIN ' . PREFIX . '_agents AS b ON a.id = b.accounts_id ' .
                    'WHERE agreement_number = ' . $db->quote($data['agreement_number']);
                $agents = $db->getAll($sql);

                if (!$agents) return;
                $accounts_id = array();
                $person_types_id = 0;

                foreach($agents as $agent) {
                    $agent_name = $agent['fio'];
                    $accounts_id[]=$agent['accounts_id'];
                }


                if (!$person_types_id) $person_types_id = 1;//фiз особа агент
                if ($person_types_id != 1) return;
                $row['agreement_number'] = $data['agreement_number'];
                $row['number'] = $aktnumber;
                $row['date'] = '20'.substr($date['year'], 2).'-' . sprintf('%02d', $date['mon']) . '-01';
                $row['date_year'] = '20'.substr($date['year'], 2);
                $row['date_month'] =  sprintf('%02d', $date['mon']);
                $row['date_day'] =  '01';
                $row['person_types_id'] = $person_types_id;
                $row['payment_statuses_id'] = 1;
                $row['agent_name'] = $agent_name;
                $row['file'] = 1;
                $row['k']=1;
                $row['sellers_department']=1;
                $row['id'] = $this->insert($row,false);
                $row = $this->get($row);
            }
        }

        if (!$row) return;
        $factData = $this->getFactPoliciesSellers($row);

        //чистим содержимое акта
        $db->query('DELETE FROM insurance_akts_contents WHERE manual=0 AND akts_id='.intval($row['id']));
        //чистим содержимое плановых полисов акта
        $db->query('DELETE FROM insurance_akts_plan_contents WHERE akts_id='.intval($row['id']));

        //находим план

        $plan = $db->getRow('SELECT b.* FROM insurance_policy_plans a JOIN insurance_policy_plans_agents b on a.id=b.plans_id WHERE a.date='.$db->quote($row['beginDate']).' AND b.agreement_number='.$db->quote($row['agreement_number']));
        $planAgency = $db->getRow('SELECT b.* FROM insurance_policy_plans a
                                 JOIN insurance_policy_plans_agencies b on a.id=b.plans_id
                                 JOIN insurance_agencies c on c.id=b.agencies_id
                                 JOIN insurance_agents d on d.agencies_id=c.id 
                                 WHERE a.date='.$db->quote($row['beginDate']).' AND d.agreement_number='.$db->quote($row['agreement_number']));


        if ($plan) {
            $db->query('UPDATE insurance_akts SET credit_cars='.doubleval($plan['credit_cars']).',
                                                  not_credit_cars='.doubleval($plan['not_credit_cars']).',
                                                  continued_cars='.doubleval($plan['continued_cars']).',
                                                  go_cars='.doubleval($plan['go_cars']).' WHERE id='.intval($row['id']));

        }
        else $plan = array();


        $k = 1;

        //заполянем планы
        if ($factData) {
            $credit_carsFact = 0;
            $notcredit_carsFact1year = 0;
            $notcredit_carsFact2year = 0;
            $go_carsFact = 0;
            $dgo_carsFact = 0;


            $credit_carsFact_money = 0;
            $notcredit_carsFact1year_money = 0;
            $notcredit_carsFact2year_money = 0;
            $go_carsFact_money = 0;
            $dgo_carsFact_money = 0;

            foreach($factData as $r) {

                switch($r['type']) {
                    case 1:
                        break;
                    case 2:
                        if ($r['parent_id']>0) {
                            $notcredit_carsFact2year++;
                            //if ($r['t_id']>0 || $r['t1_id']>0)
                            $notcredit_carsFact2year_money+=doubleval($r['payedamount']);
                        }
                        else {
                            $notcredit_carsFact1year++;
                            $notcredit_carsFact1year_money+=doubleval($r['payedamount']);
                        }
                        break;
                    case 3:
                        //личный план
                        $credit_carsFact++;
                        $credit_carsFact_money+=$r['payedamount'];
                        break;
                    case 4:
                        if ($r['terms_id']==25 && $r['number_prolongation']>0) {//берем только 1 летние и пролонгированые
                            $go_carsFact++;
                            $go_carsFact_money+=doubleval($r['payedamount']);
                        }

                        break;
                    case 6:
                        $dgo_carsFact++;
                        $dgo_carsFact_money+=doubleval($r['payedamount']);

                        break;

                }
            }

            $credit_carsPercent = $plan['credit_cars']>0 ? $credit_carsFact*100/$plan['credit_cars'] : ($credit_carsFact>0 ? 101 : 100);
            $credit_carsPercent_money = $plan['credit_cars_money']>0 ? $credit_carsFact_money*100/$plan['credit_cars_money'] : ($credit_carsFact_money>0 ? 101 : 100);
            $notcredit_carsPercent1year_money = $plan['not_credit_cars_money']>0 ? $notcredit_carsFact1year_money*100/$plan['not_credit_cars_money'] : ($notcredit_carsFact1year_money>0 ? 101 : 100);
            $notcredit_carsPercent2year_money = $plan['not_credit_cars_money']>0 ? $notcredit_carsFact2year_money*100/$plan['not_credit_cars_money'] : ($notcredit_carsFact2year_money>0 ? 101 : 100);
            //_dump($plan['not_credit_cars_money']);_dump($notcredit_carsFact2year_money);exit;
            $go_carsPercent_money = $plan['go_cars_money']>0 ? $go_carsFact_money*100/$plan['go_cars_money'] : ($go_carsFact_money>0 ? 101 : 100);
            $dgo_carsPercent_money = $planAgency['dgo_cars_money']>0 ? $dgo_carsFact_money*100/$planAgency['dgo_cars_money'] : ($dgo_carsFact_money>0 ? 101 : 100);

            $row['own'] = 1;
            $factData = $this->getFactPoliciesSellers($row);

            foreach($factData as $r) {
                if ($r['type']==8) continue;//ритейл по всему предприятию занесли только в таблицу Факт виконання плану: для фiз особа

                $db->query('INSERT INTO insurance_akts_plan_contents(akts_id,policies_id,number,types_id,created,modified) values('.
                    $row['id'].','.$r['id'].','.$db->quote($r['number']).','.intval($r['type']).',NOW(),NOW()) ');


                //заполняем часть к оплате
                $from = $db->quote($row['beginDate']);
                $to = $db->quote($row['endDate']);

                $AktsContents=new AktsContents($data);
                $calendar=$db->getAll('SELECT a.id,a.amount,a.commission_agent_amount,a.commission_director1_amount,a.commission_director2_amount,b.commission_agent_percent,b.commission_director1_percent,b.commission_director2_percent,b.commission,b.product_types_id as documents,b.manager_id,b.product_types_id 
                FROM insurance_policy_payments_calendar a 
                JOIN insurance_policies b on b.id=a.policies_id 
                WHERE a.policies_id='.intval($r['id']).' AND a.payment_date between '.$from.' AND '.$to.' AND a.statuses_id>=3');


                foreach($calendar as $c) {

                    $discounts = array();
                    if ($c['product_types_id']==3) {
                        $discounts = $db->getRow('select commission_agency_discount_percent,commission_agent_discount_percent,director1_commission_discount_percent,director2_commission_discount_percent,commission_manager_discount_percent,commission_seller_agents_discount_percent,amount,amount_agent FROM insurance_policies_kasko_items WHERE policies_id='.intval($r['id']).' ');
                    }

                    $d['akts_id'] = $row['id'];
                    $d['number'] = $r['number'];
                    $d['payments_calendar_id'] = $c['id'];
                    $d['payment_amount'] = $c['amount'];
                    $d['documents'] = $c['documents'];
                    $d['statuses_id']=1;
                    $d['manager_id'] =0;

                    $planPercent = 0;
                    $discount = 0;
                    switch ($row['person_types_id']) {
                        case 1: //агент
                            $d['base_commission_amount'] = doubleval($c['commission_agent_amount']);
                            $d['base_commission_percent'] = doubleval($c['commission_agent_percent']);
                            $k = 1;
                            //АвтоБАНК
                            if ($r['type']==3) { //КАСКО Банк (план личный на агента)
                                if($credit_carsPercent_money>=100 &&  $credit_carsPercent>=90)
                                    $k = 1; //оставляем 7%
                                else
                                    $k = 2.8/7; //оставляем 2.8%
                            }
                            if ($r['type']==2 && $r['parent_id']==0) {  //КАСКО Ритейл 1й год
                                $k = 1; //1-й год ритейл 20%
                                if ($r['seller_agents_id']>0) $k = 12/20;
                            }

                            if ($r['type']==2 && $r['parent_id']>0) {   //КАСКО Ритейл пролонгация (план на человека)
                                if ($r['seller_agents_id']>0) {
                                    if($notcredit_carsPercent2year_money>=100) {
                                        $k = 12/20; //12%
                                        if ($r['manager_id']) $k = 11/20;   //11%
                                    }
                                    else
                                    {
                                        $k = 5/20;  //5%
                                        if ($r['manager_id']) $k = 4.4/20;  //4.4%
                                    }
                                }
                                else {
                                    $k = 1;//не передавали на салон
                                    if($notcredit_carsPercent2year_money<100) $k = 8/20;
                                }
                            }

                            if ($r['type']==4) {    //ГО
                                if ($r['number_prolongation']==0) { //1й год
                                    if (intval($r['seller_agents_id'])==0) {
                                        $k = 1;
                                    }
                                    else $k = 8/18;
                                }
                                else { //пролонгация ГО
                                    if($go_carsPercent_money<100) {
                                        $k = 3.2/18;//3.2%
                                        if ($r['manager_id']) $k = 2/18;    //2%
                                    }
                                    else {
                                        $k = 8/18;//8%
                                        if ($r['manager_id']) $k = 5/18;    //5%
                                    }
                                }

                            }

                            if ($r['type']==6) {    //ДГО
                                if($dgo_carsPercent_money<100)
                                    $k = 2/5;//2%
                                else
                                    $k = 1;//5%
                            }

                            if ($r['type']==10) {   //Дострахование 
                                $k = 1;//4%
                            }

                            $d['commission_amount'] =  $c['commission_agent_amount']*$k;
                            $d['commission_percent'] = $c['commission_agent_percent']*$k;
                            $discount = doubleval($discounts['commission_agent_discount_percent']);

                            //скидки из доп ячеек
                            if ($discount>0) {
                                $d['commission_percent']-= ($discount*($discounts['amount_agent']/$discounts['amount']));
                                if ($d['commission_percent']<0) $d['commission_percent'] = 0;
                                $d['commission_amount'] = $d['payment_amount']*$d['commission_percent']/100;
                            }
                            break;

                    }
                    if ($d['base_commission_amount']>0)
                        $AktsContents->insert($d,false);
                }

            }
        }

        //занести с предыдущего акта
        $prew_akt=$db->getRow('SELECT * FROM insurance_akts WHERE agreement_number='.$db->quote($row['agreement_number']).' AND date<'.$db->quote($row['beginDate']).' AND person_types_id<>5   AND person_types_id<>6 ORDER BY date DESC LIMIT 1');


        if ($prew_akt) {

            $prew_contents=$db->getAll('SELECT a.* FROM insurance_akts_contents a JOIN insurance_policies b on b.id=a.policies_id WHERE b.product_types_id<>13 AND a.commission_amount>0 AND a.akts_id='.intval($prew_akt['id']));

            $AktsContents=new AktsContents($data);

            foreach($prew_contents as $r) {
                //если предыдущий акт не оплачен то все полиса переносим,
                //а если оплачен то только полиса по которым не было денег или документов на тот период
                if ($prew_akt['payment_statuses_id']==1 || $r['statuses_id']==1 || $r['documents']==0) {
                    $d['akts_id'] = $row['id'];
                    $d['number'] = $r['number'];
                    $d['payments_calendar_id'] = $r['payments_calendar_id'];
                    $d['payment_amount'] = $r['payment_amount'];
                    $d['base_commission_amount'] = $r['base_commission_amount'];
                    $d['base_commission_percent'] = $r['base_commission_percent'];
                    $d['commission_amount'] = $r['commission_amount'];
                    $d['commission_percent'] = $r['commission_percent'];
                    $d['types_id'] = 2; // помечаем что из предыдущего акта
                    $d['statuses_id']=1;
                    $d['manager_id'] =0;
                    $AktsContents->insert($d,false);
                }
            }
        }


        echo 'done';
        return true;
    }


    function stageInWindowCustom($akt) {
        global $db;
        $date = getdate();
        $date['mon']--;


        if ($date['mon'] == 0) {
            $date['mon'] = 12;
            $date['year']--;
        }

        $aktnumber =  $akt['agreement_number'] . '.' . (sprintf('%02d', $date['mon'])) . '.' . substr($date['year'], 2);


        $sql='
            update `insurance_akts_contents` set commission_amount_white=0
            WHERE commission_amount_white IS NULL
        ';

        $db->query($sql);

        $sql='
            update `insurance_akts_contents` set commission_amount_black=0
            WHERE commission_amount_black IS NULL
        ';

        $db->query($sql);

        $sql='
            update `insurance_akts_contents` set commission_percent_white=0
            WHERE commission_percent_white IS NULL
        ';

        $db->query($sql);


        /*$sql='
            update insurance_akts_contents a
            join insurance_akts cc on cc.id=a.akts_id
            join  insurance_akts_plan_contents b on b.policies_id=a.policies_id  
            left join  insurance_policies_kasko k on k.policies_id=a.policies_id 
            join insurance_policies pp on pp.id=a.policies_id
            join insurance_agencies ag on pp.agencies_id=ag.id
            set 
            commission_amount_white=if((b.types_id=1 or b.types_id =13) and k.financial_institutions_id>0 and cc.es_department=0 and ag.individual_motivation=0, 0.4*commission_amount,0),
            commission_percent_white=if((b.types_id=1 or b.types_id =13) and k.financial_institutions_id>0 and cc.es_department=0  and ag.individual_motivation=0, 0.4*commission_percent,0)
            where a.akts_id   in (select id from insurance_akts where    number like '.$db->quote($aktnumber).')   and cc.person_types_id<>6
        ';  */

        $sql='
            update insurance_akts_contents a
            join insurance_akts cc on cc.id=a.akts_id
            join  insurance_akts_plan_contents b on b.policies_id=a.policies_id  
            left join  insurance_policies_kasko k on k.policies_id=a.policies_id 
            join insurance_policies pp on pp.id=a.policies_id
            join insurance_agencies ag on pp.agencies_id=ag.id
            set 
            commission_amount_white=0,
            commission_percent_white=0
            where a.akts_id   in (select id from insurance_akts where    number like '.$db->quote($aktnumber).')   and cc.person_types_id<>6
        ';

        $db->query($sql);

        $sql='
            update insurance_akts_contents a
                join insurance_akts cc on cc.id=a.akts_id
                set commission_amount_black=commission_amount-commission_amount_white
                where a.akts_id  in (select id from insurance_akts where    number like '.$db->quote($aktnumber).') and cc.person_types_id<>6
        ';

        $db->query($sql);


        $sql='
            update insurance_akts_contents a
            join insurance_akts cc on cc.id=a.akts_id
            set commission_amount_white=commission_amount,commission_amount_black=0
            where a.akts_id in (select id from insurance_akts where    number like '.$db->quote($aktnumber).') and cc.person_types_id=6
        ';

        $db->query($sql);

        echo $aktnumber . ' done<br />';
    }

    function stageInWindow() {
        global $db;
        $date = getdate();
        $date['mon']--;


        if ($date['mon'] == 0) {
            $date['mon'] = 12;
            $date['year']--;
        }

        $aktnumber =  '%.' . (sprintf('%02d', $date['mon'])) . '.' . substr($date['year'], 2);


        $sql='
            update `insurance_akts_contents` set commission_amount_white=0
            WHERE commission_amount_white IS NULL
        ';

        $db->query($sql);

        $sql='
            update `insurance_akts_contents` set commission_amount_black=0
            WHERE commission_amount_black IS NULL
        ';

        $db->query($sql);

        $sql='
            update `insurance_akts_contents` set commission_percent_white=0
            WHERE commission_percent_white IS NULL
        ';

        $db->query($sql);


        /*$sql='
            update insurance_akts_contents a
            join insurance_akts cc on cc.id=a.akts_id
            join  insurance_akts_plan_contents b on b.policies_id=a.policies_id  
            left join  insurance_policies_kasko k on k.policies_id=a.policies_id 
            join insurance_policies pp on pp.id=a.policies_id
            join insurance_agencies ag on pp.agencies_id=ag.id
            set 
            commission_amount_white=if((b.types_id=1 or b.types_id =13) and k.financial_institutions_id>0 and cc.es_department=0 and ag.individual_motivation=0, 0.4*commission_amount,0),
            commission_percent_white=if((b.types_id=1 or b.types_id =13) and k.financial_institutions_id>0 and cc.es_department=0  and ag.individual_motivation=0, 0.4*commission_percent,0)
            where a.akts_id   in (select id from insurance_akts where    number like '.$db->quote($aktnumber).')   and cc.person_types_id<>6
        ';  */

        $sql='
            update insurance_akts_contents a
            join insurance_akts cc on cc.id=a.akts_id
            join  insurance_akts_plan_contents b on b.policies_id=a.policies_id  
            left join  insurance_policies_kasko k on k.policies_id=a.policies_id 
            join insurance_policies pp on pp.id=a.policies_id
            join insurance_agencies ag on pp.agencies_id=ag.id
            set 
            commission_amount_white=0,
            commission_percent_white=0
            where a.akts_id   in (select id from insurance_akts where    number like '.$db->quote($aktnumber).')   and cc.person_types_id<>6
        ';

        $db->query($sql);

        $sql='
            update insurance_akts_contents a
                join insurance_akts cc on cc.id=a.akts_id
                set commission_amount_black=commission_amount-commission_amount_white
                where a.akts_id  in (select id from insurance_akts where    number like '.$db->quote($aktnumber).') and cc.person_types_id<>6
        ';

        $db->query($sql);


        $sql='
            update insurance_akts_contents a
            join insurance_akts cc on cc.id=a.akts_id
            set commission_amount_white=commission_amount,commission_amount_black=0
            where a.akts_id in (select id from insurance_akts where    number like '.$db->quote($aktnumber).') and cc.person_types_id=6
        ';

        $db->query($sql);

        echo 'done';
    }
}

?>