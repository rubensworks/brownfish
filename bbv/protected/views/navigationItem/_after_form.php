<?php
switch($this->action->Id){
	case "create":
		?><span class="muted">Na de aanmaak van dit item kan de navigatie samengesteld worden.</span><?php
		break;
	case "update":
		$this->widget('NavigationForm', array('root_id'=>$model->navigation_id));
		break;
}
?>
