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
		<p>Type: 
	    	<span class="item_type"><?php
	    		if($widget!=NULL) {
					$class=$widget->item_type;
					$instance = new $class();
					echo $instance->getItemName();
				}
	    	?></span>
	    </p>
		<p>
			<?php echo CHtml::radioButton("widget_type_".($widget==NULL?"":$widget->id), $widget == NULL || $widget->widget_type==Widget::$TYPE_LIST, array("class"=>"widget_type_list")) ?>
			Lijst
		</p>
		<div class="well well-small widget_type_setup widget_type_list_setup<?php echo ($widget == NULL || $widget->widget_type==Widget::$TYPE_LIST)?"":" hide" ?>">
			<div>
				<p>
					<?php echo CHtml::checkBox("filter_category", $widget != NULL && $widget->filter_category, array("class"=>"filter_category")) ?>
					Filter op categorie
				</p>
				<div class="well well-small filter_category_setup<?php echo ($widget != NULL && $widget->filter_category)?"":" hide" ?>">
					<?php
						$categories = Category::model()->findAll();
						$categoryList = CHtml::listData($categories, 'category_id', 'name');
						echo CHtml::dropDownList("category_id", $widget==NULL?"":$widget->category_id, $categoryList, array("class"=>"category_id span12"));
					?>
				</div>
			</div>
			<div>
				<p>
					<?php echo CHtml::checkBox("filter_tags", $widget != NULL && $widget->filter_tags, array("class"=>"filter_tags")) ?>
					Filter op tags
				</p>
				<div class="well well-small filter_tags_setup<?php echo ($widget != NULL && $widget->filter_tags)?"":" hide" ?>">
					<?php
				    echo CHtml::textField("tags", $widget==NULL?"":$widget->tags, array("class"=>"tags span12".($widget==NULL?"":" input_tags")));
				    ?>
				</div>
			</div>
			<div>
				Aantal: <?php echo CHtml::dropDownList("amount", $widget==NULL?1:$widget->amount, array(1=>1,2=>2,3=>3,4=>4,5=>5), array("class"=>"amount span12")); ?>
			</div>
		</div>
			<p>
				<?php echo CHtml::radioButton("widget_type_".($widget==NULL?"":$widget->id), $widget != NULL && $widget->widget_type==Widget::$TYPE_SINGLE, array("class"=>"widget_type_single")) ?>
				Enkel item
			</p>
		<div class="well well-small widget_type_setup widget_type_single_setup<?php echo ($widget != NULL && $widget->widget_type==Widget::$TYPE_SINGLE)?"":" hide" ?>">
			<?php 
			  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			      //'attribute'=>'item_id',
			        'model'=>$widget,
					'value'=>($widget!=NULL&&$widget->item!=NULL)?$widget->item->name:"",
			        'sourceUrl'=>array('item/aclist', array('item_type'=>$widget != NULL ? $widget->item_type : "")),
			        'name'=>'item_id_'.($widget==NULL?"":$widget->id),
			        'options'=>array(
			          'minLength'=>'3',
						'showAnim'=>'fold',
						'select'=>"js: function(event, ui) {
								 update_item_id($(this), ui.item['id']);
						     }"
			        ),
			        'htmlOptions'=>array(
			          'class'=>'span12 item_id',
			        ),
			  )); ?>
		</div>
	</div>
</div>