<?
/*
 * Title:  commission class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class Commissions extends Form {

    var $formDescription =
            array(
                'fields'     =>
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
							'table'				=> 'commissions'),
					array(
							'name'				=> 'agent_commission',
							'description'		=> 'Комісія агент',
					        'type'				=> fldPercent,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'orderPosition'		=> 1,
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'commissions'),
					 
                    array(
							'name'				=> 'agency_commission',
							'description'		=> 'Комісія агенція',
					        'type'				=> fldPercent,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'orderPosition'		=> 2,
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'commissions'),
					 
							
						array(
							'name'				=> 'director1_commission',
							'description'		=> 'Комісія директор',
					        'type'				=> fldPercent,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'orderPosition'		=> 3,
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'commissions'),
						array(
							'name'				=> 'director2_commission',
							'description'		=> 'Комісія заст. директора',
					        'type'				=> fldPercent,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'orderPosition'		=> 4,
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'commissions'),
							
						array(
							'name'				=> 'manager_commission',
							'description'		=> 'Комісія Менеджер що привiв клiєнта',
					        'type'				=> fldPercent,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'orderPosition'		=> 5,
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'commissions'),


						array(
							'name'				=> 'seller_agents_commission',
							'description'		=> 'Комісія Менеджер продавець',
					        'type'				=> fldPercent,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'orderPosition'		=> 6,
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'commissions'),
							
                        array(
                            'name'              => 'comment',
                            'description'       => 'Коментар',
                            'type'              => fldText,
                            'maxlength'         => 200,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
							'orderPosition'		=> 7,
                            'table'             => 'commissions'),
						array(
							'name'				=> 'agencies_id',
							'description'		=> 'Агенції',
					        'type'				=> fldMultipleSelect,
							'structure'			=> 'tree',
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
							'table'				=> 'commissions_agency_assignments',
							'sourceTable'		=> 'agencies',
							'selectField'		=> 'CONCAT(code, \' \', title)',
							'orderField'		=> 'CAST(code AS UNSIGNED)'),
						array(
                            'name'              => 'products_id',
                            'description'       => 'Страховi продукти',
                            'type'              => fldMultipleSelect,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true,
                                    'change'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'commissions_product_assignments',
                            'sourceTable'       => 'products',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),

                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'commissions'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 10,
                            'width'             => 100,
                            'table'             => 'commissions')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 10,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'id'
                    )
            );

    function Commissions($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Комісії';
        $this->messages['single'] = 'Комісія';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
					'copy'		=> true,
                    'update'    => true,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
        }
    }

	function copy($data) {
		$this->checkPermissions('copy', $data);

		$data = $this->load($data, false);
		$this->add($data);
	}

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true)
    {
        global $db, $Authorization;

        $this->checkPermissions('show', $data);

        $this->mode = 'update';

        $hidden['do'] = $data['do'];

        if (is_array($fields)) {
            foreach($fields as $name) {
                $hidden[ $name ] = $data[ $name ];
            }
        }

        $this->setTables('show');
        $this->setShowFields();

        if ($sql) {
            $sql    .= ' ORDER BY ';
        } elseif (is_array($conditions)) {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ' FROM insurance_commissions ' . implode(', ', $this->tables) . ' WHERE ' . $this->getAssignmentConditions('show', '', ' AND ') . ' ' . implode(' AND ', $conditions) . ' ORDER BY ';
        } elseif ($data['agencie_id']) {
            $sql = 'SELECT ' . $this->getShowFieldsSQLString() .
                ', insurance_agencies.title FROM insurance_agencies, insurance_commissions_agency_assignments, '
                . implode(', ', $this->tables) . ' ' . $this->getAssignmentConditions('show', ' WHERE ') .
                (($this->getAssignmentConditions('show', ' WHERE ')) ? ' AND ' : 'WHERE ') .
                'insurance_commissions_agency_assignments.agencies_id = insurance_agencies.id AND insurance_commissions_agency_assignments.commissions_id = insurance_commissions.id AND insurance_commissions_agency_assignments.agencies_id = ' . $db->quote($data['agencie_id']) . ' ORDER BY ';

            unset($this->tables);
            $this->formDescription['fields'][] = array(
                'name' => 'title',
                'description' => 'Агенція',
                'type' => fldText,
                'maxlength' => 200,
                'display' =>
                    array(
                        'show' => true,
                        'insert' => true,
                        'view' => true,
                        'update' => true
                    ),
                'verification' =>
                    array(
                        'canBeEmpty' => true
                    ),
                'orderPosition' => 8,
                'table' => 'agencies'
            );

            $this->setTables('show');
            $this->setShowFields();
        } else {
            $sql    = 'SELECT ' . $this->getShowFieldsSQLString() . ' FROM ' . implode(', ', $this->tables) . ' ' . $this->getAssignmentConditions('show', ' WHERE ') . ' ORDER BY ';
        }

        $total	= $db->getOne(transformToGetCount($sql));

        $sql .= $this->getShowOrderCondition();

        if ($limit) {
            $sql .= ' LIMIT ' . intval($data['offset' . $this->objectTitle . 'Block']) . ', ' . intval($Authorization->data['records_per_page']);
        }

        $list = $db->getAll($sql);

        $this->changePermissions($total);

        /* Получение списка агенций */
        $sql = 'SELECT id, title, code FROM insurance_agencies';
        $tlist = $db->getAll($sql);

        $list_agencies[][] = null;

        foreach($tlist as $agencie)
        {
            if (floatval($agencie['code']) && intval($agencie['code']) != floatval($agencie['code']))
                $list_agencies[intval($agencie['code'])-1][intval(substr($agencie['code'], strpos($agencie['code'], '.')+1))] = $agencie;
            else
                $list_agencies[intval($agencie['code'])-1][0] = $agencie;
        }



        //_dump($list_agencies);exit;
        include 'Commissions/' . $template;
    }

	function setAdditionalFields($data) {
		global $db;

		if (is_array($data['products_id']) && sizeof($data['products_id'])>0) {

			$sql =	'SELECT * FROM ' . PREFIX . '_commissions_product_assignments AS a ' .
					'JOIN ' . PREFIX . '_commissions_agency_assignments AS b ON a.commissions_id = b.commissions_id ' .
					'WHERE a.commissions_id <> ' . intval($data['id']) . ' AND b.commissions_id <> ' . intval($data['id']) . (is_array($data['agencies_id']) && sizeof($data['agencies_id'])>0 ? ' AND agencies_id  IN(' . implode(', ', $data['agencies_id']) . ')' : '') .
					(is_array($data['products_id']) && sizeof($data['products_id'])>0 ? ' AND products_id IN(' . implode(', ', $data['products_id']) . ')' : '');
			$list = $db->getAll($sql);

			foreach ($list as $row) {
				//$db->query('DELETE FROM ' . PREFIX . '_commissions_product_assignments WHERE products_id = ' . intval($row['products_id']) . ' AND commissions_id =' . intval($row['commissions_id']));
			}
		}
	}
	
	function insert($data, $redirect=true) {
		global $Log;

		$data['id'] = parent::insert($data, false);

		if ($data['id']) {
 
			$this->setAdditionalFields($data);

			if ($redirect) {
				$params['title']		= $this->messages['single'];
				$params['id']			= $data['id'];
				$params['storage']		= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: ' . $data['redirect']);
				exit;
			} else {
				return $data['id'];
			}
		}
	}
	
	function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
		global $Log;

		$data['id'] = parent::update($data, false, $showForm, $checkFieldsAndReturn);

		$this->setAdditionalFields($data);

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
        global $db, $Authorization;
		$this->tables = array($this->tables[0]);
		return parent::deleteProcess($data, $i , $folder);

    }
}

?>