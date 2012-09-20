$(function(){
	$('#dosearch').bind('click', function() {
	
	  // Get the keywords
	  var keys = $('#keyword').val();
	  
	  // Get the grade level
	  var grade_level = $('#grade').val();
	  
	  var resumeKey = '';
	
	  $.ajax({
	  		url: 'ajaxsearch.php',
	  		type: "POST",
			data:{ keywords: keys, grade: grade_level, resume : resumeKey },
			dataType: "json",
	  		success: function(data) {
			
				/*
					values returned
					---------------
					status          : success
					tags            : tag passed to learning registry
					url             : full url passed to learining registry
					results         : array of resource data
											id
											loc
											keys
											curator
											submitter
					count			: count of reults for the current page
					total_count		: total number of results
					token			: resume key
				*/
			
			
	    		$('#searchresults').html(data.results);
	  		}
		});
	});
});


