<?php
namespace App\Models;
use Core\Model;
use Core\validators\RequiredValidator;
use Core\validators\MaxValidator;

/**
 * 
 */
class Quizes extends Model
{
public $quiz_id,$user_id,$quiz_name,$quiz_description,$created_at;
protected $_primaryKey = "quiz_id";

	function __construct()
	{
			$table = 'Quizes';
			parent::__construct($table);
			$this->_softDelete = false;
	}

	public function getQuizList(){

		$model = new Model('quizes');
		$model->all();
		return $model;

	}
}