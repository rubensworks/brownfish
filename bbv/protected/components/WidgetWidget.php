<?php
/**
 * 
 * @author Ruben Taelman
 * The common elements of a widget view
 *
 */
class WidgetWidget extends CWidget
{
	public $name;
	public $id;

	public function init()
	{
		parent::init();
		$this->render('widget_before',array(
			'id' => $this->id,
			'name' => $this->name,
		));
	}
	
	public function run(){
		$this->render('widget_after',array());
		parent::run();
    }

}
?>