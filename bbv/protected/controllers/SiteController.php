<?php

class SiteController extends Controller
{
	private $_authManager;
	
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
			'index'=>'application.controllers.site.IndexAction',
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	/**
	 * Method for generating the authentication rules with the AuthManager
	 * Only call this when changes were made to the roles
	 * TODO: disable on deploy
	 */
	protected function generateAuthRules()
	{
		/*$this->_authManager=Yii::app()->authManager;
		$this->_authManager->clearAll();
	
		$this->_authManager->createOperation("createUser","create a new user");
		$this->_authManager->createOperation("readUser","read user profile information");
		$this->_authManager->createOperation("updateUser","update a users information");
		$this->_authManager->createOperation("deleteUser","delete user");
		$this->_authManager->createOperation("registerUser","let a guest register himself");
		$this->_authManager->createOperation("dashboardUser","allow access to the user dashboard");
		
		$this->_authManager->createOperation("manageItems","manage the various items");
		$this->_authManager->createOperation("manageNews","manage the news");
		$this->_authManager->createOperation("manageText","manage the text items");
		$this->_authManager->createOperation("managePages","manage the various pages");
		$this->_authManager->createOperation("deleteComment","delete comments from other users");
	
		// non-authenticated users
		$bizRule='return Yii::app()->user->isGuest;';
		$role=$this->_authManager->createRole("guest", "guest user", $bizRule);
		$role->addChild("readUser");
		$role->addChild("registerUser");
	
		// authenticated users
		$bizRule='return !Yii::app()->user->isGuest;';
		$role=$this->_authManager->createRole("registered", "authenticated user", $bizRule);
		$role->addChild("readUser");
		$role->addChild("dashboardUser");
		
		// admins
		$role=$this->_authManager->createRole("admin", "administrator");
		$role->addChild("registered");
		$role->addChild("createUser");
		$role->addChild("updateUser");
		$role->addChild("deleteUser");
		$role->addChild("manageItems");
		$role->addChild("manageNews");
		$role->addChild("manageText");
		$role->addChild("managePages");
		$role->addChild("deleteComment");
	
		// assign basic roles
		$this->_authManager->assign('admin',3);*/
	
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * Install the website
	 */
	public function actionInstall() {
		$this->layout = '';
		$step = 0;
		if(!defined('INSTALLED')) {
			$step = 1;// Add lots of check if installed & requirements...
			if(isset($_GET['step']) && $_GET['step']==2)
				Install::install();
		}
		$this->render('install_'.$step,array());
	}
}