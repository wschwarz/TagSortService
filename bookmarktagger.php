<?php
//error_reporting(E_ALL);

function getTags($url)
{
	echo "Getting tags\r\n";
	$curlUrl = "https://wschwarz1986:tagsort1scool@api.del.icio.us/v1/posts/suggest?url=" . $url;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $curlUrl);
	//curl_setopt($curl, CURLOPT_HEADER, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_VERBOSE, true);
	//curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	
	$result = curl_exec($curl);
		
	print_r($result);
	print_r(curl_error($curl));
	$returnArr = array();
	$xml = new SimpleXMLElement($result);
	foreach($xml->popular as $item ) {
		print_r("\r\ntag:" . $item);
		array_push($returnArr, $item);
	}
	echo "\r\nEnd get tags";	
	curl_close($curl);
	return $returnArr;
}

getTags("http://www.google.com");
?>