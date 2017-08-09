<?php 


$all_joinsub_criteria =  array(
      'C1',
      'S1','S2','S3','S4',
      'R1','R2',
      'A1',
      'U1','U2','U3',
);



$sub_criteria = array(
  array('C1'),
  array('S1','S2','S3','S4'),
  array('R1','R2',),
  array('A1',),
  array('U1','U2','U3',),
);

// $scoring = array(
// 		array(
// 			"name" => "M",
// 			"score"=> array(
// 	          	'C1' => 100,
// 	          	'S1' => 43,
// 	          	'S2' => 49,
// 	          	'S3' => 10,
// 	          	'S4' => 45,
// 	          	'R1' => 96,
// 	          	'R2' => 100,
// 	          	'A1' => 99,
// 	          	'U1' => 5,
// 	          	'U2' => 46,
// 	          	'U3' => 46
// 	          )
// 		), 
// 		array(
// 			"name" => "K",
// 			"score"=> array(
// 	          	'C1' =>	85,
// 				'S1' =>	47,
// 				'S2' =>	49,
// 				'S3' =>	5,
// 				'S4' =>	46,
// 				'R1' =>	90,
// 				'R2' =>	99,
// 				'A1' =>	97,
// 				'U1' =>	10,
// 				'U2' =>	49,
// 				'U3' =>	49
// 	          )
// 		), 
        
//         array(
// 			"name" => "I",
// 			"score"=> array(
// 	          	'C1' =>97,
// 				'S1' =>44,
// 				'S2' =>42,
// 				'S3' =>10,
// 				'S4' =>46,
// 				'R1' =>95,
// 				'R2' =>98,
// 				'A1' =>99,
// 				'U1' =>10,
// 				'U2' =>45,
// 				'U3' =>47
// 	          )
// 		), 

// 		array(
// 			"name" => "A",
// 			"score"=> array(
// 	          	'C1' =>93 , 
// 				'S1' =>50 , 
// 				'S2' =>48 , 
// 				'S3' =>10,  
// 				'S4' =>49,  
// 				'R1' =>93 , 
// 				'R2' =>95,  
// 				'A1' =>98  ,
// 				'U1' =>5,
// 				'U2' =>48 ,
// 				'U3' =>48
// 	          )
// 		), 

// 		array(
// 			"name" => "B",
// 			"score"=> array(
// 	          	'C1' =>100,
// 				'S1' =>46 ,
// 				'S2' =>43,  
// 				'S3' =>10,  
// 				'S4' =>41,  
// 				'R1' =>100, 
// 				'R2' =>91,  
// 				'A1' =>97,  
// 				'U1' =>5,
// 				'U2' =>50 ,
// 				'U3' =>45
// 	          )
// 		), 

// 		array(
// 			"name" => "T",
// 			"score"=> array(
// 	          	'C1' =>90,
// 				'S1' =>50 , 
// 				'S2' =>47,  
// 				'S3' =>5, 
// 				'S4' =>45 , 
// 				'R1' =>92,  
// 				'R2' =>97 , 
// 				'A1' =>99  ,
// 				'U1' =>10,  
// 				'U2' =>47  ,
// 				'U3' =>50
// 	          )
// 		), 
      
     
      
      
     
// );

// print_r($scoring);exit;

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
	    	$baseurl = $row;
	    	
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

?>

<form action="update_setting.php" method="POST">


<?php 

$query = new MongoDB\Driver\Query(array('provider' => array('$ne'=>true)));

	$cursor = $manager->executeQuery('ahp.provider', $query);
    
    $result = $cursor->toArray();


    if(!empty($result))
    {
    	
	   $query = new MongoDB\Driver\Query([]); 
	     
	    $rows = $manager->executeQuery("ahp.provider", $query);

echo 'Provider\'s Score  : <br>';		
echo '<table border="1" width="50%">';
echo '<tr>';
echo '<td>#</td>';
foreach($all_joinsub_criteria as $row)
{

    echo '<td>';
    echo $row;
    echo '</td>';

}

echo '</tr>';

$i = 0;
foreach($rows as $row)
{  
	$obj = (array)$row;
	$obj = $obj[0];

	echo '<tr>';

    echo '<td>';
    echo $obj->name;
    echo '</td>';

    $j = 0;
    
    foreach($obj->score as $q => $v)
    {

       echo '<td>';

       // print_r($val);
      	echo '<input type="text" name="'.$obj->name.'_'.$q.'" value="'.$v.'" size="3"/>';
       echo '</td>';
        $j++;

    }

    $i++;
echo '</tr>';

}
echo '</table>';


	}
?>

<table>
	<tr>
		<td>Base URL</td>
		<td>:&nbsp;<input type="text" name="baseurl" value="<?php echo $baseurl->baseurl;?>"/>
			<input type="hidden" name="oid" value="<?php echo $baseurl->_id;?>"/>
		</td>
	</tr>

</table>



<input type="submit" value="Save" name="save"/>
</form>