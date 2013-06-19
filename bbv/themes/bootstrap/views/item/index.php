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

//$dataProvider->pagination->pageSize=2;
//$dataProvider->pagination->currentPage=1;

$this->widget('bootstrap.widgets.TbGridView', array( //Old: zii.widgets.CListView
		'type'=>'striped bordered condensed',
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
				array(
		            'class'=>'bootstrap.widgets.TbButtonColumn',
		            'htmlOptions'=>array('style'=>'width: 50px'),
		        ),
		),
		'template'=>"{summary}{items}<div class='text-center'>{pager}</div>",
		'summaryText'=>"<span class='muted'>Toont {start}-{end} van de {count} resultaten</span>.",
		'enablePagination' => true,
)); 

?>
</div>