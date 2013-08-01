<div class="input-row">
    <?php echo $form->labelEx($model, 'excerpt'); ?>
    <?php echo $form->textArea($model, 'excerpt', array('rows'=>10, 'maxlength'=>500)); ?>
    <?php echo $form->error($model, 'excerpt'); ?>
</div>

<div class="row-fluid">
	<div class="span1 input-row">
	    <?php echo $form->labelEx($model, 'conditional_date'); ?>
	    <?php echo $form->checkbox($model, 'conditional_date', array('class'=>'conditional_date')); ?>
	    <?php echo $form->error($model, 'conditional_date'); ?>
	</div>

	<div class="span5 input-row">
	    <?php echo $form->labelEx($model, 'startdate'); ?>
	    <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
	    		'attribute'=>'startdate',
	    		'model'=>$model,
	    		'options'=>array('dateFormat'=>Yii::app()->params['dateFormatPicker']),
	    		'htmlOptions'=>array('class'=>'startdate'),
	    )); ?>
	    <?php echo $form->error($model, 'startdate'); ?>
	</div>
	
	<div class="span5 input-row">
	    <?php echo $form->labelEx($model, 'enddate'); ?>
	    <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
	    		'attribute'=>'enddate',
	    		'model'=>$model,
	    		'options'=>array('dateFormat'=>Yii::app()->params['dateFormatPicker']),
	    		'htmlOptions'=>array('class'=>'enddate'),
	    )); ?>
	    <?php echo $form->error($model, 'enddate'); ?>
	</div>
	
	<div class="span1 input-row">
	    <?php echo $form->labelEx($model, 'hide'); ?>
	    <?php echo $form->checkbox($model, 'hide'); ?>
	    <?php echo $form->error($model, 'hide'); ?>
	</div>
</div>