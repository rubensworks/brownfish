<div class="form">

<?php
$form = $this->beginWidget('WForm', array(
	'id'=>'category-form',
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
	
	<div class="span12 row-fluid">
		<?php $categories = Page::model()->findAll();
		$categoryList = CHtml::listData($categories, 'page_id', 'name'); ?>
		<?php echo $form->labelEx($model,'page_id'); ?>
		<?php echo $form->dropDownList($model, 'page_id', $categoryList, array('class'=>'span12')); ?>
		<?php echo $form->error($model,'page_id'); ?>
	</div>
	
	<div class="span6 row-fluid">
	    <?php echo $form->labelEx($model, 'column'); ?>
	    <?php echo $form->textField($model, 'column', array('class'=>'span12', 'maxlength'=>50)); ?>
	    <?php echo $form->error($model, 'column'); ?>
	</div>
	
	<div class="span6 row-fluid">
	    <?php echo $form->labelEx($model, 'row_order'); ?>
	    <?php echo $form->textField($model, 'row_order', array('class'=>'span12', 'maxlength'=>50)); ?>
	    <?php echo $form->error($model, 'row_order'); ?>
	</div>

	<div>
		<?php $this->widget(
				'bootstrap.widgets.TbButton',
				array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>($model->isNewRecord ? 'Maak' : 'Pas aan')
					)
				); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->