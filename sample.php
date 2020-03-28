<?php 
phpinfo();
die();
$kun = 100;
$somearray  = array('1','2','3','4');
$conn = array(10,100,1000,10000);
$a = array_map(function($suck,$kun){
	$a = dbconn($kun);
	return $a + $suck;
},$somearray,(array)$kun);
print_r($a);
/*$boom = function suck($pussy,$conn){
	$luh = $pussy + $conn;
	return $luh; 
}
print_r($boom);*/
function dbconn($sala){
	return $sala;
};

$viewarray = array();



foreach ($somearray as $arrr) {
	$viewarray[] = $arrr;

};
print_r($viewarray);
?>


















<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<div id="qcontainer">
			<select id="selectQuestionType">
				<option value="1">Multiple Choice</option>
				<option value="2">Problem Solving</option>
				<option value="3">Identification</option>
				<option selected="selected" value="4">Enumeration</option>
				<option value="5">Fill In The Blank</option>
				<?php echo htmlspecialchars_decode("<option>wetpus</option>") ?>
			</select>
		</div>

		<div id="question-type-format">
			<ul>
				<li class="answers">jaka</li>
				<li class="answers">wussy</li>
				<li class="answers">with</li>
				<li class="answers">creamy</li>
			</ul>
		</div>
		<div id="question-type-container">
			
		</div>

















	<script type="text/javascript">
		let s = document.getElementById('selectQuestionType');
		let v = s.options[s.selectedIndex].value;
		let as = Array.from(s);
		let tname = document.getElementsByTagName('option');
		let byquery = document.querySelectorAll('#selectQuestionType option');
		let getanswers = document.querySelector('#question-type-format');
		getanswers.addEventListener('click',function(e){
				let addSomthing = e.target.parentElement;
				//addSomthing.innerHTML = 'asdasd';
				console.log('ho',e.target.parentElement);

			});



			let getTypeValue = document.querySelector('#selectQuestionType');
			let container = document.querySelector('#question-type-container');
			console.log('getTypeValue',getTypeValue.value)

			getTypeValue.addEventListener('change',function(e){
				console.log(e.target.value);
				let jaka = e.target.value;
				console.log(typeof jaka);
				switch(parseInt(e.target.value)){
				case 1:
					container.innerHTML = 'format1';
				break;
				case 2: 
					container.innerHTML = 'format2';
				break;
				case 3:
					container.innerHTML = 'format3';
				break;
				case 4:
					container.innerHTML = 'format4';
				break;
				case 5:
					container.innerHTML = 'format5';
				break;
				default:
					container.innerHTML = 'format6';
				break;
				}
			});

			
		
		switch(document.getElementById('selectQuestionType')){
			case 1:
			break;
			case 2:  
			break;
			case 3:
			break;
			case 4:
			break;
			case 5:
			break;
			default:
		}
		
		/*s.textContent = '<option value="1">Multiple Choice</option>';
		console.log('byid:', s.textContent);
		console.log('converted in array fucntion:',as[0]);
		console.log('sadf',s.textContent);
		console.log(byquery);*/
	</script>
	</body>
</html>
