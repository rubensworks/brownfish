<?php

/**
 * This is the model class for table "tbl_item".
 * This model shouldn't be used without any extension tables.
 *
 * The followings are the available columns in table 'tbl_item':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $author_id
 * @property integer $date_created
 * @property integer $date_changed
 * @property integer $category_id
 * @property string $tags
 */
class Item extends WActiveRecord
{	
	/**
	 * Return a string representation of the type of the item
	 */
	public function getItemName() {
		return "Item";
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
		return 'tbl_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, author_id, category_id', 'required'),
			array('name', 'length', 'max'=>50),
			array('tags', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, author, category, tags', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Dynamically add all the different item types to the relations of the base item
		$types = Utils::getItemTypes();
		$typeArray = array();
		foreach($types as $type)
			$typeArray[$type] = array(self::HAS_ONE, $type, 'id');
		
		return array_merge($typeArray, array(
			'category'=>array(self::BELONGS_TO, 'Category', 'category_id'),
			'author'=>array(self::BELONGS_TO, 'User', 'author_id'),
			'comment'=>array(self::HAS_MANY, 'Comment', 'id'),
			'widget'=>array(self::HAS_MANY, 'Widget', 'id'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('form', 'ID'),
			'name' => Yii::t('form', 'Naam'),
			'author_id' => Yii::t('form', 'Auteur'),
			'date_created' => Yii::t('form', 'Datum van aanmaak'),
			'date_changed' => Yii::t('form', 'Laatste bewerking'),
			'category_id' => Yii::t('form', 'Categorie'),
			'tags' => Yii::t('form', 'Tags'),
			'content' => Yii::t('form', 'Inhoud'),
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
		$criteria->compare('author_id',$this->author_id,true);
		$criteria->compare('category_id',$this->category->id,true);
		$criteria->compare('tags',$this->tags,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Prepares values
	 */
	 protected function beforeValidate()
	 {
	 	if($this->isNewRecord) {
	 		$this->date_created = time();
	 		$this->author_id = Yii::app()->user->getId(); 
	 	}
		$this->date_changed=time();
		
		return parent::beforeValidate();
	 }
	 
	 /**
	  * Behaviours for wform
	  * @return multitype:multitype:string multitype:string
	  */
	 public function behaviors() {
	 	return array(
	 			// attach wform behavior
	 			'wform_category' => array(
	 					'class' => 'ext.wform.WFormBehavior',
	 					// define relations which would be processed
	 					'relations' => array('category'),
	 			),
	 			'wform_author' => array(
	 					'class' => 'ext.wform.WFormBehavior',
	 					// define relations which would be processed
	 					'relations' => array('author'),
	 			),
	 	);
	 }
	 
	 /**
	  * Cascade delete the related models and the item file
	  */
	 public function afterDelete() {
	 	Comment::model()->deleteAll(array('condition' => 'item_id = :item_id', 'params'=> array(':item_id' => $this->id)));
	 	Widget::model()->deleteAll(array('condition' => 'item_id = :item_id', 'params'=> array(':item_id' => $this->id)));
	 	return parent::afterDelete();
	 }
	 
	 /**
	  * Build the list that is filterable with a widget
	  * @param Widget $widget the list-widget that has some filters
	  * @return AbstractItem's
	  */
	 public static function findList($widget) {
	 	$class = $widget->item_type;
	 	$criteria = new CDbCriteria();
	 	$criteria->with = array('item');
	 	$params = array();
	 	$criteria->condition = "";
	 	if($widget->filter_category) {
	 		$criteria->condition .= "item.category_id = :category_id";
	 		$params[':category_id'] = $widget->category_id;
	 	}
	 	if($widget->filter_tags) {
	 		if($widget->filter_category) $criteria->condition .= " AND ";
	 		$i = 0;
	 		$tags = explode(",", $widget->tags);
	 		foreach($tags as $tag) {
	 			if($i>0) $criteria->condition.= " AND ";
	 			$criteria->condition .= " item.tags LIKE :tag_".$i." ";
	 			$params[':tag_'.$i] = "%".$tag."%";
	 			$i++;
	 		}
	 	}
	 	$criteria->params = $params;
	 	$criteria->order = "item.date_created DESC";
	 	$criteria->limit = $widget->amount;
	 	$items = $class::model()->findAll($criteria);
	 	return $items;
	 }
}