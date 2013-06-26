<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Pagina\'s'=>array('index'),
	'Update Pagina' . $model->name ,
);

?>
<div class="section">
<h1>Update pagina <i><?php echo $model->name; ?></i></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>