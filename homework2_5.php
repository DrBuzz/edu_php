<?php
$items0 = ["test1","test2","test3","test4"];
function GetArray(array $items1, string $str1)
{
   if (is_null($items1) || is_null($str1)) return false;
   foreach ($items1 as $key => $item)  
    {
      $items2[$key] = $item . $str1;
    }
   return $items2;
}

foreach (GetArray($items0,"connect") as $item0)  
  {
      echo $item0."\n";
  }