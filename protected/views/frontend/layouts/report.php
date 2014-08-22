<?php

/* @var $this CController */
/* @var $clientScript CClientScript */
/* @var $bootstrap TbApi */
$themeUrl = is_object(Yii::app()->theme) ? Yii::app()->theme->baseUrl : '';

$clientScript = Yii::app()->clientScript;
$resourceUrl = $clientScript->staticUrl.'/flatapp';
$bootstrap = Yii::app()->bootstrap;
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <!-- Apple devices fullscreen -->
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <!-- Apple devices fullscreen -->
        <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <title><?php echo $this->browserTitle ?></title>
        <?php 
            $clientScript->registerCssFile($resourceUrl . '/css/report.css');
            $clientScript->registerScriptFile($resourceUrl . '/js/jquery.min.js');
        ?>
    </head>

    <body>
        <?php echo $content ?>
    </body>
</html>
 