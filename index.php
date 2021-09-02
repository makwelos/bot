<?php

$hubVerifyToken = 'EAAH6PEKW1FwBANNZAH3ydfcZAMvMYaelaGchkw4ZAaXxvKXCo7ZBw2TOMeECmAMVf31xIcNB7BLotndzvzrBeeZCxVJ1apDjDu6ZCETMPqCeR9HNLbZCBwu4SBYtdVO9Y981KobV8oZADDpRu4zRtdh2hX8Cban092xco01viS55HiJXSAZBQlaw5sec2n41LaXYZD';
$accessToken = "myBusiness";
// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
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
