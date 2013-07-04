<?php

/**
 * This is the model class for table "tbl_navigation".
 *
 * The followings are the available columns in table 'tbl_navigation':
 * @property integer $id
 * @property string $label
 * @property string $type
 * @property string $route
 * @property integer $parent_id
 * @property integer $row_order
 */
class Navigation extends WActiveRecord
{
	public static $TYPE_ROOT = "ROOT";
	public static $TYPE_NODE = "NODE";
	public static $TYPE_LEAF = "LEAF";
	
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
		return 'tbl_navigation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label, type', 'required'),
			array('label', 'length', 'max'=>50),
			array('route', 'length', 'max'=>100),
			array('id', 'safe'),
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
			'parent'=>array(self::BELONGS_TO, 'Navigation', 'id'),
			'children'=>array(self::HAS_MANY, 'Navigation', 'parent_id', 'order'=>'row_order ASC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('form', 'ID'),
			'label' => Yii::t('form', 'Label'),
			'type' => Yii::t('form', 'Type'),
			'route' => Yii::t('form', 'Route'),
			'parent' => Yii::t('form', 'Parent'),
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
	
	/**
	 * Cascade delete the children
	 */
	public function beforeDelete() {
		foreach($this->children as $child) {
			$child->delete();
		}
		return parent::beforeDelete();
	}
}