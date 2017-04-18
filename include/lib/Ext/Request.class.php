<?
/*
 * Title: request class
 *
 * @author Eugene Cherkassky
 * @version 3.0
 */

class Request {
	var $host		= '';
	var $query		= '';
	var $port		= 80;
	var $content	= '';

	function Request($url, $data, $method) {
		$this->port		= 80;
		$this->url		= $url;
		$this->data		= $data;
		$this->method	= $method;

		$this->setShema();
		$this->setPrefix();
		$this->setHost();
		$this->setPath();
		$this->setQuery();
		$this->setContent();
	}

	function parceURL($url, $part) {
		$result = parse_url($url);
		return $result[ $part ];
	}

	function setShema() {
		$this->schema = $this->parceURL($this->url, 'schema');
	}

	function setPrefix() {
		if ($this->schema == 'https') {
			$this->prefix = 'ssl://';
		}
	}

	function setHost() {
		$this->host = $this->parceURL($this->url, 'host');
	}

	function setPath() {
		$this->path = $this->parceURL($this->url, 'path');
	}

	function setQuery() {
		$this->query = $this->parceURL($this->url, 'query');
	}

	function setContent() {
		$body = 'cmd=_notify-validate';

		foreach($this->data as $key => $value) {
			if ($body) {
				$body .= '&';
			}
			$body .= $key . '=' . urlencode($value); 
		}

		$length = strlen($body);

		$this->content	= 	"POST " . $this->path . " HTTP/1.1\r\n" . 
							"Host: " . $this->host . "\n" . 
							"User-Agent: Mozilla/4.0\r\n" . 
							"Content-Type: application/x-www-form-urlencoded\r\n" . 
							"Content-Length: " . $length . "\r\n\r\n" . 
							$body . "\r\n";
	}

	function send() {
		$result = '';

		$socket = sockopen($this->prefix . $this->host, $this->port, $result['errno'], $result['errstr']);

		if ($socket) {
			fputs($socket, $this->content);

			while (!feof($socket)) {
				$result[] = fgets($socket, 4096);
			}

			fclose($socket);
		}

		return $result;
	}
}

?>