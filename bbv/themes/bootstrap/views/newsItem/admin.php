<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Nieuws',
);

?>
<div class="section">
<?php 
$this->widget('bootstrap.widgets.TbButton', array(
		'label'=>'<i class="icon-plus icon-white"></i> Nieuw',
		'encodeLabel'=>false,
		'type'=>'primary',
		'url'=>array('create'),
		'htmlOptions'=>array('class'=>'pull-right btn-large'),
));
?>
<h1>Lijst van Nieuws Items</h1>

<?php
$this->widget('ItemTable', array(
		'filter'=>$model,
		'columns'=>array(
				'id',
		),
));

?>
</div>