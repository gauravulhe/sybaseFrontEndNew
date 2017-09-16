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
	$fr_po_no = $_POST['fr_po_no'];
	$to_po_no = $_POST['to_po_no'];
	$poh_fyr = $_POST['poh_fyr'];
	$fr_po_dt = date('Y-m-d', strtotime($_POST['fr_po_dt']));
	$to_po_dt = date('Y-m-d', strtotime($_POST['to_po_dt']));
	$fr_party = strtoupper($_POST['fr_party']);
	$to_party = strtoupper($_POST['to_party']);
	$option = $_POST['option'];
	if ($option == 1) {
		$vet_tag = '(0)';
	}elseif ($option == 2) {
		$vet_tag = '(1)';
	}elseif ($option == 3) {
		$vet_tag = '(0,1)';
	}
	$pty_wise_po = $_POST['pty_wise_po'];
	$amt_wise_po = $_POST['amt_wise_po'];
	$file_name = strtoupper($_POST['file_name']);

	$sql = "SELECT poh.*, com.com_name, com.com_uname, sup.sup_name, cod.cod_desc FROM 
		$user_com_dbf.invac.pohdr as poh
		INNER JOIN catalog..comcat as com
		ON
		poh.poh_com = com.com_com AND
		poh.poh_unit = com.com_unit
		INNER JOIN catalog..supcat as sup
		ON
		poh.poh_supcd = sup.sup_supcd
		INNER JOIN catalog..codecat as cod
		ON
		poh.poh_excise_cd = cod.cod_code AND
		cod.cod_prefix = 2
		WHERE poh_com = $poh_com AND poh_unit = $poh_unit AND poh_fyr = $poh_fyr AND poh_po_no	 BETWEEN $fr_po_no AND $to_po_no AND poh_po_dt  BETWEEN '$fr_po_dt' AND '$to_po_dt' AND poh_supcd  BETWEEN '$fr_party' AND '$to_party' AND poh_vet_tag IN $vet_tag ";

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
			<th colspan="3">PO Listing ( PO Number Wise ) Printing </th>
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
			<th  width="16%" style="text-align:left">Purchase Order Listing </th>
			<th> : </th>
			<td><?php echo 'From '.$fr_po_no.' To '.$to_po_no; ?></td>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">Purchase Order Date </th>
			<th> : </th>
			<td><?php echo 'From '.date('d.m.Y', strtotime($fr_po_dt)).' To '.date('d.m.Y', strtotime($to_po_dt)); ?></td>
		</tr>
	</table>
	<table border="1" cellpadding="0px" width="100%">
		<tr class="bg-color">
			<th>PO No</th>
			<th>PO Dt</th>
			<th>Sup Cd</th>
			<th>Sup Name</th>
			<th>Tax Cd</th>
			<th colspan="5">Cd Desc</th>
			<th colspan="5">Delevery Period</th>
		</tr>

	<?php 	    
		$i = 1;
	    foreach ($rows as $row) {
	 ?>
        <tr>
            <td><?php echo $row['poh_po_no']; ?></td>
            <td style="text-align:center"><?php echo date('d.m.Y', strtotime($row['poh_po_dt'])); ?></td>
            <td style="text-align:center"><?php echo $row['poh_supcd']; ?></td>
            <td><?php echo $row['sup_name']; ?></td>
            <td style="text-align:center"><?php echo $row['poh_excise_cd']; ?></td>
            <td colspan="5"><?php echo $row['cod_desc']; ?></td>
            <td colspan="5"><?php echo $row['poh_pmnt_terms']; ?></td>
        </tr>
        <tr class="">
			<th>&nbsp;</th>
			<th>Srl No</th>
			<th>Item Cd</th>
			<th>Item Desc</th>
			<th>Rate</th>
			<th>PO Ord Qty</th>
			<th>Freight</th>
			<th>S.Tax</th>
			<th>Comm.</th>
			<th>Loading</th>
			<th>Excise</th>
			<th>Cess</th>
			<th>Service</th>
			<th>Disc</th>
			<th>Other Charges</th>
		</tr>
        <?php 
        	$sql2 = "SELECT pod.*, itm.itm_desc
        			FROM $user_com_dbf.invac.podet as pod
					INNER JOIN catalog..itmcat as itm
					ON
					pod.pod_item = itm.itm_item
					WHERE pod_com = $poh_com AND pod_unit = $poh_unit AND pod_fyr = $poh_fyr AND pod_po_no	= $row[poh_po_no]";

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
            <td style="text-align:center"><?php echo $row2['pod_po_srl']; ?></td>
            <td style="text-align:center"><?php echo $row2['pod_item']; ?></td>
            <td><?php echo $row2['itm_desc']; ?></td>
            <td style="text-align:right"><?php echo $row2['pod_rate']; ?></td>
            <td style="text-align:right"><?php echo $row2['pod_ord_qty']; ?></td>
            <td style="text-align:right"><?php echo '0.00'; ?></td>
            <td style="text-align:right"><?php echo $row['poh_stax_per']; ?></td>
            <td style="text-align:right"><?php echo '0.00'; ?></td>
            <td style="text-align:right"><?php echo '0.00'; ?></td>
            <td style="text-align:right"><?php echo '0.00'; ?></td>
            <td style="text-align:right"><?php echo '0.00'; ?></td>
            <td style="text-align:right"><?php echo '0.00'; ?></td>
            <td style="text-align:right"><?php echo $row['poh_disc']; ?></td>
            <td style="text-align:right"><?php echo '0.00'; ?></td>
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
			<th>PO No</th>
			<th>PO Dt</th>
			<th>Sup Cd</th>
			<th>Sup Name</th>
			<th>Tax Cd</th>
			<th colspan="5">Cd Desc</th>
			<th colspan="5">Delevery Period</th>
		</tr>
		<?php	} ?>
	<?php   $i++; }  ?> 

	</table>

<?php } } ?>


</body>
</html>