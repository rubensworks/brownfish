<?php $this->beginWidget('WidgetWidget', array('name'=>isset($overrideTitle)?$overrideTitle:$data->item->name)); ?>
	<?php $this->widget('zii.widgets.CMenu', Navigation::buildNavigation($data->navigation)); ?>
<?php $this->endWidget(); ?>