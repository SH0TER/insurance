<?
header('Content-Type: text/html; charset=UTF-8');
define('DB_HOST',                       'localhost');
define('DB_DATABASE',                   'insurance');
define('DB_USER',                       'insurance');
define('DB_PASSWORD',                   'UyjE9AufsrvMasW4');

			
function openDB($host, $user, $password, $database) {
	$mysqli = new mysqli($host, $user, $password, $database);	
	if (mysqli_connect_error()) 
		die('Ошибка подключения (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	return 	$mysqli;	
}


$db = openDB(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


$block1_template = 'id,login,phone,age,hobby,category,position,address,date,site,company,card,email,name,color,'; 
$block2_template = 'id,login,phone,age,post,ra,hobby,position,address,date,site,company,card,email,name,color';
$block3_template = 'name,email,birthdate,company,icard,orgnum,phone,phone2,address,city,zip,region,hobby,dep,sex,';

$handle = fopen("test_data.csv", "r");
$current_block = 0;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
		if (strcmp(trim($line), $block1_template) === 0) {
			//processing block 1
			$current_block = 1;
		}
		elseif(strcmp(trim($line), $block2_template) === 0)
		{
			//processing block 2
			$current_block = 2;
		}
		elseif(strcmp(trim($line), $block3_template) === 0)
		{
			//processing block 3
			$current_block = 3;
		}
		else {
			if ($current_block == 0) die('Invalid data in file.');	
			//process actual data
			//$line  = utf8_encode($line);
			var_dump($line );
			$result = str_getcsv ($line);	
			var_dump($result );exit;
			if ($current_block == 1) {
				$sql =  'INSERT INTO block1(phone,hobby,position,address,site,company,card,email,name) 
						VALUES (\''.$db->real_escape_string($result[2]).'\',  \''.$db->real_escape_string($result[4]).'\', 
						\''.$db->real_escape_string($result[6]).'\',  \''.$db->real_escape_string($result[7]).'\', 
						\''.$db->real_escape_string($result[9]).'\',  \''.$db->real_escape_string($result[10]).'\',  
						\''.$db->real_escape_string($result[11]).'\',  \''.$db->real_escape_string($result[12]).'\', 
						\''.$db->real_escape_string($result[13]).'\')';
			
				if (!$db->query($sql)) {
					printf("Error: %s\n", $db->sqlstate);
					var_dump($sql);
					exit;
				}
			}

		}
		
		
		
		
		
    }
	
	mysqli_close($db);
    fclose($handle);
} else {
    die('error opening the data file.');
}

?>