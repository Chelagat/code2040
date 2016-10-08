<?php


$token = '3af306b2194e879055b41443412e4daf';

// The data to send to the API
$postData = array(
    'token' => $token,
);

// Setup cURL
$ch = curl_init('http://challenge.code2040.org/api/reverse');
curl_setopt($ch, CURLOPT_POSTFIELDS ,json_encode($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//send request
$response = curl_exec($ch);
//reverse string response
$rev_response = strrev ($response);
//data to send to API
$postData = array(
    'token' => $rev_response,
);
//post reversed string to specified url
$ch = curl_init('http://challenge.code2040.org/api/reverse/validate');
curl_setopt($ch, CURLOPT_POSTFIELDS ,json_encode($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);
curl_close($ch);


?>