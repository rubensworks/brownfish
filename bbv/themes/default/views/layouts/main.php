<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>

	<section class="page">

		<header>
			<div class="container">
				<?php $this->widget('bootstrap.widgets.TbMenu',array(
						'type'=>'pills',
						'stacked'=>false,
						'htmlOptions'=>array('class'=>'pull-right'),
						'items'=>array(
								array('label'=>Yii::t('messages', 'menu.home'), 'icon'=>'home', 'url'=>array('/site/index')),
								array('label'=>Yii::t('messages', 'menu.photos'), 'icon'=>'picture', 'url'=>array('/site/page', 'view'=>'about')),
								array('label'=>Yii::t('messages', 'menu.contact'), 'icon'=>'envelope', 'url'=>array('/site/contact')),
								array('label'=>Yii::t('messages', 'menu.activities'), 'icon'=>'star-empty', 'url'=>array('/site/contact')),
								array('label'=>Yii::t('messages', 'menu.shop'), 'icon'=>'shopping-cart', 'url'=>array('/site/contact')),
								array(
										'class'=>'bootstrap.widgets.TbMenu',
										'icon'=>'user',
										'items'=>array(
												array('label'=>Yii::t('messages', 'form.login.login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
												array('label'=>Yii::t('messages', 'form.register.register'), 'url'=>array('/user/register'), 'visible'=>Yii::app()->user->isGuest),
												array('label'=>Yii::t('messages', 'menu.logout') . ' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
												array('label'=>Yii::t('messages', 'menu.dashboard'), 'url'=>array('/user/dashboard'), 'visible'=>!Yii::app()->user->isGuest),
										),
								),
						),
			)); ?>
				<h1>
					<?php echo CHtml::encode(Yii::app()->name); ?>
				</h1>
			</div>
		</header>

		<section class="content container">
			<?php echo $content; ?>
		</section>

		<div class="clear"></div>

		<footer>
			<div class="container">
				Copyright &copy;
				<?php echo date('Y'); ?>
				by My Company.<br /> All Rights Reserved.<br />
				<?php echo Yii::powered(); ?>
			</div>	
		</footer>
		<!-- footer -->

	</section>
	<!-- page -->

</body>
</html>
