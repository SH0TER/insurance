<?
/*
 * Title: PolicyBlankActItems class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class PolicyBlankActItems extends Form {

    function getEndDatetime($data) {
        $result = '';

        if (!$data['date_year'] || !$data['date_month'] || !$data['date_day']) {
            $data['date_year']  = date('Y');
            $data['date_month'] = date('m');
            $data['date_day']   = date('d');
        }

        if (intval($data['date_day']) < 6) {
            $result = date('Ymd', mktime(0, 0, 0, $data['date_month'], 0, $data['date_year']));
        } elseif (intval($data['date_day']) < 16) {
            $result = date('Ymd', mktime(0, 0, 0, $data['date_month'], 10, $data['date_year']));
        } elseif (intval($data['date_day']) < 26) {
            $result = date('Ymd', mktime(0, 0, 0, $data['date_month'], 20, $data['date_year']));
        } else {
            $result = date('Ymd', mktime(0, 0, 0, $data['date_month']+1, 0, $data['date_year']));
        }

        return $result;
    }

    function getPolicyBlanksIdByActsId($acts_id) {
        global $db;

        $sql =  'SELECT policy_blanks_id ' .
                'FROM ' . PREFIX . '_policy_blank_act_items ' .
                'WHERE acts_id = ' . intval($acts_id);
        return $db->getCol($sql);
    }

    function getList($data, $actionType) {
        global $db, $Authorization;

        $data['agencies_id'] = ($Authorization->data['agencies_id']) ? $Authorization->data['agencies_id'] : 1;

		switch ($data['types_id']) {
			case '1':
				$conditions[] = 'acts_id = ' . intval($data['id']);

				$result = '<tr><td>&nbsp;</td><td><b>Бланки:</b></td></tr>';

				$result .= '<tr><td>&nbsp;</td><td><table id="items" cellspacing="0" cellpadding="5" style="border: solid 1px #000000;;">';
				$result .= '<tr class="columns"><td>Серія</td><td>Номер полісу з</td><td>Номер полісу по</td><td>Кількість, шт.</td><td style="padding-left: 8px;"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати" onclick="addPolicyBlanks(this)" /></td></tr>';

				if (is_array($data['policy_blanks'])) {
					foreach ($data['policy_blanks'] as $i=>$row) {

						if (is_null($row['id'])) $row['id'] = $i;

						$result .=
							'<tr>' .
								'<td><input type="text" name="policy_blanks[' . $row['id'] . '][series]" value="' . $row['series'] . '" maxlength="5" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /> </td>' .
								'<td><input type="text" name="policy_blanks[' . $row['id'] . '][number_from]" value="' . $row['number_from'] . '" maxlength="7" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /> </td>' .
								'<td><input type="text" name="policy_blanks[' . $row['id'] . '][number_to]" value="' . $row['number_to'] . '" maxlength="7" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /> </td>' .
								'<td><input type="text" name="policy_blanks[' . $row['id'] . '][count]" value="' . $row['count'] . '" maxlength="7" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /> </td>' .
								'<td><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" onclick="deletePolicyBlanks(this)" /></td>' .
							 '</tr>';
					}		 
				} 

				$result .= '</table>';
				break;
			default:
				$result = '<tr><td>&nbsp;</td><td><b>Бланки:</b></td></tr>';

				$result .= '<tr><td>&nbsp;</td><td><table id="items" cellspacing="0" cellpadding="5" style="border: solid 1px #000000;">';
				$result .= '<tr class="columns">
								<td><input type="checkbox" name="sample" onclick="selectAll()" /></td>
								<td>Поліс</td>
								<td>Авто</td>
								<td>Страхувальник</td>
								<td>Початок</td>
								<td>Статус полісу</td>
								<td>Оплата</td>
								<td>Статус бланку</td>
								<td>Агенція</td>
								<td>Агент</td>
							</tr>';

                //выбираем все не отчитанные бланки
                $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
                $conditions[] = 'a.agencies_id = ' . intval($data['agencies_id']);

                //если корректируем акт, то показываем все бланки включенные в акт + еще не включенные
                if ($actionType == 'update') {
                    $conditions[] = '(' .
                                        'a.id IN(SELECT policy_blanks_id FROM ' . PREFIX . '_policy_blank_act_items WHERE acts_id = ' . intval($data['id']) . ') OR ' .
                                        'a.id NOT IN(SELECT policy_blanks_id FROM ' . PREFIX . '_policy_blank_act_items AS a1 JOIN ' . PREFIX . '_policy_blank_acts AS b1 ON a1.acts_id = b1.id WHERE b1.agencies_id = ' . intval($data['agencies_id']) . ' AND b1.types_id = ' . $data['types_id'] . ')' .
                                    ')';

                } else {
                    $conditions[] = (intval($data['id']))
                        ? 'a.id IN(SELECT policy_blanks_id FROM ' . PREFIX . '_policy_blank_act_items WHERE acts_id = ' . intval($data['id']) . ')'
                        : 'a.id NOT IN(SELECT policy_blanks_id FROM ' . PREFIX . '_policy_blank_act_items AS a1 JOIN ' . PREFIX . '_policy_blank_acts AS b1 ON a1.acts_id = b1.id WHERE b1.agencies_id = ' . intval($data['agencies_id']) . ' AND b1.types_id = ' . $data['types_id'] . ')';
                }

                switch ($data['types_id']) {
                    case '2':
//                        $conditions[] = 'policies_id > 0';
                        $conditions[] = 'a.product_types_id = 4';
                        break;
                    case '3':
                        $conditions[] = 'ISNULL(policies_id)';
                        break;
                }

                $sql =  'SELECT a.id, a.series, a.number, b.policies_id, ' .
                        'c.item, c.insurer, date_format(c.begin_datetime, ' . $db->quote(DATE_FORMAT) . ') AS begin_datetime_format, c.payment_statuses_id AS payment_statusesid, c.policy_statuses_id AS statuses_id, c.documents, c.policy_comment, ' .
                        'd.title AS policy_statuses_title, e.title AS payment_statuses_title, f.title AS policy_blank_statuses_title, ' .
                        'i.title AS agencies_title, CONCAT(lastname, \' \', firstname) AS agents_title, IF(' . $data['types_id'] . ' = 2 && TO_DAYS(c.begin_datetime) <= TO_DAYS(' . $db->quote( PolicyBlankActItems::getEndDatetime($data) ) . '), \'obligatory\', \'\') AS class ' .
                        'FROM ' . PREFIX . '_policy_blanks AS a ' .
                        'LEFT JOIN ' . PREFIX . '_policies_go AS b ON a.series = b.blank_series AND a.number = b.blank_number ' .
                        'LEFT JOIN ' . PREFIX . '_policies AS c ON b.policies_id = c.id ' .
                        'LEFT JOIN ' . PREFIX . '_policy_statuses AS d ON c.policy_statuses_id = d.id ' .
                        'LEFT JOIN ' . PREFIX . '_payment_statuses AS e ON c.payment_statuses_id = e.id ' .
                        'LEFT JOIN ' . PREFIX . '_policy_blank_statuses AS f ON a.blank_statuses_id = f.id ' .
                        'LEFT JOIN ' . PREFIX . '_agencies AS i ON a.agencies_id = i.id ' .
                        'LEFT JOIN ' . PREFIX . '_accounts AS j ON c.agents_id = j.id ' .
                        'WHERE ' . implode(' AND ', $conditions) . ' ' .
                        'ORDER BY begin_datetime DESC';
                $list = $db->getAll($sql);
//_dump($sql);

                $i = 1;
				if (is_array($list)) {
					foreach ($list as $row) {

						$checked = '';
                        $i = 1 - $i;
						if (is_array($data['policy_blanks']) ) {
							if ( in_array($row['id'], $data['policy_blanks']) ) $checked = 'checked';
						} elseif (intval($data['id']) || $row['class'] == 'obligatory') {
                            $checked = 'checked';
						}

						$result .=
							'<tr class="' . Policies::getRowClass($row, $i) . '">' .
							    '<td><input type="checkbox" name="policy_blanks[]" value="' . $row['id'] . '" class="' . $row['class'] . '" class1="'.($row['statuses_id']==1 ? 'created' : '').'" ' . $checked . ' /></td>' .
							    '<td><a href="/?do=Policies|view&id=' . $row['policies_id'] . '&product_types_id=' . PRODUCT_TYPES_GO . '" target="_blank">' . $row['series'] . '-' . $row['number'] . '</td>' .
							    '<td>' . $row['item'] . '</td>' .
							    '<td>' . $row['insurer'] . '</td>' .
							    '<td>' . $row['begin_datetime_format'] . '</td>' .
							    '<td>' . $row['policy_statuses_title'].'</td>' .
                                '<td>' . $row['payment_statuses_title'] . '</td>' .
							    '<td>' . $row['policy_blank_statuses_title'] . '</td>' .
							    '<td>' . $row['agencies_title'] . '</td>' .
							    '<td>' . $row['agents_title'].'</td>' . 
							'</tr>';
					}		 
				} 

				$result .= '</table>';
		}

        return $result;
    }

    //проверяем полиса на складе
    function checkFields($data) {
        global $db, $Log;

        switch ($data['types_id']) {
            case '1'://выдача, бланки на складе

                foreach ($data['policy_blanks'] as $row) {
                    if ($row['number_to'] - $row['number_from'] + 1 != $row['count']) {
                        $Log->add('error', 'Не вірно вказали кількість бланків для діапазону <b>' . $row['series']. '</b> з <b>' . $row['number_from'] . '</b> по <b>' . $row['number_to'] . '</b>.', array());
                    }
                }

                if (!$Log->isPresent()) {//выбираем  все что не можем добавить
                    foreach ($data['policy_blanks'] as $row) {
                        for($i = $row['number_from']; $i < $row['number_to']; $i++) {

                            $sql =  'SELECT COUNT(*) ' .
                                    'FROM ' . PREFIX . '_policy_blanks ' .
                                    'WHERE agencies_id = 0 AND series = ' . $db->quote($row['series']) . ' AND number = ' . $db->quote( sprintf('%07s', $i) );
                            $count =  $db->getOne($sql);

                            if ($count == 0) {
                                $Log->add('error', 'Бланк <b>' . $row['series']. ' ' . sprintf('%07s', $i) . '</b> не може бути доданий до акту. Відсутній на складі.', array());
                            }
                        }
                    }
                }
                break;
            case '2'://списание
                //проверяем наличие всех полисов в акте на дату

                $conditions[] = 'a.agencies_id = ' . intval($data['agencies_id']);
                $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
                $conditions[] = 'TO_DAYS(c.begin_datetime) <= TO_DAYS(' . $db->quote( PolicyBlankActItems::getEndDatetime($data) )  . ')';
                $conditions[] = 'a.id NOT IN(SELECT policy_blanks_id FROM ' . PREFIX . '_policy_blank_act_items AS a1 JOIN ' . PREFIX . '_policy_blank_acts AS b1 ON a1.acts_id = b1.id WHERE b1.agencies_id = ' . intval($data['agencies_id']) . ' AND b1.types_id = ' . $data['types_id'] . ')';

                $sql =  'SELECT a.id ' .
                        'FROM ' . PREFIX . '_policy_blanks AS a ' .
                        'LEFT JOIN ' . PREFIX . '_policies_go AS b ON a.series = b.blank_series AND a.number = b.blank_number ' .
                        'LEFT JOIN ' . PREFIX . '_policies AS c ON b.policies_id = c.id ' .
                        'WHERE ' . implode(' AND ', $conditions);
                $policy_blanks = $db->getCol($sql);

                $result = array_intersect($policy_blanks, $data['policy_blanks']);

                /*if (sizeOf($policy_blanks) != sizeOf($result)) {
                    $Log->add('error', 'Не всі бланки було включено до акту дата початку яких припадає на звітний період.', array());
                }*/
                break;
            case '3'://перемещение

                //проверяем чистые ли полиса
                $conditions[] = 'a.agencies_id = ' . intval($data['agencies_id']);
                $conditions[] = 'a.insurance_companies_id = ' . INSURANCE_COMPANIES_EXPRESS;
                $conditions[] = 'ISNULL(b.policies_id)';

                $sql =  'SELECT a.id ' .
                        'FROM ' . PREFIX . '_policy_blanks AS a ' .
                        'LEFT JOIN ' . PREFIX . '_policies_go AS b ON a.series = b.blank_series AND a.number = b.blank_number ' .
                        'WHERE ' . implode(' AND ', $conditions);
                $policy_blanks = $db->getCol($sql);

                $result = array_intersect($policy_blanks, $data['policy_blanks']);

                if (sizeOf($policy_blanks) == sizeOf($result)) {
                    $Log->add('error', 'Не всі бланки з переліку чисті.', array());
                }
                break;
        }
    }

    function setValues($data) {
        global $db, $Log;

        if (!$Log->isPresent()) {

            $sql =  'DELETE ' .
                    'FROM ' . PREFIX . '_policy_blank_act_items ' .
                    'WHERE acts_id = ' . intval($data['id']);
            $db->query($sql);

            switch ($data['types_id']) {
                case '1':
                    if (is_array($data['policy_blanks'])) {
                        foreach ($data['policy_blanks'] as $id => $row) {

                            $sql = 'SELECT id, blank_statuses_id ' .
                                   'FROM ' . PREFIX . '_policy_blanks ' .
                                   'WHERE series = ' . $db->quote($row['series']) . ' AND CAST(number AS UNSIGNED) BETWEEN ' . intval($row['number_from']) . ' AND ' . intval($row['number_to']);
                            $res = $db->query($sql);

                            while ($res->fetchInto($blank)) {
                                $sql =  'INSERT INTO ' . PREFIX . '_policy_blank_act_items SET ' .
                                        'acts_id = ' . intval($data['id']) . ', ' .
                                        'policy_blanks_id = ' . intval($blank['id']) . ', ' .
                                        'blank_statuses_id = ' . intval($blank['blank_statuses_id']);
                                $db->query($sql);
                            }
                        }

                        $sql =  'UPDATE ' . PREFIX . '_policy_blanks AS a ' .
                                'JOIN ' . PREFIX . '_policy_blank_act_items AS b ON a.id = b.policy_blanks_id ' .
                                'JOIN ' . PREFIX . '_policy_blank_acts AS c ON b.acts_id = c.id SET ' .
                                'a.agencies_id = c.agencies_id ' .
                                'WHERE c.id = ' . intval($data['id']);
                        $db->query($sql);
                    }
                    break;
                case '2':
                    if (is_array($data['policy_blanks'])) {
                        foreach ($data['policy_blanks'] as $id) {
                            $sql =  'INSERT INTO ' . PREFIX . '_policy_blank_act_items SET ' .
                                    'acts_id = ' . intval($data['id']) . ', ' .
                                    'policy_blanks_id = ' . intval($id);
                            $db->query($sql);
                        }

                        $sql = 'SELECT id, blank_statuses_id ' .
                               'FROM ' . PREFIX . '_policy_blanks ' .
                               'WHERE id IN(' . implode(', ', $data['policy_blanks']) . ')';
                        $res = $db->query($sql);

                        while ($res->fetchInto($row)) {
                            $sql = 'UPDATE ' . PREFIX . '_policy_blank_act_items SET ' .
                                   'blank_statuses_id = ' . $row['blank_statuses_id'] . ' ' .
                                   'WHERE policy_blanks_id = ' . $row['id'];
                            $db->query($sql);
                        }
                    }
                    break;
                case '3':
                    if (is_array($data['policy_blanks'])) {
                        foreach ($data['policy_blanks'] as $id) {
                            $sql =  'INSERT INTO ' . PREFIX . '_policy_blank_act_items SET ' .
                                    'acts_id = ' . intval($data['id']) . ', ' .
                                    'policy_blanks_id = ' . intval($id);
                            $db->query($sql);
                        }

                        $sql = 'SELECT id, blank_statuses_id ' .
                               'FROM ' . PREFIX . '_policy_blanks ' .
                               'WHERE id IN(' . implode(', ', $data['policy_blanks']) . ')';
                        $res = $db->query($sql);

                        while ($res->fetchInto($row)) {
                            $sql = 'UPDATE ' . PREFIX . '_policy_blank_act_items SET ' .
                                   'blank_statuses_id = ' . $row['blank_statuses_id'] . ' ' .
                                   'WHERE policy_blanks_id = ' . $row['id'];
                            $db->query($sql);
                        }
                    }

                    //возврашаем на склад
                    $sql =  'UPDATE ' . PREFIX . '_policy_blanks AS a ' .
                            'JOIN ' . PREFIX . '_policy_blank_act_items AS b ON a.id = b.policy_blanks_id ' .
                            'a.agencies_id = 0 ' .
                            'WHERE b.acts_id = ' . intval($data['id']);
                    $db->query($sql);
                    break;
            }
        }
    }

    function convert($list) {
		$i = 0;

		$result = array();
		if (is_array($list)) {
			foreach($list as $row) {

				if (!isset($result[ $i ])) {
					$result[ $i ] = $row;
					$result[ $i ]['number_from']  = $row['number'];
					$result[ $i ]['number_to']    = $row['number'];
				} elseif ($result[$i]['series'] != $row['series'] || $result[$i]['blank_statuses_id'] != $row['blank_statuses_id'] || (intval($row['number'])-intval($result[ $i ]['number_to']))>1) {
					$i++;
					$result[ $i ] = $row;
					$result[ $i ]['number_from']  = $row['number'];
					$result[ $i ]['number_to']    = $row['number'];
				} else {
					$result[ $i ]['number_to'] = $row['number'];
				}

				$result[ $i ]['count'] = (!isset($result[ $i ]['count'])) ? 1 : $result[ $i ]['count'] + 1;
			}
		}

		return $result;
    }
}

?>