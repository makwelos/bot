<?php
$hubVerifyToken = 'myBusiness23';


$challenge = $_GET['hub_challenge'];
$verify_token = $_GET['hub_verify_token'];

if($hubVerifyToken === $verify_token){
echo $challenge;
exit;
}

$accessToken = "EAAHhOHJDpuQBAA1QDp81xnY2rZBZBrsN8BDMrZAtkG0ZCZAd1H2exR8tZA6Ec7Vxzo81vURNAynZAxgAf5ZBuiZAj2lcPdsksJJMJZA5DpdocMe2ZAOsW6qU2p3YapLfgSt645LVR0vjJJ8Ghut7y0ZAyDe8ZAbyWKq88uZBdIPk1PJc5qRodJPZAm67UMI4Eh4hoplh9gZD";

$response = file_get_contents('php://input');

file_put_contents("text.txt", $response);

?>