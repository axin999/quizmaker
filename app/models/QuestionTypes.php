<?php
namespace App\Models;
use Core\Model;
use App\Models\Users;

class QuestionTypes extends Model{

	public $question_type_id =1,$user_id,$question_type_name,$created_at;
	protected $_primaryKey = "question_type_id";

	function __construct()
	{
		$table = 'question_types';
		parent::__construct($table);
	}

	public function listQuestionTypes(){
		$this->user_id = Users::currentUser()->user_id;
		$question_types = $this->all()
		->where("user_id","=",[$this->user_id])
		->get();

		return $question_types;
	}

	public function insertQuestionType($data){
		$question_types = array();
		$user_id = Users::currentUser()->user_id;
		foreach ($data as $question_type) {
			if (!empty($question_type)) {
				$question_types[] = ['user_id' =>$user_id,'question_type_name'=>$question_type];
			}
		}
		$this->insert($question_types);
	}

	public function findByIdAndUserId($question_type_id,$user_id,$params=[]){
			$conditions = [
				'conditions' =>'question_type_id = ? AND user_id = ?',
				'bind' => [$question_type_id,$user_id]
			];
			$conditions = array_merge($conditions,$params);
			return $this->findFirst($conditions);
		}
}