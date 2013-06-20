<?php
class ChangePassword extends CWidget
{
	private $id;
	public $model;

	public function init()
	{
		$this->id=Yii::app()->user->id;
		$this->model=new User('ChangePassword');
	}
	
	/**
	 * A full AJAX form calls this action to change the user's password
	 */
	public function run(){
		$this->render('changePassword',array(
			'model'=>$this->model,
		));
    }
	
	public function getModel()
	{
		return $this->model;
	}

}
?>