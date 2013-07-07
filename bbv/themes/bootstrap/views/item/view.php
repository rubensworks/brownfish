<?php
$this->breadcrumbs=array(
	$model->getMultipleItemName()=>array('index'),
	$model->item->name ,
);

?>
<div class="section">
<h1><?php echo $model->item->name; ?></h1>

<?php
try {
	$this->renderPartial('/'.$this->getItemClassName().'/_item_extended', array('data'=>$model));
} catch(CException $e) {
	$this->renderPartial('/'.$this->getItemClassName().'/_item', array('data'=>$model));
}
?>

<hr />
<?php
$this->widget('Commenting', array(
		'item'=>$model->item,
	));
?>

</div>