<?php

class Models_Option extends Models_AppBaseModel
{
	protected $_table = 'Options';
	protected $_idName = 'option_id';
	
	protected $_siteOptions = array(
		'theme',
		'site_title',
		'meta_description',
		'meta_keywords',
		'copyright',
		'google_analytics'
	);
	
	protected $_serviceOptions = array(
		'linkedin_url',
		'facebook_url',
		'tumblr_url'
	);
	
	protected $_profileOptions = array('name', 'email', 'twitter_username', 'tagline', 'bio');
	
	protected function _findValue($name) {
		$value = $this->findBy('name', $name);
		return ($value)? $value[0]['value'] : false;
	}
	
	public function findTwitterUsername() {
		return $this->_findValue('twitter_username');
	}
	
	public function findTheme() {
		$template = $this->_findValue('theme');
		return ($template)? $template : 'default';
	}
	
	public function findSiteOptions() {
		return $this->findWhere($this->_implodeIn($this->_siteOptions, 'name'));
	}
	
	public function findServiceOptions() {
		return $this->findWhere($this->_implodeIn($this->_serviceOptions, 'name'));
	}

	public function findProfileOptions() {
		$options = $this->keyValuePair(
			$this->findWhere($this->_implodeIn($this->_profileOptions, 'name'))
		);
		return $options;
	}
	
	public function findThemeOptions(array $names) {
		$options = $this->findWhere($this->_implodeIn($names, 'name'));
		return ($options)? $this->keyValuePair($options) : false;
	}
	
	public function findContentOptions() {
		return $this->findWhere('system = 0 and themeName=""');
	}
	
	protected function _implodeIn(array $options, $key) {
		return $key . " in ('" . implode("','", $options) . "')";
	}
	
	public function saveNewContent(array $data) {
		return $this->create($data);
	}
	
	public function updateContent($id, array $data) {
		$this->update($id, $data);
	}
	
	public function updateSiteSettings(array $settings) {
		return $this->_updateSettings($settings, $this->_siteOptions);
	}

	public function updateServices(array $settings) {
		return $this->_updateSettings($settings, $this->_serviceOptions);
	}
	
	public function updateProfile(array $settings) {
		return $this->_updateSettings($settings, $this->_profileOptions);
	}
	
	public function updateTheme(array $settings) {
		return $this->_updateSettings($settings, array('theme'));
	}
	
	public function saveThemeOptions(array $data) {
		$this->startTrans();
		foreach ($data as $option) {
			$this->create($option);
		}
		$this->completeTrans();
		return true;
	}
	
	public function updateThemeOptions(array $settings, array $check, $themeName) {
		return $this->_updateSettings($settings, $check, $themeName);
	}
	
	private function _updateSettings(array $settings, array $check, $themeName = '') {
		$this->startTrans();
		$themeSql = ($themeName)? ' and themeName = "' . $themeName . '"' : '';
		foreach ($settings as $setting => $value) {
			$value = Database::escapeString($value);
			if (in_array($setting, $check)) {
				$sql = "update " . $this->_table . " set value = '" . $value
					 . "' where name ='" . $setting . "'" . $themeSql;
				Database::execute($sql);
			}
		}
		$this->completeTrans();
		return true;
	}
	
	public function keyValuePair(array $options) {
		$data = array();
		foreach ($options as $option) {
			$data[$option['name']] = $option['value'];
		}
		return $data;
	}
}


