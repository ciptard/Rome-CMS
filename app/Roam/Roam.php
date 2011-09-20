<?php

class Roam
{
	static private $_route = array();
	static private $_controller = 'index';
	static private $_action = 'index';
	static private $_id = '';
	
	static public $viewsPath = 'Views/';
	static public $layoutPath = 'layout/';
	
	static public $_customRoutes = array();

	static public function getAction() {
		return self::$_action;
	}
	
	static public function getController() {
		return self::$_controller;
	}
	
	static public function clean($clean) {
		if (!$clean) { // nothing to clean
			return true;
		}
	
		if (is_array($clean)) {
			$cleaned = array();
			foreach ($clean as $key=>$value) {
				$cleaned[$key] = self::paranoid($value);
			}
			return $cleaned;
		}
		return self::paranoid($clean);
	}
	
	static public function paranoid($string) {
		return strip_tags($string, '<p><a><b><strong><ul><li><img>');
	}
	
	// sanitize
	static public function getParams() {
		return self::clean(array_merge($_GET, $_POST));
	}
	
	// sanatize
	static public function getParam($param) {
		return ($_REQUEST[$param])? self::clean($_REQUEST[$param]) : false;
	}
	
	// sanatize
	static public function getId() {
		return (self::$_id)? intval(self::$_id) : (
			(self::getParam('id'))? intval(self::getParam('id')) : false
		);
	}
	
	static public function classNameToFileName($className) {
		return str_replace('_', '/', $className) . '.php';
	}
	
	static public function doesFileExist($file) {
		$paths = explode(":", ini_get('include_path'));
		foreach ($paths as $path) {
			if (file_exists($path . '/' . $file)) {
				return true;
			}
		}
		if (file_exists($file)) {
			return true;
		}
		return false;
	}
	
	static function doesControllerExist($controller) {
		$c = 'Controllers_' . ucfirst($controller);
		return (self::doesFileExist(self::classNameToFileName($c)))? $c : false;
	}
	
	static public function layoutPath() {
		return self::$viewsPath . self::$layoutPath;
	}
	
	static public function viewsPath() {
		return self::$viewsPath;
	}
	
	static public function render($file, array $elements = array(), $layout = 'layout', $noLayout = false) {
		$content = self::_output(self::viewsPath() . $file . '.php', $elements);
		print ($noLayout)? $content : self::_output(
			self::layoutPath() . $layout . '.php',
			array_merge(array('content' => $content), $elements)
		);
	}
	
	static public function partial($file, array $elements = array()) {
		return self::_output(self::viewsPath() . $file . '.php', $elements);
	}
	
	static protected function _output($file, array $elements = array()) {
		extract($elements);
		ob_start();
		require $file;
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	static public function redirect($path) {
		header("location:" . $path);
		exit();
	}
	
	static protected function getRoute() {
		$ru = substr(trim($_SERVER['REQUEST_URI'], '/'), 0);
		$ca = array();
		
		list($ru, $ruq) = explode('?', $ru);
		
		list($ca['c'], $ca['a'], $ca['i'], $ca['e']) = explode('/', $ru, 4);
		
		if ($custom = self::isCustomRoute($ru)) {
			$ca['c'] = $custom['controller'];
			$ca['a'] = $custom['action'];

		}
		
		$e = array();
		if(!empty($ca['e'])) {
			$p = explode('/', $ca['e']);
			if ((count($p) % 2) == 0) { // name value pair
				foreach (array_chunk($p, 2) as $k) {
					$e[$k[0]] = $k[1];
				}
			} else { // junk?
				$e = $p;
			}
		}
		
		return array(
			'action' => ($ca['a'])? $ca['a'] : 'index',
			'controller' => $ca['c'] ? $ca['c'] : 'index',
			'extra' => $e,
			'id' => $ca['i'] ? $ca['i'] : '',
			'url' => $ru
		);
	}
	
	static public function printRoute() {
		print "<pre>Route: ";
		print_r(self::$_route);
		print "</pre>";
	}
	
	static public function addRoute($path, $controller, $action) {
		self::$_customRoutes[$path] = array(
			'controller' => $controller,
			'action' => $action
		);
	}
	
	static public function isCustomRoute($path) {
		if (array_key_exists($path, self::$_customRoutes)) {
			return self::$_customRoutes[$path];
		}
		return false;
	}
	
	static public function route() {
		$route = self::getRoute();		
		self::$_route = $route;
		self::$_controller = $route['controller'];
		self::$_action = $route['action'];
		self::$_id = $route['id'];
	}
	
	static public function error($path = '', $msg = '') {
		self::redirect(($path)? $path : '/errors/');
	}
	
	static public function deploy() {
		$controller = self::doesControllerExist(self::getController());
		if ($controller) {
			$c = new $controller();
			$c->deploy();
		} else {
			self::error('/notfound/');
		}
	}
}
