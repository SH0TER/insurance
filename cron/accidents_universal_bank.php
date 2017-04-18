<?

require_once '../include/collector.inc.php';

$url='https://e-insurance.in.ua/index.php?do=ReportBuilder|generateInWindow&id=23&financial_institutions_id=39&excel=1&from_date='.date("d.m.Y",mktime(0,0,0,date("n")-1,1,date("Y"))).'&to_date='.date("d.m.Y",mktime(0,0,0,date("n")-1,31,date("Y")));
_dump($url);
$text=file_get_contents ( $url );
echo $text;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: Express group <support@express-credit.in.ua>' . "\r\n";


//mail('eugene.cherkassky@gmail.com', $subject, $text, $headers);
$subject = 'Life agreements';
$files = array(
            array(
                'data'  => $text,
                'name'  => 'report.xls'));
if ($text) {
	//$Templates->send('s.vinogradov@express-group.com.ua', null, $template = null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, $files);
	//$Templates->send('vinogradov_s@ukr.net', null, $template = null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, $files);
	//$Templates->send('n.berdnik@express-group.com.ua', null, $template = null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, $files);
	//$Templates->send('y.kolomiets@express-group.com.ua', null, $template = null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, $files);
	$Templates->send('m.marchuk@express-group.com.ua', null, $template = null, $subject, '', 'Express group', 'support@express-credit.in.ua', false, $files);
}
//echo $text;
echo 'done';

?>