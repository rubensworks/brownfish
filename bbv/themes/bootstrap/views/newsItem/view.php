<?php
$this->breadcrumbs=array(
	'Nieuws'=>array('index'),
	$model->item->name ,
);

?>
<div class="section">
<h1><?php echo $model->item->name; ?></h1>

<div class="well">
<small class="muted">Aangemaakt op: <?php echo Utils::displayDate($model->item->date_created) ?>
<?php if($model->item->date_created != $model->item->date_changed) { ?>
, Laatst bewerkt op: <?php echo Utils::displayDate($model->item->date_changed, true); } ?>, 
Auteur: <?php echo $model->item->author->name; ?></small>
<hr />
<?php echo $model->item->content; ?>
</div>
<hr />
<?php
$this->widget('Commenting', array(
		'item'=>$model->item,
	));
?>

</div>