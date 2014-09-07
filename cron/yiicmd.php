<?php 
// change the following paths if necessary
// Path of the framework on this machine

// include environment file, should be changed for each particular app
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'environment.php');

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

// Path of the framework on this machine
defined('YII_FW_PATH') or define('YII_FW_PATH', dirname(
        __FILE__
    ) . DS . '..' . DS . '..' . DS . 'yii' . DS . 'framework' . DS . 'yii.php');

defined('YII_CONSOLE') or define('YII_CONSOLE', dirname(
		__FILE__
	) . DS . '..' . DS . 'protected' . DS . 'configs' . DS . 'console' . DS . 'main.php');


// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
require_once(YII_FW_PATH);
Yii::createConsoleApplication(YII_CONSOLE)->run();