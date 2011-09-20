<?php

class Controllers_AppBaseController extends Roam_Controllers_BaseController
{
	protected $_api;

	public function _init() {
		$this->_api = new Modules_Api();
		$this->set('controller', $this->_controller);
		$this->set('action', $this->_action);
		$this->set('environment', Registry::get('Environment'));
		
		$currentTheme = $this->_api->findTheme();		
		Registry::set('theme', $currentTheme);
		Registry::set('currentThemePath', Registry::get('ThemesPath') . $currentTheme . '/');
		Registry::set('themePath', Registry::get('PublicThemePath') . $currentTheme . '/');
		if (Roam::doesFileExist(Registry::get('currentThemePath') . 'Config.php')) {
			require_once Registry::get('currentThemePath') . 'Config.php';
			$this->set('enableThemeOptionsNav', 1);
		}
		
		Registry::set('Users', new Modules_Users());
		
		if (!Registry::get('Users')->checkLogin($this->_controller)) {
			$this->_redirect('/login/');
		}
		
		if (!Registry::get('Users')->checkAccess($this->_controller, $this->_action)) {
			$this->_redirect('/admin/');
		}
		
		if (!in_array($this->_controller, array('index', 'login'))) {
			$this->set('loginName', H::humanTitle(Registry::get('Users')->username()));
			$this->set('isAdmin', (Registry::get('Users')->isAdmin())? 1 : 0);
			$this->_setLinks();
		}
	}

	protected function _setLinks() {
		$active = '';
		if ($this->_controller === 'admin') {
			switch ($this->_action) {
				case 'settings':
					$active = 'settings';
					break;
				case 'profile':
				case 'services':
				case 'content':
				case 'newcontent':
				case 'editcontent':
					$active = 'profile';
					break;
				case 'themeoptions':
					$active = 'themeoptions';
					break;
				default:
					$active = 'admin';
			}
		}
		$this->set('activeNav', $active);
	}
}



