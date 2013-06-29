<div id="<?php echo $widget==NULL?"widget_template":("widget_".$widget->id)?>" class="widget-drag well-titled row-fluid">
	<div class="well-header span12 row-fluid">
		<div class="text-right pull-right widget-controls span4">
			<i class="icon-white icon-hand-up move_widget"></i>
			<i class="icon-white icon-remove delete_widget"></i>
		</div>
	    <h3 class="well-title row-fluid span6">
		    <?php
		    echo CHtml::textField("name", $widget==NULL?"":$widget->name, array("class"=>"name span12"));
		    ?>
	    </h3>
	</div>
	<div class="well well-small well-body">
		<div>
			Filter op categorie <input type="checkbox" class="filter_category" <?php if($widget != NULL && $widget->filter_category) echo "checked='checked'"; ?>/>
			<div class="well well-small filter_category_setup<?php echo ($widget != NULL && $widget->filter_category)?"":" hide" ?>">
				<?php
					$categories = Category::model()->findAll();
					$categoryList = CHtml::listData($categories, 'category_id', 'name');
					echo CHtml::dropDownList("category_id", $widget==NULL?"":$widget->category_id, $categoryList, array("class"=>"category_id span12"));
				?>
			</div>
		</div>
		<div>
			Filter op tags <input type="checkbox" class="filter_tags" <?php if($widget != NULL && $widget->filter_tags) echo "checked='checked'"; ?>/>
			<div class="well well-small filter_tags_setup<?php echo ($widget != NULL && $widget->filter_tags)?"":" hide" ?>">
				<?php
			    echo CHtml::textField("tags", $widget==NULL?"":$widget->tags, array("class"=>"tags span12".($widget==NULL?"":" input_tags")));
			    ?>
			</div>
		</div>
	</div>
</div>