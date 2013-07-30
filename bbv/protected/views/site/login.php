<?php
$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('messages', 'form.login.login');
$this->breadcrumbs=array(
		Yii::t('messages', 'form.login.login'),
);
?>

<section class="login-section">
	<div>
		<h1><? echo Yii::t('messages', 'form.login.login') ?></h1>
		<div class="form well">
			<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			)); ?>

			<p class="hint muted">
				<?php echo Yii::t('messages', 'form.login.noAccountYet') ?>
				<?php echo CHtml::link(Yii::t('messages', 'form.login.registerHere'), array('user/register')) ?>
			</p>

			<p class="muted">
				<?php echo Yii::t('messages', 'form.general.requiredFields') ?>
			</p>
			
			<?php if($model->hasErrors()) { ?>
				<div class="errorSummary">
				Inloggegevens zijn verkeerd.
				</div>
			<?php } ?>

			<div class="input-row">
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username'); ?>
			</div>

			<div class="input-row">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password'); ?>
			</div>

			<div class="rememberMe">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
			</div>

			<p class="hint">
				<? echo CHtml::link(Yii::t('messages', 'form.login.forgotPassword'), array('user/recoverPassword')) ?>
			</p>

			<div class="buttons">
				<?php $this->widget(
						'bootstrap.widgets.TbButton',
						array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>Yii::t('messages', 'form.login.login'),
					)
				); ?>
			</div>

			<?php $this->endWidget(); ?>
		</div>
		<!-- form -->
	</div>
</section>
