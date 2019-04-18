<?php
	$myfile = fopen("log.txt","a+") or die ("file can not open");
	$today = date("l jS \of F Y h:i:s A");
	$success = "Successfully Registered";
	
	fwrite($myfile,"** ".$today."\n".$success." User:".$logs[0]." with Email:".$logs[1]." and Password:".$logs[2]."\n");
	fcloser($myfile);       
?>
