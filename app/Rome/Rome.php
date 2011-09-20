<?php

/**
 * Base static class to provide convience functions to template authors
 * @author TJ Eastmond <tj.eastmond@gmail.com>
 */

class Rome
{
	static protected $_api;
	
	static protected function _getApi() {
		if (!self::$_api) {
			self::$_api = new Modules_Api();
		}
		return self::$_api;
	}
	
	static public function getThemePath() {
		return Registry::get('themePath');
	}
	
	// return JS code if a google analytics id is passed in
	static public function googleAnalytics($id = '') {
		$content = '';
		if ($id) {
			$content = "<script type='text/javascript'>"
					 . "var _gaq = _gaq || [];"
					 . "_gaq.push(['_setAccount', '" . $id . "']);"
					 . "_gaq.push(['_trackPageview']);"
					 . "(function() {"
					 . "var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;"
					 . "ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';"
					 . "var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);"
					 . "})();"
					 . "</script>";
		}
		return $content;
	}
	
	// wrapper for Roam Framework's partial method
	static public function partial($file, array $elements = array()) {
		return Roam::partial($file, $elements);
	}
	
	static public function Markdown($string) {
		return Markdown($string);
	}
	
	static public function getContent($name, $applyMarkdown = 0) {
		$option = self::_getApi()->findContentOptionByName($name);
		if (!$option) {
			return '';
		}
		return ($applyMarkdown)? self::Markdown($option['value']) : $option['value'];
	}
}
