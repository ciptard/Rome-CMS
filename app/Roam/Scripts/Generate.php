<?php
$root = realpath(dirname(dirname(dirname(dirname($_SERVER["SCRIPT_FILENAME"])))));
set_include_path(get_include_path() . PATH_SEPARATOR . $root);
require_once 'Config.php';
if (!empty($argc) && strstr($argv[0], basename(__FILE__))) {
	$maker = new Roam_Scripts_Make(trim($argv[1]));
	$maker->setPath($root . '/')->make();
}
