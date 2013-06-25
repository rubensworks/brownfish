<div class="well-titled">
	<div class="well-header">
	    <h3 class="well-title"><? echo CHtml::link($data->item->name, array('newsitem/view', 'id'=>$data->item->id)) ?></h3>
	</div>
	<div class="well well-small well-body">
		<small class="muted">Aangemaakt op: <?php echo Utils::displayDate($data->item->date_created) ?>
		<?php if($data->item->date_created != $data->item->date_changed) { ?>
		, Laatst bewerkt op: <?php echo Utils::displayDate($data->item->date_changed, true); } ?>, 
		Auteur: <?php echo $data->item->author->name; ?></small>
		<hr class="hr-small"/>
		<?php echo $data->item->content; ?>
		<hr class="hr-small"/>
		<small class="muted">
		<?php
		$comments = $widget->countComments($data->item->id);
		echo $comments." ".($comments==1?"reactie":"reacties");
		?>
		</small>
	</div>
</div>