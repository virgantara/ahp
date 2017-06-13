<?php 

$collection = new MongoDB\Driver\Manager("mongodb://localhost:27017");

if($collection){
        echo "Connected Successfully";
     } 
?>