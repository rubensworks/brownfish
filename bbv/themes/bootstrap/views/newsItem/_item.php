<?php $this->beginWidget('WidgetWidget', array('name'=>CHtml::link(isset($overrideTitle)?$overrideTitle:$data->item->name, array('newsitem/view', 'id'=>$data->item->id)), 'id'=>$data->id)); ?>
		<?php if(!(isset($compact) && $compact)){ ?>
		<small class="muted">Aangemaakt op: <?php echo Utils::displayDate($data->item->date_created) ?>
		<?php if($data->item->date_created != $data->item->date_changed) { ?>
		, Laatst bewerkt op: <?php echo Utils::displayDate($data->item->date_changed, true); } ?>, 
		Auteur: <?php echo $data->item->author->name; ?></small>
		<hr class="hr-small"/>
		<?php } ?>
		<?php echo $data->excerpt; ?>
		<hr class="hr-small"/>
		<small class="muted">
		<?php
		$comments = Comment::countComments($data->item->id);
		echo $comments." ".($comments==1?"reactie":"reacties");
		?>
		</small>
<?php $this->endWidget(); ?>