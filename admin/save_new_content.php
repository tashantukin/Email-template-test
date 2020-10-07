<?php
$contentBodyJson = file_get_contents('php://input');
$content = json_decode($contentBodyJson, true);

$userId = $content['userId'];
$title = $content['title'];
$contents = $content['content'];
$urls = $content['pageURL'];

$fh = fopen('templates/' . $title . '.html', 'w');

fwrite($fh, $contents);
fclose($fh);

$htmlContent = file_get_contents(realpath('templates/' . $title . '.html'));

echo json_encode(['contents' => $htmlContent]);
