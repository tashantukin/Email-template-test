<?php

include 'callAPI.php';
include 'admin_token.php';

$baseUrl = getMarketplaceBaseUrl();
$admin_token = getAdminToken();
$customFieldPrefix = getCustomFieldPrefix();


$contentBodyJson = file_get_contents('php://input');
$content = json_decode($contentBodyJson, true);

$userId = $content['userId'];
$title = $content['title'];
$contents = $content['content'];
$subject = $content['subject'];
$urls = $content['pageURL'];
$descsription = $content['description'];
$type =$content['type'];

//*save template contents inside a custom table -- Name: Templates
$template_details = array('title' => $title, 'contents' => $contents, 'subject' => $subject, 'description' => $description , 'category' => $type);
$url =  $baseUrl . '/api/v2/plugins/'. getPackageID() .'/custom-tables/Templates/rows';
$result =  callAPI("POST",$admin_token['access_token'], $url, $template_details);

echo json_encode(['contents' => $result ]);

