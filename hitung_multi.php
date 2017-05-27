<?php


$scoring = array(
        array(
          "provider"=> "M",
          "value"=> array(100,43,49,10,45,96,100,99,5,46,46)
        )
      ,
         array(
        "provider"=> "K",
        "value"=> array(85,47,49,5,46,90,99,97,10,49,49)
        )
      ,
       array(
        "provider"=> "I",
        "value"=> array(97,44,42,10,46,95,98,99,10,45,47)
        )
      ,
       array(
        "provider"=> "A",
        "value"=> array(93 , 50 , 48 , 10,  49,  93 , 95,  98  ,5,48 ,48)
        )
      ,
       array(
        "provider"=> "B",
        "value"=> array(100,46 ,43,  10,  41,  100, 91,  97,  5,50 ,45))
      ,
       array(
        "provider"=> "T",
        "value"=> array(90,  50 , 47,  5, 45 , 92,  97 , 99  ,10,  47  ,50)
      )
);

$importance = array(
    9=>'Absolutely more important',
    7=>'Very much more important',
    5=>'Much more important',
    3=>'Somewhat more important',
    1=>'Equal importance',

  );

$criteria = array(
    0 => "*",
    1=>"Cost",
    2=>      "Security",
    3=>      "Reliability",
    4=>      "Availability",
    5=>      "Usability",
  
  );

$joinsub_criteria =  array(
      'C1',
      'S1','S2','S3','S4',
      'R1','R2',
      'A1',
      'U1','U2','U3',
);


$sub_criteria = array(
  array('C1'),
  array('S1','S2','S3','S4'),
  array('R1','R2',),
  array('A1',),
  array('U1','U2','U3',),
);

$lv1 = array(
  'Cost',
  'Security',
  'Reliability',
  'Availability',
  'Usability'
);

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

  // $consistency_index = ($sum_eigen - count($sums)) / (count($sums));
  // $r15 = 1.12;
  // $consistency_ratio = $consistency_index / $r15;
  // echo "Consistency Ratio: "  .$consistency_ratio;
  // echo '<br>';

// provider respect to cost

$isc = 0;
foreach($joinsub_criteria as $q => $v)
{
  $rtocost = array();

  $priority_vector_respect = array();
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
    {  echo '<tr>';

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
exit; 
//##############################
echo '<br><strong>Overall Table</strong>';
// print_r($priority_vector_respect);
echo '<table border="1" width="50%">';
echo '<tr>';
foreach($criteria as $q => $v)
{
   
   echo '<td>'.$v.'</td>';
   
}
echo '</tr>';
echo '<tr>';
echo '<td>Weight</td>';
foreach($priority_vector as $q => $v)
{
   
   echo '<td>'.$v.'</td>';
   
}
echo '</tr>';
$i = 1;
foreach($scoring as $score)
{
  echo '<tr>';
  echo '<td>'.$score['provider'].'</td>';
      
  
  foreach($criteria as $q => $v)
  {
    if($q == 0) continue;
      echo '<td>'.$priority_vector_respect[$q][$i].'</td>';
     
  }

  echo '</tr>';
  $i++;
}

echo '</table>';


echo '<br><strong>Weight per provider</strong>';
// print_r($priority_vector_respect);
echo '<table border="1" width="50%">';
echo '<tr>';
foreach($criteria as $q => $v)
{
   
   echo '<td>'.$v.'</td>';
   
}

echo '<td>Total</td>';
echo '<td>Percentage</td>';
echo '</tr>';
$i = 1;

$final_result = array();
foreach($scoring as $score)
{
  echo '<tr>';
  echo '<td>'.$score['provider'].'</td>';
      
  $total = 0;
  foreach($criteria as $q => $v)
  {
    if($q == 0) continue;

    $value = $priority_vector_respect[$q][$i] * $priority_vector[$q];
    $total = $total + $value;
    echo '<td>'.$value.'</td>';
     
  }

  echo '<td>'.$total.'</td>';
   echo '<td>'.($total*100).'</td>';
   $final_result[] = array(
      'provider' => $score['provider'],
      'value' => $total*100
    );

  echo '</tr>';
  $i++;
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
?>