<?
/*
 * Title: AccidentRegressionPayments class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

//require_once 'AccidentRegressionCulprits.class.php';

class AccidentRegressionPayments extends Form {

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
							'table'				=> 'accident_regression_payments'),
						array(
							'name'				=> 'accident_regression_culprits_id',
							'description'		=> 'Інша сторона',
					        'type'				=> fldHidden,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> -1,
							'table'				=> 'accident_regression_payments'),
						array(
							'name'				=> 'types_id',
							'description'		=> 'Вид',
					        'type'				=> fldSelect,
							'list'				=>
								array(
									1 => 'Претензія',
									2 => 'Позов'
								),
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
							'orderPosition'		=> -1,
							'table'				=> 'accident_regression_payments'),
						array(
							'name'				=> 'types_id',
							'description'		=> 'Вид',
					        'type'				=> fldText,
							'list'				=>
								array(
									1 => 'Претензія',
									2 => 'Позов'
								),
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
							'orderPosition'		=> 2,
							'table'				=> 'accident_regression_payments'),
						array(
							'name'				=> 'date',
							'description'		=> 'Дата отримання',
					        'type'				=> fldDateTime,
					        'input'				=> true,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 1,
							'table'				=> 'accident_regression_payments'),
						array(
							'name'				=> 'amount',
							'description'		=> 'Сума, грн.',
					        'type'				=> fldMoney,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 3,
							'table'				=> 'accident_regression_payments'),
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
							'orderPosition'		=> 4,
                            'width'             => 100,
							'table'				=> 'accident_regression_payments'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false
                                ),
                            'orderPosition'     => 5,
                            'width'             => 100,
                            'table'             => 'accident_regression_payments')
						
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 5,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'id'
					)
			);

	function AccidentRegressionPayments($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Cплати';
		$this->messages['single'] = 'Cплата';
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
					'delete'	=> true);
				break;
		}
	}
	
	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
	
		$conditions[] = 'accident_regression_culprits_id = ' . intval($data['accident_regression_culprits_id']);

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}
}

?>