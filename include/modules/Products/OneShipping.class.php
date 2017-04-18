<?
 
require_once 'Policies.class.php';
class Products_OneShipping extends Products {

    var $object = 'Products';

   

    function getRateInWindow($data) {
		global $Authorization;

		if ($Authorization->data['roles_id'] == ROLES_AGENT) {
			$data['agencies_id'] = $Authorization->data['agencies_id'];
		}
//_dump($bt.'*'.$k1.'*'.$k2.'*'.$k3.'*'.$k4.'*'.$k51.'*'.$k52.'*'.$k53.'*'.$k61.'*'.$k62.'*'.$k63.'*'.$k7);
		$data['rate'] = round($data['rate'], 4);
//$data['rate'] =0.17;
		$data['amount'] = doubleval($data['price'])*$data['rate']/100;
        echo '{' .
                '"rate":"' . doubleval($data['rate']) . '","amount":"' . getMoneyFormat($data['amount']) . '"}';
        exit;
    }
}

?>