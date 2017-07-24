#!/usr/bin/php -q
<?php
 
$client = new Mosquitto\Client();
$client->onConnect('connect');
$client->onDisconnect('disconnect');
$client->onPublish('publish');
$client->connect("localhost", 1883, 5);
echo $argv[1]; 
while (true) {
        try{
                $client->loop();
                $mid = $client->publish('/mqtt', $argv[1]);
                $client->loop();
        }catch(Mosquitto\Exception $e){
                return;
        }
        sleep(2);
}
 
$client->disconnect();
unset($client);
 
function connect($r) {
        echo "I got code {$r}\n";
}
 
function publish() {
        global $client;
        echo "Mesage published\n";
        $client->disconnect();
}
 
function disconnect() {
        echo "Disconnected cleanly\n";
}
