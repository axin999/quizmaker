<?php 
use Core\FH;
?>
<?php $this->start('head'); ?>
 <meta content="test">
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<?= FH::inputBlock('text','Favorite Color', 'favorite_color','', ['class'=>'form-control'] , ['class'=> 'form-group']); ?>
<?= FH::submitBlock("Save", ['class' => 'btn btn-primary'], ['class'=>'float-right']); ?>
<div onclick="ajaxTest()">Click Me</div>
<script>
	function ajaxTest(){
		$.ajax({
			type:"POST",
			'url':'<?=PROJECT_ROOT?>home/testAjax',
			data:{model_id:45},
			success :function(resp){
				console.log(resp);
			}
		})
	}
</script>
<?php $this->end(); ?>