#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('login2.php.inc');

function doLogin($username,$password)
{
	//get username password
	
	$login = new loginDB();
	return  $login->validateLogin($username,$password);
	//return flase if not valid
}	


function doRegister($username,$bzname,$street,$city,$state,$zipcode,$email,$password)
{
	$register = new loginDB();
	return $register->validateRegister($username,$bzname,$street,$city,$state,$zipcode,$email,$password);
}

function doInfo($username)
{
	$info = new loginDB();
	return $info->getInfo($username);
}

function getInv($username,$sql)
{
	$db = mysqli_connect("localhost","user1","user1pass","ishopdb");
	$runQ = mysqli_query($db,$sql);
	$queryBack = mysqli_num_rows($runQ);

	if ($queryBack > 0 )
	{
		while($row = mysqli_fetch_assoc($runQ))
		{
			$temp[] = $row;
		}
//		print_r($temp);
		return $temp;
	}

}

function doUpdate($bID,$grp_id)
{
	$db = mysqli_connect("localhost","user1","user1pass","ishopdb");
        $q1 = "SELECT * FROM ishopinv WHERE grp_id = '$grp_id'";        
        $Q = mysqli_query($db,$q1);
		
	$com =  mysqli_fetch_array($Q)	;
	$pro = $com['name'];
	$bra = $com['brand'];	
        $qty = "1";
	
	$q2 = "INSERT INTO businessinv (brand,product,qty,businessID) VALUES('$bra','$pro','$qty','$bID')";
	$Q2 = mysqli_query($db,$q2);
	echo" Added- ' $bra: $pro ' To businessinv".PHP_EOL;
}

function doDelete($id)
{
$db = mysqli_connect("localhost","user1","user1pass","ishopdb");
        $q = "DELETE FROM businessinv WHERE id = $id";
	 echo "received request to Delete ID: $id".PHP_EOL;
$Q = mysqli_query($db,$q);
return 1;
}

function getIshop($ql)
{
	$db = mysqli_connect("localhost","user1","user1pass","ishopdb");
	echo "received request to get Ishop inventory".PHP_EOL;
	$qq = mysqli_query($db,$ql);
	
	 $Back = mysqli_num_rows($qq);

        if ($Back > 0 )
        {
                while($row = mysqli_fetch_assoc($qq))
                {
                        $tem[] = $row;
                }
//		print_r($tem);
                return $tem;
	}
}

function getOp($que)
{
	 $db = mysqli_connect("localhost","user1","user1pass","ishopdb");
        echo "received Request FOR OPT's".PHP_EOL;
        $Q = mysqli_query($db,$que);
	$co = 30;
//	$co = mysqli_num_rows($Q);
	if($co > 0)
	{
		while ($row = mysqli_fetch_assoc($Q))
		{
			$T[] = $row;
//			print_r($T).PHP_EOL;
		}
		return $T;
	}
}

function requestProcessor($request)
{
  	echo "received request".PHP_EOL;
	var_dump($request);

  	if(!isset($request['type']))
  	{
    	 return "ERROR: unsupported message type";
 	}
  	switch ($request['type'])
  	{
    	case "login":
      		return doLogin($request['username'],$request['password']);
	case "register":
		return doRegister($request['username'],$request['bzname'],$request['street'],$request['city'],$request['state'],$request['zipcode'],$request['email'],$request['password']);
	
	case "info":
		return doInfo($request['username']);
	case "inv":
		return getInv($request['username'],$request['sql']);
	 case "update":
              return doUpdate($request['bID'],$request['grp_id']);
	case "delete":
		return doDelete($request['id']);
	case "Ishop":
                return getIshop($request['sql']);
	 case "Op":
                return getOp($request['que']);
	case "validate_session":
		return doValidate($request['sessionId']);
	}
	return array("returnCode" =>'0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();

?>
