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
//echo($response);
$dictionary = json_decode($response, true);
//get the string needle and array haystack containing needle
$prefix = $dictionary["prefix"];
echo 'The prefix is: '.$prefix.' '."\xA";
$array = $dictionary["array"];
$response = print_r($array, true);
echo 'The array is: '.$response.'';
$count = count($array);
$returnArray = array();

//populate returnArray with words that don't contain prefix as a substring
for($i=0; $i<$count; $i++){
	if (strpos($array[$i], $prefix) === false) {
		$returnArray[] = $array[$i];
	}
}
$response = print_r($returnArray, true);
echo 'The return array is: '.$response.'';

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
//send request
$response = curl_exec($ch);
echo($response);

