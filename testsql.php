<?
 require_once 'include/collector.inc.php';
 require_once 'include/lib/WebServices/XML2Array.php';
				try {
					$client = new SoapClient('https://express-credit.in.ua/synchronization/express/sql.php?WSDL',array('trace' => 1));

				    $result=$client->getAll(array("sql" => 'select * from ukrauto_regions where title =\'Донецька область\''));
					$result=(string)$result->getAllResult;
					$list = XML2Array::createArray($result);
					_dump($list);
				}
				catch (Exception $e) {
				 _dump($e);
				}
				

				 //echo "REQUEST:\n" . $client->__getLastRequest() . "\n";
				 //echo "Response:\n" . $client->__getLastResponse() . "\n";

				 //_dump($result);
				 exit;
				
			

?>