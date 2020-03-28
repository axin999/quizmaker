<?php
namespace Core\Validators;
use Core\Validators\CustomValidator;
 /**
  * 
  */
 class UniqueValidator extends CustomValidator
 {	
	public function runValidation(){
		$field = (is_array($this->field)) ? $this->field[0] : $this->field;
		$value = $this->_model->{$field};

		$conditions = ["{$field} = ?"];
		$bind =[$value];

		if(!empty($this->_model->user_id)){
			$conditions[] = "user_id != ?";
			$bind[] = $this->_model->user_id;
		}

		if(is_array($this->field)){
			array_unshift($this->field);
			foreach ($this->field as $adds) {
				$conditions[] = "{$adds} = ?";
				$bind[] = $this->_model->{$adds};
 			}
		}
		//HP::dnl($conditions);		
		$queryParams = ['conditions'=>$conditions,'bind'=>$bind];
		$other = $this->_model->findFirst($queryParams);
/*		$sql = "SELECT * FROM users WHERE username = ?";
		$other2 = $this->_model->query($sql,['engelbert']);*/
		//HP::dnd($queryParams);
		return (!$other);
	}
 }
