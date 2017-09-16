<?php 	
	//create ODBC connection   
	require_once('../config/config.php');
?>
<html>
<head>
    <title>Purchase Order Reports</title>
    <style type="text/css">
        .bg-color{
            background-color: skyblue;
        }
    </style>
    <script type="text/javascript">
    	window.print();
    </script>
</head>
<body>

	<table border="0" width="100%">
		<tr>
			<th colspan="3">NECO GROUP OF INDUSTRIES</th>
		</tr>
	</table>
<?php

if (isset($_POST['submit'])) {
	//print_r($_POST);

	$user_com_dbf = $_POST['user_com_dbf'];
	$poh_com = $_POST['poh_com'];
	$poh_unit = $_POST['poh_unit'];
	$fr_pod_item = $_POST['fr_pod_item'];
	$to_pod_item = $_POST['to_pod_item'];
	$fr_poh_po_dt = $_POST['fr_poh_po_dt'];
	$to_poh_po_dt = $_POST['to_poh_po_dt'];
	$po_limit = $_POST['po_limit'];
	$file_name = strtoupper($_POST['file_name']);

	$sql = "SELECT DISTINCT TOP $po_limit poh.poh_supcd,poh.poh_po_no,poh.poh_fyr,poh.poh_po_dt,poh.poh_stax_per,pod.pod_item,itm.itm_desc,com.com_name,com.com_uname,sup.sup_name,cod.cod_desc
			FROM $user_com_dbf.invac.pohdr as poh
			INNER JOIN $user_com_dbf.invac.podet pod
			ON
			poh.poh_com = pod.pod_com AND
			poh.poh_unit = pod.pod_unit AND
			poh.poh_fyr = pod.pod_fyr AND
			poh.poh_po_no = pod.pod_po_no
			INNER JOIN catalog..comcat as com
			ON
			poh.poh_com = com.com_com AND
			poh.poh_unit = com.com_unit
			INNER JOIN catalog..supcat as sup
			ON
			poh.poh_supcd = sup.sup_supcd
			INNER JOIN catalog..itmcat as itm
			ON
			pod.pod_item = itm.itm_item
			INNER JOIN catalog..codecat as cod
			ON
			poh.poh_excise_cd = cod.cod_code AND
			cod.cod_prefix = 2
			WHERE poh_com = $poh_com AND poh_unit = $poh_unit AND poh_po_dt BETWEEN '$fr_poh_po_dt' AND '$to_poh_po_dt' AND pod_item BETWEEN '$fr_pod_item' AND '$to_pod_item' ORDER BY poh_po_no ASC";

	$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
	//print_r(odbc_result_all($result, "border=1"));

	$rows = array();
    while ($myRow = odbc_fetch_array($result)) {
        $rows[] = $myRow;
    }
    //print_r($rows);exit;
    if (!empty($rows)) {
?>
	<table border="0" width="100%">
		<tr class="bg-color">
			<th colspan="3">PO Listing For Audit Department</th>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">Date </th>
			<th> : </th>
			<td><?php echo date('d.m.Y'); ?></td>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">Company Name </th>
			<th> : </th>
			<td><?php print_r($rows[0]['com_name']); ?></td>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">Company Unit </th>
			<th> : </th>
			<td><?php print_r($rows[0]['com_uname']); ?></td>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">PO Listing Date</th>
			<th> : </th>
			<td><?php echo 'From '.date('d-m-Y', strtotime($fr_poh_po_dt)).' To '.date('d-m-Y', strtotime($to_poh_po_dt)); ?></td>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">PO Listing Item</th>
			<th> : </th>
			<td><?php echo 'From '.$fr_pod_item.' To '.$to_pod_item; ?></td>
		</tr>
	</table>
	<table border="1" cellpadding="0px" width="100%">
		<tr class="bg-color">
			<th width="30%">Item No / Desc</th>
			<th>PO DATE</th>
			<th>PO NO </th>
			<th>SUPPLIER NAME</th>
			<th>RATE</th>
			<th>ORD QTY</th>
			<th>VALUE</th>
			<th>EX.AMT</th>
			<th>S.TAX</th>
			<th>NET.AMT.</th>
		</tr>

	<?php 	    
		$i = 1;
	    foreach ($rows as $row) {
	 ?>
        <tr>
            <td style="text-align:center"><?php echo $row['pod_item'].' <br>( '.$row['itm_desc'].' )'; ?></td>
            <td colspan="10">&nbsp;</td>
        </tr>
        <?php 
        	$sql2 = "SELECT DISTINCT * FROM $user_com_dbf.invac.podet WHERE pod_com = $poh_com AND pod_unit =  $poh_unit AND pod_fyr =  $row[poh_fyr] AND pod_po_no =  $row[poh_po_no]  AND pod_item = '$row[pod_item]'";

			$result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());
			//print_r(odbc_result_all($result2, "border=1"));
			$rows2 = array();
			while ($myRow2 = odbc_fetch_array($result2)) {
				$rows2[] = $myRow2;
			}
			foreach ($rows2 as $row2) {
        ?>
        <tr>
            <td>&nbsp;</td>
            <td style="text-align:center"><?php echo date('d-m-Y', strtotime($row['poh_po_dt'])); ?></td>
            <td style="text-align:center"><?php echo $row['poh_po_no']; ?></td>
            <td style="text-align:left"><?php echo $row['sup_name']; ?></td>
            <td style="text-align:right"><?php echo $rate = $row2['pod_rate']; ?></td>
            <td style="text-align:right">
            	<?php 
            		$qty = $row2['pod_ord_qty']; 
            		echo number_format($qty, 2); 
            	?>
            </td>
            <td style="text-align:right">
            	<?php 
            		$value = $rate*$qty; 
            		echo number_format($value, 2); 
            		?>
            </td>
            <td style="text-align:right">
            	<?php 
            		$ex_amt = explode('%', $row['cod_desc']);
            		$ex_amt = $ex_amt[0];
            		$ex_amt = ($value*$ex_amt)/100;
            		echo number_format($ex_amt, 2); ?></td>
            <td style="text-align:right">
            	<?php 
					$stax = $row['poh_stax_per']; 
					$stax_amt = ($value*$stax)/100; 
					echo number_format($stax_amt, 2);
				?>
            </td>
            <td style="text-align:right">
            	<?php 

            		$netAmt = $value + $stax_amt + $ex_amt;
            		echo number_format($netAmt, 2);
            	?>
           	</td>
        </tr>
        <?php } ?>
        <?php
        		$no_of_records = ($_POST['no_of_records'])?$_POST['no_of_records'] : 23;
				$line_break = ($_POST['line_break'])?$_POST['line_break'] : 1;
				if ($i % $no_of_records == 0) {
				while ($line_break >= 0) {
					echo '</table><br>';
					$line_break--;
				}
		?>
		<table border="1" cellpadding="0px" width="100%">
			<tr class="bg-color">
				<th>Item No / Desc</th>
				<th>PO DATE</th>
				<th>PO NO </th>
				<th>SUPPLIER NAME</th>
				<th>RATE</th>
				<th>ORD QTY</th>
				<th>VALUE</th>
				<th>EX.AMT</th>
				<th>S.TAX</th>
				<th>NET.AMT.</th>
			</tr>
		<?php	} ?>
	<?php   $i++; }  ?> 

	</table>

<?php } } ?>
<br><br>

</body>
</html>