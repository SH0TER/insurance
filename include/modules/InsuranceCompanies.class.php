<?
/*
 * Title: insurance companies class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */
require_once 'ReinsuranceAgreements.class.php';

class InsuranceCompanies extends Form {

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
							'table'				=> 'companies'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
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
							'orderPosition'		=> 1,
							'table'				=> 'companies'),
						array(
							'name'				=> 'edrpou',
							'description'		=> 'Код ЄДРПОУ',
					        'type'				=> fldUnique,
					        'maxlength'			=> 8,
							'validationRule'	=> '^[0-9]{8}$',
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
							'table'				=> 'companies'),
						array(
							'name'				=> 'director1',
							'description'		=> 'ПІБ у називному відмінку',
					        'type'				=> fldText,
					        'maxlength'			=> 100,
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
							'table'				=> 'companies'),
						array(
							'name'				=> 'director2',
							'description'		=> 'ПІБ у родовому відмінку',
					        'type'				=> fldText,
					        'maxlength'			=> 100,
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
							'table'				=> 'companies'),
							array(
							'name'				=> 'position',
							'description'		=> 'Посада',
					        'type'				=> fldText,
					        'maxlength'			=> 150,
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
							'table'				=> 'companies'),
						array(
							'name'				=> 'address',
							'description'		=> 'Адреса',
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
							'table'				=> 'companies'),
						array(
							'name'				=> 'phones',
							'description'		=> 'Телефони',
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
							'table'				=> 'companies'),
						array(
							'name'				=> 'banking_details',
							'description'		=> 'Банківські реквизити',
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
							'table'				=> 'companies'),				
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
							'table'				=> 'companies'),
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
							'orderPosition'		=> 2,
							'width'				=> 120,
							'table'				=> 'companies')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function InsuranceCompanies($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Страхові компанії';
		$this->messages['single'] = 'Страхова компанія';
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
					'delete'	=> true );
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
		}
	}

	function view($data) {
		if (intval($data['companies_id'])) {
			$data['id'] = $data['companies_id'];
		}

		$row = parent::view($data);

		$data['companies_id'] = $row['id'];

		$fields		= array('companies_id');
		$conditions	= array('companies_id = ' . intval($data['companies_id']));

		$ReinsuranceAgreements = new ReinsuranceAgreements($data);
		$ReinsuranceAgreements->show($data, $fields, $conditions);
	}
}

?>