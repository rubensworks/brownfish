<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php
		Yii::app()->bootstrap->register();
		
		$baseUrl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
		
		// Jquery UI
		Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
		$cs->registerCssFile($cs->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
		
		// Tag it
		$cs->registerScriptFile($baseUrl.'/js/tag-it.min.js');
		$cs->registerCssFile($baseUrl.'/css/jquery.tagit.css');
		
		// Bootstrap WYSIHTML5
		$cs->registerScriptFile($baseUrl.'/js/wysihtml5-0.3.0_rc2.min.js');
		$cs->registerScriptFile($baseUrl.'/js/bootstrap-wysihtml5.js');
		$cs->registerCssFile($baseUrl.'/css/wysihtml5.css');
		$cs->registerCssFile($baseUrl.'/css/bootstrap-wysihtml5.css');
		
		// Spin
		$cs->registerScriptFile($baseUrl.'/js/spin.min.js');
	?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Registreer', 'url'=>array('/user/register'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Dashboard', 'url'=>array('/user/dashboard'), 'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
