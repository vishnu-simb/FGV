<?php
// include environment file, should be changed for each particular app
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'environment.php');

// change the following paths if necessary
$config = dirname(__FILE__) . DS . "configs" . DS . 'console' . DS . "main.php";

require_once(YII_FWC_PATH);