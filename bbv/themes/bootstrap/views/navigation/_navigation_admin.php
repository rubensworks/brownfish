<div
	id="<?php echo $navigation==NULL?"navigation_template":("navigation_".$navigation->id)?>"
	class="navigation_node">
	<div class="row-fluid">
		<div class="span6 row-fluid">
			<?php
			echo CHtml::textField("label", $navigation==NULL?"":$navigation->label, array("class"=>"nav_label span12", "placeholder"=>"Label"));
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
		} else echo "<div class='span1 pull-right'>&nbsp;</div>";
		$this->widget('bootstrap.widgets.TbButton', array(
				'label'=>'',
				'icon'=>'remove',
				'htmlOptions'=>array('class'=>'span1 pull-right remove'),
		));
		?>
	</div>
	<?php if($navigation == NULL || $navigation->type != Navigation::$TYPE_LEAF) { ?>
	<div class="navigation_column">
		<?php
		if($navigation !== NULL) {
			foreach($navigation->children as $child) {
				$this->renderPartial('_navigation_admin', array('navigation'=>$child));
			}
		}
		?>
	</div>
	<?php } ?>
</div>
