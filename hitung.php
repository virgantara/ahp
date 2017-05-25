<?php


$scoring = array(
        array(
          "provider"=> "M",
          "value"=> array(
            1=> 14,
            2=> 38,
            3=> 90,
            4=> 73,
            5=> 47
          )
        )
      ,
         array(
        "provider"=> "K",
        "value"=> array(
          1=> 45,
          2=> 24,
          3=> 55,
          4=> 12,
          5=> 37
        )
        )
      ,
       array(
        "provider"=> "I",
        "value"=> array(
          1=> 55,
          2=> 47,
          3=> 68,
          4=> 74,
          5=> 25
        ))
      ,
       array(
        "provider"=> "A",
        "value"=> array(
          1=> 31,
          2=> 71,
          3=> 36,
          4=> 21,
          5=> 80
        ))
      ,
       array(
        "provider"=> "B",
        "value"=> array(
          1=> 95,
          2=> 48,
          3=> 10,
          4=> 19,
          5=> 33
        ))
      ,
       array(
        "provider"=> "T",
        "value"=> array(
          1=> 62,
          2=> 65,
          3=> 49,
          4=> 24,
          5=> 47
        )
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

$score_provider = array();


$j = 1;
foreach($scoring as $s)
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

echo 'Pairwise Matrix';
echo '<table border="1" width="100%">';
echo '<tr>';
foreach($criteria as $c)
{
   echo '<td>'.$c.'</td>';
}
echo '</tr>';

$it = 0;
$i = 0;
$j = 0;
foreach($criteria as $c)
{
  if($it != 0)
  {

    $i++;
    echo '<tr>';
    

    foreach($criteria as $q => $v)
    {
        if($q == 0  )
        {
          echo '<td>'.$criteria[$it].'</td>';
        }

        else
        {
          
          $j++;
            echo '<td>'.$data[$i][$j].'</td>'; 
        }
    }

    $j =0;
    echo '</tr>';

  }
  $it++;
  
}
echo '<tr>';
echo '<td><strong>Sum</strong></td>';
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
   echo '<td><strong>'.$sum.'</strong></td>';
}
echo '</tr>';
echo '</table>';

echo 'Normalize Matrix';
echo '<table border="1" width="100%">';
echo '<tr>';
foreach($criteria as $c)
{
   echo '<td>'.$c.'</td>';
}
echo '</tr>';

$it = 0;
$i = 0;
$norm_matrices = array();
foreach($criteria as $c)
{
  if($it != 0)
  {

    $i++;
    echo '<tr>';
    
    $j = 0;

    foreach($criteria as $q => $v)
    {
        if($q == 0  )
        {
          echo '<td>'.$criteria[$it].'</td>';
        }

        else
        {
          
          $j++;
            $norm_matrices[$i][$j] = $data[$i][$j]/$sums[$j];
            echo '<td>'.$data[$i][$j]/$sums[$j].'</td>';
          
        }

          
    }


    echo '</tr>';

  }
  $it++;
  
}
echo '</table>';


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

// provider respect to cost

$rtocost = array();

  $priority_vector_respect = array();
foreach($criteria as $q => $v)
{
  if($q == 0) continue;

  echo '<br><strong>Respect to '.$v.'</strong>';
  echo '<table border="1" width="50%">';
  echo '<tr>';
  echo '<td>&nbsp;</td>';
  foreach($scoring as $row)
  {

      echo '<td>';
      echo $row['provider'];
      echo '</td>';

  }

  echo '</tr>';

  $i = 1;
  foreach($scoring as $row)
  {  echo '<tr>';

      echo '<td>';
      echo $row['provider'];
      echo '</td>';

      $j = 1;
      foreach($scoring as $col)
      {

         echo '<td>';
         $rtocost[$i][$j] = $score_provider[$q][$i] / $score_provider[$q][$j];
         
         echo $rtocost[$i][$j];
         
         $j++;
         echo '</td>';
      }

      $i++;
  echo '</tr>';

  }

  echo '<tr>';

  $i = 1;

  
  echo '<td>Sum</td>';
  $sums_respect = array();
  $norm_respect = array();
  foreach($scoring as $col)
  {  

      $j = 1;
      $sum = 0;
      foreach($scoring as $row)
      {
         
         $sum = $sum + $rtocost[$j][$i];
         $j++;
      }

      $sums_respect[$i] = $sum;
      
      $j = 1;
      foreach($scoring as $row)
      {
         $norm_respect[$i][$j] = $rtocost[$j][$i]/$sum;
         $j++;
      }
        

      echo '<td>'.$sum.'</td>';

      $sum = 0;

      $i++;
  

  }

  echo '</tr>';
  

  echo '</table>';
echo '<br><strong>Normalize Matrix</strong>';
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

  $i = 1;

  foreach($scoring as $row)
  {  echo '<tr>';

      echo '<td>';
      echo $row['provider'];
      echo '</td>';

      $j = 1;
      $sum = 0;
      foreach($scoring as $col)
      {

         echo '<td>';
         
         $sum = $sum + $norm_respect[$j][$i];
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
}

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