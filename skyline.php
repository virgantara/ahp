
<?php 

include "head.php";

include_once "config.php"
?>



<div class="wrapper">

<?php 
  
  
  
include_once "header_menu.php";

include_once "db_helper.php";
require_once 'vendor/autoload.php';
?>

  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          AHP Provider
          <!-- <small>Example 2.0</small> -->
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <!-- <li><a href="#">Main</a></li> -->
          <li class="active">Setting</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Cloud Skyline</h3>
          </div>
          <div class="box-body">


<div class="col-xs-6">           
	<h2>Non-skyline Providers</h2>
<table  class="table table-bordered">
    <thead>
      <tr>
      	<th>No</th>
      	<th>Name</th>
      	<th>Cost</th>
      	<th>Availability</th>
      </tr>
    </thead>
    <tbody>
   <?php
$m= new MongoDB\Client(C_CONN);
$db = $m->ahp;

$collection = $db->cloudscore;

$documents = $collection->find();

$i = 0;
foreach($documents as $doc)
{
	$i++;
?>
      <tr>
      	<td><?php echo $i;?></td>
      	<td><?php echo $doc->name;?></td>
      	<td><?php echo $doc->cost;?></td>
      	<td><?php echo $doc->availability;?></td>
      </tr>
<?php 
}
?>
    </tbody>
  </table>

</div>
<div class="col-xs-6">
<h2>Skyline Providers</h2>
	<table class="table table-bordered">
    <thead>
      <tr>
      	<th>No</th>
      	<th>Name</th>
      	<th>Cost</th>
      	<th>Availability</th>
      </tr>
    </thead>
    <tbody>
<?php

$collection = $db->skyline;

$documents = $collection->find();

$i = 0;
foreach($documents as $doc)
{
	$i++;
?>
      <tr>
      	<td><?php echo $i;?></td>
      	<td><?php echo $doc->name;?></td>
      	<td><?php echo $doc->cost;?></td>
      	<td><?php echo $doc->availability;?></td>
      </tr>
<?php 
}
?>
    </tbody>
  </table>
</div>



          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
  include_once "footer.php";
  ?>
</div>


<!-- 
<a href="admin.php">Config</a> -->
<?php 
include "script.php";
?>


