<?php $this->beginWidget('WidgetWidget', array('name'=>isset($overrideTitle)?$overrideTitle:$data->item->name)); ?>
	<?php echo $data->getFile(); ?>
<?php $this->endWidget(); ?>