$(document).ready(function(){
	
	$('.gotosearch').bind('click',function(event){
		event.preventDefault();
		var lessoncookie = {};
		
		if($('.subjecttext').val() != ''){
			lessoncookie.subject = $('.subjecttext').val();
		}
		
		
		//alert(lessoncookie.title);
		
		
	});
	
});