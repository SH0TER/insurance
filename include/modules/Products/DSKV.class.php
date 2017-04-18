<?
/*
 * Title: DSKV class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class Products_DSKV extends Products {

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
							'name'				=> 'rate_other',
							'description'		=> 'Страхування відповідальності, %',
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
							'table'				=> 'products_dskv'),
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

	function Products_DSKV($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Страхові продукти';
		$this->messages['single'] = 'Страховий продукт';
	}

	function showForm($data, $action, $actionType=null, $template=null) {
		return parent::showForm($data, $action, $actionType, 'dskv.php');
	}

	function insert($data, $redirect=true) {
		global $Log;

		$data['products_id'] = parent::insert($data, false);

		if (!$Log->isPresent()) {

			$params['title']		= $this->messages['single'];
			$params['id']			= $data['products_id'];
			$params['storage']		= $this->tables[0];

			ParametersPropertySections::setValues($data);
            ParametersRisks::setValues($data);

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

			ParametersPropertySections::setValues($data);
            ParametersRisks::setValues($data);

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

		$sql =	'DELETE FROM ' . PREFIX . '_products_dskv ' .
				'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);
	}

	function calculate(&$data) {
		global $db;

        $data['rate']           = 0;
        $data['amount']			= 0;
        $data['rate_dskv']      = 0;
        $data['amount_dskv']    = 0;
        $data['rate_other']     = 0;
        $data['amount_other']   = 0;

        if (is_array($data['property_sections']['id']) && is_array($data['risks'])) {
            $conditions[] = 'id = ' . intval($data['products_id']);
            $conditions[] = 'property_sections_id IN(' . implode(', ', $data['property_sections']['id']) . ')';

            $sql =  'SELECT b.*, SUM(value) as price ' .
                    'FROM ' . $this->tables[0] . ' as a ' .
                    'JOIN ' . PREFIX . '_products_dskv as b ON a.id = b.products_id ' .
                    'JOIN ' . PREFIX . '_product_property_sections as c ON a.id = c.products_id ' .
                    'WHERE ' . implode(' AND ', $conditions) . ' ' .
                    'GROUP BY b.products_id';
            $row =  $db->getRow($sql);

            $data['rate_dskv'] = ParametersRisks::getRate($data['products_id'], $data['risks']);

            $data['price']			= $data['priceDSKV'] = $row['price'];

            $data['rate_dskv']		= $data['rate_dskv'] * (100 - $data['discount'] - $data['cart_discount']) / 100;
            $data['amount_dskv']	= round($data['price'] * $data['rate_dskv'] / 100, 2);

			if ($data['price_other']>30000) {
				$row['rate_other'] = 0.5;
			}

            $data['rate_other']     = $row['rate_other'] * (100 - $data['discount'] - $data['cart_discount']) / 100;
            $data['amount_other']   = round($data['price_other'] * $row['rate_other'] / 100, 2);

            $data['amount'] = $data['amount_dskv'] + $data['amount_other'];
			$data['price']  += $data['price_other'];
			$data['rate'] = round($data['amount'] / $data['price'] * 100, 2);
        }

		//установка размера комиссионного вознаграждения
		$commissions = Products::getCommissions($data['products_id'], $data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day'], $data['agencies_id']);
		


		$data = array_merge($data, $commissions);

        return $data;
    }

    function getRateInWindow($data) {
        $this->calculate($data);

		echo '{"price":"' . $data['price'] . '","rate":"' . $data['rate'] . '","priceDSKV":"' . $data['priceDSKV'] . '","rate_dskv":"' . $data['rate_dskv'] . '","price_other":"' . $data['price_other'] . '","rate_other":"' . $data['rate_other'] . '"}';
        exit;
    }
}
?>