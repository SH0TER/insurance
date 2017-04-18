<?

require_once '../include/collector.inc.php';

$url='https://express-credit.in.ua/index.php?do=ReportBuilder|generateInWindow&id=17&runquery=1&excel=1&beginDate=01.09.2012&endDate='.date('d.m.Y');
_dump($url);
$text=file_get_contents ( $url );
echo $text;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: Express group <support@e-insurance.in.ua>' . "\r\n";


//mail('eugene.cherkassky@gmail.com', $subject, $text, $headers);
$subject = 'Life agreements';
$files = array(
            array(
                'data'  => $text,
                'name'  => 'report.xls'));
if ($text) {
	$Templates->send('vinogradov_s@ukr.net', null, $template = null, $subject, '', 'Express group', 'support@e-insurance.in.ua', false, $files);
	$Templates->send('n.berdnik@express-group.com.ua', null, $template = null, $subject, '', 'Express group', 'support@e-insurance.in.ua', false, $files);
	$Templates->send('y.kolomiets@express-group.com.ua', null, $template = null, $subject, '', 'Express group', 'support@e-insurance.in.ua', false, $files);
	$Templates->send('berdniknatalia@gmail.com', null, $template = null, $subject, '', 'Express group', 'support@e-insurance.in.ua', false, $files);
	$Templates->send('s.vinogradov@express-group.com.ua', null, $template = null, $subject, '', 'Express group', 'support@e-insurance.in.ua', false, $files);
}
//echo $text;
echo 'done';

?>