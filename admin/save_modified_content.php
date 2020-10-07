<?php
include 'callAPI.php';
include 'admin_token.php';
$contentBodyJson = file_get_contents('php://input');
$content = json_decode($contentBodyJson, true);
$timezone = $content['timezone'];
$timezone_name = timezone_name_from_abbr("", $timezone * 60, false);
date_default_timezone_set($timezone_name);
$pageId = $content['pageId'];
$userId = $content['userId'];
$title = $content['title'];
$contents = $content['content'];

$fh = fopen('templates/' . $pageId, 'w');

fwrite($fh, $contents);
fclose($fh);

$htmlContent = file_get_contents(realpath('templates/' . $pageId));

echo json_encode(['contents' => $htmlContent]);
