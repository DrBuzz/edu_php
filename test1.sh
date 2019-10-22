#!/bin/bash
printf $(( ( RANDOM % 100 )  + 1 ))>numbers.csv
for i in {1..99}; do 
  printf ',%s' $(( ( RANDOM % 100 )  + 1 ))>>numbers.csv;
done
