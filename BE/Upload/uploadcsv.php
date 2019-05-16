#!/usr/bin/php
<?php

	$file = exec('./getFile.sh');

	$lines = file("./File/$file");

	$conn = mysqli_connect("localhost","user1","user1pass","ishopdb");

	foreach($lines as $line)
	{
		$data[] = explode(',', $line);
		
	}

	foreach($data as $row)
	{
		$product = addslashes($row[0]);
		$brand   = addslashes($row[1]);
		$qty 	 = addslashes($row[2]);

		$sqlInsert = "INSERT into businessinv (brand,product,qty,businessID)
			      values ('$product','$brand','$qty','5')";

		$Q = mysqli_query($conn,$sqlInsert);

		//print"Product: $product --> Brand: $brand ---> Qty: $qty \n";
	}

?>
