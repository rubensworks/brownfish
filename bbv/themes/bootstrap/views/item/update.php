<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Update ' . $model->getItemName() . "" . $model->item->name ,
);

?>
<div class="section">
<h1>Update <?php echo $model->getItemName(); ?> <i><?php echo $model->item->name; ?></i></h1>

<?php
$this->widget('ItemForm', array(
		'model'=>$model,
		'view'=>'_form',
	));
?>

</div>