<?php
$this->breadcrumbs=array(
	Yii::t('messages', 'dashboard.dashboard')=>array('user/dashboard'),
	Yii::t('messages', 'dashboard.pages'),
);

?>
<section>
<h1><? echo Yii::t('messages', 'dashboard.pages.listOfPages') ?></h1>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
		'label'=>'<i class="icon-plus icon-white"></i> ' . Yii::t('messages', 'form.general.new'),
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
			ItemTable::$BUTTONCOLUMN,
		),
));

?>
</section>