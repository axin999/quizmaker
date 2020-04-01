<?php
namespace Core;

class Model{
	protected $_db, $_table, $_modelName, $_softDelete = false;
	protected $_validates = true, $_validationErrors = [];
	private $_query,$_bind;
	//protected $table_id;
	//public $id;

	public function __construct($table= ''){
		$this->_db = DB::getInstance();
		$this->_table = $table;
		//$this->_modelName = ucwords($table);
		$this->_modelName = str_replace(' ', '',ucwords(str_replace('_',' ',$this->_table)));
		//dnd($this->_modelName);
	}
	//wala lang
	public static function DB(){
		return new self();
	}

	public function sample(){
		$this->_query = "sample query";
		return $this->_query;
	}

	public function get_columns(){
		return $this->_db->get_columns($this->_table);
	}

	protected function _softDeleteParams($params){
		if($this->_softDelete){
			if(array_key_exists('conditions', $params)){
				if(is_array($params['conditions'])){
					$params['conditions'][] = "deleted != 1";
				}else{
					$params['conditions'] .= ' AND deleted != 1';
				}
			}else{
				$params['conditions'] = "deleted ! = 1";
			}
		}
		//HP::dnd($params);
		return $params;
	}

	public function find($params = []){
		$params = $this->_softDeleteParams($params);
		$resultsQuery = $this->_db->find($this->_table, $params, get_class($this));

		if(!$resultsQuery) return [];

		return $resultsQuery;
	}


	public function all($otherparams =""){
		$table = $this->_table;
		$this->_query = "SELECT * FROM {$table} {$otherparams} ";
		return $this;
	}

	public function select($params,$alias){
		$table = $this->_table;
		$this->_query .= "SELECT {$params} FROM {$table} AS {$alias}";
		return $this;
	}

	public function join($table,$otherparams = ""){
		$this->_query .= " JOIN {$table} {$otherparams}";
		return $this;
	}
	public function leftJoin($table,$otherparams = ""){
		$this->_query .= " LEFT JOIN {$table} {$otherparams}";
		return $this;
	}

	public function rightJoin($table,$otherparams = ""){
		$this->_query .= " RIGHT JOIN {$table} {$otherparams}";
		return $this;
	}

	public function where($stringcondition,$operator,$bind = []){
		$this->_bind = $bind;
		$this->_query .= " WHERE {$stringcondition} {$operator} ?";
		return $this;
	}

	public function get(){
		//HP::dnd($this->_bind);
		$result = $this->_db->all($this->_query,$this->_bind);
		return $result;
	}

	public function findFirst($params = []){
		//HP::dnd($params);
		$params = $this->_softDeleteParams($params);
		//HP::dnd($params);
		$resultsQuery = $this->_db->findFirst($this->_table,$params, get_class($this));
		//HP::dnd($resultsQuery);
		return $resultsQuery;
	}
	public function findById($id){
		return $this->findFirst();
	}
	// save is used for  shorcut inserting or updating
	public function save(){
		$this->validator();
		if($this->_validates){
			$this->beforeSave();
			$fields = HP::getObjectProperties($this);
			//HP::echonl($fields);
			// determine wether update or insert
			if(property_exists($this, 'id') && $this->id != ''){

				$save = $this->update($this->id, $fields);
				$this->afterSave();
				return $save;
			}else{
				$save = $this->insert($fields);
				$this->afterSave();
				return $save;
			}
		}
		return false;
	}
	
	public function insert($fields){
		//HP::dnd($fields);
		if(empty($fields)) return false;
		return $this->_db->insert($this->_table, $fields);
	}
	public function update($id, $fields,$table = ''){
		$tableToUpdate = (!empty($table)) ? $table : $this->_table;
		if(empty($fields) || $id == '') return flase;

		return $this->_db->update($tableToUpdate,$id,$fields);
	}
	public function delete($id =''){
		if($id == '' && $this->id == '') return false;
		$id = ($id == '') ? $this->id : $id;
		if($this->_softDelete){
			return $this->update($id, ['deleted' => 1]);
		}
		return $this->_db->delete($this->_table, $this->id);// !!!!!!! hey change this, you shoul determine the id field name of the table

	}
	public function query($sql, $bind =[]){
		return $this->_db->query($sql, $bind);
	}
	public function data(){
		$data = new stdClass();
		foreach (HP::getObjectProperties($this) as $column => $value) {
			$data->column = $value;
		}
		return $data;
	}
	public function assign($params){
		if(!empty($params)){
			foreach ($params as $key => $value) {
				if(property_exists($this, $key)){
					$this->$key = $value;
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

	public function validator(){}

	public function runValidation($validator){
		$key = $validator->field;
		if(!$validator->success){
			$this->_validates = false;
			$this->_validationErrors[$key] = $validator->msg;
		}
		//HP::dnd($validator);
	}

	public function getErrorMessages(){
		return $this->_validationErrors;
	}

	public function validationPassed(){
		return $this->_validates;
	}

	public function addErrorMessage($field, $msg){
		$this->_validates = false;
		$this->_validationErrors[$field] = $msg;
	}

	public function beforeSave(){
	}
	public function afterSave(){
	}

	public function isNew(){
		return (property_exists($this, 'id') &&  !empty($this->id)) ? false : true;
	}

}