#!/bin/sh
for (( i=0; i<1000000000; i++))
do
./publish.php;
sleep 1;
done
