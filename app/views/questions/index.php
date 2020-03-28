<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
 <table class="table table-striped table-condensed table-bordered">
 	<thead>
 		<th>Question</th>
 	</thead>
 	<tbody>
 		<?php foreach ($this->questions as $question): ?>
 			<tr class="text-center">
 				<td><?= $question->question ?></td>
 			</tr>
 		<?php endforeach?>
 	</tbody>
 </table>
<?php $this->end(); ?>
