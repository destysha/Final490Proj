<?php

	session_start();
	require ('../rabbitMQFiles/testRabbitMQClient.php');
	$username = $_SESSION ['username'];

	//Getting related to business account based on whose logged in session//

	$res = info($username);
	$ans = array();
	foreach ($res as $i)
	{
		//echo"<br>".$i."<br>";
		array_push($ans,$i);
	}

	$bID 	 = $ans[0];
	$user 	 = $ans[1]; 
	$bzname  = $ans[2]; 
	$street  = $ans[3];  
	$city 	 = $ans[4]; 
	$state 	 = $ans[5]; 
	$zipcode = $ans[6]; 
	$email   = $ans[7];

	//STORING INTO SESSION//
	$_SESSION ['bID'] 	= $bID;
        $_SESSION ['bzname'] 	= $bzname;
	$_SESSION ['street'] 	= $street;
	$_SESSION ['city'] 	= $city;
	$_SESSION ['state'] 	= $state;
	$_SESSION ['zipcode'] 	= $zipcode;
	$_SESSION ['email'] 	= $email;

?>
