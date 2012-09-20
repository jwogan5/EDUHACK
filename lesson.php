<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lessons Learned</title>
  <meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="David Orick" />
	<meta name="robots" content="ALL" />         
  	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=yes;" />
	<link rel="stylesheet" media="screen" type="text/css" href="lesson.css" />   
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Shadows+Into+Light">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script>
	
	
	</script>
</head>
<body>   

<div class="container">

	<div class="nav">
		<a href="/search.html" class="searchback"></a>
	</div>	
	<div class="lesson">
		<div class="subject">
			<span>Subject:</span><input type="text" />
		</div>
		<div class="lessonpaper">
			<span class="title">Title:</span><input type="text" class="titletext" />
			<br class="clear" />
			<?
			if($_COOKIE["resources"]){
				//loop through resources
				
			}
			else{
				echo '<a href="/search.php" class="gotosearch"></a>';
			}
			?>			
			<span class="purpose">Purpose:</span><input type="text" class="purposetext" />
			<br class="clear" />			
			<span class="time">Time:</span>
			<select>
				<?
				for($i=1;$i<=60;$i++){
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
				?>
				
			</select>
			<select class="timenuits">
				<option value="minutes">Minutes</option>
				<option value="hours">Hours</option>
				<option value="days">Days</option>
			</select>
			<br class="clear" />			
			<span class="materals">Materials:</span>
			<textarea class="materialstext"></textarea>
			<br class="clear" />
			<span class="instructions">Instructions:</span>
			<textarea class="instructionstext"></textarea>
			<br class="clear" />
			<span class="assessment">Assessment:</span>
			<textarea class="assessmenttext"></textarea>
			<br class="clear" />	
			<a href="#" class="savelesson"></a>	
			<br class="clear" /><br class="clear" />
		</div>
		
	</div>	
	<div class="social">
		<a href="#" class="twitterpost"></a>
		<br />
		<a href="#" class="facebookpost"></a>
		<br />
		<a href="#" class="emaillesson"></a>		
	</div>	
</div>
   
</body>
</html>