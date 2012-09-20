$(function(){

	var searchTerm = '';


	$('#dosearch').bind('click', function() {
	  var keys = $('#keyword').val();
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
											title
					count			: count of reults for the current page
					total_count		: total number of results
					token			: resume key
				*/
				
				var dataHTML = '';
				for(var i in data.results)
				{
					dataHTML += "<div>" +
					data.results[i].title	
					
					 + "</div>";
				}
				
			
			
	    		$('#searchresults').html(dataHTML);
				
				
				// Set the Search Term
				searchTerm = data.tags;
				searchTerm = searchTerm.replace(",Grade K","");
				searchTerm = searchTerm.replace(",Grade 1","");
				searchTerm = searchTerm.replace(",Grade 2","");
				searchTerm = searchTerm.replace(",Grade 3","");
				searchTerm = searchTerm.replace(",Grade 4","");
				searchTerm = searchTerm.replace(",Grade 5","");
				searchTerm = searchTerm.replace(",Grade 6","");
				searchTerm = searchTerm.replace(",Grade 7","");
				searchTerm = searchTerm.replace(",Grade 8","");
				searchTerm = searchTerm.replace(",Grade 9","");
				searchTerm = searchTerm.replace(",Grade 10","");
				searchTerm = searchTerm.replace(",Grade 11","");
				searchTerm = searchTerm.replace(",Grade 12","");
				searchTerm = searchTerm.replace(","," ");
				
				
	  		}
		});
	});
});


