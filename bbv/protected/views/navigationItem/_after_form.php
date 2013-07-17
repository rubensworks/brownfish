<?php
if($this->action->Id == "update") {
	$this->widget('NavigationForm', array('root_id'=>$model->navigation_id));
} else {
	?><span class="muted">Na de aanmaak van dit item kan de navigatie samengesteld worden.</span><?php
}
?>
