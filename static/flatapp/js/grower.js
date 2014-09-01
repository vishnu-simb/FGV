/**
 * Author: Tom Doan (doannhandng@gmail.com)
 * Date: 8/08/14
 * Time: 11:57 AM
 */

$(document).ready(function () {
	
	weekly(); // load default 
	
	$( "#Grower_reporting" ).change(function(){
		weekly();
	});
	
	function weekly(){
		if($("#Grower_reporting").val() == 'weekly'){
			$(".weekly-interval").show();
		}else{
			$(".weekly-interval").hide();
		}
	}
});
