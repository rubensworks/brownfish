<?php

/**
 * 
 * @author Ruben Taelman
 * Abstracted Item extensions
 *
 */
abstract class AbstractItem extends WActiveRecord
{
	// Set this on 'true' if you want to use a custom _list_item view to be used in listing widgets
	public static $_CUSTOM_LIST_VIEW = false;
	
	public $item_search;
	public $author_search;
	public $category_search;
	public $tags_search;
	public $date_created_search;
	public $date_changed_search;
	
	/**
	 * Return a string representation of the type of the item
	 */
	public abstract function getItemName();
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('id, name, item_search, author_search, category_search, tags_search', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'item_search' => Yii::t('form', 'Naam'),
				'author_search' => Yii::t('form', 'Auteur'),
				'category_search' => Yii::t('form', 'Categorie'),
				'tags_search' => Yii::t('form', 'Tags'),
				'date_created_search' => Yii::t('form', 'Aangepast'),
				'date_changed_search' => Yii::t('form', 'Bewerkt'),
		);
	}
	
	/**
	 * @return array relational rules.
	*/
	public function relations()
	{
		return array(
				'item'=>array(self::BELONGS_TO, 'Item', 'id'),
		);
	}
	
	/**
	 * Behaviours
	 * @return multitype:multitype:string multitype:string
	 */
	public function behaviors() {
		return array(
				// attach wform behavior
				'wform' => array(
						'class' => 'ext.wform.WFormBehavior',
						// define relations which would be processed
						'relations' => array('item'),
				),
		);
	}
	
	/**
	 * Overridable basic DbCriteria
	 * @return CDbCriteria
	 */
	public function makeDbCriteria() {
		return new CDbCriteria(); 
	}
	
	/**
	 * Overridable attributes for the CActiveDataProvider
	 * @return multitype:multitype:string
	 */
	public function defaultAttributes() {
		return array(
					'item_search'=>array(
							'asc'=>'item.name',
							'desc'=>'item.name DESC',
					),
					'author_search'=>array(
							'asc'=>'author.name',
							'desc'=>'author.name DESC',
					),
					'category_search'=>array(
							'asc'=>'category.name',
							'desc'=>'category.name DESC',
					),
					'date_created_search'=>array(
							'asc'=>'item.date_created',
							'desc'=>'item.date_created DESC',
					),
					'date_changed_search'=>array(
							'asc'=>'item.date_changed',
							'desc'=>'item.date_changed DESC',
					),
			);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=$this->makeDbCriteria();
		$criteria->with = array(
				'item',
				'item.author',
				'item.category'
		);
		$criteria->compare('item.name',$this->item_search,true);
		$criteria->compare('author.name',$this->author_search,true);
		$criteria->compare('category.name',$this->category_search,true);
		$criteria->compare('item.tags',$this->tags_search,true);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort'=>array(
						'attributes'=> array_merge(
									$this->defaultAttributes(),
									array('*',)
								),
				),
		));
	}
	
	/**
	 * Cascade delete the related models
	 */
	public function afterDelete(){
		$this->item->delete();
		return parent::afterDelete();
	}
}