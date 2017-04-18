<?
/*
 * Title: accident regressions class
 *
 * @author Eugene Cherkassky
 * @email eugene.cherkassy@gmail.com
 * @version 3.0
 */

class AccidentRegressions extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'              => 'id',
                            'type'              => fldIdentity,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'table'             => 'accident_regressions'),
                        array(
                            'name'              => 'accidents_number',
                            'description'       => 'Номер',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 1,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'accidents_date_format',
                            'description'       => 'Подія',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 2,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'date_format',
                            'description'       => 'Передача',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 3,
                            'width'             => 100,
                            'table'             => 'accidents'),
                        array(
                            'name'              => 'person_types_id',
                            'description'       => 'Особа',
                            'type'              => fldInteger,
                            'list'				=> array(
                                                    1 => 'Фізична',
                                                    2 => 'Юридична'),
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 4,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'title',
                            'description'       => 'Інша сторона',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 5,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),

                        array(
                            'name'              => 'pretension_date',
                            'description'       => 'Претензія, дата',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 6,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'pretension_number',
                            'description'       => 'Претензія, номер',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 7,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'pretension_amount',
                            'description'       => 'Претензія, сума грн.',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 8,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'pretension_comment',
                            'description'       => 'Претензія, коментар',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 9,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'retension_perfmormers_title',
                            'description'       => 'Претензія, виконавець',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 10,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'claim_date',
                            'description'       => 'Позов, дата',
                            'type'              => fldDate,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 11,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'claim_number',
                            'description'       => 'Позов, номер',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 12,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'claim_amount',
                            'description'       => 'Позов, сума грн.',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 13,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'claim_comment',
                            'description'       => 'Позов, коментар',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 14,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'claim_perfmormers_title',
                            'description'       => 'Позов, виконавець',
                            'type'              => fldText,
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 15,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'created',
                            'description'       => 'Створено',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false
                                ),
                            'orderPosition'     => 16,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => false
                                ),
                            'orderPosition'     => 17,
                            'width'             => 100,
                            'table'             => 'accident_regression_culprits')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 17,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'modified'
                    )
            );

    function AccidentRegressions($data) {

        $this->object = 'AccidentRegressions';
        $this->objectTitle = 'AccidentRegressions';

        Form::Form($data);

        $this->messages['plural'] = 'Регреси';
        $this->messages['single'] = 'Регрес';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'   => true,
                    'insert' => true,
                    'update' => true,
                    'delete' => true,
				);
                break;
        }
    }

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {

		if (isset($data['accident_number'])) {
			$conditions[] = 'accident_number LIKE ' . $db->quote($data['accident_number'] . '%');
		}

		if (intval($data['person_types_id'])) {
			$conditions[] = 'c.person_types_id = ' . intval($data['person_types_id']);
		}

		if (isset($data['title'])) {
			$conditions[] = 'c.title LIKE ' . $db->quote($data['title'] . '%');
		}

		if (intval($data['regres_statuses_id'])) {
			$conditions[] = 'c.person_types_id = ' . intval($data['person_types_id']);
		}

		$sql =	'SELECT ' . PREFIX . '_accidents.number AS accidents_number, date_format(' . PREFIX . '_accidents.datetime, \'%d.%m.%Y\') AS accidents_date_format, date_format(' . PREFIX . '_accident_regressions.date, \'%d.%m.%Y\') AS date_format, ' . PREFIX . '_accident_regression_culprits.person_types_id, ' . PREFIX . '_accident_regression_culprits.title, ' .
				'date_format(pretension_date, \'%d.%m.%Y\') AS pretension_date_format, pretension_number, pretension_amount, pretension_comment, CONCAT(d.lastname, \' \', d.firstname) AS pretension_perfmormers_title, ' .
				'date_format(claim_date, \'%d.%m.%Y\') AS claim_date_format, claim_number, claim_amount, claim_comment, CONCAT(e.lastname, \' \', e.firstname) AS claim_perfmormers_title, ' .
				PREFIX . '_accident_regression_statuses.title AS regressions_statuses_title, ' . PREFIX . '_accident_regressions.comment, date_format(' . PREFIX . '_accident_regressions.created, \'%d.%m.%Y\') AS created_format, date_format(' . PREFIX . '_accident_regressions.modified, \'%d.%m.%Y\') AS modified_format ' .
				'FROM ' . PREFIX . '_accident_regressions ' .
				'JOIN ' . PREFIX . '_accidents ON ' . PREFIX . '_accident_regressions.accidents_id = ' . PREFIX . '_accidents.id ' .
				'JOIN ' . PREFIX . '_accident_regression_culprits ON ' . PREFIX . '_accident_regressions.id = ' . PREFIX . '_accident_regression_culprits.regressions_id ' .
				'LEFT JOIN ' . PREFIX . '_accounts AS d ON ' . PREFIX . '_accident_regression_culprits.pretension_perfmormers_id = d.id ' .
				'LEFT JOIN ' . PREFIX . '_accounts AS e ON ' . PREFIX . '_accident_regression_culprits.claim_perfmormers_id = e.id ' .
				'LEFT JOIN ' . PREFIX . '_accident_regression_statuses ON ' . PREFIX . '_accident_regression_culprits.regression_statuses_id = ' . PREFIX . '_accident_regression_statuses.id ';

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}
}

?>