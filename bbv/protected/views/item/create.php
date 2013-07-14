<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	$model->getMultipleItemName()=>array('/'.$this->getItemClassName().'/admin'),
	'Maak ' .  $model->getItemName(),
);

?>
<section>
<h1>Maak <?php echo $model->getItemName(); ?></h1>

<?php
$this->widget('ItemForm', array(
		'model'=>$model,
		'view'=>'/'.$this->getItemClassName().'/_form',
		'afterView'=>'/'.$this->getItemClassName().'/_after_form',
	));
?>

</section>