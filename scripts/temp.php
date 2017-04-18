<?

require_once '../include/collector.inc.php';
require_once 'Tasks.class.php';
//require_once 'Crawler.php';
//require_once 'AutoRiaComCrawler.php';

$Tasks = new Tasks();
$Tasks->generateNextPayment();
exit;

/*$output = make_request('http://vse-sto.com.ua/sto/2485-');
echo $output;*/

/*$fp = fsockopen('http://vse-sto.com.ua/sto/2485-3-d-razval-shozhdenie');
_dump($fp);
_dump(fread($fp, $out));
//fwrite($fp);*/


/*$response = http_get('http://vse-sto.com.ua/sto/2485-', array("timeout"=>1), $info);
print_r($info);

/*$s = file_get_contents('http://vse-sto.com.ua/sto/2485-');
_dump($_GET);
_dump($_POST);
_dump($s);*/


//_dump($a->getHTML('http://vse-sto.com.ua/sto/1-'));
//exit;


$max=2;

for ($i=1; $i<$max; $i++) {
	$result = file_get_contents('http://vse-sto.com.ua/sto/' . $i . '-');
//	$a->_html = $result;
$a = new AutoRiaComCrawler($result);
$a->parse();
	//$result = _stripHTML($result);
	//_dump($result->("<span class='fn org'>"));
	_dump( $a);
}

?>