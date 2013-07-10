<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
		'Login',
);
?>

<section class="login-section">
	<div>
		<h1>Login</h1>
		<div class="form well">
			<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

			<p class="hint muted">
				Nog geen account?
				<? echo CHtml::link('Registreer hier!', array('user/register')) ?>
			</p>

			<p class="muted">
				Velden met een <span class="required">*</span> zijn verplicht.
			</p>

			<div class="input-row">
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username'); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>

			<div class="input-row">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password'); ?>
				<?php echo $form->error($model,'password'); ?>
			</div>

			<div class="rememberMe">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
				<?php echo $form->error($model,'rememberMe'); ?>
			</div>

			<p class="hint">
				<? echo CHtml::link('Wachtwoord vergeten?', array('user/recoverPassword')) ?>
			</p>

			<div class="buttons">
				<?php $this->widget(
						'bootstrap.widgets.TbButton',
						array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>'Login'
					)
				); ?>
			</div>

			<?php $this->endWidget(); ?>
		</div>
		<!-- form -->
	</div>
</section>
