<?php $this->start('body'); ?>
<div class="row justify-content-center align-items-center m-3">
	<div class="col col-md-6">
		<div class="card">
			<div class="card-header"><h5>Edit</h5></div>
			<div class="card-body">
				<form action="<?= $this->postEditAction.$this->category->category_id ?>" method="POST">
					<div class="form-row align-items-center">
						    <div class="col-auto">
						      <label class="sr-only" for="question_type_input">Name</label>
						      <input type="text" name="category" class="form-control mb-2"  id="question_type_input" value="<?= $this->category->category_name ?>">
						    </div>
							<div class="col-auto">
						      <button type="submit" class="btn btn-primary mb-2">Submit</button>
						    </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $this->end(); ?>