<?php

/**
 * Incomplete
 * Todo:
 *	- write todo :P
 */

Class Roam_Session
{
	protected $_flash = '';
	protected $_errorMsg = '';
	protected $_error = '';

	public function __construct() {
		session_start();
	}
	
	public function flash($msg) {
		$this->_flash = $msg;
		$_SESSION['flash'] = $msg;
		return $this;
	}
	
	public function getFlash() {
		return ($_SESSION['flash'])? $_SESSION['flash'] : false;
	}
	
	public function clearFlash() {
		$_SESSION['flash'] = '';
	}
	
	public function set($name, $value) {
		$_SESSION[$name] = $value;
	}
	
	public function get($name) {
		return ($_SESSION[$name])? $_SESSION[$name] : false;
	}
}

