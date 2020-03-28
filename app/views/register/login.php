<?php
use Core\FH;
?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>

<div class="container col-md-6 col-md-offset-3 fluid">
	<h3 class="text-center">Log In</h3>
	<form class="form" action="<?=PROJECT_ROOT?>register/login" method="POST">
		<?= FH::csrfInput() ?>
		<?= FH::displayErrors($this->displayErrors) ?>
		<?= FH::inputBlock('text','Username','username',$this->login->username,['class'=>'form-control'],['class'=>'form-group']) ?>
		<?= FH::inputBlock('password','Password','password',$this->login->password,['class'=>'form-control'],['class'=>'form-group']) ?>
		<?= FH::checkboxBlock('Remember Me','remember_me',$this->login->getRememberMechecked(),[],['class'=>'form-group']) ?>
		<?= FH::submitBlock('Login', ['class'=>'btn btn-large btn-primary'],['class'=>'form-group'])?>
		<div class="text-right">
			<a href="<?=PROJECT_ROOT?>register/register" class="text-primary">Register</a>
		</div>
	</form>
</div>
<?php $this->end(); ?>