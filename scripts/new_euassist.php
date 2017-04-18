<?

require_once '../include/collector.inc.php';
require_once 'Excel/reader.php';

function generate_login($email) {
    return substr($email,0, strpos($email,'@')).'.euassist';
}

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

$Excel = new Spreadsheet_Excel_Reader();
$Excel->setOutputEncoding('utf-8');
$Excel->read('new_euassist_2.xls');

for($i = 1; $i<=count($Excel->sheets[0]['cells']); $i++){

	$name = explode(' ', $Excel->sheets[0]['cells'][$i][1]);

	$sql = 'INSERT INTO insurance_accounts SET ' .
			'login = ' . $db->quote(generate_login($Excel->sheets[0]['cells'][$i][2])) . ', ' .
			'password = ' . $db->quote(generate_password(8)) . ', ' .
			'lastname = ' . $db->quote($name[0]) . ', ' .
			'firstname = ' . $db->quote($name[1]) . ', ' .
			'patronymicname = ' . $db->quote($name[2]) . ', ' .
			'email = ' . $db->quote($Excel->sheets[0]['cells'][$i][2]) . ', ' .
			'screen_resolutions_id = 2, ' .
			'records_per_page = 50, ' .
			'active                           = 1,  '.
			'roles_id                           = 2,  '.
		    'created                          = NOW(),'.
		    'modified                         = NOW(),'.
		    'expired                          = NOW(),'.
		    'ek_id                            = " "';	
	$db->query($sql);
	_dump($sql);
	$id = mysql_insert_id();
	
	$ag = explode('#', $Excel->sheets[0]['cells'][$i][3]);
	
	foreach($ag as $g) {
		$sql = 'insert into insurance_account_groups_managers_assignments set ' .
				'accounts_id = ' . intval($id) . ', ' .
				'account_groups_id = ' . intval($g);
		$db->query($sql);
		_dump($sql);
	}
	
}


?>