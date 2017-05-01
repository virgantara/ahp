<?php

require_once 'JSON.php';

function delete_all_between($beginning, $end, $string) {
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if ($beginningPos === false || $endPos === false) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return str_replace($textToDelete, '', $string);
}

$json = new Services_JSON();
$contents = file_get_contents('http://a0.awsstatic.com/pricing/1/ec2/pricing-data-transfer-with-regions.min.js', 1000000);


$contents = delete_all_between('/*', '*/', $contents);
$contents = str_replace('callback(', '', $contents);
// $contents = str_replace('\"', '', $contents);
$value = $json->encode($contents);
echo '<pre>';
print_r($value);
echo '</pre>';
?>