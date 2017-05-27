<?php 
$baseurl = 'http://localhost:81/ahp/';
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
$lv1 = array(
  'Cost',
  'Security',
  'Reliability',
  'Availability',
  'Usability'
);

$sub_criteria = array(
  array(
      'C1'
  ),
  array(
      'S1','S2','S3','S4'
  ),
  array(
      'R1','R2',
  ),
  array(
      'A1',
  ),
  array(
      'U1','U2','U3',
  ),
);



?>
<form method="POST" action="hitung_multi.php">
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