<?php
include 'mongoQueryBeginner.php';

$data = $instanceData2;
//print_r($data);
?>
<html>
    <body>
        <table border=1>
            <thead>
                <tr>
                    <th>Instance Name</th>
                    <th>Security</th>
                    <th>Usability</th>
                    <th>Assurance</th>
                    <th>Performance</th>
                    <th>Company Performance</th>
                    <th>Pricing</th>
                    <th>Compliance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($data as $rowidx => $row){
                        echo "
                            <tr>
                                <td>".$row[0]."</td>
                                <td>".$row[1]."</td>
                                <td>".$row[2]."</td>
                                <td>".$row[3]."</td>
                                <td>".$row[4]."</td>
                                <td>".$row[5]."</td>
                                <td>".$row[6]."</td>
                                <td>".$row[6]."</td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>