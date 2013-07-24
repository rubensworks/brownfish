<?php
/**
 * 
 * @author Ruben Taelman
 *
 * An extension for the FilItem model, where only image/* mimetypes are returned
 *
 */
class ImageFileItem extends FileItem
{	
	public static $_CUSTOM_LIST_VIEW = true;
	
	/**
	 * Return a string representation of the type of the item
	 */
	public function getItemName() {
		return Yii::t('messages', 'enum.item.imageFileItem');
	}
	
	/**
	 * Return a string representation of the type of the item in plural form
	 */
	public static function getMultipleItemName() {
		return Yii::t('messages', 'enum.item.imageFileItem');
	}
	
	/**
	 * Only show image files
	 * @return multitype:string default criteria
	 */
	public function defaultScope(){
        return array(
            'condition'=>'mime_type LIKE \'image/%\'',
        );
    }
    
    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
    	return parent::model($className);
    }
}