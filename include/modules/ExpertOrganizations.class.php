<?
/*
 * Title: experts class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ExpertOrganizations extends Form {

	var $formDescription =
			array(
				'fields' 	=>
					array(
						array(
							'name'				=> 'id',
					        'type'				=> fldIdentity,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'expert_organizations'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 100,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 1,
							'table'				=> 'expert_organizations'),
                        array(
                            'name'              => 'address',
                            'description'       => 'Адреса',
                            'type'              => fldText,
							'maxlength'			=> 100,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> true
                                ),
							'orderPosition'		=> 2,
                            'table'             => 'expert_organizations'),
                        array(
                            'name'              => 'identification_code',
                            'description'       => 'ІПН (ЄДРПОУ)',
                            'type'              => fldText,
							'maxlength'			=> 10,
							'validationRule'	=> '^([0-9]{8}|[0-9]{10})$',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'		=> 3,
                            'table'             => 'expert_organizations'),
                        array(
                            'name'              => 'bank_account',
                            'description'       => 'Розрахунковий рахунок',
                            'type'              => fldText,
							'maxlength'			=> 14,
							'validationRule'	=> '^([0-9]{0,14})$',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'		=>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'		=> 4,
                            'table'             => 'expert_organizations'),
                        array(
                            'name'              => 'bank',
                            'description'       => 'Банк',
                            'type'              => fldText,
							'maxlength'			=> 50,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'		=> 5,
                            'table'             => 'expert_organizations'),
                        array(
                            'name'              => 'bank_mfo',
                            'description'       => 'МФО',
                            'type'              => fldText,
							'maxlength'			=> 6,
							'validationRule'	=> '^([0-9]{6})$',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'	=> false
                                ),
							'orderPosition'		=> 6,
                            'table'             => 'expert_organizations'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'expert_organizations'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 7,
							'width'				=> 100,
							'table'				=> 'expert_organizations')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ExpertOrganizations($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Експертні організації';
		$this->messages['single'] = 'Експертна організація';
	}
    
	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'view'		=> true,
					'delete'	=> true);
				break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
		}
	}

    function view($data) {

        $row = parent::view($data);

        $data['expert_organizations_id'] = $row['id'];

        $fields     = array('expert_organizations_id');
        $conditions = array('expert_organizations_id = ' . intval($data['expert_organizations_id']));

        $Experts = Users::factory($data, 'Experts');
        $Experts->show($data, $fields, $conditions);
    }

    function getTitle($id) {
        global $db;

        $sql =	'SELECT title ' .
				'FROM ' . PREFIX . '_expert_organizations ' .
				'WHERE id='. intval($id);

        return $db->getOne($sql);
    }

	function getList() {
		global $db;

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_expert_organizations ' .
				'ORDER BY title';
		$list = $db->getAll($sql, 30 * 60);

		echo 'var experts = new Array();';
		if (is_array($list)) {
			foreach ($list as $i => $row) {
				echo 'experts[' . $i . '] = new Array(' . $db->quote($row['id']) . ', ' . $db->quote(htmlspecialchars_decode($row['title'])) . ', ' . $db->quote($row['identification_code']) . ', ' . $db->quote(htmlspecialchars_decode($row['bank'])) . ', ' . $db->quote($row['bank_mfo']) . ', '. $db->quote($row['bank_edrpou']) .',' . $db->quote($row['bank_account']) . ', \'\');';
			}
		}
	}
}

?>