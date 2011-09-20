<?php

class Models_User extends Models_AppBaseModel
{
	protected $_table = 'Users';
	protected $_idName = 'user_id';
	protected $_orderBy = 'username';
	
	public function __construct() {}
	
	public function findAll() {
		return parent::findAll('username');
	}
	
	public function create() {
		$data = Roam::getParams();
		$data['password'] =  $this->_password($data['password']);
		return parent::create($data);
	}
	
	public function update() {
		$data = Roam::getParams();
		$id = Roam::getId();
		if ($data['password']) {
			$data['password'] = $this->_password($data['password']);
		}
		return parent::update($id, $data);
	}
	
	protected function _password($password) {
		return md5($password);
	}

	public function findUser($id) {
		$user = $this->findById($id);
		return ($user)? $user : false;
	}
	
	public function makeAdmin($id){
		return parent::update($id, array('admin' => 1));
	}
	
	public function makeUser($id) {
		return parent::update($id, array('admin' => 0));
	}
	
	public function findByUserName($username) {
		$user = $this->findBy('username', $username);
		return ($user)? $user[0] : false;
	}
		
	public function enable($id) {
		return Database::update(
			$this->_table, array('status' => 1), $this->_idName . ' = ' . $id
		);
	}
	
	public function disable($id) {
		return Database::update(
			$this->_table, array('status' => 0), $this->_idName . ' = ' . $id
		);
	}
}












