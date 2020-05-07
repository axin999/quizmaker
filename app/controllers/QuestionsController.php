<?php
namespace App\Controllers;
use App\Traits\QuestionAndAnswer;
use Core\Controller;
use Core\Model;
use Core\FH;
use Core\HP;
use Core\Router;
//use App\Models\Questions;
//use App\Models\Answers;



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
		$this->load_model('Answers');

	}

	use QuestionAndAnswer;

	public function indexAction(){
		//$questions = $this->QuestionsModel->showQuestions();
		//$this->view->questions = $questions;

		$model = new Model('questions');
		$questions = $model->all("AS q")
			->leftJoin("answers","AS a USING (question_id)")
			->orderby("q.created_at DESC")
			->get();

		$this->view->questions = HP::group_by('question_id',$questions);
		$this->view->render('questions/index');
		
	}
/*	public function addAction(){
		$questions = new Questions();
		$answers = new Answers();
		$this->view->question = '';
		if($this->request->isPost()){
			$this->request->csrfCheck();
			$getQandA = $this->request->get();
			if($getQandA){
				//HP::dnd($answers);
				$questions->assign($getQandA);
				$questions->question_type = 1;
				if($questions->save()){
					if(isset($getQandA['answer'])){
						$getAnswer = ['answer'=>$getQandA['answer'],'question_id'=>$questions->lastinsertId]; 
						$answers->assign($getAnswer);
						$answers->insertAnswers($answers);
					}
				Router::redirect('questions');
				}
				//HP::dnd($questions);
				
			}
		}
		$this->view->displayErrors = $questions->getErrorMessages();
		$this->view->postAction = PROJECT_ROOT . 'questions' . '/' . 'add';
		$this->view->render('questions/edit');
	}*/

	public function editAction($id){
		$question = $this->QuestionsModel->findQuestionId($id);
		if(!$question) Router::redirect('questions');
		if($this->request->isPost()){
			$this->request->csrfCheck();			
			$getQandA = $this->request->get();
			$this->QuestionsModel->question = $getQandA['question'];
			//HP::dnd($getQandA['question']);
			$answerUpdate = array_combine($getQandA['answer_id'],$getQandA['answer']);
			if($this->QuestionsModel->update(['question_id'=>$question[0]->question_id],['question'=>$getQandA['question']],'questions')){
				foreach ($answerUpdate as $id => $answer) {
					$this->QuestionsModel->update(['answer_id'=>$id],['answer' => $answer],"answers");
				}
				Router::redirect('questions');
			};

		}
		$this->view->question = $question[0]->question;
		$this->view->answer = $question;
		$this->view->displayErrors = $this->QuestionsModel->getErrorMessages();
		$this->view->postAction = PROJECT_ROOT . 'questions' . '/' . 'edit' . DS . $question[0]->question_id;
		$this->view->render('questions/edit');
	}

	public function deleteAction($id){
		$delete = $this->QuestionsModel->findFirst($id)->del();
		Router::redirect('questions');
	}

}