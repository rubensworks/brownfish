<?php
$this->breadcrumbs=array(
	$model->name ,
);

?>
<section>

<?php
if(Yii::app()->user->checkAccess('managePages')) {
	$this->widget('bootstrap.widgets.TbButton', array(
	    'label' => Yii::t('messages', 'form.general.update'),
		'icon' => 'pencil white',
	    'type' => 'primary',
		'url' => CHtml::normalizeUrl(array('/Page/Update', 'id'=>$model->id)),
	    'htmlOptions' => array(
			'class' => 'pull-right',
	    ),
	));
} ?>

<h1><?php echo $model->name; ?></h1>

<div class="row-fluid">
<?php for($i = 0 ; $i < $model->columns ; $i++){ ?>
	<div id="column_<?php echo $i; ?>" class="span<?php echo 12/$model->columns; ?> content">
		<?php			
			foreach($widgets as $widget) {
				if($widget->col_id == $i) {
					$this->renderPartial(Widget::$VIEWS[$widget->widget_type], array('widget'=>$widget));
				}
			}
		?>
	</div>
<?php } ?>
</div>

</section>