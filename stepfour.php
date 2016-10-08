<?php

$token = '3af306b2194e879055b41443412e4daf';

// The data to send to the API
$postData = array(
    "token" => $token,
);
$json_object = json_encode($postData);

// Setup cURL
$ch = curl_init('http://challenge.code2040.org/api/prefix');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS ,$json_object);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($json_object))                                                                       
);    
//send request
$response = curl_exec($ch);

//convert the json object returned, to an array and get the values of prefix and the array
$dictionary = json_decode($response, true);
$prefix = $dictionary["prefix"];
$array = $dictionary["array"];
$count = count($array);

//declare the array(empty for now) that will be populated with the no-prefix words
$returnArray = array();

//populate returnArray with words that don't contain prefix as a substring
for($i=0; $i<$count; $i++){
	if (strpos($array[$i], $prefix) === false) {
		$returnArray[] = $array[$i];
	}
}

//Data to send to API
$postData = array(
	"token" => $token,
    "array" => $returnArray,
);
$json_object = json_encode($postData);

// Setup cURL
$ch = curl_init('http://challenge.code2040.org/api/prefix/validate');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS ,$json_object);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($json_object))                                                                       
);  

//send final post request
$response = curl_exec($ch);
echo($response);

