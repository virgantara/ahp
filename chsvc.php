
<?php 

include "head.php";

include_once "config.php"
?>



<div class="wrapper">

  <?php 
  
  
  
  include_once "header_menu.php";
include_once "db_helper.php";
$params = array();
foreach(getCloudProviders() as $v){
  $params[$v->code] = $v->name;
}

// $params = array(
//   'aws:ec2' => 'Amazon Web Service EC2',
//   'google:compute' => 'Google Compute Engine',
//   'azure:compute' => 'Microsoft Azure Cloud Storage',

// );

  ?>

  <style type="text/css">
  .timeline-item {
    background: #f0f0f0;
    border: 1px solid #ddd;
    -webkit-box-shadow: none;
    box-shadow: none;
  }

  .timeline {
    position: relative;
    margin: 0 0 30px 0;
    padding: 0;
    list-style: none;
}

  </style>


  <link rel="stylesheet" href="assets/css/custom.css">
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

  <section class="content-header">
      <h1 >
        Cloud Service
      </h1>
    
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
             
              <h3 class="profile-username text-center" id="user_profile"></h3>

              <!-- <p class="text-muted text-center">Software Engineer</p> -->

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Service ID</b> <a class="pull-right" id="serviceId"></a>
                </li>
                <li class="list-group-item">
                  <b>Provider Code</b> <a class="pull-right" id="providerCode"></a>
                </li>
               
              </ul>

              <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Outage Contacts</strong>

              <p class="text-muted" id="outageContacts">
                <!-- B.S. in Computer Science from the University of Tennessee at Knoxville -->
              </p>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Regions</a></li>
             
            </ul>
            <div class="tab-content">
               <div id="map"></div>
              <div class="active tab-pane" id="regions">
                <!-- Post -->
                
                <!-- /.post -->

             
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
            
              <!-- /.tab-pane -->

              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
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


<script src="https://maps.google.com/maps/api/js?sensor=true&v=3&key=AIzaSyD4iB21WyP0W-aZSk0ilBn_cU_2urjhg9U">
</script>
<script src="assets/js/gmaps.js"></script>

<script type="text/javascript">
  function fetchData(param,map){
    $.ajax({
      type : 'post',
      url : 'ajax.php',
      data : 'q='+param+'&status=2',
      beforeSend : function(){
        $('#loading').show();
       
      },
      success : function(data){

        var parsed = $.parseJSON(data);
        parsed = parsed[0];
        // console.log(parsed[0]);
        $('#loading').hide();
        $('#user_profile').empty();
        $('#serviceId').empty();
        $('#providerCode').empty();
        $('#outageContacts').empty();


        $('#user_profile').html(parsed.name);
        $('#serviceId').html(parsed.serviceId);
        $('#providerCode').html(parsed.providerId);
        $('#outageContacts').html(parsed.outageContacts);

        $('#regions').empty();
        var item = '<ul class="timeline timeline-inverse">';
         map.removeMarkers();
        $.each(parsed.regions, function(key, value){

          map.addMarker({
            lat: value.locationLat,
            lng: value.locationLong,
            title: value.city,
            click: function(e) {
              alert(value.city + ' - '+value.country);
            }
          });

          item += '<li><div class="timeline-item">';

          item += '  <h3 class="timeline-header"><a href="#">'+value.city+'</a> '+value.country+'</h3>';
          item += '  <div class="timeline-body">';
          item += 'Latitude : '+value.locationLat+ ' <br> Longitude : '+value.locationLong;
          item += '  </div>';
          // item += '  <div class="timeline-footer">';
          // item += ' <a class="btn btn-primary btn-xs">Read more</a>';
          // item += ' <a class="btn btn-danger btn-xs">Delete</a>';
          // item += ' </div>';
          item += '</div></li>';
        });
        item += '</ul>';
       $('#regions').append(item);
      }
    });
  }
  $(document).ready(function(){


   var map = new GMaps({
    div: '#map',
    lat: 0,
    lng: 0,
    zoom : 1,
    minZoom : 1,

  });

    var param = $('#params_attr').val();
    
      fetchData(param,map);

      $('#params_attr').change(function(){
        fetchData($(this).val(),map);
      });
  });
</script>