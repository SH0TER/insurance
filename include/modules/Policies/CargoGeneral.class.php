<?
/*
 * Title: policy cargo general class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Certificates.class.php';
require_once 'DeliveryWays.class.php';

class Policies_CargoGeneral extends Policies {
    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'                => 'id',
                            'type'                => fldIdentity,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies'),
                        array(
                            'name'                => 'agencies_id',
                            'description'        => 'Агенція',
                            'type'                => fldSelect,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 16,
                            'table'                => 'policies',
                            'sourceTable'        => 'agencies',
                            'selectField'        => 'title',
                            'orderField'        => 'id'),
                        array(
                            'name'                => 'agents_id',
                            'description'        => 'Агент',
                            'type'                => fldSelect,
							'condition'			=> 'roles_id = 8',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 17,
                            'table'                => 'policies',
                            'sourceTable'        => 'accounts',
                            'selectField'        => 'lastname',
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
                            'orderPosition'        => 1,
                            'table'                => 'policies',
                            'sourceTable'        => 'product_types',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'lastname',
                            'description'        => 'Прізвище',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'firstname',
                            'description'        => 'Ім\'я',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'patronymicname',
                            'description'        => 'По батькові',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'position',
                            'description'        => 'Посада',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'ground',
                            'description'        => 'Діє на підставі',
                            'type'                => fldText,
                            'maxlength'            => 250,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'lastname_en',
                            'description'        => 'Прізвище (англійська)',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'firstname_en',
                            'description'        => 'Ім\'я (англійська)',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'patronymicname_en',
                            'description'        => 'По батькові (англійська)',
                            'type'                => fldText,
                            'maxlength'            => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'position_en',
                            'description'        => 'Посада (англ.)',
                            'type'                => fldText,
                            'maxlength'            => 100,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'ground_en',
                            'description'        => 'Діє на підставі (англ.)',
                            'type'                => fldText,
                            'maxlength'            => 250,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'assured',
                            'description'        => 'Вигодонабувач',
                            'type'                => fldText,
                            'maxlength'            => 150,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'assured_en',
                            'description'        => 'Вигодонабувач (англ.)',
                            'type'                => fldText,
                            'maxlength'            => 150,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'delivery_ways_id',
                            'description'        => 'Види транспортування',
                            'type'                => fldSelect,
							'indexType'			=> 'double',
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_cargo_general',
                            'sourceTable'        => 'delivery_ways',
                            'selectField'        => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'                => 'shipping',
                            'description'        => 'Умови поставки',
                            'type'                => fldText,
                            'maxlength'         => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'method',
                            'description'        => 'Метод оцінки страхової суми',
                            'type'                => fldText,
                            'maxlength'         => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'shipping_en',
                            'description'        => 'Умови поставки (англ.)',
                            'type'                => fldText,
                            'maxlength'         => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'method_en',
                            'description'        => 'Метод оцінки страхової суми (англ.)',
                            'type'                => fldText,
                            'maxlength'         => 50,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'price_percent',
                            'description'        => 'Страхова сума на 1 перевезення, %',
                            'type'                => fldMoney,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'number',
                            'description'        => 'Номер',
                            'type'                => fldText,
                            'maxlenght'            => 14,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 2,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'date',
                            'description'        => 'Дата полісу',
                            'type'                => fldDate,
                            'input'                => true,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 3,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'begin_datetime',
                            'description'        => 'Початок',
                            'type'                => fldDate,
                            'input'                => true,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 5,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'end_datetime',
                            'description'        => 'Закінчення',
                            'type'                => fldDate,
                            'input'                => true,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 6,
                            'table'                => 'policies'),
                        array(
                            'name'                => 'payment_types_id',
                            'description'        => 'Оплата (сертифікат)',
                            'type'                => fldBoolean,
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
                            'orderPosition'        => 7,
                            'table'                => 'policies_cargo_general'),
                        array(
                            'name'                => 'policy_statuses_id',
                            'description'        => 'Статус',
                            'type'                => fldSelect,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => true,
                                    'view'        => true,
                                    'update'    => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies',
                            'sourceTable'        => 'policy_statuses',
                            'selectField'        => 'title',
                            'orderField'        => 'order_position'),
                        array(
                            'name'                => 'documents',
                            'description'        => 'Документи',
                            'type'                => fldBoolean,
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => false,
                                    'view'        => true,
                                    'update'    => false,
                                    'change'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policies'),
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
                            'name'                => 'created',
                            'description'        => 'Створено',
                            'type'                => fldDate,
                            'value'                => 'NOW()',
                            'display'            =>
                                array(
                                    'show'        => false,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policies'),
                        array(
                            'name'                => 'modified',
                            'description'        => 'Редаговано',
                            'type'                => fldDate,
                            'value'                => 'NOW()',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 8,
                            'width'             => 100,
                            'table'                => 'policies'),
                        array(
                            'name'               => 'is_bank',
                            'description'        => 'Банк',
                            'type'               => fldHidden,
                            'display'            =>
                                array(
                                    'show'       => true,
                                    'insert'     => false,
                                    'view'       => false,
                                    'update'     => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'       => 9,
                            'table'               => 'policies')
                     ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    => 8,
                        'defaultOrderDirection'    => 'desc',
                        'titleField'            => 'number')
            );

    function Policies_CargoGeneral($data) {
        Policies::Policies($data);

        $this->objectTitle = 'Policies_CargoGeneral';

        $this->messages['plural'] = 'Генеральні договіри добровільного страхування вантажів та багажу (вантажобагажу)';
        $this->messages['single'] = 'Генеральний договір добровільного страхування вантажів та багажу (вантажобагажу)';
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
				break;
            case ROLES_CLIENT_CONTACT:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => false,
                    'update'    => false,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => false);
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

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_clients ' .
                'WHERE id = ' . intval($data['clients_id']);
        $row =  $db->getRow($sql);

        $data = array_merge($data, $row);

        parent::add($data);
    }

    function setConstants(&$data) {
        $data['insurance_companies_id'] = INSURANCE_COMPANIES_EXPRESS;

        if (!$data['policy_statuses_id']) {
            $data['policy_statuses_id'] = POLICY_STATUSES_CREATED;
        }

        return parent::setConstants($data);
    }

    function checkFields(&$data, $action) {
        global $Log;

        parent::checkFields($data, $action);

        if (is_array($data['deductibles'])) {
            foreach ($data['deductibles'] as $i => $value) {

                $params = array('Вантаж', $languageDescription);
                if (!intval($data['deductibles'][ $i ]['item_types_id'])) {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                }

                $params = array('Франшиза', $languageDescription);

                if ($data['deductibles'][ $i ]['value'] == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif ($data['deductibles'][ $i ]['absolute'] == 0 && !$this->isValidPercent($data['deductibles'][ $i ]['value']) ||
                    $data['deductibles'][ $i ]['absolute'] == 1 && !$this->isValidMoney($data['deductibles'][ $i ]['value'])) {
                    $Log->add('error', 'Format1 of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

        if (is_array($data['rates'])) {
            foreach ($data['rates'] as $i => $value) {

                $params = array('Тариф, дні', $languageDescription);

                if ($data['rates'][ $i ]['days'] == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidInteger($data['rates'][ $i ]['days'])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }

                $params = array('Тариф, значення', $languageDescription);
                if ($data['rates'][ $i ]['rate'] == '') {
                    $Log->add('error', 'Required field <b>%s</b>%s is missing.', $params);
                } elseif (!$this->isValidPercent($data['rates'][ $i ]['rate'])) {
                    $Log->add('error', 'Format of the <b>%s</b>%s is not valid.', $params);
                }
            }
        }

		if (is_array($data['delivery_ways_id'])) {
			$data['delivery_ways_id'] = array_sum($data['delivery_ways_id']);
		}

		if (!$Log->isPresent()) {
			$this->formDescription['fields'][ $this->getFieldPositionByName('delivery_ways_id') ]['type'] = fldSelect;
		}
    }

    function updateDeductibles($id, $deductibles) {
        global $db;

        $sql =  'DELETE FROM ' . PREFIX . '_policies_cargo_general_deductibles ' .
                'WHERE policies_id = ' . intval($id);
        $db->query($sql);

        if (is_array($deductibles)) {
            foreach ($deductibles as $deductible) {
                $sql =  'INSERT INTO ' . PREFIX . '_policies_cargo_general_deductibles SET ' .
                        'policies_id = ' . intval($id) . ', ' .
                        'item_types_id = ' . intval($deductible['item_types_id']) . ', ' .
                        'value = ' . $db->quote($deductible['value']) . ', ' .
                        'absolute = ' . intval($deductible['absolute']) . ', ' .
                        'created = NOW()';
                $db->query($sql);
            }
        }
    }

    function updateRates($id, $rates) {
        global $db;

        $sql =  'DELETE FROM ' . PREFIX . '_policies_cargo_general_rates ' .
                'WHERE policies_id = ' . intval($id);
        $db->query($sql);

        if (is_array($rates)) {
            foreach ($rates as $rate) {
                $sql =  'INSERT INTO ' . PREFIX . '_policies_cargo_general_rates SET ' .
						'policies_id = ' . intval($id) . ', ' .
						'item_types_id = ' . intval($rate['item_types_id']) . ', ' .
						'days = ' . intval($rate['days']) . ', ' .
						'rate = ' . $db->quote($rate['rate']) . ', ' .
						'created = NOW()';
                $db->query($sql);
            }
        }
    }

    function updateRisks($id, $product_types_id, $risks, $products_id=0) {
        global $db;

        $sql =  'DELETE FROM ' . PREFIX . '_policy_risks ' .
                'WHERE policies_id = ' . intval($id);

        $db->query($sql);

        $sql =  'INSERT INTO ' . PREFIX . '_policy_risks (policies_id, risks_id) ' .
                'SELECT ' . intval($id) . ', id  ' .
                'FROM ' . PREFIX . '_parameters_risks AS a ' .
                'WHERE id IN(' . implode(', ', $risks) . ') ';

        $db->query($sql);
    }

    function setAdditionalFields($id, $data) {
        global $db, $Templates;

        $sql =  'UPDATE ' . PREFIX . '_policies as a ' .
                'JOIN ' . PREFIX . '_policies_cargo_general as b ON a.id = b.policies_id ' .
                'JOIN ' . PREFIX . '_policies as c ON b.policies_id = c.id ' .
                'JOIN ' . PREFIX . '_clients as d ON c.clients_id = d.id SET ' .
                'a.insurer = d.company, ' .
				'a.interrupt_datetime = a.end_datetime, ' .
                'b.number = IF(b.number, b.number, 1) ' .
                'WHERE a.id = ' . intval($id);
        $db->query($sql);

        $this->updateRisks($id, PRODUCT_TYPES_CARGO, $data['risks']);
        $this->updateDeductibles($id, $data['deductibles']);
        $this->updateRates($id, $data['rates']);
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log;

        $data['agencies_id'] = AGENCIES_EXPRESS_INSURANCE;
        $data['agents_id']   = 3172;

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

    function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies_cargo_general_deductibles ' .
                'WHERE policies_id = ' . intval($data['id']) . ' ' .
				'ORDER BY item_types_id';
        $data['deductibles'] = $db->getAll($sql);

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_policies_cargo_general_rates ' .
                'WHERE policies_id = ' . intval($data['id']) . ' ' .
                'ORDER BY item_types_id, days';
        $data['rates'] = $db->getAll($sql);

        return $data;
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

        $Policies = Policies::factory($data, 'Cargo');

        $sql =  'SELECT policies_id AS id ' .
                'FROM ' . PREFIX . '_policies_cargo ' .
                'WHERE policies_general_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $Policies->messages['plural'] . '</b>.');
            return false;
        }

        return parent::deleteProcess($data, $i, $folder);
    }
}
?>
