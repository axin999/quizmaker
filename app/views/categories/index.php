<?php $this->start('body'); ?>
<form action="<?= $this->postAddAction ?>" method="POST">
	<div class="row justify-content-center align-items-center p-3">
		<div class="col col-md-6">
			<div class="card">
			<div class="card-header">
				<button type="button" id="addcategory" class="btn btn-success btn-lg btn-block">Add Category</button>
				<button type="submit" id="submittype" class="btn btn-primary btn-lg btn-block">Save Category</button>
			</div>
			<div class="card-body">
				
			</div>
			<div class="card-footer text-muted">
			<label>List of Categories:</label>
				<ul class="list-group list-group-flush">
					<?php if(property_exists ($this,"listCategories")) foreach($this->listCategories as $category): ?>
						<li class="list-group-item"><?= $category->category_name; ?>
							<div class="float-right">
								<div class="btn-group" role="group" aria-label="Edit Button Group">
									<a class="btn btn-primary btn-sm" href="<?= $this->postEditAction.$category->category_id ?>"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" href="<?= $this->postDeleteAction.$category->category_id ?>" onclick="if(!confirm('Are you sure?')){return false;}"><i class="fa fa-trash"></i></a>
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