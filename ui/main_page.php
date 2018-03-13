          <!-- col right -->
          <form method="post" enctype="multipart/form-data" action="index.php" name="form">
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="glyphicon glyphicon-option-vertical"></i><h3 class="box-title">Choose Level of Knowledge</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <label>Option</label>
                    <select name="level" class="form-control">
                      <option selected="selected">Choose Level</option>
                      <option value="beginner">Beginner</option>
                      <option value="intermediate">Intermediate / Expert</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="glyphicon glyphicon-option-vertical"></i><h3 class="box-title">Choose Cloud Products</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <label>Option</label>
                    <select name="cloud" class="form-control">
                      <option>Choose Cloud</option>
                      <option>IaaS</option>
                      <option>PaaS</option>
                      <option>SaaS</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box -->
   
              <div class="pull-right">
                <button type="submit" class="btn btn-block btn-success btn-lg" name="next">Next &nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i></button> 
              </div>
            </div>
          </form>
         