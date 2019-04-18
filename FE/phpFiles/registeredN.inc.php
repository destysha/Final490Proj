<?php
        $myfile = fopen("log.txt","a+") or die ("file can not open");
        $today = date("l jS \of F Y h:i:s A");
	$fail = "Account Already Exists with";
        fwrite($myfile,"** ".$today."\n".$fail." User:".$logs[0]."\n");
        fcloser($myfile);       
?>

