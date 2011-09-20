<?php

switch (Registry::get('Environment')) {
	case 'production': // production
		Database::credentials('username', 'password', 'database', 'localhost'); // db creds
		ini_set('display_errors', 0);
		break;
	default: // development
		ini_set('display_errors', 1);
		error_reporting(E_ALL^E_NOTICE);
		Database::credentials('root', '', 'romecms', '127.0.0.1'); // db creds
		break;
}
