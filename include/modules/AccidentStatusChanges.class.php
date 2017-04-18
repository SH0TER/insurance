<?
/*
 * Title: accident status changes class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class AccidentStatusChanges extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'accidents_id',
                            'description'       => 'Випадок',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'             => 'accident_status_changes',
                            'sourceTable'       => 'accidents',
                            'selectField'       => 'number',
                            'orderField'        => 'number'),
                        array(
                            'name'              => 'accident_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'orderPosition'     => 1,
                            'table'             => 'accident_status_changes'),
                        array(
                            'name'              => 'accounts_title',
                            'description'       => 'Менеджер',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'orderPosition'     => 2,
                            'table'             => 'accident_status_changes'),
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
                                    'canBeEmpty'	=> false
                                ),
                            'orderPosition'     => 3,
                            'width'             => 100,
                            'table'             => 'accident_status_changes')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'	=> 3,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'created'
                    )
            );

    function AccidentStatusChanges($data, $objectTitle=null) {
		Form::Form($data);

        $this->messages['plural'] = 'Історія';
        $this->messages['single'] = 'Історія';
    }

    function setPermissions($data) {
		global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
            case ROLES_MASTER:
                $this->permissions = array(
                    'show'	=> true);
                break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db;

if($data['product_types_id'] == PRODUCT_TYPES_DRIVE_CERTIFICATE){
            $data['product_types_id'] = PRODUCT_TYPES_KASKO;
        }

		$fields[] = 'accidents_id';

		$conditions[] = PREFIX . '_accident_status_changes.accidents_id = ' . intval($data['accidents_id']);
        $conditions[] = PREFIX . '_accident_statuses_descriptions.product_types_id IN (1,' . $data['product_types_id']. ')';

        $sql = 'SELECT date_format(' . PREFIX . '_accident_status_changes.created, ' . $db->quote(DATETIME_FORMAT) . ') as created_format, ' . PREFIX . '_accident_statuses_descriptions.description as accident_statuses_id, ' . PREFIX . '_accident_status_changes.accounts_title '.
               'FROM ' . PREFIX . '_accident_status_changes  ' .
               'JOIN ' . PREFIX . '_accident_statuses ON ' . PREFIX . '_accident_status_changes.accident_statuses_id = ' . PREFIX . '_accident_statuses.id ' .
               'JOIN ' . PREFIX . '_accident_statuses_descriptions ON ' . PREFIX . '_accident_statuses.id = ' . PREFIX . '_accident_statuses_descriptions.accident_statuses_id ' .
               'WHERE ' . implode(' AND ', $conditions);

		return parent::show($data, $fields, $conditions, $sql, $this->object . '/' . $template, $limit);
	}

    function calculateDuration($accidents_id){
        global $db;

        $sql =	'SELECT UNIX_TIMESTAMP(created) AS created ' .
				'FROM ' . PREFIX . '_accident_status_changes AS a ' .
				'WHERE accidents_id = ' . intval($accidents_id) . ' ' .
				'ORDER BY created DESC ' .
				'LIMIT 2';

		$list = $db->getCol($sql);

		return  $list[0] - $list[1];
	}

	//устанавливаем пользователя, кто вносил изменения
	function set($accidents_id, $accident_statuses_id=null,$buh=false) {
		global $db, $Authorization;

		$duration = $this->calculateDuration($accidents_id);
		$accounts_title = $db->quote($Authorization->data['lastname'] . ' ' . $Authorization->data['firstname']);
		$accounts_id = intval($Authorization->data['id']);
		
		if ($buh) //пользователь бухгалтерия
		{
			$accounts_title = $db->quote('Бухгалтерия');
			$accounts_id = ACCOUNT_BUH;
		}
		
		if (is_null($accident_statuses_id)) {
			$sql =	'UPDATE ' . PREFIX . '_accident_status_changes SET ' .
					'accounts_id = ' . $accounts_id . ', ' .
					'accounts_title = ' . $accounts_title . ', ' .
					'duration = 0 ' .
					'WHERE accidents_id = ' . intval($accidents_id) . ' AND accounts_id = 0 ' .
					'ORDER BY created DESC ' .
					'LIMIT 1';
			$db->query($sql);

            $sql  = 'SELECT created FROM ' . PREFIX . '_accident_status_changes ' .
                    'WHERE `accidents_id`  = ' . intval($accidents_id) . ' ' .
                    'ORDER BY created '.
                    'DESC LIMIT 1,1';
            $created = $db->getOne($sql);

            $sql =  'UPDATE ' . PREFIX . '_accident_status_changes as a ' .
                    'SET ' .
				    'duration = ' . $duration . ' ' .
				    'WHERE accidents_id = ' . intval($accidents_id) . ' AND created = ' . $db->quote($created);
			$db->query($sql);

		} else {
			$sql =	'INSERT INTO ' . PREFIX . '_accident_status_changes SET ' .
					'accidents_id = ' . intval($accidents_id) . ', ' .
					'accident_statuses_id = ' . intval($accident_statuses_id) . ', ' .
					'accounts_id = ' . $accounts_id . ', ' .
					'accounts_title = ' . $accounts_title . ', ' .
					'duration = ' . $duration . ', ' .
					'created = NOW()';
			$db->query($sql);
		}
       
	}
}

?>