<?php
$this->breadcrumbs=array(
	Yii::t('messages', 'dashboard.dashboard'),
);

?>
<section>
<h1>Dashboard</h1>
<?php $this->widget('bootstrap.widgets.TbTabs', array(
		'placement'=>'left',
    	'tabs'=>$tabs,
		'fade'=>false,
)); ?>
</section>