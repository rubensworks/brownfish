<?php
$this->breadcrumbs=array(
		Yii::t('messages', 'form.register.register'),
);
?>
<section>
	<h1><? echo Yii::t('messages', 'form.register.register') ?></h1>

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</section>
