<?php
namespace Core;
use Core\Session;
class FH 
{

	public static function inputBlock($type, $label, $name, $value = "", $inputAttribs =[], $divAttribs=[]){
		$divString = self::strringifyAttribs($divAttribs);
		$inputString = self::strringifyAttribs($inputAttribs);
		$html  = '<div' . $divString . '>';
		$html .= '<label for="'.$name.'">'.$label.'</label>';
		$html .= '<input type ="'.$type.'" id="'.$name.'" name="'.$name.'" value="'.$value.'"'.$inputString.' />';
		$html .= '</div>'; 
		return $html;
	}

	public static function textArea($label, $name, $value = "", $inputAttribs =[], $divAttribs=[]){
		$divString = self::strringifyAttribs($divAttribs);
		$inputString = self::strringifyAttribs($inputAttribs);
		$trimmed_name = rtrim($name,"[]");
		$html  = '<div' . $divString . '>';
		$html .= '<label for="'.$trimmed_name.'">'.$label.'</label>';
		$html .= '<textarea id="'.$trimmed_name.'" name="'.$name.'" '.$inputString.' />'.$value.'</textarea>';
		$html .= '</div>'; 
		return $html;
	}
	public static function hiddenInput($idName,$value){
		$trimmed_idName = rtrim($idName,"[]");
		$html = ' <input type="hidden" id="'.$trimmed_idName.'" name="'.$idName.'" value="'.$value.'">';
		return $html;
	}

	public static function submitTag($buttonText, $inputAtrribs = []){
		$inputString = self::strringifyAttribs($inputAtrribs);
		$html = '<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
		return $html;
	}

	public static function submitBlock($buttonText, $inputAttribs = [], $divAttribs=[]){
		$divString = self::strringifyAttribs($divAttribs);
		$inputString = self::strringifyAttribs($inputAttribs);
		$html = '<div'.$divString.'>';
		$html .='<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
		$html .='</div>';
		return $html;
	}

	public static function checkboxBlock($label,$name,$checked=false,$inputAttrs=[],$divAttrs=[]){
		$divString = self::strringifyAttribs($divAttrs);
		$inputString = self::strringifyAttribs($inputAttrs);
		$checkString = ($checked) ? 'checked="checked"' : '';
		$html = '<div'.$divString.'>';
		$html .= '<label for="'.$name.'">'.$label.'<input type="checkbox" id="'.$name.'" name="'.$name.'" value="on"'.$checkString.$inputString.'></label>';
		$html .= '</div>';
		return $html;
	}

	public static function strringifyAttribs($attrs){
		$string = '';
		foreach($attrs as $key => $val){
			$string .= ' ' .$key. '="' .$val . '"';
		}
		return $string;
	}       
	
	public static function generateToken(){
		$token = base64_encode(openssl_random_pseudo_bytes(32));
		Session::set('csrf_token',$token);
		return $token;
	}

	public static function checkToken($token){
		return (Session::exists('csrf_token') && Session::get('csrf_token') == $token);
	}

	public static function csrfInput(){
		return '<input type="hidden" name="csrf_token" id="csrf_token" value="'.self::generateToken().'" />';
	}

	public static function sanitize($dirty){
		if(is_array($dirty)){
			return array_map('htmlentities', $dirty);
		}
		return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
	}

	public static function posted_values($post){
		$clean_ary = [];
		foreach ($post as $key => $value) {
			$clean_ary[$key] = self::sanitize($value);
		}
		echo "na clean";
		return $clean_ary;
	}

	public static function displayErrors($errors){
	$hasErrors = (!empty($errors)) ? ' has-errors' : '';
	$html = '<div class="form-errors"><ul class="'.$hasErrors.'">';
	$html .= '<ul class="'.$hasErrors.'">';
	foreach ($errors as $field => $error) {
			$html .= '<li class="text-danger">'.$error.'</li>';
			$html .= '<script>
			jQuery("document").ready(
			function(){
				jQuery("#'.$field.'").addClass("is-invalid");
			});
			</script>';

	}
	$html .= "</ul></div>";
	return $html;
	}

}