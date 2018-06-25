<?php
// For debugging
// ini_set('memory_limit', '2048M');
include_once "mongoQueryBeginner.php";

function respectToAttr($data, $attr){
  // construct holder matrix
  $holder = array();
  for($i=0;$i<count($data); $i++){
    for($j=0;$j<count($data); $j++){
      $holder[$i][$j] = 0;
    }
  }

  // construct respect to attribute matrix
  for($i=0; $i<count($data); $i++){
    for($j=0; $j<count($data); $j++){
      $val = 0;

      if($i == $j){
        $holder[$i][$j] = $data[$i][$attr] / $data[$j][$attr];
      } else {
        if(!($j == count($data)-1)) {
          $val = $data[$i][$attr] / $data[$j][$attr];
        } else {
          $val = $data[$i][$attr] / $data[$j][$attr];
        }
        $holder[$i][$j] = $val;
        $holder[$j][$i] = 1/$val;
      }
    }
  }
  return $holder;
}

// For dubugging
$value = respectToAttr($instanceData,"pricing");

function respectToAttrSum($value) {
  $holder = array();
  $sum = 0;
  // columns
  for($i=0; $i<count($value); $i++){
    // rows
    for($j=0; $j<count($value); $j++){
      $sum = $sum + $value[$j][$i];
    }
    array_push($holder, $sum);
    $sum = 0;
  }
  return $holder;
}
// For debugging
$s = respectToAttrSum($value);

function normRespectToAttr($value, $sum){
  $holder = array();
  $size = count($value)+2;
  // Initial matrix
  for($i=0; $i<$size-2; $i++){
    for($j=0; $j<$size; $j++){
      $holder[$i][$j] = 0;
    }
  }
  
  for($i=0; $i<$size-2; $i++){
    $sumH = 0; // sum horizontal
    for($j=0; $j<$size; $j++){
      if($j<$size-2) {
        $val = $value[$i][$j] / $sum[$j];
        $sumH = $sumH + $val;
        $holder[$i][$j] = $val;
      } elseif($j<$size-1) {
        $holder[$i][$j] = $sumH;
      } else {
        // Priority Vector
        $holder[$i][$j] = $sumH / count($value);
      }
    }
  }
  return $holder;
}
?>