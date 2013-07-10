<div class="input-row">
    <?php echo $form->labelEx($model, 'value'); ?>
    <?php echo $form->textField($model, 'value', array('rows'=>15)); ?>
    <?php echo $form->error($model, 'value'); ?>
</div>