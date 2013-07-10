<div class="input-row">
    <?php echo $form->labelEx($model, 'excerpt'); ?>
    <?php echo $form->textArea($model, 'excerpt', array('rows'=>10, 'maxlength'=>500)); ?>
    <?php echo $form->error($model, 'excerpt'); ?>
</div>