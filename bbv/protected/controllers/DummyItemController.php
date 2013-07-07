<?php

/**
 * This is just a test/debug controller TODO: delete this
 *
 */
class DummyItemController extends AbstractItemController
{
	public function getItemClassName() {
		return "DummyItem";
	}
	
	public function getListColumns() { 
		return array(
				'id',
				'value',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform CRUD
				'actions'=>array('create','update','admin','delete'),
				'roles'=>array('manageItems'),
			),
			array('allow',  // allow all users
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
}
