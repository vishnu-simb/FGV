<?php
?>

<div class="row-fluid">
    <div class="span12">
        <div class="box">

            <?php $this->renderPartial('_form',array(
                	'modelBlock' => $modelBlock,
            		'modelGrower'=> $modelGrower,
 )); ?>

        </div>
    </div>
    	<div class="row-fluid">
					<div class="span8">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-calendar"></i>Month Graph</h3>
							</div>
							<div class="box-content nopadding">
							<div class="calendar fc">
								<table style="width:100%" class="fc-header">
								<tbody><tr><td class="fc-header-left">
								</td><td class="fc-header-center">
								<span class="fc-button fc-button-prev fc-state-default fc-corner-left fc-corner-right">
								<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-left"></i></span></span></span>
								<span class="fc-header-title"><h2><span id="datePicker"><?=date('F')?>,<?=date('Y')?></span></h2></span>
								<span class="fc-button fc-button-next fc-state-default fc-corner-left fc-corner-right">
								<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-right"></i></span></span></span></td><td class="fc-header-right"></td></tr></tbody></table>
							</div>
							</div>
						</div>
	</div>
</div>