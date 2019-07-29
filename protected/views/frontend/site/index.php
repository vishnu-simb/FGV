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
    var today = new Date();
    var cur_year = parseInt(today.getFullYear());
    var cur_month = parseInt(today.getMonth()) + 1;
	/* define base url */
	var siteUrl = document.URL; 
	var months = new Array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	if (cur_month >= 8){
		var maxYear = reportYear = cur_year + 1;
	}else{
		var maxYear = reportYear = cur_year;
	}
    var graphYear = new Date('01 January,'+$('#graphYear').val());
	loadBlock(); // load default block by grower
	//loadSprayTable();
	/* load current graph block */
	//drawTrapCheckChart() 
	//drawMiteMonitoringChart();
	/* handle report by GrowerID */
	$('.clickable').change(function(){ 
	    if($(this).hasClass('grower-name')){
            var url = 'report/grower/'+$(this).val()+'/'+reportYear;
            if(url.length){
                myWin = window.open(siteUrl+url,'_blank');
                if (myWin == undefined) 
                    window.location  = siteUrl+url;
                $('.clickable').removeAttr('selected').val('').eq(1).attr('selected','selected');
            }
	    }else if($(this).hasClass('blockable')){
	        if($(this).val() == -1)
	            return;
	        var grower_name = $('#Grower_name').val();
	        var url = 'report/grower/'+grower_name+'/'+reportYear+'/'+($(this).val()!='/'?$(this).val():'');
	        console.log(url);
            if(url.length){
                myWin = window.open(siteUrl+url,'_blank');
                if (myWin == undefined) 
                    window.location  = siteUrl+url;
                $('.clickable').removeAttr('selected').val('').eq(1).attr('selected','selected');
            }
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
	 * year select graphs
	 */
	$('.fc-button-prev').click(function(){
		graphYear.setYear(graphYear.getFullYear() -1);
        var year = graphYear.getFullYear();
		$('#graphYear').val(year);
        $('#graphYearLabel').html('Aug ' + (year-1) + ' - July ' + year);
		$('#yw0').html('');
		$('#graphMonth').val('');
        loading = 1;
		drawTrapCheckChart();
		drawMiteMonitoringChart();
	});
	$('.fc-button-next').click(function(){
		var cur = new Date();
		if(graphYear.getFullYear() <= cur.getFullYear()){
			var next = graphYear.setYear(graphYear.getFullYear() +1);
			var year = graphYear.getFullYear();
		    $('#graphYear').val(year);
            $('#graphYearLabel').html('Aug ' + (year-1) + ' - July ' + year);
			$('#yw0').html('');
			$('#graphMonth').val('');
            loading = 1;
    		drawTrapCheckChart();
    		drawMiteMonitoringChart();
		}
	});
	
	$('#graphMonth').change(function(){
	    loading = 1;
		drawTrapCheckChart();
		drawMiteMonitoringChart();
	});
    
	/*
	 * year select reports
	 */
	$('.yr-button-prev').click(function(){
		reportYear -= 1;
		var year_html = reportYear - 1;
		year_html += '-' + reportYear;
		$('#yearPicker').html(year_html);
		loadSprayTable();
	});
	$('.yr-button-next').click(function(){
		var cur = new Date();
		if(reportYear < maxYear){
			reportYear += 1;
			var year_html = reportYear - 1;
			year_html += '-' + reportYear;
			$('#yearPicker').html(year_html);
			loadSprayTable();
		}
	});
	$('.toggleMitemonitoring').click(function(){
	    if($('.mitemonitoring-graph').hasClass('hidden-tablet')){
	        $('#yw1').html('<h4 style=\"text-align:center;\">Loading..</h4>');
	        drawMiteMonitoringChart();
	        $('.toggleMitemonitoring').html('Hide Mite Monitoring Graph');
	    }else{
	        $('.toggleMitemonitoring').html('Show Mite Monitoring Graph');
	    }
		$('.mitemonitoring-graph').toggleClass('hidden-tablet').toggleClass('hidden-phone');
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
		$.ajax({
				  type: 'GET',
				  url: siteUrl + 'api/graph/getBlockTrap?block='+block_id+'&year='+graphYear.getFullYear()+'&user='+$('#user_id').val()+'&month='+$('#graphMonth').val(),
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
                                if (typeof jgraph.spraydates != 'undefined'){
                                    jgraph.xAxis['plotBands'] = [];
                                    for(var index_text in jgraph.spraydates){
                                        var from_timer = jgraph.spraydates[index_text] - 3*60*60*1000;
                                        var to_timer = jgraph.spraydates[index_text] + 7*60*60*1000;
                                        var plot_color = index_text.indexOf('End') !=-1 ?'red':'#5b9bd5';
                                        var plot_obj = {
                                            from: from_timer,
                                            to: to_timer,
                                            color: plot_color,
                                            label: {
                                                text: index_text,
                                                'style': {
                                                    color: spray_date_label_color
                                                },
                                                rotation: -90,
                                                textAlign: 'left',
                                                verticalAlign: 'middle'
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
		$.ajax({
				  type: 'GET',
				  url: siteUrl + 'api/graph/getBlockMite?block='+block_id+'&year='+graphYear.getFullYear()+'&user='+$('#user_id').val()+'&month='+$('#graphMonth').val(),
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
				  url: siteUrl + 'api/graph/HTML?block='+block_id+'&year='+(reportYear-1),
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
				<h3><i class="icon-calendar"></i>Graphs</h3>
			</div>
			<div class="box-content nopadding">
				<div class="calendar fc">
					<table style="width:100%" class="fc-header">
					<tbody><tr><td class="fc-header-left">
					</td><td class="fc-header-center">
					<span class="fc-button fc-button-prev fc-state-default fc-corner-left fc-corner-right">
					<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-left"></i></span></span></span>
					<span class="fc-header-title"><h2><span id="graphYearLabel"><?php
                        $m = date('m');
                        $y = date('Y');
                        if ($m > 8)
                            echo "Aug $y - July ". ($y + 1);
                        else
                            echo "Aug ". ($y-1). " - July $y";
                    ?></span></h2></span>
                    <input type="hidden" id="graphYear" value="<?=$m>8?$y+1:$y?>" />
					<span class="fc-button fc-button-next fc-state-default fc-corner-left fc-corner-right">
					<span class="fc-button-inner"><span class="fc-button-content"><i class="icon-chevron-right"></i></span></span></span>
                    <br/>
                    <select class="select2-me input-xlarge" id="graphMonth">
                        <option value="">- All Months</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                    </select>
                    </td><td class="fc-header-right"></td></tr></tbody></table>
				</div>
			</div>
			<div id="trapchecking-graph" class="trapchecking-graph">
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
            <div class="visible-tablet visible-phone" style="text-align: center;"><button style="color: white;" class="toggleMitemonitoring btn btn-warning">Show Mite Monitoring Graph</button></div>
			<div id="mitemonitoring-graph" class="mitemonitoring-graph hidden-tablet hidden-phone">
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
<div class="row-fluid"><div class="span12"></div></div>