<div id="cpwd-page" class="form">
<?php if(Yii::app()->user->hasFlash('successChangePassword')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('successChangePassword'); ?>
    </div>
<?php endif; ?>
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'cpwd-form',
	'action'=>CHtml::normalizeUrl(array('user/changePassword')),
	'enableAjaxValidation'=>true,
));
$model->newPwd=NULL;
$model->newPwd_repeat=NULL;
$model->pwd=NULL;
?>


	<?php echo $form->errorSummary($model); ?>
    <div id='error'></div>
	<div class="">
		<?php echo $form->labelEx($model,'pwd'); ?>
		<?php echo $form->passwordField($model,'pwd',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pwd'); ?>
	</div>
    
	<div class="">
		<?php echo $form->labelEx($model,'newPwd_repeat'); ?>
		<?php echo $form->passwordField($model,'newPwd_repeat',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'newPwd_repeat'); ?>
	</div>
    
    <div class="">
		<?php echo $form->labelEx($model,'newPwd'); ?>
		<?php echo $form->passwordField($model,'newPwd',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'newPwd'); ?>
	</div>

	<div class="buttons">
		<?php
		echo CHtml::ajaxSubmitButton(
    'Save',
    CHtml::normalizeUrl(array('user/changePassword')),
    array(
        'update'=>'#cpwd-page',
		'type'=>'submit',
		
    ),
	array(
		'class'=>'btn btn-primary',
	)
); ?>
	</div>

<?php $this->endWidget();?>
</div><!-- form -->