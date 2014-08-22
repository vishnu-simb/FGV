/**
 * Author: Tom Doan (doannhandng@gmail.com)
 * Date: 8/08/14
 * Time: 11:57 AM
 *
 * The dashboard javascipt
 */

$(document).ready(function () {
	
	/* define base url */
	var siteUrl = document.URL; 
	var _date = $("#datePicker").html();
	var months = new Array( "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	var actualDate = new Date("01 "+_date); // convert to actual date
	
	loadSprayTable();
	/* load current graph block */
	drawTrapCheckChart() 
	drawMiteMonitoringChart();
	
	/* handle report by GrowerID */
	$('.clickable').change(function(){ 
		var url = "report/grower/"+$(this).val();
		if(url.length){
		window.open(url,'_blank');
		$('.clickable').removeAttr('selected').val('').eq(1).attr('selected','selected');
		}
	});
	
	$('#Block_id').change(function(){
		var t = $(this).find('option[value="'+$(this).val()+'"]');
		if(typeof t.parent().attr('label') != 'undefined')
		$('h1').html(t.parent().attr('label')+': '+t.html());
		$("#yw0").html('');
		drawTrapCheckChart();
		loadSprayTable();
		drawMiteMonitoringChart();
	});
	

	
	/*
	 * month selected on dashboard
	 */
	
	$('.fc-button-prev').click(function(){
		var prev = actualDate.setMonth(actualDate.getMonth() -1);
		$("#datePicker").html(months[actualDate.getMonth()]+','+actualDate.getFullYear());
		$("#yw0").html('');
		drawTrapCheckChart();
		drawMiteMonitoringChart();
	});
	$('.fc-button-next').click(function(){
		var next = actualDate.setMonth(actualDate.getMonth() +1);
		$("#datePicker").html(months[actualDate.getMonth()]+','+actualDate.getFullYear());
		$("#yw0").html('');
		drawTrapCheckChart();
		drawMiteMonitoringChart();
		
	});
	
	function drawTrapCheckChart(){
			var block_id = $("#Block_id").val();
			$.ajax({
					  type: "GET",
					  url: siteUrl + "api/graph/getBlockTrap?block="+block_id+"&date="+$("#datePicker").html(),
					  success: function (data)
					   {
						  		var jgraph = JSON.parse(data);
						  		if(jgraph.chart == false){
						  			$("#yw0").html('');
						  		}else{
						  			Highcharts.setOptions([]); 
							  		var chart = new Highcharts.Chart(jgraph);
						  		}
						  		
					   }
			});
	}
	
	function drawMiteMonitoringChart(){
		var block_id = $("#Block_id").val();
		$.ajax({
				  type: "GET",
				  url: siteUrl + "api/graph/getBlockMite?block="+block_id+"&date="+$("#datePicker").html(),
				  success: function (data)
				   {
					  		var jgraph = JSON.parse(data);
					  		Highcharts.setOptions([]); 
						  	var chart = new Highcharts.Chart(jgraph);
					  		
				   }
		});
}
	
	
	function loadSprayTable(){
		var block_id = $("#Block_id").val();
		$.ajax({
				  type: "GET",
				  url: siteUrl + "api/graph/HTML?block="+block_id+"&date="+$("#datePicker").html(),
				  success: function (data)
				   {
					  $(".spraytable").html(data);
		
				   }
		});
}
});
