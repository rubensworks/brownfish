<div class="form well">
<?php Yii::import('application.data.Data');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'focus'=>array($model,'name'),
)); $model->pwd_repeat=NULL;$model->pwd=NULL;
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'mail'); ?>
		<?php echo $form->textField($model,'mail',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'mail'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'pwd'); ?>
		<?php echo $form->passwordField($model,'pwd',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pwd'); ?>
	</div>
    
    <div class="">
		<?php echo $form->labelEx($model,'pwd_repeat'); ?>
		<?php echo $form->passwordField($model,'pwd_repeat',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pwd_repeat'); ?>
	</div>
	
	<div class="">
		<?php echo $form->labelEx($model,'secrq'); ?>
		<?php echo $form->textField($model,'secrq',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'secrq'); ?>
	</div>
	
	<div class="">
		<?php echo $form->labelEx($model,'secra'); ?>
		<?php echo $form->textField($model,'secra',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'secra'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->dropDownList($model,'gender',array('m' => 'Male', 'f' => 'Female')); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>
    
    <?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?><br />
		<label>&nbsp;</label><?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode', array(), false); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Register' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->