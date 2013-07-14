<?php
/**
 * Container for all the Navigation actions
 * @author Ruben Taelman
 *
 */
class NavigationItemController extends AbstractItemController
{
	
	public function getItemClassName() {
		return "NavigationItem";
	}
	
	public function getListColumns() {
		return array(
				'id',
		);
	}
	
	protected function afterCreate($model) {
		$class = $this->getItemClassName();
		$this->redirect(array('/'.$class.'/update', 'id'=>$model->id));
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
				'roles'=>array('manageNavigation'),
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
