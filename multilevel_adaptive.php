<?php 

include_once "config.php";

$criteria = $_GET['kriteria'];

array_splice($criteria, 0,1);

array_unshift($criteria, '*');

$lv1 = $criteria;

array_splice($lv1, 0,1);

// print_r($criteria);exit;

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


echo 'Pairwise Matrix';
$sums = array();
echo '<table border="1">';
echo '<tr>';

    foreach($criteria as $c)
    {
      echo '<td>'.$c.'</td>';
    }
    echo '</tr>';
  
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
echo '<table border="1">';
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
            echo '<td>'.$dt.'</td>';
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

$isc = 0;

// print_r($lv1);exit;

$joinsub_criteria = array();
foreach($lv1 as $lv)
{
    foreach($sub_criteria_name[$lv] as $val)
    {
      $joinsub_criteria[] = $val;  
    }
    
}



$score_aggregate = array();

$row = 0;
foreach($aggregate_scoring as $q => $v)
{
    $col = 0;
    foreach($v['value'] as $qq => $vv)
    {
      $score_aggregate[$row][$col] = $vv;
      $col++;
    }

    $row++;
}

$respect_to = array();

$kr = 0;
foreach($lv1 as $q => $v)
{

  $j = 0;
  $respect_to_value = array();

  for($ii = 0 ; $ii <= count($score_aggregate[0]);$ii++)
  {
    for($jj = 0 ; $jj <= count($score_aggregate[0]);$jj++)
    {
      $respect_to_value[$ii][$jj] = 0;
    } 
  }

  foreach($aggregate_scoring as $q2 => $v2)
  {

    $row = $j;
    
    $val_main = $score_aggregate[$row][$kr];
    
    foreach($score_aggregate as $q2 => $v2)
    {

       
        if($row == 6){
          // echo '0 ';
          continue;
        }

                  

        if($row <= count($score_aggregate[$row]))
        {
          $val = $val_main / $score_aggregate[$row][$kr] ;
          // echo $val.' ';
          $respect_to_value[$j][$row] = $val;
          $respect_to_value[$row][$j] = 1/ $val;
          $row++;
        }  
        

    }

    $j++;

    // echo '<br>';
  }

  $respect_to[$q] = $respect_to_value;

  $kr++;
}

$sum_respect_to = array();

$kr = 0;
foreach($respect_to as $q => $v)
{
  $sum_respect_to_value = array();

  $col = 0;
  foreach($v as $q2 => $v2)
  {

    $total = 0;
    $row = 0;
    foreach($v2 as $qq2 => $vv2)
    {
      $val = $respect_to[$kr][$row][$col];
      $total = $total + $val;
      $row++;
    }
    $sum_respect_to_value[$col]= $total;
    $col++;
  }

  $sum_respect_to[$q] = $sum_respect_to_value;

  $kr++;
}


$priority_vector_respect = array();
foreach($lv1 as $q => $v)
{
  $rtocost = array();

    $respect_to_value = $respect_to[$q];
    
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
           $val = $respect_to_value[$i][$j];
           // print_r($val);
          echo $val;
           echo '</td>';
            $j++;

        }

        $i++;
    echo '</tr>';

    }

    echo '<tr>';

    $i = 0;

    
    echo '<td>Sum</td>';
    $sums = $sum_respect_to[$q];
    foreach($sums as $q3 => $v3)
    {
      echo '<td>'.$v3.'</td>';
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
           
           $val = $respect_to_value[$i][$j];
           // $sums = $sums[$q][$j];
           $sumvec = $val /  $sum_respect_to[$q][$j];
           echo $sumvec;
           $sum = $sum +$sumvec;
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



?>
<script src="<?php echo $baseurl;?>/assets/js/jquery.min.js"></script>
<script src="<?php echo $baseurl;?>/assets/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $baseurl;?>/assets/css/jquery-ui.css">
  <style>
  .custom-handle {
    width: 3em;
    height: 1.6em;
    top: 50%;
    margin-top: -5px;
    padding : 5px;
    /*margin-bottom: 30px*/
    text-align: center;
    line-height: 1.6em;

  }

  </style>
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
    'kriteria' => $_GET['kriteria'],
    'priority' => $priority_vector_main_criteria
  );
?>
<form method="POST" action="calc_multilevel_adaptive.php?<?php echo http_build_query($input_array);?>">

<?php 

foreach($priority_vector_main_criteria as $pr)
{


?>
<input type="hidden" name="pvec[]" value="<?php echo $pr;?>"/>
<?php 
}
?>
<?php 
$i = 0;
foreach($lv1 as $maincrit)
{
  echo '<h3>'.$maincrit.'</h3>';
  echo "<table width='40%'>";
  
  $sum=count($sub_criteria[$i]);
  $data = $sub_criteria[$i];
  


  for ($j = 0 ; $j < $sum; $j++)
  {

    for ($k = 0 ; $k<$sum ; $k++)
    {

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
      # code...

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
        
        handle.text( vals[ui.value-1] );
        $('#txt_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>').val(handle.text());
      }
    });
  } );
  </script>
<div id="slider_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>" class="slider">
  <div id="custom-handle_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>" class="ui-slider-handle custom-handle"></div>
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
?>


<input class='button-primary' type='submit' value='Calculate' /> <input type='reset' class='button-primary'  value='Reset' />
</form>