<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/20/14
 * Time: 11:57 AM
 *
 * main layout for the backend
 */

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
        // Register CSS
        $bootstrap->registerCoreCss();
        $bootstrap->registerResponsiveCss(null, '');

        // Jquery UI smoothness theme
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/jquery-ui/smoothness/jquery-ui.css');
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css');

        // PageGuide
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/pageguide/pageguide.css');

        // Fullcalendar
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/fullcalendar/fullcalendar.css');
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/fullcalendar/fullcalendar.print.css', 'print');

        // Tagsinput
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/tagsinput/jquery.tagsinput.css');

        // Chosen
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/chosen/chosen.css');

        // Multi-select
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/multiselect/multi-select.css');

        // Time-picker
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/timepicker/bootstrap-timepicker.min.css', 'screen');

        // Color-picker
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/colorpicker/colorpicker.css');

        // Date-picker
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/datepicker/datepicker.css');

        // Date range picker
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/daterangepicker/daterangepicker.css', 'all');

        // Plipload
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/plupload/jquery.plupload.queue.css');

        // Select2
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/select2/select2.css');

        // icheck
        // Trick: should not be combined to avoid errors
        $clientScript->registerCssFile($resourceUrl . '/css/plugins/icheck/all.css', '', true);

        // theme
        $clientScript->registerCssFile($resourceUrl . '/css/style.css');
        $clientScript->registerCssFile($resourceUrl . '/css/themes.css');

        // Css of the theme
        $clientScript->registerCssFile($themeUrl . '/css/custom.css');

        // Register JS
        // Jquery
        $clientScript->registerCoreScript('jquery');

        // JQuery UI
        $clientScript->registerCoreScript('jquery.ui');

        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/ckeditor/ckeditor.js', null, array(), true);

        // Bootstrap
        // Trick: should not be combined to avoid errors
        $bootstrap->registerCoreScripts(null, CClientScript::POS_HEAD, true);

        // Nicescroll
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/nicescroll/jquery.nicescroll.min.js');

        // Images Loaded
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/imagesLoaded/jquery.imagesloaded.min.js');

        // Bootbox
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/bootbox/jquery.bootbox.js');

        // Masked Input
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/maskedinput/jquery.maskedinput.min.js');

        // Tags Input
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/tagsinput/jquery.tagsinput.min.js');

        // Bootstrap - Date-picker
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/datepicker/bootstrap-datepicker.js');

        // Bootstrap - Daterange-picker
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/daterangepicker/daterangepicker.js');
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/daterangepicker/moment.min.js');

        // Bootstrap - Time-picker
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/timepicker/bootstrap-timepicker.min.js');

        // Bootstrap - Color-picker
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/colorpicker/bootstrap-colorpicker.js');

        // Chosen
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/chosen/chosen.jquery.min.js');

        // Multi-select
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/multiselect/jquery.multi-select.js');

        // PlUpload
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/plupload/plupload.full.js');
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/plupload/jquery.plupload.queue.js');

        // Bootstrap - Custom file upload
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/fileupload/bootstrap-fileupload.min.js');
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/mockjax/jquery.mockjax.js');

        // Select2
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/select2/select2.min.js');

        // icheck
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/icheck/jquery.icheck.min.js');

        // complexify
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/complexify/jquery.complexify-banlist.min.js');
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/complexify/jquery.complexify.min.js');

        // validation
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/validation/jquery.validate.min.js');
        $clientScript->registerScriptFile($resourceUrl . '/js/plugins/validation/additional-methods.min.js');

        // theme framework
        $clientScript->registerScriptFile($resourceUrl . '/js/eakroko.js');
        $clientScript->registerScriptFile($resourceUrl . '/js/application.min.js');

        ?>

        <!--[if lte IE 9]>
        <script src="<?php echo $resourceUrl ?>/js/plugins/placeholder/jquery.placeholder.min.js"></script>
        <script>
            $(document).ready(function () {
                $('input, textarea').placeholder();
            });
        </script>
        <![endif]-->
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo $resourceUrl ?>/img/favicon.png"/>
        <!-- Apple devices Homescreen icon -->
        <link rel="apple-touch-icon-precomposed" href="<?php echo $resourceUrl ?>/img/apple-touch-icon-precomposed.png"/>

    </head>

    <body class="<?php echo $this->bodyClass ?>">

       

        <div class="container-fluid" id="content">

            <?php echo $this->renderPartial('//layouts/_main_primary_navigation') ?>

            <?php echo $this->renderPartial('//layouts/_main_left') ?>

            <div id="main">
                <div class="container-fluid">
               
                    <div class="page-header">
                        <div class="pull-left">
                            <h1><?php echo $this->pageTitle ?></h1>
                        </div>

                    </div>
					 <?php $this->renderPartial('//layouts/_message_main') ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                        ));

                    ?>
                    <?php echo $content ?>
                </div>
            </div>
        </div>
	 
    </body>
</html>
 