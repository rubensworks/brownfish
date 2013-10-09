<?php $this->beginWidget('WidgetWidget', array('name'=>isset($overrideTitle)?$overrideTitle:$data->item->name, 'clear'=> $widget!=NULL && $widget->clear == 1)); ?>
		<?php echo $data->item->content; ?>
<?php $this->endWidget(); ?>