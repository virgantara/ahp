<?php 




function deleteField()
{
	try {
         
	// $db = 'ahp';
	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['baseurl'=>'http://localhost/ahp']);
    $manager->executeBulkWrite('ahp.setting', $bulk);

} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";    
}

}
?>