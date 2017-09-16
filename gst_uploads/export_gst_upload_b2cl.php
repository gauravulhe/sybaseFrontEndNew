<html>
<head>
    <title>GST UPLOADS</title>
    <style type="text/css">
        .bg-color{
            background-color: skyblue;
        }
        .float-left{
            text-align: left;
        }
        .float-right{
            text-align: right;
        }
        .float-center{
            text-align: center;
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
$inv_type = explode(',', $_GET['inv']);
$inv_type = implode("','", $inv_type);

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
$sql = "SELECT tbl.ups_unit,tbl.ups_bil_no,tbl.ups_bil_dt,tbl.ups_sfx,tbl.ups_ptycd,
        tbl.ups_ptynm,tbl.ups_gstin_no,tbl.ups_hsn_cd,tbl.ups_hsn_hd,tbl.ups_state_cd,
        tbl.ups_state_nm,tbl.ups_item,tbl.ups_itmname,tbl.ups_qty,tbl.ups_net_amt,
        tbl.ups_gst_rate,tbl.ups_igst_amt,tbl.ups_sgst_amt,tbl.ups_cgst_amt,
        tbl.ups_cess_amt,tbl.ups_fr_ins_amt,tbl.ups_rev_chrg, 
        cod.cod_desc
        FROM $com_dbf.sales.$tblName AS tbl
        INNER JOIN catalog..codecat AS cod
        ON
        cod.cod_code = tbl.ups_uom AND
        cod.cod_prefix = 6
        WHERE ups_state_cd != '27' AND ups_net_amt > 250000 AND ups_gstin_no != 'NULL' AND ups_sfx IN ('$inv_type') ORDER BY ups_bil_dt ASC";

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
echo '<th colspan="4">Summary For B2CL(5)</th>';
echo '<th colspan="20">&nbsp;</th>';
echo '</tr>';

echo '</table>';
echo '<table border="1">';
echo '<tr class="bg-color">';
echo '<th>UNIT</th>';
echo '<th>PARTY CODE</th>';
echo '<th>PARTY NAME</th>';
echo '<th>PLACE OF SUPPLY</th>';
echo '<th>GSTIN NO</th>';
echo '<th>ITEM CODE</th>';
echo '<th>ITEM DESCRIPTION</th>';
echo '<th>QUANTITY</th>';
echo '<th>UOM</th>';
echo '<th>HSN/SAC</th>';
echo '<th>CHAPTER HEAD</th>';
echo '<th>INVOICE NO</th>';
echo '<th>INVOICE DATE</th>';
echo '<th>NET AMT</th>';
echo '<th>FRT/INS AMT</th>';
echo '<th>TAXABLE AMT</th>';
echo '<th>IGST AMT</th>';
echo '<th>SGST AMT</th>';
echo '<th>CGST AMT</th>';
echo '<th>BILL AMT</th>';
echo '<th>INVOICE</th>';
echo '<th>REV. CHR</th>';
echo '<th>RATE</th>';
echo '<th>CESS AMT</th>';
echo '</tr>';
echo '</table>';

echo '<table border="1">';

//end of printing column names  
//start while loop to get data
$no_recp = 0;
$recpArray = array();
$no_of_invoice = 0;
$total_net_amt = 0;
$total_taxable_value = 0;
$igstAmtTotal = 0;
$sgstAmtTotal = 0;
$cgstAmtTotal = 0;
$billAmtTotal = 0;
$total_cess = 0;

$rows = array();
    while ($myRow = odbc_fetch_array($result)) {
        $rows[] = $myRow;
    }
    if (!empty($rows)) {
        foreach ($rows as $row) {
            echo '<tr>';
                echo '<td class="float-center">'.$row['ups_unit'].'</td>';
                echo '<td class="float-center">'.$row['ups_ptycd'].'</td>';
                echo '<td class="float-left">'.$row['ups_ptynm'].'</td>';
                echo '<td class="float-left">'.$row['ups_state_cd'].' - '.$row['ups_state_nm'].'</td>';
                echo '<td class="float-center">'.$row['ups_gstin_no'].'</td>';
                echo '<td class="float-center">'.$row['ups_item'].'</td>';
                echo '<td class="float-left">'.$row['ups_itmname'].'</td>';
                echo '<td class="float-right">'.$row['ups_qty'].'</td>';
                echo '<td class="float-left">'.$row['cod_desc'].'</td>';
                echo '<td class="float-center">'.$row['ups_hsn_cd'].'</td>';
                echo '<td class="float-center">'.$row['ups_hsn_hd'].'</td>';
                echo '<td class="float-center">'.$row['ups_bil_no'].'</td>';
                echo '<td class="float-center">'.date('d-M-Y', strtotime($row['ups_bil_dt'])).'</td>';
                echo '<td class="float-right">'.$row['ups_net_amt'].'</td>';
                $netAmt = $row['ups_net_amt'];
                echo '<td class="float-right">'.$row['ups_fr_ins_amt'].'</td>';
                $frInsAmt = $row['ups_fr_ins_amt'];
                $taxAmt = $netAmt+$frInsAmt;
                echo '<td class="float-right">'.$taxAmt.'</td>';
                $igstAmt = $row['ups_igst_amt'];
                echo '<td class="float-right">'.$igstAmt.'</td>';
                $sgstAmt = $row['ups_sgst_amt'];
                echo '<td class="float-right">'.$sgstAmt.'</td>';
                $cgstAmt = $row['ups_cgst_amt'];
                echo '<td class="float-right">'.$cgstAmt.'</td>';
                $billAmt = $taxAmt+$igstAmt+$sgstAmt+$cgstAmt;
                echo '<td class="float-right">'.$billAmt.'</td>';
                $billSfx = $row['ups_sfx'];
                if ($billSfx == ' ') {
                    $invoice = 'TAX INVOICE';
                }elseif ($billSfx == 'F' || $billSfx == 'f') {
                    $invoice = '57F4 INVOICE';
                }elseif ($billSfx == 'D' || $billSfx == 'd') {
                    $invoice = 'DELIVERY CHALLAN';
                }elseif ($billSfx == 'R' || $billSfx == 'r') {
                    $invoice = 'RCM CHALLAN';
                }else{
                    $invoice = '';
                }
                echo '<td class="float-center">'.$invoice.'</td>';
                echo '<td class="float-right">'.$row['ups_rev_chrg'].'</td>';
                echo '<td class="float-right">'.$row['ups_gst_rate'].'</td>';
                echo '<td class="float-right">'.$row['ups_cess_amt'].'</td>';
            echo '</tr>';
            array_push($recpArray, $row['ups_gstin_no']);
            $no_of_invoice = $no_of_invoice + 1;
            $total_net_amt = $total_net_amt + $netAmt;
            $total_taxable_value = $total_taxable_value + $taxAmt;
            $igstAmtTotal = $igstAmtTotal + $igstAmt;
            $sgstAmtTotal = $sgstAmtTotal + $sgstAmt;
            $cgstAmtTotal = $cgstAmtTotal + $cgstAmt;
            $billAmtTotal = $billAmtTotal + $billAmt;
            $total_cess = $total_cess + $row['ups_cess_amt'];
        }
    }else{
        echo '<tr><th style="color:red;" colspan="24">No records found.</th></tr>';
    }
echo '</table>';
echo '<table border="1">';
echo '<tr class="bg-color">';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th>No. of Recipients</th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th>No. of Invoices</th>';
echo '<th></th>';
echo '<th>Total Net Amount</th>';
echo '<th></th>';
echo '<th>Total Taxable Value</th>';
echo '<th>Total IGST Amt</th>';
echo '<th>Total SGST Amt</th>';
echo '<th>Total CGST Amt</th>';
echo '<th>Total Bill Amount</th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th>Total Cess</th>';
echo '</tr>';
echo '</table>';

echo '<table border="1">';
echo '<tr>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td class="float-center">'.count(array_unique(array_unique($recpArray))).'</td>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<td class="float-center">'.$no_of_invoice.'</td>';
echo '<td></td>';
echo '<td>'.number_format($total_net_amt, 2).'</td>';
echo '<td></td>';
echo '<td>'.number_format($total_taxable_value, 2).'</td>';
echo '<td>'.number_format($igstAmtTotal, 2).'</td>';
echo '<td>'.number_format($sgstAmtTotal, 2).'</td>';
echo '<td>'.number_format($cgstAmtTotal, 2).'</td>';
echo '<td>'.number_format($billAmtTotal, 2).'</td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td>'.number_format($total_cess, 2).'</td>';
echo '</tr>';  
echo '</table>'; 
?>