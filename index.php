
<?php 


include "head.php";
?>



<?php 


$lv1 = array('','Cost','Security','Reliability','Availability','Usability');



?>


<div class="wrapper">

  <?php 
  include_once "header_menu.php";
  ?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Selection
          <!-- <small>Example 2.0</small> -->
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Criteria Selection</h3>
          </div>
          <div class="box-body">
           

<form method="POST" action="process.php" id="form-calc">

Select criterias : <br>

<?php
foreach($lv1 as $q => $v){
  if($q >   0)
  echo '<div class="checkbox"><label for="'.$q.'"><input id="'.$q.'" type="checkbox" class="kriteria" name="kriteria[]" value="'.$v.'">'.$v.'</label></div>';
}
?>

<input type="button" class="btn btn-primary" value="Calculate" name="submit2" id="submit2" />
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
