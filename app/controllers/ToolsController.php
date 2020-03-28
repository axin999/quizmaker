<?php
namespace App\Controllers;
use Core\Controller;

	class ToolsController extends Controller{
		
		public function __construct()
		{
			parent::__construct($controller,$action);
		}

		public function indexAction(){
			$this->view->render('tools/index');
		}
		public function firstAction(){
			$this->view->render('tools/first');
		}
		public function secondAction(){
			$this->view->render('tools/second');
		}
		public function thirdAction(){
			$this->view->render('tools/third');
		}

	}