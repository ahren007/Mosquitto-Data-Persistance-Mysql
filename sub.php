#!/usr/bin/php -q
<?php
require("./phpMQTT.php");
$mqtt = new phpMQTT("localhost", 1883, "phpMQTT Sub Example"); //Change client name to something unique
if(!$mqtt->connect()){
        exit(1);
}
$
topics['/#'] = array("qos"=>0, "function"=>"procmsg");
$mqtt->subscribe($topics,0);

while($mqtt->proc()){
}
$mqtt->close();

function procmsg($topic,$msg){
                #echo "Msg Recieved: ".date("r")."\nTopic:{$topic}\n$msg\n";
                #echo date("r")."\n";
                #echo "$msg\n";

                $con = mysql_connect("localhost","mqtt_logs","mqtt_logs");
                        if (!$con)
                                {
                          die('Could not connect: ' . mysql_error());
                        }
                mysql_select_db("mqtt_logs", $con);
                $sql="INSERT INTO mqtt_logs (payload) VALUES ('$msg')";
                        if (!mysql_query($sql,$con))
                                {
                         die('Error: ' . mysql_error());
                        }
                mysql_close($con);
                #echo "1 record added";
}
