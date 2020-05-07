<?php
use Core\FH;
use Core\HP;
?>
<div class="container-md mx-auto">
	<div class="custom-control col-md-12 form-errors"><?= FH::displayErrors($this->displayErrors) ?></div>
	<form  action="<?= $this->postAction ?>" method="POST">
		<?= FH::csrfInput() ?>
		<?= FH::textArea("Question","question",$this->question,["class"=>"form-control"],['class' => 'form-group']) ?>
		<input id="addanswer" type="button" name="" value="ADD" class="btn btn-success form-control">
		<div id="answers-container">
			<?php if(!empty($this->answer))foreach ($this->answer as $keyanswer => $keyvalue) : ?>
				<?= FH::textArea("Answers","answer[]",$keyvalue->answer,["class"=>"form-control"],['class' => 'form-group']) ?>
				<?= FH::hiddenInput("answer_id[]",$keyvalue->answer_id) ?>
			<?php endforeach ?>			
		</div>
		<?= FH::submitTag('Save',['class'=>'btn btn-primary']) ?>
	</form>
</div>