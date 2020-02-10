<?php
include("config/db_connect.php");
$question = $answer = $selected = '';
static $last_id;

/*get the all question type then echo to html select*/
$sql = "SELECT * FROM question_types;";
$result = mysqli_query($conn,$sql);
$questiontype2 = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);

$errors = array('question'=>'','answer'=>'');

	if(isset($_POST['submit'])){

		$selected = $_POST['questiontype'];

		if(empty($_POST['question'])){
			$errors['question'] = 'question is required';
			//echo htmlspecialchars('Question is required');
		}
		if(empty($_POST['answer'])){
			$errors['answer'] = 'answer is required';
		}
		/*else{
			$question = $_POST['question'];
			if(!preg_match('/^[a-zA-Z\s]+$/',)){
				echo htmlspecialchars('')
			}
		}*/
		if(array_filter($errors)){
		echo "there is some error";
		}

		/*INSERT QUESTION, ANSWER AND CHOICE TO DATABASE*/
		else{
			include("config/db_connect.php");
			$question = $_POST['question'];
			$post_answers = $_POST['answer'];
			$answers = array();
			foreach ($post_answers as $answer) {
				$answers[] = mysqli_real_escape_string($conn,$answer);
			};
			print_r($answers);




			//get the last array key of the variable answers
			$last_answer = array_key_last($answers);
			


			$question = mysqli_real_escape_string($conn,$question);
			//$answer = mysqli_real_escape_string($conn,$answers);
			$sql1 = "INSERT INTO questions(question,question_type) VALUES ('$question','$selected')";
			

			if(mysqli_query($conn,$sql1)){

				$last_id = mysqli_insert_id($conn);
				$sql2 = "INSERT INTO answers(question_id,answer) VALUES";
				foreach ($answers as $key => $value) {
					$key != $last_answer ? $sql2 .= "('$last_id','$value')," : $sql2 .= "('$last_id','$value')";
				};
				if(mysqli_query($conn,$sql2)){
					echo "Successfully inserted";
					//header('Location:'.$_SERVER['PHP_SELF']);
				}
				else{
					echo "2ndquery error".mysqli_error($conn);
				}		
			}

			/*Inserting choice*/

			if(!empty($_POST['choice'])){
				$choices = $_POST['choice'];
				$last_choice = array_key_last($choices);
				$sqlchoice = "INSERT INTO choices(question_id,choice) VALUES";
				foreach ($choices as $key => $choice) {
					$last_choice != $key ? $sqlchoice .="($last_id,'$choice')," : $sqlchoice .= "($last_id,'$choice')";
				};
					
				$querys = mysqli_query($conn,$sqlchoice);
			}
			else{
				echo "query error".mysqli_error($conn);
			}
			
			header('Location:'.$_SERVER['PHP_SELF']);
		}
		
	};

	function escapeArray($conn,$a){
		return mysqli_escape_string($conn,$a);
	}
?>


<!DOCTYPE html>
<html>
<section>
		<h4>Add Question</h4>
		<form id="add-qanda" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<label>Question:</label>
			<textarea name="question"></textarea>
			<div class="red-text"><?php echo htmlspecialchars($errors['question']); ?></div>

			<select name="questiontype">
				<!-- get the selected value and if equals to current quesyion type it will be selected  -->
			<?php foreach($questiontype2 as $key => $value){ ?>
				<option value="<?php echo htmlspecialchars($value['question_type_id']) ?>"
					<?php echo ($value['question_type_id'] == $selected)? 'selected=selected': '' ?>>
					<?php echo htmlspecialchars($value['question_type']) ?>
				</option>
			<?php } ?>
			</select>

			<a href="addquestiontype.php">Add question type</a>

			<!-- ASNSWER TAB -->
			<br>
			<br>
			<br>
			<!-- ADD ASNWER CONTAINER -->
			<div id="answer-container">	
				<div class="ans-elem-cont">
					<label for="answers">Answer:</label>
					<textarea class="answer" name="answer[]"></textarea>
					<input class="btn-add-moreanswer" type="button" name="" value="+">
					<div class=""><?php echo htmlspecialchars($errors['answer']); ?></div>
				</div>
			</div>	

			<!-- ADD CHOICES CONTAINER	 -->
			<input type="button" class="btn-add-choice" value="Add Choice">
			<div id="choices-container"></div>
			<div class="center">
				<input type="submit" name="submit" value="submit" class="bt- brand z-depth-0">
			</div>
		</form>
	</section>
</html>