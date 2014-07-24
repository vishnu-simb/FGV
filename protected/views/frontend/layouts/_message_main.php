<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/30/14
 * Time: 1:49 PM
 *
 * render main message for the layout
 */
Yii::app()->clientScript->registerScript(
    'hideMessage',
    <<<JS_SCRIPT
        setTimeout(function(){
            $('#ron-message-main').animate({opacity: 1.0}, 3000).fadeOut("slow");
        }, 3000);
JS_SCRIPT
    ,
    CClientScript::POS_READY
);
?>
<div id="ron-message-main">
    <?php
    $strMessage = '';
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        $strMessage .= $message ? '<div class="alert alert-' . $key . '">' . '<button type="button" class="close" data-dismiss="alert">×</button>' . $message . '</div>' : '';
        Yii::app()->user->setFlash($key, '');
    }
    echo $strMessage ? '<div id="main-message" class="alert-message">' . $strMessage . '</div>' : '';
    ?>
</div>