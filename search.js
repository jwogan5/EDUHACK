$(function(){
	$('#dosearch').bind('click', function() {
	  $.ajax({
	  		url: 'ajaxsearch.php',
	  
	  		success: function(data) {
	    		$('#searchresults').html('here');
	  		}
		});
	});
});


