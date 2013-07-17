<div class="form">

<?php
$form = $this->beginWidget('WForm', array(
	'id'=>'category-form',
	'htmlOptions'=>array('class'=>'well'),
));
$notNew = !$model->isNewRecord;
?>

	<p class="muted"><? echo Yii::t('messages', 'form.general.requiredFields') ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid">
	<?php if ($notNew) {?>
	<div class="span1 input-row">
	    <?php echo $form->labelEx($model, 'category_id'); ?>
	    <?php echo $form->textField($model, 'category_id', array('readonly'=>true)); ?>
	    <?php echo $form->error($model, 'category_id'); ?>
	</div>
	<?php } ?>
	
	<div class="<?php echo $notNew?"span11":"" ?> input-row">
	    <?php echo $form->labelEx($model, 'name'); ?>
	    <?php echo $form->textField($model, 'name', array('maxlength'=>50)); ?>
	    <?php echo $form->error($model, 'name'); ?>
	</div>
	</div>

	<div>
		<?php $this->widget(
				'bootstrap.widgets.TbButton',
				array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>($model->isNewRecord ? Yii::t('messages', 'form.general.create') : Yii::t('messages', 'form.general.update'))
					)
				); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->