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
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
        'buttons'=>array(
            array(
            	'label'=>'Widget',
            	'icon'=>'plus',
	            'items'=>array(
						array('label'=>'Dummy', 'url'=>'#'),
						array('label'=>'Tekst', 'url'=>'#'),
						array('label'=>'Nieuws', 'url'=>'#'),
						'---',
						array('label'=>'Meer', 'url'=>'#'),
				),
        	),
		),
    )); ?>
</div>

<h3>Widgets</h3>
<p class="muted">Onderstaande veranderingen worden automatisch opgeslaan.</p>
<div class="row-fluid">
<?php for($i = 0 ; $i < $model->columns ; $i++){ ?>
	<div id="column_<?php echo $i; ?>" class="span<?php echo 12/$model->columns; ?> sortable well well-small">
	
		<?php $widget=new Widget();$widget->id=$i;$widget->name="aa";$this->renderPartial('_widget_admin', array('widget'=>$widget)) ?>
		
	</div>
<?php } ?>
</div>

</div>


<script>
  $(function() {
    $(".sortable").sortable({
    	connectWith: ".sortable",
    	cursor: 'move',
    	opacity: 0.7,
    	handle: ".icon-hand-up",
      	revert: true,
      	stop: function(event, ui) {
			saveWidget(event.toElement.parentNode.parentNode.parentNode.id, event.target.id, ui.item.index());
        }
    });
    $(".widget-drag").disableSelection();
  });

  function saveWidget(id, col_id, row_order) {
	u_pos = id.indexOf("_");
	real_id = id.substring(u_pos+1);
	console.log(real_id);
	
	u_pos_col = col_id.indexOf("_");
	real_col_id = col_id.substring(u_pos_col+1);

	console.log(real_id+" "+real_col_id+" "+row_order);
	// Save that stuff!
  }
  </script>