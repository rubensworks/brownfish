<?php
$this->beginWidget('WidgetWidget', array('name'=>$widget->name, 'id'=>$widget->id));	
	$items = Item::findList($widget);
	$class = $widget->item_type;
	if($class::$_CUSTOM_LIST_VIEW) {
		foreach($items as $item) {
			$this->renderPartial('/'.$class.'/_list_item', array('item'=>$item));
		}
	} else {
		$displayItems = array();
		foreach($items as $item) {
			$displayItems[] = array('label'=>$item->item->name, 'url'=>array('/'.$class.'/view/', 'id'=>$item->id));
		}
		$this->widget('bootstrap.widgets.TbMenu', array(
		    'type'=>'pills',
		    'stacked'=>true,
		    'items'=>$displayItems,
		));
	}
$this->endWidget();
?>