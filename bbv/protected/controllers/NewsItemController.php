<?php
/**
 * Container for all the News actions
 * @author Ruben Taelman
 *
 */
class NewsItemController extends AbstractItemController
{
	
	public function getItemClassName() {
		return "NewsItem";
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
				'roles'=>array('manageNews'),
			),
			array('allows',  // allow all users
					'actions'=>array('index','view'),
					'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
}
