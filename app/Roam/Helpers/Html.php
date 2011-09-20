<?php

class H
{
	function shorten($text, $chars = 25) {
			if (strlen($text) > $chars) {		
			$text = $text . " ";
			$text = substr($text, 0, $chars);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text . "...";
		}
		return $text;
	}
	
	// replace underscores with spaces and ucwords
	function humanTitle($text) {
		return ucwords(str_replace(array('_', '-'), ' ', $text));
	}
}
