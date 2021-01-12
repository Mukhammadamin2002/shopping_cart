<?php 
function prettyDump($variable, $exit = false){
	echo "<pre>";
	var_dump($variable);
	echo "<pre>";

	if ($exit) {
		exit;
	}

}


function send_tg_msg($message) {
	$chat_id = '1141094283';
	$url = 'https://api.telegram.org/bot1540260685:AAEKRwmDQo2QflZ9lDpCo5KsUVQsS89wvHo/sendMessage';

	$data = [
		'chat_id' => $chat_id,
		'text' => $message
	];

	$options = array('http' => array(

		'method' => 'POST',
		'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
		'content' => http_build_query($data)

	)
);

	$context = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

	// echo $result;

}

?>