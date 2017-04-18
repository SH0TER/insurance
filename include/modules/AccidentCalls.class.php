<?php

class AccidentCalls extends Form{

    var $product_types_id;

     var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'                  => 'id',
                            'type'                  => fldIdentity,
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
                            'table'                 => 'accident_calls'),
                        array(
                            'name'                  =>  'product_types_id',
                            'type'                  =>  fldInteger,
                            'display'               =>
                                    array(
                                        'show'      =>  false,
                                        'insert'    =>  true,
                                        'view'      =>  false,
                                        'update'    =>  false
                                    ),
                            'verification'          =>
                                    array(
                                        'canBeEmpty'=>  false
                                    ),
                            'table'                 =>  'accident_calls'),
                        array(
                            'name'                  => 'coordinator',
                            'description'           => 'Координатор',
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
                                    'canBeEmpty'    => true
                                ),
							'orderPosition'         => 1,
                            'table'                 => 'accident_calls'),                     
                         array(
                            'name'                  => 'date',
                            'description'           => 'Дата повідомлення',
                            'type'                  => fldDateTime,
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
							'orderPosition'         => 6,
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'datetime',
                            'description'           => 'Дата та час настання події',
                            'type'                  => fldDateTime,
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
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'address',
                            'description'           => 'Адресса пригоди',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'insurer',
                            'description'           => 'Страхувальник',
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
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 2,
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'insurer_phones',
                            'description'           => 'Номер телефону страхувальника',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'driver',
                            'description'           => 'Водій',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'driver_phones',
                            'description'           => 'Телефон водія',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'model',
                            'description'           => 'Автомобіль',
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
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 4,
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'sign',
                            'description'           => 'Державний номер',
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
                                    'canBeEmpty'    => true
                                ),
							'orderPosition'         => 3,
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'participants_count',
                            'description'           => 'К-сть учасників пригоди',
                            'type'                  => fldInteger,
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
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'description',
                            'description'           => 'Опис пригоди',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'application_risks',
                            'description'           => 'Ризик',
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
                                    'canBeEmpty'    => true
                                ),
                            'orderPosition'         => 5,
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'damage_description',
                            'description'           => 'Характер пошкодження',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'mvs_region',
                            'description'           => 'Регіон ДАІ',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'accident_calls'),
                         array(
                            'name'                  => 'location',
                            'description'           => 'Місце знаходження ТЗ',
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
                                    'canBeEmpty'    => true
                                ),
                            'table'                 => 'accident_calls'),
                        array(
                            'name'                  => 'additional_information',
                            'description'           => 'Додаткова інформація',
                            'type'                  => fldNote,
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
                            'table'                 => 'accident_calls'),    
                        ),
                        
                 'common'    =>
                    array(
                        'defaultOrderPosition'      => 4,
                        'defaultOrderDirection'     => 'desc',
                        'titleField'                => 'driver'
                    )
                );

     function AccidentCalls($data) {
        Form::Form($data);

        $this->object = 'AccidentCalls';
        $this->objectTitle = 'AccidentCalls';
        $this->product_types_id = $data['product_types_id'];

        $this->messages['plural'] = 'Дзвінки';
        $this->messages['single'] = 'Дзвінок';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      		=> true,
                    'insert'    		=> false,
                    'update'    		=> true,
                    'view'      		=> true,
                    'delete'    		=> true,
                    'import'            => true,
                    'export'            => true);
                break;
            case ROLES_MANAGER:
                $this->permissions = $Authorization->data['permissions'][ get_class($this) ];
        }
    }

    function getDecodeValue($message, $encoding) {
		switch($encoding) {
			case 0:
			case 1:
//				$message = imap_8bit($message);
				$message = imap_base64($message);
				break;
			case 2:
				$message = imap_binary($message);
				break;
			case 3:
			case 5:
				$message = imap_base64($message);
				break;
			case 4:
				$message = imap_qprint($message);
				break;
		}

		return $message;
	}

	function getAttachment($host,$login,$password,$savedirpath,$date,$delete_emails=false) {
		$nbattach = 0;

		// make sure save path has trailing slash (/)
		$savedirpath = str_replace('\\', '/', $savedirpath);
		if (substr($savedirpath, strlen($savedirpath) - 1) != '/') {
			$savedirpath .= '/';
		}

		$mbox = imap_open($host, $login, $password) or die("can't connect: " . imap_last_error());

		$message = array();
		$message['attachment']['type'][0] = 'text';
		$message['attachment']['type'][1] = 'multipart';
		$message['attachment']['type'][2] = 'message';
		$message['attachment']['type'][3] = 'application';
		$message['attachment']['type'][4] = 'audio';
		$message['attachment']['type'][5] = 'image';
		$message['attachment']['type'][6] = 'video';
		$message['attachment']['type'][7] = 'other';

		$ids = imap_search($mbox, 'ALL', SE_UID);
		for ($jk = 0; $jk < count($ids); $jk++) {
			$structure = imap_fetchstructure($mbox, $ids[$jk] , FT_UID);
			if (!isset($structure->parts)) continue;

			$parts = $structure->parts;
			$fpos=2;
			for($i = 1; $i < count($parts); $i++) {
				$message["pid"][$i] = ($i);
				$part = $parts[$i];

				if(isset($part->disposition) && $part->disposition == 'ATTACHMENT') {
					$message['type'][ $i ] = $message['attachment']['type'][$part->type] . '/' . strtolower($part->subtype);
					$message['subtype'][ $i ] = strtolower($part->subtype);

					$ext = $part->subtype;

					$params = $part->dparameters;
					$filename = $part->dparameters[0]->value;

					$mege = imap_fetchbody($mbox, $jk+1, $fpos);

					$fp=fopen($savedirpath.$filename, 'w');
					$data=$this->getdecodevalue($mege,$part->type);
					fwrite($fp,$data);

					fclose($fp);
					$nbattach++;
					$fpos+=1;
				}
			}

			if ($delete_emails) {
				// imap_delete tags a message for deletion
				imap_delete($mbox,$jk+1);
			}
		}

		// imap_expunge deletes all tagged messages
		if ($delete_emails) {
			imap_expunge($mbox);
		}

		imap_close($mbox);

		return ("Completed ($nbattach attachment(s) downloaded into $savedirpath)");
	}

    function importFromExcel($filename){
		require_once 'Excel/reader.php';

		$Excel = new Spreadsheet_Excel_Reader();
		$Excel->setOutputEncoding('utf-8');
		$Excel->read($filename);
		$this->permissions['insert'] = true;

		for($i = 6; $i<=count($Excel->sheets[0]['cells'])+1; $i++){

			$data['coordinator']            = $Excel->sheets[0]['cells'][$i][1];
			$data['datetime_year']          = substr(substr_replace($Excel->sheets[0]['cells'][$i][2], '2012', 6, 2), 6, 4);
			$data['datetime_month']         = substr($Excel->sheets[0]['cells'][$i][2], 3, 2);
			$data['datetime_day']           = substr($Excel->sheets[0]['cells'][$i][2], 0, 2);
			$data['datetime_hour']          = substr($Excel->sheets[0]['cells'][$i][2], 9, 2);
			$data['datetime_minute']        = substr($Excel->sheets[0]['cells'][$i][2], 12, 2);
			$data['date_year']          	= substr(substr_replace($Excel->sheets[0]['cells'][$i][3],'2012', 6, 2), 6, 4);
			$data['date_month']         	= substr($Excel->sheets[0]['cells'][$i][3], 3, 2);
			$data['date_day']           	= substr($Excel->sheets[0]['cells'][$i][3], 0, 2);
			$data['date_hour']          	= substr($Excel->sheets[0]['cells'][$i][3], 9, 2);
			$data['date_minute']        	= substr($Excel->sheets[0]['cells'][$i][3], 12, 2);
			$data['address']                = $Excel->sheets[0]['cells'][$i][4];
			$data['insurer']                = $Excel->sheets[0]['cells'][$i][5];
			$data['insurer_phones']         = $Excel->sheets[0]['cells'][$i][6];
			$data['driver']                 = $Excel->sheets[0]['cells'][$i][7];
			$data['driver_phones']          = $Excel->sheets[0]['cells'][$i][8];
			$data['model']                  = $Excel->sheets[0]['cells'][$i][9];
			$data['sign']                   = $Excel->sheets[0]['cells'][$i][10];
			$data['participants_count']     = $Excel->sheets[0]['cells'][$i][11];
			$data['description']            = $Excel->sheets[0]['cells'][$i][12];
			$data['application_risks']      = $Excel->sheets[0]['cells'][$i][13];
			$data['damage_description']     = $Excel->sheets[0]['cells'][$i][14];
			$data['mvs_region']             = $Excel->sheets[0]['cells'][$i][15];
			$data['location']               = $Excel->sheets[0]['cells'][$i][16];
			$data['additional_information'] = $Excel->sheets[0]['cells'][$i][17];
            $data['product_types_id']       = intval($this->product_types_id);

			$this->insert($data, false, false);
		}
    }

    function import($data){
        global $Log;

        if (is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] && ereg('\.xls$', $_FILES['file']['name'])) {

            $this->importFromExcel($_FILES['file']['tmp_name']);

            $Log->add('confirm', 'Файл завантажено');

            header('Location: ' . $data['redirect']);
            exit;
        }

        include_once $this->object . '/import.php';
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='AccidentCalls/show.php', $limit=true) {
        global $db, $Log, $Authorization;

		if ($Authorization->data['roles_id'] == ROLES_MASTER) {
			$data['car_services_id'] = array($Authorization->data['car_services_id']);
		}

		if ($data['sign']) {
            $fields[] = 'sign';
            $conditions[] =  'sign LIKE ' . $db->quote($data['sign'] . '%');
        }

        if ($data['insurer']) {
            $fields[] = 'insurer';
            $conditions[] = PREFIX . '_accident_calls.insurer LIKE ' . $db->quote($data['insurer'] . '%');
        }

        if ($data['coordinator']) {
            $fields[] = 'coordinator';
            $conditions[] = PREFIX . '_accident_calls.coordinator LIKE ' . $db->quote($data['coordinator'] . '%');
        }

         if ($data['model']) {
            $fields[] = 'model';
            $conditions[] = PREFIX . '_accident_calls.model LIKE ' . $db->quote($data['model'] . '%');
        }

         if ($data['from'] && $data['to']) {
            $fields[] = 'from';
            $fields[] = 'to';
            $conditions[] = 'date BETWEEN ' . $db->quote(date('Y-m-d',strtotime($data['from']))) . ' AND '.$db->quote(date('Y-m-d', strtotime($data['to'])) . ' 23:59:59');
        } elseif($data['from']) {
            $fields[] = 'from';
            $conditions[] = 'date BETWEEN ' . $db->quote(date('Y-m-d',strtotime($data['from']))) . ' AND ' . $db->quote(date('Y-m-d').' 23:59:59');
        }

        $conditions[] = 'product_types_id = ' . $data['product_types_id'];

        if(is_array($conditions)){
            $sql =	'SELECT *, date_format(date, \'%d.%m.%Y %H:%i\') AS date_format ' .
					'FROM ' . PREFIX . '_accident_calls ' .
					'WHERE ' . implode(' AND ', $conditions);
        }else{
            $sql =	'SELECT *, date_format(date, \'%d.%m.%Y %H:%i\') AS date_format ' .
					'FROM ' . PREFIX . '_accident_calls';
        }
        parent::show($data, $fields, $conditions, $sql, $template, $limit);
    }

    function generateExcelInWindow($data){
        $this->generateExcel($data);
    }
    
    function generateExcel($data){
        global $db;
        for($i=1;$i<count($this->formDescription['fields']);$i++) {
            $data['outputparamstitle'][] = $this->formDescription['fields'][$i]['description'];
            $data['outputparamsname'][] = $this->formDescription['fields'][$i]['name'];
        }
        $i=0;
        if (is_array($data['id'])) {
            foreach ($data['id'] as $id){
                $sql = 'SELECT * FROM ' . PREFIX . '_accident_calls WHERE id=' . $id;
                $res = $db->getRow($sql);
                $i++;
                foreach ($data['outputparamsname'] as $name){
                    $data['writetofile']['item'.$i][] = $res[$name];
                }
            }
        }
        else foreach ($data['outputparamsname'] as $name){
            if ($name == 'date'){
                $data['writetofile']['item'][]= $data['date'] . ' ' . $data['dateTimePicker'];
                continue;
            }
            if ($name == 'datetime'){
                $data['writetofile']['item'][] = $data['datetime'] . ' ' . $data['datetimeTimePicker'];;
                continue;
            }
            $data['writetofile']['item'][] = $data[$name];
        }
        header('Content-Disposition: attachment; filename="report.xls"');
        header('Content-Type: ' . Form::getContentType('report.xls'));
        include_once 'templates/AccidentCalls/generateExcel.php';
    }
}

?>