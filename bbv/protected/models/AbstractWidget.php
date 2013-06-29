<?php

/**
 * 
 * @author Ruben Taelman
 * Abstracted Widget extensions
 *
 */
abstract class AbstractWidget extends WActiveRecord
{
	
	/**
	 * Return a string representation of the type of the item
	 */
	public abstract function getWidgetName();
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('id', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		);
	}
	
	/**
	 * @return array relational rules.
	*/
	public function relations()
	{
		return array(
				//'item'=>array(self::BELONGS_TO, 'Item', 'id'),
		);
	}
	
	/**
	 * Behaviours
	 * @return multitype:multitype:string multitype:string
	 */
	public function behaviors() {
		return array(
		);
	}
}