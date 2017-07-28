<?php
$time_start = microtime(true);
include_once "config.php";

// $lv1 = $_GET['kriteria'];

$criteria = $_GET['kriteria'];

array_splice($criteria, 0,1);

array_unshift($criteria, '*');

$lv1 = $criteria;

array_splice($lv1, 0,1);

$weighted_sum = array();

foreach($_POST['pvec'] as $pr)
{
  $weighted_sum[] = $pr;
}
 
$joinsub_criteria = array();
$sub_criteria = array();

foreach($lv1 as $lv)
{
  $sub_criteria[] = $sub_criteria_name[$lv]; 
    foreach($sub_criteria_name[$lv] as $val)
    {
      $joinsub_criteria[] = $val;  
    }
    
}

// print_r($sub_criteria);exit;


 // print_r($weighted_sum);exit;
$sub_criteria_index = array();

$i =0;
foreach($all_joinsub_criteria as $q1 => $v1)
{

  $j = 0;
  foreach($joinsub_criteria as $q => $v)
  {
      
      if($v1 == $v)
      {
        $sub_criteria_index[] = $q1;
        break;
      }  

      $j++;
  }

  // $sub_criteria_index[] = $si;

  $i++; 
}

// print_r($sub_criteria_index);exit;



$score_provider = array();


$i=0;
foreach($scoring as $row)
{
    for($j=0;$j<count($joinsub_criteria);$j++)
    {
        $score_provider[$i][$j] = $row['value'][$j];
    }

    $i++;
}

$isc = 0;
$priority_vector_criteria = array();
foreach($sub_criteria as $sc)
{


  $data = array();


  for($i = 0;$i<count($sc);$i++)
  {
     for($j=0;$j<count($sc);$j++)
     {
        $data[$i][$j] = 1;
        
     }
  }




  for($i = 0;$i<count($sc);$i++)
  {
     for($j=0;$j<count($sc);$j++)
     {
        if(!empty($_POST['t-'.$isc.'-'.$i.'-'.$j]))
        {
          $v = $_POST['t-'.$isc.'-'.$i.'-'.$j];
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



  echo '<br><strong>Pairwise Matrix : '.$lv1[$isc];
  echo '<table border="1" width="50%">';
  echo '<tr>';
  echo '<td>*</td>';
  foreach($sc as $c)
  {
     echo '<td>'.$c.'</td>';
  }
  echo '</tr>';

  $i = 0;
  foreach($sc as $c)
  {
    

      
    echo '<tr>';
    echo '<td>'.$c.'</td>';

     $j =0;
    foreach($sc as $q => $v)
    {
          
            echo '<td>'.round($data[$j][$i],3).'</td>'; 
            
        

        $j++;
    }

   
    echo '</tr>';
    $i++;
    
  
    
  }
  echo '<tr>';
  echo '<td><strong>Sum</strong></td>';
  $sums = array();
  for($j = 0;$j<count($sc);$j++)
  {
      $sum = 0;
     for($i=0;$i<count($sc);$i++)
     {
       $v = $data[$j][$i];
        $sum = $sum + $v;
     }
     $sums[$j] = $sum;
     echo '<td><strong>'.round($sum,3).'</strong></td>';
  }
  echo '</tr>';
  echo '</table>';

  

  echo '<br><strong>Normalized Matrix : '.$lv1[$isc];
  echo '<table border="1" width="100%">';
  echo '<tr>';
  foreach($sc as $c)
  {
     echo '<td>'.$c.'</td>';
  }
  echo '<td>SUM</td><td><strong>Priority Vector</td>';
  echo '</tr>';

  $i = 0;
  $norm_matrices = array();
  foreach($sc as $c)
  {
    

      
      echo '<tr>';
      
      $j = 0;
      $sum = 0;
      foreach($sc as $q => $v)
      {
            
          $norm_matrices[$i][$j] = $data[$j][$i]/$sums[$j];
          echo '<td>'.$data[$j][$i]/$sums[$j].'</td>';
          
          $sum = $sum + ($data[$j][$i]/$sums[$j]);  
          

            $j++;
      }

      echo '<td>'.$sum.'</td>';
      $priority_vector_criteria[$isc][$i] = $sum/count($sc);
      echo '<td>'.$sum/count($sc).'</td>';
      echo '</tr>';
      $i++;
    
  }
  echo '</table>';

  $sums_norm = array();
  $priority_vector = array();
  for($i = 0;$i<count($sc);$i++)
  {
      $sum = 0;
     for($j=0;$j<count($sc);$j++)
     {
       $v = $norm_matrices[$i][$j];
        $sum = $sum + $v;
     }
     $sums_norm[$i] = $sum;
     $priority_vector[$i] = $sum / (count($sc));

     
  }

  $eigen_values = array();
  $sum_eigen = 0;
  for($i=0;$i<count($sums);$i++)
  {
      $eigen_values[$i] = $sums[$i] * $priority_vector[$i];
      $sum_eigen = $sum_eigen + $eigen_values[$i];
  }

  $isc++;
}  

echo 'Simple Additive Weight<br>';
echo '<table border="1" width="50%">';
echo '<tr>';
echo '<th>1ST LEVEL PARAM</th><th>WEIGHT</th><th>SUB<br>PARAMS</th><th>WEIGHT</th>';
echo '</tr>';
$i = 0;
foreach($sub_criteria as $q => $v)
{
  $j = 0;
  foreach($v as $q1 => $v1)
  {
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
    echo round(($priority_vector_criteria[$i][$j] * 100),3).' %';
    echo '</td>';
    echo '</tr>';
    $j++;
  }

  $i++;
}
echo '</table>';

$overall_total_weight = array();
foreach($scoring as $qm => $qv)
{
  echo 'Provider '.$qv['provider'].'<br>';
  echo '<table border="1" width="80%">';
  echo '<tr>';
  echo '<th>PARAM</th><th>SUBPARAM</th><th>VALUE</th>';
  echo '<th>WEIGHT</th><th>UTILITY</th><th>UTILITY TOTAL</th><th>WEIGHTED</th>';
  echo '</tr>';
  $i = 0;
  $idx = 0;
  $idx2 = 0;

  $total_weight = 0;
  foreach($sub_criteria as $q => $v)
  {

    $j = 0;
    $sum_utility = 0;
    foreach($v as $q1 => $v1)
    {
      $w = $qv['value'][$sub_criteria_index[$idx]];
      
      $pv = $priority_vector_criteria[$i][$j];
      
      $sum_utility = $sum_utility + ($pv * $w);

      $idx++;
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
      $w = $qv['value'][$sub_criteria_index[$idx2]];
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
      $idx2++;
    }

    $i++;
  }

  echo '<tr>';
  echo '<th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th>';
  echo '<th>&nbsp;</th><th>&nbsp;</th><th>TOTAL</th><th>'.$total_weight.'</th>';
  echo '</tr>';
  echo '</table>';

  $overall_total_weight[] = array(
    'provider' => $qv['provider'],
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
echo '<strong>Recommended Provider</strong>';
echo '<table border="1" width="25%">';
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