<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/30/14
 * Time: 1:49 PM
 *
 * render main message for the layout
 */
Yii::app()->clientScript->registerScript(
    'scroll',"
		$.fn.hasOverflow=function(){var e=this[0];return e.scrollHeight>e.clientHeight||e.scrollWidth>e.clientWidth;}
    		
    	jQuery(document).ready(function() {

    		if(jQuery('.dataTables_wrapper').hasOverflow()){
    			jQuery('#scroll_to_right').removeClass('hidden');
			}else{
    			jQuery('#scroll_to_right').addClass('hidden');
			}
			jQuery('.left-arrow').click(function () {
			  var leftPos = $('.dataTables_wrapper').scrollLeft();
			  jQuery('.dataTables_wrapper').animate({scrollLeft: leftPos - 1200}, 800);
    		  jQuery(this).addClass('hidden');
    		  jQuery('.right-arrow').removeClass('hidden');
			});
			 
			jQuery('.right-arrow').click(function () {
			  var leftPos = $('.dataTables_wrapper').scrollLeft();
			  jQuery('.dataTables_wrapper').animate({scrollLeft: leftPos + 1200}, 800);
    		  jQuery(this).addClass('hidden');
    		  jQuery('.left-arrow').removeClass('hidden');
			});
            });
    		
    		"
);
?>
<div id="scroll_to_right">
     <button class="btn btn-blue left-arrow hidden"><i class="glyphicon-chevron-left"></i></button>
     <button class="btn btn-blue right-arrow"><i class="glyphicon-chevron-right"></i></button>
</div>


