<?
/*
 * Title: GO class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */


class Products_GO extends Products {

    var $object = 'Products';

    var $formDescription =
            array(
                'fields'     =>
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
                            'table'             => 'products'),
                        array(
                            'name'              => 'product_types_id',
                            'description'       => 'Тип',
                            'type'              => fldHidden,
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
                            'table'             => 'products'),
                        array(
                            'name'              => 'code',
                            'description'       => 'Код',
                            'type'              => fldUnique,
                            'maxlength'         => 20,
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
                            'width'             => 100,
                            'table'             => 'products'),
                        array(
                            'name'              => 'title',
                            'description'       => 'Назва',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'products'),
                        array(
                            'name'              => 'deductible',
                            'description'       => 'Франшиза, грн.',
                            'type'              => fldRadio,
                            'list'              => array('0.00' => '0.00','510.00' => '510.00'),
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
                            'orderPosition'     => 3,
                            'table'             => 'products_go'),
                        array(
                            'name'              => 'types_id',
                            'description'       => 'Договір',
                            'type'              => fldRadio,
                            'list'              => array(1 => 'Тип 1'),
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 4,
                            'table'             => 'products_go'),
                        array(
                            'name'              => 'base_rate',
                            'description'       => 'Базовий тариф, грн.',
                            'type'              => fldMoney,
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
                            'table'             => 'products_go'),
                        array(
                            'name'              => 'k61',
                            'description'       => 'K6, були регресні позови',
                            'type'              => fldText,
                            'maxlength'         => 5,
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
                            'table'             => 'products_go'),
                        array(
                            'name'              => 'k62',
                            'description'       => 'K6, не було регресних позовів',
                            'type'              => fldText,
                            'maxlength'         => 5,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'products_go'),
                        array(
                            'name'              => 'description',
                            'description'       => 'Опис',
                            'type'              => fldNote,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true,
                                    'change'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'products'),
                        array(
                            'name'              => 'publish',
                            'description'       => 'Показувати',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true,
                                    'change'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 7,
                            'width'             => 100,
                            'table'             => 'products'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'products'),
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
                            'orderPosition'     => 8,
                            'width'             => 100,
                            'table'             => 'products')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 1,
                        'defaultOrderDirection' => 'asc',
                        'titleField'            => 'title'
                    )
            );

    function Products_GO($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Страхові продукти';
        $this->messages['single'] = 'Страховий продукт';
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        return parent::showForm($data, $action, $actionType, 'go.php');
    }

    function checkFields($data, $action) {
        global $Log;

        parent::checkFields($data, $action);

        if (is_array($data['engine_sizes'])) {
            foreach ($data['engine_sizes'] as $id => $value) {

                $params = array(translate($data['engine_sizesTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['passengers'])) {
            foreach ($data['passengers'] as $id => $value) {

                $params = array(translate($data['passengersTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['car_weights'])) {
            foreach ($data['car_weights'] as $id => $value) {

                $params = array(translate($data['car_weightsTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['regions'])) {
            foreach ($data['regions'] as $id => $value) {

                $params = array(translate($data['regionsTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['scopes'])) {
            foreach ($data['scopes'] as $id => $value) {

                $params = array(translate($data['scopesTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['driver_standings'])) {
            foreach ($data['driver_standings'] as $id => $value) {

                $params = array(translate($data['driver_standingsTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['car_numbers'])) {
            foreach ($data['car_numbers'] as $id => $value) {

                $params = array(translate($data['car_numbersTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['bonus_malus'])) {
            foreach ($data['bonus_malus'] as $id => $value) {

                $params = array(translate($data['bonus_malusTitle'][ $id ]), $languageDescription);

                if ($value == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($value)) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }
    }

    function insert($data, $redirect=true) {
        global $Log;

        $data['products_id'] = parent::insert($data, false);

        if (!$Log->isPresent()) {

            $params['title']    = $this->messages['single'];
            $params['id']       = $data['products_id'];
            $params['storage']  = $this->tables[0];

            ParametersEngineSizes::setValues($data);
            ParametersPassengers::setValues($data);
            ParametersCarWeights::setValues($data);
            ParametersRegions::setValues($data);
            ParametersScopes::setValues($data);
            ParametersDriverStandings::setValues($data);
            ParametersCarNumbers::setValues($data);
            ParametersBonusMalus::setValues($data);

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
            $params['title']    = $this->messages['single'];
            $params['id']       = $data['products_id'];
            $params['storage']  = $this->tables[0];

            ParametersEngineSizes::setValues($data);
            ParametersPassengers::setValues($data);
            ParametersCarWeights::setValues($data);
            ParametersRegions::setValues($data);
            ParametersScopes::setValues($data);
            ParametersDriverStandings::setValues($data);
            ParametersCarNumbers::setValues($data);
            ParametersBonusMalus::setValues($data);

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

        $sql =  'SELECT id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE products_id IN(' . implode(' , ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>Поліси</b>.');
            return false;
        }

        $sql =  'DELETE FROM ' . PREFIX . '_product_document_assignments ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_engine_sizes ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_passengers ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_car_weights ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_regions ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_scopes ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_driver_standings ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_car_numbers ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_product_bonus_malus ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_agency_commissions ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        $sql =  'DELETE FROM ' . PREFIX . '_products_go ' .
                'WHERE products_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);
    }


    function calculate($person_types_id, $policies_general_id, $deductible, $car_types_id, $engine_size, $car_weight, $passengers, $registration_cities_id, $scopes_id, $driver_standings_id, $terms_id, $regres, $privileges, $bonus_malus_id, &$data) {
        global $db, $Authorization;

        switch ($car_types_id) {
            case 1://машины
            case 2://прицепы
            case 5:
            case 6:
            case 7:
                $data['engine_sizes_id'] = ParametersEngineSizes::getIdBySize(PRODUCT_TYPES_GO, $engine_size, $car_types_id);
                $conditions[] = '(c.engine_sizes_id = ' . intval($data['engine_sizes_id']) . ' AND c.value > 0)';
                $table = PREFIX . '_product_engine_sizes';
                break;
            case 3://автобусы
                $data['passengers_id'] = ParametersPassengers::getIdByNumber($passengers);
                $conditions[] = '(c.passengers_id = ' . intval($data['passengers_id']) . ' AND c.value > 0)';
                $table = PREFIX . '_product_passengers';
                break;
            case 4://грузовики
                $data['car_weights_id'] = ParametersCarWeights::getIdByWeight($car_weight);
                $conditions[] = '(c.car_weights_id = ' . intval($data['car_weights_id']) . ' AND c.value > 0)';
                $table = PREFIX . '_product_car_weights';
                break;
        }

        //получаем условия по генеральному договору
        if (intval($data['policies_general_id'])) {
            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_policies AS a ' .
                    'JOIN ' . PREFIX . '_policies_go_general AS b ON a.id = b.policies_id ' .
                    'WHERE id = ' . intval($policies_general_id);
            $policies_general = $db->getRow($sql);

            //накладываем ограничение на продукты
            $conditions[] = 'a.id = ' . intval($policies_general['products_id']);
			$data['products_id'] = $policies_general['products_id'];

            $car_quantity = $policies_general['quantity'];
        } else {
            $car_quantity = 1;
			$conditions[] = 'a.id <> 23 ';
        }

        $car_numbers_id = ParametersCarNumbers::getIdByNumber(PRODUCT_TYPES_GO, $car_quantity);
		
		if ($policies_general_id>0 && $bonus_malus_id>7) $bonus_malus_id = 99;


        $conditions[] = intval($data['products_id'])>0 ? 'a.id='.intval($data['products_id']) : 'a.publish = 1';
        $conditions[] = 'b.deductible = ' . $db->quote($deductible);
        $conditions[] = 'e.id = ' . intval($registration_cities_id) . ' AND d.value > 0';
        $conditions[] = 'f.scopes_id = ' . intval($scopes_id) . ' AND f.value > 0';
        $conditions[] = 'k.driver_standings_id = ' . intval($driver_standings_id) . ' AND k.value > 0';
        $conditions[] = 'l.id = ' . intval($terms_id);// . ' AND l.value > 0 AND l.product_types_id = ' . PRODUCT_TYPES_GO . ' AND l.id IN(13, 25)';
        $conditions[] = 'm.bonus_malus_id = ' . intval($bonus_malus_id) . ' AND m.value > 0';
        $conditions[] = 'n.car_numbers_id = ' . intval($car_numbers_id) . ' AND n.value > 0';

        $sql =  'SELECT b.products_id, b.base_rate, c.value AS k1, d.value AS k2, f.value AS k3, k.value AS k4, l.value AS k5, '  . (( $regres === '1' ) ? 'k61' : 'k62') . ' AS k6, 1 AS k7, m.value AS bonus_malus, n.value AS k_car_numbers ' .
                'FROM ' . PREFIX . '_products AS a ' .
                'JOIN ' . PREFIX . '_products_go AS b ON a.id = b.products_id ' .
                'JOIN ' . $table . ' AS c ON a.id = c.products_id ' .
                'JOIN ' . PREFIX . '_product_regions AS d ON a.id = d.products_id ' .
                'JOIN ' . PREFIX . '_cities AS e ON d.regions_id = e.regions_go_id ' .
                'JOIN ' . PREFIX . '_product_scopes AS f ON a.id = f.products_id ' .
                'JOIN ' . PREFIX . '_product_driver_standings AS k ON a.id = k.products_id ' .
                'JOIN ' . PREFIX . '_product_bonus_malus AS m ON a.id = m.products_id ' .
                'JOIN ' . PREFIX . '_product_car_numbers AS n ON a.id = n.products_id, ' .
                PREFIX . '_parameters_terms AS l '.
                'WHERE ' . implode(' AND ', $conditions);
        $row = $db->getRow($sql);

        $data['products_id'] = $row['products_id'];

        $data['k1'] = $row['k1'];
        $data['k2'] = $row['k2'];
        $data['k3'] = $row['k3'];
        $data['k4'] = $row['k4'];
        $data['k5'] = $row['k5'];
        $data['k6'] = $row['k6'];
        $data['k7'] = $row['k7'];
        $data['bonus_malus'] = $row['bonus_malus'];

        //Установка коэф. кол. авто = 1 для гендоговора не по клиенту Берлин Хеми 
        if (intval($data['policies_general_id']) > 0 && intval($data['clients_id']) !== 97084 && intval($data['clients_id']) !== 68918){
			$row['k_car_numbers'] = 1;
		}
		$data['k_car_numbers'] = $row['k_car_numbers'];

        $data['amount'] = $row['base_rate'] * $row['k1'] * $row['k2'] * $row['k3'] * $row['k4'] * $row['k5'] * $row['k6'] * $data['k7'] * $row['bonus_malus'] * $row['k_car_numbers'];	
		
//_dump($row['base_rate'].' *'. $row['k1'] .' *'. $row['k2'] .' *'. $row['k3'] .' *'. $row['k4'] .' *'. $row['k5'] .' *'. $row['k6'] .' *'. $data['k7'] .' *'. $row['bonus_malus'] .' *'. $row['k_car_numbers']);

        if ($privileges && $engine_size < 2501 && intval($scopes_id)!=4) {
            $data['amount'] = $data['amount'] * 0.5;
        }

	if ($privileges && intval($terms_id) == 13) {
		$data['amount'] = 0.00;
	}

        $data['amount'] = $data['amount_go'] = round($data['amount'], 2);

        //округляем до 1 грн. в большую сторону
		if ($data['amount'] > intval($data['amount'])) {
			$data['amount'] = $data['amount_go'] = intval($data['amount']) + 1;
		}

		$data = array_merge($data, $this->getCommissions($data['products_id'], $data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day'], $data['agencies_id'],doubleval($data['discount'])));
		//тут идет модификация комиссий
		if ($data['manager_id']) //выбрали менеджера що привiв клиента
		{
            $sqlTemper = 'SELECT allcomission as allfullcomission 
            FROM insurance_agents WHERE allcomission = 1 
            and accounts_id = ' . intval($data['manager_id']);

            $rowTemper = $db->getRow($sqlTemper);
            //echo 'id:' . $data[id] . '|agencie:'.$data['agencies_id'].'|im:'.$data['individual_motivation'];
            if($data['agencies_id']!=1469 && $data['individual_motivation'] == 0 && !$rowTemper['allfullcomission'])
                $data['commission_agent_percent'] = $data['commission_agent_percent']/2;
		}
		else {
			$data['commission_manager_percent'] = 0;
		}
		
		if (!$data['seller_agents_id']) //не выбрали продающего в агенции
		{
			$data['commission_seller_agents_percent'] = 0;
		}
		 

//        return ''.$row['base_rate'].' *'. $row['k1'] .' *'. $row['k2'] .' *'. $row['k3'] .' *'. $row['k4'] .' *'. $row['k5'] .' *'. $row['k6'] .' *'. $data['k7'] .' *'. $row['bonus_malus'] .' *'. $row['k_car_numbers'];// $data['amount'];
		return $data['amount'];
    }

	
    function getRateInWindow($data) {
        echo '{"amount":"' . $this->calculate($data['person_types_id'], $data['policies_general_id'], $data['deductible'], $data['car_types_id'], $data['engine_size'], $data['car_weight'], $data['passengers'], $data['registration_cities_id'], $data['scopes_id'], $data['driver_standings_id'], $data['terms_id'], $data['regres'], $data['privileges'], $data['bonus_malus_id'], $data) . '"}';
        exit;
    }
}
?>