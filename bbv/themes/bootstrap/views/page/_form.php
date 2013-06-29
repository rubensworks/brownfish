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
	<div class="span1 row-fluid">
	    <?php echo $form->labelEx($model, 'id'); ?>
	    <?php echo $form->textField($model, 'id', array('class'=>'span12', 'readonly'=>true)); ?>
	    <?php echo $form->error($model, 'id'); ?>
	</div>
	<?php } ?>
	
	<div class="<?php echo $notNew?"span11":"" ?> row-fluid">
	    <?php echo $form->labelEx($model, 'name'); ?>
	    <?php echo $form->textField($model, 'name', array('class'=>'span12', 'maxlength'=>50)); ?>
	    <?php echo $form->error($model, 'name'); ?>
	</div>
	</div>
	
	<?php if ($notNew) {?>
	<div class="row-fluid">
		<?php $categories = User::model()->findAll();
		$userList = CHtml::listData($categories, 'id', 'name'); ?>
		<?php echo $form->labelEx($model,'author_id'); ?>
		<?php echo $form->dropDownList($model, 'author_id', $userList, array('class'=>'span12')); ?>
		<?php echo $form->error($model,'author_id'); ?>
	</div>
	<?php } ?>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'columns'); ?>
		<?php echo $form->dropDownList($model, 'columns', array(1=>1, 2=>2, 3=>3, 4=>4), array('class'=>'span12', 'id'=>'columns')); ?>
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