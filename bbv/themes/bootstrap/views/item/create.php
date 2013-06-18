<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Create',
);

?>
<div class="section">
<h1>Create <?php $model->getItemName(); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>