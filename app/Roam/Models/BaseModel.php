<?php

class Roam_Models_BaseModel
{
	protected $_table = '';
	protected $_idName = '';
	protected $_orderBy;
	
	protected $_hasMany = array();
	protected $_belongsTo = array();
	protected $_skipRelations = 0;
	protected $_callingModels = array();

	public function create($data) {
		return Database::save($this->_table, $data);
	}

	public function update($id, $data) {
		return Database::update(
			$this->_table, $data, $this->_idName . ' = ' . $id
		);
	}
	
	public function updateWhere($data, $where) {
		return Database::update($this->_table, $data, $where);
	}

	public function destroy($id) {
		return Database::delete($this->_table, $this->_idName, $id);
	}

	public function findAll($orderBy = '') {
		$record = Database::findAll($this->_table, $this->_orderBy($orderBy));
		return ($record)? $this->findRelations($record) : false;
	}
	
	public function findBy($key, $value, $orderBy = '') {
		$record = Database::findBy($this->_table, $key, $value, $this->_orderBy($orderBy));
		return ($record)? $this->findRelations($record) : false;
	}
	
	public function findById($id, $orderBy = '') {
		$record = Database::findBy($this->_table, $this->_idName, $id, $this->_orderBy($orderBy));
		if ($record) {
			$record = $this->findRelations($record);
			return $record[0];
		}
		return false;
	}

	public function findWhere($where, $orderBy = '') {
		$record = Database::findWhere($this->_table, $where, $this->_orderBy($orderBy));
		return ($record)? $this->findRelations($record) : false;
	}
	
	public function execute($sql) {
		return Database::execute($sql);
	}
	
	public function findRelations($record) {
		foreach ($record as $k=>$r) {
			if (count($this->_hasMany)) {
				foreach ($this->_hasMany as $key=>$model) {
					if (!$this->isCallingModel($model)) {
						$m = new $model();
						$m->setCallingModels(
							array_merge($this->getCallingModels(), array(get_class($this)))
						);
						$record[$k][$key] = $m->findBy($this->_idName, $r[$this->_idName]);
					}
				}
			}
			
			if (count($this->_belongsTo)) {
				foreach ($this->_belongsTo as $key=>$data) {
					if (!$this->isCallingModel(get_class($this))) {
						$m = new $data['model']();
						$m->setCallingModels(
							array_merge($this->getCallingModels(), array(get_class($this)))
						);
						$results = $m->findBy($data['idName'], $r[$data['idName']]);
						$record[$k][$key] = $results[0];
					}
				}
			}
		}
		return $record;
	}
	
	public function getInsertId() {
		$id = Database::execute('select last_insert_id()');
		return $id[0]['last_insert_id()'];
	}
	
	public function startTrans() { Database::startTrans(); }
	
	public function completeTrans() { Database::completeTrans(); }
	
	public function setCallingModels(array $models) {
		$this->_callingModels = array_merge($this->_callingModels, $models);		
		return $this;
	}
	
	public function getCallingModels() {
		return $this->_callingModels;
	}
	
	public function isCallingModel($model) {
		return (in_array($model, $this->_callingModels))? true : false;
	}
	
	protected function _orderBy($orderBy = '') {
		return ($orderBy)? $orderBy : (($this->_orderBy)? $this->_orderBy : '');
	}
	
	public function skipRelations() {
		$this->_skipRelations = 1;
	}
}





