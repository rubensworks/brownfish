<?php
$this->beginWidget('WidgetWidget', array('name'=>$widget->name, 'id'=>$widget->id));	
	$items = Item::findList($widget);
	$displayItems = array();
	foreach($items as $item) {
		$displayItems[] = array('label'=>$item->item->name, 'url'=>array('/'.$widget->item_type.'/view/', 'id'=>$item->id));
	}
	$this->widget('bootstrap.widgets.TbMenu', array(
	    'type'=>'pills',
	    'stacked'=>true,
	    'items'=>$displayItems,
	));
$this->endWidget();
?>