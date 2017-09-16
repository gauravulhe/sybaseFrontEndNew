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

	$user_com_dbf = trim($_POST['user_com_dbf']);
	$pgd_com = $_POST['pgd_com'];
	$pgd_unit = $_POST['pgd_unit'];
	$fr_pgd_grn_no = $_POST['fr_pgd_grn_no'];
	$to_pgd_grn_no = $_POST['to_pgd_grn_no'];
	$fr_pgd_grn_dt = $_POST['fr_pgd_grn_dt'];
	$to_pgd_grn_dt = $_POST['to_pgd_grn_dt'];
	$file_name = strtoupper($_POST['file_name']);

	//$sql = "SELECT * FROM $user_com_dbf.invac.pogrdfrmk WHERE pgd_com = $pgd_com AND pgd_unit = $pgd_unit AND pgd_grn_dt BETWEEN '$fr_pgd_grn_dt' AND '$to_pgd_grn_dt' AND pgd_grn_no BETWEEN $fr_pgd_grn_no AND $to_pgd_grn_no ORDER BY pgd_grn_dt ASC";

	$sql = "SELECT DISTINCT pgd.*, com.com_name,com.com_uname
					FROM $user_com_dbf.invac.pogrdfrmk as pgd
					INNER JOIN catalog..comcat com
					ON
					pgd.pgd_com = com.com_com AND
					pgd.pgd_unit = com.com_unit
					WHERE pgd_com = $pgd_com AND pgd_unit = $pgd_unit AND pgd_grn_dt BETWEEN '$fr_pgd_grn_dt' AND '$to_pgd_grn_dt' AND pgd_grn_no BETWEEN $fr_pgd_grn_no AND $to_pgd_grn_no ORDER BY pgd_grn_dt ASC";

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
			<th colspan="3">GRN / PO Rate Diff Audit Report</th>
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
			<th  width="16%" style="text-align:left">Rate Difference Report </th>
			<th> : </th>
			<td><?php echo 'From '.date('d-m-Y', strtotime($fr_pgd_grn_dt)).' To '.date('d-m-Y', strtotime($to_pgd_grn_dt)); ?></td>
		</tr>
	</table>
	<table border="1" cellpadding="2px" width="100%">
		<tr class="bg-color">
			 <th>GRN NO</th>
			 <th>GRN SRL</th>
			 <th>GRN DATE</th>
			 <th>PO FYR</th>
			 <th>PO NO</th>
			 <th>PO SRL</th>
			 <th>PO RATE</th>
			 <th>GRN RATE</th>
			 <th width="50%">REMARK</th>
		</tr>

	<?php 	    
		$i = 1;
	    foreach ($rows as $row) {
	 ?>
        <tr>
            <td style="text-align:center"><?php echo $row['pgd_grn_no']; ?></td>
            <td style="text-align:center"><?php echo $row['pgd_grn_srl']; ?></td>
            <td style="text-align:center"><?php echo date('d-m-Y', strtotime($row['pgd_grn_dt'])); ?></td>
            <td style="text-align:center"><?php echo $row['pgd_po_fyr']; ?></td>
            <td style="text-align:center"><?php echo $row['pgd_po_no']; ?></td>
            <td style="text-align:center"><?php echo $row['pgd_po_srl']; ?></td>
            <td style="text-align:right"><?php echo number_format($row['pgd_po_rate'], 2); ?></td>
            <td style="text-align:right"><?php echo number_format($row['pgd_grn_rate'], 2); ?></td>
            <td><?php echo $row['pgd_rmk']; ?></td>
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
			 <th>GRN NO</th>
			 <th>GRN SRL</th>
			 <th>GRN DATE</th>
			 <th>PO FYR</th>
			 <th>PO NO</th>
			 <th>PO SRL</th>
			 <th>PO RATE</th>
			 <th>GRN RATE</th>
			 <th>REMARK</th>
		</tr>
		<?php	} ?>
	<?php   $i++; }  ?> 

	</table>

<?php } } ?>


</body>
</html>