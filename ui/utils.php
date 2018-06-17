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
        
        // if($j==2){
        //   echo "posisi i = $i";
        //   echo "<br/>";
        //   echo "posisi j = $j";
        //   echo "<br/>";
        //   echo $holder[$i][$j];
        //   echo "<br/>";
        //   echo $holder[$j][$i];
        //   die();
        // }
      }
    }
    if($i==2) {
      print_r($holder[0]);
      echo "<br/>";
      echo "<br/>";
      print_r($holder[1]);
      echo "<br/>";
      echo "<br/>";
      print_r($holder[2]);
      die();
    }
  }
  return $holder;
}
print_r(respectToAttr($instanceData,"pricing")[0]);
// echo "<br/>";
// echo "<br/>";
// print_r(respectToAttr($instanceData,"pricing")[1]);
// echo "<br/>";
// echo "<br/>";
// print_r(respectToAttr($instanceData,"pricing")[2]);
die();
?>