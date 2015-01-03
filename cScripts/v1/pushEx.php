<?php

$url = 'https://api.parse.com/1/push';

$appId = 'wrDBeyyvoetbewUYHqByWOfK1R5PhiTmZiGOJeYO';
$restKey = 'VWzz9J7T35uv2pND3AXcCZGxdFiW7RmTMwO7dvfT';

$target_device = 'Vt5jG39C6F';  // using object Id of target Installation.

$BUN = 'NV';

$push_payload = json_encode(array(
        "where" => array(
 

/*
               "objectId" => $target_device,

*/
               "BUN" => $BUN,


        ),
        "data" => array(
                "alert" => "Sent from server directly to NV"
        )
));

$rest = curl_init();
curl_setopt($rest,CURLOPT_URL,$url);
curl_setopt($rest,CURLOPT_PORT,443);
curl_setopt($rest,CURLOPT_POST,1);
curl_setopt($rest,CURLOPT_POSTFIELDS,$push_payload);
curl_setopt($rest,CURLOPT_HTTPHEADER,
        array("X-Parse-Application-Id: " . $appId,
                "X-Parse-REST-API-Key: " . $restKey,
                "Content-Type: application/json"));

$response = curl_exec($rest);
echo $response;

?>
