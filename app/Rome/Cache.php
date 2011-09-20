<?php

class Cache
{
	static private $_cacheModel;

	static protected function c() {
		if (!self::$_cacheModel) {
			self::$_cacheModel = new Models_Cache();
		}
		return self::$_cacheModel;
	}
	
	static protected function _age($createdDate) {
		return round(abs(time() - strtotime($createdDate)) / 60, 2);
	}

	static public function set($name, $content, $minutes = 5) {
		if (!Registry::get('disableCache')) {
			return self::c()->create(array(
				'name' => $name,
				'content' => serialize($content),
				'minutes' => $minutes
			));
		}
	}
	
	static public function get($name, $returnId = false, $ignoreAge = false) {
		if (!Registry::get('disableCache')) {
			$content = self::c()->findBy('name', $name);
			if (!$content) {
				return false;
			}
			
			$content = $content[0];
			
			if (!$ignoreAge) {
				if ($content['clear'] == 1 || $content['content'] == '' || 
					self::_age($content['created']) > $content['minutes']
				) {
					self::destroy($content['cache_id']);
					return false;
				}
			}
	
			return ($returnId)? $content['cache_id'] : Database::unserialized($content['content']);
		}
		return false;
	}
	
	static public function destroy($id) {
		if (is_string($id)) {
			$item = self::get($id, true);
			if ($item) {
				return self::destroy($item);
			}
		}
		return self::c()->destroy($id);
	}
	
	static public function cacheList() {
		return self::c()->cacheList();
	}
}

