<?php
namespace App\Controllers;
use Core\Controller;
use Core\Session;
use Core\Router;
use App\Models\Contacts;
use App\Models\Users;
use Core\HP;

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
		$contacts = $this->ContactsModel->findAllByUserId(Users::currentUser()->user_id,['order'=>'lname, fname']);
		//HP::dnd($contacts);
		$this->view->contacts = $contacts;
		$this->view->render('contacts/index');
	}

	public function addAction(){
		$contact = new Contacts();
		if($this->request->isPost()){
			$this->request->csrfCheck();
			$contact->assign($this->request->get());
				$contact->user_id = Users::currentUser()->user_id;
				if($contact->save()){
					Router::redirect('contacts');
				}
		}
		$this->view->contact = $contact;
		$this->view->displayErrors = $contact->getErrorMessages();
		$this->view->postAction = PROJECT_ROOT . 'contacts' . '/' . 'add';
		$this->view->render('contacts/add'); 
	}

	public function editAction($id){
		$contact = $this->ContactsModel->findByIdAndUserId((int)$id,Users::currentUser()->user_id);
		if(!$contact) Router::redirect('contacts/edit');
		if($this->request->isPost()){
			$this->request->csrfCheck();
			$contact->assign($this->request->get());
				if($contact->save()){
					Router::redirect('contacts');
				}
				
			
		}
		$this->view->displayErrors = $contact->getErrorMessages();
		$this->view->contact = $contact;
		$this->view->postAction = PROJECT_ROOT . 'contacts' . '/' . 'edit' . DS . $contact->id;
		$this->view->render('contacts/edit');
	}

	public function detailsAction($id){
		$contact = $this->ContactsModel->findByIdAndUserId((int)$id,Users::currentUser()->user_id);
		if(!$contact){
			Router::redirect('contacts');
		}
		$this->view->contacts = $contact;
		$this->view->render('contacts/details');
	}

	public function deleteAction($id){
		$contact = $this->ContactsModel->findByIdAndUserId((int)$id,Users::currentUser()->user_id);
		if($contact){
			$contact->delete();
			Session::addMsg('success','Contact has been deleted.');
		}
			Router::redirect('contacts');
	}
}