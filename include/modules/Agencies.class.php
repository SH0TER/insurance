<?
/*
 * Title: agency class
 *
 * @author 
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';

class Agencies extends Form {

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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'code',
							'description'		=> 'Код',
					        'type'				=> fldUnique,
					        'maxlength'			=> 10,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 1,
							'table'				=> 'agencies'),
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
							'orderPosition'		=> 2,
							'table'				=> 'agencies'),
						array(
							'name'				=> 'edrpou',
							'description'		=> 'Код ЄДРПОУ:',
					        'type'				=> fldText,
					        'maxlength'			=> 10,
							'validationRule'	=> '^[0-9]{8,10}$',
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'director1',
							'description'		=> 'Посада 1, ПІБ у називному відмінку',
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'director2',
							'description'		=> 'Посада 1, ПІБ у родовому відмінку',
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'findirector1',
							'description'		=> 'Посада 2, ПІБ у називному відмінку',
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'findirector2',
							'description'		=> 'Посада 2, ПІБ у родовому відмінку',
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
							'table'				=> 'agencies'),
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
							'table'				=> 'agencies'),
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'ground',
							'description'		=> 'Керівник, діє на підставі',
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'ground_kasko_express',
							'description'		=> 'Договір КАСКО Експрес, діє на підставі',
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'ground_ns_express',
							'description'		=> 'Договір НС Експрес, діє на підставі',
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
							'table'				=> 'agencies'),	
						array(
							'name'				=> 'ground_kasko_generali',
							'description'		=> 'Договір КАСКО Гарант-Авто, діє на підставі',
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'ground_akt',
							'description'		=> 'Акт, діє на підставі',
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'agreement_number',
							'description'		=> 'Номер агенського договору',
					        'type'				=> fldText,
					        'maxlength'			=> 10,
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'agreement_date',
							'description'		=> 'Дата агенського договору',
					        'type'				=> fldDate,
					        'input'				=> true,
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
							'table'				=> 'agencies'),
						 
						array(
							'name'				=> 'bank',
							'description'		=> 'Банк',
					        'type'				=> fldText,
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
									'canBeEmpty'	=> true
								),
							'table'				=> 'agencies'),
						array(
							'name'				=> 'bank_mfo',
							'description'		=> 'Банк МФО',
					        'type'				=> fldText,
					        'maxlength'			=> 10,
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'bank_account',
							'description'		=> 'р/р у банку',
					        'type'				=> fldText,
					        'maxlength'			=> 25,
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
							'table'				=> 'agencies'),	
						array(
							'name'				=> 'generali_branches_id',
							'description'		=> 'Дирекція Гарант-Авто',
					        'type'				=> fldSelect,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'agencies',
							'sourceTable'		=> 'generali_branches',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
						array(
							'name'				=> 'agreement_number_generali',
							'description'		=> 'Номер агенського договору Гарант-Авто',
					        'type'				=> fldText,
					        'maxlength'			=> 10,
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
							'orderPosition'		=> 6,
							'table'				=> 'agencies'),
						array(
							'name'				=> 'agreement_date_generali',
							'description'		=> 'Дата агенського договору Гарант-Авто',
					        'type'				=> fldDate,
					        'input'				=> true,
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
							'table'				=> 'agencies'),
						array(
							'name'				=> 'regions_id',
							'description'		=> 'Область',
					        'type'				=> fldSelect,
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
							'table'				=> 'agencies',
							'sourceTable'		=> 'regions',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						 array(
                            'name'              => 'director1_id',
                            'description'       => 'Акти директор',
                            'type'              => fldSelect,
                            'selectId'          =>'id',
							'condition'			=> 'roles_id = 8',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'agencies',
							'sourceTable'       => 'accounts',
                            'selectField'       => 'CONCAT(lastname, \' \', firstname, \' \',patronymicname)',
                            'orderField'        => 'lastname'),	
						 array(
                            'name'              => 'director2_id',
                            'description'       => 'Акти заст. директора',
                            'type'              => fldSelect,
                            'selectId'          =>'id',
							'condition'			=> 'roles_id = 8',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'agencies',
							'sourceTable'       => 'accounts',
                            'selectField'       => 'CONCAT(lastname, \' \', firstname, \' \',patronymicname)',
                            'orderField'        => 'lastname'),
						array(
                            'name'              => 'director3_id',
                            'description'       => 'Акти заст. директора сервiс',
                            'type'              => fldSelect,
                            'selectId'          =>'id',
							'condition'			=> 'roles_id = 8',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'agencies',
							'sourceTable'       => 'accounts',
                            'selectField'       => 'CONCAT(lastname, \' \', firstname, \' \',patronymicname)',
                            'orderField'        => 'lastname'),
						 
                        array(
                            'name'              => 'director_fop_id',
                            'description'       => 'Директор ФОП',
                            'type'              => fldSelect,
                            'selectId'          => 'id',
							'condition'			=> 'roles_id = 8',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'agencies',
							'sourceTable'       => 'accounts',
                            'selectField'       => 'CONCAT(lastname, \' \', firstname, \' \',patronymicname)',
                            'orderField'        => 'lastname'),
						 array(
                            'name'                  => 'products_id',
                            'description'           => 'Страховi продукти',
                            'type'                  => fldMultipleSelect,
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => false,
                                    'update'        => true,
                                    'change'        => false
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'product_agency_assignments',
                            'sourceTable'           => 'products',
                            'selectField'           => 'title',
                            'orderField'            => 'title'),
						array(
							'name'				=> 'active',
							'description'		=> 'Активний',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 100,
							'table'				=> 'agencies'),
						array(
							'name'				=> 'alternative',
							'description'		=> 'Альтернативна мережа',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 100,
							'table'				=> 'agencies'),
						array(
							'name'				=> 'individual_motivation',
							'description'		=> 'Iндивiдуальна мотивацiя',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 100,
							'table'				=> 'agencies'),	
						array(
                            'name'                	=> 'ukravto',
                            'description'        	=> 'Корпорація "УкрАВТО"',
                            'type'                	=> fldBoolean,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'agencies'),
						array(
							'name'				=> 'synhronize',
							'description'		=> 'Синхронiзувати',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 100,
							'table'				=> 'agencies'),
						array(
							'name'				=> 'orderposition_report',
							'description'		=> 'Порядковая позиция Звiти',
					        'type'				=> fldInteger,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'agencies'),
						array(
							'name'				=> 'parent_id',
							'description'		=> 'Агенцiя',
					        'type'				=> fldHidden,
					        'structure'			=> 'tree',
							'searchType'		=> 'attribute',
							'condition'			=> 'parent_id=0',
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
							'table'				=> 'agencies'),
						 array(
                            'name'              => 'financial_institutions_id',
                            'description'       => 'Банк',
                            'type'              => fldSelect,
                            'showId'            => true,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'agencies',
                            'sourceTable'       => 'financial_institutions',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),	
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
							'table'				=> 'agencies'),
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
							'table'				=> 'agencies')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function Agencies($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Агенції';
		$this->messages['single'] = 'Агенція';

		if ($data['parent_id']) {
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('position') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('lastname') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('firstname') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('patronymicname') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('ground') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('agreement_date') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('agreement_number') ]);
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('bank') ]);
		}
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
					'delete'				=> true,
					'export'				=> true,
					'downloadFileInWindow'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
			case ROLES_AGENT:
				$this->permissions = array(
					'downloadFileInWindow'	=> true);
				break;
		}
	}

	function setTables($action=null) {

		parent::setTables($action);

		if ($action == 'delete') {
			$this->tables = array($this->tables[0]);
		}
	}

	function getShowOrderCondition() {
		$direction = (ereg('^(asc|desc)$', $_COOKIE[ $this->object ]['orderDirection']))
			? $_COOKIE[ $this->object ]['orderDirection']
			: $this->formDescription['common']['defaultOrderDirection'];

		$field = $this->getFieldNameByOrderPosition($_COOKIE[$this->object]['orderPosition']);

		if ($field == PREFIX . '_agencies.code') {
			$field = 'CAST(' . PREFIX . '_agencies.code AS UNSIGNED), num_l';
		}

		return ($field)
			? $field . ' ' . $direction
			: $this->getFieldNameByOrderPosition($this->formDescription['common']['defaultOrderPosition']) . ' ' . $direction;
	}

	function show($data, $fields=null, $conditions=null, $sql=null, $template='templates/Agencies/show.php', $limit=true) {

		$fields[]		= 'id';
		$conditions[]	= 'parent_id = ' . intval($data['parent_id']);

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}

	function setCode($id, $parent_id) {
		global $db;

		$code = '';
        $num_l = 0;
        $top = 0;

		if ($parent_id != 0) {
			$sql =	'SELECT MAX(CAST(SUBSTRING_INDEX(code, \'.\', -1) AS UNSIGNED)) ' .
					'FROM ' . $this->tables[0] . ' AS a ' .
					'WHERE parent_id = ' . intval($parent_id);
			$code = $db->getOne($sql);
            $num_l = $code + 1;
			$code = ($code > 0) ? $parent_id . '.' . ($code + 1) : $parent_id . '.1';
            $top = $parent_id;
		} else {
			$code = $id;
            $top = $id;
		}

		$sql =	'UPDATE ' . $this->tables[0] . ' SET ' .
				'code = ' . $db->quote($code) . ', ' .
                'num_l = ' . $num_l . ', ' .
                'top = ' . $top . ' ' .
				'WHERE id = ' .intval($id);
		$db->query($sql);
	}

	function synhronize(&$data) {
		if (E_IX_SYNHRONIZATION != 1) return;

		$Client = new SoapClient(E_IX_URL . 'synchronization/express/index.php?wsdl');

		$result = $Client->synhronize(
					array(
						'type'	=> 'agencies',
						'data'		=> serialize($data)));
	}

	function insert($data, $redirect=true) {
		global $Log;

		$data['id'] = parent::insert($data, false);

		if ($data['id']) {

			$this->setCode($data['id'], $data['parent_id']);

			if ($data['synhronize'])
				$this->synhronize($data);

			if ($redirect) {
				$params['title']		= $this->messages['single'];
				$params['id']			= $data['id'];
				$params['storage']		= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: /?do=Agencies|show');
				exit;
			} else {
				return $data['id'];
			}
		}
	}

	function view($data) {
		if (intval($data['agencies_id'])) {
			$data['id'] = $data['agencies_id'];
		}

		$row = parent::view($data);

		if (!intval($row['parent_id'])) {
			$data['parent_id'] = $row['id'];
			$this->setObjectTitle('sub' . $this->objectTitle);

			$this->show($data);
		}

		$data['agencies_id'] = $row['id'];

		$fields		= array('agencies_id');
		$conditions	= array('agencies_id = ' . intval($data['agencies_id']));

		$Agents = Users::factory($data, 'Agents');
		$Agents->show($data, $fields, $conditions);
	}

	function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
		global $Log;

		$data['id'] = parent::update($data, false, $showForm, $checkFieldsAndReturn);

		if ($data['synhronize']) {
			$this->synhronize($data);
		}

		if ($redirect) {
			$params['title']	= $this->messages['single'];
			$params['id']		= $data['id'];
			$params['storage']	= $this->tables[0];

            $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
            header('Location: ' . $data['redirect']);
            exit;
        }

        return $data['id'];
	
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db, $Log;

		$Policies = new Policies($data);

		$sql =	'SELECT id ' . 
				'FROM ' . PREFIX . '_policies ' .
				'WHERE agencies_id IN(' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>' . $Policies->messages['plural'] . '</b>.');
			return false;
		}

		$Agents = Users::factory($data, 'Agents');

		$sql =	'SELECT accounts_id ' . 
				'FROM ' . $Agents->tables[1] . ' ' .
				'WHERE agencies_id IN(' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>' . $Agents->messages['plural'] . '</b>.');
			return false;
		}

		$sql =	'DELETE FROM ' . PREFIX . '_agency_commissions ' .
				'WHERE agencies_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		$sql =	'DELETE FROM ' . PREFIX . '_news_agency_assignments ' .
				'WHERE agencies_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		$sql =	'DELETE FROM ' . PREFIX . '_product_agency_assignments ' .
				'WHERE agencies_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}

	function exportInWindow($data) {
		global $db, $Smarty;

		$this->checkPermissions('export', $data);

		$sql =	'SELECT a.*, b.title AS regionsTitle,concat(a1.lastname,\' \',a1.firstname) as director1_akt, concat(a2.lastname,\' \',a2.firstname) as director2_akt, concat(a3.lastname,\' \',a3.firstname) as director3_akt  ' .
				'FROM ' . $this->tables[0] . ' AS a ' .
				'JOIN ' . PREFIX . '_regions AS b ON a.regions_id = b.id ' .
				'LEFT JOIN ' . PREFIX . '_accounts AS a1 ON a1.id = a.director1_id ' .
				'LEFT JOIN ' . PREFIX . '_accounts AS a2 ON a2.id = a.director2_id ' .
				'LEFT JOIN ' . PREFIX . '_accounts AS a3 ON a3.id = a.director3_id ' .
				'ORDER BY CAST(a.code AS UNSIGNED), a.title';
		$list = $db->getAll($sql, 3600);

		$Smarty->assign('list', $list);

		$result = $Smarty->fetch($this->object . '/export.tpl');

		header('Content-Disposition: attachment; filename="agencies.xls"');
		header('Content-Type: ' . $this->getContentType('agencies.xls'));
		header('Content-Length: ' . strlen($result));

		echo $result;
		exit;
	}
	
	function setListValues($data, $actionType='show') {
        global $Authorization;

        if (!intval($data['agencies_id'])) {
            $data['agencies_id']    = $data['id'];
        }

        $this->formDescription['fields'][ $this->getFieldPositionByName('director1_id') ]['condition'] .= ' AND  id IN(SELECT accounts_id FROM '.PREFIX.'_agents WHERE agencies_id='.intval($data['agencies_id']).')' ;
		$this->formDescription['fields'][ $this->getFieldPositionByName('director2_id') ]['condition'] .= ' AND  id IN(SELECT accounts_id FROM '.PREFIX.'_agents WHERE agencies_id='.intval($data['agencies_id']).')' ;
		$this->formDescription['fields'][ $this->getFieldPositionByName('director3_id') ]['condition'] .= ' AND  id IN(SELECT accounts_id FROM '.PREFIX.'_agents WHERE agencies_id='.intval($data['agencies_id']).')' ;
        $this->formDescription['fields'][ $this->getFieldPositionByName('director_fop_id') ]['condition'] .= ' AND  id IN(SELECT accounts_id FROM '.PREFIX.'_agents WHERE agencies_id='.intval($data['agencies_id']).')' ;
        parent::setListValues($data, $actionType);
    }

}

?>