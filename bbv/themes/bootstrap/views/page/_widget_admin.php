<div id="<?php echo $widget==NULL?"widget_template":("widget_".$widget->id)?>" class="widget-drag well-titled row-fluid">
	<div class="well-header span12 row-fluid">
		<div class="text-right pull-right widget-controls span4">
			<i class="icon-white icon-hand-up move_widget"></i>
			<i class="icon-white icon-remove delete_widget"></i>
		</div>
	    <h3 class="well-title row-fluid span6"><input class="name span12" type="text" value="<?php echo $widget==NULL?"":$widget->name; ?>" /></h3>
	</div>
	<div class="well well-small well-body">a
	</div>
</div>