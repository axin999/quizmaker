<?php 

	include('config/db_connect.php');

	//wrirte query for all question

	$sql = 'SELECT * FROM questions AS q JOIN answers AS a ON q.question_id = a.question_id';

	// make query & get result
	$result = mysqli_query($conn,$sql);

	//fetch the resulting rows as an array

	$question_answers = mysqli_fetch_all($result,MYSQLI_ASSOC);
	// free the results
	mysqli_free_result($result);
	//close connection
	mysqli_close($conn);
	

if (isset($_POST['delete'])) {
	include('config/db_connect.php');
	$id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);
	$sql = "DELETE FROM questions where question_id = $id_to_delete";
	if(mysqli_query($conn,$sql)){
		header('Location:index.php');
	}else{
		echo 'MYSQL_ERROR:'.mysqli_error($conn);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Main</title>
</head>

	<?php include 'templates/header.php'; ?>
	<?php include 'addquestion.php'; ?>
	<h4>Questions</h4>
	<div class="container">
		<table>	
			<tr>
				<th>ID</th>
				<th>Question</th>
				<th>Question Type</th>
				<th>Answer</th>
			</tr>			
			<?php foreach ($question_answers as $qanda) : ?>
			<tr>
				<td><?php echo htmlspecialchars($qanda['question_id']) ?></td>
				<td><?php echo htmlspecialchars($qanda['question']) ?></td>
				<td><?php echo htmlspecialchars($qanda['question_type'])?></td>
				<td><?php echo htmlspecialchars($qanda['answer'])?></td>
				<td><a href="">edit</td>
				<td>
					<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
						<input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($question['question_id']) ?>">
						<input type="submit" name="delete" value="Delete">
					</form>
				</td>
			</tr>
			<?php endforeach ?>

			<!-- DELETE FORM -->
			
		</table>

	</div>
	<?php include 'templates/footer.php';?>
</html>