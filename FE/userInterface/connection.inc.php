<?php
$conn = mysqli_connect("localhost","user1","user1pass","SampleShop");
                if($conn->connect_error)
                {
                        die("connection error:".$conn->connect_error);
                }       
		else{
		echo"Connected to DataBase";
		}	
?>

