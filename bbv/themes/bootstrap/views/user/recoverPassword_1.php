<?php
$this->breadcrumbs=array(
	'Nieuw wachtwoord',
);
?>
<div class="section">
<h2>Nieuw wachtwoord</h2>

<div class="form well">

<?php Yii::import('application.data.Data');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'focus'=>array($model,'secra'),
));
?>
	<?php echo $form->errorSummary($model); ?>
    
    <div class="">
		<?php echo $form->labelEx($model,'secrq'); ?>
		<?php echo $form->hiddenField($model,'name',array('value'=>$model->name)); ?>
		<?php echo $form->error($model,'secrq'); ?>
		<b><?php echo $model->secrq; ?></b>
	</div>
	
    <div class="">
		<?php echo $form->labelEx($model,'secra'); ?>
		<?php echo $form->textField($model,'secra',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'secra'); ?>
	</div>
    
    <div class="buttons">
		<?php $this->widget(
				'bootstrap.widgets.TbButton',
				array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>'Volgende'
					)
				); ?>
	</div>
    
<?php $this->endWidget(); ?>
</div>
</div>
<br />