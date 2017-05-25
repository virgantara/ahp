<?php


$scoring = array(
    
        "provider"=> "M",
        "value"=> array(
          "cost"=> 14,
          "security"=> 38,
          "reliability"=> 90,
          "availability"=> 73,
          "usability"=> 47
        )
      ,
      
        "provider"=> "K",
        "value"=> array(
          "cost"=> 45,
          "security"=> 24,
          "reliability"=> 55,
          "availability"=> 12,
          "usability"=> 37
        )
      ,
      
        "provider"=> "I",
        "value"=> array(
          "cost"=> 55,
          "security"=> 47,
          "reliability"=> 68,
          "availability"=> 74,
          "usability"=> 25
        )
      ,
      
        "provider"=> "A",
        "value"=> array(
          "cost"=> 31,
          "security"=> 71,
          "reliability"=> 36,
          "availability"=> 21,
          "usability"=> 80
        )
      ,
      
        "provider"=> "B",
        "value"=> array(
          "cost"=> 95,
          "security"=> 48,
          "reliability"=> 10,
          "availability"=> 19,
          "usability"=> 33
        )
      ,
      
        "provider"=> "T",
        "value"=> array(
          "cost"=> 62,
          "security"=> 65,
          "reliability"=> 49,
          "availability"=> 24,
          "usability"=> 47
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
$j = 0;
$norm_matrices = array();
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
            $norm_matrices[$i][$j] = $data[$i][$j]/$sums[$j];
            echo '<td>'.$data[$i][$j]/$sums[$j].'</td>';
          
        }

          
    }

    $j =0;
    echo '</tr>';

  }
  $it++;
  
}
echo '</table>';

?>

<?php

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



?>