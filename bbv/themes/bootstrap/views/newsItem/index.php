<?php
$this->breadcrumbs=array(
	'Nieuws',
);

?>
<div class="section">
<h1>Nieuws</h1>

<?php
$this->widget('ItemList', array(
		'filter'=>$model,
		//'condition'=>"category.category_id = :category",
		//'params'=>array(":category"=>1),
));

?>
</div>