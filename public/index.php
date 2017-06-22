<?php
define("LINE_MESSAGING_API_CHANNEL_SECRET", 'd70a1ad9a1ddbf18a424e57f1ac7189b');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'azhOgvmQZx99y8Q7vKKy8j6e6jen32Nv8RzXEwg9m3hXjSkjKxReFGaR6NuOmxfWhFPzTzCx4nlq4z3majk6GJSrFyMLBK7ldH3BA8um6DLUNqzjjTw0RFHHWzT1WL9SldHUWx14RFArKP0BUBmKGQdB04t89/1O/w1cDnyilFU=');

require_once(__DIR__ . "/../vendor/autoload.php");

$bot = new \LINE\LINEBot(
    new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN),
    ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]
);
$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$body = file_get_contents("php://input");
$events = $bot->parseEventRequest($body, $signature);
foreach ($events as $event) {
    // if ($event instanceof \LINE\LINEBot\Event\FollowEvent) {
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => "http://61.63.6.146/cms/lineuser/" . $event->getUserId(),
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => "",
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 30,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => "GET",
    //       CURLOPT_HTTPHEADER => array(
    //         "cache-control: no-cache",
    //         "postman-token: 111109d8-6f6d-d910-6b92-f4bd959201a6"
    //       ),
    //     ));
    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     curl_close($curl);
    //     if ($err) {
    //       echo "cURL Error #:" . $err;
    //     } else {
    //       echo $response;
    //     }
    // }
    
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
        $reply_token = $event->getReplyToken();
        $text = $event->getText();
        $bot->replyText($reply_token, $text);
    }
	
	if($event instanceof \LINE\LINEBot\Event\MessageEvent\ImageMessage) {
		// $client = new \GuzzleHttp\Client();
		$reply_token = $event->getReplyToken();
		$messageId = $event->message->id;
		// $client->get("https://api.line.me/v2/bot/message/$messageId/content", array('headers' => array(
			// 'Authorization' => "Bearer " . LINE_MESSAGING_API_CHANNEL_TOKEN
		// )));
		$bot->replyText($reply_token, "https://api.line.me/v2/bot/message/$messageId/content");
	}
}
echo "OK";