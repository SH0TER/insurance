<?

require_once 'WSSecurity.class.php';
require_once 'PolicyBlanks.class.php';
require_once 'Accidents/GO.class.php';

class WSMTSBU {

	var $soapClient = null;
	var $url = '';
	var $username = 'einsurance';
	var $password = 'einsurance929';
	var $fields = array();
	var $is_test = null;
	var $items = array();
	
	var $dictionaries_list = array('DMark' => '_mtsbu_brands', 'DModel' => '_mtsbu_models');
	
	var $i_Policies = true;
	var $i_PolicyBlanks = true;
	var $i_Accidents = true;
	var $i_AccidentsActs = true;
	var $i_AccidentsPayments = true;
	
	function WSMTSBU($test=false) {
		if ($test) {
			$this->is_test = true;
			$this->url = 'https://cbd.mtibu.kiev.ua/TestWebService/service.svc?wsdl';
		} else {
			$this->is_test = false;
			$this->url = 'https://cbd.mtibu.kiev.ua/WebService/service.svc?wsdl';
		}_dump($this->url);
		$this->soapClient = new WSSoapClient($this->url, array('trace' => 1, 'exception' => 0));		
		$this->soapClient->__setUsernameToken($this->username, $this->password);				
	}
	
	function setOptions($options) {
		if (is_array($options) && sizeof($options)) {
			$this->i_Policies = $options['Policies_Import'];
			$this->i_PolicyBlanks = $options['PolicyBlanks_Import'];
			$this->i_Accidents = $options['Accidents_Import'];
			$this->i_AccidentsActs = $options['AccidentsActs_Import'];
			$this->i_AccidentsPayments = $options['AccidentsPayments_Import'];
			
			$this->items = $options['items'];
		}
	}

	function import($options=null) {
		$this->setOptions($options);
		
		if ($this->i_Policies) {
			$this->importPolicies();
		}
		
		if ($this->i_PolicyBlanks) {
			$this->importPolicyBlanks();
		}
		
		if ($this->i_Accidents) {
			$this->importAccidents();
		}
		
		if ($this->i_AccidentsActs) {
			$this->importAccidentsActs();
		}
		
		if ($this->i_AccidentsPayments) {
			$this->importAccidentsPayments();
		}
		
		
	}
	
	function importPolicies() {
		$this->setFields(IMPORT_MTSBU_POLICIES);
	
		$conditions = array();
		$conditions[] = '((a.modified > e.mtsbu_date AND a.policy_statuses_id = ' . POLICY_STATUSES_DISSOLVED . ') OR e.mtsbu_date = \'0000-00-00\' OR e.mtsbu_import_sign = 1)';
		//$conditions[] = '(a.modified > e.mtsbu_date OR e.mtsbu_date = \'0000-00-00\')';
		//$conditions[] = 'a.policy_statuses_id NOT IN(' . POLICY_STATUSES_SPOILT . ', ' . POLICY_STATUSES_CANCELLED . ')';
		$conditions[] = 'a.policy_statuses_id NOT IN(' . POLICY_STATUSES_SPOILT . ')';
		//conditions[] = 'b.buh_date <> \'0000-00-00\'';
		$conditions[] = '(a.documents = 1 OR a.policy_statuses_id = ' . POLICY_STATUSES_GENERATED . ')';
		
		$list = PolicyBlanks::exportMTSBU(array('id' => $this->items, 'import' => 1, 'conditions' => $conditions));
//_dump($list);
		foreach($list as $row) {
			$params = array();		
			$params['BatchTypeID'] = IMPORT_MTSBU_POLICIES;
			$prepare_row = $this->prepareValues($row, IMPORT_MTSBU_POLICIES);
			$params['XMLDATA'] = $this->getXML($prepare_row);
//_dump($prepare_row);
			try {
				$this->soapClient->__soapCall('LoadXMLimport', array($params));
				$this->save(IMPORT_MTSBU_POLICIES, PREFIX . '_policy_blanks', 'id', $row['policy_blanks_id'], $this->soapClient->__getLastResponse(), $prepare_row);
			} catch (Exception $e) {
				$this->save(IMPORT_MTSBU_POLICIES, PREFIX . '_policy_blanks', 'id', $row['policy_blanks_id'], $e, $prepare_row, true);
			}
		}
	}
	
	function importPolicyBlanks() {
		$this->setFields(IMPORT_MTSBU_POLICY_BLANKS);
		
		$conditions = array();
		$conditions[] = 'e.mtsbu_date = \'0000-00-00\'';
		$conditions[] = 'a.policy_statuses_id = ' . POLICY_STATUSES_SPOILT;
		//$conditions[] = 'b.buh_date <> \'0000-00-00\'';
		//$conditions[] = 'a.documents = 1';
		
		$list = PolicyBlanks::exportMTSBU(array('id' => $this->items, 'import' => 1, 'conditions' => $conditions));
//_dump($list);
		foreach($list as $row) {
			$params = array();		
			$params['BatchTypeID'] = IMPORT_MTSBU_POLICY_BLANKS;
			$prepare_row = $this->prepareValues($row, array('type' => IMPORT_MTSBU_POLICY_BLANKS));
			$params['XMLDATA'] = $this->getXML($prepare_row);

			try {
				$this->soapClient->__soapCall('LoadXMLimport', array($params));
				$this->save(IMPORT_MTSBU_POLICY_BLANKS, PREFIX . '_policy_blanks', 'id', $row['policy_blanks_id'], $this->soapClient->__getLastResponse(), $prepare_row);
			} catch (Exception $e) {
				$this->save(IMPORT_MTSBU_POLICY_BLANKS, PREFIX . '_policy_blanks', 'id', $row['policy_blanks_id'], $e, $prepare_row, true);
			}
		}
	}
	
	function importAccidents() {
		$this->setFields(IMPORT_MTSBU_ACCIDENTS);
		
		$conditions = array();
		$conditions[] = 'b.owner_types_id = 2';		
		$conditions[] = 'b.mtsbu_date = \'0000-00-00\'';
		
		$list = Accidents_GO::exportAll(array('id' => $this->items, 'import' => 1, 'conditions' => $conditions));
_dump($list);
		foreach($list as $row) {
			$params = array();		
			$params['BatchTypeID'] = IMPORT_MTSBU_ACCIDENTS;
			$prepare_row = $this->prepareValues($row, array('type' => IMPORT_MTSBU_ACCIDENTS));
			$params['XMLDATA'] = $this->getXML($prepare_row);

			try {
				$this->soapClient->__soapCall('LoadXMLimport', array($params));
				$this->save(IMPORT_MTSBU_ACCIDENTS, PREFIX . '_accidents_go', 'accidents_id', $row['accidents_id'], $this->soapClient->__getLastResponse(), $prepare_row);
			} catch (Exception $e) {
				$this->save(IMPORT_MTSBU_ACCIDENTS, PREFIX . '_accidents_go', 'accidents_id', $row['accidents_id'], $e, $prepare_row, true);
			}
		}
	}
	
	function importAccidentsActs() {
		$this->setFields(IMPORT_MTSBU_ACCIDENTS);
		
		$conditions = array();
		$conditions[] = 'b.owner_types_id = 2';
		
		$conditions2 = array();
		$conditions2[] = '(c.payment_types_id IN (' . PAYMENT_TYPES_COMPENSATION. ', ' . PAYMENT_TYPES_PART_PREMIUM . ') OR c.id IS NULL)';
		$conditions2[] = 'b.mtsbu_date = \'0000-00-00\'';
		$conditions2[] = 'a.date <> \'0000-00-00\'';
		
		$list = Accidents_GO::exportClosed(array('id' => $this->items, 'import' => 1, 'conditions' => $conditions, 'conditions2' => $conditions2));
_dump($list);
		foreach($list as $row) {
			$params = array();		
			$params['BatchTypeID'] = IMPORT_MTSBU_ACCIDENTS;
			$prepare_row = $this->prepareValues($row, array('type' => IMPORT_MTSBU_ACCIDENTS, 'closed' => 1));
			$params['XMLDATA'] = $this->getXML($prepare_row);

			try {
				$this->soapClient->__soapCall('LoadXMLimport', array($params));
				$this->save(IMPORT_MTSBU_ACCIDENTS, PREFIX . '_accidents_go_acts', 'accidents_acts_id', $row['acts_id'], $this->soapClient->__getLastResponse(), $prepare_row);
			} catch (Exception $e) {				
				$this->save(IMPORT_MTSBU_ACCIDENTS, PREFIX . '_accidents_go_acts', 'accidents_acts_id', $row['acts_id'], $e, $prepare_row, true);
			}
		}
	}
	
	function importAccidentsPayments() {
		$this->setFields(IMPORT_MTSBU_ACCIDENT_PAYMENTS);
		
		$conditions = array();
		$conditions[] = 'b.owner_types_id = 2';
		
		$conditions2 = array();
		$conditions2[] = 'c.payment_types_id IN (' . PAYMENT_TYPES_COMPENSATION. ', ' . PAYMENT_TYPES_PART_PREMIUM . ')';
		$conditions2[] = 'd.mtsbu_date = \'0000-00-00\'';

		$list = Accidents_GO::exportPayments(array('id' => $this->items, 'import' => 1, 'conditions' => $conditions, 'conditions2' => $conditions2));
_dump($list);
		foreach($list as $row) {
			$params = array();
			$params['BatchTypeID'] = IMPORT_MTSBU_ACCIDENT_PAYMENTS;
			$prepare_row = $this->prepareValues($row, array('type' => IMPORT_MTSBU_ACCIDENT_PAYMENTS));
			$params['XMLDATA'] = $this->getXML($prepare_row);
			
			try {
				$this->soapClient->__soapCall('LoadXMLimport', array($params));
				$this->save(IMPORT_MTSBU_ACCIDENT_PAYMENTS, PREFIX . '_accident_payments', 'id', $row['payments_id'], $this->soapClient->__getLastResponse(), $prepare_row);
			} catch (Exception $e) {
				$this->save(IMPORT_MTSBU_ACCIDENT_PAYMENTS, PREFIX . '_accident_payments', 'id', $row['payments_id'], $e, $prepare_row, true);
			}
		}
	}
	
	function save($type, $storage, $field, $id, $result, $data, $exception=false) {
		global $db;

		if ($exception) {
			$array_id = explode(',', $id);
			$sql = 'INSERT INTO ' . PREFIX . '_mtsbu_import_log ' .
					'SET ' .
						'storage = ' . $db->quote($storage) . ', ' .
						'items_id = ' . intval($array_id[sizeof($array_id)-1] ) . ', ' .
						'data = ' . $db->quote(serialize($data)) . ', ' .
						'is_test = ' . intval($this->is_test) . ', ' .
						'exception = ' . $db->quote(serialize($result)) . ', ' .
						'type = ' . intval($type) . ', ' .
						'created = NOW()';
			$db->query($sql);
			return;
		}
		
		$xml_parser = xml_parser_create();
		xml_parse_into_struct($xml_parser, $result, $vals, $index);
		xml_parser_free($xml_parser);

		foreach($vals as $el) {
			if ($el['tag'] == 'LOADXMLIMPORTRESULT' && $el['type'] == 'complete') {
				//$xml_response = $el['value'];
				$xml_response = iconv('UTF-8', 'CP1251', $el['value']);
				$xml_parser = xml_parser_create();
				xml_parse_into_struct($xml_parser, $xml_response, $vals_response, $index);
				xml_parser_free($xml_parser);

				foreach($vals_response as $el_response) {
					if (in_array($el_response['tag'], array('USEDFORM', 'CONTRACT', 'CASE', 'CLAIMPAID')) AND $el_response['type'] == 'complete') {
						foreach($el_response['attributes'] as $key => $val) {
							$el_response['attributes'][$key] = iconv('UTF-8', 'CP1251', $val);
						}
						$array_id = explode(',', $id);
						$sql = 'INSERT INTO ' . PREFIX . '_mtsbu_import_log ' .
								'SET ' .
									'storage = ' . $db->quote($storage) . ', ' .
									'items_id = ' . intval($array_id[ sizeof($array_id)-1] ) . ', ' .
									'data = ' . $db->quote(serialize($data)) . ', ' .
									'attributes = ' . $db->quote(iconv('CP1251', 'UTF-8', serialize($el_response['attributes']))) . ', ' .
									'type = ' . intval($type) . ', ' .
									'is_test = ' . intval($this->is_test) . ', ' .
									'loaded = ' . (($el_response['attributes']['LOADED'] == 'True') ? 1 : 0) . ', ' .
									'duplicate = ' . (($el_response['attributes']['IS_DUPLICATE'] == 'True') ? 1 : 0) . ', ' .
									'empty_id = ' . $db->quote(iconv('CP1251', 'UTF-8', $el_response['attributes']['EMPTY_ID'])) . ', ' .
									'str_error = ' . $db->quote(iconv('CP1251', 'UTF-8', $el_response['attributes']['STR_ERROR'])) . ', ' .
									'created = NOW()';
						$db->query($sql);
						if (($el_response['attributes']['LOADED'] == 'True' || $el_response['attributes']['IS_DUPLICATE'] == 'True') /*&& $el_response['attributes']['STR_ERROR'] == ''*/) {
							$sql = 'UPDATE ' . $storage . ' SET mtsbu_date = NOW() WHERE ' . $field . ' IN (' . implode(',', $array_id) . ')';
							$sql2 = 'UPDATE ' . $storage . ' SET comment = NULL WHERE ' . $field . ' IN (' . implode(',', $array_id) . ')';
							$sql3 = 'UPDATE ' . $storage . ' SET mtsbu_import_sign = 0 WHERE ' . $field . ' IN (' . implode(',', $array_id) . ')';
							_dump($sql);
							if (!$this->is_test) {
								$db->query($sql);
								$db->query($sql2);
								$db->query($sql3);
							}
						} else {						
							preg_match_all('/\(([^()]*)\)/', $el_response['attributes']['STR_ERROR'], $errors);
							$num_errors = explode(',', preg_replace("![^\d,\,]*!", "", $el_response['attributes']['STR_ERROR']));
							foreach ($num_errors as $key => $val) {
								if (in_array($val, array(338, 342))) {
									unset($errors[1][$key]);
								}
							}
							if (strlen($el_response['attributes']['EMPTY_ID'])) {
								$errors[1][] = $el_response['attributes']['EMPTY_ID'];
							}
							if (strlen($el_response['attributes']['FORMAT_ERROR'])) {
								$errors[1][] = $el_response['attributes']['FORMAT_ERROR'];
							}					
							foreach ($errors[1] as $key => $error) {
								if (!strlen($error)) {
									unset($errors[1][$key]);
								}
							}
							$sql = 'UPDATE ' . $storage . ' SET comment = ' . 
																$db->quote(iconv('CP1251', 'UTF-8', 
																(sizeof($errors[1]) ? implode(', ', $errors[1]) : '')
																//$el_response['attributes']['EMPTY_ID'])) . 
																/*((sizeof($el_response['attributes']['EMPTY_ID']) > 0) ? ', ' . $el_response['attributes']['EMPTY_ID'] : '') .
																((sizeof($el_response['attributes']['FORMAT_ERROR']) > 0) ? ', ' . $el_response['attributes']['FORMAT_ERROR'] : '')*/)) .
									' WHERE ' . $field . ' IN (' . implode(',', $array_id) . ')';
							_dump($sql);
							if (!$this->is_test) {
								$db->query($sql);
							}
						}
					}
				}
			}
		}
	}

	function getXML($row) {
		$xml = '';
		
		if (is_array($row) && sizeof($row)) {
			$xml .= '<Rows>';
			$xml .= '<Row';
			foreach($row as $key => $val) {
				$xml .= ' ' . $key . '="' . $val . '"';
			}
			$xml .= '></Row>';
			$xml .= '</Rows>';
		}
		
		return $xml;
	}
	
	function prepareValues($row, $params=null) {
		global $REGIONS;

		$brands_id = 0;
		$models_id = 0;

		foreach($this->fields as $insurance_field => $mtsbu_field) {
			switch($insurance_field) {
				case 'policy_statuses_title':
                    switch ($row['policy_statuses_id']) {
						//Договори внутрішнього страхування
						case '13'://анульваний
							if ($row['blank_series_parent'] != '' && $row[''] != 'blank_number_parent') {
								$result[ $mtsbu_field ] = 4;
							} else {
								$result[ $mtsbu_field ] = 1;
							}
							break;
                        case '10'://сформовано                        
                        case '16'://пролонгований
                            $result[ $mtsbu_field ] = 1;//1 - Укладений
                            break;
                        case '11'://достроково припинений
                            $result[ $mtsbu_field ] = 2;//2 - Достроково припинений
                            break;
                        case '15'://дублікат
                            $result[ $mtsbu_field ] = 3;//3 - Дублікат
                            break;
                        case '17'://переукладений
                            $result[ $mtsbu_field ] = 4;//4 - Переоформлений
                            break;
						//Використані бланки
						case '14'://зіпсований
							$result[ $mtsbu_field ] = 10;//10 - зіпсований
                    }
                    break;
				case 'terms_title':
                    for ($i=1; $i<13; $i++) {
                        $result['is_active' . $i] = 'False';
                    }
                    $result['is_active' . ($row['terms_id'] - 13) ] = 'True';
                    $result[ $mtsbu_field ] = $row['terms_id'] - 12;
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
						if ($row['k_car_numbers']>=1) {
							$result[ $mtsbu_field ] = 0;
						}
						elseif ($row['k_car_numbers']>=0.95) {
							$result[ $mtsbu_field ] = 1;
						}
						elseif ($row['k_car_numbers']>=0.9) {
							$result[ $mtsbu_field ] = 2;
						}
						elseif ($row['k_car_numbers']>=0.85) {
							$result[ $mtsbu_field ] = 3;
						}
						elseif ($row['k_car_numbers']>=0.8) {
							$result[ $mtsbu_field ] = 4;
						}
						elseif ($row['k_car_numbers']>=0.75) {
							$result[ $mtsbu_field ] = 5;
						}
						elseif ($row['k_car_numbers']>=0.7) {
							$result[ $mtsbu_field ] = 6;
						}
						else $result[ $mtsbu_field ] = 0;

//                    $result[ $mtsbu_field ] = 0;
                    break;
                case 'registration_regions_id':
                    switch ($row['registration_regions_id']) {
                        case '1':
                        case '2':
                        case '3':
                        case '4':
                        case '5':
                            $result[ $mtsbu_field ] = $row['registration_regions_id'];
                            break;
                        case '11':
                            $result[ $mtsbu_field ] = 6;
                            break;
						case '12':
                            $result[ $mtsbu_field ] = 7;
                            break;
                    }
                    break;
                case 'bonus_malus':
                     $result[ $mtsbu_field ] = $row['bonus_malus'];
                    break;
                case 'k5': /*$result[ $mtsbu_field ] = '1,000';break;*/
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
                    $result[ $mtsbu_field ] = str_replace('.', ',', $row[ $insurance_field ]);
                    break;
				case 'dissolved_date':
					if ($row['policy_statuses_id'] == POLICY_STATUSES_DISSOLVED) {
						$result[ $mtsbu_field ] = $row['interrupt_date'];
					}
					break;
                case 'comment':
                    $result[ $mtsbu_field ] = 'Виданий спеціальний знак серії ' . $row['stiker_series'] . ' № ' . $row['stiker_number'];
                    break;
                case 'limit_life':
                    $result[ $mtsbu_field ] = $row['limit_life'];
                    break;
                case 'limit_property':
                    $result[ $mtsbu_field ] = $row['limit_property'];
                    break;
                case 'resident':
				    $result[ $mtsbu_field ] = 'True';
                    break;
                case 'insurer_passport':
                    $result[ $mtsbu_field ] = ($row['insurer_passport_series'] != '' || $row['insurer_passport_number'] != '') ? 'Паспорт' : '';
                    break;
                case 'insurer_dateofbirth':
                    $result[ $mtsbu_field ] = ($row[ $insurance_field ] == '0000-00-00' || $row['person_types_id'] == 2) ? '' : date('d.m.Y H:i:s', strtotime($row[ $insurance_field ]));
                    break;
                case 'insurer_phone':
                    $result[ $mtsbu_field ] = str_replace(array(' ', '-', '(', ')'), array('', '', '', ''), $row[ $insurance_field ]);
                    break;
                case 'insurer_person_types_title':
                    switch ($row['person_types_id']) {
                        case '1':
                            $result[ $mtsbu_field ] = 'Ф';
                            break;
                        case '2':
                            $result[ $mtsbu_field ] = 'Ю';
                            break;
                    }
                    break;
                case 'insurer_identification_code':
                    switch ($row['person_types_id']) {
                        case '1':
                            $result[ $mtsbu_field ] = $row['insurer_identification_code'];
                            break;
                        case '2':
                            $result[ $mtsbu_field ] = $row['insurer_edrpou'];
                            break;
                    }
                    break;
                case 'insurer_address':
                    $result[ $mtsbu_field ] = Regions::getTitle($row['insurer_regions_id']);

                    if ($values['insurer_area']) {
                        $result[ $mtsbu_field ] .= ', ' . $row['insurer_area'].' р-н';
                    }

                    if (!in_array($row['insurer_regions_id'], $REGIONS)) {
                        $result[ $mtsbu_field ] .= ', ' . $row['insurer_city'];
                    }

                    $result[ $mtsbu_field ] .=  ', ' . StreetTypes::getTitle($row['insurer_street_types_id']) . ' ' . $row['insurer_street'] . ', буд. ' . $row['insurer_house'];

                    if ($values['insurer_flat']) {
                        switch ($row['person_types_id']) {
                            case 1:
                                $result[ $mtsbu_field ] .= ', кв. ' . $row['insurer_flat'];
                                break;
                            case 2:
                                $result[ $mtsbu_field ] .= ', оф. ' . $row['insurer_flat'];
                                break;
                        }
                    }
                    break;
                case 'car_types_title':
                    switch ($row['car_types_id']) {
                        case '1'://Легкові автомобілі
                            if ($row['engine_size'] <= 1600) {//1	A1	легковий автомобіль до 1600 кубічних сантиметрів;
                                $result[ $mtsbu_field ] = 1;
                            } elseif ($row['engine_size'] <= 2000) {//2	A2	легковий автомобіль від 1601 до 2000 куб. см.
                                $result[ $mtsbu_field ] = 2;
                            } elseif ($row['engine_size'] <= 3000) {//3	A3	легковий автомобіль від 2001 до 3000 куб. см.
                                $result[ $mtsbu_field ] = 3;
                            } else {//4	A4	легковий автомобіль більше 3000 куб. см.
                                $result[ $mtsbu_field ] = 4;
                            }
                            break;
                        case '2'://Причепи до легкових автомобілів
                            $result[ $mtsbu_field ] = 11;
                            break;
                        case '3'://Автобуси
                            if ($row['passengers'] <= 20) {//9	E1	автобуси з кількістю місць до 20 чол. (включно)
                                $result[ $mtsbu_field ] = 9;
                            } else {//10	E2	автобуси з кількістю місць більше 20 чол.
                                $result[ $mtsbu_field ] = 10;
                            }
                            break;
                        case '4'://Вантажні автомобілі
                            if ($row['car_weight'] <= 2000) {//7	C1	вант. автомобілі вантажопідйомністю до 2т (включ)
                                $result[ $mtsbu_field ] = 7;
                            } else {//8	C2	вантажні автомобілі вантажопідйомністю понад 2 т.
                                $result[ $mtsbu_field ] = 8;
                            }
                            break;
                        case '5'://Причепи до вантажних автомобілів
                            $result[ $mtsbu_field ] = 12;
                            break;
                        case '6':
                        case '7':
                            if ($row['engine_size'] <= 300) {//5	B1	мотоцикли та моторолери до 300 куб. см.
                                $result[ $mtsbu_field ] = 5;
                            } else {//6	B2	мотоцикли та моторолери більше 300 куб. см.
                                $result[ $mtsbu_field ] = 6;
                            }
                            break;
                    }
                    break;
                case 'sign':
					$result[ $mtsbu_field ] = str_replace(' ', '', $row[ $insurance_field ]);
					if ($result[ $mtsbu_field ] == '') {
						$result[ $mtsbu_field ] = 'бн';
					}
                    break;
                case 'shassi':
                    			$result[ $mtsbu_field ] = str_replace(' ', '', $row[ $insurance_field ]);
					if ($result[ $mtsbu_field ] == '') {
						$result[ $mtsbu_field ] = 'бн';
					}
					/*$result[ $mtsbu_field ] = preg_replace("/[^a-z0-9]/i", "", $result[ $mtsbu_field ]);
					while(strlen($result[ $mtsbu_field ]) < 17) {
						$result[ $mtsbu_field ] .= '1';
					}*/
                    break;
                case 'taxi':
                    switch ($row[ $insurance_field ]) {
                        case '0':
                        case '2':
                            $result[ $mtsbu_field ] = '1';
                            break;
                        case '1':
                            $result[ $mtsbu_field ] = '2';
                            break;
                    }
                    break;
                case 'otk':
                    $result[ $mtsbu_field ] = ($row['otk'] == '1') ? 'True' : 'False';
                    break;
                case 'otkdate':
                    $result[ $mtsbu_field ] = ($row['otk'] == '1') ? date('d.m.Y H:i:s', strtotime($row[ $insurance_field ])) : '';
                    break;
                case 'stage3':
                    if ($row['person_types_id'] == '1') {
                        switch ($row[ $insurance_field ]) {
                            case '0':
                                $result[ $mtsbu_field ] = '2';
                                break;
                            case '1':
                                $result[ $mtsbu_field ] = '1';
                                break;
                        }
                    } else {
                        $result[ $mtsbu_field ] = '';
                    }
                    break;
                case 'old':
                    $result[ $mtsbu_field ] = 'False';
                    break;
                case 'auto':
					$result[ $mtsbu_field ] = $row['insurer_brand'] . ' ' . $row['insurer_model'];
					break;
                case 'marka':
                    $result[ $mtsbu_field ] = $row['owner_brand'] . ' ' . $row['owner_model'];
                    break;
                case 'city_name':
                    $result[ $mtsbu_field ] = $row['registration_cities_title'];
                    break;
				case 'begin_datetime':
				case 'end_datetime':
				case 'policies_date':
				case 'interrupt_date':
					$result[ $mtsbu_field ] = date('d.m.Y H:i:s', strtotime($row[ $insurance_field ]));
					break;
				case 'brands_id':
					$brands_id = $this->getCarBrandsId($row[ 'brand' ]);
					if (intval($brands_id)) {
						$result[ $mtsbu_field ] = $brands_id;
					} else {
						$result[ 'mark_txt' ] = $row[ 'brand' ];
					}
					break;
				case 'owner_brand':
				case 'insurer_brand':
					$brands_id = $this->getCarBrandsId($row[ $insurance_field ]);
					if (intval($brands_id)) {
						$result[ $mtsbu_field ] = $brands_id;
					}
					break;
				case 'models_id':
					$models_id = $this->getCarModelsId($row[ 'model' ], $brands_id);
					if (intval($models_id)) {
						$result[ $mtsbu_field ] = $models_id;
					} else {						
						$result[ 'model_txt' ] = $row[ 'model' ];
					}
					break;
				case 'owner_model':
				case 'insurer_model':
					$models_id = $this->getCarModelsId($row[ $insurance_field ], $brands_id);
					if (intval($models_id)) {
						$result[ $mtsbu_field ] = $models_id;
					}
					break;
				case 'mvs':
                    $result[ $mtsbu_field ] = ($row[ $insurance_field ] == '2') ? 'True' : 'False';
                    break;
				case 'owner_resident':
                    $result[ $mtsbu_field ] = ($row[ $insurance_field ] == 1) ? 'True' : 'False';
                    break;
				case 'insurance':
                    switch ( $row[ $insurance_field ] ) {
                       case '3':
                            $result[ $mtsbu_field ] = 'True';
                            break;
                       default:
                            $result[ $mtsbu_field ] = 'False';
                            break;
                    }
                    break;
                case 'regres':
                case 'fraud':
                    $result[ $mtsbu_field ] = ($row[ $insurance_field ] == 1) ? 'True' : 'False';
                    break;
				case 'amount_rough':
					if($params['closed'] == 1 && $row['insurance'] == 1) {
						$result[ $mtsbu_field ] =  str_replace('.', ',', $row['acts_amount']);
					} else {
						$result[ $mtsbu_field ] =  str_replace('.', ',', $row['amount_rough']);
					}
                    break;
				case 'driver':
                    $result[ $mtsbu_field ] = $row['insurer_driver_lastname'] . ' ' . $row['insurer_driver_firstname'] . ' ' . $row['insurer_driver_patronymicname'];
                    break;
				case 'driver_years_old':
                    $result[ $mtsbu_field ] = intval( $row['insurer_years_old'] );
                    break;
				case 'owner_person_types_id':
                    switch ($row['owner_person_types_id']) {
						case '2':
                            $result[ $mtsbu_field ] = 'Ю';
                            break;
                        default:
                            $result[ $mtsbu_field ] = 'Ф';
                            break;                        
                    }
                    break;
				case 'owner':
                    switch ($row['owner_person_types_id']) {
						case '2':
                            $result[ $mtsbu_field ] = str_replace('"', '\'', $row['owner_lastname']);
                            break;
                        default:
                            $result[ $mtsbu_field ] = $row['owner_lastname'] . ' ' . $row['owner_firstname'] . ' ' . $row['owner_patronymicname'];
                            break;                        
                    }
                    break;
				case 'owner_address':
                    $result[ $mtsbu_field ] = Regions::getTitle($row['owner_regions_id']);

                    if ($row['owner_area']) {
                        $result[ $mtsbu_field ] .= ', ' . $row['owner_area'].' р-н';
                    }

                    if (!in_array($row['owner_regions_id'], $REGIONS)) {
                        $result[ $mtsbu_field ] .= ', ' . $row['owner_city'];
                    }

                    $result[ $mtsbu_field ] .=  ', ' . StreetTypes::getTitle($row['owner_street_types_id']) . ' ' . $row['owner_street'] . ', буд. ' . $row['owner_house'];

                    if ($row['owner_flat']) {
                        switch ($row['owner_person_types_id']) {
                            case 1:
                                $result[ $mtsbu_field ] .= ', кв. ' . $row['owner_flat'];
                                break;
                            case 2:
                                $result[ $mtsbu_field ] .= ', оф. ' . $row['owner_flat'];
                                break;
                        }
                    }
                    break;
				case 'acts_amount':
                    $result[ $mtsbu_field ] =  str_replace('.', ',', $row['acts_amount']);
                    break;
				case 'old_data':
                case 'deleted':
                    $result[ $mtsbu_field ] = 'False';
                    break;
				default:
					if ($insurance_field == 'model' && $row['models_id'] == 2685) {
						$result[ 'model_txt' ] = 'C 250 CDI';
					} else {
						$result[ $mtsbu_field ] = $row[ $insurance_field ];
					}					
			}
		}

		return $result;
	}
	
	function setFields($type) {
		include 'mtsbu_associate.inc.php';

		switch ($type) {
			case IMPORT_MTSBU_POLICIES:
				$this->fields = $associates_policies;
				break;
			case IMPORT_MTSBU_ACCIDENTS:
				$this->fields = $associates_accidents;
				break;
			case IMPORT_MTSBU_POLICY_BLANKS:
				$this->fields = $associates_policy_blanks;
				break;
			case IMPORT_MTSBU_ACCIDENT_PAYMENTS:
				$this->fields = $associates_accident_payments;
				break;
		}
	}
	
	function loadDictionaries() {
		global $db;
		
		$params = array();
		foreach ($this->dictionaries_list as $dictionary => $table) {
			$params['ListofDicionaties'] = array($dictionary);
			$this->soapClient->__soapCall('GetdictionaryXML', array($params));
			
			$sql = 'DELETE FROM ' . PREFIX . $table;
			$db->query($sql);

			$xml_parser = xml_parser_create();
			xml_parse_into_struct($xml_parser, $this->soapClient->__getLastResponse(), $root_tags, $index);
			xml_parser_free($xml_parser);
			foreach($root_tags as $root_tag) {
				if ($root_tag['tag'] == 'A:STRING' && $root_tag['type'] == 'complete') {
					$xml_parser = xml_parser_create();
					xml_parse_into_struct($xml_parser, $root_tag['value'], $rows, $index);
					xml_parser_free($xml_parser);
					foreach($rows as $row) {
						if ($row['tag'] == 'ROW' && $row['type'] == 'complete') {
							$sql = 'INSERT INTO ' . PREFIX . $table . ' ' .
									'SET ' .
									(($dictionary == 'DModel') ? ('models_id = ' . intval($row['attributes']['DMODELID']) . ', ') : '') .
									'brands_id = ' . intval($row['attributes']['DMARKID']) . ', ' .
									'name = ' . $db->quote($row['attributes']['NAME']) . ', ' .
									'name_en = ' . $db->quote($row['attributes']['NAMEEN']) . ', ' .
									'name_ru = ' . $db->quote($row['attributes']['NAMERU']) . ', ' .
									'name_ua = ' . $db->quote($row['attributes']['NAMEUA']) . ', ' .
									'is_active = ' . (($row['attributes']['ISACTIVE'] == 'True') ? '1' : '0');
							$db->query($sql);
						}
					}
				}
			}
		}
	}
	
	function getCarBrandsId($brand) {
		global $db;
		
		$sql = 'SELECT brands_id ' . 
				'FROM ' . PREFIX . '_mtsbu_brands ' .
				'WHERE (name = ' . $db->quote($brand) . ' OR name_en = ' . $db->quote($brand) . ' OR name_ru = ' . $db->quote($brand) . ' OR name_ua = ' . $db->quote($brand) . ') AND is_active = 1';
		return $db->getOne($sql);
	}
	
	function getCarModelsId($model, $brands_id) {
		global $db;
		
		$sql = 'SELECT models_id ' . 
				'FROM ' . PREFIX . '_mtsbu_models ' .
				'WHERE (name = ' . $db->quote($model) . ' OR name_en = ' . $db->quote($model) . ' OR name_ru = ' . $db->quote($model) . ' OR name_ua = ' . $db->quote($model) . ') AND is_active = 1 AND brands_id = ' . intval($brands_id);
		return $db->getOne($sql);
	}

}

?>