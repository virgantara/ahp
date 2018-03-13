<?php
  //membuat data combobox pertama dari array dibawah ini_get
  $level1 = array(
    'As' => 'Assurance',
    'Cp' => 'Company Performance',
    'Cm' => 'Compliance',
    'Pe' => 'Performance',
    'Pr' => 'Pricing',
    'Se' => 'Security',
    'Us' => 'Usability');
?>
          <!-- col right -->
          <form method="post" enctype="multipart/form-data" action="index.php" name="form">
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
                    <select id="level1" name="level" class="form-control select2"> <!-- membuat combobox pertama, dengan id makes -->
                      <option selected="selected">-- Choose Attribute --</option>
                      <?php
                      //menampilkan data dari array yang sudah di buat diatas
                      foreach($level1 as $m =>$isi){ echo '<option value="'.$m.'">'.$isi.'</option>'; }
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
                  <button type="button" class="btn btn-block btn-success btn-lg">Process &nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i></button> 
                </div>
              <?php
              }
              elseif ($_POST['level']=='intermediate') {
              ?>
                <div class="pull-right">
                  <button type="submit" class="btn btn-block btn-success btn-lg" name="next">Next &nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i></button> 
                </div>
              <?php
              }
              ?>
              
            </div>
          </form>
         