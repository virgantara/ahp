<?php
    // helper function to handle 0 / 0
    // $upper and $div must be in float
    function zeroByZero($upper, $div) {
        $res = 0;
        if($upper == 0 and $div ==0) {
            $res = 1;
            return $res;
        } elseif($upper != 0 and $div != 0) {
            $res = $upper / $div;
            return $res;
        }else {
            $res = "Cannot div by 0";
            return $res;
        }
    }

    /* Security */
    // Access Control

    function authen($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    function author($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    // Data Security
    $encryption = 100;
    function firewall($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    // Geography
    $nationality = 100;
    $location = 100;

    // Auditabilty
    function audit($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    /* Usability */
    // Interface
    function web($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 50;
        }
        return $score;
    }

    function mobile($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 50;
        }
        return $score;
    }

    function terminal($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    
    function operability($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    function learnability($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    /* Assurance */
    // Availability
    /*
    $instanceUp : instance uptime
    $allUp : all instance uptime in array
    */
    function uptime($instanceUp, $allUp) {
        $score = 100;
        $instanceUp = (float)$instanceUp;
        $upMax = max($allUp);
        $upMin = min($allUp);
        $upper = $upMax - $instanceUp;
        $delta = $upMax - $upMin;
        $deltaScore = 99;
        if($upper !=0){
            $zeroCheck = zeroByZero($upper,$delta);
            $score = 100 - ($zeroCheck * $deltaScore);
        }
        return $score;
    }

    // Outages
    function outages($instanceOut, $allOut) {
        $score = 100;
        $instanceOut = (float)$instanceOut;
        $outMax = max($allOut);
        $outMin = min($allOut);
        $upper = $instanceOut-$outMin;
        $delta = $outMax-$outMin;
        $deltaScore = 99;
        if($upper != 0){
            $zeroCheck = zeroByZero($upper, $delta);
            $score = 100 - ($zeroCheck * $deltaScore);
        }
        return $score;
    }

    // MTTF
    function mttf($instanceF, $allF) {
        $score = 100;
        $instanceF = (float)$instanceF;
        $fMax = max($allF);
        $fMin = min($allF);
        $upper = $fMax - $instanceF;
        $delta = $fMax - $fMin;
        $deltaScore = 99;
        if($upper !=0){
            $zeroCheck = zeroByZero($upper, $delta);
            $score = 100 - ($zeroCheck * $deltaScore);
        }
        return $score;
    }

    // MTTR
    function mttr($instanceR, $allR) {
        $score = 100;
        $instanceR = (float)$instanceR;
        $rMax = max($allR);
        $rMin = min($allR);
        $upper = $instanceR-$rMin;
        $delta = $rMax-$rMin;
        $deltaScore = 99;
        if($upper != 0){
            $zeroCheck = zeroByZero($upper, $delta);
            $score = 100 - ($zeroCheck * $deltaScore); 
        }
        return $score;
    }

    // recoverability
    function recoverability($value) {
        $score = '';
        if($value == "automatic") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    /* Performance */
    // Hardware
    function disk($instanceDisk, $allDisk) {
        $score = 100;
        $instanceDisk = (float)$instanceDisk;
        $diskMax = max($allDisk);
        $diskMin = min($allDisk);
        $upper = $diskMax - $instanceDisk;
        $delta = $diskMax - $diskMin;
        $deltaScore = 99;
        if($upper != 0) {
            $zeroCheck = zeroByZero($upper, $delta);
            $score = 100 - ($zeroCheck * $deltaScore);
        }
        return $score;
    }

    $os = 100;
    $cpuType = 100;
    
    function gpu($instanceGpu) {
        $score = '';
        if($instanceGpu > 0) {
            $score = 100;
        } else {
            $score = 50;
        }
    }

    // Functionality
    function netPerf($instanceNet, $allNet) {
        $score = 100;
        $instanceNet = (float)$instanceNet;
        $netMax = max($allNet);
        $netMin = min($allNet);
        $upper = $netMax - $instanceNet;
        $delta = $netMax - $netMin;
        $deltaScore = 99;
        if($upper != 0){
            $zeroCheck = zeroByZero($upper, $delta);
            $score = 100 - ($zeroCheck * $deltaScore); 
        }
        return $score;
    }

    function memory($instanceMem, $allMem) {
        $score = 100;
        $instanceMem = (float)$instanceMem;
        $memMax = max($allMem);
        $memMin = min($allMem);
        $upper = $memMax - $instanceMem;
        $delta = $memMax - $memMin;
        $deltaScore = 99;
        if($upper != 0){
            $zeroCheck = zeroByZero($upper, $delta);
            $score = 100 - ($zeroCheck * $deltaScore); 
        }
        return $score;
    }

    function cpu($instanceCpu, $allCpu) {
        $score = 100;
        $instanceCpu = (float)$instanceCpu;
        $cpuMax = max($allCpu);
        $cpuMin = min($allCpu);
        $upper = $cpuMax - $instanceCpu;
        $delta = $cpuMax - $cpuMin;
        $deltaScore = 99;
        if($upper != 0){
            $zeroCheck = zeroByZero($upper, $delta);
            $score = 100 - ($zeroCheck * $deltaScore); 
        }
        return $score;
    }

    // Flexibility
    function flexibility($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function scalability($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    /* Company Performance */
    // Training
    function training($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    function customerSupport($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    /* Pricing */
    // Price
    // Both windows and linux use same function
    function price($instancePrice, $allPrice) {
        $score = 100;
        $instancePrice = (float)$instancePrice;
        $priceMax = max($allPrice);
        $priceMin = min($allPrice);
        $upper = $instancePrice-$priceMin;
        $delta = $priceMax-$priceMin;
        $deltaScore = 99;
        if($upper != 0){
            $zeroCheck = zeroByZero($upper, $delta);
            $score = 100 - ($zeroCheck * $deltaScore);
        }
        return $score;
    }

    // Charge Model
    $payAsYouGo = 100;
    $contract = 100;

    // Pricing unit;
    $perHour = 100;
    $perMinute = 100;
    $perGB = 100;

    //Currency
    function currency($curArray) {
        $score = '';
        if(sizeof($curArray)> 2) {
            $score = 100;
        } else {
            $score = 90;
        }
    }

    // Support Fee
    function freeSupport($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 50;
        }
        return $score;
    }

    $additionalPackage = 100;
    
    // Discounting
    function discounting($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 50;
        }
        return $score;
    }
    
    // Pricing system
    $tieredPricing = 100;
    $volumePricing = 100;

    /* Compliance */
    // Security compliance
    function usPatriotAct($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function fisma($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function safeHarbor($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function sas70($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    // Legal Compliance
    function hipaa($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function sox($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

    // Standard Compliance
    function ssae16($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function iso27001($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function iso9001($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function iso27017($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function pciDss($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function soc1($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function soc2($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }
    function soc3($value) {
        $score = '';
        if($value == "yes") {
            $score = 100;
        } else {
            $score = 1;
        }
        return $score;
    }

?>