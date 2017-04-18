<?
/*
 
 */
require_once 'BankAktsContents.class.php';
require_once 'Agencies.class.php';
require_once 'include/lib/WebServices/XML2Array.php';


class BankAkts extends Form {

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
                            'table'             => 'bank_akts'),
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
                            'table'             => 'bank_akts'),
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
                            'table'             => 'bank_akts'),
                        
                    
                        array(
                            'name'              => 'date',
                            'description'       => 'Дата акта',
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
                            'table'             => 'bank_akts'),
                        
                        
                        array(
                            'name'              => 'agent_name',
                            'description'       => 'Фiн установа',
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
                            'table'             => 'bank_akts'),
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
                            'table'             => 'bank_akts'),
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
                            'table'             => 'bank_akts',
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
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 11,
                            'table'                 => 'bank_akts'),
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
                            'table'             => 'bank_akts'),
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
                            'table'             => 'bank_akts')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 5,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'agent_name'
                    )
            );

    function BankAkts($data) {
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
                    'delete'    => true);
                break;
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                $this->permissions['export'] = false;
                break;
             case ROLES_AGENT:
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

        $this->checkPermissions('show', $data);

        $hidden['do'] = $data['do'];
        
        $fields['payment_statuses_id']              = $this->formDescription['fields'][ $this->getFieldPositionByName('payment_statuses_id') ];
        $fields['payment_statuses_id']['type']      = fldMultipleSelect;
        $fields['payment_statuses_id']['list']      = $PAYMENT_STATUSES;
        $fields['payment_statuses_id']['object']    = $this->buildSelect($fields['payment_statuses_id'], $data['payment_statuses_id'], $data['languageCode'], 'multiple size="3"', null, $data);


        $conditions[] = '1';
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

  

        if (strlen($data['policy_number'])>0) {
            $search_str=trim($data['policy_number']);
            $conditions[] = PREFIX . '_bank_akts.id IN (SELECT a.akts_id FROM ' . PREFIX . '_bank_akts_contents a JOIN ' . PREFIX . '_policies b ON a.policies_id = b.id WHERE b.number =' . $db->quote($search_str).' '.($data['payed'] ? ' AND a.statuses_id=3    AND a.documents=1 ' : ' ').' )';
        }

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(' . $this->tables[0] . '.date) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] =  'TO_DAYS(' . $this->tables[0] . '.date) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }

        
        
        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        $sql =  'SELECT 1 as fff,' . PREFIX . '_bank_akts.id, ' . PREFIX . '_bank_akts.number, ' . PREFIX . '_bank_akts.agreement_number, date_format(' . PREFIX . '_bank_akts.date, \'%d.%m.%Y\') AS date_format, ' .
                PREFIX . '_bank_akts.agent_name '.
                ',getBankAktAmount(' . PREFIX . '_bank_akts.id) as amount ' .
                ' ,'.PREFIX . '_bank_akts.payment_statuses_id, ' . PREFIX . '_payment_statuses.title AS payment_statuses_id, ' .
                PREFIX . '_bank_akts.file, date_format(' . PREFIX . '_bank_akts.created, \'%d.%m.%Y\') AS created_format, ' .
                'date_format(' . PREFIX . '_bank_akts.modified, \'%d.%m.%Y\') AS modified_format ' .
                'FROM ' . PREFIX . '_bank_akts ' .
                'JOIN ' . PREFIX . '_payment_statuses ON ' . PREFIX . '_bank_akts.payment_statuses_id = ' . PREFIX . '_payment_statuses.id ' ;

        $totalsql = $sql .'WHERE ' . implode(' AND ', $conditions);
        
        $sql .= 'WHERE ' . implode(' AND ', $conditions);

        $sql.= ' ORDER BY ';
        //_dump($sql)
         
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

         
    }

    function insert($data, $redirect=true) {
        global $Log,$db;

        $data = $this->replaceSpecialChars($data, 'insert');

        $id = parent::insert($data, false);

        if (!$Log->isPresent() && $id) {

            $params['title']        = $this->messages['single'];
            $params['id']           = $id;
            $params['storage']      = $this->tables[0];

            $sql='UPDATE '.PREFIX.'_bank_akts a SET a.file=\'1\' WHERE a.id='.intval($id);
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
        
        $BankAktsContents = new BankAktsContents($data);
        $BankAktsContents->show($data, $fields, $conditions);

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
        $this->createPayment($data['number'],$data['id']);
        echo 'Done';
    
    }

   
    private function get($data)
    {
        global $db;

        if ($data['id'])
            $conditions[] = 'id='.intval($data['id']);
        elseif($data['number'])
            $conditions[] = 'number='.$db->quote($data['number']);

        return $db->getRow('SELECT id,number,number as aktnumber, agreement_number, date as beginDate,MONTH(date) as aktmonth,YEAR(date) as aktyear,DATE_SUB(DATE_ADD(date, INTERVAL 1 MONTH),INTERVAL 1 SECOND) as endDate,payment_statuses_id FROM insurance_bank_akts WHERE ' . implode(' AND ', $conditions));
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
                    $modified_akt=$this->generateAkt(array('id'=>$id));
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

   


    function generateBankAktsInWindow($data)
    {
        global $db;
        $this->checkPermissions('change', $data);

        //$sql='SELECT DISTINCT a.agreement_number FROM insurance_financial_institutions a WHERE LENGTH(a.agreement_number)>0 and agreement_number=\'01\'';
        $sql='SELECT DISTINCT a.agreement_number FROM insurance_financial_institutions a WHERE LENGTH(a.agreement_number)>0';
        
        $akts=$db->getAll($sql);

        foreach($akts as $akt)
        {
            $this->generateAkt(array('agreement_number'=>$akt['agreement_number']));
        }

    }

    function generateBankAktQuarterly($data)
    {
        $this->checkPermissions('change', $data);

        $akts[] = array('agreement_number' => '99');

        $beginDate = '2016-11-01';
        $endDate = '2016-11-30';

        foreach($akts as $akt)
        {
            _dump($akt['agreement_number']);
            $this->generateAkt(array('agreement_number'=>$akt['agreement_number']), true, $beginDate, $endDate, 3);
        }
    }

    function generateAkt($data, $quarterly = null, $date1 = null, $date2 = null, $agreement_type = null) {
        global $db,$Log;

        $this->checkPermissions('change', $data);

        //file_get_contents( 'http://e-insurance.in.ua/cron/payments_details.php');
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
            
            
            //$date['mon']=$date['mon']-;
            
            
             

            if ($date['mon'] == 0) {
                $date['mon'] = 12;
                $date['year']--;
            }

            $aktnumber = $data['agreement_number'] . '.' . (sprintf('%02d', $date['mon'])) . '.' . substr($date['year'], 2);
            $data['number'] = $aktnumber;
            $row = $this->get($data);

            if (!$row) {//нет акта создаем новый

                $sql =  'SELECT   title ' .
                        'FROM insurance_financial_institutions a ' .
                        'WHERE agreement_number = ' . $db->quote($data['agreement_number']);
                $agent = $db->getRow($sql);

                $row['agreement_number'] = $data['agreement_number'];
                $row['number'] = $aktnumber;
                $row['date'] = '20'.substr($date['year'], 2).'-' . sprintf('%02d', $date['mon']) . '-01';
                $row['date_year'] = '20'.substr($date['year'], 2);
                $row['date_month'] =  sprintf('%02d', $date['mon']);
                $row['date_day'] =  '01';
                $row['payment_statuses_id'] = 1;
                $row['agent_name'] = $agent['title'];
                $row['file'] = 1;
                $row['k']=1;
                $row['id'] = $this->insert($row,false);
                $row = $this->get($row);
            }
        }
        if (!$row) return;
         
        //чистим содержимое акта

        if($quarterly === true && $agreement_type === 3) {
            $db->query('DELETE b FROM insurance_bank_akts_contents b '.
                'JOIN insurance_policies a on a.id=b.policies_id WHERE a.product_types_id = 3 AND b.manual=0 AND b.akts_id='.intval($row['id']));
        } else {
            $db->query('DELETE FROM insurance_bank_akts_contents WHERE manual=0 AND akts_id='.intval($row['id']));
        }

        $row['financial_institutions_id'] = $db->getOne('SELECT id FROM  insurance_financial_institutions WHERE agreement_number = '.$db->quote($row['agreement_number']));

        if($quarterly === true)
            $factData = $this->getFactPolicies($row, true, $date1, $date2, $agreement_type);
        else
            $factData = $this->getFactPolicies($row, false);

        $k = 1;
        if ($factData)
        {
           
            foreach($factData as $r)
            {
 
                $BankAktsContents=new BankAktsContents($data);
 
                $d['akts_id'] = $row['id'];
                $d['number'] = $r['number'];
                $d['payments_calendar_id'] = $r['payment_calendar_id'];
                $d['payment_amount'] = $r['payment_amount'];
                $d['documents'] = 1;
                $d['product_title'] = $r['product_title'];
                $d['insurer'] = $r['insurer'];
                $d['agency_title']= $r['agency_title'];
                $d['prolongation']= $r['prolongation'];
                $d['quote']= $r['quote'];
                $d['assured_title']= $r['assured_title'];
                
                
                
                $d['bank_discount_value'] = doubleval($r['bank_discount_value']);
                $d['bank_commission_value'] = doubleval($r['bank_commission_value']);
                
                $d['bank_rko_insurance_amount'] = doubleval($r['bank_rko_insurance_amount']);
                $d['ek_number']='';
                
                $d['statuses_id']=1;
                $d['types_id']=1;
                $d['manual']=0;
                $bankCreditAgreementAmount = 0;
                if ($r['solutions_id']>0) { //из ЭК есть сумма кредита
                    $t = $db->getRow('SELECT bankCreditAgreementAmount,questionnairesId FROM  insurance_questionnaire_solutions WHERE id='.$r['solutions_id']);
                    $bankCreditAgreementAmount = doubleval($t['bankCreditAgreementAmount']);
                    $d['ek_number']=$db->getOne('SELECT number FROM insurance_questionnaires WHERE id='.intval($t['questionnairesId']));
                }
                $d['credit_amount'] = $bankCreditAgreementAmount;
                
                
                
                $insurance_amount = 0;
                $d['insurance_amount'] = $r['insurance_price'];
                
                $rate = 0;
                if ($r['product_types_id']==3) {
                    $multiyear = intval($db->getOne('SELECT count(*) FROM insurance_policies_kasko_item_years_payments WHERE policies_id='.intval($r['id'])));
                    if ($multiyear) { //многолетний
                        $rate = doubleval($db->getOne('SELECT rate_kasko FROM insurance_policies_kasko_item_years_payments WHERE policies_id = ' .intval($r['id']).'  AND date<='.$db->quote($r['plan_date']).' ORDER BY date DESC limit 1 '));
                    }
                    else {
                        $rate = doubleval($db->getOne('SELECT rate FROM insurance_policies WHERE id=' .intval($r['id'])));
                    }
                }
                else $rate=$r['rate'];
                
                $d['rate']=$rate;
                
                
                $d['commission_amount'] = 0; //итого что платить банку
                //if ($r['solutions_id']>0 && $r['number_insurance_year']==1) {

                if($d['bank_discount_value']>1) {
                    $d['commission_amount'] = round($d['payment_amount'] * (1 - round(1/$d['bank_discount_value'], 3)), 2);
                    if ($r['financial_institutions_id']==34 /*|| $r['financial_institutions_id']==25*/) //правекс и идея
                    {
                        if ($d['commission_amount']>0 && $d['payment_amount']>0 && $d['commission_amount']>(0.3*$d['payment_amount'])) {
                            //коммиссия больше чем 30% от платежа остальное через рко
                            $d['bank_rko_insurance_amount'] =round($d['commission_amount'] - 0.3*$d['payment_amount'],2);
                            $d['commission_amount']=$d['commission_amount']-$d['bank_rko_insurance_amount'];
                        }
                    }
                }
                elseif ($d['bank_commission_value']>0) 
                {
                    $k=1;
                    if ($r['full_amount_kasko']>0 && intval($d['payment_amount'])!=intval($r['full_amount_kasko']))
                    {
                        if($r['financial_institutions_id']==25)
                        $k=$d['payment_amount']/$r['full_amount_kasko'];
                        else
                        $k=1;//$d['payment_amount']/$r['full_amount_kasko'];
                    }
                    if ($r['number_part_payment']>1 && $r['financial_institutions_id']!=25) $k=0;
                    
                    if ($d['bank_commission_value']==0.6 && $r['financial_institutions_id']==55) $k=0;
                    
                    $d['commission_amount'] = round($d['bank_commission_value'] * $d['insurance_amount']/100*$k,2);
                    if ($r['financial_institutions_id']==34 /*|| $r['financial_institutions_id']==25*/) //правекс и идея
                    {
                        if ($d['commission_amount']>0 && $d['payment_amount']>0 && $d['commission_amount']>(0.3*$d['payment_amount'])) {
                            //коммиссия больше чем 30% от платежа остальное через рко
                            $d['bank_rko_insurance_amount'] =round($d['commission_amount'] - 0.3*$d['payment_amount'],2);
                            $d['commission_amount']=$d['commission_amount']-$d['bank_rko_insurance_amount'];
                        }
                    }
                    
                    //Кредобанку за июнь месяц сформировать следующим образом: все договора, по которым КВ превышает 30% разделить на КВ по акту 1,89 от СС, остальное РКО.
                    /*if ($r['financial_institutions_id']==55 )  
                    {
                        if ($d['commission_amount']>0 && $d['payment_amount']>0 && $d['commission_amount']>(0.3*$d['payment_amount'])) {
                            //коммиссия больше чем 30% от платежа  
                            $commission_amount_new = round(1.89 * $d['insurance_amount']/100,2);
                            $d['bank_rko_insurance_amount'] =$d['commission_amount']-$commission_amount_new ;
                            $d['commission_amount']=$commission_amount_new;
                        }
                    }*/
                }

                //}
                //_dump($d);
                $BankAktsContents->insert($d,false);
                

            }
            //exit;
            //занести с предыдущего акта
        //$prew_akt=$db->getRow('SELECT * FROM insurance_bank_akts WHERE agreement_number='.$db->quote($row['agreement_number']).' AND date<'.$db->quote($row['beginDate']).'   ORDER BY date DESC LIMIT 1');


        if ($prew_akt) {

            $prew_contents=$db->getAll('SELECT a.* FROM insurance_bank_akts_contents a JOIN insurance_policies b on b.id=a.policies_id WHERE a.commission_amount>0 AND a.akts_id='.intval($prew_akt['id']));
            //_dump('SELECT * FROM insurance_akts_contents WHERE commission_amount>0 AND akts_id='.intval($prew_akt['id']));exit;
            $BankAktsContents=new BankAktsContents($data);

            foreach($prew_contents as $r) {
                //если предыдущий акт не оплачен то все полиса переносим,
                //а если оплачен то только полиса по которым не было денег или документов на тот период
                if ($prew_akt['payment_statuses_id']==1 || $r['statuses_id']==1 || $r['documents']==0) {
                    $d['akts_id'] = $row['id'];
                    
                    $d['number'] = $r['number'];
                    $d['payments_calendar_id'] = $r['payments_calendar_id'];
                    $d['policies_id'] = $r['policies_id'];
                    $d['quote'] = $r['quote'];
                    $d['number'] = $r['number'];
                    $d['ek_number'] = $r['ek_number'];
                    $d['rate'] = $r['rate'];
                    $d['insurer'] = $r['insurer'];
                    $d['agency_title'] = $r['agency_title'];
                    $d['product_title'] = $r['product_title'];
                    $d['assured_title'] = $r['assured_title'];
                    $d['prolongation'] = $r['prolongation'];
                    $d['credit_amount'] = $r['credit_amount'];
                    $d['insurance_amount'] = $r['insurance_amount'];
                    $d['payment_amount'] = $r['payment_amount'];
                    $d['bank_discount_value'] = $r['bank_discount_value'];
                    $d['bank_commission_value'] = $r['bank_commission_value'];
                    $d['bank_rko_insurance_amount'] = $r['bank_rko_insurance_amount'];
                    $d['commission_amount'] = $r['commission_amount'];
                    $d['documents'] = $r['documents'];
                    $d['manual'] = 0;
                    $d['types_id'] = 2; // помечаем что из предыдущего акта
                    $d['statuses_id']=1;
                    $d['manager_id'] =0;
                    $BankAktsContents->insert($d,false);
                }
            }
        }

        }
        echo 'done';
        return true;
    }

     
    private function getFactPolicies($row, $quarterly = null, $date1 = null, $date2 = null, $agreement_type = null)
    {
        global $db;

        if($quarterly === true)
        {
           $row['beginDate'] = $date1;
           $row['endDate'] = $date2;
        }

        $from=$db->quote($row['beginDate']);
        $to=$db->quote($row['endDate']);
        $conditions = array('pd.payments_date BETWEEN ' . $from . ' AND ' . $to);
        $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
        
       
        //КАСКО, банк
        $sql =  'SELECT   a.id,a.product_types_id,a.rate,a.commission as documents,a.number,1 as type,IF(yp.products_id>0,yp.products_title, p.title) as product_title,a.insurer,
                IF(yp.products_id>0,yp.bank_discount_value,p_k.bank_discount_value) as bank_discount_value,
                IF(yp.products_id>0,yp.bank_commission_value,p_k.bank_commission_value) as bank_commission_value,
                0 as bank_rko_insurance_amount,
                
                a.solutions_id,cal.date as plan_date,pd.insurance_price,b.financial_institutions_id,
                ag.title as agency_title,pd.prolongation,a.types_id as quote,pd.assured_title,
                c1.brands_id,cal.amount as payment_amount,cal.id as payment_calendar_id,cal.number_insurance_year,cal.number_part_payment,yp.amount_kasko as full_amount_kasko ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policies_kasko_items AS c1 ON a.id = c1.policies_id ' .
                'JOIN insurance_policy_payments_calendar cal on cal.policies_id=a.id '.
                'JOIN insurance_report_payments_details pd on pd.payments_calendar_id=cal.id '.
                'JOIN  insurance_agencies ag on ag.id=a.agencies_id '.
                'LEFT JOIN insurance_policies_kasko_items it on it.policies_id=a.id '.
                'LEFT JOIN insurance_products p on it.products_id=p.id '.
                'LEFT JOIN insurance_products_kasko p_k on it.products_id=p_k.products_id '.
                'LEFT JOIN insurance_policies_kasko_item_years_payments yp on yp.id=cal.item_years_payments_id '.
                'LEFT JOIN insurance_products_kasko p_k1 on yp.products_id=p_k1.products_id '.
                'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
                'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
                'WHERE ' . implode(' AND ', $conditions) . '   AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . ' AND cal.manual IS NULL AND b.financial_institutions_id >0 AND b.financial_institutions_id='.intval($row['financial_institutions_id']).'   ' .
                ' ';
        $result = $db->getAll($sql );
        
        $list=array();
        if ($result)
        {
            foreach($result as $r)
                $list[] = $r;
        }
        
        if($quarterly === true && $agreement_type === 3)
        {
            return $list;
        }

        if (in_array($row['financial_institutions_id'],array(1,7,19,59,34,46,52,55,63))) {
        //НС, банк
            $sql =  'SELECT   a.id,a.product_types_id,a.rate,a.commission as documents,a.number,1 as type, p.title as product_title,a.insurer,
                    p_k.bank_discount_value as bank_discount_value,
                    p_k.bank_commission_value as bank_commission_value,
                    0 as bank_rko_insurance_amount,
                    a.solutions_id,cal.date as plan_date,pd.insurance_price,
                    ag.title as agency_title,pd.prolongation,a.types_id as quote,pd.assured_title,
                    cal.amount as payment_amount,cal.id as payment_calendar_id,cal.number_insurance_year ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_ns AS b ON a.id = b.policies_id ' .
                    'JOIN insurance_policy_payments_calendar cal on cal.policies_id=a.id '.
                    'JOIN insurance_report_payments_details pd on pd.payments_calendar_id=cal.id '.
                    'JOIN  insurance_agencies ag on ag.id=a.agencies_id '.
                    'LEFT JOIN insurance_products p on b.products_id=p.id '.
                    'LEFT JOIN insurance_products_ns p_k on b.products_id=p_k.products_id '.
                    'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
                    'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
                    'WHERE ' . implode(' AND ', $conditions) . '   AND a.product_types_id = ' . PRODUCT_TYPES_NS . ' AND cal.manual IS NULL AND b.financial_institutions_id >0 AND b.financial_institutions_id='.intval($row['financial_institutions_id']).'   ' .
                    ' ';
            $result = $db->getAll($sql );
            if ($result)
            {
                foreach($result as $r)
                    $list[] = $r;
            }
        }
        
        
        if (in_array($row['financial_institutions_id'],array(39,33,1,45,34))) { 
        //Майно, банк
            $sql =  'SELECT   a.id,a.product_types_id,a.rate,a.commission as documents,a.number,1 as type, \'Майно\' as product_title,a.insurer,
                    0 as bank_discount_value,
                    0 as bank_commission_value,
                    0 as bank_rko_insurance_amount,
                    a.solutions_id,cal.date as plan_date,pd.insurance_price,
                    ag.title as agency_title,pd.prolongation,a.types_id as quote,pd.assured_title,
                    cal.amount as payment_amount,cal.id as payment_calendar_id,cal.number_insurance_year ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_property AS b ON a.id = b.policies_id ' .
                    'JOIN insurance_policy_payments_calendar cal on cal.policies_id=a.id '.
                    'JOIN insurance_report_payments_details pd on pd.payments_calendar_id=cal.id '.
                    'JOIN  insurance_agencies ag on ag.id=a.agencies_id '.
                    'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
                    'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
                    'WHERE pd.payments_date BETWEEN ' . $from . ' AND ' . $to.' AND cal.manual IS NULL AND a.product_types_id = ' . PRODUCT_TYPES_PROPERTY . ' AND b.financial_institutions_id >0 AND b.financial_institutions_id='.intval($row['financial_institutions_id']).'   ' .
                    ' ';
            $result = $db->getAll($sql );
            if ($result)
            {
                foreach($result as $r)
                    $list[] = $r;
            }
        }
        
        if (in_array($row['financial_institutions_id'],array(39))) { 
        //ипотека, банк
            $sql =  'SELECT   a.id,a.product_types_id,a.rate,a.commission as documents,a.number,1 as type, \'Добровільне страхування майна що є предметом іпотеки\' as product_title,a.insurer,
                    0 as bank_discount_value,
                    0 as bank_commission_value,
                    0 as bank_rko_insurance_amount,
                    a.solutions_id,cal.date as plan_date,pd.insurance_price,
                    ag.title as agency_title,pd.prolongation,a.types_id as quote,pd.assured_title,
                    cal.amount as payment_amount,cal.id as payment_calendar_id,cal.number_insurance_year ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_mortage AS b ON a.id = b.policies_id ' .
                    'JOIN insurance_policy_payments_calendar cal on cal.policies_id=a.id '.
                    'JOIN insurance_report_payments_details pd on pd.payments_calendar_id=cal.id '.
                    'JOIN  insurance_agencies ag on ag.id=a.agencies_id '.
                    'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
                    'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
                    'WHERE ' . implode(' AND ', $conditions) . '  AND cal.manual IS NULL AND a.product_types_id = 15 AND b.financial_institutions_id >0 AND b.financial_institutions_id='.intval($row['financial_institutions_id']).'   ' .
                    ' ';
                    
            $result = $db->getAll($sql );
            if ($result)
            {
                foreach($result as $r) {
                    $list[] = $r;
                    }
            }
        }
       
        return $list;
    }


      


    function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;
        
        if (!$this->permissions['delete']) {
            $hide_fields = array ('number',
                                        'agreement_number',
                                        'agent_name' );
            foreach ($hide_fields as $f)
            {
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
    
    
     
}

?>