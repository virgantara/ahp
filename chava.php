
<?php 

include "head.php";

include_once "config.php"
?>



<div class="wrapper">

  <?php 
  
  
  
  include_once "header_menu.php";



$params = array(
  'aws:ec2' => 'Amazon Web Service EC2',
  'google:compute' => 'Google Compute Engine',
  'azure:compute' => 'Microsoft Azure Cloud Storage',

);


  ?>

  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          AHP Provider
          <!-- <small>Example 2.0</small> -->
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <!-- <li><a href="#">Main</a></li> -->
          <li class="active">Setting</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Cloud Harmony</h3>
          </div>
          <div class="box-body">


<div class="col-xs-3">           
<select class="form-control" id="params_attr">
  <?php 
    foreach($params as $q=>$v)
    {
      echo '<option value="'.$q.'">'.$v.'</option>';
    }
  ?>
</select>

</div><div class="col-xs-9"><img style="display: none;" id="loading" src="assets/images/loading.gif"></div><br><br>
<div class="box-body">

  <table id="table_content" class="table table-bordered">
    <thead>
      
    </thead>
    <tbody>
      
    </tbody>
  </table>
</div>



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
  <?php 
  include_once "footer.php";
  ?>
</div>


<!-- 
<a href="admin.php">Config</a> -->
<?php 
include "script.php";
?>



<script type="text/javascript">
  function fetchData(param){
    $.ajax({
      type : 'post',
      url : 'ajax.php',
      data : 'q='+param+'&status=3',
      beforeSend : function(){
        $('#loading').show();
      },
      success : function(data){
        var parsed = $.parseJSON(data);

        
        $('#loading').hide();

        $('#table_content thead').empty();

        var row = '<tr>';
        $.each(parsed.headers, function(key, value){
            row += '<th>'+value+'</th>';
        });

        row += '</tr>';
        $('#table_content thead').append(row);   
        
        $('#table_content tbody').empty();

        var row = '';
        $.each(parsed.content, function(key, value){
            row += '<tr>';
            var i = 0;
            $.each(value, function(q, v){
                if(i != 0)
                  row += '<td>'+v+'</td>';
                i++;
            });
            
            row += '</tr>';
            // console.log(value);
        });

        
        $('#table_content tbody').append(row);        
      }
    });
  }
  $(document).ready(function(){
    var param = $('#params_attr').val();
    
      fetchData(param);

      $('#params_attr').change(function(){
        fetchData($(this).val());
      });
  });
</script>