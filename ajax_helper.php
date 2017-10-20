<?php 


include_once "db_helper.php";
require_once 'vendor/autoload.php';

function ch_geo_svc($q)
{
	$m= new MongoDB\Client(C_CONN);
	$db = $m->ahp;

	$collection = $db->geoservices;

	$documents = $collection->find(['serviceId'=>$q]);
	

	$content = array();
	foreach($documents as $row)
	{
		$content[] = $row;
		
	}

	return json_encode($content);
}


function cloud_harmony_status($q)
{
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

	return json_encode($results);

}

?>