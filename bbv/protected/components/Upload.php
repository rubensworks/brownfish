<?php
class Upload extends CWidget
{

	public function init()
	{
		
	}
	
	/**
	 * An AJAX powered commenting form
	 */
	public function run(){
		Yii::app()->clientScript->registerPackage('fileupload');
		$this->render('upload',array(
			
		));
    }

}
?>