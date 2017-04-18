<?
/*
 * Title: ReportBuilderOutputParameters class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ReportBuilderOutputParameters extends Form {

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
							'table'				=> 'reports_output_parameters'),
						  array(
                            'name'              => 'reports_id',
                            'description'       => 'Звіт',
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
							'orderPosition'		=> 1,	
                            'table'             => 'reports_output_parameters'),	
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
							'type'				=> fldText,
					        'maxlength'			=> 200,
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
							'table'				=> 'reports_output_parameters'),
						array(
							'name'				=> 'alias',
							'description'		=> 'Alias',
							'type'				=> fldText,
					        'maxlength'			=> 200,
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
							'table'				=> 'reports_output_parameters'),
						 array(
                            'name'              => 'types_id',
                            'description'       => 'Тип параметру',
                            'type'              => fldSelect,
                            'list'              => array(
													1 => 'Число',
													2 => 'Гроші',
													3 => 'Текст',
													4 => 'Дата',
													7 => 'Дата та час',
													5 => 'Булево',
													6 => 'Відсоток',
                                                    14 => 'Раціональне число'),
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'reports_output_parameters'),
                        array(
							'name'				=> 'link',
							'description'		=> 'Посилання',
							'type'				=> fldText,
					        'maxlength'			=> 200,
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
							'table'				=> 'reports_output_parameters'),
                        array(
							'name'				=> 'link_id',
							'description'		=> 'Ідентифікатор посилання',
							'type'				=> fldText,
					        'maxlength'			=> 30,
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
							'table'				=> 'reports_output_parameters'),
                         array(
							'name'				=> 'sum',
							'description'		=> 'Сумма',
							'type'				=> fldBoolean,
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
							'table'				=> 'reports_output_parameters'),
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
							'orderPosition'		=> 7,
							'table'				=> 'reports_output_parameters'),	
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
							'table'				=> 'reports_output_parameters'),
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
							'orderPosition'		=> 8,
							'width'				=> 100,
							'table'				=> 'reports_output_parameters')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 7,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ReportBuilderOutputParameters($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Звіти, параметри';
		$this->messages['single'] = 'Звіти, параметр';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'					=> true,
					'insert'				=> true,
					'update'				=> true,
					'view'					=> true,
					'change'				=> true,
					'delete'				=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
		}
	}

    function getNextOrderPosition(&$data) {
        global $db;

        $field = $this->getOrderPositionField();

        if (!$field) {
            return;
        }

        $order_position = $db->getOne('SELECT MAX(order_position) + 1 FROM ' . $this->tables[0] . ' WHERE reports_id = ' . intval($data['reports_id']));
        return (intval($order_position) == 0) ? 1 : $order_position;
    }

    function renumerate($data){
        global $db;

        $sql =  'SELECT * ' .
                'FROM ' . $this->tables[0] . ' ' .
                'WHERE reports_id = ' . intval($data['reports_id']) . ' ' .
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
}

?>