<?php

// your timezone
date_default_timezone_set('America/New_York');

// files to get app running
require_once 'Roam/RoamConfig.php';
require_once 'Rome.php';
require_once 'Cache.php';
require_once 'Roam/Library/markdown.php';

// setup the environment (development, production)
Registry::set('Environment', 'development');
require_once 'Environment.php';

// theme configs
Registry::set('ThemesPath', dirname(__FILE__) . '/Themes/'); // directory to find themes
Registry::set('PublicThemePath', '/app/Themes/'); // clean version of above for templates

// cache configs
Registry::set('indexCache', 'indexContent'); // name of the index cache
Registry::set('indexCacheAge', 15); // how long should index content stay cached?

Registry::set('twitterCache', 'twitterCache'); // name of twiiter cache
Registry::set('twitterCacheAge', 20); // how long should twitter content stay cached?

// twitter config
Registry::set('twitterNumber', 30); // how many tweets to grab?
Registry::set('twitterSkipReplies', true); // ignore @replies?

// cookie config
Registry::set('cookieName', 'RomeUser');
Registry::set('adminCookie', 'RomeAdmin');

// misc settings
Registry::set('loginTitle', 'ROME CMS LOGIN');

// routes
Roam::addRoute('notfound', 'index', 'notfound'); // route for /notfound (controller => index, action => notfound)

// debug
Registry::set('RomeDebug', 0); // show template variables on index
Registry::set('debug', 0); // show Roam framework debug info
