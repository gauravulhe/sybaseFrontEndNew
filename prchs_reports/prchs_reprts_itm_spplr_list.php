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
	$poh_fyr = $_POST['poh_fyr'];
	$file_name = strtoupper($_POST['file_name']);

	$sql = "SELECT DISTINCT 
				   poh.poh_supcd,
				   pod.pod_item,
				   com.com_name, com.com_uname,
				   itm.itm_desc
			FROM $user_com_dbf.invac.pohdr as poh
			INNER JOIN $user_com_dbf.invac.podet as pod
			ON
			poh.poh_com = pod.pod_com AND
			poh.poh_unit = pod.pod_unit AND
			poh.poh_fyr = pod.pod_fyr AND
			poh.poh_po_no = pod.pod_po_no			
			INNER JOIN catalog..comcat as com
			ON
			poh.poh_com = com.com_com AND
			poh.poh_unit = com.com_unit
			INNER JOIN catalog..itmcat as itm
			ON
			pod.pod_item = itm.itm_item
			WHERE pod_com = $poh_com AND pod_unit = $poh_unit AND pod_fyr = $poh_fyr AND pod_item BETWEEN '$fr_item_no' AND '$to_item_no'";

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
			<th colspan="3">ITEMWISE SUPPLIER STATEMENT FOR THE YEAR <?php echo $poh_fyr; ?></th>
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
			<th  width="16%" style="text-align:left">Item Listing </th>
			<th> : </th>
			<td><?php echo 'From '.$fr_item_no.' To '.$to_item_no; ?></td>
		</tr>
	</table>
	<table border="1" cellpadding="0px" width="100%">
		<tr class="bg-color">
			<th>Item No</th>
			<th>Item Desc</th>
			<th>&nbsp;</th>
		</tr>

	<?php 	    
		$i = 1;
	    foreach ($rows as $row) {
	 ?>
        <tr>
            <td style="text-align:center"><?php echo $row['pod_item']; ?></td>
            <td style="text-align:center"><?php echo $row['itm_desc']; ?></td>
            <td>&nbsp;</td>
        </tr>
        <tr class="">
			<th>&nbsp;</th>
			<th>Sup Code</th>
			<th>Sup Name</th>
		</tr>
        <?php 
        	$sql2 = "SELECT sup_name FROM catalog..supcat WHERE sup_supcd = '$row[poh_supcd]'";

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
            <td style="text-align:center"><?php echo $row['poh_supcd']; ?></td>
            <td style="text-align:center"><?php echo $row2['sup_name']; ?></td>
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
			<th>&nbsp;</th>
		</tr>
		<?php	} ?>
	<?php   $i++; }  ?> 

	</table>

<?php } } ?>


</body>
</html>