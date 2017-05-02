

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Form AHP</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="stylesheet" href="assets/css/skeleton.css">
 
  <!-- JS 
  -->

 <script src="assets/js/jquery.min.js"></script>
               
  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="assets/images/favicon.png">

  <style>

  </style>


</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">
      <div class="one-half column" style="margin-top: 10%">
        <h4>Analytical Hierarchy Process Form</h4>
        <p>Insert number of criteria</p>
        	<form id="ahp" action="" method="post">
	        	<label for="num_criteria">Number of criteria</label>
	      		<input class="u-full-width" type="number" id="num_criteria" value="5">
	      		<input class="button-primary" type="submit" value="Submit" id="num_criteria_submit">
        	</form>      
      </div>
    </div>

    <div class="row">
    	<div class="one-half column">
    		<form id="result" action="" method="post">
    		</form>
    	</div>
    </div>

    <div class="row">
    	<div class="one-half column">
		    <form id="input_ahp" action="" method="post">
			   <table>
			   <div id="table"> </div>   
			   </table>
			</form>
    	</div>
    </div>

    <div id="table2">
	</div>



  </div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
<script type="text/javascript">
	$(document).ready(function(){

		 // ajax call add_criteia.php to show form and ask for the number of criteria 
		 $("#ahp").submit(function() {		   
			 var sum = $("#num_criteria").val();
			 $('#loading1').show();
			  $.ajax({
			     type: "POST",
			     url : "add_criteria.php",    
				 data: "sum="+sum+"",
			     success: function(data){ 
			    $('#loading1').hide();
			    $('#result').show();
			     document.getElementById("result").innerHTML = data;
			 
		       }	 
		     });
		     return false;
	    });

		$("#num_criteria_submit").click();


		// ajax call form.php
		  $("#result").click(function() {		    
			 var sum = $("#sum_criteria").val();
			 var i=1;
			 var criteria = new Array();
			 for (i ; i <= sum; i++) {
			 	criteria[i]=$('#criteria-'+i+'').val();
			 }
			  $('#loading2').show();
			  $.ajax({
			     type: "POST",
			     url : "form.php",    
				 data: "sum="+sum+"&criteria="+criteria,
				     success: function(data){ 
				     $('#loading2').hide();
				     $('#table').show();
				     document.getElementById("table").innerHTML = data;
				 }	 
		     });
		     return false;
	    });


		//
		   $("#input_ahp").submit(function() {
		   	  $('#loading3').show();
			  $.ajax({
			     type: "POST",
			     url : "calculate.php",    
			     data: $("#input_ahp").serialize(),
				     success: function(data){ 
				    
				     $('#loading3').hide();
				     $('#table2').show();
					 document.getElementById("table2").innerHTML = data;
					 $('#start').show();
					 $('#start').focus();
				 }	 
		     });
		     return false;
	    });


		//reset button    
		$("#start").click(function() {
		    	$('#result').hide();
		    	 $('#table').hide();
		    	 $('#table2').hide();
		    	 $('#start').hide();
		    	return false;
		
		});

	});
</script>

</body>
</html>


 