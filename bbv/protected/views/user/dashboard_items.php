<?php
$itemItems = array();
foreach(Utils::getItemTypes() as $type) {
	$instance = new $type();
	$itemItems[] = array('label' => $instance->getMultipleItemName(), 'url'=>array($type.'/admin'));
}
$otherItems = array(
	array('label'=>'Categorien', 'url'=>array('category/admin')),
);

$this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills',
    'stacked'=>true, // whether this is a stacked menu
    'items'=>array_merge($otherItems, $itemItems),
));
?>
