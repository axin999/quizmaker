<?php
namespace App\Controllers;
use Core\Controller;
use Core\Model;
use Core\FH;
use Core\HP;
use Core\Router;
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
		//$questions = $this->QuestionsModel->showQuestions();
		//$this->view->questions = $questions;

		$model = new Model('questions');
		$questions = $model->all("AS q")
			->leftJoin("answers","AS a USING (question_id)")
			->get();

		$this->view->questions = HP::group_by('question_id',$questions);
		$this->view->render('questions/index');
		
	}
	public function editAction($id){
		$question = $this->QuestionsModel->findQuestionId($id);
		//HP::dnd($question);
		if(!$question) Router::redirect('questions');
		if($this->request->isPost()){
			$questionUpdate = $this->request->get();
			$questionUpdate = array_combine($questionUpdate['answer_id'],$questionUpdate['answer']);
			//HP::dnd($questionUpdate);
			foreach ($questionUpdate as $id => $answer) {
				$this->QuestionsModel->update(['answer_id'=>$id],['answer' => $answer],"answers");
				echo "$id , $answer";
			}
			Router::redirect('questions');
			//HP::dnd($questionUpdate);
			
			//$this->QuestionsModel->assign($this->request->get());
		}
		$this->view->question = $question;
		$this->view->postAction = PROJECT_ROOT . 'questions' . '/' . 'edit' . DS . $question[0]->question_id;
		$this->view->render('questions/edit');
	}

}