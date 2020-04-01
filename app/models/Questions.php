<?php
namespace App\Models;
use Core\Model;
/**
 * 
 */
class Questions extends Model
{
	public $question_id,$question,$question_type,$created_at;
	
	function __construct()
	{
		$table = 'questions';
		parent::__construct($table);
	}
	public function validator(){
		
	}

	public function showQuestions(){
		return $this->all();
	}

	public function findQuestionId($id){

		$query = $this->select("q.question_id,question,answer_id,answer","q")
		->join("answers","USING(question_id)")
		->where("q.question_id","=",[$id])
		->get();

		return $query;
	}

}