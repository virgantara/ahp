
<?php 
include_once "db_helper.php";


$baseurl = loadBaseUrl();
?>

<!-- jQuery 2.2.3 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $baseurl;?>/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<!-- Bootstrap WYSIHTML5 -->
<!-- Slimscroll -->
<script src="<?php echo $baseurl;?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $baseurl;?>/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $baseurl;?>/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->
<script src="<?php echo $baseurl;?>/dist/js/demo.js"></script>
</body>
</html>