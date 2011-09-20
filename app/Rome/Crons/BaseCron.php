<?php
// set the include path
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . '/../../app');
require dirname(__FILE__) . '/../Config.php';
$api = new Modules_Api();
