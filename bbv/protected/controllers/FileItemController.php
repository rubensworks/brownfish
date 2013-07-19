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
						'actions'=>array('create','update','admin','delete'),
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
}
