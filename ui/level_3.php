<?php
// Get Assurance lvl 2 attribute
$As_attr = [];
if (!empty($_POST['As'])) {
    foreach($_POST['As'] as $attr) {
        // Store selected Level 1 attribute in array
        array_push($As_attr, $attr);
    }
}
// Get Company Performace lvl 2 attribute
$Cp_attr = [];
if (!empty($_POST['Cp'])) {
    foreach($_POST['Cp'] as $attr) {
        // Store selected Level 1 attribute in array
        array_push($Cp_attr, $attr);
    }
}
// Get Compliance lvl 2 attribute
$Cm_attr = [];
if (!empty($_POST['Cm'])) {
    foreach($_POST['Cm'] as $attr) {
        // Store selected Level 1 attribute in array
        array_push($Cm_attr, $attr);
    }
}
// Get Performance lvl 2 attribute
$Pe_attr = [];
if (!empty($_POST['Pe'])) {
    foreach($_POST['Pe'] as $attr) {
        // Store selected Level 1 attribute in array
        array_push($Pe_attr, $attr);
    }
}
// Get Pricing lvl 2 attribute
$Pr_attr = [];
if (!empty($_POST['Pr'])) {
    foreach($_POST['Pr'] as $attr) {
        // Store selected Level 1 attribute in array
        array_push($Pr_attr, $attr);
    }
}
// Get Security lvl 2 attribute
$Se_attr = [];
if (!empty($_POST['Se'])) {
    foreach($_POST['Se'] as $attr) {
        // Store selected Level 1 attribute in array
        array_push($Se_attr, $attr);
    }
}
// Get Usability lvl 2 attribute
$Us_attr = [];
if (!empty($_POST['Us'])) {
    foreach($_POST['Us'] as $attr) {
        // Store selected Level 1 attribute in array
        array_push($Us_attr, $attr);
    }
}
?>

    <!-- col right -->
<form method="post" enctype="multipart/form-data" action="index.php" name="form">
    <div class="col-md-8">
        <!-- LEVEL 2 -->
        <div class="box box-warning">
        <div class="box-header with-border">
            <i class="glyphicon glyphicon-option-vertical"></i><h3 class="box-title">Select 2 | Level Parameters</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label>Level 3</label>
            </div>
            <?php
            if (in_array('AV', $As_attr)) {
            ?>
            <!-- Level 3 of Assurance -->
            <div class="form-group">
                <label>Assurance -> Availability</label></br> 
                <input type="checkbox" name="AV[]" value="UP"><span>&nbsp</span>Uptime Percentage</br>
                <input type="checkbox" name="AV[]" value="UH"><span>&nbsp</span>Uptime History</br>
            </div>
            <?php
            }
            if (in_array('DT', $As_attr)) {
            ?>
            <div class="form-group">
                <label>Assurance -> Downtime</label></br>
                <input type="checkbox" name="DT[]" value="MF"><span>&nbsp</span>Mean Time to Failure</br>
                <input type="checkbox" name="DT[]" value="MR"><span>&nbsp</span>Mean Time to Recovery</br>
            </div>
            <?php
            }
            if (in_array('RC', $As_attr)) {
            ?>
            <div class="form-group">
                <label>Assurance -> Recoverability</label></br>
                <input type="checkbox" name="RC[]" value="RM" checked><span>&nbsp</span>Recovery Mecanism</br>
            </div>
            <?php
            }
            if (in_array('MT', $Cp_attr) or in_array('TR', $Cp_attr) or in_array('CS', $Cp_attr)) {
            ?>
            <!-- Level 3 of Company Performance -->
            <div class="form-group">
                <label>Company Performance</label></br>
                <p>There is no level 3 attribute for Company Performance. Please proced to process</p>
            </div>
            <?php
            }
            if (in_array('SC', $Cm_attr)) {
            ?>
            <!-- Level 3 of Compliance -->
            <div class="form-group">
                <label>Compliance -> Security Compliance</label></br>
                <input type="checkbox" name="SC[]" value="UP"><span>&nbsp</span>U.S. Patriot Act</br>
                <input type="checkbox" name="SC[]" value="FI"><span>&nbsp</span>FISMA</br>
                <input type="checkbox" name="SC[]" value="SH"><span>&nbsp</span>Safe Harbor</br>
                <input type="checkbox" name="SC[]" value="SA"><span>&nbsp</span>SAS 70</br>
            </div>
            <?php
            }
            if (in_array('LC', $Cm_attr)) {
            ?>
            <div class="form-group">
                <label>Compliance -> Legal Compliance</label></br>
                <input type="checkbox" name="LC[]" value="HI"><span>&nbsp</span>HIPAA</br>
                <input type="checkbox" name="LC[]" value="SO"><span>&nbsp</span>Sarbanos Oxley Act (SOX)</br>
            </div>
            <?php
            }
            if (in_array('SM', $Cm_attr)) {
            ?>
            <div class="form-group">
                <label>Compliance -> Standard Compliance</label></br>
                <input type="checkbox" name="SM[]" value="SSAE16"><span>&nbsp</span>SSAE 16</br>
                <input type="checkbox" name="SM[]" value="ISO27001"><span>&nbsp</span>ISO 27001</br>
                <input type="checkbox" name="SM[]" value="ISO9001"><span>&nbsp</span>ISO 9001</br>
                <input type="checkbox" name="SM[]" value="ISO27017"><span>&nbsp</span>ISO 27017</br>
                <input type="checkbox" name="SM[]" value="PCDSS"><span>&nbsp</span>PCDSS</br>
                <input type="checkbox" name="SM[]" value="SOC1"><span>&nbsp</span>SOC 1</br>
                <input type="checkbox" name="SM[]" value="SOC2"><span>&nbsp</span>SOC 2</br>
                <input type="checkbox" name="SM[]" value="SOC3"><span>&nbsp</span>SOC 3</br>
            </div>
            <?php
            }
            if (in_array('HW', $Pe_attr)) {
            ?>
            <!-- Level 3 of Performance -->
            <div class="form-group">
                <label>Performance -> Hardware</label></br>
                <p>There is no level 3 attribute for Performance -> Hardware.</p>
            </div>
            <?php
            }
            if (in_array('FC', $Pe_attr)) {
            ?>
            <div class="form-group">
                <label>Performance -> Functionality</label></br>
                <input type="checkbox" name="FC[]" value="NP"><span>&nbsp</span>Network Performance</br>
                <input type="checkbox" name="FC[]" value="OP"><span>&nbsp</span>I/O Performance</br>
                <input type="checkbox" name="FC[]" value="MM"><span>&nbsp</span>RAM Performance</br>
                <input type="checkbox" name="FC[]" value="CPU"><span>&nbsp</span>CPU Performance</br>
            </div>
            <?php
            }
            if (in_array('EL', $Pe_attr)) {
            ?>
            <div class="form-group">
                <label>Performance -> Elasticity</label></br>
                <input type="checkbox" name="EL[]" value="BT"><span>&nbsp</span>Boot Time</br>
                <input type="checkbox" name="EL[]" value="ST"><span>&nbsp</span>Suspend Time</br>
                <input type="checkbox" name="EL[]" value="DET"><span>&nbsp</span>Delete Time</br>
                <input type="checkbox" name="EL[]" value="PT"><span>&nbsp</span>Provision Time</br>
                <input type="checkbox" name="EL[]" value="TAT"><span>&nbsp</span>Total Acquisition Time</br>
            </div>
            <?php
            }
            if (in_array('FX', $Pe_attr)) {
            ?>
            <div class="form-group">
                <label>Performance -> Flexibility</label></br>
                <p>There is no level 3 attribute for Performance -> Flexibility.</p>
            </div>
            <?php
            }
            if (in_array('SL', $Pe_attr)) {
            ?>
            <div class="form-group">
                <label>Performance -> Scalability</label></br>
                <p>There is no level 3 attribute for Performance -> Scalability.</p>
            </div>
            <?php
            }
            if (in_array('PR', $Pr_attr)) {
            ?>
            <!-- Level 3 of Pricing -->
            <div class="form-group">
                <label>Pricing -> Price</label></br>
                <p>There is no level 3 attribute for Pricing -> Price.</p>
            </div>
            <?php
            }
            if (in_array('CM', $Pr_attr)) {
            ?>
            <div class="form-group">
                <label>Pricing -> Charge Model</label></br>
                <input type="checkbox" name="CM[]" value="PG"><span>&nbsp</span>Pay as you go</br>
                <input type="checkbox" name="CM[]" value="CRT"><span>&nbsp</span>Contract</br>
            </div>
            <?php
            }
            if (in_array('PU', $Pr_attr)) {
            ?>
            <div class="form-group">
                <label>Pricing -> Pricing Unit</label></br>
                <input type="checkbox" name="PU[]" value="HR"><span>&nbsp</span>Per Hour</br>
                <input type="checkbox" name="PU[]" value="MN"><span>&nbsp</span>Per Minute</br>
                <input type="checkbox" name="PU[]" value="GB"><span>&nbsp</span>Per GB</br>
            </div>
            <?php
            }
            if (in_array('CR', $Pr_attr)) {
            ?>
            <div class="form-group">
                <label>Pricing -> Currency</label></br>
                <p>There is no level 3 attribute for Pricing -> Currency.</p>
            </div>
            <?php
            }
            if (in_array('SF', $Pr_attr)) {
            ?>
            <div class="form-group">
                <label>Pricing -> Support Fee</label></br>
                <input type="checkbox" name="SF[]" value="FR"><span>&nbsp</span>Free</br>
                <input type="checkbox" name="SF[]" value="ADD"><span>&nbsp</span>Additional Package</br>
            </div>
            <?php
            }
            if (in_array('DC', $Pr_attr)) {
            ?>
            <div class="form-group">
                <label>Pricing -> Discounting</label></br>
                <p>There is no level 3 attribute for Pricing -> Discounting.</p>
            </div>
            <?php
            }
            if (in_array('PS', $Pr_attr)) {
            ?>
            <div class="form-group">
                <label>Pricing -> Pricing System</label></br>
                <input type="checkbox" name="PS[]" value="TR"><span>&nbsp</span>Tiered Pricing</br>
                <input type="checkbox" name="PS[]" value="VR"><span>&nbsp</span>Volume Pricing</br>
            </div>
            <?php
            }
            if (in_array('AC', $Se_attr)) {
            ?>
            <!-- Level 3 of Security -->
            <div class="form-group">
                <label>Security -> Access Control</label></br>
                <input type="checkbox" name="AC[]" value="AUT"><span>&nbsp</span>Authentication</br>
                <input type="checkbox" name="AC[]" value="AOT"><span>&nbsp</span>Authorization</br>
            </div>
            <?php
            }
            if (in_array('DS', $Se_attr)) {
            ?>
            <div class="form-group">
                <label>Security -> Data Security</label></br>
                <input type="checkbox" name="DS[]" value="EC"><span>&nbsp</span>Encryption</br>
                <input type="checkbox" name="DS[]" value="FW"><span>&nbsp</span>Firewall</br>
            </div>
            <?php
            }
            if (in_array('GO', $Se_attr)) {
            ?>
            <div class="form-group">
                <label>Security -> Geography</label></br>
                <input type="checkbox" name="GO[]" value="NAS"><span>&nbsp</span>Provider's Nasionality</br>
                <input type="checkbox" name="GO[]" value="ML"><span>&nbsp</span>Machine Location</br>
            </div>
            <?php
            }
            if (in_array('AU', $Se_attr)) {
            ?>
            <div class="form-group">
                <label>Security -> Auditability</label></br>
                <p>There is no level 3 attribute for Security -> Auditability.</p>
            </div>
            <?php
            }
            if (in_array('UI', $Us_attr)) {
            ?>
            <!-- Level 3 of Usability -->
            <div class="form-group">
                <label>Usability -> Interface</label></br>
                <input type="checkbox" name="UI[]" value="WEB"><span>&nbsp</span>Web Interface</br>
                <input type="checkbox" name="UI[]" value="MOB"><span>&nbsp</span>Mobile Interface</br>
                <input type="checkbox" name="UI[]" value="TER"><span>&nbsp</span>Terminal Interface</br>
            </div>
            <?php
            }
            if (in_array('OP', $Us_attr)) {
            ?>
            <div class="form-group">
                <label>Usability -> Operability</label></br>
                <p>There is no level 3 attribute for Usability -> Operability.</p>
            </div>
            <?php
            }
            if (in_array('LR', $Us_attr)) {
            ?>
            <div class="form-group">
                <label>Usability -> Learability</label></br>
                <p>There is no level 3 attribute for Usability -> Learability.</p>
            </div>
            <?php
            }
            ?>
        </div>
        </div>
        <!-- /.box -->

        <div class="pull-right">
        <button type="button" class="btn btn-block btn-success btn-lg">Process &nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-circle-right"></i></button> 
        </div>
    </div>
</form>
         