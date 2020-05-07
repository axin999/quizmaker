<?php
namespace App\Controllers;
use Core\Controller;
use Core\Router;
use Core\HP;
use App\Models\Users;
use App\Models\QuestionTypes;

class QuestionTypesController extends Controller{

	function __construct($controller,$action)
	{
		parent::__construct($controller,$action);
		$this->load_model('QuestionTypes');
		$this->view->setLayout('default');

	}

	public function indexAction(){
		$question_type_list = $this->QuestionTypesModel->listQuestionTypes();
		$this->view->postAddAction = PROJECT_ROOT . 'QuestionTypes/add';
		$this->view->postEditAction = PROJECT_ROOT . 'QuestionTypes/edit/';
		$this->view->postDeleteAction = PROJECT_ROOT . 'QuestionTypes/delete/';
		$this->view->question_type_list = $question_type_list;
		$this->view->render('types/index');
		//var_dump($question_type_list);
	}

	public function addAction(){
		if($this->request->isPost()){	
			if(!empty($_POST['question_type']) && isset($_POST['question_type'])){
				$question_types = $this->request->get('question_type');
				$this->QuestionTypesModel->insertQuestionType($question_types);
				//Router::redirect('QuestionTypes/index');
			}
			Router::redirect('QuestionTypes/index');
		}
	}

	public function editAction($id){
		$question_type = $this->QuestionTypesModel->findByIdAndUserId((int)$id,Users::currentUser()->user_id);
		if($this->request->isPost()){
			$question_type_name = $this->request->get();
			$question_type->assign($question_type_name);
			$question_type->save();
			Router::redirect('QuestionTypes/index');
			//var_dump($question_type);
		}		
		
		if($question_type){
			$this->view->question_type = $question_type;
		}
		$this->view->postEditAction = PROJECT_ROOT . 'QuestionTypes/edit/';
		$this->view->render('types/edit');
	}

	public function deleteAction($id){
		$question_type = $this->QuestionTypesModel->findByIdAndUserId((int)$id,Users::currentUser()->user_id);
		//HP::dnd($question_type);
		if($question_type){
			$question_type->delete();
			//Session::addMsg('success','Question Type has been deleted.');
		}
			Router::redirect('QuestionTypes');
	}

}