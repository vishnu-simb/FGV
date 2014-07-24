<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/18/14
 * Time: 11:16 AM
 *
 * Environment constant for the app
 */

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

// Level of error for PHP
error_reporting(E_ALL); // Show all errors of the app
ini_set('display_errors', 'On');

// Path of the framework on this machine
defined('YII_FW_PATH') or define('YII_FW_PATH', dirname(
        __FILE__
    ) . DS . '..' .DS. 'yii' . DS . 'framework' . DS . 'yii.php');

// Path of the framework )console on this machine
defined('YII_FWC_PATH') or define('YII_FWC_PATH', dirname(
        __FILE__
    ) . DS . '..' . DS . 'yii' . DS . 'framework' . DS . 'yiic.php');

// Environment name
defined('YII_ENV') or define('YII_ENV', 'dev');

// Using Yii debug mode or not
defined('YII_DEBUG') or define('YII_DEBUG', true);

// In case debug mode is on, we define the level of the tracing process
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 7);

