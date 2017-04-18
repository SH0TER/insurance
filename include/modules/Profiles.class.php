<?
/*
 * Title: Profiles class
 *
 * @author 
 * @email 
 * @version 3.0
 */

require_once 'ProfileQuestions.class.php';
require_once 'ProfileTypes.class.php';

class Profiles extends Form {

    var $formDescription =
            array(
                'fields'    =>
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
                            'table'             => 'profiles'),
                        array(
                            'name'              => 'profile_types_id',
                            'description'       => 'Тип анкети',
                            'type'              => fldSelect,
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
                            'sourceTable'       => 'profile_types',
                            'orderField'        => 'id',
                            'selectField'       => 'title',
                            'table'             => 'profiles'),
                        array(
                            'name'              => 'number',
                            'description'       => 'Номер',
                            'type'              => fldText,
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
                            'orderPosition'     => 1,
                            'table'             => 'profiles'),
                        array(
                            'name'              => 'answers',
                            'description'       => 'Відповіді',
                            'type'              => fldText,
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
                            'table'             => 'profiles'),
                        array(
                            'name'              => 'managers_id',
                            'description'       => 'Менеджер',
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
                            'orderPosition'     => 3,
                            'sourceTable'       => 'accounts',
                            'orderField'        => 'id',
                            'selectField'       => 'lastname',
                            'table'             => 'profiles'),
                        array(
                            'name'              => 'comment',
                            'description'       => 'Коментар',
                            'type'              => fldNote,
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
                            'orderPosition'     => 6,
                            'table'             => 'profiles'),
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
                            'orderPosition'     => 4,
                            'width'             => 100,
                            'table'             => 'profiles'),
                        array(
                            'name'              => 'modified',
                            'description'       => 'Редаговано',
                            'type'              => fldDate,
                            'value'             => 'NOW()',
                            'display'           =>
                                array(
                                    'show'      => true
                                ),
                            'orderPosition'     => 5,
                            'width'             => 100,
                            'table'             => 'profiles')
                        
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'  => 2,
                        'defaultOrderDirection' => 'desc',
                        'titleField'            => 'id'
                    )
            );

    function Profiles($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Анкети';
        $this->messages['single'] = 'Анкета';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => true,
                    'delete'    => true,
                    'view'      => true,
                    'export'    => true);
                break;
        }
    }
    
    function insert($data) {
        global $Log, $db;

        $data['id'] = parent::insert(&$data, false, true);
        $this->setAdditionalFields($data['id'], $data, true);

        $params['title']    = $this->messages['single'];
        $params['id']       = $data['id'];
        $params['storage']  = $this->tables[0];

        if($data['id'] > 0) {
            $sql = 'SELECT number FROM ' . PREFIX . '_profiles WHERE id = ' . intval($data['id']);
            $number = $db->getOne($sql);
            $params['text'] = ' Номер ' . $number;

            if ($data['profile_types_id'] == 10) {
                $this->sendInWindow($data['id']);
            }

            $Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
            header("Location: /index.php?do=Profiles|show");
            exit;
        }       
    }
    
    function setAdditionalFields($id, $data, $init=false) {
        global $db;
        
        $sql = 'UPDATE ' . PREFIX . '_profiles SET number = id WHERE id = ' . intval($id);
        $db->query($sql);
    }
    
    function show($data, $fields=null, $conditions=null, $sql=null, $template='Profiles/show.php', $limit=true) {
        global $db, $Authorization;
        
        if (in_array($Authorization->data['id'], array(6571, 12046, 13133, 1))) {
            $ProfileTypes = new ProfileTypes($data);
            $ProfileTypes->show($data);

            $ProfileQuestions = new ProfileQuestions($data);
            $ProfileQuestions->show($data);     
        }   
        
        $conditions[] = '1';
        
        if (intval($data['profile_types_id'])) {
            $fields[] = 'profile_types_id';
            $conditions[] = PREFIX . '_profiles.profile_types_id = ' . intval($data['profile_types_id']);
        }
        
        if ($data['profiles_number']) {
            $fields[] = 'profiles_number';
            $conditions[] = PREFIX . '_profiles.number LIKE ' . $db->quote('%' . $data['profiles_number'] . '%');
        }
        
        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = PREFIX . '_profiles.created >= ' . $db->quote( substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2) . ' 00:00:00');
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] = PREFIX . '_profiles.created <= ' . $db->quote( substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2) . ' 23:59:59');
        }
        
        if (intval($data['managers_id'])) {
            $fields[] = 'managers_id';
            $conditions[] = PREFIX . '_profiles.managers_id = ' . intval($data['managers_id']);
        }
        
        $sql = 'SELECT ' . PREFIX . '_profiles.id as id, ' . PREFIX . '_profiles.number as number, ' . PREFIX . '_profiles.client_name, date_format(' . PREFIX . '_profiles.modified, \'%d.%m.%Y\') as modified_format, date_format(' . PREFIX . '_profiles.created, \'%d.%m.%Y %H:%i\') as created_format, ' .
                    'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) as managers_id, ' .
                    PREFIX . '_profile_types.title as profile_types_id, ' . PREFIX . '_profiles.comment ' .
                'FROM ' . PREFIX . '_profiles ' .
                'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_profiles.managers_id = ' . PREFIX . '_accounts.id ' .
                'JOIN ' . PREFIX . '_profile_types ON ' . PREFIX . '_profiles.profile_types_id = ' . PREFIX . '_profile_types.id ' .
                'WHERE ' . implode(' AND ', $conditions);

        return parent::show($data, $fields, $conditions, $sql, $template, $limit);
    }
    
    function view($data) {
        parent::view($data, null, null, $template='form.php', $showForm=true);
    }

    function load($data) {

        $redirect = "/index.php?do=Profiles|show";

        if (intval($data['profile_types_id'])) {
            $redirect .= "&profile_types_id=" . intval($data['profile_types_id']);
        }
        
        if ($data['profiles_number']) {
            $redirect .= "&profiles_number=" . $data['profiles_number'];
        }
        
        if ($data['from']) {
            $redirect .= "&from=" . $data['from'];
        }

        if ($data['to']) {
            $redirect .= "&to=" . $data['to'];
        }
        
        if (intval($data['managers_id'])) {
            $redirect .= "&managers_id=" . intval($data['managers_id']);
        }

        parent::load($data, true, 'update', 'update', null, $redirect);
    }
    
    function loadQuestionsInWindow($data) {
        global $db;

        if ($data['action'] == 'view') {
            $this->mode = 'view';
        }
        
        $sql = 'SELECT * ' .
               'FROM ' . PREFIX . '_profile_questions ' .
               'WHERE profile_types_id = ' . intval($data['profile_types_id']) . ' ' .
               'ORDER BY order_position';
        $list = $db->getAll($sql);

        $result = '';

        $replaceWhat = array(
            '[b]',
            '[/b]',
            '[u]',
            '[/u]',
            '[i]',
            '[/i]',
        );

        $replaceWith = array(
            '<b>',
            '</b>',
            '<u>',
            '</u>',
            '<i>',
            '</i>',
        );

        foreach($list as $row) {
            $answers = explode(';', $row['answers']);
            $bgcolor = $row['color'] ? 'bgcolor="#' . $row['color'] . '"' : '';

            $result .= '<table border="0" width="100%" ' . $bgcolor . '><tr>';
            $info = explode("\n", $row['info']);
            $result .= '<tr><td colspan="4">';
            foreach ($info as $line) {
                $line = str_replace($replaceWhat, $replaceWith, $line);
                $result .= $line . '</br>';
            }
            $result .= '</td></tr>';
            $result .= '<td width="150" class="label" colspan="1">' . (intval($row['required']) ? $this->getMark() : '') . $row['question'] . ':</td>';
            if ($row['answers']) {
                $result .= '<td width="250" ' . ((intval($row['other']) || in_array('Так, СМС', $answers) || in_array('Так, електронною поштою', $answers)) ? 'colspan="1"' : 'colspan="3"') . '><select onChange="changeAnswer(this.value, ' . intval($row['id']) . ')" name="question_answer[' . $row['id'] . ']" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" ' . $this->getReadonly(true) . '>';
                    $options = '<option>...</option>';
                    foreach($answers as $answer) {
                        $options .= '<option ' . ($data['question_answer'][$row['id']] == $answer ? 'selected' : '') . '>' . $answer . '</option>';
                    }
                $result .= $options . '</select></td>';
            } elseif (intval($row['note'])) {
                $result .= '<td width="250" ' . (!intval($row['other']) ? 'colspan="3"' : 'colspan="1"') . '><textarea name="question_answer[' . $row['id'] . ']" class="fldNote" onblur="this.className=\'fldNote\';" onfocus="this.className=\'fldNoteOver\';" '. $this->getReadonly(false) .'>' . $data['question_answer'][$row['id']] . '</textarea></td>';
            } else {
                $result .= '<td width="250" ' . (!intval($row['other']) ? 'colspan="3"' : 'colspan="1"') . '><input type="text" name="question_answer[' . $row['id'] . ']" value="' . htmlspecialchars($data['question_answer'][$row['id']]) . '" class="fldText" onblur="this.className=\'fldText\';" onfocus="this.className=\'fldTextOver\';" '. $this->getReadonly(false) .'></td>';
            }
            if ($row['other'] || in_array('Так, СМС', $answers) || in_array('Так, електронною поштою', $answers)) {
                $result .= '<td class="commentBlockNone' . $row['id'] . '" width="100" style="display: block;" colspan="2"></td>';
                $result .= '<td class="commentBlock' . $row['id'] . '" width="100" style="display: none;"><b>Коментар:</b></td><td class="commentBlock' . $row['id'] . '" style="display: none;"><input name="question_comment[' . $row['id'] . ']" value="' . $data['question_comment'][$row['id']] . '" type="edit" class="fldText" onblur="this.className=\'fldText\'" onfocus="this.className=\'fldTextOver\'" '. $this->getReadonly(false) .'></td>';
            }
            $result .= '</tr>';         
        }
        
        $result .= '<tr><td colspan="4">';
            
        $sql = 'SELECT end FROM ' . PREFIX . '_profile_types WHERE id = ' . intval($data['profile_types_id']);
        $end = $db->getOne($sql);
        $end = explode("\n", $end);
        
        foreach ($end as $line) {
            $result .= '<b>' . $line . '</b></br>';
        }
        
        $result .= '</td></tr></table>';
        echo $result;
        exit;
    }

    function setConstants(&$data) {
        global $Authorization;
        
        if (!intval($data['id'])) {
            $data['managers_id'] = $Authorization->data['id'];
        }
        
        $answers = array();
        foreach($data['question_answer'] as $id => $value) {
            $answers[$id] = array('question_answer' => htmlspecialchars($value), 'question_comment' => htmlspecialchars($data['question_comment'][$id]));
        }
        $data['answers'] = json_encode($answers);
        
    }
    
    function prepareFields($action, $data) {
        $data['answers'] = json_decode($data['answers']);
    
        foreach ($data['answers'] as $id => $row) {
            $data['question_answer'][$id] = $row->question_answer;
            $data['question_comment'][$id] = $row->question_comment;
        }

        return $data;
    }
    
    function checkFields($data, $action) {
        global $db, $Log;

        parent::checkFields($data, $action);
        
        $sql = 'SELECT * ' .
               'FROM ' . PREFIX . '_profile_questions ' .
               'WHERE required = 1 AND profile_types_id = ' . intval($data['profile_types_id']);
        $questions = $db->getAll($sql);

        foreach($questions as $question) {
            $answers = explode(';', $question['answers']);
            if (strlen($question['answers']) && !in_array($data['question_answer'][$question['id']], $answers) || !strlen($data['question_answer'][$question['id']]) && !strlen($question['answers'])) {
                $Log->add('error', sizeOf($answers) . ' Виберіть відповідь на запитання "' . $question['question'] . '"');
            }
        }
        //exit;
    }

    function exportInWindow($data, $download=true) {
        global $db;

        $conditions[] = '1';

        if (intval($data['id'])) {
            $fields[] = 'id';
            $conditions[] = PREFIX . '_profiles.id = ' . intval($data['id']);
        }

        if (intval($data['profile_types_id'])) {
            $fields[] = 'profile_types_id';
            $conditions[] = PREFIX . '_profiles.profile_types_id = ' . intval($data['profile_types_id']);
        }

        if ($data['profiles_number']) {
            $fields[] = 'profiles_number';
            $conditions[] = PREFIX . '_profiles.number LIKE ' . $db->quote('%' . $data['profiles_number'] . '%');
        }

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = PREFIX . '_profiles.created >= ' . $db->quote( substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2) . ' 00:00:00');
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] = PREFIX . '_profiles.created <= ' . $db->quote( substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2) . ' 23:59:59');
        }

        if (intval($data['managers_id'])) {
            $fields[] = 'managers_id';
            $conditions[] = PREFIX . '_profiles.managers_id = ' . intval($data['managers_id']);
        }

        $sql = 'SELECT ' . PREFIX . '_profiles.id as id, ' . PREFIX . '_profiles.number as number, date_format(' . PREFIX . '_profiles.created, \'%d.%m.%Y %H:%i:%s\') as created_format, ' .
               'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) as managers_id, ' .
               PREFIX . '_profile_types.title as profile_types_id, ' . PREFIX . '_profiles.answers, ' . PREFIX . '_profiles.comment ' .
               'FROM ' . PREFIX . '_profiles ' .
               'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_profiles.managers_id = ' . PREFIX . '_accounts.id ' .
               'JOIN ' . PREFIX . '_profile_types ON ' . PREFIX . '_profiles.profile_types_id = ' . PREFIX . '_profile_types.id ' .
               'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        $sql = 'SELECT id, question, answers ' .
               'FROM ' . PREFIX . '_profile_questions ' .
               'WHERE profile_types_id = ' . intval($data['profile_types_id']) . ' ' .
               'ORDER BY order_position';
        $questions = $db->getAll($sql);

        if ($download) {
            header('Content-Disposition: attachment; filename="report.xls"');
            header('Content-Type: ' . Form::getContentType('report.xls'));

            include_once $this->object . '/excel.php';
            exit;
        } else {
            ob_start();

            require_once $this->object . '/excel.php';

            return ob_get_clean();
        }
    }

    function getAnswer($question, $answer) {

        $answers = array_flip(explode(';', $question['answers']));
        $answers_code = explode(';', $question['answers_code']);

        return $answers_code[ $answers[ $answer ] ];
    }

    function exportFalconInWindow($data) {
        global $db;

        $data['profile_types_id'] = 11;

        $fields[] = 'profile_types_id';
        $conditions[] = PREFIX . '_profiles.profile_types_id = ' . intval($data['profile_types_id']);

        if (intval($data['id'][0])) {
            $fields[] = 'id';
            $conditions[] = PREFIX . '_profiles.id = ' . intval($data['id'][0]);
        }

        if ($data['profiles_number']) {
            $fields[] = 'profiles_number';
            $conditions[] = PREFIX . '_profiles.number LIKE ' . $db->quote('%' . $data['profiles_number'] . '%');
        }

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = PREFIX . '_profiles.created >= ' . $db->quote( substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2) . ' 00:00:00');
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] = PREFIX . '_profiles.created <= ' . $db->quote( substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2) . ' 23:59:59');
        }

        if (intval($data['managers_id'])) {
            $fields[] = 'managers_id';
            $conditions[] = PREFIX . '_profiles.managers_id = ' . intval($data['managers_id']);
        }

        //вытаскиваем ответы
        $sql = 'SELECT ' . PREFIX . '_profiles.id as id, ' . PREFIX . '_profiles.number as number, date_format(' . PREFIX . '_profiles.created, \'%Y%m%d\') as created_format, ' .
               'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) as managers_id, ' . PREFIX . '_accounts.id as accounts_id, ' .
               PREFIX . '_profile_types.title as profile_types_id, ' . PREFIX . '_profiles.answers ' .
               'FROM ' . PREFIX . '_profiles ' .
               'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_profiles.managers_id = ' . PREFIX . '_accounts.id ' .
               'JOIN ' . PREFIX . '_profile_types ON ' . PREFIX . '_profiles.profile_types_id = ' . PREFIX . '_profile_types.id ' .
               'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        //вытаскиваем вопросы
        $sql = 'SELECT id, question, question_code, answers, answers_code ' .
               'FROM ' . PREFIX . '_profile_questions ' .
               'WHERE profile_types_id = ' . intval($data['profile_types_id']) . ' ' .
               'ORDER BY order_position';
        $res = $db->query($sql);

        $questions = array();
        while($res->fetchInto($row)) {
            $questions[ $row['id'] ] = $row;
        }

        $result = array();
        foreach ($list as $row) {
            $answers = json_decode( $row['answers'] );

            $row['distributor_code'] = 'C41VD';

            foreach ($answers as $id => $answer) {
                switch ($id) {
                    case '124'://diler_code
                        $row['diler_code'] = $this->getAnswer($questions[ 124 ], $answer->question_answer);
                        break;
                    case '125'://shassi
                        $row['shassi'] = $answer->question_answer;
                        break;
					case '152': //servise_date
						$row['servise_date'] = $answer->question_answer;
						break;
                    case '':
                        break;
                }
            }

            foreach ($answers as $id => $answer) {

                $question_code = explode(';', $questions[ $id ]['question_code']);

                $result[] = array(
                    'service_code' => 'SV',
                    'category_code' => $question_code[0],
                    'poll_code' => $row['diler_code'] . $row['created_format'] . substr($row['shassi'], -6),
                    'date' => $row['servise_date'],
                    'question_code' => $question_code[1],
                    'distributor_code' => $row['distributor_code'],
                    'diler_code' => $row['diler_code'],
                    'client_code' => $row['distributor_code'] . $row['diler_code'] . substr($row['shassi'], -6),
                    'shassi' => $row['shassi'],
                    'user_code' =>  $row['distributor_code'] . 'IV' . substr($row['accounts_id'], -2),
                    'respondent_code' => $row['distributor_code'] . $row['diler_code'] . $row['created_format'] . $row['number'],
                    'answer_code' => $this->getAnswer($questions[ $id ], $answer->question_answer),
                    'answer_uk' => $answer->question_answer,
                    'answer_en' => ''
                );
            }
        }

        header('Content-Disposition: attachment; filename="report.xls"');
        header('Content-Type: ' . Form::getContentType('report.xls'));

        include_once $this->object . '/excelFalcon.php';
        exit;
    }

    function exportFalconDCSIInWindow($data) {
        global $db;

        $data['profile_types_id'] = 15;

        $fields[] = 'profile_types_id';
        $conditions[] = PREFIX . '_profiles.profile_types_id = ' . intval($data['profile_types_id']);

        if (intval($data['id'][0])) {
            $fields[] = 'id';
            $conditions[] = PREFIX . '_profiles.id = ' . intval($data['id'][0]);
        }

        if ($data['profiles_number']) {
            $fields[] = 'profiles_number';
            $conditions[] = PREFIX . '_profiles.number LIKE ' . $db->quote('%' . $data['profiles_number'] . '%');
        }

        if ($data['from']) {
            $fields[] = 'from';
            $conditions[] = PREFIX . '_profiles.created >= ' . $db->quote( substr($data['from'], 6, 4) . '-' . substr($data['from'], 3, 2) . '-' . substr($data['from'], 0, 2) . ' 00:00:00');
        }

        if ($data['to']) {
            $fields[] = 'to';
            $conditions[] = PREFIX . '_profiles.created <= ' . $db->quote( substr($data['to'], 6, 4) . '-' . substr($data['to'], 3, 2) . '-' . substr($data['to'], 0, 2) . ' 23:59:59');
        }

        if (intval($data['managers_id'])) {
            $fields[] = 'managers_id';
            $conditions[] = PREFIX . '_profiles.managers_id = ' . intval($data['managers_id']);
        }

        //вытаскиваем ответы
        $sql = 'SELECT ' . PREFIX . '_profiles.id as id, ' . PREFIX . '_profiles.number as number, date_format(' . PREFIX . '_profiles.created, \'%Y%m%d\') as created_format, ' .
               'CONCAT(' . PREFIX . '_accounts.lastname, \' \', ' . PREFIX . '_accounts.firstname) as managers_id, ' . PREFIX . '_accounts.id as accounts_id, ' .
               PREFIX . '_profile_types.title as profile_types_id, ' . PREFIX . '_profiles.answers ' .
               'FROM ' . PREFIX . '_profiles ' .
               'JOIN ' . PREFIX . '_accounts ON ' . PREFIX . '_profiles.managers_id = ' . PREFIX . '_accounts.id ' .
               'JOIN ' . PREFIX . '_profile_types ON ' . PREFIX . '_profiles.profile_types_id = ' . PREFIX . '_profile_types.id ' .
               'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);

        //вытаскиваем вопросы
        $sql = 'SELECT id, question, question_code, answers, answers_code ' .
               'FROM ' . PREFIX . '_profile_questions ' .
               'WHERE profile_types_id = ' . intval($data['profile_types_id']) . ' ' .
               'ORDER BY order_position';
        $res = $db->query($sql);

        $questions = array();
        while($res->fetchInto($row)) {
            $questions[ $row['id'] ] = $row;
        }

        $result = array();
        foreach ($list as $row) {
            $answers = json_decode( $row['answers'] );

            $row['distributor_code'] = 'C41VD';

            foreach ($answers as $id => $answer) {
                switch ($id) {
                    case '156'://diler_code
                        $row['diler_code'] = $this->getAnswer($questions[ 156 ], $answer->question_answer);
                        break;
                    case '157'://shassi
                        $row['shassi'] = $answer->question_answer;
                        break;
                    case '':
                        break;
                }
            }
//if (__dump($list)) exit; 
            foreach ($answers as $id => $answer) {

                $question_code = explode(';', $questions[ $id ]['question_code']);

                $result[] = array(
                    'service_code' => 'SA',
                    'category_code' => $question_code[0],
                    'poll_code' => $row['diler_code'] . $row['created_format'] . substr($row['shassi'], -6),
                    'date' => $row['created_format'],
                    'question_code' => $question_code[1],
                    'distributor_code' => $row['distributor_code'],
                    'diler_code' => $row['diler_code'],
                    'client_code' => $row['distributor_code'] . $row['diler_code'] . substr($row['shassi'], -6),
                    'shassi' => $row['shassi'],
                    'user_code' =>  $row['distributor_code'] . 'IV' . substr($row['accounts_id'], -2),
                    'respondent_code' => $row['distributor_code'] . $row['diler_code'] . $row['created_format'] . $row['number'],
                    'answer_code' => $this->getAnswer($questions[ $id ], $answer->question_answer),
                    'answer_uk' => $answer->question_answer,
                    'answer_en' => ''
                );
            }
        }

        header('Content-Disposition: attachment; filename="report.xls"');
        header('Content-Type: ' . Form::getContentType('report.xls'));

        include_once $this->object . '/excelFalconDCSI.php';
        exit;
    }


    function sendInWindow($id) {

        $data['id'] = $id;
        $data['profile_types_id'] = 10;

        $content = $this->exportInWindow($data, false);

        $Templates = Templates::factory($data);

        echo $Templates->send('k.golovko@express-group.com.ua', null,  null, 'Missed call', $content, 'e-insurance.in.ua', 'info@e-insurance.in.ua');
        echo $Templates->send('acmlostcall@gmail.com', null,  null, 'Missed call', $content, 'e-insurance.in.ua', 'info@e-insurance.in.ua') ;
    }
}

?>