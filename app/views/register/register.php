<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="container col-md-6 col-md-offset-3 fluid">
	<h3 class="text-center">Register here!</h3>
	<form class="form" action="" method="post">
		<div class="bg-light"><?= $this->displayErrors ?></div>
		<div class="form-group">
			<label for="fname">First Name:</label>
			<input type="text" name="fname" class="form-control" value="<?= $this->post['fname'] ?>">
		</div>
		<div class="form-group">
			<label for="lname">Last Name:</label>
			<input type="text" name="lname" class="form-control" value="<?= $this->post['lname'] ?>">
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="email" name="email" class="form-control" value="<?= $this->post['email'] ?>">
		</div>
		<div class="form-group">
			<label for="username">Choose a username:</label>
			<input type="text" name="username" class="form-control" value="<?= $this->post['username'] ?>">
		</div>
		<div class="form-group">
			<label for="password">Choose a password:</label>
			<input type="password" id="pass" name="password" class="form-control" value="<?= $this->post['password'] ?>">
		</div>
		<div class="form-group">
			<label for="confirmpass">Confirm Password:</label>
			<input type="password" id="confirmpass" name="confirmpass" class="form-control" value="<?= $this->post['confirmpass'] ?>">
		</div>
		<div class="pull-right">
			<input type="submit" class="btn btn-primary btn-large" value="Register">
		</div>		
	</form>
</div>
<?php $this->end(); ?>