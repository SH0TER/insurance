<?
/*
 * Title: PolicyPayments class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';

class PolicyPayments extends Form {

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
							'table'				=> 'policy_payments'),
						array(
							'name'				=> 'policies_id',
							'description'		=> 'Поліс',
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
							'table'				=> 'policy_payments'),
						array(
							'name'				=> 'datetime',
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
							'table'				=> 'policy_payments'),
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
							'orderPosition'		=> 2,
							'table'				=> 'policy_payments'),
						array(
							'name'				=> 'doc_number',
							'description'		=> 'Номер виписки',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 3,
							'table'				=> 'policy_payments'),
						array(
							'name'				=> 'payment_date',
							'description'		=> 'Дата квітанції',
					        'type'				=> fldDate,
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
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 4,
							'table'				=> 'policy_payments'),
						array(
							'name'				=> 'payment_number',
							'description'		=> 'Номер квитанції',
					        'type'				=> fldText,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 5,
							'table'				=> 'policy_payments'),
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
							'table'				=> 'policy_payments'),
						
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'id'
					)
			);

	function PolicyPayments($data) {
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
			case ROLES_AGENT:
			case ROLES_CLIENT_CONTACT:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> false,
					'update'	=> false,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> false);
				break;
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'view'		=> false,
					'change'	=> true,
					'changeForPayment'	=> true,
					'delete'	=> true);
				break;
		}
	}

	function show($data, $fields=null, $conditions=null, $sql=null, $template='PolicyPayments/show.php', $limit=true) {

		if (intval($data['clients_id'])) {
            $conditions[] = 'policies_id IN(SELECT id FROM ' . PREFIX . '_policies WHERE clients_id = ' . intval($data['clients_id']) . ')';
		}

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}

    function setAdditionalFields($id, $data) {
		global $db;

		$sql =	'UPDATE ' . PREFIX . '_policy_payments AS a ' .
				'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id SET ' .
				'a.clients_id = b.clients_id ' .
				'WHERE a.id = ' . intval($id);
		$db->query($sql);
	}

	function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
		global $Log;

		$data['id'] = parent::insert($data, false, true);

		if (intval($data['id'])) {

			$this->setAdditionalFields($data['id'], $data);

			Policies::setPaymentStatus($data['policies_id']);

			if ($redirect) {

				$params['title']		= $this->messages['single'];
				$params['id']			= $data['id'];
				$params['storage']		= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: ' . $data['redirect']);
				exit;
			} else {
				return $params['id'];
			}
		}
	}

	function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
		global $Log;

		if (parent::update($data, false, true)) {

			$this->setAdditionalFields($data['id'], $data);

			Policies::setPaymentStatus($data['policies_id']);

			if ($redirect) {

				$params['title']		= $this->messages['single'];
				$params['id']			= $data['id'];
				$params['storage']		= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $data['redirect']);
				exit;
			} else {
				return $params['id'];
			}
		}
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		parent::deleteProcess($data, $i, $folder);

		Policies::setPaymentStatus($data['policies_id']);
	}

	//получаем количество зашедших платежей по договору
	function getNumberByPoliciesId($policies_id) {
		global $db;

        $sql =  'SELECT count(*) ' .
                'FROM ' . PREFIX . '_policy_payments ' .
                'WHERE policies_id = ' . intval($policies_id);
        return $db->getOne($sql);
	}

    function change($data, $redirect=true) {
        global $db, $Log;

        $sql = 'SELECT number FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['policies_id']);
        $policies_number = $db->getOne($sql);

        foreach ($data['id'] as $payments_id) {
            $sql = 'SELECT amount FROM ' . PREFIX . '_policy_payments WHERE id = ' . intval($payments_id);
            $amount = $db->getOne($sql);

            $sql = 'SELECT getPoliciesIdFor1CPayments(' . $db->quote($policies_number) . ', ' . $amount . ')';
            $new_policies_id = $db->getOne($sql);

            if (intval($data['policies_id']) == intval($new_policies_id)) {
                continue;
            }

            $sql = 'UPDATE ' . PREFIX . '_policy_payments SET policies_id = ' . intval($new_policies_id) . ' WHERE id = ' . intval($payments_id);
            $db->query($sql);

            Policies::setPaymentStatus($new_policies_id);
            Policies::setPaymentStatus($data['policies_id']);
        }

        $params['title']		= $this->messages['single'];
        $params['id']			= $data['id'];
        $params['storage']		= $this->tables[0];

        $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
	
	function changeForPaymentInWindow($data) {
		global $db;

		if ($data['check'] == 1) {
		
			$sql = 'SELECT policies_child.id as child_id, IF(policies_child.sub_number > 0, CONCAT_WS(\'-\', policies_child.number, policies_child.sub_number), policies_child.number) as child_number_full, policies_child.number as child_number, ' .
						'policies_parent.id as parent_id, IF(policies_parent.sub_number > 0, CONCAT_WS(\'-\', policies_parent.number, policies_parent.sub_number), policies_parent.number) as parent_number_full, policies_parent.number as parent_number, ' . 
						'policies.number as number ' .
					'FROM ' . PREFIX . '_policies as policies ' .
					'LEFT JOIN ' . PREFIX . '_policies as policies_parent ON policies.parent_id = policies_parent.id ' .
					'LEFT JOIN ' . PREFIX . '_policies as policies_child ON policies.child_id = policies_child.id ' .
					'WHERE policies.id = ' . $data['policies_id'];
			$policies = $db->getRow($sql);
			
			if (!intval($policies['child_id']) && !intval($policies['parent_id'])) {
				$result['status'] = 'error';
				$result['message'] = 'З цього договору не можна перекинути кошти';
				echo json_encode($result);
				exit;
			}
			
			$sql = 'SELECT date_format(MAX(datetime), \'%Y-%m-%d\') ' .
					'FROM ' . PREFIX . '_policy_payments ' .
					'WHERE amount > 0 AND policies_id = ' . intval($data['policies_id']);
			$max_paymets_date = $db->quote($db->getOne($sql));
			
			$sql = 'SELECT id ' .
					'FROM ' . PREFIX . '_policy_payments ' .
					'WHERE policies_id = ' . intval($data['policies_id']) . ' AND date_format(datetime, \'%Y-%m-%d\') = ' . $max_paymets_date;
			$payments = $db->getCol($sql);
			
			if (!in_array($data['payments_id'], $payments)) {
				$result['status'] = 'error';
				$result['message'] = 'Цю сплату перекинути не можна';
				echo json_encode($result);
				exit;
			}
			
			$sql = 'SELECT SUM(calendar.amount) ' .
					'FROM ' . PREFIX . '_policy_payments_calendar as calendar ' .
					'JOIN ' . PREFIX . '_policies as policies ON calendar.policies_id = policies.id ' .
					'WHERE calendar.date <= policies.interrupt_datetime AND calendar.policies_id = ' . intval($data['policies_id']);
			$calendar_amount = $db->getOne($sql);
			
			$sql = 'SELECT SUM(amount) ' .
					'FROM ' . PREFIX . '_policy_payments ' .
					'WHERE policies_id = ' . intval($data['policies_id']);
			$payments_amount = $db->getOne($sql);
			
			if ((string)$calendar_amount >= (string)$payments_amount && intval($policies['child_id'])) {
				$result['status'] = 'error';
				$result['message'] = 'Кошти не можна перекинути, бо останній період дії договору стане \'частково сплаченим\' чи \'не сплаченим\'';
				echo json_encode($result);
				exit;
			}
			
			$result['status'] = 'ok';
			if (intval($policies['child_id']) && $policies['number'] == $policies['child_number']) {
				$result['transfer_policies_number'] = $policies['child_number_full'];
				$result['transfer_policies_id'] = $policies['child_id'];
			} elseif (intval($policies['parent_id']) && $policies['number'] == $policies['parent_number']) {
				$result['transfer_policies_number'] = $policies['parent_number_full'];
				$result['transfer_policies_id'] = $policies['parent_id'];
			} else {
				$result['status'] = 'error';
				$result['message'] = 'Кошти можна перекидати в межах одного договору';
				echo json_encode($result);
				exit;
			}
			$result['policy_payments_id'] = $data['payments_id'];
			$result['transfer_max_amount'] = $payments_amount - $calendar_amount;
			
			echo json_encode($result);
			exit;
		} else {
			$sql = 'UPDATE ' . PREFIX . '_policy_payments ' .
					'SET amount = amount - ' . $data['transfer_amount'] . ' ' .
					'WHERE id = ' . intval($data['policy_payments_id']);
			$db->query($sql);
			
			$sql = 'INSERT INTO ' . PREFIX . '_policy_payments ' .
					'SELECT NULL, policies_id, clients_id, datetime, amount, doc_number, payment_date, payment_number, created, modified ' .
					'FROM ' . PREFIX . '_policy_payments ' .
					'WHERE id = ' . intval($data['policy_payments_id']);
			$db->query($sql);

			$new_policy_payments_id = mysql_insert_id();
			$sql = 'UPDATE ' . PREFIX . '_policy_payments ' .
					'SET amount = ' . $data['transfer_amount'] . ', ' .
						'policies_id = ' . intval($data['transfer_policies_id']) . ' ' .
					'WHERE id = ' . intval($new_policy_payments_id);
			/*$sql = 'INSERT INTO ' . PREFIX . '_policy_payments ' .
					'SET policies_id = ' . intval($data['transfer_policies_id']) . ', clients_id = ' . intval($row['clients_id']) . ', datetime = ' . $db->quote($row['datetime']) . ', amount = ' . $data['transfer_amount'] . ', ' .
						'doc_number = ' . $db->quote($data['doc_number']) . ', payment_date = ' . $db->quote($row['payment_date'])*/
			$db->query($sql);
			
			Policies::setPaymentStatus($data['policies_id']);
			Policies::setPaymentStatus($data['transfer_policies_id']);
			
			$result['status'] = 'ok';
			$result['message'] = 'Кошти перекинуто';
			echo json_encode($result);
			exit;
		}
	}
}

?>