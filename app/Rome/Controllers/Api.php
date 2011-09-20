<?php

class Controllers_Api extends Controllers_AppBaseController
{
	protected $_controller = 'api';
	protected $_action = 'index';

	public function __construct() {
		$this->_action = Roam::getAction();
	}
	
	// send them back to the root
	public function index() {
		$this->_redirect('/');
	}
	
	// drop a json object with recent tweets
	public function twitterfeed() {
		$tweets = $this->_api->findTweets();
		print json_encode($tweets);
		exit(); // no need for a view script
	}
}
