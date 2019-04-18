<?php

$myfile = fopen("log.txt","a+") or die ("file can not open");
$today = date("l jS \of F Y h:i:s A");
$success = "Successful log in";
fwrite($myfile,"* ".$today."\n".$success." for User:".$logs[0]." with Password:".$logs[1]."\n");
fcloser($myfile);	

?>
