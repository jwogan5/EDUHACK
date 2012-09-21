<?
// Create resource cookie if it doesnt exist
if (!isset($_COOKIE['resources']))
{
	setcookie("resources", "wogan", 0, "/eduhack"); 
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Search</title>
	<link rel="stylesheet" media="screen" type="text/css" href="search.css" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Shadows+Into+Light">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script type="text/javascript" src="search.js"></script>
	<script>
		
	
	</script>
</head>
<body>

<div id="contentWrapper">
<a href="/eduhack/lesson.php"><img src="lesson-plan-btn-sml.png" id="imgLogo" /></a>
<div id="form1">
<div id="search">
	<input type="text" id="keyword" name="keyword" />
	<input type="submit" name="submit" value="" id="dosearch" />

	<select id="grade" name="grade">
		<option value="any">Any</option>
		<option value="Grade K">Pre-K</option>
		<option value="Grade 1">Grade 1</option>
		<option value="Grade 2">Grade 2</option>
		<option value="Grade 3">Grade 3</option>
		<option value="Grade 4">Grade 4</option>
		<option value="Grade 5">Grade 5</option>
		<option value="Grade 6">Grade 6</option>
		<option value="Grade 7">Grade 7</option>
		<option value="Grade 8">Grade 8</option>
		<option value="Grade 9">Grade 9</option>
		<option value="Grade 10">Grade 10</option>
		<option value="Grade 11">Grade 11</option>
		<option value="Grade 12">Grade 12</option>
	</select>
</div><!--  search  -->
</div><!--  form1  -->

<div id="iframeBox">
	<div id="frameboxcont"><iframe id="theframe" frameborder="0" width="625" height="450" scrolling="auto"></iframe></div>
	<br style="clear:both;" />
	<div id="goTo">
		<a href=""><img src="go-to-site-btn.png" width="193" height="51px" alt="Go to Site" /></a>
	</div>
	<div id="addLesson">
		<a href="#"><img src="add-to-lesson-btn.png" width="247" height=51" alt="Add to Lesson Plan" />	
	</div>

</div>

<div id="resultsimg"></div>
<div id="searchresults"></div>
<div id="next"><input type="button" value="resume" name="resume" id="resume" /></div>

</div><!-- contentWrapper -->
</body>
</html>

