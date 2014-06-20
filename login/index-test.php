<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$pwd = dirname(__FILE__);
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/test.php';
$yii=$pwd.'/../framework/yii.php';

require_once $pwd.'/protected/function.common.php';
// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
//require_once $pwd.'/protected/function.common.php';
require_once($yii);
Yii::createWebApplication($config)->run();


