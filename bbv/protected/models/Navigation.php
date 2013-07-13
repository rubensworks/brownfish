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
 * @property string $bizrule
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
	
	/**
	 * Clear navigation cache on update
	 */
	public function beforeSave() {
		Yii::app()->cache->delete(Utils::$CACHE_NAVIGATION);
		return parent::beforeSave();
	}
	
	/**
	 * Check a bizrule (based on http://www.yiiframework.com/doc/api/1.1/CAuthManager#executeBizRule-detail )
	 * @param string $bizRule the business rule to be executed.
	 * @return boolean whether the business rule returns true. If the business rule is empty, it will still return true.
	 */
	public function executeBizRule() {
		return $this->bizrule===''
				|| $this->bizrule===null
				|| @eval($this->bizrule)!=0;
	}
	
	/**
	 * Make the complete navigation structure to pass to a CMenu widget
	 * @param Navigation $root optional root element
	 * @return array structure of the complete navigation to pass to a CMenu widget
	 */
	public static function buildNavigation($root=NULL) {
		$sub=Yii::app()->cache->get(Utils::$CACHE_NAVIGATION);
		if($sub === false || $root == NULL) {
			$sub = array();
			$toCache = false;
			// Look for the root in the database if no root was given
			if($root == NULL) {
				$toCache = true;
				$criteria = new CDbCriteria();
				$criteria->condition = "type = :type";
				$criteria->params = array(':type'=>Navigation::$TYPE_ROOT);
				$root = Navigation::model()->find($criteria);
				if($root == NULL) return $sub;
			}
			
			// Execute bizrule and only show the node (and children) if this passes
			if($root->executeBizRule()) {
				if($root->type != Navigation::$TYPE_LEAF) { // Our element is a root or node
					if($root->type == Navigation::$TYPE_NODE) { // Do not add a label to the root
						$sub['label'] = $root->label;
					} else { // Add general css class to the root node
						$sub['htmlOptions'] = array('class'=>'main_nav');
					}
					// Loop recursively over the child nodes
					foreach($root->children as $child) {
						$sub['items'][] = self::buildNavigation($child);
					}
				} else if($root->type == Navigation::$TYPE_LEAF) { // Our element if a leaf
					$sub['label'] = $root->label;
					$sub['url'] = array($root->route);
				}
			}
		}
		// Cache structure if this function was started from a NULL root
		if($toCache) Yii::app()->cache->set(Utils::$CACHE_NAVIGATION, $sub, Utils::$CACHE_DURATION_LONG);
		
		return $sub;
	}
}