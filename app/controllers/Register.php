<?php
	class Register extends Controller{
		public function __construct(){
			parent::__construct($controller,$action);
			$this->load_model('Users');
			$this->view->setLayout('default');

		}
		public function loginAction(){
			//echo password_hash('password',PASSWORD_DEFAULT);
			if($_POST){
				$validation = true;
				if($validation === true){
					$user = $this->UsersModel->findByUsername($_POST['username']);
					//echo $user;
					dnd($user);
				}
			}
			$this->view->render('register/login');
		}
	}