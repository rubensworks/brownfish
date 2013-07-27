<?php
Yii::import('application.controllers.FileItemController');
/**
 * Manage the image files
 */
class ImageFileItemController extends FileItemController
{
	/**
	 * Overridable htmlOptions to add to the ItemList that is shown on the index action.
	 * @return multitype:array of htmlOptions
	 */
	public function getListViewHtmlOptions() {
		return array('class'=>'image-list-view');
	}
	
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
	
	/**
	 * Add extra clientscripts to the default item index
	 */
	public function actionIndex() {
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/image_gallery.js');
		Yii::app()->clientScript->registerScript('deleteComment',"
			var imageViewUrl = \"".CHtml::normalizeUrl(array('/ImageFileItem/view', 'id'=>''))."\";
			var imageDisplayUrl = \"".CHtml::normalizeUrl(array('/ImageFileItem/display', 'id'=>''))."\";
		", CClientScript::POS_BEGIN);
		return parent::actionIndex();
	}
	
	/**
	 * Fetch the to-include html to place this item inside the content editor.
	 * @param integer $id id of the requested ImageFileItem
	 */
	public function actionGetInclude($id) {
		$data = FileItem::model()->findByPk($id);
		echo '<a href="'.Yii::app()->createAbsoluteUrl('/ImageFileItem/view', array('id'=>$data->id)).'">';
		echo CHtml::image(Yii::app()->getRequest()->getHostInfo('').Yii::app()->easyImage->thumbSrcOf($data->getFile(), array(
				'type' => 'png',
				'resize' => array('width' => 200, 'height' => 200),
				'crop' => array('width' => 100, 'height' => 100),
			)), $data->item->name);
		echo '</a>';
	}
}
