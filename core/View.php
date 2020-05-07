<?php
namespace Core;

 class View {
 	protected $_head, $_body, $_siteTitle = SITE_TITLE, $_outputBuffer, $_layout = DEFAULT_LAYOUT;
 	public $displayErrors;	// <-- added by me.

 	public function __construct()
 	{
 	}

 	public function render($viewName){
 		$viewArray = explode('/', $viewName);
 		$viewString = implode(DS, $viewArray);
 		if(file_exists(ROOT. DS . 'app' . DS .'views' . DS . $viewString. '.php')){
 			include(ROOT . DS . 'app' . DS .'views' . DS . $viewString . '.php');
 			include(ROOT . DS . 'app' . DS .'views' . DS . 'layouts' . DS . $this->_layout . '.php');
 		}
 		else{
 			die("The view \'" .$viewName ."\'does not exist");
 		}
 	}
 

 public function content($type) {
 	if($type == 'head'){
 		return $this->_head;

 	}
 	elseif($type == 'body'){
 		return $this->_body;
 	}
 	return false;
 }

 public function start($type){
 	$this->_outputBuffer = $type;
 	ob_start();
 }
  public function end(){
 	if($this->_outputBuffer == 'head'){
 		$this->_head = ob_get_clean();
 	}
 	elseif ($this->_outputBuffer == 'body') {
 		$this->_body = ob_get_clean();
 	}
 	else{
 		die('you must first run start method');
 	}
 }
  public function setTitle(){
  	return $this->_siteTitle;
 	
 }
  public function setSiteTitle($title){
 	return $this->_siteTitle = $title;
 }
  public function setLayout($path){
 	$this->_layout = $path;
 }
 public function insert($path){
 	include ROOT. DS . 'app' .DS . 'views' . DS . $path . '.php';
 }

 public function partial($group, $partial){
	$subpartials = explode("/", $partial);
	
	if(count($subpartials)<=1){
		$file_path = ROOT. DS . 'app' . DS . 'views' . DS . $group . DS . $partial;
		if(file_exists($file_path)){
			include ROOT. DS . 'app' . DS . 'views' . DS . $group . DS . $partial . '.php';
		}				
	}else{
		$file_path = ROOT. DS . 'app' . DS . 'views' . DS . $group . DS;
		foreach ($subpartials as $subs ) {
			$file_path .= $subs. DS; 
		}
		$final_path = rtrim($file_path,DS) . '.php';
		include $final_path;
	}
 }

 }