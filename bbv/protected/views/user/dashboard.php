<?php
$this->breadcrumbs=array(
	'Dashboard',
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