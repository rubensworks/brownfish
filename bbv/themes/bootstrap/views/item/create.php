<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Create ' .  $model->getItemName(),
);

?>
<div class="section">
<h1>Create <?php echo $model->getItemName(); ?></h1>

<?php
$this->widget('ItemForm', array(
		'model'=>$model,
		'view'=>'_form',
	));
?>

</div>