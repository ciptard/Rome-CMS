<?php

class Controllers_Options extends Controllers_AppBaseController
{
	protected $_controller = 'options';
	protected $_action = 'index';
	protected $_model;

	public function __construct() {
		$this->_action = Roam::getAction();
		$this->_model = new Models_Option();
		$this->setTitle('Your Options - Be Careful Here');
	}
}
