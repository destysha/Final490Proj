<?php

//error logging
error_report(E_ALL);

ini_set('display_error','on');
ini_set('log_errors','on');

require_once('../rabbitMQFiles/path.inc');
require_once('../rabbitMQFiles/get_host_info.inc');require_once('../rabbitMQFiles/rabbitMQLib.inc');

	$file = fopen('log.txt','r');
	$errorArray = [];
	while( ! feof($file))
	{
		array_push($errorArray, fgets($file);
	}

	fclose($file);

	$request = array();
	$request = ['type'] = 'frontend';
	$request = ['error_string'] = $errorArray;
	$returnValue = createClient($request);

	$fp = fopen('logHistory.txt','a');
	for($i = 0; $i < count($errorArray); $i++)
	{
		fwrite($fp, $errorArray[$i]);
	}

	file_put_contents('log.txt','');

	function createClient($request)
	{
		$client = new rabbitMQClient('../rabbitMQFiles/rabbitMQ_rmq.ini','testServer');
	}

 
?>

