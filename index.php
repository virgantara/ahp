<?php 
$baseurl = 'http://localhost/ahp/';
?>


<?php 
$lv1 = array('','Cost','Security','Reliability','Availability','Usability');



?>

<script src="<?php echo $baseurl;?>/assets/js/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $("#submit2").click(function(){
        if($('.kriteria:checked').length > 1){
          document.forms["form-calc"].submit();
        }

        else{
          alert('Minimum selected criteria must be 2');
        }
    });
  });
</script>
<form method="POST" action="process.php" id="form-calc">

Select criterias : <br>

<?php
foreach($lv1 as $q => $v){
  if($q >   0)
  echo '<label for="'.$q.'"><input id="'.$q.'" type="checkbox" class="kriteria" name="kriteria[]" value="'.$v.'">'.$v.'</label><br>';
}
?>
<input type="button" value="Calculate" name="submit2" id="submit2" />
</form>