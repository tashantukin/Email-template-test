<?php
include 'callAPI.php';
include 'admin_token.php';
$contentBodyJson = file_get_contents('php://input');
$content = json_decode($contentBodyJson, true);

$template = $content['template'];
$merchant_name = $content['merchantName'];
$buyer_name = $content['buyerName'];
$to = $content['to'];
$from = $content['from'];
$invoice_number = $content['invoice'];


$baseUrl = getMarketplaceBaseUrl();
$admin_token = getAdminToken();
$userToken = $_COOKIE["webapitoken"];
$url = $baseUrl . '/api/v2/users/';
$result = callAPI("GET", $userToken, $url, false);
$userId = $result['ID'];

// $total_amount = $content['template'];

$pageContent = file_get_contents(realpath('templates/' . $template));

$url = $baseUrl . '/api/v2/users/';
$result = callAPI("GET", $admin_token['access_token'], $url, false);
error_log('admin ' . json_encode($result));
$admin_id = $result['ID'];


//actual values should be fetched from API 

$token = array(
    'Buyer Name'  => $buyer_name != '' ? $buyer_name : '',
    'Merchant Name' => $merchant_name != '' ? $merchant_name : '',
    'Invoice ID' => $invoice_number != '' ? $invoice_number : ''
    // 'Total Amount' => '$70.00'
);
$pattern = '{{ %s }}';
foreach ($token as $key => $val) {
    $varMap[sprintf($pattern, $key)] = $val;
}

$emailContent = strtr($pageContent, $varMap);


$data = [
    'From' => $from,
    'To' =>  $to,
    'Subject' => 'test email from template',

    'Body' =>  $emailContent
];

$url =  $baseUrl . '/api/v2/admins/' . $admin_id . '/emails';
$sendEDM = callAPI("POST", $admin_token['access_token'], $url, $data);
echo json_encode(['result' => $sendEDM]);
