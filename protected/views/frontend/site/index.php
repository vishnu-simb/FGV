<?php
// set default google charts API
$clientScript = Yii::app()->clientScript;
$resourceUrl = $clientScript->staticUrl.'/flatapp';
Yii::app()->clientScript->registerScript('index',"
    // Some global params
    var dot = 1;
    var loading = 0;
    var spray_date_color = '#9cd079';
    var spray_date_label_color = '#333333';
	/* define base url */
	var siteUrl = document.URL; 
	var months = new Array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	var reportYear = new Date('01 January,'+$('#yearPicker').html()); // convert to actual date
    var actualDate = new Date();
	loadBlock(); // load default block by grower
	//loadSprayTable();
	/* load current graph block */
	//drawTrapCheckChart() 
	//drawMiteMonitoringChart();
	/* handle report by GrowerID */
	$('.clickable').change(function(){ 
		var url = 'report/grower/'+$(this).val()+'/'+$('#yearPicker').html();
		if(url.length){
		window.open(url,'_blank');
		$('.clickable').removeAttr('selected').val('').eq(1).attr('selected','selected');
		}
	});
	$('.blockable').change(function(){
		var t = $('#Block_id').find('option[value=\"'+$('#Block_id').val()+'\"]');
		var g = $('#Grower_id').find('option[value=\"'+$('#Grower_id').val()+'\"]');
		if(typeof g.html() != 'undefined')
		$('h1').html(g.html()+': '+t.html());
		$('#yw0').html('');
		drawTrapCheckChart();
		loadSprayTable();
		drawMiteMonitoringChart();
	});
	$('.growerable').change(function(){
		var t = $(this).find('option[value=\"'+$(this).val()+'\"]');
		if(typeof t.parent().attr('label') != 'undefined')
		$('h1').html(t.parent().attr('label')+': '+t.html());
		$('#yw0').html('');
		drawTrapCheckChart();
		loadSprayTable();
		drawMiteMonitoringChart();
	});
	/*
	 * season selected on dashboard
	 */
	$('.fc-button-prev').click(function(){
	    var season = $('#season').html();
        if (season.indexOf('Early') != -1){
            $('#season').html('Late, March to July '+actualDate.getFullYear());
        }else if(season.indexOf('Mid') != -1){
            actualDate.setFullYear(actualDate.getFullYear() - 1);
            $('#season').html('Early, August to November '+actualDate.getFullYear());
        }else if(season.indexOf('Late') != -1){
            var pre_year = parseInt(actualDate.getFullYear())-1;
            $('#season').html('Mid, December '+ pre_year +' to February '+actualDate.getFullYear());
        }
		$('#yw0').html('');
        loading = 1;
		drawTrapCheckChart();
		drawMiteMonitoringChart();
	});
	$('.fc-button-next').click(function(){
	    var season = $('#season').html();
        if (season.indexOf('Early') != -1){
            var pre_year = actualDate.getFullYear();
            actualDate.setFullYear(pre_year + 1);
            $('#season').html('Mid, December '+ pre_year +' to February '+actualDate.getFullYear());
        }else if(season.indexOf('Mid') != -1){
            $('#season').html('Late, March to July '+actualDate.getFullYear());
        }else if(season.indexOf('Late') != -1){
            $('#season').html('Early, August to November '+actualDate.getFullYear());
        }
		$('#yw0').html('');
        loading = 1;
		drawTrapCheckChart();
		drawMiteMonitoringChart();
	});
	/*
	 * year select reports
	 */
	$('.yr-button-prev').click(function(){
		var prev = reportYear.setYear(reportYear.getFullYear() -1);
		$('#yearPicker').html(reportYear.getFullYear());
		loadSprayTable();
	});
	$('.yr-button-next').click(function(){
		var cur = new Date();
		if(reportYear.getFullYear() <= cur.getFullYear()-1){
			var next = reportYear.setYear(reportYear.getFullYear() +1);
			$('#yearPicker').html(reportYear.getFullYear());
			loadSprayTable();
		}
	});
	function loadBlock(){
	    loading = 1;
		$.ajax({
					  type : 'POST',
					  url : siteUrl +'api/web/block',
					  update : '#Block_id',
					  data : {grower_id:$('#Grower_id').val()},
					  success : function(data) {
									$('#Block_id').empty();
									$('#Block_id').append(data);
									$('#Block_id').trigger('liszt:updated');
                                    loadSprayTable();
                                    drawTrapCheckChart();
                                    drawMiteMonitoringChart();
						}
		});
	}
	function drawTrapCheckChart(){
		var block_id = $('#Block_id').val();
        if (typeof block_id == 'undefined' || !block_id)
        {
            $('.month-graphs').hide();
            return;
        }
        $('.month-graphs').show();
        var season = $('#season').html().split(',');
		$.ajax({
				  type: 'GET',
				  url: siteUrl + 'api/graph/getBlockTrap?block='+block_id+'&season='+season[0]+'&year='+actualDate.getFullYear(),
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
                                if (jgraph.spraydates.length){
                                    jgraph.xAxis['plotBands'] = [];
                                    for(var j in jgraph.spraydates){
                                        var date = jgraph.spraydates[j].date;
                                        var plot_obj = {
                                            from: createDateObj(date),
                                            to: createDateObj(date, 1),
                                            color: spray_date_color,
                                            label: {
                                                text: jgraph.spraydates[j].chemical,
                                                'style': {
                                                    color: spray_date_label_color
                                                }
                                            }
                                        };
                                        jgraph.xAxis['plotBands'].push(plot_obj);
                                    }
                                    delete jgraph.spraydates;
                                }
					  			Highcharts.setOptions([]); 
						  		var chart = new Highcharts.Chart(jgraph);
					  		}
				   }
		});
	}
	function drawMiteMonitoringChart(){
		var block_id = $('#Block_id').val();
        if (typeof block_id == 'undefined' || !block_id)
        {
            $('.month-graphs').hide();
            return;
        }
        $('.month-graphs').show();
        var season = $('#season').html().split(',');
		$.ajax({
				  type: 'GET',
				  url: siteUrl + 'api/graph/getBlockMite?block='+block_id+'&season='+season[0]+'&year='+actualDate.getFullYear(),
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
	function loadSprayTable(){
		var block_id = $('#Block_id').val();
        if (typeof block_id == 'undefined' || !block_id)
        {
            $('.spraytable').html('<h4 style=\"text-align:center;\">Please select a block</h4>');
            $('.month-graphs').hide();
            return;
        }
		$.ajax({
				  type: 'GET',
				  url: siteUrl + 'api/graph/HTML?block='+block_id+'&year='+$('#yearPicker').html(),
				  success: function (data)
				   {
					  $('.spraytable').html(data);
                      setColumnsWidth();
				   }
		});
	}
    
    function setColumnsWidth(){
        if ($('body').hasClass('csite-aindex')){
            var number_of_col = $('.spraytable .th:first > span').length + $('.spraytable .th:first > span.doublewidth').length;
            if (number_of_col)
            {
                var col_width = 100.0/number_of_col;
                $('.spraytable .th > span').css('width', col_width + '%');
                $('.spraytable .th > span.doublewidth').attr('style', 'width: '+col_width*2+'% !important');
            }
        }
    }
    
    function createDateObj(isoDate, day){
        var d_parts = isoDate.split('-');
        if (d_parts.length != 3)
            return '';
        if (typeof day == 'undefined')
            day = 0; 
        var r_date = new Date(d_parts[0], d_parts[1] - 1, d_parts[2]);
        return r_date.setTime(r_date.getTime() + (day*24*60*60*1000));
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
    drawSeasonGraphLoading();
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
</div>
<div class="row-fluid report-results">
	<div class="span12">
		<div class="box">
			<div class="box-title">
			<h3><i class="icon-reorder"></i>Spray Dates</h3></div>
			<div class="spraytable box-content nopadding"></div>
		</div>
		<div class="box month-graphs">
			<div class="box-title">
				<h3><i class="icon-calendar"></i>Season Graph</h3>
			</div>
			<div class="box-content nopadding">
				<div class="calendar fc">
					<table style="width:100%" class="fc-header">
					<tbody><tr><td class="fc-header-left">
					</td><td class="fc-header-center">
					<span class="fc-button fc-button-prev fc-state-default fc-corner-left fc-corner-right">
					<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-left"></i></span></span></span>
					<?php
                        $month = date('n');
                        $year = date('Y');
                        $season = "Early, August to November $year";
                        if (in_array($month, array(12, 1, 2)))
                            $season = "Mid, December ". ($year-1). "to February $year";
                        else if(in_array($month, array(3, 4, 5, 6, 7)))
                            $season = "Late, March to June $year";
                            
                    ?>
                    <span class="fc-header-title"><h2><span id="season"><?=$season?></span></h2></span>
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
    </div>
</div>