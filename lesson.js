var btimeupdated = false, lessonid = 0;
$(document).ready(function(){

	$('.twitterpost,.facebookpost,.emaillesson').bind('click',function(){
		if(document.URL.indexOf('?lessonid') > 0 || lessonid > 0){
			var shareURL = (document.URL.indexOf('?lessonid') > 0 ) ? document.URL: document.URL+'?lessonid='+lessonid;		
			//share the current URL to whatever was clicked		
			switch($(this).attr("class")){
				case 'twitterpost':
					twitterPost(shareURL)
					break;
				case 'facebookpost':
					facebookPost('New Lesson Plan', shareURL, 'Lesson Plan', 'See the lesson plan');
					break;
				case 'emaillesson':
					
					break;
			}
		}
		else{
			alert('You must complete the lesson plan and save before you can share it.');
		}
	});

	$('.timenuits').bind('change',function(event){
		btimeupdated = true;	
	});
	$('.timeselect').bind('change',function(event){
		btimeupdated = true;	
	});		
	
	$('.gotosearch').bind('click',function(event){
		event.preventDefault();
		setCookie();
		window.location.href = "/eduhack/search.html";
	});
	$('.close').live('click',function(event){
		event.preventDefault();
		hideModal();
	});	
	//save the lesson and prompt the user to share the URL
	$('.savelesson').bind('click',function(event){
		//make ajax call	
		event.preventDefault();
		setCookie();		
		$.ajax({
          type: 'POST',
          url: '/eduhack/savelesson.php',
          dataType: 'text',
          data: 'cookie=true',
          cache: false,
          success: function(data) {
            //console.log(data);
            lessonSaved(data);
          },
          error: function() {
            alert('Ajax Error');
          }
        });		
	});
	
	
});
function lessonSaved(lessonID){
	lessonid = lessonID;
	setModal();
}
function setModal(){
		$('body').append("<div class='modal'></div>");
		$('.modal').css('height',$(document).height()).show();
		setModalContent();
}
function hideModal(){
		$('.modal').remove();
		$('.modalcontainer').remove();
}
function setModalContent(){
		$('body').append("<div class='modalcontainer'></div>");
		$('body').scrollTop(3);
		var slftpos = ( $(document).width() / 2 ) - 200;
		$('.modalcontainer').css('left',slftpos).css('top',100);
		var htmlcontent = setlessonsaved();
		$('.modalcontainer').html(htmlcontent);		
}
function setlessonsaved(){
	var odata = '<a href="#" class="close">Close</a><br class="clear" /><span>Your lesson has been saved.</span><br /><p>Click the link(s) below to share this lesson plan.</p>		<a href="#" class="twitterpost"></a><a href="#" class="facebookpost"></a><a href="#" class="emaillesson"></a>';
	return odata;
}
function setCookie(){
		var lessoncookie = {};		
		if($('.subjecttext').val() != ''){
			lessoncookie.subject = $('.subjecttext').val();
		}
		if($('.titletext').val() != ''){
			lessoncookie.title = $('.titletext').val();
		}					
		//if(btimeupdated){
			lessoncookie.time = $('.timeselect').val() + ' ' + $('.timenuits').val();
		//}		
		if($('.purposetext').val() != ''){
			lessoncookie.purpose = $('.purposetext').val();
		}			
		if($('.materialstext').val() != ''){
			lessoncookie.material = $('.materialstext').val();
		}		
		if($('.instructionstext').val() != ''){
			lessoncookie.instruction = $('.instructionstext').val();
		}		
		if($('.assessmenttext').val() != ''){
			lessoncookie.assessment = $('.assessmenttext').val();
		}	
			
		//save cookie
		$.cookie('lesson',JSON.stringify(lessoncookie));
}
