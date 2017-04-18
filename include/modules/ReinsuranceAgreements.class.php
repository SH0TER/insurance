<?
/*
 * Title: reinsurance agreements class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'ReinsuranceBorderoPremiums.class.php';
require_once 'ReinsuranceAgreementRisks.class.php';
require_once 'ReinsuranceAgreementCarYears.class.php';
require_once 'ReinsuranceAgreementDeductibles.class.php';

class ReinsuranceAgreements extends Form {

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
							'table'				=> 'reinsurance_agreements'),
						array(
                            'name'              => 'companies_id',
                            'description'       => 'Компанія',
                            'type'              => fldSelect,
							'condition'			=> 'id <> 4',//накладываем ограничение, догоовор перестрахования не от компании Экспресс Страхование, константа INSURANCE_COMPANIES_EXPRESS
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
							'orderPosition'		=> 1,
                            'table'             => 'reinsurance_agreements',
                            'sourceTable'       => 'companies',
                            'selectField'       => 'title',
                            'orderField'        => 'title'),
						array(
							'name'				=> 'number',
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
							'orderPosition'		=> 2,
							'table'				=> 'reinsurance_agreements'),
						array(
                            'name'              => 'date',
                            'description'       => 'Дата договору',
                            'type'              => fldDate,
                            'input'             => true,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 3,
                            'table'             => 'reinsurance_agreements'),
						array(
                            'name'              => 'share',
                            'description'       => 'Частка, %',
                            'type'              => fldPercent,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 4,
                            'table'             => 'reinsurance_agreements'),
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
                            'orderPosition'     => 5,
							'table'				=> 'reinsurance_agreements'),
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
							'width'				=> 120,
							'table'				=> 'reinsurance_agreements')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'number'
					)
			);

	function ReinsuranceAgreements($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Договори перестрахування';
		$this->messages['single'] = 'Договор перестрахування';
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

	function showForm($data, $action, $actionType=null, $template=null) {
		global $db;

		$data['car_types']	= $db->getAssoc('SELECT id, title FROM ' . PREFIX . '_car_types WHERE product_types_id = ' . PRODUCT_TYPES_KASKO);
		$data['car_brands']	= $db->getAssoc('SELECT id, title FROM ' . PREFIX . '_car_brands ORDER BY title');

		$data['agreements_id'] = $data['id'];

        return parent::showForm($data, $action, $actionType, 'form.php');
    }

	 function insert($data, $redirect=true) {
        global $Log;

        $data['agreements_id'] = parent::insert($data, false);

        if (intval($data['agreements_id'])) {

            $params['title']	= $this->messages['single'];
            $params['id']       = $data['agreements_id'];
            $params['storage']	= $this->tables[0];

			ReinsuranceAgreementRisks::setValues($data);
			ReinsuranceAgreementCarYears::setValues($data);
			ReinsuranceAgreementDeductibles::setValues($data);

            if ($redirect) {
                $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $data['redirect']);
				exit;
            } else {
                return $params['id'];
            }
        }
    }

    function update($data, $redirect=true) {
        global $Log;

        $data['agreements_id'] = parent::update($data, false);

        if (intval($data['agreements_id'])) {

            $params['title']	= $this->messages['single'];
            $params['id']       = $data['agreements_id'];
            $params['storage']	= $this->tables[0];

			ReinsuranceAgreementRisks::setValues($data);
			ReinsuranceAgreementCarYears::setValues($data);
			ReinsuranceAgreementDeductibles::setValues($data);

            if ($redirect) {
                $Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $params['id'];
            }
        }
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log;

        $ReinsuranceBorderoPremiums = new ReinsuranceBorderoPremiums($data);

        $sql =  'SELECT id ' .
                'FROM ' . $ReinsuranceBorderoPremiums->tables[0] . ' ' .
                'WHERE agreements_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $ReinsuranceBorderoPremiums->messages['plural'] . '</b>.');
            return false;
        }

		return parent::deleteProcess($data, $i, $folder);
	}

	function get($id) {
		global $db;

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_reinsurance_agreements ' .
				'WHERE id = ' . intval($id);
		return $db->getRow($sql, 30 * 60);
	}

	function getShare($id) {
		global $db;

		$sql =	'SELECT share ' .
				'FROM ' . PREFIX . '_reinsurance_agreements ' .
				'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}

	function getRisks($id) {
		global $db;

		$sql =	'SELECT risks_id, value ' .
				'FROM ' . PREFIX . '_reinsurance_agreement_risks ' .
				'WHERE agreements_id = ' . intval($id);
		return $db->getAll($sql, 30 * 60);
	}
}

?>