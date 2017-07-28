<?php 

$baseurl = 'http://localhost/ahp/';
$scoring_main = array(
        array(
          "provider"=> "M",
          "value"=> array(
            1=> 14,
            2=> 38,
            3=> 90,
            4=> 73,
            5=> 47
          )
        )
      ,
         array(
        "provider"=> "K",
        "value"=> array(
          1=> 45,
          2=> 24,
          3=> 55,
          4=> 12,
          5=> 37
        )
        )
      ,
       array(
        "provider"=> "I",
        "value"=> array(
          1=> 55,
          2=> 47,
          3=> 68,
          4=> 74,
          5=> 25
        ))
      ,
       array(
        "provider"=> "A",
        "value"=> array(
          1=> 31,
          2=> 71,
          3=> 36,
          4=> 21,
          5=> 80
        ))
      ,
       array(
        "provider"=> "B",
        "value"=> array(
          1=> 95,
          2=> 48,
          3=> 10,
          4=> 19,
          5=> 33
        ))
      ,
       array(
        "provider"=> "T",
        "value"=> array(
          1=> 62,
          2=> 65,
          3=> 49,
          4=> 24,
          5=> 47
        )
      )
);
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

$aggregate_scoring = array(
        array(
          "provider"=> "M",
          "value"=> array(100,147,196,99,51)
        )
      ,
         array(
        "provider"=> "K",
        "value"=> array(85,147,189,97,59)
        )
      ,
       array(
        "provider"=> "I",
        "value"=> array(97,142,193,99,55)
        )
      ,
       array(
        "provider"=> "A",
        "value"=> array(93 , 157, 188, 98,  53)
        )
      ,
       array(
        "provider"=> "B",
        "value"=> array(100 ,140, 191, 97 , 55)
        )
      ,
       array(
        "provider"=> "T",
        "value"=> array(90 , 147, 189, 99 , 57)
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

$all_joinsub_criteria =  array(
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

$sub_criteria_name = array(
  'Cost' => array('C1'),
  'Security' => array('S1','S2','S3','S4'),
  'Reliability' => array('R1','R2',),
  'Availability' => array('A1',),
  'Utility' => array('U1','U2','U3',),
);

$lv1 = array(
  'Cost',
  'Security',
  'Reliability',
  'Availability', 
  'Usability'
);

?>