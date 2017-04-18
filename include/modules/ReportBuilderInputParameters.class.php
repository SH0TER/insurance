<?
/*
 * Title: ReportBuilderInputParameters class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ReportBuilderInputParameters extends Form {

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
							'table'				=> 'reports_input_parameters'),
						  array(
                            'name'              => 'reports_id',
                            'description'       => 'Звіт',
                            'type'              => fldHidden,
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
							'orderPosition'		=> 1,
                            'table'             => 'reports_input_parameters'),	
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
							'table'				=> 'reports_input_parameters'),
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
							'table'				=> 'reports_input_parameters'),
						 array(
                            'name'              => 'types_id',
                            'description'       => 'Тип параметру',
                            'type'              => fldSelect,
                            'list'              =>
								array(
									1 => 'Число',
									2 => 'Дата',
									3 => 'Булево',
									4 => 'Текст',
									5 => 'Страхова компанія',
									6 => 'Агенция',
									7 => 'Банк',
									8 => 'Марка',
									9 => 'Да/Нет',
									10 => 'СТО',
									11 => 'Ризик',
									12 => 'Статус',
									13 => 'Тип справи',
									14 => 'Менеджер',
									15 => 'Архiв',
									16 => 'Категорія справи',
									17 => 'Клас ремонту',
									21 => 'Статус оплаты',
									22 => 'Стан справи'
								),
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
                            'table'             => 'reports_input_parameters'),
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
							'table'				=> 'reports_input_parameters'),	
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
							'table'				=> 'reports_input_parameters'),
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
							'table'				=> 'reports_input_parameters')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 7,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ReportBuilderInputParameters($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Звіти, фільтри';
		$this->messages['single'] = 'Звіти, фільтр';
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
					'change'	=> true,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
		}
	}
}

?>