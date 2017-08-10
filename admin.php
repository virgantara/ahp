
<?php 

include "head.php";
?>



<div class="wrapper">

  <?php 
  include_once "header_menu.php";


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
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          AHP Setting
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
            <h3 class="box-title">Setting</h3>
          </div>
          <div class="box-body">
           


<form action="update_setting.php" method="POST" class="form-horizontal">

 <div class="box-body">
 <div class="form-group">
  <label for="inputEmail3" class="col-sm-2 control-label">Base URL</label>

  <div class="col-sm-10">
   
    <input type="text" class="form-control" name="baseurl" value="<?php echo $baseurl->baseurl;?>"/>
      <input type="hidden" name="oid" value="<?php echo $baseurl->_id;?>"/>
  </div>
</div>

</div>
<div class="box-footer">
                
<input type="submit" class="btn btn-primary" value="Save" name="submit2" id="submit2" />
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


</script>
<!-- 
<a href="admin.php">Config</a> -->
<?php 
include "script.php";
?>
