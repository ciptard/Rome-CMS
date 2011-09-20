<?php

class Controllers_Login extends Controllers_AppBaseController
{
	protected $_controller = 'login';
	protected $_action = 'index';
	
	public function __construct() {
		$this->_action = Roam::getAction();
		$this->_layout = 'login';
		$this->setTitle('The Login');
		$this->set('loginTitle', Registry::get('loginTitle'));
	}
	
	public function index() {}
	
	/** check submited login */
	public function login() {
		$username = Roam::getParam('username');
		$password = Roam::getParam('password');
		if (Registry::get('Users')->checkLogin($this->_controller, $username, $password)) {
			$this->_redirect('/admin/');
		} else {
			$this->_redirect('/login/');
		}
	}
	
	public function logout() {
		Registry::get('Users')->logout();
		$this->_redirect();
	}
}
