<?php
$class = $widget->item_type;
$data = $class::model()->findByPk($widget->item_id);
if($data != NULL) {
	$this->renderPartial('/'.$class.'/_item', array(
		'compact' => true,
		'overrideTitle' => $widget->name,
		'data' => $data,
	));
} else {
	?><i>Gelieve een geldige item te kiezen voor deze widget.</i><?php
}
?>