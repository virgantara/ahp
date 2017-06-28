<title>AHP | Calc 3 LV AHP</title>
<?php
$time_start = microtime(true);
include_once "config.php";

$weighted_sum = array();

foreach($_POST['pvec'] as $pr)
{
  $weighted_sum[] = $pr;
}
 

 // print_r($weighted_sum);exit;
$sub_criteria_index = array();

$i =0;
$j = 0;
foreach($sub_criteria as $sc)
{
  $si = array();

  foreach($sc as $q => $v)
  {
      $si[] = $j;  

      $j++;
  }

  $sub_criteria_index[] = $si;

  $i++; 
}



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
  echo '<table border="1" width="100%">';
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
          
            echo '<td>'.$data[$j][$i].'</td>'; 
            
        

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
     echo '<td><strong>'.$sum.'</strong></td>';
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

  // $sums_norm = array();
  // $priority_vector = array();
  // for($i = 0;$i<count($sc);$i++)
  // {
  //     $sum = 0;
  //    for($j=0;$j<count($sc);$j++)
  //    {
  //      $v = $norm_matrices[$i][$j];
  //       $sum = $sum + $v;
  //    }
  //    $sums_norm[$i] = $sum;
  //    $priority_vector[$i] = $sum / (count($sc));

     
  // }

  // $eigen_values = array();
  // $sum_eigen = 0;
  // for($i=0;$i<count($sums);$i++)
  // {
  //     $eigen_values[$i] = $sums[$i] * $priority_vector[$i];
  //     $sum_eigen = $sum_eigen + $eigen_values[$i];
  // }

  $isc++;
}  

  // $consistency_index = ($sum_eigen - count($sums)) / (count($sums));
  // $r15 = 1.12;
  // $consistency_ratio = $consistency_index / $r15;
  // echo "Consistency Ratio: "  .$consistency_ratio;
  // echo '<br>';

// provider respect to cost

$isc = 0;
$priority_vector_respect = array();
foreach($joinsub_criteria as $q => $v)
{
  $rtocost = array();

  
  // foreach($sc as $q => $v)
  // {
    // if($q == 0) continue;

    echo '<br><strong>Respect to '.$v.'</strong>';
    echo '<table border="1" width="50%">';
    echo '<tr>';
    echo '<td>#</td>';
    foreach($scoring as $row)
    {

        echo '<td>';
        echo $row['provider'];
        echo '</td>';

    }

    echo '</tr>';

    $i = 0;
    foreach($scoring as $row)
    {  echo '<tr>';

        echo '<td>';
        echo $row['provider'];
        echo '</td>';

        $j = 0;
        
        foreach($scoring as $col)
        {

           echo '<td>';
           $rtocost[$i][$j] = $score_provider[$i][$q] / $score_provider[$j][$q];
           
           echo $rtocost[$i][$j];
          
           echo '</td>';
            $j++;

        }

        $i++;
    echo '</tr>';

    }

    echo '<tr>';

    $i = 0;

    
    echo '<td>Sum</td>';
    $sums_respect = array();
    $norm_respect = array();
    foreach($scoring as $col)
    {  

        $j = 0;
        $sum = 0;
        foreach($scoring as $row)
        {
           
           $sum = $sum + $rtocost[$j][$i];
           $j++;
        }

        $sums_respect[$i] = $sum;
        
        $j = 0;
        foreach($scoring as $row)
        {
           $norm_respect[$i][$j] = $rtocost[$j][$i]/$sum;
           // print_r($norm_respect[$i][$j]);
           $j++;
        }
          

        echo '<td>'.$sum.'</td>';

        // $sum = 0;

        $i++;
    

    }

    echo '</tr>';
    

    echo '</table>';
   
    echo '<br><strong>Respect to '.$v.' Normalized Matrix</strong>';
      echo '<table border="1" width="50%">';
    echo '<tr>';
    echo '<td>&nbsp;</td>';
    foreach($scoring as $row)
    {

        echo '<td>';
        echo $row['provider'];
        echo '</td>';

    }

     echo '<td>SUM</td>';
      echo '<td>Priority Vector</td>';

    echo '</tr>';

    $i = 0;

    foreach($scoring as $row)
    { 
     echo '<tr>';

        echo '<td>';
        echo $row['provider'];
        echo '</td>';

        $j = 0;
        $sum = 0;
        foreach($scoring as $col)
        {

           echo '<td>';
           
           $sum = $sum + $norm_respect[$j][$i];
           // echo 'j:'.$j.',i:'.$i.'<br>';
           echo $norm_respect[$j][$i];
           
           $j++;
           echo '</td>';
        }

        echo '<td>';
        echo $sum;
        echo '</td>';
        echo '<td>';
        $prior_vect = $sum / count($scoring); 
        echo $prior_vect;

        

        $priority_vector_respect[$q][$i] = $prior_vect;  
        // echo '#'.$q.'#'.$i.'#<br>';

         
        echo '</td>';

        $i++;
    echo '</tr>';

    }


    echo '</table>';
  // }
$isc++;
}
// print_r($priority_vector_respect);
// exit;
$isc = 0;

$weighted_sum_total = array();
foreach($sub_criteria as $sc)
{
  //##############################
  echo '<br><strong>'.$lv1[$isc].' Overall Table</strong>';
  // print_r($priority_vector_respect);
  echo '<table border="1" width="50%">';
  echo '<tr>';
  echo '<td>#</td>';
  foreach($sub_criteria_index[$isc] as $si)
  {
     
     echo '<td>'.$joinsub_criteria[$si].'</td>';
     
  }
  echo '</tr>';
  echo '<tr>';
  echo '<td><strong>Weight</td>';
  $i = 0;
  foreach($sub_criteria_index[$isc] as $si)
  { 
     
     echo '<td><strong>'.$priority_vector_criteria[$isc][$i].'</td>';
     $i++;
  }
  echo '</tr>';
  $i = 0;
  foreach($scoring as $score)
  {
    echo '<tr>';
    echo '<td>'.$score['provider'].'</td>';
        
    
    foreach($sub_criteria_index[$isc] as $si)
    {
        echo '<td>'.$priority_vector_respect[$si][$i].'</td>';
       
    }

    echo '</tr>';
    $i++;
  }

  echo '</table>';

  echo '<br><strong>'.$lv1[$isc].' Weight per provider</strong>';
  // print_r($priority_vector_respect);
  echo '<table border="1" width="50%">';
  echo '<tr>';
  echo '<td>#</td>';
  foreach($sub_criteria_index[$isc] as $si)
  {
     echo '<td>'.$joinsub_criteria[$si].'</td>';
  }

  echo '<td>TOTAL</td>';
  echo '</tr>';
  $i = 0;
  foreach($scoring as $score)
  {
    echo '<tr>';
    echo '<td>'.$score['provider'].'</td>';
        
    $j = 0;
    $sum = 0;
    foreach($sub_criteria_index[$isc] as $si)
    {
        $val = $priority_vector_respect[$si][$i];
        $weight = $priority_vector_criteria[$isc][$j];
        echo '<td>'.$val * $weight.'</td>';
        $sum = $sum + $val * $weight;
       $j++;
    }

    $weighted_sum_total[$isc][$i] = $sum;
    echo '<td>'.$sum.'</td>';

    echo '</tr>';
    $i++;
  }

  echo '</table>';

  $isc++;
}



echo '<br><strong>TOTAL WEIGHT PER PROVIDER</strong>';


echo '<table border="1" width="50%">';
echo '<tr>';
echo '<td>#</td>';
foreach($lv1 as $col)
{

    echo '<td>';
    echo $col;
    echo '</td>';

}
echo '</tr>';
echo '<tr>';
echo '<td><strong>weight lv 1</td>';
foreach($weighted_sum as $col)
{

    echo '<td><strong>';
    echo $col;
    echo '</td>';

}


echo '</tr>';

$i = 0;

$final_result = array();
foreach($scoring as $row)
{  echo '<tr>';

    echo '<td>';
    echo $row['provider'];
    echo '</td>';

    $j = 0;
    $sum = 0;

    foreach($lv1 as $col)
    {

      $val = $weighted_sum_total[$j][$i];
       echo '<td>'.$val.'</td>';
        $j++;

      
    }

    // echo '<td>'.$sum.'</td>';
    // echo '<td>'.($sum * 100).'</td>';
   

    $i++;
echo '</tr>';

}

echo '</table><br>';
echo '<table border="1" width="50%">';
echo '<tr>';
echo '<td>#</td>';
foreach($lv1 as $col)
{

    echo '<td>';
    echo $col;
    echo '</td>';

}
echo '<td>TOTAL</td>';
echo '<td>PERCENTAGE</td>';
echo '</tr>';

$i = 0;

$final_result = array();
foreach($scoring as $row)
{  echo '<tr>';

    echo '<td>';
    echo $row['provider'];
    echo '</td>';

    $j = 0;
    $sum = 0;
    foreach($lv1 as $col)
    {
      $val = $weighted_sum_total[$j][$i] * $weighted_sum[$j];
       echo '<td>'.$val.'</td>';
        $j++;

        $sum = $sum + $val;

    }

    echo '<td>'.$sum.'</td>';
    echo '<td>'.($sum * 100).'</td>';
    $final_result[] = array(
      'provider' => $row['provider'],
      'value' => $sum*100
    );



    $i++;
echo '</tr>';

}

echo '</table>';


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