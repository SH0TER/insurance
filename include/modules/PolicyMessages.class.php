<?
/*
 * Title: policy message class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Users.class.php';
require_once 'Policies.class.php';

class PolicyMessages extends Form {

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
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'policies_id',
                            'description'        => 'Поліс (сертифікат)',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'width'                => 60,
                            'orderPosition'        => 1,
                            'table'                => 'policy_messages',
                            'sourceTable'        => 'policies',
                            'selectField'        => 'number',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'clients_id',
                            'description'        => 'Клієнт',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'author_roles_id',
                            'description'        => 'Автор',
                            'type'                => fldSelect,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_messages',
                            'sourceTable'        => 'roles',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'authors_id',
                            'description'        => 'Автор',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'author',
                            'description'        => 'Автор',
                            'type'                => fldHidden,
//                            'jTip'                => '/index.php?do=Users|getContactInWindow&amp;usersId={$authors_id}',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 2,
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'author_organization',
                            'description'        => 'Автор',
                            'type'                => fldHidden,
//                            'jTip'                => '/index.php?do=Users|getContactInWindow&amp;usersId={$authors_id}',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'recipient_organizations_id',
                            'description'        => 'Отримувач',
                            'type'                => fldCheckboxes,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'recipient_roles_id',
                            'description'        => 'Отримувач',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_messages',
                            'sourceTable'        => 'roles',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'recipients_id',
                            'description'        => 'Отримувач',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'recipient',
                            'description'        => 'Отримувач',
                            'type'                => fldHidden,
//                            'jTip'                => '/index.php?do=Users|getContactInWindow&amp;usersId={$recipients_id}',
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'recipient_organization',
                            'description'        => 'Отримувач',
                            'type'                => fldHidden,
//                            'jTip'                => '/index.php?do=Users|getContactInWindow&amp;usersId={$recipients_id}',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 3,
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'subject',
                            'description'        => 'Тема',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 4,
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'text',
                            'description'        => 'Текст',
                            'type'                => fldNote,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'manual',
                            'description'        => 'Ручне',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'created',
                            'description'        => 'Створено',
                            'type'                => fldDateTime,
                            'value'                => 'NOW()',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 5,
                            'width'                => 120,
                            'table'                => 'policy_messages'),
                        array(
                            'name'                => 'modified',
                            'description'        => 'Редаговано',
                            'type'                => fldDateTime,
                            'value'                => 'NOW()',
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_messages')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    => 5,
                        'defaultOrderDirection'    => 'desc',
                        'titleField'            => 'subject'
                    )
            );

    function PolicyMessages($data, $objectTitle=null) {
        global $db, $Authorization;

        Form::Form($data);

        $this->messages['plural'] = 'Повідомлення';
        $this->messages['single'] = 'Повідомлення';

        if (!is_null($objectTitle)) {
            $this->objectTitle = $objectTitle;
        }

        if (!intval($data['policies_id']) && intval($data['id'])) {
            $data['policies_id'] = $data['id'];
        }

        if (intval($data['policies_id'])) {

            $sql =  'SELECT policy_statuses_id ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE id = ' . intval($data['policies_id']);
            $policy_statuses_id = $db->getOne($sql);

            $clients =
                'SELECT CONCAT(\'clients\', \'|\', a.clients_id) as id, b.company as title ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_clients AS b ON a.clients_id = b.id ' .
                'WHERE a.id = ' . intval($data['policies_id']);

            $agencies =
                'SELECT CONCAT(\'agencies\', \'|\', b.id) as id, b.title ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_agencies AS b ON a.agencies_id = b.id ' .
                'WHERE a.id = ' . intval($data['policies_id']);
				
			$seller_agencies = 
				'SELECT CONCAT(\'seller_agencies\', \'|\', b.id) as id, b.title ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_agencies AS b ON a.seller_agencies_id = b.id ' .
                'WHERE a.id = ' . intval($data['policies_id']);

            $managers =
                'SELECT CONCAT(\'managers\', \'|\', managers_id) as id, ' . $db->quote('ТДВ "Експрес Страхування"') . ' as title ' .
                'FROM ' . PREFIX . '_policies ' .
                'WHERE id = ' . intval($data['policies_id']);

            switch ($Authorization->data['roles_id']) {
                case ROLES_MANAGER:
                case ROLES_ADMINISTRATOR:
                    $sql = $agencies . ' UNION ' . $seller_agencies;
                    break;
                case ROLES_AGENT:
					$sql = $agencies . ' UNION ' . $managers . ' UNION ' . $seller_agencies;
					break;
                case ROLES_CLIENT_CONTACTS:
                    $sql = $managers;
                    break;
            }

            $res = $db->query($sql);

            while ($res->fetchInto($row)) {
				if ($Authorization->data['roles_id'] == ROLES_AGENT && $row['id'] == 'agencies|' . $Authorization->data['agencies_id']) continue;
			
                $list[ $row['id'] ] = $row['title'];
            }

            $this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organizations_id')]['list'] = $list;
        }
    }

    function setPermissions($data) {
		global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
            case ROLES_CLIENT_CONTACT:
			case ROLES_GENERALI_MANAGER:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => false,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => false);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => false,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => true);
                break;
        }
    }

    function getRowClass($row, $i) {
        global $db, $Authorization;

        $result = parent::getRowClass($row, $i);

        if (!$row['viewed']) {
            $result .= ' bold';
        }

        return $result;
    }

    function getShowOrderCondition() {
        $direction = (ereg('^(asc|desc)$', $_COOKIE[ $this->object ]['orderDirection']))
            ? $_COOKIE[ $this->object ]['orderDirection']
            : $this->formDescription['common']['defaultOrderDirection'];

        switch ($_COOKIE[$this->object]['orderPosition']) {
            case 1:
                return $this->tables[1] . '.number ' . $direction;
                break;
            case 2:
                return $this->tables[0] . '.author_organization ' . $direction;
                break;
            case 3:
                return $this->tables[0] . '.recipient_organization ' . $direction;
                break;
            case 4:
                return $this->tables[0] . '.subject ' . $direction;
                break;
            default:
                return $this->tables[0] . '.created ' . $direction;
                break;
        }
    }

    function setShowFields() {
        $this->formDescription['fields'][ $this->getFieldPositionByName('author') ]['type']                 = fldText;
        $this->formDescription['fields'][ $this->getFieldPositionByName('recipient_organization') ]['type']    = fldText;
        $this->formDescription['fields'][ $this->getFieldPositionByName('policies_id') ]['type']             = fldSelect;

        return parent::setShowFields();
    }

    function show($data, $fields=null, $conditions=null, $returnSQL=false) {
        global $db, $Authorization;

		$data['do'] = 'PolicyMessages|show';

        if (intval($data['policies_id'])) {
            $fields[]        = 'policies_id';
            $conditions[]    =  $this->tables[0] . '.policies_id = ' . intval($data['policies_id']);
        } else {
            $this->permissions['insert'] = false;
        }

        if (intval($data['authors_id'])) {
            $conditions[] = 'authors_id = ' . intval($data['authors_id']);
        }

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
                $conditions[] = '(' . $this->tables[0] . '.recipient_roles_id = ' . ROLES_AGENT . ' OR author_roles_id=' . ROLES_AGENT . ')';
                break;
            case ROLES_CLIENT_CONTACT:
                $conditions[]   = PREFIX . '_policies.clients_id = ' . intval($Authorization->data['clients_id']);
                $conditions[] = '(' . $this->tables[0] . '.recipient_roles_id = ' . ROLES_CLIENT_CONTACT . ' OR author_roles_id=' . ROLES_CLIENT_CONTACT . ')';
                break;
        }

        $sql =  'SELECT ' . $this->tables[0] . '.*, ' . PREFIX . '_policies.number as policies_id, date_format(' . $this->tables[0] . '.created, ' . $db->quote(DATETIME_FORMAT) . ') as created_format, c.messages_id as viewed ' .
                'FROM ' . $this->tables[0] . ' ';
        $sql .= 'JOIN ' . PREFIX . '_policies ON ' . PREFIX . '_policies.id=' . $this->tables[0] . '.policies_id ';

        $totalSQL = $sql;

        $sql .= ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR)
            ? 'LEFT JOIN ( SELECT DISTINCT messages_id FROM ' . PREFIX . '_policy_message_views WHERE accounts_id IN (' . implode(', ', $Authorization->data['managers']) . ')' . (intval($data['policies_id'])>0 ? ' AND policies_id = ' . intval($data['policies_id']):'').') AS c ON (' . $this->tables[0] . '.id=c.messages_id) OR ISNULL(c.messages_id) '
            : 'LEFT JOIN ' . PREFIX . '_policy_message_views AS c ON ' . $this->tables[0] . '.id=c.messages_id AND c.accounts_id = ' . intval($Authorization->data['id']) . '  '.(intval($data['policies_id'])>0 ? ' AND c.policies_id = ' . intval($data['policies_id']):'') . ' ';

        if ($conditions) {
            $sql        .= 'WHERE ' . implode(' AND ', $conditions);
            $totalSQL   .= 'WHERE ' . implode(' AND ', $conditions);
        }

        if ($returnSQL) {
            return $sql;
        }

        $template = $this->object . '/show.php';
        $limit = true;
        $this->checkPermissions('show', $data);

        $hidden['do'] = $data['do'];

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        $sql    .= ' ORDER BY ';
        $totalsql.= ' ORDER BY ';

        $total    = $db->getOne(transformToGetCount($totalSQL));

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);

        $this->changePermissions($total);

        include $template;
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        global $Log, $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
            case ROLES_ADMINISTRATOR:
                $this->formDescription['fields'][ $this->getFieldPositionByName('recipient_roles_id') ]['condition']    = 'id = ' . ROLES_AGENT . ' OR id = ' . ROLES_CLIENT_CONTACT;
                break;
            default:
                $this->formDescription['fields'][ $this->getFieldPositionByName('recipient_roles_id') ]['type']    = fldHidden;
                break;
        }

        $this->formDescription['fields'][ $this->getFieldPositionByName('author_roles_id') ]['type']    = fldHidden;

        if ($data['do'] == $this->object . '|insertInWindow') {
            $template = 'formInWindow.php';
        }

        $data['isPresent'] = $Log->isPresent();
		$data['manual'] = 1;
        return parent::showForm($data, $action, $actionType, $template);
    }

    function clearCookie() {
        if (is_array($_COOKIE['message'])) {
            foreach ($_COOKIE['message'] as $field => $value) {
                setcookie('message[' . $field . ']', '', time() - 3600);
                unset($_COOKIE['message'][ $field ]);
            }
        }
    }

    function send($id, $template=null) {
        global $db, $Templates;

        $sql =  'SELECT a.*, b.*, c.title as policy_statusesTitle, d.email ' .
                'FROM ' . $this->tables[0] . ' as a ' .
                'JOIN ' . PREFIX . '_policies as b ON a.policies_id = b.id ' .
                'JOIN ' . PREFIX . '_policy_statuses as c ON b.policy_statuses_id = c.id ' .
                'JOIN ' . PREFIX . '_accounts as d ON a.recipients_id = d.id ' .
                'WHERE a.id = ' . intval($id);
        $row = $db->getRow($sql);

        if (!$row['text']) {
            $row['text'] =
'Номер полісу (сертифікату): ' . $row['number'] . '<br /><br />

Статус: ' . $row['policy_statusesTitle'] . '<br /><br />

Перейти: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?do=Policies|load&id=' . $row['policies_id'] . '&product_types_id=' . $row['product_types_id'];
        }

		$Templates->send('', $row, $template, $row['subject'], $row['text'], 'ТДВ "Експрес Страхування"', 'do-not-reply@e-insurance.in.ua');

        return $Templates->send($row['email'], $row, $template, $row['subject'], $row['text'], 'ТДВ "Експрес Страхування"', 'do-not-reply@e-insurance.in.ua');
    }

    function getRecipientByPoliciesId($policies_id) {
        global $db;

        $sql =	'SELECT product_types_id, policy_statuses_id, agents_id, agencies_id, managers_id, clients_id ' .
				'FROM ' . PREFIX . '_policies as a ' .
				'WHERE id = ' . intval($policies_id);
        $row =	$db->getRow($sql);

        $result = null;

        switch ($row['policy_statuses_id']) {
            case POLICY_STATUSES_CREATED://полис создан клиентом
            //никому не отправляем сообщение
                break;
            case POLICY_STATUSES_SENT://созданный клиентом полис отправлен менеджеру, сообщение менеджеру
				if (intval($row['managers_id'])) {
					$result['managers'][] = $row['managers_id'];
				}
                break;
            case POLICY_STATUSES_ERROR://ошибки, менеджер обратно отправляет клиенту полис, сообщение клиенту
				if (intval($row['clients_id'])) {
					$result['clients'][] = $row['clients_id'];
				}
                break;
            case POLICY_STATUSES_RESENT://полис повторно клиентом направлен менеджеру, сообщение менеджеру
				if (intval($row['managers_id'])) {
					$result['managers'][] = $row['managers_id'];
				}
                break;
			case POLICY_STATUSES_REQUEST_QUOTE://запрос котировки у андеррайтера
				if (intval($row['managers_id'])) {
					$result['managers'][] = $row['managers_id'];
				}
				break;
			case POLICY_STATUSES_REQUEST_QUOTE_ERROR://ошибка в запросе к андеррайтеру
				if (intval($row['agencies_id'])) {
					$result['agencies'][] = $row['agencies_id'];
				}
				break;
			case POLICY_STATUSES_REQUEST_QUOTE_AGAIN://повторный запрос котировки к андеррайтеру
				if (intval($row['managers_id'])) {
					$result['managers'][] = $row['managers_id'];
				}
				break;
			case POLICY_STATUSES_QUOTE://котировка от андеррайтера
				if (intval($row['agencies_id'])) {
					$result['agencies'][] = $row['agencies_id'];
				}
				break;
			case POLICY_STATUSES_REQUEST_AGREEMENT://запрос договора страхования
				if (intval($row['managers_id'])) {
					$result['managers'][] = $row['managers_id'];
				}
				break;
            case POLICY_STATUSES_GENERATED://полис страхования сформирован, сообщение клиенту
				switch ($data['product_types_id']) {
					case PRODUCT_TYPES_CARGO_CERTIFICATE:
					case PRODUCT_TYPES_DRIVE_CERTIFICATE:
						if (intval($row['clients_id'])) {
							$result['clients'][] = $row['clients_id'];
						}
						break;
					default:
						if (intval($row['agencies_id'])) {
							$result['agencies'][] = $row['agencies_id'];
						}
				}
                break;
			 case POLICY_STATUSES_SPOILT://полис страхования зiпсован сообщение клиенту
			 case POLICY_STATUSES_CANCELLED://полис страхования анулирован сообщение клиенту
				if (intval($row['agencies_id'])) {
					$result['agencies'][] = $row['agencies_id'];
				}
                break;
        }

        return $result;
    }

    function getAdditionalData($data, $clients_id=null) {
        global $db, $Authorization;

        if (intval($data['policies_id'])) {
            $conditions[] = 'a.id = ' . intval($data['policies_id']);
        }

        if ($Authorization->data['roles_id'] == ROLES_CLIENT_CONTACT) {
            $clients_id = $Authorization->data['clients_id'];
        }

        if (intval($clients_id)) {
            $conditions[] = 'a.clients_id = ' . intval($clients_id);
        }

        $sql =  'SELECT a.id, a.agencies_id, a.agents_id, b.title as agencies_title, c.firstname as agentsFirstname, c.lastname as agentsLastname, a.clients_id, d.company as clientsCompany, a.client_contacts_id, e.firstname as clientsFirstname, e.lastname as clientsLastname, f.firstname as managersFirstname, f.lastname as managersLastname ' .
                'FROM ' . PREFIX . '_policies as a ' .
                'JOIN ' . PREFIX . '_agencies as b ON a.agencies_id = b.id ' .
                'JOIN ' . PREFIX . '_accounts as c ON a.agents_id = c.id ' .
                'LEFT JOIN ' . PREFIX . '_clients as d ON a.clients_id = d.id ' .
                'LEFT JOIN ' . PREFIX . '_accounts as e ON a.client_contacts_id = e.id OR ISNULL(a.client_contacts_id) ' .
                'LEFT JOIN ' . PREFIX . '_accounts as f ON a.managers_id=f.id OR ISNULL(f.id) ' .
                'WHERE ' . implode(' AND ', $conditions);
        $res = $db->query($sql);

        $res->fetchInto($row);

        $res->numRows();

        if ($res->numRows() != 1) {
            $row['clients_id'] = 0;
        }

        return $row;
    }

    function insert($data, $redirect=true) {
        global $db, $Log, $Authorization, $UNDERWRITING_POLICY_STATUSES;

        if (is_array($data['recipient_organizations_id'])) {

            foreach ($data['recipient_organizations_id'] as $field => $value) {
                if ($value) {
                    list($table, $id) = explode('|', $field);
                    $recipients[ $table ][] = $id;
                }
            }
        } elseif (intval($data['policies_id'])) {
			$recipients = ($data['recipients']) ? $data['recipients'] : $this->getRecipientByPoliciesId($data['policies_id']);
            if (!is_array($recipients)) {//некому отправлять
                return;
            }
        }

        if (!$data['subject'] && intval($data['policy_statuses_id'])) {
            $data['subject'] = Policies::getMessageSubjectByStatusesId($data['policy_statuses_id']);
            $data['manual'] = 0;
        } elseif (!isset($data['manual'])) {
            $data['manual'] = 1;
        }


        if (!$data['subject']) {
            $Log->add('error', 'Поле <b>Тема</b> є обов\'язкове для заповнення.');
        } elseif (!is_array($recipients)) {
            $Log->add('error', 'Поле <b>Отримувач</b> є обов\'язкове для заповнення.');

            if ($data['do'] == $this->object . '|insert') {
                $this->showForm($data, 'insert', 'insert', 'form.php');
            }
        } else {

            $Users = new Users($data);

            $values = $data;

            $values['authors_id']            = $Authorization->data['id'];
            $values['author_roles_id']        = $Authorization->data['roles_id'];
            $values['author']               = $Authorization->data['lastname'] . ' ' . $Authorization->data['firstname'];
            $values['author_organization']   = $Users->getOrganization($values['authors_id']);

            foreach ($recipients as $table => $recipients_id) {

                switch ($table) {
				
					case 'seller_agencies':
						foreach ($recipients_id as $agencies_id) {

                            $row = $this->getRecipient($data, 2);

                            $values['policies_id']               = $row['id'];
                            $values['clients_id']                = $row['clients_id'];

                            $values['recipient_roles_id']         = ROLES_AGENT;
                            $values['recipients_id']             = $row['agents_id'];
                            $values['recipient']                = $row['agentsLastname'] . ' ' . $row['agentsFirstname'];
                            $values['recipient_organization']    = $row['agencies_title'];

                            $id = parent::insert($values, false, false);
							$sql =  'REPLACE INTO ' . PREFIX . '_policy_message_views SET ' .
										'accounts_id = ' . intval($Authorization->data['id']) . ', ' .
										'messages_id = ' . intval($id) . ', ' .
										'policies_id = '. intval($data['policies_id']) . ', ' .
										'created = NOW()';
							$db->query($sql);
//                            $this->send($id);
                        }
                        break;

                    case 'agencies'://отправляем агенту
                        foreach ($recipients_id as $agencies_id) {

                            $row = $this->getRecipient($data, 1);

                            $values['policies_id']               = $row['id'];
                            $values['clients_id']                = $row['clients_id'];

                            $values['recipient_roles_id']         = ROLES_AGENT;
                            $values['recipients_id']             = $row['agents_id'];
                            $values['recipient']                = $row['agentsLastname'] . ' ' . $row['agentsFirstname'];
                            $values['recipient_organization']    = $row['agencies_title'];

                            $id = parent::insert($values, false, false);
							$sql =  'REPLACE INTO ' . PREFIX . '_policy_message_views SET ' .
										'accounts_id = ' . intval($Authorization->data['id']) . ', ' .
										'messages_id = ' . intval($id) . ', ' .
										'policies_id = '. intval($data['policies_id']) . ', ' .
										'created = NOW()';
							$db->query($sql);
//                            $this->send($id);
                        }
                        break;

                    case 'clients'://отправляем клиенту

                        foreach ($recipients_id as $clients_id) {

                            $row = $this->getAdditionalData($data, $clients_id);

                            $values['policies_id']               = $row['id'];
                            $values['agencies_id']               = $row['agencies_id'];
                            $values['clients_id']                = $row['clients_id'];

                            $values['recipient_roles_id']         = ROLES_CLIENT_CONTACT;
                            $values['recipients_id']             = $row['client_contacts_id'];
                            $values['recipient']                = $row['clientsLastname'] . ' ' . $row['clientsFirstname'];
                            $values['recipient_organization']    = $row['clientsCompany'];

                            $id = parent::insert($values, false, false);
							$sql =  'REPLACE INTO ' . PREFIX . '_policy_message_views SET ' .
										'accounts_id = ' . intval($Authorization->data['id']) . ', ' .
										'messages_id = ' . intval($id) . ', ' .
										'policies_id = '. intval($data['policies_id']) . ', ' .
										'created = NOW()';
							$db->query($sql);
//                            $this->send($id);
                        }
                        break;

                    case 'managers'://отправляем менеджеру

                        foreach ($recipients_id as $managers_id) {

                            $row = $this->getAdditionalData($data);

                            $values['policies_id']               = $row['id'];
                            $values['agencies_id']               = $row['agencies_id'];
                            $values['clients_id']                = $row['clients_id'];

                            $values['recipient_roles_id']         = ROLES_MANAGER;

							if (in_array(intval($data['policy_statuses_id']), $UNDERWRITING_POLICY_STATUSES)) {//!!!костыль
								$values['recipients_id']         = 3555;
								$values['recipient']            = 'Сімонова Лариса';
							} else {
								$values['recipients_id']			= $managers_id;
								$values['recipient']            = $row['managersLastname'] . ' ' . $row['managersFirstname'];
							}

                            $values['recipient_organization']    = 'ТДВ "Експрес Страхування"';

                            $id = parent::insert($values, false, false);
							$sql =  'REPLACE INTO ' . PREFIX . '_policy_message_views SET ' .
										'accounts_id = ' . intval($Authorization->data['id']) . ', ' .
										'messages_id = ' . intval($id) . ', ' .
										'policies_id = '. intval($data['policies_id']) . ', ' .
										'created = NOW()';
							$db->query($sql);
                            $this->send($id);
                        }
                        break;
                }
            }

            Policies::updateModified($data['policies_id']);

            $params['title']    = $this->messages['single'];
            $params['id']        = $id;
            $params['storage']    = $this->tables[0];

            if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return true;
            }
        }
    }
	
	function getRecipient($data, $type=1) {
		global $db;
		
		if (intval($data['policies_id'])) {
            $conditions[] = 'a.id = ' . intval($data['policies_id']);
        }
		
		switch ($type) {
			case 1:
		        $sql =  'SELECT a.id, a.agencies_id, a.agents_id, b.title as agencies_title, c.firstname as agentsFirstname, c.lastname as agentsLastname, a.clients_id ' .
					'FROM ' . PREFIX . '_policies as a ' .
					'JOIN ' . PREFIX . '_agencies as b ON a.agencies_id = b.id ' .
					'JOIN ' . PREFIX . '_accounts as c ON a.agents_id = c.id ' .
					'WHERE ' . implode(' AND ', $conditions);
				$res = $db->query($sql);
				$res->fetchInto($row);
				$res->numRows();
				if ($res->numRows() != 1) {
					$row['clients_id'] = 0;
				}
				return $row;
				break;
			case 2:
				$sql =  'SELECT a.id, a.agencies_id, a.agents_id, b.title as agencies_title, c.firstname as agentsFirstname, c.lastname as agentsLastname, a.clients_id ' .
					'FROM ' . PREFIX . '_policies as a ' .
					'JOIN ' . PREFIX . '_agencies as b ON a.seller_agencies_id = b.id ' .
					'JOIN ' . PREFIX . '_accounts as c ON a.seller_agents_id = c.id ' .
					'WHERE ' . implode(' AND ', $conditions);
				$res = $db->query($sql);
				$res->fetchInto($row);
				$res->numRows();
				if ($res->numRows() != 1) {
					$row['clients_id'] = 0;
				}
				return $row;
				break;
			case 3:
				return null;
				break;
			case 4:
				return null;
				break;
			default:
				return null;
				break;
		}
	}

    function addInWindow($data) {
        $this->checkPermissions('insert', $data);

        $this->getFormFields('insert');

        foreach($this->showFields as $field) {
            if ($field['type'] != fldHidden && $field['display']['change']) {
                $data[$field['name']] = '';
            }
        }

        $this->showForm($data, 'insert', 'insert', 'formInWindow.php');
    }

    function insertInWindow($data) {
        global $Log;

        if ($this->insert($data, false)) {

            $params['title']        = $this->messages['single'];
            $params['id']            = $data['id'];
            $params['storage']        = $this->tables[0];

            $result =
                '<div id="log">
                    <div class="caption">Повідомлення:</div>
                    <div class="confirm">' . vsprintf(translate($this->messages['insert']['confirm']), $params) . '</div>
                </div><br /><br /><br />';
        } else {
            $result = $this->addInWindow($data);
        }

        echo $result;
        exit;
    }

    function view($data) {
        global $db, $Authorization;

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->formDescription['fields'][ $this->getFieldPositionByName('author')]['type']        = fldText;
        $this->formDescription['fields'][ $this->getFieldPositionByName('recipient')]['type']    = fldText;

        $sql =  'SELECT a.*, CONCAT(\'<b>\', a.author, \'</b>, \', author_organization) as author, IF(a.recipient = \'\', a.recipient_organization, CONCAT(\'<b>\', a.recipient, \'</b>, \', recipient_organization)) as recipient, b.product_types_id ' .
                'FROM ' . PREFIX . '_policy_messages AS a ' .
                'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                'WHERE a.id = ' . intval($data['id']);

        $row = parent::view($data, null, $sql, null, true);

        $sql =  'REPLACE INTO ' . PREFIX . '_policy_message_views SET ' .
                'accounts_id = ' . $Authorization->data['id'] . ', ' .
                'messages_id = ' . $row['id'] . ', ' .
                'policies_id = '. $row['policies_id'] . ', ' .
                'created = NOW()';
        $db->query($sql);

        $data['id'] = $row['policies_id'];

        $Policies = Policies::factory($data, ProductTypes::get($row['product_types_id']));
        $Policies->view($data);
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db;

        $sql =  'DELETE ' .
                'FROM ' . PREFIX . '_policy_message_views ' .
                'WHERE messages_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

        return parent::deleteProcess($data, $i, $folder);
    }
}

?>