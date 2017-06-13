<title>AHP | Subcriteria</title>
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
// echo "Consistency Ratio: "  .$consistency_ratio;


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

<form method="POST" action="hitung_multi.php">
<h2>Pairwise Comparison Subcriteria</h2>
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

  $sum=count($sub_criteria[$i]);
  $data = $sub_criteria[$i];
  

  if($sum > 1)
  echo '<h3>'.$maincrit.'</h3>';
  echo "<table width='40%'>";
  
  


  for ($j = 0 ; $j < $sum; $j++)
  {

    for ($k = 0 ; $k<$sum ; $k++)
    {

      if($sum == 1){
        // echo "<tr><th colspan='8'>";
       ?>
       <input type='hidden' id="txt_<?php echo 't-'.$i.'-'.$j.'-'.$k;?>" name ='<?php echo 't-'.$i.'-'.$j.'-'.$k;?>' value="1"/>

       <?php
        // echo $data[0];
        // echo "</th>
        // </tr>
        // <tr>";
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