<?php 
require_once "config.php";
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
$lv1 = array('','Cost','Security','Reliability','Availability','Usability');


$sum=count($lv1)-1;
$data = $lv1;

$input_array = array (

  );
?>
<form method="POST" action="multilevel.php">
<?php
echo "<table width='40%'>";
for ($i = 1 ; $i <= $sum; $i++)
{
  
  for ($j = 1 ; $j<=$sum ; $j++)
  {
    if ($i<$j) {
      # code...

      echo "
          <tr>
            <th colspan='4'>$data[$i]</th>
            
            <th colspan='4' style='text-align:right'>$data[$j]</th>
          </tr>
          <tr>
            <td colspan='8'>
        ";
        ?>
        <script>
$( function() {




    var handle = $( "#custom-handle_<?php echo 't-'.$i.'-'.$j;?>" );
    $( "#slider_<?php echo 't-'.$i.'-'.$j;?>" ).slider({
      value : 5,
      min : 1,
      max : 9,
      create: function() {
        handle.text( vals[$( this ).slider( "value" )-1] );
      },
      slide: function( event, ui ) {
      	
        handle.text( vals[ui.value-1] );
        $('#txt_<?php echo 't-'.$i.'-'.$j;?>').val(handle.text());
      }
    });
  } );
  </script>
<div id="slider_<?php echo 't-'.$i.'-'.$j;?>" class="slider">
  <div id="custom-handle_<?php echo 't-'.$i.'-'.$j;?>" class="ui-slider-handle custom-handle"></div>
</div>
 
        <?php
        echo "</td>
          </tr>
          <tr><td colspan='8'>
        ";
        ?>
<input type='hidden' id="txt_<?php echo 't-'.$i.'-'.$j;?>" name ='<?php echo 't-'.$i.'-'.$j;?>' value="1"/>

        <?php
        echo '</td></tr>';

    }
  }
  // echo "

  // <div style='margin-top: 10%' >
  //   <input class='' type='hidden' id='result_data' name='result_data' value='$sum' />
  //   <input class='' type='hidden' id='criteria-$i' name='criteria-$i' value='".$data[$i]."' />
  // </div>

  // ";

}
  echo "</table>";
  

 ?>

  <input class='button-primary' type='submit' value='Calculate' /> <input type='reset' class='button-primary'  value='Reset' />
  </form>