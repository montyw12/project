<?php

$a = ["kunj", "home", "jkl", 1234, 12.34, true];

$a = implode("+ %", $a);
$b = explode("+ %",$a);
echo $a . "<br/>";
var_dump($b);