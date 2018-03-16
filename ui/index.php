<!DOCTYPE html>
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

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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
          <!-- col left -->
          <div class="col-md-4">
            <!-- About Me Box -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <i class="glyphicon glyphicon-th"></i><h3 class="box-title">About Me</h3>
              </div>
              <div class="box-body">
                <p>
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.
                </p>
                <br>
                <br>
                <br>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
          <!-- /.col -->

          <!-- col right -->
          <?php
          //include "db.php";
           // $aksi = "level_2_3.php";
            // mengatasi variabel yang belum di definisikan (notice undefined index)
            
          if (!isset($_POST['next'])) {

            include "main_page.php";
          }
          elseif (isset($_POST['next'])) {
            if ($_POST['level']=='beginner') {
              include "level_1.php";
            }
            elseif ($_POST['level']=='intermediate') {
              include "level_1.php";
            }
            elseif ($_POST['level']=='intermediate-lvl2') {
              //if (isset($_POST['level_1'])) {
                include "level_2.php";
              //}
            }
            elseif ($_POST['level']=='intermediate-lvl3') {
              include "level_3.php";
            }
            else {
              include "main_page.php";
            }
          }

          ?>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
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

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
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
<!-- <script>
  $('#level2').change(function(){ //jika combobox pertama nilainya berubah maka menjalankan script di bawah
    $('#models').css("display","block"); //menampilkan combobox kedua
    
    $('#models').change(function(){ //jika combobox kedua nilainya berubah
      $('#submit').css("display","block"); //menampilkan tombol submit
    });
    var make = $(this).val(); //menangkan nilai dari combobox pertama
    $.post('select-request.php', {make:make}, function(data){ // menjalankan ajax request dari file select-request.php dan mengirimkan variable make sebagai post variabel dengan nama make, dan mengembalikan info dengan variable data
      $('#models').html(data); //  menampilkan variabel data
    });
  });
</script> -->
</body>
</html>
