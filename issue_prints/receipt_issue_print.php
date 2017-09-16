<?php 	
	//create ODBC connection   
	require_once('../config/config.php');
?>
<html>
<head>
    <title>Receipt Issue Print</title>
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

	$user_com_dbf = $_POST['user_com_dbf'];
	$iss_com = $_POST['iss_com'];
	$iss_unit = $_POST['iss_unit'];
	$fr_iss_dt = $_POST['fr_iss_dt'];
	$to_iss_dt = $_POST['to_iss_dt'];
	$fr_iss_item = $_POST['fr_iss_item'];
	$to_iss_item = $_POST['to_iss_item'];
	$file_name = strtoupper($_POST['file_name']);

	$sql = "SELECT 
			iss.iss_com, iss.iss_unit, iss.iss_fyr, iss.iss_dt, iss.iss_tc, iss.iss_no, iss.iss_srl, iss.iss_item, iss.iss_qty, iss.iss_rate, iss.iss_fcd, iss.iss_dept, iss.iss_cost, iss.iss_ptycd, iss.iss_trf_item, iss.iss_truck_no, iss.iss_ref_no, iss.iss_ref_srl, iss.iss_ref_dt, iss.iss_userid, iss.iss_updid, iss.iss_upddt,
			com.com_name,com.com_uname,
			itm.itm_desc
			FROM $user_com_dbf.invac.issue as iss
			INNER JOIN catalog..comcat as com
			ON
			iss.iss_com = com.com_com AND
			iss.iss_unit = com.com_unit
			INNER JOIN catalog..itmcat as itm
			ON
			iss.iss_item = itm.itm_item
			WHERE iss_com = $iss_com AND iss_unit = $iss_unit AND iss_item BETWEEN '$fr_iss_item' AND '$to_iss_item' AND iss_dt  BETWEEN '$fr_iss_dt' AND '$to_iss_dt'";
	$result = odbc_exec($conn,$sql) or die("Sybase Error".odbc_error());
	//print_r(odbc_result_all($result, "border=1"));exit;
	$rows = array();
    while ($myRow = odbc_fetch_array($result)) {
        $rows[] = $myRow;
    }
    if (!empty($rows)) {
?>
	<table border="0" width="100%">
		<tr class="bg-color">
			<th colspan="3">Details Of Receipts / Issue's</th>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">Current Date </th>
			<th> : </th>
			<td><?php echo date('d/m/Y'); ?></td>
		</tr>
		<tr>
			<th  width="16%" style="text-align:left">Date </th>
			<th> : </th>
			<td><?php echo 'From '.date('d/m/Y', strtotime($fr_iss_dt)).' To '.date('d/m/Y', strtotime($to_iss_dt)); ?></td>
		</tr>		
		<tr>
			<th  width="16%" style="text-align:left">Item </th>
			<th> : </th>
			<td><?php echo 'From '.$fr_iss_item.' To '.$to_iss_item; ?></td>
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
	</table>
	<table border="1" cellpadding="0px" width="100%">
		<tr class="bg-color">
			<th>DOC DATE</th>
			<th>DOC NO</th>
			<th>TC CD</th>
			<th>SRL</th>
			<th>ITEM CODE</th>
			<th>ITEM DESC</th>
			<th>QTY</th>
		</tr>

	<?php 	    
		$i = 1;
		$total_item = 0;
	    foreach ($rows as $key => $row) {
	 ?>
        <tr style="text-align:center">
            <td><?php echo date('d/m/Y', strtotime($row['iss_dt'])); ?></td>
            <td><?php echo $row['iss_no']; ?></td>
            <td><?php echo $row['iss_tc']; ?></td>
            <td><?php echo $row['iss_srl']; ?></td>
            <td><?php echo $row['iss_item']; ?></td>
            <td><?php echo $row['itm_desc']; ?></td>
            <td style="text-align:right"><?php echo $row['iss_qty']; ?></td>
            <?php 
        		$total_item = $total_item + $row['iss_qty']; 
            ?>
        </tr>
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
			<th>DOC DATE</th>
			<th>DOC NO</th>
			<th>TC CD</th>
			<th>TC NAME</th>
			<th>SRL</th>
			<th>ITEM CODE</th>
			<th>ITEM DESC</th>
			<th>QTY</th>
		</tr>
		<?php	} ?>
	<?php   $i++; }  ?> 
		<tr>
			<td colspan="15" style="text-align:right"><b>Total Item : <?php echo number_format($total_item, 3); ?></b></td>
		</tr>
	</table>

<?php } } ?>


</body>
</html>