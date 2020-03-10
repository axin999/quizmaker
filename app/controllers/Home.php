<?php

class Home extends Controller
	{
		public function __construct(){
			parent::__construct($controller, $action);
		}
		public function indexAction(){
			//die('welcome to home controller this is the index action');
			$dbs = DB::getInstance();
			$fields = [
				'question' => 'from my mvc3'
			];
			$question_typesQ = $dbs->delete('questions',183);
			$this->view->render('home/index');
		}

	}