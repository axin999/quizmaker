<?php
namespace App\Models;
use Core\Model;
use App\Models\Users;

class Categories extends Model{

	public $category_id,$user_id,$category_name,$created_at;
	protected $_primaryKey = "category_id";

	function __construct()
	{
		$table = 'Categories';
		parent::__construct($table);
	}

	public function listCategories(){
		$this->user_id = Users::currentUser()->user_id;
		$categories = $this->all()
		->where("user_id","=",[$this->user_id])
		->get();

		return $categories;
	}

	public function insertCategories($data){
		$categories = array();
		$user_id = Users::currentUser()->user_id;
		foreach ($data as $category) {
			if (!empty($category)) {
				$categories[] = ['user_id' =>$user_id,'category_name'=>$category];
			}
		}
		$this->insert($categories);
	}

	public function findByIdAndUserId($category_id,$user_id,$params=[]){
			$conditions = [
				'conditions' =>'category_id = ? AND user_id = ?',
				'bind' => [$category_id,$user_id]
			];
			$conditions = array_merge($conditions,$params);
			return $this->findFirst($conditions);
		}

}