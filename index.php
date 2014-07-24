<?php
/**
 * User: trac.nguyen
 * Date: 6/18/14
 * Time: 10:28 AM
 *
 * Bootstrap file for frontend
 */

// include environment file, should be changed for each particular app
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'environment.php');

// change the following paths if necessary
$config = dirname(__FILE__) . DS . "protected" . DS . "configs" . DS . 'frontend' . DS . "main.php";

require_once(YII_FW_PATH);
Yii::createWebApplication($config)->runEnd('frontend');
