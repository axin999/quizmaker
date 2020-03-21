<?php
	function inputBlock($type, $label, $name, $value = "", $inputAttribs =[], $divAttribs=[]){
		$divString = strringifyAttribs($divAttribs);
		$inputString = strringifyAttribs($inputAttribs);
		$html  = '<div' . $divString . '>';
		$html .= '<label for="'.$name.'">'.$label.'</label>';
		$html .= '<input type ="'.$type.'" id="'.$name.'" name="'.$name.'" value="'.$value.'"'.$inputString.' />';
		$html .= '</div>'; 
		return $html;
	}

	function submitTag($buttonText, $inputAtrribs = []){
		$inputString = strringifyAttribs($inputAtrribs);
		$html = '<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
		return $html;
	}

	function submitBlock($buttonText, $inputAttribs = [], $divAttribs=[]){
		$divString = strringifyAttribs($divAttribs);
		$inputString =strringifyAttribs($inputAttribs);
		$html = '<div'.$divString.'>';
		$html .='<input type="submit" value="'.$buttonText.'"'.$inputString.' />';
		$html .='</div>';
		return $html;
	}

	function strringifyAttribs($attrs){
		$string = '';
		foreach($attrs as $key => $val){
			$string .= ' ' .$key. '="' .$val . '"';
		}
		return $string;
	}       