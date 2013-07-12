<?php
$this->breadcrumbs=array(
		Yii::t('messages', 'dashboard.dashboard')=>array('user/dashboard'),
		Yii::t('messages', 'dashboard.pages')=>array('admin'),
		Yii::t('messages', 'dashboard.pages.update') . ' ' . $model->name ,
);

?>
<section>
	<h1>
		<? echo Yii::t('messages', 'dashboard.pages.update') ?> <i><?php echo $model->name; ?> </i>
	</h1>

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

	<div class="hide">
		<?php
		// Render the widget template
		$this->renderPartial('_widget_admin', array('widget'=>NULL))
		?>
	</div>

	<h3><? echo Yii::t('messages', 'form.widgets.widgets') ?></h3>
	<div class="auto-save">
		<p><? echo Yii::t('messages', 'form.widgets.changesAutoSaved') ?></p>
		<div id="saving"></div>
	</div>
	<div class="row-fluid">
		<?php for($i = 0 ; $i < $model->columns ; $i++){ ?>
		<div id="column_<?php echo $i; ?>"
			class="span<?php echo 12/$model->columns; ?> well well-small">
			<div class="content sortable">
				<?php			
				foreach($widgets as $widget) {
				if($widget->col_id == $i)
					$this->renderPartial('_widget_admin', array('widget'=>$widget));
			}
			?>
			</div>
			<hr class="hr-small" />
			<?php
			$this->widget('bootstrap.widgets.TbButton', array(
					'label'=>Yii::t('messages', 'form.widgets.widget'),
					'icon'=>'plus',
					'block'=>true,
					'htmlOptions'=>array('id'=>'tocolumn_'.$i, 'class'=>'add_widget'),
			));
		?>

		</div>
		<?php } ?>
	</div>

	</div>

	<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'newWidget')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4><? echo Yii::t('messages', 'form.widgets.new') ?></h4>
	</div>

	<div class="modal-body">
		<p class="muted"><? echo Yii::t('messages', 'form.widgets.selectWidgetType') ?></p>
		<?php
		foreach(Utils::getItemTypes() as $type) {
			$instance = new $type();
			?>
		<input type="radio" name="widget_type" value="<?php echo $type; ?>" />&nbsp;
		<?php echo $instance->getItemName(); ?>
		<br />
		<?php
		}
		?>
	</div>

	<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'type'=>'primary',
				'label'=>Yii::t('messages', 'form.general.add'),
				'url'=>'',
				'htmlOptions'=>array('data-dismiss'=>'modal', 'id'=>'confirm_add_widget'),
    )); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'label'=>Yii::t('messages', 'form.general.close'),
				'url'=>'',
				'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
	</div>
	<?php $this->endWidget(); ?>
</section>