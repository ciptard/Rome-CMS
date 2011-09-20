<?php

class Database
{
	static private $_instance = null;
	static private $_username;
	static private $_password;
	static private $_database;
	static private $_host;
	
	static public function credentials($username, $password, $database, $host) {
		self::$_username = $username;
		self::$_password = $password;
		self::$_database = $database;
		self::$_host = $host;
	}
	
	static private function _connect() {
		self::$_instance = ADONewConnection('mysqli');
		self::$_instance->Connect(
			self::$_host,
			self::$_username,
			self::$_password,
			self::$_database
		);
		self::$_instance->SetFetchMode(ADODB_FETCH_ASSOC);
	}
	
	static public function get() {
		if (self::$_instance === null) {
			self::_connect();
		}
		return self::$_instance;
	}
	
	static public function unslash($string) {
		return stripcslashes($string);
	}
	
	static public function unslashArray(array $record) {
		$return = array();
		foreach ($record as $key=>$value) {
			$return[$key] = (is_array($value))? self::unslashArray($value) : self::unslash($value);
		}
		return $return;
	}
	
	static public function escapeString($string) {
		return  mysqli_real_escape_string(self::get()->_connectionID, $string);
	}
	
	static public function escape(array $record) {
		$escaped = array();
		foreach ($record as $key=>$value) {
			$escaped[$key] = (is_string($value))? self::escapeString($value) : $value;
		}
		return $escaped;
	}
	
	static public function serialized(array $record) {
		return serialize($record);
	}
	
	static public function unserialized($record) {
		return unserialize($record);
	}
		
	static public function save($table, array $record) {
		$record['created'] = time();
		return self::get()->AutoExecute($table, self::escape($record), 1);
	}
	
	static public function update($table, array $record, $where) {
		$record['modified'] = time();
		return self::get()->AutoExecute($table, self::escape($record), 2, $where);
	}
	
	static public function delete($table, $idField, $id, $limit = '') {
		return self::get()->Execute("delete from " . $table . " where " . $idField . " = " . intval($id));
	}
	
	static public function findAll($table, $orderBy = '') {
		$order = ($orderBy)? ' order by ' . $orderBy : '';
		return self::execute('select * from ' . $table . $order);
	}
	
	static public function findBy($table, $name, $value, $orderBy = '') {
		$order = ($orderBy)? ' order by ' . $orderBy : '';
		$sql = "select * from " . $table . " where " . $name . " ='" . $value . "'" . $order;
		$results = self::execute($sql);
		return $results;
	}
	
	static public function findWhere($table, $where, $orderBy = '') {
		$order = ($orderBy)? ' order by ' . $orderBy : '';
		return Database::execute('select * from ' . $table . ' where ' . $where . $order);
	}
	
	static public function startTrans() {
		self::get()->StartTrans();
	}
	
	static public function completeTrans() {
		self::get()->CompleteTrans();
	}
	
	static public function execute($query) {
		if (strtolower(substr($query, 0, 6)) !== 'select') {
			return self::get()->Execute($query);
		}
		return self::unslashArray(self::get()->GetAll($query));
	}
}

