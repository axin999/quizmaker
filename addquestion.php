<?php
include("config/db_connect.php");
$question = $answer = $selected = '';

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

		/*INSERT QUESTION AND ANSWER TO DATABASE*/
		else{
			include("config/db_connect.php");
			$question = mysqli_real_escape_string($conn,$_POST['question']);
			$answer = mysqli_real_escape_string($conn,$_POST['answer']);

			$sql1 = "INSERT INTO questions(question,question_type) VALUES ('$question','$selected')";
			

			if(mysqli_query($conn,$sql1)){

				$last_id = mysqli_insert_id($conn);
				echo "$last_id";
				$sql2 = "INSERT INTO answers(question_id,answer) VALUES ($last_id,'$answer')";
				if(mysqli_query($conn,$sql2)){
					echo "Successfully inserted";
					header('Location:'.$_SERVER['PHP_SELF']);
				}
				else{
					echo "2ndquery error".mysqli_error($conn);
				}		
			}
			else{
				echo "query error".mysqli_error($conn);
			}
			
			
		}
	}


?>

<!DOCTYPE html>
<html>
<section>
		<h4>Add Question</h4>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
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
			<label for="answers">Answer:</label>
			<textarea name="answer"></textarea>
			<div class=""><?php echo htmlspecialchars($errors['answer']); ?></div>
			<div class="center">
				<input type="submit" name="submit" value="submit" class="bt- brand z-depth-0">
			</div>
		</form>
	</section>
</html>