<?php
$hubVerifyToken = 'myBusiness23';
$accessToken = "EAAHhOHJDpuQBAA1QDp81xnY2rZBZBrsN8BDMrZAtkG0ZCZAd1H2exR8tZA6Ec7Vxzo81vURNAynZAxgAf5ZBuiZAj2lcPdsksJJMJZA5DpdocMe2ZAOsW6qU2p3YapLfgSt645LVR0vjJJ8Ghut7y0ZAyDe8ZAbyWKq88uZBdIPk1PJc5qRodJPZAm67UMI4Eh4hoplh9gZD";


$challenge = $_GET['hub_challenge'];
$verify_token = $_GET['hub_verify_token'];

if($hubVerifyToken === $verify_token){
echo $challenge;
exit;
}


// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);

$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];


$answer = "I don't understand. Ask me 'hi'.";
if($messageText == "hi") {
    $answer = "Hello";
}

$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);