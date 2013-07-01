<?php
$this->breadcrumbs=array(
	$model->name ,
);

?>
<div class="section">
<h1><?php echo $model->name; ?></h1>

<div class="row-fluid">
<?php for($i = 0 ; $i < $model->columns ; $i++){ ?>
	<div id="column_<?php echo $i; ?>" class="span<?php echo 12/$model->columns; ?>">
		<div class="content">
		<?php			
			foreach($widgets as $widget) {
				if($widget->col_id == $i) {
					$this->renderPartial(Widget::$VIEWS[$widget->widget_type], array('widget'=>$widget));
				}
			}
		?>
		</div>
	</div>
<?php } ?>
</div>

</div>