<?php
// set default google charts API
$clientScript = Yii::app()->clientScript;
$resourceUrl = $clientScript->staticUrl.'/flatapp';

Yii::app()->clientScript->registerScript('index',"
		
	/* define base url */
		
	var siteUrl = document.URL; 
	var _date = $('#datePicker').html();
	var months = new Array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	var actualDate = new Date('01 '+_date); // convert to actual date
	
	loadSprayTable();
		
	/* load current graph block */
		
	drawTrapCheckChart() 
	drawMiteMonitoringChart();
	
	/* handle report by GrowerID */
		
	$('.clickable').change(function(){ 
		var url = 'report/grower/'+$(this).val();
		if(url.length){
		window.open(url,'_blank');
		$('.clickable').removeAttr('selected').val('').eq(1).attr('selected','selected');
		}
	});
	
	$('#Block_id').change(function(){
		var t = $(this).find('option[value=\"'+$(this).val()+'\"]');
		if(typeof t.parent().attr('label') != 'undefined')
		$('h1').html(t.parent().attr('label')+': '+t.html());
		$('#yw0').html('');
		drawTrapCheckChart();
		loadSprayTable();
		drawMiteMonitoringChart();
	});
	

	
	/*
	 * month selected on dashboard
	 */
	
	$('.fc-button-prev').click(function(){
		var prev = actualDate.setMonth(actualDate.getMonth() -1);
		$('#datePicker').html(months[actualDate.getMonth()]+','+actualDate.getFullYear());
		$('#yw0').html('');
		drawTrapCheckChart();
		drawMiteMonitoringChart();
	});
	$('.fc-button-next').click(function(){
		var next = actualDate.setMonth(actualDate.getMonth() +1);
		$('#datePicker').html(months[actualDate.getMonth()]+','+actualDate.getFullYear());
		$('#yw0').html('');
		drawTrapCheckChart();
		drawMiteMonitoringChart();
		
	});
	
	function drawTrapCheckChart(){
			var block_id = $('#Block_id').val();
			$.ajax({
					  type: 'GET',
					  url: siteUrl + 'api/graph/getBlockTrap?block='+block_id+'&date='+$('#datePicker').html(),
					  success: function (data)
					   {
						  		var jgraph = JSON.parse(data);
						  		if(jgraph.chart == false){
						  			$('#yw0').html('');
						  		}else{
						  			Highcharts.setOptions([]); 
							  		var chart = new Highcharts.Chart(jgraph);
						  		}
						  		
					   }
			});
	}
	
	function drawMiteMonitoringChart(){
		var block_id = $('#Block_id').val();
		$.ajax({
				  type: 'GET',
				  url: siteUrl + 'api/graph/getBlockMite?block='+block_id+'&date='+$('#datePicker').html(),
				  success: function (data)
				   {
					  		var jgraph = JSON.parse(data);
					  		Highcharts.setOptions([]); 
						  	var chart = new Highcharts.Chart(jgraph);
					  		
				   }
		});
	}
	
	
	function loadSprayTable(){
		var block_id = $('#Block_id').val();
		$.ajax({
				  type: 'GET',
				  url: siteUrl + 'api/graph/HTML?block='+block_id+'&date='+$('#datePicker').html(),
				  success: function (data)
				   {
					  $('.spraytable').html(data);
		
				   }
		});
	}
");
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
					<div class="span12">
						<div class="box">
						<div class="box-title">
						<h3><i class="icon-reorder"></i>Spray Dates</h3>	</div>
						<div class="spraytable box-content nopadding">
							
						</div>
					
						</div>
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
				<div id="graph">
				<?php
						$this->Widget('ext.highcharts.HighchartsWidget', array(
								'options'=>array(
										'title' => array('text' => ''),
										'xAxis' => array(
												'categories' => array()
										),
										'yAxis' => array(
												'title' => array('text' => '')
										),
										'series' => array(
												array(),
											)
								)
						));
					?>
					
				</div>
							
						</div>
						
						<div class="box">
							<div class="box-title">
								
							</div>

				<div id="graph">
				<?php
						$this->Widget('ext.highcharts.HighchartsWidget', array(
								'options'=>array(

										'title' => array('text' => ''),
										'xAxis' => array(
												'categories' => array()
										),
										'yAxis' => array(
												'title' => array('text' => '')
										),
										'series' => array(
												array(),
											)
								)
						));
					?>
					
				</div>
							
						</div>
	</div>
</div>