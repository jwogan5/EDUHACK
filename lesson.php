<!DOCTYPE html>
<?php
	require_once('mysql/database.php');
	$oLesson = new Lesson();
	if(!empty($_REQUEST['lessonid'])) {
		$oLesson = new Lesson($_REQUEST['lessonid']);	
	}
 ?>
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
	<script src="socialPost.js"></script>
	<script src="cookie.js"></script>
	<script src="lesson.js"></script>
	<script>
	
	
	</script>
</head>
<body>   
<div class="container">

	<div class="nav">
		<a href="/eduhack/search.php" class="searchback"></a>
	</div>	
	<div class="lesson">
		<div class="subject">
			<span>Subject:</span><input type="text" class="subjecttext" value="<?= $oLesson->subject ?>" />
		</div>
		<div class="lessonpaper">
			<span class="title">Title:</span><input type="text" class="titletext" value="<?= $oLesson->title ?>" />
			<br class="clear" />
			<?
			
			$id = $oLesson->id;
			if(!empty($id)) {
				$db = eduhack_db::getInstance();
				$qry = $db->query("SELECT url from lessonitem where lesson_id=$id;");
				echo '<span class="">Resources:</span><br class="clear" /><br class="clear" />';
				foreach ($qry as $row) {
					echo '<p class="resources">'.$row['url'].'</p>';
    			}
			} else
			if(isset($_COOKIE["resources"]) && $_COOKIE["resources"]){
				echo '<span class="">Resources:</span><br class="clear" /><br class="clear" />';
				
				
				$arTemp = explode('----',$_COOKIE["resources"]);
			
				for($i=0;$i<count($arTemp);$i++){		
					$ocookie = str_replace('\\','',urldecode($arTemp[$i]));
					$ocookie = urldecode($ocookie);
					$ocookie = urldecode($ocookie);
					$arcookiedata = explode(',',$ocookie);
					
					if (isset($arcookiedata[1]))
					{
						$tempstring = str_replace('"doc":','',$arcookiedata[1]);
						$tempstring = str_replace('"','',$tempstring);
						echo '<p class="resources">'.$tempstring.'</p>';
					}			
				}
							
			}
			else{
				echo '<span class="resourcesbtnlabel">Resources:</span><a href="/search.php" class="gotosearch"></a>';
			}
			?>			
			<span class="purpose">Purpose:</span><input type="text" class="purposetext" value="<?= $oLesson->purpose ?>" />
			<br class="clear" />			
			<span class="time">Time:</span>
			<select class="timeselect">
				<?
				for($i=1;$i<=60;$i++){
					if($i == $oLesson->duration) {
						echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
					} else {
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
				}
				?>
				
			</select>
			<select class="timenuits">
<?php if(!empty($oLesson->duration_type)) { ?>
				<option value="<?= $oLesson->duration_type ?>"><?= ucfirst($oLesson->duration_type) ?></option>
<?php } ?>
				<option value="minutes">Minutes</option>
				<option value="hours">Hours</option>
				<option value="periods">Class Periods</option>
			</select>
			<br class="clear" />			
			<span class="materals">Materials:</span>
			<textarea class="materialstext"><?= $oLesson->materials ?></textarea>
			<br class="clear" />
			<span class="instructions">Instructions:</span>
			<textarea class="instructionstext"><?= $oLesson->instruction ?></textarea>
			<br class="clear" />
			<span class="assessment">Assessment:</span>
			<textarea class="assessmenttext"><?= $oLesson->assessment ?></textarea>
			<br class="clear" />	
			<a href="#" class="savelesson"></a>	
			<br class="clear" /><br class="clear" />
		</div>
		
	</div>	
	<div class="social">
		<span class="f25">Share Lesson</span><br class="clear" />
		<a href="#" id="twitterpost" class="twitterpost"></a>
		<br />
		<a href="#" id="facebookpost" class="facebookpost"></a>
		<br />
		<a href="#" class="emaillesson"></a>		
	</div>	
</div>
   
</body>
</html>
