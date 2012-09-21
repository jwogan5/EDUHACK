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

	if(!empty($_COOKIE['resources'])) {
		$resources = explode('----', $_COOKIE['resources']);
		$cnt = count($resources);
		for($i = 0; $i < $cnt; $i++) {
			$resource = $resources[$i];
			for($ii=$i; $ii < $cnt; $ii++) {
				$resource = urldecode($resource);
			}
			$aRes = json_decode($resource,true);
			$aRes['lesson_id']=$id;
			if(isset($aRes['id'])) {
				$aRes['lrdocid'] = $aRes['id'];
				unset($aRes['id']);
			}
			if(isset($aRes['doc'])) {
				$aRes['url'] = $aRes['doc'];
			}
			$oItem = new LessonItem($aRes);
			$oItem->save();
		}
	}
	
	echo $id;
