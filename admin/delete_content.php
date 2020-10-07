<?php
include 'callAPI.php';
include 'admin_token.php';
$contentBodyJson = file_get_contents('php://input');
$content = json_decode($contentBodyJson, true);
$page_id = $content['pageId'];
error_log('page id ' . $page_id);
$userId = $content['userId'];
$baseUrl = getMarketplaceBaseUrl();
$admin_token = getAdminToken();
$customFieldPrefix = getCustomFieldPrefix();

$file_pointer = realpath('templates/' . $page_id);
echo json_encode(['path' => $file_pointer]);

// Use unlink() function to delete a file  
unlink($file_pointer);

// $url = $baseUrl . '/api/v2/content-pages/' . $page_id;
// $result = callAPI("DELETE", $admin_token['access_token'], $url);
