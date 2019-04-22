#!/usr/bin/php
<?php
	
	session_start();

	include ("php/connectDB2.php");
	$bID = $_SESSION['bID'];
	
	if (isset($_POST["import"])) 
	{

		$fileName = $_FILES["file"]["tmp_name"];

		if ($_FILES["file"]["size"] > 0) 
		{

			$file = fopen($fileName, "r");

			while (($column = fgetcsv($file, 50000, ",")) !== FALSE) 
			{
				$conn      = mysqli_connect("10.0.2.11","user1","user1pass","ishopdb");
				$sqlInsert = "INSERT into businessinv (brand,product,qty,businessID)
				              VALUES ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "')";
				
				$result    = mysqli_query($conn, $sqlInsert);

				if (empty($result)) 
				{
					$type = "success";
					$message = "CSV/Excel Data Imported into the Database";
					header('Location: ../businessInv.php?status=success');
					return $message;
					exit;
				} 
				else 
				{
					$type = "error";
					$message = "Problem in Importing CSV Data";
					echo "<script type='text/javascript'>alert('$message');</script>";
					header('Location: ./upload.php?status=error');
					return $message;
					exit;
				}
			}
		}
	}
?>
