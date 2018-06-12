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
?>