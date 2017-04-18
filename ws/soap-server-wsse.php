<?php  

require('xmlseclibs.php'); 
//http://www.microsoft.com/en-us/download/confirmation.aspx?id=14089

class WSSESoapUserToken
{
	public $userName = '';
	public $passwordType;
	public $password = '';
	public $Nonce = '';
	public $Created = '';

	public function __construct()
	{
		$this->userName = '';
		$this->passwordType = '';
		$this->password = '';
		$this->Nonce = '';
		$this->Created = '';
	}
};
// INSAD: End of changes by A.J.W. van Peppen

class WSSESoapServer { 
    const WSSENS = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'; 
    const WSSENS_2003 = 'http://schemas.xmlsoap.org/ws/2003/06/secext'; 
    const WSUNS = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd'; 
    const WSSEPFX = 'wsse'; 
    const WSUPFX = 'wsu'; 
    const WSUNAME = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0'; 

    private $soapNS, $soapPFX; 
    private $soapDoc = NULL; 
    private $envelope = NULL; 
    private $SOAPXPath = NULL; 
    private $secNode = NULL; 
    public $signAllHeaders = FALSE; 
	public $userToken = NULL;

    private function locateSecurityHeader($setActor=NULL) { 
        $wsNamespace = NULL; 
        if ($this->secNode == NULL) { 
            $headers = $this->SOAPXPath->query('//wssoap:Envelope/wssoap:Header'); 
            if ($header = $headers->item(0)) { 
                $secnodes = $this->SOAPXPath->query('./*[local-name()="Security"]', $header); 
                $secnode = NULL; 
                foreach ($secnodes AS $node) { 
                    $nsURI = $node->namespaceURI; 
                    if (($nsURI == self::WSSENS) || ($nsURI == self::WSSENS_2003)) { 
                        $actor = $node->getAttributeNS($this->soapNS, 'actor'); 
                        if (empty($actor) || ($actor == $setActor)) { 
                            $secnode = $node; 
                            $wsNamespace = $nsURI; 
                            break; 
                        } 
                    } 
                } 
            } 
            $this->secNode = $secnode; 
        } 
        return $wsNamespace; 
    } 

    public function __construct($doc) { 
        $this->soapDoc = $doc; 
        $this->envelope = $doc->documentElement; 
        $this->soapNS = $this->envelope->namespaceURI; 
        $this->soapPFX = $this->envelope->prefix; 
        $this->SOAPXPath = new DOMXPath($doc); 
        $this->SOAPXPath->registerNamespace('wssoap', $this->soapNS); 
        $this->SOAPXPath->registerNamespace('wswsu', WSSESoapServer::WSUNS); 
        $wsNamespace = $this->locateSecurityHeader(); 
        if (! empty($wsNamespace)) { 
            $this->SOAPXPath->registerNamespace('wswsse', $wsNamespace); 
        } 
    } 

// Authentication function; should be pure virtual.
// For now build implementation which denies access for all users
function AuthenticateUsertoken()
{
	if ($this->userToken) {
		// Test user and authentication is valid
		
		// Data in:
		//		- $this->userToken->userName
		//		- $this->userToken->passwordType
		//		- $this->userToken->password
		//		- $this->userToken->Nonce
		//		- $this->userToken->Created

			// Retrieve (from a database or something) and check user info
			$databaseUsr = 'assistance';
			$databasePwd = 'E4f5tge5Ds1';
			if ($this->userToken->userName != $databaseUsr) {	// eg. user not found in database
				return FALSE;
			}

		// Check Password - Switch on Type:
		switch ($this->userToken->passwordType) {
			case WSSESoapServer::WSUNAME."#PasswordDigest":
				// Use Digest for testing
				// Sample for Digest testing:
				//		$databasePwd = password for this user in plain text
						$tstPwd = base64_encode(sha1(base64_decode($this->userToken->Nonce).$this->userToken->Created.$databasePwd, true)); 
						return ($tstPwd == $this->userToken->password);
				break;
			//case WSSESoapServer::WSUNAME."#PasswordText":	// Default action
			default:	// Default is plain text
				// Use Password in plain text checking
				// Sample for Text testing:
				//		$databasePwd = password for this user in plain text
						return ($databasePwd == $this->userToken->password);
				break;
		}
	}
	return FALSE;		// FALSE: Authorisation failed
}
	// Read and check Timestamp
	public function processTimestamp($refNode)
	{
		//// Get Created time -- Not required right now :)
		//$query = '//wswsu:Created';
		//$nodeset = $this->SOAPXPath->query($query);
		//if ($encmeth = $nodeset->item(0)) {
		//	$Created = $encmeth->textContent;
		//}

		// Get Expires time. When not given then never expires.
		$Expires = '';
		$query = '//wswsu:Expires';
		$nodeset = $this->SOAPXPath->query($query);
		if ($encmeth = $nodeset->item(0)) {
			$Expires = $encmeth->textContent;
		}

		if (empty($Expires)) {				// Never expires
			return TRUE;
		}

		if (time() > strtotime($Expires)) {				// Timestamp expired?
			throw new Exception("Timestamp expired.");
			//$server->fault('401',"Timestamp expired.");
		}
		return TRUE;
	}
	// Read and authenticate usertoken
	public function processUsernameToken($refNode)
	{               
		if ($this->userToken == NULL)	{
			$this->userToken = new WSSESoapUserToken();
		}

		// Get Username
		$query = '//wswsse:Username';
		$nodeset = $this->SOAPXPath->query($query);
		if ($encmeth = $nodeset->item(0)) {
			$this->userToken->userName = $encmeth->textContent;
		}

		// Get Password -- Get Type as well (WSSESoapServer::WSUNAME."#PasswordText"/WSSESoapServer::WSUNAME."#PasswordDigest")
		$query = '//wswsse:Password';
		$nodeset = $this->SOAPXPath->query($query);
		if ($encmeth = $nodeset->item(0)) {
			$this->userToken->passwordType = $encmeth->getAttribute("Type");
			$this->userToken->password = $encmeth->textContent;
		}

		// Get Nonce
		$query = '//wswsse:Nonce';
		$nodeset = $this->SOAPXPath->query($query);
		if ($encmeth = $nodeset->item(0)) {
			$this->userToken->Nonce = $encmeth->textContent;
		}

		// Get Created time
		$query = '//wswsu:Created';
		$nodeset = $this->SOAPXPath->query($query);
		if ($encmeth = $nodeset->item(0)) {
			$this->userToken->Created = $encmeth->textContent;
		}

		if (!$this->AuthenticateUsertoken()) {				// Authentication failed.
			throw new Exception("Authentication failed for user '".$this->userToken->userName."'.");
			//$server->fault('401',"Incorrect username and password combination.");
		}
		return TRUE;
	}

    public function processSignature($refNode) { 
        $objXMLSecDSig = new XMLSecurityDSig(); 
        $objXMLSecDSig->idKeys[] = 'wswsu:Id'; 
        $objXMLSecDSig->idNS['wswsu'] = WSSESoapServer::WSUNS; 
        $objXMLSecDSig->sigNode = $refNode; 

        /* Canonicalize the signed info */ 
        $objXMLSecDSig->canonicalizeSignedInfo(); 

        $retVal = $objXMLSecDSig->validateReference(); 

        if (! $retVal) { 
            throw new Exception("Validation Failed"); 
        } 

        $key = NULL; 
        $objKey = $objXMLSecDSig->locateKey(); 

        if ($objKey) { 
            if ($objKeyInfo = XMLSecEnc::staticLocateKeyInfo($objKey, $refNode)) { 
                /* Handle any additional key processing such as encrypted keys here */ 
            } 
        } 

        if (empty($objKey)) { 
            throw new Exception("Error loading key to handle Signature"); 
        } 
        do { 
            if (empty($objKey->key)) { 
                $this->SOAPXPath->registerNamespace('xmlsecdsig', XMLSecurityDSig::XMLDSIGNS); 
                $query = "./xmlsecdsig:KeyInfo/wswsse:SecurityTokenReference/wswsse:Reference"; 
                $nodeset = $this->SOAPXPath->query($query, $refNode); 
                if ($encmeth = $nodeset->item(0)) { 
                    if ($uri = $encmeth->getAttribute("URI")) { 
                        $arUrl = parse_url($uri); 
                        if (empty($arUrl['path']) && ($identifier = $arUrl['fragment'])) { 
                            $query = '//wswsse:BinarySecurityToken[@wswsu:Id="'.$identifier.'"]'; 
                            $nodeset = $this->SOAPXPath->query($query); 
                            if ($encmeth = $nodeset->item(0)) { 
                                $x509cert = $encmeth->textContent; 
                                $x509cert = str_replace(array("\r", "\n"), "", $x509cert); 
                                $x509cert = "-----BEGIN CERTIFICATE-----\n".chunk_split($x509cert, 64, "\n")."-----END CERTIFICATE-----\n"; 
                                $objKey->loadKey($x509cert); 
                                break; 
                            } 
                        } 
                    } 
                } 
                throw new Exception("Error loading key to handle Signature"); 
            } 
        } while(0); 

        if (! $objXMLSecDSig->verify($objKey)) { 
            throw new Exception("Unable to validate Signature"); 
        } 

        return TRUE; 
    } 

    public function process() {        
        if (empty($this->secNode)) { 
            return; 
        } 
		$isvalid = false;
//_dump_file($this->secNode);
        $node = $this->secNode->firstChild; 
        while ($node) { 
            $nextNode = $node->nextSibling; 
//_dump_file($node->localName);
            switch ($node->localName) { 
                		case "Signature": 
                		    if ($this->processSignature($node)) { 
                        		if ($node->parentNode) { 
		                            $node->parentNode->removeChild($node); 
        		                } 
								$isvalid = true;
                		    } else { 
                        		/* throw fault */ 
		                        return FALSE; 
        		            } 
							break;
						case "UsernameToken":									// UsernameToken processing
							if ($this->processUsernameToken($node)) { 
								if ($node->parentNode) { 
									$node->parentNode->removeChild($node); 
								} 
								$isvalid = true;
							}
							else { 
								/* throw fault */ 
								return FALSE; 
							} 
							break;
						case "Timestamp":									// Timestamp processing
							if ($this->processTimestamp($node)) { 
								if ($node->parentNode) { 
									$node->parentNode->removeChild($node); 
								} 
							}
							else { 
								/* throw fault */ 
								return FALSE; 
							} 
							break;
						
            } 
            $node = $nextNode; 
        } 
        $this->secNode->parentNode->removeChild($this->secNode); 
        $this->secNode = NULL; 
        return $isvalid; 
    } 
     
    public function saveXML() { 
        return $this->soapDoc->saveXML(); 
    } 

    public function save($file) { 
        return $this->soapDoc->save($file); 
    } 
} 

?>