<?php 
use Core\FH;
use Core\Router;
use Core\HP;
use App\Models\Users;

  $menu = Router::getMenu('menu_acl');
 //HP::dnd($menu);
?>
<?php $this->start('head'); ?>
 <meta content="test">
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<?= $this->partial('quizes','forms/prepare') ?>

<!-- <div class="row h-100 w-100 justify-content-center align-items-center">
	<div class="col-4 pt-5">
		<?php foreach ($menu['Quiz'] as $key => $value): ?>
			<a href="<?= $value ?>" class="btn btn-primary btn-lg btn-block p-4"><?= $key ?></a>
		<?php endforeach;?>
	</div>
</div>	 -->
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