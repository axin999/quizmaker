<?php

class Home extends Controller
	{
		public function __construct(){
			parent::__construct($controller, $action);
		}
		public function indexAction(){
			//dnd($_SESSION);
			//die('welcome to home controller this is the index action');
			$dbs = DB::getInstance();
			$fields = [
				'conditions' => 'question_id = ?',
				'bind' => [154]
			];
			$question_typesQ = $dbs->find('questions',$fields);
			//dnd($question_typesQ);
			$this->view->render('home/index');
		}

	}