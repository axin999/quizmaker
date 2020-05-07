<?php
namespace App\Traits;
use Core\Router;
use App\Models\Questions;
use App\Models\Answers;

trait QuestionAndAnswer{

	public function addAction(){
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
	}
}