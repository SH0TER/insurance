<?

require_once 'Akts.class.php';
class AktsContents extends Form {

	var $formDescription =
			array(
				'fields' 	=>
					array(
						array(
							'name'				=> 'id',
					        'type'				=> fldIdentity,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'akts_contents'),
						  array(
                            'name'                => 'akts_id',
                            'description'        => 'Акт',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'orderPosition'		=> 1,
                            'table'                => 'akts_contents'),	
						array(
							'name'				=> 'number',
							'description'		=> 'Полис',
							'type'				=> fldText,
					        'maxlength'			=> 50,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 2,
							'table'				=> 'akts_contents'),
						  array(
                            'name'                => 'payments_calendar_id',
                            'description'        => 'Платеж',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'akts_contents'),
                         array(
                            'name'                => 'accidents_id',
                            'description'        => 'Справа',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'akts_contents'),	
						 array(
                            'name'                => 'application_accidents_id',
                            'description'        => 'Заявка',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'akts_contents'),	
						 array(
                            'name'                => 'comission_master',
                            'description'        => 'Заяву прийняв',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'akts_contents'),
						 array(
                            'name'                => 'comission_investigation',
                            'description'        => 'Огляд провiв',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'akts_contents'),	
						 array(
                            'name'                => 'manager_id',
                            'description'        => 'Менеджер',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'akts_contents'),		
						array(
                            'name'                => 'policies_id',
                            'description'        => 'Полис',
                            'type'                => fldHidden,
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
							'orderPosition'		=> -3,	
                            'table'                => 'akts_contents'),
                        array(
							'name'				=> 'payment_amount',
							'description'		=> 'Платеж, грн',
					        'type'				=> fldMoney,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 3,	
							'table'				=> 'akts_contents'), 
						array(
							'name'				=> 'base_commission_percent',
							'description'		=> 'База Комісія, %',
					        'type'				=> fldPercent,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 4,	
							'table'				=> 'akts_contents'),		       	
						array(
							'name'				=> 'base_commission_amount',
							'description'		=> 'База Комісія, грн',
					        'type'				=> fldMoney,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 5,	
							'table'				=> 'akts_contents'),
						array(
							'name'				=> 'commission_percent',
							'description'		=> 'Комісія, %',
					        'type'				=> fldPercent,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'akts_contents'),
						array(
							'name'				=> 'commission_percent_white',
							'description'		=> 'Комісія, %',
					        'type'				=> fldPercent,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 6,	
							'table'				=> 'akts_contents'),	
						array(
							'name'				=> 'commission_amount',
							'description'		=> 'Комісія, грн',
					        'type'				=> fldMoney,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'akts_contents'),
						array(
							'name'				=> 'commission_amount_white',
							'description'		=> 'Комісія, грн',
					        'type'				=> fldMoney,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 7,	
							'table'				=> 'akts_contents'),	
                        array(
							'name'				=> 'types_id',
							'description'		=> 'Поточний/Попереднiй',
					        'type'				=> fldRadio,
					        'list'				=> array(
					        						1 => 'Поточний',
                                                    2 => 'Попереднiй'),
							'display'			=>
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
                            'orderPosition'		=> 8,
							'table'				=> 'akts_contents'),
                        array(
                            'name'                  => 'statuses_id',
                            'description'           => 'Статус',
                            'type'                  => fldSelect,
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
                            'orderPosition'         => 9,
                            'table'                 => 'akts_contents',
                            'sourceTable'       	=> 'payment_statuses',
                            'selectField'       	=> 'title',
                            'orderField'        	=> 'order_position'),
                         array(
                            'name'              => 'documents',
                            'description'       => 'Комiсiя',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false,
                                    'change'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 10,
                            'table'             => 'akts_contents'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'akts_contents'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 11,
							'width'				=> 100,
							'table'				=> 'akts_contents')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 11,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'number'
					)
			);

	function AktsContents($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Полiси до сплати';
		$this->messages['single'] = 'Полiс до сплати';

		
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'					=> true,
					'insert'				=> true,
					'update'				=> true,
					'view'					=> false,
					'change'				=> true,
					'export'    			=> true,
					'delete'				=> true);
				break;
			case ROLES_MANAGER:
                $Akts=new Akts($data);
				$this->permissions = $Authorization->data['permissions'][ get_class($Akts) ];
				break;
            case ROLES_AGENT:
                $this->permissions = array(
					'show'					=> true,
					'view'					=> true,
					'export'    			=> true
					);
				break;
		
		}
	}
	
	function searchPoliciesInWindow($data)
	{
		global $db;
		if (strlen($data['policiesNumber']))
		{
			$conditions[] = 'a.number='.$db->quote($data['policiesNumber']);
			$sql='SELECT b.id,a.number,date_format(b.date, ' . $db->quote(DATE_FORMAT) . ') as date_format,b.amount,c.title FROM '.PREFIX.'_policies a JOIN  '.PREFIX.'_policy_payments_calendar b on b.policies_id=a.id JOIN '.PREFIX.'_payment_statuses c on c.id=b.statuses_id WHERE ' . implode(' AND ', $conditions) . '  ' ;
			$list = $db->getAll($sql);
			if (is_array($list) && sizeof($list)>0)
			{
				$res='<table border=1>';
				$res.='<tr><td>&nbsp;<td><b>Номер</b></td><td><b>Сумма платежу</b></td><td><B>Дата</b></td><td><b>Статус</b></td></tr>';
				foreach ($list as $row)
				{
					$res.='<tr><td><input type="radio"  onclick="setNumber('.$row['id'].')"  value="'.$row['id'].'" name="paymentsCalendarId"></td>';
					$res.='<td><input readonly type="text" id="number'.$row['id'].'" name="number'.$row['id'].'" value="'.$row['number'].'" maxlength="50" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /></td>';
					$res.='<td><input readonly type="text" id="amount'.$row['id'].'" name="amount'.$row['id'].'" value="'.$row['amount'].'" maxlength="10" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /></td>';
					$res.='<td>'.$row['date_format'].'</td>';
					$res.='<td>'.$row['title'].'</td></tr>';
				}
				$res.='</table><br>';
				echo $res;exit;
			}
		}
		echo 'По указанным критериям ничего не найдено<br><br>';
		exit;
	}
	
	function insert($data, $redirect=true) {
        global $Log,$db;

        $data = $this->replaceSpecialChars($data, 'insert');
        if (!$data['types_id']) $data['types_id']= 1;
        $id = parent::insert($data, false);

        if (!$Log->isPresent() && $id) {

            $params['title']		= $this->messages['single'];
            $params['id']           = $id;
            $params['storage']      = $this->tables[0];
            //проставить наличие оплаты и документов на момент занесения
			$sql='UPDATE '.PREFIX.'_akts_contents a 
				  JOIN '.PREFIX.'_policy_payments_calendar b on a.payments_calendar_id=b.id 
				  JOIN '.PREFIX.'_policies c ON c.id=b.policies_id 
				  SET a.policies_id=b.policies_id,
				  a.statuses_id=IF(b.payment_date>=DATE_FORMAT( NOW( ) ,  \'%Y-%m-01\'),1,b.statuses_id) ,
				  a.documents=c.commission 
				  WHERE a.id='.intval($id);
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


    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true)
    {

        parent::show($data, $fields, $conditions, $sql, $template, false);
    }

	function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
		if (!$this->permissions['delete']) {
			$hide_fields = array ('number',
										'payment_amount',
										'base_commission_percent',
										'base_commission_amount',
										'commission_percent',
										'commission_amount',
										'types_id' );
			foreach ($hide_fields as $f)
			{
				$this->formDescription['fields'][ $this->getFieldPositionByName($f) ]['type'] = fldHidden;
			}			
		}	
		
		return parent::load($data, $showForm, $action, $actionType, $template);
	}
	
    function getShowFieldsSQLString() {
        $result = parent::getShowFieldsSQLString();

        $result .= ', commission_percent,commission_amount ';

        return $result;
    }

	
    function exportInWindow($data) {
        global $db, $Smarty,$Authorization;

        $this->checkPermissions('export', $data);

        //header('Content-Disposition: attachment; filename="export.xls"');
        //header('Content-Type: ' . Form::getContentType('export.xls'));

		$conditions[]='akts_id='.intval($data['akts_id']);
		
		$sql = 'SELECT a.id as akts_contents_id,b.id,b.commission,b.item,CONCAT(c.lastname, \' \',c.firstname) as managerfio ,c1.service,it.bank_discount_value,it.bank_commission_value,
			cal.date as plandate,b.agreement_types_id,cal.payment_date as factdate,pk.discount,b.date as policy_date,b.insurer,b.price,b.documents,ag.title as agency_title,concat(ac.lastname,\'\',ac.firstname) as agent_name,p_parent.number as parent_number
		FROM insurance_akts_contents a 
		JOIN insurance_policies b on b.id=a.policies_id 
		LEFT JOIN insurance_policies p_parent on p_parent.id=b.parent_id 
		JOIN insurance_policy_payments_calendar cal on cal.id=a.payments_calendar_id
		LEFT JOIN insurance_accounts c ON c.id=b.manager_id 
		LEFT JOIN insurance_agents c1 ON c1.accounts_id=b.manager_id 
		LEFT JOIN  insurance_policies_kasko_items it on it.policies_id=b.id
		LEFT JOIN  insurance_policies_kasko pk on pk.policies_id=b.id
		LEFT JOIN insurance_products_kasko p ON it.products_id=p.products_id
		LEFT JOIN  insurance_agencies ag on ag.id=IF(b.seller_agencies_id>0,b.seller_agencies_id,b.agencies_id)
		LEFT JOIN  insurance_accounts ac on ac.id=IF(b.seller_agents_id>0,b.seller_agents_id,b.agents_id)
		WHERE  akts_id='.intval($data['akts_id']);
		$data['policies'] = $db->getAll($sql);
		
		$data['akt'] = $db->getRow('SELECT id,number,
		agent_name,number as aktnumber,k,agreement_number,person_types_id,date,
		date as beginDate,MONTH(date) as aktmonth,YEAR(date) as aktyear,DATE_SUB(DATE_ADD(date, INTERVAL 1 MONTH),INTERVAL 1 SECOND) as endDate,
		credit_cars,
		not_credit_cars,
		continued_cars,
		go_cars,
		payment_statuses_id,
		sellers_department 
		FROM insurance_akts 
		WHERE id=' . intval($data['akts_id']));
		$data['akt']['agent'] = $db->getRow('SELECT * FROM  insurance_agents WHERE agreement_number='.$db->quote($data['akt']['agreement_number']));

		
		$data['plan'] = $db->getAll('
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
                    WHERE a1.akts_id='.$data['akts_id']);
					
		$data['ek'] = $db->getAll('SELECT * FROM '.PREFIX.'_akts_express_credit_contents WHERE  akts_id='.$data['akts_id']);
		
		if (is_array($data['policies'])) {
			foreach($data['policies'] as $i=>$p) {
				if (intval($p['commission'])) {
					$sql = 'SELECT created FROM insurance_policy_actions WHERE types_id=2 AND policies_id  = '.intval($p['id']);
					$data['policies'][$i]['checkpolicy'] = $db->getOne($sql);
				
				}
				$sql = 'SELECT id FROM insurance_akts_plan_contents WHERE policies_id='.intval($p['id']).' AND akts_id='.intval($data['akts_id']);
				$data['policies'][$i]['infact'] = intval($db->getOne($sql))>0 ? 'Так' : 'Нi';

			}
		}
		
		
		
         header('Content-Disposition: attachment; filename="export.xls"');
		 header('Content-Type: ' . Form::getContentType('export.xls'));
	     header('Accept-Ranges: bytes');
	     header('Expires: 0');
	     header('Cache-Control: private');
        $sql	= $this->show($data, $fields, $conditions, null, $this->object . '/export.tpl', false);
        exit;
    }
	
	
}

?>