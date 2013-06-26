<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Pagina\'s'=>array('index'),
	'Nieuwe Pagina',
);

?>
<div class="section">
<h1>Nieuwe Pagina</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>