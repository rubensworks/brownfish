<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Categorien'=>array('index'),
	'Update categorie' . $model->name ,
);

?>
<section>
<h1>Update categorie <i><?php echo $model->name; ?></i></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</section>