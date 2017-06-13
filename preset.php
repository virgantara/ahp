<?php 
require_once "config.php";
?>
<script src="<?php echo $baseurl;?>/assets/js/jquery.min.js"></script>

<script>
	
$(document).ready(function(){
  $('#add_total').click(function(){
    var total = $('#total_crit').val();

    $('#main_list').empty();
    
    for(var i=0;i<total;i++){
      var row = '<input type="text" name="main_criteria[]" class="main_criteria" />';
      row += '<br><br>';
      row += '&nbsp;&nbsp;&nbsp;total of sub criteria : <input type="text" class="total_sub" value="0" id="subtotal_crit_'+(i+1)+'"/>';
      row += '<input type="button" class="add_subtotal" value="Add"/>';
      row += '<div id="sub_list_'+(i)+'">'; 
      row += '</div>';
      $('#main_list').append('Criteria '+(i+1)+' '+row);
      row = '';
     
     

    }

    $('.add_subtotal').on('click',function(){
      var prev = $(this).prev();
      var subtotal = prev.val();

      var sublist = $(this).next();
      sublist.empty();

      var sublist_id = sublist.attr('id');
      for(var j=0;j<subtotal;j++){
        var subrow = '<input type="text" name="sub_crit_'+sublist_id+'[]" class="sub_criteria" />';
        subrow += '<br><br>';
        sublist.append('SubCriteria '+(j+1)+' '+subrow);
        subrow = '';

      }
    });

    
  });

  
});
</script>

<?php 
$lv1 = array('','Cost','Security','Reliability','Availability','Usability');


?>

total of criteria : <input type="text" name="total_crit" value="0" id="total_crit"/>
<input type="button" id="add_total" value="Add"/>

<form method="POST" action="main.php">
<div id="main_list">

</div>

  <input class='button-primary' type='submit' value='Submit' />
</form>