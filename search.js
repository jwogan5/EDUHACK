$(function(){

	var searchTerm = '';
	var currentResource = '';
	var resumeToken = '';
	var clickedResume = false;
	var currentSavedResource = '';
	
	

	
	$("body").on("click", ".results", function() {
		currentResource = $(this);
		var theURL = $(this).attr("rurl");
		$('#theframe').attr('src', theURL);
	});
	
	$('#goTo').bind('click', function(event) {
		window.open(currentResource.attr('rurl'));
		event.preventDefault();
	});
	
	$('#resume').bind('click', function() {
		clickedResume = true;
		$('#dosearch').click();
	});
	
	$('#addLesson').bind('click', function() {
	
		if (currentSavedResource != currentResource.attr('rid'))
		{
			// Save the resource to the cookie
			var rOBJ = {
				id : currentResource.attr('rid'),
				doc : currentResource.attr('rurl'),
				title : currentResource.attr('rtitle')
			};
			
			// Add Resource to current cookie
			cookies = document.cookie.split(";");
			for (var c in cookies)
			{
				var arcookie = cookies[c].split("=");
				if (arcookie[0] == 'resources')
				{
					var cr = arcookie[1];
					cr = cr + "----" + JSON.stringify(rOBJ);
				}
			}
			cr = cr.replace("wogan","");
			SetCookie('resources',cr);
			
			// Save current saved resource id
			currentSavedResource = currentResource.attr('rid');
		}
		else
			alert("Resource Document Already Saved");
	});
	
	


	$('#dosearch').bind('click', function() {
	  var keys = $('#keyword').val();
	  var grade_level = $('#grade').val();
	  
	  if (clickedResume == false)
	  	resumeToken = '';
		
	  $.ajax({
	  		url: 'ajaxsearch.php',
	  		type: "POST",
			data:{ keywords: keys, grade: grade_level, resume : resumeToken },
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
											doc
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
					dataHTML += "<div class='results' onclick='' rid='" + data.results[i].id + "' rurl='" + data.results[i].doc + "' rtitle='" + data.results[i].title + "'>" +
					data.results[i].title	
					
					 + "</div>";
				}

	    		$('#searchresults').html(dataHTML);
				
				
				resumeToken = data.token;
				
				
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
		clickedResume = false;
	});
});

function SetCookie(cookieName,cookieValue,nDays) {
 var today = new Date();
 var expire = new Date();
 if (nDays==null || nDays==0) nDays=1;
 expire.setTime(today.getTime() + 3600000*24*nDays);
 document.cookie = cookieName+"="+escape(cookieValue)
                 + ";expires="+expire.toGMTString() +";path='/'";
}


