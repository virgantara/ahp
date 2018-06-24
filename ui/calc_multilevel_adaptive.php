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
/* Deprecated 
include_once "head.php";
include_once "config.php";
include_once "db_helper.php";
$scoring = getProviderScore();
*/

ini_set('max_execution_time', 300); // set max execution for 5 minutes
$time_start = microtime(true);
include_once "config.php";
include_once "mongoQueryBeginner.php";
include "utils.php";
$scoring = $instanceDataLevel2;
?>

<?php
// $lv1 = $_GET['kriteria'];

$criteria = $_GET['kriteria'];
array_splice($criteria, 0,1);
array_unshift($criteria, '*');
$lv1 = $criteria;
array_splice($lv1, 0,1);

$weighted_sum = array();
foreach($_POST['pvec'] as $pr){
  $weighted_sum[] = $pr;
}
 
$joinsub_criteria = array();
$sub_criteria = array();

foreach($lv1 as $lv){
  $sub_criteria[] = $level2_criteriaName[$lv]; 
    foreach($level2_criteriaName[$lv] as $val){
      $joinsub_criteria[] = $val;  
    }
}

// print_r($sub_criteria);exit;
// print_r($weighted_sum);exit;

$sub_criteria_index = array();

$i =0;
foreach($all_joinsub_criteria as $q1 => $v1){
  $j = 0;
  foreach($joinsub_criteria as $q => $v){
    if($v1 == $v){
      $sub_criteria_index[] = $q1;
      break;
    }  
    $j++;
  }
  // $sub_criteria_index[] = $si;
  $i++; 
}
// print_r($sub_criteria_index);
// die();



// $score_provider = array();
// $i=0;
// foreach($scoring as $row){
//   for($j=0;$j<count($joinsub_criteria);$j++){
//     $score_provider[$i][$j] = $row['instanceName'][$j];
//   }
//   $i++;
// }

?>


<div class="wrapper">

  <?php 
 // include_once "header_menu.php";
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


$isc = 0;
$priority_vector_criteria = array();
foreach($sub_criteria as $sc){
  $data = array();
  for($i = 0;$i<count($sc);$i++){
     for($j=0;$j<count($sc);$j++){
        $data[$i][$j] = 1;
     }
  }

  for($i = 0;$i<count($sc);$i++)
  {
    for($j=0;$j<count($sc);$j++){
      if(!empty($_POST['t-'.$isc.'-'.$i.'-'.$j])){
        $v = $_POST['t-'.$isc.'-'.$i.'-'.$j];
        if($v < 0)  {
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




  echo '<br><strong>Pairwise Matrix : '.$lv1[$isc];
  echo '<table class="table table-bordered">';
  echo '<tr>';
  echo '<td>*</td>';
  foreach($sc as $c){
     echo '<td>'.$c.'</td>';
  }
  echo '</tr>';
  $i = 0;
  foreach($sc as $c){  
    echo '<tr>';
    echo '<td>'.$c.'</td>';

    $j =0;
    foreach($sc as $q => $v){    
      echo '<td>'.round($data[$j][$i],2).'</td>'; 
      $j++;
    }
    echo '</tr>';
    $i++;
  }

  echo '<tr>';
  echo '<td><strong>Sum</strong></td>';
  $sums = array();
  for($j = 0;$j<count($sc);$j++){
    $sum = 0;
     for($i=0;$i<count($sc);$i++)
     {
       $v = $data[$j][$i];
        $sum = $sum + $v;
     }
     $sums[$j] = $sum;
     echo '<td><strong>'.round($sum,2).'</strong></td>';
  }
  echo '</tr>';
  echo '</table>';

  

  echo '<strong>Normalized Matrix : '.$lv1[$isc];
  echo '<table class="table table-bordered">';
  echo '<tr>';
  echo '<td>*</td>';
  foreach($sc as $c){
     echo '<td>'.$c.'</td>';
  }
  echo '<td>SUM</td><td>Priority Vector</td>';
  echo '</tr>';

  $i = 0;
  $norm_matrices = array();
  foreach($sc as $c){
    echo '<tr>';
    $j = 0;
    $sum = 0;
    echo '<td>'.$c.'</td>';
    foreach($sc as $q => $v){
      $norm_matrices[$i][$j] = $data[$j][$i]/$sums[$j];
      echo '<td>'.$data[$j][$i]/$sums[$j].'</td>';
      $sum = $sum + ($data[$j][$i]/$sums[$j]);  
      $j++;
    }

    echo '<td>'.$sum.'</td>';
    $priority_vector_criteria[$isc][$i] = $sum/count($sc);
    echo '<td>'.round($sum/count($sc),2).'</td>';
    echo '</tr>';
    $i++; 
  }
  echo '</table>';

  $sums_norm = array();
  $priority_vector = array();
  for($i = 0;$i<count($sc);$i++){
    $sum = 0;
    for($j=0;$j<count($sc);$j++){
      $v = $norm_matrices[$i][$j];
      $sum = $sum + $v;
    }
    $sums_norm[$i] = $sum;
    $priority_vector[$i] = $sum / (count($sc));
  }

  $eigen_values = array();
  $sum_eigen = 0;
  for($i=0;$i<count($sums);$i++){
    $eigen_values[$i] = $sums[$i] * $priority_vector[$i];
    $sum_eigen = $sum_eigen + $eigen_values[$i];
  }
  $isc++;
}


echo 'Simple Additive Weight<br>';
echo '<table class="table table-bordered">';
echo '<tr>';
echo '<th>1ST LEVEL PARAM</th><th>WEIGHT</th><th>SUB<br>PARAMS</th><th>WEIGHT</th>';
echo '</tr>';
$i = 0;
foreach($sub_criteria as $q => $v){
  $j = 0;
  foreach($v as $q1 => $v1){
    echo '<tr>';
    echo '<td>';
    if($q1 == 0)
      echo $lv1[$i];
    echo '</td>';
    echo '<td>';
    if($q1 == 0)
      echo $_GET['priority'][$i];
    
    echo '</td>';
    echo '<td>';
    echo $v1;
    echo '</td>';
    echo '<td>';
    echo round(($priority_vector_criteria[$i][$j] * 100),2).' %';
    echo '</td>';
    echo '</tr>';
    $j++;
  }
  $i++;
}
echo '</table>';


// TODO: Check this code
$overall_total_weight = array();
foreach($scoring as $qm => $qv) {
  echo 'Instance '.$qv['vendorName']. ' - ' .$qv['instanceName'].'<br>';
  echo '<table class="table table-bordered">';
  echo '<tr>';
  // Param is Attribute Level 1
  // Subparam is Attribute Level 2
  echo '<th>PARAM</th><th>SUBPARAM</th><th>VALUE</th>';
  echo '<th>WEIGHT</th><th>UTILITY</th><th>UTILITY TOTAL</th><th>WEIGHTED</th>';
  echo '</tr>';
  $i = 0;
  // $idx = 0;
  // $idx2 = 0;

  $total_weight = 0;
  // print_r($sub_criteria);
  // echo "<br/>";
  // print_r($lv1);
  // die();
  
  foreach($sub_criteria as $q => $v){
    // SUM Level 1
    $j = 0;
    $sum_utility = 0;
    foreach($v as $q1 => $v1){
      $w = $qv[$lv1[$i]][$v1];
      // print_r($w);
      // die();
      $pv = $priority_vector_criteria[$i][$j];
      $sum_utility = $sum_utility + ($pv * $w);
      $j++;
    }


    $j = 0;
    foreach($v as $q1 => $v1)
    {
      echo '<tr>';
      echo '<td>';
      if($q1 == 0)
        echo $lv1[$i];
      echo '</td>';
      echo '<td>';
      echo $v1;
      
      echo '</td>';
      echo '<td>';
      $w = $qv[$lv1[$i]][$v1];
      echo $w;
      echo '</td>';
      echo '<td>';
      $pv = $priority_vector_criteria[$i][$j];
      echo ($pv * 100).' %';
      echo '</td>';
      echo '<td>';

      echo $pv * $w; // utility
      echo '</td>';
      echo '<td>';
      if($q1 == 0)
        echo $sum_utility;
      echo '</td>';
      echo '<td>';
      if($q1 == 0){
        echo $sum_utility * $_GET['priority'][$i];
        $total_weight = $total_weight + $sum_utility * $_GET['priority'][$i];
      }
      echo '</td>';
      echo '</tr>';
      $j++;
    }

    $i++;
  }

  echo '<tr>';
  echo '<th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th>';
  echo '<th>&nbsp;</th><th>&nbsp;</th><th>TOTAL</th><th>'.$total_weight.'</th>';
  echo '</tr>';
  echo '</table>';

  $overall_total_weight[] = array(
    'provider' => $qv['vendorName']. ' -  ' .$qv['instanceName'],
    'value' => $total_weight
  );
}
  // $consistency_index = ($sum_eigen - count($sums)) / (count($sums));
  // $r15 = 1.12;
  // $consistency_ratio = $consistency_index / $r15;
  // echo "Consistency Ratio: "  .$consistency_ratio;
  // echo '<br>';

// provider respect to cost

$final_result = $overall_total_weight;

usort($final_result, function($a, $b) {
  $a = $a['value'];
  $b = $b['value'];
if ($a == $b) { return 0; }
  return ($a < $b) ? -1 : 1;
});

$final_result = array_reverse($final_result);
echo '<strong>Recommended Instance</strong>';
echo '<table class="table table-bordered">';
echo '<tr><th>Provider</th><th>Value</th><th>Rank</th></tr>';
$i = 1;
foreach($final_result as $fr)
{
   echo '<tr>';
   echo '<td>'.$fr['provider'].'</td><td>'.$fr['value'].'</td><td>'.$i.'</td>';
   echo '</tr>';
   $i++;
}
echo '</table>';

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start);

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Secs';
?>
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


<!-- 
<a href="admin.php">Config</a> -->
<!-- <?php 
// include "script.php";
?> -->
