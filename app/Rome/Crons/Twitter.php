<?php
require_once 'BaseCron.php';
$api->destroyTwitterCache();
$api->findTweets();
if (Registry::get('Environment') === 'development') {
	mail('tj.eastmond@gmail.com','Twitter Cron Ran','Twitter Cron Ran');
}
