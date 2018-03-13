          <!-- col right -->
          <form method="post" enctype="multipart/form-data" action="" name="form">
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
                    <?php
                    if ($_POST['level']=='As') {
                    ?>
                      <select id="level2" name="level2" class="form-control select2"> 
                        <option selected="selected">-- Choose Attribute --</option>
                        <option value="AV">Availability</option>
                        <option value="DT">Downtime</option>
                        <option value="R">Recoverability</option>
                      </select>
                    <?php
                    }
                    elseif ($_POST['level']=='Cp') {
                    ?>
                      <select id="level2" name="level2" class="form-control select2"> 
                        <option selected="selected">-- Choose Attribute --</option>
                        <option value="NF">Migration Time</option>
                        <option value="NF">Training</option>
                        <option value="NF">Customer Support</option>
                      </select>
                    <?php
                    }
                    elseif ($_POST['level']=='Cm') {
                    ?>
                      <select id="level2" name="level2" class="form-control select2"> 
                        <option selected="selected">-- Choose Attribute --</option>
                        <option value="SC">Security Compliance</option>
                        <option value="LC">Legal Compliance</option>
                        <option value="SM">Standard Compliance</option>
                      </select>
                    <?php
                    }
                    elseif ($_POST['level']=='Pe') {
                    ?>
                      <select id="level2" name="level2" class="form-control select2"> 
                        <option selected="selected">-- Choose Attribute --</option>
                        <option value="NF">Hardware</option>
                        <option value="F">Functionality</option>
                        <option value="E">Elasticity</option>
                        <option value="NF">Flexibility</option>
                        <option value="NF">Scalability</option>
                      </select>
                    <?php
                    }
                    elseif ($_POST['level']=='Pr') {
                    ?>
                      <select id="level2" name="level2" class="form-control select2"> 
                        <option selected="selected">-- Choose Attribute --</option>
                        <option value="NF">Price</option>
                        <option value="CM">Charge Model</option>
                        <option value="PU">Pricing Unit</option>
                        <option value="NF">Currency</option>
                        <option value="SF">Support fee</option>
                        <option value="NF">Discounting</option>
                        <option value="PS">Pricing System</option>
                      </select>
                    <?php
                    }
                    elseif ($_POST['level']=='Se') {
                    ?>
                      <select id="level2" name="level2" class="form-control select2"> 
                        <option selected="selected">-- Choose Attribute --</option>
                        <option value="AC">Access Control</option>
                        <option value="DS">Data Security</option>
                        <option value="G">Geography</option>
                        <option value="NF">Auditability</option>
                      </select>
                    <?php
                    }
                    elseif ($_POST['level']=='Us') {
                    ?>
                      <select id="level2" name="level2" class="form-control select2"> 
                        <option selected="selected">-- Choose Attribute --</option>
                        <option value="I">Interface</option>
                        <option value="NF">Operability</option>
                        <option value="NF">Learnability</option>
                      </select>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <!-- /.box -->
              <!-- LEVEL 3 -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <i class="glyphicon glyphicon-option-vertical"></i><h3 class="box-title">Select 3 | Level Parameters</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <label>Level 3</label>
                    <select id="models" name="models" class="form-control select2">
                      <option selected="selected">-- Choose Attribute --</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box -->
   
              <div class="pull-right">
                <button type="button" class="btn btn-block btn-success btn-lg">Process &nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i></button> 
              </div>
            </div>
          </form>
         