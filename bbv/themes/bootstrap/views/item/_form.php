<div class="row-fluid">
    <?php echo $form->labelEx($model, 'value'); ?>
    <?php echo $form->textField($model, 'value', array('class'=>'span12', 'rows'=>15)); ?>
    <?php echo $form->error($model, 'value'); ?>
</div>