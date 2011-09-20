<?php

/** Google Weather API */

class Roam_Services_Weather extends Roam_Services_BaseService
{
	public function __construct() {}
	
	public function setZipCode($zipcode) {
		$this->_zipCode = $zipcode;
		return $this;
	}

	public function findForZip($zipcode) {
		if ($this->_data[$zipcode]) {
			return $this->_data[$zipcode];
		}
	
		$this->_makeCurlCall('http://www.google.com/ig/api?weather=' . $zipcode);
		$xml = simplexml_load_string($this->_rawData);
		
		$icon = $this->_icon((string) $xml->weather->current_conditions->icon['data']);
		
		$this->_data[$zipcode]['currentConditions'] = array(
			'city' => (string) $xml->weather->forecast_information->city['data'],
			'postal_code' => (string) $xml->weather->forecast_information->postal_code['data'],
			'condition' => (string) $xml->weather->current_conditions->condition['data'],
			'temp' => (string) $xml->weather->current_conditions->temp_f['data'],
			'humidity' => (string) $xml->weather->current_conditions->humidity['data'],
			'icon' => $icon
		);
		
		foreach ($xml->weather->forecast_conditions as $day) {
			$key = strtolower((string) $day->day_of_week['data']);
			$this->_data[$zipcode]['days'][$key] = array(
				'low' => (string) $day->low['data'],
				'high' => (string) $day->high['data'],
				'condition' => (string) $day->condition['data'],
				'icon' => $this->_icon((string) $day->icon['data'])
			);
		}
		
		return $this->_data[$zipcode];
	}
	
	protected function _icon($string) {
		return str_replace(array('.gif', '/ig'), array('.png', ''), $string);
	}
}












