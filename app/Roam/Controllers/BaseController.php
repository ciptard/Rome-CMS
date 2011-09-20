<?php

class Roam_Controllers_BaseController
{
	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_redirect = '';
	protected $_viewData = array();
	protected $_layout = 'layout';
	protected $_layoutPath = 'Views/layout/';
	protected $_renderFile = '';
	protected $_noLayout = false;

	protected function _init() {}
	
	protected function _preDispatch() {}
	
	protected function _postDispatch() {}
	
	public function index() {
		$this->set('data', $this->_model->findAll());
	}

	public function create() {}
	
	public function save() {
		$this->_model->create(Roam::getParams());
		$this->_redirect();
	}
	
	public function edit() {
		$this->set('data', $this->_model->findById(Roam::getId()));
	}
	
	public function update() {
		$this->_model->update(Roam::getId(), Roam::getParams());
		$this->_redirect();
	}
	
	public function delete() {
		if (Roam::getId()) {
			$this->_model->destroy(Roam::getId());
		}
		$this->_redirect();
	}
	
	public function set($key, $value) {
		$this->_viewData[$key] = $value;
		return $this;
	}
	
	public function setTitle($title) {
		$this->set('sectionTitle', $title);
	}
	
	public function deploy() {
		if (!method_exists($this, $this->_action) || substr($this->_action, 0, 1) == '_') {
			Roam::error('/notfound/');
		}
		
		$this->_init();
		$this->_preDispatch();
				
		call_user_func_array(array($this, $this->_action), array());
		
		if (in_array($this->_action, array('create', 'edit'))) {
			$this->set('formAction', ($this->_action == 'edit')? 'update' : 'save');
		}
		
		$this->_render();
		$this->_postDispatch();
		
		if (Registry::get('debug')) {
			$this->_debugInfo();
		}
	}
	
	protected function _setRenderFile($file) {
		$this->_renderFile = $file;
	}
	
	protected function _setLayoutPath($layoutPath) {
		Roam::$layoutPath = $layoutPath;
	}
	
	protected function _setViewsPath($viewsPath) {
		Roam::$viewsPath = $viewsPath;
	}
	
	protected function _render() {
		Roam::render(
			($this->_renderFile)? $this->_renderFile : $this->_controller . '/' . $this->_action,
			$this->_viewData,
			$this->_layout,
			$this->_noLayout
		);
	}
	
	protected function _redirect($path = '') {
		Roam::redirect(($path)? $path
			: (($this->_redirect)? $this->_redirect : '/' . $this->_controller . '/'));
	}
	
	protected function _debugInfo() {
		print "<div style='border:1px solid #ccc; background:#eee; color:#000; padding:20px; margin-top:20px; text-align:left;'>";
		print "<b>Controller: </b>" . $this->_controller . "<br />";
		print "<b>Action: </b>" . $this->_action . "<br />";
		
		print "<pre>Cookie: ";
		print_r($_COOKIE);
		print "</pre>";
		
		print "<pre>Params: ";
		print_r(Roam::getParams());
		print "</pre>";
		
		Roam::printRoute();
		
		print "<pre>Views Data: ";
		print_r($this->_viewData);
		print "</pre>";
		
		print "</div>";
	}
}




