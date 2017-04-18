<?
/*
 * Title: agency commission class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

class AgencyCommissions extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'date',
                            'description'       => 'Дата',
                            'type'              => fldDate,
                            'input'             => true,
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
                            'orderPosition'     => 1,
                            'table'             => 'agency_commissions'),
                      array(
                            'name'              => 'agencies_id',
                            'description'       => 'Агенція',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'agency_commissions'),
                        array(
                            'name'              => 'products_id',
                            'description'       => 'Продукт',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'agency_commissions'),
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
                            'table'             => 'agency_commissions'),
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
                            'orderPosition'     => 2,
                            'width'             => 100,
                            'table'             => 'agency_commissions')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 2,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'date_format(date, \'%d.%m.%Y\')'
                    )
            );

    function AgencyCommissions($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Комісії';
        $this->messages['single'] = 'Комісія';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'add'       => true,
					'copy'		=> true,
                    'edit'      => true,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => true);
                break;
            case ROLES_MANAGER:
                $this->permissions = array(
                    'show'      => ($Authorization->data['agencies']) ? true : false,
                    'add'       => ($Authorization->data['agencies']) ? true : false,
					'copy'		=> ($Authorization->data['agencies']) ? true : false,
                    'edit'      => ($Authorization->data['agencies']) ? true : false,
                    'view'      => ($Authorization->data['agencies']) ? true : false,
                    'change'    => false,
                    'delete'    => ($Authorization->data['agencies']) ? true : false);
                break;
        }
    }

    function show($data, $fields=null, $conditions=null) {
        global $db;

        $this->checkPermissions('show', $data);

        $hidden['do'] = $data['do'];

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        if (is_array($conditions)) {
            $sql    = 'SELECT DISTINCT date, date_format(date, \'' . DATE_FORMAT . '\') as date_format, date_format(max(modified), \'' . DATE_FORMAT . '\') as modifiedFormat FROM ' . implode(', ', $this->tables) . ' WHERE ' . implode(' AND ', $conditions) . ' GROUP BY  date ORDER BY ';
            $total  = $db->getOne('SELECT count(DISTINCT date) FROM '.$this->tables[0]. ' WHERE ' . implode(' AND ', $conditions));
        } else {
            $sql    = 'SELECT DISTINCT date, date_format(date, \'' . DATE_FORMAT . '\') as date_format, date_format(max(modified), \'' . DATE_FORMAT . '\') as modifiedFormat FROM ' . implode(', ', $this->tables) . ' GROUP BY  date  ORDER BY ';
            $total  = $db->getOne('SELECT count(DISTINCT date) FROM '.$this->tables[0]. ' ') ;
        }

        $direction = (ereg('^(asc|desc)$', $_COOKIE[ $this->object ]['orderDirection']))
            ? $_COOKIE[ $this->object ]['orderDirection']
            : $this->formDescription['common']['defaultOrderDirection'];

        $sql .= ($this->getFieldNameByOrderPosition($_COOKIE[$this->object]['orderPosition']))
            ? $this->getFieldNameByOrderPosition($_COOKIE[$this->object]['orderPosition']) . ' ' . $direction
            : $this->getFieldNameByOrderPosition($this->formDescription['common']['defaultOrderPosition']) . ' ' . $direction;

        $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($_SESSION['auth']['records_per_page']);

        $res = $db->query($sql);

        $this->changePermissions($total);

        include $this->object . '/show.php';
    }

    function buildFieldsPart($data, $action) {
        global $db;

        $sql =  'SELECT a.title as product_typesTitle, b.id as products_id, b.product_types_id, b.code as products_code, b.title as products_title, c.agency_percent, c.agent_percent ' .
                'FROM ' . PREFIX . '_product_types as a ' .
                'JOIN ' . PREFIX . '_products as b ON a.id = b.product_types_id ' .
                'LEFT JOIN ' . PREFIX . '_agency_commissions as c ON b.id = c.products_id AND c.agencies_id = ' . intval($data['agencies_id']) . ' AND TO_DAYS(date) = TO_DAYS(' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']) .') ' .
                'ORDER BY a.num_l, b.code';
        $res = $db->query($sql);

        $result = '';

        switch ($action) {
            default:
                $field = $this->formDescription['fields'][ $this->getFieldPositionByName('date') ];
                $result .= '<input type="hidden" name="agencies_id" value="' . $data['agencies_id'] . '" />';
                $result .= '<input type="hidden" name="old_date" value="2008-01-01" />';
                $result .= '<tr><td class="label">*Дата:</td><td>' . $this->getDateSelect($field, '2008', '01', '01', 'date', $field['addition']) . '</td></tr>';

                if ($res->numRows()) {

                    $i = 1;
                    while ($res->fetchInto($row)) {
                        if ($product_typesTitle != $row['product_typesTitle']) {

                            $result .=
                                '<tr>' .
                                    '<td>&nbsp;</td>' .
                                    '<td><b>' . $row['product_typesTitle'] . ':</b></td>' .
                                '</tr>';

                            $product_typesTitle = $row['product_typesTitle'];
                        }

                        $commissionAgency = $data['commissions'][ $row['products_id'] ]['agency_percent'] + $data['commissions'][ $row['products_id'] ]['agency_amount'] + $data['commissions'][ $row['products_id'] ]['agent_percent'] + $data['commissions'][ $row['products_id'] ]['agent_amount'];

                        $result .=
                            '<tr>' .
                                '<td align="right" ' . (($commissionAgency == 0) ? ' class="warning"' : '') . '>' . $row['products_code'] . ' ' . $row['products_title'] . ':</td>' .
                                '<td>' .
                                    '<b>агенція:</b> <input type="text" name="commissions[' . $row['products_id'] . '][agency_percent]" value="' . $data['commissions'][ $row['products_id'] ]['agency_percent'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> % ' .
									'<input type="hidden" name="commissions[' . $row['products_id'] . '][agency_base]" value="2" />' . //скрываем базу начисления
									'<input type="hidden" name="commissions[' . $row['products_id'] . '][agency_amount]" value="0" />' . //скрываем абсолютную величину
//                                    'від страхової <input type="radio" name="commissions[' . $row['products_id'] . '][agency_base]" value="1" ' . ( ($data['commissions'][ $row['products_id'] ]['agency_base'] == COMMISSIONS_BASE_PRICE && $row['product_types_id'] != PRODUCT_TYPES_GO) ? 'checked' : '') . ' ' . (($row['product_types_id'] == PRODUCT_TYPES_GO) ? 'disabled' : '') . ' /> суми <input type="radio" name="commissions[' . $row['products_id'] . '][agency_base]" value="2" ' . ( ($data['commissions'][ $row['products_id'] ]['agency_base'] == COMMISSIONS_BASE_AMOUNT || $row['product_types_id'] == PRODUCT_TYPES_GO) ? 'checked' : '') . ' /> премії <b>АБО</b> ' .
//                                    '<input type="text" name="commissions[' . $row['products_id'] . '][agency_amount]" value="' . $data['commissions'][ $row['products_id'] ]['agency_amount'] . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> грн. &nbsp; ' .
                                    '<b>агент:</b> <input type="text" name="commissions[' . $row['products_id'] . '][agent_percent]" value="' . $data['commissions'][ $row['products_id'] ]['agent_percent'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> % ' .
									'<input type="hidden" name="commissions[' . $row['products_id'] . '][agent_base]" value="2" />' . //скрываем базу начисления
									'<input type="hidden" name="commissions[' . $row['products_id'] . '][agent_amount]" value="0" />' . //скрываем абсолютную величину
//                                    'від страхової <input type="radio" name="commissions[' . $row['products_id'] . '][agent_base]" value="1" ' . ( ($data['commissions'][ $row['products_id'] ]['agent_base'] == COMMISSIONS_BASE_PRICE && $row['product_types_id'] != PRODUCT_TYPES_GO) ? 'checked' : '') . ' ' . (($row['product_types_id'] == PRODUCT_TYPES_GO) ? 'disabled' : '') . ' /> суми <input type="radio" name="commissions[' . $row['products_id'] . '][agent_base]" value="2" ' . ( ($data['commissions'][ $row['products_id'] ]['agent_base'] == COMMISSIONS_BASE_AMOUNT || $row['product_types_id'] == PRODUCT_TYPES_GO) ? 'checked' : '') . ' /> премії <b>АБО</b> ' .
//                                    '<input type="text" name="commissions[' . $row['products_id'] . '][agent_amount]" value="' . $data['commissions'][ $row['products_id'] ]['agent_amount'] . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> грн.' .
                                '</td>' .
                            '</tr>';

                        $i++;
                    }
                }
        }

        return $result;
    }

    function add($data) {
        $data['date_year']   = date('Y');
        $data['date_month']  = date('m');
        $data['date_day']    = date('d');

        $data['id']         = date('Y.m.d');

        return parent::add($data);
    }

    function insert($data, $redirect=true, $action='insert') {
        global $db, $Log;

        switch ($action) {
            case 'insert':
                $this->checkPermissions('add', $data);
                break;
            case 'update':
                $this->checkPermissions('edit', $data);
                break;
        }

        if (!intval($data['agencies_id'])) {
            $params = array('Агенція', '');
            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
        }

        if (!checkdate($data['date_month'], $data['date_day'], $data['date_year'])) {
            $params = array('Дата', '');
            $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
        }

        if (is_array($data['commissions'])) {
            foreach ($data['commissions'] as $products_id => $row) {

                if ($row['agency_percent'] > 0 && $row['agency_amount'] > 0) {
                    $Log->add('error', 'Агенція. Не можливо задавати одночасно відносну та абсолютну величину.', array('', ''));
                } elseif ($row['agency_percent'] > 0) {
                    if (!$this->isValidPercent($row['agency_percent'])) {
                        $params = array('Агенція. Розмір комісії, %', '');
                        $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                    }
                    if (intval($row['agency_base']) == 0) {
                        $params = array('Агенція. База обрахунку, %', '');
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }
                } else {
                    if (!$this->isValidMoney($row['agency_amount'])) {
                        $params = array('Агенція. Розмір комісії, грн.', '');
                        $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                    }

                    $data['commissions'][ $products_id ]['agency_base'] = 0;
                }

                if ($row['agent_percent'] > 0 && $row['agent_amount'] > 0) {
                    $Log->add('error', 'Агент. Не можливо задавати одночасно відносну та абсолютну величину.', array('', ''));
                } elseif ($row['agent_percent'] > 0) {
                    if (!$this->isValidPercent($row['agent_percent'])) {
                        $params = array('Агент. Розмір комісії, %', '');
                        $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                    }
                    if (intval($row['agent_base']) == 0) {
                        $params = array('Агент. База обрахунку, %', '');
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }
                } else {
                    if (!$this->isValidMoney($row['agent_amount'])) {
                        $params = array('Агент. Розмір комісії, грн.', '');
                        $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                    }

                    $data['commissions'][ $products_id ]['agent_base'] = 0;
                }
            }
        }

        if ($Log->isPresent()) {
            $this->showForm($data, $GLOBALS['method'], $action);
        } else {
			$data['date_year'] ='2008';
			$data['date_month'] ='01';
			$data['date_day']='01';
			
            $conditions[] = 'agencies_id = ' . intval($data['agencies_id']);
            $conditions[] = 'date = ' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']);

            $sql =  'DELETE ' .
                    'FROM ' . $this->tables[0] . ' ' .
                    'WHERE ' . implode(' AND ', $conditions);
            $db->query($sql);

            if (is_array($data['commissions'])) {

                foreach ($data['commissions'] as $products_id => $row) {
                    $sql =  'INSERT INTO ' . PREFIX . '_agency_commissions SET ' .
                            'agencies_id = ' . intval($data['agencies_id']) . ', ' .
                            'date = ' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']) . ', ' .
                            'products_id = ' . intval($products_id) . ', ' .
                            'agency_percent = ' . $db->quote($row['agency_percent']) . ', ' .
                            'agency_base = ' . intval($row['agency_base']) . ', ' .
                            'agency_amount = ' . $db->quote($row['agency_amount']) . ', ' .
                            'agent_percent = ' . $db->quote($row['agent_percent']) . ', ' .
                            'agent_base = ' . intval($row['agent_base']) . ', ' .
                            'agent_amount = ' . $db->quote($row['agent_amount']) . ', ' .
                            'modified = NOW()';
                    $db->query($sql);
                }
            }

            $params['title']    = $this->messages['single'];
            $params['storage']  = $this->tables[0];

            if ($redirect) {
                $Log->add('confirm', $this->messages[$action]['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Agencies|view&id=' . $data['agencies_id']);
                exit;
            } else {
                return true;
            }
        }
    }

    function getIdentityField() {
        return $this->formDescription['fields'][ $this->getFieldPositionByName('date') ];
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;

        $this->checkPermissions('edit', $data);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =  'SELECT *, date_format(date, \'' . DATE_FORMAT . '\') as date_format, date_format(date, \'' . DATE_FORMAT . '\') as date_format, date_format(date, \'%Y\') as date_year, date_format(date, \'%m\') as date_month, date_format(date, \'%d\') as date_day ' .
                'FROM ' . implode(', ', $this->tables) . ' ' .
                'WHERE ' . $this->getAssignmentConditions('view', $prefix, ' AND ') . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . $db->quote($data['id']) . ' AND agencies_id = ' . intval($data['agencies_id']);
        $res = $db->query($sql);

        $data['date_year']   = substr($data['id'], 0, 4);
        $data['date_month']  = substr($data['id'], 5, 2);
        $data['date_day']    = substr($data['id'], 8, 2);
        $data['date_format'] = $data['date_day'] . '-' . $data['date_month'] . '-' . $data['date_year'];

        while ($res->fetchInto($row)) {
            $data['commissions'][ $row['products_id'] ]['agency_percent'] = $row['agency_percent'];
            $data['commissions'][ $row['products_id'] ]['agency_base']    = $row['agency_base'];
            $data['commissions'][ $row['products_id'] ]['agency_amount']  = $row['agency_amount'];
            $data['commissions'][ $row['products_id'] ]['agent_percent']  = $row['agent_percent'];
            $data['commissions'][ $row['products_id'] ]['agent_base']     = $row['agent_base'];
            $data['commissions'][ $row['products_id'] ]['agent_amount']   = $row['agent_amount'];
        }

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

	function copy($data) {
		$this->checkPermissions('copy', $data);

		$data = $this->load($data, false);
		$this->add($data);
	}

    function update($data, $redirect=true) {
        return $this->insert($data, $redirect, 'update');
    }

    function deleteProcess($data) {
        global $db;

        $conditions[] = 'date IN(\'' . implode('\', \'', $data['id']) . '\')';
        $conditions[] = 'agencies_id =' .intval($data['agencies_id']);

        $sql =  'DELETE ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        $db->query($sql);

        return true;
    }
}

?>