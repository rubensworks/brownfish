<?php
$this->breadcrumbs=array(
	Yii::t('messages', 'dashboard.dashboard')=>array('user/dashboard'),
	Yii::t('messages', 'dashboard.pages.navigation'),
);

?>
<section>
<h1><? echo Yii::t('messages', 'dashboard.pages.navigation') ?></h1>
<?php $this->widget('NavigationForm'); ?>

</section>