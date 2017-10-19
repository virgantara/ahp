<?php 

include_once "db_helper.php";
require 'vendor/autoload.php';

if(empty($_POST['q'])) exit;

$q = $_POST['q'];

$m= new MongoDB\Client(C_CONN);
$db = $m->ahp;

if($q == 'compute')
	$collection = $db->compute;
else if($q == 'cdn')
	$collection = $db->cdn;
else if($q == 'storage')
	$collection = $db->storage;
else if($q == 'dns')
	$collection = $db->dns;
else if($q == 'paas')
	$collection = $db->paas;



$documents = $collection->find([]);
$headers = array();
foreach($documents as $doc)
{
  $size = count($doc);
  if($size > 2){
    foreach($doc as $q=>$v)
    {
    	if($q != '_id')
      $headers[] = $q;
      
    }
    break;
    
  }
}

$documents = $collection->find([]);

$content = array();
foreach($documents as $row)
{
	$size = count($doc);
  	if($size > 2){
		$content[] = $row;
	}
}

$results = array(
	'headers' => $headers,
	'content' => $content
);

echo json_encode($results);

?>