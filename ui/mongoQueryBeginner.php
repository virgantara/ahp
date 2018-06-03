<?php
include 'mongoConnect.php';
include '../score_map.php';

$res = $collection->find();
$res2 = $collection->find();
$resTmp = $res2->toArray();

$allUp = [];
$allOut = [];
$allMttf = [];
$allMttr = [];
$allDisk = [];
$allNet = [];
$allMem = [];
$allCpu = [];
$allPrice = [];

// Hold all instance AHP Aggregate Data
$instanceData = array();
$i6 = array();
$i5 = array();
$i4 = array();
$i3 = array();
$i2 = array();
$i1 = array();

foreach($resTmp as $up) {
   $a = $up["assurance"]["availability"]["uptime"];
   $a = (float)$a;
   array_push($allUp, $a);
}
foreach($resTmp as $out) {
    $a = $out["assurance"]["availability"]["outages"];
    $a = (float)$a;
    array_push($allOut, $a);
}
foreach($resTmp as $mf) {
    $a = $mf["assurance"]["downtime"]["mttf"];
    $a = (float)$a;
    array_push($allMttf, $a);
}
foreach($resTmp as $mr) {
    $a = $mr["assurance"]["downtime"]["mttr"];
    $a = (float)$a;
    array_push($allMttr, $a);
}
foreach($resTmp as $d) {
    $a = $d["performance"]["hardware"]["disk"];
    if($a == "NA") {
        $a = 1;
    }
    $a = (float)$a;
    array_push($allDisk, $a);
}
foreach($resTmp as $n) {
    $a = $n["performance"]["functionality"]["networkPerformance"];
    if(is_array($a)) {
        $a = $a[0];
    }
    $a = (float)$a;
    array_push($allNet, $a);
}
foreach($resTmp as $m) {
    $a = $m["performance"]["functionality"]["memoryAmount"];
    $a = (float)$a;
    array_push($allMem, $a);
}
foreach($resTmp as $c) {
    $a = $c["performance"]["functionality"]["cpu"];
    $a = (float)$a;
    array_push($allCpu, $a);
}
foreach($resTmp as $p) {
    $w = $p["pricing"]["price"]["win"];
    $l = $p["pricing"]["price"]["linux"];
    $w = (float)$w;
    $l = (float)$l;
    $s = '';

    if(($w != 'NA') and ($l != 'NA')) {
        $s = ($w+$l) / 2;
        array_push($allPrice, $s);
    } elseif(($w != 'NA') and ($l == 'NA')) {
        array_push($allPrice, $w);
    } else {
        array_push($allPrice, $l);
    }
}


foreach($res as $r) {
    /* Security */
    // Access Control
    $authen = authen($r["security"]["accessControl"]["authentiation"]);
    $author = author($r["security"]["accessControl"]["authorization"]);
    $ac = $authen + $author;
    
    // Data Security
    $firewall = firewall($r["security"]["dataSecurity"]["Firewall"]);
    $dc = $encryption + $firewall;

    // Audit
    $audit = audit($r["security"]["auditability"]);
    $geo = $nationality + $location;

    $sec = $ac + $dc + $audit + $geo;

    /* Usability */
    // Interface
    $web = web($r["usability"]["interface"]["web"]);
    $mobile = mobile($r["usability"]["interface"]["mobile"]);
    $terminal = terminal($r["usability"]["interface"]["mobile"]);
    $interface = $web + $mobile + $terminal;

    $learn = learnability($r["usability"]["learnability"]);
    $opera = operability($r["usability"]["operability"]);

    $usa = $interface + $learn + $opera;

    /* Assurance */
    // Availability
    $inUp = $r["assurance"]["availability"]["uptime"];
    $up = uptime($inUp, $allUp);
    $inOut = $r["assurance"]["availability"]["outages"];
    $out = outages($inOut, $allOut);
    $avail = $up + $out;

    // Downtime
    $inMf = $r["assurance"]["downtime"]["mttf"];
    $mttf = mttf($inMf, $allMttf);
    $inMr = $r["assurance"]["downtime"]["mttr"];
    $mttr = mttr($inMr, $allMttr);
    $down = $mttf + $mttr;

    $rec = recoverability($r["assurance"]["recoverability"]["recoveryMechanism"]);

    $asc = $avail + $down + $rec;

    /* Performance */
    // Hardware
    $inDisk = $r["performance"]["hardware"]["disk"];
    if($inDisk == "NA") {
        $disk = 1;
    } else {
        $disk = disk($inDisk, $allDisk);
    }
    $gpu = gpu($r["performance"]["hardware"]["gpu"]);

    $hrd = $disk + $os + $cpuType + $gpu;

    // Functionality
    $inNet = '';
    if(is_array($r["performance"]["functionality"]["networkPerformance"])) {
        $inNet = $r["performance"]["functionality"]["networkPerformance"][0];
    } else {
        $inNet = $r["performance"]["functionality"]["networkPerformance"];
    }
    $netPerf = netPerf($inNet, $allNet);

    $inMem = $r["performance"]["functionality"]["memoryAmount"];
    $mem = memory($inMem, $allMem);

    $cpu = '';
    $inCpu = $r["performance"]["functionality"]["cpu"];
    if($inCpu == 'shared') {
        $cpu = 1;
    } else {
        $cpu = cpu($inCpu, $allCpu);
    }

    $func = $netPerf + $mem + $cpu;
    
    $flex = flexibility($r["performance"]["flexibility"]);
    $scal = scalability($r["performance"]["scalability"]);

    $perf = $hrd + $func + $flex + $scal;

    /* Company Performance */
    $train = training($r["companyPerformance"]["training"]);
    $cs = customerSupport($r["companyPerformance"]["customerSupport"]);

    $cpr = $train + $cs;

    /* Pricing */
    // Price
    $w = $r["pricing"]["price"]["win"];
    $l = $r["pricing"]["price"]["linux"];
    $price = '';
    if($w == 'NA') {
        $price = 1;
    } elseif($l == 'NA') {
        $price = 1;
    } else {
        $inPrice = ($w+$l) / 2;
        $price = price($inPrice, $allPrice);
    }
    // Charge Model
    $chargeModel = $payAsYouGo + $contract;

    // Pricing Unit
    $priceUnit = $perHour + $perMinute + $perGB;

    //Currency
    $curr = currency($r["pricing"]["currency"]);

    // Support Fee
    $free = freeSupport($r["pricing"]["supportFee"]["free"]);

    $supFee = $free + $additionalPackage;

    // Discounting
    $disc = discounting($r["pricing"]["discounting"]);

    // Pricing System
    $priceSys = $tieredPricing + $volumePricing;

    $prc = $price + $chargeModel + $priceUnit + $supFee + $disc + $priceSys;

    /* Compliance */
    // Security Compliance
    $usPat = usPatriotAct($r["compliances"]["securityComp"]["usPatriotAct"]);
    $fisma = fisma($r["compliances"]["securityComp"]["fisma"]);
    $safeHarbor = safeHarbor($r["compliances"]["securityComp"]["safeHarbor"]);
    $sas70 = sas70($r["compliances"]["securityComp"]["sas70"]);

    $secComp = $usPat + $fisma + $safeHarbor + $sas70;

    // Legal Compliance
    $hipaa = hipaa($r["compliances"]["legalComp"]["hipaa"]);
    $sox = sox($r["compliances"]["legalComp"]["sox"]);

    $legComp = $hipaa + $sox;

    // Standard Comp
    $ssae16 = ssae16($r["compliances"]["standardComp"]["ssae16"]);
    $iso27001 = iso27001($r["compliances"]["standardComp"]["iso27001"]);
    $iso9001 = iso9001($r["compliances"]["standardComp"]["iso9001"]);
    $iso27017 = iso27017($r["compliances"]["standardComp"]["iso27017"]);
    $pciDss = pciDss($r["compliances"]["standardComp"]["pcidss"]);
    $soc1 = soc1($r["compliances"]["standardComp"]["soc1"]);
    $soc2 = soc1($r["compliances"]["standardComp"]["soc2"]);
    $soc3 = soc1($r["compliances"]["standardComp"]["soc3"]);

    $stdComp = $ssae16 + $iso27001 + $iso9001 + $iso27017 + $pciDss + $soc1 + $soc2 + $soc3;

    $comp = $secComp + $legComp + $stdComp;

    // Gather All Data Into Aggregate Matrix
    $instanceName = $r["instanceName"];
    $data = [$instanceName, $sec, $usa, $asc, $perf, $cpr, $prc, $comp];
    array_push($instanceData, $data);

    $data = [];
}
?>