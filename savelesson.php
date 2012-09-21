<?php
	require_once("mysql/database.php");

	//phpinfo();
	
	$id = -1;
	if(isset($_COOKIE['lesson'])) {
		$aLesson = json_decode($_COOKIE['lesson'],true);
		$aLesson['materials'] = $aLesson['material'];
		$aTime = explode(' ',$aLesson['time']);
		$aLesson['duration'] = $aTime[0];
		$aLesson['duration_type'] = $aTime[1];
		$oLesson = new Lesson($aLesson);
		$oLesson->save();
		$id = $oLesson->id;
	}

	//
	//print_r(json_decode($_COOKIE['resource'],true));
	//

	echo $id;
