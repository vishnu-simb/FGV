<?php
// set default google charts API
$clientScript = Yii::app()->clientScript;
$resourceUrl = $clientScript->staticUrl.'/flatapp';
Yii::app()->clientScript->registerScript('index',"
    // Some global params
    var dot = 1;
    var loading = 0;
	/* define base url */
	var siteUrl = document.location.origin + '/';
	var graphYear = new Date('01 January,'+$('#graphYear').html());
    
	$('.search-button').click(function(e){
	    e.preventDefault();
		var location_id = $('#Location_id').val();
		if(location_id)
        {
            $('.report-results').show();
    		$('#yw0').html('');
            loading = 1;
    		drawTrapCheckChart();
    		drawMiteMonitoringChart();
        }
        else
        {
            $('.report-results').hide();
        }
	});
    /*
	 * year select graphs
	 */
	$('.fc-button-prev').click(function(){
		graphYear.setYear(graphYear.getFullYear() -1);
		$('#graphYear').html(graphYear.getFullYear());
		$('#yw0').html('');
        loading = 1;
		drawTrapCheckChart();
		drawMiteMonitoringChart();
	});
	$('.fc-button-next').click(function(){
		var cur = new Date();
		if(graphYear.getFullYear() <= cur.getFullYear()-1){
			var next = graphYear.setYear(graphYear.getFullYear() +1);
			$('#graphYear').html(graphYear.getFullYear());
			$('#yw0').html('');
            loading = 1;
    		drawTrapCheckChart();
    		drawMiteMonitoringChart();
		}
	});
    
	function drawTrapCheckChart(){
		var location_id = $('#Location_id').val();
        if (typeof location_id == 'undefined' || !location_id)
        {
            return;
        }
        
		$.ajax({
		  type: 'POST',
		  url: siteUrl + 'api/graph/getLocationTrap',
          data: {location: location_id, year: graphYear.getFullYear()},
		  success: function (data)
		   {
		  		var jgraph = JSON.parse(data);
		  		if(jgraph.chart == false){
		  			$('#yw0').html('');
		  		}else{
		  		    for(var i in jgraph.series){
                        jgraph.series[i]['pointStart'] = Date.UTC(jgraph.pointStart.year, jgraph.pointStart.month, jgraph.pointStart.day);
                    }
                    delete jgraph.pointStart;
		  			Highcharts.setOptions([]); 
			  		var chart = new Highcharts.Chart(jgraph);
		  		}
		   }
		});
	}
    
	function drawMiteMonitoringChart(){
		var location_id = $('#Location_id').val();
        if (typeof location_id == 'undefined' || !location_id)
        {
            return;
        }
		$.ajax({
			  type: 'POST',
			  url: siteUrl + 'api/graph/getLocationMite',
              data: {location: location_id, year: graphYear.getFullYear()},
			  success: function (data)
			   {
				  		var jgraph = JSON.parse(data);
                        for(var i in jgraph.series){
                            jgraph.series[i]['pointStart'] = Date.UTC(jgraph.pointStart.year, jgraph.pointStart.month, jgraph.pointStart.day);
                        }
                        delete jgraph.pointStart;
                        Highcharts.setOptions([]); 
					  	var chart = new Highcharts.Chart(jgraph);
                        loading = 0;
			   }
		});
	}
    
    function createDateObj(isoDate, day){
        var d_parts = isoDate.split('-');
        if (d_parts.length != 3)
            return '';
        if (typeof day == 'undefined')
            day = 0; 
        var r_date = new Date(d_parts[0], d_parts[1] - 1, d_parts[2]);
        r_date.setTime(r_date.getTime() + (day*24*60*60*1000));
        return r_date;
    }
    
    function getAUDateStr(isoDate, day)
    {
        var d = createDateObj(isoDate, day);
        return d.toLocaleDateString('en-GB');
    }
    
    function drawSeasonGraphLoading(){
        if (loading){
            dot++;
            if (dot > 4)
                dot = 1;
            var dots = '';
            for(var i = 0; i < dot; i++)
                dots += '.';
            $('#yw1').html('<h4 style=\"text-align:center;\">Loading'+dots+'</h4>');
        }
        setTimeout(function(){drawSeasonGraphLoading();}, 800);
    }
    
    $('#yw0').html('');
	drawTrapCheckChart();
	drawMiteMonitoringChart();
    drawSeasonGraphLoading();
");
?>
<div class="row-fluid">
    <?php $this->renderPartial('_form',array('modelLocation' => $modelLocation)); ?>
</div>
<div class="row-fluid report-results" style="display: none;">
	<div class="span12">
		<div class="box month-graphs">
			<div class="box-content nopadding">
				<div class="calendar fc">
					<table style="width:100%" class="fc-header">
					<tbody><tr><td class="fc-header-left">
					</td><td class="fc-header-center">
					<span class="fc-button fc-button-prev fc-state-default fc-corner-left fc-corner-right">
					<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-left"></i></span></span></span>
					<span class="fc-header-title"><h2><span id="graphYear"><?=date('Y')?></span></h2></span>
					<span class="fc-button fc-button-next fc-state-default fc-corner-left fc-corner-right">
					<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-right"></i></span></span></span></td><td class="fc-header-right"></td></tr></tbody></table>
				</div>
			</div>
			<div id="graph" class="trapchecking-graph">
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
		<div class="box month-graphs">
			<div class="box-title"></div>
			<div id="graph" class="mitemonitoring-graph">
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
       <input type="hidden" id="user_id" value="<?=Yii::app()->user->id?>" />
    </div>
</div>