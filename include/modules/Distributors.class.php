<?
/*
 * Title: distributor class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class Distributors extends Form {

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
                            'table'                => 'distributors'),
                        array(
                            'name'                => 'title',
                            'description'        => 'Назва',
                            'type'                => fldUnique,
                            'maxlength'            => 100,
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
                            'orderPosition'        => 1,
                            'table'                => 'distributors'),
                        array(
                            'name'                => 'title_en',
                            'description'        => 'Назва (англ.)',
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
                            'table'                => 'distributors'),
                        array(
                            'name'                  => 'identification_code',
                            'description'           => 'ЄДРПОУ',
                            'type'                  => fldText,
                            'maxlength'             => 8,
                            'validationRule'        => '^[0-9]{8}$',
                            'display'               =>
                                array(
                                    'show'          => false,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'distributors'),
                        array(
                            'name'                => 'address',
                            'description'        => 'Адреса',
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
                            'table'                => 'distributors'),
                        array(
                            'name'                => 'address_en',
                            'description'        => 'Адреса (англ.)',
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
                            'table'                => 'distributors'),
                        array(
                            'name'                  => 'phone',
                            'description'           => 'Телефон',
                            'type'                  => fldText,
                            'validationRule'        => '^\([0-9]{3,5}\) [0-9]{1,3}-[0-9]{2}-[0-9]{2}$',
                            'maxlength'             => 15,
                            'display'               =>
                                array(
                                    'show'          => true,
                                    'insert'        => true,
                                    'view'          => true,
                                    'update'        => true
                                ),
                            'verification'          =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                 => 'distributors'),
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
                            'table'                => 'distributors'),
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
                            'orderPosition'        => 2,
                            'width'                => 120,
                            'table'                => 'distributors')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    => 1,
                        'defaultOrderDirection'    => 'asc',
                        'titleField'            => 'title'
                    )
            );

    function Distributors($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Дистрибутори';
        $this->messages['single'] = 'Дистрибутор';
    }

    function setPermissions() {
		global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'	=> true,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
        }
    }

    function getListToChoose() {
        global $db;

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_distributors';
        $res = $db->query($sql);

        $result = '<div id="hiddenModalContent" style="display:none">';

        while($res->fetchInto($row)) {
            $result .= '<a href="javascript: setDistributorFields(' . $db->quote($row['title']) . ', ' . $db->quote($row['title_en']) . ', ' . $db->quote($row['identification_code']) . ', ' . $db->quote($row['address']) . ', ' . $db->quote($row['address_en']) . ', ' . $db->quote($row['phone']) . ')"><strong>' . $row['title'] . '</strong></a><br />';
        }

        $result .= '</div>';

        return $result;
    }
 }

?>