<?php
$this->breadcrumbs=array(
	$model->getMultipleItemName(),
);

?>
<section>
<h1><?php echo $model->getMultipleItemName(); ?></h1>

<?php
$this->widget('ItemList', array(
		'filter'=>$model,
));

?>
</section>