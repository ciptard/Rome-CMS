<?php

class Controllers_Modal extends Controllers_AppBaseController
{
	protected $_controller = 'modal';
	protected $_action = 'index';
	protected $_api;

	public function __construct() {
		$this->_action = Roam::getAction();
		$this->_layout = 'modal';
		$this->_api = new Modules_Api();
	}
	
	public function index() {
		$this->set('settings', $this->_api->findProfile());
	}
}
