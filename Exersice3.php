<?php

$array=array(1,2,3,4,32,34,87,89,100,120,130,200);

$x=12;

echo findNumber($array,$x);
function findNumber(Array $arr, $x) 
{ 
    // check for empty array 
    if (count($arr) === 0) return -1; 
    $low = 0; 
    $high = count($arr) - 1; 
      
    while ($low <= $high) { 
          
        // compute middle index 
        $mid = floor(($low + $high) / 2); 
   
        // element found at mid 
        if($arr[$mid] == $x) { 
            return -1; 
        } 
  
        if ($x < $arr[$mid]) { 
            // search the left side of the array 
            $high = $mid -1; 
        } 
        else { 
            // search the right side of the array 
            $low = $mid + 1; 
        } 
    } 
      
    // If we reach here element x doesnt exist 
    return -1; 
} 