<?php
$access_token="EAAHhOHJDpuQBAA1QDp81xnY2rZBZBrsN8BDMrZAtkG0ZCZAd1H2exR8tZA6Ec7Vxzo81vURNAynZAxgAf5ZBuiZAj2lcPdsksJJMJZA5DpdocMe2ZAOsW6qU2p3YapLfgSt645LVR0vjJJ8Ghut7y0ZAyDe8ZAbyWKq88uZBdIPk1PJc5qRodJPZAm67UMI4Eh4hoplh9gZD";
$verify_token="myBusiness23";
$hub_verify_token=null;

if(isset($_REQUEST['hub_mode'])&&$_REQUEST['hub_mode']=='subscribe')
{
	$challenge=$_REQUEST['hub_challenge'];
	$hub_verify_token=$_REQUEST['hub_verify_token'];
	if($hub_verify_token==$verify_token)
		header('HTTP/1.1 200 OK');
		echo $challenge;
		die;
}

$input=json_decode(file_get_contents('php://input'),true);

$sender=$input['entry'][0]['messaging'][0]['sender']['id'];
$message=isset($input['entry'][0]['messaging'][0]['message']['text'])?$input['entry'][0]['messaging'][0]['message']['text']:'';
if($message)
{
	$words = explode(" ", $message);
	if($words[0]=="Hi"||$words[0]=="Hello"||$words[0]=="hi"||$words[0]=="hello")
	{
		$message_to_reply="hi there :)"."How can I help You??";
	}
	else if($words[0]=="What"||$words[0]=="Why"||$words[0]=="Who"||$words[0]=="who"||$words[0]=="what"||$words[0]=="why")
	{
		$message_to_reply="I am just a normal bot to answer the questions on behalf of my creator mr.Shoaib :)";
	}
	else
	{
		$message_to_reply="I am Sorry, I can't help You This Time.";
	}
	$url="https://graph.facebook.com/v2.6/me/messages?access_token=".$access_token;
	$jsonData='{
					"recipient":{
						"id":"'.$sender.'"
					},
					"message":{
						"text":"'.$message_to_reply.'"
					}
				 
				}';
	$ch=curl_init($url);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$jsonData);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_HTTP_VERSION,CURLOPT_HTTP_VERSION_NONE);
	$result=curl_exec($ch);
	curl_close($ch);
	
}	


?>