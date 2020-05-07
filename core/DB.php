<?php
namespace Core;
use \PDO;
use \PDOException;
class DB{
	private static $_instance = null;
	private $_pdo, $_query, $_error = false, $_results, $_count = 0; //$_lastInsertID = null;
	public $_lastInsertID = null;

	private function __construct(){
		try{
			$this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME , DB_USER, DB_PASSWORD);
		}
		catch(PDOException $e){
			die($e->getMessage());

		}
	}
	public static function getInstance($id = ''){
		if(!isset(self::$_instance)){
			self::$_instance = new self($id);
		}
		return self::$_instance;

	}
	public function query($sql, $params = [], $class = false){
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			if(!empty($params)){
				foreach ($params as $key => $value) {
					if(!is_array($value)){

							$x = 1;
							if(count($params)){
								foreach($params as $param){
									$this->_query->bindValue($x,$param);
									$x++;
								}
							}
						break;					
						
					}
					elseif(is_array($value)){
						if($this->_query->execute(array_values($value)));
						if(array_key_last($params) == $key) return $this;								
					}
				}
			}
			//$checkquery = $this->_query;
			//HP::dnd($checkquery);
			//HP::dnl($params);
			if($this->_query->execute()){
				if($class){
					$this->_results = $this->_query->fetchALL(PDO::FETCH_CLASS,$class);

				}else{
					$this->_results = $this->_query->fetchALL(PDO::FETCH_OBJ);
				}
				$this->_count = $this->_query->rowCount();
				$this->_lastInsertID = $this->_pdo->lastInsertId();
			}else{
				$this->_error = true;
			}
				
		}
		//HP::dnd($this);
		return $this;
	}

	protected function _read($table, $params=[], $class = '',$primaryKey = "id"){

		$conditionString = '';
		$bind = [];
		$order ='';
		$limit = '';

		if(isset($params['conditions'])){
			if (is_array(($params['conditions']))) {
				foreach ($params['conditions'] as $condition) {
					$conditionString .= ' ' . $condition . ' AND ';
				}
				$conditionString = trim($conditionString);
				$conditionString = rtrim($conditionString,' AND ');
			}else{
				$conditionString = $params['conditions'];
			}
			if($conditionString != ''){
				$conditionString = ' WHERE '. $conditionString;
			}

			//bind
			if(array_key_exists('bind', $params)){
				$bind = $params['bind'];
			}
			if(array_key_exists('order', $params)){
				$order = ' ORDER BY ' . $params['order'];
			}
			if(array_key_exists('limit', $params)){
				$limit = ' LIMIT '. $params['limit'];
			}
			$sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
			if($this->query($sql,$bind,$class)){
				if(!count($this->_results)) {
					return false;
				}
				return true;
			}
			return false;
		}else{

			$sql = "SELECT * FROM {$table}";
			if(!empty($params) && !is_array($params)) $sql .= " WHERE {$primaryKey} = {$params}";
			var_dump($sql);
			if($this->query($sql,null,$class,$primaryKey)){
				if(!count($this->_results)) {
					return false;
				}
			}
			return true;
		}
	}


	public function all($sql,$bind = [],$class = ''){
		(!empty($class)) ? $class = $class : $class = get_class($this);
		if($this->query($sql,$bind,$class)){
			return $this->results();		
		}
	}

	public function find($table, $params = [],$class = false){
		if($this->_read($table,$params,$class)){
			return $this->results();
		}
		return false;
	}
	public function findFirst($table, $params= [],$class = false,$primaryKey = "id"){
		//$thisread = $this->_read($table,$params,$class);
		if($this->_read($table,$params,$class,$primaryKey)){
			return $this->first();
		}
		return false;
	}

	public function insert($table, $fields = []){
		//HP::dnl($fields);
		$fields = HP::filterProperties($fields);// remove properties in get_obj_vars that should not be included.
		$fieldString ='';
		$valueString = '';
		$values = [];

		foreach ($fields as $field => $value) {				
			if(!is_array($value)){
				$fieldString .= "`". $field . "`,";
				$valueString .= '?,';
				$values[] = $value;

			}
			if(is_array($value)){
				$fieldString = (implode(",", array_keys($value)));
				$countValue = count($value);
				$valueString = (implode(",", array_fill(0, $countValue, "?")));
				$values[] = $value;		
			}			
		}

		$fieldString = rtrim($fieldString,',');
		$valueString = rtrim($valueString,',');
		$sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
		//HP::dnd($sql);
		if(!$this->query($sql,$values)->error()){
			return true;
		}
		return false;
	}
	public function update($table,$id,$fields = [],$primaryKey = "id"){
		//HP::dnd($fields);
		if(is_array($id)){
			$idKey = implode(array_keys($id));
			$idVal = implode(array_values($id)); 
		}
		else{
			$idKey = $primaryKey;
			$idVal = $id;
		}

		$fieldString ='';
		$values = [];
		foreach ($fields as $field => $value) {
			$fieldString .= " " .$field. " = ?,";
			$values[] = $value;
		}
		$fieldString = trim($fieldString);
		$fieldString = rtrim($fieldString,',');
		$sql = "UPDATE {$table} SET {$fieldString} WHERE {$idKey} = {$idVal}";
		//HP::dnd($sql);

		if(!$this->query($sql,$values)->error()){
			return true;
		}
		return false;
		
	}

	public function delete($table,$id,$pk = 'id'){
		$sql = "DELETE FROM {$table} WHERE {$pk} = {$id}";
				var_dump($sql);
		if(!$this->query($sql)->error()){
			return true;
		}
		return false;

	}

	public function results(){
		return $this->_results;
	}
	public function first(){
		return (!empty($this->_results))? $this->_results[0] : [];
	}
	public function count(){
		return $this->_count;
	}
	public function lastID(){
		return $this->_lastInsertID;
	}
	public function get_columns($table){
		return $this->query("SHOW COLUMNS FROM {$table}")->results();
	}
	public function error(){
			return $this->_error;
	}
	public function getTablePrimaryKey($table){
		$sql = "SHOW KEYS FROM {$table} WHERE Key_name = :primary";
		if($this->_query = $this->_pdo->prepare($sql)){
			if($this->_query->execute(array(':primary'=>'PRIMARY'))){				
				$result = $this->_query->fetchALL(PDO::FETCH_OBJ);
				return ($result[0]->Column_name);
			}
		}
	}
}