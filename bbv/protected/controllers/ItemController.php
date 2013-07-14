<?php

/**
 * General actions for all types of items
 *
 */
class ItemController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('aclist'),
				'roles'=>array('manageItems'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Autocomplete for all types of items
	 */
	public function actionAclist()
	{
		$results = array();
		if(isset($_GET[0]['item_type'])) {
            $criteria = new CDbCriteria();
            $criteria->with = array(
            		'item',
            );
            $criteria->compare('item.name', $_GET['term'], true);
            $model = new $_GET[0]['item_type']('search');
            foreach($model->findAll($criteria) as $m)
            {
                $results[] = array(
                		'label'=>$m->item->name,
                		'value'=>$m->item->name,
                		'id'=>$m->id,
                );
            }
 
        }
        echo CJSON::encode($results);
	}
}