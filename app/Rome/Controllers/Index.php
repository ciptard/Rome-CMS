<?php

class Controllers_Index extends Controllers_AppBaseController
{
	protected $_controller = 'index';
	protected $_action = 'index';
	protected $_content;
	
	public function __construct() {
		$this->_action = Roam::getAction();
	}
	
	protected function _preDispatch() {
		// set theme path
		$this->_setViewsPath(Registry::get('currentThemePath'));

		// set the template content
		if (in_array($this->_action, array('index', 'notfound'))) {
			$this->_setSiteContent();
		}
	}
	
	protected function _postDispatch() {
		// debug for templates
		if (Registry::get('RomeDebug')) {
			print "<div style='border:1px solid #ccc; background:#eee; color:#000; padding:20px; margin-top:20px; text-align:left;'>";
			print "<pre>Content Variables: ";
			print_r($this->_content);
			print "</pre>";
			print "</div>";
		}
	}
	
	// index page
	public function index() {}
	
	// 404 (not found)
	public function notfound() {}
	
	protected function _setSiteContent() {
		// get the index page content
		$this->_content = $this->_api->findIndexContent();
		
		// set the data up for template use
		foreach ($this->_content as $name=>$value) {
			$this->set($name, $value);
		}
	}
}
