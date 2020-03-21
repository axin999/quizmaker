
<?php $this->start('head'); ?>
 <meta content="test">
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<?= inputBlock('text','Favorite Color', 'favorite_color','', ['class'=>'form-control'] , ['class'=> 'form-group']); ?>
<?= submitBlock("Save", ['class' => 'btn btn-primary'], ['class'=>'float-right']); ?>
<?php $this->end(); ?>