<?php

// set the include path
set_include_path(
	get_include_path()
	. PATH_SEPARATOR . dirname(__FILE__) . '/app'
	. PATH_SEPARATOR . dirname(__FILE__) . '/app/Rome'
);

// include your app config
require_once 'app/Config.php';

// setup the route and then deploy
Roam::route();
Roam::deploy();
