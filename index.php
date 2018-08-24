<?php
$access_token = 'DSk1ozKRG2lD2n2NMmJS1D0axWBbfYS9yqg6VFw7swaa6PWw4cL+dbTBaJxBuHJ/byI5y79ikuPS85wNdXvZO8Dg9c5NBaYwoUzPoTi5M4SRgL6NHQm1V/3SnawGdtRpehsmv+hBCDHTaeDJAlbCbQdB04t89/1O/w1cDnyilFU=';
// Get POST body 
content$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON 
dataif (!is_null($events['events'])) 
{	
// Loop through each event	
foreach ($events['events'] as $event) 
{		
// Reply only when message sent is in 'text' format		
if ($event['type'] == 'message' && $event['message']['type'] == 'text') 
{			
// Get text sent			
$text = $event['message']['text'];			
// Get replyToken			
$replyToken = $event['replyToken'];			
// Build message to reply back			
$messages = [				'type' => 'text',				'text' => $text			];			
// Make a POST Request to Messaging API to reply to sender			
$url = 'https://api.line.me/v2/bot/message/reply';			
$data = [				'replyToken' => $replyToken,				'messages' => [$messages],			];			
$post = json_encode($data);			
$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);			
$ch = curl_init($url);			
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");			
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);			
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);			
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);			
$result = curl_exec($ch);			
curl_close($ch);			
echo $result . "";		
}	
}
}
echo "OK";
