<?php

// Require the credentials file
define('CREDENTIALS_PATH', dirname(__FILE__) . "/../config/config.php");
require_once(CREDENTIALS_PATH);

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'BrownFish Console App',
	
	// autoloading model and component classes
	'import'=>array(
			'ext.wform.*',
			'application.models.*',
			'application.components.*',
	),
		
	// application components
	'components'=>array(
			'db'=>array(
					'connectionString' => 'mysql:host='.DB_HOST.';dbname='.DB_NAME,
					'emulatePrepare' => true,
					'username' => DB_USERNAME,
					'password' => DB_PASSWORD,
					'charset' => 'utf8',
					'tablePrefix' => TBL_PREFIX,
			),
			'authManager'=>array(
					'class'=>'CDbAuthManager',
					'connectionID'=>'db', 
					'defaultRoles'=>array('authenticated','guest'),
					'showErrors'=>false,
					// Custom table names
					'itemTable'=>'{{auth_item}}',
					'assignmentTable'=>'{{auth_assignment}}',
					'itemChildTable'=>'{{auth_item_child}}',
			),
			'cache'=>array(
					'class'=>'system.caching.CDummyCache',
			),
	),
);