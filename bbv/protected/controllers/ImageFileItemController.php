<?php
Yii::import('application.controllers.FileItemController');
/**
 * Manage the image files
 */
class ImageFileItemController extends FileItemController
{
	
	public function getItemClassName() {
		return "ImageFileItem";
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array_merge(array(
				array('allow',  // allow all users
						'actions'=>array('display'),
						'users'=>array('*'),
				),
		), parent::accessRules());
	}
	
	/**
	 * Let the users view images by id
	 * @param integer $id the id of an ImageFileItem
	 */
	public function actionDisplay($id) {
		$file = ImageFileItem::model()->findByPk($id);
		header("Content-type: ".$file->mime_type);
		echo @file_get_contents($file->getFile());
	}
}