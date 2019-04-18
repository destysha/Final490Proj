<?php

$myfile = fopen("log.txt","a+") or die ("file can not open");
$today = date("l jS \of F Y h:i:s A");
$fail = "Unsuccessful login";
fwrite($myfile,"* ".$today."\n".$fail." for User:".$logs[0]." Using Password:".$logs[1]."\n");
fcloser($myfile);	

?>
