$(document).ready(function () {
	

	$('.clickable').change(function(){
		var url = "report/grower/"+$(this).val();
		if(url.length){
		window.open(url,'_blank');
		$('.clickable').removeAttr('selected').val('').eq(1).attr('selected','selected');
		}
	});
	$('#Block_name').change(function(){
		var t = $(this).find('option[value="'+$(this).val()+'"]');
		if(typeof t.parent().attr('label') != 'undefined')
		$('h1').html(t.parent().attr('label')+': '+t.html());
	});
	
	/*
	 * datePicker on Dashboard
	 */
	var _date = $("#datePicker").html();
	var months = new Array( "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	var actualDate = new Date("01 "+_date); // convert to actual date

	$('.fc-button-prev').click(function(){
		var prev = actualDate.setMonth(actualDate.getMonth() -1);
		$("#datePicker").html(months[actualDate.getMonth()]+','+actualDate.getFullYear());
	});
	$('.fc-button-next').click(function(){
		var next = actualDate.setMonth(actualDate.getMonth() +1);
		$("#datePicker").html(months[actualDate.getMonth()]+','+actualDate.getFullYear());
	});
});
