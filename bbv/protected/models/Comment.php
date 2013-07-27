<?php

/**
 * This is the model class for table "tbl_comment".
 *
 * @property int $id
 * @property int $date_created
 * @property int $author_id
 * @property int $item_id
 * @property string $content
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Games the static model class
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
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			array('item_id', 'safe'),
			array('content', 'length', 'max'=>512),
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
			'author'=>array(self::BELONGS_TO, 'User', 'author_id'),
			'item'=>array(self::BELONGS_TO, 'Item', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'content' => Yii::t('comments','Bericht'),
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
		
		$criteria->compare('id',$this->id,true);

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
		$this->content = htmlspecialchars($this->content);
	
		return parent::beforeValidate();
	}
	
	/**
	 * Count the amount of comments for an item
	 * @param integer $item_id
	 */
	public static function countComments($item_id)
	{
		return count(Comment::model()->findAll('item_id=:item_id', array(':item_id'=>$item_id)));
	}
	
}