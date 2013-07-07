<?php
/**
 * Container for all the News actions
 * @author Ruben Taelman
 *
 */
class TextItemController extends AbstractItemController
{
	
	public function getItemClassName() {
		return "TextItem";
	}
	
	public function getListColumns() {
		return array(
				'id',
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
				'roles'=>array('manageText'),
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
