<?php

/**
 * This is just a test/debug controller TODO: delete this
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
				'actions'=>array('create','update','index','delete', 'aclist'),
				'roles'=>array('manageItems'),
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
		$model=new DummyItem();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DummyItem']))
		{
			$model->attributes=$_POST['DummyItem'];
			$model->item->content=$_POST['DummyItem']['item']['content'];
			if($model->save())	
				$this->redirect(array('index'));
				//$this->redirect(array('view','name'=>$model->title));
		}

		$this->render('create',array(
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
		$model=DummyItem::model()->findByPk($id);
		$model->item->fetchContents();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DummyItem']))
		{
			$model->attributes=$_POST['DummyItem'];
			$model->item->content=$_POST['DummyItem']['item']['content'];
			if($model->save())
				$this->redirect(array('index'));
				//$this->redirect(array('view','name'=>$model->id));
		}

		$this->render('update',array(
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
		if(Yii::app()->request->isPostRequest || true)
		{
			// we only allow deletion via POST request
			$model=DummyItem::model()->findByPk($id);
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new DummyItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DummyItem'])){
			$model->attributes=$_GET['DummyItem'];
		}
		
		$this->render('index',array(
				'model'=>$model,
		));
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
