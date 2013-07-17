<?php

/**
 * This is the model class for table "tbl_config".
 *
 * The followings are the available columns in table 'tbl_config':
 * @property string $key
 * @property string $value
 */
class Config extends WActiveRecord
{
	public static $KEYS = array(
			'MAIN_NAV' => 'core_main_nav_id',
			'INDEX_PAGE' => 'core_index_page_id',
	); 
	
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
		return 'tbl_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key', 'required'),
			array('key', 'length', 'max'=>50),
			array('value', 'safe'),
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
			'key' => Yii::t('form', 'key'),
			'value' => Yii::t('form', 'value'),
		);
	}
	
	/**
	 * Try to find a certain value in the dynamic config by key
	 * @param string $key the key for a certain value that we want to find
	 * @return mixed the value for that key or false if the value was not found
	 */
	public static function getValue($key) {
		$result = Config::model()->findByPk($key);
		if($result == NULL) return false;
		return @unserialize($result->value);
	}
	
	/**
	 * Set a certain dynamic config key-value
	 * @param string $key the key for a certain value that we want to save
	 * @param string $value the value we want to save
	 */
	public static function setValue($key, $value) {
		$model = Config::model()->findByPk($key);
		if($model == NULL){
			$model = new Config();
			$model->key = $key;
		}
		$model->value = @serialize($value);
		$model->save(false);
	}
}