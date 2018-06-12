<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Title | Project</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="plugins/jQuery/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="css/jquery-ui.css">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
   <nav class="navbar navbar-static-top">
      <div class="container">
        <h1 class="navbar-brand"><b>Main</b> Header</h1>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Main Page
          <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Main Page</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
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
        $lv1 = $_POST['level1'];

        array_unshift($lv1, '');

        $sum=count($lv1)-1;
        $data = $lv1;
        $input_array = array (
            'level1' => $lv1
          );

        ?>

            <div class="wrapper">
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Selection
          <!-- <small>Example 2.0</small> -->
        </h1>
       <!--
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol>-->
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Criteria Selection</h3>
          </div>
          <div class="box-body">
           

<form method="POST" action="multilevel_adaptive.php?<?php echo http_build_query($input_array);?>">

<?php

echo "<table width='40%'>";
for ($i = 1 ; $i <= $sum; $i++)
{
  
  for ($j = 1 ; $j<=$sum ; $j++)
  {
    if ($i<$j) {
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
$(function() {
    var handle = $( "#custom-handle_<?php echo 't-'.$i.'-'.$j;?>" );
    $( "#slider_<?php echo 't-'.$i.'-'.$j;?>" ).slider({
      value : 5,
      min : 1,
      max : 9,
      create: function() {
        handle.text( vals[$( this ).slider( "value" )-1] );
      },
      slide: function( event, ui ) {
        var vslider = vals[ui.value-1]; 
        var v = Math.abs(eval(vslider));
        handle.text( v );
        $('#txt_<?php echo 't-'.$i.'-'.$j;?>').val(vslider);
      }
    });
  } );
</script>
<div id="slider_<?php echo 't-'.$i.'-'.$j;?>" class="slider">
<div id="custom-handle_<?php echo 't-'.$i.'-'.$j;?>" class="ui-slider-handle" style="width: 2em;height: 2.0em;top: 0%;margin-top: -11px;padding : 3px;text-align: center;line-height: 1.6em;left:45%;
"></div>
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

}
  echo "</table>";
  

 ?>
 <br>
<input type="submit" class="btn btn-primary" value="Calculate" name="submit2" id="submit2" />
</form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->

<!-- 
<a href="admin.php">Config</a> -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        </div>
      </section>
    
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <strong>Copyright &copy; 2018. All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->


<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>

</body>
</html>

