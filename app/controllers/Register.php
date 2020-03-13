<?php
	class Register extends Controller{
		public function __construct(){
			parent::__construct($controller,$action);
			$this->load_model('Users');
			$this->view->setLayout('default');

		}
		public function loginAction(){
			//echo password_hash('password',PASSWORD_DEFAULT);
			$validation = new Validate();
			if($_POST){
				$validation->check($_POST,[
					'username' => [
						'display' => "Username",
						'required' => true
					],
					'password' => [
						'display' => 'Password',
						'required' => true,
						'min' => 3
					]
				]);
				if($validation->passed()){
					$user = $this->UsersModel->findByUsername($_POST['username']);
					if($user && password_verify(Input::get('password'),$user->password)){
						$remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
						$user->login($remeber);
						Router::redirect('index2.php');
					}else{
					$validation->addError("There is an error with your username and password");
					}
				}
			}
			$this->view->displayErrors = $validation->displayErrors();
			$this->view->render('register/login');
		}
		public function logoutAction(){
			if(currentUser()){
				currentUser()->logout();
			}
			Router::redirect('register/login');
		}
	}