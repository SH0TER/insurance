<?
/*
 * Title: ProfileQuestions class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */


class ProfileQuestions extends Form {

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
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'profile_types_id as pt_id',
					        'type'				=> fldInteger,
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
							'orderPosition'		=> -1,
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'question',
							'description'		=> 'Запитання',
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
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'question_code',
							'description'		=> 'Код запитання',
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
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 2,
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'profile_types_id',
							'description'		=> 'Тип анкети',
					        'type'				=> fldSelect,
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
							'orderPosition'		=> 3,
							'sourceTable'		=> 'profile_types',
							'orderField'		=> 'id',
							'selectField'		=> 'title',
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'answers',
							'description'		=> 'Відповіді',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'maxlength'			=> 1000,
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'answers_code',
							'description'		=> 'Код відповіді',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'maxlength'			=> 1000,
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'info',
							'description'		=> 'Інформація',
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
									'canBeEmpty'	=> true
								),
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'required',
							'description'		=> 'Обов\'язковість',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 4,
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'other',
							'description'		=> 'Інше',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 5,
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'note',
							'description'		=> 'Замітка',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'profile_questions'),
						array(
							'name'				=> 'color',
							'description'		=> 'Колір',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true,
									'change'	=> true
								),
							'maxlength'			=> 6,
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'profile_questions'),
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
							'orderPosition'		=> 6,
                            'width'             => 100,
							'table'				=> 'profile_questions'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 7,
                            'width'             => 100,
                            'table'             => 'profile_questions'),
						array(
							'name'				=> 'order_position',
							'description'		=> 'Порядок виводу',
					        'type'				=> fldOrderPosition,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> false,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 150,
							'orderPosition'		=> 8,
							'table'				=> 'profile_questions'),	
						
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'id'
					)
			);

	function ProfileQuestions($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Запитання';
		$this->messages['single'] = 'Запитання';
		
		$this->renumerate = false;
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'delete'	=> true,
					'change'	=> true);
				break;
		}
	}
	
	function insert($data) {
		$data['redirect'] = '/index.php?do=Profiles|show';
		
		parent::insert($data);
	}
	
	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		$data['do'] = 'Profiles|show';

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}
	
	function getOrderPostionAdditionalField($data) {
        return '&pt_id=' . $data['pt_id'];
    }
	
	function changeOrderPositionToUp($data) {
		global $db, $Log;
		
		$order_position = $this->getOrderPosition($data['id']);

		$sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
				'order_position = order_position + 1 ' .
				'WHERE order_position = ' . intval($order_position - 1) . ' AND profile_types_id = ' . intval($data['pt_id']);
		$db->query($sql);

		$sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
				'order_position = ' . intval($order_position - 1) . ' ' .
				'WHERE id = ' . intval($data['id']);
		$db->query($sql);

		$Log->add('confirm', $this->messages['changeOrderPositionToUp']['confirm']);
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
	}
	
	function changeOrderPositionToDown($data) {
		global $db, $Log;
		
		$order_position = $this->getOrderPosition($data['id']);

        $sql =	'UPDATE ' . $this->tables[0] . ' SET ' .
                'order_position = order_position - 1 ' .
                'WHERE order_position = ' . intval($order_position + 1) . ' AND profile_types_id = ' . intval($data['pt_id']);
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

	function getNextOrderPosition($data) {
		global $db;
		
		$order_position = $db->getOne('SELECT MAX(order_position) + 1 FROM ' . PREFIX . '_profile_questions WHERE profile_types_id = ' . intval($data['profile_types_id']));
		
		if (!intval($order_position)) {
			$order_position = 1;
		}
		
		return $order_position;
	}	
}

?>