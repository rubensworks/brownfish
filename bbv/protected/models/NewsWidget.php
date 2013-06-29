<?php
/**
 * 
 * @author Ruben Taelman
 *
 *
 * The followings are the available columns in table 'tbl_widget_news':
 * @property integer $id
 *
 */
class NewsWidget extends AbstractItem
{	
	/**
	 * Return a string representation of the type of the item
	 */
	public function getItemName() {
		return "Nieuws Widget";
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(
				array(
				'id' => Yii::t('form', 'ID'),
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
		return 'tbl_widget_news';
	}
}