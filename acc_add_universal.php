<?
require_once 'include/collector.inc.php';

function importFromExcel($filename){
    global $db;
		require_once 'Excel/reader.php';

		$Excel = new Spreadsheet_Excel_Reader();
		$Excel->setOutputEncoding('utf-8');
		$Excel->read($filename);


		for($i = 3; $i<=count($Excel->sheets[0]['cells']); $i++){

           $sql = 'INSERT INTO new_accounts SET ' .
			'region                 = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][1]," ")) .', ' .
            'title                  = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][2]," ")) .', ' .
            'address_agencies       = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][3]," ")) .', ' .
            'fio1                   = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][4]," ")) .', ' .
            'fio2                   = \'\', ' .
            'director1              = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][6]," ")) .', ' .
            'passport_series        = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][7]," ")) .', ' .
            'passport_number        = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][8]," ")) .', ' .
            'passport_place         = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][9]," ")) .', ' .
            'passport_date          = ' . $db->quote(trim(str_replace("/", ".", $Excel->sheets[0]['cells'][$i][10])," ")) .', ' .
            'address                = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][12]," ")) .', ' .
            'inn                    = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][11]," ")) .', ' .
            'phone                  = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][13]," ")) .', ' .
			'fio_rod                  = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][5]," ")) .', ' .
			'code                  = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][15]," ")) .', ' .
			
            'e_mail                 = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][14]," "));
            $db->query($sql);
		}
}
function updatePassport($filename){
    global $db;
		require_once 'Excel/reader.php';

		$Excel = new Spreadsheet_Excel_Reader();
		$Excel->setOutputEncoding('utf-8');
		$Excel->read($filename);


		for($i = 2; $i<=count($Excel->sheets[0]['cells']); $i++){
            $sql = 'UPDATE new_accounts SET ' .
			       'passport_place         = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][8]," ")).' ' .
                   'WHERE inn              = ' . $db->quote(trim($Excel->sheets[0]['cells'][$i][9]," "));
            $db->query($sql);
		}

}
function insertAgencies(){
    global $db;
        $sql = 'SELECT  region  as title,address_agencies,code ' .
               'FROM `new_accounts` where region not like \'557%\' GROUP BY region ';
        $list = $db->getAll($sql);
        $k = 40;
        $i = 40;
        foreach($list as $value) {
            //if($k == 412) $k = 415;
$sql='SELECT id FROM `insurance_agencies` WHERE code LIKE \'557%\' and (title='.$db->quote($value['title']) .' OR code ='.$db->quote($value['code']).')';
//_dump($sql);
$exists_ag = intval($db->getOne($sql));
if ($exists_ag==0) {
            $sql = 'INSERT INTO insurance_agencies SET ' .
                   'code                             = ' . $db->quote('557.'.$i) . ', ' .
                   'title                            = ' . $db->quote($value['title']) . ', ' .
                   'edrpou                           = " ",'.
                   'director1                        = " ",'.
                   'director2                        = " ",'.
                   'director_fop_id                  = " ",'.
                   'position                         = " ",'.
                   'director                         = " ",'.
                   'address                          = ' . $db->quote($value['address_agencies']) . ', ' .
                   'phones                           = " ",'.
                   'ground_kasko_express             = " ",'.
                   'ground_kasko_generali             = " ",'.
                   'ground_akt                       = " ",'.
                   'ground                           = " ",'.
                   'generali_branches_id             = " ",'.
                   'agreement_number_generali        = " ",'.
                   'agreement_date_generali          = " ",'.
                   'regions_id                       = 26,'.
                   'director1_id                     = " ",'.
                   'director2_id                     = " ",'.
                   'service                          = " ",'.
                   'parent_id                        = 557,'.
                   'num_l                            = '.$i.','.
                   'num_r                            = " ",'.
                   'top                              = 557,'.
                   'level                            = 2,'.
                   'active                           = 1,'.
                   'synhronize                       = " ",'.
                   'created                          = " ",'.
                   'modified                         = " ",'.
                   'agreement_number                 = " ",'.
                   'agreement_date                   = " ",'.
                   'bank                             = " ",'.
                   'bank_mfo                         = " ",'.
                   'bank_account                     = " ",'.
                   'code_ek                          = " "';
                   echo($sql.';<br>');
				   //echo($value['title'].'<br>');
				   
            $i++;
}
            //$k++;
            }
//_dump($i);
}

  // Параметр $number - сообщает число
  // символов в пароле

function generate_password($number) {

    $arr = array('a','b','c','d','e','f',
                 'g','h','i','j','k','l',
                 'm','n','o','p','r','s',
                 't','u','v','x','y','z',
                 'A','B','C','D','E','F',
                 'G','H','I','J','K','L',
                 'M','N','O','P','R','S',
                 'T','U','V','X','Y','Z',
                 '1','2','3','4','5','6',
                 '7','8','9','0','.',',',
                 '(',')','[',']','!','?',
                 '&','^','%','@','*','$',
                 '<','>','/','|','+','-',
                 '{','}','`','~');
    // Генерируем пароль
    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
      // Вычисляем случайный индекс массива
      $index = rand(0, count($arr) - 1);
      $pass .= $arr[$index];
    }
    return $pass;
}

function getAccount($id) {
    global $db;
    $sql = 'SELECT * FROM ' . PREFIX . '_accounts ' .
           'WHERE id = ' . intval($id);
    return $db->getRow($sql);
}
function updateExportTableByEmail($data) {
    global $db;
    $sql = 'UPDATE new_accounts ' .
           'SET ' .
           'id_account = ' . $db->quote($data['id']) . ', ' .
           'login = ' . $db->quote($data['login']) . ', ' .
           'password = ' . $db->quote($data['password']) . ' ' .
           'WHERE e_mail = ' . $db->quote($data['email']);
    $db->query($sql);
    return;
}
function getAgenciesIdByTitle($data) {
    global $db;
	if ($data['code'])
	$sql = 'SELECT id FROM insurance_agencies
            WHERE code = ' . $db->quote($data['code']);
	else
    $sql = 'SELECT id FROM insurance_agencies
            WHERE code like \'557.%\' AND  title = ' . $db->quote($data['title']);
_dump($sql);
    return $db->getOne($sql);
}
function generate_login($data) {
    return substr($data['e_mail'],0, strpos($data['e_mail'],'@')).'.unv';
}
function parsePassport($data) {
    $template1 = '/[0-9]{2}[.|\/][0-9]{2}[.|\/][0-9]{4}/';
    $template2 = '/[0-9]{6}/';
    $template3 = '/([А-Я]{4}[0-9]{6})|([А-Я]{4}[ ][0-9]{6})|([А-Я]{4}№[0-9]{6})|([А-Я]{4}[,][ ]№[ ][0-9]{6})|([А-Я]{4}[,][ ]№[0-9]{6})|([А-Я]{4}[ ]№[ ][0-9]{6})|([А-Я]{4}№[ ][0-9]{6})|([А-Я]{4}[ ]№[0-9]{6})/';

    $passport = array();
    preg_match_all($template1, $data['passport'], $passport['date']);
    preg_match_all($template2, $data['passport'], $passport['number']);
    preg_match_all($template3, $data['passport'], $passport['series']);

    $passport['series'][0][0]   = substr($passport['series'][0][0], 0, 4);

    return $passport;
}

function insertAccounts(){
    global $db;
    $sql = 'SELECT a.*, a.region  as title ' .
           'FROM new_accounts a where a.id_account=0';
    $list = $db->getAll($sql);
    //$i=8209;
    foreach($list as $value) {
        //if ($i == 8081) $i = 8082;
        /*$lastname       = substr($value['fio1'], 0, strpos($value['fio1'], " "));
        $firstname      = substr($value['fio1'],strpos($value['fio1'], " ")+1, strpos($value['fio1'], " ", strpos($value['fio1'], " ")+1) - strpos($value['fio1'], " ")-1);
        $patronymicname = substr($value['fio1'], strpos($value['fio1'], " ", strpos($value['fio1'], " ",strpos($value['fio1'], " "))+1)+1,1000000);*/
        $fio = explode(" ",$value['fio1']);

        $sql = 'INSERT INTO insurance_accounts SET ' .
                       //'id                               = ' . $i . ', ' .
                       'login                            = ' . $db->quote(generate_login($value)) . ', ' .
                       'password                         = ' . $db->quote(generate_password(8)). ','.
                       'lastname                         = ' . $db->quote($fio[0]) . ',' .
                       'firstname                        = ' . $db->quote($fio[1]) . ',' .
                       'patronymicname                   = ' . $db->quote($fio[2]) . ',' .
                       'phone                            = " ",'.
                       'fax                              = " ",'.
                       'mobile                           = IF(' . $db->quote($value['phone']) . ' is NULL," ", ' . $db->quote($value['phone']) . '), ' .
                       'email                            = ' . $db->quote($value['e_mail']) . ', ' .
                       'screen_resolutions_id            = 2,  '.
                       'records_per_page                 = 50,'.
                       'ip                               = " ",'.
                       'roles_id                         = 8,  '.
                       'akt                              = " ",'.
                       'account_groups_id_old            = " ",'.
                       'active                           = 1,  '.
                       'created                          = NOW(),'.
                       'modified                         = NOW(),'.
                       'expired                          = NOW(),'.
                       'ek_id                            = " "';
             $db->query($sql);
             $id = mysql_insert_id();
             $account =  getAccount($id);//выбираем данные из таблицы аккаунтов по вставленной записи
             updateExportTableByEmail($account);//обновляем таблицу из Екселя, вставляя ай-ди, для последующего присвоения пароля и логиня для експорта
             $passport = parsePassport($value);
             $agencies_id =  getAgenciesIdByTitle($value);//находим номер агенции  по названию для вставки в таблицу агентов

        $sql = 'INSERT INTO insurance_agents SET ' .
                       'accounts_id                     = ' . $id . ', ' .
                       'agencies_id                     = ' . $agencies_id . ', '.
                       'types_id                        = 1, ' .
                       'agreement_number                = " ", '.
                       'agreement_date                  = " ", '.
                       'agreement_number_generali       = " ", '.
                       'agreement_date_generali         = " ", '.
                       'passport_series                 = ' . $db->quote($value['passport_series']) . ', '.
                       'passport_number                 = ' . $db->quote($value['passport_number']) . ', '.
                       'passport_date                   = ' . $db->quote($value['passport_date']) . ', './/IF(' . $db->quote($passport['date'][0][0]) . ' is NULL,"",'.$db->quote(date("Y-m-d",strtotime($passport['date'][0][0]))).'), '.
                       'passport_place                  = ' . $db->quote($value['passport_place']) . ', '.
                       'identification_code             = ' . $db->quote($value['inn']) . ', ' .
                       'address                         = ' . $db->quote($value['address']) . ', ' .
					   'director1                   = ' . $db->quote($value['fio1']) . ',' .					   
					   'director2                   = ' . $db->quote($value['fio_rod']) . ',' .	
                       'recipient                       = " ", '.
                       'mfo                             = " ", '.
                       'zkpo                            = " ", '.
                       'bank_account                    = " ", '.
                       'bank_reference                  = " ", '.
                       'service                         = " ", '.
                       'go_discount                     = " ", '.
                       'ek_id                           = " " ';

       $db->query($sql);
       //$i++;
    }

}
   //importFromExcel('acc.xls');
   // insertAgencies();
   insertAccounts();
    //updatePassport('1.xls');
echo 'done';
?>