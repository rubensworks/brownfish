<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Pagina\'s',
);

?>
<div class="section">
<h1>Lijst van Pagina's</h1>

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
			'id',
			'name',
			'page',
			ItemTable::$BUTTONCOLUMN,
		),
));

?>
</div>