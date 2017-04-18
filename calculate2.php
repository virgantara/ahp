<?php 
//provider data JSON
$data = '
    [
      {
        "provider": "Mixers",
        "value": {
          "cost": 14,
          "security": 38,
          "reliability": 90,
          "usability": 73,
          "popularity": 47
        }
      },
      {
        "provider": "Koogle",
        "value": {
          "cost": 45,
          "security": 24,
          "reliability": 55,
          "usability": 12,
          "popularity": 37
        }
      },
      {
        "provider": "Incubus",
        "value": {
          "cost": 55,
          "security": 47,
          "reliability": 68,
          "usability": 74,
          "popularity": 25
        }
      },
      {
        "provider": "Assurity",
        "value": {
          "cost": 31,
          "security": 71,
          "reliability": 36,
          "usability": 21,
          "popularity": 80
        }
      },
      {
        "provider": "Billmed",
        "value": {
          "cost": 95,
          "security": 48,
          "reliability": 10,
          "usability": 19,
          "popularity": 33
        }
      },
      {
        "provider": "Techade",
        "value": {
          "cost": 62,
          "security": 65,
          "reliability": 49,
          "usability": 24,
          "popularity": 47
        }
      }
    ]
    ';

  $sum=$_POST['result_data'];
  $col=$sum+1;
  $row=$col+1;
  $x=1;
  $ar1=array();
  $ar2=array();
  
  echo "<b><h3>Decimal Matriks</h3></b>";
  echo "<table>";
   for ($i=0; $i<$row; $i++) { 
     echo "<tr>";
     for ($j=0; $j<$col; $j++) { 
        if($i==0){
           if(($i==0) && ($j==0)){
             echo "<td></td>";
           } 
           else {
              echo "<td>".$_POST['criteria-'.$j]."</td>";
           }
        }
        else {
          if($j==0){
            if($i==$col){
              if($j==0){
                 echo "<td>&Sigma;</td>";  
              }
              else{
                echo "<td>".$col1[1]."</td>";   
              }
              
            }
            else{
                echo "<td>".$_POST['criteria-'.$i]."</td>"; 
            }
          }
          else if($i==$j){
            echo "<td>1</td>";
              $ar2[$j]=1;
            
          }
          else if($j>$i){
            echo "<td>".$_POST['t-'.$i."-".$j]."</td>";
            $ar2[$j]=$_POST['t-'.$i."-".$j];
           }

          else {
              if($i==$col){
              if($j!=0){                 
                $total=0; 
                 for($y=1;$y<=$sum;$y++){
                    $total=$total+$ar1[$y][$j];
                 }
                 echo "<td>";
                 echo number_format($total,3)."</td>";
                 $sigma[$j]=$total;
              }
              
            }
            else {
               echo "<td>".number_format((1/$_POST['t-'.$j."-".$i]),3)."</td>";
               $ar2[$j]=(1/$_POST['t-'.$j."-".$i]);
             }        
          
          }
        }
     }
     
     $ar1[$i]=$ar2;
   
    
     echo "</tr><input type='hidden' id='result_data' name='result_data' value='$sum' />";
    }
    echo "</table>";

   //table 2
  $sum=$_POST['result_data'];
  $col=$sum+1;
  $row=$col+1;
  $x=1;
  $ar1=array();
  $ar2=array();
  echo "<br><b><h3>Normalize Matriks</h3></b>";
  echo "<table>";
   for ($i=0; $i<$col; $i++) { 
     echo "<tr>";
     for ($j=0; $j<$row; $j++) { 
        if($i==0){
           if(($i==0) && ($j==0)){
             echo "<td></td>";
           } 
           else {
              if($j==$col){
                echo "<td>Eigen Factor</td>";
              }
              else {
                echo "<td>".$_POST['criteria-'.$j]."</td>";
              }
              
           }
        }
        else {
          if($j==0){
            
                echo "<td>".$_POST['criteria-'.$i]."</td>"; 
           
          }
           else if($j>$i){
             if($j>=$col){
              $ar1[$i]=$ar2;
              $total=0; 
                 for($y=1;$y<=$sum;$y++){
                     
                        $total=$total+$ar1[$i][$y];
                    
                  }
                  $eigen=$total/$sum;
                    $max[$i]=$eigen;
                echo "<td>".number_format($eigen,3)."</td>";
             }
             else {
              echo "<td>".number_format(($_POST['t-'.$i."-".$j]/$sigma[$j]),3)."</td>";
              $ar2[$j]=($_POST['t-'.$i."-".$j]/$sigma[$j]);
              
             }
      
          }

          else if($i==$j){
            echo "<td>".number_format((1/$sigma[$j]),3)."</td>";
              $ar2[$j]=(1/$sigma[$j]);
            
          }
       
          else {
             
               echo "<td>".number_format(((1/$_POST['t-'.$j."-".$i])/$sigma[$j]),3)."</td>";
               $ar2[$j]=((1/$_POST['t-'.$j."-".$i])/$sigma[$j]);
        
          }
        }
     }
     
     $ar1[$i]=$ar2;
   
    
     echo "</tr>";
    }
    echo "</table><br/>";
    
    $maxs=0;
    for ($i=1; $i <=$sum ; $i++) { 
      $maxs=($maxs+(($sigma[$i])*($max[$i])));
      //echo $sigma[$i].",".$max[$i];
    }
    echo "&lambda; max = ".number_format($maxs,3)."<br>";
    echo "CI = ";
    $ci=number_format((($maxs-$sum)/($sum-1)),3);
    echo "$ci<br>";

    $ri_array = array (
      0,0,0.58,0.9,1.12,1.24,1.32,1.41,1.45,1.49
      );
    
    $ri = $ri_array[$sum-1];

    $cr=number_format(($ci/$ri),3);

    if($cr<0.1){
      echo "<div>CR = $ci/$ri = <b>$cr</b> , Acceptable<br><br></div>";
    }
    else if($cr>0.1){
      echo "<div'>CR = $ci/$ri = <b>$cr</b> , Unacceptable<br><br></div>";
    }


$array_d = json_decode($data, true);
$count_c = count($array_d);

$total = 0;
$arr = array();
$arrr = array();
$array_alt = array('cost','security','reliability','usability','popularity');

echo "<br><b><h3>Pairwise Matrik (Provider/Alternatif)</h3></b>";

for($q=0;$q<count($array_alt);$q++){
	echo "<table>";
	for($i=0;$i<$count_c+1;$i++){
		echo "<tr>";
		for($j=0;$j<$count_c+1;$j++){
			if ($j==0 && $i==0 ){
				echo "<td><b>$array_alt[$q]</b></td>";
			} else if ($j==0){
				echo "<td>".$array_d[$i-1]['provider']."</td>"; 
			} else if ($i==0){
				echo "<td>".$array_d[$j-1]['provider']."</td>";
			} else if ($i==$j){
				echo "<td>1</td>";
			} else {
				echo "<td>".$array_d[$i-1]['value'][$array_alt[$q]]/$array_d[$j-1]['value'][$array_alt[$q]]."</td>";
			}
		}
		echo "</tr>";
	}
	echo "</table><br/>";
}

function count_alt(array $array_c,$count_c,$alt)
{
	
	for ($y=0;$y<$count_c;$y++){
		$arr[$y] = $array_c[$y]['value'][$alt];
	}
	
	for ($i=0 ; $i<$count_c ;$i++){
		$arrr[$i] = $array_c[$i]['value'][$alt];		
	}
	$total = 0;
	for ($j=0 ; $j<$count_c ; $j++){
		$total += $arrr[$j];
	}
	
	for ($h=0; $h<$count_c;$h++){
		$array_norm[$h] = $arrr[$h]/$total;
	}
	
	return $array_norm;
}


for ($s=0;$s<count($array_alt);$s++){
	$hjk[$s][$array_alt[$s]] = count_alt($array_d,$count_c,$array_alt[$s]);
}

// show scorring table 
echo "<br><b><h3>Score</h3></b>";
echo "<table>";
echo "<tr>";
echo "<td>Provider</td>";
for ($w=0;$w<count($array_alt);$w++){
    echo "<td>".$array_alt[$w]."</td>";
}
echo "</tr>";

for ($v=0;$v<$count_c+1;$v++){
    if ($v==$count_c){
        echo "<tr>";
        echo "<td>Weight</td>";
            for($c=0;$c<count($array_alt);$c++){
                echo "<td>".$max[$c+1]."</td>";
            }
        echo "</tr>";
    } else {
        echo "<tr>";
        for ($t=0;$t<6;$t++){
            if ($t==0){
                echo "<td>".$array_d[$v]['provider']."</td>";
            } else if ($t>0) {
                echo "<td>".$hjk[$t-1][$array_alt[$t-1]][$v]."</td>";
                $rank_ar[$v][$t-1] = $hjk[$t-1][$array_alt[$t-1]][$v]*$max[$t];
            } else {
                echo "<td>yeeee</td>";
            }
        }
        echo "</tr>";
    }
}   
echo "</table>";
for ($h=0;$h<$count_c;$h++){
    $sum = 0;
    for ($q=0;$q<count($array_alt);$q++){
        $sum += $rank_ar[$h][$q];
    }
    $thisrr[$array_d[$h]['provider']] = $sum;
}

echo "<br><b><h3>Rank</h3></b>";
arsort($thisrr);
foreach ($thisrr as $key => $val) {
    echo "$key = ".floor($val*100)."%<br>";
}

?>
