<?php
$this->breadcrumbs=array(
	Yii::t('messages', 'dashboard.dashboard')=>array('user/dashboard'),
	$model->getMultipleItemName()=>array('/'.$this->getItemClassName().'/admin'),
	Yii::t('messages', 'form.general.updateAttr', array('{attribute}'=>$model->getItemName() . " " . $model->item->name)),
);

?>
<section>
<h1><? echo Yii::t('messages', 'form.general.updateAttr', array('{attribute}'=>$model->getItemName() . " " . $model->item->name)) ?></i></h1>

<?php
$this->widget('ItemForm', array(
		'model'=>$model,
		'view'=>'/'.$this->getItemClassName().'/_form',
		'afterView'=>'/'.$this->getItemClassName().'/_after_form',
	));
?>

</section>