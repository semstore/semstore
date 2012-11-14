<?php


class CURL {
  	var $callback = false;

	function setCallback($func_name) {
	$this->callback = $func_name;
	}
	
	function doRequest($method, $url, $vars,  $httpheaders = 1, $headers = 1 , $cookiejar = '', $useragent = 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.14) Gecko/20080418 Ubuntu/7.10 (gutsy) Firefox/2.0.0.14' ) {
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, $headers);
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		if ( $httpheaders !== 1 )
		{
		   
		   curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheaders);
		}
		
		
		if ( $cookiejar != '' )
		{
		   curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiejar);
		   curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiejar);
		}
		
		
		if ($method == 'POST') {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
		}
		
		$data = curl_exec($ch);
		//curl_close($ch);
		if ($data) {
			if ($this->callback)
			{
				$callback = $this->callback;
				$this->callback = false;
				return call_user_func($callback, $data);
			} else {
				return $data;
			}
		} else {
			return curl_error($ch);
		}
	}
	
	function get($url) {
		return $this->doRequest('GET', $url, 'NULL');
	}
	
	function post($url, $vars) {
		return $this->doRequest('POST', $url, $vars);
	}
}

 
?>