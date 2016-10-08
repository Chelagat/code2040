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
//send request
$response = curl_exec($ch);
//echo($response);
$dictionary = json_decode($response, true);
//get the string needle and array haystack containing needle
$datestamp = $dictionary["datestamp"];
echo 'The datestamp is: '.$datestamp.' '."\xA";
$interval = $dictionary["interval"];
echo 'The interval is: '.$interval.' seconds  ';
//$timestamp = gmdate(" H:i:s", $interval);
//echo 'The timestamp from the interval is: '.$timestamp.'';
$date = new DateTime($datestamp);
echo $date->getTimestamp(). "<br>";
$date->add(new DateInterval('PT'.$interval.'S'));
echo 'Hello';
$datestamp = $date->format(DateTime::ATOM);
echo 'Date stamp after addition: '.$datestamp.'';
$str = substr($datestamp, 0, 19);
$str = $str."Z";
echo 'The substring is: '.$str.'."<br>"';
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
//send request
$response = curl_exec($ch);
echo $response;


?>


                                                                         
//send request
$response = curl_exec($ch);
echo($response);

