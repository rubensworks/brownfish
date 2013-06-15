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
	'focus'=>array($model,'name'),
));
?>
	<?php echo $form->errorSummary($model); ?>
    
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    
    <div class="row buttons">
		<?php echo CHtml::submitButton('Send'); ?>
	</div>
    
<?php $this->endWidget(); ?>
</div>
</div>
<br />