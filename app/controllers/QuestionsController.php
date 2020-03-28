<?php
namespace App\Controllers;
use Core\Controller;
use Core\FH;
use Core\HP;
use App\Models\Questions;



/**
 * 
 */
class QuestionsController extends Controller
{
	
	public function __construct($controller,$action)
	{
		parent::__construct($controller,$action);
		$this->view->setLayout('default');
		$this->load_model('Questions');

	}

	public function indexAction(){
		$questions = $this->QuestionsModel->showQuestions();
		$this->view->questions = $questions;
		$this->view->render('questions/index');
		
	}
}