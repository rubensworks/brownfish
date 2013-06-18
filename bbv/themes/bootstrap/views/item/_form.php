<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'item-form',
	'htmlOptions'=>array('class'=>'well row-fluid'),
)); ?>

	<p class="muted">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
		<?php echo $form->textFieldRow($model,'name',array('class'=>'span12','maxlength'=>50)); ?>
	</div>
    
    <div>
		<?php echo $form->textAreaRow($model,'content',array('rows'=>15,'class'=>'span12')); ?>
	</div>

	<div>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>($model->isNewRecord ? 'Create' : 'Save'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->