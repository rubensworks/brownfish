<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Login',
);
?>
<div class="section">
<h1>Register</h1>
<h2>Recover Password</h2>

<div class="form">

<?php Yii::import('application.data.Data');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'focus'=>array($model,'secra'),
));
?>
	<?php echo $form->errorSummary($model); ?>
    
    <div class="row">
		<?php echo $form->labelEx($model,'secrq'); ?>
		<?php echo $form->hiddenField($model,'name',array('value'=>$model->name)); ?>
		<b><?php echo $model->secrq; ?></b>
	</div>
	
    <div class="row">
		<?php echo $form->labelEx($model,'secra'); ?>
		<?php echo $form->textField($model,'secra',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'secra'); ?>
	</div>
    
    <div class="row buttons">
		<?php echo CHtml::submitButton('Send'); ?>
	</div>
    
<?php $this->endWidget(); ?>
</div>
</div>
<br />