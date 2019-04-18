<?php
	session_start();
	#contains login client function
	require ('../rabbitMQFiles/testRabbitMQClient.php');

	//will hold values for logging
	$logs = array();

	//check if user entered correctly, by clicking submit button
	if(isset($_POST['submit']))
	{
		//get user input and send info to Client.php
		$username = $_POST['username'];
    		$password = $_POST['password'];
    		$response = login ( $username, $password );

		//login successful or not?
		//log result
		if ( $response != false ) //username and pass match
		{
			$_SESSION['logged'] = true;
			$_SESSION['username'] = $username;

			array_push( $logs, $username, $password) ;
			header  ( 'location:../userInterface/index.php' );
			require("successF.inc.php");
		}

		//username and pass no match
		else
    {
	  	array_push( $logs, $username, $password);
	  	header  ( 'location:../index.php?login=error' );
	  	require("errorF.inc.php");
			exit();
	 	}
	}

	//user did not click submit in form
	else
	{
    header  ( 'location:../index.php?login=nosubmit' );
		exit();
	}

?>
