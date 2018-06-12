<?php
  //membuat data combobox pertama dari array dibawah ini_get
  $level1 = array(
    'security',
    'usability',
    'assurance',
    'performance',
    'companyPerformance',
    'pricing',
    'compliance'
  );
?>
<!-- col right -->
<form method="post" action="process.php" id="form-lvl1">
  <div class="col-md-8">
    <div class="box box-danger">
      <div class="box-header with-border">
        <i class="glyphicon glyphicon-option-vertical"></i><h3 class="box-title">Select 1 | Level Parameters</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php
        if ($_POST['level']=='beginner') {
        ?>
          <h4>Level of Knowledge : <b>Beginner</b></h4>
          <br>
        <?php
        }
        else {
        ?>
          <h4>Level of Knowledge : <b>Intermediate / Expert</b></h4>
          <br>
        <?php
        }
        ?>
        <div class="form-group">
          <label>Level 1</label>
        </div>
        
        <div class="form-group" id="attr1">
          <?php
          foreach($level1 as $isi){ echo '<input type="checkbox" class="level1" name="level1[]" value="'.$isi.'"><span>&nbsp&nbsp</span>'.$isi.'</br>'; }
          ?>
          </select>
        </div>
      </div>
    </div>
    <!-- /.box -->
    <?php
    if ($_POST['level']=='beginner') {
    ?>
      <div class="pull-right">
        <button id="submitLvl1" type="button" class="btn btn-block btn-success btn-lg">Process &nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i></button> 
      </div>
    <?php
    }
    elseif ($_POST['level']=='intermediate') {
    ?>
      <div class="pull-right">
        <input type="hidden" name="level" value="intermediate-lvl2">
        <button type="submit" class="btn btn-block btn-success btn-lg" name="next">Next &nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i></button> 
      </div>
    <?php
    }
    ?>
    
  </div>
</form>
<script type="text/javascript">
  $(document).ready(function(){

    $("#submitLvl1").click(function(){
        if($('.level1:checked').length > 1){
          document.forms["form-lvl1"].submit();
        }
        else{
          alert('Minimum selected criteria must be 2');
        }
    });
  });
</script>
         