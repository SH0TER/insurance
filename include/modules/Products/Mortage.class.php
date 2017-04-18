<?
 
require_once 'Policies.class.php';
class Products_Mortage extends Products {

    var $object = 'Products';

   

    function getRateInWindow($data) {
		global $Authorization;

		if ($Authorization->data['roles_id'] == ROLES_AGENT) {
			$data['agencies_id'] = $Authorization->data['agencies_id'];
		}
		$data['max_discount']	= $this->getMaxDiscount(array($data['products_id']));

		//$data = $this->calculate($data['risks'], $data['financial_institutions_id'], $data['price'], $data['discount'], $data['cart_discount'], $data['agencies_id'], $data['terms_id'], $data);
		$v = $data['values_id'];
		$mortage_groups_id = $data['mortage_groups_id'];
		$deductibles_value = doubleval($data['deductibles_value']);
		
		$bt = 0;
		
		if ( in_array(1,$v) && ($mortage_groups_id==1 || $mortage_groups_id==7))
			$bt = 0.16;
		if ( in_array(1,$v) && $mortage_groups_id==2)
			$bt = 0.17;	
		if ( in_array(1,$v) && $mortage_groups_id==3)
			$bt = 0.16;
		if ( in_array(1,$v) && $mortage_groups_id==4)
			$bt = 0.19;
		if ( in_array(1,$v) && $mortage_groups_id==5)
			$bt = 0.21;			
		if ( in_array(1,$v) && $mortage_groups_id==6)
			$bt = 0.05;	
			
		if ( in_array(2,$v) && ($mortage_groups_id==1 || $mortage_groups_id==7))
			$bt = 0.18;
		if ( in_array(2,$v) && $mortage_groups_id==2)
			$bt = 0.19;	
		if ( in_array(2,$v) && $mortage_groups_id==3)
			$bt = 0.18;
		if ( in_array(2,$v) && $mortage_groups_id==4)
			$bt = 0.22;
		if ( in_array(2,$v) && $mortage_groups_id==5)
			$bt = 0.24;			
		if ( in_array(2,$v) && $mortage_groups_id==6)
			$bt = 0.05;	
		
		if ( in_array(3,$v) && ($mortage_groups_id==1 || $mortage_groups_id==7))
			$bt = 0.38;
		if ( in_array(3,$v) && $mortage_groups_id==2)
			$bt = 0.4;	
		if ( in_array(3,$v) && $mortage_groups_id==3)
			$bt = 0.38;
		if ( in_array(3,$v) && $mortage_groups_id==4)
			$bt = 0.46;
		if ( in_array(3,$v) && $mortage_groups_id==5)
			$bt = 0.5;			
		if ( in_array(3,$v) && $mortage_groups_id==6)
			$bt = 0.05;	
			
		$k1 = 0;
		if ($deductibles_value	==0) $k1=1;
		if ($deductibles_value	==0.25) $k1=0.97;
		if ($deductibles_value	==0.5) $k1=0.95;
		if ($deductibles_value	==1) $k1=0.92;
		if ($deductibles_value	==1.5) $k1=0.89;
		if ($deductibles_value	==2) $k1=0.85;
		
		$k2=0;
		if ( in_array(4,$v)) $k2=1.2;
		if ( in_array(5,$v)) $k2=1;
		if ( in_array(6,$v))  $k2=0.8;
		
		$year=intval($data['year']);
		$a = getdate(); 
		$ycount = $a['year']-$year;
		$k3=0;
		if ($ycount<1) $k3=1.15;
		elseif ($ycount<5) $k3=1.0;
		elseif ($ycount<20) $k3=0.95;
		elseif ($ycount<50) $k3=1.1;
		else $k3=1.15;
		
		$k4=0;
		if ( in_array(7,$v)) $k4=0.9;
		if ( in_array(8,$v)) $k4=0.95;
		if ( in_array(9,$v))  $k4=1.05;
		if ( in_array(10,$v))  $k4=1.2;
		if ( in_array(11,$v))  $k4=1.4;
		if ( in_array(12,$v))  $k4=2.5;
		
		$k51=1.05;
		$fire_extinguishers_counts = intval($data['fire_extinguishers_counts']);
		if($fire_extinguishers_counts<1) $k51=1.05;
		elseif($fire_extinguishers_counts<2) $k51=0.95;
		elseif($fire_extinguishers_counts<6) $k51=0.92;
		elseif($fire_extinguishers_counts>5) $k51=0.9;
		
		$k52=1;
		if ( in_array(15,$v)) $k52=0.95;
		if ( in_array(16,$v)) $k52=0.95;
		if ( in_array(14,$v)) $k52=0.9;
		if ( in_array(13,$v)) $k52=0.87;
		if ( in_array(17,$v)) $k52=0.87;
		
		$k53=1.05;
		if ( in_array(18,$v)) $k53=0.95;
		
		$k61=1.05;
		if ( in_array(19,$v)) $k61=0.95;
		$k62=1.05;
		if ( in_array(20,$v)) $k62=0.95;
		
		
		$k63=1.1;
		if ( in_array(21,$v)) $k63=0.95;
		if ( in_array(22,$v)) $k63=0.97;
		
		$k7=0;
		$terms_years_id = intval($data['terms_years_id']);
		if ($terms_years_id<2) $k7=1;
		elseif ($terms_years_id<4) $k7=0.95;
		elseif ($terms_years_id<11) $k7=0.9;
		elseif ($terms_years_id<100) $k7=0.85;
//_dump($bt.'*'.$k1.'*'.$k2.'*'.$k3.'*'.$k4.'*'.$k51.'*'.$k52.'*'.$k53.'*'.$k61.'*'.$k62.'*'.$k63.'*'.$k7);
		$data['rate'] = round($bt*$k1*$k2*$k3*$k4*$k51*$k52*$k53*$k61*$k62*$k63*$k7,3);
//$data['rate'] =0.9;
		$data['amount'] = doubleval($data['price'])*$data['rate']/100;
        echo '{' .
                '"rate":"' . doubleval($data['rate']) . '","amount":"' . getMoneyFormat($data['amount']) . '"}';
        exit;
    }
}

?>