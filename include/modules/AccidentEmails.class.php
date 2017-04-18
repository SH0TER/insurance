<?

class AccidentEmails extends Form{

    var $formDescription =
            array(
                'fields' =>
                        array(
                            array(
                                'name' => 'id',
                                'type' => fldIdentity,
                                'display'               =>
                                    array(
                                        'show'          => true,
                                        'insert'        => false,
                                        'view'          => true,
                                        'update'        => true
                                    ),
                                'verification'          =>
                                    array(
                                        'canBeEmpty'    => false
                                    ),
                                'table'                 => 'accident_emails'),
                            array(
                                'name' => 'accidents_id',
                                'type' => fldHidden,
                                'display'               =>
                                    array(
                                        'show'          => true,
                                        'insert'        => true,
                                        'view'          => true,
                                        'update'        => true
                                    ),
                                'verification'          =>
                                    array(
                                        'canBeEmpty'    => true
                                    ),
                                'orderPosition'         => -1,
                                'table'                 => 'accident_emails',
                                'sourceTable'           => 'accidents'),
                            array(
                                'name'                  => 'title',
                                'description'           => 'Назва',
                                'type'                  => fldText,
                                'display'               =>
                                    array(
                                        'show'          => true,
                                        'insert'        => true,
                                        'view'          => true,
                                        'update'        => true
                                    ),
                                'verification'          =>
                                    array(
                                        'canBeEmpty'	=> false
                                    ),
                                'orderPosition'         => 1,
                                'table'                 => 'accident_emails'),
                            array(
                                'name'                  => 'delivery_date',
                                'description'           => 'Дата доставки адресату',
                                'type'                  => fldDate,
                                'display'               =>
                                    array(
                                        'show'          => true,
                                        'insert'        => true,
                                        'view'          => true,
                                        'update'        => true
                                    ),
                                'verification'          =>
                                    array(
                                        'canBeEmpty'	=> true
                                    ),
                                'orderPosition'         => 2,
                                'table'                 => 'accident_emails'),
                            array(
                                'name'                  => 'return_date',
                                'description'           => 'Дата повернення в СК',
                                'type'                  => fldDate,
                                'display'               =>
                                array(
                                        'show'          => true,
                                        'insert'        => true,
                                        'view'          => true,
                                        'update'        => true
                                    ),
                                'verification'          =>
                                    array(
                                        'canBeEmpty'	=> true
                                    ),
                                'orderPosition'         => 3,
                                'table'                 => 'accident_emails'),
                            array(
                                'name'                  => 'reason',
                                'description'           => 'Причина повернення в СК',
                                'type'                  => fldText,
                                'display'               =>
                                array(
                                        'show'          => true,
                                        'insert'        => true,
                                        'view'          => true,
                                        'update'        => true
                                    ),
                                'verification'          =>
                                    array(
                                        'canBeEmpty'	=> true
                                    ),
                                'orderPosition'         => 4,
                                'table'                 => 'accident_emails'),
                            array(
                                'name'                  => 'created',
                                'description'           => 'Створено',
                                'type'                  => fldDateTime,
                                'value'                 => 'NOW()',
                                'display'               =>
                                    array(
                                        'show'          => false,
                                        'insert'        => false,
                                        'view'          => false,
                                        'update'        => false
                                    ),
                                'verification'          =>
                                    array(
                                        'canBeEmpty'	=> false
                                    ),
                                'orderPosition'         => 5,
                                'width'                 => 100,
                                'table'                 => 'accident_emails'),
                            array(
                                'name'                  => 'modified',
                                'description'           => 'Редаговано',
                                'type'                  => fldDateTime,
                                'value'                 => 'NOW()',
                                'display'               =>
                                    array(
                                        'show'          => false,
                                        'insert'        => false,
                                        'view'          => false,
                                        'update'        => false
                                    ),
                                'verification'          =>
                                    array(
                                        'canBeEmpty'	=> false
                                    ),
                                'orderPosition'         => 6,
                                'width'                 => 100,
                                'table'                 => 'accident_emails'),
                        ),
                'common'    =>
                    array(
                        'defaultOrderPosition'      => 2,
                        'defaultOrderDirection'     => 'desc',
                        'titleField'                => 'title'
                    )
            );

    function AccidentEmails($data, $objectTitle=null) {

    Form::Form($data);

    $this->messages['plural'] = 'Листи';
    $this->messages['single'] = 'Лист';
    }

    function setPermissions($data) {
		global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => true,
                    'view'      => true,
                    'delete'    => true);
                break;
            case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='AccidentEmails/show.php', $limit=true) {
        global $db;
        
        $conditions[] = 'accidents_id = ' .$data['accidents_id'];

        parent::show($data, $fields, $conditions, $sql, $template, $limit);
    }

    function checkFields($data, $action) {
		global $Log;

		parent::checkFields($data, $action);
        
        if($data['delivery_date'] && !checkdate($data['delivery_date_month'], $data['delivery_date_day'], $data['delivery_date_year'])){
           $Log->add('error', 'Поле \'<b>Дата доставки адресату</b>\' заповнене не правильно ');
        }
        if($data['return_date'] && !checkdate($data['return_date_month'], $data['return_date_day'], $data['return_date_year'])){
           $Log->add('error', 'Поле \'<b>Дата повернення в СК</b>\' заповнене не правильно ');
        }
    }

}
?>