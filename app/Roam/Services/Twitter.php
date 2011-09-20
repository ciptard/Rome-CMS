<?php

class Roam_Services_Twitter extends Roam_Services_BaseService
{
	public function __construct() {}
	
	public function find($username, $count = 20, $skipReplies = 1) {
		$url = 'http://twitter.com/statuses/user_timeline/' . $username . '.rss?count=' . $count;
		$this->_makeCurlCall($url);
		$xml = simplexml_load_string($this->_rawData);

		$tweets = array();
		foreach ($xml->channel->item as $tweet) {
			list($tt, $t) = explode(': ', (string) $tweet->title, 2);
			
			if ($skipReplies && substr($t, 0, 1) == '@') {
				continue;
			} else {
				$t = preg_replace(
					'/([a-zA-Z]{3,}:\/\/[a-zA-Z0-9\.]+\/*[a-zA-Z0-9\/\\%_.]*\\?*[a-zA-Z0-9\/\\%_.=&amp;]*)/',
					'<a href="$1" target="_blank">$1</a>',
					$t
				);
				$tweets[] = array(
					'tweet' => (string) $t,
					'date' => (string) $tweet->pubDate,
					'link' => (string) $tweet->guid,
					'username' => $username
				);
			}
		}
		
		return $tweets;
	}
}
