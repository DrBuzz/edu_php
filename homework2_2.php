<?php
$str0="test";
$str1="";
for ($i = 0; $i < strlen($str0); $i++) {
    $str1 = $str0[$i] . $str1;
}
echo $str1;