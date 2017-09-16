<html>
<head>
    <title>GST UPLOADS</title>
    <style type="text/css">
        .bg-color{
            background-color: skyblue;
        }
    </style>
</head>
<body>

<?php

require_once('../config/config.php');
$conn=odbc_connect("SYBLINUX","sa","master") or die("Sybase Error".odbc_error());

//$com_dbf = "acd2";         //ODBC Database Name  
$tblName = "gstupld_sal"; //ODBC Table Name   
$filename = $_GET['file'];         //File Name
$com = $_GET['com'];
$unit = $_GET['unit'];
$frdt = $_GET['frdt'];
$todt = $_GET['todt'];
$uid = $_SESSION['usr_id'];

// get com dbf according to user details
$com_dbf_query = "SELECT com_dbf FROM catalog.dbo.comcat WHERE com_com = $com AND com_unit = $unit";
$com_dbf_result = @odbc_exec($conn, $com_dbf_query);
$com_dbf = trim(@odbc_result($com_dbf_result, 1));
    
$useDb = "use $com_dbf";
$useDbResult = odbc_exec($conn, $useDb);

$setUser = "setuser 'sales'";
$setUserResult = odbc_exec($conn, $setUser);

// store procedure
//$sql = "exec gstupldsal {$com},{$unit},'{$frdt}','{$todt}',{$uid},{$com_dbf}";
$sql1 = "declare @fyr1 smallint, @fyr2 smallint, @ffstr char(16384)
        exec catalog..finyear {$com},'{$frdt}',@fyr1 output
        exec catalog..finyear {$com},'{$todt}',@fyr2 output
        exec bilvalue_proc2 {$com},{$unit},{$unit},'{$frdt}','{$todt}','0000000','9999999',000000,999999,{$uid},{$com_dbf}";
odbc_exec($conn, $sql1);

$sql2 = "declare @ffcom tinyint, @ffunit tinyint, @fffrdt datetime, @fftodt datetime, @usrid int, @dbnm char(4)
    exec gstupldsal {$com},{$unit},'{$frdt}','{$todt}',{$uid},{$com_dbf}";
odbc_exec($conn, $sql2);

//create ODBC connection   
$sql = "SELECT ups_gstin_no,ups_bil_no,ups_bil_dt,ups_net_amt,ups_state_cd,ups_state_nm,ups_rev_chrg,ups_gst_rate,ups_taxable_amt,ups_cess_amt FROM $com_dbf.sales.$tblName WHERE ups_gstin_no != 'NULL' ORDER BY ups_gstin_no DESC";

$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
//print_r(odbc_result_all($result, "border=1"));exit;
$file_ending = "xls";
//header info for browser
header("Content-Type: application/$file_ending");
header("Content-Disposition: attachment; filename=$filename.$file_ending");
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   

echo '<table border="1">';
echo '<tr class="bg-color">';
echo '<th colspan="9">Summary For B2B(4)</th>';
echo '</tr>';
echo '</table>';
echo '<table border="1">';
echo '<tr class="bg-color">';
echo '<th>GSTIN/UIN of Recipient</th>';
echo '<th>Invoice Number</th>';
echo '<th>Invoice date</th>';
echo '<th>Invoice Value</th>';
echo '<th>Place Of Supply</th>';
echo '<th>Reverse Charge</th>';
echo '<th>Rate</th>';
echo '<th>Taxable Value</th>';
echo '<th>Cess Amount</th>';
echo '</tr>';
echo '</table>';
echo '<table border="1">';


//end of printing column names  
//start while loop to get data
$no_recp = 0;
$recpArray = array();
$no_of_invoice = 0;
$total_invoice_value = 0;
$total_taxable_value = 0;
$total_cess = 0;

$rows = array();
    while ($myRow = odbc_fetch_array($result)) {
        $rows[] = $myRow;
    }
    foreach ($rows as $row) {
        echo '<tr>';
            echo '<td>'.$row['ups_gstin_no'].'</td>';
            echo '<td>'.$row['ups_bil_no'].'</td>';
            echo '<td>'.date('d-M-Y', strtotime($row['ups_bil_dt'])).'</td>';
            echo '<td>'.number_format($row['ups_net_amt'], 2).'</td>';
            echo '<td>'.$row['ups_state_cd'].' - '.$row['ups_state_nm'].'</td>';
            echo '<td>'.$row['ups_rev_chrg'].'</td>';
            echo '<td>'.$row['ups_gst_rate'].'</td>';
            echo '<td>'.number_format($row['ups_taxable_amt'], 2).'</td>';
            echo '<td>'.number_format($row['ups_cess_amt'], 2).'</td>';
        echo '</tr>';
        array_push($recpArray, $row['ups_gstin_no']);
        $no_of_invoice = $no_of_invoice + 1;
        $total_invoice_value = $total_invoice_value + $row['ups_net_amt'];
        $total_taxable_value = $total_taxable_value + $row['ups_taxable_amt'];
        $total_cess = $total_cess + $row['ups_cess_amt'];
    }
echo '</table>';
echo '<table border="1">';
echo '<tr class="bg-color">';
echo '<th>No. of Recipients</th>';
echo '<th>No. of Invoices</th>';
echo '<th></th>';
echo '<th>Total Invoice Value</th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th>Total Taxable Value</th>';
echo '<th>Total Cess</th>';
echo '</tr>';
echo '</table>';
echo '<table border="1">';
echo '<tr>';
echo '<td>'.count(array_unique(array_unique($recpArray))).'</td>';
echo '<td>'.$no_of_invoice.'</td>';
echo '<td></td>';
echo '<td>'.number_format($total_invoice_value, 2).'</td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td>'.number_format($total_taxable_value, 2).'</td>';
echo '<td>'.number_format($total_cess, 2).'</td>';
echo '</tr>';  
echo '</table>'; 
?>