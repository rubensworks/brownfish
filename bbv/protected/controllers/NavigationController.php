<?php

class NavigationController extends Controller
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
				'roles'=>array('manageNavigation'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 */
	public function actionCreate()
	{
		$model = new Navigation();
		
		$model->label = $_GET['label'];
		$model->type = $_GET['type'];
		$model->route = $_GET['route'];
		$model->parent_id = $_GET['parent_id'];
		$model->row_order = $_GET['row_order'];
		
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
		$model=Navigation::model()->findByPk($id);
		
		// Get all the attributes (also non-set) and update them if needed
		$attributes = $model->attributeNames();
		foreach($attributes as $attribute) {
			NavigationController::updateIfNeeded($model, $attribute);
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
		$model=Navigation::model()->findByPk($id);
		$model->delete();
	}

	/**
	 * Lists all models.
	 */
	public function actionAdmin()
	{
		$this->render('admin');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Posts::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('messages', 'error.404'));
		$model->content=Item::getContents($model->id);
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='posts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
