<?php
$this->breadcrumbs=array(
	'Items',
);


?>
<div class="section">
<h1>List of Items</h1>

<?php
if(Yii::app()->user->checkAccess('admin'))
{
    echo CHtml::link("Admin", array('admin'));
}

$this->widget('bootstrap.widgets.TbGridView', array( //Old: zii.widgets.CListView
		'type'=>'striped bordered condensed',
		'dataProvider'=>$dataProvider,
		'template'=>"{items}",
	//'itemView'=>'_view',
)); ?>
</div>