#!/usr/bin/php
<?php
	notification ();


	function notification()
	{

		$ishop =  mysqli_connect("localhost","user1","user1pass","ishopdb");

		$business      = "SELECT businessinv.*, business.businessID 
				  FROM businessinv 
                                  LEFT OUTER JOIN business 
				  ON businessinv.businessID = business.businessID";
		$json 	       = "SELECT * FROM json";
		$r_json        = mysqli_query($ishop, $json) or die (mysqli_error($ishop));
		$num_rows_json = mysqli_num_rows($r_json);
		$r_business    = mysqli_query($ishop, $business) or die (mysqli_error($ishop));
		$num_rows_bus  = mysqli_num_rows($r_business);
		
		//empty arrays//
		$json 	 = array();
		$busInv  = array();        
		$matches = array();
		
		//getting info from json//
		while ($j = mysqli_fetch_array($r_json, MYSQLI_ASSOC))
		{
		        $pd     = $j['product_description'];
			$rf     = $j['recalling_firm'];
		        $res    = $j['reason_for_recall'];
		        $class  = $j['classification'];

			//storing  data in  json array
			$json += [$pd=>$rf];
		}

		//getting info from business//
		while ($b = mysqli_fetch_array($r_business,MYSQLI_ASSOC))
		{

			$pdn    = $b['product'];
			$br     = $b['brand'];

			//storing in busInv array
			$busInv += [$pdn=>$br];
		}
		
	
		$counter = 0;	
		foreach($busInv as $key=>$value)
		{
			foreach($json as $key2=>$value2)
			{
				//echo "$key and $key2 are the  key pair".PHP_EOL;
				if ($key == $key2)
				{
					//echo "THERES A MATCH".PHP_EOL;
					++$counter;
					$matches += [$value2=>$key2];
					//return $matches;
					//uncommented print below to see matches in terminal when running file manually
					//print "$counter: $value2, $key2 \n";i
				//	echo "$value2 and $key2".PHP_EOL;
				}

				else
				{
					continue;
					//echo "No MATCH".PHP_EOL;
				}
			}
		}

		foreach($matches as $value2 => $key2)
		{
			//echo"$value2 and $key2".PHP_EOL;
		}
         

		//gets emails per business
		$emailsInBus   = array();
		$matchedProd   = array();
		$numEmails     = 0;

		//Get Emails	
		$statem = "SELECT email, businessID FROM business";
                $do  = mysqli_query($ishop, $statem) or die (mysqli_error($ishop));
		
		while($row = mysqli_fetch_array($do,MYSQLI_ASSOC))
		{	
		
			
			//return $info;
			$email 	      = $row['email'];
			$bid   	      = $row['businessID'];
			$emailsInBus += [$bid=>$email];

			$numEmails++;

			foreach($emailsInBus as $i=>$e)
			{	
				$listOfProd = array();
				$numProd    = 0;
				
					
//				print "The email is $e\n";
			
				$st2 = "SELECT product, brand FROM businessinv WHERE businessID = '$i'";

//				print "The id is $i\n";

				$do2 = mysqli_query($ishop, $st2) or die (mysqli_error($ishop));
				
				if (!$do2){echo"Can't do query".PHP_EOL;}
				
				while($r = mysqli_fetch_array($do2))
				{
					$prod        = $r['product'];
					$brand       = $r['brand'];
					$listOfProd += [$prod=>$brand];
				}
			
		
				
				foreach($listOfProd as $prodPerBus=>$value1)
				{
					foreach($json as $jsonProd=>$value2)
					{
						if($prodPerBus==$jsonProd)
						{
							$numProd++;
							$matchedProd += [$prodPerBus=>$jsonProd];
					//		print "$numProd: $value2 --> $jsonProd\n";
						}

					}
				}

				echo "\nEmail Sent!\n\n".PHP_EOL;
				echo "Emails in total is $numEmails\n";
			}
		}	
	}
			/*	$perUser = array();
				if($product == $value)
				{
					//$output .= "$cnt: $value\n";
					array_push($perUser,$value);
				}
			}
		
			echo "$output\n";
/*		
			$output  = " ";
               		$subject = "You have new recalls!";
               		$headers = array('From: emadtirmizi@gmail.com' . "\r\n" );
               		$headers = implode("\r\n", $headers);

             		$output .= "\n\nGreetings,\n\n". "We have founds new recalls that need to be brought to your attention!\n\n";


                	mail($email, $subject, $output, $headers);

                	echo "\nMail Sent!".PHP_EOL;
		}




/*	$IDs = array();
	$i=0;
	foreach($matches as $value)
	{
		//get ID from matches
		echo "$value in id area".PHP_EOL;
		$get = "SELECT businessID FROM businessinv where product = '$value'";
		$getid = mysqli_query($ishop, $get) or die (mysqli_error($ishop));
		//put id in array
		while ($i = mysqli_fetch_array($getid, MYSQLI_ASSOC))
                {
			$id     = $i['businessID'];
			$IDs	+= [$id];
			echo"$id".PHP_EOL;
			$i++;
		}		
		
	}

	//foreach($IDs as $id)
	//	echo "$id\n";
	
		
		//use id array to get emails
		$gemail = "SELECT email FROM business WHERE businessID = $id";
		$getemail = mysqli_query($ishop, $gemail) or die (mysqli_error($ishop));
		while ($e = mysqli_fetch_array($getemail, MYSQLI_ASSOC))
		{
			$email	=	$e['email'];
			$emails	+=	$email;
		}
	}
	foreach($email as $emails)
	{

		$output  = " ";
                $subject = "You have new recalls!";
                $headers = array('From: emadtirmizi@gmail.com' . "\r\n" );
                $headers = implode("\r\n", $headers);

                $output .= "\n\nGreetings,\n\n". "We have founds new recalls that need to be brought to your attention!\n\n";

                $cnt = 0;
                foreach($IDs as $id=>$value1)
		{
			foreach($matches as $key=>$value2)
			{
				if($value1==$key)
				{
					
					$cnt++;
					$output .= "$cnt: $key, $value2\n";
				}
				else
				{
                                        continue;
                                        //echo "Nothing to see here".PHP_EOL;
                                }

			}
		}

                echo "$output\n";

                mail($email, $subject, $output, $headers);

                echo "\nMail Sent!".PHP_EOL;
	}

		$output  = " ";
		$subject = "You have new recalls!";
		$headers = array('From: shaiddyperez@gmail.com' . "\r\n" );
		$headers = implode("\r\n", $headers);
	       
		$output .= "\n\nGreetings,\n\n". "We have founds new recalls that need to be brought to your attention!\n\n";
		
		$cnt = 0;
		foreach($matches as $key=>$value)
		{	
			$cnt++;
			$output .= "$cnt: $key, $value\n";
		}

		echo "$output\n";

		mail($email, $subject, $output, $headers);

		echo "\nMail Sent!".PHP_EOL;
 */
?>
