<?php

class Modules_Api
{
	private $_optionsModel;

	public function __construct() {
		$this->_optionsModel = new Models_Option();
	}

	public function findSettings() {
		return $this->_optionsModel->findSiteOptions();
	}
	
	public function findServices() {
		return $this->_optionsModel->findServiceOptions();
	}
	
	public function findProfile($applyMarkdown = false) {
		$profile = $this->_optionsModel->findProfileOptions();
		if ($applyMarkdown) {
			$profile['bio'] = Rome::Markdown($profile['bio']);
		}
		return $profile;
	}
	
	public function findIndexContent() {
		$content = Cache::get(Registry::get('indexCache'));
		if (!$content) {
			$tweets = $this->findTweets();
		
			$content = array_merge(
				$this->_optionsModel->keyValuePair($this->findSettings()),
				$this->_optionsModel->keyValuePair($this->findServices()),
				$this->findProfile(true),
				$this->findThemeOptions(),
				($tweets) ? array('tweets' => $tweets) : array()
			);
			
			Cache::set(
				Registry::get('indexCache'),
				$content,
				Registry::get('indexCacheAge')
			);
		}
		
		return $content;
	}
	
	public function findContentOptions() {
		return $this->_optionsModel->findContentOptions();
	}
	
	public function findContentOption($id, $applyMarkdown = false) {
		return $this->_optionsModel->findById($id);
	}
	
	public function findContentOptionByName($name, $applyMarkdown = false) {
		return $this->_findContent('name = "' . $name . '"', $applyMarkdown);
	}
	
	public function findThemeOptionNames() {
		$names = array_keys(Registry::get('theme_options'));
		return ($names)? $names : array();
	}
	
	public function findThemeOptions($returnFalseIfNotInDatabase = false) {
		if (Registry::get('theme_options')) {
			$names = $this->findThemeOptionNames();
			$themeOptions = Registry::get('theme_options');
			$options = $this->_optionsModel->findThemeOptions($names);
			if (!$options) { // return the defaults
				if ($returnFalseIfNotInDatabase) {
					return false;
				}
				$options = array();
				foreach ($names as $name) {
					$options[$name] = $themeOptions[$name]['default'];
				}
			} else { // we found some in the database, but let's make sure it is all there
				foreach ($names as $name) {
					if (!array_key_exists($name, $options)) {
						$options[$name] = $themeOptions[$name]['default'];
					}
				}
			}
			return $options;
		}
		return array();
	}
	
	public function saveThemeOptions(array $data) {
		$theme = $this->findTheme();
		if ($this->findThemeOptions(true)) { // just update
			return $this->_optionsModel->updateThemeOptions($data, $this->findThemeOptionNames(), $theme);
		} else { // first time save to database
			$options = array();
			foreach ($data as $name=>$value) {
				$options[] = array(
					'name' => $name,
					'value' => $value,
					'themeName' => $theme
				);
			}
			return $this->_optionsModel->saveThemeOptions($options);
		}
	}
	
	protected function _findContent($where, $applyMarkdown) {
		$option = $this->_optionsModel->findWhere($where);
		
		if ($option) {
			$option = ($applyMarkdown)? $this->valueFormat($option) : $option;
			return $option[0];
		}
		return false;
	}
	
	public function valueFormat(array $data) {
		foreach ($data as $key=>$option) {
			if ($option['apply_markdown']) {
				$data[$key]['value'] = Rome::Markdown($option['value']);
			}
		}
	}
	
	public function saveNewContent(array $data) {
		return $this->_optionsModel->saveNewContent($data);
	}
	
	public function updateContent($id, array $data) {
		return $this->_optionsModel->updateContent($id, $data);
	}
	
	public function destroyContent($id) {
		$content = $this->_optionsModel->findById($id);
		if ($content['system'] === 1) {
			return false;
		} else {
			return $this->_optionsModel->destroy($id);
		}
	}
	
	public function updateSettings($settings) {
		return $this->_optionsModel->updateSiteSettings($settings);
	}
	
	public function updateServices($settings) {
		return $this->_optionsModel->updateServices($settings);
	}
	
	public function updateProfile($settings) {
		return $this->_optionsModel->updateProfile($settings);
	}
	
	public function updateTheme($settings) {
		return $this->_optionsModel->updateTheme($settings);
	}
	
	public function findTweets() {
		$tweets = Cache::get(Registry::get('twitterCache'));
		if (!$tweets) {
			$username = $this->_optionsModel->findTwitterUsername();
			
			if (!$username) {
				return array();
			}
			
			$twitter = new Roam_Services_Twitter();
			$tweets = $twitter->find(
				$username,
				Registry::get('twitterNumber'),
				Registry::get('twitterSkipReplies')
			);
			Cache::set(Registry::get('twitterCache'), $tweets, Registry::get('twitterCacheAge'));
		}
		return $tweets;
	}

	public function findTheme() {
		return $this->_optionsModel->findTheme();
	}
	
	public function findThemesList() {
		$directories = glob(Registry::get('ThemesPath') . '*', GLOB_ONLYDIR);
		$themes = array();
		foreach ($directories as $directory) {
			$themes[] = str_replace(Registry::get('ThemesPath'), '', $directory);
		}
		return $themes;
	}
	
	/** destroy the cache! */
	
	//destroy the index cache
	public function destroyIndexCache() {
		return Cache::destroy(Registry::get('indexCache'));
	}
	
	// destroy twitter cache
	public function destroyTwitterCache() {
		return Cache::destroy(Registry::get('twitterCache'));
	}
	
	// kill 'em all!
	public function destroyCache() {
		$this->destroyIndexCache();
		$this->destroyTwitterCache();
	}
	
	// refresh index after updates!
	public function refreshIndex() {
		$this->destroyCache();
		$this->findIndexContent();
	}
}












