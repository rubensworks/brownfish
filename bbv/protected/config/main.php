<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under protected/extensions.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// Require the credentials file
define( 'CREDENTIALS_PATH', dirname(__FILE__) . "/credentials.php" ); // cache it for multiple use
require_once(CREDENTIALS_PATH);

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Bredense Bruinvissen',
	'language'=>'nl',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.wform.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
                'bootstrap.gii',
            ),
		),
		*/	
		'rbam'=>array(
			'applicationLayout'=>'webroot.themes.bootstrap.views.layouts.main',
			//'initialise'=>true,
			'userNameAttribute'=>'name',
			'juiTheme'=>'bootstrap',
		),
	),
		
	'theme'=>'bootstrap',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
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
			'enableProfiling'=>true,
		),
		'authManager'=>array(
				'class'=>'CDbAuthManager', // Database driven Yii-Auth Manager
				'connectionID'=>'db', // db connection as above
				'defaultRoles'=>array('registered','guest'), // default Role for logged in users
				'showErrors'=>true, // show eval()-errors in buisnessRules
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				/*array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),*/
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
					//'levels'=>'error, warning',
				),
				
			),
		),
		'bootstrap'=>array(
				'class'=>'bootstrap.components.Bootstrap',
		),
		'cache'=>array(
				'class'=>'system.caching.CFileCache',// Use another caching system for better performance
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		//'googleAnalyticsTrackingID'=>'[Enter tracking ID to enable]',
	),
);