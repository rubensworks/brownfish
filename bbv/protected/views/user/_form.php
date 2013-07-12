<div class="register-form">
<?php Yii::import('application.data.Data');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'focus'=>array($model,'name'),
)); $model->pwd_repeat=NULL;$model->pwd=NULL;
?>
	<p class="note"><? Yii::t('messages', 'form.general.requiredFields') ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="input-row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'mail'); ?>
		<?php echo $form->textField($model,'mail',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'mail'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'pwd'); ?>
		<?php echo $form->passwordField($model,'pwd',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pwd'); ?>
	</div>
    
    <div class="input-row">
		<?php echo $form->labelEx($model,'pwd_repeat'); ?>
		<?php echo $form->passwordField($model,'pwd_repeat',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pwd_repeat'); ?>
	</div>
	
	<div class="input-row">
		<?php echo $form->labelEx($model,'secrq'); ?>
		<?php echo $form->textField($model,'secrq',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'secrq'); ?>
	</div>
	
	<div class="input-row">
		<?php echo $form->labelEx($model,'secra'); ?>
		<?php echo $form->textField($model,'secra',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'secra'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->dropDownList($model,'gender',array('m' => Yii::t('messages', 'enum.gender.male'), 'f' => Yii::t('messages', 'enum.gender.female'))); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>
    
    <?php if(CCaptcha::checkRequirements()): ?>
	<div class="input-row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?><br />
		<label>&nbsp;</label><?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint muted"><? Yii::t('messages', 'form.general.captchaExplanation') ?></div>
		<?php echo $form->error($model,'verifyCode', array(), false); ?>
	</div>
	<?php endif; ?>
	<br />
	<div class="buttons">
		<?php $this->widget(
				'bootstrap.widgets.TbButton',
				array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>($model->isNewRecord ? Yii::t('messages', 'form.register.register') : Yii::t('messages', 'form.general.update'))
					)
				); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->