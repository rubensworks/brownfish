<?php

/**
 * This is the model class for table "tbl_item".
 * This model is abstract, so this can't be used without any extensions.
 *
 * The followings are the available columns in table 'tbl_item':
 * @property integer $id
 * @property string $name
 * @property string $author
 * @property integer $date_created
 * @property integer $date_changed
 * @property integer $category
 * @property string $tags
 */
abstract class Item extends CActiveRecord
{
	// The content that doesn't need to be saved in the database
	public $content;
	
	/**
	 * Return a string representation of the type of the item
	 */
	abstract protected function getItemName();
	
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
		return 'tbl_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, author, category', 'required'),
			array('name', 'length', 'max'=>50),
			array('tags', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, author, category, tags', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('form', 'ID'),
			'name' => Yii::t('form', 'Naam'),
			'author' => Yii::t('form', 'Auteur'),
			'date_created' => Yii::t('form', 'Datum van aanmaak'),
			'date_changed' => Yii::t('form', 'Laatste bewerking'),
			'category' => Yii::t('form', 'Categorie'),
			'tags' => Yii::t('form', 'Tags'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('tags',$this->tags,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Prepares datereg, lastip, admin, confirm, fbid, ofb and avat
	 */
	 protected function beforeValidate()
	 {
	 	if ($this->isNewRecord) {
	 		$this->date_created = time();
	 		$this->author = Yii::app()->user->getId(); 
	 	}
		$this->date_changed=time();
		
		$this->saveContents();
		
		return parent::beforeValidate();
	 }
	 
	 /**
	  * Encrypt pwd for storage in database
	  */
	 protected function afterValidate()
	 {
		parent::afterValidate();
	 }
	 
	 /**
	  * Get the contents file of this item
	  * @return string
	  */
	 public function getFile()
	 {
	 	return Yii::getPathOfAlias('webroot.protected.data.items').'/'.$this->id.'.item';
	 }
	 
	 /**
	  * Get the contents of this item
	  * @return Item | string
	  */
	 public function getContents()
	 {
	 	$location=Item::getFile($this->id);
	 	if(file_exists($location)){
	 		$data=file_get_contents($location);
	 		return $data;
	 	}
	 	else{
	 		return "An error has occured while loading the post.";
	 	}
	 }
	 
	 /**
	  * Remove a file
	  * @param integer $id
	  */
	 public function rmFile()
	 {
	 	$location=Item::getFile($this->id);
	 	if(file_exists($uri))
	 		unlink(Item::getFile($this->id));
	 }
	 
	 /**
	  * Save the contents of this item
	  */
	 public function saveContents()
	 {
	 	$fh = fopen(Item::getFile($this->id), 'w') or die("can't open file");
	 	fwrite($fh, $this->content);
	 	fclose($fh);
	 }
}