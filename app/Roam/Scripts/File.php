<?php

// static class

class Roam_Scripts_File
{
	static public function directory($path) {
		$result = mkdir($path, 0777, 1);
		chmod($path, 0777);
	}
	
	static public function create($file, $content) {
		$f = fopen($file, "w");
		$result = fwrite($f, $content);
		fclose($f);
		chmod($file, 0777);
		return $result;
	}
}

