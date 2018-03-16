          <?php
          $attrLevel1 = [];
          if (!empty($_POST['level1'])) {
            foreach($_POST['level1'] as $attr) {
              // Store selected Level 1 attribute in array
              array_push($attrLevel1, $attr);
            }
          }
          ?>
          <!-- col right -->
          <form method="post" enctype="multipart/form-data" action="index.php" name="form">
            <div class="col-md-8">
              <!-- LEVEL 2 -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <i class="glyphicon glyphicon-option-vertical"></i><h3 class="box-title">Select 2 | Level Parameters</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <label>Level 2</label>
                  </div>
                  <?php
                  if (in_array('As', $attrLevel1)) {
                  ?>
                  <div class="form-group">
                    <label>Assurance</label></br> 
                    <input type="checkbox" name="As[]" value="AV"><span>&nbsp</span>Availability</br>
                    <input type="checkbox" name="As[]" value="DT"><span>&nbsp</span>Downtime</br>
                    <input type="checkbox" name="As[]" value="RC"><span>&nbsp</span>Recoverability</br>
                  </div>
                  <?php
                  }
                  if (in_array('Cp', $attrLevel1)) {
                  ?>
                  <div class="form-group">
                    <label>Company Performace</label></br>
                    <input type="checkbox" name="Cp[]" value="MT"><span>&nbsp</span>Migration Time</br>
                    <input type="checkbox" name="Cp[]" value="TR"><span>&nbsp</span>Training</br>
                    <input type="checkbox" name="Cp[]" value="CS"><span>&nbsp</span>Customer Support</br>
                  </div>
                  <?php
                  }
                  if (in_array('Cm', $attrLevel1)) {
                  ?>
                  <div class="form-group">
                    <label>Compliance</label></br>
                    <input type="checkbox" name="Cm[]" value="SC"><span>&nbsp</span>Security Compliance</br>
                    <input type="checkbox" name="Cm[]" value="LC"><span>&nbsp</span>Legal Compliance</br>
                    <input type="checkbox" name="Cm[]" value="SM"><span>&nbsp</span>Standard Compliance</br>
                  </div>
                  <?php
                  }
                  if (in_array('Pe', $attrLevel1)) {
                  ?>
                  <div class="form-group">
                    <label>Performance</label></br>
                    <input type="checkbox" name="Pe[]" value="HW"><span>&nbsp</span>Hardware</br>
                    <input type="checkbox" name="Pe[]" value="FC"><span>&nbsp</span>Functionality</br>
                    <input type="checkbox" name="Pe[]" value="EL"><span>&nbsp</span>Elasticity</br>
                    <input type="checkbox" name="Pe[]" value="FX"><span>&nbsp</span>Flexibility</br>
                    <input type="checkbox" name="Pe[]" value="SL"><span>&nbsp</span>Scalability</br>
                  </div>
                  <?php
                  }
                  if (in_array('Pr', $attrLevel1)) {
                  ?>
                  <div class="form-group">
                    <label>Pricing</label></br>
                    <input type="checkbox" name="Pr[]" value="PR"><span>&nbsp</span>Price</br>
                    <input type="checkbox" name="Pr[]" value="CM"><span>&nbsp</span>Charge Model</br>
                    <input type="checkbox" name="Pr[]" value="PU"><span>&nbsp</span>Pricing Unit</br>
                    <input type="checkbox" name="Pr[]" value="CR"><span>&nbsp</span>Currency</br>
                    <input type="checkbox" name="Pr[]" value="SF"><span>&nbsp</span>Support fee</br>
                    <input type="checkbox" name="Pr[]" value="DC"><span>&nbsp</span>Discounting</br>
                    <input type="checkbox" name="Pr[]" value="PS"><span>&nbsp</span>Pricing System</br>
                  </div>
                  <?php
                  }
                  if (in_array('Se', $attrLevel1)) {
                  ?>
                  <div class="form-group">
                    <label>Security</label></br>
                    <input type="checkbox" name="Se[]" value="AC"><span>&nbsp</span>Access Control</br>
                    <input type="checkbox" name="Se[]" value="DS"><span>&nbsp</span>Data Security</br>
                    <input type="checkbox" name="Se[]" value="GO"><span>&nbsp</span>Geography</br>
                    <input type="checkbox" name="Se[]" value="AU">Auditability</br>
                  </div>
                  <?php
                  }
                  if (in_array('Us', $attrLevel1)) {
                  ?>
                  <div class="form-group">
                  <label>Usability</label></br>
                    <input type="checkbox" name="Us[]" value="UI"><span>&nbsp</span>Interface</br>
                    <input type="checkbox" name="Us[]" value="OP"><span>&nbsp</span>Operability</br>
                    <input type="checkbox" name="Us[]" value="LR"><span>&nbsp</span>Learnability</br>
                  </div>
                  <?php
                  }
                  ?>
                  
                </div>
              </div>
              <!-- /.box -->
   
              <div class="pull-right">
                <input type="hidden" name="level" value="intermediate-lvl3">
                <button type="submit" class="btn btn-block btn-success btn-lg" name="next">Next &nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i></button> 
              </div>
            </div>
          </form>
         