<?php

class Modules_Users
{
	private $_perms = array();
	private $_controllersToIgnore = array('login', 'index', 'api');

	public function __construct() {
		$this->_perms = array(
			'admin' => array('all'),
			'user' => array('admin' => array('all'))
		);
	}

	// make sure they are logged in
	public function checkLogin($controller, $username = "", $password = "") {
		// trying to login
		if ($username && $password) {
			$userModel = new Models_User();
			$user = $userModel->findByUserName($username);
			
			// i hashed the password before submitting the form
			if (($username == $user['username'] && $password == $user['password']) && $user['status'] == 1) {
				$this->login(array(
					'username' => $user['username'],
					'password' =>$user['password'],
					'userId' =>$user['user_id'],
					'admin' => $user['admin']
				));
				return true;
			}
			return false;
		}
	
		// not really logged in, but we let them through anyways
		if (in_array($controller, $this->_controllersToIgnore)) {
			return true;
		}
	
		if (array_key_exists(Registry::get('cookieName'), $_COOKIE)) {
			list($username, $hash) = explode(':', $_COOKIE[Registry::get('cookieName')]);
			$userModel = new Models_User();
			$user = $userModel->findByUserName($username);			
			if (($user && $hash === self::createUserHash($user['username'], $user['password'])) and $user['status'] == 1) {
				return true;
			}
		}
		
		return false;
	}
	
	// make sure they have the proper permissions
	public function checkAccess($controller, $action) {
		$userLevel = ($this->isAdmin())? 'admin' : 'user';
		return ($this->_access($userLevel, $controller, $action))? true : false;
	}

	public function createUserHash($username, $password) {
		return md5($username . $password);
	}
	
	public function isAdmin() {
		if (array_key_exists(Registry::get('adminCookie'), $_COOKIE)) {
			if ($_COOKIE[Registry::get('adminCookie')] == 1) {
				return true;
			}
		}
		return false;
	}
	
	public function userId() {
		return ($_COOKIE['user_id'])? intval($_COOKIE['user_id']) : false;
	}
	
	public function username() {
		return ($_COOKIE['username'])? $_COOKIE['username'] : false;
	}
	
	// cookieData = [username, password, admin, userId, name]
	public function login(array $cookieData) {
		return $this->setCookies($cookieData);
	}
	
	public function logout() {
		return $this->setCookies(array(), true);
	}
	
	public function setCookies(array $cookieData, $unset = false) {
		extract($cookieData);
		$cookie = ($unset)? "" : $username . ':' . $this->createUserHash($username, $password);
		$this->_cookie(Registry::get('cookieName'), $cookie, $unset)
			 ->_cookie(Registry::get('adminCookie'), $admin, $unset)
			 ->_cookie('username', $username, $unset)
			 ->_cookie('user_id', $userId, $unset);
		return true;
	}
	
	private function _cookie($name, $value, $unset = false, $domain = '/') {
		$time = strtotime(($unset)? Registry::get('cookieTime') : time() - 3600);
		$cookie = setcookie($name, $value, $time, $domain);
		return $this;
	}
	
	private function _access($userLevel, $controller, $action) {
		if (in_array($controller, $this->_controllersToIgnore)) { // let 'em login
			return true;
			exit;
		}
	
		if (array_key_exists($userLevel, $this->_perms)) { // not a fake user level
			if ($this->_perms[$userLevel][0] == 'all') { // super user?!
				return true;
			}
			
			if (array_key_exists($controller, $this->_perms[$userLevel])) { // controller access ok
				if ($this->_perms[$userLevel][$controller][0] == 'all') { // all actions ok
					return true;
				}
				
				// at this point they either have access or not...
				return (in_array($action, $this->_perms[$userLevel][$controller]))? true : false;
			}
		}
		
		// found nothing. no access for you!
		return false;
	}
}
