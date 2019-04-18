<?php
	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');

	//$client = new rabbitMQClient("testRabbitMQ.ini","testServer");


	function login ( $username, $password  )
	{
		$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

		$request = array();
		$request['type'] = "login";
		$request['username'] = $username;
		$request['password'] = $password;
		//$request['message'] = $answer;
		$response = $client->send_request($request);
		
		//$response = $client->publish($request);

		echo "client received response: ".PHP_EOL;
		
		//print_r($response);
		//echo "\n\n";

		//echo $argv[0]." END".PHP_EOL;
		
		return $response;

	}

function register ($username,$bzname,$street,$city,$state,$zipcode,$email,$password  )
	{
		$request2 = array();
		$request2['type'] = "register";
		$request2['username'] = $username;
		$request2['bzname'] = $bzname;
		$request2['street'] = $street;
		$request2['city'] = $city;
		$request2['state'] = $state;
		$request2['zipcode'] = $zipcode;
		$request2['email'] = $email;
		$request2['password'] = $password;

		$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
		$response = $client->send_request($request2);
		
		echo "client received response for registration: ".PHP_EOL;

		return $response;
	}



function info($username)
{
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
	$request3 = array();
	$request3['type'] ="info";
	$request3['username'] = $username;
	$response = $client->send_request($request3);
                return $response;
}

function fetchInv($username,$sql)
{
        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
        $request4 = array();
        $request4['type'] ="inv";
	$request4['username'] = $username;
	$request4['sql']=$sql;
        $response = $client->send_request($request4);
                return $response;
}

function update($bID,$grp_id)
{
        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
        $request5 = array();
        $request5['type'] ="update";
        $request5['bID'] = $bID;
	$request5['grp_id'] = $grp_id;

        $response = $client->send_request($request5);

//                return $response;

}

function del($id)
{
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
        $request6 = array();
        $request6['type'] ="delete";
	$request6['id'] = $id;

	$response = $client->send_request($request6);
		return $response;
}

function getIshop($ql)
{
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
        $request7 = array();
        $request7['type'] ="Ishop";
        $request7['sql'] = $ql;

        $response = $client->send_request($request7);
                return $response;
}

function getOp($que)
{
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
        $request8 = array();
        $request8['type'] ="Op";
        $request8['que'] = $que;

        $response = $client->send_request($request8);
                return $response;
}
?>
