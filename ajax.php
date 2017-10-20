<?php 

include_once "ajax_helper.php";

if(empty($_POST['q']) || empty($_POST['status'])) exit;

$q = $_POST['q'];
$status = $_POST['status'];

// $q = 'aws:ec2';
// $status=2;

switch ($status) {
	case 1:
		echo cloud_harmony_status($q);
		break;
	
	case 2:
		echo ch_geo_svc($q);
		break;
}



?>