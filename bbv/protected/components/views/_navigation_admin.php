<div
	id="<?php echo $navigation==NULL?"navigation_template":("navigation_".$navigation->id)?>"
	class="navigation_node">
	<div class="row-fluid">
		<div class="span6 input-row">
			<?php
			if($navigation != NULL && $navigation->type == Navigation::$TYPE_ROOT) {
				?><div class='span12'>Top element</div><?php
			} else {
				echo CHtml::textField("label", $navigation==NULL?"":$navigation->label, array("class"=>"nav_label", "placeholder"=>"Label"));
			}
			?>
		</div>
		<?php
		if($navigation == NULL || $navigation->type == Navigation::$TYPE_LEAF) {
			echo CHtml::textField("route", $navigation==NULL?"":$navigation->route, array("class"=>"route span4", "placeholder"=>"Link"));
		}
		if($navigation == NULL || $navigation->type != Navigation::$TYPE_LEAF) {
		?>
		<div class="span4 row-fluid node_controls">
			<?php
			$this->widget('bootstrap.widgets.TbButton', array(
					'label'=>'Sub Element',
					'icon'=>'plus',
					'htmlOptions'=>array('class'=>'span6 add_element'),
			));
			$this->widget('bootstrap.widgets.TbButton', array(
					'label'=>'Link',
					'icon'=>'plus',
					'htmlOptions'=>array('class'=>'span6 add_link'),
			));
			?>
		</div>
		<?php
		}
		if($navigation == NULL || $navigation->type != Navigation::$TYPE_ROOT) {
			$this->widget('bootstrap.widgets.TbButton', array(
					'label'=>'',
					'icon'=>'hand-up',
					'htmlOptions'=>array('class'=>'span1 pull-right move'),
			));
			$this->widget('bootstrap.widgets.TbButton', array(
					'label'=>'',
					'icon'=>'remove',
					'htmlOptions'=>array('class'=>'span1 pull-right remove'),
			));
		} else echo "<div class='span2 pull-right'>&nbsp;</div>";
		
		?>
	</div>
	<?php if($navigation == NULL || $navigation->type != Navigation::$TYPE_LEAF) { ?>
	<div class="navigation_column">
		<?php
		if($navigation !== NULL) {
			foreach($navigation->children as $child) {
				$this->render('_navigation_admin', array('navigation'=>$child));
			}
		}
		?>
	</div>
	<?php } ?>
</div>
