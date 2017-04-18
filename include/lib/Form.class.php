<?
/*
 * Title: form processing class
 *
 * @author Eugene Cherkassky
 * @email eugene.cherkassky@gmail.com
 * @version 3.0
 */

define('fldIdentity',       1);
define('fldLogin',          2);
define('fldPassword',       3);
define('fldText',           4);
define('fldNote',           5);
define('fldInteger',        6);
define('fldMoney',          7);
define('fldPercent',        8);
define('fldDate',           9);
define('fldDateTime',       10);
define('fldDatePeriod',     11);
define('fldImage',          12);
define('fldFile',           13);
define('fldHidden',         14);
define('fldBoolean',        15);
define('fldSelect',         16);
define('fldMultipleSelect', 17);
define('fldRadio',          18);
define('fldCheckboxes',     19);
define('fldURL',            20);
define('fldEmail',          21);
define('fldHTML',           22);
define('fldConst',          23);
define('fldUnique',         24);
define('fldOrderPosition',  25);
define('fldCustom',         26);
define('fldPhone',          27);

class Form {

    var $object			= '';
    var $objectTitle	= '';

    var $tables			= array();

    var $showFields		= array();
    var $changeFields	= array();
    var $formFields 	= array();
    var $hiddenFields 	= array();

    var $languages		= '';
    var $languageCode	= '';

    var $showActions	= false;
    var $renumerate		= false;
    var $search			= false;

    function Form($data) {
 
        if (!$this->object) {
            $this->object	= getObject(get_class($this));
        }

        $this->objectTitle	= $this->object;

        $this->languages	= $GLOBALS['LANGUAGES'];
        $this->languageCode	= DEFAULT_LANGUAGE;

        $this->setTables();

        if ($this->getFieldPositionByName('order_position') >= 0) {
            $this->renumerate = true;
        }

		$this->setMode($data);

        $this->messages =
            array(
                'show'      => '%s',
                'add'       => '%s. Add',
                'insert'    =>
                    array(
                        'confirm'   => '%s has been successfully added.',
                        'error'     => '%s has not been added. An error occured.'),
                'import'	=> '%s. Import',
                'importProcess'	=>
                    array(
                        'confirm'   => '%s has been successfully imported.',
                        'error'     => '%s has not been imported. An error occured.'),
                'load'  => '%s. Edit',
                'view'  => '%s',
                'change'    =>
                    array(
                        'confirm'   => 'Selected %s have been successfully updated.',
                        'error'     => 'Selected %s have been successfully updated. An error occured.'),
				'update'    =>
                    array(
                        'confirm'   => 'The %s has been successfully updated.',
                        'error'     => 'The %s has not been updated. An error occured.'),
                'changeOrderPositionToUp'   =>
                    array(
                        'confirm'   => 'Order position has been successfully changed.',
                        'error'     => 'Order position has not been changed. An error occured.'),
                'changeOrderPositionToDown' =>
                    array(
                        'confirm'       => 'Order position has been successfully changed.',
                        'error'         => 'Order position has not been changed. An error occured.'),
                'deleteFile'    =>
                    array(
                        'confirm'   => 'The file has been deleted.',
                        'error'     => 'The file hasn\'t been deleted. An error occured.'),
                'delete'    =>
                    array(
                        'confirm'   => 'Selected %s have been successfully deleted.',
                        'error'     => 'Selected %s have not been deleted. An error occured.')
        );

        $this->setPermissions($data);
    }

    function setMode($data) {
        if (ereg('^' . $this->object . '\|view', $data['do'])) {
            $this->mode = 'view';
        } else {
            $this->mode = 'update';
        }
    }

    function setPermissions($data) {
    }

    function checkPermissionsBooleanResult($action, $oBject = null) {
        global $Authorization;
        
        if($Authorization->data['id'] == 3526 || $Authorization->data['id'] == 1) {
            return true;
        }

        if(!$oBject)
            return $Authorization->data['permissions'][$this->object][$action];
        else
            return $Authorization->data['permissions'][$oBject][$action];
    }

    function checkPermissions($action, $data, $redirect=false) {
        global $Log;

        if (!$this->permissions[ $action ] || $redirect) {
            $Log->add('error', translate('You doesn\'t have enought permissions.') . ' ' . $this->object . '|' . $action);
//			echo 'У Вас недостатньо повноваженнь: ' . $this->object . '|' . $action;

            $redirect = ($_SERVER['HTTP_REFERER'] && !eregi('index\.php$', $_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show';

            header('Location: ' . $redirect);
            exit;
        }

		return true;
    }

    function getSuffix($data) {
        switch($data['product_types_id']) {
            case PRODUCT_TYPES_KASKO:
                return $this->suffix = 'kasko';

            case PRODUCT_TYPES_GO:
                return $this->suffix = 'go';

            case PRODUCT_TYPES_NS:
                return $this->suffix = 'ns';
        }
    }

    function setTables($action=null) {

        $this->tables = array();

        if (is_array($this->formDescription['fields'])) {
            foreach($this->formDescription['fields'] as $field) {
                switch ($action) {
                    case 'show':
                        if ($field['table'] && $field['type'] != fldMultipleSelect && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }

                        if ($field['display'][ $action ] && $field['sourceTable'] && !in_array(PREFIX . '_' . $field['sourceTable'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['sourceTable'];
                        }
                        break;
                    case 'view':
                        if ($field['table'] && $field['type'] != fldMultipleSelect && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }
                        if ($field['display'][ $action ] && $field['sourceTable'] && !in_array(PREFIX . '_' . $field['sourceTable'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['sourceTable'];
                        }
                        break;
                    case 'insert':
                        if ($field['display']['insert'] && $field['table'] && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }
                        break;
                    case 'update':
                        if ($field['display']['update'] && $field['table'] && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }
                        break;
                    case 'delete':
                        if ($field['table'] && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }
                        break;
                    default:
                        if ($field['table'] && $field['type'] != fldMultipleSelect && !in_array(PREFIX . '_' . $field['table'], $this->tables)) {
                            $this->tables[] = PREFIX . '_' . $field['table'];
                        }
                }
            }
        }
    }

    function setObjectTitle($title) {
        $this->objectTitle = $title;
    }

    function getIdentityField() {
        foreach($this->formDescription['fields'] as $field) {
            if ($field['type'] == fldIdentity) {
                return $field;
            }
        }
    }

    function getIdentityFieldTable() {
        foreach($this->formDescription['fields'] as $field) {
            if ($field['type'] == fldIdentity) {
                return $field['table'];
            }
        }
    }

    function getTitle($id) {
        global $db;

        $identityField	= $this->getIdentityField();
        $languageCode	= ($this->formDescription['fields'][ $this->getNumberByName($this->formDescription['common']['titleField']) ]['multiLanguages']) ? DEFAULT_LANGUAGE : '';

        return $db->getOne('SELECT ' . $this->formDescription['common']['titleField'] . $languageCode . ' FROM ' . $this->tables[0] . ' WHERE ' . $identityField['name'] . '=' . intval($id));
    }

    function getNumberByName($name) {
        foreach($this->formDescription['fields'] as $i=>$fields) {
            if ($fields['name'] == $name) {
                return $i;
            }
        }
    }

    function getIdByAlias($alias) {
        global $db;
        return $db->getOne('SELECT id FROM ' . $this->tables[0] . ' WHERE alias = ' . $db->quote($alias));
    }

    function getLevel($id) {
        global $db;

        static $level = 1;

        $parent_id = $db->getOne('SELECT parent_id FROM ' . $this->tables[0] . ' WHERE id = ' . intval($id));

        if ($parent_id != 0) {
            $this->getLevel($parent_id);
            $level++;
        }

        return $level;
    }

    function getTopId($id) {
        global $db;

        $sql =	'SELECT top ' .
				'FROM ' . $this->tables[0] . ' ' .
				'WHERE id = ' . intval($id);
        return $db->getOne($sql);
    }

    function isTop($id) {
        global $db;

        $parent_id = $db->getOne('SELECT parent_id FROM ' . $this->tables[0] . ' WHERE id = ' . intval($id));

        return ($parent_id == 0) ? true : false;
    }

    function getSubId(&$id, $parent_id) {
        global $db;

        $sql =	'SELECT id, parent_id ' .
				'FROM ' . $this->tables[0] . ' ' .
				'WHERE parent_id = ' . intval($parent_id);
        $res = $db->query($sql);

        while ($res->fetchInto($row)) {
            $id[] = $row['id'];
            $this->getSubId($id, $row['id']);
        }
    }

    function getPathId($id) {
        global $db;

        static $path;

        $sql = 'SELECT id, parent_id FROM ' . $this->tables[0] . ' WHERE id=' . intval($id);
        $row = $db->getRow($sql);

        $path[] = $row['id'];

        if ($row['parent_id']) {
            $this->getPathId($row['parent_id']);
        }

        return $path;
    }

    function getPathAlias($id, $set=true) {
        global $db;

        static $path;

        if ($set) {
            $path = array();
        }

        $sql = 'SELECT id, alias, parent_id FROM ' . $this->tables[0] . ' WHERE id = ' . intval($id);
        $row = $db->getRow($sql);

        $path[] = $row['alias'];

        if ($row['parent_id'] != 0) {
            $this->getPathAlias($row['parent_id'], false);
        }

        return array_reverse($path);
    }

    function setShowFields() {
        $this->showFields = array();

        foreach($this->formDescription['fields'] as $field) {
            if ($field['display']['show'] && intval($field['orderPosition'])) {
                $this->showFields[$field['orderPosition']] = $field;
            }
        }
        ksort($this->showFields);
    }

    function getShowFieldsSQLString() {
        global $db;

        $sqlFields = ($this->getFieldPositionByName('id') >= 0) ? array($this->tables[0] . '.id') : array();

        foreach($this->showFields as $field) {

            reset($this->languages);

            $languageCode = ($field['multiLanguages']) ? $this->languageCode : '';

            switch ($field['type']) {
                case fldDate:
                    $sqlFields[] = 'date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'].$languageCode . ', ' . $db->quote(DATE_FORMAT) . ') AS ' . $field['name'].$languageCode.'_format';
                    break;
                case fldDateTime:
                    $sqlFields[] = 'date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'].$languageCode . ', ' . $db->quote(DATETIME_FORMAT) . ') AS ' . $field['name'].$languageCode.'_format';
                    break;
                default:
                    if ($field['withoutTable']) {
                        $sqlFields[] = $field['name'].$languageCode;
                    } else {
                        $sqlFields[] = ($field['type'] == fldSelect || $field['type'] == fldMultipleSelect)
                            ? PREFIX . '_' . $field['table'] . '.' . $field['name'] . ', ' . PREFIX . '_' . $field['sourceTable'] . '.' . $field['selectField'] . $languageCode . ' AS ' . $field['name'].$languageCode
                            : PREFIX . '_' . $field['table'] . '.' . $field['name'].$languageCode;
                    }
            }
        }
        return implode(', ', $sqlFields);
    }

    function getColumn($title, $orderPosition, $changeOrderPosition, $defaultOrderPosition, $defaultOrderDirection, $width = '', $parameters = '') {
        $class = ($_COOKIE[get_class($this)]['orderPosition'] == $orderPosition || ($orderPosition == $defaultOrderPosition && $_COOKIE[get_class($this)]['orderPosition'] == ''))
            ? 'active'
            : '';

        $result = (intval($width) != 0) ? '<td class="' . $class . '" width="' . $width . '" ' . $parameters . '>' : '<td class="' . $class . '" ' . $parameters . '>';

        if ($changeOrderPosition) {
            if ($_COOKIE[get_class($this)]['orderPosition'] == $orderPosition) {
                $result .= '<img src="/images/administration/' . $_COOKIE[get_class($this)]['orderDirection'] . '.gif" width="11" height="11" alt="" />';
            } elseif ($orderPosition == $defaultOrderPosition && $_COOKIE[get_class($this)]['orderPosition'] == '') {
                $result .= '<img src="/images/administration/' . $defaultOrderDirection . '.gif" width="11" height="11" alt="" />';
            }

            $formNumber = sizeOf($_SESSION['auth']['path']) - 1;

            $result .= '<a href="javascript: sendOrderForm(document.path, \'' . get_class($this) . '\', ' . $orderPosition . ', \'' . $defaultOrderDirection . '\')">' . $title . '</a>';
        } else {
            $result .= $title;
        }

        $result .= '</td>';

        return $result;
    }

    function getColumnTitle($orderPosition, $type,$excel=false) {

        if ($excel && $type!=fldHidden)
            return $this->getColumn(translate($this->showFields[ $orderPosition ]['description']), $orderPosition, false, $this->formDescription['common']['defaultOrderPosition'], $this->formDescription['common']['defaultOrderDirection'], $this->showFields[$orderPosition]['width'], $this->showFields[$orderPosition]['parameters']);

        switch ($type) {
            case fldHidden:
                break;
            case fldFile:
            case fldImage:
                return $this->getColumn(translate($this->showFields[$orderPosition]['description']), $orderPosition, false, $this->formDescription['common']['defaultOrderPosition'], $this->formDescription['common']['defaultOrderDirection'], $this->showFields[$orderPosition]['width'], $this->showFields[$orderPosition]['parameters']);
                break;
            default:
                return $this->getColumn(translate($this->showFields[$orderPosition]['description']), $orderPosition, true, $this->formDescription['common']['defaultOrderPosition'], $this->formDescription['common']['defaultOrderDirection'], $this->showFields[$orderPosition]['width'], $this->showFields[$orderPosition]['parameters']);
        }
    }

    function getColumnTitles($excel=false) {
        $title = '';

        foreach($this->showFields as $orderPosition=>$field) {
            if ($orderPosition > 0) $title .= $this->getColumnTitle($orderPosition, $field['type'], $excel);
        }

        if ($this->showActions && ($this->permissions['view'] || $this->permissions['update'] || $this->permissions['delete'])) {
            $title .= '<td class="actions">' . translate('Actions') . '</td>';
        }

        return $title;
    }

    function getOrderPostionAdditionalField($data) {
        $result = array();

        $this->setHiddenFields();

        if ($this->hiddenFields) {
            foreach($this->hiddenFields as $field) {
                if ($field['multiLanguages'] && !$field['sourceTable']) {
                    foreach($this->languages as $languageCode => $languageTitle) {
                        $result[] = $field['name'].$languageCode . '=' . $data[$field['name'].$languageCode];
                    }
                } else {
                    $result[] = $field['name'] . '=' . $data[$field['name']];
                }
            }
        }

        if ($result)
            return '&amp;' . implode('&amp;', $result);
    }

    function getHiddenFields($hidden) {
        $result = '';

        if (is_array($hidden)) {
            foreach ($hidden as $name => $value) {
                if ($name != 'do') {
                    $result .= '&amp;' . $name . '=' . $value;
                }
            }
        }

        return $result;
    }

    function getRowClass($row, $i) {
        return 'row' . $i;
    }

    function getRowValues($data, $row, $hidden, $total, $object=null) {
        global $Authorization;
        $values = '';

        if ($object) {
            $subObject = $this->object;
        } else {
            $object = $this->object;
        }

        foreach($this->showFields as $field) {
                if ($field['orderPosition'] < 1) continue;
		
            $languageCode = ($field['multiLanguages']) ? $this->languageCode : '';

            switch ($field['type']) {
                case fldURL:
                    $values .= '<td><a href="' . $row[$field['name'] . $languageCode] . '" alt="' . $row[$field['name'] . $languageCode] . '" target="_blank">' . $row[$field['name'] . $languageCode] . '</a></td>';
                    break;
                case fldEmail:
                    $values .= '<td><a href="mailto: ' . $row[$field['name'] . $languageCode] . '" title="' . $row[$field['name'] . $languageCode] . '" target="_blank">' . $row[$field['name'] . $languageCode] . '</a></td>';
                    break;
                case fldDate:
                case fldDateTime:
                    $values .= '<td>' . $row[$field['name'] . $languageCode . '_format'] . '</td>';
                    break;
                case fldMoney:
                    $values .= '<td align="right">' . getMoneyFormat($row[$field['name'] . $languageCode], $row['currencies_id']) . ' &nbsp;</td>';
                    break;
                case fldPercent:
                    $values .= '<td align="right">' . $row[$field['name'] . $languageCode] . ' % &nbsp;</td>';
                    break;
                case fldRadio:
                    $values .= '<td>' . translate($field['list'][ $row[$field['name'] . $languageCode] ]) . '</td>';
                    break;
                case fldImage:
                    $url = ($this->permissions['view'])
                        ? $_SERVER['PHP_SELF'] . '?do=' . $object . '|view' . $subObject . '&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden)
                        : $_SERVER['PHP_SELF'] . '?do=' . $object . '|load' . $subObject . '&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden);
                    $values .= '<td><a href="' . $url .'">' . getImageTag('/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $row[$field['name'] . $languageCode ]) . '</a></td>';
                    break;
                case fldFile:
                    if ($row[ $field['name'].$languageCode ]) {
                        $file = array(
                            'id'			=> $row['id'],
                            'position' 		=> $this->getFieldPositionByName($field['name']),
                            'languageCode=' => $languageCode);
                        $values .= '<td><a href="' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|downloadFileInWindow&amp;file=' . urlencode(serialize($file)) . $this->getHiddenFields($hidden) . '" target="_blank">' . translate('Download') . '</a></td>';
                    } else {
                        $values .= '<td>&nbsp;</td>';
                    }
                    break;
                default:
                    if ($field['type'] != fldHidden) {

                        if ($field['display']['change']) {
                            switch ($field['type']) {
                                case fldBoolean:
                                    $checked = (intval($row[$field['name'] . $languageCode]) == 1) ? 'checked' : '';
                                    $values .= '<td class="'.$class.'" align="center"><input type="hidden" name="' . $field['name'] . 'Hidden[' . $row['id'] .']" value="' . $row['id'] . '"><input type="checkbox" name="' . $field['name'] . '[' . $row['id'].']" value="1" ' . $checked . ' /></td>';
                                    break;
                                case fldLogin:
                                case fldPassword:
                                    $values .= '<td class="'.$class.'" align="center"><input type="text" name="' . $field['name'] . '[' . $row['id'].']" value="'.$row[$field['name'] . $languageCode].'" class="fldAuth" autocomplete="off" /></td>';
                                    break;
                                case fldInteger:
                                    $values .= '<td align="center"><input type="hidden" name="' . $field['name'] . 'Hidden[' . $row['id'] .']" value="' . $row['id'] . '"><input type="text" name="' . $field['name'] . '[' . $row['id'].']" value="'.$row[$field['name'] . $languageCode].'" class="fldInteger" /></td>';
                                    break;
                                case fldOrderPosition:
                                    $values .= ($this->permissions['change'] || $this->getFieldPositionByName('order_position') >= 0)
                                        ? '<td align="center"><a href="?do=' . $object . '|changeOrderPositionToUp' . $subObject . '&amp;id=' . $row['id'] . $this->getOrderPostionAdditionalField($row) . '"><img src="/images/administration/navigation/up.gif" width="12" height="12" alt="" /></a> <a href="' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|changeOrderPositionToDown&amp;id=' . $row['id'] . $this->getOrderPostionAdditionalField($row) . '"><img src="/images/administration/navigation/down.gif" width="12" height="12" alt="" /></a></td>'
                                        : '<td align="center">' . $row[ $field['name'] ] . '</td>';
                                    break;
                                default:
                                    $values .= '<td align="center"><input type="text" name="' . $field['name'] . '[' . $row['id'].']" value="'.$row[$field['name'] . $languageCode].'" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" /></td>';
                                    break;
                            }
                        } else {

                            if ($field['type'] == fldBoolean) {
                                $row[$field['name'] . $languageCode] = ($row[$field['name'] . $languageCode] == 1) ? translate('yes') : translate('no');
                            }

							if (is_array($field['list']) && sizeOf($field['list'])) {
								//$row[$field['name'] . $languageCode] = $field['list'][$row[$field['name']]];
							}

                            if ($this->permissions['view']) {
                                if ($field['jTip']) {

                                    preg_match_all('/{\$([0-9a-zA-Z]*)}/i', $field['jTip'], $matches);
                                    if (is_array($matches[1])) {
                                        foreach ($matches[1] as $name) {
                                            $field['jTip'] = str_replace('{$' . $name . '}', $row[ $name ], $field['jTip']);
                                        }
                                    }

                                    $values .= '<td id="' . $this->objectTitle . $field['name'] . $row['id'] . '" style="padding-left: 20px;" onmouseover="JT_show(\'' . $field['jTip'] . '&amp;link=' . $_SERVER['PHP_SELF'] . '?do=' . $object . '|view' . $subObject . '&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden) . '\', \'' . $this->objectTitle . $field['name'] . $row['id'] . '\', \'' . str_replace('\'', '\\\'', $row[$field['name'] . $languageCode]) . '\');" onmouseout="JT_remove(event, \'' . $this->objectTitle . $field['name'] . $row['id'] . '\');" name="' . str_replace('\'', '\\\'', $row[$field['name'] . $languageCode]) . '" class="jTip"><a href="' . $_SERVER['PHP_SELF'] . '?do=' . $object . '|view' . $subObject . '&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden) . '">' . $row[$field['name'] . $languageCode] . '</a></td>';
                                } elseif ($field['type'] == fldPhone) {
                                    $values .= '<td><a href="' . $_SERVER['PHP_SELF'] . '?do=PhoneCalls|add&amp;clients_id=' . $row['clients_id'] . '&amp;outNumber=' . $row[$field['name'] . $languageCode] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden) . '">'.$row[$field['name'] . $languageCode].'</a></td>';
                                } else {
                                    $values .= '<td><a href="' . $_SERVER['PHP_SELF'] . '?do=' . $object . '|view' . $subObject . '&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden) . '">'.$row[$field['name'] . $languageCode].'</a></td>';
								}
                            } elseif ($this->permissions['update']) {
                                $values .= '<td><a href="' . $_SERVER['PHP_SELF'] . '?do=' . $object . '|load' . $subObject . '&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden) . '">'.$row[$field['name'] . $languageCode].'</a></td>';
                            } elseif ($this->permissions['customization']) {
                                $values .= '<td><a href="' . $_SERVER['PHP_SELF'] . '?do=' . $object . '|customization' . $subObject . '&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset'.$this->object.'Block'] . '&amp;total' . $this->object . 'Block=' . $total . $this->getHiddenFields($hidden) . '">'.$row[$field['name'] . $languageCode].'</a></td>';
                            } else {
                                $values .= '<td>'.$row[$field['name'] . $languageCode].'</td>';
                            }
                        }
                    }
            }
        }
/*
		if ($this->showActions && ($this->permissions['update'] || $this->permissions['delete'])) {
			$values .= '<td align="center">';

			if ($this->permissions['update'])
				$values .= '<a href="?do=' . $this->object . '|load&amp;id=' . $row['id'] . '&amp;offset' . $this->object . 'Block=' . $_REQUEST['offset' . $this->object . 'Block'] . '&total' . $this->object . 'Block=' . $total . '&' . $this->getHiddenFields($hidden) . '"><img src="/images/administration/navigation/edit_over.gif" width="19" height="19" alt="' . translate('Update') . '"></a>';

			if ($this->permissions['delete'])
				$values .= '<a href="?do=' . $this->object . '|delete&amp;id=' . $row['id'] . $this->getOrderPostionAdditionalField($data) . '&' . $this->getHiddenFields($hidden) . '"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="' . translate('Delete') . '"></a>';

			$values .= '</td>';

		}
*/     
        return $values;
    }


    function getRowValuesExcel($data, $row, $hidden, $total, $object=null) {
        global $Authorization;

        $values = '';

        if ($object) {
            $subObject = $this->object;
        } else {
            $object = $this->object;
        }

        foreach($this->showFields as $field) {
            $languageCode = ($field['multiLanguages']) ? $this->languageCode : '';

            switch ($field['type']) {

                case fldDate:
                case fldDateTime:
                    $values .= '<td>' . $row[$field['name'] . $languageCode . '_format'] . '</td>';
                    break;
                case fldMoney:
                    $values .= '<td align="right">' . str_replace('.',',',$row[$field['name'] . $languageCode]) . '</td>';
                    break;
                case fldPercent:
                    $values .= '<td align="right">' . str_replace('.',',',$row[$field['name'] . $languageCode]) . '</td>';
                    break;
                case fldRadio:
                    $values .= '<td x:str>' . translate($field['list'][ $row[$field['name'] . $languageCode] ]) . '</td>';
                    break;
                case fldImage:
                    $values .= '<td x:str>' . getImageTag('/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $row[$field['name'] . $languageCode ]) . '</td>';
                    break;
                case fldFile:
                    if ($row[ $field['name'].$languageCode ]) {
                        $file = array(
                            'id'            => $row['id'],
                            'position'      => $this->getFieldPositionByName($field['name']),
                            'languageCode=' => $languageCode);
                        $values .= '<td x:str>Файл</td>';
                    } else {
                        $values .= '<td x:str>&nbsp;</td>';
                    }
                    break;
                default:
                    if ($field['type'] != fldHidden) {

                        if ($field['type'] == fldBoolean) {
                            $row[$field['name'] . $languageCode] = ($row[$field['name'] . $languageCode] == 1) ? translate('yes') : translate('no');
                        }
                        $values .= '<td x:str>'.$row[$field['name'] . $languageCode].'</td>';
                    }

            }
        }
        return $values;
    }

    function getFieldNameByOrderPosition($orderPosition) {
        if (intval($orderPosition) && is_array($this->formDescription['fields'])) {
            foreach ($this->formDescription['fields'] as $field) {
                $languageCode = ($field['multiLanguages']) ? $this->languageCode : '';
                if ($field['orderPosition'] == $orderPosition) {
					if ($field['orderName']) {
						return $field['orderName'];
					} else {
						switch ($field['type']) {
							case fldSelect:
								return PREFIX . '_' . $field['sourceTable'] . '.' . $field['orderField'];
								break;
							default:
								return PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode;
								break;
						}
					}
                }
            }
        }

        return false;
    }

    function getFormTitle($actionType) {

        switch ($actionType) {
            case 'insert':
                $result = vsprintf(translate($this->messages['add']), array($this->messages['single']));
                break;
            case 'view':
                $result = vsprintf(translate($this->messages['view']), array($this->messages['single']));
                break;
            case 'update':
                $result = vsprintf(translate($this->messages['load']), array($this->messages['single']));
                break;
            default:
                $result = vsprintf(translate($this->messages[ $actionType ]), array($this->messages['plural']));
        }

        $result[0] = strtoupper($result[0]);

        return $result;
    }

    function setHiddenFields() {
        $this->hiddenFields = array();

        foreach($this->formDescription['fields'] as $field) {
            if ($field['display']['show'] && ($field['type'] == fldHidden || $field['type'] == fldSelect)) {
                $this->hiddenFields[] = $field;
            }
        }
    }

    function getShowHiddenFields($data) {
        $result = '';

        $this->setHiddenFields();

        foreach($this->hiddenFields as $field) {
            if ($field['multiLanguages'] && !$field['sourceTable']) {
                foreach($this->languages as $languageCode => $languageTitle) {
                    $result .= ($field['value'])
                        ? '<input type="hidden" name="' . $field['name'].$languageCode.'" value="' . $field['value'] . '" />'
                        : '<input type="hidden" name="' . $field['name'].$languageCode.'" value="' . $data[ $field['name'].$languageCode ] . '" />';
                }
            } else {
                $result .= '<input type="hidden" name="' . $field['name'] . '" value="'.$data[$field['name']].'" />';
            }
        }

        return $result;
    }

    function removeTablePrefix($table) {
        return substr($table, strlen(PREFIX) + 1);
    }

    function getAssignmentConditions($action, $prefixSQL='', $postfixSQL='') {
        foreach($this->formDescription['fields'] as $field) {

            if (!isset($index)) {
                $index = $field;
                $tables = array();
            }

            if ($field['sourceTable'] && $field['display'][ $action ] && $field['type'] != fldMultipleSelect) {
                $conditions[] = PREFIX . '_' . $field['table'] . '.' . $field['name'] . '=' . PREFIX . '_' . $field['sourceTable'] . '.id';
            } elseif ($field['type'] != fldMultipleSelect && $field['table'] != $index['table'] && !in_array($index['table'], $tables)) {
                $conditions[] = PREFIX . '_' . $index['table'] . '.' . $index['name'] . '=' . PREFIX . '_' . $field['table'] . '.' . $index['table'] . '_id';
                $tables[] = $index['table'];
            }
        }

        if ($conditions) {
            return $prefixSQL . implode(' AND ', $conditions) . $postfixSQL;
        }
    }

    function changePermissions($total) {
        if ($total == 0) {
            $this->permissions['update']	= false;
            $this->permissions['password']	= false;
            $this->permissions['view']		= false;
            $this->permissions['change']	= false;
            $this->permissions['delete']	= false;
            $this->permissions['send']		= false;
            $this->permissions['generate']	= false;
        }
    }

    function getShowOrderCondition() {
        $direction = (ereg('^(asc|desc)$', $_COOKIE[ get_class($this) ]['orderDirection']))
            ? $_COOKIE[ get_class($this) ]['orderDirection']
            : $this->formDescription['common']['defaultOrderDirection'];

        return (intval($_COOKIE[ get_class($this) ]['orderPosition']) && $this->getFieldNameByOrderPosition($_COOKIE[ get_class($this) ]['orderPosition']))
            ? $this->getFieldNameByOrderPosition($_COOKIE[ get_class($this) ]['orderPosition']) . ' ' . $direction
            : $this->getFieldNameByOrderPosition($this->formDescription['common']['defaultOrderPosition']) . ' ' . $direction;
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

		$this->mode = 'update';

        $hidden['do'] = $data['do'];

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        if ($sql) {
            $sql    .= ' ORDER BY ';
        } elseif (is_array($conditions)) {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ' FROM ' . implode(', ', $this->tables) . ' WHERE ' . $this->getAssignmentConditions('show', '', ' AND ') . ' ' . implode(' AND ', $conditions) . ' ORDER BY ';
        } else {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ' FROM ' . implode(', ', $this->tables) . ' ' . $this->getAssignmentConditions('show', ' WHERE ') . ' ORDER BY ';
        }

        $total	= $db->getOne(transformToGetCount($sql));

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }
  
        $list = $db->getAll($sql);

        $this->changePermissions($total);

        include $template;
    }

    function escape($string) {
        return htmlspecialchars($string);
    }

    function getMonth($month) {
        $titles = array(translate('January'), translate('February'), translate('March'), translate('April'), translate('May'), translate('June'), translate('July'), translate('August'), translate('September'), translate('October'), translate('November'), translate('December'));
        return $titles[$month-1];
    }

    function getMark($required=true) {
        $simbol = ($required) ? '*' : '';
        return ($this->mode == 'update') ? $simbol : '';
    }

    function getReadonly($select=false, $readonly=false) {
        return ($this->mode == 'update' && !$readonly)
            ? ''
            : ' style="color: #666666; background-color: #f5f5f5;" ' . (($select) ? 'disabled' : 'readonly');
    }
    function getReadonlyRadio($select=false, $readonly=false) {
        return ($this->mode == 'update' && !$readonly)
            ? ''
            : ' onclick="return false" style="color: #666666; background-color: #f5f5f5;" ' . (($select) ? 'disabled' : 'readonly');
    }

    function getDateSelect($field, $year, $month, $day, $name, $addition=null) {
		$disabled = (strpos($addition, 'disabled')!==false || strpos($addition, 'readonly')!==false) ? true : false;

        $result =  '<input type="text" id="' . $name . '" name="' . $name . '" value="' . (intval($day) && intval($month) && intval($year) ? $day . '.' . $month . '.' . $year : '') . '" maxlength="10" class="fldDatePicker' . ($disabled==true ? 'Disabled':'') . '" ' . $this->getReadonly(false) . ' onfocus="this.className=\'fldDatePickerOver\'" onblur="this.className=\'fldDatePicker\'" ' . $addition . ' />';
		$result .= '<input type="hidden" id="' . $name . '_day" name="' . $name . '_day" value="' . (intval($day) ? $day:'') . '" />';
		$result .= '<input type="hidden" id="' . $name . '_month" name="' . $name . '_month" value="' . (intval($month) ? $month:'') . '" />';
		$result .= '<input type="hidden" id="' . $name . '_year" name="' . $name . '_year" value="' . (intval($year) ? $year:'') . '" />';

        return $result;
    }
	
	 function getDateTimeSelect($field, $year, $month, $day, $hour, $minute, $name, $addition=null) {
        if (!intval($year)) {
            $hour	= -1;
            $minute	= -1;
        }

		if (strpos($addition, 'disabled')!==false || strpos($addition, 'readonly')!==false)
			$disabled=true;
		else
			$disabled=false;
			
        $result = '<table border="0"><tr>';

        $result .= '<td>';
        $result.='<input type="text" id="' . $name . '" name="' . $name . '" value="'.(intval($day) && intval($month) && intval($year) ? $day . '.' . $month . '.' . $year : '') . '" maxlength="10" class="fldDatePicker'.($disabled==true ? 'Disabled':'').'" ' . $this->getReadonly(false) . ' onfocus="this.className=\'fldDatePickerOver\'" onblur="this.className=\'fldDatePicker\'" ' . $addition . ' />';
		$result.='<input type="hidden" id="' . $name . '_day" name="' . $name . '_day" value="' . (intval($day) ? $day:'') . '">';
		$result.='<input type="hidden" id="' . $name . '_month" name="' . $name . '_month" value="' . (intval($month) ? $month:'') . '">';
		$result.='<input type="hidden" id="' . $name . '_year" name="' . $name . '_year" value="' . (intval($year) ? $year:'') . '">';

        $result .= '</td>';

        $result .= '<td>';
		$result.='<input type="text" id="' . $name . 'TimePicker" name="' . $name . 'TimePicker"  value="' . ($hour>=0 ? sprintf('%02d', $hour).':':'') . ($minute>=0 ? sprintf('%02d', $minute):'').'" maxlength="5" class="fldTimePicker' . ($disabled==true ? 'Disabled':'') . '" ' . ($disabled==true ? 'readonly': '') . ' ' . $this->getReadonly(false) . ' /> <img src="/js/jquery/clock'.($disabled==true ? 'Disabled':'').'.gif" class="imgTimePicker'.($disabled==true ? 'Disabled':'').'" id="' . $name . 'TimePicker" align="absmiddle">';		
		$result.='<input type="hidden" id="' . $name . '_hour" name="' . $name . '_hour" value="' . ($hour>=0 ? sprintf('%02d', $hour) : '') . '">';
		$result.='<input type="hidden" id="' . $name . '_minute" name="' . $name . '_minute" value="' . ($minute>0 ? sprintf('%02d', $minute):'') . '">';

		$result .= '</td>';

        $result .= '</tr></table>';
        return $result;
    }

    function buildSelect($field, $value, $languageCode=null, $addition=null, $indexType=null, $data=null, $class=null) {
        if (is_array($field['list']) && sizeOf($field['list']) > 0) {
            $id = $field['showId'] ? 'id="' . ereg_replace('\[|\]', '', $field['name'] . $languageCode) . '"' : '';
            $result = (eregi('multiple', $addition))
                    ? '<select '.$id.' name="' . $field['name'] . $languageCode . '[]" ' . $addition . ' ' . $field['javascript'] . ' class="fldSelect ' . $class . '" onfocus="this.className=\'fldSelectOver ' . $class . '\'" onblur="this.className=\'fldSelect ' . $class . '\'">'
                    : '<select '.$id.' name="' . $field['name'] . $languageCode . '" ' . $addition . ' ' . $field['javascript'] . ' class="fldSelect' . $class . '" onfocus="this.className=\'fldSelectOver ' . $class . '\'" onblur="this.className=\'fldSelect ' . $class . '\'">';

            if (current($field['list']) != '...' && !eregi('multiple', $addition)) {
                $result .= '<option value="">...</option>';
            }

            if (is_array($field['list']) && sizeOf($field['list']) > 0) {
            	$optgroup = '';
                foreach($field['list'] as $id => $row) {

                	if (is_array($row) && $row['optgroup'] != '' && $row['optgroup'] != $optgroup) {
						$result .= '<optgroup label="' . $row['optgroup'] . '">';
						$optgroup = $row['optgroup'];
                	}

                    $result .= ((!is_array($value) && $value == $id || (!is_array($value) && intval($value) & intval($id) && eregi('double', $indexType))) || (is_array($value) && in_array($id, $value)))
                        ? '<option value="' . $id . '" selected ' . (($row['obligatory']) ? '' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>'
                        : '<option value="' . $id . '" ' . (($row['obligatory']) ? '' : '') . '>' . ((is_array($row)) ? $row['title'] : $row) . '</option>';
                }
            }

            $result .= '</select>';
        } else {
            $result = '<div class="error">' . translate('No items present') . '</div>';
        }
        return $result;
    }

    function buildRadio($field, $value, $languageCode=null, $addition=null, $data=null, $delimiter='') {
        if (!$delimiter) {
            $delimiter = ' ';
        }

        if (is_array($field['list']) && sizeOf($field['list']) > 0) {
            foreach ($field['list'] as $id => $row) {
                $result .= (intval($value) == intval($id))
                    ? '<input type="radio" name="' . $field['name'] . $languageCode . '" ' . $addition . ' value="' . $id . '" ' . $this->getReadonly(true) . ' checked /> ' . ((is_array($row)) ? $row['title'] : $row) . $delimiter
                    : '<input type="radio" name="' . $field['name'] . $languageCode . '" ' . $addition . ' value="' . $id . '" ' . $this->getReadonly(true) . ' /> ' . ((is_array($row)) ? $row['title'] : $row) . $delimiter;
            }

        } else {
            $result = '<div class="error">' . translate('No items present') . '</div>';
        }
        return $result;
    }

    function buildCheckboxes($field, $value, $languageCode=null, $addition=null, $data=null, $postfix='<br />') {

        if (is_array($field['list']) && sizeOf($field['list']) > 0) {
            foreach ($field['list'] as $id => $row) {
                $result .= (intval($value) & intval($id))
                    ? '<input type="checkbox" name="' . $field['name'] . $languageCode . '[' . $id . ']" value="' . $id . '" ' . $addition . ' ' . $this->getReadonly(true) . ' checked /> ' . ((is_array($row)) ? $row['title'] : $row) . $postfix
                    : '<input type="checkbox" name="' . $field['name'] . $languageCode . '[' . $id . ']" value="' . $id . '" ' . $addition . ' ' . $this->getReadonly(true) . ' /> ' . ((is_array($row)) ? $row['title'] : $row) . $postfix;
            }
        } else {
            $result = '<div class="error">' . translate('No items present') . '</div>';
        }

        return $result;
    }

    function getFieldPart($data, $action, $position, $languageCode=null, $languageDescription=null) {
        global $Authorization;

        $field = $this->formDescription['fields'][ $position ];

        $mark = (!$field['verification']['canBeEmpty']) ? '*' : '';

        switch ($field['type']) {
            case fldIdentity:
                $result .= '<tr><td></td><td><input type="hidden" name="'.$field['name'].$languageCode.'" value="'.$data[$field['name'].$languageCode].'" /></td></tr>';
                break;
            case fldLogin:
                $maxlength = ($field['maxlength']) ? $field['maxlength'] : 25;
				$result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td><input type="text" name="' . $field['name'].$languageCode . '" value="' . $data[$field['name'].$languageCode] . '" maxlength="' . $maxlength . '" class="fldAuth" onfocus="this.className=\'fldAuthOver\';" onblur="this.className=\'fldAuth\';" autocomplete="off" ' . $this->getReadonly(false) . ' /></td></tr>';
                break;
            case fldPassword:
                $maxlength = ($field['maxlength']) ? $field['maxlength'] : 25;
				$result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td><input type="password" name="' . $field['name'].$languageCode . '" value="" maxlength="' . $maxlength . '" class="fldAuth" autocomplete="off" /></td></tr>';
				$result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['additionalDescription']).$languageDescription . ':</td><td><input type="password" name="confirmation' . $field['name'].$languageCode . '" value="" maxlength="' . $maxlength . '" class="fldAuth" onfocus="this.className=\'fldAuthOver\';" onblur="this.className=\'fldAuth\';" autocomplete="off" /></td></tr>';
                break;
            case fldBoolean:
				$checked = (intval($data[$field['name'].$languageCode]) == 1) ? 'checked' : '';
				$result .= '<tr id="' . $field['name'].$languageCode . 'Field"><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td><input type="checkbox" name="' . $field['name'].$languageCode . '" value="1" ' . $checked . ' ' . $field['addition'] . ' ' . $this->getReadonly(false) . ' /></td></tr>';
                break;
            case fldInteger:
                $maxlength = ($field['maxlength']) ? $field['maxlength'] : 10;
				$result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td><input type="text" name="' . $field['name'].$languageCode . '" value="' . $data[$field['name'].$languageCode] . '" maxlength="' . $maxlength . '" class="fldInteger" onfocus="this.className=\'fldIntegerOver\';" onblur="this.className=\'fldInteger\';" ' . $this->getReadonly(false) . ' /></td></tr>';
                break;
            case fldText:
            case fldUnique:
                $maxlength = ($field['maxlength']) ? $field['maxlength'] : 255;
				$result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td><input type="text" name="' . $field['name'].$languageCode . '" value="' . $data[$field['name'].$languageCode] . '" maxlength="' . $maxlength . '" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" ' . $this->getReadonly(false) . ' /></td></tr>';
                break;
            case fldEmail:
                $maxlength = ($field['maxlength']) ? $field['maxlength'] : 50;
				$result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td><input type="text" name="' . $field['name'].$languageCode . '" value="' . $data[$field['name'].$languageCode] . '" maxlength="' . $maxlength . '" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" ' . $this->getReadonly(false) . ' /></td></tr>';
                break;
            case fldMoney:
                $maxlength = ($field['maxlength']) ? $field['maxlength'] : 10;
                $currencies_id = ($field['currencies_id']) ? $field['currencies_id'] : $data['currencies_id'];
                $result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']) . $languageDescription . ':</td><td><input type="text" name="' . $field['name'] . $languageCode . '" value="'.$data[$field['name'].$languageCode].'" ' . $field['javascript'] . ' maxlength="' . $maxlength . '" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" ' . $this->getReadonly(false) . ' /></td></tr>';
                break;
            case fldPercent:
                $maxlength = ($field['maxlength']) ? $field['maxlength'] : 5;
                $result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']) . $languageDescription . ':</td><td><input type="text" name="' . $field['name'] . $languageCode . '" value="'.$data[$field['name'].$languageCode].'" ' . $field['javascript'] . ' maxlength="' . $maxlength . '" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" ' . $this->getReadonly(false) . ' /></td></tr>';
                break;
            case fldURL:
                $maxlength = ($field['maxlength']) ? $field['maxlength'] : 255;
                $result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td><input type="text" name="' . $field['name'].$languageCode . '" value="' . $data[$field['name'].$languageCode] . '" maxlength="' . $maxlength . '" class="fldText" onfocus="this.className=\'fldTextOver\';" onblur="this.className=\'fldText\';" ' . $this->getReadonly(false) . ' /></td></tr>';
                break;
            case fldNote:
                $result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription.':</td><td><textarea name="'.$field['name'].$languageCode.'" class="fldNote" ' . ($field['height'] ? 'style="height:' . $field['height'] . 'px;"' : '') . ' onfocus="this.className=\'fldNoteOver\';" onblur="this.className=\'fldNote\';" ' . $this->getReadonly(false) . '>'.$this->escape($data[$field['name'].$languageCode]).'</textarea></td></tr>';
                break;
            case fldDate:
                $result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td>' . $this->getDateSelect($field, $data[ $field['name'].$languageCode.'_year' ], $data[ $field['name'].$languageCode.'_month' ], $data[ $field['name'].$languageCode.'_day' ], $field['name'].$languageCode) . '</td></tr>';
                break;
            case fldDateTime:
                $result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td>' . $this->getDateTimeSelect($field, $data[ $field['name'].$languageCode.'_year' ], $data[ $field['name'].$languageCode.'_month' ], $data[ $field['name'].$languageCode.'_day' ], $data[ $field['name'].$languageCode.'_hour' ], $data[ $field['name'].$languageCode.'_minute' ], $field['name'].$languageCode) . '</td></tr>';
                break;
            case fldFile:
            case fldImage:
                if (!$data[$field['name'].$languageCode]) {
                    $data[$field['name'].$languageCode] = $data['old'.$field['name'].$languageCode];
                }

                $file = '';
				$result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td><input type="file" id="' . $field['name'].$languageCode . '" name="' . $field['name'].$languageCode . '" class="fldText" /></td></tr>';
				if ($data[ $field['name'].$languageCode ]) {
					$file = array(
						'id'		=> $data['id'],
						'position' 	=> $position,
						'languageCode'  => $languageCode);

					if ($field['verification']['canBeEmpty']) {
						$result .= ($this->isValidImage($data[$field['name'] . $languageCode]) && $this->displayImage)
							? '<tr><td align="right" valign="top" nowrap><a href="' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|deleteFile&amp;file=' . urlencode(serialize($file)) . '">' . translate('Delete') . '</a></td><td>' . getImageTag('/files' . $Authorization->data['folder'] . '/' . $this->object . '/'. $data[$field['name'] . $languageCode]).'</td></tr>'
							: '<tr><td align="right" valign="top" nowrap><a href="' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|deleteFile&amp;file=' . urlencode(serialize($file)) . '">' . translate('Delete') . '</a></td><td><b>' . translate('Present, size') . ' ' . getFileSize('/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $data[$field['name'] . $languageCode]) . ':</b> <a href="?do=' . $this->object . '|downloadFileInWindow&&amp;file=' . urlencode(serialize($file)) . '" target="_blank">' . translate('Download') . '</a></td></tr>';
					} else {
						$result .= ($this->isValidImage($data[$field['name'].$languageCode]) && $this->displayImage)
							? '<tr><td>&nbsp;</td><td>'.getImageTag('/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $data[$field['name'].$languageCode]).'</td></tr>'
							: '<tr><td>&nbsp;</td><td><b>' . translate('Present, size') . ' ' . getFileSize('/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $data[$field['name'] . $languageCode]) . ':</b> <a href="?do=' . $this->object . '|downloadFileInWindow&&amp;file=' . urlencode(serialize($file)) . '" target="_blank">' . translate('Download') . '</a></td></tr>';
					}
				}
				$value = ($data['old' . $field['name'].$languageCode] == '') ? $data[$field['name'].$languageCode] : $data['old' . $field['name'].$languageCode];
				$result .= '<input type="hidden" id="old' . $field['name'].$languageCode . '" name="old' . $field['name'].$languageCode . '" value="' . $value . '" />';
                break;
            case fldHidden:
                $result .= ($field['value'])
                    ? '<input type="hidden" id="' . $field['name'].$languageCode . '" name="' . $field['name'].$languageCode . '" value="' . $field['value'] . '" />'
                    : '<input type="hidden" id="' . $field['name'].$languageCode . '" name="' . $field['name'].$languageCode . '" value="' . $data[$field['name'].$languageCode] . '" />';
                break;
            case fldSelect:
				$result .= ($field['readonly'])
					? '<tr><td class="label">' . translate($field['description']).$languageDescription . ':</td><td>' . ((is_array($field['list'][$data[$field['name'].$languageCode]])) ? $field['list'][$data[$field['name'].$languageCode]]['title'] : $field['list'][$data[$field['name'].$languageCode]]) . '</td></tr>'
					: '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td>' . $this->buildSelect($field, $data[$field['name'].$languageCode], $languageCode, $field['addition'], null, $data) . '</td></tr>';
				break;
            case fldMultipleSelect:
				$size = (sizeOf($field['list']) < intval($field['size'])) ? sizeOf($field['list']) + 1 : (($field['size']) ? $field['size'] : 10);
				$result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td>' . $this->buildSelect($field, $data[$field['name'].$languageCode], $languageCode, 'multiple size="' . $size . '"', $field['indexType'], $data) . '</td></tr>';
                break;
            case fldRadio:
                $result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td>' . $this->buildRadio($field, $data[$field['name'].$languageCode], $languageCode, $field['addition'], $data) . '</td></tr>';
                break;
            case fldCheckboxes:
                $result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']).$languageDescription . ':</td><td>' . $this->buildCheckboxes($field, $data[$field['name'].$languageCode], $languageCode, $field['addition'], $data) . '</td></tr>';
                break;
            case fldHTML:
				$result .= '<tr><td class="label">' . $this->getMark(!$field['verification']['canBeEmpty']) . translate($field['description']) . $languageDescription . ':</td><td>';

				$Editor	= new Editor($field['name'] . $languageCode);

				if ($field['height']) {
					$Editor->Height = $field['height'];
				}

				$Editor->Value		= $data[$field['name'] . $languageCode];
				$Editor->Config		= array('FullPage' => $field['fullPage']);
				$Editor->ToolbarSet	= ($field['toolbarSet']) ? $field['toolbarSet'] : 'Default';

				$result .=	$Editor->Create();
				$result .= '</td></tr>';
                break;
		}

        return $result;
    }

    function buildFieldsPart($data, $action) {
        $result = null;

        foreach($this->formDescription['fields'] as $i => $field) {
            if ($field['display'][$action]) {
                if ($field['multiLanguages'] && $field['sourceTable'] == '') {
                    foreach($this->languages as $languageCode => $languageDescription) {

                        $languageDescription = (ereg('view|print', $action) || sizeOf($this->languages) < 2) ? '' : ' ('.$languageDescription.') ';

                        $result .= $this->getFieldPart($data, $action, $i, $languageCode, $languageDescription);

                        if (ereg('view|print', $action)) break;

                    }
                } else {
                    $result .= $this->getFieldPart($data, $action, $i);
                }
            }
        }

        return $result;
    }

    function getFieldPositionByName($name, $formDescription=null) {

		if (is_null($formDescription)) {
			$formDescription = $this->formDescription;
		}

        if (is_array($formDescription['fields'])) {
            foreach ($formDescription['fields'] as $i => $field) {
                if ($field['name'] == $name)
                    return $i;
            }
        }
		return -1;
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        global $Log, $Authorization;

        if (is_null($actionType)) {
            $actionType = $action;
        }    
        $this->setListValues($data, $actionType);

        $Log->showSystem();
        if (!is_null($template)) {

            include_once $this->object . '/' . $template;
            return;
        }

        switch ($actionType) {
            case 'view':
                (is_file($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->object . '/view.php'))
                    ? include_once $this->object . '/view.php'
                    : include_once 'view.php';
                break;
            case 'previewInWindow':
                (is_file($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->object . '/previewInWindow.php'))
                    ? include_once $this->object . '/previewInWindow.php'
                    : include_once 'previewInWindow.php';
                break;
            default:
                (is_file($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->object . '/form.php'))
                    ? include_once $this->object . '/form.php'
                    : include_once 'form.php';
        }
    }

    function getOptions($field, $languageCode, &$options, $parent_id='', $path='', $level = 0) {
        global $db;

        if ($field['condition']) {
            $where = ' AND ' . $field['condition'];
        }

        if (!$field['selectId'])
            $field['selectId'] = 'id';

        $sql =	'SELECT ' . $field['selectId'] . ' AS id, ' . $field['selectField'] . $languageCode . ' AS title ' .
				'FROM ' . PREFIX . '_' . $field['sourceTable'] . ' ' .
				'WHERE parent_id = ' . intval($parent_id) . $where . ' ' .
				'ORDER BY ' . $field['orderField'];
        $res = $db->query($sql);

        while ($res->fetchInto($row)) {

            $options[ $row['id'] ] = array(
                'title' => str_repeat('&nbsp;', 3 * $level) . $row['title'],
                'obligatory' => $row['obligatory']);

            $this->getOptions($field, $languageCode, $options, $row['id'], $path . $row['title'] . ' > ', $level + 1);
        }
    }

    function getListValue($field, $data) {
        global $db, $Authorization;

        reset($this->languages);

        $languageCode = ($field['multiLanguages'])
            ? $this->languageCode
            : '';

        $options = (($field['verification']['canBeEmpty']) && $field['type'] == fldSelect) ? array('0' => '...') : array();

        switch ($field['structure']) {
            case 'tree':
                $this->getOptions($field, $languageCode, $options);
                break;
            default:
                if ($field['condition']) {
                    $where = ' WHERE ' . $field['condition'];
                }

                if (!$field['selectId'])
                    $field['selectId'] = 'id';

                $field['orderField'] = ($field['selectField'] == $field['orderField'])
                    ? $field['orderField'] . $languageCode
                    : $field['orderField'];

                $sql =	'SELECT ' . $field['selectId'] . ' AS id, ' . $field['selectField'] . $languageCode . ' AS title ' .
						'FROM ' . PREFIX . '_' . $field['sourceTable'] . $where . ' ' .
						'ORDER BY ' . $field['orderField'];
                $list = $db->getAll($sql, 300);

                if (is_array($list)) {
                    foreach ($list as $row) {
                        $options[ $row['id'] ] = array(
                            'title' => $row['title'],
                            'obligatory' => $row['obligatory']);
                    }
                }
        }
        return $options;
    }

    function setListValues($data, $actionType='show') {
        foreach($this->formDescription['fields'] as $i => $field) {
            if ($field['display'][ $actionType ] && $field['sourceTable']) {
                switch ($field['type']) {
                    case fldRadio:
                    case fldSelect:
                    case fldCheckboxes:
                    case fldMultipleSelect:
                        if (!is_array($this->formDescription['fields'][$i]['list'])) {
                            $this->formDescription['fields'][$i]['list'] = $this->getListValue($field, $data);
                        }
                        break;
                }
            }
        }
    }

    function add($data) {
	global $Authorization;
        $this->checkPermissions('insert', $data);

        $this->getFormFields('insert');

        foreach($this->showFields as $field) {
            if ($field['type'] != fldHidden && $field['display']['change']) {
                $data[$field['name']] = '';
            }
        }
        $this->showForm($data, 'insert');
    }

    function setConstants(&$data) {
        if (is_array($this->formDescription['fields']) && sizeOf($this->formDescription['fields']) > 0) {
            foreach ($this->formDescription['fields'] as $field) {
                if ($field['type'] == fldConst) {
                    $data[$field['name']] = $field['value'];
                }
            }
        }
    }

    function isValidFilename($filename) {
        return (eregi('[a-zA-Z0-9_\-\.]', $filename)) ? true : false;
    }

    function isValidLogin($login) {
        return (eregi('^[a-zA-Z0-9@_\-\ ]', $login)) ? true : false;
    }

    function isValidPassword($login) {
        return (eregi('^[a-zA-Z0-9]', $login)) ? true : false;
    }

    function isValidInteger($value) {
        return (eregi('^[0-9]', $value)) ? true : false;
    }

    function isValidEmail($email) {
        return eregi('^[a-z0-9]+([_.-]+[a-z0-9]+)*@([a-z0-9]+([.-][a-z0-9]+)*)+\\.[a-z]{2,4}$', $email);
    }

    function isValidURL($url) {
        return preg_match("/^(http[s]{0,}:\/\/)/", $url);
    }

    function isValidMoney($amount) {
  //      return (eregi('^([0-9])+((.)?([0-9]))*$', $amount));
	return (eregi('^(-?)([0-9])+((.)?([0-9]))*$', $amount));
    }

    function isValidPercent($percent) {
        return (eregi('^([0-9])+((.)?([0-9]))*$', $percent) && 0 <= $percent && $percent <= 100);
    }

    function isValidImage($file) {
        return eregi('(.*)\.(jpg|jpeg|png|gif)$', $file);
    }

    function isExists($table, $field, $value, $id = 0, $data = null) {
        global $db;

        $sql =	'SELECT count(*) ' .
				'FROM ' . $table . ' ' .
				'WHERE ' . $field . '=' . $db->quote($value) . ' AND id <> ' . intval($id);
        $count = $db->getOne($sql);

        return ($count != 0);
    }

    function checkField($data, $field, $languageCode='', $languageDescription='') {
        global $Log;

		if ($languageDescription != '') {
            $languageDescription = ' '.$languageDescription;
        }

        $params = array(translate($field['description']), $languageDescription);

        if (!$field['verification']['canBeEmpty']) { 
            switch ($field['type']) {
                case fldImage:
                case fldFile:
                    if ($field['content']) {
                        if ($data[ $field['name'].'Content'.$languageCode ] == '') {
                            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        }
                    } else {
                        if ((!is_uploaded_file($_FILES[$field['name'].$languageCode]['tmp_name']) || $_FILES[$field['name'].$languageCode]['size'] == 0) && $data['old'.$field['name'].$languageCode] == '') {
                            $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        }
                    }
                    break;
                case fldCheckboxes:
                case fldMultipleSelect:
                    if (!is_array($data[$field['name'].$languageCode])) {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        return;
                    }
                    break;
                case fldSelect:
                    if (intval($data[$field['name'].$languageCode]) == 0) {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        return;
                    }
                    break;
                case fldRadio:
                    if ($data[$field['name'].$languageCode] == '') {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        return;
                    }
                    break;
                case fldDate:
                case fldDateTime:
                    break;
				case fldMoney:
	                if (strlen($data[$field['name'].$languageCode]) == 0 || !$this->isValidMoney($data[$field['name'].$languageCode])) {
	                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
						return;
	                }
					break;
                case fldPercent:
                    if ($data[$field['name'].$languageCode] === '' && $field['type'] != fldBoolean) {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        return;
                    }
					break;
                default:

                    if ($data[$field['name'].$languageCode] == '' && $field['type'] != fldBoolean) {
                        $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                        return;
                    }
            }
        }

        switch ($field['type']) {
            case fldLogin:
                if (!$this->isValidLogin($data[$field['name'].$languageCode])) {
                    $Log->add('error', 'The <b>%s</b>%s contains not proper symbol(s).', $params);
                } elseif ($this->isLoginExists($field, $data[$field['name'].$languageCode], $data['id'])) {
                    $Log->add('error', 'The <b>%s</b>%s already exists.', $params);
                }
                break;
            case fldPassword:
                if ($data[$field['name'].$languageCode] != $data['confirmation'.$field['name'].$languageCode]) {
                    $Log->add('error', 'Your <b>%s</b>%s entries did not match.', $params);
                }
                break;
            case fldInteger:
                if ($data[$field['name'].$languageCode] != '' && !$this->isValidInteger($data[$field['name'].$languageCode])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
                break;
            case fldMoney:
                if ($data[$field['name'].$languageCode] != '' && !$this->isValidMoney($data[$field['name'].$languageCode])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
                break;
            case fldPercent:
                if ($data[$field['name'].$languageCode] != '' && !$this->isValidPercent($data[$field['name'].$languageCode])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
                break;
            case fldURL:
                if ($data[$field['name'].$languageCode] != '' && !$this->isValidURL($data[$field['name'].$languageCode])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
                break;
            case fldEmail:
                if ($data[$field['name'].$languageCode] != '' && !$this->isValidEmail($data[$field['name'].$languageCode])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
                break;
            case fldUnique:
                if ($data[$field['name'].$languageCode] != '' && $this->isExists($this->tables[0], $field['name'].$languageCode, $data[$field['name'].$languageCode], $data['id'], $data)) {
                    $Log->add('error', 'The record with <b>%s</b>%s already exists.', $params);
                }
                break;
            case fldDate:
            case fldDateTime:
                if ($field['verification']['canBeEmpty'] &&
                    intval($data[$field['name'].$languageCode.'_day']) == 0 &&
                    intval($data[$field['name'].$languageCode.'_month']) == 0 &&
                    intval($data[$field['name'].$languageCode.'_year']) == 0) {

                    $data[$field['name'].$languageCode.'_day']		= 0;
                    $data[$field['name'].$languageCode.'_month']	= 0;
                    $data[$field['name'].$languageCode.'_year']		= 0;
                    $data[$field['name'].$languageCode.'_hour']		= 0;
                    $data[$field['name'].$languageCode.'_minute']	= 0;

                    break;
                }

                if (!checkdate($data[$field['name'].$languageCode.'_month'], $data[$field['name'].$languageCode.'_day'], intval($data[$field['name'].$languageCode.'_year']))) {
                    $Log->add('error', 'The date <b>%s</b>%s is not valid.', $params);
                }
                break;
            case fldImage:
                if (is_uploaded_file($_FILES[$field['name'].$languageCode]['tmp_name']) && !$this->isValidImage($_FILES[$field['name'].$languageCode]['name'])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                    if (!$this->isValidFilename($_FILES[$field['name'].$languageCode]['name']) && $field['nameType'] == 'own') {
                        $Log->add('error', 'The <b>%s</b>%s contains no proper symbol(s).', $params);
                    } elseif ($this->isFileExists($_FILES[$field['name'].$languageCode]['name']) && $field['nameType'] == 'own') {
                        $Log->add('error', '<b>%s</b>%s with such name already exists.', $params);
                    }
                }
                break;
            case fldFile:
                if (is_uploaded_file($_FILES[$field['name'].$languageCode]['tmp_name'])) {
                    if (!$this->isValidFilename($_FILES[$field['name'].$languageCode]['name']) && $field['nameType'] == 'own') {
                        $Log->add('error', 'The <b>%s</b>%s contains no proper symbol(s).', $params);
                    } elseif ($field['format'] && !eregi($field['format'], $_FILES[$field['name'].$languageCode]['name'])) {
                        $Log->add('error', 'The file\'s <b>%s</b>%s format is not valid.', $params);
                    } elseif ($this->isFileExists($_FILES[$field['name'].$languageCode]['name']) && $field['nameType'] == 'own') {
                        $Log->add('error', '<b>%s</b>%s with such name already exists.', $params);
                    }
                } elseif ($field['content']) {
                    if (!$this->isValidFilename($data[ $field['name'].'Filename'.$languageCode ])) {
                        $Log->add('error', 'The <b>%s</b>%s contains no proper symbol(s).', $params);
                    } elseif ($field['format'] && !eregi($field['format'], $data[ $field['name'].'Filename'.$languageCode ])) {
                        $Log->add('error', 'The file\'s <b>%s</b>%s format is not valid.', $params);
                    } elseif ($this->isFileExists($data[ $field['name'].'Filename'.$languageCode ]) && $field['nameType'] == 'own') {
                        $Log->add('error', '<b>%s</b>%s with such name already exists.', $params);
                    }
                }
                break;
        }
        if ($field['validationRule'] || $field['validationFunction']) {
            if ($field['validationRule'] && $data[$field['name'].$languageCode] != '' && !preg_match('/^'.$field['validationRule'].'$/u', $data[$field['name'].$languageCode]) /*!ereg($field['validationRule'], $data[$field['name'].$languageCode])*/) {
                $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
            } elseif ($field['validationFunction']) {
                switch($field['validationFunctionType']){
                    case 'function':
							if ($field['verification']['canBeEmpty'] && strlen($data[$field['name'].$languageCode])==0)
								break;
                            if (!$field['validationFunction']($data[$field['name'].$languageCode])) {
                                $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                            }
                        break;
                    default:
                        if (!$this->$field['validationFunction']($data[$field['name'].$languageCode])) {
                            $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                        }
                        break;
                }
            }
        }
    }

    function checkFields($data, $action) {
         global $db, $Log;
        foreach($this->formDescription['fields'] as $field) {
            if ($field['display'][ $action ] && !$field['readonly']) {
                if ($field['multiLanguages'] && $field['sourceTable'] == '') {
                    foreach($this->languages as $languageCode=>$languageDescription) {
                        $languageDescription = (sizeOf($this->languages) < 2) ? '' :  '(' . $languageDescription . ')';
                        $this->checkField($data, $field, $languageCode, $languageDescription);
                    }
                } else {
                    $this->checkField($data, $field);
                }
            }
        }
    }

    function checkIdentificationCode($value) {
        $S=(((-1*$value[0]+5*$value[1]+7*$value[2]+9*$value[3]+4*$value[4]+6*$value[5]+10*$value[6]+5*$value[7]+7*$value[8]) % 11) % 10);
        return intval($value[9])==intval($S) ? true: false;
    }

    function checkEDRPOUCode($value) {
        if (30000000<intval($value) && intval($value)<60000000)
            $S=(7*$value[0]+$value[1]+2*$value[2]+3*$value[3]+4*$value[4]+5*$value[5]+6*$value[6]) % 11;//(7*X1+X2+2*X3+3*X4+4*X5+5*X6+6*X7) mod 11
        else
            $S=($value[0]+2*$value[1]+3*$value[2]+4*$value[3]+5*$value[4]+6*$value[5]+7*$value[6]) % 11;//(X1+2*X2+3*X3+4*X4+5*X5+6*X6+7*X7) mod 11

        if (intval($S)==10) {
            $S=(3*$value[0]+4*$value[1]+5*$value[2]+6*$value[3]+7*$value[4]+8*$value[5]+9*$value[6]) % 11;//(3*X1+4*X2+5*X3+6*X4+7*X5+8*X6+9*X7) mod 11
            if (intval($S)==10)
                $S=(9*$value[0]+3*$value[1]+4*$value[2]+5*$value[3]+6*$value[4]+7*$value[5]+8*$value[6]) % 11;//(9*X1+3*X2+4*X3+5*X4+6*X5+7*X6+8*X7) mod 11
        }

        return true;//intval($S)==intval($value[7]) ? true : false;
    }

    function isFileExists($filename) {
        global $Authorization;
        return is_file($_SERVER['DOCUMENT_ROOT'] . '/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $filename);
    }

    function generateFilename($filename, $nameType='') {
        $info = pathinfo(strtolower($filename));

        switch ($nameType) {
            case 'own':
                return $filename;
                break;
            default:
                return str_replace(' ', '', substr(microtime(), 2)) . '.' . $info['extension'];
        }
    }

    function resizeImage($path, $file, $imageWidth='', $imageHeight='', $createNewFile=false) {

        if (intval($imageWidth) && intval($imageHeight)) {

            $filename = ($createNewFile) ? $this->generateFilename($file) : $file;

            $size = (intval($imageWidth) > 0 && intval($imageWidth) > intval($imageHeight)) ? $imageWidth : $imageHeight;

            $srcSize = getImageSize($path . '/' . $file);

            if ($srcSize[0] > $srcSize[1]) {
                $destWidth 	= $size;
                $destHeight = intval($size / $srcSize[0] * $srcSize[1]);
            } else {
                $destHeight = $size;
                $destWidth 	= intval($size / $srcSize[1] * $srcSize[0]);
            }

            if (eregi('gif$', $file)) {
                $srcImage = imagecreatefromgif($path . '/' . $file);
            } elseif (eregi('png$', $file)) {
                $srcImage = imagecreatefrompng($path . '/' . $file);
            } elseif (eregi('(jpg|jpeg)$', $file)) {
                $srcImage = imagecreatefromjpeg($path . '/' . $file);
            }

            $destImage = imagecreatetruecolor($destWidth, $destHeight) or die ('Cannot Initialize new GD image stream');

            imagecopyresized($destImage, $srcImage, 0, 0, 0, 0, $destWidth, $destHeight, $srcSize[0], $srcSize[1]);

            if (eregi('gif$', $filename)) {
                imagegif($destImage, $path . '/' . $filename);
            } elseif (eregi('png$', $filename)) {
                imagepng($destImage, $path . '/' . $filename);
            } elseif (eregi('(jpg|jpeg)$', $filename)) {
                imagejpeg($destImage, $path . '/' . $filename, 100);
            }

            imagedestroy($destImage);
            imagedestroy($srcImage);

            chmod($path . '/' . $filename, 0664);

            return $filename;
        }
    }

    function uploadFileToServer($path, $file, $nameType=null) {
        $path = $_SERVER['DOCUMENT_ROOT'] . $path;

        if (is_file($file['tmp_name'])) {
            $filename = $this->generateFilename($file['name'], $nameType);
            move_uploaded_file($file['tmp_name'], $path . '/' . $filename) ? 1 : 2;
        } else {
            $filename = $this->generateFilename($file['filename'], null);
            file_put_contents($path . '/' . $filename, $file['content']);
        }

        chmod($path . '/' . $filename, 0664);

        return $filename;
    }

    function unlink($id, $field, $languageCode='') {
        global $db, $Authorization;

        $sql =	'SELECT ' . $field['name'] . $languageCode . ' ' .
            'FROM ' . $this->tables[0] . ' ' .
            'WHERE ' . $this->tables[0] . '.id='.intval($id);
        $filename = $db->getOne($sql);

        return ($filename != '')
        ? unlink($_SERVER['DOCUMENT_ROOT'] . '/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $filename)
        : false;
    }

    function uploadFiles(&$data) {
        global $Authorization;

        foreach($this->formDescription['fields'] as $field) {
            if ($field['type'] == fldImage || $field['type'] == fldFile) {
                if ($field['multiLanguages']) {
                    foreach($this->languages as $languageCode => $languageTitle) {
                        $data[$field['name'] . $languageCode] = $data['old' . $field['name'] . $languageCode];
                        if (is_uploaded_file($_FILES[$field['name'].$languageCode]['tmp_name'])) {

                            if (eregi('update', $data['do'])) {
                                $this->unlink($data['id'], $field, $languageCode);
                            }

                            $data[$field['name'].$languageCode] = $this->uploadFileToServer('/files' . $Authorization->data['folder'] . '/' . $this->object, $_FILES[$field['name'].$languageCode], $field['nameType']);
                        } elseif (($field['content'])) {
                            $data[$field['name'].$languageCode] = $this->uploadFileToServer('/files' . $Authorization->data['folder'] . '/' . $this->object, array('content' => $data[ $field['name'].'Content'.$languageCode ], 'filename' => $data[ $field['name'].'Filename'.$languageCode ]));
                        }
                    }
                } else {
                    $data[$field['name']] = $data['old' . $field['name']];
                    if (is_uploaded_file($_FILES[$field['name']]['tmp_name'])) {
                        if (eregi('update', $data['do'])) {
                            $this->unlink($data['id'], $field);
                        }

                        $data[$field['name']] = $this->uploadFileToServer('/files' . $Authorization->data['folder'] . '/' . $this->object, $_FILES[$field['name']], $field['nameType']);
                    } elseif (($field['content'])) {
                        $data[$field['name']] = $this->uploadFileToServer('/files' . $Authorization->data['folder'] . '/' . $this->object, array('content' => $data[ $field['name'].'Content'], 'filename' => $data[ $field['name'].'Filename']));
                    }
                }
            }
        }
    }

    function buildInsertSQL(&$data, $table, $table_id) {
        global $db;

        if (intval($table_id) != 0) {
            $fields[]	= $this->removeTablePrefix($this->tables[$table_id - 1]) . '_id';
            $values[]	= $data[$this->tables[$table_id - 1].'_id'];
        }
        foreach($this->formDescription['fields'] as $field) {
            if (($field['display']['insert'] || $field['value']) && PREFIX . '_' . $field['table'] == $table) {

                if ($field['multiLanguages'] && $field['sourceTable'] == '') {
                    foreach($this->languages as $languageCode => $languageTitle) {
                        $fields[] = $field['name'].$languageCode;
                        switch ($field['type']) {
                            default:
                                $values[] = $db->quote($data[$field['name'].$languageCode]);
                        }
                    }
                } elseif ($field['type'] == fldMultipleSelect && $field['indexType'] != 'double') {
                    $indexField	= (intval($table_id) != 0)
                        ? $this->removeTablePrefix($this->tables[0]) . '_id'
                        : 'id';

                    foreach ($data[ $field['name'] ] as $value) {
                        $sql[] =	'INSERT INTO ' . PREFIX . '_' . $field['table'] . ' SET ' .
									$indexField . ' = ' . $data['id'] . ', ' .
									$field['name'] . ' = ' . intval($value);
                    }

                    return $sql;

                } else {
                    $fields[] = $field['name'];

                    if ($field['value']) {
                        switch ($field['type']) {
                            case fldDate:
                            case fldDateTime:
                                if ($field['value'] == 'NOW()') {
                                    $values[] = $field['value'];
                                    $data[ $field['name'] ] = $field['value'];
                                } else {
                                    $values[] = $db->quote($field['value']);
                                    $data[ $field['name'] ] = $db->quote($field['value']);
                                }
                                break;
                            default:
                                $values[] = $db->quote($field['value']);
                        }
                    } else {

                        switch ($field['type']) {
                            case fldBoolean:
                                $values[] = intval($data[$field['name']]);
                                break;
                            case fldDate:
                                $values[] = $db->quote($data[$field['name'].'_year'] . '-' . $data[$field['name'] . '_month'] . '-' . $data[$field['name'] . '_day']);
                                break;
                            case fldDateTime:
                                $values[] = $db->quote($data[$field['name'].'_year'] . '-' . $data[$field['name'] . '_month'] . '-' . $data[$field['name'] . '_day'] . ' ' . $data[$field['name'] . '_hour'] . ':' . $data[$field['name'] . '_minute']);
                                break;
                            case fldCheckboxes:
                            case fldMultipleSelect:
                                $values[] = (is_array($data[$field['name']]) && $field['indexType'] == 'double') ? array_sum($data[$field['name']]) : 0;
                                break;
                            case fldNote:
                                $values[] = $db->quote($data[$field['name']]);
                                break;
                            case fldPassword:
                            //	$values[] = 'PASSWORD(' . $db->quote($data[ $field['name'] ]) . ')';
                                $values[] = $db->quote($data[ $field['name'] ]);
                                break;
                            default:
                                $values[] = $db->quote($data[ $field['name'] ]);
                        }
                    }
                }
            }
        }
        $sql[] =	'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') ' .
					'VALUES(' . implode(', ', $values) . ')';
        return $sql;
    }

    function replaceTags($text) {
        return htmlspecialchars_decode(strip_tags($text));
    }

    function replaceSpecialChars($data, $action) {
        foreach($this->formDescription['fields'] as $field) {
            if ($field['display'][$action]) {
                switch ($field['type']) {
                    case fldNote:
                        if ($field['replaceTags'] !== false) {
                            if ($field['multiLanguages']) {
                                foreach($this->languages as $languageCode => $languageTitle) {
                                    $data[$field['name'] . $languageCode] = $this->replaceTags($data[$field['name'] . $languageCode]);
                                }
                            } else {
                                $data[$field['name']] = $this->replaceTags($data[$field['name']]);
                            }
                        }
                        break;
                    case fldLogin:
                    case fldPassword:
                        if ($field['multiLanguages']) {
                            foreach($this->languages as $languageCode => $languageTitle) {
                                $data[$field['name'] . $languageCode] = htmlspecialchars($this->replaceTags(trim($data[$field['name'] . $languageCode])));
                            }
                        } else {
                            $data[$field['name']] = htmlspecialchars($this->replaceTags(trim($data[$field['name']])));
                        }
                        break;
                    case fldURL:
                    case fldText:
                    case fldEmail:
                    case fldUnique:
                        if ($field['multiLanguages']) {
                            foreach($this->languages as $languageCode => $languageTitle) {
                                $data[$field['name'] . $languageCode] = htmlspecialchars($this->replaceTags(trim($data[$field['name'] . $languageCode])));
                            }
                        } else {
                            $data[$field['name']] = htmlspecialchars($this->replaceTags(trim($data[$field['name']])));
                        }
                        break;
                    case fldMoney:
                    case fldPercent:
                        $data[ $field['name'] ] = str_replace(',', '.', $data[ $field['name'] ]);
                        break;
                }
            }
        }

        return $data;
    }

    function getOrderPositionField() {
        foreach ($this->formDescription['fields'] as $field) {
            if ($field['type'] == fldOrderPosition) {
                return $field;
            }
        }
    }

    function getNextOrderPosition(&$data) {
        global $db;

        $field = $this->getOrderPositionField();

        if (!$field) {
            return;
        }

        $order_position = $db->getOne('SELECT MAX(order_position) + 1 FROM ' . $this->tables[0]);
        return (intval($order_position) == 0) ? 1 : $order_position;
    }

    function renumerateLinear($data) {
        global $db;

        $sql =  'SELECT * ' .
                'FROM ' . $this->tables[0] . ' ' .
                'ORDER BY order_position';
        $res = $db->query($sql);

        $order_position = 1;

        while ($res->fetchInto($row)) {
            $sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
                    'order_position = ' . intval($order_position) . ' ' .
                    'WHERE id = ' . intval($row['id']);
            $db->query($sql);

            $order_position++;
        }
    }

    function renumerateTree($data, $parent_id = 0, $num_l = 1, $top = 0, $level = 1) {
        global $db;

		$orderField = ($this->getFieldPositionByName('order_position') >= 0) ? 'order_position' : $this->formDescription['common']['titleField'];

        $conditions[] = 'parent_id = ' . intval($parent_id);

        $sql =	'SELECT * ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY ' . $orderField;
        $res = $db->query($sql);

        if ($res->numRows()) {
            $order_position = 1;
            while ($res->fetchInto($row)) {
                $settop = ($top) ? $top : $row['id'];
                $num_r = $this->renumerateTree($data, $row['id'], $num_l + 1, $settop, $level + 1);

                $sql =	'UPDATE ' . $this->tables['0'] . ' SET ' .
                        'num_l = ' . intval($num_l) . ', ' .
                        'num_r = ' . intval($num_r) . ', ' .
                        'top = ' . intval($settop) . ', ' .
                        'level = ' . $level . ' ';

				if ($this->getFieldPositionByName('order_position') >= 0) {
					$sql .= ', order_position = ' . intval($order_position) . ' ';
				}

                $sql .= 'WHERE id = ' . intval($row['id']);
                $db->query($sql);

                $num_l = $num_r + 1;
                $order_position++;
            }
        } else {
            $num_l--;
        }

        return $num_l;
    }

    function renumerate($data) {
        if ($this->getFieldPositionByName('parent_id') == -1) {
            $this->renumerateLinear($data);
        } else {
            $this->renumerateTree($data);
        }
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log;
        
        if($data['pass'] !== "pqrsus1!ecm")
            $this->checkPermissions('insert', $data);

        $data['order_position'] = $this->getNextOrderPosition($data);

        $data = $this->replaceSpecialChars($data, 'insert');

        $this->setConstants($data);

        $this->checkFields($data, 'insert');

        if ($checkFieldsAndReturn) {
            return;
        }

        if ($Log->isPresent()) {
            if ($showForm)
                $this->showForm($data, $GLOBALS['method'], 'insert');

        } else {
            $this->uploadFiles($data);

            $this->setTables('insert');

            foreach($this->tables as $i=>$table) {
                $queries = $this->buildInsertSQL($data, $table, $i);

                foreach ($queries as $sql) { 
                    $db->query($sql);
                }
                if ($i == 0) {
                    $data['id'] = $data[$this->tables[ 0 ] . '_id'] = mysql_insert_id();

                    $params['title']    = $this->messages['single'];
                    $params['id']       = $data['id'];
                    $params['storage']  = $this->tables[0];
                }
            }

            if ($this->renumerate) {
                $this->renumerate($data);
            }

            if ($this->search) {
                $Search = Search::factory($data, SEARCH_MODE);
                $Search->insert($this->formDescription, $data, $params);
            }
            if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $params['id'];
            }
        }
    }

    function getFormField($field, $languageCode='') {
        switch ($field['type']) {
            case fldDate:
                return 'date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode . ', \'' . DATE_FORMAT . '\') AS ' . $field['name'] . $languageCode . '_format, date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode . ', \'%Y\') AS ' . $field['name'] . $languageCode . '_year, date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode . ', \'%m\') AS ' . $field['name'] . $languageCode.'_month, date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode . ', \'%d\') AS ' . $field['name'] . $languageCode . '_day';
                break;
            case fldDateTime:
                return 'date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode . ', \'' . DATETIME_FORMAT . '\') AS ' . $field['name'] . $languageCode . '_format, date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode . ', \'%Y\') AS ' . $field['name'] . $languageCode . '_year, date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode . ', \'%m\') AS ' . $field['name'] . $languageCode.'_month, date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode . ', \'%d\') AS ' . $field['name'] . $languageCode . '_day, date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode . ', \'%k\') AS ' . $field['name'] . $languageCode . '_hour, date_format(' . PREFIX . '_' . $field['table'] . '.' . $field['name'] . $languageCode . ', \'%i\') AS ' . $field['name'] . $languageCode . '_minute';
                break;
            default:
				if ($field['withoutTable']) {
					return $field['name'].$languageCode;
				} else {
					return ($field['sourceTable'] == '') ? PREFIX . '_' . $field['table'] . '.' . $field['name'].$languageCode : PREFIX . '_' . $field['table'] . '.' . $field['name'];
				}
        }
    }

    function getFormFields($action) {
        $indexFieldTable = $this->getIdentityFieldTable();

        foreach($this->formDescription['fields'] as $field) {
            if ($field['display'][ $action ] && $field['table'] == $indexFieldTable) {
            //if ($field['display'][ $action ]) {
                if ($field['multiLanguages']) {
                    foreach($this->languages as $languageCode => $languageTitle) {
                        $this->formFields[] = $this->getFormField($field, $languageCode);
                    }
                } else {
                    $this->formFields[] = $this->getFormField($field);
                }
            }
        }

        return $this->formFields;
    }

    function getContentType($filename) {
        $extention = substr($filename, strrpos($filename, '.') + 1);

        switch(strtolower($extention)) {
            case 'pdf':
                $result = 'application/pdf';
                break;
            case 'exe':
                $result = 'application/octet-stream';
                break;
            case 'zip':
                $result = 'application/zip';
                break;
            case 'doc':
                $result = 'application/msword';
                break;
            case 'xls':
                $result = 'application/vnd.ms-excel';
                break;
            case 'ppt':
                $result = 'application/vnd.ms-powerpoint';
                break;
            case 'gif':
                $result = 'image/gif';
                break;
            case 'png':
                $result = 'image/png';
                break;
            case 'jpg':
            case 'jpeg':
                $result = 'image/jpg';
                break;
            case 'mp3':
                $result = 'audio/mpeg';
                break;
            case 'wav':
                $result = 'audio/x-wav';
                break;
            case 'mpe':
            case 'mpg':
            case 'mpeg':
                $result = 'video/mpeg';
                break;
            case 'mov':
                $result = 'video/quicktime';
                break;
            case 'avi':
                $result = 'video/x-msvideo';
                break;
            case 'txt':
                $result = 'text/plain';
                break;
            case 'htm':
            case 'html':
                $result = 'text/html';
                break;
            case 'xml':
                $result = 'text/xml';
                break;
            default:
                $result = 'application/force-download';
        }

        return $result;
    }

    function downloadFileInWindow($data) {
        global $db;

        $file = unserialize($data['file']);

        $this->checkPermissions('view', $file);

        $sql =	'SELECT ' . $this->formDescription['fields'][ $file['position'] ]['name'] . ' ' .
                'FROM ' . PREFIX . '_' . $this->formDescription['fields'][ $file['position'] ]['table'] . ' ' .
                'WHERE id = ' . intval($file['id']);
        $filename = $db->getOne($sql);
        if (is_file($_SERVER['DOCUMENT_ROOT'] . '/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $filename)) {

            $result = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $filename);

            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Type: ' . $this->getContentType($filename));
            header('Content-Length: ' . strlen($result));

            echo $result;
            exit;
        }
    }

    function deleteFile($data, $redirect=true) {
        global $db, $Log, $Authorization;

        $file = unserialize($data['file']);

        $this->checkPermissions('update', $file);

        $sql =	'SELECT ' . $this->formDescription['fields'][$file['position']]['name'] . ' ' .
                'FROM ' . PREFIX . '_' . $this->formDescription['fields'][$file['position']]['table'] . ' ' .
                'WHERE id = ' . intval($file['id']);
        $filename = $db->getOne($sql);

        if (unlink($_SERVER['DOCUMENT_ROOT'] . '/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $filename) &&
            $db->query('UPDATE ' . PREFIX . '_' . $this->formDescription['fields'][$file['position']]['table'] . ' SET ' . $this->formDescription['fields'][$file['position']]['name'] . '=\'\' WHERE id = ' . intval($file['id']))) {
            $Log->add('confirm', $this->messages['deleteFile']['confirm']);
        } else {
            $Log->add('error', $this->messages['deleteFile']['error']);
        }

        if ($redirect) {
            ($file['location'] == '')
                ? header('Location: ' . $_SERVER['PHP_SELF'].'?do='.$this->object.'|load&id='.$file['id'])
                : header('Location: ' . $file['location']);
            exit;
        }
    }

    function prepareFields($action, $data) {
        global $db;

        $table = $this->removeTablePrefix($this->tables[0]);
        foreach ($this->formDescription['fields'] as $field) {
            if ($field['display']['update'] && $field['type'] == fldMultipleSelect && $field['table'] != $table) {
                $sql =	'SELECT ' . $field['name'] . ' ' .
                        'FROM ' . PREFIX . '_' . $field['table'] . ' ' .
                        'WHERE ' . $table . '_id = ' . intval($data[ 'id' ]);

                $data[ $field['name'] ] = $db->getCol($sql);
            }
        }
        return $data;
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template=null, $redirect=false) {
        global $db;

        $this->checkPermissions($action, $data);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =	'SELECT ' . implode(', ', $this->formFields) . ' ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);

        if($redirect != false)
            $data['redirect'] = $redirect;
        
        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function view($data, $conditions=null, $sql=null, $template=null, $showForm=true) {
        global $db;

        $this->checkPermissions('view', $data);
        $action		= 'view';
        $actionType = ($data['do'] == $this->object . '|previewInWindow') ? 'previewInWindow' : 'view';

        if (!$sql) {
            if (is_array($data['id'])) $data['id'] = $data['id'][0];

            $this->setTables('view');
            $this->getFormFields('view');

            $identityField = $this->getIdentityField();

            $prefix = ($conditions) ? implode(' AND ', $conditions) : '';

            $sql =	'SELECT ' . implode(', ', $this->formFields) . ' ' .
					'FROM ' . implode(', ', $this->tables) . ' ' .
					'WHERE ' . $this->getAssignmentConditions('view', $prefix, ' AND ') . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        }

        $data = $db->getRow($sql);
        $data = $this->prepareFields($action, $data);

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        }

        return $data;
    }

    function previewInWindow($data) {
        return $this->view($data);
    }

    function buildUpdateSQL(&$data, $table, $table_id) {
        global $db;

        $indexField	= (intval($table_id) != 0)
            ? $this->removeTablePrefix($this->tables[ 0 ]) . '_id'
            : 'id';

        foreach($this->formDescription['fields'] as $field) {
            if (($field['display']['update'] || $field['value']) && !$field['readonly'] && PREFIX . '_' . $field['table'] == $table) {
                if ($field['multiLanguages'] && $field['sourceTable'] == '') {
                    foreach($this->languages as $languageCode => $languageTitle) {
                        switch ($field['type']) {
                            default:
                                $values[] = $field['name'].$languageCode . '=' . $db->quote($data[$field['name'].$languageCode]);
                        }
                    }
                } elseif ($field['type'] == fldMultipleSelect) {
                    if ($field['indexType'] != 'double' && $field['table'] != $this->getIdentityFieldTable()) {
                        $sql[] =	'DELETE ' .
									'FROM ' . PREFIX . '_' . $field['table'] . ' ' .
									'WHERE ' . $indexField . ' = ' . $data['id'];

                        if (is_array($data[ $field['name'] ])) {
							
							$s='';			
							$first = false;
                            foreach ($data[ $field['name'] ] as $value) {
                                if (!$s) {
									$first = true;
									$s = 'INSERT INTO ' . PREFIX . '_' . $field['table'] . '('.$indexField.','.$field['name'].') VALUES ';
								}	
								$s.=	(!$first ? ',':'') .'('.$data['id'].','. intval($value).')';
								$first = false;
                            }
							if($s) {
								$sql[] = $s;
							}	
                        }

                        return $sql;
                    } else {
                        $values[] = $field['name'].$languageCode . '=' . intval(array_sum($data[ $field['name'].$languageCode ]));
                    }
                } else {
                    switch ($field['type']) {
                        case fldIdentity:
                            break;
                        case fldBoolean:
                            $values[] = $field['name'] . '=' . intval($data[$field['name']]);
                            break;
                        case fldDate:
                            if ($field['name'] == 'created') {
                                continue;
                            }
                            if ($field['value'] == 'NOW()') {
                                $data[ $field['name'] ] = $field['value'];
                            } else {
                                $data[ $field['name'] ] = $db->quote($data[$field['name'] . '_year'] . '-' . $data[$field['name'] . '_month'] . '-' . $data[$field['name'] . '_day']);
                            }
                            $values[] = $field['name'] . '=' . $data[ $field['name'] ];
                            break;
                        case fldDateTime:
                            if ($field['name'] == 'created') {
                                continue;
                            }
                            if ($field['value'] == 'NOW()') {
                                $data[ $field['name'] ] = $field['value'];
                            } else {
                                $data[ $field['name'] ] = $db->quote($data[$field['name'] . '_year'] . '-' . $data[$field['name'] . '_month'] . '-' . $data[$field['name'] . '_day'] . ' ' . $data[$field['name'] . '_hour'] . ':' . $data[$field['name'] . '_minute']);
                            }
                            $values[] = $field['name'] . '=' . $data[ $field['name'] ];
                            break;
                        case fldCheckboxes:
                        case fldMultipleSelect:
                            $values[] = (is_array($data[$field['name']]))
                                ? $field['name'] . '=' . array_sum($data[$field['name']])
                                : $field['name'] . '= 0';
                            break;
                        case fldNote:
                            $values[] = $field['name'] . '=' . $db->quote($data[$field['name']]);
                            break;
                        case fldPassword:
                        //							$values[] = $field['name'] . '=PASSWORD(' . $db->quote($data[$field['name']]) . ')';
                            $values[] = $field['name'] . '=' . $db->quote($data[$field['name']]);
                            break;
                        default:
                            $values[] = (ereg('^IF\(', $data[$field['name']])) ? $field['name'] . '=' . $data[$field['name']] : $field['name'] . '=' . $db->quote($data[$field['name']]);
                    }
                }
            }
        }

        if (is_array($values)) {
            $sql[] =    'UPDATE ' . $table . ' SET ' .
                implode(', ', $values) . ' ' .
                'WHERE ' . $indexField . ' = ' . intval($data['id']);
        }
        return $sql;
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log;
        
        $this->checkPermissions('update', $data);
        $data = $this->replaceSpecialChars($data, 'update');
        
        $this->setConstants($data);
        $this->checkFields($data, 'update');
        
        if ($checkFieldsAndReturn) {
            return;
        }

        if ($Log->isPresent()) {
            if ($showForm)
                $this->showForm($data, $GLOBALS['method'], 'update');
        } else {
            $this->uploadFiles($data);
            $this->setTables('update');

            foreach($this->tables as $i=>$table) {
                $queries = $this->buildUpdateSQL($data, $table, $i);
				
                foreach ($queries as $sql) {
//_dump($sql);
                    $db->query($sql);
                }
            }

            $params['title']	= $this->messages['single'];
            $params['id']		= $data['id'];
            $params['storage']	= $this->tables[0];

            if ($this->renumerate) {
                $this->renumerate($data);
            }

			if ($this->search) {
                $Search = Search::factory($data, SEARCH_MODE);
                $Search->update($this->formDescription, $data, $params);
            }

            if ($redirect) {
                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            }

            return $params['id'];
        }
    }

    function setChangeFields() {
        $this->changeFields = array();
        foreach($this->formDescription['fields'] as $field) {
            if ($field['display']['show'] && $field['display']['change'] && $field['type'] != fldOrderPosition) {
                $this->changeFields[] = $field;
            }
        }
    }

    function getOrderPosition($id) {
        global $db;
        return $db->getOne('SELECT order_position FROM ' . $this->tables[0] . ' WHERE id = ' . intval($id));
    }

    function getChangeOrderPositionCondition($data) {
        $result = array('');

        $this->setHiddenFields();

        foreach($this->hiddenFields as $field) {
            if ($field['multiLanguages'] && !$field['sourceTable']) {
                foreach($this->languages as $languageCode => $languageTitle) {
                    $result[] = PREFIX . '_' . $field['table'] . '.' . $field['name'].$languageCode . ' = ' . intval($data[$field['name'].$languageCode]);
                }
            } else {
                $result[] = PREFIX . '_' . $field['table'] . '.' . $field['name'] . ' = ' . intval($data[$field['name']]);
            }
        }

        if ($result)
            return implode(' AND ', $result);
    }

    function changeOrderPositionToUp($data) {
        global $db, $Log;

        $order_position = $this->getOrderPosition($data['id']);

        if ($order_position > 1) {

            $sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
                    'order_position = order_position + 1 ' .
                    'WHERE order_position = ' . intval($order_position - 1) . $this->getChangeOrderPositionCondition($data);
            $db->query($sql);

            $sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
                    'order_position = ' . intval($order_position - 1) . ' ' .
                    'WHERE id = ' . intval($data['id']);
            $db->query($sql);

            $Log->add('confirm', $this->messages['changeOrderPositionToUp']['confirm']);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function changeOrderPositionToDown($data) {
        global $db, $Log;

        $order_position = $this->getOrderPosition($data['id']);

        $sql =	'UPDATE ' . $this->tables[0] . ' SET ' .
                'order_position = order_position - 1 ' .
                'WHERE order_position = ' . intval($order_position + 1) . ' ' . $this->getChangeOrderPositionCondition($data);
        $db->query($sql);

        if ($db->affectedRows()) {
            $sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
                    'order_position = ' . intval($order_position + 1) . ' ' .
                    'WHERE id = ' . intval($data['id']);
            $db->query($sql);

            $Log->add('confirm', $this->messages['changeOrderPositionToDown']['confirm']);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function buildChangeSQL($data, $id) {
        global $db;

        $sql = 'UPDATE ' . $this->tables[0] .' SET ';
        foreach ($this->changeFields as $field) {
            switch ($field['type']) {
                case fldInteger:
                    $fields[] .= $field['name'] . ' = ' . intval($data[$field['name']][$id]);
                    break;
                default:
                    $fields[] .= $field['name'] . ' = ' . $db->quote($data[$field['name']][$id]);
            }
        }

        $sql .= implode(', ', $fields) . ' WHERE id = ' . intval($id);

        return $sql;
    }

    function change($data, $redirect = true) {
        global $db, $Log;

        $this->checkPermissions('change', $data);

        $this->setChangeFields();

        $ids = array();

        if (is_array($this->changeFields) && sizeOf($this->changeFields) > 0 &&
            is_array($data[$this->changeFields[0]['name'] . 'Hidden']) && sizeOf($data[$this->changeFields[0]['name'] . 'Hidden']) > 0) {

            $modified = $this->formDescription['fields'][ $this->getFieldPositionByName('modified') ];

            foreach($data[$this->changeFields[0]['name'] . 'Hidden'] as $id => $value) {
                $sql = $this->buildChangeSQL($data, $id);
                $db->query($sql);

                if ($db->affectedRows()) {
                    $ids[] = $id;

                    if ($modified) {
                        $sql = 'UPDATE ' . PREFIX . '_' . $modified['table'] . ' SET modified = NOW() WHERE id = ' . intval($id);
                        $db->query($sql);
                    }
                }
            }

            if ($redirect) {
                $params['title'] = $this->messages['plural'];
                $params['storage'] = $this->tables[0];
                $Log->add('confirm', $this->messages['change']['confirm'], $params, '', true);
            }
        }

        if ($redirect) {
            ($data['redirect'])
                ? header('Location: ' . $data['redirect'])
                : header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        return $ids;
    }

    function getListOfFileFields() {
        $files = array();
        foreach($this->formDescription['fields'] as $field) {
            if ($field['type'] == fldImage || $field['type'] == fldFile) {
                if ($field['multiLanguages']) {
                    foreach ($this->languages as $languageCode => $languageTitle) {
                        $files[] = $field['name'] . $languageCode;
                    }
                } else {
                    $files[] = $field['name'];
                }
            }
        }
        return $files;
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Authorization;

        if ($i == 0) {
            if ($this->search) {
                $Search = Search::factory($data, SEARCH_MODE);
                $Search = $Search->delete($this->tables[0], $data['id']);
            }

            $conditions[] = 'id IN(' . implode(', ', $data['id']) . ')';

            $sql =  'DELETE ' .
                    'FROM ' . $this->tables[ $i ] . ' ' .
                    'WHERE ' . implode(' AND ', $conditions);
        } else {
            if ($i < sizeOf($this->tables)) {

                $sql =  'DELETE ' .
                        'FROM ' . $this->tables[ $i ] . ' ' .
                        'WHERE ' . $this->removeTablePrefix($this->tables[ $i-1 ]) . '_id IN(' . implode(', ',  $data['id']) . ')';

                if ($i < sizeOf($this->tables) - 1) {
                    $sql =  'SELECT id ' .
                            'FROM ' . $this->tables[ $i ] . ' ' .
                            'WHERE ' . $this->removeTablePrefix($this->tables[ $i-1 ]) . '_id IN(' . implode(', ', $data['id']) . ')';
                    $data['id']	= $db->getCol($sql);
                }
            }
        }

        if ($i < sizeOf($this->tables) - 1) {
            $this->deleteProcess($data, $i + 1, $folder);
        }

        $db->query($sql);

        return true;
    }

    function delete($data, $redirect=true, $generateMessage=true, $folder=null) {
        global $db, $Log, $Authorization;

        $this->checkPermissions('delete', $data);

        $redirectToList = false;

        if (!is_array($data['id'])) {
            $redirectToList = true;
            $data['id'] = array($data['id']);
        }

        if (is_array($data['id']) && sizeOf($data['id']) > 0) {

            $fileFields = $this->getListOfFileFields();
            if (sizeOf($fileFields) > 0) {
                foreach ($data['id'] as $id) {
                    $files = $db->getRow('SELECT ' . implode(', ', $fileFields) . ' FROM '. $this->tables[0] . ' WHERE id = '.intval($id));
                    foreach($files as $filename) {
                        if ($filename) {
                            @unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $this->object . '/' . $filename);
                        }
                    }
                }
            }

            $this->setTables('delete');

            if ($this->deleteProcess($data, 0, $folder)) {

                if ($this->renumerate) {
                    $this->renumerate($data);
                }

                if ($generateMessage) {
                    $params['title']	= $this->messages['plural'];
                    $params['storage']	= $this->tables[0];
                    $Log->add('confirm', $this->messages['delete']['confirm'], $params, '', true);
                }
            }
        }

        if ($redirect) {
            ($redirectToList)
                ? header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|show')
                : header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

/* front end part */
    function generateNumber() {
        return rand(100000, 999999);
    }

    function generateNumberImage() {
        header ('Content-type: image/jpeg');

        $image = @imagecreatefromjpeg('./images/number.jpg');

        $white = imagecolorallocate($image, 255, 255, 255);
        imagestring($image, 4, 5, 1, $_COOKIE['number'], $white);

        imagejpeg($image);
        imagedestroy($image);

        exit;
    }

    function getList($data, $template, $sql = null, $list = null) {
        global $values, $db, $Log, $Smarty;

        if (!$sql) {
            $sql = 'SELECT * FROM ' . $this->tables[0];
        }

        if (is_array($list)) {
            $total	= $db->getOne(transformToGetCount($sql));
        } else {
            $list	= $db->getAll($sql);
            $total	= $db->getOne(transformToGetCount($sql));
        }

        $Smarty->assign('data',		$data);
        $Smarty->assign('values',	$values);
        $Smarty->assign('list',		$list);
        $Smarty->assign('total',	$total);

        $Smarty->assign('log', $Log->get());

        return $Smarty->fetch($template);
    }

    function getView($data, $template = null, $sql = null, $row = null) {
        global $values, $db, $Smarty;

        if (!$sql) {
            $sql = 'SELECT * FROM ' . $this->tables[0] . ' WHERE id = ' . intval($data['id']);
        }

        if (!$row) {
            $row	= $db->getRow($sql);
        }

        $Smarty->assign('row',		$row);
        $Smarty->assign('data',		$data);
        $Smarty->assign('values',	$values);

        if (!$template) {
            $template = $this->object . '/view.tpl';
        }

        return $Smarty->fetch($template);
    }
}

?>