<?
/*
 * Title: news class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */
require_once 'Editor.class.php';	
require_once 'Form.class.php';

class News extends Form {

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
							'table'				=> 'news'),
						array(
							'name'				=> 'date',
							'description'		=> 'Дата',
					        'type'				=> fldDate,
							'input'				=> true,
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
							'width'				=> 100,
							'orderPosition'		=> 1,
							'table'				=> 'news'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
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
							'table'				=> 'news'),
						array(
							'name'				=> 'days',
							'description'		=> 'Днів',
					        'type'				=> fldInteger,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'news'),							
						array(
							'name'				=> 'text',
							'description'		=> 'Текст',
					        'type'				=> fldHTML,
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
							'orderPosition'		=> 3,
							'table'				=> 'news'),
						array(
							'name'				=> 'file1',
							'description'		=> 'Файл',
					        'type'				=> fldFile,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'news'),
						array(
							'name'				=> 'file2',
							'description'		=> 'Файл',
					        'type'				=> fldFile,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'news'),
						array(
							'name'				=> 'roles_id',
							'description'		=> 'Читачі',
					        'type'				=> fldMultipleSelect,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'news_role_assignments',
							'sourceTable'		=> 'roles',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						/*array(
							'name'				=> 'car_services_id',
							'description'		=> 'СТО',
					        'type'				=> fldMultipleSelect,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'news_car_service_assignments',
							'sourceTable'		=> 'car_services',
							'selectField'		=> 'CONCAT(code, \' \', title)',
							'orderField'		=> 'CAST(code AS UNSIGNED)'),*/
						array(
							'name'				=> 'agencies_id',
							'description'		=> 'Агенції',
					        'type'				=> fldMultipleSelect,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'news_agency_assignments',
							'sourceTable'		=> 'agencies',
							'selectField'		=> 'CONCAT(code, \' \', title)',
							'orderField'		=> 'CAST(code AS UNSIGNED)'),
						array(
							'name'				=> 'clients_id',
							'description'		=> 'Клієнти',
					        'type'				=> fldMultipleSelect,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'news_client_assignments',
							'sourceTable'		=> 'clients',
							'selectField'		=> 'company',
							'orderField'		=> 'company'),
						array(
							'name'				=> 'publish',
							'description'		=> 'Показувати',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true,
									'change'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 3,
                            'width'             => 100,
							'table'				=> 'news')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 3,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'title'
					)
			);

	function News($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Новини';
		$this->messages['single'] = 'Новина';
		
		$this->messages['send'] = array(
			'partConfirm'	=> 'Повiдомленя були вiдправленi до %s отримувачiв. %s залишилося.',
			'confirm'		=> 'Розсилка була здiйснена.',
			'error'			=> 'Розсилка не була здiйснена. Виникла помилка.');
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'   	=> true,
					'view'		=> true,
					'change'	=> true,
					'send'		=> true,	
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
			case ROLES_AGENT:
			case ROLES_MASTER:
				$this->permissions = array(
					'show'		=> true,
					'view'		=> true);
				break;
		}
	}

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_MASTER:
				$conditions[] = 'id IN (SELECT news_id FROM ' . PREFIX . '_news_car_service_assignments WHERE car_services_id = ' . intval($Authorization->data['car_services_id']) . ')';
				break;
			case ROLES_AGENT:
				$conditions[] = 'id IN (SELECT news_id FROM ' . PREFIX . '_news_agency_assignments WHERE agencies_id = ' . intval($Authorization->data['agencies_id']) . ')';
				break;
			case ROLES_CLIENT_CONTACT:
				$conditions[] = 'id IN (SELECT news_id FROM ' . PREFIX . '_news_client_assignments WHERE clients_id = ' . intval($Authorization->data['clients_id']) . ')';
				break;
		}

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}

	function chooseRecipients($data) {
        $this->checkPermissions('send', $data);

		if (is_array($data['id'])) $data['id'] = $data['id'][0];
		include_once $this->object . '/chooseRecipients.php';
	}
	
	function send($data) {
		global $db;

        $this->checkPermissions('send', $data);

		$sql = 'DELETE FROM ' . PREFIX . '_news_recipients WHERE news_id = ' . intval($data['news_id']);
		$db->query($sql);

		if ($data['types_id']==2) {//not test sending
			$sql = 'SELECT DISTINCT roles_id FROM ' . PREFIX . '_news_role_assignments WHERE news_id=' . intval($data['news_id']);
			$res = $db->query($sql);

			if ($res->numRows()) {
				while ($res->fetchInto($row)) {
					switch ($row['roles_id']) {
						case ROLES_ADMINISTRATOR:
						case ROLES_MANAGER:		
						case ROLES_ASSISTANCE:
							$sql = 'INSERT INTO ' . PREFIX . '_news_recipients SELECT DISTINCT ' . intval($data['news_id']) . ', email, 0, NOW(), NULL FROM ' . PREFIX . '_accounts WHERE roles_id =' . $row['roles_id'] . ' AND active = 1';
							$db->query($sql);
							break;
						case ROLES_AGENT:
							$sql =	'INSERT INTO '.PREFIX.'_news_recipients SELECT DISTINCT '.intval($data['news_id']).', a.email, 0,NOW(), NULL FROM '.PREFIX.'_accounts AS a '.
									'JOIN '.PREFIX.'_agents AS b ON a.id = b.accounts_id '.
									'JOIN '.PREFIX.'_news_agency_assignments AS c ON b.agencies_id = c.agencies_id AND c.news_id = ' . intval($data['news_id']) . ' ' .
									'WHERE a.active=1';
							$db->query($sql);
							break;
						case ROLES_MASTER:
							$sql =	'INSERT INTO ' . PREFIX . '_news_recipients SELECT DISTINCT ' . intval($data['news_id']) . ', a.email, 0, NOW(), NULL FROM ' . PREFIX . '_accounts AS a ' .
									'JOIN '.PREFIX.'_masters AS b ON b.accounts_id = a.id ' .
									'JOIN '.PREFIX.'_news_car_service_assignments AS c ON c.car_services_id = b.car_services_id AND c.news_id=' . intval($data['news_id']) . ' ' .
									'WHERE a.active=1 AND c.news_id =' . intval($data['news_id']);
							$db->query($sql);
							break;	
						case ROLES_CLIENT_CONTACT:
							$sql='INSERT INTO ' . PREFIX . '_news_recipients SELECT DISTINCT ' . intval($data['news_id']) . ', a.email, 0, NOW(), NULL FROM '.PREFIX.'_clients AS a ' .
							     'JOIN '.PREFIX.'_news_client_assignments AS c ON c.clients_id = a.id AND c.news_id='.intval($data['news_id']) . ' ' .
							     'WHERE LENGTH(a.email)>1 AND c.news_id = ' . intval($data['news_id']);
							$db->query($sql);
							break;			
					}
				}
			}	
		}
		else {//test
			$sql =	'INSERT INTO ' . PREFIX . '_news_recipients SET ' .
					'news_id =' . intval($data['news_id']) . ', ' .
					'email = ' . $db->quote('vinogradov_s@voliacable.com') . ', ' .
					'active =0, ' .
					'created =NOW()';
			$db->query($sql);
		}

		include_once $this->object . '/send.php';
	}

	function sendInWindow($data) {
		global $db, $Log, $Templates;

        $this->checkPermissions('send', $data);

		$sql =	'SELECT * ' .
				'FROM ' . $this->tables[0] . ' ' .
				'WHERE id = ' . intval($data['news_id']);
		$news = $db->getRow($sql);

		$conditions[] = 'b.news_id = ' . intval($data['news_id']);

		$sql =	'SELECT count(*) ' . 
				'FROM ' . PREFIX . '_news_recipients as b ' . 
				'WHERE ' .implode(' AND ', $conditions);
		$total = $db->getOne($sql);

		$conditions[] = 'b.active = 0';

		$recipients_id=$db->getAll('SELECT b.* ' . 
				'FROM ' . PREFIX . '_news_recipients as b ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' );
		
		$sql =	'SELECT b.* ' . 
				'FROM ' . PREFIX . '_news_recipients as b ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'LIMIT ' . intval(NEWSLETTER_BLAST_SIZE);
		$res = $db->query($sql);

		$isSend = true;
		$blastSize = $res->numRows();

		if ($res->numRows()) {
			while ($res->fetchInto($row)) {
			$files=null;
			if ($news['file1'] || $news['file2'])
			{
				if ($news['file1']) $files[] = '/files/News/' . $news['file1'];
				if ($news['file2']) $files[] = '/files/News/' . $news['file2'];		
			}
				$Templates->send($row['email'], $data, null, $news['title'], $news['text'], 'noreplay@express-credit.in.ua','noreplay@e-insurance.in.ua',false,$files);
				$sql =	'UPDATE ' . PREFIX . '_news_recipients SET ' .
						'active = 1, ' . 
						'sent = NOW() ' .
						'WHERE news_id = ' . intval($data['news_id']) . ' AND email = ' . $db->quote($row['email']);
				$db->query($sql);
			}

			$isSend = false;
		}

		($isSend)
			? $Log->add('confirm', $this->messages['send']['confirm'], array($total))
			: $Log->add('confirm', $this->messages['send']['partConfirm'], array($blastSize,  sizeOf($recipients_id) - $blastSize));

		include_once $this->object . '/sendInWindow.php';
		exit;
	}

	function modifier_truncate($string, $length = 80, $etc = '...', $break_words = false, $middle = false) {

	    if ($length == 0) return;
	
	    if (strlen($string) > $length) {
	    	
	        $length -= strlen($etc);

	        if (!$break_words && !$middle) {
	            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));
	        }

			return (!$middle)
				? substr($string, 0, $length) . $etc
				: substr($string, 0, $length/2) . $etc . substr($string, -$length / 2);
	    } else {
	        return $string;
	    }
	}

	function getRoll($data) {
		global $db, $Authorization;

		if ($_SESSION['auth']['checknews'] == 1) return;

		$_SESSION['auth']['checknews'] = 1;

		$conditions[] = 'publish = 1';
		$conditions[] = 'DATE_SUB(date,INTERVAL -days DAY)>=CURDATE()';

		$modalwindow='';
		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
			case ROLES_MANAGER:
			case ROLES_ASSISTANCE:
				$sql =	'SELECT a.*, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format ' . 
						'FROM ' . PREFIX . '_news a ' .
						'JOIN ' . PREFIX . '_news_role_assignments b ON a.id=b.news_id and b.roles_id=' . intval($Authorization->data['roles_id']) . ' ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY a.date DESC, a.id DESC';
				break;
			case ROLES_MASTER:
				$sql =	'SELECT a.*, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format ' . 
						'FROM ' . PREFIX . '_news a ' .
						'JOIN ' . PREFIX . '_news_role_assignments b ON a.id=b.news_id and b.roles_id=' . intval($Authorization->data['roles_id']) . ' ' .
						'JOIN ' . PREFIX . '_news_car_service_assignments c ON a.id=c.news_id and c.car_services_id=' . intval($Authorization->data['car_services_id']) . ' ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY a.date DESC, a.id DESC';
				break;
			case ROLES_AGENT:
				$sql =	'SELECT a.*, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format ' . 
						'FROM ' . PREFIX . '_news a ' .
						'JOIN ' . PREFIX . '_news_role_assignments b ON a.id=b.news_id and b.roles_id=' . intval($Authorization->data['roles_id']) . ' ' .
						'JOIN ' . PREFIX . '_news_agency_assignments c ON a.id=c.news_id and c.agencies_id=' . intval($Authorization->data['agencies_id']) . ' ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY a.date DESC, a.id DESC';
                 break;
			case ROLES_CLIENT_CONTACT:
				$sql =	'SELECT a.*, date_format(a.date, ' . $db->quote(DATE_FORMAT) . ') as date_format ' .
						'FROM ' . PREFIX . '_news a ' .
						'JOIN ' . PREFIX . '_news_role_assignments b ON a.id=b.news_id and b.roles_id=' . intval($Authorization->data['roles_id']) . ' ' .
						'JOIN ' . PREFIX . '_news_client_assignments c ON a.id=c.news_id and c.clients_id=' . intval($Authorization->data['clients_id']) . ' ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY a.date DESC, a.id DESC';
				break;
		}
		
		$list = $db->getAll($sql, 600);

		if (is_array($list) && sizeOf($list)) {

			$result = '<div id="hiddenModalContent" style="display:none">';

			foreach ($list as $row) {
				$result .= '<div class="title"><a href="?do=News|view&id=' . $row['id'] . '">' . $row['title'] . '</a></div>';
				$result .= '<div class="date">[' . $row['date_format'] . ']</div>';
				$result .= '<div class="text">' . News::modifier_truncate(str_replace('&nbsp;', ' ', strip_tags($row['text'])), 450, '') . '</div>';
				$result .= '<div class="details"><a href="?do=News|view&id=' . $row['id'] . '">докладніше&gt;&gt;</a></div><hr>';
			}

			$result .= '</div>';
			$result .= '<script type="text/javascript">
            <!--
			$(document).ready(function () {
            tb_show(\'<strong>Новини:</strong>\', "#TB_inline?height=300&width=500&inlineId=hiddenModalContent'. $modalwindow .'", false)
			});
            //-->
            </script>';
		}

		return $result;
	}

    function delete($data, $redirect=true, $generateMessage=true, $folder=null) {

        $unsetFields = array(
                'agencies_id',
                'roles_id',
                'clients_id');
        if (is_array($unsetFields)) {
            foreach($unsetFields as $field) {
                unset($this->formDescription['fields'][ $this->getFieldPositionByName($field) ]);
            }
        }
        parent::delete($data, $redirect, $generateMessage, $folder);

    }
}

?>