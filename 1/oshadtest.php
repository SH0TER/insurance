<?
$url='https://express-credit.in.ua/synchronization/express/getQuestionnaires.php?WSDL';

$client     = new SoapClient($url, array("trace" => 1));


try {
	    $result=$client->getQuestionnaireFile(array("number" => '2-172450','filename'=>'528287001456327034.pdf', "key" =>'E06C0E97-8B6E-11E0-BC40-3BC84724019B'));
		$result=strlen((string)$result->getQuestionnaireFileResult);
/*		$data = file_get_contents ( 'solutions.xml');
var_dump($data);
var_dump($client);
	    $result=$client->sendQuestionnaireSolution(array("xml" => $data, "key" =>'E06C0E96-8C6E-12E0-BC39-1BC84426119B'));
		$result=(string)$result->sendQuestionnaireSolutionResult;
		var_dump($result);*/
}
catch (Exception $e) {
				var_dump($e);
var_dump('end');
				}

				echo "REQUEST:\n" . $client->__getLastRequest() . "\n";
				echo "Response:\n" . $client->__getLastResponse() . "\n";


var_dump('end');
?>