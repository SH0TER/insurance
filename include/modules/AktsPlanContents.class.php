<?


class AktsPlanContents extends Form {

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
							'table'				=> 'akts_plan_contents'),
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
                            'table'                => 'akts_plan_contents'),	
						array(
							'name'				=> 'number',
							'description'		=> 'Полис',
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
							'table'				=> 'akts_plan_contents'),

						array(
                            'name'                => 'policies_id',
                            'description'        => 'Полис',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'akts_plan_contents'),
                       	array(
							'name'				=> 'types_id',
							'description'		=> 'Тип',
					        'type'				=> fldRadio,
					        'list'				=> array(
					        						1 => 'Кредит/КАСКО Банк',
                                                    2 => 'Не кредитнi авто',
                                                    3 => 'Пролонгованi авто',
                                                    4 => 'ЦВ авто',
													5 => 'НВ',
													6 => 'ДГО',
													8 => 'Рiтейл агенцiя',
													9 => 'Вiддiл продажу КАСКО',
													10 => 'Дострахування',
													11 => 'Вiддiл продажу ЦВ',
													12 => 'Вiддiл продажу ДГО',
													13 => 'КАСКО Менеджер що привiв клiєнта',
													14 => 'ЦВ Менеджер що привiв клiєнта',
													15 => 'ДГО Менеджер що привiв клiєнта'
													),
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
                            'orderPosition'		=> 7,
							'table'				=> 'akts_plan_contents'),
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
							'table'				=> 'akts_plan_contents'),
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
							'table'				=> 'akts_plan_contents')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 7,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'number'
					)
			);

	function AktsPlanContents($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Факт виконання плану';
		$this->messages['single'] = 'Факт виконання плану';

		
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'					=> true,
					'insert'				=> false,
					'update'				=> false,
					'view'					=> false,
					'change'				=> false,
					'delete'				=> true);
				break;
			case ROLES_MANAGER:
                $Akts=new Akts($data);
				$this->permissions = $Authorization->data['permissions'][ get_class($Akts) ];
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