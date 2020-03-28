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

	public function showQuestions(){
		return $this->all();
	}
}