<?php 
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



// $criteria = array(
//     0 => "*",
//     1=>      "Cost",
//     2=>      "Security",
//     3=>      "Reliability",
//     4=>      "Availability",
//     5=>      "Usability",  
// );

// $criteria = array(
//   0 => "*",
//   1=> "security",
//   2=> "usability",
//   3=> "assurance",
//   4=> "performance",
//   5=> "companyPerformance",
//   6=> "pricing",
//   7=> "compliance"
  
// );

$all_joinsub_criteria =  array(
      'C1',
      'S1','S2','S3','S4',
      'R1','R2',
      'A1',
      'U1','U2'
);



// $sub_criteria = array(
//   array('C1'),
//   array('S1','S2','S3','S4'),
//   array('R1','R2',),
//   array('A1',),
//   array('U1','U2','U3',),
// );

$sub_criteria_name = array(
  'Cost' => array('C1'),
  'Security' => array('S1','S2','S3','S4'),
  'Reliability' => array('R1','R2',),
  'Availability' => array('A1',),
  'Usability' => array('U1','U2'),
);

$lv1 = array(
  'security',
  'usability',
  'assurance',
  'performance',
  'companyPerformance',
  'pricing',
  'compliance' 
);

$level2_criteriaName = array(
  'security' => array(
    'accessControl',
    'dataSecurity',
    'geography',
    'auditability'
  ),
  'usability' => array(
    'interface',
    'operability',
    'learnability'
  ),
  'assurance' => array(
    'availability',
    'downtime',
    'recoverability'
  ),
  'performance' => array(
    'hardware',
    'functionality',
    'flexibility',
    'scalability'
  ),
  'companyPerformance' => array(
    'training',
    'customerSupport'
  ),
  'pricing' => array(
    'price',
    'chargeModel',
    'pricingUnit',
    'currency',
    'supportFee',
    'discounting',
    'pricingSystem'
  ),
  'compliance' => array(
    'securityCompliance',
    'legalCompliance',
    'standardCompliance'
  )
);

?>