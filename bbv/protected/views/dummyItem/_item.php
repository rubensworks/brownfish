<?php $this->beginWidget('WidgetWidget', array('name'=>isset($overrideTitle)?$overrideTitle:$data->item->name)); ?>
	<?php echo $data->item->content; ?>
<?php $this->endWidget(); ?>