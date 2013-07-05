<div class="form">

<?php
$form = $this->beginWidget('WForm', array(
	'id'=>'item-form',
	'htmlOptions'=>array('class'=>'well'),
));
$notNew = !$model->isNewRecord;
?>

	<p class="muted">Velden met <span class="required">*</span> zijn verplicht.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model, 'item.date_created'); ?>
	<?php echo $form->hiddenField($model, 'item.date_changed'); ?>

	<div class="row-fluid">
	<?php if ($notNew) {?>
	<div class="span1 row-fluid">
	    <?php echo $form->labelEx($model, 'id'); ?>
	    <?php echo $form->textField($model, 'id', array('class'=>'span12', 'readonly'=>true)); ?>
	    <?php echo $form->error($model, 'id'); ?>
	</div>
	<?php } ?>
	
	<div class="<?php echo $notNew?"span11":"" ?> row-fluid">
	    <?php echo $form->labelEx($model, 'item.name'); ?>
	    <?php echo $form->textField($model, 'item.name', array('class'=>'span12', 'maxlength'=>50)); ?>
	    <?php echo $form->error($model, 'item.name'); ?>
	</div>
	</div>
	
	<div class="row-fluid">
	<?php if ($notNew) { ?>
	<div class="span3 row-fluid">
		<?php $users = User::model()->findAll();
		$userList = CHtml::listData($users, 'id', 'name'); ?>
		<?php echo $form->labelEx($model,'item.author_id'); ?>
		<?php echo $form->dropDownList($model,'item.author_id', $userList, array('class'=>'span12')); ?>
		<?php echo $form->error($model,'item.author_id'); ?>
	</div>
	<?php } ?>
	
	<div class="<?php echo $notNew?"span3":"span6"; ?> row-fluid">
		<?php $categories = Category::model()->findAll();
		$categoryList = CHtml::listData($categories, 'category_id', 'name'); ?>
		<?php echo $form->labelEx($model,'item.category_id'); ?>
		<?php echo $form->dropDownList($model, 'item.category_id', $categoryList, array('class'=>'span12')); ?>
		<?php echo $form->error($model,'item.category_id'); ?>
	</div>
	
	<div class="span6 row-fluid">
		<?php echo $form->labelEx($model, 'item.tags'); ?>
	    <?php echo $form->textField($model, 'item.tags', array('class'=>'span12 input_tags', 'maxlength'=>100)); ?>
	    <?php echo $form->error($model, 'item.tags'); ?>
	</div>
	</div>
	
	<?php
	if($view!==NULL) {
		$owner=$this->getOwner();
		$viewFile=$owner->getViewFile($view);
		$owner->renderFile($viewFile,array('form'=>$form, 'model'=>$model));
	}
	?>
	
	<div class="row-fluid">
	    <?php echo $form->labelEx($model, 'item.content'); ?>
	    <?php echo $form->textArea($model, 'item.content', array('class'=>'span12 item_content', 'rows'=>10)); ?>
	    <?php echo $form->error($model, 'item.content'); ?>
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