<?
/*
 * Title: NS class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';
class Products_NS extends Products {

    var $object = 'Products';

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
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'product_types_id',
                            'description'           => 'Тип',
                            'type'                  => fldHidden,
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
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'code',
                            'description'           => 'Код',
                            'type'                  => fldText,
                            'maxlength'             => 20,
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
                            'orderPosition'         => 1,
                            'width'                 => 100,
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'title',
                            'description'           => 'Назва',
                            'type'                  => fldText,
                            'maxlength'             => 280,
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
                            'table'                 => 'products'),
						array(
                            'name'                  => 'insurance_companies_id',
                            'description'           => 'Страхова компанiя',
                            'type'                  => fldRadio,
							'withoutTable'		    => true,
                            'list'                  => array(
                                                        INSURANCE_COMPANIES_EXPRESS => 'ТДВ "Eкспрес Страхування"',
                                                        8 => 'УСК «Гарант-Лайф»'),
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products'),
						array(
                            'name'                  => 'second_year',
                            'description'           => 'Стороннiй клієнт',
                            'type'                  => fldBoolean,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'change'        => false,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 9,
                            'width'                 => 70,
                            'table'                 => 'products_ns'),	
						array(
							'name'					=> 'cart_discount',
							'description'			=> 'Знижка за карткою CarMan@CarWoman, %',
					        'type'					=> fldPercent,
							'display'				=> 
								array(
									'show'			=> true,
									'insert'		=> true,
									'view'			=> true,
									'update'		=> true
								),
							'verification'			=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'			=> 5,
							'table'					=> 'products'),
						 array(
                            'name'				    => 'max_discount',
                            'description'		    => 'Розмір максимальної знижки, %',
                            'type'				    => fldPercent,
                            'display'			    =>
                                array(
                                    'show'		    => true,
                                    'insert'	    => true,
                                    'view'		    => true,
                                    'update'	    => true
                                ),
                            'verification'		    =>
                            array(
                                'canBeEmpty'	    => false
                            ),
                            'table'				    => 'products'),	
						array(
							'name'					=> 'bank_discount_value',
							'description'			=> 'Знижка для банкiв',
					        'type'					=> fldPercent,
							'maxlength'         	=> 10,
							'display'				=> 
								array(
									'show'			=> false,
									'insert'		=> true,
									'view'			=> true,
									'update'		=> true
								),
							'verification'			=>
								array(
									'canBeEmpty'	=> false
								),
							'table'					=> 'products_ns'),
						array(
							'name'					=> 'bank_commission_value',
							'description'			=> 'Компенсацiя банка',
					        'type'					=> fldPercent,
							'display'				=> 
								array(
									'show'			=> false,
									'insert'		=> true,
									'view'			=> true,
									'update'		=> true
								),
							'verification'			=>
								array(
									'canBeEmpty'	=> false
								),
							'table'					=> 'products_ns'),

                        array(
                            'name'                  => 'bank_discount1_value',
                            'description'           => 'Знижка для банкiв 2',
                            'type'                  => fldPercent,
                            'maxlength'             => 10,
                            'display'               => 
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_ns'),
                        array(
                            'name'                  => 'bank_commission1_value',
                            'description'           => 'Компенсацiя банка 2',
                            'type'                  => fldPercent,
                            'display'               => 
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'products_ns'),
						array(
                            'name'                  => 'bill_bank_account',
                            'description'           => 'Р/р банку для рахунку',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products_ns'),
						array(
                            'name'                  => 'bill_bank_mfo',
                            'description'           => 'МФО банку для рахунку',
                            'type'                  => fldText,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products_ns'),
						array(
                            'name'                  => 'related_products_id',
                            'description'           => 'Продукти наступного періоду',
                            'type'                  => fldMultipleSelect,
							'condition'				=> 'product_types_id = 13',//ограничиваем продуктовым рядом нс
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true,
                                    'change'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products_related',
                            'sourceTable'           => 'products',
                            'selectField'           => 'title',
                            'orderField'            => 'title'),	
                        array(
                            'name'                  => 'description',
                            'description'           => 'Опис',
                            'type'                  => fldNote,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true,
                                    'change'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'financial_institutions_id',
                            'description'           => 'Банки',
                            'type'                  => fldMultipleSelect,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true,
                                    'change'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'product_financial_institution_assignments',
                            'sourceTable'           => 'financial_institutions',
                            'selectField'           => 'title',
                            'orderField'            => 'title'),
                        array(
                            'name'                  => 'agencies_id',
                            'description'           => 'Агенції',
                            'type'                  => fldMultipleSelect,
							'structure'				=> 'tree',
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true,
                                    'change'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'product_agency_assignments',
                            'sourceTable'           => 'agencies',
                            'selectField'			=> 'CONCAT(code, \'-\', title)',
							'orderField'			=> 'CAST(code AS UNSIGNED), title'),
                        array(
                            'name'                  => 'publish',
                            'description'           => 'Показувати',
                            'type'                  => fldBoolean,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'change'        => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 7,
                            'width'                 => 100,
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'created',
                            'description'           => 'Створено',
                            'type'                  => fldDate,
                            'value'                 => 'NOW()',
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
                            'orderPosition'         => 8,
                            'width'                 => 100,
                            'table'                 => 'products'),
                        array(
                            'name'                  => 'modified',
                            'description'           => 'Редаговано',
                            'type'                  => fldDate,
                            'value'                 => 'NOW()',
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => false,
                                    'view'          => true,
                                        'update'    => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'         => 9,
                            'width'                 => 100,
                            'table'                 => 'products')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'      => 1,
                        'defaultOrderDirection'     => 'asc',
                        'titleField'                => 'title'
                    )
            );

    function Products_NS($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Страхові продукти';
        $this->messages['single'] = 'Страховий продукт';
    }

	function showForm($data, $action, $actionType=null, $template=null) {
		return parent::showForm($data, $action, $actionType, 'ns.php');
	}

    function checkFields($data, $action) {
        parent::checkFields($data, $action);

		ParametersRisks::checkValues($data);
	}

	function insert($data, $redirect=true) {
		global $Log;

		$data['products_id'] = parent::insert($data, false);

		if (intval($data['products_id'])) {

			$params['title']		= $this->messages['single'];
			$params['id']			= $data['products_id'];
			$params['storage']		= $this->tables[0];

			ParametersRisks::setValues($data);
            ParametersTerms::setValues($data);
            ParametersNS::setValues($data);

			if ($redirect) {
				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Products|updateCommissions&product_types_id=' . $data['product_types_id'] . '&products_id=' . $data['products_id']);
				exit;
			} else {
				return $params['id'];
			}
		}
	}

	function update($data, $redirect=true) {
		global $Log;

		$data['products_id'] = parent::update($data, false);

		if (!$Log->isPresent() && $data['products_id']) {

			$params['title']		= $this->messages['single'];
			$params['id']			= $data['products_id'];
			$params['storage']		= $this->tables[0];

			ParametersRisks::setValues($data);
            ParametersTerms::setValues($data);
            ParametersNS::setValues($data);
			if ($redirect) {
				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $_SERVER['PHP_SELD'] . '?do=Products|updateCommissions&product_types_id=' . $data['product_types_id'] . '&products_id=' . $data['products_id']);
				exit;
			} else {
				return $params['id'];
			}
		}
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db, $Log;

		$Policies = new Policies($data);

		$sql =	'SELECT id ' . 
				'FROM ' . PREFIX . '_policies ' .
				'WHERE products_id IN(' . implode(' , ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>Поліси</b>.');
			return false;
		}

		$sql =	'DELETE FROM ' . PREFIX . '_agency_commissions ' .
				'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);
	}

    //установка поправочных коефициентов продукта
    function calculate($risks, $financial_institutions_id, $price, $discount, $cart_discount, $agencies_id, $terms_id, &$data) {
		global $db;

		$conditions[] = 'a.product_types_id = ' . PRODUCT_TYPES_NS;
		$conditions[] = 'a.publish=1 ';

		$conditions[] = (intval($financial_institutions_id))
			? 'a.id IN (SELECT products_id FROM ' . PREFIX . '_product_financial_institution_assignments WHERE financial_institutions_id = ' . intval($financial_institutions_id). ') AND a.id IN (SELECT DISTINCT products_id FROM insurance_product_agency_assignments WHERE agencies_id='.intval($data['agencies_id']).')'
			: 'a.id NOT IN(SELECT DISTINCT products_id FROM ' . PREFIX . '_product_financial_institution_assignments)';
			
		if ($data['options_second_year'])
					$conditions[] = 'b.second_year=1';

		if (is_array($data['risks'])) {
			$conditions[] = 'c.risks_id IN(' . implode(', ', $data['risks']) . ')';
		}

		$conditions[] = 'd.agencies_id = ' . intval($agencies_id);
		if ($data['allowed_products_id'] && intval($financial_institutions_id)>0) {
            $conditions[] = 'a.id IN (' . $data['allowed_products_id'] . ')';
        }
		$conditions[] = 'a.insurance_companies_id= '.intval($data['insurance_companies_id']);
		
		
		$sql =	'SELECT ' .
                        'a.*, a.product_types_id, '.
                        'b.*, ' .
                        'SUM(c.value) AS rate, ' .
                        'k.product_types_id, k.value as terms_value,k.order_position as month_count ' .
				'FROM ' . PREFIX . '_products AS a ' .
				'JOIN ' . PREFIX . '_products_ns AS b ON a.id = b.products_id ' .
				'JOIN ' . PREFIX . '_product_risks AS c ON a.id = c.products_id ' .
				'JOIN ' . PREFIX . '_product_agency_assignments AS d ON a.id = d.products_id ' .
                'JOIN ' . PREFIX . '_product_terms AS y ON a.id = y.products_id AND y.terms_id = ' . intval($data['terms_id']) . ' ' ."\n".
                'JOIN ' . PREFIX . '_parameters_terms as k ON a.product_types_id = k.product_types_id AND k.id = ' . intval($data['terms_id']) . ' ' ."\n".
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'GROUP BY c.products_id ' .
				'LIMIT 1';
		$row =	$db->getRow($sql);
//_dump($row);
        $commissions = Products::getCommissions($row['products_id'], $data['date'], $agencies_id, $data['discount'], $financial_institutions_id);

		
        $data['products_id'] = $row['products_id'];
        $data['product_factors'] = 1;

        if ($data['products_id'] && is_array($data['values_id']) && !empty($data['values_id'])) {//ессли $row не пустой и масив поправоч. коеф установлен
            //выбираем значения коеф.
            $sql = 'SELECT value FROM ' . PREFIX .'_product_ns_values ' .
                   'WHERE values_id IN (' . implode(',', $data['values_id']) . ') AND products_id = '. $data['products_id'];

            $list = $db->getCol($sql);
            //перемножаем коеф.
            $iterator = 0;

            while($list[$iterator]) {
                $data['product_factors'] *= $list[$iterator];
                $iterator++;
            }
        }

        $data['cart_discount']                  = $row['cart_discount'];
        $data['terms_value']                    = $row['terms_value'];

        $data['commission_agency_percent']      = $commissions['commission_agency_percent'];

        $data['commission_agent_percent']       = $commissions['commission_agent_percent'];
		
		$data['commission_manager_percent']       = $commissions['commission_manager_percent'];
		$data['commission_seller_agents_percent']       = $commissions['commission_seller_agents_percent'];
		//тут идет модификация комиссий
		if ($data['manager_id']) //выбрали менеджера що привiв клиента
		{
			$data['commission_agent_percent'] = $data['commission_agent_percent']/2;
		}
		else {
			$data['commission_manager_percent'] = 0;
		}
		
		if (!$data['seller_agents_id']) //не выбрали продающего в агенции
		{
			$data['commission_seller_agents_percent'] = 0;
		}
		 
		
        
        
		if (!$cart_discount) {
			$data['cart_discount'] = 0;
		}

        //Проверка на вторую ячейку скидок и компенсаций

        if(abs($data['bank_discount_value'] - 1) < 0.00001)
            $data['bank_discount_value'] = $row['bank_discount1_value'];
        else
            $data['bank_discount_value'] = $row['bank_discount_value'];

        if(abs($data['bank_commission_value']) < 0.00001)
            $data['bank_commission_value'] = $row['bank_commission1_value'];
        else
            $data['bank_commission_value'] = $row['bank_commission_value'];

		//$data['bank_discount_value'] = $row['bank_discount_value'];
		//$data['bank_commission_value'] = $row['bank_commission_value'];
		
		$sign_count = 3;
		if ($financial_institutions_id ==28)  
		{
			$sign_count = 4; //4 знака для втб банк
			$data['terms_value'] = 1/12;
		}
		//_dump($data['terms_value']);

        if(doubleval($row['rate']) > 0 ){
            $data['rate']	                        = number_format((($row['rate'] * (100 - $discount - $data['cart_discount']) / 100 * $data['bank_discount_value'] + $data['bank_commission_value']) * floatval($data['terms_value']) * $data['product_factors']), $sign_count, '.', '');
			if ($financial_institutions_id ==28)  $data['rate']=doubleval($data['rate'])*$row['month_count'];
//_dump(            $data['rate'])		;
            $data['amount']	                        = number_format($data['rate'] / 100 * $price, 2, '.', '');
			
			
            $data['rate_without_cart_discount']     = number_format((($row['rate'] * (100 - $discount) / 100 * $data['bank_discount_value'] + $data['bank_commission_value']) * floatval($data['terms_value']))* $data['product_factors'], $sign_count, '.', '');
//_dump($row['rate'] );_dump($data['product_factors']);
			if ($financial_institutions_id ==28)   $data['rate_without_cart_discount']=doubleval( $data['rate_without_cart_discount'])*$row['month_count'];
            $data['amount_without_cart_discount']	= number_format($data['rate_without_cart_discount'] / 100 * $price, 2, '.', '');
        } else {
            $data['rate']	                        = number_format(0,3,'.','');
            $data['amount']	                        = number_format(0,3,'.','');
            $data['rate_without_cart_discount']     = number_format(0,3,'.','');
            $data['amount_without_cart_discount']   = number_format(0,3,'.','');
        }

        //выбираем описания поправочных коэффициентов для записи в Json
        $sql = 'SELECT id, description ' .
               'FROM ' . PREFIX .'_parameters_ns ' .
               'ORDER BY id';
        $list = $db->getAssoc($sql);

        //формируем массив
        $data['description'] = '"description":{';
        foreach($list as $key=>$description) {
            $data['description'] .= '"'.$key.'":"'.$description.'",';
        };

        $data['description'] .= '"":""}';//для пустого значения select

		return $data;
	}

    function getRateInWindow($data) {
		global $Authorization;

		if ($Authorization->data['roles_id'] == ROLES_AGENT) {
			$data['agencies_id'] = $Authorization->data['agencies_id'];
		}
		$data['max_discount']	= $this->getMaxDiscount(array($data['products_id']));

		$data = $this->calculate($data['risks'], $data['financial_institutions_id'], $data['price'], $data['discount'], $data['cart_discount'], $data['agencies_id'], $data['terms_id'], $data);

        echo '{' .
                '"rate":"' . doubleval($data['rate']) . '","amount":"' . getMoneyFormat($data['amount']) . '","max_discount":"' . $data['max_discount'] . '","cart_discount":"' . $data['cart_discount'] . '", '.
                '"rate_without_cart_discount":"'. doubleval($data['rate_without_cart_discount']) .'", "amount_without_cart_discount":"'.getMoneyFormat($data['amount_without_cart_discount']).'", "terms_value":"' . $data['terms_value'] . '",' .
                '"products_id":"' . $data['products_id'] . '", "product_factors":"' . number_format($data['product_factors'],3,'.','') . '", ' . $data['description'] . '}';
        exit;
    }
	
	function exportInWindow($data) {
        global $db, $Smarty;

        $this->checkPermissions('export', $data);

        $sql	= 'select * from insurance_products a join insurance_products_ns b on b.products_id=a.id ';
        $list	= $db->getAll($sql);


        header('Content-Disposition: attachment; filename="export.xls"');
        header('Content-Type: ' . Form::getContentType('export.xls'));

        include($this->object . '/export_ns.tpl');
        exit;
    }
}

?>