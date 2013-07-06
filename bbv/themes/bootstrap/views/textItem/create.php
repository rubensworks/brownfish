<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Tekst items'=>array('admin'),
	'Maak ' .  $model->getItemName(),
);

?>
<div class="section">
<h1>Maak <?php echo $model->getItemName(); ?></h1>

<?php
$this->widget('ItemForm', array(
		'model'=>$model,
	));
?>

</div>