<?php
	/**
	 * 
	 */
	class RestrictedController extends Controller{
		
		public function __construct()
		{
			parent::__construct($controller, $action);
		}
		public function indexAction(){
			$this->view->render('restricted/index');
		}

	}