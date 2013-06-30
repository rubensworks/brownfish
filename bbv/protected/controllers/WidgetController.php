<?php

class WidgetController extends Controller
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
				'actions'=>array('admin','create','update','delete'),
				'roles'=>array('managePages'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Widget();
		
		$model->name = "Nieuwe Widget";
		$model->page_id = $_GET['page_id'];
		$model->col_id = $_GET['col_id'];
		$model->row_order = $_GET['row_order'];
		$model->item_type = $_GET['item_type'];
		
		$class = $model->item_type;
		$instance = new $class();
		$model->item_type_display = $instance->getItemName();
		
		$model->save();
		
		echo CJSON::encode($model->getAttributes($model->safeAttributeNames));
	}
	
	/**
	 * Update fields of a model only if they are set in the GET parameters
	 * @param model $model model to update
	 * @param string $field name of the field
	 */
	private static function updateIfNeeded($model, $field) {
		if(isset($_GET[$field])) $model[$field] = $_GET[$field];
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=Widget::model()->findByPk($id);
		
		// Get all the attributes (also non-set) and update them if needed
		$attributes = $model->attributeNames();
		foreach($attributes as $attribute) {
			WidgetController::updateIfNeeded($model, $attribute);
		}
		
		$model->save();
		
		echo CJSON::encode($model->getAttributes());
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=Widget::model()->findByPk($id);
		$model->delete();
	}
}
