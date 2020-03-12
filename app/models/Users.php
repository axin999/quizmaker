<?php
/**
 * 
 */
class Users extends Model{
	private $_isLoggedIn, $_sessionName, $_cookieName;
	public static $currentLoggedInUser = null;
	public function __construct($user = ''){
		$table = 'users';
		parent::__construct($table);
		$this->_sessionName = CURRENT_USER_SESSION_NAME;
		$this->_cookiesName = REMEMBER_ME_COOKIE_NAME;
		$this->_softDelete = true;
		if($user != ''){
			if(is_int($user)){
				$u = $this->_db->findFirst('users',['conditions'=>'user_id = ?','bind'=>[$user]]);
			}else{
				$u = $this->_db->findFirst('users',['conditions'=>'username=?','bind'=>[$user]]);
			}
			if($u){
				foreach ($u as $key => $value) {
					$this->$key = $val;
				}
			}
		}
	}
	public function findByUsername($username){
		return $user = $this->findFirst(['conditions'=>'username = ?', 'bind'=>[$username]]);
		//dnd($user);
	}
	public function login($rememberMe = false){
		Session::set($this->_sessionName, $this->id);
		if($rememberMe){
			$hash = md5(uniqid()+ rand(0,100));
			$user_agent = Session::uagent_no_version();
			Cookie::set($this->cookieName,$hash,REMEMBER_ME_COOKIE_EXPIRY);
			$fields = ['session' => $hash,'user_agent'=>$user_agent,'user_id'=>$this->id];
			$this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
			$this->db->insert('user_session', $fields);
		}
	}
}