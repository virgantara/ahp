<?php 

//define('C_CONN','mongodb://admin:admin@cluster0-shard-00-00-cfus9.mongodb.net:27017,cluster0-shard-00-01-cfus9.mongodb.net:27017,cluster0-shard-00-02-cfus9.mongodb.net:27017/test?ssl=true&replicaSet=Cluster0-shard-0&authSource=admin');

//define('C_CONN','mongodb://admin:admin@101.50.1.164:27017/admin');
define('C_CONN','mongodb://admin:admin@127.0.0.1:27017/admin');

require_once 'vendor/autoload.php';

function getCloudProviders()
{
	$m= new MongoDB\Client(C_CONN);
	$db = $m->ahp;

	$collection = $db->cloudprovider;

	$documents = $collection->find();
	$content = array();
	foreach($documents as $doc)
	{
	  $content[] = $doc;
	}

	return $content;
}

function getProviderScore()
{
	$scoring = array();
	try 
	{
	//$conn = "mongodb://localhost:27017";
$conn = C_CONN;
        $manager = new MongoDB\Driver\Manager($conn);
          
        $query = new MongoDB\Driver\Query([]); 
         
        $rows = $manager->executeQuery("ahp.provider", $query);

        foreach($rows as $row)
        {

            $obj = (array)$row;
            $oid = $obj['_id'];
            $obj = $obj[0];

            $score = array();
            foreach($obj->value as $q => $v)
            {
                $score[] = $v;
            }

            $p = array(
                
                'provider' => $obj->name,
                'value' => $score
            );

            $scoring[] = $p;   
        }

	     
	} catch (MongoDB\Driver\Exception\Exception $e) {

	    $filename = basename(__FILE__);
	    
	    echo "The $filename script has experienced an error.\n"; 
	    echo "It failed with the following exception:\n";
	    
	    echo "Exception:", $e->getMessage(), "\n";
	    echo "In file:", $e->getFile(), "\n";
	    echo "On line:", $e->getLine(), "\n";    
	}

	return $scoring;
}

function initProvider()
{

	$scoring = array(
	        array(
	          "name"=> "M",
	          "value"=> array(
	          	 100,
	          	 43,
	          	 49,
	          	 10,
	          	 45,
	          	 96,
	          	 100,
	          	 99,
	          	 5,
	          	46,
	          	
	          )
	        )
	      ,
	         array(
	        "name"=> "K",
	        "value"=> array(
			 85,
			 47,
			 49,
			 5,
			 46,
			 90,
			 99,
			 97,
			 10,
			49,
			
			)
	        )
	      ,
	       array(
	        "name"=> "I",
	        "value"=> array(
			 97,
			 44,
			 42,
			 10,
			 46,
			 95,
			 98,
			 99,
			 10,
			45,
			
				)
	        )
	      ,
	       array(
	        "name"=> "A",
	        "value"=> array(
			 93 , 
			 50 , 
			 48 , 
			 10,  
			 49,
			 93 ,
			 95, 
			 98  ,
			 5,
			48 ,
			
			)
	        )
	      ,
	       array(
	        "name"=> "B",
	        "value"=> array(
			 100,
			 46 ,
			 43, 
			 10,
			 41, 
			 100, 
			 91, 
			 97,  
			 5,
			50 ,
		
			)
			)
	      ,
	       array(
	        "name"=> "T",
	        "value"=> array(
			 90, 
			 50 , 
			 47, 
			 5, 
			 45 , 
			 92, 
			 97 , 
			 99  ,
			 10,  
			47  ,
			
			)
	      )
	);

		
	try {
	         
	   $conn = C_CONN;
        $manager = new MongoDB\Driver\Manager($conn);
	    
	    $query = new MongoDB\Driver\Query(array('provider' => array('$ne'=>true)));

		$cursor = $manager->executeQuery('ahp.provider', $query);
	    
	    $result = $cursor->toArray();

	    if(empty($result))
	    {    

	  

	        foreach($scoring as $score)
	        {
	        	$bulk = new MongoDB\Driver\BulkWrite;
	        	// $score;
	        	$obj = new stdClass;
	        	$obj->name = $score['name'];
	        	$obj->value = $score['value'];
	        // print_r($obj);
	            $doc = ['_id' => new MongoDB\BSON\ObjectID, $obj];
	            $bulk->insert($doc);
	            $manager->executeBulkWrite('ahp.provider', $bulk);   
	        
	        }

	        

	       
	    }
	    
	} catch (MongoDB\Driver\Exception\Exception $e) {

	    $filename = basename(__FILE__);
	    
	    echo "The $filename script has experienced an error.\n"; 
	    echo "It failed with the following exception:\n";
	    
	    echo "Exception:", $e->getMessage(), "\n";
	    echo "In file:", $e->getFile(), "\n";
	    echo "On line:", $e->getLine(), "\n";    
	}
}

function initSetting($url)
{
	try {
         
	    $conn = C_CONN;
        $manager = new MongoDB\Driver\Manager($conn);
	    
	    
	    $query = new MongoDB\Driver\Query(array('baseurl' => array('$ne'=>true)));

		$cursor = $manager->executeQuery('ahp.setting', $query);
	    
	    $result = $cursor->toArray();

	 	
 		// $baseurl = $_POST['baseurl'];
 		$bulk = new MongoDB\Driver\BulkWrite;
    	// echo 'a';exit;

		$bulk->delete(
				['item'=> 'baseurl'],
    			['limit' => 1]
			);

		$manager->executeBulkWrite('ahp.setting', $bulk);	

		$bulk = new MongoDB\Driver\BulkWrite;
    	// echo 'a';exit;
    	$doc = ['_id' => new MongoDB\BSON\ObjectID, 'item'=> 'baseurl','baseurl' => $url];
		$bulk->insert($doc);

		$manager->executeBulkWrite('ahp.setting', $bulk);

        header("Location:index.php");
	 	

	    
	} catch (MongoDB\Driver\Exception\Exception $e) {

	    $filename = basename(__FILE__);
	    
	    echo "The $filename script has experienced an error.\n"; 
	    echo "It failed with the following exception:\n";
	    
	    echo "Exception:", $e->getMessage(), "\n";
	    echo "In file:", $e->getFile(), "\n";
	    echo "On line:", $e->getLine(), "\n";    
	}
}


function loadBaseUrl()
{
	
	$baseurl = '';


	try {
			 
		$conn = C_CONN;
        $manager = new MongoDB\Driver\Manager($conn);
		
		
		$query = new MongoDB\Driver\Query(array('baseurl' => array('$ne'=>true)));
		
		$cursor = $manager->executeQuery('ahp.setting', $query);
		
		;
		
		
		$result = $cursor->toArray();


		if(!empty($result))
		{
			
			$query = new MongoDB\Driver\Query([]); 
			 
			$rows = $manager->executeQuery("ahp.setting", $query);

			
			foreach($rows as $row){
				$baseurl = $row->baseurl;
				
			}
		}

		else
		{
			$bulk = new MongoDB\Driver\BulkWrite;
    	// echo 'a';exit;
	    	$doc = ['_id' => new MongoDB\BSON\ObjectID, 'baseurl' => 'http://localhost/ahp2'];
			$bulk->insert($doc);

			$manager->executeBulkWrite('ahp.setting', $bulk);
		}
		
	} catch (MongoDB\Driver\Exception\Exception $e) {

		$filename = basename(__FILE__);
		
		echo "The $filename script has experienced an error.\n"; 
		echo "It failed with the following exception:\n";
		
		echo "Exception:", $e->getMessage(), "\n";
		echo "In file:", $e->getFile(), "\n";
		echo "On line:", $e->getLine(), "\n";    
	}


	// print_r($baseurl);exit;
	return $baseurl;
}
?>