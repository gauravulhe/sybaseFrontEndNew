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

require_once('config/config.php');

if (isset($_POST['submit'])) {

	$user_com_dbf = $_POST['user_com_dbf'];
	$frdt = $_POST['tml_gst_frdt'];
	$todt = $_POST['tml_gst_todt'];
	$fyr = $_POST['tml_gst_fyr'];

	//create ODBC connection   
	$sql = "select CHAL=bil_no,CHALDT=bil_dt,
	        TYORDNO=slh_ptyord_no,UNT=10,DLVQTY=loa_dlv_qty,BILL=bil_no,BLDT=bil_dt,RATE=bil_gross/loa_dlv_qty, GROSS=bil_gross,NET=bil_net,
	        IGST_AMT=0, IGST_PER= 0, SGST_AMT=b.bld_amt, SGST_PER= slh_sgst_per, CGST_AMT=c.bld_amt,
	        CGST_PER= slh_cgst_per, CURR='INR', TRUCKNO=cha_truck_no,itm_desc,PARTY=bil_ptycd
	        from $user_com_dbf.sales.bill,$user_com_dbf.sales.slhdr, $user_com_dbf.sales.bldet b,
	        $user_com_dbf.sales.bldet c, $user_com_dbf.sales.challan,$user_com_dbf.sales.loading,catalog..itmcat
	        where bil_unit > 0
	        and   bil_fyr         = $fyr
	        and   bil_dt          between '$frdt'  and '$todt'
	        and   bil_ptycd       in ('H074','T146','T149','T196','T200','T231')
	        and   loa_item        = itm_item
	        and   bil_unit        = slh_unit
	        and   bil_ord_fyr     = slh_fyr
	        and   bil_ord_no      = slh_ord_no
	        and   bil_unit        = b.bld_unit
	        and   bil_fyr         = b.bld_fyr
	        and   bil_no          = b.bld_bil_no
	        and   bil_dt          = b.bld_dt
	        and   b.bld_col_id    = 52
	        and   bil_unit        = c.bld_unit
	        and   bil_fyr         = c.bld_fyr
	        and   bil_no          = c.bld_bil_no
	        and   bil_dt          = c.bld_dt
	        and   c.bld_col_id    = 53
	        and   bil_unit        = cha_unit
	        and   bil_fyr         = cha_fyr
	        and   bil_no          = cha_bil_no
	        and   bil_dt          = cha_bil_dt
	        and   cha_unit        = loa_unit
	        and   cha_fyr         = loa_fyr
	        and   cha_ldslip_no   = loa_ldslip_no
	        and   cha_chal_no     = loa_chal_no
	        UNION
	        select CHAL=bil_no,CHALDT=bil_dt,
	        TYORDNO=slh_ptyord_no,UNT=10,DLVQTY=loa_dlv_qty,BILL=bil_no,BLDT=bil_dt,RATE=bil_gross/loa_dlv_qty, GROSS=bil_gross,NET=bil_net,
	        IGST_AMT=a.bld_amt, IGST_PER= slh_igst_per, SGST_AMT=0, SGST_PER= 0, CGST_AMT= 0,
	        CGST_PER= 0, CURR='INR', TRUCKNO=cha_truck_no,itm_desc,PARTY=bil_ptycd
	        from $user_com_dbf.sales.bill,$user_com_dbf.sales.slhdr,$user_com_dbf.sales.bldet a,
	        $user_com_dbf.sales.challan,$user_com_dbf.sales.loading,catalog..itmcat
	        where bil_unit > 0
	        and   bil_fyr         = $fyr
	        and   bil_dt          between '$frdt'  and '$todt'
	        and   bil_ptycd       in ('H074','T146','T149','T196','T200','T231')
	        and   loa_item        = itm_item
	        and   bil_unit        = slh_unit
	        and   bil_ord_fyr     = slh_fyr
	        and   bil_ord_no      = slh_ord_no
	        and   bil_unit        = a.bld_unit
	        and   bil_fyr         = a.bld_fyr
	        and   bil_no          = a.bld_bil_no
	        and   bil_dt          = a.bld_dt
	        and   a.bld_col_id    = 51
	        and   bil_unit        = cha_unit
	        and   bil_fyr         = cha_fyr
	        and   bil_no          = cha_bil_no
	        and   bil_dt          = cha_bil_dt
	        and   cha_unit        = loa_unit
	        and   cha_fyr         = loa_fyr
	        and   cha_ldslip_no   = loa_ldslip_no";

	$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
	$filename = "TMLGST";
	$file_ending = "xls";
	//header info for browser
	header("Content-Type: application/$file_ending");
	header("Content-Disposition: attachment; filename=$filename.$file_ending");
	header("Pragma: no-cache"); 
	header("Expires: 0");
	/*******Start of Formatting for Excel*******/   
	//define separator (defines columns in excel & tabs in word)
	echo '<table border="1">';
	echo '<tr class="bg-color">';
	echo '<th colspan="4">TML GST EXPORT</th>';
	echo '</tr>';
	echo '</table>';
	echo '<table border="1" cellpadding="5px">';
	echo '<tr class="bg-color">';

	echo '<th>PoNumber</th>';
	echo '<th>Unit</th>';
	echo '<th>Quantity</th>';
	echo '<th>Vendor Challan No</th>';
	echo '<th>Challan Date</th>';
	echo '<th>Gross Rate</th>';
	echo '<th>Net P O RATE</th>';
	echo '<th>Basic value</th>';
	echo '<th>Taxable Value</th>';
	echo '<th>SGST VALUE</th>';
	echo '<th>CGST VALUE</th>';
	echo '<th>IGST VALUE</th>';
	echo '<th>SGST RATE</th>';
	echo '<th>CGST RATE</th>';
	echo '<th>IGST RATE</th>';
	echo '<th>Packing Amount</th>';
	echo '<th>Freight Amount</th>';
	echo '<th>Others Amount</th>';
	echo '<th>INVOICE VALUE</th>';
	echo '<th>Currency</th>';
	echo '<th>ROAD PERMIT NO</th>';
	echo '<th>57F4 NUMBER</th>';
	echo '<th>57F4 NO DATE</th>';
	echo '<th>GSTIN number </th>';
	echo '<th>Vehicle Number</th>';
	echo '<th>DRG REV Level</th>';
	echo '<th>COP Certificate</th>';
	echo '<th>Certificate Date</th>';
	echo '<th>TML GSTIN</th>';

	echo '</tr>';
	echo '</table>';
	echo '<table border="0" cellpadding="5px">';
	//end of printing column names  
	//start while loop to get data

	    $rows = array();
	    while ($myRow = odbc_fetch_array($result)) {
	        $rows[] = $myRow;
	    }
	    if (!empty($rows)) {

		    foreach ($rows as $row) {
		        echo '<tr>';
		            echo '<td>'.$row['TYORDNO'].'</td>';
		            echo '<td>'.$row['UNT'].'</td>';
		            echo '<td>'.$row['DLVQTY'].'</td>';
		            echo '<td>'.$row['CHAL'].'</td>';
		            echo '<td>'.date('d.m.Y', strtotime($row['CHALDT'])).'</td>';
		            echo '<td>'.$row['RATE'].'</td>';
		            echo '<td>'.$row['RATE'].'</td>';
		            echo '<td>'.$row['GROSS'].'</td>';
		            echo '<td>'.$row['GROSS'].'</td>';
		            echo '<td>'.$row['SGST_AMT'].'</td>';
		            echo '<td>'.$row['CGST_AMT'].'</td>';
		            echo '<td>'.$row['IGST_AMT'].'</td>';
		            echo '<td>'.$row['SGST_PER'].'</td>';
		            echo '<td>'.$row['CGST_PER'].'</td>';
		            echo '<td>'.$row['IGST_PER'].'</td>';
		            echo '<td>0</td>';
		            echo '<td>0</td>';
		            echo '<td>0</td>';
		            echo '<td>'.$row['NET'].'</td>';
		            echo '<td>'.$row['CURR'].'</td>';
		            echo '<td>0</td>';
		            echo '<td>0</td>';
		            echo '<td>0</td>';
		            echo '<td>0</td>';
		            if(!empty($row['TRUCKNO'] || $row['TRUCKNO'] != '')){
		            	echo '<td>'.$row['TRUCKNO'].'</td>';
		        	}else{
		        		echo '<td>LOCAL</td>';
		        	}            
		            echo '<td>0</td>';
		            echo '<td>0</td>';
		            echo '<td>0</td>';
		            echo '<td>0</td>';            
		        echo '</tr>';
		    }		   
	    }else{
	    	echo '<tr><td colspan="29"><span style="color:red;">No Records Found, Please Try Again.</span></td></tr>';
	    }
	echo '</table>';


}
?>


</body>
</html>