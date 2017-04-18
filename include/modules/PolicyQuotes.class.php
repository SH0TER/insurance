<?
/*
 * Title: policy quote class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class PolicyQuotes extends Form {

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
                            'table'             => 'policy_quotes'),
                        array(
                            'name'              => 'policies_id',
                            'description'       => 'Поліс',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'width'             => 60,
                            'orderPosition'     => 1,
                            'table'             => 'policy_quotes',
                            'sourceTable'       => 'policies',
                            'selectField'       => 'number',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'author_roles_id',
                            'description'       => 'Автор',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policy_quotes',
                            'sourceTable'       => 'roles',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'authors_id',
                            'description'       => 'Автор',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policy_quotes'),
                        array(
                            'name'              => 'author',
                            'description'       => 'Автор',
                            'type'              => fldText,
//                            'jTip'              => '/index.php?do=Users|getContactInWindow&amp;usersId={$authors_id}',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 2,
                            'table'             => 'policy_quotes'),
                        array(
                            'name'              => 'author_organization',
                            'description'       => 'Автор',
                            'type'              => fldText,
//                            'jTip'            => '/index.php?do=Users|getContactInWindow&amp;usersId={$authors_id}',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policy_quotes'),
                        array(
                            'name'              => 'value',
                            'description'       => 'Параметри',
                            'type'              => fldNote,
                            'maxlength'         => 50,
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
                            'table'             => 'policy_quotes'),
                        array(
                            'name'              => 'comment',
                            'description'       => 'Коментар',
                            'type'              => fldNote,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 3,
                            'table'             => 'policy_quotes'),
                        array(
                            'name'              => 'file',
                            'description'       => 'Параметри',
                            'type'              => fldFile,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 4,
                            'table'             => 'policy_quotes'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDateTime,
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
                            'orderPosition'     => 5,
                            'width'             => 120,
                            'table'             => 'policy_quotes')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 5,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'created'
                    )
            );

    function PolicyQuotes($data, $objectTitle=null) {
        Form::Form($data);

        $this->messages['plural'] = 'Запити';
        $this->messages['single'] = 'Запит';
    }

    function setPermissions($data) {
		global $Authorization;
        switch ($_SESSION['auth']['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => false,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_AGENT:
            case ROLES_CLIENT_CONTACT:
			case ROLES_GENERALI_MANAGER:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => false,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => false);
                break;
        }

    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
	
		$data['offset' . $this->objectTitle . 'Block'] = intval($data['offset' . $this->objectTitle . 'Block']) + 1;
		return parent::show($data, $fields, $conditions, $sql, $this->object . '/show.php', $limit);
	}

    function insert($data) {
        global $db, $Authorization;

        $product_types_id = Policies::getProductTypesId($data['id']);

        $Policies = Policies::factory($data, ProductTypes::get($product_types_id));

		$Policies->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => true,
                    'view'      => true,
                    'change'    => true,
                    'delete'    => true);

		$data['checkPermissions'] = 1;

        $value = $Policies->load($data, false);

        $sql =	'INSERT INTO ' . PREFIX . '_policy_quotes SET ' .
                'policies_id = ' . intval($data['id']) . ', ' .
                'author_roles_id = ' . intval($Authorization->data['roles_id']) . ', ' .
                'authors_id = ' . intval($Authorization->data['id']) . ', ' .
                'author = ' . $db->quote($Authorization->data['lastname'] . ' ' . $Authorization->data['firstname']) . ', ' .
                'author_organization = ' . $db->quote($Authorization->data['organizationsTitle']) . ', ' .
                'value = ' . $db->quote(serialize($value)) . ', ' .
                'comment = ' . $db->quote($data['comment']) . ', ' .
				'file= 1, ' .
                'created = NOW()';
        $db->query($sql);
    }

	function getValue($id) {
		global $db;

		$sql =	'SELECT value ' .
				'FROM ' . PREFIX . '_policy_quotes ' .
				'WHERE id = ' . intval($id);
		$result = $db->getOne($sql);

		if ($result) {
			$result = unserialize($result);
			if ($result['items']) {
				$result['cars_count'] = sizeOf($result['items']);
			}
		}

		return $result;
	}

    function downloadFileInWindow($data) {

        $this->checkPermissions('view', $data);

        include $this->object . '/header.php';

        $file = unserialize($data['file']);

		$data['quote'] = $this->getValue($file['id']);

        $product_types_id = Policies::getProductTypesId($data['policies_id']);

        $data['id'] = $data['policies_id'];
		$data['checkPermissions'] = 1;

        $Policies = Policies::factory($data, ProductTypes::get($product_types_id));
        $Policies->load($data, true, 'view', 'view', 'kasko.php');

        include $this->object . '/footer.php';
    }
}

?>