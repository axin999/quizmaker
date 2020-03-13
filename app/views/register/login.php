<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>

<div class="container col-md-6 col-md-offset-3 fluid">
	
	<form class="form" action="<?=PROJECT_ROOT?>register/login" method="POST">
		<div class=""><?= $this->displayErrors ?></div>
		<h3 class="text-center">Log In</h3>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" value="" class="form-control">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control">
		</div>
		<div class="form-grouo">
			<label for="remeber_me">Remember Me <input type="checkbox" id="remeber_me" name="remeber_me" value="on"></label>
		</div>
		<div class="form-group">
			<input type="submit" name="" value="Login" class="btn btn-large btn-primary">
		</div>
		<div class="text-right">
			<a href="<?=PROJECT_ROOT?>register/register" class="text-primary">Register</a>
		</div>
	</form>
</div>
<?php $this->end(); ?>