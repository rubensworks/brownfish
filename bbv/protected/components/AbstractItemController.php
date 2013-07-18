<?php

/**
 * This controller contains abstract methods for CRUD actions
 * @author Ruben Taelman
 *
 */
abstract class AbstractItemController extends Controller
{
	public $itemFormOptions = array();
	
	/**
	 * The name of the model class
	 */
	public abstract function getItemClassName();
	
	/**
	 * The columns of the model to be used inside the ItemList besides the default item columns
	 */
	public abstract function getListColumns();
	
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
				'actions'=>array('create','update','index','delete'),
				'roles'=>array('manageNews'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * This is called after a newly created model was saved
	 */
	protected function afterCreate($model) {
		$class = $this->getItemClassName();
		$this->redirect(array('/'.$class.'/admin'));
	}

	/**
	 * This is called after a model was updated
	 */
	protected function afterUpdate($model) {
		$class = $this->getItemClassName();
		$this->redirect(array('/'.$class.'/admin'));
	}
	
	/**
	 * This is called after a model was deleted
	 */
	protected function afterDelete($model) {
		$class = $this->getItemClassName();
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/'.$class.'/admin'));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$class = $this->getItemClassName();
		$model=new $class();

		if(isset($_POST[$class]))
		{
			$model->attributes=$_POST[$class];
			$model->item->content=$_POST[$class]['item']['content'];
			if($model->save())	
				$this->afterCreate($model);
		}

		$this->render('/item/create',array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$class = $this->getItemClassName();
		$model=$class::model()->findByPk($id);

		if(isset($_POST[$class]))
		{
			$model->attributes=$_POST[$class];
			$model->item->content=$_POST[$class]['item']['content'];
			if($model->save())
				$this->afterUpdate($model);
		}

		$this->render('/item/update',array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$class = $this->getItemClassName();
		if(Yii::app()->request->isPostRequest || true)
		{
			// we only allow deletion via POST request
			$model=$class::model()->findByPk($id);
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->afterDelete($model);
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionAdmin()
	{
		$class = $this->getItemClassName();
		$model=new $class('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$class])){
			$model->attributes=$_GET[$class];
		}
		
		$this->render('/item/admin',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$class = $this->getItemClassName();
		$model=new $class('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$class])){
			$model->attributes=$_GET[$class];
		}
	
		$this->render('/item/index',array(
				'model'=>$model,
		));
	}
	
	/**
	 * View a particular model.
	 * @param integer $id the ID of the model to be viewed
	 */
	public function actionView($id)
	{
		$class = $this->getItemClassName();
		$model = $class::model()->cache(Utils::$CACHE_DURATION_SHORT)->findByPk($id);
	
		$this->render('/item/view',array(
				'model' => $model,
		));
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
