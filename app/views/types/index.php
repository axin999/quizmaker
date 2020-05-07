<?php $this->start('body'); ?>
<form action="<?= $this->postAddAction ?>" method="POST">
	<div class="row justify-content-center align-items-center p-3">
		<div class="col col-md-6">
			<div class="card">
			<div class="card-header">
				<button type="button" id="addtype" class="btn btn-success btn-lg btn-block">Add Question Type</button>
				<button type="submit" id="submittype" class="btn btn-primary btn-lg btn-block">Update Question Type</button>
			</div>
			<div class="card-body" id="add_question_type_container">
				
			</div>
			<div class="card-footer text-muted">
			<label>List of types:</label>
				<ul class="list-group list-group-flush">
					<?php foreach($this->question_type_list as $question_type): ?>
						<li class="list-group-item"><?= $question_type->question_type_name; ?>
							<div class="float-right">
								<div class="btn-group" role="group" aria-label="Edit Button Group">
									<a class="btn btn-primary btn-sm" href="<?= $this->postEditAction.$question_type->question_type_id ?>"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" href="<?= $this->postDeleteAction.$question_type->question_type_id ?>" onclick="if(!confirm('Are you sure?')){return false;}"><i class="fa fa-trash"></i></a>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			</div>			
		</div>
	</div>
</form>
<?php $this->end(); ?>