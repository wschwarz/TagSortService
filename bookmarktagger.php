<?php
//error_reporting(E_ALL);
function lb()
{
	if(defined('STDIN') ) 
		return "\r\n"; 
	else 
		return "<br />"; 
}


function getTags($url)
{
	echo "Getting tags" + lb();
	$curlUrl = "https://wschwarz1986:tagsort1scool@api.del.icio.us/v1/posts/suggest?url=" . $url;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $curlUrl);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	//curl_setopt($curl, CURLOPT_VERBOSE, true); //enable for extra msgs.
	
	$result = curl_exec($curl);
		
	print_r($result);
	error_log(curl_error($curl));
	$returnArr = array();
	$xml = new SimpleXMLElement($result);
	foreach($xml->popular as $item ) {
		print_r(lb() + "tag:" . $item);
		array_push($returnArr, $item);
	}
	echo lb() + "End get tags";	
	curl_close($curl);
	return $returnArr;
}

getTags("http://www.google.com");
?>