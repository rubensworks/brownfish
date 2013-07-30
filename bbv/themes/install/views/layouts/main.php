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
				
				<h1>
					<?php echo CHtml::encode("BrownFish CMS"); ?>
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
