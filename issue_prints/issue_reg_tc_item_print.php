<?php 	
	//create ODBC connection   
	require_once('../config/config.php');
?>
<html>
<head>
    <title>Issue Reg Tc/Item Wise Print</title>
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
	$iss_tc = $_POST['iss_tc'];
	$fr_iss_item = $_POST['fr_iss_item'];
	$to_iss_item = $_POST['to_iss_item'];
	$fr_iss_dt = $_POST['fr_iss_dt'];
	$to_iss_dt = $_POST['to_iss_dt'];
	$fr_iss_ac = $_POST['fr_iss_ac'];
	$to_iss_ac = $_POST['to_iss_ac'];
	$file_name = strtoupper($_POST['file_name']);

	$sql = "SELECT 
			iss.iss_com, iss.iss_unit, iss.iss_fyr, iss.iss_dt, iss.iss_tc, iss.iss_no, iss.iss_srl, iss.iss_item, iss.iss_qty, iss.iss_rate, iss.iss_fcd, iss.iss_dept, iss.iss_cost, iss.iss_ptycd, iss.iss_trf_item, iss.iss_truck_no, iss.iss_ref_no, iss.iss_ref_srl, iss.iss_ref_dt, iss.iss_userid, iss.iss_updid, iss.iss_upddt,
			com.com_name,com.com_uname,
			cod.cod_desc as fcd_desc,
			dep1.dep_desc as dept_desc,
			dep2.dep_desc as cost_desc,
			itm.itm_desc
			FROM $user_com_dbf.invac.issue as iss
			INNER JOIN catalog..comcat as com
			ON
			iss.iss_com = com.com_com AND
			iss.iss_unit = com.com_unit
			INNER JOIN catalog..codecat as cod
			ON
			iss.iss_fcd = cod.cod_code AND
			cod.cod_prefix = 16
			INNER JOIN catalog..deptcat as dep1
			ON
			iss.iss_dept = dep1.dep_cd AND 
			dep1.dep_prefix = 1
			INNER JOIN catalog..deptcat as dep2
			ON
			iss.iss_cost = dep2.dep_cd AND 
			dep2.dep_prefix = 2
			INNER JOIN catalog..itmcat as itm
			ON
			iss.iss_item = itm.itm_item
			WHERE iss_com = $iss_com AND iss_unit = $iss_unit AND iss_tc = $iss_tc AND iss_item BETWEEN '$fr_iss_item' AND '$to_iss_item' AND iss_dt  BETWEEN '$fr_iss_dt' AND '$to_iss_dt'";
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
			<th colspan="3">Issue Reg Tc/Item Wise Print</th>
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
			<th>SrNo</th>
			<th>TC</th>
			<th>DOC NO</th>
			<th>SRL</th>
			<th>ISS DATE</th>
			<th>ITEM & DESC</th>
			<th>DEPT & DESC</th>
			<th>COST & DESC</th>
			<th>ISS QTY</th>
			<th>RATE</th>
			<th>Value</th>
		</tr>

	<?php 	    
		$i = 1;
		$total_value = 0;
	    foreach ($rows as $key => $row) {
	 ?>
        <tr style="text-align:center">
        	<td><?php echo $i; ?></td>
            <td><?php echo $row['iss_tc']; ?></td>
            <td><?php echo $row['iss_no']; ?></td>
            <td><?php echo $row['iss_srl']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($row['iss_dt'])); ?></td>
            <td><?php echo $row['iss_item'].' - '.$row['itm_desc']; ?></td>
            <td><?php echo $row['iss_dept'].' - '.$row['dept_desc']; ?></td>
            <td><?php echo $row['iss_cost'].' - '.$row['cost_desc']; ?></td>
            <td><?php echo $row['iss_qty']; ?></td>
            <td><?php echo $row['iss_rate']; ?></td>
            <td>
	            <?php 
	            	$value = $row['iss_qty']*$row['iss_rate'];
	            	echo $value;
	        		$total_value = $total_value + $value; 
	            ?>
	        </td>
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
			<th>SrNo</th>
			<th>TC</th>
			<th>DOC NO</th>
			<th>SRL</th>
			<th>ISS DATE</th>
			<th>ITEM & DESC</th>
			<th>DEPT & DESC</th>
			<th>COST & DESC</th>
			<th>ISS QTY</th>
			<th>RATE</th>
			<th>Value</th>
		</tr>
		<?php	} ?>
	<?php   $i++; }  ?> 
		<tr>
			<td colspan="11" style="text-align:right"><b>Total : <?php echo number_format($total_value, 2); ?></b></td>
		</tr>
	</table>

<?php } } ?>


</body>
</html>