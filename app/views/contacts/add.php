<?php $this->setSiteTitle('Add a contact'); ?>
<?php $this->start('body'); ?>
<div class="col-md col-md-offset-2 well">
	<h2 class="text-center">Add a contact</h2>
	<hr>
	<?php $this->partial('contacts','form'); ?>
</div>
<?php $this->end()?>
