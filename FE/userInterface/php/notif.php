#!/usr/bin/php
<?php

session_start();
$bzname   = $_SESSION["bzname"];
$email 	  = $_SESSION["email"];
$bID 	  = $_SESSION["bID"];
//$bID 	  = 1;

notification ($email, $bzname, $bID);


function notification($email, $bzname, $bID)
{

	$ishop =  mysqli_connect("localhost","user1","user1pass","ishopdb");

	$business      = "SELECT businessinv.*, business.businessID 
			  FROM businessinv 
                          LEFT OUTER JOIN business 
			  ON businessinv.businessID = business.businessID";
	$json 	       = "SELECT * FROM json";
	$r_json        = mysqli_query($ishop, $json) or die (mysqli_error($ishop));
	$num_rows_json = mysqli_num_rows($r_json);
	$r_business    = mysqli_query($ishop, $business) or die (mysqli_error($ishop));
	$num_rows_bus  = mysqli_num_rows($r_business);
	
	//empty arrays//
	$json 	     = array();
	$busInv      = array();        
	$matches     = array();
	$listOfProd  = array();
	$matchedProd = array();
	
	//getting info from json//
	while ($j = mysqli_fetch_array($r_json))
	{
	        $pd     = $j['product_description'];
		$rf     = $j['recalling_firm'];
	        $res    = $j['reason_for_recall'];
	        $class  = $j['classification'];

		//storing  data in  json array
		$json += array($pd=>$rf);
	}

	//getting info from business//
	while ($b = mysqli_fetch_array($r_business))
	{

		$pdn    = $b['product'];
		$br     = $b['brand'];

		//storing in busInv array
		$busInv += array($pdn=>$br);
	}



	#commented out
	/*
	$counter = 0;	
	foreach($busInv as $key=>$value)
	{
		foreach($json as $key2=>$value2)
		{
			//echo "$key and $key2 are the  key pair".PHP_EOL;
			if ($key == $key2)
			{
				//echo "THERES A MATCH".PHP_EOL;
				++$counter;
				$matches += [$value2=>$key2];
				//uncommented print below to see matches in terminal when running file manually
				//print "$counter: $value2, $key2 \n";
			}
			else
			{
				continue;
				//echo "No MATCH".PHP_EOL;
			}
		}
	}

	$output  = " ";
	
	$cnt = 0;
	foreach($matches as $key=>$value)
	{	
		$cnt++;
		$output .= "$cnt: $key, $value\n\n";
	}
	*/
	
	$businessInv   = "SELECT product, brand FROM businessinv WHERE businessID = '$bID'";
	$r_businessinv = mysqli_query($ishop, $businessInv) or die (mysqli_error($ishop));
	
	//if (!$r_businessinv){echo"Can't do query".PHP_EOL;}
	
	while( $r = mysqli_fetch_array($r_businessinv) )
	{
		$prod        = $r['product'];
		$brand       = $r['brand'];
		$listOfProd += array($prod=>$brand);
	}


	$output  = " ";

	$output .= "\n\nGreetings $bzname,\n\n";
	$output .= "We have found new recalls that need to be brought to your attention!\n\n";
	
	$numProd = 0;	

	foreach($listOfProd as $prodPerBus=>$value1)
	{	

		foreach($json as $jsonProd=>$value2)
		{
			if( $prodPerBus == $jsonProd )
			{
				$numProd++;
				$matchedProd += array($prodPerBus=>$jsonProd);
			        $output      .= "$numProd: $value2 --> $jsonProd\n\n";
			}

		}
	}

	$output .= "\n\nWe will update your recalls and send you notification in a weekly basis\n";
	$output .= "\nThank you for being an important piece at iShop for Business.\n";
	
	//echo "\n\n$output\n";
	
	//echo "\n\n**************************************************************************\n\n";

	$_SESSION['noti']    = $output;
	$_SESSION['noticnt'] = $numProd;
}
?>
