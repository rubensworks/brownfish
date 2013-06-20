<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Categorien',
);

?>
<div class="section">
<h1>Lijst van Categori&euml;n</h1>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
		'label'=>'<i class="icon-plus icon-white"></i> Nieuw',
		'encodeLabel'=>false,
		'type'=>'primary',
		'url'=>array('create'),
));

$this->widget('bootstrap.widgets.TbGridView', array(
		'dataProvider' => $dataProvider,
		'type' => ItemTable::$TYPE,
		'template' => ItemTable::$TEMPLATE,
		'summaryText' => ItemTable::$SUMMARYTEXT,
		'columns'=>array(
			'category_id',
			'name',
			ItemTable::$BUTTONCOLUMN,
		),
));

?>
</div>