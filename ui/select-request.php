
<?php
error_reporting(E_ALL); //menampilkan error

//membuat array untuk combobox yang ketiga
$ac = array('Authentication', 'Authorization');
$ds = array('Encryption', 'Firewall');
$g  = array('Providers Nationality', 'Machine Location');
$i  = array('Web Interface', 'Mobile App', 'Terminal Access');
$av = array('Uptime Percentage', 'Uptime History');
$dt = array('Mean Time to Failure','Mean Time to Recover');
$r  = array('Recovery Mechanism');
$f  = array('Network Performance', 'I/O Performance', 'RAM Performance', 'CPU Performance');
$e  = array('Boot Time', 'Suspend Time', 'Delete Time', 'Provision Time', 'Total Acquisition Time');
$cm = array('Pay as you go', 'Contract');
$pu = array('Per hour', 'Per minute', 'Per GB');
$sf = array('Free', 'Additional Package');
$ps = array('Tiered Pricing', 'Volume Pricing');
$sc = array('US Patriot Act', 'FISMA', 'Safe Harbor', 'SAS 70');
$lc = array('HIPAA', 'Sarbanes-Oxley Act (SOX)');
$sm  = array('SSAE 16',' ISO 27001', 'ISO 9001', 'ISO 27017', 'PCI DSS', 'SOC 1', 'SOC 2', 'SOC 3');
//$nf = array('Not Found');

//cek apakah sudah ada data dari post make
if(isset($_POST['make']))
{
	//merubah huruf menjadi kecil, agar sesuai dengan array di atas
	$model = strtolower($_POST['make']);
	
	//menampilkan data untuk combobox yang kedua, berdasarkan combobox pertama yang dipilih
	//dan data untuk combobox kedua dari array diatas.
	foreach($$model as $mo){ echo '<option value="'.$mo.'">'.$mo.'</option>'; }
}
?>