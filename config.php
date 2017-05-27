<?php 

$baseurl = 'http://ahp.keltech.co.id';

$scoring = array(
        array(
          "provider"=> "M",
          "value"=> array(100,43,49,10,45,96,100,99,5,46,46)
        )
      ,
         array(
        "provider"=> "K",
        "value"=> array(85,47,49,5,46,90,99,97,10,49,49)
        )
      ,
       array(
        "provider"=> "I",
        "value"=> array(97,44,42,10,46,95,98,99,10,45,47)
        )
      ,
       array(
        "provider"=> "A",
        "value"=> array(93 , 50 , 48 , 10,  49,  93 , 95,  98  ,5,48 ,48)
        )
      ,
       array(
        "provider"=> "B",
        "value"=> array(100,46 ,43,  10,  41,  100, 91,  97,  5,50 ,45))
      ,
       array(
        "provider"=> "T",
        "value"=> array(90,  50 , 47,  5, 45 , 92,  97 , 99  ,10,  47  ,50)
      )
);

$importance = array(
    9=>'Absolutely more important',
    7=>'Very much more important',
    5=>'Much more important',
    3=>'Somewhat more important',
    1=>'Equal importance',

  );

$criteria = array(
    0 => "*",
    1=>"Cost",
    2=>      "Security",
    3=>      "Reliability",
    4=>      "Availability",
    5=>      "Usability",
  
  );

$joinsub_criteria =  array(
      'C1',
      'S1','S2','S3','S4',
      'R1','R2',
      'A1',
      'U1','U2','U3',
);



$sub_criteria = array(
  array('C1'),
  array('S1','S2','S3','S4'),
  array('R1','R2',),
  array('A1',),
  array('U1','U2','U3',),
);


$lv1 = array(
  'Cost',
  'Security',
  'Reliability',
  'Availability', 
  'Usability'
);
$weighted_sum = array(0.028108634,0.427903432,0.100082825,0.333738251,0.110166859);

?>