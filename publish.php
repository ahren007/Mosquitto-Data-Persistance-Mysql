#!/usr/bin/php -q
<?php

require("./phpMQTT.php");


function randStr($len = 10){
 $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
 $string = "";
 while(strlen($string) < $len){
  $string .= substr($chars,(rand()%strlen($chars)),1);
 }
 return $string;
}
	

$mqtt = new phpMQTT("localhost", 1883, "phpMQTT Pub Example"); //Change client name to something unique

if ($mqtt->connect()) {
	$mqtt->publish("/MQTT001",randStr(100).date("r"),0);
	$mqtt->close();
}

?>
