<?php
$this->breadcrumbs=array(
	'Items',
);

?>
<div class="section">
<h1>Lijst van DummyItems</h1>

<?php
if(Yii::app()->user->checkAccess('admin'))
{
	$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Admin',
			'url'=>array('admin'),
	));
	echo " ";
    $this->widget('bootstrap.widgets.TbButton', array(
    		'label'=>'<i class="icon-plus icon-white"></i> Nieuw',
    		'encodeLabel'=>false,
    		'type'=>'primary',
    		'url'=>array('create'),
    ));
}

$this->widget('ItemTable', array(
		'filter'=>$model,
		'columns'=>array(
				'id',
				'value',
		),
));

?>
</div>