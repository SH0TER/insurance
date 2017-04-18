<?
/*
 * Title: GO class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

 require_once 'Policies.class.php';

class Products_DGO extends Products {

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
							'name'				=> 'go_value',
							'description'		=> 'Поправочний коефіцієнт по наявності полісу ОЦВ',
					        'type'				=> fldPercent,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 6,
							'table'				=> 'products_dgo'),
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
									'view'		=> false,
									'update'	=> true,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 8,
                            'width'             => 100,
							'table'				=> 'products'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
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
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 9,
                            'width'             => 100,
							'table'				=> 'products')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function Products_DGO($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Страхові продукти';
		$this->messages['single'] = 'Страховий продукт';
	}

	function insert($data, $redirect=true) {
		global $Log;

		$data['products_id'] = parent::insert($data, false);

		if (!$Log->isPresent()) {

			ParametersInsurancePrice::setValues($data);

			$params['title']		= $this->messages['single'];
			$params['id']			= $data['products_id'];
			$params['storage']		= $this->tables[0];

			if ($redirect) {
				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
			} else {
				return $params['id'];
			}
		}
	}

	function update($data, $redirect=true) {
		global $Log;

		$data['products_id'] = parent::update($data, false);

		if (!$Log->isPresent()) {

			ParametersInsurancePrice::setValues($data);

			$params['title']		= $this->messages['single'];
			$params['id']			= $data['products_id'];
			$params['storage']		= $this->tables[0];

			if ($redirect) {
				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: ' . $data['redirect']);
                exit;
			} else {
				return $params['id'];
			}
		}
	}
	
	function showForm($data, $action, $actionType=null, $template=null) {
		return parent::showForm($data, $action, $actionType, 'dgo.php');
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

		$sql =	'DELETE FROM ' . PREFIX . '_product_regions ' .
				'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		$sql =	'DELETE FROM ' . PREFIX . '_product_document_assignments ' .
				'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		$sql =	'DELETE FROM ' . PREFIX . '_product_payment_breakdowns ' .
				'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		$sql =	'DELETE FROM ' . PREFIX . '_agency_commissions ' .
				'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		$sql =	'DELETE FROM ' . PREFIX . '_products_dgo ' .
				'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);
	}

	//сравнение полисов ГО ДГО
	//1) протягом строку дії Договору добровільного страхування цивільної відповідальності щодо ТЗ діє Поліс ОСЦПВ (всі 365 днів);
	//2) дані по ТЗ співпадають (марка, модель ТЗ, держ. номер, номер кузову), або  співпадає тип ТЗ (якщо поліс ОСЦПВ 2-го типу);
	//3) співпадають дані по водіям допущеним до керування (ПІБ), або в разі наявності полісу ОСЦПВ 1-го типу
	function compareGO_DGO(&$data, &$message) {
		global $db;

		if (!$data['go_series'] || !$data['go_number']) { //нету полиса ГО совмещенного
            return false;
        }

		//ищем полис ГО
		$sql =  'SELECT policies_id as id ' .
                'FROM ' . PREFIX . '_policies_go ' .
                'WHERE blank_series = ' . $db->quote($data['go_series']) . ' AND blank_number = ' . $db->quote($data['go_number']);
		$row =	$db->getRow($sql);

		if (!$row) {
            $message = 'Вказаний полiс ГО не знайдено.';
            return false;
        }

		$row['checkPermissions'] = 1;
		$Policies = Policies::factory($row, 'GO');

		$Policies->permissions['update'] = true;

		$row = $Policies->view($row, false);

		$data['beginDate'] = (checkdate(intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year'])))
			? mktime(0, 0, 0, intval($data['begin_datetime_month']), intval($data['begin_datetime_day']), intval($data['begin_datetime_year']))
			: '';
		$data['endDate'] = (checkdate(intval($data['end_datetime_month']), intval($data['end_datetime_day']), intval($data['end_datetime_year'])))
			? mktime(0, 0, 0, intval($data['end_datetime_month']), intval($data['end_datetime_day']), intval($data['end_datetime_year']))
			: '';

		if ($data['beginDate']=='' || $data['endDate']=='') {
			$message = 'Не вказано дiапазон  дії полісу ДСЦВ.' ;
			return false;
		}

		$row['beginDate'] = (checkdate(intval($row['begin_datetime_month']), intval($row['begin_datetime_day']), intval($row['begin_datetime_year'])))
			? mktime(0, 0, 0, intval($row['begin_datetime_month']), intval($row['begin_datetime_day']), intval($row['begin_datetime_year']))
			: '';
		$row['endDate'] = (checkdate(intval($row['end_datetime_month']), intval($row['end_datetime_day']), intval($row['end_datetime_year'])))
			? mktime(0, 0, 0, intval($row['end_datetime_month']), intval($row['end_datetime_day']), intval($row['end_datetime_year']))
			: '';

		if ($row['beginDate']>$data['beginDate'] || $data['endDate']>$row['endDate']) { //выход за диапазоно по датам
			$message = 'Перiод дії поліса ОСЦПВ не покриває перiод дії поліса ДСЦВ.' ;
			return false;
		}
		if ($data['types_id']!=$row['types_id']) { //несовпадает Тип полиса
				$message = 'Не спiвпадае Тип полiсу.' ;
				return false;
		}

		if ($row['types_id']==1 || $row['types_id']==3) { //конкретная машина сравниваем номер кузова
			if ($row['shassi'] != $data['shassi']) {
				$message = '№ шасі (кузов, рама) не зпiвпадає з даними поліса ОСЦПВ.' ;
				return false;
			}
		}

		if ($row['types_id']==2) {//ГО 2 типа сравнить тип ТЗ

            $error = false;

			switch($row['car_types_id']) {
				case 1://Легкові автомобілі
						if ($data['car_types_id'] != 18) $error = true;
						break;
				case 2://Причіп F
						if ($data['car_types_id'] != 23) $error = true;//Причепи до легкових а/м
						break;
				case 3://Автобуси
						if ($data['car_types_id'] != 21 && $data['car_types_id'] != 22) $error = true;//Автобуси з кількістю місць для сидіння понад 20 чоловік (вкл.)
						break;
				case 4://Вантажні автомобілі
						if ($data['car_types_id'] != 19 && $data['car_types_id'] != 20) $error = true;//Вантажні автомобілі вантажопідйомністю понад 2 тонн (вкл.)
						break;
				case 5://Причіп E
						if ($data['car_types_id'] != 24) $error = true;//Причепи та н/причепи до вантажних а/м
						break;
				case 6://Мотоцикл
						if ($data['car_types_id'] != 26) $error = true;//Мотоцикли та моторолери 300 куб.см (вкл.) та більше
						break;
				case 7://Моторолер
						if ($data['car_types_id'] != 25) $error = true;//Мотоцикли та моторолери до 300 куб.см.
						break;
			}

			if ($error) {
				$message = 'Не спiвпадає тип ТЗ згiдно даних поліса ОСЦПВ' ;
				return false;
			}
		}

		return true;
	}


	function calculate($insurance_price_id, /*$car_types_id, $cities_id, $terms_id, $price,*/ &$data) {
		global $db;
 
		
		try {
			$d1 = new DateTime($data['begin_datetime']);
			$d2 = new DateTime($data['end_datetime']);
			$mdiff=$d1->diff($d2)->m + ($d1->diff($d2)->y*12)+1;
			if ($mdiff<0) $mdiff = 12;
			if ($mdiff < 6) $mdiff = 6;
		}  
		catch(Exception $e) {
			$mdiff = 12;
		}
		$k_month = 1;
		switch ($mdiff)
		{
			case 6:
				$k_month = 0.71;
				break;
			case 7:
				$k_month = 0.76;
				break;				
			case 8:
				$k_month = 0.81;
				break;				
			case 9:
				$k_month = 0.86;
				break;				
			case 10:
				$k_month = 0.91;
				break;				
			case 11:
				$k_month = 0.96;
				break;				
			case 12:
				$k_month = 1;
				break;				
		}



        $sql = 'SELECT a.products_id, b.value as rate, c.value as insurance_price ' .
               'FROM ' . PREFIX . '_products_dgo as a ' .
			   'JOIN ' . PREFIX . '_products as p ON p.id=a.products_id ' .
               'JOIN ' . PREFIX . '_product_insurance_price as b ON a.products_id = b.products_id ' .
               'JOIN ' . PREFIX . '_parameters_insurance_price as c ON b.insurance_price_id = c.id ' .
			   'JOIN insurance_product_agency_assignments as f ON f.products_id = p.id AND f.agencies_id='.intval($data['agencies_id']).' '.
			    
               'WHERE c.id = ' . intval($insurance_price_id).' AND p.publish=1';
        $row = $db->getRow($sql);

        $data['products_id'] = $row['products_id'];
        $data['rate'] = $row['rate'] * $k_month;
        $data['price'] = $row['insurance_price'];

        $data['amount'] = round( $data['price'] * $data['rate'] / 100 , 2);

		//установка размера комиссионного вознаграждения
		$data = array_merge($data, $this->getCommissions($data['products_id'], $data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day'], $data['agencies_id']));
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
		 
		return $data['amount'];
	}

	function getRateInWindow($data) {
        $this->calculate($data['insurance_price_id'], $data);
        echo '{"products_id":"' . $data['products_id'] . '","rate":"' . $data['rate'] . '","amount":"' . $data['amount'] .'"}';
		exit;
	}
}
?>