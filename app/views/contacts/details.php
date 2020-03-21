<?php $this->setSiteTitle($this->contacts->displayName())?>
<?php $this->start('body')?>
<div class="container">

	<a href="<?= PROJECT_ROOT?>contacts" class="btn btn-xs btn-secondary">Back</a>
	<h2 class="text-center"><?= $this->contacts->displayName() ?></h2>
	<div class="row">
	<div class="col-md-6">
		<p >E-mail:<span class="font-weight-bold"><?= $this->contacts->displayName() ?></span></p>
		<p >Cell Phone:<span class="font-weight-bold"><?= $this->contacts->cell_phone ?></span></p>
		<p >Home Phone:<span class="font-weight-bold"><?= $this->contacts->home_phone ?></span></p>
		<p >Work Pphone:<span class="font-weight-bold"><?= $this->contacts->work_phone ?></span></p>
	</div>
	<div class="col-md-6">
		<?= $this->contacts->displayAddressLabel() ?>
	</div>
	</div>
</div>
<?php $this->end()?>