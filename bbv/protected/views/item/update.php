<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	$model->getMultipleItemName()=>array('/'.$this->getItemClassName().'/admin'),
	'Update ' . $model->getItemName() . " " . $model->item->name ,
);

?>
<section>
<h1>Update <?php echo $model->getItemName(); ?> <i><?php echo $model->item->name; ?></i></h1>

<?php
$this->widget('ItemForm', array(
		'model'=>$model,
		'view'=>'/'.$this->getItemClassName().'/_form',
	));
?>

</section>