<?php
	include('./config/db_connect.php');
	session_start();
	//session_unset(); // unset($_SESSION['sessionnamehere']);
	$sql = "SELECT * FROM questions";
	$query = mysqli_query($conn,$sql);
	$result = mysqli_fetch_all($query);
	//print_r($result);
	$personObj = new person();
	//echo $personObj->fname = 'gilpogi';
	$people = array(
		array("name"=>"gil","midlename"=>"bajog","lastname"=>"villar"),
		array("name"=>"naruto","midlename"=>"namikaze","lastname"=>"uzumaki"),
		array("name"=>"yato","midlename"=>"neko","lastname"=>"godofwar"),
		array("name"=>"joseph","midlename"=>"oraoraora","lastname"=>"joestar"),
		array("name"=>"dio","midlename"=>"nani","lastname"=>"zawarudo")
	);
	$peopletojava = json_encode($people);
	//print_r($peopletoja);
/*	$peopleArrObject =array()*/

	if(isset($_POST['next'])){
		$counter = $_SESSION['i'] = isset($_SESSION['i']) ? ++$_SESSION['i'] : 0;
        echo $_SESSION['i'];
		$wew = $people[$counter];
			$wusyy = current($people);
			$pussy = next($people);
			unset($wusyy);
		print_r($wew); echo "<br>";
		//print_r($pussy); echo "<br>";
		$counter++;
		echo $counter;					
	};

	echo $people[0]['name'];
	class quiz{
		var $question;
		var $answer;
		var $choices;
		public function create_quiz(){}
	};
	class person {
		var $fname;
		var $middlename;
		var $lastname;
	}



$suckme = 1;
	echo $suckme."<br>";
$wuzzy = new $suckme(2);
	echo "$wuzzy";


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<input type="submit" name="next" value="Next">
	</form>
<script type="text/javascript" src="./js/sample.js" ></script>
</body>
</html>