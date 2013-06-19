<?php
$this->breadcrumbs=array(
	'Items',
);


?>
<div class="section">
<h1>List of DummyItems</h1>

<?php
if(Yii::app()->user->checkAccess('admin'))
{
    $this->widget('bootstrap.widgets.TbButton', array(
    		'label'=>'Admin',
    		'url'=>array('admin'),
    ));
    echo " ";
    $this->widget('bootstrap.widgets.TbButton', array(
    		'label'=>'Create',
    		'type'=>'primary',
    		'url'=>array('create'),
    ));
}

$this->widget('ItemTable', array(
		'dataProvider'=>$dataProvider,
		'columns'=>array(
				'id',
				'value',
				'item.name',
				array('name'=>'item.author', 'value'=>'$data->item->author->name'),
				array('name'=>'item.date_created', 'value'=>'Utils::displayDate($data->item->date_created)'),
				array('name'=>'item.date_changed', 'value'=>'Utils::displayDate($data->item->date_changed)'),
				'item.category.name',
				'item.tags',
		),
));

?>
</div>