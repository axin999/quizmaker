<?php
namespace App\Models;
use Core\Session;
use Core\Cookie;
use Core\Model;

class UserSessions extends Model{
	
	public $session_id,$user_id,$session,$user_agent;

	public function __construct(){
		$table = 'user_sessions';
		parent::__construct($table);
	}
	public static function getFromCookie(){
		if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)){
			$userSession = new self();
			$userSession = $userSession->findFirst([
				'conditions' => "user_agent = ? AND session =?",
				'bind' => [Session::uagent_no_version(),Cookie::get(REMEMBER_ME_COOKIE_NAME)]
			]);
		}
		if(!$userSession) return false;
		return $userSession;
	}
}