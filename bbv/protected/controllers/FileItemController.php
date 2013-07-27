<?php

/**
 * Manage ALL the files!
 */
class FileItemController extends AbstractItemController
{
	public $itemFormOptions = array('enctype' => 'multipart/form-data');
	
	public function getItemClassName() {
		return "FileItem";
	}
	
	public function getListColumns() { 
		return array(
				'id',
				'extension',
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow', // allow admin user to perform CRUD
						'actions'=>array('create','update','admin','delete','upload','details','getInclude'),
						'roles'=>array('manageFiles'),
				),
				array('allow',  // allow all users
						'actions'=>array('index','view', 'download'),
						'users'=>array('*'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	/**
	 * Let the users download files by id
	 * @param integer $id the id of a FileItem
	 */
	public function actionDownload($id) {
		$file = FileItem::model()->findByPk($id);
		return Yii::app()->getRequest()->sendFile($file->item->name.'.'.$file->extension, @file_get_contents($file->getFile()));
	}
	
	/**
	 * Upload a file with drag & drop, the item details are filled in automatically
	 */
	public function actionUpload() {
		$file = new FileItem();
		$file->item = new Item();
		$file->item->name = "TMP File Name";// This will be overwritten before save
		$file->item->category_id = Config::getValue(Config::$KEYS['DEFAULT_CATEGORY']);
		$file->save();
	}
	
	/**
	 * Fetch JSON details of a certain FileItem
	 * @param integer $id id of the requested FileItem
	 */
	public function actionDetails($id) {
		$model = FileItem::model()->findByPk($id);
		echo CJSON::encode(array(
				'id' => $model->item->id,
				'name' => $model->item->name,
		));
	}
	
	/**
	 * Fetch the to-include html to place this item inside the content editor.
	 * @param integer $id id of the requested FileItem
	 */
	public function actionGetInclude($id) {
		$model = FileItem::model()->findByPk($id);
		if($model->isImage()) $this->redirect(array('/ImageFileItem/getInclude', 'id'=>$id));
		echo CHtml::link($model->item->name, Yii::app()->createAbsoluteUrl('/FileItem/download', array('id'=>$model->id)));
	}
}
