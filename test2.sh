#!/bin/bash

while read -d, val
do
  if [[ $val -gt 50 ]]; then echo $val 1
                        else echo $val 0
  fi
done < "numbers.csv"
if [[ $val -gt 50 ]]; then echo $val 1
                      else echo $val 0
fi
