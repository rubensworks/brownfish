<?php
/**
 * 
 * @author Ruben Taelman
 *
 * This is just a test/debug model TODO: delete this
 *
 * The followings are the available columns in table 'tbl_item_dummy':
 * @property integer $id
 * @property string $value
 *
 */
class DummyItem extends AbstractItem
{	
	/**
	 * Return a string representation of the type of the item
	 */
	public function getItemName() {
		return Yii::t('messages', 'enum.item.dummyItem');
	}
	
	/**
	 * Return a string representation of the type of the item in plural form
	 */
	public static function getMultipleItemName() {
		return Yii::t('messages', 'enum.item.dummyItems');
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(
				array(
				'id' => Yii::t('form', 'ID'),
				'value' => Yii::t('form', 'Waarde'),
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
				array('value', 'length', 'max'=>20),
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
		return 'tbl_item_dummy';
	}
	
	/**
	 * Override of the default CDbCriteria for the Abstract Item
	 * @return CDbCriteria
	 */
	public function makeDbCriteria() {
		$criteria = parent::makeDbCriteria();
		$criteria->compare('id',$this->id,true);
		$criteria->compare('value',$this->value,true);
		return $criteria;
	}
}