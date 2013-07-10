<?php
$this->breadcrumbs=array(
		'Nieuw wactwoord',
);
?>
<section>
	<h2>Nieuw wachtwoord</h2>

	<div class="register-form">

		<?php Yii::import('application.data.Data');
		$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'focus'=>array($model,'name'),
));
?>
		<?php echo $form->errorSummary($model); ?>

		<div class="">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>

		<div class="buttons">
			<?php $this->widget(
					'bootstrap.widgets.TbButton',
					array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>'Volgende'
					)
				); ?>
		</div>

		<?php $this->endWidget(); ?>
	</div>
</section>
