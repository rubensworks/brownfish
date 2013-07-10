<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Categorien'=>array('index'),
	'Nieuwe Categorie',
);

?>
<section>
<h1>Nieuwe categorie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</section>