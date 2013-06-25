<?php
$this->breadcrumbs=array(
	'Dashboard',
);

?>
<div class="section">
<h1>Dashboard</h1>
<?php $this->widget('bootstrap.widgets.TbTabs', array(
		'placement'=>'left',
    	'tabs'=>$tabs,
)); ?>
</div>