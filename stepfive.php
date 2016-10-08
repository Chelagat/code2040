<?php

$token = '3af306b2194e879055b41443412e4daf';

// The data to send to the API
$postData = array(
    "token" => $token,
);
$json_object = json_encode($postData);

// Setup cURL 
$ch = curl_init('http://challenge.code2040.org/api/dating');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS ,$json_object);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($json_object))                                                                       
);    


//send post request
$response = curl_exec($ch);


//convert the json object to array so as to get the datestamp and interval values
$dictionary = json_decode($response, true);
$datestamp = $dictionary["datestamp"];
$interval = $dictionary["interval"];

//utilizing the add function in DateTime
$date = new DateTime($datestamp);
$date->add(new DateInterval('PT'.$interval.'S'));
$datestamp = $date->format(DateTime::ATOM);

//manipuate the datestamp string to be the required ISO 8601 datestamp format
$str = substr($datestamp, 0, 19);
$str = $str."Z";
$postData = array(
    "token" => $token,
    "datestamp" => $str,
);

$json_object = json_encode($postData);

// Setup cURL
$ch = curl_init('http://challenge.code2040.org/api/dating/validate');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS ,$json_object);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($json_object))                                                                       
);    
//send final post request
$response = curl_exec($ch);
echo $response;


?>



