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
		
	  /*
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
					
					//print "$counter: $value2, $key2 \n";i
				        //echo "$value2 and $key2".PHP_EOL;
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
         
          */
		//gets emails per business
		$emailsInBus   = array();
		$matchedProd   = array();
		$busNames      = array();
		$numEmails     = 0;

		//Get Emails	
		$statem = "SELECT email, businessID, bzname FROM business";
                $do     = mysqli_query($ishop, $statem) or die (mysqli_error($ishop));
		
		while($row = mysqli_fetch_array($do,MYSQLI_ASSOC))
		{	
			//return data/info;
			$email 	      = $row['email'];
			$bid   	      = $row['businessID'];
			$busName      = $row['bzname'];
			$emailsInBus += [$bid=>$email];
			array_push($busNames, $busName);

			$numEmails++;	
		}
		
		//echo "\n\nEmails in total is $numEmails\n\n\n";
		
		$cntName = 0;
		
		$keys = array_keys($busNames);

		foreach($emailsInBus as $i=>$e)
		{	
			$listOfProd = array();
			$numProd    = 0;
			
			//echo "$busNames[$cntName] is the name\n";
			
				
			//print "The email is $e\n";
		
			$st2 = "SELECT product, brand FROM businessinv WHERE businessID = '$i'";

			//print "The business id is BU00$i\n\n";

			$do2 = mysqli_query($ishop, $st2) or die (mysqli_error($ishop));
			
			if (!$do2){echo"Can't do query".PHP_EOL;}
			
			while($r = mysqli_fetch_array($do2))
			{
				$prod        = $r['product'];
				$brand       = $r['brand'];
				$listOfProd += [$prod=>$brand];
			}
		

			$output  = " ";

			$output .= "\n\nGreetings $busNames[$cntName],\n\n". "We have founds new recalls that need to be brought to your attention!\n\n\n";
			print "\n\nGreetings $busNames[$cntName],\n\n". "We have founds new recalls that need to be brought to your attention!\n\n\n";

			foreach($listOfProd as $prodPerBus=>$value1)
			{
				foreach($json as $jsonProd=>$value2)
				{
					if($prodPerBus==$jsonProd)
					{
						$numProd++;
						$matchedProd += [$prodPerBus=>$jsonProd];
						print "$numProd: $value2 --> $jsonProd\n";
					        $output .= "$numProd: $value2 --> $jsonProd\n";
					}

				}
			}

			
               		$subject = "You have new recalls!";
               		$headers = array('From: shaiddyperez@gmail.com' . "\r\n" );
               		$headers = implode("\r\n", $headers);

             		$output .= "\n\nWe will update your recalls and send you notification in a weekly basis\n";

			print "\n\nWe will update your recalls and send you notification in a weekly basis.\n";

			print "\nThank you for being an important piece at iShop for Business.\n";

			$output .= "\nThank  you for being an important piece at iShop for Business.\n";

                	mail($e, $subject, $output, $headers);
			
			echo "\n\n*****************************************************************************************\n\n";

			//echo "\nEmail sent to $e\n\n";
			//echo "\nEmail Sent!\n\n".PHP_EOL;
			$cntName++;
		}
	}	
			
?>
