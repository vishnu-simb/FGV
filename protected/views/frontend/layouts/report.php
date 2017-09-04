<?php

/* @var $this CController */
/* @var $clientScript CClientScript */
/* @var $bootstrap TbApi */

$clientScript = Yii::app()->clientScript;
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
    </head>

    <body>
        <div class="report-content">
        <?php echo $content ?>
        </div>
    </body>
</html>
 