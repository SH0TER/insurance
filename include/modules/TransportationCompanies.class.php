<?
/*
 * Title: transportation company class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class TransportationCompanies extends Form {

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
                            'table'                => 'transportation_companies'),
                        array(
                            'name'                => 'title',
                            'description'        => 'Назва',
                            'type'                => fldUnique,
                            'maxlength'            => 50,
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
                            'table'                => 'transportation_companies'),
                        array(
                            'name'                => 'title_en',
                            'description'        => 'Назва (англ.)',
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
                            'table'                => 'transportation_companies'),
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
                            'table'                => 'transportation_companies'),
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
                            'table'                => 'transportation_companies')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    => 1,
                        'defaultOrderDirection'    => 'asc',
                        'titleField'            => 'title'
                    )
            );

    function TransportationCompanies($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Транспортні компанії';
        $this->messages['single'] = 'Транспортна компанія';
    }

    function setPermissions() {
		global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => true,
                    'view'      => false,
                    'change'    => false,
                    'delete'    => true);
                break;
        }
    }

    function getListToChoose() {
        global $db;

        $sql =  'SELECT * ' .
                'FROM ' . PREFIX . '_transportation_companies';
        $res = $db->query($sql);

        $result = '<div id="transportationCompanies" style="display:none">';

        while($res->fetchInto($row)) {
            $result .= '<a href="javascript: setTransportationCompanyFields(' . $db->quote($row['title']) . ', ' . $db->quote($row['title_en']) . ')"><strong>' . $row['title'] . '</strong></a><br />';
        }

        $result .= '</div>';

        return $result;
    }
 }

?>