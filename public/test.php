<?php
define("LINE_MESSAGING_API_CHANNEL_SECRET", 'd70a1ad9a1ddbf18a424e57f1ac7189b');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'azhOgvmQZx99y8Q7vKKy8j6e6jen32Nv8RzXEwg9m3hXjSkjKxReFGaR6NuOmxfWhFPzTzCx4nlq4z3majk6GJSrFyMLBK7ldH3BA8um6DLUNqzjjTw0RFHHWzT1WL9SldHUWx14RFArKP0BUBmKGQdB04t89/1O/w1cDnyilFU=');

require_once(__DIR__ . "/../vendor/autoload.php");
		$client = new \GuzzleHttp\Client();
		$res = $client->get("https://api.line.me/v2/bot/message/6277341612783/content", array('headers' => array(
			'Authorization' => "Bearer " . LINE_MESSAGING_API_CHANNEL_TOKEN
		)));
		var_dump($res);
		die();
		
		$path = "tmp/" . uniqid(rand(), true) . '.png';
		$file = fopen($path, "w+");
		fwrite($file, $res->getBody());
		fclose($file);
		$QRCodeReader = new Libern\QRCodeReader\QRCodeReader();
		$qrcode_text = $QRCodeReader->decode("ih5njlT937.png");
		echo $qrcode_text;
		