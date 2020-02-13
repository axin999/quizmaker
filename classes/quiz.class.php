<?php
namespace classes;

class Quiz extends Dbh{
private $totalcorrectans;
private $correct_ans;
private $quizresults;

public function __construct(){

}

public function computeQuizResult($userdata,$dbresults){
$totalquestion = $this->totalQuestion($dbresults);
$userdataIndex  = 0;
$correctcount = 0;
	//$useranswertolower = array_column($userdata, 'user_answer');
	$useranswertolower = array_diff(array_column($userdata, 'user_answer'), array_column($dbresults, 'answer'));

	foreach ($dbresults as $key => $dbresult) {

		if(in_array($dbresult['answer_id'], array_column($userdata,'answer_id'))){
			
			
/*			foreach ($userdata as $keyuserdata => $value) {
				echo  $keyuserdata;

			    if(in_array($dbresult['answer_id'], array_column($userdata,'answer_id'))) 
			   		$userdataIndex = $keyuserdata;
			   		break;
			    
			};*/

			for ($i=0; $i < count($userdata); $i++) { 
				if($dbresult['answer_id'] === $userdata[$i]['answer_id']) 
			   		$userdataIndex = $i;
			   		
			};
			//echo strcasecmp("suck"," suck");
			$noSpacedbAnswer = preg_replace('/\s+/', '',$dbresult['answer']);
			$noSpaceUserAnswer = preg_replace('/\s+/', '',$userdata[$userdataIndex]['user_answer']);
			if((strcasecmp($noSpacedbAnswer,$noSpaceUserAnswer)!== 0)){
				$this->quizresults[] = array(
					'question'=>$dbresult['question'],
					'useranswer'=>$userdata[$userdataIndex]['user_answer'],
					'correct_answer'=>$dbresult['answer'],
					'status'=>'wrong');

			}
			else{
				$correctcount++;
				$this->quizresults[] = array(
					'question'=>$dbresult['question'],
					'useranswer'=>$userdata[$userdataIndex]['user_answer'],
					'correct_answer'=>$dbresult['answer'],
					'status'=>'correct');
			};

			
			
		}
		
	};
	$userPoints = array(
		'totalquestion'=>$totalquestion,
		'correctcount'=>$correctcount);
	
	if($this->quizresults !== null){
		echo $this->mergeReresult($this->quizresults,$userPoints);
	}
	
}

public function totalQuestion($dbquestions){
	return count($dbquestions);
}
public function mergeReresult($result1,$result2){
	//$combineResult = array_merge($result1,$result2); 
	//$see = array();
	$result1 = $result1;
	$result1[] = $result2;
	return json_encode($result1);
}	
public function createQuiz(){
	$sql = "SELECT question_id,question,question_type,answer_id
			FROM questions q 
			LEFT JOIN answers a 
			USING(question_id)";
	$stmt = $this->connect()->prepare($sql);
	$stmt->execute();

	$result = $stmt->fetchAll();
	//print_r($result);
	//$grp_question('question_id',$result);
	

	echo json_encode($this->group_by('question_id',$result));
}

public function group_by($key,$data) {
    $result = array();

    foreach($data as $val) {
        if(array_key_exists($key, $val)){
            $result[$val[$key]][] = $val;
        }else{
            $result[""][] = $val;
        }
    }

    return $result;
}
}