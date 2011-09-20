<?php

class Controllers_Admin extends Controllers_AppBaseController
{
	protected $_controller = 'admin';
	protected $_action = 'index';
	
	protected $_api;
	
	public function __construct() {
		$this->_action = Roam::getAction();
		$this->_api = new Modules_Api();
	}
	
	public function index() {
		$this->setTitle('Your Admin Area');
	}
	
	protected function _preDispatch() {
		if (in_array($this->_action, array('newcontent', 'editcontent'))) {
			$this->set(
				'formAction',
				($this->_action == 'newcontent')? 'savenewcontent' : 'updatecontent'
			);
		}
		
		if (in_array($this->_action, array('newcontent', 'editcontent', 'content'))) {
			$this->setTitle('Your Custom Content');
		}
	}

	/** settings */
	
	public function settings() {
		$this->setTitle('Your Site Settings');
		$this->set('settings', $this->_api->findSettings());
		$this->set('themesList', $this->_api->findThemesList());
	}
	
	public function updatesettings() {
		$this->_api->updateSettings(Roam::getParams());
		$this->_refresh();
	}
	
	/** services */
	
	public function services() {
		$this->setTitle('Your Links');
		$this->set('settings', $this->_api->findServices());
	}

	public function updateservices() {
		$this->_api->updateServices(Roam::getParams());
		$this->_refresh();
	}
	
	/** profile */
	
	public function profile() {
		$this->setTitle('Your Profile');
		$this->set('settings', $this->_api->findProfile());
	}
	
	public function updateprofile() {
		$this->_api->updateProfile(Roam::getParams());
		$this->_refresh();
	}
	
	public function themeoptions() {
		$this->setTitle('Your Theme Specific Options');
		$this->set('settings', $this->_api->findThemeOptions());
		$this->set('themeOptions', Registry::get('theme_options'));
	}
	
	public function updatethemeoptions() {
		$this->_api->saveThemeOptions(Roam::getParams());
		$this->_refresh();
	}
	
	public function content() {
		$this->set('data', $this->_api->findContentOptions());
	}
	
	public function newcontent() {}
	
	public function savenewcontent() {
		$this->_api->saveNewContent(Roam::getParams());
		$this->_refresh('/admin/content/');
	}
	
	public function editcontent() {
		$this->set('data', $this->_api->findContentOption(Roam::getId()));
	}
	
	public function updatecontent() {
		$this->_api->updateContent(Roam::getId(), Roam::getParams());
		$this->_redirect('/admin/content/');
	}
	
	public function destroycontent() {
		$this->_api->destroyContent(Roam::getId());
		$this->_redirect('/admin/content/');
	}
	
	public function refresh() {
		$this->_refresh('/caches/');
	}
	
	public function destroycache() {
		$this->_api->destroyCache();
		$this->_redirect('/caches/');
	}
	
	// update the index, then redirect the user to admin page
	protected function _refresh($path = '/admin/') {
		$this->_api->destroyCache();
		$this->_api->findIndexContent();
		$this->_redirect($path);
	}
}
















