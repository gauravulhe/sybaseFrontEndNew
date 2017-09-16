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
	$fr_item_no = $_POST['fr_item_no'];
	$to_item_no = $_POST['to_item_no'];
	$fr_party = $_POST['fr_party'];
	$to_party = $_POST['to_party'];
	$fr_po_dt = $_POST['fr_po_dt'];
	$to_po_dt = $_POST['to_po_dt'];
	$pndng_days = $_POST['pndng_days'];
	$file_name = strtoupper($_POST['file_name']);

	$sql = "SELECT DISTINCT 
				   poh.poh_supcd,poh.poh_fyr,
				   com.com_name, com.com_uname,sup.sup_name
			FROM $user_com_dbf.invac.pohdr as poh	
			INNER JOIN catalog..comcat as com
			ON
			poh.poh_com = com.com_com AND
			poh.poh_unit = com.com_unit
			INNER JOIN catalog..supcat as sup
			ON
			poh.poh_supcd = sup.sup_supcd
			WHERE poh_com = $poh_com AND poh_unit = $poh_unit AND poh_po_dt BETWEEN '$fr_po_dt' AND '$to_po_dt' AND poh_supcd BETWEEN '$fr_party' AND '$to_party'";

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
			<th colspan="3">Supp. Wise Pending PO List</th>
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
			<th  width="16%" style="text-align:left">Pending PO Listing </th>
			<th> : </th>
			<td><?php echo 'From '.date('d-m-Y', strtotime($fr_po_dt)).' To '.date('d-m-Y', strtotime($to_po_dt)); ?></td>
		</tr>
	</table>
	<table border="1" cellpadding="0px" width="100%">
		<tr class="bg-color">
			<th>Item No</th>
			<th>Item Desc</th>
			<th colspan="9">&nbsp;</th>
		</tr>

	<?php 	    
		$i = 1;
	    foreach ($rows as $row) {
	 ?>
        <tr>
            <td style="text-align:center"><?php echo $row['poh_supcd']; ?></td>
            <td style="text-align:center"><?php echo $row['sup_name']; ?></td>
            <td colspan="9">&nbsp;</td>
        </tr>
        <tr class="">
			<th>&nbsp;</th>
			<th>PO No</th>
			<!-- <th>PO Dt</th> -->
			<th>Srl No</th>
			<th>Item No</th>
			<th>Item Desc</th>
			<th>UOM</th>
			<th>Ord Qty</th>
			<th>Rec. Qty</th>
			<th>Can. Qty</th>
			<th>Bal. Qty</th>
		</tr>
        <?php 
        	$sql2 = "SELECT DISTINCT pod.*, itm.itm_desc, cod.cod_desc
					FROM $user_com_dbf.invac.podet as pod
					INNER JOIN $user_com_dbf.invac.pohdr poh
					ON
					poh.poh_po_no = pod.pod_po_no AND
					poh.poh_supcd = '$row[poh_supcd]'
					INNER JOIN catalog..itmcat as itm
					ON
					pod.pod_item = itm.itm_item
	  				INNER JOIN catalog..codecat cod
	  				ON 
	  				cod.cod_code = itm.itm_uom AND
	  				cod.cod_prefix = 6
					WHERE pod_com = $poh_com AND pod_unit =  $poh_unit AND pod_fyr =  $row[poh_fyr]  AND pod_item BETWEEN '$fr_item_no' AND '$to_item_no'";

			$result2 = odbc_exec($conn,$sql2) or die("Sybase Error".odbc_error());
			//print_r(odbc_result_all($result2));
			$rows2 = array();
			while ($myRow2 = odbc_fetch_array($result2)) {
				$rows2[] = $myRow2;
			}
			foreach ($rows2 as $row2) {
        ?>
        <tr>
            <td>&nbsp;</td>
            <td style="text-align:center"><?php echo $row2['pod_po_no']; ?></td>
            <!-- <td style="text-align:center"><?php echo date('d-m-Y', strtotime($row['poh_po_dt'])); ?></td> -->
            <td style="text-align:center"><?php echo $row2['pod_po_srl']; ?></td>
            <td style="text-align:center"><?php echo $row2['pod_item']; ?></td>
            <td style="text-align:center"><?php echo $row2['itm_desc']; ?></td>
            <td style="text-align:center"><?php echo $row2['cod_desc']; ?></td>
            <td style="text-align:right"><?php echo $ordQty = $row2['pod_ord_qty']; ?></td>
            <td style="text-align:right"><?php echo $rcvQty = $row2['pod_rcv_qty']; ?></td>
            <td style="text-align:right"><?php echo $canQty = $row2['pod_can_qty']; ?></td>
            <td style="text-align:right">
            	<?php 	
            			$tolerance = $row2['pod_tolerance'];
            			$balQty = ($ordQty-$rcvQty-$canQty)+($ordQty*$tolerance)/100;
            			echo number_format($balQty, 2); 
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
			<th>Item No</th>
			<th>Item Desc</th>
			<th colspan="9">&nbsp;</th>
		</tr>
		<?php	} ?>
	<?php   $i++; }  ?> 

	</table>

<?php } } ?>


</body>
</html>