<?
/*
 * Title: policy drive general class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Certificates.class.php';
require_once 'Policies/Drive.class.php';

class Policies_DriveGeneral extends Policies {
    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'id',
                            'type'              => fldIdentity,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies'),
                        array(
                            'name'              => 'agencies_id',
                            'description'       => 'Агенція',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 16,
                            'table'             => 'policies',
                            'sourceTable'       => 'agencies',
                            'selectField'       => 'title',
                            'orderField'        => 'id'),
                        array(
                            'name'              => 'agents_id',
                            'description'       => 'Агент',
                            'type'              => fldSelect,
							'condition'			=> 'roles_id = 8',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 17,
                            'table'             => 'policies',
                            'sourceTable'       => 'accounts',
                            'selectField'       => 'lastname',
                            'orderField'        => 'id'),
						array(
                            'name'              => 'insurance_companies_id',
                            'description'       => 'Страхова компанiя',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies'),
                        array(
                            'name'              => 'clients_id',
                            'description'       => 'clients_id',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => -1,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'product_types_id',
                            'description'       => 'Тип',
                            'type'              => fldHidden,
                            'structure'         => 'tree',
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'     => 1,
                            'table'             => 'policies',
                            'sourceTable'       => 'product_types',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'lastname',
                            'description'       => 'Прізвище',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'firstname',
                            'description'       => 'Ім\'я',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'patronymicname',
                            'description'       => 'По батькові',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'   => false
                                ),
                            'table'                => 'policies_drive_general'),
                        array(
                            'name'              => 'position',
                            'description'       => 'Посада',
                            'type'              => fldText,
                            'maxlength'         => 150,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'lastname_en',
                            'description'       => 'Прізвище (англійська)',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'firstname_en',
                            'description'       => 'Ім\'я (англійська)',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'patronymicname_en',
                            'description'       => 'По батькові (англ.)',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_drive_general'),
						
                        array(
                            'name'              => 'ground',
                            'description'       => 'Діє на підставі',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'position_en',
                            'description'       => 'Посада (англ.)',
                            'type'              => fldText,
                            'maxlength'         => 100,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'ground_en',
                            'description'       => 'Діє на підставі (англ.)',
                            'type'              => fldText,
                            'maxlength'         => 50,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'deductible',
                            'description'       => 'Франшиза, додатково',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'deductible_en',
                            'description'       => 'Франшиза, додатково (англ.)',
                            'type'              => fldText,
                            'maxlength'         => 50,
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
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'number',
                            'description'       => 'Номер',
                            'type'              => fldText,
                            'maxlenght'         => 14,
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
                            'orderPosition'     => 2,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'sub_number',
                            'description'       => 'Додаткова угода',
                            'type'              => fldText,
                            'maxlenght'         => 14,
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
                            'orderPosition'     => 3,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'date',
                            'description'       => 'Дата полісу',
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
                            'orderPosition'     => 4,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'begin_datetime',
                            'description'       => 'Початок',
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
                            'orderPosition'     => 6,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'end_datetime',
                            'description'       => 'Закінчення',
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
                            'orderPosition'     => 7,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'payment_types_id',
                            'description'       => 'Оплата (сертифікат)',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 8,
                            'table'             => 'policies_drive_general'),
                        array(
                            'name'              => 'policy_statuses_id',
                            'description'       => 'Статус',
                            'type'              => fldSelect,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'             => 'policies',
                            'sourceTable'       => 'policy_statuses',
                            'selectField'       => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'              => 'documents',
                            'description'       => 'Документи',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false,
                                    'change'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies'),
						array(
                            'name'              => 'commission',
                            'description'       => 'Комісія',
                            'type'              => fldBoolean,
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => false,
                                    'view'      => true,
                                    'update'    => false,
                                    'change'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies'),
                        array(
                            'name'              => 'products_id',
                            'description'       => 'Продукт',
                            'type'              => fldSelect,
							'condition'			=> 'product_types_id = 3',
                            'display'           =>
                                array(
                                    'show'      => false,
                                    'insert'    => true,
                                    'view'      => true,
                                    'update'    => true
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'             => 'policies_drive_general',
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
                            'table'             => 'policies'),
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
                            'orderPosition'     => 9,
                            'width'             => 100,
                            'table'             => 'policies'),
                        array(
                            'name'              => 'is_bank',
                            'description'       => 'Банк',
                            'type'              => fldHidden,
                            'display'           =>
                                array(
                                    'show'      => true,
                                    'insert'    => false,
                                    'view'      => false,
                                    'update'    => false
                                ),
                            'verification'      =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'     => 10,
                            'table'             => 'policies')
                     ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 9,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'number')
            );

    function Policies_DriveGeneral($data) {
        Policies::Policies($data);

        $this->objectTitle = 'Policies_DriveGeneral';

        $this->messages['plural'] = 'Генеральні договори добровільного страхування наземних ТЗ';
        $this->messages['single'] = 'Генеральний договір добровільного страхування наземних ТЗ';

	    Certificates::setPolicyStatusesSchema();
	}

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'          => true,
                    'insert'        => true,
                    'update'        => true,
                    'view'          => true,
                    'change'        => true,
                    'export'        => true,
                    'exportActions' => true,
                    'delete'        => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                $this->permissions['insert'] = ($data['top']) ? false : $Authorization->data['permissions'][ get_class($this) ];
                $this->permissions['importCertificates'] = ($data['top']) ? $Authorization->data['permissions'][ get_class($this) ] : false;
				break;
            case ROLES_AGENT:
                $this->permissions = array(
                    'show'			        => true,
                    'insert'		        => ($data['top']) ? false : true,
                    'update'		        => true,
                    'view'			        => true,
                    'change'		        => false,
                    'delete'		        => false,
                    'importCertificates'    => ($data['top']) ? true : false);
                break;
            case ROLES_CLIENT_CONTACT:
                $this->permissions = array(
                    'show'          => true,
                    'insert'        => false,
                    'update'        => false,
                    'view'          => true,
                    'change'        => false,
                    'delete'        => false);
                break;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_CLIENT_CONTACT:
                $conditions[]   = PREFIX . '_policies.clients_id = ' . intval($Authorization->data['clients_id']);
                break;
        }

        parent::show($data, $fields, $conditions, $sql, 'showGeneral.php', $limit);
    }

    function add($data) {
        global $db;

        if ( intval($data['clients_id']) ) {
            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_clients ' .
                    'WHERE id = ' . intval($data['clients_id']);
            $row =  $db->getRow($sql);

            $data = array_merge($data, $row);
        } else if ($data['identification_code'] != '') {

            $sql =  'SELECT *, id AS clients_id ' .
                    'FROM ' . PREFIX . '_clients ' .
                    'WHERE identification_code = ' . $db->quote($data['identification_code']);
            $row =  $db->getRow($sql);

            $data = array_merge($data, $row);
        }

        parent::add($data);
    }

    function setConstants(&$data) {
        $data['insurance_companies_id'] = INSURANCE_COMPANIES_EXPRESS;

        if (!$data['policy_statuses_id']) {
            $data['policy_statuses_id'] = POLICY_STATUSES_CREATED;
        }

        return parent::setConstants($data);
    }

    function setAdditionalFields($id, $data) {
        global $db, $Templates;

        if (intval($data['parent_id'])) {
            $sql =  'SELECT top ' .
                    'FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['parent_id']);
            $data['top'] = $db->getOne($sql);
        } else {
            $data['top'] = $id;
        }

        $sql =  'UPDATE ' . PREFIX . '_policies as a ' .
                'JOIN ' . PREFIX . '_policies_drive_general as b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policies as c ON b.policies_id = c.id ' .
                'JOIN ' . PREFIX . '_clients as d ON c.clients_id = d.id SET ' .
                'a.insurer = d.company, ' .
				'a.interrupt_datetime = a.end_datetime, ' .
                'b.number = IF(b.number, b.number, 1), ' .
                'a.top = ' . intval($data['top']) . ' ' .
                'WHERE a.id = ' . intval($id);
        $db->query($sql);
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization;

        switch ( $Authorization->data['roles_id'] ) {
            case ROLES_AGENT:
                $data['agencies_id'] = $Authorization->data['agencies_id'];
                $data['agents_id']   = $Authorization->data['id'];
                break;
            default:
                $data['agencies_id'] = AGENCIES_EXPRESS_INSURANCE;
                $data['agents_id']   = 3172;
                break;
        }

        $data['id'] = parent::insert(&$data, false, $showForm);

        if (intval($data['id'])) {
            $this->setAdditionalFields($data['id'], $data);

            if ($redirect) {
				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
		}
    }

    function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log;

        $data['id'] = parent::update(&$data, false, $showForm);

        if (intval($data['id'])) {

			$this->setAdditionalFields($data['id'], $data);

            if ($redirect) {
				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['id'] . '&product_types_id=' . $data['product_types_id']);
                exit;
            } else {
                return $data['id'];
            }
        }
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db, $Log;

        $Policies = Policies::factory($data, 'Drive');

        $sql =  'SELECT policies_id as id ' .
                'FROM ' . PREFIX . '_policies_drive ' .
                'WHERE policies_general_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $Policies->messages['plural'] . '</b>.');
            return false;
        }

        return parent::deleteProcess($data, $i, $folder);
    }

    function importCertificates($data) {
        global $db, $Log, $Authorization;

		$this->checkPermissions('importCertificates', $data);

        if ($data['process']) {

            $params = array('Файл', $languageDescription);
            if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
                $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
			} elseif (!ereg('\.xls$', $_FILES['file']['name'])) {
				$Log->add('error', 'Невірний формат файлу, підтримується формат xls.', $params);
			}

            $sql =  'SELECT a.* ' .
                    'FROM ' . PREFIX . '_clients AS a '.
                    'JOIN ' . PREFIX . '_policies AS b ON a.id = b.clients_id ' .
                    'WHERE b.id = ' . intval($data['policies_general_id']);
            $client = $db->getRow($sql);

            //получаем id доп. соглашения
            $sql =  'SELECT id ' .
                    'FROM ' . PREFIX . '_policies ' .
                    'WHERE TO_DAYS(date) = TO_DAYS(' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']) . ') AND sub_number <> 0 AND top = ' . intval($data['policies_general_id']);
            $policies_general_id = $db->getOne($sql);
//_dump($sql);
//_dump($policies_general_id);exit;
            //если полиса нет, копируем взяв за основу последний доп.
            if (!intval($policies_general_id)) {

                //проверяем, чтобы доп. не был с датой раньше чем последний уже созданный доп.
                $sql =  'SELECT TO_DAYS(MAX(date)) - TO_DAYS(' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']) . ') AS days ' .
                        'FROM ' . PREFIX . '_policies ' .
                        'WHERE top = ' . intval($data['policies_general_id']);
                $days = $db->getOne($sql);

                if ($days > 0) {
                    $Log->add('error', 'Дата додаткової угоди меньша за дату останьої.');

                    unset($_SESSION['certificates']['drive']);
                    $Log->showSystem();

                    include_once $this->object . '/importCertificates.php';
                    return;
                }

                //копируем полис
                $sql = 'SELECT * FROM ' . PREFIX . '_policies WHERE top = ' . $data['policies_general_id'] . ' AND child_id = 0';
                $policy = $db->getRow($sql);

                foreach ($policy as $field => $value) {
                    switch ($field) {
                        case 'id':
                            break;
                        case 'agencies_id':
                            $row[] = $field . '=' . intval($Authorization->data['agencies_id']);
                            break;
                        case 'agents_id':
                            $row[] = $field . '=' . intval($Authorization->data['id']);
                            break;
                        case 'sub_number':
                            $row[] = $field . '=' . (intval($value) + 1);
                            break;
                        case 'date':
                            $row[] = $field . '=' . $db->quote($data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day']);
                            break;
                        case 'created':
                        case 'modified':
                            $row[] = $field . '=NOW()';
                            break;
                        default:
                            $row[] = $field . '=' . $db->quote($value);
                            break;
                    }
                }

                $sql =  'INSERT INTO ' . PREFIX . '_policies SET ' . implode(', ', $row);
                $db->query($sql);

                unset($row);

                $policies_general_id = mysql_insert_id();

                $sql = 'UPDATE ' . PREFIX . '_policies SET child_id = ' . intval($policies_general_id) . ' WHERE id = ' . intval($policy['id']);
                $db->query($sql);

                $sql = 'SELECT * FROM ' . PREFIX . '_policies_drive_general WHERE policies_id = ' . intval($policy['id']);
                $policy = $db->getRow($sql);

                foreach ($policy as $field => $value) {
                    switch ($field) {
                        case 'policies_id':
                            $row[] = $field . '=' . $policies_general_id;
                            break;
                        default:
                            $row[] = $field . '=' . $db->quote($value);
                            break;
                    }
                }

                $sql =  'INSERT INTO ' . PREFIX . '_policies_drive_general SET ' . implode(', ', $row);
                $db->query($sql);
            }

            if (!$Log->isPresent()) {

				require_once 'Excel/reader.php';

				$Excel = new Spreadsheet_Excel_Reader();
				$Excel->setOutputEncoding(CHARSET);
				$Excel->read($_FILES['file']['tmp_name']);

                for ($i = 1; $i < 18; $i++) {
                    switch ( $Excel->sheets[0]['cells'][ 1 ][ $i ] ) {
						case '№ п/п':
						case 'Тип, марка, модель транспортного засобу':
						case 'Рік випуску':
						case 'Реєстраційний номер':
						case 'Номер кузова':
						case 'Робочий об\'єм двигуна':
						case 'Дійсна вартість (грн)':
						case 'Cтрок дії договору':
						case 'дата початку':
						case 'дата закінчення':
						case 'Кількість днів':
						case 'Страхова сума (грн)':
						case 'Дійсна вартість на момент страхування':
						case 'Страх. тариф %':
						case 'Загальна сума страх. платежу (грн)':
						case 'Сума страх. платежу за період (грн)':
                            $cols[ $Excel->sheets[0]['cells'][ 1 ][ $i ] ] = $i;
                            break;
						case '':
							break;
                        default:
                            $Log->add('error', 'Перелік колонок не відповідає встановленому формату, "'  . $i . '!!!' . $cols[ $Excel->sheets[0]['cells'][ 1 ][ $i ] ] . '"');
                            break;
                    }
				}

				$cars = array();
				for ($i=2; $i<=$Excel->sheets[0]['numRows']; $i++) {
					$pos = strpos( $Excel->sheets[0]['cells'][ $i ][ $cols['Тип, марка, модель транспортного засобу'] ], ' ');

					$brand = trim(substr($Excel->sheets[0]['cells'][ $i ][ $cols['Тип, марка, модель транспортного засобу'] ], 0, $pos));
					$model = trim(substr($Excel->sheets[0]['cells'][ $i ][ $cols['Тип, марка, модель транспортного засобу'] ], $pos));

					$cars[$i] = array('brand' => $brand, 'model' => $model);

					$sql =	'SELECT a.id AS brands_id, b.id AS models_id, c.car_types_id ' .
							'FROM ' . PREFIX . '_car_brands AS a ' .
							'JOIN ' . PREFIX . '_car_models AS b ON a.id = b.car_brands_id ' .
							'JOIN ' . PREFIX . '_car_type_car_model_assignments AS c ON b.id = c.car_models_id ' .
							'JOIN ' . PREFIX . '_car_types AS d ON c.car_types_id = d.id ' .
							'WHERE a.title = ' . $db->quote($brand) . ' AND b.title = ' . $db->quote($model) . ' AND d.product_types_id = ' . PRODUCT_TYPES_KASKO . ' ' .
							'LIMIT 1';
					$car = $db->getRow($sql);

					if (!is_array($car)) {
						$Log->add('error', 'Не знайдена марка та модель авто ' . $brand . '/' . $model . ' в рядку ' . $i , $params);
                    }
                }

                if ($Log->isPresent()) {

				    unset($_SESSION['certificates']['drive']);
					$Log->showSystem();

					include_once $this->object . '/importCertificates.php';
					return;
				}

				$inserted   = 0;
				$updated    = 0;
				$error      = 0;
				$total      = 0;

				$result = '
						<tr>
						    <td><b>№ п/п</b></td>
						    <td><b>Тип, марка, модель транспортного засобу</b></td>
						    <td><b>Рік випуску</b></td>
						    <td><b>Реєстраційний номер</b></td>
						    <td><b>Номер кузова</b></td>
						    <td><b>Робочий об\'єм двигуна</b></td>
						    <td><b>Дійсна вартість (грн)</b></td>
						    <td><b>Cтрок дії договору</b></td>
						    <td><b>дата початку</b></td>
						    <td><b>дата закінчення</b></td>
						    <td><b>Кількість днів</b></td>
						    <td><b>Страхова сума (грн)</b></td>
							<td><b>Дійсна вартість на момент страхування</b></td>
						    <td><b>Страх. тариф %</b></td>
						    <td><b>Загальна сума страх. платежу (грн)</b></td>
						    <td><b>Сума страх. платежу за період (грн)</b></td>
						    <td><b>Статус</b></td>
						    <td><b>Помилка</b></td>
                        </tr>';

                $Policies_Drive = Policies::factory($data, ProductTypes::get(PRODUCT_TYPES_DRIVE_CERTIFICATE));
                $Policies_Drive->certificate = false;

				$Policies_Drive->formDescription['fields'][ $Policies_Drive->getFieldPositionByName('card_assistance') ]['verification']['canBeEmpty'] = true;

                $unsetFields=array('fop','give_a_statement','civil_servant','not_civil_servant','public_figure');
                foreach($unsetFields as $field) {
                    $data[ $field ] = '';
                    unset($Policies_Drive->formDescription['fields'][ $Policies_Drive->getFieldPositionByName($field) ]);
                }

				for ($i=2; $i<=$Excel->sheets[0]['numRows']; $i++) {
				 	unset($data);

				 	$data['types_id']					= 2;
				 	$data['product_types_id']			= 11;
                    $data['agreement_types_id']         = 0;
				 	$data['clients_id']					= $client['id'];
				 	$data['financial_institutions_id']	= 0;
				 	$data['drivers_id']					= 7;
				 	$data['registration_cities_id']		= 1;
				 	$data['residences_id']				= 2;
				 	$data['priority_payments_id']		= 1;
				 	$data['options_deterioration_no']	= 1;
				 	$data['options_taxy']				= 0;
				 	$data['options_agregate_no']		= 1;
				 	$data['options_guilty_no']			= 0;
				 	$data['options_test_drive']			= 0;
				 	$data['options_race']				= 0;
				 	$data['payment_brakedown_id']		= 1;
				 	$data['allowed_products_id']		= '';
					$data['insurance_companies_id']     = INSURANCE_COMPANIES_EXPRESS;

				 	$data['owner_person_types_id']		= 2;
				 	$data['owner_company']				= $client['company'];
				 	$data['owner_bank']					= stripslashes($client['bank']);
				 	$data['owner_bank_account']			= $client['bank_account'];
				 	$data['owner_bank_mfo']				= $client['bank_mfo'];
				 	$data['owner_edrpou']				= $client['identification_code'];
				 	$data['owner_lastname']				= $client['lastname'];
				 	$data['owner_firstname']			= $client['firstname'];
				 	$data['owner_patronymicname']		= $client['patronymicname'];
				 	$data['owner_position']				= $client['position'];
				 	$data['owner_ground']				= $client['ground'];
				 	$data['owner_dateofbirth']			= $client['dateofbirth'];
				 	$data['owner_identification_code']	= $client['identification_code'];
				 	$data['owner_regions_id']			= $client['registration_regions_id'];
				 	$data['owner_area']					= $client['registration_area'];
				 	$data['owner_city']					= $client['registration_city'];
				 	$data['owner_street_types_id']		= $client['registration_street_types_id'];
				 	$data['owner_street']				= $client['registration_street'];
				 	$data['owner_house']				= $client['registration_house'];
				 	$data['owner_flat']					= $client['registration_flat'];
				 	$data['owner_phone']				= $client['habitation_phone'];

				 	$data['insurer_person_types_id']	= 2;
				 	$data['insurer_company']			= $client['company'];
				 	$data['insurer_bank']				= stripslashes($client['bank']);
				 	$data['insurer_bank_account']		= $client['bank_account'];
				 	$data['insurer_bank_mfo']			= $client['bank_mfo'];
				 	$data['insurer_edrpou']				= $client['identification_code'];
				 	$data['insurer_lastname']			= $client['lastname'];
				 	$data['insurer_firstname']			= $client['firstname'];
				 	$data['insurer_patronymicname']		= $client['patronymicname'];
				 	$data['insurer_position']			= $client['position'];
				 	$data['insurer_ground']				= $client['ground'];
				 	$data['insurer_dateofbirth']		= $client['dateofbirth'];
				 	$data['insurer_identification_code']= $client['identification_code'];
				 	$data['insurer_regions_id']			= $client['registration_regions_id'];
				 	$data['insurer_area']				= $client['registration_area'];
				 	$data['insurer_city']				= $client['registration_city'];
				 	$data['insurer_street_types_id']	= $client['registration_street_types_id'];
				 	$data['insurer_street']				= $client['registration_street'];
				 	$data['insurer_house']				= $client['registration_house'];
				 	$data['insurer_flat']				= $client['registration_flat'];
				 	$data['insurer_phone']				= $client['habitation_phone'];
				 	$data['assured_phone']				= $client['habitation_phone'];

				    $data['sign_agents_id']				= 0;
				    $data['zones_id']					= 1;
				    $data['terms_id']					= 53;
                    $data['policies_general_id']        = $policies_general_id;

                    $data['risks'] = array(RISKS_DTP, RISKS_PDTO, RISKS_ACTOFGOD, RISKS_DOWNFALL, RISKS_ANIMAL, RISKS_FIRE1, RISKS_HIJACKING1);

                    $data['date']		                = $_POST['date'];
                    $data['date_day']	                = $_POST['date_day'];
                    $data['date_month']	                = $_POST['date_month'];
                    $data['date_year']	                = $_POST['date_year'];

                    $d = $this->convertDate($Excel->sheets[0]['cells'][ $i ][$cols['дата початку']]);

                    $data['begin_datetime']		        = $d;
                    $data['begin_datetime_day']	        = substr($d, 0, 2);
                    $data['begin_datetime_month']	    = substr($d, 3, 2);
                    $data['begin_datetime_year']	    = substr($d, 6, 4);

                    $d = $this->convertDate($Excel->sheets[0]['cells'][ $i ][$cols['дата закінчення']]);

                    $data['end_datetime']		        = $d;
                    $data['end_datetime_day']	        = substr($d, 0, 2);
                    $data['end_datetime_month']	        = substr($d, 3, 2);
                    $data['end_datetime_year']	        = substr($d, 6, 4);

                    $data['assured'] = 1;

                    $data['assured_title']                  = $client['company'];
                    $data['assured_identification_code']    = $client['identification_code'];
                    $fields = array('insurer_address');
                    $values = $Policies_Drive->prepareValues($fields, $data);

                    $data['assured_address']        = $values['insurer_address'];
                    $data['solutions_id']           = 0;
                    $data['policy_statuses_id']     = POLICY_STATUSES_GENERATED;
                    $data['checkPermissions']       = 1;
                    $data['terms_years_id']         = 1;

				   	$item = array();

				   	$s =	'SELECT a.id AS brands_id, b.id AS models_id, c.car_types_id ' .
							'FROM ' . PREFIX . '_car_brands AS a ' .
							'JOIN ' . PREFIX . '_car_models AS b ON a.id = b.car_brands_id ' .
							'JOIN ' . PREFIX . '_car_type_car_model_assignments AS c ON b.id = c.car_models_id ' .
							'JOIN ' . PREFIX . '_car_types AS d ON c.car_types_id = d.id ' .
							'WHERE a.title = ' . $db->quote($cars[$i]['brand']) . ' AND b.title = ' . $db->quote($cars[$i]['model']) . ' AND d.product_types_id = ' . PRODUCT_TYPES_KASKO . ' ' .
							'LIMIT 1';
					$car = $db->getRow($s);

				   	$item['car_types_id']			= $car['car_types_id'];
				   	$item['brands_id']				= $car['brands_id'];
				   	$item['models_id']				= $car['models_id'];
				   	$item['car_price']				= round($Excel->sheets[0]['cells'][ $i ][$cols['Страхова сума (грн)']], 2);
					$item['market_price']			= round($Excel->sheets[0]['cells'][ $i ][$cols['Дійсна вартість на момент страхування']], 2);
				   	$item['engine_size']			= intval($Excel->sheets[0]['cells'][ $i ][$cols['Робочий об\'єм двигуна']]);
				   	$item['transmissions_id']		= 1;
				   	$item['year']					= $Excel->sheets[0]['cells'][ $i ][$cols['Рік випуску']];
				   	$item['race']					= '0';
				   	$item['colors_id']				= 18;
				   	$item['number_places']			= 5;
				   	$item['sign']					= $Excel->sheets[0]['cells'][ $i ][$cols['Реєстраційний номер']];
				   	$item['shassi']					= $Excel->sheets[0]['cells'][ $i ][$cols['Номер кузова']];

                    $item['order_basis_car_id']     = 1;
                    $item['use_as_car_private']	    = 1;
                    $item['use_as_car_work']    	= 2;

				   	$item['deductibles_value0']		= 0;
				   	$item['deductibles_value1']		= 0;

				   	$item['deductibles_absolute0']	= 0;
				   	$item['deductibles_absolute1']	= 0;

					$deductibles_value0 = 0;
					$deductibles_value1 = 0;

					if ($deductibles_value0>100) $item['deductibles_absolute0'] = 1;
					if ($deductibles_value1>100) $item['deductibles_absolute1'] = 1;

					$item['deductibles_value0']	= $deductibles_value0;
				   	$item['deductibles_value1']	= $deductibles_value1;

                    $item['days'] = (mktime(0, 0, 0, $data['end_datetime_month'], $data['end_datetime_day'], $data['end_datetime_year']) - mktime(0, 0, 0, $data['begin_datetime_month'], $data['begin_datetime_day'], $data['begin_datetime_year'])) / 24 /60 / 60 + 1;

                    $conditions = array(
                        'products_id = ' . intval($policy['products_id']),
                        'car_types_id = ' . intval($item['car_types_id']),
                        'value0 = ' . $db->quote($item['deductibles_value0']),
                        'absolute0 = ' . $db->quote($item['deductibles_absolute0']),
                        'value1 = ' . $db->quote($item['deductibles_value1']),
                        'absolute1 = ' . $db->quote($item['deductibles_absolute1']));

                    $sql =  'SELECT id ' .
                            'FROM ' . PREFIX . '_product_deductibles ' .
                            'WHERE ' . implode(' AND ', $conditions);
                    $item['deductibles_id'] = $db->getOne($sql);

                    $item['amount_kasko']	= round($Excel->sheets[0]['cells'][ $i ][$cols['Сума страх. платежу за період (грн)']], 2);
                    $item['amount']			= $item['amount_kasko'];

				   	$item['rate_kasko']		= round($item['amount_kasko'] / $item['car_price'] * 100, 3);
                    $item['rate']		    = $item['rate_kasko'];

                    //определяем вставляем или изменяем!!!
				 	$policies_id = $Policies_Drive->getPolicyByShassiSign($data['policies_general_id'],  $Excel->sheets[0]['cells'][ $i ][$cols['Реєстраційний номер']], $Excel->sheets[0]['cells'][ $i ][$cols['Номер кузова']]);

                    //получаем id машины
					if (intval($policies_id)) {

                        $sql = 'SELECT id ' .
                               'FROM ' . PREFIX . '_policies_kasko_items ' .
                               'WHERE policies_id = ' . intval($policies_id) . ' ' .
                               'ORDER  BY id DESC';
						$item['id'] = intval($db->getOne($sql));
					}

				   	$data['items'][] = $item;

					$status = array();

				  	if ($policies_id) {
						$data['id'] = $policies_id;
					    $status['title'] = 'Редаговано';
                        ($Policies_Drive->update($data, false, false)) ? $updated++ : $error++;
				  	} else {
					    $status['title'] = 'Створено';
						($Policies_Drive->insert($data, false, false)) ? $inserted++ : $error++;
                    }

                    $result .= '<table>
						<tr>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['№ п/п']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Тип, марка, модель транспортного засобу']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Рік випуску']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Реєстраційний номер']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Номер кузова']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Робочий об\'єм двигуна']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Дійсна вартість (грн)']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Cтрок дії договору']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['дата початку']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['дата закінчення']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Кількість днів']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Страхова сума (грн)']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Страх. тариф %']] . '</td>
                            <td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Загальна сума страх. платежу (грн)']] . '</td>
							<td>' . $Excel->sheets[0]['cells'][ $i ][$cols['Сума страх. платежу за період (грн)']] . '</td>';

					$messages = $Log->get();
					if (is_array($messages)) {
						foreach ($messages as $message) {
							$status[ $message['type'] ][] = $message['text'];
						}

						$status['title']    = (is_array($status['error'])) ? 'Помилка' : $status['title'];
						$status['details']  = (is_array($status['error'])) ? implode(', ', $status[ 'error' ]) : implode(', ', $status[ 'confirm' ]);
					}

					$result.= '<td>'. $status['title'] . '</td><td>' . strip_tags($status['details']).'</td></tr></table>';
					$total++;
				}

                //формируем счет на оплату
                $sql =  'SELECT id ' .
                        'FROM ' . PREFIX . '_policy_payments_calendar ' .
                        'WHERE policies_id = ' . intval($policies_general_id);

                $policy_payments_calendar['id'] = $db->getOne($sql);
                $policy_payments_calendar['policies_id'] = $policies_general_id;

                $policy_payments_calendar['date_year']  = $_POST['date_year'];
                $policy_payments_calendar['date_month'] = $_POST['date_month'];
                $policy_payments_calendar['date_day']   = $_POST['date_day'];

                $PolicyPaymentsCalendar = new PolicyPaymentsCalendar($data);

                $PolicyPaymentsCalendar->permissions['insert'] = true;
                $PolicyPaymentsCalendar->permissions['update'] = true;

                (intval($policy_payments_calendar['id'])) ? $PolicyPaymentsCalendar->update($policy_payments_calendar, false) : $PolicyPaymentsCalendar->insert($policy_payments_calendar, false);

				$result='<table border="1">'.$result.'</table>';
				@unlink($_SERVER['DOCUMENT_ROOT'] . '/temp/log.xls');
				file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/temp/log.xls', '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv=Content-Type content="text/html; charset=utf-8"><meta name=ProgId content=Excel.Sheet>' . $result . '</body></html>');

				$Log->add('confirm', '<b>Файл був оброблений.</b><br /><br /><table><tr><td>Створено:</td><td align="right">' . $inserted . '</td></tr><tr><td>Редаговано:</td><td align="right">' . $updated . '</td></tr><tr style="color: #ffffff; font-weight: bold;"><td>Помилки:</td><td align="right">' . $error . '</td></tr><tr style="font-weight: bold;"><td>Всього:</td><td align="right">' . $total . '</td></tr></table><br /><a href="/temp/log.xls">Скачати файл змін</a>' , $params);

				header('Location: ' . $_SERVER['PHP_SELF'] . '?do=' . $this->object . '|view&id=' . $data['policies_general_id'] . '&product_types_id=' . PRODUCT_TYPES_DRIVE_GENERAL);
				exit;
            }
        }

        unset($_SESSION['certificates']['drive']);

        $Log->showSystem();

        include_once $this->object . '/importCertificates.php';
    }

	/* Export 1C7.7. */
    function getXML($data) {
        global $db, $Smarty;

		$conditions[] = 'a.sub_number>0';
		$conditions[] = 'a.product_types_id=10';
        if ($data['number']) {
            $conditions[] = 'CONCAT(a.number,\'_\',a.sub_number)=' . $db->quote(trim($data['number']));
        } else {
            //$conditions[] = 'a.payment_number <> \'\'';
            //$conditions[] = ($data['from']) ? 'TO_DAYS(a.payment_datetime )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.payment_datetime )>=TO_DAYS(NOW())';
            //$conditions[] = ($data['to']) ? 'TO_DAYS(a.payment_datetime )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.payment_datetime ) <= TO_DAYS(NOW())';
            $conditions[] = ($data['from']) ? 'TO_DAYS(a.modified )>=TO_DAYS(' . $data['from'] . ')' : 'TO_DAYS(a.modified )>=TO_DAYS(NOW())';
            $conditions[] = ($data['to']) ? 'TO_DAYS(a.modified )<=TO_DAYS(' . $data['to'] . ')' : 'TO_DAYS(a.modified ) <= TO_DAYS(NOW())';
			$conditions[] = '(a.policy_statuses_id = ' . POLICY_STATUSES_GENERATED . ' )';
			$conditions[] = 'a.number not like \'203.10.000010-%\'';
			$conditions[] = 'a.number not like \'203.10.000011-%\'';
        }

        $sql =  'SELECT a.id as policies_id,a.date,' .
                'a.begin_datetime, ' .
                'a.end_datetime ,  ' .
                'a.begin_datetime AS billDate, ' .
                'a.modified AS modifiedDate, ' .
                'a.created, ' .
                'a.begin_datetime AS payment_datetime, ' .
                'a.policy_statuses_id, \'\' AS payment_number, CONCAT(a.number,\'_\',a.sub_number) as number, '.
                'a.item, pitems.price as price, a.rate, pitems.amount as amount,  '.
				'w.person_types_id AS person_types_id,  '.
                ' w.company, w.identification_code AS edrpou,  ' .
				'w.company as assured_title ,w.identification_code as assured_identification_code,pitems.objcount,pitems.maxprice '.
                'FROM ' . PREFIX . '_policies AS a ' .
				'JOIN (SELECT sum(p.amount) as amount,sum(p.price) as price, count( * ) AS objcount,max( price ) AS maxprice,policies_general_id FROM insurance_policies_drive pd JOIN insurance_policies p on p.id=pd.policies_id GROUP BY policies_general_id)  as pitems ON pitems.policies_general_id=a.id '.
                'JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id=c.id ' .
				'JOIN ' . PREFIX . '_clients  AS w ON w.id=a.clients_id   ' .				
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

		

        foreach ($list as $i=>$row) {
            $sql =  'SELECT date AS payment_date, amount AS payment_amount ' .
                    'FROM ' . PREFIX . '_policy_payments_calendar ' .
                    'WHERE policies_id = ' . intval($row['policies_id']);
            $list[ $i ]['paymentsCalendar'] = $db->getAll($sql);

        }

        $Smarty->assign('list', $list);
        return $Smarty->fetch($this->object . '/drive_general.xml');
    }
}
?>