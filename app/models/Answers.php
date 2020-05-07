<?php
namespace App\Models;
use Core\Model;
use Core\validators\RequiredValidator;
use Core\HP;
/**
 * 
 */
class Answers extends Model
{
	public $answer_id,$question_id,$answer = [],$created_at;
	
	function __construct()
	{
		$table = 'answers';
		parent::__construct($table);
	}
	public function validator(){

	}

	public function insertAnswers($data){
		$answers = array();
		foreach ($this->answer as $answer) {
			if (!empty($answer)) {
				$answers[] = ['answer' =>$answer,'question_id'=>$this->question_id];
			}
			
		}
		$this->insert($answers);

	}

}