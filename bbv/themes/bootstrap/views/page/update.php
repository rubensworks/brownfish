<?php
$this->breadcrumbs=array(
	'Dashboard'=>array('user/dashboard'),
	'Pagina\'s'=>array('admin'),
	'Update Pagina ' . $model->name ,
);

?>
<div class="section">
<h1>Update pagina <i><?php echo $model->name; ?></i></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<div class="btn-toolbar pull-right">
    <?php //pull-right
    /*$columnchooser = array();
    for($i=0;$i<$model->columns;$i++){
    	$columnchooser[] = array(
    			'label'=>'Kolom '.($i+1),
    			'url'=>'',
    			'linkOptions'=>array('id'=>'tocolumn_'.$i, 'class'=>'add_widget')
    	);
    }
    $this->widget('bootstrap.widgets.TbButtonGroup', array(
        'buttons'=>array(
            array(
            	'label'=>'Widget',
            	'icon'=>'plus',
	            'items'=>array(
						array('label'=>'Dummy', 'url'=>'', 'items'=>$columnchooser),
						array('label'=>'Tekst', 'url'=>'', 'items'=>$columnchooser),
						array('label'=>'Nieuws', 'url'=>'', 'items'=>$columnchooser),
						'---',
						array('label'=>'Meer', 'url'=>''),
				),
        	),
		),
    ));*/ ?>
</div>

<div class="hide">
<?php
// Render the widget template
$this->renderPartial('_widget_admin', array('widget'=>NULL))
?>
</div>

<h3>Widgets</h3>
<div class="row-fluid">
	<p class="muted span6">Onderstaande veranderingen worden automatisch opgeslaan.</p>
	<div id="saving" class="span6"></div>
</div>
<div class="row-fluid">
<?php for($i = 0 ; $i < $model->columns ; $i++){ ?>
	<div id="column_<?php echo $i; ?>" class="span<?php echo 12/$model->columns; ?> well well-small">
		<div class="content sortable">
		<?php
			$criteria = new CDbCriteria();
			$criteria->condition = "page_id = :page_id AND col_id = :col_id";
			$criteria->params = array(":page_id"=>$model->id, ":col_id"=>$i);
			$criteria->order = "row_order";
			$widgets = Widget::model()->findAll($criteria);
			
			foreach($widgets as $widget) {
				$this->renderPartial('_widget_admin', array('widget'=>$widget));
			}
		?>
			</div>
			<hr class="hr-small" />
		<?php
			$this->widget('bootstrap.widgets.TbButton', array(
					'label'=>'Widget',
					'icon'=>'plus',
					'block'=>true,
					'htmlOptions'=>array('id'=>'tocolumn_'.$i, 'class'=>'add_widget'),
			));
		?>
		
	</div>
<?php } ?>
</div>

</div>