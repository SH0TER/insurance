<?
/*
 * Title: financial institution class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'FinancialInstitutionCommissions.class.php';

class FinancialInstitutions extends Form {

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
							'table'				=> 'financial_institutions'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 150,
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
							'table'				=> 'financial_institutions'),
						array(
							'name'				=> 'edrpou',
							'description'		=> 'Код ЄДРПОУ',
					        'type'				=> fldText,
					        'maxlength'			=> 8,
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
							'table'				=> 'financial_institutions'),
						array(
							'name'				=> 'mfo',
							'description'		=> 'МФО',
					        'type'				=> fldText,
					        'maxlength'			=> 6,
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
							'orderPosition'		=> 3,
							'table'				=> 'financial_institutions'),
						array(
							'name'				=> 'address',
							'description'		=> 'Адреса',
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
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 4,
							'table'				=> 'financial_institutions'),
						array(
							'name'				=> 'phone',
							'description'		=> 'Телефон',
					        'type'				=> fldText,
					        'maxlength'			=> 15,
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
							'orderPosition'		=> 5,
							'table'				=> 'financial_institutions'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'financial_institutions'),
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
							'orderPosition'		=> 6,
                            'width'             => 100,
							'table'				=> 'financial_institutions')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function FinancialInstitutions($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Банки';
		$this->messages['single'] = 'Банк';
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

	function view($data) {
		if (intval($data['financial_institutions_id'])) {
			$data['id'] = $data['financial_institutions_id'];
		}

		$row = parent::view($data);

		$data['financial_institutions_id'] = $row['id'];

		$fields		= array('financial_institutions_id');
		$conditions	= array('financial_institutions_id = ' . intval($data['financial_institutions_id']));

		$FinancialInstitutionCommissions = new FinancialInstitutionCommissions($data);
		$FinancialInstitutionCommissions->show($data, $fields, $conditions);
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db, $Log;

		$sql =	'DELETE FROM ' . PREFIX . '_financial_institution_commissions ' .
				'WHERE financial_institutions_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		$sql =	'DELETE FROM ' . PREFIX . '_financial_institution_product_document_assignments ' .
				'WHERE financial_institutions_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		$sql =	'DELETE FROM ' . PREFIX . '_product_financial_institution_assignments ' .
				'WHERE financial_institutions_id IN(' . implode(', ', $data['id']) . ')';
		$db->query($sql);

		return parent::deleteProcess($data, $i, $folder);
	}
	
	function getFinancialInstitutionsInWindow($data) {
        global $db;

        $sql = 'SELECT id, title ' .
               'FROM ' . PREFIX . '_financial_institutions ' .
               'ORDER BY title';

        $list = $db->getAll($sql);
        $result = 'var institutions_information = new Array();';
        $i = 0;
        foreach ($list as $row) {
            $result .= 'institutions_information[' . $i . '] = {id:' . $row['id'] . ', name:' . $db->quote(htmlspecialchars_decode($row['title'], ENT_QUOTES)) . '};';
            $i++;
        }
        echo $result;
    }
}

?>