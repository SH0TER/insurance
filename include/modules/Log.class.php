<?
/*
 * Title: log class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Form.class.php';

class Log extends Form {
    var $formDescription =
        array(
            'fields'     =>
                array(
                    array(
                        'name'                => 'id',
                        'type'                => fldIdentity,
                        'display'            =>
                            array(
                                'show'        => true,
                                'insert'    => false
                            ),
                        'verification'        =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'                => 'log'),
                    array(
                        'name'                => 'data',
                        'description'        => 'Дата',
                        'type'                => fldNote,
                        'display'            =>
                            array(
                                'show'        => false,
                                'insert'    => true
                            ),
                        'verification'        =>
                            array(
                                'canBeEmpty'    => true
                            ),
                        'table'                => 'log'),
                    array(
                        'name'                => 'storage',
                        'description'        => 'Таблиця',
                        'type'                => fldText,
                        'display'            =>
                            array(
                                'show'        => false,
                                'insert'    => true
                            ),
                        'verification'        =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'                => 'log'),
                    array(
                        'name'                => 'items_id',
                        'description'        => 'ID',
                        'type'                => fldInteger,
                        'display'            =>
                            array(
                                'show'        => false,
                                'insert'    => true
                            ),
                        'verification'        =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'                => 'log'),
                    array(
                        'name'                => 'action',
                        'description'        => 'Дія',
                        'type'                => fldText,
                        'display'            =>
                            array(
                                'show'        => false,
                                'insert'    => true
                            ),
                        'verification'        =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'                => 'log'),
                    array(
                        'name'                => 'title',
                        'description'        => 'Назва',
                        'type'                => fldText,
                        'display'            =>
                            array(
                                'show'        => true,
                                'insert'    => true
                            ),
                        'verification'        =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'orderPosition'        => 1,
                        'table'                => 'log'),
                    array(
                        'name'                => 'description',
                        'description'        => 'Опис',
                        'type'                => fldText,
                        'display'            =>
                            array(
                                'show'        => true,
                                'insert'    => true
                            ),
                        'verification'        =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'orderPosition'        => 2,
                        'table'                => 'log'),
                    array(
                        'name'                => 'created',
                        'description'        => 'Створено',
                        'type'                => fldDate,
                        'value'                => 'NOW()',
                        'display'            =>
                            array(
                                'show'        => true,
                                'insert'    => false
                            ),
                        'verification'        =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'orderPosition'        => 4,
                        'width'             => 100,
                        'table'                => 'log')
                    ),
            'common'    =>
                array(
                    'defaultOrderPosition'    => 4,
                    'defaultOrderDirection'    => 'desc'
                )
        );

        var $messages =
            array(
                'show'        => 'Log',
                'delete'    =>
                    array(
                        'confirm'    => 'Selected records have been deleted.',
                        'error'        => 'Selected records have not been deleted. An error occured.')
            );

    function Log($data) {
        Form::Form($data);
        $this->messages = $_SESSION['log'];
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => false,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => true);
                break;
        }
    }

    function isPresent() {
        return (is_array($_SESSION['log']) && sizeOf($_SESSION['log']) > 0);
    }

    function showSystem() {
        if ($this->isPresent()) {

            include_once 'Log/show.php';
            unset($_SESSION['log']);
            $_SESSION['log'] = '';
        }
    }

    function add($type, $description, $params=null, $title=null, $saveToDatabase=false) {
        global $db, $Authorization;

        if ($params['title']) {
            $params['title'] = strtoupper(substr($params['title'], 0, 1)) . substr($params['title'], 1);
        }

        switch ($_REQUEST['do']) {
            case 'login':
            case 'logout':
                break;
            default:
                if(!strstr($description,'src') && !strstr($description,'href')) {
                    $_SESSION['log'][] = array('type' => $type, 'text' => vsprintf(translate($description) . $params['text'], $params));
                }
                else{
                     $_SESSION['log'][] = array('type' => $type, 'text' => translate($description) . $params['text'], $params);
                }
                break;
        }

        if ($saveToDatabase && $_SERVER['SERVER_ADDR']!='192.168.162.237' ) {
            $sql = 'INSERT INTO ' . $this->tables[0] . ' SET ' .
                'data = ' . $db->quote(serialize($_REQUEST)) . ', ' .
                'accounts_id = ' . intval($Authorization->data['id']) . ', ' .
                'ip = ' . $db->quote($_SERVER['REMOTE_ADDR']) . ', ' .
                'storage = ' . $db->quote($params['storage']) . ', ' .
                'items_id = ' . intval($params['id']) . ', ' .
                'action = ' . $db->quote($_REQUEST['do']) . ', ' .
                'title = ' . $db->quote($title) . ', ' .
                'description = ' . $db->quote($description) . ', ' .
                'created = NOW()';
            $db->query($sql);
        }
		
		if ($type == 'db') {
			$this->clear();
		}
    }

    function clear() {
        $_SESSION['log'] = '';
    }

    function get() {
        $result = $_SESSION['log'];
        $this->clear();

        return $result;
    }

    function isUserActive($accounts_id) {
        global $db;

        $result = false;

        $conditions[] = 'accounts_id = ' . intval($accounts_id);
        $conditions[] = '(action = ' . $db->quote('login') . ' OR action = ' . $db->quote('logout') . ')';

        $sql =  'SELECT *, UNIX_TIMESTAMP() - UNIX_TIMESTAMP(created) as seconds ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY id DESC ' .
                'LIMIT 1';
        $row = $db->getRow($sql);

        switch ($row['action']) {
            case 'login':
                if ($row['ip'] != $_SERVER['REMOTE_ADDR'] && $row['seconds'] < SESSION_LIFETIME) {
                    $result = true;
                }
                break;
        }

        return $result;
    }

    function getText($delimiter = ';<br />') {
        $result = '';

        if (is_array($_SESSION['log'])) {
            foreach ($_SESSION['log'] as $row) {
                $result .= $row['text'] . $delimiter;
            }
        }

        return $result;
    }
}

?>