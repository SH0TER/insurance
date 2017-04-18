<?
/*
 * Title: policy document class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';
require_once 'ProductTypes.class.php';
require_once 'ProductDocuments.class.php';

ini_set('user_agent', DEFAULT_USER_AGENT);

class PolicyDocuments extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'                => 'id',
                            'type'                => fldIdentity,
                            'display'            =>
                                array(
                                    'show'            => true,
                                    'insert'        => false,
                                    'view'            => true,
                                    'update'        => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_documents'),
                        array(
                            'name'                => 'policies_id',
                            'description'        => 'Поліс',
                            'type'                => fldHidden,
                            'display'            =>
                                array(
                                    'show'            => true,
                                    'insert'        => true,
                                    'view'            => false,
                                    'update'        => false
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                => 'policy_documents'),
                        array(
                            'name'                => 'product_document_types_id',
                            'description'        => 'Тип',
                            'type'                => fldSelect,
                            'delimiter'            => '<br />',
                            'display'            =>
                                array(
                                    'show'            => true,
                                    'insert'        => true,
                                    'view'            => false,
                                    'update'        => true
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 1,
                            'table'                => 'policy_documents',
                            'sourceTable'        => 'product_document_types',
                            'selectField'        => 'title',
                            'orderField'        => 'title'),
                        array(
                            'name'                => 'description',
                            'description'        => 'Опис',
                            'type'                => fldNote,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true,
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 2,
                            'table'                => 'policy_documents'),
                        array(
                            'name'                => 'file',
                            'description'        => 'Файл',
                            'type'                => fldFile,
                            'format'            => '.*\.(jpg|jpeg|gif|tif|png|doc|xls|zip|pdf|txt)$',
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => true,
                                    'view'        => false,
                                    'update'    => true,
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        => 3,
                            'table'                => 'policy_documents'),
						array(
                            'name'                => 'user',
                            'description'        => 'Автор',
                            'type'                => fldText,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false,
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'        => 4,
                            'table'                => 'policy_documents'),	
						array(
                            'name'                => 'ip',
                            'description'        => 'IP',
                            'type'                => fldText,
                            'display'            =>
                                array(
                                    'show'        => true,
                                    'insert'    => false,
                                    'view'        => false,
                                    'update'    => false,
                                ),
                            'verification'        =>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                => 'policy_documents'),	
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
                            'orderPosition'        => 5,
                            'width'                => 120,
                            'table'                => 'policy_documents')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    => 1,
                        'defaultOrderDirection'    => 'asc',
                        'titleField'            => 'id'
                    )
            );

    function PolicyDocuments($data) {
        global $POLICY_DOCUMENT_TYPES;

        Form::Form($data);

        $this->formDescription['fields'][ $this->getFieldPositionByName('product_document_types_id') ]['condition'] = 'sections_id = ' . PRODUCT_DOCUMENT_SECTIONS_SALE . ' AND product_types_id = ' . intval($data['product_types_id']);

        /*switch ($data['product_types_id']) {
            case PRODUCT_TYPES_CARGO_CERTIFICATE:
                $this->formDescription['fields'][ $this->getFieldPositionByName('product_document_types_id') ]['condition'] .= ' AND id <> ' . DOCUMENT_TYPES_POLICY_CARGO_CERTIFICATEE;
                break;
            case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                $this->formDescription['fields'][ $this->getFieldPositionByName('product_document_types_id') ]['condition'] .= ' AND id <> ' . DOCUMENT_TYPES_POLICY_DRIVE_CERTIFICATE;
                break;
        }*/

        $this->messages['plural'] = 'Документи';
        $this->messages['single'] = 'Документ';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_AGENT:
            case ROLES_CLIENT_CONTACT:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => false,
                    'view'      => true,
                    'change'    => false,
                    'delete'    => false,
					'letterAddPaymentKasko'	=>	($data['product_types_id'] == PRODUCT_TYPES_KASKO && $Authorization->data['agencies_id'] == 1469) ? true : false);
                    break;
            case ROLES_MANAGER:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => ($Authorization->data['permissions']['PolicyDocuments']['insert'] || (($data['product_types_id'] == PRODUCT_TYPES_CARGO_CERTIFICATE || $data['product_types_id'] == PRODUCT_TYPES_DRIVE_CERTIFICATE) && $Authorization->data['id'] == 3216)) ? true : false,
                    'update'    => ($data['product_types_id'] == PRODUCT_TYPES_PROPERTY || $Authorization->data['permissions']['PolicyDocuments']['update']) ? true : false,
                    'view'      => true,
					'change'    => ($Authorization->data['permissions']['PolicyDocuments']['regenerate'] || (($data['product_types_id'] == PRODUCT_TYPES_CARGO_CERTIFICATE || $data['product_types_id'] == PRODUCT_TYPES_DRIVE_CERTIFICATE) && $Authorization->data['id'] == 3216)) ? true : false,
                    'delete'    => ($data['product_types_id'] == PRODUCT_TYPES_PROPERTY || $Authorization->data['permissions']['PolicyDocuments']['delete']) ? true : false,
                    'letterAddPaymentKasko'	=> $data['product_types_id'] == PRODUCT_TYPES_KASKO ? true : false);
                break;
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => true,
                    'view'      => true,
                    'change'    => true,
                    'delete'    => true,
					'letterAddPaymentKasko'	=> $data['product_types_id'] == PRODUCT_TYPES_KASKO ? true : false);
                break;
	   case ROLES_MASTER:
		$this->permissions = array(
			'show'	=>	true,
			'view'	=>	true);
        }
    }

	function setConstants(&$data) {
		global $Authorization;
        parent::setConstants($data);
		$this->formDescription['fields'][ $this->getFieldPositionByName('user') ]['display']['insert'] = true;
		$this->formDescription['fields'][ $this->getFieldPositionByName('ip') ]['display']['insert'] = true;
		$data['user'] = $Authorization->data['lastname'].' '.$Authorization->data['firstname'];
		$data['ip'] = $_SERVER['REMOTE_ADDR'];
		
	}	
    function checkPermissions($action, $data, $redirect=false) {
        global $db, $Authorization;

        $result = parent::checkPermissions($action, $data, $redirect);

        switch ($action) {
            case 'view':
                switch ($Authorization->data['roles_id']) {
                    case ROLES_AGENT:

                        $conditions[] = (is_array($data['id']))
                            ? 'a.id = ' . intval($data['id'][0])
                            : 'a.id = ' . intval($data['id']);

						if ($Authorization->data['top_agencies_id'] == 422 && $action=='view') {//астрабанк видит все свои полиса
							$conditions[] = 'financial_institutions_id = 33';
						}
						elseif($Authorization->data['agencies_id']==SELLER_AGENCIES_ID) {
						}
						else
						{
							if ($Authorization->data['id'] == 11409) {
								$Authorization->data['subAgenciesId'][] = AGENCY_SATIS;
								$Authorization->data['subAgenciesId'][] = 556;
								//$agencies_id[] = AGENCY_SATIS;
							}
							if ($Authorization->data['id'] == 13689) {
								$Authorization->data['subAgenciesId'][] = AGENCY_SATIS;
								$Authorization->data['subAgenciesId'][] = 556;
								//$agencies_id[] = 556;
							}
						
							$conditions[] = is_array($Authorization->data['subAgenciesId']) ? 
								'agencies_id IN (' . implode(', ', $Authorization->data['subAgenciesId']).')' :
								' (agencies_id = ' . intval($Authorization->data['agencies_id']).' OR seller_agencies_id='. intval($Authorization->data['agencies_id']).') ';
						}		

                        $sql =  'SELECT a.id ' .
                                'FROM ' . $this->tables[0] . ' AS a ' .
                                'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
								'LEFT JOIN ' . PREFIX . '_policies_go AS b1 ON b.id = b1.policies_id ' .
								'LEFT JOIN ' . PREFIX . '_policies_kasko AS c ON b.id = c.policies_id ' .
                                'WHERE ' . implode(' AND ', $conditions);
                        $id = $db->getOne($sql);

                        if (!$id) {
                            parent::checkPermissions($action, $data, true);
                        }
                }
                break;
        }

        return $result;
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		global $Authorization;
	    if ($Authorization->data['roles_id']==ROLES_AGENT)
		{
			$conditions[]    ='product_document_types_id<>110';
			$conditions[]    ='product_document_types_id<>111';
		}
        $fields[]        = 'policies_id';
        $conditions[]    = 'policies_id = ' . intval($data['policies_id']);
		//передаем тип документа для пермишинов
        $fields[]        = 'product_types_id';

        return parent::show($data, $fields, $conditions, $sql, $this->object . '/show.php', $limit);
    }

    function showForm($data, $action, $actionType=null, $template=null) {
        $data['step'] = 2;

        Policies::header($data);

        parent::showForm($data, $action, $actionType, $template);

        Policies::footer($data, false);
    }

    function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $db, $Log, $Authorization;

        parent::insert($data, false, false, true);

        if ($Log->isPresent()) {
            if ($showForm)
                $this->showForm($data, $GLOBALS['method'], 'insert');
        } else {
            $data['id'] = parent::insert($data, false, false);

            $sql =  'SELECT count(*) ' .
                    'FROM ' . PREFIX . '_policy_documents ' .
                    'WHERE policies_id IN (SELECT policies_id FROM '.PREFIX.'_policy_documents WHERE id = ' . intval($data['id']) . ' AND file <> ' . $db->quote('1') . ')';
            $count = $db->getOne($sql);

            if ($count > 0) {
                $sql =  'UPDATE ' . PREFIX . '_policies SET ' .
                        'fotos = 1 ' .
                        'WHERE id IN (SELECT policies_id FROM '.PREFIX.'_policy_documents WHERE id=' . intval($data['id']) . ')';
                $db->query($sql);
            }

            if ($redirect) {
                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $data['id'];
            }
        }
    }

    function generateTemplates($policies_id, $id=null, $regenerate=false) {
        global $db, $Smarty;
        $conditions[] = 'a.policies_id = ' . intval($policies_id);
        $conditions[] = 'a.file = \'1\'';

        if (intval($id)) {
            $conditions[] = 'a.id = ' . $id;
        }

        if ($regenerate == false) {
            $conditions[] = '(a.template  = \'\' OR a.template IS NULL)';
        }

        $sql =  'SELECT a.id, a.template, a.policies_id, b.product_types_id ' .
                'FROM ' . PREFIX . '_policy_documents a ' .
                'JOIN ' . PREFIX . '_policies b ON a.policies_id=b.id ' .
                'WHERE ' . implode(' AND ', $conditions);
        $list = $db->getAll($sql);
        $data = array();

        foreach($list as $row) {

            $file['id'] = $row['id'];
            if ($row['template']) {
                @unlink($_SERVER['DOCUMENT_ROOT'] .'/files/PolicyDocumentsTemplates/' . $row['template']);
            }
            $Policies	= Policies::factory($data, ProductTypes::get($row['product_types_id']));
            $filename=Form::generateFilename('agreement.html');
			$values		= $Policies->getValues($file);
			$values['filename'] = str_replace ('.html', '',$filename);

			$long_term = intval($values['yearsPaymentsCount'])>0 ? 1 : 0;
            $multiple_cars = (is_array($values['items']) && sizeof($values['items'])>1) ? 1:0;
            $template = ProductDocuments::get($values['product_types_id'], $values['product_document_types_id'], $values['date'], $values['financial_institutions_id'], $values['car_types_id'],$multiple_cars,  $values['products_id'],$values['options_race'],$long_term);
            $Smarty->assign('values', $values);
            //_dump($template);exit;
            $content= $Smarty->fetch($_SERVER['DOCUMENT_ROOT'] .'/files/ProductDocuments/' . $template);
            $handle = fopen($_SERVER['DOCUMENT_ROOT'] .'/files/PolicyDocumentsTemplates/'.$filename, 'wb+');

            if (fwrite($handle, $content) !== FALSE) {
                $sql =  'UPDATE ' . PREFIX . '_policy_documents SET ' .
                        'template = ' . $db->quote($filename) . ' ' .
                        'WHERE id=' . intval($row['id']);
                $db->query($sql);
            }

            fclose($handle);
        }
    }

    function change($data, $redirect = true) {
        global $db, $Log;

        $this->checkPermissions('change', $data);

        if (is_array($data['id'])) {

            foreach ($data['id'] as $id) {
                $this->generateTemplates($data['policies_id'], $id, true);
            }

            $params['title'] = $this->messages['plural'];
            $params['storage'] = $this->tables[0];

            $Log->add('confirm', $this->messages['change']['confirm'], $params, '', true);
        }

        if ($redirect) {
            ($data['redirect'])
                ? header('Location: ' . $data['redirect'])
                : header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        return $data['id'];
    }

    function generate($policies_id, $product_document_types_id) {
        global $db,$Authorization;

        $sql =  'UPDATE ' . $this->tables[0] . ' SET ' .
                'modified = NOW() ' .
                'WHERE policies_id = ' . intval($policies_id) . ' AND product_document_types_id = ' . intval($product_document_types_id) . ' AND file = 1';
        $db->query($sql);

        if (!$db->affectedRows()) {
			if ($product_document_types_id==DOCUMENT_TYPES_POLICY_KASKO_QUESTIONNAIRE) //опросник - 69
			{
				$insurer_person_types_id = intval($db->getOne('SELECT insurer_person_types_id FROM '.PREFIX.'_policies_kasko WHERE policies_id='.intval($policies_id)));
				if ($insurer_person_types_id==1) {//опросник физ лицо
					$insurer_identification_code = $db->getOne('SELECT insurer_identification_code FROM  '.PREFIX.'_policies_kasko WHERE policies_id='.intval($policies_id));
					if (strlen($insurer_identification_code)>5) {//проверить платеж 150тыс
						$sql = '
							select sum(amount) from (
							select sum(c.amount) as amount from insurance_policies a
							join insurance_policies_kasko b on b.policies_id=a.id
							join insurance_policy_payments c on c.policies_id=a.id
							where b.insurer_identification_code='.$db->quote($insurer_identification_code).' and a.id<>'.intval($policies_id).'
							union all
							select sum(c.amount) as amount from insurance_policies a
							join insurance_policies_go b on b.policies_id=a.id
							join insurance_policy_payments c on c.policies_id=a.id
							where b.insurer_identification_code='.$db->quote($insurer_identification_code).' and a.id<>'.intval($policies_id).'
							union all
							select sum(c.amount) as amount from insurance_policies a
							join insurance_policies_ns b on b.policies_id=a.id
							join insurance_policy_payments c on c.policies_id=a.id
							where b.insurer_identification_code='.$db->quote($insurer_identification_code).' and a.id<>'.intval($policies_id).'
							union all 
							select amount as amount from insurance_policies a where a.id='.intval($policies_id).'
							) t
						';
						$all_amount = doubleval($db->getOne($sql));
						if ($all_amount<150000) return;
					}
					
				}
			}
			
			if ($product_document_types_id==166) //Лист Дельта банк,Кредо
			{
				$financial_institutions_id = intval($db->getOne('SELECT financial_institutions_id FROM '.PREFIX.'_policies_kasko WHERE policies_id='.intval($policies_id)));
				$parent_id = intval($db->getOne('SELECT parent_id FROM '.PREFIX.'_policies WHERE id='.intval($policies_id)));
				if (($financial_institutions_id!=59 && $financial_institutions_id!=33 && $financial_institutions_id!=55 && $financial_institutions_id!=25) || $parent_id==0) return; //не дельта или астра
			}
			
			if ($product_document_types_id==82) //Заява добровільного страхування від нещасних випадків
			{
				$financial_institutions_id = intval($db->getOne('SELECT financial_institutions_id FROM '.PREFIX.'_policies_ns WHERE policies_id='.intval($policies_id)));
				$products_id = intval($db->getOne('SELECT products_id FROM '.PREFIX.'_policies_ns WHERE policies_id='.intval($policies_id)));
				if ($financial_institutions_id==28 /*|| $financial_institutions_id==34*/ ||   $financial_institutions_id==25 || $products_id==261) return; //для ВТБ ПРАВЕКС ИДЕЯ заявы нету
			}
			
            $sql =  'INSERT INTO ' . $this->tables[0] . ' SET ' .
                    'policies_id = ' . intval($policies_id) . ', ' .
                    'product_document_types_id = ' . intval($product_document_types_id) . ', ' .
                    'file = 1, ' .
					'user = '.$db->quote($Authorization->data['lastname'].' '.$Authorization->data['firstname']).', ' .
					'ip = '.$db->quote($_SERVER['REMOTE_ADDR']).', ' .
                    'modified = NOW()';

            $db->query($sql);
        }
    }

    function remove($policies_id, $product_document_types_id=null) {
        global $db;

        $conditions[] = 'policies_id = ' . intval($policies_id);

        if (intval($product_document_types_id)) {
            $conditions[] = 'product_document_types_id = ' . intval($product_document_types_id);
        }

        $sql =  'DELETE FROM ' . $this->tables[0] . ' ' .
                'WHERE ' . implode(' AND ', $conditions);
        $db->query($sql);
    }

    function downloadFileInWindow($data) {
        global $db, $Smarty, $Authorization;

        $file = unserialize($data['file']);

        $this->checkPermissions('view', $file);

        $sql =  'SELECT product_types_id, product_document_types_id, file, b.id, a.template, IF(TO_DAYS(a.modified) > TO_DAYS(\'2010-06-06\') || ISNULL(a.template), 1, 0) AS html2pdf ' .
                'FROM ' . $this->tables[0] . ' AS a ' .
                'JOIN ' . PREFIX . '_policies AS b ON a.policies_id = b.id ' .
                'WHERE a.id = ' . intval($file['id']);
        $row = $db->getRow($sql);

        if ($row['file'] != 1 && is_file($_SERVER['DOCUMENT_ROOT'] . '/files/' . $this->object . '/' . $row['file'])) {
            $result = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/files/' . $this->object . '/' . $row['file']);
	    
            header('Content-Disposition: attachment; filename="' . $row['file'] . '"');
            header('Content-Type: ' . $this->getContentType($row['file']));
			header('Content-Length: ' . strlen($result));

            echo $result;
            exit;
        } else {
            if (!$row['template']) {

                $Policies   = Policies::factory($data, ProductTypes::get($row['product_types_id']));
                $values     = $Policies->getValues($file);
//_dump($values['yearsPayments']);exit;
                $multiple_cars = (is_array($values['items']) && sizeof($values['items'])>1) ? 1:0;

				$long_term = intval($values['yearsPaymentsCount'])>0 ? 1 : 0;

                $template = ProductDocuments::get($values['product_types_id'], $values['product_document_types_id'], $values['date'], $values['financial_institutions_id'], $values['car_types_id'], $multiple_cars,$values['products_id'],$values['options_race'],$long_term);
//_dump($template);exit;
                if ($data['template']) {
                    echo $template;
                    exit;
                }
//_dump($values['insurer_address']);exit;
                $Smarty->assign('values', $values);

                $file['name']       = $values['policies_id'] . '_' . $values['product_document_types_id'];
                $file['content']    = $Smarty->fetch('../files/ProductDocuments/' . $template);

            } else {
                $file['name']       = str_replace ('.html', '', $row['template']);
                $file['content']    = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/files/PolicyDocumentsTemplates/' . $row['template']);
            }
			//$file['content']    = file_get_contents('./files/' . '249840_2.html');

			$params = array();
            switch ($row['product_document_types_id']) {
                case DOCUMENT_TYPES_POLICY_GO_POLICY1:
                case DOCUMENT_TYPES_POLICY_GO_POLICY2:
                    $params['--margin-left']	= ($Authorization->data['policyCorrectionX']) ? $Authorization->data['policyCorrectionX'] : 0;
                    $params['--margin-right']	= 0;
                    $params['--margin-top']		= ($Authorization->data['policyCorrectionY']) ? $Authorization->data['policyCorrectionY'] : 0;
                    $params['--margin-bottom']	= 0;
                    break;
                case DOCUMENT_TYPES_POLICY_CARGO_CERTIFICATEE:
                    $params['--orientation']	= 'Landscape';
                    break;
            }
			if ($Authorization->data['login']=='o.nikonova' )
			{
				echo $file['content'];exit;
			}    
			if ($Authorization->data['roles_id']==ROLES_ADMINISTRATOR && $data['download']==1)
			{
				header('Content-Disposition: attachment; filename="' . $file['name'] . '.html"');
				header('Content-Type: ' . Form::getContentType($file['name'] . '.html'));
				header('Accept-Ranges: bytes');
				header('Expires: 0');
				header('Cache-Control: private');
 				echo $file['content'];exit;
			}

			if ($data['print'] == 1) {
				$file['content'] = substr($file['content'], 0, strpos($file['content'], '<div style="page-break-after: always"></div>')) . '</body></html>';
			}
			
			if ($row['product_document_types_id'] == 171) {
				//$params['--page-size'] = 'A5';
				//$params['--zoom'] = '0.5';
			}
			
			html2pdf($file, $params);
        }
    }

    function synchronize($policies_id, $documents) {
        global $db;

        $url = 'https://express-credit.in.ua/files/InsuranceQuestionnaireDocuments/';

        if (is_array($documents)) {

            foreach ($documents as $row) {

                $conditions = array(
                    'policies_id =' . intval($policies_id),
                    'product_document_types_id = ' . DOCUMENT_TYPES_POLICY_PACKAGE,
                    'file = ' . $db->quote($row['file']));

                $sql =  'SELECT id ' .
                        'FROM ' . PREFIX . '_policy_documents ' .
                        'WHERE ' . implode(' AND ', $conditions);
                $exists = $db->getOne($sql);

                if (!$exists) {

                    $contents = file_get_contents($url . $row['file']);

                    if ($contents) {

                        if ($handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/files' . $Authorization->data['folder'] . '/PolicyDocuments/' . $row['file'], 'wb')) {
                            fwrite($handle, $contents);
                            fclose($handle);
                        }

                        $sql =  'INSERT INTO ' . PREFIX . '_policy_documents SET ' .
                                'policies_id=' . intval($policies_id) . ', ' .
                                'product_document_types_id = ' . DOCUMENT_TYPES_POLICY_PACKAGE . ', ' .
                                'number = ' . $db->quote($row['number']) . ', ' .
                                'description = ' . $db->quote($row['description']) . ', ' .
                                'file = ' . $db->quote($row['file']) . ', ' .
                                'modified = ' . $db->quote($row['modified']);
                        $db->query($sql);
                    }
                }
            }
        }
    }

	function letterAddPaymentKaskoInWindow($data) {
		global $db, $Authorization, $Smarty, $MONTHES_DATE;

		$sql = 'SELECT CONCAT_WS(\' \', policies_kasko.insurer_lastname, policies_kasko.insurer_firstname, policies_kasko.insurer_patronymicname) as insurer, ' .
					'date_format(getPolicyDate(policies.number, 1), \'%d.%m.%Y\') as policies_date, policies.number as policies_number, policies.parent_id, policies.agreement_types_id, ' .
					'date_format(NOW(), \'%d.%m.%Y\') as nowdate, items.rate_kasko as rate_kasko, items.car_price as car_price, items.market_price_expert as market_price, ' .
					'date_format(NOW(), \'%d\') as nowday, date_format(NOW(), \'%m\') - 1 as nowmonth, date_format(NOW(), \'%Y\') as nowyear, items.expert_date, ' .
                    'accounts.lastname as agents_lastname, accounts.firstname as agents_firstname, accounts.patronymicname as agents_patronymicname ' .
			   'FROM ' . PREFIX . '_policies as policies ' .
			   'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON policies.id = policies_kasko.policies_id ' .
			   'JOIN ' . PREFIX . '_policies_kasko_items as items ON policies.id = items.policies_id ' .
               'LEFT JOIN ' . PREFIX . '_clients as clients ON policies.clients_id = clients.id ' .
               'LEFT JOIN ' . PREFIX . '_accounts as accounts ON clients.agents_id = accounts.id ' .
			   'WHERE policies.id = ' . intval($data['policies_id']);
		$values = $db->getRow($sql);
		
		$r = $db->getRow('SELECT a.*,b.parent_id,b.agreement_types_id,IF(YEAR(a.date)>YEAR(b.begin_datetime),1,0) as next_year FROM insurance_policies_kasko_item_years_payments a JOIN  insurance_policies b on b.id=a.policies_id WHERE a.policies_id='. intval($data['policies_id']).' AND a.date<NOW() ORDER BY a.date DESC LIMIT 1'); 
		$fifty_fifty = intval($db->getOne('SELECT options_fifty_fifty FROM insurance_policies_kasko WHERE policies_id= '.intval($data['policies_id'])));
        $options_agregate_no = intval($db->getOne('SELECT options_agregate_no FROM insurance_policies_kasko WHERE policies_id= '.intval($data['policies_id'])));
		$end_period = $db->getOne('SELECT date FROM  insurance_policies_kasko_item_years_payments WHERE date>NOW() AND policies_id	='. intval($data['policies_id']).' ORDER BY date LIMIT 1 ');
		if (!$end_period) $end_period = $db->getOne('SELECT end_datetime FROM  insurance_policies WHERE  id	='. intval($data['policies_id']).' ');
		$end_period = $db->quote($end_period);
		if ($r['date'])
			$start_period = $r['date'];
		else	
			$start_period = $db->getOne('SELECT begin_datetime FROM  insurance_policies WHERE  id	='. intval($data['policies_id']).' ');
		$start_period = $db->quote($start_period);
		$period_days =	$db->getOne('SELECT DATEDIFF('.$end_period.' , '.$start_period.') '); //кол дней в периоде страхования
		
		if (intval($r['next_year'])==0)  {//однолетний договор в insurance_policies_kasko_item_years_payments нет записей или только 1-й год идет
			$sql =	'SELECT DATEDIFF(NOW(), begin_datetime)  AS useddays FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['policies_id']);
			$useddays = intval($db->getOne($sql));
			//_dump($useddays);_dump(	$period_days );
			$restdays = $period_days - $useddays;
			//выплаты по урегулированию дела
			$begin_date = $db->quote($db->getOne('SELECT begin_datetime FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['policies_id'])));
			$end_date = 'NOW()';

            if ($options_agregate_no) {
                $payedAmount = 0;
            } else {
			    $sql = 'SELECT SUM(c.amount) FROM insurance_accidents b   JOIN insurance_accident_payments_calendar c ON b.id = c.accidents_id WHERE c.payment_statuses_id>1 AND b.policies_id = ' . intval($data['policies_id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND ' . $end_date . ' AND c.payment_types_id IN (5,6)   ';
			    $payedAmount = doubleval($db->getOne($sql));
            }
			
			$values['item_price_other'] = $values['car_price'] - $payedAmount;
//_dump($sql);
			if (!$r) $r = $db->getRow('SELECT *,id as policies_id FROM insurance_policies WHERE id='. intval($data['policies_id']));
			if ($r['agreement_types_id']==3) //делаем доп угоду на востановление из другой доп угоды значит тариф взять из парента
			{
				$new_rate_kasko = doubleval($db->getOne('SELECT rate_kasko FROM  insurance_policies_kasko_items WHERE policies_id='.intval($r['parent_id'])));
			}
			else { //взять текущий рабочий тариф из того договора из которого делаем допку
				$new_rate_kasko = doubleval($db->getOne('SELECT rate_kasko FROM  insurance_policies_kasko_items WHERE policies_id='.intval($r['policies_id'])));
			}	
			$old_car_price = doubleval($db->getOne('SELECT car_price FROM  insurance_policies_kasko_items WHERE policies_id='.intval($r['policies_id'])));
			if ($fifty_fifty && $payedAmount>0) $new_rate_kasko *=2; //если были выплаты и 50/50 то тариф увеличиваем
			$restoreAmount1 = round($new_rate_kasko *doubleval($payedAmount)/100*($period_days - $useddays)/365,2);//сумма к востановлению за выплаты по ДТП
			$restoreAmount2 = 0;//сумма если  увеличили стоимость авто от начальной
			if ((doubleval($values['market_price']) - $values['car_price'])>2) //цена выросла
			{
				$payedAmount = doubleval($values['market_price']) - $values['car_price']; //на сколько выросла цена
				$restoreAmount2 = round($new_rate_kasko *doubleval($payedAmount)/100*($period_days- $useddays)/365,2);//сумма к востановлению за увеличение стоимости авто
			}
		}
		else { //начался следущий год по договору
			$new_rate_kasko = $r['rate_kasko'];
			$old_car_price = $r['item_price'];
			
			$sql =	'SELECT DATEDIFF(NOW(), '.$db->quote($r['date']).')  AS useddays FROM ' . PREFIX . '_policies WHERE id = ' . intval($data['policies_id']);
			
			$useddays = intval($db->getOne($sql));
			$restdays = $period_days - $useddays;
			//выплаты по урегулированию дела
			$begin_date = $db->quote($r['date']);
			$end_date = 'NOW()';

            if ($options_agregate_no) {
                $payedAmount = 0;
            } else {
			    $sql = 'SELECT SUM(c.amount) FROM  insurance_accidents b JOIN insurance_accident_payments_calendar c ON b.id = c.accidents_id WHERE c.payment_statuses_id>1 AND b.policies_id = ' . intval($data['policies_id']).' AND b.datetime BETWEEN ' . $begin_date . ' AND ' . $end_date . ' AND c.payment_types_id IN (5,6)  ';
			    $payedAmount = doubleval($db->getOne($sql));
            }

			$values['item_price_other'] = $old_car_price - $payedAmount;
			
            if ($fifty_fifty && $payedAmount>0) $new_rate_kasko*=2;
			
			$restoreAmount1 = round($new_rate_kasko*doubleval($payedAmount)/100*($period_days - $useddays)/365,2);
			
			$restoreAmount2 = 0;//сумма если  увеличили стоимость авто от начальной
			if ((doubleval($values['market_price']) - $old_car_price)>2) //цена выросла
			{
				$payedAmount = doubleval($values['market_price']) - $old_car_price; //на сколько выросла цена
				$restoreAmount2 = round($new_rate_kasko *doubleval($payedAmount)/100*($period_days - $useddays)/365,2);//сумма к востановлению за увеличение стоимости авто
			}
		}
		$new_rate_kasko  = round(($restoreAmount1+$restoreAmount2)/$values['market_price']*100,3);
		$new_amount_kasko = round($new_rate_kasko * $values['market_price']/100,2);
		
		$values['rate_kasko'] = $new_rate_kasko;
		$values['diff_amount'] = $new_amount_kasko;
		
		$values['item_price_other'] = roundNumber($values['car_price'] - $payedAmount, 2);
		
		if ($values['market_price'] == 0) {
			$values['market_price'] = '<b>Не визначено</b>';
			$values['diff_amount'] = '<b>Не визначено</b>';
		}

		$Smarty->assign('values', $values);
		$Smarty->assign('monthes', $MONTHES_DATE);
		$Smarty->assign('auth', $Authorization->data);
		
		$file['name']       = $values['policies_number'] . '_letter';
		$file['content']    = $Smarty->fetch('../files/ProductDocuments/letterAddPaymentKasko.tpl');

		//echo($file['content']);exit;
		html2pdf($file, $params);
	}
	
	
	
	function getDocumentContentInWindow($data) {
		global $db,$Authorization;
		
		if ($Authorization->data['permissions']['Policies_KASKO']['superupdate'] || $Authorization->data['roles_id']==ROLES_ADMINISTRATOR) {
			$template = $db->getOne('SELECT template FROM insurance_policy_documents WHERE id='.intval($data['id']));
			$file = './files/PolicyDocumentsTemplates/'.$template;
			if (file_exists ( $file)) {
				echo file_get_contents($file);
			}
			else echo 'Error reading file';
		}
		exit;		
	}
	
	function setDocumentContentInWindow($data) {
		global $db,$Authorization;
		
		if ($Authorization->data['permissions']['Policies_KASKO']['superupdate'] || $Authorization->data['roles_id']==ROLES_ADMINISTRATOR) {
			$template = $db->getOne('SELECT template FROM insurance_policy_documents WHERE id='.intval($data['id']));
			$file = './files/PolicyDocumentsTemplates/'.$template;
			if (file_exists ( $file)) {
				//write
				file_put_contents ( $file,$data['content']);
				echo 'Готово';
			}
			else echo 'Файл не существует';
		}
		exit;		
	}
}
?>