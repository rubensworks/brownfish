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
				array('file', 'file', 'mimeTypes'=>Config::getValue(Config::$KEYS['FILE_ALLOWED_TYPES']), 'maxSize'=>Config::getValue(Config::$KEYS['FILE_MAX_SIZE']), 'on'=>'create'),//TODO: add more possible extensions, look for a better maxSize
				array('file', 'file', 'mimeTypes'=>Config::getValue(Config::$KEYS['FILE_ALLOWED_TYPES']), 'maxSize'=>Config::getValue(Config::$KEYS['FILE_MAX_SIZE']), 'allowEmpty' => true, 'on'=>'update'),
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
	
	/**
	 * A helper function to determine the filename without extension
	 * @param string $name filename with optional extension
	 * @return string filename without extension
	 */
	public static function getFileName($name)
	{
		if(($pos=strrpos($name,'.'))!==false)
			return (string)substr($name,0,$pos);
		else
			return $name;
	}
	
	public function beforeSave() {
		$this->file = CUploadedFile::getInstance($this,'file');
		if($this->file !== NULL) {
			$this->extension = $this->file->extensionName;
			$this->mime_type = $this->file->type;
			$this->item->name = self::getFileName($this->file->name);
		}
		return parent::beforeSave();
	}
	
	public function afterSave() {
		if($this->file !== NULL)
			$this->file->saveAs($this->getFile());
		return parent::afterSave();
	}
	
	/**
	 * The public download link for this file
	 */
	public function getDownloadLink() {
		return CHtml::normalizeUrl(array('/FileItem/download', 'id'=>$this->id));
	}
	
	/**
	 * The css class for this type of file
	 */
	public function getMimeTypeClass() {
		return str_replace("/","_",$this->mime_type);
	}
	
	/**
	 * Check if this FileItem contains an ImageFileItem
	 */
	public function isImage() {
		return strstr($this->mime_type, "image/");
	}
}