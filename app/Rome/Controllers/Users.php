<?php

class Controllers_Users extends Controllers_AppBaseController
{
	protected $_controller = 'users';
	protected $_action = 'index';
	protected $_model;
	
	public function __construct() {
		$this->_action = Roam::getAction();
		$this->_model = new Models_User();
		$this->setTitle('Your Users');
	}
	
	public function resetpassword() {
		$user = $this->_model->findUser(Roam::getId());
		$this->set('data', $user );
		$this->setTitle("Reset " . $user['firstname'] . "'s Password");
	}
	
	public function makeadmin() {
		$this->_model->makeAdmin(Roam::getId());
		$this->_redirect();
	}
	
	public function makeuser() {
		$this->_model->makeUser(Roam::getId());
		$this->_redirect();
	}

	public function enable() {
		$this->_model->enable(Roam::getId());
		$this->_redirect();
	}
	
	public function disable() {
		$this->_model->disable(Roam::getId());
		$this->_redirect();
	}
}
