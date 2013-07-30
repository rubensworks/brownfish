<h2><?php echo Yii::t('messages', 'form.install.title.configuration'); ?></h2>
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'install-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<div class="form well">	
	<?php if($error) { ?>
		<div class="alert alert-error"><?php echo $error; ?></div>
	<?php } ?>

	<p class="muted">
		<?php echo Yii::t('messages', 'form.general.requiredFields') ?>
	</p>

	<div class="input-row">
		<?php echo $form->labelEx($model,'DB_HOST'); ?>
		<?php echo $form->textField($model,'DB_HOST'); ?>
		<?php echo $form->error($model,'DB_HOST'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'DB_NAME'); ?>
		<?php echo $form->textField($model,'DB_NAME'); ?>
		<?php echo $form->error($model,'DB_NAME'); ?>
	</div>
	
	<div class="input-row">
		<?php echo $form->labelEx($model,'DB_USERNAME'); ?>
		<?php echo $form->textField($model,'DB_USERNAME'); ?>
		<?php echo $form->error($model,'DB_USERNAME'); ?>
	</div>
	
	<div class="input-row">
		<?php echo $form->labelEx($model,'DB_PASSWORD'); ?>
		<?php echo $form->textField($model,'DB_PASSWORD'); ?>
		<?php echo $form->error($model,'DB_PASSWORD'); ?>
	</div>
	
	<div class="input-row">
		<?php echo $form->labelEx($model,'TBL_PREFIX'); ?>
		<?php echo $form->textField($model,'TBL_PREFIX'); ?>
		<?php echo $form->error($model,'TBL_PREFIX'); ?>
	</div>
	
	<div class="input-row">
		<?php echo $form->labelEx($model,'MYSQLDUMP_COMMAND'); ?>
		<?php echo $form->textField($model,'MYSQLDUMP_COMMAND'); ?>
		<?php echo $form->error($model,'MYSQLDUMP_COMMAND'); ?>
	</div>
	
</div>
<h3><?php echo Yii::t('messages', 'form.install.title.admin'); ?></h3>
<div class="form well">	
	
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
	
	<div class="input-row">
		<?php echo $form->labelEx($model,'password_repeat'); ?>
		<?php echo $form->passwordField($model,'password_repeat'); ?>
		<?php echo $form->error($model,'password_repeat'); ?>
	</div>
</div>

<div class="buttons">
	<?php $this->widget(
			'bootstrap.widgets.TbButton',
			array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>Yii::t('messages', 'form.general.save'),
		)
	); ?>
</div>
<?php $this->endWidget(); ?>
<!-- form -->