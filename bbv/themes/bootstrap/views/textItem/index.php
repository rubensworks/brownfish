<?php
$this->breadcrumbs=array(
	'Tekst items',
);

?>
<div class="section">
<h1>Tekst items</h1>

<?php
$this->widget('ItemList', array(
		'filter'=>$model,
));

?>
</div>