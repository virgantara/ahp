<?php
try {
         
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    
    if(!empty($_POST['save']))
    {    

        $bulk = new MongoDB\Driver\BulkWrite;

        foreach($scoring as $score)
        {
        // print_r($score);
            $doc = ['_id' => new MongoDB\BSON\ObjectID, $score];
            $bulk->insert($doc);
        }

       $manager->executeBulkWrite('ahp.provider', $bulk);   
    }
    $query = new MongoDB\Driver\Query(array('provider' => array('$ne'=>true)));

	$cursor = $manager->executeQuery('ahp.provider', $query);
    
    $result = $cursor->toArray();

 	if(!empty($_POST['baseurl']))
 	{
 		$baseurl = $_POST['baseurl'];
 		$bulk = new MongoDB\Driver\BulkWrite;
    	// echo 'a';exit;

		$bulk->delete(
				['_id'=> new MongoDB\BSON\ObjectID($_POST['oid'])],
    			['limit' => 1]
			);

		$manager->executeBulkWrite('ahp.setting', $bulk);	

		$bulk = new MongoDB\Driver\BulkWrite;
    	// echo 'a';exit;
    	$doc = ['_id' => new MongoDB\BSON\ObjectID, 'baseurl' => $_POST['baseurl']];
		$bulk->insert($doc);

		$manager->executeBulkWrite('ahp.setting', $bulk);

        header("Location:admin.php");
 	}

    
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";    
}