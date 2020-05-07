<?php
namespace App\Models;
use Core\Model;
use Core\validators\RequiredValidator;
use Core\validators\MaxValidator;
	/**
	 * 
	 */
	class Contacts extends Model
	{
		public $id,$user_id,$fname,$lname,$email,$address,$address2,$city,$state,$zip;
		public $home_phone,$cell_phone,$work_phone,$deleted = 0;

		public function __construct()
		{
			$table = 'contacts';
			parent::__construct($table);
			$this->_softDelete = false;
		}

		public function validator(){
			$this->runValidation(new RequiredValidator($this,['field'=>'fname','msg'=>'First Name is required.']));
			$this->runValidation(new RequiredValidator($this,['field'=>'lname','msg'=>'last Name is required.']));
			$this->runValidation(new MaxValidator($this,['field'=>'fname','msg'=>'First Name must be less than 156 characters','rule'=>155]));
			$this->runValidation(new MaxValidator($this,['field'=>'lname','msg'=>'Last Name must be less than 156 characters','rule'=>155]));
		}

		public function findAllByUserId($user_id, $params=[]){
			$conditions = [
				'conditions' => 'user_id = ?',
				'bind' => [$user_id]
			]; 
			$conditions = array_merge($conditions,$params);
			//dnd($this->find($conditions));
			return $this->find($conditions);
		}

		public function displayName(){
			return $this->fname . ' ' . $this->lname;
		}

		public function findByIdAndUserId($contact_id,$user_id,$params=[]){
			$conditions = [
				'conditions' =>'id = ? AND user_id = ?',
				'bind' => [$contact_id,$user_id]
			];
			$conditions = array_merge($conditions,$params);
			return $this->findFirst($conditions);
		}

		public function displayAddress(){
			$address = '';
			if(!empty($this->address)){
				$address .= $this->address;
			}
			if(!empty($this->address2)){
				$address .= ' '.$this->address2;
			}
			if(!empty($this->city)){
				$address .= ' '.$this->city;
			}
			$address .= $this->state.' '. $this->zip. '<br>';
			return $address;
		}
		public function displayAddressLabel(){
			$html = $this->displayName() . '<br>';
			$html .= $this->displayAddress();
			return $html;
		}
	}