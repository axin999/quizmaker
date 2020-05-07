<?php
namespace App\Models;
use Core\Model;
use App\Models\Users;
use App\Models\UserSessions;
use Core\Cookie;
use Core\Session;
use Core\Validators\MinValidator;
use Core\Validators\MaxValidator;
use Core\Validators\RequiredValidator;
use Core\Validators\EmailValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\UniqueValidator;
/**
 * 
 */
class Users extends Model{
	private $_isLoggedIn=false,$_sessionName, $_cookieName, $_confirm;
	public static $currentLoggedInUser = null;
	public $user_id,$username,$email,$password,$fname,$lname,$acl,$deleted = 0;

	public function __construct($user = ''){
		$table = 'users';
		parent::__construct($table);
		$this->_sessionName = CURRENT_USER_SESSION_NAME;
		$this->_cookieName = REMEMBER_ME_COOKIE_NAME;
		$this->_softDelete = true;
		if($user != ''){
			if(is_int($user)){
				$u = $this->_db->findFirst('users',['conditions'=>'user_id = ?','bind'=>[$user]],'App\Models\Users');
			}else{
				$u = $this->_db->findFirst('users',['conditions'=>'username=?','bind'=>[$user]],'App\Models\Users');
			}
			if($u){
				foreach ($u as $key => $val) {
					$this->$key = $val;
				}
			}
		}
	}

	public function validator(){
		$this->runValidation(new RequiredValidator($this,['field'=>'fname','msg'=>'First Name is required']));
		$this->runValidation(new RequiredValidator($this,['field'=>'lname','msg'=>'Last Name is required']));
		$this->runValidation(new RequiredValidator($this,['field'=>'email','msg'=>'Last Name is required']));
		$this->runValidation(new EmailValidator($this,['field'=>'email','msg'=>'Must be valid Email Address']));
		$this->runValidation(new MaxValidator($this,['field'=>'email','rule'=>150,'msg'=>'Email must be max of 150  characters.']));
		$this->runValidation(new MinValidator($this,['field'=>'username','rule'=>6,'msg'=>'Username must be at lest 6 characters.']));
		$this->runValidation(new MaxValidator($this,['field'=>'username','rule'=>150,'msg'=>'Username max of 150  characters.']));
		$this->runValidation(new UniqueValidator($this,['field'=>'username','msg'=>'Username already exist please use nmew one.']));
		$this->runValidation(new RequiredValidator($this,['field'=>'password','msg'=>'Password is required']));
		$this->runValidation(new MinValidator($this,['field'=>'password','rule' => 6,'msg'=>'Password atleast 6 character long']));
		if($this->isNew()){
			$this->runValidation(new MatchesValidator($this,['field'=>'password','rule'=>$this->_confirm,'msg'=>'Your Password do not match.']));
		}
	}

	public function beforeSave(){
		if($this->isNew()){
			$this->password = password_hash($this->password, PASSWORD_DEFAULT);			
		}
	}
	
	public function findByUsername($username){
		return $user = $this->findFirst(['conditions'=>'username = ?', 'bind'=>[$username]]);
		//dnd($user);
	}

	public static function currentUser(){
		if(!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)){
				$u = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
				self::$currentLoggedInUser = $u;
		} 
		return self::$currentLoggedInUser;
	}
	public function login($rememberMe = false){
		
		Session::set($this->_sessionName, $this->user_id);
		Session::set("LoggedIn",true);
		if($rememberMe){
			//dnd($_POST['remember_me']);
			$hash = md5(uniqid() + rand(0, 100));
			$user_agent = Session::uagent_no_version();
			Cookie::set($this->_cookieName,$hash,REMEMBER_ME_COOKIE_EXPIRY);
			$fields = ['session' => $hash,'user_agent'=>$user_agent,'user_id'=>$this->user_id];
			$this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->user_id, $user_agent]);
			$this->_db->insert('user_sessions', $fields);
		}
	}


	public static function loginUserFromCookie(){
		$userSession = UserSessions::getFromCookie();
/*		$user_session_model = new UserSessions();
		$user_session = $user_session_model->findFirst([
			'conditions' => "user_agent = ? AND session = ?",
			'bind' => [Session::uagent_no_version(), Cookie::get(REMEMBER_ME_COOKIE_NAME)]
		]);*/
		if($userSession && $user_session->user_id !=''){
			$user = new self((int)$user_session->user_id);
			if($user){
				$user->login();			
			}
			return $user;	
		}
		return;
	}
	
	public function logout(){
		//$user_agent = Session::uagent_no_version();
		$userSession = UserSessions::getFromCookie();
		if($userSession) $userSession->delete();
		//$this->_db->query("DELETE FROM user_session WHERE user_id = ? AND user_agent =?", [$this->id, $user_agent]);
		Session::delete(CURRENT_USER_SESSION_NAME);
		if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)){
			Cookie::delete(REMEMBER_ME_COOKIE_NAME);
		}
		self::$currentLoggedInUser = null;
		Session::delete("LoggedIn");
		return true;
	}

	public function acls(){
		if(empty($this->acl)) return [];
		return json_decode($this->acl, true);
	}

	public function setConfirm($value){
		$this->_confirm = $value;
	}

	public function getConfirm(){
		return $this->_confirm;
	}
}