<?php
	include('./config/db_connect.php');
	session_start();
	session_unset();
	

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
	if(isset($_GET['quiz'])){
		$limitquestion = 1;
		if(isset($_GET['limit'])){
			if(is_numeric($_GET['limit']) && $_GET['limit'] >= 1){
				$limitquestion = $_GET['limit'];
			}
		};

		$sql = "SELECT question_id,question,question_type,answer_id
		 FROM questions q 
			LEFT JOIN answers a 
			USING(question_id) 
			#ORDER BY RAND()
			LIMIT $limitquestion";
		$query = mysqli_query($conn,$sql);
		$result = mysqli_fetch_all($query,MYSQLI_ASSOC);
		//print_r($result);
		$grp_question = group_by('question_id',$result);
		//print_r($grp_question);
		echo json_encode($grp_question);
	};
	
	if(isset($_POST['quiz'])){
		$sql = "SELECT question_id,question,question_type,answer_id
		LEFT JOIN answers a 
		USING(question_id)";
		$query = mysqli_query($conn,$sql);
		$result = mysqli_fetch_all($query,MYSQLI_ASSOC);
		$grp_question = group_by('question_id',$result);
		echo json_encode($result);
	};

	if(isset($_POST['next'])){
		$_SESSION['i'] = isset($_SESSION['i']) ? ++$_SESSION['i'] : 0;
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


function group_by($key,$data) {
    $result = array();

    foreach($data as $val) {
        if(array_key_exists($key, $val)){
            $result[$val[$key]][] = $val;
        }else{
            $result[""][] = $val;
        }
    }

    return $result;
};
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

