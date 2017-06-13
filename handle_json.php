<?php 

$json = file_get_contents('php://input');
$obj = json_decode($json);
// foreach($obj as $item){
// 	print_r($item);
// }

try {

    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $bulk = new MongoDB\Driver\BulkWrite;
    
    

    foreach($obj as $item){
		$doc = ['_id' => new MongoDB\BSON\ObjectID, $item];
		$bulk->insert($doc);
		
	}

	$mng->executeBulkWrite('amazon.konten', $bulk);
	

	
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";       
}


?>