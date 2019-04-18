<?php
    $connectDB = mysqli_connect("localhost", "user1", "user1pass", "ishopdb");

    if ( $connectDB->connect_error )
    {
      die ("Failed to connect to database: " . $connectDB->connect_error);
    } 
  
	$jsondata = file_get_contents("food-enforcement-0001-of-0001.json");

	$json = json_decode($jsondata, true);


	foreach($json['results'] as $results)
	{
		$classification 	= $results['classification'];
		$postal_code 		= $results['postal_code'];
		$city 			= $results['city'];
		$recalling_firm 	= $results['recalling_firm'];
		$state 			= $results['state'];
		$reason_for_recall	= $results['reason_for_recall'];
		$country 		= $results['country'];
		$product_description 	= $results['product_description'];

		$query ="INSERT INTO json SET
						classification = '".$results['classification']."',
						postal_code = '".$results['postal_code']."',
						city = '".$results['city']."',
						recalling_firm = '".$results['recalling_firm']."',
						state = '".$results['state']."',
						reason_for_recall ='".$results['reason_for_recall']."',
						country 		= '".$results['country']."',
						product_description 	= '".$results['product_description']."'";
		$execute_query = mysqli_query($connectDB, $query);

	}

?>
