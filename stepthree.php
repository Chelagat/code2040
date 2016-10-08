<?php

$token = '3af306b2194e879055b41443412e4daf';

// The data to send to the API
$postData = array(
    "token" => $token,
);
$json_object = json_encode($postData);

// Setup cURL
$ch = curl_init('http://challenge.code2040.org/api/haystack');
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
$str = $dictionary["needle"];
echo 'The needle is: '.$str.' '."\xA";
$haystack = $dictionary["haystack"];
$response = print_r($haystack, true);
echo 'The haystack is: '.$response.'';
$count = count($haystack);
$needle = 0;
for($i=0; $i<$count; $i++){
	if($haystack[$i] == $str) {
		$needle = $i;
		break;
	}
}
echo $needle;
$postData = array(
	"token" => $token,
    "needle" => $needle,
);
$json_object = json_encode($postData);

// Setup cURL
$ch = curl_init('http://challenge.code2040.org/api/haystack/validate');
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

