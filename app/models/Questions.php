<?php
namespace App\Models;
use Core\Model;
use Core\validators\RequiredValidator;
use Core\HP;
/**
 * 
 */
class Questions extends Model
{
	public $question_id,$question,$question_type,$created_at;
	protected $_primaryKey = "question_id";
	function __construct()
	{
		$table = 'questions';
		parent::__construct($table);
	}
	public function validator(){
		//HP::dnd($this);
		$this->runValidation(new RequiredValidator($this,['field'=>'question','msg'=>'Question is required.']));
/*		$this->runValidation(new RequiredValidator($this,['field'=>'answer','msg'=>'First Name is required.']));*/
	}

	public function showQuestions(){
		return $this->all();
	}

	public function findQuestionId($id){

		$query = $this->select("q.question_id,question,answer_id,answer","q")
		->leftJoin("answers","USING(question_id)")
		->where("q.question_id","=",[$id])
		->get();

		return $query;
	}

	public function deleteQuestion($id){
		$this->findFirst($id)->delete();
	}

}