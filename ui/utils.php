<?php
// Can be simplified into single file
function renameCriteria($data) {
  $renameI = '';
  switch ($data) {
    case 'As':
      $renameI = 'Assurance';
      break;
    case 'Cp':
      $renameI = 'Company Performance';
      break;
    case 'Cm':
      $renameI = 'Compliance';
      break;
    case 'Pe':
      $renameI = 'Performance';
      break;
    case 'Pr':
      $renameI = 'Pricing';
      break;
    case 'Se':
      $renameI = 'Security';
      break;
    case 'Us':
      $renameI = 'Usability';
      break;
  }
  return $renameI;
}

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
$value = respectToAttr($instanceData,"security");
// print_r($value);
// die();

function respectToAttrSum($value) {
  $holder = array();
  $sum = 0;
  for($i=0; $i<count($value); $i++){
    for($j=0; $j<count($value); $j++){
      $sum = $sum + $value[$j][$i];
    }
    array_push($holder, $sum);
    $sum = 0;
  }
  return $holder;
}
print_r(respectToAttrSum($value));
die();

?>