<?php
function getTuesdays(int $year, int $month)
{
$startDate = strtotime("1-".$month."-".$year);
$endDate = strtotime ('+1 month',$startDate);
  for ($i = strtotime('Tuesday', $startDate ); $i < $endDate; $i = strtotime('+1 week', $i)) {
    echo date('d.m.Y', $i)."\n";
  }
}

getTuesdays(2019,10);