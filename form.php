
<?php 
$sum=$_POST['sum'];
$data = explode(",", $_POST['criteria']);

$input_array = array (

  );

echo "<h4>Pairwise comparison</h4>";
echo "<table>";
for ($i = 1 ; $i <= $sum; $i++)
{
  
  for ($j = 1 ; $j<=$sum ; $j++)
  {
    if ($i<$j) {
      # code...

      echo "
          <tr>
            <th colspan='4'>$data[$i]</th>
            <th></th>
            <th colspan='4' style='text-align:right'>$data[$j]</th>
          </tr>
          <tr>
            <td><input type='radio' name ='t-$i-$j' value='9' /></td>
            <td><input type='radio' name ='t-$i-$j' value='7' /></td>
            <td><input type='radio' name ='t-$i-$j' value='5' /></td>
            <td><input type='radio' name ='t-$i-$j' value='3' /></td>
            <td><input type='radio' name ='t-$i-$j' value='1' checked/></td>
            <td><input type='radio' name ='t-$i-$j' value='0.33333' /></td>
            <td><input type='radio' name ='t-$i-$j' value='0.2' /></td>
            <td><input type='radio' name ='t-$i-$j' value='0.14285' /></td>
            <td><input type='radio' name ='t-$i-$j' value='0.111111' /></td>
          </tr>
          <tr>
            <td>9</td>
            <td>7</td>
            <td>5</td>
            <td>3</td>
            <td>1</td>
            <td>3</td>
            <td>5</td>
            <td>7</td>
            <td>9</td>
          </tr>
        ";


    }
  }
  echo "

  <div style='margin-top: 10%' >
    <input class='' type='hidden' id='result_data' name='result_data' value='$sum' />
    <input class='' type='hidden' id='criteria-$i' name='criteria-$i' value='".$data[$i]."' />
  </div>

  ";

}
  echo "</table>";
  echo "
  <input class='button-primary' type='submit' value='calculate' /> <input type='reset' class='button-primary'  value='reset' />";

 ?>
<script>

</script>
