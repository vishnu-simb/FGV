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
	
	/* load current BlockID */
	drawVisualizationChart() 
	
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
		drawVisualizationChart();
	});
	

	
	/*
	 * month selected on dashboard
	 */
	
	$('.fc-button-prev').click(function(){
		var prev = actualDate.setMonth(actualDate.getMonth() -1);
		$("#datePicker").html(months[actualDate.getMonth()]+','+actualDate.getFullYear());
		$("#yw0").html('');
		drawVisualizationChart();
	});
	$('.fc-button-next').click(function(){
		var next = actualDate.setMonth(actualDate.getMonth() +1);
		$("#datePicker").html(months[actualDate.getMonth()]+','+actualDate.getFullYear());
		$("#yw0").html('');
		drawVisualizationChart();
		
	});
	
	function drawVisualizationChart(){
			var block_id = $("#Block_id").val();
			$.ajax({
					  type: "GET",
					  url: siteUrl + "api/graph/getGraph?block="+block_id+"&date="+$("#datePicker").html(),
					  success: function (data)
					   {
						  		var jgraph = JSON.parse(data);
						  		Highcharts.setOptions([]); 
						  		var chart = new Highcharts.Chart(jgraph);
					   }
			});
	}
});
