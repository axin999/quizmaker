<?php
namespace App\Controllers;
use Core\Controller;
use Core\Router;
use Core\Session;
use Core\HP;
use App\Models\Users;
use App\Models\Categories;

class CategoriesController extends Controller{

	function __construct($controller,$action)
	{
		parent::__construct($controller,$action);
		$this->load_model('Categories');
		$this->view->setLayout('default');
	}

	public function indexAction(){
		$category_list = $this->CategoriesModel->listCategories();
		$this->view->postAddAction = PROJECT_ROOT . 'categories/add';
		$this->view->postEditAction = PROJECT_ROOT . 'categories/edit/';
		$this->view->postDeleteAction = PROJECT_ROOT . 'categories/delete/';
		$this->view->listCategories = $category_list;
		$this->view->render('categories/index');
	}

	public function addAction(){
		if($this->request->isPost()){	
			if(!empty($_POST['category']) && isset($_POST['category'])){
				$category = $this->request->get('category');
				$this->CategoriesModel->insertCategories($category);
				//Router::redirect('QuestionTypes/index');
			}
			Router::redirect('categories/index');
		}
	}

	public function editAction($id){
		$category = $this->CategoriesModel->findByIdAndUserId((int)$id,Users::currentUser()->user_id);
		if($this->request->isPost()){
			$get_category = $this->request->get();
			$category->assign($get_categories);
			$category->save();
			Router::redirect('categories/index');
			//var_dump($question_type);
		}		
		
		//pass the category value to view
		if($category){
			$this->view->category = $category;
		}
		$this->view->postEditAction = PROJECT_ROOT . 'category/edit/';
		$this->view->render('categories/edit');
	}

	public function deleteAction($id){
		$category = $this->CategoriesModel->findByIdAndUserId((int)$id,Users::currentUser()->user_id);
		if($category){
			$category->delete();
			Session::addMsg('success','Category has been deleted.');
		}
			Router::redirect('categories');
	}
}