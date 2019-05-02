#!/usr/bin/php
<?php
	$target_dir = "/var/www/ishop/userInterface/uploads/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	

	// Check if file already exists
	if (file_exists($target_file)) {
	    	//echo "Sorry, file already exists.";
		$uploadOk = 0;
		header('location:../toUpload.php?status=error5');
		exit;
	}


	// Check file size
	elseif ($_FILES["fileToUpload"]["size"] > 500000) {
	    	//echo "Sorry, your file is too large.";
	    	$uploadOk = 0;
	    	header('location:../toUpload.php?status=error1');
		exit;
	}


	// Allow certain file formats
	elseif($fileType != "csv" && $fileType != "xlsx" ) {
	   	//echo "Sorry, only CSV file extension is allowed.";
	    	$uploadOk = 0;
	    	header('location:../toUpload.php?status=error2');
		exit;
	}


	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk != 0) {

		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			shell_exec("sendcsv.sh");
			header('location:../toUpload.php?status=success');
		} 
		else {
			//echo "Sorry, there was an error uploading your file.";
			header('location:../toUpload.php?status=error4');
		}
	}

	/*
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		header('location:../toUpload.php?status=error3');
		//if everything is ok, try to upload file
		exit;
	} 

	else {
	 	
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			//shell_exec("sendcsv.sh");
			header('location:../toUpload.php?status=success');
		} 
		else {
			//echo "Sorry, there was an error uploading your file.";
			header('location:../toUpload.php?status=error4');
		}
	}
	*/
?>
