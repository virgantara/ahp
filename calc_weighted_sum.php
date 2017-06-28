<title>AHP | Calc 3 LV Weighted SUM</title>
<?php
$time_start = microtime(true);
include_once "config.php";

$weighted_sum = array();

// Receive weighted sum from previous level
foreach($_POST['pvec'] as $pr)
{
  $weighted_sum[] = $pr;
}
 
/*
Calculate priority vector
*/
$isc = 0;
$priority_vector_criteria = array();
foreach($sub_criteria as $sc)
{


  $data = array();


/*
Initialize value for data matrices
*/
  for($i = 0;$i<count($sc);$i++)
  {
     for($j=0;$j<count($sc);$j++)
     {
        $data[$i][$j] = 1;
        
     }
  }



/*
Set value from POST data in previous pairwise matrix 
*/
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

/*
Sum all score from previous pairwise matrix
*/
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
  }

  $i = 0;
  foreach($sc as $c)
  {
      $j = 0;
      $sum = 0;
      foreach($sc as $q => $v)
      {
          $sum = $sum + ($data[$j][$i]/$sums[$j]);  
          $j++;
      }

      // Calculate priority vector for each main criteria.
      $priority_vector_criteria[$isc][$i] = $sum/count($sc);

      $i++;
    
  }


  $isc++;
}  


?>

<!--
Generate Provider Table Scores
-->
<table border="1" width="50%">
<tr>
<td>*</td>
<?php 
foreach($joinsub_criteria as $q => $v)
{
?>
  <td><?php echo $v;?></td>
<?php 
}
?>
</tr>
<?php 
foreach($scoring as $score)
{
?>
<tr>
 <td>
   <?php echo $score['provider'];?>
 </td>
 <?php foreach($score['value'] as $qq => $vv){ ?>
 
 <td>
  <?php echo $vv;?>  
 </td> 
 <?php 
}
 ?>
</tr>
<?php 
}
?>
</table>

<!--
Generate Tables as in the Sheet 3 LEVEL WEIGHTED SUM VER2 A9 - D20
-->

<table border="1" width="50%">
  <tr>
    <th>1st Level<br>Param</th>
    <th>Weight</th>
    <th>Sub<br>Params</th>
    <th>Weight</th>
  </tr>

  <?php 
    $i = 0;
    foreach($sub_criteria as $sc){
      $j=0;
      foreach($sc as $s){
  ?>

  <tr>
    <td><?php 
    if($j==0)
      echo $lv1[$i];
    ?></td>
    <td>
    <?php 
    if($j==0) 
      echo $weighted_sum[$i];
    ?></td>
    <td><?php echo $s;?></td>
    <td>
    <?php 
      $v = $priority_vector_criteria[$i][$j];
      echo round($v*100,2).' %';
    ?>
      
    </td>
  </tr>

  <?php 
      $j++;
    }
    $i++;
  }
  ?>
</table>

<?php

/*
Here, we calculate the utility, sum of utility, and sum of weighted utility for each provider as in the Sheet
3 LEVEL WEIGHTED SUM VER2 Cell A23
*/

$g = 0;
$final_result = array();
$sum_of_utility = array();
$weighted_utility = array();
$sum_of_weighted_utility = array();
foreach($scoring as $sc_prov)
{  

    
 $i = 0;
 $h = 0;
    
$sowu = 0;
  foreach($sub_criteria as $sc)
  {
    $j=0;
    
    $sum = 0;

    foreach($sc as $s)
    {
       $val = $sc_prov['value'][$h];
       $wgt = $priority_vector_criteria[$i][$j];

      $sum = $sum + ($val * $wgt);
       // echo $sum.'<br>';  
       $h++;     
      $j++;
    }

     // echo $g.' -- '.$sum.'<br><br>';

    $v = $weighted_sum[$i];  
    $sum_of_utility[$g][$i] = $sum;
    $vw = $sum * $v;

    $sowu = $sowu + $vw;
    $weighted_utility[$g][$i] = $vw;
    
    $i++;
  }

  $sum_of_weighted_utility[$g] = $sowu;


  

  $g++;
}

$g = 0;
$final_result = array();
// begin score per provider
foreach($scoring as $sc_prov)
{

?>


<!--
Generate Tables as in the Sheet 3 LEVEL WEIGHTED SUM VER2 for each provider related to their weighted score
-->

<h3>PROVIDER <?php echo $sc_prov['provider'];?></h3>
<table border="1" width="60%">
  <tr>
    <td>PARAM</td>
    <td>SUB<br>PARAM</td>
    <td>VALUE</td>
    <td>WEIGHT</td>
    <td>UTILITY</td>
    <td>UTILITY<br>TOTAL</td>
    <td>WEIGHTED</td>
  </tr>
  <?php 
 $i = 0;
 $h = 0;
foreach($sub_criteria as $sc){
  $j=0;
  foreach($sc as $s){
  ?>
  <tr>
    <td><?php echo ($j==0) ? $lv1[$i] : '';?></td>
    <td><?php echo $s;?></td>
    <td>
    <?php 
    $val = $sc_prov['value'][$h];
    echo $val;
    ?></td>
    <td>
      <?php 
      $wgt = $priority_vector_criteria[$i][$j];
      echo round($wgt*100,2).' %';
      ?>

    </td>
    <td>
      <?php echo round($val * $wgt,2);?>
    </td>
    <td>
    <?php 
    if($j==0)
    {
      echo round($sum_of_utility[$g][$i],2);
    }
    ?></td>
    <td>
      <?php 
    if($j==0)
    {
      echo $weighted_utility[$g][$i];
    }
    ?>
    </td>
  </tr>
  <?php
  $h++;
    $j++; 
  }
  $i++;
}
  ?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>TOTAL</td>
    <td><?php echo $sum_of_weighted_utility[$g];?></td>
  </tr>
</table>

<?php 

  $final_result[] = array(
    'provider' => $sc_prov['provider'],
    'value' => $sum_of_weighted_utility[$g]
  );

  $g++;
} // end score per provider

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