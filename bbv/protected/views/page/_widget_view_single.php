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
	?><i><? echo Yii::t('messages', 'form.widgets.invalidItemForWidget') ?></i><?php
}
?>