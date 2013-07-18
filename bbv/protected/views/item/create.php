<?php
$this->breadcrumbs=array(
	Yii::t('messages', 'dashboard.dashboard')=>array('user/dashboard'),
	$model->getMultipleItemName()=>array('/'.$this->getItemClassName().'/admin'),
	Yii::t('messages', 'form.general.createAttr', array('{attribute}'=>$model->getItemName())),
);

?>
<section>
<h1><? echo Yii::t('messages', 'form.general.createAttr', array('{attribute}'=>$model->getItemName())) ?></h1>

<?php
$this->widget('ItemForm', array(
		'model'=>$model,
		'view'=>'/'.$this->getItemClassName().'/_form',
		'afterView'=>'/'.$this->getItemClassName().'/_after_form',
		'options'=>$this->itemFormOptions,
	));
?>

</section>