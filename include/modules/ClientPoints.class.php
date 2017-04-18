<?
/*
 * Title: client point class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ClientPoints extends Form {

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
                        'table'             => 'client_points'),
                    array(
                        'name'              => 'clients_id',
                        'description'       => 'Клієнт',
                        'type'              => fldHidden,
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => false,
                                'update'    => false
                            ),
                        'verification'      =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'             => 'client_points'),
                    array(
                        'name'              => 'title',
                        'description'       => 'Назва',
                        'type'              => fldText,
                        'maxlength'         => 100,
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
                        'table'             => 'client_points'),
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
                        'orderPosition'     => 10,
                        'width'             => 100,
                        'table'             => 'client_points')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 1,
                        'defaultOrderDirection' => 'asc',
                        'titleField'            => 'login'
                    )
        );

    function ClientPoints($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Пункти відправлення та призначення';
        $this->messages['single'] = 'Пункт відправлення чи призначення';
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
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
        }
    }

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {

		if (intval($data['clients_id'])) {
			$conditions[] = 'clients_id = ' . intval($data['clients_id']);
		}

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}
}

?>
