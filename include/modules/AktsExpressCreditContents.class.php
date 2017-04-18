<?

require_once 'Akts.class.php';
class AktsExpressCreditContents extends Form {

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
							'table'				=> 'akts_express_credit_contents'),
						  array(
                            'name'                => 'akts_id',
                            'description'        => 'Акт',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'orderPosition'		=> 1,
                            'table'                => 'akts_express_credit_contents'),	
						array(
							'name'				=> 'number',
							'description'		=> 'Номер анкети',
							'type'				=> fldText,
					        'maxlength'			=> 50,
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
							'orderPosition'		=> 2,
							'table'				=> 'akts_express_credit_contents'),
						 array(
							'name'				=> 'cars_title',
							'description'		=> 'Транспортний засіб',
							'type'				=> fldText,
					        'maxlength'			=> 150,
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
							'table'				=> 'akts_express_credit_contents'),
                         array(
							'name'				=> 'client',
							'description'		=> 'ПІБ Клієнта',
							'type'				=> fldText,
					        'maxlength'			=> 150,
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
							'orderPosition'		=> 4,
							'table'				=> 'akts_express_credit_contents'),
                        array(
							'name'				=> 'credit_amount',
							'description'		=> 'Сума кредиту, грн',
					        'type'				=> fldMoney,
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
							'orderPosition'		=> 6,
							'table'				=> 'akts_express_credit_contents'),
                        array(
							'name'				=> 'commission_percent',
							'description'		=> 'Комісія, %',
					        'type'				=> fldPercent,
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
							'orderPosition'		=> 7,
							'table'				=> 'akts_express_credit_contents'),
						array(
							'name'				=> 'commission_amount',
							'description'		=> 'Комісія, грн',
					        'type'				=> fldMoney,
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
							'orderPosition'		=> 8,
							'table'				=> 'akts_express_credit_contents'),
                       
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
							'table'				=> 'akts_express_credit_contents'),
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
							'orderPosition'		=> 11,
							'width'				=> 100,
							'table'				=> 'akts_express_credit_contents')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 11,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function AktsExpressCreditContents($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Анкети по кредитнi авто до сплати';
		$this->messages['single'] = 'Анкета по кредитнi авто до сплати';

		
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'					=> true,
					'insert'				=> true,
					'update'				=> true,
					'view'					=> false,
					'change'				=> true,
					'delete'				=> true);
				break;
			case ROLES_MANAGER:
                $Akts=new Akts($data);
				$this->permissions = $Authorization->data['permissions'][ get_class($Akts) ];
                $this->permissions['show'] = true;
                $this->permissions['view'] = true;
				break;
            case ROLES_AGENT:
                $this->permissions = array(
					'show'					=> true,
					'view'					=> true
					);
				break;
		
		}
	}
	
	


    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true)
    {

        parent::show($data, $fields, $conditions, $sql, $template, false);
    }

	

	
	
	
}

?>