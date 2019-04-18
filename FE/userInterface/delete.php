<?php
session_start();

require ('../rabbitMQFiles/testRabbitMQClient.php');
$username = $_SESSION ['username'];
/*
$res = info($username);
        $ans = array();
        foreach ($res as $i)
        {
//              echo"<br>".$i."<br>";
                array_push($ans,$i);
        }
        $bID = $ans[0];
        $user = $ans[1];
        $bzname =$ans[2];
        $street = $ans[3];
        $city = $ans[4];
        $state = $ans[5];
        $zipcode = $ans[6];
	$email = $ans[7];
*/
	if(isset($_GET['delete']))
	{
		$id = $_GET['delete'];
	echo"$id".PHP_EOL;
		$del = del($id);
		header('location:businessInv.php');
	}
?>
