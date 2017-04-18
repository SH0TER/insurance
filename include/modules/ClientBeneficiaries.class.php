<?
/*
 * Title: client beneficiary class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ClientBeneficiaries extends Form {

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
                        'table'             => 'client_beneficiaries'),
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
                        'table'             => 'client_beneficiaries'),
                    array(
                        'name'              => 'title',
                        'description'       => 'Назва',
                        'type'              => fldText,
                        'maxlength'         => 150,
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
                        'table'             => 'client_beneficiaries'),
                    array(
                        'name'              => 'title_en',
                        'description'       => 'Назва (англійська)',
                        'type'              => fldText,
                        'maxlength'         => 150,
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
                        'table'             => 'client_beneficiaries'),
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
                        'orderPosition'     => 3,
                        'width'             => 100,
                        'table'             => 'client_beneficiaries'),
					array(
						'name'				=> 'modified',
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
								'canBeEmpty'	=> false
							),
						'width'             => 100,
						'orderPosition'     => 4,
						'table'             => 'client_beneficiaries')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 1,
                        'defaultOrderDirection' => 'asc',
                        'titleField'            => 'login'
                    )
        );

    function ClientBeneficiaries($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Вигодонабувачі';
        $this->messages['single'] = 'Вигодонабувач';
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

    function getListToChoose($clients_id) {
        global $db;

		$conditions[] = 'clients_id = ' . intval($clients_id);

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_client_beneficiaries ' .
				'WHERE ' . implode(' AND ', $conditions);
        $res = $db->query($sql);

        $result = '<div id="beneficiaries" style="display:none">';

        while($res->fetchInto($row)) {
            $result .= '<a href="javascript: setBeneficiaryFields(' . $db->quote($row['title']) . ', ' . $db->quote($row['title_en']) . ')"><strong>' . $row['title'] . '</strong></a><br />';
        }

        $result .= '</div>';

        return $result;
    }
}

?>
