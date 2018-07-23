<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
try {
$token = 'Erq3dSI0KQ4z56zXiEs8nrMTu4RP7Tg7A1GDlYIb';
$url = 'https://bibles.org/v2/verses/'. $_GET['v'] .'.js';
//$url = 'https://bibles.org/v2/passages.js?q[]='. $_GET['ref'] .'&version=eng-KJVA';
// Set up cURL
$ch = curl_init();
// Set the URL
curl_setopt($ch, CURLOPT_URL, $url);
// don't verify SSL certificate
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// Return the contents of the response as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// Follow redirects
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// Set up authentication
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$token:X");
// Do the request
$response = curl_exec($ch);
curl_close($ch);
echo $response;
} catch(Exception $e) {
 echo 'Internal server error.';   
}
?>