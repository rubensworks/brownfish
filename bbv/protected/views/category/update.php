<?php
$this->breadcrumbs=array(
	Yii::t('messages', 'dashboard.dashboard')=>array('user/dashboard'),
	Yii::t('messages', 'dashboard.items.categories')=>array('index'),
	Yii::t('messages', 'form.general.updateAttr', array('{attribute}' => Yii::t('messages', 'model.category.category'))),
);

?>
<section>
<h1><? echo Yii::t('messages', 'form.general.updateAttr', array('{attribute}' => Yii::t('messages', 'model.category.category'))) ?> <i><?php echo $model->name; ?></i></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</section>