<?php
namespace App\Controllers;
use Core\Controller;

//use Core\Session;
use Core\Router;
use App\Models\Quizes;
use App\Models\QuestionTypes;
use App\Models\Users;
//use App\Models\Users;
use Core\HP;

class QuizesController extends Controller
{
	
	function __construct($controller,$action)
	{
		parent::__construct($controller,$action);
		$this->view->setLayout('default');
		$this->load_model('Quizes');
		$this->_softDelete = false;
	}

	public function indexAction(){
		$this->view->render('quizes/index');
	}

	public function myquizesAction(){
		$quizes = $this->QuizesModel->all()->get();
		$this->view->user_quizes = $quizes;
		$this->view->render('quizes/myquizes');
	}

	public function createAction(){
		if($this->request->isPost()){
			$this->request->csrfCheck();
			$this->QuizesModel->user_id = Users::currentUser()->user_id;
			$this->QuizesModel->assign($this->request->get());
			//HP::dnd($this->QuizesModel);
			$this->QuizesModel->save();
			//$this->insert('quizes',);
		}
		$question_types = new QuestionTypes();
		$get_question_type = $question_types->listQuestionTypes();
		$this->view->question_types = $get_question_type;
		$this->view->postQuizAction= PROJECT_ROOT."quizes/create";
		$this->view->render('quizes/index');

	}
}