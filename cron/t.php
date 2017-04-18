<?

require_once '../include/collector.inc.php';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: Express group <support@e-insurance.in.ua>' . "\r\n";


$subject = 'Test message e-insurance';
	
	$Templates->send('s.vinogradov@express-group.com.ua', null, $template = null, $subject, 'Тестовый текст', 'Express group', 'support@e-insurance.in.ua', false);
	$Templates->send('vinogradov_s@ukr.net', null, $template = null, $subject, '', 'Express group', 'support@e-insurance.in.ua', false);
//	$Templates->send('vinogradov_s@voliacable.com', null, $template = null, $subject, '', 'Express group', 'support@e-insurance.in.ua', false);
	//$Templates->send('s.vynogradov@gmail.com', null, $template = null, $subject, '', 'Express group', 'support@e-insurance.in.ua', false);

echo $text;
echo 'done1';

 
?>