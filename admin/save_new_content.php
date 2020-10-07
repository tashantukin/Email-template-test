<?php
include 'callAPI.php';
include 'admin_token.php';
$contentBodyJson = file_get_contents('php://input');
$content = json_decode($contentBodyJson, true);
$timezone = $content['timezone'];
$tz = date_default_timezone_get();
$timezone_name = timezone_name_from_abbr("", $timezone * 60, false);
date_default_timezone_set($timezone_name);
$timestamp = date("d/m/Y H:i");
$timestamp2 = $timezone * 60;

$userId = $content['userId'];
$title = $content['title'];
$contents = $content['content'];
$urls = $content['pageURL'];
// $isAvailbleTo = $content['availability'];
// $isVisibleTo = $content['visibility'];
// $metadesc = $content['metadesc'];
$shortURL = $content['pageURLshort'];
// $meta = array('title' => $title , 'desc'=> $metadesc);
$meta2 = ''; //json_encode($meta);
$stylepath = $content['stylesheet'];

$baseUrl = getMarketplaceBaseUrl();
$admin_token = getAdminToken();
$customFieldPrefix = getCustomFieldPrefix();

error_log('title ' . $title);

echo json_encode(['title' => $title]);

$fh = fopen('templates/' . $title . '.html', 'w');

fwrite($fh, $contents);
fclose($fh);

$htmlContent = file_get_contents(realpath('templates/' . $title . '.html'));

echo json_encode(['contents' => $htmlContent]);
