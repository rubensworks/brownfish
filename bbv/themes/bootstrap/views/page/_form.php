<div class="form">

<?php
$form = $this->beginWidget('WForm', array(
	'id'=>'page-form',
	'htmlOptions'=>array('class'=>'well'),
));
$notNew = !$model->isNewRecord;
?>

	<p class="muted">Velden met <span class="required">*</span> zijn verplicht.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid">
	<?php if ($notNew) {?>
	<div class="span1 input-row">
	    <?php echo $form->labelEx($model, 'id'); ?>
	    <?php echo $form->textField($model, 'id', array('readonly'=>true)); ?>
	    <?php echo $form->error($model, 'id'); ?>
	</div>
	<?php } ?>
	
	<div class="<?php echo $notNew?"span11":"" ?> input-row">
	    <?php echo $form->labelEx($model, 'name'); ?>
	    <?php echo $form->textField($model, 'name', array('maxlength'=>50)); ?>
	    <?php echo $form->error($model, 'name'); ?>
	</div>
	</div>
	
	<?php if ($notNew) {?>
	<div class="input-row">
		<?php $categories = User::model()->findAll();
		$userList = CHtml::listData($categories, 'id', 'name'); ?>
		<?php echo $form->labelEx($model,'author_id'); ?>
		<?php echo $form->dropDownList($model, 'author_id', $userList); ?>
		<?php echo $form->error($model,'author_id'); ?>
	</div>
	<?php } ?>
	
	<div class="input-row">
		<?php echo $form->labelEx($model,'columns'); ?>
		<?php echo $form->dropDownList($model, 'columns', Utils::makeCountingArray(4), array('id'=>'columns')); ?>
		<?php echo $form->error($model,'columns'); ?>
	</div>

	<div>
		<?php $this->widget(
				'bootstrap.widgets.TbButton',
				array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>($model->isNewRecord ? 'Volgende' : 'Pas aan')
					)
				); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->