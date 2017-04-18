<?
/*
 * Title: document class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class PenaltyActs extends Form {

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
							'table'				=> 'penalty_acts'),
						array(
							'name'				=> 'number',
							'description'		=> 'Номер акту',
					        'type'				=> fldText,
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
							'table'				=> 'penalty_acts'),
                        array(
							'name'				=> 'manager',
							'description'		=> 'ПІБ менеджера',
					        'type'				=> fldText,
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
							'orderPosition'		=> 2,
                            'width'             => 100,
							'table'				=> 'penalty_acts'),
                        array(
							'name'				=> 'Comment',
							'description'		=> 'Коментарій',
					        'type'				=> fldNote,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							//'orderPosition'		=> 3,
                            'width'             => 100,
							'table'				=> 'penalty_acts'),
						array(
							'name'				=> 'file',
							'description'		=> 'Файл',
					        'type'				=> fldFile,
							'display'			=>
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 3,
							'table'				=> 'penalty_acts'),
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
                            'orderPosition'     => 4,
							'table'				=> 'penalty_acts')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'number'
					)
			);

	function PenaltyActs($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Штрафи по актам';
		$this->messages['single'] = 'Штраф по акту';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'    => true,
					'view'		=> true,
					'change'	=> false,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
		}
	}

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true){
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

        $this->setTables('show');
        $this->setShowFields();

        if($data['number']){
            $fields[] = 'number';
            $conditions[] = 'number LIKE ' . $db->quote($data['number'] . '%');
        }

        if($data['from']){
            $fields[] = 'from';
            $conditions[] = 'TO_DAYS(' . $this->tables[0] . '.created) >= TO_DAYS(' . $db->quote( substr($data['from'], 6, 4) . substr($data['from'], 3, 2) . substr($data['from'], 0, 2) ) . ')';
        }

        if($data['to']){
            $fields[] = 'to';
            $conditions[] = 'TO_DAYS(' . $this->tables[0] . '.created) <= TO_DAYS(' . $db->quote( substr($data['to'], 6, 4) . substr($data['to'], 3, 2) . substr($data['to'], 0, 2) ) . ')';
        }

        if ($sql) {
            $sql    .= ' ORDER BY ';
        } elseif (is_array($conditions)) {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ' FROM ' . implode(', ', $this->tables) . ' WHERE ' . $this->getAssignmentConditions('show', '', ' AND ') . ' ' . implode(' AND ', $conditions) . ' ORDER BY ';
        } else {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ' FROM ' . implode(', ', $this->tables) . ' ' . $this->getAssignmentConditions('show', ' WHERE ') . ' ORDER BY ';
        }

        $total = $db->getOne(transformToGetCount($sql));

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

		$list = $db->getAll($sql);

        $this->changePermissions($total);

        $template = $this->object . '/show.php';
		include $template;
    }
}

?>