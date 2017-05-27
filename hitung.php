<?php

include_once "config.php";

$score_provider = array();


$j = 1;
foreach($scoring_main as $s)
{
    for($i=1;$i<count($criteria);$i++)
    {
        $score_provider[$i][$j] = $s['value'][$i];
    }

    $j++;
}

$data = array();


for($i = 1;$i<count($criteria);$i++)
{
   for($j=1;$j<count($criteria);$j++)
   {
      $data[$i][$j] = 1;
      
   }
}



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

$sums = array();
for($j = 1;$j<count($criteria);$j++)
{
    $sum = 0;
   for($i=1;$i<count($criteria);$i++)
   {
     $v = $data[$i][$j];
      $sum = $sum + $v;
   }
   $sums[$j] = $sum;
}
$it = 0;
$i = 0;
$norm_matrices = array();

$priority_vector_main_criteria = array();
foreach($criteria as $c)
{
  if($it != 0)
  {

    $i++;

    
    $j = 0;

    $sum = 0;
    foreach($criteria as $q => $v)
    {
        if($q == 0  )
        {
         
        }

        else
        {
          
            $j++;
            $norm_matrices[$i][$j] = $data[$i][$j]/$sums[$j];
            // echo '<td>'.$data[$i][$j]/$sums[$j].'</td>';
            $sum = $sum + $data[$i][$j]/$sums[$j];

        } 
    }
    $val = $sum / (count($criteria)-1);
    // echo '<td>'.$sum.'</td>';
    // echo '<td>'.$val.'</td>';
    $priority_vector_main_criteria[] = $val;

    // echo '</tr>';

  }
  $it++;
  
}
// echo '</table>';


$sums_norm = array();
$priority_vector = array();
for($i = 1;$i<count($criteria);$i++)
{
    $sum = 0;
   for($j=1;$j<count($criteria);$j++)
   {
     $v = $norm_matrices[$i][$j];
      $sum = $sum + $v;
   }
   $sums_norm[$i] = $sum;
   $priority_vector[$i] = $sum / (count($criteria)-1);

   
}

$eigen_values = array();
$sum_eigen = 0;
for($i=1;$i<=count($sums);$i++)
{
    $eigen_values[$i] = $sums[$i] * $priority_vector[$i];
    $sum_eigen = $sum_eigen + $eigen_values[$i];
}


$consistency_index = ($sum_eigen - count($sums)) / (count($sums) - 1);
$r15 = 1.12;
$consistency_ratio = $consistency_index / $r15;
echo "Consistency Ratio: "  .$consistency_ratio;
echo '<br>';

?>