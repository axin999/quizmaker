
<!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>

<input type="button" id="create" name="create" value="Create">
<!-- <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	
	
</form> -->
<div id="quiz-container"></div>
<form method="POST" action="quiz_result.php">
	<input id="testing" type="textarea" name="useranswer" value="">
	<input type="submit" name="answers">
</form>

<div id="score-container">
	
</div>
<div id="result-container">

</div>

<!-- sends data to other external javascript files -->
<script type="text/javascript">
</script>

<?php include('templates/footer.php') ?>
</html>