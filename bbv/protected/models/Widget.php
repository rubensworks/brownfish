<?php

/**
 * This is the model class for table "tbl_widget".
 *
 * The followings are the available columns in table 'tbl_widget':
 * @property integer $id
 * @property string $name
 * @property integer $page_id
 * @property integer $col_id
 * @property integer $row_order
 * @property string $item_type
 * @property string $widget_type
 * @property integer $filter_category
 * @property integer $category_id
 * @property integer $filter_tags
 * @property string $tags
 * @property integer $amount
 * @property integer $item_id
 * @property integer $clear
 */
class Widget extends WActiveRecord
{	
	public static $TYPE_LIST = "LIST";
	public static $TYPE_SINGLE = "SINGLE";
	public static $VIEWS = array(
			"LIST" => "/page/_widget_view_list",
			"SINGLE" => "/page/_widget_view_single",
	);
	
	public $item_type_display;
	
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
		return '{{widget}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_type_display, id, item_type', 'safe'),
			array('name', 'required'),
			array('name', 'length', 'max'=>50),
			array('name', 'safe', 'on'=>'search'),
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
			'page'=>array(self::BELONGS_TO, 'Page', 'page_id'),
			'category'=>array(self::BELONGS_TO, 'Category', 'category_id'),
			'item'=>array(self::BELONGS_TO, 'Item', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('messages', 'model.general.id'),
			'name' => Yii::t('messages', 'model.general.title'),
			'page' => Yii::t('messages', 'model.widget.page'),
			'col_id' => Yii::t('messages', 'model.widget.column'),
			'row_order' => Yii::t('messages', 'model.widget.rowOrder'),
			'item_type' => Yii::t('messages', 'model.widget.itemType'),
			'widget_type' => Yii::t('messages', 'model.widget.widgetType'),
			'filter_category' => Yii::t('messages', 'Filter op categorie'),
			'category' => Yii::t('messages', 'model.category.category'),
			'filter_tags' => Yii::t('messages', 'form.general.filterBy', array('{type}' => Yii::t('messages', 'model.general.tags'))),
			'tags' => Yii::t('messages', 'model.general.tags'),
			'amount' => Yii::t('messages', 'form.widgets.amount'),
			'item_id' => Yii::t('messages', 'model.widget.itemId'),
			'item_type_display' => Yii::t('messages', 'model.widget.itemType'),
			'clear' => Yii::t('messages', 'model.widget.clear'),
		);
	}
	
	/**
	 * Clear page cache after save
	 */
	protected function afterSave()
	{
		Page::flushCache();
		return parent::afterSave();
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}