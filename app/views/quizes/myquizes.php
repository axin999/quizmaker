<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
	<?php foreach($this->user_quizes as $quiz): ?>
		<div class="card">
		  <div class="card-header">
		    <h3><?= $quiz->quiz_name; ?></h5>
		  </div>
		  <div class="card-body">
		    <h5 class="card-title">Special title treatment</h5>
		    <p class="card-text"><?= $quiz->quiz_description; ?></p>
		    <a href="#" class="btn btn-primary float-right">Start Quiz</a>
		  </div>
		</div>
	<?php endforeach; ?>
<?php $this->end(); ?>
