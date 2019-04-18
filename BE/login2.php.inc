<?php

class loginDB
{ //open class bracket
private $logindb;

	public function __construct()
	{//open _construct bracket
		$this->logindb = new mysqli("localhost","user1","user1pass","ishopdb");

		if($this->logindb->connect_errno !=0)
		{//open if bracket
			echo "error connecting to database: ".$this->logindb->connect_error.PHP_EOL;
			exit(1);
		}//close if bracket
		echo "correctly connected to database".PHP_EOL;
	}//close _construct bracket	

	
	public function validateLogin($username,$password)
	{//open validateLogin bracket
		$uname = $this->logindb->real_escape_string($username);
		$pass = $this->logindb->real_escape_string($password);
		$statement = "SELECT * FROM business WHERE username = '$uname' and password = '$pass' ";
		$response = $this->logindb->query($statement);
		echo "testing validateLogin ".PHP_EOL;
		while ( $row = $response->fetch_assoc() )
		{//open while loop bracket
			echo "checking if user $uname is in the database...\n";

			if($row['username'] == $uname)
			{//open if $row['username'] 
				echo "$uname is in the database. \n";
				//return 1;
			}//close if $row['username']
			else
			{//open else bracket for $uname in db
				echo "$un is not in the database. \n";
			}//close else bracket for $uname in db

			echo "checking password for $username".PHP_EOL;

			if($row['password'] == $pass)
			{//open bracket for checking pass
				echo"passwords match for $username".PHP_EOL;
				return 1;
			}//close bracket for checking pass

			echo "passwords did not match for $username".PHP_EOL;
			
		}//close while loop bracket
		return 0; //no users matched username
	}//close validateLogin bracket

	
	public function validateRegister($username,$bzname,$street,$city,$state,$zipcode,$email,$password)
	{//open bracket  validateRegister
		$uname = $this->logindb->real_escape_string($username);
		$businessName = $this->logindb->real_escape_string($bzname);
		$st=$this->logindb->real_escape_string($street);
		$ct=$this->logindb->real_escape_string($city);
		$stt=$this->logindb->real_escape_string($state);
		$zip = $this->logindb->real_escape_string($zipcode);
		$mail=$this->logindb->real_escape_string($email);
		$pass = $this->logindb->real_escape_string($password);
		$statement = "SELECT * FROM business WHERE username = '$uname' ";
		$response = $this->logindb->query($statement);

		if ( $response->num_rows == 0) //account doesnt exit, let them make one
		{//open if statement
			$statement = "INSERT INTO business (username,bzname,street,city,state,zipcode,email,password) VALUES('$uname','$businessName','$st','$ct','$stt','$zip','$mail','$pass') ";
			$this->logindb->query($statement) or die ($this->logindb->error);
			echo"Account created Successfully".PHP_EOL;
			return 1;
		}//close if statement
		else
		{//open else statement
			echo "Account already exists".PHP_EOL;
			return 0;
		}//close else statement
	}//close bracket ValidateRegister


	public function getInfo($username)
	{
		$uname = $this->logindb->real_escape_string($username);
		$statement = "SELECT * FROM business WHERE username = '$uname'";
		$response = $this->logindb->query($statement);
		
		//Response is and array format so we do this loop
		//reponse is hholding a value called user1 at the moment	
		
		foreach($response as $ans)
		{
			$username =  $ans;
		}
		return $username;

	}

	public function getinvB($username)
        {
                $uname = $this->logindb->real_escape_string($username);
                $statement = "SELECT * FROM businessinv WHERE username = '$uname'";
                $response = $this->logindb->mysqli_query($statement);
		
		$array = array('Ha','AH','EM','SH');
		foreach($array as $a)
		{
			return $a;
			echo"$a";
		}	
                //Response is and array format so we do this loop
              //c  while ($row = mysqli_fetch_assoc($response))
	//c	{
			
	//c		return $row;
	//c	}
	
			
        }

}//close class bracket 
?>
