<?	
	ini_set('soap.wsdl_cache_enabled', '0');
	require_once '../../include/collector.inc.php';
	require_once 'Products.class.php';
	require_once 'Policies.class.php';
	require_once 'Products/KASKO.class.php';
	require_once 'Policies/KASKO.class.php';
	require_once 'Policies/DGO.class.php';
    require_once 'Policies/GO.class.php';
	require_once 'Policies/NS.class.php';
	require_once 'Policies/DSKV.class.php';
	require_once 'Policies/Property.class.php';
	require_once 'Policies/Drive.class.php';
	require_once 'Policies/DriveGeneral.class.php';
	require_once 'Policies/Cargo.class.php';
	require_once 'Policies/Mortage.class.php';
	require_once 'Policies/DMS.class.php';
	require_once 'Reports.class.php';
	
	$SoapServer = new SoapServer(null, array('uri' => "http://e-insurance.in.ua/"));
	$Kasko=new Policies_KASKO($data);
	$dgo=new Policies_DGO($data);
    $go=new Policies_GO($data);
	$dskv=new Policies_DSKV($data);
	$Property=new Policies_Property($data);
	$Drive=new Policies_Drive($data);
	$DriveGeneral=new Policies_DriveGeneral($data);
	$Cargo=new Policies_Cargo($data);
	$ns=new Policies_NS($data);
	$dms=new Policies_DMS($data);
	$mortage=new Policies_Mortage($data);
	
	
	function getMysqlDate($date)
	{
		if (ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date, $regs)
			&& checkdate ( intval($regs[2]) , intval($regs[3]) , intval($regs[1]))) {
			return "$regs[1]-$regs[2]-$regs[3]";
		}
		else return date('Y-m-d');	
	}
	
	function getKaskoPolices()
    {
		global $Kasko,$db;
		$result=$Kasko->getXml(array());
    
		$result='<![CDATA['.$result.']]>';
	
	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getKaskoPolicesResponse xmlns="http://e-insurance.in.ua/">
      <getKaskoPolicesResult>'.$result.'</getKaskoPolicesResult>
    </getKaskoPolicesResponse>
  </soap12:Body>
</soap12:Envelope>';
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }
	
	function getKaskoPolicesByNumber($number)
	{
		global $Kasko,$db;
		$data['number']=$number;
		$result=$Kasko->getXml($data);
   
		$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getKaskoPolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getKaskoPolicesByNumberResult>'.$result.'</getKaskoPolicesByNumberResult>
    </getKaskoPolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;

	/*$handle = fopen('dump.dat', 'w+');
	fwrite($handle, $str) ;
    fclose($handle);*/

	  exit;
	}
	
	function getKaskoPolicesByDates($from,$to)
	{
		global $Kasko,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$Kasko->getXML($data);
    
		$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getKaskoPolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getKaskoPolicesByDatesResult>'.$result.'</getKaskoPolicesByDatesResult>
    </getKaskoPolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';

	/*$handle = fopen('dump.dat', 'w+');
	fwrite($handle, $str) ;
    fclose($handle);*/
	
	
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	
	
	
	
	function getDGOPolices()
    {
		global $dgo,$db;
		$result=$dgo->getXml(array());
    
		$result='<![CDATA['.$result.']]>';
	
	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDGOPolicesResponse xmlns="http://e-insurance.in.ua/">
      <getDGOPolicesResult>'.$result.'</getDGOPolicesResult>
    </getDGOPolicesResponse>
  </soap12:Body>
</soap12:Envelope>';
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }
	
	function getDGOPolicesByNumber($number)
	{
		global $dgo,$db;
		$data['number']=$number;
		$result=$dgo->getXml($data);
		
	
		$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDGOPolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getDGOPolicesByNumberResult>'.$result.'</getDGOPolicesByNumberResult>
    </getDGOPolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	function getDGOPolicesByDates($from,$to)
	{
		global $dgo,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$dgo->getXml($data);
    	$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDGOPolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getDGOPolicesByDatesResult>'.$result.'</getDGOPolicesByDatesResult>
    </getDGOPolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';


	
	
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	
	//**********************GO**********************
    function getGOPolices()
    {
		global $go,$db;
		$result=$go->getXml(array());

		$result='<![CDATA['.$result.']]>';

	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getGOPolicesResponse xmlns="http://e-insurance.in.ua/">
      <getGOPolicesResult>'.$result.'</getGOPolicesResult>
    </getGOPolicesResponse>
  </soap12:Body>
</soap12:Envelope>';

	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }

	function getGOPolicesByNumber($number)
	{
		global $go,$db;
		$data['number']=$number;
		$result=$go->getXml($data);


		$result='<![CDATA['.$result.']]>';

		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getGOPolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getGOPolicesByNumberResult>'.$result.'</getGOPolicesByNumberResult>
    </getGOPolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}

	function getGOPolicesByDates($from,$to)
	{
		global $go,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$go->getXml($data);
//$handle = fopen('dump.dat', 'w+');
//	fwrite($handle, $result) ;
  //  fclose($handle);


    	$result='<![CDATA['.$result.']]>';

		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getGOPolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getGOPolicesByDatesResult>'.$result.'</getGOPolicesByDatesResult>
    </getGOPolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';

   	$handle = fopen('dump.dat', 'w+');
	fwrite($handle, $str) ;
    fclose($handle);

	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	//**********************
	
	
	//*******************NS*************************
    function getNSPolices()
    {
		global $ns,$db;
		$result=$ns->getXml(array());

		$result='<![CDATA['.$result.']]>';

	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getNSPolicesResponse xmlns="http://e-insurance.in.ua/">
      <getNSPolicesResult>'.$result.'</getNSPolicesResult>
    </getNSPolicesResponse>
  </soap12:Body>
</soap12:Envelope>';

	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }

	function getNSPolicesByNumber($number)
	{
		global $ns,$db;
		$data['number']=$number;
		$result=$ns->getXml($data);


		$result='<![CDATA['.$result.']]>';

		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getNSPolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getNSPolicesByNumberResult>'.$result.'</getNSPolicesByNumberResult>
    </getNSPolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}

	function getNSPolicesByDates($from,$to)
	{
		global $ns,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$ns->getXml($data);

//$handle = fopen('dump.dat', 'w+');
//	fwrite($handle, $result) ;
//  fclose($handle);

    	$result='<![CDATA['.$result.']]>';

		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getNSPolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getNSPolicesByDatesResult>'.$result.'</getNSPolicesByDatesResult>
    </getNSPolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';


	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	//**********************
	
	
	
	
	
	//*******************Mortage*************************
    function getMortagePolices()
    {
		global $mortage,$db;
		$result=$mortage->getXml(array());

		$result='<![CDATA['.$result.']]>';

	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getMortagePolicesResponse xmlns="http://e-insurance.in.ua/">
      <getMortagePolicesResult>'.$result.'</getMortagePolicesResult>
    </getMortagePolicesResponse>
  </soap12:Body>
</soap12:Envelope>';

	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }

	function getMortagePolicesByNumber($number)
	{
		global $mortage,$db;
		$data['number']=$number;
		$result=$mortage->getXml($data);


		$result='<![CDATA['.$result.']]>';

		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getMortagePolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getMortagePolicesByNumberResult>'.$result.'</getMortagePolicesByNumberResult>
    </getMortagePolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}

	function getMortagePolicesByDates($from,$to)
	{
		global $mortage,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$mortage->getXml($data);


    	$result='<![CDATA['.$result.']]>';

		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getMortagePolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getMortagePolicesByDatesResult>'.$result.'</getMortagePolicesByDatesResult>
    </getMortagePolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';

/*	$handle = fopen('dump.dat', 'w+');
	fwrite($handle, $str) ;
    fclose($handle);*/


	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	//**********************
	
	
	
	function getDSKVPolices()
    {
		global $dskv,$db;
		$result=$dskv->getXml(array());
    
		$result='<![CDATA['.$result.']]>';
	
	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDSKVPolicesResponse xmlns="http://e-insurance.in.ua/">
      <getDSKVPolicesResult>'.$result.'</getDSKVPolicesResult>
    </getDSKVPolicesResponse>
  </soap12:Body>
</soap12:Envelope>';
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }
	
	function getDSKVPolicesByNumber($number)
	{
		global $dskv,$db;
		$data['number']=$number;
		$result=$dskv->getXml($data);
		
	
		$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <getDSKVPolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getDSKVPolicesByNumberResult>'.$result.'</getDSKVPolicesByNumberResult>
    </getDSKVPolicesByNumberResponse>
  </soap:Body>
</soap:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	function getDSKVPolicesByDates($from,$to)
	{
		global $dskv,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$dskv->getXml($data);

    	$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <getDSKVPolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getDSKVPolicesByDatesResult>'.$result.'</getDSKVPolicesByDatesResult>
    </getDSKVPolicesByDatesResponse>
  </soap:Body>
</soap:Envelope>';

	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	
	function getPropertyPolices()
    {
		global $Property,$db;
		$result=$Property->getXml(array());
    
		$result='<![CDATA['.$result.']]>';
	
	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getPropertyPolicesResponse xmlns="http://e-insurance.in.ua/">
      <getPropertyPolicesResult>'.$result.'</getPropertyPolicesResult>
    </getPropertyPolicesResponse>
  </soap12:Body>
</soap12:Envelope>';
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }
	
	function getPropertyPolicesByNumber($number)
	{
		global $Property,$db;
		$data['number']=$number;
		$result=$Property->getXml($data);
   
		$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getPropertyPolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getPropertyPolicesByNumberResult>'.$result.'</getPropertyPolicesByNumberResult>
    </getPropertyPolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	function getPropertyPolicesByDates($from,$to)
	{
		global $Property,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$Property->getXml($data);

    	$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getPropertyPolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getPropertyPolicesByDatesResult>'.$result.'</getPropertyPolicesByDatesResult>
    </getPropertyPolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';

	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	
	function getDrivePolices()
    {
		global $Drive,$db;
		$result=$Drive->getXml(array());
    
		$result='<![CDATA['.$result.']]>';
	
	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDrivePolicesResponse xmlns="http://e-insurance.in.ua/">
      <getDrivePolicesResult>'.$result.'</getDrivePolicesResult>
    </getDrivePolicesResponse>
  </soap12:Body>
</soap12:Envelope>';
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }
	
	function getDrivePolicesByNumber($number)
	{
		global $Drive,$db;
		$data['number']=$number;
		$result=$Drive->getXml($data);

		$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDrivePolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getDrivePolicesByNumberResult>'.$result.'</getDrivePolicesByNumberResult>
    </getDrivePolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	function getDrivePolicesByDates($from,$to)
	{
		global $Drive,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$Drive->getXml($data);

    	$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDrivePolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getDrivePolicesByDatesResult>'.$result.'</getDrivePolicesByDatesResult>
    </getDrivePolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';

	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	









	function getDriveGeneralPolices()
    {
		global $DriveGeneral,$db;
		$result=$DriveGeneral->getXml(array());
    
		$result='<![CDATA['.$result.']]>';
	
	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDriveGeneralPolicesResponse xmlns="http://e-insurance.in.ua/">
      <getDriveGeneralPolicesResult>'.$result.'</getDriveGeneralPolicesResult>
    </getDriveGeneralPolicesResponse>
  </soap12:Body>
</soap12:Envelope>';
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }
	
	function getDriveGeneralPolicesByNumber($number)
	{
		global $DriveGeneral,$db;
		$data['number']=$number;
		$result=$DriveGeneral->getXml($data);
   
		$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDriveGeneralPolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getDriveGeneralPolicesByNumberResult>'.$result.'</getDriveGeneralPolicesByNumberResult>
    </getDriveGeneralPolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	function getDriveGeneralPolicesByDates($from,$to)
	{
		global $DriveGeneral,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$DriveGeneral->getXml($data);

    	$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDriveGeneralPolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getDriveGeneralPolicesByDatesResult>'.$result.'</getDriveGeneralPolicesByDatesResult>
    </getDriveGeneralPolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';

	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}



	
	function getCargoPolices()
    {
		global $Cargo,$db;
		$result=$Cargo->getXml(array());
    
		$result='<![CDATA['.$result.']]>';
	
	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getCargoPolicesResponse xmlns="http://e-insurance.in.ua/">
      <getCargoPolicesResult>'.$result.'</getCargoPolicesResult>
    </getCargoPolicesResponse>
  </soap12:Body>
</soap12:Envelope>';
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }
	
	function getCargoPolicesByNumber($number)
	{
		global $Cargo,$db;
		$data['number']=$number;
		$result=$Cargo->getXml($data);
   
		$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getCargoPolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getCargoPolicesByNumberResult>'.$result.'</getCargoPolicesByNumberResult>
    </getCargoPolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	function getCargoPolicesByDates($from,$to)
	{
		global $Cargo,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$Cargo->getXml($data);

    	$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getCargoPolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getCargoPolicesByDatesResult>'.$result.'</getCargoPolicesByDatesResult>
    </getCargoPolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';

	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	
	
	
	
	
	//*******************DMS*************************
    function getDMSPolices()
    {
		global $dms,$db;
		$result=$dms->getXml(array());

		$result='<![CDATA['.$result.']]>';

	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDMSPolicesResponse xmlns="http://e-insurance.in.ua/">
      <getDMSPolicesResult>'.$result.'</getDMSPolicesResult>
    </getDMSPolicesResponse>
  </soap12:Body>
</soap12:Envelope>';

	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }

	function getDMSPolicesByNumber($number)
	{
		global $dms,$db;
		$data['number']=$number;
		$result=$dms->getXml($data);


		$result='<![CDATA['.$result.']]>';

		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDMSPolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getDMSPolicesByNumberResult>'.$result.'</getDMSPolicesByNumberResult>
    </getDMSPolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}

	function getDMSPolicesByDates($from,$to)
	{
		global $dms,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$result=$dms->getXml($data);

//$handle = fopen('dump.dat', 'w+');
//	fwrite($handle, $result) ;
//  fclose($handle);

    	$result='<![CDATA['.$result.']]>';

		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getDMSPolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getDMSPolicesByDatesResult>'.$result.'</getDMSPolicesByDatesResult>
    </getDMSPolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';


	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	//**********************
	
	
	
	
	//допки
	function getKaskoAddPolices()
    {
		global $Kasko,$db;
		$result=$Kasko->getXml(array('agreement_types_id'=>1));
    
		$result='<![CDATA['.$result.']]>';
	
	$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getKaskoAddPolicesResponse xmlns="http://e-insurance.in.ua/">
      <getKaskoAddPolicesResult>'.$result.'</getKaskoAddPolicesResult>
    </getKaskoAddPolicesResponse>
  </soap12:Body>
</soap12:Envelope>';
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
    }
	
	function getKaskoAddPolicesByNumber($number)
	{
		global $Kasko,$db;
		$data['number']=$number;
		$data['agreement_types_id']=1;
		$result=$Kasko->getXml($data);
   
		$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getKaskoAddPolicesByNumberResponse xmlns="http://e-insurance.in.ua/">
      <getKaskoAddPolicesByNumberResult>'.$result.'</getKaskoAddPolicesByNumberResult>
    </getKaskoAddPolicesByNumberResponse>
  </soap12:Body>
</soap12:Envelope>';
 	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;

	/*$handle = fopen('dump.dat', 'w+');
	fwrite($handle, $str) ;
    fclose($handle);*/

	  exit;
	}
	
	function getKaskoAddPolicesByDates($from,$to)
	{
		global $Kasko,$db;
		$data['from']=$db->quote(getMysqlDate($from). ' 00:00:00');
		$data['to']=$db->quote(getMysqlDate($to). ' 23:59:59');
		$data['agreement_types_id']=1;
		$result=$Kasko->getXML($data);

    	$result='<![CDATA['.$result.']]>';
		
		$str='<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Body>
    <getKaskoAddPolicesByDatesResponse xmlns="http://e-insurance.in.ua/">
      <getKaskoAddPolicesByDatesResult>'.$result.'</getKaskoAddPolicesByDatesResult>
    </getKaskoAddPolicesByDatesResponse>
  </soap12:Body>
</soap12:Envelope>';

 
	
	
	  header("Content-Type: application/soap+xml; charset=utf-8");
	  header('Content-Length: '.strlen($str));
	  echo $str;
	  exit;
	}
	

//$result=$Kasko->getXML(array('agreement_types_id'=>1,'number'=>'202.12.2104388'));
//echo $result;exit;

	$SoapServer->addFunction ('getKaskoPolices');
	$SoapServer->addFunction ('getKaskoPolicesByNumber');
	$SoapServer->addFunction ('getKaskoPolicesByDates');
	
	$SoapServer->addFunction ('getKaskoAddPolices');
	$SoapServer->addFunction ('getKaskoAddPolicesByNumber');
	$SoapServer->addFunction ('getKaskoAddPolicesByDates');
	
	$SoapServer->addFunction ('getDGOPolices');
	$SoapServer->addFunction ('getDGOPolicesByNumber');
	$SoapServer->addFunction ('getDGOPolicesByDates');
	
	$SoapServer->addFunction ('getGOPolices');
	$SoapServer->addFunction ('getGOPolicesByNumber');
	$SoapServer->addFunction ('getGOPolicesByDates');
	
	$SoapServer->addFunction ('getNSPolices');
	$SoapServer->addFunction ('getNSPolicesByNumber');
	$SoapServer->addFunction ('getNSPolicesByDates');
	
	
	$SoapServer->addFunction ('getDMSPolices');
	$SoapServer->addFunction ('getDMSPolicesByNumber');
	$SoapServer->addFunction ('getDMSPolicesByDates');

	$SoapServer->addFunction ('getDSKVPolices');
	$SoapServer->addFunction ('getDSKVPolicesByNumber');
	$SoapServer->addFunction ('getDSKVPolicesByDates');
	
	$SoapServer->addFunction ('getPropertyPolices');
	$SoapServer->addFunction ('getPropertyPolicesByNumber');
	$SoapServer->addFunction ('getPropertyPolicesByDates');
	
	$SoapServer->addFunction ('getDrivePolices');
	$SoapServer->addFunction ('getDrivePolicesByNumber');
	$SoapServer->addFunction ('getDrivePolicesByDates');

	$SoapServer->addFunction ('getDriveGeneralPolices');
	$SoapServer->addFunction ('getDriveGeneralPolicesByNumber');
	$SoapServer->addFunction ('getDriveGeneralPolicesByDates');
	
	$SoapServer->addFunction ('getCargoPolices');
	$SoapServer->addFunction ('getCargoPolicesByNumber');
	$SoapServer->addFunction ('getCargoPolicesByDates');
	
	$SoapServer->addFunction ('getMortagePolices');
	$SoapServer->addFunction ('getMortagePolicesByNumber');
	$SoapServer->addFunction ('getMortagePolicesByDates');

	if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST') {
	     $SoapServer->handle();
	} else {
	     $SoapServer = new SoapServer("polices.wsdl");
		 $SoapServer->handle();
	}
	exit;
?>
