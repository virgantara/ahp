<?php
try {
         
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    
    if(!empty($_POST['save']))
    {    

        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $query = new MongoDB\Driver\Query(array('provider' => array('$ne'=>true)));

        $cursor = $manager->executeQuery('ahp.provider', $query);
           
        $result = $cursor->toArray();


        if(!empty($result))
        {
              
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
                    $score[] = $_POST[$obj->name.'_'.$q];
                }

                $p = array(
                    '0'=> array(
                        'name' => $obj->name,
                        'value' => $score
                ));

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update(
                    ['0.name' => $obj->name],
                    $p,
                    ['multi' => false, 'upsert' => false]
                );

                // print_r($p);

                $manager->executeBulkWrite('ahp.provider', $bulk);   
            }
// exit;

        }

    }


    header("Location:provider.php");

    
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";    
}