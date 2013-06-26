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

<div class="row-fluid">
	<div id="sortable-left" class="span6 sortable well well-small">
	
		<?php $widget=new Widget();$widget->id=3;$widget->name="aa";$this->renderPartial('_widget_admin', array('widget'=>$widget)) ?>
		
	</div>
	<div id="sortable-right" class="span6 sortable well well-small">
	
		
		
	</div>
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
			saveWidget(event.toElement.parentNode.parentNode.parentNode.id);
        }
    });
    $(".widget-drag").disableSelection();
  });

  function saveWidget(id) {
	u_pos = id.indexOf("_");
	real_id = id.substring(u_pos+1);
	console.log(real_id);
	//$("#"+id).parent();

	// Todo: determine column and row_order
  }
  </script>