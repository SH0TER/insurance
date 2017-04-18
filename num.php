<?

$start = time();

function add0($str, $length){
	while(strlen($str) < $length) $str = '0' . $str;
	return $str;
}

function is_palindromic_number($number){
	$number = (string)$number;
	$sign = 0;
	if(strlen($number) % 2 > 0) $sign = -1;
	
	for($i = 0; $i < strlen($number) / 2 + $sign; $i++){
		if ($number[$i] != $number[strlen($number) - 1 - $i]) return false;
	}

	return true;
}

$n = 4;

$max = '';
for( ; strlen($max) < $n; ) $max = '9' . $max;
$max = intval($max);

$min = '1';
for( ; strlen($min) < $n; ) $min = $min . '0';
$min = intval($min);

$done = false;
for($i = $max * $max; $i > $min * $min && $done == false; $i--){	
	if(is_palindromic_number($i)){
		$multipliers = array();
		$divider = 2;
		$number = $i;
		while($divider <= $number){
			if($number % $divider == 0){
				$multipliers[] = $divider;
				$number = $number / $divider;
			} else {
				$divider = $divider+1;		
			}
		}
		$k = (pow(2, sizeof($multipliers)) - 2) / 2;
		$products = array();
		for ($j=1; $j<=$k; $j++){
			$val0 = 1;
			$val1 = 1;
			$res = array();
			$code = add0((string)decbin($j), sizeof($multipliers));

			for($id = 0; $id < sizeof($multipliers); $id++){
				if($code[$id] == '1') {
					$val1 *= $multipliers[$id];
				}
				if($code[$id] == '0') {
					$val0 *= $multipliers[$id];
				}
			}
			$res[] = (string)$val0;
			$res[] = (string)$val1;
			$products[] = $res;
			
			/*if (strlen($res[0]) == $n && strlen($res[1]) == $n && intval($res[0]) * intval($res[1]) == $i){
				echo 'M1 = ' . $res[0] . ', M2 = ' . $res[1] . ', Palindromic number(PN) = ' . $i;
				echo '<br/>' . (time() - $start) . ' sec.';
				$done = true;
				break;
			}*/
		}

		foreach($products as $product){
			if (strlen($product[0]) == $n && strlen($product[1]) == $n && intval($product[0]) * intval($product[1]) == $i){
				echo 'M1 = ' . $product[0] . ', M2 = ' . $product[1] . ', Palindromic number(PN) = ' . $i;
				echo '<br/>' . (time() - $start) . ' sec.';
				$done = true;
				break;
			}	
		}
	}
}

?>