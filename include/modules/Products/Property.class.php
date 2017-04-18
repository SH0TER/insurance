<?
/*
 * Title: Products_Property class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

define(RISK_PROPERTY1,44);//ПОЖЕЖА
define(RISK_PROPERTY2,45);//СТИХІЙНІ ЯВИЩА
define(RISK_PROPERTY3,46);//ВПЛИВ ВОДИ
define(RISK_PROPERTY4,47);//РИЗИК ПРОТИПРАВНИХ ДІЙ ТРЕТІХ ОСІБ
define(RISK_PROPERTY5,48);//ТРАНСПОРТНА ШКОДА


class Products_Property extends Products {

     var $property_groups =
           array(
            'Житлове приміщення' =>array(RISK_PROPERTY1=>0.06,RISK_PROPERTY2=>0.02,RISK_PROPERTY3=>0.04,RISK_PROPERTY4=>0.02,RISK_PROPERTY5=>0.02),
            'Оздоблення' =>array(RISK_PROPERTY1=>0.1,RISK_PROPERTY2=>0.01,RISK_PROPERTY3=>0.14,RISK_PROPERTY4=>0.03,RISK_PROPERTY5=>0.02),
            'Обладнання' =>array(RISK_PROPERTY1=>0.1,RISK_PROPERTY2=>0.01,RISK_PROPERTY3=>0.1,RISK_PROPERTY4=>0.04,RISK_PROPERTY5=>0.02),
            'Рухоме майно' =>array(RISK_PROPERTY1=>0.1,RISK_PROPERTY2=>0.02,RISK_PROPERTY3=>0.2,RISK_PROPERTY4=>0.1,RISK_PROPERTY5=>0.02),
            'Господарські будівлі' =>array(RISK_PROPERTY1=>0.08,RISK_PROPERTY2=>0.03,RISK_PROPERTY3=>0.03,RISK_PROPERTY4=>0.04,RISK_PROPERTY5=>0.03)
           );

	var $object = 'Products';

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
							'table'				=> 'products'),
						array(
							'name'				=> 'product_types_id',
							'description'		=> 'Тип',
					        'type'				=> fldHidden,
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
							'table'				=> 'products'),
						array(
							'name'				=> 'code',
							'description'		=> 'Код',
					        'type'				=> fldText,
					        'maxlength'			=> 20,
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
							'orderPosition'		=> 1,
                            'width'             => 100,
							'table'				=> 'products'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
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
							'orderPosition'		=> 2,
							'table'				=> 'products'),
						array(
							'name'				=> 'base_rate',
							'description'		=> 'Базовий тариф, %',
					        'type'				=> fldPercent,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'products_property'),

						array(
							'name'				=> 'cart_discount',
							'description'		=> 'Знижка за карткою CarMan@CarWoman, %',
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
							'orderPosition'		=> 3,
							'table'				=> 'products'),
						array(
							'name'				=> 'description',
							'description'		=> 'Опис',
					        'type'				=> fldNote,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'products'),
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
							'name'				=> 'agencies_id',
							'description'		=> 'Агенції',
					        'type'				=> fldMultipleSelect,
							'structure'			=> 'tree',
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'product_agency_assignments',
							'sourceTable'		=> 'agencies',
							'selectField'		=> 'CONCAT(code, \'-\', title)',
							'orderField'		=> 'CAST(code AS UNSIGNED), title'),
						array(
							'name'				=> 'publish',
							'description'		=> 'Показувати',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'change'	=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 4,
                            'width'             => 100,
							'table'				=> 'products'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 5,
                            'width'             => 100,
							'table'				=> 'products'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 6,
							'width'				=> 100,
							'table'				=> 'products')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function Products_Property($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Страхові продукти';
		$this->messages['single'] = 'Страховий продукт';
	}

	function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'copy'      => true,
                    'update'    => true,
                    'view'      => false,
                    'change'    => true,
                    'delete'    => true,
                    'export'    => false);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
        }
    }
	
	function showForm($data, $action, $actionType=null, $template=null) {
		return parent::showForm($data, $action, $actionType, 'property.php');
	}

	function insert($data, $redirect=true) {
		global $Log;

		$data['products_id'] = parent::insert($data, false);

		if (!$Log->isPresent()) {

			$params['title']		= $this->messages['single'];
			$params['id']			= $data['products_id'];
			$params['storage']		= $this->tables[0];

			ParametersProperty::setValues($data);

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

			ParametersProperty::setValues($data);

			if ($redirect) {
				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $_SERVER['PHP_SELD'] . '?do=ProductTypes|view&id=' . $data['product_types_id'] . '&products_id=' . $data['products_id']);
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

		$sql =	'DELETE FROM ' . PREFIX . '_products_property ' .
				'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);
	}

    function calculate($data) {
        global $db;

		$property_group = $this->property_groups[$data['property_group']];

		$sql =	'SELECT a.products_id ' .
				'FROM ' . PREFIX . '_products_property AS a ' .
				'LEFT JOIN ' . PREFIX . '_product_financial_institution_assignments AS b ON a.products_id = b.products_id ' .
				'WHERE b.financial_institutions_id ' . ($data['financial_institutions_id']>0 ? '=' . $data['financial_institutions_id'] : ' IS NULL ') . ' ' .
				'ORDER BY a.products_id DESC';
		$data['products_id'] = $db->getOne($sql, 30*60);

		if (is_array($property_group) && is_array($data['risks'])  && is_array($data['params']) && $data['products_id']) {

			//коэф краткосрочности
			$sql =	'SELECT value ' .
					'FROM ' . PREFIX . '_parameters_terms ' .
					'WHERE id = ' . intval($data['terms_id']);
			$terms = $db->getOne($sql);

			$base_rate = 0;

			foreach($data['risks'] as $risks_id) {
				$base_rate += $property_group[ $risks_id ];
			}

			$deductible_rate = 0;
			if ($data['deductible'] == 1) {
				$deductible_rate = 1;
			} elseif($data['deductible'] == 1.5) {
				$deductible_rate = 0.95;
			} elseif($data['deductible'] == 2) {
				$deductible_rate = 0.92;
			}

			$property_id = array(0);
			foreach($data['params'] as $param) {
				if (intval($param)>0) {
					$property_id[] = $param;
				}
			}

			//остальыне коэфициенты
			$sql =	'SELECT value ' .
					'FROM ' . PREFIX . '_products_property AS a ' .
					'JOIN ' . PREFIX.'_product_property_values AS b ON a.products_id = b.products_id ' .
					'WHERE a.products_id = ' . intval($data['products_id']) . ' AND property_id IN ( ' . implode(', ', $property_id) . ')';
			$res = $db->getCol($sql);

			$additional_rate = 1;
			if (is_array($res)) {
				foreach($res as $rate) {
					$additional_rate *= $rate;
				}
			}

			$data['rate']	= round($base_rate * $deductible_rate * $additional_rate * $terms, 3);
			$data['amount']	= round($data['rate'] * $data['price'] /100, 2);
		}

		return array('rate'=>$data['rate'], 'amount'=>$data['amount']);
	}

	function getRateInWindow($data) {
		$result = $this->calculate($data);

		echo '{"price":"' . doubleval($data['price']) . '","rate":"' . doubleval($result['rate']) . '","amount":"' . doubleval($result['amount']) . '"}';
		exit;
	}
}
?>