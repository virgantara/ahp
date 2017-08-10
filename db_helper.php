<?php 

function getProviderScore()
{
	$scoring = array();
	try 
	{

        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
          
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
	          	46
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
			49
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
			47
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
			48
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
			45
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
			50
			)
	      )
	);

		
	try {
	         
	    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	    
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


function loadBaseUrl()
{
	
	$baseurl = '';


	try {
			 
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
		
		$query = new MongoDB\Driver\Query(array('baseurl' => array('$ne'=>true)));

		$cursor = $manager->executeQuery('ahp.setting', $query);
		
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
	    	$doc = ['_id' => new MongoDB\BSON\ObjectID, 'baseurl' => 'http://localhost/ahp'];
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

	return $baseurl;
}
?>