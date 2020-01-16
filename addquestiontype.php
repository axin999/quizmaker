<?php
include('config/db_connect.php');
$errors = array('question_type'=>'');

/*Add questin types*/
if(isset($_POST['addtype'])){
	$question_type = $_POST['question_type'];
	if(!empty($_POST['question_type'])){
		$sql = "INSERT INTO question_types (question_type) VALUES('$question_type') ";

		if(mysqli_query($conn,$sql)){
			echo "ADD SUCCESS";
		}
		else{
			echo "FAILED".mysqli_error($conn);
		}
	}
	else{
		$errors['question_type'] = 'Fill up this field';
	}
	
}
else{

}
/*View Question types*/
	$sql = "SELECT * FROM question_types";

	$result = mysqli_query($conn,$sql);
	$question_types = mysqli_fetch_all($result,MYSQLI_ASSOC);
	mysqli_free_result($result);

	/*  Delelete Question Type  */

	if(isset($_POST['deletetype'])){
		$question_type_id = $_POST['question_type_id'];
		$sql = "DELETE FROM question_types WHERE question_type_id = $question_type_id ";

		if(mysqli_query($conn,$sql)){
			header("Location:".$_SERVER['PHP_SELF']);
		}
	}
 ?>


	
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<?php include('templates/header.php')?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	<input type="text" name="question_type">
	<div class=""><?php echo htmlspecialchars($errors['question_type'])?></div>
	<input type="submit" name="addtype">
</form>
<table>
	<tr>
		<th>Question Type</th>
	</tr>
	<?php foreach($question_types as $question_type): ?>
	<tr>
		<td><?php echo htmlspecialchars($question_type['question_type'])?></td>
		<td>edit</td>
		<td>
			<form action="<?php echo$SERVER['PHP_SELF'] ?>" method="POST">
				<input type="hidden" name="question_type_id" value="<?php echo $question_type['question_type_id'] ?>">
				<input type="submit" name="deletetype" value="DELETE">
			</form>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php include('templates/footer.php')?>
</html>