<?

require_once 'BankAkts.class.php';
class BankAktsContents extends Form {

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
							'table'				=> 'bank_akts_contents'),
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
                            'table'                => 'bank_akts_contents'),	
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
							'table'				=> 'bank_akts_contents'),
						array(
							'name'				=> 'insurer',
							'description'		=> 'страховик',
							'type'				=> fldHidden,
					        'maxlength'			=> 150,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 25,
							'table'				=> 'bank_akts_contents'),
						array(
							'name'				=> 'agency_title',
							'description'		=> 'Агенция',
							'type'				=> fldHidden,
					        'maxlength'			=> 150,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 26,
							'table'				=> 'bank_akts_contents'),
						array(
							'name'				=> 'prolongation',
							'description'		=> 'Пролонгация',
							'type'				=> fldHidden,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 28,
							'table'				=> 'bank_akts_contents'),
							
						array(
							'name'				=> 'quote',
							'description'		=> 'Котировка',
							'type'				=> fldHidden,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 29,
							'table'				=> 'bank_akts_contents'),	
						array(
							'name'				=> 'ek_number',
							'description'		=> 'Номер ЭК',
							'type'				=> fldHidden,
					        'maxlength'			=> 30,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 30,
							'table'				=> 'bank_akts_contents'),	
						array(
							'name'				=> 'rate',
							'description'		=> 'Тариф',
							'type'				=> fldHidden,
					        'maxlength'			=> 10,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 31,
							'table'				=> 'bank_akts_contents'),	
						array(
							'name'				=> 'assured_title',
							'description'		=> 'Вигодонабувач',
							'type'				=> fldHidden,
					        'maxlength'			=> 130,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 32,
							'table'				=> 'bank_akts_contents'),	
							
							
						array(
							'name'				=> 'product_title',
							'description'		=> 'Продукт',
							'type'				=> fldText,
					        'maxlength'			=> 120,
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
							'orderPosition'		=> 3,
							'table'				=> 'bank_akts_contents'),	
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
                            'table'                => 'bank_akts_contents'),
                          
						 
						array(
                            'name'                => 'policies_id',
                            'description'        => 'Полис',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
							'orderPosition'		=> 53,	
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'bank_akts_contents'),
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
							'orderPosition'		=> 4,	
							'table'				=> 'bank_akts_contents'), 
						 array(
							'name'				=> 'insurance_amount',
							'description'		=> 'Страх сума, грн',
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
							'table'				=> 'bank_akts_contents'),	
						array(
							'name'				=> 'credit_amount',
							'description'		=> 'Сума кредиту, грн',
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
							'orderPosition'		=> 6,	
							'table'				=> 'bank_akts_contents'),	
							
						array(
							'name'				=> 'bank_discount_value',
							'description'		=> 'Знижка для банкiв',
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
							'orderPosition'		=> 7,	
							'table'				=> 'bank_akts_contents'),		       	
						array(
							'name'				=> 'bank_commission_value',
							'description'		=> 'Компенсацiя банка',
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
							'orderPosition'		=> 8,	
							'table'				=> 'bank_akts_contents'),
							
						array(
							'name'				=> 'bank_rko_insurance_amount',
							'description'		=> 'РКО грн ',
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
							'orderPosition'		=> 9,	
							'table'				=> 'bank_akts_contents'),		       	
							
						 		       	
						array(
							'name'				=> 'commission_amount',
							'description'		=> 'Комісія, грн',
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
							'orderPosition'		=> 11,	
							'table'				=> 'bank_akts_contents'),
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
                            'orderPosition'		=> 12,
							'table'				=> 'bank_akts_contents'),
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
                            'orderPosition'         => 13,
                            'table'                 => 'bank_akts_contents',
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
                                    'update'    => true,
                                    'change'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 14,
                            'table'             => 'bank_akts_contents'),
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
							'table'				=> 'bank_akts_contents'),
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
							'orderPosition'		=> 15,
							'width'				=> 100,
							'table'				=> 'bank_akts_contents')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 15,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function BankAktsContents($data) {
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
                $BankAkts=new BankAkts($data);
				$this->permissions = $Authorization->data['permissions'][ get_class($BankAkts) ];
				break;
            case ROLES_AGENT:
                $this->permissions = array(
					'show'					=> true,
					'view'					=> true
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
			$sql='SELECT b.id,a.number,date_format(rep.payments_date, ' . $db->quote(DATE_FORMAT) . ') as date_format,
			rep.policy_payments_amount as amount,c.title FROM '.PREFIX.'_policies a 
			JOIN  '.PREFIX.'_policy_payments_calendar b on b.policies_id=a.id 
			JOIN '.PREFIX.'_payment_statuses c on c.id=b.statuses_id 
			join insurance_report_payments_details rep on rep.payments_calendar_id=b.id
			WHERE ' . implode(' AND ', $conditions) . '  ' ;
			
			$conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
			
			//КАСКО, банк
		$sql =	'SELECT   cal.id as id,a.id as policy_id,a.product_types_id,a.rate,a.commission as documents,a.number,1 as type,IF(yp.products_id>0,yp.products_title, p.title) as product_title,a.insurer,
				IF(yp.products_id>0,yp.bank_discount_value,p_k.bank_discount_value) as bank_discount_value,
				IF(yp.products_id>0,yp.bank_commission_value,p_k.bank_commission_value) as bank_commission_value,
				0 as bank_rko_insurance_amount,
				a.solutions_id,cal.date as plan_date,pd.insurance_price,
				ag.title as agency_title,pd.prolongation,a.types_id as quote,pd.assured_title,date_format(pd.payments_date, ' . $db->quote(DATE_FORMAT) . ') as date_format,
				c1.brands_id,cal.amount as payment_amount,cal.id as payment_calendar_id,cal.number_insurance_year,yp.amount_kasko as full_amount_kasko,ccc.title ' .
				'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN ' . PREFIX . '_policies_kasko AS b ON a.id = b.policies_id ' .
				'JOIN ' . PREFIX . '_policies_kasko_items AS c1 ON a.id = c1.policies_id ' .
				'JOIN insurance_policy_payments_calendar cal on cal.policies_id=a.id '.
				'JOIN insurance_report_payments_details pd on pd.payments_calendar_id=cal.id '.
				'JOIN  insurance_agencies ag on ag.id=a.agencies_id '.
	
				
				'JOIN '.PREFIX.'_payment_statuses ccc on ccc.id=cal.statuses_id '.
				
				'LEFT JOIN insurance_policies_kasko_items it on it.policies_id=a.id '.
				'LEFT JOIN insurance_products p on it.products_id=p.id '.
				'LEFT JOIN insurance_products_kasko p_k on it.products_id=p_k.products_id '.
				'LEFT JOIN insurance_policies_kasko_item_years_payments yp on yp.id=cal.item_years_payments_id '.
				'LEFT JOIN insurance_products_kasko p_k1 on yp.products_id=p_k1.products_id '.
				'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
				'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
				'WHERE ' . implode(' AND ', $conditions) . '   AND a.product_types_id = ' . PRODUCT_TYPES_KASKO . '     ' .
				' LIMIT 10 ';
		 		
				
			$list = $db->getAll($sql);
			if (!$list) {
			$sql =	'SELECT   cal.id as id,a.id as policy_id,a.product_types_id,a.rate,a.commission as documents,a.number,1 as type, p.title as product_title,a.insurer,
					p_k.bank_discount_value as bank_discount_value,
					p_k.bank_commission_value as bank_commission_value,
					0 as bank_rko_insurance_amount,
					a.solutions_id,cal.date as plan_date,pd.insurance_price,
					ag.title as agency_title,pd.prolongation,a.types_id as quote,pd.assured_title,
					cal.amount as payment_amount,cal.id as payment_calendar_id,cal.number_insurance_year,date_format(pd.payments_date, ' . $db->quote(DATE_FORMAT) . ') as date_format,ccc.title  ' .
					'FROM ' . PREFIX . '_policies AS a ' .
					'JOIN ' . PREFIX . '_policies_ns AS b ON a.id = b.policies_id ' .
					'JOIN insurance_policy_payments_calendar cal on cal.policies_id=a.id '.
					'JOIN insurance_report_payments_details pd on pd.payments_calendar_id=cal.id '.
					'JOIN  insurance_agencies ag on ag.id=a.agencies_id '.
					'JOIN '.PREFIX.'_payment_statuses ccc on ccc.id=cal.statuses_id '.
					'LEFT JOIN insurance_products p on b.products_id=p.id '.
					'LEFT JOIN insurance_products_ns p_k on b.products_id=p_k.products_id '.
					'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
					'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
					'WHERE ' . implode(' AND ', $conditions) . '   AND a.product_types_id = ' . PRODUCT_TYPES_NS . ' AND b.financial_institutions_id >0  ' .
					' '. ' LIMIT 10 ';
					
				$list = $db->getAll($sql);
				if (!$list) {
				array_pop($conditions);
				$sql =	'SELECT   cal.id as id,a.id as policy_id,a.product_types_id,a.rate,a.commission as documents,a.number,1 as type, \'Майно\' as product_title,a.insurer,
					0 as bank_discount_value,
					0 as bank_commission_value,
					0 as bank_rko_insurance_amount,
					a.solutions_id,cal.date as plan_date,pd.insurance_price,
					ag.title as agency_title,pd.prolongation,a.types_id as quote,pd.assured_title,
					cal.amount as payment_amount,cal.id as payment_calendar_id,cal.number_insurance_year,date_format(pd.payments_date, ' . $db->quote(DATE_FORMAT) . ') as date_format,ccc.title  ' .
					'FROM ' . PREFIX . '_policies AS a ' .
					'JOIN ' . PREFIX . '_policies_property AS b ON a.id = b.policies_id ' .
					'JOIN insurance_policy_payments_calendar cal on cal.policies_id=a.id '.
					'JOIN insurance_report_payments_details pd on pd.payments_calendar_id=cal.id '.
					'JOIN  insurance_agencies ag on ag.id=a.agencies_id '.
					'JOIN '.PREFIX.'_payment_statuses ccc on ccc.id=cal.statuses_id '.
					'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
					'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
					'WHERE  ' . implode(' AND ', $conditions) . '  AND a.product_types_id = ' . PRODUCT_TYPES_PROPERTY . '    ' .
					' '. ' LIMIT 10 ';
					
					$list = $db->getAll($sql );
					
					if (!$list) {
						$sql =	'SELECT   cal.id as id,a.id as policy_id,a.product_types_id,a.rate,a.commission as documents,a.number,1 as type, \'Добровільне страхування майна що є предметом іпотеки\' as product_title,a.insurer,
						0 as bank_discount_value,
						0 as bank_commission_value,
						0 as bank_rko_insurance_amount,
						a.solutions_id,cal.date as plan_date,pd.insurance_price,
						ag.title as agency_title,pd.prolongation,a.types_id as quote,pd.assured_title,
						cal.amount as payment_amount,cal.id as payment_calendar_id,cal.number_insurance_year,date_format(pd.payments_date, ' . $db->quote(DATE_FORMAT) . ') as date_format,ccc.title  ' .
						'FROM ' . PREFIX . '_policies AS a ' .
						'JOIN ' . PREFIX . '_policies_mortage AS b ON a.id = b.policies_id ' .
						'JOIN insurance_policy_payments_calendar cal on cal.policies_id=a.id '.
						'JOIN insurance_report_payments_details pd on pd.payments_calendar_id=cal.id '.
						'JOIN  insurance_agencies ag on ag.id=a.agencies_id '.
						'JOIN '.PREFIX.'_payment_statuses ccc on ccc.id=cal.statuses_id '.
						'JOIN ' . PREFIX . '_agencies as a1 on a1.id=a.agencies_id  ' .
						'LEFT JOIN ' . PREFIX . '_agencies as a2 on a2.id=a1.parent_id  ' .
						'WHERE ' . implode(' AND ', $conditions) . '   AND a.product_types_id = 15 AND b.financial_institutions_id >0     ' .
						' ';
						$list = $db->getAll($sql );
					}
					
			 
				}
			}
			
			
			if (is_array($list) && sizeof($list)>0)
			{
			
			
			
				$res='<table border=1>';
				$res.='<tr><td>&nbsp;<td><b>Номер</b></td><td><b>Сумма платежу</b></td><td><B>Дата</b></td><td><b>Статус</b></td></tr>';
				foreach ($list as $row)
				{
				
				
				
				//**************************************************
				
				
				$r = $row;
				$r['id'] = $row['policy_id'];
				$insurance_amount = 0;
				$d['insurance_amount'] = $r['insurance_price'];
				
				$rate = 0;
				if ($r['product_types_id']==3) {
					$multiyear = intval($db->getOne('SELECT count(*) FROM insurance_policies_kasko_item_years_payments WHERE policies_id='.intval($r['id'])));
					if ($multiyear) { //многолетний
						$rate = doubleval($db->getOne('SELECT rate_kasko FROM insurance_policies_kasko_item_years_payments WHERE policies_id = ' .intval($r['id']).'  AND date>='.$db->quote($r['plan_date']).' ORDER BY date limit 1 '));
					}
					else {
						$rate = doubleval($db->getOne('SELECT rate FROM insurance_policies WHERE id=' .intval($r['id'])));
					}
				}	
				else $rate=$r['rate'];
				
				$d['rate']=$rate;
				
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
				
				
				$d['commission_amount'] = 0; //итого что платить банку
				//if ($r['solutions_id']>0 && $r['number_insurance_year']==1) {
	
					if($d['bank_discount_value']>1) {
						$d['commission_amount'] = round($d['payment_amount'] * (1 - round(1/$d['bank_discount_value'], 3)), 2);
					}
					elseif ($d['bank_commission_value']>0) 
					{
						$k=1;
						if ($r['full_amount_kasko']>0 && intval($d['payment_amount'])!=intval($r['full_amount_kasko']))
							$k=$d['payment_amount']/$r['full_amount_kasko'];
						$d['commission_amount'] = round($d['bank_commission_value'] * $d['insurance_amount']/100*$k,2);
					}
					$d['commission_amount'] =round($d['commission_amount'] ,2);
				//****************************************************
					$res.='<tr><td><input type="radio"  onclick="setNumber('.$row['id'].')"  value="'.$row['id'].'" name="paymentsCalendarId"></td>';
					$res.='<td><input readonly type="text" id="number'.$row['id'].'" name="number'.$row['id'].'" value="'.$row['number'].'" maxlength="50" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /></td>';


					$res.='<td><input readonly type="text" id="payment_amount'.$row['id'].'" name="payment_amount'.$row['id'].'" value="'.$row['payment_amount'].'" maxlength="10" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /></td>';
					$res.=' <input   type="hidden" id="product_title'.$row['id'].'" name="product_title'.$row['id'].'" value="'.$row['product_title'].'"/> ';
					$res.=' <input   type="hidden" id="insurer'.$row['id'].'" name="insurer'.$row['id'].'" value="'.$row['insurer'].'"/> ';					
					$res.=' <input   type="hidden" id="agency_title'.$row['id'].'" name="agency_title'.$row['id'].'" value="'.$row['agency_title'].'"/> ';										
					$res.=' <input   type="hidden" id="prolongation'.$row['id'].'" name="prolongation'.$row['id'].'" value="'.$row['prolongation'].'"/> ';															
					$res.=' <input   type="hidden" id="quote'.$row['id'].'" name="quote'.$row['id'].'" value="'.$row['quote'].'"/> ';																				
					$res.=' <input   type="hidden" id="assured_title'.$row['id'].'" name="assured_title'.$row['id'].'" value="'.$row['assured_title'].'"/> ';																									
					$res.=' <input   type="hidden" id="bank_discount_value'.$row['id'].'" name="bank_discount_value'.$row['id'].'" value="'.$row['bank_discount_value'].'"/> ';
					$res.=' <input   type="hidden" id="bank_commission_value'.$row['id'].'" name="bank_commission_value'.$row['id'].'" value="'.$row['bank_commission_value'].'"/> ';
					$res.=' <input   type="hidden" id="bank_rko_insurance_amount'.$row['id'].'" name="bank_rko_insurance_amount'.$row['id'].'" value="'.doubleval($row['bank_rko_insurance_amount']).'"/> ';
					$res.=' <input   type="hidden" id="ek_number'.$row['id'].'" name="ek_number'.$row['id'].'" value="'.$row['ek_number'].'"/> ';
					$res.=' <input   type="hidden" id="statuses_id'.$row['id'].'" name="statuses_id'.$row['id'].'" value="1"/> ';
					$res.=' <input   type="hidden" id="types_id'.$row['id'].'" name="types_id'.$row['id'].'" value="0"/> ';
					$res.=' <input   type="hidden" id="manual'.$row['id'].'" name="manual'.$row['id'].'" value="0"/> ';
					
					$res.=' <input   type="hidden" id="rate'.$row['id'].'" name="rate'.$row['id'].'" value="'.doubleval($d['rate']).'"/> ';
					$res.=' <input   type="hidden" id="commission_amount'.$row['id'].'" name="commission_amount'.$row['id'].'" value="'.doubleval($d['commission_amount']).'"/> ';
					$res.=' <input   type="hidden" id="insurance_amount'.$row['id'].'" name="insurance_amount'.$row['id'].'" value="'.doubleval($d['insurance_amount']).'"/> ';
					$res.=' <input   type="hidden" id="credit_amount'.$row['id'].'" name="credit_amount'.$row['id'].'" value="'.doubleval($d['credit_amount']).'"/> ';
					

					
					
					
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
//_dump($data);exit;
        $id = parent::insert($data, false);

        if (!$Log->isPresent() && $id) {

            $params['title']		= $this->messages['single'];
            $params['id']           = $id;
            $params['storage']      = $this->tables[0];
            //проставить наличие оплаты и документов на момент занесения
			$sql='UPDATE '.PREFIX.'_bank_akts_contents a JOIN '.PREFIX.'_policy_payments_calendar b on a.payments_calendar_id=b.id JOIN '.PREFIX.'_policies c ON c.id=b.policies_id SET a.policies_id=b.policies_id,a.statuses_id=b.statuses_id,a.documents=1 WHERE a.id='.intval($id);
			$db->query($sql);
			//_dump($sql);
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
	

	
    function exportInWindow($data) {
        global $db, $Smarty;

        $this->checkPermissions('export', $data);

		 header('Content-Disposition: attachment; filename="export.xls"');
		 header('Content-Type: ' . Form::getContentType('export.xls'));
	     header('Accept-Ranges: bytes');
	     header('Expires: 0');
	     header('Cache-Control: private');
	
       
		//unset($fields['akts_id']);
		$conditions[]='akts_id='.intval($data['akts_id']);

        
        $sql	= $this->show($data, $fields, $conditions, null, $this->object . '/export.tpl', false);
        exit;
    }
	
	
}

?>