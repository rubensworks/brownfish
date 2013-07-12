<div id="<?php echo $widget==NULL?"widget_template":("widget_".$widget->id)?>" class="widget-drag">
	<div class="well-header well-header-row">
		<div class="widget-controls">
			<i class="icon-white icon-hand-up move_widget"></i>
			<i class="icon-white icon-remove delete_widget"></i>
		</div>
	    <h3 class="well-title input-row">
		    <?php
		    echo CHtml::textField("name", $widget==NULL?"":$widget->name, array("class"=>"name"));
		    ?>
	    </h3>
	</div>
	<div class="well-body">
		<p><? echo Yii::t('messages', 'form.widgets.type') ?>: 
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
			<? echo Yii::t('messages', 'form.general.list') ?>
		</p>
		<div class="setup widget_type_setup widget_type_list_setup<?php echo ($widget == NULL || $widget->widget_type==Widget::$TYPE_LIST)?"":" hide" ?>">
			<div>
				<p>
					<?php echo CHtml::checkBox("filter_category", $widget != NULL && $widget->filter_category, array("class"=>"filter_category")) ?>
					<? echo Yii::t('messages', 'form.general.filterBy', array('{type}'=>Yii::t('messages', 'model.category.category'))) ?>
				</p>
				<div class="setup filter_category_setup<?php echo ($widget != NULL && $widget->filter_category)?"":" hide" ?>">
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
					<? echo Yii::t('messages', 'form.general.filterBy', array('{type}'=>Yii::t('messages', 'model.general.tags'))) ?>
				</p>
				<div class="setup filter_tags_setup<?php echo ($widget != NULL && $widget->filter_tags)?"":" hide" ?>">
					<?php
				    echo CHtml::textField("tags", $widget==NULL?"":$widget->tags, array("class"=>"tags".($widget==NULL?"":" input_tags")));
				    ?>
				</div>
			</div>
			<div class="input-row">
				<? echo Yii::t('messages', 'form.widgets.amount') ?>: <?php echo CHtml::dropDownList("amount", $widget==NULL?1:$widget->amount, Utils::makeCountingArray(5), array("class"=>"amount")); ?>
			</div>
		</div>
			<p>
				<?php echo CHtml::radioButton("widget_type_".($widget==NULL?"":$widget->id), $widget != NULL && $widget->widget_type==Widget::$TYPE_SINGLE, array("class"=>"widget_type_single")) ?>
				<? echo Yii::t('messages', 'form.widgets.singleItem') ?>
			</p>
		<div class="setup widget_type_setup widget_type_single_setup<?php echo ($widget != NULL && $widget->widget_type==Widget::$TYPE_SINGLE)?"":" hide" ?>">
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