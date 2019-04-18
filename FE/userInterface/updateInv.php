<?php
session_start();

                //STORING INTO SESSION//
   $bID     =  $_SESSION ['bID'];
 //  $bzname  =  $_SESSION ['bzname'];
 //  $street  =  $_SESSION ['street'];
 //  $city    =  $_SESSION ['city'];
 //  $state   =  $_SESSION ['state'];
 //  $zipcode =  $_SESSION ['zipcode'];
 //  $email   =  $_SESSION ['email'];
 //  $username = $_SESSION ['username'];

require ('../rabbitMQFiles/testRabbitMQClient.php');


if(isset($_GET['add']))
        {
                $grp_id = $_GET['add'];
        echo"$id".PHP_EOL;
                $Update = update($bID,$grp_id);
                header('location:ishopInv.php');
        }

?>
