<?php
use Core\FH;
use Core\HP;
?>
<div class="container-md mx-auto">
	<form  action="<?= $this->postAction ?>" method="POST">
		<?= FH::textArea("Question","question",$this->question[0]->question,["class"=>"form-control"],['class' => 'form-group']) ?>
		<?php foreach ($this->question as $keyquestion => $keyvalue) : ?>
			<?= FH::textArea("Answers","answer[]",$keyvalue->answer,["class"=>"form-control"],['class' => 'form-group']) ?>
			<?= FH::hiddenInput("answer_id[]",$keyvalue->answer_id) ?>
		<?php endforeach ?>
		<?= FH::submitTag('Save',['class'=>'btn btn-primary']) ?>
	</form>
</div>