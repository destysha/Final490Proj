<?php
require ('../rabbitMQFiles/testRabbitMQClient.php');

$sql = "SELECT name,brand FROM inventory";
                $invent = getIshop($sql);

?>
