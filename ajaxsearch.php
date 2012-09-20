<?

// Setup start vars
$tags ='';

// GET the POST variables
$theKeys = $_POST['keywords'];
$theGrade = $_POST['grade'];
$theResumeKey = $_POST['resume'];

// Build the tag string
if (strpos($theKeys,'"') !== false)
{
	$firstOccur = strpos($theKeys,'"');
	$lastOccur = strrpos($theKeys,'"');
	$occurLength = $lastOccur - $firstOccur;
	$tags = substr($theKeys,$firstOccur + 1,$occurLength - 1);
}
else
	$tags = $theKeys;
$tags = str_replace(" ",",",$tags);
if ($theGrade != 'any')$tags .= ",$theGrade";
$tags = str_replace(",,",",",$tags);


// Make the curl request to the learning registry
$learnURL = "http://sandbox.learningregistry.org/slice?any_tags=" . $tags;
if ($theResumeKey != '')
	$learnURL .= "&resumption_token=" . $theResumeKey;
$c = curl_init(); 
curl_setopt($c, CURLOPT_URL, $learnURL);  
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
$theData = json_decode(curl_exec($c),true);

// Process the Results
$resultCount = $theData['resultCount'];

if (isset($theData['resumption_token']))
	$resumeToken = $theData['resumption_token'];
else
	$resumeToken = '';


$arResources = array();
foreach ($theData['documents'] as $document)
{
	// Process the keys
	$docKeys = $document['resource_data_description']['keys'];
	$sKey = '';
	foreach ($docKeys as $dkey)
	{
		$sKey .= "$dkey,";
	}

	if ($document['resource_data_description']['resource_locator'] != 'URI_of_resource')
	{
		if ($theGrade != 'any')
		{
			if (strpos($sKey,$theGrade) !== false)
			{
				$newNode = array();
				$newNode['id'] = $document['doc_ID'];
				$newNode['doc'] = $document['resource_data_description']['resource_locator'];
				$newNode['keys'] = $sKey;
				if (isset($document['resource_data_description']['identity']['submitter']))
					$newNode['submitter'] =  $document['resource_data_description']['identity']['submitter'];
				if (isset($document['resource_data_description']['identity']['curator']))
					$newNode['curator'] =  $document['resource_data_description']['identity']['curator'];
					
				$newNode['title'] = getTitle($document['resource_data_description']['resource_data'],$newNode['doc']);
				$arResources[] = $newNode;
			}
		}
		else
		{
			$newNode = array();
			$newNode['id'] = $document['doc_ID'];
			$newNode['doc'] = $document['resource_data_description']['resource_locator'];
			$newNode['keys'] = $sKey;
			if (isset($document['resource_data_description']['identity']['submitter']))
					$newNode['submitter'] =  $document['resource_data_description']['identity']['submitter'];
			if (isset($document['resource_data_description']['identity']['curator']))
				$newNode['curator'] =  $document['resource_data_description']['identity']['curator'];
				
			$newNode['title'] = getTitle($document['resource_data_description']['resource_data'],$newNode['doc']);
			$arResources[] = $newNode;
		}
		
	}
	
}



$arRet = array();
$arRet['status'] = "success";
$arRet['tags'] = $tags;
$arRet['url'] = $learnURL;
$arRet['results'] = $arResources;
$arRet['count'] = count($arResources);
$arRet['total_count'] = $resultCount;
$arRet['token'] = $resumeToken;

echo json_encode($arRet);



function getTitle($data,$url){
	$title = $url;
	
	
	$subject = $data;
	$pattern = '/<dc:title>(.*)<\/dc:title>/i';
	preg_match($pattern, $subject, $matches);
	if (isset($matches[1]))
		$title = $matches[1];
	
	return $title;
}

?>