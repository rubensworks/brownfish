<?php

/**
 * 
 * @author Ruben Taelman
 *
 * The followings are the available columns in table 'tbl_item_text':
 * @property integer $id
 *
 */
class TextItem extends AbstractItem
{		
	/**
	 * Return a string representation of the type of the item
	 */
	public function getItemName() {
		return Yii::t('messages', 'enum.item.textItem');
	}
	
	/**
	 * Return a string representation of the type of the item in plural form
	 */
	public static function getMultipleItemName() {
		return Yii::t('messages', 'enum.item.textItems');
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(
				array(
				'id' => Yii::t('messages', 'model.general.id'),
		), parent::attributeLabels());
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array_merge(array(
		), parent::rules());
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
		return '{{item_text}}';
	}
	
	/**
	 * Override of the default CDbCriteria for the Abstract Item
	 * @return CDbCriteria
	 */
	public function makeDbCriteria() {
		$criteria = parent::makeDbCriteria();
		$criteria->compare('id',$this->id,true);
		return $criteria;
	}
}