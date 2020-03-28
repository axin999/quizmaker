<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\Users;

class HomeController extends Controller
	{
		public function __construct($controller,$action){
			parent::__construct($controller, $action);
		}
		public function indexAction(){
			//dnd($_SESSION);
			//die('welcome to home controller this is the index action');
/*			$dbs = DB::getInstance();
			$fields = [
				'conditions' => 'question_id = ?',
				'bind' => [154]
			];
			$question_typesQ = $dbs->find('questions',$fields);*/
			//dnd($question_typesQ);
			$this->view->render('home/index');
		}

		public function testAjaxAction(){
			$resp = ['success'=>true, 'data'=>['id'=>23,'name'=>'wews','favorite_food'=>'hotdididog']];
			$this->jsonResponse($resp);
		}

	}