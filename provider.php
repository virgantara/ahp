
<?php 

include "head.php";
?>



<div class="wrapper">

  <?php 
  include_once "header_menu.php";

include_once "db_helper.php";

initProvider();
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
            <h3 class="box-title">Provider</h3>
          </div>
          <div class="box-body">
           


<form action="update_provider.php" method="POST" >

 <div class="box-body">
<?php


$all_joinsub_criteria =  array(
      'C1',
      'S1','S2','S3','S4',
      'R1','R2',
      'A1',
      'U1','U2','U3',
);

try {

 $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$query = new MongoDB\Driver\Query(array('provider' => array('$ne'=>true)));

  $cursor = $manager->executeQuery('ahp.provider', $query);
    
    $result = $cursor->toArray();


    if(!empty($result))
    {
      
     $query = new MongoDB\Driver\Query([]); 
       
      $rows = $manager->executeQuery("ahp.provider", $query);
echo '<pre>';
foreach($rows as $row)
{
  print_r($row);

}
echo '</pre>';
exit;
echo 'Provider\'s Score  : <br>';   
echo '<table class="table table-bordered">';
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
  $oid = $obj['_id'];
  $obj = $obj[0];

  echo '<tr>';

    echo '<td>';
    echo $obj->provider;
    echo '</td>';

    $j = 0;
    
    foreach($obj->value as $q => $v)
    {

       echo '<td>';

       // print_r($val);
        echo '<input type="text" name="'.$obj->provider.'_'.$q.'" value="'.$v.'" size="3"/>';
        // echo '<input type="text" name="oid_'.$obj->provider.'_'.$q.'" value="'.$v.'" size="3"/>';
       echo '</td>';
        $j++;

    }

    $i++;
echo '</tr>';

}
echo '</table>';
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

</div>
<div class="box-footer">
                
<input type="button" class="btn btn-primary" value="Save" name="save" id="submit2" />
              </div>
</form>
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


<script type="text/javascript">
  $(document).ready(function(){

    $("#submit2").click(function(){
        if($('.kriteria:checked').length > 1){
          document.forms["form-calc"].submit();
        }

        else{
          alert('Minimum selected criteria must be 2');
        }
    });
  });
</script>
<!-- 
<a href="admin.php">Config</a> -->
<?php 
include "script.php";
?>
