<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
    * Declares class-based actions.
    */
    public function actions()
    {
        return array(
                'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'testLimit' => 1,
                'minLength' => 7,
                'maxLength' => 7,
                ),
                // page action renders "static" pages stored under 'protected/views/site/pages'
                // They can be accessed via: index.php?r=site/page&view=FileName
                'page' => array(
                'class' => 'CViewAction',
                ),
    	);
    }

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
                'actions'=>array('register', 'recoverPassword'),
				'roles'=>array('registerUser'),
            ),
			array('allow', // allow captcha for all users
				'actions'=>array('captcha'),
				'users'=>array('*'),
			),
			array('allow', // show the (personalised) dashboard
				'actions'=>array('dashboard', 'changePassword'),
				'roles'=>array('dashboardUser'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Registration of users without admin rights
	 */
	public function actionRegister()
	{
		$model=new User('register');

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
			{
				$this->render('registerSuccess', array(
					'username' => $model->name,
					'email' => $model->mail,
				));
				return;
			}
		}
		$this->render('register',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Shows a form that let's a user enter his username
	 *  and after that a new randomly generated password will be sent to the user's email adress
	 */
	public function actionRecoverPassword()
	{
		$model=new User('recoverPassword');
	
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$criteria=new CDbCriteria;
			$criteria->condition='name=:name';
			$criteria->params=array(':name'=>$model->name);
			$user=User::model()->find($criteria);
			if($user!=NULL)
			{
				if(isset($model->name))
				{
					if($user->secra==$model->secra && ($model->secra!='' || $user->secra==''))
					{
						if(!$model->mailNewPassword(
								$user->name,$user->mail,
								$model->generateNewPassword($user->name))
						)
							$model->addError('secrq', Yii::t('error', 'Er is iets misgelopen bij het versturen van Uw nieuw wachtwoord.'));
						$this->render('recoverPasswordSuccess', array(
								'username' => $user->name,
								'email' => $user->mail,
						));
						return;
					}
					else if($model->secra!='')
					{
						$model->addError('secra', Yii::t('error', 'Verkeerd antwoord.'));
					}
				}
				$model->secrq=$user->secrq;
				$model->name=$user->name;
				$this->render('recoverPassword_1',array(
						'model'=>$model,
				));
			}
			else
			{
				$model->addError('name', Yii::t('error', 'Ongeldige gebruikersnaam.'));
				$this->render('recoverPassword',array(
						'model'=>$model,
				));
			}
		}
		else
		{
			$this->render('recoverPassword',array(
					'model'=>$model,
			));
		}
	}
	
	/**
	 * Generate tabs for the dashboard based on the signed in user's roles
	 */
	public function generateDashboardTabs() {
		$tabs=array(
				array(
						'active'=>true,
						'label'=>Yii::t('messages', 'dashboard.account'),
						'content'=>$this->renderPartial('dashboard_account', array(), true),
				),
				array(
						'active'=>false,
						'label'=>Yii::t('messages', 'dashboard.changePassword'),
						'content'=>$this->renderPartial('dashboard_change_password', array(), true),
				),
		);
	
		if(Yii::app()->user->checkAccess('managePages'))
		{
			$tabs[]=array(
					'active'=>false,
					'label'=>Yii::t('messages', 'dashboard.pages'),
					'content'=>$this->renderPartial('dashboard_pages', array(), true),
			);
		}
	
		if(Yii::app()->user->checkAccess('manageItems'))
		{
			$tabs[]=array(
					'active'=>false,
					'label'=>Yii::t('messages', 'dashboard.items'),
					'content'=>$this->renderPartial('dashboard_items', array(), true),
			);
		}
		
		if(Yii::app()->user->checkAccess('Admins'))
		{
			$tabs[]=array(
					'active'=>false,
					'label'=>Yii::t('messages','dashboard.admin'),
					'content'=>$this->renderPartial('dashboard_admin', array(), true),
			);
		}
		return $tabs;
	}
	
	/**
	 * Personalised dashboard
	 */
	public function actionDashboard()
	{	
		Yii::app()->clientScript->registerScript('tagging',"$(document).ready(function() {
		    location.hash && $('a[href=\"' + location.hash + '\"]').tab('show');
		    $('a[data-toggle=\"tab\"]').on('shown', function(e) {
		      location.hash = $(e.target).attr('href').substr(1);
				$('html, body').animate({ scrollTop: 0 }, 0);
		    });
		});");
		$this->render('dashboard',array(
				'tabs' => $this->generateDashboardTabs(),
		));
	}
	
	/**
	 * A full AJAX form calls this action to change the user's password
	 */
	public function actionChangePassword(){
        $id=Yii::app()->user->id;
		$model=new User('ChangePassword');
		
		$this->performAjaxValidation($model);
		
		$cpwd=$this->beginWidget('ChangePassword', array(
			'id'=>'cpwd-wdgt'
			));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$user=User::model()->findByPk($id);
			if($user!=NULL && $model->encode($model->pwd)==$user->pwd)
			{
				$user->pwd=$model->encode($model->newPwd);
				$user->save(false);
				Yii::app()->user->setFlash('successChangePassword',Yii::t('messages', 'form.changePassword.success'));
			}
			else
			{
				$cpwd->getModel()->addErrors($model->getErrors());
				if($model->pwd!=$user->pwd)//no encoding anymore because pwd is already encoded now
				{
					$cpwd->getModel()->addError('pwd', Yii::t('messages', 'form.changePassword.wrongCurrentPassword'));
				}
			}
		}
		$this->endWidget('ChangePassword', array(
			'id'=>'cpwd-wdgt'
			));

    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='cpwd-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
