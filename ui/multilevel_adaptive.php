<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Title | Project</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="plugins/jQuery/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="css/jquery-ui.css">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
   <nav class="navbar navbar-static-top">
      <div class="container">
        <h1 class="navbar-brand"><b>Main</b> Header</h1>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Main Page
          <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Main Page</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
<?php 
include_once "config.php";
include_once "mongoQueryBeginner.php";
include "utils.php";
$scoring = $instanceData;
?>


<?php

$criteria = $_GET['level1'];
array_splice($criteria, 0,1);
array_unshift($criteria, '*');
$lv1 = $criteria;
array_splice($lv1, 0,1);
// print_r($criteria);exit;

// $score_provider = array();
// $j = 1;
// foreach($scoring_main as $s)
// {
//     for($i=1;$i<count($criteria);$i++)
//     {
//         $score_provider[$i][$j] = $s['value'][$i];
//     }

//     $j++;
// }


// Create diagonal 1 value
$data = array();
for($i = 1;$i<count($criteria);$i++)
{
   for($j=1;$j<count($criteria);$j++)
   {
      $data[$i][$j] = 1;
      
   }
}

// Fill other value except the diagonal
for($i = 1;$i<count($criteria);$i++)
{
   for($j=1;$j<count($criteria);$j++)
   {
      if(!empty($_POST['t-'.$i.'-'.$j]))
      {
        $v = $_POST['t-'.$i.'-'.$j];
        if($v < 0)  
        {
          $data[$i][$j] = 1/abs($v);
          $data[$j][$i] = abs($v);  
        }
        else{
          $data[$i][$j] = $v;  
          $data[$j][$i] = 1/abs($v);
        }
      }
   }
}
?>


<div class="wrapper">

  <?php 
//  include_once "header_menu.php";
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
<?php

echo 'Pairwise Matrix';
$sums = array();
echo '<table class="table table-bordered">';
echo '<tr>';
    // header top pairwise
    foreach($criteria as $c)
    {
      echo '<td>'.$c.'</td>';
    }
    echo '</tr>';

    // header side pairwise
for($j = 1;$j<count($criteria);$j++)
{
    $sum = 0;
      echo '<tr>';
    echo '<td>'.$criteria[$j].'</td>';
   for($i=1;$i<count($criteria);$i++)
   {
     $v = $data[$i][$j];
      echo '<td>'.$v.'</td>';
      $sum = $sum + $v;
   }
   echo '</tr>';
   $sums[$j] = $sum;
}

 echo '<tr>';
echo '<td>SUM</td>';
$sum_vertical = array();

for($col = 1;$col<count($criteria);$col++)
{
    $sum = 0;
    
   for($row=1;$row<count($criteria);$row++)
   {
     $v = $data[$col][$row];
    
      $sum = $sum + $v;
   }
   $sum_vertical[$col] = $sum;
}

for($i=1;$i<count($criteria);$i++)
{
 
  echo '<td>'.$sum_vertical[$i].'</td>';
  
}
echo '</tr>';

echo '</table>';

$it = 0;
// print_r($data);
// print_r($sum_vertical);
// exit;
$norm_matrices = array();

$priority_vector_main_criteria = array();
echo 'Normalize Matrix';
echo '<table class="table table-bordered">';
 echo '<tr>';

    foreach($criteria as $c)
    {
      echo '<td>'.$c.'</td>';
    }
    echo '<td>sum (horizontal)</td>';
    echo '<td>priority vector</td>';
     echo '<td>Eigen Value</td>';
    echo '</tr>';

$row = 0;
foreach($criteria as $c)
{
  if($it != 0)
  {

    $row++;

    
    $col = 0;

    $sum = 0;


    echo '<tr>';
    echo '<td>'.$c.'</td>';
    
    $sumvert = 0;
    foreach($criteria as $q => $v)
    {

        if($q != 0)
        {
          
            $col++;
             $sumvert = $sum_vertical[$col];

            $dt = $data[$col][$row];

            $norm_matrices[$col][$row] = $dt / $sumvert;
            echo '<td>'.($dt / $sumvert).'</td>';
            $sum = $sum + $dt / $sumvert;

        } 
    }
    $val = $sum / (count($criteria)-1);
    echo '<td>'.$sum.'</td>';
    echo '<td>'.$val.'</td>';
    echo '<td>'.$sum_vertical[$row] * $val.'</td>';
    $priority_vector_main_criteria[] = $val;

    echo '</tr>';

  }
  $it++;
  
}
echo '</table>';

/* Calculate Aggreate Mas Oddy Version */

// $isc = 0;

// // print_r($lv1);exit;

// $joinsub_criteria = array();
// foreach($lv1 as $lv)
// {
//     foreach($level2_criteriaName[$lv] as $val)
//     {
//       $joinsub_criteria[] = $val;  
//     }
    
// }

// // Get Aggregate Score From Database
// $score_aggregate = array();
// $row = 0;
// foreach($scoring as $q => $v)
// {
//     $col = 0;
//     foreach($v['value'] as $qq => $vv)
//     {
//       $score_aggregate[$row][$col] = $vv;
//       $col++;
//     }

//     $row++;
// }

// // Handle Respect to Attribute Matrix
// $respect_to = array();
// $kr = 0;
// foreach($lv1 as $q => $v) {
//   $j = 0;
//   $respect_to_value = array();

//   for($ii=0; $ii <= count($score_aggregate)-1;$ii++)
//   {
//     for($jj=0; $jj <= count($score_aggregate)-1;$jj++)
//     {
//       $respect_to_value[$ii][$jj] = 0;
//     } 
//   }

//   // print_r(count($respect_to_value[0]));
//   // die();

//   foreach($scoring as $q2 => $v2)
//   {

//     $row = $j;
//     $val_main = $score_aggregate[$row][$kr];
//     // print_r($val_main);
//     // die();
    
//     foreach($score_aggregate as $q2 => $v2)
//     {
//         if($row == count($scoring)){
//           // echo '0 ';
//           continue;
//         }
//         if($row <= count($score_aggregate/*[$row]*/))
//         {

//           $val = $val_main / $score_aggregate[$row][$kr] ;
//           // echo $val.' ';
//           $respect_to_value[$j][$row] = $val;
//           $respect_to_value[$row][$j] = 1/ $val;
//           $row++;
//         }  
        

//     }
//     // print_r($respect_to_value);
//     // die();

//     $j++;

//     // echo '<br>';
//   }

//   $respect_to[$q] = $respect_to_value;

//   $kr++;
// }

// print_r(count($respect_to));
// die();

// $sum_respect_to = array();

// $kr = 0;
// foreach($respect_to as $q => $v)
// {
//   $sum_respect_to_value = array();

//   $col = 0;
//   foreach($v as $q2 => $v2)
//   {

//     $total = 0;
//     $row = 0;
//     foreach($v2 as $qq2 => $vv2)
//     {
//       $val = $respect_to[$kr][$row][$col];
//       $total = $total + $val;
//       $row++;
//     }
//     $sum_respect_to_value[$col]= $total;
//     $col++;
//   }

//   $sum_respect_to[$q] = $sum_respect_to_value;

//   $kr++;
// }


/* Respect to Attribute Vendor Comparison */
$priority_vector_respect = array();
foreach($lv1 as $q => $v) {
  // $rtocost = array();
  // $respect_to_value = $respect_to[$q];
    
  // foreach($sc as $q => $v)
  // {
  // if($q == 0) continue;

  /* Respect To Attribute Table */
  echo '<br><strong>Respect to '.$v.'</strong>';
  echo '<div class="table-responsive">';
  echo '<table class="table table-bordered">';
  echo '<tr>';
  echo '<td>#</td>';

  // Header top instance
  foreach($scoring as $row)
  {
      echo '<td>';
      echo $row['instanceName'];
      echo '</td>';

  }
  echo '</tr>';

  // Header side instance
  $value = respectToAttr($scoring,$v);
  // print_r($value);
  // die();
  for($i=0; $i<count($scoring); $i++) {
    echo '<tr>';
    echo '<td>';
    echo $scoring[$i]['instanceName'];
    echo '</td>';
    for($j=0; $j<count($scoring); $j++) {
      echo '<td>';
      echo $value[$i][$j];
      echo '</td>';
    }
  }
  echo '<tr>';

  /* Deprecated Code Mas Oddy */
  // $i = 0;
  // foreach($scoring as $row) {  
  //   echo '<tr>';
  //   echo '<td>';
  //   echo $row['instanceName'];
  //   echo '</td>';
  //   $j = 0; 
  //   foreach($scoring as $col) {
  //     echo '<td>';
  //     $val = $respect_to_value[$i][$j];
  //     // print_r($val);
  //     echo round($val,2);
  //     echo '</td>';
  //     $j++;
  //   }
  //     $i++;
  // echo '</tr>';
  // }
  //$i = 0;

  /* SUM row */
  $sumRow = respectToAttrSum($value); // sum each column
  echo '<td>Sum</td>';
  // $sums = $sum_respect_to[$q];
  // foreach($sums as $q3 => $v3)
  // {
  //   echo '<td>'.round($v3,2).'</td>';
  // }
  for($i=0; $i<count($sumRow); $i++){
    echo "<td>$sumRow[$i]</td>";
  }
  echo '</tr>';
  echo '</table>';
  echo '</div>';
  /* End of Respect To Attribute Table */

  /* ======================================== */

  /* Normalized Respect To Attribute Table */
  // Rescpect to attribute Normalize
  echo '<br><strong>Respect to '.$v.' Normalized Matrix</strong>';
  echo '<div class="table-responsive">';
  echo '<table class="table table-bordered">';
  echo '<tr>';
  echo '<td>&nbsp;</td>';
  
  // Header Top
  foreach($scoring as $row)
  {
      echo '<td>';
      echo $row['instanceName'];
      echo '</td>';
  }
  echo '<td>SUM</td>';
  echo '<td>Priority Vector</td>';
  echo '</tr>';

  // Header side
  $norm = normRespectToAttr($value, $sumRow); // Calculate normalize matrix
  for($i=0; $i<count($scoring); $i++) {
    echo '<tr>';
    echo '<td>';
    echo $scoring[$i]['instanceName'];
    echo '</td>';
    for($j=0; $j<count($norm[$i]); $j++) {
      echo '<td>';
      echo $norm[$i][$j];
      echo '</td>';
    }
    echo "</tr>";
    // die();
  }
  echo '</table>';
  echo '</div>';
  // die();

  /* Deprecated Code Mas Oddy */
  //$i = 0;
  // foreach($scoring as $row)
  // { 
  //  echo '<tr>';

  //     echo '<td>';
  //     echo $row['provider'];
  //     echo '</td>';

      // $j = 0;
      // $sum = 0;
      // foreach($scoring as $col)
      // {

      //    echo '<td>';
          
      //    $val = $respect_to_value[$i][$j];
      //    // $sums = $sums[$q][$j];
      //    $sumvec = $val /  $sum_respect_to[$q][$j];
      //    echo round($sumvec,2);
      //    $sum = $sum +$sumvec;
      //    $j++;
      //    echo '</td>';
      // }

      // echo '<td>';
      // echo round($sum,2);
      // echo '</td>';
      // echo '<td>';
      // $prior_vect = $sum / count($scoring); 
      // echo round($prior_vect,2);

      // $priority_vector_respect[$q][$i] = $prior_vect;  
      // echo '#'.$q.'#'.$i.'#<br>';
      // echo '</td>';

      //$i++;
  // echo '</tr>';

}

  // }
//$isc++;
//}




?>         

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
$input_array = array (
    'kriteria' => $_GET['level1'],
    'priority' => $priority_vector_main_criteria
  );
?>
<form method="POST" action="calc_multilevel_adaptive.php?<?php echo http_build_query($input_array);?>" id="form-calc">



<?php 
foreach($priority_vector_main_criteria as $pr) {
?>
  <input type="hidden" name="pvec[]" value="<?php echo $pr;?>"/>
<?php 
}
?>

<?php 
$i = 0;
foreach($lv1 as $maincrit){
  echo '<h3>'.$maincrit.'</h3>';
  echo "<table width='40%'>";
  
  $sum=count($level2_criteriaName[$maincrit]);
  $data = $level2_criteriaName[$maincrit];
  
  for ($j = 0 ; $j < $sum; $j++){
    for ($k = 0 ; $k<$sum ; $k++){
      if($sum == 1){
        echo "<tr>
        <th colspan='8'>";
       ?>
       <input type='hidden' id="txt_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>" name ='<?php echo 't-'.$i.'-'.$j.'-'.$k;?>' value="1"/>

       <?php
        echo $data[0];
        echo "</th>
        </tr>
        <tr>";
      }
      if ($j<$k) {
      echo "
        <tr>
        <th colspan='4'>";
       
        echo $data[$j];
        echo "</th>

        <th colspan='4' style='text-align:right'>$data[$k]</th>
        </tr>
        <tr>
        <td colspan='8'>
      ";
 ?>
 <script>
$( function() {
    var handle = $( "#custom-handle_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>" );
    $( "#slider_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>" ).slider({
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
        // handle.text( vals[ui.value-1] );
        $('#txt_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>').val(vslider);
      }
    });
  } );
  </script>
<div id="slider_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>" class="slider">
  <div id="custom-handle_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>" class="ui-slider-handle" style="width: 2em;height: 2.0em;top: 0%;margin-top: -11px;padding : 3px;text-align: center;line-height: 1.6em;left:45%;
"></div>
</div>
<input type='hidden' id="txt_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>" name ='<?php echo 't-'.$i.'-'.$j.'-'.$k;?>' value="1"/>

 <?php
        echo "</td>
          </tr>
          <tr><td colspan='8'>
        ";

        echo '</td></tr>';
      }
    }
  }
  

  
  echo "</table>";
    $i++;
}
?><br>
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
</div>
        </div>
      </section>
    
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <strong>Copyright &copy; 2018. All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->


<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>

</body>
</html>

