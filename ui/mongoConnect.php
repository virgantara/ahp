<?php
    require '../vendor/autoload.php';
    $con = new \MongoDB\Client('mongodb://localhost:27017');

    $collection = $con->ahp->iaas;
?>