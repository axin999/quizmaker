<?php
	/**
	 * 
	 */
	class Contacts extends Model
	{
		//public $deleted = 0;

		public function __construct()
		{
			$table = 'contacts';
			parent::__construct($table);
			$this->_softDelete = true;
		}
		public static $addValidation = [
			'fname' => [
				'display' => 'First name',
				'required' => true,
				'max' => 155
			],
			'lname' => [
				'display' => 'First name',
				'required' => true,
				'max' => 155
			]
		];

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