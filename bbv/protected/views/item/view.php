<?php
$this->breadcrumbs=array(
	$model->getMultipleItemName()=>array('index'),
	$model->item->name ,
);

?>
<section>
<h1><?php echo $model->item->name; ?></h1>

<?php
try {
	$this->renderPartial('/'.$this->getItemClassNameCamel().'/_item_extended', array('data'=>$model));
} catch(CException $e) {
	$this->renderPartial('/'.$this->getItemClassNameCamel().'/_item', array('data'=>$model));
}
?>

<hr />
<?php
if($model->commenting) {
	$this->widget('Commenting', array(
			'item'=>$model->item,
		));
}
?>

</section>