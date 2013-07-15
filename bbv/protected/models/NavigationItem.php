<?php

/**
 * 
 * @author Ruben Taelman
 *
 * The followings are the available columns in table 'tbl_item_navigation':
 * @property integer $id
 * @property integer $navigation_id
 *
 */
class NavigationItem extends AbstractItem
{		
	public $holdContent = false;
	
	/**
	 * Return a string representation of the type of the item
	 */
	public function getItemName() {
		return "Navigatie Item";
	}
	
	/**
	 * Return a string representation of the type of the item in plural form
	 */
	public static function getMultipleItemName() {
		return "Navigaties";
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array_merge(
				array(
						'navigation'=>array(self::BELONGS_TO, 'Navigation', 'navigation_id'),
				),
				parent::relations()
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(
				array(
				'id' => Yii::t('form', 'ID'),
				'navigation' => Yii::t('form', 'Navigatie'),
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
		return 'tbl_item_navigation';
	}
	
	/**
	 * Make a new root element right before this Item is being saved
	 */
	 protected function beforeSave()
	 {
	 	if($this->isNewRecord)
			$this->navigation_id = Navigation::generateRoot()->id;
		return parent::beforeSave();
	 }
	 
	 /**
	  * Cascade delete the related models
	  */
	 public function afterDelete(){
	 	$this->navigation->delete();
	 	return parent::afterDelete();
	 }
}