<?
/*
 * Title: paymnets class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */
require_once 'PaymentsCalendar.class.php';

class Payments extends Form {

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
							'table'				=> 'payments'),
							
						array(
							'name'				=> 'payments_id',
							'description'		=> 'Платiж',
   					        'type'				=> fldHidden,
							'display'			=> 
								array(
									'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'payments'),			
						array(
							'name'				=> 'date',
							'description'		=> 'Дата оплаты',
					        'type'				=> fldDate,
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
							'table'				=> 'payments'),
						array(
							'name'				=> 'number',
							'description'		=> 'Номер платеж. поруч.',
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
							'orderPosition'		=> 2,
							'table'				=> 'payments'),
						array(
							'name'				=> 'amount',
							'description'		=> 'Сума платежу',
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
							'table'				=> 'payments'),
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
							'orderPosition'		=> 9,	
							'table'				=> 'payments'),
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
							'orderPosition'		=> 10,
                            'width'             => 100,
							'table'				=> 'payments')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'number'
					)
			);

	function Payments($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Проплаченi кошти';
		$this->messages['single'] = 'Проплаченi кошти';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'    => true,
					'view'		=> true,
					'change'	=> false,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = array(
					'show'		=> ($Authorization->data['payments']) ? true : false,
					'insert'		=> ($Authorization->data['payments']) ? true : false,
					'update'		=> ($Authorization->data['payments']) ? true : false,
					'view'		=> ($Authorization->data['payments']) ? true : false,
					'change'	=> ($Authorization->data['payments']) ? true : false,
					'delete'	=> ($Authorization->data['payments']) ? true : false);
				break;
		}
	}
	
	function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;

	
		$data['id'] = parent::insert(&$data, false, $showForm);

        if (intval($data['id'])) {
			
			PaymentsCalendar::setPaymentStatus($data['payments_id']);
			
            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=PaymentsCalendar|view&id=' . $data['payments_id'] );
                exit;
            } else {
                return $data['id'];
            }
		}
    }
	
	function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $db;

		$data['payments_id']=$db->getOne('SELECT payments_id FROM '.PREFIX.'_payments WHERE id='.intval($data['id']));

		if (parent::update(&$data, false, $showForm) && $data['payments_id']) {
			PaymentsCalendar::setPaymentStatus($data['payments_id']);

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=PaymentsCalendar|view&id=' . $data['payments_id'] );
                exit;
            } else {
                return $data['id'];
            }
		}
    }

	function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log, $Authorization;

		$sql =	'SELECT payments_id ' .
				'FROM ' . PREFIX . '_payments ' .
				'WHERE id  IN(' . implode(', ', $data['id']) . ')';
		$payments_id = intval($db->getOne($sql));

		$res = parent::deleteProcess($data, $i, $folder);

		if ($res) {
			PaymentsCalendar::setPaymentStatus($payments_id);
		}

		return $res;
    }

	function getAmount($policies_id) {
		global $db;

		$sql =	'SELECT SUM(amount) ' .
				'FROM ' . PREFIX . '_policy_payments ' .
				'WHERE policies_id = ' . intval($policies_id);
		return $db->getOne($sql);
	}
}

?>