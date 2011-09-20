<?php
require_once 'Roam/Roam.php';
require_once 'Roam/Registry.php';
require_once 'Roam/Profiler.php';
require_once 'Roam/Helpers/Html.php';
require_once 'Roam/Models/adodb5/adodb-exceptions.inc.php';
require_once 'Roam/Models/adodb5/adodb.inc.php';
require_once 'Roam/Models/Database.php';

function __autoload($className) {
	$file = Roam::classNameToFileName($className);
	if (Roam::doesFileExist($file)) {
		require_once($file);
		return true;
	}
	return false;
}

// Routes
Roam::addRoute('notfound', 'errors', 'notfound');

Registry::set('session', new Roam_Session());
Registry::set('debug', 0);
