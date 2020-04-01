<?php
use Core\HP;
?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>

<div class="container-sm">
	<?php foreach ($this->questions as $questionkey => $questionval): ?>
		<div class="card m-4">
			<h5 class="card-header"><?= $questionval[0]['question'] ?></h5>
			<div class="card-body">
			<h5 class="card-title">Answers:</h5>
				<ul>					
					<?php foreach ($questionval as $key => $value):?>
						<li>
							<p class="card-text"><?= $value['answer'] ?></p>
						</li>
					<?php endforeach ?>
				</ul>
			<a href="<?= PROJECT_ROOT?>questions/edit/<?= $value['question_id'] ?>" class="btn btn-info btn-xs">
		 		<i class="glyphicon glypicon-pencil"></i>Edit
		 	</a>
		 	<a href="" class="btn btn-danger btn-xs" onclick="if(!confirm('Are you sure?')){return false;}">
		 		<i class="glyphicon glypicon-remove"></i>Delete
		 	</a>
			</div>
		</div>
	<?php endforeach?>
</div>
<?php $this->end(); ?>
