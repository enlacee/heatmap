<?php


$array = array('uno','dos','tres','uno');
$count = array_count_values($array);
/*
echo "<pre>";
print_r($count);
*/
$vector = array();
$vector[] = array('x'=>1,'y'=>2);
$vector[] = array('x'=>5,'y'=>5);
$vector[] = array('x'=>5,'y'=>10);
$vector[] = array('x'=>1,'y'=>2);




echo "<br><pre> vector ";
print_r($vector);

exit;
$countvector = array_count_values($vector);
echo "<br><pre> countvector ";
print_r($countvector);