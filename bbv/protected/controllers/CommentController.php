<?php

class CommentController extends Controller
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
			array('allow', 
				'actions'=>array('comment', 'deleteComment'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param string $name the name of the model to be displayed
	 */
	public function actionComment()
	{
		$model=new Comment();
		
		if(isset($_POST['Comment']))
		{
			$model->attributes = $_POST['Comment'];
			
			if(!$model->save()) {
				echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Je bericht moet tussen de 1 en 512 tekens lang zijn.</div>';
			}
		}
		$this->widget('Commenting', array('item'=>$model->item));
	}
	
	/**
	 * Deletes a particular model.
	 * @param string $name the name of the model to be deleted
	 */
	public function actionDeleteComment($id)
	{
		$criteria=new CDbCriteria;
		$criteria->select='id, author_id';
		$criteria->condition='id=:id';
		$criteria->params=array(':id'=>$id);
		$model=Comment::model()->find($criteria);		
		if($model!=NULL && ($model->author_id==Yii::app()->user->id || Yii::app()->user->checkAccess('deleteComment')))
		{
			if($model->delete())
			{
				echo "deleted";
			}
			else
			{
				echo 'error';
			}
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Rate::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
