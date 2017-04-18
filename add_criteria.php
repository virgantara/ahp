<?php
  $criteria = array(
    '',
    'Cost',
    'Security',
    'Reliability',
    'Availability',
    'Usability',
    ); 

  $sum=$_POST['sum'];

     for ($i=1; $i <=$sum  ; $i++) { 
     	echo "

     	<label for='num_criteria'>Criteria number $i</label>
		<input class='u-full-width' type='text' id='criteria-$i' value='$criteria[$i]'/>


     	";
     }

  echo "
        <input type='hidden' id='sum_criteria' value='$sum'/>
        <input type='submit' class='button-primary' value='submit' id='result_submit'/>
        
         ";
?>
