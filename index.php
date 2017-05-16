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
		}
	}

	

  
  </script>

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

$lv1 = array('','Cost','Security','Reliability','Availability','Usability');


$sum=count($lv1)-1;
$data = $lv1;

$input_array = array (

  );

echo "<h4>Pairwise comparison</h4>";
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
<input type='text' id="txt_<?php echo 't-'.$i.'-'.$j;?>" name ='<?php echo 't-'.$i.'-'.$j;?>' value="1"/>

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

  <input class='button-primary' type='submit' value='calculate' /> <input type='reset' class='button-primary'  value='reset' />