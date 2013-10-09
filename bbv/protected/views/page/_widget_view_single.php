<?php
$class = $widget->item_type;
$camelClass = lcfirst($class);
$data = $class::model()->visible()->findByPk($widget->item_id);
if($data != NULL) {
	$this->renderPartial('/'.$camelClass.'/_item', array(
		'compact' => true,
		'overrideTitle' => $widget->name,
		'data' => $data,
		'widget' => $widget,
	));
} else {
	?><i><? echo Yii::t('messages', 'form.widgets.invalidItemForWidget') ?></i><?php
}
?>