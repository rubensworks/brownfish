<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('messages', 'error.main');
$this->breadcrumbs=array(
	Yii::t('messages', 'error.main'),
);
?>

<div class="hero-unit">
	<h2><?php echo Yii::t('messages', 'error.main'); ?> <?php echo $code; ?></h2>
	<p><?php echo CHtml::encode($message); ?></p>
	<p>
		<a onclick="window.history.back()" class="back-button">
			<i class="icon-white icon-chevron-left"></i>
			<?php echo Yii::t('messages', 'error.goBack'); ?>
		</a>
	</p>
</div>
