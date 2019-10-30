<?php
$items=[1,2,3,4,5,6,7,8,9];
$sum=0;
foreach ($items as $key => $item)  
{
    if (is_string($item)) break;
    if (($key == 2) || ($key == 5) || ($key == 7)) {
    $sum += $item;
    }
}
echo $sum;