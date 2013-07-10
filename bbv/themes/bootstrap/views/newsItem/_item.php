<?php $this->beginWidget('WidgetWidget', array('name'=>CHtml::link(isset($overrideTitle)?$overrideTitle:$data->item->name, array('newsitem/view', 'id'=>$data->item->id)), 'id'=>$data->id)); ?>
<article class="news">
	<?php if(!(isset($compact) && $compact)){ ?>
		<aside>
		Aangemaakt op: <time><?php echo Utils::displayDate($data->item->date_created) ?></time>
		<?php if($data->item->date_created != $data->item->date_changed) { ?>
		, Laatst bewerkt op: <time><?php echo Utils::displayDate($data->item->date_changed, true); ?></time><?php } ?>, 
		Auteur: <?php echo $data->item->author->name; ?>
		</aside>
		<hr class="hr-small"/>
	<?php } ?>
	<summary>
		<?php echo $data->excerpt; ?>
	</summary>
	<hr class="hr-small"/>
	<aside>
		<?php
		$comments = Comment::countComments($data->item->id);
		echo $comments." ".($comments==1?"reactie":"reacties");
		?>
	</aside>
</article>
<?php $this->endWidget(); ?>