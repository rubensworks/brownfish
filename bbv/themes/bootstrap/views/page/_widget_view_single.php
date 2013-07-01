<?php
$class = $widget->item_type;
$this->renderPartial('/'.$class.'/_item', array(
	'compact' => true,
	'overrideTitle' => $widget->name,
	'data' => $class::model()->findByPk($widget->item_id),
));
?>