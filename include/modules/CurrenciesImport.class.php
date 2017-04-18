<?
/*
 * Title: currency rates class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Currencies.class.php';
require_once 'HTMLSax3/HTMLSax3.php';

class CurrenciesImport {

	var $form		= false;
	var $tr			= false;
	var $span		= false;

	var $data		= array();
	var $tmpData	= array();
	var $date		= null;

	var $codes		= array();

	function CurrenciesImport($data) {
		$this->currencies = Currencies::get();
	}

    function openHandler(&$parser, $name, $attrs) {
		if ($name == 'form' && $attrs['id'] == 'tableForm') {
			$this->form	= true;
		}

		if ($this->form && $name == 'tr') {
			$this->tr	= true;
		}

		if ($this->form && $name='span' && $attrs['class'] == 'h5') {
			$this->span = true;
		}
    }

    function getIdByCode($code) {
    	if (is_array($this->currencies)) {
    		foreach ($this->currencies as $row) {
    			if ($row['code'] == $code) {
    				return $row['id'];
    			}
    		}
    	}
    }

    function closeHandler(&$parser, $name) {
        if ($this->form) {
			switch ($name) {
        		case 'form':
					$this->form = false;
					break;
        		case 'tr':
        			$currencies_id = $this->getIdByCode($this->tempData[2]);

        			if ($currencies_id) {
        				$this->data[ $currencies_id ] = $this->tempData;
        			}

					$this->tempData = array();
					$this->tr		= false;
					break;
        		case 'span':
					$this->span = false;
					break;
			}
		}
    }

    function dataHandler(&$parser, $data) {
		if ($this->tr) {
			$this->tempData[] = $data;
		}

		if ($this->span) {
			if ( strftime('%Y') == substr($data, -4) ) {
				$this->date = substr($data, 6, 4) . '-' . substr($data, 3, 2) . '-' . substr($data, 0, 2);
	    	}
		}
    }

}

?>