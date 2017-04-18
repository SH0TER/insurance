<?

require_once '../include/collector.inc.php';

$url='https://e-insurance.in.ua/index.php?do=Reports|getAssistanceInWindow&from='.date('01.01.2012').'&to='.date('d.m.Y');

$text=file_get_contents ( $url );

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: Express group <support@express-credit.in.ua>' . "\r\n";


//mail('eugene.cherkassky@gmail.com', $subject, $text, $headers);
$subject = 'Report. Express assistance cards';
$files = array(
            array(
                'data'  => $text,
                'name'  => 'report.xls'));
if ($text) {
//	$Templates->send('t.motychko@express-group.com.ua', null, $template = null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, $files);
//	$Templates->send('tehassist@uac.com.ua', null, $template = null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, $files);
//	$Templates->send('a.korzh@express-group.com.ua', null, $template = null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, $files);
	//$Templates->send('vinogradov_s@ukr.net', null, $template = null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, $files);
}
$Templates->send('vinogradov_s@ukr.net', null, null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, null);
//echo $text;
echo 'done';

?>