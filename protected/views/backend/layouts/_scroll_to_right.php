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
            $('#scroll_to_right').animate({opacity: 1.0}, 3000).fadeOut("slow");
        }, 3000);
JS_SCRIPT
    ,
    CClientScript::POS_READY
);
?>
<div id="scroll_to_right">
 	<button class="btn btn-blue hidden"><i class="glyphicon-chevron-left"></i></button>
    <button class="btn btn-blue"><i class="glyphicon-chevron-right"></i></button>
</div>
