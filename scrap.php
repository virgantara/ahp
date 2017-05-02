

<?php 
require_once 'config.php';
exit;
?>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
</head>
<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript">

function callback(data){
        var regions = JSON.stringify(data.config.regions);
        $.ajax({
            type: 'POST',
            url: '<?php echo $baseurl;?>/handle_json.php',
            data: regions, // or JSON.stringify ({name: 'jonas'}),
            success: function(data) { alert('data: ' + data); },
            contentType: "application/json",
            dataType: 'json',
            success : function(data){
                console.log(data);
            }
        });    
    // 
    // var itemReg =  $.map(data.config.regions, function(value){
    //     return value;
    // });

    // console.log(itemReg);
    // var itemReg = '';
    // $.each(data.config.regions, function (index, value) {
    //     // console.log(value);

    //     itemReg += '<pre>'+value.region+'</pre>';
    //     $.each(value.types, function (i2, v2) {
    //        $.each(value.types, function (i3, v3) {
    //             console.log(v3);
    //             // itemReg += '<pre>'+v2.region+'</pre>';
    //         });
    //         // itemReg += '<pre>'+v2.region+'</pre>';
    //     });
    // });

    // $('#regions').html(itemReg);
   // $('#regions').html(JSON.stringify(itemReg));
}

$(document).ready(function(){
    $.ajax({
      url: 'http://a0.awsstatic.com/pricing/1/ec2/pricing-data-transfer-with-regions.min.js',
      dataType: 'jsonp',
      jsonpCallback: 'callback', // specify the callback name if you're hard-coding it
      success: function(data){
        // callback(data);
        // $.each(data.response.venue.tips.groups, function (index, value) {
        //     $.each(this.items, function () {
        //         console.log(this.text);
        //     });
        // });
      }
    });

});
</script>

<div id="regions"></div>
