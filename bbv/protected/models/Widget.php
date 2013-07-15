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
		return 'tbl_widget';
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
			'id' => Yii::t('form', 'ID'),
			'name' => Yii::t('form', 'Titel'),
			'page' => Yii::t('form', 'Pagina'),
			'col_id' => Yii::t('form', 'Kolom'),
			'row_order' => Yii::t('form', 'Rij volgorde'),
			'item_type' => Yii::t('form', 'Item Type'),
			'widget_type' => Yii::t('form', 'Widget Type'),
			'filter_category' => Yii::t('form', 'Filter op categorie'),
			'category' => Yii::t('form', 'Categorie'),
			'filter_tags' => Yii::t('form', 'Filter op tags'),
			'tags' => Yii::t('form', 'Tags'),
			'amount' => Yii::t('form', 'Amount'),
			'item_id' => Yii::t('form', 'Item ID'),
			'item_type_display' => Yii::t('form', 'Item Type'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}