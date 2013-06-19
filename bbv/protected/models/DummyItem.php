<?php

/**
 * 
 * @author Ruben Taelman
 *
 * The followings are the available columns in table 'tbl_item_dummy':
 * @property integer $id
 * @property string $value
 *
 */
class DummyItem extends WActiveRecord
{
	/**
	 * Return a string representation of the type of the item
	 */
	public function getItemName() {
		return "DummyItem";
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
		return 'tbl_item_dummy';
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
	
	public function behaviors() {
		return array(
				// attach wform behavior
				'wform' => array(
						'class' => 'ext.wform.WFormBehavior',
						// define relations which would be processed
						'relations' => array('item'),
				),
				// or you could allow to skip some relation saving if it was submitted empty
				'wform' => array(
						'class' => 'ext.wform.WFormBehavior',
						'relations' => array(
								'item' => array('required' => true),
						),
				),
		);
	}
}