<?php
include 'callAPI.php';
include 'admin_token.php';
$contentBodyJson = file_get_contents('php://input');
$content = json_decode($contentBodyJson, true);

$baseUrl = getMarketplaceBaseUrl();
$admin_token = getAdminToken();
$userToken = $_COOKIE["webapitoken"];
$url = $baseUrl . '/api/v2/users/';
$result = callAPI("GET", $userToken, $url, false);
$userId = $result['ID'];

$content =  "<h4 style=\"color:blue\"><span style=\"color:#000000;\">Hi&nbsp; </span>{{ Buyer Name }},</h4>\n\n<h4 style=\"color:blue\"><span style=\"color:#000000;\">We&#39;ve received your Order! </span></h4>\n\n<h4 style=\"color:blue\"><span style=\"color:#000000;\">From </span>{{ Merchant Name }}</h4>\n";

$url = $baseUrl . '/api/v2/users/';
$result = callAPI("GET", $admin_token['access_token'], $url, false);
error_log('admin ' . json_encode($result));
$admin_id = $result['ID'];
error_log('admin id ' . $admin_id);

$token = array(
    'Buyer Name'  => 'TASH MARUSKA',
    'Merchant Name' => 'Moly',
    'Invoice ID' => 'FJSLFJ534095LK',
    'Total Amount' => '$70.00'
);
$pattern = '{{ %s }}';
foreach ($token as $key => $val) {
    $varMap[sprintf($pattern, $key)] = $val;
}

$emailContent = strtr($content, $varMap);


$data = [
    'From' => 'natasha@arcadier.com',
    'To' =>  'nmfnavarro@gmail.com',
    'Subject' => 'test email from template',

    'Body' =>  $emailContent
];

$url =  $baseUrl . '/api/v2/admins/' . $admin_id . '/emails';
$sendEDM = callAPI("POST", $admin_token['access_token'], $url, $data);
echo json_encode(['result' => $sendEDM]);
