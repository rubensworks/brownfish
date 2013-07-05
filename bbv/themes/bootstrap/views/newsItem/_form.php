<div class="row-fluid">
    <?php echo $form->labelEx($model, 'excerpt'); ?>
    <?php echo $form->textArea($model, 'excerpt', array('class'=>'span12', 'rows'=>10, 'maxlength'=>500)); ?>
    <?php echo $form->error($model, 'excerpt'); ?>
</div>