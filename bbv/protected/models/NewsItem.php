<?php

/**
 * 
 * @author Ruben Taelman
 *
 * The followings are the available columns in table 'tbl_item_news':
 * @property integer $id
 * @property string $excerpt
 * @property boolean $conditional_date
 * @property integer $startdate
 * @property integer $enddate
 * @property boolean $hide
 *
 */
class NewsItem extends AbstractItem
{		
	/**
	 * Init the default model values
	 */
	public function init() {
		$this->startdate = date(Yii::app()->params['dateFormatCore'], time());
		$this->enddate = date(Yii::app()->params['dateFormatCore'], time());
		parent::init();
	}
	
	/**
	 * Return a string representation of the type of the item
	 */
	public function getItemName() {
		return Yii::t('messages', 'enum.item.newsItem');
	}
	
	/**
	 * Return a string representation of the type of the item in plural form
	 */
	public static function getMultipleItemName() {
		return Yii::t('messages', 'enum.item.newsItems');
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(
				array(
				'id' => Yii::t('messages', 'model.general.id'),
				'excerpt' => Yii::t('messages', 'model.items.news.excerpt'),
				'conditional_date' => Yii::t('messages', 'model.items.news.conditional_date'),
				'startdate' => Yii::t('messages', 'model.items.news.startdate'),
				'enddate' => Yii::t('messages', 'model.items.news.enddate'),
				'hide' => Yii::t('messages', 'model.items.news.hide'),
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
				array('excerpt', 'length', 'max'=>500),
				array('startdate, enddate', 'type', 'type' => 'date', 'message' => Yii::t('messages', 'form.error.noDate'), 'dateFormat' => Yii::app()->params['dateFormat']),
				array('hide, conditional_date', 'safe'),
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
		return '{{item_news}}';
	}
	
	/**
	 * On public view, show non-hidden newsitems and only if they are within the date range
	 * @return multitype:multitype:string
	 */
	public function scopes()
	{
		return array_merge(parent::scopes(), array(
				'visible'=>array(
						'condition'=>'((conditional_date = 1 AND startdate <= CURDATE() AND enddate >= CURDATE()) OR conditional_date = 0) AND hide = false',
				),
		));
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