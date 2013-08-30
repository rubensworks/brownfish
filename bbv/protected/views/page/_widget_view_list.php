<?php
$this->beginWidget('WidgetWidget', array('name'=>$widget->name, 'id'=>$widget->id));	
	$items = Item::findListByWidget($widget);
	$class = lcfirst($widget->item_type);
	$displayItems = array();
	if($class::$_CUSTOM_LIST_VIEW) {
		foreach($items as $item) {
			$this->renderPartial('/'.$class.'/_list_item', array('data'=>$item));
		}
	} else {
		foreach($items as $item) {
			$displayItems[] = array('label'=>$item->item->name, 'url'=>array('/'.$class.'/view/', 'id'=>$item->id));
		}
	}
	$displayItems[] = array(
			'label'=>Yii::t('messages', 'menu.more'),
			'icon'=>'plus',
			'url'=>array(
					'/'.$class.'/index/',
					'category_id'=>$widget->filter_category?$widget->category_id:"",
					'tags'=>$widget->filter_tags?$widget->tags:""
			),
	);
	echo "<br style='clear:both;' />";
	$this->widget('bootstrap.widgets.TbMenu', array(
			'type'=>'pills',
			'stacked'=>true,
			'items'=>$displayItems,
	));
$this->endWidget();
?>