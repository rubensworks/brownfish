<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	$model->getMultipleItemName(),
);

?>
<section>
<h1><?php echo $model->getMultipleItemName(); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
 		'label'=>'<i class="icon-plus icon-white"></i> Nieuw',
   		'encodeLabel'=>false,
   		'type'=>'primary',
   		'url'=>array('create'),
));

$this->widget('ItemTable', array(
		'filter'=>$model,
		'columns'=>$this->getListColumns(),
));

?>
</section>