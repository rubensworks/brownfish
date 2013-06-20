<?php
$this->breadcrumbs=array(
	'Categorien'=>array('index'),
	'Nieuwe Categorie',
);

?>
<div class="section">
<h1>Nieuwe categorie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>