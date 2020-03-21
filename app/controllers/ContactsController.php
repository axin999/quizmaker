<?php

/**
 * 
 */
class ContactsController extends Controller
{
	
	public function __construct($controller,$action)
	{
		parent::__construct($controller,$action);
		$this->view->setLayout('default');
		$this->load_model('Contacts');
		$this->_softDelete = true;
	}

	public function indexAction(){
		$contacts = $this->ContactsModel->findAllByUserId(currentUser()->user_id,['order'=>'lname, fname']);//dnd($contacts);
		$this->view->contacts = $contacts;
		$this->view->render('contacts/index');
	}

	public function addAction(){
		$contact = new Contacts();
		$validation = new Validate();
		if($_POST){
			$contact->assign($_POST);
			$validation->check($_POST, Contacts::$addValidation);
			if($validation->passed()){
				$contact->user_id = currentUser()->user_id;
				$contact->deleted = 0;
				$contact->save();
				Router::redirect('contacts');
			}
			
		}
		$this->view->contact = $contact;
		$this->view->displayErrors = $validation->displayErrors();
		$this->view->postAction = PROJECT_ROOT . 'contacts' . '/' . 'add';
		$this->view->render('contacts/add'); 
	}

	public function editAction($id){
		$contact = $this->ContactsModel->findByIdAndUserId((int)$id,currentUser()->user_id);
		if(!$contact) Router::redirect('contacts/edit');
		$validation = new Validate();
		if($_POST){
			$contact->assign($_POST);
			$validation->check($_POST,Contacts::$addValidation);
			if($validation->passed()){
				$contact->save();
				Router::redirect('contacts');
			}
		}
		$this->view->displayErrors = $validation->displayErrors();
		$this->view->contact = $contact;
		$this->view->postAction = PROJECT_ROOT . 'contacts' . '/' . 'edit' . DS . $contact->id;
		$this->view->render('contacts/edit');
	}

	public function detailsAction($id){
		$contact = $this->ContactsModel->findByIdAndUserId((int)$id,currentUser()->user_id);
		if(!$contact){
			Router::redirect('contacts');
		}
		$this->view->contacts = $contact;
		$this->view->render('contacts/details');
	}

	public function deleteAction($id){
		$contact = $this->ContactsModel->findByIdAndUserId((int)$id,currentUser()->user_id);
		if($contact){
			$contact->delete();
		}
			Router::redirect('contacts');
	}
}