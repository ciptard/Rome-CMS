<?php

class Roam_Services_BaseService
{
	protected $_data = array();
	protected $_rawData = '';
	
	protected function _makeCurlCall($url) {
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
		$this->_rawData = curl_exec($ch);
		curl_close ($ch);
		return $this;
	}
	
	public function __get($key) {
		return (array_key_exists($key, $this->_data))? $this->_data[$key] : 'false';
	}
	
	public function getData() {
		return $this->_data;
	}

}
