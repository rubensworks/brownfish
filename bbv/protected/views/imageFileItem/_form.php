<div class="input-row">
    <?php echo $form->labelEx($model, 'file'); ?>
    <?php echo $form->fileField($model, 'file'); ?>
    <?php echo $form->error($model, 'file'); ?>
</div>