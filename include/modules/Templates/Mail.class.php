<?
/*
 * Title: mail templates class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Users.class.php';
require_once 'Templates.class.php';

class Templates_Mail extends Templates {
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
							'table'				=> 'templates'),
						array(
							'name'				=> 'sections_id',
							'description'		=> 'Section',
					        'type'				=> fldConst,
					        'value'				=> 4,
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
							'table'				=> 'templates',
							'sourceTable'		=> 'template_sections',
							'selectField'		=> 'title',
							'condition'			=> 'id = 4',
							'orderField'		=> 'title'),
						array(
							'name'				=> 'subject',
							'description'		=> 'Subject',
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
							'orderPosition'		=> 1,
							'table'				=> 'templates'),
						array(
							'name'				=> 'text',
							'description'		=> 'Text',
					        'type'				=> fldNote,
					        'height'			=> 300,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'templates'),
						array(
							'name'				=> 'sender',
							'description'		=> 'Sender',
					        'type'				=> fldText,
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
							'table'				=> 'templates'),
						array(
							'name'				=> 'sender_email',
							'description'		=> 'Sender\'s e-mail',
					        'type'				=> fldEmail,
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
							'orderPosition'		=> 2,
							'table'				=> 'templates'),
						array(
							'name'				=> 'email',
							'description'		=> 'Recipient\'s E-mail',
					        'type'				=> fldText,
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
							'table'				=> 'templates'),
						array(
							'name'				=> 'alias',
							'description'		=> 'Alias',
					        'type'				=> fldUnique,
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
							'orderPosition'		=> 4,
							'table'				=> 'templates'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Modified',
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
							'width'				=> 120,
							'orderPosition'		=> 5,
							'table'				=> 'templates')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function Templates_Mail($data) {
		Form::Form($data);

		$this->messages['plural'] = translate('Templates');
		$this->messages['single'] = translate('Template');
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> true);
				break;
		}
	}

	function get($template) {
		global $data, $db, $Authorization;

		$conditions[] = 'sections_id = 4';
		$conditions[] = 'alias = ' . $db->quote($template);

		$sql =	'SELECT * ' . 
				'FROM ' . $this->tables[0] . ' ' .
				'WHERE ' . implode(' AND ', $conditions);

		return $db->getRow($sql);
	}

	function send($email, $data, $template = null, $subject = null, $text = null, $sender = null, $sender_email = null, $sendToSender = false, $files = null) {
		global $Smarty, $Authorization;

		if ($template) {
			$template = $this->get($template);
		}

		if (!$subject)
			$subject		= $template['subject'];
		if (!$text)
			$text			= $template['text'];
		if (!$sender)
			$sender			= $template['sender'];
		if (!$sender_email)
			$sender_email	= $template['sender_email'];

  
		$headers = array (
			'From'			=> '"=?UTF-8?b?' . base64_encode($sender) . '?=" <' . $sender_email . '>',
        	'Return-Path'	=> $sender_email,
        	'Subject'		=> '=?UTF-8?b?' . base64_encode($subject) . '?=');

		$mime = new Mail_mime();

        if (!is_null($data)) {
		    $Smarty->assign('data', $data);
		    $text = $Smarty->fetch('value:' . $text);
        } else {
            $text = $text;
        }

		$mime->setHTMLBody($text);

		if (is_array($files)) {
			foreach ($files as $file) {
				(is_array($file))
					? $mime->addAttachment($file['data'], 'application/octet-stream', $file['name'], false)
					: $mime->addAttachment($_SERVER['DOCUMENT_ROOT'] . $file);
			}
		}

		$body = $mime->get();
		$headers = $mime->headers($headers);

		$mail =& Mail::factory('mail');

		if ($sendToSender) {
//			$mail->send($sender_email, $headers, $body);
		}

        $emails = explode(',', $email);

        if (is_array($emails)) {
            foreach ($emails as $email) {
                $result = $mail->send($email, $headers, $body);
            }
        }

        return $result;
	}

}

?>