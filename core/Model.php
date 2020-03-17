<?php
class Model{
	protected $_db, $_table, $_modelName, $_softDelete = false, $_columnNames = [];
	protected $table_id;
	public $id;

	public function __construct($table){
		$this->_db = DB::getInstance();
		$this->_table = $table;
		$this->_setTableColumns();
		//$this->_modelName = ucwords($table);
		$this->_modelName = str_replace(' ', '',ucwords(str_replace('_',' ',$this->_table)));
		//dnd($this->_modelName);
	}

	protected function _setTableColumns(){
		$columns = $this->get_columns();
		foreach ($columns as $column) {
			$columnName = $column->Field;
			$this->_columnNames[] = $column->Field;
			$this->{$columnName} = null;
		}
	}

	public function get_columns(){
		return $this->_db->get_columns($this->_table);
	}

	public function find($params = []){
		$results = [];
		$resultsQuery = $this->_db->find($this->_table, $params);
		foreach ($resultsQuery as $result) {
			$obj = new $this->_modelName($this->_table);
			$obj ->populateObjData($result);
			$results[] = $obj;
		}
		return $results;
	}

	public function findFirst($params =[]){
		$resultsQuery = $this->_db->findFirst($this->_table,$params);
		$result = new $this->_modelName($this->_table);
		if($resultsQuery){
			$result->populateObjData($resultsQuery);
		}
		return $result;
	}
	public function findById($id){
		return $this->findFirst();
	}
	// save is used for  shorcut inserting or updating
	public function save(){
		$fields = [];

		foreach ($this->_columnNames as $column) {
			$fields[$column] = $this->$column;
		}
		// determine wether update or insert
		if(property_exists($this, 'id') && $this->id != ''){

			return $this->_update($this->id, $fields);
		}else{
			return $this->insert($fields);
		}
	}
	public function insert($fields){
		if(empty($fields)) return false;
		return $this->_db->insert($this->_table, $fields);
	}
	public function update($id, $fields){
		if(empty($fields) || $id='') return flase;
		return $this->_db->update($this->_table,$id,$fields);
	}
	public function delete($id =''){
		
		if($id == '' && $this->session_id == '') return false;
		$id = ($id == '') ? $this->session_id : $id;
		if($this->_softDelete){
			return $this->update($id, ['deleted' => 1]);
		}
		//dnd($this->$id);
		return $this->_db->delete($this->_table, $this->session_id);// !!!!!!! hey change this, you shoul determine the id field name of the table
	}
	public function query($sql, $bind =[]){
		return $this->_db->query($sql, $bind);
	}
	public function data(){
		$data = new stdClass();
		foreach ($this->_columnNames as $column) {
			$data->column = $this ->column;
		}
		return $data;
	}
	public function assign($params){
		if(!empty($params)){
			foreach ($params as $key => $value) {
				if(in_array($key, $this->_columnNames)){
					$this->$key = sanitize($value);
				}
			}
			return true;			
		}
		return false;
	}
	protected function populateObjData($result){
		foreach($result as $key => $val){
			$this->$key = $val;
		}

	}

}