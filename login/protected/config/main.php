<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'点餐了',

	'language'=>'zh_cn',
	//'sourceLanguage'=>'en_us',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
//			'loginUrl'=>'',
//			'homeUrl'=>''
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>IS_PRODUCT ? "get" : 'path', 
//			'rules'=>array(
//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//			),
		),
		
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=user',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => IS_PRODUCT ? 'pkkilpiil' : '',
			'charset' => 'utf8',
		//	'schemaCachingDuration'=>3600,   //表结构缓存。。 不是数据缓存
			'tablePrefix' => 'tbl_',
			
		//	'schemaCachingExclude' => array(), //不需要缓存的表名数组
		//	'schemaCacheID' => 'cache', //使用的缓存组件
			//此外，CDbConnection中还有关于数据库查询的缓存配置，不过这里只是一个全局的配置
			//查询缓存配置
		//	'queryCachingDuration' => 3600,//缓存时间             数据库缓存，要配合下面的cache选项来配合,比如 CFileCache 文件缓存，也可以使用memcache来缓存
			'queryCachingDependency' => null, //缓存依赖
			'queryCachingCount' => 12, //第一次使用这条sql语句后同样的多少条sql语句需要缓存
			'queryCacheID' => 'cache', //使用的缓存组件
					
		),
		'cache' => array(
            'class' => 'CFileCache',
			
        ), 
//        'CURL' =>array(
//		   'class' => 'application.extensions.curl.Curl',
//		),
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
				array(//Yii::log('xxxx', 'info','pay');
					'class'=>'CFileLogRoute',
					'categories' => 'pay.*',
					'logFile'	=>	'pay',
					'levels'=>'error, warning,info',
				),
				// uncomment the following to show log messages on web pages
				//查看执行的mysql 语句
				array(
					'class'=>'CWebLogRoute',
					'levels' =>'warning',
	     			'categories' => 'system.db*', 
				),
/*
 * CDbLogRoute: 将信息保存到数据库的表中。
CEmailLogRoute: 发送信息到指定的 Email 地址。
CFileLogRoute: 保存信息到应用程序 runtime 目录中的一个文件中。
CWebLogRoute: 将 信息 显示在当前页面的底部。
CProfileLogRoute: 在页面的底部显示概述（profiling）信息。
 */
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);