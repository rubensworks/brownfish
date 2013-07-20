<?php
/**
 * 
 * @author Ruben Taelman
 *
 *
 * The followings are the available columns in table 'tbl_item_file':
 * @property integer $id
 * @property string $extension
 *
 */
class FileItem extends AbstractItem
{	
	public $file;
	
	/**
	 * Return a string representation of the type of the item
	 */
	public function getItemName() {
		return Yii::t('messages', 'enum.item.fileItem');
	}
	
	/**
	 * Return a string representation of the type of the item in plural form
	 */
	public static function getMultipleItemName() {
		return Yii::t('messages', 'enum.item.fileItems');
	}
	
	public function rules()
	{
		return array_merge(array(
				array('file', 'file', 'types'=>'jpg, gif, png'),//TODO: add more possible extensions
				array('file', 'file', 'maxSize'=>10000),//TODO: look for a better maxSize
		), parent::rules());
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(
				array(
				'id' => Yii::t('messages', 'model.general.id'),
				'extension' => Yii::t('messages', 'model.items.file.extension'),
				'file' => Yii::t('messages', 'model.items.file.file'),
		), parent::attributeLabels());
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_item_file';
	}
	
	/**
	 * Get the contents file of this item
	 * @return string file location
	 */
	public function getFile()
	{
		return Yii::getPathOfAlias('webroot.protected.data.files').'/'.$this->id.'.'.$this->extension;
	}
	
	/**
	 * Remove a file
	 */
	public function rmFile()
	{
		$location = $this->getFile();
		if(file_exists($location))
			unlink($location);
	}
	
	/**
	 * Delete the item file
	 */
	public function afterDelete() {
		$this->rmFile();
		return parent::afterDelete();
	}
	
	public function beforeSave() {
		$this->file = CUploadedFile::getInstance($this,'file');
		$this->item->name = $this->file->name;
		$this->extension = $this->file->extensionName;
		return parent::beforeSave();
	}
	
	public function afterSave() {
		$this->file->saveAs($this->getFile());
		return parent::afterSave();
	}
}