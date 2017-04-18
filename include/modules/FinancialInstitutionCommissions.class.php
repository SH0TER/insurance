<?
/*
 * Title: financial institution commission class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class FinancialInstitutionCommissions extends Form {

    var $formDescription =
        array(
            'fields'     =>
                array(
                    array(
                        'name'              => 'date',
                        'description'       => 'Дата',
                        'type'              => fldDate,
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
                        'table'             => 'financial_institution_commissions'),
                  array(
                        'name'              => 'financial_institutions_id',
                        'description'       => 'Банк',
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
                        'table'             => 'financial_institution_commissions'),
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
                        'table'             => 'financial_institution_commissions'),
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
                        'table'                => 'financial_institution_commissions'),
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
                        'table'             => 'financial_institution_commissions')
                ),
            'common'    =>
                array(
                    'defaultOrderPosition'  => 2,
                    'defaultOrderDirection' => 'desc',
                    'titleField'            => 'date_format(date, \'%d.%m.%Y\')'
                )
        );

    function FinancialInstitutionCommissions($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Комісії';
        $this->messages['single'] = 'Комісія';

		$this->product_types = array(PRODUCT_TYPES_KASKO);
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => true,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => true);
                break;
            case ROLES_MANAGER:
                $this->permissions = array(
                    'show'      => ($Authorization->data['agencies']) ? true : false,
                    'insert'    => ($Authorization->data['agencies']) ? true : false,
                    'update'    => ($Authorization->data['agencies']) ? true : false,
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
            $sql    = 'SELECT DISTINCT date, date_format(date, \'' . DATE_FORMAT . '\') as date_format, date_format(modified, \'' . DATE_FORMAT . '\') as modifiedFormat FROM ' . implode(', ', $this->tables) . ' WHERE ' . implode(' AND ', $conditions) . ' ORDER BY ';
            $total  = $db->getOne('SELECT count(DISTINCT date) FROM '.$this->tables[0]. ' WHERE ' . implode(' AND ', $conditions));
        } else {
            $sql    = 'SELECT DISTINCT date, date_format(date, \'' . DATE_FORMAT . '\') as date_format, date_format(modified, \'' . DATE_FORMAT . '\') as modifiedFormat FROM ' . implode(', ', $this->tables) . ' ORDER BY ';
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

		$conditions[] = 'a.id IN(' . implode(', ', $this->product_types) . ')';//накладываем ограничение по банковской комиссии через определенные виды страхования
		$conditions[] = 'c.financial_institutions_id = ' . intval($data['financial_institutions_id']);

        $sql =  'SELECT a.title as product_typesTitle, b.id as products_id, b.code as products_code, b.title as products_title ' .
                'FROM ' . PREFIX . '_product_types as a ' .
                'JOIN ' . PREFIX . '_products as b ON a.id = b.product_types_id ' .
                'JOIN ' . PREFIX . '_product_financial_institution_assignments as c ON b.id = c.products_id ' .
                'LEFT JOIN ' . PREFIX . '_financial_institution_commissions as d ON b.id = d.products_id AND d.financial_institutions_id = ' . intval($data['financial_institutions_id']) . ' AND TO_DAYS(d.date) = TO_DAYS(' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']) .') ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY a.num_l, b.code';
        $res = $db->query($sql);

        $result = '';

        switch ($action) {
            default:
                $field = $this->formDescription['fields'][ $this->getFieldPositionByName('date') ];
                $result .= '<input type="hidden" name="financial_institutions_id" value="' . $data['financial_institutions_id'] . '" />';
                $result .= '<input type="hidden" name="old_date" value="' . $data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day'] . '" />';
                $result .= '<tr><td class="label">*Дата:</td><td>' . $this->getDateSelect($field, $data['date_year'], $data['date_month'], $data['date_day'], 'date', $field['addition']) . '</td></tr>';

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

                        $commissionFinancialInstitution = $data['commissions'][ $row['products_id'] ]['percent'] + $data['commissions'][ $row['products_id'] ]['amount'];

                        $result .=
                            '<tr>' .
                                '<td align="right" nowrap>' . $row['products_code'] . ', ' . $row['products_title'] . ':</td>' .
                                '<td>' .
                                    '<input type="text" name="commissions[' . $row['products_id'] . '][percent]" value="' . $data['commissions'][ $row['products_id'] ]['percent'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> % ' .
                                    'від страхової <input type="radio" name="commissions[' . $row['products_id'] . '][base]" value="1" ' . ( ($data['commissions'][ $row['products_id'] ]['base'] == COMMISSIONS_BASE_PRICE) ? 'checked' : '') . ' /> суми <input type="radio" name="commissions[' . $row['products_id'] . '][base]" value="2" ' . ( ($data['commissions'][ $row['products_id'] ]['base'] == COMMISSIONS_BASE_AMOUNT) ? 'checked' : '') . ' /> премії <b>АБО</b> ' .
                                    '<input type="text" name="commissions[' . $row['products_id'] . '][amount]" value="' . $data['commissions'][ $row['products_id'] ]['amount'] . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> грн.' .
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
            case 'update':
                $this->checkPermissions($action, $data);
                break;
        }

        if (!intval($data['financial_institutions_id'])) {
            $params = array('Банк', '');
            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
        }

        if (!checkdate($data['date_month'], $data['date_day'], $data['date_year'])) {
            $params = array('Дата', '');
            $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
        }

        if (is_array($data['commissions'])) {
            foreach ($data['commissions'] as $products_id => $row) {
                if ($row['percent'] > 0 && $row['amount'] > 0) {
                    $Log->add('error', 'Не можливо задавати одночасно відносну та абсолютну величину.', array('', ''));
                } elseif ($row['percent'] > 0) {
                    if (!$this->isValidPercent($row['percent'])) {
                        $params = array('Розмір комісії, %', '');
                        $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                    }
                    if (intval($row['base']) == 0) {
                        $params = array('База обрахунку, %', '');
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                    }
                } else {
                    if (!$this->isValidMoney($row['amount'])) {
                        $params = array('Розмір комісії, грн.', '');
                        $Log->add('error', 'The <b>%s</b>%s is not valid.', $params);
                    }

                    $data['commissions'][ $products_id ]['base'] = 0;
                }
            }
        }

        if ($Log->isPresent()) {
            $this->showForm($data, $GLOBALS['method'], $action);
        } else {

            $conditions[] = 'financial_institutions_id = ' . intval($data['financial_institutions_id']);
            $conditions[] = 'date = ' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']);

            $sql =  'DELETE ' .
                    'FROM ' . $this->tables[0] . ' ' .
                    'WHERE ' . implode(' AND ', $conditions);
            $db->query($sql);

            if (is_array($data['commissions'])) {

                foreach ($data['commissions'] as $products_id => $row) {
                    $sql =  'INSERT INTO ' . PREFIX . '_financial_institution_commissions SET ' .
                            'financial_institutions_id = ' . intval($data['financial_institutions_id']) . ', ' .
                            'date = ' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']) . ', ' .
                            'products_id = ' . intval($products_id) . ', ' .
                            'percent = ' . $db->quote($row['percent']) . ', ' .
                            'base = ' . intval($row['base']) . ', ' .
                            'amount = ' . $db->quote($row['amount']) . ', ' .
                            'modified = NOW()';
                    $db->query($sql);
                }

            }

            $params['title']    = $this->messages['single'];
            $params['storage']  = $this->tables[0];

            if ($redirect) {
                $Log->add('confirm', $this->messages[$action]['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=FinancialInstitutions|view&id=' . $data['financial_institutions_id']);
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

        $this->checkPermissions('update', $data);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =  'SELECT *, date_format(date, \'' . DATE_FORMAT . '\') as date_format, date_format(date, \'' . DATE_FORMAT . '\') as date_format, date_format(date, \'%Y\') as date_year, date_format(date, \'%m\') as date_month, date_format(date, \'%d\') as date_day ' .
                'FROM ' . implode(', ', $this->tables) . ' ' .
                'WHERE ' . $this->getAssignmentConditions('view', $prefix, ' AND ') . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . $db->quote($data['id']);
        $res = $db->query($sql);

        $data['date_year']   = substr($data['id'], 0, 4);
        $data['date_month']  = substr($data['id'], 5, 2);
        $data['date_day']    = substr($data['id'], 8, 2);
        $data['date_format'] = $data['date_day'] . '-' . $data['date_month'] . '-' . $data['date_year'];

        while ($res->fetchInto($row)) {
            $data['commissions'][ $row['products_id'] ]['percent']   = $row['percent'];
            $data['commissions'][ $row['products_id'] ]['base']      = $row['base'];
            $data['commissions'][ $row['products_id'] ]['amount']    = $row['amount'];
        }

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function update($data, $redirect=true) {
        return $this->insert($data, $redirect, 'update');
    }

    function deleteProcess($data) {
        global $db;

        $conditions[] = 'date IN(\'' . implode('\', \'', $data['id']) . '\')';
        $conditions[] = 'financial_institutions_id =' .intval($data['financial_institutions_id']);

        $sql =  'DELETE ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        $db->query($sql);

        return true;
    }
}

?>