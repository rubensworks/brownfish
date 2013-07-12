<?php
$this->breadcrumbs=array(
	Yii::t('messages', 'dashboard.dashboard')=>array('user/dashboard'),
	Yii::t('messages', 'dashboard.pages')=>array('admin'),
	Yii::t('messages', 'dashboard.pages.create'),
);

?>
<section>
<h1><? echo Yii::t('messages', 'dashboard.pages.create') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</section>