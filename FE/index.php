<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>iShop Login and Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		    <link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <section>
                <div id="container_demo" >
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                    
		<div id="wrapper">
                       


			<div id="login" class="animate form">
                            <form  action="phpFiles/login.php" method="POST" autocomplete="on">

                                <h1 id="company">iShop Online Store</h1>
                                <h1 class="titles">Log in</h1>
			<!--Error messages go here-->
			<?php
				//first method
                                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                if (strpos($fullUrl,"login=error")==true)
                                {
                                        echo "<h3 class='error'> Username & Password Did not Match </h3>";
                                }
                                elseif (strpos($fullUrl,"login=nosubmit")==true)
                                {
                                        echo "<h3 class='error'>YOU DID NOT CLICK SUBMIT ! </h3>"; 
                                }
				elseif (strpos($fullUrl,"register=nosuccess")==true)
                                {
                                        echo "<h3 class='error'>Sorry, Could not Register ! </h3>";
                                }
				elseif (strpos($fullUrl,"register=success")==true)
                                {
                                        echo "<h3 class='error'>Account Register ! </h3>";
                                }
       				 //end first method
			?>
		
                                <p>
                                    <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                                </p>
                                <p>
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" />
                                </p>
                                <p class="keeplogin">
                			<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
                			<label for="loginkeeping">Keep me logged in</label>
								                </p>
                                <p class="login button">
                                    <input type="submit" name="submit" value="Login" />
								                </p>
                                <p class="change_link">
					Not a member yet ?
					<a href="#toregister" class="to_register">Join us</a>
				</p>
                              </form>
                        </div>



                        <div id="register" class="animate form">

                            <form  action="phpFiles/register.php" method="POST" autocomplete="on">       
		         <h1 class="titles">Sign up </h1>
                                 <!--Error messages go here-->
                        <?php
                                //first method
                                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                if (strpos($fullUrl,"register=success")==true)
                                {
                                        echo "<h3 class='error'> Username Registered </h3>";
                                }
                                elseif (strpos($fullUrl,"register=nosuccess")==true)
                                {
                                        echo "<h3 class='error'>Sorry, Could not Register ! </h3>";
                                }
                                 //end first method
                        ?>
				<p>
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" />
                                </p>
				<p>
                                    <label for="bznamesignup" class="uname" data-icon="u">Business Name</label>
                                    <input id="bznamesignup" name="bznamesignup" required="required" type="text" placeholder="Business Name" />
                                </p>

				<p>
                                    <label for="streetsignup" class="uname" data-icon="e" > Your Street Address</label>
                                    <input id="streetsignup" name="streetsignup" type="text" required="required" placeholder="123 Central ave"/>
                                </p> 
				<p>
                                    <label for="citysignup" class="uname" data-icon="e" > City </label>
                                    <input id="citysignup" name="citysignup"  type="text" required="required" placeholder="Newark"/>
                                </p>
				<p>
                                    <label for="statesignup" class="uname"> State </label>
                                    <select id="statesignup" name="statesignup" required="required" />
	<option value="empty" selected>Pick One</option>
	<option value="AL">AL</option>
	<option value="AK">AK</option>
	<option value="AR">AR</option>	
	<option value="AZ">AZ</option>
	<option value="CA">CA</option>
	<option value="CO">CO</option>
	<option value="CT">CT</option>
	<option value="DC">DC</option>
	<option value="DE">DE</option>
	<option value="FL">FL</option>
	<option value="GA">GA</option>
	<option value="HI">HI</option>
	<option value="IA">IA</option>	
	<option value="ID">ID</option>
	<option value="IL">IL</option>
	<option value="IN">IN</option>
	<option value="KS">KS</option>
	<option value="KY">KY</option>
	<option value="LA">LA</option>
	<option value="MA">MA</option>
	<option value="MD">MD</option>
	<option value="ME">ME</option>
	<option value="MI">MI</option>
	<option value="MN">MN</option>
	<option value="MO">MO</option>	
	<option value="MS">MS</option>
	<option value="MT">MT</option>
	<option value="NC">NC</option>	
	<option value="NE">NE</option>
	<option value="NH">NH</option>
	<option value="NJ">NJ</option>
	<option value="NM">NM</option>			
	<option value="NV">NV</option>
	<option value="NY">NY</option>
	<option value="ND">ND</option>
	<option value="OH">OH</option>
	<option value="OK">OK</option>
	<option value="OR">OR</option>
	<option value="PA">PA</option>
	<option value="RI">RI</option>
	<option value="SC">SC</option>
	<option value="SD">SD</option>
	<option value="TN">TN</option>
	<option value="TX">TX</option>
	<option value="UT">UT</option>
	<option value="VT">VT</option>
	<option value="VA">VA</option>
	<option value="WA">WA</option>
	<option value="WI">WI</option>	
	<option value="WV">WV</option>
	<option value="WY">WY</option>
</select>	
                                </p>
				<p>
                                    <label for="zipcodesignup" class="uname" data-icon="u">Zipcode</label>
                                    <input id="zipcodesignup" name="zipcodesignup" required="required" type="text" placeholder="Zipcode" />
                                </p>

  				<p>
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/>
                                </p> 
                                <p>
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p>
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p class="signin button">
				    <input type="submit" name="submit" value="Sign up"/>
			        </p>
                                
				<p class="change_link">
		                   Already a member ?
		                   <a href="#tologin" class="to_register"> Go and log in </a>
				</p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
