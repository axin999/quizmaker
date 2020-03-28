<?php 
use Core\FH;
?>
<form class="form-row" action="<?= $this->postAction ?>" method="POST">
	<div class="custom-control col-md-12 form-errors"><?= FH::displayErrors($this->displayErrors) ?></div>
	<?= FH::csrfInput() ?>
	<?= FH::inputBlock('text','First Name', 'fname',$this->contact->fname,['class' => 'form-control'],['class' => 'form-group col-md-6'])?>
	<?= FH::inputBlock('text','Last Name', 'lname',$this->contact->lname,['class' => 'form-control'],['class' => 'form-group col-md-6'])?>
	<?= FH::inputBlock('text','Address', 'address',$this->contact->address,['class' => 'form-control'],['class' => 'form-group col-md-6'])?>
	<?= FH::inputBlock('text','Address 2', 'address2',$this->contact->address2,['class' => 'form-control'],['class' => 'form-group col-md-6'])?>
	<?= FH::inputBlock('text','City', 'city',$this->contact->city,['class' => 'form-control'],['class' => 'form-group col-md-5'])?>
	<?= FH::inputBlock('text','State', 'state',$this->contact->state,['class' => 'form-control'],['class' => 'form-group col-md-3'])?>
	<?= FH::inputBlock('text','ZIP', 'zip',$this->contact->zip,['class' => 'form-control'],['class' => 'form-group col-md-4'])?>
	<?= FH::inputBlock('text','E-MAIL', 'email',$this->contact->email,['class' => 'form-control'],['class' => 'form-group col-md-6'])?>
	<?= FH::inputBlock('text','Chell Phone', 'cell_phone',$this->contact->cell_phone,['class' => 'form-control'],['class' => 'form-group col-md-6'])?>
	<?= FH::inputBlock('text','Home Phone', 'home_phone',$this->contact->home_phone,['class' => 'form-control'],['class' => 'form-group col-md-6'])?>
	<?= FH::inputBlock('text','Work Phone', 'work_phone',$this->contact->work_phone,['class' => 'form-control'],['class' => 'form-group col-md-6'])?>
	<div class="text-right">
		<a href="<?=PROJECT_ROOT?>contacts" class="btn btn-secondary">Cancel</a>
		<?= FH::submitTag('Save',['class'=>'btn btn-primary']) ?>
	</div>
</form>