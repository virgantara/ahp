
<?php 

include "head.php";
?>

<link rel="stylesheet" href="<?php echo $baseurl;?>/assets/css/jquery-ui.css">



<script>
  
  var maks = 9;
  var vals = [];  

  var incr1 = 8;
  var incr2 = -3;
  for(var i=0;i < 9 ;i++){
    if(i > 4){
      vals[i] = (i+1) + incr2;
      incr2 = incr2 + 1; 
    }
  
    else{
      vals[i] = (i+1) + incr1;
      incr1 = incr1 - 3;
      if(vals[i]!= 1)
        vals[i] = vals[i] * -1;
    }
  }

  

  
  </script>

<?php 
// $lv1 = array('','Cost','Security','Reliability','Availability','Usability');
$lv1 = $_POST['kriteria'];//array('','Cost','Security','Reliability','Availability','Usability');

array_unshift($lv1, '');

$sum=count($lv1)-1;
$data = $lv1;
$input_array = array (
    'kriteria' => $lv1
  );
?>

<div class="wrapper">

  <?php 
 // include_once "header_menu.php";
  ?>

  <style>
  div.custom-handle {
    
  }

  </style>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Selection
          <!-- <small>Example 2.0</small> -->
        </h1>
       <!--
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol>-->
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Criteria Selection</h3>
          </div>
          <div class="box-body">
           

<form method="POST" action="multilevel_adaptive.php?<?php echo http_build_query($input_array);?>">

<?php

echo "<table width='40%'>";
for ($i = 1 ; $i <= $sum; $i++)
{
  
  for ($j = 1 ; $j<=$sum ; $j++)
  {
    if ($i<$j) {
      # code...

      echo "
          <tr>
            <th colspan='4'>$data[$i]</th>
            
            <th colspan='4' style='text-align:right'>$data[$j]</th>
          </tr>
          <tr>
            <td colspan='8'>
        ";
        ?>
        <script>
$( function() {




    var handle = $( "#custom-handle_<?php echo 't-'.$i.'-'.$j;?>" );
    $( "#slider_<?php echo 't-'.$i.'-'.$j;?>" ).slider({
      value : 5,
      min : 1,
      max : 9,
      create: function() {
        handle.text( vals[$( this ).slider( "value" )-1] );
      },
      slide: function( event, ui ) {
        var vslider = vals[ui.value-1]; 
        var v = Math.abs(eval(vslider));
        handle.text( v );
        $('#txt_<?php echo 't-'.$i.'-'.$j;?>').val(vslider);
      }
    });
  } );
  </script>
<div id="slider_<?php echo 't-'.$i.'-'.$j;?>" class="slider">
  <div id="custom-handle_<?php echo 't-'.$i.'-'.$j;?>" class="ui-slider-handle" style="width: 2em;height: 2.0em;top: 0%;margin-top: -11px;padding : 3px;text-align: center;line-height: 1.6em;left:45%;
"></div>
</div>
 
        <?php
        echo "</td>
          </tr>
          <tr><td colspan='8'>
        ";
        ?>
<input type='hidden' id="txt_<?php echo 't-'.$i.'-'.$j;?>" name ='<?php echo 't-'.$i.'-'.$j;?>' value="1"/>

        <?php
        echo '</td></tr>';

    }
  }

}
  echo "</table>";
  

 ?>
 <br>
<input type="submit" class="btn btn-primary" value="Calculate" name="submit2" id="submit2" />
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

<!-- 
<a href="admin.php">Config</a> -->
<?php 
include "script.php";
?>
