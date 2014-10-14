<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/19/14
 * Time: 11:39 AM
 *
 * login template file
 */

/* @var $this SimbController */
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

        <title><?= $this->pageTitle ?></title>

        <?php
        // Register CSS
        $bootstrap->registerCoreCss();
        $bootstrap->registerResponsiveCss();
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/icheck/all.css');
        $clientScript->registerCssFile($resourceUrl . '/css/style.css');
        $clientScript->registerCssFile($resourceUrl . '/css/themes.css');

        // Css of the theme
        $clientScript->registerCssFile($themeUrl . '/css/custom.css');

        // Register JS
        $clientScript->registerCoreScript('jquery');
        $bootstrap->registerCoreScripts(null, CClientScript::POS_HEAD);
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/nicescroll/jquery.nicescroll.min.js');
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/icheck/jquery.icheck.min.js');
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/validation/jquery.validate.min.js');
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/validation/additional-methods.min.js');

        $clientScript->registerScriptFile($resourceUrl . '/js/eakroko.js');

        ?>

        <!--[if lte IE 9]>
        <script src="<?= $resourceUrl ?>/js/plugins/placeholder/jquery.placeholder.min.js"></script>
        <script>
            $(document).ready(function () {
                $('input, textarea').placeholder();
            });
        </script>
        <![endif]-->


        <!-- Favicon -->
        <link rel="shortcut icon" href="<?= $resourceUrl ?>/img/favicon.png"/>
        <!-- Apple devices Homescreen icon -->
        <link rel="apple-touch-icon-precomposed" href="<?= $resourceUrl ?>/img/apple-touch-icon-precomposed.png"/>

    </head>

    <body class='<?php echo $this->getBodyClass('login') ?>'>
    <?php $this->renderPartial('//layouts/_message_main') ?>
        <div class="wrapper">
            <?= $content ?>
        </div>
    </body>

</html>