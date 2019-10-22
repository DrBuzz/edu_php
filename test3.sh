#!/bin/bash
# число для вычисления передается параметром командной строки при запуске
val=$1
f=1
while [[ $val -gt 0 ]]
do
   f=$(( $f * $val ))
   val=$(( $val - 1 ))
done
echo $f