<?php

class Registry
{
	static private $_register = array();
	
	// set something into the registry
	static public function set($name, $value) {
		self::$_register[$name] = $value;
	}
	
	// get something from the registry
	static public function get($name) {
		return self::_isset($name);
	}
	
	// is it already in the directory?
	static private function _isset($name) {
		if(array_key_exists($name, self::$_register)) {
			return self::$_register[$name];
		}
		return false;
	}
}

