#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

global $argv;

function createV($machine)
{
	$client = new rabbitMQClient("testRabbitMQ.ini","deployServer");

	//$newVNum = chkV($machine);
	//shell_exec('.package.sh'.$machine.''.$newVNum);
	//hardcoding machine and version num for testing
	$machine = "fe";
	$newVNum = "2";
	shell_exec('.package.sh'.$machine.' '.$newVNum);
	
	$request = array();
	$request['type'] = "newPackage";
	$request['machine'] = $machine;
	$request['version'] = $newVNum;
	$request['packageName'] = $machine.'_'.$newVNum.'.tar';

	$client->send_request($request);
}
$machineType = $argv[1];
echo "creating new verison for ".$machineType.PHP_EOL;
createV($machineType);
echo "New version created".PHP_EOL;
?>
