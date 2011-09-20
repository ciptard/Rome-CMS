<?php

class Controllers_Caches extends Controllers_AppBaseController
{
	protected $_controller = 'caches';
	protected $_action = 'index';
	protected $_model;

	public function __construct() {
		$this->_action = Roam::getAction();
		$this->_model = new Models_Cache();
		$this->setTitle('The Cache');
	}
}
