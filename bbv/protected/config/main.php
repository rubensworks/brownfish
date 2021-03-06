<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under protected/extensions.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// Require the credentials file
define('CREDENTIALS_PATH', dirname(__FILE__) . "/config.php");
require_once(CREDENTIALS_PATH);

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Brownfish',
	'language'=>'en',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.brownfish.controllers.*',
		'ext.wform.*',
		'ext.easyimage.EasyImage',
	),

	'modules'=>array(
		'rbam'=>array(
			'applicationLayout'=>'webroot.themes.default.views.layouts.main',
			//'initialise'=>true,
			'userNameAttribute'=>'name',
		),
	),
		
	'theme'=>'default',

	// application components
	'components'=>array(	
		'user'=>array(
			'allowAutoLogin'=>true,
		),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host='.DB_HOST.';dbname='.DB_NAME,
			'emulatePrepare' => true,
			'username' => DB_USERNAME,
			'password' => DB_PASSWORD,
			'charset' => 'utf8',
			//'schemaCachingDuration'=>86400,   //TODO: Enable
			'enableProfiling'=>YII_DEBUG,
			'tablePrefix' => TBL_PREFIX,
		),
		'authManager'=>array(
				'class'=>'CDbAuthManager', // Database driven Yii-Auth Manager
				'connectionID'=>'db', // db connection as above
				'defaultRoles'=>array('authenticated','guest'), // default Role for logged in users
				'showErrors'=>YII_DEBUG, // show eval()-errors in buisnessRules
				// Custom table names
				'itemTable'=>'{{auth_item}}',
				'assignmentTable'=>'{{auth_assignment}}',
				'itemChildTable'=>'{{auth_item_child}}',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
					'enabled'=>YII_DEBUG,
				),
				
			),
		),
		'bootstrap'=>array(
				'class'=>'bootstrap.components.Bootstrap',
		),
		'cache'=>array(
				'class'=>'system.caching.CDummyCache',// Use another caching system for better performance
		),
		'easyImage' => array(
				'class' => 'application.extensions.easyimage.EasyImage',
				'driver' => 'GD',
				'quality' => 100,
				'cachePath' => '/assets/easyimage/',
				'cacheTime' => 2592000,
				'retinaSupport' => true,
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		//'googleAnalyticsTrackingID'=>'[Enter tracking ID to enable]',
		'dateFormat'=>'yyyy-mm-dd', // Used by date validator
		'dateFormatPicker'=>'yy-mm-dd', // Used by CJuiDatePicker
		'dateFormatCore'=>'Y-m-d', // Used by php date() formatter
	),
);