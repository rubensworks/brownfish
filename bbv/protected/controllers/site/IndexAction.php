<?php
Yii::import("application.controllers.page.ViewAction");
class IndexAction extends CAction
{
	private $action;
	
	public function __construct($controller, $id)
	{
		$this->action = new ViewAction($controller, $id);
	    parent::__construct($controller, $id);
	}
	
	/**
	 * Render the index page
	 */
	public function run()
	{
		$this->action->run(Config::getValue(Config::$KEYS['INDEX_PAGE']));
	}
}